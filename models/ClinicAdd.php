<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class ClinicAdd extends Clinic
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'CLINIC';

    // Page object name
    public $PageObjName = "ClinicAdd";

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

        // Table object (CLINIC)
        if (!isset($GLOBALS["CLINIC"]) || get_class($GLOBALS["CLINIC"]) == PROJECT_NAMESPACE . "CLINIC") {
            $GLOBALS["CLINIC"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'CLINIC');
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
                $doc = new $class(Container("CLINIC"));
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
                    if ($pageName == "ClinicView") {
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
            $key .= @$ar['CLINIC_ID'];
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
        $this->CLINIC_ID->setVisibility();
        $this->NAME_OF_CLINIC->setVisibility();
        $this->ORG_ID->setVisibility();
        $this->STYPE_ID->setVisibility();
        $this->CLINIC_TYPE->setVisibility();
        $this->OTHER_ID->setVisibility();
        $this->ACCOUNT_ID->setVisibility();
        $this->FA_V->setVisibility();
        $this->PROFIT_ID->setVisibility();
        $this->SUPPLIED_MM->setVisibility();
        $this->KDPOLI->setVisibility();
        $this->PICTUREFILE->setVisibility();
        $this->PROFILES->setVisibility();
        $this->SPESIALISTIK->setVisibility();
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
            if (($keyValue = Get("CLINIC_ID") ?? Route("CLINIC_ID")) !== null) {
                $this->CLINIC_ID->setQueryStringValue($keyValue);
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
                    $this->terminate("ClinicList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "ClinicList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "ClinicView") {
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
        $this->CLINIC_ID->CurrentValue = null;
        $this->CLINIC_ID->OldValue = $this->CLINIC_ID->CurrentValue;
        $this->NAME_OF_CLINIC->CurrentValue = null;
        $this->NAME_OF_CLINIC->OldValue = $this->NAME_OF_CLINIC->CurrentValue;
        $this->ORG_ID->CurrentValue = null;
        $this->ORG_ID->OldValue = $this->ORG_ID->CurrentValue;
        $this->STYPE_ID->CurrentValue = null;
        $this->STYPE_ID->OldValue = $this->STYPE_ID->CurrentValue;
        $this->CLINIC_TYPE->CurrentValue = null;
        $this->CLINIC_TYPE->OldValue = $this->CLINIC_TYPE->CurrentValue;
        $this->OTHER_ID->CurrentValue = null;
        $this->OTHER_ID->OldValue = $this->OTHER_ID->CurrentValue;
        $this->ACCOUNT_ID->CurrentValue = null;
        $this->ACCOUNT_ID->OldValue = $this->ACCOUNT_ID->CurrentValue;
        $this->FA_V->CurrentValue = null;
        $this->FA_V->OldValue = $this->FA_V->CurrentValue;
        $this->PROFIT_ID->CurrentValue = null;
        $this->PROFIT_ID->OldValue = $this->PROFIT_ID->CurrentValue;
        $this->SUPPLIED_MM->CurrentValue = null;
        $this->SUPPLIED_MM->OldValue = $this->SUPPLIED_MM->CurrentValue;
        $this->KDPOLI->CurrentValue = null;
        $this->KDPOLI->OldValue = $this->KDPOLI->CurrentValue;
        $this->PICTUREFILE->CurrentValue = null;
        $this->PICTUREFILE->OldValue = $this->PICTUREFILE->CurrentValue;
        $this->PROFILES->CurrentValue = null;
        $this->PROFILES->OldValue = $this->PROFILES->CurrentValue;
        $this->SPESIALISTIK->CurrentValue = null;
        $this->SPESIALISTIK->OldValue = $this->SPESIALISTIK->CurrentValue;
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

        // Check field name 'CLINIC_ID' first before field var 'x_CLINIC_ID'
        $val = $CurrentForm->hasValue("CLINIC_ID") ? $CurrentForm->getValue("CLINIC_ID") : $CurrentForm->getValue("x_CLINIC_ID");
        if (!$this->CLINIC_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLINIC_ID->Visible = false; // Disable update for API request
            } else {
                $this->CLINIC_ID->setFormValue($val);
            }
        }

        // Check field name 'NAME_OF_CLINIC' first before field var 'x_NAME_OF_CLINIC'
        $val = $CurrentForm->hasValue("NAME_OF_CLINIC") ? $CurrentForm->getValue("NAME_OF_CLINIC") : $CurrentForm->getValue("x_NAME_OF_CLINIC");
        if (!$this->NAME_OF_CLINIC->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAME_OF_CLINIC->Visible = false; // Disable update for API request
            } else {
                $this->NAME_OF_CLINIC->setFormValue($val);
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

        // Check field name 'STYPE_ID' first before field var 'x_STYPE_ID'
        $val = $CurrentForm->hasValue("STYPE_ID") ? $CurrentForm->getValue("STYPE_ID") : $CurrentForm->getValue("x_STYPE_ID");
        if (!$this->STYPE_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->STYPE_ID->Visible = false; // Disable update for API request
            } else {
                $this->STYPE_ID->setFormValue($val);
            }
        }

        // Check field name 'CLINIC_TYPE' first before field var 'x_CLINIC_TYPE'
        $val = $CurrentForm->hasValue("CLINIC_TYPE") ? $CurrentForm->getValue("CLINIC_TYPE") : $CurrentForm->getValue("x_CLINIC_TYPE");
        if (!$this->CLINIC_TYPE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLINIC_TYPE->Visible = false; // Disable update for API request
            } else {
                $this->CLINIC_TYPE->setFormValue($val);
            }
        }

        // Check field name 'OTHER_ID' first before field var 'x_OTHER_ID'
        $val = $CurrentForm->hasValue("OTHER_ID") ? $CurrentForm->getValue("OTHER_ID") : $CurrentForm->getValue("x_OTHER_ID");
        if (!$this->OTHER_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->OTHER_ID->Visible = false; // Disable update for API request
            } else {
                $this->OTHER_ID->setFormValue($val);
            }
        }

        // Check field name 'ACCOUNT_ID' first before field var 'x_ACCOUNT_ID'
        $val = $CurrentForm->hasValue("ACCOUNT_ID") ? $CurrentForm->getValue("ACCOUNT_ID") : $CurrentForm->getValue("x_ACCOUNT_ID");
        if (!$this->ACCOUNT_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ACCOUNT_ID->Visible = false; // Disable update for API request
            } else {
                $this->ACCOUNT_ID->setFormValue($val);
            }
        }

        // Check field name 'FA_V' first before field var 'x_FA_V'
        $val = $CurrentForm->hasValue("FA_V") ? $CurrentForm->getValue("FA_V") : $CurrentForm->getValue("x_FA_V");
        if (!$this->FA_V->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FA_V->Visible = false; // Disable update for API request
            } else {
                $this->FA_V->setFormValue($val);
            }
        }

        // Check field name 'PROFIT_ID' first before field var 'x_PROFIT_ID'
        $val = $CurrentForm->hasValue("PROFIT_ID") ? $CurrentForm->getValue("PROFIT_ID") : $CurrentForm->getValue("x_PROFIT_ID");
        if (!$this->PROFIT_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROFIT_ID->Visible = false; // Disable update for API request
            } else {
                $this->PROFIT_ID->setFormValue($val);
            }
        }

        // Check field name 'SUPPLIED_MM' first before field var 'x_SUPPLIED_MM'
        $val = $CurrentForm->hasValue("SUPPLIED_MM") ? $CurrentForm->getValue("SUPPLIED_MM") : $CurrentForm->getValue("x_SUPPLIED_MM");
        if (!$this->SUPPLIED_MM->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SUPPLIED_MM->Visible = false; // Disable update for API request
            } else {
                $this->SUPPLIED_MM->setFormValue($val);
            }
        }

        // Check field name 'KDPOLI' first before field var 'x_KDPOLI'
        $val = $CurrentForm->hasValue("KDPOLI") ? $CurrentForm->getValue("KDPOLI") : $CurrentForm->getValue("x_KDPOLI");
        if (!$this->KDPOLI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KDPOLI->Visible = false; // Disable update for API request
            } else {
                $this->KDPOLI->setFormValue($val);
            }
        }

        // Check field name 'PICTUREFILE' first before field var 'x_PICTUREFILE'
        $val = $CurrentForm->hasValue("PICTUREFILE") ? $CurrentForm->getValue("PICTUREFILE") : $CurrentForm->getValue("x_PICTUREFILE");
        if (!$this->PICTUREFILE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PICTUREFILE->Visible = false; // Disable update for API request
            } else {
                $this->PICTUREFILE->setFormValue($val);
            }
        }

        // Check field name 'PROFILES' first before field var 'x_PROFILES'
        $val = $CurrentForm->hasValue("PROFILES") ? $CurrentForm->getValue("PROFILES") : $CurrentForm->getValue("x_PROFILES");
        if (!$this->PROFILES->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROFILES->Visible = false; // Disable update for API request
            } else {
                $this->PROFILES->setFormValue($val);
            }
        }

        // Check field name 'SPESIALISTIK' first before field var 'x_SPESIALISTIK'
        $val = $CurrentForm->hasValue("SPESIALISTIK") ? $CurrentForm->getValue("SPESIALISTIK") : $CurrentForm->getValue("x_SPESIALISTIK");
        if (!$this->SPESIALISTIK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SPESIALISTIK->Visible = false; // Disable update for API request
            } else {
                $this->SPESIALISTIK->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ORG_UNIT_CODE->CurrentValue = $this->ORG_UNIT_CODE->FormValue;
        $this->CLINIC_ID->CurrentValue = $this->CLINIC_ID->FormValue;
        $this->NAME_OF_CLINIC->CurrentValue = $this->NAME_OF_CLINIC->FormValue;
        $this->ORG_ID->CurrentValue = $this->ORG_ID->FormValue;
        $this->STYPE_ID->CurrentValue = $this->STYPE_ID->FormValue;
        $this->CLINIC_TYPE->CurrentValue = $this->CLINIC_TYPE->FormValue;
        $this->OTHER_ID->CurrentValue = $this->OTHER_ID->FormValue;
        $this->ACCOUNT_ID->CurrentValue = $this->ACCOUNT_ID->FormValue;
        $this->FA_V->CurrentValue = $this->FA_V->FormValue;
        $this->PROFIT_ID->CurrentValue = $this->PROFIT_ID->FormValue;
        $this->SUPPLIED_MM->CurrentValue = $this->SUPPLIED_MM->FormValue;
        $this->KDPOLI->CurrentValue = $this->KDPOLI->FormValue;
        $this->PICTUREFILE->CurrentValue = $this->PICTUREFILE->FormValue;
        $this->PROFILES->CurrentValue = $this->PROFILES->FormValue;
        $this->SPESIALISTIK->CurrentValue = $this->SPESIALISTIK->FormValue;
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
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->NAME_OF_CLINIC->setDbValue($row['NAME_OF_CLINIC']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->STYPE_ID->setDbValue($row['STYPE_ID']);
        $this->CLINIC_TYPE->setDbValue($row['CLINIC_TYPE']);
        $this->OTHER_ID->setDbValue($row['OTHER_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->PROFIT_ID->setDbValue($row['PROFIT_ID']);
        $this->SUPPLIED_MM->setDbValue($row['SUPPLIED_MM']);
        $this->KDPOLI->setDbValue($row['KDPOLI']);
        $this->PICTUREFILE->setDbValue($row['PICTUREFILE']);
        $this->PROFILES->setDbValue($row['PROFILES']);
        $this->SPESIALISTIK->setDbValue($row['SPESIALISTIK']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['ORG_UNIT_CODE'] = $this->ORG_UNIT_CODE->CurrentValue;
        $row['CLINIC_ID'] = $this->CLINIC_ID->CurrentValue;
        $row['NAME_OF_CLINIC'] = $this->NAME_OF_CLINIC->CurrentValue;
        $row['ORG_ID'] = $this->ORG_ID->CurrentValue;
        $row['STYPE_ID'] = $this->STYPE_ID->CurrentValue;
        $row['CLINIC_TYPE'] = $this->CLINIC_TYPE->CurrentValue;
        $row['OTHER_ID'] = $this->OTHER_ID->CurrentValue;
        $row['ACCOUNT_ID'] = $this->ACCOUNT_ID->CurrentValue;
        $row['FA_V'] = $this->FA_V->CurrentValue;
        $row['PROFIT_ID'] = $this->PROFIT_ID->CurrentValue;
        $row['SUPPLIED_MM'] = $this->SUPPLIED_MM->CurrentValue;
        $row['KDPOLI'] = $this->KDPOLI->CurrentValue;
        $row['PICTUREFILE'] = $this->PICTUREFILE->CurrentValue;
        $row['PROFILES'] = $this->PROFILES->CurrentValue;
        $row['SPESIALISTIK'] = $this->SPESIALISTIK->CurrentValue;
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

        // CLINIC_ID

        // NAME_OF_CLINIC

        // ORG_ID

        // STYPE_ID

        // CLINIC_TYPE

        // OTHER_ID

        // ACCOUNT_ID

        // FA_V

        // PROFIT_ID

        // SUPPLIED_MM

        // KDPOLI

        // PICTUREFILE

        // PROFILES

        // SPESIALISTIK
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // CLINIC_ID
            $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
            $this->CLINIC_ID->ViewCustomAttributes = "";

            // NAME_OF_CLINIC
            $this->NAME_OF_CLINIC->ViewValue = $this->NAME_OF_CLINIC->CurrentValue;
            $this->NAME_OF_CLINIC->ViewCustomAttributes = "";

            // ORG_ID
            $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
            $this->ORG_ID->ViewCustomAttributes = "";

            // STYPE_ID
            $this->STYPE_ID->ViewValue = $this->STYPE_ID->CurrentValue;
            $this->STYPE_ID->ViewValue = FormatNumber($this->STYPE_ID->ViewValue, 0, -2, -2, -2);
            $this->STYPE_ID->ViewCustomAttributes = "";

            // CLINIC_TYPE
            $this->CLINIC_TYPE->ViewValue = $this->CLINIC_TYPE->CurrentValue;
            $this->CLINIC_TYPE->ViewValue = FormatNumber($this->CLINIC_TYPE->ViewValue, 0, -2, -2, -2);
            $this->CLINIC_TYPE->ViewCustomAttributes = "";

            // OTHER_ID
            $this->OTHER_ID->ViewValue = $this->OTHER_ID->CurrentValue;
            $this->OTHER_ID->ViewCustomAttributes = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
            $this->ACCOUNT_ID->ViewCustomAttributes = "";

            // FA_V
            $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
            $this->FA_V->ViewValue = FormatNumber($this->FA_V->ViewValue, 0, -2, -2, -2);
            $this->FA_V->ViewCustomAttributes = "";

            // PROFIT_ID
            $this->PROFIT_ID->ViewValue = $this->PROFIT_ID->CurrentValue;
            $this->PROFIT_ID->ViewCustomAttributes = "";

            // SUPPLIED_MM
            $this->SUPPLIED_MM->ViewValue = $this->SUPPLIED_MM->CurrentValue;
            $this->SUPPLIED_MM->ViewCustomAttributes = "";

            // KDPOLI
            $this->KDPOLI->ViewValue = $this->KDPOLI->CurrentValue;
            $this->KDPOLI->ViewCustomAttributes = "";

            // PICTUREFILE
            $this->PICTUREFILE->ViewValue = $this->PICTUREFILE->CurrentValue;
            $this->PICTUREFILE->ViewCustomAttributes = "";

            // PROFILES
            $this->PROFILES->ViewValue = $this->PROFILES->CurrentValue;
            $this->PROFILES->ViewCustomAttributes = "";

            // SPESIALISTIK
            $this->SPESIALISTIK->ViewValue = $this->SPESIALISTIK->CurrentValue;
            $this->SPESIALISTIK->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";
            $this->CLINIC_ID->TooltipValue = "";

            // NAME_OF_CLINIC
            $this->NAME_OF_CLINIC->LinkCustomAttributes = "";
            $this->NAME_OF_CLINIC->HrefValue = "";
            $this->NAME_OF_CLINIC->TooltipValue = "";

            // ORG_ID
            $this->ORG_ID->LinkCustomAttributes = "";
            $this->ORG_ID->HrefValue = "";
            $this->ORG_ID->TooltipValue = "";

            // STYPE_ID
            $this->STYPE_ID->LinkCustomAttributes = "";
            $this->STYPE_ID->HrefValue = "";
            $this->STYPE_ID->TooltipValue = "";

            // CLINIC_TYPE
            $this->CLINIC_TYPE->LinkCustomAttributes = "";
            $this->CLINIC_TYPE->HrefValue = "";
            $this->CLINIC_TYPE->TooltipValue = "";

            // OTHER_ID
            $this->OTHER_ID->LinkCustomAttributes = "";
            $this->OTHER_ID->HrefValue = "";
            $this->OTHER_ID->TooltipValue = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->LinkCustomAttributes = "";
            $this->ACCOUNT_ID->HrefValue = "";
            $this->ACCOUNT_ID->TooltipValue = "";

            // FA_V
            $this->FA_V->LinkCustomAttributes = "";
            $this->FA_V->HrefValue = "";
            $this->FA_V->TooltipValue = "";

            // PROFIT_ID
            $this->PROFIT_ID->LinkCustomAttributes = "";
            $this->PROFIT_ID->HrefValue = "";
            $this->PROFIT_ID->TooltipValue = "";

            // SUPPLIED_MM
            $this->SUPPLIED_MM->LinkCustomAttributes = "";
            $this->SUPPLIED_MM->HrefValue = "";
            $this->SUPPLIED_MM->TooltipValue = "";

            // KDPOLI
            $this->KDPOLI->LinkCustomAttributes = "";
            $this->KDPOLI->HrefValue = "";
            $this->KDPOLI->TooltipValue = "";

            // PICTUREFILE
            $this->PICTUREFILE->LinkCustomAttributes = "";
            $this->PICTUREFILE->HrefValue = "";
            $this->PICTUREFILE->TooltipValue = "";

            // PROFILES
            $this->PROFILES->LinkCustomAttributes = "";
            $this->PROFILES->HrefValue = "";
            $this->PROFILES->TooltipValue = "";

            // SPESIALISTIK
            $this->SPESIALISTIK->LinkCustomAttributes = "";
            $this->SPESIALISTIK->HrefValue = "";
            $this->SPESIALISTIK->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
            $this->ORG_UNIT_CODE->EditCustomAttributes = "";
            if (!$this->ORG_UNIT_CODE->Raw) {
                $this->ORG_UNIT_CODE->CurrentValue = HtmlDecode($this->ORG_UNIT_CODE->CurrentValue);
            }
            $this->ORG_UNIT_CODE->EditValue = HtmlEncode($this->ORG_UNIT_CODE->CurrentValue);
            $this->ORG_UNIT_CODE->PlaceHolder = RemoveHtml($this->ORG_UNIT_CODE->caption());

            // CLINIC_ID
            $this->CLINIC_ID->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID->EditCustomAttributes = "";
            if (!$this->CLINIC_ID->Raw) {
                $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
            }
            $this->CLINIC_ID->EditValue = HtmlEncode($this->CLINIC_ID->CurrentValue);
            $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

            // NAME_OF_CLINIC
            $this->NAME_OF_CLINIC->EditAttrs["class"] = "form-control";
            $this->NAME_OF_CLINIC->EditCustomAttributes = "";
            if (!$this->NAME_OF_CLINIC->Raw) {
                $this->NAME_OF_CLINIC->CurrentValue = HtmlDecode($this->NAME_OF_CLINIC->CurrentValue);
            }
            $this->NAME_OF_CLINIC->EditValue = HtmlEncode($this->NAME_OF_CLINIC->CurrentValue);
            $this->NAME_OF_CLINIC->PlaceHolder = RemoveHtml($this->NAME_OF_CLINIC->caption());

            // ORG_ID
            $this->ORG_ID->EditAttrs["class"] = "form-control";
            $this->ORG_ID->EditCustomAttributes = "";
            if (!$this->ORG_ID->Raw) {
                $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
            }
            $this->ORG_ID->EditValue = HtmlEncode($this->ORG_ID->CurrentValue);
            $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

            // STYPE_ID
            $this->STYPE_ID->EditAttrs["class"] = "form-control";
            $this->STYPE_ID->EditCustomAttributes = "";
            $this->STYPE_ID->EditValue = HtmlEncode($this->STYPE_ID->CurrentValue);
            $this->STYPE_ID->PlaceHolder = RemoveHtml($this->STYPE_ID->caption());

            // CLINIC_TYPE
            $this->CLINIC_TYPE->EditAttrs["class"] = "form-control";
            $this->CLINIC_TYPE->EditCustomAttributes = "";
            $this->CLINIC_TYPE->EditValue = HtmlEncode($this->CLINIC_TYPE->CurrentValue);
            $this->CLINIC_TYPE->PlaceHolder = RemoveHtml($this->CLINIC_TYPE->caption());

            // OTHER_ID
            $this->OTHER_ID->EditAttrs["class"] = "form-control";
            $this->OTHER_ID->EditCustomAttributes = "";
            if (!$this->OTHER_ID->Raw) {
                $this->OTHER_ID->CurrentValue = HtmlDecode($this->OTHER_ID->CurrentValue);
            }
            $this->OTHER_ID->EditValue = HtmlEncode($this->OTHER_ID->CurrentValue);
            $this->OTHER_ID->PlaceHolder = RemoveHtml($this->OTHER_ID->caption());

            // ACCOUNT_ID
            $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
            $this->ACCOUNT_ID->EditCustomAttributes = "";
            if (!$this->ACCOUNT_ID->Raw) {
                $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
            }
            $this->ACCOUNT_ID->EditValue = HtmlEncode($this->ACCOUNT_ID->CurrentValue);
            $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

            // FA_V
            $this->FA_V->EditAttrs["class"] = "form-control";
            $this->FA_V->EditCustomAttributes = "";
            $this->FA_V->EditValue = HtmlEncode($this->FA_V->CurrentValue);
            $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

            // PROFIT_ID
            $this->PROFIT_ID->EditAttrs["class"] = "form-control";
            $this->PROFIT_ID->EditCustomAttributes = "";
            if (!$this->PROFIT_ID->Raw) {
                $this->PROFIT_ID->CurrentValue = HtmlDecode($this->PROFIT_ID->CurrentValue);
            }
            $this->PROFIT_ID->EditValue = HtmlEncode($this->PROFIT_ID->CurrentValue);
            $this->PROFIT_ID->PlaceHolder = RemoveHtml($this->PROFIT_ID->caption());

            // SUPPLIED_MM
            $this->SUPPLIED_MM->EditAttrs["class"] = "form-control";
            $this->SUPPLIED_MM->EditCustomAttributes = "";
            if (!$this->SUPPLIED_MM->Raw) {
                $this->SUPPLIED_MM->CurrentValue = HtmlDecode($this->SUPPLIED_MM->CurrentValue);
            }
            $this->SUPPLIED_MM->EditValue = HtmlEncode($this->SUPPLIED_MM->CurrentValue);
            $this->SUPPLIED_MM->PlaceHolder = RemoveHtml($this->SUPPLIED_MM->caption());

            // KDPOLI
            $this->KDPOLI->EditAttrs["class"] = "form-control";
            $this->KDPOLI->EditCustomAttributes = "";
            if (!$this->KDPOLI->Raw) {
                $this->KDPOLI->CurrentValue = HtmlDecode($this->KDPOLI->CurrentValue);
            }
            $this->KDPOLI->EditValue = HtmlEncode($this->KDPOLI->CurrentValue);
            $this->KDPOLI->PlaceHolder = RemoveHtml($this->KDPOLI->caption());

            // PICTUREFILE
            $this->PICTUREFILE->EditAttrs["class"] = "form-control";
            $this->PICTUREFILE->EditCustomAttributes = "";
            $this->PICTUREFILE->EditValue = HtmlEncode($this->PICTUREFILE->CurrentValue);
            $this->PICTUREFILE->PlaceHolder = RemoveHtml($this->PICTUREFILE->caption());

            // PROFILES
            $this->PROFILES->EditAttrs["class"] = "form-control";
            $this->PROFILES->EditCustomAttributes = "";
            $this->PROFILES->EditValue = HtmlEncode($this->PROFILES->CurrentValue);
            $this->PROFILES->PlaceHolder = RemoveHtml($this->PROFILES->caption());

            // SPESIALISTIK
            $this->SPESIALISTIK->EditAttrs["class"] = "form-control";
            $this->SPESIALISTIK->EditCustomAttributes = "";
            if (!$this->SPESIALISTIK->Raw) {
                $this->SPESIALISTIK->CurrentValue = HtmlDecode($this->SPESIALISTIK->CurrentValue);
            }
            $this->SPESIALISTIK->EditValue = HtmlEncode($this->SPESIALISTIK->CurrentValue);
            $this->SPESIALISTIK->PlaceHolder = RemoveHtml($this->SPESIALISTIK->caption());

            // Add refer script

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";

            // NAME_OF_CLINIC
            $this->NAME_OF_CLINIC->LinkCustomAttributes = "";
            $this->NAME_OF_CLINIC->HrefValue = "";

            // ORG_ID
            $this->ORG_ID->LinkCustomAttributes = "";
            $this->ORG_ID->HrefValue = "";

            // STYPE_ID
            $this->STYPE_ID->LinkCustomAttributes = "";
            $this->STYPE_ID->HrefValue = "";

            // CLINIC_TYPE
            $this->CLINIC_TYPE->LinkCustomAttributes = "";
            $this->CLINIC_TYPE->HrefValue = "";

            // OTHER_ID
            $this->OTHER_ID->LinkCustomAttributes = "";
            $this->OTHER_ID->HrefValue = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->LinkCustomAttributes = "";
            $this->ACCOUNT_ID->HrefValue = "";

            // FA_V
            $this->FA_V->LinkCustomAttributes = "";
            $this->FA_V->HrefValue = "";

            // PROFIT_ID
            $this->PROFIT_ID->LinkCustomAttributes = "";
            $this->PROFIT_ID->HrefValue = "";

            // SUPPLIED_MM
            $this->SUPPLIED_MM->LinkCustomAttributes = "";
            $this->SUPPLIED_MM->HrefValue = "";

            // KDPOLI
            $this->KDPOLI->LinkCustomAttributes = "";
            $this->KDPOLI->HrefValue = "";

            // PICTUREFILE
            $this->PICTUREFILE->LinkCustomAttributes = "";
            $this->PICTUREFILE->HrefValue = "";

            // PROFILES
            $this->PROFILES->LinkCustomAttributes = "";
            $this->PROFILES->HrefValue = "";

            // SPESIALISTIK
            $this->SPESIALISTIK->LinkCustomAttributes = "";
            $this->SPESIALISTIK->HrefValue = "";
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
        if ($this->CLINIC_ID->Required) {
            if (!$this->CLINIC_ID->IsDetailKey && EmptyValue($this->CLINIC_ID->FormValue)) {
                $this->CLINIC_ID->addErrorMessage(str_replace("%s", $this->CLINIC_ID->caption(), $this->CLINIC_ID->RequiredErrorMessage));
            }
        }
        if ($this->NAME_OF_CLINIC->Required) {
            if (!$this->NAME_OF_CLINIC->IsDetailKey && EmptyValue($this->NAME_OF_CLINIC->FormValue)) {
                $this->NAME_OF_CLINIC->addErrorMessage(str_replace("%s", $this->NAME_OF_CLINIC->caption(), $this->NAME_OF_CLINIC->RequiredErrorMessage));
            }
        }
        if ($this->ORG_ID->Required) {
            if (!$this->ORG_ID->IsDetailKey && EmptyValue($this->ORG_ID->FormValue)) {
                $this->ORG_ID->addErrorMessage(str_replace("%s", $this->ORG_ID->caption(), $this->ORG_ID->RequiredErrorMessage));
            }
        }
        if ($this->STYPE_ID->Required) {
            if (!$this->STYPE_ID->IsDetailKey && EmptyValue($this->STYPE_ID->FormValue)) {
                $this->STYPE_ID->addErrorMessage(str_replace("%s", $this->STYPE_ID->caption(), $this->STYPE_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->STYPE_ID->FormValue)) {
            $this->STYPE_ID->addErrorMessage($this->STYPE_ID->getErrorMessage(false));
        }
        if ($this->CLINIC_TYPE->Required) {
            if (!$this->CLINIC_TYPE->IsDetailKey && EmptyValue($this->CLINIC_TYPE->FormValue)) {
                $this->CLINIC_TYPE->addErrorMessage(str_replace("%s", $this->CLINIC_TYPE->caption(), $this->CLINIC_TYPE->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->CLINIC_TYPE->FormValue)) {
            $this->CLINIC_TYPE->addErrorMessage($this->CLINIC_TYPE->getErrorMessage(false));
        }
        if ($this->OTHER_ID->Required) {
            if (!$this->OTHER_ID->IsDetailKey && EmptyValue($this->OTHER_ID->FormValue)) {
                $this->OTHER_ID->addErrorMessage(str_replace("%s", $this->OTHER_ID->caption(), $this->OTHER_ID->RequiredErrorMessage));
            }
        }
        if ($this->ACCOUNT_ID->Required) {
            if (!$this->ACCOUNT_ID->IsDetailKey && EmptyValue($this->ACCOUNT_ID->FormValue)) {
                $this->ACCOUNT_ID->addErrorMessage(str_replace("%s", $this->ACCOUNT_ID->caption(), $this->ACCOUNT_ID->RequiredErrorMessage));
            }
        }
        if ($this->FA_V->Required) {
            if (!$this->FA_V->IsDetailKey && EmptyValue($this->FA_V->FormValue)) {
                $this->FA_V->addErrorMessage(str_replace("%s", $this->FA_V->caption(), $this->FA_V->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->FA_V->FormValue)) {
            $this->FA_V->addErrorMessage($this->FA_V->getErrorMessage(false));
        }
        if ($this->PROFIT_ID->Required) {
            if (!$this->PROFIT_ID->IsDetailKey && EmptyValue($this->PROFIT_ID->FormValue)) {
                $this->PROFIT_ID->addErrorMessage(str_replace("%s", $this->PROFIT_ID->caption(), $this->PROFIT_ID->RequiredErrorMessage));
            }
        }
        if ($this->SUPPLIED_MM->Required) {
            if (!$this->SUPPLIED_MM->IsDetailKey && EmptyValue($this->SUPPLIED_MM->FormValue)) {
                $this->SUPPLIED_MM->addErrorMessage(str_replace("%s", $this->SUPPLIED_MM->caption(), $this->SUPPLIED_MM->RequiredErrorMessage));
            }
        }
        if ($this->KDPOLI->Required) {
            if (!$this->KDPOLI->IsDetailKey && EmptyValue($this->KDPOLI->FormValue)) {
                $this->KDPOLI->addErrorMessage(str_replace("%s", $this->KDPOLI->caption(), $this->KDPOLI->RequiredErrorMessage));
            }
        }
        if ($this->PICTUREFILE->Required) {
            if (!$this->PICTUREFILE->IsDetailKey && EmptyValue($this->PICTUREFILE->FormValue)) {
                $this->PICTUREFILE->addErrorMessage(str_replace("%s", $this->PICTUREFILE->caption(), $this->PICTUREFILE->RequiredErrorMessage));
            }
        }
        if ($this->PROFILES->Required) {
            if (!$this->PROFILES->IsDetailKey && EmptyValue($this->PROFILES->FormValue)) {
                $this->PROFILES->addErrorMessage(str_replace("%s", $this->PROFILES->caption(), $this->PROFILES->RequiredErrorMessage));
            }
        }
        if ($this->SPESIALISTIK->Required) {
            if (!$this->SPESIALISTIK->IsDetailKey && EmptyValue($this->SPESIALISTIK->FormValue)) {
                $this->SPESIALISTIK->addErrorMessage(str_replace("%s", $this->SPESIALISTIK->caption(), $this->SPESIALISTIK->RequiredErrorMessage));
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

        // CLINIC_ID
        $this->CLINIC_ID->setDbValueDef($rsnew, $this->CLINIC_ID->CurrentValue, "", false);

        // NAME_OF_CLINIC
        $this->NAME_OF_CLINIC->setDbValueDef($rsnew, $this->NAME_OF_CLINIC->CurrentValue, null, false);

        // ORG_ID
        $this->ORG_ID->setDbValueDef($rsnew, $this->ORG_ID->CurrentValue, null, false);

        // STYPE_ID
        $this->STYPE_ID->setDbValueDef($rsnew, $this->STYPE_ID->CurrentValue, null, false);

        // CLINIC_TYPE
        $this->CLINIC_TYPE->setDbValueDef($rsnew, $this->CLINIC_TYPE->CurrentValue, null, false);

        // OTHER_ID
        $this->OTHER_ID->setDbValueDef($rsnew, $this->OTHER_ID->CurrentValue, null, false);

        // ACCOUNT_ID
        $this->ACCOUNT_ID->setDbValueDef($rsnew, $this->ACCOUNT_ID->CurrentValue, null, false);

        // FA_V
        $this->FA_V->setDbValueDef($rsnew, $this->FA_V->CurrentValue, null, false);

        // PROFIT_ID
        $this->PROFIT_ID->setDbValueDef($rsnew, $this->PROFIT_ID->CurrentValue, null, false);

        // SUPPLIED_MM
        $this->SUPPLIED_MM->setDbValueDef($rsnew, $this->SUPPLIED_MM->CurrentValue, null, false);

        // KDPOLI
        $this->KDPOLI->setDbValueDef($rsnew, $this->KDPOLI->CurrentValue, null, false);

        // PICTUREFILE
        $this->PICTUREFILE->setDbValueDef($rsnew, $this->PICTUREFILE->CurrentValue, null, false);

        // PROFILES
        $this->PROFILES->setDbValueDef($rsnew, $this->PROFILES->CurrentValue, null, false);

        // SPESIALISTIK
        $this->SPESIALISTIK->setDbValueDef($rsnew, $this->SPESIALISTIK->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['ORG_UNIT_CODE']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['CLINIC_ID']) == "") {
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ClinicList"), "", $this->TableVar, true);
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
