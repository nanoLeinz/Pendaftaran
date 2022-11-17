<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class AntrianPendaftaranEdit extends AntrianPendaftaran
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'ANTRIAN_PENDAFTARAN';

    // Page object name
    public $PageObjName = "AntrianPendaftaranEdit";

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

        // Table object (ANTRIAN_PENDAFTARAN)
        if (!isset($GLOBALS["ANTRIAN_PENDAFTARAN"]) || get_class($GLOBALS["ANTRIAN_PENDAFTARAN"]) == PROJECT_NAMESPACE . "ANTRIAN_PENDAFTARAN") {
            $GLOBALS["ANTRIAN_PENDAFTARAN"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'ANTRIAN_PENDAFTARAN');
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
                $doc = new $class(Container("ANTRIAN_PENDAFTARAN"));
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
                    if ($pageName == "AntrianPendaftaranView") {
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
            $key .= @$ar['Id'];
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
            $this->Id->Visible = false;
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
        $this->Id->setVisibility();
        $this->no_urut->setVisibility();
        $this->tanggal_daftar->setVisibility();
        $this->tanggal_panggil->setVisibility();
        $this->loket->setVisibility();
        $this->status_panggil->setVisibility();
        $this->user->setVisibility();
        $this->newapp->setVisibility();
        $this->kdpoli->setVisibility();
        $this->tanggal_pesan->setVisibility();
        $this->tujuan->setVisibility();
        $this->disabilitas->setVisibility();
        $this->nama->setVisibility();
        $this->no_bpjs->setVisibility();
        $this->nomr->setVisibility();
        $this->tempat_lahir->setVisibility();
        $this->tanggal_lahir->setVisibility();
        $this->jk->setVisibility();
        $this->alamat->setVisibility();
        $this->agama->setVisibility();
        $this->pekerjaan->setVisibility();
        $this->no_telp->setVisibility();
        $this->nama_ibu->setVisibility();
        $this->nama_ayah->setVisibility();
        $this->nama_pasangan->setVisibility();
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
            if (($keyValue = Get("Id") ?? Key(0) ?? Route(2)) !== null) {
                $this->Id->setQueryStringValue($keyValue);
                $this->Id->setOldValue($this->Id->QueryStringValue);
            } elseif (Post("Id") !== null) {
                $this->Id->setFormValue(Post("Id"));
                $this->Id->setOldValue($this->Id->FormValue);
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
                if (($keyValue = Get("Id") ?? Route("Id")) !== null) {
                    $this->Id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->Id->CurrentValue = null;
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
                    $this->terminate("AntrianPendaftaranList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "AntrianPendaftaranList") {
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

        // Check field name 'Id' first before field var 'x_Id'
        $val = $CurrentForm->hasValue("Id") ? $CurrentForm->getValue("Id") : $CurrentForm->getValue("x_Id");
        if (!$this->Id->IsDetailKey) {
            $this->Id->setFormValue($val);
        }

        // Check field name 'no_urut' first before field var 'x_no_urut'
        $val = $CurrentForm->hasValue("no_urut") ? $CurrentForm->getValue("no_urut") : $CurrentForm->getValue("x_no_urut");
        if (!$this->no_urut->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_urut->Visible = false; // Disable update for API request
            } else {
                $this->no_urut->setFormValue($val);
            }
        }

        // Check field name 'tanggal_daftar' first before field var 'x_tanggal_daftar'
        $val = $CurrentForm->hasValue("tanggal_daftar") ? $CurrentForm->getValue("tanggal_daftar") : $CurrentForm->getValue("x_tanggal_daftar");
        if (!$this->tanggal_daftar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_daftar->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_daftar->setFormValue($val);
            }
            $this->tanggal_daftar->CurrentValue = UnFormatDateTime($this->tanggal_daftar->CurrentValue, 0);
        }

        // Check field name 'tanggal_panggil' first before field var 'x_tanggal_panggil'
        $val = $CurrentForm->hasValue("tanggal_panggil") ? $CurrentForm->getValue("tanggal_panggil") : $CurrentForm->getValue("x_tanggal_panggil");
        if (!$this->tanggal_panggil->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_panggil->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_panggil->setFormValue($val);
            }
            $this->tanggal_panggil->CurrentValue = UnFormatDateTime($this->tanggal_panggil->CurrentValue, 0);
        }

        // Check field name 'loket' first before field var 'x_loket'
        $val = $CurrentForm->hasValue("loket") ? $CurrentForm->getValue("loket") : $CurrentForm->getValue("x_loket");
        if (!$this->loket->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->loket->Visible = false; // Disable update for API request
            } else {
                $this->loket->setFormValue($val);
            }
        }

        // Check field name 'status_panggil' first before field var 'x_status_panggil'
        $val = $CurrentForm->hasValue("status_panggil") ? $CurrentForm->getValue("status_panggil") : $CurrentForm->getValue("x_status_panggil");
        if (!$this->status_panggil->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status_panggil->Visible = false; // Disable update for API request
            } else {
                $this->status_panggil->setFormValue($val);
            }
        }

        // Check field name 'user' first before field var 'x_user'
        $val = $CurrentForm->hasValue("user") ? $CurrentForm->getValue("user") : $CurrentForm->getValue("x_user");
        if (!$this->user->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user->Visible = false; // Disable update for API request
            } else {
                $this->user->setFormValue($val);
            }
        }

        // Check field name 'newapp' first before field var 'x_newapp'
        $val = $CurrentForm->hasValue("newapp") ? $CurrentForm->getValue("newapp") : $CurrentForm->getValue("x_newapp");
        if (!$this->newapp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->newapp->Visible = false; // Disable update for API request
            } else {
                $this->newapp->setFormValue($val);
            }
        }

        // Check field name 'kdpoli' first before field var 'x_kdpoli'
        $val = $CurrentForm->hasValue("kdpoli") ? $CurrentForm->getValue("kdpoli") : $CurrentForm->getValue("x_kdpoli");
        if (!$this->kdpoli->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kdpoli->Visible = false; // Disable update for API request
            } else {
                $this->kdpoli->setFormValue($val);
            }
        }

        // Check field name 'tanggal_pesan' first before field var 'x_tanggal_pesan'
        $val = $CurrentForm->hasValue("tanggal_pesan") ? $CurrentForm->getValue("tanggal_pesan") : $CurrentForm->getValue("x_tanggal_pesan");
        if (!$this->tanggal_pesan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_pesan->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_pesan->setFormValue($val);
            }
            $this->tanggal_pesan->CurrentValue = UnFormatDateTime($this->tanggal_pesan->CurrentValue, 0);
        }

        // Check field name 'tujuan' first before field var 'x_tujuan'
        $val = $CurrentForm->hasValue("tujuan") ? $CurrentForm->getValue("tujuan") : $CurrentForm->getValue("x_tujuan");
        if (!$this->tujuan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tujuan->Visible = false; // Disable update for API request
            } else {
                $this->tujuan->setFormValue($val);
            }
        }

        // Check field name 'disabilitas' first before field var 'x_disabilitas'
        $val = $CurrentForm->hasValue("disabilitas") ? $CurrentForm->getValue("disabilitas") : $CurrentForm->getValue("x_disabilitas");
        if (!$this->disabilitas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->disabilitas->Visible = false; // Disable update for API request
            } else {
                $this->disabilitas->setFormValue($val);
            }
        }

        // Check field name 'nama' first before field var 'x_nama'
        $val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
        if (!$this->nama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama->Visible = false; // Disable update for API request
            } else {
                $this->nama->setFormValue($val);
            }
        }

        // Check field name 'no_bpjs' first before field var 'x_no_bpjs'
        $val = $CurrentForm->hasValue("no_bpjs") ? $CurrentForm->getValue("no_bpjs") : $CurrentForm->getValue("x_no_bpjs");
        if (!$this->no_bpjs->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_bpjs->Visible = false; // Disable update for API request
            } else {
                $this->no_bpjs->setFormValue($val);
            }
        }

        // Check field name 'nomr' first before field var 'x_nomr'
        $val = $CurrentForm->hasValue("nomr") ? $CurrentForm->getValue("nomr") : $CurrentForm->getValue("x_nomr");
        if (!$this->nomr->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nomr->Visible = false; // Disable update for API request
            } else {
                $this->nomr->setFormValue($val);
            }
        }

        // Check field name 'tempat_lahir' first before field var 'x_tempat_lahir'
        $val = $CurrentForm->hasValue("tempat_lahir") ? $CurrentForm->getValue("tempat_lahir") : $CurrentForm->getValue("x_tempat_lahir");
        if (!$this->tempat_lahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tempat_lahir->Visible = false; // Disable update for API request
            } else {
                $this->tempat_lahir->setFormValue($val);
            }
        }

        // Check field name 'tanggal_lahir' first before field var 'x_tanggal_lahir'
        $val = $CurrentForm->hasValue("tanggal_lahir") ? $CurrentForm->getValue("tanggal_lahir") : $CurrentForm->getValue("x_tanggal_lahir");
        if (!$this->tanggal_lahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_lahir->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_lahir->setFormValue($val);
            }
            $this->tanggal_lahir->CurrentValue = UnFormatDateTime($this->tanggal_lahir->CurrentValue, 0);
        }

        // Check field name 'jk' first before field var 'x_jk'
        $val = $CurrentForm->hasValue("jk") ? $CurrentForm->getValue("jk") : $CurrentForm->getValue("x_jk");
        if (!$this->jk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jk->Visible = false; // Disable update for API request
            } else {
                $this->jk->setFormValue($val);
            }
        }

        // Check field name 'alamat' first before field var 'x_alamat'
        $val = $CurrentForm->hasValue("alamat") ? $CurrentForm->getValue("alamat") : $CurrentForm->getValue("x_alamat");
        if (!$this->alamat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alamat->Visible = false; // Disable update for API request
            } else {
                $this->alamat->setFormValue($val);
            }
        }

        // Check field name 'agama' first before field var 'x_agama'
        $val = $CurrentForm->hasValue("agama") ? $CurrentForm->getValue("agama") : $CurrentForm->getValue("x_agama");
        if (!$this->agama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->agama->Visible = false; // Disable update for API request
            } else {
                $this->agama->setFormValue($val);
            }
        }

        // Check field name 'pekerjaan' first before field var 'x_pekerjaan'
        $val = $CurrentForm->hasValue("pekerjaan") ? $CurrentForm->getValue("pekerjaan") : $CurrentForm->getValue("x_pekerjaan");
        if (!$this->pekerjaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pekerjaan->Visible = false; // Disable update for API request
            } else {
                $this->pekerjaan->setFormValue($val);
            }
        }

        // Check field name 'no_telp' first before field var 'x_no_telp'
        $val = $CurrentForm->hasValue("no_telp") ? $CurrentForm->getValue("no_telp") : $CurrentForm->getValue("x_no_telp");
        if (!$this->no_telp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->no_telp->Visible = false; // Disable update for API request
            } else {
                $this->no_telp->setFormValue($val);
            }
        }

        // Check field name 'nama_ibu' first before field var 'x_nama_ibu'
        $val = $CurrentForm->hasValue("nama_ibu") ? $CurrentForm->getValue("nama_ibu") : $CurrentForm->getValue("x_nama_ibu");
        if (!$this->nama_ibu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_ibu->Visible = false; // Disable update for API request
            } else {
                $this->nama_ibu->setFormValue($val);
            }
        }

        // Check field name 'nama_ayah' first before field var 'x_nama_ayah'
        $val = $CurrentForm->hasValue("nama_ayah") ? $CurrentForm->getValue("nama_ayah") : $CurrentForm->getValue("x_nama_ayah");
        if (!$this->nama_ayah->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_ayah->Visible = false; // Disable update for API request
            } else {
                $this->nama_ayah->setFormValue($val);
            }
        }

        // Check field name 'nama_pasangan' first before field var 'x_nama_pasangan'
        $val = $CurrentForm->hasValue("nama_pasangan") ? $CurrentForm->getValue("nama_pasangan") : $CurrentForm->getValue("x_nama_pasangan");
        if (!$this->nama_pasangan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_pasangan->Visible = false; // Disable update for API request
            } else {
                $this->nama_pasangan->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->Id->CurrentValue = $this->Id->FormValue;
        $this->no_urut->CurrentValue = $this->no_urut->FormValue;
        $this->tanggal_daftar->CurrentValue = $this->tanggal_daftar->FormValue;
        $this->tanggal_daftar->CurrentValue = UnFormatDateTime($this->tanggal_daftar->CurrentValue, 0);
        $this->tanggal_panggil->CurrentValue = $this->tanggal_panggil->FormValue;
        $this->tanggal_panggil->CurrentValue = UnFormatDateTime($this->tanggal_panggil->CurrentValue, 0);
        $this->loket->CurrentValue = $this->loket->FormValue;
        $this->status_panggil->CurrentValue = $this->status_panggil->FormValue;
        $this->user->CurrentValue = $this->user->FormValue;
        $this->newapp->CurrentValue = $this->newapp->FormValue;
        $this->kdpoli->CurrentValue = $this->kdpoli->FormValue;
        $this->tanggal_pesan->CurrentValue = $this->tanggal_pesan->FormValue;
        $this->tanggal_pesan->CurrentValue = UnFormatDateTime($this->tanggal_pesan->CurrentValue, 0);
        $this->tujuan->CurrentValue = $this->tujuan->FormValue;
        $this->disabilitas->CurrentValue = $this->disabilitas->FormValue;
        $this->nama->CurrentValue = $this->nama->FormValue;
        $this->no_bpjs->CurrentValue = $this->no_bpjs->FormValue;
        $this->nomr->CurrentValue = $this->nomr->FormValue;
        $this->tempat_lahir->CurrentValue = $this->tempat_lahir->FormValue;
        $this->tanggal_lahir->CurrentValue = $this->tanggal_lahir->FormValue;
        $this->tanggal_lahir->CurrentValue = UnFormatDateTime($this->tanggal_lahir->CurrentValue, 0);
        $this->jk->CurrentValue = $this->jk->FormValue;
        $this->alamat->CurrentValue = $this->alamat->FormValue;
        $this->agama->CurrentValue = $this->agama->FormValue;
        $this->pekerjaan->CurrentValue = $this->pekerjaan->FormValue;
        $this->no_telp->CurrentValue = $this->no_telp->FormValue;
        $this->nama_ibu->CurrentValue = $this->nama_ibu->FormValue;
        $this->nama_ayah->CurrentValue = $this->nama_ayah->FormValue;
        $this->nama_pasangan->CurrentValue = $this->nama_pasangan->FormValue;
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
        $this->Id->setDbValue($row['Id']);
        $this->no_urut->setDbValue($row['no_urut']);
        $this->tanggal_daftar->setDbValue($row['tanggal_daftar']);
        $this->tanggal_panggil->setDbValue($row['tanggal_panggil']);
        $this->loket->setDbValue($row['loket']);
        $this->status_panggil->setDbValue($row['status_panggil']);
        $this->user->setDbValue($row['user']);
        $this->newapp->setDbValue($row['newapp']);
        $this->kdpoli->setDbValue($row['kdpoli']);
        $this->tanggal_pesan->setDbValue($row['tanggal_pesan']);
        $this->tujuan->setDbValue($row['tujuan']);
        $this->disabilitas->setDbValue($row['disabilitas']);
        $this->nama->setDbValue($row['nama']);
        $this->no_bpjs->setDbValue($row['no_bpjs']);
        $this->nomr->setDbValue($row['nomr']);
        $this->tempat_lahir->setDbValue($row['tempat_lahir']);
        $this->tanggal_lahir->setDbValue($row['tanggal_lahir']);
        $this->jk->setDbValue($row['jk']);
        $this->alamat->setDbValue($row['alamat']);
        $this->agama->setDbValue($row['agama']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->no_telp->setDbValue($row['no_telp']);
        $this->nama_ibu->setDbValue($row['nama_ibu']);
        $this->nama_ayah->setDbValue($row['nama_ayah']);
        $this->nama_pasangan->setDbValue($row['nama_pasangan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['Id'] = null;
        $row['no_urut'] = null;
        $row['tanggal_daftar'] = null;
        $row['tanggal_panggil'] = null;
        $row['loket'] = null;
        $row['status_panggil'] = null;
        $row['user'] = null;
        $row['newapp'] = null;
        $row['kdpoli'] = null;
        $row['tanggal_pesan'] = null;
        $row['tujuan'] = null;
        $row['disabilitas'] = null;
        $row['nama'] = null;
        $row['no_bpjs'] = null;
        $row['nomr'] = null;
        $row['tempat_lahir'] = null;
        $row['tanggal_lahir'] = null;
        $row['jk'] = null;
        $row['alamat'] = null;
        $row['agama'] = null;
        $row['pekerjaan'] = null;
        $row['no_telp'] = null;
        $row['nama_ibu'] = null;
        $row['nama_ayah'] = null;
        $row['nama_pasangan'] = null;
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

        // Id

        // no_urut

        // tanggal_daftar

        // tanggal_panggil

        // loket

        // status_panggil

        // user

        // newapp

        // kdpoli

        // tanggal_pesan

        // tujuan

        // disabilitas

        // nama

        // no_bpjs

        // nomr

        // tempat_lahir

        // tanggal_lahir

        // jk

        // alamat

        // agama

        // pekerjaan

        // no_telp

        // nama_ibu

        // nama_ayah

        // nama_pasangan
        if ($this->RowType == ROWTYPE_VIEW) {
            // Id
            $this->Id->ViewValue = $this->Id->CurrentValue;
            $this->Id->ViewCustomAttributes = "";

            // no_urut
            $this->no_urut->ViewValue = $this->no_urut->CurrentValue;
            $this->no_urut->ViewValue = FormatNumber($this->no_urut->ViewValue, 0, -2, -2, -2);
            $this->no_urut->ViewCustomAttributes = "";

            // tanggal_daftar
            $this->tanggal_daftar->ViewValue = $this->tanggal_daftar->CurrentValue;
            $this->tanggal_daftar->ViewValue = FormatDateTime($this->tanggal_daftar->ViewValue, 0);
            $this->tanggal_daftar->ViewCustomAttributes = "";

            // tanggal_panggil
            $this->tanggal_panggil->ViewValue = $this->tanggal_panggil->CurrentValue;
            $this->tanggal_panggil->ViewValue = FormatDateTime($this->tanggal_panggil->ViewValue, 0);
            $this->tanggal_panggil->ViewCustomAttributes = "";

            // loket
            $this->loket->ViewValue = $this->loket->CurrentValue;
            $this->loket->ViewCustomAttributes = "";

            // status_panggil
            $this->status_panggil->ViewValue = $this->status_panggil->CurrentValue;
            $this->status_panggil->ViewValue = FormatNumber($this->status_panggil->ViewValue, 0, -2, -2, -2);
            $this->status_panggil->ViewCustomAttributes = "";

            // user
            $this->user->ViewValue = $this->user->CurrentValue;
            $this->user->ViewValue = FormatNumber($this->user->ViewValue, 0, -2, -2, -2);
            $this->user->ViewCustomAttributes = "";

            // newapp
            $this->newapp->ViewValue = $this->newapp->CurrentValue;
            $this->newapp->ViewValue = FormatNumber($this->newapp->ViewValue, 0, -2, -2, -2);
            $this->newapp->ViewCustomAttributes = "";

            // kdpoli
            $this->kdpoli->ViewValue = $this->kdpoli->CurrentValue;
            $this->kdpoli->ViewCustomAttributes = "";

            // tanggal_pesan
            $this->tanggal_pesan->ViewValue = $this->tanggal_pesan->CurrentValue;
            $this->tanggal_pesan->ViewValue = FormatDateTime($this->tanggal_pesan->ViewValue, 0);
            $this->tanggal_pesan->ViewCustomAttributes = "";

            // tujuan
            $this->tujuan->ViewValue = $this->tujuan->CurrentValue;
            $this->tujuan->ViewCustomAttributes = "";

            // disabilitas
            $this->disabilitas->ViewValue = $this->disabilitas->CurrentValue;
            $this->disabilitas->ViewValue = FormatNumber($this->disabilitas->ViewValue, 0, -2, -2, -2);
            $this->disabilitas->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

            // no_bpjs
            $this->no_bpjs->ViewValue = $this->no_bpjs->CurrentValue;
            $this->no_bpjs->ViewValue = FormatNumber($this->no_bpjs->ViewValue, 0, -2, -2, -2);
            $this->no_bpjs->ViewCustomAttributes = "";

            // nomr
            $this->nomr->ViewValue = $this->nomr->CurrentValue;
            $this->nomr->ViewValue = FormatNumber($this->nomr->ViewValue, 0, -2, -2, -2);
            $this->nomr->ViewCustomAttributes = "";

            // tempat_lahir
            $this->tempat_lahir->ViewValue = $this->tempat_lahir->CurrentValue;
            $this->tempat_lahir->ViewCustomAttributes = "";

            // tanggal_lahir
            $this->tanggal_lahir->ViewValue = $this->tanggal_lahir->CurrentValue;
            $this->tanggal_lahir->ViewValue = FormatDateTime($this->tanggal_lahir->ViewValue, 0);
            $this->tanggal_lahir->ViewCustomAttributes = "";

            // jk
            $this->jk->ViewValue = $this->jk->CurrentValue;
            $this->jk->ViewValue = FormatNumber($this->jk->ViewValue, 0, -2, -2, -2);
            $this->jk->ViewCustomAttributes = "";

            // alamat
            $this->alamat->ViewValue = $this->alamat->CurrentValue;
            $this->alamat->ViewCustomAttributes = "";

            // agama
            $this->agama->ViewValue = $this->agama->CurrentValue;
            $this->agama->ViewValue = FormatNumber($this->agama->ViewValue, 0, -2, -2, -2);
            $this->agama->ViewCustomAttributes = "";

            // pekerjaan
            $this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
            $this->pekerjaan->ViewValue = FormatNumber($this->pekerjaan->ViewValue, 0, -2, -2, -2);
            $this->pekerjaan->ViewCustomAttributes = "";

            // no_telp
            $this->no_telp->ViewValue = $this->no_telp->CurrentValue;
            $this->no_telp->ViewValue = FormatNumber($this->no_telp->ViewValue, 0, -2, -2, -2);
            $this->no_telp->ViewCustomAttributes = "";

            // nama_ibu
            $this->nama_ibu->ViewValue = $this->nama_ibu->CurrentValue;
            $this->nama_ibu->ViewCustomAttributes = "";

            // nama_ayah
            $this->nama_ayah->ViewValue = $this->nama_ayah->CurrentValue;
            $this->nama_ayah->ViewCustomAttributes = "";

            // nama_pasangan
            $this->nama_pasangan->ViewValue = $this->nama_pasangan->CurrentValue;
            $this->nama_pasangan->ViewCustomAttributes = "";

            // Id
            $this->Id->LinkCustomAttributes = "";
            $this->Id->HrefValue = "";
            $this->Id->TooltipValue = "";

            // no_urut
            $this->no_urut->LinkCustomAttributes = "";
            $this->no_urut->HrefValue = "";
            $this->no_urut->TooltipValue = "";

            // tanggal_daftar
            $this->tanggal_daftar->LinkCustomAttributes = "";
            $this->tanggal_daftar->HrefValue = "";
            $this->tanggal_daftar->TooltipValue = "";

            // tanggal_panggil
            $this->tanggal_panggil->LinkCustomAttributes = "";
            $this->tanggal_panggil->HrefValue = "";
            $this->tanggal_panggil->TooltipValue = "";

            // loket
            $this->loket->LinkCustomAttributes = "";
            $this->loket->HrefValue = "";
            $this->loket->TooltipValue = "";

            // status_panggil
            $this->status_panggil->LinkCustomAttributes = "";
            $this->status_panggil->HrefValue = "";
            $this->status_panggil->TooltipValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";
            $this->user->TooltipValue = "";

            // newapp
            $this->newapp->LinkCustomAttributes = "";
            $this->newapp->HrefValue = "";
            $this->newapp->TooltipValue = "";

            // kdpoli
            $this->kdpoli->LinkCustomAttributes = "";
            $this->kdpoli->HrefValue = "";
            $this->kdpoli->TooltipValue = "";

            // tanggal_pesan
            $this->tanggal_pesan->LinkCustomAttributes = "";
            $this->tanggal_pesan->HrefValue = "";
            $this->tanggal_pesan->TooltipValue = "";

            // tujuan
            $this->tujuan->LinkCustomAttributes = "";
            $this->tujuan->HrefValue = "";
            $this->tujuan->TooltipValue = "";

            // disabilitas
            $this->disabilitas->LinkCustomAttributes = "";
            $this->disabilitas->HrefValue = "";
            $this->disabilitas->TooltipValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";
            $this->nama->TooltipValue = "";

            // no_bpjs
            $this->no_bpjs->LinkCustomAttributes = "";
            $this->no_bpjs->HrefValue = "";
            $this->no_bpjs->TooltipValue = "";

            // nomr
            $this->nomr->LinkCustomAttributes = "";
            $this->nomr->HrefValue = "";
            $this->nomr->TooltipValue = "";

            // tempat_lahir
            $this->tempat_lahir->LinkCustomAttributes = "";
            $this->tempat_lahir->HrefValue = "";
            $this->tempat_lahir->TooltipValue = "";

            // tanggal_lahir
            $this->tanggal_lahir->LinkCustomAttributes = "";
            $this->tanggal_lahir->HrefValue = "";
            $this->tanggal_lahir->TooltipValue = "";

            // jk
            $this->jk->LinkCustomAttributes = "";
            $this->jk->HrefValue = "";
            $this->jk->TooltipValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";
            $this->agama->TooltipValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";
            $this->pekerjaan->TooltipValue = "";

            // no_telp
            $this->no_telp->LinkCustomAttributes = "";
            $this->no_telp->HrefValue = "";
            $this->no_telp->TooltipValue = "";

            // nama_ibu
            $this->nama_ibu->LinkCustomAttributes = "";
            $this->nama_ibu->HrefValue = "";
            $this->nama_ibu->TooltipValue = "";

            // nama_ayah
            $this->nama_ayah->LinkCustomAttributes = "";
            $this->nama_ayah->HrefValue = "";
            $this->nama_ayah->TooltipValue = "";

            // nama_pasangan
            $this->nama_pasangan->LinkCustomAttributes = "";
            $this->nama_pasangan->HrefValue = "";
            $this->nama_pasangan->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // Id
            $this->Id->EditAttrs["class"] = "form-control";
            $this->Id->EditCustomAttributes = "";
            $this->Id->EditValue = $this->Id->CurrentValue;
            $this->Id->ViewCustomAttributes = "";

            // no_urut
            $this->no_urut->EditAttrs["class"] = "form-control";
            $this->no_urut->EditCustomAttributes = "";
            $this->no_urut->EditValue = HtmlEncode($this->no_urut->CurrentValue);
            $this->no_urut->PlaceHolder = RemoveHtml($this->no_urut->caption());

            // tanggal_daftar
            $this->tanggal_daftar->EditAttrs["class"] = "form-control";
            $this->tanggal_daftar->EditCustomAttributes = "";
            $this->tanggal_daftar->EditValue = HtmlEncode(FormatDateTime($this->tanggal_daftar->CurrentValue, 8));
            $this->tanggal_daftar->PlaceHolder = RemoveHtml($this->tanggal_daftar->caption());

            // tanggal_panggil
            $this->tanggal_panggil->EditAttrs["class"] = "form-control";
            $this->tanggal_panggil->EditCustomAttributes = "";
            $this->tanggal_panggil->EditValue = HtmlEncode(FormatDateTime($this->tanggal_panggil->CurrentValue, 8));
            $this->tanggal_panggil->PlaceHolder = RemoveHtml($this->tanggal_panggil->caption());

            // loket
            $this->loket->EditAttrs["class"] = "form-control";
            $this->loket->EditCustomAttributes = "";
            if (!$this->loket->Raw) {
                $this->loket->CurrentValue = HtmlDecode($this->loket->CurrentValue);
            }
            $this->loket->EditValue = HtmlEncode($this->loket->CurrentValue);
            $this->loket->PlaceHolder = RemoveHtml($this->loket->caption());

            // status_panggil
            $this->status_panggil->EditAttrs["class"] = "form-control";
            $this->status_panggil->EditCustomAttributes = "";
            $this->status_panggil->EditValue = HtmlEncode($this->status_panggil->CurrentValue);
            $this->status_panggil->PlaceHolder = RemoveHtml($this->status_panggil->caption());

            // user
            $this->user->EditAttrs["class"] = "form-control";
            $this->user->EditCustomAttributes = "";
            $this->user->EditValue = HtmlEncode($this->user->CurrentValue);
            $this->user->PlaceHolder = RemoveHtml($this->user->caption());

            // newapp
            $this->newapp->EditAttrs["class"] = "form-control";
            $this->newapp->EditCustomAttributes = "";
            $this->newapp->EditValue = HtmlEncode($this->newapp->CurrentValue);
            $this->newapp->PlaceHolder = RemoveHtml($this->newapp->caption());

            // kdpoli
            $this->kdpoli->EditAttrs["class"] = "form-control";
            $this->kdpoli->EditCustomAttributes = "";
            if (!$this->kdpoli->Raw) {
                $this->kdpoli->CurrentValue = HtmlDecode($this->kdpoli->CurrentValue);
            }
            $this->kdpoli->EditValue = HtmlEncode($this->kdpoli->CurrentValue);
            $this->kdpoli->PlaceHolder = RemoveHtml($this->kdpoli->caption());

            // tanggal_pesan
            $this->tanggal_pesan->EditAttrs["class"] = "form-control";
            $this->tanggal_pesan->EditCustomAttributes = "";
            $this->tanggal_pesan->EditValue = HtmlEncode(FormatDateTime($this->tanggal_pesan->CurrentValue, 8));
            $this->tanggal_pesan->PlaceHolder = RemoveHtml($this->tanggal_pesan->caption());

            // tujuan
            $this->tujuan->EditAttrs["class"] = "form-control";
            $this->tujuan->EditCustomAttributes = "";
            if (!$this->tujuan->Raw) {
                $this->tujuan->CurrentValue = HtmlDecode($this->tujuan->CurrentValue);
            }
            $this->tujuan->EditValue = HtmlEncode($this->tujuan->CurrentValue);
            $this->tujuan->PlaceHolder = RemoveHtml($this->tujuan->caption());

            // disabilitas
            $this->disabilitas->EditAttrs["class"] = "form-control";
            $this->disabilitas->EditCustomAttributes = "";
            $this->disabilitas->EditValue = HtmlEncode($this->disabilitas->CurrentValue);
            $this->disabilitas->PlaceHolder = RemoveHtml($this->disabilitas->caption());

            // nama
            $this->nama->EditAttrs["class"] = "form-control";
            $this->nama->EditCustomAttributes = "";
            if (!$this->nama->Raw) {
                $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
            }
            $this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
            $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

            // no_bpjs
            $this->no_bpjs->EditAttrs["class"] = "form-control";
            $this->no_bpjs->EditCustomAttributes = "";
            $this->no_bpjs->EditValue = HtmlEncode($this->no_bpjs->CurrentValue);
            $this->no_bpjs->PlaceHolder = RemoveHtml($this->no_bpjs->caption());

            // nomr
            $this->nomr->EditAttrs["class"] = "form-control";
            $this->nomr->EditCustomAttributes = "";
            $this->nomr->EditValue = HtmlEncode($this->nomr->CurrentValue);
            $this->nomr->PlaceHolder = RemoveHtml($this->nomr->caption());

            // tempat_lahir
            $this->tempat_lahir->EditAttrs["class"] = "form-control";
            $this->tempat_lahir->EditCustomAttributes = "";
            if (!$this->tempat_lahir->Raw) {
                $this->tempat_lahir->CurrentValue = HtmlDecode($this->tempat_lahir->CurrentValue);
            }
            $this->tempat_lahir->EditValue = HtmlEncode($this->tempat_lahir->CurrentValue);
            $this->tempat_lahir->PlaceHolder = RemoveHtml($this->tempat_lahir->caption());

            // tanggal_lahir
            $this->tanggal_lahir->EditAttrs["class"] = "form-control";
            $this->tanggal_lahir->EditCustomAttributes = "";
            $this->tanggal_lahir->EditValue = HtmlEncode(FormatDateTime($this->tanggal_lahir->CurrentValue, 8));
            $this->tanggal_lahir->PlaceHolder = RemoveHtml($this->tanggal_lahir->caption());

            // jk
            $this->jk->EditAttrs["class"] = "form-control";
            $this->jk->EditCustomAttributes = "";
            $this->jk->EditValue = HtmlEncode($this->jk->CurrentValue);
            $this->jk->PlaceHolder = RemoveHtml($this->jk->caption());

            // alamat
            $this->alamat->EditAttrs["class"] = "form-control";
            $this->alamat->EditCustomAttributes = "";
            if (!$this->alamat->Raw) {
                $this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
            }
            $this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
            $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

            // agama
            $this->agama->EditAttrs["class"] = "form-control";
            $this->agama->EditCustomAttributes = "";
            $this->agama->EditValue = HtmlEncode($this->agama->CurrentValue);
            $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

            // pekerjaan
            $this->pekerjaan->EditAttrs["class"] = "form-control";
            $this->pekerjaan->EditCustomAttributes = "";
            $this->pekerjaan->EditValue = HtmlEncode($this->pekerjaan->CurrentValue);
            $this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

            // no_telp
            $this->no_telp->EditAttrs["class"] = "form-control";
            $this->no_telp->EditCustomAttributes = "";
            $this->no_telp->EditValue = HtmlEncode($this->no_telp->CurrentValue);
            $this->no_telp->PlaceHolder = RemoveHtml($this->no_telp->caption());

            // nama_ibu
            $this->nama_ibu->EditAttrs["class"] = "form-control";
            $this->nama_ibu->EditCustomAttributes = "";
            if (!$this->nama_ibu->Raw) {
                $this->nama_ibu->CurrentValue = HtmlDecode($this->nama_ibu->CurrentValue);
            }
            $this->nama_ibu->EditValue = HtmlEncode($this->nama_ibu->CurrentValue);
            $this->nama_ibu->PlaceHolder = RemoveHtml($this->nama_ibu->caption());

            // nama_ayah
            $this->nama_ayah->EditAttrs["class"] = "form-control";
            $this->nama_ayah->EditCustomAttributes = "";
            if (!$this->nama_ayah->Raw) {
                $this->nama_ayah->CurrentValue = HtmlDecode($this->nama_ayah->CurrentValue);
            }
            $this->nama_ayah->EditValue = HtmlEncode($this->nama_ayah->CurrentValue);
            $this->nama_ayah->PlaceHolder = RemoveHtml($this->nama_ayah->caption());

            // nama_pasangan
            $this->nama_pasangan->EditAttrs["class"] = "form-control";
            $this->nama_pasangan->EditCustomAttributes = "";
            if (!$this->nama_pasangan->Raw) {
                $this->nama_pasangan->CurrentValue = HtmlDecode($this->nama_pasangan->CurrentValue);
            }
            $this->nama_pasangan->EditValue = HtmlEncode($this->nama_pasangan->CurrentValue);
            $this->nama_pasangan->PlaceHolder = RemoveHtml($this->nama_pasangan->caption());

            // Edit refer script

            // Id
            $this->Id->LinkCustomAttributes = "";
            $this->Id->HrefValue = "";

            // no_urut
            $this->no_urut->LinkCustomAttributes = "";
            $this->no_urut->HrefValue = "";

            // tanggal_daftar
            $this->tanggal_daftar->LinkCustomAttributes = "";
            $this->tanggal_daftar->HrefValue = "";

            // tanggal_panggil
            $this->tanggal_panggil->LinkCustomAttributes = "";
            $this->tanggal_panggil->HrefValue = "";

            // loket
            $this->loket->LinkCustomAttributes = "";
            $this->loket->HrefValue = "";

            // status_panggil
            $this->status_panggil->LinkCustomAttributes = "";
            $this->status_panggil->HrefValue = "";

            // user
            $this->user->LinkCustomAttributes = "";
            $this->user->HrefValue = "";

            // newapp
            $this->newapp->LinkCustomAttributes = "";
            $this->newapp->HrefValue = "";

            // kdpoli
            $this->kdpoli->LinkCustomAttributes = "";
            $this->kdpoli->HrefValue = "";

            // tanggal_pesan
            $this->tanggal_pesan->LinkCustomAttributes = "";
            $this->tanggal_pesan->HrefValue = "";

            // tujuan
            $this->tujuan->LinkCustomAttributes = "";
            $this->tujuan->HrefValue = "";

            // disabilitas
            $this->disabilitas->LinkCustomAttributes = "";
            $this->disabilitas->HrefValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // no_bpjs
            $this->no_bpjs->LinkCustomAttributes = "";
            $this->no_bpjs->HrefValue = "";

            // nomr
            $this->nomr->LinkCustomAttributes = "";
            $this->nomr->HrefValue = "";

            // tempat_lahir
            $this->tempat_lahir->LinkCustomAttributes = "";
            $this->tempat_lahir->HrefValue = "";

            // tanggal_lahir
            $this->tanggal_lahir->LinkCustomAttributes = "";
            $this->tanggal_lahir->HrefValue = "";

            // jk
            $this->jk->LinkCustomAttributes = "";
            $this->jk->HrefValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";

            // no_telp
            $this->no_telp->LinkCustomAttributes = "";
            $this->no_telp->HrefValue = "";

            // nama_ibu
            $this->nama_ibu->LinkCustomAttributes = "";
            $this->nama_ibu->HrefValue = "";

            // nama_ayah
            $this->nama_ayah->LinkCustomAttributes = "";
            $this->nama_ayah->HrefValue = "";

            // nama_pasangan
            $this->nama_pasangan->LinkCustomAttributes = "";
            $this->nama_pasangan->HrefValue = "";
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
        if ($this->Id->Required) {
            if (!$this->Id->IsDetailKey && EmptyValue($this->Id->FormValue)) {
                $this->Id->addErrorMessage(str_replace("%s", $this->Id->caption(), $this->Id->RequiredErrorMessage));
            }
        }
        if ($this->no_urut->Required) {
            if (!$this->no_urut->IsDetailKey && EmptyValue($this->no_urut->FormValue)) {
                $this->no_urut->addErrorMessage(str_replace("%s", $this->no_urut->caption(), $this->no_urut->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->no_urut->FormValue)) {
            $this->no_urut->addErrorMessage($this->no_urut->getErrorMessage(false));
        }
        if ($this->tanggal_daftar->Required) {
            if (!$this->tanggal_daftar->IsDetailKey && EmptyValue($this->tanggal_daftar->FormValue)) {
                $this->tanggal_daftar->addErrorMessage(str_replace("%s", $this->tanggal_daftar->caption(), $this->tanggal_daftar->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggal_daftar->FormValue)) {
            $this->tanggal_daftar->addErrorMessage($this->tanggal_daftar->getErrorMessage(false));
        }
        if ($this->tanggal_panggil->Required) {
            if (!$this->tanggal_panggil->IsDetailKey && EmptyValue($this->tanggal_panggil->FormValue)) {
                $this->tanggal_panggil->addErrorMessage(str_replace("%s", $this->tanggal_panggil->caption(), $this->tanggal_panggil->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggal_panggil->FormValue)) {
            $this->tanggal_panggil->addErrorMessage($this->tanggal_panggil->getErrorMessage(false));
        }
        if ($this->loket->Required) {
            if (!$this->loket->IsDetailKey && EmptyValue($this->loket->FormValue)) {
                $this->loket->addErrorMessage(str_replace("%s", $this->loket->caption(), $this->loket->RequiredErrorMessage));
            }
        }
        if ($this->status_panggil->Required) {
            if (!$this->status_panggil->IsDetailKey && EmptyValue($this->status_panggil->FormValue)) {
                $this->status_panggil->addErrorMessage(str_replace("%s", $this->status_panggil->caption(), $this->status_panggil->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->status_panggil->FormValue)) {
            $this->status_panggil->addErrorMessage($this->status_panggil->getErrorMessage(false));
        }
        if ($this->user->Required) {
            if (!$this->user->IsDetailKey && EmptyValue($this->user->FormValue)) {
                $this->user->addErrorMessage(str_replace("%s", $this->user->caption(), $this->user->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->user->FormValue)) {
            $this->user->addErrorMessage($this->user->getErrorMessage(false));
        }
        if ($this->newapp->Required) {
            if (!$this->newapp->IsDetailKey && EmptyValue($this->newapp->FormValue)) {
                $this->newapp->addErrorMessage(str_replace("%s", $this->newapp->caption(), $this->newapp->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->newapp->FormValue)) {
            $this->newapp->addErrorMessage($this->newapp->getErrorMessage(false));
        }
        if ($this->kdpoli->Required) {
            if (!$this->kdpoli->IsDetailKey && EmptyValue($this->kdpoli->FormValue)) {
                $this->kdpoli->addErrorMessage(str_replace("%s", $this->kdpoli->caption(), $this->kdpoli->RequiredErrorMessage));
            }
        }
        if ($this->tanggal_pesan->Required) {
            if (!$this->tanggal_pesan->IsDetailKey && EmptyValue($this->tanggal_pesan->FormValue)) {
                $this->tanggal_pesan->addErrorMessage(str_replace("%s", $this->tanggal_pesan->caption(), $this->tanggal_pesan->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggal_pesan->FormValue)) {
            $this->tanggal_pesan->addErrorMessage($this->tanggal_pesan->getErrorMessage(false));
        }
        if ($this->tujuan->Required) {
            if (!$this->tujuan->IsDetailKey && EmptyValue($this->tujuan->FormValue)) {
                $this->tujuan->addErrorMessage(str_replace("%s", $this->tujuan->caption(), $this->tujuan->RequiredErrorMessage));
            }
        }
        if ($this->disabilitas->Required) {
            if (!$this->disabilitas->IsDetailKey && EmptyValue($this->disabilitas->FormValue)) {
                $this->disabilitas->addErrorMessage(str_replace("%s", $this->disabilitas->caption(), $this->disabilitas->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->disabilitas->FormValue)) {
            $this->disabilitas->addErrorMessage($this->disabilitas->getErrorMessage(false));
        }
        if ($this->nama->Required) {
            if (!$this->nama->IsDetailKey && EmptyValue($this->nama->FormValue)) {
                $this->nama->addErrorMessage(str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
            }
        }
        if ($this->no_bpjs->Required) {
            if (!$this->no_bpjs->IsDetailKey && EmptyValue($this->no_bpjs->FormValue)) {
                $this->no_bpjs->addErrorMessage(str_replace("%s", $this->no_bpjs->caption(), $this->no_bpjs->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->no_bpjs->FormValue)) {
            $this->no_bpjs->addErrorMessage($this->no_bpjs->getErrorMessage(false));
        }
        if ($this->nomr->Required) {
            if (!$this->nomr->IsDetailKey && EmptyValue($this->nomr->FormValue)) {
                $this->nomr->addErrorMessage(str_replace("%s", $this->nomr->caption(), $this->nomr->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->nomr->FormValue)) {
            $this->nomr->addErrorMessage($this->nomr->getErrorMessage(false));
        }
        if ($this->tempat_lahir->Required) {
            if (!$this->tempat_lahir->IsDetailKey && EmptyValue($this->tempat_lahir->FormValue)) {
                $this->tempat_lahir->addErrorMessage(str_replace("%s", $this->tempat_lahir->caption(), $this->tempat_lahir->RequiredErrorMessage));
            }
        }
        if ($this->tanggal_lahir->Required) {
            if (!$this->tanggal_lahir->IsDetailKey && EmptyValue($this->tanggal_lahir->FormValue)) {
                $this->tanggal_lahir->addErrorMessage(str_replace("%s", $this->tanggal_lahir->caption(), $this->tanggal_lahir->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggal_lahir->FormValue)) {
            $this->tanggal_lahir->addErrorMessage($this->tanggal_lahir->getErrorMessage(false));
        }
        if ($this->jk->Required) {
            if (!$this->jk->IsDetailKey && EmptyValue($this->jk->FormValue)) {
                $this->jk->addErrorMessage(str_replace("%s", $this->jk->caption(), $this->jk->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jk->FormValue)) {
            $this->jk->addErrorMessage($this->jk->getErrorMessage(false));
        }
        if ($this->alamat->Required) {
            if (!$this->alamat->IsDetailKey && EmptyValue($this->alamat->FormValue)) {
                $this->alamat->addErrorMessage(str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
            }
        }
        if ($this->agama->Required) {
            if (!$this->agama->IsDetailKey && EmptyValue($this->agama->FormValue)) {
                $this->agama->addErrorMessage(str_replace("%s", $this->agama->caption(), $this->agama->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->agama->FormValue)) {
            $this->agama->addErrorMessage($this->agama->getErrorMessage(false));
        }
        if ($this->pekerjaan->Required) {
            if (!$this->pekerjaan->IsDetailKey && EmptyValue($this->pekerjaan->FormValue)) {
                $this->pekerjaan->addErrorMessage(str_replace("%s", $this->pekerjaan->caption(), $this->pekerjaan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pekerjaan->FormValue)) {
            $this->pekerjaan->addErrorMessage($this->pekerjaan->getErrorMessage(false));
        }
        if ($this->no_telp->Required) {
            if (!$this->no_telp->IsDetailKey && EmptyValue($this->no_telp->FormValue)) {
                $this->no_telp->addErrorMessage(str_replace("%s", $this->no_telp->caption(), $this->no_telp->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->no_telp->FormValue)) {
            $this->no_telp->addErrorMessage($this->no_telp->getErrorMessage(false));
        }
        if ($this->nama_ibu->Required) {
            if (!$this->nama_ibu->IsDetailKey && EmptyValue($this->nama_ibu->FormValue)) {
                $this->nama_ibu->addErrorMessage(str_replace("%s", $this->nama_ibu->caption(), $this->nama_ibu->RequiredErrorMessage));
            }
        }
        if ($this->nama_ayah->Required) {
            if (!$this->nama_ayah->IsDetailKey && EmptyValue($this->nama_ayah->FormValue)) {
                $this->nama_ayah->addErrorMessage(str_replace("%s", $this->nama_ayah->caption(), $this->nama_ayah->RequiredErrorMessage));
            }
        }
        if ($this->nama_pasangan->Required) {
            if (!$this->nama_pasangan->IsDetailKey && EmptyValue($this->nama_pasangan->FormValue)) {
                $this->nama_pasangan->addErrorMessage(str_replace("%s", $this->nama_pasangan->caption(), $this->nama_pasangan->RequiredErrorMessage));
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

            // no_urut
            $this->no_urut->setDbValueDef($rsnew, $this->no_urut->CurrentValue, null, $this->no_urut->ReadOnly);

            // tanggal_daftar
            $this->tanggal_daftar->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_daftar->CurrentValue, 0), null, $this->tanggal_daftar->ReadOnly);

            // tanggal_panggil
            $this->tanggal_panggil->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_panggil->CurrentValue, 0), null, $this->tanggal_panggil->ReadOnly);

            // loket
            $this->loket->setDbValueDef($rsnew, $this->loket->CurrentValue, null, $this->loket->ReadOnly);

            // status_panggil
            $this->status_panggil->setDbValueDef($rsnew, $this->status_panggil->CurrentValue, null, $this->status_panggil->ReadOnly);

            // user
            $this->user->setDbValueDef($rsnew, $this->user->CurrentValue, null, $this->user->ReadOnly);

            // newapp
            $this->newapp->setDbValueDef($rsnew, $this->newapp->CurrentValue, null, $this->newapp->ReadOnly);

            // kdpoli
            $this->kdpoli->setDbValueDef($rsnew, $this->kdpoli->CurrentValue, null, $this->kdpoli->ReadOnly);

            // tanggal_pesan
            $this->tanggal_pesan->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_pesan->CurrentValue, 0), null, $this->tanggal_pesan->ReadOnly);

            // tujuan
            $this->tujuan->setDbValueDef($rsnew, $this->tujuan->CurrentValue, null, $this->tujuan->ReadOnly);

            // disabilitas
            $this->disabilitas->setDbValueDef($rsnew, $this->disabilitas->CurrentValue, null, $this->disabilitas->ReadOnly);

            // nama
            $this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, null, $this->nama->ReadOnly);

            // no_bpjs
            $this->no_bpjs->setDbValueDef($rsnew, $this->no_bpjs->CurrentValue, null, $this->no_bpjs->ReadOnly);

            // nomr
            $this->nomr->setDbValueDef($rsnew, $this->nomr->CurrentValue, null, $this->nomr->ReadOnly);

            // tempat_lahir
            $this->tempat_lahir->setDbValueDef($rsnew, $this->tempat_lahir->CurrentValue, null, $this->tempat_lahir->ReadOnly);

            // tanggal_lahir
            $this->tanggal_lahir->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_lahir->CurrentValue, 0), null, $this->tanggal_lahir->ReadOnly);

            // jk
            $this->jk->setDbValueDef($rsnew, $this->jk->CurrentValue, null, $this->jk->ReadOnly);

            // alamat
            $this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, null, $this->alamat->ReadOnly);

            // agama
            $this->agama->setDbValueDef($rsnew, $this->agama->CurrentValue, null, $this->agama->ReadOnly);

            // pekerjaan
            $this->pekerjaan->setDbValueDef($rsnew, $this->pekerjaan->CurrentValue, null, $this->pekerjaan->ReadOnly);

            // no_telp
            $this->no_telp->setDbValueDef($rsnew, $this->no_telp->CurrentValue, null, $this->no_telp->ReadOnly);

            // nama_ibu
            $this->nama_ibu->setDbValueDef($rsnew, $this->nama_ibu->CurrentValue, null, $this->nama_ibu->ReadOnly);

            // nama_ayah
            $this->nama_ayah->setDbValueDef($rsnew, $this->nama_ayah->CurrentValue, null, $this->nama_ayah->ReadOnly);

            // nama_pasangan
            $this->nama_pasangan->setDbValueDef($rsnew, $this->nama_pasangan->CurrentValue, null, $this->nama_pasangan->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("AntrianPendaftaranList"), "", $this->TableVar, true);
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
