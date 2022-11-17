<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienDiagnosaAdd extends PasienDiagnosa
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'PASIEN_DIAGNOSA';

    // Page object name
    public $PageObjName = "PasienDiagnosaAdd";

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

        // Table object (PASIEN_DIAGNOSA)
        if (!isset($GLOBALS["PASIEN_DIAGNOSA"]) || get_class($GLOBALS["PASIEN_DIAGNOSA"]) == PROJECT_NAMESPACE . "PASIEN_DIAGNOSA") {
            $GLOBALS["PASIEN_DIAGNOSA"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'PASIEN_DIAGNOSA');
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
                $doc = new $class(Container("PASIEN_DIAGNOSA"));
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
                    if ($pageName == "PasienDiagnosaView") {
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;
    public $MultiPages; // Multi pages object

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
        $this->ORG_UNIT_CODE->Visible = false;
        $this->PASIEN_DIAGNOSA_ID->Visible = false;
        $this->NO_REGISTRATION->setVisibility();
        $this->THENAME->setVisibility();
        $this->VISIT_ID->Visible = false;
        $this->CLINIC_ID->Visible = false;
        $this->BILL_ID->Visible = false;
        $this->CLASS_ROOM_ID->Visible = false;
        $this->IN_DATE->Visible = false;
        $this->EXIT_DATE->Visible = false;
        $this->BED_ID->Visible = false;
        $this->KELUAR_ID->setVisibility();
        $this->DATE_OF_DIAGNOSA->setVisibility();
        $this->REPORT_DATE->Visible = false;
        $this->DIAGNOSA_ID->setVisibility();
        $this->DIAGNOSA_DESC->Visible = false;
        $this->ANAMNASE->setVisibility();
        $this->PEMERIKSAAN->setVisibility();
        $this->TERAPHY_DESC->setVisibility();
        $this->INSTRUCTION->Visible = false;
        $this->SUFFER_TYPE->setVisibility();
        $this->INFECTED_BODY->Visible = false;
        $this->EMPLOYEE_ID->setVisibility();
        $this->RISK_LEVEL->Visible = false;
        $this->MORFOLOGI_NEOPLASMA->setVisibility();
        $this->HURT->Visible = false;
        $this->HURT_TYPE->Visible = false;
        $this->DIAG_CAT->Visible = false;
        $this->ADDICTION_MATERIAL->Visible = false;
        $this->INFECTED_QUANTITY->Visible = false;
        $this->CONTAGIOUS_TYPE->Visible = false;
        $this->CURATIF_ID->Visible = false;
        $this->RESULT_ID->Visible = false;
        $this->INFECTION_TYPE->Visible = false;
        $this->INVESTIGATION_ID->Visible = false;
        $this->DISABILITY->Visible = false;
        $this->DESCRIPTION->setVisibility();
        $this->KOMPLIKASI->setVisibility();
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->MODIFIED_FROM->Visible = false;
        $this->STATUS_PASIEN_ID->Visible = false;
        $this->AGEYEAR->Visible = false;
        $this->AGEMONTH->Visible = false;
        $this->AGEDAY->Visible = false;
        $this->THEADDRESS->Visible = false;
        $this->THEID->Visible = false;
        $this->ISRJ->Visible = false;
        $this->GENDER->Visible = false;
        $this->DOCTOR->Visible = false;
        $this->KAL_ID->Visible = false;
        $this->ACCOUNT_ID->Visible = false;
        $this->DIAGNOSA_ID_02->setVisibility();
        $this->DIAGNOSA_ID_03->setVisibility();
        $this->DIAGNOSA_ID_04->setVisibility();
        $this->DIAGNOSA_ID_05->setVisibility();
        $this->DIAGNOSA_ID_06->setVisibility();
        $this->DIAGNOSA_ID_07->Visible = false;
        $this->DIAGNOSA_ID_08->Visible = false;
        $this->DIAGNOSA_ID_09->setVisibility();
        $this->DIAGNOSA_ID_10->Visible = false;
        $this->PROCEDURE_01->Visible = false;
        $this->PROCEDURE_02->Visible = false;
        $this->PROCEDURE_03->setVisibility();
        $this->PROCEDURE_04->Visible = false;
        $this->PROCEDURE_05->setVisibility();
        $this->PROCEDURE_06->setVisibility();
        $this->PROCEDURE_07->Visible = false;
        $this->PROCEDURE_08->Visible = false;
        $this->PROCEDURE_09->Visible = false;
        $this->PROCEDURE_10->Visible = false;
        $this->DIAGNOSA_ID2->setVisibility();
        $this->WEIGHT->setVisibility();
        $this->NOKARTU->Visible = false;
        $this->NOSEP->Visible = false;
        $this->TGLSEP->Visible = false;
        $this->RENCANATL->Visible = false;
        $this->DIRUJUKKE->Visible = false;
        $this->TGLKONTROL->setVisibility();
        $this->KDPOLI_KONTROL->Visible = false;
        $this->JAMINAN->Visible = false;
        $this->SPESIALISTIK->Visible = false;
        $this->PEMERIKSAAN_02->setVisibility();
        $this->DIAGNOSA_DESC_02->Visible = false;
        $this->DIAGNOSA_DESC_03->Visible = false;
        $this->DIAGNOSA_DESC_04->Visible = false;
        $this->DIAGNOSA_DESC_05->Visible = false;
        $this->DIAGNOSA_DESC_06->Visible = false;
        $this->PROCEDURE_DESC_01->Visible = false;
        $this->PROCEDURE_DESC_02->Visible = false;
        $this->PROCEDURE_DESC_03->Visible = false;
        $this->PROCEDURE_DESC_04->Visible = false;
        $this->PROCEDURE_DESC_05->Visible = false;
        $this->RESPONPOST->Visible = false;
        $this->RESPONPUT->Visible = false;
        $this->RESPONDEL->Visible = false;
        $this->JSONPOST->Visible = false;
        $this->JSONPUT->Visible = false;
        $this->JSONDEL->Visible = false;
        $this->height->setVisibility();
        $this->TEMPERATURE->setVisibility();
        $this->TENSION_UPPER->setVisibility();
        $this->TENSION_BELOW->Visible = false;
        $this->NADI->setVisibility();
        $this->NAFAS->setVisibility();
        $this->spec_procedures->Visible = false;
        $this->spec_drug->Visible = false;
        $this->spec_prothesis->Visible = false;
        $this->spec_investigation->Visible = false;
        $this->procedure_11->Visible = false;
        $this->procedure_12->Visible = false;
        $this->procedure_13->Visible = false;
        $this->procedure_14->Visible = false;
        $this->procedure_15->Visible = false;
        $this->isanestesi->Visible = false;
        $this->isreposisi->Visible = false;
        $this->islab->Visible = false;
        $this->isro->Visible = false;
        $this->isekg->Visible = false;
        $this->ishecting->Visible = false;
        $this->isgips->Visible = false;
        $this->islengkap->Visible = false;
        $this->ID->Visible = false;
        $this->IDXDAFTAR->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Set up multi page object
        $this->setupMultiPages();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->NO_REGISTRATION);
        $this->setupLookupOptions($this->CLINIC_ID);
        $this->setupLookupOptions($this->KELUAR_ID);
        $this->setupLookupOptions($this->DIAGNOSA_ID);
        $this->setupLookupOptions($this->SUFFER_TYPE);
        $this->setupLookupOptions($this->EMPLOYEE_ID);
        $this->setupLookupOptions($this->DIAG_CAT);
        $this->setupLookupOptions($this->INVESTIGATION_ID);
        $this->setupLookupOptions($this->DESCRIPTION);
        $this->setupLookupOptions($this->DIAGNOSA_ID_02);
        $this->setupLookupOptions($this->DIAGNOSA_ID_03);
        $this->setupLookupOptions($this->DIAGNOSA_ID_04);
        $this->setupLookupOptions($this->DIAGNOSA_ID_05);
        $this->setupLookupOptions($this->DIAGNOSA_ID_06);

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
            if (($keyValue = Get("ID") ?? Route("ID")) !== null) {
                $this->ID->setQueryStringValue($keyValue);
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

        // Set up master/detail parameters
        // NOTE: must be after loadOldRecord to prevent master key values overwritten
        $this->setupMasterParms();

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
                    $this->terminate("PasienDiagnosaList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "PasienDiagnosaList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PasienDiagnosaView") {
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
        $this->ORG_UNIT_CODE->CurrentValue = CurrentOrgId();
        $this->PASIEN_DIAGNOSA_ID->CurrentValue = VisitId();
        $this->NO_REGISTRATION->CurrentValue = null;
        $this->NO_REGISTRATION->OldValue = $this->NO_REGISTRATION->CurrentValue;
        $this->THENAME->CurrentValue = null;
        $this->THENAME->OldValue = $this->THENAME->CurrentValue;
        $this->VISIT_ID->CurrentValue = null;
        $this->VISIT_ID->OldValue = $this->VISIT_ID->CurrentValue;
        $this->CLINIC_ID->CurrentValue = null;
        $this->CLINIC_ID->OldValue = $this->CLINIC_ID->CurrentValue;
        $this->BILL_ID->CurrentValue = null;
        $this->BILL_ID->OldValue = $this->BILL_ID->CurrentValue;
        $this->CLASS_ROOM_ID->CurrentValue = null;
        $this->CLASS_ROOM_ID->OldValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->IN_DATE->CurrentValue = null;
        $this->IN_DATE->OldValue = $this->IN_DATE->CurrentValue;
        $this->EXIT_DATE->CurrentValue = null;
        $this->EXIT_DATE->OldValue = $this->EXIT_DATE->CurrentValue;
        $this->BED_ID->CurrentValue = null;
        $this->BED_ID->OldValue = $this->BED_ID->CurrentValue;
        $this->KELUAR_ID->CurrentValue = null;
        $this->KELUAR_ID->OldValue = $this->KELUAR_ID->CurrentValue;
        $this->DATE_OF_DIAGNOSA->CurrentValue = CurrentDateTime();
        $this->REPORT_DATE->CurrentValue = null;
        $this->REPORT_DATE->OldValue = $this->REPORT_DATE->CurrentValue;
        $this->DIAGNOSA_ID->CurrentValue = null;
        $this->DIAGNOSA_ID->OldValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_DESC->CurrentValue = null;
        $this->DIAGNOSA_DESC->OldValue = $this->DIAGNOSA_DESC->CurrentValue;
        $this->ANAMNASE->CurrentValue = null;
        $this->ANAMNASE->OldValue = $this->ANAMNASE->CurrentValue;
        $this->PEMERIKSAAN->CurrentValue = null;
        $this->PEMERIKSAAN->OldValue = $this->PEMERIKSAAN->CurrentValue;
        $this->TERAPHY_DESC->CurrentValue = null;
        $this->TERAPHY_DESC->OldValue = $this->TERAPHY_DESC->CurrentValue;
        $this->INSTRUCTION->CurrentValue = null;
        $this->INSTRUCTION->OldValue = $this->INSTRUCTION->CurrentValue;
        $this->SUFFER_TYPE->CurrentValue = null;
        $this->SUFFER_TYPE->OldValue = $this->SUFFER_TYPE->CurrentValue;
        $this->INFECTED_BODY->CurrentValue = null;
        $this->INFECTED_BODY->OldValue = $this->INFECTED_BODY->CurrentValue;
        $this->EMPLOYEE_ID->CurrentValue = null;
        $this->EMPLOYEE_ID->OldValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->RISK_LEVEL->CurrentValue = null;
        $this->RISK_LEVEL->OldValue = $this->RISK_LEVEL->CurrentValue;
        $this->MORFOLOGI_NEOPLASMA->CurrentValue = null;
        $this->MORFOLOGI_NEOPLASMA->OldValue = $this->MORFOLOGI_NEOPLASMA->CurrentValue;
        $this->HURT->CurrentValue = null;
        $this->HURT->OldValue = $this->HURT->CurrentValue;
        $this->HURT_TYPE->CurrentValue = null;
        $this->HURT_TYPE->OldValue = $this->HURT_TYPE->CurrentValue;
        $this->DIAG_CAT->CurrentValue = null;
        $this->DIAG_CAT->OldValue = $this->DIAG_CAT->CurrentValue;
        $this->ADDICTION_MATERIAL->CurrentValue = null;
        $this->ADDICTION_MATERIAL->OldValue = $this->ADDICTION_MATERIAL->CurrentValue;
        $this->INFECTED_QUANTITY->CurrentValue = null;
        $this->INFECTED_QUANTITY->OldValue = $this->INFECTED_QUANTITY->CurrentValue;
        $this->CONTAGIOUS_TYPE->CurrentValue = null;
        $this->CONTAGIOUS_TYPE->OldValue = $this->CONTAGIOUS_TYPE->CurrentValue;
        $this->CURATIF_ID->CurrentValue = null;
        $this->CURATIF_ID->OldValue = $this->CURATIF_ID->CurrentValue;
        $this->RESULT_ID->CurrentValue = null;
        $this->RESULT_ID->OldValue = $this->RESULT_ID->CurrentValue;
        $this->INFECTION_TYPE->CurrentValue = null;
        $this->INFECTION_TYPE->OldValue = $this->INFECTION_TYPE->CurrentValue;
        $this->INVESTIGATION_ID->CurrentValue = null;
        $this->INVESTIGATION_ID->OldValue = $this->INVESTIGATION_ID->CurrentValue;
        $this->DISABILITY->CurrentValue = null;
        $this->DISABILITY->OldValue = $this->DISABILITY->CurrentValue;
        $this->DESCRIPTION->CurrentValue = null;
        $this->DESCRIPTION->OldValue = $this->DESCRIPTION->CurrentValue;
        $this->KOMPLIKASI->CurrentValue = null;
        $this->KOMPLIKASI->OldValue = $this->KOMPLIKASI->CurrentValue;
        $this->MODIFIED_DATE->CurrentValue = null;
        $this->MODIFIED_DATE->OldValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_BY->CurrentValue = null;
        $this->MODIFIED_BY->OldValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_FROM->CurrentValue = null;
        $this->MODIFIED_FROM->OldValue = $this->MODIFIED_FROM->CurrentValue;
        $this->STATUS_PASIEN_ID->CurrentValue = null;
        $this->STATUS_PASIEN_ID->OldValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->AGEYEAR->CurrentValue = null;
        $this->AGEYEAR->OldValue = $this->AGEYEAR->CurrentValue;
        $this->AGEMONTH->CurrentValue = null;
        $this->AGEMONTH->OldValue = $this->AGEMONTH->CurrentValue;
        $this->AGEDAY->CurrentValue = null;
        $this->AGEDAY->OldValue = $this->AGEDAY->CurrentValue;
        $this->THEADDRESS->CurrentValue = null;
        $this->THEADDRESS->OldValue = $this->THEADDRESS->CurrentValue;
        $this->THEID->CurrentValue = null;
        $this->THEID->OldValue = $this->THEID->CurrentValue;
        $this->ISRJ->CurrentValue = 1;
        $this->GENDER->CurrentValue = null;
        $this->GENDER->OldValue = $this->GENDER->CurrentValue;
        $this->DOCTOR->CurrentValue = null;
        $this->DOCTOR->OldValue = $this->DOCTOR->CurrentValue;
        $this->KAL_ID->CurrentValue = null;
        $this->KAL_ID->OldValue = $this->KAL_ID->CurrentValue;
        $this->ACCOUNT_ID->CurrentValue = null;
        $this->ACCOUNT_ID->OldValue = $this->ACCOUNT_ID->CurrentValue;
        $this->DIAGNOSA_ID_02->CurrentValue = null;
        $this->DIAGNOSA_ID_02->OldValue = $this->DIAGNOSA_ID_02->CurrentValue;
        $this->DIAGNOSA_ID_03->CurrentValue = null;
        $this->DIAGNOSA_ID_03->OldValue = $this->DIAGNOSA_ID_03->CurrentValue;
        $this->DIAGNOSA_ID_04->CurrentValue = null;
        $this->DIAGNOSA_ID_04->OldValue = $this->DIAGNOSA_ID_04->CurrentValue;
        $this->DIAGNOSA_ID_05->CurrentValue = null;
        $this->DIAGNOSA_ID_05->OldValue = $this->DIAGNOSA_ID_05->CurrentValue;
        $this->DIAGNOSA_ID_06->CurrentValue = null;
        $this->DIAGNOSA_ID_06->OldValue = $this->DIAGNOSA_ID_06->CurrentValue;
        $this->DIAGNOSA_ID_07->CurrentValue = null;
        $this->DIAGNOSA_ID_07->OldValue = $this->DIAGNOSA_ID_07->CurrentValue;
        $this->DIAGNOSA_ID_08->CurrentValue = null;
        $this->DIAGNOSA_ID_08->OldValue = $this->DIAGNOSA_ID_08->CurrentValue;
        $this->DIAGNOSA_ID_09->CurrentValue = null;
        $this->DIAGNOSA_ID_09->OldValue = $this->DIAGNOSA_ID_09->CurrentValue;
        $this->DIAGNOSA_ID_10->CurrentValue = null;
        $this->DIAGNOSA_ID_10->OldValue = $this->DIAGNOSA_ID_10->CurrentValue;
        $this->PROCEDURE_01->CurrentValue = null;
        $this->PROCEDURE_01->OldValue = $this->PROCEDURE_01->CurrentValue;
        $this->PROCEDURE_02->CurrentValue = null;
        $this->PROCEDURE_02->OldValue = $this->PROCEDURE_02->CurrentValue;
        $this->PROCEDURE_03->CurrentValue = null;
        $this->PROCEDURE_03->OldValue = $this->PROCEDURE_03->CurrentValue;
        $this->PROCEDURE_04->CurrentValue = null;
        $this->PROCEDURE_04->OldValue = $this->PROCEDURE_04->CurrentValue;
        $this->PROCEDURE_05->CurrentValue = null;
        $this->PROCEDURE_05->OldValue = $this->PROCEDURE_05->CurrentValue;
        $this->PROCEDURE_06->CurrentValue = null;
        $this->PROCEDURE_06->OldValue = $this->PROCEDURE_06->CurrentValue;
        $this->PROCEDURE_07->CurrentValue = null;
        $this->PROCEDURE_07->OldValue = $this->PROCEDURE_07->CurrentValue;
        $this->PROCEDURE_08->CurrentValue = null;
        $this->PROCEDURE_08->OldValue = $this->PROCEDURE_08->CurrentValue;
        $this->PROCEDURE_09->CurrentValue = null;
        $this->PROCEDURE_09->OldValue = $this->PROCEDURE_09->CurrentValue;
        $this->PROCEDURE_10->CurrentValue = null;
        $this->PROCEDURE_10->OldValue = $this->PROCEDURE_10->CurrentValue;
        $this->DIAGNOSA_ID2->CurrentValue = null;
        $this->DIAGNOSA_ID2->OldValue = $this->DIAGNOSA_ID2->CurrentValue;
        $this->WEIGHT->CurrentValue = null;
        $this->WEIGHT->OldValue = $this->WEIGHT->CurrentValue;
        $this->NOKARTU->CurrentValue = null;
        $this->NOKARTU->OldValue = $this->NOKARTU->CurrentValue;
        $this->NOSEP->CurrentValue = null;
        $this->NOSEP->OldValue = $this->NOSEP->CurrentValue;
        $this->TGLSEP->CurrentValue = null;
        $this->TGLSEP->OldValue = $this->TGLSEP->CurrentValue;
        $this->RENCANATL->CurrentValue = null;
        $this->RENCANATL->OldValue = $this->RENCANATL->CurrentValue;
        $this->DIRUJUKKE->CurrentValue = null;
        $this->DIRUJUKKE->OldValue = $this->DIRUJUKKE->CurrentValue;
        $this->TGLKONTROL->CurrentValue = null;
        $this->TGLKONTROL->OldValue = $this->TGLKONTROL->CurrentValue;
        $this->KDPOLI_KONTROL->CurrentValue = null;
        $this->KDPOLI_KONTROL->OldValue = $this->KDPOLI_KONTROL->CurrentValue;
        $this->JAMINAN->CurrentValue = null;
        $this->JAMINAN->OldValue = $this->JAMINAN->CurrentValue;
        $this->SPESIALISTIK->CurrentValue = null;
        $this->SPESIALISTIK->OldValue = $this->SPESIALISTIK->CurrentValue;
        $this->PEMERIKSAAN_02->CurrentValue = null;
        $this->PEMERIKSAAN_02->OldValue = $this->PEMERIKSAAN_02->CurrentValue;
        $this->DIAGNOSA_DESC_02->CurrentValue = null;
        $this->DIAGNOSA_DESC_02->OldValue = $this->DIAGNOSA_DESC_02->CurrentValue;
        $this->DIAGNOSA_DESC_03->CurrentValue = null;
        $this->DIAGNOSA_DESC_03->OldValue = $this->DIAGNOSA_DESC_03->CurrentValue;
        $this->DIAGNOSA_DESC_04->CurrentValue = null;
        $this->DIAGNOSA_DESC_04->OldValue = $this->DIAGNOSA_DESC_04->CurrentValue;
        $this->DIAGNOSA_DESC_05->CurrentValue = null;
        $this->DIAGNOSA_DESC_05->OldValue = $this->DIAGNOSA_DESC_05->CurrentValue;
        $this->DIAGNOSA_DESC_06->CurrentValue = null;
        $this->DIAGNOSA_DESC_06->OldValue = $this->DIAGNOSA_DESC_06->CurrentValue;
        $this->PROCEDURE_DESC_01->CurrentValue = null;
        $this->PROCEDURE_DESC_01->OldValue = $this->PROCEDURE_DESC_01->CurrentValue;
        $this->PROCEDURE_DESC_02->CurrentValue = null;
        $this->PROCEDURE_DESC_02->OldValue = $this->PROCEDURE_DESC_02->CurrentValue;
        $this->PROCEDURE_DESC_03->CurrentValue = null;
        $this->PROCEDURE_DESC_03->OldValue = $this->PROCEDURE_DESC_03->CurrentValue;
        $this->PROCEDURE_DESC_04->CurrentValue = null;
        $this->PROCEDURE_DESC_04->OldValue = $this->PROCEDURE_DESC_04->CurrentValue;
        $this->PROCEDURE_DESC_05->CurrentValue = null;
        $this->PROCEDURE_DESC_05->OldValue = $this->PROCEDURE_DESC_05->CurrentValue;
        $this->RESPONPOST->CurrentValue = null;
        $this->RESPONPOST->OldValue = $this->RESPONPOST->CurrentValue;
        $this->RESPONPUT->CurrentValue = null;
        $this->RESPONPUT->OldValue = $this->RESPONPUT->CurrentValue;
        $this->RESPONDEL->CurrentValue = null;
        $this->RESPONDEL->OldValue = $this->RESPONDEL->CurrentValue;
        $this->JSONPOST->CurrentValue = null;
        $this->JSONPOST->OldValue = $this->JSONPOST->CurrentValue;
        $this->JSONPUT->CurrentValue = null;
        $this->JSONPUT->OldValue = $this->JSONPUT->CurrentValue;
        $this->JSONDEL->CurrentValue = null;
        $this->JSONDEL->OldValue = $this->JSONDEL->CurrentValue;
        $this->height->CurrentValue = null;
        $this->height->OldValue = $this->height->CurrentValue;
        $this->TEMPERATURE->CurrentValue = null;
        $this->TEMPERATURE->OldValue = $this->TEMPERATURE->CurrentValue;
        $this->TENSION_UPPER->CurrentValue = null;
        $this->TENSION_UPPER->OldValue = $this->TENSION_UPPER->CurrentValue;
        $this->TENSION_BELOW->CurrentValue = null;
        $this->TENSION_BELOW->OldValue = $this->TENSION_BELOW->CurrentValue;
        $this->NADI->CurrentValue = null;
        $this->NADI->OldValue = $this->NADI->CurrentValue;
        $this->NAFAS->CurrentValue = null;
        $this->NAFAS->OldValue = $this->NAFAS->CurrentValue;
        $this->spec_procedures->CurrentValue = null;
        $this->spec_procedures->OldValue = $this->spec_procedures->CurrentValue;
        $this->spec_drug->CurrentValue = null;
        $this->spec_drug->OldValue = $this->spec_drug->CurrentValue;
        $this->spec_prothesis->CurrentValue = null;
        $this->spec_prothesis->OldValue = $this->spec_prothesis->CurrentValue;
        $this->spec_investigation->CurrentValue = null;
        $this->spec_investigation->OldValue = $this->spec_investigation->CurrentValue;
        $this->procedure_11->CurrentValue = null;
        $this->procedure_11->OldValue = $this->procedure_11->CurrentValue;
        $this->procedure_12->CurrentValue = null;
        $this->procedure_12->OldValue = $this->procedure_12->CurrentValue;
        $this->procedure_13->CurrentValue = null;
        $this->procedure_13->OldValue = $this->procedure_13->CurrentValue;
        $this->procedure_14->CurrentValue = null;
        $this->procedure_14->OldValue = $this->procedure_14->CurrentValue;
        $this->procedure_15->CurrentValue = null;
        $this->procedure_15->OldValue = $this->procedure_15->CurrentValue;
        $this->isanestesi->CurrentValue = null;
        $this->isanestesi->OldValue = $this->isanestesi->CurrentValue;
        $this->isreposisi->CurrentValue = null;
        $this->isreposisi->OldValue = $this->isreposisi->CurrentValue;
        $this->islab->CurrentValue = null;
        $this->islab->OldValue = $this->islab->CurrentValue;
        $this->isro->CurrentValue = null;
        $this->isro->OldValue = $this->isro->CurrentValue;
        $this->isekg->CurrentValue = null;
        $this->isekg->OldValue = $this->isekg->CurrentValue;
        $this->ishecting->CurrentValue = null;
        $this->ishecting->OldValue = $this->ishecting->CurrentValue;
        $this->isgips->CurrentValue = null;
        $this->isgips->OldValue = $this->isgips->CurrentValue;
        $this->islengkap->CurrentValue = null;
        $this->islengkap->OldValue = $this->islengkap->CurrentValue;
        $this->ID->CurrentValue = null;
        $this->ID->OldValue = $this->ID->CurrentValue;
        $this->IDXDAFTAR->CurrentValue = null;
        $this->IDXDAFTAR->OldValue = $this->IDXDAFTAR->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'NO_REGISTRATION' first before field var 'x_NO_REGISTRATION'
        $val = $CurrentForm->hasValue("NO_REGISTRATION") ? $CurrentForm->getValue("NO_REGISTRATION") : $CurrentForm->getValue("x_NO_REGISTRATION");
        if (!$this->NO_REGISTRATION->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_REGISTRATION->Visible = false; // Disable update for API request
            } else {
                $this->NO_REGISTRATION->setFormValue($val);
            }
        }

        // Check field name 'THENAME' first before field var 'x_THENAME'
        $val = $CurrentForm->hasValue("THENAME") ? $CurrentForm->getValue("THENAME") : $CurrentForm->getValue("x_THENAME");
        if (!$this->THENAME->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->THENAME->Visible = false; // Disable update for API request
            } else {
                $this->THENAME->setFormValue($val);
            }
        }

        // Check field name 'KELUAR_ID' first before field var 'x_KELUAR_ID'
        $val = $CurrentForm->hasValue("KELUAR_ID") ? $CurrentForm->getValue("KELUAR_ID") : $CurrentForm->getValue("x_KELUAR_ID");
        if (!$this->KELUAR_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KELUAR_ID->Visible = false; // Disable update for API request
            } else {
                $this->KELUAR_ID->setFormValue($val);
            }
        }

        // Check field name 'DATE_OF_DIAGNOSA' first before field var 'x_DATE_OF_DIAGNOSA'
        $val = $CurrentForm->hasValue("DATE_OF_DIAGNOSA") ? $CurrentForm->getValue("DATE_OF_DIAGNOSA") : $CurrentForm->getValue("x_DATE_OF_DIAGNOSA");
        if (!$this->DATE_OF_DIAGNOSA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DATE_OF_DIAGNOSA->Visible = false; // Disable update for API request
            } else {
                $this->DATE_OF_DIAGNOSA->setFormValue($val);
            }
            $this->DATE_OF_DIAGNOSA->CurrentValue = UnFormatDateTime($this->DATE_OF_DIAGNOSA->CurrentValue, 11);
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

        // Check field name 'ANAMNASE' first before field var 'x_ANAMNASE'
        $val = $CurrentForm->hasValue("ANAMNASE") ? $CurrentForm->getValue("ANAMNASE") : $CurrentForm->getValue("x_ANAMNASE");
        if (!$this->ANAMNASE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ANAMNASE->Visible = false; // Disable update for API request
            } else {
                $this->ANAMNASE->setFormValue($val);
            }
        }

        // Check field name 'PEMERIKSAAN' first before field var 'x_PEMERIKSAAN'
        $val = $CurrentForm->hasValue("PEMERIKSAAN") ? $CurrentForm->getValue("PEMERIKSAAN") : $CurrentForm->getValue("x_PEMERIKSAAN");
        if (!$this->PEMERIKSAAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PEMERIKSAAN->Visible = false; // Disable update for API request
            } else {
                $this->PEMERIKSAAN->setFormValue($val);
            }
        }

        // Check field name 'TERAPHY_DESC' first before field var 'x_TERAPHY_DESC'
        $val = $CurrentForm->hasValue("TERAPHY_DESC") ? $CurrentForm->getValue("TERAPHY_DESC") : $CurrentForm->getValue("x_TERAPHY_DESC");
        if (!$this->TERAPHY_DESC->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TERAPHY_DESC->Visible = false; // Disable update for API request
            } else {
                $this->TERAPHY_DESC->setFormValue($val);
            }
        }

        // Check field name 'SUFFER_TYPE' first before field var 'x_SUFFER_TYPE'
        $val = $CurrentForm->hasValue("SUFFER_TYPE") ? $CurrentForm->getValue("SUFFER_TYPE") : $CurrentForm->getValue("x_SUFFER_TYPE");
        if (!$this->SUFFER_TYPE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SUFFER_TYPE->Visible = false; // Disable update for API request
            } else {
                $this->SUFFER_TYPE->setFormValue($val);
            }
        }

        // Check field name 'EMPLOYEE_ID' first before field var 'x_EMPLOYEE_ID'
        $val = $CurrentForm->hasValue("EMPLOYEE_ID") ? $CurrentForm->getValue("EMPLOYEE_ID") : $CurrentForm->getValue("x_EMPLOYEE_ID");
        if (!$this->EMPLOYEE_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->EMPLOYEE_ID->Visible = false; // Disable update for API request
            } else {
                $this->EMPLOYEE_ID->setFormValue($val);
            }
        }

        // Check field name 'MORFOLOGI_NEOPLASMA' first before field var 'x_MORFOLOGI_NEOPLASMA'
        $val = $CurrentForm->hasValue("MORFOLOGI_NEOPLASMA") ? $CurrentForm->getValue("MORFOLOGI_NEOPLASMA") : $CurrentForm->getValue("x_MORFOLOGI_NEOPLASMA");
        if (!$this->MORFOLOGI_NEOPLASMA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MORFOLOGI_NEOPLASMA->Visible = false; // Disable update for API request
            } else {
                $this->MORFOLOGI_NEOPLASMA->setFormValue($val);
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

        // Check field name 'KOMPLIKASI' first before field var 'x_KOMPLIKASI'
        $val = $CurrentForm->hasValue("KOMPLIKASI") ? $CurrentForm->getValue("KOMPLIKASI") : $CurrentForm->getValue("x_KOMPLIKASI");
        if (!$this->KOMPLIKASI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KOMPLIKASI->Visible = false; // Disable update for API request
            } else {
                $this->KOMPLIKASI->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID_02' first before field var 'x_DIAGNOSA_ID_02'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID_02") ? $CurrentForm->getValue("DIAGNOSA_ID_02") : $CurrentForm->getValue("x_DIAGNOSA_ID_02");
        if (!$this->DIAGNOSA_ID_02->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID_02->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID_02->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID_03' first before field var 'x_DIAGNOSA_ID_03'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID_03") ? $CurrentForm->getValue("DIAGNOSA_ID_03") : $CurrentForm->getValue("x_DIAGNOSA_ID_03");
        if (!$this->DIAGNOSA_ID_03->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID_03->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID_03->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID_04' first before field var 'x_DIAGNOSA_ID_04'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID_04") ? $CurrentForm->getValue("DIAGNOSA_ID_04") : $CurrentForm->getValue("x_DIAGNOSA_ID_04");
        if (!$this->DIAGNOSA_ID_04->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID_04->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID_04->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID_05' first before field var 'x_DIAGNOSA_ID_05'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID_05") ? $CurrentForm->getValue("DIAGNOSA_ID_05") : $CurrentForm->getValue("x_DIAGNOSA_ID_05");
        if (!$this->DIAGNOSA_ID_05->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID_05->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID_05->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID_06' first before field var 'x_DIAGNOSA_ID_06'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID_06") ? $CurrentForm->getValue("DIAGNOSA_ID_06") : $CurrentForm->getValue("x_DIAGNOSA_ID_06");
        if (!$this->DIAGNOSA_ID_06->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID_06->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID_06->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID_09' first before field var 'x_DIAGNOSA_ID_09'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID_09") ? $CurrentForm->getValue("DIAGNOSA_ID_09") : $CurrentForm->getValue("x_DIAGNOSA_ID_09");
        if (!$this->DIAGNOSA_ID_09->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID_09->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID_09->setFormValue($val);
            }
        }

        // Check field name 'PROCEDURE_03' first before field var 'x_PROCEDURE_03'
        $val = $CurrentForm->hasValue("PROCEDURE_03") ? $CurrentForm->getValue("PROCEDURE_03") : $CurrentForm->getValue("x_PROCEDURE_03");
        if (!$this->PROCEDURE_03->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROCEDURE_03->Visible = false; // Disable update for API request
            } else {
                $this->PROCEDURE_03->setFormValue($val);
            }
        }

        // Check field name 'PROCEDURE_05' first before field var 'x_PROCEDURE_05'
        $val = $CurrentForm->hasValue("PROCEDURE_05") ? $CurrentForm->getValue("PROCEDURE_05") : $CurrentForm->getValue("x_PROCEDURE_05");
        if (!$this->PROCEDURE_05->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROCEDURE_05->Visible = false; // Disable update for API request
            } else {
                $this->PROCEDURE_05->setFormValue($val);
            }
        }

        // Check field name 'PROCEDURE_06' first before field var 'x_PROCEDURE_06'
        $val = $CurrentForm->hasValue("PROCEDURE_06") ? $CurrentForm->getValue("PROCEDURE_06") : $CurrentForm->getValue("x_PROCEDURE_06");
        if (!$this->PROCEDURE_06->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROCEDURE_06->Visible = false; // Disable update for API request
            } else {
                $this->PROCEDURE_06->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID2' first before field var 'x_DIAGNOSA_ID2'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID2") ? $CurrentForm->getValue("DIAGNOSA_ID2") : $CurrentForm->getValue("x_DIAGNOSA_ID2");
        if (!$this->DIAGNOSA_ID2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID2->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID2->setFormValue($val);
            }
        }

        // Check field name 'WEIGHT' first before field var 'x_WEIGHT'
        $val = $CurrentForm->hasValue("WEIGHT") ? $CurrentForm->getValue("WEIGHT") : $CurrentForm->getValue("x_WEIGHT");
        if (!$this->WEIGHT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->WEIGHT->Visible = false; // Disable update for API request
            } else {
                $this->WEIGHT->setFormValue($val);
            }
        }

        // Check field name 'TGLKONTROL' first before field var 'x_TGLKONTROL'
        $val = $CurrentForm->hasValue("TGLKONTROL") ? $CurrentForm->getValue("TGLKONTROL") : $CurrentForm->getValue("x_TGLKONTROL");
        if (!$this->TGLKONTROL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TGLKONTROL->Visible = false; // Disable update for API request
            } else {
                $this->TGLKONTROL->setFormValue($val);
            }
            $this->TGLKONTROL->CurrentValue = UnFormatDateTime($this->TGLKONTROL->CurrentValue, 0);
        }

        // Check field name 'PEMERIKSAAN_02' first before field var 'x_PEMERIKSAAN_02'
        $val = $CurrentForm->hasValue("PEMERIKSAAN_02") ? $CurrentForm->getValue("PEMERIKSAAN_02") : $CurrentForm->getValue("x_PEMERIKSAAN_02");
        if (!$this->PEMERIKSAAN_02->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PEMERIKSAAN_02->Visible = false; // Disable update for API request
            } else {
                $this->PEMERIKSAAN_02->setFormValue($val);
            }
        }

        // Check field name 'height' first before field var 'x_height'
        $val = $CurrentForm->hasValue("height") ? $CurrentForm->getValue("height") : $CurrentForm->getValue("x_height");
        if (!$this->height->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->height->Visible = false; // Disable update for API request
            } else {
                $this->height->setFormValue($val);
            }
        }

        // Check field name 'TEMPERATURE' first before field var 'x_TEMPERATURE'
        $val = $CurrentForm->hasValue("TEMPERATURE") ? $CurrentForm->getValue("TEMPERATURE") : $CurrentForm->getValue("x_TEMPERATURE");
        if (!$this->TEMPERATURE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TEMPERATURE->Visible = false; // Disable update for API request
            } else {
                $this->TEMPERATURE->setFormValue($val);
            }
        }

        // Check field name 'TENSION_UPPER' first before field var 'x_TENSION_UPPER'
        $val = $CurrentForm->hasValue("TENSION_UPPER") ? $CurrentForm->getValue("TENSION_UPPER") : $CurrentForm->getValue("x_TENSION_UPPER");
        if (!$this->TENSION_UPPER->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TENSION_UPPER->Visible = false; // Disable update for API request
            } else {
                $this->TENSION_UPPER->setFormValue($val);
            }
        }

        // Check field name 'NADI' first before field var 'x_NADI'
        $val = $CurrentForm->hasValue("NADI") ? $CurrentForm->getValue("NADI") : $CurrentForm->getValue("x_NADI");
        if (!$this->NADI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NADI->Visible = false; // Disable update for API request
            } else {
                $this->NADI->setFormValue($val);
            }
        }

        // Check field name 'NAFAS' first before field var 'x_NAFAS'
        $val = $CurrentForm->hasValue("NAFAS") ? $CurrentForm->getValue("NAFAS") : $CurrentForm->getValue("x_NAFAS");
        if (!$this->NAFAS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAFAS->Visible = false; // Disable update for API request
            } else {
                $this->NAFAS->setFormValue($val);
            }
        }

        // Check field name 'IDXDAFTAR' first before field var 'x_IDXDAFTAR'
        $val = $CurrentForm->hasValue("IDXDAFTAR") ? $CurrentForm->getValue("IDXDAFTAR") : $CurrentForm->getValue("x_IDXDAFTAR");
        if (!$this->IDXDAFTAR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->IDXDAFTAR->Visible = false; // Disable update for API request
            } else {
                $this->IDXDAFTAR->setFormValue($val);
            }
        }

        // Check field name 'ID' first before field var 'x_ID'
        $val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NO_REGISTRATION->CurrentValue = $this->NO_REGISTRATION->FormValue;
        $this->THENAME->CurrentValue = $this->THENAME->FormValue;
        $this->KELUAR_ID->CurrentValue = $this->KELUAR_ID->FormValue;
        $this->DATE_OF_DIAGNOSA->CurrentValue = $this->DATE_OF_DIAGNOSA->FormValue;
        $this->DATE_OF_DIAGNOSA->CurrentValue = UnFormatDateTime($this->DATE_OF_DIAGNOSA->CurrentValue, 11);
        $this->DIAGNOSA_ID->CurrentValue = $this->DIAGNOSA_ID->FormValue;
        $this->ANAMNASE->CurrentValue = $this->ANAMNASE->FormValue;
        $this->PEMERIKSAAN->CurrentValue = $this->PEMERIKSAAN->FormValue;
        $this->TERAPHY_DESC->CurrentValue = $this->TERAPHY_DESC->FormValue;
        $this->SUFFER_TYPE->CurrentValue = $this->SUFFER_TYPE->FormValue;
        $this->EMPLOYEE_ID->CurrentValue = $this->EMPLOYEE_ID->FormValue;
        $this->MORFOLOGI_NEOPLASMA->CurrentValue = $this->MORFOLOGI_NEOPLASMA->FormValue;
        $this->DESCRIPTION->CurrentValue = $this->DESCRIPTION->FormValue;
        $this->KOMPLIKASI->CurrentValue = $this->KOMPLIKASI->FormValue;
        $this->DIAGNOSA_ID_02->CurrentValue = $this->DIAGNOSA_ID_02->FormValue;
        $this->DIAGNOSA_ID_03->CurrentValue = $this->DIAGNOSA_ID_03->FormValue;
        $this->DIAGNOSA_ID_04->CurrentValue = $this->DIAGNOSA_ID_04->FormValue;
        $this->DIAGNOSA_ID_05->CurrentValue = $this->DIAGNOSA_ID_05->FormValue;
        $this->DIAGNOSA_ID_06->CurrentValue = $this->DIAGNOSA_ID_06->FormValue;
        $this->DIAGNOSA_ID_09->CurrentValue = $this->DIAGNOSA_ID_09->FormValue;
        $this->PROCEDURE_03->CurrentValue = $this->PROCEDURE_03->FormValue;
        $this->PROCEDURE_05->CurrentValue = $this->PROCEDURE_05->FormValue;
        $this->PROCEDURE_06->CurrentValue = $this->PROCEDURE_06->FormValue;
        $this->DIAGNOSA_ID2->CurrentValue = $this->DIAGNOSA_ID2->FormValue;
        $this->WEIGHT->CurrentValue = $this->WEIGHT->FormValue;
        $this->TGLKONTROL->CurrentValue = $this->TGLKONTROL->FormValue;
        $this->TGLKONTROL->CurrentValue = UnFormatDateTime($this->TGLKONTROL->CurrentValue, 0);
        $this->PEMERIKSAAN_02->CurrentValue = $this->PEMERIKSAAN_02->FormValue;
        $this->height->CurrentValue = $this->height->FormValue;
        $this->TEMPERATURE->CurrentValue = $this->TEMPERATURE->FormValue;
        $this->TENSION_UPPER->CurrentValue = $this->TENSION_UPPER->FormValue;
        $this->NADI->CurrentValue = $this->NADI->FormValue;
        $this->NAFAS->CurrentValue = $this->NAFAS->FormValue;
        $this->IDXDAFTAR->CurrentValue = $this->IDXDAFTAR->FormValue;
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
        $this->PASIEN_DIAGNOSA_ID->setDbValue($row['PASIEN_DIAGNOSA_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->IN_DATE->setDbValue($row['IN_DATE']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->DATE_OF_DIAGNOSA->setDbValue($row['DATE_OF_DIAGNOSA']);
        $this->REPORT_DATE->setDbValue($row['REPORT_DATE']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->DIAGNOSA_DESC->setDbValue($row['DIAGNOSA_DESC']);
        $this->ANAMNASE->setDbValue($row['ANAMNASE']);
        $this->PEMERIKSAAN->setDbValue($row['PEMERIKSAAN']);
        $this->TERAPHY_DESC->setDbValue($row['TERAPHY_DESC']);
        $this->INSTRUCTION->setDbValue($row['INSTRUCTION']);
        $this->SUFFER_TYPE->setDbValue($row['SUFFER_TYPE']);
        $this->INFECTED_BODY->setDbValue($row['INFECTED_BODY']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->RISK_LEVEL->setDbValue($row['RISK_LEVEL']);
        $this->MORFOLOGI_NEOPLASMA->setDbValue($row['MORFOLOGI_NEOPLASMA']);
        $this->HURT->setDbValue($row['HURT']);
        $this->HURT_TYPE->setDbValue($row['HURT_TYPE']);
        $this->DIAG_CAT->setDbValue($row['DIAG_CAT']);
        $this->ADDICTION_MATERIAL->setDbValue($row['ADDICTION_MATERIAL']);
        $this->INFECTED_QUANTITY->setDbValue($row['INFECTED_QUANTITY']);
        $this->CONTAGIOUS_TYPE->setDbValue($row['CONTAGIOUS_TYPE']);
        $this->CURATIF_ID->setDbValue($row['CURATIF_ID']);
        $this->RESULT_ID->setDbValue($row['RESULT_ID']);
        $this->INFECTION_TYPE->setDbValue($row['INFECTION_TYPE']);
        $this->INVESTIGATION_ID->setDbValue($row['INVESTIGATION_ID']);
        $this->DISABILITY->setDbValue($row['DISABILITY']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->KOMPLIKASI->setDbValue($row['KOMPLIKASI']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEID->setDbValue($row['THEID']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->DIAGNOSA_ID_02->setDbValue($row['DIAGNOSA_ID_02']);
        $this->DIAGNOSA_ID_03->setDbValue($row['DIAGNOSA_ID_03']);
        $this->DIAGNOSA_ID_04->setDbValue($row['DIAGNOSA_ID_04']);
        $this->DIAGNOSA_ID_05->setDbValue($row['DIAGNOSA_ID_05']);
        $this->DIAGNOSA_ID_06->setDbValue($row['DIAGNOSA_ID_06']);
        $this->DIAGNOSA_ID_07->setDbValue($row['DIAGNOSA_ID_07']);
        $this->DIAGNOSA_ID_08->setDbValue($row['DIAGNOSA_ID_08']);
        $this->DIAGNOSA_ID_09->setDbValue($row['DIAGNOSA_ID_09']);
        $this->DIAGNOSA_ID_10->setDbValue($row['DIAGNOSA_ID_10']);
        $this->PROCEDURE_01->setDbValue($row['PROCEDURE_01']);
        $this->PROCEDURE_02->setDbValue($row['PROCEDURE_02']);
        $this->PROCEDURE_03->setDbValue($row['PROCEDURE_03']);
        $this->PROCEDURE_04->setDbValue($row['PROCEDURE_04']);
        $this->PROCEDURE_05->setDbValue($row['PROCEDURE_05']);
        $this->PROCEDURE_06->setDbValue($row['PROCEDURE_06']);
        $this->PROCEDURE_07->setDbValue($row['PROCEDURE_07']);
        $this->PROCEDURE_08->setDbValue($row['PROCEDURE_08']);
        $this->PROCEDURE_09->setDbValue($row['PROCEDURE_09']);
        $this->PROCEDURE_10->setDbValue($row['PROCEDURE_10']);
        $this->DIAGNOSA_ID2->setDbValue($row['DIAGNOSA_ID2']);
        $this->WEIGHT->setDbValue($row['WEIGHT']);
        $this->NOKARTU->setDbValue($row['NOKARTU']);
        $this->NOSEP->setDbValue($row['NOSEP']);
        $this->TGLSEP->setDbValue($row['TGLSEP']);
        $this->RENCANATL->setDbValue($row['RENCANATL']);
        $this->DIRUJUKKE->setDbValue($row['DIRUJUKKE']);
        $this->TGLKONTROL->setDbValue($row['TGLKONTROL']);
        $this->KDPOLI_KONTROL->setDbValue($row['KDPOLI_KONTROL']);
        $this->JAMINAN->setDbValue($row['JAMINAN']);
        $this->SPESIALISTIK->setDbValue($row['SPESIALISTIK']);
        $this->PEMERIKSAAN_02->setDbValue($row['PEMERIKSAAN_02']);
        $this->DIAGNOSA_DESC_02->setDbValue($row['DIAGNOSA_DESC_02']);
        $this->DIAGNOSA_DESC_03->setDbValue($row['DIAGNOSA_DESC_03']);
        $this->DIAGNOSA_DESC_04->setDbValue($row['DIAGNOSA_DESC_04']);
        $this->DIAGNOSA_DESC_05->setDbValue($row['DIAGNOSA_DESC_05']);
        $this->DIAGNOSA_DESC_06->setDbValue($row['DIAGNOSA_DESC_06']);
        $this->PROCEDURE_DESC_01->setDbValue($row['PROCEDURE_DESC_01']);
        $this->PROCEDURE_DESC_02->setDbValue($row['PROCEDURE_DESC_02']);
        $this->PROCEDURE_DESC_03->setDbValue($row['PROCEDURE_DESC_03']);
        $this->PROCEDURE_DESC_04->setDbValue($row['PROCEDURE_DESC_04']);
        $this->PROCEDURE_DESC_05->setDbValue($row['PROCEDURE_DESC_05']);
        $this->RESPONPOST->setDbValue($row['RESPONPOST']);
        $this->RESPONPUT->setDbValue($row['RESPONPUT']);
        $this->RESPONDEL->setDbValue($row['RESPONDEL']);
        $this->JSONPOST->setDbValue($row['JSONPOST']);
        $this->JSONPUT->setDbValue($row['JSONPUT']);
        $this->JSONDEL->setDbValue($row['JSONDEL']);
        $this->height->setDbValue($row['height']);
        $this->TEMPERATURE->setDbValue($row['TEMPERATURE']);
        $this->TENSION_UPPER->setDbValue($row['TENSION_UPPER']);
        $this->TENSION_BELOW->setDbValue($row['TENSION_BELOW']);
        $this->NADI->setDbValue($row['NADI']);
        $this->NAFAS->setDbValue($row['NAFAS']);
        $this->spec_procedures->setDbValue($row['spec_procedures']);
        $this->spec_drug->setDbValue($row['spec_drug']);
        $this->spec_prothesis->setDbValue($row['spec_prothesis']);
        $this->spec_investigation->setDbValue($row['spec_investigation']);
        $this->procedure_11->setDbValue($row['procedure_11']);
        $this->procedure_12->setDbValue($row['procedure_12']);
        $this->procedure_13->setDbValue($row['procedure_13']);
        $this->procedure_14->setDbValue($row['procedure_14']);
        $this->procedure_15->setDbValue($row['procedure_15']);
        $this->isanestesi->setDbValue($row['isanestesi']);
        $this->isreposisi->setDbValue($row['isreposisi']);
        $this->islab->setDbValue($row['islab']);
        $this->isro->setDbValue($row['isro']);
        $this->isekg->setDbValue($row['isekg']);
        $this->ishecting->setDbValue($row['ishecting']);
        $this->isgips->setDbValue($row['isgips']);
        $this->islengkap->setDbValue($row['islengkap']);
        $this->ID->setDbValue($row['ID']);
        $this->IDXDAFTAR->setDbValue($row['IDXDAFTAR']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['ORG_UNIT_CODE'] = $this->ORG_UNIT_CODE->CurrentValue;
        $row['PASIEN_DIAGNOSA_ID'] = $this->PASIEN_DIAGNOSA_ID->CurrentValue;
        $row['NO_REGISTRATION'] = $this->NO_REGISTRATION->CurrentValue;
        $row['THENAME'] = $this->THENAME->CurrentValue;
        $row['VISIT_ID'] = $this->VISIT_ID->CurrentValue;
        $row['CLINIC_ID'] = $this->CLINIC_ID->CurrentValue;
        $row['BILL_ID'] = $this->BILL_ID->CurrentValue;
        $row['CLASS_ROOM_ID'] = $this->CLASS_ROOM_ID->CurrentValue;
        $row['IN_DATE'] = $this->IN_DATE->CurrentValue;
        $row['EXIT_DATE'] = $this->EXIT_DATE->CurrentValue;
        $row['BED_ID'] = $this->BED_ID->CurrentValue;
        $row['KELUAR_ID'] = $this->KELUAR_ID->CurrentValue;
        $row['DATE_OF_DIAGNOSA'] = $this->DATE_OF_DIAGNOSA->CurrentValue;
        $row['REPORT_DATE'] = $this->REPORT_DATE->CurrentValue;
        $row['DIAGNOSA_ID'] = $this->DIAGNOSA_ID->CurrentValue;
        $row['DIAGNOSA_DESC'] = $this->DIAGNOSA_DESC->CurrentValue;
        $row['ANAMNASE'] = $this->ANAMNASE->CurrentValue;
        $row['PEMERIKSAAN'] = $this->PEMERIKSAAN->CurrentValue;
        $row['TERAPHY_DESC'] = $this->TERAPHY_DESC->CurrentValue;
        $row['INSTRUCTION'] = $this->INSTRUCTION->CurrentValue;
        $row['SUFFER_TYPE'] = $this->SUFFER_TYPE->CurrentValue;
        $row['INFECTED_BODY'] = $this->INFECTED_BODY->CurrentValue;
        $row['EMPLOYEE_ID'] = $this->EMPLOYEE_ID->CurrentValue;
        $row['RISK_LEVEL'] = $this->RISK_LEVEL->CurrentValue;
        $row['MORFOLOGI_NEOPLASMA'] = $this->MORFOLOGI_NEOPLASMA->CurrentValue;
        $row['HURT'] = $this->HURT->CurrentValue;
        $row['HURT_TYPE'] = $this->HURT_TYPE->CurrentValue;
        $row['DIAG_CAT'] = $this->DIAG_CAT->CurrentValue;
        $row['ADDICTION_MATERIAL'] = $this->ADDICTION_MATERIAL->CurrentValue;
        $row['INFECTED_QUANTITY'] = $this->INFECTED_QUANTITY->CurrentValue;
        $row['CONTAGIOUS_TYPE'] = $this->CONTAGIOUS_TYPE->CurrentValue;
        $row['CURATIF_ID'] = $this->CURATIF_ID->CurrentValue;
        $row['RESULT_ID'] = $this->RESULT_ID->CurrentValue;
        $row['INFECTION_TYPE'] = $this->INFECTION_TYPE->CurrentValue;
        $row['INVESTIGATION_ID'] = $this->INVESTIGATION_ID->CurrentValue;
        $row['DISABILITY'] = $this->DISABILITY->CurrentValue;
        $row['DESCRIPTION'] = $this->DESCRIPTION->CurrentValue;
        $row['KOMPLIKASI'] = $this->KOMPLIKASI->CurrentValue;
        $row['MODIFIED_DATE'] = $this->MODIFIED_DATE->CurrentValue;
        $row['MODIFIED_BY'] = $this->MODIFIED_BY->CurrentValue;
        $row['MODIFIED_FROM'] = $this->MODIFIED_FROM->CurrentValue;
        $row['STATUS_PASIEN_ID'] = $this->STATUS_PASIEN_ID->CurrentValue;
        $row['AGEYEAR'] = $this->AGEYEAR->CurrentValue;
        $row['AGEMONTH'] = $this->AGEMONTH->CurrentValue;
        $row['AGEDAY'] = $this->AGEDAY->CurrentValue;
        $row['THEADDRESS'] = $this->THEADDRESS->CurrentValue;
        $row['THEID'] = $this->THEID->CurrentValue;
        $row['ISRJ'] = $this->ISRJ->CurrentValue;
        $row['GENDER'] = $this->GENDER->CurrentValue;
        $row['DOCTOR'] = $this->DOCTOR->CurrentValue;
        $row['KAL_ID'] = $this->KAL_ID->CurrentValue;
        $row['ACCOUNT_ID'] = $this->ACCOUNT_ID->CurrentValue;
        $row['DIAGNOSA_ID_02'] = $this->DIAGNOSA_ID_02->CurrentValue;
        $row['DIAGNOSA_ID_03'] = $this->DIAGNOSA_ID_03->CurrentValue;
        $row['DIAGNOSA_ID_04'] = $this->DIAGNOSA_ID_04->CurrentValue;
        $row['DIAGNOSA_ID_05'] = $this->DIAGNOSA_ID_05->CurrentValue;
        $row['DIAGNOSA_ID_06'] = $this->DIAGNOSA_ID_06->CurrentValue;
        $row['DIAGNOSA_ID_07'] = $this->DIAGNOSA_ID_07->CurrentValue;
        $row['DIAGNOSA_ID_08'] = $this->DIAGNOSA_ID_08->CurrentValue;
        $row['DIAGNOSA_ID_09'] = $this->DIAGNOSA_ID_09->CurrentValue;
        $row['DIAGNOSA_ID_10'] = $this->DIAGNOSA_ID_10->CurrentValue;
        $row['PROCEDURE_01'] = $this->PROCEDURE_01->CurrentValue;
        $row['PROCEDURE_02'] = $this->PROCEDURE_02->CurrentValue;
        $row['PROCEDURE_03'] = $this->PROCEDURE_03->CurrentValue;
        $row['PROCEDURE_04'] = $this->PROCEDURE_04->CurrentValue;
        $row['PROCEDURE_05'] = $this->PROCEDURE_05->CurrentValue;
        $row['PROCEDURE_06'] = $this->PROCEDURE_06->CurrentValue;
        $row['PROCEDURE_07'] = $this->PROCEDURE_07->CurrentValue;
        $row['PROCEDURE_08'] = $this->PROCEDURE_08->CurrentValue;
        $row['PROCEDURE_09'] = $this->PROCEDURE_09->CurrentValue;
        $row['PROCEDURE_10'] = $this->PROCEDURE_10->CurrentValue;
        $row['DIAGNOSA_ID2'] = $this->DIAGNOSA_ID2->CurrentValue;
        $row['WEIGHT'] = $this->WEIGHT->CurrentValue;
        $row['NOKARTU'] = $this->NOKARTU->CurrentValue;
        $row['NOSEP'] = $this->NOSEP->CurrentValue;
        $row['TGLSEP'] = $this->TGLSEP->CurrentValue;
        $row['RENCANATL'] = $this->RENCANATL->CurrentValue;
        $row['DIRUJUKKE'] = $this->DIRUJUKKE->CurrentValue;
        $row['TGLKONTROL'] = $this->TGLKONTROL->CurrentValue;
        $row['KDPOLI_KONTROL'] = $this->KDPOLI_KONTROL->CurrentValue;
        $row['JAMINAN'] = $this->JAMINAN->CurrentValue;
        $row['SPESIALISTIK'] = $this->SPESIALISTIK->CurrentValue;
        $row['PEMERIKSAAN_02'] = $this->PEMERIKSAAN_02->CurrentValue;
        $row['DIAGNOSA_DESC_02'] = $this->DIAGNOSA_DESC_02->CurrentValue;
        $row['DIAGNOSA_DESC_03'] = $this->DIAGNOSA_DESC_03->CurrentValue;
        $row['DIAGNOSA_DESC_04'] = $this->DIAGNOSA_DESC_04->CurrentValue;
        $row['DIAGNOSA_DESC_05'] = $this->DIAGNOSA_DESC_05->CurrentValue;
        $row['DIAGNOSA_DESC_06'] = $this->DIAGNOSA_DESC_06->CurrentValue;
        $row['PROCEDURE_DESC_01'] = $this->PROCEDURE_DESC_01->CurrentValue;
        $row['PROCEDURE_DESC_02'] = $this->PROCEDURE_DESC_02->CurrentValue;
        $row['PROCEDURE_DESC_03'] = $this->PROCEDURE_DESC_03->CurrentValue;
        $row['PROCEDURE_DESC_04'] = $this->PROCEDURE_DESC_04->CurrentValue;
        $row['PROCEDURE_DESC_05'] = $this->PROCEDURE_DESC_05->CurrentValue;
        $row['RESPONPOST'] = $this->RESPONPOST->CurrentValue;
        $row['RESPONPUT'] = $this->RESPONPUT->CurrentValue;
        $row['RESPONDEL'] = $this->RESPONDEL->CurrentValue;
        $row['JSONPOST'] = $this->JSONPOST->CurrentValue;
        $row['JSONPUT'] = $this->JSONPUT->CurrentValue;
        $row['JSONDEL'] = $this->JSONDEL->CurrentValue;
        $row['height'] = $this->height->CurrentValue;
        $row['TEMPERATURE'] = $this->TEMPERATURE->CurrentValue;
        $row['TENSION_UPPER'] = $this->TENSION_UPPER->CurrentValue;
        $row['TENSION_BELOW'] = $this->TENSION_BELOW->CurrentValue;
        $row['NADI'] = $this->NADI->CurrentValue;
        $row['NAFAS'] = $this->NAFAS->CurrentValue;
        $row['spec_procedures'] = $this->spec_procedures->CurrentValue;
        $row['spec_drug'] = $this->spec_drug->CurrentValue;
        $row['spec_prothesis'] = $this->spec_prothesis->CurrentValue;
        $row['spec_investigation'] = $this->spec_investigation->CurrentValue;
        $row['procedure_11'] = $this->procedure_11->CurrentValue;
        $row['procedure_12'] = $this->procedure_12->CurrentValue;
        $row['procedure_13'] = $this->procedure_13->CurrentValue;
        $row['procedure_14'] = $this->procedure_14->CurrentValue;
        $row['procedure_15'] = $this->procedure_15->CurrentValue;
        $row['isanestesi'] = $this->isanestesi->CurrentValue;
        $row['isreposisi'] = $this->isreposisi->CurrentValue;
        $row['islab'] = $this->islab->CurrentValue;
        $row['isro'] = $this->isro->CurrentValue;
        $row['isekg'] = $this->isekg->CurrentValue;
        $row['ishecting'] = $this->ishecting->CurrentValue;
        $row['isgips'] = $this->isgips->CurrentValue;
        $row['islengkap'] = $this->islengkap->CurrentValue;
        $row['ID'] = $this->ID->CurrentValue;
        $row['IDXDAFTAR'] = $this->IDXDAFTAR->CurrentValue;
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
        if ($this->WEIGHT->FormValue == $this->WEIGHT->CurrentValue && is_numeric(ConvertToFloatString($this->WEIGHT->CurrentValue))) {
            $this->WEIGHT->CurrentValue = ConvertToFloatString($this->WEIGHT->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->TEMPERATURE->FormValue == $this->TEMPERATURE->CurrentValue && is_numeric(ConvertToFloatString($this->TEMPERATURE->CurrentValue))) {
            $this->TEMPERATURE->CurrentValue = ConvertToFloatString($this->TEMPERATURE->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->TENSION_UPPER->FormValue == $this->TENSION_UPPER->CurrentValue && is_numeric(ConvertToFloatString($this->TENSION_UPPER->CurrentValue))) {
            $this->TENSION_UPPER->CurrentValue = ConvertToFloatString($this->TENSION_UPPER->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->NADI->FormValue == $this->NADI->CurrentValue && is_numeric(ConvertToFloatString($this->NADI->CurrentValue))) {
            $this->NADI->CurrentValue = ConvertToFloatString($this->NADI->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->NAFAS->FormValue == $this->NAFAS->CurrentValue && is_numeric(ConvertToFloatString($this->NAFAS->CurrentValue))) {
            $this->NAFAS->CurrentValue = ConvertToFloatString($this->NAFAS->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE

        // PASIEN_DIAGNOSA_ID

        // NO_REGISTRATION

        // THENAME

        // VISIT_ID

        // CLINIC_ID

        // BILL_ID

        // CLASS_ROOM_ID

        // IN_DATE

        // EXIT_DATE

        // BED_ID

        // KELUAR_ID

        // DATE_OF_DIAGNOSA

        // REPORT_DATE

        // DIAGNOSA_ID

        // DIAGNOSA_DESC

        // ANAMNASE

        // PEMERIKSAAN

        // TERAPHY_DESC

        // INSTRUCTION

        // SUFFER_TYPE

        // INFECTED_BODY

        // EMPLOYEE_ID

        // RISK_LEVEL

        // MORFOLOGI_NEOPLASMA

        // HURT

        // HURT_TYPE

        // DIAG_CAT

        // ADDICTION_MATERIAL

        // INFECTED_QUANTITY

        // CONTAGIOUS_TYPE

        // CURATIF_ID

        // RESULT_ID

        // INFECTION_TYPE

        // INVESTIGATION_ID

        // DISABILITY

        // DESCRIPTION

        // KOMPLIKASI

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // STATUS_PASIEN_ID

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // THEADDRESS

        // THEID

        // ISRJ

        // GENDER

        // DOCTOR

        // KAL_ID

        // ACCOUNT_ID

        // DIAGNOSA_ID_02

        // DIAGNOSA_ID_03

        // DIAGNOSA_ID_04

        // DIAGNOSA_ID_05

        // DIAGNOSA_ID_06

        // DIAGNOSA_ID_07

        // DIAGNOSA_ID_08

        // DIAGNOSA_ID_09

        // DIAGNOSA_ID_10

        // PROCEDURE_01

        // PROCEDURE_02

        // PROCEDURE_03

        // PROCEDURE_04

        // PROCEDURE_05

        // PROCEDURE_06

        // PROCEDURE_07

        // PROCEDURE_08

        // PROCEDURE_09

        // PROCEDURE_10

        // DIAGNOSA_ID2

        // WEIGHT

        // NOKARTU

        // NOSEP

        // TGLSEP

        // RENCANATL

        // DIRUJUKKE

        // TGLKONTROL

        // KDPOLI_KONTROL

        // JAMINAN

        // SPESIALISTIK

        // PEMERIKSAAN_02

        // DIAGNOSA_DESC_02

        // DIAGNOSA_DESC_03

        // DIAGNOSA_DESC_04

        // DIAGNOSA_DESC_05

        // DIAGNOSA_DESC_06

        // PROCEDURE_DESC_01

        // PROCEDURE_DESC_02

        // PROCEDURE_DESC_03

        // PROCEDURE_DESC_04

        // PROCEDURE_DESC_05

        // RESPONPOST

        // RESPONPUT

        // RESPONDEL

        // JSONPOST

        // JSONPUT

        // JSONDEL

        // height

        // TEMPERATURE

        // TENSION_UPPER

        // TENSION_BELOW

        // NADI

        // NAFAS

        // spec_procedures

        // spec_drug

        // spec_prothesis

        // spec_investigation

        // procedure_11

        // procedure_12

        // procedure_13

        // procedure_14

        // procedure_15

        // isanestesi

        // isreposisi

        // islab

        // isro

        // isekg

        // ishecting

        // isgips

        // islengkap

        // ID

        // IDXDAFTAR
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // PASIEN_DIAGNOSA_ID
            $this->PASIEN_DIAGNOSA_ID->ViewValue = $this->PASIEN_DIAGNOSA_ID->CurrentValue;
            $this->PASIEN_DIAGNOSA_ID->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $curVal = trim(strval($this->NO_REGISTRATION->CurrentValue));
            if ($curVal != "") {
                $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->lookupCacheOption($curVal);
                if ($this->NO_REGISTRATION->ViewValue === null) { // Lookup from database
                    $filterWrk = "[NO_REGISTRATION]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->NO_REGISTRATION->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->NO_REGISTRATION->Lookup->renderViewRow($rswrk[0]);
                        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->displayValue($arwrk);
                    } else {
                        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
                    }
                }
            } else {
                $this->NO_REGISTRATION->ViewValue = null;
            }
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // THENAME
            $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
            $this->THENAME->ViewCustomAttributes = "";

            // VISIT_ID
            $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
            $this->VISIT_ID->ViewCustomAttributes = "";

            // CLINIC_ID
            $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
                if ($this->CLINIC_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLINIC_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->displayValue($arwrk);
                    } else {
                        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
                    }
                }
            } else {
                $this->CLINIC_ID->ViewValue = null;
            }
            $this->CLINIC_ID->ViewCustomAttributes = "";

            // BILL_ID
            $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
            $this->BILL_ID->ViewCustomAttributes = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
            $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

            // IN_DATE
            $this->IN_DATE->ViewValue = $this->IN_DATE->CurrentValue;
            $this->IN_DATE->ViewValue = FormatDateTime($this->IN_DATE->ViewValue, 0);
            $this->IN_DATE->ViewCustomAttributes = "";

            // EXIT_DATE
            $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
            $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
            $this->EXIT_DATE->ViewCustomAttributes = "";

            // BED_ID
            $this->BED_ID->ViewValue = $this->BED_ID->CurrentValue;
            $this->BED_ID->ViewValue = FormatNumber($this->BED_ID->ViewValue, 0, -2, -2, -2);
            $this->BED_ID->ViewCustomAttributes = "";

            // KELUAR_ID
            $curVal = trim(strval($this->KELUAR_ID->CurrentValue));
            if ($curVal != "") {
                $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->lookupCacheOption($curVal);
                if ($this->KELUAR_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KELUAR_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->KELUAR_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KELUAR_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->displayValue($arwrk);
                    } else {
                        $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->CurrentValue;
                    }
                }
            } else {
                $this->KELUAR_ID->ViewValue = null;
            }
            $this->KELUAR_ID->ViewCustomAttributes = "";

            // DATE_OF_DIAGNOSA
            $this->DATE_OF_DIAGNOSA->ViewValue = $this->DATE_OF_DIAGNOSA->CurrentValue;
            $this->DATE_OF_DIAGNOSA->ViewValue = FormatDateTime($this->DATE_OF_DIAGNOSA->ViewValue, 11);
            $this->DATE_OF_DIAGNOSA->ViewCustomAttributes = "";

            // REPORT_DATE
            $this->REPORT_DATE->ViewValue = $this->REPORT_DATE->CurrentValue;
            $this->REPORT_DATE->ViewValue = FormatDateTime($this->REPORT_DATE->ViewValue, 0);
            $this->REPORT_DATE->ViewCustomAttributes = "";

            // DIAGNOSA_ID
            $curVal = trim(strval($this->DIAGNOSA_ID->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->lookupCacheOption($curVal);
                if ($this->DIAGNOSA_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAGNOSA_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAGNOSA_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->displayValue($arwrk);
                    } else {
                        $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
                    }
                }
            } else {
                $this->DIAGNOSA_ID->ViewValue = null;
            }
            $this->DIAGNOSA_ID->ViewCustomAttributes = "";

            // DIAGNOSA_DESC
            $this->DIAGNOSA_DESC->ViewValue = $this->DIAGNOSA_DESC->CurrentValue;
            $this->DIAGNOSA_DESC->ViewCustomAttributes = "";

            // ANAMNASE
            $this->ANAMNASE->ViewValue = $this->ANAMNASE->CurrentValue;
            $this->ANAMNASE->ViewCustomAttributes = "";

            // PEMERIKSAAN
            $this->PEMERIKSAAN->ViewValue = $this->PEMERIKSAAN->CurrentValue;
            $this->PEMERIKSAAN->ViewCustomAttributes = "";

            // TERAPHY_DESC
            $this->TERAPHY_DESC->ViewValue = $this->TERAPHY_DESC->CurrentValue;
            $this->TERAPHY_DESC->ViewCustomAttributes = "";

            // INSTRUCTION
            $this->INSTRUCTION->ViewValue = $this->INSTRUCTION->CurrentValue;
            $this->INSTRUCTION->ViewCustomAttributes = "";

            // SUFFER_TYPE
            $curVal = trim(strval($this->SUFFER_TYPE->CurrentValue));
            if ($curVal != "") {
                $this->SUFFER_TYPE->ViewValue = $this->SUFFER_TYPE->lookupCacheOption($curVal);
                if ($this->SUFFER_TYPE->ViewValue === null) { // Lookup from database
                    $filterWrk = "[SUFFER_TYPE]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->SUFFER_TYPE->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SUFFER_TYPE->Lookup->renderViewRow($rswrk[0]);
                        $this->SUFFER_TYPE->ViewValue = $this->SUFFER_TYPE->displayValue($arwrk);
                    } else {
                        $this->SUFFER_TYPE->ViewValue = $this->SUFFER_TYPE->CurrentValue;
                    }
                }
            } else {
                $this->SUFFER_TYPE->ViewValue = null;
            }
            $this->SUFFER_TYPE->ViewCustomAttributes = "";

            // INFECTED_BODY
            $this->INFECTED_BODY->ViewValue = $this->INFECTED_BODY->CurrentValue;
            $this->INFECTED_BODY->ViewValue = FormatNumber($this->INFECTED_BODY->ViewValue, 0, -2, -2, -2);
            $this->INFECTED_BODY->ViewCustomAttributes = "";

            // EMPLOYEE_ID
            $curVal = trim(strval($this->EMPLOYEE_ID->CurrentValue));
            if ($curVal != "") {
                $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->lookupCacheOption($curVal);
                if ($this->EMPLOYEE_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[EMPLOYEE_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "[OBJECT_CATEGORY_ID]= 20";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->EMPLOYEE_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->EMPLOYEE_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->displayValue($arwrk);
                    } else {
                        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
                    }
                }
            } else {
                $this->EMPLOYEE_ID->ViewValue = null;
            }
            $this->EMPLOYEE_ID->ViewCustomAttributes = "";

            // RISK_LEVEL
            $this->RISK_LEVEL->ViewValue = $this->RISK_LEVEL->CurrentValue;
            $this->RISK_LEVEL->ViewValue = FormatNumber($this->RISK_LEVEL->ViewValue, 0, -2, -2, -2);
            $this->RISK_LEVEL->ViewCustomAttributes = "";

            // MORFOLOGI_NEOPLASMA
            $this->MORFOLOGI_NEOPLASMA->ViewValue = $this->MORFOLOGI_NEOPLASMA->CurrentValue;
            $this->MORFOLOGI_NEOPLASMA->ViewCustomAttributes = "";

            // HURT
            $this->HURT->ViewValue = $this->HURT->CurrentValue;
            $this->HURT->ViewCustomAttributes = "";

            // HURT_TYPE
            $this->HURT_TYPE->ViewValue = $this->HURT_TYPE->CurrentValue;
            $this->HURT_TYPE->ViewValue = FormatNumber($this->HURT_TYPE->ViewValue, 0, -2, -2, -2);
            $this->HURT_TYPE->ViewCustomAttributes = "";

            // DIAG_CAT
            $curVal = trim(strval($this->DIAG_CAT->CurrentValue));
            if ($curVal != "") {
                $this->DIAG_CAT->ViewValue = $this->DIAG_CAT->lookupCacheOption($curVal);
                if ($this->DIAG_CAT->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAG_CAT]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->DIAG_CAT->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAG_CAT->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAG_CAT->ViewValue = $this->DIAG_CAT->displayValue($arwrk);
                    } else {
                        $this->DIAG_CAT->ViewValue = $this->DIAG_CAT->CurrentValue;
                    }
                }
            } else {
                $this->DIAG_CAT->ViewValue = null;
            }
            $this->DIAG_CAT->ViewCustomAttributes = "";

            // ADDICTION_MATERIAL
            $this->ADDICTION_MATERIAL->ViewValue = $this->ADDICTION_MATERIAL->CurrentValue;
            $this->ADDICTION_MATERIAL->ViewCustomAttributes = "";

            // INFECTED_QUANTITY
            $this->INFECTED_QUANTITY->ViewValue = $this->INFECTED_QUANTITY->CurrentValue;
            $this->INFECTED_QUANTITY->ViewValue = FormatNumber($this->INFECTED_QUANTITY->ViewValue, 0, -2, -2, -2);
            $this->INFECTED_QUANTITY->ViewCustomAttributes = "";

            // CONTAGIOUS_TYPE
            $this->CONTAGIOUS_TYPE->ViewValue = $this->CONTAGIOUS_TYPE->CurrentValue;
            $this->CONTAGIOUS_TYPE->ViewValue = FormatNumber($this->CONTAGIOUS_TYPE->ViewValue, 0, -2, -2, -2);
            $this->CONTAGIOUS_TYPE->ViewCustomAttributes = "";

            // CURATIF_ID
            $this->CURATIF_ID->ViewValue = $this->CURATIF_ID->CurrentValue;
            $this->CURATIF_ID->ViewValue = FormatNumber($this->CURATIF_ID->ViewValue, 0, -2, -2, -2);
            $this->CURATIF_ID->ViewCustomAttributes = "";

            // RESULT_ID
            $this->RESULT_ID->ViewValue = $this->RESULT_ID->CurrentValue;
            $this->RESULT_ID->ViewValue = FormatNumber($this->RESULT_ID->ViewValue, 0, -2, -2, -2);
            $this->RESULT_ID->ViewCustomAttributes = "";

            // INFECTION_TYPE
            $this->INFECTION_TYPE->ViewValue = $this->INFECTION_TYPE->CurrentValue;
            $this->INFECTION_TYPE->ViewValue = FormatNumber($this->INFECTION_TYPE->ViewValue, 0, -2, -2, -2);
            $this->INFECTION_TYPE->ViewCustomAttributes = "";

            // INVESTIGATION_ID
            $curVal = trim(strval($this->INVESTIGATION_ID->CurrentValue));
            if ($curVal != "") {
                $this->INVESTIGATION_ID->ViewValue = $this->INVESTIGATION_ID->lookupCacheOption($curVal);
                if ($this->INVESTIGATION_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[INVESTIGATION_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->INVESTIGATION_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->INVESTIGATION_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->INVESTIGATION_ID->ViewValue = $this->INVESTIGATION_ID->displayValue($arwrk);
                    } else {
                        $this->INVESTIGATION_ID->ViewValue = $this->INVESTIGATION_ID->CurrentValue;
                    }
                }
            } else {
                $this->INVESTIGATION_ID->ViewValue = null;
            }
            $this->INVESTIGATION_ID->ViewCustomAttributes = "";

            // DISABILITY
            $this->DISABILITY->ViewValue = $this->DISABILITY->CurrentValue;
            $this->DISABILITY->ViewCustomAttributes = "";

            // DESCRIPTION
            $curVal = trim(strval($this->DESCRIPTION->CurrentValue));
            if ($curVal != "") {
                $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->lookupCacheOption($curVal);
                if ($this->DESCRIPTION->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DESCRIPTION->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DESCRIPTION->Lookup->renderViewRow($rswrk[0]);
                        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->displayValue($arwrk);
                    } else {
                        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
                    }
                }
            } else {
                $this->DESCRIPTION->ViewValue = null;
            }
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // KOMPLIKASI
            $this->KOMPLIKASI->ViewValue = $this->KOMPLIKASI->CurrentValue;
            $this->KOMPLIKASI->ViewCustomAttributes = "";

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

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
            $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
            $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

            // AGEYEAR
            $this->AGEYEAR->ViewValue = $this->AGEYEAR->CurrentValue;
            $this->AGEYEAR->ViewValue = FormatNumber($this->AGEYEAR->ViewValue, 0, -2, -2, -2);
            $this->AGEYEAR->ViewCustomAttributes = "";

            // AGEMONTH
            $this->AGEMONTH->ViewValue = $this->AGEMONTH->CurrentValue;
            $this->AGEMONTH->ViewValue = FormatNumber($this->AGEMONTH->ViewValue, 0, -2, -2, -2);
            $this->AGEMONTH->ViewCustomAttributes = "";

            // AGEDAY
            $this->AGEDAY->ViewValue = $this->AGEDAY->CurrentValue;
            $this->AGEDAY->ViewValue = FormatNumber($this->AGEDAY->ViewValue, 0, -2, -2, -2);
            $this->AGEDAY->ViewCustomAttributes = "";

            // THEADDRESS
            $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
            $this->THEADDRESS->ViewCustomAttributes = "";

            // THEID
            $this->THEID->ViewValue = $this->THEID->CurrentValue;
            $this->THEID->ViewCustomAttributes = "";

            // ISRJ
            $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
            $this->ISRJ->ViewCustomAttributes = "";

            // GENDER
            $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
            $this->GENDER->ViewCustomAttributes = "";

            // DOCTOR
            $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
            $this->DOCTOR->ViewCustomAttributes = "";

            // KAL_ID
            $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
            $this->KAL_ID->ViewCustomAttributes = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
            $this->ACCOUNT_ID->ViewCustomAttributes = "";

            // DIAGNOSA_ID_02
            $curVal = trim(strval($this->DIAGNOSA_ID_02->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->lookupCacheOption($curVal);
                if ($this->DIAGNOSA_ID_02->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAGNOSA_ID_02->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAGNOSA_ID_02->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->displayValue($arwrk);
                    } else {
                        $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->CurrentValue;
                    }
                }
            } else {
                $this->DIAGNOSA_ID_02->ViewValue = null;
            }
            $this->DIAGNOSA_ID_02->ViewCustomAttributes = "";

            // DIAGNOSA_ID_03
            $curVal = trim(strval($this->DIAGNOSA_ID_03->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->lookupCacheOption($curVal);
                if ($this->DIAGNOSA_ID_03->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAGNOSA_ID_03->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAGNOSA_ID_03->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->displayValue($arwrk);
                    } else {
                        $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->CurrentValue;
                    }
                }
            } else {
                $this->DIAGNOSA_ID_03->ViewValue = null;
            }
            $this->DIAGNOSA_ID_03->ViewCustomAttributes = "";

            // DIAGNOSA_ID_04
            $curVal = trim(strval($this->DIAGNOSA_ID_04->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->lookupCacheOption($curVal);
                if ($this->DIAGNOSA_ID_04->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAGNOSA_ID_04->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAGNOSA_ID_04->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->displayValue($arwrk);
                    } else {
                        $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->CurrentValue;
                    }
                }
            } else {
                $this->DIAGNOSA_ID_04->ViewValue = null;
            }
            $this->DIAGNOSA_ID_04->ViewCustomAttributes = "";

            // DIAGNOSA_ID_05
            $curVal = trim(strval($this->DIAGNOSA_ID_05->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->lookupCacheOption($curVal);
                if ($this->DIAGNOSA_ID_05->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAGNOSA_ID_05->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAGNOSA_ID_05->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->displayValue($arwrk);
                    } else {
                        $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->CurrentValue;
                    }
                }
            } else {
                $this->DIAGNOSA_ID_05->ViewValue = null;
            }
            $this->DIAGNOSA_ID_05->ViewCustomAttributes = "";

            // DIAGNOSA_ID_06
            $curVal = trim(strval($this->DIAGNOSA_ID_06->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->lookupCacheOption($curVal);
                if ($this->DIAGNOSA_ID_06->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAGNOSA_ID_06->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAGNOSA_ID_06->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->displayValue($arwrk);
                    } else {
                        $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->CurrentValue;
                    }
                }
            } else {
                $this->DIAGNOSA_ID_06->ViewValue = null;
            }
            $this->DIAGNOSA_ID_06->ViewCustomAttributes = "";

            // DIAGNOSA_ID_07
            $this->DIAGNOSA_ID_07->ViewValue = $this->DIAGNOSA_ID_07->CurrentValue;
            $this->DIAGNOSA_ID_07->ViewCustomAttributes = "";

            // DIAGNOSA_ID_08
            $this->DIAGNOSA_ID_08->ViewValue = $this->DIAGNOSA_ID_08->CurrentValue;
            $this->DIAGNOSA_ID_08->ViewCustomAttributes = "";

            // DIAGNOSA_ID_09
            $this->DIAGNOSA_ID_09->ViewValue = $this->DIAGNOSA_ID_09->CurrentValue;
            $this->DIAGNOSA_ID_09->ViewCustomAttributes = "";

            // DIAGNOSA_ID_10
            $this->DIAGNOSA_ID_10->ViewValue = $this->DIAGNOSA_ID_10->CurrentValue;
            $this->DIAGNOSA_ID_10->ViewCustomAttributes = "";

            // PROCEDURE_01
            $this->PROCEDURE_01->ViewValue = $this->PROCEDURE_01->CurrentValue;
            $this->PROCEDURE_01->ViewCustomAttributes = "";

            // PROCEDURE_02
            $this->PROCEDURE_02->ViewValue = $this->PROCEDURE_02->CurrentValue;
            $this->PROCEDURE_02->ViewCustomAttributes = "";

            // PROCEDURE_03
            $this->PROCEDURE_03->ViewValue = $this->PROCEDURE_03->CurrentValue;
            $this->PROCEDURE_03->ViewCustomAttributes = "";

            // PROCEDURE_04
            $this->PROCEDURE_04->ViewValue = $this->PROCEDURE_04->CurrentValue;
            $this->PROCEDURE_04->ViewCustomAttributes = "";

            // PROCEDURE_05
            $this->PROCEDURE_05->ViewValue = $this->PROCEDURE_05->CurrentValue;
            $this->PROCEDURE_05->ViewCustomAttributes = "";

            // PROCEDURE_06
            $this->PROCEDURE_06->ViewValue = $this->PROCEDURE_06->CurrentValue;
            $this->PROCEDURE_06->ViewCustomAttributes = "";

            // PROCEDURE_07
            $this->PROCEDURE_07->ViewValue = $this->PROCEDURE_07->CurrentValue;
            $this->PROCEDURE_07->ViewCustomAttributes = "";

            // PROCEDURE_08
            $this->PROCEDURE_08->ViewValue = $this->PROCEDURE_08->CurrentValue;
            $this->PROCEDURE_08->ViewCustomAttributes = "";

            // PROCEDURE_09
            $this->PROCEDURE_09->ViewValue = $this->PROCEDURE_09->CurrentValue;
            $this->PROCEDURE_09->ViewCustomAttributes = "";

            // PROCEDURE_10
            $this->PROCEDURE_10->ViewValue = $this->PROCEDURE_10->CurrentValue;
            $this->PROCEDURE_10->ViewCustomAttributes = "";

            // DIAGNOSA_ID2
            $this->DIAGNOSA_ID2->ViewValue = $this->DIAGNOSA_ID2->CurrentValue;
            $this->DIAGNOSA_ID2->ViewCustomAttributes = "";

            // WEIGHT
            $this->WEIGHT->ViewValue = $this->WEIGHT->CurrentValue;
            $this->WEIGHT->ViewValue = FormatNumber($this->WEIGHT->ViewValue, 2, -2, -2, -2);
            $this->WEIGHT->ViewCustomAttributes = "";

            // NOKARTU
            $this->NOKARTU->ViewValue = $this->NOKARTU->CurrentValue;
            $this->NOKARTU->ViewCustomAttributes = "";

            // NOSEP
            $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
            $this->NOSEP->ViewCustomAttributes = "";

            // TGLSEP
            $this->TGLSEP->ViewValue = $this->TGLSEP->CurrentValue;
            $this->TGLSEP->ViewValue = FormatDateTime($this->TGLSEP->ViewValue, 0);
            $this->TGLSEP->ViewCustomAttributes = "";

            // RENCANATL
            $this->RENCANATL->ViewValue = $this->RENCANATL->CurrentValue;
            $this->RENCANATL->ViewCustomAttributes = "";

            // DIRUJUKKE
            $this->DIRUJUKKE->ViewValue = $this->DIRUJUKKE->CurrentValue;
            $this->DIRUJUKKE->ViewCustomAttributes = "";

            // TGLKONTROL
            $this->TGLKONTROL->ViewValue = $this->TGLKONTROL->CurrentValue;
            $this->TGLKONTROL->ViewValue = FormatDateTime($this->TGLKONTROL->ViewValue, 0);
            $this->TGLKONTROL->ViewCustomAttributes = "";

            // KDPOLI_KONTROL
            $this->KDPOLI_KONTROL->ViewValue = $this->KDPOLI_KONTROL->CurrentValue;
            $this->KDPOLI_KONTROL->ViewCustomAttributes = "";

            // JAMINAN
            $this->JAMINAN->ViewValue = $this->JAMINAN->CurrentValue;
            $this->JAMINAN->ViewCustomAttributes = "";

            // SPESIALISTIK
            $this->SPESIALISTIK->ViewValue = $this->SPESIALISTIK->CurrentValue;
            $this->SPESIALISTIK->ViewCustomAttributes = "";

            // PEMERIKSAAN_02
            $this->PEMERIKSAAN_02->ViewValue = $this->PEMERIKSAAN_02->CurrentValue;
            $this->PEMERIKSAAN_02->ViewCustomAttributes = "";

            // DIAGNOSA_DESC_02
            $this->DIAGNOSA_DESC_02->ViewValue = $this->DIAGNOSA_DESC_02->CurrentValue;
            $this->DIAGNOSA_DESC_02->ViewCustomAttributes = "";

            // DIAGNOSA_DESC_03
            $this->DIAGNOSA_DESC_03->ViewValue = $this->DIAGNOSA_DESC_03->CurrentValue;
            $this->DIAGNOSA_DESC_03->ViewCustomAttributes = "";

            // DIAGNOSA_DESC_04
            $this->DIAGNOSA_DESC_04->ViewValue = $this->DIAGNOSA_DESC_04->CurrentValue;
            $this->DIAGNOSA_DESC_04->ViewCustomAttributes = "";

            // DIAGNOSA_DESC_05
            $this->DIAGNOSA_DESC_05->ViewValue = $this->DIAGNOSA_DESC_05->CurrentValue;
            $this->DIAGNOSA_DESC_05->ViewCustomAttributes = "";

            // DIAGNOSA_DESC_06
            $this->DIAGNOSA_DESC_06->ViewValue = $this->DIAGNOSA_DESC_06->CurrentValue;
            $this->DIAGNOSA_DESC_06->ViewCustomAttributes = "";

            // PROCEDURE_DESC_01
            $this->PROCEDURE_DESC_01->ViewValue = $this->PROCEDURE_DESC_01->CurrentValue;
            $this->PROCEDURE_DESC_01->ViewCustomAttributes = "";

            // PROCEDURE_DESC_02
            $this->PROCEDURE_DESC_02->ViewValue = $this->PROCEDURE_DESC_02->CurrentValue;
            $this->PROCEDURE_DESC_02->ViewCustomAttributes = "";

            // PROCEDURE_DESC_03
            $this->PROCEDURE_DESC_03->ViewValue = $this->PROCEDURE_DESC_03->CurrentValue;
            $this->PROCEDURE_DESC_03->ViewCustomAttributes = "";

            // PROCEDURE_DESC_04
            $this->PROCEDURE_DESC_04->ViewValue = $this->PROCEDURE_DESC_04->CurrentValue;
            $this->PROCEDURE_DESC_04->ViewCustomAttributes = "";

            // PROCEDURE_DESC_05
            $this->PROCEDURE_DESC_05->ViewValue = $this->PROCEDURE_DESC_05->CurrentValue;
            $this->PROCEDURE_DESC_05->ViewCustomAttributes = "";

            // height
            $this->height->ViewValue = $this->height->CurrentValue;
            $this->height->ViewCustomAttributes = "";

            // TEMPERATURE
            $this->TEMPERATURE->ViewValue = $this->TEMPERATURE->CurrentValue;
            $this->TEMPERATURE->ViewValue = FormatNumber($this->TEMPERATURE->ViewValue, 2, -2, -2, -2);
            $this->TEMPERATURE->ViewCustomAttributes = "";

            // TENSION_UPPER
            $this->TENSION_UPPER->ViewValue = $this->TENSION_UPPER->CurrentValue;
            $this->TENSION_UPPER->ViewValue = FormatNumber($this->TENSION_UPPER->ViewValue, 2, -2, -2, -2);
            $this->TENSION_UPPER->ViewCustomAttributes = "";

            // TENSION_BELOW
            $this->TENSION_BELOW->ViewValue = $this->TENSION_BELOW->CurrentValue;
            $this->TENSION_BELOW->ViewValue = FormatNumber($this->TENSION_BELOW->ViewValue, 2, -2, -2, -2);
            $this->TENSION_BELOW->ViewCustomAttributes = "";

            // NADI
            $this->NADI->ViewValue = $this->NADI->CurrentValue;
            $this->NADI->ViewValue = FormatNumber($this->NADI->ViewValue, 2, -2, -2, -2);
            $this->NADI->ViewCustomAttributes = "";

            // NAFAS
            $this->NAFAS->ViewValue = $this->NAFAS->CurrentValue;
            $this->NAFAS->ViewValue = FormatNumber($this->NAFAS->ViewValue, 2, -2, -2, -2);
            $this->NAFAS->ViewCustomAttributes = "";

            // spec_procedures
            $this->spec_procedures->ViewValue = $this->spec_procedures->CurrentValue;
            $this->spec_procedures->ViewCustomAttributes = "";

            // spec_drug
            $this->spec_drug->ViewValue = $this->spec_drug->CurrentValue;
            $this->spec_drug->ViewCustomAttributes = "";

            // spec_prothesis
            $this->spec_prothesis->ViewValue = $this->spec_prothesis->CurrentValue;
            $this->spec_prothesis->ViewCustomAttributes = "";

            // spec_investigation
            $this->spec_investigation->ViewValue = $this->spec_investigation->CurrentValue;
            $this->spec_investigation->ViewCustomAttributes = "";

            // procedure_11
            $this->procedure_11->ViewValue = $this->procedure_11->CurrentValue;
            $this->procedure_11->ViewCustomAttributes = "";

            // procedure_12
            $this->procedure_12->ViewValue = $this->procedure_12->CurrentValue;
            $this->procedure_12->ViewCustomAttributes = "";

            // procedure_13
            $this->procedure_13->ViewValue = $this->procedure_13->CurrentValue;
            $this->procedure_13->ViewCustomAttributes = "";

            // procedure_14
            $this->procedure_14->ViewValue = $this->procedure_14->CurrentValue;
            $this->procedure_14->ViewCustomAttributes = "";

            // procedure_15
            $this->procedure_15->ViewValue = $this->procedure_15->CurrentValue;
            $this->procedure_15->ViewCustomAttributes = "";

            // isanestesi
            $this->isanestesi->ViewValue = $this->isanestesi->CurrentValue;
            $this->isanestesi->ViewCustomAttributes = "";

            // isreposisi
            $this->isreposisi->ViewValue = $this->isreposisi->CurrentValue;
            $this->isreposisi->ViewCustomAttributes = "";

            // islab
            $this->islab->ViewValue = $this->islab->CurrentValue;
            $this->islab->ViewCustomAttributes = "";

            // isro
            $this->isro->ViewValue = $this->isro->CurrentValue;
            $this->isro->ViewCustomAttributes = "";

            // isekg
            $this->isekg->ViewValue = $this->isekg->CurrentValue;
            $this->isekg->ViewCustomAttributes = "";

            // ishecting
            $this->ishecting->ViewValue = $this->ishecting->CurrentValue;
            $this->ishecting->ViewCustomAttributes = "";

            // isgips
            $this->isgips->ViewValue = $this->isgips->CurrentValue;
            $this->isgips->ViewCustomAttributes = "";

            // islengkap
            $this->islengkap->ViewValue = $this->islengkap->CurrentValue;
            $this->islengkap->ViewCustomAttributes = "";

            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->ViewValue = $this->IDXDAFTAR->CurrentValue;
            $this->IDXDAFTAR->ViewValue = FormatNumber($this->IDXDAFTAR->ViewValue, 0, -2, -2, -2);
            $this->IDXDAFTAR->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // THENAME
            $this->THENAME->LinkCustomAttributes = "";
            $this->THENAME->HrefValue = "";
            $this->THENAME->TooltipValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->LinkCustomAttributes = "";
            $this->KELUAR_ID->HrefValue = "";
            $this->KELUAR_ID->TooltipValue = "";

            // DATE_OF_DIAGNOSA
            $this->DATE_OF_DIAGNOSA->LinkCustomAttributes = "";
            $this->DATE_OF_DIAGNOSA->HrefValue = "";
            $this->DATE_OF_DIAGNOSA->TooltipValue = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID->HrefValue = "";
            $this->DIAGNOSA_ID->TooltipValue = "";

            // ANAMNASE
            $this->ANAMNASE->LinkCustomAttributes = "";
            $this->ANAMNASE->HrefValue = "";
            $this->ANAMNASE->TooltipValue = "";

            // PEMERIKSAAN
            $this->PEMERIKSAAN->LinkCustomAttributes = "";
            $this->PEMERIKSAAN->HrefValue = "";
            $this->PEMERIKSAAN->TooltipValue = "";

            // TERAPHY_DESC
            $this->TERAPHY_DESC->LinkCustomAttributes = "";
            $this->TERAPHY_DESC->HrefValue = "";
            $this->TERAPHY_DESC->TooltipValue = "";

            // SUFFER_TYPE
            $this->SUFFER_TYPE->LinkCustomAttributes = "";
            $this->SUFFER_TYPE->HrefValue = "";
            $this->SUFFER_TYPE->TooltipValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";
            $this->EMPLOYEE_ID->TooltipValue = "";

            // MORFOLOGI_NEOPLASMA
            $this->MORFOLOGI_NEOPLASMA->LinkCustomAttributes = "";
            $this->MORFOLOGI_NEOPLASMA->HrefValue = "";
            $this->MORFOLOGI_NEOPLASMA->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";
            $this->DESCRIPTION->TooltipValue = "";

            // KOMPLIKASI
            $this->KOMPLIKASI->LinkCustomAttributes = "";
            $this->KOMPLIKASI->HrefValue = "";
            $this->KOMPLIKASI->TooltipValue = "";

            // DIAGNOSA_ID_02
            $this->DIAGNOSA_ID_02->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_02->HrefValue = "";
            $this->DIAGNOSA_ID_02->TooltipValue = "";

            // DIAGNOSA_ID_03
            $this->DIAGNOSA_ID_03->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_03->HrefValue = "";
            $this->DIAGNOSA_ID_03->TooltipValue = "";

            // DIAGNOSA_ID_04
            $this->DIAGNOSA_ID_04->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_04->HrefValue = "";
            $this->DIAGNOSA_ID_04->TooltipValue = "";

            // DIAGNOSA_ID_05
            $this->DIAGNOSA_ID_05->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_05->HrefValue = "";
            $this->DIAGNOSA_ID_05->TooltipValue = "";

            // DIAGNOSA_ID_06
            $this->DIAGNOSA_ID_06->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_06->HrefValue = "";
            $this->DIAGNOSA_ID_06->TooltipValue = "";

            // DIAGNOSA_ID_09
            $this->DIAGNOSA_ID_09->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_09->HrefValue = "";
            $this->DIAGNOSA_ID_09->TooltipValue = "";

            // PROCEDURE_03
            $this->PROCEDURE_03->LinkCustomAttributes = "";
            $this->PROCEDURE_03->HrefValue = "";
            $this->PROCEDURE_03->TooltipValue = "";

            // PROCEDURE_05
            $this->PROCEDURE_05->LinkCustomAttributes = "";
            $this->PROCEDURE_05->HrefValue = "";
            $this->PROCEDURE_05->TooltipValue = "";

            // PROCEDURE_06
            $this->PROCEDURE_06->LinkCustomAttributes = "";
            $this->PROCEDURE_06->HrefValue = "";
            $this->PROCEDURE_06->TooltipValue = "";

            // DIAGNOSA_ID2
            $this->DIAGNOSA_ID2->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID2->HrefValue = "";
            $this->DIAGNOSA_ID2->TooltipValue = "";

            // WEIGHT
            $this->WEIGHT->LinkCustomAttributes = "";
            $this->WEIGHT->HrefValue = "";
            $this->WEIGHT->TooltipValue = "";

            // TGLKONTROL
            $this->TGLKONTROL->LinkCustomAttributes = "";
            $this->TGLKONTROL->HrefValue = "";
            $this->TGLKONTROL->TooltipValue = "";

            // PEMERIKSAAN_02
            $this->PEMERIKSAAN_02->LinkCustomAttributes = "";
            $this->PEMERIKSAAN_02->HrefValue = "";
            $this->PEMERIKSAAN_02->TooltipValue = "";

            // height
            $this->height->LinkCustomAttributes = "";
            $this->height->HrefValue = "";
            $this->height->TooltipValue = "";

            // TEMPERATURE
            $this->TEMPERATURE->LinkCustomAttributes = "";
            $this->TEMPERATURE->HrefValue = "";
            $this->TEMPERATURE->TooltipValue = "";

            // TENSION_UPPER
            $this->TENSION_UPPER->LinkCustomAttributes = "";
            $this->TENSION_UPPER->HrefValue = "";
            $this->TENSION_UPPER->TooltipValue = "";

            // NADI
            $this->NADI->LinkCustomAttributes = "";
            $this->NADI->HrefValue = "";
            $this->NADI->TooltipValue = "";

            // NAFAS
            $this->NAFAS->LinkCustomAttributes = "";
            $this->NAFAS->HrefValue = "";
            $this->NAFAS->TooltipValue = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->LinkCustomAttributes = "";
            $this->IDXDAFTAR->HrefValue = "";
            $this->IDXDAFTAR->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditCustomAttributes = "";
            $curVal = trim(strval($this->NO_REGISTRATION->CurrentValue));
            if ($curVal != "") {
                $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->lookupCacheOption($curVal);
            } else {
                $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->Lookup !== null && is_array($this->NO_REGISTRATION->Lookup->Options) ? $curVal : null;
            }
            if ($this->NO_REGISTRATION->ViewValue !== null) { // Load from cache
                $this->NO_REGISTRATION->EditValue = array_values($this->NO_REGISTRATION->Lookup->Options);
                if ($this->NO_REGISTRATION->ViewValue == "") {
                    $this->NO_REGISTRATION->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[NO_REGISTRATION]" . SearchString("=", $this->NO_REGISTRATION->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->NO_REGISTRATION->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->NO_REGISTRATION->Lookup->renderViewRow($rswrk[0]);
                    $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->displayValue($arwrk);
                } else {
                    $this->NO_REGISTRATION->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->NO_REGISTRATION->EditValue = $arwrk;
            }
            $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

            // THENAME
            $this->THENAME->EditAttrs["class"] = "form-control";
            $this->THENAME->EditCustomAttributes = "";
            if (!$this->THENAME->Raw) {
                $this->THENAME->CurrentValue = HtmlDecode($this->THENAME->CurrentValue);
            }
            $this->THENAME->EditValue = HtmlEncode($this->THENAME->CurrentValue);
            $this->THENAME->PlaceHolder = RemoveHtml($this->THENAME->caption());

            // KELUAR_ID
            $this->KELUAR_ID->EditAttrs["class"] = "form-control";
            $this->KELUAR_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->KELUAR_ID->CurrentValue));
            if ($curVal != "") {
                $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->lookupCacheOption($curVal);
            } else {
                $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->Lookup !== null && is_array($this->KELUAR_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->KELUAR_ID->ViewValue !== null) { // Load from cache
                $this->KELUAR_ID->EditValue = array_values($this->KELUAR_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[KELUAR_ID]" . SearchString("=", $this->KELUAR_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->KELUAR_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KELUAR_ID->EditValue = $arwrk;
            }
            $this->KELUAR_ID->PlaceHolder = RemoveHtml($this->KELUAR_ID->caption());

            // DATE_OF_DIAGNOSA
            $this->DATE_OF_DIAGNOSA->EditAttrs["class"] = "form-control";
            $this->DATE_OF_DIAGNOSA->EditCustomAttributes = "";
            $this->DATE_OF_DIAGNOSA->EditValue = HtmlEncode(FormatDateTime($this->DATE_OF_DIAGNOSA->CurrentValue, 11));
            $this->DATE_OF_DIAGNOSA->PlaceHolder = RemoveHtml($this->DATE_OF_DIAGNOSA->caption());

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->DIAGNOSA_ID->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->lookupCacheOption($curVal);
            } else {
                $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->Lookup !== null && is_array($this->DIAGNOSA_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->DIAGNOSA_ID->ViewValue !== null) { // Load from cache
                $this->DIAGNOSA_ID->EditValue = array_values($this->DIAGNOSA_ID->Lookup->Options);
                if ($this->DIAGNOSA_ID->ViewValue == "") {
                    $this->DIAGNOSA_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DIAGNOSA_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DIAGNOSA_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DIAGNOSA_ID->EditValue = $arwrk;
            }
            $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

            // ANAMNASE
            $this->ANAMNASE->EditAttrs["class"] = "form-control";
            $this->ANAMNASE->EditCustomAttributes = "";
            $this->ANAMNASE->EditValue = HtmlEncode($this->ANAMNASE->CurrentValue);
            $this->ANAMNASE->PlaceHolder = RemoveHtml($this->ANAMNASE->caption());

            // PEMERIKSAAN
            $this->PEMERIKSAAN->EditAttrs["class"] = "form-control";
            $this->PEMERIKSAAN->EditCustomAttributes = "";
            if (!$this->PEMERIKSAAN->Raw) {
                $this->PEMERIKSAAN->CurrentValue = HtmlDecode($this->PEMERIKSAAN->CurrentValue);
            }
            $this->PEMERIKSAAN->EditValue = HtmlEncode($this->PEMERIKSAAN->CurrentValue);
            $this->PEMERIKSAAN->PlaceHolder = RemoveHtml($this->PEMERIKSAAN->caption());

            // TERAPHY_DESC
            $this->TERAPHY_DESC->EditAttrs["class"] = "form-control";
            $this->TERAPHY_DESC->EditCustomAttributes = "";
            if (!$this->TERAPHY_DESC->Raw) {
                $this->TERAPHY_DESC->CurrentValue = HtmlDecode($this->TERAPHY_DESC->CurrentValue);
            }
            $this->TERAPHY_DESC->EditValue = HtmlEncode($this->TERAPHY_DESC->CurrentValue);
            $this->TERAPHY_DESC->PlaceHolder = RemoveHtml($this->TERAPHY_DESC->caption());

            // SUFFER_TYPE
            $this->SUFFER_TYPE->EditAttrs["class"] = "form-control";
            $this->SUFFER_TYPE->EditCustomAttributes = "";
            $curVal = trim(strval($this->SUFFER_TYPE->CurrentValue));
            if ($curVal != "") {
                $this->SUFFER_TYPE->ViewValue = $this->SUFFER_TYPE->lookupCacheOption($curVal);
            } else {
                $this->SUFFER_TYPE->ViewValue = $this->SUFFER_TYPE->Lookup !== null && is_array($this->SUFFER_TYPE->Lookup->Options) ? $curVal : null;
            }
            if ($this->SUFFER_TYPE->ViewValue !== null) { // Load from cache
                $this->SUFFER_TYPE->EditValue = array_values($this->SUFFER_TYPE->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[SUFFER_TYPE]" . SearchString("=", $this->SUFFER_TYPE->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->SUFFER_TYPE->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SUFFER_TYPE->EditValue = $arwrk;
            }
            $this->SUFFER_TYPE->PlaceHolder = RemoveHtml($this->SUFFER_TYPE->caption());

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
            $this->EMPLOYEE_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->EMPLOYEE_ID->CurrentValue));
            if ($curVal != "") {
                $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->lookupCacheOption($curVal);
            } else {
                $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->Lookup !== null && is_array($this->EMPLOYEE_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->EMPLOYEE_ID->ViewValue !== null) { // Load from cache
                $this->EMPLOYEE_ID->EditValue = array_values($this->EMPLOYEE_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[EMPLOYEE_ID]" . SearchString("=", $this->EMPLOYEE_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "[OBJECT_CATEGORY_ID]= 20";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->EMPLOYEE_ID->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->EMPLOYEE_ID->EditValue = $arwrk;
            }
            $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

            // MORFOLOGI_NEOPLASMA
            $this->MORFOLOGI_NEOPLASMA->EditAttrs["class"] = "form-control";
            $this->MORFOLOGI_NEOPLASMA->EditCustomAttributes = "";
            if (!$this->MORFOLOGI_NEOPLASMA->Raw) {
                $this->MORFOLOGI_NEOPLASMA->CurrentValue = HtmlDecode($this->MORFOLOGI_NEOPLASMA->CurrentValue);
            }
            $this->MORFOLOGI_NEOPLASMA->EditValue = HtmlEncode($this->MORFOLOGI_NEOPLASMA->CurrentValue);
            $this->MORFOLOGI_NEOPLASMA->PlaceHolder = RemoveHtml($this->MORFOLOGI_NEOPLASMA->caption());

            // DESCRIPTION
            $this->DESCRIPTION->EditCustomAttributes = "";
            $curVal = trim(strval($this->DESCRIPTION->CurrentValue));
            if ($curVal != "") {
                $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->lookupCacheOption($curVal);
            } else {
                $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->Lookup !== null && is_array($this->DESCRIPTION->Lookup->Options) ? $curVal : null;
            }
            if ($this->DESCRIPTION->ViewValue !== null) { // Load from cache
                $this->DESCRIPTION->EditValue = array_values($this->DESCRIPTION->Lookup->Options);
                if ($this->DESCRIPTION->ViewValue == "") {
                    $this->DESCRIPTION->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DESCRIPTION->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DESCRIPTION->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DESCRIPTION->Lookup->renderViewRow($rswrk[0]);
                    $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->displayValue($arwrk);
                } else {
                    $this->DESCRIPTION->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DESCRIPTION->EditValue = $arwrk;
            }
            $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

            // KOMPLIKASI
            $this->KOMPLIKASI->EditAttrs["class"] = "form-control";
            $this->KOMPLIKASI->EditCustomAttributes = "";
            if (!$this->KOMPLIKASI->Raw) {
                $this->KOMPLIKASI->CurrentValue = HtmlDecode($this->KOMPLIKASI->CurrentValue);
            }
            $this->KOMPLIKASI->EditValue = HtmlEncode($this->KOMPLIKASI->CurrentValue);
            $this->KOMPLIKASI->PlaceHolder = RemoveHtml($this->KOMPLIKASI->caption());

            // DIAGNOSA_ID_02
            $this->DIAGNOSA_ID_02->EditCustomAttributes = "";
            $curVal = trim(strval($this->DIAGNOSA_ID_02->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->lookupCacheOption($curVal);
            } else {
                $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->Lookup !== null && is_array($this->DIAGNOSA_ID_02->Lookup->Options) ? $curVal : null;
            }
            if ($this->DIAGNOSA_ID_02->ViewValue !== null) { // Load from cache
                $this->DIAGNOSA_ID_02->EditValue = array_values($this->DIAGNOSA_ID_02->Lookup->Options);
                if ($this->DIAGNOSA_ID_02->ViewValue == "") {
                    $this->DIAGNOSA_ID_02->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DIAGNOSA_ID_02->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DIAGNOSA_ID_02->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_02->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_02->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DIAGNOSA_ID_02->EditValue = $arwrk;
            }
            $this->DIAGNOSA_ID_02->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_02->caption());

            // DIAGNOSA_ID_03
            $this->DIAGNOSA_ID_03->EditCustomAttributes = "";
            $curVal = trim(strval($this->DIAGNOSA_ID_03->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->lookupCacheOption($curVal);
            } else {
                $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->Lookup !== null && is_array($this->DIAGNOSA_ID_03->Lookup->Options) ? $curVal : null;
            }
            if ($this->DIAGNOSA_ID_03->ViewValue !== null) { // Load from cache
                $this->DIAGNOSA_ID_03->EditValue = array_values($this->DIAGNOSA_ID_03->Lookup->Options);
                if ($this->DIAGNOSA_ID_03->ViewValue == "") {
                    $this->DIAGNOSA_ID_03->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DIAGNOSA_ID_03->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DIAGNOSA_ID_03->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_03->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_03->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DIAGNOSA_ID_03->EditValue = $arwrk;
            }
            $this->DIAGNOSA_ID_03->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_03->caption());

            // DIAGNOSA_ID_04
            $this->DIAGNOSA_ID_04->EditCustomAttributes = "";
            $curVal = trim(strval($this->DIAGNOSA_ID_04->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->lookupCacheOption($curVal);
            } else {
                $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->Lookup !== null && is_array($this->DIAGNOSA_ID_04->Lookup->Options) ? $curVal : null;
            }
            if ($this->DIAGNOSA_ID_04->ViewValue !== null) { // Load from cache
                $this->DIAGNOSA_ID_04->EditValue = array_values($this->DIAGNOSA_ID_04->Lookup->Options);
                if ($this->DIAGNOSA_ID_04->ViewValue == "") {
                    $this->DIAGNOSA_ID_04->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DIAGNOSA_ID_04->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DIAGNOSA_ID_04->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_04->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_04->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DIAGNOSA_ID_04->EditValue = $arwrk;
            }
            $this->DIAGNOSA_ID_04->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_04->caption());

            // DIAGNOSA_ID_05
            $this->DIAGNOSA_ID_05->EditCustomAttributes = "";
            $curVal = trim(strval($this->DIAGNOSA_ID_05->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->lookupCacheOption($curVal);
            } else {
                $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->Lookup !== null && is_array($this->DIAGNOSA_ID_05->Lookup->Options) ? $curVal : null;
            }
            if ($this->DIAGNOSA_ID_05->ViewValue !== null) { // Load from cache
                $this->DIAGNOSA_ID_05->EditValue = array_values($this->DIAGNOSA_ID_05->Lookup->Options);
                if ($this->DIAGNOSA_ID_05->ViewValue == "") {
                    $this->DIAGNOSA_ID_05->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DIAGNOSA_ID_05->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DIAGNOSA_ID_05->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_05->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_05->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DIAGNOSA_ID_05->EditValue = $arwrk;
            }
            $this->DIAGNOSA_ID_05->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_05->caption());

            // DIAGNOSA_ID_06
            $this->DIAGNOSA_ID_06->EditCustomAttributes = "";
            $curVal = trim(strval($this->DIAGNOSA_ID_06->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->lookupCacheOption($curVal);
            } else {
                $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->Lookup !== null && is_array($this->DIAGNOSA_ID_06->Lookup->Options) ? $curVal : null;
            }
            if ($this->DIAGNOSA_ID_06->ViewValue !== null) { // Load from cache
                $this->DIAGNOSA_ID_06->EditValue = array_values($this->DIAGNOSA_ID_06->Lookup->Options);
                if ($this->DIAGNOSA_ID_06->ViewValue == "") {
                    $this->DIAGNOSA_ID_06->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DIAGNOSA_ID_06->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DIAGNOSA_ID_06->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_06->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_06->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DIAGNOSA_ID_06->EditValue = $arwrk;
            }
            $this->DIAGNOSA_ID_06->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_06->caption());

            // DIAGNOSA_ID_09
            $this->DIAGNOSA_ID_09->EditAttrs["class"] = "form-control";
            $this->DIAGNOSA_ID_09->EditCustomAttributes = "";
            if (!$this->DIAGNOSA_ID_09->Raw) {
                $this->DIAGNOSA_ID_09->CurrentValue = HtmlDecode($this->DIAGNOSA_ID_09->CurrentValue);
            }
            $this->DIAGNOSA_ID_09->EditValue = HtmlEncode($this->DIAGNOSA_ID_09->CurrentValue);
            $this->DIAGNOSA_ID_09->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_09->caption());

            // PROCEDURE_03
            $this->PROCEDURE_03->EditAttrs["class"] = "form-control";
            $this->PROCEDURE_03->EditCustomAttributes = "";
            if (!$this->PROCEDURE_03->Raw) {
                $this->PROCEDURE_03->CurrentValue = HtmlDecode($this->PROCEDURE_03->CurrentValue);
            }
            $this->PROCEDURE_03->EditValue = HtmlEncode($this->PROCEDURE_03->CurrentValue);
            $this->PROCEDURE_03->PlaceHolder = RemoveHtml($this->PROCEDURE_03->caption());

            // PROCEDURE_05
            $this->PROCEDURE_05->EditAttrs["class"] = "form-control";
            $this->PROCEDURE_05->EditCustomAttributes = "";
            if (!$this->PROCEDURE_05->Raw) {
                $this->PROCEDURE_05->CurrentValue = HtmlDecode($this->PROCEDURE_05->CurrentValue);
            }
            $this->PROCEDURE_05->EditValue = HtmlEncode($this->PROCEDURE_05->CurrentValue);
            $this->PROCEDURE_05->PlaceHolder = RemoveHtml($this->PROCEDURE_05->caption());

            // PROCEDURE_06
            $this->PROCEDURE_06->EditAttrs["class"] = "form-control";
            $this->PROCEDURE_06->EditCustomAttributes = "";
            if (!$this->PROCEDURE_06->Raw) {
                $this->PROCEDURE_06->CurrentValue = HtmlDecode($this->PROCEDURE_06->CurrentValue);
            }
            $this->PROCEDURE_06->EditValue = HtmlEncode($this->PROCEDURE_06->CurrentValue);
            $this->PROCEDURE_06->PlaceHolder = RemoveHtml($this->PROCEDURE_06->caption());

            // DIAGNOSA_ID2
            $this->DIAGNOSA_ID2->EditAttrs["class"] = "form-control";
            $this->DIAGNOSA_ID2->EditCustomAttributes = "";
            if (!$this->DIAGNOSA_ID2->Raw) {
                $this->DIAGNOSA_ID2->CurrentValue = HtmlDecode($this->DIAGNOSA_ID2->CurrentValue);
            }
            $this->DIAGNOSA_ID2->EditValue = HtmlEncode($this->DIAGNOSA_ID2->CurrentValue);
            $this->DIAGNOSA_ID2->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID2->caption());

            // WEIGHT
            $this->WEIGHT->EditAttrs["class"] = "form-control";
            $this->WEIGHT->EditCustomAttributes = "";
            $this->WEIGHT->EditValue = HtmlEncode($this->WEIGHT->CurrentValue);
            $this->WEIGHT->PlaceHolder = RemoveHtml($this->WEIGHT->caption());
            if (strval($this->WEIGHT->EditValue) != "" && is_numeric($this->WEIGHT->EditValue)) {
                $this->WEIGHT->EditValue = FormatNumber($this->WEIGHT->EditValue, -2, -2, -2, -2);
            }

            // TGLKONTROL
            $this->TGLKONTROL->EditAttrs["class"] = "form-control";
            $this->TGLKONTROL->EditCustomAttributes = "";
            $this->TGLKONTROL->EditValue = HtmlEncode(FormatDateTime($this->TGLKONTROL->CurrentValue, 8));
            $this->TGLKONTROL->PlaceHolder = RemoveHtml($this->TGLKONTROL->caption());

            // PEMERIKSAAN_02
            $this->PEMERIKSAAN_02->EditAttrs["class"] = "form-control";
            $this->PEMERIKSAAN_02->EditCustomAttributes = "";
            if (!$this->PEMERIKSAAN_02->Raw) {
                $this->PEMERIKSAAN_02->CurrentValue = HtmlDecode($this->PEMERIKSAAN_02->CurrentValue);
            }
            $this->PEMERIKSAAN_02->EditValue = HtmlEncode($this->PEMERIKSAAN_02->CurrentValue);
            $this->PEMERIKSAAN_02->PlaceHolder = RemoveHtml($this->PEMERIKSAAN_02->caption());

            // height
            $this->height->EditAttrs["class"] = "form-control";
            $this->height->EditCustomAttributes = "";
            if (!$this->height->Raw) {
                $this->height->CurrentValue = HtmlDecode($this->height->CurrentValue);
            }
            $this->height->EditValue = HtmlEncode($this->height->CurrentValue);
            $this->height->PlaceHolder = RemoveHtml($this->height->caption());

            // TEMPERATURE
            $this->TEMPERATURE->EditAttrs["class"] = "form-control";
            $this->TEMPERATURE->EditCustomAttributes = "";
            $this->TEMPERATURE->EditValue = HtmlEncode($this->TEMPERATURE->CurrentValue);
            $this->TEMPERATURE->PlaceHolder = RemoveHtml($this->TEMPERATURE->caption());
            if (strval($this->TEMPERATURE->EditValue) != "" && is_numeric($this->TEMPERATURE->EditValue)) {
                $this->TEMPERATURE->EditValue = FormatNumber($this->TEMPERATURE->EditValue, -2, -2, -2, -2);
            }

            // TENSION_UPPER
            $this->TENSION_UPPER->EditAttrs["class"] = "form-control";
            $this->TENSION_UPPER->EditCustomAttributes = "";
            $this->TENSION_UPPER->EditValue = HtmlEncode($this->TENSION_UPPER->CurrentValue);
            $this->TENSION_UPPER->PlaceHolder = RemoveHtml($this->TENSION_UPPER->caption());
            if (strval($this->TENSION_UPPER->EditValue) != "" && is_numeric($this->TENSION_UPPER->EditValue)) {
                $this->TENSION_UPPER->EditValue = FormatNumber($this->TENSION_UPPER->EditValue, -2, -2, -2, -2);
            }

            // NADI
            $this->NADI->EditAttrs["class"] = "form-control";
            $this->NADI->EditCustomAttributes = "";
            $this->NADI->EditValue = HtmlEncode($this->NADI->CurrentValue);
            $this->NADI->PlaceHolder = RemoveHtml($this->NADI->caption());
            if (strval($this->NADI->EditValue) != "" && is_numeric($this->NADI->EditValue)) {
                $this->NADI->EditValue = FormatNumber($this->NADI->EditValue, -2, -2, -2, -2);
            }

            // NAFAS
            $this->NAFAS->EditAttrs["class"] = "form-control";
            $this->NAFAS->EditCustomAttributes = "";
            $this->NAFAS->EditValue = HtmlEncode($this->NAFAS->CurrentValue);
            $this->NAFAS->PlaceHolder = RemoveHtml($this->NAFAS->caption());
            if (strval($this->NAFAS->EditValue) != "" && is_numeric($this->NAFAS->EditValue)) {
                $this->NAFAS->EditValue = FormatNumber($this->NAFAS->EditValue, -2, -2, -2, -2);
            }

            // IDXDAFTAR
            $this->IDXDAFTAR->EditAttrs["class"] = "form-control";
            $this->IDXDAFTAR->EditCustomAttributes = "";
            $this->IDXDAFTAR->EditValue = HtmlEncode($this->IDXDAFTAR->CurrentValue);
            $this->IDXDAFTAR->PlaceHolder = RemoveHtml($this->IDXDAFTAR->caption());

            // Add refer script

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";

            // THENAME
            $this->THENAME->LinkCustomAttributes = "";
            $this->THENAME->HrefValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->LinkCustomAttributes = "";
            $this->KELUAR_ID->HrefValue = "";

            // DATE_OF_DIAGNOSA
            $this->DATE_OF_DIAGNOSA->LinkCustomAttributes = "";
            $this->DATE_OF_DIAGNOSA->HrefValue = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID->HrefValue = "";

            // ANAMNASE
            $this->ANAMNASE->LinkCustomAttributes = "";
            $this->ANAMNASE->HrefValue = "";

            // PEMERIKSAAN
            $this->PEMERIKSAAN->LinkCustomAttributes = "";
            $this->PEMERIKSAAN->HrefValue = "";

            // TERAPHY_DESC
            $this->TERAPHY_DESC->LinkCustomAttributes = "";
            $this->TERAPHY_DESC->HrefValue = "";

            // SUFFER_TYPE
            $this->SUFFER_TYPE->LinkCustomAttributes = "";
            $this->SUFFER_TYPE->HrefValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";

            // MORFOLOGI_NEOPLASMA
            $this->MORFOLOGI_NEOPLASMA->LinkCustomAttributes = "";
            $this->MORFOLOGI_NEOPLASMA->HrefValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";

            // KOMPLIKASI
            $this->KOMPLIKASI->LinkCustomAttributes = "";
            $this->KOMPLIKASI->HrefValue = "";

            // DIAGNOSA_ID_02
            $this->DIAGNOSA_ID_02->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_02->HrefValue = "";

            // DIAGNOSA_ID_03
            $this->DIAGNOSA_ID_03->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_03->HrefValue = "";

            // DIAGNOSA_ID_04
            $this->DIAGNOSA_ID_04->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_04->HrefValue = "";

            // DIAGNOSA_ID_05
            $this->DIAGNOSA_ID_05->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_05->HrefValue = "";

            // DIAGNOSA_ID_06
            $this->DIAGNOSA_ID_06->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_06->HrefValue = "";

            // DIAGNOSA_ID_09
            $this->DIAGNOSA_ID_09->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID_09->HrefValue = "";

            // PROCEDURE_03
            $this->PROCEDURE_03->LinkCustomAttributes = "";
            $this->PROCEDURE_03->HrefValue = "";

            // PROCEDURE_05
            $this->PROCEDURE_05->LinkCustomAttributes = "";
            $this->PROCEDURE_05->HrefValue = "";

            // PROCEDURE_06
            $this->PROCEDURE_06->LinkCustomAttributes = "";
            $this->PROCEDURE_06->HrefValue = "";

            // DIAGNOSA_ID2
            $this->DIAGNOSA_ID2->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID2->HrefValue = "";

            // WEIGHT
            $this->WEIGHT->LinkCustomAttributes = "";
            $this->WEIGHT->HrefValue = "";

            // TGLKONTROL
            $this->TGLKONTROL->LinkCustomAttributes = "";
            $this->TGLKONTROL->HrefValue = "";

            // PEMERIKSAAN_02
            $this->PEMERIKSAAN_02->LinkCustomAttributes = "";
            $this->PEMERIKSAAN_02->HrefValue = "";

            // height
            $this->height->LinkCustomAttributes = "";
            $this->height->HrefValue = "";

            // TEMPERATURE
            $this->TEMPERATURE->LinkCustomAttributes = "";
            $this->TEMPERATURE->HrefValue = "";

            // TENSION_UPPER
            $this->TENSION_UPPER->LinkCustomAttributes = "";
            $this->TENSION_UPPER->HrefValue = "";

            // NADI
            $this->NADI->LinkCustomAttributes = "";
            $this->NADI->HrefValue = "";

            // NAFAS
            $this->NAFAS->LinkCustomAttributes = "";
            $this->NAFAS->HrefValue = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->LinkCustomAttributes = "";
            $this->IDXDAFTAR->HrefValue = "";
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
        if ($this->NO_REGISTRATION->Required) {
            if (!$this->NO_REGISTRATION->IsDetailKey && EmptyValue($this->NO_REGISTRATION->FormValue)) {
                $this->NO_REGISTRATION->addErrorMessage(str_replace("%s", $this->NO_REGISTRATION->caption(), $this->NO_REGISTRATION->RequiredErrorMessage));
            }
        }
        if ($this->THENAME->Required) {
            if (!$this->THENAME->IsDetailKey && EmptyValue($this->THENAME->FormValue)) {
                $this->THENAME->addErrorMessage(str_replace("%s", $this->THENAME->caption(), $this->THENAME->RequiredErrorMessage));
            }
        }
        if ($this->KELUAR_ID->Required) {
            if (!$this->KELUAR_ID->IsDetailKey && EmptyValue($this->KELUAR_ID->FormValue)) {
                $this->KELUAR_ID->addErrorMessage(str_replace("%s", $this->KELUAR_ID->caption(), $this->KELUAR_ID->RequiredErrorMessage));
            }
        }
        if ($this->DATE_OF_DIAGNOSA->Required) {
            if (!$this->DATE_OF_DIAGNOSA->IsDetailKey && EmptyValue($this->DATE_OF_DIAGNOSA->FormValue)) {
                $this->DATE_OF_DIAGNOSA->addErrorMessage(str_replace("%s", $this->DATE_OF_DIAGNOSA->caption(), $this->DATE_OF_DIAGNOSA->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->DATE_OF_DIAGNOSA->FormValue)) {
            $this->DATE_OF_DIAGNOSA->addErrorMessage($this->DATE_OF_DIAGNOSA->getErrorMessage(false));
        }
        if ($this->DIAGNOSA_ID->Required) {
            if (!$this->DIAGNOSA_ID->IsDetailKey && EmptyValue($this->DIAGNOSA_ID->FormValue)) {
                $this->DIAGNOSA_ID->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID->caption(), $this->DIAGNOSA_ID->RequiredErrorMessage));
            }
        }
        if ($this->ANAMNASE->Required) {
            if (!$this->ANAMNASE->IsDetailKey && EmptyValue($this->ANAMNASE->FormValue)) {
                $this->ANAMNASE->addErrorMessage(str_replace("%s", $this->ANAMNASE->caption(), $this->ANAMNASE->RequiredErrorMessage));
            }
        }
        if ($this->PEMERIKSAAN->Required) {
            if (!$this->PEMERIKSAAN->IsDetailKey && EmptyValue($this->PEMERIKSAAN->FormValue)) {
                $this->PEMERIKSAAN->addErrorMessage(str_replace("%s", $this->PEMERIKSAAN->caption(), $this->PEMERIKSAAN->RequiredErrorMessage));
            }
        }
        if ($this->TERAPHY_DESC->Required) {
            if (!$this->TERAPHY_DESC->IsDetailKey && EmptyValue($this->TERAPHY_DESC->FormValue)) {
                $this->TERAPHY_DESC->addErrorMessage(str_replace("%s", $this->TERAPHY_DESC->caption(), $this->TERAPHY_DESC->RequiredErrorMessage));
            }
        }
        if ($this->SUFFER_TYPE->Required) {
            if (!$this->SUFFER_TYPE->IsDetailKey && EmptyValue($this->SUFFER_TYPE->FormValue)) {
                $this->SUFFER_TYPE->addErrorMessage(str_replace("%s", $this->SUFFER_TYPE->caption(), $this->SUFFER_TYPE->RequiredErrorMessage));
            }
        }
        if ($this->EMPLOYEE_ID->Required) {
            if (!$this->EMPLOYEE_ID->IsDetailKey && EmptyValue($this->EMPLOYEE_ID->FormValue)) {
                $this->EMPLOYEE_ID->addErrorMessage(str_replace("%s", $this->EMPLOYEE_ID->caption(), $this->EMPLOYEE_ID->RequiredErrorMessage));
            }
        }
        if ($this->MORFOLOGI_NEOPLASMA->Required) {
            if (!$this->MORFOLOGI_NEOPLASMA->IsDetailKey && EmptyValue($this->MORFOLOGI_NEOPLASMA->FormValue)) {
                $this->MORFOLOGI_NEOPLASMA->addErrorMessage(str_replace("%s", $this->MORFOLOGI_NEOPLASMA->caption(), $this->MORFOLOGI_NEOPLASMA->RequiredErrorMessage));
            }
        }
        if ($this->DESCRIPTION->Required) {
            if (!$this->DESCRIPTION->IsDetailKey && EmptyValue($this->DESCRIPTION->FormValue)) {
                $this->DESCRIPTION->addErrorMessage(str_replace("%s", $this->DESCRIPTION->caption(), $this->DESCRIPTION->RequiredErrorMessage));
            }
        }
        if ($this->KOMPLIKASI->Required) {
            if (!$this->KOMPLIKASI->IsDetailKey && EmptyValue($this->KOMPLIKASI->FormValue)) {
                $this->KOMPLIKASI->addErrorMessage(str_replace("%s", $this->KOMPLIKASI->caption(), $this->KOMPLIKASI->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID_02->Required) {
            if (!$this->DIAGNOSA_ID_02->IsDetailKey && EmptyValue($this->DIAGNOSA_ID_02->FormValue)) {
                $this->DIAGNOSA_ID_02->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID_02->caption(), $this->DIAGNOSA_ID_02->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID_03->Required) {
            if (!$this->DIAGNOSA_ID_03->IsDetailKey && EmptyValue($this->DIAGNOSA_ID_03->FormValue)) {
                $this->DIAGNOSA_ID_03->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID_03->caption(), $this->DIAGNOSA_ID_03->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID_04->Required) {
            if (!$this->DIAGNOSA_ID_04->IsDetailKey && EmptyValue($this->DIAGNOSA_ID_04->FormValue)) {
                $this->DIAGNOSA_ID_04->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID_04->caption(), $this->DIAGNOSA_ID_04->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID_05->Required) {
            if (!$this->DIAGNOSA_ID_05->IsDetailKey && EmptyValue($this->DIAGNOSA_ID_05->FormValue)) {
                $this->DIAGNOSA_ID_05->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID_05->caption(), $this->DIAGNOSA_ID_05->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID_06->Required) {
            if (!$this->DIAGNOSA_ID_06->IsDetailKey && EmptyValue($this->DIAGNOSA_ID_06->FormValue)) {
                $this->DIAGNOSA_ID_06->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID_06->caption(), $this->DIAGNOSA_ID_06->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID_09->Required) {
            if (!$this->DIAGNOSA_ID_09->IsDetailKey && EmptyValue($this->DIAGNOSA_ID_09->FormValue)) {
                $this->DIAGNOSA_ID_09->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID_09->caption(), $this->DIAGNOSA_ID_09->RequiredErrorMessage));
            }
        }
        if ($this->PROCEDURE_03->Required) {
            if (!$this->PROCEDURE_03->IsDetailKey && EmptyValue($this->PROCEDURE_03->FormValue)) {
                $this->PROCEDURE_03->addErrorMessage(str_replace("%s", $this->PROCEDURE_03->caption(), $this->PROCEDURE_03->RequiredErrorMessage));
            }
        }
        if ($this->PROCEDURE_05->Required) {
            if (!$this->PROCEDURE_05->IsDetailKey && EmptyValue($this->PROCEDURE_05->FormValue)) {
                $this->PROCEDURE_05->addErrorMessage(str_replace("%s", $this->PROCEDURE_05->caption(), $this->PROCEDURE_05->RequiredErrorMessage));
            }
        }
        if ($this->PROCEDURE_06->Required) {
            if (!$this->PROCEDURE_06->IsDetailKey && EmptyValue($this->PROCEDURE_06->FormValue)) {
                $this->PROCEDURE_06->addErrorMessage(str_replace("%s", $this->PROCEDURE_06->caption(), $this->PROCEDURE_06->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID2->Required) {
            if (!$this->DIAGNOSA_ID2->IsDetailKey && EmptyValue($this->DIAGNOSA_ID2->FormValue)) {
                $this->DIAGNOSA_ID2->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID2->caption(), $this->DIAGNOSA_ID2->RequiredErrorMessage));
            }
        }
        if ($this->WEIGHT->Required) {
            if (!$this->WEIGHT->IsDetailKey && EmptyValue($this->WEIGHT->FormValue)) {
                $this->WEIGHT->addErrorMessage(str_replace("%s", $this->WEIGHT->caption(), $this->WEIGHT->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->WEIGHT->FormValue)) {
            $this->WEIGHT->addErrorMessage($this->WEIGHT->getErrorMessage(false));
        }
        if ($this->TGLKONTROL->Required) {
            if (!$this->TGLKONTROL->IsDetailKey && EmptyValue($this->TGLKONTROL->FormValue)) {
                $this->TGLKONTROL->addErrorMessage(str_replace("%s", $this->TGLKONTROL->caption(), $this->TGLKONTROL->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->TGLKONTROL->FormValue)) {
            $this->TGLKONTROL->addErrorMessage($this->TGLKONTROL->getErrorMessage(false));
        }
        if ($this->PEMERIKSAAN_02->Required) {
            if (!$this->PEMERIKSAAN_02->IsDetailKey && EmptyValue($this->PEMERIKSAAN_02->FormValue)) {
                $this->PEMERIKSAAN_02->addErrorMessage(str_replace("%s", $this->PEMERIKSAAN_02->caption(), $this->PEMERIKSAAN_02->RequiredErrorMessage));
            }
        }
        if ($this->height->Required) {
            if (!$this->height->IsDetailKey && EmptyValue($this->height->FormValue)) {
                $this->height->addErrorMessage(str_replace("%s", $this->height->caption(), $this->height->RequiredErrorMessage));
            }
        }
        if ($this->TEMPERATURE->Required) {
            if (!$this->TEMPERATURE->IsDetailKey && EmptyValue($this->TEMPERATURE->FormValue)) {
                $this->TEMPERATURE->addErrorMessage(str_replace("%s", $this->TEMPERATURE->caption(), $this->TEMPERATURE->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->TEMPERATURE->FormValue)) {
            $this->TEMPERATURE->addErrorMessage($this->TEMPERATURE->getErrorMessage(false));
        }
        if ($this->TENSION_UPPER->Required) {
            if (!$this->TENSION_UPPER->IsDetailKey && EmptyValue($this->TENSION_UPPER->FormValue)) {
                $this->TENSION_UPPER->addErrorMessage(str_replace("%s", $this->TENSION_UPPER->caption(), $this->TENSION_UPPER->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->TENSION_UPPER->FormValue)) {
            $this->TENSION_UPPER->addErrorMessage($this->TENSION_UPPER->getErrorMessage(false));
        }
        if ($this->NADI->Required) {
            if (!$this->NADI->IsDetailKey && EmptyValue($this->NADI->FormValue)) {
                $this->NADI->addErrorMessage(str_replace("%s", $this->NADI->caption(), $this->NADI->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->NADI->FormValue)) {
            $this->NADI->addErrorMessage($this->NADI->getErrorMessage(false));
        }
        if ($this->NAFAS->Required) {
            if (!$this->NAFAS->IsDetailKey && EmptyValue($this->NAFAS->FormValue)) {
                $this->NAFAS->addErrorMessage(str_replace("%s", $this->NAFAS->caption(), $this->NAFAS->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->NAFAS->FormValue)) {
            $this->NAFAS->addErrorMessage($this->NAFAS->getErrorMessage(false));
        }
        if ($this->IDXDAFTAR->Required) {
            if (!$this->IDXDAFTAR->IsDetailKey && EmptyValue($this->IDXDAFTAR->FormValue)) {
                $this->IDXDAFTAR->addErrorMessage(str_replace("%s", $this->IDXDAFTAR->caption(), $this->IDXDAFTAR->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->IDXDAFTAR->FormValue)) {
            $this->IDXDAFTAR->addErrorMessage($this->IDXDAFTAR->getErrorMessage(false));
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

        // NO_REGISTRATION
        $this->NO_REGISTRATION->setDbValueDef($rsnew, $this->NO_REGISTRATION->CurrentValue, null, false);

        // THENAME
        $this->THENAME->setDbValueDef($rsnew, $this->THENAME->CurrentValue, null, false);

        // KELUAR_ID
        $this->KELUAR_ID->setDbValueDef($rsnew, $this->KELUAR_ID->CurrentValue, null, false);

        // DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA->setDbValueDef($rsnew, UnFormatDateTime($this->DATE_OF_DIAGNOSA->CurrentValue, 11), null, false);

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->setDbValueDef($rsnew, $this->DIAGNOSA_ID->CurrentValue, null, false);

        // ANAMNASE
        $this->ANAMNASE->setDbValueDef($rsnew, $this->ANAMNASE->CurrentValue, null, false);

        // PEMERIKSAAN
        $this->PEMERIKSAAN->setDbValueDef($rsnew, $this->PEMERIKSAAN->CurrentValue, null, false);

        // TERAPHY_DESC
        $this->TERAPHY_DESC->setDbValueDef($rsnew, $this->TERAPHY_DESC->CurrentValue, null, false);

        // SUFFER_TYPE
        $this->SUFFER_TYPE->setDbValueDef($rsnew, $this->SUFFER_TYPE->CurrentValue, null, false);

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->setDbValueDef($rsnew, $this->EMPLOYEE_ID->CurrentValue, null, false);

        // MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA->setDbValueDef($rsnew, $this->MORFOLOGI_NEOPLASMA->CurrentValue, null, false);

        // DESCRIPTION
        $this->DESCRIPTION->setDbValueDef($rsnew, $this->DESCRIPTION->CurrentValue, null, false);

        // KOMPLIKASI
        $this->KOMPLIKASI->setDbValueDef($rsnew, $this->KOMPLIKASI->CurrentValue, null, false);

        // DIAGNOSA_ID_02
        $this->DIAGNOSA_ID_02->setDbValueDef($rsnew, $this->DIAGNOSA_ID_02->CurrentValue, null, false);

        // DIAGNOSA_ID_03
        $this->DIAGNOSA_ID_03->setDbValueDef($rsnew, $this->DIAGNOSA_ID_03->CurrentValue, null, false);

        // DIAGNOSA_ID_04
        $this->DIAGNOSA_ID_04->setDbValueDef($rsnew, $this->DIAGNOSA_ID_04->CurrentValue, null, false);

        // DIAGNOSA_ID_05
        $this->DIAGNOSA_ID_05->setDbValueDef($rsnew, $this->DIAGNOSA_ID_05->CurrentValue, null, false);

        // DIAGNOSA_ID_06
        $this->DIAGNOSA_ID_06->setDbValueDef($rsnew, $this->DIAGNOSA_ID_06->CurrentValue, null, false);

        // DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09->setDbValueDef($rsnew, $this->DIAGNOSA_ID_09->CurrentValue, null, false);

        // PROCEDURE_03
        $this->PROCEDURE_03->setDbValueDef($rsnew, $this->PROCEDURE_03->CurrentValue, null, false);

        // PROCEDURE_05
        $this->PROCEDURE_05->setDbValueDef($rsnew, $this->PROCEDURE_05->CurrentValue, null, false);

        // PROCEDURE_06
        $this->PROCEDURE_06->setDbValueDef($rsnew, $this->PROCEDURE_06->CurrentValue, null, false);

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->setDbValueDef($rsnew, $this->DIAGNOSA_ID2->CurrentValue, null, false);

        // WEIGHT
        $this->WEIGHT->setDbValueDef($rsnew, $this->WEIGHT->CurrentValue, null, false);

        // TGLKONTROL
        $this->TGLKONTROL->setDbValueDef($rsnew, UnFormatDateTime($this->TGLKONTROL->CurrentValue, 0), null, false);

        // PEMERIKSAAN_02
        $this->PEMERIKSAAN_02->setDbValueDef($rsnew, $this->PEMERIKSAAN_02->CurrentValue, null, false);

        // height
        $this->height->setDbValueDef($rsnew, $this->height->CurrentValue, null, false);

        // TEMPERATURE
        $this->TEMPERATURE->setDbValueDef($rsnew, $this->TEMPERATURE->CurrentValue, null, false);

        // TENSION_UPPER
        $this->TENSION_UPPER->setDbValueDef($rsnew, $this->TENSION_UPPER->CurrentValue, null, false);

        // NADI
        $this->NADI->setDbValueDef($rsnew, $this->NADI->CurrentValue, null, false);

        // NAFAS
        $this->NAFAS->setDbValueDef($rsnew, $this->NAFAS->CurrentValue, null, false);

        // IDXDAFTAR
        $this->IDXDAFTAR->setDbValueDef($rsnew, $this->IDXDAFTAR->CurrentValue, null, false);

        // VISIT_ID
        if ($this->VISIT_ID->getSessionValue() != "") {
            $rsnew['VISIT_ID'] = $this->VISIT_ID->getSessionValue();
        }

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

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "V_RIWAYAT_RM") {
                $validMaster = true;
                $masterTbl = Container("V_RIWAYAT_RM");
                if (($parm = Get("fk_VISIT_ID", Get("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setQueryStringValue($parm);
                    $this->VISIT_ID->setQueryStringValue($masterTbl->VISIT_ID->QueryStringValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->QueryStringValue);
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "V_RIWAYAT_RM") {
                $validMaster = true;
                $masterTbl = Container("V_RIWAYAT_RM");
                if (($parm = Post("fk_VISIT_ID", Post("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setFormValue($parm);
                    $this->VISIT_ID->setFormValue($masterTbl->VISIT_ID->FormValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->FormValue);
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "V_RIWAYAT_RM") {
                if ($this->VISIT_ID->CurrentValue == "") {
                    $this->VISIT_ID->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PasienDiagnosaList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Set up multi pages
    protected function setupMultiPages()
    {
        $pages = new SubPages();
        $pages->Style = "tabs";
        $pages->add(0);
        $pages->add(1);
        $pages->add(2);
        $pages->add(3);
        $pages->add(4);
        $this->MultiPages = $pages;
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
                case "x_NO_REGISTRATION":
                    break;
                case "x_CLINIC_ID":
                    break;
                case "x_KELUAR_ID":
                    break;
                case "x_DIAGNOSA_ID":
                    break;
                case "x_SUFFER_TYPE":
                    break;
                case "x_EMPLOYEE_ID":
                    $lookupFilter = function () {
                        return "[OBJECT_CATEGORY_ID]= 20";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DIAG_CAT":
                    break;
                case "x_INVESTIGATION_ID":
                    break;
                case "x_DESCRIPTION":
                    break;
                case "x_DIAGNOSA_ID_02":
                    break;
                case "x_DIAGNOSA_ID_03":
                    break;
                case "x_DIAGNOSA_ID_04":
                    break;
                case "x_DIAGNOSA_ID_05":
                    break;
                case "x_DIAGNOSA_ID_06":
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
