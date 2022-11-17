<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class VRawatInapList extends VRawatInap
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'V_RAWAT_INAP';

    // Page object name
    public $PageObjName = "VRawatInapList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fV_RAWAT_INAPlist";
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

    // Export URLs
    public $ExportPrintUrl;
    public $ExportHtmlUrl;
    public $ExportExcelUrl;
    public $ExportWordUrl;
    public $ExportXmlUrl;
    public $ExportCsvUrl;
    public $ExportPdfUrl;

    // Custom export
    public $ExportExcelCustom = false;
    public $ExportWordCustom = false;
    public $ExportPdfCustom = false;
    public $ExportEmailCustom = false;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

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

        // Table object (V_RAWAT_INAP)
        if (!isset($GLOBALS["V_RAWAT_INAP"]) || get_class($GLOBALS["V_RAWAT_INAP"]) == PROJECT_NAMESPACE . "V_RAWAT_INAP") {
            $GLOBALS["V_RAWAT_INAP"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Initialize URLs
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->AddUrl = "VRawatInapAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "VRawatInapDelete";
        $this->MultiUpdateUrl = "VRawatInapUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'V_RAWAT_INAP');
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

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Import options
        $this->ImportOptions = new ListOptions("div");
        $this->ImportOptions->TagClassName = "ew-import-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";

        // Filter options
        $this->FilterOptions = new ListOptions("div");
        $this->FilterOptions->TagClassName = "ew-filter-option fV_RAWAT_INAPlistsrch";

        // List actions
        $this->ListActions = new ListActions();
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
                $doc = new $class(Container("V_RAWAT_INAP"));
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
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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
            $key .= @$ar['BILL_ID'];
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
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->ORG_UNIT_CODE->Visible = false;
        $this->BILL_ID->Visible = false;
        $this->NO_REGISTRATION->setVisibility();
        $this->VISIT_ID->Visible = false;
        $this->THENAME->setVisibility();
        $this->THEADDRESS->setVisibility();
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

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Show checkbox column if multiple action
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
                $this->ListOptions["checkbox"]->Visible = true;
                break;
            }
        }

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
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

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

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }
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

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
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

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->ORG_UNIT_CODE->AdvancedSearch->toJson(), ","); // Field ORG_UNIT_CODE
        $filterList = Concat($filterList, $this->BILL_ID->AdvancedSearch->toJson(), ","); // Field BILL_ID
        $filterList = Concat($filterList, $this->NO_REGISTRATION->AdvancedSearch->toJson(), ","); // Field NO_REGISTRATION
        $filterList = Concat($filterList, $this->VISIT_ID->AdvancedSearch->toJson(), ","); // Field VISIT_ID
        $filterList = Concat($filterList, $this->THENAME->AdvancedSearch->toJson(), ","); // Field THENAME
        $filterList = Concat($filterList, $this->THEADDRESS->AdvancedSearch->toJson(), ","); // Field THEADDRESS
        $filterList = Concat($filterList, $this->TARIF_ID->AdvancedSearch->toJson(), ","); // Field TARIF_ID
        $filterList = Concat($filterList, $this->CLASS_ID->AdvancedSearch->toJson(), ","); // Field CLASS_ID
        $filterList = Concat($filterList, $this->CLINIC_ID->AdvancedSearch->toJson(), ","); // Field CLINIC_ID
        $filterList = Concat($filterList, $this->CLINIC_ID_FROM->AdvancedSearch->toJson(), ","); // Field CLINIC_ID_FROM
        $filterList = Concat($filterList, $this->TREATMENT->AdvancedSearch->toJson(), ","); // Field TREATMENT
        $filterList = Concat($filterList, $this->TREAT_DATE->AdvancedSearch->toJson(), ","); // Field TREAT_DATE
        $filterList = Concat($filterList, $this->QUANTITY->AdvancedSearch->toJson(), ","); // Field QUANTITY
        $filterList = Concat($filterList, $this->MEASURE_ID->AdvancedSearch->toJson(), ","); // Field MEASURE_ID
        $filterList = Concat($filterList, $this->DESCRIPTION->AdvancedSearch->toJson(), ","); // Field DESCRIPTION
        $filterList = Concat($filterList, $this->CLASS_ROOM_ID->AdvancedSearch->toJson(), ","); // Field CLASS_ROOM_ID
        $filterList = Concat($filterList, $this->KELUAR_ID->AdvancedSearch->toJson(), ","); // Field KELUAR_ID
        $filterList = Concat($filterList, $this->BED_ID->AdvancedSearch->toJson(), ","); // Field BED_ID
        $filterList = Concat($filterList, $this->EMPLOYEE_ID->AdvancedSearch->toJson(), ","); // Field EMPLOYEE_ID
        $filterList = Concat($filterList, $this->DOCTOR->AdvancedSearch->toJson(), ","); // Field DOCTOR
        $filterList = Concat($filterList, $this->EXIT_DATE->AdvancedSearch->toJson(), ","); // Field EXIT_DATE
        $filterList = Concat($filterList, $this->EMPLOYEE_ID_FROM->AdvancedSearch->toJson(), ","); // Field EMPLOYEE_ID_FROM
        $filterList = Concat($filterList, $this->DOCTOR_FROM->AdvancedSearch->toJson(), ","); // Field DOCTOR_FROM
        $filterList = Concat($filterList, $this->STATUS_PASIEN_ID->AdvancedSearch->toJson(), ","); // Field STATUS_PASIEN_ID
        $filterList = Concat($filterList, $this->DIAGNOSA_ID->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID
        $filterList = Concat($filterList, $this->THEID->AdvancedSearch->toJson(), ","); // Field THEID
        $filterList = Concat($filterList, $this->ISRJ->AdvancedSearch->toJson(), ","); // Field ISRJ
        $filterList = Concat($filterList, $this->AGEYEAR->AdvancedSearch->toJson(), ","); // Field AGEYEAR
        $filterList = Concat($filterList, $this->AGEMONTH->AdvancedSearch->toJson(), ","); // Field AGEMONTH
        $filterList = Concat($filterList, $this->AGEDAY->AdvancedSearch->toJson(), ","); // Field AGEDAY
        $filterList = Concat($filterList, $this->GENDER->AdvancedSearch->toJson(), ","); // Field GENDER
        $filterList = Concat($filterList, $this->KARYAWAN->AdvancedSearch->toJson(), ","); // Field KARYAWAN
        $filterList = Concat($filterList, $this->MODIFIED_BY->AdvancedSearch->toJson(), ","); // Field MODIFIED_BY
        $filterList = Concat($filterList, $this->MODIFIED_DATE->AdvancedSearch->toJson(), ","); // Field MODIFIED_DATE
        $filterList = Concat($filterList, $this->MODIFIED_FROM->AdvancedSearch->toJson(), ","); // Field MODIFIED_FROM
        $filterList = Concat($filterList, $this->POTONGAN->AdvancedSearch->toJson(), ","); // Field POTONGAN
        $filterList = Concat($filterList, $this->BAYAR->AdvancedSearch->toJson(), ","); // Field BAYAR
        $filterList = Concat($filterList, $this->RETUR->AdvancedSearch->toJson(), ","); // Field RETUR
        $filterList = Concat($filterList, $this->TARIF_TYPE->AdvancedSearch->toJson(), ","); // Field TARIF_TYPE
        $filterList = Concat($filterList, $this->PPNVALUE->AdvancedSearch->toJson(), ","); // Field PPNVALUE
        $filterList = Concat($filterList, $this->TAGIHAN->AdvancedSearch->toJson(), ","); // Field TAGIHAN
        $filterList = Concat($filterList, $this->KOREKSI->AdvancedSearch->toJson(), ","); // Field KOREKSI
        $filterList = Concat($filterList, $this->AMOUNT_PAID->AdvancedSearch->toJson(), ","); // Field AMOUNT_PAID
        $filterList = Concat($filterList, $this->DISKON->AdvancedSearch->toJson(), ","); // Field DISKON
        $filterList = Concat($filterList, $this->NOTA_NO->AdvancedSearch->toJson(), ","); // Field NOTA_NO
        $filterList = Concat($filterList, $this->SELL_PRICE->AdvancedSearch->toJson(), ","); // Field SELL_PRICE
        $filterList = Concat($filterList, $this->ACCOUNT_ID->AdvancedSearch->toJson(), ","); // Field ACCOUNT_ID
        $filterList = Concat($filterList, $this->subsidi->AdvancedSearch->toJson(), ","); // Field subsidi
        $filterList = Concat($filterList, $this->DISCOUNT->AdvancedSearch->toJson(), ","); // Field DISCOUNT
        $filterList = Concat($filterList, $this->AMOUNT->AdvancedSearch->toJson(), ","); // Field AMOUNT
        $filterList = Concat($filterList, $this->PPN->AdvancedSearch->toJson(), ","); // Field PPN
        $filterList = Concat($filterList, $this->SUBSIDISAT->AdvancedSearch->toJson(), ","); // Field SUBSIDISAT
        $filterList = Concat($filterList, $this->PRINTQ->AdvancedSearch->toJson(), ","); // Field PRINTQ
        $filterList = Concat($filterList, $this->PRINTED_BY->AdvancedSearch->toJson(), ","); // Field PRINTED_BY
        $filterList = Concat($filterList, $this->STATUS_TARIF->AdvancedSearch->toJson(), ","); // Field STATUS_TARIF
        $filterList = Concat($filterList, $this->CLINIC_TYPE->AdvancedSearch->toJson(), ","); // Field CLINIC_TYPE
        $filterList = Concat($filterList, $this->PACKAGE_ID->AdvancedSearch->toJson(), ","); // Field PACKAGE_ID
        $filterList = Concat($filterList, $this->MODULE_ID->AdvancedSearch->toJson(), ","); // Field MODULE_ID
        $filterList = Concat($filterList, $this->THEORDER->AdvancedSearch->toJson(), ","); // Field THEORDER
        $filterList = Concat($filterList, $this->CORRECTION_ID->AdvancedSearch->toJson(), ","); // Field CORRECTION_ID
        $filterList = Concat($filterList, $this->CORRECTION_BY->AdvancedSearch->toJson(), ","); // Field CORRECTION_BY
        $filterList = Concat($filterList, $this->CASHIER->AdvancedSearch->toJson(), ","); // Field CASHIER
        $filterList = Concat($filterList, $this->PAYOR_ID->AdvancedSearch->toJson(), ","); // Field PAYOR_ID
        $filterList = Concat($filterList, $this->KAL_ID->AdvancedSearch->toJson(), ","); // Field KAL_ID
        $filterList = Concat($filterList, $this->NO_SKPINAP->AdvancedSearch->toJson(), ","); // Field NO_SKPINAP
        $filterList = Concat($filterList, $this->RESPON->AdvancedSearch->toJson(), ","); // Field RESPON
        $filterList = Concat($filterList, $this->NOKARTU->AdvancedSearch->toJson(), ","); // Field NOKARTU
        $filterList = Concat($filterList, $this->PASIEN_ID->AdvancedSearch->toJson(), ","); // Field PASIEN_ID
        $filterList = Concat($filterList, $this->modified_datesys->AdvancedSearch->toJson(), ","); // Field modified_datesys
        $filterList = Concat($filterList, $this->MAPPING_SEP->AdvancedSearch->toJson(), ","); // Field MAPPING_SEP
        $filterList = Concat($filterList, $this->TRANS_ID->AdvancedSearch->toJson(), ","); // Field TRANS_ID
        $filterList = Concat($filterList, $this->SPPBILL->AdvancedSearch->toJson(), ","); // Field SPPBILL
        $filterList = Concat($filterList, $this->SPPBILLDATE->AdvancedSearch->toJson(), ","); // Field SPPBILLDATE
        $filterList = Concat($filterList, $this->SPPBILLUSER->AdvancedSearch->toJson(), ","); // Field SPPBILLUSER
        $filterList = Concat($filterList, $this->SPPKASIR->AdvancedSearch->toJson(), ","); // Field SPPKASIR
        $filterList = Concat($filterList, $this->SPPKASIRDATE->AdvancedSearch->toJson(), ","); // Field SPPKASIRDATE
        $filterList = Concat($filterList, $this->SPPKASIRUSER->AdvancedSearch->toJson(), ","); // Field SPPKASIRUSER
        $filterList = Concat($filterList, $this->SPPPOLI->AdvancedSearch->toJson(), ","); // Field SPPPOLI
        $filterList = Concat($filterList, $this->SPPPOLIUSER->AdvancedSearch->toJson(), ","); // Field SPPPOLIUSER
        $filterList = Concat($filterList, $this->SPPPOLIDATE->AdvancedSearch->toJson(), ","); // Field SPPPOLIDATE
        $filterList = Concat($filterList, $this->NO_SURAT_KET->AdvancedSearch->toJson(), ","); // Field NO_SURAT_KET
        $filterList = Concat($filterList, $this->ID->AdvancedSearch->toJson(), ","); // Field ID
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fV_RAWAT_INAPlistsrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchValue = @$filter["x_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchOperator = @$filter["z_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchCondition = @$filter["v_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchValue2 = @$filter["y_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchOperator2 = @$filter["w_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->save();

        // Field BILL_ID
        $this->BILL_ID->AdvancedSearch->SearchValue = @$filter["x_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->SearchOperator = @$filter["z_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->SearchCondition = @$filter["v_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->SearchValue2 = @$filter["y_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->SearchOperator2 = @$filter["w_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->save();

        // Field NO_REGISTRATION
        $this->NO_REGISTRATION->AdvancedSearch->SearchValue = @$filter["x_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchOperator = @$filter["z_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchCondition = @$filter["v_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchValue2 = @$filter["y_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchOperator2 = @$filter["w_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->save();

        // Field VISIT_ID
        $this->VISIT_ID->AdvancedSearch->SearchValue = @$filter["x_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->SearchOperator = @$filter["z_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->SearchCondition = @$filter["v_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->SearchValue2 = @$filter["y_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->SearchOperator2 = @$filter["w_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->save();

        // Field THENAME
        $this->THENAME->AdvancedSearch->SearchValue = @$filter["x_THENAME"];
        $this->THENAME->AdvancedSearch->SearchOperator = @$filter["z_THENAME"];
        $this->THENAME->AdvancedSearch->SearchCondition = @$filter["v_THENAME"];
        $this->THENAME->AdvancedSearch->SearchValue2 = @$filter["y_THENAME"];
        $this->THENAME->AdvancedSearch->SearchOperator2 = @$filter["w_THENAME"];
        $this->THENAME->AdvancedSearch->save();

        // Field THEADDRESS
        $this->THEADDRESS->AdvancedSearch->SearchValue = @$filter["x_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->SearchOperator = @$filter["z_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->SearchCondition = @$filter["v_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->SearchValue2 = @$filter["y_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->SearchOperator2 = @$filter["w_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->save();

        // Field TARIF_ID
        $this->TARIF_ID->AdvancedSearch->SearchValue = @$filter["x_TARIF_ID"];
        $this->TARIF_ID->AdvancedSearch->SearchOperator = @$filter["z_TARIF_ID"];
        $this->TARIF_ID->AdvancedSearch->SearchCondition = @$filter["v_TARIF_ID"];
        $this->TARIF_ID->AdvancedSearch->SearchValue2 = @$filter["y_TARIF_ID"];
        $this->TARIF_ID->AdvancedSearch->SearchOperator2 = @$filter["w_TARIF_ID"];
        $this->TARIF_ID->AdvancedSearch->save();

        // Field CLASS_ID
        $this->CLASS_ID->AdvancedSearch->SearchValue = @$filter["x_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->SearchOperator = @$filter["z_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->SearchCondition = @$filter["v_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->SearchValue2 = @$filter["y_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->save();

        // Field CLINIC_ID
        $this->CLINIC_ID->AdvancedSearch->SearchValue = @$filter["x_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchOperator = @$filter["z_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchCondition = @$filter["v_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchValue2 = @$filter["y_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->save();

        // Field CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->AdvancedSearch->SearchValue = @$filter["x_CLINIC_ID_FROM"];
        $this->CLINIC_ID_FROM->AdvancedSearch->SearchOperator = @$filter["z_CLINIC_ID_FROM"];
        $this->CLINIC_ID_FROM->AdvancedSearch->SearchCondition = @$filter["v_CLINIC_ID_FROM"];
        $this->CLINIC_ID_FROM->AdvancedSearch->SearchValue2 = @$filter["y_CLINIC_ID_FROM"];
        $this->CLINIC_ID_FROM->AdvancedSearch->SearchOperator2 = @$filter["w_CLINIC_ID_FROM"];
        $this->CLINIC_ID_FROM->AdvancedSearch->save();

        // Field TREATMENT
        $this->TREATMENT->AdvancedSearch->SearchValue = @$filter["x_TREATMENT"];
        $this->TREATMENT->AdvancedSearch->SearchOperator = @$filter["z_TREATMENT"];
        $this->TREATMENT->AdvancedSearch->SearchCondition = @$filter["v_TREATMENT"];
        $this->TREATMENT->AdvancedSearch->SearchValue2 = @$filter["y_TREATMENT"];
        $this->TREATMENT->AdvancedSearch->SearchOperator2 = @$filter["w_TREATMENT"];
        $this->TREATMENT->AdvancedSearch->save();

        // Field TREAT_DATE
        $this->TREAT_DATE->AdvancedSearch->SearchValue = @$filter["x_TREAT_DATE"];
        $this->TREAT_DATE->AdvancedSearch->SearchOperator = @$filter["z_TREAT_DATE"];
        $this->TREAT_DATE->AdvancedSearch->SearchCondition = @$filter["v_TREAT_DATE"];
        $this->TREAT_DATE->AdvancedSearch->SearchValue2 = @$filter["y_TREAT_DATE"];
        $this->TREAT_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_TREAT_DATE"];
        $this->TREAT_DATE->AdvancedSearch->save();

        // Field QUANTITY
        $this->QUANTITY->AdvancedSearch->SearchValue = @$filter["x_QUANTITY"];
        $this->QUANTITY->AdvancedSearch->SearchOperator = @$filter["z_QUANTITY"];
        $this->QUANTITY->AdvancedSearch->SearchCondition = @$filter["v_QUANTITY"];
        $this->QUANTITY->AdvancedSearch->SearchValue2 = @$filter["y_QUANTITY"];
        $this->QUANTITY->AdvancedSearch->SearchOperator2 = @$filter["w_QUANTITY"];
        $this->QUANTITY->AdvancedSearch->save();

        // Field MEASURE_ID
        $this->MEASURE_ID->AdvancedSearch->SearchValue = @$filter["x_MEASURE_ID"];
        $this->MEASURE_ID->AdvancedSearch->SearchOperator = @$filter["z_MEASURE_ID"];
        $this->MEASURE_ID->AdvancedSearch->SearchCondition = @$filter["v_MEASURE_ID"];
        $this->MEASURE_ID->AdvancedSearch->SearchValue2 = @$filter["y_MEASURE_ID"];
        $this->MEASURE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_MEASURE_ID"];
        $this->MEASURE_ID->AdvancedSearch->save();

        // Field DESCRIPTION
        $this->DESCRIPTION->AdvancedSearch->SearchValue = @$filter["x_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchOperator = @$filter["z_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchCondition = @$filter["v_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchValue2 = @$filter["y_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchOperator2 = @$filter["w_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->save();

        // Field CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue = @$filter["x_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchOperator = @$filter["z_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchCondition = @$filter["v_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue2 = @$filter["y_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->save();

        // Field KELUAR_ID
        $this->KELUAR_ID->AdvancedSearch->SearchValue = @$filter["x_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->SearchOperator = @$filter["z_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->SearchCondition = @$filter["v_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->SearchValue2 = @$filter["y_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->SearchOperator2 = @$filter["w_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->save();

        // Field BED_ID
        $this->BED_ID->AdvancedSearch->SearchValue = @$filter["x_BED_ID"];
        $this->BED_ID->AdvancedSearch->SearchOperator = @$filter["z_BED_ID"];
        $this->BED_ID->AdvancedSearch->SearchCondition = @$filter["v_BED_ID"];
        $this->BED_ID->AdvancedSearch->SearchValue2 = @$filter["y_BED_ID"];
        $this->BED_ID->AdvancedSearch->SearchOperator2 = @$filter["w_BED_ID"];
        $this->BED_ID->AdvancedSearch->save();

        // Field EMPLOYEE_ID
        $this->EMPLOYEE_ID->AdvancedSearch->SearchValue = @$filter["x_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchOperator = @$filter["z_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchCondition = @$filter["v_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchValue2 = @$filter["y_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->save();

        // Field DOCTOR
        $this->DOCTOR->AdvancedSearch->SearchValue = @$filter["x_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->SearchOperator = @$filter["z_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->SearchCondition = @$filter["v_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->SearchValue2 = @$filter["y_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->SearchOperator2 = @$filter["w_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->save();

        // Field EXIT_DATE
        $this->EXIT_DATE->AdvancedSearch->SearchValue = @$filter["x_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->SearchOperator = @$filter["z_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->SearchCondition = @$filter["v_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->SearchValue2 = @$filter["y_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->save();

        // Field EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->AdvancedSearch->SearchValue = @$filter["x_EMPLOYEE_ID_FROM"];
        $this->EMPLOYEE_ID_FROM->AdvancedSearch->SearchOperator = @$filter["z_EMPLOYEE_ID_FROM"];
        $this->EMPLOYEE_ID_FROM->AdvancedSearch->SearchCondition = @$filter["v_EMPLOYEE_ID_FROM"];
        $this->EMPLOYEE_ID_FROM->AdvancedSearch->SearchValue2 = @$filter["y_EMPLOYEE_ID_FROM"];
        $this->EMPLOYEE_ID_FROM->AdvancedSearch->SearchOperator2 = @$filter["w_EMPLOYEE_ID_FROM"];
        $this->EMPLOYEE_ID_FROM->AdvancedSearch->save();

        // Field DOCTOR_FROM
        $this->DOCTOR_FROM->AdvancedSearch->SearchValue = @$filter["x_DOCTOR_FROM"];
        $this->DOCTOR_FROM->AdvancedSearch->SearchOperator = @$filter["z_DOCTOR_FROM"];
        $this->DOCTOR_FROM->AdvancedSearch->SearchCondition = @$filter["v_DOCTOR_FROM"];
        $this->DOCTOR_FROM->AdvancedSearch->SearchValue2 = @$filter["y_DOCTOR_FROM"];
        $this->DOCTOR_FROM->AdvancedSearch->SearchOperator2 = @$filter["w_DOCTOR_FROM"];
        $this->DOCTOR_FROM->AdvancedSearch->save();

        // Field STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue = @$filter["x_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchOperator = @$filter["z_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchCondition = @$filter["v_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue2 = @$filter["y_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchOperator2 = @$filter["w_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->save();

        // Field DIAGNOSA_ID
        $this->DIAGNOSA_ID->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->save();

        // Field THEID
        $this->THEID->AdvancedSearch->SearchValue = @$filter["x_THEID"];
        $this->THEID->AdvancedSearch->SearchOperator = @$filter["z_THEID"];
        $this->THEID->AdvancedSearch->SearchCondition = @$filter["v_THEID"];
        $this->THEID->AdvancedSearch->SearchValue2 = @$filter["y_THEID"];
        $this->THEID->AdvancedSearch->SearchOperator2 = @$filter["w_THEID"];
        $this->THEID->AdvancedSearch->save();

        // Field ISRJ
        $this->ISRJ->AdvancedSearch->SearchValue = @$filter["x_ISRJ"];
        $this->ISRJ->AdvancedSearch->SearchOperator = @$filter["z_ISRJ"];
        $this->ISRJ->AdvancedSearch->SearchCondition = @$filter["v_ISRJ"];
        $this->ISRJ->AdvancedSearch->SearchValue2 = @$filter["y_ISRJ"];
        $this->ISRJ->AdvancedSearch->SearchOperator2 = @$filter["w_ISRJ"];
        $this->ISRJ->AdvancedSearch->save();

        // Field AGEYEAR
        $this->AGEYEAR->AdvancedSearch->SearchValue = @$filter["x_AGEYEAR"];
        $this->AGEYEAR->AdvancedSearch->SearchOperator = @$filter["z_AGEYEAR"];
        $this->AGEYEAR->AdvancedSearch->SearchCondition = @$filter["v_AGEYEAR"];
        $this->AGEYEAR->AdvancedSearch->SearchValue2 = @$filter["y_AGEYEAR"];
        $this->AGEYEAR->AdvancedSearch->SearchOperator2 = @$filter["w_AGEYEAR"];
        $this->AGEYEAR->AdvancedSearch->save();

        // Field AGEMONTH
        $this->AGEMONTH->AdvancedSearch->SearchValue = @$filter["x_AGEMONTH"];
        $this->AGEMONTH->AdvancedSearch->SearchOperator = @$filter["z_AGEMONTH"];
        $this->AGEMONTH->AdvancedSearch->SearchCondition = @$filter["v_AGEMONTH"];
        $this->AGEMONTH->AdvancedSearch->SearchValue2 = @$filter["y_AGEMONTH"];
        $this->AGEMONTH->AdvancedSearch->SearchOperator2 = @$filter["w_AGEMONTH"];
        $this->AGEMONTH->AdvancedSearch->save();

        // Field AGEDAY
        $this->AGEDAY->AdvancedSearch->SearchValue = @$filter["x_AGEDAY"];
        $this->AGEDAY->AdvancedSearch->SearchOperator = @$filter["z_AGEDAY"];
        $this->AGEDAY->AdvancedSearch->SearchCondition = @$filter["v_AGEDAY"];
        $this->AGEDAY->AdvancedSearch->SearchValue2 = @$filter["y_AGEDAY"];
        $this->AGEDAY->AdvancedSearch->SearchOperator2 = @$filter["w_AGEDAY"];
        $this->AGEDAY->AdvancedSearch->save();

        // Field GENDER
        $this->GENDER->AdvancedSearch->SearchValue = @$filter["x_GENDER"];
        $this->GENDER->AdvancedSearch->SearchOperator = @$filter["z_GENDER"];
        $this->GENDER->AdvancedSearch->SearchCondition = @$filter["v_GENDER"];
        $this->GENDER->AdvancedSearch->SearchValue2 = @$filter["y_GENDER"];
        $this->GENDER->AdvancedSearch->SearchOperator2 = @$filter["w_GENDER"];
        $this->GENDER->AdvancedSearch->save();

        // Field KARYAWAN
        $this->KARYAWAN->AdvancedSearch->SearchValue = @$filter["x_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->SearchOperator = @$filter["z_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->SearchCondition = @$filter["v_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->SearchValue2 = @$filter["y_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->SearchOperator2 = @$filter["w_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->save();

        // Field MODIFIED_BY
        $this->MODIFIED_BY->AdvancedSearch->SearchValue = @$filter["x_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->SearchOperator = @$filter["z_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->SearchCondition = @$filter["v_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->SearchValue2 = @$filter["y_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->SearchOperator2 = @$filter["w_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->save();

        // Field MODIFIED_DATE
        $this->MODIFIED_DATE->AdvancedSearch->SearchValue = @$filter["x_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->SearchOperator = @$filter["z_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->SearchCondition = @$filter["v_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->SearchValue2 = @$filter["y_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->save();

        // Field MODIFIED_FROM
        $this->MODIFIED_FROM->AdvancedSearch->SearchValue = @$filter["x_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->SearchOperator = @$filter["z_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->SearchCondition = @$filter["v_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->SearchValue2 = @$filter["y_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->SearchOperator2 = @$filter["w_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->save();

        // Field POTONGAN
        $this->POTONGAN->AdvancedSearch->SearchValue = @$filter["x_POTONGAN"];
        $this->POTONGAN->AdvancedSearch->SearchOperator = @$filter["z_POTONGAN"];
        $this->POTONGAN->AdvancedSearch->SearchCondition = @$filter["v_POTONGAN"];
        $this->POTONGAN->AdvancedSearch->SearchValue2 = @$filter["y_POTONGAN"];
        $this->POTONGAN->AdvancedSearch->SearchOperator2 = @$filter["w_POTONGAN"];
        $this->POTONGAN->AdvancedSearch->save();

        // Field BAYAR
        $this->BAYAR->AdvancedSearch->SearchValue = @$filter["x_BAYAR"];
        $this->BAYAR->AdvancedSearch->SearchOperator = @$filter["z_BAYAR"];
        $this->BAYAR->AdvancedSearch->SearchCondition = @$filter["v_BAYAR"];
        $this->BAYAR->AdvancedSearch->SearchValue2 = @$filter["y_BAYAR"];
        $this->BAYAR->AdvancedSearch->SearchOperator2 = @$filter["w_BAYAR"];
        $this->BAYAR->AdvancedSearch->save();

        // Field RETUR
        $this->RETUR->AdvancedSearch->SearchValue = @$filter["x_RETUR"];
        $this->RETUR->AdvancedSearch->SearchOperator = @$filter["z_RETUR"];
        $this->RETUR->AdvancedSearch->SearchCondition = @$filter["v_RETUR"];
        $this->RETUR->AdvancedSearch->SearchValue2 = @$filter["y_RETUR"];
        $this->RETUR->AdvancedSearch->SearchOperator2 = @$filter["w_RETUR"];
        $this->RETUR->AdvancedSearch->save();

        // Field TARIF_TYPE
        $this->TARIF_TYPE->AdvancedSearch->SearchValue = @$filter["x_TARIF_TYPE"];
        $this->TARIF_TYPE->AdvancedSearch->SearchOperator = @$filter["z_TARIF_TYPE"];
        $this->TARIF_TYPE->AdvancedSearch->SearchCondition = @$filter["v_TARIF_TYPE"];
        $this->TARIF_TYPE->AdvancedSearch->SearchValue2 = @$filter["y_TARIF_TYPE"];
        $this->TARIF_TYPE->AdvancedSearch->SearchOperator2 = @$filter["w_TARIF_TYPE"];
        $this->TARIF_TYPE->AdvancedSearch->save();

        // Field PPNVALUE
        $this->PPNVALUE->AdvancedSearch->SearchValue = @$filter["x_PPNVALUE"];
        $this->PPNVALUE->AdvancedSearch->SearchOperator = @$filter["z_PPNVALUE"];
        $this->PPNVALUE->AdvancedSearch->SearchCondition = @$filter["v_PPNVALUE"];
        $this->PPNVALUE->AdvancedSearch->SearchValue2 = @$filter["y_PPNVALUE"];
        $this->PPNVALUE->AdvancedSearch->SearchOperator2 = @$filter["w_PPNVALUE"];
        $this->PPNVALUE->AdvancedSearch->save();

        // Field TAGIHAN
        $this->TAGIHAN->AdvancedSearch->SearchValue = @$filter["x_TAGIHAN"];
        $this->TAGIHAN->AdvancedSearch->SearchOperator = @$filter["z_TAGIHAN"];
        $this->TAGIHAN->AdvancedSearch->SearchCondition = @$filter["v_TAGIHAN"];
        $this->TAGIHAN->AdvancedSearch->SearchValue2 = @$filter["y_TAGIHAN"];
        $this->TAGIHAN->AdvancedSearch->SearchOperator2 = @$filter["w_TAGIHAN"];
        $this->TAGIHAN->AdvancedSearch->save();

        // Field KOREKSI
        $this->KOREKSI->AdvancedSearch->SearchValue = @$filter["x_KOREKSI"];
        $this->KOREKSI->AdvancedSearch->SearchOperator = @$filter["z_KOREKSI"];
        $this->KOREKSI->AdvancedSearch->SearchCondition = @$filter["v_KOREKSI"];
        $this->KOREKSI->AdvancedSearch->SearchValue2 = @$filter["y_KOREKSI"];
        $this->KOREKSI->AdvancedSearch->SearchOperator2 = @$filter["w_KOREKSI"];
        $this->KOREKSI->AdvancedSearch->save();

        // Field AMOUNT_PAID
        $this->AMOUNT_PAID->AdvancedSearch->SearchValue = @$filter["x_AMOUNT_PAID"];
        $this->AMOUNT_PAID->AdvancedSearch->SearchOperator = @$filter["z_AMOUNT_PAID"];
        $this->AMOUNT_PAID->AdvancedSearch->SearchCondition = @$filter["v_AMOUNT_PAID"];
        $this->AMOUNT_PAID->AdvancedSearch->SearchValue2 = @$filter["y_AMOUNT_PAID"];
        $this->AMOUNT_PAID->AdvancedSearch->SearchOperator2 = @$filter["w_AMOUNT_PAID"];
        $this->AMOUNT_PAID->AdvancedSearch->save();

        // Field DISKON
        $this->DISKON->AdvancedSearch->SearchValue = @$filter["x_DISKON"];
        $this->DISKON->AdvancedSearch->SearchOperator = @$filter["z_DISKON"];
        $this->DISKON->AdvancedSearch->SearchCondition = @$filter["v_DISKON"];
        $this->DISKON->AdvancedSearch->SearchValue2 = @$filter["y_DISKON"];
        $this->DISKON->AdvancedSearch->SearchOperator2 = @$filter["w_DISKON"];
        $this->DISKON->AdvancedSearch->save();

        // Field NOTA_NO
        $this->NOTA_NO->AdvancedSearch->SearchValue = @$filter["x_NOTA_NO"];
        $this->NOTA_NO->AdvancedSearch->SearchOperator = @$filter["z_NOTA_NO"];
        $this->NOTA_NO->AdvancedSearch->SearchCondition = @$filter["v_NOTA_NO"];
        $this->NOTA_NO->AdvancedSearch->SearchValue2 = @$filter["y_NOTA_NO"];
        $this->NOTA_NO->AdvancedSearch->SearchOperator2 = @$filter["w_NOTA_NO"];
        $this->NOTA_NO->AdvancedSearch->save();

        // Field SELL_PRICE
        $this->SELL_PRICE->AdvancedSearch->SearchValue = @$filter["x_SELL_PRICE"];
        $this->SELL_PRICE->AdvancedSearch->SearchOperator = @$filter["z_SELL_PRICE"];
        $this->SELL_PRICE->AdvancedSearch->SearchCondition = @$filter["v_SELL_PRICE"];
        $this->SELL_PRICE->AdvancedSearch->SearchValue2 = @$filter["y_SELL_PRICE"];
        $this->SELL_PRICE->AdvancedSearch->SearchOperator2 = @$filter["w_SELL_PRICE"];
        $this->SELL_PRICE->AdvancedSearch->save();

        // Field ACCOUNT_ID
        $this->ACCOUNT_ID->AdvancedSearch->SearchValue = @$filter["x_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchOperator = @$filter["z_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchCondition = @$filter["v_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchValue2 = @$filter["y_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchOperator2 = @$filter["w_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->save();

        // Field subsidi
        $this->subsidi->AdvancedSearch->SearchValue = @$filter["x_subsidi"];
        $this->subsidi->AdvancedSearch->SearchOperator = @$filter["z_subsidi"];
        $this->subsidi->AdvancedSearch->SearchCondition = @$filter["v_subsidi"];
        $this->subsidi->AdvancedSearch->SearchValue2 = @$filter["y_subsidi"];
        $this->subsidi->AdvancedSearch->SearchOperator2 = @$filter["w_subsidi"];
        $this->subsidi->AdvancedSearch->save();

        // Field DISCOUNT
        $this->DISCOUNT->AdvancedSearch->SearchValue = @$filter["x_DISCOUNT"];
        $this->DISCOUNT->AdvancedSearch->SearchOperator = @$filter["z_DISCOUNT"];
        $this->DISCOUNT->AdvancedSearch->SearchCondition = @$filter["v_DISCOUNT"];
        $this->DISCOUNT->AdvancedSearch->SearchValue2 = @$filter["y_DISCOUNT"];
        $this->DISCOUNT->AdvancedSearch->SearchOperator2 = @$filter["w_DISCOUNT"];
        $this->DISCOUNT->AdvancedSearch->save();

        // Field AMOUNT
        $this->AMOUNT->AdvancedSearch->SearchValue = @$filter["x_AMOUNT"];
        $this->AMOUNT->AdvancedSearch->SearchOperator = @$filter["z_AMOUNT"];
        $this->AMOUNT->AdvancedSearch->SearchCondition = @$filter["v_AMOUNT"];
        $this->AMOUNT->AdvancedSearch->SearchValue2 = @$filter["y_AMOUNT"];
        $this->AMOUNT->AdvancedSearch->SearchOperator2 = @$filter["w_AMOUNT"];
        $this->AMOUNT->AdvancedSearch->save();

        // Field PPN
        $this->PPN->AdvancedSearch->SearchValue = @$filter["x_PPN"];
        $this->PPN->AdvancedSearch->SearchOperator = @$filter["z_PPN"];
        $this->PPN->AdvancedSearch->SearchCondition = @$filter["v_PPN"];
        $this->PPN->AdvancedSearch->SearchValue2 = @$filter["y_PPN"];
        $this->PPN->AdvancedSearch->SearchOperator2 = @$filter["w_PPN"];
        $this->PPN->AdvancedSearch->save();

        // Field SUBSIDISAT
        $this->SUBSIDISAT->AdvancedSearch->SearchValue = @$filter["x_SUBSIDISAT"];
        $this->SUBSIDISAT->AdvancedSearch->SearchOperator = @$filter["z_SUBSIDISAT"];
        $this->SUBSIDISAT->AdvancedSearch->SearchCondition = @$filter["v_SUBSIDISAT"];
        $this->SUBSIDISAT->AdvancedSearch->SearchValue2 = @$filter["y_SUBSIDISAT"];
        $this->SUBSIDISAT->AdvancedSearch->SearchOperator2 = @$filter["w_SUBSIDISAT"];
        $this->SUBSIDISAT->AdvancedSearch->save();

        // Field PRINTQ
        $this->PRINTQ->AdvancedSearch->SearchValue = @$filter["x_PRINTQ"];
        $this->PRINTQ->AdvancedSearch->SearchOperator = @$filter["z_PRINTQ"];
        $this->PRINTQ->AdvancedSearch->SearchCondition = @$filter["v_PRINTQ"];
        $this->PRINTQ->AdvancedSearch->SearchValue2 = @$filter["y_PRINTQ"];
        $this->PRINTQ->AdvancedSearch->SearchOperator2 = @$filter["w_PRINTQ"];
        $this->PRINTQ->AdvancedSearch->save();

        // Field PRINTED_BY
        $this->PRINTED_BY->AdvancedSearch->SearchValue = @$filter["x_PRINTED_BY"];
        $this->PRINTED_BY->AdvancedSearch->SearchOperator = @$filter["z_PRINTED_BY"];
        $this->PRINTED_BY->AdvancedSearch->SearchCondition = @$filter["v_PRINTED_BY"];
        $this->PRINTED_BY->AdvancedSearch->SearchValue2 = @$filter["y_PRINTED_BY"];
        $this->PRINTED_BY->AdvancedSearch->SearchOperator2 = @$filter["w_PRINTED_BY"];
        $this->PRINTED_BY->AdvancedSearch->save();

        // Field STATUS_TARIF
        $this->STATUS_TARIF->AdvancedSearch->SearchValue = @$filter["x_STATUS_TARIF"];
        $this->STATUS_TARIF->AdvancedSearch->SearchOperator = @$filter["z_STATUS_TARIF"];
        $this->STATUS_TARIF->AdvancedSearch->SearchCondition = @$filter["v_STATUS_TARIF"];
        $this->STATUS_TARIF->AdvancedSearch->SearchValue2 = @$filter["y_STATUS_TARIF"];
        $this->STATUS_TARIF->AdvancedSearch->SearchOperator2 = @$filter["w_STATUS_TARIF"];
        $this->STATUS_TARIF->AdvancedSearch->save();

        // Field CLINIC_TYPE
        $this->CLINIC_TYPE->AdvancedSearch->SearchValue = @$filter["x_CLINIC_TYPE"];
        $this->CLINIC_TYPE->AdvancedSearch->SearchOperator = @$filter["z_CLINIC_TYPE"];
        $this->CLINIC_TYPE->AdvancedSearch->SearchCondition = @$filter["v_CLINIC_TYPE"];
        $this->CLINIC_TYPE->AdvancedSearch->SearchValue2 = @$filter["y_CLINIC_TYPE"];
        $this->CLINIC_TYPE->AdvancedSearch->SearchOperator2 = @$filter["w_CLINIC_TYPE"];
        $this->CLINIC_TYPE->AdvancedSearch->save();

        // Field PACKAGE_ID
        $this->PACKAGE_ID->AdvancedSearch->SearchValue = @$filter["x_PACKAGE_ID"];
        $this->PACKAGE_ID->AdvancedSearch->SearchOperator = @$filter["z_PACKAGE_ID"];
        $this->PACKAGE_ID->AdvancedSearch->SearchCondition = @$filter["v_PACKAGE_ID"];
        $this->PACKAGE_ID->AdvancedSearch->SearchValue2 = @$filter["y_PACKAGE_ID"];
        $this->PACKAGE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_PACKAGE_ID"];
        $this->PACKAGE_ID->AdvancedSearch->save();

        // Field MODULE_ID
        $this->MODULE_ID->AdvancedSearch->SearchValue = @$filter["x_MODULE_ID"];
        $this->MODULE_ID->AdvancedSearch->SearchOperator = @$filter["z_MODULE_ID"];
        $this->MODULE_ID->AdvancedSearch->SearchCondition = @$filter["v_MODULE_ID"];
        $this->MODULE_ID->AdvancedSearch->SearchValue2 = @$filter["y_MODULE_ID"];
        $this->MODULE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_MODULE_ID"];
        $this->MODULE_ID->AdvancedSearch->save();

        // Field THEORDER
        $this->THEORDER->AdvancedSearch->SearchValue = @$filter["x_THEORDER"];
        $this->THEORDER->AdvancedSearch->SearchOperator = @$filter["z_THEORDER"];
        $this->THEORDER->AdvancedSearch->SearchCondition = @$filter["v_THEORDER"];
        $this->THEORDER->AdvancedSearch->SearchValue2 = @$filter["y_THEORDER"];
        $this->THEORDER->AdvancedSearch->SearchOperator2 = @$filter["w_THEORDER"];
        $this->THEORDER->AdvancedSearch->save();

        // Field CORRECTION_ID
        $this->CORRECTION_ID->AdvancedSearch->SearchValue = @$filter["x_CORRECTION_ID"];
        $this->CORRECTION_ID->AdvancedSearch->SearchOperator = @$filter["z_CORRECTION_ID"];
        $this->CORRECTION_ID->AdvancedSearch->SearchCondition = @$filter["v_CORRECTION_ID"];
        $this->CORRECTION_ID->AdvancedSearch->SearchValue2 = @$filter["y_CORRECTION_ID"];
        $this->CORRECTION_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CORRECTION_ID"];
        $this->CORRECTION_ID->AdvancedSearch->save();

        // Field CORRECTION_BY
        $this->CORRECTION_BY->AdvancedSearch->SearchValue = @$filter["x_CORRECTION_BY"];
        $this->CORRECTION_BY->AdvancedSearch->SearchOperator = @$filter["z_CORRECTION_BY"];
        $this->CORRECTION_BY->AdvancedSearch->SearchCondition = @$filter["v_CORRECTION_BY"];
        $this->CORRECTION_BY->AdvancedSearch->SearchValue2 = @$filter["y_CORRECTION_BY"];
        $this->CORRECTION_BY->AdvancedSearch->SearchOperator2 = @$filter["w_CORRECTION_BY"];
        $this->CORRECTION_BY->AdvancedSearch->save();

        // Field CASHIER
        $this->CASHIER->AdvancedSearch->SearchValue = @$filter["x_CASHIER"];
        $this->CASHIER->AdvancedSearch->SearchOperator = @$filter["z_CASHIER"];
        $this->CASHIER->AdvancedSearch->SearchCondition = @$filter["v_CASHIER"];
        $this->CASHIER->AdvancedSearch->SearchValue2 = @$filter["y_CASHIER"];
        $this->CASHIER->AdvancedSearch->SearchOperator2 = @$filter["w_CASHIER"];
        $this->CASHIER->AdvancedSearch->save();

        // Field PAYOR_ID
        $this->PAYOR_ID->AdvancedSearch->SearchValue = @$filter["x_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->SearchOperator = @$filter["z_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->SearchCondition = @$filter["v_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->SearchValue2 = @$filter["y_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->SearchOperator2 = @$filter["w_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->save();

        // Field KAL_ID
        $this->KAL_ID->AdvancedSearch->SearchValue = @$filter["x_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchOperator = @$filter["z_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchCondition = @$filter["v_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchValue2 = @$filter["y_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchOperator2 = @$filter["w_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->save();

        // Field NO_SKPINAP
        $this->NO_SKPINAP->AdvancedSearch->SearchValue = @$filter["x_NO_SKPINAP"];
        $this->NO_SKPINAP->AdvancedSearch->SearchOperator = @$filter["z_NO_SKPINAP"];
        $this->NO_SKPINAP->AdvancedSearch->SearchCondition = @$filter["v_NO_SKPINAP"];
        $this->NO_SKPINAP->AdvancedSearch->SearchValue2 = @$filter["y_NO_SKPINAP"];
        $this->NO_SKPINAP->AdvancedSearch->SearchOperator2 = @$filter["w_NO_SKPINAP"];
        $this->NO_SKPINAP->AdvancedSearch->save();

        // Field RESPON
        $this->RESPON->AdvancedSearch->SearchValue = @$filter["x_RESPON"];
        $this->RESPON->AdvancedSearch->SearchOperator = @$filter["z_RESPON"];
        $this->RESPON->AdvancedSearch->SearchCondition = @$filter["v_RESPON"];
        $this->RESPON->AdvancedSearch->SearchValue2 = @$filter["y_RESPON"];
        $this->RESPON->AdvancedSearch->SearchOperator2 = @$filter["w_RESPON"];
        $this->RESPON->AdvancedSearch->save();

        // Field NOKARTU
        $this->NOKARTU->AdvancedSearch->SearchValue = @$filter["x_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->SearchOperator = @$filter["z_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->SearchCondition = @$filter["v_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->SearchValue2 = @$filter["y_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->SearchOperator2 = @$filter["w_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->save();

        // Field PASIEN_ID
        $this->PASIEN_ID->AdvancedSearch->SearchValue = @$filter["x_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->SearchOperator = @$filter["z_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->SearchCondition = @$filter["v_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->SearchValue2 = @$filter["y_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->SearchOperator2 = @$filter["w_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->save();

        // Field modified_datesys
        $this->modified_datesys->AdvancedSearch->SearchValue = @$filter["x_modified_datesys"];
        $this->modified_datesys->AdvancedSearch->SearchOperator = @$filter["z_modified_datesys"];
        $this->modified_datesys->AdvancedSearch->SearchCondition = @$filter["v_modified_datesys"];
        $this->modified_datesys->AdvancedSearch->SearchValue2 = @$filter["y_modified_datesys"];
        $this->modified_datesys->AdvancedSearch->SearchOperator2 = @$filter["w_modified_datesys"];
        $this->modified_datesys->AdvancedSearch->save();

        // Field MAPPING_SEP
        $this->MAPPING_SEP->AdvancedSearch->SearchValue = @$filter["x_MAPPING_SEP"];
        $this->MAPPING_SEP->AdvancedSearch->SearchOperator = @$filter["z_MAPPING_SEP"];
        $this->MAPPING_SEP->AdvancedSearch->SearchCondition = @$filter["v_MAPPING_SEP"];
        $this->MAPPING_SEP->AdvancedSearch->SearchValue2 = @$filter["y_MAPPING_SEP"];
        $this->MAPPING_SEP->AdvancedSearch->SearchOperator2 = @$filter["w_MAPPING_SEP"];
        $this->MAPPING_SEP->AdvancedSearch->save();

        // Field TRANS_ID
        $this->TRANS_ID->AdvancedSearch->SearchValue = @$filter["x_TRANS_ID"];
        $this->TRANS_ID->AdvancedSearch->SearchOperator = @$filter["z_TRANS_ID"];
        $this->TRANS_ID->AdvancedSearch->SearchCondition = @$filter["v_TRANS_ID"];
        $this->TRANS_ID->AdvancedSearch->SearchValue2 = @$filter["y_TRANS_ID"];
        $this->TRANS_ID->AdvancedSearch->SearchOperator2 = @$filter["w_TRANS_ID"];
        $this->TRANS_ID->AdvancedSearch->save();

        // Field SPPBILL
        $this->SPPBILL->AdvancedSearch->SearchValue = @$filter["x_SPPBILL"];
        $this->SPPBILL->AdvancedSearch->SearchOperator = @$filter["z_SPPBILL"];
        $this->SPPBILL->AdvancedSearch->SearchCondition = @$filter["v_SPPBILL"];
        $this->SPPBILL->AdvancedSearch->SearchValue2 = @$filter["y_SPPBILL"];
        $this->SPPBILL->AdvancedSearch->SearchOperator2 = @$filter["w_SPPBILL"];
        $this->SPPBILL->AdvancedSearch->save();

        // Field SPPBILLDATE
        $this->SPPBILLDATE->AdvancedSearch->SearchValue = @$filter["x_SPPBILLDATE"];
        $this->SPPBILLDATE->AdvancedSearch->SearchOperator = @$filter["z_SPPBILLDATE"];
        $this->SPPBILLDATE->AdvancedSearch->SearchCondition = @$filter["v_SPPBILLDATE"];
        $this->SPPBILLDATE->AdvancedSearch->SearchValue2 = @$filter["y_SPPBILLDATE"];
        $this->SPPBILLDATE->AdvancedSearch->SearchOperator2 = @$filter["w_SPPBILLDATE"];
        $this->SPPBILLDATE->AdvancedSearch->save();

        // Field SPPBILLUSER
        $this->SPPBILLUSER->AdvancedSearch->SearchValue = @$filter["x_SPPBILLUSER"];
        $this->SPPBILLUSER->AdvancedSearch->SearchOperator = @$filter["z_SPPBILLUSER"];
        $this->SPPBILLUSER->AdvancedSearch->SearchCondition = @$filter["v_SPPBILLUSER"];
        $this->SPPBILLUSER->AdvancedSearch->SearchValue2 = @$filter["y_SPPBILLUSER"];
        $this->SPPBILLUSER->AdvancedSearch->SearchOperator2 = @$filter["w_SPPBILLUSER"];
        $this->SPPBILLUSER->AdvancedSearch->save();

        // Field SPPKASIR
        $this->SPPKASIR->AdvancedSearch->SearchValue = @$filter["x_SPPKASIR"];
        $this->SPPKASIR->AdvancedSearch->SearchOperator = @$filter["z_SPPKASIR"];
        $this->SPPKASIR->AdvancedSearch->SearchCondition = @$filter["v_SPPKASIR"];
        $this->SPPKASIR->AdvancedSearch->SearchValue2 = @$filter["y_SPPKASIR"];
        $this->SPPKASIR->AdvancedSearch->SearchOperator2 = @$filter["w_SPPKASIR"];
        $this->SPPKASIR->AdvancedSearch->save();

        // Field SPPKASIRDATE
        $this->SPPKASIRDATE->AdvancedSearch->SearchValue = @$filter["x_SPPKASIRDATE"];
        $this->SPPKASIRDATE->AdvancedSearch->SearchOperator = @$filter["z_SPPKASIRDATE"];
        $this->SPPKASIRDATE->AdvancedSearch->SearchCondition = @$filter["v_SPPKASIRDATE"];
        $this->SPPKASIRDATE->AdvancedSearch->SearchValue2 = @$filter["y_SPPKASIRDATE"];
        $this->SPPKASIRDATE->AdvancedSearch->SearchOperator2 = @$filter["w_SPPKASIRDATE"];
        $this->SPPKASIRDATE->AdvancedSearch->save();

        // Field SPPKASIRUSER
        $this->SPPKASIRUSER->AdvancedSearch->SearchValue = @$filter["x_SPPKASIRUSER"];
        $this->SPPKASIRUSER->AdvancedSearch->SearchOperator = @$filter["z_SPPKASIRUSER"];
        $this->SPPKASIRUSER->AdvancedSearch->SearchCondition = @$filter["v_SPPKASIRUSER"];
        $this->SPPKASIRUSER->AdvancedSearch->SearchValue2 = @$filter["y_SPPKASIRUSER"];
        $this->SPPKASIRUSER->AdvancedSearch->SearchOperator2 = @$filter["w_SPPKASIRUSER"];
        $this->SPPKASIRUSER->AdvancedSearch->save();

        // Field SPPPOLI
        $this->SPPPOLI->AdvancedSearch->SearchValue = @$filter["x_SPPPOLI"];
        $this->SPPPOLI->AdvancedSearch->SearchOperator = @$filter["z_SPPPOLI"];
        $this->SPPPOLI->AdvancedSearch->SearchCondition = @$filter["v_SPPPOLI"];
        $this->SPPPOLI->AdvancedSearch->SearchValue2 = @$filter["y_SPPPOLI"];
        $this->SPPPOLI->AdvancedSearch->SearchOperator2 = @$filter["w_SPPPOLI"];
        $this->SPPPOLI->AdvancedSearch->save();

        // Field SPPPOLIUSER
        $this->SPPPOLIUSER->AdvancedSearch->SearchValue = @$filter["x_SPPPOLIUSER"];
        $this->SPPPOLIUSER->AdvancedSearch->SearchOperator = @$filter["z_SPPPOLIUSER"];
        $this->SPPPOLIUSER->AdvancedSearch->SearchCondition = @$filter["v_SPPPOLIUSER"];
        $this->SPPPOLIUSER->AdvancedSearch->SearchValue2 = @$filter["y_SPPPOLIUSER"];
        $this->SPPPOLIUSER->AdvancedSearch->SearchOperator2 = @$filter["w_SPPPOLIUSER"];
        $this->SPPPOLIUSER->AdvancedSearch->save();

        // Field SPPPOLIDATE
        $this->SPPPOLIDATE->AdvancedSearch->SearchValue = @$filter["x_SPPPOLIDATE"];
        $this->SPPPOLIDATE->AdvancedSearch->SearchOperator = @$filter["z_SPPPOLIDATE"];
        $this->SPPPOLIDATE->AdvancedSearch->SearchCondition = @$filter["v_SPPPOLIDATE"];
        $this->SPPPOLIDATE->AdvancedSearch->SearchValue2 = @$filter["y_SPPPOLIDATE"];
        $this->SPPPOLIDATE->AdvancedSearch->SearchOperator2 = @$filter["w_SPPPOLIDATE"];
        $this->SPPPOLIDATE->AdvancedSearch->save();

        // Field NO_SURAT_KET
        $this->NO_SURAT_KET->AdvancedSearch->SearchValue = @$filter["x_NO_SURAT_KET"];
        $this->NO_SURAT_KET->AdvancedSearch->SearchOperator = @$filter["z_NO_SURAT_KET"];
        $this->NO_SURAT_KET->AdvancedSearch->SearchCondition = @$filter["v_NO_SURAT_KET"];
        $this->NO_SURAT_KET->AdvancedSearch->SearchValue2 = @$filter["y_NO_SURAT_KET"];
        $this->NO_SURAT_KET->AdvancedSearch->SearchOperator2 = @$filter["w_NO_SURAT_KET"];
        $this->NO_SURAT_KET->AdvancedSearch->save();

        // Field ID
        $this->ID->AdvancedSearch->SearchValue = @$filter["x_ID"];
        $this->ID->AdvancedSearch->SearchOperator = @$filter["z_ID"];
        $this->ID->AdvancedSearch->SearchCondition = @$filter["v_ID"];
        $this->ID->AdvancedSearch->SearchValue2 = @$filter["y_ID"];
        $this->ID->AdvancedSearch->SearchOperator2 = @$filter["w_ID"];
        $this->ID->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->NO_REGISTRATION, $arKeywords, $type);
        return $where;
    }

    // Build basic search SQL
    protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
    {
        $defCond = ($type == "OR") ? "OR" : "AND";
        $arSql = []; // Array for SQL parts
        $arCond = []; // Array for search conditions
        $cnt = count($arKeywords);
        $j = 0; // Number of SQL parts
        for ($i = 0; $i < $cnt; $i++) {
            $keyword = $arKeywords[$i];
            $keyword = trim($keyword);
            if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
                $keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
                $ar = explode("\\", $keyword);
            } else {
                $ar = [$keyword];
            }
            foreach ($ar as $keyword) {
                if ($keyword != "") {
                    $wrk = "";
                    if ($keyword == "OR" && $type == "") {
                        if ($j > 0) {
                            $arCond[$j - 1] = "OR";
                        }
                    } elseif ($keyword == Config("NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NULL";
                    } elseif ($keyword == Config("NOT_NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NOT NULL";
                    } elseif ($fld->IsVirtual && $fld->Visible) {
                        $wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    } elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
                        $wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    }
                    if ($wrk != "") {
                        $arSql[$j] = $wrk;
                        $arCond[$j] = $defCond;
                        $j += 1;
                    }
                }
            }
        }
        $cnt = count($arSql);
        $quoted = false;
        $sql = "";
        if ($cnt > 0) {
            for ($i = 0; $i < $cnt - 1; $i++) {
                if ($arCond[$i] == "OR") {
                    if (!$quoted) {
                        $sql .= "(";
                    }
                    $quoted = true;
                }
                $sql .= $arSql[$i];
                if ($quoted && $arCond[$i] != "OR") {
                    $sql .= ")";
                    $quoted = false;
                }
                $sql .= " " . $arCond[$i] . " ";
            }
            $sql .= $arSql[$cnt - 1];
            if ($quoted) {
                $sql .= ")";
            }
        }
        if ($sql != "") {
            if ($where != "") {
                $where .= " OR ";
            }
            $where .= "(" . $sql . ")";
        }
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            // Search keyword in any fields
            if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
                foreach ($ar as $keyword) {
                    if ($keyword != "") {
                        if ($searchStr != "") {
                            $searchStr .= " " . $searchType . " ";
                        }
                        $searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
                    }
                }
            } else {
                $searchStr = $this->basicSearchSql($ar, $searchType);
            }
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
                $this->ORG_UNIT_CODE->AdvancedSearch->loadDefault();
        return true;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->NO_REGISTRATION); // NO_REGISTRATION
            $this->updateSort($this->THENAME); // THENAME
            $this->updateSort($this->THEADDRESS); // THEADDRESS
            $this->updateSort($this->CLINIC_ID); // CLINIC_ID
            $this->updateSort($this->TREATMENT); // TREATMENT
            $this->updateSort($this->TREAT_DATE); // TREAT_DATE
            $this->updateSort($this->DESCRIPTION); // DESCRIPTION
            $this->updateSort($this->CLASS_ROOM_ID); // CLASS_ROOM_ID
            $this->updateSort($this->KELUAR_ID); // KELUAR_ID
            $this->updateSort($this->BED_ID); // BED_ID
            $this->updateSort($this->EMPLOYEE_ID); // EMPLOYEE_ID
            $this->updateSort($this->NO_SURAT_KET); // NO_SURAT_KET
            $this->updateSort($this->ID); // ID
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
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->ORG_UNIT_CODE->setSort("");
                $this->BILL_ID->setSort("");
                $this->NO_REGISTRATION->setSort("");
                $this->VISIT_ID->setSort("");
                $this->THENAME->setSort("");
                $this->THEADDRESS->setSort("");
                $this->TARIF_ID->setSort("");
                $this->CLASS_ID->setSort("");
                $this->CLINIC_ID->setSort("");
                $this->CLINIC_ID_FROM->setSort("");
                $this->TREATMENT->setSort("");
                $this->TREAT_DATE->setSort("");
                $this->QUANTITY->setSort("");
                $this->MEASURE_ID->setSort("");
                $this->DESCRIPTION->setSort("");
                $this->CLASS_ROOM_ID->setSort("");
                $this->KELUAR_ID->setSort("");
                $this->BED_ID->setSort("");
                $this->EMPLOYEE_ID->setSort("");
                $this->DOCTOR->setSort("");
                $this->EXIT_DATE->setSort("");
                $this->EMPLOYEE_ID_FROM->setSort("");
                $this->DOCTOR_FROM->setSort("");
                $this->STATUS_PASIEN_ID->setSort("");
                $this->DIAGNOSA_ID->setSort("");
                $this->THEID->setSort("");
                $this->ISRJ->setSort("");
                $this->AGEYEAR->setSort("");
                $this->AGEMONTH->setSort("");
                $this->AGEDAY->setSort("");
                $this->GENDER->setSort("");
                $this->KARYAWAN->setSort("");
                $this->MODIFIED_BY->setSort("");
                $this->MODIFIED_DATE->setSort("");
                $this->MODIFIED_FROM->setSort("");
                $this->POTONGAN->setSort("");
                $this->BAYAR->setSort("");
                $this->RETUR->setSort("");
                $this->TARIF_TYPE->setSort("");
                $this->PPNVALUE->setSort("");
                $this->TAGIHAN->setSort("");
                $this->KOREKSI->setSort("");
                $this->AMOUNT_PAID->setSort("");
                $this->DISKON->setSort("");
                $this->NOTA_NO->setSort("");
                $this->SELL_PRICE->setSort("");
                $this->ACCOUNT_ID->setSort("");
                $this->subsidi->setSort("");
                $this->DISCOUNT->setSort("");
                $this->AMOUNT->setSort("");
                $this->PPN->setSort("");
                $this->SUBSIDISAT->setSort("");
                $this->PRINTQ->setSort("");
                $this->PRINTED_BY->setSort("");
                $this->STATUS_TARIF->setSort("");
                $this->CLINIC_TYPE->setSort("");
                $this->PACKAGE_ID->setSort("");
                $this->MODULE_ID->setSort("");
                $this->THEORDER->setSort("");
                $this->CORRECTION_ID->setSort("");
                $this->CORRECTION_BY->setSort("");
                $this->CASHIER->setSort("");
                $this->PAYOR_ID->setSort("");
                $this->KAL_ID->setSort("");
                $this->NO_SKPINAP->setSort("");
                $this->RESPON->setSort("");
                $this->NOKARTU->setSort("");
                $this->PASIEN_ID->setSort("");
                $this->modified_datesys->setSort("");
                $this->MAPPING_SEP->setSort("");
                $this->TRANS_ID->setSort("");
                $this->SPPBILL->setSort("");
                $this->SPPBILLDATE->setSort("");
                $this->SPPBILLUSER->setSort("");
                $this->SPPKASIR->setSort("");
                $this->SPPKASIRDATE->setSort("");
                $this->SPPKASIRUSER->setSort("");
                $this->SPPPOLI->setSort("");
                $this->SPPPOLIUSER->setSort("");
                $this->SPPPOLIDATE->setSort("");
                $this->NO_SURAT_KET->setSort("");
                $this->ID->setSort("");
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

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = true;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = true;
        $item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
        $item->moveTo(0);
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = true;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
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
        $pageUrl = $this->pageUrl();
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

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
                    $action = $listaction->Action;
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a></li>";
                    if (count($links) == 1) { // Single button
                        $body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a>";
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
                $opt->Visible = true;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ORG_UNIT_CODE->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->BILL_ID->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Set up options default
        foreach ($options as $option) {
            $option->UseDropDownButton = false;
            $option->UseButtonGroup = true;
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->add($option->GroupOptionName);
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fV_RAWAT_INAPlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fV_RAWAT_INAPlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fV_RAWAT_INAPlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn, \PDO::FETCH_ASSOC);
            $this->CurrentAction = $userAction;

            // Call row action event
            if ($rs) {
                $conn->beginTransaction();
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    $conn->commit(); // Commit the changes
                    if ($this->getSuccessMessage() == "" && !ob_get_length()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    $conn->rollback(); // Rollback changes

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            $this->CurrentAction = ""; // Clear action
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Set up list options (extended codes)
    protected function setupListOptionsExt()
    {
    }

    // Render list options (extended codes)
    protected function renderListOptionsExt()
    {
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
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
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
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
        $row = [];
        $row['ORG_UNIT_CODE'] = null;
        $row['BILL_ID'] = null;
        $row['NO_REGISTRATION'] = null;
        $row['VISIT_ID'] = null;
        $row['THENAME'] = null;
        $row['THEADDRESS'] = null;
        $row['TARIF_ID'] = null;
        $row['CLASS_ID'] = null;
        $row['CLINIC_ID'] = null;
        $row['CLINIC_ID_FROM'] = null;
        $row['TREATMENT'] = null;
        $row['TREAT_DATE'] = null;
        $row['QUANTITY'] = null;
        $row['MEASURE_ID'] = null;
        $row['DESCRIPTION'] = null;
        $row['CLASS_ROOM_ID'] = null;
        $row['KELUAR_ID'] = null;
        $row['BED_ID'] = null;
        $row['EMPLOYEE_ID'] = null;
        $row['DOCTOR'] = null;
        $row['EXIT_DATE'] = null;
        $row['EMPLOYEE_ID_FROM'] = null;
        $row['DOCTOR_FROM'] = null;
        $row['STATUS_PASIEN_ID'] = null;
        $row['DIAGNOSA_ID'] = null;
        $row['THEID'] = null;
        $row['ISRJ'] = null;
        $row['AGEYEAR'] = null;
        $row['AGEMONTH'] = null;
        $row['AGEDAY'] = null;
        $row['GENDER'] = null;
        $row['KARYAWAN'] = null;
        $row['MODIFIED_BY'] = null;
        $row['MODIFIED_DATE'] = null;
        $row['MODIFIED_FROM'] = null;
        $row['POTONGAN'] = null;
        $row['BAYAR'] = null;
        $row['RETUR'] = null;
        $row['TARIF_TYPE'] = null;
        $row['PPNVALUE'] = null;
        $row['TAGIHAN'] = null;
        $row['KOREKSI'] = null;
        $row['AMOUNT_PAID'] = null;
        $row['DISKON'] = null;
        $row['NOTA_NO'] = null;
        $row['SELL_PRICE'] = null;
        $row['ACCOUNT_ID'] = null;
        $row['subsidi'] = null;
        $row['DISCOUNT'] = null;
        $row['AMOUNT'] = null;
        $row['PPN'] = null;
        $row['SUBSIDISAT'] = null;
        $row['PRINTQ'] = null;
        $row['PRINTED_BY'] = null;
        $row['STATUS_TARIF'] = null;
        $row['CLINIC_TYPE'] = null;
        $row['PACKAGE_ID'] = null;
        $row['MODULE_ID'] = null;
        $row['THEORDER'] = null;
        $row['CORRECTION_ID'] = null;
        $row['CORRECTION_BY'] = null;
        $row['CASHIER'] = null;
        $row['PAYOR_ID'] = null;
        $row['KAL_ID'] = null;
        $row['NO_SKPINAP'] = null;
        $row['RESPON'] = null;
        $row['NOKARTU'] = null;
        $row['PASIEN_ID'] = null;
        $row['modified_datesys'] = null;
        $row['MAPPING_SEP'] = null;
        $row['TRANS_ID'] = null;
        $row['SPPBILL'] = null;
        $row['SPPBILLDATE'] = null;
        $row['SPPBILLUSER'] = null;
        $row['SPPKASIR'] = null;
        $row['SPPKASIRDATE'] = null;
        $row['SPPKASIRUSER'] = null;
        $row['SPPPOLI'] = null;
        $row['SPPPOLIUSER'] = null;
        $row['SPPPOLIDATE'] = null;
        $row['NO_SURAT_KET'] = null;
        $row['ID'] = null;
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
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->CellCssStyle = "white-space: nowrap;";

        // BILL_ID
        $this->BILL_ID->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // THENAME
        $this->THENAME->CellCssStyle = "white-space: nowrap;";

        // THEADDRESS
        $this->THEADDRESS->CellCssStyle = "white-space: nowrap;";

        // TARIF_ID
        $this->TARIF_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID
        $this->CLASS_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // TREATMENT
        $this->TREATMENT->CellCssStyle = "white-space: nowrap;";

        // TREAT_DATE
        $this->TREAT_DATE->CellCssStyle = "white-space: nowrap;";

        // QUANTITY
        $this->QUANTITY->CellCssStyle = "white-space: nowrap;";

        // MEASURE_ID
        $this->MEASURE_ID->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->CellCssStyle = "white-space: nowrap;";

        // KELUAR_ID
        $this->KELUAR_ID->CellCssStyle = "white-space: nowrap;";

        // BED_ID
        $this->BED_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // DOCTOR
        $this->DOCTOR->CellCssStyle = "white-space: nowrap;";

        // EXIT_DATE
        $this->EXIT_DATE->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // DOCTOR_FROM
        $this->DOCTOR_FROM->CellCssStyle = "white-space: nowrap;";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->CellCssStyle = "white-space: nowrap;";

        // THEID
        $this->THEID->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // AGEYEAR
        $this->AGEYEAR->CellCssStyle = "white-space: nowrap;";

        // AGEMONTH
        $this->AGEMONTH->CellCssStyle = "white-space: nowrap;";

        // AGEDAY
        $this->AGEDAY->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // KARYAWAN
        $this->KARYAWAN->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // POTONGAN
        $this->POTONGAN->CellCssStyle = "white-space: nowrap;";

        // BAYAR
        $this->BAYAR->CellCssStyle = "white-space: nowrap;";

        // RETUR
        $this->RETUR->CellCssStyle = "white-space: nowrap;";

        // TARIF_TYPE
        $this->TARIF_TYPE->CellCssStyle = "white-space: nowrap;";

        // PPNVALUE
        $this->PPNVALUE->CellCssStyle = "white-space: nowrap;";

        // TAGIHAN
        $this->TAGIHAN->CellCssStyle = "white-space: nowrap;";

        // KOREKSI
        $this->KOREKSI->CellCssStyle = "white-space: nowrap;";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->CellCssStyle = "white-space: nowrap;";

        // DISKON
        $this->DISKON->CellCssStyle = "white-space: nowrap;";

        // NOTA_NO
        $this->NOTA_NO->CellCssStyle = "white-space: nowrap;";

        // SELL_PRICE
        $this->SELL_PRICE->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // subsidi
        $this->subsidi->CellCssStyle = "white-space: nowrap;";

        // DISCOUNT
        $this->DISCOUNT->CellCssStyle = "white-space: nowrap;";

        // AMOUNT
        $this->AMOUNT->CellCssStyle = "white-space: nowrap;";

        // PPN
        $this->PPN->CellCssStyle = "white-space: nowrap;";

        // SUBSIDISAT
        $this->SUBSIDISAT->CellCssStyle = "white-space: nowrap;";

        // PRINTQ
        $this->PRINTQ->CellCssStyle = "white-space: nowrap;";

        // PRINTED_BY
        $this->PRINTED_BY->CellCssStyle = "white-space: nowrap;";

        // STATUS_TARIF
        $this->STATUS_TARIF->CellCssStyle = "white-space: nowrap;";

        // CLINIC_TYPE
        $this->CLINIC_TYPE->CellCssStyle = "white-space: nowrap;";

        // PACKAGE_ID
        $this->PACKAGE_ID->CellCssStyle = "white-space: nowrap;";

        // MODULE_ID
        $this->MODULE_ID->CellCssStyle = "white-space: nowrap;";

        // THEORDER
        $this->THEORDER->CellCssStyle = "white-space: nowrap;";

        // CORRECTION_ID
        $this->CORRECTION_ID->CellCssStyle = "white-space: nowrap;";

        // CORRECTION_BY
        $this->CORRECTION_BY->CellCssStyle = "white-space: nowrap;";

        // CASHIER
        $this->CASHIER->CellCssStyle = "white-space: nowrap;";

        // PAYOR_ID
        $this->PAYOR_ID->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // NO_SKPINAP
        $this->NO_SKPINAP->CellCssStyle = "white-space: nowrap;";

        // RESPON
        $this->RESPON->CellCssStyle = "white-space: nowrap;";

        // NOKARTU
        $this->NOKARTU->CellCssStyle = "white-space: nowrap;";

        // PASIEN_ID
        $this->PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // modified_datesys
        $this->modified_datesys->CellCssStyle = "white-space: nowrap;";

        // MAPPING_SEP
        $this->MAPPING_SEP->CellCssStyle = "white-space: nowrap;";

        // TRANS_ID
        $this->TRANS_ID->CellCssStyle = "white-space: nowrap;";

        // SPPBILL
        $this->SPPBILL->CellCssStyle = "white-space: nowrap;";

        // SPPBILLDATE
        $this->SPPBILLDATE->CellCssStyle = "white-space: nowrap;";

        // SPPBILLUSER
        $this->SPPBILLUSER->CellCssStyle = "white-space: nowrap;";

        // SPPKASIR
        $this->SPPKASIR->CellCssStyle = "white-space: nowrap;";

        // SPPKASIRDATE
        $this->SPPKASIRDATE->CellCssStyle = "white-space: nowrap;";

        // SPPKASIRUSER
        $this->SPPKASIRUSER->CellCssStyle = "white-space: nowrap;";

        // SPPPOLI
        $this->SPPPOLI->CellCssStyle = "white-space: nowrap;";

        // SPPPOLIUSER
        $this->SPPPOLIUSER->CellCssStyle = "white-space: nowrap;";

        // SPPPOLIDATE
        $this->SPPPOLIDATE->CellCssStyle = "white-space: nowrap;";

        // NO_SURAT_KET
        $this->NO_SURAT_KET->CellCssStyle = "white-space: nowrap;";

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

            // THENAME
            $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
            $this->THENAME->ViewCustomAttributes = "";

            // THEADDRESS
            $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
            $this->THEADDRESS->ViewCustomAttributes = "";

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
            $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 11);
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

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // THENAME
            $this->THENAME->LinkCustomAttributes = "";
            $this->THENAME->HrefValue = "";
            $this->THENAME->TooltipValue = "";

            // THEADDRESS
            $this->THEADDRESS->LinkCustomAttributes = "";
            $this->THEADDRESS->HrefValue = "";
            $this->THEADDRESS->TooltipValue = "";

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
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions("div");
        $this->SearchOptions->TagClassName = "ew-search-option";

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fV_RAWAT_INAPlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ResetSearch") . "\" data-caption=\"" . $Language->phrase("ResetSearch") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ResetSearchBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
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

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
