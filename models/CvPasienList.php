<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class CvPasienList extends CvPasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'cv_pasien';

    // Page object name
    public $PageObjName = "CvPasienList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fcv_pasienlist";
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

        // Table object (cv_pasien)
        if (!isset($GLOBALS["cv_pasien"]) || get_class($GLOBALS["cv_pasien"]) == PROJECT_NAMESPACE . "cv_pasien") {
            $GLOBALS["cv_pasien"] = &$this;
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
        $this->AddUrl = "CvPasienAdd?" . Config("TABLE_SHOW_DETAIL") . "=";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "CvPasienDelete";
        $this->MultiUpdateUrl = "CvPasienUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'cv_pasien');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fcv_pasienlistsrch";

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
                $doc = new $class(Container("cv_pasien"));
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
            $this->MODIFIED_DATE->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->MODIFIED_BY->Visible = false;
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
    public $SearchFieldsPerRow = 4; // For extended search
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
        $this->NO_REGISTRATION->setVisibility();
        $this->NAME_OF_PASIEN->setVisibility();
        $this->PASIEN_ID->setVisibility();
        $this->EMPLOYEE_ID->Visible = false;
        $this->KK_NO->setVisibility();
        $this->PLACE_OF_BIRTH->Visible = false;
        $this->DATE_OF_BIRTH->Visible = false;
        $this->GENDER->setVisibility();
        $this->NATION_ID->Visible = false;
        $this->EDUCATION_TYPE_CODE->Visible = false;
        $this->MARITALSTATUSID->Visible = false;
        $this->KODE_AGAMA->Visible = false;
        $this->KAL_ID->Visible = false;
        $this->RT->Visible = false;
        $this->RW->Visible = false;
        $this->JOB_ID->Visible = false;
        $this->STATUS_PASIEN_ID->setVisibility();
        $this->ANAK_KE->Visible = false;
        $this->CONTACT_ADDRESS->setVisibility();
        $this->PHONE_NUMBER->Visible = false;
        $this->MOBILE->Visible = false;
        $this->_EMAIL->Visible = false;
        $this->PHOTO_LOCATION->Visible = false;
        $this->REGISTRATION_DATE->setVisibility();
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->MODIFIED_FROM->Visible = false;
        $this->POSTAL_CODE->Visible = false;
        $this->GELAR->Visible = false;
        $this->BLOOD_TYPE_ID->Visible = false;
        $this->FAMILY_STATUS_ID->Visible = false;
        $this->ISMENINGGAL->Visible = false;
        $this->DEATH_DATE->Visible = false;
        $this->PAYOR_ID->Visible = false;
        $this->CLASS_ID->Visible = false;
        $this->ACCOUNT_ID->Visible = false;
        $this->KARYAWAN->Visible = false;
        $this->DESCRIPTION->Visible = false;
        $this->NEWCARD->Visible = false;
        $this->BACKCHARGE->Visible = false;
        $this->ORG_ID->Visible = false;
        $this->COVERAGE_ID->Visible = false;
        $this->MOTHER->setVisibility();
        $this->FATHER->setVisibility();
        $this->SPOUSE->setVisibility();
        $this->AKTIF->Visible = false;
        $this->TMT->Visible = false;
        $this->TAT->Visible = false;
        $this->CARD_ID->Visible = false;
        $this->MEDICAL_NOTES->Visible = false;
        $this->ID->Visible = false;
        $this->newapp->Visible = false;
        $this->cek->Visible = false;
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
        $this->setupLookupOptions($this->EDUCATION_TYPE_CODE);
        $this->setupLookupOptions($this->MARITALSTATUSID);
        $this->setupLookupOptions($this->KODE_AGAMA);
        $this->setupLookupOptions($this->KAL_ID);
        $this->setupLookupOptions($this->JOB_ID);
        $this->setupLookupOptions($this->STATUS_PASIEN_ID);
        $this->setupLookupOptions($this->BLOOD_TYPE_ID);
        $this->setupLookupOptions($this->FAMILY_STATUS_ID);
        $this->setupLookupOptions($this->PAYOR_ID);
        $this->setupLookupOptions($this->CLASS_ID);
        $this->setupLookupOptions($this->COVERAGE_ID);
        $this->setupLookupOptions($this->AKTIF);

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
            AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Get and validate search values for advanced search
            $this->loadSearchValues(); // Get search values

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }
            if (!$this->validateSearch()) {
                // Nothing to do
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

            // Get search criteria for advanced search
            if (!$this->hasInvalidFields()) {
                $srchAdvanced = $this->advancedSearchWhere();
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

            // Load advanced search from default
            if ($this->loadAdvancedSearchDefault()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
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
        $filterList = Concat($filterList, $this->NO_REGISTRATION->AdvancedSearch->toJson(), ","); // Field NO_REGISTRATION
        $filterList = Concat($filterList, $this->NAME_OF_PASIEN->AdvancedSearch->toJson(), ","); // Field NAME_OF_PASIEN
        $filterList = Concat($filterList, $this->PASIEN_ID->AdvancedSearch->toJson(), ","); // Field PASIEN_ID
        $filterList = Concat($filterList, $this->EMPLOYEE_ID->AdvancedSearch->toJson(), ","); // Field EMPLOYEE_ID
        $filterList = Concat($filterList, $this->KK_NO->AdvancedSearch->toJson(), ","); // Field KK_NO
        $filterList = Concat($filterList, $this->PLACE_OF_BIRTH->AdvancedSearch->toJson(), ","); // Field PLACE_OF_BIRTH
        $filterList = Concat($filterList, $this->DATE_OF_BIRTH->AdvancedSearch->toJson(), ","); // Field DATE_OF_BIRTH
        $filterList = Concat($filterList, $this->GENDER->AdvancedSearch->toJson(), ","); // Field GENDER
        $filterList = Concat($filterList, $this->NATION_ID->AdvancedSearch->toJson(), ","); // Field NATION_ID
        $filterList = Concat($filterList, $this->EDUCATION_TYPE_CODE->AdvancedSearch->toJson(), ","); // Field EDUCATION_TYPE_CODE
        $filterList = Concat($filterList, $this->MARITALSTATUSID->AdvancedSearch->toJson(), ","); // Field MARITALSTATUSID
        $filterList = Concat($filterList, $this->KODE_AGAMA->AdvancedSearch->toJson(), ","); // Field KODE_AGAMA
        $filterList = Concat($filterList, $this->KAL_ID->AdvancedSearch->toJson(), ","); // Field KAL_ID
        $filterList = Concat($filterList, $this->RT->AdvancedSearch->toJson(), ","); // Field RT
        $filterList = Concat($filterList, $this->RW->AdvancedSearch->toJson(), ","); // Field RW
        $filterList = Concat($filterList, $this->JOB_ID->AdvancedSearch->toJson(), ","); // Field JOB_ID
        $filterList = Concat($filterList, $this->STATUS_PASIEN_ID->AdvancedSearch->toJson(), ","); // Field STATUS_PASIEN_ID
        $filterList = Concat($filterList, $this->ANAK_KE->AdvancedSearch->toJson(), ","); // Field ANAK_KE
        $filterList = Concat($filterList, $this->CONTACT_ADDRESS->AdvancedSearch->toJson(), ","); // Field CONTACT_ADDRESS
        $filterList = Concat($filterList, $this->PHONE_NUMBER->AdvancedSearch->toJson(), ","); // Field PHONE_NUMBER
        $filterList = Concat($filterList, $this->MOBILE->AdvancedSearch->toJson(), ","); // Field MOBILE
        $filterList = Concat($filterList, $this->_EMAIL->AdvancedSearch->toJson(), ","); // Field EMAIL
        $filterList = Concat($filterList, $this->PHOTO_LOCATION->AdvancedSearch->toJson(), ","); // Field PHOTO_LOCATION
        $filterList = Concat($filterList, $this->REGISTRATION_DATE->AdvancedSearch->toJson(), ","); // Field REGISTRATION_DATE
        $filterList = Concat($filterList, $this->MODIFIED_DATE->AdvancedSearch->toJson(), ","); // Field MODIFIED_DATE
        $filterList = Concat($filterList, $this->MODIFIED_BY->AdvancedSearch->toJson(), ","); // Field MODIFIED_BY
        $filterList = Concat($filterList, $this->MODIFIED_FROM->AdvancedSearch->toJson(), ","); // Field MODIFIED_FROM
        $filterList = Concat($filterList, $this->POSTAL_CODE->AdvancedSearch->toJson(), ","); // Field POSTAL_CODE
        $filterList = Concat($filterList, $this->GELAR->AdvancedSearch->toJson(), ","); // Field GELAR
        $filterList = Concat($filterList, $this->BLOOD_TYPE_ID->AdvancedSearch->toJson(), ","); // Field BLOOD_TYPE_ID
        $filterList = Concat($filterList, $this->FAMILY_STATUS_ID->AdvancedSearch->toJson(), ","); // Field FAMILY_STATUS_ID
        $filterList = Concat($filterList, $this->ISMENINGGAL->AdvancedSearch->toJson(), ","); // Field ISMENINGGAL
        $filterList = Concat($filterList, $this->DEATH_DATE->AdvancedSearch->toJson(), ","); // Field DEATH_DATE
        $filterList = Concat($filterList, $this->PAYOR_ID->AdvancedSearch->toJson(), ","); // Field PAYOR_ID
        $filterList = Concat($filterList, $this->CLASS_ID->AdvancedSearch->toJson(), ","); // Field CLASS_ID
        $filterList = Concat($filterList, $this->ACCOUNT_ID->AdvancedSearch->toJson(), ","); // Field ACCOUNT_ID
        $filterList = Concat($filterList, $this->KARYAWAN->AdvancedSearch->toJson(), ","); // Field KARYAWAN
        $filterList = Concat($filterList, $this->DESCRIPTION->AdvancedSearch->toJson(), ","); // Field DESCRIPTION
        $filterList = Concat($filterList, $this->NEWCARD->AdvancedSearch->toJson(), ","); // Field NEWCARD
        $filterList = Concat($filterList, $this->BACKCHARGE->AdvancedSearch->toJson(), ","); // Field BACKCHARGE
        $filterList = Concat($filterList, $this->ORG_ID->AdvancedSearch->toJson(), ","); // Field ORG_ID
        $filterList = Concat($filterList, $this->COVERAGE_ID->AdvancedSearch->toJson(), ","); // Field COVERAGE_ID
        $filterList = Concat($filterList, $this->MOTHER->AdvancedSearch->toJson(), ","); // Field MOTHER
        $filterList = Concat($filterList, $this->FATHER->AdvancedSearch->toJson(), ","); // Field FATHER
        $filterList = Concat($filterList, $this->SPOUSE->AdvancedSearch->toJson(), ","); // Field SPOUSE
        $filterList = Concat($filterList, $this->AKTIF->AdvancedSearch->toJson(), ","); // Field AKTIF
        $filterList = Concat($filterList, $this->TMT->AdvancedSearch->toJson(), ","); // Field TMT
        $filterList = Concat($filterList, $this->TAT->AdvancedSearch->toJson(), ","); // Field TAT
        $filterList = Concat($filterList, $this->CARD_ID->AdvancedSearch->toJson(), ","); // Field CARD_ID
        $filterList = Concat($filterList, $this->MEDICAL_NOTES->AdvancedSearch->toJson(), ","); // Field MEDICAL_NOTES
        $filterList = Concat($filterList, $this->ID->AdvancedSearch->toJson(), ","); // Field ID
        $filterList = Concat($filterList, $this->newapp->AdvancedSearch->toJson(), ","); // Field newapp
        $filterList = Concat($filterList, $this->cek->AdvancedSearch->toJson(), ","); // Field cek
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fcv_pasienlistsrch", $filters);
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

        // Field NO_REGISTRATION
        $this->NO_REGISTRATION->AdvancedSearch->SearchValue = @$filter["x_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchOperator = @$filter["z_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchCondition = @$filter["v_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchValue2 = @$filter["y_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchOperator2 = @$filter["w_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->save();

        // Field NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchValue = @$filter["x_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchOperator = @$filter["z_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchCondition = @$filter["v_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchValue2 = @$filter["y_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchOperator2 = @$filter["w_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->save();

        // Field PASIEN_ID
        $this->PASIEN_ID->AdvancedSearch->SearchValue = @$filter["x_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->SearchOperator = @$filter["z_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->SearchCondition = @$filter["v_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->SearchValue2 = @$filter["y_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->SearchOperator2 = @$filter["w_PASIEN_ID"];
        $this->PASIEN_ID->AdvancedSearch->save();

        // Field EMPLOYEE_ID
        $this->EMPLOYEE_ID->AdvancedSearch->SearchValue = @$filter["x_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchOperator = @$filter["z_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchCondition = @$filter["v_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchValue2 = @$filter["y_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->save();

        // Field KK_NO
        $this->KK_NO->AdvancedSearch->SearchValue = @$filter["x_KK_NO"];
        $this->KK_NO->AdvancedSearch->SearchOperator = @$filter["z_KK_NO"];
        $this->KK_NO->AdvancedSearch->SearchCondition = @$filter["v_KK_NO"];
        $this->KK_NO->AdvancedSearch->SearchValue2 = @$filter["y_KK_NO"];
        $this->KK_NO->AdvancedSearch->SearchOperator2 = @$filter["w_KK_NO"];
        $this->KK_NO->AdvancedSearch->save();

        // Field PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->AdvancedSearch->SearchValue = @$filter["x_PLACE_OF_BIRTH"];
        $this->PLACE_OF_BIRTH->AdvancedSearch->SearchOperator = @$filter["z_PLACE_OF_BIRTH"];
        $this->PLACE_OF_BIRTH->AdvancedSearch->SearchCondition = @$filter["v_PLACE_OF_BIRTH"];
        $this->PLACE_OF_BIRTH->AdvancedSearch->SearchValue2 = @$filter["y_PLACE_OF_BIRTH"];
        $this->PLACE_OF_BIRTH->AdvancedSearch->SearchOperator2 = @$filter["w_PLACE_OF_BIRTH"];
        $this->PLACE_OF_BIRTH->AdvancedSearch->save();

        // Field DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->AdvancedSearch->SearchValue = @$filter["x_DATE_OF_BIRTH"];
        $this->DATE_OF_BIRTH->AdvancedSearch->SearchOperator = @$filter["z_DATE_OF_BIRTH"];
        $this->DATE_OF_BIRTH->AdvancedSearch->SearchCondition = @$filter["v_DATE_OF_BIRTH"];
        $this->DATE_OF_BIRTH->AdvancedSearch->SearchValue2 = @$filter["y_DATE_OF_BIRTH"];
        $this->DATE_OF_BIRTH->AdvancedSearch->SearchOperator2 = @$filter["w_DATE_OF_BIRTH"];
        $this->DATE_OF_BIRTH->AdvancedSearch->save();

        // Field GENDER
        $this->GENDER->AdvancedSearch->SearchValue = @$filter["x_GENDER"];
        $this->GENDER->AdvancedSearch->SearchOperator = @$filter["z_GENDER"];
        $this->GENDER->AdvancedSearch->SearchCondition = @$filter["v_GENDER"];
        $this->GENDER->AdvancedSearch->SearchValue2 = @$filter["y_GENDER"];
        $this->GENDER->AdvancedSearch->SearchOperator2 = @$filter["w_GENDER"];
        $this->GENDER->AdvancedSearch->save();

        // Field NATION_ID
        $this->NATION_ID->AdvancedSearch->SearchValue = @$filter["x_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->SearchOperator = @$filter["z_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->SearchCondition = @$filter["v_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->SearchValue2 = @$filter["y_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->SearchOperator2 = @$filter["w_NATION_ID"];
        $this->NATION_ID->AdvancedSearch->save();

        // Field EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchValue = @$filter["x_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchOperator = @$filter["z_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchCondition = @$filter["v_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchValue2 = @$filter["y_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchOperator2 = @$filter["w_EDUCATION_TYPE_CODE"];
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->save();

        // Field MARITALSTATUSID
        $this->MARITALSTATUSID->AdvancedSearch->SearchValue = @$filter["x_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->SearchOperator = @$filter["z_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->SearchCondition = @$filter["v_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->SearchValue2 = @$filter["y_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->SearchOperator2 = @$filter["w_MARITALSTATUSID"];
        $this->MARITALSTATUSID->AdvancedSearch->save();

        // Field KODE_AGAMA
        $this->KODE_AGAMA->AdvancedSearch->SearchValue = @$filter["x_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->SearchOperator = @$filter["z_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->SearchCondition = @$filter["v_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->SearchValue2 = @$filter["y_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->SearchOperator2 = @$filter["w_KODE_AGAMA"];
        $this->KODE_AGAMA->AdvancedSearch->save();

        // Field KAL_ID
        $this->KAL_ID->AdvancedSearch->SearchValue = @$filter["x_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchOperator = @$filter["z_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchCondition = @$filter["v_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchValue2 = @$filter["y_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchOperator2 = @$filter["w_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->save();

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

        // Field JOB_ID
        $this->JOB_ID->AdvancedSearch->SearchValue = @$filter["x_JOB_ID"];
        $this->JOB_ID->AdvancedSearch->SearchOperator = @$filter["z_JOB_ID"];
        $this->JOB_ID->AdvancedSearch->SearchCondition = @$filter["v_JOB_ID"];
        $this->JOB_ID->AdvancedSearch->SearchValue2 = @$filter["y_JOB_ID"];
        $this->JOB_ID->AdvancedSearch->SearchOperator2 = @$filter["w_JOB_ID"];
        $this->JOB_ID->AdvancedSearch->save();

        // Field STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue = @$filter["x_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchOperator = @$filter["z_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchCondition = @$filter["v_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue2 = @$filter["y_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchOperator2 = @$filter["w_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->save();

        // Field ANAK_KE
        $this->ANAK_KE->AdvancedSearch->SearchValue = @$filter["x_ANAK_KE"];
        $this->ANAK_KE->AdvancedSearch->SearchOperator = @$filter["z_ANAK_KE"];
        $this->ANAK_KE->AdvancedSearch->SearchCondition = @$filter["v_ANAK_KE"];
        $this->ANAK_KE->AdvancedSearch->SearchValue2 = @$filter["y_ANAK_KE"];
        $this->ANAK_KE->AdvancedSearch->SearchOperator2 = @$filter["w_ANAK_KE"];
        $this->ANAK_KE->AdvancedSearch->save();

        // Field CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->AdvancedSearch->SearchValue = @$filter["x_CONTACT_ADDRESS"];
        $this->CONTACT_ADDRESS->AdvancedSearch->SearchOperator = @$filter["z_CONTACT_ADDRESS"];
        $this->CONTACT_ADDRESS->AdvancedSearch->SearchCondition = @$filter["v_CONTACT_ADDRESS"];
        $this->CONTACT_ADDRESS->AdvancedSearch->SearchValue2 = @$filter["y_CONTACT_ADDRESS"];
        $this->CONTACT_ADDRESS->AdvancedSearch->SearchOperator2 = @$filter["w_CONTACT_ADDRESS"];
        $this->CONTACT_ADDRESS->AdvancedSearch->save();

        // Field PHONE_NUMBER
        $this->PHONE_NUMBER->AdvancedSearch->SearchValue = @$filter["x_PHONE_NUMBER"];
        $this->PHONE_NUMBER->AdvancedSearch->SearchOperator = @$filter["z_PHONE_NUMBER"];
        $this->PHONE_NUMBER->AdvancedSearch->SearchCondition = @$filter["v_PHONE_NUMBER"];
        $this->PHONE_NUMBER->AdvancedSearch->SearchValue2 = @$filter["y_PHONE_NUMBER"];
        $this->PHONE_NUMBER->AdvancedSearch->SearchOperator2 = @$filter["w_PHONE_NUMBER"];
        $this->PHONE_NUMBER->AdvancedSearch->save();

        // Field MOBILE
        $this->MOBILE->AdvancedSearch->SearchValue = @$filter["x_MOBILE"];
        $this->MOBILE->AdvancedSearch->SearchOperator = @$filter["z_MOBILE"];
        $this->MOBILE->AdvancedSearch->SearchCondition = @$filter["v_MOBILE"];
        $this->MOBILE->AdvancedSearch->SearchValue2 = @$filter["y_MOBILE"];
        $this->MOBILE->AdvancedSearch->SearchOperator2 = @$filter["w_MOBILE"];
        $this->MOBILE->AdvancedSearch->save();

        // Field EMAIL
        $this->_EMAIL->AdvancedSearch->SearchValue = @$filter["x__EMAIL"];
        $this->_EMAIL->AdvancedSearch->SearchOperator = @$filter["z__EMAIL"];
        $this->_EMAIL->AdvancedSearch->SearchCondition = @$filter["v__EMAIL"];
        $this->_EMAIL->AdvancedSearch->SearchValue2 = @$filter["y__EMAIL"];
        $this->_EMAIL->AdvancedSearch->SearchOperator2 = @$filter["w__EMAIL"];
        $this->_EMAIL->AdvancedSearch->save();

        // Field PHOTO_LOCATION
        $this->PHOTO_LOCATION->AdvancedSearch->SearchValue = @$filter["x_PHOTO_LOCATION"];
        $this->PHOTO_LOCATION->AdvancedSearch->SearchOperator = @$filter["z_PHOTO_LOCATION"];
        $this->PHOTO_LOCATION->AdvancedSearch->SearchCondition = @$filter["v_PHOTO_LOCATION"];
        $this->PHOTO_LOCATION->AdvancedSearch->SearchValue2 = @$filter["y_PHOTO_LOCATION"];
        $this->PHOTO_LOCATION->AdvancedSearch->SearchOperator2 = @$filter["w_PHOTO_LOCATION"];
        $this->PHOTO_LOCATION->AdvancedSearch->save();

        // Field REGISTRATION_DATE
        $this->REGISTRATION_DATE->AdvancedSearch->SearchValue = @$filter["x_REGISTRATION_DATE"];
        $this->REGISTRATION_DATE->AdvancedSearch->SearchOperator = @$filter["z_REGISTRATION_DATE"];
        $this->REGISTRATION_DATE->AdvancedSearch->SearchCondition = @$filter["v_REGISTRATION_DATE"];
        $this->REGISTRATION_DATE->AdvancedSearch->SearchValue2 = @$filter["y_REGISTRATION_DATE"];
        $this->REGISTRATION_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_REGISTRATION_DATE"];
        $this->REGISTRATION_DATE->AdvancedSearch->save();

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

        // Field MODIFIED_FROM
        $this->MODIFIED_FROM->AdvancedSearch->SearchValue = @$filter["x_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->SearchOperator = @$filter["z_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->SearchCondition = @$filter["v_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->SearchValue2 = @$filter["y_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->SearchOperator2 = @$filter["w_MODIFIED_FROM"];
        $this->MODIFIED_FROM->AdvancedSearch->save();

        // Field POSTAL_CODE
        $this->POSTAL_CODE->AdvancedSearch->SearchValue = @$filter["x_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->SearchOperator = @$filter["z_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->SearchCondition = @$filter["v_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->SearchValue2 = @$filter["y_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->SearchOperator2 = @$filter["w_POSTAL_CODE"];
        $this->POSTAL_CODE->AdvancedSearch->save();

        // Field GELAR
        $this->GELAR->AdvancedSearch->SearchValue = @$filter["x_GELAR"];
        $this->GELAR->AdvancedSearch->SearchOperator = @$filter["z_GELAR"];
        $this->GELAR->AdvancedSearch->SearchCondition = @$filter["v_GELAR"];
        $this->GELAR->AdvancedSearch->SearchValue2 = @$filter["y_GELAR"];
        $this->GELAR->AdvancedSearch->SearchOperator2 = @$filter["w_GELAR"];
        $this->GELAR->AdvancedSearch->save();

        // Field BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID->AdvancedSearch->SearchValue = @$filter["x_BLOOD_TYPE_ID"];
        $this->BLOOD_TYPE_ID->AdvancedSearch->SearchOperator = @$filter["z_BLOOD_TYPE_ID"];
        $this->BLOOD_TYPE_ID->AdvancedSearch->SearchCondition = @$filter["v_BLOOD_TYPE_ID"];
        $this->BLOOD_TYPE_ID->AdvancedSearch->SearchValue2 = @$filter["y_BLOOD_TYPE_ID"];
        $this->BLOOD_TYPE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_BLOOD_TYPE_ID"];
        $this->BLOOD_TYPE_ID->AdvancedSearch->save();

        // Field FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->AdvancedSearch->SearchValue = @$filter["x_FAMILY_STATUS_ID"];
        $this->FAMILY_STATUS_ID->AdvancedSearch->SearchOperator = @$filter["z_FAMILY_STATUS_ID"];
        $this->FAMILY_STATUS_ID->AdvancedSearch->SearchCondition = @$filter["v_FAMILY_STATUS_ID"];
        $this->FAMILY_STATUS_ID->AdvancedSearch->SearchValue2 = @$filter["y_FAMILY_STATUS_ID"];
        $this->FAMILY_STATUS_ID->AdvancedSearch->SearchOperator2 = @$filter["w_FAMILY_STATUS_ID"];
        $this->FAMILY_STATUS_ID->AdvancedSearch->save();

        // Field ISMENINGGAL
        $this->ISMENINGGAL->AdvancedSearch->SearchValue = @$filter["x_ISMENINGGAL"];
        $this->ISMENINGGAL->AdvancedSearch->SearchOperator = @$filter["z_ISMENINGGAL"];
        $this->ISMENINGGAL->AdvancedSearch->SearchCondition = @$filter["v_ISMENINGGAL"];
        $this->ISMENINGGAL->AdvancedSearch->SearchValue2 = @$filter["y_ISMENINGGAL"];
        $this->ISMENINGGAL->AdvancedSearch->SearchOperator2 = @$filter["w_ISMENINGGAL"];
        $this->ISMENINGGAL->AdvancedSearch->save();

        // Field DEATH_DATE
        $this->DEATH_DATE->AdvancedSearch->SearchValue = @$filter["x_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->SearchOperator = @$filter["z_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->SearchCondition = @$filter["v_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->SearchValue2 = @$filter["y_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_DEATH_DATE"];
        $this->DEATH_DATE->AdvancedSearch->save();

        // Field PAYOR_ID
        $this->PAYOR_ID->AdvancedSearch->SearchValue = @$filter["x_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->SearchOperator = @$filter["z_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->SearchCondition = @$filter["v_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->SearchValue2 = @$filter["y_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->SearchOperator2 = @$filter["w_PAYOR_ID"];
        $this->PAYOR_ID->AdvancedSearch->save();

        // Field CLASS_ID
        $this->CLASS_ID->AdvancedSearch->SearchValue = @$filter["x_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->SearchOperator = @$filter["z_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->SearchCondition = @$filter["v_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->SearchValue2 = @$filter["y_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CLASS_ID"];
        $this->CLASS_ID->AdvancedSearch->save();

        // Field ACCOUNT_ID
        $this->ACCOUNT_ID->AdvancedSearch->SearchValue = @$filter["x_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchOperator = @$filter["z_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchCondition = @$filter["v_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchValue2 = @$filter["y_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchOperator2 = @$filter["w_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->save();

        // Field KARYAWAN
        $this->KARYAWAN->AdvancedSearch->SearchValue = @$filter["x_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->SearchOperator = @$filter["z_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->SearchCondition = @$filter["v_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->SearchValue2 = @$filter["y_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->SearchOperator2 = @$filter["w_KARYAWAN"];
        $this->KARYAWAN->AdvancedSearch->save();

        // Field DESCRIPTION
        $this->DESCRIPTION->AdvancedSearch->SearchValue = @$filter["x_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchOperator = @$filter["z_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchCondition = @$filter["v_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchValue2 = @$filter["y_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchOperator2 = @$filter["w_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->save();

        // Field NEWCARD
        $this->NEWCARD->AdvancedSearch->SearchValue = @$filter["x_NEWCARD"];
        $this->NEWCARD->AdvancedSearch->SearchOperator = @$filter["z_NEWCARD"];
        $this->NEWCARD->AdvancedSearch->SearchCondition = @$filter["v_NEWCARD"];
        $this->NEWCARD->AdvancedSearch->SearchValue2 = @$filter["y_NEWCARD"];
        $this->NEWCARD->AdvancedSearch->SearchOperator2 = @$filter["w_NEWCARD"];
        $this->NEWCARD->AdvancedSearch->save();

        // Field BACKCHARGE
        $this->BACKCHARGE->AdvancedSearch->SearchValue = @$filter["x_BACKCHARGE"];
        $this->BACKCHARGE->AdvancedSearch->SearchOperator = @$filter["z_BACKCHARGE"];
        $this->BACKCHARGE->AdvancedSearch->SearchCondition = @$filter["v_BACKCHARGE"];
        $this->BACKCHARGE->AdvancedSearch->SearchValue2 = @$filter["y_BACKCHARGE"];
        $this->BACKCHARGE->AdvancedSearch->SearchOperator2 = @$filter["w_BACKCHARGE"];
        $this->BACKCHARGE->AdvancedSearch->save();

        // Field ORG_ID
        $this->ORG_ID->AdvancedSearch->SearchValue = @$filter["x_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->SearchOperator = @$filter["z_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->SearchCondition = @$filter["v_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->SearchValue2 = @$filter["y_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->SearchOperator2 = @$filter["w_ORG_ID"];
        $this->ORG_ID->AdvancedSearch->save();

        // Field COVERAGE_ID
        $this->COVERAGE_ID->AdvancedSearch->SearchValue = @$filter["x_COVERAGE_ID"];
        $this->COVERAGE_ID->AdvancedSearch->SearchOperator = @$filter["z_COVERAGE_ID"];
        $this->COVERAGE_ID->AdvancedSearch->SearchCondition = @$filter["v_COVERAGE_ID"];
        $this->COVERAGE_ID->AdvancedSearch->SearchValue2 = @$filter["y_COVERAGE_ID"];
        $this->COVERAGE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_COVERAGE_ID"];
        $this->COVERAGE_ID->AdvancedSearch->save();

        // Field MOTHER
        $this->MOTHER->AdvancedSearch->SearchValue = @$filter["x_MOTHER"];
        $this->MOTHER->AdvancedSearch->SearchOperator = @$filter["z_MOTHER"];
        $this->MOTHER->AdvancedSearch->SearchCondition = @$filter["v_MOTHER"];
        $this->MOTHER->AdvancedSearch->SearchValue2 = @$filter["y_MOTHER"];
        $this->MOTHER->AdvancedSearch->SearchOperator2 = @$filter["w_MOTHER"];
        $this->MOTHER->AdvancedSearch->save();

        // Field FATHER
        $this->FATHER->AdvancedSearch->SearchValue = @$filter["x_FATHER"];
        $this->FATHER->AdvancedSearch->SearchOperator = @$filter["z_FATHER"];
        $this->FATHER->AdvancedSearch->SearchCondition = @$filter["v_FATHER"];
        $this->FATHER->AdvancedSearch->SearchValue2 = @$filter["y_FATHER"];
        $this->FATHER->AdvancedSearch->SearchOperator2 = @$filter["w_FATHER"];
        $this->FATHER->AdvancedSearch->save();

        // Field SPOUSE
        $this->SPOUSE->AdvancedSearch->SearchValue = @$filter["x_SPOUSE"];
        $this->SPOUSE->AdvancedSearch->SearchOperator = @$filter["z_SPOUSE"];
        $this->SPOUSE->AdvancedSearch->SearchCondition = @$filter["v_SPOUSE"];
        $this->SPOUSE->AdvancedSearch->SearchValue2 = @$filter["y_SPOUSE"];
        $this->SPOUSE->AdvancedSearch->SearchOperator2 = @$filter["w_SPOUSE"];
        $this->SPOUSE->AdvancedSearch->save();

        // Field AKTIF
        $this->AKTIF->AdvancedSearch->SearchValue = @$filter["x_AKTIF"];
        $this->AKTIF->AdvancedSearch->SearchOperator = @$filter["z_AKTIF"];
        $this->AKTIF->AdvancedSearch->SearchCondition = @$filter["v_AKTIF"];
        $this->AKTIF->AdvancedSearch->SearchValue2 = @$filter["y_AKTIF"];
        $this->AKTIF->AdvancedSearch->SearchOperator2 = @$filter["w_AKTIF"];
        $this->AKTIF->AdvancedSearch->save();

        // Field TMT
        $this->TMT->AdvancedSearch->SearchValue = @$filter["x_TMT"];
        $this->TMT->AdvancedSearch->SearchOperator = @$filter["z_TMT"];
        $this->TMT->AdvancedSearch->SearchCondition = @$filter["v_TMT"];
        $this->TMT->AdvancedSearch->SearchValue2 = @$filter["y_TMT"];
        $this->TMT->AdvancedSearch->SearchOperator2 = @$filter["w_TMT"];
        $this->TMT->AdvancedSearch->save();

        // Field TAT
        $this->TAT->AdvancedSearch->SearchValue = @$filter["x_TAT"];
        $this->TAT->AdvancedSearch->SearchOperator = @$filter["z_TAT"];
        $this->TAT->AdvancedSearch->SearchCondition = @$filter["v_TAT"];
        $this->TAT->AdvancedSearch->SearchValue2 = @$filter["y_TAT"];
        $this->TAT->AdvancedSearch->SearchOperator2 = @$filter["w_TAT"];
        $this->TAT->AdvancedSearch->save();

        // Field CARD_ID
        $this->CARD_ID->AdvancedSearch->SearchValue = @$filter["x_CARD_ID"];
        $this->CARD_ID->AdvancedSearch->SearchOperator = @$filter["z_CARD_ID"];
        $this->CARD_ID->AdvancedSearch->SearchCondition = @$filter["v_CARD_ID"];
        $this->CARD_ID->AdvancedSearch->SearchValue2 = @$filter["y_CARD_ID"];
        $this->CARD_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CARD_ID"];
        $this->CARD_ID->AdvancedSearch->save();

        // Field MEDICAL_NOTES
        $this->MEDICAL_NOTES->AdvancedSearch->SearchValue = @$filter["x_MEDICAL_NOTES"];
        $this->MEDICAL_NOTES->AdvancedSearch->SearchOperator = @$filter["z_MEDICAL_NOTES"];
        $this->MEDICAL_NOTES->AdvancedSearch->SearchCondition = @$filter["v_MEDICAL_NOTES"];
        $this->MEDICAL_NOTES->AdvancedSearch->SearchValue2 = @$filter["y_MEDICAL_NOTES"];
        $this->MEDICAL_NOTES->AdvancedSearch->SearchOperator2 = @$filter["w_MEDICAL_NOTES"];
        $this->MEDICAL_NOTES->AdvancedSearch->save();

        // Field ID
        $this->ID->AdvancedSearch->SearchValue = @$filter["x_ID"];
        $this->ID->AdvancedSearch->SearchOperator = @$filter["z_ID"];
        $this->ID->AdvancedSearch->SearchCondition = @$filter["v_ID"];
        $this->ID->AdvancedSearch->SearchValue2 = @$filter["y_ID"];
        $this->ID->AdvancedSearch->SearchOperator2 = @$filter["w_ID"];
        $this->ID->AdvancedSearch->save();

        // Field newapp
        $this->newapp->AdvancedSearch->SearchValue = @$filter["x_newapp"];
        $this->newapp->AdvancedSearch->SearchOperator = @$filter["z_newapp"];
        $this->newapp->AdvancedSearch->SearchCondition = @$filter["v_newapp"];
        $this->newapp->AdvancedSearch->SearchValue2 = @$filter["y_newapp"];
        $this->newapp->AdvancedSearch->SearchOperator2 = @$filter["w_newapp"];
        $this->newapp->AdvancedSearch->save();

        // Field cek
        $this->cek->AdvancedSearch->SearchValue = @$filter["x_cek"];
        $this->cek->AdvancedSearch->SearchOperator = @$filter["z_cek"];
        $this->cek->AdvancedSearch->SearchCondition = @$filter["v_cek"];
        $this->cek->AdvancedSearch->SearchValue2 = @$filter["y_cek"];
        $this->cek->AdvancedSearch->SearchOperator2 = @$filter["w_cek"];
        $this->cek->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Advanced search WHERE clause based on QueryString
    protected function advancedSearchWhere($default = false)
    {
        global $Security;
        $where = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $this->buildSearchSql($where, $this->ORG_UNIT_CODE, $default, false); // ORG_UNIT_CODE
        $this->buildSearchSql($where, $this->NO_REGISTRATION, $default, false); // NO_REGISTRATION
        $this->buildSearchSql($where, $this->NAME_OF_PASIEN, $default, false); // NAME_OF_PASIEN
        $this->buildSearchSql($where, $this->PASIEN_ID, $default, false); // PASIEN_ID
        $this->buildSearchSql($where, $this->EMPLOYEE_ID, $default, false); // EMPLOYEE_ID
        $this->buildSearchSql($where, $this->KK_NO, $default, false); // KK_NO
        $this->buildSearchSql($where, $this->PLACE_OF_BIRTH, $default, false); // PLACE_OF_BIRTH
        $this->buildSearchSql($where, $this->DATE_OF_BIRTH, $default, false); // DATE_OF_BIRTH
        $this->buildSearchSql($where, $this->GENDER, $default, false); // GENDER
        $this->buildSearchSql($where, $this->NATION_ID, $default, false); // NATION_ID
        $this->buildSearchSql($where, $this->EDUCATION_TYPE_CODE, $default, false); // EDUCATION_TYPE_CODE
        $this->buildSearchSql($where, $this->MARITALSTATUSID, $default, false); // MARITALSTATUSID
        $this->buildSearchSql($where, $this->KODE_AGAMA, $default, false); // KODE_AGAMA
        $this->buildSearchSql($where, $this->KAL_ID, $default, false); // KAL_ID
        $this->buildSearchSql($where, $this->RT, $default, false); // RT
        $this->buildSearchSql($where, $this->RW, $default, false); // RW
        $this->buildSearchSql($where, $this->JOB_ID, $default, false); // JOB_ID
        $this->buildSearchSql($where, $this->STATUS_PASIEN_ID, $default, false); // STATUS_PASIEN_ID
        $this->buildSearchSql($where, $this->ANAK_KE, $default, false); // ANAK_KE
        $this->buildSearchSql($where, $this->CONTACT_ADDRESS, $default, false); // CONTACT_ADDRESS
        $this->buildSearchSql($where, $this->PHONE_NUMBER, $default, false); // PHONE_NUMBER
        $this->buildSearchSql($where, $this->MOBILE, $default, false); // MOBILE
        $this->buildSearchSql($where, $this->_EMAIL, $default, false); // EMAIL
        $this->buildSearchSql($where, $this->PHOTO_LOCATION, $default, false); // PHOTO_LOCATION
        $this->buildSearchSql($where, $this->REGISTRATION_DATE, $default, false); // REGISTRATION_DATE
        $this->buildSearchSql($where, $this->MODIFIED_DATE, $default, false); // MODIFIED_DATE
        $this->buildSearchSql($where, $this->MODIFIED_BY, $default, false); // MODIFIED_BY
        $this->buildSearchSql($where, $this->MODIFIED_FROM, $default, false); // MODIFIED_FROM
        $this->buildSearchSql($where, $this->POSTAL_CODE, $default, false); // POSTAL_CODE
        $this->buildSearchSql($where, $this->GELAR, $default, false); // GELAR
        $this->buildSearchSql($where, $this->BLOOD_TYPE_ID, $default, false); // BLOOD_TYPE_ID
        $this->buildSearchSql($where, $this->FAMILY_STATUS_ID, $default, false); // FAMILY_STATUS_ID
        $this->buildSearchSql($where, $this->ISMENINGGAL, $default, false); // ISMENINGGAL
        $this->buildSearchSql($where, $this->DEATH_DATE, $default, false); // DEATH_DATE
        $this->buildSearchSql($where, $this->PAYOR_ID, $default, false); // PAYOR_ID
        $this->buildSearchSql($where, $this->CLASS_ID, $default, false); // CLASS_ID
        $this->buildSearchSql($where, $this->ACCOUNT_ID, $default, false); // ACCOUNT_ID
        $this->buildSearchSql($where, $this->KARYAWAN, $default, false); // KARYAWAN
        $this->buildSearchSql($where, $this->DESCRIPTION, $default, false); // DESCRIPTION
        $this->buildSearchSql($where, $this->NEWCARD, $default, false); // NEWCARD
        $this->buildSearchSql($where, $this->BACKCHARGE, $default, false); // BACKCHARGE
        $this->buildSearchSql($where, $this->ORG_ID, $default, false); // ORG_ID
        $this->buildSearchSql($where, $this->COVERAGE_ID, $default, false); // COVERAGE_ID
        $this->buildSearchSql($where, $this->MOTHER, $default, false); // MOTHER
        $this->buildSearchSql($where, $this->FATHER, $default, false); // FATHER
        $this->buildSearchSql($where, $this->SPOUSE, $default, false); // SPOUSE
        $this->buildSearchSql($where, $this->AKTIF, $default, false); // AKTIF
        $this->buildSearchSql($where, $this->TMT, $default, false); // TMT
        $this->buildSearchSql($where, $this->TAT, $default, false); // TAT
        $this->buildSearchSql($where, $this->CARD_ID, $default, false); // CARD_ID
        $this->buildSearchSql($where, $this->MEDICAL_NOTES, $default, false); // MEDICAL_NOTES
        $this->buildSearchSql($where, $this->ID, $default, false); // ID
        $this->buildSearchSql($where, $this->newapp, $default, false); // newapp
        $this->buildSearchSql($where, $this->cek, $default, false); // cek

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->ORG_UNIT_CODE->AdvancedSearch->save(); // ORG_UNIT_CODE
            $this->NO_REGISTRATION->AdvancedSearch->save(); // NO_REGISTRATION
            $this->NAME_OF_PASIEN->AdvancedSearch->save(); // NAME_OF_PASIEN
            $this->PASIEN_ID->AdvancedSearch->save(); // PASIEN_ID
            $this->EMPLOYEE_ID->AdvancedSearch->save(); // EMPLOYEE_ID
            $this->KK_NO->AdvancedSearch->save(); // KK_NO
            $this->PLACE_OF_BIRTH->AdvancedSearch->save(); // PLACE_OF_BIRTH
            $this->DATE_OF_BIRTH->AdvancedSearch->save(); // DATE_OF_BIRTH
            $this->GENDER->AdvancedSearch->save(); // GENDER
            $this->NATION_ID->AdvancedSearch->save(); // NATION_ID
            $this->EDUCATION_TYPE_CODE->AdvancedSearch->save(); // EDUCATION_TYPE_CODE
            $this->MARITALSTATUSID->AdvancedSearch->save(); // MARITALSTATUSID
            $this->KODE_AGAMA->AdvancedSearch->save(); // KODE_AGAMA
            $this->KAL_ID->AdvancedSearch->save(); // KAL_ID
            $this->RT->AdvancedSearch->save(); // RT
            $this->RW->AdvancedSearch->save(); // RW
            $this->JOB_ID->AdvancedSearch->save(); // JOB_ID
            $this->STATUS_PASIEN_ID->AdvancedSearch->save(); // STATUS_PASIEN_ID
            $this->ANAK_KE->AdvancedSearch->save(); // ANAK_KE
            $this->CONTACT_ADDRESS->AdvancedSearch->save(); // CONTACT_ADDRESS
            $this->PHONE_NUMBER->AdvancedSearch->save(); // PHONE_NUMBER
            $this->MOBILE->AdvancedSearch->save(); // MOBILE
            $this->_EMAIL->AdvancedSearch->save(); // EMAIL
            $this->PHOTO_LOCATION->AdvancedSearch->save(); // PHOTO_LOCATION
            $this->REGISTRATION_DATE->AdvancedSearch->save(); // REGISTRATION_DATE
            $this->MODIFIED_DATE->AdvancedSearch->save(); // MODIFIED_DATE
            $this->MODIFIED_BY->AdvancedSearch->save(); // MODIFIED_BY
            $this->MODIFIED_FROM->AdvancedSearch->save(); // MODIFIED_FROM
            $this->POSTAL_CODE->AdvancedSearch->save(); // POSTAL_CODE
            $this->GELAR->AdvancedSearch->save(); // GELAR
            $this->BLOOD_TYPE_ID->AdvancedSearch->save(); // BLOOD_TYPE_ID
            $this->FAMILY_STATUS_ID->AdvancedSearch->save(); // FAMILY_STATUS_ID
            $this->ISMENINGGAL->AdvancedSearch->save(); // ISMENINGGAL
            $this->DEATH_DATE->AdvancedSearch->save(); // DEATH_DATE
            $this->PAYOR_ID->AdvancedSearch->save(); // PAYOR_ID
            $this->CLASS_ID->AdvancedSearch->save(); // CLASS_ID
            $this->ACCOUNT_ID->AdvancedSearch->save(); // ACCOUNT_ID
            $this->KARYAWAN->AdvancedSearch->save(); // KARYAWAN
            $this->DESCRIPTION->AdvancedSearch->save(); // DESCRIPTION
            $this->NEWCARD->AdvancedSearch->save(); // NEWCARD
            $this->BACKCHARGE->AdvancedSearch->save(); // BACKCHARGE
            $this->ORG_ID->AdvancedSearch->save(); // ORG_ID
            $this->COVERAGE_ID->AdvancedSearch->save(); // COVERAGE_ID
            $this->MOTHER->AdvancedSearch->save(); // MOTHER
            $this->FATHER->AdvancedSearch->save(); // FATHER
            $this->SPOUSE->AdvancedSearch->save(); // SPOUSE
            $this->AKTIF->AdvancedSearch->save(); // AKTIF
            $this->TMT->AdvancedSearch->save(); // TMT
            $this->TAT->AdvancedSearch->save(); // TAT
            $this->CARD_ID->AdvancedSearch->save(); // CARD_ID
            $this->MEDICAL_NOTES->AdvancedSearch->save(); // MEDICAL_NOTES
            $this->ID->AdvancedSearch->save(); // ID
            $this->newapp->AdvancedSearch->save(); // newapp
            $this->cek->AdvancedSearch->save(); // cek
        }
        return $where;
    }

    // Build search SQL
    protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
    {
        $fldParm = $fld->Param;
        $fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
        $fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
        $fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
        $fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
        $wrk = "";
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr));
        if ($fldOpr == "") {
            $fldOpr = "=";
        }
        $fldOpr2 = strtoupper(trim($fldOpr2));
        if ($fldOpr2 == "") {
            $fldOpr2 = "=";
        }
        if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 || !IsMultiSearchOperator($fldOpr)) {
            $multiValue = false;
        }
        if ($multiValue) {
            $wrk1 = ($fldVal != "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
            $wrk2 = ($fldVal2 != "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
            $wrk = $wrk1; // Build final SQL
            if ($wrk2 != "") {
                $wrk = ($wrk != "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
            }
        } else {
            $fldVal = $this->convertSearchValue($fld, $fldVal);
            $fldVal2 = $this->convertSearchValue($fld, $fldVal2);
            $wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
        }
        AddFilter($where, $wrk);
    }

    // Convert search value
    protected function convertSearchValue(&$fld, $fldVal)
    {
        if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE")) {
            return $fldVal;
        }
        $value = $fldVal;
        if ($fld->isBoolean()) {
            if ($fldVal != "") {
                $value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
            }
        } elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
            if ($fldVal != "") {
                $value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
            }
        }
        return $value;
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->NO_REGISTRATION, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->NAME_OF_PASIEN, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->PASIEN_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->KK_NO, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->MOTHER, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->FATHER, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->SPOUSE, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->newapp, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->cek, $arKeywords, $type);
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
        if ($this->ORG_UNIT_CODE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NO_REGISTRATION->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NAME_OF_PASIEN->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PASIEN_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->EMPLOYEE_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->KK_NO->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PLACE_OF_BIRTH->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DATE_OF_BIRTH->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->GENDER->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NATION_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->EDUCATION_TYPE_CODE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->MARITALSTATUSID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->KODE_AGAMA->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->KAL_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->RT->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->RW->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->JOB_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->STATUS_PASIEN_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ANAK_KE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->CONTACT_ADDRESS->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PHONE_NUMBER->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->MOBILE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->_EMAIL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PHOTO_LOCATION->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->REGISTRATION_DATE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->MODIFIED_DATE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->MODIFIED_BY->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->MODIFIED_FROM->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->POSTAL_CODE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->GELAR->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->BLOOD_TYPE_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->FAMILY_STATUS_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ISMENINGGAL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DEATH_DATE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PAYOR_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->CLASS_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ACCOUNT_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->KARYAWAN->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DESCRIPTION->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NEWCARD->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->BACKCHARGE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ORG_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->COVERAGE_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->MOTHER->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->FATHER->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->SPOUSE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->AKTIF->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->TMT->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->TAT->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->CARD_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->MEDICAL_NOTES->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->newapp->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->cek->AdvancedSearch->issetSession()) {
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

        // Clear advanced search parameters
        $this->resetAdvancedSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
                $this->REGISTRATION_DATE->AdvancedSearch->loadDefault();
        return true;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Clear all advanced search parameters
    protected function resetAdvancedSearchParms()
    {
                $this->ORG_UNIT_CODE->AdvancedSearch->unsetSession();
                $this->NO_REGISTRATION->AdvancedSearch->unsetSession();
                $this->NAME_OF_PASIEN->AdvancedSearch->unsetSession();
                $this->PASIEN_ID->AdvancedSearch->unsetSession();
                $this->EMPLOYEE_ID->AdvancedSearch->unsetSession();
                $this->KK_NO->AdvancedSearch->unsetSession();
                $this->PLACE_OF_BIRTH->AdvancedSearch->unsetSession();
                $this->DATE_OF_BIRTH->AdvancedSearch->unsetSession();
                $this->GENDER->AdvancedSearch->unsetSession();
                $this->NATION_ID->AdvancedSearch->unsetSession();
                $this->EDUCATION_TYPE_CODE->AdvancedSearch->unsetSession();
                $this->MARITALSTATUSID->AdvancedSearch->unsetSession();
                $this->KODE_AGAMA->AdvancedSearch->unsetSession();
                $this->KAL_ID->AdvancedSearch->unsetSession();
                $this->RT->AdvancedSearch->unsetSession();
                $this->RW->AdvancedSearch->unsetSession();
                $this->JOB_ID->AdvancedSearch->unsetSession();
                $this->STATUS_PASIEN_ID->AdvancedSearch->unsetSession();
                $this->ANAK_KE->AdvancedSearch->unsetSession();
                $this->CONTACT_ADDRESS->AdvancedSearch->unsetSession();
                $this->PHONE_NUMBER->AdvancedSearch->unsetSession();
                $this->MOBILE->AdvancedSearch->unsetSession();
                $this->_EMAIL->AdvancedSearch->unsetSession();
                $this->PHOTO_LOCATION->AdvancedSearch->unsetSession();
                $this->REGISTRATION_DATE->AdvancedSearch->unsetSession();
                $this->MODIFIED_DATE->AdvancedSearch->unsetSession();
                $this->MODIFIED_BY->AdvancedSearch->unsetSession();
                $this->MODIFIED_FROM->AdvancedSearch->unsetSession();
                $this->POSTAL_CODE->AdvancedSearch->unsetSession();
                $this->GELAR->AdvancedSearch->unsetSession();
                $this->BLOOD_TYPE_ID->AdvancedSearch->unsetSession();
                $this->FAMILY_STATUS_ID->AdvancedSearch->unsetSession();
                $this->ISMENINGGAL->AdvancedSearch->unsetSession();
                $this->DEATH_DATE->AdvancedSearch->unsetSession();
                $this->PAYOR_ID->AdvancedSearch->unsetSession();
                $this->CLASS_ID->AdvancedSearch->unsetSession();
                $this->ACCOUNT_ID->AdvancedSearch->unsetSession();
                $this->KARYAWAN->AdvancedSearch->unsetSession();
                $this->DESCRIPTION->AdvancedSearch->unsetSession();
                $this->NEWCARD->AdvancedSearch->unsetSession();
                $this->BACKCHARGE->AdvancedSearch->unsetSession();
                $this->ORG_ID->AdvancedSearch->unsetSession();
                $this->COVERAGE_ID->AdvancedSearch->unsetSession();
                $this->MOTHER->AdvancedSearch->unsetSession();
                $this->FATHER->AdvancedSearch->unsetSession();
                $this->SPOUSE->AdvancedSearch->unsetSession();
                $this->AKTIF->AdvancedSearch->unsetSession();
                $this->TMT->AdvancedSearch->unsetSession();
                $this->TAT->AdvancedSearch->unsetSession();
                $this->CARD_ID->AdvancedSearch->unsetSession();
                $this->MEDICAL_NOTES->AdvancedSearch->unsetSession();
                $this->ID->AdvancedSearch->unsetSession();
                $this->newapp->AdvancedSearch->unsetSession();
                $this->cek->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
                $this->ORG_UNIT_CODE->AdvancedSearch->load();
                $this->NO_REGISTRATION->AdvancedSearch->load();
                $this->NAME_OF_PASIEN->AdvancedSearch->load();
                $this->PASIEN_ID->AdvancedSearch->load();
                $this->EMPLOYEE_ID->AdvancedSearch->load();
                $this->KK_NO->AdvancedSearch->load();
                $this->PLACE_OF_BIRTH->AdvancedSearch->load();
                $this->DATE_OF_BIRTH->AdvancedSearch->load();
                $this->GENDER->AdvancedSearch->load();
                $this->NATION_ID->AdvancedSearch->load();
                $this->EDUCATION_TYPE_CODE->AdvancedSearch->load();
                $this->MARITALSTATUSID->AdvancedSearch->load();
                $this->KODE_AGAMA->AdvancedSearch->load();
                $this->KAL_ID->AdvancedSearch->load();
                $this->RT->AdvancedSearch->load();
                $this->RW->AdvancedSearch->load();
                $this->JOB_ID->AdvancedSearch->load();
                $this->STATUS_PASIEN_ID->AdvancedSearch->load();
                $this->ANAK_KE->AdvancedSearch->load();
                $this->CONTACT_ADDRESS->AdvancedSearch->load();
                $this->PHONE_NUMBER->AdvancedSearch->load();
                $this->MOBILE->AdvancedSearch->load();
                $this->_EMAIL->AdvancedSearch->load();
                $this->PHOTO_LOCATION->AdvancedSearch->load();
                $this->REGISTRATION_DATE->AdvancedSearch->load();
                $this->MODIFIED_DATE->AdvancedSearch->load();
                $this->MODIFIED_BY->AdvancedSearch->load();
                $this->MODIFIED_FROM->AdvancedSearch->load();
                $this->POSTAL_CODE->AdvancedSearch->load();
                $this->GELAR->AdvancedSearch->load();
                $this->BLOOD_TYPE_ID->AdvancedSearch->load();
                $this->FAMILY_STATUS_ID->AdvancedSearch->load();
                $this->ISMENINGGAL->AdvancedSearch->load();
                $this->DEATH_DATE->AdvancedSearch->load();
                $this->PAYOR_ID->AdvancedSearch->load();
                $this->CLASS_ID->AdvancedSearch->load();
                $this->ACCOUNT_ID->AdvancedSearch->load();
                $this->KARYAWAN->AdvancedSearch->load();
                $this->DESCRIPTION->AdvancedSearch->load();
                $this->NEWCARD->AdvancedSearch->load();
                $this->BACKCHARGE->AdvancedSearch->load();
                $this->ORG_ID->AdvancedSearch->load();
                $this->COVERAGE_ID->AdvancedSearch->load();
                $this->MOTHER->AdvancedSearch->load();
                $this->FATHER->AdvancedSearch->load();
                $this->SPOUSE->AdvancedSearch->load();
                $this->AKTIF->AdvancedSearch->load();
                $this->TMT->AdvancedSearch->load();
                $this->TAT->AdvancedSearch->load();
                $this->CARD_ID->AdvancedSearch->load();
                $this->MEDICAL_NOTES->AdvancedSearch->load();
                $this->ID->AdvancedSearch->load();
                $this->newapp->AdvancedSearch->load();
                $this->cek->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->NO_REGISTRATION); // NO_REGISTRATION
            $this->updateSort($this->NAME_OF_PASIEN); // NAME_OF_PASIEN
            $this->updateSort($this->PASIEN_ID); // PASIEN_ID
            $this->updateSort($this->KK_NO); // KK_NO
            $this->updateSort($this->GENDER); // GENDER
            $this->updateSort($this->STATUS_PASIEN_ID); // STATUS_PASIEN_ID
            $this->updateSort($this->CONTACT_ADDRESS); // CONTACT_ADDRESS
            $this->updateSort($this->REGISTRATION_DATE); // REGISTRATION_DATE
            $this->updateSort($this->MOTHER); // MOTHER
            $this->updateSort($this->FATHER); // FATHER
            $this->updateSort($this->SPOUSE); // SPOUSE
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "[REGISTRATION_DATE] DESC";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($this->REGISTRATION_DATE->getSort() != "") {
                    $useDefaultSort = false;
                }
                if ($useDefaultSort) {
                    $this->REGISTRATION_DATE->setSort("DESC");
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
                $this->NO_REGISTRATION->setSort("");
                $this->NAME_OF_PASIEN->setSort("");
                $this->PASIEN_ID->setSort("");
                $this->EMPLOYEE_ID->setSort("");
                $this->KK_NO->setSort("");
                $this->PLACE_OF_BIRTH->setSort("");
                $this->DATE_OF_BIRTH->setSort("");
                $this->GENDER->setSort("");
                $this->NATION_ID->setSort("");
                $this->EDUCATION_TYPE_CODE->setSort("");
                $this->MARITALSTATUSID->setSort("");
                $this->KODE_AGAMA->setSort("");
                $this->KAL_ID->setSort("");
                $this->RT->setSort("");
                $this->RW->setSort("");
                $this->JOB_ID->setSort("");
                $this->STATUS_PASIEN_ID->setSort("");
                $this->ANAK_KE->setSort("");
                $this->CONTACT_ADDRESS->setSort("");
                $this->PHONE_NUMBER->setSort("");
                $this->MOBILE->setSort("");
                $this->_EMAIL->setSort("");
                $this->PHOTO_LOCATION->setSort("");
                $this->REGISTRATION_DATE->setSort("");
                $this->MODIFIED_DATE->setSort("");
                $this->MODIFIED_BY->setSort("");
                $this->MODIFIED_FROM->setSort("");
                $this->POSTAL_CODE->setSort("");
                $this->GELAR->setSort("");
                $this->BLOOD_TYPE_ID->setSort("");
                $this->FAMILY_STATUS_ID->setSort("");
                $this->ISMENINGGAL->setSort("");
                $this->DEATH_DATE->setSort("");
                $this->PAYOR_ID->setSort("");
                $this->CLASS_ID->setSort("");
                $this->ACCOUNT_ID->setSort("");
                $this->KARYAWAN->setSort("");
                $this->DESCRIPTION->setSort("");
                $this->NEWCARD->setSort("");
                $this->BACKCHARGE->setSort("");
                $this->ORG_ID->setSort("");
                $this->COVERAGE_ID->setSort("");
                $this->MOTHER->setSort("");
                $this->FATHER->setSort("");
                $this->SPOUSE->setSort("");
                $this->AKTIF->setSort("");
                $this->TMT->setSort("");
                $this->TAT->setSort("");
                $this->CARD_ID->setSort("");
                $this->MEDICAL_NOTES->setSort("");
                $this->ID->setSort("");
                $this->newapp->setSort("");
                $this->cek->setSort("");
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

        // "detail_PASIEN_VISITATION"
        $item = &$this->ListOptions->add("detail_PASIEN_VISITATION");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'PASIEN_VISITATION') && !$this->ShowMultipleDetails;
        $item->OnLeft = true;
        $item->ShowInButtonGroup = false;

        // Multiple details
        if ($this->ShowMultipleDetails) {
            $item = &$this->ListOptions->add("details");
            $item->CssClass = "text-nowrap";
            $item->Visible = $this->ShowMultipleDetails;
            $item->OnLeft = true;
            $item->ShowInButtonGroup = false;
        }

        // Set up detail pages
        $pages = new SubPages();
        $pages->add("PASIEN_VISITATION");
        $this->DetailPages = $pages;

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
        $detailViewTblVar = "";
        $detailCopyTblVar = "";
        $detailEditTblVar = "";

        // "detail_PASIEN_VISITATION"
        $opt = $this->ListOptions["detail_PASIEN_VISITATION"];
        if ($Security->allowList(CurrentProjectID() . 'PASIEN_VISITATION')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("PASIEN_VISITATION", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PasienVisitationList?" . Config("TABLE_SHOW_MASTER") . "=cv_pasien&" . GetForeignKeyUrl("fk_NO_REGISTRATION", $this->NO_REGISTRATION->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PasienVisitationGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'cv_pasien')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=PASIEN_VISITATION");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "PASIEN_VISITATION";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'cv_pasien')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=PASIEN_VISITATION");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "PASIEN_VISITATION";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }
        if ($this->ShowMultipleDetails) {
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
            $links = "";
            if ($detailViewTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
            }
            if ($detailEditTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
            }
            if ($detailCopyTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
                $body .= "<ul class=\"dropdown-menu ew-menu\">" . $links . "</ul>";
            }
            $body .= "</div>";
            // Multiple details
            $opt = $this->ListOptions["details"];
            $opt->Body = $body;
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ID->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["detail"];
        $detailTableLink = "";
                $item = &$option->add("detailadd_PASIEN_VISITATION");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=PASIEN_VISITATION");
                $detailPage = Container("PasienVisitationGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'cv_pasien') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "PASIEN_VISITATION";
                }

        // Add multiple details
        if ($this->ShowMultipleDetails) {
            $item = &$option->add("detailsadd");
            $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
            $caption = $Language->phrase("AddMasterDetailLink");
            $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
            $item->Visible = $detailTableLink != "" && $Security->canAdd();
            // Hide single master/detail items
            $ar = explode(",", $detailTableLink);
            $cnt = count($ar);
            for ($i = 0; $i < $cnt; $i++) {
                if ($item = $option["detailadd_" . $ar[$i]]) {
                    $item->Visible = false;
                }
            }
        }
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fcv_pasienlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fcv_pasienlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fcv_pasienlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // ORG_UNIT_CODE
        if (!$this->isAddOrEdit() && $this->ORG_UNIT_CODE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ORG_UNIT_CODE->AdvancedSearch->SearchValue != "" || $this->ORG_UNIT_CODE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // NO_REGISTRATION
        if (!$this->isAddOrEdit() && $this->NO_REGISTRATION->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->NO_REGISTRATION->AdvancedSearch->SearchValue != "" || $this->NO_REGISTRATION->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // NAME_OF_PASIEN
        if (!$this->isAddOrEdit() && $this->NAME_OF_PASIEN->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->NAME_OF_PASIEN->AdvancedSearch->SearchValue != "" || $this->NAME_OF_PASIEN->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PASIEN_ID
        if (!$this->isAddOrEdit() && $this->PASIEN_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PASIEN_ID->AdvancedSearch->SearchValue != "" || $this->PASIEN_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // EMPLOYEE_ID
        if (!$this->isAddOrEdit() && $this->EMPLOYEE_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->EMPLOYEE_ID->AdvancedSearch->SearchValue != "" || $this->EMPLOYEE_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // KK_NO
        if (!$this->isAddOrEdit() && $this->KK_NO->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->KK_NO->AdvancedSearch->SearchValue != "" || $this->KK_NO->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PLACE_OF_BIRTH
        if (!$this->isAddOrEdit() && $this->PLACE_OF_BIRTH->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PLACE_OF_BIRTH->AdvancedSearch->SearchValue != "" || $this->PLACE_OF_BIRTH->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DATE_OF_BIRTH
        if (!$this->isAddOrEdit() && $this->DATE_OF_BIRTH->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DATE_OF_BIRTH->AdvancedSearch->SearchValue != "" || $this->DATE_OF_BIRTH->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // GENDER
        if (!$this->isAddOrEdit() && $this->GENDER->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->GENDER->AdvancedSearch->SearchValue != "" || $this->GENDER->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // NATION_ID
        if (!$this->isAddOrEdit() && $this->NATION_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->NATION_ID->AdvancedSearch->SearchValue != "" || $this->NATION_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // EDUCATION_TYPE_CODE
        if (!$this->isAddOrEdit() && $this->EDUCATION_TYPE_CODE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchValue != "" || $this->EDUCATION_TYPE_CODE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // MARITALSTATUSID
        if (!$this->isAddOrEdit() && $this->MARITALSTATUSID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->MARITALSTATUSID->AdvancedSearch->SearchValue != "" || $this->MARITALSTATUSID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // KODE_AGAMA
        if (!$this->isAddOrEdit() && $this->KODE_AGAMA->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->KODE_AGAMA->AdvancedSearch->SearchValue != "" || $this->KODE_AGAMA->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // KAL_ID
        if (!$this->isAddOrEdit() && $this->KAL_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->KAL_ID->AdvancedSearch->SearchValue != "" || $this->KAL_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // RT
        if (!$this->isAddOrEdit() && $this->RT->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->RT->AdvancedSearch->SearchValue != "" || $this->RT->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // RW
        if (!$this->isAddOrEdit() && $this->RW->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->RW->AdvancedSearch->SearchValue != "" || $this->RW->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // JOB_ID
        if (!$this->isAddOrEdit() && $this->JOB_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->JOB_ID->AdvancedSearch->SearchValue != "" || $this->JOB_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // STATUS_PASIEN_ID
        if (!$this->isAddOrEdit() && $this->STATUS_PASIEN_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue != "" || $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ANAK_KE
        if (!$this->isAddOrEdit() && $this->ANAK_KE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ANAK_KE->AdvancedSearch->SearchValue != "" || $this->ANAK_KE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // CONTACT_ADDRESS
        if (!$this->isAddOrEdit() && $this->CONTACT_ADDRESS->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->CONTACT_ADDRESS->AdvancedSearch->SearchValue != "" || $this->CONTACT_ADDRESS->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PHONE_NUMBER
        if (!$this->isAddOrEdit() && $this->PHONE_NUMBER->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PHONE_NUMBER->AdvancedSearch->SearchValue != "" || $this->PHONE_NUMBER->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // MOBILE
        if (!$this->isAddOrEdit() && $this->MOBILE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->MOBILE->AdvancedSearch->SearchValue != "" || $this->MOBILE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // EMAIL
        if (!$this->isAddOrEdit() && $this->_EMAIL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->_EMAIL->AdvancedSearch->SearchValue != "" || $this->_EMAIL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PHOTO_LOCATION
        if (!$this->isAddOrEdit() && $this->PHOTO_LOCATION->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PHOTO_LOCATION->AdvancedSearch->SearchValue != "" || $this->PHOTO_LOCATION->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // REGISTRATION_DATE
        if (!$this->isAddOrEdit() && $this->REGISTRATION_DATE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->REGISTRATION_DATE->AdvancedSearch->SearchValue != "" || $this->REGISTRATION_DATE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // MODIFIED_DATE
        if (!$this->isAddOrEdit() && $this->MODIFIED_DATE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->MODIFIED_DATE->AdvancedSearch->SearchValue != "" || $this->MODIFIED_DATE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // MODIFIED_BY
        if (!$this->isAddOrEdit() && $this->MODIFIED_BY->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->MODIFIED_BY->AdvancedSearch->SearchValue != "" || $this->MODIFIED_BY->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // MODIFIED_FROM
        if (!$this->isAddOrEdit() && $this->MODIFIED_FROM->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->MODIFIED_FROM->AdvancedSearch->SearchValue != "" || $this->MODIFIED_FROM->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // POSTAL_CODE
        if (!$this->isAddOrEdit() && $this->POSTAL_CODE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->POSTAL_CODE->AdvancedSearch->SearchValue != "" || $this->POSTAL_CODE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // GELAR
        if (!$this->isAddOrEdit() && $this->GELAR->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->GELAR->AdvancedSearch->SearchValue != "" || $this->GELAR->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // BLOOD_TYPE_ID
        if (!$this->isAddOrEdit() && $this->BLOOD_TYPE_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->BLOOD_TYPE_ID->AdvancedSearch->SearchValue != "" || $this->BLOOD_TYPE_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // FAMILY_STATUS_ID
        if (!$this->isAddOrEdit() && $this->FAMILY_STATUS_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->FAMILY_STATUS_ID->AdvancedSearch->SearchValue != "" || $this->FAMILY_STATUS_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ISMENINGGAL
        if (!$this->isAddOrEdit() && $this->ISMENINGGAL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ISMENINGGAL->AdvancedSearch->SearchValue != "" || $this->ISMENINGGAL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DEATH_DATE
        if (!$this->isAddOrEdit() && $this->DEATH_DATE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DEATH_DATE->AdvancedSearch->SearchValue != "" || $this->DEATH_DATE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PAYOR_ID
        if (!$this->isAddOrEdit() && $this->PAYOR_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PAYOR_ID->AdvancedSearch->SearchValue != "" || $this->PAYOR_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // CLASS_ID
        if (!$this->isAddOrEdit() && $this->CLASS_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->CLASS_ID->AdvancedSearch->SearchValue != "" || $this->CLASS_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ACCOUNT_ID
        if (!$this->isAddOrEdit() && $this->ACCOUNT_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ACCOUNT_ID->AdvancedSearch->SearchValue != "" || $this->ACCOUNT_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // KARYAWAN
        if (!$this->isAddOrEdit() && $this->KARYAWAN->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->KARYAWAN->AdvancedSearch->SearchValue != "" || $this->KARYAWAN->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DESCRIPTION
        if (!$this->isAddOrEdit() && $this->DESCRIPTION->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DESCRIPTION->AdvancedSearch->SearchValue != "" || $this->DESCRIPTION->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // NEWCARD
        if (!$this->isAddOrEdit() && $this->NEWCARD->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->NEWCARD->AdvancedSearch->SearchValue != "" || $this->NEWCARD->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // BACKCHARGE
        if (!$this->isAddOrEdit() && $this->BACKCHARGE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->BACKCHARGE->AdvancedSearch->SearchValue != "" || $this->BACKCHARGE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ORG_ID
        if (!$this->isAddOrEdit() && $this->ORG_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ORG_ID->AdvancedSearch->SearchValue != "" || $this->ORG_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // COVERAGE_ID
        if (!$this->isAddOrEdit() && $this->COVERAGE_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->COVERAGE_ID->AdvancedSearch->SearchValue != "" || $this->COVERAGE_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // MOTHER
        if (!$this->isAddOrEdit() && $this->MOTHER->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->MOTHER->AdvancedSearch->SearchValue != "" || $this->MOTHER->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // FATHER
        if (!$this->isAddOrEdit() && $this->FATHER->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->FATHER->AdvancedSearch->SearchValue != "" || $this->FATHER->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // SPOUSE
        if (!$this->isAddOrEdit() && $this->SPOUSE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->SPOUSE->AdvancedSearch->SearchValue != "" || $this->SPOUSE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // AKTIF
        if (!$this->isAddOrEdit() && $this->AKTIF->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->AKTIF->AdvancedSearch->SearchValue != "" || $this->AKTIF->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // TMT
        if (!$this->isAddOrEdit() && $this->TMT->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->TMT->AdvancedSearch->SearchValue != "" || $this->TMT->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // TAT
        if (!$this->isAddOrEdit() && $this->TAT->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->TAT->AdvancedSearch->SearchValue != "" || $this->TAT->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // CARD_ID
        if (!$this->isAddOrEdit() && $this->CARD_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->CARD_ID->AdvancedSearch->SearchValue != "" || $this->CARD_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // MEDICAL_NOTES
        if (!$this->isAddOrEdit() && $this->MEDICAL_NOTES->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->MEDICAL_NOTES->AdvancedSearch->SearchValue != "" || $this->MEDICAL_NOTES->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ID
        if (!$this->isAddOrEdit() && $this->ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ID->AdvancedSearch->SearchValue != "" || $this->ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // newapp
        if (!$this->isAddOrEdit() && $this->newapp->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->newapp->AdvancedSearch->SearchValue != "" || $this->newapp->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // cek
        if (!$this->isAddOrEdit() && $this->cek->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->cek->AdvancedSearch->SearchValue != "" || $this->cek->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }
        return $hasValue;
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
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->NAME_OF_PASIEN->setDbValue($row['NAME_OF_PASIEN']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->KK_NO->setDbValue($row['KK_NO']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->DATE_OF_BIRTH->setDbValue($row['DATE_OF_BIRTH']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->NATION_ID->setDbValue($row['NATION_ID']);
        $this->EDUCATION_TYPE_CODE->setDbValue($row['EDUCATION_TYPE_CODE']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->JOB_ID->setDbValue($row['JOB_ID']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->ANAK_KE->setDbValue($row['ANAK_KE']);
        $this->CONTACT_ADDRESS->setDbValue($row['CONTACT_ADDRESS']);
        $this->PHONE_NUMBER->setDbValue($row['PHONE_NUMBER']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->PHOTO_LOCATION->setDbValue($row['PHOTO_LOCATION']);
        $this->REGISTRATION_DATE->setDbValue($row['REGISTRATION_DATE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->POSTAL_CODE->setDbValue($row['POSTAL_CODE']);
        $this->GELAR->setDbValue($row['GELAR']);
        $this->BLOOD_TYPE_ID->setDbValue($row['BLOOD_TYPE_ID']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->ISMENINGGAL->setDbValue($row['ISMENINGGAL']);
        $this->DEATH_DATE->setDbValue($row['DEATH_DATE']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->KARYAWAN->setDbValue($row['KARYAWAN']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->NEWCARD->setDbValue($row['NEWCARD']);
        $this->BACKCHARGE->setDbValue($row['BACKCHARGE']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->COVERAGE_ID->setDbValue($row['COVERAGE_ID']);
        $this->MOTHER->setDbValue($row['MOTHER']);
        $this->FATHER->setDbValue($row['FATHER']);
        $this->SPOUSE->setDbValue($row['SPOUSE']);
        $this->AKTIF->setDbValue($row['AKTIF']);
        $this->TMT->setDbValue($row['TMT']);
        $this->TAT->setDbValue($row['TAT']);
        $this->CARD_ID->setDbValue($row['CARD_ID']);
        $this->MEDICAL_NOTES->setDbValue($row['MEDICAL_NOTES']);
        $this->ID->setDbValue($row['ID']);
        $this->newapp->setDbValue($row['newapp']);
        $this->cek->setDbValue($row['cek']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ORG_UNIT_CODE'] = null;
        $row['NO_REGISTRATION'] = null;
        $row['NAME_OF_PASIEN'] = null;
        $row['PASIEN_ID'] = null;
        $row['EMPLOYEE_ID'] = null;
        $row['KK_NO'] = null;
        $row['PLACE_OF_BIRTH'] = null;
        $row['DATE_OF_BIRTH'] = null;
        $row['GENDER'] = null;
        $row['NATION_ID'] = null;
        $row['EDUCATION_TYPE_CODE'] = null;
        $row['MARITALSTATUSID'] = null;
        $row['KODE_AGAMA'] = null;
        $row['KAL_ID'] = null;
        $row['RT'] = null;
        $row['RW'] = null;
        $row['JOB_ID'] = null;
        $row['STATUS_PASIEN_ID'] = null;
        $row['ANAK_KE'] = null;
        $row['CONTACT_ADDRESS'] = null;
        $row['PHONE_NUMBER'] = null;
        $row['MOBILE'] = null;
        $row['EMAIL'] = null;
        $row['PHOTO_LOCATION'] = null;
        $row['REGISTRATION_DATE'] = null;
        $row['MODIFIED_DATE'] = null;
        $row['MODIFIED_BY'] = null;
        $row['MODIFIED_FROM'] = null;
        $row['POSTAL_CODE'] = null;
        $row['GELAR'] = null;
        $row['BLOOD_TYPE_ID'] = null;
        $row['FAMILY_STATUS_ID'] = null;
        $row['ISMENINGGAL'] = null;
        $row['DEATH_DATE'] = null;
        $row['PAYOR_ID'] = null;
        $row['CLASS_ID'] = null;
        $row['ACCOUNT_ID'] = null;
        $row['KARYAWAN'] = null;
        $row['DESCRIPTION'] = null;
        $row['NEWCARD'] = null;
        $row['BACKCHARGE'] = null;
        $row['ORG_ID'] = null;
        $row['COVERAGE_ID'] = null;
        $row['MOTHER'] = null;
        $row['FATHER'] = null;
        $row['SPOUSE'] = null;
        $row['AKTIF'] = null;
        $row['TMT'] = null;
        $row['TAT'] = null;
        $row['CARD_ID'] = null;
        $row['MEDICAL_NOTES'] = null;
        $row['ID'] = null;
        $row['newapp'] = null;
        $row['cek'] = null;
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

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->CellCssStyle = "white-space: nowrap;";

        // PASIEN_ID
        $this->PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // KK_NO
        $this->KK_NO->CellCssStyle = "white-space: nowrap;";

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->CellCssStyle = "white-space: nowrap;";

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // NATION_ID
        $this->NATION_ID->CellCssStyle = "white-space: nowrap;";

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->CellCssStyle = "white-space: nowrap;";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->CellCssStyle = "white-space: nowrap;";

        // KODE_AGAMA
        $this->KODE_AGAMA->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // RT
        $this->RT->CellCssStyle = "white-space: nowrap;";

        // RW
        $this->RW->CellCssStyle = "white-space: nowrap;";

        // JOB_ID
        $this->JOB_ID->CellCssStyle = "white-space: nowrap;";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // ANAK_KE
        $this->ANAK_KE->CellCssStyle = "white-space: nowrap;";

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->CellCssStyle = "white-space: nowrap;";

        // PHONE_NUMBER
        $this->PHONE_NUMBER->CellCssStyle = "white-space: nowrap;";

        // MOBILE
        $this->MOBILE->CellCssStyle = "white-space: nowrap;";

        // EMAIL
        $this->_EMAIL->CellCssStyle = "white-space: nowrap;";

        // PHOTO_LOCATION
        $this->PHOTO_LOCATION->CellCssStyle = "white-space: nowrap;";

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // POSTAL_CODE
        $this->POSTAL_CODE->CellCssStyle = "white-space: nowrap;";

        // GELAR
        $this->GELAR->CellCssStyle = "white-space: nowrap;";

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID->CellCssStyle = "white-space: nowrap;";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->CellCssStyle = "white-space: nowrap;";

        // ISMENINGGAL
        $this->ISMENINGGAL->CellCssStyle = "white-space: nowrap;";

        // DEATH_DATE
        $this->DEATH_DATE->CellCssStyle = "white-space: nowrap;";

        // PAYOR_ID
        $this->PAYOR_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID
        $this->CLASS_ID->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // KARYAWAN
        $this->KARYAWAN->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // NEWCARD
        $this->NEWCARD->CellCssStyle = "white-space: nowrap;";

        // BACKCHARGE
        $this->BACKCHARGE->CellCssStyle = "white-space: nowrap;";

        // ORG_ID
        $this->ORG_ID->CellCssStyle = "white-space: nowrap;";

        // COVERAGE_ID
        $this->COVERAGE_ID->CellCssStyle = "white-space: nowrap;";

        // MOTHER
        $this->MOTHER->CellCssStyle = "white-space: nowrap;";

        // FATHER
        $this->FATHER->CellCssStyle = "white-space: nowrap;";

        // SPOUSE
        $this->SPOUSE->CellCssStyle = "white-space: nowrap;";

        // AKTIF
        $this->AKTIF->CellCssStyle = "white-space: nowrap;";

        // TMT
        $this->TMT->CellCssStyle = "white-space: nowrap;";

        // TAT
        $this->TAT->CellCssStyle = "white-space: nowrap;";

        // CARD_ID
        $this->CARD_ID->CellCssStyle = "white-space: nowrap;";

        // MEDICAL_NOTES
        $this->MEDICAL_NOTES->CellCssStyle = "white-space: nowrap;";

        // ID
        $this->ID->CellCssStyle = "white-space: nowrap;";

        // newapp

        // cek
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->ViewValue = $this->NAME_OF_PASIEN->CurrentValue;
            $this->NAME_OF_PASIEN->ViewCustomAttributes = "";

            // PASIEN_ID
            $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
            $this->PASIEN_ID->ViewCustomAttributes = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
            $this->EMPLOYEE_ID->ViewCustomAttributes = "";

            // KK_NO
            $this->KK_NO->ViewValue = $this->KK_NO->CurrentValue;
            $this->KK_NO->ViewCustomAttributes = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
            $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->ViewValue = $this->DATE_OF_BIRTH->CurrentValue;
            $this->DATE_OF_BIRTH->ViewValue = FormatDateTime($this->DATE_OF_BIRTH->ViewValue, 11);
            $this->DATE_OF_BIRTH->ViewCustomAttributes = "";

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

            // NATION_ID
            $this->NATION_ID->ViewValue = $this->NATION_ID->CurrentValue;
            $this->NATION_ID->ViewValue = FormatNumber($this->NATION_ID->ViewValue, 0, -2, -2, -2);
            $this->NATION_ID->ViewCustomAttributes = "";

            // EDUCATION_TYPE_CODE
            $curVal = trim(strval($this->EDUCATION_TYPE_CODE->CurrentValue));
            if ($curVal != "") {
                $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->lookupCacheOption($curVal);
                if ($this->EDUCATION_TYPE_CODE->ViewValue === null) { // Lookup from database
                    $filterWrk = "[EDUCATION_TYPE_CODE]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->EDUCATION_TYPE_CODE->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->EDUCATION_TYPE_CODE->Lookup->renderViewRow($rswrk[0]);
                        $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->displayValue($arwrk);
                    } else {
                        $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
                    }
                }
            } else {
                $this->EDUCATION_TYPE_CODE->ViewValue = null;
            }
            $this->EDUCATION_TYPE_CODE->ViewCustomAttributes = "";

            // MARITALSTATUSID
            $curVal = trim(strval($this->MARITALSTATUSID->CurrentValue));
            if ($curVal != "") {
                $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->lookupCacheOption($curVal);
                if ($this->MARITALSTATUSID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[MARITALSTATUSID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->MARITALSTATUSID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MARITALSTATUSID->Lookup->renderViewRow($rswrk[0]);
                        $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->displayValue($arwrk);
                    } else {
                        $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
                    }
                }
            } else {
                $this->MARITALSTATUSID->ViewValue = null;
            }
            $this->MARITALSTATUSID->ViewCustomAttributes = "";

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

            // RT
            $this->RT->ViewValue = $this->RT->CurrentValue;
            $this->RT->ViewCustomAttributes = "";

            // RW
            $this->RW->ViewValue = $this->RW->CurrentValue;
            $this->RW->ViewCustomAttributes = "";

            // JOB_ID
            $curVal = trim(strval($this->JOB_ID->CurrentValue));
            if ($curVal != "") {
                $this->JOB_ID->ViewValue = $this->JOB_ID->lookupCacheOption($curVal);
                if ($this->JOB_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[JOB_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->JOB_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->JOB_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->JOB_ID->ViewValue = $this->JOB_ID->displayValue($arwrk);
                    } else {
                        $this->JOB_ID->ViewValue = $this->JOB_ID->CurrentValue;
                    }
                }
            } else {
                $this->JOB_ID->ViewValue = null;
            }
            $this->JOB_ID->ViewCustomAttributes = "";

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

            // ANAK_KE
            $this->ANAK_KE->ViewValue = $this->ANAK_KE->CurrentValue;
            $this->ANAK_KE->ViewValue = FormatNumber($this->ANAK_KE->ViewValue, 0, -2, -2, -2);
            $this->ANAK_KE->ViewCustomAttributes = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->ViewValue = $this->CONTACT_ADDRESS->CurrentValue;
            $this->CONTACT_ADDRESS->ViewCustomAttributes = "";

            // PHONE_NUMBER
            $this->PHONE_NUMBER->ViewValue = $this->PHONE_NUMBER->CurrentValue;
            $this->PHONE_NUMBER->ViewCustomAttributes = "";

            // MOBILE
            $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
            $this->MOBILE->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // PHOTO_LOCATION
            $this->PHOTO_LOCATION->ViewValue = $this->PHOTO_LOCATION->CurrentValue;
            $this->PHOTO_LOCATION->ViewCustomAttributes = "";

            // REGISTRATION_DATE
            $this->REGISTRATION_DATE->ViewValue = $this->REGISTRATION_DATE->CurrentValue;
            $this->REGISTRATION_DATE->ViewValue = FormatDateTime($this->REGISTRATION_DATE->ViewValue, 11);
            $this->REGISTRATION_DATE->ViewCustomAttributes = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
            $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 11);
            $this->MODIFIED_DATE->ViewCustomAttributes = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
            $this->MODIFIED_BY->ViewCustomAttributes = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
            $this->MODIFIED_FROM->ViewCustomAttributes = "";

            // POSTAL_CODE
            $this->POSTAL_CODE->ViewValue = $this->POSTAL_CODE->CurrentValue;
            $this->POSTAL_CODE->ViewCustomAttributes = "";

            // GELAR
            $this->GELAR->ViewValue = $this->GELAR->CurrentValue;
            $this->GELAR->ViewCustomAttributes = "";

            // BLOOD_TYPE_ID
            $curVal = trim(strval($this->BLOOD_TYPE_ID->CurrentValue));
            if ($curVal != "") {
                $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->lookupCacheOption($curVal);
                if ($this->BLOOD_TYPE_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[BLOOD_TYPE_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->BLOOD_TYPE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->BLOOD_TYPE_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->displayValue($arwrk);
                    } else {
                        $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->CurrentValue;
                    }
                }
            } else {
                $this->BLOOD_TYPE_ID->ViewValue = null;
            }
            $this->BLOOD_TYPE_ID->ViewCustomAttributes = "";

            // FAMILY_STATUS_ID
            $curVal = trim(strval($this->FAMILY_STATUS_ID->CurrentValue));
            if ($curVal != "") {
                $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->lookupCacheOption($curVal);
                if ($this->FAMILY_STATUS_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KDJNSPESERTA]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->FAMILY_STATUS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->FAMILY_STATUS_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->displayValue($arwrk);
                    } else {
                        $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
                    }
                }
            } else {
                $this->FAMILY_STATUS_ID->ViewValue = null;
            }
            $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

            // ISMENINGGAL
            $this->ISMENINGGAL->ViewValue = $this->ISMENINGGAL->CurrentValue;
            $this->ISMENINGGAL->ViewCustomAttributes = "";

            // DEATH_DATE
            $this->DEATH_DATE->ViewValue = $this->DEATH_DATE->CurrentValue;
            $this->DEATH_DATE->ViewValue = FormatDateTime($this->DEATH_DATE->ViewValue, 11);
            $this->DEATH_DATE->ViewCustomAttributes = "";

            // PAYOR_ID
            $curVal = trim(strval($this->PAYOR_ID->CurrentValue));
            if ($curVal != "") {
                $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->lookupCacheOption($curVal);
                if ($this->PAYOR_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[PAYOR_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->PAYOR_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PAYOR_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->displayValue($arwrk);
                    } else {
                        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
                    }
                }
            } else {
                $this->PAYOR_ID->ViewValue = null;
            }
            $this->PAYOR_ID->ViewCustomAttributes = "";

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

            // ACCOUNT_ID
            $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
            $this->ACCOUNT_ID->ViewCustomAttributes = "";

            // KARYAWAN
            $this->KARYAWAN->ViewValue = $this->KARYAWAN->CurrentValue;
            $this->KARYAWAN->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // NEWCARD
            $this->NEWCARD->ViewValue = $this->NEWCARD->CurrentValue;
            $this->NEWCARD->ViewValue = FormatDateTime($this->NEWCARD->ViewValue, 0);
            $this->NEWCARD->ViewCustomAttributes = "";

            // BACKCHARGE
            $this->BACKCHARGE->ViewValue = $this->BACKCHARGE->CurrentValue;
            $this->BACKCHARGE->ViewCustomAttributes = "";

            // ORG_ID
            $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
            $this->ORG_ID->ViewCustomAttributes = "";

            // COVERAGE_ID
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

            // MOTHER
            $this->MOTHER->ViewValue = $this->MOTHER->CurrentValue;
            $this->MOTHER->ViewCustomAttributes = "";

            // FATHER
            $this->FATHER->ViewValue = $this->FATHER->CurrentValue;
            $this->FATHER->ViewCustomAttributes = "";

            // SPOUSE
            $this->SPOUSE->ViewValue = $this->SPOUSE->CurrentValue;
            $this->SPOUSE->ViewCustomAttributes = "";

            // AKTIF
            $this->AKTIF->ViewValue = $this->AKTIF->CurrentValue;
            $curVal = trim(strval($this->AKTIF->CurrentValue));
            if ($curVal != "") {
                $this->AKTIF->ViewValue = $this->AKTIF->lookupCacheOption($curVal);
                if ($this->AKTIF->ViewValue === null) { // Lookup from database
                    $filterWrk = "[STATUS_PESERTA_KODE]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->AKTIF->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->AKTIF->Lookup->renderViewRow($rswrk[0]);
                        $this->AKTIF->ViewValue = $this->AKTIF->displayValue($arwrk);
                    } else {
                        $this->AKTIF->ViewValue = $this->AKTIF->CurrentValue;
                    }
                }
            } else {
                $this->AKTIF->ViewValue = null;
            }
            $this->AKTIF->ViewCustomAttributes = "";

            // TMT
            $this->TMT->ViewValue = $this->TMT->CurrentValue;
            $this->TMT->ViewValue = FormatDateTime($this->TMT->ViewValue, 11);
            $this->TMT->ViewCustomAttributes = "";

            // TAT
            $this->TAT->ViewValue = $this->TAT->CurrentValue;
            $this->TAT->ViewValue = FormatDateTime($this->TAT->ViewValue, 11);
            $this->TAT->ViewCustomAttributes = "";

            // CARD_ID
            $this->CARD_ID->ViewValue = $this->CARD_ID->CurrentValue;
            $this->CARD_ID->ViewCustomAttributes = "";

            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // newapp
            $this->newapp->ViewValue = $this->newapp->CurrentValue;
            $this->newapp->ViewCustomAttributes = "";

            // cek
            $this->cek->ViewValue = $this->cek->CurrentValue;
            $this->cek->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
            $this->NAME_OF_PASIEN->HrefValue = "";
            $this->NAME_OF_PASIEN->TooltipValue = "";

            // PASIEN_ID
            $this->PASIEN_ID->LinkCustomAttributes = "";
            $this->PASIEN_ID->HrefValue = "";
            $this->PASIEN_ID->TooltipValue = "";

            // KK_NO
            $this->KK_NO->LinkCustomAttributes = "";
            $this->KK_NO->HrefValue = "";
            $this->KK_NO->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";
            $this->STATUS_PASIEN_ID->TooltipValue = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->LinkCustomAttributes = "";
            $this->CONTACT_ADDRESS->HrefValue = "";
            $this->CONTACT_ADDRESS->TooltipValue = "";

            // REGISTRATION_DATE
            $this->REGISTRATION_DATE->LinkCustomAttributes = "";
            $this->REGISTRATION_DATE->HrefValue = "";
            $this->REGISTRATION_DATE->TooltipValue = "";

            // MOTHER
            $this->MOTHER->LinkCustomAttributes = "";
            $this->MOTHER->HrefValue = "";
            $this->MOTHER->TooltipValue = "";

            // FATHER
            $this->FATHER->LinkCustomAttributes = "";
            $this->FATHER->HrefValue = "";
            $this->FATHER->TooltipValue = "";

            // SPOUSE
            $this->SPOUSE->LinkCustomAttributes = "";
            $this->SPOUSE->HrefValue = "";
            $this->SPOUSE->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
            $this->NO_REGISTRATION->EditCustomAttributes = 'readonly';
            if (!$this->NO_REGISTRATION->Raw) {
                $this->NO_REGISTRATION->AdvancedSearch->SearchValue = HtmlDecode($this->NO_REGISTRATION->AdvancedSearch->SearchValue);
            }
            $this->NO_REGISTRATION->EditValue = HtmlEncode($this->NO_REGISTRATION->AdvancedSearch->SearchValue);
            $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->EditAttrs["class"] = "form-control";
            $this->NAME_OF_PASIEN->EditCustomAttributes = "";
            if (!$this->NAME_OF_PASIEN->Raw) {
                $this->NAME_OF_PASIEN->AdvancedSearch->SearchValue = HtmlDecode($this->NAME_OF_PASIEN->AdvancedSearch->SearchValue);
            }
            $this->NAME_OF_PASIEN->EditValue = HtmlEncode($this->NAME_OF_PASIEN->AdvancedSearch->SearchValue);
            $this->NAME_OF_PASIEN->PlaceHolder = RemoveHtml($this->NAME_OF_PASIEN->caption());

            // PASIEN_ID
            $this->PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->PASIEN_ID->EditCustomAttributes = "";
            if (!$this->PASIEN_ID->Raw) {
                $this->PASIEN_ID->AdvancedSearch->SearchValue = HtmlDecode($this->PASIEN_ID->AdvancedSearch->SearchValue);
            }
            $this->PASIEN_ID->EditValue = HtmlEncode($this->PASIEN_ID->AdvancedSearch->SearchValue);
            $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

            // KK_NO
            $this->KK_NO->EditAttrs["class"] = "form-control";
            $this->KK_NO->EditCustomAttributes = "";
            if (!$this->KK_NO->Raw) {
                $this->KK_NO->AdvancedSearch->SearchValue = HtmlDecode($this->KK_NO->AdvancedSearch->SearchValue);
            }
            $this->KK_NO->EditValue = HtmlEncode($this->KK_NO->AdvancedSearch->SearchValue);
            $this->KK_NO->PlaceHolder = RemoveHtml($this->KK_NO->caption());

            // GENDER
            $this->GENDER->EditCustomAttributes = "";
            $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
            $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->EditAttrs["class"] = "form-control";
            $this->CONTACT_ADDRESS->EditCustomAttributes = "";
            $this->CONTACT_ADDRESS->EditValue = HtmlEncode($this->CONTACT_ADDRESS->AdvancedSearch->SearchValue);
            $this->CONTACT_ADDRESS->PlaceHolder = RemoveHtml($this->CONTACT_ADDRESS->caption());

            // REGISTRATION_DATE
            $this->REGISTRATION_DATE->EditAttrs["class"] = "form-control";
            $this->REGISTRATION_DATE->EditCustomAttributes = 'readonly';
            $this->REGISTRATION_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->REGISTRATION_DATE->AdvancedSearch->SearchValue, 11), 11));
            $this->REGISTRATION_DATE->PlaceHolder = RemoveHtml($this->REGISTRATION_DATE->caption());

            // MOTHER
            $this->MOTHER->EditAttrs["class"] = "form-control";
            $this->MOTHER->EditCustomAttributes = "";
            if (!$this->MOTHER->Raw) {
                $this->MOTHER->AdvancedSearch->SearchValue = HtmlDecode($this->MOTHER->AdvancedSearch->SearchValue);
            }
            $this->MOTHER->EditValue = HtmlEncode($this->MOTHER->AdvancedSearch->SearchValue);
            $this->MOTHER->PlaceHolder = RemoveHtml($this->MOTHER->caption());

            // FATHER
            $this->FATHER->EditAttrs["class"] = "form-control";
            $this->FATHER->EditCustomAttributes = "";
            if (!$this->FATHER->Raw) {
                $this->FATHER->AdvancedSearch->SearchValue = HtmlDecode($this->FATHER->AdvancedSearch->SearchValue);
            }
            $this->FATHER->EditValue = HtmlEncode($this->FATHER->AdvancedSearch->SearchValue);
            $this->FATHER->PlaceHolder = RemoveHtml($this->FATHER->caption());

            // SPOUSE
            $this->SPOUSE->EditAttrs["class"] = "form-control";
            $this->SPOUSE->EditCustomAttributes = "";
            if (!$this->SPOUSE->Raw) {
                $this->SPOUSE->AdvancedSearch->SearchValue = HtmlDecode($this->SPOUSE->AdvancedSearch->SearchValue);
            }
            $this->SPOUSE->EditValue = HtmlEncode($this->SPOUSE->AdvancedSearch->SearchValue);
            $this->SPOUSE->PlaceHolder = RemoveHtml($this->SPOUSE->caption());
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate search
    protected function validateSearch()
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }

        // Return validate result
        $validateSearch = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateSearch = $validateSearch && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateSearch;
    }

    // Load advanced search
    public function loadAdvancedSearch()
    {
        $this->ORG_UNIT_CODE->AdvancedSearch->load();
        $this->NO_REGISTRATION->AdvancedSearch->load();
        $this->NAME_OF_PASIEN->AdvancedSearch->load();
        $this->PASIEN_ID->AdvancedSearch->load();
        $this->EMPLOYEE_ID->AdvancedSearch->load();
        $this->KK_NO->AdvancedSearch->load();
        $this->PLACE_OF_BIRTH->AdvancedSearch->load();
        $this->DATE_OF_BIRTH->AdvancedSearch->load();
        $this->GENDER->AdvancedSearch->load();
        $this->NATION_ID->AdvancedSearch->load();
        $this->EDUCATION_TYPE_CODE->AdvancedSearch->load();
        $this->MARITALSTATUSID->AdvancedSearch->load();
        $this->KODE_AGAMA->AdvancedSearch->load();
        $this->KAL_ID->AdvancedSearch->load();
        $this->RT->AdvancedSearch->load();
        $this->RW->AdvancedSearch->load();
        $this->JOB_ID->AdvancedSearch->load();
        $this->STATUS_PASIEN_ID->AdvancedSearch->load();
        $this->ANAK_KE->AdvancedSearch->load();
        $this->CONTACT_ADDRESS->AdvancedSearch->load();
        $this->PHONE_NUMBER->AdvancedSearch->load();
        $this->MOBILE->AdvancedSearch->load();
        $this->_EMAIL->AdvancedSearch->load();
        $this->PHOTO_LOCATION->AdvancedSearch->load();
        $this->REGISTRATION_DATE->AdvancedSearch->load();
        $this->MODIFIED_DATE->AdvancedSearch->load();
        $this->MODIFIED_BY->AdvancedSearch->load();
        $this->MODIFIED_FROM->AdvancedSearch->load();
        $this->POSTAL_CODE->AdvancedSearch->load();
        $this->GELAR->AdvancedSearch->load();
        $this->BLOOD_TYPE_ID->AdvancedSearch->load();
        $this->FAMILY_STATUS_ID->AdvancedSearch->load();
        $this->ISMENINGGAL->AdvancedSearch->load();
        $this->DEATH_DATE->AdvancedSearch->load();
        $this->PAYOR_ID->AdvancedSearch->load();
        $this->CLASS_ID->AdvancedSearch->load();
        $this->ACCOUNT_ID->AdvancedSearch->load();
        $this->KARYAWAN->AdvancedSearch->load();
        $this->DESCRIPTION->AdvancedSearch->load();
        $this->NEWCARD->AdvancedSearch->load();
        $this->BACKCHARGE->AdvancedSearch->load();
        $this->ORG_ID->AdvancedSearch->load();
        $this->COVERAGE_ID->AdvancedSearch->load();
        $this->MOTHER->AdvancedSearch->load();
        $this->FATHER->AdvancedSearch->load();
        $this->SPOUSE->AdvancedSearch->load();
        $this->AKTIF->AdvancedSearch->load();
        $this->TMT->AdvancedSearch->load();
        $this->TAT->AdvancedSearch->load();
        $this->CARD_ID->AdvancedSearch->load();
        $this->MEDICAL_NOTES->AdvancedSearch->load();
        $this->ID->AdvancedSearch->load();
        $this->newapp->AdvancedSearch->load();
        $this->cek->AdvancedSearch->load();
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fcv_pasienlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
                case "x_GENDER":
                    $lookupFilter = function () {
                        return "[GENDER] = 1 OR [GENDER] = 2";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_EDUCATION_TYPE_CODE":
                    break;
                case "x_MARITALSTATUSID":
                    break;
                case "x_KODE_AGAMA":
                    break;
                case "x_KAL_ID":
                    break;
                case "x_JOB_ID":
                    break;
                case "x_STATUS_PASIEN_ID":
                    $lookupFilter = function () {
                        return "[ISACTIVE] = 1";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_BLOOD_TYPE_ID":
                    break;
                case "x_FAMILY_STATUS_ID":
                    break;
                case "x_PAYOR_ID":
                    break;
                case "x_CLASS_ID":
                    break;
                case "x_COVERAGE_ID":
                    break;
                case "x_AKTIF":
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
        Language()->SetPhraseClass("addlink","");
        Language()->setPhrase("addlink", "Tambah Pasien Baru");
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
