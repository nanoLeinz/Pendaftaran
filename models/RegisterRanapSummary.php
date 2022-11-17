<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class RegisterRanapSummary extends RegisterRanap
{
    use MessagesTrait;

    // Page ID
    public $PageID = "summary";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'register_ranap';

    // Page object name
    public $PageObjName = "RegisterRanapSummary";

    // Rendering View
    public $RenderingView = false;

    // CSS
    public $ReportTableClass = "";
    public $ReportTableStyle = "";

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

        // Table object (register_ranap)
        if (!isset($GLOBALS["register_ranap"]) || get_class($GLOBALS["register_ranap"]) == PROJECT_NAMESPACE . "register_ranap") {
            $GLOBALS["register_ranap"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Initialize URLs
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'register_ranap');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Filter options
        $this->FilterOptions = new ListOptions("div");
        $this->FilterOptions->TagClassName = "ew-filter-option fsummary";
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
        if ($this->isExport() && !$this->isExport("print")) {
            $class = PROJECT_NAMESPACE . Config("REPORT_EXPORT_CLASSES." . $this->Export);
            if (class_exists($class)) {
                $content = $this->getContents();
                $doc = new $class();
                $doc($this, $content);
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection if not in dashboard
        if (!$DashboardReport) {
            CloseConnections();
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

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;
        if (in_array($lookup->LinkTable, [$this->ReportSourceTable, $this->TableVar])) {
            $lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
        }
        $lookup->RenderEditFunc = ""; // Set up edit renderer

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

    // Options
    public $HideOptions = false;
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $FilterOptions; // Filter options

    // Records
    public $GroupRecords = [];
    public $DetailRecords = [];
    public $DetailRecordCount = 0;

    // Paging variables
    public $RecordIndex = 0; // Record index
    public $RecordCount = 0; // Record count (start from 1 for each group)
    public $StartGroup = 0; // Start group
    public $StopGroup = 0; // Stop group
    public $TotalGroups = 0; // Total groups
    public $GroupCount = 0; // Group count
    public $GroupCounter = []; // Group counter
    public $DisplayGroups = 5; // Groups per page
    public $GroupRange = 10;
    public $PageSizes = "1,2,3,5,-1"; // Page sizes (comma separated)
    public $PageFirstGroupFilter = "";
    public $UserIDFilter = "";
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = "";
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchRowCount = 0; // For extended search
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 2; // For extended search
    public $DrillDownList = "";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $SearchCommand = false;
    public $ShowHeader;
    public $GroupColumnCount = 0;
    public $SubGroupColumnCount = 0;
    public $DetailColumnCount = 0;
    public $TotalCount;
    public $PageTotalCount;
    public $TopContentClass = "col-sm-12 ew-top";
    public $LeftContentClass = "ew-left";
    public $CenterContentClass = "col-sm-12 ew-center";
    public $RightContentClass = "ew-right";
    public $BottomContentClass = "col-sm-12 ew-bottom";

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $ExportFileName, $Language, $Security, $UserProfile,
            $Security, $DrillDownInPanel, $Breadcrumb,
            $DashboardReport, $CustomExportType, $ReportExportType;
        $this->CurrentAction = Param("action"); // Set up current action

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up table class
        if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf")) {
            $this->ReportTableClass = "ew-table";
        } else {
            $this->ReportTableClass = "table ew-table";
        }

        // Set field visibility for detail fields
        $this->NO_REGISTRATION->setVisibility();
        $this->GENDER->setVisibility();
        $this->TREATMENT->setVisibility();
        $this->CLASS_ROOM_ID->setVisibility();
        $this->BED_ID->setVisibility();
        $this->DOCTOR->setVisibility();
        $this->SERVED_INAP->setVisibility();
        $this->STATUS_PASIEN_ID->setVisibility();
        $this->ISRJ->setVisibility();
        $this->VISIT_ID->setVisibility();
        $this->IDXDAFTAR->setVisibility();
        $this->DIANTAR_OLEH->setVisibility();
        $this->EXIT_DATE->setVisibility();
        $this->KELUAR_ID->setVisibility();
        $this->AGEYEAR->setVisibility();

        // Set up groups per page dynamically
        $this->setupDisplayGroups();

        // Set up Breadcrumb
        if (!$this->isExport() && !$DashboardReport) {
            $this->setupBreadcrumb();
        }

        // Check if search command
        $this->SearchCommand = (Get("cmd", "") == "search");

        // Load custom filters
        $this->pageFilterLoad();

        // Extended filter
        $extendedFilter = "";

        // Restore filter list
        $this->restoreFilterList();

        // Build extended filter
        $extendedFilter = $this->getExtendedFilter();
        AddFilter($this->SearchWhere, $extendedFilter);

        // Call Page Selecting event
        $this->pageSelecting($this->SearchWhere);

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Get sort
        $this->Sort = $this->getSort();

        // Search options
        $this->setupSearchOptions();

        // Update filter
        AddFilter($this->Filter, $this->SearchWhere);

        // Get total count
        $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
        $this->TotalGroups = $this->getRecordCount($sql);
        if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) { // Display all groups
            $this->DisplayGroups = $this->TotalGroups;
        }
        $this->StartGroup = 1;

        // Show header
        $this->ShowHeader = ($this->TotalGroups > 0);

        // Set up start position if not export all
        if ($this->ExportAll && $this->isExport()) {
            $this->DisplayGroups = $this->TotalGroups;
        } else {
            $this->setupStartGroup();
        }

        // Set no record found message
        if ($this->TotalGroups == 0) {
            if ($Security->canList()) {
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            } else {
                $this->setWarningMessage(DeniedMessage());
            }
        }

        // Hide export options if export/dashboard report/hide options
        if ($this->isExport() || $DashboardReport || $this->HideOptions) {
            $this->ExportOptions->hideAllOptions();
        }

        // Hide search/filter options if export/drilldown/dashboard report/hide options
        if ($this->isExport() || $this->DrillDown || $DashboardReport || $this->HideOptions) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }

        // Get current page records
        if ($this->TotalGroups > 0) {
            $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, $this->Sort);
            $rs = $sql->setFirstResult($this->StartGroup - 1)->setMaxResults($this->DisplayGroups)->execute();
            $this->DetailRecords = $rs->fetchAll(); // Get records
            $this->GroupCount = 1;
        }
        $this->setupFieldCount();

        // Set the last group to display if not export all
        if ($this->ExportAll && $this->isExport()) {
            $this->StopGroup = $this->TotalGroups;
        } else {
            $this->StopGroup = $this->StartGroup + $this->DisplayGroups - 1;
        }

        // Stop group <= total number of groups
        if (intval($this->StopGroup) > intval($this->TotalGroups)) {
            $this->StopGroup = $this->TotalGroups;
        }
        $this->RecordCount = 0;
        $this->RecordIndex = 0;
        $this->setGroupCount($this->StopGroup - $this->StartGroup + 1, 1);

        // Set up pager
        $this->Pager = new PrevNextPager($this->StartGroup, $this->getGroupPerPage(), $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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

    // Load row values
    public function loadRowValues($record)
    {
        $data = [];
        $data["NO_REGISTRATION"] = $record['NO_REGISTRATION'];
        $data["GENDER"] = $record['GENDER'];
        $data["TREATMENT"] = $record['TREATMENT'];
        $data["CLASS_ROOM_ID"] = $record['CLASS_ROOM_ID'];
        $data["BED_ID"] = $record['BED_ID'];
        $data["DOCTOR"] = $record['DOCTOR'];
        $data["SERVED_INAP"] = $record['SERVED_INAP'];
        $data["STATUS_PASIEN_ID"] = $record['STATUS_PASIEN_ID'];
        $data["ISRJ"] = $record['ISRJ'];
        $data["VISIT_ID"] = $record['VISIT_ID'];
        $data["IDXDAFTAR"] = $record['IDXDAFTAR'];
        $data["DIANTAR_OLEH"] = $record['DIANTAR_OLEH'];
        $data["EXIT_DATE"] = $record['EXIT_DATE'];
        $data["KELUAR_ID"] = $record['KELUAR_ID'];
        $data["AGEYEAR"] = $record['AGEYEAR'];
        $this->Rows[] = $data;
        $this->NO_REGISTRATION->setDbValue($record['NO_REGISTRATION']);
        $this->GENDER->setDbValue($record['GENDER']);
        $this->TREATMENT->setDbValue($record['TREATMENT']);
        $this->CLASS_ROOM_ID->setDbValue($record['CLASS_ROOM_ID']);
        $this->BED_ID->setDbValue($record['BED_ID']);
        $this->DOCTOR->setDbValue($record['DOCTOR']);
        $this->SERVED_INAP->setDbValue($record['SERVED_INAP']);
        $this->STATUS_PASIEN_ID->setDbValue($record['STATUS_PASIEN_ID']);
        $this->ISRJ->setDbValue($record['ISRJ']);
        $this->VISIT_ID->setDbValue($record['VISIT_ID']);
        $this->IDXDAFTAR->setDbValue($record['IDXDAFTAR']);
        $this->DIANTAR_OLEH->setDbValue($record['DIANTAR_OLEH']);
        $this->EXIT_DATE->setDbValue($record['EXIT_DATE']);
        $this->KELUAR_ID->setDbValue($record['KELUAR_ID']);
        $this->AGEYEAR->setDbValue($record['AGEYEAR']);
    }

    // Render row
    public function renderRow()
    {
        global $Security, $Language, $Language;
        $conn = $this->getConnection();
        if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total
            $records = &$this->DetailRecords;
            $this->IDXDAFTAR->getCnt($records);
            $this->PageTotalCount = count($records);
        } elseif ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_GRAND) { // Get Grand total
            $hasCount = false;
            $hasSummary = false;

            // Get total count from SQL directly
            $sql = $this->buildReportSql($this->getSqlSelectCount(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
            $rstot = $conn->executeQuery($sql);
            if ($rstot && $cnt = $rstot->fetchColumn()) {
                $rstot->closeCursor();
                $hasCount = true;
            } else {
                $cnt = 0;
            }
            $this->TotalCount = $cnt;

            // Get total from SQL directly
            $sql = $this->buildReportSql($this->getSqlSelectAggregate(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
            $sql = $this->getSqlAggregatePrefix() . $sql . $this->getSqlAggregateSuffix();
            $rsagg = $conn->fetchAssoc($sql);
            if ($rsagg) {
                $this->NO_REGISTRATION->Count = $this->TotalCount;
                $this->GENDER->Count = $this->TotalCount;
                $this->TREATMENT->Count = $this->TotalCount;
                $this->CLASS_ROOM_ID->Count = $this->TotalCount;
                $this->BED_ID->Count = $this->TotalCount;
                $this->DOCTOR->Count = $this->TotalCount;
                $this->SERVED_INAP->Count = $this->TotalCount;
                $this->STATUS_PASIEN_ID->Count = $this->TotalCount;
                $this->ISRJ->Count = $this->TotalCount;
                $this->VISIT_ID->Count = $this->TotalCount;
                $this->IDXDAFTAR->Count = $this->TotalCount;
                $this->IDXDAFTAR->CntValue = $rsagg["cnt_idxdaftar"];
                $this->DIANTAR_OLEH->Count = $this->TotalCount;
                $this->EXIT_DATE->Count = $this->TotalCount;
                $this->KELUAR_ID->Count = $this->TotalCount;
                $this->AGEYEAR->Count = $this->TotalCount;
                $hasSummary = true;
            }

            // Accumulate grand summary from detail records
            if (!$hasCount || !$hasSummary) {
                $sql = $this->buildReportSql($this->getSqlSelect(), $this->getSqlFrom(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
                $rs = $sql->execute();
                $this->DetailRecords = $rs ? $rs->fetchAll() : [];
                $this->IDXDAFTAR->getCnt($this->DetailRecords);
            }
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // TREATMENT
        $this->TREATMENT->CellCssStyle = "white-space: nowrap;";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->CellCssStyle = "white-space: nowrap;";

        // BED_ID

        // DOCTOR

        // SERVED_INAP

        // STATUS_PASIEN_ID

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // IDXDAFTAR
        $this->IDXDAFTAR->CellCssStyle = "white-space: nowrap;";

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->CellCssStyle = "white-space: nowrap;";

        // EXIT_DATE

        // KELUAR_ID

        // AGEYEAR
        if ($this->RowType == ROWTYPE_SEARCH) {
            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ROOM_ID->EditCustomAttributes = "";
            $curVal = $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue == INIT_VALUE ? "" : trim(strval($this->CLASS_ROOM_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->CLASS_ROOM_ID->AdvancedSearch->ViewValue = $this->CLASS_ROOM_ID->lookupCacheOption($curVal);
            } else {
                $this->CLASS_ROOM_ID->AdvancedSearch->ViewValue = $this->CLASS_ROOM_ID->Lookup !== null && is_array($this->CLASS_ROOM_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLASS_ROOM_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->CLASS_ROOM_ID->EditValue = array_values($this->CLASS_ROOM_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLASS_ROOM_ID]" . SearchString("=", $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->CLASS_ROOM_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLASS_ROOM_ID->EditValue = $arwrk;
            }
            $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

            // SERVED_INAP
            $this->SERVED_INAP->EditAttrs["class"] = "form-control";
            $this->SERVED_INAP->EditCustomAttributes = "";
            $this->SERVED_INAP->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->SERVED_INAP->AdvancedSearch->SearchValue, 7), 7));
            $this->SERVED_INAP->PlaceHolder = RemoveHtml($this->SERVED_INAP->caption());
        } elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
            $this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class

            // IDXDAFTAR
            $this->IDXDAFTAR->CntViewValue = $this->IDXDAFTAR->CntValue;
            $this->IDXDAFTAR->CntViewValue = FormatNumber($this->IDXDAFTAR->CntViewValue, 0, -2, -2, -2);
            $this->IDXDAFTAR->ViewCustomAttributes = "";
            $this->IDXDAFTAR->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

            // NO_REGISTRATION
            $this->NO_REGISTRATION->HrefValue = "";

            // GENDER
            $this->GENDER->HrefValue = "";

            // TREATMENT
            $this->TREATMENT->HrefValue = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->HrefValue = "";

            // BED_ID
            $this->BED_ID->HrefValue = "";

            // DOCTOR
            $this->DOCTOR->HrefValue = "";

            // SERVED_INAP
            $this->SERVED_INAP->HrefValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->HrefValue = "";

            // ISRJ
            $this->ISRJ->HrefValue = "";

            // VISIT_ID
            $this->VISIT_ID->HrefValue = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->HrefValue = "";

            // DIANTAR_OLEH
            $this->DIANTAR_OLEH->HrefValue = "";

            // EXIT_DATE
            $this->EXIT_DATE->HrefValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->HrefValue = "";

            // AGEYEAR
            $this->AGEYEAR->HrefValue = "";
        } else {
            if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
            } else {
            }

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $curVal = $this->NO_REGISTRATION->CurrentValue == INIT_VALUE ? "" : trim(strval($this->NO_REGISTRATION->CurrentValue));
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
            $this->NO_REGISTRATION->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // GENDER
            $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
            $curVal = $this->GENDER->CurrentValue == INIT_VALUE ? "" : trim(strval($this->GENDER->CurrentValue));
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
            $this->GENDER->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->GENDER->ViewCustomAttributes = "";

            // TREATMENT
            $this->TREATMENT->ViewValue = $this->TREATMENT->CurrentValue;
            $this->TREATMENT->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->TREATMENT->ViewCustomAttributes = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
            $curVal = $this->CLASS_ROOM_ID->CurrentValue == INIT_VALUE ? "" : trim(strval($this->CLASS_ROOM_ID->CurrentValue));
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
            $this->CLASS_ROOM_ID->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

            // BED_ID
            $this->BED_ID->ViewValue = $this->BED_ID->CurrentValue;
            $this->BED_ID->ViewValue = FormatNumber($this->BED_ID->ViewValue, 0, -2, -2, -2);
            $this->BED_ID->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->BED_ID->ViewCustomAttributes = "";

            // DOCTOR
            $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
            $this->DOCTOR->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->DOCTOR->ViewCustomAttributes = "";

            // SERVED_INAP
            $this->SERVED_INAP->ViewValue = $this->SERVED_INAP->CurrentValue;
            $this->SERVED_INAP->ViewValue = FormatDateTime($this->SERVED_INAP->ViewValue, 7);
            $this->SERVED_INAP->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->SERVED_INAP->ViewCustomAttributes = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
            $curVal = $this->STATUS_PASIEN_ID->CurrentValue == INIT_VALUE ? "" : trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
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
            $this->STATUS_PASIEN_ID->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

            // ISRJ
            $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
            $this->ISRJ->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->ISRJ->ViewCustomAttributes = "";

            // VISIT_ID
            $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
            $this->VISIT_ID->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->VISIT_ID->ViewCustomAttributes = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->ViewValue = $this->IDXDAFTAR->CurrentValue;
            $this->IDXDAFTAR->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->IDXDAFTAR->ViewCustomAttributes = "";

            // DIANTAR_OLEH
            $this->DIANTAR_OLEH->ViewValue = $this->DIANTAR_OLEH->CurrentValue;
            $this->DIANTAR_OLEH->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->DIANTAR_OLEH->ViewCustomAttributes = "";

            // EXIT_DATE
            $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
            $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
            $this->EXIT_DATE->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->EXIT_DATE->ViewCustomAttributes = "";

            // KELUAR_ID
            $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->CurrentValue;
            $this->KELUAR_ID->ViewValue = FormatNumber($this->KELUAR_ID->ViewValue, 0, -2, -2, -2);
            $this->KELUAR_ID->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->KELUAR_ID->ViewCustomAttributes = "";

            // AGEYEAR
            $this->AGEYEAR->ViewValue = $this->AGEYEAR->CurrentValue;
            $this->AGEYEAR->ViewValue = FormatNumber($this->AGEYEAR->ViewValue, 0, -2, -2, -2);
            $this->AGEYEAR->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
            $this->AGEYEAR->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // TREATMENT
            $this->TREATMENT->LinkCustomAttributes = "";
            $this->TREATMENT->HrefValue = "";
            $this->TREATMENT->TooltipValue = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
            $this->CLASS_ROOM_ID->HrefValue = "";
            $this->CLASS_ROOM_ID->TooltipValue = "";

            // BED_ID
            $this->BED_ID->LinkCustomAttributes = "";
            $this->BED_ID->HrefValue = "";
            $this->BED_ID->TooltipValue = "";

            // DOCTOR
            $this->DOCTOR->LinkCustomAttributes = "";
            $this->DOCTOR->HrefValue = "";
            $this->DOCTOR->TooltipValue = "";

            // SERVED_INAP
            $this->SERVED_INAP->LinkCustomAttributes = "";
            $this->SERVED_INAP->HrefValue = "";
            $this->SERVED_INAP->TooltipValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";
            $this->STATUS_PASIEN_ID->TooltipValue = "";

            // ISRJ
            $this->ISRJ->LinkCustomAttributes = "";
            $this->ISRJ->HrefValue = "";
            $this->ISRJ->TooltipValue = "";

            // VISIT_ID
            $this->VISIT_ID->LinkCustomAttributes = "";
            $this->VISIT_ID->HrefValue = "";
            $this->VISIT_ID->TooltipValue = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->LinkCustomAttributes = "";
            $this->IDXDAFTAR->HrefValue = "";
            $this->IDXDAFTAR->TooltipValue = "";

            // DIANTAR_OLEH
            $this->DIANTAR_OLEH->LinkCustomAttributes = "";
            $this->DIANTAR_OLEH->HrefValue = "";
            $this->DIANTAR_OLEH->TooltipValue = "";

            // EXIT_DATE
            $this->EXIT_DATE->LinkCustomAttributes = "";
            $this->EXIT_DATE->HrefValue = "";
            $this->EXIT_DATE->TooltipValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->LinkCustomAttributes = "";
            $this->KELUAR_ID->HrefValue = "";
            $this->KELUAR_ID->TooltipValue = "";

            // AGEYEAR
            $this->AGEYEAR->LinkCustomAttributes = "";
            $this->AGEYEAR->HrefValue = "";
            $this->AGEYEAR->TooltipValue = "";
        }

        // Call Cell_Rendered event
        if ($this->RowType == ROWTYPE_TOTAL) {
            // IDXDAFTAR
            $currentValue = $this->IDXDAFTAR->CntValue;
            $viewValue = &$this->IDXDAFTAR->CntViewValue;
            $viewAttrs = &$this->IDXDAFTAR->ViewAttrs;
            $cellAttrs = &$this->IDXDAFTAR->CellAttrs;
            $hrefValue = &$this->IDXDAFTAR->HrefValue;
            $linkAttrs = &$this->IDXDAFTAR->LinkAttrs;
            $this->cellRendered($this->IDXDAFTAR, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
        } else {
            // NO_REGISTRATION
            $currentValue = $this->NO_REGISTRATION->CurrentValue;
            $viewValue = &$this->NO_REGISTRATION->ViewValue;
            $viewAttrs = &$this->NO_REGISTRATION->ViewAttrs;
            $cellAttrs = &$this->NO_REGISTRATION->CellAttrs;
            $hrefValue = &$this->NO_REGISTRATION->HrefValue;
            $linkAttrs = &$this->NO_REGISTRATION->LinkAttrs;
            $this->cellRendered($this->NO_REGISTRATION, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // GENDER
            $currentValue = $this->GENDER->CurrentValue;
            $viewValue = &$this->GENDER->ViewValue;
            $viewAttrs = &$this->GENDER->ViewAttrs;
            $cellAttrs = &$this->GENDER->CellAttrs;
            $hrefValue = &$this->GENDER->HrefValue;
            $linkAttrs = &$this->GENDER->LinkAttrs;
            $this->cellRendered($this->GENDER, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // TREATMENT
            $currentValue = $this->TREATMENT->CurrentValue;
            $viewValue = &$this->TREATMENT->ViewValue;
            $viewAttrs = &$this->TREATMENT->ViewAttrs;
            $cellAttrs = &$this->TREATMENT->CellAttrs;
            $hrefValue = &$this->TREATMENT->HrefValue;
            $linkAttrs = &$this->TREATMENT->LinkAttrs;
            $this->cellRendered($this->TREATMENT, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // CLASS_ROOM_ID
            $currentValue = $this->CLASS_ROOM_ID->CurrentValue;
            $viewValue = &$this->CLASS_ROOM_ID->ViewValue;
            $viewAttrs = &$this->CLASS_ROOM_ID->ViewAttrs;
            $cellAttrs = &$this->CLASS_ROOM_ID->CellAttrs;
            $hrefValue = &$this->CLASS_ROOM_ID->HrefValue;
            $linkAttrs = &$this->CLASS_ROOM_ID->LinkAttrs;
            $this->cellRendered($this->CLASS_ROOM_ID, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // BED_ID
            $currentValue = $this->BED_ID->CurrentValue;
            $viewValue = &$this->BED_ID->ViewValue;
            $viewAttrs = &$this->BED_ID->ViewAttrs;
            $cellAttrs = &$this->BED_ID->CellAttrs;
            $hrefValue = &$this->BED_ID->HrefValue;
            $linkAttrs = &$this->BED_ID->LinkAttrs;
            $this->cellRendered($this->BED_ID, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // DOCTOR
            $currentValue = $this->DOCTOR->CurrentValue;
            $viewValue = &$this->DOCTOR->ViewValue;
            $viewAttrs = &$this->DOCTOR->ViewAttrs;
            $cellAttrs = &$this->DOCTOR->CellAttrs;
            $hrefValue = &$this->DOCTOR->HrefValue;
            $linkAttrs = &$this->DOCTOR->LinkAttrs;
            $this->cellRendered($this->DOCTOR, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // SERVED_INAP
            $currentValue = $this->SERVED_INAP->CurrentValue;
            $viewValue = &$this->SERVED_INAP->ViewValue;
            $viewAttrs = &$this->SERVED_INAP->ViewAttrs;
            $cellAttrs = &$this->SERVED_INAP->CellAttrs;
            $hrefValue = &$this->SERVED_INAP->HrefValue;
            $linkAttrs = &$this->SERVED_INAP->LinkAttrs;
            $this->cellRendered($this->SERVED_INAP, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // STATUS_PASIEN_ID
            $currentValue = $this->STATUS_PASIEN_ID->CurrentValue;
            $viewValue = &$this->STATUS_PASIEN_ID->ViewValue;
            $viewAttrs = &$this->STATUS_PASIEN_ID->ViewAttrs;
            $cellAttrs = &$this->STATUS_PASIEN_ID->CellAttrs;
            $hrefValue = &$this->STATUS_PASIEN_ID->HrefValue;
            $linkAttrs = &$this->STATUS_PASIEN_ID->LinkAttrs;
            $this->cellRendered($this->STATUS_PASIEN_ID, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // ISRJ
            $currentValue = $this->ISRJ->CurrentValue;
            $viewValue = &$this->ISRJ->ViewValue;
            $viewAttrs = &$this->ISRJ->ViewAttrs;
            $cellAttrs = &$this->ISRJ->CellAttrs;
            $hrefValue = &$this->ISRJ->HrefValue;
            $linkAttrs = &$this->ISRJ->LinkAttrs;
            $this->cellRendered($this->ISRJ, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // VISIT_ID
            $currentValue = $this->VISIT_ID->CurrentValue;
            $viewValue = &$this->VISIT_ID->ViewValue;
            $viewAttrs = &$this->VISIT_ID->ViewAttrs;
            $cellAttrs = &$this->VISIT_ID->CellAttrs;
            $hrefValue = &$this->VISIT_ID->HrefValue;
            $linkAttrs = &$this->VISIT_ID->LinkAttrs;
            $this->cellRendered($this->VISIT_ID, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // IDXDAFTAR
            $currentValue = $this->IDXDAFTAR->CurrentValue;
            $viewValue = &$this->IDXDAFTAR->ViewValue;
            $viewAttrs = &$this->IDXDAFTAR->ViewAttrs;
            $cellAttrs = &$this->IDXDAFTAR->CellAttrs;
            $hrefValue = &$this->IDXDAFTAR->HrefValue;
            $linkAttrs = &$this->IDXDAFTAR->LinkAttrs;
            $this->cellRendered($this->IDXDAFTAR, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // DIANTAR_OLEH
            $currentValue = $this->DIANTAR_OLEH->CurrentValue;
            $viewValue = &$this->DIANTAR_OLEH->ViewValue;
            $viewAttrs = &$this->DIANTAR_OLEH->ViewAttrs;
            $cellAttrs = &$this->DIANTAR_OLEH->CellAttrs;
            $hrefValue = &$this->DIANTAR_OLEH->HrefValue;
            $linkAttrs = &$this->DIANTAR_OLEH->LinkAttrs;
            $this->cellRendered($this->DIANTAR_OLEH, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // EXIT_DATE
            $currentValue = $this->EXIT_DATE->CurrentValue;
            $viewValue = &$this->EXIT_DATE->ViewValue;
            $viewAttrs = &$this->EXIT_DATE->ViewAttrs;
            $cellAttrs = &$this->EXIT_DATE->CellAttrs;
            $hrefValue = &$this->EXIT_DATE->HrefValue;
            $linkAttrs = &$this->EXIT_DATE->LinkAttrs;
            $this->cellRendered($this->EXIT_DATE, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // KELUAR_ID
            $currentValue = $this->KELUAR_ID->CurrentValue;
            $viewValue = &$this->KELUAR_ID->ViewValue;
            $viewAttrs = &$this->KELUAR_ID->ViewAttrs;
            $cellAttrs = &$this->KELUAR_ID->CellAttrs;
            $hrefValue = &$this->KELUAR_ID->HrefValue;
            $linkAttrs = &$this->KELUAR_ID->LinkAttrs;
            $this->cellRendered($this->KELUAR_ID, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

            // AGEYEAR
            $currentValue = $this->AGEYEAR->CurrentValue;
            $viewValue = &$this->AGEYEAR->ViewValue;
            $viewAttrs = &$this->AGEYEAR->ViewAttrs;
            $cellAttrs = &$this->AGEYEAR->CellAttrs;
            $hrefValue = &$this->AGEYEAR->HrefValue;
            $linkAttrs = &$this->AGEYEAR->LinkAttrs;
            $this->cellRendered($this->AGEYEAR, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
        }

        // Call Row_Rendered event
        $this->rowRendered();
        $this->setupFieldCount();
    }
    private $groupCounts = [];

    // Get group count
    public function getGroupCount(...$args)
    {
        $key = "";
        foreach ($args as $arg) {
            if ($key != "") {
                $key .= "_";
            }
            $key .= strval($arg);
        }
        if ($key == "") {
            return -1;
        } elseif ($key == "0") { // Number of first level groups
            $i = 1;
            while (isset($this->groupCounts[strval($i)])) {
                $i++;
            }
            return $i - 1;
        }
        return isset($this->groupCounts[$key]) ? $this->groupCounts[$key] : -1;
    }

    // Set group count
    public function setGroupCount($value, ...$args)
    {
        $key = "";
        foreach ($args as $arg) {
            if ($key != "") {
                $key .= "_";
            }
            $key .= strval($arg);
        }
        if ($key == "") {
            return;
        }
        $this->groupCounts[$key] = $value;
    }

    // Setup field count
    protected function setupFieldCount()
    {
        $this->GroupColumnCount = 0;
        $this->SubGroupColumnCount = 0;
        $this->DetailColumnCount = 0;
        if ($this->NO_REGISTRATION->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->GENDER->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->TREATMENT->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->CLASS_ROOM_ID->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->BED_ID->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->DOCTOR->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->SERVED_INAP->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->STATUS_PASIEN_ID->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->ISRJ->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->VISIT_ID->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->IDXDAFTAR->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->DIANTAR_OLEH->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->EXIT_DATE->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->KELUAR_ID->Visible) {
            $this->DetailColumnCount += 1;
        }
        if ($this->AGEYEAR->Visible) {
            $this->DetailColumnCount += 1;
        }
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            return '<a class="ew-export-link ew-excel" title="' . HtmlEncode($Language->phrase("ExportToExcel", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToExcel", true)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportExcelUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToExcel") . '</a>';
        } elseif (SameText($type, "word")) {
            return '<a class="ew-export-link ew-word" title="' . HtmlEncode($Language->phrase("ExportToWord", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToWord", true)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportWordUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToWord") . '</a>';
        } elseif (SameText($type, "pdf")) {
            return '<a class="ew-export-link ew-pdf" title="' . HtmlEncode($Language->phrase("ExportToPDF", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToPDF", true)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportPdfUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToPDF") . '</a>';
        } elseif (SameText($type, "email")) {
            $url = $pageUrl . "export=email" . ($custom ? "&amp;custom=1" : "");
            return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", true)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", true)) . '" id="emf_register_ranap" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_register_ranap\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $url . '\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = false;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = false;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = false;

        // Export to Pdf
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = false;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = false;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Hide options for export
        if ($this->isExport()) {
            $this->ExportOptions->hideAllOptions();
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fsummary\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
        $Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, true);
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
                case "x_GENDER":
                    break;
                case "x_CLASS_ROOM_ID":
                    break;
                case "x_STATUS_PASIEN_ID":
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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up starting group
    protected function setupStartGroup()
    {
        // Exit if no groups
        if ($this->DisplayGroups == 0) {
            return;
        }
        $startGrp = Param(Config("TABLE_START_GROUP"), "");
        $pageNo = Param("pageno", "");

        // Check for a 'start' parameter
        if ($startGrp != "") {
            $this->StartGroup = $startGrp;
            $this->setStartGroup($this->StartGroup);
        } elseif ($pageNo != "") {
            if (is_numeric($pageNo)) {
                $this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
                if ($this->StartGroup <= 0) {
                    $this->StartGroup = 1;
                } elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
                    $this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
                }
                $this->setStartGroup($this->StartGroup);
            } else {
                $this->StartGroup = $this->getStartGroup();
            }
        } else {
            $this->StartGroup = $this->getStartGroup();
        }

        // Check if correct start group counter
        if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
            $this->StartGroup = 1; // Reset start group counter
            $this->setStartGroup($this->StartGroup);
        } elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
            $this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
            $this->setStartGroup($this->StartGroup);
        } elseif (($this->StartGroup - 1) % $this->DisplayGroups != 0) {
            $this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
            $this->setStartGroup($this->StartGroup);
        }
    }

    // Reset pager
    protected function resetPager()
    {
        // Reset start position (reset command)
        $this->StartGroup = 1;
        $this->setStartGroup($this->StartGroup);
    }

    // Set up number of groups displayed per page
    protected function setupDisplayGroups()
    {
        $this->DisplayGroups = 5; // Load default
        if (Param(Config("TABLE_GROUP_PER_PAGE")) !== null) {
            $wrk = Param(Config("TABLE_GROUP_PER_PAGE"));
            if (is_numeric($wrk)) {
                $this->DisplayGroups = intval($wrk);
            } elseif (strtoupper($wrk) == "ALL") { // Display all groups
                $this->DisplayGroups = -1;
            }

            // Reset start position (reset command)
            $this->StartGroup = 1;
            $this->setStartGroup($this->StartGroup);
        } elseif ($this->getGroupPerPage() != "") {
            $this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
        }
        $this->setGroupPerPage($this->DisplayGroups); // Save to session
    }

    // Get sort parameters based on sort links clicked
    protected function getSort()
    {
        if ($this->DrillDown) {
            return "dbo.PASIEN_VISITATION.SERVED_INAP DESC";
        }
        $resetSort = Param("cmd") === "resetsort";
        $orderBy = Param("order", "");
        $orderType = Param("ordertype", "");

        // Check for a resetsort command
        if ($resetSort) {
            $this->setOrderBy("");
            $this->setStartGroup(1);
            $this->NO_REGISTRATION->setSort("");
            $this->GENDER->setSort("");
            $this->TREATMENT->setSort("");
            $this->CLASS_ROOM_ID->setSort("");
            $this->BED_ID->setSort("");
            $this->DOCTOR->setSort("");
            $this->SERVED_INAP->setSort("");
            $this->STATUS_PASIEN_ID->setSort("");
            $this->ISRJ->setSort("");
            $this->VISIT_ID->setSort("");
            $this->IDXDAFTAR->setSort("");
            $this->DIANTAR_OLEH->setSort("");
            $this->EXIT_DATE->setSort("");
            $this->KELUAR_ID->setSort("");
            $this->AGEYEAR->setSort("");

        // Check for an Order parameter
        } elseif ($orderBy != "") {
            $this->CurrentOrder = $orderBy;
            $this->CurrentOrderType = $orderType;
            $this->updateSort($this->NO_REGISTRATION); // NO_REGISTRATION
            $this->updateSort($this->GENDER); // GENDER
            $this->updateSort($this->TREATMENT); // TREATMENT
            $this->updateSort($this->CLASS_ROOM_ID); // CLASS_ROOM_ID
            $this->updateSort($this->BED_ID); // BED_ID
            $this->updateSort($this->DOCTOR); // DOCTOR
            $this->updateSort($this->SERVED_INAP); // SERVED_INAP
            $this->updateSort($this->STATUS_PASIEN_ID); // STATUS_PASIEN_ID
            $this->updateSort($this->ISRJ); // ISRJ
            $this->updateSort($this->VISIT_ID); // VISIT_ID
            $this->updateSort($this->IDXDAFTAR); // IDXDAFTAR
            $this->updateSort($this->DIANTAR_OLEH); // DIANTAR_OLEH
            $this->updateSort($this->EXIT_DATE); // EXIT_DATE
            $this->updateSort($this->KELUAR_ID); // KELUAR_ID
            $this->updateSort($this->AGEYEAR); // AGEYEAR
            $sortSql = $this->sortSql();
            $this->setOrderBy($sortSql);
            $this->setStartGroup(1);
        }

        // Set up default sort
        if ($this->getOrderBy() == "") {
            $useDefaultSort = true;
            if ($this->SERVED_INAP->getSort() != "") {
                $useDefaultSort = false;
            }
            if ($useDefaultSort) {
                $this->SERVED_INAP->setSort("DESC");
                $this->setOrderBy("dbo.PASIEN_VISITATION.SERVED_INAP DESC");
            }
        }
        return $this->getOrderBy();
    }

    // Return extended filter
    protected function getExtendedFilter()
    {
        $filter = "";
        if ($this->DrillDown) {
            return "";
        }
        $restoreSession = false;
        $restoreDefault = false;
        // Reset search command
        if (Get("cmd", "") == "reset") {
            // Set default values
            $this->CLASS_ROOM_ID->AdvancedSearch->unsetSession();
            $this->SERVED_INAP->AdvancedSearch->unsetSession();
            $restoreDefault = true;
        } else {
            $restoreSession = !$this->SearchCommand;

            // Field CLASS_ROOM_ID
            $this->getDropDownValue($this->CLASS_ROOM_ID);

            // Field SERVED_INAP
            if ($this->SERVED_INAP->AdvancedSearch->get()) {
            }
            if (!$this->validateForm()) {
                return $filter;
            }
        }

        // Restore session
        if ($restoreSession) {
            $restoreDefault = true;
            if ($this->CLASS_ROOM_ID->AdvancedSearch->issetSession()) { // Field CLASS_ROOM_ID
                $this->CLASS_ROOM_ID->AdvancedSearch->load();
                $restoreDefault = false;
            }
            if ($this->SERVED_INAP->AdvancedSearch->issetSession()) { // Field SERVED_INAP
                $this->SERVED_INAP->AdvancedSearch->load();
                $restoreDefault = false;
            }
        }

        // Restore default
        if ($restoreDefault) {
            $this->loadDefaultFilters();
        }

        // Call page filter validated event
        $this->pageFilterValidated();

        // Build SQL and save to session
        $this->buildDropDownFilter($this->CLASS_ROOM_ID, $filter, $this->CLASS_ROOM_ID->AdvancedSearch->SearchOperator, false, true); // Field CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->AdvancedSearch->save();
        $this->buildExtendedFilter($this->SERVED_INAP, $filter, false, true); // Field SERVED_INAP
        $this->SERVED_INAP->AdvancedSearch->save();

        // Field CLASS_ROOM_ID
        LoadDropDownList($this->CLASS_ROOM_ID->EditValue, $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue);
        return $filter;
    }

    // Build dropdown filter
    protected function buildDropDownFilter(&$fld, &$filterClause, $fldOpr, $default = false, $saveFilter = false)
    {
        $fldVal = $default ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $sql = "";
        if (is_array($fldVal)) {
            foreach ($fldVal as $val) {
                $wrk = $this->getDropDownFilter($fld, $val, $fldOpr);
                if ($wrk != "") {
                    if ($sql != "") {
                        $sql .= " OR " . $wrk;
                    } else {
                        $sql = $wrk;
                    }
                }
            }
        } else {
            $fldVal2 = $default ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
            $sql = $this->getDropDownFilter($fld, $fldVal, $fldOpr, $fldVal2);
        }
        if ($sql != "") {
            AddFilter($filterClause, $sql);
            if ($saveFilter) {
                $fld->CurrentFilter = $sql;
            }
        }
    }

    // Get dropdown filter
    protected function getDropDownFilter(&$fld, $fldVal, $fldOpr, $fldVal2 = "")
    {
        $fldName = $fld->Name;
        $fldExpression = $fld->Expression;
        $fldDataType = $fld->DataType;
        $isMultiple = $fld->HtmlTag == "CHECKBOX" || $fld->HtmlTag == "SELECT" && $fld->SelectMultiple;
        $fldVal = strval($fldVal);
        if ($fldOpr == "") {
            $fldOpr = "=";
        }
        $wrk = "";
        if (SameString($fldVal, Config("NULL_VALUE"))) {
            $wrk = $fldExpression . " IS NULL";
        } elseif (SameString($fldVal, Config("NOT_NULL_VALUE"))) {
            $wrk = $fldExpression . " IS NOT NULL";
        } elseif (SameString($fldVal, EMPTY_VALUE)) {
            $wrk = $fldExpression . " = ''";
        } elseif (SameString($fldVal, ALL_VALUE)) {
            $wrk = "1 = 1";
        } else {
            if ($fld->GroupSql != "") { // Use grouping SQL for search if exists
                $fldExpression = str_replace("%s", $fldExpression, $fld->GroupSql);
            }
            if (StartsString("@@", $fldVal)) {
                $wrk = $this->getCustomFilter($fld, $fldVal, $this->Dbid);
            } elseif ($isMultiple && IsMultiSearchOperator($fldOpr) && trim($fldVal) != "" && $fldVal != INIT_VALUE && ($fldDataType == DATATYPE_NUMBER || $fldDataType == DATATYPE_STRING || $fldDataType == DATATYPE_MEMO)) {
                $wrk = GetMultiSearchSql($fld, $fldOpr, trim($fldVal), $this->Dbid);
            } elseif ($fldOpr == "BETWEEN" && $fldVal != "" && $fldVal != INIT_VALUE && $fldVal2 != "" && $fldVal2 != INIT_VALUE) {
                $wrk = $fldExpression ." " . $fldOpr . " " . QuotedValue($fldVal, $fldDataType, $this->Dbid) . " AND " . QuotedValue($fldVal2, $fldDataType, $this->Dbid);
            } else {
                if ($fldVal != "" && $fldVal != INIT_VALUE) {
                    if ($fldDataType == DATATYPE_DATE && $fld->GroupSql == "" && $fldOpr != "") {
                        $wrk = GetDateFilterSql($fldExpression, $fldOpr, $fldVal, $fldDataType, $this->Dbid);
                    } else {
                        $wrk = GetFilterSql($fldOpr, $fldVal, $fldDataType, $this->Dbid);
                        if ($wrk != "") {
                            $wrk = $fldExpression . $wrk;
                        }
                    }
                }
            }
        }

        // Call Page Filtering event
        if (!StartsString("@@", $fldVal)) {
            $this->pageFiltering($fld, $wrk, "dropdown", $fldOpr, $fldVal);
        }
        return $wrk;
    }

    // Get custom filter
    protected function getCustomFilter(&$fld, $fldVal, $dbid = 0)
    {
        $wrk = "";
        if (is_array($fld->AdvancedFilters)) {
            foreach ($fld->AdvancedFilters as $filter) {
                if ($filter->ID == $fldVal && $filter->Enabled) {
                    $fldExpr = $fld->Expression;
                    $fn = $filter->FunctionName;
                    $wrkid = StartsString("@@", $filter->ID) ? substr($filter->ID, 2) : $filter->ID;
                    $fn = $fn != "" && !function_exists($fn) ? PROJECT_NAMESPACE . $fn : $fn;
                    if (function_exists($fn)) {
                        $wrk = $fn($fldExpr, $dbid);
                    } else {
                        $wrk = "";
                    }
                    $this->pageFiltering($fld, $wrk, "custom", $wrkid);
                    break;
                }
            }
        }
        return $wrk;
    }

    // Build extended filter
    protected function buildExtendedFilter(&$fld, &$filterClause, $default = false, $saveFilter = false)
    {
        $wrk = GetExtendedFilter($fld, $default, $this->Dbid);
        if (!$default) {
            $this->pageFiltering($fld, $wrk, "extended", $fld->AdvancedSearch->SearchOperator, $fld->AdvancedSearch->SearchValue, $fld->AdvancedSearch->SearchCondition, $fld->AdvancedSearch->SearchOperator2, $fld->AdvancedSearch->SearchValue2);
        }
        if ($wrk != "") {
            AddFilter($filterClause, $wrk);
            if ($saveFilter) {
                $fld->CurrentFilter = $wrk;
            }
        }
    }

    // Get drop down value from querystring
    protected function getDropDownValue(&$fld)
    {
        $ret = false;
        $parm = $fld->Param;
        if (IsPost()) {
            return false; // Skip post back
        }
        $opr = Get("z_$parm");
        if ($opr !== null) {
            $fld->AdvancedSearch->SearchOperator = $opr;
        }
        $val = Get("x_$parm");
        if ($val !== null) {
            if (is_array($val)) {
                $val = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $val);
            }
            $fld->AdvancedSearch->setSearchValue($val);
            $ret = true;
        }
        $val = Get("y_$parm");
        if ($val !== null) {
            if (is_array($val)) {
                $val = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $val);
            }
            $fld->AdvancedSearch->setSearchValue2($val);
            $ret = true;
        }
        return $ret;
    }

    // Dropdown filter exist
    protected function dropDownFilterExist(&$fld, $fldOpr)
    {
        $wrk = "";
        $this->buildDropDownFilter($fld, $wrk, $fldOpr);
        return ($wrk != "");
    }

    // Extended filter exist
    protected function extendedFilterExist(&$fld)
    {
        $extWrk = "";
        $this->buildExtendedFilter($fld, $extWrk);
        return ($extWrk != "");
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
                if (!CheckInteger($this->AGEYEAR->FormValue)) {
                    $this->AGEYEAR->addErrorMessage($this->AGEYEAR->getErrorMessage(false));
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

    // Load default value for filters
    protected function loadDefaultFilters()
    {
        // Field CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->AdvancedSearch->loadDefault();

        // Field SERVED_INAP
        $this->SERVED_INAP->AdvancedSearch->loadDefault();
    }

    // Show list of filters
    public function showFilterList()
    {
        global $Language;

        // Initialize
        $filterList = "";
        $captionClass = $this->isExport("email") ? "ew-filter-caption-email" : "ew-filter-caption";
        $captionSuffix = $this->isExport("email") ? ": " : "";

        // Field CLASS_ROOM_ID
        $extWrk = "";
        $this->buildDropDownFilter($this->CLASS_ROOM_ID, $extWrk, $this->CLASS_ROOM_ID->AdvancedSearch->SearchOperator);
        $filter = "";
        if ($extWrk != "") {
            $filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->CLASS_ROOM_ID->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Field SERVED_INAP
        $extWrk = "";
        $this->buildExtendedFilter($this->SERVED_INAP, $extWrk);
        $filter = "";
        if ($extWrk != "") {
            $filter .= "<span class=\"ew-filter-value\">$extWrk</span>";
        }
        if ($filter != "") {
            $filterList .= "<div><span class=\"" . $captionClass . "\">" . $this->SERVED_INAP->caption() . "</span>" . $captionSuffix . $filter . "</div>";
        }

        // Show Filters
        if ($filterList != "") {
            $message = "<div id=\"ew-filter-list\" class=\"alert alert-info d-table\"><div id=\"ew-current-filters\">" .
                $Language->phrase("CurrentFilters") . "</div>" . $filterList . "</div>";
            $this->messageShowing($message, "");
            Write($message);
        }
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";

        // Field CLASS_ROOM_ID
        $wrk = "";
        $wrk = ($this->CLASS_ROOM_ID->AdvancedSearch->SearchValue != INIT_VALUE) ? $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue : "";
        if (is_array($wrk)) {
            $wrk = implode("||", $wrk);
        }
        if ($wrk != "") {
            $wrk = "\"x_CLASS_ROOM_ID\":\"" . JsEncode($wrk) . "\"";
        }
        if ($wrk != "") {
            if ($filterList != "") {
                $filterList .= ",";
            }
            $filterList .= $wrk;
        }

        // Field SERVED_INAP
        $wrk = "";
        if ($this->SERVED_INAP->AdvancedSearch->SearchValue != "" || $this->SERVED_INAP->AdvancedSearch->SearchValue2 != "") {
            $wrk = "\"x_SERVED_INAP\":\"" . JsEncode($this->SERVED_INAP->AdvancedSearch->SearchValue) . "\"," .
                "\"z_SERVED_INAP\":\"" . JsEncode($this->SERVED_INAP->AdvancedSearch->SearchOperator) . "\"," .
                "\"v_SERVED_INAP\":\"" . JsEncode($this->SERVED_INAP->AdvancedSearch->SearchCondition) . "\"," .
                "\"y_SERVED_INAP\":\"" . JsEncode($this->SERVED_INAP->AdvancedSearch->SearchValue2) . "\"," .
                "\"w_SERVED_INAP\":\"" . JsEncode($this->SERVED_INAP->AdvancedSearch->SearchOperator2) . "\"";
        }
        if ($wrk != "") {
            if ($filterList != "") {
                $filterList .= ",";
            }
            $filterList .= $wrk;
        }

        // Return filter list in json
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd", "") != "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter", ""), true);
        return $this->setupFilterList($filter);
    }

    // Setup list of filters
    protected function setupFilterList($filter)
    {
        if (!is_array($filter)) {
            return false;
        }

        // Field CLASS_ROOM_ID
        if (!$this->CLASS_ROOM_ID->AdvancedSearch->getFromArray($filter)) {
            $this->CLASS_ROOM_ID->AdvancedSearch->loadDefault(); // Clear filter
        }
        $this->CLASS_ROOM_ID->AdvancedSearch->save();

        // Field SERVED_INAP
        if (!$this->SERVED_INAP->AdvancedSearch->getFromArray($filter)) {
            $this->SERVED_INAP->AdvancedSearch->loadDefault(); // Clear filter
        }
        $this->SERVED_INAP->AdvancedSearch->save();
        return true;
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

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content
    }

    // Load Filters event
    public function pageFilterLoad()
    {
        // Enter your code here
        // Example: Register/Unregister Custom Extended Filter
        //RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
        //RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
        //UnregisterFilter($this-><Field>, 'StartsWithA');
    }

    // Page Selecting event
    public function pageSelecting(&$filter)
    {
        // Enter your code here
    }

    // Page Filter Validated event
    public function pageFilterValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Page Filtering event
    public function pageFiltering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "")
    {
        // Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
        //if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
        //    $filter = "..."; // Modify the filter
        //if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
        //    $filter = "..."; // Modify the filter
        //if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
        //    $filter = "..."; // Modify the filter
    }

    // Cell Rendered event
    public function cellRendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs)
    {
        //$ViewValue = "xxx";
        //$ViewAttrs["class"] = "xxx";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
