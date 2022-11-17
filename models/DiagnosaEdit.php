<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class DiagnosaEdit extends Diagnosa
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'DIAGNOSA';

    // Page object name
    public $PageObjName = "DiagnosaEdit";

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

        // Table object (DIAGNOSA)
        if (!isset($GLOBALS["DIAGNOSA"]) || get_class($GLOBALS["DIAGNOSA"]) == PROJECT_NAMESPACE . "DIAGNOSA") {
            $GLOBALS["DIAGNOSA"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'DIAGNOSA');
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
                $doc = new $class(Container("DIAGNOSA"));
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
                    if ($pageName == "DiagnosaView") {
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
            $key .= @$ar['DIAGNOSA_ID'];
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
        $this->DTYPE->setVisibility();
        $this->DIAGNOSA_ID->setVisibility();
        $this->NAME_OF_DIAGNOSA->setVisibility();
        $this->OTHER_ID->setVisibility();
        $this->OTHER_ID2->setVisibility();
        $this->ISMENULAR->setVisibility();
        $this->ENGLISH_DIAGNOSA->setVisibility();
        $this->issurveylans->setVisibility();
        $this->dtd->setVisibility();
        $this->kode_bpjs->setVisibility();
        $this->diagnosa_bpjs->setVisibility();
        $this->DIAGNOSA_KLINIS->setVisibility();
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
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("DIAGNOSA_ID") ?? Key(0) ?? Route(2)) !== null) {
                $this->DIAGNOSA_ID->setQueryStringValue($keyValue);
                $this->DIAGNOSA_ID->setOldValue($this->DIAGNOSA_ID->QueryStringValue);
            } elseif (Post("DIAGNOSA_ID") !== null) {
                $this->DIAGNOSA_ID->setFormValue(Post("DIAGNOSA_ID"));
                $this->DIAGNOSA_ID->setOldValue($this->DIAGNOSA_ID->FormValue);
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
                if (($keyValue = Get("DIAGNOSA_ID") ?? Route("DIAGNOSA_ID")) !== null) {
                    $this->DIAGNOSA_ID->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->DIAGNOSA_ID->CurrentValue = null;
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
                    $this->terminate("DiagnosaList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "DiagnosaList") {
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

        // Check field name 'DTYPE' first before field var 'x_DTYPE'
        $val = $CurrentForm->hasValue("DTYPE") ? $CurrentForm->getValue("DTYPE") : $CurrentForm->getValue("x_DTYPE");
        if (!$this->DTYPE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DTYPE->Visible = false; // Disable update for API request
            } else {
                $this->DTYPE->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID' first before field var 'x_DIAGNOSA_ID'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID") ? $CurrentForm->getValue("DIAGNOSA_ID") : $CurrentForm->getValue("x_DIAGNOSA_ID");
        if (!$this->DIAGNOSA_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_DIAGNOSA_ID")) {
            $this->DIAGNOSA_ID->setOldValue($CurrentForm->getValue("o_DIAGNOSA_ID"));
        }

        // Check field name 'NAME_OF_DIAGNOSA' first before field var 'x_NAME_OF_DIAGNOSA'
        $val = $CurrentForm->hasValue("NAME_OF_DIAGNOSA") ? $CurrentForm->getValue("NAME_OF_DIAGNOSA") : $CurrentForm->getValue("x_NAME_OF_DIAGNOSA");
        if (!$this->NAME_OF_DIAGNOSA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAME_OF_DIAGNOSA->Visible = false; // Disable update for API request
            } else {
                $this->NAME_OF_DIAGNOSA->setFormValue($val);
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

        // Check field name 'OTHER_ID2' first before field var 'x_OTHER_ID2'
        $val = $CurrentForm->hasValue("OTHER_ID2") ? $CurrentForm->getValue("OTHER_ID2") : $CurrentForm->getValue("x_OTHER_ID2");
        if (!$this->OTHER_ID2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->OTHER_ID2->Visible = false; // Disable update for API request
            } else {
                $this->OTHER_ID2->setFormValue($val);
            }
        }

        // Check field name 'ISMENULAR' first before field var 'x_ISMENULAR'
        $val = $CurrentForm->hasValue("ISMENULAR") ? $CurrentForm->getValue("ISMENULAR") : $CurrentForm->getValue("x_ISMENULAR");
        if (!$this->ISMENULAR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ISMENULAR->Visible = false; // Disable update for API request
            } else {
                $this->ISMENULAR->setFormValue($val);
            }
        }

        // Check field name 'ENGLISH_DIAGNOSA' first before field var 'x_ENGLISH_DIAGNOSA'
        $val = $CurrentForm->hasValue("ENGLISH_DIAGNOSA") ? $CurrentForm->getValue("ENGLISH_DIAGNOSA") : $CurrentForm->getValue("x_ENGLISH_DIAGNOSA");
        if (!$this->ENGLISH_DIAGNOSA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ENGLISH_DIAGNOSA->Visible = false; // Disable update for API request
            } else {
                $this->ENGLISH_DIAGNOSA->setFormValue($val);
            }
        }

        // Check field name 'issurveylans' first before field var 'x_issurveylans'
        $val = $CurrentForm->hasValue("issurveylans") ? $CurrentForm->getValue("issurveylans") : $CurrentForm->getValue("x_issurveylans");
        if (!$this->issurveylans->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->issurveylans->Visible = false; // Disable update for API request
            } else {
                $this->issurveylans->setFormValue($val);
            }
        }

        // Check field name 'dtd' first before field var 'x_dtd'
        $val = $CurrentForm->hasValue("dtd") ? $CurrentForm->getValue("dtd") : $CurrentForm->getValue("x_dtd");
        if (!$this->dtd->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dtd->Visible = false; // Disable update for API request
            } else {
                $this->dtd->setFormValue($val);
            }
        }

        // Check field name 'kode_bpjs' first before field var 'x_kode_bpjs'
        $val = $CurrentForm->hasValue("kode_bpjs") ? $CurrentForm->getValue("kode_bpjs") : $CurrentForm->getValue("x_kode_bpjs");
        if (!$this->kode_bpjs->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kode_bpjs->Visible = false; // Disable update for API request
            } else {
                $this->kode_bpjs->setFormValue($val);
            }
        }

        // Check field name 'diagnosa_bpjs' first before field var 'x_diagnosa_bpjs'
        $val = $CurrentForm->hasValue("diagnosa_bpjs") ? $CurrentForm->getValue("diagnosa_bpjs") : $CurrentForm->getValue("x_diagnosa_bpjs");
        if (!$this->diagnosa_bpjs->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->diagnosa_bpjs->Visible = false; // Disable update for API request
            } else {
                $this->diagnosa_bpjs->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_KLINIS' first before field var 'x_DIAGNOSA_KLINIS'
        $val = $CurrentForm->hasValue("DIAGNOSA_KLINIS") ? $CurrentForm->getValue("DIAGNOSA_KLINIS") : $CurrentForm->getValue("x_DIAGNOSA_KLINIS");
        if (!$this->DIAGNOSA_KLINIS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_KLINIS->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_KLINIS->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->DTYPE->CurrentValue = $this->DTYPE->FormValue;
        $this->DIAGNOSA_ID->CurrentValue = $this->DIAGNOSA_ID->FormValue;
        $this->NAME_OF_DIAGNOSA->CurrentValue = $this->NAME_OF_DIAGNOSA->FormValue;
        $this->OTHER_ID->CurrentValue = $this->OTHER_ID->FormValue;
        $this->OTHER_ID2->CurrentValue = $this->OTHER_ID2->FormValue;
        $this->ISMENULAR->CurrentValue = $this->ISMENULAR->FormValue;
        $this->ENGLISH_DIAGNOSA->CurrentValue = $this->ENGLISH_DIAGNOSA->FormValue;
        $this->issurveylans->CurrentValue = $this->issurveylans->FormValue;
        $this->dtd->CurrentValue = $this->dtd->FormValue;
        $this->kode_bpjs->CurrentValue = $this->kode_bpjs->FormValue;
        $this->diagnosa_bpjs->CurrentValue = $this->diagnosa_bpjs->FormValue;
        $this->DIAGNOSA_KLINIS->CurrentValue = $this->DIAGNOSA_KLINIS->FormValue;
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
        $this->DTYPE->setDbValue($row['DTYPE']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->NAME_OF_DIAGNOSA->setDbValue($row['NAME_OF_DIAGNOSA']);
        $this->OTHER_ID->setDbValue($row['OTHER_ID']);
        $this->OTHER_ID2->setDbValue($row['OTHER_ID2']);
        $this->ISMENULAR->setDbValue($row['ISMENULAR']);
        $this->ENGLISH_DIAGNOSA->setDbValue($row['ENGLISH_DIAGNOSA']);
        $this->issurveylans->setDbValue($row['issurveylans']);
        $this->dtd->setDbValue($row['dtd']);
        $this->kode_bpjs->setDbValue($row['kode_bpjs']);
        $this->diagnosa_bpjs->setDbValue($row['diagnosa_bpjs']);
        $this->DIAGNOSA_KLINIS->setDbValue($row['DIAGNOSA_KLINIS']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['DTYPE'] = null;
        $row['DIAGNOSA_ID'] = null;
        $row['NAME_OF_DIAGNOSA'] = null;
        $row['OTHER_ID'] = null;
        $row['OTHER_ID2'] = null;
        $row['ISMENULAR'] = null;
        $row['ENGLISH_DIAGNOSA'] = null;
        $row['issurveylans'] = null;
        $row['dtd'] = null;
        $row['kode_bpjs'] = null;
        $row['diagnosa_bpjs'] = null;
        $row['DIAGNOSA_KLINIS'] = null;
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

        // DTYPE

        // DIAGNOSA_ID

        // NAME_OF_DIAGNOSA

        // OTHER_ID

        // OTHER_ID2

        // ISMENULAR

        // ENGLISH_DIAGNOSA

        // issurveylans

        // dtd

        // kode_bpjs

        // diagnosa_bpjs

        // DIAGNOSA_KLINIS
        if ($this->RowType == ROWTYPE_VIEW) {
            // DTYPE
            $this->DTYPE->ViewValue = $this->DTYPE->CurrentValue;
            $this->DTYPE->ViewCustomAttributes = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
            $this->DIAGNOSA_ID->ViewCustomAttributes = "";

            // NAME_OF_DIAGNOSA
            $this->NAME_OF_DIAGNOSA->ViewValue = $this->NAME_OF_DIAGNOSA->CurrentValue;
            $this->NAME_OF_DIAGNOSA->ViewCustomAttributes = "";

            // OTHER_ID
            $this->OTHER_ID->ViewValue = $this->OTHER_ID->CurrentValue;
            $this->OTHER_ID->ViewCustomAttributes = "";

            // OTHER_ID2
            $this->OTHER_ID2->ViewValue = $this->OTHER_ID2->CurrentValue;
            $this->OTHER_ID2->ViewCustomAttributes = "";

            // ISMENULAR
            $this->ISMENULAR->ViewValue = $this->ISMENULAR->CurrentValue;
            $this->ISMENULAR->ViewCustomAttributes = "";

            // ENGLISH_DIAGNOSA
            $this->ENGLISH_DIAGNOSA->ViewValue = $this->ENGLISH_DIAGNOSA->CurrentValue;
            $this->ENGLISH_DIAGNOSA->ViewCustomAttributes = "";

            // issurveylans
            $this->issurveylans->ViewValue = $this->issurveylans->CurrentValue;
            $this->issurveylans->ViewCustomAttributes = "";

            // dtd
            $this->dtd->ViewValue = $this->dtd->CurrentValue;
            $this->dtd->ViewCustomAttributes = "";

            // kode_bpjs
            $this->kode_bpjs->ViewValue = $this->kode_bpjs->CurrentValue;
            $this->kode_bpjs->ViewCustomAttributes = "";

            // diagnosa_bpjs
            $this->diagnosa_bpjs->ViewValue = $this->diagnosa_bpjs->CurrentValue;
            $this->diagnosa_bpjs->ViewCustomAttributes = "";

            // DIAGNOSA_KLINIS
            $this->DIAGNOSA_KLINIS->ViewValue = $this->DIAGNOSA_KLINIS->CurrentValue;
            $this->DIAGNOSA_KLINIS->ViewCustomAttributes = "";

            // DTYPE
            $this->DTYPE->LinkCustomAttributes = "";
            $this->DTYPE->HrefValue = "";
            $this->DTYPE->TooltipValue = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID->HrefValue = "";
            $this->DIAGNOSA_ID->TooltipValue = "";

            // NAME_OF_DIAGNOSA
            $this->NAME_OF_DIAGNOSA->LinkCustomAttributes = "";
            $this->NAME_OF_DIAGNOSA->HrefValue = "";
            $this->NAME_OF_DIAGNOSA->TooltipValue = "";

            // OTHER_ID
            $this->OTHER_ID->LinkCustomAttributes = "";
            $this->OTHER_ID->HrefValue = "";
            $this->OTHER_ID->TooltipValue = "";

            // OTHER_ID2
            $this->OTHER_ID2->LinkCustomAttributes = "";
            $this->OTHER_ID2->HrefValue = "";
            $this->OTHER_ID2->TooltipValue = "";

            // ISMENULAR
            $this->ISMENULAR->LinkCustomAttributes = "";
            $this->ISMENULAR->HrefValue = "";
            $this->ISMENULAR->TooltipValue = "";

            // ENGLISH_DIAGNOSA
            $this->ENGLISH_DIAGNOSA->LinkCustomAttributes = "";
            $this->ENGLISH_DIAGNOSA->HrefValue = "";
            $this->ENGLISH_DIAGNOSA->TooltipValue = "";

            // issurveylans
            $this->issurveylans->LinkCustomAttributes = "";
            $this->issurveylans->HrefValue = "";
            $this->issurveylans->TooltipValue = "";

            // dtd
            $this->dtd->LinkCustomAttributes = "";
            $this->dtd->HrefValue = "";
            $this->dtd->TooltipValue = "";

            // kode_bpjs
            $this->kode_bpjs->LinkCustomAttributes = "";
            $this->kode_bpjs->HrefValue = "";
            $this->kode_bpjs->TooltipValue = "";

            // diagnosa_bpjs
            $this->diagnosa_bpjs->LinkCustomAttributes = "";
            $this->diagnosa_bpjs->HrefValue = "";
            $this->diagnosa_bpjs->TooltipValue = "";

            // DIAGNOSA_KLINIS
            $this->DIAGNOSA_KLINIS->LinkCustomAttributes = "";
            $this->DIAGNOSA_KLINIS->HrefValue = "";
            $this->DIAGNOSA_KLINIS->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // DTYPE
            $this->DTYPE->EditAttrs["class"] = "form-control";
            $this->DTYPE->EditCustomAttributes = "";
            if (!$this->DTYPE->Raw) {
                $this->DTYPE->CurrentValue = HtmlDecode($this->DTYPE->CurrentValue);
            }
            $this->DTYPE->EditValue = HtmlEncode($this->DTYPE->CurrentValue);
            $this->DTYPE->PlaceHolder = RemoveHtml($this->DTYPE->caption());

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
            $this->DIAGNOSA_ID->EditCustomAttributes = "";
            if (!$this->DIAGNOSA_ID->Raw) {
                $this->DIAGNOSA_ID->CurrentValue = HtmlDecode($this->DIAGNOSA_ID->CurrentValue);
            }
            $this->DIAGNOSA_ID->EditValue = HtmlEncode($this->DIAGNOSA_ID->CurrentValue);
            $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

            // NAME_OF_DIAGNOSA
            $this->NAME_OF_DIAGNOSA->EditAttrs["class"] = "form-control";
            $this->NAME_OF_DIAGNOSA->EditCustomAttributes = "";
            if (!$this->NAME_OF_DIAGNOSA->Raw) {
                $this->NAME_OF_DIAGNOSA->CurrentValue = HtmlDecode($this->NAME_OF_DIAGNOSA->CurrentValue);
            }
            $this->NAME_OF_DIAGNOSA->EditValue = HtmlEncode($this->NAME_OF_DIAGNOSA->CurrentValue);
            $this->NAME_OF_DIAGNOSA->PlaceHolder = RemoveHtml($this->NAME_OF_DIAGNOSA->caption());

            // OTHER_ID
            $this->OTHER_ID->EditAttrs["class"] = "form-control";
            $this->OTHER_ID->EditCustomAttributes = "";
            if (!$this->OTHER_ID->Raw) {
                $this->OTHER_ID->CurrentValue = HtmlDecode($this->OTHER_ID->CurrentValue);
            }
            $this->OTHER_ID->EditValue = HtmlEncode($this->OTHER_ID->CurrentValue);
            $this->OTHER_ID->PlaceHolder = RemoveHtml($this->OTHER_ID->caption());

            // OTHER_ID2
            $this->OTHER_ID2->EditAttrs["class"] = "form-control";
            $this->OTHER_ID2->EditCustomAttributes = "";
            if (!$this->OTHER_ID2->Raw) {
                $this->OTHER_ID2->CurrentValue = HtmlDecode($this->OTHER_ID2->CurrentValue);
            }
            $this->OTHER_ID2->EditValue = HtmlEncode($this->OTHER_ID2->CurrentValue);
            $this->OTHER_ID2->PlaceHolder = RemoveHtml($this->OTHER_ID2->caption());

            // ISMENULAR
            $this->ISMENULAR->EditAttrs["class"] = "form-control";
            $this->ISMENULAR->EditCustomAttributes = "";
            if (!$this->ISMENULAR->Raw) {
                $this->ISMENULAR->CurrentValue = HtmlDecode($this->ISMENULAR->CurrentValue);
            }
            $this->ISMENULAR->EditValue = HtmlEncode($this->ISMENULAR->CurrentValue);
            $this->ISMENULAR->PlaceHolder = RemoveHtml($this->ISMENULAR->caption());

            // ENGLISH_DIAGNOSA
            $this->ENGLISH_DIAGNOSA->EditAttrs["class"] = "form-control";
            $this->ENGLISH_DIAGNOSA->EditCustomAttributes = "";
            if (!$this->ENGLISH_DIAGNOSA->Raw) {
                $this->ENGLISH_DIAGNOSA->CurrentValue = HtmlDecode($this->ENGLISH_DIAGNOSA->CurrentValue);
            }
            $this->ENGLISH_DIAGNOSA->EditValue = HtmlEncode($this->ENGLISH_DIAGNOSA->CurrentValue);
            $this->ENGLISH_DIAGNOSA->PlaceHolder = RemoveHtml($this->ENGLISH_DIAGNOSA->caption());

            // issurveylans
            $this->issurveylans->EditAttrs["class"] = "form-control";
            $this->issurveylans->EditCustomAttributes = "";
            if (!$this->issurveylans->Raw) {
                $this->issurveylans->CurrentValue = HtmlDecode($this->issurveylans->CurrentValue);
            }
            $this->issurveylans->EditValue = HtmlEncode($this->issurveylans->CurrentValue);
            $this->issurveylans->PlaceHolder = RemoveHtml($this->issurveylans->caption());

            // dtd
            $this->dtd->EditAttrs["class"] = "form-control";
            $this->dtd->EditCustomAttributes = "";
            $this->dtd->EditValue = HtmlEncode($this->dtd->CurrentValue);
            $this->dtd->PlaceHolder = RemoveHtml($this->dtd->caption());

            // kode_bpjs
            $this->kode_bpjs->EditAttrs["class"] = "form-control";
            $this->kode_bpjs->EditCustomAttributes = "";
            if (!$this->kode_bpjs->Raw) {
                $this->kode_bpjs->CurrentValue = HtmlDecode($this->kode_bpjs->CurrentValue);
            }
            $this->kode_bpjs->EditValue = HtmlEncode($this->kode_bpjs->CurrentValue);
            $this->kode_bpjs->PlaceHolder = RemoveHtml($this->kode_bpjs->caption());

            // diagnosa_bpjs
            $this->diagnosa_bpjs->EditAttrs["class"] = "form-control";
            $this->diagnosa_bpjs->EditCustomAttributes = "";
            if (!$this->diagnosa_bpjs->Raw) {
                $this->diagnosa_bpjs->CurrentValue = HtmlDecode($this->diagnosa_bpjs->CurrentValue);
            }
            $this->diagnosa_bpjs->EditValue = HtmlEncode($this->diagnosa_bpjs->CurrentValue);
            $this->diagnosa_bpjs->PlaceHolder = RemoveHtml($this->diagnosa_bpjs->caption());

            // DIAGNOSA_KLINIS
            $this->DIAGNOSA_KLINIS->EditAttrs["class"] = "form-control";
            $this->DIAGNOSA_KLINIS->EditCustomAttributes = "";
            if (!$this->DIAGNOSA_KLINIS->Raw) {
                $this->DIAGNOSA_KLINIS->CurrentValue = HtmlDecode($this->DIAGNOSA_KLINIS->CurrentValue);
            }
            $this->DIAGNOSA_KLINIS->EditValue = HtmlEncode($this->DIAGNOSA_KLINIS->CurrentValue);
            $this->DIAGNOSA_KLINIS->PlaceHolder = RemoveHtml($this->DIAGNOSA_KLINIS->caption());

            // Edit refer script

            // DTYPE
            $this->DTYPE->LinkCustomAttributes = "";
            $this->DTYPE->HrefValue = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID->HrefValue = "";

            // NAME_OF_DIAGNOSA
            $this->NAME_OF_DIAGNOSA->LinkCustomAttributes = "";
            $this->NAME_OF_DIAGNOSA->HrefValue = "";

            // OTHER_ID
            $this->OTHER_ID->LinkCustomAttributes = "";
            $this->OTHER_ID->HrefValue = "";

            // OTHER_ID2
            $this->OTHER_ID2->LinkCustomAttributes = "";
            $this->OTHER_ID2->HrefValue = "";

            // ISMENULAR
            $this->ISMENULAR->LinkCustomAttributes = "";
            $this->ISMENULAR->HrefValue = "";

            // ENGLISH_DIAGNOSA
            $this->ENGLISH_DIAGNOSA->LinkCustomAttributes = "";
            $this->ENGLISH_DIAGNOSA->HrefValue = "";

            // issurveylans
            $this->issurveylans->LinkCustomAttributes = "";
            $this->issurveylans->HrefValue = "";

            // dtd
            $this->dtd->LinkCustomAttributes = "";
            $this->dtd->HrefValue = "";

            // kode_bpjs
            $this->kode_bpjs->LinkCustomAttributes = "";
            $this->kode_bpjs->HrefValue = "";

            // diagnosa_bpjs
            $this->diagnosa_bpjs->LinkCustomAttributes = "";
            $this->diagnosa_bpjs->HrefValue = "";

            // DIAGNOSA_KLINIS
            $this->DIAGNOSA_KLINIS->LinkCustomAttributes = "";
            $this->DIAGNOSA_KLINIS->HrefValue = "";
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
        if ($this->DTYPE->Required) {
            if (!$this->DTYPE->IsDetailKey && EmptyValue($this->DTYPE->FormValue)) {
                $this->DTYPE->addErrorMessage(str_replace("%s", $this->DTYPE->caption(), $this->DTYPE->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID->Required) {
            if (!$this->DIAGNOSA_ID->IsDetailKey && EmptyValue($this->DIAGNOSA_ID->FormValue)) {
                $this->DIAGNOSA_ID->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID->caption(), $this->DIAGNOSA_ID->RequiredErrorMessage));
            }
        }
        if ($this->NAME_OF_DIAGNOSA->Required) {
            if (!$this->NAME_OF_DIAGNOSA->IsDetailKey && EmptyValue($this->NAME_OF_DIAGNOSA->FormValue)) {
                $this->NAME_OF_DIAGNOSA->addErrorMessage(str_replace("%s", $this->NAME_OF_DIAGNOSA->caption(), $this->NAME_OF_DIAGNOSA->RequiredErrorMessage));
            }
        }
        if ($this->OTHER_ID->Required) {
            if (!$this->OTHER_ID->IsDetailKey && EmptyValue($this->OTHER_ID->FormValue)) {
                $this->OTHER_ID->addErrorMessage(str_replace("%s", $this->OTHER_ID->caption(), $this->OTHER_ID->RequiredErrorMessage));
            }
        }
        if ($this->OTHER_ID2->Required) {
            if (!$this->OTHER_ID2->IsDetailKey && EmptyValue($this->OTHER_ID2->FormValue)) {
                $this->OTHER_ID2->addErrorMessage(str_replace("%s", $this->OTHER_ID2->caption(), $this->OTHER_ID2->RequiredErrorMessage));
            }
        }
        if ($this->ISMENULAR->Required) {
            if (!$this->ISMENULAR->IsDetailKey && EmptyValue($this->ISMENULAR->FormValue)) {
                $this->ISMENULAR->addErrorMessage(str_replace("%s", $this->ISMENULAR->caption(), $this->ISMENULAR->RequiredErrorMessage));
            }
        }
        if ($this->ENGLISH_DIAGNOSA->Required) {
            if (!$this->ENGLISH_DIAGNOSA->IsDetailKey && EmptyValue($this->ENGLISH_DIAGNOSA->FormValue)) {
                $this->ENGLISH_DIAGNOSA->addErrorMessage(str_replace("%s", $this->ENGLISH_DIAGNOSA->caption(), $this->ENGLISH_DIAGNOSA->RequiredErrorMessage));
            }
        }
        if ($this->issurveylans->Required) {
            if (!$this->issurveylans->IsDetailKey && EmptyValue($this->issurveylans->FormValue)) {
                $this->issurveylans->addErrorMessage(str_replace("%s", $this->issurveylans->caption(), $this->issurveylans->RequiredErrorMessage));
            }
        }
        if ($this->dtd->Required) {
            if (!$this->dtd->IsDetailKey && EmptyValue($this->dtd->FormValue)) {
                $this->dtd->addErrorMessage(str_replace("%s", $this->dtd->caption(), $this->dtd->RequiredErrorMessage));
            }
        }
        if ($this->kode_bpjs->Required) {
            if (!$this->kode_bpjs->IsDetailKey && EmptyValue($this->kode_bpjs->FormValue)) {
                $this->kode_bpjs->addErrorMessage(str_replace("%s", $this->kode_bpjs->caption(), $this->kode_bpjs->RequiredErrorMessage));
            }
        }
        if ($this->diagnosa_bpjs->Required) {
            if (!$this->diagnosa_bpjs->IsDetailKey && EmptyValue($this->diagnosa_bpjs->FormValue)) {
                $this->diagnosa_bpjs->addErrorMessage(str_replace("%s", $this->diagnosa_bpjs->caption(), $this->diagnosa_bpjs->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_KLINIS->Required) {
            if (!$this->DIAGNOSA_KLINIS->IsDetailKey && EmptyValue($this->DIAGNOSA_KLINIS->FormValue)) {
                $this->DIAGNOSA_KLINIS->addErrorMessage(str_replace("%s", $this->DIAGNOSA_KLINIS->caption(), $this->DIAGNOSA_KLINIS->RequiredErrorMessage));
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

            // DTYPE
            $this->DTYPE->setDbValueDef($rsnew, $this->DTYPE->CurrentValue, "", $this->DTYPE->ReadOnly);

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->setDbValueDef($rsnew, $this->DIAGNOSA_ID->CurrentValue, "", $this->DIAGNOSA_ID->ReadOnly);

            // NAME_OF_DIAGNOSA
            $this->NAME_OF_DIAGNOSA->setDbValueDef($rsnew, $this->NAME_OF_DIAGNOSA->CurrentValue, null, $this->NAME_OF_DIAGNOSA->ReadOnly);

            // OTHER_ID
            $this->OTHER_ID->setDbValueDef($rsnew, $this->OTHER_ID->CurrentValue, null, $this->OTHER_ID->ReadOnly);

            // OTHER_ID2
            $this->OTHER_ID2->setDbValueDef($rsnew, $this->OTHER_ID2->CurrentValue, null, $this->OTHER_ID2->ReadOnly);

            // ISMENULAR
            $this->ISMENULAR->setDbValueDef($rsnew, $this->ISMENULAR->CurrentValue, null, $this->ISMENULAR->ReadOnly);

            // ENGLISH_DIAGNOSA
            $this->ENGLISH_DIAGNOSA->setDbValueDef($rsnew, $this->ENGLISH_DIAGNOSA->CurrentValue, null, $this->ENGLISH_DIAGNOSA->ReadOnly);

            // issurveylans
            $this->issurveylans->setDbValueDef($rsnew, $this->issurveylans->CurrentValue, null, $this->issurveylans->ReadOnly);

            // dtd
            $this->dtd->setDbValueDef($rsnew, $this->dtd->CurrentValue, null, $this->dtd->ReadOnly);

            // kode_bpjs
            $this->kode_bpjs->setDbValueDef($rsnew, $this->kode_bpjs->CurrentValue, null, $this->kode_bpjs->ReadOnly);

            // diagnosa_bpjs
            $this->diagnosa_bpjs->setDbValueDef($rsnew, $this->diagnosa_bpjs->CurrentValue, null, $this->diagnosa_bpjs->ReadOnly);

            // DIAGNOSA_KLINIS
            $this->DIAGNOSA_KLINIS->setDbValueDef($rsnew, $this->DIAGNOSA_KLINIS->CurrentValue, null, $this->DIAGNOSA_KLINIS->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);

            // Check for duplicate key when key changed
            if ($updateRow) {
                $newKeyFilter = $this->getRecordFilter($rsnew);
                if ($newKeyFilter != $oldKeyFilter) {
                    $rsChk = $this->loadRs($newKeyFilter)->fetch();
                    if ($rsChk !== false) {
                        $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                        $this->setFailureMessage($keyErrMsg);
                        $updateRow = false;
                    }
                }
            }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("DiagnosaList"), "", $this->TableVar, true);
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
