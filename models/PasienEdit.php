<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienEdit extends Pasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'PASIEN';

    // Page object name
    public $PageObjName = "PasienEdit";

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (PASIEN)
        if (!isset($GLOBALS["PASIEN"]) || get_class($GLOBALS["PASIEN"]) == PROJECT_NAMESPACE . "PASIEN") {
            $GLOBALS["PASIEN"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'PASIEN');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("PASIEN"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "PasienView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['ID'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->ID->Visible = false;
        }
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }
    public $FormClassName = "ew-horizontal ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->ORG_UNIT_CODE->Visible = false;
        $this->NO_REGISTRATION->setVisibility();
        $this->NAME_OF_PASIEN->setVisibility();
        $this->PASIEN_ID->setVisibility();
        $this->KK_NO->setVisibility();
        $this->EMPLOYEE_ID->Visible = false;
        $this->PLACE_OF_BIRTH->setVisibility();
        $this->DATE_OF_BIRTH->setVisibility();
        $this->GENDER->setVisibility();
        $this->NATION_ID->Visible = false;
        $this->EDUCATION_TYPE_CODE->setVisibility();
        $this->MARITALSTATUSID->setVisibility();
        $this->KODE_AGAMA->setVisibility();
        $this->KAL_ID->setVisibility();
        $this->RT->Visible = false;
        $this->RW->Visible = false;
        $this->JOB_ID->setVisibility();
        $this->STATUS_PASIEN_ID->setVisibility();
        $this->ANAK_KE->Visible = false;
        $this->CONTACT_ADDRESS->setVisibility();
        $this->PHONE_NUMBER->setVisibility();
        $this->MOBILE->setVisibility();
        $this->_EMAIL->Visible = false;
        $this->PHOTO_LOCATION->Visible = false;
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->MODIFIED_FROM->Visible = false;
        $this->POSTAL_CODE->Visible = false;
        $this->GELAR->Visible = false;
        $this->BLOOD_TYPE_ID->Visible = false;
        $this->ISMENINGGAL->Visible = false;
        $this->DEATH_DATE->Visible = false;
        $this->PAYOR_ID->setVisibility();
        $this->ACCOUNT_ID->Visible = false;
        $this->KARYAWAN->Visible = false;
        $this->DESCRIPTION->Visible = false;
        $this->NEWCARD->Visible = false;
        $this->BACKCHARGE->Visible = false;
        $this->MOTHER->setVisibility();
        $this->FATHER->setVisibility();
        $this->SPOUSE->setVisibility();
        $this->ORG_ID->setVisibility();
        $this->AKTIF->setVisibility();
        $this->CLASS_ID->setVisibility();
        $this->COVERAGE_ID->setVisibility();
        $this->FAMILY_STATUS_ID->setVisibility();
        $this->TMT->setVisibility();
        $this->TAT->setVisibility();
        $this->CARD_ID->Visible = false;
        $this->REGISTRATION_DATE->setVisibility();
        $this->MEDICAL_NOTES->setVisibility();
        $this->ID->Visible = false;
        $this->newapp->Visible = false;
        $this->Cek->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->GENDER);
        $this->setupLookupOptions($this->EDUCATION_TYPE_CODE);
        $this->setupLookupOptions($this->MARITALSTATUSID);
        $this->setupLookupOptions($this->KODE_AGAMA);
        $this->setupLookupOptions($this->KAL_ID);
        $this->setupLookupOptions($this->JOB_ID);
        $this->setupLookupOptions($this->STATUS_PASIEN_ID);
        $this->setupLookupOptions($this->BLOOD_TYPE_ID);
        $this->setupLookupOptions($this->PAYOR_ID);
        $this->setupLookupOptions($this->AKTIF);
        $this->setupLookupOptions($this->CLASS_ID);
        $this->setupLookupOptions($this->COVERAGE_ID);
        $this->setupLookupOptions($this->FAMILY_STATUS_ID);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("ID") ?? Key(0) ?? Route(2)) !== null) {
                $this->ID->setQueryStringValue($keyValue);
                $this->ID->setOldValue($this->ID->QueryStringValue);
            } elseif (Post("ID") !== null) {
                $this->ID->setFormValue(Post("ID"));
                $this->ID->setOldValue($this->ID->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("ID") ?? Route("ID")) !== null) {
                    $this->ID->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->ID->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("PasienList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->GetViewUrl();
                if (GetPageName($returnUrl) == "PasienList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'NO_REGISTRATION' first before field var 'x_NO_REGISTRATION'
        $val = $CurrentForm->hasValue("NO_REGISTRATION") ? $CurrentForm->getValue("NO_REGISTRATION") : $CurrentForm->getValue("x_NO_REGISTRATION");
        if (!$this->NO_REGISTRATION->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_REGISTRATION->Visible = false; // Disable update for API request
            } else {
                $this->NO_REGISTRATION->setFormValue($val);
            }
        }

        // Check field name 'NAME_OF_PASIEN' first before field var 'x_NAME_OF_PASIEN'
        $val = $CurrentForm->hasValue("NAME_OF_PASIEN") ? $CurrentForm->getValue("NAME_OF_PASIEN") : $CurrentForm->getValue("x_NAME_OF_PASIEN");
        if (!$this->NAME_OF_PASIEN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAME_OF_PASIEN->Visible = false; // Disable update for API request
            } else {
                $this->NAME_OF_PASIEN->setFormValue($val);
            }
        }

        // Check field name 'PASIEN_ID' first before field var 'x_PASIEN_ID'
        $val = $CurrentForm->hasValue("PASIEN_ID") ? $CurrentForm->getValue("PASIEN_ID") : $CurrentForm->getValue("x_PASIEN_ID");
        if (!$this->PASIEN_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PASIEN_ID->Visible = false; // Disable update for API request
            } else {
                $this->PASIEN_ID->setFormValue($val);
            }
        }

        // Check field name 'KK_NO' first before field var 'x_KK_NO'
        $val = $CurrentForm->hasValue("KK_NO") ? $CurrentForm->getValue("KK_NO") : $CurrentForm->getValue("x_KK_NO");
        if (!$this->KK_NO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KK_NO->Visible = false; // Disable update for API request
            } else {
                $this->KK_NO->setFormValue($val);
            }
        }

        // Check field name 'PLACE_OF_BIRTH' first before field var 'x_PLACE_OF_BIRTH'
        $val = $CurrentForm->hasValue("PLACE_OF_BIRTH") ? $CurrentForm->getValue("PLACE_OF_BIRTH") : $CurrentForm->getValue("x_PLACE_OF_BIRTH");
        if (!$this->PLACE_OF_BIRTH->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PLACE_OF_BIRTH->Visible = false; // Disable update for API request
            } else {
                $this->PLACE_OF_BIRTH->setFormValue($val);
            }
        }

        // Check field name 'DATE_OF_BIRTH' first before field var 'x_DATE_OF_BIRTH'
        $val = $CurrentForm->hasValue("DATE_OF_BIRTH") ? $CurrentForm->getValue("DATE_OF_BIRTH") : $CurrentForm->getValue("x_DATE_OF_BIRTH");
        if (!$this->DATE_OF_BIRTH->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DATE_OF_BIRTH->Visible = false; // Disable update for API request
            } else {
                $this->DATE_OF_BIRTH->setFormValue($val);
            }
            $this->DATE_OF_BIRTH->CurrentValue = UnFormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 11);
        }

        // Check field name 'GENDER' first before field var 'x_GENDER'
        $val = $CurrentForm->hasValue("GENDER") ? $CurrentForm->getValue("GENDER") : $CurrentForm->getValue("x_GENDER");
        if (!$this->GENDER->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->GENDER->Visible = false; // Disable update for API request
            } else {
                $this->GENDER->setFormValue($val);
            }
        }

        // Check field name 'EDUCATION_TYPE_CODE' first before field var 'x_EDUCATION_TYPE_CODE'
        $val = $CurrentForm->hasValue("EDUCATION_TYPE_CODE") ? $CurrentForm->getValue("EDUCATION_TYPE_CODE") : $CurrentForm->getValue("x_EDUCATION_TYPE_CODE");
        if (!$this->EDUCATION_TYPE_CODE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->EDUCATION_TYPE_CODE->Visible = false; // Disable update for API request
            } else {
                $this->EDUCATION_TYPE_CODE->setFormValue($val);
            }
        }

        // Check field name 'MARITALSTATUSID' first before field var 'x_MARITALSTATUSID'
        $val = $CurrentForm->hasValue("MARITALSTATUSID") ? $CurrentForm->getValue("MARITALSTATUSID") : $CurrentForm->getValue("x_MARITALSTATUSID");
        if (!$this->MARITALSTATUSID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MARITALSTATUSID->Visible = false; // Disable update for API request
            } else {
                $this->MARITALSTATUSID->setFormValue($val);
            }
        }

        // Check field name 'KODE_AGAMA' first before field var 'x_KODE_AGAMA'
        $val = $CurrentForm->hasValue("KODE_AGAMA") ? $CurrentForm->getValue("KODE_AGAMA") : $CurrentForm->getValue("x_KODE_AGAMA");
        if (!$this->KODE_AGAMA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KODE_AGAMA->Visible = false; // Disable update for API request
            } else {
                $this->KODE_AGAMA->setFormValue($val);
            }
        }

        // Check field name 'KAL_ID' first before field var 'x_KAL_ID'
        $val = $CurrentForm->hasValue("KAL_ID") ? $CurrentForm->getValue("KAL_ID") : $CurrentForm->getValue("x_KAL_ID");
        if (!$this->KAL_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KAL_ID->Visible = false; // Disable update for API request
            } else {
                $this->KAL_ID->setFormValue($val);
            }
        }

        // Check field name 'JOB_ID' first before field var 'x_JOB_ID'
        $val = $CurrentForm->hasValue("JOB_ID") ? $CurrentForm->getValue("JOB_ID") : $CurrentForm->getValue("x_JOB_ID");
        if (!$this->JOB_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->JOB_ID->Visible = false; // Disable update for API request
            } else {
                $this->JOB_ID->setFormValue($val);
            }
        }

        // Check field name 'STATUS_PASIEN_ID' first before field var 'x_STATUS_PASIEN_ID'
        $val = $CurrentForm->hasValue("STATUS_PASIEN_ID") ? $CurrentForm->getValue("STATUS_PASIEN_ID") : $CurrentForm->getValue("x_STATUS_PASIEN_ID");
        if (!$this->STATUS_PASIEN_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->STATUS_PASIEN_ID->Visible = false; // Disable update for API request
            } else {
                $this->STATUS_PASIEN_ID->setFormValue($val);
            }
        }

        // Check field name 'CONTACT_ADDRESS' first before field var 'x_CONTACT_ADDRESS'
        $val = $CurrentForm->hasValue("CONTACT_ADDRESS") ? $CurrentForm->getValue("CONTACT_ADDRESS") : $CurrentForm->getValue("x_CONTACT_ADDRESS");
        if (!$this->CONTACT_ADDRESS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CONTACT_ADDRESS->Visible = false; // Disable update for API request
            } else {
                $this->CONTACT_ADDRESS->setFormValue($val);
            }
        }

        // Check field name 'PHONE_NUMBER' first before field var 'x_PHONE_NUMBER'
        $val = $CurrentForm->hasValue("PHONE_NUMBER") ? $CurrentForm->getValue("PHONE_NUMBER") : $CurrentForm->getValue("x_PHONE_NUMBER");
        if (!$this->PHONE_NUMBER->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PHONE_NUMBER->Visible = false; // Disable update for API request
            } else {
                $this->PHONE_NUMBER->setFormValue($val);
            }
        }

        // Check field name 'MOBILE' first before field var 'x_MOBILE'
        $val = $CurrentForm->hasValue("MOBILE") ? $CurrentForm->getValue("MOBILE") : $CurrentForm->getValue("x_MOBILE");
        if (!$this->MOBILE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MOBILE->Visible = false; // Disable update for API request
            } else {
                $this->MOBILE->setFormValue($val);
            }
        }

        // Check field name 'PAYOR_ID' first before field var 'x_PAYOR_ID'
        $val = $CurrentForm->hasValue("PAYOR_ID") ? $CurrentForm->getValue("PAYOR_ID") : $CurrentForm->getValue("x_PAYOR_ID");
        if (!$this->PAYOR_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PAYOR_ID->Visible = false; // Disable update for API request
            } else {
                $this->PAYOR_ID->setFormValue($val);
            }
        }

        // Check field name 'MOTHER' first before field var 'x_MOTHER'
        $val = $CurrentForm->hasValue("MOTHER") ? $CurrentForm->getValue("MOTHER") : $CurrentForm->getValue("x_MOTHER");
        if (!$this->MOTHER->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MOTHER->Visible = false; // Disable update for API request
            } else {
                $this->MOTHER->setFormValue($val);
            }
        }

        // Check field name 'FATHER' first before field var 'x_FATHER'
        $val = $CurrentForm->hasValue("FATHER") ? $CurrentForm->getValue("FATHER") : $CurrentForm->getValue("x_FATHER");
        if (!$this->FATHER->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FATHER->Visible = false; // Disable update for API request
            } else {
                $this->FATHER->setFormValue($val);
            }
        }

        // Check field name 'SPOUSE' first before field var 'x_SPOUSE'
        $val = $CurrentForm->hasValue("SPOUSE") ? $CurrentForm->getValue("SPOUSE") : $CurrentForm->getValue("x_SPOUSE");
        if (!$this->SPOUSE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SPOUSE->Visible = false; // Disable update for API request
            } else {
                $this->SPOUSE->setFormValue($val);
            }
        }

        // Check field name 'ORG_ID' first before field var 'x_ORG_ID'
        $val = $CurrentForm->hasValue("ORG_ID") ? $CurrentForm->getValue("ORG_ID") : $CurrentForm->getValue("x_ORG_ID");
        if (!$this->ORG_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ORG_ID->Visible = false; // Disable update for API request
            } else {
                $this->ORG_ID->setFormValue($val);
            }
        }

        // Check field name 'AKTIF' first before field var 'x_AKTIF'
        $val = $CurrentForm->hasValue("AKTIF") ? $CurrentForm->getValue("AKTIF") : $CurrentForm->getValue("x_AKTIF");
        if (!$this->AKTIF->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->AKTIF->Visible = false; // Disable update for API request
            } else {
                $this->AKTIF->setFormValue($val);
            }
        }

        // Check field name 'CLASS_ID' first before field var 'x_CLASS_ID'
        $val = $CurrentForm->hasValue("CLASS_ID") ? $CurrentForm->getValue("CLASS_ID") : $CurrentForm->getValue("x_CLASS_ID");
        if (!$this->CLASS_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLASS_ID->Visible = false; // Disable update for API request
            } else {
                $this->CLASS_ID->setFormValue($val);
            }
        }

        // Check field name 'COVERAGE_ID' first before field var 'x_COVERAGE_ID'
        $val = $CurrentForm->hasValue("COVERAGE_ID") ? $CurrentForm->getValue("COVERAGE_ID") : $CurrentForm->getValue("x_COVERAGE_ID");
        if (!$this->COVERAGE_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->COVERAGE_ID->Visible = false; // Disable update for API request
            } else {
                $this->COVERAGE_ID->setFormValue($val);
            }
        }

        // Check field name 'FAMILY_STATUS_ID' first before field var 'x_FAMILY_STATUS_ID'
        $val = $CurrentForm->hasValue("FAMILY_STATUS_ID") ? $CurrentForm->getValue("FAMILY_STATUS_ID") : $CurrentForm->getValue("x_FAMILY_STATUS_ID");
        if (!$this->FAMILY_STATUS_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FAMILY_STATUS_ID->Visible = false; // Disable update for API request
            } else {
                $this->FAMILY_STATUS_ID->setFormValue($val);
            }
        }

        // Check field name 'TMT' first before field var 'x_TMT'
        $val = $CurrentForm->hasValue("TMT") ? $CurrentForm->getValue("TMT") : $CurrentForm->getValue("x_TMT");
        if (!$this->TMT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TMT->Visible = false; // Disable update for API request
            } else {
                $this->TMT->setFormValue($val);
            }
            $this->TMT->CurrentValue = UnFormatDateTime($this->TMT->CurrentValue, 11);
        }

        // Check field name 'TAT' first before field var 'x_TAT'
        $val = $CurrentForm->hasValue("TAT") ? $CurrentForm->getValue("TAT") : $CurrentForm->getValue("x_TAT");
        if (!$this->TAT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TAT->Visible = false; // Disable update for API request
            } else {
                $this->TAT->setFormValue($val);
            }
            $this->TAT->CurrentValue = UnFormatDateTime($this->TAT->CurrentValue, 11);
        }

        // Check field name 'REGISTRATION_DATE' first before field var 'x_REGISTRATION_DATE'
        $val = $CurrentForm->hasValue("REGISTRATION_DATE") ? $CurrentForm->getValue("REGISTRATION_DATE") : $CurrentForm->getValue("x_REGISTRATION_DATE");
        if (!$this->REGISTRATION_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->REGISTRATION_DATE->Visible = false; // Disable update for API request
            } else {
                $this->REGISTRATION_DATE->setFormValue($val);
            }
            $this->REGISTRATION_DATE->CurrentValue = UnFormatDateTime($this->REGISTRATION_DATE->CurrentValue, 11);
        }

        // Check field name 'MEDICAL_NOTES' first before field var 'x_MEDICAL_NOTES'
        $val = $CurrentForm->hasValue("MEDICAL_NOTES") ? $CurrentForm->getValue("MEDICAL_NOTES") : $CurrentForm->getValue("x_MEDICAL_NOTES");
        if (!$this->MEDICAL_NOTES->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MEDICAL_NOTES->Visible = false; // Disable update for API request
            } else {
                $this->MEDICAL_NOTES->setFormValue($val);
            }
        }

        // Check field name 'Cek' first before field var 'x_Cek'
        $val = $CurrentForm->hasValue("Cek") ? $CurrentForm->getValue("Cek") : $CurrentForm->getValue("x_Cek");
        if (!$this->Cek->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Cek->Visible = false; // Disable update for API request
            } else {
                $this->Cek->setFormValue($val);
            }
        }

        // Check field name 'ID' first before field var 'x_ID'
        $val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
        if (!$this->ID->IsDetailKey) {
            $this->ID->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ID->CurrentValue = $this->ID->FormValue;
        $this->NO_REGISTRATION->CurrentValue = $this->NO_REGISTRATION->FormValue;
        $this->NAME_OF_PASIEN->CurrentValue = $this->NAME_OF_PASIEN->FormValue;
        $this->PASIEN_ID->CurrentValue = $this->PASIEN_ID->FormValue;
        $this->KK_NO->CurrentValue = $this->KK_NO->FormValue;
        $this->PLACE_OF_BIRTH->CurrentValue = $this->PLACE_OF_BIRTH->FormValue;
        $this->DATE_OF_BIRTH->CurrentValue = $this->DATE_OF_BIRTH->FormValue;
        $this->DATE_OF_BIRTH->CurrentValue = UnFormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 11);
        $this->GENDER->CurrentValue = $this->GENDER->FormValue;
        $this->EDUCATION_TYPE_CODE->CurrentValue = $this->EDUCATION_TYPE_CODE->FormValue;
        $this->MARITALSTATUSID->CurrentValue = $this->MARITALSTATUSID->FormValue;
        $this->KODE_AGAMA->CurrentValue = $this->KODE_AGAMA->FormValue;
        $this->KAL_ID->CurrentValue = $this->KAL_ID->FormValue;
        $this->JOB_ID->CurrentValue = $this->JOB_ID->FormValue;
        $this->STATUS_PASIEN_ID->CurrentValue = $this->STATUS_PASIEN_ID->FormValue;
        $this->CONTACT_ADDRESS->CurrentValue = $this->CONTACT_ADDRESS->FormValue;
        $this->PHONE_NUMBER->CurrentValue = $this->PHONE_NUMBER->FormValue;
        $this->MOBILE->CurrentValue = $this->MOBILE->FormValue;
        $this->PAYOR_ID->CurrentValue = $this->PAYOR_ID->FormValue;
        $this->MOTHER->CurrentValue = $this->MOTHER->FormValue;
        $this->FATHER->CurrentValue = $this->FATHER->FormValue;
        $this->SPOUSE->CurrentValue = $this->SPOUSE->FormValue;
        $this->ORG_ID->CurrentValue = $this->ORG_ID->FormValue;
        $this->AKTIF->CurrentValue = $this->AKTIF->FormValue;
        $this->CLASS_ID->CurrentValue = $this->CLASS_ID->FormValue;
        $this->COVERAGE_ID->CurrentValue = $this->COVERAGE_ID->FormValue;
        $this->FAMILY_STATUS_ID->CurrentValue = $this->FAMILY_STATUS_ID->FormValue;
        $this->TMT->CurrentValue = $this->TMT->FormValue;
        $this->TMT->CurrentValue = UnFormatDateTime($this->TMT->CurrentValue, 11);
        $this->TAT->CurrentValue = $this->TAT->FormValue;
        $this->TAT->CurrentValue = UnFormatDateTime($this->TAT->CurrentValue, 11);
        $this->REGISTRATION_DATE->CurrentValue = $this->REGISTRATION_DATE->FormValue;
        $this->REGISTRATION_DATE->CurrentValue = UnFormatDateTime($this->REGISTRATION_DATE->CurrentValue, 11);
        $this->MEDICAL_NOTES->CurrentValue = $this->MEDICAL_NOTES->FormValue;
        $this->Cek->CurrentValue = $this->Cek->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
            return;
        }
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->NAME_OF_PASIEN->setDbValue($row['NAME_OF_PASIEN']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->KK_NO->setDbValue($row['KK_NO']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->DATE_OF_BIRTH->setDbValue($row['DATE_OF_BIRTH']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->NATION_ID->setDbValue($row['NATION_ID']);
        $this->EDUCATION_TYPE_CODE->setDbValue($row['EDUCATION_TYPE_CODE']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->JOB_ID->setDbValue($row['JOB_ID']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->ANAK_KE->setDbValue($row['ANAK_KE']);
        $this->CONTACT_ADDRESS->setDbValue($row['CONTACT_ADDRESS']);
        $this->PHONE_NUMBER->setDbValue($row['PHONE_NUMBER']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->PHOTO_LOCATION->setDbValue($row['PHOTO_LOCATION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->POSTAL_CODE->setDbValue($row['POSTAL_CODE']);
        $this->GELAR->setDbValue($row['GELAR']);
        $this->BLOOD_TYPE_ID->setDbValue($row['BLOOD_TYPE_ID']);
        $this->ISMENINGGAL->setDbValue($row['ISMENINGGAL']);
        $this->DEATH_DATE->setDbValue($row['DEATH_DATE']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->KARYAWAN->setDbValue($row['KARYAWAN']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->NEWCARD->setDbValue($row['NEWCARD']);
        $this->BACKCHARGE->setDbValue($row['BACKCHARGE']);
        $this->MOTHER->setDbValue($row['MOTHER']);
        $this->FATHER->setDbValue($row['FATHER']);
        $this->SPOUSE->setDbValue($row['SPOUSE']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->AKTIF->setDbValue($row['AKTIF']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->COVERAGE_ID->setDbValue($row['COVERAGE_ID']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->TMT->setDbValue($row['TMT']);
        $this->TAT->setDbValue($row['TAT']);
        $this->CARD_ID->setDbValue($row['CARD_ID']);
        $this->REGISTRATION_DATE->setDbValue($row['REGISTRATION_DATE']);
        $this->MEDICAL_NOTES->setDbValue($row['MEDICAL_NOTES']);
        $this->ID->setDbValue($row['ID']);
        $this->newapp->setDbValue($row['newapp']);
        $this->Cek->setDbValue($row['Cek']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ORG_UNIT_CODE'] = null;
        $row['NO_REGISTRATION'] = null;
        $row['NAME_OF_PASIEN'] = null;
        $row['PASIEN_ID'] = null;
        $row['KK_NO'] = null;
        $row['EMPLOYEE_ID'] = null;
        $row['PLACE_OF_BIRTH'] = null;
        $row['DATE_OF_BIRTH'] = null;
        $row['GENDER'] = null;
        $row['NATION_ID'] = null;
        $row['EDUCATION_TYPE_CODE'] = null;
        $row['MARITALSTATUSID'] = null;
        $row['KODE_AGAMA'] = null;
        $row['KAL_ID'] = null;
        $row['RT'] = null;
        $row['RW'] = null;
        $row['JOB_ID'] = null;
        $row['STATUS_PASIEN_ID'] = null;
        $row['ANAK_KE'] = null;
        $row['CONTACT_ADDRESS'] = null;
        $row['PHONE_NUMBER'] = null;
        $row['MOBILE'] = null;
        $row['EMAIL'] = null;
        $row['PHOTO_LOCATION'] = null;
        $row['MODIFIED_DATE'] = null;
        $row['MODIFIED_BY'] = null;
        $row['MODIFIED_FROM'] = null;
        $row['POSTAL_CODE'] = null;
        $row['GELAR'] = null;
        $row['BLOOD_TYPE_ID'] = null;
        $row['ISMENINGGAL'] = null;
        $row['DEATH_DATE'] = null;
        $row['PAYOR_ID'] = null;
        $row['ACCOUNT_ID'] = null;
        $row['KARYAWAN'] = null;
        $row['DESCRIPTION'] = null;
        $row['NEWCARD'] = null;
        $row['BACKCHARGE'] = null;
        $row['MOTHER'] = null;
        $row['FATHER'] = null;
        $row['SPOUSE'] = null;
        $row['ORG_ID'] = null;
        $row['AKTIF'] = null;
        $row['CLASS_ID'] = null;
        $row['COVERAGE_ID'] = null;
        $row['FAMILY_STATUS_ID'] = null;
        $row['TMT'] = null;
        $row['TAT'] = null;
        $row['CARD_ID'] = null;
        $row['REGISTRATION_DATE'] = null;
        $row['MEDICAL_NOTES'] = null;
        $row['ID'] = null;
        $row['newapp'] = null;
        $row['Cek'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE

        // NO_REGISTRATION

        // NAME_OF_PASIEN

        // PASIEN_ID

        // KK_NO

        // EMPLOYEE_ID

        // PLACE_OF_BIRTH

        // DATE_OF_BIRTH

        // GENDER

        // NATION_ID

        // EDUCATION_TYPE_CODE

        // MARITALSTATUSID

        // KODE_AGAMA

        // KAL_ID

        // RT

        // RW

        // JOB_ID

        // STATUS_PASIEN_ID

        // ANAK_KE

        // CONTACT_ADDRESS

        // PHONE_NUMBER

        // MOBILE

        // EMAIL

        // PHOTO_LOCATION

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // POSTAL_CODE

        // GELAR

        // BLOOD_TYPE_ID

        // ISMENINGGAL

        // DEATH_DATE

        // PAYOR_ID

        // ACCOUNT_ID

        // KARYAWAN

        // DESCRIPTION

        // NEWCARD

        // BACKCHARGE

        // MOTHER

        // FATHER

        // SPOUSE

        // ORG_ID

        // AKTIF

        // CLASS_ID

        // COVERAGE_ID

        // FAMILY_STATUS_ID

        // TMT

        // TAT

        // CARD_ID

        // REGISTRATION_DATE

        // MEDICAL_NOTES

        // ID

        // newapp

        // Cek
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->ViewValue = $this->NAME_OF_PASIEN->CurrentValue;
            $this->NAME_OF_PASIEN->ViewCustomAttributes = "";

            // PASIEN_ID
            $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
            $this->PASIEN_ID->ViewCustomAttributes = "";

            // KK_NO
            $this->KK_NO->ViewValue = $this->KK_NO->CurrentValue;
            $this->KK_NO->ViewCustomAttributes = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
            $this->EMPLOYEE_ID->ViewCustomAttributes = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
            $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->ViewValue = $this->DATE_OF_BIRTH->CurrentValue;
            $this->DATE_OF_BIRTH->ViewValue = FormatDateTime($this->DATE_OF_BIRTH->ViewValue, 11);
            $this->DATE_OF_BIRTH->ViewCustomAttributes = "";

            // GENDER
            $curVal = trim(strval($this->GENDER->CurrentValue));
            if ($curVal != "") {
                $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
                if ($this->GENDER->ViewValue === null) { // Lookup from database
                    $filterWrk = "[GENDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "[GENDER] = 1 OR [GENDER] = 2";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->GENDER->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->GENDER->Lookup->renderViewRow($rswrk[0]);
                        $this->GENDER->ViewValue = $this->GENDER->displayValue($arwrk);
                    } else {
                        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
                    }
                }
            } else {
                $this->GENDER->ViewValue = null;
            }
            $this->GENDER->ViewCustomAttributes = "";

            // NATION_ID
            $this->NATION_ID->ViewValue = $this->NATION_ID->CurrentValue;
            $this->NATION_ID->ViewValue = FormatNumber($this->NATION_ID->ViewValue, 0, -2, -2, -2);
            $this->NATION_ID->ViewCustomAttributes = "";

            // EDUCATION_TYPE_CODE
            $curVal = trim(strval($this->EDUCATION_TYPE_CODE->CurrentValue));
            if ($curVal != "") {
                $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->lookupCacheOption($curVal);
                if ($this->EDUCATION_TYPE_CODE->ViewValue === null) { // Lookup from database
                    $filterWrk = "[EDUCATION_TYPE_CODE]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->EDUCATION_TYPE_CODE->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->EDUCATION_TYPE_CODE->Lookup->renderViewRow($rswrk[0]);
                        $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->displayValue($arwrk);
                    } else {
                        $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
                    }
                }
            } else {
                $this->EDUCATION_TYPE_CODE->ViewValue = null;
            }
            $this->EDUCATION_TYPE_CODE->ViewCustomAttributes = "";

            // MARITALSTATUSID
            $curVal = trim(strval($this->MARITALSTATUSID->CurrentValue));
            if ($curVal != "") {
                $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->lookupCacheOption($curVal);
                if ($this->MARITALSTATUSID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[MARITALSTATUSID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->MARITALSTATUSID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MARITALSTATUSID->Lookup->renderViewRow($rswrk[0]);
                        $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->displayValue($arwrk);
                    } else {
                        $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
                    }
                }
            } else {
                $this->MARITALSTATUSID->ViewValue = null;
            }
            $this->MARITALSTATUSID->ViewCustomAttributes = "";

            // KODE_AGAMA
            $curVal = trim(strval($this->KODE_AGAMA->CurrentValue));
            if ($curVal != "") {
                $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->lookupCacheOption($curVal);
                if ($this->KODE_AGAMA->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KODE_AGAMA]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->KODE_AGAMA->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KODE_AGAMA->Lookup->renderViewRow($rswrk[0]);
                        $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->displayValue($arwrk);
                    } else {
                        $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->CurrentValue;
                    }
                }
            } else {
                $this->KODE_AGAMA->ViewValue = null;
            }
            $this->KODE_AGAMA->ViewCustomAttributes = "";

            // KAL_ID
            $curVal = trim(strval($this->KAL_ID->CurrentValue));
            if ($curVal != "") {
                $this->KAL_ID->ViewValue = $this->KAL_ID->lookupCacheOption($curVal);
                if ($this->KAL_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KAL_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->KAL_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KAL_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->KAL_ID->ViewValue = $this->KAL_ID->displayValue($arwrk);
                    } else {
                        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
                    }
                }
            } else {
                $this->KAL_ID->ViewValue = null;
            }
            $this->KAL_ID->ViewCustomAttributes = "";

            // RT
            $this->RT->ViewValue = $this->RT->CurrentValue;
            $this->RT->ViewCustomAttributes = "";

            // RW
            $this->RW->ViewValue = $this->RW->CurrentValue;
            $this->RW->ViewCustomAttributes = "";

            // JOB_ID
            $curVal = trim(strval($this->JOB_ID->CurrentValue));
            if ($curVal != "") {
                $this->JOB_ID->ViewValue = $this->JOB_ID->lookupCacheOption($curVal);
                if ($this->JOB_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[JOB_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->JOB_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->JOB_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->JOB_ID->ViewValue = $this->JOB_ID->displayValue($arwrk);
                    } else {
                        $this->JOB_ID->ViewValue = $this->JOB_ID->CurrentValue;
                    }
                }
            } else {
                $this->JOB_ID->ViewValue = null;
            }
            $this->JOB_ID->ViewCustomAttributes = "";

            // STATUS_PASIEN_ID
            $curVal = trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
            if ($curVal != "") {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
                if ($this->STATUS_PASIEN_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "[ISACTIVE] = 1";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->STATUS_PASIEN_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->STATUS_PASIEN_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->displayValue($arwrk);
                    } else {
                        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
                    }
                }
            } else {
                $this->STATUS_PASIEN_ID->ViewValue = null;
            }
            $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

            // ANAK_KE
            $this->ANAK_KE->ViewValue = $this->ANAK_KE->CurrentValue;
            $this->ANAK_KE->ViewValue = FormatNumber($this->ANAK_KE->ViewValue, 0, -2, -2, -2);
            $this->ANAK_KE->ViewCustomAttributes = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->ViewValue = $this->CONTACT_ADDRESS->CurrentValue;
            $this->CONTACT_ADDRESS->ViewCustomAttributes = "";

            // PHONE_NUMBER
            $this->PHONE_NUMBER->ViewValue = $this->PHONE_NUMBER->CurrentValue;
            $this->PHONE_NUMBER->ViewCustomAttributes = "";

            // MOBILE
            $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
            $this->MOBILE->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // PHOTO_LOCATION
            $this->PHOTO_LOCATION->ViewValue = $this->PHOTO_LOCATION->CurrentValue;
            $this->PHOTO_LOCATION->ViewCustomAttributes = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
            $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 11);
            $this->MODIFIED_DATE->ViewCustomAttributes = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
            $this->MODIFIED_BY->ViewCustomAttributes = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
            $this->MODIFIED_FROM->ViewCustomAttributes = "";

            // POSTAL_CODE
            $this->POSTAL_CODE->ViewValue = $this->POSTAL_CODE->CurrentValue;
            $this->POSTAL_CODE->ViewCustomAttributes = "";

            // GELAR
            $this->GELAR->ViewValue = $this->GELAR->CurrentValue;
            $this->GELAR->ViewCustomAttributes = "";

            // BLOOD_TYPE_ID
            $curVal = trim(strval($this->BLOOD_TYPE_ID->CurrentValue));
            if ($curVal != "") {
                $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->lookupCacheOption($curVal);
                if ($this->BLOOD_TYPE_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[BLOOD_TYPE_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->BLOOD_TYPE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->BLOOD_TYPE_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->displayValue($arwrk);
                    } else {
                        $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->CurrentValue;
                    }
                }
            } else {
                $this->BLOOD_TYPE_ID->ViewValue = null;
            }
            $this->BLOOD_TYPE_ID->ViewCustomAttributes = "";

            // ISMENINGGAL
            $this->ISMENINGGAL->ViewValue = $this->ISMENINGGAL->CurrentValue;
            $this->ISMENINGGAL->ViewCustomAttributes = "";

            // DEATH_DATE
            $this->DEATH_DATE->ViewValue = $this->DEATH_DATE->CurrentValue;
            $this->DEATH_DATE->ViewValue = FormatDateTime($this->DEATH_DATE->ViewValue, 11);
            $this->DEATH_DATE->ViewCustomAttributes = "";

            // PAYOR_ID
            $curVal = trim(strval($this->PAYOR_ID->CurrentValue));
            if ($curVal != "") {
                $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->lookupCacheOption($curVal);
                if ($this->PAYOR_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[PAYOR_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->PAYOR_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PAYOR_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->displayValue($arwrk);
                    } else {
                        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
                    }
                }
            } else {
                $this->PAYOR_ID->ViewValue = null;
            }
            $this->PAYOR_ID->ViewCustomAttributes = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
            $this->ACCOUNT_ID->ViewCustomAttributes = "";

            // KARYAWAN
            $this->KARYAWAN->ViewValue = $this->KARYAWAN->CurrentValue;
            $this->KARYAWAN->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // NEWCARD
            $this->NEWCARD->ViewValue = $this->NEWCARD->CurrentValue;
            $this->NEWCARD->ViewValue = FormatDateTime($this->NEWCARD->ViewValue, 0);
            $this->NEWCARD->ViewCustomAttributes = "";

            // BACKCHARGE
            $this->BACKCHARGE->ViewValue = $this->BACKCHARGE->CurrentValue;
            $this->BACKCHARGE->ViewCustomAttributes = "";

            // MOTHER
            $this->MOTHER->ViewValue = $this->MOTHER->CurrentValue;
            $this->MOTHER->ViewCustomAttributes = "";

            // FATHER
            $this->FATHER->ViewValue = $this->FATHER->CurrentValue;
            $this->FATHER->ViewCustomAttributes = "";

            // SPOUSE
            $this->SPOUSE->ViewValue = $this->SPOUSE->CurrentValue;
            $this->SPOUSE->ViewCustomAttributes = "";

            // ORG_ID
            $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
            $this->ORG_ID->ViewCustomAttributes = "";

            // AKTIF
            $this->AKTIF->ViewValue = $this->AKTIF->CurrentValue;
            $curVal = trim(strval($this->AKTIF->CurrentValue));
            if ($curVal != "") {
                $this->AKTIF->ViewValue = $this->AKTIF->lookupCacheOption($curVal);
                if ($this->AKTIF->ViewValue === null) { // Lookup from database
                    $filterWrk = "[STATUS_PESERTA_KODE]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->AKTIF->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->AKTIF->Lookup->renderViewRow($rswrk[0]);
                        $this->AKTIF->ViewValue = $this->AKTIF->displayValue($arwrk);
                    } else {
                        $this->AKTIF->ViewValue = $this->AKTIF->CurrentValue;
                    }
                }
            } else {
                $this->AKTIF->ViewValue = null;
            }
            $this->AKTIF->ViewCustomAttributes = "";

            // CLASS_ID
            $curVal = trim(strval($this->CLASS_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ID->ViewValue = $this->CLASS_ID->lookupCacheOption($curVal);
                if ($this->CLASS_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[CLASS_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->CLASS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLASS_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->CLASS_ID->ViewValue = $this->CLASS_ID->displayValue($arwrk);
                    } else {
                        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
                    }
                }
            } else {
                $this->CLASS_ID->ViewValue = null;
            }
            $this->CLASS_ID->ViewCustomAttributes = "";

            // COVERAGE_ID
            $curVal = trim(strval($this->COVERAGE_ID->CurrentValue));
            if ($curVal != "") {
                $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->lookupCacheOption($curVal);
                if ($this->COVERAGE_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[COVERAGE_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->COVERAGE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->COVERAGE_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->displayValue($arwrk);
                    } else {
                        $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->CurrentValue;
                    }
                }
            } else {
                $this->COVERAGE_ID->ViewValue = null;
            }
            $this->COVERAGE_ID->ViewCustomAttributes = "";

            // FAMILY_STATUS_ID
            $curVal = trim(strval($this->FAMILY_STATUS_ID->CurrentValue));
            if ($curVal != "") {
                $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->lookupCacheOption($curVal);
                if ($this->FAMILY_STATUS_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KDJNSPESERTA]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->FAMILY_STATUS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->FAMILY_STATUS_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->displayValue($arwrk);
                    } else {
                        $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
                    }
                }
            } else {
                $this->FAMILY_STATUS_ID->ViewValue = null;
            }
            $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

            // TMT
            $this->TMT->ViewValue = $this->TMT->CurrentValue;
            $this->TMT->ViewValue = FormatDateTime($this->TMT->ViewValue, 11);
            $this->TMT->ViewCustomAttributes = "";

            // TAT
            $this->TAT->ViewValue = $this->TAT->CurrentValue;
            $this->TAT->ViewValue = FormatDateTime($this->TAT->ViewValue, 11);
            $this->TAT->ViewCustomAttributes = "";

            // CARD_ID
            $this->CARD_ID->ViewValue = $this->CARD_ID->CurrentValue;
            $this->CARD_ID->ViewCustomAttributes = "";

            // REGISTRATION_DATE
            $this->REGISTRATION_DATE->ViewValue = $this->REGISTRATION_DATE->CurrentValue;
            $this->REGISTRATION_DATE->ViewValue = FormatDateTime($this->REGISTRATION_DATE->ViewValue, 11);
            $this->REGISTRATION_DATE->ViewCustomAttributes = "";

            // MEDICAL_NOTES
            $this->MEDICAL_NOTES->ViewValue = $this->MEDICAL_NOTES->CurrentValue;
            $this->MEDICAL_NOTES->ViewCustomAttributes = "";

            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // newapp
            $this->newapp->ViewValue = $this->newapp->CurrentValue;
            $this->newapp->ViewCustomAttributes = "";

            // Cek
            $this->Cek->ViewValue = $this->Cek->CurrentValue;
            $this->Cek->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
            $this->NAME_OF_PASIEN->HrefValue = "";
            $this->NAME_OF_PASIEN->TooltipValue = "";

            // PASIEN_ID
            $this->PASIEN_ID->LinkCustomAttributes = "";
            $this->PASIEN_ID->HrefValue = "";
            $this->PASIEN_ID->TooltipValue = "";

            // KK_NO
            $this->KK_NO->LinkCustomAttributes = "";
            $this->KK_NO->HrefValue = "";
            $this->KK_NO->TooltipValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";
            $this->PLACE_OF_BIRTH->TooltipValue = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->LinkCustomAttributes = "";
            $this->DATE_OF_BIRTH->HrefValue = "";
            $this->DATE_OF_BIRTH->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->LinkCustomAttributes = "";
            $this->EDUCATION_TYPE_CODE->HrefValue = "";
            $this->EDUCATION_TYPE_CODE->TooltipValue = "";

            // MARITALSTATUSID
            $this->MARITALSTATUSID->LinkCustomAttributes = "";
            $this->MARITALSTATUSID->HrefValue = "";
            $this->MARITALSTATUSID->TooltipValue = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->LinkCustomAttributes = "";
            $this->KODE_AGAMA->HrefValue = "";
            $this->KODE_AGAMA->TooltipValue = "";

            // KAL_ID
            $this->KAL_ID->LinkCustomAttributes = "";
            $this->KAL_ID->HrefValue = "";
            $this->KAL_ID->TooltipValue = "";

            // JOB_ID
            $this->JOB_ID->LinkCustomAttributes = "";
            $this->JOB_ID->HrefValue = "";
            $this->JOB_ID->TooltipValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";
            $this->STATUS_PASIEN_ID->TooltipValue = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->LinkCustomAttributes = "";
            $this->CONTACT_ADDRESS->HrefValue = "";
            $this->CONTACT_ADDRESS->TooltipValue = "";

            // PHONE_NUMBER
            $this->PHONE_NUMBER->LinkCustomAttributes = "";
            $this->PHONE_NUMBER->HrefValue = "";
            $this->PHONE_NUMBER->TooltipValue = "";

            // MOBILE
            $this->MOBILE->LinkCustomAttributes = "";
            $this->MOBILE->HrefValue = "";
            $this->MOBILE->TooltipValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";
            $this->PAYOR_ID->TooltipValue = "";

            // MOTHER
            $this->MOTHER->LinkCustomAttributes = "";
            $this->MOTHER->HrefValue = "";
            $this->MOTHER->TooltipValue = "";

            // FATHER
            $this->FATHER->LinkCustomAttributes = "";
            $this->FATHER->HrefValue = "";
            $this->FATHER->TooltipValue = "";

            // SPOUSE
            $this->SPOUSE->LinkCustomAttributes = "";
            $this->SPOUSE->HrefValue = "";
            $this->SPOUSE->TooltipValue = "";

            // ORG_ID
            $this->ORG_ID->LinkCustomAttributes = "";
            $this->ORG_ID->HrefValue = "";
            $this->ORG_ID->TooltipValue = "";

            // AKTIF
            $this->AKTIF->LinkCustomAttributes = "";
            $this->AKTIF->HrefValue = "";
            $this->AKTIF->TooltipValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";
            $this->CLASS_ID->TooltipValue = "";

            // COVERAGE_ID
            $this->COVERAGE_ID->LinkCustomAttributes = "";
            $this->COVERAGE_ID->HrefValue = "";
            $this->COVERAGE_ID->TooltipValue = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
            $this->FAMILY_STATUS_ID->HrefValue = "";
            $this->FAMILY_STATUS_ID->TooltipValue = "";

            // TMT
            $this->TMT->LinkCustomAttributes = "";
            $this->TMT->HrefValue = "";
            $this->TMT->TooltipValue = "";

            // TAT
            $this->TAT->LinkCustomAttributes = "";
            $this->TAT->HrefValue = "";
            $this->TAT->TooltipValue = "";

            // REGISTRATION_DATE
            $this->REGISTRATION_DATE->LinkCustomAttributes = "";
            $this->REGISTRATION_DATE->HrefValue = "";
            $this->REGISTRATION_DATE->TooltipValue = "";

            // MEDICAL_NOTES
            $this->MEDICAL_NOTES->LinkCustomAttributes = "";
            $this->MEDICAL_NOTES->HrefValue = "";
            $this->MEDICAL_NOTES->TooltipValue = "";

            // Cek
            $this->Cek->LinkCustomAttributes = "";
            $this->Cek->HrefValue = "";
            $this->Cek->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
            $this->NO_REGISTRATION->EditCustomAttributes = 'readonly';
            $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->EditAttrs["class"] = "form-control";
            $this->NAME_OF_PASIEN->EditCustomAttributes = "";
            if (!$this->NAME_OF_PASIEN->Raw) {
                $this->NAME_OF_PASIEN->CurrentValue = HtmlDecode($this->NAME_OF_PASIEN->CurrentValue);
            }
            $this->NAME_OF_PASIEN->EditValue = HtmlEncode($this->NAME_OF_PASIEN->CurrentValue);
            $this->NAME_OF_PASIEN->PlaceHolder = RemoveHtml($this->NAME_OF_PASIEN->caption());

            // PASIEN_ID
            $this->PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->PASIEN_ID->EditCustomAttributes = "";
            if (!$this->PASIEN_ID->Raw) {
                $this->PASIEN_ID->CurrentValue = HtmlDecode($this->PASIEN_ID->CurrentValue);
            }
            $this->PASIEN_ID->EditValue = HtmlEncode($this->PASIEN_ID->CurrentValue);
            $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

            // KK_NO
            $this->KK_NO->EditAttrs["class"] = "form-control";
            $this->KK_NO->EditCustomAttributes = "";
            if (!$this->KK_NO->Raw) {
                $this->KK_NO->CurrentValue = HtmlDecode($this->KK_NO->CurrentValue);
            }
            $this->KK_NO->EditValue = HtmlEncode($this->KK_NO->CurrentValue);
            $this->KK_NO->PlaceHolder = RemoveHtml($this->KK_NO->caption());

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->EditAttrs["class"] = "form-control";
            $this->PLACE_OF_BIRTH->EditCustomAttributes = "";
            if (!$this->PLACE_OF_BIRTH->Raw) {
                $this->PLACE_OF_BIRTH->CurrentValue = HtmlDecode($this->PLACE_OF_BIRTH->CurrentValue);
            }
            $this->PLACE_OF_BIRTH->EditValue = HtmlEncode($this->PLACE_OF_BIRTH->CurrentValue);
            $this->PLACE_OF_BIRTH->PlaceHolder = RemoveHtml($this->PLACE_OF_BIRTH->caption());

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->EditAttrs["class"] = "form-control";
            $this->DATE_OF_BIRTH->EditCustomAttributes = "";
            $this->DATE_OF_BIRTH->EditValue = HtmlEncode(FormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 11));
            $this->DATE_OF_BIRTH->PlaceHolder = RemoveHtml($this->DATE_OF_BIRTH->caption());

            // GENDER
            $this->GENDER->EditCustomAttributes = "";
            $curVal = trim(strval($this->GENDER->CurrentValue));
            if ($curVal != "") {
                $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
            } else {
                $this->GENDER->ViewValue = $this->GENDER->Lookup !== null && is_array($this->GENDER->Lookup->Options) ? $curVal : null;
            }
            if ($this->GENDER->ViewValue !== null) { // Load from cache
                $this->GENDER->EditValue = array_values($this->GENDER->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[GENDER]" . SearchString("=", $this->GENDER->CurrentValue, DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "[GENDER] = 1 OR [GENDER] = 2";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->GENDER->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->GENDER->EditValue = $arwrk;
            }
            $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->EditAttrs["class"] = "form-control";
            $this->EDUCATION_TYPE_CODE->EditCustomAttributes = "";
            $curVal = trim(strval($this->EDUCATION_TYPE_CODE->CurrentValue));
            if ($curVal != "") {
                $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->lookupCacheOption($curVal);
            } else {
                $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->Lookup !== null && is_array($this->EDUCATION_TYPE_CODE->Lookup->Options) ? $curVal : null;
            }
            if ($this->EDUCATION_TYPE_CODE->ViewValue !== null) { // Load from cache
                $this->EDUCATION_TYPE_CODE->EditValue = array_values($this->EDUCATION_TYPE_CODE->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[EDUCATION_TYPE_CODE]" . SearchString("=", $this->EDUCATION_TYPE_CODE->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->EDUCATION_TYPE_CODE->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->EDUCATION_TYPE_CODE->EditValue = $arwrk;
            }
            $this->EDUCATION_TYPE_CODE->PlaceHolder = RemoveHtml($this->EDUCATION_TYPE_CODE->caption());

            // MARITALSTATUSID
            $this->MARITALSTATUSID->EditAttrs["class"] = "form-control";
            $this->MARITALSTATUSID->EditCustomAttributes = "";
            $curVal = trim(strval($this->MARITALSTATUSID->CurrentValue));
            if ($curVal != "") {
                $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->lookupCacheOption($curVal);
            } else {
                $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->Lookup !== null && is_array($this->MARITALSTATUSID->Lookup->Options) ? $curVal : null;
            }
            if ($this->MARITALSTATUSID->ViewValue !== null) { // Load from cache
                $this->MARITALSTATUSID->EditValue = array_values($this->MARITALSTATUSID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[MARITALSTATUSID]" . SearchString("=", $this->MARITALSTATUSID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->MARITALSTATUSID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MARITALSTATUSID->EditValue = $arwrk;
            }
            $this->MARITALSTATUSID->PlaceHolder = RemoveHtml($this->MARITALSTATUSID->caption());

            // KODE_AGAMA
            $this->KODE_AGAMA->EditAttrs["class"] = "form-control";
            $this->KODE_AGAMA->EditCustomAttributes = "";
            $curVal = trim(strval($this->KODE_AGAMA->CurrentValue));
            if ($curVal != "") {
                $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->lookupCacheOption($curVal);
            } else {
                $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->Lookup !== null && is_array($this->KODE_AGAMA->Lookup->Options) ? $curVal : null;
            }
            if ($this->KODE_AGAMA->ViewValue !== null) { // Load from cache
                $this->KODE_AGAMA->EditValue = array_values($this->KODE_AGAMA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[KODE_AGAMA]" . SearchString("=", $this->KODE_AGAMA->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->KODE_AGAMA->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KODE_AGAMA->EditValue = $arwrk;
            }
            $this->KODE_AGAMA->PlaceHolder = RemoveHtml($this->KODE_AGAMA->caption());

            // KAL_ID
            $this->KAL_ID->EditAttrs["class"] = "form-control";
            $this->KAL_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->KAL_ID->CurrentValue));
            if ($curVal != "") {
                $this->KAL_ID->ViewValue = $this->KAL_ID->lookupCacheOption($curVal);
            } else {
                $this->KAL_ID->ViewValue = $this->KAL_ID->Lookup !== null && is_array($this->KAL_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->KAL_ID->ViewValue !== null) { // Load from cache
                $this->KAL_ID->EditValue = array_values($this->KAL_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[KAL_ID]" . SearchString("=", $this->KAL_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->KAL_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KAL_ID->EditValue = $arwrk;
            }
            $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

            // JOB_ID
            $this->JOB_ID->EditAttrs["class"] = "form-control";
            $this->JOB_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->JOB_ID->CurrentValue));
            if ($curVal != "") {
                $this->JOB_ID->ViewValue = $this->JOB_ID->lookupCacheOption($curVal);
            } else {
                $this->JOB_ID->ViewValue = $this->JOB_ID->Lookup !== null && is_array($this->JOB_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->JOB_ID->ViewValue !== null) { // Load from cache
                $this->JOB_ID->EditValue = array_values($this->JOB_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[JOB_ID]" . SearchString("=", $this->JOB_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->JOB_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->JOB_ID->EditValue = $arwrk;
            }
            $this->JOB_ID->PlaceHolder = RemoveHtml($this->JOB_ID->caption());

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
            if ($curVal != "") {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
            } else {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->Lookup !== null && is_array($this->STATUS_PASIEN_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->STATUS_PASIEN_ID->ViewValue !== null) { // Load from cache
                $this->STATUS_PASIEN_ID->EditValue = array_values($this->STATUS_PASIEN_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $this->STATUS_PASIEN_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "[ISACTIVE] = 1";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->STATUS_PASIEN_ID->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->STATUS_PASIEN_ID->EditValue = $arwrk;
            }
            $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->EditAttrs["class"] = "form-control";
            $this->CONTACT_ADDRESS->EditCustomAttributes = "";
            $this->CONTACT_ADDRESS->EditValue = HtmlEncode($this->CONTACT_ADDRESS->CurrentValue);
            $this->CONTACT_ADDRESS->PlaceHolder = RemoveHtml($this->CONTACT_ADDRESS->caption());

            // PHONE_NUMBER
            $this->PHONE_NUMBER->EditAttrs["class"] = "form-control";
            $this->PHONE_NUMBER->EditCustomAttributes = "";
            if (!$this->PHONE_NUMBER->Raw) {
                $this->PHONE_NUMBER->CurrentValue = HtmlDecode($this->PHONE_NUMBER->CurrentValue);
            }
            $this->PHONE_NUMBER->EditValue = HtmlEncode($this->PHONE_NUMBER->CurrentValue);
            $this->PHONE_NUMBER->PlaceHolder = RemoveHtml($this->PHONE_NUMBER->caption());

            // MOBILE
            $this->MOBILE->EditAttrs["class"] = "form-control";
            $this->MOBILE->EditCustomAttributes = "";
            if (!$this->MOBILE->Raw) {
                $this->MOBILE->CurrentValue = HtmlDecode($this->MOBILE->CurrentValue);
            }
            $this->MOBILE->EditValue = HtmlEncode($this->MOBILE->CurrentValue);
            $this->MOBILE->PlaceHolder = RemoveHtml($this->MOBILE->caption());

            // PAYOR_ID
            $this->PAYOR_ID->EditAttrs["class"] = "form-control";
            $this->PAYOR_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->PAYOR_ID->CurrentValue));
            if ($curVal != "") {
                $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->lookupCacheOption($curVal);
            } else {
                $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->Lookup !== null && is_array($this->PAYOR_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->PAYOR_ID->ViewValue !== null) { // Load from cache
                $this->PAYOR_ID->EditValue = array_values($this->PAYOR_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[PAYOR_ID]" . SearchString("=", $this->PAYOR_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->PAYOR_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->PAYOR_ID->EditValue = $arwrk;
            }
            $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

            // MOTHER
            $this->MOTHER->EditAttrs["class"] = "form-control";
            $this->MOTHER->EditCustomAttributes = "";
            if (!$this->MOTHER->Raw) {
                $this->MOTHER->CurrentValue = HtmlDecode($this->MOTHER->CurrentValue);
            }
            $this->MOTHER->EditValue = HtmlEncode($this->MOTHER->CurrentValue);
            $this->MOTHER->PlaceHolder = RemoveHtml($this->MOTHER->caption());

            // FATHER
            $this->FATHER->EditAttrs["class"] = "form-control";
            $this->FATHER->EditCustomAttributes = "";
            if (!$this->FATHER->Raw) {
                $this->FATHER->CurrentValue = HtmlDecode($this->FATHER->CurrentValue);
            }
            $this->FATHER->EditValue = HtmlEncode($this->FATHER->CurrentValue);
            $this->FATHER->PlaceHolder = RemoveHtml($this->FATHER->caption());

            // SPOUSE
            $this->SPOUSE->EditAttrs["class"] = "form-control";
            $this->SPOUSE->EditCustomAttributes = "";
            if (!$this->SPOUSE->Raw) {
                $this->SPOUSE->CurrentValue = HtmlDecode($this->SPOUSE->CurrentValue);
            }
            $this->SPOUSE->EditValue = HtmlEncode($this->SPOUSE->CurrentValue);
            $this->SPOUSE->PlaceHolder = RemoveHtml($this->SPOUSE->caption());

            // ORG_ID
            $this->ORG_ID->EditAttrs["class"] = "form-control";
            $this->ORG_ID->EditCustomAttributes = "";
            $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
            $this->ORG_ID->ViewCustomAttributes = "";

            // AKTIF
            $this->AKTIF->EditAttrs["class"] = "form-control";
            $this->AKTIF->EditCustomAttributes = "";
            $this->AKTIF->EditValue = $this->AKTIF->CurrentValue;
            $curVal = trim(strval($this->AKTIF->CurrentValue));
            if ($curVal != "") {
                $this->AKTIF->EditValue = $this->AKTIF->lookupCacheOption($curVal);
                if ($this->AKTIF->EditValue === null) { // Lookup from database
                    $filterWrk = "[STATUS_PESERTA_KODE]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->AKTIF->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->AKTIF->Lookup->renderViewRow($rswrk[0]);
                        $this->AKTIF->EditValue = $this->AKTIF->displayValue($arwrk);
                    } else {
                        $this->AKTIF->EditValue = $this->AKTIF->CurrentValue;
                    }
                }
            } else {
                $this->AKTIF->EditValue = null;
            }
            $this->AKTIF->ViewCustomAttributes = "";

            // CLASS_ID
            $this->CLASS_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLASS_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ID->ViewValue = $this->CLASS_ID->lookupCacheOption($curVal);
            } else {
                $this->CLASS_ID->ViewValue = $this->CLASS_ID->Lookup !== null && is_array($this->CLASS_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLASS_ID->ViewValue !== null) { // Load from cache
                $this->CLASS_ID->EditValue = array_values($this->CLASS_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLASS_ID]" . SearchString("=", $this->CLASS_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->CLASS_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLASS_ID->EditValue = $arwrk;
            }
            $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

            // COVERAGE_ID
            $this->COVERAGE_ID->EditAttrs["class"] = "form-control";
            $this->COVERAGE_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->COVERAGE_ID->CurrentValue));
            if ($curVal != "") {
                $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->lookupCacheOption($curVal);
            } else {
                $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->Lookup !== null && is_array($this->COVERAGE_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->COVERAGE_ID->ViewValue !== null) { // Load from cache
                $this->COVERAGE_ID->EditValue = array_values($this->COVERAGE_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[COVERAGE_ID]" . SearchString("=", $this->COVERAGE_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->COVERAGE_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->COVERAGE_ID->EditValue = $arwrk;
            }
            $this->COVERAGE_ID->PlaceHolder = RemoveHtml($this->COVERAGE_ID->caption());

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->EditAttrs["class"] = "form-control";
            $this->FAMILY_STATUS_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->FAMILY_STATUS_ID->CurrentValue));
            if ($curVal != "") {
                $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->lookupCacheOption($curVal);
                if ($this->FAMILY_STATUS_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[KDJNSPESERTA]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->FAMILY_STATUS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->FAMILY_STATUS_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->displayValue($arwrk);
                    } else {
                        $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->CurrentValue;
                    }
                }
            } else {
                $this->FAMILY_STATUS_ID->EditValue = null;
            }
            $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

            // TMT
            $this->TMT->EditAttrs["class"] = "form-control";
            $this->TMT->EditCustomAttributes = "";
            $this->TMT->EditValue = $this->TMT->CurrentValue;
            $this->TMT->EditValue = FormatDateTime($this->TMT->EditValue, 11);
            $this->TMT->ViewCustomAttributes = "";

            // TAT
            $this->TAT->EditAttrs["class"] = "form-control";
            $this->TAT->EditCustomAttributes = "";
            $this->TAT->EditValue = $this->TAT->CurrentValue;
            $this->TAT->EditValue = FormatDateTime($this->TAT->EditValue, 11);
            $this->TAT->ViewCustomAttributes = "";

            // REGISTRATION_DATE
            $this->REGISTRATION_DATE->EditAttrs["class"] = "form-control";
            $this->REGISTRATION_DATE->EditCustomAttributes = 'readonly';
            $this->REGISTRATION_DATE->EditValue = $this->REGISTRATION_DATE->CurrentValue;
            $this->REGISTRATION_DATE->EditValue = FormatDateTime($this->REGISTRATION_DATE->EditValue, 11);
            $this->REGISTRATION_DATE->ViewCustomAttributes = "";

            // MEDICAL_NOTES
            $this->MEDICAL_NOTES->EditAttrs["class"] = "form-control";
            $this->MEDICAL_NOTES->EditCustomAttributes = "";
            $this->MEDICAL_NOTES->EditValue = HtmlEncode($this->MEDICAL_NOTES->CurrentValue);
            $this->MEDICAL_NOTES->PlaceHolder = RemoveHtml($this->MEDICAL_NOTES->caption());

            // Cek
            $this->Cek->EditAttrs["class"] = "form-control";
            $this->Cek->EditCustomAttributes = "";
            if (!$this->Cek->Raw) {
                $this->Cek->CurrentValue = HtmlDecode($this->Cek->CurrentValue);
            }
            $this->Cek->EditValue = HtmlEncode($this->Cek->CurrentValue);
            $this->Cek->PlaceHolder = RemoveHtml($this->Cek->caption());

            // Edit refer script

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
            $this->NAME_OF_PASIEN->HrefValue = "";

            // PASIEN_ID
            $this->PASIEN_ID->LinkCustomAttributes = "";
            $this->PASIEN_ID->HrefValue = "";

            // KK_NO
            $this->KK_NO->LinkCustomAttributes = "";
            $this->KK_NO->HrefValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->LinkCustomAttributes = "";
            $this->DATE_OF_BIRTH->HrefValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->LinkCustomAttributes = "";
            $this->EDUCATION_TYPE_CODE->HrefValue = "";

            // MARITALSTATUSID
            $this->MARITALSTATUSID->LinkCustomAttributes = "";
            $this->MARITALSTATUSID->HrefValue = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->LinkCustomAttributes = "";
            $this->KODE_AGAMA->HrefValue = "";

            // KAL_ID
            $this->KAL_ID->LinkCustomAttributes = "";
            $this->KAL_ID->HrefValue = "";

            // JOB_ID
            $this->JOB_ID->LinkCustomAttributes = "";
            $this->JOB_ID->HrefValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->LinkCustomAttributes = "";
            $this->CONTACT_ADDRESS->HrefValue = "";

            // PHONE_NUMBER
            $this->PHONE_NUMBER->LinkCustomAttributes = "";
            $this->PHONE_NUMBER->HrefValue = "";

            // MOBILE
            $this->MOBILE->LinkCustomAttributes = "";
            $this->MOBILE->HrefValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";

            // MOTHER
            $this->MOTHER->LinkCustomAttributes = "";
            $this->MOTHER->HrefValue = "";

            // FATHER
            $this->FATHER->LinkCustomAttributes = "";
            $this->FATHER->HrefValue = "";

            // SPOUSE
            $this->SPOUSE->LinkCustomAttributes = "";
            $this->SPOUSE->HrefValue = "";

            // ORG_ID
            $this->ORG_ID->LinkCustomAttributes = "";
            $this->ORG_ID->HrefValue = "";
            $this->ORG_ID->TooltipValue = "";

            // AKTIF
            $this->AKTIF->LinkCustomAttributes = "";
            $this->AKTIF->HrefValue = "";
            $this->AKTIF->TooltipValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";

            // COVERAGE_ID
            $this->COVERAGE_ID->LinkCustomAttributes = "";
            $this->COVERAGE_ID->HrefValue = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
            $this->FAMILY_STATUS_ID->HrefValue = "";
            $this->FAMILY_STATUS_ID->TooltipValue = "";

            // TMT
            $this->TMT->LinkCustomAttributes = "";
            $this->TMT->HrefValue = "";
            $this->TMT->TooltipValue = "";

            // TAT
            $this->TAT->LinkCustomAttributes = "";
            $this->TAT->HrefValue = "";
            $this->TAT->TooltipValue = "";

            // REGISTRATION_DATE
            $this->REGISTRATION_DATE->LinkCustomAttributes = "";
            $this->REGISTRATION_DATE->HrefValue = "";
            $this->REGISTRATION_DATE->TooltipValue = "";

            // MEDICAL_NOTES
            $this->MEDICAL_NOTES->LinkCustomAttributes = "";
            $this->MEDICAL_NOTES->HrefValue = "";

            // Cek
            $this->Cek->LinkCustomAttributes = "";
            $this->Cek->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->NO_REGISTRATION->Required) {
            if (!$this->NO_REGISTRATION->IsDetailKey && EmptyValue($this->NO_REGISTRATION->FormValue)) {
                $this->NO_REGISTRATION->addErrorMessage(str_replace("%s", $this->NO_REGISTRATION->caption(), $this->NO_REGISTRATION->RequiredErrorMessage));
            }
        }
        if ($this->NAME_OF_PASIEN->Required) {
            if (!$this->NAME_OF_PASIEN->IsDetailKey && EmptyValue($this->NAME_OF_PASIEN->FormValue)) {
                $this->NAME_OF_PASIEN->addErrorMessage(str_replace("%s", $this->NAME_OF_PASIEN->caption(), $this->NAME_OF_PASIEN->RequiredErrorMessage));
            }
        }
        if ($this->PASIEN_ID->Required) {
            if (!$this->PASIEN_ID->IsDetailKey && EmptyValue($this->PASIEN_ID->FormValue)) {
                $this->PASIEN_ID->addErrorMessage(str_replace("%s", $this->PASIEN_ID->caption(), $this->PASIEN_ID->RequiredErrorMessage));
            }
        }
        if ($this->KK_NO->Required) {
            if (!$this->KK_NO->IsDetailKey && EmptyValue($this->KK_NO->FormValue)) {
                $this->KK_NO->addErrorMessage(str_replace("%s", $this->KK_NO->caption(), $this->KK_NO->RequiredErrorMessage));
            }
        }
        if ($this->PLACE_OF_BIRTH->Required) {
            if (!$this->PLACE_OF_BIRTH->IsDetailKey && EmptyValue($this->PLACE_OF_BIRTH->FormValue)) {
                $this->PLACE_OF_BIRTH->addErrorMessage(str_replace("%s", $this->PLACE_OF_BIRTH->caption(), $this->PLACE_OF_BIRTH->RequiredErrorMessage));
            }
        }
        if ($this->DATE_OF_BIRTH->Required) {
            if (!$this->DATE_OF_BIRTH->IsDetailKey && EmptyValue($this->DATE_OF_BIRTH->FormValue)) {
                $this->DATE_OF_BIRTH->addErrorMessage(str_replace("%s", $this->DATE_OF_BIRTH->caption(), $this->DATE_OF_BIRTH->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->DATE_OF_BIRTH->FormValue)) {
            $this->DATE_OF_BIRTH->addErrorMessage($this->DATE_OF_BIRTH->getErrorMessage(false));
        }
        if ($this->GENDER->Required) {
            if ($this->GENDER->FormValue == "") {
                $this->GENDER->addErrorMessage(str_replace("%s", $this->GENDER->caption(), $this->GENDER->RequiredErrorMessage));
            }
        }
        if ($this->EDUCATION_TYPE_CODE->Required) {
            if (!$this->EDUCATION_TYPE_CODE->IsDetailKey && EmptyValue($this->EDUCATION_TYPE_CODE->FormValue)) {
                $this->EDUCATION_TYPE_CODE->addErrorMessage(str_replace("%s", $this->EDUCATION_TYPE_CODE->caption(), $this->EDUCATION_TYPE_CODE->RequiredErrorMessage));
            }
        }
        if ($this->MARITALSTATUSID->Required) {
            if (!$this->MARITALSTATUSID->IsDetailKey && EmptyValue($this->MARITALSTATUSID->FormValue)) {
                $this->MARITALSTATUSID->addErrorMessage(str_replace("%s", $this->MARITALSTATUSID->caption(), $this->MARITALSTATUSID->RequiredErrorMessage));
            }
        }
        if ($this->KODE_AGAMA->Required) {
            if (!$this->KODE_AGAMA->IsDetailKey && EmptyValue($this->KODE_AGAMA->FormValue)) {
                $this->KODE_AGAMA->addErrorMessage(str_replace("%s", $this->KODE_AGAMA->caption(), $this->KODE_AGAMA->RequiredErrorMessage));
            }
        }
        if ($this->KAL_ID->Required) {
            if (!$this->KAL_ID->IsDetailKey && EmptyValue($this->KAL_ID->FormValue)) {
                $this->KAL_ID->addErrorMessage(str_replace("%s", $this->KAL_ID->caption(), $this->KAL_ID->RequiredErrorMessage));
            }
        }
        if ($this->JOB_ID->Required) {
            if (!$this->JOB_ID->IsDetailKey && EmptyValue($this->JOB_ID->FormValue)) {
                $this->JOB_ID->addErrorMessage(str_replace("%s", $this->JOB_ID->caption(), $this->JOB_ID->RequiredErrorMessage));
            }
        }
        if ($this->STATUS_PASIEN_ID->Required) {
            if (!$this->STATUS_PASIEN_ID->IsDetailKey && EmptyValue($this->STATUS_PASIEN_ID->FormValue)) {
                $this->STATUS_PASIEN_ID->addErrorMessage(str_replace("%s", $this->STATUS_PASIEN_ID->caption(), $this->STATUS_PASIEN_ID->RequiredErrorMessage));
            }
        }
        if ($this->CONTACT_ADDRESS->Required) {
            if (!$this->CONTACT_ADDRESS->IsDetailKey && EmptyValue($this->CONTACT_ADDRESS->FormValue)) {
                $this->CONTACT_ADDRESS->addErrorMessage(str_replace("%s", $this->CONTACT_ADDRESS->caption(), $this->CONTACT_ADDRESS->RequiredErrorMessage));
            }
        }
        if ($this->PHONE_NUMBER->Required) {
            if (!$this->PHONE_NUMBER->IsDetailKey && EmptyValue($this->PHONE_NUMBER->FormValue)) {
                $this->PHONE_NUMBER->addErrorMessage(str_replace("%s", $this->PHONE_NUMBER->caption(), $this->PHONE_NUMBER->RequiredErrorMessage));
            }
        }
        if ($this->MOBILE->Required) {
            if (!$this->MOBILE->IsDetailKey && EmptyValue($this->MOBILE->FormValue)) {
                $this->MOBILE->addErrorMessage(str_replace("%s", $this->MOBILE->caption(), $this->MOBILE->RequiredErrorMessage));
            }
        }
        if ($this->PAYOR_ID->Required) {
            if (!$this->PAYOR_ID->IsDetailKey && EmptyValue($this->PAYOR_ID->FormValue)) {
                $this->PAYOR_ID->addErrorMessage(str_replace("%s", $this->PAYOR_ID->caption(), $this->PAYOR_ID->RequiredErrorMessage));
            }
        }
        if ($this->MOTHER->Required) {
            if (!$this->MOTHER->IsDetailKey && EmptyValue($this->MOTHER->FormValue)) {
                $this->MOTHER->addErrorMessage(str_replace("%s", $this->MOTHER->caption(), $this->MOTHER->RequiredErrorMessage));
            }
        }
        if ($this->FATHER->Required) {
            if (!$this->FATHER->IsDetailKey && EmptyValue($this->FATHER->FormValue)) {
                $this->FATHER->addErrorMessage(str_replace("%s", $this->FATHER->caption(), $this->FATHER->RequiredErrorMessage));
            }
        }
        if ($this->SPOUSE->Required) {
            if (!$this->SPOUSE->IsDetailKey && EmptyValue($this->SPOUSE->FormValue)) {
                $this->SPOUSE->addErrorMessage(str_replace("%s", $this->SPOUSE->caption(), $this->SPOUSE->RequiredErrorMessage));
            }
        }
        if ($this->ORG_ID->Required) {
            if (!$this->ORG_ID->IsDetailKey && EmptyValue($this->ORG_ID->FormValue)) {
                $this->ORG_ID->addErrorMessage(str_replace("%s", $this->ORG_ID->caption(), $this->ORG_ID->RequiredErrorMessage));
            }
        }
        if ($this->AKTIF->Required) {
            if (!$this->AKTIF->IsDetailKey && EmptyValue($this->AKTIF->FormValue)) {
                $this->AKTIF->addErrorMessage(str_replace("%s", $this->AKTIF->caption(), $this->AKTIF->RequiredErrorMessage));
            }
        }
        if ($this->CLASS_ID->Required) {
            if (!$this->CLASS_ID->IsDetailKey && EmptyValue($this->CLASS_ID->FormValue)) {
                $this->CLASS_ID->addErrorMessage(str_replace("%s", $this->CLASS_ID->caption(), $this->CLASS_ID->RequiredErrorMessage));
            }
        }
        if ($this->COVERAGE_ID->Required) {
            if (!$this->COVERAGE_ID->IsDetailKey && EmptyValue($this->COVERAGE_ID->FormValue)) {
                $this->COVERAGE_ID->addErrorMessage(str_replace("%s", $this->COVERAGE_ID->caption(), $this->COVERAGE_ID->RequiredErrorMessage));
            }
        }
        if ($this->FAMILY_STATUS_ID->Required) {
            if (!$this->FAMILY_STATUS_ID->IsDetailKey && EmptyValue($this->FAMILY_STATUS_ID->FormValue)) {
                $this->FAMILY_STATUS_ID->addErrorMessage(str_replace("%s", $this->FAMILY_STATUS_ID->caption(), $this->FAMILY_STATUS_ID->RequiredErrorMessage));
            }
        }
        if ($this->TMT->Required) {
            if (!$this->TMT->IsDetailKey && EmptyValue($this->TMT->FormValue)) {
                $this->TMT->addErrorMessage(str_replace("%s", $this->TMT->caption(), $this->TMT->RequiredErrorMessage));
            }
        }
        if ($this->TAT->Required) {
            if (!$this->TAT->IsDetailKey && EmptyValue($this->TAT->FormValue)) {
                $this->TAT->addErrorMessage(str_replace("%s", $this->TAT->caption(), $this->TAT->RequiredErrorMessage));
            }
        }
        if ($this->REGISTRATION_DATE->Required) {
            if (!$this->REGISTRATION_DATE->IsDetailKey && EmptyValue($this->REGISTRATION_DATE->FormValue)) {
                $this->REGISTRATION_DATE->addErrorMessage(str_replace("%s", $this->REGISTRATION_DATE->caption(), $this->REGISTRATION_DATE->RequiredErrorMessage));
            }
        }
        if ($this->MEDICAL_NOTES->Required) {
            if (!$this->MEDICAL_NOTES->IsDetailKey && EmptyValue($this->MEDICAL_NOTES->FormValue)) {
                $this->MEDICAL_NOTES->addErrorMessage(str_replace("%s", $this->MEDICAL_NOTES->caption(), $this->MEDICAL_NOTES->RequiredErrorMessage));
            }
        }
        if ($this->Cek->Required) {
            if (!$this->Cek->IsDetailKey && EmptyValue($this->Cek->FormValue)) {
                $this->Cek->addErrorMessage(str_replace("%s", $this->Cek->caption(), $this->Cek->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssoc($sql);
        $editRow = false;
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->setDbValueDef($rsnew, $this->NAME_OF_PASIEN->CurrentValue, null, $this->NAME_OF_PASIEN->ReadOnly);

            // PASIEN_ID
            $this->PASIEN_ID->setDbValueDef($rsnew, $this->PASIEN_ID->CurrentValue, null, $this->PASIEN_ID->ReadOnly);

            // KK_NO
            $this->KK_NO->setDbValueDef($rsnew, $this->KK_NO->CurrentValue, null, $this->KK_NO->ReadOnly);

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->setDbValueDef($rsnew, $this->PLACE_OF_BIRTH->CurrentValue, null, $this->PLACE_OF_BIRTH->ReadOnly);

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->setDbValueDef($rsnew, UnFormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 11), null, $this->DATE_OF_BIRTH->ReadOnly);

            // GENDER
            $this->GENDER->setDbValueDef($rsnew, $this->GENDER->CurrentValue, null, $this->GENDER->ReadOnly);

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->setDbValueDef($rsnew, $this->EDUCATION_TYPE_CODE->CurrentValue, null, $this->EDUCATION_TYPE_CODE->ReadOnly);

            // MARITALSTATUSID
            $this->MARITALSTATUSID->setDbValueDef($rsnew, $this->MARITALSTATUSID->CurrentValue, null, $this->MARITALSTATUSID->ReadOnly);

            // KODE_AGAMA
            $this->KODE_AGAMA->setDbValueDef($rsnew, $this->KODE_AGAMA->CurrentValue, null, $this->KODE_AGAMA->ReadOnly);

            // KAL_ID
            $this->KAL_ID->setDbValueDef($rsnew, $this->KAL_ID->CurrentValue, null, $this->KAL_ID->ReadOnly);

            // JOB_ID
            $this->JOB_ID->setDbValueDef($rsnew, $this->JOB_ID->CurrentValue, null, $this->JOB_ID->ReadOnly);

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->setDbValueDef($rsnew, $this->STATUS_PASIEN_ID->CurrentValue, null, $this->STATUS_PASIEN_ID->ReadOnly);

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->setDbValueDef($rsnew, $this->CONTACT_ADDRESS->CurrentValue, null, $this->CONTACT_ADDRESS->ReadOnly);

            // PHONE_NUMBER
            $this->PHONE_NUMBER->setDbValueDef($rsnew, $this->PHONE_NUMBER->CurrentValue, null, $this->PHONE_NUMBER->ReadOnly);

            // MOBILE
            $this->MOBILE->setDbValueDef($rsnew, $this->MOBILE->CurrentValue, null, $this->MOBILE->ReadOnly);

            // PAYOR_ID
            $this->PAYOR_ID->setDbValueDef($rsnew, $this->PAYOR_ID->CurrentValue, null, $this->PAYOR_ID->ReadOnly);

            // MOTHER
            $this->MOTHER->setDbValueDef($rsnew, $this->MOTHER->CurrentValue, null, $this->MOTHER->ReadOnly);

            // FATHER
            $this->FATHER->setDbValueDef($rsnew, $this->FATHER->CurrentValue, null, $this->FATHER->ReadOnly);

            // SPOUSE
            $this->SPOUSE->setDbValueDef($rsnew, $this->SPOUSE->CurrentValue, null, $this->SPOUSE->ReadOnly);

            // CLASS_ID
            $this->CLASS_ID->setDbValueDef($rsnew, $this->CLASS_ID->CurrentValue, null, $this->CLASS_ID->ReadOnly);

            // COVERAGE_ID
            $this->COVERAGE_ID->setDbValueDef($rsnew, $this->COVERAGE_ID->CurrentValue, null, $this->COVERAGE_ID->ReadOnly);

            // MEDICAL_NOTES
            $this->MEDICAL_NOTES->setDbValueDef($rsnew, $this->MEDICAL_NOTES->CurrentValue, null, $this->MEDICAL_NOTES->ReadOnly);

            // Cek
            $this->Cek->setDbValueDef($rsnew, $this->Cek->CurrentValue, "", $this->Cek->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    try {
                        $editRow = $this->update($rsnew, "", $rsold);
                    } catch (\Exception $e) {
                        $this->setFailureMessage($e->getMessage());
                    }
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PasienList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_GENDER":
                    $lookupFilter = function () {
                        return "[GENDER] = 1 OR [GENDER] = 2";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_EDUCATION_TYPE_CODE":
                    break;
                case "x_MARITALSTATUSID":
                    break;
                case "x_KODE_AGAMA":
                    break;
                case "x_KAL_ID":
                    break;
                case "x_JOB_ID":
                    break;
                case "x_STATUS_PASIEN_ID":
                    $lookupFilter = function () {
                        return "[ISACTIVE] = 1";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_BLOOD_TYPE_ID":
                    break;
                case "x_PAYOR_ID":
                    break;
                case "x_AKTIF":
                    break;
                case "x_CLASS_ID":
                    break;
                case "x_COVERAGE_ID":
                    break;
                case "x_FAMILY_STATUS_ID":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
