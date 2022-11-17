<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TreatmentAkomodasiGrid extends TreatmentAkomodasi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "grid";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'TREATMENT_AKOMODASI';

    // Page object name
    public $PageObjName = "TreatmentAkomodasiGrid";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fTREATMENT_AKOMODASIgrid";
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

        // Table object (TREATMENT_AKOMODASI)
        if (!isset($GLOBALS["TREATMENT_AKOMODASI"]) || get_class($GLOBALS["TREATMENT_AKOMODASI"]) == PROJECT_NAMESPACE . "TREATMENT_AKOMODASI") {
            $GLOBALS["TREATMENT_AKOMODASI"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        $this->AddUrl = "TreatmentAkomodasiAdd";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'TREATMENT_AKOMODASI');
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
                $doc = new $class(Container("TREATMENT_AKOMODASI"));
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
        $this->BILL_ID->Visible = false;
        $this->NO_REGISTRATION->Visible = false;
        $this->VISIT_ID->Visible = false;
        $this->TARIF_ID->Visible = false;
        $this->CLASS_ID->Visible = false;
        $this->CLINIC_ID->setVisibility();
        $this->CLINIC_ID_FROM->Visible = false;
        $this->TREATMENT->setVisibility();
        $this->TREAT_DATE->setVisibility();
        $this->QUANTITY->Visible = false;
        $this->MEASURE_ID->Visible = false;
        $this->DESCRIPTION->setVisibility();
        $this->CLASS_ROOM_ID->setVisibility();
        $this->KELUAR_ID->setVisibility();
        $this->BED_ID->setVisibility();
        $this->EMPLOYEE_ID->setVisibility();
        $this->DOCTOR->Visible = false;
        $this->EXIT_DATE->Visible = false;
        $this->EMPLOYEE_ID_FROM->Visible = false;
        $this->DOCTOR_FROM->Visible = false;
        $this->STATUS_PASIEN_ID->Visible = false;
        $this->DIAGNOSA_ID->Visible = false;
        $this->THENAME->Visible = false;
        $this->THEADDRESS->Visible = false;
        $this->THEID->Visible = false;
        $this->ISRJ->Visible = false;
        $this->AGEYEAR->Visible = false;
        $this->AGEMONTH->Visible = false;
        $this->AGEDAY->Visible = false;
        $this->GENDER->Visible = false;
        $this->KARYAWAN->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_FROM->Visible = false;
        $this->POTONGAN->Visible = false;
        $this->BAYAR->Visible = false;
        $this->RETUR->Visible = false;
        $this->TARIF_TYPE->Visible = false;
        $this->PPNVALUE->Visible = false;
        $this->TAGIHAN->Visible = false;
        $this->KOREKSI->Visible = false;
        $this->AMOUNT_PAID->Visible = false;
        $this->DISKON->Visible = false;
        $this->NOTA_NO->Visible = false;
        $this->SELL_PRICE->Visible = false;
        $this->ACCOUNT_ID->Visible = false;
        $this->subsidi->Visible = false;
        $this->DISCOUNT->Visible = false;
        $this->AMOUNT->Visible = false;
        $this->PPN->Visible = false;
        $this->SUBSIDISAT->Visible = false;
        $this->PRINTQ->Visible = false;
        $this->PRINTED_BY->Visible = false;
        $this->STATUS_TARIF->Visible = false;
        $this->CLINIC_TYPE->Visible = false;
        $this->PACKAGE_ID->Visible = false;
        $this->MODULE_ID->Visible = false;
        $this->THEORDER->Visible = false;
        $this->CORRECTION_ID->Visible = false;
        $this->CORRECTION_BY->Visible = false;
        $this->CASHIER->Visible = false;
        $this->PAYOR_ID->Visible = false;
        $this->KAL_ID->Visible = false;
        $this->NO_SKPINAP->Visible = false;
        $this->RESPON->Visible = false;
        $this->NOKARTU->Visible = false;
        $this->PASIEN_ID->Visible = false;
        $this->modified_datesys->Visible = false;
        $this->MAPPING_SEP->Visible = false;
        $this->TRANS_ID->Visible = false;
        $this->SPPBILL->Visible = false;
        $this->SPPBILLDATE->Visible = false;
        $this->SPPBILLUSER->Visible = false;
        $this->SPPKASIR->Visible = false;
        $this->SPPKASIRDATE->Visible = false;
        $this->SPPKASIRUSER->Visible = false;
        $this->SPPPOLI->Visible = false;
        $this->SPPPOLIUSER->Visible = false;
        $this->SPPPOLIDATE->Visible = false;
        $this->NO_SURAT_KET->setVisibility();
        $this->ID->setVisibility();
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
        $this->setupLookupOptions($this->TARIF_ID);
        $this->setupLookupOptions($this->CLINIC_ID);
        $this->setupLookupOptions($this->CLINIC_ID_FROM);
        $this->setupLookupOptions($this->CLASS_ROOM_ID);
        $this->setupLookupOptions($this->KELUAR_ID);
        $this->setupLookupOptions($this->BED_ID);
        $this->setupLookupOptions($this->EMPLOYEE_ID);

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
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "V_KASIR") {
            $masterTbl = Container("V_KASIR");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("VKasirList"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

        // Load master record
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "TREATMENT_BILL") {
            $masterTbl = Container("TREATMENT_BILL");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("TreatmentBillList"); // Return to master page
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
        if ($CurrentForm->hasValue("x_CLINIC_ID") && $CurrentForm->hasValue("o_CLINIC_ID") && $this->CLINIC_ID->CurrentValue != $this->CLINIC_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_TREATMENT") && $CurrentForm->hasValue("o_TREATMENT") && $this->TREATMENT->CurrentValue != $this->TREATMENT->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_TREAT_DATE") && $CurrentForm->hasValue("o_TREAT_DATE") && $this->TREAT_DATE->CurrentValue != $this->TREAT_DATE->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_DESCRIPTION") && $CurrentForm->hasValue("o_DESCRIPTION") && $this->DESCRIPTION->CurrentValue != $this->DESCRIPTION->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_CLASS_ROOM_ID") && $CurrentForm->hasValue("o_CLASS_ROOM_ID") && $this->CLASS_ROOM_ID->CurrentValue != $this->CLASS_ROOM_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_KELUAR_ID") && $CurrentForm->hasValue("o_KELUAR_ID") && $this->KELUAR_ID->CurrentValue != $this->KELUAR_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_BED_ID") && $CurrentForm->hasValue("o_BED_ID") && $this->BED_ID->CurrentValue != $this->BED_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_EMPLOYEE_ID") && $CurrentForm->hasValue("o_EMPLOYEE_ID") && $this->EMPLOYEE_ID->CurrentValue != $this->EMPLOYEE_ID->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_NO_SURAT_KET") && $CurrentForm->hasValue("o_NO_SURAT_KET") && $this->NO_SURAT_KET->CurrentValue != $this->NO_SURAT_KET->OldValue) {
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
        $this->CLINIC_ID->clearErrorMessage();
        $this->TREATMENT->clearErrorMessage();
        $this->TREAT_DATE->clearErrorMessage();
        $this->DESCRIPTION->clearErrorMessage();
        $this->CLASS_ROOM_ID->clearErrorMessage();
        $this->KELUAR_ID->clearErrorMessage();
        $this->BED_ID->clearErrorMessage();
        $this->EMPLOYEE_ID->clearErrorMessage();
        $this->NO_SURAT_KET->clearErrorMessage();
        $this->ID->clearErrorMessage();
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
                        $this->BILL_ID->setSessionValue("");
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

        // "copy"
        $item = &$this->ListOptions->add("copy");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canAdd();
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

            // "copy"
            $opt = $this->ListOptions["copy"];
            $copycaption = HtmlTitle($Language->phrase("CopyLink"));
            if ($Security->canAdd()) {
                $opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("CopyLink") . "</a>";
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
        $this->ORG_UNIT_CODE->CurrentValue = null;
        $this->ORG_UNIT_CODE->OldValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->BILL_ID->CurrentValue = null;
        $this->BILL_ID->OldValue = $this->BILL_ID->CurrentValue;
        $this->NO_REGISTRATION->CurrentValue = null;
        $this->NO_REGISTRATION->OldValue = $this->NO_REGISTRATION->CurrentValue;
        $this->VISIT_ID->CurrentValue = null;
        $this->VISIT_ID->OldValue = $this->VISIT_ID->CurrentValue;
        $this->TARIF_ID->CurrentValue = null;
        $this->TARIF_ID->OldValue = $this->TARIF_ID->CurrentValue;
        $this->CLASS_ID->CurrentValue = null;
        $this->CLASS_ID->OldValue = $this->CLASS_ID->CurrentValue;
        $this->CLINIC_ID->CurrentValue = null;
        $this->CLINIC_ID->OldValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID_FROM->CurrentValue = null;
        $this->CLINIC_ID_FROM->OldValue = $this->CLINIC_ID_FROM->CurrentValue;
        $this->TREATMENT->CurrentValue = null;
        $this->TREATMENT->OldValue = $this->TREATMENT->CurrentValue;
        $this->TREAT_DATE->CurrentValue = null;
        $this->TREAT_DATE->OldValue = $this->TREAT_DATE->CurrentValue;
        $this->QUANTITY->CurrentValue = null;
        $this->QUANTITY->OldValue = $this->QUANTITY->CurrentValue;
        $this->MEASURE_ID->CurrentValue = null;
        $this->MEASURE_ID->OldValue = $this->MEASURE_ID->CurrentValue;
        $this->DESCRIPTION->CurrentValue = null;
        $this->DESCRIPTION->OldValue = $this->DESCRIPTION->CurrentValue;
        $this->CLASS_ROOM_ID->CurrentValue = null;
        $this->CLASS_ROOM_ID->OldValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->KELUAR_ID->CurrentValue = null;
        $this->KELUAR_ID->OldValue = $this->KELUAR_ID->CurrentValue;
        $this->BED_ID->CurrentValue = null;
        $this->BED_ID->OldValue = $this->BED_ID->CurrentValue;
        $this->EMPLOYEE_ID->CurrentValue = null;
        $this->EMPLOYEE_ID->OldValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->DOCTOR->CurrentValue = null;
        $this->DOCTOR->OldValue = $this->DOCTOR->CurrentValue;
        $this->EXIT_DATE->CurrentValue = null;
        $this->EXIT_DATE->OldValue = $this->EXIT_DATE->CurrentValue;
        $this->EMPLOYEE_ID_FROM->CurrentValue = null;
        $this->EMPLOYEE_ID_FROM->OldValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $this->DOCTOR_FROM->CurrentValue = null;
        $this->DOCTOR_FROM->OldValue = $this->DOCTOR_FROM->CurrentValue;
        $this->STATUS_PASIEN_ID->CurrentValue = null;
        $this->STATUS_PASIEN_ID->OldValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->DIAGNOSA_ID->CurrentValue = null;
        $this->DIAGNOSA_ID->OldValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->THENAME->CurrentValue = null;
        $this->THENAME->OldValue = $this->THENAME->CurrentValue;
        $this->THEADDRESS->CurrentValue = null;
        $this->THEADDRESS->OldValue = $this->THEADDRESS->CurrentValue;
        $this->THEID->CurrentValue = null;
        $this->THEID->OldValue = $this->THEID->CurrentValue;
        $this->ISRJ->CurrentValue = null;
        $this->ISRJ->OldValue = $this->ISRJ->CurrentValue;
        $this->AGEYEAR->CurrentValue = null;
        $this->AGEYEAR->OldValue = $this->AGEYEAR->CurrentValue;
        $this->AGEMONTH->CurrentValue = null;
        $this->AGEMONTH->OldValue = $this->AGEMONTH->CurrentValue;
        $this->AGEDAY->CurrentValue = null;
        $this->AGEDAY->OldValue = $this->AGEDAY->CurrentValue;
        $this->GENDER->CurrentValue = null;
        $this->GENDER->OldValue = $this->GENDER->CurrentValue;
        $this->KARYAWAN->CurrentValue = null;
        $this->KARYAWAN->OldValue = $this->KARYAWAN->CurrentValue;
        $this->MODIFIED_BY->CurrentValue = null;
        $this->MODIFIED_BY->OldValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_DATE->CurrentValue = null;
        $this->MODIFIED_DATE->OldValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_FROM->CurrentValue = null;
        $this->MODIFIED_FROM->OldValue = $this->MODIFIED_FROM->CurrentValue;
        $this->POTONGAN->CurrentValue = null;
        $this->POTONGAN->OldValue = $this->POTONGAN->CurrentValue;
        $this->BAYAR->CurrentValue = null;
        $this->BAYAR->OldValue = $this->BAYAR->CurrentValue;
        $this->RETUR->CurrentValue = null;
        $this->RETUR->OldValue = $this->RETUR->CurrentValue;
        $this->TARIF_TYPE->CurrentValue = null;
        $this->TARIF_TYPE->OldValue = $this->TARIF_TYPE->CurrentValue;
        $this->PPNVALUE->CurrentValue = null;
        $this->PPNVALUE->OldValue = $this->PPNVALUE->CurrentValue;
        $this->TAGIHAN->CurrentValue = null;
        $this->TAGIHAN->OldValue = $this->TAGIHAN->CurrentValue;
        $this->KOREKSI->CurrentValue = null;
        $this->KOREKSI->OldValue = $this->KOREKSI->CurrentValue;
        $this->AMOUNT_PAID->CurrentValue = null;
        $this->AMOUNT_PAID->OldValue = $this->AMOUNT_PAID->CurrentValue;
        $this->DISKON->CurrentValue = null;
        $this->DISKON->OldValue = $this->DISKON->CurrentValue;
        $this->NOTA_NO->CurrentValue = null;
        $this->NOTA_NO->OldValue = $this->NOTA_NO->CurrentValue;
        $this->SELL_PRICE->CurrentValue = null;
        $this->SELL_PRICE->OldValue = $this->SELL_PRICE->CurrentValue;
        $this->ACCOUNT_ID->CurrentValue = null;
        $this->ACCOUNT_ID->OldValue = $this->ACCOUNT_ID->CurrentValue;
        $this->subsidi->CurrentValue = null;
        $this->subsidi->OldValue = $this->subsidi->CurrentValue;
        $this->DISCOUNT->CurrentValue = null;
        $this->DISCOUNT->OldValue = $this->DISCOUNT->CurrentValue;
        $this->AMOUNT->CurrentValue = null;
        $this->AMOUNT->OldValue = $this->AMOUNT->CurrentValue;
        $this->PPN->CurrentValue = null;
        $this->PPN->OldValue = $this->PPN->CurrentValue;
        $this->SUBSIDISAT->CurrentValue = null;
        $this->SUBSIDISAT->OldValue = $this->SUBSIDISAT->CurrentValue;
        $this->PRINTQ->CurrentValue = null;
        $this->PRINTQ->OldValue = $this->PRINTQ->CurrentValue;
        $this->PRINTED_BY->CurrentValue = null;
        $this->PRINTED_BY->OldValue = $this->PRINTED_BY->CurrentValue;
        $this->STATUS_TARIF->CurrentValue = null;
        $this->STATUS_TARIF->OldValue = $this->STATUS_TARIF->CurrentValue;
        $this->CLINIC_TYPE->CurrentValue = null;
        $this->CLINIC_TYPE->OldValue = $this->CLINIC_TYPE->CurrentValue;
        $this->PACKAGE_ID->CurrentValue = null;
        $this->PACKAGE_ID->OldValue = $this->PACKAGE_ID->CurrentValue;
        $this->MODULE_ID->CurrentValue = null;
        $this->MODULE_ID->OldValue = $this->MODULE_ID->CurrentValue;
        $this->THEORDER->CurrentValue = null;
        $this->THEORDER->OldValue = $this->THEORDER->CurrentValue;
        $this->CORRECTION_ID->CurrentValue = null;
        $this->CORRECTION_ID->OldValue = $this->CORRECTION_ID->CurrentValue;
        $this->CORRECTION_BY->CurrentValue = null;
        $this->CORRECTION_BY->OldValue = $this->CORRECTION_BY->CurrentValue;
        $this->CASHIER->CurrentValue = null;
        $this->CASHIER->OldValue = $this->CASHIER->CurrentValue;
        $this->PAYOR_ID->CurrentValue = null;
        $this->PAYOR_ID->OldValue = $this->PAYOR_ID->CurrentValue;
        $this->KAL_ID->CurrentValue = null;
        $this->KAL_ID->OldValue = $this->KAL_ID->CurrentValue;
        $this->NO_SKPINAP->CurrentValue = null;
        $this->NO_SKPINAP->OldValue = $this->NO_SKPINAP->CurrentValue;
        $this->RESPON->CurrentValue = null;
        $this->RESPON->OldValue = $this->RESPON->CurrentValue;
        $this->NOKARTU->CurrentValue = null;
        $this->NOKARTU->OldValue = $this->NOKARTU->CurrentValue;
        $this->PASIEN_ID->CurrentValue = null;
        $this->PASIEN_ID->OldValue = $this->PASIEN_ID->CurrentValue;
        $this->modified_datesys->CurrentValue = "getdate()";
        $this->modified_datesys->OldValue = $this->modified_datesys->CurrentValue;
        $this->MAPPING_SEP->CurrentValue = null;
        $this->MAPPING_SEP->OldValue = $this->MAPPING_SEP->CurrentValue;
        $this->TRANS_ID->CurrentValue = null;
        $this->TRANS_ID->OldValue = $this->TRANS_ID->CurrentValue;
        $this->SPPBILL->CurrentValue = null;
        $this->SPPBILL->OldValue = $this->SPPBILL->CurrentValue;
        $this->SPPBILLDATE->CurrentValue = null;
        $this->SPPBILLDATE->OldValue = $this->SPPBILLDATE->CurrentValue;
        $this->SPPBILLUSER->CurrentValue = null;
        $this->SPPBILLUSER->OldValue = $this->SPPBILLUSER->CurrentValue;
        $this->SPPKASIR->CurrentValue = null;
        $this->SPPKASIR->OldValue = $this->SPPKASIR->CurrentValue;
        $this->SPPKASIRDATE->CurrentValue = null;
        $this->SPPKASIRDATE->OldValue = $this->SPPKASIRDATE->CurrentValue;
        $this->SPPKASIRUSER->CurrentValue = null;
        $this->SPPKASIRUSER->OldValue = $this->SPPKASIRUSER->CurrentValue;
        $this->SPPPOLI->CurrentValue = null;
        $this->SPPPOLI->OldValue = $this->SPPPOLI->CurrentValue;
        $this->SPPPOLIUSER->CurrentValue = null;
        $this->SPPPOLIUSER->OldValue = $this->SPPPOLIUSER->CurrentValue;
        $this->SPPPOLIDATE->CurrentValue = null;
        $this->SPPPOLIDATE->OldValue = $this->SPPPOLIDATE->CurrentValue;
        $this->NO_SURAT_KET->CurrentValue = null;
        $this->NO_SURAT_KET->OldValue = $this->NO_SURAT_KET->CurrentValue;
        $this->ID->CurrentValue = null;
        $this->ID->OldValue = $this->ID->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $CurrentForm->FormName = $this->FormName;

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

        // Check field name 'TREATMENT' first before field var 'x_TREATMENT'
        $val = $CurrentForm->hasValue("TREATMENT") ? $CurrentForm->getValue("TREATMENT") : $CurrentForm->getValue("x_TREATMENT");
        if (!$this->TREATMENT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TREATMENT->Visible = false; // Disable update for API request
            } else {
                $this->TREATMENT->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_TREATMENT")) {
            $this->TREATMENT->setOldValue($CurrentForm->getValue("o_TREATMENT"));
        }

        // Check field name 'TREAT_DATE' first before field var 'x_TREAT_DATE'
        $val = $CurrentForm->hasValue("TREAT_DATE") ? $CurrentForm->getValue("TREAT_DATE") : $CurrentForm->getValue("x_TREAT_DATE");
        if (!$this->TREAT_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TREAT_DATE->Visible = false; // Disable update for API request
            } else {
                $this->TREAT_DATE->setFormValue($val);
            }
            $this->TREAT_DATE->CurrentValue = UnFormatDateTime($this->TREAT_DATE->CurrentValue, 0);
        }
        if ($CurrentForm->hasValue("o_TREAT_DATE")) {
            $this->TREAT_DATE->setOldValue($CurrentForm->getValue("o_TREAT_DATE"));
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
        if ($CurrentForm->hasValue("o_DESCRIPTION")) {
            $this->DESCRIPTION->setOldValue($CurrentForm->getValue("o_DESCRIPTION"));
        }

        // Check field name 'CLASS_ROOM_ID' first before field var 'x_CLASS_ROOM_ID'
        $val = $CurrentForm->hasValue("CLASS_ROOM_ID") ? $CurrentForm->getValue("CLASS_ROOM_ID") : $CurrentForm->getValue("x_CLASS_ROOM_ID");
        if (!$this->CLASS_ROOM_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLASS_ROOM_ID->Visible = false; // Disable update for API request
            } else {
                $this->CLASS_ROOM_ID->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_CLASS_ROOM_ID")) {
            $this->CLASS_ROOM_ID->setOldValue($CurrentForm->getValue("o_CLASS_ROOM_ID"));
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
        if ($CurrentForm->hasValue("o_KELUAR_ID")) {
            $this->KELUAR_ID->setOldValue($CurrentForm->getValue("o_KELUAR_ID"));
        }

        // Check field name 'BED_ID' first before field var 'x_BED_ID'
        $val = $CurrentForm->hasValue("BED_ID") ? $CurrentForm->getValue("BED_ID") : $CurrentForm->getValue("x_BED_ID");
        if (!$this->BED_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->BED_ID->Visible = false; // Disable update for API request
            } else {
                $this->BED_ID->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_BED_ID")) {
            $this->BED_ID->setOldValue($CurrentForm->getValue("o_BED_ID"));
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

        // Check field name 'NO_SURAT_KET' first before field var 'x_NO_SURAT_KET'
        $val = $CurrentForm->hasValue("NO_SURAT_KET") ? $CurrentForm->getValue("NO_SURAT_KET") : $CurrentForm->getValue("x_NO_SURAT_KET");
        if (!$this->NO_SURAT_KET->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_SURAT_KET->Visible = false; // Disable update for API request
            } else {
                $this->NO_SURAT_KET->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_NO_SURAT_KET")) {
            $this->NO_SURAT_KET->setOldValue($CurrentForm->getValue("o_NO_SURAT_KET"));
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
        $this->CLINIC_ID->CurrentValue = $this->CLINIC_ID->FormValue;
        $this->TREATMENT->CurrentValue = $this->TREATMENT->FormValue;
        $this->TREAT_DATE->CurrentValue = $this->TREAT_DATE->FormValue;
        $this->TREAT_DATE->CurrentValue = UnFormatDateTime($this->TREAT_DATE->CurrentValue, 0);
        $this->DESCRIPTION->CurrentValue = $this->DESCRIPTION->FormValue;
        $this->CLASS_ROOM_ID->CurrentValue = $this->CLASS_ROOM_ID->FormValue;
        $this->KELUAR_ID->CurrentValue = $this->KELUAR_ID->FormValue;
        $this->BED_ID->CurrentValue = $this->BED_ID->FormValue;
        $this->EMPLOYEE_ID->CurrentValue = $this->EMPLOYEE_ID->FormValue;
        $this->NO_SURAT_KET->CurrentValue = $this->NO_SURAT_KET->FormValue;
        if (!$this->isGridAdd() && !$this->isAdd()) {
            $this->ID->CurrentValue = $this->ID->FormValue;
        }
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
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->CLINIC_ID_FROM->setDbValue($row['CLINIC_ID_FROM']);
        $this->TREATMENT->setDbValue($row['TREATMENT']);
        $this->TREAT_DATE->setDbValue($row['TREAT_DATE']);
        $this->QUANTITY->setDbValue($row['QUANTITY']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->EMPLOYEE_ID_FROM->setDbValue($row['EMPLOYEE_ID_FROM']);
        $this->DOCTOR_FROM->setDbValue($row['DOCTOR_FROM']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEID->setDbValue($row['THEID']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->KARYAWAN->setDbValue($row['KARYAWAN']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->POTONGAN->setDbValue($row['POTONGAN']);
        $this->BAYAR->setDbValue($row['BAYAR']);
        $this->RETUR->setDbValue($row['RETUR']);
        $this->TARIF_TYPE->setDbValue($row['TARIF_TYPE']);
        $this->PPNVALUE->setDbValue($row['PPNVALUE']);
        $this->TAGIHAN->setDbValue($row['TAGIHAN']);
        $this->KOREKSI->setDbValue($row['KOREKSI']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
        $this->DISKON->setDbValue($row['DISKON']);
        $this->NOTA_NO->setDbValue($row['NOTA_NO']);
        $this->SELL_PRICE->setDbValue($row['SELL_PRICE']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->subsidi->setDbValue($row['subsidi']);
        $this->DISCOUNT->setDbValue($row['DISCOUNT']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->PPN->setDbValue($row['PPN']);
        $this->SUBSIDISAT->setDbValue($row['SUBSIDISAT']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->STATUS_TARIF->setDbValue($row['STATUS_TARIF']);
        $this->CLINIC_TYPE->setDbValue($row['CLINIC_TYPE']);
        $this->PACKAGE_ID->setDbValue($row['PACKAGE_ID']);
        $this->MODULE_ID->setDbValue($row['MODULE_ID']);
        $this->THEORDER->setDbValue($row['THEORDER']);
        $this->CORRECTION_ID->setDbValue($row['CORRECTION_ID']);
        $this->CORRECTION_BY->setDbValue($row['CORRECTION_BY']);
        $this->CASHIER->setDbValue($row['CASHIER']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->NO_SKPINAP->setDbValue($row['NO_SKPINAP']);
        $this->RESPON->setDbValue($row['RESPON']);
        $this->NOKARTU->setDbValue($row['NOKARTU']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->modified_datesys->setDbValue($row['modified_datesys']);
        $this->MAPPING_SEP->setDbValue($row['MAPPING_SEP']);
        $this->TRANS_ID->setDbValue($row['TRANS_ID']);
        $this->SPPBILL->setDbValue($row['SPPBILL']);
        $this->SPPBILLDATE->setDbValue($row['SPPBILLDATE']);
        $this->SPPBILLUSER->setDbValue($row['SPPBILLUSER']);
        $this->SPPKASIR->setDbValue($row['SPPKASIR']);
        $this->SPPKASIRDATE->setDbValue($row['SPPKASIRDATE']);
        $this->SPPKASIRUSER->setDbValue($row['SPPKASIRUSER']);
        $this->SPPPOLI->setDbValue($row['SPPPOLI']);
        $this->SPPPOLIUSER->setDbValue($row['SPPPOLIUSER']);
        $this->SPPPOLIDATE->setDbValue($row['SPPPOLIDATE']);
        $this->NO_SURAT_KET->setDbValue($row['NO_SURAT_KET']);
        $this->ID->setDbValue($row['ID']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['ORG_UNIT_CODE'] = $this->ORG_UNIT_CODE->CurrentValue;
        $row['BILL_ID'] = $this->BILL_ID->CurrentValue;
        $row['NO_REGISTRATION'] = $this->NO_REGISTRATION->CurrentValue;
        $row['VISIT_ID'] = $this->VISIT_ID->CurrentValue;
        $row['TARIF_ID'] = $this->TARIF_ID->CurrentValue;
        $row['CLASS_ID'] = $this->CLASS_ID->CurrentValue;
        $row['CLINIC_ID'] = $this->CLINIC_ID->CurrentValue;
        $row['CLINIC_ID_FROM'] = $this->CLINIC_ID_FROM->CurrentValue;
        $row['TREATMENT'] = $this->TREATMENT->CurrentValue;
        $row['TREAT_DATE'] = $this->TREAT_DATE->CurrentValue;
        $row['QUANTITY'] = $this->QUANTITY->CurrentValue;
        $row['MEASURE_ID'] = $this->MEASURE_ID->CurrentValue;
        $row['DESCRIPTION'] = $this->DESCRIPTION->CurrentValue;
        $row['CLASS_ROOM_ID'] = $this->CLASS_ROOM_ID->CurrentValue;
        $row['KELUAR_ID'] = $this->KELUAR_ID->CurrentValue;
        $row['BED_ID'] = $this->BED_ID->CurrentValue;
        $row['EMPLOYEE_ID'] = $this->EMPLOYEE_ID->CurrentValue;
        $row['DOCTOR'] = $this->DOCTOR->CurrentValue;
        $row['EXIT_DATE'] = $this->EXIT_DATE->CurrentValue;
        $row['EMPLOYEE_ID_FROM'] = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $row['DOCTOR_FROM'] = $this->DOCTOR_FROM->CurrentValue;
        $row['STATUS_PASIEN_ID'] = $this->STATUS_PASIEN_ID->CurrentValue;
        $row['DIAGNOSA_ID'] = $this->DIAGNOSA_ID->CurrentValue;
        $row['THENAME'] = $this->THENAME->CurrentValue;
        $row['THEADDRESS'] = $this->THEADDRESS->CurrentValue;
        $row['THEID'] = $this->THEID->CurrentValue;
        $row['ISRJ'] = $this->ISRJ->CurrentValue;
        $row['AGEYEAR'] = $this->AGEYEAR->CurrentValue;
        $row['AGEMONTH'] = $this->AGEMONTH->CurrentValue;
        $row['AGEDAY'] = $this->AGEDAY->CurrentValue;
        $row['GENDER'] = $this->GENDER->CurrentValue;
        $row['KARYAWAN'] = $this->KARYAWAN->CurrentValue;
        $row['MODIFIED_BY'] = $this->MODIFIED_BY->CurrentValue;
        $row['MODIFIED_DATE'] = $this->MODIFIED_DATE->CurrentValue;
        $row['MODIFIED_FROM'] = $this->MODIFIED_FROM->CurrentValue;
        $row['POTONGAN'] = $this->POTONGAN->CurrentValue;
        $row['BAYAR'] = $this->BAYAR->CurrentValue;
        $row['RETUR'] = $this->RETUR->CurrentValue;
        $row['TARIF_TYPE'] = $this->TARIF_TYPE->CurrentValue;
        $row['PPNVALUE'] = $this->PPNVALUE->CurrentValue;
        $row['TAGIHAN'] = $this->TAGIHAN->CurrentValue;
        $row['KOREKSI'] = $this->KOREKSI->CurrentValue;
        $row['AMOUNT_PAID'] = $this->AMOUNT_PAID->CurrentValue;
        $row['DISKON'] = $this->DISKON->CurrentValue;
        $row['NOTA_NO'] = $this->NOTA_NO->CurrentValue;
        $row['SELL_PRICE'] = $this->SELL_PRICE->CurrentValue;
        $row['ACCOUNT_ID'] = $this->ACCOUNT_ID->CurrentValue;
        $row['subsidi'] = $this->subsidi->CurrentValue;
        $row['DISCOUNT'] = $this->DISCOUNT->CurrentValue;
        $row['AMOUNT'] = $this->AMOUNT->CurrentValue;
        $row['PPN'] = $this->PPN->CurrentValue;
        $row['SUBSIDISAT'] = $this->SUBSIDISAT->CurrentValue;
        $row['PRINTQ'] = $this->PRINTQ->CurrentValue;
        $row['PRINTED_BY'] = $this->PRINTED_BY->CurrentValue;
        $row['STATUS_TARIF'] = $this->STATUS_TARIF->CurrentValue;
        $row['CLINIC_TYPE'] = $this->CLINIC_TYPE->CurrentValue;
        $row['PACKAGE_ID'] = $this->PACKAGE_ID->CurrentValue;
        $row['MODULE_ID'] = $this->MODULE_ID->CurrentValue;
        $row['THEORDER'] = $this->THEORDER->CurrentValue;
        $row['CORRECTION_ID'] = $this->CORRECTION_ID->CurrentValue;
        $row['CORRECTION_BY'] = $this->CORRECTION_BY->CurrentValue;
        $row['CASHIER'] = $this->CASHIER->CurrentValue;
        $row['PAYOR_ID'] = $this->PAYOR_ID->CurrentValue;
        $row['KAL_ID'] = $this->KAL_ID->CurrentValue;
        $row['NO_SKPINAP'] = $this->NO_SKPINAP->CurrentValue;
        $row['RESPON'] = $this->RESPON->CurrentValue;
        $row['NOKARTU'] = $this->NOKARTU->CurrentValue;
        $row['PASIEN_ID'] = $this->PASIEN_ID->CurrentValue;
        $row['modified_datesys'] = $this->modified_datesys->CurrentValue;
        $row['MAPPING_SEP'] = $this->MAPPING_SEP->CurrentValue;
        $row['TRANS_ID'] = $this->TRANS_ID->CurrentValue;
        $row['SPPBILL'] = $this->SPPBILL->CurrentValue;
        $row['SPPBILLDATE'] = $this->SPPBILLDATE->CurrentValue;
        $row['SPPBILLUSER'] = $this->SPPBILLUSER->CurrentValue;
        $row['SPPKASIR'] = $this->SPPKASIR->CurrentValue;
        $row['SPPKASIRDATE'] = $this->SPPKASIRDATE->CurrentValue;
        $row['SPPKASIRUSER'] = $this->SPPKASIRUSER->CurrentValue;
        $row['SPPPOLI'] = $this->SPPPOLI->CurrentValue;
        $row['SPPPOLIUSER'] = $this->SPPPOLIUSER->CurrentValue;
        $row['SPPPOLIDATE'] = $this->SPPPOLIDATE->CurrentValue;
        $row['NO_SURAT_KET'] = $this->NO_SURAT_KET->CurrentValue;
        $row['ID'] = $this->ID->CurrentValue;
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

        // BILL_ID

        // NO_REGISTRATION

        // VISIT_ID

        // TARIF_ID

        // CLASS_ID

        // CLINIC_ID

        // CLINIC_ID_FROM

        // TREATMENT

        // TREAT_DATE

        // QUANTITY

        // MEASURE_ID

        // DESCRIPTION

        // CLASS_ROOM_ID

        // KELUAR_ID

        // BED_ID

        // EMPLOYEE_ID

        // DOCTOR

        // EXIT_DATE

        // EMPLOYEE_ID_FROM

        // DOCTOR_FROM

        // STATUS_PASIEN_ID

        // DIAGNOSA_ID

        // THENAME

        // THEADDRESS

        // THEID

        // ISRJ

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // GENDER

        // KARYAWAN

        // MODIFIED_BY

        // MODIFIED_DATE

        // MODIFIED_FROM

        // POTONGAN

        // BAYAR

        // RETUR

        // TARIF_TYPE

        // PPNVALUE

        // TAGIHAN

        // KOREKSI

        // AMOUNT_PAID

        // DISKON

        // NOTA_NO

        // SELL_PRICE

        // ACCOUNT_ID

        // subsidi

        // DISCOUNT

        // AMOUNT

        // PPN

        // SUBSIDISAT

        // PRINTQ

        // PRINTED_BY

        // STATUS_TARIF

        // CLINIC_TYPE

        // PACKAGE_ID

        // MODULE_ID

        // THEORDER

        // CORRECTION_ID

        // CORRECTION_BY

        // CASHIER

        // PAYOR_ID

        // KAL_ID

        // NO_SKPINAP

        // RESPON

        // NOKARTU

        // PASIEN_ID

        // modified_datesys

        // MAPPING_SEP

        // TRANS_ID

        // SPPBILL

        // SPPBILLDATE

        // SPPBILLUSER

        // SPPKASIR

        // SPPKASIRDATE

        // SPPKASIRUSER

        // SPPPOLI

        // SPPPOLIUSER

        // SPPPOLIDATE

        // NO_SURAT_KET

        // ID
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // BILL_ID
            $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
            $this->BILL_ID->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // VISIT_ID
            $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
            $this->VISIT_ID->ViewCustomAttributes = "";

            // TARIF_ID
            $curVal = trim(strval($this->TARIF_ID->CurrentValue));
            if ($curVal != "") {
                $this->TARIF_ID->ViewValue = $this->TARIF_ID->lookupCacheOption($curVal);
                if ($this->TARIF_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[TARIF_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->TARIF_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->TARIF_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->TARIF_ID->ViewValue = $this->TARIF_ID->displayValue($arwrk);
                    } else {
                        $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
                    }
                }
            } else {
                $this->TARIF_ID->ViewValue = null;
            }
            $this->TARIF_ID->ViewCustomAttributes = "";

            // CLASS_ID
            $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
            $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
            $this->CLASS_ID->ViewCustomAttributes = "";

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

            // CLINIC_ID_FROM
            $curVal = trim(strval($this->CLINIC_ID_FROM->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->lookupCacheOption($curVal);
                if ($this->CLINIC_ID_FROM->ViewValue === null) { // Lookup from database
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "[STYPE_ID] = 0";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->CLINIC_ID_FROM->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLINIC_ID_FROM->Lookup->renderViewRow($rswrk[0]);
                        $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->displayValue($arwrk);
                    } else {
                        $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->CurrentValue;
                    }
                }
            } else {
                $this->CLINIC_ID_FROM->ViewValue = null;
            }
            $this->CLINIC_ID_FROM->ViewCustomAttributes = "";

            // TREATMENT
            $this->TREATMENT->ViewValue = $this->TREATMENT->CurrentValue;
            $this->TREATMENT->ViewCustomAttributes = "";

            // TREAT_DATE
            $this->TREAT_DATE->ViewValue = $this->TREAT_DATE->CurrentValue;
            $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 0);
            $this->TREAT_DATE->ViewCustomAttributes = "";

            // QUANTITY
            $this->QUANTITY->ViewValue = $this->QUANTITY->CurrentValue;
            $this->QUANTITY->ViewValue = FormatNumber($this->QUANTITY->ViewValue, 2, -2, -2, -2);
            $this->QUANTITY->ViewCustomAttributes = "";

            // MEASURE_ID
            $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
            $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
            $this->MEASURE_ID->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // CLASS_ROOM_ID
            $curVal = trim(strval($this->CLASS_ROOM_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->lookupCacheOption($curVal);
                if ($this->CLASS_ROOM_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[CLASS_ROOM_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->CLASS_ROOM_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLASS_ROOM_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->displayValue($arwrk);
                    } else {
                        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
                    }
                }
            } else {
                $this->CLASS_ROOM_ID->ViewValue = null;
            }
            $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

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

            // BED_ID
            $curVal = trim(strval($this->BED_ID->CurrentValue));
            if ($curVal != "") {
                $this->BED_ID->ViewValue = $this->BED_ID->lookupCacheOption($curVal);
                if ($this->BED_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[BED_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->BED_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->BED_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->BED_ID->ViewValue = $this->BED_ID->displayValue($arwrk);
                    } else {
                        $this->BED_ID->ViewValue = $this->BED_ID->CurrentValue;
                    }
                }
            } else {
                $this->BED_ID->ViewValue = null;
            }
            $this->BED_ID->ViewCustomAttributes = "";

            // EMPLOYEE_ID
            $curVal = trim(strval($this->EMPLOYEE_ID->CurrentValue));
            if ($curVal != "") {
                $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->lookupCacheOption($curVal);
                if ($this->EMPLOYEE_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[EMPLOYEE_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->EMPLOYEE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
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

            // DOCTOR
            $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
            $this->DOCTOR->ViewCustomAttributes = "";

            // EXIT_DATE
            $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
            $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
            $this->EXIT_DATE->ViewCustomAttributes = "";

            // EMPLOYEE_ID_FROM
            $this->EMPLOYEE_ID_FROM->ViewValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
            $this->EMPLOYEE_ID_FROM->ViewCustomAttributes = "";

            // DOCTOR_FROM
            $this->DOCTOR_FROM->ViewValue = $this->DOCTOR_FROM->CurrentValue;
            $this->DOCTOR_FROM->ViewCustomAttributes = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
            $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
            $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
            $this->DIAGNOSA_ID->ViewCustomAttributes = "";

            // THENAME
            $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
            $this->THENAME->ViewCustomAttributes = "";

            // THEADDRESS
            $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
            $this->THEADDRESS->ViewCustomAttributes = "";

            // THEID
            $this->THEID->ViewValue = $this->THEID->CurrentValue;
            $this->THEID->ViewCustomAttributes = "";

            // ISRJ
            $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
            $this->ISRJ->ViewCustomAttributes = "";

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

            // GENDER
            $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
            $this->GENDER->ViewCustomAttributes = "";

            // KARYAWAN
            $this->KARYAWAN->ViewValue = $this->KARYAWAN->CurrentValue;
            $this->KARYAWAN->ViewCustomAttributes = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
            $this->MODIFIED_BY->ViewCustomAttributes = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
            $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
            $this->MODIFIED_DATE->ViewCustomAttributes = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
            $this->MODIFIED_FROM->ViewCustomAttributes = "";

            // POTONGAN
            $this->POTONGAN->ViewValue = $this->POTONGAN->CurrentValue;
            $this->POTONGAN->ViewValue = FormatNumber($this->POTONGAN->ViewValue, 2, -2, -2, -2);
            $this->POTONGAN->ViewCustomAttributes = "";

            // BAYAR
            $this->BAYAR->ViewValue = $this->BAYAR->CurrentValue;
            $this->BAYAR->ViewValue = FormatNumber($this->BAYAR->ViewValue, 2, -2, -2, -2);
            $this->BAYAR->ViewCustomAttributes = "";

            // RETUR
            $this->RETUR->ViewValue = $this->RETUR->CurrentValue;
            $this->RETUR->ViewValue = FormatNumber($this->RETUR->ViewValue, 2, -2, -2, -2);
            $this->RETUR->ViewCustomAttributes = "";

            // TARIF_TYPE
            $this->TARIF_TYPE->ViewValue = $this->TARIF_TYPE->CurrentValue;
            $this->TARIF_TYPE->ViewCustomAttributes = "";

            // PPNVALUE
            $this->PPNVALUE->ViewValue = $this->PPNVALUE->CurrentValue;
            $this->PPNVALUE->ViewValue = FormatNumber($this->PPNVALUE->ViewValue, 2, -2, -2, -2);
            $this->PPNVALUE->ViewCustomAttributes = "";

            // TAGIHAN
            $this->TAGIHAN->ViewValue = $this->TAGIHAN->CurrentValue;
            $this->TAGIHAN->ViewValue = FormatNumber($this->TAGIHAN->ViewValue, 2, -2, -2, -2);
            $this->TAGIHAN->ViewCustomAttributes = "";

            // KOREKSI
            $this->KOREKSI->ViewValue = $this->KOREKSI->CurrentValue;
            $this->KOREKSI->ViewValue = FormatNumber($this->KOREKSI->ViewValue, 2, -2, -2, -2);
            $this->KOREKSI->ViewCustomAttributes = "";

            // AMOUNT_PAID
            $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
            $this->AMOUNT_PAID->ViewValue = FormatNumber($this->AMOUNT_PAID->ViewValue, 2, -2, -2, -2);
            $this->AMOUNT_PAID->ViewCustomAttributes = "";

            // DISKON
            $this->DISKON->ViewValue = $this->DISKON->CurrentValue;
            $this->DISKON->ViewValue = FormatNumber($this->DISKON->ViewValue, 2, -2, -2, -2);
            $this->DISKON->ViewCustomAttributes = "";

            // NOTA_NO
            $this->NOTA_NO->ViewValue = $this->NOTA_NO->CurrentValue;
            $this->NOTA_NO->ViewCustomAttributes = "";

            // SELL_PRICE
            $this->SELL_PRICE->ViewValue = $this->SELL_PRICE->CurrentValue;
            $this->SELL_PRICE->ViewValue = FormatNumber($this->SELL_PRICE->ViewValue, 2, -2, -2, -2);
            $this->SELL_PRICE->ViewCustomAttributes = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
            $this->ACCOUNT_ID->ViewCustomAttributes = "";

            // subsidi
            $this->subsidi->ViewValue = $this->subsidi->CurrentValue;
            $this->subsidi->ViewValue = FormatNumber($this->subsidi->ViewValue, 2, -2, -2, -2);
            $this->subsidi->ViewCustomAttributes = "";

            // DISCOUNT
            $this->DISCOUNT->ViewValue = $this->DISCOUNT->CurrentValue;
            $this->DISCOUNT->ViewValue = FormatNumber($this->DISCOUNT->ViewValue, 2, -2, -2, -2);
            $this->DISCOUNT->ViewCustomAttributes = "";

            // AMOUNT
            $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
            $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
            $this->AMOUNT->ViewCustomAttributes = "";

            // PPN
            $this->PPN->ViewValue = $this->PPN->CurrentValue;
            $this->PPN->ViewValue = FormatNumber($this->PPN->ViewValue, 2, -2, -2, -2);
            $this->PPN->ViewCustomAttributes = "";

            // SUBSIDISAT
            $this->SUBSIDISAT->ViewValue = $this->SUBSIDISAT->CurrentValue;
            $this->SUBSIDISAT->ViewValue = FormatNumber($this->SUBSIDISAT->ViewValue, 2, -2, -2, -2);
            $this->SUBSIDISAT->ViewCustomAttributes = "";

            // PRINTQ
            $this->PRINTQ->ViewValue = $this->PRINTQ->CurrentValue;
            $this->PRINTQ->ViewValue = FormatNumber($this->PRINTQ->ViewValue, 0, -2, -2, -2);
            $this->PRINTQ->ViewCustomAttributes = "";

            // PRINTED_BY
            $this->PRINTED_BY->ViewValue = $this->PRINTED_BY->CurrentValue;
            $this->PRINTED_BY->ViewCustomAttributes = "";

            // STATUS_TARIF
            $this->STATUS_TARIF->ViewValue = $this->STATUS_TARIF->CurrentValue;
            $this->STATUS_TARIF->ViewValue = FormatNumber($this->STATUS_TARIF->ViewValue, 0, -2, -2, -2);
            $this->STATUS_TARIF->ViewCustomAttributes = "";

            // CLINIC_TYPE
            $this->CLINIC_TYPE->ViewValue = $this->CLINIC_TYPE->CurrentValue;
            $this->CLINIC_TYPE->ViewValue = FormatNumber($this->CLINIC_TYPE->ViewValue, 0, -2, -2, -2);
            $this->CLINIC_TYPE->ViewCustomAttributes = "";

            // PACKAGE_ID
            $this->PACKAGE_ID->ViewValue = $this->PACKAGE_ID->CurrentValue;
            $this->PACKAGE_ID->ViewCustomAttributes = "";

            // MODULE_ID
            $this->MODULE_ID->ViewValue = $this->MODULE_ID->CurrentValue;
            $this->MODULE_ID->ViewCustomAttributes = "";

            // THEORDER
            $this->THEORDER->ViewValue = $this->THEORDER->CurrentValue;
            $this->THEORDER->ViewValue = FormatNumber($this->THEORDER->ViewValue, 0, -2, -2, -2);
            $this->THEORDER->ViewCustomAttributes = "";

            // CORRECTION_ID
            $this->CORRECTION_ID->ViewValue = $this->CORRECTION_ID->CurrentValue;
            $this->CORRECTION_ID->ViewCustomAttributes = "";

            // CORRECTION_BY
            $this->CORRECTION_BY->ViewValue = $this->CORRECTION_BY->CurrentValue;
            $this->CORRECTION_BY->ViewCustomAttributes = "";

            // CASHIER
            $this->CASHIER->ViewValue = $this->CASHIER->CurrentValue;
            $this->CASHIER->ViewCustomAttributes = "";

            // PAYOR_ID
            $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
            $this->PAYOR_ID->ViewCustomAttributes = "";

            // KAL_ID
            $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
            $this->KAL_ID->ViewCustomAttributes = "";

            // NO_SKPINAP
            $this->NO_SKPINAP->ViewValue = $this->NO_SKPINAP->CurrentValue;
            $this->NO_SKPINAP->ViewCustomAttributes = "";

            // NOKARTU
            $this->NOKARTU->ViewValue = $this->NOKARTU->CurrentValue;
            $this->NOKARTU->ViewCustomAttributes = "";

            // PASIEN_ID
            $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
            $this->PASIEN_ID->ViewCustomAttributes = "";

            // modified_datesys
            $this->modified_datesys->ViewValue = $this->modified_datesys->CurrentValue;
            $this->modified_datesys->ViewValue = FormatDateTime($this->modified_datesys->ViewValue, 0);
            $this->modified_datesys->ViewCustomAttributes = "";

            // MAPPING_SEP
            $this->MAPPING_SEP->ViewValue = $this->MAPPING_SEP->CurrentValue;
            $this->MAPPING_SEP->ViewCustomAttributes = "";

            // TRANS_ID
            $this->TRANS_ID->ViewValue = $this->TRANS_ID->CurrentValue;
            $this->TRANS_ID->ViewCustomAttributes = "";

            // SPPBILL
            $this->SPPBILL->ViewValue = $this->SPPBILL->CurrentValue;
            $this->SPPBILL->ViewCustomAttributes = "";

            // SPPBILLDATE
            $this->SPPBILLDATE->ViewValue = $this->SPPBILLDATE->CurrentValue;
            $this->SPPBILLDATE->ViewValue = FormatDateTime($this->SPPBILLDATE->ViewValue, 0);
            $this->SPPBILLDATE->ViewCustomAttributes = "";

            // SPPBILLUSER
            $this->SPPBILLUSER->ViewValue = $this->SPPBILLUSER->CurrentValue;
            $this->SPPBILLUSER->ViewCustomAttributes = "";

            // SPPKASIR
            $this->SPPKASIR->ViewValue = $this->SPPKASIR->CurrentValue;
            $this->SPPKASIR->ViewCustomAttributes = "";

            // SPPKASIRDATE
            $this->SPPKASIRDATE->ViewValue = $this->SPPKASIRDATE->CurrentValue;
            $this->SPPKASIRDATE->ViewValue = FormatDateTime($this->SPPKASIRDATE->ViewValue, 0);
            $this->SPPKASIRDATE->ViewCustomAttributes = "";

            // SPPKASIRUSER
            $this->SPPKASIRUSER->ViewValue = $this->SPPKASIRUSER->CurrentValue;
            $this->SPPKASIRUSER->ViewCustomAttributes = "";

            // SPPPOLI
            $this->SPPPOLI->ViewValue = $this->SPPPOLI->CurrentValue;
            $this->SPPPOLI->ViewCustomAttributes = "";

            // SPPPOLIUSER
            $this->SPPPOLIUSER->ViewValue = $this->SPPPOLIUSER->CurrentValue;
            $this->SPPPOLIUSER->ViewCustomAttributes = "";

            // SPPPOLIDATE
            $this->SPPPOLIDATE->ViewValue = $this->SPPPOLIDATE->CurrentValue;
            $this->SPPPOLIDATE->ViewValue = FormatDateTime($this->SPPPOLIDATE->ViewValue, 0);
            $this->SPPPOLIDATE->ViewCustomAttributes = "";

            // NO_SURAT_KET
            $this->NO_SURAT_KET->ViewValue = $this->NO_SURAT_KET->CurrentValue;
            $this->NO_SURAT_KET->ViewCustomAttributes = "";

            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";
            $this->CLINIC_ID->TooltipValue = "";

            // TREATMENT
            $this->TREATMENT->LinkCustomAttributes = "";
            $this->TREATMENT->HrefValue = "";
            $this->TREATMENT->TooltipValue = "";

            // TREAT_DATE
            $this->TREAT_DATE->LinkCustomAttributes = "";
            $this->TREAT_DATE->HrefValue = "";
            $this->TREAT_DATE->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";
            $this->DESCRIPTION->TooltipValue = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
            $this->CLASS_ROOM_ID->HrefValue = "";
            $this->CLASS_ROOM_ID->TooltipValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->LinkCustomAttributes = "";
            $this->KELUAR_ID->HrefValue = "";
            $this->KELUAR_ID->TooltipValue = "";

            // BED_ID
            $this->BED_ID->LinkCustomAttributes = "";
            $this->BED_ID->HrefValue = "";
            $this->BED_ID->TooltipValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";
            $this->EMPLOYEE_ID->TooltipValue = "";

            // NO_SURAT_KET
            $this->NO_SURAT_KET->LinkCustomAttributes = "";
            $this->NO_SURAT_KET->HrefValue = "";
            $this->NO_SURAT_KET->TooltipValue = "";

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";
            $this->ID->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
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
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLINIC_ID->EditValue = $arwrk;
            }
            $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

            // TREATMENT
            $this->TREATMENT->EditAttrs["class"] = "form-control";
            $this->TREATMENT->EditCustomAttributes = "";
            if (!$this->TREATMENT->Raw) {
                $this->TREATMENT->CurrentValue = HtmlDecode($this->TREATMENT->CurrentValue);
            }
            $this->TREATMENT->EditValue = HtmlEncode($this->TREATMENT->CurrentValue);
            $this->TREATMENT->PlaceHolder = RemoveHtml($this->TREATMENT->caption());

            // TREAT_DATE
            $this->TREAT_DATE->EditAttrs["class"] = "form-control";
            $this->TREAT_DATE->EditCustomAttributes = "";
            $this->TREAT_DATE->EditValue = HtmlEncode(FormatDateTime($this->TREAT_DATE->CurrentValue, 8));
            $this->TREAT_DATE->PlaceHolder = RemoveHtml($this->TREAT_DATE->caption());

            // DESCRIPTION
            $this->DESCRIPTION->EditAttrs["class"] = "form-control";
            $this->DESCRIPTION->EditCustomAttributes = "";
            if (!$this->DESCRIPTION->Raw) {
                $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
            }
            $this->DESCRIPTION->EditValue = HtmlEncode($this->DESCRIPTION->CurrentValue);
            $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLASS_ROOM_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->lookupCacheOption($curVal);
            } else {
                $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->Lookup !== null && is_array($this->CLASS_ROOM_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLASS_ROOM_ID->ViewValue !== null) { // Load from cache
                $this->CLASS_ROOM_ID->EditValue = array_values($this->CLASS_ROOM_ID->Lookup->Options);
                if ($this->CLASS_ROOM_ID->ViewValue == "") {
                    $this->CLASS_ROOM_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLASS_ROOM_ID]" . SearchString("=", $this->CLASS_ROOM_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->CLASS_ROOM_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLASS_ROOM_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->displayValue($arwrk);
                } else {
                    $this->CLASS_ROOM_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->CLASS_ROOM_ID->EditValue = $arwrk;
            }
            $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

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

            // BED_ID
            $this->BED_ID->EditAttrs["class"] = "form-control";
            $this->BED_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->BED_ID->CurrentValue));
            if ($curVal != "") {
                $this->BED_ID->ViewValue = $this->BED_ID->lookupCacheOption($curVal);
            } else {
                $this->BED_ID->ViewValue = $this->BED_ID->Lookup !== null && is_array($this->BED_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->BED_ID->ViewValue !== null) { // Load from cache
                $this->BED_ID->EditValue = array_values($this->BED_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[BED_ID]" . SearchString("=", $this->BED_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->BED_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                foreach ($arwrk as &$row)
                    $row = $this->BED_ID->Lookup->renderViewRow($row);
                $this->BED_ID->EditValue = $arwrk;
            }
            $this->BED_ID->PlaceHolder = RemoveHtml($this->BED_ID->caption());

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
                $sqlWrk = $this->EMPLOYEE_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->EMPLOYEE_ID->EditValue = $arwrk;
            }
            $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

            // NO_SURAT_KET
            $this->NO_SURAT_KET->EditAttrs["class"] = "form-control";
            $this->NO_SURAT_KET->EditCustomAttributes = "";
            if (!$this->NO_SURAT_KET->Raw) {
                $this->NO_SURAT_KET->CurrentValue = HtmlDecode($this->NO_SURAT_KET->CurrentValue);
            }
            $this->NO_SURAT_KET->EditValue = HtmlEncode($this->NO_SURAT_KET->CurrentValue);
            $this->NO_SURAT_KET->PlaceHolder = RemoveHtml($this->NO_SURAT_KET->caption());

            // ID

            // Add refer script

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";

            // TREATMENT
            $this->TREATMENT->LinkCustomAttributes = "";
            $this->TREATMENT->HrefValue = "";

            // TREAT_DATE
            $this->TREAT_DATE->LinkCustomAttributes = "";
            $this->TREAT_DATE->HrefValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
            $this->CLASS_ROOM_ID->HrefValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->LinkCustomAttributes = "";
            $this->KELUAR_ID->HrefValue = "";

            // BED_ID
            $this->BED_ID->LinkCustomAttributes = "";
            $this->BED_ID->HrefValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";

            // NO_SURAT_KET
            $this->NO_SURAT_KET->LinkCustomAttributes = "";
            $this->NO_SURAT_KET->HrefValue = "";

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // CLINIC_ID
            $this->CLINIC_ID->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID->EditValue = $this->CLINIC_ID->lookupCacheOption($curVal);
                if ($this->CLINIC_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLINIC_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->displayValue($arwrk);
                    } else {
                        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
                    }
                }
            } else {
                $this->CLINIC_ID->EditValue = null;
            }
            $this->CLINIC_ID->ViewCustomAttributes = "";

            // TREATMENT
            $this->TREATMENT->EditAttrs["class"] = "form-control";
            $this->TREATMENT->EditCustomAttributes = "";
            $this->TREATMENT->EditValue = $this->TREATMENT->CurrentValue;
            $this->TREATMENT->ViewCustomAttributes = "";

            // TREAT_DATE
            $this->TREAT_DATE->EditAttrs["class"] = "form-control";
            $this->TREAT_DATE->EditCustomAttributes = "";
            $this->TREAT_DATE->EditValue = $this->TREAT_DATE->CurrentValue;
            $this->TREAT_DATE->EditValue = FormatDateTime($this->TREAT_DATE->EditValue, 0);
            $this->TREAT_DATE->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->EditAttrs["class"] = "form-control";
            $this->DESCRIPTION->EditCustomAttributes = "";
            if (!$this->DESCRIPTION->Raw) {
                $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
            }
            $this->DESCRIPTION->EditValue = HtmlEncode($this->DESCRIPTION->CurrentValue);
            $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLASS_ROOM_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->lookupCacheOption($curVal);
            } else {
                $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->Lookup !== null && is_array($this->CLASS_ROOM_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLASS_ROOM_ID->ViewValue !== null) { // Load from cache
                $this->CLASS_ROOM_ID->EditValue = array_values($this->CLASS_ROOM_ID->Lookup->Options);
                if ($this->CLASS_ROOM_ID->ViewValue == "") {
                    $this->CLASS_ROOM_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLASS_ROOM_ID]" . SearchString("=", $this->CLASS_ROOM_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->CLASS_ROOM_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLASS_ROOM_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->displayValue($arwrk);
                } else {
                    $this->CLASS_ROOM_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->CLASS_ROOM_ID->EditValue = $arwrk;
            }
            $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

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

            // BED_ID
            $this->BED_ID->EditAttrs["class"] = "form-control";
            $this->BED_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->BED_ID->CurrentValue));
            if ($curVal != "") {
                $this->BED_ID->ViewValue = $this->BED_ID->lookupCacheOption($curVal);
            } else {
                $this->BED_ID->ViewValue = $this->BED_ID->Lookup !== null && is_array($this->BED_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->BED_ID->ViewValue !== null) { // Load from cache
                $this->BED_ID->EditValue = array_values($this->BED_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[BED_ID]" . SearchString("=", $this->BED_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->BED_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                foreach ($arwrk as &$row)
                    $row = $this->BED_ID->Lookup->renderViewRow($row);
                $this->BED_ID->EditValue = $arwrk;
            }
            $this->BED_ID->PlaceHolder = RemoveHtml($this->BED_ID->caption());

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
                $sqlWrk = $this->EMPLOYEE_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->EMPLOYEE_ID->EditValue = $arwrk;
            }
            $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

            // NO_SURAT_KET
            $this->NO_SURAT_KET->EditAttrs["class"] = "form-control";
            $this->NO_SURAT_KET->EditCustomAttributes = "";
            if (!$this->NO_SURAT_KET->Raw) {
                $this->NO_SURAT_KET->CurrentValue = HtmlDecode($this->NO_SURAT_KET->CurrentValue);
            }
            $this->NO_SURAT_KET->EditValue = HtmlEncode($this->NO_SURAT_KET->CurrentValue);
            $this->NO_SURAT_KET->PlaceHolder = RemoveHtml($this->NO_SURAT_KET->caption());

            // ID
            $this->ID->EditAttrs["class"] = "form-control";
            $this->ID->EditCustomAttributes = "";
            $this->ID->EditValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // Edit refer script

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";
            $this->CLINIC_ID->TooltipValue = "";

            // TREATMENT
            $this->TREATMENT->LinkCustomAttributes = "";
            $this->TREATMENT->HrefValue = "";
            $this->TREATMENT->TooltipValue = "";

            // TREAT_DATE
            $this->TREAT_DATE->LinkCustomAttributes = "";
            $this->TREAT_DATE->HrefValue = "";
            $this->TREAT_DATE->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
            $this->CLASS_ROOM_ID->HrefValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->LinkCustomAttributes = "";
            $this->KELUAR_ID->HrefValue = "";

            // BED_ID
            $this->BED_ID->LinkCustomAttributes = "";
            $this->BED_ID->HrefValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";

            // NO_SURAT_KET
            $this->NO_SURAT_KET->LinkCustomAttributes = "";
            $this->NO_SURAT_KET->HrefValue = "";

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";
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
        if ($this->CLINIC_ID->Required) {
            if (!$this->CLINIC_ID->IsDetailKey && EmptyValue($this->CLINIC_ID->FormValue)) {
                $this->CLINIC_ID->addErrorMessage(str_replace("%s", $this->CLINIC_ID->caption(), $this->CLINIC_ID->RequiredErrorMessage));
            }
        }
        if ($this->TREATMENT->Required) {
            if (!$this->TREATMENT->IsDetailKey && EmptyValue($this->TREATMENT->FormValue)) {
                $this->TREATMENT->addErrorMessage(str_replace("%s", $this->TREATMENT->caption(), $this->TREATMENT->RequiredErrorMessage));
            }
        }
        if ($this->TREAT_DATE->Required) {
            if (!$this->TREAT_DATE->IsDetailKey && EmptyValue($this->TREAT_DATE->FormValue)) {
                $this->TREAT_DATE->addErrorMessage(str_replace("%s", $this->TREAT_DATE->caption(), $this->TREAT_DATE->RequiredErrorMessage));
            }
        }
        if ($this->DESCRIPTION->Required) {
            if (!$this->DESCRIPTION->IsDetailKey && EmptyValue($this->DESCRIPTION->FormValue)) {
                $this->DESCRIPTION->addErrorMessage(str_replace("%s", $this->DESCRIPTION->caption(), $this->DESCRIPTION->RequiredErrorMessage));
            }
        }
        if ($this->CLASS_ROOM_ID->Required) {
            if (!$this->CLASS_ROOM_ID->IsDetailKey && EmptyValue($this->CLASS_ROOM_ID->FormValue)) {
                $this->CLASS_ROOM_ID->addErrorMessage(str_replace("%s", $this->CLASS_ROOM_ID->caption(), $this->CLASS_ROOM_ID->RequiredErrorMessage));
            }
        }
        if ($this->KELUAR_ID->Required) {
            if (!$this->KELUAR_ID->IsDetailKey && EmptyValue($this->KELUAR_ID->FormValue)) {
                $this->KELUAR_ID->addErrorMessage(str_replace("%s", $this->KELUAR_ID->caption(), $this->KELUAR_ID->RequiredErrorMessage));
            }
        }
        if ($this->BED_ID->Required) {
            if (!$this->BED_ID->IsDetailKey && EmptyValue($this->BED_ID->FormValue)) {
                $this->BED_ID->addErrorMessage(str_replace("%s", $this->BED_ID->caption(), $this->BED_ID->RequiredErrorMessage));
            }
        }
        if ($this->EMPLOYEE_ID->Required) {
            if (!$this->EMPLOYEE_ID->IsDetailKey && EmptyValue($this->EMPLOYEE_ID->FormValue)) {
                $this->EMPLOYEE_ID->addErrorMessage(str_replace("%s", $this->EMPLOYEE_ID->caption(), $this->EMPLOYEE_ID->RequiredErrorMessage));
            }
        }
        if ($this->NO_SURAT_KET->Required) {
            if (!$this->NO_SURAT_KET->IsDetailKey && EmptyValue($this->NO_SURAT_KET->FormValue)) {
                $this->NO_SURAT_KET->addErrorMessage(str_replace("%s", $this->NO_SURAT_KET->caption(), $this->NO_SURAT_KET->RequiredErrorMessage));
            }
        }
        if ($this->ID->Required) {
            if (!$this->ID->IsDetailKey && EmptyValue($this->ID->FormValue)) {
                $this->ID->addErrorMessage(str_replace("%s", $this->ID->caption(), $this->ID->RequiredErrorMessage));
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

            // DESCRIPTION
            $this->DESCRIPTION->setDbValueDef($rsnew, $this->DESCRIPTION->CurrentValue, null, $this->DESCRIPTION->ReadOnly);

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->setDbValueDef($rsnew, $this->CLASS_ROOM_ID->CurrentValue, null, $this->CLASS_ROOM_ID->ReadOnly);

            // KELUAR_ID
            $this->KELUAR_ID->setDbValueDef($rsnew, $this->KELUAR_ID->CurrentValue, null, $this->KELUAR_ID->ReadOnly);

            // BED_ID
            $this->BED_ID->setDbValueDef($rsnew, $this->BED_ID->CurrentValue, null, $this->BED_ID->ReadOnly);

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->setDbValueDef($rsnew, $this->EMPLOYEE_ID->CurrentValue, null, $this->EMPLOYEE_ID->ReadOnly);

            // NO_SURAT_KET
            $this->NO_SURAT_KET->setDbValueDef($rsnew, $this->NO_SURAT_KET->CurrentValue, null, $this->NO_SURAT_KET->ReadOnly);

            // Check referential integrity for master table 'V_KASIR'
            $validMasterRecord = true;
            $masterFilter = $this->sqlMasterFilter_V_KASIR();
            $keyValue = $rsnew['VISIT_ID'] ?? $rsold['VISIT_ID'];
            if (strval($keyValue) != "") {
                $masterFilter = str_replace("@VISIT_ID@", AdjustSql($keyValue), $masterFilter);
            } else {
                $validMasterRecord = false;
            }
            if ($validMasterRecord) {
                $rsmaster = Container("V_KASIR")->loadRs($masterFilter)->fetch();
                $validMasterRecord = $rsmaster !== false;
            }
            if (!$validMasterRecord) {
                $relatedRecordMsg = str_replace("%t", "V_KASIR", $Language->phrase("RelatedRecordRequired"));
                $this->setFailureMessage($relatedRecordMsg);
                return false;
            }

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
        if ($this->getCurrentMasterTable() == "V_KASIR") {
            $this->VISIT_ID->CurrentValue = $this->VISIT_ID->getSessionValue();
        }
        if ($this->getCurrentMasterTable() == "TREATMENT_BILL") {
            $this->BILL_ID->CurrentValue = $this->BILL_ID->getSessionValue();
            $this->VISIT_ID->CurrentValue = $this->VISIT_ID->getSessionValue();
        }

        // Check referential integrity for master table 'TREATMENT_AKOMODASI'
        $validMasterRecord = true;
        $masterFilter = $this->sqlMasterFilter_V_KASIR();
        if ($this->VISIT_ID->getSessionValue() != "") {
        $masterFilter = str_replace("@VISIT_ID@", AdjustSql($this->VISIT_ID->getSessionValue(), "DB"), $masterFilter);
        } else {
            $validMasterRecord = false;
        }
        if ($validMasterRecord) {
            $rsmaster = Container("V_KASIR")->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "V_KASIR", $Language->phrase("RelatedRecordRequired"));
            $this->setFailureMessage($relatedRecordMsg);
            return false;
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // CLINIC_ID
        $this->CLINIC_ID->setDbValueDef($rsnew, $this->CLINIC_ID->CurrentValue, null, false);

        // TREATMENT
        $this->TREATMENT->setDbValueDef($rsnew, $this->TREATMENT->CurrentValue, null, false);

        // TREAT_DATE
        $this->TREAT_DATE->setDbValueDef($rsnew, UnFormatDateTime($this->TREAT_DATE->CurrentValue, 0), null, false);

        // DESCRIPTION
        $this->DESCRIPTION->setDbValueDef($rsnew, $this->DESCRIPTION->CurrentValue, null, false);

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->setDbValueDef($rsnew, $this->CLASS_ROOM_ID->CurrentValue, null, false);

        // KELUAR_ID
        $this->KELUAR_ID->setDbValueDef($rsnew, $this->KELUAR_ID->CurrentValue, null, false);

        // BED_ID
        $this->BED_ID->setDbValueDef($rsnew, $this->BED_ID->CurrentValue, null, false);

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->setDbValueDef($rsnew, $this->EMPLOYEE_ID->CurrentValue, null, false);

        // NO_SURAT_KET
        $this->NO_SURAT_KET->setDbValueDef($rsnew, $this->NO_SURAT_KET->CurrentValue, null, false);

        // BILL_ID
        if ($this->BILL_ID->getSessionValue() != "") {
            $rsnew['BILL_ID'] = $this->BILL_ID->getSessionValue();
        }

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
        if ($masterTblVar == "V_KASIR") {
            $masterTbl = Container("V_KASIR");
            $this->VISIT_ID->Visible = false;
            if ($masterTbl->EventCancelled) {
                $this->EventCancelled = true;
            }
        }
        if ($masterTblVar == "TREATMENT_BILL") {
            $masterTbl = Container("TREATMENT_BILL");
            $this->BILL_ID->Visible = false;
            if ($masterTbl->EventCancelled) {
                $this->EventCancelled = true;
            }
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
                case "x_TARIF_ID":
                    break;
                case "x_CLINIC_ID":
                    break;
                case "x_CLINIC_ID_FROM":
                    $lookupFilter = function () {
                        return "[STYPE_ID] = 0";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_CLASS_ROOM_ID":
                    break;
                case "x_KELUAR_ID":
                    break;
                case "x_BED_ID":
                    break;
                case "x_EMPLOYEE_ID":
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
