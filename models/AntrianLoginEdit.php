<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class AntrianLoginEdit extends AntrianLogin
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'ANTRIAN_LOGIN';

    // Page object name
    public $PageObjName = "AntrianLoginEdit";

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

        // Table object (ANTRIAN_LOGIN)
        if (!isset($GLOBALS["ANTRIAN_LOGIN"]) || get_class($GLOBALS["ANTRIAN_LOGIN"]) == PROJECT_NAMESPACE . "ANTRIAN_LOGIN") {
            $GLOBALS["ANTRIAN_LOGIN"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'ANTRIAN_LOGIN');
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
                $doc = new $class(Container("ANTRIAN_LOGIN"));
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
                    if ($pageName == "AntrianLoginView") {
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
        $this->ID->setVisibility();
        $this->NOMR->setVisibility();
        $this->NO_BPJS->setVisibility();
        $this->NAMA->setVisibility();
        $this->TEMPAT_LAHIR->setVisibility();
        $this->TANGGAL_LAHIR->setVisibility();
        $this->JENIS_KELAMIN->setVisibility();
        $this->AGAMA->setVisibility();
        $this->PEKERJAAN->setVisibility();
        $this->ALAMAT->setVisibility();
        $this->NO_TELP->setVisibility();
        $this->NO_HP->setVisibility();
        $this->_EMAIL->setVisibility();
        $this->FOTO->setVisibility();
        $this->TANGGAL_REGIS->setVisibility();
        $this->NAMA_IBU->setVisibility();
        $this->NAMA_AYAH->setVisibility();
        $this->NAMA_PASANGAN->setVisibility();
        $this->_PASSWORD->setVisibility();
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
                    $this->terminate("AntrianLoginList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "AntrianLoginList") {
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

        // Check field name 'ID' first before field var 'x_ID'
        $val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
        if (!$this->ID->IsDetailKey) {
            $this->ID->setFormValue($val);
        }

        // Check field name 'NOMR' first before field var 'x_NOMR'
        $val = $CurrentForm->hasValue("NOMR") ? $CurrentForm->getValue("NOMR") : $CurrentForm->getValue("x_NOMR");
        if (!$this->NOMR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NOMR->Visible = false; // Disable update for API request
            } else {
                $this->NOMR->setFormValue($val);
            }
        }

        // Check field name 'NO_BPJS' first before field var 'x_NO_BPJS'
        $val = $CurrentForm->hasValue("NO_BPJS") ? $CurrentForm->getValue("NO_BPJS") : $CurrentForm->getValue("x_NO_BPJS");
        if (!$this->NO_BPJS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_BPJS->Visible = false; // Disable update for API request
            } else {
                $this->NO_BPJS->setFormValue($val);
            }
        }

        // Check field name 'NAMA' first before field var 'x_NAMA'
        $val = $CurrentForm->hasValue("NAMA") ? $CurrentForm->getValue("NAMA") : $CurrentForm->getValue("x_NAMA");
        if (!$this->NAMA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA->Visible = false; // Disable update for API request
            } else {
                $this->NAMA->setFormValue($val);
            }
        }

        // Check field name 'TEMPAT_LAHIR' first before field var 'x_TEMPAT_LAHIR'
        $val = $CurrentForm->hasValue("TEMPAT_LAHIR") ? $CurrentForm->getValue("TEMPAT_LAHIR") : $CurrentForm->getValue("x_TEMPAT_LAHIR");
        if (!$this->TEMPAT_LAHIR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TEMPAT_LAHIR->Visible = false; // Disable update for API request
            } else {
                $this->TEMPAT_LAHIR->setFormValue($val);
            }
        }

        // Check field name 'TANGGAL_LAHIR' first before field var 'x_TANGGAL_LAHIR'
        $val = $CurrentForm->hasValue("TANGGAL_LAHIR") ? $CurrentForm->getValue("TANGGAL_LAHIR") : $CurrentForm->getValue("x_TANGGAL_LAHIR");
        if (!$this->TANGGAL_LAHIR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TANGGAL_LAHIR->Visible = false; // Disable update for API request
            } else {
                $this->TANGGAL_LAHIR->setFormValue($val);
            }
            $this->TANGGAL_LAHIR->CurrentValue = UnFormatDateTime($this->TANGGAL_LAHIR->CurrentValue, 0);
        }

        // Check field name 'JENIS_KELAMIN' first before field var 'x_JENIS_KELAMIN'
        $val = $CurrentForm->hasValue("JENIS_KELAMIN") ? $CurrentForm->getValue("JENIS_KELAMIN") : $CurrentForm->getValue("x_JENIS_KELAMIN");
        if (!$this->JENIS_KELAMIN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->JENIS_KELAMIN->Visible = false; // Disable update for API request
            } else {
                $this->JENIS_KELAMIN->setFormValue($val);
            }
        }

        // Check field name 'AGAMA' first before field var 'x_AGAMA'
        $val = $CurrentForm->hasValue("AGAMA") ? $CurrentForm->getValue("AGAMA") : $CurrentForm->getValue("x_AGAMA");
        if (!$this->AGAMA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->AGAMA->Visible = false; // Disable update for API request
            } else {
                $this->AGAMA->setFormValue($val);
            }
        }

        // Check field name 'PEKERJAAN' first before field var 'x_PEKERJAAN'
        $val = $CurrentForm->hasValue("PEKERJAAN") ? $CurrentForm->getValue("PEKERJAAN") : $CurrentForm->getValue("x_PEKERJAAN");
        if (!$this->PEKERJAAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PEKERJAAN->Visible = false; // Disable update for API request
            } else {
                $this->PEKERJAAN->setFormValue($val);
            }
        }

        // Check field name 'ALAMAT' first before field var 'x_ALAMAT'
        $val = $CurrentForm->hasValue("ALAMAT") ? $CurrentForm->getValue("ALAMAT") : $CurrentForm->getValue("x_ALAMAT");
        if (!$this->ALAMAT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ALAMAT->Visible = false; // Disable update for API request
            } else {
                $this->ALAMAT->setFormValue($val);
            }
        }

        // Check field name 'NO_TELP' first before field var 'x_NO_TELP'
        $val = $CurrentForm->hasValue("NO_TELP") ? $CurrentForm->getValue("NO_TELP") : $CurrentForm->getValue("x_NO_TELP");
        if (!$this->NO_TELP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_TELP->Visible = false; // Disable update for API request
            } else {
                $this->NO_TELP->setFormValue($val);
            }
        }

        // Check field name 'NO_HP' first before field var 'x_NO_HP'
        $val = $CurrentForm->hasValue("NO_HP") ? $CurrentForm->getValue("NO_HP") : $CurrentForm->getValue("x_NO_HP");
        if (!$this->NO_HP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_HP->Visible = false; // Disable update for API request
            } else {
                $this->NO_HP->setFormValue($val);
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

        // Check field name 'FOTO' first before field var 'x_FOTO'
        $val = $CurrentForm->hasValue("FOTO") ? $CurrentForm->getValue("FOTO") : $CurrentForm->getValue("x_FOTO");
        if (!$this->FOTO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FOTO->Visible = false; // Disable update for API request
            } else {
                $this->FOTO->setFormValue($val);
            }
        }

        // Check field name 'TANGGAL_REGIS' first before field var 'x_TANGGAL_REGIS'
        $val = $CurrentForm->hasValue("TANGGAL_REGIS") ? $CurrentForm->getValue("TANGGAL_REGIS") : $CurrentForm->getValue("x_TANGGAL_REGIS");
        if (!$this->TANGGAL_REGIS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TANGGAL_REGIS->Visible = false; // Disable update for API request
            } else {
                $this->TANGGAL_REGIS->setFormValue($val);
            }
            $this->TANGGAL_REGIS->CurrentValue = UnFormatDateTime($this->TANGGAL_REGIS->CurrentValue, 0);
        }

        // Check field name 'NAMA_IBU' first before field var 'x_NAMA_IBU'
        $val = $CurrentForm->hasValue("NAMA_IBU") ? $CurrentForm->getValue("NAMA_IBU") : $CurrentForm->getValue("x_NAMA_IBU");
        if (!$this->NAMA_IBU->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_IBU->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_IBU->setFormValue($val);
            }
        }

        // Check field name 'NAMA_AYAH' first before field var 'x_NAMA_AYAH'
        $val = $CurrentForm->hasValue("NAMA_AYAH") ? $CurrentForm->getValue("NAMA_AYAH") : $CurrentForm->getValue("x_NAMA_AYAH");
        if (!$this->NAMA_AYAH->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_AYAH->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_AYAH->setFormValue($val);
            }
        }

        // Check field name 'NAMA_PASANGAN' first before field var 'x_NAMA_PASANGAN'
        $val = $CurrentForm->hasValue("NAMA_PASANGAN") ? $CurrentForm->getValue("NAMA_PASANGAN") : $CurrentForm->getValue("x_NAMA_PASANGAN");
        if (!$this->NAMA_PASANGAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_PASANGAN->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_PASANGAN->setFormValue($val);
            }
        }

        // Check field name 'PASSWORD' first before field var 'x__PASSWORD'
        $val = $CurrentForm->hasValue("PASSWORD") ? $CurrentForm->getValue("PASSWORD") : $CurrentForm->getValue("x__PASSWORD");
        if (!$this->_PASSWORD->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_PASSWORD->Visible = false; // Disable update for API request
            } else {
                $this->_PASSWORD->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ID->CurrentValue = $this->ID->FormValue;
        $this->NOMR->CurrentValue = $this->NOMR->FormValue;
        $this->NO_BPJS->CurrentValue = $this->NO_BPJS->FormValue;
        $this->NAMA->CurrentValue = $this->NAMA->FormValue;
        $this->TEMPAT_LAHIR->CurrentValue = $this->TEMPAT_LAHIR->FormValue;
        $this->TANGGAL_LAHIR->CurrentValue = $this->TANGGAL_LAHIR->FormValue;
        $this->TANGGAL_LAHIR->CurrentValue = UnFormatDateTime($this->TANGGAL_LAHIR->CurrentValue, 0);
        $this->JENIS_KELAMIN->CurrentValue = $this->JENIS_KELAMIN->FormValue;
        $this->AGAMA->CurrentValue = $this->AGAMA->FormValue;
        $this->PEKERJAAN->CurrentValue = $this->PEKERJAAN->FormValue;
        $this->ALAMAT->CurrentValue = $this->ALAMAT->FormValue;
        $this->NO_TELP->CurrentValue = $this->NO_TELP->FormValue;
        $this->NO_HP->CurrentValue = $this->NO_HP->FormValue;
        $this->_EMAIL->CurrentValue = $this->_EMAIL->FormValue;
        $this->FOTO->CurrentValue = $this->FOTO->FormValue;
        $this->TANGGAL_REGIS->CurrentValue = $this->TANGGAL_REGIS->FormValue;
        $this->TANGGAL_REGIS->CurrentValue = UnFormatDateTime($this->TANGGAL_REGIS->CurrentValue, 0);
        $this->NAMA_IBU->CurrentValue = $this->NAMA_IBU->FormValue;
        $this->NAMA_AYAH->CurrentValue = $this->NAMA_AYAH->FormValue;
        $this->NAMA_PASANGAN->CurrentValue = $this->NAMA_PASANGAN->FormValue;
        $this->_PASSWORD->CurrentValue = $this->_PASSWORD->FormValue;
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
        $this->ID->setDbValue($row['ID']);
        $this->NOMR->setDbValue($row['NOMR']);
        $this->NO_BPJS->setDbValue($row['NO_BPJS']);
        $this->NAMA->setDbValue($row['NAMA']);
        $this->TEMPAT_LAHIR->setDbValue($row['TEMPAT_LAHIR']);
        $this->TANGGAL_LAHIR->setDbValue($row['TANGGAL_LAHIR']);
        $this->JENIS_KELAMIN->setDbValue($row['JENIS_KELAMIN']);
        $this->AGAMA->setDbValue($row['AGAMA']);
        $this->PEKERJAAN->setDbValue($row['PEKERJAAN']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->NO_TELP->setDbValue($row['NO_TELP']);
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->FOTO->setDbValue($row['FOTO']);
        $this->TANGGAL_REGIS->setDbValue($row['TANGGAL_REGIS']);
        $this->NAMA_IBU->setDbValue($row['NAMA_IBU']);
        $this->NAMA_AYAH->setDbValue($row['NAMA_AYAH']);
        $this->NAMA_PASANGAN->setDbValue($row['NAMA_PASANGAN']);
        $this->_PASSWORD->setDbValue($row['PASSWORD']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ID'] = null;
        $row['NOMR'] = null;
        $row['NO_BPJS'] = null;
        $row['NAMA'] = null;
        $row['TEMPAT_LAHIR'] = null;
        $row['TANGGAL_LAHIR'] = null;
        $row['JENIS_KELAMIN'] = null;
        $row['AGAMA'] = null;
        $row['PEKERJAAN'] = null;
        $row['ALAMAT'] = null;
        $row['NO_TELP'] = null;
        $row['NO_HP'] = null;
        $row['EMAIL'] = null;
        $row['FOTO'] = null;
        $row['TANGGAL_REGIS'] = null;
        $row['NAMA_IBU'] = null;
        $row['NAMA_AYAH'] = null;
        $row['NAMA_PASANGAN'] = null;
        $row['PASSWORD'] = null;
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

        // ID

        // NOMR

        // NO_BPJS

        // NAMA

        // TEMPAT_LAHIR

        // TANGGAL_LAHIR

        // JENIS_KELAMIN

        // AGAMA

        // PEKERJAAN

        // ALAMAT

        // NO_TELP

        // NO_HP

        // EMAIL

        // FOTO

        // TANGGAL_REGIS

        // NAMA_IBU

        // NAMA_AYAH

        // NAMA_PASANGAN

        // PASSWORD
        if ($this->RowType == ROWTYPE_VIEW) {
            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // NOMR
            $this->NOMR->ViewValue = $this->NOMR->CurrentValue;
            $this->NOMR->ViewCustomAttributes = "";

            // NO_BPJS
            $this->NO_BPJS->ViewValue = $this->NO_BPJS->CurrentValue;
            $this->NO_BPJS->ViewCustomAttributes = "";

            // NAMA
            $this->NAMA->ViewValue = $this->NAMA->CurrentValue;
            $this->NAMA->ViewCustomAttributes = "";

            // TEMPAT_LAHIR
            $this->TEMPAT_LAHIR->ViewValue = $this->TEMPAT_LAHIR->CurrentValue;
            $this->TEMPAT_LAHIR->ViewCustomAttributes = "";

            // TANGGAL_LAHIR
            $this->TANGGAL_LAHIR->ViewValue = $this->TANGGAL_LAHIR->CurrentValue;
            $this->TANGGAL_LAHIR->ViewValue = FormatDateTime($this->TANGGAL_LAHIR->ViewValue, 0);
            $this->TANGGAL_LAHIR->ViewCustomAttributes = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->ViewValue = $this->JENIS_KELAMIN->CurrentValue;
            $this->JENIS_KELAMIN->ViewCustomAttributes = "";

            // AGAMA
            $this->AGAMA->ViewValue = $this->AGAMA->CurrentValue;
            $this->AGAMA->ViewValue = FormatNumber($this->AGAMA->ViewValue, 0, -2, -2, -2);
            $this->AGAMA->ViewCustomAttributes = "";

            // PEKERJAAN
            $this->PEKERJAAN->ViewValue = $this->PEKERJAAN->CurrentValue;
            $this->PEKERJAAN->ViewValue = FormatNumber($this->PEKERJAAN->ViewValue, 0, -2, -2, -2);
            $this->PEKERJAAN->ViewCustomAttributes = "";

            // ALAMAT
            $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
            $this->ALAMAT->ViewCustomAttributes = "";

            // NO_TELP
            $this->NO_TELP->ViewValue = $this->NO_TELP->CurrentValue;
            $this->NO_TELP->ViewCustomAttributes = "";

            // NO_HP
            $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
            $this->NO_HP->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // FOTO
            $this->FOTO->ViewValue = $this->FOTO->CurrentValue;
            $this->FOTO->ViewCustomAttributes = "";

            // TANGGAL_REGIS
            $this->TANGGAL_REGIS->ViewValue = $this->TANGGAL_REGIS->CurrentValue;
            $this->TANGGAL_REGIS->ViewValue = FormatDateTime($this->TANGGAL_REGIS->ViewValue, 0);
            $this->TANGGAL_REGIS->ViewCustomAttributes = "";

            // NAMA_IBU
            $this->NAMA_IBU->ViewValue = $this->NAMA_IBU->CurrentValue;
            $this->NAMA_IBU->ViewCustomAttributes = "";

            // NAMA_AYAH
            $this->NAMA_AYAH->ViewValue = $this->NAMA_AYAH->CurrentValue;
            $this->NAMA_AYAH->ViewCustomAttributes = "";

            // NAMA_PASANGAN
            $this->NAMA_PASANGAN->ViewValue = $this->NAMA_PASANGAN->CurrentValue;
            $this->NAMA_PASANGAN->ViewCustomAttributes = "";

            // PASSWORD
            $this->_PASSWORD->ViewValue = $this->_PASSWORD->CurrentValue;
            $this->_PASSWORD->ViewCustomAttributes = "";

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";
            $this->ID->TooltipValue = "";

            // NOMR
            $this->NOMR->LinkCustomAttributes = "";
            $this->NOMR->HrefValue = "";
            $this->NOMR->TooltipValue = "";

            // NO_BPJS
            $this->NO_BPJS->LinkCustomAttributes = "";
            $this->NO_BPJS->HrefValue = "";
            $this->NO_BPJS->TooltipValue = "";

            // NAMA
            $this->NAMA->LinkCustomAttributes = "";
            $this->NAMA->HrefValue = "";
            $this->NAMA->TooltipValue = "";

            // TEMPAT_LAHIR
            $this->TEMPAT_LAHIR->LinkCustomAttributes = "";
            $this->TEMPAT_LAHIR->HrefValue = "";
            $this->TEMPAT_LAHIR->TooltipValue = "";

            // TANGGAL_LAHIR
            $this->TANGGAL_LAHIR->LinkCustomAttributes = "";
            $this->TANGGAL_LAHIR->HrefValue = "";
            $this->TANGGAL_LAHIR->TooltipValue = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->LinkCustomAttributes = "";
            $this->JENIS_KELAMIN->HrefValue = "";
            $this->JENIS_KELAMIN->TooltipValue = "";

            // AGAMA
            $this->AGAMA->LinkCustomAttributes = "";
            $this->AGAMA->HrefValue = "";
            $this->AGAMA->TooltipValue = "";

            // PEKERJAAN
            $this->PEKERJAAN->LinkCustomAttributes = "";
            $this->PEKERJAAN->HrefValue = "";
            $this->PEKERJAAN->TooltipValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";
            $this->ALAMAT->TooltipValue = "";

            // NO_TELP
            $this->NO_TELP->LinkCustomAttributes = "";
            $this->NO_TELP->HrefValue = "";
            $this->NO_TELP->TooltipValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";
            $this->NO_HP->TooltipValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";
            $this->_EMAIL->TooltipValue = "";

            // FOTO
            $this->FOTO->LinkCustomAttributes = "";
            $this->FOTO->HrefValue = "";
            $this->FOTO->TooltipValue = "";

            // TANGGAL_REGIS
            $this->TANGGAL_REGIS->LinkCustomAttributes = "";
            $this->TANGGAL_REGIS->HrefValue = "";
            $this->TANGGAL_REGIS->TooltipValue = "";

            // NAMA_IBU
            $this->NAMA_IBU->LinkCustomAttributes = "";
            $this->NAMA_IBU->HrefValue = "";
            $this->NAMA_IBU->TooltipValue = "";

            // NAMA_AYAH
            $this->NAMA_AYAH->LinkCustomAttributes = "";
            $this->NAMA_AYAH->HrefValue = "";
            $this->NAMA_AYAH->TooltipValue = "";

            // NAMA_PASANGAN
            $this->NAMA_PASANGAN->LinkCustomAttributes = "";
            $this->NAMA_PASANGAN->HrefValue = "";
            $this->NAMA_PASANGAN->TooltipValue = "";

            // PASSWORD
            $this->_PASSWORD->LinkCustomAttributes = "";
            $this->_PASSWORD->HrefValue = "";
            $this->_PASSWORD->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // ID
            $this->ID->EditAttrs["class"] = "form-control";
            $this->ID->EditCustomAttributes = "";
            $this->ID->EditValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // NOMR
            $this->NOMR->EditAttrs["class"] = "form-control";
            $this->NOMR->EditCustomAttributes = "";
            if (!$this->NOMR->Raw) {
                $this->NOMR->CurrentValue = HtmlDecode($this->NOMR->CurrentValue);
            }
            $this->NOMR->EditValue = HtmlEncode($this->NOMR->CurrentValue);
            $this->NOMR->PlaceHolder = RemoveHtml($this->NOMR->caption());

            // NO_BPJS
            $this->NO_BPJS->EditAttrs["class"] = "form-control";
            $this->NO_BPJS->EditCustomAttributes = "";
            if (!$this->NO_BPJS->Raw) {
                $this->NO_BPJS->CurrentValue = HtmlDecode($this->NO_BPJS->CurrentValue);
            }
            $this->NO_BPJS->EditValue = HtmlEncode($this->NO_BPJS->CurrentValue);
            $this->NO_BPJS->PlaceHolder = RemoveHtml($this->NO_BPJS->caption());

            // NAMA
            $this->NAMA->EditAttrs["class"] = "form-control";
            $this->NAMA->EditCustomAttributes = "";
            if (!$this->NAMA->Raw) {
                $this->NAMA->CurrentValue = HtmlDecode($this->NAMA->CurrentValue);
            }
            $this->NAMA->EditValue = HtmlEncode($this->NAMA->CurrentValue);
            $this->NAMA->PlaceHolder = RemoveHtml($this->NAMA->caption());

            // TEMPAT_LAHIR
            $this->TEMPAT_LAHIR->EditAttrs["class"] = "form-control";
            $this->TEMPAT_LAHIR->EditCustomAttributes = "";
            if (!$this->TEMPAT_LAHIR->Raw) {
                $this->TEMPAT_LAHIR->CurrentValue = HtmlDecode($this->TEMPAT_LAHIR->CurrentValue);
            }
            $this->TEMPAT_LAHIR->EditValue = HtmlEncode($this->TEMPAT_LAHIR->CurrentValue);
            $this->TEMPAT_LAHIR->PlaceHolder = RemoveHtml($this->TEMPAT_LAHIR->caption());

            // TANGGAL_LAHIR
            $this->TANGGAL_LAHIR->EditAttrs["class"] = "form-control";
            $this->TANGGAL_LAHIR->EditCustomAttributes = "";
            $this->TANGGAL_LAHIR->EditValue = HtmlEncode(FormatDateTime($this->TANGGAL_LAHIR->CurrentValue, 8));
            $this->TANGGAL_LAHIR->PlaceHolder = RemoveHtml($this->TANGGAL_LAHIR->caption());

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->EditAttrs["class"] = "form-control";
            $this->JENIS_KELAMIN->EditCustomAttributes = "";
            if (!$this->JENIS_KELAMIN->Raw) {
                $this->JENIS_KELAMIN->CurrentValue = HtmlDecode($this->JENIS_KELAMIN->CurrentValue);
            }
            $this->JENIS_KELAMIN->EditValue = HtmlEncode($this->JENIS_KELAMIN->CurrentValue);
            $this->JENIS_KELAMIN->PlaceHolder = RemoveHtml($this->JENIS_KELAMIN->caption());

            // AGAMA
            $this->AGAMA->EditAttrs["class"] = "form-control";
            $this->AGAMA->EditCustomAttributes = "";
            $this->AGAMA->EditValue = HtmlEncode($this->AGAMA->CurrentValue);
            $this->AGAMA->PlaceHolder = RemoveHtml($this->AGAMA->caption());

            // PEKERJAAN
            $this->PEKERJAAN->EditAttrs["class"] = "form-control";
            $this->PEKERJAAN->EditCustomAttributes = "";
            $this->PEKERJAAN->EditValue = HtmlEncode($this->PEKERJAAN->CurrentValue);
            $this->PEKERJAAN->PlaceHolder = RemoveHtml($this->PEKERJAAN->caption());

            // ALAMAT
            $this->ALAMAT->EditAttrs["class"] = "form-control";
            $this->ALAMAT->EditCustomAttributes = "";
            if (!$this->ALAMAT->Raw) {
                $this->ALAMAT->CurrentValue = HtmlDecode($this->ALAMAT->CurrentValue);
            }
            $this->ALAMAT->EditValue = HtmlEncode($this->ALAMAT->CurrentValue);
            $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

            // NO_TELP
            $this->NO_TELP->EditAttrs["class"] = "form-control";
            $this->NO_TELP->EditCustomAttributes = "";
            if (!$this->NO_TELP->Raw) {
                $this->NO_TELP->CurrentValue = HtmlDecode($this->NO_TELP->CurrentValue);
            }
            $this->NO_TELP->EditValue = HtmlEncode($this->NO_TELP->CurrentValue);
            $this->NO_TELP->PlaceHolder = RemoveHtml($this->NO_TELP->caption());

            // NO_HP
            $this->NO_HP->EditAttrs["class"] = "form-control";
            $this->NO_HP->EditCustomAttributes = "";
            if (!$this->NO_HP->Raw) {
                $this->NO_HP->CurrentValue = HtmlDecode($this->NO_HP->CurrentValue);
            }
            $this->NO_HP->EditValue = HtmlEncode($this->NO_HP->CurrentValue);
            $this->NO_HP->PlaceHolder = RemoveHtml($this->NO_HP->caption());

            // EMAIL
            $this->_EMAIL->EditAttrs["class"] = "form-control";
            $this->_EMAIL->EditCustomAttributes = "";
            if (!$this->_EMAIL->Raw) {
                $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
            }
            $this->_EMAIL->EditValue = HtmlEncode($this->_EMAIL->CurrentValue);
            $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

            // FOTO
            $this->FOTO->EditAttrs["class"] = "form-control";
            $this->FOTO->EditCustomAttributes = "";
            if (!$this->FOTO->Raw) {
                $this->FOTO->CurrentValue = HtmlDecode($this->FOTO->CurrentValue);
            }
            $this->FOTO->EditValue = HtmlEncode($this->FOTO->CurrentValue);
            $this->FOTO->PlaceHolder = RemoveHtml($this->FOTO->caption());

            // TANGGAL_REGIS
            $this->TANGGAL_REGIS->EditAttrs["class"] = "form-control";
            $this->TANGGAL_REGIS->EditCustomAttributes = "";
            $this->TANGGAL_REGIS->EditValue = HtmlEncode(FormatDateTime($this->TANGGAL_REGIS->CurrentValue, 8));
            $this->TANGGAL_REGIS->PlaceHolder = RemoveHtml($this->TANGGAL_REGIS->caption());

            // NAMA_IBU
            $this->NAMA_IBU->EditAttrs["class"] = "form-control";
            $this->NAMA_IBU->EditCustomAttributes = "";
            if (!$this->NAMA_IBU->Raw) {
                $this->NAMA_IBU->CurrentValue = HtmlDecode($this->NAMA_IBU->CurrentValue);
            }
            $this->NAMA_IBU->EditValue = HtmlEncode($this->NAMA_IBU->CurrentValue);
            $this->NAMA_IBU->PlaceHolder = RemoveHtml($this->NAMA_IBU->caption());

            // NAMA_AYAH
            $this->NAMA_AYAH->EditAttrs["class"] = "form-control";
            $this->NAMA_AYAH->EditCustomAttributes = "";
            if (!$this->NAMA_AYAH->Raw) {
                $this->NAMA_AYAH->CurrentValue = HtmlDecode($this->NAMA_AYAH->CurrentValue);
            }
            $this->NAMA_AYAH->EditValue = HtmlEncode($this->NAMA_AYAH->CurrentValue);
            $this->NAMA_AYAH->PlaceHolder = RemoveHtml($this->NAMA_AYAH->caption());

            // NAMA_PASANGAN
            $this->NAMA_PASANGAN->EditAttrs["class"] = "form-control";
            $this->NAMA_PASANGAN->EditCustomAttributes = "";
            if (!$this->NAMA_PASANGAN->Raw) {
                $this->NAMA_PASANGAN->CurrentValue = HtmlDecode($this->NAMA_PASANGAN->CurrentValue);
            }
            $this->NAMA_PASANGAN->EditValue = HtmlEncode($this->NAMA_PASANGAN->CurrentValue);
            $this->NAMA_PASANGAN->PlaceHolder = RemoveHtml($this->NAMA_PASANGAN->caption());

            // PASSWORD
            $this->_PASSWORD->EditAttrs["class"] = "form-control";
            $this->_PASSWORD->EditCustomAttributes = "";
            if (!$this->_PASSWORD->Raw) {
                $this->_PASSWORD->CurrentValue = HtmlDecode($this->_PASSWORD->CurrentValue);
            }
            $this->_PASSWORD->EditValue = HtmlEncode($this->_PASSWORD->CurrentValue);
            $this->_PASSWORD->PlaceHolder = RemoveHtml($this->_PASSWORD->caption());

            // Edit refer script

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";

            // NOMR
            $this->NOMR->LinkCustomAttributes = "";
            $this->NOMR->HrefValue = "";

            // NO_BPJS
            $this->NO_BPJS->LinkCustomAttributes = "";
            $this->NO_BPJS->HrefValue = "";

            // NAMA
            $this->NAMA->LinkCustomAttributes = "";
            $this->NAMA->HrefValue = "";

            // TEMPAT_LAHIR
            $this->TEMPAT_LAHIR->LinkCustomAttributes = "";
            $this->TEMPAT_LAHIR->HrefValue = "";

            // TANGGAL_LAHIR
            $this->TANGGAL_LAHIR->LinkCustomAttributes = "";
            $this->TANGGAL_LAHIR->HrefValue = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->LinkCustomAttributes = "";
            $this->JENIS_KELAMIN->HrefValue = "";

            // AGAMA
            $this->AGAMA->LinkCustomAttributes = "";
            $this->AGAMA->HrefValue = "";

            // PEKERJAAN
            $this->PEKERJAAN->LinkCustomAttributes = "";
            $this->PEKERJAAN->HrefValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";

            // NO_TELP
            $this->NO_TELP->LinkCustomAttributes = "";
            $this->NO_TELP->HrefValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";

            // FOTO
            $this->FOTO->LinkCustomAttributes = "";
            $this->FOTO->HrefValue = "";

            // TANGGAL_REGIS
            $this->TANGGAL_REGIS->LinkCustomAttributes = "";
            $this->TANGGAL_REGIS->HrefValue = "";

            // NAMA_IBU
            $this->NAMA_IBU->LinkCustomAttributes = "";
            $this->NAMA_IBU->HrefValue = "";

            // NAMA_AYAH
            $this->NAMA_AYAH->LinkCustomAttributes = "";
            $this->NAMA_AYAH->HrefValue = "";

            // NAMA_PASANGAN
            $this->NAMA_PASANGAN->LinkCustomAttributes = "";
            $this->NAMA_PASANGAN->HrefValue = "";

            // PASSWORD
            $this->_PASSWORD->LinkCustomAttributes = "";
            $this->_PASSWORD->HrefValue = "";
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
        if ($this->ID->Required) {
            if (!$this->ID->IsDetailKey && EmptyValue($this->ID->FormValue)) {
                $this->ID->addErrorMessage(str_replace("%s", $this->ID->caption(), $this->ID->RequiredErrorMessage));
            }
        }
        if ($this->NOMR->Required) {
            if (!$this->NOMR->IsDetailKey && EmptyValue($this->NOMR->FormValue)) {
                $this->NOMR->addErrorMessage(str_replace("%s", $this->NOMR->caption(), $this->NOMR->RequiredErrorMessage));
            }
        }
        if ($this->NO_BPJS->Required) {
            if (!$this->NO_BPJS->IsDetailKey && EmptyValue($this->NO_BPJS->FormValue)) {
                $this->NO_BPJS->addErrorMessage(str_replace("%s", $this->NO_BPJS->caption(), $this->NO_BPJS->RequiredErrorMessage));
            }
        }
        if ($this->NAMA->Required) {
            if (!$this->NAMA->IsDetailKey && EmptyValue($this->NAMA->FormValue)) {
                $this->NAMA->addErrorMessage(str_replace("%s", $this->NAMA->caption(), $this->NAMA->RequiredErrorMessage));
            }
        }
        if ($this->TEMPAT_LAHIR->Required) {
            if (!$this->TEMPAT_LAHIR->IsDetailKey && EmptyValue($this->TEMPAT_LAHIR->FormValue)) {
                $this->TEMPAT_LAHIR->addErrorMessage(str_replace("%s", $this->TEMPAT_LAHIR->caption(), $this->TEMPAT_LAHIR->RequiredErrorMessage));
            }
        }
        if ($this->TANGGAL_LAHIR->Required) {
            if (!$this->TANGGAL_LAHIR->IsDetailKey && EmptyValue($this->TANGGAL_LAHIR->FormValue)) {
                $this->TANGGAL_LAHIR->addErrorMessage(str_replace("%s", $this->TANGGAL_LAHIR->caption(), $this->TANGGAL_LAHIR->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->TANGGAL_LAHIR->FormValue)) {
            $this->TANGGAL_LAHIR->addErrorMessage($this->TANGGAL_LAHIR->getErrorMessage(false));
        }
        if ($this->JENIS_KELAMIN->Required) {
            if (!$this->JENIS_KELAMIN->IsDetailKey && EmptyValue($this->JENIS_KELAMIN->FormValue)) {
                $this->JENIS_KELAMIN->addErrorMessage(str_replace("%s", $this->JENIS_KELAMIN->caption(), $this->JENIS_KELAMIN->RequiredErrorMessage));
            }
        }
        if ($this->AGAMA->Required) {
            if (!$this->AGAMA->IsDetailKey && EmptyValue($this->AGAMA->FormValue)) {
                $this->AGAMA->addErrorMessage(str_replace("%s", $this->AGAMA->caption(), $this->AGAMA->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->AGAMA->FormValue)) {
            $this->AGAMA->addErrorMessage($this->AGAMA->getErrorMessage(false));
        }
        if ($this->PEKERJAAN->Required) {
            if (!$this->PEKERJAAN->IsDetailKey && EmptyValue($this->PEKERJAAN->FormValue)) {
                $this->PEKERJAAN->addErrorMessage(str_replace("%s", $this->PEKERJAAN->caption(), $this->PEKERJAAN->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->PEKERJAAN->FormValue)) {
            $this->PEKERJAAN->addErrorMessage($this->PEKERJAAN->getErrorMessage(false));
        }
        if ($this->ALAMAT->Required) {
            if (!$this->ALAMAT->IsDetailKey && EmptyValue($this->ALAMAT->FormValue)) {
                $this->ALAMAT->addErrorMessage(str_replace("%s", $this->ALAMAT->caption(), $this->ALAMAT->RequiredErrorMessage));
            }
        }
        if ($this->NO_TELP->Required) {
            if (!$this->NO_TELP->IsDetailKey && EmptyValue($this->NO_TELP->FormValue)) {
                $this->NO_TELP->addErrorMessage(str_replace("%s", $this->NO_TELP->caption(), $this->NO_TELP->RequiredErrorMessage));
            }
        }
        if ($this->NO_HP->Required) {
            if (!$this->NO_HP->IsDetailKey && EmptyValue($this->NO_HP->FormValue)) {
                $this->NO_HP->addErrorMessage(str_replace("%s", $this->NO_HP->caption(), $this->NO_HP->RequiredErrorMessage));
            }
        }
        if ($this->_EMAIL->Required) {
            if (!$this->_EMAIL->IsDetailKey && EmptyValue($this->_EMAIL->FormValue)) {
                $this->_EMAIL->addErrorMessage(str_replace("%s", $this->_EMAIL->caption(), $this->_EMAIL->RequiredErrorMessage));
            }
        }
        if ($this->FOTO->Required) {
            if (!$this->FOTO->IsDetailKey && EmptyValue($this->FOTO->FormValue)) {
                $this->FOTO->addErrorMessage(str_replace("%s", $this->FOTO->caption(), $this->FOTO->RequiredErrorMessage));
            }
        }
        if ($this->TANGGAL_REGIS->Required) {
            if (!$this->TANGGAL_REGIS->IsDetailKey && EmptyValue($this->TANGGAL_REGIS->FormValue)) {
                $this->TANGGAL_REGIS->addErrorMessage(str_replace("%s", $this->TANGGAL_REGIS->caption(), $this->TANGGAL_REGIS->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->TANGGAL_REGIS->FormValue)) {
            $this->TANGGAL_REGIS->addErrorMessage($this->TANGGAL_REGIS->getErrorMessage(false));
        }
        if ($this->NAMA_IBU->Required) {
            if (!$this->NAMA_IBU->IsDetailKey && EmptyValue($this->NAMA_IBU->FormValue)) {
                $this->NAMA_IBU->addErrorMessage(str_replace("%s", $this->NAMA_IBU->caption(), $this->NAMA_IBU->RequiredErrorMessage));
            }
        }
        if ($this->NAMA_AYAH->Required) {
            if (!$this->NAMA_AYAH->IsDetailKey && EmptyValue($this->NAMA_AYAH->FormValue)) {
                $this->NAMA_AYAH->addErrorMessage(str_replace("%s", $this->NAMA_AYAH->caption(), $this->NAMA_AYAH->RequiredErrorMessage));
            }
        }
        if ($this->NAMA_PASANGAN->Required) {
            if (!$this->NAMA_PASANGAN->IsDetailKey && EmptyValue($this->NAMA_PASANGAN->FormValue)) {
                $this->NAMA_PASANGAN->addErrorMessage(str_replace("%s", $this->NAMA_PASANGAN->caption(), $this->NAMA_PASANGAN->RequiredErrorMessage));
            }
        }
        if ($this->_PASSWORD->Required) {
            if (!$this->_PASSWORD->IsDetailKey && EmptyValue($this->_PASSWORD->FormValue)) {
                $this->_PASSWORD->addErrorMessage(str_replace("%s", $this->_PASSWORD->caption(), $this->_PASSWORD->RequiredErrorMessage));
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

            // NOMR
            $this->NOMR->setDbValueDef($rsnew, $this->NOMR->CurrentValue, null, $this->NOMR->ReadOnly);

            // NO_BPJS
            $this->NO_BPJS->setDbValueDef($rsnew, $this->NO_BPJS->CurrentValue, null, $this->NO_BPJS->ReadOnly);

            // NAMA
            $this->NAMA->setDbValueDef($rsnew, $this->NAMA->CurrentValue, null, $this->NAMA->ReadOnly);

            // TEMPAT_LAHIR
            $this->TEMPAT_LAHIR->setDbValueDef($rsnew, $this->TEMPAT_LAHIR->CurrentValue, null, $this->TEMPAT_LAHIR->ReadOnly);

            // TANGGAL_LAHIR
            $this->TANGGAL_LAHIR->setDbValueDef($rsnew, UnFormatDateTime($this->TANGGAL_LAHIR->CurrentValue, 0), null, $this->TANGGAL_LAHIR->ReadOnly);

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->setDbValueDef($rsnew, $this->JENIS_KELAMIN->CurrentValue, null, $this->JENIS_KELAMIN->ReadOnly);

            // AGAMA
            $this->AGAMA->setDbValueDef($rsnew, $this->AGAMA->CurrentValue, null, $this->AGAMA->ReadOnly);

            // PEKERJAAN
            $this->PEKERJAAN->setDbValueDef($rsnew, $this->PEKERJAAN->CurrentValue, null, $this->PEKERJAAN->ReadOnly);

            // ALAMAT
            $this->ALAMAT->setDbValueDef($rsnew, $this->ALAMAT->CurrentValue, null, $this->ALAMAT->ReadOnly);

            // NO_TELP
            $this->NO_TELP->setDbValueDef($rsnew, $this->NO_TELP->CurrentValue, null, $this->NO_TELP->ReadOnly);

            // NO_HP
            $this->NO_HP->setDbValueDef($rsnew, $this->NO_HP->CurrentValue, null, $this->NO_HP->ReadOnly);

            // EMAIL
            $this->_EMAIL->setDbValueDef($rsnew, $this->_EMAIL->CurrentValue, null, $this->_EMAIL->ReadOnly);

            // FOTO
            $this->FOTO->setDbValueDef($rsnew, $this->FOTO->CurrentValue, null, $this->FOTO->ReadOnly);

            // TANGGAL_REGIS
            $this->TANGGAL_REGIS->setDbValueDef($rsnew, UnFormatDateTime($this->TANGGAL_REGIS->CurrentValue, 0), null, $this->TANGGAL_REGIS->ReadOnly);

            // NAMA_IBU
            $this->NAMA_IBU->setDbValueDef($rsnew, $this->NAMA_IBU->CurrentValue, null, $this->NAMA_IBU->ReadOnly);

            // NAMA_AYAH
            $this->NAMA_AYAH->setDbValueDef($rsnew, $this->NAMA_AYAH->CurrentValue, null, $this->NAMA_AYAH->ReadOnly);

            // NAMA_PASANGAN
            $this->NAMA_PASANGAN->setDbValueDef($rsnew, $this->NAMA_PASANGAN->CurrentValue, null, $this->NAMA_PASANGAN->ReadOnly);

            // PASSWORD
            $this->_PASSWORD->setDbValueDef($rsnew, $this->_PASSWORD->CurrentValue, null, $this->_PASSWORD->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("AntrianLoginList"), "", $this->TableVar, true);
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
