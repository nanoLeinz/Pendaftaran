<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class VPasienvisitationrjAdd extends VPasienvisitationrj
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'V_PASIENVISITATIONRJ';

    // Page object name
    public $PageObjName = "VPasienvisitationrjAdd";

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

        // Table object (V_PASIENVISITATIONRJ)
        if (!isset($GLOBALS["V_PASIENVISITATIONRJ"]) || get_class($GLOBALS["V_PASIENVISITATIONRJ"]) == PROJECT_NAMESPACE . "V_PASIENVISITATIONRJ") {
            $GLOBALS["V_PASIENVISITATIONRJ"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'V_PASIENVISITATIONRJ');
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
                $doc = new $class(Container("V_PASIENVISITATIONRJ"));
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
                    if ($pageName == "VPasienvisitationrjView") {
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
            $key .= @$ar['NO_REGISTRATION'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['ORG_UNIT_CODE'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['visit_id'];
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
        if ($this->isAddOrEdit()) {
            $this->KALURAHAN->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->clinic_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->name_of_clinic->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->clinic_id_from->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->fullname->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->employee_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->employee_id_from->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->booked_Date->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->visit_date->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->visit_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->isattended->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->diantar_oleh->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->visitor_address->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->address_of_rujukan->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->rujukan_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->DESCRIPTION->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->patient_category_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->payor_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->reason_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->STATUS_PASIEN_ID->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->way_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->follow_up->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->isnew->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->family_status_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->urutan->Visible = false;
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
        $this->NAME_OF_PASIEN->setVisibility();
        $this->NO_REGISTRATION->setVisibility();
        $this->ORG_UNIT_CODE->setVisibility();
        $this->date_of_birth->setVisibility();
        $this->CONTACT_ADDRESS->setVisibility();
        $this->PHONE_NUMBER->setVisibility();
        $this->MOBILE->setVisibility();
        $this->KAL_ID->setVisibility();
        $this->PLACE_OF_BIRTH->setVisibility();
        $this->KALURAHAN->Visible = false;
        $this->clinic_id->Visible = false;
        $this->name_of_clinic->Visible = false;
        $this->clinic_id_from->Visible = false;
        $this->fullname->Visible = false;
        $this->employee_id->Visible = false;
        $this->employee_id_from->Visible = false;
        $this->booked_Date->Visible = false;
        $this->visit_date->Visible = false;
        $this->visit_id->Visible = false;
        $this->isattended->Visible = false;
        $this->diantar_oleh->Visible = false;
        $this->visitor_address->Visible = false;
        $this->address_of_rujukan->Visible = false;
        $this->rujukan_id->Visible = false;
        $this->DESCRIPTION->Visible = false;
        $this->patient_category_id->Visible = false;
        $this->payor_id->Visible = false;
        $this->reason_id->Visible = false;
        $this->STATUS_PASIEN_ID->Visible = false;
        $this->way_id->Visible = false;
        $this->follow_up->Visible = false;
        $this->isnew->Visible = false;
        $this->family_status_id->Visible = false;
        $this->urutan->Visible = false;
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
            if (($keyValue = Get("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
                $this->NO_REGISTRATION->setQueryStringValue($keyValue);
            }
            if (($keyValue = Get("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
                $this->ORG_UNIT_CODE->setQueryStringValue($keyValue);
            }
            if (($keyValue = Get("visit_id") ?? Route("visit_id")) !== null) {
                $this->visit_id->setQueryStringValue($keyValue);
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
                    $this->terminate("VPasienvisitationrjList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "VPasienvisitationrjList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "VPasienvisitationrjView") {
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
        $this->NAME_OF_PASIEN->CurrentValue = null;
        $this->NAME_OF_PASIEN->OldValue = $this->NAME_OF_PASIEN->CurrentValue;
        $this->NO_REGISTRATION->CurrentValue = null;
        $this->NO_REGISTRATION->OldValue = $this->NO_REGISTRATION->CurrentValue;
        $this->ORG_UNIT_CODE->CurrentValue = null;
        $this->ORG_UNIT_CODE->OldValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->date_of_birth->CurrentValue = null;
        $this->date_of_birth->OldValue = $this->date_of_birth->CurrentValue;
        $this->CONTACT_ADDRESS->CurrentValue = null;
        $this->CONTACT_ADDRESS->OldValue = $this->CONTACT_ADDRESS->CurrentValue;
        $this->PHONE_NUMBER->CurrentValue = null;
        $this->PHONE_NUMBER->OldValue = $this->PHONE_NUMBER->CurrentValue;
        $this->MOBILE->CurrentValue = null;
        $this->MOBILE->OldValue = $this->MOBILE->CurrentValue;
        $this->KAL_ID->CurrentValue = null;
        $this->KAL_ID->OldValue = $this->KAL_ID->CurrentValue;
        $this->PLACE_OF_BIRTH->CurrentValue = null;
        $this->PLACE_OF_BIRTH->OldValue = $this->PLACE_OF_BIRTH->CurrentValue;
        $this->KALURAHAN->CurrentValue = null;
        $this->KALURAHAN->OldValue = $this->KALURAHAN->CurrentValue;
        $this->clinic_id->CurrentValue = null;
        $this->clinic_id->OldValue = $this->clinic_id->CurrentValue;
        $this->name_of_clinic->CurrentValue = null;
        $this->name_of_clinic->OldValue = $this->name_of_clinic->CurrentValue;
        $this->clinic_id_from->CurrentValue = null;
        $this->clinic_id_from->OldValue = $this->clinic_id_from->CurrentValue;
        $this->fullname->CurrentValue = null;
        $this->fullname->OldValue = $this->fullname->CurrentValue;
        $this->employee_id->CurrentValue = null;
        $this->employee_id->OldValue = $this->employee_id->CurrentValue;
        $this->employee_id_from->CurrentValue = null;
        $this->employee_id_from->OldValue = $this->employee_id_from->CurrentValue;
        $this->booked_Date->CurrentValue = null;
        $this->booked_Date->OldValue = $this->booked_Date->CurrentValue;
        $this->visit_date->CurrentValue = null;
        $this->visit_date->OldValue = $this->visit_date->CurrentValue;
        $this->visit_id->CurrentValue = null;
        $this->visit_id->OldValue = $this->visit_id->CurrentValue;
        $this->isattended->CurrentValue = null;
        $this->isattended->OldValue = $this->isattended->CurrentValue;
        $this->diantar_oleh->CurrentValue = null;
        $this->diantar_oleh->OldValue = $this->diantar_oleh->CurrentValue;
        $this->visitor_address->CurrentValue = null;
        $this->visitor_address->OldValue = $this->visitor_address->CurrentValue;
        $this->address_of_rujukan->CurrentValue = null;
        $this->address_of_rujukan->OldValue = $this->address_of_rujukan->CurrentValue;
        $this->rujukan_id->CurrentValue = null;
        $this->rujukan_id->OldValue = $this->rujukan_id->CurrentValue;
        $this->DESCRIPTION->CurrentValue = null;
        $this->DESCRIPTION->OldValue = $this->DESCRIPTION->CurrentValue;
        $this->patient_category_id->CurrentValue = null;
        $this->patient_category_id->OldValue = $this->patient_category_id->CurrentValue;
        $this->payor_id->CurrentValue = null;
        $this->payor_id->OldValue = $this->payor_id->CurrentValue;
        $this->reason_id->CurrentValue = null;
        $this->reason_id->OldValue = $this->reason_id->CurrentValue;
        $this->STATUS_PASIEN_ID->CurrentValue = null;
        $this->STATUS_PASIEN_ID->OldValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->way_id->CurrentValue = null;
        $this->way_id->OldValue = $this->way_id->CurrentValue;
        $this->follow_up->CurrentValue = null;
        $this->follow_up->OldValue = $this->follow_up->CurrentValue;
        $this->isnew->CurrentValue = null;
        $this->isnew->OldValue = $this->isnew->CurrentValue;
        $this->family_status_id->CurrentValue = null;
        $this->family_status_id->OldValue = $this->family_status_id->CurrentValue;
        $this->urutan->CurrentValue = null;
        $this->urutan->OldValue = $this->urutan->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'NAME_OF_PASIEN' first before field var 'x_NAME_OF_PASIEN'
        $val = $CurrentForm->hasValue("NAME_OF_PASIEN") ? $CurrentForm->getValue("NAME_OF_PASIEN") : $CurrentForm->getValue("x_NAME_OF_PASIEN");
        if (!$this->NAME_OF_PASIEN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAME_OF_PASIEN->Visible = false; // Disable update for API request
            } else {
                $this->NAME_OF_PASIEN->setFormValue($val);
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

        // Check field name 'ORG_UNIT_CODE' first before field var 'x_ORG_UNIT_CODE'
        $val = $CurrentForm->hasValue("ORG_UNIT_CODE") ? $CurrentForm->getValue("ORG_UNIT_CODE") : $CurrentForm->getValue("x_ORG_UNIT_CODE");
        if (!$this->ORG_UNIT_CODE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ORG_UNIT_CODE->Visible = false; // Disable update for API request
            } else {
                $this->ORG_UNIT_CODE->setFormValue($val);
            }
        }

        // Check field name 'date_of_birth' first before field var 'x_date_of_birth'
        $val = $CurrentForm->hasValue("date_of_birth") ? $CurrentForm->getValue("date_of_birth") : $CurrentForm->getValue("x_date_of_birth");
        if (!$this->date_of_birth->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date_of_birth->Visible = false; // Disable update for API request
            } else {
                $this->date_of_birth->setFormValue($val);
            }
            $this->date_of_birth->CurrentValue = UnFormatDateTime($this->date_of_birth->CurrentValue, 0);
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

        // Check field name 'KAL_ID' first before field var 'x_KAL_ID'
        $val = $CurrentForm->hasValue("KAL_ID") ? $CurrentForm->getValue("KAL_ID") : $CurrentForm->getValue("x_KAL_ID");
        if (!$this->KAL_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KAL_ID->Visible = false; // Disable update for API request
            } else {
                $this->KAL_ID->setFormValue($val);
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

        // Check field name 'visit_id' first before field var 'x_visit_id'
        $val = $CurrentForm->hasValue("visit_id") ? $CurrentForm->getValue("visit_id") : $CurrentForm->getValue("x_visit_id");
        if (!$this->visit_id->IsDetailKey) {
            $this->visit_id->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
                        $this->visit_id->CurrentValue = $this->visit_id->FormValue;
        $this->NAME_OF_PASIEN->CurrentValue = $this->NAME_OF_PASIEN->FormValue;
        $this->NO_REGISTRATION->CurrentValue = $this->NO_REGISTRATION->FormValue;
        $this->ORG_UNIT_CODE->CurrentValue = $this->ORG_UNIT_CODE->FormValue;
        $this->date_of_birth->CurrentValue = $this->date_of_birth->FormValue;
        $this->date_of_birth->CurrentValue = UnFormatDateTime($this->date_of_birth->CurrentValue, 0);
        $this->CONTACT_ADDRESS->CurrentValue = $this->CONTACT_ADDRESS->FormValue;
        $this->PHONE_NUMBER->CurrentValue = $this->PHONE_NUMBER->FormValue;
        $this->MOBILE->CurrentValue = $this->MOBILE->FormValue;
        $this->KAL_ID->CurrentValue = $this->KAL_ID->FormValue;
        $this->PLACE_OF_BIRTH->CurrentValue = $this->PLACE_OF_BIRTH->FormValue;
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
        $this->NAME_OF_PASIEN->setDbValue($row['NAME_OF_PASIEN']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->date_of_birth->setDbValue($row['date_of_birth']);
        $this->CONTACT_ADDRESS->setDbValue($row['CONTACT_ADDRESS']);
        $this->PHONE_NUMBER->setDbValue($row['PHONE_NUMBER']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->clinic_id->setDbValue($row['clinic_id']);
        $this->name_of_clinic->setDbValue($row['name_of_clinic']);
        $this->clinic_id_from->setDbValue($row['clinic_id_from']);
        $this->fullname->setDbValue($row['fullname']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->employee_id_from->setDbValue($row['employee_id_from']);
        $this->booked_Date->setDbValue($row['booked_Date']);
        $this->visit_date->setDbValue($row['visit_date']);
        $this->visit_id->setDbValue($row['visit_id']);
        $this->isattended->setDbValue($row['isattended']);
        $this->diantar_oleh->setDbValue($row['diantar_oleh']);
        $this->visitor_address->setDbValue($row['visitor_address']);
        $this->address_of_rujukan->setDbValue($row['address_of_rujukan']);
        $this->rujukan_id->setDbValue($row['rujukan_id']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->patient_category_id->setDbValue($row['patient_category_id']);
        $this->payor_id->setDbValue($row['payor_id']);
        $this->reason_id->setDbValue($row['reason_id']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->way_id->setDbValue($row['way_id']);
        $this->follow_up->setDbValue($row['follow_up']);
        $this->isnew->setDbValue($row['isnew']);
        $this->family_status_id->setDbValue($row['family_status_id']);
        $this->urutan->setDbValue($row['urutan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NAME_OF_PASIEN'] = $this->NAME_OF_PASIEN->CurrentValue;
        $row['NO_REGISTRATION'] = $this->NO_REGISTRATION->CurrentValue;
        $row['ORG_UNIT_CODE'] = $this->ORG_UNIT_CODE->CurrentValue;
        $row['date_of_birth'] = $this->date_of_birth->CurrentValue;
        $row['CONTACT_ADDRESS'] = $this->CONTACT_ADDRESS->CurrentValue;
        $row['PHONE_NUMBER'] = $this->PHONE_NUMBER->CurrentValue;
        $row['MOBILE'] = $this->MOBILE->CurrentValue;
        $row['KAL_ID'] = $this->KAL_ID->CurrentValue;
        $row['PLACE_OF_BIRTH'] = $this->PLACE_OF_BIRTH->CurrentValue;
        $row['KALURAHAN'] = $this->KALURAHAN->CurrentValue;
        $row['clinic_id'] = $this->clinic_id->CurrentValue;
        $row['name_of_clinic'] = $this->name_of_clinic->CurrentValue;
        $row['clinic_id_from'] = $this->clinic_id_from->CurrentValue;
        $row['fullname'] = $this->fullname->CurrentValue;
        $row['employee_id'] = $this->employee_id->CurrentValue;
        $row['employee_id_from'] = $this->employee_id_from->CurrentValue;
        $row['booked_Date'] = $this->booked_Date->CurrentValue;
        $row['visit_date'] = $this->visit_date->CurrentValue;
        $row['visit_id'] = $this->visit_id->CurrentValue;
        $row['isattended'] = $this->isattended->CurrentValue;
        $row['diantar_oleh'] = $this->diantar_oleh->CurrentValue;
        $row['visitor_address'] = $this->visitor_address->CurrentValue;
        $row['address_of_rujukan'] = $this->address_of_rujukan->CurrentValue;
        $row['rujukan_id'] = $this->rujukan_id->CurrentValue;
        $row['DESCRIPTION'] = $this->DESCRIPTION->CurrentValue;
        $row['patient_category_id'] = $this->patient_category_id->CurrentValue;
        $row['payor_id'] = $this->payor_id->CurrentValue;
        $row['reason_id'] = $this->reason_id->CurrentValue;
        $row['STATUS_PASIEN_ID'] = $this->STATUS_PASIEN_ID->CurrentValue;
        $row['way_id'] = $this->way_id->CurrentValue;
        $row['follow_up'] = $this->follow_up->CurrentValue;
        $row['isnew'] = $this->isnew->CurrentValue;
        $row['family_status_id'] = $this->family_status_id->CurrentValue;
        $row['urutan'] = $this->urutan->CurrentValue;
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

        // NAME_OF_PASIEN

        // NO_REGISTRATION

        // ORG_UNIT_CODE

        // date_of_birth

        // CONTACT_ADDRESS

        // PHONE_NUMBER

        // MOBILE

        // KAL_ID

        // PLACE_OF_BIRTH

        // KALURAHAN

        // clinic_id

        // name_of_clinic

        // clinic_id_from

        // fullname

        // employee_id

        // employee_id_from

        // booked_Date

        // visit_date

        // visit_id

        // isattended

        // diantar_oleh

        // visitor_address

        // address_of_rujukan

        // rujukan_id

        // DESCRIPTION

        // patient_category_id

        // payor_id

        // reason_id

        // STATUS_PASIEN_ID

        // way_id

        // follow_up

        // isnew

        // family_status_id

        // urutan
        if ($this->RowType == ROWTYPE_VIEW) {
            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->ViewValue = $this->NAME_OF_PASIEN->CurrentValue;
            $this->NAME_OF_PASIEN->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // date_of_birth
            $this->date_of_birth->ViewValue = $this->date_of_birth->CurrentValue;
            $this->date_of_birth->ViewValue = FormatDateTime($this->date_of_birth->ViewValue, 0);
            $this->date_of_birth->ViewCustomAttributes = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->ViewValue = $this->CONTACT_ADDRESS->CurrentValue;
            $this->CONTACT_ADDRESS->ViewCustomAttributes = "";

            // PHONE_NUMBER
            $this->PHONE_NUMBER->ViewValue = $this->PHONE_NUMBER->CurrentValue;
            $this->PHONE_NUMBER->ViewCustomAttributes = "";

            // MOBILE
            $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
            $this->MOBILE->ViewCustomAttributes = "";

            // KAL_ID
            $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
            $this->KAL_ID->ViewCustomAttributes = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
            $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

            // KALURAHAN
            $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
            $this->KALURAHAN->ViewCustomAttributes = "";

            // clinic_id
            $this->clinic_id->ViewValue = $this->clinic_id->CurrentValue;
            $this->clinic_id->ViewCustomAttributes = "";

            // name_of_clinic
            $this->name_of_clinic->ViewValue = $this->name_of_clinic->CurrentValue;
            $this->name_of_clinic->ViewCustomAttributes = "";

            // clinic_id_from
            $this->clinic_id_from->ViewValue = $this->clinic_id_from->CurrentValue;
            $this->clinic_id_from->ViewCustomAttributes = "";

            // fullname
            $this->fullname->ViewValue = $this->fullname->CurrentValue;
            $this->fullname->ViewCustomAttributes = "";

            // employee_id
            $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
            $this->employee_id->ViewCustomAttributes = "";

            // employee_id_from
            $this->employee_id_from->ViewValue = $this->employee_id_from->CurrentValue;
            $this->employee_id_from->ViewCustomAttributes = "";

            // booked_Date
            $this->booked_Date->ViewValue = $this->booked_Date->CurrentValue;
            $this->booked_Date->ViewValue = FormatDateTime($this->booked_Date->ViewValue, 0);
            $this->booked_Date->ViewCustomAttributes = "";

            // visit_date
            $this->visit_date->ViewValue = $this->visit_date->CurrentValue;
            $this->visit_date->ViewValue = FormatDateTime($this->visit_date->ViewValue, 0);
            $this->visit_date->ViewCustomAttributes = "";

            // visit_id
            $this->visit_id->ViewValue = $this->visit_id->CurrentValue;
            $this->visit_id->ViewCustomAttributes = "";

            // isattended
            $this->isattended->ViewValue = $this->isattended->CurrentValue;
            $this->isattended->ViewCustomAttributes = "";

            // diantar_oleh
            $this->diantar_oleh->ViewValue = $this->diantar_oleh->CurrentValue;
            $this->diantar_oleh->ViewCustomAttributes = "";

            // visitor_address
            $this->visitor_address->ViewValue = $this->visitor_address->CurrentValue;
            $this->visitor_address->ViewCustomAttributes = "";

            // address_of_rujukan
            $this->address_of_rujukan->ViewValue = $this->address_of_rujukan->CurrentValue;
            $this->address_of_rujukan->ViewCustomAttributes = "";

            // rujukan_id
            $this->rujukan_id->ViewValue = $this->rujukan_id->CurrentValue;
            $this->rujukan_id->ViewValue = FormatNumber($this->rujukan_id->ViewValue, 0, -2, -2, -2);
            $this->rujukan_id->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // patient_category_id
            $this->patient_category_id->ViewValue = $this->patient_category_id->CurrentValue;
            $this->patient_category_id->ViewValue = FormatNumber($this->patient_category_id->ViewValue, 0, -2, -2, -2);
            $this->patient_category_id->ViewCustomAttributes = "";

            // payor_id
            $this->payor_id->ViewValue = $this->payor_id->CurrentValue;
            $this->payor_id->ViewCustomAttributes = "";

            // reason_id
            $this->reason_id->ViewValue = $this->reason_id->CurrentValue;
            $this->reason_id->ViewValue = FormatNumber($this->reason_id->ViewValue, 0, -2, -2, -2);
            $this->reason_id->ViewCustomAttributes = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
            $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
            $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

            // way_id
            $this->way_id->ViewValue = $this->way_id->CurrentValue;
            $this->way_id->ViewValue = FormatNumber($this->way_id->ViewValue, 0, -2, -2, -2);
            $this->way_id->ViewCustomAttributes = "";

            // follow_up
            $this->follow_up->ViewValue = $this->follow_up->CurrentValue;
            $this->follow_up->ViewValue = FormatNumber($this->follow_up->ViewValue, 0, -2, -2, -2);
            $this->follow_up->ViewCustomAttributes = "";

            // isnew
            $this->isnew->ViewValue = $this->isnew->CurrentValue;
            $this->isnew->ViewCustomAttributes = "";

            // family_status_id
            $this->family_status_id->ViewValue = $this->family_status_id->CurrentValue;
            $this->family_status_id->ViewValue = FormatNumber($this->family_status_id->ViewValue, 0, -2, -2, -2);
            $this->family_status_id->ViewCustomAttributes = "";

            // urutan
            $this->urutan->ViewValue = $this->urutan->CurrentValue;
            $this->urutan->ViewValue = FormatNumber($this->urutan->ViewValue, 0, -2, -2, -2);
            $this->urutan->ViewCustomAttributes = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
            $this->NAME_OF_PASIEN->HrefValue = "";
            $this->NAME_OF_PASIEN->TooltipValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // date_of_birth
            $this->date_of_birth->LinkCustomAttributes = "";
            $this->date_of_birth->HrefValue = "";
            $this->date_of_birth->TooltipValue = "";

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

            // KAL_ID
            $this->KAL_ID->LinkCustomAttributes = "";
            $this->KAL_ID->HrefValue = "";
            $this->KAL_ID->TooltipValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";
            $this->PLACE_OF_BIRTH->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->EditAttrs["class"] = "form-control";
            $this->NAME_OF_PASIEN->EditCustomAttributes = "";
            if (!$this->NAME_OF_PASIEN->Raw) {
                $this->NAME_OF_PASIEN->CurrentValue = HtmlDecode($this->NAME_OF_PASIEN->CurrentValue);
            }
            $this->NAME_OF_PASIEN->EditValue = HtmlEncode($this->NAME_OF_PASIEN->CurrentValue);
            $this->NAME_OF_PASIEN->PlaceHolder = RemoveHtml($this->NAME_OF_PASIEN->caption());

            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
            $this->NO_REGISTRATION->EditCustomAttributes = "";
            if (!$this->NO_REGISTRATION->Raw) {
                $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
            }
            $this->NO_REGISTRATION->EditValue = HtmlEncode($this->NO_REGISTRATION->CurrentValue);
            $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

            // ORG_UNIT_CODE

            // date_of_birth
            $this->date_of_birth->EditAttrs["class"] = "form-control";
            $this->date_of_birth->EditCustomAttributes = "";
            $this->date_of_birth->EditValue = HtmlEncode(FormatDateTime($this->date_of_birth->CurrentValue, 8));
            $this->date_of_birth->PlaceHolder = RemoveHtml($this->date_of_birth->caption());

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->EditAttrs["class"] = "form-control";
            $this->CONTACT_ADDRESS->EditCustomAttributes = "";
            if (!$this->CONTACT_ADDRESS->Raw) {
                $this->CONTACT_ADDRESS->CurrentValue = HtmlDecode($this->CONTACT_ADDRESS->CurrentValue);
            }
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

            // KAL_ID
            $this->KAL_ID->EditAttrs["class"] = "form-control";
            $this->KAL_ID->EditCustomAttributes = "";
            if (!$this->KAL_ID->Raw) {
                $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
            }
            $this->KAL_ID->EditValue = HtmlEncode($this->KAL_ID->CurrentValue);
            $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->EditAttrs["class"] = "form-control";
            $this->PLACE_OF_BIRTH->EditCustomAttributes = "";
            if (!$this->PLACE_OF_BIRTH->Raw) {
                $this->PLACE_OF_BIRTH->CurrentValue = HtmlDecode($this->PLACE_OF_BIRTH->CurrentValue);
            }
            $this->PLACE_OF_BIRTH->EditValue = HtmlEncode($this->PLACE_OF_BIRTH->CurrentValue);
            $this->PLACE_OF_BIRTH->PlaceHolder = RemoveHtml($this->PLACE_OF_BIRTH->caption());

            // Add refer script

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
            $this->NAME_OF_PASIEN->HrefValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";

            // date_of_birth
            $this->date_of_birth->LinkCustomAttributes = "";
            $this->date_of_birth->HrefValue = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->LinkCustomAttributes = "";
            $this->CONTACT_ADDRESS->HrefValue = "";

            // PHONE_NUMBER
            $this->PHONE_NUMBER->LinkCustomAttributes = "";
            $this->PHONE_NUMBER->HrefValue = "";

            // MOBILE
            $this->MOBILE->LinkCustomAttributes = "";
            $this->MOBILE->HrefValue = "";

            // KAL_ID
            $this->KAL_ID->LinkCustomAttributes = "";
            $this->KAL_ID->HrefValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";
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
        if ($this->NAME_OF_PASIEN->Required) {
            if (!$this->NAME_OF_PASIEN->IsDetailKey && EmptyValue($this->NAME_OF_PASIEN->FormValue)) {
                $this->NAME_OF_PASIEN->addErrorMessage(str_replace("%s", $this->NAME_OF_PASIEN->caption(), $this->NAME_OF_PASIEN->RequiredErrorMessage));
            }
        }
        if ($this->NO_REGISTRATION->Required) {
            if (!$this->NO_REGISTRATION->IsDetailKey && EmptyValue($this->NO_REGISTRATION->FormValue)) {
                $this->NO_REGISTRATION->addErrorMessage(str_replace("%s", $this->NO_REGISTRATION->caption(), $this->NO_REGISTRATION->RequiredErrorMessage));
            }
        }
        if ($this->ORG_UNIT_CODE->Required) {
            if (!$this->ORG_UNIT_CODE->IsDetailKey && EmptyValue($this->ORG_UNIT_CODE->FormValue)) {
                $this->ORG_UNIT_CODE->addErrorMessage(str_replace("%s", $this->ORG_UNIT_CODE->caption(), $this->ORG_UNIT_CODE->RequiredErrorMessage));
            }
        }
        if ($this->date_of_birth->Required) {
            if (!$this->date_of_birth->IsDetailKey && EmptyValue($this->date_of_birth->FormValue)) {
                $this->date_of_birth->addErrorMessage(str_replace("%s", $this->date_of_birth->caption(), $this->date_of_birth->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date_of_birth->FormValue)) {
            $this->date_of_birth->addErrorMessage($this->date_of_birth->getErrorMessage(false));
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
        if ($this->KAL_ID->Required) {
            if (!$this->KAL_ID->IsDetailKey && EmptyValue($this->KAL_ID->FormValue)) {
                $this->KAL_ID->addErrorMessage(str_replace("%s", $this->KAL_ID->caption(), $this->KAL_ID->RequiredErrorMessage));
            }
        }
        if ($this->PLACE_OF_BIRTH->Required) {
            if (!$this->PLACE_OF_BIRTH->IsDetailKey && EmptyValue($this->PLACE_OF_BIRTH->FormValue)) {
                $this->PLACE_OF_BIRTH->addErrorMessage(str_replace("%s", $this->PLACE_OF_BIRTH->caption(), $this->PLACE_OF_BIRTH->RequiredErrorMessage));
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

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->setDbValueDef($rsnew, $this->NAME_OF_PASIEN->CurrentValue, null, false);

        // NO_REGISTRATION
        $this->NO_REGISTRATION->setDbValueDef($rsnew, $this->NO_REGISTRATION->CurrentValue, null, false);

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->CurrentValue = CurrentOrgId();
        $this->ORG_UNIT_CODE->setDbValueDef($rsnew, $this->ORG_UNIT_CODE->CurrentValue, "");

        // date_of_birth
        $this->date_of_birth->setDbValueDef($rsnew, UnFormatDateTime($this->date_of_birth->CurrentValue, 0), null, false);

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->setDbValueDef($rsnew, $this->CONTACT_ADDRESS->CurrentValue, null, false);

        // PHONE_NUMBER
        $this->PHONE_NUMBER->setDbValueDef($rsnew, $this->PHONE_NUMBER->CurrentValue, null, false);

        // MOBILE
        $this->MOBILE->setDbValueDef($rsnew, $this->MOBILE->CurrentValue, null, false);

        // KAL_ID
        $this->KAL_ID->setDbValueDef($rsnew, $this->KAL_ID->CurrentValue, null, false);

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->setDbValueDef($rsnew, $this->PLACE_OF_BIRTH->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['NO_REGISTRATION']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['ORG_UNIT_CODE']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['visit_id']) == "") {
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("VPasienvisitationrjList"), "", $this->TableVar, true);
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
