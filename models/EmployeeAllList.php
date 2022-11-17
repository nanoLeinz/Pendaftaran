<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class EmployeeAllList extends EmployeeAll
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'EMPLOYEE_ALL';

    // Page object name
    public $PageObjName = "EmployeeAllList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fEMPLOYEE_ALLlist";
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

        // Table object (EMPLOYEE_ALL)
        if (!isset($GLOBALS["EMPLOYEE_ALL"]) || get_class($GLOBALS["EMPLOYEE_ALL"]) == PROJECT_NAMESPACE . "EMPLOYEE_ALL") {
            $GLOBALS["EMPLOYEE_ALL"] = &$this;
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
        $this->AddUrl = "EmployeeAllAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "EmployeeAllDelete";
        $this->MultiUpdateUrl = "EmployeeAllUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'EMPLOYEE_ALL');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fEMPLOYEE_ALLlistsrch";

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
                $doc = new $class(Container("EMPLOYEE_ALL"));
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
            $key .= @$ar['EMPLOYEE_ID'];
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
        $this->DESCRIPTION->Visible = false;
        $this->OBJECT_CATEGORY_ID->Visible = false;
        $this->ORG_UNIT_CODE->Visible = false;
        $this->EMPLOYEE_ID->Visible = false;
        $this->MYADDRESS->Visible = false;
        $this->POSTAL_CODE->Visible = false;
        $this->RT->Visible = false;
        $this->RW->Visible = false;
        $this->KAL_ID->Visible = false;
        $this->KEC_ID->Visible = false;
        $this->KODE_KOTA->Visible = false;
        $this->PROVINCE_CODE->Visible = false;
        $this->COUNTRY_CODE->Visible = false;
        $this->PHONE->Visible = false;
        $this->FAX->Visible = false;
        $this->_EMAIL->Visible = false;
        $this->HANDPHONE->Visible = false;
        $this->KARPEG->Visible = false;
        $this->KARIS->Visible = false;
        $this->ASKES->Visible = false;
        $this->TASPEN->Visible = false;
        $this->FULLNAME->setVisibility();
        $this->GELAR_DEPAN->Visible = false;
        $this->GELAR_BELAKANG->Visible = false;
        $this->NICKNAME->Visible = false;
        $this->PLACEOFBIRTH->Visible = false;
        $this->DATEOFBIRTH->Visible = false;
        $this->KODE_AGAMA->Visible = false;
        $this->GENDER->setVisibility();
        $this->MARITALSTATUSID->Visible = false;
        $this->BLOOD_ID->Visible = false;
        $this->ORG_ID->setVisibility();
        $this->KODE_JABATAN->Visible = false;
        $this->EMPLOYEED_DATE->Visible = false;
        $this->EMP_TYPE->Visible = false;
        $this->STATUS_ID->Visible = false;
        $this->CURRENT_GOLF_ID->Visible = false;
        $this->FUNCTIONAL->Visible = false;
        $this->TOTAL_CCP->Visible = false;
        $this->PWORKING_PERIOD_TH->Visible = false;
        $this->P_WORKING_PERIOD_BLN->Visible = false;
        $this->RWORKING_PERIOD_TH->Visible = false;
        $this->RWORKING_PERIOD_BLN->Visible = false;
        $this->CURRENT_GOL_ID->Visible = false;
        $this->GWORKING_PERIOD_TH->Visible = false;
        $this->GWORKING_PERIOD_BLN->Visible = false;
        $this->EDUCATION_TYPE_CODE->Visible = false;
        $this->NPWP->Visible = false;
        $this->NATION_ID->Visible = false;
        $this->PAID_ID->Visible = false;
        $this->NONACTIVE->Visible = false;
        $this->NONACTIVE_DATE->Visible = false;
        $this->NON_ACTIVE_TYPE->Visible = false;
        $this->PENSION_DATE->Visible = false;
        $this->MORTGAGEYEAR->Visible = false;
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->PICTUREFILE->Visible = false;
        $this->FINGERSCANFILE->Visible = false;
        $this->ISFULLTIME->Visible = false;
        $this->SPECIALIST_TYPE_ID->setVisibility();
        $this->BANK_ID->Visible = false;
        $this->BANK_ACCOUNT->Visible = false;
        $this->NPK->Visible = false;
        $this->OTHER_ADDRESS->Visible = false;
        $this->DEATH_DATE->Visible = false;
        $this->WEBSITE->Visible = false;
        $this->NIP->setVisibility();
        $this->DPJP->setVisibility();
        $this->SK_NO->Visible = false;
        $this->SK_TMT->Visible = false;
        $this->SK_TAT->Visible = false;
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
        $this->setupLookupOptions($this->GENDER);
        $this->setupLookupOptions($this->ORG_ID);
        $this->setupLookupOptions($this->SPECIALIST_TYPE_ID);

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
        $filterList = Concat($filterList, $this->DESCRIPTION->AdvancedSearch->toJson(), ","); // Field DESCRIPTION
        $filterList = Concat($filterList, $this->OBJECT_CATEGORY_ID->AdvancedSearch->toJson(), ","); // Field OBJECT_CATEGORY_ID
        $filterList = Concat($filterList, $this->ORG_UNIT_CODE->AdvancedSearch->toJson(), ","); // Field ORG_UNIT_CODE
        $filterList = Concat($filterList, $this->EMPLOYEE_ID->AdvancedSearch->toJson(), ","); // Field EMPLOYEE_ID
        $filterList = Concat($filterList, $this->MYADDRESS->AdvancedSearch->toJson(), ","); // Field MYADDRESS
        $filterList = Concat($filterList, $this->POSTAL_CODE->AdvancedSearch->toJson(), ","); // Field POSTAL_CODE
        $filterList = Concat($filterList, $this->RT->AdvancedSearch->toJson(), ","); // Field RT
        $filterList = Concat($filterList, $this->RW->AdvancedSearch->toJson(), ","); // Field RW
        $filterList = Concat($filterList, $this->KAL_ID->AdvancedSearch->toJson(), ","); // Field KAL_ID
        $filterList = Concat($filterList, $this->KEC_ID->AdvancedSearch->toJson(), ","); // Field KEC_ID
        $filterList = Concat($filterList, $this->KODE_KOTA->AdvancedSearch->toJson(), ","); // Field KODE_KOTA
        $filterList = Concat($filterList, $this->PROVINCE_CODE->AdvancedSearch->toJson(), ","); // Field PROVINCE_CODE
        $filterList = Concat($filterList, $this->COUNTRY_CODE->AdvancedSearch->toJson(), ","); // Field COUNTRY_CODE
        $filterList = Concat($filterList, $this->PHONE->AdvancedSearch->toJson(), ","); // Field PHONE
        $filterList = Concat($filterList, $this->FAX->AdvancedSearch->toJson(), ","); // Field FAX
        $filterList = Concat($filterList, $this->_EMAIL->AdvancedSearch->toJson(), ","); // Field EMAIL
        $filterList = Concat($filterList, $this->HANDPHONE->AdvancedSearch->toJson(), ","); // Field HANDPHONE
        $filterList = Concat($filterList, $this->KARPEG->AdvancedSearch->toJson(), ","); // Field KARPEG
        $filterList = Concat($filterList, $this->KARIS->AdvancedSearch->toJson(), ","); // Field KARIS
        $filterList = Concat($filterList, $this->ASKES->AdvancedSearch->toJson(), ","); // Field ASKES
        $filterList = Concat($filterList, $this->TASPEN->AdvancedSearch->toJson(), ","); // Field TASPEN
        $filterList = Concat($filterList, $this->FULLNAME->AdvancedSearch->toJson(), ","); // Field FULLNAME
        $filterList = Concat($filterList, $this->GELAR_DEPAN->AdvancedSearch->toJson(), ","); // Field GELAR_DEPAN
        $filterList = Concat($filterList, $this->GELAR_BELAKANG->AdvancedSearch->toJson(), ","); // Field GELAR_BELAKANG
        $filterList = Concat($filterList, $this->NICKNAME->AdvancedSearch->toJson(), ","); // Field NICKNAME
        $filterList = Concat($filterList, $this->PLACEOFBIRTH->AdvancedSearch->toJson(), ","); // Field PLACEOFBIRTH
        $filterList = Concat($filterList, $this->DATEOFBIRTH->AdvancedSearch->toJson(), ","); // Field DATEOFBIRTH
        $filterList = Concat($filterList, $this->KODE_AGAMA->AdvancedSearch->toJson(), ","); // Field KODE_AGAMA
        $filterList = Concat($filterList, $this->GENDER->AdvancedSearch->toJson(), ","); // Field GENDER
        $filterList = Concat($filterList, $this->MARITALSTATUSID->AdvancedSearch->toJson(), ","); // Field MARITALSTATUSID
        $filterList = Concat($filterList, $this->BLOOD_ID->AdvancedSearch->toJson(), ","); // Field BLOOD_ID
        $filterList = Concat($filterList, $this->ORG_ID->AdvancedSearch->toJson(), ","); // Field ORG_ID
        $filterList = Concat($filterList, $this->KODE_JABATAN->AdvancedSearch->toJson(), ","); // Field KODE_JABATAN
        $filterList = Concat($filterList, $this->EMPLOYEED_DATE->AdvancedSearch->toJson(), ","); // Field EMPLOYEED_DATE
        $filterList = Concat($filterList, $this->EMP_TYPE->AdvancedSearch->toJson(), ","); // Field EMP_TYPE
        $filterList = Concat($filterList, $this->STATUS_ID->AdvancedSearch->toJson(), ","); // Field STATUS_ID
        $filterList = Concat($filterList, $this->CURRENT_GOLF_ID->AdvancedSearch->toJson(), ","); // Field CURRENT_GOLF_ID
        $filterList = Concat($filterList, $this->FUNCTIONAL->AdvancedSearch->toJson(), ","); // Field FUNCTIONAL
        $filterList = Concat($filterList, $this->TOTAL_CCP->AdvancedSearch->toJson(), ","); // Field TOTAL_CCP
        $filterList = Concat($filterList, $this->PWORKING_PERIOD_TH->AdvancedSearch->toJson(), ","); // Field PWORKING_PERIOD_TH
        $filterList = Concat($filterList, $this->P_WORKING_PERIOD_BLN->AdvancedSearch->toJson(), ","); // Field P_WORKING_PERIOD_BLN
        $filterList = Concat($filterList, $this->RWORKING_PERIOD_TH->AdvancedSearch->toJson(), ","); // Field RWORKING_PERIOD_TH
        $filterList = Concat($filterList, $this->RWORKING_PERIOD_BLN->AdvancedSearch->toJson(), ","); // Field RWORKING_PERIOD_BLN
        $filterList = Concat($filterList, $this->CURRENT_GOL_ID->AdvancedSearch->toJson(), ","); // Field CURRENT_GOL_ID
        $filterList = Concat($filterList, $this->GWORKING_PERIOD_TH->AdvancedSearch->toJson(), ","); // Field GWORKING_PERIOD_TH
        $filterList = Concat($filterList, $this->GWORKING_PERIOD_BLN->AdvancedSearch->toJson(), ","); // Field GWORKING_PERIOD_BLN
        $filterList = Concat($filterList, $this->EDUCATION_TYPE_CODE->AdvancedSearch->toJson(), ","); // Field EDUCATION_TYPE_CODE
        $filterList = Concat($filterList, $this->NPWP->AdvancedSearch->toJson(), ","); // Field NPWP
        $filterList = Concat($filterList, $this->NATION_ID->AdvancedSearch->toJson(), ","); // Field NATION_ID
        $filterList = Concat($filterList, $this->PAID_ID->AdvancedSearch->toJson(), ","); // Field PAID_ID
        $filterList = Concat($filterList, $this->NONACTIVE->AdvancedSearch->toJson(), ","); // Field NONACTIVE
        $filterList = Concat($filterList, $this->NONACTIVE_DATE->AdvancedSearch->toJson(), ","); // Field NONACTIVE_DATE
        $filterList = Concat($filterList, $this->NON_ACTIVE_TYPE->AdvancedSearch->toJson(), ","); // Field NON_ACTIVE_TYPE
        $filterList = Concat($filterList, $this->PENSION_DATE->AdvancedSearch->toJson(), ","); // Field PENSION_DATE
        $filterList = Concat($filterList, $this->MORTGAGEYEAR->AdvancedSearch->toJson(), ","); // Field MORTGAGEYEAR
        $filterList = Concat($filterList, $this->MODIFIED_DATE->AdvancedSearch->toJson(), ","); // Field MODIFIED_DATE
        $filterList = Concat($filterList, $this->MODIFIED_BY->AdvancedSearch->toJson(), ","); // Field MODIFIED_BY
        $filterList = Concat($filterList, $this->PICTUREFILE->AdvancedSearch->toJson(), ","); // Field PICTUREFILE
        $filterList = Concat($filterList, $this->FINGERSCANFILE->AdvancedSearch->toJson(), ","); // Field FINGERSCANFILE
        $filterList = Concat($filterList, $this->ISFULLTIME->AdvancedSearch->toJson(), ","); // Field ISFULLTIME
        $filterList = Concat($filterList, $this->SPECIALIST_TYPE_ID->AdvancedSearch->toJson(), ","); // Field SPECIALIST_TYPE_ID
        $filterList = Concat($filterList, $this->BANK_ID->AdvancedSearch->toJson(), ","); // Field BANK_ID
        $filterList = Concat($filterList, $this->BANK_ACCOUNT->AdvancedSearch->toJson(), ","); // Field BANK_ACCOUNT
        $filterList = Concat($filterList, $this->NPK->AdvancedSearch->toJson(), ","); // Field NPK
        $filterList = Concat($filterList, $this->OTHER_ADDRESS->AdvancedSearch->toJson(), ","); // Field OTHER_ADDRESS
        $filterList = Concat($filterList, $this->DEATH_DATE->AdvancedSearch->toJson(), ","); // Field DEATH_DATE
        $filterList = Concat($filterList, $this->WEBSITE->AdvancedSearch->toJson(), ","); // Field WEBSITE
        $filterList = Concat($filterList, $this->NIP->AdvancedSearch->toJson(), ","); // Field NIP
        $filterList = Concat($filterList, $this->DPJP->AdvancedSearch->toJson(), ","); // Field DPJP
        $filterList = Concat($filterList, $this->SK_NO->AdvancedSearch->toJson(), ","); // Field SK_NO
        $filterList = Concat($filterList, $this->SK_TMT->AdvancedSearch->toJson(), ","); // Field SK_TMT
        $filterList = Concat($filterList, $this->SK_TAT->AdvancedSearch->toJson(), ","); // Field SK_TAT
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fEMPLOYEE_ALLlistsrch", $filters);
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

        // Field DESCRIPTION
        $this->DESCRIPTION->AdvancedSearch->SearchValue = @$filter["x_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchOperator = @$filter["z_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchCondition = @$filter["v_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchValue2 = @$filter["y_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchOperator2 = @$filter["w_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->save();

        // Field OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->AdvancedSearch->SearchValue = @$filter["x_OBJECT_CATEGORY_ID"];
        $this->OBJECT_CATEGORY_ID->AdvancedSearch->SearchOperator = @$filter["z_OBJECT_CATEGORY_ID"];
        $this->OBJECT_CATEGORY_ID->AdvancedSearch->SearchCondition = @$filter["v_OBJECT_CATEGORY_ID"];
        $this->OBJECT_CATEGORY_ID->AdvancedSearch->SearchValue2 = @$filter["y_OBJECT_CATEGORY_ID"];
        $this->OBJECT_CATEGORY_ID->AdvancedSearch->SearchOperator2 = @$filter["w_OBJECT_CATEGORY_ID"];
        $this->OBJECT_CATEGORY_ID->AdvancedSearch->save();

        // Field ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchValue = @$filter["x_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchOperator = @$filter["z_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchCondition = @$filter["v_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchValue2 = @$filter["y_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->SearchOperator2 = @$filter["w_ORG_UNIT_CODE"];
        $this->ORG_UNIT_CODE->AdvancedSearch->save();

        // Field EMPLOYEE_ID
        $this->EMPLOYEE_ID->AdvancedSearch->SearchValue = @$filter["x_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchOperator = @$filter["z_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchCondition = @$filter["v_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchValue2 = @$filter["y_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->save();

        // Field MYADDRESS
        $this->MYADDRESS->AdvancedSearch->SearchValue = @$filter["x_MYADDRESS"];
        $this->MYADDRESS->AdvancedSearch->SearchOperator = @$filter["z_MYADDRESS"];
        $this->MYADDRESS->AdvancedSearch->SearchCondition = @$filter["v_MYADDRESS"];
        $this->MYADDRESS->AdvancedSearch->SearchValue2 = @$filter["y_MYADDRESS"];
        $this->MYADDRESS->AdvancedSearch->SearchOperator2 = @$filter["w_MYADDRESS"];
        $this->MYADDRESS->AdvancedSearch->save();

        // Field POSTAL_CODE
        $this->POSTAL_CODE->AdvancedSearch->SearchValue = @$filter["x_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->SearchOperator = @$filter["z_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->SearchCondition = @$filter["v_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->SearchValue2 = @$filter["y_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->SearchOperator2 = @$filter["w_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->save();

        // Field RT
        $this->RT->AdvancedSearch->SearchValue = @$filter["x_RT"];
        $this->RT->AdvancedSearch->SearchOperator = @$filter["z_RT"];
        $this->RT->AdvancedSearch->SearchCondition = @$filter["v_RT"];
        $this->RT->AdvancedSearch->SearchValue2 = @$filter["y_RT"];
        $this->RT->AdvancedSearch->SearchOperator2 = @$filter["w_RT"];
        $this->RT->AdvancedSearch->save();

        // Field RW
        $this->RW->AdvancedSearch->SearchValue = @$filter["x_RW"];
        $this->RW->AdvancedSearch->SearchOperator = @$filter["z_RW"];
        $this->RW->AdvancedSearch->SearchCondition = @$filter["v_RW"];
        $this->RW->AdvancedSearch->SearchValue2 = @$filter["y_RW"];
        $this->RW->AdvancedSearch->SearchOperator2 = @$filter["w_RW"];
        $this->RW->AdvancedSearch->save();

        // Field KAL_ID
        $this->KAL_ID->AdvancedSearch->SearchValue = @$filter["x_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchOperator = @$filter["z_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchCondition = @$filter["v_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchValue2 = @$filter["y_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchOperator2 = @$filter["w_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->save();

        // Field KEC_ID
        $this->KEC_ID->AdvancedSearch->SearchValue = @$filter["x_KEC_ID"];
        $this->KEC_ID->AdvancedSearch->SearchOperator = @$filter["z_KEC_ID"];
        $this->KEC_ID->AdvancedSearch->SearchCondition = @$filter["v_KEC_ID"];
        $this->KEC_ID->AdvancedSearch->SearchValue2 = @$filter["y_KEC_ID"];
        $this->KEC_ID->AdvancedSearch->SearchOperator2 = @$filter["w_KEC_ID"];
        $this->KEC_ID->AdvancedSearch->save();

        // Field KODE_KOTA
        $this->KODE_KOTA->AdvancedSearch->SearchValue = @$filter["x_KODE_KOTA"];
        $this->KODE_KOTA->AdvancedSearch->SearchOperator = @$filter["z_KODE_KOTA"];
        $this->KODE_KOTA->AdvancedSearch->SearchCondition = @$filter["v_KODE_KOTA"];
        $this->KODE_KOTA->AdvancedSearch->SearchValue2 = @$filter["y_KODE_KOTA"];
        $this->KODE_KOTA->AdvancedSearch->SearchOperator2 = @$filter["w_KODE_KOTA"];
        $this->KODE_KOTA->AdvancedSearch->save();

        // Field PROVINCE_CODE
        $this->PROVINCE_CODE->AdvancedSearch->SearchValue = @$filter["x_PROVINCE_CODE"];
        $this->PROVINCE_CODE->AdvancedSearch->SearchOperator = @$filter["z_PROVINCE_CODE"];
        $this->PROVINCE_CODE->AdvancedSearch->SearchCondition = @$filter["v_PROVINCE_CODE"];
        $this->PROVINCE_CODE->AdvancedSearch->SearchValue2 = @$filter["y_PROVINCE_CODE"];
        $this->PROVINCE_CODE->AdvancedSearch->SearchOperator2 = @$filter["w_PROVINCE_CODE"];
        $this->PROVINCE_CODE->AdvancedSearch->save();

        // Field COUNTRY_CODE
        $this->COUNTRY_CODE->AdvancedSearch->SearchValue = @$filter["x_COUNTRY_CODE"];
        $this->COUNTRY_CODE->AdvancedSearch->SearchOperator = @$filter["z_COUNTRY_CODE"];
        $this->COUNTRY_CODE->AdvancedSearch->SearchCondition = @$filter["v_COUNTRY_CODE"];
        $this->COUNTRY_CODE->AdvancedSearch->SearchValue2 = @$filter["y_COUNTRY_CODE"];
        $this->COUNTRY_CODE->AdvancedSearch->SearchOperator2 = @$filter["w_COUNTRY_CODE"];
        $this->COUNTRY_CODE->AdvancedSearch->save();

        // Field PHONE
        $this->PHONE->AdvancedSearch->SearchValue = @$filter["x_PHONE"];
        $this->PHONE->AdvancedSearch->SearchOperator = @$filter["z_PHONE"];
        $this->PHONE->AdvancedSearch->SearchCondition = @$filter["v_PHONE"];
        $this->PHONE->AdvancedSearch->SearchValue2 = @$filter["y_PHONE"];
        $this->PHONE->AdvancedSearch->SearchOperator2 = @$filter["w_PHONE"];
        $this->PHONE->AdvancedSearch->save();

        // Field FAX
        $this->FAX->AdvancedSearch->SearchValue = @$filter["x_FAX"];
        $this->FAX->AdvancedSearch->SearchOperator = @$filter["z_FAX"];
        $this->FAX->AdvancedSearch->SearchCondition = @$filter["v_FAX"];
        $this->FAX->AdvancedSearch->SearchValue2 = @$filter["y_FAX"];
        $this->FAX->AdvancedSearch->SearchOperator2 = @$filter["w_FAX"];
        $this->FAX->AdvancedSearch->save();

        // Field EMAIL
        $this->_EMAIL->AdvancedSearch->SearchValue = @$filter["x__EMAIL"];
        $this->_EMAIL->AdvancedSearch->SearchOperator = @$filter["z__EMAIL"];
        $this->_EMAIL->AdvancedSearch->SearchCondition = @$filter["v__EMAIL"];
        $this->_EMAIL->AdvancedSearch->SearchValue2 = @$filter["y__EMAIL"];
        $this->_EMAIL->AdvancedSearch->SearchOperator2 = @$filter["w__EMAIL"];
        $this->_EMAIL->AdvancedSearch->save();

        // Field HANDPHONE
        $this->HANDPHONE->AdvancedSearch->SearchValue = @$filter["x_HANDPHONE"];
        $this->HANDPHONE->AdvancedSearch->SearchOperator = @$filter["z_HANDPHONE"];
        $this->HANDPHONE->AdvancedSearch->SearchCondition = @$filter["v_HANDPHONE"];
        $this->HANDPHONE->AdvancedSearch->SearchValue2 = @$filter["y_HANDPHONE"];
        $this->HANDPHONE->AdvancedSearch->SearchOperator2 = @$filter["w_HANDPHONE"];
        $this->HANDPHONE->AdvancedSearch->save();

        // Field KARPEG
        $this->KARPEG->AdvancedSearch->SearchValue = @$filter["x_KARPEG"];
        $this->KARPEG->AdvancedSearch->SearchOperator = @$filter["z_KARPEG"];
        $this->KARPEG->AdvancedSearch->SearchCondition = @$filter["v_KARPEG"];
        $this->KARPEG->AdvancedSearch->SearchValue2 = @$filter["y_KARPEG"];
        $this->KARPEG->AdvancedSearch->SearchOperator2 = @$filter["w_KARPEG"];
        $this->KARPEG->AdvancedSearch->save();

        // Field KARIS
        $this->KARIS->AdvancedSearch->SearchValue = @$filter["x_KARIS"];
        $this->KARIS->AdvancedSearch->SearchOperator = @$filter["z_KARIS"];
        $this->KARIS->AdvancedSearch->SearchCondition = @$filter["v_KARIS"];
        $this->KARIS->AdvancedSearch->SearchValue2 = @$filter["y_KARIS"];
        $this->KARIS->AdvancedSearch->SearchOperator2 = @$filter["w_KARIS"];
        $this->KARIS->AdvancedSearch->save();

        // Field ASKES
        $this->ASKES->AdvancedSearch->SearchValue = @$filter["x_ASKES"];
        $this->ASKES->AdvancedSearch->SearchOperator = @$filter["z_ASKES"];
        $this->ASKES->AdvancedSearch->SearchCondition = @$filter["v_ASKES"];
        $this->ASKES->AdvancedSearch->SearchValue2 = @$filter["y_ASKES"];
        $this->ASKES->AdvancedSearch->SearchOperator2 = @$filter["w_ASKES"];
        $this->ASKES->AdvancedSearch->save();

        // Field TASPEN
        $this->TASPEN->AdvancedSearch->SearchValue = @$filter["x_TASPEN"];
        $this->TASPEN->AdvancedSearch->SearchOperator = @$filter["z_TASPEN"];
        $this->TASPEN->AdvancedSearch->SearchCondition = @$filter["v_TASPEN"];
        $this->TASPEN->AdvancedSearch->SearchValue2 = @$filter["y_TASPEN"];
        $this->TASPEN->AdvancedSearch->SearchOperator2 = @$filter["w_TASPEN"];
        $this->TASPEN->AdvancedSearch->save();

        // Field FULLNAME
        $this->FULLNAME->AdvancedSearch->SearchValue = @$filter["x_FULLNAME"];
        $this->FULLNAME->AdvancedSearch->SearchOperator = @$filter["z_FULLNAME"];
        $this->FULLNAME->AdvancedSearch->SearchCondition = @$filter["v_FULLNAME"];
        $this->FULLNAME->AdvancedSearch->SearchValue2 = @$filter["y_FULLNAME"];
        $this->FULLNAME->AdvancedSearch->SearchOperator2 = @$filter["w_FULLNAME"];
        $this->FULLNAME->AdvancedSearch->save();

        // Field GELAR_DEPAN
        $this->GELAR_DEPAN->AdvancedSearch->SearchValue = @$filter["x_GELAR_DEPAN"];
        $this->GELAR_DEPAN->AdvancedSearch->SearchOperator = @$filter["z_GELAR_DEPAN"];
        $this->GELAR_DEPAN->AdvancedSearch->SearchCondition = @$filter["v_GELAR_DEPAN"];
        $this->GELAR_DEPAN->AdvancedSearch->SearchValue2 = @$filter["y_GELAR_DEPAN"];
        $this->GELAR_DEPAN->AdvancedSearch->SearchOperator2 = @$filter["w_GELAR_DEPAN"];
        $this->GELAR_DEPAN->AdvancedSearch->save();

        // Field GELAR_BELAKANG
        $this->GELAR_BELAKANG->AdvancedSearch->SearchValue = @$filter["x_GELAR_BELAKANG"];
        $this->GELAR_BELAKANG->AdvancedSearch->SearchOperator = @$filter["z_GELAR_BELAKANG"];
        $this->GELAR_BELAKANG->AdvancedSearch->SearchCondition = @$filter["v_GELAR_BELAKANG"];
        $this->GELAR_BELAKANG->AdvancedSearch->SearchValue2 = @$filter["y_GELAR_BELAKANG"];
        $this->GELAR_BELAKANG->AdvancedSearch->SearchOperator2 = @$filter["w_GELAR_BELAKANG"];
        $this->GELAR_BELAKANG->AdvancedSearch->save();

        // Field NICKNAME
        $this->NICKNAME->AdvancedSearch->SearchValue = @$filter["x_NICKNAME"];
        $this->NICKNAME->AdvancedSearch->SearchOperator = @$filter["z_NICKNAME"];
        $this->NICKNAME->AdvancedSearch->SearchCondition = @$filter["v_NICKNAME"];
        $this->NICKNAME->AdvancedSearch->SearchValue2 = @$filter["y_NICKNAME"];
        $this->NICKNAME->AdvancedSearch->SearchOperator2 = @$filter["w_NICKNAME"];
        $this->NICKNAME->AdvancedSearch->save();

        // Field PLACEOFBIRTH
        $this->PLACEOFBIRTH->AdvancedSearch->SearchValue = @$filter["x_PLACEOFBIRTH"];
        $this->PLACEOFBIRTH->AdvancedSearch->SearchOperator = @$filter["z_PLACEOFBIRTH"];
        $this->PLACEOFBIRTH->AdvancedSearch->SearchCondition = @$filter["v_PLACEOFBIRTH"];
        $this->PLACEOFBIRTH->AdvancedSearch->SearchValue2 = @$filter["y_PLACEOFBIRTH"];
        $this->PLACEOFBIRTH->AdvancedSearch->SearchOperator2 = @$filter["w_PLACEOFBIRTH"];
        $this->PLACEOFBIRTH->AdvancedSearch->save();

        // Field DATEOFBIRTH
        $this->DATEOFBIRTH->AdvancedSearch->SearchValue = @$filter["x_DATEOFBIRTH"];
        $this->DATEOFBIRTH->AdvancedSearch->SearchOperator = @$filter["z_DATEOFBIRTH"];
        $this->DATEOFBIRTH->AdvancedSearch->SearchCondition = @$filter["v_DATEOFBIRTH"];
        $this->DATEOFBIRTH->AdvancedSearch->SearchValue2 = @$filter["y_DATEOFBIRTH"];
        $this->DATEOFBIRTH->AdvancedSearch->SearchOperator2 = @$filter["w_DATEOFBIRTH"];
        $this->DATEOFBIRTH->AdvancedSearch->save();

        // Field KODE_AGAMA
        $this->KODE_AGAMA->AdvancedSearch->SearchValue = @$filter["x_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->SearchOperator = @$filter["z_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->SearchCondition = @$filter["v_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->SearchValue2 = @$filter["y_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->SearchOperator2 = @$filter["w_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->save();

        // Field GENDER
        $this->GENDER->AdvancedSearch->SearchValue = @$filter["x_GENDER"];
        $this->GENDER->AdvancedSearch->SearchOperator = @$filter["z_GENDER"];
        $this->GENDER->AdvancedSearch->SearchCondition = @$filter["v_GENDER"];
        $this->GENDER->AdvancedSearch->SearchValue2 = @$filter["y_GENDER"];
        $this->GENDER->AdvancedSearch->SearchOperator2 = @$filter["w_GENDER"];
        $this->GENDER->AdvancedSearch->save();

        // Field MARITALSTATUSID
        $this->MARITALSTATUSID->AdvancedSearch->SearchValue = @$filter["x_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->SearchOperator = @$filter["z_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->SearchCondition = @$filter["v_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->SearchValue2 = @$filter["y_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->SearchOperator2 = @$filter["w_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->save();

        // Field BLOOD_ID
        $this->BLOOD_ID->AdvancedSearch->SearchValue = @$filter["x_BLOOD_ID"];
        $this->BLOOD_ID->AdvancedSearch->SearchOperator = @$filter["z_BLOOD_ID"];
        $this->BLOOD_ID->AdvancedSearch->SearchCondition = @$filter["v_BLOOD_ID"];
        $this->BLOOD_ID->AdvancedSearch->SearchValue2 = @$filter["y_BLOOD_ID"];
        $this->BLOOD_ID->AdvancedSearch->SearchOperator2 = @$filter["w_BLOOD_ID"];
        $this->BLOOD_ID->AdvancedSearch->save();

        // Field ORG_ID
        $this->ORG_ID->AdvancedSearch->SearchValue = @$filter["x_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->SearchOperator = @$filter["z_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->SearchCondition = @$filter["v_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->SearchValue2 = @$filter["y_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->SearchOperator2 = @$filter["w_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->save();

        // Field KODE_JABATAN
        $this->KODE_JABATAN->AdvancedSearch->SearchValue = @$filter["x_KODE_JABATAN"];
        $this->KODE_JABATAN->AdvancedSearch->SearchOperator = @$filter["z_KODE_JABATAN"];
        $this->KODE_JABATAN->AdvancedSearch->SearchCondition = @$filter["v_KODE_JABATAN"];
        $this->KODE_JABATAN->AdvancedSearch->SearchValue2 = @$filter["y_KODE_JABATAN"];
        $this->KODE_JABATAN->AdvancedSearch->SearchOperator2 = @$filter["w_KODE_JABATAN"];
        $this->KODE_JABATAN->AdvancedSearch->save();

        // Field EMPLOYEED_DATE
        $this->EMPLOYEED_DATE->AdvancedSearch->SearchValue = @$filter["x_EMPLOYEED_DATE"];
        $this->EMPLOYEED_DATE->AdvancedSearch->SearchOperator = @$filter["z_EMPLOYEED_DATE"];
        $this->EMPLOYEED_DATE->AdvancedSearch->SearchCondition = @$filter["v_EMPLOYEED_DATE"];
        $this->EMPLOYEED_DATE->AdvancedSearch->SearchValue2 = @$filter["y_EMPLOYEED_DATE"];
        $this->EMPLOYEED_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_EMPLOYEED_DATE"];
        $this->EMPLOYEED_DATE->AdvancedSearch->save();

        // Field EMP_TYPE
        $this->EMP_TYPE->AdvancedSearch->SearchValue = @$filter["x_EMP_TYPE"];
        $this->EMP_TYPE->AdvancedSearch->SearchOperator = @$filter["z_EMP_TYPE"];
        $this->EMP_TYPE->AdvancedSearch->SearchCondition = @$filter["v_EMP_TYPE"];
        $this->EMP_TYPE->AdvancedSearch->SearchValue2 = @$filter["y_EMP_TYPE"];
        $this->EMP_TYPE->AdvancedSearch->SearchOperator2 = @$filter["w_EMP_TYPE"];
        $this->EMP_TYPE->AdvancedSearch->save();

        // Field STATUS_ID
        $this->STATUS_ID->AdvancedSearch->SearchValue = @$filter["x_STATUS_ID"];
        $this->STATUS_ID->AdvancedSearch->SearchOperator = @$filter["z_STATUS_ID"];
        $this->STATUS_ID->AdvancedSearch->SearchCondition = @$filter["v_STATUS_ID"];
        $this->STATUS_ID->AdvancedSearch->SearchValue2 = @$filter["y_STATUS_ID"];
        $this->STATUS_ID->AdvancedSearch->SearchOperator2 = @$filter["w_STATUS_ID"];
        $this->STATUS_ID->AdvancedSearch->save();

        // Field CURRENT_GOLF_ID
        $this->CURRENT_GOLF_ID->AdvancedSearch->SearchValue = @$filter["x_CURRENT_GOLF_ID"];
        $this->CURRENT_GOLF_ID->AdvancedSearch->SearchOperator = @$filter["z_CURRENT_GOLF_ID"];
        $this->CURRENT_GOLF_ID->AdvancedSearch->SearchCondition = @$filter["v_CURRENT_GOLF_ID"];
        $this->CURRENT_GOLF_ID->AdvancedSearch->SearchValue2 = @$filter["y_CURRENT_GOLF_ID"];
        $this->CURRENT_GOLF_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CURRENT_GOLF_ID"];
        $this->CURRENT_GOLF_ID->AdvancedSearch->save();

        // Field FUNCTIONAL
        $this->FUNCTIONAL->AdvancedSearch->SearchValue = @$filter["x_FUNCTIONAL"];
        $this->FUNCTIONAL->AdvancedSearch->SearchOperator = @$filter["z_FUNCTIONAL"];
        $this->FUNCTIONAL->AdvancedSearch->SearchCondition = @$filter["v_FUNCTIONAL"];
        $this->FUNCTIONAL->AdvancedSearch->SearchValue2 = @$filter["y_FUNCTIONAL"];
        $this->FUNCTIONAL->AdvancedSearch->SearchOperator2 = @$filter["w_FUNCTIONAL"];
        $this->FUNCTIONAL->AdvancedSearch->save();

        // Field TOTAL_CCP
        $this->TOTAL_CCP->AdvancedSearch->SearchValue = @$filter["x_TOTAL_CCP"];
        $this->TOTAL_CCP->AdvancedSearch->SearchOperator = @$filter["z_TOTAL_CCP"];
        $this->TOTAL_CCP->AdvancedSearch->SearchCondition = @$filter["v_TOTAL_CCP"];
        $this->TOTAL_CCP->AdvancedSearch->SearchValue2 = @$filter["y_TOTAL_CCP"];
        $this->TOTAL_CCP->AdvancedSearch->SearchOperator2 = @$filter["w_TOTAL_CCP"];
        $this->TOTAL_CCP->AdvancedSearch->save();

        // Field PWORKING_PERIOD_TH
        $this->PWORKING_PERIOD_TH->AdvancedSearch->SearchValue = @$filter["x_PWORKING_PERIOD_TH"];
        $this->PWORKING_PERIOD_TH->AdvancedSearch->SearchOperator = @$filter["z_PWORKING_PERIOD_TH"];
        $this->PWORKING_PERIOD_TH->AdvancedSearch->SearchCondition = @$filter["v_PWORKING_PERIOD_TH"];
        $this->PWORKING_PERIOD_TH->AdvancedSearch->SearchValue2 = @$filter["y_PWORKING_PERIOD_TH"];
        $this->PWORKING_PERIOD_TH->AdvancedSearch->SearchOperator2 = @$filter["w_PWORKING_PERIOD_TH"];
        $this->PWORKING_PERIOD_TH->AdvancedSearch->save();

        // Field P_WORKING_PERIOD_BLN
        $this->P_WORKING_PERIOD_BLN->AdvancedSearch->SearchValue = @$filter["x_P_WORKING_PERIOD_BLN"];
        $this->P_WORKING_PERIOD_BLN->AdvancedSearch->SearchOperator = @$filter["z_P_WORKING_PERIOD_BLN"];
        $this->P_WORKING_PERIOD_BLN->AdvancedSearch->SearchCondition = @$filter["v_P_WORKING_PERIOD_BLN"];
        $this->P_WORKING_PERIOD_BLN->AdvancedSearch->SearchValue2 = @$filter["y_P_WORKING_PERIOD_BLN"];
        $this->P_WORKING_PERIOD_BLN->AdvancedSearch->SearchOperator2 = @$filter["w_P_WORKING_PERIOD_BLN"];
        $this->P_WORKING_PERIOD_BLN->AdvancedSearch->save();

        // Field RWORKING_PERIOD_TH
        $this->RWORKING_PERIOD_TH->AdvancedSearch->SearchValue = @$filter["x_RWORKING_PERIOD_TH"];
        $this->RWORKING_PERIOD_TH->AdvancedSearch->SearchOperator = @$filter["z_RWORKING_PERIOD_TH"];
        $this->RWORKING_PERIOD_TH->AdvancedSearch->SearchCondition = @$filter["v_RWORKING_PERIOD_TH"];
        $this->RWORKING_PERIOD_TH->AdvancedSearch->SearchValue2 = @$filter["y_RWORKING_PERIOD_TH"];
        $this->RWORKING_PERIOD_TH->AdvancedSearch->SearchOperator2 = @$filter["w_RWORKING_PERIOD_TH"];
        $this->RWORKING_PERIOD_TH->AdvancedSearch->save();

        // Field RWORKING_PERIOD_BLN
        $this->RWORKING_PERIOD_BLN->AdvancedSearch->SearchValue = @$filter["x_RWORKING_PERIOD_BLN"];
        $this->RWORKING_PERIOD_BLN->AdvancedSearch->SearchOperator = @$filter["z_RWORKING_PERIOD_BLN"];
        $this->RWORKING_PERIOD_BLN->AdvancedSearch->SearchCondition = @$filter["v_RWORKING_PERIOD_BLN"];
        $this->RWORKING_PERIOD_BLN->AdvancedSearch->SearchValue2 = @$filter["y_RWORKING_PERIOD_BLN"];
        $this->RWORKING_PERIOD_BLN->AdvancedSearch->SearchOperator2 = @$filter["w_RWORKING_PERIOD_BLN"];
        $this->RWORKING_PERIOD_BLN->AdvancedSearch->save();

        // Field CURRENT_GOL_ID
        $this->CURRENT_GOL_ID->AdvancedSearch->SearchValue = @$filter["x_CURRENT_GOL_ID"];
        $this->CURRENT_GOL_ID->AdvancedSearch->SearchOperator = @$filter["z_CURRENT_GOL_ID"];
        $this->CURRENT_GOL_ID->AdvancedSearch->SearchCondition = @$filter["v_CURRENT_GOL_ID"];
        $this->CURRENT_GOL_ID->AdvancedSearch->SearchValue2 = @$filter["y_CURRENT_GOL_ID"];
        $this->CURRENT_GOL_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CURRENT_GOL_ID"];
        $this->CURRENT_GOL_ID->AdvancedSearch->save();

        // Field GWORKING_PERIOD_TH
        $this->GWORKING_PERIOD_TH->AdvancedSearch->SearchValue = @$filter["x_GWORKING_PERIOD_TH"];
        $this->GWORKING_PERIOD_TH->AdvancedSearch->SearchOperator = @$filter["z_GWORKING_PERIOD_TH"];
        $this->GWORKING_PERIOD_TH->AdvancedSearch->SearchCondition = @$filter["v_GWORKING_PERIOD_TH"];
        $this->GWORKING_PERIOD_TH->AdvancedSearch->SearchValue2 = @$filter["y_GWORKING_PERIOD_TH"];
        $this->GWORKING_PERIOD_TH->AdvancedSearch->SearchOperator2 = @$filter["w_GWORKING_PERIOD_TH"];
        $this->GWORKING_PERIOD_TH->AdvancedSearch->save();

        // Field GWORKING_PERIOD_BLN
        $this->GWORKING_PERIOD_BLN->AdvancedSearch->SearchValue = @$filter["x_GWORKING_PERIOD_BLN"];
        $this->GWORKING_PERIOD_BLN->AdvancedSearch->SearchOperator = @$filter["z_GWORKING_PERIOD_BLN"];
        $this->GWORKING_PERIOD_BLN->AdvancedSearch->SearchCondition = @$filter["v_GWORKING_PERIOD_BLN"];
        $this->GWORKING_PERIOD_BLN->AdvancedSearch->SearchValue2 = @$filter["y_GWORKING_PERIOD_BLN"];
        $this->GWORKING_PERIOD_BLN->AdvancedSearch->SearchOperator2 = @$filter["w_GWORKING_PERIOD_BLN"];
        $this->GWORKING_PERIOD_BLN->AdvancedSearch->save();

        // Field EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchValue = @$filter["x_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchOperator = @$filter["z_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchCondition = @$filter["v_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchValue2 = @$filter["y_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchOperator2 = @$filter["w_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->save();

        // Field NPWP
        $this->NPWP->AdvancedSearch->SearchValue = @$filter["x_NPWP"];
        $this->NPWP->AdvancedSearch->SearchOperator = @$filter["z_NPWP"];
        $this->NPWP->AdvancedSearch->SearchCondition = @$filter["v_NPWP"];
        $this->NPWP->AdvancedSearch->SearchValue2 = @$filter["y_NPWP"];
        $this->NPWP->AdvancedSearch->SearchOperator2 = @$filter["w_NPWP"];
        $this->NPWP->AdvancedSearch->save();

        // Field NATION_ID
        $this->NATION_ID->AdvancedSearch->SearchValue = @$filter["x_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->SearchOperator = @$filter["z_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->SearchCondition = @$filter["v_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->SearchValue2 = @$filter["y_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->SearchOperator2 = @$filter["w_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->save();

        // Field PAID_ID
        $this->PAID_ID->AdvancedSearch->SearchValue = @$filter["x_PAID_ID"];
        $this->PAID_ID->AdvancedSearch->SearchOperator = @$filter["z_PAID_ID"];
        $this->PAID_ID->AdvancedSearch->SearchCondition = @$filter["v_PAID_ID"];
        $this->PAID_ID->AdvancedSearch->SearchValue2 = @$filter["y_PAID_ID"];
        $this->PAID_ID->AdvancedSearch->SearchOperator2 = @$filter["w_PAID_ID"];
        $this->PAID_ID->AdvancedSearch->save();

        // Field NONACTIVE
        $this->NONACTIVE->AdvancedSearch->SearchValue = @$filter["x_NONACTIVE"];
        $this->NONACTIVE->AdvancedSearch->SearchOperator = @$filter["z_NONACTIVE"];
        $this->NONACTIVE->AdvancedSearch->SearchCondition = @$filter["v_NONACTIVE"];
        $this->NONACTIVE->AdvancedSearch->SearchValue2 = @$filter["y_NONACTIVE"];
        $this->NONACTIVE->AdvancedSearch->SearchOperator2 = @$filter["w_NONACTIVE"];
        $this->NONACTIVE->AdvancedSearch->save();

        // Field NONACTIVE_DATE
        $this->NONACTIVE_DATE->AdvancedSearch->SearchValue = @$filter["x_NONACTIVE_DATE"];
        $this->NONACTIVE_DATE->AdvancedSearch->SearchOperator = @$filter["z_NONACTIVE_DATE"];
        $this->NONACTIVE_DATE->AdvancedSearch->SearchCondition = @$filter["v_NONACTIVE_DATE"];
        $this->NONACTIVE_DATE->AdvancedSearch->SearchValue2 = @$filter["y_NONACTIVE_DATE"];
        $this->NONACTIVE_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_NONACTIVE_DATE"];
        $this->NONACTIVE_DATE->AdvancedSearch->save();

        // Field NON_ACTIVE_TYPE
        $this->NON_ACTIVE_TYPE->AdvancedSearch->SearchValue = @$filter["x_NON_ACTIVE_TYPE"];
        $this->NON_ACTIVE_TYPE->AdvancedSearch->SearchOperator = @$filter["z_NON_ACTIVE_TYPE"];
        $this->NON_ACTIVE_TYPE->AdvancedSearch->SearchCondition = @$filter["v_NON_ACTIVE_TYPE"];
        $this->NON_ACTIVE_TYPE->AdvancedSearch->SearchValue2 = @$filter["y_NON_ACTIVE_TYPE"];
        $this->NON_ACTIVE_TYPE->AdvancedSearch->SearchOperator2 = @$filter["w_NON_ACTIVE_TYPE"];
        $this->NON_ACTIVE_TYPE->AdvancedSearch->save();

        // Field PENSION_DATE
        $this->PENSION_DATE->AdvancedSearch->SearchValue = @$filter["x_PENSION_DATE"];
        $this->PENSION_DATE->AdvancedSearch->SearchOperator = @$filter["z_PENSION_DATE"];
        $this->PENSION_DATE->AdvancedSearch->SearchCondition = @$filter["v_PENSION_DATE"];
        $this->PENSION_DATE->AdvancedSearch->SearchValue2 = @$filter["y_PENSION_DATE"];
        $this->PENSION_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_PENSION_DATE"];
        $this->PENSION_DATE->AdvancedSearch->save();

        // Field MORTGAGEYEAR
        $this->MORTGAGEYEAR->AdvancedSearch->SearchValue = @$filter["x_MORTGAGEYEAR"];
        $this->MORTGAGEYEAR->AdvancedSearch->SearchOperator = @$filter["z_MORTGAGEYEAR"];
        $this->MORTGAGEYEAR->AdvancedSearch->SearchCondition = @$filter["v_MORTGAGEYEAR"];
        $this->MORTGAGEYEAR->AdvancedSearch->SearchValue2 = @$filter["y_MORTGAGEYEAR"];
        $this->MORTGAGEYEAR->AdvancedSearch->SearchOperator2 = @$filter["w_MORTGAGEYEAR"];
        $this->MORTGAGEYEAR->AdvancedSearch->save();

        // Field MODIFIED_DATE
        $this->MODIFIED_DATE->AdvancedSearch->SearchValue = @$filter["x_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->SearchOperator = @$filter["z_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->SearchCondition = @$filter["v_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->SearchValue2 = @$filter["y_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_MODIFIED_DATE"];
        $this->MODIFIED_DATE->AdvancedSearch->save();

        // Field MODIFIED_BY
        $this->MODIFIED_BY->AdvancedSearch->SearchValue = @$filter["x_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->SearchOperator = @$filter["z_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->SearchCondition = @$filter["v_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->SearchValue2 = @$filter["y_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->SearchOperator2 = @$filter["w_MODIFIED_BY"];
        $this->MODIFIED_BY->AdvancedSearch->save();

        // Field PICTUREFILE
        $this->PICTUREFILE->AdvancedSearch->SearchValue = @$filter["x_PICTUREFILE"];
        $this->PICTUREFILE->AdvancedSearch->SearchOperator = @$filter["z_PICTUREFILE"];
        $this->PICTUREFILE->AdvancedSearch->SearchCondition = @$filter["v_PICTUREFILE"];
        $this->PICTUREFILE->AdvancedSearch->SearchValue2 = @$filter["y_PICTUREFILE"];
        $this->PICTUREFILE->AdvancedSearch->SearchOperator2 = @$filter["w_PICTUREFILE"];
        $this->PICTUREFILE->AdvancedSearch->save();

        // Field FINGERSCANFILE
        $this->FINGERSCANFILE->AdvancedSearch->SearchValue = @$filter["x_FINGERSCANFILE"];
        $this->FINGERSCANFILE->AdvancedSearch->SearchOperator = @$filter["z_FINGERSCANFILE"];
        $this->FINGERSCANFILE->AdvancedSearch->SearchCondition = @$filter["v_FINGERSCANFILE"];
        $this->FINGERSCANFILE->AdvancedSearch->SearchValue2 = @$filter["y_FINGERSCANFILE"];
        $this->FINGERSCANFILE->AdvancedSearch->SearchOperator2 = @$filter["w_FINGERSCANFILE"];
        $this->FINGERSCANFILE->AdvancedSearch->save();

        // Field ISFULLTIME
        $this->ISFULLTIME->AdvancedSearch->SearchValue = @$filter["x_ISFULLTIME"];
        $this->ISFULLTIME->AdvancedSearch->SearchOperator = @$filter["z_ISFULLTIME"];
        $this->ISFULLTIME->AdvancedSearch->SearchCondition = @$filter["v_ISFULLTIME"];
        $this->ISFULLTIME->AdvancedSearch->SearchValue2 = @$filter["y_ISFULLTIME"];
        $this->ISFULLTIME->AdvancedSearch->SearchOperator2 = @$filter["w_ISFULLTIME"];
        $this->ISFULLTIME->AdvancedSearch->save();

        // Field SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID->AdvancedSearch->SearchValue = @$filter["x_SPECIALIST_TYPE_ID"];
        $this->SPECIALIST_TYPE_ID->AdvancedSearch->SearchOperator = @$filter["z_SPECIALIST_TYPE_ID"];
        $this->SPECIALIST_TYPE_ID->AdvancedSearch->SearchCondition = @$filter["v_SPECIALIST_TYPE_ID"];
        $this->SPECIALIST_TYPE_ID->AdvancedSearch->SearchValue2 = @$filter["y_SPECIALIST_TYPE_ID"];
        $this->SPECIALIST_TYPE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_SPECIALIST_TYPE_ID"];
        $this->SPECIALIST_TYPE_ID->AdvancedSearch->save();

        // Field BANK_ID
        $this->BANK_ID->AdvancedSearch->SearchValue = @$filter["x_BANK_ID"];
        $this->BANK_ID->AdvancedSearch->SearchOperator = @$filter["z_BANK_ID"];
        $this->BANK_ID->AdvancedSearch->SearchCondition = @$filter["v_BANK_ID"];
        $this->BANK_ID->AdvancedSearch->SearchValue2 = @$filter["y_BANK_ID"];
        $this->BANK_ID->AdvancedSearch->SearchOperator2 = @$filter["w_BANK_ID"];
        $this->BANK_ID->AdvancedSearch->save();

        // Field BANK_ACCOUNT
        $this->BANK_ACCOUNT->AdvancedSearch->SearchValue = @$filter["x_BANK_ACCOUNT"];
        $this->BANK_ACCOUNT->AdvancedSearch->SearchOperator = @$filter["z_BANK_ACCOUNT"];
        $this->BANK_ACCOUNT->AdvancedSearch->SearchCondition = @$filter["v_BANK_ACCOUNT"];
        $this->BANK_ACCOUNT->AdvancedSearch->SearchValue2 = @$filter["y_BANK_ACCOUNT"];
        $this->BANK_ACCOUNT->AdvancedSearch->SearchOperator2 = @$filter["w_BANK_ACCOUNT"];
        $this->BANK_ACCOUNT->AdvancedSearch->save();

        // Field NPK
        $this->NPK->AdvancedSearch->SearchValue = @$filter["x_NPK"];
        $this->NPK->AdvancedSearch->SearchOperator = @$filter["z_NPK"];
        $this->NPK->AdvancedSearch->SearchCondition = @$filter["v_NPK"];
        $this->NPK->AdvancedSearch->SearchValue2 = @$filter["y_NPK"];
        $this->NPK->AdvancedSearch->SearchOperator2 = @$filter["w_NPK"];
        $this->NPK->AdvancedSearch->save();

        // Field OTHER_ADDRESS
        $this->OTHER_ADDRESS->AdvancedSearch->SearchValue = @$filter["x_OTHER_ADDRESS"];
        $this->OTHER_ADDRESS->AdvancedSearch->SearchOperator = @$filter["z_OTHER_ADDRESS"];
        $this->OTHER_ADDRESS->AdvancedSearch->SearchCondition = @$filter["v_OTHER_ADDRESS"];
        $this->OTHER_ADDRESS->AdvancedSearch->SearchValue2 = @$filter["y_OTHER_ADDRESS"];
        $this->OTHER_ADDRESS->AdvancedSearch->SearchOperator2 = @$filter["w_OTHER_ADDRESS"];
        $this->OTHER_ADDRESS->AdvancedSearch->save();

        // Field DEATH_DATE
        $this->DEATH_DATE->AdvancedSearch->SearchValue = @$filter["x_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->SearchOperator = @$filter["z_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->SearchCondition = @$filter["v_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->SearchValue2 = @$filter["y_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->save();

        // Field WEBSITE
        $this->WEBSITE->AdvancedSearch->SearchValue = @$filter["x_WEBSITE"];
        $this->WEBSITE->AdvancedSearch->SearchOperator = @$filter["z_WEBSITE"];
        $this->WEBSITE->AdvancedSearch->SearchCondition = @$filter["v_WEBSITE"];
        $this->WEBSITE->AdvancedSearch->SearchValue2 = @$filter["y_WEBSITE"];
        $this->WEBSITE->AdvancedSearch->SearchOperator2 = @$filter["w_WEBSITE"];
        $this->WEBSITE->AdvancedSearch->save();

        // Field NIP
        $this->NIP->AdvancedSearch->SearchValue = @$filter["x_NIP"];
        $this->NIP->AdvancedSearch->SearchOperator = @$filter["z_NIP"];
        $this->NIP->AdvancedSearch->SearchCondition = @$filter["v_NIP"];
        $this->NIP->AdvancedSearch->SearchValue2 = @$filter["y_NIP"];
        $this->NIP->AdvancedSearch->SearchOperator2 = @$filter["w_NIP"];
        $this->NIP->AdvancedSearch->save();

        // Field DPJP
        $this->DPJP->AdvancedSearch->SearchValue = @$filter["x_DPJP"];
        $this->DPJP->AdvancedSearch->SearchOperator = @$filter["z_DPJP"];
        $this->DPJP->AdvancedSearch->SearchCondition = @$filter["v_DPJP"];
        $this->DPJP->AdvancedSearch->SearchValue2 = @$filter["y_DPJP"];
        $this->DPJP->AdvancedSearch->SearchOperator2 = @$filter["w_DPJP"];
        $this->DPJP->AdvancedSearch->save();

        // Field SK_NO
        $this->SK_NO->AdvancedSearch->SearchValue = @$filter["x_SK_NO"];
        $this->SK_NO->AdvancedSearch->SearchOperator = @$filter["z_SK_NO"];
        $this->SK_NO->AdvancedSearch->SearchCondition = @$filter["v_SK_NO"];
        $this->SK_NO->AdvancedSearch->SearchValue2 = @$filter["y_SK_NO"];
        $this->SK_NO->AdvancedSearch->SearchOperator2 = @$filter["w_SK_NO"];
        $this->SK_NO->AdvancedSearch->save();

        // Field SK_TMT
        $this->SK_TMT->AdvancedSearch->SearchValue = @$filter["x_SK_TMT"];
        $this->SK_TMT->AdvancedSearch->SearchOperator = @$filter["z_SK_TMT"];
        $this->SK_TMT->AdvancedSearch->SearchCondition = @$filter["v_SK_TMT"];
        $this->SK_TMT->AdvancedSearch->SearchValue2 = @$filter["y_SK_TMT"];
        $this->SK_TMT->AdvancedSearch->SearchOperator2 = @$filter["w_SK_TMT"];
        $this->SK_TMT->AdvancedSearch->save();

        // Field SK_TAT
        $this->SK_TAT->AdvancedSearch->SearchValue = @$filter["x_SK_TAT"];
        $this->SK_TAT->AdvancedSearch->SearchOperator = @$filter["z_SK_TAT"];
        $this->SK_TAT->AdvancedSearch->SearchCondition = @$filter["v_SK_TAT"];
        $this->SK_TAT->AdvancedSearch->SearchValue2 = @$filter["y_SK_TAT"];
        $this->SK_TAT->AdvancedSearch->SearchOperator2 = @$filter["w_SK_TAT"];
        $this->SK_TAT->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->DESCRIPTION, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ORG_UNIT_CODE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->EMPLOYEE_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->MYADDRESS, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->POSTAL_CODE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->RT, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->RW, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->KAL_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->KEC_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->KODE_KOTA, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->PROVINCE_CODE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->COUNTRY_CODE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->PHONE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->FAX, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->_EMAIL, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->HANDPHONE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->KARPEG, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->KARIS, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ASKES, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->TASPEN, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->FULLNAME, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->GELAR_DEPAN, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->GELAR_BELAKANG, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->NICKNAME, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->PLACEOFBIRTH, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->GENDER, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ORG_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->KODE_JABATAN, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->CURRENT_GOLF_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->FUNCTIONAL, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->CURRENT_GOL_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->NPWP, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->PAID_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->NONACTIVE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->MODIFIED_BY, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->PICTUREFILE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->FINGERSCANFILE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->ISFULLTIME, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->SPECIALIST_TYPE_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->BANK_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->BANK_ACCOUNT, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->NPK, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->OTHER_ADDRESS, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->WEBSITE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->NIP, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->DPJP, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->SK_NO, $arKeywords, $type);
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
        return false;
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
            $this->updateSort($this->FULLNAME); // FULLNAME
            $this->updateSort($this->GENDER); // GENDER
            $this->updateSort($this->ORG_ID); // ORG_ID
            $this->updateSort($this->SPECIALIST_TYPE_ID); // SPECIALIST_TYPE_ID
            $this->updateSort($this->NIP); // NIP
            $this->updateSort($this->DPJP); // DPJP
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
                $this->DESCRIPTION->setSort("");
                $this->OBJECT_CATEGORY_ID->setSort("");
                $this->ORG_UNIT_CODE->setSort("");
                $this->EMPLOYEE_ID->setSort("");
                $this->MYADDRESS->setSort("");
                $this->POSTAL_CODE->setSort("");
                $this->RT->setSort("");
                $this->RW->setSort("");
                $this->KAL_ID->setSort("");
                $this->KEC_ID->setSort("");
                $this->KODE_KOTA->setSort("");
                $this->PROVINCE_CODE->setSort("");
                $this->COUNTRY_CODE->setSort("");
                $this->PHONE->setSort("");
                $this->FAX->setSort("");
                $this->_EMAIL->setSort("");
                $this->HANDPHONE->setSort("");
                $this->KARPEG->setSort("");
                $this->KARIS->setSort("");
                $this->ASKES->setSort("");
                $this->TASPEN->setSort("");
                $this->FULLNAME->setSort("");
                $this->GELAR_DEPAN->setSort("");
                $this->GELAR_BELAKANG->setSort("");
                $this->NICKNAME->setSort("");
                $this->PLACEOFBIRTH->setSort("");
                $this->DATEOFBIRTH->setSort("");
                $this->KODE_AGAMA->setSort("");
                $this->GENDER->setSort("");
                $this->MARITALSTATUSID->setSort("");
                $this->BLOOD_ID->setSort("");
                $this->ORG_ID->setSort("");
                $this->KODE_JABATAN->setSort("");
                $this->EMPLOYEED_DATE->setSort("");
                $this->EMP_TYPE->setSort("");
                $this->STATUS_ID->setSort("");
                $this->CURRENT_GOLF_ID->setSort("");
                $this->FUNCTIONAL->setSort("");
                $this->TOTAL_CCP->setSort("");
                $this->PWORKING_PERIOD_TH->setSort("");
                $this->P_WORKING_PERIOD_BLN->setSort("");
                $this->RWORKING_PERIOD_TH->setSort("");
                $this->RWORKING_PERIOD_BLN->setSort("");
                $this->CURRENT_GOL_ID->setSort("");
                $this->GWORKING_PERIOD_TH->setSort("");
                $this->GWORKING_PERIOD_BLN->setSort("");
                $this->EDUCATION_TYPE_CODE->setSort("");
                $this->NPWP->setSort("");
                $this->NATION_ID->setSort("");
                $this->PAID_ID->setSort("");
                $this->NONACTIVE->setSort("");
                $this->NONACTIVE_DATE->setSort("");
                $this->NON_ACTIVE_TYPE->setSort("");
                $this->PENSION_DATE->setSort("");
                $this->MORTGAGEYEAR->setSort("");
                $this->MODIFIED_DATE->setSort("");
                $this->MODIFIED_BY->setSort("");
                $this->PICTUREFILE->setSort("");
                $this->FINGERSCANFILE->setSort("");
                $this->ISFULLTIME->setSort("");
                $this->SPECIALIST_TYPE_ID->setSort("");
                $this->BANK_ID->setSort("");
                $this->BANK_ACCOUNT->setSort("");
                $this->NPK->setSort("");
                $this->OTHER_ADDRESS->setSort("");
                $this->DEATH_DATE->setSort("");
                $this->WEBSITE->setSort("");
                $this->NIP->setSort("");
                $this->DPJP->setSort("");
                $this->SK_NO->setSort("");
                $this->SK_TMT->setSort("");
                $this->SK_TAT->setSort("");
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
        if ($this->CurrentMode == "view") { // View mode
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
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ORG_UNIT_CODE->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->EMPLOYEE_ID->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fEMPLOYEE_ALLlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fEMPLOYEE_ALLlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fEMPLOYEE_ALLlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->OBJECT_CATEGORY_ID->setDbValue($row['OBJECT_CATEGORY_ID']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->MYADDRESS->setDbValue($row['MYADDRESS']);
        $this->POSTAL_CODE->setDbValue($row['POSTAL_CODE']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->KEC_ID->setDbValue($row['KEC_ID']);
        $this->KODE_KOTA->setDbValue($row['KODE_KOTA']);
        $this->PROVINCE_CODE->setDbValue($row['PROVINCE_CODE']);
        $this->COUNTRY_CODE->setDbValue($row['COUNTRY_CODE']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->FAX->setDbValue($row['FAX']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->HANDPHONE->setDbValue($row['HANDPHONE']);
        $this->KARPEG->setDbValue($row['KARPEG']);
        $this->KARIS->setDbValue($row['KARIS']);
        $this->ASKES->setDbValue($row['ASKES']);
        $this->TASPEN->setDbValue($row['TASPEN']);
        $this->FULLNAME->setDbValue($row['FULLNAME']);
        $this->GELAR_DEPAN->setDbValue($row['GELAR_DEPAN']);
        $this->GELAR_BELAKANG->setDbValue($row['GELAR_BELAKANG']);
        $this->NICKNAME->setDbValue($row['NICKNAME']);
        $this->PLACEOFBIRTH->setDbValue($row['PLACEOFBIRTH']);
        $this->DATEOFBIRTH->setDbValue($row['DATEOFBIRTH']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->BLOOD_ID->setDbValue($row['BLOOD_ID']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->KODE_JABATAN->setDbValue($row['KODE_JABATAN']);
        $this->EMPLOYEED_DATE->setDbValue($row['EMPLOYEED_DATE']);
        $this->EMP_TYPE->setDbValue($row['EMP_TYPE']);
        $this->STATUS_ID->setDbValue($row['STATUS_ID']);
        $this->CURRENT_GOLF_ID->setDbValue($row['CURRENT_GOLF_ID']);
        $this->FUNCTIONAL->setDbValue($row['FUNCTIONAL']);
        $this->TOTAL_CCP->setDbValue($row['TOTAL_CCP']);
        $this->PWORKING_PERIOD_TH->setDbValue($row['PWORKING_PERIOD_TH']);
        $this->P_WORKING_PERIOD_BLN->setDbValue($row['P_WORKING_PERIOD_BLN']);
        $this->RWORKING_PERIOD_TH->setDbValue($row['RWORKING_PERIOD_TH']);
        $this->RWORKING_PERIOD_BLN->setDbValue($row['RWORKING_PERIOD_BLN']);
        $this->CURRENT_GOL_ID->setDbValue($row['CURRENT_GOL_ID']);
        $this->GWORKING_PERIOD_TH->setDbValue($row['GWORKING_PERIOD_TH']);
        $this->GWORKING_PERIOD_BLN->setDbValue($row['GWORKING_PERIOD_BLN']);
        $this->EDUCATION_TYPE_CODE->setDbValue($row['EDUCATION_TYPE_CODE']);
        $this->NPWP->setDbValue($row['NPWP']);
        $this->NATION_ID->setDbValue($row['NATION_ID']);
        $this->PAID_ID->setDbValue($row['PAID_ID']);
        $this->NONACTIVE->setDbValue($row['NONACTIVE']);
        $this->NONACTIVE_DATE->setDbValue($row['NONACTIVE_DATE']);
        $this->NON_ACTIVE_TYPE->setDbValue($row['NON_ACTIVE_TYPE']);
        $this->PENSION_DATE->setDbValue($row['PENSION_DATE']);
        $this->MORTGAGEYEAR->setDbValue($row['MORTGAGEYEAR']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->PICTUREFILE->setDbValue($row['PICTUREFILE']);
        $this->FINGERSCANFILE->setDbValue($row['FINGERSCANFILE']);
        $this->ISFULLTIME->setDbValue($row['ISFULLTIME']);
        $this->SPECIALIST_TYPE_ID->setDbValue($row['SPECIALIST_TYPE_ID']);
        $this->BANK_ID->setDbValue($row['BANK_ID']);
        $this->BANK_ACCOUNT->setDbValue($row['BANK_ACCOUNT']);
        $this->NPK->setDbValue($row['NPK']);
        $this->OTHER_ADDRESS->setDbValue($row['OTHER_ADDRESS']);
        $this->DEATH_DATE->setDbValue($row['DEATH_DATE']);
        $this->WEBSITE->setDbValue($row['WEBSITE']);
        $this->NIP->setDbValue($row['NIP']);
        $this->DPJP->setDbValue($row['DPJP']);
        $this->SK_NO->setDbValue($row['SK_NO']);
        $this->SK_TMT->setDbValue($row['SK_TMT']);
        $this->SK_TAT->setDbValue($row['SK_TAT']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['DESCRIPTION'] = null;
        $row['OBJECT_CATEGORY_ID'] = null;
        $row['ORG_UNIT_CODE'] = null;
        $row['EMPLOYEE_ID'] = null;
        $row['MYADDRESS'] = null;
        $row['POSTAL_CODE'] = null;
        $row['RT'] = null;
        $row['RW'] = null;
        $row['KAL_ID'] = null;
        $row['KEC_ID'] = null;
        $row['KODE_KOTA'] = null;
        $row['PROVINCE_CODE'] = null;
        $row['COUNTRY_CODE'] = null;
        $row['PHONE'] = null;
        $row['FAX'] = null;
        $row['EMAIL'] = null;
        $row['HANDPHONE'] = null;
        $row['KARPEG'] = null;
        $row['KARIS'] = null;
        $row['ASKES'] = null;
        $row['TASPEN'] = null;
        $row['FULLNAME'] = null;
        $row['GELAR_DEPAN'] = null;
        $row['GELAR_BELAKANG'] = null;
        $row['NICKNAME'] = null;
        $row['PLACEOFBIRTH'] = null;
        $row['DATEOFBIRTH'] = null;
        $row['KODE_AGAMA'] = null;
        $row['GENDER'] = null;
        $row['MARITALSTATUSID'] = null;
        $row['BLOOD_ID'] = null;
        $row['ORG_ID'] = null;
        $row['KODE_JABATAN'] = null;
        $row['EMPLOYEED_DATE'] = null;
        $row['EMP_TYPE'] = null;
        $row['STATUS_ID'] = null;
        $row['CURRENT_GOLF_ID'] = null;
        $row['FUNCTIONAL'] = null;
        $row['TOTAL_CCP'] = null;
        $row['PWORKING_PERIOD_TH'] = null;
        $row['P_WORKING_PERIOD_BLN'] = null;
        $row['RWORKING_PERIOD_TH'] = null;
        $row['RWORKING_PERIOD_BLN'] = null;
        $row['CURRENT_GOL_ID'] = null;
        $row['GWORKING_PERIOD_TH'] = null;
        $row['GWORKING_PERIOD_BLN'] = null;
        $row['EDUCATION_TYPE_CODE'] = null;
        $row['NPWP'] = null;
        $row['NATION_ID'] = null;
        $row['PAID_ID'] = null;
        $row['NONACTIVE'] = null;
        $row['NONACTIVE_DATE'] = null;
        $row['NON_ACTIVE_TYPE'] = null;
        $row['PENSION_DATE'] = null;
        $row['MORTGAGEYEAR'] = null;
        $row['MODIFIED_DATE'] = null;
        $row['MODIFIED_BY'] = null;
        $row['PICTUREFILE'] = null;
        $row['FINGERSCANFILE'] = null;
        $row['ISFULLTIME'] = null;
        $row['SPECIALIST_TYPE_ID'] = null;
        $row['BANK_ID'] = null;
        $row['BANK_ACCOUNT'] = null;
        $row['NPK'] = null;
        $row['OTHER_ADDRESS'] = null;
        $row['DEATH_DATE'] = null;
        $row['WEBSITE'] = null;
        $row['NIP'] = null;
        $row['DPJP'] = null;
        $row['SK_NO'] = null;
        $row['SK_TMT'] = null;
        $row['SK_TAT'] = null;
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

        // DESCRIPTION

        // OBJECT_CATEGORY_ID

        // ORG_UNIT_CODE

        // EMPLOYEE_ID

        // MYADDRESS

        // POSTAL_CODE

        // RT

        // RW

        // KAL_ID

        // KEC_ID

        // KODE_KOTA

        // PROVINCE_CODE

        // COUNTRY_CODE

        // PHONE

        // FAX

        // EMAIL

        // HANDPHONE

        // KARPEG

        // KARIS

        // ASKES

        // TASPEN

        // FULLNAME

        // GELAR_DEPAN

        // GELAR_BELAKANG

        // NICKNAME

        // PLACEOFBIRTH

        // DATEOFBIRTH

        // KODE_AGAMA

        // GENDER

        // MARITALSTATUSID

        // BLOOD_ID

        // ORG_ID

        // KODE_JABATAN

        // EMPLOYEED_DATE

        // EMP_TYPE

        // STATUS_ID

        // CURRENT_GOLF_ID

        // FUNCTIONAL

        // TOTAL_CCP

        // PWORKING_PERIOD_TH

        // P_WORKING_PERIOD_BLN

        // RWORKING_PERIOD_TH

        // RWORKING_PERIOD_BLN

        // CURRENT_GOL_ID

        // GWORKING_PERIOD_TH

        // GWORKING_PERIOD_BLN

        // EDUCATION_TYPE_CODE

        // NPWP

        // NATION_ID

        // PAID_ID

        // NONACTIVE

        // NONACTIVE_DATE

        // NON_ACTIVE_TYPE

        // PENSION_DATE

        // MORTGAGEYEAR

        // MODIFIED_DATE

        // MODIFIED_BY

        // PICTUREFILE

        // FINGERSCANFILE

        // ISFULLTIME

        // SPECIALIST_TYPE_ID

        // BANK_ID

        // BANK_ACCOUNT

        // NPK

        // OTHER_ADDRESS

        // DEATH_DATE

        // WEBSITE

        // NIP

        // DPJP

        // SK_NO

        // SK_TMT

        // SK_TAT
        if ($this->RowType == ROWTYPE_VIEW) {
            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // OBJECT_CATEGORY_ID
            $this->OBJECT_CATEGORY_ID->ViewValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
            $this->OBJECT_CATEGORY_ID->ViewValue = FormatNumber($this->OBJECT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
            $this->OBJECT_CATEGORY_ID->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
            $this->EMPLOYEE_ID->ViewCustomAttributes = "";

            // MYADDRESS
            $this->MYADDRESS->ViewValue = $this->MYADDRESS->CurrentValue;
            $this->MYADDRESS->ViewCustomAttributes = "";

            // POSTAL_CODE
            $this->POSTAL_CODE->ViewValue = $this->POSTAL_CODE->CurrentValue;
            $this->POSTAL_CODE->ViewCustomAttributes = "";

            // RT
            $this->RT->ViewValue = $this->RT->CurrentValue;
            $this->RT->ViewCustomAttributes = "";

            // RW
            $this->RW->ViewValue = $this->RW->CurrentValue;
            $this->RW->ViewCustomAttributes = "";

            // KAL_ID
            $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
            $this->KAL_ID->ViewCustomAttributes = "";

            // KEC_ID
            $this->KEC_ID->ViewValue = $this->KEC_ID->CurrentValue;
            $this->KEC_ID->ViewCustomAttributes = "";

            // KODE_KOTA
            $this->KODE_KOTA->ViewValue = $this->KODE_KOTA->CurrentValue;
            $this->KODE_KOTA->ViewCustomAttributes = "";

            // PROVINCE_CODE
            $this->PROVINCE_CODE->ViewValue = $this->PROVINCE_CODE->CurrentValue;
            $this->PROVINCE_CODE->ViewCustomAttributes = "";

            // COUNTRY_CODE
            $this->COUNTRY_CODE->ViewValue = $this->COUNTRY_CODE->CurrentValue;
            $this->COUNTRY_CODE->ViewCustomAttributes = "";

            // PHONE
            $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
            $this->PHONE->ViewCustomAttributes = "";

            // FAX
            $this->FAX->ViewValue = $this->FAX->CurrentValue;
            $this->FAX->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // HANDPHONE
            $this->HANDPHONE->ViewValue = $this->HANDPHONE->CurrentValue;
            $this->HANDPHONE->ViewCustomAttributes = "";

            // KARPEG
            $this->KARPEG->ViewValue = $this->KARPEG->CurrentValue;
            $this->KARPEG->ViewCustomAttributes = "";

            // KARIS
            $this->KARIS->ViewValue = $this->KARIS->CurrentValue;
            $this->KARIS->ViewCustomAttributes = "";

            // ASKES
            $this->ASKES->ViewValue = $this->ASKES->CurrentValue;
            $this->ASKES->ViewCustomAttributes = "";

            // TASPEN
            $this->TASPEN->ViewValue = $this->TASPEN->CurrentValue;
            $this->TASPEN->ViewCustomAttributes = "";

            // FULLNAME
            $this->FULLNAME->ViewValue = $this->FULLNAME->CurrentValue;
            $this->FULLNAME->ViewCustomAttributes = "";

            // GELAR_DEPAN
            $this->GELAR_DEPAN->ViewValue = $this->GELAR_DEPAN->CurrentValue;
            $this->GELAR_DEPAN->ViewCustomAttributes = "";

            // GELAR_BELAKANG
            $this->GELAR_BELAKANG->ViewValue = $this->GELAR_BELAKANG->CurrentValue;
            $this->GELAR_BELAKANG->ViewCustomAttributes = "";

            // NICKNAME
            $this->NICKNAME->ViewValue = $this->NICKNAME->CurrentValue;
            $this->NICKNAME->ViewCustomAttributes = "";

            // PLACEOFBIRTH
            $this->PLACEOFBIRTH->ViewValue = $this->PLACEOFBIRTH->CurrentValue;
            $this->PLACEOFBIRTH->ViewCustomAttributes = "";

            // DATEOFBIRTH
            $this->DATEOFBIRTH->ViewValue = $this->DATEOFBIRTH->CurrentValue;
            $this->DATEOFBIRTH->ViewValue = FormatDateTime($this->DATEOFBIRTH->ViewValue, 0);
            $this->DATEOFBIRTH->ViewCustomAttributes = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->CurrentValue;
            $this->KODE_AGAMA->ViewValue = FormatNumber($this->KODE_AGAMA->ViewValue, 0, -2, -2, -2);
            $this->KODE_AGAMA->ViewCustomAttributes = "";

            // GENDER
            $curVal = trim(strval($this->GENDER->CurrentValue));
            if ($curVal != "") {
                $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
                if ($this->GENDER->ViewValue === null) { // Lookup from database
                    $filterWrk = "[GENDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->GENDER->Lookup->getSql(false, $filterWrk, '', $this, true, true);
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

            // MARITALSTATUSID
            $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
            $this->MARITALSTATUSID->ViewValue = FormatNumber($this->MARITALSTATUSID->ViewValue, 0, -2, -2, -2);
            $this->MARITALSTATUSID->ViewCustomAttributes = "";

            // BLOOD_ID
            $this->BLOOD_ID->ViewValue = $this->BLOOD_ID->CurrentValue;
            $this->BLOOD_ID->ViewValue = FormatNumber($this->BLOOD_ID->ViewValue, 0, -2, -2, -2);
            $this->BLOOD_ID->ViewCustomAttributes = "";

            // ORG_ID
            $curVal = trim(strval($this->ORG_ID->CurrentValue));
            if ($curVal != "") {
                $this->ORG_ID->ViewValue = $this->ORG_ID->lookupCacheOption($curVal);
                if ($this->ORG_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[ORG_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->ORG_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->ORG_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->ORG_ID->ViewValue = $this->ORG_ID->displayValue($arwrk);
                    } else {
                        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
                    }
                }
            } else {
                $this->ORG_ID->ViewValue = null;
            }
            $this->ORG_ID->ViewCustomAttributes = "";

            // KODE_JABATAN
            $this->KODE_JABATAN->ViewValue = $this->KODE_JABATAN->CurrentValue;
            $this->KODE_JABATAN->ViewCustomAttributes = "";

            // EMPLOYEED_DATE
            $this->EMPLOYEED_DATE->ViewValue = $this->EMPLOYEED_DATE->CurrentValue;
            $this->EMPLOYEED_DATE->ViewValue = FormatDateTime($this->EMPLOYEED_DATE->ViewValue, 0);
            $this->EMPLOYEED_DATE->ViewCustomAttributes = "";

            // EMP_TYPE
            $this->EMP_TYPE->ViewValue = $this->EMP_TYPE->CurrentValue;
            $this->EMP_TYPE->ViewValue = FormatNumber($this->EMP_TYPE->ViewValue, 0, -2, -2, -2);
            $this->EMP_TYPE->ViewCustomAttributes = "";

            // STATUS_ID
            $this->STATUS_ID->ViewValue = $this->STATUS_ID->CurrentValue;
            $this->STATUS_ID->ViewValue = FormatNumber($this->STATUS_ID->ViewValue, 0, -2, -2, -2);
            $this->STATUS_ID->ViewCustomAttributes = "";

            // CURRENT_GOLF_ID
            $this->CURRENT_GOLF_ID->ViewValue = $this->CURRENT_GOLF_ID->CurrentValue;
            $this->CURRENT_GOLF_ID->ViewCustomAttributes = "";

            // FUNCTIONAL
            $this->FUNCTIONAL->ViewValue = $this->FUNCTIONAL->CurrentValue;
            $this->FUNCTIONAL->ViewCustomAttributes = "";

            // TOTAL_CCP
            $this->TOTAL_CCP->ViewValue = $this->TOTAL_CCP->CurrentValue;
            $this->TOTAL_CCP->ViewValue = FormatNumber($this->TOTAL_CCP->ViewValue, 2, -2, -2, -2);
            $this->TOTAL_CCP->ViewCustomAttributes = "";

            // PWORKING_PERIOD_TH
            $this->PWORKING_PERIOD_TH->ViewValue = $this->PWORKING_PERIOD_TH->CurrentValue;
            $this->PWORKING_PERIOD_TH->ViewValue = FormatNumber($this->PWORKING_PERIOD_TH->ViewValue, 0, -2, -2, -2);
            $this->PWORKING_PERIOD_TH->ViewCustomAttributes = "";

            // P_WORKING_PERIOD_BLN
            $this->P_WORKING_PERIOD_BLN->ViewValue = $this->P_WORKING_PERIOD_BLN->CurrentValue;
            $this->P_WORKING_PERIOD_BLN->ViewValue = FormatNumber($this->P_WORKING_PERIOD_BLN->ViewValue, 0, -2, -2, -2);
            $this->P_WORKING_PERIOD_BLN->ViewCustomAttributes = "";

            // RWORKING_PERIOD_TH
            $this->RWORKING_PERIOD_TH->ViewValue = $this->RWORKING_PERIOD_TH->CurrentValue;
            $this->RWORKING_PERIOD_TH->ViewValue = FormatNumber($this->RWORKING_PERIOD_TH->ViewValue, 0, -2, -2, -2);
            $this->RWORKING_PERIOD_TH->ViewCustomAttributes = "";

            // RWORKING_PERIOD_BLN
            $this->RWORKING_PERIOD_BLN->ViewValue = $this->RWORKING_PERIOD_BLN->CurrentValue;
            $this->RWORKING_PERIOD_BLN->ViewValue = FormatNumber($this->RWORKING_PERIOD_BLN->ViewValue, 0, -2, -2, -2);
            $this->RWORKING_PERIOD_BLN->ViewCustomAttributes = "";

            // CURRENT_GOL_ID
            $this->CURRENT_GOL_ID->ViewValue = $this->CURRENT_GOL_ID->CurrentValue;
            $this->CURRENT_GOL_ID->ViewCustomAttributes = "";

            // GWORKING_PERIOD_TH
            $this->GWORKING_PERIOD_TH->ViewValue = $this->GWORKING_PERIOD_TH->CurrentValue;
            $this->GWORKING_PERIOD_TH->ViewValue = FormatNumber($this->GWORKING_PERIOD_TH->ViewValue, 0, -2, -2, -2);
            $this->GWORKING_PERIOD_TH->ViewCustomAttributes = "";

            // GWORKING_PERIOD_BLN
            $this->GWORKING_PERIOD_BLN->ViewValue = $this->GWORKING_PERIOD_BLN->CurrentValue;
            $this->GWORKING_PERIOD_BLN->ViewValue = FormatNumber($this->GWORKING_PERIOD_BLN->ViewValue, 0, -2, -2, -2);
            $this->GWORKING_PERIOD_BLN->ViewCustomAttributes = "";

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
            $this->EDUCATION_TYPE_CODE->ViewValue = FormatNumber($this->EDUCATION_TYPE_CODE->ViewValue, 0, -2, -2, -2);
            $this->EDUCATION_TYPE_CODE->ViewCustomAttributes = "";

            // NPWP
            $this->NPWP->ViewValue = $this->NPWP->CurrentValue;
            $this->NPWP->ViewCustomAttributes = "";

            // NATION_ID
            $this->NATION_ID->ViewValue = $this->NATION_ID->CurrentValue;
            $this->NATION_ID->ViewValue = FormatNumber($this->NATION_ID->ViewValue, 0, -2, -2, -2);
            $this->NATION_ID->ViewCustomAttributes = "";

            // PAID_ID
            $this->PAID_ID->ViewValue = $this->PAID_ID->CurrentValue;
            $this->PAID_ID->ViewCustomAttributes = "";

            // NONACTIVE
            $this->NONACTIVE->ViewValue = $this->NONACTIVE->CurrentValue;
            $this->NONACTIVE->ViewCustomAttributes = "";

            // NONACTIVE_DATE
            $this->NONACTIVE_DATE->ViewValue = $this->NONACTIVE_DATE->CurrentValue;
            $this->NONACTIVE_DATE->ViewValue = FormatDateTime($this->NONACTIVE_DATE->ViewValue, 0);
            $this->NONACTIVE_DATE->ViewCustomAttributes = "";

            // NON_ACTIVE_TYPE
            $this->NON_ACTIVE_TYPE->ViewValue = $this->NON_ACTIVE_TYPE->CurrentValue;
            $this->NON_ACTIVE_TYPE->ViewValue = FormatNumber($this->NON_ACTIVE_TYPE->ViewValue, 0, -2, -2, -2);
            $this->NON_ACTIVE_TYPE->ViewCustomAttributes = "";

            // PENSION_DATE
            $this->PENSION_DATE->ViewValue = $this->PENSION_DATE->CurrentValue;
            $this->PENSION_DATE->ViewValue = FormatDateTime($this->PENSION_DATE->ViewValue, 0);
            $this->PENSION_DATE->ViewCustomAttributes = "";

            // MORTGAGEYEAR
            $this->MORTGAGEYEAR->ViewValue = $this->MORTGAGEYEAR->CurrentValue;
            $this->MORTGAGEYEAR->ViewValue = FormatNumber($this->MORTGAGEYEAR->ViewValue, 0, -2, -2, -2);
            $this->MORTGAGEYEAR->ViewCustomAttributes = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
            $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
            $this->MODIFIED_DATE->ViewCustomAttributes = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
            $this->MODIFIED_BY->ViewCustomAttributes = "";

            // PICTUREFILE
            $this->PICTUREFILE->ViewValue = $this->PICTUREFILE->CurrentValue;
            $this->PICTUREFILE->ViewCustomAttributes = "";

            // FINGERSCANFILE
            $this->FINGERSCANFILE->ViewValue = $this->FINGERSCANFILE->CurrentValue;
            $this->FINGERSCANFILE->ViewCustomAttributes = "";

            // ISFULLTIME
            $this->ISFULLTIME->ViewValue = $this->ISFULLTIME->CurrentValue;
            $this->ISFULLTIME->ViewCustomAttributes = "";

            // SPECIALIST_TYPE_ID
            $curVal = trim(strval($this->SPECIALIST_TYPE_ID->CurrentValue));
            if ($curVal != "") {
                $this->SPECIALIST_TYPE_ID->ViewValue = $this->SPECIALIST_TYPE_ID->lookupCacheOption($curVal);
                if ($this->SPECIALIST_TYPE_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[SPECIALIST_TYPE_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->SPECIALIST_TYPE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SPECIALIST_TYPE_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->SPECIALIST_TYPE_ID->ViewValue = $this->SPECIALIST_TYPE_ID->displayValue($arwrk);
                    } else {
                        $this->SPECIALIST_TYPE_ID->ViewValue = $this->SPECIALIST_TYPE_ID->CurrentValue;
                    }
                }
            } else {
                $this->SPECIALIST_TYPE_ID->ViewValue = null;
            }
            $this->SPECIALIST_TYPE_ID->ViewCustomAttributes = "";

            // BANK_ID
            $this->BANK_ID->ViewValue = $this->BANK_ID->CurrentValue;
            $this->BANK_ID->ViewCustomAttributes = "";

            // BANK_ACCOUNT
            $this->BANK_ACCOUNT->ViewValue = $this->BANK_ACCOUNT->CurrentValue;
            $this->BANK_ACCOUNT->ViewCustomAttributes = "";

            // NPK
            $this->NPK->ViewValue = $this->NPK->CurrentValue;
            $this->NPK->ViewCustomAttributes = "";

            // OTHER_ADDRESS
            $this->OTHER_ADDRESS->ViewValue = $this->OTHER_ADDRESS->CurrentValue;
            $this->OTHER_ADDRESS->ViewCustomAttributes = "";

            // DEATH_DATE
            $this->DEATH_DATE->ViewValue = $this->DEATH_DATE->CurrentValue;
            $this->DEATH_DATE->ViewValue = FormatDateTime($this->DEATH_DATE->ViewValue, 0);
            $this->DEATH_DATE->ViewCustomAttributes = "";

            // WEBSITE
            $this->WEBSITE->ViewValue = $this->WEBSITE->CurrentValue;
            $this->WEBSITE->ViewCustomAttributes = "";

            // NIP
            $this->NIP->ViewValue = $this->NIP->CurrentValue;
            $this->NIP->ViewCustomAttributes = "";

            // DPJP
            $this->DPJP->ViewValue = $this->DPJP->CurrentValue;
            $this->DPJP->ViewCustomAttributes = "";

            // SK_NO
            $this->SK_NO->ViewValue = $this->SK_NO->CurrentValue;
            $this->SK_NO->ViewCustomAttributes = "";

            // SK_TMT
            $this->SK_TMT->ViewValue = $this->SK_TMT->CurrentValue;
            $this->SK_TMT->ViewValue = FormatDateTime($this->SK_TMT->ViewValue, 0);
            $this->SK_TMT->ViewCustomAttributes = "";

            // SK_TAT
            $this->SK_TAT->ViewValue = $this->SK_TAT->CurrentValue;
            $this->SK_TAT->ViewValue = FormatDateTime($this->SK_TAT->ViewValue, 0);
            $this->SK_TAT->ViewCustomAttributes = "";

            // FULLNAME
            $this->FULLNAME->LinkCustomAttributes = "";
            $this->FULLNAME->HrefValue = "";
            $this->FULLNAME->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // ORG_ID
            $this->ORG_ID->LinkCustomAttributes = "";
            $this->ORG_ID->HrefValue = "";
            $this->ORG_ID->TooltipValue = "";

            // SPECIALIST_TYPE_ID
            $this->SPECIALIST_TYPE_ID->LinkCustomAttributes = "";
            $this->SPECIALIST_TYPE_ID->HrefValue = "";
            $this->SPECIALIST_TYPE_ID->TooltipValue = "";

            // NIP
            $this->NIP->LinkCustomAttributes = "";
            $this->NIP->HrefValue = "";
            $this->NIP->TooltipValue = "";

            // DPJP
            $this->DPJP->LinkCustomAttributes = "";
            $this->DPJP->HrefValue = "";
            $this->DPJP->TooltipValue = "";
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fEMPLOYEE_ALLlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
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
                case "x_GENDER":
                    break;
                case "x_ORG_ID":
                    break;
                case "x_SPECIALIST_TYPE_ID":
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
