<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TreatTarifAdd extends TreatTarif
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'TREAT_TARIF';

    // Page object name
    public $PageObjName = "TreatTarifAdd";

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

        // Table object (TREAT_TARIF)
        if (!isset($GLOBALS["TREAT_TARIF"]) || get_class($GLOBALS["TREAT_TARIF"]) == PROJECT_NAMESPACE . "TREAT_TARIF") {
            $GLOBALS["TREAT_TARIF"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'TREAT_TARIF');
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
                $doc = new $class(Container("TREAT_TARIF"));
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
                    if ($pageName == "TreatTarifView") {
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
            $key .= @$ar['TARIF_ID'];
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
        $this->KODE->setVisibility();
        $this->MODIFIED_DATE->Visible = false;
        $this->ORG_UNIT_CODE->setVisibility();
        $this->TARIF_ID->setVisibility();
        $this->PERDA_ID->setVisibility();
        $this->TREAT_ID->setVisibility();
        $this->DISPLAY_TARIF->setVisibility();
        $this->TARIF_NAME->setVisibility();
        $this->CLASS_ID->setVisibility();
        $this->LEVEL_ID->setVisibility();
        $this->OTHER_ID->setVisibility();
        $this->TARIF_TYPE->setVisibility();
        $this->DESCRIPTION->setVisibility();
        $this->IMPLEMENTED->setVisibility();
        $this->ACTIVITY_ID->setVisibility();
        $this->FA_V->Visible = false;
        $this->ISCITO->Visible = false;
        $this->AMOUNT_PAID->setVisibility();
        $this->MODIFIED_BY->setVisibility();
        $this->STATUS_PASIEN_ID->Visible = false;
        $this->CASEMIX_ID->setVisibility();
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
        $this->setupLookupOptions($this->PERDA_ID);
        $this->setupLookupOptions($this->CLASS_ID);
        $this->setupLookupOptions($this->TARIF_TYPE);
        $this->setupLookupOptions($this->ACTIVITY_ID);

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
            if (($keyValue = Get("TARIF_ID") ?? Route("TARIF_ID")) !== null) {
                $this->TARIF_ID->setQueryStringValue($keyValue);
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
                    $this->terminate("TreatTarifList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "TreatTarifList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "TreatTarifView") {
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
        $this->KODE->CurrentValue = null;
        $this->KODE->OldValue = $this->KODE->CurrentValue;
        $this->MODIFIED_DATE->CurrentValue = null;
        $this->MODIFIED_DATE->OldValue = $this->MODIFIED_DATE->CurrentValue;
        $this->ORG_UNIT_CODE->CurrentValue = null;
        $this->ORG_UNIT_CODE->OldValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->TARIF_ID->CurrentValue = null;
        $this->TARIF_ID->OldValue = $this->TARIF_ID->CurrentValue;
        $this->PERDA_ID->CurrentValue = null;
        $this->PERDA_ID->OldValue = $this->PERDA_ID->CurrentValue;
        $this->TREAT_ID->CurrentValue = null;
        $this->TREAT_ID->OldValue = $this->TREAT_ID->CurrentValue;
        $this->DISPLAY_TARIF->CurrentValue = null;
        $this->DISPLAY_TARIF->OldValue = $this->DISPLAY_TARIF->CurrentValue;
        $this->TARIF_NAME->CurrentValue = null;
        $this->TARIF_NAME->OldValue = $this->TARIF_NAME->CurrentValue;
        $this->CLASS_ID->CurrentValue = null;
        $this->CLASS_ID->OldValue = $this->CLASS_ID->CurrentValue;
        $this->LEVEL_ID->CurrentValue = null;
        $this->LEVEL_ID->OldValue = $this->LEVEL_ID->CurrentValue;
        $this->OTHER_ID->CurrentValue = null;
        $this->OTHER_ID->OldValue = $this->OTHER_ID->CurrentValue;
        $this->TARIF_TYPE->CurrentValue = null;
        $this->TARIF_TYPE->OldValue = $this->TARIF_TYPE->CurrentValue;
        $this->DESCRIPTION->CurrentValue = null;
        $this->DESCRIPTION->OldValue = $this->DESCRIPTION->CurrentValue;
        $this->IMPLEMENTED->CurrentValue = null;
        $this->IMPLEMENTED->OldValue = $this->IMPLEMENTED->CurrentValue;
        $this->ACTIVITY_ID->CurrentValue = null;
        $this->ACTIVITY_ID->OldValue = $this->ACTIVITY_ID->CurrentValue;
        $this->FA_V->CurrentValue = null;
        $this->FA_V->OldValue = $this->FA_V->CurrentValue;
        $this->ISCITO->CurrentValue = "0";
        $this->AMOUNT_PAID->CurrentValue = null;
        $this->AMOUNT_PAID->OldValue = $this->AMOUNT_PAID->CurrentValue;
        $this->MODIFIED_BY->CurrentValue = null;
        $this->MODIFIED_BY->OldValue = $this->MODIFIED_BY->CurrentValue;
        $this->STATUS_PASIEN_ID->CurrentValue = null;
        $this->STATUS_PASIEN_ID->OldValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->CASEMIX_ID->CurrentValue = null;
        $this->CASEMIX_ID->OldValue = $this->CASEMIX_ID->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'KODE' first before field var 'x_KODE'
        $val = $CurrentForm->hasValue("KODE") ? $CurrentForm->getValue("KODE") : $CurrentForm->getValue("x_KODE");
        if (!$this->KODE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KODE->Visible = false; // Disable update for API request
            } else {
                $this->KODE->setFormValue($val);
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

        // Check field name 'TARIF_ID' first before field var 'x_TARIF_ID'
        $val = $CurrentForm->hasValue("TARIF_ID") ? $CurrentForm->getValue("TARIF_ID") : $CurrentForm->getValue("x_TARIF_ID");
        if (!$this->TARIF_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TARIF_ID->Visible = false; // Disable update for API request
            } else {
                $this->TARIF_ID->setFormValue($val);
            }
        }

        // Check field name 'PERDA_ID' first before field var 'x_PERDA_ID'
        $val = $CurrentForm->hasValue("PERDA_ID") ? $CurrentForm->getValue("PERDA_ID") : $CurrentForm->getValue("x_PERDA_ID");
        if (!$this->PERDA_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PERDA_ID->Visible = false; // Disable update for API request
            } else {
                $this->PERDA_ID->setFormValue($val);
            }
        }

        // Check field name 'TREAT_ID' first before field var 'x_TREAT_ID'
        $val = $CurrentForm->hasValue("TREAT_ID") ? $CurrentForm->getValue("TREAT_ID") : $CurrentForm->getValue("x_TREAT_ID");
        if (!$this->TREAT_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TREAT_ID->Visible = false; // Disable update for API request
            } else {
                $this->TREAT_ID->setFormValue($val);
            }
        }

        // Check field name 'DISPLAY_TARIF' first before field var 'x_DISPLAY_TARIF'
        $val = $CurrentForm->hasValue("DISPLAY_TARIF") ? $CurrentForm->getValue("DISPLAY_TARIF") : $CurrentForm->getValue("x_DISPLAY_TARIF");
        if (!$this->DISPLAY_TARIF->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DISPLAY_TARIF->Visible = false; // Disable update for API request
            } else {
                $this->DISPLAY_TARIF->setFormValue($val);
            }
        }

        // Check field name 'TARIF_NAME' first before field var 'x_TARIF_NAME'
        $val = $CurrentForm->hasValue("TARIF_NAME") ? $CurrentForm->getValue("TARIF_NAME") : $CurrentForm->getValue("x_TARIF_NAME");
        if (!$this->TARIF_NAME->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TARIF_NAME->Visible = false; // Disable update for API request
            } else {
                $this->TARIF_NAME->setFormValue($val);
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

        // Check field name 'LEVEL_ID' first before field var 'x_LEVEL_ID'
        $val = $CurrentForm->hasValue("LEVEL_ID") ? $CurrentForm->getValue("LEVEL_ID") : $CurrentForm->getValue("x_LEVEL_ID");
        if (!$this->LEVEL_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LEVEL_ID->Visible = false; // Disable update for API request
            } else {
                $this->LEVEL_ID->setFormValue($val);
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

        // Check field name 'TARIF_TYPE' first before field var 'x_TARIF_TYPE'
        $val = $CurrentForm->hasValue("TARIF_TYPE") ? $CurrentForm->getValue("TARIF_TYPE") : $CurrentForm->getValue("x_TARIF_TYPE");
        if (!$this->TARIF_TYPE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TARIF_TYPE->Visible = false; // Disable update for API request
            } else {
                $this->TARIF_TYPE->setFormValue($val);
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

        // Check field name 'IMPLEMENTED' first before field var 'x_IMPLEMENTED'
        $val = $CurrentForm->hasValue("IMPLEMENTED") ? $CurrentForm->getValue("IMPLEMENTED") : $CurrentForm->getValue("x_IMPLEMENTED");
        if (!$this->IMPLEMENTED->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->IMPLEMENTED->Visible = false; // Disable update for API request
            } else {
                $this->IMPLEMENTED->setFormValue($val);
            }
        }

        // Check field name 'ACTIVITY_ID' first before field var 'x_ACTIVITY_ID'
        $val = $CurrentForm->hasValue("ACTIVITY_ID") ? $CurrentForm->getValue("ACTIVITY_ID") : $CurrentForm->getValue("x_ACTIVITY_ID");
        if (!$this->ACTIVITY_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ACTIVITY_ID->Visible = false; // Disable update for API request
            } else {
                $this->ACTIVITY_ID->setFormValue($val);
            }
        }

        // Check field name 'AMOUNT_PAID' first before field var 'x_AMOUNT_PAID'
        $val = $CurrentForm->hasValue("AMOUNT_PAID") ? $CurrentForm->getValue("AMOUNT_PAID") : $CurrentForm->getValue("x_AMOUNT_PAID");
        if (!$this->AMOUNT_PAID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->AMOUNT_PAID->Visible = false; // Disable update for API request
            } else {
                $this->AMOUNT_PAID->setFormValue($val);
            }
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

        // Check field name 'CASEMIX_ID' first before field var 'x_CASEMIX_ID'
        $val = $CurrentForm->hasValue("CASEMIX_ID") ? $CurrentForm->getValue("CASEMIX_ID") : $CurrentForm->getValue("x_CASEMIX_ID");
        if (!$this->CASEMIX_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CASEMIX_ID->Visible = false; // Disable update for API request
            } else {
                $this->CASEMIX_ID->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->KODE->CurrentValue = $this->KODE->FormValue;
        $this->ORG_UNIT_CODE->CurrentValue = $this->ORG_UNIT_CODE->FormValue;
        $this->TARIF_ID->CurrentValue = $this->TARIF_ID->FormValue;
        $this->PERDA_ID->CurrentValue = $this->PERDA_ID->FormValue;
        $this->TREAT_ID->CurrentValue = $this->TREAT_ID->FormValue;
        $this->DISPLAY_TARIF->CurrentValue = $this->DISPLAY_TARIF->FormValue;
        $this->TARIF_NAME->CurrentValue = $this->TARIF_NAME->FormValue;
        $this->CLASS_ID->CurrentValue = $this->CLASS_ID->FormValue;
        $this->LEVEL_ID->CurrentValue = $this->LEVEL_ID->FormValue;
        $this->OTHER_ID->CurrentValue = $this->OTHER_ID->FormValue;
        $this->TARIF_TYPE->CurrentValue = $this->TARIF_TYPE->FormValue;
        $this->DESCRIPTION->CurrentValue = $this->DESCRIPTION->FormValue;
        $this->IMPLEMENTED->CurrentValue = $this->IMPLEMENTED->FormValue;
        $this->ACTIVITY_ID->CurrentValue = $this->ACTIVITY_ID->FormValue;
        $this->AMOUNT_PAID->CurrentValue = $this->AMOUNT_PAID->FormValue;
        $this->MODIFIED_BY->CurrentValue = $this->MODIFIED_BY->FormValue;
        $this->CASEMIX_ID->CurrentValue = $this->CASEMIX_ID->FormValue;
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
        $this->KODE->setDbValue($row['KODE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->PERDA_ID->setDbValue($row['PERDA_ID']);
        $this->TREAT_ID->setDbValue($row['TREAT_ID']);
        $this->DISPLAY_TARIF->setDbValue($row['DISPLAY_TARIF']);
        $this->TARIF_NAME->setDbValue($row['TARIF_NAME']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->LEVEL_ID->setDbValue($row['LEVEL_ID']);
        $this->OTHER_ID->setDbValue($row['OTHER_ID']);
        $this->TARIF_TYPE->setDbValue($row['TARIF_TYPE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->IMPLEMENTED->setDbValue($row['IMPLEMENTED']);
        $this->ACTIVITY_ID->setDbValue($row['ACTIVITY_ID']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->ISCITO->setDbValue($row['ISCITO']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->CASEMIX_ID->setDbValue($row['CASEMIX_ID']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['KODE'] = $this->KODE->CurrentValue;
        $row['MODIFIED_DATE'] = $this->MODIFIED_DATE->CurrentValue;
        $row['ORG_UNIT_CODE'] = $this->ORG_UNIT_CODE->CurrentValue;
        $row['TARIF_ID'] = $this->TARIF_ID->CurrentValue;
        $row['PERDA_ID'] = $this->PERDA_ID->CurrentValue;
        $row['TREAT_ID'] = $this->TREAT_ID->CurrentValue;
        $row['DISPLAY_TARIF'] = $this->DISPLAY_TARIF->CurrentValue;
        $row['TARIF_NAME'] = $this->TARIF_NAME->CurrentValue;
        $row['CLASS_ID'] = $this->CLASS_ID->CurrentValue;
        $row['LEVEL_ID'] = $this->LEVEL_ID->CurrentValue;
        $row['OTHER_ID'] = $this->OTHER_ID->CurrentValue;
        $row['TARIF_TYPE'] = $this->TARIF_TYPE->CurrentValue;
        $row['DESCRIPTION'] = $this->DESCRIPTION->CurrentValue;
        $row['IMPLEMENTED'] = $this->IMPLEMENTED->CurrentValue;
        $row['ACTIVITY_ID'] = $this->ACTIVITY_ID->CurrentValue;
        $row['FA_V'] = $this->FA_V->CurrentValue;
        $row['ISCITO'] = $this->ISCITO->CurrentValue;
        $row['AMOUNT_PAID'] = $this->AMOUNT_PAID->CurrentValue;
        $row['MODIFIED_BY'] = $this->MODIFIED_BY->CurrentValue;
        $row['STATUS_PASIEN_ID'] = $this->STATUS_PASIEN_ID->CurrentValue;
        $row['CASEMIX_ID'] = $this->CASEMIX_ID->CurrentValue;
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

        // Convert decimal values if posted back
        if ($this->AMOUNT_PAID->FormValue == $this->AMOUNT_PAID->CurrentValue && is_numeric(ConvertToFloatString($this->AMOUNT_PAID->CurrentValue))) {
            $this->AMOUNT_PAID->CurrentValue = ConvertToFloatString($this->AMOUNT_PAID->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // KODE

        // MODIFIED_DATE

        // ORG_UNIT_CODE

        // TARIF_ID

        // PERDA_ID

        // TREAT_ID

        // DISPLAY_TARIF

        // TARIF_NAME

        // CLASS_ID

        // LEVEL_ID

        // OTHER_ID

        // TARIF_TYPE

        // DESCRIPTION

        // IMPLEMENTED

        // ACTIVITY_ID

        // FA_V

        // ISCITO

        // AMOUNT_PAID

        // MODIFIED_BY

        // STATUS_PASIEN_ID

        // CASEMIX_ID
        if ($this->RowType == ROWTYPE_VIEW) {
            // KODE
            $this->KODE->ViewValue = $this->KODE->CurrentValue;
            $this->KODE->ViewCustomAttributes = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
            $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
            $this->MODIFIED_DATE->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // TARIF_ID
            $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
            $this->TARIF_ID->ViewCustomAttributes = "";

            // PERDA_ID
            $curVal = trim(strval($this->PERDA_ID->CurrentValue));
            if ($curVal != "") {
                $this->PERDA_ID->ViewValue = $this->PERDA_ID->lookupCacheOption($curVal);
                if ($this->PERDA_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[PERDA_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->PERDA_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PERDA_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->PERDA_ID->ViewValue = $this->PERDA_ID->displayValue($arwrk);
                    } else {
                        $this->PERDA_ID->ViewValue = $this->PERDA_ID->CurrentValue;
                    }
                }
            } else {
                $this->PERDA_ID->ViewValue = null;
            }
            $this->PERDA_ID->ViewCustomAttributes = "";

            // TREAT_ID
            $this->TREAT_ID->ViewValue = $this->TREAT_ID->CurrentValue;
            $this->TREAT_ID->ViewCustomAttributes = "";

            // DISPLAY_TARIF
            $this->DISPLAY_TARIF->ViewValue = $this->DISPLAY_TARIF->CurrentValue;
            $this->DISPLAY_TARIF->ViewCustomAttributes = "";

            // TARIF_NAME
            $this->TARIF_NAME->ViewValue = $this->TARIF_NAME->CurrentValue;
            $this->TARIF_NAME->ViewCustomAttributes = "";

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

            // LEVEL_ID
            $this->LEVEL_ID->ViewValue = $this->LEVEL_ID->CurrentValue;
            $this->LEVEL_ID->ViewValue = FormatNumber($this->LEVEL_ID->ViewValue, 0, -2, -2, -2);
            $this->LEVEL_ID->ViewCustomAttributes = "";

            // OTHER_ID
            $this->OTHER_ID->ViewValue = $this->OTHER_ID->CurrentValue;
            $this->OTHER_ID->ViewCustomAttributes = "";

            // TARIF_TYPE
            $curVal = trim(strval($this->TARIF_TYPE->CurrentValue));
            if ($curVal != "") {
                $this->TARIF_TYPE->ViewValue = $this->TARIF_TYPE->lookupCacheOption($curVal);
                if ($this->TARIF_TYPE->ViewValue === null) { // Lookup from database
                    $filterWrk = "[TARIF_TYPE]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->TARIF_TYPE->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->TARIF_TYPE->Lookup->renderViewRow($rswrk[0]);
                        $this->TARIF_TYPE->ViewValue = $this->TARIF_TYPE->displayValue($arwrk);
                    } else {
                        $this->TARIF_TYPE->ViewValue = $this->TARIF_TYPE->CurrentValue;
                    }
                }
            } else {
                $this->TARIF_TYPE->ViewValue = null;
            }
            $this->TARIF_TYPE->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // IMPLEMENTED
            if (strval($this->IMPLEMENTED->CurrentValue) != "") {
                $this->IMPLEMENTED->ViewValue = $this->IMPLEMENTED->optionCaption($this->IMPLEMENTED->CurrentValue);
            } else {
                $this->IMPLEMENTED->ViewValue = null;
            }
            $this->IMPLEMENTED->ViewCustomAttributes = "";

            // ACTIVITY_ID
            $curVal = trim(strval($this->ACTIVITY_ID->CurrentValue));
            if ($curVal != "") {
                $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->lookupCacheOption($curVal);
                if ($this->ACTIVITY_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[ACTIVITY_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->ACTIVITY_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->ACTIVITY_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->displayValue($arwrk);
                    } else {
                        $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->CurrentValue;
                    }
                }
            } else {
                $this->ACTIVITY_ID->ViewValue = null;
            }
            $this->ACTIVITY_ID->ViewCustomAttributes = "";

            // FA_V
            $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
            $this->FA_V->ViewValue = FormatNumber($this->FA_V->ViewValue, 0, -2, -2, -2);
            $this->FA_V->ViewCustomAttributes = "";

            // ISCITO
            $this->ISCITO->ViewValue = $this->ISCITO->CurrentValue;
            $this->ISCITO->ViewCustomAttributes = "";

            // AMOUNT_PAID
            $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
            $this->AMOUNT_PAID->ViewValue = FormatNumber($this->AMOUNT_PAID->ViewValue, 2, -2, -2, -2);
            $this->AMOUNT_PAID->ViewCustomAttributes = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
            $this->MODIFIED_BY->ViewCustomAttributes = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
            $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
            $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

            // CASEMIX_ID
            $this->CASEMIX_ID->ViewValue = $this->CASEMIX_ID->CurrentValue;
            $this->CASEMIX_ID->ViewValue = FormatNumber($this->CASEMIX_ID->ViewValue, 0, -2, -2, -2);
            $this->CASEMIX_ID->ViewCustomAttributes = "";

            // KODE
            $this->KODE->LinkCustomAttributes = "";
            $this->KODE->HrefValue = "";
            $this->KODE->TooltipValue = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // TARIF_ID
            $this->TARIF_ID->LinkCustomAttributes = "";
            $this->TARIF_ID->HrefValue = "";
            $this->TARIF_ID->TooltipValue = "";

            // PERDA_ID
            $this->PERDA_ID->LinkCustomAttributes = "";
            $this->PERDA_ID->HrefValue = "";
            $this->PERDA_ID->TooltipValue = "";

            // TREAT_ID
            $this->TREAT_ID->LinkCustomAttributes = "";
            $this->TREAT_ID->HrefValue = "";
            $this->TREAT_ID->TooltipValue = "";

            // DISPLAY_TARIF
            $this->DISPLAY_TARIF->LinkCustomAttributes = "";
            $this->DISPLAY_TARIF->HrefValue = "";
            $this->DISPLAY_TARIF->TooltipValue = "";

            // TARIF_NAME
            $this->TARIF_NAME->LinkCustomAttributes = "";
            $this->TARIF_NAME->HrefValue = "";
            $this->TARIF_NAME->TooltipValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";
            $this->CLASS_ID->TooltipValue = "";

            // LEVEL_ID
            $this->LEVEL_ID->LinkCustomAttributes = "";
            $this->LEVEL_ID->HrefValue = "";
            $this->LEVEL_ID->TooltipValue = "";

            // OTHER_ID
            $this->OTHER_ID->LinkCustomAttributes = "";
            $this->OTHER_ID->HrefValue = "";
            $this->OTHER_ID->TooltipValue = "";

            // TARIF_TYPE
            $this->TARIF_TYPE->LinkCustomAttributes = "";
            $this->TARIF_TYPE->HrefValue = "";
            $this->TARIF_TYPE->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";
            $this->DESCRIPTION->TooltipValue = "";

            // IMPLEMENTED
            $this->IMPLEMENTED->LinkCustomAttributes = "";
            $this->IMPLEMENTED->HrefValue = "";
            $this->IMPLEMENTED->TooltipValue = "";

            // ACTIVITY_ID
            $this->ACTIVITY_ID->LinkCustomAttributes = "";
            $this->ACTIVITY_ID->HrefValue = "";
            $this->ACTIVITY_ID->TooltipValue = "";

            // AMOUNT_PAID
            $this->AMOUNT_PAID->LinkCustomAttributes = "";
            $this->AMOUNT_PAID->HrefValue = "";
            $this->AMOUNT_PAID->TooltipValue = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->LinkCustomAttributes = "";
            $this->MODIFIED_BY->HrefValue = "";
            $this->MODIFIED_BY->TooltipValue = "";

            // CASEMIX_ID
            $this->CASEMIX_ID->LinkCustomAttributes = "";
            $this->CASEMIX_ID->HrefValue = "";
            $this->CASEMIX_ID->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // KODE
            $this->KODE->EditAttrs["class"] = "form-control";
            $this->KODE->EditCustomAttributes = "";
            if (!$this->KODE->Raw) {
                $this->KODE->CurrentValue = HtmlDecode($this->KODE->CurrentValue);
            }
            $this->KODE->EditValue = HtmlEncode($this->KODE->CurrentValue);
            $this->KODE->PlaceHolder = RemoveHtml($this->KODE->caption());

            // ORG_UNIT_CODE

            // TARIF_ID
            $this->TARIF_ID->EditAttrs["class"] = "form-control";
            $this->TARIF_ID->EditCustomAttributes = "";
            if (!$this->TARIF_ID->Raw) {
                $this->TARIF_ID->CurrentValue = HtmlDecode($this->TARIF_ID->CurrentValue);
            }
            $this->TARIF_ID->EditValue = HtmlEncode($this->TARIF_ID->CurrentValue);
            $this->TARIF_ID->PlaceHolder = RemoveHtml($this->TARIF_ID->caption());

            // PERDA_ID
            $this->PERDA_ID->EditAttrs["class"] = "form-control";
            $this->PERDA_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->PERDA_ID->CurrentValue));
            if ($curVal != "") {
                $this->PERDA_ID->ViewValue = $this->PERDA_ID->lookupCacheOption($curVal);
            } else {
                $this->PERDA_ID->ViewValue = $this->PERDA_ID->Lookup !== null && is_array($this->PERDA_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->PERDA_ID->ViewValue !== null) { // Load from cache
                $this->PERDA_ID->EditValue = array_values($this->PERDA_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[PERDA_ID]" . SearchString("=", $this->PERDA_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->PERDA_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->PERDA_ID->EditValue = $arwrk;
            }
            $this->PERDA_ID->PlaceHolder = RemoveHtml($this->PERDA_ID->caption());

            // TREAT_ID
            $this->TREAT_ID->EditAttrs["class"] = "form-control";
            $this->TREAT_ID->EditCustomAttributes = "";
            if (!$this->TREAT_ID->Raw) {
                $this->TREAT_ID->CurrentValue = HtmlDecode($this->TREAT_ID->CurrentValue);
            }
            $this->TREAT_ID->EditValue = HtmlEncode($this->TREAT_ID->CurrentValue);
            $this->TREAT_ID->PlaceHolder = RemoveHtml($this->TREAT_ID->caption());

            // DISPLAY_TARIF
            $this->DISPLAY_TARIF->EditAttrs["class"] = "form-control";
            $this->DISPLAY_TARIF->EditCustomAttributes = "";
            if (!$this->DISPLAY_TARIF->Raw) {
                $this->DISPLAY_TARIF->CurrentValue = HtmlDecode($this->DISPLAY_TARIF->CurrentValue);
            }
            $this->DISPLAY_TARIF->EditValue = HtmlEncode($this->DISPLAY_TARIF->CurrentValue);
            $this->DISPLAY_TARIF->PlaceHolder = RemoveHtml($this->DISPLAY_TARIF->caption());

            // TARIF_NAME
            $this->TARIF_NAME->EditAttrs["class"] = "form-control";
            $this->TARIF_NAME->EditCustomAttributes = "";
            if (!$this->TARIF_NAME->Raw) {
                $this->TARIF_NAME->CurrentValue = HtmlDecode($this->TARIF_NAME->CurrentValue);
            }
            $this->TARIF_NAME->EditValue = HtmlEncode($this->TARIF_NAME->CurrentValue);
            $this->TARIF_NAME->PlaceHolder = RemoveHtml($this->TARIF_NAME->caption());

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

            // LEVEL_ID
            $this->LEVEL_ID->EditAttrs["class"] = "form-control";
            $this->LEVEL_ID->EditCustomAttributes = "";
            $this->LEVEL_ID->EditValue = HtmlEncode($this->LEVEL_ID->CurrentValue);
            $this->LEVEL_ID->PlaceHolder = RemoveHtml($this->LEVEL_ID->caption());

            // OTHER_ID
            $this->OTHER_ID->EditAttrs["class"] = "form-control";
            $this->OTHER_ID->EditCustomAttributes = "";
            if (!$this->OTHER_ID->Raw) {
                $this->OTHER_ID->CurrentValue = HtmlDecode($this->OTHER_ID->CurrentValue);
            }
            $this->OTHER_ID->EditValue = HtmlEncode($this->OTHER_ID->CurrentValue);
            $this->OTHER_ID->PlaceHolder = RemoveHtml($this->OTHER_ID->caption());

            // TARIF_TYPE
            $this->TARIF_TYPE->EditAttrs["class"] = "form-control";
            $this->TARIF_TYPE->EditCustomAttributes = "";
            $curVal = trim(strval($this->TARIF_TYPE->CurrentValue));
            if ($curVal != "") {
                $this->TARIF_TYPE->ViewValue = $this->TARIF_TYPE->lookupCacheOption($curVal);
            } else {
                $this->TARIF_TYPE->ViewValue = $this->TARIF_TYPE->Lookup !== null && is_array($this->TARIF_TYPE->Lookup->Options) ? $curVal : null;
            }
            if ($this->TARIF_TYPE->ViewValue !== null) { // Load from cache
                $this->TARIF_TYPE->EditValue = array_values($this->TARIF_TYPE->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[TARIF_TYPE]" . SearchString("=", $this->TARIF_TYPE->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->TARIF_TYPE->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->TARIF_TYPE->EditValue = $arwrk;
            }
            $this->TARIF_TYPE->PlaceHolder = RemoveHtml($this->TARIF_TYPE->caption());

            // DESCRIPTION
            $this->DESCRIPTION->EditAttrs["class"] = "form-control";
            $this->DESCRIPTION->EditCustomAttributes = "";
            if (!$this->DESCRIPTION->Raw) {
                $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
            }
            $this->DESCRIPTION->EditValue = HtmlEncode($this->DESCRIPTION->CurrentValue);
            $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

            // IMPLEMENTED
            $this->IMPLEMENTED->EditAttrs["class"] = "form-control";
            $this->IMPLEMENTED->EditCustomAttributes = "";
            $this->IMPLEMENTED->EditValue = $this->IMPLEMENTED->options(true);
            $this->IMPLEMENTED->PlaceHolder = RemoveHtml($this->IMPLEMENTED->caption());

            // ACTIVITY_ID
            $this->ACTIVITY_ID->EditAttrs["class"] = "form-control";
            $this->ACTIVITY_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->ACTIVITY_ID->CurrentValue));
            if ($curVal != "") {
                $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->lookupCacheOption($curVal);
            } else {
                $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->Lookup !== null && is_array($this->ACTIVITY_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->ACTIVITY_ID->ViewValue !== null) { // Load from cache
                $this->ACTIVITY_ID->EditValue = array_values($this->ACTIVITY_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[ACTIVITY_ID]" . SearchString("=", $this->ACTIVITY_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->ACTIVITY_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->ACTIVITY_ID->EditValue = $arwrk;
            }
            $this->ACTIVITY_ID->PlaceHolder = RemoveHtml($this->ACTIVITY_ID->caption());

            // AMOUNT_PAID
            $this->AMOUNT_PAID->EditAttrs["class"] = "form-control";
            $this->AMOUNT_PAID->EditCustomAttributes = "";
            $this->AMOUNT_PAID->EditValue = HtmlEncode($this->AMOUNT_PAID->CurrentValue);
            $this->AMOUNT_PAID->PlaceHolder = RemoveHtml($this->AMOUNT_PAID->caption());
            if (strval($this->AMOUNT_PAID->EditValue) != "" && is_numeric($this->AMOUNT_PAID->EditValue)) {
                $this->AMOUNT_PAID->EditValue = FormatNumber($this->AMOUNT_PAID->EditValue, -2, -2, -2, -2);
            }

            // MODIFIED_BY
            $this->MODIFIED_BY->EditAttrs["class"] = "form-control";
            $this->MODIFIED_BY->EditCustomAttributes = "";
            if (!$this->MODIFIED_BY->Raw) {
                $this->MODIFIED_BY->CurrentValue = HtmlDecode($this->MODIFIED_BY->CurrentValue);
            }
            $this->MODIFIED_BY->EditValue = HtmlEncode($this->MODIFIED_BY->CurrentValue);
            $this->MODIFIED_BY->PlaceHolder = RemoveHtml($this->MODIFIED_BY->caption());

            // CASEMIX_ID
            $this->CASEMIX_ID->EditAttrs["class"] = "form-control";
            $this->CASEMIX_ID->EditCustomAttributes = "";
            $this->CASEMIX_ID->EditValue = HtmlEncode($this->CASEMIX_ID->CurrentValue);
            $this->CASEMIX_ID->PlaceHolder = RemoveHtml($this->CASEMIX_ID->caption());

            // Add refer script

            // KODE
            $this->KODE->LinkCustomAttributes = "";
            $this->KODE->HrefValue = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";

            // TARIF_ID
            $this->TARIF_ID->LinkCustomAttributes = "";
            $this->TARIF_ID->HrefValue = "";

            // PERDA_ID
            $this->PERDA_ID->LinkCustomAttributes = "";
            $this->PERDA_ID->HrefValue = "";

            // TREAT_ID
            $this->TREAT_ID->LinkCustomAttributes = "";
            $this->TREAT_ID->HrefValue = "";

            // DISPLAY_TARIF
            $this->DISPLAY_TARIF->LinkCustomAttributes = "";
            $this->DISPLAY_TARIF->HrefValue = "";

            // TARIF_NAME
            $this->TARIF_NAME->LinkCustomAttributes = "";
            $this->TARIF_NAME->HrefValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";

            // LEVEL_ID
            $this->LEVEL_ID->LinkCustomAttributes = "";
            $this->LEVEL_ID->HrefValue = "";

            // OTHER_ID
            $this->OTHER_ID->LinkCustomAttributes = "";
            $this->OTHER_ID->HrefValue = "";

            // TARIF_TYPE
            $this->TARIF_TYPE->LinkCustomAttributes = "";
            $this->TARIF_TYPE->HrefValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";

            // IMPLEMENTED
            $this->IMPLEMENTED->LinkCustomAttributes = "";
            $this->IMPLEMENTED->HrefValue = "";

            // ACTIVITY_ID
            $this->ACTIVITY_ID->LinkCustomAttributes = "";
            $this->ACTIVITY_ID->HrefValue = "";

            // AMOUNT_PAID
            $this->AMOUNT_PAID->LinkCustomAttributes = "";
            $this->AMOUNT_PAID->HrefValue = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->LinkCustomAttributes = "";
            $this->MODIFIED_BY->HrefValue = "";

            // CASEMIX_ID
            $this->CASEMIX_ID->LinkCustomAttributes = "";
            $this->CASEMIX_ID->HrefValue = "";
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
        if ($this->KODE->Required) {
            if (!$this->KODE->IsDetailKey && EmptyValue($this->KODE->FormValue)) {
                $this->KODE->addErrorMessage(str_replace("%s", $this->KODE->caption(), $this->KODE->RequiredErrorMessage));
            }
        }
        if ($this->ORG_UNIT_CODE->Required) {
            if (!$this->ORG_UNIT_CODE->IsDetailKey && EmptyValue($this->ORG_UNIT_CODE->FormValue)) {
                $this->ORG_UNIT_CODE->addErrorMessage(str_replace("%s", $this->ORG_UNIT_CODE->caption(), $this->ORG_UNIT_CODE->RequiredErrorMessage));
            }
        }
        if ($this->TARIF_ID->Required) {
            if (!$this->TARIF_ID->IsDetailKey && EmptyValue($this->TARIF_ID->FormValue)) {
                $this->TARIF_ID->addErrorMessage(str_replace("%s", $this->TARIF_ID->caption(), $this->TARIF_ID->RequiredErrorMessage));
            }
        }
        if ($this->PERDA_ID->Required) {
            if (!$this->PERDA_ID->IsDetailKey && EmptyValue($this->PERDA_ID->FormValue)) {
                $this->PERDA_ID->addErrorMessage(str_replace("%s", $this->PERDA_ID->caption(), $this->PERDA_ID->RequiredErrorMessage));
            }
        }
        if ($this->TREAT_ID->Required) {
            if (!$this->TREAT_ID->IsDetailKey && EmptyValue($this->TREAT_ID->FormValue)) {
                $this->TREAT_ID->addErrorMessage(str_replace("%s", $this->TREAT_ID->caption(), $this->TREAT_ID->RequiredErrorMessage));
            }
        }
        if ($this->DISPLAY_TARIF->Required) {
            if (!$this->DISPLAY_TARIF->IsDetailKey && EmptyValue($this->DISPLAY_TARIF->FormValue)) {
                $this->DISPLAY_TARIF->addErrorMessage(str_replace("%s", $this->DISPLAY_TARIF->caption(), $this->DISPLAY_TARIF->RequiredErrorMessage));
            }
        }
        if ($this->TARIF_NAME->Required) {
            if (!$this->TARIF_NAME->IsDetailKey && EmptyValue($this->TARIF_NAME->FormValue)) {
                $this->TARIF_NAME->addErrorMessage(str_replace("%s", $this->TARIF_NAME->caption(), $this->TARIF_NAME->RequiredErrorMessage));
            }
        }
        if ($this->CLASS_ID->Required) {
            if (!$this->CLASS_ID->IsDetailKey && EmptyValue($this->CLASS_ID->FormValue)) {
                $this->CLASS_ID->addErrorMessage(str_replace("%s", $this->CLASS_ID->caption(), $this->CLASS_ID->RequiredErrorMessage));
            }
        }
        if ($this->LEVEL_ID->Required) {
            if (!$this->LEVEL_ID->IsDetailKey && EmptyValue($this->LEVEL_ID->FormValue)) {
                $this->LEVEL_ID->addErrorMessage(str_replace("%s", $this->LEVEL_ID->caption(), $this->LEVEL_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->LEVEL_ID->FormValue)) {
            $this->LEVEL_ID->addErrorMessage($this->LEVEL_ID->getErrorMessage(false));
        }
        if ($this->OTHER_ID->Required) {
            if (!$this->OTHER_ID->IsDetailKey && EmptyValue($this->OTHER_ID->FormValue)) {
                $this->OTHER_ID->addErrorMessage(str_replace("%s", $this->OTHER_ID->caption(), $this->OTHER_ID->RequiredErrorMessage));
            }
        }
        if ($this->TARIF_TYPE->Required) {
            if (!$this->TARIF_TYPE->IsDetailKey && EmptyValue($this->TARIF_TYPE->FormValue)) {
                $this->TARIF_TYPE->addErrorMessage(str_replace("%s", $this->TARIF_TYPE->caption(), $this->TARIF_TYPE->RequiredErrorMessage));
            }
        }
        if ($this->DESCRIPTION->Required) {
            if (!$this->DESCRIPTION->IsDetailKey && EmptyValue($this->DESCRIPTION->FormValue)) {
                $this->DESCRIPTION->addErrorMessage(str_replace("%s", $this->DESCRIPTION->caption(), $this->DESCRIPTION->RequiredErrorMessage));
            }
        }
        if ($this->IMPLEMENTED->Required) {
            if (!$this->IMPLEMENTED->IsDetailKey && EmptyValue($this->IMPLEMENTED->FormValue)) {
                $this->IMPLEMENTED->addErrorMessage(str_replace("%s", $this->IMPLEMENTED->caption(), $this->IMPLEMENTED->RequiredErrorMessage));
            }
        }
        if ($this->ACTIVITY_ID->Required) {
            if (!$this->ACTIVITY_ID->IsDetailKey && EmptyValue($this->ACTIVITY_ID->FormValue)) {
                $this->ACTIVITY_ID->addErrorMessage(str_replace("%s", $this->ACTIVITY_ID->caption(), $this->ACTIVITY_ID->RequiredErrorMessage));
            }
        }
        if ($this->AMOUNT_PAID->Required) {
            if (!$this->AMOUNT_PAID->IsDetailKey && EmptyValue($this->AMOUNT_PAID->FormValue)) {
                $this->AMOUNT_PAID->addErrorMessage(str_replace("%s", $this->AMOUNT_PAID->caption(), $this->AMOUNT_PAID->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->AMOUNT_PAID->FormValue)) {
            $this->AMOUNT_PAID->addErrorMessage($this->AMOUNT_PAID->getErrorMessage(false));
        }
        if ($this->MODIFIED_BY->Required) {
            if (!$this->MODIFIED_BY->IsDetailKey && EmptyValue($this->MODIFIED_BY->FormValue)) {
                $this->MODIFIED_BY->addErrorMessage(str_replace("%s", $this->MODIFIED_BY->caption(), $this->MODIFIED_BY->RequiredErrorMessage));
            }
        }
        if ($this->CASEMIX_ID->Required) {
            if (!$this->CASEMIX_ID->IsDetailKey && EmptyValue($this->CASEMIX_ID->FormValue)) {
                $this->CASEMIX_ID->addErrorMessage(str_replace("%s", $this->CASEMIX_ID->caption(), $this->CASEMIX_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->CASEMIX_ID->FormValue)) {
            $this->CASEMIX_ID->addErrorMessage($this->CASEMIX_ID->getErrorMessage(false));
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

        // KODE
        $this->KODE->setDbValueDef($rsnew, $this->KODE->CurrentValue, null, false);

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->CurrentValue = CurrentOrgId();
        $this->ORG_UNIT_CODE->setDbValueDef($rsnew, $this->ORG_UNIT_CODE->CurrentValue, "");

        // TARIF_ID
        $this->TARIF_ID->setDbValueDef($rsnew, $this->TARIF_ID->CurrentValue, "", false);

        // PERDA_ID
        $this->PERDA_ID->setDbValueDef($rsnew, $this->PERDA_ID->CurrentValue, null, false);

        // TREAT_ID
        $this->TREAT_ID->setDbValueDef($rsnew, $this->TREAT_ID->CurrentValue, "", false);

        // DISPLAY_TARIF
        $this->DISPLAY_TARIF->setDbValueDef($rsnew, $this->DISPLAY_TARIF->CurrentValue, null, false);

        // TARIF_NAME
        $this->TARIF_NAME->setDbValueDef($rsnew, $this->TARIF_NAME->CurrentValue, null, false);

        // CLASS_ID
        $this->CLASS_ID->setDbValueDef($rsnew, $this->CLASS_ID->CurrentValue, null, false);

        // LEVEL_ID
        $this->LEVEL_ID->setDbValueDef($rsnew, $this->LEVEL_ID->CurrentValue, null, false);

        // OTHER_ID
        $this->OTHER_ID->setDbValueDef($rsnew, $this->OTHER_ID->CurrentValue, null, false);

        // TARIF_TYPE
        $this->TARIF_TYPE->setDbValueDef($rsnew, $this->TARIF_TYPE->CurrentValue, null, false);

        // DESCRIPTION
        $this->DESCRIPTION->setDbValueDef($rsnew, $this->DESCRIPTION->CurrentValue, null, false);

        // IMPLEMENTED
        $this->IMPLEMENTED->setDbValueDef($rsnew, $this->IMPLEMENTED->CurrentValue, null, false);

        // ACTIVITY_ID
        $this->ACTIVITY_ID->setDbValueDef($rsnew, $this->ACTIVITY_ID->CurrentValue, null, false);

        // AMOUNT_PAID
        $this->AMOUNT_PAID->setDbValueDef($rsnew, $this->AMOUNT_PAID->CurrentValue, null, false);

        // MODIFIED_BY
        $this->MODIFIED_BY->setDbValueDef($rsnew, $this->MODIFIED_BY->CurrentValue, null, false);

        // CASEMIX_ID
        $this->CASEMIX_ID->setDbValueDef($rsnew, $this->CASEMIX_ID->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['ORG_UNIT_CODE']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['TARIF_ID']) == "") {
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("TreatTarifList"), "", $this->TableVar, true);
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
                case "x_PERDA_ID":
                    break;
                case "x_CLASS_ID":
                    break;
                case "x_TARIF_TYPE":
                    break;
                case "x_IMPLEMENTED":
                    break;
                case "x_ACTIVITY_ID":
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
