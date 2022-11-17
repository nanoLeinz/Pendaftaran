<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class VDaftarPasienList extends VDaftarPasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'V_DAFTAR_PASIEN';

    // Page object name
    public $PageObjName = "VDaftarPasienList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fV_DAFTAR_PASIENlist";
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

        // Table object (V_DAFTAR_PASIEN)
        if (!isset($GLOBALS["V_DAFTAR_PASIEN"]) || get_class($GLOBALS["V_DAFTAR_PASIEN"]) == PROJECT_NAMESPACE . "V_DAFTAR_PASIEN") {
            $GLOBALS["V_DAFTAR_PASIEN"] = &$this;
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
        $this->AddUrl = "VDaftarPasienAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "VDaftarPasienDelete";
        $this->MultiUpdateUrl = "VDaftarPasienUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'V_DAFTAR_PASIEN');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fV_DAFTAR_PASIENlistsrch";

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
                $doc = new $class(Container("V_DAFTAR_PASIEN"));
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
            $key .= @$ar['NO_REGISTRATION'];
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
        $this->NO_REGISTRATION->setVisibility();
        $this->PASIEN_ID->Visible = false;
        $this->EMPLOYEE_ID->Visible = false;
        $this->KK_NO->setVisibility();
        $this->NAME_OF_PASIEN->setVisibility();
        $this->PLACE_OF_BIRTH->setVisibility();
        $this->DATE_OF_BIRTH->setVisibility();
        $this->GENDER->setVisibility();
        $this->NATION_ID->Visible = false;
        $this->EDUCATION_TYPE_CODE->Visible = false;
        $this->MARITALSTATUSID->Visible = false;
        $this->KODE_AGAMA->setVisibility();
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
        $this->MOTHER->Visible = false;
        $this->FATHER->Visible = false;
        $this->SPOUSE->Visible = false;
        $this->AKTIF->Visible = false;
        $this->TMT->Visible = false;
        $this->TAT->Visible = false;
        $this->CARD_ID->Visible = false;
        $this->MEDICAL_NOTES->Visible = false;
        $this->ID->Visible = false;
        $this->newapp->setVisibility();
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
        $this->setupLookupOptions($this->STATUS_PASIEN_ID);
        $this->setupLookupOptions($this->PAYOR_ID);
        $this->setupLookupOptions($this->CLASS_ID);
        $this->setupLookupOptions($this->COVERAGE_ID);

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
        $filterList = Concat($filterList, $this->NO_REGISTRATION->AdvancedSearch->toJson(), ","); // Field NO_REGISTRATION
        $filterList = Concat($filterList, $this->PASIEN_ID->AdvancedSearch->toJson(), ","); // Field PASIEN_ID
        $filterList = Concat($filterList, $this->EMPLOYEE_ID->AdvancedSearch->toJson(), ","); // Field EMPLOYEE_ID
        $filterList = Concat($filterList, $this->KK_NO->AdvancedSearch->toJson(), ","); // Field KK_NO
        $filterList = Concat($filterList, $this->NAME_OF_PASIEN->AdvancedSearch->toJson(), ","); // Field NAME_OF_PASIEN
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fV_DAFTAR_PASIENlistsrch", $filters);
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

        // Field NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchValue = @$filter["x_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchOperator = @$filter["z_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchCondition = @$filter["v_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchValue2 = @$filter["y_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->SearchOperator2 = @$filter["w_NAME_OF_PASIEN"];
        $this->NAME_OF_PASIEN->AdvancedSearch->save();

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
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->NO_REGISTRATION, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->newapp, $arKeywords, $type);
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
            $this->updateSort($this->NO_REGISTRATION); // NO_REGISTRATION
            $this->updateSort($this->KK_NO); // KK_NO
            $this->updateSort($this->NAME_OF_PASIEN); // NAME_OF_PASIEN
            $this->updateSort($this->PLACE_OF_BIRTH); // PLACE_OF_BIRTH
            $this->updateSort($this->DATE_OF_BIRTH); // DATE_OF_BIRTH
            $this->updateSort($this->GENDER); // GENDER
            $this->updateSort($this->KODE_AGAMA); // KODE_AGAMA
            $this->updateSort($this->STATUS_PASIEN_ID); // STATUS_PASIEN_ID
            $this->updateSort($this->CONTACT_ADDRESS); // CONTACT_ADDRESS
            $this->updateSort($this->REGISTRATION_DATE); // REGISTRATION_DATE
            $this->updateSort($this->newapp); // newapp
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
                $this->PASIEN_ID->setSort("");
                $this->EMPLOYEE_ID->setSort("");
                $this->KK_NO->setSort("");
                $this->NAME_OF_PASIEN->setSort("");
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
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ORG_UNIT_CODE->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->NO_REGISTRATION->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fV_DAFTAR_PASIENlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fV_DAFTAR_PASIENlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fV_DAFTAR_PASIENlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->KK_NO->setDbValue($row['KK_NO']);
        $this->NAME_OF_PASIEN->setDbValue($row['NAME_OF_PASIEN']);
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
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ORG_UNIT_CODE'] = null;
        $row['NO_REGISTRATION'] = null;
        $row['PASIEN_ID'] = null;
        $row['EMPLOYEE_ID'] = null;
        $row['KK_NO'] = null;
        $row['NAME_OF_PASIEN'] = null;
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

        // PASIEN_ID
        $this->PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // KK_NO
        $this->KK_NO->CellCssStyle = "white-space: nowrap;";

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->CellCssStyle = "white-space: nowrap;";

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
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // PASIEN_ID
            $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
            $this->PASIEN_ID->ViewCustomAttributes = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
            $this->EMPLOYEE_ID->ViewCustomAttributes = "";

            // KK_NO
            $this->KK_NO->ViewValue = $this->KK_NO->CurrentValue;
            $this->KK_NO->ViewCustomAttributes = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->ViewValue = $this->NAME_OF_PASIEN->CurrentValue;
            $this->NAME_OF_PASIEN->ViewCustomAttributes = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
            $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->ViewValue = $this->DATE_OF_BIRTH->CurrentValue;
            $this->DATE_OF_BIRTH->ViewValue = FormatDateTime($this->DATE_OF_BIRTH->ViewValue, 7);
            $this->DATE_OF_BIRTH->ViewCustomAttributes = "";

            // GENDER
            $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
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
            $this->JOB_ID->ViewValue = $this->JOB_ID->CurrentValue;
            $this->JOB_ID->ViewValue = FormatNumber($this->JOB_ID->ViewValue, 0, -2, -2, -2);
            $this->JOB_ID->ViewCustomAttributes = "";

            // STATUS_PASIEN_ID
            $curVal = trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
            if ($curVal != "") {
                $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
                if ($this->STATUS_PASIEN_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->STATUS_PASIEN_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
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
            $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->CurrentValue;
            $this->BLOOD_TYPE_ID->ViewValue = FormatNumber($this->BLOOD_TYPE_ID->ViewValue, 0, -2, -2, -2);
            $this->BLOOD_TYPE_ID->ViewCustomAttributes = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
            $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
            $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

            // ISMENINGGAL
            $this->ISMENINGGAL->ViewValue = $this->ISMENINGGAL->CurrentValue;
            $this->ISMENINGGAL->ViewCustomAttributes = "";

            // DEATH_DATE
            $this->DEATH_DATE->ViewValue = $this->DEATH_DATE->CurrentValue;
            $this->DEATH_DATE->ViewValue = FormatDateTime($this->DEATH_DATE->ViewValue, 0);
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

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // KK_NO
            $this->KK_NO->LinkCustomAttributes = "";
            $this->KK_NO->HrefValue = "";
            $this->KK_NO->TooltipValue = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
            $this->NAME_OF_PASIEN->HrefValue = "";
            $this->NAME_OF_PASIEN->TooltipValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";
            $this->PLACE_OF_BIRTH->TooltipValue = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->LinkCustomAttributes = "";
            $this->DATE_OF_BIRTH->HrefValue = "";
            $this->DATE_OF_BIRTH->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->LinkCustomAttributes = "";
            $this->KODE_AGAMA->HrefValue = "";
            $this->KODE_AGAMA->TooltipValue = "";

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

            // newapp
            $this->newapp->LinkCustomAttributes = "";
            $this->newapp->HrefValue = "";
            $this->newapp->TooltipValue = "";
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fV_DAFTAR_PASIENlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
                case "x_EDUCATION_TYPE_CODE":
                    break;
                case "x_MARITALSTATUSID":
                    break;
                case "x_KODE_AGAMA":
                    break;
                case "x_KAL_ID":
                    break;
                case "x_STATUS_PASIEN_ID":
                    break;
                case "x_PAYOR_ID":
                    break;
                case "x_CLASS_ID":
                    break;
                case "x_COVERAGE_ID":
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
