<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienVisitationGrid extends PasienVisitation
{
    use MessagesTrait;

    // Page ID
    public $PageID = "grid";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'PASIEN_VISITATION';

    // Page object name
    public $PageObjName = "PasienVisitationGrid";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fPASIEN_VISITATIONgrid";
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

        // Table object (PASIEN_VISITATION)
        if (!isset($GLOBALS["PASIEN_VISITATION"]) || get_class($GLOBALS["PASIEN_VISITATION"]) == PROJECT_NAMESPACE . "PASIEN_VISITATION") {
            $GLOBALS["PASIEN_VISITATION"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        $this->AddUrl = "PasienVisitationAdd";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'PASIEN_VISITATION');
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
                $doc = new $class(Container("PASIEN_VISITATION"));
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
            $key .= @$ar['IDXDAFTAR'];
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
            $this->MODIFIED_BY->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->MODIFIED_DATE->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->MODIFIED_FROM->Visible = false;
        }
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->IDXDAFTAR->Visible = false;
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
    public $SearchFieldsPerRow = 1; // For extended search
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
        $this->VISIT_ID->Visible = false;
        $this->TICKET_NO->setVisibility();
        $this->NO_REGISTRATION->setVisibility();
        $this->DIANTAR_OLEH->Visible = false;
        $this->STATUS_PASIEN_ID->setVisibility();
        $this->PASIEN_ID->setVisibility();
        $this->RUJUKAN_ID->Visible = false;
        $this->ADDRESS_OF_RUJUKAN->Visible = false;
        $this->REASON_ID->Visible = false;
        $this->WAY_ID->Visible = false;
        $this->PATIENT_CATEGORY_ID->Visible = false;
        $this->VISIT_DATE->setVisibility();
        $this->BOOKED_DATE->Visible = false;
        $this->ISNEW->Visible = false;
        $this->KDPOLI_EKS->Visible = false;
        $this->FOLLOW_UP->Visible = false;
        $this->PLACE_TYPE->Visible = false;
        $this->CLINIC_ID->setVisibility();
        $this->RESPONTGLPLG_DESC->Visible = false;
        $this->CLINIC_ID_FROM->Visible = false;
        $this->CLASS_ROOM_ID->Visible = false;
        $this->BED_ID->Visible = false;
        $this->KELUAR_ID->Visible = false;
        $this->IN_DATE->Visible = false;
        $this->EXIT_DATE->Visible = false;
        $this->GENDER->setVisibility();
        $this->KODE_AGAMA->Visible = false;
        $this->VISITOR_ADDRESS->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_FROM->Visible = false;
        $this->EMPLOYEE_ID->setVisibility();
        $this->EMPLOYEE_ID_FROM->Visible = false;
        $this->RESPONSIBLE_ID->Visible = false;
        $this->RESPONSIBLE->Visible = false;
        $this->FAMILY_STATUS_ID->Visible = false;
        $this->ISATTENDED->Visible = false;
        $this->PAYOR_ID->setVisibility();
        $this->CLASS_ID->setVisibility();
        $this->ISPERTARIF->Visible = false;
        $this->KAL_ID->Visible = false;
        $this->EMPLOYEE_INAP->Visible = false;
        $this->KARYAWAN->Visible = false;
        $this->ACCOUNT_ID->Visible = false;
        $this->CLASS_ID_PLAFOND->Visible = false;
        $this->BACKCHARGE->Visible = false;
        $this->COVERAGE_ID->Visible = false;
        $this->AGEYEAR->setVisibility();
        $this->AGEMONTH->Visible = false;
        $this->AGEDAY->Visible = false;
        $this->RECOMENDATION->Visible = false;
        $this->CONCLUSION->Visible = false;
        $this->SPECIMENNO->Visible = false;
        $this->LOCKED->Visible = false;
        $this->RM_OUT_DATE->Visible = false;
        $this->RM_IN_DATE->Visible = false;
        $this->LAMA_PINJAM->Visible = false;
        $this->STANDAR_RJ->Visible = false;
        $this->LENGKAP_RJ->Visible = false;
        $this->LENGKAP_RI->Visible = false;
        $this->RESEND_RM_DATE->Visible = false;
        $this->LENGKAP_RM1->Visible = false;
        $this->LENGKAP_RESUME->Visible = false;
        $this->LENGKAP_ANAMNESIS->Visible = false;
        $this->LENGKAP_CONSENT->Visible = false;
        $this->LENGKAP_ANESTESI->Visible = false;
        $this->LENGKAP_OP->Visible = false;
        $this->BACK_RM_DATE->Visible = false;
        $this->VALID_RM_DATE->Visible = false;
        $this->NO_SKP->Visible = false;
        $this->NO_SKPINAP->Visible = false;
        $this->ticket_all->Visible = false;
        $this->tanggal_rujukan->Visible = false;
        $this->ISRJ->Visible = false;
        $this->ASALRUJUKAN->Visible = false;
        $this->NORUJUKAN->Visible = false;
        $this->DIAG_AWAL->Visible = false;
        $this->DIAGNOSA_ID->Visible = false;
        $this->PPKRUJUKAN->Visible = false;
        $this->LOKASILAKA->Visible = false;
        $this->KDPOLI->Visible = false;
        $this->EDIT_SEP->Visible = false;
        $this->DELETE_SEP->Visible = false;
        $this->AKTIF->Visible = false;
        $this->BILL_INAP->Visible = false;
        $this->SEP_PRINTDATE->Visible = false;
        $this->MAPPING_SEP->Visible = false;
        $this->TRANS_ID->Visible = false;
        $this->COB->Visible = false;
        $this->PENJAMIN->Visible = false;
        $this->RESPONSEP->Visible = false;
        $this->APPROVAL_DESC->Visible = false;
        $this->APPROVAL_RESPONAJUKAN->Visible = false;
        $this->APPROVAL_RESPONAPPROV->Visible = false;
        $this->RESPONPOST_VKLAIM->Visible = false;
        $this->RESPONPUT_VKLAIM->Visible = false;
        $this->RESPONDEL_VKLAIM->Visible = false;
        $this->CALL_TIMES->Visible = false;
        $this->CALL_DATE->Visible = false;
        $this->CALL_DATES->Visible = false;
        $this->SERVED_DATE->Visible = false;
        $this->SERVED_INAP->Visible = false;
        $this->KDDPJP1->Visible = false;
        $this->KDDPJP->Visible = false;
        $this->DESCRIPTION->Visible = false;
        $this->tgl_kontrol->Visible = false;
        $this->Faskes->Visible = false;
        $this->SEP->setVisibility();
        $this->IDXDAFTAR->Visible = false;
        $this->idbooking->setVisibility();
        $this->id_tujuan->setVisibility();
        $this->id_penunjang->setVisibility();
        $this->id_pembiayaan->setVisibility();
        $this->id_procedure->setVisibility();
        $this->id_aspel->setVisibility();
        $this->id_kelas->setVisibility();
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
        $this->setupLookupOptions($this->STATUS_PASIEN_ID);
        $this->setupLookupOptions($this->REASON_ID);
        $this->setupLookupOptions($this->WAY_ID);
        $this->setupLookupOptions($this->CLINIC_ID);
        $this->setupLookupOptions($this->KELUAR_ID);
        $this->setupLookupOptions($this->GENDER);
        $this->setupLookupOptions($this->KODE_AGAMA);
        $this->setupLookupOptions($this->EMPLOYEE_ID);
        $this->setupLookupOptions($this->CLASS_ID);
        $this->setupLookupOptions($this->KAL_ID);
        $this->setupLookupOptions($this->COVERAGE_ID);
        $this->setupLookupOptions($this->DIAG_AWAL);
        $this->setupLookupOptions($this->DIAGNOSA_ID);
        $this->setupLookupOptions($this->PPKRUJUKAN);

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
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "cv_pasien") {
            $masterTbl = Container("cv_pasien");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("CvPasienList"); // Return to master page
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
                    $key .= $this->IDXDAFTAR->CurrentValue;

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
        if ($CurrentForm->hasValue("x_TICKET_NO") && $CurrentForm->hasValue("o_TICKET_NO") && $this->TICKET_NO->CurrentValue != $this->TICKET_NO->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_NO_REGISTRATION") && $CurrentForm->hasValue("o_NO_REGISTRATION") && $this->NO_REGISTRATION->CurrentValue != $this->NO_REGISTRATION->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_STATUS_PASIEN_ID") && $CurrentForm->hasValue("o_STATUS_PASIEN_ID") && $this->STATUS_PASIEN_ID->CurrentValue != $this->STATUS_PASIEN_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_PASIEN_ID") && $CurrentForm->hasValue("o_PASIEN_ID") && $this->PASIEN_ID->CurrentValue != $this->PASIEN_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_VISIT_DATE") && $CurrentForm->hasValue("o_VISIT_DATE") && $this->VISIT_DATE->CurrentValue != $this->VISIT_DATE->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_CLINIC_ID") && $CurrentForm->hasValue("o_CLINIC_ID") && $this->CLINIC_ID->CurrentValue != $this->CLINIC_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_GENDER") && $CurrentForm->hasValue("o_GENDER") && $this->GENDER->CurrentValue != $this->GENDER->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_EMPLOYEE_ID") && $CurrentForm->hasValue("o_EMPLOYEE_ID") && $this->EMPLOYEE_ID->CurrentValue != $this->EMPLOYEE_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_PAYOR_ID") && $CurrentForm->hasValue("o_PAYOR_ID") && $this->PAYOR_ID->CurrentValue != $this->PAYOR_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_CLASS_ID") && $CurrentForm->hasValue("o_CLASS_ID") && $this->CLASS_ID->CurrentValue != $this->CLASS_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_AGEYEAR") && $CurrentForm->hasValue("o_AGEYEAR") && $this->AGEYEAR->CurrentValue != $this->AGEYEAR->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_SEP") && $CurrentForm->hasValue("o_SEP") && $this->SEP->CurrentValue != $this->SEP->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_idbooking") && $CurrentForm->hasValue("o_idbooking") && $this->idbooking->CurrentValue != $this->idbooking->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_id_tujuan") && $CurrentForm->hasValue("o_id_tujuan") && $this->id_tujuan->CurrentValue != $this->id_tujuan->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_id_penunjang") && $CurrentForm->hasValue("o_id_penunjang") && $this->id_penunjang->CurrentValue != $this->id_penunjang->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_id_pembiayaan") && $CurrentForm->hasValue("o_id_pembiayaan") && $this->id_pembiayaan->CurrentValue != $this->id_pembiayaan->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_id_procedure") && $CurrentForm->hasValue("o_id_procedure") && $this->id_procedure->CurrentValue != $this->id_procedure->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_id_aspel") && $CurrentForm->hasValue("o_id_aspel") && $this->id_aspel->CurrentValue != $this->id_aspel->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_id_kelas") && $CurrentForm->hasValue("o_id_kelas") && $this->id_kelas->CurrentValue != $this->id_kelas->OldValue) {
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
        $this->TICKET_NO->clearErrorMessage();
        $this->NO_REGISTRATION->clearErrorMessage();
        $this->STATUS_PASIEN_ID->clearErrorMessage();
        $this->PASIEN_ID->clearErrorMessage();
        $this->VISIT_DATE->clearErrorMessage();
        $this->CLINIC_ID->clearErrorMessage();
        $this->GENDER->clearErrorMessage();
        $this->EMPLOYEE_ID->clearErrorMessage();
        $this->PAYOR_ID->clearErrorMessage();
        $this->CLASS_ID->clearErrorMessage();
        $this->AGEYEAR->clearErrorMessage();
        $this->SEP->clearErrorMessage();
        $this->idbooking->clearErrorMessage();
        $this->id_tujuan->clearErrorMessage();
        $this->id_penunjang->clearErrorMessage();
        $this->id_pembiayaan->clearErrorMessage();
        $this->id_procedure->clearErrorMessage();
        $this->id_aspel->clearErrorMessage();
        $this->id_kelas->clearErrorMessage();
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
            $this->DefaultSort = "[VISIT_DATE] DESC";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($this->VISIT_DATE->getSort() != "") {
                    $useDefaultSort = false;
                }
                if ($useDefaultSort) {
                    $this->VISIT_DATE->setSort("DESC");
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
                        $this->NO_REGISTRATION->setSessionValue("");
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
                if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
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
        $this->VISIT_ID->CurrentValue = null;
        $this->VISIT_ID->OldValue = $this->VISIT_ID->CurrentValue;
        $this->TICKET_NO->CurrentValue = null;
        $this->TICKET_NO->OldValue = $this->TICKET_NO->CurrentValue;
        $this->NO_REGISTRATION->CurrentValue = null;
        $this->NO_REGISTRATION->OldValue = $this->NO_REGISTRATION->CurrentValue;
        $this->DIANTAR_OLEH->CurrentValue = null;
        $this->DIANTAR_OLEH->OldValue = $this->DIANTAR_OLEH->CurrentValue;
        $this->STATUS_PASIEN_ID->CurrentValue = "1";
        $this->STATUS_PASIEN_ID->OldValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->CurrentValue = null;
        $this->PASIEN_ID->OldValue = $this->PASIEN_ID->CurrentValue;
        $this->RUJUKAN_ID->CurrentValue = 1;
        $this->RUJUKAN_ID->OldValue = $this->RUJUKAN_ID->CurrentValue;
        $this->ADDRESS_OF_RUJUKAN->CurrentValue = null;
        $this->ADDRESS_OF_RUJUKAN->OldValue = $this->ADDRESS_OF_RUJUKAN->CurrentValue;
        $this->REASON_ID->CurrentValue = "1";
        $this->REASON_ID->OldValue = $this->REASON_ID->CurrentValue;
        $this->WAY_ID->CurrentValue = "3";
        $this->WAY_ID->OldValue = $this->WAY_ID->CurrentValue;
        $this->PATIENT_CATEGORY_ID->CurrentValue = '0';
        $this->PATIENT_CATEGORY_ID->OldValue = $this->PATIENT_CATEGORY_ID->CurrentValue;
        $this->VISIT_DATE->CurrentValue = CurrentDateTime();
        $this->VISIT_DATE->OldValue = $this->VISIT_DATE->CurrentValue;
        $this->BOOKED_DATE->CurrentValue = CurrentDateTime();
        $this->BOOKED_DATE->OldValue = $this->BOOKED_DATE->CurrentValue;
        $this->ISNEW->CurrentValue = '0';
        $this->ISNEW->OldValue = $this->ISNEW->CurrentValue;
        $this->KDPOLI_EKS->CurrentValue = "0";
        $this->KDPOLI_EKS->OldValue = $this->KDPOLI_EKS->CurrentValue;
        $this->FOLLOW_UP->CurrentValue = 0;
        $this->FOLLOW_UP->OldValue = $this->FOLLOW_UP->CurrentValue;
        $this->PLACE_TYPE->CurrentValue = 0;
        $this->PLACE_TYPE->OldValue = $this->PLACE_TYPE->CurrentValue;
        $this->CLINIC_ID->CurrentValue = null;
        $this->CLINIC_ID->OldValue = $this->CLINIC_ID->CurrentValue;
        $this->RESPONTGLPLG_DESC->CurrentValue = '2';
        $this->RESPONTGLPLG_DESC->OldValue = $this->RESPONTGLPLG_DESC->CurrentValue;
        $this->CLINIC_ID_FROM->CurrentValue = "P000";
        $this->CLINIC_ID_FROM->OldValue = $this->CLINIC_ID_FROM->CurrentValue;
        $this->CLASS_ROOM_ID->CurrentValue = null;
        $this->CLASS_ROOM_ID->OldValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->BED_ID->CurrentValue = null;
        $this->BED_ID->OldValue = $this->BED_ID->CurrentValue;
        $this->KELUAR_ID->CurrentValue = null;
        $this->KELUAR_ID->OldValue = $this->KELUAR_ID->CurrentValue;
        $this->IN_DATE->CurrentValue = null;
        $this->IN_DATE->OldValue = $this->IN_DATE->CurrentValue;
        $this->EXIT_DATE->CurrentValue = null;
        $this->EXIT_DATE->OldValue = $this->EXIT_DATE->CurrentValue;
        $this->GENDER->CurrentValue = null;
        $this->GENDER->OldValue = $this->GENDER->CurrentValue;
        $this->KODE_AGAMA->CurrentValue = null;
        $this->KODE_AGAMA->OldValue = $this->KODE_AGAMA->CurrentValue;
        $this->VISITOR_ADDRESS->CurrentValue = null;
        $this->VISITOR_ADDRESS->OldValue = $this->VISITOR_ADDRESS->CurrentValue;
        $this->MODIFIED_BY->CurrentValue = null;
        $this->MODIFIED_BY->OldValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_DATE->CurrentValue = null;
        $this->MODIFIED_DATE->OldValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_FROM->CurrentValue = null;
        $this->MODIFIED_FROM->OldValue = $this->MODIFIED_FROM->CurrentValue;
        $this->EMPLOYEE_ID->CurrentValue = null;
        $this->EMPLOYEE_ID->OldValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID_FROM->CurrentValue = null;
        $this->EMPLOYEE_ID_FROM->OldValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $this->RESPONSIBLE_ID->CurrentValue = 2;
        $this->RESPONSIBLE_ID->OldValue = $this->RESPONSIBLE_ID->CurrentValue;
        $this->RESPONSIBLE->CurrentValue = null;
        $this->RESPONSIBLE->OldValue = $this->RESPONSIBLE->CurrentValue;
        $this->FAMILY_STATUS_ID->CurrentValue = null;
        $this->FAMILY_STATUS_ID->OldValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->ISATTENDED->CurrentValue = '0';
        $this->ISATTENDED->OldValue = $this->ISATTENDED->CurrentValue;
        $this->PAYOR_ID->CurrentValue = null;
        $this->PAYOR_ID->OldValue = $this->PAYOR_ID->CurrentValue;
        $this->CLASS_ID->CurrentValue = null;
        $this->CLASS_ID->OldValue = $this->CLASS_ID->CurrentValue;
        $this->ISPERTARIF->CurrentValue = "0";
        $this->ISPERTARIF->OldValue = $this->ISPERTARIF->CurrentValue;
        $this->KAL_ID->CurrentValue = null;
        $this->KAL_ID->OldValue = $this->KAL_ID->CurrentValue;
        $this->EMPLOYEE_INAP->CurrentValue = null;
        $this->EMPLOYEE_INAP->OldValue = $this->EMPLOYEE_INAP->CurrentValue;
        $this->KARYAWAN->CurrentValue = null;
        $this->KARYAWAN->OldValue = $this->KARYAWAN->CurrentValue;
        $this->ACCOUNT_ID->CurrentValue = null;
        $this->ACCOUNT_ID->OldValue = $this->ACCOUNT_ID->CurrentValue;
        $this->CLASS_ID_PLAFOND->CurrentValue = 0;
        $this->CLASS_ID_PLAFOND->OldValue = $this->CLASS_ID_PLAFOND->CurrentValue;
        $this->BACKCHARGE->CurrentValue = "0";
        $this->BACKCHARGE->OldValue = $this->BACKCHARGE->CurrentValue;
        $this->COVERAGE_ID->CurrentValue = null;
        $this->COVERAGE_ID->OldValue = $this->COVERAGE_ID->CurrentValue;
        $this->AGEYEAR->CurrentValue = null;
        $this->AGEYEAR->OldValue = $this->AGEYEAR->CurrentValue;
        $this->AGEMONTH->CurrentValue = null;
        $this->AGEMONTH->OldValue = $this->AGEMONTH->CurrentValue;
        $this->AGEDAY->CurrentValue = null;
        $this->AGEDAY->OldValue = $this->AGEDAY->CurrentValue;
        $this->RECOMENDATION->CurrentValue = null;
        $this->RECOMENDATION->OldValue = $this->RECOMENDATION->CurrentValue;
        $this->CONCLUSION->CurrentValue = null;
        $this->CONCLUSION->OldValue = $this->CONCLUSION->CurrentValue;
        $this->SPECIMENNO->CurrentValue = null;
        $this->SPECIMENNO->OldValue = $this->SPECIMENNO->CurrentValue;
        $this->LOCKED->CurrentValue = "0";
        $this->LOCKED->OldValue = $this->LOCKED->CurrentValue;
        $this->RM_OUT_DATE->CurrentValue = null;
        $this->RM_OUT_DATE->OldValue = $this->RM_OUT_DATE->CurrentValue;
        $this->RM_IN_DATE->CurrentValue = null;
        $this->RM_IN_DATE->OldValue = $this->RM_IN_DATE->CurrentValue;
        $this->LAMA_PINJAM->CurrentValue = null;
        $this->LAMA_PINJAM->OldValue = $this->LAMA_PINJAM->CurrentValue;
        $this->STANDAR_RJ->CurrentValue = null;
        $this->STANDAR_RJ->OldValue = $this->STANDAR_RJ->CurrentValue;
        $this->LENGKAP_RJ->CurrentValue = null;
        $this->LENGKAP_RJ->OldValue = $this->LENGKAP_RJ->CurrentValue;
        $this->LENGKAP_RI->CurrentValue = null;
        $this->LENGKAP_RI->OldValue = $this->LENGKAP_RI->CurrentValue;
        $this->RESEND_RM_DATE->CurrentValue = null;
        $this->RESEND_RM_DATE->OldValue = $this->RESEND_RM_DATE->CurrentValue;
        $this->LENGKAP_RM1->CurrentValue = null;
        $this->LENGKAP_RM1->OldValue = $this->LENGKAP_RM1->CurrentValue;
        $this->LENGKAP_RESUME->CurrentValue = null;
        $this->LENGKAP_RESUME->OldValue = $this->LENGKAP_RESUME->CurrentValue;
        $this->LENGKAP_ANAMNESIS->CurrentValue = null;
        $this->LENGKAP_ANAMNESIS->OldValue = $this->LENGKAP_ANAMNESIS->CurrentValue;
        $this->LENGKAP_CONSENT->CurrentValue = null;
        $this->LENGKAP_CONSENT->OldValue = $this->LENGKAP_CONSENT->CurrentValue;
        $this->LENGKAP_ANESTESI->CurrentValue = null;
        $this->LENGKAP_ANESTESI->OldValue = $this->LENGKAP_ANESTESI->CurrentValue;
        $this->LENGKAP_OP->CurrentValue = null;
        $this->LENGKAP_OP->OldValue = $this->LENGKAP_OP->CurrentValue;
        $this->BACK_RM_DATE->CurrentValue = null;
        $this->BACK_RM_DATE->OldValue = $this->BACK_RM_DATE->CurrentValue;
        $this->VALID_RM_DATE->CurrentValue = null;
        $this->VALID_RM_DATE->OldValue = $this->VALID_RM_DATE->CurrentValue;
        $this->NO_SKP->CurrentValue = null;
        $this->NO_SKP->OldValue = $this->NO_SKP->CurrentValue;
        $this->NO_SKPINAP->CurrentValue = null;
        $this->NO_SKPINAP->OldValue = $this->NO_SKPINAP->CurrentValue;
        $this->ticket_all->CurrentValue = null;
        $this->ticket_all->OldValue = $this->ticket_all->CurrentValue;
        $this->tanggal_rujukan->CurrentValue = CurrentDateTime();
        $this->tanggal_rujukan->OldValue = $this->tanggal_rujukan->CurrentValue;
        $this->ISRJ->CurrentValue = "2";
        $this->ISRJ->OldValue = $this->ISRJ->CurrentValue;
        $this->ASALRUJUKAN->CurrentValue = null;
        $this->ASALRUJUKAN->OldValue = $this->ASALRUJUKAN->CurrentValue;
        $this->NORUJUKAN->CurrentValue = null;
        $this->NORUJUKAN->OldValue = $this->NORUJUKAN->CurrentValue;
        $this->DIAG_AWAL->CurrentValue = null;
        $this->DIAG_AWAL->OldValue = $this->DIAG_AWAL->CurrentValue;
        $this->DIAGNOSA_ID->CurrentValue = null;
        $this->DIAGNOSA_ID->OldValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->PPKRUJUKAN->CurrentValue = null;
        $this->PPKRUJUKAN->OldValue = $this->PPKRUJUKAN->CurrentValue;
        $this->LOKASILAKA->CurrentValue = null;
        $this->LOKASILAKA->OldValue = $this->LOKASILAKA->CurrentValue;
        $this->KDPOLI->CurrentValue = null;
        $this->KDPOLI->OldValue = $this->KDPOLI->CurrentValue;
        $this->EDIT_SEP->CurrentValue = "000000";
        $this->EDIT_SEP->OldValue = $this->EDIT_SEP->CurrentValue;
        $this->DELETE_SEP->CurrentValue = null;
        $this->DELETE_SEP->OldValue = $this->DELETE_SEP->CurrentValue;
        $this->AKTIF->CurrentValue = null;
        $this->AKTIF->OldValue = $this->AKTIF->CurrentValue;
        $this->BILL_INAP->CurrentValue = null;
        $this->BILL_INAP->OldValue = $this->BILL_INAP->CurrentValue;
        $this->SEP_PRINTDATE->CurrentValue = null;
        $this->SEP_PRINTDATE->OldValue = $this->SEP_PRINTDATE->CurrentValue;
        $this->MAPPING_SEP->CurrentValue = null;
        $this->MAPPING_SEP->OldValue = $this->MAPPING_SEP->CurrentValue;
        $this->TRANS_ID->CurrentValue = null;
        $this->TRANS_ID->OldValue = $this->TRANS_ID->CurrentValue;
        $this->COB->CurrentValue = "0";
        $this->COB->OldValue = $this->COB->CurrentValue;
        $this->PENJAMIN->CurrentValue = null;
        $this->PENJAMIN->OldValue = $this->PENJAMIN->CurrentValue;
        $this->RESPONSEP->CurrentValue = null;
        $this->RESPONSEP->OldValue = $this->RESPONSEP->CurrentValue;
        $this->APPROVAL_DESC->CurrentValue = null;
        $this->APPROVAL_DESC->OldValue = $this->APPROVAL_DESC->CurrentValue;
        $this->APPROVAL_RESPONAJUKAN->CurrentValue = null;
        $this->APPROVAL_RESPONAJUKAN->OldValue = $this->APPROVAL_RESPONAJUKAN->CurrentValue;
        $this->APPROVAL_RESPONAPPROV->CurrentValue = null;
        $this->APPROVAL_RESPONAPPROV->OldValue = $this->APPROVAL_RESPONAPPROV->CurrentValue;
        $this->RESPONPOST_VKLAIM->CurrentValue = null;
        $this->RESPONPOST_VKLAIM->OldValue = $this->RESPONPOST_VKLAIM->CurrentValue;
        $this->RESPONPUT_VKLAIM->CurrentValue = null;
        $this->RESPONPUT_VKLAIM->OldValue = $this->RESPONPUT_VKLAIM->CurrentValue;
        $this->RESPONDEL_VKLAIM->CurrentValue = null;
        $this->RESPONDEL_VKLAIM->OldValue = $this->RESPONDEL_VKLAIM->CurrentValue;
        $this->CALL_TIMES->CurrentValue = 1;
        $this->CALL_TIMES->OldValue = $this->CALL_TIMES->CurrentValue;
        $this->CALL_DATE->CurrentValue = null;
        $this->CALL_DATE->OldValue = $this->CALL_DATE->CurrentValue;
        $this->CALL_DATES->CurrentValue = null;
        $this->CALL_DATES->OldValue = $this->CALL_DATES->CurrentValue;
        $this->SERVED_DATE->CurrentValue = null;
        $this->SERVED_DATE->OldValue = $this->SERVED_DATE->CurrentValue;
        $this->SERVED_INAP->CurrentValue = null;
        $this->SERVED_INAP->OldValue = $this->SERVED_INAP->CurrentValue;
        $this->KDDPJP1->CurrentValue = null;
        $this->KDDPJP1->OldValue = $this->KDDPJP1->CurrentValue;
        $this->KDDPJP->CurrentValue = null;
        $this->KDDPJP->OldValue = $this->KDDPJP->CurrentValue;
        $this->DESCRIPTION->CurrentValue = "-";
        $this->DESCRIPTION->OldValue = $this->DESCRIPTION->CurrentValue;
        $this->tgl_kontrol->CurrentValue = null;
        $this->tgl_kontrol->OldValue = $this->tgl_kontrol->CurrentValue;
        $this->Faskes->CurrentValue = "1";
        $this->Faskes->OldValue = $this->Faskes->CurrentValue;
        $this->SEP->CurrentValue = null;
        $this->SEP->OldValue = $this->SEP->CurrentValue;
        $this->IDXDAFTAR->CurrentValue = null;
        $this->IDXDAFTAR->OldValue = $this->IDXDAFTAR->CurrentValue;
        $this->idbooking->CurrentValue = null;
        $this->idbooking->OldValue = $this->idbooking->CurrentValue;
        $this->id_tujuan->CurrentValue = null;
        $this->id_tujuan->OldValue = $this->id_tujuan->CurrentValue;
        $this->id_penunjang->CurrentValue = null;
        $this->id_penunjang->OldValue = $this->id_penunjang->CurrentValue;
        $this->id_pembiayaan->CurrentValue = null;
        $this->id_pembiayaan->OldValue = $this->id_pembiayaan->CurrentValue;
        $this->id_procedure->CurrentValue = null;
        $this->id_procedure->OldValue = $this->id_procedure->CurrentValue;
        $this->id_aspel->CurrentValue = null;
        $this->id_aspel->OldValue = $this->id_aspel->CurrentValue;
        $this->id_kelas->CurrentValue = null;
        $this->id_kelas->OldValue = $this->id_kelas->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $CurrentForm->FormName = $this->FormName;

        // Check field name 'TICKET_NO' first before field var 'x_TICKET_NO'
        $val = $CurrentForm->hasValue("TICKET_NO") ? $CurrentForm->getValue("TICKET_NO") : $CurrentForm->getValue("x_TICKET_NO");
        if (!$this->TICKET_NO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TICKET_NO->Visible = false; // Disable update for API request
            } else {
                $this->TICKET_NO->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_TICKET_NO")) {
            $this->TICKET_NO->setOldValue($CurrentForm->getValue("o_TICKET_NO"));
        }

        // Check field name 'NO_REGISTRATION' first before field var 'x_NO_REGISTRATION'
        $val = $CurrentForm->hasValue("NO_REGISTRATION") ? $CurrentForm->getValue("NO_REGISTRATION") : $CurrentForm->getValue("x_NO_REGISTRATION");
        if (!$this->NO_REGISTRATION->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_REGISTRATION->Visible = false; // Disable update for API request
            } else {
                $this->NO_REGISTRATION->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_NO_REGISTRATION")) {
            $this->NO_REGISTRATION->setOldValue($CurrentForm->getValue("o_NO_REGISTRATION"));
        }

        // Check field name 'STATUS_PASIEN_ID' first before field var 'x_STATUS_PASIEN_ID'
        $val = $CurrentForm->hasValue("STATUS_PASIEN_ID") ? $CurrentForm->getValue("STATUS_PASIEN_ID") : $CurrentForm->getValue("x_STATUS_PASIEN_ID");
        if (!$this->STATUS_PASIEN_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->STATUS_PASIEN_ID->Visible = false; // Disable update for API request
            } else {
                $this->STATUS_PASIEN_ID->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_STATUS_PASIEN_ID")) {
            $this->STATUS_PASIEN_ID->setOldValue($CurrentForm->getValue("o_STATUS_PASIEN_ID"));
        }

        // Check field name 'PASIEN_ID' first before field var 'x_PASIEN_ID'
        $val = $CurrentForm->hasValue("PASIEN_ID") ? $CurrentForm->getValue("PASIEN_ID") : $CurrentForm->getValue("x_PASIEN_ID");
        if (!$this->PASIEN_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PASIEN_ID->Visible = false; // Disable update for API request
            } else {
                $this->PASIEN_ID->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_PASIEN_ID")) {
            $this->PASIEN_ID->setOldValue($CurrentForm->getValue("o_PASIEN_ID"));
        }

        // Check field name 'VISIT_DATE' first before field var 'x_VISIT_DATE'
        $val = $CurrentForm->hasValue("VISIT_DATE") ? $CurrentForm->getValue("VISIT_DATE") : $CurrentForm->getValue("x_VISIT_DATE");
        if (!$this->VISIT_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->VISIT_DATE->Visible = false; // Disable update for API request
            } else {
                $this->VISIT_DATE->setFormValue($val);
            }
            $this->VISIT_DATE->CurrentValue = UnFormatDateTime($this->VISIT_DATE->CurrentValue, 11);
        }
        if ($CurrentForm->hasValue("o_VISIT_DATE")) {
            $this->VISIT_DATE->setOldValue($CurrentForm->getValue("o_VISIT_DATE"));
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
        if ($CurrentForm->hasValue("o_CLINIC_ID")) {
            $this->CLINIC_ID->setOldValue($CurrentForm->getValue("o_CLINIC_ID"));
        }

        // Check field name 'GENDER' first before field var 'x_GENDER'
        $val = $CurrentForm->hasValue("GENDER") ? $CurrentForm->getValue("GENDER") : $CurrentForm->getValue("x_GENDER");
        if (!$this->GENDER->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->GENDER->Visible = false; // Disable update for API request
            } else {
                $this->GENDER->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_GENDER")) {
            $this->GENDER->setOldValue($CurrentForm->getValue("o_GENDER"));
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
        if ($CurrentForm->hasValue("o_EMPLOYEE_ID")) {
            $this->EMPLOYEE_ID->setOldValue($CurrentForm->getValue("o_EMPLOYEE_ID"));
        }

        // Check field name 'PAYOR_ID' first before field var 'x_PAYOR_ID'
        $val = $CurrentForm->hasValue("PAYOR_ID") ? $CurrentForm->getValue("PAYOR_ID") : $CurrentForm->getValue("x_PAYOR_ID");
        if (!$this->PAYOR_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PAYOR_ID->Visible = false; // Disable update for API request
            } else {
                $this->PAYOR_ID->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_PAYOR_ID")) {
            $this->PAYOR_ID->setOldValue($CurrentForm->getValue("o_PAYOR_ID"));
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
        if ($CurrentForm->hasValue("o_CLASS_ID")) {
            $this->CLASS_ID->setOldValue($CurrentForm->getValue("o_CLASS_ID"));
        }

        // Check field name 'AGEYEAR' first before field var 'x_AGEYEAR'
        $val = $CurrentForm->hasValue("AGEYEAR") ? $CurrentForm->getValue("AGEYEAR") : $CurrentForm->getValue("x_AGEYEAR");
        if (!$this->AGEYEAR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->AGEYEAR->Visible = false; // Disable update for API request
            } else {
                $this->AGEYEAR->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_AGEYEAR")) {
            $this->AGEYEAR->setOldValue($CurrentForm->getValue("o_AGEYEAR"));
        }

        // Check field name 'SEP' first before field var 'x_SEP'
        $val = $CurrentForm->hasValue("SEP") ? $CurrentForm->getValue("SEP") : $CurrentForm->getValue("x_SEP");
        if (!$this->SEP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SEP->Visible = false; // Disable update for API request
            } else {
                $this->SEP->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_SEP")) {
            $this->SEP->setOldValue($CurrentForm->getValue("o_SEP"));
        }

        // Check field name 'idbooking' first before field var 'x_idbooking'
        $val = $CurrentForm->hasValue("idbooking") ? $CurrentForm->getValue("idbooking") : $CurrentForm->getValue("x_idbooking");
        if (!$this->idbooking->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->idbooking->Visible = false; // Disable update for API request
            } else {
                $this->idbooking->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_idbooking")) {
            $this->idbooking->setOldValue($CurrentForm->getValue("o_idbooking"));
        }

        // Check field name 'id_tujuan' first before field var 'x_id_tujuan'
        $val = $CurrentForm->hasValue("id_tujuan") ? $CurrentForm->getValue("id_tujuan") : $CurrentForm->getValue("x_id_tujuan");
        if (!$this->id_tujuan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_tujuan->Visible = false; // Disable update for API request
            } else {
                $this->id_tujuan->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_id_tujuan")) {
            $this->id_tujuan->setOldValue($CurrentForm->getValue("o_id_tujuan"));
        }

        // Check field name 'id_penunjang' first before field var 'x_id_penunjang'
        $val = $CurrentForm->hasValue("id_penunjang") ? $CurrentForm->getValue("id_penunjang") : $CurrentForm->getValue("x_id_penunjang");
        if (!$this->id_penunjang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_penunjang->Visible = false; // Disable update for API request
            } else {
                $this->id_penunjang->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_id_penunjang")) {
            $this->id_penunjang->setOldValue($CurrentForm->getValue("o_id_penunjang"));
        }

        // Check field name 'id_pembiayaan' first before field var 'x_id_pembiayaan'
        $val = $CurrentForm->hasValue("id_pembiayaan") ? $CurrentForm->getValue("id_pembiayaan") : $CurrentForm->getValue("x_id_pembiayaan");
        if (!$this->id_pembiayaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_pembiayaan->Visible = false; // Disable update for API request
            } else {
                $this->id_pembiayaan->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_id_pembiayaan")) {
            $this->id_pembiayaan->setOldValue($CurrentForm->getValue("o_id_pembiayaan"));
        }

        // Check field name 'id_procedure' first before field var 'x_id_procedure'
        $val = $CurrentForm->hasValue("id_procedure") ? $CurrentForm->getValue("id_procedure") : $CurrentForm->getValue("x_id_procedure");
        if (!$this->id_procedure->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_procedure->Visible = false; // Disable update for API request
            } else {
                $this->id_procedure->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_id_procedure")) {
            $this->id_procedure->setOldValue($CurrentForm->getValue("o_id_procedure"));
        }

        // Check field name 'id_aspel' first before field var 'x_id_aspel'
        $val = $CurrentForm->hasValue("id_aspel") ? $CurrentForm->getValue("id_aspel") : $CurrentForm->getValue("x_id_aspel");
        if (!$this->id_aspel->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_aspel->Visible = false; // Disable update for API request
            } else {
                $this->id_aspel->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_id_aspel")) {
            $this->id_aspel->setOldValue($CurrentForm->getValue("o_id_aspel"));
        }

        // Check field name 'id_kelas' first before field var 'x_id_kelas'
        $val = $CurrentForm->hasValue("id_kelas") ? $CurrentForm->getValue("id_kelas") : $CurrentForm->getValue("x_id_kelas");
        if (!$this->id_kelas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_kelas->Visible = false; // Disable update for API request
            } else {
                $this->id_kelas->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_id_kelas")) {
            $this->id_kelas->setOldValue($CurrentForm->getValue("o_id_kelas"));
        }

        // Check field name 'IDXDAFTAR' first before field var 'x_IDXDAFTAR'
        $val = $CurrentForm->hasValue("IDXDAFTAR") ? $CurrentForm->getValue("IDXDAFTAR") : $CurrentForm->getValue("x_IDXDAFTAR");
        if (!$this->IDXDAFTAR->IsDetailKey && !$this->isGridAdd() && !$this->isAdd()) {
            $this->IDXDAFTAR->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        if (!$this->isGridAdd() && !$this->isAdd()) {
            $this->IDXDAFTAR->CurrentValue = $this->IDXDAFTAR->FormValue;
        }
        $this->TICKET_NO->CurrentValue = $this->TICKET_NO->FormValue;
        $this->NO_REGISTRATION->CurrentValue = $this->NO_REGISTRATION->FormValue;
        $this->STATUS_PASIEN_ID->CurrentValue = $this->STATUS_PASIEN_ID->FormValue;
        $this->PASIEN_ID->CurrentValue = $this->PASIEN_ID->FormValue;
        $this->VISIT_DATE->CurrentValue = $this->VISIT_DATE->FormValue;
        $this->VISIT_DATE->CurrentValue = UnFormatDateTime($this->VISIT_DATE->CurrentValue, 11);
        $this->CLINIC_ID->CurrentValue = $this->CLINIC_ID->FormValue;
        $this->GENDER->CurrentValue = $this->GENDER->FormValue;
        $this->EMPLOYEE_ID->CurrentValue = $this->EMPLOYEE_ID->FormValue;
        $this->PAYOR_ID->CurrentValue = $this->PAYOR_ID->FormValue;
        $this->CLASS_ID->CurrentValue = $this->CLASS_ID->FormValue;
        $this->AGEYEAR->CurrentValue = $this->AGEYEAR->FormValue;
        $this->SEP->CurrentValue = $this->SEP->FormValue;
        $this->idbooking->CurrentValue = $this->idbooking->FormValue;
        $this->id_tujuan->CurrentValue = $this->id_tujuan->FormValue;
        $this->id_penunjang->CurrentValue = $this->id_penunjang->FormValue;
        $this->id_pembiayaan->CurrentValue = $this->id_pembiayaan->FormValue;
        $this->id_procedure->CurrentValue = $this->id_procedure->FormValue;
        $this->id_aspel->CurrentValue = $this->id_aspel->FormValue;
        $this->id_kelas->CurrentValue = $this->id_kelas->FormValue;
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
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->TICKET_NO->setDbValue($row['TICKET_NO']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->DIANTAR_OLEH->setDbValue($row['DIANTAR_OLEH']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->RUJUKAN_ID->setDbValue($row['RUJUKAN_ID']);
        $this->ADDRESS_OF_RUJUKAN->setDbValue($row['ADDRESS_OF_RUJUKAN']);
        $this->REASON_ID->setDbValue($row['REASON_ID']);
        $this->WAY_ID->setDbValue($row['WAY_ID']);
        $this->PATIENT_CATEGORY_ID->setDbValue($row['PATIENT_CATEGORY_ID']);
        $this->VISIT_DATE->setDbValue($row['VISIT_DATE']);
        $this->BOOKED_DATE->setDbValue($row['BOOKED_DATE']);
        $this->ISNEW->setDbValue($row['ISNEW']);
        $this->KDPOLI_EKS->setDbValue($row['KDPOLI_EKS']);
        $this->FOLLOW_UP->setDbValue($row['FOLLOW_UP']);
        $this->PLACE_TYPE->setDbValue($row['PLACE_TYPE']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->RESPONTGLPLG_DESC->setDbValue($row['RESPONTGLPLG_DESC']);
        $this->CLINIC_ID_FROM->setDbValue($row['CLINIC_ID_FROM']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->IN_DATE->setDbValue($row['IN_DATE']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->VISITOR_ADDRESS->setDbValue($row['VISITOR_ADDRESS']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->EMPLOYEE_ID_FROM->setDbValue($row['EMPLOYEE_ID_FROM']);
        $this->RESPONSIBLE_ID->setDbValue($row['RESPONSIBLE_ID']);
        $this->RESPONSIBLE->setDbValue($row['RESPONSIBLE']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->ISATTENDED->setDbValue($row['ISATTENDED']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->ISPERTARIF->setDbValue($row['ISPERTARIF']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->EMPLOYEE_INAP->setDbValue($row['EMPLOYEE_INAP']);
        $this->KARYAWAN->setDbValue($row['KARYAWAN']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->CLASS_ID_PLAFOND->setDbValue($row['CLASS_ID_PLAFOND']);
        $this->BACKCHARGE->setDbValue($row['BACKCHARGE']);
        $this->COVERAGE_ID->setDbValue($row['COVERAGE_ID']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->RECOMENDATION->setDbValue($row['RECOMENDATION']);
        $this->CONCLUSION->setDbValue($row['CONCLUSION']);
        $this->SPECIMENNO->setDbValue($row['SPECIMENNO']);
        $this->LOCKED->setDbValue($row['LOCKED']);
        $this->RM_OUT_DATE->setDbValue($row['RM_OUT_DATE']);
        $this->RM_IN_DATE->setDbValue($row['RM_IN_DATE']);
        $this->LAMA_PINJAM->setDbValue($row['LAMA_PINJAM']);
        $this->STANDAR_RJ->setDbValue($row['STANDAR_RJ']);
        $this->LENGKAP_RJ->setDbValue($row['LENGKAP_RJ']);
        $this->LENGKAP_RI->setDbValue($row['LENGKAP_RI']);
        $this->RESEND_RM_DATE->setDbValue($row['RESEND_RM_DATE']);
        $this->LENGKAP_RM1->setDbValue($row['LENGKAP_RM1']);
        $this->LENGKAP_RESUME->setDbValue($row['LENGKAP_RESUME']);
        $this->LENGKAP_ANAMNESIS->setDbValue($row['LENGKAP_ANAMNESIS']);
        $this->LENGKAP_CONSENT->setDbValue($row['LENGKAP_CONSENT']);
        $this->LENGKAP_ANESTESI->setDbValue($row['LENGKAP_ANESTESI']);
        $this->LENGKAP_OP->setDbValue($row['LENGKAP_OP']);
        $this->BACK_RM_DATE->setDbValue($row['BACK_RM_DATE']);
        $this->VALID_RM_DATE->setDbValue($row['VALID_RM_DATE']);
        $this->NO_SKP->setDbValue($row['NO_SKP']);
        $this->NO_SKPINAP->setDbValue($row['NO_SKPINAP']);
        $this->ticket_all->setDbValue($row['ticket_all']);
        $this->tanggal_rujukan->setDbValue($row['tanggal_rujukan']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->ASALRUJUKAN->setDbValue($row['ASALRUJUKAN']);
        $this->NORUJUKAN->setDbValue($row['NORUJUKAN']);
        $this->DIAG_AWAL->setDbValue($row['DIAG_AWAL']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->PPKRUJUKAN->setDbValue($row['PPKRUJUKAN']);
        $this->LOKASILAKA->setDbValue($row['LOKASILAKA']);
        $this->KDPOLI->setDbValue($row['KDPOLI']);
        $this->EDIT_SEP->setDbValue($row['EDIT_SEP']);
        $this->DELETE_SEP->setDbValue($row['DELETE_SEP']);
        $this->AKTIF->setDbValue($row['AKTIF']);
        $this->BILL_INAP->setDbValue($row['BILL_INAP']);
        $this->SEP_PRINTDATE->setDbValue($row['SEP_PRINTDATE']);
        $this->MAPPING_SEP->setDbValue($row['MAPPING_SEP']);
        $this->TRANS_ID->setDbValue($row['TRANS_ID']);
        $this->COB->setDbValue($row['COB']);
        $this->PENJAMIN->setDbValue($row['PENJAMIN']);
        $this->RESPONSEP->setDbValue($row['RESPONSEP']);
        $this->APPROVAL_DESC->setDbValue($row['APPROVAL_DESC']);
        $this->APPROVAL_RESPONAJUKAN->setDbValue($row['APPROVAL_RESPONAJUKAN']);
        $this->APPROVAL_RESPONAPPROV->setDbValue($row['APPROVAL_RESPONAPPROV']);
        $this->RESPONPOST_VKLAIM->setDbValue($row['RESPONPOST_VKLAIM']);
        $this->RESPONPUT_VKLAIM->setDbValue($row['RESPONPUT_VKLAIM']);
        $this->RESPONDEL_VKLAIM->setDbValue($row['RESPONDEL_VKLAIM']);
        $this->CALL_TIMES->setDbValue($row['CALL_TIMES']);
        $this->CALL_DATE->setDbValue($row['CALL_DATE']);
        $this->CALL_DATES->setDbValue($row['CALL_DATES']);
        $this->SERVED_DATE->setDbValue($row['SERVED_DATE']);
        $this->SERVED_INAP->setDbValue($row['SERVED_INAP']);
        $this->KDDPJP1->setDbValue($row['KDDPJP1']);
        $this->KDDPJP->setDbValue($row['KDDPJP']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->tgl_kontrol->setDbValue($row['tgl_kontrol']);
        $this->Faskes->setDbValue($row['Faskes']);
        $this->SEP->setDbValue($row['SEP']);
        $this->IDXDAFTAR->setDbValue($row['IDXDAFTAR']);
        $this->idbooking->setDbValue($row['idbooking']);
        $this->id_tujuan->setDbValue($row['id_tujuan']);
        $this->id_penunjang->setDbValue($row['id_penunjang']);
        $this->id_pembiayaan->setDbValue($row['id_pembiayaan']);
        $this->id_procedure->setDbValue($row['id_procedure']);
        $this->id_aspel->setDbValue($row['id_aspel']);
        $this->id_kelas->setDbValue($row['id_kelas']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['ORG_UNIT_CODE'] = $this->ORG_UNIT_CODE->CurrentValue;
        $row['VISIT_ID'] = $this->VISIT_ID->CurrentValue;
        $row['TICKET_NO'] = $this->TICKET_NO->CurrentValue;
        $row['NO_REGISTRATION'] = $this->NO_REGISTRATION->CurrentValue;
        $row['DIANTAR_OLEH'] = $this->DIANTAR_OLEH->CurrentValue;
        $row['STATUS_PASIEN_ID'] = $this->STATUS_PASIEN_ID->CurrentValue;
        $row['PASIEN_ID'] = $this->PASIEN_ID->CurrentValue;
        $row['RUJUKAN_ID'] = $this->RUJUKAN_ID->CurrentValue;
        $row['ADDRESS_OF_RUJUKAN'] = $this->ADDRESS_OF_RUJUKAN->CurrentValue;
        $row['REASON_ID'] = $this->REASON_ID->CurrentValue;
        $row['WAY_ID'] = $this->WAY_ID->CurrentValue;
        $row['PATIENT_CATEGORY_ID'] = $this->PATIENT_CATEGORY_ID->CurrentValue;
        $row['VISIT_DATE'] = $this->VISIT_DATE->CurrentValue;
        $row['BOOKED_DATE'] = $this->BOOKED_DATE->CurrentValue;
        $row['ISNEW'] = $this->ISNEW->CurrentValue;
        $row['KDPOLI_EKS'] = $this->KDPOLI_EKS->CurrentValue;
        $row['FOLLOW_UP'] = $this->FOLLOW_UP->CurrentValue;
        $row['PLACE_TYPE'] = $this->PLACE_TYPE->CurrentValue;
        $row['CLINIC_ID'] = $this->CLINIC_ID->CurrentValue;
        $row['RESPONTGLPLG_DESC'] = $this->RESPONTGLPLG_DESC->CurrentValue;
        $row['CLINIC_ID_FROM'] = $this->CLINIC_ID_FROM->CurrentValue;
        $row['CLASS_ROOM_ID'] = $this->CLASS_ROOM_ID->CurrentValue;
        $row['BED_ID'] = $this->BED_ID->CurrentValue;
        $row['KELUAR_ID'] = $this->KELUAR_ID->CurrentValue;
        $row['IN_DATE'] = $this->IN_DATE->CurrentValue;
        $row['EXIT_DATE'] = $this->EXIT_DATE->CurrentValue;
        $row['GENDER'] = $this->GENDER->CurrentValue;
        $row['KODE_AGAMA'] = $this->KODE_AGAMA->CurrentValue;
        $row['VISITOR_ADDRESS'] = $this->VISITOR_ADDRESS->CurrentValue;
        $row['MODIFIED_BY'] = $this->MODIFIED_BY->CurrentValue;
        $row['MODIFIED_DATE'] = $this->MODIFIED_DATE->CurrentValue;
        $row['MODIFIED_FROM'] = $this->MODIFIED_FROM->CurrentValue;
        $row['EMPLOYEE_ID'] = $this->EMPLOYEE_ID->CurrentValue;
        $row['EMPLOYEE_ID_FROM'] = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $row['RESPONSIBLE_ID'] = $this->RESPONSIBLE_ID->CurrentValue;
        $row['RESPONSIBLE'] = $this->RESPONSIBLE->CurrentValue;
        $row['FAMILY_STATUS_ID'] = $this->FAMILY_STATUS_ID->CurrentValue;
        $row['ISATTENDED'] = $this->ISATTENDED->CurrentValue;
        $row['PAYOR_ID'] = $this->PAYOR_ID->CurrentValue;
        $row['CLASS_ID'] = $this->CLASS_ID->CurrentValue;
        $row['ISPERTARIF'] = $this->ISPERTARIF->CurrentValue;
        $row['KAL_ID'] = $this->KAL_ID->CurrentValue;
        $row['EMPLOYEE_INAP'] = $this->EMPLOYEE_INAP->CurrentValue;
        $row['KARYAWAN'] = $this->KARYAWAN->CurrentValue;
        $row['ACCOUNT_ID'] = $this->ACCOUNT_ID->CurrentValue;
        $row['CLASS_ID_PLAFOND'] = $this->CLASS_ID_PLAFOND->CurrentValue;
        $row['BACKCHARGE'] = $this->BACKCHARGE->CurrentValue;
        $row['COVERAGE_ID'] = $this->COVERAGE_ID->CurrentValue;
        $row['AGEYEAR'] = $this->AGEYEAR->CurrentValue;
        $row['AGEMONTH'] = $this->AGEMONTH->CurrentValue;
        $row['AGEDAY'] = $this->AGEDAY->CurrentValue;
        $row['RECOMENDATION'] = $this->RECOMENDATION->CurrentValue;
        $row['CONCLUSION'] = $this->CONCLUSION->CurrentValue;
        $row['SPECIMENNO'] = $this->SPECIMENNO->CurrentValue;
        $row['LOCKED'] = $this->LOCKED->CurrentValue;
        $row['RM_OUT_DATE'] = $this->RM_OUT_DATE->CurrentValue;
        $row['RM_IN_DATE'] = $this->RM_IN_DATE->CurrentValue;
        $row['LAMA_PINJAM'] = $this->LAMA_PINJAM->CurrentValue;
        $row['STANDAR_RJ'] = $this->STANDAR_RJ->CurrentValue;
        $row['LENGKAP_RJ'] = $this->LENGKAP_RJ->CurrentValue;
        $row['LENGKAP_RI'] = $this->LENGKAP_RI->CurrentValue;
        $row['RESEND_RM_DATE'] = $this->RESEND_RM_DATE->CurrentValue;
        $row['LENGKAP_RM1'] = $this->LENGKAP_RM1->CurrentValue;
        $row['LENGKAP_RESUME'] = $this->LENGKAP_RESUME->CurrentValue;
        $row['LENGKAP_ANAMNESIS'] = $this->LENGKAP_ANAMNESIS->CurrentValue;
        $row['LENGKAP_CONSENT'] = $this->LENGKAP_CONSENT->CurrentValue;
        $row['LENGKAP_ANESTESI'] = $this->LENGKAP_ANESTESI->CurrentValue;
        $row['LENGKAP_OP'] = $this->LENGKAP_OP->CurrentValue;
        $row['BACK_RM_DATE'] = $this->BACK_RM_DATE->CurrentValue;
        $row['VALID_RM_DATE'] = $this->VALID_RM_DATE->CurrentValue;
        $row['NO_SKP'] = $this->NO_SKP->CurrentValue;
        $row['NO_SKPINAP'] = $this->NO_SKPINAP->CurrentValue;
        $row['ticket_all'] = $this->ticket_all->CurrentValue;
        $row['tanggal_rujukan'] = $this->tanggal_rujukan->CurrentValue;
        $row['ISRJ'] = $this->ISRJ->CurrentValue;
        $row['ASALRUJUKAN'] = $this->ASALRUJUKAN->CurrentValue;
        $row['NORUJUKAN'] = $this->NORUJUKAN->CurrentValue;
        $row['DIAG_AWAL'] = $this->DIAG_AWAL->CurrentValue;
        $row['DIAGNOSA_ID'] = $this->DIAGNOSA_ID->CurrentValue;
        $row['PPKRUJUKAN'] = $this->PPKRUJUKAN->CurrentValue;
        $row['LOKASILAKA'] = $this->LOKASILAKA->CurrentValue;
        $row['KDPOLI'] = $this->KDPOLI->CurrentValue;
        $row['EDIT_SEP'] = $this->EDIT_SEP->CurrentValue;
        $row['DELETE_SEP'] = $this->DELETE_SEP->CurrentValue;
        $row['AKTIF'] = $this->AKTIF->CurrentValue;
        $row['BILL_INAP'] = $this->BILL_INAP->CurrentValue;
        $row['SEP_PRINTDATE'] = $this->SEP_PRINTDATE->CurrentValue;
        $row['MAPPING_SEP'] = $this->MAPPING_SEP->CurrentValue;
        $row['TRANS_ID'] = $this->TRANS_ID->CurrentValue;
        $row['COB'] = $this->COB->CurrentValue;
        $row['PENJAMIN'] = $this->PENJAMIN->CurrentValue;
        $row['RESPONSEP'] = $this->RESPONSEP->CurrentValue;
        $row['APPROVAL_DESC'] = $this->APPROVAL_DESC->CurrentValue;
        $row['APPROVAL_RESPONAJUKAN'] = $this->APPROVAL_RESPONAJUKAN->CurrentValue;
        $row['APPROVAL_RESPONAPPROV'] = $this->APPROVAL_RESPONAPPROV->CurrentValue;
        $row['RESPONPOST_VKLAIM'] = $this->RESPONPOST_VKLAIM->CurrentValue;
        $row['RESPONPUT_VKLAIM'] = $this->RESPONPUT_VKLAIM->CurrentValue;
        $row['RESPONDEL_VKLAIM'] = $this->RESPONDEL_VKLAIM->CurrentValue;
        $row['CALL_TIMES'] = $this->CALL_TIMES->CurrentValue;
        $row['CALL_DATE'] = $this->CALL_DATE->CurrentValue;
        $row['CALL_DATES'] = $this->CALL_DATES->CurrentValue;
        $row['SERVED_DATE'] = $this->SERVED_DATE->CurrentValue;
        $row['SERVED_INAP'] = $this->SERVED_INAP->CurrentValue;
        $row['KDDPJP1'] = $this->KDDPJP1->CurrentValue;
        $row['KDDPJP'] = $this->KDDPJP->CurrentValue;
        $row['DESCRIPTION'] = $this->DESCRIPTION->CurrentValue;
        $row['tgl_kontrol'] = $this->tgl_kontrol->CurrentValue;
        $row['Faskes'] = $this->Faskes->CurrentValue;
        $row['SEP'] = $this->SEP->CurrentValue;
        $row['IDXDAFTAR'] = $this->IDXDAFTAR->CurrentValue;
        $row['idbooking'] = $this->idbooking->CurrentValue;
        $row['id_tujuan'] = $this->id_tujuan->CurrentValue;
        $row['id_penunjang'] = $this->id_penunjang->CurrentValue;
        $row['id_pembiayaan'] = $this->id_pembiayaan->CurrentValue;
        $row['id_procedure'] = $this->id_procedure->CurrentValue;
        $row['id_aspel'] = $this->id_aspel->CurrentValue;
        $row['id_kelas'] = $this->id_kelas->CurrentValue;
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

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // TICKET_NO
        $this->TICKET_NO->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->CellCssStyle = "white-space: nowrap;";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // PASIEN_ID
        $this->PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // RUJUKAN_ID
        $this->RUJUKAN_ID->CellCssStyle = "white-space: nowrap;";

        // ADDRESS_OF_RUJUKAN
        $this->ADDRESS_OF_RUJUKAN->CellCssStyle = "white-space: nowrap;";

        // REASON_ID
        $this->REASON_ID->CellCssStyle = "white-space: nowrap;";

        // WAY_ID
        $this->WAY_ID->CellCssStyle = "white-space: nowrap;";

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->CellCssStyle = "white-space: nowrap;";

        // VISIT_DATE
        $this->VISIT_DATE->CellCssStyle = "white-space: nowrap;";

        // BOOKED_DATE
        $this->BOOKED_DATE->CellCssStyle = "white-space: nowrap;";

        // ISNEW
        $this->ISNEW->CellCssStyle = "white-space: nowrap;";

        // KDPOLI_EKS
        $this->KDPOLI_EKS->CellCssStyle = "white-space: nowrap;";

        // FOLLOW_UP
        $this->FOLLOW_UP->CellCssStyle = "white-space: nowrap;";

        // PLACE_TYPE
        $this->PLACE_TYPE->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

        // RESPONTGLPLG_DESC
        $this->RESPONTGLPLG_DESC->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->CellCssStyle = "white-space: nowrap;";

        // BED_ID
        $this->BED_ID->CellCssStyle = "white-space: nowrap;";

        // KELUAR_ID
        $this->KELUAR_ID->CellCssStyle = "white-space: nowrap;";

        // IN_DATE
        $this->IN_DATE->CellCssStyle = "white-space: nowrap;";

        // EXIT_DATE
        $this->EXIT_DATE->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // KODE_AGAMA
        $this->KODE_AGAMA->CellCssStyle = "white-space: nowrap;";

        // VISITOR_ADDRESS
        $this->VISITOR_ADDRESS->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // RESPONSIBLE_ID
        $this->RESPONSIBLE_ID->CellCssStyle = "white-space: nowrap;";

        // RESPONSIBLE
        $this->RESPONSIBLE->CellCssStyle = "white-space: nowrap;";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->CellCssStyle = "white-space: nowrap;";

        // ISATTENDED
        $this->ISATTENDED->CellCssStyle = "white-space: nowrap;";

        // PAYOR_ID
        $this->PAYOR_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID
        $this->CLASS_ID->CellCssStyle = "white-space: nowrap;";

        // ISPERTARIF
        $this->ISPERTARIF->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_INAP
        $this->EMPLOYEE_INAP->CellCssStyle = "white-space: nowrap;";

        // KARYAWAN
        $this->KARYAWAN->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // BACKCHARGE
        $this->BACKCHARGE->CellCssStyle = "white-space: nowrap;";

        // COVERAGE_ID
        $this->COVERAGE_ID->CellCssStyle = "white-space: nowrap;";

        // AGEYEAR
        $this->AGEYEAR->CellCssStyle = "white-space: nowrap;";

        // AGEMONTH
        $this->AGEMONTH->CellCssStyle = "white-space: nowrap;";

        // AGEDAY
        $this->AGEDAY->CellCssStyle = "white-space: nowrap;";

        // RECOMENDATION
        $this->RECOMENDATION->CellCssStyle = "white-space: nowrap;";

        // CONCLUSION
        $this->CONCLUSION->CellCssStyle = "white-space: nowrap;";

        // SPECIMENNO
        $this->SPECIMENNO->CellCssStyle = "white-space: nowrap;";

        // LOCKED
        $this->LOCKED->CellCssStyle = "white-space: nowrap;";

        // RM_OUT_DATE
        $this->RM_OUT_DATE->CellCssStyle = "white-space: nowrap;";

        // RM_IN_DATE
        $this->RM_IN_DATE->CellCssStyle = "white-space: nowrap;";

        // LAMA_PINJAM
        $this->LAMA_PINJAM->CellCssStyle = "white-space: nowrap;";

        // STANDAR_RJ
        $this->STANDAR_RJ->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_RJ
        $this->LENGKAP_RJ->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_RI
        $this->LENGKAP_RI->CellCssStyle = "white-space: nowrap;";

        // RESEND_RM_DATE
        $this->RESEND_RM_DATE->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_RM1
        $this->LENGKAP_RM1->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_RESUME
        $this->LENGKAP_RESUME->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_ANAMNESIS
        $this->LENGKAP_ANAMNESIS->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_CONSENT
        $this->LENGKAP_CONSENT->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_ANESTESI
        $this->LENGKAP_ANESTESI->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_OP
        $this->LENGKAP_OP->CellCssStyle = "white-space: nowrap;";

        // BACK_RM_DATE
        $this->BACK_RM_DATE->CellCssStyle = "white-space: nowrap;";

        // VALID_RM_DATE
        $this->VALID_RM_DATE->CellCssStyle = "white-space: nowrap;";

        // NO_SKP
        $this->NO_SKP->CellCssStyle = "white-space: nowrap;";

        // NO_SKPINAP
        $this->NO_SKPINAP->CellCssStyle = "white-space: nowrap;";

        // ticket_all
        $this->ticket_all->CellCssStyle = "white-space: nowrap;";

        // tanggal_rujukan
        $this->tanggal_rujukan->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // ASALRUJUKAN
        $this->ASALRUJUKAN->CellCssStyle = "white-space: nowrap;";

        // NORUJUKAN
        $this->NORUJUKAN->CellCssStyle = "white-space: nowrap;";

        // DIAG_AWAL
        $this->DIAG_AWAL->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->CellCssStyle = "white-space: nowrap;";

        // PPKRUJUKAN
        $this->PPKRUJUKAN->CellCssStyle = "white-space: nowrap;";

        // LOKASILAKA
        $this->LOKASILAKA->CellCssStyle = "white-space: nowrap;";

        // KDPOLI
        $this->KDPOLI->CellCssStyle = "white-space: nowrap;";

        // EDIT_SEP
        $this->EDIT_SEP->CellCssStyle = "white-space: nowrap;";

        // DELETE_SEP
        $this->DELETE_SEP->CellCssStyle = "white-space: nowrap;";

        // AKTIF
        $this->AKTIF->CellCssStyle = "white-space: nowrap;";

        // BILL_INAP
        $this->BILL_INAP->CellCssStyle = "white-space: nowrap;";

        // SEP_PRINTDATE
        $this->SEP_PRINTDATE->CellCssStyle = "white-space: nowrap;";

        // MAPPING_SEP
        $this->MAPPING_SEP->CellCssStyle = "white-space: nowrap;";

        // TRANS_ID
        $this->TRANS_ID->CellCssStyle = "white-space: nowrap;";

        // COB
        $this->COB->CellCssStyle = "white-space: nowrap;";

        // PENJAMIN
        $this->PENJAMIN->CellCssStyle = "white-space: nowrap;";

        // RESPONSEP
        $this->RESPONSEP->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_DESC
        $this->APPROVAL_DESC->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_RESPONAJUKAN
        $this->APPROVAL_RESPONAJUKAN->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_RESPONAPPROV
        $this->APPROVAL_RESPONAPPROV->CellCssStyle = "white-space: nowrap;";

        // RESPONPOST_VKLAIM
        $this->RESPONPOST_VKLAIM->CellCssStyle = "white-space: nowrap;";

        // RESPONPUT_VKLAIM
        $this->RESPONPUT_VKLAIM->CellCssStyle = "white-space: nowrap;";

        // RESPONDEL_VKLAIM
        $this->RESPONDEL_VKLAIM->CellCssStyle = "white-space: nowrap;";

        // CALL_TIMES
        $this->CALL_TIMES->CellCssStyle = "white-space: nowrap;";

        // CALL_DATE
        $this->CALL_DATE->CellCssStyle = "white-space: nowrap;";

        // CALL_DATES
        $this->CALL_DATES->CellCssStyle = "white-space: nowrap;";

        // SERVED_DATE
        $this->SERVED_DATE->CellCssStyle = "white-space: nowrap;";

        // SERVED_INAP
        $this->SERVED_INAP->CellCssStyle = "white-space: nowrap;";

        // KDDPJP1
        $this->KDDPJP1->CellCssStyle = "white-space: nowrap;";

        // KDDPJP
        $this->KDDPJP->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // tgl_kontrol

        // Faskes

        // SEP
        $this->SEP->CellCssStyle = "white-space: nowrap;";

        // IDXDAFTAR
        $this->IDXDAFTAR->CellCssStyle = "white-space: nowrap;";

        // idbooking

        // id_tujuan

        // id_penunjang

        // id_pembiayaan

        // id_procedure

        // id_aspel

        // id_kelas
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // VISIT_ID
            $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
            $this->VISIT_ID->ViewCustomAttributes = "";

            // TICKET_NO
            $this->TICKET_NO->ViewValue = $this->TICKET_NO->CurrentValue;
            $this->TICKET_NO->ViewValue = FormatNumber($this->TICKET_NO->ViewValue, 0, -2, -2, -2);
            $this->TICKET_NO->ViewCustomAttributes = "";

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

            // DIANTAR_OLEH
            $this->DIANTAR_OLEH->ViewValue = $this->DIANTAR_OLEH->CurrentValue;
            $this->DIANTAR_OLEH->ViewCustomAttributes = "";

            // STATUS_PASIEN_ID
            $curVal = trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
            if ($curVal != "") {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
                if ($this->STATUS_PASIEN_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "[ISACTIVE] = 1";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->STATUS_PASIEN_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->STATUS_PASIEN_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->displayValue($arwrk);
                    } else {
                        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
                    }
                }
            } else {
                $this->STATUS_PASIEN_ID->ViewValue = null;
            }
            $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

            // PASIEN_ID
            $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
            $this->PASIEN_ID->ViewCustomAttributes = "";

            // RUJUKAN_ID
            $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->CurrentValue;
            $this->RUJUKAN_ID->ViewValue = FormatNumber($this->RUJUKAN_ID->ViewValue, 0, -2, -2, -2);
            $this->RUJUKAN_ID->ViewCustomAttributes = "";

            // ADDRESS_OF_RUJUKAN
            $this->ADDRESS_OF_RUJUKAN->ViewValue = $this->ADDRESS_OF_RUJUKAN->CurrentValue;
            $this->ADDRESS_OF_RUJUKAN->ViewCustomAttributes = "";

            // REASON_ID
            $curVal = trim(strval($this->REASON_ID->CurrentValue));
            if ($curVal != "") {
                $this->REASON_ID->ViewValue = $this->REASON_ID->lookupCacheOption($curVal);
                if ($this->REASON_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[REASON_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->REASON_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->REASON_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->REASON_ID->ViewValue = $this->REASON_ID->displayValue($arwrk);
                    } else {
                        $this->REASON_ID->ViewValue = $this->REASON_ID->CurrentValue;
                    }
                }
            } else {
                $this->REASON_ID->ViewValue = null;
            }
            $this->REASON_ID->ViewCustomAttributes = "";

            // WAY_ID
            $curVal = trim(strval($this->WAY_ID->CurrentValue));
            if ($curVal != "") {
                $this->WAY_ID->ViewValue = $this->WAY_ID->lookupCacheOption($curVal);
                if ($this->WAY_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[WAY_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->WAY_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->WAY_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->WAY_ID->ViewValue = $this->WAY_ID->displayValue($arwrk);
                    } else {
                        $this->WAY_ID->ViewValue = $this->WAY_ID->CurrentValue;
                    }
                }
            } else {
                $this->WAY_ID->ViewValue = null;
            }
            $this->WAY_ID->ViewCustomAttributes = "";

            // PATIENT_CATEGORY_ID
            $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->CurrentValue;
            $this->PATIENT_CATEGORY_ID->ViewValue = FormatNumber($this->PATIENT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
            $this->PATIENT_CATEGORY_ID->ViewCustomAttributes = "";

            // VISIT_DATE
            $this->VISIT_DATE->ViewValue = $this->VISIT_DATE->CurrentValue;
            $this->VISIT_DATE->ViewValue = FormatDateTime($this->VISIT_DATE->ViewValue, 11);
            $this->VISIT_DATE->ViewCustomAttributes = "";

            // BOOKED_DATE
            $this->BOOKED_DATE->ViewValue = $this->BOOKED_DATE->CurrentValue;
            $this->BOOKED_DATE->ViewValue = FormatDateTime($this->BOOKED_DATE->ViewValue, 11);
            $this->BOOKED_DATE->ViewCustomAttributes = "";

            // ISNEW
            if (strval($this->ISNEW->CurrentValue) != "") {
                $this->ISNEW->ViewValue = $this->ISNEW->optionCaption($this->ISNEW->CurrentValue);
            } else {
                $this->ISNEW->ViewValue = null;
            }
            $this->ISNEW->ViewCustomAttributes = "";

            // KDPOLI_EKS
            if (strval($this->KDPOLI_EKS->CurrentValue) != "") {
                $this->KDPOLI_EKS->ViewValue = $this->KDPOLI_EKS->optionCaption($this->KDPOLI_EKS->CurrentValue);
            } else {
                $this->KDPOLI_EKS->ViewValue = null;
            }
            $this->KDPOLI_EKS->ViewCustomAttributes = "";

            // FOLLOW_UP
            $this->FOLLOW_UP->ViewValue = $this->FOLLOW_UP->CurrentValue;
            $this->FOLLOW_UP->ViewValue = FormatNumber($this->FOLLOW_UP->ViewValue, 0, -2, -2, -2);
            $this->FOLLOW_UP->ViewCustomAttributes = "";

            // PLACE_TYPE
            $this->PLACE_TYPE->ViewValue = $this->PLACE_TYPE->CurrentValue;
            $this->PLACE_TYPE->ViewValue = FormatNumber($this->PLACE_TYPE->ViewValue, 0, -2, -2, -2);
            $this->PLACE_TYPE->ViewCustomAttributes = "";

            // CLINIC_ID
            $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
                if ($this->CLINIC_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "[STYPE_ID] = 1 OR [STYPE_ID] = 2 OR [STYPE_ID] = 5";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
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

            // RESPONTGLPLG_DESC
            if (strval($this->RESPONTGLPLG_DESC->CurrentValue) != "") {
                $this->RESPONTGLPLG_DESC->ViewValue = $this->RESPONTGLPLG_DESC->optionCaption($this->RESPONTGLPLG_DESC->CurrentValue);
            } else {
                $this->RESPONTGLPLG_DESC->ViewValue = null;
            }
            $this->RESPONTGLPLG_DESC->ViewCustomAttributes = "";

            // CLINIC_ID_FROM
            $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->CurrentValue;
            $this->CLINIC_ID_FROM->ViewCustomAttributes = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
            $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

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

            // IN_DATE
            $this->IN_DATE->ViewValue = $this->IN_DATE->CurrentValue;
            $this->IN_DATE->ViewValue = FormatDateTime($this->IN_DATE->ViewValue, 11);
            $this->IN_DATE->ViewCustomAttributes = "";

            // EXIT_DATE
            $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
            $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 11);
            $this->EXIT_DATE->ViewCustomAttributes = "";

            // GENDER
            $curVal = trim(strval($this->GENDER->CurrentValue));
            if ($curVal != "") {
                $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
                if ($this->GENDER->ViewValue === null) { // Lookup from database
                    $filterWrk = "[GENDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "[GENDER] = 1 OR [GENDER] = 2";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->GENDER->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->GENDER->Lookup->renderViewRow($rswrk[0]);
                        $this->GENDER->ViewValue = $this->GENDER->displayValue($arwrk);
                    } else {
                        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
                    }
                }
            } else {
                $this->GENDER->ViewValue = null;
            }
            $this->GENDER->ViewCustomAttributes = "";

            // KODE_AGAMA
            $curVal = trim(strval($this->KODE_AGAMA->CurrentValue));
            if ($curVal != "") {
                $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->lookupCacheOption($curVal);
                if ($this->KODE_AGAMA->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KODE_AGAMA]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->KODE_AGAMA->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KODE_AGAMA->Lookup->renderViewRow($rswrk[0]);
                        $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->displayValue($arwrk);
                    } else {
                        $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->CurrentValue;
                    }
                }
            } else {
                $this->KODE_AGAMA->ViewValue = null;
            }
            $this->KODE_AGAMA->ViewCustomAttributes = "";

            // VISITOR_ADDRESS
            $this->VISITOR_ADDRESS->ViewValue = $this->VISITOR_ADDRESS->CurrentValue;
            $this->VISITOR_ADDRESS->ViewCustomAttributes = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
            $this->MODIFIED_BY->ViewCustomAttributes = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
            $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 11);
            $this->MODIFIED_DATE->ViewCustomAttributes = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
            $this->MODIFIED_FROM->ViewCustomAttributes = "";

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

            // EMPLOYEE_ID_FROM
            $this->EMPLOYEE_ID_FROM->ViewValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
            $this->EMPLOYEE_ID_FROM->ViewCustomAttributes = "";

            // RESPONSIBLE_ID
            $this->RESPONSIBLE_ID->ViewValue = $this->RESPONSIBLE_ID->CurrentValue;
            $this->RESPONSIBLE_ID->ViewValue = FormatNumber($this->RESPONSIBLE_ID->ViewValue, 0, -2, -2, -2);
            $this->RESPONSIBLE_ID->ViewCustomAttributes = "";

            // RESPONSIBLE
            $this->RESPONSIBLE->ViewValue = $this->RESPONSIBLE->CurrentValue;
            $this->RESPONSIBLE->ViewCustomAttributes = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
            $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

            // ISATTENDED
            if (strval($this->ISATTENDED->CurrentValue) != "") {
                $this->ISATTENDED->ViewValue = $this->ISATTENDED->optionCaption($this->ISATTENDED->CurrentValue);
            } else {
                $this->ISATTENDED->ViewValue = null;
            }
            $this->ISATTENDED->ViewCustomAttributes = "";

            // PAYOR_ID
            $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
            $this->PAYOR_ID->ViewCustomAttributes = "";

            // CLASS_ID
            $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
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

            // ISPERTARIF
            $this->ISPERTARIF->ViewValue = $this->ISPERTARIF->CurrentValue;
            $this->ISPERTARIF->ViewCustomAttributes = "";

            // KAL_ID
            $curVal = trim(strval($this->KAL_ID->CurrentValue));
            if ($curVal != "") {
                $this->KAL_ID->ViewValue = $this->KAL_ID->lookupCacheOption($curVal);
                if ($this->KAL_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KAL_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->KAL_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KAL_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->KAL_ID->ViewValue = $this->KAL_ID->displayValue($arwrk);
                    } else {
                        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
                    }
                }
            } else {
                $this->KAL_ID->ViewValue = null;
            }
            $this->KAL_ID->ViewCustomAttributes = "";

            // EMPLOYEE_INAP
            $this->EMPLOYEE_INAP->ViewValue = $this->EMPLOYEE_INAP->CurrentValue;
            $this->EMPLOYEE_INAP->ViewCustomAttributes = "";

            // KARYAWAN
            $this->KARYAWAN->ViewValue = $this->KARYAWAN->CurrentValue;
            $this->KARYAWAN->ViewCustomAttributes = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
            $this->ACCOUNT_ID->ViewCustomAttributes = "";

            // CLASS_ID_PLAFOND
            $this->CLASS_ID_PLAFOND->ViewValue = $this->CLASS_ID_PLAFOND->CurrentValue;
            $this->CLASS_ID_PLAFOND->ViewValue = FormatNumber($this->CLASS_ID_PLAFOND->ViewValue, 0, -2, -2, -2);
            $this->CLASS_ID_PLAFOND->ViewCustomAttributes = "";

            // BACKCHARGE
            $this->BACKCHARGE->ViewValue = $this->BACKCHARGE->CurrentValue;
            $this->BACKCHARGE->ViewCustomAttributes = "";

            // COVERAGE_ID
            $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->CurrentValue;
            $curVal = trim(strval($this->COVERAGE_ID->CurrentValue));
            if ($curVal != "") {
                $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->lookupCacheOption($curVal);
                if ($this->COVERAGE_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[COVERAGE_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->COVERAGE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->COVERAGE_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->displayValue($arwrk);
                    } else {
                        $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->CurrentValue;
                    }
                }
            } else {
                $this->COVERAGE_ID->ViewValue = null;
            }
            $this->COVERAGE_ID->ViewCustomAttributes = "";

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

            // RECOMENDATION
            $this->RECOMENDATION->ViewValue = $this->RECOMENDATION->CurrentValue;
            $this->RECOMENDATION->ViewCustomAttributes = "";

            // CONCLUSION
            $this->CONCLUSION->ViewValue = $this->CONCLUSION->CurrentValue;
            $this->CONCLUSION->ViewCustomAttributes = "";

            // SPECIMENNO
            $this->SPECIMENNO->ViewValue = $this->SPECIMENNO->CurrentValue;
            $this->SPECIMENNO->ViewCustomAttributes = "";

            // LOCKED
            $this->LOCKED->ViewValue = $this->LOCKED->CurrentValue;
            $this->LOCKED->ViewCustomAttributes = "";

            // RM_OUT_DATE
            $this->RM_OUT_DATE->ViewValue = $this->RM_OUT_DATE->CurrentValue;
            $this->RM_OUT_DATE->ViewValue = FormatDateTime($this->RM_OUT_DATE->ViewValue, 0);
            $this->RM_OUT_DATE->ViewCustomAttributes = "";

            // RM_IN_DATE
            $this->RM_IN_DATE->ViewValue = $this->RM_IN_DATE->CurrentValue;
            $this->RM_IN_DATE->ViewValue = FormatDateTime($this->RM_IN_DATE->ViewValue, 0);
            $this->RM_IN_DATE->ViewCustomAttributes = "";

            // LAMA_PINJAM
            $this->LAMA_PINJAM->ViewValue = $this->LAMA_PINJAM->CurrentValue;
            $this->LAMA_PINJAM->ViewValue = FormatDateTime($this->LAMA_PINJAM->ViewValue, 0);
            $this->LAMA_PINJAM->ViewCustomAttributes = "";

            // STANDAR_RJ
            $this->STANDAR_RJ->ViewValue = $this->STANDAR_RJ->CurrentValue;
            $this->STANDAR_RJ->ViewCustomAttributes = "";

            // LENGKAP_RJ
            $this->LENGKAP_RJ->ViewValue = $this->LENGKAP_RJ->CurrentValue;
            $this->LENGKAP_RJ->ViewCustomAttributes = "";

            // LENGKAP_RI
            $this->LENGKAP_RI->ViewValue = $this->LENGKAP_RI->CurrentValue;
            $this->LENGKAP_RI->ViewCustomAttributes = "";

            // RESEND_RM_DATE
            $this->RESEND_RM_DATE->ViewValue = $this->RESEND_RM_DATE->CurrentValue;
            $this->RESEND_RM_DATE->ViewValue = FormatDateTime($this->RESEND_RM_DATE->ViewValue, 0);
            $this->RESEND_RM_DATE->ViewCustomAttributes = "";

            // LENGKAP_RM1
            $this->LENGKAP_RM1->ViewValue = $this->LENGKAP_RM1->CurrentValue;
            $this->LENGKAP_RM1->ViewCustomAttributes = "";

            // LENGKAP_RESUME
            $this->LENGKAP_RESUME->ViewValue = $this->LENGKAP_RESUME->CurrentValue;
            $this->LENGKAP_RESUME->ViewCustomAttributes = "";

            // LENGKAP_ANAMNESIS
            $this->LENGKAP_ANAMNESIS->ViewValue = $this->LENGKAP_ANAMNESIS->CurrentValue;
            $this->LENGKAP_ANAMNESIS->ViewCustomAttributes = "";

            // LENGKAP_CONSENT
            $this->LENGKAP_CONSENT->ViewValue = $this->LENGKAP_CONSENT->CurrentValue;
            $this->LENGKAP_CONSENT->ViewCustomAttributes = "";

            // LENGKAP_ANESTESI
            $this->LENGKAP_ANESTESI->ViewValue = $this->LENGKAP_ANESTESI->CurrentValue;
            $this->LENGKAP_ANESTESI->ViewCustomAttributes = "";

            // LENGKAP_OP
            $this->LENGKAP_OP->ViewValue = $this->LENGKAP_OP->CurrentValue;
            $this->LENGKAP_OP->ViewCustomAttributes = "";

            // BACK_RM_DATE
            $this->BACK_RM_DATE->ViewValue = $this->BACK_RM_DATE->CurrentValue;
            $this->BACK_RM_DATE->ViewValue = FormatDateTime($this->BACK_RM_DATE->ViewValue, 0);
            $this->BACK_RM_DATE->ViewCustomAttributes = "";

            // VALID_RM_DATE
            $this->VALID_RM_DATE->ViewValue = $this->VALID_RM_DATE->CurrentValue;
            $this->VALID_RM_DATE->ViewValue = FormatDateTime($this->VALID_RM_DATE->ViewValue, 0);
            $this->VALID_RM_DATE->ViewCustomAttributes = "";

            // NO_SKP
            $this->NO_SKP->ViewValue = $this->NO_SKP->CurrentValue;
            $this->NO_SKP->ViewCustomAttributes = "";

            // NO_SKPINAP
            $this->NO_SKPINAP->ViewValue = $this->NO_SKPINAP->CurrentValue;
            $this->NO_SKPINAP->ViewCustomAttributes = "";

            // ticket_all
            $this->ticket_all->ViewValue = $this->ticket_all->CurrentValue;
            $this->ticket_all->ViewValue = FormatNumber($this->ticket_all->ViewValue, 0, -2, -2, -2);
            $this->ticket_all->ViewCustomAttributes = "";

            // tanggal_rujukan
            $this->tanggal_rujukan->ViewValue = $this->tanggal_rujukan->CurrentValue;
            $this->tanggal_rujukan->ViewValue = FormatDateTime($this->tanggal_rujukan->ViewValue, 17);
            $this->tanggal_rujukan->ViewCustomAttributes = "";

            // ISRJ
            $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
            $this->ISRJ->ViewCustomAttributes = "";

            // ASALRUJUKAN
            if (strval($this->ASALRUJUKAN->CurrentValue) != "") {
                $this->ASALRUJUKAN->ViewValue = $this->ASALRUJUKAN->optionCaption($this->ASALRUJUKAN->CurrentValue);
            } else {
                $this->ASALRUJUKAN->ViewValue = null;
            }
            $this->ASALRUJUKAN->ViewCustomAttributes = "";

            // NORUJUKAN
            $this->NORUJUKAN->ViewValue = $this->NORUJUKAN->CurrentValue;
            $this->NORUJUKAN->ViewCustomAttributes = "";

            // DIAG_AWAL
            $this->DIAG_AWAL->ViewValue = $this->DIAG_AWAL->CurrentValue;
            $curVal = trim(strval($this->DIAG_AWAL->CurrentValue));
            if ($curVal != "") {
                $this->DIAG_AWAL->ViewValue = $this->DIAG_AWAL->lookupCacheOption($curVal);
                if ($this->DIAG_AWAL->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAG_AWAL->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAG_AWAL->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAG_AWAL->ViewValue = $this->DIAG_AWAL->displayValue($arwrk);
                    } else {
                        $this->DIAG_AWAL->ViewValue = $this->DIAG_AWAL->CurrentValue;
                    }
                }
            } else {
                $this->DIAG_AWAL->ViewValue = null;
            }
            $this->DIAG_AWAL->ViewCustomAttributes = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
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

            // PPKRUJUKAN
            $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->CurrentValue;
            $curVal = trim(strval($this->PPKRUJUKAN->CurrentValue));
            if ($curVal != "") {
                $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->lookupCacheOption($curVal);
                if ($this->PPKRUJUKAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KDPROVIDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->PPKRUJUKAN->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PPKRUJUKAN->Lookup->renderViewRow($rswrk[0]);
                        $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->displayValue($arwrk);
                    } else {
                        $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->CurrentValue;
                    }
                }
            } else {
                $this->PPKRUJUKAN->ViewValue = null;
            }
            $this->PPKRUJUKAN->ViewCustomAttributes = "";

            // LOKASILAKA
            $this->LOKASILAKA->ViewValue = $this->LOKASILAKA->CurrentValue;
            $this->LOKASILAKA->ViewCustomAttributes = "";

            // KDPOLI
            $this->KDPOLI->ViewValue = $this->KDPOLI->CurrentValue;
            $this->KDPOLI->ViewCustomAttributes = "";

            // EDIT_SEP
            $this->EDIT_SEP->ViewValue = $this->EDIT_SEP->CurrentValue;
            $this->EDIT_SEP->ViewCustomAttributes = "";

            // DELETE_SEP
            $this->DELETE_SEP->ViewValue = $this->DELETE_SEP->CurrentValue;
            $this->DELETE_SEP->ViewCustomAttributes = "";

            // AKTIF
            $this->AKTIF->ViewValue = $this->AKTIF->CurrentValue;
            $this->AKTIF->ViewCustomAttributes = "";

            // BILL_INAP
            $this->BILL_INAP->ViewValue = $this->BILL_INAP->CurrentValue;
            $this->BILL_INAP->ViewCustomAttributes = "";

            // SEP_PRINTDATE
            $this->SEP_PRINTDATE->ViewValue = $this->SEP_PRINTDATE->CurrentValue;
            $this->SEP_PRINTDATE->ViewValue = FormatDateTime($this->SEP_PRINTDATE->ViewValue, 0);
            $this->SEP_PRINTDATE->ViewCustomAttributes = "";

            // MAPPING_SEP
            $this->MAPPING_SEP->ViewValue = $this->MAPPING_SEP->CurrentValue;
            $this->MAPPING_SEP->ViewCustomAttributes = "";

            // TRANS_ID
            $this->TRANS_ID->ViewValue = $this->TRANS_ID->CurrentValue;
            $this->TRANS_ID->ViewCustomAttributes = "";

            // COB
            if (strval($this->COB->CurrentValue) != "") {
                $this->COB->ViewValue = $this->COB->optionCaption($this->COB->CurrentValue);
            } else {
                $this->COB->ViewValue = null;
            }
            $this->COB->ViewCustomAttributes = "";

            // PENJAMIN
            $this->PENJAMIN->ViewValue = $this->PENJAMIN->CurrentValue;
            $this->PENJAMIN->ViewCustomAttributes = "";

            // RESPONSEP
            $this->RESPONSEP->ViewValue = $this->RESPONSEP->CurrentValue;
            $this->RESPONSEP->ViewCustomAttributes = "";

            // APPROVAL_DESC
            $this->APPROVAL_DESC->ViewValue = $this->APPROVAL_DESC->CurrentValue;
            $this->APPROVAL_DESC->ViewCustomAttributes = "";

            // APPROVAL_RESPONAJUKAN
            $this->APPROVAL_RESPONAJUKAN->ViewValue = $this->APPROVAL_RESPONAJUKAN->CurrentValue;
            $this->APPROVAL_RESPONAJUKAN->ViewCustomAttributes = "";

            // APPROVAL_RESPONAPPROV
            $this->APPROVAL_RESPONAPPROV->ViewValue = $this->APPROVAL_RESPONAPPROV->CurrentValue;
            $this->APPROVAL_RESPONAPPROV->ViewCustomAttributes = "";

            // RESPONPOST_VKLAIM
            $this->RESPONPOST_VKLAIM->ViewValue = $this->RESPONPOST_VKLAIM->CurrentValue;
            $this->RESPONPOST_VKLAIM->ViewCustomAttributes = "";

            // RESPONPUT_VKLAIM
            $this->RESPONPUT_VKLAIM->ViewValue = $this->RESPONPUT_VKLAIM->CurrentValue;
            $this->RESPONPUT_VKLAIM->ViewCustomAttributes = "";

            // RESPONDEL_VKLAIM
            $this->RESPONDEL_VKLAIM->ViewValue = $this->RESPONDEL_VKLAIM->CurrentValue;
            $this->RESPONDEL_VKLAIM->ViewCustomAttributes = "";

            // CALL_TIMES
            $this->CALL_TIMES->ViewValue = $this->CALL_TIMES->CurrentValue;
            $this->CALL_TIMES->ViewValue = FormatNumber($this->CALL_TIMES->ViewValue, 0, -2, -2, -2);
            $this->CALL_TIMES->ViewCustomAttributes = "";

            // CALL_DATE
            $this->CALL_DATE->ViewValue = $this->CALL_DATE->CurrentValue;
            $this->CALL_DATE->ViewValue = FormatDateTime($this->CALL_DATE->ViewValue, 0);
            $this->CALL_DATE->ViewCustomAttributes = "";

            // CALL_DATES
            $this->CALL_DATES->ViewValue = $this->CALL_DATES->CurrentValue;
            $this->CALL_DATES->ViewValue = FormatDateTime($this->CALL_DATES->ViewValue, 0);
            $this->CALL_DATES->ViewCustomAttributes = "";

            // SERVED_DATE
            $this->SERVED_DATE->ViewValue = $this->SERVED_DATE->CurrentValue;
            $this->SERVED_DATE->ViewValue = FormatDateTime($this->SERVED_DATE->ViewValue, 0);
            $this->SERVED_DATE->ViewCustomAttributes = "";

            // SERVED_INAP
            $this->SERVED_INAP->ViewValue = $this->SERVED_INAP->CurrentValue;
            $this->SERVED_INAP->ViewValue = FormatDateTime($this->SERVED_INAP->ViewValue, 0);
            $this->SERVED_INAP->ViewCustomAttributes = "";

            // KDDPJP1
            $this->KDDPJP1->ViewValue = $this->KDDPJP1->CurrentValue;
            $this->KDDPJP1->ViewCustomAttributes = "";

            // KDDPJP
            $this->KDDPJP->ViewValue = $this->KDDPJP->CurrentValue;
            $this->KDDPJP->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // Faskes
            if (strval($this->Faskes->CurrentValue) != "") {
                $this->Faskes->ViewValue = $this->Faskes->optionCaption($this->Faskes->CurrentValue);
            } else {
                $this->Faskes->ViewValue = null;
            }
            $this->Faskes->ViewCustomAttributes = "";

            // SEP
            $this->SEP->ViewValue = $this->SEP->CurrentValue;
            $this->SEP->ViewCustomAttributes = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->ViewValue = $this->IDXDAFTAR->CurrentValue;
            $this->IDXDAFTAR->ViewCustomAttributes = "";

            // idbooking
            $this->idbooking->ViewValue = $this->idbooking->CurrentValue;
            $this->idbooking->ViewCustomAttributes = "";

            // id_tujuan
            $this->id_tujuan->ViewValue = $this->id_tujuan->CurrentValue;
            $this->id_tujuan->ViewValue = FormatNumber($this->id_tujuan->ViewValue, 0, -2, -2, -2);
            $this->id_tujuan->ViewCustomAttributes = "";

            // id_penunjang
            $this->id_penunjang->ViewValue = $this->id_penunjang->CurrentValue;
            $this->id_penunjang->ViewValue = FormatNumber($this->id_penunjang->ViewValue, 0, -2, -2, -2);
            $this->id_penunjang->ViewCustomAttributes = "";

            // id_pembiayaan
            $this->id_pembiayaan->ViewValue = $this->id_pembiayaan->CurrentValue;
            $this->id_pembiayaan->ViewValue = FormatNumber($this->id_pembiayaan->ViewValue, 0, -2, -2, -2);
            $this->id_pembiayaan->ViewCustomAttributes = "";

            // id_procedure
            $this->id_procedure->ViewValue = $this->id_procedure->CurrentValue;
            $this->id_procedure->ViewValue = FormatNumber($this->id_procedure->ViewValue, 0, -2, -2, -2);
            $this->id_procedure->ViewCustomAttributes = "";

            // id_aspel
            $this->id_aspel->ViewValue = $this->id_aspel->CurrentValue;
            $this->id_aspel->ViewValue = FormatNumber($this->id_aspel->ViewValue, 0, -2, -2, -2);
            $this->id_aspel->ViewCustomAttributes = "";

            // id_kelas
            $this->id_kelas->ViewValue = $this->id_kelas->CurrentValue;
            $this->id_kelas->ViewValue = FormatNumber($this->id_kelas->ViewValue, 0, -2, -2, -2);
            $this->id_kelas->ViewCustomAttributes = "";

            // TICKET_NO
            $this->TICKET_NO->LinkCustomAttributes = "";
            $this->TICKET_NO->HrefValue = "";
            $this->TICKET_NO->TooltipValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";
            $this->STATUS_PASIEN_ID->TooltipValue = "";

            // PASIEN_ID
            $this->PASIEN_ID->LinkCustomAttributes = "";
            $this->PASIEN_ID->HrefValue = "";
            $this->PASIEN_ID->TooltipValue = "";

            // VISIT_DATE
            $this->VISIT_DATE->LinkCustomAttributes = "";
            $this->VISIT_DATE->HrefValue = "";
            $this->VISIT_DATE->TooltipValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";
            $this->CLINIC_ID->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";
            $this->EMPLOYEE_ID->TooltipValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";
            $this->PAYOR_ID->TooltipValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";
            $this->CLASS_ID->TooltipValue = "";

            // AGEYEAR
            $this->AGEYEAR->LinkCustomAttributes = "";
            $this->AGEYEAR->HrefValue = "";
            $this->AGEYEAR->TooltipValue = "";

            // SEP
            $this->SEP->LinkCustomAttributes = "";
            $this->SEP->HrefValue = "";
            $this->SEP->TooltipValue = "";

            // idbooking
            $this->idbooking->LinkCustomAttributes = "";
            $this->idbooking->HrefValue = "";
            $this->idbooking->TooltipValue = "";

            // id_tujuan
            $this->id_tujuan->LinkCustomAttributes = "";
            $this->id_tujuan->HrefValue = "";
            $this->id_tujuan->TooltipValue = "";

            // id_penunjang
            $this->id_penunjang->LinkCustomAttributes = "";
            $this->id_penunjang->HrefValue = "";
            $this->id_penunjang->TooltipValue = "";

            // id_pembiayaan
            $this->id_pembiayaan->LinkCustomAttributes = "";
            $this->id_pembiayaan->HrefValue = "";
            $this->id_pembiayaan->TooltipValue = "";

            // id_procedure
            $this->id_procedure->LinkCustomAttributes = "";
            $this->id_procedure->HrefValue = "";
            $this->id_procedure->TooltipValue = "";

            // id_aspel
            $this->id_aspel->LinkCustomAttributes = "";
            $this->id_aspel->HrefValue = "";
            $this->id_aspel->TooltipValue = "";

            // id_kelas
            $this->id_kelas->LinkCustomAttributes = "";
            $this->id_kelas->HrefValue = "";
            $this->id_kelas->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // TICKET_NO
            $this->TICKET_NO->EditAttrs["class"] = "form-control";
            $this->TICKET_NO->EditCustomAttributes = "";
            $this->TICKET_NO->EditValue = HtmlEncode($this->TICKET_NO->CurrentValue);
            $this->TICKET_NO->PlaceHolder = RemoveHtml($this->TICKET_NO->caption());

            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditCustomAttributes = "";
            if ($this->NO_REGISTRATION->getSessionValue() != "") {
                $this->NO_REGISTRATION->CurrentValue = GetForeignKeyValue($this->NO_REGISTRATION->getSessionValue());
                $this->NO_REGISTRATION->OldValue = $this->NO_REGISTRATION->CurrentValue;
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
            } else {
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
            }

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
            if ($curVal != "") {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
            } else {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->Lookup !== null && is_array($this->STATUS_PASIEN_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->STATUS_PASIEN_ID->ViewValue !== null) { // Load from cache
                $this->STATUS_PASIEN_ID->EditValue = array_values($this->STATUS_PASIEN_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $this->STATUS_PASIEN_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "[ISACTIVE] = 1";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->STATUS_PASIEN_ID->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->STATUS_PASIEN_ID->EditValue = $arwrk;
            }
            $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

            // PASIEN_ID
            $this->PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->PASIEN_ID->EditCustomAttributes = "";
            if (!$this->PASIEN_ID->Raw) {
                $this->PASIEN_ID->CurrentValue = HtmlDecode($this->PASIEN_ID->CurrentValue);
            }
            $this->PASIEN_ID->EditValue = HtmlEncode($this->PASIEN_ID->CurrentValue);
            $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

            // VISIT_DATE
            $this->VISIT_DATE->EditAttrs["class"] = "form-control";
            $this->VISIT_DATE->EditCustomAttributes = "";
            $this->VISIT_DATE->EditValue = HtmlEncode(FormatDateTime($this->VISIT_DATE->CurrentValue, 11));
            $this->VISIT_DATE->PlaceHolder = RemoveHtml($this->VISIT_DATE->caption());

            // CLINIC_ID
            $this->CLINIC_ID->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
            } else {
                $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->Lookup !== null && is_array($this->CLINIC_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLINIC_ID->ViewValue !== null) { // Load from cache
                $this->CLINIC_ID->EditValue = array_values($this->CLINIC_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $this->CLINIC_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "[STYPE_ID] = 1 OR [STYPE_ID] = 2 OR [STYPE_ID] = 5";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLINIC_ID->EditValue = $arwrk;
            }
            $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

            // GENDER
            $this->GENDER->EditCustomAttributes = "";
            $curVal = trim(strval($this->GENDER->CurrentValue));
            if ($curVal != "") {
                $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
            } else {
                $this->GENDER->ViewValue = $this->GENDER->Lookup !== null && is_array($this->GENDER->Lookup->Options) ? $curVal : null;
            }
            if ($this->GENDER->ViewValue !== null) { // Load from cache
                $this->GENDER->EditValue = array_values($this->GENDER->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[GENDER]" . SearchString("=", $this->GENDER->CurrentValue, DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "[GENDER] = 1 OR [GENDER] = 2";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->GENDER->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->GENDER->EditValue = $arwrk;
            }
            $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

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

            // PAYOR_ID
            $this->PAYOR_ID->EditAttrs["class"] = "form-control";
            $this->PAYOR_ID->EditCustomAttributes = "";
            if (!$this->PAYOR_ID->Raw) {
                $this->PAYOR_ID->CurrentValue = HtmlDecode($this->PAYOR_ID->CurrentValue);
            }
            $this->PAYOR_ID->EditValue = HtmlEncode($this->PAYOR_ID->CurrentValue);
            $curVal = trim(strval($this->PAYOR_ID->CurrentValue));
            if ($curVal != "") {
                $this->PAYOR_ID->EditValue = $this->PAYOR_ID->lookupCacheOption($curVal);
                if ($this->PAYOR_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[PAYOR_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->PAYOR_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PAYOR_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->PAYOR_ID->EditValue = $this->PAYOR_ID->displayValue($arwrk);
                    } else {
                        $this->PAYOR_ID->EditValue = HtmlEncode($this->PAYOR_ID->CurrentValue);
                    }
                }
            } else {
                $this->PAYOR_ID->EditValue = null;
            }
            $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

            // CLASS_ID
            $this->CLASS_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ID->EditCustomAttributes = 'readonly';
            $this->CLASS_ID->EditValue = HtmlEncode($this->CLASS_ID->CurrentValue);
            $curVal = trim(strval($this->CLASS_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ID->EditValue = $this->CLASS_ID->lookupCacheOption($curVal);
                if ($this->CLASS_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[CLASS_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->CLASS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLASS_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->CLASS_ID->EditValue = $this->CLASS_ID->displayValue($arwrk);
                    } else {
                        $this->CLASS_ID->EditValue = HtmlEncode($this->CLASS_ID->CurrentValue);
                    }
                }
            } else {
                $this->CLASS_ID->EditValue = null;
            }
            $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

            // AGEYEAR
            $this->AGEYEAR->EditAttrs["class"] = "form-control";
            $this->AGEYEAR->EditCustomAttributes = "";
            $this->AGEYEAR->EditValue = HtmlEncode($this->AGEYEAR->CurrentValue);
            $this->AGEYEAR->PlaceHolder = RemoveHtml($this->AGEYEAR->caption());

            // SEP
            $this->SEP->EditAttrs["class"] = "form-control";
            $this->SEP->EditCustomAttributes = "";
            if (!$this->SEP->Raw) {
                $this->SEP->CurrentValue = HtmlDecode($this->SEP->CurrentValue);
            }
            $this->SEP->EditValue = HtmlEncode($this->SEP->CurrentValue);
            $this->SEP->PlaceHolder = RemoveHtml($this->SEP->caption());

            // idbooking
            $this->idbooking->EditAttrs["class"] = "form-control";
            $this->idbooking->EditCustomAttributes = "";
            if (!$this->idbooking->Raw) {
                $this->idbooking->CurrentValue = HtmlDecode($this->idbooking->CurrentValue);
            }
            $this->idbooking->EditValue = HtmlEncode($this->idbooking->CurrentValue);
            $this->idbooking->PlaceHolder = RemoveHtml($this->idbooking->caption());

            // id_tujuan
            $this->id_tujuan->EditAttrs["class"] = "form-control";
            $this->id_tujuan->EditCustomAttributes = "";
            $this->id_tujuan->EditValue = HtmlEncode($this->id_tujuan->CurrentValue);
            $this->id_tujuan->PlaceHolder = RemoveHtml($this->id_tujuan->caption());

            // id_penunjang
            $this->id_penunjang->EditAttrs["class"] = "form-control";
            $this->id_penunjang->EditCustomAttributes = "";
            $this->id_penunjang->EditValue = HtmlEncode($this->id_penunjang->CurrentValue);
            $this->id_penunjang->PlaceHolder = RemoveHtml($this->id_penunjang->caption());

            // id_pembiayaan
            $this->id_pembiayaan->EditAttrs["class"] = "form-control";
            $this->id_pembiayaan->EditCustomAttributes = "";
            $this->id_pembiayaan->EditValue = HtmlEncode($this->id_pembiayaan->CurrentValue);
            $this->id_pembiayaan->PlaceHolder = RemoveHtml($this->id_pembiayaan->caption());

            // id_procedure
            $this->id_procedure->EditAttrs["class"] = "form-control";
            $this->id_procedure->EditCustomAttributes = "";
            $this->id_procedure->EditValue = HtmlEncode($this->id_procedure->CurrentValue);
            $this->id_procedure->PlaceHolder = RemoveHtml($this->id_procedure->caption());

            // id_aspel
            $this->id_aspel->EditAttrs["class"] = "form-control";
            $this->id_aspel->EditCustomAttributes = "";
            $this->id_aspel->EditValue = HtmlEncode($this->id_aspel->CurrentValue);
            $this->id_aspel->PlaceHolder = RemoveHtml($this->id_aspel->caption());

            // id_kelas
            $this->id_kelas->EditAttrs["class"] = "form-control";
            $this->id_kelas->EditCustomAttributes = "";
            $this->id_kelas->EditValue = HtmlEncode($this->id_kelas->CurrentValue);
            $this->id_kelas->PlaceHolder = RemoveHtml($this->id_kelas->caption());

            // Add refer script

            // TICKET_NO
            $this->TICKET_NO->LinkCustomAttributes = "";
            $this->TICKET_NO->HrefValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";

            // PASIEN_ID
            $this->PASIEN_ID->LinkCustomAttributes = "";
            $this->PASIEN_ID->HrefValue = "";

            // VISIT_DATE
            $this->VISIT_DATE->LinkCustomAttributes = "";
            $this->VISIT_DATE->HrefValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";

            // AGEYEAR
            $this->AGEYEAR->LinkCustomAttributes = "";
            $this->AGEYEAR->HrefValue = "";

            // SEP
            $this->SEP->LinkCustomAttributes = "";
            $this->SEP->HrefValue = "";

            // idbooking
            $this->idbooking->LinkCustomAttributes = "";
            $this->idbooking->HrefValue = "";

            // id_tujuan
            $this->id_tujuan->LinkCustomAttributes = "";
            $this->id_tujuan->HrefValue = "";

            // id_penunjang
            $this->id_penunjang->LinkCustomAttributes = "";
            $this->id_penunjang->HrefValue = "";

            // id_pembiayaan
            $this->id_pembiayaan->LinkCustomAttributes = "";
            $this->id_pembiayaan->HrefValue = "";

            // id_procedure
            $this->id_procedure->LinkCustomAttributes = "";
            $this->id_procedure->HrefValue = "";

            // id_aspel
            $this->id_aspel->LinkCustomAttributes = "";
            $this->id_aspel->HrefValue = "";

            // id_kelas
            $this->id_kelas->LinkCustomAttributes = "";
            $this->id_kelas->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // TICKET_NO
            $this->TICKET_NO->EditAttrs["class"] = "form-control";
            $this->TICKET_NO->EditCustomAttributes = "";
            $this->TICKET_NO->EditValue = $this->TICKET_NO->CurrentValue;
            $this->TICKET_NO->EditValue = FormatNumber($this->TICKET_NO->EditValue, 0, -2, -2, -2);
            $this->TICKET_NO->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditCustomAttributes = "";
            if ($this->NO_REGISTRATION->getSessionValue() != "") {
                $this->NO_REGISTRATION->CurrentValue = GetForeignKeyValue($this->NO_REGISTRATION->getSessionValue());
                $this->NO_REGISTRATION->OldValue = $this->NO_REGISTRATION->CurrentValue;
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
            } else {
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
            }

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
            if ($curVal != "") {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
            } else {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->Lookup !== null && is_array($this->STATUS_PASIEN_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->STATUS_PASIEN_ID->ViewValue !== null) { // Load from cache
                $this->STATUS_PASIEN_ID->EditValue = array_values($this->STATUS_PASIEN_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $this->STATUS_PASIEN_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "[ISACTIVE] = 1";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->STATUS_PASIEN_ID->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->STATUS_PASIEN_ID->EditValue = $arwrk;
            }
            $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

            // PASIEN_ID
            $this->PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->PASIEN_ID->EditCustomAttributes = "";
            $this->PASIEN_ID->EditValue = $this->PASIEN_ID->CurrentValue;
            $this->PASIEN_ID->ViewCustomAttributes = "";

            // VISIT_DATE
            $this->VISIT_DATE->EditAttrs["class"] = "form-control";
            $this->VISIT_DATE->EditCustomAttributes = "";
            $this->VISIT_DATE->EditValue = HtmlEncode(FormatDateTime($this->VISIT_DATE->CurrentValue, 11));
            $this->VISIT_DATE->PlaceHolder = RemoveHtml($this->VISIT_DATE->caption());

            // CLINIC_ID
            $this->CLINIC_ID->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
            } else {
                $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->Lookup !== null && is_array($this->CLINIC_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLINIC_ID->ViewValue !== null) { // Load from cache
                $this->CLINIC_ID->EditValue = array_values($this->CLINIC_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $this->CLINIC_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "[STYPE_ID] = 1 OR [STYPE_ID] = 2 OR [STYPE_ID] = 5";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLINIC_ID->EditValue = $arwrk;
            }
            $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

            // GENDER
            $this->GENDER->EditCustomAttributes = "";
            $curVal = trim(strval($this->GENDER->CurrentValue));
            if ($curVal != "") {
                $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
            } else {
                $this->GENDER->ViewValue = $this->GENDER->Lookup !== null && is_array($this->GENDER->Lookup->Options) ? $curVal : null;
            }
            if ($this->GENDER->ViewValue !== null) { // Load from cache
                $this->GENDER->EditValue = array_values($this->GENDER->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[GENDER]" . SearchString("=", $this->GENDER->CurrentValue, DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "[GENDER] = 1 OR [GENDER] = 2";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->GENDER->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->GENDER->EditValue = $arwrk;
            }
            $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

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

            // PAYOR_ID
            $this->PAYOR_ID->EditAttrs["class"] = "form-control";
            $this->PAYOR_ID->EditCustomAttributes = "";

            // CLASS_ID
            $this->CLASS_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ID->EditCustomAttributes = 'readonly';
            $this->CLASS_ID->EditValue = HtmlEncode($this->CLASS_ID->CurrentValue);
            $curVal = trim(strval($this->CLASS_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ID->EditValue = $this->CLASS_ID->lookupCacheOption($curVal);
                if ($this->CLASS_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[CLASS_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->CLASS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLASS_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->CLASS_ID->EditValue = $this->CLASS_ID->displayValue($arwrk);
                    } else {
                        $this->CLASS_ID->EditValue = HtmlEncode($this->CLASS_ID->CurrentValue);
                    }
                }
            } else {
                $this->CLASS_ID->EditValue = null;
            }
            $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

            // AGEYEAR
            $this->AGEYEAR->EditAttrs["class"] = "form-control";
            $this->AGEYEAR->EditCustomAttributes = "";
            $this->AGEYEAR->EditValue = HtmlEncode($this->AGEYEAR->CurrentValue);
            $this->AGEYEAR->PlaceHolder = RemoveHtml($this->AGEYEAR->caption());

            // SEP
            $this->SEP->EditAttrs["class"] = "form-control";
            $this->SEP->EditCustomAttributes = "";
            if (!$this->SEP->Raw) {
                $this->SEP->CurrentValue = HtmlDecode($this->SEP->CurrentValue);
            }
            $this->SEP->EditValue = HtmlEncode($this->SEP->CurrentValue);
            $this->SEP->PlaceHolder = RemoveHtml($this->SEP->caption());

            // idbooking
            $this->idbooking->EditAttrs["class"] = "form-control";
            $this->idbooking->EditCustomAttributes = "";
            if (!$this->idbooking->Raw) {
                $this->idbooking->CurrentValue = HtmlDecode($this->idbooking->CurrentValue);
            }
            $this->idbooking->EditValue = HtmlEncode($this->idbooking->CurrentValue);
            $this->idbooking->PlaceHolder = RemoveHtml($this->idbooking->caption());

            // id_tujuan
            $this->id_tujuan->EditAttrs["class"] = "form-control";
            $this->id_tujuan->EditCustomAttributes = "";
            $this->id_tujuan->EditValue = HtmlEncode($this->id_tujuan->CurrentValue);
            $this->id_tujuan->PlaceHolder = RemoveHtml($this->id_tujuan->caption());

            // id_penunjang
            $this->id_penunjang->EditAttrs["class"] = "form-control";
            $this->id_penunjang->EditCustomAttributes = "";
            $this->id_penunjang->EditValue = HtmlEncode($this->id_penunjang->CurrentValue);
            $this->id_penunjang->PlaceHolder = RemoveHtml($this->id_penunjang->caption());

            // id_pembiayaan
            $this->id_pembiayaan->EditAttrs["class"] = "form-control";
            $this->id_pembiayaan->EditCustomAttributes = "";
            $this->id_pembiayaan->EditValue = HtmlEncode($this->id_pembiayaan->CurrentValue);
            $this->id_pembiayaan->PlaceHolder = RemoveHtml($this->id_pembiayaan->caption());

            // id_procedure
            $this->id_procedure->EditAttrs["class"] = "form-control";
            $this->id_procedure->EditCustomAttributes = "";
            $this->id_procedure->EditValue = HtmlEncode($this->id_procedure->CurrentValue);
            $this->id_procedure->PlaceHolder = RemoveHtml($this->id_procedure->caption());

            // id_aspel
            $this->id_aspel->EditAttrs["class"] = "form-control";
            $this->id_aspel->EditCustomAttributes = "";
            $this->id_aspel->EditValue = HtmlEncode($this->id_aspel->CurrentValue);
            $this->id_aspel->PlaceHolder = RemoveHtml($this->id_aspel->caption());

            // id_kelas
            $this->id_kelas->EditAttrs["class"] = "form-control";
            $this->id_kelas->EditCustomAttributes = "";
            $this->id_kelas->EditValue = HtmlEncode($this->id_kelas->CurrentValue);
            $this->id_kelas->PlaceHolder = RemoveHtml($this->id_kelas->caption());

            // Edit refer script

            // TICKET_NO
            $this->TICKET_NO->LinkCustomAttributes = "";
            $this->TICKET_NO->HrefValue = "";
            $this->TICKET_NO->TooltipValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";

            // PASIEN_ID
            $this->PASIEN_ID->LinkCustomAttributes = "";
            $this->PASIEN_ID->HrefValue = "";
            $this->PASIEN_ID->TooltipValue = "";

            // VISIT_DATE
            $this->VISIT_DATE->LinkCustomAttributes = "";
            $this->VISIT_DATE->HrefValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";

            // AGEYEAR
            $this->AGEYEAR->LinkCustomAttributes = "";
            $this->AGEYEAR->HrefValue = "";

            // SEP
            $this->SEP->LinkCustomAttributes = "";
            $this->SEP->HrefValue = "";

            // idbooking
            $this->idbooking->LinkCustomAttributes = "";
            $this->idbooking->HrefValue = "";

            // id_tujuan
            $this->id_tujuan->LinkCustomAttributes = "";
            $this->id_tujuan->HrefValue = "";

            // id_penunjang
            $this->id_penunjang->LinkCustomAttributes = "";
            $this->id_penunjang->HrefValue = "";

            // id_pembiayaan
            $this->id_pembiayaan->LinkCustomAttributes = "";
            $this->id_pembiayaan->HrefValue = "";

            // id_procedure
            $this->id_procedure->LinkCustomAttributes = "";
            $this->id_procedure->HrefValue = "";

            // id_aspel
            $this->id_aspel->LinkCustomAttributes = "";
            $this->id_aspel->HrefValue = "";

            // id_kelas
            $this->id_kelas->LinkCustomAttributes = "";
            $this->id_kelas->HrefValue = "";
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
        if ($this->TICKET_NO->Required) {
            if (!$this->TICKET_NO->IsDetailKey && EmptyValue($this->TICKET_NO->FormValue)) {
                $this->TICKET_NO->addErrorMessage(str_replace("%s", $this->TICKET_NO->caption(), $this->TICKET_NO->RequiredErrorMessage));
            }
        }
        if ($this->NO_REGISTRATION->Required) {
            if (!$this->NO_REGISTRATION->IsDetailKey && EmptyValue($this->NO_REGISTRATION->FormValue)) {
                $this->NO_REGISTRATION->addErrorMessage(str_replace("%s", $this->NO_REGISTRATION->caption(), $this->NO_REGISTRATION->RequiredErrorMessage));
            }
        }
        if ($this->STATUS_PASIEN_ID->Required) {
            if (!$this->STATUS_PASIEN_ID->IsDetailKey && EmptyValue($this->STATUS_PASIEN_ID->FormValue)) {
                $this->STATUS_PASIEN_ID->addErrorMessage(str_replace("%s", $this->STATUS_PASIEN_ID->caption(), $this->STATUS_PASIEN_ID->RequiredErrorMessage));
            }
        }
        if ($this->PASIEN_ID->Required) {
            if (!$this->PASIEN_ID->IsDetailKey && EmptyValue($this->PASIEN_ID->FormValue)) {
                $this->PASIEN_ID->addErrorMessage(str_replace("%s", $this->PASIEN_ID->caption(), $this->PASIEN_ID->RequiredErrorMessage));
            }
        }
        if ($this->VISIT_DATE->Required) {
            if (!$this->VISIT_DATE->IsDetailKey && EmptyValue($this->VISIT_DATE->FormValue)) {
                $this->VISIT_DATE->addErrorMessage(str_replace("%s", $this->VISIT_DATE->caption(), $this->VISIT_DATE->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->VISIT_DATE->FormValue)) {
            $this->VISIT_DATE->addErrorMessage($this->VISIT_DATE->getErrorMessage(false));
        }
        if ($this->CLINIC_ID->Required) {
            if (!$this->CLINIC_ID->IsDetailKey && EmptyValue($this->CLINIC_ID->FormValue)) {
                $this->CLINIC_ID->addErrorMessage(str_replace("%s", $this->CLINIC_ID->caption(), $this->CLINIC_ID->RequiredErrorMessage));
            }
        }
        if ($this->GENDER->Required) {
            if ($this->GENDER->FormValue == "") {
                $this->GENDER->addErrorMessage(str_replace("%s", $this->GENDER->caption(), $this->GENDER->RequiredErrorMessage));
            }
        }
        if ($this->EMPLOYEE_ID->Required) {
            if (!$this->EMPLOYEE_ID->IsDetailKey && EmptyValue($this->EMPLOYEE_ID->FormValue)) {
                $this->EMPLOYEE_ID->addErrorMessage(str_replace("%s", $this->EMPLOYEE_ID->caption(), $this->EMPLOYEE_ID->RequiredErrorMessage));
            }
        }
        if ($this->PAYOR_ID->Required) {
            if (!$this->PAYOR_ID->IsDetailKey && EmptyValue($this->PAYOR_ID->FormValue)) {
                $this->PAYOR_ID->addErrorMessage(str_replace("%s", $this->PAYOR_ID->caption(), $this->PAYOR_ID->RequiredErrorMessage));
            }
        }
        if ($this->CLASS_ID->Required) {
            if (!$this->CLASS_ID->IsDetailKey && EmptyValue($this->CLASS_ID->FormValue)) {
                $this->CLASS_ID->addErrorMessage(str_replace("%s", $this->CLASS_ID->caption(), $this->CLASS_ID->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->CLASS_ID->FormValue)) {
            $this->CLASS_ID->addErrorMessage($this->CLASS_ID->getErrorMessage(false));
        }
        if ($this->AGEYEAR->Required) {
            if (!$this->AGEYEAR->IsDetailKey && EmptyValue($this->AGEYEAR->FormValue)) {
                $this->AGEYEAR->addErrorMessage(str_replace("%s", $this->AGEYEAR->caption(), $this->AGEYEAR->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->AGEYEAR->FormValue)) {
            $this->AGEYEAR->addErrorMessage($this->AGEYEAR->getErrorMessage(false));
        }
        if ($this->SEP->Required) {
            if (!$this->SEP->IsDetailKey && EmptyValue($this->SEP->FormValue)) {
                $this->SEP->addErrorMessage(str_replace("%s", $this->SEP->caption(), $this->SEP->RequiredErrorMessage));
            }
        }
        if ($this->idbooking->Required) {
            if (!$this->idbooking->IsDetailKey && EmptyValue($this->idbooking->FormValue)) {
                $this->idbooking->addErrorMessage(str_replace("%s", $this->idbooking->caption(), $this->idbooking->RequiredErrorMessage));
            }
        }
        if ($this->id_tujuan->Required) {
            if (!$this->id_tujuan->IsDetailKey && EmptyValue($this->id_tujuan->FormValue)) {
                $this->id_tujuan->addErrorMessage(str_replace("%s", $this->id_tujuan->caption(), $this->id_tujuan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id_tujuan->FormValue)) {
            $this->id_tujuan->addErrorMessage($this->id_tujuan->getErrorMessage(false));
        }
        if ($this->id_penunjang->Required) {
            if (!$this->id_penunjang->IsDetailKey && EmptyValue($this->id_penunjang->FormValue)) {
                $this->id_penunjang->addErrorMessage(str_replace("%s", $this->id_penunjang->caption(), $this->id_penunjang->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id_penunjang->FormValue)) {
            $this->id_penunjang->addErrorMessage($this->id_penunjang->getErrorMessage(false));
        }
        if ($this->id_pembiayaan->Required) {
            if (!$this->id_pembiayaan->IsDetailKey && EmptyValue($this->id_pembiayaan->FormValue)) {
                $this->id_pembiayaan->addErrorMessage(str_replace("%s", $this->id_pembiayaan->caption(), $this->id_pembiayaan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id_pembiayaan->FormValue)) {
            $this->id_pembiayaan->addErrorMessage($this->id_pembiayaan->getErrorMessage(false));
        }
        if ($this->id_procedure->Required) {
            if (!$this->id_procedure->IsDetailKey && EmptyValue($this->id_procedure->FormValue)) {
                $this->id_procedure->addErrorMessage(str_replace("%s", $this->id_procedure->caption(), $this->id_procedure->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id_procedure->FormValue)) {
            $this->id_procedure->addErrorMessage($this->id_procedure->getErrorMessage(false));
        }
        if ($this->id_aspel->Required) {
            if (!$this->id_aspel->IsDetailKey && EmptyValue($this->id_aspel->FormValue)) {
                $this->id_aspel->addErrorMessage(str_replace("%s", $this->id_aspel->caption(), $this->id_aspel->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id_aspel->FormValue)) {
            $this->id_aspel->addErrorMessage($this->id_aspel->getErrorMessage(false));
        }
        if ($this->id_kelas->Required) {
            if (!$this->id_kelas->IsDetailKey && EmptyValue($this->id_kelas->FormValue)) {
                $this->id_kelas->addErrorMessage(str_replace("%s", $this->id_kelas->caption(), $this->id_kelas->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id_kelas->FormValue)) {
            $this->id_kelas->addErrorMessage($this->id_kelas->getErrorMessage(false));
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
                $thisKey .= $row['IDXDAFTAR'];
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

            // NO_REGISTRATION
            if ($this->NO_REGISTRATION->getSessionValue() != "") {
                $this->NO_REGISTRATION->ReadOnly = true;
            }
            $this->NO_REGISTRATION->setDbValueDef($rsnew, $this->NO_REGISTRATION->CurrentValue, "", $this->NO_REGISTRATION->ReadOnly);

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->setDbValueDef($rsnew, $this->STATUS_PASIEN_ID->CurrentValue, null, $this->STATUS_PASIEN_ID->ReadOnly);

            // VISIT_DATE
            $this->VISIT_DATE->setDbValueDef($rsnew, UnFormatDateTime($this->VISIT_DATE->CurrentValue, 11), null, $this->VISIT_DATE->ReadOnly);

            // CLINIC_ID
            $this->CLINIC_ID->setDbValueDef($rsnew, $this->CLINIC_ID->CurrentValue, null, $this->CLINIC_ID->ReadOnly);

            // GENDER
            $this->GENDER->setDbValueDef($rsnew, $this->GENDER->CurrentValue, null, $this->GENDER->ReadOnly);

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->setDbValueDef($rsnew, $this->EMPLOYEE_ID->CurrentValue, null, $this->EMPLOYEE_ID->ReadOnly);

            // PAYOR_ID
            $this->PAYOR_ID->setDbValueDef($rsnew, $this->PAYOR_ID->CurrentValue, null, $this->PAYOR_ID->ReadOnly);

            // CLASS_ID
            $this->CLASS_ID->setDbValueDef($rsnew, $this->CLASS_ID->CurrentValue, null, $this->CLASS_ID->ReadOnly);

            // AGEYEAR
            $this->AGEYEAR->setDbValueDef($rsnew, $this->AGEYEAR->CurrentValue, null, $this->AGEYEAR->ReadOnly);

            // SEP
            $this->SEP->setDbValueDef($rsnew, $this->SEP->CurrentValue, "", $this->SEP->ReadOnly);

            // idbooking
            $this->idbooking->setDbValueDef($rsnew, $this->idbooking->CurrentValue, null, $this->idbooking->ReadOnly);

            // id_tujuan
            $this->id_tujuan->setDbValueDef($rsnew, $this->id_tujuan->CurrentValue, null, $this->id_tujuan->ReadOnly);

            // id_penunjang
            $this->id_penunjang->setDbValueDef($rsnew, $this->id_penunjang->CurrentValue, null, $this->id_penunjang->ReadOnly);

            // id_pembiayaan
            $this->id_pembiayaan->setDbValueDef($rsnew, $this->id_pembiayaan->CurrentValue, null, $this->id_pembiayaan->ReadOnly);

            // id_procedure
            $this->id_procedure->setDbValueDef($rsnew, $this->id_procedure->CurrentValue, null, $this->id_procedure->ReadOnly);

            // id_aspel
            $this->id_aspel->setDbValueDef($rsnew, $this->id_aspel->CurrentValue, null, $this->id_aspel->ReadOnly);

            // id_kelas
            $this->id_kelas->setDbValueDef($rsnew, $this->id_kelas->CurrentValue, null, $this->id_kelas->ReadOnly);

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
        if ($this->getCurrentMasterTable() == "cv_pasien") {
            $this->NO_REGISTRATION->CurrentValue = $this->NO_REGISTRATION->getSessionValue();
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // TICKET_NO
        $this->TICKET_NO->setDbValueDef($rsnew, $this->TICKET_NO->CurrentValue, null, false);

        // NO_REGISTRATION
        $this->NO_REGISTRATION->setDbValueDef($rsnew, $this->NO_REGISTRATION->CurrentValue, "", false);

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->setDbValueDef($rsnew, $this->STATUS_PASIEN_ID->CurrentValue, null, false);

        // PASIEN_ID
        $this->PASIEN_ID->setDbValueDef($rsnew, $this->PASIEN_ID->CurrentValue, null, false);

        // VISIT_DATE
        $this->VISIT_DATE->setDbValueDef($rsnew, UnFormatDateTime($this->VISIT_DATE->CurrentValue, 11), null, false);

        // CLINIC_ID
        $this->CLINIC_ID->setDbValueDef($rsnew, $this->CLINIC_ID->CurrentValue, null, false);

        // GENDER
        $this->GENDER->setDbValueDef($rsnew, $this->GENDER->CurrentValue, null, false);

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->setDbValueDef($rsnew, $this->EMPLOYEE_ID->CurrentValue, null, false);

        // PAYOR_ID
        $this->PAYOR_ID->setDbValueDef($rsnew, $this->PAYOR_ID->CurrentValue, null, false);

        // CLASS_ID
        $this->CLASS_ID->setDbValueDef($rsnew, $this->CLASS_ID->CurrentValue, null, false);

        // AGEYEAR
        $this->AGEYEAR->setDbValueDef($rsnew, $this->AGEYEAR->CurrentValue, null, false);

        // SEP
        $this->SEP->setDbValueDef($rsnew, $this->SEP->CurrentValue, "", false);

        // idbooking
        $this->idbooking->setDbValueDef($rsnew, $this->idbooking->CurrentValue, null, false);

        // id_tujuan
        $this->id_tujuan->setDbValueDef($rsnew, $this->id_tujuan->CurrentValue, null, false);

        // id_penunjang
        $this->id_penunjang->setDbValueDef($rsnew, $this->id_penunjang->CurrentValue, null, false);

        // id_pembiayaan
        $this->id_pembiayaan->setDbValueDef($rsnew, $this->id_pembiayaan->CurrentValue, null, false);

        // id_procedure
        $this->id_procedure->setDbValueDef($rsnew, $this->id_procedure->CurrentValue, null, false);

        // id_aspel
        $this->id_aspel->setDbValueDef($rsnew, $this->id_aspel->CurrentValue, null, false);

        // id_kelas
        $this->id_kelas->setDbValueDef($rsnew, $this->id_kelas->CurrentValue, null, false);

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
        if ($masterTblVar == "cv_pasien") {
            $masterTbl = Container("cv_pasien");
            $this->NO_REGISTRATION->Visible = false;
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
                case "x_STATUS_PASIEN_ID":
                    $lookupFilter = function () {
                        return "[ISACTIVE] = 1";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_REASON_ID":
                    break;
                case "x_WAY_ID":
                    break;
                case "x_ISNEW":
                    break;
                case "x_KDPOLI_EKS":
                    break;
                case "x_CLINIC_ID":
                    $lookupFilter = function () {
                        return "[STYPE_ID] = 1 OR [STYPE_ID] = 2 OR [STYPE_ID] = 5";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_RESPONTGLPLG_DESC":
                    break;
                case "x_KELUAR_ID":
                    break;
                case "x_GENDER":
                    $lookupFilter = function () {
                        return "[GENDER] = 1 OR [GENDER] = 2";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KODE_AGAMA":
                    break;
                case "x_EMPLOYEE_ID":
                    $lookupFilter = function () {
                        return "[OBJECT_CATEGORY_ID]= 20";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_ISATTENDED":
                    break;
                case "x_CLASS_ID":
                    break;
                case "x_KAL_ID":
                    break;
                case "x_COVERAGE_ID":
                    break;
                case "x_ASALRUJUKAN":
                    break;
                case "x_DIAG_AWAL":
                    break;
                case "x_DIAGNOSA_ID":
                    break;
                case "x_PPKRUJUKAN":
                    break;
                case "x_COB":
                    break;
                case "x_Faskes":
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
