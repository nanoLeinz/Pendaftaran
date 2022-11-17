<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MAlatCssdAdd extends MAlatCssd
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'm_alat_cssd';

    // Page object name
    public $PageObjName = "MAlatCssdAdd";

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

        // Table object (m_alat_cssd)
        if (!isset($GLOBALS["m_alat_cssd"]) || get_class($GLOBALS["m_alat_cssd"]) == PROJECT_NAMESPACE . "m_alat_cssd") {
            $GLOBALS["m_alat_cssd"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_alat_cssd');
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
                $doc = new $class(Container("m_alat_cssd"));
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
                    if ($pageName == "MAlatCssdView") {
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
            $key .= @$ar['alat_id'];
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
            $this->alat_id->Visible = false;
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
        $this->alat_id->Visible = false;
        $this->nama_alat->setVisibility();
        $this->id_set->setVisibility();
        $this->keadaan->setVisibility();
        $this->jumlah->setVisibility();
        $this->merk->setVisibility();
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
        $this->setupLookupOptions($this->id_set);

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
            if (($keyValue = Get("alat_id") ?? Route("alat_id")) !== null) {
                $this->alat_id->setQueryStringValue($keyValue);
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
                    $this->terminate("MAlatCssdList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "MAlatCssdList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "MAlatCssdView") {
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
        $this->alat_id->CurrentValue = null;
        $this->alat_id->OldValue = $this->alat_id->CurrentValue;
        $this->nama_alat->CurrentValue = null;
        $this->nama_alat->OldValue = $this->nama_alat->CurrentValue;
        $this->id_set->CurrentValue = null;
        $this->id_set->OldValue = $this->id_set->CurrentValue;
        $this->keadaan->CurrentValue = null;
        $this->keadaan->OldValue = $this->keadaan->CurrentValue;
        $this->jumlah->CurrentValue = null;
        $this->jumlah->OldValue = $this->jumlah->CurrentValue;
        $this->merk->CurrentValue = null;
        $this->merk->OldValue = $this->merk->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'nama_alat' first before field var 'x_nama_alat'
        $val = $CurrentForm->hasValue("nama_alat") ? $CurrentForm->getValue("nama_alat") : $CurrentForm->getValue("x_nama_alat");
        if (!$this->nama_alat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_alat->Visible = false; // Disable update for API request
            } else {
                $this->nama_alat->setFormValue($val);
            }
        }

        // Check field name 'id_set' first before field var 'x_id_set'
        $val = $CurrentForm->hasValue("id_set") ? $CurrentForm->getValue("id_set") : $CurrentForm->getValue("x_id_set");
        if (!$this->id_set->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_set->Visible = false; // Disable update for API request
            } else {
                $this->id_set->setFormValue($val);
            }
        }

        // Check field name 'keadaan' first before field var 'x_keadaan'
        $val = $CurrentForm->hasValue("keadaan") ? $CurrentForm->getValue("keadaan") : $CurrentForm->getValue("x_keadaan");
        if (!$this->keadaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->keadaan->Visible = false; // Disable update for API request
            } else {
                $this->keadaan->setFormValue($val);
            }
        }

        // Check field name 'jumlah' first before field var 'x_jumlah'
        $val = $CurrentForm->hasValue("jumlah") ? $CurrentForm->getValue("jumlah") : $CurrentForm->getValue("x_jumlah");
        if (!$this->jumlah->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlah->Visible = false; // Disable update for API request
            } else {
                $this->jumlah->setFormValue($val);
            }
        }

        // Check field name 'merk' first before field var 'x_merk'
        $val = $CurrentForm->hasValue("merk") ? $CurrentForm->getValue("merk") : $CurrentForm->getValue("x_merk");
        if (!$this->merk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->merk->Visible = false; // Disable update for API request
            } else {
                $this->merk->setFormValue($val);
            }
        }

        // Check field name 'alat_id' first before field var 'x_alat_id'
        $val = $CurrentForm->hasValue("alat_id") ? $CurrentForm->getValue("alat_id") : $CurrentForm->getValue("x_alat_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nama_alat->CurrentValue = $this->nama_alat->FormValue;
        $this->id_set->CurrentValue = $this->id_set->FormValue;
        $this->keadaan->CurrentValue = $this->keadaan->FormValue;
        $this->jumlah->CurrentValue = $this->jumlah->FormValue;
        $this->merk->CurrentValue = $this->merk->FormValue;
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
        $this->alat_id->setDbValue($row['alat_id']);
        $this->nama_alat->setDbValue($row['nama_alat']);
        $this->id_set->setDbValue($row['id_set']);
        $this->keadaan->setDbValue($row['keadaan']);
        $this->jumlah->setDbValue($row['jumlah']);
        $this->merk->setDbValue($row['merk']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['alat_id'] = $this->alat_id->CurrentValue;
        $row['nama_alat'] = $this->nama_alat->CurrentValue;
        $row['id_set'] = $this->id_set->CurrentValue;
        $row['keadaan'] = $this->keadaan->CurrentValue;
        $row['jumlah'] = $this->jumlah->CurrentValue;
        $row['merk'] = $this->merk->CurrentValue;
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

        // alat_id

        // nama_alat

        // id_set

        // keadaan

        // jumlah

        // merk
        if ($this->RowType == ROWTYPE_VIEW) {
            // alat_id
            $this->alat_id->ViewValue = $this->alat_id->CurrentValue;
            $this->alat_id->ViewValue = FormatNumber($this->alat_id->ViewValue, 0, -2, -2, -2);
            $this->alat_id->ViewCustomAttributes = "";

            // nama_alat
            $this->nama_alat->ViewValue = $this->nama_alat->CurrentValue;
            $this->nama_alat->ViewCustomAttributes = "";

            // id_set
            $curVal = trim(strval($this->id_set->CurrentValue));
            if ($curVal != "") {
                $this->id_set->ViewValue = $this->id_set->lookupCacheOption($curVal);
                if ($this->id_set->ViewValue === null) { // Lookup from database
                    $filterWrk = "[id_set]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->id_set->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->id_set->Lookup->renderViewRow($rswrk[0]);
                        $this->id_set->ViewValue = $this->id_set->displayValue($arwrk);
                    } else {
                        $this->id_set->ViewValue = $this->id_set->CurrentValue;
                    }
                }
            } else {
                $this->id_set->ViewValue = null;
            }
            $this->id_set->ViewCustomAttributes = "";

            // keadaan
            $this->keadaan->ViewValue = $this->keadaan->CurrentValue;
            $this->keadaan->ViewValue = FormatNumber($this->keadaan->ViewValue, 0, -2, -2, -2);
            $this->keadaan->ViewCustomAttributes = "";

            // jumlah
            $this->jumlah->ViewValue = $this->jumlah->CurrentValue;
            $this->jumlah->ViewValue = FormatNumber($this->jumlah->ViewValue, 0, -2, -2, -2);
            $this->jumlah->ViewCustomAttributes = "";

            // merk
            $this->merk->ViewValue = $this->merk->CurrentValue;
            $this->merk->ViewCustomAttributes = "";

            // nama_alat
            $this->nama_alat->LinkCustomAttributes = "";
            $this->nama_alat->HrefValue = "";
            $this->nama_alat->TooltipValue = "";

            // id_set
            $this->id_set->LinkCustomAttributes = "";
            $this->id_set->HrefValue = "";
            $this->id_set->TooltipValue = "";

            // keadaan
            $this->keadaan->LinkCustomAttributes = "";
            $this->keadaan->HrefValue = "";
            $this->keadaan->TooltipValue = "";

            // jumlah
            $this->jumlah->LinkCustomAttributes = "";
            $this->jumlah->HrefValue = "";
            $this->jumlah->TooltipValue = "";

            // merk
            $this->merk->LinkCustomAttributes = "";
            $this->merk->HrefValue = "";
            $this->merk->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nama_alat
            $this->nama_alat->EditAttrs["class"] = "form-control";
            $this->nama_alat->EditCustomAttributes = "";
            if (!$this->nama_alat->Raw) {
                $this->nama_alat->CurrentValue = HtmlDecode($this->nama_alat->CurrentValue);
            }
            $this->nama_alat->EditValue = HtmlEncode($this->nama_alat->CurrentValue);
            $this->nama_alat->PlaceHolder = RemoveHtml($this->nama_alat->caption());

            // id_set
            $this->id_set->EditAttrs["class"] = "form-control";
            $this->id_set->EditCustomAttributes = "";
            $curVal = trim(strval($this->id_set->CurrentValue));
            if ($curVal != "") {
                $this->id_set->ViewValue = $this->id_set->lookupCacheOption($curVal);
            } else {
                $this->id_set->ViewValue = $this->id_set->Lookup !== null && is_array($this->id_set->Lookup->Options) ? $curVal : null;
            }
            if ($this->id_set->ViewValue !== null) { // Load from cache
                $this->id_set->EditValue = array_values($this->id_set->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[id_set]" . SearchString("=", $this->id_set->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->id_set->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->id_set->EditValue = $arwrk;
            }
            $this->id_set->PlaceHolder = RemoveHtml($this->id_set->caption());

            // keadaan
            $this->keadaan->EditAttrs["class"] = "form-control";
            $this->keadaan->EditCustomAttributes = "";
            $this->keadaan->EditValue = HtmlEncode($this->keadaan->CurrentValue);
            $this->keadaan->PlaceHolder = RemoveHtml($this->keadaan->caption());

            // jumlah
            $this->jumlah->EditAttrs["class"] = "form-control";
            $this->jumlah->EditCustomAttributes = "";
            $this->jumlah->EditValue = HtmlEncode($this->jumlah->CurrentValue);
            $this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());

            // merk
            $this->merk->EditAttrs["class"] = "form-control";
            $this->merk->EditCustomAttributes = "";
            if (!$this->merk->Raw) {
                $this->merk->CurrentValue = HtmlDecode($this->merk->CurrentValue);
            }
            $this->merk->EditValue = HtmlEncode($this->merk->CurrentValue);
            $this->merk->PlaceHolder = RemoveHtml($this->merk->caption());

            // Add refer script

            // nama_alat
            $this->nama_alat->LinkCustomAttributes = "";
            $this->nama_alat->HrefValue = "";

            // id_set
            $this->id_set->LinkCustomAttributes = "";
            $this->id_set->HrefValue = "";

            // keadaan
            $this->keadaan->LinkCustomAttributes = "";
            $this->keadaan->HrefValue = "";

            // jumlah
            $this->jumlah->LinkCustomAttributes = "";
            $this->jumlah->HrefValue = "";

            // merk
            $this->merk->LinkCustomAttributes = "";
            $this->merk->HrefValue = "";
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
        if ($this->nama_alat->Required) {
            if (!$this->nama_alat->IsDetailKey && EmptyValue($this->nama_alat->FormValue)) {
                $this->nama_alat->addErrorMessage(str_replace("%s", $this->nama_alat->caption(), $this->nama_alat->RequiredErrorMessage));
            }
        }
        if ($this->id_set->Required) {
            if (!$this->id_set->IsDetailKey && EmptyValue($this->id_set->FormValue)) {
                $this->id_set->addErrorMessage(str_replace("%s", $this->id_set->caption(), $this->id_set->RequiredErrorMessage));
            }
        }
        if ($this->keadaan->Required) {
            if (!$this->keadaan->IsDetailKey && EmptyValue($this->keadaan->FormValue)) {
                $this->keadaan->addErrorMessage(str_replace("%s", $this->keadaan->caption(), $this->keadaan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->keadaan->FormValue)) {
            $this->keadaan->addErrorMessage($this->keadaan->getErrorMessage(false));
        }
        if ($this->jumlah->Required) {
            if (!$this->jumlah->IsDetailKey && EmptyValue($this->jumlah->FormValue)) {
                $this->jumlah->addErrorMessage(str_replace("%s", $this->jumlah->caption(), $this->jumlah->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumlah->FormValue)) {
            $this->jumlah->addErrorMessage($this->jumlah->getErrorMessage(false));
        }
        if ($this->merk->Required) {
            if (!$this->merk->IsDetailKey && EmptyValue($this->merk->FormValue)) {
                $this->merk->addErrorMessage(str_replace("%s", $this->merk->caption(), $this->merk->RequiredErrorMessage));
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

        // nama_alat
        $this->nama_alat->setDbValueDef($rsnew, $this->nama_alat->CurrentValue, null, false);

        // id_set
        $this->id_set->setDbValueDef($rsnew, $this->id_set->CurrentValue, null, false);

        // keadaan
        $this->keadaan->setDbValueDef($rsnew, $this->keadaan->CurrentValue, null, false);

        // jumlah
        $this->jumlah->setDbValueDef($rsnew, $this->jumlah->CurrentValue, null, false);

        // merk
        $this->merk->setDbValueDef($rsnew, $this->merk->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MAlatCssdList"), "", $this->TableVar, true);
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
                case "x_id_set":
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
