<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class VKasirList extends VKasir
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'V_KASIR';

    // Page object name
    public $PageObjName = "VKasirList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fV_KASIRlist";
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

        // Table object (V_KASIR)
        if (!isset($GLOBALS["V_KASIR"]) || get_class($GLOBALS["V_KASIR"]) == PROJECT_NAMESPACE . "V_KASIR") {
            $GLOBALS["V_KASIR"] = &$this;
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
        $this->AddUrl = "VKasirAdd?" . Config("TABLE_SHOW_DETAIL") . "=";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "VKasirDelete";
        $this->MultiUpdateUrl = "VKasirUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'V_KASIR');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fV_KASIRlistsrch";

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
                $doc = new $class(Container("V_KASIR"));
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
            $this->ORG_UNIT_CODE->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->BOOKED_DATE->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->VISIT_DATE->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->MODIFIED_BY->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->MODIFIED_DATE->Visible = false;
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
        $this->CETAK->setVisibility();
        $this->ORG_UNIT_CODE->Visible = false;
        $this->NO_REGISTRATION->setVisibility();
        $this->VISIT_ID->Visible = false;
        $this->STATUS_PASIEN_ID->Visible = false;
        $this->RUJUKAN_ID->Visible = false;
        $this->ADDRESS_OF_RUJUKAN->Visible = false;
        $this->REASON_ID->Visible = false;
        $this->WAY_ID->Visible = false;
        $this->PATIENT_CATEGORY_ID->Visible = false;
        $this->BOOKED_DATE->Visible = false;
        $this->VISIT_DATE->setVisibility();
        $this->ISNEW->Visible = false;
        $this->FOLLOW_UP->Visible = false;
        $this->PLACE_TYPE->Visible = false;
        $this->CLINIC_ID->setVisibility();
        $this->CLINIC_ID_FROM->Visible = false;
        $this->CLASS_ROOM_ID->Visible = false;
        $this->BED_ID->Visible = false;
        $this->KELUAR_ID->Visible = false;
        $this->IN_DATE->Visible = false;
        $this->EXIT_DATE->Visible = false;
        $this->DIANTAR_OLEH->Visible = false;
        $this->GENDER->setVisibility();
        $this->DESCRIPTION->Visible = false;
        $this->VISITOR_ADDRESS->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_FROM->Visible = false;
        $this->EMPLOYEE_ID->setVisibility();
        $this->EMPLOYEE_ID_FROM->Visible = false;
        $this->RESPONSIBLE_ID->Visible = false;
        $this->RESPONSIBLE->Visible = false;
        $this->FAMILY_STATUS_ID->Visible = false;
        $this->TICKET_NO->Visible = false;
        $this->ISATTENDED->Visible = false;
        $this->PAYOR_ID->setVisibility();
        $this->CLASS_ID->setVisibility();
        $this->ISPERTARIF->Visible = false;
        $this->KAL_ID->Visible = false;
        $this->EMPLOYEE_INAP->Visible = false;
        $this->PASIEN_ID->setVisibility();
        $this->KARYAWAN->Visible = false;
        $this->ACCOUNT_ID->Visible = false;
        $this->CLASS_ID_PLAFOND->Visible = false;
        $this->BACKCHARGE->Visible = false;
        $this->COVERAGE_ID->Visible = false;
        $this->AGEYEAR->Visible = false;
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
        $this->DIAGNOSA_ID->Visible = false;
        $this->ticket_all->Visible = false;
        $this->tanggal_rujukan->Visible = false;
        $this->ISRJ->Visible = false;
        $this->NORUJUKAN->Visible = false;
        $this->PPKRUJUKAN->Visible = false;
        $this->LOKASILAKA->Visible = false;
        $this->KDPOLI->Visible = false;
        $this->EDIT_SEP->Visible = false;
        $this->DELETE_SEP->Visible = false;
        $this->KODE_AGAMA->Visible = false;
        $this->DIAG_AWAL->Visible = false;
        $this->AKTIF->Visible = false;
        $this->BILL_INAP->Visible = false;
        $this->SEP_PRINTDATE->Visible = false;
        $this->MAPPING_SEP->Visible = false;
        $this->TRANS_ID->Visible = false;
        $this->KDPOLI_EKS->Visible = false;
        $this->COB->Visible = false;
        $this->PENJAMIN->Visible = false;
        $this->ASALRUJUKAN->Visible = false;
        $this->RESPONSEP->Visible = false;
        $this->APPROVAL_DESC->Visible = false;
        $this->APPROVAL_RESPONAJUKAN->Visible = false;
        $this->APPROVAL_RESPONAPPROV->Visible = false;
        $this->RESPONTGLPLG_DESC->Visible = false;
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
        $this->IDXDAFTAR->Visible = false;
        $this->tgl_kontrol->setVisibility();
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
        $this->setupLookupOptions($this->STATUS_PASIEN_ID);
        $this->setupLookupOptions($this->RUJUKAN_ID);
        $this->setupLookupOptions($this->REASON_ID);
        $this->setupLookupOptions($this->WAY_ID);
        $this->setupLookupOptions($this->PATIENT_CATEGORY_ID);
        $this->setupLookupOptions($this->CLINIC_ID);
        $this->setupLookupOptions($this->CLINIC_ID_FROM);
        $this->setupLookupOptions($this->KELUAR_ID);
        $this->setupLookupOptions($this->GENDER);
        $this->setupLookupOptions($this->EMPLOYEE_ID);
        $this->setupLookupOptions($this->PAYOR_ID);
        $this->setupLookupOptions($this->CLASS_ID);
        $this->setupLookupOptions($this->KAL_ID);
        $this->setupLookupOptions($this->COVERAGE_ID);
        $this->setupLookupOptions($this->DIAGNOSA_ID);
        $this->setupLookupOptions($this->ISRJ);
        $this->setupLookupOptions($this->PPKRUJUKAN);
        $this->setupLookupOptions($this->KODE_AGAMA);

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
        $filterList = Concat($filterList, $this->CLINIC_ID->AdvancedSearch->toJson(), ","); // Field CLINIC_ID
        $filterList = Concat($filterList, $this->IDXDAFTAR->AdvancedSearch->toJson(), ","); // Field IDXDAFTAR
        $filterList = Concat($filterList, $this->tgl_kontrol->AdvancedSearch->toJson(), ","); // Field tgl_kontrol
        $filterList = Concat($filterList, $this->idbooking->AdvancedSearch->toJson(), ","); // Field idbooking
        $filterList = Concat($filterList, $this->id_tujuan->AdvancedSearch->toJson(), ","); // Field id_tujuan
        $filterList = Concat($filterList, $this->id_penunjang->AdvancedSearch->toJson(), ","); // Field id_penunjang
        $filterList = Concat($filterList, $this->id_pembiayaan->AdvancedSearch->toJson(), ","); // Field id_pembiayaan
        $filterList = Concat($filterList, $this->id_procedure->AdvancedSearch->toJson(), ","); // Field id_procedure
        $filterList = Concat($filterList, $this->id_aspel->AdvancedSearch->toJson(), ","); // Field id_aspel
        $filterList = Concat($filterList, $this->id_kelas->AdvancedSearch->toJson(), ","); // Field id_kelas
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fV_KASIRlistsrch", $filters);
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

        // Field CLINIC_ID
        $this->CLINIC_ID->AdvancedSearch->SearchValue = @$filter["x_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchOperator = @$filter["z_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchCondition = @$filter["v_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchValue2 = @$filter["y_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->SearchOperator2 = @$filter["w_CLINIC_ID"];
        $this->CLINIC_ID->AdvancedSearch->save();

        // Field IDXDAFTAR
        $this->IDXDAFTAR->AdvancedSearch->SearchValue = @$filter["x_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->SearchOperator = @$filter["z_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->SearchCondition = @$filter["v_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->SearchValue2 = @$filter["y_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->SearchOperator2 = @$filter["w_IDXDAFTAR"];
        $this->IDXDAFTAR->AdvancedSearch->save();

        // Field tgl_kontrol
        $this->tgl_kontrol->AdvancedSearch->SearchValue = @$filter["x_tgl_kontrol"];
        $this->tgl_kontrol->AdvancedSearch->SearchOperator = @$filter["z_tgl_kontrol"];
        $this->tgl_kontrol->AdvancedSearch->SearchCondition = @$filter["v_tgl_kontrol"];
        $this->tgl_kontrol->AdvancedSearch->SearchValue2 = @$filter["y_tgl_kontrol"];
        $this->tgl_kontrol->AdvancedSearch->SearchOperator2 = @$filter["w_tgl_kontrol"];
        $this->tgl_kontrol->AdvancedSearch->save();

        // Field idbooking
        $this->idbooking->AdvancedSearch->SearchValue = @$filter["x_idbooking"];
        $this->idbooking->AdvancedSearch->SearchOperator = @$filter["z_idbooking"];
        $this->idbooking->AdvancedSearch->SearchCondition = @$filter["v_idbooking"];
        $this->idbooking->AdvancedSearch->SearchValue2 = @$filter["y_idbooking"];
        $this->idbooking->AdvancedSearch->SearchOperator2 = @$filter["w_idbooking"];
        $this->idbooking->AdvancedSearch->save();

        // Field id_tujuan
        $this->id_tujuan->AdvancedSearch->SearchValue = @$filter["x_id_tujuan"];
        $this->id_tujuan->AdvancedSearch->SearchOperator = @$filter["z_id_tujuan"];
        $this->id_tujuan->AdvancedSearch->SearchCondition = @$filter["v_id_tujuan"];
        $this->id_tujuan->AdvancedSearch->SearchValue2 = @$filter["y_id_tujuan"];
        $this->id_tujuan->AdvancedSearch->SearchOperator2 = @$filter["w_id_tujuan"];
        $this->id_tujuan->AdvancedSearch->save();

        // Field id_penunjang
        $this->id_penunjang->AdvancedSearch->SearchValue = @$filter["x_id_penunjang"];
        $this->id_penunjang->AdvancedSearch->SearchOperator = @$filter["z_id_penunjang"];
        $this->id_penunjang->AdvancedSearch->SearchCondition = @$filter["v_id_penunjang"];
        $this->id_penunjang->AdvancedSearch->SearchValue2 = @$filter["y_id_penunjang"];
        $this->id_penunjang->AdvancedSearch->SearchOperator2 = @$filter["w_id_penunjang"];
        $this->id_penunjang->AdvancedSearch->save();

        // Field id_pembiayaan
        $this->id_pembiayaan->AdvancedSearch->SearchValue = @$filter["x_id_pembiayaan"];
        $this->id_pembiayaan->AdvancedSearch->SearchOperator = @$filter["z_id_pembiayaan"];
        $this->id_pembiayaan->AdvancedSearch->SearchCondition = @$filter["v_id_pembiayaan"];
        $this->id_pembiayaan->AdvancedSearch->SearchValue2 = @$filter["y_id_pembiayaan"];
        $this->id_pembiayaan->AdvancedSearch->SearchOperator2 = @$filter["w_id_pembiayaan"];
        $this->id_pembiayaan->AdvancedSearch->save();

        // Field id_procedure
        $this->id_procedure->AdvancedSearch->SearchValue = @$filter["x_id_procedure"];
        $this->id_procedure->AdvancedSearch->SearchOperator = @$filter["z_id_procedure"];
        $this->id_procedure->AdvancedSearch->SearchCondition = @$filter["v_id_procedure"];
        $this->id_procedure->AdvancedSearch->SearchValue2 = @$filter["y_id_procedure"];
        $this->id_procedure->AdvancedSearch->SearchOperator2 = @$filter["w_id_procedure"];
        $this->id_procedure->AdvancedSearch->save();

        // Field id_aspel
        $this->id_aspel->AdvancedSearch->SearchValue = @$filter["x_id_aspel"];
        $this->id_aspel->AdvancedSearch->SearchOperator = @$filter["z_id_aspel"];
        $this->id_aspel->AdvancedSearch->SearchCondition = @$filter["v_id_aspel"];
        $this->id_aspel->AdvancedSearch->SearchValue2 = @$filter["y_id_aspel"];
        $this->id_aspel->AdvancedSearch->SearchOperator2 = @$filter["w_id_aspel"];
        $this->id_aspel->AdvancedSearch->save();

        // Field id_kelas
        $this->id_kelas->AdvancedSearch->SearchValue = @$filter["x_id_kelas"];
        $this->id_kelas->AdvancedSearch->SearchOperator = @$filter["z_id_kelas"];
        $this->id_kelas->AdvancedSearch->SearchCondition = @$filter["v_id_kelas"];
        $this->id_kelas->AdvancedSearch->SearchValue2 = @$filter["y_id_kelas"];
        $this->id_kelas->AdvancedSearch->SearchOperator2 = @$filter["w_id_kelas"];
        $this->id_kelas->AdvancedSearch->save();
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
        $this->buildSearchSql($where, $this->CLINIC_ID, $default, false); // CLINIC_ID
        $this->buildSearchSql($where, $this->IDXDAFTAR, $default, false); // IDXDAFTAR
        $this->buildSearchSql($where, $this->tgl_kontrol, $default, false); // tgl_kontrol
        $this->buildSearchSql($where, $this->idbooking, $default, false); // idbooking
        $this->buildSearchSql($where, $this->id_tujuan, $default, false); // id_tujuan
        $this->buildSearchSql($where, $this->id_penunjang, $default, false); // id_penunjang
        $this->buildSearchSql($where, $this->id_pembiayaan, $default, false); // id_pembiayaan
        $this->buildSearchSql($where, $this->id_procedure, $default, false); // id_procedure
        $this->buildSearchSql($where, $this->id_aspel, $default, false); // id_aspel
        $this->buildSearchSql($where, $this->id_kelas, $default, false); // id_kelas

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->CLINIC_ID->AdvancedSearch->save(); // CLINIC_ID
            $this->IDXDAFTAR->AdvancedSearch->save(); // IDXDAFTAR
            $this->tgl_kontrol->AdvancedSearch->save(); // tgl_kontrol
            $this->idbooking->AdvancedSearch->save(); // idbooking
            $this->id_tujuan->AdvancedSearch->save(); // id_tujuan
            $this->id_penunjang->AdvancedSearch->save(); // id_penunjang
            $this->id_pembiayaan->AdvancedSearch->save(); // id_pembiayaan
            $this->id_procedure->AdvancedSearch->save(); // id_procedure
            $this->id_aspel->AdvancedSearch->save(); // id_aspel
            $this->id_kelas->AdvancedSearch->save(); // id_kelas
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
        $this->buildBasicSearchSql($where, $this->ADDRESS_OF_RUJUKAN, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->CLINIC_ID, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->idbooking, $arKeywords, $type);
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
        if ($this->CLINIC_ID->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->IDXDAFTAR->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tgl_kontrol->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->idbooking->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->id_tujuan->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->id_penunjang->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->id_pembiayaan->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->id_procedure->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->id_aspel->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->id_kelas->AdvancedSearch->issetSession()) {
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
                $this->CLINIC_ID->AdvancedSearch->unsetSession();
                $this->IDXDAFTAR->AdvancedSearch->unsetSession();
                $this->tgl_kontrol->AdvancedSearch->unsetSession();
                $this->idbooking->AdvancedSearch->unsetSession();
                $this->id_tujuan->AdvancedSearch->unsetSession();
                $this->id_penunjang->AdvancedSearch->unsetSession();
                $this->id_pembiayaan->AdvancedSearch->unsetSession();
                $this->id_procedure->AdvancedSearch->unsetSession();
                $this->id_aspel->AdvancedSearch->unsetSession();
                $this->id_kelas->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
                $this->CLINIC_ID->AdvancedSearch->load();
                $this->IDXDAFTAR->AdvancedSearch->load();
                $this->tgl_kontrol->AdvancedSearch->load();
                $this->idbooking->AdvancedSearch->load();
                $this->id_tujuan->AdvancedSearch->load();
                $this->id_penunjang->AdvancedSearch->load();
                $this->id_pembiayaan->AdvancedSearch->load();
                $this->id_procedure->AdvancedSearch->load();
                $this->id_aspel->AdvancedSearch->load();
                $this->id_kelas->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->CETAK); // CETAK
            $this->updateSort($this->NO_REGISTRATION); // NO_REGISTRATION
            $this->updateSort($this->VISIT_DATE); // VISIT_DATE
            $this->updateSort($this->CLINIC_ID); // CLINIC_ID
            $this->updateSort($this->GENDER); // GENDER
            $this->updateSort($this->EMPLOYEE_ID); // EMPLOYEE_ID
            $this->updateSort($this->PAYOR_ID); // PAYOR_ID
            $this->updateSort($this->CLASS_ID); // CLASS_ID
            $this->updateSort($this->PASIEN_ID); // PASIEN_ID
            $this->updateSort($this->tgl_kontrol); // tgl_kontrol
            $this->updateSort($this->idbooking); // idbooking
            $this->updateSort($this->id_tujuan); // id_tujuan
            $this->updateSort($this->id_penunjang); // id_penunjang
            $this->updateSort($this->id_pembiayaan); // id_pembiayaan
            $this->updateSort($this->id_procedure); // id_procedure
            $this->updateSort($this->id_aspel); // id_aspel
            $this->updateSort($this->id_kelas); // id_kelas
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
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->CETAK->setSort("");
                $this->ORG_UNIT_CODE->setSort("");
                $this->NO_REGISTRATION->setSort("");
                $this->VISIT_ID->setSort("");
                $this->STATUS_PASIEN_ID->setSort("");
                $this->RUJUKAN_ID->setSort("");
                $this->ADDRESS_OF_RUJUKAN->setSort("");
                $this->REASON_ID->setSort("");
                $this->WAY_ID->setSort("");
                $this->PATIENT_CATEGORY_ID->setSort("");
                $this->BOOKED_DATE->setSort("");
                $this->VISIT_DATE->setSort("");
                $this->ISNEW->setSort("");
                $this->FOLLOW_UP->setSort("");
                $this->PLACE_TYPE->setSort("");
                $this->CLINIC_ID->setSort("");
                $this->CLINIC_ID_FROM->setSort("");
                $this->CLASS_ROOM_ID->setSort("");
                $this->BED_ID->setSort("");
                $this->KELUAR_ID->setSort("");
                $this->IN_DATE->setSort("");
                $this->EXIT_DATE->setSort("");
                $this->DIANTAR_OLEH->setSort("");
                $this->GENDER->setSort("");
                $this->DESCRIPTION->setSort("");
                $this->VISITOR_ADDRESS->setSort("");
                $this->MODIFIED_BY->setSort("");
                $this->MODIFIED_DATE->setSort("");
                $this->MODIFIED_FROM->setSort("");
                $this->EMPLOYEE_ID->setSort("");
                $this->EMPLOYEE_ID_FROM->setSort("");
                $this->RESPONSIBLE_ID->setSort("");
                $this->RESPONSIBLE->setSort("");
                $this->FAMILY_STATUS_ID->setSort("");
                $this->TICKET_NO->setSort("");
                $this->ISATTENDED->setSort("");
                $this->PAYOR_ID->setSort("");
                $this->CLASS_ID->setSort("");
                $this->ISPERTARIF->setSort("");
                $this->KAL_ID->setSort("");
                $this->EMPLOYEE_INAP->setSort("");
                $this->PASIEN_ID->setSort("");
                $this->KARYAWAN->setSort("");
                $this->ACCOUNT_ID->setSort("");
                $this->CLASS_ID_PLAFOND->setSort("");
                $this->BACKCHARGE->setSort("");
                $this->COVERAGE_ID->setSort("");
                $this->AGEYEAR->setSort("");
                $this->AGEMONTH->setSort("");
                $this->AGEDAY->setSort("");
                $this->RECOMENDATION->setSort("");
                $this->CONCLUSION->setSort("");
                $this->SPECIMENNO->setSort("");
                $this->LOCKED->setSort("");
                $this->RM_OUT_DATE->setSort("");
                $this->RM_IN_DATE->setSort("");
                $this->LAMA_PINJAM->setSort("");
                $this->STANDAR_RJ->setSort("");
                $this->LENGKAP_RJ->setSort("");
                $this->LENGKAP_RI->setSort("");
                $this->RESEND_RM_DATE->setSort("");
                $this->LENGKAP_RM1->setSort("");
                $this->LENGKAP_RESUME->setSort("");
                $this->LENGKAP_ANAMNESIS->setSort("");
                $this->LENGKAP_CONSENT->setSort("");
                $this->LENGKAP_ANESTESI->setSort("");
                $this->LENGKAP_OP->setSort("");
                $this->BACK_RM_DATE->setSort("");
                $this->VALID_RM_DATE->setSort("");
                $this->NO_SKP->setSort("");
                $this->NO_SKPINAP->setSort("");
                $this->DIAGNOSA_ID->setSort("");
                $this->ticket_all->setSort("");
                $this->tanggal_rujukan->setSort("");
                $this->ISRJ->setSort("");
                $this->NORUJUKAN->setSort("");
                $this->PPKRUJUKAN->setSort("");
                $this->LOKASILAKA->setSort("");
                $this->KDPOLI->setSort("");
                $this->EDIT_SEP->setSort("");
                $this->DELETE_SEP->setSort("");
                $this->KODE_AGAMA->setSort("");
                $this->DIAG_AWAL->setSort("");
                $this->AKTIF->setSort("");
                $this->BILL_INAP->setSort("");
                $this->SEP_PRINTDATE->setSort("");
                $this->MAPPING_SEP->setSort("");
                $this->TRANS_ID->setSort("");
                $this->KDPOLI_EKS->setSort("");
                $this->COB->setSort("");
                $this->PENJAMIN->setSort("");
                $this->ASALRUJUKAN->setSort("");
                $this->RESPONSEP->setSort("");
                $this->APPROVAL_DESC->setSort("");
                $this->APPROVAL_RESPONAJUKAN->setSort("");
                $this->APPROVAL_RESPONAPPROV->setSort("");
                $this->RESPONTGLPLG_DESC->setSort("");
                $this->RESPONPOST_VKLAIM->setSort("");
                $this->RESPONPUT_VKLAIM->setSort("");
                $this->RESPONDEL_VKLAIM->setSort("");
                $this->CALL_TIMES->setSort("");
                $this->CALL_DATE->setSort("");
                $this->CALL_DATES->setSort("");
                $this->SERVED_DATE->setSort("");
                $this->SERVED_INAP->setSort("");
                $this->KDDPJP1->setSort("");
                $this->KDDPJP->setSort("");
                $this->IDXDAFTAR->setSort("");
                $this->tgl_kontrol->setSort("");
                $this->idbooking->setSort("");
                $this->id_tujuan->setSort("");
                $this->id_penunjang->setSort("");
                $this->id_pembiayaan->setSort("");
                $this->id_procedure->setSort("");
                $this->id_aspel->setSort("");
                $this->id_kelas->setSort("");
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

        // "detail_TREATMENT_AKOMODASI"
        $item = &$this->ListOptions->add("detail_TREATMENT_AKOMODASI");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'TREATMENT_AKOMODASI') && !$this->ShowMultipleDetails;
        $item->OnLeft = true;
        $item->ShowInButtonGroup = false;

        // "detail_TREATMENT_BILL"
        $item = &$this->ListOptions->add("detail_TREATMENT_BILL");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'TREATMENT_BILL') && !$this->ShowMultipleDetails;
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
        $pages->add("TREATMENT_AKOMODASI");
        $pages->add("TREATMENT_BILL");
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

        // "detail_TREATMENT_AKOMODASI"
        $opt = $this->ListOptions["detail_TREATMENT_AKOMODASI"];
        if ($Security->allowList(CurrentProjectID() . 'TREATMENT_AKOMODASI')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("TREATMENT_AKOMODASI", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("TreatmentAkomodasiList?" . Config("TABLE_SHOW_MASTER") . "=V_KASIR&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("TreatmentAkomodasiGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'V_KASIR')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=TREATMENT_AKOMODASI");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "TREATMENT_AKOMODASI";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'V_KASIR')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=TREATMENT_AKOMODASI");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "TREATMENT_AKOMODASI";
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

        // "detail_TREATMENT_BILL"
        $opt = $this->ListOptions["detail_TREATMENT_BILL"];
        if ($Security->allowList(CurrentProjectID() . 'TREATMENT_BILL')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("TREATMENT_BILL", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("TreatmentBillList?" . Config("TABLE_SHOW_MASTER") . "=V_KASIR&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("TreatmentBillGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'V_KASIR')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=TREATMENT_BILL");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "TREATMENT_BILL";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'V_KASIR')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=TREATMENT_BILL");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "TREATMENT_BILL";
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
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->IDXDAFTAR->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fV_KASIRlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fV_KASIRlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fV_KASIRlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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

        // CLINIC_ID
        if (!$this->isAddOrEdit() && $this->CLINIC_ID->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->CLINIC_ID->AdvancedSearch->SearchValue != "" || $this->CLINIC_ID->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // tgl_kontrol
        if (!$this->isAddOrEdit() && $this->tgl_kontrol->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tgl_kontrol->AdvancedSearch->SearchValue != "" || $this->tgl_kontrol->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // idbooking
        if (!$this->isAddOrEdit() && $this->idbooking->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->idbooking->AdvancedSearch->SearchValue != "" || $this->idbooking->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // id_tujuan
        if (!$this->isAddOrEdit() && $this->id_tujuan->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id_tujuan->AdvancedSearch->SearchValue != "" || $this->id_tujuan->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // id_penunjang
        if (!$this->isAddOrEdit() && $this->id_penunjang->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id_penunjang->AdvancedSearch->SearchValue != "" || $this->id_penunjang->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // id_pembiayaan
        if (!$this->isAddOrEdit() && $this->id_pembiayaan->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id_pembiayaan->AdvancedSearch->SearchValue != "" || $this->id_pembiayaan->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // id_procedure
        if (!$this->isAddOrEdit() && $this->id_procedure->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id_procedure->AdvancedSearch->SearchValue != "" || $this->id_procedure->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // id_aspel
        if (!$this->isAddOrEdit() && $this->id_aspel->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id_aspel->AdvancedSearch->SearchValue != "" || $this->id_aspel->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // id_kelas
        if (!$this->isAddOrEdit() && $this->id_kelas->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id_kelas->AdvancedSearch->SearchValue != "" || $this->id_kelas->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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
        $this->CETAK->setDbValue($row['CETAK']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->RUJUKAN_ID->setDbValue($row['RUJUKAN_ID']);
        $this->ADDRESS_OF_RUJUKAN->setDbValue($row['ADDRESS_OF_RUJUKAN']);
        $this->REASON_ID->setDbValue($row['REASON_ID']);
        $this->WAY_ID->setDbValue($row['WAY_ID']);
        $this->PATIENT_CATEGORY_ID->setDbValue($row['PATIENT_CATEGORY_ID']);
        $this->BOOKED_DATE->setDbValue($row['BOOKED_DATE']);
        $this->VISIT_DATE->setDbValue($row['VISIT_DATE']);
        $this->ISNEW->setDbValue($row['ISNEW']);
        $this->FOLLOW_UP->setDbValue($row['FOLLOW_UP']);
        $this->PLACE_TYPE->setDbValue($row['PLACE_TYPE']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->CLINIC_ID_FROM->setDbValue($row['CLINIC_ID_FROM']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->IN_DATE->setDbValue($row['IN_DATE']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->DIANTAR_OLEH->setDbValue($row['DIANTAR_OLEH']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->VISITOR_ADDRESS->setDbValue($row['VISITOR_ADDRESS']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->EMPLOYEE_ID_FROM->setDbValue($row['EMPLOYEE_ID_FROM']);
        $this->RESPONSIBLE_ID->setDbValue($row['RESPONSIBLE_ID']);
        $this->RESPONSIBLE->setDbValue($row['RESPONSIBLE']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->TICKET_NO->setDbValue($row['TICKET_NO']);
        $this->ISATTENDED->setDbValue($row['ISATTENDED']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->ISPERTARIF->setDbValue($row['ISPERTARIF']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->EMPLOYEE_INAP->setDbValue($row['EMPLOYEE_INAP']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
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
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->ticket_all->setDbValue($row['ticket_all']);
        $this->tanggal_rujukan->setDbValue($row['tanggal_rujukan']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->NORUJUKAN->setDbValue($row['NORUJUKAN']);
        $this->PPKRUJUKAN->setDbValue($row['PPKRUJUKAN']);
        $this->LOKASILAKA->setDbValue($row['LOKASILAKA']);
        $this->KDPOLI->setDbValue($row['KDPOLI']);
        $this->EDIT_SEP->setDbValue($row['EDIT_SEP']);
        $this->DELETE_SEP->setDbValue($row['DELETE_SEP']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->DIAG_AWAL->setDbValue($row['DIAG_AWAL']);
        $this->AKTIF->setDbValue($row['AKTIF']);
        $this->BILL_INAP->setDbValue($row['BILL_INAP']);
        $this->SEP_PRINTDATE->setDbValue($row['SEP_PRINTDATE']);
        $this->MAPPING_SEP->setDbValue($row['MAPPING_SEP']);
        $this->TRANS_ID->setDbValue($row['TRANS_ID']);
        $this->KDPOLI_EKS->setDbValue($row['KDPOLI_EKS']);
        $this->COB->setDbValue($row['COB']);
        $this->PENJAMIN->setDbValue($row['PENJAMIN']);
        $this->ASALRUJUKAN->setDbValue($row['ASALRUJUKAN']);
        $this->RESPONSEP->setDbValue($row['RESPONSEP']);
        $this->APPROVAL_DESC->setDbValue($row['APPROVAL_DESC']);
        $this->APPROVAL_RESPONAJUKAN->setDbValue($row['APPROVAL_RESPONAJUKAN']);
        $this->APPROVAL_RESPONAPPROV->setDbValue($row['APPROVAL_RESPONAPPROV']);
        $this->RESPONTGLPLG_DESC->setDbValue($row['RESPONTGLPLG_DESC']);
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
        $this->IDXDAFTAR->setDbValue($row['IDXDAFTAR']);
        $this->tgl_kontrol->setDbValue($row['tgl_kontrol']);
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
        $row = [];
        $row['CETAK'] = null;
        $row['ORG_UNIT_CODE'] = null;
        $row['NO_REGISTRATION'] = null;
        $row['VISIT_ID'] = null;
        $row['STATUS_PASIEN_ID'] = null;
        $row['RUJUKAN_ID'] = null;
        $row['ADDRESS_OF_RUJUKAN'] = null;
        $row['REASON_ID'] = null;
        $row['WAY_ID'] = null;
        $row['PATIENT_CATEGORY_ID'] = null;
        $row['BOOKED_DATE'] = null;
        $row['VISIT_DATE'] = null;
        $row['ISNEW'] = null;
        $row['FOLLOW_UP'] = null;
        $row['PLACE_TYPE'] = null;
        $row['CLINIC_ID'] = null;
        $row['CLINIC_ID_FROM'] = null;
        $row['CLASS_ROOM_ID'] = null;
        $row['BED_ID'] = null;
        $row['KELUAR_ID'] = null;
        $row['IN_DATE'] = null;
        $row['EXIT_DATE'] = null;
        $row['DIANTAR_OLEH'] = null;
        $row['GENDER'] = null;
        $row['DESCRIPTION'] = null;
        $row['VISITOR_ADDRESS'] = null;
        $row['MODIFIED_BY'] = null;
        $row['MODIFIED_DATE'] = null;
        $row['MODIFIED_FROM'] = null;
        $row['EMPLOYEE_ID'] = null;
        $row['EMPLOYEE_ID_FROM'] = null;
        $row['RESPONSIBLE_ID'] = null;
        $row['RESPONSIBLE'] = null;
        $row['FAMILY_STATUS_ID'] = null;
        $row['TICKET_NO'] = null;
        $row['ISATTENDED'] = null;
        $row['PAYOR_ID'] = null;
        $row['CLASS_ID'] = null;
        $row['ISPERTARIF'] = null;
        $row['KAL_ID'] = null;
        $row['EMPLOYEE_INAP'] = null;
        $row['PASIEN_ID'] = null;
        $row['KARYAWAN'] = null;
        $row['ACCOUNT_ID'] = null;
        $row['CLASS_ID_PLAFOND'] = null;
        $row['BACKCHARGE'] = null;
        $row['COVERAGE_ID'] = null;
        $row['AGEYEAR'] = null;
        $row['AGEMONTH'] = null;
        $row['AGEDAY'] = null;
        $row['RECOMENDATION'] = null;
        $row['CONCLUSION'] = null;
        $row['SPECIMENNO'] = null;
        $row['LOCKED'] = null;
        $row['RM_OUT_DATE'] = null;
        $row['RM_IN_DATE'] = null;
        $row['LAMA_PINJAM'] = null;
        $row['STANDAR_RJ'] = null;
        $row['LENGKAP_RJ'] = null;
        $row['LENGKAP_RI'] = null;
        $row['RESEND_RM_DATE'] = null;
        $row['LENGKAP_RM1'] = null;
        $row['LENGKAP_RESUME'] = null;
        $row['LENGKAP_ANAMNESIS'] = null;
        $row['LENGKAP_CONSENT'] = null;
        $row['LENGKAP_ANESTESI'] = null;
        $row['LENGKAP_OP'] = null;
        $row['BACK_RM_DATE'] = null;
        $row['VALID_RM_DATE'] = null;
        $row['NO_SKP'] = null;
        $row['NO_SKPINAP'] = null;
        $row['DIAGNOSA_ID'] = null;
        $row['ticket_all'] = null;
        $row['tanggal_rujukan'] = null;
        $row['ISRJ'] = null;
        $row['NORUJUKAN'] = null;
        $row['PPKRUJUKAN'] = null;
        $row['LOKASILAKA'] = null;
        $row['KDPOLI'] = null;
        $row['EDIT_SEP'] = null;
        $row['DELETE_SEP'] = null;
        $row['KODE_AGAMA'] = null;
        $row['DIAG_AWAL'] = null;
        $row['AKTIF'] = null;
        $row['BILL_INAP'] = null;
        $row['SEP_PRINTDATE'] = null;
        $row['MAPPING_SEP'] = null;
        $row['TRANS_ID'] = null;
        $row['KDPOLI_EKS'] = null;
        $row['COB'] = null;
        $row['PENJAMIN'] = null;
        $row['ASALRUJUKAN'] = null;
        $row['RESPONSEP'] = null;
        $row['APPROVAL_DESC'] = null;
        $row['APPROVAL_RESPONAJUKAN'] = null;
        $row['APPROVAL_RESPONAPPROV'] = null;
        $row['RESPONTGLPLG_DESC'] = null;
        $row['RESPONPOST_VKLAIM'] = null;
        $row['RESPONPUT_VKLAIM'] = null;
        $row['RESPONDEL_VKLAIM'] = null;
        $row['CALL_TIMES'] = null;
        $row['CALL_DATE'] = null;
        $row['CALL_DATES'] = null;
        $row['SERVED_DATE'] = null;
        $row['SERVED_INAP'] = null;
        $row['KDDPJP1'] = null;
        $row['KDDPJP'] = null;
        $row['IDXDAFTAR'] = null;
        $row['tgl_kontrol'] = null;
        $row['idbooking'] = null;
        $row['id_tujuan'] = null;
        $row['id_penunjang'] = null;
        $row['id_pembiayaan'] = null;
        $row['id_procedure'] = null;
        $row['id_aspel'] = null;
        $row['id_kelas'] = null;
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

        // CETAK
        $this->CETAK->CellCssStyle = "white-space: nowrap;";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->CellCssStyle = "white-space: nowrap;";

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

        // BOOKED_DATE
        $this->BOOKED_DATE->CellCssStyle = "white-space: nowrap;";

        // VISIT_DATE
        $this->VISIT_DATE->CellCssStyle = "white-space: nowrap;";

        // ISNEW
        $this->ISNEW->CellCssStyle = "white-space: nowrap;";

        // FOLLOW_UP
        $this->FOLLOW_UP->CellCssStyle = "white-space: nowrap;";

        // PLACE_TYPE
        $this->PLACE_TYPE->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

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

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

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

        // TICKET_NO
        $this->TICKET_NO->CellCssStyle = "white-space: nowrap;";

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

        // PASIEN_ID
        $this->PASIEN_ID->CellCssStyle = "white-space: nowrap;";

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

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->CellCssStyle = "white-space: nowrap;";

        // ticket_all
        $this->ticket_all->CellCssStyle = "white-space: nowrap;";

        // tanggal_rujukan
        $this->tanggal_rujukan->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // NORUJUKAN
        $this->NORUJUKAN->CellCssStyle = "white-space: nowrap;";

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

        // KODE_AGAMA
        $this->KODE_AGAMA->CellCssStyle = "white-space: nowrap;";

        // DIAG_AWAL
        $this->DIAG_AWAL->CellCssStyle = "white-space: nowrap;";

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

        // KDPOLI_EKS
        $this->KDPOLI_EKS->CellCssStyle = "white-space: nowrap;";

        // COB
        $this->COB->CellCssStyle = "white-space: nowrap;";

        // PENJAMIN
        $this->PENJAMIN->CellCssStyle = "white-space: nowrap;";

        // ASALRUJUKAN
        $this->ASALRUJUKAN->CellCssStyle = "white-space: nowrap;";

        // RESPONSEP
        $this->RESPONSEP->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_DESC
        $this->APPROVAL_DESC->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_RESPONAJUKAN
        $this->APPROVAL_RESPONAJUKAN->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_RESPONAPPROV
        $this->APPROVAL_RESPONAPPROV->CellCssStyle = "white-space: nowrap;";

        // RESPONTGLPLG_DESC
        $this->RESPONTGLPLG_DESC->CellCssStyle = "white-space: nowrap;";

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

        // IDXDAFTAR
        $this->IDXDAFTAR->CellCssStyle = "white-space: nowrap;";

        // tgl_kontrol

        // idbooking

        // id_tujuan

        // id_penunjang

        // id_pembiayaan

        // id_procedure

        // id_aspel

        // id_kelas
        if ($this->RowType == ROWTYPE_VIEW) {
            // CETAK
            $this->CETAK->ViewValue = $this->CETAK->CurrentValue;
            $this->CETAK->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

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

            // VISIT_ID
            $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
            $this->VISIT_ID->ViewCustomAttributes = "";

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

            // RUJUKAN_ID
            $curVal = trim(strval($this->RUJUKAN_ID->CurrentValue));
            if ($curVal != "") {
                $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->lookupCacheOption($curVal);
                if ($this->RUJUKAN_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[RUJUKAN_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->RUJUKAN_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->RUJUKAN_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->displayValue($arwrk);
                    } else {
                        $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->CurrentValue;
                    }
                }
            } else {
                $this->RUJUKAN_ID->ViewValue = null;
            }
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
            $curVal = trim(strval($this->PATIENT_CATEGORY_ID->CurrentValue));
            if ($curVal != "") {
                $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->lookupCacheOption($curVal);
                if ($this->PATIENT_CATEGORY_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[PATIENT_CATEGORY_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->PATIENT_CATEGORY_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PATIENT_CATEGORY_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->displayValue($arwrk);
                    } else {
                        $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->CurrentValue;
                    }
                }
            } else {
                $this->PATIENT_CATEGORY_ID->ViewValue = null;
            }
            $this->PATIENT_CATEGORY_ID->ViewCustomAttributes = "";

            // BOOKED_DATE
            $this->BOOKED_DATE->ViewValue = $this->BOOKED_DATE->CurrentValue;
            $this->BOOKED_DATE->ViewValue = FormatDateTime($this->BOOKED_DATE->ViewValue, 0);
            $this->BOOKED_DATE->ViewCustomAttributes = "";

            // VISIT_DATE
            $this->VISIT_DATE->ViewValue = $this->VISIT_DATE->CurrentValue;
            $this->VISIT_DATE->ViewValue = FormatDateTime($this->VISIT_DATE->ViewValue, 0);
            $this->VISIT_DATE->ViewCustomAttributes = "";

            // ISNEW
            if (strval($this->ISNEW->CurrentValue) != "") {
                $this->ISNEW->ViewValue = $this->ISNEW->optionCaption($this->ISNEW->CurrentValue);
            } else {
                $this->ISNEW->ViewValue = null;
            }
            $this->ISNEW->ViewCustomAttributes = "";

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

            // CLINIC_ID_FROM
            $curVal = trim(strval($this->CLINIC_ID_FROM->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->lookupCacheOption($curVal);
                if ($this->CLINIC_ID_FROM->ViewValue === null) { // Lookup from database
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->CLINIC_ID_FROM->Lookup->getSql(false, $filterWrk, '', $this, true, true);
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
            $this->IN_DATE->ViewValue = FormatDateTime($this->IN_DATE->ViewValue, 0);
            $this->IN_DATE->ViewCustomAttributes = "";

            // EXIT_DATE
            $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
            $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
            $this->EXIT_DATE->ViewCustomAttributes = "";

            // DIANTAR_OLEH
            $this->DIANTAR_OLEH->ViewValue = $this->DIANTAR_OLEH->CurrentValue;
            $this->DIANTAR_OLEH->ViewCustomAttributes = "";

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

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // VISITOR_ADDRESS
            $this->VISITOR_ADDRESS->ViewValue = $this->VISITOR_ADDRESS->CurrentValue;
            $this->VISITOR_ADDRESS->ViewCustomAttributes = "";

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

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
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
            $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
            $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
            $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

            // TICKET_NO
            $this->TICKET_NO->ViewValue = $this->TICKET_NO->CurrentValue;
            $this->TICKET_NO->ViewValue = FormatNumber($this->TICKET_NO->ViewValue, 0, -2, -2, -2);
            $this->TICKET_NO->ViewCustomAttributes = "";

            // ISATTENDED
            $this->ISATTENDED->ViewValue = $this->ISATTENDED->CurrentValue;
            $this->ISATTENDED->ViewCustomAttributes = "";

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

            // PASIEN_ID
            $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
            $this->PASIEN_ID->ViewCustomAttributes = "";

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

            // ticket_all
            $this->ticket_all->ViewValue = $this->ticket_all->CurrentValue;
            $this->ticket_all->ViewValue = FormatNumber($this->ticket_all->ViewValue, 0, -2, -2, -2);
            $this->ticket_all->ViewCustomAttributes = "";

            // tanggal_rujukan
            $this->tanggal_rujukan->ViewValue = $this->tanggal_rujukan->CurrentValue;
            $this->tanggal_rujukan->ViewValue = FormatDateTime($this->tanggal_rujukan->ViewValue, 0);
            $this->tanggal_rujukan->ViewCustomAttributes = "";

            // ISRJ
            $curVal = trim(strval($this->ISRJ->CurrentValue));
            if ($curVal != "") {
                $this->ISRJ->ViewValue = $this->ISRJ->lookupCacheOption($curVal);
                if ($this->ISRJ->ViewValue === null) { // Lookup from database
                    $filterWrk = "[KELUAR_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->ISRJ->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->ISRJ->Lookup->renderViewRow($rswrk[0]);
                        $this->ISRJ->ViewValue = $this->ISRJ->displayValue($arwrk);
                    } else {
                        $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
                    }
                }
            } else {
                $this->ISRJ->ViewValue = null;
            }
            $this->ISRJ->ViewCustomAttributes = "";

            // NORUJUKAN
            $this->NORUJUKAN->ViewValue = $this->NORUJUKAN->CurrentValue;
            $this->NORUJUKAN->ViewCustomAttributes = "";

            // PPKRUJUKAN
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

            // DIAG_AWAL
            $this->DIAG_AWAL->ViewValue = $this->DIAG_AWAL->CurrentValue;
            $this->DIAG_AWAL->ViewCustomAttributes = "";

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

            // KDPOLI_EKS
            $this->KDPOLI_EKS->ViewValue = $this->KDPOLI_EKS->CurrentValue;
            $this->KDPOLI_EKS->ViewCustomAttributes = "";

            // COB
            if (strval($this->COB->CurrentValue) != "") {
                $this->COB->ViewValue = new OptionValues();
                $arwrk = explode(",", strval($this->COB->CurrentValue));
                $cnt = count($arwrk);
                for ($ari = 0; $ari < $cnt; $ari++)
                    $this->COB->ViewValue->add($this->COB->optionCaption(trim($arwrk[$ari])));
            } else {
                $this->COB->ViewValue = null;
            }
            $this->COB->ViewCustomAttributes = "";

            // PENJAMIN
            $this->PENJAMIN->ViewValue = $this->PENJAMIN->CurrentValue;
            $this->PENJAMIN->ViewCustomAttributes = "";

            // ASALRUJUKAN
            $this->ASALRUJUKAN->ViewValue = $this->ASALRUJUKAN->CurrentValue;
            $this->ASALRUJUKAN->ViewCustomAttributes = "";

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

            // RESPONTGLPLG_DESC
            $this->RESPONTGLPLG_DESC->ViewValue = $this->RESPONTGLPLG_DESC->CurrentValue;
            $this->RESPONTGLPLG_DESC->ViewCustomAttributes = "";

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

            // IDXDAFTAR
            $this->IDXDAFTAR->ViewValue = $this->IDXDAFTAR->CurrentValue;
            $this->IDXDAFTAR->ViewCustomAttributes = "";

            // tgl_kontrol
            $this->tgl_kontrol->ViewValue = $this->tgl_kontrol->CurrentValue;
            $this->tgl_kontrol->ViewValue = FormatDateTime($this->tgl_kontrol->ViewValue, 0);
            $this->tgl_kontrol->ViewCustomAttributes = "";

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

            // CETAK
            $this->CETAK->LinkCustomAttributes = "";
            $this->CETAK->HrefValue = "";
            $this->CETAK->TooltipValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

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

            // PASIEN_ID
            $this->PASIEN_ID->LinkCustomAttributes = "";
            $this->PASIEN_ID->HrefValue = "";
            $this->PASIEN_ID->TooltipValue = "";

            // tgl_kontrol
            $this->tgl_kontrol->LinkCustomAttributes = "";
            $this->tgl_kontrol->HrefValue = "";
            $this->tgl_kontrol->TooltipValue = "";

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
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // CETAK
            $this->CETAK->EditAttrs["class"] = "form-control";
            $this->CETAK->EditCustomAttributes = "";
            if (!$this->CETAK->Raw) {
                $this->CETAK->AdvancedSearch->SearchValue = HtmlDecode($this->CETAK->AdvancedSearch->SearchValue);
            }
            $this->CETAK->EditValue = HtmlEncode($this->CETAK->AdvancedSearch->SearchValue);
            $this->CETAK->PlaceHolder = RemoveHtml($this->CETAK->caption());

            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
            $this->NO_REGISTRATION->EditCustomAttributes = "";
            $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

            // VISIT_DATE
            $this->VISIT_DATE->EditAttrs["class"] = "form-control";
            $this->VISIT_DATE->EditCustomAttributes = "";
            $this->VISIT_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->VISIT_DATE->AdvancedSearch->SearchValue, 0), 8));
            $this->VISIT_DATE->PlaceHolder = RemoveHtml($this->VISIT_DATE->caption());

            // CLINIC_ID
            $this->CLINIC_ID->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLINIC_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->CLINIC_ID->AdvancedSearch->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
            } else {
                $this->CLINIC_ID->AdvancedSearch->ViewValue = $this->CLINIC_ID->Lookup !== null && is_array($this->CLINIC_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLINIC_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->CLINIC_ID->EditValue = array_values($this->CLINIC_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $this->CLINIC_ID->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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
            $this->GENDER->EditAttrs["class"] = "form-control";
            $this->GENDER->EditCustomAttributes = "";
            $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
            $this->EMPLOYEE_ID->EditCustomAttributes = "";
            if (!$this->EMPLOYEE_ID->Raw) {
                $this->EMPLOYEE_ID->AdvancedSearch->SearchValue = HtmlDecode($this->EMPLOYEE_ID->AdvancedSearch->SearchValue);
            }
            $this->EMPLOYEE_ID->EditValue = HtmlEncode($this->EMPLOYEE_ID->AdvancedSearch->SearchValue);
            $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

            // PAYOR_ID
            $this->PAYOR_ID->EditAttrs["class"] = "form-control";
            $this->PAYOR_ID->EditCustomAttributes = "";
            $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

            // CLASS_ID
            $this->CLASS_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ID->EditCustomAttributes = "";
            $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

            // PASIEN_ID
            $this->PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->PASIEN_ID->EditCustomAttributes = "";
            if (!$this->PASIEN_ID->Raw) {
                $this->PASIEN_ID->AdvancedSearch->SearchValue = HtmlDecode($this->PASIEN_ID->AdvancedSearch->SearchValue);
            }
            $this->PASIEN_ID->EditValue = HtmlEncode($this->PASIEN_ID->AdvancedSearch->SearchValue);
            $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

            // tgl_kontrol
            $this->tgl_kontrol->EditAttrs["class"] = "form-control";
            $this->tgl_kontrol->EditCustomAttributes = "";
            $this->tgl_kontrol->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_kontrol->AdvancedSearch->SearchValue, 0), 8));
            $this->tgl_kontrol->PlaceHolder = RemoveHtml($this->tgl_kontrol->caption());

            // idbooking
            $this->idbooking->EditAttrs["class"] = "form-control";
            $this->idbooking->EditCustomAttributes = "";
            if (!$this->idbooking->Raw) {
                $this->idbooking->AdvancedSearch->SearchValue = HtmlDecode($this->idbooking->AdvancedSearch->SearchValue);
            }
            $this->idbooking->EditValue = HtmlEncode($this->idbooking->AdvancedSearch->SearchValue);
            $this->idbooking->PlaceHolder = RemoveHtml($this->idbooking->caption());

            // id_tujuan
            $this->id_tujuan->EditAttrs["class"] = "form-control";
            $this->id_tujuan->EditCustomAttributes = "";
            $this->id_tujuan->EditValue = HtmlEncode($this->id_tujuan->AdvancedSearch->SearchValue);
            $this->id_tujuan->PlaceHolder = RemoveHtml($this->id_tujuan->caption());

            // id_penunjang
            $this->id_penunjang->EditAttrs["class"] = "form-control";
            $this->id_penunjang->EditCustomAttributes = "";
            $this->id_penunjang->EditValue = HtmlEncode($this->id_penunjang->AdvancedSearch->SearchValue);
            $this->id_penunjang->PlaceHolder = RemoveHtml($this->id_penunjang->caption());

            // id_pembiayaan
            $this->id_pembiayaan->EditAttrs["class"] = "form-control";
            $this->id_pembiayaan->EditCustomAttributes = "";
            $this->id_pembiayaan->EditValue = HtmlEncode($this->id_pembiayaan->AdvancedSearch->SearchValue);
            $this->id_pembiayaan->PlaceHolder = RemoveHtml($this->id_pembiayaan->caption());

            // id_procedure
            $this->id_procedure->EditAttrs["class"] = "form-control";
            $this->id_procedure->EditCustomAttributes = "";
            $this->id_procedure->EditValue = HtmlEncode($this->id_procedure->AdvancedSearch->SearchValue);
            $this->id_procedure->PlaceHolder = RemoveHtml($this->id_procedure->caption());

            // id_aspel
            $this->id_aspel->EditAttrs["class"] = "form-control";
            $this->id_aspel->EditCustomAttributes = "";
            $this->id_aspel->EditValue = HtmlEncode($this->id_aspel->AdvancedSearch->SearchValue);
            $this->id_aspel->PlaceHolder = RemoveHtml($this->id_aspel->caption());

            // id_kelas
            $this->id_kelas->EditAttrs["class"] = "form-control";
            $this->id_kelas->EditCustomAttributes = "";
            $this->id_kelas->EditValue = HtmlEncode($this->id_kelas->AdvancedSearch->SearchValue);
            $this->id_kelas->PlaceHolder = RemoveHtml($this->id_kelas->caption());
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
        $this->CLINIC_ID->AdvancedSearch->load();
        $this->IDXDAFTAR->AdvancedSearch->load();
        $this->tgl_kontrol->AdvancedSearch->load();
        $this->idbooking->AdvancedSearch->load();
        $this->id_tujuan->AdvancedSearch->load();
        $this->id_penunjang->AdvancedSearch->load();
        $this->id_pembiayaan->AdvancedSearch->load();
        $this->id_procedure->AdvancedSearch->load();
        $this->id_aspel->AdvancedSearch->load();
        $this->id_kelas->AdvancedSearch->load();
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fV_KASIRlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Advanced search button
        $item = &$this->SearchOptions->add("advancedsearch");
        $item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"VKasirSearch\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
        $item->Visible = true;

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
                case "x_NO_REGISTRATION":
                    break;
                case "x_STATUS_PASIEN_ID":
                    $lookupFilter = function () {
                        return "[ISACTIVE] = 1";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_RUJUKAN_ID":
                    break;
                case "x_REASON_ID":
                    break;
                case "x_WAY_ID":
                    break;
                case "x_PATIENT_CATEGORY_ID":
                    break;
                case "x_ISNEW":
                    break;
                case "x_CLINIC_ID":
                    $lookupFilter = function () {
                        return "[STYPE_ID] = 1 OR [STYPE_ID] = 2 OR [STYPE_ID] = 5";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_CLINIC_ID_FROM":
                    break;
                case "x_KELUAR_ID":
                    break;
                case "x_GENDER":
                    break;
                case "x_EMPLOYEE_ID":
                    $lookupFilter = function () {
                        return "[OBJECT_CATEGORY_ID]= 20";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PAYOR_ID":
                    break;
                case "x_CLASS_ID":
                    break;
                case "x_KAL_ID":
                    break;
                case "x_COVERAGE_ID":
                    break;
                case "x_DIAGNOSA_ID":
                    break;
                case "x_ISRJ":
                    break;
                case "x_PPKRUJUKAN":
                    break;
                case "x_KODE_AGAMA":
                    break;
                case "x_COB":
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
