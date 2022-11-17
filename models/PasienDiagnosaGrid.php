<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienDiagnosaGrid extends PasienDiagnosa
{
    use MessagesTrait;

    // Page ID
    public $PageID = "grid";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'PASIEN_DIAGNOSA';

    // Page object name
    public $PageObjName = "PasienDiagnosaGrid";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fPASIEN_DIAGNOSAgrid";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

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
        $this->FormActionName .= "_" . $this->FormName;
        $this->OldKeyName .= "_" . $this->FormName;
        $this->FormBlankRowName .= "_" . $this->FormName;
        $this->FormKeyCountName .= "_" . $this->FormName;
        $GLOBALS["Grid"] = &$this;

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
        $this->AddUrl = "PasienDiagnosaAdd";

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

        // List options
        $this->ListOptions = new ListOptions();
        $this->ListOptions->TableVar = $this->TableVar;

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
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
        unset($GLOBALS["Grid"]);
        if ($url === "") {
            return;
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

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
            SaveDebugMessage();
            Redirect(GetUrl($url));
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
        if ($this->isAddOrEdit()) {
            $this->ORG_UNIT_CODE->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->PASIEN_DIAGNOSA_ID->Visible = false;
        }
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

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $ShowOtherOptions = false;
    public $DisplayRecords = 10;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchRowCount = 0; // For extended search
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 2; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $RowAction = ""; // Row action
    public $MultiColumnClass = "col-sm";
    public $MultiColumnEditClass = "w-100";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->ORG_UNIT_CODE->Visible = false;
        $this->PASIEN_DIAGNOSA_ID->Visible = false;
        $this->NO_REGISTRATION->Visible = false;
        $this->THENAME->Visible = false;
        $this->VISIT_ID->Visible = false;
        $this->CLINIC_ID->Visible = false;
        $this->BILL_ID->Visible = false;
        $this->CLASS_ROOM_ID->Visible = false;
        $this->IN_DATE->Visible = false;
        $this->EXIT_DATE->Visible = false;
        $this->BED_ID->Visible = false;
        $this->KELUAR_ID->Visible = false;
        $this->DATE_OF_DIAGNOSA->setVisibility();
        $this->REPORT_DATE->Visible = false;
        $this->DIAGNOSA_ID->setVisibility();
        $this->DIAGNOSA_DESC->Visible = false;
        $this->ANAMNASE->setVisibility();
        $this->PEMERIKSAAN->setVisibility();
        $this->TERAPHY_DESC->setVisibility();
        $this->INSTRUCTION->Visible = false;
        $this->SUFFER_TYPE->Visible = false;
        $this->INFECTED_BODY->Visible = false;
        $this->EMPLOYEE_ID->Visible = false;
        $this->RISK_LEVEL->Visible = false;
        $this->MORFOLOGI_NEOPLASMA->Visible = false;
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
        $this->DESCRIPTION->Visible = false;
        $this->KOMPLIKASI->Visible = false;
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
        $this->DIAGNOSA_ID_02->Visible = false;
        $this->DIAGNOSA_ID_03->Visible = false;
        $this->DIAGNOSA_ID_04->Visible = false;
        $this->DIAGNOSA_ID_05->Visible = false;
        $this->DIAGNOSA_ID_06->Visible = false;
        $this->DIAGNOSA_ID_07->Visible = false;
        $this->DIAGNOSA_ID_08->Visible = false;
        $this->DIAGNOSA_ID_09->Visible = false;
        $this->DIAGNOSA_ID_10->Visible = false;
        $this->PROCEDURE_01->Visible = false;
        $this->PROCEDURE_02->Visible = false;
        $this->PROCEDURE_03->Visible = false;
        $this->PROCEDURE_04->Visible = false;
        $this->PROCEDURE_05->Visible = false;
        $this->PROCEDURE_06->Visible = false;
        $this->PROCEDURE_07->Visible = false;
        $this->PROCEDURE_08->Visible = false;
        $this->PROCEDURE_09->Visible = false;
        $this->PROCEDURE_10->Visible = false;
        $this->DIAGNOSA_ID2->Visible = false;
        $this->WEIGHT->Visible = false;
        $this->NOKARTU->Visible = false;
        $this->NOSEP->Visible = false;
        $this->TGLSEP->Visible = false;
        $this->RENCANATL->Visible = false;
        $this->DIRUJUKKE->Visible = false;
        $this->TGLKONTROL->setVisibility();
        $this->KDPOLI_KONTROL->Visible = false;
        $this->JAMINAN->Visible = false;
        $this->SPESIALISTIK->Visible = false;
        $this->PEMERIKSAAN_02->Visible = false;
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
        $this->height->Visible = false;
        $this->TEMPERATURE->Visible = false;
        $this->TENSION_UPPER->Visible = false;
        $this->TENSION_BELOW->Visible = false;
        $this->NADI->Visible = false;
        $this->NAFAS->Visible = false;
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

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up master detail parameters
        $this->setupMasterParms();

        // Setup other options
        $this->setupOtherOptions();

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

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Show grid delete link for grid add / grid edit
            if ($this->AllowAddDeleteRow) {
                if ($this->isGridAdd() || $this->isGridEdit()) {
                    $item = $this->ListOptions["griddelete"];
                    if ($item) {
                        $item->Visible = true;
                    }
                }
            }

            // Set up sorting order
            $this->setupSortOrder();
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 10; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load Sorting Order
        if ($this->Command != "json") {
            $this->loadSortOrder();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }

        // Restore master/detail filter
        $this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Load master record
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "V_RIWAYAT_RM") {
            $masterTbl = Container("V_RIWAYAT_RM");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("VRiwayatRmList"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            if ($this->CurrentMode == "copy") {
                $this->TotalRecords = $this->listRecordCount();
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->TotalRecords;
                $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
            } else {
                $this->CurrentFilter = "0=1";
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->GridAddRowCount;
            }
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->TotalRecords; // Display all records
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 10; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Exit inline mode
    protected function clearInlineMode()
    {
        $this->LastAction = $this->CurrentAction; // Save last action
        $this->CurrentAction = ""; // Clear action
        $_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
    }

    // Switch to Grid Add mode
    protected function gridAddMode()
    {
        $this->CurrentAction = "gridadd";
        $_SESSION[SESSION_INLINE_MODE] = "gridadd";
        $this->hideFieldsForAddEdit();
    }

    // Switch to Grid Edit mode
    protected function gridEditMode()
    {
        $this->CurrentAction = "gridedit";
        $_SESSION[SESSION_INLINE_MODE] = "gridedit";
        $this->hideFieldsForAddEdit();
    }

    // Perform update to grid
    public function gridUpdate()
    {
        global $Language, $CurrentForm;
        $gridUpdate = true;

        // Get old recordset
        $this->CurrentFilter = $this->buildKeyFilter();
        if ($this->CurrentFilter == "") {
            $this->CurrentFilter = "0=1";
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        if ($rs = $conn->executeQuery($sql)) {
            $rsold = $rs->fetchAll();
            $rs->closeCursor();
        }

        // Call Grid Updating event
        if (!$this->gridUpdating($rsold)) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
            }
            return false;
        }
        $key = "";

        // Update row index and get row key
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Update all rows based on key
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            $CurrentForm->Index = $rowindex;
            $this->setKey($CurrentForm->getValue($this->OldKeyName));
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));

            // Load all values and keys
            if ($rowaction != "insertdelete") { // Skip insert then deleted rows
                $this->loadFormValues(); // Get form values
                if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
                    $gridUpdate = $this->OldKey != ""; // Key must not be empty
                } else {
                    $gridUpdate = true;
                }

                // Skip empty row
                if ($rowaction == "insert" && $this->emptyRow()) {
                // Validate form and insert/update/delete record
                } elseif ($gridUpdate) {
                    if ($rowaction == "delete") {
                        $this->CurrentFilter = $this->getRecordFilter();
                        $gridUpdate = $this->deleteRows(); // Delete this row
                    //} elseif (!$this->validateForm()) { // Already done in validateGridForm
                    //    $gridUpdate = false; // Form error, reset action
                    } else {
                        if ($rowaction == "insert") {
                            $gridUpdate = $this->addRow(); // Insert this row
                        } else {
                            if ($this->OldKey != "") {
                                $this->SendEmail = false; // Do not send email on update success
                                $gridUpdate = $this->editRow(); // Update this row
                            }
                        } // End update
                    }
                }
                if ($gridUpdate) {
                    if ($key != "") {
                        $key .= ", ";
                    }
                    $key .= $this->OldKey;
                } else {
                    break;
                }
            }
        }
        if ($gridUpdate) {
            // Get new records
            $rsnew = $conn->fetchAll($sql);

            // Call Grid_Updated event
            $this->gridUpdated($rsold, $rsnew);
            $this->clearInlineMode(); // Clear inline edit mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
            }
        }
        return $gridUpdate;
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Perform Grid Add
    public function gridInsert()
    {
        global $Language, $CurrentForm;
        $rowindex = 1;
        $gridInsert = false;
        $conn = $this->getConnection();

        // Call Grid Inserting event
        if (!$this->gridInserting()) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
            }
            return false;
        }

        // Init key filter
        $wrkfilter = "";
        $addcnt = 0;
        $key = "";

        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Insert all rows
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "" && $rowaction != "insert") {
                continue; // Skip
            }
            if ($rowaction == "insert") {
                $this->OldKey = strval($CurrentForm->getValue($this->OldKeyName));
                $this->loadOldRecord(); // Load old record
            }
            $this->loadFormValues(); // Get form values
            if (!$this->emptyRow()) {
                $addcnt++;
                $this->SendEmail = false; // Do not send email on insert success

                // Validate form // Already done in validateGridForm
                //if (!$this->validateForm()) {
                //    $gridInsert = false; // Form error, reset action
                //} else {
                    $gridInsert = $this->addRow($this->OldRecordset); // Insert this row
                //}
                if ($gridInsert) {
                    if ($key != "") {
                        $key .= Config("COMPOSITE_KEY_SEPARATOR");
                    }
                    $key .= $this->ID->CurrentValue;

                    // Add filter for this record
                    $filter = $this->getRecordFilter();
                    if ($wrkfilter != "") {
                        $wrkfilter .= " OR ";
                    }
                    $wrkfilter .= $filter;
                } else {
                    break;
                }
            }
        }
        if ($addcnt == 0) { // No record inserted
            $this->clearInlineMode(); // Clear grid add mode and return
            return true;
        }
        if ($gridInsert) {
            // Get new records
            $this->CurrentFilter = $wrkfilter;
            $sql = $this->getCurrentSql();
            $rsnew = $conn->fetchAll($sql);

            // Call Grid_Inserted event
            $this->gridInserted($rsnew);
            $this->clearInlineMode(); // Clear grid add mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
            }
        }
        return $gridInsert;
    }

    // Check if empty row
    public function emptyRow()
    {
        global $CurrentForm;
        if ($CurrentForm->hasValue("x_DATE_OF_DIAGNOSA") && $CurrentForm->hasValue("o_DATE_OF_DIAGNOSA") && $this->DATE_OF_DIAGNOSA->CurrentValue != $this->DATE_OF_DIAGNOSA->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_DIAGNOSA_ID") && $CurrentForm->hasValue("o_DIAGNOSA_ID") && $this->DIAGNOSA_ID->CurrentValue != $this->DIAGNOSA_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_ANAMNASE") && $CurrentForm->hasValue("o_ANAMNASE") && $this->ANAMNASE->CurrentValue != $this->ANAMNASE->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_PEMERIKSAAN") && $CurrentForm->hasValue("o_PEMERIKSAAN") && $this->PEMERIKSAAN->CurrentValue != $this->PEMERIKSAAN->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_TERAPHY_DESC") && $CurrentForm->hasValue("o_TERAPHY_DESC") && $this->TERAPHY_DESC->CurrentValue != $this->TERAPHY_DESC->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_TGLKONTROL") && $CurrentForm->hasValue("o_TGLKONTROL") && $this->TGLKONTROL->CurrentValue != $this->TGLKONTROL->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_IDXDAFTAR") && $CurrentForm->hasValue("o_IDXDAFTAR") && $this->IDXDAFTAR->CurrentValue != $this->IDXDAFTAR->OldValue) {
            return false;
        }
        return true;
    }

    // Validate grid form
    public function validateGridForm()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Validate all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } elseif (!$this->validateForm()) {
                    return false;
                }
            }
        }
        return true;
    }

    // Get all form values of the grid
    public function getGridFormValues()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }
        $rows = [];

        // Loop through all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } else {
                    $rows[] = $this->getFieldValues("FormValue"); // Return row as array
                }
            }
        }
        return $rows; // Return as array of array
    }

    // Restore form values for current row
    public function restoreCurrentRowFormValues($idx)
    {
        global $CurrentForm;

        // Get row based on current index
        $CurrentForm->Index = $idx;
        $rowaction = strval($CurrentForm->getValue($this->FormActionName));
        $this->loadFormValues(); // Load form values
        // Set up invalid status correctly
        $this->resetFormError();
        if ($rowaction == "insert" && $this->emptyRow()) {
            // Ignore
        } else {
            $this->validateForm();
        }
    }

    // Reset form status
    public function resetFormError()
    {
        $this->DATE_OF_DIAGNOSA->clearErrorMessage();
        $this->DIAGNOSA_ID->clearErrorMessage();
        $this->ANAMNASE->clearErrorMessage();
        $this->PEMERIKSAAN->clearErrorMessage();
        $this->TERAPHY_DESC->clearErrorMessage();
        $this->TGLKONTROL->clearErrorMessage();
        $this->IDXDAFTAR->clearErrorMessage();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($useDefaultSort) {
                    $orderBy = $this->getSqlOrderBy();
                    $this->setSessionOrderBy($orderBy);
                } else {
                    $this->setSessionOrderBy("");
                }
            }
        }
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset master/detail keys
            if ($this->Command == "resetall") {
                $this->setCurrentMasterTable(""); // Clear master table
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
                        $this->VISIT_ID->setSessionValue("");
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // "griddelete"
        if ($this->AllowAddDeleteRow) {
            $item = &$this->ListOptions->add("griddelete");
            $item->CssClass = "text-nowrap";
            $item->OnLeft = true;
            $item->Visible = false; // Default hidden
        }

        // Add group option item
        $item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
        $item->Body = "";
        $item->OnLeft = true;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = true;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = true;

        // "delete"
        $item = &$this->ListOptions->add("delete");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canDelete();
        $item->OnLeft = true;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();

        // Set up row action and key
        if ($CurrentForm && is_numeric($this->RowIndex) && $this->RowType != "view") {
            $CurrentForm->Index = $this->RowIndex;
            $actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
            $oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->OldKeyName);
            $blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
            if ($this->RowAction != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
            }
            $oldKey = $this->getKey(false); // Get from OldValue
            if ($oldKeyName != "" && $oldKey != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($oldKey) . "\">";
            }
            if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow()) {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
            }
        }

        // "delete"
        if ($this->AllowAddDeleteRow) {
            if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
                $options = &$this->ListOptions;
                $options->UseButtonGroup = true; // Use button group for grid delete button
                $opt = $options["griddelete"];
                if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
                    $opt->Body = "&nbsp;";
                } else {
                    $opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
                }
            }
        }
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView()) {
                $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "delete"
            $opt = $this->ListOptions["delete"];
            if ($Security->canDelete()) {
            $opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("DeleteLink") . "</a>";
            } else {
                $opt->Body = "";
            }
        } // End View mode
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $option = $this->OtherOptions["addedit"];
        $option->UseDropDownButton = false;
        $option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $option->UseButtonGroup = true;
        //$option->ButtonClass = ""; // Class for button group
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Add
        if ($this->CurrentMode == "view") { // Check view mode
            $item = &$option->add("add");
            $addcaption = HtmlTitle($Language->phrase("AddLink"));
            $this->AddUrl = $this->getAddUrl();
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
            $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        }
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
            if ($this->AllowAddDeleteRow) {
                $option = $options["addedit"];
                $option->UseDropDownButton = false;
                $item = &$option->add("addblankrow");
                $item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
                $item->Visible = $Security->canAdd();
                $this->ShowOtherOptions = $item->Visible;
            }
        }
        if ($this->CurrentMode == "view") { // Check view mode
            $option = $options["addedit"];
            $item = $option["add"];
            $this->ShowOtherOptions = $item && $item->Visible;
        }
    }

    // Set up list options (extended codes)
    protected function setupListOptionsExt()
    {
    }

    // Render list options (extended codes)
    protected function renderListOptionsExt()
    {
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
        $this->ORG_UNIT_CODE->OldValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->PASIEN_DIAGNOSA_ID->CurrentValue = VisitId();
        $this->PASIEN_DIAGNOSA_ID->OldValue = $this->PASIEN_DIAGNOSA_ID->CurrentValue;
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
        $this->DATE_OF_DIAGNOSA->OldValue = $this->DATE_OF_DIAGNOSA->CurrentValue;
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
        $this->ISRJ->OldValue = $this->ISRJ->CurrentValue;
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
        $CurrentForm->FormName = $this->FormName;

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
        if ($CurrentForm->hasValue("o_DATE_OF_DIAGNOSA")) {
            $this->DATE_OF_DIAGNOSA->setOldValue($CurrentForm->getValue("o_DATE_OF_DIAGNOSA"));
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

        // Check field name 'ANAMNASE' first before field var 'x_ANAMNASE'
        $val = $CurrentForm->hasValue("ANAMNASE") ? $CurrentForm->getValue("ANAMNASE") : $CurrentForm->getValue("x_ANAMNASE");
        if (!$this->ANAMNASE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ANAMNASE->Visible = false; // Disable update for API request
            } else {
                $this->ANAMNASE->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_ANAMNASE")) {
            $this->ANAMNASE->setOldValue($CurrentForm->getValue("o_ANAMNASE"));
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
        if ($CurrentForm->hasValue("o_PEMERIKSAAN")) {
            $this->PEMERIKSAAN->setOldValue($CurrentForm->getValue("o_PEMERIKSAAN"));
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
        if ($CurrentForm->hasValue("o_TERAPHY_DESC")) {
            $this->TERAPHY_DESC->setOldValue($CurrentForm->getValue("o_TERAPHY_DESC"));
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
        if ($CurrentForm->hasValue("o_TGLKONTROL")) {
            $this->TGLKONTROL->setOldValue($CurrentForm->getValue("o_TGLKONTROL"));
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
        if ($CurrentForm->hasValue("o_IDXDAFTAR")) {
            $this->IDXDAFTAR->setOldValue($CurrentForm->getValue("o_IDXDAFTAR"));
        }

        // Check field name 'ID' first before field var 'x_ID'
        $val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
        if (!$this->ID->IsDetailKey && !$this->isGridAdd() && !$this->isAdd()) {
            $this->ID->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        if (!$this->isGridAdd() && !$this->isAdd()) {
            $this->ID->CurrentValue = $this->ID->FormValue;
        }
        $this->DATE_OF_DIAGNOSA->CurrentValue = $this->DATE_OF_DIAGNOSA->FormValue;
        $this->DATE_OF_DIAGNOSA->CurrentValue = UnFormatDateTime($this->DATE_OF_DIAGNOSA->CurrentValue, 11);
        $this->DIAGNOSA_ID->CurrentValue = $this->DIAGNOSA_ID->FormValue;
        $this->ANAMNASE->CurrentValue = $this->ANAMNASE->FormValue;
        $this->PEMERIKSAAN->CurrentValue = $this->PEMERIKSAAN->FormValue;
        $this->TERAPHY_DESC->CurrentValue = $this->TERAPHY_DESC->FormValue;
        $this->TGLKONTROL->CurrentValue = $this->TGLKONTROL->FormValue;
        $this->TGLKONTROL->CurrentValue = UnFormatDateTime($this->TGLKONTROL->CurrentValue, 0);
        $this->IDXDAFTAR->CurrentValue = $this->IDXDAFTAR->FormValue;
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $stmt = $sql->execute();
        $rs = new Recordset($stmt, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->CellCssStyle = "white-space: nowrap;";

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // THENAME
        $this->THENAME->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

        // BILL_ID
        $this->BILL_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->CellCssStyle = "white-space: nowrap;";

        // IN_DATE
        $this->IN_DATE->CellCssStyle = "white-space: nowrap;";

        // EXIT_DATE
        $this->EXIT_DATE->CellCssStyle = "white-space: nowrap;";

        // BED_ID
        $this->BED_ID->CellCssStyle = "white-space: nowrap;";

        // KELUAR_ID
        $this->KELUAR_ID->CellCssStyle = "white-space: nowrap;";

        // DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA->CellCssStyle = "white-space: nowrap;";

        // REPORT_DATE
        $this->REPORT_DATE->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC
        $this->DIAGNOSA_DESC->CellCssStyle = "white-space: nowrap;";

        // ANAMNASE
        $this->ANAMNASE->CellCssStyle = "white-space: nowrap;";

        // PEMERIKSAAN
        $this->PEMERIKSAAN->CellCssStyle = "white-space: nowrap;";

        // TERAPHY_DESC
        $this->TERAPHY_DESC->CellCssStyle = "white-space: nowrap;";

        // INSTRUCTION
        $this->INSTRUCTION->CellCssStyle = "white-space: nowrap;";

        // SUFFER_TYPE
        $this->SUFFER_TYPE->CellCssStyle = "white-space: nowrap;";

        // INFECTED_BODY
        $this->INFECTED_BODY->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // RISK_LEVEL
        $this->RISK_LEVEL->CellCssStyle = "white-space: nowrap;";

        // MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA->CellCssStyle = "white-space: nowrap;";

        // HURT
        $this->HURT->CellCssStyle = "white-space: nowrap;";

        // HURT_TYPE
        $this->HURT_TYPE->CellCssStyle = "white-space: nowrap;";

        // DIAG_CAT
        $this->DIAG_CAT->CellCssStyle = "white-space: nowrap;";

        // ADDICTION_MATERIAL
        $this->ADDICTION_MATERIAL->CellCssStyle = "white-space: nowrap;";

        // INFECTED_QUANTITY
        $this->INFECTED_QUANTITY->CellCssStyle = "white-space: nowrap;";

        // CONTAGIOUS_TYPE
        $this->CONTAGIOUS_TYPE->CellCssStyle = "white-space: nowrap;";

        // CURATIF_ID
        $this->CURATIF_ID->CellCssStyle = "white-space: nowrap;";

        // RESULT_ID
        $this->RESULT_ID->CellCssStyle = "white-space: nowrap;";

        // INFECTION_TYPE
        $this->INFECTION_TYPE->CellCssStyle = "white-space: nowrap;";

        // INVESTIGATION_ID
        $this->INVESTIGATION_ID->CellCssStyle = "white-space: nowrap;";

        // DISABILITY
        $this->DISABILITY->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // KOMPLIKASI
        $this->KOMPLIKASI->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // AGEYEAR
        $this->AGEYEAR->CellCssStyle = "white-space: nowrap;";

        // AGEMONTH
        $this->AGEMONTH->CellCssStyle = "white-space: nowrap;";

        // AGEDAY
        $this->AGEDAY->CellCssStyle = "white-space: nowrap;";

        // THEADDRESS
        $this->THEADDRESS->CellCssStyle = "white-space: nowrap;";

        // THEID
        $this->THEID->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // DOCTOR
        $this->DOCTOR->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_02
        $this->DIAGNOSA_ID_02->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_03
        $this->DIAGNOSA_ID_03->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_04
        $this->DIAGNOSA_ID_04->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_05
        $this->DIAGNOSA_ID_05->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_06
        $this->DIAGNOSA_ID_06->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_07
        $this->DIAGNOSA_ID_07->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_08
        $this->DIAGNOSA_ID_08->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_10
        $this->DIAGNOSA_ID_10->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_01
        $this->PROCEDURE_01->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_02
        $this->PROCEDURE_02->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_03
        $this->PROCEDURE_03->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_04
        $this->PROCEDURE_04->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_05
        $this->PROCEDURE_05->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_06
        $this->PROCEDURE_06->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_07
        $this->PROCEDURE_07->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_08
        $this->PROCEDURE_08->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_09
        $this->PROCEDURE_09->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_10
        $this->PROCEDURE_10->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->CellCssStyle = "white-space: nowrap;";

        // WEIGHT
        $this->WEIGHT->CellCssStyle = "white-space: nowrap;";

        // NOKARTU
        $this->NOKARTU->CellCssStyle = "white-space: nowrap;";

        // NOSEP
        $this->NOSEP->CellCssStyle = "white-space: nowrap;";

        // TGLSEP
        $this->TGLSEP->CellCssStyle = "white-space: nowrap;";

        // RENCANATL
        $this->RENCANATL->CellCssStyle = "white-space: nowrap;";

        // DIRUJUKKE
        $this->DIRUJUKKE->CellCssStyle = "white-space: nowrap;";

        // TGLKONTROL
        $this->TGLKONTROL->CellCssStyle = "white-space: nowrap;";

        // KDPOLI_KONTROL
        $this->KDPOLI_KONTROL->CellCssStyle = "white-space: nowrap;";

        // JAMINAN
        $this->JAMINAN->CellCssStyle = "white-space: nowrap;";

        // SPESIALISTIK
        $this->SPESIALISTIK->CellCssStyle = "white-space: nowrap;";

        // PEMERIKSAAN_02
        $this->PEMERIKSAAN_02->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_02
        $this->DIAGNOSA_DESC_02->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_03
        $this->DIAGNOSA_DESC_03->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_04
        $this->DIAGNOSA_DESC_04->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_05
        $this->DIAGNOSA_DESC_05->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_06
        $this->DIAGNOSA_DESC_06->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_01
        $this->PROCEDURE_DESC_01->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_02
        $this->PROCEDURE_DESC_02->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_03
        $this->PROCEDURE_DESC_03->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_04
        $this->PROCEDURE_DESC_04->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_05
        $this->PROCEDURE_DESC_05->CellCssStyle = "white-space: nowrap;";

        // RESPONPOST
        $this->RESPONPOST->CellCssStyle = "white-space: nowrap;";

        // RESPONPUT
        $this->RESPONPUT->CellCssStyle = "white-space: nowrap;";

        // RESPONDEL
        $this->RESPONDEL->CellCssStyle = "white-space: nowrap;";

        // JSONPOST
        $this->JSONPOST->CellCssStyle = "white-space: nowrap;";

        // JSONPUT
        $this->JSONPUT->CellCssStyle = "white-space: nowrap;";

        // JSONDEL
        $this->JSONDEL->CellCssStyle = "white-space: nowrap;";

        // height
        $this->height->CellCssStyle = "white-space: nowrap;";

        // TEMPERATURE
        $this->TEMPERATURE->CellCssStyle = "white-space: nowrap;";

        // TENSION_UPPER
        $this->TENSION_UPPER->CellCssStyle = "white-space: nowrap;";

        // TENSION_BELOW
        $this->TENSION_BELOW->CellCssStyle = "white-space: nowrap;";

        // NADI
        $this->NADI->CellCssStyle = "white-space: nowrap;";

        // NAFAS
        $this->NAFAS->CellCssStyle = "white-space: nowrap;";

        // spec_procedures
        $this->spec_procedures->CellCssStyle = "white-space: nowrap;";

        // spec_drug
        $this->spec_drug->CellCssStyle = "white-space: nowrap;";

        // spec_prothesis
        $this->spec_prothesis->CellCssStyle = "white-space: nowrap;";

        // spec_investigation
        $this->spec_investigation->CellCssStyle = "white-space: nowrap;";

        // procedure_11
        $this->procedure_11->CellCssStyle = "white-space: nowrap;";

        // procedure_12
        $this->procedure_12->CellCssStyle = "white-space: nowrap;";

        // procedure_13
        $this->procedure_13->CellCssStyle = "white-space: nowrap;";

        // procedure_14
        $this->procedure_14->CellCssStyle = "white-space: nowrap;";

        // procedure_15
        $this->procedure_15->CellCssStyle = "white-space: nowrap;";

        // isanestesi
        $this->isanestesi->CellCssStyle = "white-space: nowrap;";

        // isreposisi
        $this->isreposisi->CellCssStyle = "white-space: nowrap;";

        // islab
        $this->islab->CellCssStyle = "white-space: nowrap;";

        // isro
        $this->isro->CellCssStyle = "white-space: nowrap;";

        // isekg
        $this->isekg->CellCssStyle = "white-space: nowrap;";

        // ishecting
        $this->ishecting->CellCssStyle = "white-space: nowrap;";

        // isgips
        $this->isgips->CellCssStyle = "white-space: nowrap;";

        // islengkap
        $this->islengkap->CellCssStyle = "white-space: nowrap;";

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

            // TGLKONTROL
            $this->TGLKONTROL->LinkCustomAttributes = "";
            $this->TGLKONTROL->HrefValue = "";
            $this->TGLKONTROL->TooltipValue = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->LinkCustomAttributes = "";
            $this->IDXDAFTAR->HrefValue = "";
            $this->IDXDAFTAR->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
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

            // TGLKONTROL
            $this->TGLKONTROL->EditAttrs["class"] = "form-control";
            $this->TGLKONTROL->EditCustomAttributes = "";
            $this->TGLKONTROL->EditValue = HtmlEncode(FormatDateTime($this->TGLKONTROL->CurrentValue, 8));
            $this->TGLKONTROL->PlaceHolder = RemoveHtml($this->TGLKONTROL->caption());

            // IDXDAFTAR
            $this->IDXDAFTAR->EditAttrs["class"] = "form-control";
            $this->IDXDAFTAR->EditCustomAttributes = "";
            $this->IDXDAFTAR->EditValue = HtmlEncode($this->IDXDAFTAR->CurrentValue);
            $this->IDXDAFTAR->PlaceHolder = RemoveHtml($this->IDXDAFTAR->caption());

            // Add refer script

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

            // TGLKONTROL
            $this->TGLKONTROL->LinkCustomAttributes = "";
            $this->TGLKONTROL->HrefValue = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->LinkCustomAttributes = "";
            $this->IDXDAFTAR->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
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

            // TGLKONTROL
            $this->TGLKONTROL->EditAttrs["class"] = "form-control";
            $this->TGLKONTROL->EditCustomAttributes = "";
            $this->TGLKONTROL->EditValue = HtmlEncode(FormatDateTime($this->TGLKONTROL->CurrentValue, 8));
            $this->TGLKONTROL->PlaceHolder = RemoveHtml($this->TGLKONTROL->caption());

            // IDXDAFTAR
            $this->IDXDAFTAR->EditAttrs["class"] = "form-control";
            $this->IDXDAFTAR->EditCustomAttributes = "";
            $this->IDXDAFTAR->EditValue = HtmlEncode($this->IDXDAFTAR->CurrentValue);
            $this->IDXDAFTAR->PlaceHolder = RemoveHtml($this->IDXDAFTAR->caption());

            // Edit refer script

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

            // TGLKONTROL
            $this->TGLKONTROL->LinkCustomAttributes = "";
            $this->TGLKONTROL->HrefValue = "";

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
        if ($this->TGLKONTROL->Required) {
            if (!$this->TGLKONTROL->IsDetailKey && EmptyValue($this->TGLKONTROL->FormValue)) {
                $this->TGLKONTROL->addErrorMessage(str_replace("%s", $this->TGLKONTROL->caption(), $this->TGLKONTROL->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->TGLKONTROL->FormValue)) {
            $this->TGLKONTROL->addErrorMessage($this->TGLKONTROL->getErrorMessage(false));
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

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $deleteRows = true;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAll($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }

        // Clone old rows
        $rsold = $rows;

        // Call row deleting event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $deleteRows = $this->rowDeleting($row);
                if (!$deleteRows) {
                    break;
                }
            }
        }
        if ($deleteRows) {
            $key = "";
            foreach ($rsold as $row) {
                $thisKey = "";
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['ID'];
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }
                $deleteRows = $this->delete($row); // Delete
                if ($deleteRows === false) {
                    break;
                }
                if ($key != "") {
                    $key .= ", ";
                }
                $key .= $thisKey;
            }
        }
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }

        // Call Row Deleted event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $this->rowDeleted($row);
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
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

            // DATE_OF_DIAGNOSA
            $this->DATE_OF_DIAGNOSA->setDbValueDef($rsnew, UnFormatDateTime($this->DATE_OF_DIAGNOSA->CurrentValue, 11), null, $this->DATE_OF_DIAGNOSA->ReadOnly);

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->setDbValueDef($rsnew, $this->DIAGNOSA_ID->CurrentValue, null, $this->DIAGNOSA_ID->ReadOnly);

            // ANAMNASE
            $this->ANAMNASE->setDbValueDef($rsnew, $this->ANAMNASE->CurrentValue, null, $this->ANAMNASE->ReadOnly);

            // PEMERIKSAAN
            $this->PEMERIKSAAN->setDbValueDef($rsnew, $this->PEMERIKSAAN->CurrentValue, null, $this->PEMERIKSAAN->ReadOnly);

            // TERAPHY_DESC
            $this->TERAPHY_DESC->setDbValueDef($rsnew, $this->TERAPHY_DESC->CurrentValue, null, $this->TERAPHY_DESC->ReadOnly);

            // TGLKONTROL
            $this->TGLKONTROL->setDbValueDef($rsnew, UnFormatDateTime($this->TGLKONTROL->CurrentValue, 0), null, $this->TGLKONTROL->ReadOnly);

            // IDXDAFTAR
            $this->IDXDAFTAR->setDbValueDef($rsnew, $this->IDXDAFTAR->CurrentValue, null, $this->IDXDAFTAR->ReadOnly);

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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set up foreign key field value from Session
        if ($this->getCurrentMasterTable() == "V_RIWAYAT_RM") {
            $this->VISIT_ID->CurrentValue = $this->VISIT_ID->getSessionValue();
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

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

        // TGLKONTROL
        $this->TGLKONTROL->setDbValueDef($rsnew, UnFormatDateTime($this->TGLKONTROL->CurrentValue, 0), null, false);

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
        // Hide foreign keys
        $masterTblVar = $this->getCurrentMasterTable();
        if ($masterTblVar == "V_RIWAYAT_RM") {
            $masterTbl = Container("V_RIWAYAT_RM");
            $this->VISIT_ID->Visible = false;
            if ($masterTbl->EventCancelled) {
                $this->EventCancelled = true;
            }
        }
        $this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }
}
