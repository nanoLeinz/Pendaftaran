<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienDiagnosaList extends PasienDiagnosa
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'PASIEN_DIAGNOSA';

    // Page object name
    public $PageObjName = "PasienDiagnosaList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fPASIEN_DIAGNOSAlist";
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

        // Table object (PASIEN_DIAGNOSA)
        if (!isset($GLOBALS["PASIEN_DIAGNOSA"]) || get_class($GLOBALS["PASIEN_DIAGNOSA"]) == PROJECT_NAMESPACE . "PASIEN_DIAGNOSA") {
            $GLOBALS["PASIEN_DIAGNOSA"] = &$this;
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
        $this->AddUrl = "PasienDiagnosaAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "PasienDiagnosaDelete";
        $this->MultiUpdateUrl = "PasienDiagnosaUpdate";

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
        $this->FilterOptions->TagClassName = "ew-filter-option fPASIEN_DIAGNOSAlistsrch";

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

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } elseif (IsPost()) {
            if (Post("exporttype") !== null) {
                $this->Export = Post("exporttype");
            }
            $custom = Post("custom", "");
        } elseif (Get("cmd") == "json") {
            $this->Export = Get("cmd");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header

        // Update Export URLs
        if (Config("USE_PHPEXCEL")) {
            $this->ExportExcelCustom = false;
        }
        if (Config("USE_PHPWORD")) {
            $this->ExportWordCustom = false;
        }
        if ($this->ExportExcelCustom) {
            $this->ExportExcelUrl .= "&amp;custom=1";
        }
        if ($this->ExportWordCustom) {
            $this->ExportWordUrl .= "&amp;custom=1";
        }
        if ($this->ExportPdfCustom) {
            $this->ExportPdfUrl .= "&amp;custom=1";
        }
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();
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
        $filterList = Concat($filterList, $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->toJson(), ","); // Field PASIEN_DIAGNOSA_ID
        $filterList = Concat($filterList, $this->NO_REGISTRATION->AdvancedSearch->toJson(), ","); // Field NO_REGISTRATION
        $filterList = Concat($filterList, $this->THENAME->AdvancedSearch->toJson(), ","); // Field THENAME
        $filterList = Concat($filterList, $this->VISIT_ID->AdvancedSearch->toJson(), ","); // Field VISIT_ID
        $filterList = Concat($filterList, $this->CLINIC_ID->AdvancedSearch->toJson(), ","); // Field CLINIC_ID
        $filterList = Concat($filterList, $this->BILL_ID->AdvancedSearch->toJson(), ","); // Field BILL_ID
        $filterList = Concat($filterList, $this->CLASS_ROOM_ID->AdvancedSearch->toJson(), ","); // Field CLASS_ROOM_ID
        $filterList = Concat($filterList, $this->IN_DATE->AdvancedSearch->toJson(), ","); // Field IN_DATE
        $filterList = Concat($filterList, $this->EXIT_DATE->AdvancedSearch->toJson(), ","); // Field EXIT_DATE
        $filterList = Concat($filterList, $this->BED_ID->AdvancedSearch->toJson(), ","); // Field BED_ID
        $filterList = Concat($filterList, $this->KELUAR_ID->AdvancedSearch->toJson(), ","); // Field KELUAR_ID
        $filterList = Concat($filterList, $this->DATE_OF_DIAGNOSA->AdvancedSearch->toJson(), ","); // Field DATE_OF_DIAGNOSA
        $filterList = Concat($filterList, $this->REPORT_DATE->AdvancedSearch->toJson(), ","); // Field REPORT_DATE
        $filterList = Concat($filterList, $this->DIAGNOSA_ID->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID
        $filterList = Concat($filterList, $this->DIAGNOSA_DESC->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_DESC
        $filterList = Concat($filterList, $this->ANAMNASE->AdvancedSearch->toJson(), ","); // Field ANAMNASE
        $filterList = Concat($filterList, $this->PEMERIKSAAN->AdvancedSearch->toJson(), ","); // Field PEMERIKSAAN
        $filterList = Concat($filterList, $this->TERAPHY_DESC->AdvancedSearch->toJson(), ","); // Field TERAPHY_DESC
        $filterList = Concat($filterList, $this->INSTRUCTION->AdvancedSearch->toJson(), ","); // Field INSTRUCTION
        $filterList = Concat($filterList, $this->SUFFER_TYPE->AdvancedSearch->toJson(), ","); // Field SUFFER_TYPE
        $filterList = Concat($filterList, $this->INFECTED_BODY->AdvancedSearch->toJson(), ","); // Field INFECTED_BODY
        $filterList = Concat($filterList, $this->EMPLOYEE_ID->AdvancedSearch->toJson(), ","); // Field EMPLOYEE_ID
        $filterList = Concat($filterList, $this->RISK_LEVEL->AdvancedSearch->toJson(), ","); // Field RISK_LEVEL
        $filterList = Concat($filterList, $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->toJson(), ","); // Field MORFOLOGI_NEOPLASMA
        $filterList = Concat($filterList, $this->HURT->AdvancedSearch->toJson(), ","); // Field HURT
        $filterList = Concat($filterList, $this->HURT_TYPE->AdvancedSearch->toJson(), ","); // Field HURT_TYPE
        $filterList = Concat($filterList, $this->DIAG_CAT->AdvancedSearch->toJson(), ","); // Field DIAG_CAT
        $filterList = Concat($filterList, $this->ADDICTION_MATERIAL->AdvancedSearch->toJson(), ","); // Field ADDICTION_MATERIAL
        $filterList = Concat($filterList, $this->INFECTED_QUANTITY->AdvancedSearch->toJson(), ","); // Field INFECTED_QUANTITY
        $filterList = Concat($filterList, $this->CONTAGIOUS_TYPE->AdvancedSearch->toJson(), ","); // Field CONTAGIOUS_TYPE
        $filterList = Concat($filterList, $this->CURATIF_ID->AdvancedSearch->toJson(), ","); // Field CURATIF_ID
        $filterList = Concat($filterList, $this->RESULT_ID->AdvancedSearch->toJson(), ","); // Field RESULT_ID
        $filterList = Concat($filterList, $this->INFECTION_TYPE->AdvancedSearch->toJson(), ","); // Field INFECTION_TYPE
        $filterList = Concat($filterList, $this->INVESTIGATION_ID->AdvancedSearch->toJson(), ","); // Field INVESTIGATION_ID
        $filterList = Concat($filterList, $this->DISABILITY->AdvancedSearch->toJson(), ","); // Field DISABILITY
        $filterList = Concat($filterList, $this->DESCRIPTION->AdvancedSearch->toJson(), ","); // Field DESCRIPTION
        $filterList = Concat($filterList, $this->KOMPLIKASI->AdvancedSearch->toJson(), ","); // Field KOMPLIKASI
        $filterList = Concat($filterList, $this->MODIFIED_DATE->AdvancedSearch->toJson(), ","); // Field MODIFIED_DATE
        $filterList = Concat($filterList, $this->MODIFIED_BY->AdvancedSearch->toJson(), ","); // Field MODIFIED_BY
        $filterList = Concat($filterList, $this->MODIFIED_FROM->AdvancedSearch->toJson(), ","); // Field MODIFIED_FROM
        $filterList = Concat($filterList, $this->STATUS_PASIEN_ID->AdvancedSearch->toJson(), ","); // Field STATUS_PASIEN_ID
        $filterList = Concat($filterList, $this->AGEYEAR->AdvancedSearch->toJson(), ","); // Field AGEYEAR
        $filterList = Concat($filterList, $this->AGEMONTH->AdvancedSearch->toJson(), ","); // Field AGEMONTH
        $filterList = Concat($filterList, $this->AGEDAY->AdvancedSearch->toJson(), ","); // Field AGEDAY
        $filterList = Concat($filterList, $this->THEADDRESS->AdvancedSearch->toJson(), ","); // Field THEADDRESS
        $filterList = Concat($filterList, $this->THEID->AdvancedSearch->toJson(), ","); // Field THEID
        $filterList = Concat($filterList, $this->ISRJ->AdvancedSearch->toJson(), ","); // Field ISRJ
        $filterList = Concat($filterList, $this->GENDER->AdvancedSearch->toJson(), ","); // Field GENDER
        $filterList = Concat($filterList, $this->DOCTOR->AdvancedSearch->toJson(), ","); // Field DOCTOR
        $filterList = Concat($filterList, $this->KAL_ID->AdvancedSearch->toJson(), ","); // Field KAL_ID
        $filterList = Concat($filterList, $this->ACCOUNT_ID->AdvancedSearch->toJson(), ","); // Field ACCOUNT_ID
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_02->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_02
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_03->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_03
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_04->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_04
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_05->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_05
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_06->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_06
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_07->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_07
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_08->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_08
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_09->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_09
        $filterList = Concat($filterList, $this->DIAGNOSA_ID_10->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID_10
        $filterList = Concat($filterList, $this->PROCEDURE_01->AdvancedSearch->toJson(), ","); // Field PROCEDURE_01
        $filterList = Concat($filterList, $this->PROCEDURE_02->AdvancedSearch->toJson(), ","); // Field PROCEDURE_02
        $filterList = Concat($filterList, $this->PROCEDURE_03->AdvancedSearch->toJson(), ","); // Field PROCEDURE_03
        $filterList = Concat($filterList, $this->PROCEDURE_04->AdvancedSearch->toJson(), ","); // Field PROCEDURE_04
        $filterList = Concat($filterList, $this->PROCEDURE_05->AdvancedSearch->toJson(), ","); // Field PROCEDURE_05
        $filterList = Concat($filterList, $this->PROCEDURE_06->AdvancedSearch->toJson(), ","); // Field PROCEDURE_06
        $filterList = Concat($filterList, $this->PROCEDURE_07->AdvancedSearch->toJson(), ","); // Field PROCEDURE_07
        $filterList = Concat($filterList, $this->PROCEDURE_08->AdvancedSearch->toJson(), ","); // Field PROCEDURE_08
        $filterList = Concat($filterList, $this->PROCEDURE_09->AdvancedSearch->toJson(), ","); // Field PROCEDURE_09
        $filterList = Concat($filterList, $this->PROCEDURE_10->AdvancedSearch->toJson(), ","); // Field PROCEDURE_10
        $filterList = Concat($filterList, $this->DIAGNOSA_ID2->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_ID2
        $filterList = Concat($filterList, $this->WEIGHT->AdvancedSearch->toJson(), ","); // Field WEIGHT
        $filterList = Concat($filterList, $this->NOKARTU->AdvancedSearch->toJson(), ","); // Field NOKARTU
        $filterList = Concat($filterList, $this->NOSEP->AdvancedSearch->toJson(), ","); // Field NOSEP
        $filterList = Concat($filterList, $this->TGLSEP->AdvancedSearch->toJson(), ","); // Field TGLSEP
        $filterList = Concat($filterList, $this->RENCANATL->AdvancedSearch->toJson(), ","); // Field RENCANATL
        $filterList = Concat($filterList, $this->DIRUJUKKE->AdvancedSearch->toJson(), ","); // Field DIRUJUKKE
        $filterList = Concat($filterList, $this->TGLKONTROL->AdvancedSearch->toJson(), ","); // Field TGLKONTROL
        $filterList = Concat($filterList, $this->KDPOLI_KONTROL->AdvancedSearch->toJson(), ","); // Field KDPOLI_KONTROL
        $filterList = Concat($filterList, $this->JAMINAN->AdvancedSearch->toJson(), ","); // Field JAMINAN
        $filterList = Concat($filterList, $this->SPESIALISTIK->AdvancedSearch->toJson(), ","); // Field SPESIALISTIK
        $filterList = Concat($filterList, $this->PEMERIKSAAN_02->AdvancedSearch->toJson(), ","); // Field PEMERIKSAAN_02
        $filterList = Concat($filterList, $this->DIAGNOSA_DESC_02->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_DESC_02
        $filterList = Concat($filterList, $this->DIAGNOSA_DESC_03->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_DESC_03
        $filterList = Concat($filterList, $this->DIAGNOSA_DESC_04->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_DESC_04
        $filterList = Concat($filterList, $this->DIAGNOSA_DESC_05->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_DESC_05
        $filterList = Concat($filterList, $this->DIAGNOSA_DESC_06->AdvancedSearch->toJson(), ","); // Field DIAGNOSA_DESC_06
        $filterList = Concat($filterList, $this->PROCEDURE_DESC_01->AdvancedSearch->toJson(), ","); // Field PROCEDURE_DESC_01
        $filterList = Concat($filterList, $this->PROCEDURE_DESC_02->AdvancedSearch->toJson(), ","); // Field PROCEDURE_DESC_02
        $filterList = Concat($filterList, $this->PROCEDURE_DESC_03->AdvancedSearch->toJson(), ","); // Field PROCEDURE_DESC_03
        $filterList = Concat($filterList, $this->PROCEDURE_DESC_04->AdvancedSearch->toJson(), ","); // Field PROCEDURE_DESC_04
        $filterList = Concat($filterList, $this->PROCEDURE_DESC_05->AdvancedSearch->toJson(), ","); // Field PROCEDURE_DESC_05
        $filterList = Concat($filterList, $this->RESPONPOST->AdvancedSearch->toJson(), ","); // Field RESPONPOST
        $filterList = Concat($filterList, $this->RESPONPUT->AdvancedSearch->toJson(), ","); // Field RESPONPUT
        $filterList = Concat($filterList, $this->RESPONDEL->AdvancedSearch->toJson(), ","); // Field RESPONDEL
        $filterList = Concat($filterList, $this->JSONPOST->AdvancedSearch->toJson(), ","); // Field JSONPOST
        $filterList = Concat($filterList, $this->JSONPUT->AdvancedSearch->toJson(), ","); // Field JSONPUT
        $filterList = Concat($filterList, $this->JSONDEL->AdvancedSearch->toJson(), ","); // Field JSONDEL
        $filterList = Concat($filterList, $this->height->AdvancedSearch->toJson(), ","); // Field height
        $filterList = Concat($filterList, $this->TEMPERATURE->AdvancedSearch->toJson(), ","); // Field TEMPERATURE
        $filterList = Concat($filterList, $this->TENSION_UPPER->AdvancedSearch->toJson(), ","); // Field TENSION_UPPER
        $filterList = Concat($filterList, $this->TENSION_BELOW->AdvancedSearch->toJson(), ","); // Field TENSION_BELOW
        $filterList = Concat($filterList, $this->NADI->AdvancedSearch->toJson(), ","); // Field NADI
        $filterList = Concat($filterList, $this->NAFAS->AdvancedSearch->toJson(), ","); // Field NAFAS
        $filterList = Concat($filterList, $this->spec_procedures->AdvancedSearch->toJson(), ","); // Field spec_procedures
        $filterList = Concat($filterList, $this->spec_drug->AdvancedSearch->toJson(), ","); // Field spec_drug
        $filterList = Concat($filterList, $this->spec_prothesis->AdvancedSearch->toJson(), ","); // Field spec_prothesis
        $filterList = Concat($filterList, $this->spec_investigation->AdvancedSearch->toJson(), ","); // Field spec_investigation
        $filterList = Concat($filterList, $this->procedure_11->AdvancedSearch->toJson(), ","); // Field procedure_11
        $filterList = Concat($filterList, $this->procedure_12->AdvancedSearch->toJson(), ","); // Field procedure_12
        $filterList = Concat($filterList, $this->procedure_13->AdvancedSearch->toJson(), ","); // Field procedure_13
        $filterList = Concat($filterList, $this->procedure_14->AdvancedSearch->toJson(), ","); // Field procedure_14
        $filterList = Concat($filterList, $this->procedure_15->AdvancedSearch->toJson(), ","); // Field procedure_15
        $filterList = Concat($filterList, $this->isanestesi->AdvancedSearch->toJson(), ","); // Field isanestesi
        $filterList = Concat($filterList, $this->isreposisi->AdvancedSearch->toJson(), ","); // Field isreposisi
        $filterList = Concat($filterList, $this->islab->AdvancedSearch->toJson(), ","); // Field islab
        $filterList = Concat($filterList, $this->isro->AdvancedSearch->toJson(), ","); // Field isro
        $filterList = Concat($filterList, $this->isekg->AdvancedSearch->toJson(), ","); // Field isekg
        $filterList = Concat($filterList, $this->ishecting->AdvancedSearch->toJson(), ","); // Field ishecting
        $filterList = Concat($filterList, $this->isgips->AdvancedSearch->toJson(), ","); // Field isgips
        $filterList = Concat($filterList, $this->islengkap->AdvancedSearch->toJson(), ","); // Field islengkap
        $filterList = Concat($filterList, $this->ID->AdvancedSearch->toJson(), ","); // Field ID
        $filterList = Concat($filterList, $this->IDXDAFTAR->AdvancedSearch->toJson(), ","); // Field IDXDAFTAR
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fPASIEN_DIAGNOSAlistsrch", $filters);
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

        // Field PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->SearchValue = @$filter["x_PASIEN_DIAGNOSA_ID"];
        $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->SearchOperator = @$filter["z_PASIEN_DIAGNOSA_ID"];
        $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->SearchCondition = @$filter["v_PASIEN_DIAGNOSA_ID"];
        $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->SearchValue2 = @$filter["y_PASIEN_DIAGNOSA_ID"];
        $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->SearchOperator2 = @$filter["w_PASIEN_DIAGNOSA_ID"];
        $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->save();

        // Field NO_REGISTRATION
        $this->NO_REGISTRATION->AdvancedSearch->SearchValue = @$filter["x_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchOperator = @$filter["z_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchCondition = @$filter["v_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchValue2 = @$filter["y_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->SearchOperator2 = @$filter["w_NO_REGISTRATION"];
        $this->NO_REGISTRATION->AdvancedSearch->save();

        // Field THENAME
        $this->THENAME->AdvancedSearch->SearchValue = @$filter["x_THENAME"];
        $this->THENAME->AdvancedSearch->SearchOperator = @$filter["z_THENAME"];
        $this->THENAME->AdvancedSearch->SearchCondition = @$filter["v_THENAME"];
        $this->THENAME->AdvancedSearch->SearchValue2 = @$filter["y_THENAME"];
        $this->THENAME->AdvancedSearch->SearchOperator2 = @$filter["w_THENAME"];
        $this->THENAME->AdvancedSearch->save();

        // Field VISIT_ID
        $this->VISIT_ID->AdvancedSearch->SearchValue = @$filter["x_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->SearchOperator = @$filter["z_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->SearchCondition = @$filter["v_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->SearchValue2 = @$filter["y_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->SearchOperator2 = @$filter["w_VISIT_ID"];
        $this->VISIT_ID->AdvancedSearch->save();

        // Field CLINIC_ID
        $this->CLINIC_ID->AdvancedSearch->SearchValue = @$filter["x_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchOperator = @$filter["z_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchCondition = @$filter["v_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchValue2 = @$filter["y_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->save();

        // Field BILL_ID
        $this->BILL_ID->AdvancedSearch->SearchValue = @$filter["x_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->SearchOperator = @$filter["z_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->SearchCondition = @$filter["v_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->SearchValue2 = @$filter["y_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->SearchOperator2 = @$filter["w_BILL_ID"];
        $this->BILL_ID->AdvancedSearch->save();

        // Field CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue = @$filter["x_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchOperator = @$filter["z_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchCondition = @$filter["v_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue2 = @$filter["y_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CLASS_ROOM_ID"];
        $this->CLASS_ROOM_ID->AdvancedSearch->save();

        // Field IN_DATE
        $this->IN_DATE->AdvancedSearch->SearchValue = @$filter["x_IN_DATE"];
        $this->IN_DATE->AdvancedSearch->SearchOperator = @$filter["z_IN_DATE"];
        $this->IN_DATE->AdvancedSearch->SearchCondition = @$filter["v_IN_DATE"];
        $this->IN_DATE->AdvancedSearch->SearchValue2 = @$filter["y_IN_DATE"];
        $this->IN_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_IN_DATE"];
        $this->IN_DATE->AdvancedSearch->save();

        // Field EXIT_DATE
        $this->EXIT_DATE->AdvancedSearch->SearchValue = @$filter["x_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->SearchOperator = @$filter["z_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->SearchCondition = @$filter["v_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->SearchValue2 = @$filter["y_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_EXIT_DATE"];
        $this->EXIT_DATE->AdvancedSearch->save();

        // Field BED_ID
        $this->BED_ID->AdvancedSearch->SearchValue = @$filter["x_BED_ID"];
        $this->BED_ID->AdvancedSearch->SearchOperator = @$filter["z_BED_ID"];
        $this->BED_ID->AdvancedSearch->SearchCondition = @$filter["v_BED_ID"];
        $this->BED_ID->AdvancedSearch->SearchValue2 = @$filter["y_BED_ID"];
        $this->BED_ID->AdvancedSearch->SearchOperator2 = @$filter["w_BED_ID"];
        $this->BED_ID->AdvancedSearch->save();

        // Field KELUAR_ID
        $this->KELUAR_ID->AdvancedSearch->SearchValue = @$filter["x_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->SearchOperator = @$filter["z_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->SearchCondition = @$filter["v_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->SearchValue2 = @$filter["y_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->SearchOperator2 = @$filter["w_KELUAR_ID"];
        $this->KELUAR_ID->AdvancedSearch->save();

        // Field DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA->AdvancedSearch->SearchValue = @$filter["x_DATE_OF_DIAGNOSA"];
        $this->DATE_OF_DIAGNOSA->AdvancedSearch->SearchOperator = @$filter["z_DATE_OF_DIAGNOSA"];
        $this->DATE_OF_DIAGNOSA->AdvancedSearch->SearchCondition = @$filter["v_DATE_OF_DIAGNOSA"];
        $this->DATE_OF_DIAGNOSA->AdvancedSearch->SearchValue2 = @$filter["y_DATE_OF_DIAGNOSA"];
        $this->DATE_OF_DIAGNOSA->AdvancedSearch->SearchOperator2 = @$filter["w_DATE_OF_DIAGNOSA"];
        $this->DATE_OF_DIAGNOSA->AdvancedSearch->save();

        // Field REPORT_DATE
        $this->REPORT_DATE->AdvancedSearch->SearchValue = @$filter["x_REPORT_DATE"];
        $this->REPORT_DATE->AdvancedSearch->SearchOperator = @$filter["z_REPORT_DATE"];
        $this->REPORT_DATE->AdvancedSearch->SearchCondition = @$filter["v_REPORT_DATE"];
        $this->REPORT_DATE->AdvancedSearch->SearchValue2 = @$filter["y_REPORT_DATE"];
        $this->REPORT_DATE->AdvancedSearch->SearchOperator2 = @$filter["w_REPORT_DATE"];
        $this->REPORT_DATE->AdvancedSearch->save();

        // Field DIAGNOSA_ID
        $this->DIAGNOSA_ID->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID"];
        $this->DIAGNOSA_ID->AdvancedSearch->save();

        // Field DIAGNOSA_DESC
        $this->DIAGNOSA_DESC->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_DESC"];
        $this->DIAGNOSA_DESC->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_DESC"];
        $this->DIAGNOSA_DESC->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_DESC"];
        $this->DIAGNOSA_DESC->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_DESC"];
        $this->DIAGNOSA_DESC->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_DESC"];
        $this->DIAGNOSA_DESC->AdvancedSearch->save();

        // Field ANAMNASE
        $this->ANAMNASE->AdvancedSearch->SearchValue = @$filter["x_ANAMNASE"];
        $this->ANAMNASE->AdvancedSearch->SearchOperator = @$filter["z_ANAMNASE"];
        $this->ANAMNASE->AdvancedSearch->SearchCondition = @$filter["v_ANAMNASE"];
        $this->ANAMNASE->AdvancedSearch->SearchValue2 = @$filter["y_ANAMNASE"];
        $this->ANAMNASE->AdvancedSearch->SearchOperator2 = @$filter["w_ANAMNASE"];
        $this->ANAMNASE->AdvancedSearch->save();

        // Field PEMERIKSAAN
        $this->PEMERIKSAAN->AdvancedSearch->SearchValue = @$filter["x_PEMERIKSAAN"];
        $this->PEMERIKSAAN->AdvancedSearch->SearchOperator = @$filter["z_PEMERIKSAAN"];
        $this->PEMERIKSAAN->AdvancedSearch->SearchCondition = @$filter["v_PEMERIKSAAN"];
        $this->PEMERIKSAAN->AdvancedSearch->SearchValue2 = @$filter["y_PEMERIKSAAN"];
        $this->PEMERIKSAAN->AdvancedSearch->SearchOperator2 = @$filter["w_PEMERIKSAAN"];
        $this->PEMERIKSAAN->AdvancedSearch->save();

        // Field TERAPHY_DESC
        $this->TERAPHY_DESC->AdvancedSearch->SearchValue = @$filter["x_TERAPHY_DESC"];
        $this->TERAPHY_DESC->AdvancedSearch->SearchOperator = @$filter["z_TERAPHY_DESC"];
        $this->TERAPHY_DESC->AdvancedSearch->SearchCondition = @$filter["v_TERAPHY_DESC"];
        $this->TERAPHY_DESC->AdvancedSearch->SearchValue2 = @$filter["y_TERAPHY_DESC"];
        $this->TERAPHY_DESC->AdvancedSearch->SearchOperator2 = @$filter["w_TERAPHY_DESC"];
        $this->TERAPHY_DESC->AdvancedSearch->save();

        // Field INSTRUCTION
        $this->INSTRUCTION->AdvancedSearch->SearchValue = @$filter["x_INSTRUCTION"];
        $this->INSTRUCTION->AdvancedSearch->SearchOperator = @$filter["z_INSTRUCTION"];
        $this->INSTRUCTION->AdvancedSearch->SearchCondition = @$filter["v_INSTRUCTION"];
        $this->INSTRUCTION->AdvancedSearch->SearchValue2 = @$filter["y_INSTRUCTION"];
        $this->INSTRUCTION->AdvancedSearch->SearchOperator2 = @$filter["w_INSTRUCTION"];
        $this->INSTRUCTION->AdvancedSearch->save();

        // Field SUFFER_TYPE
        $this->SUFFER_TYPE->AdvancedSearch->SearchValue = @$filter["x_SUFFER_TYPE"];
        $this->SUFFER_TYPE->AdvancedSearch->SearchOperator = @$filter["z_SUFFER_TYPE"];
        $this->SUFFER_TYPE->AdvancedSearch->SearchCondition = @$filter["v_SUFFER_TYPE"];
        $this->SUFFER_TYPE->AdvancedSearch->SearchValue2 = @$filter["y_SUFFER_TYPE"];
        $this->SUFFER_TYPE->AdvancedSearch->SearchOperator2 = @$filter["w_SUFFER_TYPE"];
        $this->SUFFER_TYPE->AdvancedSearch->save();

        // Field INFECTED_BODY
        $this->INFECTED_BODY->AdvancedSearch->SearchValue = @$filter["x_INFECTED_BODY"];
        $this->INFECTED_BODY->AdvancedSearch->SearchOperator = @$filter["z_INFECTED_BODY"];
        $this->INFECTED_BODY->AdvancedSearch->SearchCondition = @$filter["v_INFECTED_BODY"];
        $this->INFECTED_BODY->AdvancedSearch->SearchValue2 = @$filter["y_INFECTED_BODY"];
        $this->INFECTED_BODY->AdvancedSearch->SearchOperator2 = @$filter["w_INFECTED_BODY"];
        $this->INFECTED_BODY->AdvancedSearch->save();

        // Field EMPLOYEE_ID
        $this->EMPLOYEE_ID->AdvancedSearch->SearchValue = @$filter["x_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchOperator = @$filter["z_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchCondition = @$filter["v_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchValue2 = @$filter["y_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->SearchOperator2 = @$filter["w_EMPLOYEE_ID"];
        $this->EMPLOYEE_ID->AdvancedSearch->save();

        // Field RISK_LEVEL
        $this->RISK_LEVEL->AdvancedSearch->SearchValue = @$filter["x_RISK_LEVEL"];
        $this->RISK_LEVEL->AdvancedSearch->SearchOperator = @$filter["z_RISK_LEVEL"];
        $this->RISK_LEVEL->AdvancedSearch->SearchCondition = @$filter["v_RISK_LEVEL"];
        $this->RISK_LEVEL->AdvancedSearch->SearchValue2 = @$filter["y_RISK_LEVEL"];
        $this->RISK_LEVEL->AdvancedSearch->SearchOperator2 = @$filter["w_RISK_LEVEL"];
        $this->RISK_LEVEL->AdvancedSearch->save();

        // Field MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->SearchValue = @$filter["x_MORFOLOGI_NEOPLASMA"];
        $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->SearchOperator = @$filter["z_MORFOLOGI_NEOPLASMA"];
        $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->SearchCondition = @$filter["v_MORFOLOGI_NEOPLASMA"];
        $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->SearchValue2 = @$filter["y_MORFOLOGI_NEOPLASMA"];
        $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->SearchOperator2 = @$filter["w_MORFOLOGI_NEOPLASMA"];
        $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->save();

        // Field HURT
        $this->HURT->AdvancedSearch->SearchValue = @$filter["x_HURT"];
        $this->HURT->AdvancedSearch->SearchOperator = @$filter["z_HURT"];
        $this->HURT->AdvancedSearch->SearchCondition = @$filter["v_HURT"];
        $this->HURT->AdvancedSearch->SearchValue2 = @$filter["y_HURT"];
        $this->HURT->AdvancedSearch->SearchOperator2 = @$filter["w_HURT"];
        $this->HURT->AdvancedSearch->save();

        // Field HURT_TYPE
        $this->HURT_TYPE->AdvancedSearch->SearchValue = @$filter["x_HURT_TYPE"];
        $this->HURT_TYPE->AdvancedSearch->SearchOperator = @$filter["z_HURT_TYPE"];
        $this->HURT_TYPE->AdvancedSearch->SearchCondition = @$filter["v_HURT_TYPE"];
        $this->HURT_TYPE->AdvancedSearch->SearchValue2 = @$filter["y_HURT_TYPE"];
        $this->HURT_TYPE->AdvancedSearch->SearchOperator2 = @$filter["w_HURT_TYPE"];
        $this->HURT_TYPE->AdvancedSearch->save();

        // Field DIAG_CAT
        $this->DIAG_CAT->AdvancedSearch->SearchValue = @$filter["x_DIAG_CAT"];
        $this->DIAG_CAT->AdvancedSearch->SearchOperator = @$filter["z_DIAG_CAT"];
        $this->DIAG_CAT->AdvancedSearch->SearchCondition = @$filter["v_DIAG_CAT"];
        $this->DIAG_CAT->AdvancedSearch->SearchValue2 = @$filter["y_DIAG_CAT"];
        $this->DIAG_CAT->AdvancedSearch->SearchOperator2 = @$filter["w_DIAG_CAT"];
        $this->DIAG_CAT->AdvancedSearch->save();

        // Field ADDICTION_MATERIAL
        $this->ADDICTION_MATERIAL->AdvancedSearch->SearchValue = @$filter["x_ADDICTION_MATERIAL"];
        $this->ADDICTION_MATERIAL->AdvancedSearch->SearchOperator = @$filter["z_ADDICTION_MATERIAL"];
        $this->ADDICTION_MATERIAL->AdvancedSearch->SearchCondition = @$filter["v_ADDICTION_MATERIAL"];
        $this->ADDICTION_MATERIAL->AdvancedSearch->SearchValue2 = @$filter["y_ADDICTION_MATERIAL"];
        $this->ADDICTION_MATERIAL->AdvancedSearch->SearchOperator2 = @$filter["w_ADDICTION_MATERIAL"];
        $this->ADDICTION_MATERIAL->AdvancedSearch->save();

        // Field INFECTED_QUANTITY
        $this->INFECTED_QUANTITY->AdvancedSearch->SearchValue = @$filter["x_INFECTED_QUANTITY"];
        $this->INFECTED_QUANTITY->AdvancedSearch->SearchOperator = @$filter["z_INFECTED_QUANTITY"];
        $this->INFECTED_QUANTITY->AdvancedSearch->SearchCondition = @$filter["v_INFECTED_QUANTITY"];
        $this->INFECTED_QUANTITY->AdvancedSearch->SearchValue2 = @$filter["y_INFECTED_QUANTITY"];
        $this->INFECTED_QUANTITY->AdvancedSearch->SearchOperator2 = @$filter["w_INFECTED_QUANTITY"];
        $this->INFECTED_QUANTITY->AdvancedSearch->save();

        // Field CONTAGIOUS_TYPE
        $this->CONTAGIOUS_TYPE->AdvancedSearch->SearchValue = @$filter["x_CONTAGIOUS_TYPE"];
        $this->CONTAGIOUS_TYPE->AdvancedSearch->SearchOperator = @$filter["z_CONTAGIOUS_TYPE"];
        $this->CONTAGIOUS_TYPE->AdvancedSearch->SearchCondition = @$filter["v_CONTAGIOUS_TYPE"];
        $this->CONTAGIOUS_TYPE->AdvancedSearch->SearchValue2 = @$filter["y_CONTAGIOUS_TYPE"];
        $this->CONTAGIOUS_TYPE->AdvancedSearch->SearchOperator2 = @$filter["w_CONTAGIOUS_TYPE"];
        $this->CONTAGIOUS_TYPE->AdvancedSearch->save();

        // Field CURATIF_ID
        $this->CURATIF_ID->AdvancedSearch->SearchValue = @$filter["x_CURATIF_ID"];
        $this->CURATIF_ID->AdvancedSearch->SearchOperator = @$filter["z_CURATIF_ID"];
        $this->CURATIF_ID->AdvancedSearch->SearchCondition = @$filter["v_CURATIF_ID"];
        $this->CURATIF_ID->AdvancedSearch->SearchValue2 = @$filter["y_CURATIF_ID"];
        $this->CURATIF_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CURATIF_ID"];
        $this->CURATIF_ID->AdvancedSearch->save();

        // Field RESULT_ID
        $this->RESULT_ID->AdvancedSearch->SearchValue = @$filter["x_RESULT_ID"];
        $this->RESULT_ID->AdvancedSearch->SearchOperator = @$filter["z_RESULT_ID"];
        $this->RESULT_ID->AdvancedSearch->SearchCondition = @$filter["v_RESULT_ID"];
        $this->RESULT_ID->AdvancedSearch->SearchValue2 = @$filter["y_RESULT_ID"];
        $this->RESULT_ID->AdvancedSearch->SearchOperator2 = @$filter["w_RESULT_ID"];
        $this->RESULT_ID->AdvancedSearch->save();

        // Field INFECTION_TYPE
        $this->INFECTION_TYPE->AdvancedSearch->SearchValue = @$filter["x_INFECTION_TYPE"];
        $this->INFECTION_TYPE->AdvancedSearch->SearchOperator = @$filter["z_INFECTION_TYPE"];
        $this->INFECTION_TYPE->AdvancedSearch->SearchCondition = @$filter["v_INFECTION_TYPE"];
        $this->INFECTION_TYPE->AdvancedSearch->SearchValue2 = @$filter["y_INFECTION_TYPE"];
        $this->INFECTION_TYPE->AdvancedSearch->SearchOperator2 = @$filter["w_INFECTION_TYPE"];
        $this->INFECTION_TYPE->AdvancedSearch->save();

        // Field INVESTIGATION_ID
        $this->INVESTIGATION_ID->AdvancedSearch->SearchValue = @$filter["x_INVESTIGATION_ID"];
        $this->INVESTIGATION_ID->AdvancedSearch->SearchOperator = @$filter["z_INVESTIGATION_ID"];
        $this->INVESTIGATION_ID->AdvancedSearch->SearchCondition = @$filter["v_INVESTIGATION_ID"];
        $this->INVESTIGATION_ID->AdvancedSearch->SearchValue2 = @$filter["y_INVESTIGATION_ID"];
        $this->INVESTIGATION_ID->AdvancedSearch->SearchOperator2 = @$filter["w_INVESTIGATION_ID"];
        $this->INVESTIGATION_ID->AdvancedSearch->save();

        // Field DISABILITY
        $this->DISABILITY->AdvancedSearch->SearchValue = @$filter["x_DISABILITY"];
        $this->DISABILITY->AdvancedSearch->SearchOperator = @$filter["z_DISABILITY"];
        $this->DISABILITY->AdvancedSearch->SearchCondition = @$filter["v_DISABILITY"];
        $this->DISABILITY->AdvancedSearch->SearchValue2 = @$filter["y_DISABILITY"];
        $this->DISABILITY->AdvancedSearch->SearchOperator2 = @$filter["w_DISABILITY"];
        $this->DISABILITY->AdvancedSearch->save();

        // Field DESCRIPTION
        $this->DESCRIPTION->AdvancedSearch->SearchValue = @$filter["x_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchOperator = @$filter["z_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchCondition = @$filter["v_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchValue2 = @$filter["y_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->SearchOperator2 = @$filter["w_DESCRIPTION"];
        $this->DESCRIPTION->AdvancedSearch->save();

        // Field KOMPLIKASI
        $this->KOMPLIKASI->AdvancedSearch->SearchValue = @$filter["x_KOMPLIKASI"];
        $this->KOMPLIKASI->AdvancedSearch->SearchOperator = @$filter["z_KOMPLIKASI"];
        $this->KOMPLIKASI->AdvancedSearch->SearchCondition = @$filter["v_KOMPLIKASI"];
        $this->KOMPLIKASI->AdvancedSearch->SearchValue2 = @$filter["y_KOMPLIKASI"];
        $this->KOMPLIKASI->AdvancedSearch->SearchOperator2 = @$filter["w_KOMPLIKASI"];
        $this->KOMPLIKASI->AdvancedSearch->save();

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

        // Field STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue = @$filter["x_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchOperator = @$filter["z_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchCondition = @$filter["v_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue2 = @$filter["y_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->SearchOperator2 = @$filter["w_STATUS_PASIEN_ID"];
        $this->STATUS_PASIEN_ID->AdvancedSearch->save();

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

        // Field THEADDRESS
        $this->THEADDRESS->AdvancedSearch->SearchValue = @$filter["x_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->SearchOperator = @$filter["z_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->SearchCondition = @$filter["v_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->SearchValue2 = @$filter["y_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->SearchOperator2 = @$filter["w_THEADDRESS"];
        $this->THEADDRESS->AdvancedSearch->save();

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

        // Field GENDER
        $this->GENDER->AdvancedSearch->SearchValue = @$filter["x_GENDER"];
        $this->GENDER->AdvancedSearch->SearchOperator = @$filter["z_GENDER"];
        $this->GENDER->AdvancedSearch->SearchCondition = @$filter["v_GENDER"];
        $this->GENDER->AdvancedSearch->SearchValue2 = @$filter["y_GENDER"];
        $this->GENDER->AdvancedSearch->SearchOperator2 = @$filter["w_GENDER"];
        $this->GENDER->AdvancedSearch->save();

        // Field DOCTOR
        $this->DOCTOR->AdvancedSearch->SearchValue = @$filter["x_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->SearchOperator = @$filter["z_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->SearchCondition = @$filter["v_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->SearchValue2 = @$filter["y_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->SearchOperator2 = @$filter["w_DOCTOR"];
        $this->DOCTOR->AdvancedSearch->save();

        // Field KAL_ID
        $this->KAL_ID->AdvancedSearch->SearchValue = @$filter["x_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchOperator = @$filter["z_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchCondition = @$filter["v_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchValue2 = @$filter["y_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->SearchOperator2 = @$filter["w_KAL_ID"];
        $this->KAL_ID->AdvancedSearch->save();

        // Field ACCOUNT_ID
        $this->ACCOUNT_ID->AdvancedSearch->SearchValue = @$filter["x_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchOperator = @$filter["z_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchCondition = @$filter["v_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchValue2 = @$filter["y_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->SearchOperator2 = @$filter["w_ACCOUNT_ID"];
        $this->ACCOUNT_ID->AdvancedSearch->save();

        // Field DIAGNOSA_ID_02
        $this->DIAGNOSA_ID_02->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_02"];
        $this->DIAGNOSA_ID_02->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_02"];
        $this->DIAGNOSA_ID_02->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_02"];
        $this->DIAGNOSA_ID_02->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_02"];
        $this->DIAGNOSA_ID_02->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_02"];
        $this->DIAGNOSA_ID_02->AdvancedSearch->save();

        // Field DIAGNOSA_ID_03
        $this->DIAGNOSA_ID_03->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_03"];
        $this->DIAGNOSA_ID_03->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_03"];
        $this->DIAGNOSA_ID_03->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_03"];
        $this->DIAGNOSA_ID_03->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_03"];
        $this->DIAGNOSA_ID_03->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_03"];
        $this->DIAGNOSA_ID_03->AdvancedSearch->save();

        // Field DIAGNOSA_ID_04
        $this->DIAGNOSA_ID_04->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_04"];
        $this->DIAGNOSA_ID_04->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_04"];
        $this->DIAGNOSA_ID_04->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_04"];
        $this->DIAGNOSA_ID_04->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_04"];
        $this->DIAGNOSA_ID_04->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_04"];
        $this->DIAGNOSA_ID_04->AdvancedSearch->save();

        // Field DIAGNOSA_ID_05
        $this->DIAGNOSA_ID_05->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_05"];
        $this->DIAGNOSA_ID_05->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_05"];
        $this->DIAGNOSA_ID_05->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_05"];
        $this->DIAGNOSA_ID_05->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_05"];
        $this->DIAGNOSA_ID_05->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_05"];
        $this->DIAGNOSA_ID_05->AdvancedSearch->save();

        // Field DIAGNOSA_ID_06
        $this->DIAGNOSA_ID_06->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_06"];
        $this->DIAGNOSA_ID_06->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_06"];
        $this->DIAGNOSA_ID_06->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_06"];
        $this->DIAGNOSA_ID_06->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_06"];
        $this->DIAGNOSA_ID_06->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_06"];
        $this->DIAGNOSA_ID_06->AdvancedSearch->save();

        // Field DIAGNOSA_ID_07
        $this->DIAGNOSA_ID_07->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_07"];
        $this->DIAGNOSA_ID_07->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_07"];
        $this->DIAGNOSA_ID_07->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_07"];
        $this->DIAGNOSA_ID_07->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_07"];
        $this->DIAGNOSA_ID_07->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_07"];
        $this->DIAGNOSA_ID_07->AdvancedSearch->save();

        // Field DIAGNOSA_ID_08
        $this->DIAGNOSA_ID_08->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_08"];
        $this->DIAGNOSA_ID_08->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_08"];
        $this->DIAGNOSA_ID_08->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_08"];
        $this->DIAGNOSA_ID_08->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_08"];
        $this->DIAGNOSA_ID_08->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_08"];
        $this->DIAGNOSA_ID_08->AdvancedSearch->save();

        // Field DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_09"];
        $this->DIAGNOSA_ID_09->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_09"];
        $this->DIAGNOSA_ID_09->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_09"];
        $this->DIAGNOSA_ID_09->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_09"];
        $this->DIAGNOSA_ID_09->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_09"];
        $this->DIAGNOSA_ID_09->AdvancedSearch->save();

        // Field DIAGNOSA_ID_10
        $this->DIAGNOSA_ID_10->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID_10"];
        $this->DIAGNOSA_ID_10->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID_10"];
        $this->DIAGNOSA_ID_10->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID_10"];
        $this->DIAGNOSA_ID_10->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID_10"];
        $this->DIAGNOSA_ID_10->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID_10"];
        $this->DIAGNOSA_ID_10->AdvancedSearch->save();

        // Field PROCEDURE_01
        $this->PROCEDURE_01->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_01"];
        $this->PROCEDURE_01->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_01"];
        $this->PROCEDURE_01->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_01"];
        $this->PROCEDURE_01->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_01"];
        $this->PROCEDURE_01->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_01"];
        $this->PROCEDURE_01->AdvancedSearch->save();

        // Field PROCEDURE_02
        $this->PROCEDURE_02->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_02"];
        $this->PROCEDURE_02->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_02"];
        $this->PROCEDURE_02->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_02"];
        $this->PROCEDURE_02->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_02"];
        $this->PROCEDURE_02->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_02"];
        $this->PROCEDURE_02->AdvancedSearch->save();

        // Field PROCEDURE_03
        $this->PROCEDURE_03->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_03"];
        $this->PROCEDURE_03->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_03"];
        $this->PROCEDURE_03->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_03"];
        $this->PROCEDURE_03->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_03"];
        $this->PROCEDURE_03->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_03"];
        $this->PROCEDURE_03->AdvancedSearch->save();

        // Field PROCEDURE_04
        $this->PROCEDURE_04->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_04"];
        $this->PROCEDURE_04->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_04"];
        $this->PROCEDURE_04->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_04"];
        $this->PROCEDURE_04->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_04"];
        $this->PROCEDURE_04->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_04"];
        $this->PROCEDURE_04->AdvancedSearch->save();

        // Field PROCEDURE_05
        $this->PROCEDURE_05->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_05"];
        $this->PROCEDURE_05->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_05"];
        $this->PROCEDURE_05->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_05"];
        $this->PROCEDURE_05->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_05"];
        $this->PROCEDURE_05->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_05"];
        $this->PROCEDURE_05->AdvancedSearch->save();

        // Field PROCEDURE_06
        $this->PROCEDURE_06->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_06"];
        $this->PROCEDURE_06->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_06"];
        $this->PROCEDURE_06->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_06"];
        $this->PROCEDURE_06->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_06"];
        $this->PROCEDURE_06->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_06"];
        $this->PROCEDURE_06->AdvancedSearch->save();

        // Field PROCEDURE_07
        $this->PROCEDURE_07->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_07"];
        $this->PROCEDURE_07->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_07"];
        $this->PROCEDURE_07->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_07"];
        $this->PROCEDURE_07->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_07"];
        $this->PROCEDURE_07->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_07"];
        $this->PROCEDURE_07->AdvancedSearch->save();

        // Field PROCEDURE_08
        $this->PROCEDURE_08->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_08"];
        $this->PROCEDURE_08->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_08"];
        $this->PROCEDURE_08->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_08"];
        $this->PROCEDURE_08->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_08"];
        $this->PROCEDURE_08->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_08"];
        $this->PROCEDURE_08->AdvancedSearch->save();

        // Field PROCEDURE_09
        $this->PROCEDURE_09->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_09"];
        $this->PROCEDURE_09->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_09"];
        $this->PROCEDURE_09->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_09"];
        $this->PROCEDURE_09->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_09"];
        $this->PROCEDURE_09->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_09"];
        $this->PROCEDURE_09->AdvancedSearch->save();

        // Field PROCEDURE_10
        $this->PROCEDURE_10->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_10"];
        $this->PROCEDURE_10->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_10"];
        $this->PROCEDURE_10->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_10"];
        $this->PROCEDURE_10->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_10"];
        $this->PROCEDURE_10->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_10"];
        $this->PROCEDURE_10->AdvancedSearch->save();

        // Field DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_ID2"];
        $this->DIAGNOSA_ID2->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_ID2"];
        $this->DIAGNOSA_ID2->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_ID2"];
        $this->DIAGNOSA_ID2->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_ID2"];
        $this->DIAGNOSA_ID2->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_ID2"];
        $this->DIAGNOSA_ID2->AdvancedSearch->save();

        // Field WEIGHT
        $this->WEIGHT->AdvancedSearch->SearchValue = @$filter["x_WEIGHT"];
        $this->WEIGHT->AdvancedSearch->SearchOperator = @$filter["z_WEIGHT"];
        $this->WEIGHT->AdvancedSearch->SearchCondition = @$filter["v_WEIGHT"];
        $this->WEIGHT->AdvancedSearch->SearchValue2 = @$filter["y_WEIGHT"];
        $this->WEIGHT->AdvancedSearch->SearchOperator2 = @$filter["w_WEIGHT"];
        $this->WEIGHT->AdvancedSearch->save();

        // Field NOKARTU
        $this->NOKARTU->AdvancedSearch->SearchValue = @$filter["x_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->SearchOperator = @$filter["z_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->SearchCondition = @$filter["v_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->SearchValue2 = @$filter["y_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->SearchOperator2 = @$filter["w_NOKARTU"];
        $this->NOKARTU->AdvancedSearch->save();

        // Field NOSEP
        $this->NOSEP->AdvancedSearch->SearchValue = @$filter["x_NOSEP"];
        $this->NOSEP->AdvancedSearch->SearchOperator = @$filter["z_NOSEP"];
        $this->NOSEP->AdvancedSearch->SearchCondition = @$filter["v_NOSEP"];
        $this->NOSEP->AdvancedSearch->SearchValue2 = @$filter["y_NOSEP"];
        $this->NOSEP->AdvancedSearch->SearchOperator2 = @$filter["w_NOSEP"];
        $this->NOSEP->AdvancedSearch->save();

        // Field TGLSEP
        $this->TGLSEP->AdvancedSearch->SearchValue = @$filter["x_TGLSEP"];
        $this->TGLSEP->AdvancedSearch->SearchOperator = @$filter["z_TGLSEP"];
        $this->TGLSEP->AdvancedSearch->SearchCondition = @$filter["v_TGLSEP"];
        $this->TGLSEP->AdvancedSearch->SearchValue2 = @$filter["y_TGLSEP"];
        $this->TGLSEP->AdvancedSearch->SearchOperator2 = @$filter["w_TGLSEP"];
        $this->TGLSEP->AdvancedSearch->save();

        // Field RENCANATL
        $this->RENCANATL->AdvancedSearch->SearchValue = @$filter["x_RENCANATL"];
        $this->RENCANATL->AdvancedSearch->SearchOperator = @$filter["z_RENCANATL"];
        $this->RENCANATL->AdvancedSearch->SearchCondition = @$filter["v_RENCANATL"];
        $this->RENCANATL->AdvancedSearch->SearchValue2 = @$filter["y_RENCANATL"];
        $this->RENCANATL->AdvancedSearch->SearchOperator2 = @$filter["w_RENCANATL"];
        $this->RENCANATL->AdvancedSearch->save();

        // Field DIRUJUKKE
        $this->DIRUJUKKE->AdvancedSearch->SearchValue = @$filter["x_DIRUJUKKE"];
        $this->DIRUJUKKE->AdvancedSearch->SearchOperator = @$filter["z_DIRUJUKKE"];
        $this->DIRUJUKKE->AdvancedSearch->SearchCondition = @$filter["v_DIRUJUKKE"];
        $this->DIRUJUKKE->AdvancedSearch->SearchValue2 = @$filter["y_DIRUJUKKE"];
        $this->DIRUJUKKE->AdvancedSearch->SearchOperator2 = @$filter["w_DIRUJUKKE"];
        $this->DIRUJUKKE->AdvancedSearch->save();

        // Field TGLKONTROL
        $this->TGLKONTROL->AdvancedSearch->SearchValue = @$filter["x_TGLKONTROL"];
        $this->TGLKONTROL->AdvancedSearch->SearchOperator = @$filter["z_TGLKONTROL"];
        $this->TGLKONTROL->AdvancedSearch->SearchCondition = @$filter["v_TGLKONTROL"];
        $this->TGLKONTROL->AdvancedSearch->SearchValue2 = @$filter["y_TGLKONTROL"];
        $this->TGLKONTROL->AdvancedSearch->SearchOperator2 = @$filter["w_TGLKONTROL"];
        $this->TGLKONTROL->AdvancedSearch->save();

        // Field KDPOLI_KONTROL
        $this->KDPOLI_KONTROL->AdvancedSearch->SearchValue = @$filter["x_KDPOLI_KONTROL"];
        $this->KDPOLI_KONTROL->AdvancedSearch->SearchOperator = @$filter["z_KDPOLI_KONTROL"];
        $this->KDPOLI_KONTROL->AdvancedSearch->SearchCondition = @$filter["v_KDPOLI_KONTROL"];
        $this->KDPOLI_KONTROL->AdvancedSearch->SearchValue2 = @$filter["y_KDPOLI_KONTROL"];
        $this->KDPOLI_KONTROL->AdvancedSearch->SearchOperator2 = @$filter["w_KDPOLI_KONTROL"];
        $this->KDPOLI_KONTROL->AdvancedSearch->save();

        // Field JAMINAN
        $this->JAMINAN->AdvancedSearch->SearchValue = @$filter["x_JAMINAN"];
        $this->JAMINAN->AdvancedSearch->SearchOperator = @$filter["z_JAMINAN"];
        $this->JAMINAN->AdvancedSearch->SearchCondition = @$filter["v_JAMINAN"];
        $this->JAMINAN->AdvancedSearch->SearchValue2 = @$filter["y_JAMINAN"];
        $this->JAMINAN->AdvancedSearch->SearchOperator2 = @$filter["w_JAMINAN"];
        $this->JAMINAN->AdvancedSearch->save();

        // Field SPESIALISTIK
        $this->SPESIALISTIK->AdvancedSearch->SearchValue = @$filter["x_SPESIALISTIK"];
        $this->SPESIALISTIK->AdvancedSearch->SearchOperator = @$filter["z_SPESIALISTIK"];
        $this->SPESIALISTIK->AdvancedSearch->SearchCondition = @$filter["v_SPESIALISTIK"];
        $this->SPESIALISTIK->AdvancedSearch->SearchValue2 = @$filter["y_SPESIALISTIK"];
        $this->SPESIALISTIK->AdvancedSearch->SearchOperator2 = @$filter["w_SPESIALISTIK"];
        $this->SPESIALISTIK->AdvancedSearch->save();

        // Field PEMERIKSAAN_02
        $this->PEMERIKSAAN_02->AdvancedSearch->SearchValue = @$filter["x_PEMERIKSAAN_02"];
        $this->PEMERIKSAAN_02->AdvancedSearch->SearchOperator = @$filter["z_PEMERIKSAAN_02"];
        $this->PEMERIKSAAN_02->AdvancedSearch->SearchCondition = @$filter["v_PEMERIKSAAN_02"];
        $this->PEMERIKSAAN_02->AdvancedSearch->SearchValue2 = @$filter["y_PEMERIKSAAN_02"];
        $this->PEMERIKSAAN_02->AdvancedSearch->SearchOperator2 = @$filter["w_PEMERIKSAAN_02"];
        $this->PEMERIKSAAN_02->AdvancedSearch->save();

        // Field DIAGNOSA_DESC_02
        $this->DIAGNOSA_DESC_02->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_DESC_02"];
        $this->DIAGNOSA_DESC_02->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_DESC_02"];
        $this->DIAGNOSA_DESC_02->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_DESC_02"];
        $this->DIAGNOSA_DESC_02->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_DESC_02"];
        $this->DIAGNOSA_DESC_02->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_DESC_02"];
        $this->DIAGNOSA_DESC_02->AdvancedSearch->save();

        // Field DIAGNOSA_DESC_03
        $this->DIAGNOSA_DESC_03->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_DESC_03"];
        $this->DIAGNOSA_DESC_03->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_DESC_03"];
        $this->DIAGNOSA_DESC_03->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_DESC_03"];
        $this->DIAGNOSA_DESC_03->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_DESC_03"];
        $this->DIAGNOSA_DESC_03->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_DESC_03"];
        $this->DIAGNOSA_DESC_03->AdvancedSearch->save();

        // Field DIAGNOSA_DESC_04
        $this->DIAGNOSA_DESC_04->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_DESC_04"];
        $this->DIAGNOSA_DESC_04->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_DESC_04"];
        $this->DIAGNOSA_DESC_04->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_DESC_04"];
        $this->DIAGNOSA_DESC_04->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_DESC_04"];
        $this->DIAGNOSA_DESC_04->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_DESC_04"];
        $this->DIAGNOSA_DESC_04->AdvancedSearch->save();

        // Field DIAGNOSA_DESC_05
        $this->DIAGNOSA_DESC_05->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_DESC_05"];
        $this->DIAGNOSA_DESC_05->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_DESC_05"];
        $this->DIAGNOSA_DESC_05->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_DESC_05"];
        $this->DIAGNOSA_DESC_05->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_DESC_05"];
        $this->DIAGNOSA_DESC_05->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_DESC_05"];
        $this->DIAGNOSA_DESC_05->AdvancedSearch->save();

        // Field DIAGNOSA_DESC_06
        $this->DIAGNOSA_DESC_06->AdvancedSearch->SearchValue = @$filter["x_DIAGNOSA_DESC_06"];
        $this->DIAGNOSA_DESC_06->AdvancedSearch->SearchOperator = @$filter["z_DIAGNOSA_DESC_06"];
        $this->DIAGNOSA_DESC_06->AdvancedSearch->SearchCondition = @$filter["v_DIAGNOSA_DESC_06"];
        $this->DIAGNOSA_DESC_06->AdvancedSearch->SearchValue2 = @$filter["y_DIAGNOSA_DESC_06"];
        $this->DIAGNOSA_DESC_06->AdvancedSearch->SearchOperator2 = @$filter["w_DIAGNOSA_DESC_06"];
        $this->DIAGNOSA_DESC_06->AdvancedSearch->save();

        // Field PROCEDURE_DESC_01
        $this->PROCEDURE_DESC_01->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_DESC_01"];
        $this->PROCEDURE_DESC_01->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_DESC_01"];
        $this->PROCEDURE_DESC_01->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_DESC_01"];
        $this->PROCEDURE_DESC_01->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_DESC_01"];
        $this->PROCEDURE_DESC_01->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_DESC_01"];
        $this->PROCEDURE_DESC_01->AdvancedSearch->save();

        // Field PROCEDURE_DESC_02
        $this->PROCEDURE_DESC_02->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_DESC_02"];
        $this->PROCEDURE_DESC_02->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_DESC_02"];
        $this->PROCEDURE_DESC_02->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_DESC_02"];
        $this->PROCEDURE_DESC_02->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_DESC_02"];
        $this->PROCEDURE_DESC_02->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_DESC_02"];
        $this->PROCEDURE_DESC_02->AdvancedSearch->save();

        // Field PROCEDURE_DESC_03
        $this->PROCEDURE_DESC_03->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_DESC_03"];
        $this->PROCEDURE_DESC_03->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_DESC_03"];
        $this->PROCEDURE_DESC_03->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_DESC_03"];
        $this->PROCEDURE_DESC_03->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_DESC_03"];
        $this->PROCEDURE_DESC_03->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_DESC_03"];
        $this->PROCEDURE_DESC_03->AdvancedSearch->save();

        // Field PROCEDURE_DESC_04
        $this->PROCEDURE_DESC_04->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_DESC_04"];
        $this->PROCEDURE_DESC_04->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_DESC_04"];
        $this->PROCEDURE_DESC_04->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_DESC_04"];
        $this->PROCEDURE_DESC_04->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_DESC_04"];
        $this->PROCEDURE_DESC_04->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_DESC_04"];
        $this->PROCEDURE_DESC_04->AdvancedSearch->save();

        // Field PROCEDURE_DESC_05
        $this->PROCEDURE_DESC_05->AdvancedSearch->SearchValue = @$filter["x_PROCEDURE_DESC_05"];
        $this->PROCEDURE_DESC_05->AdvancedSearch->SearchOperator = @$filter["z_PROCEDURE_DESC_05"];
        $this->PROCEDURE_DESC_05->AdvancedSearch->SearchCondition = @$filter["v_PROCEDURE_DESC_05"];
        $this->PROCEDURE_DESC_05->AdvancedSearch->SearchValue2 = @$filter["y_PROCEDURE_DESC_05"];
        $this->PROCEDURE_DESC_05->AdvancedSearch->SearchOperator2 = @$filter["w_PROCEDURE_DESC_05"];
        $this->PROCEDURE_DESC_05->AdvancedSearch->save();

        // Field RESPONPOST
        $this->RESPONPOST->AdvancedSearch->SearchValue = @$filter["x_RESPONPOST"];
        $this->RESPONPOST->AdvancedSearch->SearchOperator = @$filter["z_RESPONPOST"];
        $this->RESPONPOST->AdvancedSearch->SearchCondition = @$filter["v_RESPONPOST"];
        $this->RESPONPOST->AdvancedSearch->SearchValue2 = @$filter["y_RESPONPOST"];
        $this->RESPONPOST->AdvancedSearch->SearchOperator2 = @$filter["w_RESPONPOST"];
        $this->RESPONPOST->AdvancedSearch->save();

        // Field RESPONPUT
        $this->RESPONPUT->AdvancedSearch->SearchValue = @$filter["x_RESPONPUT"];
        $this->RESPONPUT->AdvancedSearch->SearchOperator = @$filter["z_RESPONPUT"];
        $this->RESPONPUT->AdvancedSearch->SearchCondition = @$filter["v_RESPONPUT"];
        $this->RESPONPUT->AdvancedSearch->SearchValue2 = @$filter["y_RESPONPUT"];
        $this->RESPONPUT->AdvancedSearch->SearchOperator2 = @$filter["w_RESPONPUT"];
        $this->RESPONPUT->AdvancedSearch->save();

        // Field RESPONDEL
        $this->RESPONDEL->AdvancedSearch->SearchValue = @$filter["x_RESPONDEL"];
        $this->RESPONDEL->AdvancedSearch->SearchOperator = @$filter["z_RESPONDEL"];
        $this->RESPONDEL->AdvancedSearch->SearchCondition = @$filter["v_RESPONDEL"];
        $this->RESPONDEL->AdvancedSearch->SearchValue2 = @$filter["y_RESPONDEL"];
        $this->RESPONDEL->AdvancedSearch->SearchOperator2 = @$filter["w_RESPONDEL"];
        $this->RESPONDEL->AdvancedSearch->save();

        // Field JSONPOST
        $this->JSONPOST->AdvancedSearch->SearchValue = @$filter["x_JSONPOST"];
        $this->JSONPOST->AdvancedSearch->SearchOperator = @$filter["z_JSONPOST"];
        $this->JSONPOST->AdvancedSearch->SearchCondition = @$filter["v_JSONPOST"];
        $this->JSONPOST->AdvancedSearch->SearchValue2 = @$filter["y_JSONPOST"];
        $this->JSONPOST->AdvancedSearch->SearchOperator2 = @$filter["w_JSONPOST"];
        $this->JSONPOST->AdvancedSearch->save();

        // Field JSONPUT
        $this->JSONPUT->AdvancedSearch->SearchValue = @$filter["x_JSONPUT"];
        $this->JSONPUT->AdvancedSearch->SearchOperator = @$filter["z_JSONPUT"];
        $this->JSONPUT->AdvancedSearch->SearchCondition = @$filter["v_JSONPUT"];
        $this->JSONPUT->AdvancedSearch->SearchValue2 = @$filter["y_JSONPUT"];
        $this->JSONPUT->AdvancedSearch->SearchOperator2 = @$filter["w_JSONPUT"];
        $this->JSONPUT->AdvancedSearch->save();

        // Field JSONDEL
        $this->JSONDEL->AdvancedSearch->SearchValue = @$filter["x_JSONDEL"];
        $this->JSONDEL->AdvancedSearch->SearchOperator = @$filter["z_JSONDEL"];
        $this->JSONDEL->AdvancedSearch->SearchCondition = @$filter["v_JSONDEL"];
        $this->JSONDEL->AdvancedSearch->SearchValue2 = @$filter["y_JSONDEL"];
        $this->JSONDEL->AdvancedSearch->SearchOperator2 = @$filter["w_JSONDEL"];
        $this->JSONDEL->AdvancedSearch->save();

        // Field height
        $this->height->AdvancedSearch->SearchValue = @$filter["x_height"];
        $this->height->AdvancedSearch->SearchOperator = @$filter["z_height"];
        $this->height->AdvancedSearch->SearchCondition = @$filter["v_height"];
        $this->height->AdvancedSearch->SearchValue2 = @$filter["y_height"];
        $this->height->AdvancedSearch->SearchOperator2 = @$filter["w_height"];
        $this->height->AdvancedSearch->save();

        // Field TEMPERATURE
        $this->TEMPERATURE->AdvancedSearch->SearchValue = @$filter["x_TEMPERATURE"];
        $this->TEMPERATURE->AdvancedSearch->SearchOperator = @$filter["z_TEMPERATURE"];
        $this->TEMPERATURE->AdvancedSearch->SearchCondition = @$filter["v_TEMPERATURE"];
        $this->TEMPERATURE->AdvancedSearch->SearchValue2 = @$filter["y_TEMPERATURE"];
        $this->TEMPERATURE->AdvancedSearch->SearchOperator2 = @$filter["w_TEMPERATURE"];
        $this->TEMPERATURE->AdvancedSearch->save();

        // Field TENSION_UPPER
        $this->TENSION_UPPER->AdvancedSearch->SearchValue = @$filter["x_TENSION_UPPER"];
        $this->TENSION_UPPER->AdvancedSearch->SearchOperator = @$filter["z_TENSION_UPPER"];
        $this->TENSION_UPPER->AdvancedSearch->SearchCondition = @$filter["v_TENSION_UPPER"];
        $this->TENSION_UPPER->AdvancedSearch->SearchValue2 = @$filter["y_TENSION_UPPER"];
        $this->TENSION_UPPER->AdvancedSearch->SearchOperator2 = @$filter["w_TENSION_UPPER"];
        $this->TENSION_UPPER->AdvancedSearch->save();

        // Field TENSION_BELOW
        $this->TENSION_BELOW->AdvancedSearch->SearchValue = @$filter["x_TENSION_BELOW"];
        $this->TENSION_BELOW->AdvancedSearch->SearchOperator = @$filter["z_TENSION_BELOW"];
        $this->TENSION_BELOW->AdvancedSearch->SearchCondition = @$filter["v_TENSION_BELOW"];
        $this->TENSION_BELOW->AdvancedSearch->SearchValue2 = @$filter["y_TENSION_BELOW"];
        $this->TENSION_BELOW->AdvancedSearch->SearchOperator2 = @$filter["w_TENSION_BELOW"];
        $this->TENSION_BELOW->AdvancedSearch->save();

        // Field NADI
        $this->NADI->AdvancedSearch->SearchValue = @$filter["x_NADI"];
        $this->NADI->AdvancedSearch->SearchOperator = @$filter["z_NADI"];
        $this->NADI->AdvancedSearch->SearchCondition = @$filter["v_NADI"];
        $this->NADI->AdvancedSearch->SearchValue2 = @$filter["y_NADI"];
        $this->NADI->AdvancedSearch->SearchOperator2 = @$filter["w_NADI"];
        $this->NADI->AdvancedSearch->save();

        // Field NAFAS
        $this->NAFAS->AdvancedSearch->SearchValue = @$filter["x_NAFAS"];
        $this->NAFAS->AdvancedSearch->SearchOperator = @$filter["z_NAFAS"];
        $this->NAFAS->AdvancedSearch->SearchCondition = @$filter["v_NAFAS"];
        $this->NAFAS->AdvancedSearch->SearchValue2 = @$filter["y_NAFAS"];
        $this->NAFAS->AdvancedSearch->SearchOperator2 = @$filter["w_NAFAS"];
        $this->NAFAS->AdvancedSearch->save();

        // Field spec_procedures
        $this->spec_procedures->AdvancedSearch->SearchValue = @$filter["x_spec_procedures"];
        $this->spec_procedures->AdvancedSearch->SearchOperator = @$filter["z_spec_procedures"];
        $this->spec_procedures->AdvancedSearch->SearchCondition = @$filter["v_spec_procedures"];
        $this->spec_procedures->AdvancedSearch->SearchValue2 = @$filter["y_spec_procedures"];
        $this->spec_procedures->AdvancedSearch->SearchOperator2 = @$filter["w_spec_procedures"];
        $this->spec_procedures->AdvancedSearch->save();

        // Field spec_drug
        $this->spec_drug->AdvancedSearch->SearchValue = @$filter["x_spec_drug"];
        $this->spec_drug->AdvancedSearch->SearchOperator = @$filter["z_spec_drug"];
        $this->spec_drug->AdvancedSearch->SearchCondition = @$filter["v_spec_drug"];
        $this->spec_drug->AdvancedSearch->SearchValue2 = @$filter["y_spec_drug"];
        $this->spec_drug->AdvancedSearch->SearchOperator2 = @$filter["w_spec_drug"];
        $this->spec_drug->AdvancedSearch->save();

        // Field spec_prothesis
        $this->spec_prothesis->AdvancedSearch->SearchValue = @$filter["x_spec_prothesis"];
        $this->spec_prothesis->AdvancedSearch->SearchOperator = @$filter["z_spec_prothesis"];
        $this->spec_prothesis->AdvancedSearch->SearchCondition = @$filter["v_spec_prothesis"];
        $this->spec_prothesis->AdvancedSearch->SearchValue2 = @$filter["y_spec_prothesis"];
        $this->spec_prothesis->AdvancedSearch->SearchOperator2 = @$filter["w_spec_prothesis"];
        $this->spec_prothesis->AdvancedSearch->save();

        // Field spec_investigation
        $this->spec_investigation->AdvancedSearch->SearchValue = @$filter["x_spec_investigation"];
        $this->spec_investigation->AdvancedSearch->SearchOperator = @$filter["z_spec_investigation"];
        $this->spec_investigation->AdvancedSearch->SearchCondition = @$filter["v_spec_investigation"];
        $this->spec_investigation->AdvancedSearch->SearchValue2 = @$filter["y_spec_investigation"];
        $this->spec_investigation->AdvancedSearch->SearchOperator2 = @$filter["w_spec_investigation"];
        $this->spec_investigation->AdvancedSearch->save();

        // Field procedure_11
        $this->procedure_11->AdvancedSearch->SearchValue = @$filter["x_procedure_11"];
        $this->procedure_11->AdvancedSearch->SearchOperator = @$filter["z_procedure_11"];
        $this->procedure_11->AdvancedSearch->SearchCondition = @$filter["v_procedure_11"];
        $this->procedure_11->AdvancedSearch->SearchValue2 = @$filter["y_procedure_11"];
        $this->procedure_11->AdvancedSearch->SearchOperator2 = @$filter["w_procedure_11"];
        $this->procedure_11->AdvancedSearch->save();

        // Field procedure_12
        $this->procedure_12->AdvancedSearch->SearchValue = @$filter["x_procedure_12"];
        $this->procedure_12->AdvancedSearch->SearchOperator = @$filter["z_procedure_12"];
        $this->procedure_12->AdvancedSearch->SearchCondition = @$filter["v_procedure_12"];
        $this->procedure_12->AdvancedSearch->SearchValue2 = @$filter["y_procedure_12"];
        $this->procedure_12->AdvancedSearch->SearchOperator2 = @$filter["w_procedure_12"];
        $this->procedure_12->AdvancedSearch->save();

        // Field procedure_13
        $this->procedure_13->AdvancedSearch->SearchValue = @$filter["x_procedure_13"];
        $this->procedure_13->AdvancedSearch->SearchOperator = @$filter["z_procedure_13"];
        $this->procedure_13->AdvancedSearch->SearchCondition = @$filter["v_procedure_13"];
        $this->procedure_13->AdvancedSearch->SearchValue2 = @$filter["y_procedure_13"];
        $this->procedure_13->AdvancedSearch->SearchOperator2 = @$filter["w_procedure_13"];
        $this->procedure_13->AdvancedSearch->save();

        // Field procedure_14
        $this->procedure_14->AdvancedSearch->SearchValue = @$filter["x_procedure_14"];
        $this->procedure_14->AdvancedSearch->SearchOperator = @$filter["z_procedure_14"];
        $this->procedure_14->AdvancedSearch->SearchCondition = @$filter["v_procedure_14"];
        $this->procedure_14->AdvancedSearch->SearchValue2 = @$filter["y_procedure_14"];
        $this->procedure_14->AdvancedSearch->SearchOperator2 = @$filter["w_procedure_14"];
        $this->procedure_14->AdvancedSearch->save();

        // Field procedure_15
        $this->procedure_15->AdvancedSearch->SearchValue = @$filter["x_procedure_15"];
        $this->procedure_15->AdvancedSearch->SearchOperator = @$filter["z_procedure_15"];
        $this->procedure_15->AdvancedSearch->SearchCondition = @$filter["v_procedure_15"];
        $this->procedure_15->AdvancedSearch->SearchValue2 = @$filter["y_procedure_15"];
        $this->procedure_15->AdvancedSearch->SearchOperator2 = @$filter["w_procedure_15"];
        $this->procedure_15->AdvancedSearch->save();

        // Field isanestesi
        $this->isanestesi->AdvancedSearch->SearchValue = @$filter["x_isanestesi"];
        $this->isanestesi->AdvancedSearch->SearchOperator = @$filter["z_isanestesi"];
        $this->isanestesi->AdvancedSearch->SearchCondition = @$filter["v_isanestesi"];
        $this->isanestesi->AdvancedSearch->SearchValue2 = @$filter["y_isanestesi"];
        $this->isanestesi->AdvancedSearch->SearchOperator2 = @$filter["w_isanestesi"];
        $this->isanestesi->AdvancedSearch->save();

        // Field isreposisi
        $this->isreposisi->AdvancedSearch->SearchValue = @$filter["x_isreposisi"];
        $this->isreposisi->AdvancedSearch->SearchOperator = @$filter["z_isreposisi"];
        $this->isreposisi->AdvancedSearch->SearchCondition = @$filter["v_isreposisi"];
        $this->isreposisi->AdvancedSearch->SearchValue2 = @$filter["y_isreposisi"];
        $this->isreposisi->AdvancedSearch->SearchOperator2 = @$filter["w_isreposisi"];
        $this->isreposisi->AdvancedSearch->save();

        // Field islab
        $this->islab->AdvancedSearch->SearchValue = @$filter["x_islab"];
        $this->islab->AdvancedSearch->SearchOperator = @$filter["z_islab"];
        $this->islab->AdvancedSearch->SearchCondition = @$filter["v_islab"];
        $this->islab->AdvancedSearch->SearchValue2 = @$filter["y_islab"];
        $this->islab->AdvancedSearch->SearchOperator2 = @$filter["w_islab"];
        $this->islab->AdvancedSearch->save();

        // Field isro
        $this->isro->AdvancedSearch->SearchValue = @$filter["x_isro"];
        $this->isro->AdvancedSearch->SearchOperator = @$filter["z_isro"];
        $this->isro->AdvancedSearch->SearchCondition = @$filter["v_isro"];
        $this->isro->AdvancedSearch->SearchValue2 = @$filter["y_isro"];
        $this->isro->AdvancedSearch->SearchOperator2 = @$filter["w_isro"];
        $this->isro->AdvancedSearch->save();

        // Field isekg
        $this->isekg->AdvancedSearch->SearchValue = @$filter["x_isekg"];
        $this->isekg->AdvancedSearch->SearchOperator = @$filter["z_isekg"];
        $this->isekg->AdvancedSearch->SearchCondition = @$filter["v_isekg"];
        $this->isekg->AdvancedSearch->SearchValue2 = @$filter["y_isekg"];
        $this->isekg->AdvancedSearch->SearchOperator2 = @$filter["w_isekg"];
        $this->isekg->AdvancedSearch->save();

        // Field ishecting
        $this->ishecting->AdvancedSearch->SearchValue = @$filter["x_ishecting"];
        $this->ishecting->AdvancedSearch->SearchOperator = @$filter["z_ishecting"];
        $this->ishecting->AdvancedSearch->SearchCondition = @$filter["v_ishecting"];
        $this->ishecting->AdvancedSearch->SearchValue2 = @$filter["y_ishecting"];
        $this->ishecting->AdvancedSearch->SearchOperator2 = @$filter["w_ishecting"];
        $this->ishecting->AdvancedSearch->save();

        // Field isgips
        $this->isgips->AdvancedSearch->SearchValue = @$filter["x_isgips"];
        $this->isgips->AdvancedSearch->SearchOperator = @$filter["z_isgips"];
        $this->isgips->AdvancedSearch->SearchCondition = @$filter["v_isgips"];
        $this->isgips->AdvancedSearch->SearchValue2 = @$filter["y_isgips"];
        $this->isgips->AdvancedSearch->SearchOperator2 = @$filter["w_isgips"];
        $this->isgips->AdvancedSearch->save();

        // Field islengkap
        $this->islengkap->AdvancedSearch->SearchValue = @$filter["x_islengkap"];
        $this->islengkap->AdvancedSearch->SearchOperator = @$filter["z_islengkap"];
        $this->islengkap->AdvancedSearch->SearchCondition = @$filter["v_islengkap"];
        $this->islengkap->AdvancedSearch->SearchValue2 = @$filter["y_islengkap"];
        $this->islengkap->AdvancedSearch->SearchOperator2 = @$filter["w_islengkap"];
        $this->islengkap->AdvancedSearch->save();

        // Field ID
        $this->ID->AdvancedSearch->SearchValue = @$filter["x_ID"];
        $this->ID->AdvancedSearch->SearchOperator = @$filter["z_ID"];
        $this->ID->AdvancedSearch->SearchCondition = @$filter["v_ID"];
        $this->ID->AdvancedSearch->SearchValue2 = @$filter["y_ID"];
        $this->ID->AdvancedSearch->SearchOperator2 = @$filter["w_ID"];
        $this->ID->AdvancedSearch->save();

        // Field IDXDAFTAR
        $this->IDXDAFTAR->AdvancedSearch->SearchValue = @$filter["x_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->SearchOperator = @$filter["z_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->SearchCondition = @$filter["v_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->SearchValue2 = @$filter["y_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->SearchOperator2 = @$filter["w_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->save();
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
        $this->buildSearchSql($where, $this->PASIEN_DIAGNOSA_ID, $default, false); // PASIEN_DIAGNOSA_ID
        $this->buildSearchSql($where, $this->NO_REGISTRATION, $default, false); // NO_REGISTRATION
        $this->buildSearchSql($where, $this->THENAME, $default, false); // THENAME
        $this->buildSearchSql($where, $this->VISIT_ID, $default, false); // VISIT_ID
        $this->buildSearchSql($where, $this->CLINIC_ID, $default, false); // CLINIC_ID
        $this->buildSearchSql($where, $this->BILL_ID, $default, false); // BILL_ID
        $this->buildSearchSql($where, $this->CLASS_ROOM_ID, $default, false); // CLASS_ROOM_ID
        $this->buildSearchSql($where, $this->IN_DATE, $default, false); // IN_DATE
        $this->buildSearchSql($where, $this->EXIT_DATE, $default, false); // EXIT_DATE
        $this->buildSearchSql($where, $this->BED_ID, $default, false); // BED_ID
        $this->buildSearchSql($where, $this->KELUAR_ID, $default, false); // KELUAR_ID
        $this->buildSearchSql($where, $this->DATE_OF_DIAGNOSA, $default, false); // DATE_OF_DIAGNOSA
        $this->buildSearchSql($where, $this->REPORT_DATE, $default, false); // REPORT_DATE
        $this->buildSearchSql($where, $this->DIAGNOSA_ID, $default, false); // DIAGNOSA_ID
        $this->buildSearchSql($where, $this->DIAGNOSA_DESC, $default, false); // DIAGNOSA_DESC
        $this->buildSearchSql($where, $this->ANAMNASE, $default, false); // ANAMNASE
        $this->buildSearchSql($where, $this->PEMERIKSAAN, $default, false); // PEMERIKSAAN
        $this->buildSearchSql($where, $this->TERAPHY_DESC, $default, false); // TERAPHY_DESC
        $this->buildSearchSql($where, $this->INSTRUCTION, $default, false); // INSTRUCTION
        $this->buildSearchSql($where, $this->SUFFER_TYPE, $default, false); // SUFFER_TYPE
        $this->buildSearchSql($where, $this->INFECTED_BODY, $default, false); // INFECTED_BODY
        $this->buildSearchSql($where, $this->EMPLOYEE_ID, $default, false); // EMPLOYEE_ID
        $this->buildSearchSql($where, $this->RISK_LEVEL, $default, false); // RISK_LEVEL
        $this->buildSearchSql($where, $this->MORFOLOGI_NEOPLASMA, $default, false); // MORFOLOGI_NEOPLASMA
        $this->buildSearchSql($where, $this->HURT, $default, false); // HURT
        $this->buildSearchSql($where, $this->HURT_TYPE, $default, false); // HURT_TYPE
        $this->buildSearchSql($where, $this->DIAG_CAT, $default, false); // DIAG_CAT
        $this->buildSearchSql($where, $this->ADDICTION_MATERIAL, $default, false); // ADDICTION_MATERIAL
        $this->buildSearchSql($where, $this->INFECTED_QUANTITY, $default, false); // INFECTED_QUANTITY
        $this->buildSearchSql($where, $this->CONTAGIOUS_TYPE, $default, false); // CONTAGIOUS_TYPE
        $this->buildSearchSql($where, $this->CURATIF_ID, $default, false); // CURATIF_ID
        $this->buildSearchSql($where, $this->RESULT_ID, $default, false); // RESULT_ID
        $this->buildSearchSql($where, $this->INFECTION_TYPE, $default, false); // INFECTION_TYPE
        $this->buildSearchSql($where, $this->INVESTIGATION_ID, $default, false); // INVESTIGATION_ID
        $this->buildSearchSql($where, $this->DISABILITY, $default, false); // DISABILITY
        $this->buildSearchSql($where, $this->DESCRIPTION, $default, false); // DESCRIPTION
        $this->buildSearchSql($where, $this->KOMPLIKASI, $default, false); // KOMPLIKASI
        $this->buildSearchSql($where, $this->MODIFIED_DATE, $default, false); // MODIFIED_DATE
        $this->buildSearchSql($where, $this->MODIFIED_BY, $default, false); // MODIFIED_BY
        $this->buildSearchSql($where, $this->MODIFIED_FROM, $default, false); // MODIFIED_FROM
        $this->buildSearchSql($where, $this->STATUS_PASIEN_ID, $default, false); // STATUS_PASIEN_ID
        $this->buildSearchSql($where, $this->AGEYEAR, $default, false); // AGEYEAR
        $this->buildSearchSql($where, $this->AGEMONTH, $default, false); // AGEMONTH
        $this->buildSearchSql($where, $this->AGEDAY, $default, false); // AGEDAY
        $this->buildSearchSql($where, $this->THEADDRESS, $default, false); // THEADDRESS
        $this->buildSearchSql($where, $this->THEID, $default, false); // THEID
        $this->buildSearchSql($where, $this->ISRJ, $default, false); // ISRJ
        $this->buildSearchSql($where, $this->GENDER, $default, false); // GENDER
        $this->buildSearchSql($where, $this->DOCTOR, $default, false); // DOCTOR
        $this->buildSearchSql($where, $this->KAL_ID, $default, false); // KAL_ID
        $this->buildSearchSql($where, $this->ACCOUNT_ID, $default, false); // ACCOUNT_ID
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_02, $default, false); // DIAGNOSA_ID_02
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_03, $default, false); // DIAGNOSA_ID_03
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_04, $default, false); // DIAGNOSA_ID_04
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_05, $default, false); // DIAGNOSA_ID_05
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_06, $default, false); // DIAGNOSA_ID_06
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_07, $default, false); // DIAGNOSA_ID_07
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_08, $default, false); // DIAGNOSA_ID_08
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_09, $default, false); // DIAGNOSA_ID_09
        $this->buildSearchSql($where, $this->DIAGNOSA_ID_10, $default, false); // DIAGNOSA_ID_10
        $this->buildSearchSql($where, $this->PROCEDURE_01, $default, false); // PROCEDURE_01
        $this->buildSearchSql($where, $this->PROCEDURE_02, $default, false); // PROCEDURE_02
        $this->buildSearchSql($where, $this->PROCEDURE_03, $default, false); // PROCEDURE_03
        $this->buildSearchSql($where, $this->PROCEDURE_04, $default, false); // PROCEDURE_04
        $this->buildSearchSql($where, $this->PROCEDURE_05, $default, false); // PROCEDURE_05
        $this->buildSearchSql($where, $this->PROCEDURE_06, $default, false); // PROCEDURE_06
        $this->buildSearchSql($where, $this->PROCEDURE_07, $default, false); // PROCEDURE_07
        $this->buildSearchSql($where, $this->PROCEDURE_08, $default, false); // PROCEDURE_08
        $this->buildSearchSql($where, $this->PROCEDURE_09, $default, false); // PROCEDURE_09
        $this->buildSearchSql($where, $this->PROCEDURE_10, $default, false); // PROCEDURE_10
        $this->buildSearchSql($where, $this->DIAGNOSA_ID2, $default, false); // DIAGNOSA_ID2
        $this->buildSearchSql($where, $this->WEIGHT, $default, false); // WEIGHT
        $this->buildSearchSql($where, $this->NOKARTU, $default, false); // NOKARTU
        $this->buildSearchSql($where, $this->NOSEP, $default, false); // NOSEP
        $this->buildSearchSql($where, $this->TGLSEP, $default, false); // TGLSEP
        $this->buildSearchSql($where, $this->RENCANATL, $default, false); // RENCANATL
        $this->buildSearchSql($where, $this->DIRUJUKKE, $default, false); // DIRUJUKKE
        $this->buildSearchSql($where, $this->TGLKONTROL, $default, false); // TGLKONTROL
        $this->buildSearchSql($where, $this->KDPOLI_KONTROL, $default, false); // KDPOLI_KONTROL
        $this->buildSearchSql($where, $this->JAMINAN, $default, false); // JAMINAN
        $this->buildSearchSql($where, $this->SPESIALISTIK, $default, false); // SPESIALISTIK
        $this->buildSearchSql($where, $this->PEMERIKSAAN_02, $default, false); // PEMERIKSAAN_02
        $this->buildSearchSql($where, $this->DIAGNOSA_DESC_02, $default, false); // DIAGNOSA_DESC_02
        $this->buildSearchSql($where, $this->DIAGNOSA_DESC_03, $default, false); // DIAGNOSA_DESC_03
        $this->buildSearchSql($where, $this->DIAGNOSA_DESC_04, $default, false); // DIAGNOSA_DESC_04
        $this->buildSearchSql($where, $this->DIAGNOSA_DESC_05, $default, false); // DIAGNOSA_DESC_05
        $this->buildSearchSql($where, $this->DIAGNOSA_DESC_06, $default, false); // DIAGNOSA_DESC_06
        $this->buildSearchSql($where, $this->PROCEDURE_DESC_01, $default, false); // PROCEDURE_DESC_01
        $this->buildSearchSql($where, $this->PROCEDURE_DESC_02, $default, false); // PROCEDURE_DESC_02
        $this->buildSearchSql($where, $this->PROCEDURE_DESC_03, $default, false); // PROCEDURE_DESC_03
        $this->buildSearchSql($where, $this->PROCEDURE_DESC_04, $default, false); // PROCEDURE_DESC_04
        $this->buildSearchSql($where, $this->PROCEDURE_DESC_05, $default, false); // PROCEDURE_DESC_05
        $this->buildSearchSql($where, $this->RESPONPOST, $default, false); // RESPONPOST
        $this->buildSearchSql($where, $this->RESPONPUT, $default, false); // RESPONPUT
        $this->buildSearchSql($where, $this->RESPONDEL, $default, false); // RESPONDEL
        $this->buildSearchSql($where, $this->JSONPOST, $default, false); // JSONPOST
        $this->buildSearchSql($where, $this->JSONPUT, $default, false); // JSONPUT
        $this->buildSearchSql($where, $this->JSONDEL, $default, false); // JSONDEL
        $this->buildSearchSql($where, $this->height, $default, false); // height
        $this->buildSearchSql($where, $this->TEMPERATURE, $default, false); // TEMPERATURE
        $this->buildSearchSql($where, $this->TENSION_UPPER, $default, false); // TENSION_UPPER
        $this->buildSearchSql($where, $this->TENSION_BELOW, $default, false); // TENSION_BELOW
        $this->buildSearchSql($where, $this->NADI, $default, false); // NADI
        $this->buildSearchSql($where, $this->NAFAS, $default, false); // NAFAS
        $this->buildSearchSql($where, $this->spec_procedures, $default, false); // spec_procedures
        $this->buildSearchSql($where, $this->spec_drug, $default, false); // spec_drug
        $this->buildSearchSql($where, $this->spec_prothesis, $default, false); // spec_prothesis
        $this->buildSearchSql($where, $this->spec_investigation, $default, false); // spec_investigation
        $this->buildSearchSql($where, $this->procedure_11, $default, false); // procedure_11
        $this->buildSearchSql($where, $this->procedure_12, $default, false); // procedure_12
        $this->buildSearchSql($where, $this->procedure_13, $default, false); // procedure_13
        $this->buildSearchSql($where, $this->procedure_14, $default, false); // procedure_14
        $this->buildSearchSql($where, $this->procedure_15, $default, false); // procedure_15
        $this->buildSearchSql($where, $this->isanestesi, $default, false); // isanestesi
        $this->buildSearchSql($where, $this->isreposisi, $default, false); // isreposisi
        $this->buildSearchSql($where, $this->islab, $default, false); // islab
        $this->buildSearchSql($where, $this->isro, $default, false); // isro
        $this->buildSearchSql($where, $this->isekg, $default, false); // isekg
        $this->buildSearchSql($where, $this->ishecting, $default, false); // ishecting
        $this->buildSearchSql($where, $this->isgips, $default, false); // isgips
        $this->buildSearchSql($where, $this->islengkap, $default, false); // islengkap
        $this->buildSearchSql($where, $this->ID, $default, false); // ID
        $this->buildSearchSql($where, $this->IDXDAFTAR, $default, false); // IDXDAFTAR

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->ORG_UNIT_CODE->AdvancedSearch->save(); // ORG_UNIT_CODE
            $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->save(); // PASIEN_DIAGNOSA_ID
            $this->NO_REGISTRATION->AdvancedSearch->save(); // NO_REGISTRATION
            $this->THENAME->AdvancedSearch->save(); // THENAME
            $this->VISIT_ID->AdvancedSearch->save(); // VISIT_ID
            $this->CLINIC_ID->AdvancedSearch->save(); // CLINIC_ID
            $this->BILL_ID->AdvancedSearch->save(); // BILL_ID
            $this->CLASS_ROOM_ID->AdvancedSearch->save(); // CLASS_ROOM_ID
            $this->IN_DATE->AdvancedSearch->save(); // IN_DATE
            $this->EXIT_DATE->AdvancedSearch->save(); // EXIT_DATE
            $this->BED_ID->AdvancedSearch->save(); // BED_ID
            $this->KELUAR_ID->AdvancedSearch->save(); // KELUAR_ID
            $this->DATE_OF_DIAGNOSA->AdvancedSearch->save(); // DATE_OF_DIAGNOSA
            $this->REPORT_DATE->AdvancedSearch->save(); // REPORT_DATE
            $this->DIAGNOSA_ID->AdvancedSearch->save(); // DIAGNOSA_ID
            $this->DIAGNOSA_DESC->AdvancedSearch->save(); // DIAGNOSA_DESC
            $this->ANAMNASE->AdvancedSearch->save(); // ANAMNASE
            $this->PEMERIKSAAN->AdvancedSearch->save(); // PEMERIKSAAN
            $this->TERAPHY_DESC->AdvancedSearch->save(); // TERAPHY_DESC
            $this->INSTRUCTION->AdvancedSearch->save(); // INSTRUCTION
            $this->SUFFER_TYPE->AdvancedSearch->save(); // SUFFER_TYPE
            $this->INFECTED_BODY->AdvancedSearch->save(); // INFECTED_BODY
            $this->EMPLOYEE_ID->AdvancedSearch->save(); // EMPLOYEE_ID
            $this->RISK_LEVEL->AdvancedSearch->save(); // RISK_LEVEL
            $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->save(); // MORFOLOGI_NEOPLASMA
            $this->HURT->AdvancedSearch->save(); // HURT
            $this->HURT_TYPE->AdvancedSearch->save(); // HURT_TYPE
            $this->DIAG_CAT->AdvancedSearch->save(); // DIAG_CAT
            $this->ADDICTION_MATERIAL->AdvancedSearch->save(); // ADDICTION_MATERIAL
            $this->INFECTED_QUANTITY->AdvancedSearch->save(); // INFECTED_QUANTITY
            $this->CONTAGIOUS_TYPE->AdvancedSearch->save(); // CONTAGIOUS_TYPE
            $this->CURATIF_ID->AdvancedSearch->save(); // CURATIF_ID
            $this->RESULT_ID->AdvancedSearch->save(); // RESULT_ID
            $this->INFECTION_TYPE->AdvancedSearch->save(); // INFECTION_TYPE
            $this->INVESTIGATION_ID->AdvancedSearch->save(); // INVESTIGATION_ID
            $this->DISABILITY->AdvancedSearch->save(); // DISABILITY
            $this->DESCRIPTION->AdvancedSearch->save(); // DESCRIPTION
            $this->KOMPLIKASI->AdvancedSearch->save(); // KOMPLIKASI
            $this->MODIFIED_DATE->AdvancedSearch->save(); // MODIFIED_DATE
            $this->MODIFIED_BY->AdvancedSearch->save(); // MODIFIED_BY
            $this->MODIFIED_FROM->AdvancedSearch->save(); // MODIFIED_FROM
            $this->STATUS_PASIEN_ID->AdvancedSearch->save(); // STATUS_PASIEN_ID
            $this->AGEYEAR->AdvancedSearch->save(); // AGEYEAR
            $this->AGEMONTH->AdvancedSearch->save(); // AGEMONTH
            $this->AGEDAY->AdvancedSearch->save(); // AGEDAY
            $this->THEADDRESS->AdvancedSearch->save(); // THEADDRESS
            $this->THEID->AdvancedSearch->save(); // THEID
            $this->ISRJ->AdvancedSearch->save(); // ISRJ
            $this->GENDER->AdvancedSearch->save(); // GENDER
            $this->DOCTOR->AdvancedSearch->save(); // DOCTOR
            $this->KAL_ID->AdvancedSearch->save(); // KAL_ID
            $this->ACCOUNT_ID->AdvancedSearch->save(); // ACCOUNT_ID
            $this->DIAGNOSA_ID_02->AdvancedSearch->save(); // DIAGNOSA_ID_02
            $this->DIAGNOSA_ID_03->AdvancedSearch->save(); // DIAGNOSA_ID_03
            $this->DIAGNOSA_ID_04->AdvancedSearch->save(); // DIAGNOSA_ID_04
            $this->DIAGNOSA_ID_05->AdvancedSearch->save(); // DIAGNOSA_ID_05
            $this->DIAGNOSA_ID_06->AdvancedSearch->save(); // DIAGNOSA_ID_06
            $this->DIAGNOSA_ID_07->AdvancedSearch->save(); // DIAGNOSA_ID_07
            $this->DIAGNOSA_ID_08->AdvancedSearch->save(); // DIAGNOSA_ID_08
            $this->DIAGNOSA_ID_09->AdvancedSearch->save(); // DIAGNOSA_ID_09
            $this->DIAGNOSA_ID_10->AdvancedSearch->save(); // DIAGNOSA_ID_10
            $this->PROCEDURE_01->AdvancedSearch->save(); // PROCEDURE_01
            $this->PROCEDURE_02->AdvancedSearch->save(); // PROCEDURE_02
            $this->PROCEDURE_03->AdvancedSearch->save(); // PROCEDURE_03
            $this->PROCEDURE_04->AdvancedSearch->save(); // PROCEDURE_04
            $this->PROCEDURE_05->AdvancedSearch->save(); // PROCEDURE_05
            $this->PROCEDURE_06->AdvancedSearch->save(); // PROCEDURE_06
            $this->PROCEDURE_07->AdvancedSearch->save(); // PROCEDURE_07
            $this->PROCEDURE_08->AdvancedSearch->save(); // PROCEDURE_08
            $this->PROCEDURE_09->AdvancedSearch->save(); // PROCEDURE_09
            $this->PROCEDURE_10->AdvancedSearch->save(); // PROCEDURE_10
            $this->DIAGNOSA_ID2->AdvancedSearch->save(); // DIAGNOSA_ID2
            $this->WEIGHT->AdvancedSearch->save(); // WEIGHT
            $this->NOKARTU->AdvancedSearch->save(); // NOKARTU
            $this->NOSEP->AdvancedSearch->save(); // NOSEP
            $this->TGLSEP->AdvancedSearch->save(); // TGLSEP
            $this->RENCANATL->AdvancedSearch->save(); // RENCANATL
            $this->DIRUJUKKE->AdvancedSearch->save(); // DIRUJUKKE
            $this->TGLKONTROL->AdvancedSearch->save(); // TGLKONTROL
            $this->KDPOLI_KONTROL->AdvancedSearch->save(); // KDPOLI_KONTROL
            $this->JAMINAN->AdvancedSearch->save(); // JAMINAN
            $this->SPESIALISTIK->AdvancedSearch->save(); // SPESIALISTIK
            $this->PEMERIKSAAN_02->AdvancedSearch->save(); // PEMERIKSAAN_02
            $this->DIAGNOSA_DESC_02->AdvancedSearch->save(); // DIAGNOSA_DESC_02
            $this->DIAGNOSA_DESC_03->AdvancedSearch->save(); // DIAGNOSA_DESC_03
            $this->DIAGNOSA_DESC_04->AdvancedSearch->save(); // DIAGNOSA_DESC_04
            $this->DIAGNOSA_DESC_05->AdvancedSearch->save(); // DIAGNOSA_DESC_05
            $this->DIAGNOSA_DESC_06->AdvancedSearch->save(); // DIAGNOSA_DESC_06
            $this->PROCEDURE_DESC_01->AdvancedSearch->save(); // PROCEDURE_DESC_01
            $this->PROCEDURE_DESC_02->AdvancedSearch->save(); // PROCEDURE_DESC_02
            $this->PROCEDURE_DESC_03->AdvancedSearch->save(); // PROCEDURE_DESC_03
            $this->PROCEDURE_DESC_04->AdvancedSearch->save(); // PROCEDURE_DESC_04
            $this->PROCEDURE_DESC_05->AdvancedSearch->save(); // PROCEDURE_DESC_05
            $this->RESPONPOST->AdvancedSearch->save(); // RESPONPOST
            $this->RESPONPUT->AdvancedSearch->save(); // RESPONPUT
            $this->RESPONDEL->AdvancedSearch->save(); // RESPONDEL
            $this->JSONPOST->AdvancedSearch->save(); // JSONPOST
            $this->JSONPUT->AdvancedSearch->save(); // JSONPUT
            $this->JSONDEL->AdvancedSearch->save(); // JSONDEL
            $this->height->AdvancedSearch->save(); // height
            $this->TEMPERATURE->AdvancedSearch->save(); // TEMPERATURE
            $this->TENSION_UPPER->AdvancedSearch->save(); // TENSION_UPPER
            $this->TENSION_BELOW->AdvancedSearch->save(); // TENSION_BELOW
            $this->NADI->AdvancedSearch->save(); // NADI
            $this->NAFAS->AdvancedSearch->save(); // NAFAS
            $this->spec_procedures->AdvancedSearch->save(); // spec_procedures
            $this->spec_drug->AdvancedSearch->save(); // spec_drug
            $this->spec_prothesis->AdvancedSearch->save(); // spec_prothesis
            $this->spec_investigation->AdvancedSearch->save(); // spec_investigation
            $this->procedure_11->AdvancedSearch->save(); // procedure_11
            $this->procedure_12->AdvancedSearch->save(); // procedure_12
            $this->procedure_13->AdvancedSearch->save(); // procedure_13
            $this->procedure_14->AdvancedSearch->save(); // procedure_14
            $this->procedure_15->AdvancedSearch->save(); // procedure_15
            $this->isanestesi->AdvancedSearch->save(); // isanestesi
            $this->isreposisi->AdvancedSearch->save(); // isreposisi
            $this->islab->AdvancedSearch->save(); // islab
            $this->isro->AdvancedSearch->save(); // isro
            $this->isekg->AdvancedSearch->save(); // isekg
            $this->ishecting->AdvancedSearch->save(); // ishecting
            $this->isgips->AdvancedSearch->save(); // isgips
            $this->islengkap->AdvancedSearch->save(); // islengkap
            $this->ID->AdvancedSearch->save(); // ID
            $this->IDXDAFTAR->AdvancedSearch->save(); // IDXDAFTAR
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
        $this->buildBasicSearchSql($where, $this->CLINIC_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->DATE_OF_DIAGNOSA, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->DIAGNOSA_ID, $arKeywords, $type);
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
        if ($this->PASIEN_DIAGNOSA_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NO_REGISTRATION->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->THENAME->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->VISIT_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->CLINIC_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->BILL_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->CLASS_ROOM_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->IN_DATE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->EXIT_DATE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->BED_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->KELUAR_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DATE_OF_DIAGNOSA->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->REPORT_DATE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_DESC->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ANAMNASE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PEMERIKSAAN->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->TERAPHY_DESC->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->INSTRUCTION->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->SUFFER_TYPE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->INFECTED_BODY->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->EMPLOYEE_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->RISK_LEVEL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->MORFOLOGI_NEOPLASMA->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->HURT->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->HURT_TYPE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAG_CAT->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ADDICTION_MATERIAL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->INFECTED_QUANTITY->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->CONTAGIOUS_TYPE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->CURATIF_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->RESULT_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->INFECTION_TYPE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->INVESTIGATION_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DISABILITY->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DESCRIPTION->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->KOMPLIKASI->AdvancedSearch->issetSession()) {
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
        if ($this->STATUS_PASIEN_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->AGEYEAR->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->AGEMONTH->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->AGEDAY->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->THEADDRESS->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->THEID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ISRJ->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->GENDER->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DOCTOR->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->KAL_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ACCOUNT_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_02->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_03->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_04->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_05->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_06->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_07->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_08->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_09->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID_10->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_01->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_02->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_03->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_04->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_05->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_06->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_07->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_08->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_09->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_10->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_ID2->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->WEIGHT->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NOKARTU->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NOSEP->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->TGLSEP->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->RENCANATL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIRUJUKKE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->TGLKONTROL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->KDPOLI_KONTROL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->JAMINAN->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->SPESIALISTIK->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PEMERIKSAAN_02->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_DESC_02->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_DESC_03->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_DESC_04->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_DESC_05->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->DIAGNOSA_DESC_06->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_DESC_01->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_DESC_02->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_DESC_03->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_DESC_04->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->PROCEDURE_DESC_05->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->RESPONPOST->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->RESPONPUT->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->RESPONDEL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->JSONPOST->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->JSONPUT->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->JSONDEL->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->height->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->TEMPERATURE->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->TENSION_UPPER->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->TENSION_BELOW->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NADI->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->NAFAS->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->spec_procedures->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->spec_drug->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->spec_prothesis->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->spec_investigation->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->procedure_11->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->procedure_12->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->procedure_13->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->procedure_14->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->procedure_15->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->isanestesi->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->isreposisi->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->islab->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->isro->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->isekg->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ishecting->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->isgips->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->islengkap->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->IDXDAFTAR->AdvancedSearch->issetSession()) {
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
        return false;
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
                $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->unsetSession();
                $this->NO_REGISTRATION->AdvancedSearch->unsetSession();
                $this->THENAME->AdvancedSearch->unsetSession();
                $this->VISIT_ID->AdvancedSearch->unsetSession();
                $this->CLINIC_ID->AdvancedSearch->unsetSession();
                $this->BILL_ID->AdvancedSearch->unsetSession();
                $this->CLASS_ROOM_ID->AdvancedSearch->unsetSession();
                $this->IN_DATE->AdvancedSearch->unsetSession();
                $this->EXIT_DATE->AdvancedSearch->unsetSession();
                $this->BED_ID->AdvancedSearch->unsetSession();
                $this->KELUAR_ID->AdvancedSearch->unsetSession();
                $this->DATE_OF_DIAGNOSA->AdvancedSearch->unsetSession();
                $this->REPORT_DATE->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_DESC->AdvancedSearch->unsetSession();
                $this->ANAMNASE->AdvancedSearch->unsetSession();
                $this->PEMERIKSAAN->AdvancedSearch->unsetSession();
                $this->TERAPHY_DESC->AdvancedSearch->unsetSession();
                $this->INSTRUCTION->AdvancedSearch->unsetSession();
                $this->SUFFER_TYPE->AdvancedSearch->unsetSession();
                $this->INFECTED_BODY->AdvancedSearch->unsetSession();
                $this->EMPLOYEE_ID->AdvancedSearch->unsetSession();
                $this->RISK_LEVEL->AdvancedSearch->unsetSession();
                $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->unsetSession();
                $this->HURT->AdvancedSearch->unsetSession();
                $this->HURT_TYPE->AdvancedSearch->unsetSession();
                $this->DIAG_CAT->AdvancedSearch->unsetSession();
                $this->ADDICTION_MATERIAL->AdvancedSearch->unsetSession();
                $this->INFECTED_QUANTITY->AdvancedSearch->unsetSession();
                $this->CONTAGIOUS_TYPE->AdvancedSearch->unsetSession();
                $this->CURATIF_ID->AdvancedSearch->unsetSession();
                $this->RESULT_ID->AdvancedSearch->unsetSession();
                $this->INFECTION_TYPE->AdvancedSearch->unsetSession();
                $this->INVESTIGATION_ID->AdvancedSearch->unsetSession();
                $this->DISABILITY->AdvancedSearch->unsetSession();
                $this->DESCRIPTION->AdvancedSearch->unsetSession();
                $this->KOMPLIKASI->AdvancedSearch->unsetSession();
                $this->MODIFIED_DATE->AdvancedSearch->unsetSession();
                $this->MODIFIED_BY->AdvancedSearch->unsetSession();
                $this->MODIFIED_FROM->AdvancedSearch->unsetSession();
                $this->STATUS_PASIEN_ID->AdvancedSearch->unsetSession();
                $this->AGEYEAR->AdvancedSearch->unsetSession();
                $this->AGEMONTH->AdvancedSearch->unsetSession();
                $this->AGEDAY->AdvancedSearch->unsetSession();
                $this->THEADDRESS->AdvancedSearch->unsetSession();
                $this->THEID->AdvancedSearch->unsetSession();
                $this->ISRJ->AdvancedSearch->unsetSession();
                $this->GENDER->AdvancedSearch->unsetSession();
                $this->DOCTOR->AdvancedSearch->unsetSession();
                $this->KAL_ID->AdvancedSearch->unsetSession();
                $this->ACCOUNT_ID->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_02->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_03->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_04->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_05->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_06->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_07->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_08->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_09->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID_10->AdvancedSearch->unsetSession();
                $this->PROCEDURE_01->AdvancedSearch->unsetSession();
                $this->PROCEDURE_02->AdvancedSearch->unsetSession();
                $this->PROCEDURE_03->AdvancedSearch->unsetSession();
                $this->PROCEDURE_04->AdvancedSearch->unsetSession();
                $this->PROCEDURE_05->AdvancedSearch->unsetSession();
                $this->PROCEDURE_06->AdvancedSearch->unsetSession();
                $this->PROCEDURE_07->AdvancedSearch->unsetSession();
                $this->PROCEDURE_08->AdvancedSearch->unsetSession();
                $this->PROCEDURE_09->AdvancedSearch->unsetSession();
                $this->PROCEDURE_10->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_ID2->AdvancedSearch->unsetSession();
                $this->WEIGHT->AdvancedSearch->unsetSession();
                $this->NOKARTU->AdvancedSearch->unsetSession();
                $this->NOSEP->AdvancedSearch->unsetSession();
                $this->TGLSEP->AdvancedSearch->unsetSession();
                $this->RENCANATL->AdvancedSearch->unsetSession();
                $this->DIRUJUKKE->AdvancedSearch->unsetSession();
                $this->TGLKONTROL->AdvancedSearch->unsetSession();
                $this->KDPOLI_KONTROL->AdvancedSearch->unsetSession();
                $this->JAMINAN->AdvancedSearch->unsetSession();
                $this->SPESIALISTIK->AdvancedSearch->unsetSession();
                $this->PEMERIKSAAN_02->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_DESC_02->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_DESC_03->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_DESC_04->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_DESC_05->AdvancedSearch->unsetSession();
                $this->DIAGNOSA_DESC_06->AdvancedSearch->unsetSession();
                $this->PROCEDURE_DESC_01->AdvancedSearch->unsetSession();
                $this->PROCEDURE_DESC_02->AdvancedSearch->unsetSession();
                $this->PROCEDURE_DESC_03->AdvancedSearch->unsetSession();
                $this->PROCEDURE_DESC_04->AdvancedSearch->unsetSession();
                $this->PROCEDURE_DESC_05->AdvancedSearch->unsetSession();
                $this->RESPONPOST->AdvancedSearch->unsetSession();
                $this->RESPONPUT->AdvancedSearch->unsetSession();
                $this->RESPONDEL->AdvancedSearch->unsetSession();
                $this->JSONPOST->AdvancedSearch->unsetSession();
                $this->JSONPUT->AdvancedSearch->unsetSession();
                $this->JSONDEL->AdvancedSearch->unsetSession();
                $this->height->AdvancedSearch->unsetSession();
                $this->TEMPERATURE->AdvancedSearch->unsetSession();
                $this->TENSION_UPPER->AdvancedSearch->unsetSession();
                $this->TENSION_BELOW->AdvancedSearch->unsetSession();
                $this->NADI->AdvancedSearch->unsetSession();
                $this->NAFAS->AdvancedSearch->unsetSession();
                $this->spec_procedures->AdvancedSearch->unsetSession();
                $this->spec_drug->AdvancedSearch->unsetSession();
                $this->spec_prothesis->AdvancedSearch->unsetSession();
                $this->spec_investigation->AdvancedSearch->unsetSession();
                $this->procedure_11->AdvancedSearch->unsetSession();
                $this->procedure_12->AdvancedSearch->unsetSession();
                $this->procedure_13->AdvancedSearch->unsetSession();
                $this->procedure_14->AdvancedSearch->unsetSession();
                $this->procedure_15->AdvancedSearch->unsetSession();
                $this->isanestesi->AdvancedSearch->unsetSession();
                $this->isreposisi->AdvancedSearch->unsetSession();
                $this->islab->AdvancedSearch->unsetSession();
                $this->isro->AdvancedSearch->unsetSession();
                $this->isekg->AdvancedSearch->unsetSession();
                $this->ishecting->AdvancedSearch->unsetSession();
                $this->isgips->AdvancedSearch->unsetSession();
                $this->islengkap->AdvancedSearch->unsetSession();
                $this->ID->AdvancedSearch->unsetSession();
                $this->IDXDAFTAR->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
                $this->ORG_UNIT_CODE->AdvancedSearch->load();
                $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->load();
                $this->NO_REGISTRATION->AdvancedSearch->load();
                $this->THENAME->AdvancedSearch->load();
                $this->VISIT_ID->AdvancedSearch->load();
                $this->CLINIC_ID->AdvancedSearch->load();
                $this->BILL_ID->AdvancedSearch->load();
                $this->CLASS_ROOM_ID->AdvancedSearch->load();
                $this->IN_DATE->AdvancedSearch->load();
                $this->EXIT_DATE->AdvancedSearch->load();
                $this->BED_ID->AdvancedSearch->load();
                $this->KELUAR_ID->AdvancedSearch->load();
                $this->DATE_OF_DIAGNOSA->AdvancedSearch->load();
                $this->REPORT_DATE->AdvancedSearch->load();
                $this->DIAGNOSA_ID->AdvancedSearch->load();
                $this->DIAGNOSA_DESC->AdvancedSearch->load();
                $this->ANAMNASE->AdvancedSearch->load();
                $this->PEMERIKSAAN->AdvancedSearch->load();
                $this->TERAPHY_DESC->AdvancedSearch->load();
                $this->INSTRUCTION->AdvancedSearch->load();
                $this->SUFFER_TYPE->AdvancedSearch->load();
                $this->INFECTED_BODY->AdvancedSearch->load();
                $this->EMPLOYEE_ID->AdvancedSearch->load();
                $this->RISK_LEVEL->AdvancedSearch->load();
                $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->load();
                $this->HURT->AdvancedSearch->load();
                $this->HURT_TYPE->AdvancedSearch->load();
                $this->DIAG_CAT->AdvancedSearch->load();
                $this->ADDICTION_MATERIAL->AdvancedSearch->load();
                $this->INFECTED_QUANTITY->AdvancedSearch->load();
                $this->CONTAGIOUS_TYPE->AdvancedSearch->load();
                $this->CURATIF_ID->AdvancedSearch->load();
                $this->RESULT_ID->AdvancedSearch->load();
                $this->INFECTION_TYPE->AdvancedSearch->load();
                $this->INVESTIGATION_ID->AdvancedSearch->load();
                $this->DISABILITY->AdvancedSearch->load();
                $this->DESCRIPTION->AdvancedSearch->load();
                $this->KOMPLIKASI->AdvancedSearch->load();
                $this->MODIFIED_DATE->AdvancedSearch->load();
                $this->MODIFIED_BY->AdvancedSearch->load();
                $this->MODIFIED_FROM->AdvancedSearch->load();
                $this->STATUS_PASIEN_ID->AdvancedSearch->load();
                $this->AGEYEAR->AdvancedSearch->load();
                $this->AGEMONTH->AdvancedSearch->load();
                $this->AGEDAY->AdvancedSearch->load();
                $this->THEADDRESS->AdvancedSearch->load();
                $this->THEID->AdvancedSearch->load();
                $this->ISRJ->AdvancedSearch->load();
                $this->GENDER->AdvancedSearch->load();
                $this->DOCTOR->AdvancedSearch->load();
                $this->KAL_ID->AdvancedSearch->load();
                $this->ACCOUNT_ID->AdvancedSearch->load();
                $this->DIAGNOSA_ID_02->AdvancedSearch->load();
                $this->DIAGNOSA_ID_03->AdvancedSearch->load();
                $this->DIAGNOSA_ID_04->AdvancedSearch->load();
                $this->DIAGNOSA_ID_05->AdvancedSearch->load();
                $this->DIAGNOSA_ID_06->AdvancedSearch->load();
                $this->DIAGNOSA_ID_07->AdvancedSearch->load();
                $this->DIAGNOSA_ID_08->AdvancedSearch->load();
                $this->DIAGNOSA_ID_09->AdvancedSearch->load();
                $this->DIAGNOSA_ID_10->AdvancedSearch->load();
                $this->PROCEDURE_01->AdvancedSearch->load();
                $this->PROCEDURE_02->AdvancedSearch->load();
                $this->PROCEDURE_03->AdvancedSearch->load();
                $this->PROCEDURE_04->AdvancedSearch->load();
                $this->PROCEDURE_05->AdvancedSearch->load();
                $this->PROCEDURE_06->AdvancedSearch->load();
                $this->PROCEDURE_07->AdvancedSearch->load();
                $this->PROCEDURE_08->AdvancedSearch->load();
                $this->PROCEDURE_09->AdvancedSearch->load();
                $this->PROCEDURE_10->AdvancedSearch->load();
                $this->DIAGNOSA_ID2->AdvancedSearch->load();
                $this->WEIGHT->AdvancedSearch->load();
                $this->NOKARTU->AdvancedSearch->load();
                $this->NOSEP->AdvancedSearch->load();
                $this->TGLSEP->AdvancedSearch->load();
                $this->RENCANATL->AdvancedSearch->load();
                $this->DIRUJUKKE->AdvancedSearch->load();
                $this->TGLKONTROL->AdvancedSearch->load();
                $this->KDPOLI_KONTROL->AdvancedSearch->load();
                $this->JAMINAN->AdvancedSearch->load();
                $this->SPESIALISTIK->AdvancedSearch->load();
                $this->PEMERIKSAAN_02->AdvancedSearch->load();
                $this->DIAGNOSA_DESC_02->AdvancedSearch->load();
                $this->DIAGNOSA_DESC_03->AdvancedSearch->load();
                $this->DIAGNOSA_DESC_04->AdvancedSearch->load();
                $this->DIAGNOSA_DESC_05->AdvancedSearch->load();
                $this->DIAGNOSA_DESC_06->AdvancedSearch->load();
                $this->PROCEDURE_DESC_01->AdvancedSearch->load();
                $this->PROCEDURE_DESC_02->AdvancedSearch->load();
                $this->PROCEDURE_DESC_03->AdvancedSearch->load();
                $this->PROCEDURE_DESC_04->AdvancedSearch->load();
                $this->PROCEDURE_DESC_05->AdvancedSearch->load();
                $this->RESPONPOST->AdvancedSearch->load();
                $this->RESPONPUT->AdvancedSearch->load();
                $this->RESPONDEL->AdvancedSearch->load();
                $this->JSONPOST->AdvancedSearch->load();
                $this->JSONPUT->AdvancedSearch->load();
                $this->JSONDEL->AdvancedSearch->load();
                $this->height->AdvancedSearch->load();
                $this->TEMPERATURE->AdvancedSearch->load();
                $this->TENSION_UPPER->AdvancedSearch->load();
                $this->TENSION_BELOW->AdvancedSearch->load();
                $this->NADI->AdvancedSearch->load();
                $this->NAFAS->AdvancedSearch->load();
                $this->spec_procedures->AdvancedSearch->load();
                $this->spec_drug->AdvancedSearch->load();
                $this->spec_prothesis->AdvancedSearch->load();
                $this->spec_investigation->AdvancedSearch->load();
                $this->procedure_11->AdvancedSearch->load();
                $this->procedure_12->AdvancedSearch->load();
                $this->procedure_13->AdvancedSearch->load();
                $this->procedure_14->AdvancedSearch->load();
                $this->procedure_15->AdvancedSearch->load();
                $this->isanestesi->AdvancedSearch->load();
                $this->isreposisi->AdvancedSearch->load();
                $this->islab->AdvancedSearch->load();
                $this->isro->AdvancedSearch->load();
                $this->isekg->AdvancedSearch->load();
                $this->ishecting->AdvancedSearch->load();
                $this->isgips->AdvancedSearch->load();
                $this->islengkap->AdvancedSearch->load();
                $this->ID->AdvancedSearch->load();
                $this->IDXDAFTAR->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->DATE_OF_DIAGNOSA); // DATE_OF_DIAGNOSA
            $this->updateSort($this->DIAGNOSA_ID); // DIAGNOSA_ID
            $this->updateSort($this->ANAMNASE); // ANAMNASE
            $this->updateSort($this->PEMERIKSAAN); // PEMERIKSAAN
            $this->updateSort($this->TERAPHY_DESC); // TERAPHY_DESC
            $this->updateSort($this->TGLKONTROL); // TGLKONTROL
            $this->updateSort($this->IDXDAFTAR); // IDXDAFTAR
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
                $this->ORG_UNIT_CODE->setSort("");
                $this->PASIEN_DIAGNOSA_ID->setSort("");
                $this->NO_REGISTRATION->setSort("");
                $this->THENAME->setSort("");
                $this->VISIT_ID->setSort("");
                $this->CLINIC_ID->setSort("");
                $this->BILL_ID->setSort("");
                $this->CLASS_ROOM_ID->setSort("");
                $this->IN_DATE->setSort("");
                $this->EXIT_DATE->setSort("");
                $this->BED_ID->setSort("");
                $this->KELUAR_ID->setSort("");
                $this->DATE_OF_DIAGNOSA->setSort("");
                $this->REPORT_DATE->setSort("");
                $this->DIAGNOSA_ID->setSort("");
                $this->DIAGNOSA_DESC->setSort("");
                $this->ANAMNASE->setSort("");
                $this->PEMERIKSAAN->setSort("");
                $this->TERAPHY_DESC->setSort("");
                $this->INSTRUCTION->setSort("");
                $this->SUFFER_TYPE->setSort("");
                $this->INFECTED_BODY->setSort("");
                $this->EMPLOYEE_ID->setSort("");
                $this->RISK_LEVEL->setSort("");
                $this->MORFOLOGI_NEOPLASMA->setSort("");
                $this->HURT->setSort("");
                $this->HURT_TYPE->setSort("");
                $this->DIAG_CAT->setSort("");
                $this->ADDICTION_MATERIAL->setSort("");
                $this->INFECTED_QUANTITY->setSort("");
                $this->CONTAGIOUS_TYPE->setSort("");
                $this->CURATIF_ID->setSort("");
                $this->RESULT_ID->setSort("");
                $this->INFECTION_TYPE->setSort("");
                $this->INVESTIGATION_ID->setSort("");
                $this->DISABILITY->setSort("");
                $this->DESCRIPTION->setSort("");
                $this->KOMPLIKASI->setSort("");
                $this->MODIFIED_DATE->setSort("");
                $this->MODIFIED_BY->setSort("");
                $this->MODIFIED_FROM->setSort("");
                $this->STATUS_PASIEN_ID->setSort("");
                $this->AGEYEAR->setSort("");
                $this->AGEMONTH->setSort("");
                $this->AGEDAY->setSort("");
                $this->THEADDRESS->setSort("");
                $this->THEID->setSort("");
                $this->ISRJ->setSort("");
                $this->GENDER->setSort("");
                $this->DOCTOR->setSort("");
                $this->KAL_ID->setSort("");
                $this->ACCOUNT_ID->setSort("");
                $this->DIAGNOSA_ID_02->setSort("");
                $this->DIAGNOSA_ID_03->setSort("");
                $this->DIAGNOSA_ID_04->setSort("");
                $this->DIAGNOSA_ID_05->setSort("");
                $this->DIAGNOSA_ID_06->setSort("");
                $this->DIAGNOSA_ID_07->setSort("");
                $this->DIAGNOSA_ID_08->setSort("");
                $this->DIAGNOSA_ID_09->setSort("");
                $this->DIAGNOSA_ID_10->setSort("");
                $this->PROCEDURE_01->setSort("");
                $this->PROCEDURE_02->setSort("");
                $this->PROCEDURE_03->setSort("");
                $this->PROCEDURE_04->setSort("");
                $this->PROCEDURE_05->setSort("");
                $this->PROCEDURE_06->setSort("");
                $this->PROCEDURE_07->setSort("");
                $this->PROCEDURE_08->setSort("");
                $this->PROCEDURE_09->setSort("");
                $this->PROCEDURE_10->setSort("");
                $this->DIAGNOSA_ID2->setSort("");
                $this->WEIGHT->setSort("");
                $this->NOKARTU->setSort("");
                $this->NOSEP->setSort("");
                $this->TGLSEP->setSort("");
                $this->RENCANATL->setSort("");
                $this->DIRUJUKKE->setSort("");
                $this->TGLKONTROL->setSort("");
                $this->KDPOLI_KONTROL->setSort("");
                $this->JAMINAN->setSort("");
                $this->SPESIALISTIK->setSort("");
                $this->PEMERIKSAAN_02->setSort("");
                $this->DIAGNOSA_DESC_02->setSort("");
                $this->DIAGNOSA_DESC_03->setSort("");
                $this->DIAGNOSA_DESC_04->setSort("");
                $this->DIAGNOSA_DESC_05->setSort("");
                $this->DIAGNOSA_DESC_06->setSort("");
                $this->PROCEDURE_DESC_01->setSort("");
                $this->PROCEDURE_DESC_02->setSort("");
                $this->PROCEDURE_DESC_03->setSort("");
                $this->PROCEDURE_DESC_04->setSort("");
                $this->PROCEDURE_DESC_05->setSort("");
                $this->RESPONPOST->setSort("");
                $this->RESPONPUT->setSort("");
                $this->RESPONDEL->setSort("");
                $this->JSONPOST->setSort("");
                $this->JSONPUT->setSort("");
                $this->JSONDEL->setSort("");
                $this->height->setSort("");
                $this->TEMPERATURE->setSort("");
                $this->TENSION_UPPER->setSort("");
                $this->TENSION_BELOW->setSort("");
                $this->NADI->setSort("");
                $this->NAFAS->setSort("");
                $this->spec_procedures->setSort("");
                $this->spec_drug->setSort("");
                $this->spec_prothesis->setSort("");
                $this->spec_investigation->setSort("");
                $this->procedure_11->setSort("");
                $this->procedure_12->setSort("");
                $this->procedure_13->setSort("");
                $this->procedure_14->setSort("");
                $this->procedure_15->setSort("");
                $this->isanestesi->setSort("");
                $this->isreposisi->setSort("");
                $this->islab->setSort("");
                $this->isro->setSort("");
                $this->isekg->setSort("");
                $this->ishecting->setSort("");
                $this->isgips->setSort("");
                $this->islengkap->setSort("");
                $this->ID->setSort("");
                $this->IDXDAFTAR->setSort("");
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

        // "delete"
        $item = &$this->ListOptions->add("delete");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canDelete();
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

            // "delete"
            $opt = $this->ListOptions["delete"];
            if ($Security->canDelete()) {
            $opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("DeleteLink") . "</a>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fPASIEN_DIAGNOSAlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fPASIEN_DIAGNOSAlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fPASIEN_DIAGNOSAlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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

        // PASIEN_DIAGNOSA_ID
        if (!$this->isAddOrEdit() && $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PASIEN_DIAGNOSA_ID->AdvancedSearch->SearchValue != "" || $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // THENAME
        if (!$this->isAddOrEdit() && $this->THENAME->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->THENAME->AdvancedSearch->SearchValue != "" || $this->THENAME->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // VISIT_ID
        if (!$this->isAddOrEdit() && $this->VISIT_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->VISIT_ID->AdvancedSearch->SearchValue != "" || $this->VISIT_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // CLINIC_ID
        if (!$this->isAddOrEdit() && $this->CLINIC_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->CLINIC_ID->AdvancedSearch->SearchValue != "" || $this->CLINIC_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // BILL_ID
        if (!$this->isAddOrEdit() && $this->BILL_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->BILL_ID->AdvancedSearch->SearchValue != "" || $this->BILL_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // CLASS_ROOM_ID
        if (!$this->isAddOrEdit() && $this->CLASS_ROOM_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->CLASS_ROOM_ID->AdvancedSearch->SearchValue != "" || $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // IN_DATE
        if (!$this->isAddOrEdit() && $this->IN_DATE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->IN_DATE->AdvancedSearch->SearchValue != "" || $this->IN_DATE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // EXIT_DATE
        if (!$this->isAddOrEdit() && $this->EXIT_DATE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->EXIT_DATE->AdvancedSearch->SearchValue != "" || $this->EXIT_DATE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // BED_ID
        if (!$this->isAddOrEdit() && $this->BED_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->BED_ID->AdvancedSearch->SearchValue != "" || $this->BED_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // KELUAR_ID
        if (!$this->isAddOrEdit() && $this->KELUAR_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->KELUAR_ID->AdvancedSearch->SearchValue != "" || $this->KELUAR_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DATE_OF_DIAGNOSA
        if (!$this->isAddOrEdit() && $this->DATE_OF_DIAGNOSA->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DATE_OF_DIAGNOSA->AdvancedSearch->SearchValue != "" || $this->DATE_OF_DIAGNOSA->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // REPORT_DATE
        if (!$this->isAddOrEdit() && $this->REPORT_DATE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->REPORT_DATE->AdvancedSearch->SearchValue != "" || $this->REPORT_DATE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_DESC
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_DESC->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_DESC->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_DESC->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ANAMNASE
        if (!$this->isAddOrEdit() && $this->ANAMNASE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ANAMNASE->AdvancedSearch->SearchValue != "" || $this->ANAMNASE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PEMERIKSAAN
        if (!$this->isAddOrEdit() && $this->PEMERIKSAAN->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PEMERIKSAAN->AdvancedSearch->SearchValue != "" || $this->PEMERIKSAAN->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // TERAPHY_DESC
        if (!$this->isAddOrEdit() && $this->TERAPHY_DESC->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->TERAPHY_DESC->AdvancedSearch->SearchValue != "" || $this->TERAPHY_DESC->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // INSTRUCTION
        if (!$this->isAddOrEdit() && $this->INSTRUCTION->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->INSTRUCTION->AdvancedSearch->SearchValue != "" || $this->INSTRUCTION->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // SUFFER_TYPE
        if (!$this->isAddOrEdit() && $this->SUFFER_TYPE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->SUFFER_TYPE->AdvancedSearch->SearchValue != "" || $this->SUFFER_TYPE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // INFECTED_BODY
        if (!$this->isAddOrEdit() && $this->INFECTED_BODY->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->INFECTED_BODY->AdvancedSearch->SearchValue != "" || $this->INFECTED_BODY->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // RISK_LEVEL
        if (!$this->isAddOrEdit() && $this->RISK_LEVEL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->RISK_LEVEL->AdvancedSearch->SearchValue != "" || $this->RISK_LEVEL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // MORFOLOGI_NEOPLASMA
        if (!$this->isAddOrEdit() && $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->MORFOLOGI_NEOPLASMA->AdvancedSearch->SearchValue != "" || $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // HURT
        if (!$this->isAddOrEdit() && $this->HURT->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->HURT->AdvancedSearch->SearchValue != "" || $this->HURT->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // HURT_TYPE
        if (!$this->isAddOrEdit() && $this->HURT_TYPE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->HURT_TYPE->AdvancedSearch->SearchValue != "" || $this->HURT_TYPE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAG_CAT
        if (!$this->isAddOrEdit() && $this->DIAG_CAT->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAG_CAT->AdvancedSearch->SearchValue != "" || $this->DIAG_CAT->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ADDICTION_MATERIAL
        if (!$this->isAddOrEdit() && $this->ADDICTION_MATERIAL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ADDICTION_MATERIAL->AdvancedSearch->SearchValue != "" || $this->ADDICTION_MATERIAL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // INFECTED_QUANTITY
        if (!$this->isAddOrEdit() && $this->INFECTED_QUANTITY->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->INFECTED_QUANTITY->AdvancedSearch->SearchValue != "" || $this->INFECTED_QUANTITY->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // CONTAGIOUS_TYPE
        if (!$this->isAddOrEdit() && $this->CONTAGIOUS_TYPE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->CONTAGIOUS_TYPE->AdvancedSearch->SearchValue != "" || $this->CONTAGIOUS_TYPE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // CURATIF_ID
        if (!$this->isAddOrEdit() && $this->CURATIF_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->CURATIF_ID->AdvancedSearch->SearchValue != "" || $this->CURATIF_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // RESULT_ID
        if (!$this->isAddOrEdit() && $this->RESULT_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->RESULT_ID->AdvancedSearch->SearchValue != "" || $this->RESULT_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // INFECTION_TYPE
        if (!$this->isAddOrEdit() && $this->INFECTION_TYPE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->INFECTION_TYPE->AdvancedSearch->SearchValue != "" || $this->INFECTION_TYPE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // INVESTIGATION_ID
        if (!$this->isAddOrEdit() && $this->INVESTIGATION_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->INVESTIGATION_ID->AdvancedSearch->SearchValue != "" || $this->INVESTIGATION_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DISABILITY
        if (!$this->isAddOrEdit() && $this->DISABILITY->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DISABILITY->AdvancedSearch->SearchValue != "" || $this->DISABILITY->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // KOMPLIKASI
        if (!$this->isAddOrEdit() && $this->KOMPLIKASI->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->KOMPLIKASI->AdvancedSearch->SearchValue != "" || $this->KOMPLIKASI->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // STATUS_PASIEN_ID
        if (!$this->isAddOrEdit() && $this->STATUS_PASIEN_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue != "" || $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // AGEYEAR
        if (!$this->isAddOrEdit() && $this->AGEYEAR->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->AGEYEAR->AdvancedSearch->SearchValue != "" || $this->AGEYEAR->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // AGEMONTH
        if (!$this->isAddOrEdit() && $this->AGEMONTH->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->AGEMONTH->AdvancedSearch->SearchValue != "" || $this->AGEMONTH->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // AGEDAY
        if (!$this->isAddOrEdit() && $this->AGEDAY->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->AGEDAY->AdvancedSearch->SearchValue != "" || $this->AGEDAY->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // THEADDRESS
        if (!$this->isAddOrEdit() && $this->THEADDRESS->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->THEADDRESS->AdvancedSearch->SearchValue != "" || $this->THEADDRESS->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // THEID
        if (!$this->isAddOrEdit() && $this->THEID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->THEID->AdvancedSearch->SearchValue != "" || $this->THEID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ISRJ
        if (!$this->isAddOrEdit() && $this->ISRJ->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ISRJ->AdvancedSearch->SearchValue != "" || $this->ISRJ->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // DOCTOR
        if (!$this->isAddOrEdit() && $this->DOCTOR->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DOCTOR->AdvancedSearch->SearchValue != "" || $this->DOCTOR->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // ACCOUNT_ID
        if (!$this->isAddOrEdit() && $this->ACCOUNT_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ACCOUNT_ID->AdvancedSearch->SearchValue != "" || $this->ACCOUNT_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_02
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_02->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_02->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_02->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_03
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_03->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_03->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_03->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_04
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_04->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_04->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_04->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_05
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_05->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_05->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_05->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_06
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_06->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_06->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_06->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_07
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_07->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_07->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_07->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_08
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_08->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_08->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_08->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_09
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_09->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_09->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_09->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID_10
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID_10->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID_10->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID_10->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_01
        if (!$this->isAddOrEdit() && $this->PROCEDURE_01->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_01->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_01->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_02
        if (!$this->isAddOrEdit() && $this->PROCEDURE_02->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_02->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_02->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_03
        if (!$this->isAddOrEdit() && $this->PROCEDURE_03->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_03->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_03->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_04
        if (!$this->isAddOrEdit() && $this->PROCEDURE_04->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_04->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_04->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_05
        if (!$this->isAddOrEdit() && $this->PROCEDURE_05->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_05->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_05->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_06
        if (!$this->isAddOrEdit() && $this->PROCEDURE_06->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_06->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_06->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_07
        if (!$this->isAddOrEdit() && $this->PROCEDURE_07->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_07->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_07->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_08
        if (!$this->isAddOrEdit() && $this->PROCEDURE_08->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_08->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_08->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_09
        if (!$this->isAddOrEdit() && $this->PROCEDURE_09->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_09->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_09->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_10
        if (!$this->isAddOrEdit() && $this->PROCEDURE_10->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_10->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_10->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_ID2
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_ID2->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_ID2->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_ID2->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // WEIGHT
        if (!$this->isAddOrEdit() && $this->WEIGHT->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->WEIGHT->AdvancedSearch->SearchValue != "" || $this->WEIGHT->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // NOKARTU
        if (!$this->isAddOrEdit() && $this->NOKARTU->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->NOKARTU->AdvancedSearch->SearchValue != "" || $this->NOKARTU->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // NOSEP
        if (!$this->isAddOrEdit() && $this->NOSEP->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->NOSEP->AdvancedSearch->SearchValue != "" || $this->NOSEP->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // TGLSEP
        if (!$this->isAddOrEdit() && $this->TGLSEP->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->TGLSEP->AdvancedSearch->SearchValue != "" || $this->TGLSEP->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // RENCANATL
        if (!$this->isAddOrEdit() && $this->RENCANATL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->RENCANATL->AdvancedSearch->SearchValue != "" || $this->RENCANATL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIRUJUKKE
        if (!$this->isAddOrEdit() && $this->DIRUJUKKE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIRUJUKKE->AdvancedSearch->SearchValue != "" || $this->DIRUJUKKE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // TGLKONTROL
        if (!$this->isAddOrEdit() && $this->TGLKONTROL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->TGLKONTROL->AdvancedSearch->SearchValue != "" || $this->TGLKONTROL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // KDPOLI_KONTROL
        if (!$this->isAddOrEdit() && $this->KDPOLI_KONTROL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->KDPOLI_KONTROL->AdvancedSearch->SearchValue != "" || $this->KDPOLI_KONTROL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // JAMINAN
        if (!$this->isAddOrEdit() && $this->JAMINAN->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->JAMINAN->AdvancedSearch->SearchValue != "" || $this->JAMINAN->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // SPESIALISTIK
        if (!$this->isAddOrEdit() && $this->SPESIALISTIK->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->SPESIALISTIK->AdvancedSearch->SearchValue != "" || $this->SPESIALISTIK->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PEMERIKSAAN_02
        if (!$this->isAddOrEdit() && $this->PEMERIKSAAN_02->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PEMERIKSAAN_02->AdvancedSearch->SearchValue != "" || $this->PEMERIKSAAN_02->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_DESC_02
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_DESC_02->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_DESC_02->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_DESC_02->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_DESC_03
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_DESC_03->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_DESC_03->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_DESC_03->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_DESC_04
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_DESC_04->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_DESC_04->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_DESC_04->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_DESC_05
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_DESC_05->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_DESC_05->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_DESC_05->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // DIAGNOSA_DESC_06
        if (!$this->isAddOrEdit() && $this->DIAGNOSA_DESC_06->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->DIAGNOSA_DESC_06->AdvancedSearch->SearchValue != "" || $this->DIAGNOSA_DESC_06->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_DESC_01
        if (!$this->isAddOrEdit() && $this->PROCEDURE_DESC_01->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_DESC_01->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_DESC_01->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_DESC_02
        if (!$this->isAddOrEdit() && $this->PROCEDURE_DESC_02->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_DESC_02->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_DESC_02->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_DESC_03
        if (!$this->isAddOrEdit() && $this->PROCEDURE_DESC_03->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_DESC_03->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_DESC_03->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_DESC_04
        if (!$this->isAddOrEdit() && $this->PROCEDURE_DESC_04->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_DESC_04->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_DESC_04->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // PROCEDURE_DESC_05
        if (!$this->isAddOrEdit() && $this->PROCEDURE_DESC_05->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->PROCEDURE_DESC_05->AdvancedSearch->SearchValue != "" || $this->PROCEDURE_DESC_05->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // RESPONPOST
        if (!$this->isAddOrEdit() && $this->RESPONPOST->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->RESPONPOST->AdvancedSearch->SearchValue != "" || $this->RESPONPOST->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // RESPONPUT
        if (!$this->isAddOrEdit() && $this->RESPONPUT->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->RESPONPUT->AdvancedSearch->SearchValue != "" || $this->RESPONPUT->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // RESPONDEL
        if (!$this->isAddOrEdit() && $this->RESPONDEL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->RESPONDEL->AdvancedSearch->SearchValue != "" || $this->RESPONDEL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // JSONPOST
        if (!$this->isAddOrEdit() && $this->JSONPOST->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->JSONPOST->AdvancedSearch->SearchValue != "" || $this->JSONPOST->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // JSONPUT
        if (!$this->isAddOrEdit() && $this->JSONPUT->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->JSONPUT->AdvancedSearch->SearchValue != "" || $this->JSONPUT->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // JSONDEL
        if (!$this->isAddOrEdit() && $this->JSONDEL->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->JSONDEL->AdvancedSearch->SearchValue != "" || $this->JSONDEL->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // height
        if (!$this->isAddOrEdit() && $this->height->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->height->AdvancedSearch->SearchValue != "" || $this->height->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // TEMPERATURE
        if (!$this->isAddOrEdit() && $this->TEMPERATURE->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->TEMPERATURE->AdvancedSearch->SearchValue != "" || $this->TEMPERATURE->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // TENSION_UPPER
        if (!$this->isAddOrEdit() && $this->TENSION_UPPER->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->TENSION_UPPER->AdvancedSearch->SearchValue != "" || $this->TENSION_UPPER->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // TENSION_BELOW
        if (!$this->isAddOrEdit() && $this->TENSION_BELOW->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->TENSION_BELOW->AdvancedSearch->SearchValue != "" || $this->TENSION_BELOW->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // NADI
        if (!$this->isAddOrEdit() && $this->NADI->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->NADI->AdvancedSearch->SearchValue != "" || $this->NADI->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // NAFAS
        if (!$this->isAddOrEdit() && $this->NAFAS->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->NAFAS->AdvancedSearch->SearchValue != "" || $this->NAFAS->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // spec_procedures
        if (!$this->isAddOrEdit() && $this->spec_procedures->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->spec_procedures->AdvancedSearch->SearchValue != "" || $this->spec_procedures->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // spec_drug
        if (!$this->isAddOrEdit() && $this->spec_drug->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->spec_drug->AdvancedSearch->SearchValue != "" || $this->spec_drug->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // spec_prothesis
        if (!$this->isAddOrEdit() && $this->spec_prothesis->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->spec_prothesis->AdvancedSearch->SearchValue != "" || $this->spec_prothesis->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // spec_investigation
        if (!$this->isAddOrEdit() && $this->spec_investigation->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->spec_investigation->AdvancedSearch->SearchValue != "" || $this->spec_investigation->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // procedure_11
        if (!$this->isAddOrEdit() && $this->procedure_11->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->procedure_11->AdvancedSearch->SearchValue != "" || $this->procedure_11->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // procedure_12
        if (!$this->isAddOrEdit() && $this->procedure_12->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->procedure_12->AdvancedSearch->SearchValue != "" || $this->procedure_12->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // procedure_13
        if (!$this->isAddOrEdit() && $this->procedure_13->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->procedure_13->AdvancedSearch->SearchValue != "" || $this->procedure_13->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // procedure_14
        if (!$this->isAddOrEdit() && $this->procedure_14->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->procedure_14->AdvancedSearch->SearchValue != "" || $this->procedure_14->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // procedure_15
        if (!$this->isAddOrEdit() && $this->procedure_15->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->procedure_15->AdvancedSearch->SearchValue != "" || $this->procedure_15->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // isanestesi
        if (!$this->isAddOrEdit() && $this->isanestesi->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->isanestesi->AdvancedSearch->SearchValue != "" || $this->isanestesi->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // isreposisi
        if (!$this->isAddOrEdit() && $this->isreposisi->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->isreposisi->AdvancedSearch->SearchValue != "" || $this->isreposisi->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // islab
        if (!$this->isAddOrEdit() && $this->islab->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->islab->AdvancedSearch->SearchValue != "" || $this->islab->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // isro
        if (!$this->isAddOrEdit() && $this->isro->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->isro->AdvancedSearch->SearchValue != "" || $this->isro->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // isekg
        if (!$this->isAddOrEdit() && $this->isekg->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->isekg->AdvancedSearch->SearchValue != "" || $this->isekg->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // ishecting
        if (!$this->isAddOrEdit() && $this->ishecting->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->ishecting->AdvancedSearch->SearchValue != "" || $this->ishecting->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // isgips
        if (!$this->isAddOrEdit() && $this->isgips->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->isgips->AdvancedSearch->SearchValue != "" || $this->isgips->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // islengkap
        if (!$this->isAddOrEdit() && $this->islengkap->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->islengkap->AdvancedSearch->SearchValue != "" || $this->islengkap->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // IDXDAFTAR
        if (!$this->isAddOrEdit() && $this->IDXDAFTAR->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->IDXDAFTAR->AdvancedSearch->SearchValue != "" || $this->IDXDAFTAR->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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
        $row = [];
        $row['ORG_UNIT_CODE'] = null;
        $row['PASIEN_DIAGNOSA_ID'] = null;
        $row['NO_REGISTRATION'] = null;
        $row['THENAME'] = null;
        $row['VISIT_ID'] = null;
        $row['CLINIC_ID'] = null;
        $row['BILL_ID'] = null;
        $row['CLASS_ROOM_ID'] = null;
        $row['IN_DATE'] = null;
        $row['EXIT_DATE'] = null;
        $row['BED_ID'] = null;
        $row['KELUAR_ID'] = null;
        $row['DATE_OF_DIAGNOSA'] = null;
        $row['REPORT_DATE'] = null;
        $row['DIAGNOSA_ID'] = null;
        $row['DIAGNOSA_DESC'] = null;
        $row['ANAMNASE'] = null;
        $row['PEMERIKSAAN'] = null;
        $row['TERAPHY_DESC'] = null;
        $row['INSTRUCTION'] = null;
        $row['SUFFER_TYPE'] = null;
        $row['INFECTED_BODY'] = null;
        $row['EMPLOYEE_ID'] = null;
        $row['RISK_LEVEL'] = null;
        $row['MORFOLOGI_NEOPLASMA'] = null;
        $row['HURT'] = null;
        $row['HURT_TYPE'] = null;
        $row['DIAG_CAT'] = null;
        $row['ADDICTION_MATERIAL'] = null;
        $row['INFECTED_QUANTITY'] = null;
        $row['CONTAGIOUS_TYPE'] = null;
        $row['CURATIF_ID'] = null;
        $row['RESULT_ID'] = null;
        $row['INFECTION_TYPE'] = null;
        $row['INVESTIGATION_ID'] = null;
        $row['DISABILITY'] = null;
        $row['DESCRIPTION'] = null;
        $row['KOMPLIKASI'] = null;
        $row['MODIFIED_DATE'] = null;
        $row['MODIFIED_BY'] = null;
        $row['MODIFIED_FROM'] = null;
        $row['STATUS_PASIEN_ID'] = null;
        $row['AGEYEAR'] = null;
        $row['AGEMONTH'] = null;
        $row['AGEDAY'] = null;
        $row['THEADDRESS'] = null;
        $row['THEID'] = null;
        $row['ISRJ'] = null;
        $row['GENDER'] = null;
        $row['DOCTOR'] = null;
        $row['KAL_ID'] = null;
        $row['ACCOUNT_ID'] = null;
        $row['DIAGNOSA_ID_02'] = null;
        $row['DIAGNOSA_ID_03'] = null;
        $row['DIAGNOSA_ID_04'] = null;
        $row['DIAGNOSA_ID_05'] = null;
        $row['DIAGNOSA_ID_06'] = null;
        $row['DIAGNOSA_ID_07'] = null;
        $row['DIAGNOSA_ID_08'] = null;
        $row['DIAGNOSA_ID_09'] = null;
        $row['DIAGNOSA_ID_10'] = null;
        $row['PROCEDURE_01'] = null;
        $row['PROCEDURE_02'] = null;
        $row['PROCEDURE_03'] = null;
        $row['PROCEDURE_04'] = null;
        $row['PROCEDURE_05'] = null;
        $row['PROCEDURE_06'] = null;
        $row['PROCEDURE_07'] = null;
        $row['PROCEDURE_08'] = null;
        $row['PROCEDURE_09'] = null;
        $row['PROCEDURE_10'] = null;
        $row['DIAGNOSA_ID2'] = null;
        $row['WEIGHT'] = null;
        $row['NOKARTU'] = null;
        $row['NOSEP'] = null;
        $row['TGLSEP'] = null;
        $row['RENCANATL'] = null;
        $row['DIRUJUKKE'] = null;
        $row['TGLKONTROL'] = null;
        $row['KDPOLI_KONTROL'] = null;
        $row['JAMINAN'] = null;
        $row['SPESIALISTIK'] = null;
        $row['PEMERIKSAAN_02'] = null;
        $row['DIAGNOSA_DESC_02'] = null;
        $row['DIAGNOSA_DESC_03'] = null;
        $row['DIAGNOSA_DESC_04'] = null;
        $row['DIAGNOSA_DESC_05'] = null;
        $row['DIAGNOSA_DESC_06'] = null;
        $row['PROCEDURE_DESC_01'] = null;
        $row['PROCEDURE_DESC_02'] = null;
        $row['PROCEDURE_DESC_03'] = null;
        $row['PROCEDURE_DESC_04'] = null;
        $row['PROCEDURE_DESC_05'] = null;
        $row['RESPONPOST'] = null;
        $row['RESPONPUT'] = null;
        $row['RESPONDEL'] = null;
        $row['JSONPOST'] = null;
        $row['JSONPUT'] = null;
        $row['JSONDEL'] = null;
        $row['height'] = null;
        $row['TEMPERATURE'] = null;
        $row['TENSION_UPPER'] = null;
        $row['TENSION_BELOW'] = null;
        $row['NADI'] = null;
        $row['NAFAS'] = null;
        $row['spec_procedures'] = null;
        $row['spec_drug'] = null;
        $row['spec_prothesis'] = null;
        $row['spec_investigation'] = null;
        $row['procedure_11'] = null;
        $row['procedure_12'] = null;
        $row['procedure_13'] = null;
        $row['procedure_14'] = null;
        $row['procedure_15'] = null;
        $row['isanestesi'] = null;
        $row['isreposisi'] = null;
        $row['islab'] = null;
        $row['isro'] = null;
        $row['isekg'] = null;
        $row['ishecting'] = null;
        $row['isgips'] = null;
        $row['islengkap'] = null;
        $row['ID'] = null;
        $row['IDXDAFTAR'] = null;
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
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // DATE_OF_DIAGNOSA
            $this->DATE_OF_DIAGNOSA->EditAttrs["class"] = "form-control";
            $this->DATE_OF_DIAGNOSA->EditCustomAttributes = "";
            $this->DATE_OF_DIAGNOSA->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->DATE_OF_DIAGNOSA->AdvancedSearch->SearchValue, 11), 11));
            $this->DATE_OF_DIAGNOSA->PlaceHolder = RemoveHtml($this->DATE_OF_DIAGNOSA->caption());

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->DIAGNOSA_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID->AdvancedSearch->ViewValue = $this->DIAGNOSA_ID->lookupCacheOption($curVal);
            } else {
                $this->DIAGNOSA_ID->AdvancedSearch->ViewValue = $this->DIAGNOSA_ID->Lookup !== null && is_array($this->DIAGNOSA_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->DIAGNOSA_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->DIAGNOSA_ID->EditValue = array_values($this->DIAGNOSA_ID->Lookup->Options);
                if ($this->DIAGNOSA_ID->AdvancedSearch->ViewValue == "") {
                    $this->DIAGNOSA_ID->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DIAGNOSA_ID->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DIAGNOSA_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID->AdvancedSearch->ViewValue = $this->DIAGNOSA_ID->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DIAGNOSA_ID->EditValue = $arwrk;
            }
            $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

            // ANAMNASE
            $this->ANAMNASE->EditAttrs["class"] = "form-control";
            $this->ANAMNASE->EditCustomAttributes = "";
            $this->ANAMNASE->EditValue = HtmlEncode($this->ANAMNASE->AdvancedSearch->SearchValue);
            $this->ANAMNASE->PlaceHolder = RemoveHtml($this->ANAMNASE->caption());

            // PEMERIKSAAN
            $this->PEMERIKSAAN->EditAttrs["class"] = "form-control";
            $this->PEMERIKSAAN->EditCustomAttributes = "";
            if (!$this->PEMERIKSAAN->Raw) {
                $this->PEMERIKSAAN->AdvancedSearch->SearchValue = HtmlDecode($this->PEMERIKSAAN->AdvancedSearch->SearchValue);
            }
            $this->PEMERIKSAAN->EditValue = HtmlEncode($this->PEMERIKSAAN->AdvancedSearch->SearchValue);
            $this->PEMERIKSAAN->PlaceHolder = RemoveHtml($this->PEMERIKSAAN->caption());

            // TERAPHY_DESC
            $this->TERAPHY_DESC->EditAttrs["class"] = "form-control";
            $this->TERAPHY_DESC->EditCustomAttributes = "";
            if (!$this->TERAPHY_DESC->Raw) {
                $this->TERAPHY_DESC->AdvancedSearch->SearchValue = HtmlDecode($this->TERAPHY_DESC->AdvancedSearch->SearchValue);
            }
            $this->TERAPHY_DESC->EditValue = HtmlEncode($this->TERAPHY_DESC->AdvancedSearch->SearchValue);
            $this->TERAPHY_DESC->PlaceHolder = RemoveHtml($this->TERAPHY_DESC->caption());

            // TGLKONTROL
            $this->TGLKONTROL->EditAttrs["class"] = "form-control";
            $this->TGLKONTROL->EditCustomAttributes = "";
            $this->TGLKONTROL->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->TGLKONTROL->AdvancedSearch->SearchValue, 0), 8));
            $this->TGLKONTROL->PlaceHolder = RemoveHtml($this->TGLKONTROL->caption());

            // IDXDAFTAR
            $this->IDXDAFTAR->EditAttrs["class"] = "form-control";
            $this->IDXDAFTAR->EditCustomAttributes = "";
            $this->IDXDAFTAR->EditValue = HtmlEncode($this->IDXDAFTAR->AdvancedSearch->SearchValue);
            $this->IDXDAFTAR->PlaceHolder = RemoveHtml($this->IDXDAFTAR->caption());
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
        $this->PASIEN_DIAGNOSA_ID->AdvancedSearch->load();
        $this->NO_REGISTRATION->AdvancedSearch->load();
        $this->THENAME->AdvancedSearch->load();
        $this->VISIT_ID->AdvancedSearch->load();
        $this->CLINIC_ID->AdvancedSearch->load();
        $this->BILL_ID->AdvancedSearch->load();
        $this->CLASS_ROOM_ID->AdvancedSearch->load();
        $this->IN_DATE->AdvancedSearch->load();
        $this->EXIT_DATE->AdvancedSearch->load();
        $this->BED_ID->AdvancedSearch->load();
        $this->KELUAR_ID->AdvancedSearch->load();
        $this->DATE_OF_DIAGNOSA->AdvancedSearch->load();
        $this->REPORT_DATE->AdvancedSearch->load();
        $this->DIAGNOSA_ID->AdvancedSearch->load();
        $this->DIAGNOSA_DESC->AdvancedSearch->load();
        $this->ANAMNASE->AdvancedSearch->load();
        $this->PEMERIKSAAN->AdvancedSearch->load();
        $this->TERAPHY_DESC->AdvancedSearch->load();
        $this->INSTRUCTION->AdvancedSearch->load();
        $this->SUFFER_TYPE->AdvancedSearch->load();
        $this->INFECTED_BODY->AdvancedSearch->load();
        $this->EMPLOYEE_ID->AdvancedSearch->load();
        $this->RISK_LEVEL->AdvancedSearch->load();
        $this->MORFOLOGI_NEOPLASMA->AdvancedSearch->load();
        $this->HURT->AdvancedSearch->load();
        $this->HURT_TYPE->AdvancedSearch->load();
        $this->DIAG_CAT->AdvancedSearch->load();
        $this->ADDICTION_MATERIAL->AdvancedSearch->load();
        $this->INFECTED_QUANTITY->AdvancedSearch->load();
        $this->CONTAGIOUS_TYPE->AdvancedSearch->load();
        $this->CURATIF_ID->AdvancedSearch->load();
        $this->RESULT_ID->AdvancedSearch->load();
        $this->INFECTION_TYPE->AdvancedSearch->load();
        $this->INVESTIGATION_ID->AdvancedSearch->load();
        $this->DISABILITY->AdvancedSearch->load();
        $this->DESCRIPTION->AdvancedSearch->load();
        $this->KOMPLIKASI->AdvancedSearch->load();
        $this->MODIFIED_DATE->AdvancedSearch->load();
        $this->MODIFIED_BY->AdvancedSearch->load();
        $this->MODIFIED_FROM->AdvancedSearch->load();
        $this->STATUS_PASIEN_ID->AdvancedSearch->load();
        $this->AGEYEAR->AdvancedSearch->load();
        $this->AGEMONTH->AdvancedSearch->load();
        $this->AGEDAY->AdvancedSearch->load();
        $this->THEADDRESS->AdvancedSearch->load();
        $this->THEID->AdvancedSearch->load();
        $this->ISRJ->AdvancedSearch->load();
        $this->GENDER->AdvancedSearch->load();
        $this->DOCTOR->AdvancedSearch->load();
        $this->KAL_ID->AdvancedSearch->load();
        $this->ACCOUNT_ID->AdvancedSearch->load();
        $this->DIAGNOSA_ID_02->AdvancedSearch->load();
        $this->DIAGNOSA_ID_03->AdvancedSearch->load();
        $this->DIAGNOSA_ID_04->AdvancedSearch->load();
        $this->DIAGNOSA_ID_05->AdvancedSearch->load();
        $this->DIAGNOSA_ID_06->AdvancedSearch->load();
        $this->DIAGNOSA_ID_07->AdvancedSearch->load();
        $this->DIAGNOSA_ID_08->AdvancedSearch->load();
        $this->DIAGNOSA_ID_09->AdvancedSearch->load();
        $this->DIAGNOSA_ID_10->AdvancedSearch->load();
        $this->PROCEDURE_01->AdvancedSearch->load();
        $this->PROCEDURE_02->AdvancedSearch->load();
        $this->PROCEDURE_03->AdvancedSearch->load();
        $this->PROCEDURE_04->AdvancedSearch->load();
        $this->PROCEDURE_05->AdvancedSearch->load();
        $this->PROCEDURE_06->AdvancedSearch->load();
        $this->PROCEDURE_07->AdvancedSearch->load();
        $this->PROCEDURE_08->AdvancedSearch->load();
        $this->PROCEDURE_09->AdvancedSearch->load();
        $this->PROCEDURE_10->AdvancedSearch->load();
        $this->DIAGNOSA_ID2->AdvancedSearch->load();
        $this->WEIGHT->AdvancedSearch->load();
        $this->NOKARTU->AdvancedSearch->load();
        $this->NOSEP->AdvancedSearch->load();
        $this->TGLSEP->AdvancedSearch->load();
        $this->RENCANATL->AdvancedSearch->load();
        $this->DIRUJUKKE->AdvancedSearch->load();
        $this->TGLKONTROL->AdvancedSearch->load();
        $this->KDPOLI_KONTROL->AdvancedSearch->load();
        $this->JAMINAN->AdvancedSearch->load();
        $this->SPESIALISTIK->AdvancedSearch->load();
        $this->PEMERIKSAAN_02->AdvancedSearch->load();
        $this->DIAGNOSA_DESC_02->AdvancedSearch->load();
        $this->DIAGNOSA_DESC_03->AdvancedSearch->load();
        $this->DIAGNOSA_DESC_04->AdvancedSearch->load();
        $this->DIAGNOSA_DESC_05->AdvancedSearch->load();
        $this->DIAGNOSA_DESC_06->AdvancedSearch->load();
        $this->PROCEDURE_DESC_01->AdvancedSearch->load();
        $this->PROCEDURE_DESC_02->AdvancedSearch->load();
        $this->PROCEDURE_DESC_03->AdvancedSearch->load();
        $this->PROCEDURE_DESC_04->AdvancedSearch->load();
        $this->PROCEDURE_DESC_05->AdvancedSearch->load();
        $this->RESPONPOST->AdvancedSearch->load();
        $this->RESPONPUT->AdvancedSearch->load();
        $this->RESPONDEL->AdvancedSearch->load();
        $this->JSONPOST->AdvancedSearch->load();
        $this->JSONPUT->AdvancedSearch->load();
        $this->JSONDEL->AdvancedSearch->load();
        $this->height->AdvancedSearch->load();
        $this->TEMPERATURE->AdvancedSearch->load();
        $this->TENSION_UPPER->AdvancedSearch->load();
        $this->TENSION_BELOW->AdvancedSearch->load();
        $this->NADI->AdvancedSearch->load();
        $this->NAFAS->AdvancedSearch->load();
        $this->spec_procedures->AdvancedSearch->load();
        $this->spec_drug->AdvancedSearch->load();
        $this->spec_prothesis->AdvancedSearch->load();
        $this->spec_investigation->AdvancedSearch->load();
        $this->procedure_11->AdvancedSearch->load();
        $this->procedure_12->AdvancedSearch->load();
        $this->procedure_13->AdvancedSearch->load();
        $this->procedure_14->AdvancedSearch->load();
        $this->procedure_15->AdvancedSearch->load();
        $this->isanestesi->AdvancedSearch->load();
        $this->isreposisi->AdvancedSearch->load();
        $this->islab->AdvancedSearch->load();
        $this->isro->AdvancedSearch->load();
        $this->isekg->AdvancedSearch->load();
        $this->ishecting->AdvancedSearch->load();
        $this->isgips->AdvancedSearch->load();
        $this->islengkap->AdvancedSearch->load();
        $this->ID->AdvancedSearch->load();
        $this->IDXDAFTAR->AdvancedSearch->load();
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fPASIEN_DIAGNOSAlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fPASIEN_DIAGNOSAlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fPASIEN_DIAGNOSAlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ",url:'" . $pageUrl . "export=email&amp;custom=1'" : "";
            return '<button id="emf_PASIEN_DIAGNOSA" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_PASIEN_DIAGNOSA\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fPASIEN_DIAGNOSAlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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

        // Export to Html
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to Xml
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to Csv
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fPASIEN_DIAGNOSAlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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

            // Update URL
            $this->AddUrl = $this->addMasterUrl($this->AddUrl);
            $this->InlineAddUrl = $this->addMasterUrl($this->InlineAddUrl);
            $this->GridAddUrl = $this->addMasterUrl($this->GridAddUrl);
            $this->GridEditUrl = $this->addMasterUrl($this->GridEditUrl);

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
