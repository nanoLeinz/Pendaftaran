<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class CvVisitSearch extends CvVisit
{
    use MessagesTrait;

    // Page ID
    public $PageID = "search";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'cv_visit';

    // Page object name
    public $PageObjName = "CvVisitSearch";

    // Rendering View
    public $RenderingView = false;

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

        // Table object (cv_visit)
        if (!isset($GLOBALS["cv_visit"]) || get_class($GLOBALS["cv_visit"]) == PROJECT_NAMESPACE . "cv_visit") {
            $GLOBALS["cv_visit"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'cv_visit');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
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
                $doc = new $class(Container("cv_visit"));
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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "CvVisitView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
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
    public $FormClassName = "ew-horizontal ew-form ew-search-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->ORG_UNIT_CODE->Visible = false;
        $this->NO_REGISTRATION->setVisibility();
        $this->DIANTAR_OLEH->setVisibility();
        $this->VISIT_ID->Visible = false;
        $this->STATUS_PASIEN_ID->setVisibility();
        $this->RUJUKAN_ID->setVisibility();
        $this->ADDRESS_OF_RUJUKAN->setVisibility();
        $this->REASON_ID->setVisibility();
        $this->WAY_ID->setVisibility();
        $this->PATIENT_CATEGORY_ID->setVisibility();
        $this->BOOKED_DATE->setVisibility();
        $this->VISIT_DATE->setVisibility();
        $this->ISNEW->setVisibility();
        $this->FOLLOW_UP->setVisibility();
        $this->PLACE_TYPE->setVisibility();
        $this->TICKET_NO->setVisibility();
        $this->CLINIC_ID->setVisibility();
        $this->CLINIC_ID_FROM->setVisibility();
        $this->CLASS_ROOM_ID->setVisibility();
        $this->BED_ID->setVisibility();
        $this->KELUAR_ID->setVisibility();
        $this->IN_DATE->setVisibility();
        $this->EXIT_DATE->setVisibility();
        $this->GENDER->setVisibility();
        $this->DESCRIPTION->setVisibility();
        $this->VISITOR_ADDRESS->setVisibility();
        $this->MODIFIED_BY->setVisibility();
        $this->MODIFIED_DATE->setVisibility();
        $this->MODIFIED_FROM->setVisibility();
        $this->EMPLOYEE_ID->setVisibility();
        $this->EMPLOYEE_ID_FROM->setVisibility();
        $this->RESPONSIBLE_ID->setVisibility();
        $this->RESPONSIBLE->setVisibility();
        $this->FAMILY_STATUS_ID->setVisibility();
        $this->ISATTENDED->setVisibility();
        $this->PAYOR_ID->setVisibility();
        $this->CLASS_ID->setVisibility();
        $this->ISPERTARIF->setVisibility();
        $this->KAL_ID->setVisibility();
        $this->EMPLOYEE_INAP->setVisibility();
        $this->PASIEN_ID->setVisibility();
        $this->KARYAWAN->setVisibility();
        $this->ACCOUNT_ID->setVisibility();
        $this->CLASS_ID_PLAFOND->setVisibility();
        $this->BACKCHARGE->setVisibility();
        $this->COVERAGE_ID->setVisibility();
        $this->AGEYEAR->setVisibility();
        $this->AGEMONTH->setVisibility();
        $this->AGEDAY->setVisibility();
        $this->RECOMENDATION->setVisibility();
        $this->CONCLUSION->setVisibility();
        $this->SPECIMENNO->setVisibility();
        $this->LOCKED->setVisibility();
        $this->RM_OUT_DATE->setVisibility();
        $this->RM_IN_DATE->setVisibility();
        $this->LAMA_PINJAM->setVisibility();
        $this->STANDAR_RJ->setVisibility();
        $this->LENGKAP_RJ->setVisibility();
        $this->LENGKAP_RI->setVisibility();
        $this->RESEND_RM_DATE->setVisibility();
        $this->LENGKAP_RM1->setVisibility();
        $this->LENGKAP_RESUME->setVisibility();
        $this->LENGKAP_ANAMNESIS->setVisibility();
        $this->LENGKAP_CONSENT->setVisibility();
        $this->LENGKAP_ANESTESI->setVisibility();
        $this->LENGKAP_OP->setVisibility();
        $this->BACK_RM_DATE->setVisibility();
        $this->VALID_RM_DATE->setVisibility();
        $this->NO_SKP->setVisibility();
        $this->NO_SKPINAP->setVisibility();
        $this->DIAGNOSA_ID->setVisibility();
        $this->ticket_all->setVisibility();
        $this->tanggal_rujukan->setVisibility();
        $this->ISRJ->setVisibility();
        $this->NORUJUKAN->setVisibility();
        $this->PPKRUJUKAN->setVisibility();
        $this->LOKASILAKA->setVisibility();
        $this->KDPOLI->setVisibility();
        $this->EDIT_SEP->setVisibility();
        $this->DELETE_SEP->setVisibility();
        $this->KODE_AGAMA->setVisibility();
        $this->DIAG_AWAL->setVisibility();
        $this->AKTIF->setVisibility();
        $this->BILL_INAP->setVisibility();
        $this->SEP_PRINTDATE->setVisibility();
        $this->MAPPING_SEP->setVisibility();
        $this->TRANS_ID->setVisibility();
        $this->KDPOLI_EKS->setVisibility();
        $this->COB->setVisibility();
        $this->PENJAMIN->setVisibility();
        $this->ASALRUJUKAN->setVisibility();
        $this->RESPONSEP->setVisibility();
        $this->APPROVAL_DESC->setVisibility();
        $this->APPROVAL_RESPONAJUKAN->setVisibility();
        $this->APPROVAL_RESPONAPPROV->setVisibility();
        $this->RESPONTGLPLG_DESC->setVisibility();
        $this->RESPONPOST_VKLAIM->setVisibility();
        $this->RESPONPUT_VKLAIM->setVisibility();
        $this->RESPONDEL_VKLAIM->setVisibility();
        $this->CALL_TIMES->setVisibility();
        $this->CALL_DATE->setVisibility();
        $this->CALL_DATES->setVisibility();
        $this->SERVED_DATE->setVisibility();
        $this->SERVED_INAP->setVisibility();
        $this->KDDPJP1->setVisibility();
        $this->KDDPJP->setVisibility();
        $this->IDXDAFTAR->setVisibility();
        $this->tgl_kontrol->setVisibility();
        $this->idbooking->setVisibility();
        $this->id_tujuan->setVisibility();
        $this->id_penunjang->setVisibility();
        $this->id_pembiayaan->setVisibility();
        $this->id_procedure->setVisibility();
        $this->id_aspel->setVisibility();
        $this->id_kelas->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->NO_REGISTRATION);
        $this->setupLookupOptions($this->STATUS_PASIEN_ID);
        $this->setupLookupOptions($this->REASON_ID);
        $this->setupLookupOptions($this->WAY_ID);
        $this->setupLookupOptions($this->CLINIC_ID);
        $this->setupLookupOptions($this->KELUAR_ID);
        $this->setupLookupOptions($this->GENDER);
        $this->setupLookupOptions($this->EMPLOYEE_ID);
        $this->setupLookupOptions($this->CLASS_ID);
        $this->setupLookupOptions($this->KAL_ID);
        $this->setupLookupOptions($this->COVERAGE_ID);
        $this->setupLookupOptions($this->DIAGNOSA_ID);
        $this->setupLookupOptions($this->PPKRUJUKAN);
        $this->setupLookupOptions($this->KODE_AGAMA);
        $this->setupLookupOptions($this->DIAG_AWAL);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        if ($this->isPageRequest()) {
            // Get action
            $this->CurrentAction = Post("action");
            if ($this->isSearch()) {
                // Build search string for advanced search, remove blank field
                $this->loadSearchValues(); // Get search values
                if ($this->validateSearch()) {
                    $srchStr = $this->buildAdvancedSearch();
                } else {
                    $srchStr = "";
                }
                if ($srchStr != "") {
                    $srchStr = $this->getUrlParm($srchStr);
                    $srchStr = "CvVisitList" . "?" . $srchStr;
                    $this->terminate($srchStr); // Go to list page
                    return;
                }
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Render row for search
        $this->RowType = ROWTYPE_SEARCH;
        $this->resetAttributes();
        $this->renderRow();

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

    // Build advanced search
    protected function buildAdvancedSearch()
    {
        $srchUrl = "";
        $this->buildSearchUrl($srchUrl, $this->NO_REGISTRATION); // NO_REGISTRATION
        $this->buildSearchUrl($srchUrl, $this->DIANTAR_OLEH); // DIANTAR_OLEH
        $this->buildSearchUrl($srchUrl, $this->STATUS_PASIEN_ID); // STATUS_PASIEN_ID
        $this->buildSearchUrl($srchUrl, $this->RUJUKAN_ID); // RUJUKAN_ID
        $this->buildSearchUrl($srchUrl, $this->ADDRESS_OF_RUJUKAN); // ADDRESS_OF_RUJUKAN
        $this->buildSearchUrl($srchUrl, $this->REASON_ID); // REASON_ID
        $this->buildSearchUrl($srchUrl, $this->WAY_ID); // WAY_ID
        $this->buildSearchUrl($srchUrl, $this->PATIENT_CATEGORY_ID); // PATIENT_CATEGORY_ID
        $this->buildSearchUrl($srchUrl, $this->BOOKED_DATE); // BOOKED_DATE
        $this->buildSearchUrl($srchUrl, $this->VISIT_DATE); // VISIT_DATE
        $this->buildSearchUrl($srchUrl, $this->ISNEW); // ISNEW
        $this->buildSearchUrl($srchUrl, $this->FOLLOW_UP); // FOLLOW_UP
        $this->buildSearchUrl($srchUrl, $this->PLACE_TYPE); // PLACE_TYPE
        $this->buildSearchUrl($srchUrl, $this->TICKET_NO); // TICKET_NO
        $this->buildSearchUrl($srchUrl, $this->CLINIC_ID); // CLINIC_ID
        $this->buildSearchUrl($srchUrl, $this->CLINIC_ID_FROM); // CLINIC_ID_FROM
        $this->buildSearchUrl($srchUrl, $this->CLASS_ROOM_ID); // CLASS_ROOM_ID
        $this->buildSearchUrl($srchUrl, $this->BED_ID); // BED_ID
        $this->buildSearchUrl($srchUrl, $this->KELUAR_ID); // KELUAR_ID
        $this->buildSearchUrl($srchUrl, $this->IN_DATE); // IN_DATE
        $this->buildSearchUrl($srchUrl, $this->EXIT_DATE); // EXIT_DATE
        $this->buildSearchUrl($srchUrl, $this->GENDER); // GENDER
        $this->buildSearchUrl($srchUrl, $this->DESCRIPTION); // DESCRIPTION
        $this->buildSearchUrl($srchUrl, $this->VISITOR_ADDRESS); // VISITOR_ADDRESS
        $this->buildSearchUrl($srchUrl, $this->MODIFIED_BY); // MODIFIED_BY
        $this->buildSearchUrl($srchUrl, $this->MODIFIED_DATE); // MODIFIED_DATE
        $this->buildSearchUrl($srchUrl, $this->MODIFIED_FROM); // MODIFIED_FROM
        $this->buildSearchUrl($srchUrl, $this->EMPLOYEE_ID); // EMPLOYEE_ID
        $this->buildSearchUrl($srchUrl, $this->EMPLOYEE_ID_FROM); // EMPLOYEE_ID_FROM
        $this->buildSearchUrl($srchUrl, $this->RESPONSIBLE_ID); // RESPONSIBLE_ID
        $this->buildSearchUrl($srchUrl, $this->RESPONSIBLE); // RESPONSIBLE
        $this->buildSearchUrl($srchUrl, $this->FAMILY_STATUS_ID); // FAMILY_STATUS_ID
        $this->buildSearchUrl($srchUrl, $this->ISATTENDED); // ISATTENDED
        $this->buildSearchUrl($srchUrl, $this->PAYOR_ID); // PAYOR_ID
        $this->buildSearchUrl($srchUrl, $this->CLASS_ID); // CLASS_ID
        $this->buildSearchUrl($srchUrl, $this->ISPERTARIF); // ISPERTARIF
        $this->buildSearchUrl($srchUrl, $this->KAL_ID); // KAL_ID
        $this->buildSearchUrl($srchUrl, $this->EMPLOYEE_INAP); // EMPLOYEE_INAP
        $this->buildSearchUrl($srchUrl, $this->PASIEN_ID); // PASIEN_ID
        $this->buildSearchUrl($srchUrl, $this->KARYAWAN); // KARYAWAN
        $this->buildSearchUrl($srchUrl, $this->ACCOUNT_ID); // ACCOUNT_ID
        $this->buildSearchUrl($srchUrl, $this->CLASS_ID_PLAFOND); // CLASS_ID_PLAFOND
        $this->buildSearchUrl($srchUrl, $this->BACKCHARGE); // BACKCHARGE
        $this->buildSearchUrl($srchUrl, $this->COVERAGE_ID); // COVERAGE_ID
        $this->buildSearchUrl($srchUrl, $this->AGEYEAR); // AGEYEAR
        $this->buildSearchUrl($srchUrl, $this->AGEMONTH); // AGEMONTH
        $this->buildSearchUrl($srchUrl, $this->AGEDAY); // AGEDAY
        $this->buildSearchUrl($srchUrl, $this->RECOMENDATION); // RECOMENDATION
        $this->buildSearchUrl($srchUrl, $this->CONCLUSION); // CONCLUSION
        $this->buildSearchUrl($srchUrl, $this->SPECIMENNO); // SPECIMENNO
        $this->buildSearchUrl($srchUrl, $this->LOCKED); // LOCKED
        $this->buildSearchUrl($srchUrl, $this->RM_OUT_DATE); // RM_OUT_DATE
        $this->buildSearchUrl($srchUrl, $this->RM_IN_DATE); // RM_IN_DATE
        $this->buildSearchUrl($srchUrl, $this->LAMA_PINJAM); // LAMA_PINJAM
        $this->buildSearchUrl($srchUrl, $this->STANDAR_RJ); // STANDAR_RJ
        $this->buildSearchUrl($srchUrl, $this->LENGKAP_RJ); // LENGKAP_RJ
        $this->buildSearchUrl($srchUrl, $this->LENGKAP_RI); // LENGKAP_RI
        $this->buildSearchUrl($srchUrl, $this->RESEND_RM_DATE); // RESEND_RM_DATE
        $this->buildSearchUrl($srchUrl, $this->LENGKAP_RM1); // LENGKAP_RM1
        $this->buildSearchUrl($srchUrl, $this->LENGKAP_RESUME); // LENGKAP_RESUME
        $this->buildSearchUrl($srchUrl, $this->LENGKAP_ANAMNESIS); // LENGKAP_ANAMNESIS
        $this->buildSearchUrl($srchUrl, $this->LENGKAP_CONSENT); // LENGKAP_CONSENT
        $this->buildSearchUrl($srchUrl, $this->LENGKAP_ANESTESI); // LENGKAP_ANESTESI
        $this->buildSearchUrl($srchUrl, $this->LENGKAP_OP); // LENGKAP_OP
        $this->buildSearchUrl($srchUrl, $this->BACK_RM_DATE); // BACK_RM_DATE
        $this->buildSearchUrl($srchUrl, $this->VALID_RM_DATE); // VALID_RM_DATE
        $this->buildSearchUrl($srchUrl, $this->NO_SKP); // NO_SKP
        $this->buildSearchUrl($srchUrl, $this->NO_SKPINAP); // NO_SKPINAP
        $this->buildSearchUrl($srchUrl, $this->DIAGNOSA_ID); // DIAGNOSA_ID
        $this->buildSearchUrl($srchUrl, $this->ticket_all); // ticket_all
        $this->buildSearchUrl($srchUrl, $this->tanggal_rujukan); // tanggal_rujukan
        $this->buildSearchUrl($srchUrl, $this->ISRJ); // ISRJ
        $this->buildSearchUrl($srchUrl, $this->NORUJUKAN); // NORUJUKAN
        $this->buildSearchUrl($srchUrl, $this->PPKRUJUKAN); // PPKRUJUKAN
        $this->buildSearchUrl($srchUrl, $this->LOKASILAKA); // LOKASILAKA
        $this->buildSearchUrl($srchUrl, $this->KDPOLI); // KDPOLI
        $this->buildSearchUrl($srchUrl, $this->EDIT_SEP); // EDIT_SEP
        $this->buildSearchUrl($srchUrl, $this->DELETE_SEP); // DELETE_SEP
        $this->buildSearchUrl($srchUrl, $this->KODE_AGAMA); // KODE_AGAMA
        $this->buildSearchUrl($srchUrl, $this->DIAG_AWAL); // DIAG_AWAL
        $this->buildSearchUrl($srchUrl, $this->AKTIF); // AKTIF
        $this->buildSearchUrl($srchUrl, $this->BILL_INAP); // BILL_INAP
        $this->buildSearchUrl($srchUrl, $this->SEP_PRINTDATE); // SEP_PRINTDATE
        $this->buildSearchUrl($srchUrl, $this->MAPPING_SEP); // MAPPING_SEP
        $this->buildSearchUrl($srchUrl, $this->TRANS_ID); // TRANS_ID
        $this->buildSearchUrl($srchUrl, $this->KDPOLI_EKS); // KDPOLI_EKS
        $this->buildSearchUrl($srchUrl, $this->COB); // COB
        $this->buildSearchUrl($srchUrl, $this->PENJAMIN); // PENJAMIN
        $this->buildSearchUrl($srchUrl, $this->ASALRUJUKAN); // ASALRUJUKAN
        $this->buildSearchUrl($srchUrl, $this->RESPONSEP); // RESPONSEP
        $this->buildSearchUrl($srchUrl, $this->APPROVAL_DESC); // APPROVAL_DESC
        $this->buildSearchUrl($srchUrl, $this->APPROVAL_RESPONAJUKAN); // APPROVAL_RESPONAJUKAN
        $this->buildSearchUrl($srchUrl, $this->APPROVAL_RESPONAPPROV); // APPROVAL_RESPONAPPROV
        $this->buildSearchUrl($srchUrl, $this->RESPONTGLPLG_DESC); // RESPONTGLPLG_DESC
        $this->buildSearchUrl($srchUrl, $this->RESPONPOST_VKLAIM); // RESPONPOST_VKLAIM
        $this->buildSearchUrl($srchUrl, $this->RESPONPUT_VKLAIM); // RESPONPUT_VKLAIM
        $this->buildSearchUrl($srchUrl, $this->RESPONDEL_VKLAIM); // RESPONDEL_VKLAIM
        $this->buildSearchUrl($srchUrl, $this->CALL_TIMES); // CALL_TIMES
        $this->buildSearchUrl($srchUrl, $this->CALL_DATE); // CALL_DATE
        $this->buildSearchUrl($srchUrl, $this->CALL_DATES); // CALL_DATES
        $this->buildSearchUrl($srchUrl, $this->SERVED_DATE); // SERVED_DATE
        $this->buildSearchUrl($srchUrl, $this->SERVED_INAP); // SERVED_INAP
        $this->buildSearchUrl($srchUrl, $this->KDDPJP1); // KDDPJP1
        $this->buildSearchUrl($srchUrl, $this->KDDPJP); // KDDPJP
        $this->buildSearchUrl($srchUrl, $this->IDXDAFTAR); // IDXDAFTAR
        $this->buildSearchUrl($srchUrl, $this->tgl_kontrol); // tgl_kontrol
        $this->buildSearchUrl($srchUrl, $this->idbooking); // idbooking
        $this->buildSearchUrl($srchUrl, $this->id_tujuan); // id_tujuan
        $this->buildSearchUrl($srchUrl, $this->id_penunjang); // id_penunjang
        $this->buildSearchUrl($srchUrl, $this->id_pembiayaan); // id_pembiayaan
        $this->buildSearchUrl($srchUrl, $this->id_procedure); // id_procedure
        $this->buildSearchUrl($srchUrl, $this->id_aspel); // id_aspel
        $this->buildSearchUrl($srchUrl, $this->id_kelas); // id_kelas
        if ($srchUrl != "") {
            $srchUrl .= "&";
        }
        $srchUrl .= "cmd=search";
        return $srchUrl;
    }

    // Build search URL
    protected function buildSearchUrl(&$url, &$fld, $oprOnly = false)
    {
        global $CurrentForm;
        $wrk = "";
        $fldParm = $fld->Param;
        $fldVal = $CurrentForm->getValue("x_$fldParm");
        $fldOpr = $CurrentForm->getValue("z_$fldParm");
        $fldCond = $CurrentForm->getValue("v_$fldParm");
        $fldVal2 = $CurrentForm->getValue("y_$fldParm");
        $fldOpr2 = $CurrentForm->getValue("w_$fldParm");
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr));
        $fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
        if ($fldOpr == "BETWEEN") {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
            if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
                $wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
                    "&y_" . $fldParm . "=" . urlencode($fldVal2) .
                    "&z_" . $fldParm . "=" . urlencode($fldOpr);
            }
        } else {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
            if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
                $wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
                    "&z_" . $fldParm . "=" . urlencode($fldOpr);
            } elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
                $wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
            }
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
            if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
                if ($wrk != "") {
                    $wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
                }
                $wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
                    "&w_" . $fldParm . "=" . urlencode($fldOpr2);
            } elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
                if ($wrk != "") {
                    $wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
                }
                $wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
            }
        }
        if ($wrk != "") {
            if ($url != "") {
                $url .= "&";
            }
            $url .= $wrk;
        }
    }

    // Check if search value is numeric
    protected function searchValueIsNumeric($fld, $value)
    {
        if (IsFloatFormat($fld->Type)) {
            $value = ConvertToFloatString($value);
        }
        return is_numeric($value);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;
        if ($this->NO_REGISTRATION->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->DIANTAR_OLEH->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->STATUS_PASIEN_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RUJUKAN_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->ADDRESS_OF_RUJUKAN->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->REASON_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->WAY_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->PATIENT_CATEGORY_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->BOOKED_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->VISIT_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->ISNEW->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->FOLLOW_UP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->PLACE_TYPE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->TICKET_NO->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CLINIC_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CLINIC_ID_FROM->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CLASS_ROOM_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->BED_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->KELUAR_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->IN_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->EXIT_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->GENDER->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->DESCRIPTION->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->VISITOR_ADDRESS->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->MODIFIED_BY->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->MODIFIED_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->MODIFIED_FROM->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->EMPLOYEE_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->EMPLOYEE_ID_FROM->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RESPONSIBLE_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RESPONSIBLE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->FAMILY_STATUS_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->ISATTENDED->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->PAYOR_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CLASS_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->ISPERTARIF->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->KAL_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->EMPLOYEE_INAP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->PASIEN_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->KARYAWAN->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->ACCOUNT_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CLASS_ID_PLAFOND->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->BACKCHARGE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->COVERAGE_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->AGEYEAR->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->AGEMONTH->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->AGEDAY->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RECOMENDATION->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CONCLUSION->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->SPECIMENNO->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LOCKED->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RM_OUT_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RM_IN_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LAMA_PINJAM->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->STANDAR_RJ->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LENGKAP_RJ->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LENGKAP_RI->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RESEND_RM_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LENGKAP_RM1->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LENGKAP_RESUME->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LENGKAP_ANAMNESIS->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LENGKAP_CONSENT->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LENGKAP_ANESTESI->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LENGKAP_OP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->BACK_RM_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->VALID_RM_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->NO_SKP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->NO_SKPINAP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->DIAGNOSA_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->ticket_all->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->tanggal_rujukan->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->ISRJ->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->NORUJUKAN->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->PPKRUJUKAN->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->LOKASILAKA->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->KDPOLI->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->EDIT_SEP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->DELETE_SEP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->KODE_AGAMA->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->DIAG_AWAL->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->AKTIF->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->BILL_INAP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->SEP_PRINTDATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->MAPPING_SEP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->TRANS_ID->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->KDPOLI_EKS->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->COB->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->PENJAMIN->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->ASALRUJUKAN->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RESPONSEP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->APPROVAL_DESC->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->APPROVAL_RESPONAJUKAN->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->APPROVAL_RESPONAPPROV->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RESPONTGLPLG_DESC->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RESPONPOST_VKLAIM->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RESPONPUT_VKLAIM->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->RESPONDEL_VKLAIM->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CALL_TIMES->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CALL_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->CALL_DATES->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->SERVED_DATE->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->SERVED_INAP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->KDDPJP1->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->KDDPJP->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->IDXDAFTAR->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->tgl_kontrol->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->idbooking->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->id_tujuan->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->id_penunjang->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->id_pembiayaan->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->id_procedure->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->id_aspel->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->id_kelas->AdvancedSearch->post()) {
            $hasValue = true;
        }
        return $hasValue;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE

        // NO_REGISTRATION

        // DIANTAR_OLEH

        // VISIT_ID

        // STATUS_PASIEN_ID

        // RUJUKAN_ID

        // ADDRESS_OF_RUJUKAN

        // REASON_ID

        // WAY_ID

        // PATIENT_CATEGORY_ID

        // BOOKED_DATE

        // VISIT_DATE

        // ISNEW

        // FOLLOW_UP

        // PLACE_TYPE

        // TICKET_NO

        // CLINIC_ID

        // CLINIC_ID_FROM

        // CLASS_ROOM_ID

        // BED_ID

        // KELUAR_ID

        // IN_DATE

        // EXIT_DATE

        // GENDER

        // DESCRIPTION

        // VISITOR_ADDRESS

        // MODIFIED_BY

        // MODIFIED_DATE

        // MODIFIED_FROM

        // EMPLOYEE_ID

        // EMPLOYEE_ID_FROM

        // RESPONSIBLE_ID

        // RESPONSIBLE

        // FAMILY_STATUS_ID

        // ISATTENDED

        // PAYOR_ID

        // CLASS_ID

        // ISPERTARIF

        // KAL_ID

        // EMPLOYEE_INAP

        // PASIEN_ID

        // KARYAWAN

        // ACCOUNT_ID

        // CLASS_ID_PLAFOND

        // BACKCHARGE

        // COVERAGE_ID

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // RECOMENDATION

        // CONCLUSION

        // SPECIMENNO

        // LOCKED

        // RM_OUT_DATE

        // RM_IN_DATE

        // LAMA_PINJAM

        // STANDAR_RJ

        // LENGKAP_RJ

        // LENGKAP_RI

        // RESEND_RM_DATE

        // LENGKAP_RM1

        // LENGKAP_RESUME

        // LENGKAP_ANAMNESIS

        // LENGKAP_CONSENT

        // LENGKAP_ANESTESI

        // LENGKAP_OP

        // BACK_RM_DATE

        // VALID_RM_DATE

        // NO_SKP

        // NO_SKPINAP

        // DIAGNOSA_ID

        // ticket_all

        // tanggal_rujukan

        // ISRJ

        // NORUJUKAN

        // PPKRUJUKAN

        // LOKASILAKA

        // KDPOLI

        // EDIT_SEP

        // DELETE_SEP

        // KODE_AGAMA

        // DIAG_AWAL

        // AKTIF

        // BILL_INAP

        // SEP_PRINTDATE

        // MAPPING_SEP

        // TRANS_ID

        // KDPOLI_EKS

        // COB

        // PENJAMIN

        // ASALRUJUKAN

        // RESPONSEP

        // APPROVAL_DESC

        // APPROVAL_RESPONAJUKAN

        // APPROVAL_RESPONAPPROV

        // RESPONTGLPLG_DESC

        // RESPONPOST_VKLAIM

        // RESPONPUT_VKLAIM

        // RESPONDEL_VKLAIM

        // CALL_TIMES

        // CALL_DATE

        // CALL_DATES

        // SERVED_DATE

        // SERVED_INAP

        // KDDPJP1

        // KDDPJP

        // IDXDAFTAR

        // tgl_kontrol

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

            // BOOKED_DATE
            $this->BOOKED_DATE->ViewValue = $this->BOOKED_DATE->CurrentValue;
            $this->BOOKED_DATE->ViewValue = FormatDateTime($this->BOOKED_DATE->ViewValue, 11);
            $this->BOOKED_DATE->ViewCustomAttributes = "";

            // VISIT_DATE
            $this->VISIT_DATE->ViewValue = $this->VISIT_DATE->CurrentValue;
            $this->VISIT_DATE->ViewValue = FormatDateTime($this->VISIT_DATE->ViewValue, 11);
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

            // TICKET_NO
            $this->TICKET_NO->ViewValue = $this->TICKET_NO->CurrentValue;
            $this->TICKET_NO->ViewValue = FormatNumber($this->TICKET_NO->ViewValue, 0, -2, -2, -2);
            $this->TICKET_NO->ViewCustomAttributes = "";

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

            // NORUJUKAN
            $this->NORUJUKAN->ViewValue = $this->NORUJUKAN->CurrentValue;
            $this->NORUJUKAN->ViewCustomAttributes = "";

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
            if (strval($this->KDPOLI_EKS->CurrentValue) != "") {
                $this->KDPOLI_EKS->ViewValue = $this->KDPOLI_EKS->optionCaption($this->KDPOLI_EKS->CurrentValue);
            } else {
                $this->KDPOLI_EKS->ViewValue = null;
            }
            $this->KDPOLI_EKS->ViewCustomAttributes = "";

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

            // ASALRUJUKAN
            if (strval($this->ASALRUJUKAN->CurrentValue) != "") {
                $this->ASALRUJUKAN->ViewValue = $this->ASALRUJUKAN->optionCaption($this->ASALRUJUKAN->CurrentValue);
            } else {
                $this->ASALRUJUKAN->ViewValue = null;
            }
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
            if (strval($this->RESPONTGLPLG_DESC->CurrentValue) != "") {
                $this->RESPONTGLPLG_DESC->ViewValue = $this->RESPONTGLPLG_DESC->optionCaption($this->RESPONTGLPLG_DESC->CurrentValue);
            } else {
                $this->RESPONTGLPLG_DESC->ViewValue = null;
            }
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

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // DIANTAR_OLEH
            $this->DIANTAR_OLEH->LinkCustomAttributes = "";
            $this->DIANTAR_OLEH->HrefValue = "";
            $this->DIANTAR_OLEH->TooltipValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";
            $this->STATUS_PASIEN_ID->TooltipValue = "";

            // RUJUKAN_ID
            $this->RUJUKAN_ID->LinkCustomAttributes = "";
            $this->RUJUKAN_ID->HrefValue = "";
            $this->RUJUKAN_ID->TooltipValue = "";

            // ADDRESS_OF_RUJUKAN
            $this->ADDRESS_OF_RUJUKAN->LinkCustomAttributes = "";
            $this->ADDRESS_OF_RUJUKAN->HrefValue = "";
            $this->ADDRESS_OF_RUJUKAN->TooltipValue = "";

            // REASON_ID
            $this->REASON_ID->LinkCustomAttributes = "";
            $this->REASON_ID->HrefValue = "";
            $this->REASON_ID->TooltipValue = "";

            // WAY_ID
            $this->WAY_ID->LinkCustomAttributes = "";
            $this->WAY_ID->HrefValue = "";
            $this->WAY_ID->TooltipValue = "";

            // PATIENT_CATEGORY_ID
            $this->PATIENT_CATEGORY_ID->LinkCustomAttributes = "";
            $this->PATIENT_CATEGORY_ID->HrefValue = "";
            $this->PATIENT_CATEGORY_ID->TooltipValue = "";

            // BOOKED_DATE
            $this->BOOKED_DATE->LinkCustomAttributes = "";
            $this->BOOKED_DATE->HrefValue = "";
            $this->BOOKED_DATE->TooltipValue = "";

            // VISIT_DATE
            $this->VISIT_DATE->LinkCustomAttributes = "";
            $this->VISIT_DATE->HrefValue = "";
            $this->VISIT_DATE->TooltipValue = "";

            // ISNEW
            $this->ISNEW->LinkCustomAttributes = "";
            $this->ISNEW->HrefValue = "";
            $this->ISNEW->TooltipValue = "";

            // FOLLOW_UP
            $this->FOLLOW_UP->LinkCustomAttributes = "";
            $this->FOLLOW_UP->HrefValue = "";
            $this->FOLLOW_UP->TooltipValue = "";

            // PLACE_TYPE
            $this->PLACE_TYPE->LinkCustomAttributes = "";
            $this->PLACE_TYPE->HrefValue = "";
            $this->PLACE_TYPE->TooltipValue = "";

            // TICKET_NO
            $this->TICKET_NO->LinkCustomAttributes = "";
            $this->TICKET_NO->HrefValue = "";
            $this->TICKET_NO->TooltipValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";
            $this->CLINIC_ID->TooltipValue = "";

            // CLINIC_ID_FROM
            $this->CLINIC_ID_FROM->LinkCustomAttributes = "";
            $this->CLINIC_ID_FROM->HrefValue = "";
            $this->CLINIC_ID_FROM->TooltipValue = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
            $this->CLASS_ROOM_ID->HrefValue = "";
            $this->CLASS_ROOM_ID->TooltipValue = "";

            // BED_ID
            $this->BED_ID->LinkCustomAttributes = "";
            $this->BED_ID->HrefValue = "";
            $this->BED_ID->TooltipValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->LinkCustomAttributes = "";
            $this->KELUAR_ID->HrefValue = "";
            $this->KELUAR_ID->TooltipValue = "";

            // IN_DATE
            $this->IN_DATE->LinkCustomAttributes = "";
            $this->IN_DATE->HrefValue = "";
            $this->IN_DATE->TooltipValue = "";

            // EXIT_DATE
            $this->EXIT_DATE->LinkCustomAttributes = "";
            $this->EXIT_DATE->HrefValue = "";
            $this->EXIT_DATE->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";
            $this->DESCRIPTION->TooltipValue = "";

            // VISITOR_ADDRESS
            $this->VISITOR_ADDRESS->LinkCustomAttributes = "";
            $this->VISITOR_ADDRESS->HrefValue = "";
            $this->VISITOR_ADDRESS->TooltipValue = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->LinkCustomAttributes = "";
            $this->MODIFIED_BY->HrefValue = "";
            $this->MODIFIED_BY->TooltipValue = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->LinkCustomAttributes = "";
            $this->MODIFIED_DATE->HrefValue = "";
            $this->MODIFIED_DATE->TooltipValue = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->LinkCustomAttributes = "";
            $this->MODIFIED_FROM->HrefValue = "";
            $this->MODIFIED_FROM->TooltipValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";
            $this->EMPLOYEE_ID->TooltipValue = "";

            // EMPLOYEE_ID_FROM
            $this->EMPLOYEE_ID_FROM->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID_FROM->HrefValue = "";
            $this->EMPLOYEE_ID_FROM->TooltipValue = "";

            // RESPONSIBLE_ID
            $this->RESPONSIBLE_ID->LinkCustomAttributes = "";
            $this->RESPONSIBLE_ID->HrefValue = "";
            $this->RESPONSIBLE_ID->TooltipValue = "";

            // RESPONSIBLE
            $this->RESPONSIBLE->LinkCustomAttributes = "";
            $this->RESPONSIBLE->HrefValue = "";
            $this->RESPONSIBLE->TooltipValue = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
            $this->FAMILY_STATUS_ID->HrefValue = "";
            $this->FAMILY_STATUS_ID->TooltipValue = "";

            // ISATTENDED
            $this->ISATTENDED->LinkCustomAttributes = "";
            $this->ISATTENDED->HrefValue = "";
            $this->ISATTENDED->TooltipValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";
            $this->PAYOR_ID->TooltipValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";
            $this->CLASS_ID->TooltipValue = "";

            // ISPERTARIF
            $this->ISPERTARIF->LinkCustomAttributes = "";
            $this->ISPERTARIF->HrefValue = "";
            $this->ISPERTARIF->TooltipValue = "";

            // KAL_ID
            $this->KAL_ID->LinkCustomAttributes = "";
            $this->KAL_ID->HrefValue = "";
            $this->KAL_ID->TooltipValue = "";

            // EMPLOYEE_INAP
            $this->EMPLOYEE_INAP->LinkCustomAttributes = "";
            $this->EMPLOYEE_INAP->HrefValue = "";
            $this->EMPLOYEE_INAP->TooltipValue = "";

            // PASIEN_ID
            $this->PASIEN_ID->LinkCustomAttributes = "";
            $this->PASIEN_ID->HrefValue = "";
            $this->PASIEN_ID->TooltipValue = "";

            // KARYAWAN
            $this->KARYAWAN->LinkCustomAttributes = "";
            $this->KARYAWAN->HrefValue = "";
            $this->KARYAWAN->TooltipValue = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->LinkCustomAttributes = "";
            $this->ACCOUNT_ID->HrefValue = "";
            $this->ACCOUNT_ID->TooltipValue = "";

            // CLASS_ID_PLAFOND
            $this->CLASS_ID_PLAFOND->LinkCustomAttributes = "";
            $this->CLASS_ID_PLAFOND->HrefValue = "";
            $this->CLASS_ID_PLAFOND->TooltipValue = "";

            // BACKCHARGE
            $this->BACKCHARGE->LinkCustomAttributes = "";
            $this->BACKCHARGE->HrefValue = "";
            $this->BACKCHARGE->TooltipValue = "";

            // COVERAGE_ID
            $this->COVERAGE_ID->LinkCustomAttributes = "";
            $this->COVERAGE_ID->HrefValue = "";
            $this->COVERAGE_ID->TooltipValue = "";

            // AGEYEAR
            $this->AGEYEAR->LinkCustomAttributes = "";
            $this->AGEYEAR->HrefValue = "";
            $this->AGEYEAR->TooltipValue = "";

            // AGEMONTH
            $this->AGEMONTH->LinkCustomAttributes = "";
            $this->AGEMONTH->HrefValue = "";
            $this->AGEMONTH->TooltipValue = "";

            // AGEDAY
            $this->AGEDAY->LinkCustomAttributes = "";
            $this->AGEDAY->HrefValue = "";
            $this->AGEDAY->TooltipValue = "";

            // RECOMENDATION
            $this->RECOMENDATION->LinkCustomAttributes = "";
            $this->RECOMENDATION->HrefValue = "";
            $this->RECOMENDATION->TooltipValue = "";

            // CONCLUSION
            $this->CONCLUSION->LinkCustomAttributes = "";
            $this->CONCLUSION->HrefValue = "";
            $this->CONCLUSION->TooltipValue = "";

            // SPECIMENNO
            $this->SPECIMENNO->LinkCustomAttributes = "";
            $this->SPECIMENNO->HrefValue = "";
            $this->SPECIMENNO->TooltipValue = "";

            // LOCKED
            $this->LOCKED->LinkCustomAttributes = "";
            $this->LOCKED->HrefValue = "";
            $this->LOCKED->TooltipValue = "";

            // RM_OUT_DATE
            $this->RM_OUT_DATE->LinkCustomAttributes = "";
            $this->RM_OUT_DATE->HrefValue = "";
            $this->RM_OUT_DATE->TooltipValue = "";

            // RM_IN_DATE
            $this->RM_IN_DATE->LinkCustomAttributes = "";
            $this->RM_IN_DATE->HrefValue = "";
            $this->RM_IN_DATE->TooltipValue = "";

            // LAMA_PINJAM
            $this->LAMA_PINJAM->LinkCustomAttributes = "";
            $this->LAMA_PINJAM->HrefValue = "";
            $this->LAMA_PINJAM->TooltipValue = "";

            // STANDAR_RJ
            $this->STANDAR_RJ->LinkCustomAttributes = "";
            $this->STANDAR_RJ->HrefValue = "";
            $this->STANDAR_RJ->TooltipValue = "";

            // LENGKAP_RJ
            $this->LENGKAP_RJ->LinkCustomAttributes = "";
            $this->LENGKAP_RJ->HrefValue = "";
            $this->LENGKAP_RJ->TooltipValue = "";

            // LENGKAP_RI
            $this->LENGKAP_RI->LinkCustomAttributes = "";
            $this->LENGKAP_RI->HrefValue = "";
            $this->LENGKAP_RI->TooltipValue = "";

            // RESEND_RM_DATE
            $this->RESEND_RM_DATE->LinkCustomAttributes = "";
            $this->RESEND_RM_DATE->HrefValue = "";
            $this->RESEND_RM_DATE->TooltipValue = "";

            // LENGKAP_RM1
            $this->LENGKAP_RM1->LinkCustomAttributes = "";
            $this->LENGKAP_RM1->HrefValue = "";
            $this->LENGKAP_RM1->TooltipValue = "";

            // LENGKAP_RESUME
            $this->LENGKAP_RESUME->LinkCustomAttributes = "";
            $this->LENGKAP_RESUME->HrefValue = "";
            $this->LENGKAP_RESUME->TooltipValue = "";

            // LENGKAP_ANAMNESIS
            $this->LENGKAP_ANAMNESIS->LinkCustomAttributes = "";
            $this->LENGKAP_ANAMNESIS->HrefValue = "";
            $this->LENGKAP_ANAMNESIS->TooltipValue = "";

            // LENGKAP_CONSENT
            $this->LENGKAP_CONSENT->LinkCustomAttributes = "";
            $this->LENGKAP_CONSENT->HrefValue = "";
            $this->LENGKAP_CONSENT->TooltipValue = "";

            // LENGKAP_ANESTESI
            $this->LENGKAP_ANESTESI->LinkCustomAttributes = "";
            $this->LENGKAP_ANESTESI->HrefValue = "";
            $this->LENGKAP_ANESTESI->TooltipValue = "";

            // LENGKAP_OP
            $this->LENGKAP_OP->LinkCustomAttributes = "";
            $this->LENGKAP_OP->HrefValue = "";
            $this->LENGKAP_OP->TooltipValue = "";

            // BACK_RM_DATE
            $this->BACK_RM_DATE->LinkCustomAttributes = "";
            $this->BACK_RM_DATE->HrefValue = "";
            $this->BACK_RM_DATE->TooltipValue = "";

            // VALID_RM_DATE
            $this->VALID_RM_DATE->LinkCustomAttributes = "";
            $this->VALID_RM_DATE->HrefValue = "";
            $this->VALID_RM_DATE->TooltipValue = "";

            // NO_SKP
            $this->NO_SKP->LinkCustomAttributes = "";
            $this->NO_SKP->HrefValue = "";
            $this->NO_SKP->TooltipValue = "";

            // NO_SKPINAP
            $this->NO_SKPINAP->LinkCustomAttributes = "";
            $this->NO_SKPINAP->HrefValue = "";
            $this->NO_SKPINAP->TooltipValue = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->LinkCustomAttributes = "";
            $this->DIAGNOSA_ID->HrefValue = "";
            $this->DIAGNOSA_ID->TooltipValue = "";

            // ticket_all
            $this->ticket_all->LinkCustomAttributes = "";
            $this->ticket_all->HrefValue = "";
            $this->ticket_all->TooltipValue = "";

            // tanggal_rujukan
            $this->tanggal_rujukan->LinkCustomAttributes = "";
            $this->tanggal_rujukan->HrefValue = "";
            $this->tanggal_rujukan->TooltipValue = "";

            // ISRJ
            $this->ISRJ->LinkCustomAttributes = "";
            $this->ISRJ->HrefValue = "";
            $this->ISRJ->TooltipValue = "";

            // NORUJUKAN
            $this->NORUJUKAN->LinkCustomAttributes = "";
            $this->NORUJUKAN->HrefValue = "";
            $this->NORUJUKAN->TooltipValue = "";

            // PPKRUJUKAN
            $this->PPKRUJUKAN->LinkCustomAttributes = "";
            $this->PPKRUJUKAN->HrefValue = "";
            $this->PPKRUJUKAN->TooltipValue = "";

            // LOKASILAKA
            $this->LOKASILAKA->LinkCustomAttributes = "";
            $this->LOKASILAKA->HrefValue = "";
            $this->LOKASILAKA->TooltipValue = "";

            // KDPOLI
            $this->KDPOLI->LinkCustomAttributes = "";
            $this->KDPOLI->HrefValue = "";
            $this->KDPOLI->TooltipValue = "";

            // EDIT_SEP
            $this->EDIT_SEP->LinkCustomAttributes = "";
            $this->EDIT_SEP->HrefValue = "";
            $this->EDIT_SEP->TooltipValue = "";

            // DELETE_SEP
            $this->DELETE_SEP->LinkCustomAttributes = "";
            $this->DELETE_SEP->HrefValue = "";
            $this->DELETE_SEP->TooltipValue = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->LinkCustomAttributes = "";
            $this->KODE_AGAMA->HrefValue = "";
            $this->KODE_AGAMA->TooltipValue = "";

            // DIAG_AWAL
            $this->DIAG_AWAL->LinkCustomAttributes = "";
            $this->DIAG_AWAL->HrefValue = "";
            $this->DIAG_AWAL->TooltipValue = "";

            // AKTIF
            $this->AKTIF->LinkCustomAttributes = "";
            $this->AKTIF->HrefValue = "";
            $this->AKTIF->TooltipValue = "";

            // BILL_INAP
            $this->BILL_INAP->LinkCustomAttributes = "";
            $this->BILL_INAP->HrefValue = "";
            $this->BILL_INAP->TooltipValue = "";

            // SEP_PRINTDATE
            $this->SEP_PRINTDATE->LinkCustomAttributes = "";
            $this->SEP_PRINTDATE->HrefValue = "";
            $this->SEP_PRINTDATE->TooltipValue = "";

            // MAPPING_SEP
            $this->MAPPING_SEP->LinkCustomAttributes = "";
            $this->MAPPING_SEP->HrefValue = "";
            $this->MAPPING_SEP->TooltipValue = "";

            // TRANS_ID
            $this->TRANS_ID->LinkCustomAttributes = "";
            $this->TRANS_ID->HrefValue = "";
            $this->TRANS_ID->TooltipValue = "";

            // KDPOLI_EKS
            $this->KDPOLI_EKS->LinkCustomAttributes = "";
            $this->KDPOLI_EKS->HrefValue = "";
            $this->KDPOLI_EKS->TooltipValue = "";

            // COB
            $this->COB->LinkCustomAttributes = "";
            $this->COB->HrefValue = "";
            $this->COB->TooltipValue = "";

            // PENJAMIN
            $this->PENJAMIN->LinkCustomAttributes = "";
            $this->PENJAMIN->HrefValue = "";
            $this->PENJAMIN->TooltipValue = "";

            // ASALRUJUKAN
            $this->ASALRUJUKAN->LinkCustomAttributes = "";
            $this->ASALRUJUKAN->HrefValue = "";
            $this->ASALRUJUKAN->TooltipValue = "";

            // RESPONSEP
            $this->RESPONSEP->LinkCustomAttributes = "";
            $this->RESPONSEP->HrefValue = "";
            $this->RESPONSEP->TooltipValue = "";

            // APPROVAL_DESC
            $this->APPROVAL_DESC->LinkCustomAttributes = "";
            $this->APPROVAL_DESC->HrefValue = "";
            $this->APPROVAL_DESC->TooltipValue = "";

            // APPROVAL_RESPONAJUKAN
            $this->APPROVAL_RESPONAJUKAN->LinkCustomAttributes = "";
            $this->APPROVAL_RESPONAJUKAN->HrefValue = "";
            $this->APPROVAL_RESPONAJUKAN->TooltipValue = "";

            // APPROVAL_RESPONAPPROV
            $this->APPROVAL_RESPONAPPROV->LinkCustomAttributes = "";
            $this->APPROVAL_RESPONAPPROV->HrefValue = "";
            $this->APPROVAL_RESPONAPPROV->TooltipValue = "";

            // RESPONTGLPLG_DESC
            $this->RESPONTGLPLG_DESC->LinkCustomAttributes = "";
            $this->RESPONTGLPLG_DESC->HrefValue = "";
            $this->RESPONTGLPLG_DESC->TooltipValue = "";

            // RESPONPOST_VKLAIM
            $this->RESPONPOST_VKLAIM->LinkCustomAttributes = "";
            $this->RESPONPOST_VKLAIM->HrefValue = "";
            $this->RESPONPOST_VKLAIM->TooltipValue = "";

            // RESPONPUT_VKLAIM
            $this->RESPONPUT_VKLAIM->LinkCustomAttributes = "";
            $this->RESPONPUT_VKLAIM->HrefValue = "";
            $this->RESPONPUT_VKLAIM->TooltipValue = "";

            // RESPONDEL_VKLAIM
            $this->RESPONDEL_VKLAIM->LinkCustomAttributes = "";
            $this->RESPONDEL_VKLAIM->HrefValue = "";
            $this->RESPONDEL_VKLAIM->TooltipValue = "";

            // CALL_TIMES
            $this->CALL_TIMES->LinkCustomAttributes = "";
            $this->CALL_TIMES->HrefValue = "";
            $this->CALL_TIMES->TooltipValue = "";

            // CALL_DATE
            $this->CALL_DATE->LinkCustomAttributes = "";
            $this->CALL_DATE->HrefValue = "";
            $this->CALL_DATE->TooltipValue = "";

            // CALL_DATES
            $this->CALL_DATES->LinkCustomAttributes = "";
            $this->CALL_DATES->HrefValue = "";
            $this->CALL_DATES->TooltipValue = "";

            // SERVED_DATE
            $this->SERVED_DATE->LinkCustomAttributes = "";
            $this->SERVED_DATE->HrefValue = "";
            $this->SERVED_DATE->TooltipValue = "";

            // SERVED_INAP
            $this->SERVED_INAP->LinkCustomAttributes = "";
            $this->SERVED_INAP->HrefValue = "";
            $this->SERVED_INAP->TooltipValue = "";

            // KDDPJP1
            $this->KDDPJP1->LinkCustomAttributes = "";
            $this->KDDPJP1->HrefValue = "";
            $this->KDDPJP1->TooltipValue = "";

            // KDDPJP
            $this->KDDPJP->LinkCustomAttributes = "";
            $this->KDDPJP->HrefValue = "";
            $this->KDDPJP->TooltipValue = "";

            // IDXDAFTAR
            $this->IDXDAFTAR->LinkCustomAttributes = "";
            $this->IDXDAFTAR->HrefValue = "";
            $this->IDXDAFTAR->TooltipValue = "";

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
            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditCustomAttributes = "";
            $curVal = trim(strval($this->NO_REGISTRATION->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->NO_REGISTRATION->AdvancedSearch->ViewValue = $this->NO_REGISTRATION->lookupCacheOption($curVal);
            } else {
                $this->NO_REGISTRATION->AdvancedSearch->ViewValue = $this->NO_REGISTRATION->Lookup !== null && is_array($this->NO_REGISTRATION->Lookup->Options) ? $curVal : null;
            }
            if ($this->NO_REGISTRATION->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->NO_REGISTRATION->EditValue = array_values($this->NO_REGISTRATION->Lookup->Options);
                if ($this->NO_REGISTRATION->AdvancedSearch->ViewValue == "") {
                    $this->NO_REGISTRATION->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[NO_REGISTRATION]" . SearchString("=", $this->NO_REGISTRATION->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->NO_REGISTRATION->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->NO_REGISTRATION->Lookup->renderViewRow($rswrk[0]);
                    $this->NO_REGISTRATION->AdvancedSearch->ViewValue = $this->NO_REGISTRATION->displayValue($arwrk);
                } else {
                    $this->NO_REGISTRATION->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->NO_REGISTRATION->EditValue = $arwrk;
            }
            $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

            // DIANTAR_OLEH
            $this->DIANTAR_OLEH->EditAttrs["class"] = "form-control";
            $this->DIANTAR_OLEH->EditCustomAttributes = "";
            if (!$this->DIANTAR_OLEH->Raw) {
                $this->DIANTAR_OLEH->AdvancedSearch->SearchValue = HtmlDecode($this->DIANTAR_OLEH->AdvancedSearch->SearchValue);
            }
            $this->DIANTAR_OLEH->EditValue = HtmlEncode($this->DIANTAR_OLEH->AdvancedSearch->SearchValue);
            $this->DIANTAR_OLEH->PlaceHolder = RemoveHtml($this->DIANTAR_OLEH->caption());

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->STATUS_PASIEN_ID->AdvancedSearch->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
            } else {
                $this->STATUS_PASIEN_ID->AdvancedSearch->ViewValue = $this->STATUS_PASIEN_ID->Lookup !== null && is_array($this->STATUS_PASIEN_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->STATUS_PASIEN_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->STATUS_PASIEN_ID->EditValue = array_values($this->STATUS_PASIEN_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $this->STATUS_PASIEN_ID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
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

            // RUJUKAN_ID
            $this->RUJUKAN_ID->EditAttrs["class"] = "form-control";
            $this->RUJUKAN_ID->EditCustomAttributes = "";
            $this->RUJUKAN_ID->EditValue = HtmlEncode($this->RUJUKAN_ID->AdvancedSearch->SearchValue);
            $curVal = trim(strval($this->RUJUKAN_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->RUJUKAN_ID->EditValue = $this->RUJUKAN_ID->lookupCacheOption($curVal);
                if ($this->RUJUKAN_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[RUJUKAN_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->RUJUKAN_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->RUJUKAN_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->RUJUKAN_ID->EditValue = $this->RUJUKAN_ID->displayValue($arwrk);
                    } else {
                        $this->RUJUKAN_ID->EditValue = HtmlEncode($this->RUJUKAN_ID->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->RUJUKAN_ID->EditValue = null;
            }
            $this->RUJUKAN_ID->PlaceHolder = RemoveHtml($this->RUJUKAN_ID->caption());

            // ADDRESS_OF_RUJUKAN
            $this->ADDRESS_OF_RUJUKAN->EditAttrs["class"] = "form-control";
            $this->ADDRESS_OF_RUJUKAN->EditCustomAttributes = "";
            if (!$this->ADDRESS_OF_RUJUKAN->Raw) {
                $this->ADDRESS_OF_RUJUKAN->AdvancedSearch->SearchValue = HtmlDecode($this->ADDRESS_OF_RUJUKAN->AdvancedSearch->SearchValue);
            }
            $this->ADDRESS_OF_RUJUKAN->EditValue = HtmlEncode($this->ADDRESS_OF_RUJUKAN->AdvancedSearch->SearchValue);
            $this->ADDRESS_OF_RUJUKAN->PlaceHolder = RemoveHtml($this->ADDRESS_OF_RUJUKAN->caption());

            // REASON_ID
            $this->REASON_ID->EditAttrs["class"] = "form-control";
            $this->REASON_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->REASON_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->REASON_ID->AdvancedSearch->ViewValue = $this->REASON_ID->lookupCacheOption($curVal);
            } else {
                $this->REASON_ID->AdvancedSearch->ViewValue = $this->REASON_ID->Lookup !== null && is_array($this->REASON_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->REASON_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->REASON_ID->EditValue = array_values($this->REASON_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[REASON_ID]" . SearchString("=", $this->REASON_ID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->REASON_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->REASON_ID->EditValue = $arwrk;
            }
            $this->REASON_ID->PlaceHolder = RemoveHtml($this->REASON_ID->caption());

            // WAY_ID
            $this->WAY_ID->EditAttrs["class"] = "form-control";
            $this->WAY_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->WAY_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->WAY_ID->AdvancedSearch->ViewValue = $this->WAY_ID->lookupCacheOption($curVal);
            } else {
                $this->WAY_ID->AdvancedSearch->ViewValue = $this->WAY_ID->Lookup !== null && is_array($this->WAY_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->WAY_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->WAY_ID->EditValue = array_values($this->WAY_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[WAY_ID]" . SearchString("=", $this->WAY_ID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->WAY_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->WAY_ID->EditValue = $arwrk;
            }
            $this->WAY_ID->PlaceHolder = RemoveHtml($this->WAY_ID->caption());

            // PATIENT_CATEGORY_ID
            $this->PATIENT_CATEGORY_ID->EditAttrs["class"] = "form-control";
            $this->PATIENT_CATEGORY_ID->EditCustomAttributes = "";
            $this->PATIENT_CATEGORY_ID->EditValue = HtmlEncode($this->PATIENT_CATEGORY_ID->AdvancedSearch->SearchValue);
            $curVal = trim(strval($this->PATIENT_CATEGORY_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->PATIENT_CATEGORY_ID->EditValue = $this->PATIENT_CATEGORY_ID->lookupCacheOption($curVal);
                if ($this->PATIENT_CATEGORY_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[PATIENT_CATEGORY_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->PATIENT_CATEGORY_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PATIENT_CATEGORY_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->PATIENT_CATEGORY_ID->EditValue = $this->PATIENT_CATEGORY_ID->displayValue($arwrk);
                    } else {
                        $this->PATIENT_CATEGORY_ID->EditValue = HtmlEncode($this->PATIENT_CATEGORY_ID->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->PATIENT_CATEGORY_ID->EditValue = null;
            }
            $this->PATIENT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->PATIENT_CATEGORY_ID->caption());

            // BOOKED_DATE
            $this->BOOKED_DATE->EditAttrs["class"] = "form-control";
            $this->BOOKED_DATE->EditCustomAttributes = "";
            $this->BOOKED_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->BOOKED_DATE->AdvancedSearch->SearchValue, 11), 11));
            $this->BOOKED_DATE->PlaceHolder = RemoveHtml($this->BOOKED_DATE->caption());

            // VISIT_DATE
            $this->VISIT_DATE->EditAttrs["class"] = "form-control";
            $this->VISIT_DATE->EditCustomAttributes = "";
            $this->VISIT_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->VISIT_DATE->AdvancedSearch->SearchValue, 11), 11));
            $this->VISIT_DATE->PlaceHolder = RemoveHtml($this->VISIT_DATE->caption());

            // ISNEW
            $this->ISNEW->EditCustomAttributes = "";
            $this->ISNEW->EditValue = $this->ISNEW->options(false);
            $this->ISNEW->PlaceHolder = RemoveHtml($this->ISNEW->caption());

            // FOLLOW_UP
            $this->FOLLOW_UP->EditAttrs["class"] = "form-control";
            $this->FOLLOW_UP->EditCustomAttributes = "";
            $this->FOLLOW_UP->EditValue = HtmlEncode($this->FOLLOW_UP->AdvancedSearch->SearchValue);
            $this->FOLLOW_UP->PlaceHolder = RemoveHtml($this->FOLLOW_UP->caption());

            // PLACE_TYPE
            $this->PLACE_TYPE->EditAttrs["class"] = "form-control";
            $this->PLACE_TYPE->EditCustomAttributes = "";
            $this->PLACE_TYPE->EditValue = HtmlEncode($this->PLACE_TYPE->AdvancedSearch->SearchValue);
            $this->PLACE_TYPE->PlaceHolder = RemoveHtml($this->PLACE_TYPE->caption());

            // TICKET_NO
            $this->TICKET_NO->EditAttrs["class"] = "form-control";
            $this->TICKET_NO->EditCustomAttributes = "";
            $this->TICKET_NO->EditValue = HtmlEncode($this->TICKET_NO->AdvancedSearch->SearchValue);
            $this->TICKET_NO->PlaceHolder = RemoveHtml($this->TICKET_NO->caption());

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

            // CLINIC_ID_FROM
            $this->CLINIC_ID_FROM->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID_FROM->EditCustomAttributes = "";
            if (!$this->CLINIC_ID_FROM->Raw) {
                $this->CLINIC_ID_FROM->AdvancedSearch->SearchValue = HtmlDecode($this->CLINIC_ID_FROM->AdvancedSearch->SearchValue);
            }
            $this->CLINIC_ID_FROM->EditValue = HtmlEncode($this->CLINIC_ID_FROM->AdvancedSearch->SearchValue);
            $curVal = trim(strval($this->CLINIC_ID_FROM->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->CLINIC_ID_FROM->EditValue = $this->CLINIC_ID_FROM->lookupCacheOption($curVal);
                if ($this->CLINIC_ID_FROM->EditValue === null) { // Lookup from database
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->CLINIC_ID_FROM->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLINIC_ID_FROM->Lookup->renderViewRow($rswrk[0]);
                        $this->CLINIC_ID_FROM->EditValue = $this->CLINIC_ID_FROM->displayValue($arwrk);
                    } else {
                        $this->CLINIC_ID_FROM->EditValue = HtmlEncode($this->CLINIC_ID_FROM->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->CLINIC_ID_FROM->EditValue = null;
            }
            $this->CLINIC_ID_FROM->PlaceHolder = RemoveHtml($this->CLINIC_ID_FROM->caption());

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ROOM_ID->EditCustomAttributes = "";
            if (!$this->CLASS_ROOM_ID->Raw) {
                $this->CLASS_ROOM_ID->AdvancedSearch->SearchValue = HtmlDecode($this->CLASS_ROOM_ID->AdvancedSearch->SearchValue);
            }
            $this->CLASS_ROOM_ID->EditValue = HtmlEncode($this->CLASS_ROOM_ID->AdvancedSearch->SearchValue);
            $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

            // BED_ID
            $this->BED_ID->EditAttrs["class"] = "form-control";
            $this->BED_ID->EditCustomAttributes = "";
            $this->BED_ID->EditValue = HtmlEncode($this->BED_ID->AdvancedSearch->SearchValue);
            $this->BED_ID->PlaceHolder = RemoveHtml($this->BED_ID->caption());

            // KELUAR_ID
            $this->KELUAR_ID->EditAttrs["class"] = "form-control";
            $this->KELUAR_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->KELUAR_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->KELUAR_ID->AdvancedSearch->ViewValue = $this->KELUAR_ID->lookupCacheOption($curVal);
            } else {
                $this->KELUAR_ID->AdvancedSearch->ViewValue = $this->KELUAR_ID->Lookup !== null && is_array($this->KELUAR_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->KELUAR_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->KELUAR_ID->EditValue = array_values($this->KELUAR_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[KELUAR_ID]" . SearchString("=", $this->KELUAR_ID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->KELUAR_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KELUAR_ID->EditValue = $arwrk;
            }
            $this->KELUAR_ID->PlaceHolder = RemoveHtml($this->KELUAR_ID->caption());

            // IN_DATE
            $this->IN_DATE->EditAttrs["class"] = "form-control";
            $this->IN_DATE->EditCustomAttributes = "";
            $this->IN_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->IN_DATE->AdvancedSearch->SearchValue, 11), 11));
            $this->IN_DATE->PlaceHolder = RemoveHtml($this->IN_DATE->caption());

            // EXIT_DATE
            $this->EXIT_DATE->EditAttrs["class"] = "form-control";
            $this->EXIT_DATE->EditCustomAttributes = "";
            $this->EXIT_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->EXIT_DATE->AdvancedSearch->SearchValue, 11), 11));
            $this->EXIT_DATE->PlaceHolder = RemoveHtml($this->EXIT_DATE->caption());

            // GENDER
            $this->GENDER->EditCustomAttributes = "";
            $curVal = trim(strval($this->GENDER->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->GENDER->AdvancedSearch->ViewValue = $this->GENDER->lookupCacheOption($curVal);
            } else {
                $this->GENDER->AdvancedSearch->ViewValue = $this->GENDER->Lookup !== null && is_array($this->GENDER->Lookup->Options) ? $curVal : null;
            }
            if ($this->GENDER->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->GENDER->EditValue = array_values($this->GENDER->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[GENDER]" . SearchString("=", $this->GENDER->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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

            // DESCRIPTION
            $this->DESCRIPTION->EditAttrs["class"] = "form-control";
            $this->DESCRIPTION->EditCustomAttributes = "";
            $this->DESCRIPTION->EditValue = HtmlEncode($this->DESCRIPTION->AdvancedSearch->SearchValue);
            $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

            // VISITOR_ADDRESS
            $this->VISITOR_ADDRESS->EditAttrs["class"] = "form-control";
            $this->VISITOR_ADDRESS->EditCustomAttributes = "";
            if (!$this->VISITOR_ADDRESS->Raw) {
                $this->VISITOR_ADDRESS->AdvancedSearch->SearchValue = HtmlDecode($this->VISITOR_ADDRESS->AdvancedSearch->SearchValue);
            }
            $this->VISITOR_ADDRESS->EditValue = HtmlEncode($this->VISITOR_ADDRESS->AdvancedSearch->SearchValue);
            $this->VISITOR_ADDRESS->PlaceHolder = RemoveHtml($this->VISITOR_ADDRESS->caption());

            // MODIFIED_BY
            $this->MODIFIED_BY->EditAttrs["class"] = "form-control";
            $this->MODIFIED_BY->EditCustomAttributes = "";
            if (!$this->MODIFIED_BY->Raw) {
                $this->MODIFIED_BY->AdvancedSearch->SearchValue = HtmlDecode($this->MODIFIED_BY->AdvancedSearch->SearchValue);
            }
            $this->MODIFIED_BY->EditValue = HtmlEncode($this->MODIFIED_BY->AdvancedSearch->SearchValue);
            $this->MODIFIED_BY->PlaceHolder = RemoveHtml($this->MODIFIED_BY->caption());

            // MODIFIED_DATE
            $this->MODIFIED_DATE->EditAttrs["class"] = "form-control";
            $this->MODIFIED_DATE->EditCustomAttributes = "";
            $this->MODIFIED_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->MODIFIED_DATE->AdvancedSearch->SearchValue, 11), 11));
            $this->MODIFIED_DATE->PlaceHolder = RemoveHtml($this->MODIFIED_DATE->caption());

            // MODIFIED_FROM
            $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
            $this->MODIFIED_FROM->EditCustomAttributes = "";
            if (!$this->MODIFIED_FROM->Raw) {
                $this->MODIFIED_FROM->AdvancedSearch->SearchValue = HtmlDecode($this->MODIFIED_FROM->AdvancedSearch->SearchValue);
            }
            $this->MODIFIED_FROM->EditValue = HtmlEncode($this->MODIFIED_FROM->AdvancedSearch->SearchValue);
            $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
            $this->EMPLOYEE_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->EMPLOYEE_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->EMPLOYEE_ID->AdvancedSearch->ViewValue = $this->EMPLOYEE_ID->lookupCacheOption($curVal);
            } else {
                $this->EMPLOYEE_ID->AdvancedSearch->ViewValue = $this->EMPLOYEE_ID->Lookup !== null && is_array($this->EMPLOYEE_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->EMPLOYEE_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->EMPLOYEE_ID->EditValue = array_values($this->EMPLOYEE_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[EMPLOYEE_ID]" . SearchString("=", $this->EMPLOYEE_ID->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
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

            // EMPLOYEE_ID_FROM
            $this->EMPLOYEE_ID_FROM->EditAttrs["class"] = "form-control";
            $this->EMPLOYEE_ID_FROM->EditCustomAttributes = "";
            if (!$this->EMPLOYEE_ID_FROM->Raw) {
                $this->EMPLOYEE_ID_FROM->AdvancedSearch->SearchValue = HtmlDecode($this->EMPLOYEE_ID_FROM->AdvancedSearch->SearchValue);
            }
            $this->EMPLOYEE_ID_FROM->EditValue = HtmlEncode($this->EMPLOYEE_ID_FROM->AdvancedSearch->SearchValue);
            $this->EMPLOYEE_ID_FROM->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID_FROM->caption());

            // RESPONSIBLE_ID
            $this->RESPONSIBLE_ID->EditAttrs["class"] = "form-control";
            $this->RESPONSIBLE_ID->EditCustomAttributes = "";
            $this->RESPONSIBLE_ID->EditValue = HtmlEncode($this->RESPONSIBLE_ID->AdvancedSearch->SearchValue);
            $curVal = trim(strval($this->RESPONSIBLE_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->RESPONSIBLE_ID->EditValue = $this->RESPONSIBLE_ID->lookupCacheOption($curVal);
                if ($this->RESPONSIBLE_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[RESPONSIBLE_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->RESPONSIBLE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->RESPONSIBLE_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->RESPONSIBLE_ID->EditValue = $this->RESPONSIBLE_ID->displayValue($arwrk);
                    } else {
                        $this->RESPONSIBLE_ID->EditValue = HtmlEncode($this->RESPONSIBLE_ID->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->RESPONSIBLE_ID->EditValue = null;
            }
            $this->RESPONSIBLE_ID->PlaceHolder = RemoveHtml($this->RESPONSIBLE_ID->caption());

            // RESPONSIBLE
            $this->RESPONSIBLE->EditAttrs["class"] = "form-control";
            $this->RESPONSIBLE->EditCustomAttributes = "";
            if (!$this->RESPONSIBLE->Raw) {
                $this->RESPONSIBLE->AdvancedSearch->SearchValue = HtmlDecode($this->RESPONSIBLE->AdvancedSearch->SearchValue);
            }
            $this->RESPONSIBLE->EditValue = HtmlEncode($this->RESPONSIBLE->AdvancedSearch->SearchValue);
            $this->RESPONSIBLE->PlaceHolder = RemoveHtml($this->RESPONSIBLE->caption());

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->EditAttrs["class"] = "form-control";
            $this->FAMILY_STATUS_ID->EditCustomAttributes = "";
            $this->FAMILY_STATUS_ID->PlaceHolder = RemoveHtml($this->FAMILY_STATUS_ID->caption());

            // ISATTENDED
            $this->ISATTENDED->EditCustomAttributes = "";
            $this->ISATTENDED->EditValue = $this->ISATTENDED->options(false);
            $this->ISATTENDED->PlaceHolder = RemoveHtml($this->ISATTENDED->caption());

            // PAYOR_ID
            $this->PAYOR_ID->EditAttrs["class"] = "form-control";
            $this->PAYOR_ID->EditCustomAttributes = "";
            if (!$this->PAYOR_ID->Raw) {
                $this->PAYOR_ID->AdvancedSearch->SearchValue = HtmlDecode($this->PAYOR_ID->AdvancedSearch->SearchValue);
            }
            $this->PAYOR_ID->EditValue = HtmlEncode($this->PAYOR_ID->AdvancedSearch->SearchValue);
            $curVal = trim(strval($this->PAYOR_ID->AdvancedSearch->SearchValue));
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
                        $this->PAYOR_ID->EditValue = HtmlEncode($this->PAYOR_ID->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->PAYOR_ID->EditValue = null;
            }
            $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

            // CLASS_ID
            $this->CLASS_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLASS_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->CLASS_ID->AdvancedSearch->ViewValue = $this->CLASS_ID->lookupCacheOption($curVal);
            } else {
                $this->CLASS_ID->AdvancedSearch->ViewValue = $this->CLASS_ID->Lookup !== null && is_array($this->CLASS_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLASS_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->CLASS_ID->EditValue = array_values($this->CLASS_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLASS_ID]" . SearchString("=", $this->CLASS_ID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->CLASS_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLASS_ID->EditValue = $arwrk;
            }
            $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

            // ISPERTARIF
            $this->ISPERTARIF->EditAttrs["class"] = "form-control";
            $this->ISPERTARIF->EditCustomAttributes = "";
            if (!$this->ISPERTARIF->Raw) {
                $this->ISPERTARIF->AdvancedSearch->SearchValue = HtmlDecode($this->ISPERTARIF->AdvancedSearch->SearchValue);
            }
            $this->ISPERTARIF->EditValue = HtmlEncode($this->ISPERTARIF->AdvancedSearch->SearchValue);
            $this->ISPERTARIF->PlaceHolder = RemoveHtml($this->ISPERTARIF->caption());

            // KAL_ID
            $this->KAL_ID->EditAttrs["class"] = "form-control";
            $this->KAL_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->KAL_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->KAL_ID->AdvancedSearch->ViewValue = $this->KAL_ID->lookupCacheOption($curVal);
            } else {
                $this->KAL_ID->AdvancedSearch->ViewValue = $this->KAL_ID->Lookup !== null && is_array($this->KAL_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->KAL_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->KAL_ID->EditValue = array_values($this->KAL_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[KAL_ID]" . SearchString("=", $this->KAL_ID->AdvancedSearch->SearchValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->KAL_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KAL_ID->EditValue = $arwrk;
            }
            $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

            // EMPLOYEE_INAP
            $this->EMPLOYEE_INAP->EditAttrs["class"] = "form-control";
            $this->EMPLOYEE_INAP->EditCustomAttributes = "";
            if (!$this->EMPLOYEE_INAP->Raw) {
                $this->EMPLOYEE_INAP->AdvancedSearch->SearchValue = HtmlDecode($this->EMPLOYEE_INAP->AdvancedSearch->SearchValue);
            }
            $this->EMPLOYEE_INAP->EditValue = HtmlEncode($this->EMPLOYEE_INAP->AdvancedSearch->SearchValue);
            $this->EMPLOYEE_INAP->PlaceHolder = RemoveHtml($this->EMPLOYEE_INAP->caption());

            // PASIEN_ID
            $this->PASIEN_ID->EditAttrs["class"] = "form-control";
            $this->PASIEN_ID->EditCustomAttributes = "";
            if (!$this->PASIEN_ID->Raw) {
                $this->PASIEN_ID->AdvancedSearch->SearchValue = HtmlDecode($this->PASIEN_ID->AdvancedSearch->SearchValue);
            }
            $this->PASIEN_ID->EditValue = HtmlEncode($this->PASIEN_ID->AdvancedSearch->SearchValue);
            $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

            // KARYAWAN
            $this->KARYAWAN->EditAttrs["class"] = "form-control";
            $this->KARYAWAN->EditCustomAttributes = "";
            if (!$this->KARYAWAN->Raw) {
                $this->KARYAWAN->AdvancedSearch->SearchValue = HtmlDecode($this->KARYAWAN->AdvancedSearch->SearchValue);
            }
            $this->KARYAWAN->EditValue = HtmlEncode($this->KARYAWAN->AdvancedSearch->SearchValue);
            $this->KARYAWAN->PlaceHolder = RemoveHtml($this->KARYAWAN->caption());

            // ACCOUNT_ID
            $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
            $this->ACCOUNT_ID->EditCustomAttributes = "";
            if (!$this->ACCOUNT_ID->Raw) {
                $this->ACCOUNT_ID->AdvancedSearch->SearchValue = HtmlDecode($this->ACCOUNT_ID->AdvancedSearch->SearchValue);
            }
            $this->ACCOUNT_ID->EditValue = HtmlEncode($this->ACCOUNT_ID->AdvancedSearch->SearchValue);
            $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

            // CLASS_ID_PLAFOND
            $this->CLASS_ID_PLAFOND->EditAttrs["class"] = "form-control";
            $this->CLASS_ID_PLAFOND->EditCustomAttributes = "";
            $this->CLASS_ID_PLAFOND->EditValue = HtmlEncode($this->CLASS_ID_PLAFOND->AdvancedSearch->SearchValue);
            $this->CLASS_ID_PLAFOND->PlaceHolder = RemoveHtml($this->CLASS_ID_PLAFOND->caption());

            // BACKCHARGE
            $this->BACKCHARGE->EditAttrs["class"] = "form-control";
            $this->BACKCHARGE->EditCustomAttributes = "";
            if (!$this->BACKCHARGE->Raw) {
                $this->BACKCHARGE->AdvancedSearch->SearchValue = HtmlDecode($this->BACKCHARGE->AdvancedSearch->SearchValue);
            }
            $this->BACKCHARGE->EditValue = HtmlEncode($this->BACKCHARGE->AdvancedSearch->SearchValue);
            $this->BACKCHARGE->PlaceHolder = RemoveHtml($this->BACKCHARGE->caption());

            // COVERAGE_ID
            $this->COVERAGE_ID->EditAttrs["class"] = "form-control";
            $this->COVERAGE_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->COVERAGE_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->COVERAGE_ID->AdvancedSearch->ViewValue = $this->COVERAGE_ID->lookupCacheOption($curVal);
            } else {
                $this->COVERAGE_ID->AdvancedSearch->ViewValue = $this->COVERAGE_ID->Lookup !== null && is_array($this->COVERAGE_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->COVERAGE_ID->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->COVERAGE_ID->EditValue = array_values($this->COVERAGE_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[COVERAGE_ID]" . SearchString("=", $this->COVERAGE_ID->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->COVERAGE_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->COVERAGE_ID->EditValue = $arwrk;
            }
            $this->COVERAGE_ID->PlaceHolder = RemoveHtml($this->COVERAGE_ID->caption());

            // AGEYEAR
            $this->AGEYEAR->EditAttrs["class"] = "form-control";
            $this->AGEYEAR->EditCustomAttributes = "";
            $this->AGEYEAR->EditValue = HtmlEncode($this->AGEYEAR->AdvancedSearch->SearchValue);
            $this->AGEYEAR->PlaceHolder = RemoveHtml($this->AGEYEAR->caption());

            // AGEMONTH
            $this->AGEMONTH->EditAttrs["class"] = "form-control";
            $this->AGEMONTH->EditCustomAttributes = "";
            $this->AGEMONTH->EditValue = HtmlEncode($this->AGEMONTH->AdvancedSearch->SearchValue);
            $this->AGEMONTH->PlaceHolder = RemoveHtml($this->AGEMONTH->caption());

            // AGEDAY
            $this->AGEDAY->EditAttrs["class"] = "form-control";
            $this->AGEDAY->EditCustomAttributes = "";
            $this->AGEDAY->EditValue = HtmlEncode($this->AGEDAY->AdvancedSearch->SearchValue);
            $this->AGEDAY->PlaceHolder = RemoveHtml($this->AGEDAY->caption());

            // RECOMENDATION
            $this->RECOMENDATION->EditAttrs["class"] = "form-control";
            $this->RECOMENDATION->EditCustomAttributes = "";
            if (!$this->RECOMENDATION->Raw) {
                $this->RECOMENDATION->AdvancedSearch->SearchValue = HtmlDecode($this->RECOMENDATION->AdvancedSearch->SearchValue);
            }
            $this->RECOMENDATION->EditValue = HtmlEncode($this->RECOMENDATION->AdvancedSearch->SearchValue);
            $this->RECOMENDATION->PlaceHolder = RemoveHtml($this->RECOMENDATION->caption());

            // CONCLUSION
            $this->CONCLUSION->EditAttrs["class"] = "form-control";
            $this->CONCLUSION->EditCustomAttributes = "";
            if (!$this->CONCLUSION->Raw) {
                $this->CONCLUSION->AdvancedSearch->SearchValue = HtmlDecode($this->CONCLUSION->AdvancedSearch->SearchValue);
            }
            $this->CONCLUSION->EditValue = HtmlEncode($this->CONCLUSION->AdvancedSearch->SearchValue);
            $this->CONCLUSION->PlaceHolder = RemoveHtml($this->CONCLUSION->caption());

            // SPECIMENNO
            $this->SPECIMENNO->EditAttrs["class"] = "form-control";
            $this->SPECIMENNO->EditCustomAttributes = "";
            if (!$this->SPECIMENNO->Raw) {
                $this->SPECIMENNO->AdvancedSearch->SearchValue = HtmlDecode($this->SPECIMENNO->AdvancedSearch->SearchValue);
            }
            $this->SPECIMENNO->EditValue = HtmlEncode($this->SPECIMENNO->AdvancedSearch->SearchValue);
            $this->SPECIMENNO->PlaceHolder = RemoveHtml($this->SPECIMENNO->caption());

            // LOCKED
            $this->LOCKED->EditAttrs["class"] = "form-control";
            $this->LOCKED->EditCustomAttributes = "";
            if (!$this->LOCKED->Raw) {
                $this->LOCKED->AdvancedSearch->SearchValue = HtmlDecode($this->LOCKED->AdvancedSearch->SearchValue);
            }
            $this->LOCKED->EditValue = HtmlEncode($this->LOCKED->AdvancedSearch->SearchValue);
            $this->LOCKED->PlaceHolder = RemoveHtml($this->LOCKED->caption());

            // RM_OUT_DATE
            $this->RM_OUT_DATE->EditAttrs["class"] = "form-control";
            $this->RM_OUT_DATE->EditCustomAttributes = "";
            $this->RM_OUT_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->RM_OUT_DATE->AdvancedSearch->SearchValue, 0), 8));
            $this->RM_OUT_DATE->PlaceHolder = RemoveHtml($this->RM_OUT_DATE->caption());

            // RM_IN_DATE
            $this->RM_IN_DATE->EditAttrs["class"] = "form-control";
            $this->RM_IN_DATE->EditCustomAttributes = "";
            $this->RM_IN_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->RM_IN_DATE->AdvancedSearch->SearchValue, 0), 8));
            $this->RM_IN_DATE->PlaceHolder = RemoveHtml($this->RM_IN_DATE->caption());

            // LAMA_PINJAM
            $this->LAMA_PINJAM->EditAttrs["class"] = "form-control";
            $this->LAMA_PINJAM->EditCustomAttributes = "";
            $this->LAMA_PINJAM->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->LAMA_PINJAM->AdvancedSearch->SearchValue, 0), 8));
            $this->LAMA_PINJAM->PlaceHolder = RemoveHtml($this->LAMA_PINJAM->caption());

            // STANDAR_RJ
            $this->STANDAR_RJ->EditAttrs["class"] = "form-control";
            $this->STANDAR_RJ->EditCustomAttributes = "";
            if (!$this->STANDAR_RJ->Raw) {
                $this->STANDAR_RJ->AdvancedSearch->SearchValue = HtmlDecode($this->STANDAR_RJ->AdvancedSearch->SearchValue);
            }
            $this->STANDAR_RJ->EditValue = HtmlEncode($this->STANDAR_RJ->AdvancedSearch->SearchValue);
            $this->STANDAR_RJ->PlaceHolder = RemoveHtml($this->STANDAR_RJ->caption());

            // LENGKAP_RJ
            $this->LENGKAP_RJ->EditAttrs["class"] = "form-control";
            $this->LENGKAP_RJ->EditCustomAttributes = "";
            if (!$this->LENGKAP_RJ->Raw) {
                $this->LENGKAP_RJ->AdvancedSearch->SearchValue = HtmlDecode($this->LENGKAP_RJ->AdvancedSearch->SearchValue);
            }
            $this->LENGKAP_RJ->EditValue = HtmlEncode($this->LENGKAP_RJ->AdvancedSearch->SearchValue);
            $this->LENGKAP_RJ->PlaceHolder = RemoveHtml($this->LENGKAP_RJ->caption());

            // LENGKAP_RI
            $this->LENGKAP_RI->EditAttrs["class"] = "form-control";
            $this->LENGKAP_RI->EditCustomAttributes = "";
            if (!$this->LENGKAP_RI->Raw) {
                $this->LENGKAP_RI->AdvancedSearch->SearchValue = HtmlDecode($this->LENGKAP_RI->AdvancedSearch->SearchValue);
            }
            $this->LENGKAP_RI->EditValue = HtmlEncode($this->LENGKAP_RI->AdvancedSearch->SearchValue);
            $this->LENGKAP_RI->PlaceHolder = RemoveHtml($this->LENGKAP_RI->caption());

            // RESEND_RM_DATE
            $this->RESEND_RM_DATE->EditAttrs["class"] = "form-control";
            $this->RESEND_RM_DATE->EditCustomAttributes = "";
            $this->RESEND_RM_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->RESEND_RM_DATE->AdvancedSearch->SearchValue, 0), 8));
            $this->RESEND_RM_DATE->PlaceHolder = RemoveHtml($this->RESEND_RM_DATE->caption());

            // LENGKAP_RM1
            $this->LENGKAP_RM1->EditAttrs["class"] = "form-control";
            $this->LENGKAP_RM1->EditCustomAttributes = "";
            if (!$this->LENGKAP_RM1->Raw) {
                $this->LENGKAP_RM1->AdvancedSearch->SearchValue = HtmlDecode($this->LENGKAP_RM1->AdvancedSearch->SearchValue);
            }
            $this->LENGKAP_RM1->EditValue = HtmlEncode($this->LENGKAP_RM1->AdvancedSearch->SearchValue);
            $this->LENGKAP_RM1->PlaceHolder = RemoveHtml($this->LENGKAP_RM1->caption());

            // LENGKAP_RESUME
            $this->LENGKAP_RESUME->EditAttrs["class"] = "form-control";
            $this->LENGKAP_RESUME->EditCustomAttributes = "";
            if (!$this->LENGKAP_RESUME->Raw) {
                $this->LENGKAP_RESUME->AdvancedSearch->SearchValue = HtmlDecode($this->LENGKAP_RESUME->AdvancedSearch->SearchValue);
            }
            $this->LENGKAP_RESUME->EditValue = HtmlEncode($this->LENGKAP_RESUME->AdvancedSearch->SearchValue);
            $this->LENGKAP_RESUME->PlaceHolder = RemoveHtml($this->LENGKAP_RESUME->caption());

            // LENGKAP_ANAMNESIS
            $this->LENGKAP_ANAMNESIS->EditAttrs["class"] = "form-control";
            $this->LENGKAP_ANAMNESIS->EditCustomAttributes = "";
            if (!$this->LENGKAP_ANAMNESIS->Raw) {
                $this->LENGKAP_ANAMNESIS->AdvancedSearch->SearchValue = HtmlDecode($this->LENGKAP_ANAMNESIS->AdvancedSearch->SearchValue);
            }
            $this->LENGKAP_ANAMNESIS->EditValue = HtmlEncode($this->LENGKAP_ANAMNESIS->AdvancedSearch->SearchValue);
            $this->LENGKAP_ANAMNESIS->PlaceHolder = RemoveHtml($this->LENGKAP_ANAMNESIS->caption());

            // LENGKAP_CONSENT
            $this->LENGKAP_CONSENT->EditAttrs["class"] = "form-control";
            $this->LENGKAP_CONSENT->EditCustomAttributes = "";
            if (!$this->LENGKAP_CONSENT->Raw) {
                $this->LENGKAP_CONSENT->AdvancedSearch->SearchValue = HtmlDecode($this->LENGKAP_CONSENT->AdvancedSearch->SearchValue);
            }
            $this->LENGKAP_CONSENT->EditValue = HtmlEncode($this->LENGKAP_CONSENT->AdvancedSearch->SearchValue);
            $this->LENGKAP_CONSENT->PlaceHolder = RemoveHtml($this->LENGKAP_CONSENT->caption());

            // LENGKAP_ANESTESI
            $this->LENGKAP_ANESTESI->EditAttrs["class"] = "form-control";
            $this->LENGKAP_ANESTESI->EditCustomAttributes = "";
            if (!$this->LENGKAP_ANESTESI->Raw) {
                $this->LENGKAP_ANESTESI->AdvancedSearch->SearchValue = HtmlDecode($this->LENGKAP_ANESTESI->AdvancedSearch->SearchValue);
            }
            $this->LENGKAP_ANESTESI->EditValue = HtmlEncode($this->LENGKAP_ANESTESI->AdvancedSearch->SearchValue);
            $this->LENGKAP_ANESTESI->PlaceHolder = RemoveHtml($this->LENGKAP_ANESTESI->caption());

            // LENGKAP_OP
            $this->LENGKAP_OP->EditAttrs["class"] = "form-control";
            $this->LENGKAP_OP->EditCustomAttributes = "";
            if (!$this->LENGKAP_OP->Raw) {
                $this->LENGKAP_OP->AdvancedSearch->SearchValue = HtmlDecode($this->LENGKAP_OP->AdvancedSearch->SearchValue);
            }
            $this->LENGKAP_OP->EditValue = HtmlEncode($this->LENGKAP_OP->AdvancedSearch->SearchValue);
            $this->LENGKAP_OP->PlaceHolder = RemoveHtml($this->LENGKAP_OP->caption());

            // BACK_RM_DATE
            $this->BACK_RM_DATE->EditAttrs["class"] = "form-control";
            $this->BACK_RM_DATE->EditCustomAttributes = "";
            $this->BACK_RM_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->BACK_RM_DATE->AdvancedSearch->SearchValue, 0), 8));
            $this->BACK_RM_DATE->PlaceHolder = RemoveHtml($this->BACK_RM_DATE->caption());

            // VALID_RM_DATE
            $this->VALID_RM_DATE->EditAttrs["class"] = "form-control";
            $this->VALID_RM_DATE->EditCustomAttributes = "";
            $this->VALID_RM_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->VALID_RM_DATE->AdvancedSearch->SearchValue, 0), 8));
            $this->VALID_RM_DATE->PlaceHolder = RemoveHtml($this->VALID_RM_DATE->caption());

            // NO_SKP
            $this->NO_SKP->EditAttrs["class"] = "form-control";
            $this->NO_SKP->EditCustomAttributes = 'readonly';
            if (!$this->NO_SKP->Raw) {
                $this->NO_SKP->AdvancedSearch->SearchValue = HtmlDecode($this->NO_SKP->AdvancedSearch->SearchValue);
            }
            $this->NO_SKP->EditValue = HtmlEncode($this->NO_SKP->AdvancedSearch->SearchValue);
            $this->NO_SKP->PlaceHolder = RemoveHtml($this->NO_SKP->caption());

            // NO_SKPINAP
            $this->NO_SKPINAP->EditAttrs["class"] = "form-control";
            $this->NO_SKPINAP->EditCustomAttributes = 'readonly';
            if (!$this->NO_SKPINAP->Raw) {
                $this->NO_SKPINAP->AdvancedSearch->SearchValue = HtmlDecode($this->NO_SKPINAP->AdvancedSearch->SearchValue);
            }
            $this->NO_SKPINAP->EditValue = HtmlEncode($this->NO_SKPINAP->AdvancedSearch->SearchValue);
            $this->NO_SKPINAP->PlaceHolder = RemoveHtml($this->NO_SKPINAP->caption());

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
            $this->DIAGNOSA_ID->EditCustomAttributes = "";
            if (!$this->DIAGNOSA_ID->Raw) {
                $this->DIAGNOSA_ID->AdvancedSearch->SearchValue = HtmlDecode($this->DIAGNOSA_ID->AdvancedSearch->SearchValue);
            }
            $this->DIAGNOSA_ID->EditValue = HtmlEncode($this->DIAGNOSA_ID->AdvancedSearch->SearchValue);
            $curVal = trim(strval($this->DIAGNOSA_ID->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID->EditValue = $this->DIAGNOSA_ID->lookupCacheOption($curVal);
                if ($this->DIAGNOSA_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAGNOSA_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAGNOSA_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAGNOSA_ID->EditValue = $this->DIAGNOSA_ID->displayValue($arwrk);
                    } else {
                        $this->DIAGNOSA_ID->EditValue = HtmlEncode($this->DIAGNOSA_ID->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->DIAGNOSA_ID->EditValue = null;
            }
            $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

            // ticket_all
            $this->ticket_all->EditAttrs["class"] = "form-control";
            $this->ticket_all->EditCustomAttributes = "";
            $this->ticket_all->EditValue = HtmlEncode($this->ticket_all->AdvancedSearch->SearchValue);
            $this->ticket_all->PlaceHolder = RemoveHtml($this->ticket_all->caption());

            // tanggal_rujukan
            $this->tanggal_rujukan->EditAttrs["class"] = "form-control";
            $this->tanggal_rujukan->EditCustomAttributes = "";
            $this->tanggal_rujukan->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tanggal_rujukan->AdvancedSearch->SearchValue, 17), 17));
            $this->tanggal_rujukan->PlaceHolder = RemoveHtml($this->tanggal_rujukan->caption());

            // ISRJ
            $this->ISRJ->EditAttrs["class"] = "form-control";
            $this->ISRJ->EditCustomAttributes = "";
            if (!$this->ISRJ->Raw) {
                $this->ISRJ->AdvancedSearch->SearchValue = HtmlDecode($this->ISRJ->AdvancedSearch->SearchValue);
            }
            $this->ISRJ->EditValue = HtmlEncode($this->ISRJ->AdvancedSearch->SearchValue);
            $this->ISRJ->PlaceHolder = RemoveHtml($this->ISRJ->caption());

            // NORUJUKAN
            $this->NORUJUKAN->EditAttrs["class"] = "form-control";
            $this->NORUJUKAN->EditCustomAttributes = "";
            if (!$this->NORUJUKAN->Raw) {
                $this->NORUJUKAN->AdvancedSearch->SearchValue = HtmlDecode($this->NORUJUKAN->AdvancedSearch->SearchValue);
            }
            $this->NORUJUKAN->EditValue = HtmlEncode($this->NORUJUKAN->AdvancedSearch->SearchValue);
            $this->NORUJUKAN->PlaceHolder = RemoveHtml($this->NORUJUKAN->caption());

            // PPKRUJUKAN
            $this->PPKRUJUKAN->EditAttrs["class"] = "form-control";
            $this->PPKRUJUKAN->EditCustomAttributes = "";
            if (!$this->PPKRUJUKAN->Raw) {
                $this->PPKRUJUKAN->AdvancedSearch->SearchValue = HtmlDecode($this->PPKRUJUKAN->AdvancedSearch->SearchValue);
            }
            $this->PPKRUJUKAN->EditValue = HtmlEncode($this->PPKRUJUKAN->AdvancedSearch->SearchValue);
            $curVal = trim(strval($this->PPKRUJUKAN->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->PPKRUJUKAN->EditValue = $this->PPKRUJUKAN->lookupCacheOption($curVal);
                if ($this->PPKRUJUKAN->EditValue === null) { // Lookup from database
                    $filterWrk = "[KDPROVIDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->PPKRUJUKAN->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PPKRUJUKAN->Lookup->renderViewRow($rswrk[0]);
                        $this->PPKRUJUKAN->EditValue = $this->PPKRUJUKAN->displayValue($arwrk);
                    } else {
                        $this->PPKRUJUKAN->EditValue = HtmlEncode($this->PPKRUJUKAN->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->PPKRUJUKAN->EditValue = null;
            }
            $this->PPKRUJUKAN->PlaceHolder = RemoveHtml($this->PPKRUJUKAN->caption());

            // LOKASILAKA
            $this->LOKASILAKA->EditAttrs["class"] = "form-control";
            $this->LOKASILAKA->EditCustomAttributes = "";
            if (!$this->LOKASILAKA->Raw) {
                $this->LOKASILAKA->AdvancedSearch->SearchValue = HtmlDecode($this->LOKASILAKA->AdvancedSearch->SearchValue);
            }
            $this->LOKASILAKA->EditValue = HtmlEncode($this->LOKASILAKA->AdvancedSearch->SearchValue);
            $this->LOKASILAKA->PlaceHolder = RemoveHtml($this->LOKASILAKA->caption());

            // KDPOLI
            $this->KDPOLI->EditAttrs["class"] = "form-control";
            $this->KDPOLI->EditCustomAttributes = "";
            if (!$this->KDPOLI->Raw) {
                $this->KDPOLI->AdvancedSearch->SearchValue = HtmlDecode($this->KDPOLI->AdvancedSearch->SearchValue);
            }
            $this->KDPOLI->EditValue = HtmlEncode($this->KDPOLI->AdvancedSearch->SearchValue);
            $this->KDPOLI->PlaceHolder = RemoveHtml($this->KDPOLI->caption());

            // EDIT_SEP
            $this->EDIT_SEP->EditAttrs["class"] = "form-control";
            $this->EDIT_SEP->EditCustomAttributes = "";
            if (!$this->EDIT_SEP->Raw) {
                $this->EDIT_SEP->AdvancedSearch->SearchValue = HtmlDecode($this->EDIT_SEP->AdvancedSearch->SearchValue);
            }
            $this->EDIT_SEP->EditValue = HtmlEncode($this->EDIT_SEP->AdvancedSearch->SearchValue);
            $this->EDIT_SEP->PlaceHolder = RemoveHtml($this->EDIT_SEP->caption());

            // DELETE_SEP
            $this->DELETE_SEP->EditAttrs["class"] = "form-control";
            $this->DELETE_SEP->EditCustomAttributes = "";
            if (!$this->DELETE_SEP->Raw) {
                $this->DELETE_SEP->AdvancedSearch->SearchValue = HtmlDecode($this->DELETE_SEP->AdvancedSearch->SearchValue);
            }
            $this->DELETE_SEP->EditValue = HtmlEncode($this->DELETE_SEP->AdvancedSearch->SearchValue);
            $this->DELETE_SEP->PlaceHolder = RemoveHtml($this->DELETE_SEP->caption());

            // KODE_AGAMA
            $this->KODE_AGAMA->EditCustomAttributes = "";
            $curVal = trim(strval($this->KODE_AGAMA->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->KODE_AGAMA->AdvancedSearch->ViewValue = $this->KODE_AGAMA->lookupCacheOption($curVal);
            } else {
                $this->KODE_AGAMA->AdvancedSearch->ViewValue = $this->KODE_AGAMA->Lookup !== null && is_array($this->KODE_AGAMA->Lookup->Options) ? $curVal : null;
            }
            if ($this->KODE_AGAMA->AdvancedSearch->ViewValue !== null) { // Load from cache
                $this->KODE_AGAMA->EditValue = array_values($this->KODE_AGAMA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[KODE_AGAMA]" . SearchString("=", $this->KODE_AGAMA->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->KODE_AGAMA->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KODE_AGAMA->EditValue = $arwrk;
            }
            $this->KODE_AGAMA->PlaceHolder = RemoveHtml($this->KODE_AGAMA->caption());

            // DIAG_AWAL
            $this->DIAG_AWAL->EditAttrs["class"] = "form-control";
            $this->DIAG_AWAL->EditCustomAttributes = "";
            if (!$this->DIAG_AWAL->Raw) {
                $this->DIAG_AWAL->AdvancedSearch->SearchValue = HtmlDecode($this->DIAG_AWAL->AdvancedSearch->SearchValue);
            }
            $this->DIAG_AWAL->EditValue = HtmlEncode($this->DIAG_AWAL->AdvancedSearch->SearchValue);
            $curVal = trim(strval($this->DIAG_AWAL->AdvancedSearch->SearchValue));
            if ($curVal != "") {
                $this->DIAG_AWAL->EditValue = $this->DIAG_AWAL->lookupCacheOption($curVal);
                if ($this->DIAG_AWAL->EditValue === null) { // Lookup from database
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->DIAG_AWAL->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DIAG_AWAL->Lookup->renderViewRow($rswrk[0]);
                        $this->DIAG_AWAL->EditValue = $this->DIAG_AWAL->displayValue($arwrk);
                    } else {
                        $this->DIAG_AWAL->EditValue = HtmlEncode($this->DIAG_AWAL->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->DIAG_AWAL->EditValue = null;
            }
            $this->DIAG_AWAL->PlaceHolder = RemoveHtml($this->DIAG_AWAL->caption());

            // AKTIF
            $this->AKTIF->EditAttrs["class"] = "form-control";
            $this->AKTIF->EditCustomAttributes = "";
            if (!$this->AKTIF->Raw) {
                $this->AKTIF->AdvancedSearch->SearchValue = HtmlDecode($this->AKTIF->AdvancedSearch->SearchValue);
            }
            $this->AKTIF->EditValue = HtmlEncode($this->AKTIF->AdvancedSearch->SearchValue);
            $this->AKTIF->PlaceHolder = RemoveHtml($this->AKTIF->caption());

            // BILL_INAP
            $this->BILL_INAP->EditAttrs["class"] = "form-control";
            $this->BILL_INAP->EditCustomAttributes = "";
            if (!$this->BILL_INAP->Raw) {
                $this->BILL_INAP->AdvancedSearch->SearchValue = HtmlDecode($this->BILL_INAP->AdvancedSearch->SearchValue);
            }
            $this->BILL_INAP->EditValue = HtmlEncode($this->BILL_INAP->AdvancedSearch->SearchValue);
            $this->BILL_INAP->PlaceHolder = RemoveHtml($this->BILL_INAP->caption());

            // SEP_PRINTDATE
            $this->SEP_PRINTDATE->EditAttrs["class"] = "form-control";
            $this->SEP_PRINTDATE->EditCustomAttributes = "";
            $this->SEP_PRINTDATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->SEP_PRINTDATE->AdvancedSearch->SearchValue, 0), 8));
            $this->SEP_PRINTDATE->PlaceHolder = RemoveHtml($this->SEP_PRINTDATE->caption());

            // MAPPING_SEP
            $this->MAPPING_SEP->EditAttrs["class"] = "form-control";
            $this->MAPPING_SEP->EditCustomAttributes = "";
            if (!$this->MAPPING_SEP->Raw) {
                $this->MAPPING_SEP->AdvancedSearch->SearchValue = HtmlDecode($this->MAPPING_SEP->AdvancedSearch->SearchValue);
            }
            $this->MAPPING_SEP->EditValue = HtmlEncode($this->MAPPING_SEP->AdvancedSearch->SearchValue);
            $this->MAPPING_SEP->PlaceHolder = RemoveHtml($this->MAPPING_SEP->caption());

            // TRANS_ID
            $this->TRANS_ID->EditAttrs["class"] = "form-control";
            $this->TRANS_ID->EditCustomAttributes = "";
            if (!$this->TRANS_ID->Raw) {
                $this->TRANS_ID->AdvancedSearch->SearchValue = HtmlDecode($this->TRANS_ID->AdvancedSearch->SearchValue);
            }
            $this->TRANS_ID->EditValue = HtmlEncode($this->TRANS_ID->AdvancedSearch->SearchValue);
            $this->TRANS_ID->PlaceHolder = RemoveHtml($this->TRANS_ID->caption());

            // KDPOLI_EKS
            $this->KDPOLI_EKS->EditCustomAttributes = "";
            $this->KDPOLI_EKS->EditValue = $this->KDPOLI_EKS->options(false);
            $this->KDPOLI_EKS->PlaceHolder = RemoveHtml($this->KDPOLI_EKS->caption());

            // COB
            $this->COB->EditCustomAttributes = "";
            $this->COB->EditValue = $this->COB->options(false);
            $this->COB->PlaceHolder = RemoveHtml($this->COB->caption());

            // PENJAMIN
            $this->PENJAMIN->EditAttrs["class"] = "form-control";
            $this->PENJAMIN->EditCustomAttributes = "";
            if (!$this->PENJAMIN->Raw) {
                $this->PENJAMIN->AdvancedSearch->SearchValue = HtmlDecode($this->PENJAMIN->AdvancedSearch->SearchValue);
            }
            $this->PENJAMIN->EditValue = HtmlEncode($this->PENJAMIN->AdvancedSearch->SearchValue);
            $this->PENJAMIN->PlaceHolder = RemoveHtml($this->PENJAMIN->caption());

            // ASALRUJUKAN
            $this->ASALRUJUKAN->EditAttrs["class"] = "form-control";
            $this->ASALRUJUKAN->EditCustomAttributes = "";
            $this->ASALRUJUKAN->EditValue = $this->ASALRUJUKAN->options(true);
            $this->ASALRUJUKAN->PlaceHolder = RemoveHtml($this->ASALRUJUKAN->caption());

            // RESPONSEP
            $this->RESPONSEP->EditAttrs["class"] = "form-control";
            $this->RESPONSEP->EditCustomAttributes = "";
            $this->RESPONSEP->EditValue = HtmlEncode($this->RESPONSEP->AdvancedSearch->SearchValue);
            $this->RESPONSEP->PlaceHolder = RemoveHtml($this->RESPONSEP->caption());

            // APPROVAL_DESC
            $this->APPROVAL_DESC->EditAttrs["class"] = "form-control";
            $this->APPROVAL_DESC->EditCustomAttributes = "";
            if (!$this->APPROVAL_DESC->Raw) {
                $this->APPROVAL_DESC->AdvancedSearch->SearchValue = HtmlDecode($this->APPROVAL_DESC->AdvancedSearch->SearchValue);
            }
            $this->APPROVAL_DESC->EditValue = HtmlEncode($this->APPROVAL_DESC->AdvancedSearch->SearchValue);
            $this->APPROVAL_DESC->PlaceHolder = RemoveHtml($this->APPROVAL_DESC->caption());

            // APPROVAL_RESPONAJUKAN
            $this->APPROVAL_RESPONAJUKAN->EditAttrs["class"] = "form-control";
            $this->APPROVAL_RESPONAJUKAN->EditCustomAttributes = "";
            if (!$this->APPROVAL_RESPONAJUKAN->Raw) {
                $this->APPROVAL_RESPONAJUKAN->AdvancedSearch->SearchValue = HtmlDecode($this->APPROVAL_RESPONAJUKAN->AdvancedSearch->SearchValue);
            }
            $this->APPROVAL_RESPONAJUKAN->EditValue = HtmlEncode($this->APPROVAL_RESPONAJUKAN->AdvancedSearch->SearchValue);
            $this->APPROVAL_RESPONAJUKAN->PlaceHolder = RemoveHtml($this->APPROVAL_RESPONAJUKAN->caption());

            // APPROVAL_RESPONAPPROV
            $this->APPROVAL_RESPONAPPROV->EditAttrs["class"] = "form-control";
            $this->APPROVAL_RESPONAPPROV->EditCustomAttributes = "";
            if (!$this->APPROVAL_RESPONAPPROV->Raw) {
                $this->APPROVAL_RESPONAPPROV->AdvancedSearch->SearchValue = HtmlDecode($this->APPROVAL_RESPONAPPROV->AdvancedSearch->SearchValue);
            }
            $this->APPROVAL_RESPONAPPROV->EditValue = HtmlEncode($this->APPROVAL_RESPONAPPROV->AdvancedSearch->SearchValue);
            $this->APPROVAL_RESPONAPPROV->PlaceHolder = RemoveHtml($this->APPROVAL_RESPONAPPROV->caption());

            // RESPONTGLPLG_DESC
            $this->RESPONTGLPLG_DESC->EditAttrs["class"] = "form-control";
            $this->RESPONTGLPLG_DESC->EditCustomAttributes = "";
            $this->RESPONTGLPLG_DESC->EditValue = $this->RESPONTGLPLG_DESC->options(true);
            $this->RESPONTGLPLG_DESC->PlaceHolder = RemoveHtml($this->RESPONTGLPLG_DESC->caption());

            // RESPONPOST_VKLAIM
            $this->RESPONPOST_VKLAIM->EditAttrs["class"] = "form-control";
            $this->RESPONPOST_VKLAIM->EditCustomAttributes = "";
            $this->RESPONPOST_VKLAIM->EditValue = HtmlEncode($this->RESPONPOST_VKLAIM->AdvancedSearch->SearchValue);
            $this->RESPONPOST_VKLAIM->PlaceHolder = RemoveHtml($this->RESPONPOST_VKLAIM->caption());

            // RESPONPUT_VKLAIM
            $this->RESPONPUT_VKLAIM->EditAttrs["class"] = "form-control";
            $this->RESPONPUT_VKLAIM->EditCustomAttributes = "";
            $this->RESPONPUT_VKLAIM->EditValue = HtmlEncode($this->RESPONPUT_VKLAIM->AdvancedSearch->SearchValue);
            $this->RESPONPUT_VKLAIM->PlaceHolder = RemoveHtml($this->RESPONPUT_VKLAIM->caption());

            // RESPONDEL_VKLAIM
            $this->RESPONDEL_VKLAIM->EditAttrs["class"] = "form-control";
            $this->RESPONDEL_VKLAIM->EditCustomAttributes = "";
            $this->RESPONDEL_VKLAIM->EditValue = HtmlEncode($this->RESPONDEL_VKLAIM->AdvancedSearch->SearchValue);
            $this->RESPONDEL_VKLAIM->PlaceHolder = RemoveHtml($this->RESPONDEL_VKLAIM->caption());

            // CALL_TIMES
            $this->CALL_TIMES->EditAttrs["class"] = "form-control";
            $this->CALL_TIMES->EditCustomAttributes = "";
            $this->CALL_TIMES->EditValue = HtmlEncode($this->CALL_TIMES->AdvancedSearch->SearchValue);
            $this->CALL_TIMES->PlaceHolder = RemoveHtml($this->CALL_TIMES->caption());

            // CALL_DATE
            $this->CALL_DATE->EditAttrs["class"] = "form-control";
            $this->CALL_DATE->EditCustomAttributes = "";
            $this->CALL_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->CALL_DATE->AdvancedSearch->SearchValue, 0), 8));
            $this->CALL_DATE->PlaceHolder = RemoveHtml($this->CALL_DATE->caption());

            // CALL_DATES
            $this->CALL_DATES->EditAttrs["class"] = "form-control";
            $this->CALL_DATES->EditCustomAttributes = "";
            $this->CALL_DATES->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->CALL_DATES->AdvancedSearch->SearchValue, 0), 8));
            $this->CALL_DATES->PlaceHolder = RemoveHtml($this->CALL_DATES->caption());

            // SERVED_DATE
            $this->SERVED_DATE->EditAttrs["class"] = "form-control";
            $this->SERVED_DATE->EditCustomAttributes = "";
            $this->SERVED_DATE->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->SERVED_DATE->AdvancedSearch->SearchValue, 0), 8));
            $this->SERVED_DATE->PlaceHolder = RemoveHtml($this->SERVED_DATE->caption());

            // SERVED_INAP
            $this->SERVED_INAP->EditAttrs["class"] = "form-control";
            $this->SERVED_INAP->EditCustomAttributes = "";
            $this->SERVED_INAP->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->SERVED_INAP->AdvancedSearch->SearchValue, 0), 8));
            $this->SERVED_INAP->PlaceHolder = RemoveHtml($this->SERVED_INAP->caption());

            // KDDPJP1
            $this->KDDPJP1->EditAttrs["class"] = "form-control";
            $this->KDDPJP1->EditCustomAttributes = "";
            if (!$this->KDDPJP1->Raw) {
                $this->KDDPJP1->AdvancedSearch->SearchValue = HtmlDecode($this->KDDPJP1->AdvancedSearch->SearchValue);
            }
            $this->KDDPJP1->EditValue = HtmlEncode($this->KDDPJP1->AdvancedSearch->SearchValue);
            $this->KDDPJP1->PlaceHolder = RemoveHtml($this->KDDPJP1->caption());

            // KDDPJP
            $this->KDDPJP->EditAttrs["class"] = "form-control";
            $this->KDDPJP->EditCustomAttributes = 'readonly';
            if (!$this->KDDPJP->Raw) {
                $this->KDDPJP->AdvancedSearch->SearchValue = HtmlDecode($this->KDDPJP->AdvancedSearch->SearchValue);
            }
            $this->KDDPJP->EditValue = HtmlEncode($this->KDDPJP->AdvancedSearch->SearchValue);
            $this->KDDPJP->PlaceHolder = RemoveHtml($this->KDDPJP->caption());

            // IDXDAFTAR
            $this->IDXDAFTAR->EditAttrs["class"] = "form-control";
            $this->IDXDAFTAR->EditCustomAttributes = "";
            $this->IDXDAFTAR->EditValue = HtmlEncode($this->IDXDAFTAR->AdvancedSearch->SearchValue);
            $this->IDXDAFTAR->PlaceHolder = RemoveHtml($this->IDXDAFTAR->caption());

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
        if (!CheckEuroDate($this->BOOKED_DATE->AdvancedSearch->SearchValue)) {
            $this->BOOKED_DATE->addErrorMessage($this->BOOKED_DATE->getErrorMessage(false));
        }
        if (!CheckEuroDate($this->VISIT_DATE->AdvancedSearch->SearchValue)) {
            $this->VISIT_DATE->addErrorMessage($this->VISIT_DATE->getErrorMessage(false));
        }
        if (!CheckInteger($this->TICKET_NO->AdvancedSearch->SearchValue)) {
            $this->TICKET_NO->addErrorMessage($this->TICKET_NO->getErrorMessage(false));
        }
        if (!CheckInteger($this->BED_ID->AdvancedSearch->SearchValue)) {
            $this->BED_ID->addErrorMessage($this->BED_ID->getErrorMessage(false));
        }
        if (!CheckEuroDate($this->EXIT_DATE->AdvancedSearch->SearchValue)) {
            $this->EXIT_DATE->addErrorMessage($this->EXIT_DATE->getErrorMessage(false));
        }
        if (!CheckInteger($this->AGEYEAR->AdvancedSearch->SearchValue)) {
            $this->AGEYEAR->addErrorMessage($this->AGEYEAR->getErrorMessage(false));
        }
        if (!CheckInteger($this->AGEMONTH->AdvancedSearch->SearchValue)) {
            $this->AGEMONTH->addErrorMessage($this->AGEMONTH->getErrorMessage(false));
        }
        if (!CheckInteger($this->AGEDAY->AdvancedSearch->SearchValue)) {
            $this->AGEDAY->addErrorMessage($this->AGEDAY->getErrorMessage(false));
        }
        if (!CheckDate($this->RM_OUT_DATE->AdvancedSearch->SearchValue)) {
            $this->RM_OUT_DATE->addErrorMessage($this->RM_OUT_DATE->getErrorMessage(false));
        }
        if (!CheckDate($this->RM_IN_DATE->AdvancedSearch->SearchValue)) {
            $this->RM_IN_DATE->addErrorMessage($this->RM_IN_DATE->getErrorMessage(false));
        }
        if (!CheckDate($this->LAMA_PINJAM->AdvancedSearch->SearchValue)) {
            $this->LAMA_PINJAM->addErrorMessage($this->LAMA_PINJAM->getErrorMessage(false));
        }
        if (!CheckDate($this->RESEND_RM_DATE->AdvancedSearch->SearchValue)) {
            $this->RESEND_RM_DATE->addErrorMessage($this->RESEND_RM_DATE->getErrorMessage(false));
        }
        if (!CheckDate($this->BACK_RM_DATE->AdvancedSearch->SearchValue)) {
            $this->BACK_RM_DATE->addErrorMessage($this->BACK_RM_DATE->getErrorMessage(false));
        }
        if (!CheckDate($this->VALID_RM_DATE->AdvancedSearch->SearchValue)) {
            $this->VALID_RM_DATE->addErrorMessage($this->VALID_RM_DATE->getErrorMessage(false));
        }
        if (!CheckInteger($this->ticket_all->AdvancedSearch->SearchValue)) {
            $this->ticket_all->addErrorMessage($this->ticket_all->getErrorMessage(false));
        }
        if (!CheckShortEuroDate($this->tanggal_rujukan->AdvancedSearch->SearchValue)) {
            $this->tanggal_rujukan->addErrorMessage($this->tanggal_rujukan->getErrorMessage(false));
        }
        if (!CheckDate($this->SEP_PRINTDATE->AdvancedSearch->SearchValue)) {
            $this->SEP_PRINTDATE->addErrorMessage($this->SEP_PRINTDATE->getErrorMessage(false));
        }
        if (!CheckDate($this->CALL_DATE->AdvancedSearch->SearchValue)) {
            $this->CALL_DATE->addErrorMessage($this->CALL_DATE->getErrorMessage(false));
        }
        if (!CheckDate($this->CALL_DATES->AdvancedSearch->SearchValue)) {
            $this->CALL_DATES->addErrorMessage($this->CALL_DATES->getErrorMessage(false));
        }
        if (!CheckDate($this->SERVED_DATE->AdvancedSearch->SearchValue)) {
            $this->SERVED_DATE->addErrorMessage($this->SERVED_DATE->getErrorMessage(false));
        }
        if (!CheckDate($this->SERVED_INAP->AdvancedSearch->SearchValue)) {
            $this->SERVED_INAP->addErrorMessage($this->SERVED_INAP->getErrorMessage(false));
        }
        if (!CheckInteger($this->IDXDAFTAR->AdvancedSearch->SearchValue)) {
            $this->IDXDAFTAR->addErrorMessage($this->IDXDAFTAR->getErrorMessage(false));
        }
        if (!CheckDate($this->tgl_kontrol->AdvancedSearch->SearchValue)) {
            $this->tgl_kontrol->addErrorMessage($this->tgl_kontrol->getErrorMessage(false));
        }
        if (!CheckInteger($this->id_tujuan->AdvancedSearch->SearchValue)) {
            $this->id_tujuan->addErrorMessage($this->id_tujuan->getErrorMessage(false));
        }
        if (!CheckInteger($this->id_penunjang->AdvancedSearch->SearchValue)) {
            $this->id_penunjang->addErrorMessage($this->id_penunjang->getErrorMessage(false));
        }
        if (!CheckInteger($this->id_pembiayaan->AdvancedSearch->SearchValue)) {
            $this->id_pembiayaan->addErrorMessage($this->id_pembiayaan->getErrorMessage(false));
        }
        if (!CheckInteger($this->id_procedure->AdvancedSearch->SearchValue)) {
            $this->id_procedure->addErrorMessage($this->id_procedure->getErrorMessage(false));
        }
        if (!CheckInteger($this->id_aspel->AdvancedSearch->SearchValue)) {
            $this->id_aspel->addErrorMessage($this->id_aspel->getErrorMessage(false));
        }
        if (!CheckInteger($this->id_kelas->AdvancedSearch->SearchValue)) {
            $this->id_kelas->addErrorMessage($this->id_kelas->getErrorMessage(false));
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
        $this->NO_REGISTRATION->AdvancedSearch->load();
        $this->DIANTAR_OLEH->AdvancedSearch->load();
        $this->STATUS_PASIEN_ID->AdvancedSearch->load();
        $this->RUJUKAN_ID->AdvancedSearch->load();
        $this->ADDRESS_OF_RUJUKAN->AdvancedSearch->load();
        $this->REASON_ID->AdvancedSearch->load();
        $this->WAY_ID->AdvancedSearch->load();
        $this->PATIENT_CATEGORY_ID->AdvancedSearch->load();
        $this->BOOKED_DATE->AdvancedSearch->load();
        $this->VISIT_DATE->AdvancedSearch->load();
        $this->ISNEW->AdvancedSearch->load();
        $this->FOLLOW_UP->AdvancedSearch->load();
        $this->PLACE_TYPE->AdvancedSearch->load();
        $this->TICKET_NO->AdvancedSearch->load();
        $this->CLINIC_ID->AdvancedSearch->load();
        $this->CLINIC_ID_FROM->AdvancedSearch->load();
        $this->CLASS_ROOM_ID->AdvancedSearch->load();
        $this->BED_ID->AdvancedSearch->load();
        $this->KELUAR_ID->AdvancedSearch->load();
        $this->IN_DATE->AdvancedSearch->load();
        $this->EXIT_DATE->AdvancedSearch->load();
        $this->GENDER->AdvancedSearch->load();
        $this->DESCRIPTION->AdvancedSearch->load();
        $this->VISITOR_ADDRESS->AdvancedSearch->load();
        $this->MODIFIED_BY->AdvancedSearch->load();
        $this->MODIFIED_DATE->AdvancedSearch->load();
        $this->MODIFIED_FROM->AdvancedSearch->load();
        $this->EMPLOYEE_ID->AdvancedSearch->load();
        $this->EMPLOYEE_ID_FROM->AdvancedSearch->load();
        $this->RESPONSIBLE_ID->AdvancedSearch->load();
        $this->RESPONSIBLE->AdvancedSearch->load();
        $this->FAMILY_STATUS_ID->AdvancedSearch->load();
        $this->ISATTENDED->AdvancedSearch->load();
        $this->PAYOR_ID->AdvancedSearch->load();
        $this->CLASS_ID->AdvancedSearch->load();
        $this->ISPERTARIF->AdvancedSearch->load();
        $this->KAL_ID->AdvancedSearch->load();
        $this->EMPLOYEE_INAP->AdvancedSearch->load();
        $this->PASIEN_ID->AdvancedSearch->load();
        $this->KARYAWAN->AdvancedSearch->load();
        $this->ACCOUNT_ID->AdvancedSearch->load();
        $this->CLASS_ID_PLAFOND->AdvancedSearch->load();
        $this->BACKCHARGE->AdvancedSearch->load();
        $this->COVERAGE_ID->AdvancedSearch->load();
        $this->AGEYEAR->AdvancedSearch->load();
        $this->AGEMONTH->AdvancedSearch->load();
        $this->AGEDAY->AdvancedSearch->load();
        $this->RECOMENDATION->AdvancedSearch->load();
        $this->CONCLUSION->AdvancedSearch->load();
        $this->SPECIMENNO->AdvancedSearch->load();
        $this->LOCKED->AdvancedSearch->load();
        $this->RM_OUT_DATE->AdvancedSearch->load();
        $this->RM_IN_DATE->AdvancedSearch->load();
        $this->LAMA_PINJAM->AdvancedSearch->load();
        $this->STANDAR_RJ->AdvancedSearch->load();
        $this->LENGKAP_RJ->AdvancedSearch->load();
        $this->LENGKAP_RI->AdvancedSearch->load();
        $this->RESEND_RM_DATE->AdvancedSearch->load();
        $this->LENGKAP_RM1->AdvancedSearch->load();
        $this->LENGKAP_RESUME->AdvancedSearch->load();
        $this->LENGKAP_ANAMNESIS->AdvancedSearch->load();
        $this->LENGKAP_CONSENT->AdvancedSearch->load();
        $this->LENGKAP_ANESTESI->AdvancedSearch->load();
        $this->LENGKAP_OP->AdvancedSearch->load();
        $this->BACK_RM_DATE->AdvancedSearch->load();
        $this->VALID_RM_DATE->AdvancedSearch->load();
        $this->NO_SKP->AdvancedSearch->load();
        $this->NO_SKPINAP->AdvancedSearch->load();
        $this->DIAGNOSA_ID->AdvancedSearch->load();
        $this->ticket_all->AdvancedSearch->load();
        $this->tanggal_rujukan->AdvancedSearch->load();
        $this->ISRJ->AdvancedSearch->load();
        $this->NORUJUKAN->AdvancedSearch->load();
        $this->PPKRUJUKAN->AdvancedSearch->load();
        $this->LOKASILAKA->AdvancedSearch->load();
        $this->KDPOLI->AdvancedSearch->load();
        $this->EDIT_SEP->AdvancedSearch->load();
        $this->DELETE_SEP->AdvancedSearch->load();
        $this->KODE_AGAMA->AdvancedSearch->load();
        $this->DIAG_AWAL->AdvancedSearch->load();
        $this->AKTIF->AdvancedSearch->load();
        $this->BILL_INAP->AdvancedSearch->load();
        $this->SEP_PRINTDATE->AdvancedSearch->load();
        $this->MAPPING_SEP->AdvancedSearch->load();
        $this->TRANS_ID->AdvancedSearch->load();
        $this->KDPOLI_EKS->AdvancedSearch->load();
        $this->COB->AdvancedSearch->load();
        $this->PENJAMIN->AdvancedSearch->load();
        $this->ASALRUJUKAN->AdvancedSearch->load();
        $this->RESPONSEP->AdvancedSearch->load();
        $this->APPROVAL_DESC->AdvancedSearch->load();
        $this->APPROVAL_RESPONAJUKAN->AdvancedSearch->load();
        $this->APPROVAL_RESPONAPPROV->AdvancedSearch->load();
        $this->RESPONTGLPLG_DESC->AdvancedSearch->load();
        $this->RESPONPOST_VKLAIM->AdvancedSearch->load();
        $this->RESPONPUT_VKLAIM->AdvancedSearch->load();
        $this->RESPONDEL_VKLAIM->AdvancedSearch->load();
        $this->CALL_TIMES->AdvancedSearch->load();
        $this->CALL_DATE->AdvancedSearch->load();
        $this->CALL_DATES->AdvancedSearch->load();
        $this->SERVED_DATE->AdvancedSearch->load();
        $this->SERVED_INAP->AdvancedSearch->load();
        $this->KDDPJP1->AdvancedSearch->load();
        $this->KDDPJP->AdvancedSearch->load();
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("CvVisitList"), "", $this->TableVar, true);
        $pageId = "search";
        $Breadcrumb->add("search", $pageId, $url);
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
                case "x_CLINIC_ID":
                    $lookupFilter = function () {
                        return "[STYPE_ID] = 1 OR [STYPE_ID] = 2 OR [STYPE_ID] = 5";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KELUAR_ID":
                    break;
                case "x_GENDER":
                    $lookupFilter = function () {
                        return "[GENDER] = 1 OR [GENDER] = 2";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
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
                case "x_DIAGNOSA_ID":
                    break;
                case "x_PPKRUJUKAN":
                    break;
                case "x_KODE_AGAMA":
                    break;
                case "x_DIAG_AWAL":
                    break;
                case "x_KDPOLI_EKS":
                    break;
                case "x_COB":
                    break;
                case "x_ASALRUJUKAN":
                    break;
                case "x_RESPONTGLPLG_DESC":
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
}
