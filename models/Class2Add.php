<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class Class2Add extends Class2
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'CLASS';

    // Page object name
    public $PageObjName = "Class2Add";

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

        // Table object (CLASS2)
        if (!isset($GLOBALS["CLASS2"]) || get_class($GLOBALS["CLASS2"]) == PROJECT_NAMESPACE . "CLASS2") {
            $GLOBALS["CLASS2"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'CLASS');
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
                $doc = new $class(Container("CLASS2"));
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
                    if ($pageName == "Class2View") {
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
            $key .= @$ar['CLASS_ID'];
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
        $this->CLASS_ID->setVisibility();
        $this->NAME_OF_CLASS->setVisibility();
        $this->OTHER_ID->setVisibility();
        $this->KDKELASV->setVisibility();
        $this->KODEKELAS->setVisibility();
        $this->SISKODEKELAS->setVisibility();
        $this->SISKODERAWAT->setVisibility();
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
            if (($keyValue = Get("CLASS_ID") ?? Route("CLASS_ID")) !== null) {
                $this->CLASS_ID->setQueryStringValue($keyValue);
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
                    $this->terminate("Class2List"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "Class2List") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "Class2View") {
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
        $this->CLASS_ID->CurrentValue = null;
        $this->CLASS_ID->OldValue = $this->CLASS_ID->CurrentValue;
        $this->NAME_OF_CLASS->CurrentValue = null;
        $this->NAME_OF_CLASS->OldValue = $this->NAME_OF_CLASS->CurrentValue;
        $this->OTHER_ID->CurrentValue = null;
        $this->OTHER_ID->OldValue = $this->OTHER_ID->CurrentValue;
        $this->KDKELASV->CurrentValue = null;
        $this->KDKELASV->OldValue = $this->KDKELASV->CurrentValue;
        $this->KODEKELAS->CurrentValue = null;
        $this->KODEKELAS->OldValue = $this->KODEKELAS->CurrentValue;
        $this->SISKODEKELAS->CurrentValue = null;
        $this->SISKODEKELAS->OldValue = $this->SISKODEKELAS->CurrentValue;
        $this->SISKODERAWAT->CurrentValue = null;
        $this->SISKODERAWAT->OldValue = $this->SISKODERAWAT->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'CLASS_ID' first before field var 'x_CLASS_ID'
        $val = $CurrentForm->hasValue("CLASS_ID") ? $CurrentForm->getValue("CLASS_ID") : $CurrentForm->getValue("x_CLASS_ID");
        if (!$this->CLASS_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLASS_ID->Visible = false; // Disable update for API request
            } else {
                $this->CLASS_ID->setFormValue($val);
            }
        }

        // Check field name 'NAME_OF_CLASS' first before field var 'x_NAME_OF_CLASS'
        $val = $CurrentForm->hasValue("NAME_OF_CLASS") ? $CurrentForm->getValue("NAME_OF_CLASS") : $CurrentForm->getValue("x_NAME_OF_CLASS");
        if (!$this->NAME_OF_CLASS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAME_OF_CLASS->Visible = false; // Disable update for API request
            } else {
                $this->NAME_OF_CLASS->setFormValue($val);
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

        // Check field name 'KDKELASV' first before field var 'x_KDKELASV'
        $val = $CurrentForm->hasValue("KDKELASV") ? $CurrentForm->getValue("KDKELASV") : $CurrentForm->getValue("x_KDKELASV");
        if (!$this->KDKELASV->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KDKELASV->Visible = false; // Disable update for API request
            } else {
                $this->KDKELASV->setFormValue($val);
            }
        }

        // Check field name 'KODEKELAS' first before field var 'x_KODEKELAS'
        $val = $CurrentForm->hasValue("KODEKELAS") ? $CurrentForm->getValue("KODEKELAS") : $CurrentForm->getValue("x_KODEKELAS");
        if (!$this->KODEKELAS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KODEKELAS->Visible = false; // Disable update for API request
            } else {
                $this->KODEKELAS->setFormValue($val);
            }
        }

        // Check field name 'SISKODEKELAS' first before field var 'x_SISKODEKELAS'
        $val = $CurrentForm->hasValue("SISKODEKELAS") ? $CurrentForm->getValue("SISKODEKELAS") : $CurrentForm->getValue("x_SISKODEKELAS");
        if (!$this->SISKODEKELAS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SISKODEKELAS->Visible = false; // Disable update for API request
            } else {
                $this->SISKODEKELAS->setFormValue($val);
            }
        }

        // Check field name 'SISKODERAWAT' first before field var 'x_SISKODERAWAT'
        $val = $CurrentForm->hasValue("SISKODERAWAT") ? $CurrentForm->getValue("SISKODERAWAT") : $CurrentForm->getValue("x_SISKODERAWAT");
        if (!$this->SISKODERAWAT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SISKODERAWAT->Visible = false; // Disable update for API request
            } else {
                $this->SISKODERAWAT->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->CLASS_ID->CurrentValue = $this->CLASS_ID->FormValue;
        $this->NAME_OF_CLASS->CurrentValue = $this->NAME_OF_CLASS->FormValue;
        $this->OTHER_ID->CurrentValue = $this->OTHER_ID->FormValue;
        $this->KDKELASV->CurrentValue = $this->KDKELASV->FormValue;
        $this->KODEKELAS->CurrentValue = $this->KODEKELAS->FormValue;
        $this->SISKODEKELAS->CurrentValue = $this->SISKODEKELAS->FormValue;
        $this->SISKODERAWAT->CurrentValue = $this->SISKODERAWAT->FormValue;
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
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->NAME_OF_CLASS->setDbValue($row['NAME_OF_CLASS']);
        $this->OTHER_ID->setDbValue($row['OTHER_ID']);
        $this->KDKELASV->setDbValue($row['KDKELASV']);
        $this->KODEKELAS->setDbValue($row['KODEKELAS']);
        $this->SISKODEKELAS->setDbValue($row['SISKODEKELAS']);
        $this->SISKODERAWAT->setDbValue($row['SISKODERAWAT']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['CLASS_ID'] = $this->CLASS_ID->CurrentValue;
        $row['NAME_OF_CLASS'] = $this->NAME_OF_CLASS->CurrentValue;
        $row['OTHER_ID'] = $this->OTHER_ID->CurrentValue;
        $row['KDKELASV'] = $this->KDKELASV->CurrentValue;
        $row['KODEKELAS'] = $this->KODEKELAS->CurrentValue;
        $row['SISKODEKELAS'] = $this->SISKODEKELAS->CurrentValue;
        $row['SISKODERAWAT'] = $this->SISKODERAWAT->CurrentValue;
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

        // CLASS_ID

        // NAME_OF_CLASS

        // OTHER_ID

        // KDKELASV

        // KODEKELAS

        // SISKODEKELAS

        // SISKODERAWAT
        if ($this->RowType == ROWTYPE_VIEW) {
            // CLASS_ID
            $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
            $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
            $this->CLASS_ID->ViewCustomAttributes = "";

            // NAME_OF_CLASS
            $this->NAME_OF_CLASS->ViewValue = $this->NAME_OF_CLASS->CurrentValue;
            $this->NAME_OF_CLASS->ViewCustomAttributes = "";

            // OTHER_ID
            $this->OTHER_ID->ViewValue = $this->OTHER_ID->CurrentValue;
            $this->OTHER_ID->ViewCustomAttributes = "";

            // KDKELASV
            $this->KDKELASV->ViewValue = $this->KDKELASV->CurrentValue;
            $this->KDKELASV->ViewCustomAttributes = "";

            // KODEKELAS
            $this->KODEKELAS->ViewValue = $this->KODEKELAS->CurrentValue;
            $this->KODEKELAS->ViewCustomAttributes = "";

            // SISKODEKELAS
            $this->SISKODEKELAS->ViewValue = $this->SISKODEKELAS->CurrentValue;
            $this->SISKODEKELAS->ViewCustomAttributes = "";

            // SISKODERAWAT
            $this->SISKODERAWAT->ViewValue = $this->SISKODERAWAT->CurrentValue;
            $this->SISKODERAWAT->ViewCustomAttributes = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";
            $this->CLASS_ID->TooltipValue = "";

            // NAME_OF_CLASS
            $this->NAME_OF_CLASS->LinkCustomAttributes = "";
            $this->NAME_OF_CLASS->HrefValue = "";
            $this->NAME_OF_CLASS->TooltipValue = "";

            // OTHER_ID
            $this->OTHER_ID->LinkCustomAttributes = "";
            $this->OTHER_ID->HrefValue = "";
            $this->OTHER_ID->TooltipValue = "";

            // KDKELASV
            $this->KDKELASV->LinkCustomAttributes = "";
            $this->KDKELASV->HrefValue = "";
            $this->KDKELASV->TooltipValue = "";

            // KODEKELAS
            $this->KODEKELAS->LinkCustomAttributes = "";
            $this->KODEKELAS->HrefValue = "";
            $this->KODEKELAS->TooltipValue = "";

            // SISKODEKELAS
            $this->SISKODEKELAS->LinkCustomAttributes = "";
            $this->SISKODEKELAS->HrefValue = "";
            $this->SISKODEKELAS->TooltipValue = "";

            // SISKODERAWAT
            $this->SISKODERAWAT->LinkCustomAttributes = "";
            $this->SISKODERAWAT->HrefValue = "";
            $this->SISKODERAWAT->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // CLASS_ID
            $this->CLASS_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ID->EditCustomAttributes = "";
            $this->CLASS_ID->EditValue = HtmlEncode($this->CLASS_ID->CurrentValue);
            $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

            // NAME_OF_CLASS
            $this->NAME_OF_CLASS->EditAttrs["class"] = "form-control";
            $this->NAME_OF_CLASS->EditCustomAttributes = "";
            if (!$this->NAME_OF_CLASS->Raw) {
                $this->NAME_OF_CLASS->CurrentValue = HtmlDecode($this->NAME_OF_CLASS->CurrentValue);
            }
            $this->NAME_OF_CLASS->EditValue = HtmlEncode($this->NAME_OF_CLASS->CurrentValue);
            $this->NAME_OF_CLASS->PlaceHolder = RemoveHtml($this->NAME_OF_CLASS->caption());

            // OTHER_ID
            $this->OTHER_ID->EditAttrs["class"] = "form-control";
            $this->OTHER_ID->EditCustomAttributes = "";
            if (!$this->OTHER_ID->Raw) {
                $this->OTHER_ID->CurrentValue = HtmlDecode($this->OTHER_ID->CurrentValue);
            }
            $this->OTHER_ID->EditValue = HtmlEncode($this->OTHER_ID->CurrentValue);
            $this->OTHER_ID->PlaceHolder = RemoveHtml($this->OTHER_ID->caption());

            // KDKELASV
            $this->KDKELASV->EditAttrs["class"] = "form-control";
            $this->KDKELASV->EditCustomAttributes = "";
            if (!$this->KDKELASV->Raw) {
                $this->KDKELASV->CurrentValue = HtmlDecode($this->KDKELASV->CurrentValue);
            }
            $this->KDKELASV->EditValue = HtmlEncode($this->KDKELASV->CurrentValue);
            $this->KDKELASV->PlaceHolder = RemoveHtml($this->KDKELASV->caption());

            // KODEKELAS
            $this->KODEKELAS->EditAttrs["class"] = "form-control";
            $this->KODEKELAS->EditCustomAttributes = "";
            if (!$this->KODEKELAS->Raw) {
                $this->KODEKELAS->CurrentValue = HtmlDecode($this->KODEKELAS->CurrentValue);
            }
            $this->KODEKELAS->EditValue = HtmlEncode($this->KODEKELAS->CurrentValue);
            $this->KODEKELAS->PlaceHolder = RemoveHtml($this->KODEKELAS->caption());

            // SISKODEKELAS
            $this->SISKODEKELAS->EditAttrs["class"] = "form-control";
            $this->SISKODEKELAS->EditCustomAttributes = "";
            if (!$this->SISKODEKELAS->Raw) {
                $this->SISKODEKELAS->CurrentValue = HtmlDecode($this->SISKODEKELAS->CurrentValue);
            }
            $this->SISKODEKELAS->EditValue = HtmlEncode($this->SISKODEKELAS->CurrentValue);
            $this->SISKODEKELAS->PlaceHolder = RemoveHtml($this->SISKODEKELAS->caption());

            // SISKODERAWAT
            $this->SISKODERAWAT->EditAttrs["class"] = "form-control";
            $this->SISKODERAWAT->EditCustomAttributes = "";
            if (!$this->SISKODERAWAT->Raw) {
                $this->SISKODERAWAT->CurrentValue = HtmlDecode($this->SISKODERAWAT->CurrentValue);
            }
            $this->SISKODERAWAT->EditValue = HtmlEncode($this->SISKODERAWAT->CurrentValue);
            $this->SISKODERAWAT->PlaceHolder = RemoveHtml($this->SISKODERAWAT->caption());

            // Add refer script

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";

            // NAME_OF_CLASS
            $this->NAME_OF_CLASS->LinkCustomAttributes = "";
            $this->NAME_OF_CLASS->HrefValue = "";

            // OTHER_ID
            $this->OTHER_ID->LinkCustomAttributes = "";
            $this->OTHER_ID->HrefValue = "";

            // KDKELASV
            $this->KDKELASV->LinkCustomAttributes = "";
            $this->KDKELASV->HrefValue = "";

            // KODEKELAS
            $this->KODEKELAS->LinkCustomAttributes = "";
            $this->KODEKELAS->HrefValue = "";

            // SISKODEKELAS
            $this->SISKODEKELAS->LinkCustomAttributes = "";
            $this->SISKODEKELAS->HrefValue = "";

            // SISKODERAWAT
            $this->SISKODERAWAT->LinkCustomAttributes = "";
            $this->SISKODERAWAT->HrefValue = "";
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
        if ($this->CLASS_ID->Required) {
            if (!$this->CLASS_ID->IsDetailKey && EmptyValue($this->CLASS_ID->FormValue)) {
                $this->CLASS_ID->addErrorMessage(str_replace("%s", $this->CLASS_ID->caption(), $this->CLASS_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->CLASS_ID->FormValue)) {
            $this->CLASS_ID->addErrorMessage($this->CLASS_ID->getErrorMessage(false));
        }
        if ($this->NAME_OF_CLASS->Required) {
            if (!$this->NAME_OF_CLASS->IsDetailKey && EmptyValue($this->NAME_OF_CLASS->FormValue)) {
                $this->NAME_OF_CLASS->addErrorMessage(str_replace("%s", $this->NAME_OF_CLASS->caption(), $this->NAME_OF_CLASS->RequiredErrorMessage));
            }
        }
        if ($this->OTHER_ID->Required) {
            if (!$this->OTHER_ID->IsDetailKey && EmptyValue($this->OTHER_ID->FormValue)) {
                $this->OTHER_ID->addErrorMessage(str_replace("%s", $this->OTHER_ID->caption(), $this->OTHER_ID->RequiredErrorMessage));
            }
        }
        if ($this->KDKELASV->Required) {
            if (!$this->KDKELASV->IsDetailKey && EmptyValue($this->KDKELASV->FormValue)) {
                $this->KDKELASV->addErrorMessage(str_replace("%s", $this->KDKELASV->caption(), $this->KDKELASV->RequiredErrorMessage));
            }
        }
        if ($this->KODEKELAS->Required) {
            if (!$this->KODEKELAS->IsDetailKey && EmptyValue($this->KODEKELAS->FormValue)) {
                $this->KODEKELAS->addErrorMessage(str_replace("%s", $this->KODEKELAS->caption(), $this->KODEKELAS->RequiredErrorMessage));
            }
        }
        if ($this->SISKODEKELAS->Required) {
            if (!$this->SISKODEKELAS->IsDetailKey && EmptyValue($this->SISKODEKELAS->FormValue)) {
                $this->SISKODEKELAS->addErrorMessage(str_replace("%s", $this->SISKODEKELAS->caption(), $this->SISKODEKELAS->RequiredErrorMessage));
            }
        }
        if ($this->SISKODERAWAT->Required) {
            if (!$this->SISKODERAWAT->IsDetailKey && EmptyValue($this->SISKODERAWAT->FormValue)) {
                $this->SISKODERAWAT->addErrorMessage(str_replace("%s", $this->SISKODERAWAT->caption(), $this->SISKODERAWAT->RequiredErrorMessage));
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
        if ($this->CLASS_ID->CurrentValue != "") { // Check field with unique index
            $filter = "([CLASS_ID] = " . AdjustSql($this->CLASS_ID->CurrentValue, $this->Dbid) . ")";
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $idxErrMsg = str_replace("%f", $this->CLASS_ID->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->CLASS_ID->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // CLASS_ID
        $this->CLASS_ID->setDbValueDef($rsnew, $this->CLASS_ID->CurrentValue, 0, false);

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS->setDbValueDef($rsnew, $this->NAME_OF_CLASS->CurrentValue, null, false);

        // OTHER_ID
        $this->OTHER_ID->setDbValueDef($rsnew, $this->OTHER_ID->CurrentValue, null, false);

        // KDKELASV
        $this->KDKELASV->setDbValueDef($rsnew, $this->KDKELASV->CurrentValue, null, false);

        // KODEKELAS
        $this->KODEKELAS->setDbValueDef($rsnew, $this->KODEKELAS->CurrentValue, null, false);

        // SISKODEKELAS
        $this->SISKODEKELAS->setDbValueDef($rsnew, $this->SISKODEKELAS->CurrentValue, null, false);

        // SISKODERAWAT
        $this->SISKODERAWAT->setDbValueDef($rsnew, $this->SISKODERAWAT->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['CLASS_ID']) == "") {
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Class2List"), "", $this->TableVar, true);
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
