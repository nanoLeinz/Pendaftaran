<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class ReferensiMobilejknBpjsAdd extends ReferensiMobilejknBpjs
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'referensi_mobilejkn_bpjs';

    // Page object name
    public $PageObjName = "ReferensiMobilejknBpjsAdd";

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

        // Table object (referensi_mobilejkn_bpjs)
        if (!isset($GLOBALS["referensi_mobilejkn_bpjs"]) || get_class($GLOBALS["referensi_mobilejkn_bpjs"]) == PROJECT_NAMESPACE . "referensi_mobilejkn_bpjs") {
            $GLOBALS["referensi_mobilejkn_bpjs"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'referensi_mobilejkn_bpjs');
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
                $doc = new $class(Container("referensi_mobilejkn_bpjs"));
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
                    if ($pageName == "ReferensiMobilejknBpjsView") {
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
            $key .= @$ar['id'];
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
            $this->id->Visible = false;
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
        $this->id->Visible = false;
        $this->nobooking->setVisibility();
        $this->no_rawat->setVisibility();
        $this->nomorkartu->setVisibility();
        $this->nik->setVisibility();
        $this->nohp->setVisibility();
        $this->kodepoli->setVisibility();
        $this->pasienbaru->setVisibility();
        $this->norm->setVisibility();
        $this->tanggalperiksa->setVisibility();
        $this->kodedokter->setVisibility();
        $this->jampraktek->setVisibility();
        $this->jeniskunjungan->setVisibility();
        $this->nomorreferensi->setVisibility();
        $this->nomorantrean->setVisibility();
        $this->angkaantrean->setVisibility();
        $this->estimasidilayani->setVisibility();
        $this->sisakuotajkn->setVisibility();
        $this->kuotajkn->setVisibility();
        $this->sisakuotanonjkn->setVisibility();
        $this->kuotanonjkn->setVisibility();
        $this->status->setVisibility();
        $this->validasi->setVisibility();
        $this->statuskirim->setVisibility();
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
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
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
                    $this->terminate("ReferensiMobilejknBpjsList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "ReferensiMobilejknBpjsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "ReferensiMobilejknBpjsView") {
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
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->nobooking->CurrentValue = null;
        $this->nobooking->OldValue = $this->nobooking->CurrentValue;
        $this->no_rawat->CurrentValue = "NULL";
        $this->nomorkartu->CurrentValue = "NULL";
        $this->nik->CurrentValue = "NULL";
        $this->nohp->CurrentValue = "NULL";
        $this->kodepoli->CurrentValue = "NULL";
        $this->pasienbaru->CurrentValue = null;
        $this->pasienbaru->OldValue = $this->pasienbaru->CurrentValue;
        $this->norm->CurrentValue = "NULL";
        $this->tanggalperiksa->CurrentValue = "NULL";
        $this->kodedokter->CurrentValue = "NULL";
        $this->jampraktek->CurrentValue = "NULL";
        $this->jeniskunjungan->CurrentValue = "NULL";
        $this->nomorreferensi->CurrentValue = null;
        $this->nomorreferensi->OldValue = $this->nomorreferensi->CurrentValue;
        $this->nomorantrean->CurrentValue = null;
        $this->nomorantrean->OldValue = $this->nomorantrean->CurrentValue;
        $this->angkaantrean->CurrentValue = null;
        $this->angkaantrean->OldValue = $this->angkaantrean->CurrentValue;
        $this->estimasidilayani->CurrentValue = null;
        $this->estimasidilayani->OldValue = $this->estimasidilayani->CurrentValue;
        $this->sisakuotajkn->CurrentValue = null;
        $this->sisakuotajkn->OldValue = $this->sisakuotajkn->CurrentValue;
        $this->kuotajkn->CurrentValue = null;
        $this->kuotajkn->OldValue = $this->kuotajkn->CurrentValue;
        $this->sisakuotanonjkn->CurrentValue = null;
        $this->sisakuotanonjkn->OldValue = $this->sisakuotanonjkn->CurrentValue;
        $this->kuotanonjkn->CurrentValue = null;
        $this->kuotanonjkn->OldValue = $this->kuotanonjkn->CurrentValue;
        $this->status->CurrentValue = null;
        $this->status->OldValue = $this->status->CurrentValue;
        $this->validasi->CurrentValue = null;
        $this->validasi->OldValue = $this->validasi->CurrentValue;
        $this->statuskirim->CurrentValue = null;
        $this->statuskirim->OldValue = $this->statuskirim->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'nobooking' first before field var 'x_nobooking'
        $val = $CurrentForm->hasValue("nobooking") ? $CurrentForm->getValue("nobooking") : $CurrentForm->getValue("x_nobooking");
        if (!$this->nobooking->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nobooking->Visible = false; // Disable update for API request
            } else {
                $this->nobooking->setFormValue($val);
            }
        }

        // Check field name 'no_rawat' first before field var 'x_no_rawat'
        $val = $CurrentForm->hasValue("no_rawat") ? $CurrentForm->getValue("no_rawat") : $CurrentForm->getValue("x_no_rawat");
        if (!$this->no_rawat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_rawat->Visible = false; // Disable update for API request
            } else {
                $this->no_rawat->setFormValue($val);
            }
        }

        // Check field name 'nomorkartu' first before field var 'x_nomorkartu'
        $val = $CurrentForm->hasValue("nomorkartu") ? $CurrentForm->getValue("nomorkartu") : $CurrentForm->getValue("x_nomorkartu");
        if (!$this->nomorkartu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nomorkartu->Visible = false; // Disable update for API request
            } else {
                $this->nomorkartu->setFormValue($val);
            }
        }

        // Check field name 'nik' first before field var 'x_nik'
        $val = $CurrentForm->hasValue("nik") ? $CurrentForm->getValue("nik") : $CurrentForm->getValue("x_nik");
        if (!$this->nik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nik->Visible = false; // Disable update for API request
            } else {
                $this->nik->setFormValue($val);
            }
        }

        // Check field name 'nohp' first before field var 'x_nohp'
        $val = $CurrentForm->hasValue("nohp") ? $CurrentForm->getValue("nohp") : $CurrentForm->getValue("x_nohp");
        if (!$this->nohp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nohp->Visible = false; // Disable update for API request
            } else {
                $this->nohp->setFormValue($val);
            }
        }

        // Check field name 'kodepoli' first before field var 'x_kodepoli'
        $val = $CurrentForm->hasValue("kodepoli") ? $CurrentForm->getValue("kodepoli") : $CurrentForm->getValue("x_kodepoli");
        if (!$this->kodepoli->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kodepoli->Visible = false; // Disable update for API request
            } else {
                $this->kodepoli->setFormValue($val);
            }
        }

        // Check field name 'pasienbaru' first before field var 'x_pasienbaru'
        $val = $CurrentForm->hasValue("pasienbaru") ? $CurrentForm->getValue("pasienbaru") : $CurrentForm->getValue("x_pasienbaru");
        if (!$this->pasienbaru->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pasienbaru->Visible = false; // Disable update for API request
            } else {
                $this->pasienbaru->setFormValue($val);
            }
        }

        // Check field name 'norm' first before field var 'x_norm'
        $val = $CurrentForm->hasValue("norm") ? $CurrentForm->getValue("norm") : $CurrentForm->getValue("x_norm");
        if (!$this->norm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->norm->Visible = false; // Disable update for API request
            } else {
                $this->norm->setFormValue($val);
            }
        }

        // Check field name 'tanggalperiksa' first before field var 'x_tanggalperiksa'
        $val = $CurrentForm->hasValue("tanggalperiksa") ? $CurrentForm->getValue("tanggalperiksa") : $CurrentForm->getValue("x_tanggalperiksa");
        if (!$this->tanggalperiksa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggalperiksa->Visible = false; // Disable update for API request
            } else {
                $this->tanggalperiksa->setFormValue($val);
            }
            $this->tanggalperiksa->CurrentValue = UnFormatDateTime($this->tanggalperiksa->CurrentValue, 0);
        }

        // Check field name 'kodedokter' first before field var 'x_kodedokter'
        $val = $CurrentForm->hasValue("kodedokter") ? $CurrentForm->getValue("kodedokter") : $CurrentForm->getValue("x_kodedokter");
        if (!$this->kodedokter->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kodedokter->Visible = false; // Disable update for API request
            } else {
                $this->kodedokter->setFormValue($val);
            }
        }

        // Check field name 'jampraktek' first before field var 'x_jampraktek'
        $val = $CurrentForm->hasValue("jampraktek") ? $CurrentForm->getValue("jampraktek") : $CurrentForm->getValue("x_jampraktek");
        if (!$this->jampraktek->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jampraktek->Visible = false; // Disable update for API request
            } else {
                $this->jampraktek->setFormValue($val);
            }
        }

        // Check field name 'jeniskunjungan' first before field var 'x_jeniskunjungan'
        $val = $CurrentForm->hasValue("jeniskunjungan") ? $CurrentForm->getValue("jeniskunjungan") : $CurrentForm->getValue("x_jeniskunjungan");
        if (!$this->jeniskunjungan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jeniskunjungan->Visible = false; // Disable update for API request
            } else {
                $this->jeniskunjungan->setFormValue($val);
            }
        }

        // Check field name 'nomorreferensi' first before field var 'x_nomorreferensi'
        $val = $CurrentForm->hasValue("nomorreferensi") ? $CurrentForm->getValue("nomorreferensi") : $CurrentForm->getValue("x_nomorreferensi");
        if (!$this->nomorreferensi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nomorreferensi->Visible = false; // Disable update for API request
            } else {
                $this->nomorreferensi->setFormValue($val);
            }
        }

        // Check field name 'nomorantrean' first before field var 'x_nomorantrean'
        $val = $CurrentForm->hasValue("nomorantrean") ? $CurrentForm->getValue("nomorantrean") : $CurrentForm->getValue("x_nomorantrean");
        if (!$this->nomorantrean->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nomorantrean->Visible = false; // Disable update for API request
            } else {
                $this->nomorantrean->setFormValue($val);
            }
        }

        // Check field name 'angkaantrean' first before field var 'x_angkaantrean'
        $val = $CurrentForm->hasValue("angkaantrean") ? $CurrentForm->getValue("angkaantrean") : $CurrentForm->getValue("x_angkaantrean");
        if (!$this->angkaantrean->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->angkaantrean->Visible = false; // Disable update for API request
            } else {
                $this->angkaantrean->setFormValue($val);
            }
        }

        // Check field name 'estimasidilayani' first before field var 'x_estimasidilayani'
        $val = $CurrentForm->hasValue("estimasidilayani") ? $CurrentForm->getValue("estimasidilayani") : $CurrentForm->getValue("x_estimasidilayani");
        if (!$this->estimasidilayani->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->estimasidilayani->Visible = false; // Disable update for API request
            } else {
                $this->estimasidilayani->setFormValue($val);
            }
        }

        // Check field name 'sisakuotajkn' first before field var 'x_sisakuotajkn'
        $val = $CurrentForm->hasValue("sisakuotajkn") ? $CurrentForm->getValue("sisakuotajkn") : $CurrentForm->getValue("x_sisakuotajkn");
        if (!$this->sisakuotajkn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sisakuotajkn->Visible = false; // Disable update for API request
            } else {
                $this->sisakuotajkn->setFormValue($val);
            }
        }

        // Check field name 'kuotajkn' first before field var 'x_kuotajkn'
        $val = $CurrentForm->hasValue("kuotajkn") ? $CurrentForm->getValue("kuotajkn") : $CurrentForm->getValue("x_kuotajkn");
        if (!$this->kuotajkn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kuotajkn->Visible = false; // Disable update for API request
            } else {
                $this->kuotajkn->setFormValue($val);
            }
        }

        // Check field name 'sisakuotanonjkn' first before field var 'x_sisakuotanonjkn'
        $val = $CurrentForm->hasValue("sisakuotanonjkn") ? $CurrentForm->getValue("sisakuotanonjkn") : $CurrentForm->getValue("x_sisakuotanonjkn");
        if (!$this->sisakuotanonjkn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sisakuotanonjkn->Visible = false; // Disable update for API request
            } else {
                $this->sisakuotanonjkn->setFormValue($val);
            }
        }

        // Check field name 'kuotanonjkn' first before field var 'x_kuotanonjkn'
        $val = $CurrentForm->hasValue("kuotanonjkn") ? $CurrentForm->getValue("kuotanonjkn") : $CurrentForm->getValue("x_kuotanonjkn");
        if (!$this->kuotanonjkn->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kuotanonjkn->Visible = false; // Disable update for API request
            } else {
                $this->kuotanonjkn->setFormValue($val);
            }
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }

        // Check field name 'validasi' first before field var 'x_validasi'
        $val = $CurrentForm->hasValue("validasi") ? $CurrentForm->getValue("validasi") : $CurrentForm->getValue("x_validasi");
        if (!$this->validasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->validasi->Visible = false; // Disable update for API request
            } else {
                $this->validasi->setFormValue($val);
            }
            $this->validasi->CurrentValue = UnFormatDateTime($this->validasi->CurrentValue, 0);
        }

        // Check field name 'statuskirim' first before field var 'x_statuskirim'
        $val = $CurrentForm->hasValue("statuskirim") ? $CurrentForm->getValue("statuskirim") : $CurrentForm->getValue("x_statuskirim");
        if (!$this->statuskirim->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->statuskirim->Visible = false; // Disable update for API request
            } else {
                $this->statuskirim->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nobooking->CurrentValue = $this->nobooking->FormValue;
        $this->no_rawat->CurrentValue = $this->no_rawat->FormValue;
        $this->nomorkartu->CurrentValue = $this->nomorkartu->FormValue;
        $this->nik->CurrentValue = $this->nik->FormValue;
        $this->nohp->CurrentValue = $this->nohp->FormValue;
        $this->kodepoli->CurrentValue = $this->kodepoli->FormValue;
        $this->pasienbaru->CurrentValue = $this->pasienbaru->FormValue;
        $this->norm->CurrentValue = $this->norm->FormValue;
        $this->tanggalperiksa->CurrentValue = $this->tanggalperiksa->FormValue;
        $this->tanggalperiksa->CurrentValue = UnFormatDateTime($this->tanggalperiksa->CurrentValue, 0);
        $this->kodedokter->CurrentValue = $this->kodedokter->FormValue;
        $this->jampraktek->CurrentValue = $this->jampraktek->FormValue;
        $this->jeniskunjungan->CurrentValue = $this->jeniskunjungan->FormValue;
        $this->nomorreferensi->CurrentValue = $this->nomorreferensi->FormValue;
        $this->nomorantrean->CurrentValue = $this->nomorantrean->FormValue;
        $this->angkaantrean->CurrentValue = $this->angkaantrean->FormValue;
        $this->estimasidilayani->CurrentValue = $this->estimasidilayani->FormValue;
        $this->sisakuotajkn->CurrentValue = $this->sisakuotajkn->FormValue;
        $this->kuotajkn->CurrentValue = $this->kuotajkn->FormValue;
        $this->sisakuotanonjkn->CurrentValue = $this->sisakuotanonjkn->FormValue;
        $this->kuotanonjkn->CurrentValue = $this->kuotanonjkn->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->validasi->CurrentValue = $this->validasi->FormValue;
        $this->validasi->CurrentValue = UnFormatDateTime($this->validasi->CurrentValue, 0);
        $this->statuskirim->CurrentValue = $this->statuskirim->FormValue;
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
        $this->id->setDbValue($row['id']);
        $this->nobooking->setDbValue($row['nobooking']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->nomorkartu->setDbValue($row['nomorkartu']);
        $this->nik->setDbValue($row['nik']);
        $this->nohp->setDbValue($row['nohp']);
        $this->kodepoli->setDbValue($row['kodepoli']);
        $this->pasienbaru->setDbValue($row['pasienbaru']);
        $this->norm->setDbValue($row['norm']);
        $this->tanggalperiksa->setDbValue($row['tanggalperiksa']);
        $this->kodedokter->setDbValue($row['kodedokter']);
        $this->jampraktek->setDbValue($row['jampraktek']);
        $this->jeniskunjungan->setDbValue($row['jeniskunjungan']);
        $this->nomorreferensi->setDbValue($row['nomorreferensi']);
        $this->nomorantrean->setDbValue($row['nomorantrean']);
        $this->angkaantrean->setDbValue($row['angkaantrean']);
        $this->estimasidilayani->setDbValue($row['estimasidilayani']);
        $this->sisakuotajkn->setDbValue($row['sisakuotajkn']);
        $this->kuotajkn->setDbValue($row['kuotajkn']);
        $this->sisakuotanonjkn->setDbValue($row['sisakuotanonjkn']);
        $this->kuotanonjkn->setDbValue($row['kuotanonjkn']);
        $this->status->setDbValue($row['status']);
        $this->validasi->setDbValue($row['validasi']);
        $this->statuskirim->setDbValue($row['statuskirim']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['nobooking'] = $this->nobooking->CurrentValue;
        $row['no_rawat'] = $this->no_rawat->CurrentValue;
        $row['nomorkartu'] = $this->nomorkartu->CurrentValue;
        $row['nik'] = $this->nik->CurrentValue;
        $row['nohp'] = $this->nohp->CurrentValue;
        $row['kodepoli'] = $this->kodepoli->CurrentValue;
        $row['pasienbaru'] = $this->pasienbaru->CurrentValue;
        $row['norm'] = $this->norm->CurrentValue;
        $row['tanggalperiksa'] = $this->tanggalperiksa->CurrentValue;
        $row['kodedokter'] = $this->kodedokter->CurrentValue;
        $row['jampraktek'] = $this->jampraktek->CurrentValue;
        $row['jeniskunjungan'] = $this->jeniskunjungan->CurrentValue;
        $row['nomorreferensi'] = $this->nomorreferensi->CurrentValue;
        $row['nomorantrean'] = $this->nomorantrean->CurrentValue;
        $row['angkaantrean'] = $this->angkaantrean->CurrentValue;
        $row['estimasidilayani'] = $this->estimasidilayani->CurrentValue;
        $row['sisakuotajkn'] = $this->sisakuotajkn->CurrentValue;
        $row['kuotajkn'] = $this->kuotajkn->CurrentValue;
        $row['sisakuotanonjkn'] = $this->sisakuotanonjkn->CurrentValue;
        $row['kuotanonjkn'] = $this->kuotanonjkn->CurrentValue;
        $row['status'] = $this->status->CurrentValue;
        $row['validasi'] = $this->validasi->CurrentValue;
        $row['statuskirim'] = $this->statuskirim->CurrentValue;
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

        // id

        // nobooking

        // no_rawat

        // nomorkartu

        // nik

        // nohp

        // kodepoli

        // pasienbaru

        // norm

        // tanggalperiksa

        // kodedokter

        // jampraktek

        // jeniskunjungan

        // nomorreferensi

        // nomorantrean

        // angkaantrean

        // estimasidilayani

        // sisakuotajkn

        // kuotajkn

        // sisakuotanonjkn

        // kuotanonjkn

        // status

        // validasi

        // statuskirim
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // nobooking
            $this->nobooking->ViewValue = $this->nobooking->CurrentValue;
            $this->nobooking->ViewCustomAttributes = "";

            // no_rawat
            $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
            $this->no_rawat->ViewCustomAttributes = "";

            // nomorkartu
            $this->nomorkartu->ViewValue = $this->nomorkartu->CurrentValue;
            $this->nomorkartu->ViewCustomAttributes = "";

            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // nohp
            $this->nohp->ViewValue = $this->nohp->CurrentValue;
            $this->nohp->ViewCustomAttributes = "";

            // kodepoli
            $this->kodepoli->ViewValue = $this->kodepoli->CurrentValue;
            $this->kodepoli->ViewCustomAttributes = "";

            // pasienbaru
            $this->pasienbaru->ViewValue = $this->pasienbaru->CurrentValue;
            $this->pasienbaru->ViewValue = FormatNumber($this->pasienbaru->ViewValue, 0, -2, -2, -2);
            $this->pasienbaru->ViewCustomAttributes = "";

            // norm
            $this->norm->ViewValue = $this->norm->CurrentValue;
            $this->norm->ViewCustomAttributes = "";

            // tanggalperiksa
            $this->tanggalperiksa->ViewValue = $this->tanggalperiksa->CurrentValue;
            $this->tanggalperiksa->ViewValue = FormatDateTime($this->tanggalperiksa->ViewValue, 0);
            $this->tanggalperiksa->ViewCustomAttributes = "";

            // kodedokter
            $this->kodedokter->ViewValue = $this->kodedokter->CurrentValue;
            $this->kodedokter->ViewCustomAttributes = "";

            // jampraktek
            $this->jampraktek->ViewValue = $this->jampraktek->CurrentValue;
            $this->jampraktek->ViewCustomAttributes = "";

            // jeniskunjungan
            $this->jeniskunjungan->ViewValue = $this->jeniskunjungan->CurrentValue;
            $this->jeniskunjungan->ViewCustomAttributes = "";

            // nomorreferensi
            $this->nomorreferensi->ViewValue = $this->nomorreferensi->CurrentValue;
            $this->nomorreferensi->ViewCustomAttributes = "";

            // nomorantrean
            $this->nomorantrean->ViewValue = $this->nomorantrean->CurrentValue;
            $this->nomorantrean->ViewCustomAttributes = "";

            // angkaantrean
            $this->angkaantrean->ViewValue = $this->angkaantrean->CurrentValue;
            $this->angkaantrean->ViewCustomAttributes = "";

            // estimasidilayani
            $this->estimasidilayani->ViewValue = $this->estimasidilayani->CurrentValue;
            $this->estimasidilayani->ViewCustomAttributes = "";

            // sisakuotajkn
            $this->sisakuotajkn->ViewValue = $this->sisakuotajkn->CurrentValue;
            $this->sisakuotajkn->ViewValue = FormatNumber($this->sisakuotajkn->ViewValue, 0, -2, -2, -2);
            $this->sisakuotajkn->ViewCustomAttributes = "";

            // kuotajkn
            $this->kuotajkn->ViewValue = $this->kuotajkn->CurrentValue;
            $this->kuotajkn->ViewValue = FormatNumber($this->kuotajkn->ViewValue, 0, -2, -2, -2);
            $this->kuotajkn->ViewCustomAttributes = "";

            // sisakuotanonjkn
            $this->sisakuotanonjkn->ViewValue = $this->sisakuotanonjkn->CurrentValue;
            $this->sisakuotanonjkn->ViewValue = FormatNumber($this->sisakuotanonjkn->ViewValue, 0, -2, -2, -2);
            $this->sisakuotanonjkn->ViewCustomAttributes = "";

            // kuotanonjkn
            $this->kuotanonjkn->ViewValue = $this->kuotanonjkn->CurrentValue;
            $this->kuotanonjkn->ViewValue = FormatNumber($this->kuotanonjkn->ViewValue, 0, -2, -2, -2);
            $this->kuotanonjkn->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // validasi
            $this->validasi->ViewValue = $this->validasi->CurrentValue;
            $this->validasi->ViewValue = FormatDateTime($this->validasi->ViewValue, 0);
            $this->validasi->ViewCustomAttributes = "";

            // statuskirim
            $this->statuskirim->ViewValue = $this->statuskirim->CurrentValue;
            $this->statuskirim->ViewCustomAttributes = "";

            // nobooking
            $this->nobooking->LinkCustomAttributes = "";
            $this->nobooking->HrefValue = "";
            $this->nobooking->TooltipValue = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";
            $this->no_rawat->TooltipValue = "";

            // nomorkartu
            $this->nomorkartu->LinkCustomAttributes = "";
            $this->nomorkartu->HrefValue = "";
            $this->nomorkartu->TooltipValue = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // nohp
            $this->nohp->LinkCustomAttributes = "";
            $this->nohp->HrefValue = "";
            $this->nohp->TooltipValue = "";

            // kodepoli
            $this->kodepoli->LinkCustomAttributes = "";
            $this->kodepoli->HrefValue = "";
            $this->kodepoli->TooltipValue = "";

            // pasienbaru
            $this->pasienbaru->LinkCustomAttributes = "";
            $this->pasienbaru->HrefValue = "";
            $this->pasienbaru->TooltipValue = "";

            // norm
            $this->norm->LinkCustomAttributes = "";
            $this->norm->HrefValue = "";
            $this->norm->TooltipValue = "";

            // tanggalperiksa
            $this->tanggalperiksa->LinkCustomAttributes = "";
            $this->tanggalperiksa->HrefValue = "";
            $this->tanggalperiksa->TooltipValue = "";

            // kodedokter
            $this->kodedokter->LinkCustomAttributes = "";
            $this->kodedokter->HrefValue = "";
            $this->kodedokter->TooltipValue = "";

            // jampraktek
            $this->jampraktek->LinkCustomAttributes = "";
            $this->jampraktek->HrefValue = "";
            $this->jampraktek->TooltipValue = "";

            // jeniskunjungan
            $this->jeniskunjungan->LinkCustomAttributes = "";
            $this->jeniskunjungan->HrefValue = "";
            $this->jeniskunjungan->TooltipValue = "";

            // nomorreferensi
            $this->nomorreferensi->LinkCustomAttributes = "";
            $this->nomorreferensi->HrefValue = "";
            $this->nomorreferensi->TooltipValue = "";

            // nomorantrean
            $this->nomorantrean->LinkCustomAttributes = "";
            $this->nomorantrean->HrefValue = "";
            $this->nomorantrean->TooltipValue = "";

            // angkaantrean
            $this->angkaantrean->LinkCustomAttributes = "";
            $this->angkaantrean->HrefValue = "";
            $this->angkaantrean->TooltipValue = "";

            // estimasidilayani
            $this->estimasidilayani->LinkCustomAttributes = "";
            $this->estimasidilayani->HrefValue = "";
            $this->estimasidilayani->TooltipValue = "";

            // sisakuotajkn
            $this->sisakuotajkn->LinkCustomAttributes = "";
            $this->sisakuotajkn->HrefValue = "";
            $this->sisakuotajkn->TooltipValue = "";

            // kuotajkn
            $this->kuotajkn->LinkCustomAttributes = "";
            $this->kuotajkn->HrefValue = "";
            $this->kuotajkn->TooltipValue = "";

            // sisakuotanonjkn
            $this->sisakuotanonjkn->LinkCustomAttributes = "";
            $this->sisakuotanonjkn->HrefValue = "";
            $this->sisakuotanonjkn->TooltipValue = "";

            // kuotanonjkn
            $this->kuotanonjkn->LinkCustomAttributes = "";
            $this->kuotanonjkn->HrefValue = "";
            $this->kuotanonjkn->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // validasi
            $this->validasi->LinkCustomAttributes = "";
            $this->validasi->HrefValue = "";
            $this->validasi->TooltipValue = "";

            // statuskirim
            $this->statuskirim->LinkCustomAttributes = "";
            $this->statuskirim->HrefValue = "";
            $this->statuskirim->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nobooking
            $this->nobooking->EditAttrs["class"] = "form-control";
            $this->nobooking->EditCustomAttributes = "";
            if (!$this->nobooking->Raw) {
                $this->nobooking->CurrentValue = HtmlDecode($this->nobooking->CurrentValue);
            }
            $this->nobooking->EditValue = HtmlEncode($this->nobooking->CurrentValue);
            $this->nobooking->PlaceHolder = RemoveHtml($this->nobooking->caption());

            // no_rawat
            $this->no_rawat->EditAttrs["class"] = "form-control";
            $this->no_rawat->EditCustomAttributes = "";
            if (!$this->no_rawat->Raw) {
                $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
            }
            $this->no_rawat->EditValue = HtmlEncode($this->no_rawat->CurrentValue);
            $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());

            // nomorkartu
            $this->nomorkartu->EditAttrs["class"] = "form-control";
            $this->nomorkartu->EditCustomAttributes = "";
            if (!$this->nomorkartu->Raw) {
                $this->nomorkartu->CurrentValue = HtmlDecode($this->nomorkartu->CurrentValue);
            }
            $this->nomorkartu->EditValue = HtmlEncode($this->nomorkartu->CurrentValue);
            $this->nomorkartu->PlaceHolder = RemoveHtml($this->nomorkartu->caption());

            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            if (!$this->nik->Raw) {
                $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
            }
            $this->nik->EditValue = HtmlEncode($this->nik->CurrentValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // nohp
            $this->nohp->EditAttrs["class"] = "form-control";
            $this->nohp->EditCustomAttributes = "";
            if (!$this->nohp->Raw) {
                $this->nohp->CurrentValue = HtmlDecode($this->nohp->CurrentValue);
            }
            $this->nohp->EditValue = HtmlEncode($this->nohp->CurrentValue);
            $this->nohp->PlaceHolder = RemoveHtml($this->nohp->caption());

            // kodepoli
            $this->kodepoli->EditAttrs["class"] = "form-control";
            $this->kodepoli->EditCustomAttributes = "";
            if (!$this->kodepoli->Raw) {
                $this->kodepoli->CurrentValue = HtmlDecode($this->kodepoli->CurrentValue);
            }
            $this->kodepoli->EditValue = HtmlEncode($this->kodepoli->CurrentValue);
            $this->kodepoli->PlaceHolder = RemoveHtml($this->kodepoli->caption());

            // pasienbaru
            $this->pasienbaru->EditAttrs["class"] = "form-control";
            $this->pasienbaru->EditCustomAttributes = "";
            $this->pasienbaru->EditValue = HtmlEncode($this->pasienbaru->CurrentValue);
            $this->pasienbaru->PlaceHolder = RemoveHtml($this->pasienbaru->caption());

            // norm
            $this->norm->EditAttrs["class"] = "form-control";
            $this->norm->EditCustomAttributes = "";
            if (!$this->norm->Raw) {
                $this->norm->CurrentValue = HtmlDecode($this->norm->CurrentValue);
            }
            $this->norm->EditValue = HtmlEncode($this->norm->CurrentValue);
            $this->norm->PlaceHolder = RemoveHtml($this->norm->caption());

            // tanggalperiksa
            $this->tanggalperiksa->EditAttrs["class"] = "form-control";
            $this->tanggalperiksa->EditCustomAttributes = "";
            $this->tanggalperiksa->EditValue = HtmlEncode(FormatDateTime($this->tanggalperiksa->CurrentValue, 8));
            $this->tanggalperiksa->PlaceHolder = RemoveHtml($this->tanggalperiksa->caption());

            // kodedokter
            $this->kodedokter->EditAttrs["class"] = "form-control";
            $this->kodedokter->EditCustomAttributes = "";
            if (!$this->kodedokter->Raw) {
                $this->kodedokter->CurrentValue = HtmlDecode($this->kodedokter->CurrentValue);
            }
            $this->kodedokter->EditValue = HtmlEncode($this->kodedokter->CurrentValue);
            $this->kodedokter->PlaceHolder = RemoveHtml($this->kodedokter->caption());

            // jampraktek
            $this->jampraktek->EditAttrs["class"] = "form-control";
            $this->jampraktek->EditCustomAttributes = "";
            if (!$this->jampraktek->Raw) {
                $this->jampraktek->CurrentValue = HtmlDecode($this->jampraktek->CurrentValue);
            }
            $this->jampraktek->EditValue = HtmlEncode($this->jampraktek->CurrentValue);
            $this->jampraktek->PlaceHolder = RemoveHtml($this->jampraktek->caption());

            // jeniskunjungan
            $this->jeniskunjungan->EditAttrs["class"] = "form-control";
            $this->jeniskunjungan->EditCustomAttributes = "";
            if (!$this->jeniskunjungan->Raw) {
                $this->jeniskunjungan->CurrentValue = HtmlDecode($this->jeniskunjungan->CurrentValue);
            }
            $this->jeniskunjungan->EditValue = HtmlEncode($this->jeniskunjungan->CurrentValue);
            $this->jeniskunjungan->PlaceHolder = RemoveHtml($this->jeniskunjungan->caption());

            // nomorreferensi
            $this->nomorreferensi->EditAttrs["class"] = "form-control";
            $this->nomorreferensi->EditCustomAttributes = "";
            if (!$this->nomorreferensi->Raw) {
                $this->nomorreferensi->CurrentValue = HtmlDecode($this->nomorreferensi->CurrentValue);
            }
            $this->nomorreferensi->EditValue = HtmlEncode($this->nomorreferensi->CurrentValue);
            $this->nomorreferensi->PlaceHolder = RemoveHtml($this->nomorreferensi->caption());

            // nomorantrean
            $this->nomorantrean->EditAttrs["class"] = "form-control";
            $this->nomorantrean->EditCustomAttributes = "";
            if (!$this->nomorantrean->Raw) {
                $this->nomorantrean->CurrentValue = HtmlDecode($this->nomorantrean->CurrentValue);
            }
            $this->nomorantrean->EditValue = HtmlEncode($this->nomorantrean->CurrentValue);
            $this->nomorantrean->PlaceHolder = RemoveHtml($this->nomorantrean->caption());

            // angkaantrean
            $this->angkaantrean->EditAttrs["class"] = "form-control";
            $this->angkaantrean->EditCustomAttributes = "";
            if (!$this->angkaantrean->Raw) {
                $this->angkaantrean->CurrentValue = HtmlDecode($this->angkaantrean->CurrentValue);
            }
            $this->angkaantrean->EditValue = HtmlEncode($this->angkaantrean->CurrentValue);
            $this->angkaantrean->PlaceHolder = RemoveHtml($this->angkaantrean->caption());

            // estimasidilayani
            $this->estimasidilayani->EditAttrs["class"] = "form-control";
            $this->estimasidilayani->EditCustomAttributes = "";
            if (!$this->estimasidilayani->Raw) {
                $this->estimasidilayani->CurrentValue = HtmlDecode($this->estimasidilayani->CurrentValue);
            }
            $this->estimasidilayani->EditValue = HtmlEncode($this->estimasidilayani->CurrentValue);
            $this->estimasidilayani->PlaceHolder = RemoveHtml($this->estimasidilayani->caption());

            // sisakuotajkn
            $this->sisakuotajkn->EditAttrs["class"] = "form-control";
            $this->sisakuotajkn->EditCustomAttributes = "";
            $this->sisakuotajkn->EditValue = HtmlEncode($this->sisakuotajkn->CurrentValue);
            $this->sisakuotajkn->PlaceHolder = RemoveHtml($this->sisakuotajkn->caption());

            // kuotajkn
            $this->kuotajkn->EditAttrs["class"] = "form-control";
            $this->kuotajkn->EditCustomAttributes = "";
            $this->kuotajkn->EditValue = HtmlEncode($this->kuotajkn->CurrentValue);
            $this->kuotajkn->PlaceHolder = RemoveHtml($this->kuotajkn->caption());

            // sisakuotanonjkn
            $this->sisakuotanonjkn->EditAttrs["class"] = "form-control";
            $this->sisakuotanonjkn->EditCustomAttributes = "";
            $this->sisakuotanonjkn->EditValue = HtmlEncode($this->sisakuotanonjkn->CurrentValue);
            $this->sisakuotanonjkn->PlaceHolder = RemoveHtml($this->sisakuotanonjkn->caption());

            // kuotanonjkn
            $this->kuotanonjkn->EditAttrs["class"] = "form-control";
            $this->kuotanonjkn->EditCustomAttributes = "";
            $this->kuotanonjkn->EditValue = HtmlEncode($this->kuotanonjkn->CurrentValue);
            $this->kuotanonjkn->PlaceHolder = RemoveHtml($this->kuotanonjkn->caption());

            // status
            $this->status->EditAttrs["class"] = "form-control";
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // validasi
            $this->validasi->EditAttrs["class"] = "form-control";
            $this->validasi->EditCustomAttributes = "";
            $this->validasi->EditValue = HtmlEncode(FormatDateTime($this->validasi->CurrentValue, 8));
            $this->validasi->PlaceHolder = RemoveHtml($this->validasi->caption());

            // statuskirim
            $this->statuskirim->EditAttrs["class"] = "form-control";
            $this->statuskirim->EditCustomAttributes = "";
            if (!$this->statuskirim->Raw) {
                $this->statuskirim->CurrentValue = HtmlDecode($this->statuskirim->CurrentValue);
            }
            $this->statuskirim->EditValue = HtmlEncode($this->statuskirim->CurrentValue);
            $this->statuskirim->PlaceHolder = RemoveHtml($this->statuskirim->caption());

            // Add refer script

            // nobooking
            $this->nobooking->LinkCustomAttributes = "";
            $this->nobooking->HrefValue = "";

            // no_rawat
            $this->no_rawat->LinkCustomAttributes = "";
            $this->no_rawat->HrefValue = "";

            // nomorkartu
            $this->nomorkartu->LinkCustomAttributes = "";
            $this->nomorkartu->HrefValue = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";

            // nohp
            $this->nohp->LinkCustomAttributes = "";
            $this->nohp->HrefValue = "";

            // kodepoli
            $this->kodepoli->LinkCustomAttributes = "";
            $this->kodepoli->HrefValue = "";

            // pasienbaru
            $this->pasienbaru->LinkCustomAttributes = "";
            $this->pasienbaru->HrefValue = "";

            // norm
            $this->norm->LinkCustomAttributes = "";
            $this->norm->HrefValue = "";

            // tanggalperiksa
            $this->tanggalperiksa->LinkCustomAttributes = "";
            $this->tanggalperiksa->HrefValue = "";

            // kodedokter
            $this->kodedokter->LinkCustomAttributes = "";
            $this->kodedokter->HrefValue = "";

            // jampraktek
            $this->jampraktek->LinkCustomAttributes = "";
            $this->jampraktek->HrefValue = "";

            // jeniskunjungan
            $this->jeniskunjungan->LinkCustomAttributes = "";
            $this->jeniskunjungan->HrefValue = "";

            // nomorreferensi
            $this->nomorreferensi->LinkCustomAttributes = "";
            $this->nomorreferensi->HrefValue = "";

            // nomorantrean
            $this->nomorantrean->LinkCustomAttributes = "";
            $this->nomorantrean->HrefValue = "";

            // angkaantrean
            $this->angkaantrean->LinkCustomAttributes = "";
            $this->angkaantrean->HrefValue = "";

            // estimasidilayani
            $this->estimasidilayani->LinkCustomAttributes = "";
            $this->estimasidilayani->HrefValue = "";

            // sisakuotajkn
            $this->sisakuotajkn->LinkCustomAttributes = "";
            $this->sisakuotajkn->HrefValue = "";

            // kuotajkn
            $this->kuotajkn->LinkCustomAttributes = "";
            $this->kuotajkn->HrefValue = "";

            // sisakuotanonjkn
            $this->sisakuotanonjkn->LinkCustomAttributes = "";
            $this->sisakuotanonjkn->HrefValue = "";

            // kuotanonjkn
            $this->kuotanonjkn->LinkCustomAttributes = "";
            $this->kuotanonjkn->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // validasi
            $this->validasi->LinkCustomAttributes = "";
            $this->validasi->HrefValue = "";

            // statuskirim
            $this->statuskirim->LinkCustomAttributes = "";
            $this->statuskirim->HrefValue = "";
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
        if ($this->nobooking->Required) {
            if (!$this->nobooking->IsDetailKey && EmptyValue($this->nobooking->FormValue)) {
                $this->nobooking->addErrorMessage(str_replace("%s", $this->nobooking->caption(), $this->nobooking->RequiredErrorMessage));
            }
        }
        if ($this->no_rawat->Required) {
            if (!$this->no_rawat->IsDetailKey && EmptyValue($this->no_rawat->FormValue)) {
                $this->no_rawat->addErrorMessage(str_replace("%s", $this->no_rawat->caption(), $this->no_rawat->RequiredErrorMessage));
            }
        }
        if ($this->nomorkartu->Required) {
            if (!$this->nomorkartu->IsDetailKey && EmptyValue($this->nomorkartu->FormValue)) {
                $this->nomorkartu->addErrorMessage(str_replace("%s", $this->nomorkartu->caption(), $this->nomorkartu->RequiredErrorMessage));
            }
        }
        if ($this->nik->Required) {
            if (!$this->nik->IsDetailKey && EmptyValue($this->nik->FormValue)) {
                $this->nik->addErrorMessage(str_replace("%s", $this->nik->caption(), $this->nik->RequiredErrorMessage));
            }
        }
        if ($this->nohp->Required) {
            if (!$this->nohp->IsDetailKey && EmptyValue($this->nohp->FormValue)) {
                $this->nohp->addErrorMessage(str_replace("%s", $this->nohp->caption(), $this->nohp->RequiredErrorMessage));
            }
        }
        if ($this->kodepoli->Required) {
            if (!$this->kodepoli->IsDetailKey && EmptyValue($this->kodepoli->FormValue)) {
                $this->kodepoli->addErrorMessage(str_replace("%s", $this->kodepoli->caption(), $this->kodepoli->RequiredErrorMessage));
            }
        }
        if ($this->pasienbaru->Required) {
            if (!$this->pasienbaru->IsDetailKey && EmptyValue($this->pasienbaru->FormValue)) {
                $this->pasienbaru->addErrorMessage(str_replace("%s", $this->pasienbaru->caption(), $this->pasienbaru->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pasienbaru->FormValue)) {
            $this->pasienbaru->addErrorMessage($this->pasienbaru->getErrorMessage(false));
        }
        if ($this->norm->Required) {
            if (!$this->norm->IsDetailKey && EmptyValue($this->norm->FormValue)) {
                $this->norm->addErrorMessage(str_replace("%s", $this->norm->caption(), $this->norm->RequiredErrorMessage));
            }
        }
        if ($this->tanggalperiksa->Required) {
            if (!$this->tanggalperiksa->IsDetailKey && EmptyValue($this->tanggalperiksa->FormValue)) {
                $this->tanggalperiksa->addErrorMessage(str_replace("%s", $this->tanggalperiksa->caption(), $this->tanggalperiksa->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggalperiksa->FormValue)) {
            $this->tanggalperiksa->addErrorMessage($this->tanggalperiksa->getErrorMessage(false));
        }
        if ($this->kodedokter->Required) {
            if (!$this->kodedokter->IsDetailKey && EmptyValue($this->kodedokter->FormValue)) {
                $this->kodedokter->addErrorMessage(str_replace("%s", $this->kodedokter->caption(), $this->kodedokter->RequiredErrorMessage));
            }
        }
        if ($this->jampraktek->Required) {
            if (!$this->jampraktek->IsDetailKey && EmptyValue($this->jampraktek->FormValue)) {
                $this->jampraktek->addErrorMessage(str_replace("%s", $this->jampraktek->caption(), $this->jampraktek->RequiredErrorMessage));
            }
        }
        if ($this->jeniskunjungan->Required) {
            if (!$this->jeniskunjungan->IsDetailKey && EmptyValue($this->jeniskunjungan->FormValue)) {
                $this->jeniskunjungan->addErrorMessage(str_replace("%s", $this->jeniskunjungan->caption(), $this->jeniskunjungan->RequiredErrorMessage));
            }
        }
        if ($this->nomorreferensi->Required) {
            if (!$this->nomorreferensi->IsDetailKey && EmptyValue($this->nomorreferensi->FormValue)) {
                $this->nomorreferensi->addErrorMessage(str_replace("%s", $this->nomorreferensi->caption(), $this->nomorreferensi->RequiredErrorMessage));
            }
        }
        if ($this->nomorantrean->Required) {
            if (!$this->nomorantrean->IsDetailKey && EmptyValue($this->nomorantrean->FormValue)) {
                $this->nomorantrean->addErrorMessage(str_replace("%s", $this->nomorantrean->caption(), $this->nomorantrean->RequiredErrorMessage));
            }
        }
        if ($this->angkaantrean->Required) {
            if (!$this->angkaantrean->IsDetailKey && EmptyValue($this->angkaantrean->FormValue)) {
                $this->angkaantrean->addErrorMessage(str_replace("%s", $this->angkaantrean->caption(), $this->angkaantrean->RequiredErrorMessage));
            }
        }
        if ($this->estimasidilayani->Required) {
            if (!$this->estimasidilayani->IsDetailKey && EmptyValue($this->estimasidilayani->FormValue)) {
                $this->estimasidilayani->addErrorMessage(str_replace("%s", $this->estimasidilayani->caption(), $this->estimasidilayani->RequiredErrorMessage));
            }
        }
        if ($this->sisakuotajkn->Required) {
            if (!$this->sisakuotajkn->IsDetailKey && EmptyValue($this->sisakuotajkn->FormValue)) {
                $this->sisakuotajkn->addErrorMessage(str_replace("%s", $this->sisakuotajkn->caption(), $this->sisakuotajkn->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sisakuotajkn->FormValue)) {
            $this->sisakuotajkn->addErrorMessage($this->sisakuotajkn->getErrorMessage(false));
        }
        if ($this->kuotajkn->Required) {
            if (!$this->kuotajkn->IsDetailKey && EmptyValue($this->kuotajkn->FormValue)) {
                $this->kuotajkn->addErrorMessage(str_replace("%s", $this->kuotajkn->caption(), $this->kuotajkn->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->kuotajkn->FormValue)) {
            $this->kuotajkn->addErrorMessage($this->kuotajkn->getErrorMessage(false));
        }
        if ($this->sisakuotanonjkn->Required) {
            if (!$this->sisakuotanonjkn->IsDetailKey && EmptyValue($this->sisakuotanonjkn->FormValue)) {
                $this->sisakuotanonjkn->addErrorMessage(str_replace("%s", $this->sisakuotanonjkn->caption(), $this->sisakuotanonjkn->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sisakuotanonjkn->FormValue)) {
            $this->sisakuotanonjkn->addErrorMessage($this->sisakuotanonjkn->getErrorMessage(false));
        }
        if ($this->kuotanonjkn->Required) {
            if (!$this->kuotanonjkn->IsDetailKey && EmptyValue($this->kuotanonjkn->FormValue)) {
                $this->kuotanonjkn->addErrorMessage(str_replace("%s", $this->kuotanonjkn->caption(), $this->kuotanonjkn->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->kuotanonjkn->FormValue)) {
            $this->kuotanonjkn->addErrorMessage($this->kuotanonjkn->getErrorMessage(false));
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->validasi->Required) {
            if (!$this->validasi->IsDetailKey && EmptyValue($this->validasi->FormValue)) {
                $this->validasi->addErrorMessage(str_replace("%s", $this->validasi->caption(), $this->validasi->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->validasi->FormValue)) {
            $this->validasi->addErrorMessage($this->validasi->getErrorMessage(false));
        }
        if ($this->statuskirim->Required) {
            if (!$this->statuskirim->IsDetailKey && EmptyValue($this->statuskirim->FormValue)) {
                $this->statuskirim->addErrorMessage(str_replace("%s", $this->statuskirim->caption(), $this->statuskirim->RequiredErrorMessage));
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

        // nobooking
        $this->nobooking->setDbValueDef($rsnew, $this->nobooking->CurrentValue, null, false);

        // no_rawat
        $this->no_rawat->setDbValueDef($rsnew, $this->no_rawat->CurrentValue, null, strval($this->no_rawat->CurrentValue) == "");

        // nomorkartu
        $this->nomorkartu->setDbValueDef($rsnew, $this->nomorkartu->CurrentValue, null, strval($this->nomorkartu->CurrentValue) == "");

        // nik
        $this->nik->setDbValueDef($rsnew, $this->nik->CurrentValue, null, strval($this->nik->CurrentValue) == "");

        // nohp
        $this->nohp->setDbValueDef($rsnew, $this->nohp->CurrentValue, null, strval($this->nohp->CurrentValue) == "");

        // kodepoli
        $this->kodepoli->setDbValueDef($rsnew, $this->kodepoli->CurrentValue, null, strval($this->kodepoli->CurrentValue) == "");

        // pasienbaru
        $this->pasienbaru->setDbValueDef($rsnew, $this->pasienbaru->CurrentValue, 0, false);

        // norm
        $this->norm->setDbValueDef($rsnew, $this->norm->CurrentValue, null, strval($this->norm->CurrentValue) == "");

        // tanggalperiksa
        $this->tanggalperiksa->setDbValueDef($rsnew, UnFormatDateTime($this->tanggalperiksa->CurrentValue, 0), null, strval($this->tanggalperiksa->CurrentValue) == "");

        // kodedokter
        $this->kodedokter->setDbValueDef($rsnew, $this->kodedokter->CurrentValue, null, strval($this->kodedokter->CurrentValue) == "");

        // jampraktek
        $this->jampraktek->setDbValueDef($rsnew, $this->jampraktek->CurrentValue, null, strval($this->jampraktek->CurrentValue) == "");

        // jeniskunjungan
        $this->jeniskunjungan->setDbValueDef($rsnew, $this->jeniskunjungan->CurrentValue, null, strval($this->jeniskunjungan->CurrentValue) == "");

        // nomorreferensi
        $this->nomorreferensi->setDbValueDef($rsnew, $this->nomorreferensi->CurrentValue, "", false);

        // nomorantrean
        $this->nomorantrean->setDbValueDef($rsnew, $this->nomorantrean->CurrentValue, null, false);

        // angkaantrean
        $this->angkaantrean->setDbValueDef($rsnew, $this->angkaantrean->CurrentValue, null, false);

        // estimasidilayani
        $this->estimasidilayani->setDbValueDef($rsnew, $this->estimasidilayani->CurrentValue, null, false);

        // sisakuotajkn
        $this->sisakuotajkn->setDbValueDef($rsnew, $this->sisakuotajkn->CurrentValue, null, false);

        // kuotajkn
        $this->kuotajkn->setDbValueDef($rsnew, $this->kuotajkn->CurrentValue, null, false);

        // sisakuotanonjkn
        $this->sisakuotanonjkn->setDbValueDef($rsnew, $this->sisakuotanonjkn->CurrentValue, null, false);

        // kuotanonjkn
        $this->kuotanonjkn->setDbValueDef($rsnew, $this->kuotanonjkn->CurrentValue, null, false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, false);

        // validasi
        $this->validasi->setDbValueDef($rsnew, UnFormatDateTime($this->validasi->CurrentValue, 0), null, false);

        // statuskirim
        $this->statuskirim->setDbValueDef($rsnew, $this->statuskirim->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ReferensiMobilejknBpjsList"), "", $this->TableVar, true);
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
