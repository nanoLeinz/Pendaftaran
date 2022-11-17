<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class FamilyAdd extends Family
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'FAMILY';

    // Page object name
    public $PageObjName = "FamilyAdd";

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

        // Table object (FAMILY)
        if (!isset($GLOBALS["FAMILY"]) || get_class($GLOBALS["FAMILY"]) == PROJECT_NAMESPACE . "FAMILY") {
            $GLOBALS["FAMILY"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'FAMILY');
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
                $doc = new $class(Container("FAMILY"));
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
                    if ($pageName == "FamilyView") {
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
            $key .= @$ar['ORG_UNIT_CODE'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['NO_REGISTRATION'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['FAMILY_ID'];
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->ORG_UNIT_CODE->setVisibility();
        $this->NO_REGISTRATION->setVisibility();
        $this->FAMILY_ID->setVisibility();
        $this->FAMILY_STATUS_ID->setVisibility();
        $this->NO_REGISTRATION2->setVisibility();
        $this->FULLNAME->setVisibility();
        $this->ISRESPONSIBLE->setVisibility();
        $this->GENDER->setVisibility();
        $this->DATE_OF_BIRTH->setVisibility();
        $this->PLACE_OF_BIRTH->setVisibility();
        $this->KODE_AGAMA->setVisibility();
        $this->EDUCATION_TYPE_CODE->setVisibility();
        $this->JOB_ID->setVisibility();
        $this->BLOOD_ID->setVisibility();
        $this->MARITALSTATUSID->setVisibility();
        $this->ADDRESS->setVisibility();
        $this->KOTA->setVisibility();
        $this->RT->setVisibility();
        $this->RW->setVisibility();
        $this->PHONE->setVisibility();
        $this->MOBILE->setVisibility();
        $this->FAX->setVisibility();
        $this->_EMAIL->setVisibility();
        $this->DESCRIPTION->setVisibility();
        $this->MODIFIED_DATE->setVisibility();
        $this->MODIFIED_BY->setVisibility();
        $this->MODIFIED_FROM->setVisibility();
        $this->COUNTRY_CODE->setVisibility();
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

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
                $this->ORG_UNIT_CODE->setQueryStringValue($keyValue);
            }
            if (($keyValue = Get("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
                $this->NO_REGISTRATION->setQueryStringValue($keyValue);
            }
            if (($keyValue = Get("FAMILY_ID") ?? Route("FAMILY_ID")) !== null) {
                $this->FAMILY_ID->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("FamilyList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "FamilyList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "FamilyView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues()
    {
        $this->ORG_UNIT_CODE->CurrentValue = null;
        $this->ORG_UNIT_CODE->OldValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->NO_REGISTRATION->CurrentValue = null;
        $this->NO_REGISTRATION->OldValue = $this->NO_REGISTRATION->CurrentValue;
        $this->FAMILY_ID->CurrentValue = null;
        $this->FAMILY_ID->OldValue = $this->FAMILY_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->CurrentValue = 0;
        $this->NO_REGISTRATION2->CurrentValue = null;
        $this->NO_REGISTRATION2->OldValue = $this->NO_REGISTRATION2->CurrentValue;
        $this->FULLNAME->CurrentValue = null;
        $this->FULLNAME->OldValue = $this->FULLNAME->CurrentValue;
        $this->ISRESPONSIBLE->CurrentValue = null;
        $this->ISRESPONSIBLE->OldValue = $this->ISRESPONSIBLE->CurrentValue;
        $this->GENDER->CurrentValue = null;
        $this->GENDER->OldValue = $this->GENDER->CurrentValue;
        $this->DATE_OF_BIRTH->CurrentValue = null;
        $this->DATE_OF_BIRTH->OldValue = $this->DATE_OF_BIRTH->CurrentValue;
        $this->PLACE_OF_BIRTH->CurrentValue = null;
        $this->PLACE_OF_BIRTH->OldValue = $this->PLACE_OF_BIRTH->CurrentValue;
        $this->KODE_AGAMA->CurrentValue = null;
        $this->KODE_AGAMA->OldValue = $this->KODE_AGAMA->CurrentValue;
        $this->EDUCATION_TYPE_CODE->CurrentValue = null;
        $this->EDUCATION_TYPE_CODE->OldValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
        $this->JOB_ID->CurrentValue = null;
        $this->JOB_ID->OldValue = $this->JOB_ID->CurrentValue;
        $this->BLOOD_ID->CurrentValue = null;
        $this->BLOOD_ID->OldValue = $this->BLOOD_ID->CurrentValue;
        $this->MARITALSTATUSID->CurrentValue = null;
        $this->MARITALSTATUSID->OldValue = $this->MARITALSTATUSID->CurrentValue;
        $this->ADDRESS->CurrentValue = null;
        $this->ADDRESS->OldValue = $this->ADDRESS->CurrentValue;
        $this->KOTA->CurrentValue = null;
        $this->KOTA->OldValue = $this->KOTA->CurrentValue;
        $this->RT->CurrentValue = null;
        $this->RT->OldValue = $this->RT->CurrentValue;
        $this->RW->CurrentValue = null;
        $this->RW->OldValue = $this->RW->CurrentValue;
        $this->PHONE->CurrentValue = null;
        $this->PHONE->OldValue = $this->PHONE->CurrentValue;
        $this->MOBILE->CurrentValue = null;
        $this->MOBILE->OldValue = $this->MOBILE->CurrentValue;
        $this->FAX->CurrentValue = null;
        $this->FAX->OldValue = $this->FAX->CurrentValue;
        $this->_EMAIL->CurrentValue = null;
        $this->_EMAIL->OldValue = $this->_EMAIL->CurrentValue;
        $this->DESCRIPTION->CurrentValue = null;
        $this->DESCRIPTION->OldValue = $this->DESCRIPTION->CurrentValue;
        $this->MODIFIED_DATE->CurrentValue = null;
        $this->MODIFIED_DATE->OldValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_BY->CurrentValue = null;
        $this->MODIFIED_BY->OldValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_FROM->CurrentValue = null;
        $this->MODIFIED_FROM->OldValue = $this->MODIFIED_FROM->CurrentValue;
        $this->COUNTRY_CODE->CurrentValue = null;
        $this->COUNTRY_CODE->OldValue = $this->COUNTRY_CODE->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'ORG_UNIT_CODE' first before field var 'x_ORG_UNIT_CODE'
        $val = $CurrentForm->hasValue("ORG_UNIT_CODE") ? $CurrentForm->getValue("ORG_UNIT_CODE") : $CurrentForm->getValue("x_ORG_UNIT_CODE");
        if (!$this->ORG_UNIT_CODE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ORG_UNIT_CODE->Visible = false; // Disable update for API request
            } else {
                $this->ORG_UNIT_CODE->setFormValue($val);
            }
        }

        // Check field name 'NO_REGISTRATION' first before field var 'x_NO_REGISTRATION'
        $val = $CurrentForm->hasValue("NO_REGISTRATION") ? $CurrentForm->getValue("NO_REGISTRATION") : $CurrentForm->getValue("x_NO_REGISTRATION");
        if (!$this->NO_REGISTRATION->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_REGISTRATION->Visible = false; // Disable update for API request
            } else {
                $this->NO_REGISTRATION->setFormValue($val);
            }
        }

        // Check field name 'FAMILY_ID' first before field var 'x_FAMILY_ID'
        $val = $CurrentForm->hasValue("FAMILY_ID") ? $CurrentForm->getValue("FAMILY_ID") : $CurrentForm->getValue("x_FAMILY_ID");
        if (!$this->FAMILY_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FAMILY_ID->Visible = false; // Disable update for API request
            } else {
                $this->FAMILY_ID->setFormValue($val);
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

        // Check field name 'NO_REGISTRATION2' first before field var 'x_NO_REGISTRATION2'
        $val = $CurrentForm->hasValue("NO_REGISTRATION2") ? $CurrentForm->getValue("NO_REGISTRATION2") : $CurrentForm->getValue("x_NO_REGISTRATION2");
        if (!$this->NO_REGISTRATION2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_REGISTRATION2->Visible = false; // Disable update for API request
            } else {
                $this->NO_REGISTRATION2->setFormValue($val);
            }
        }

        // Check field name 'FULLNAME' first before field var 'x_FULLNAME'
        $val = $CurrentForm->hasValue("FULLNAME") ? $CurrentForm->getValue("FULLNAME") : $CurrentForm->getValue("x_FULLNAME");
        if (!$this->FULLNAME->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FULLNAME->Visible = false; // Disable update for API request
            } else {
                $this->FULLNAME->setFormValue($val);
            }
        }

        // Check field name 'ISRESPONSIBLE' first before field var 'x_ISRESPONSIBLE'
        $val = $CurrentForm->hasValue("ISRESPONSIBLE") ? $CurrentForm->getValue("ISRESPONSIBLE") : $CurrentForm->getValue("x_ISRESPONSIBLE");
        if (!$this->ISRESPONSIBLE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ISRESPONSIBLE->Visible = false; // Disable update for API request
            } else {
                $this->ISRESPONSIBLE->setFormValue($val);
            }
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

        // Check field name 'DATE_OF_BIRTH' first before field var 'x_DATE_OF_BIRTH'
        $val = $CurrentForm->hasValue("DATE_OF_BIRTH") ? $CurrentForm->getValue("DATE_OF_BIRTH") : $CurrentForm->getValue("x_DATE_OF_BIRTH");
        if (!$this->DATE_OF_BIRTH->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DATE_OF_BIRTH->Visible = false; // Disable update for API request
            } else {
                $this->DATE_OF_BIRTH->setFormValue($val);
            }
            $this->DATE_OF_BIRTH->CurrentValue = UnFormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 0);
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

        // Check field name 'KODE_AGAMA' first before field var 'x_KODE_AGAMA'
        $val = $CurrentForm->hasValue("KODE_AGAMA") ? $CurrentForm->getValue("KODE_AGAMA") : $CurrentForm->getValue("x_KODE_AGAMA");
        if (!$this->KODE_AGAMA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KODE_AGAMA->Visible = false; // Disable update for API request
            } else {
                $this->KODE_AGAMA->setFormValue($val);
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

        // Check field name 'JOB_ID' first before field var 'x_JOB_ID'
        $val = $CurrentForm->hasValue("JOB_ID") ? $CurrentForm->getValue("JOB_ID") : $CurrentForm->getValue("x_JOB_ID");
        if (!$this->JOB_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->JOB_ID->Visible = false; // Disable update for API request
            } else {
                $this->JOB_ID->setFormValue($val);
            }
        }

        // Check field name 'BLOOD_ID' first before field var 'x_BLOOD_ID'
        $val = $CurrentForm->hasValue("BLOOD_ID") ? $CurrentForm->getValue("BLOOD_ID") : $CurrentForm->getValue("x_BLOOD_ID");
        if (!$this->BLOOD_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->BLOOD_ID->Visible = false; // Disable update for API request
            } else {
                $this->BLOOD_ID->setFormValue($val);
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

        // Check field name 'ADDRESS' first before field var 'x_ADDRESS'
        $val = $CurrentForm->hasValue("ADDRESS") ? $CurrentForm->getValue("ADDRESS") : $CurrentForm->getValue("x_ADDRESS");
        if (!$this->ADDRESS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ADDRESS->Visible = false; // Disable update for API request
            } else {
                $this->ADDRESS->setFormValue($val);
            }
        }

        // Check field name 'KOTA' first before field var 'x_KOTA'
        $val = $CurrentForm->hasValue("KOTA") ? $CurrentForm->getValue("KOTA") : $CurrentForm->getValue("x_KOTA");
        if (!$this->KOTA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KOTA->Visible = false; // Disable update for API request
            } else {
                $this->KOTA->setFormValue($val);
            }
        }

        // Check field name 'RT' first before field var 'x_RT'
        $val = $CurrentForm->hasValue("RT") ? $CurrentForm->getValue("RT") : $CurrentForm->getValue("x_RT");
        if (!$this->RT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->RT->Visible = false; // Disable update for API request
            } else {
                $this->RT->setFormValue($val);
            }
        }

        // Check field name 'RW' first before field var 'x_RW'
        $val = $CurrentForm->hasValue("RW") ? $CurrentForm->getValue("RW") : $CurrentForm->getValue("x_RW");
        if (!$this->RW->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->RW->Visible = false; // Disable update for API request
            } else {
                $this->RW->setFormValue($val);
            }
        }

        // Check field name 'PHONE' first before field var 'x_PHONE'
        $val = $CurrentForm->hasValue("PHONE") ? $CurrentForm->getValue("PHONE") : $CurrentForm->getValue("x_PHONE");
        if (!$this->PHONE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PHONE->Visible = false; // Disable update for API request
            } else {
                $this->PHONE->setFormValue($val);
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

        // Check field name 'FAX' first before field var 'x_FAX'
        $val = $CurrentForm->hasValue("FAX") ? $CurrentForm->getValue("FAX") : $CurrentForm->getValue("x_FAX");
        if (!$this->FAX->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FAX->Visible = false; // Disable update for API request
            } else {
                $this->FAX->setFormValue($val);
            }
        }

        // Check field name 'EMAIL' first before field var 'x__EMAIL'
        $val = $CurrentForm->hasValue("EMAIL") ? $CurrentForm->getValue("EMAIL") : $CurrentForm->getValue("x__EMAIL");
        if (!$this->_EMAIL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_EMAIL->Visible = false; // Disable update for API request
            } else {
                $this->_EMAIL->setFormValue($val);
            }
        }

        // Check field name 'DESCRIPTION' first before field var 'x_DESCRIPTION'
        $val = $CurrentForm->hasValue("DESCRIPTION") ? $CurrentForm->getValue("DESCRIPTION") : $CurrentForm->getValue("x_DESCRIPTION");
        if (!$this->DESCRIPTION->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DESCRIPTION->Visible = false; // Disable update for API request
            } else {
                $this->DESCRIPTION->setFormValue($val);
            }
        }

        // Check field name 'MODIFIED_DATE' first before field var 'x_MODIFIED_DATE'
        $val = $CurrentForm->hasValue("MODIFIED_DATE") ? $CurrentForm->getValue("MODIFIED_DATE") : $CurrentForm->getValue("x_MODIFIED_DATE");
        if (!$this->MODIFIED_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MODIFIED_DATE->Visible = false; // Disable update for API request
            } else {
                $this->MODIFIED_DATE->setFormValue($val);
            }
            $this->MODIFIED_DATE->CurrentValue = UnFormatDateTime($this->MODIFIED_DATE->CurrentValue, 0);
        }

        // Check field name 'MODIFIED_BY' first before field var 'x_MODIFIED_BY'
        $val = $CurrentForm->hasValue("MODIFIED_BY") ? $CurrentForm->getValue("MODIFIED_BY") : $CurrentForm->getValue("x_MODIFIED_BY");
        if (!$this->MODIFIED_BY->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MODIFIED_BY->Visible = false; // Disable update for API request
            } else {
                $this->MODIFIED_BY->setFormValue($val);
            }
        }

        // Check field name 'MODIFIED_FROM' first before field var 'x_MODIFIED_FROM'
        $val = $CurrentForm->hasValue("MODIFIED_FROM") ? $CurrentForm->getValue("MODIFIED_FROM") : $CurrentForm->getValue("x_MODIFIED_FROM");
        if (!$this->MODIFIED_FROM->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MODIFIED_FROM->Visible = false; // Disable update for API request
            } else {
                $this->MODIFIED_FROM->setFormValue($val);
            }
        }

        // Check field name 'COUNTRY_CODE' first before field var 'x_COUNTRY_CODE'
        $val = $CurrentForm->hasValue("COUNTRY_CODE") ? $CurrentForm->getValue("COUNTRY_CODE") : $CurrentForm->getValue("x_COUNTRY_CODE");
        if (!$this->COUNTRY_CODE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->COUNTRY_CODE->Visible = false; // Disable update for API request
            } else {
                $this->COUNTRY_CODE->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ORG_UNIT_CODE->CurrentValue = $this->ORG_UNIT_CODE->FormValue;
        $this->NO_REGISTRATION->CurrentValue = $this->NO_REGISTRATION->FormValue;
        $this->FAMILY_ID->CurrentValue = $this->FAMILY_ID->FormValue;
        $this->FAMILY_STATUS_ID->CurrentValue = $this->FAMILY_STATUS_ID->FormValue;
        $this->NO_REGISTRATION2->CurrentValue = $this->NO_REGISTRATION2->FormValue;
        $this->FULLNAME->CurrentValue = $this->FULLNAME->FormValue;
        $this->ISRESPONSIBLE->CurrentValue = $this->ISRESPONSIBLE->FormValue;
        $this->GENDER->CurrentValue = $this->GENDER->FormValue;
        $this->DATE_OF_BIRTH->CurrentValue = $this->DATE_OF_BIRTH->FormValue;
        $this->DATE_OF_BIRTH->CurrentValue = UnFormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 0);
        $this->PLACE_OF_BIRTH->CurrentValue = $this->PLACE_OF_BIRTH->FormValue;
        $this->KODE_AGAMA->CurrentValue = $this->KODE_AGAMA->FormValue;
        $this->EDUCATION_TYPE_CODE->CurrentValue = $this->EDUCATION_TYPE_CODE->FormValue;
        $this->JOB_ID->CurrentValue = $this->JOB_ID->FormValue;
        $this->BLOOD_ID->CurrentValue = $this->BLOOD_ID->FormValue;
        $this->MARITALSTATUSID->CurrentValue = $this->MARITALSTATUSID->FormValue;
        $this->ADDRESS->CurrentValue = $this->ADDRESS->FormValue;
        $this->KOTA->CurrentValue = $this->KOTA->FormValue;
        $this->RT->CurrentValue = $this->RT->FormValue;
        $this->RW->CurrentValue = $this->RW->FormValue;
        $this->PHONE->CurrentValue = $this->PHONE->FormValue;
        $this->MOBILE->CurrentValue = $this->MOBILE->FormValue;
        $this->FAX->CurrentValue = $this->FAX->FormValue;
        $this->_EMAIL->CurrentValue = $this->_EMAIL->FormValue;
        $this->DESCRIPTION->CurrentValue = $this->DESCRIPTION->FormValue;
        $this->MODIFIED_DATE->CurrentValue = $this->MODIFIED_DATE->FormValue;
        $this->MODIFIED_DATE->CurrentValue = UnFormatDateTime($this->MODIFIED_DATE->CurrentValue, 0);
        $this->MODIFIED_BY->CurrentValue = $this->MODIFIED_BY->FormValue;
        $this->MODIFIED_FROM->CurrentValue = $this->MODIFIED_FROM->FormValue;
        $this->COUNTRY_CODE->CurrentValue = $this->COUNTRY_CODE->FormValue;
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
        $this->FAMILY_ID->setDbValue($row['FAMILY_ID']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->NO_REGISTRATION2->setDbValue($row['NO_REGISTRATION2']);
        $this->FULLNAME->setDbValue($row['FULLNAME']);
        $this->ISRESPONSIBLE->setDbValue($row['ISRESPONSIBLE']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DATE_OF_BIRTH->setDbValue($row['DATE_OF_BIRTH']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->EDUCATION_TYPE_CODE->setDbValue($row['EDUCATION_TYPE_CODE']);
        $this->JOB_ID->setDbValue($row['JOB_ID']);
        $this->BLOOD_ID->setDbValue($row['BLOOD_ID']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->ADDRESS->setDbValue($row['ADDRESS']);
        $this->KOTA->setDbValue($row['KOTA']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->FAX->setDbValue($row['FAX']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->COUNTRY_CODE->setDbValue($row['COUNTRY_CODE']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['ORG_UNIT_CODE'] = $this->ORG_UNIT_CODE->CurrentValue;
        $row['NO_REGISTRATION'] = $this->NO_REGISTRATION->CurrentValue;
        $row['FAMILY_ID'] = $this->FAMILY_ID->CurrentValue;
        $row['FAMILY_STATUS_ID'] = $this->FAMILY_STATUS_ID->CurrentValue;
        $row['NO_REGISTRATION2'] = $this->NO_REGISTRATION2->CurrentValue;
        $row['FULLNAME'] = $this->FULLNAME->CurrentValue;
        $row['ISRESPONSIBLE'] = $this->ISRESPONSIBLE->CurrentValue;
        $row['GENDER'] = $this->GENDER->CurrentValue;
        $row['DATE_OF_BIRTH'] = $this->DATE_OF_BIRTH->CurrentValue;
        $row['PLACE_OF_BIRTH'] = $this->PLACE_OF_BIRTH->CurrentValue;
        $row['KODE_AGAMA'] = $this->KODE_AGAMA->CurrentValue;
        $row['EDUCATION_TYPE_CODE'] = $this->EDUCATION_TYPE_CODE->CurrentValue;
        $row['JOB_ID'] = $this->JOB_ID->CurrentValue;
        $row['BLOOD_ID'] = $this->BLOOD_ID->CurrentValue;
        $row['MARITALSTATUSID'] = $this->MARITALSTATUSID->CurrentValue;
        $row['ADDRESS'] = $this->ADDRESS->CurrentValue;
        $row['KOTA'] = $this->KOTA->CurrentValue;
        $row['RT'] = $this->RT->CurrentValue;
        $row['RW'] = $this->RW->CurrentValue;
        $row['PHONE'] = $this->PHONE->CurrentValue;
        $row['MOBILE'] = $this->MOBILE->CurrentValue;
        $row['FAX'] = $this->FAX->CurrentValue;
        $row['EMAIL'] = $this->_EMAIL->CurrentValue;
        $row['DESCRIPTION'] = $this->DESCRIPTION->CurrentValue;
        $row['MODIFIED_DATE'] = $this->MODIFIED_DATE->CurrentValue;
        $row['MODIFIED_BY'] = $this->MODIFIED_BY->CurrentValue;
        $row['MODIFIED_FROM'] = $this->MODIFIED_FROM->CurrentValue;
        $row['COUNTRY_CODE'] = $this->COUNTRY_CODE->CurrentValue;
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

        // FAMILY_ID

        // FAMILY_STATUS_ID

        // NO_REGISTRATION2

        // FULLNAME

        // ISRESPONSIBLE

        // GENDER

        // DATE_OF_BIRTH

        // PLACE_OF_BIRTH

        // KODE_AGAMA

        // EDUCATION_TYPE_CODE

        // JOB_ID

        // BLOOD_ID

        // MARITALSTATUSID

        // ADDRESS

        // KOTA

        // RT

        // RW

        // PHONE

        // MOBILE

        // FAX

        // EMAIL

        // DESCRIPTION

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // COUNTRY_CODE
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // FAMILY_ID
            $this->FAMILY_ID->ViewValue = $this->FAMILY_ID->CurrentValue;
            $this->FAMILY_ID->ViewValue = FormatNumber($this->FAMILY_ID->ViewValue, 0, -2, -2, -2);
            $this->FAMILY_ID->ViewCustomAttributes = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
            $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
            $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

            // NO_REGISTRATION2
            $this->NO_REGISTRATION2->ViewValue = $this->NO_REGISTRATION2->CurrentValue;
            $this->NO_REGISTRATION2->ViewCustomAttributes = "";

            // FULLNAME
            $this->FULLNAME->ViewValue = $this->FULLNAME->CurrentValue;
            $this->FULLNAME->ViewCustomAttributes = "";

            // ISRESPONSIBLE
            $this->ISRESPONSIBLE->ViewValue = $this->ISRESPONSIBLE->CurrentValue;
            $this->ISRESPONSIBLE->ViewCustomAttributes = "";

            // GENDER
            $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
            $this->GENDER->ViewCustomAttributes = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->ViewValue = $this->DATE_OF_BIRTH->CurrentValue;
            $this->DATE_OF_BIRTH->ViewValue = FormatDateTime($this->DATE_OF_BIRTH->ViewValue, 0);
            $this->DATE_OF_BIRTH->ViewCustomAttributes = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
            $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->CurrentValue;
            $this->KODE_AGAMA->ViewValue = FormatNumber($this->KODE_AGAMA->ViewValue, 0, -2, -2, -2);
            $this->KODE_AGAMA->ViewCustomAttributes = "";

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
            $this->EDUCATION_TYPE_CODE->ViewValue = FormatNumber($this->EDUCATION_TYPE_CODE->ViewValue, 0, -2, -2, -2);
            $this->EDUCATION_TYPE_CODE->ViewCustomAttributes = "";

            // JOB_ID
            $this->JOB_ID->ViewValue = $this->JOB_ID->CurrentValue;
            $this->JOB_ID->ViewValue = FormatNumber($this->JOB_ID->ViewValue, 0, -2, -2, -2);
            $this->JOB_ID->ViewCustomAttributes = "";

            // BLOOD_ID
            $this->BLOOD_ID->ViewValue = $this->BLOOD_ID->CurrentValue;
            $this->BLOOD_ID->ViewValue = FormatNumber($this->BLOOD_ID->ViewValue, 0, -2, -2, -2);
            $this->BLOOD_ID->ViewCustomAttributes = "";

            // MARITALSTATUSID
            $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
            $this->MARITALSTATUSID->ViewValue = FormatNumber($this->MARITALSTATUSID->ViewValue, 0, -2, -2, -2);
            $this->MARITALSTATUSID->ViewCustomAttributes = "";

            // ADDRESS
            $this->ADDRESS->ViewValue = $this->ADDRESS->CurrentValue;
            $this->ADDRESS->ViewCustomAttributes = "";

            // KOTA
            $this->KOTA->ViewValue = $this->KOTA->CurrentValue;
            $this->KOTA->ViewCustomAttributes = "";

            // RT
            $this->RT->ViewValue = $this->RT->CurrentValue;
            $this->RT->ViewCustomAttributes = "";

            // RW
            $this->RW->ViewValue = $this->RW->CurrentValue;
            $this->RW->ViewCustomAttributes = "";

            // PHONE
            $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
            $this->PHONE->ViewCustomAttributes = "";

            // MOBILE
            $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
            $this->MOBILE->ViewCustomAttributes = "";

            // FAX
            $this->FAX->ViewValue = $this->FAX->CurrentValue;
            $this->FAX->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
            $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
            $this->MODIFIED_DATE->ViewCustomAttributes = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
            $this->MODIFIED_BY->ViewCustomAttributes = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
            $this->MODIFIED_FROM->ViewCustomAttributes = "";

            // COUNTRY_CODE
            $this->COUNTRY_CODE->ViewValue = $this->COUNTRY_CODE->CurrentValue;
            $this->COUNTRY_CODE->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // FAMILY_ID
            $this->FAMILY_ID->LinkCustomAttributes = "";
            $this->FAMILY_ID->HrefValue = "";
            $this->FAMILY_ID->TooltipValue = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
            $this->FAMILY_STATUS_ID->HrefValue = "";
            $this->FAMILY_STATUS_ID->TooltipValue = "";

            // NO_REGISTRATION2
            $this->NO_REGISTRATION2->LinkCustomAttributes = "";
            $this->NO_REGISTRATION2->HrefValue = "";
            $this->NO_REGISTRATION2->TooltipValue = "";

            // FULLNAME
            $this->FULLNAME->LinkCustomAttributes = "";
            $this->FULLNAME->HrefValue = "";
            $this->FULLNAME->TooltipValue = "";

            // ISRESPONSIBLE
            $this->ISRESPONSIBLE->LinkCustomAttributes = "";
            $this->ISRESPONSIBLE->HrefValue = "";
            $this->ISRESPONSIBLE->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->LinkCustomAttributes = "";
            $this->DATE_OF_BIRTH->HrefValue = "";
            $this->DATE_OF_BIRTH->TooltipValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";
            $this->PLACE_OF_BIRTH->TooltipValue = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->LinkCustomAttributes = "";
            $this->KODE_AGAMA->HrefValue = "";
            $this->KODE_AGAMA->TooltipValue = "";

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->LinkCustomAttributes = "";
            $this->EDUCATION_TYPE_CODE->HrefValue = "";
            $this->EDUCATION_TYPE_CODE->TooltipValue = "";

            // JOB_ID
            $this->JOB_ID->LinkCustomAttributes = "";
            $this->JOB_ID->HrefValue = "";
            $this->JOB_ID->TooltipValue = "";

            // BLOOD_ID
            $this->BLOOD_ID->LinkCustomAttributes = "";
            $this->BLOOD_ID->HrefValue = "";
            $this->BLOOD_ID->TooltipValue = "";

            // MARITALSTATUSID
            $this->MARITALSTATUSID->LinkCustomAttributes = "";
            $this->MARITALSTATUSID->HrefValue = "";
            $this->MARITALSTATUSID->TooltipValue = "";

            // ADDRESS
            $this->ADDRESS->LinkCustomAttributes = "";
            $this->ADDRESS->HrefValue = "";
            $this->ADDRESS->TooltipValue = "";

            // KOTA
            $this->KOTA->LinkCustomAttributes = "";
            $this->KOTA->HrefValue = "";
            $this->KOTA->TooltipValue = "";

            // RT
            $this->RT->LinkCustomAttributes = "";
            $this->RT->HrefValue = "";
            $this->RT->TooltipValue = "";

            // RW
            $this->RW->LinkCustomAttributes = "";
            $this->RW->HrefValue = "";
            $this->RW->TooltipValue = "";

            // PHONE
            $this->PHONE->LinkCustomAttributes = "";
            $this->PHONE->HrefValue = "";
            $this->PHONE->TooltipValue = "";

            // MOBILE
            $this->MOBILE->LinkCustomAttributes = "";
            $this->MOBILE->HrefValue = "";
            $this->MOBILE->TooltipValue = "";

            // FAX
            $this->FAX->LinkCustomAttributes = "";
            $this->FAX->HrefValue = "";
            $this->FAX->TooltipValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";
            $this->_EMAIL->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";
            $this->DESCRIPTION->TooltipValue = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->LinkCustomAttributes = "";
            $this->MODIFIED_DATE->HrefValue = "";
            $this->MODIFIED_DATE->TooltipValue = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->LinkCustomAttributes = "";
            $this->MODIFIED_BY->HrefValue = "";
            $this->MODIFIED_BY->TooltipValue = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->LinkCustomAttributes = "";
            $this->MODIFIED_FROM->HrefValue = "";
            $this->MODIFIED_FROM->TooltipValue = "";

            // COUNTRY_CODE
            $this->COUNTRY_CODE->LinkCustomAttributes = "";
            $this->COUNTRY_CODE->HrefValue = "";
            $this->COUNTRY_CODE->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
            $this->ORG_UNIT_CODE->EditCustomAttributes = "";
            if (!$this->ORG_UNIT_CODE->Raw) {
                $this->ORG_UNIT_CODE->CurrentValue = HtmlDecode($this->ORG_UNIT_CODE->CurrentValue);
            }
            $this->ORG_UNIT_CODE->EditValue = HtmlEncode($this->ORG_UNIT_CODE->CurrentValue);
            $this->ORG_UNIT_CODE->PlaceHolder = RemoveHtml($this->ORG_UNIT_CODE->caption());

            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
            $this->NO_REGISTRATION->EditCustomAttributes = "";
            if (!$this->NO_REGISTRATION->Raw) {
                $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
            }
            $this->NO_REGISTRATION->EditValue = HtmlEncode($this->NO_REGISTRATION->CurrentValue);
            $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

            // FAMILY_ID
            $this->FAMILY_ID->EditAttrs["class"] = "form-control";
            $this->FAMILY_ID->EditCustomAttributes = "";
            $this->FAMILY_ID->EditValue = HtmlEncode($this->FAMILY_ID->CurrentValue);
            $this->FAMILY_ID->PlaceHolder = RemoveHtml($this->FAMILY_ID->caption());

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->EditAttrs["class"] = "form-control";
            $this->FAMILY_STATUS_ID->EditCustomAttributes = "";
            $this->FAMILY_STATUS_ID->EditValue = HtmlEncode($this->FAMILY_STATUS_ID->CurrentValue);
            $this->FAMILY_STATUS_ID->PlaceHolder = RemoveHtml($this->FAMILY_STATUS_ID->caption());

            // NO_REGISTRATION2
            $this->NO_REGISTRATION2->EditAttrs["class"] = "form-control";
            $this->NO_REGISTRATION2->EditCustomAttributes = "";
            if (!$this->NO_REGISTRATION2->Raw) {
                $this->NO_REGISTRATION2->CurrentValue = HtmlDecode($this->NO_REGISTRATION2->CurrentValue);
            }
            $this->NO_REGISTRATION2->EditValue = HtmlEncode($this->NO_REGISTRATION2->CurrentValue);
            $this->NO_REGISTRATION2->PlaceHolder = RemoveHtml($this->NO_REGISTRATION2->caption());

            // FULLNAME
            $this->FULLNAME->EditAttrs["class"] = "form-control";
            $this->FULLNAME->EditCustomAttributes = "";
            if (!$this->FULLNAME->Raw) {
                $this->FULLNAME->CurrentValue = HtmlDecode($this->FULLNAME->CurrentValue);
            }
            $this->FULLNAME->EditValue = HtmlEncode($this->FULLNAME->CurrentValue);
            $this->FULLNAME->PlaceHolder = RemoveHtml($this->FULLNAME->caption());

            // ISRESPONSIBLE
            $this->ISRESPONSIBLE->EditAttrs["class"] = "form-control";
            $this->ISRESPONSIBLE->EditCustomAttributes = "";
            if (!$this->ISRESPONSIBLE->Raw) {
                $this->ISRESPONSIBLE->CurrentValue = HtmlDecode($this->ISRESPONSIBLE->CurrentValue);
            }
            $this->ISRESPONSIBLE->EditValue = HtmlEncode($this->ISRESPONSIBLE->CurrentValue);
            $this->ISRESPONSIBLE->PlaceHolder = RemoveHtml($this->ISRESPONSIBLE->caption());

            // GENDER
            $this->GENDER->EditAttrs["class"] = "form-control";
            $this->GENDER->EditCustomAttributes = "";
            if (!$this->GENDER->Raw) {
                $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
            }
            $this->GENDER->EditValue = HtmlEncode($this->GENDER->CurrentValue);
            $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->EditAttrs["class"] = "form-control";
            $this->DATE_OF_BIRTH->EditCustomAttributes = "";
            $this->DATE_OF_BIRTH->EditValue = HtmlEncode(FormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 8));
            $this->DATE_OF_BIRTH->PlaceHolder = RemoveHtml($this->DATE_OF_BIRTH->caption());

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->EditAttrs["class"] = "form-control";
            $this->PLACE_OF_BIRTH->EditCustomAttributes = "";
            if (!$this->PLACE_OF_BIRTH->Raw) {
                $this->PLACE_OF_BIRTH->CurrentValue = HtmlDecode($this->PLACE_OF_BIRTH->CurrentValue);
            }
            $this->PLACE_OF_BIRTH->EditValue = HtmlEncode($this->PLACE_OF_BIRTH->CurrentValue);
            $this->PLACE_OF_BIRTH->PlaceHolder = RemoveHtml($this->PLACE_OF_BIRTH->caption());

            // KODE_AGAMA
            $this->KODE_AGAMA->EditAttrs["class"] = "form-control";
            $this->KODE_AGAMA->EditCustomAttributes = "";
            $this->KODE_AGAMA->EditValue = HtmlEncode($this->KODE_AGAMA->CurrentValue);
            $this->KODE_AGAMA->PlaceHolder = RemoveHtml($this->KODE_AGAMA->caption());

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->EditAttrs["class"] = "form-control";
            $this->EDUCATION_TYPE_CODE->EditCustomAttributes = "";
            $this->EDUCATION_TYPE_CODE->EditValue = HtmlEncode($this->EDUCATION_TYPE_CODE->CurrentValue);
            $this->EDUCATION_TYPE_CODE->PlaceHolder = RemoveHtml($this->EDUCATION_TYPE_CODE->caption());

            // JOB_ID
            $this->JOB_ID->EditAttrs["class"] = "form-control";
            $this->JOB_ID->EditCustomAttributes = "";
            $this->JOB_ID->EditValue = HtmlEncode($this->JOB_ID->CurrentValue);
            $this->JOB_ID->PlaceHolder = RemoveHtml($this->JOB_ID->caption());

            // BLOOD_ID
            $this->BLOOD_ID->EditAttrs["class"] = "form-control";
            $this->BLOOD_ID->EditCustomAttributes = "";
            $this->BLOOD_ID->EditValue = HtmlEncode($this->BLOOD_ID->CurrentValue);
            $this->BLOOD_ID->PlaceHolder = RemoveHtml($this->BLOOD_ID->caption());

            // MARITALSTATUSID
            $this->MARITALSTATUSID->EditAttrs["class"] = "form-control";
            $this->MARITALSTATUSID->EditCustomAttributes = "";
            $this->MARITALSTATUSID->EditValue = HtmlEncode($this->MARITALSTATUSID->CurrentValue);
            $this->MARITALSTATUSID->PlaceHolder = RemoveHtml($this->MARITALSTATUSID->caption());

            // ADDRESS
            $this->ADDRESS->EditAttrs["class"] = "form-control";
            $this->ADDRESS->EditCustomAttributes = "";
            if (!$this->ADDRESS->Raw) {
                $this->ADDRESS->CurrentValue = HtmlDecode($this->ADDRESS->CurrentValue);
            }
            $this->ADDRESS->EditValue = HtmlEncode($this->ADDRESS->CurrentValue);
            $this->ADDRESS->PlaceHolder = RemoveHtml($this->ADDRESS->caption());

            // KOTA
            $this->KOTA->EditAttrs["class"] = "form-control";
            $this->KOTA->EditCustomAttributes = "";
            if (!$this->KOTA->Raw) {
                $this->KOTA->CurrentValue = HtmlDecode($this->KOTA->CurrentValue);
            }
            $this->KOTA->EditValue = HtmlEncode($this->KOTA->CurrentValue);
            $this->KOTA->PlaceHolder = RemoveHtml($this->KOTA->caption());

            // RT
            $this->RT->EditAttrs["class"] = "form-control";
            $this->RT->EditCustomAttributes = "";
            if (!$this->RT->Raw) {
                $this->RT->CurrentValue = HtmlDecode($this->RT->CurrentValue);
            }
            $this->RT->EditValue = HtmlEncode($this->RT->CurrentValue);
            $this->RT->PlaceHolder = RemoveHtml($this->RT->caption());

            // RW
            $this->RW->EditAttrs["class"] = "form-control";
            $this->RW->EditCustomAttributes = "";
            if (!$this->RW->Raw) {
                $this->RW->CurrentValue = HtmlDecode($this->RW->CurrentValue);
            }
            $this->RW->EditValue = HtmlEncode($this->RW->CurrentValue);
            $this->RW->PlaceHolder = RemoveHtml($this->RW->caption());

            // PHONE
            $this->PHONE->EditAttrs["class"] = "form-control";
            $this->PHONE->EditCustomAttributes = "";
            if (!$this->PHONE->Raw) {
                $this->PHONE->CurrentValue = HtmlDecode($this->PHONE->CurrentValue);
            }
            $this->PHONE->EditValue = HtmlEncode($this->PHONE->CurrentValue);
            $this->PHONE->PlaceHolder = RemoveHtml($this->PHONE->caption());

            // MOBILE
            $this->MOBILE->EditAttrs["class"] = "form-control";
            $this->MOBILE->EditCustomAttributes = "";
            if (!$this->MOBILE->Raw) {
                $this->MOBILE->CurrentValue = HtmlDecode($this->MOBILE->CurrentValue);
            }
            $this->MOBILE->EditValue = HtmlEncode($this->MOBILE->CurrentValue);
            $this->MOBILE->PlaceHolder = RemoveHtml($this->MOBILE->caption());

            // FAX
            $this->FAX->EditAttrs["class"] = "form-control";
            $this->FAX->EditCustomAttributes = "";
            if (!$this->FAX->Raw) {
                $this->FAX->CurrentValue = HtmlDecode($this->FAX->CurrentValue);
            }
            $this->FAX->EditValue = HtmlEncode($this->FAX->CurrentValue);
            $this->FAX->PlaceHolder = RemoveHtml($this->FAX->caption());

            // EMAIL
            $this->_EMAIL->EditAttrs["class"] = "form-control";
            $this->_EMAIL->EditCustomAttributes = "";
            if (!$this->_EMAIL->Raw) {
                $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
            }
            $this->_EMAIL->EditValue = HtmlEncode($this->_EMAIL->CurrentValue);
            $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

            // DESCRIPTION
            $this->DESCRIPTION->EditAttrs["class"] = "form-control";
            $this->DESCRIPTION->EditCustomAttributes = "";
            if (!$this->DESCRIPTION->Raw) {
                $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
            }
            $this->DESCRIPTION->EditValue = HtmlEncode($this->DESCRIPTION->CurrentValue);
            $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

            // MODIFIED_DATE
            $this->MODIFIED_DATE->EditAttrs["class"] = "form-control";
            $this->MODIFIED_DATE->EditCustomAttributes = "";
            $this->MODIFIED_DATE->EditValue = HtmlEncode(FormatDateTime($this->MODIFIED_DATE->CurrentValue, 8));
            $this->MODIFIED_DATE->PlaceHolder = RemoveHtml($this->MODIFIED_DATE->caption());

            // MODIFIED_BY
            $this->MODIFIED_BY->EditAttrs["class"] = "form-control";
            $this->MODIFIED_BY->EditCustomAttributes = "";
            if (!$this->MODIFIED_BY->Raw) {
                $this->MODIFIED_BY->CurrentValue = HtmlDecode($this->MODIFIED_BY->CurrentValue);
            }
            $this->MODIFIED_BY->EditValue = HtmlEncode($this->MODIFIED_BY->CurrentValue);
            $this->MODIFIED_BY->PlaceHolder = RemoveHtml($this->MODIFIED_BY->caption());

            // MODIFIED_FROM
            $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
            $this->MODIFIED_FROM->EditCustomAttributes = "";
            if (!$this->MODIFIED_FROM->Raw) {
                $this->MODIFIED_FROM->CurrentValue = HtmlDecode($this->MODIFIED_FROM->CurrentValue);
            }
            $this->MODIFIED_FROM->EditValue = HtmlEncode($this->MODIFIED_FROM->CurrentValue);
            $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

            // COUNTRY_CODE
            $this->COUNTRY_CODE->EditAttrs["class"] = "form-control";
            $this->COUNTRY_CODE->EditCustomAttributes = "";
            if (!$this->COUNTRY_CODE->Raw) {
                $this->COUNTRY_CODE->CurrentValue = HtmlDecode($this->COUNTRY_CODE->CurrentValue);
            }
            $this->COUNTRY_CODE->EditValue = HtmlEncode($this->COUNTRY_CODE->CurrentValue);
            $this->COUNTRY_CODE->PlaceHolder = RemoveHtml($this->COUNTRY_CODE->caption());

            // Add refer script

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";

            // FAMILY_ID
            $this->FAMILY_ID->LinkCustomAttributes = "";
            $this->FAMILY_ID->HrefValue = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
            $this->FAMILY_STATUS_ID->HrefValue = "";

            // NO_REGISTRATION2
            $this->NO_REGISTRATION2->LinkCustomAttributes = "";
            $this->NO_REGISTRATION2->HrefValue = "";

            // FULLNAME
            $this->FULLNAME->LinkCustomAttributes = "";
            $this->FULLNAME->HrefValue = "";

            // ISRESPONSIBLE
            $this->ISRESPONSIBLE->LinkCustomAttributes = "";
            $this->ISRESPONSIBLE->HrefValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->LinkCustomAttributes = "";
            $this->DATE_OF_BIRTH->HrefValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->LinkCustomAttributes = "";
            $this->KODE_AGAMA->HrefValue = "";

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->LinkCustomAttributes = "";
            $this->EDUCATION_TYPE_CODE->HrefValue = "";

            // JOB_ID
            $this->JOB_ID->LinkCustomAttributes = "";
            $this->JOB_ID->HrefValue = "";

            // BLOOD_ID
            $this->BLOOD_ID->LinkCustomAttributes = "";
            $this->BLOOD_ID->HrefValue = "";

            // MARITALSTATUSID
            $this->MARITALSTATUSID->LinkCustomAttributes = "";
            $this->MARITALSTATUSID->HrefValue = "";

            // ADDRESS
            $this->ADDRESS->LinkCustomAttributes = "";
            $this->ADDRESS->HrefValue = "";

            // KOTA
            $this->KOTA->LinkCustomAttributes = "";
            $this->KOTA->HrefValue = "";

            // RT
            $this->RT->LinkCustomAttributes = "";
            $this->RT->HrefValue = "";

            // RW
            $this->RW->LinkCustomAttributes = "";
            $this->RW->HrefValue = "";

            // PHONE
            $this->PHONE->LinkCustomAttributes = "";
            $this->PHONE->HrefValue = "";

            // MOBILE
            $this->MOBILE->LinkCustomAttributes = "";
            $this->MOBILE->HrefValue = "";

            // FAX
            $this->FAX->LinkCustomAttributes = "";
            $this->FAX->HrefValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->LinkCustomAttributes = "";
            $this->MODIFIED_DATE->HrefValue = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->LinkCustomAttributes = "";
            $this->MODIFIED_BY->HrefValue = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->LinkCustomAttributes = "";
            $this->MODIFIED_FROM->HrefValue = "";

            // COUNTRY_CODE
            $this->COUNTRY_CODE->LinkCustomAttributes = "";
            $this->COUNTRY_CODE->HrefValue = "";
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
        if ($this->ORG_UNIT_CODE->Required) {
            if (!$this->ORG_UNIT_CODE->IsDetailKey && EmptyValue($this->ORG_UNIT_CODE->FormValue)) {
                $this->ORG_UNIT_CODE->addErrorMessage(str_replace("%s", $this->ORG_UNIT_CODE->caption(), $this->ORG_UNIT_CODE->RequiredErrorMessage));
            }
        }
        if ($this->NO_REGISTRATION->Required) {
            if (!$this->NO_REGISTRATION->IsDetailKey && EmptyValue($this->NO_REGISTRATION->FormValue)) {
                $this->NO_REGISTRATION->addErrorMessage(str_replace("%s", $this->NO_REGISTRATION->caption(), $this->NO_REGISTRATION->RequiredErrorMessage));
            }
        }
        if ($this->FAMILY_ID->Required) {
            if (!$this->FAMILY_ID->IsDetailKey && EmptyValue($this->FAMILY_ID->FormValue)) {
                $this->FAMILY_ID->addErrorMessage(str_replace("%s", $this->FAMILY_ID->caption(), $this->FAMILY_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->FAMILY_ID->FormValue)) {
            $this->FAMILY_ID->addErrorMessage($this->FAMILY_ID->getErrorMessage(false));
        }
        if ($this->FAMILY_STATUS_ID->Required) {
            if (!$this->FAMILY_STATUS_ID->IsDetailKey && EmptyValue($this->FAMILY_STATUS_ID->FormValue)) {
                $this->FAMILY_STATUS_ID->addErrorMessage(str_replace("%s", $this->FAMILY_STATUS_ID->caption(), $this->FAMILY_STATUS_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->FAMILY_STATUS_ID->FormValue)) {
            $this->FAMILY_STATUS_ID->addErrorMessage($this->FAMILY_STATUS_ID->getErrorMessage(false));
        }
        if ($this->NO_REGISTRATION2->Required) {
            if (!$this->NO_REGISTRATION2->IsDetailKey && EmptyValue($this->NO_REGISTRATION2->FormValue)) {
                $this->NO_REGISTRATION2->addErrorMessage(str_replace("%s", $this->NO_REGISTRATION2->caption(), $this->NO_REGISTRATION2->RequiredErrorMessage));
            }
        }
        if ($this->FULLNAME->Required) {
            if (!$this->FULLNAME->IsDetailKey && EmptyValue($this->FULLNAME->FormValue)) {
                $this->FULLNAME->addErrorMessage(str_replace("%s", $this->FULLNAME->caption(), $this->FULLNAME->RequiredErrorMessage));
            }
        }
        if ($this->ISRESPONSIBLE->Required) {
            if (!$this->ISRESPONSIBLE->IsDetailKey && EmptyValue($this->ISRESPONSIBLE->FormValue)) {
                $this->ISRESPONSIBLE->addErrorMessage(str_replace("%s", $this->ISRESPONSIBLE->caption(), $this->ISRESPONSIBLE->RequiredErrorMessage));
            }
        }
        if ($this->GENDER->Required) {
            if (!$this->GENDER->IsDetailKey && EmptyValue($this->GENDER->FormValue)) {
                $this->GENDER->addErrorMessage(str_replace("%s", $this->GENDER->caption(), $this->GENDER->RequiredErrorMessage));
            }
        }
        if ($this->DATE_OF_BIRTH->Required) {
            if (!$this->DATE_OF_BIRTH->IsDetailKey && EmptyValue($this->DATE_OF_BIRTH->FormValue)) {
                $this->DATE_OF_BIRTH->addErrorMessage(str_replace("%s", $this->DATE_OF_BIRTH->caption(), $this->DATE_OF_BIRTH->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->DATE_OF_BIRTH->FormValue)) {
            $this->DATE_OF_BIRTH->addErrorMessage($this->DATE_OF_BIRTH->getErrorMessage(false));
        }
        if ($this->PLACE_OF_BIRTH->Required) {
            if (!$this->PLACE_OF_BIRTH->IsDetailKey && EmptyValue($this->PLACE_OF_BIRTH->FormValue)) {
                $this->PLACE_OF_BIRTH->addErrorMessage(str_replace("%s", $this->PLACE_OF_BIRTH->caption(), $this->PLACE_OF_BIRTH->RequiredErrorMessage));
            }
        }
        if ($this->KODE_AGAMA->Required) {
            if (!$this->KODE_AGAMA->IsDetailKey && EmptyValue($this->KODE_AGAMA->FormValue)) {
                $this->KODE_AGAMA->addErrorMessage(str_replace("%s", $this->KODE_AGAMA->caption(), $this->KODE_AGAMA->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->KODE_AGAMA->FormValue)) {
            $this->KODE_AGAMA->addErrorMessage($this->KODE_AGAMA->getErrorMessage(false));
        }
        if ($this->EDUCATION_TYPE_CODE->Required) {
            if (!$this->EDUCATION_TYPE_CODE->IsDetailKey && EmptyValue($this->EDUCATION_TYPE_CODE->FormValue)) {
                $this->EDUCATION_TYPE_CODE->addErrorMessage(str_replace("%s", $this->EDUCATION_TYPE_CODE->caption(), $this->EDUCATION_TYPE_CODE->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->EDUCATION_TYPE_CODE->FormValue)) {
            $this->EDUCATION_TYPE_CODE->addErrorMessage($this->EDUCATION_TYPE_CODE->getErrorMessage(false));
        }
        if ($this->JOB_ID->Required) {
            if (!$this->JOB_ID->IsDetailKey && EmptyValue($this->JOB_ID->FormValue)) {
                $this->JOB_ID->addErrorMessage(str_replace("%s", $this->JOB_ID->caption(), $this->JOB_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->JOB_ID->FormValue)) {
            $this->JOB_ID->addErrorMessage($this->JOB_ID->getErrorMessage(false));
        }
        if ($this->BLOOD_ID->Required) {
            if (!$this->BLOOD_ID->IsDetailKey && EmptyValue($this->BLOOD_ID->FormValue)) {
                $this->BLOOD_ID->addErrorMessage(str_replace("%s", $this->BLOOD_ID->caption(), $this->BLOOD_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->BLOOD_ID->FormValue)) {
            $this->BLOOD_ID->addErrorMessage($this->BLOOD_ID->getErrorMessage(false));
        }
        if ($this->MARITALSTATUSID->Required) {
            if (!$this->MARITALSTATUSID->IsDetailKey && EmptyValue($this->MARITALSTATUSID->FormValue)) {
                $this->MARITALSTATUSID->addErrorMessage(str_replace("%s", $this->MARITALSTATUSID->caption(), $this->MARITALSTATUSID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->MARITALSTATUSID->FormValue)) {
            $this->MARITALSTATUSID->addErrorMessage($this->MARITALSTATUSID->getErrorMessage(false));
        }
        if ($this->ADDRESS->Required) {
            if (!$this->ADDRESS->IsDetailKey && EmptyValue($this->ADDRESS->FormValue)) {
                $this->ADDRESS->addErrorMessage(str_replace("%s", $this->ADDRESS->caption(), $this->ADDRESS->RequiredErrorMessage));
            }
        }
        if ($this->KOTA->Required) {
            if (!$this->KOTA->IsDetailKey && EmptyValue($this->KOTA->FormValue)) {
                $this->KOTA->addErrorMessage(str_replace("%s", $this->KOTA->caption(), $this->KOTA->RequiredErrorMessage));
            }
        }
        if ($this->RT->Required) {
            if (!$this->RT->IsDetailKey && EmptyValue($this->RT->FormValue)) {
                $this->RT->addErrorMessage(str_replace("%s", $this->RT->caption(), $this->RT->RequiredErrorMessage));
            }
        }
        if ($this->RW->Required) {
            if (!$this->RW->IsDetailKey && EmptyValue($this->RW->FormValue)) {
                $this->RW->addErrorMessage(str_replace("%s", $this->RW->caption(), $this->RW->RequiredErrorMessage));
            }
        }
        if ($this->PHONE->Required) {
            if (!$this->PHONE->IsDetailKey && EmptyValue($this->PHONE->FormValue)) {
                $this->PHONE->addErrorMessage(str_replace("%s", $this->PHONE->caption(), $this->PHONE->RequiredErrorMessage));
            }
        }
        if ($this->MOBILE->Required) {
            if (!$this->MOBILE->IsDetailKey && EmptyValue($this->MOBILE->FormValue)) {
                $this->MOBILE->addErrorMessage(str_replace("%s", $this->MOBILE->caption(), $this->MOBILE->RequiredErrorMessage));
            }
        }
        if ($this->FAX->Required) {
            if (!$this->FAX->IsDetailKey && EmptyValue($this->FAX->FormValue)) {
                $this->FAX->addErrorMessage(str_replace("%s", $this->FAX->caption(), $this->FAX->RequiredErrorMessage));
            }
        }
        if ($this->_EMAIL->Required) {
            if (!$this->_EMAIL->IsDetailKey && EmptyValue($this->_EMAIL->FormValue)) {
                $this->_EMAIL->addErrorMessage(str_replace("%s", $this->_EMAIL->caption(), $this->_EMAIL->RequiredErrorMessage));
            }
        }
        if ($this->DESCRIPTION->Required) {
            if (!$this->DESCRIPTION->IsDetailKey && EmptyValue($this->DESCRIPTION->FormValue)) {
                $this->DESCRIPTION->addErrorMessage(str_replace("%s", $this->DESCRIPTION->caption(), $this->DESCRIPTION->RequiredErrorMessage));
            }
        }
        if ($this->MODIFIED_DATE->Required) {
            if (!$this->MODIFIED_DATE->IsDetailKey && EmptyValue($this->MODIFIED_DATE->FormValue)) {
                $this->MODIFIED_DATE->addErrorMessage(str_replace("%s", $this->MODIFIED_DATE->caption(), $this->MODIFIED_DATE->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->MODIFIED_DATE->FormValue)) {
            $this->MODIFIED_DATE->addErrorMessage($this->MODIFIED_DATE->getErrorMessage(false));
        }
        if ($this->MODIFIED_BY->Required) {
            if (!$this->MODIFIED_BY->IsDetailKey && EmptyValue($this->MODIFIED_BY->FormValue)) {
                $this->MODIFIED_BY->addErrorMessage(str_replace("%s", $this->MODIFIED_BY->caption(), $this->MODIFIED_BY->RequiredErrorMessage));
            }
        }
        if ($this->MODIFIED_FROM->Required) {
            if (!$this->MODIFIED_FROM->IsDetailKey && EmptyValue($this->MODIFIED_FROM->FormValue)) {
                $this->MODIFIED_FROM->addErrorMessage(str_replace("%s", $this->MODIFIED_FROM->caption(), $this->MODIFIED_FROM->RequiredErrorMessage));
            }
        }
        if ($this->COUNTRY_CODE->Required) {
            if (!$this->COUNTRY_CODE->IsDetailKey && EmptyValue($this->COUNTRY_CODE->FormValue)) {
                $this->COUNTRY_CODE->addErrorMessage(str_replace("%s", $this->COUNTRY_CODE->caption(), $this->COUNTRY_CODE->RequiredErrorMessage));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->setDbValueDef($rsnew, $this->ORG_UNIT_CODE->CurrentValue, "", false);

        // NO_REGISTRATION
        $this->NO_REGISTRATION->setDbValueDef($rsnew, $this->NO_REGISTRATION->CurrentValue, "", false);

        // FAMILY_ID
        $this->FAMILY_ID->setDbValueDef($rsnew, $this->FAMILY_ID->CurrentValue, 0, false);

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->setDbValueDef($rsnew, $this->FAMILY_STATUS_ID->CurrentValue, null, strval($this->FAMILY_STATUS_ID->CurrentValue) == "");

        // NO_REGISTRATION2
        $this->NO_REGISTRATION2->setDbValueDef($rsnew, $this->NO_REGISTRATION2->CurrentValue, null, false);

        // FULLNAME
        $this->FULLNAME->setDbValueDef($rsnew, $this->FULLNAME->CurrentValue, null, false);

        // ISRESPONSIBLE
        $this->ISRESPONSIBLE->setDbValueDef($rsnew, $this->ISRESPONSIBLE->CurrentValue, null, false);

        // GENDER
        $this->GENDER->setDbValueDef($rsnew, $this->GENDER->CurrentValue, null, false);

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->setDbValueDef($rsnew, UnFormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 0), null, false);

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->setDbValueDef($rsnew, $this->PLACE_OF_BIRTH->CurrentValue, null, false);

        // KODE_AGAMA
        $this->KODE_AGAMA->setDbValueDef($rsnew, $this->KODE_AGAMA->CurrentValue, null, false);

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->setDbValueDef($rsnew, $this->EDUCATION_TYPE_CODE->CurrentValue, null, false);

        // JOB_ID
        $this->JOB_ID->setDbValueDef($rsnew, $this->JOB_ID->CurrentValue, null, false);

        // BLOOD_ID
        $this->BLOOD_ID->setDbValueDef($rsnew, $this->BLOOD_ID->CurrentValue, null, false);

        // MARITALSTATUSID
        $this->MARITALSTATUSID->setDbValueDef($rsnew, $this->MARITALSTATUSID->CurrentValue, null, false);

        // ADDRESS
        $this->ADDRESS->setDbValueDef($rsnew, $this->ADDRESS->CurrentValue, null, false);

        // KOTA
        $this->KOTA->setDbValueDef($rsnew, $this->KOTA->CurrentValue, null, false);

        // RT
        $this->RT->setDbValueDef($rsnew, $this->RT->CurrentValue, null, false);

        // RW
        $this->RW->setDbValueDef($rsnew, $this->RW->CurrentValue, null, false);

        // PHONE
        $this->PHONE->setDbValueDef($rsnew, $this->PHONE->CurrentValue, null, false);

        // MOBILE
        $this->MOBILE->setDbValueDef($rsnew, $this->MOBILE->CurrentValue, null, false);

        // FAX
        $this->FAX->setDbValueDef($rsnew, $this->FAX->CurrentValue, null, false);

        // EMAIL
        $this->_EMAIL->setDbValueDef($rsnew, $this->_EMAIL->CurrentValue, null, false);

        // DESCRIPTION
        $this->DESCRIPTION->setDbValueDef($rsnew, $this->DESCRIPTION->CurrentValue, null, false);

        // MODIFIED_DATE
        $this->MODIFIED_DATE->setDbValueDef($rsnew, UnFormatDateTime($this->MODIFIED_DATE->CurrentValue, 0), null, false);

        // MODIFIED_BY
        $this->MODIFIED_BY->setDbValueDef($rsnew, $this->MODIFIED_BY->CurrentValue, null, false);

        // MODIFIED_FROM
        $this->MODIFIED_FROM->setDbValueDef($rsnew, $this->MODIFIED_FROM->CurrentValue, null, false);

        // COUNTRY_CODE
        $this->COUNTRY_CODE->setDbValueDef($rsnew, $this->COUNTRY_CODE->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['ORG_UNIT_CODE']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['NO_REGISTRATION']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['FAMILY_ID']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
        $addRow = false;
        if ($insertRow) {
            try {
                $addRow = $this->insert($rsnew);
            } catch (\Exception $e) {
                $this->setFailureMessage($e->getMessage());
            }
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("FamilyList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
