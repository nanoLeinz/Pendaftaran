<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienVisitationAdd extends PasienVisitation
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'PASIEN_VISITATION';

    // Page object name
    public $PageObjName = "PasienVisitationAdd";

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

        // Table object (PASIEN_VISITATION)
        if (!isset($GLOBALS["PASIEN_VISITATION"]) || get_class($GLOBALS["PASIEN_VISITATION"]) == PROJECT_NAMESPACE . "PASIEN_VISITATION") {
            $GLOBALS["PASIEN_VISITATION"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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
                    if ($pageName == "PasienVisitationView") {
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->ORG_UNIT_CODE->setVisibility();
        $this->VISIT_ID->Visible = false;
        $this->TICKET_NO->Visible = false;
        $this->NO_REGISTRATION->setVisibility();
        $this->DIANTAR_OLEH->Visible = false;
        $this->STATUS_PASIEN_ID->setVisibility();
        $this->PASIEN_ID->Visible = false;
        $this->RUJUKAN_ID->setVisibility();
        $this->ADDRESS_OF_RUJUKAN->Visible = false;
        $this->REASON_ID->setVisibility();
        $this->WAY_ID->setVisibility();
        $this->PATIENT_CATEGORY_ID->setVisibility();
        $this->VISIT_DATE->setVisibility();
        $this->BOOKED_DATE->setVisibility();
        $this->ISNEW->setVisibility();
        $this->KDPOLI_EKS->setVisibility();
        $this->FOLLOW_UP->setVisibility();
        $this->PLACE_TYPE->setVisibility();
        $this->CLINIC_ID->setVisibility();
        $this->RESPONTGLPLG_DESC->setVisibility();
        $this->CLINIC_ID_FROM->setVisibility();
        $this->CLASS_ROOM_ID->Visible = false;
        $this->BED_ID->Visible = false;
        $this->KELUAR_ID->Visible = false;
        $this->IN_DATE->Visible = false;
        $this->EXIT_DATE->Visible = false;
        $this->GENDER->Visible = false;
        $this->KODE_AGAMA->Visible = false;
        $this->VISITOR_ADDRESS->Visible = false;
        $this->MODIFIED_BY->setVisibility();
        $this->MODIFIED_DATE->setVisibility();
        $this->MODIFIED_FROM->setVisibility();
        $this->EMPLOYEE_ID->setVisibility();
        $this->EMPLOYEE_ID_FROM->Visible = false;
        $this->RESPONSIBLE_ID->setVisibility();
        $this->RESPONSIBLE->Visible = false;
        $this->FAMILY_STATUS_ID->Visible = false;
        $this->ISATTENDED->Visible = false;
        $this->PAYOR_ID->Visible = false;
        $this->CLASS_ID->Visible = false;
        $this->ISPERTARIF->setVisibility();
        $this->KAL_ID->Visible = false;
        $this->EMPLOYEE_INAP->Visible = false;
        $this->KARYAWAN->Visible = false;
        $this->ACCOUNT_ID->Visible = false;
        $this->CLASS_ID_PLAFOND->setVisibility();
        $this->BACKCHARGE->setVisibility();
        $this->COVERAGE_ID->Visible = false;
        $this->AGEYEAR->Visible = false;
        $this->AGEMONTH->Visible = false;
        $this->AGEDAY->Visible = false;
        $this->RECOMENDATION->Visible = false;
        $this->CONCLUSION->Visible = false;
        $this->SPECIMENNO->Visible = false;
        $this->LOCKED->setVisibility();
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
        $this->tanggal_rujukan->setVisibility();
        $this->ISRJ->setVisibility();
        $this->ASALRUJUKAN->Visible = false;
        $this->NORUJUKAN->setVisibility();
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
        $this->CALL_TIMES->setVisibility();
        $this->CALL_DATE->Visible = false;
        $this->CALL_DATES->Visible = false;
        $this->SERVED_DATE->Visible = false;
        $this->SERVED_INAP->Visible = false;
        $this->KDDPJP1->Visible = false;
        $this->KDDPJP->setVisibility();
        $this->DESCRIPTION->setVisibility();
        $this->tgl_kontrol->Visible = false;
        $this->Faskes->Visible = false;
        $this->SEP->Visible = false;
        $this->IDXDAFTAR->Visible = false;
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
        $this->setupLookupOptions($this->KODE_AGAMA);
        $this->setupLookupOptions($this->EMPLOYEE_ID);
        $this->setupLookupOptions($this->CLASS_ID);
        $this->setupLookupOptions($this->KAL_ID);
        $this->setupLookupOptions($this->COVERAGE_ID);
        $this->setupLookupOptions($this->DIAG_AWAL);
        $this->setupLookupOptions($this->DIAGNOSA_ID);
        $this->setupLookupOptions($this->PPKRUJUKAN);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("IDXDAFTAR") ?? Route("IDXDAFTAR")) !== null) {
                $this->IDXDAFTAR->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Set up master/detail parameters
        // NOTE: must be after loadOldRecord to prevent master key values overwritten
        $this->setupMasterParms();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("PasienVisitationList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->GetEditUrl();
                    if (GetPageName($returnUrl) == "PasienVisitationList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PasienVisitationView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->ORG_UNIT_CODE->CurrentValue = CurrentOrgId();
        $this->VISIT_ID->CurrentValue = null;
        $this->VISIT_ID->OldValue = $this->VISIT_ID->CurrentValue;
        $this->TICKET_NO->CurrentValue = null;
        $this->TICKET_NO->OldValue = $this->TICKET_NO->CurrentValue;
        $this->NO_REGISTRATION->CurrentValue = null;
        $this->NO_REGISTRATION->OldValue = $this->NO_REGISTRATION->CurrentValue;
        $this->DIANTAR_OLEH->CurrentValue = null;
        $this->DIANTAR_OLEH->OldValue = $this->DIANTAR_OLEH->CurrentValue;
        $this->STATUS_PASIEN_ID->CurrentValue = "1";
        $this->PASIEN_ID->CurrentValue = null;
        $this->PASIEN_ID->OldValue = $this->PASIEN_ID->CurrentValue;
        $this->RUJUKAN_ID->CurrentValue = 1;
        $this->ADDRESS_OF_RUJUKAN->CurrentValue = null;
        $this->ADDRESS_OF_RUJUKAN->OldValue = $this->ADDRESS_OF_RUJUKAN->CurrentValue;
        $this->REASON_ID->CurrentValue = "1";
        $this->WAY_ID->CurrentValue = "3";
        $this->PATIENT_CATEGORY_ID->CurrentValue = '0';
        $this->VISIT_DATE->CurrentValue = CurrentDateTime();
        $this->BOOKED_DATE->CurrentValue = CurrentDateTime();
        $this->ISNEW->CurrentValue = '0';
        $this->KDPOLI_EKS->CurrentValue = "0";
        $this->FOLLOW_UP->CurrentValue = 0;
        $this->PLACE_TYPE->CurrentValue = 0;
        $this->CLINIC_ID->CurrentValue = null;
        $this->CLINIC_ID->OldValue = $this->CLINIC_ID->CurrentValue;
        $this->RESPONTGLPLG_DESC->CurrentValue = '2';
        $this->CLINIC_ID_FROM->CurrentValue = "P000";
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
        $this->RESPONSIBLE->CurrentValue = null;
        $this->RESPONSIBLE->OldValue = $this->RESPONSIBLE->CurrentValue;
        $this->FAMILY_STATUS_ID->CurrentValue = null;
        $this->FAMILY_STATUS_ID->OldValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->ISATTENDED->CurrentValue = '0';
        $this->PAYOR_ID->CurrentValue = null;
        $this->PAYOR_ID->OldValue = $this->PAYOR_ID->CurrentValue;
        $this->CLASS_ID->CurrentValue = null;
        $this->CLASS_ID->OldValue = $this->CLASS_ID->CurrentValue;
        $this->ISPERTARIF->CurrentValue = "0";
        $this->KAL_ID->CurrentValue = null;
        $this->KAL_ID->OldValue = $this->KAL_ID->CurrentValue;
        $this->EMPLOYEE_INAP->CurrentValue = null;
        $this->EMPLOYEE_INAP->OldValue = $this->EMPLOYEE_INAP->CurrentValue;
        $this->KARYAWAN->CurrentValue = null;
        $this->KARYAWAN->OldValue = $this->KARYAWAN->CurrentValue;
        $this->ACCOUNT_ID->CurrentValue = null;
        $this->ACCOUNT_ID->OldValue = $this->ACCOUNT_ID->CurrentValue;
        $this->CLASS_ID_PLAFOND->CurrentValue = 0;
        $this->BACKCHARGE->CurrentValue = "0";
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
        $this->ISRJ->CurrentValue = "2";
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
        $this->tgl_kontrol->CurrentValue = null;
        $this->tgl_kontrol->OldValue = $this->tgl_kontrol->CurrentValue;
        $this->Faskes->CurrentValue = "1";
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

        // Check field name 'ORG_UNIT_CODE' first before field var 'x_ORG_UNIT_CODE'
        $val = $CurrentForm->hasValue("ORG_UNIT_CODE") ? $CurrentForm->getValue("ORG_UNIT_CODE") : $CurrentForm->getValue("x_ORG_UNIT_CODE");
        if (!$this->ORG_UNIT_CODE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ORG_UNIT_CODE->Visible = false; // Disable update for API request
            } else {
                $this->ORG_UNIT_CODE->setFormValue($val);
            }
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

        // Check field name 'STATUS_PASIEN_ID' first before field var 'x_STATUS_PASIEN_ID'
        $val = $CurrentForm->hasValue("STATUS_PASIEN_ID") ? $CurrentForm->getValue("STATUS_PASIEN_ID") : $CurrentForm->getValue("x_STATUS_PASIEN_ID");
        if (!$this->STATUS_PASIEN_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->STATUS_PASIEN_ID->Visible = false; // Disable update for API request
            } else {
                $this->STATUS_PASIEN_ID->setFormValue($val);
            }
        }

        // Check field name 'RUJUKAN_ID' first before field var 'x_RUJUKAN_ID'
        $val = $CurrentForm->hasValue("RUJUKAN_ID") ? $CurrentForm->getValue("RUJUKAN_ID") : $CurrentForm->getValue("x_RUJUKAN_ID");
        if (!$this->RUJUKAN_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->RUJUKAN_ID->Visible = false; // Disable update for API request
            } else {
                $this->RUJUKAN_ID->setFormValue($val);
            }
        }

        // Check field name 'REASON_ID' first before field var 'x_REASON_ID'
        $val = $CurrentForm->hasValue("REASON_ID") ? $CurrentForm->getValue("REASON_ID") : $CurrentForm->getValue("x_REASON_ID");
        if (!$this->REASON_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->REASON_ID->Visible = false; // Disable update for API request
            } else {
                $this->REASON_ID->setFormValue($val);
            }
        }

        // Check field name 'WAY_ID' first before field var 'x_WAY_ID'
        $val = $CurrentForm->hasValue("WAY_ID") ? $CurrentForm->getValue("WAY_ID") : $CurrentForm->getValue("x_WAY_ID");
        if (!$this->WAY_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->WAY_ID->Visible = false; // Disable update for API request
            } else {
                $this->WAY_ID->setFormValue($val);
            }
        }

        // Check field name 'PATIENT_CATEGORY_ID' first before field var 'x_PATIENT_CATEGORY_ID'
        $val = $CurrentForm->hasValue("PATIENT_CATEGORY_ID") ? $CurrentForm->getValue("PATIENT_CATEGORY_ID") : $CurrentForm->getValue("x_PATIENT_CATEGORY_ID");
        if (!$this->PATIENT_CATEGORY_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PATIENT_CATEGORY_ID->Visible = false; // Disable update for API request
            } else {
                $this->PATIENT_CATEGORY_ID->setFormValue($val);
            }
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

        // Check field name 'BOOKED_DATE' first before field var 'x_BOOKED_DATE'
        $val = $CurrentForm->hasValue("BOOKED_DATE") ? $CurrentForm->getValue("BOOKED_DATE") : $CurrentForm->getValue("x_BOOKED_DATE");
        if (!$this->BOOKED_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->BOOKED_DATE->Visible = false; // Disable update for API request
            } else {
                $this->BOOKED_DATE->setFormValue($val);
            }
            $this->BOOKED_DATE->CurrentValue = UnFormatDateTime($this->BOOKED_DATE->CurrentValue, 11);
        }

        // Check field name 'ISNEW' first before field var 'x_ISNEW'
        $val = $CurrentForm->hasValue("ISNEW") ? $CurrentForm->getValue("ISNEW") : $CurrentForm->getValue("x_ISNEW");
        if (!$this->ISNEW->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ISNEW->Visible = false; // Disable update for API request
            } else {
                $this->ISNEW->setFormValue($val);
            }
        }

        // Check field name 'KDPOLI_EKS' first before field var 'x_KDPOLI_EKS'
        $val = $CurrentForm->hasValue("KDPOLI_EKS") ? $CurrentForm->getValue("KDPOLI_EKS") : $CurrentForm->getValue("x_KDPOLI_EKS");
        if (!$this->KDPOLI_EKS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KDPOLI_EKS->Visible = false; // Disable update for API request
            } else {
                $this->KDPOLI_EKS->setFormValue($val);
            }
        }

        // Check field name 'FOLLOW_UP' first before field var 'x_FOLLOW_UP'
        $val = $CurrentForm->hasValue("FOLLOW_UP") ? $CurrentForm->getValue("FOLLOW_UP") : $CurrentForm->getValue("x_FOLLOW_UP");
        if (!$this->FOLLOW_UP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FOLLOW_UP->Visible = false; // Disable update for API request
            } else {
                $this->FOLLOW_UP->setFormValue($val);
            }
        }

        // Check field name 'PLACE_TYPE' first before field var 'x_PLACE_TYPE'
        $val = $CurrentForm->hasValue("PLACE_TYPE") ? $CurrentForm->getValue("PLACE_TYPE") : $CurrentForm->getValue("x_PLACE_TYPE");
        if (!$this->PLACE_TYPE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PLACE_TYPE->Visible = false; // Disable update for API request
            } else {
                $this->PLACE_TYPE->setFormValue($val);
            }
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

        // Check field name 'RESPONTGLPLG_DESC' first before field var 'x_RESPONTGLPLG_DESC'
        $val = $CurrentForm->hasValue("RESPONTGLPLG_DESC") ? $CurrentForm->getValue("RESPONTGLPLG_DESC") : $CurrentForm->getValue("x_RESPONTGLPLG_DESC");
        if (!$this->RESPONTGLPLG_DESC->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->RESPONTGLPLG_DESC->Visible = false; // Disable update for API request
            } else {
                $this->RESPONTGLPLG_DESC->setFormValue($val);
            }
        }

        // Check field name 'CLINIC_ID_FROM' first before field var 'x_CLINIC_ID_FROM'
        $val = $CurrentForm->hasValue("CLINIC_ID_FROM") ? $CurrentForm->getValue("CLINIC_ID_FROM") : $CurrentForm->getValue("x_CLINIC_ID_FROM");
        if (!$this->CLINIC_ID_FROM->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLINIC_ID_FROM->Visible = false; // Disable update for API request
            } else {
                $this->CLINIC_ID_FROM->setFormValue($val);
            }
        }

        // Check field name 'MODIFIED_BY' first before field var 'x_MODIFIED_BY'
        $val = $CurrentForm->hasValue("MODIFIED_BY") ? $CurrentForm->getValue("MODIFIED_BY") : $CurrentForm->getValue("x_MODIFIED_BY");
        if (!$this->MODIFIED_BY->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MODIFIED_BY->Visible = false; // Disable update for API request
            } else {
                $this->MODIFIED_BY->setFormValue($val);
            }
        }

        // Check field name 'MODIFIED_DATE' first before field var 'x_MODIFIED_DATE'
        $val = $CurrentForm->hasValue("MODIFIED_DATE") ? $CurrentForm->getValue("MODIFIED_DATE") : $CurrentForm->getValue("x_MODIFIED_DATE");
        if (!$this->MODIFIED_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MODIFIED_DATE->Visible = false; // Disable update for API request
            } else {
                $this->MODIFIED_DATE->setFormValue($val);
            }
            $this->MODIFIED_DATE->CurrentValue = UnFormatDateTime($this->MODIFIED_DATE->CurrentValue, 11);
        }

        // Check field name 'MODIFIED_FROM' first before field var 'x_MODIFIED_FROM'
        $val = $CurrentForm->hasValue("MODIFIED_FROM") ? $CurrentForm->getValue("MODIFIED_FROM") : $CurrentForm->getValue("x_MODIFIED_FROM");
        if (!$this->MODIFIED_FROM->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MODIFIED_FROM->Visible = false; // Disable update for API request
            } else {
                $this->MODIFIED_FROM->setFormValue($val);
            }
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

        // Check field name 'RESPONSIBLE_ID' first before field var 'x_RESPONSIBLE_ID'
        $val = $CurrentForm->hasValue("RESPONSIBLE_ID") ? $CurrentForm->getValue("RESPONSIBLE_ID") : $CurrentForm->getValue("x_RESPONSIBLE_ID");
        if (!$this->RESPONSIBLE_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->RESPONSIBLE_ID->Visible = false; // Disable update for API request
            } else {
                $this->RESPONSIBLE_ID->setFormValue($val);
            }
        }

        // Check field name 'ISPERTARIF' first before field var 'x_ISPERTARIF'
        $val = $CurrentForm->hasValue("ISPERTARIF") ? $CurrentForm->getValue("ISPERTARIF") : $CurrentForm->getValue("x_ISPERTARIF");
        if (!$this->ISPERTARIF->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ISPERTARIF->Visible = false; // Disable update for API request
            } else {
                $this->ISPERTARIF->setFormValue($val);
            }
        }

        // Check field name 'CLASS_ID_PLAFOND' first before field var 'x_CLASS_ID_PLAFOND'
        $val = $CurrentForm->hasValue("CLASS_ID_PLAFOND") ? $CurrentForm->getValue("CLASS_ID_PLAFOND") : $CurrentForm->getValue("x_CLASS_ID_PLAFOND");
        if (!$this->CLASS_ID_PLAFOND->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLASS_ID_PLAFOND->Visible = false; // Disable update for API request
            } else {
                $this->CLASS_ID_PLAFOND->setFormValue($val);
            }
        }

        // Check field name 'BACKCHARGE' first before field var 'x_BACKCHARGE'
        $val = $CurrentForm->hasValue("BACKCHARGE") ? $CurrentForm->getValue("BACKCHARGE") : $CurrentForm->getValue("x_BACKCHARGE");
        if (!$this->BACKCHARGE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->BACKCHARGE->Visible = false; // Disable update for API request
            } else {
                $this->BACKCHARGE->setFormValue($val);
            }
        }

        // Check field name 'LOCKED' first before field var 'x_LOCKED'
        $val = $CurrentForm->hasValue("LOCKED") ? $CurrentForm->getValue("LOCKED") : $CurrentForm->getValue("x_LOCKED");
        if (!$this->LOCKED->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LOCKED->Visible = false; // Disable update for API request
            } else {
                $this->LOCKED->setFormValue($val);
            }
        }

        // Check field name 'tanggal_rujukan' first before field var 'x_tanggal_rujukan'
        $val = $CurrentForm->hasValue("tanggal_rujukan") ? $CurrentForm->getValue("tanggal_rujukan") : $CurrentForm->getValue("x_tanggal_rujukan");
        if (!$this->tanggal_rujukan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggal_rujukan->Visible = false; // Disable update for API request
            } else {
                $this->tanggal_rujukan->setFormValue($val);
            }
            $this->tanggal_rujukan->CurrentValue = UnFormatDateTime($this->tanggal_rujukan->CurrentValue, 17);
        }

        // Check field name 'ISRJ' first before field var 'x_ISRJ'
        $val = $CurrentForm->hasValue("ISRJ") ? $CurrentForm->getValue("ISRJ") : $CurrentForm->getValue("x_ISRJ");
        if (!$this->ISRJ->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ISRJ->Visible = false; // Disable update for API request
            } else {
                $this->ISRJ->setFormValue($val);
            }
        }

        // Check field name 'NORUJUKAN' first before field var 'x_NORUJUKAN'
        $val = $CurrentForm->hasValue("NORUJUKAN") ? $CurrentForm->getValue("NORUJUKAN") : $CurrentForm->getValue("x_NORUJUKAN");
        if (!$this->NORUJUKAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NORUJUKAN->Visible = false; // Disable update for API request
            } else {
                $this->NORUJUKAN->setFormValue($val);
            }
        }

        // Check field name 'CALL_TIMES' first before field var 'x_CALL_TIMES'
        $val = $CurrentForm->hasValue("CALL_TIMES") ? $CurrentForm->getValue("CALL_TIMES") : $CurrentForm->getValue("x_CALL_TIMES");
        if (!$this->CALL_TIMES->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CALL_TIMES->Visible = false; // Disable update for API request
            } else {
                $this->CALL_TIMES->setFormValue($val);
            }
        }

        // Check field name 'KDDPJP' first before field var 'x_KDDPJP'
        $val = $CurrentForm->hasValue("KDDPJP") ? $CurrentForm->getValue("KDDPJP") : $CurrentForm->getValue("x_KDDPJP");
        if (!$this->KDDPJP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KDDPJP->Visible = false; // Disable update for API request
            } else {
                $this->KDDPJP->setFormValue($val);
            }
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

        // Check field name 'idbooking' first before field var 'x_idbooking'
        $val = $CurrentForm->hasValue("idbooking") ? $CurrentForm->getValue("idbooking") : $CurrentForm->getValue("x_idbooking");
        if (!$this->idbooking->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->idbooking->Visible = false; // Disable update for API request
            } else {
                $this->idbooking->setFormValue($val);
            }
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

        // Check field name 'id_penunjang' first before field var 'x_id_penunjang'
        $val = $CurrentForm->hasValue("id_penunjang") ? $CurrentForm->getValue("id_penunjang") : $CurrentForm->getValue("x_id_penunjang");
        if (!$this->id_penunjang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_penunjang->Visible = false; // Disable update for API request
            } else {
                $this->id_penunjang->setFormValue($val);
            }
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

        // Check field name 'id_procedure' first before field var 'x_id_procedure'
        $val = $CurrentForm->hasValue("id_procedure") ? $CurrentForm->getValue("id_procedure") : $CurrentForm->getValue("x_id_procedure");
        if (!$this->id_procedure->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_procedure->Visible = false; // Disable update for API request
            } else {
                $this->id_procedure->setFormValue($val);
            }
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

        // Check field name 'id_kelas' first before field var 'x_id_kelas'
        $val = $CurrentForm->hasValue("id_kelas") ? $CurrentForm->getValue("id_kelas") : $CurrentForm->getValue("x_id_kelas");
        if (!$this->id_kelas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_kelas->Visible = false; // Disable update for API request
            } else {
                $this->id_kelas->setFormValue($val);
            }
        }

        // Check field name 'IDXDAFTAR' first before field var 'x_IDXDAFTAR'
        $val = $CurrentForm->hasValue("IDXDAFTAR") ? $CurrentForm->getValue("IDXDAFTAR") : $CurrentForm->getValue("x_IDXDAFTAR");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ORG_UNIT_CODE->CurrentValue = $this->ORG_UNIT_CODE->FormValue;
        $this->NO_REGISTRATION->CurrentValue = $this->NO_REGISTRATION->FormValue;
        $this->STATUS_PASIEN_ID->CurrentValue = $this->STATUS_PASIEN_ID->FormValue;
        $this->RUJUKAN_ID->CurrentValue = $this->RUJUKAN_ID->FormValue;
        $this->REASON_ID->CurrentValue = $this->REASON_ID->FormValue;
        $this->WAY_ID->CurrentValue = $this->WAY_ID->FormValue;
        $this->PATIENT_CATEGORY_ID->CurrentValue = $this->PATIENT_CATEGORY_ID->FormValue;
        $this->VISIT_DATE->CurrentValue = $this->VISIT_DATE->FormValue;
        $this->VISIT_DATE->CurrentValue = UnFormatDateTime($this->VISIT_DATE->CurrentValue, 11);
        $this->BOOKED_DATE->CurrentValue = $this->BOOKED_DATE->FormValue;
        $this->BOOKED_DATE->CurrentValue = UnFormatDateTime($this->BOOKED_DATE->CurrentValue, 11);
        $this->ISNEW->CurrentValue = $this->ISNEW->FormValue;
        $this->KDPOLI_EKS->CurrentValue = $this->KDPOLI_EKS->FormValue;
        $this->FOLLOW_UP->CurrentValue = $this->FOLLOW_UP->FormValue;
        $this->PLACE_TYPE->CurrentValue = $this->PLACE_TYPE->FormValue;
        $this->CLINIC_ID->CurrentValue = $this->CLINIC_ID->FormValue;
        $this->RESPONTGLPLG_DESC->CurrentValue = $this->RESPONTGLPLG_DESC->FormValue;
        $this->CLINIC_ID_FROM->CurrentValue = $this->CLINIC_ID_FROM->FormValue;
        $this->MODIFIED_BY->CurrentValue = $this->MODIFIED_BY->FormValue;
        $this->MODIFIED_DATE->CurrentValue = $this->MODIFIED_DATE->FormValue;
        $this->MODIFIED_DATE->CurrentValue = UnFormatDateTime($this->MODIFIED_DATE->CurrentValue, 11);
        $this->MODIFIED_FROM->CurrentValue = $this->MODIFIED_FROM->FormValue;
        $this->EMPLOYEE_ID->CurrentValue = $this->EMPLOYEE_ID->FormValue;
        $this->RESPONSIBLE_ID->CurrentValue = $this->RESPONSIBLE_ID->FormValue;
        $this->ISPERTARIF->CurrentValue = $this->ISPERTARIF->FormValue;
        $this->CLASS_ID_PLAFOND->CurrentValue = $this->CLASS_ID_PLAFOND->FormValue;
        $this->BACKCHARGE->CurrentValue = $this->BACKCHARGE->FormValue;
        $this->LOCKED->CurrentValue = $this->LOCKED->FormValue;
        $this->tanggal_rujukan->CurrentValue = $this->tanggal_rujukan->FormValue;
        $this->tanggal_rujukan->CurrentValue = UnFormatDateTime($this->tanggal_rujukan->CurrentValue, 17);
        $this->ISRJ->CurrentValue = $this->ISRJ->FormValue;
        $this->NORUJUKAN->CurrentValue = $this->NORUJUKAN->FormValue;
        $this->CALL_TIMES->CurrentValue = $this->CALL_TIMES->FormValue;
        $this->KDDPJP->CurrentValue = $this->KDDPJP->FormValue;
        $this->DESCRIPTION->CurrentValue = $this->DESCRIPTION->FormValue;
        $this->idbooking->CurrentValue = $this->idbooking->FormValue;
        $this->id_tujuan->CurrentValue = $this->id_tujuan->FormValue;
        $this->id_penunjang->CurrentValue = $this->id_penunjang->FormValue;
        $this->id_pembiayaan->CurrentValue = $this->id_pembiayaan->FormValue;
        $this->id_procedure->CurrentValue = $this->id_procedure->FormValue;
        $this->id_aspel->CurrentValue = $this->id_aspel->FormValue;
        $this->id_kelas->CurrentValue = $this->id_kelas->FormValue;
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE

        // VISIT_ID

        // TICKET_NO

        // NO_REGISTRATION

        // DIANTAR_OLEH

        // STATUS_PASIEN_ID

        // PASIEN_ID

        // RUJUKAN_ID

        // ADDRESS_OF_RUJUKAN

        // REASON_ID

        // WAY_ID

        // PATIENT_CATEGORY_ID

        // VISIT_DATE

        // BOOKED_DATE

        // ISNEW

        // KDPOLI_EKS

        // FOLLOW_UP

        // PLACE_TYPE

        // CLINIC_ID

        // RESPONTGLPLG_DESC

        // CLINIC_ID_FROM

        // CLASS_ROOM_ID

        // BED_ID

        // KELUAR_ID

        // IN_DATE

        // EXIT_DATE

        // GENDER

        // KODE_AGAMA

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

        // ticket_all

        // tanggal_rujukan

        // ISRJ

        // ASALRUJUKAN

        // NORUJUKAN

        // DIAG_AWAL

        // DIAGNOSA_ID

        // PPKRUJUKAN

        // LOKASILAKA

        // KDPOLI

        // EDIT_SEP

        // DELETE_SEP

        // AKTIF

        // BILL_INAP

        // SEP_PRINTDATE

        // MAPPING_SEP

        // TRANS_ID

        // COB

        // PENJAMIN

        // RESPONSEP

        // APPROVAL_DESC

        // APPROVAL_RESPONAJUKAN

        // APPROVAL_RESPONAPPROV

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

        // DESCRIPTION

        // tgl_kontrol

        // Faskes

        // SEP

        // IDXDAFTAR

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

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";
            $this->STATUS_PASIEN_ID->TooltipValue = "";

            // RUJUKAN_ID
            $this->RUJUKAN_ID->LinkCustomAttributes = "";
            $this->RUJUKAN_ID->HrefValue = "";
            $this->RUJUKAN_ID->TooltipValue = "";

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

            // VISIT_DATE
            $this->VISIT_DATE->LinkCustomAttributes = "";
            $this->VISIT_DATE->HrefValue = "";
            $this->VISIT_DATE->TooltipValue = "";

            // BOOKED_DATE
            $this->BOOKED_DATE->LinkCustomAttributes = "";
            $this->BOOKED_DATE->HrefValue = "";
            $this->BOOKED_DATE->TooltipValue = "";

            // ISNEW
            $this->ISNEW->LinkCustomAttributes = "";
            $this->ISNEW->HrefValue = "";
            $this->ISNEW->TooltipValue = "";

            // KDPOLI_EKS
            $this->KDPOLI_EKS->LinkCustomAttributes = "";
            $this->KDPOLI_EKS->HrefValue = "";
            $this->KDPOLI_EKS->TooltipValue = "";

            // FOLLOW_UP
            $this->FOLLOW_UP->LinkCustomAttributes = "";
            $this->FOLLOW_UP->HrefValue = "";
            $this->FOLLOW_UP->TooltipValue = "";

            // PLACE_TYPE
            $this->PLACE_TYPE->LinkCustomAttributes = "";
            $this->PLACE_TYPE->HrefValue = "";
            $this->PLACE_TYPE->TooltipValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";
            $this->CLINIC_ID->TooltipValue = "";

            // RESPONTGLPLG_DESC
            $this->RESPONTGLPLG_DESC->LinkCustomAttributes = "";
            $this->RESPONTGLPLG_DESC->HrefValue = "";
            $this->RESPONTGLPLG_DESC->TooltipValue = "";

            // CLINIC_ID_FROM
            $this->CLINIC_ID_FROM->LinkCustomAttributes = "";
            $this->CLINIC_ID_FROM->HrefValue = "";
            $this->CLINIC_ID_FROM->TooltipValue = "";

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

            // RESPONSIBLE_ID
            $this->RESPONSIBLE_ID->LinkCustomAttributes = "";
            $this->RESPONSIBLE_ID->HrefValue = "";
            $this->RESPONSIBLE_ID->TooltipValue = "";

            // ISPERTARIF
            $this->ISPERTARIF->LinkCustomAttributes = "";
            $this->ISPERTARIF->HrefValue = "";
            $this->ISPERTARIF->TooltipValue = "";

            // CLASS_ID_PLAFOND
            $this->CLASS_ID_PLAFOND->LinkCustomAttributes = "";
            $this->CLASS_ID_PLAFOND->HrefValue = "";
            $this->CLASS_ID_PLAFOND->TooltipValue = "";

            // BACKCHARGE
            $this->BACKCHARGE->LinkCustomAttributes = "";
            $this->BACKCHARGE->HrefValue = "";
            $this->BACKCHARGE->TooltipValue = "";

            // LOCKED
            $this->LOCKED->LinkCustomAttributes = "";
            $this->LOCKED->HrefValue = "";
            $this->LOCKED->TooltipValue = "";

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

            // CALL_TIMES
            $this->CALL_TIMES->LinkCustomAttributes = "";
            $this->CALL_TIMES->HrefValue = "";
            $this->CALL_TIMES->TooltipValue = "";

            // KDDPJP
            $this->KDDPJP->LinkCustomAttributes = "";
            $this->KDDPJP->HrefValue = "";
            $this->KDDPJP->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";
            $this->DESCRIPTION->TooltipValue = "";

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
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
            $this->ORG_UNIT_CODE->EditCustomAttributes = "";
            $this->ORG_UNIT_CODE->CurrentValue = CurrentOrgId();

            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditCustomAttributes = "";
            if ($this->NO_REGISTRATION->getSessionValue() != "") {
                $this->NO_REGISTRATION->CurrentValue = GetForeignKeyValue($this->NO_REGISTRATION->getSessionValue());
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

            // RUJUKAN_ID
            $this->RUJUKAN_ID->EditAttrs["class"] = "form-control";
            $this->RUJUKAN_ID->EditCustomAttributes = "";
            $this->RUJUKAN_ID->CurrentValue = 1;

            // REASON_ID
            $this->REASON_ID->EditAttrs["class"] = "form-control";
            $this->REASON_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->REASON_ID->CurrentValue));
            if ($curVal != "") {
                $this->REASON_ID->ViewValue = $this->REASON_ID->lookupCacheOption($curVal);
            } else {
                $this->REASON_ID->ViewValue = $this->REASON_ID->Lookup !== null && is_array($this->REASON_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->REASON_ID->ViewValue !== null) { // Load from cache
                $this->REASON_ID->EditValue = array_values($this->REASON_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[REASON_ID]" . SearchString("=", $this->REASON_ID->CurrentValue, DATATYPE_NUMBER, "");
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
            $curVal = trim(strval($this->WAY_ID->CurrentValue));
            if ($curVal != "") {
                $this->WAY_ID->ViewValue = $this->WAY_ID->lookupCacheOption($curVal);
            } else {
                $this->WAY_ID->ViewValue = $this->WAY_ID->Lookup !== null && is_array($this->WAY_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->WAY_ID->ViewValue !== null) { // Load from cache
                $this->WAY_ID->EditValue = array_values($this->WAY_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[WAY_ID]" . SearchString("=", $this->WAY_ID->CurrentValue, DATATYPE_NUMBER, "");
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
            $this->PATIENT_CATEGORY_ID->CurrentValue = '0';

            // VISIT_DATE
            $this->VISIT_DATE->EditAttrs["class"] = "form-control";
            $this->VISIT_DATE->EditCustomAttributes = "";
            $this->VISIT_DATE->EditValue = HtmlEncode(FormatDateTime($this->VISIT_DATE->CurrentValue, 11));
            $this->VISIT_DATE->PlaceHolder = RemoveHtml($this->VISIT_DATE->caption());

            // BOOKED_DATE
            $this->BOOKED_DATE->EditAttrs["class"] = "form-control";
            $this->BOOKED_DATE->EditCustomAttributes = "";
            $this->BOOKED_DATE->EditValue = HtmlEncode(FormatDateTime($this->BOOKED_DATE->CurrentValue, 11));
            $this->BOOKED_DATE->PlaceHolder = RemoveHtml($this->BOOKED_DATE->caption());

            // ISNEW
            $this->ISNEW->EditCustomAttributes = "";
            $this->ISNEW->EditValue = $this->ISNEW->options(false);
            $this->ISNEW->PlaceHolder = RemoveHtml($this->ISNEW->caption());

            // KDPOLI_EKS
            $this->KDPOLI_EKS->EditCustomAttributes = "";
            $this->KDPOLI_EKS->EditValue = $this->KDPOLI_EKS->options(false);
            $this->KDPOLI_EKS->PlaceHolder = RemoveHtml($this->KDPOLI_EKS->caption());

            // FOLLOW_UP
            $this->FOLLOW_UP->EditAttrs["class"] = "form-control";
            $this->FOLLOW_UP->EditCustomAttributes = "";
            $this->FOLLOW_UP->CurrentValue = 0;

            // PLACE_TYPE
            $this->PLACE_TYPE->EditAttrs["class"] = "form-control";
            $this->PLACE_TYPE->EditCustomAttributes = "";
            $this->PLACE_TYPE->CurrentValue = 0;

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

            // RESPONTGLPLG_DESC
            $this->RESPONTGLPLG_DESC->EditAttrs["class"] = "form-control";
            $this->RESPONTGLPLG_DESC->EditCustomAttributes = "";
            $this->RESPONTGLPLG_DESC->EditValue = $this->RESPONTGLPLG_DESC->options(true);
            $this->RESPONTGLPLG_DESC->PlaceHolder = RemoveHtml($this->RESPONTGLPLG_DESC->caption());

            // CLINIC_ID_FROM
            $this->CLINIC_ID_FROM->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID_FROM->EditCustomAttributes = "";
            $this->CLINIC_ID_FROM->CurrentValue = "P000";

            // MODIFIED_BY

            // MODIFIED_DATE

            // MODIFIED_FROM

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

            // RESPONSIBLE_ID
            $this->RESPONSIBLE_ID->EditAttrs["class"] = "form-control";
            $this->RESPONSIBLE_ID->EditCustomAttributes = "";
            $this->RESPONSIBLE_ID->CurrentValue = 2;

            // ISPERTARIF
            $this->ISPERTARIF->EditAttrs["class"] = "form-control";
            $this->ISPERTARIF->EditCustomAttributes = "";
            $this->ISPERTARIF->CurrentValue = "0";

            // CLASS_ID_PLAFOND
            $this->CLASS_ID_PLAFOND->EditAttrs["class"] = "form-control";
            $this->CLASS_ID_PLAFOND->EditCustomAttributes = "";
            $this->CLASS_ID_PLAFOND->CurrentValue = 0;

            // BACKCHARGE
            $this->BACKCHARGE->EditAttrs["class"] = "form-control";
            $this->BACKCHARGE->EditCustomAttributes = "";
            $this->BACKCHARGE->CurrentValue = "0";

            // LOCKED
            $this->LOCKED->EditAttrs["class"] = "form-control";
            $this->LOCKED->EditCustomAttributes = "";
            $this->LOCKED->CurrentValue = "0";

            // tanggal_rujukan
            $this->tanggal_rujukan->EditAttrs["class"] = "form-control";
            $this->tanggal_rujukan->EditCustomAttributes = "";
            $this->tanggal_rujukan->EditValue = HtmlEncode(FormatDateTime($this->tanggal_rujukan->CurrentValue, 17));
            $this->tanggal_rujukan->PlaceHolder = RemoveHtml($this->tanggal_rujukan->caption());

            // ISRJ
            $this->ISRJ->EditAttrs["class"] = "form-control";
            $this->ISRJ->EditCustomAttributes = "";
            $this->ISRJ->CurrentValue = "2";

            // NORUJUKAN
            $this->NORUJUKAN->EditAttrs["class"] = "form-control";
            $this->NORUJUKAN->EditCustomAttributes = 'readonly';
            if (!$this->NORUJUKAN->Raw) {
                $this->NORUJUKAN->CurrentValue = HtmlDecode($this->NORUJUKAN->CurrentValue);
            }
            $this->NORUJUKAN->EditValue = HtmlEncode($this->NORUJUKAN->CurrentValue);
            $this->NORUJUKAN->PlaceHolder = RemoveHtml($this->NORUJUKAN->caption());

            // CALL_TIMES
            $this->CALL_TIMES->EditAttrs["class"] = "form-control";
            $this->CALL_TIMES->EditCustomAttributes = "";
            $this->CALL_TIMES->CurrentValue = 1;

            // KDDPJP
            $this->KDDPJP->EditAttrs["class"] = "form-control";
            $this->KDDPJP->EditCustomAttributes = 'readonly';
            if (!$this->KDDPJP->Raw) {
                $this->KDDPJP->CurrentValue = HtmlDecode($this->KDDPJP->CurrentValue);
            }
            $this->KDDPJP->EditValue = HtmlEncode($this->KDDPJP->CurrentValue);
            $this->KDDPJP->PlaceHolder = RemoveHtml($this->KDDPJP->caption());

            // DESCRIPTION
            $this->DESCRIPTION->EditAttrs["class"] = "form-control";
            $this->DESCRIPTION->EditCustomAttributes = "";
            $this->DESCRIPTION->EditValue = HtmlEncode($this->DESCRIPTION->CurrentValue);
            $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

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

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";

            // RUJUKAN_ID
            $this->RUJUKAN_ID->LinkCustomAttributes = "";
            $this->RUJUKAN_ID->HrefValue = "";

            // REASON_ID
            $this->REASON_ID->LinkCustomAttributes = "";
            $this->REASON_ID->HrefValue = "";

            // WAY_ID
            $this->WAY_ID->LinkCustomAttributes = "";
            $this->WAY_ID->HrefValue = "";

            // PATIENT_CATEGORY_ID
            $this->PATIENT_CATEGORY_ID->LinkCustomAttributes = "";
            $this->PATIENT_CATEGORY_ID->HrefValue = "";

            // VISIT_DATE
            $this->VISIT_DATE->LinkCustomAttributes = "";
            $this->VISIT_DATE->HrefValue = "";

            // BOOKED_DATE
            $this->BOOKED_DATE->LinkCustomAttributes = "";
            $this->BOOKED_DATE->HrefValue = "";

            // ISNEW
            $this->ISNEW->LinkCustomAttributes = "";
            $this->ISNEW->HrefValue = "";

            // KDPOLI_EKS
            $this->KDPOLI_EKS->LinkCustomAttributes = "";
            $this->KDPOLI_EKS->HrefValue = "";

            // FOLLOW_UP
            $this->FOLLOW_UP->LinkCustomAttributes = "";
            $this->FOLLOW_UP->HrefValue = "";

            // PLACE_TYPE
            $this->PLACE_TYPE->LinkCustomAttributes = "";
            $this->PLACE_TYPE->HrefValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";

            // RESPONTGLPLG_DESC
            $this->RESPONTGLPLG_DESC->LinkCustomAttributes = "";
            $this->RESPONTGLPLG_DESC->HrefValue = "";

            // CLINIC_ID_FROM
            $this->CLINIC_ID_FROM->LinkCustomAttributes = "";
            $this->CLINIC_ID_FROM->HrefValue = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->LinkCustomAttributes = "";
            $this->MODIFIED_BY->HrefValue = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->LinkCustomAttributes = "";
            $this->MODIFIED_DATE->HrefValue = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->LinkCustomAttributes = "";
            $this->MODIFIED_FROM->HrefValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";

            // RESPONSIBLE_ID
            $this->RESPONSIBLE_ID->LinkCustomAttributes = "";
            $this->RESPONSIBLE_ID->HrefValue = "";

            // ISPERTARIF
            $this->ISPERTARIF->LinkCustomAttributes = "";
            $this->ISPERTARIF->HrefValue = "";

            // CLASS_ID_PLAFOND
            $this->CLASS_ID_PLAFOND->LinkCustomAttributes = "";
            $this->CLASS_ID_PLAFOND->HrefValue = "";

            // BACKCHARGE
            $this->BACKCHARGE->LinkCustomAttributes = "";
            $this->BACKCHARGE->HrefValue = "";

            // LOCKED
            $this->LOCKED->LinkCustomAttributes = "";
            $this->LOCKED->HrefValue = "";

            // tanggal_rujukan
            $this->tanggal_rujukan->LinkCustomAttributes = "";
            $this->tanggal_rujukan->HrefValue = "";

            // ISRJ
            $this->ISRJ->LinkCustomAttributes = "";
            $this->ISRJ->HrefValue = "";

            // NORUJUKAN
            $this->NORUJUKAN->LinkCustomAttributes = "";
            $this->NORUJUKAN->HrefValue = "";

            // CALL_TIMES
            $this->CALL_TIMES->LinkCustomAttributes = "";
            $this->CALL_TIMES->HrefValue = "";

            // KDDPJP
            $this->KDDPJP->LinkCustomAttributes = "";
            $this->KDDPJP->HrefValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";

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
        if ($this->ORG_UNIT_CODE->Required) {
            if (!$this->ORG_UNIT_CODE->IsDetailKey && EmptyValue($this->ORG_UNIT_CODE->FormValue)) {
                $this->ORG_UNIT_CODE->addErrorMessage(str_replace("%s", $this->ORG_UNIT_CODE->caption(), $this->ORG_UNIT_CODE->RequiredErrorMessage));
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
        if ($this->RUJUKAN_ID->Required) {
            if (!$this->RUJUKAN_ID->IsDetailKey && EmptyValue($this->RUJUKAN_ID->FormValue)) {
                $this->RUJUKAN_ID->addErrorMessage(str_replace("%s", $this->RUJUKAN_ID->caption(), $this->RUJUKAN_ID->RequiredErrorMessage));
            }
        }
        if ($this->REASON_ID->Required) {
            if (!$this->REASON_ID->IsDetailKey && EmptyValue($this->REASON_ID->FormValue)) {
                $this->REASON_ID->addErrorMessage(str_replace("%s", $this->REASON_ID->caption(), $this->REASON_ID->RequiredErrorMessage));
            }
        }
        if ($this->WAY_ID->Required) {
            if (!$this->WAY_ID->IsDetailKey && EmptyValue($this->WAY_ID->FormValue)) {
                $this->WAY_ID->addErrorMessage(str_replace("%s", $this->WAY_ID->caption(), $this->WAY_ID->RequiredErrorMessage));
            }
        }
        if ($this->PATIENT_CATEGORY_ID->Required) {
            if (!$this->PATIENT_CATEGORY_ID->IsDetailKey && EmptyValue($this->PATIENT_CATEGORY_ID->FormValue)) {
                $this->PATIENT_CATEGORY_ID->addErrorMessage(str_replace("%s", $this->PATIENT_CATEGORY_ID->caption(), $this->PATIENT_CATEGORY_ID->RequiredErrorMessage));
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
        if ($this->BOOKED_DATE->Required) {
            if (!$this->BOOKED_DATE->IsDetailKey && EmptyValue($this->BOOKED_DATE->FormValue)) {
                $this->BOOKED_DATE->addErrorMessage(str_replace("%s", $this->BOOKED_DATE->caption(), $this->BOOKED_DATE->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->BOOKED_DATE->FormValue)) {
            $this->BOOKED_DATE->addErrorMessage($this->BOOKED_DATE->getErrorMessage(false));
        }
        if ($this->ISNEW->Required) {
            if ($this->ISNEW->FormValue == "") {
                $this->ISNEW->addErrorMessage(str_replace("%s", $this->ISNEW->caption(), $this->ISNEW->RequiredErrorMessage));
            }
        }
        if ($this->KDPOLI_EKS->Required) {
            if ($this->KDPOLI_EKS->FormValue == "") {
                $this->KDPOLI_EKS->addErrorMessage(str_replace("%s", $this->KDPOLI_EKS->caption(), $this->KDPOLI_EKS->RequiredErrorMessage));
            }
        }
        if ($this->FOLLOW_UP->Required) {
            if (!$this->FOLLOW_UP->IsDetailKey && EmptyValue($this->FOLLOW_UP->FormValue)) {
                $this->FOLLOW_UP->addErrorMessage(str_replace("%s", $this->FOLLOW_UP->caption(), $this->FOLLOW_UP->RequiredErrorMessage));
            }
        }
        if ($this->PLACE_TYPE->Required) {
            if (!$this->PLACE_TYPE->IsDetailKey && EmptyValue($this->PLACE_TYPE->FormValue)) {
                $this->PLACE_TYPE->addErrorMessage(str_replace("%s", $this->PLACE_TYPE->caption(), $this->PLACE_TYPE->RequiredErrorMessage));
            }
        }
        if ($this->CLINIC_ID->Required) {
            if (!$this->CLINIC_ID->IsDetailKey && EmptyValue($this->CLINIC_ID->FormValue)) {
                $this->CLINIC_ID->addErrorMessage(str_replace("%s", $this->CLINIC_ID->caption(), $this->CLINIC_ID->RequiredErrorMessage));
            }
        }
        if ($this->RESPONTGLPLG_DESC->Required) {
            if (!$this->RESPONTGLPLG_DESC->IsDetailKey && EmptyValue($this->RESPONTGLPLG_DESC->FormValue)) {
                $this->RESPONTGLPLG_DESC->addErrorMessage(str_replace("%s", $this->RESPONTGLPLG_DESC->caption(), $this->RESPONTGLPLG_DESC->RequiredErrorMessage));
            }
        }
        if ($this->CLINIC_ID_FROM->Required) {
            if (!$this->CLINIC_ID_FROM->IsDetailKey && EmptyValue($this->CLINIC_ID_FROM->FormValue)) {
                $this->CLINIC_ID_FROM->addErrorMessage(str_replace("%s", $this->CLINIC_ID_FROM->caption(), $this->CLINIC_ID_FROM->RequiredErrorMessage));
            }
        }
        if ($this->MODIFIED_BY->Required) {
            if (!$this->MODIFIED_BY->IsDetailKey && EmptyValue($this->MODIFIED_BY->FormValue)) {
                $this->MODIFIED_BY->addErrorMessage(str_replace("%s", $this->MODIFIED_BY->caption(), $this->MODIFIED_BY->RequiredErrorMessage));
            }
        }
        if ($this->MODIFIED_DATE->Required) {
            if (!$this->MODIFIED_DATE->IsDetailKey && EmptyValue($this->MODIFIED_DATE->FormValue)) {
                $this->MODIFIED_DATE->addErrorMessage(str_replace("%s", $this->MODIFIED_DATE->caption(), $this->MODIFIED_DATE->RequiredErrorMessage));
            }
        }
        if ($this->MODIFIED_FROM->Required) {
            if (!$this->MODIFIED_FROM->IsDetailKey && EmptyValue($this->MODIFIED_FROM->FormValue)) {
                $this->MODIFIED_FROM->addErrorMessage(str_replace("%s", $this->MODIFIED_FROM->caption(), $this->MODIFIED_FROM->RequiredErrorMessage));
            }
        }
        if ($this->EMPLOYEE_ID->Required) {
            if (!$this->EMPLOYEE_ID->IsDetailKey && EmptyValue($this->EMPLOYEE_ID->FormValue)) {
                $this->EMPLOYEE_ID->addErrorMessage(str_replace("%s", $this->EMPLOYEE_ID->caption(), $this->EMPLOYEE_ID->RequiredErrorMessage));
            }
        }
        if ($this->RESPONSIBLE_ID->Required) {
            if (!$this->RESPONSIBLE_ID->IsDetailKey && EmptyValue($this->RESPONSIBLE_ID->FormValue)) {
                $this->RESPONSIBLE_ID->addErrorMessage(str_replace("%s", $this->RESPONSIBLE_ID->caption(), $this->RESPONSIBLE_ID->RequiredErrorMessage));
            }
        }
        if ($this->ISPERTARIF->Required) {
            if (!$this->ISPERTARIF->IsDetailKey && EmptyValue($this->ISPERTARIF->FormValue)) {
                $this->ISPERTARIF->addErrorMessage(str_replace("%s", $this->ISPERTARIF->caption(), $this->ISPERTARIF->RequiredErrorMessage));
            }
        }
        if ($this->CLASS_ID_PLAFOND->Required) {
            if (!$this->CLASS_ID_PLAFOND->IsDetailKey && EmptyValue($this->CLASS_ID_PLAFOND->FormValue)) {
                $this->CLASS_ID_PLAFOND->addErrorMessage(str_replace("%s", $this->CLASS_ID_PLAFOND->caption(), $this->CLASS_ID_PLAFOND->RequiredErrorMessage));
            }
        }
        if ($this->BACKCHARGE->Required) {
            if (!$this->BACKCHARGE->IsDetailKey && EmptyValue($this->BACKCHARGE->FormValue)) {
                $this->BACKCHARGE->addErrorMessage(str_replace("%s", $this->BACKCHARGE->caption(), $this->BACKCHARGE->RequiredErrorMessage));
            }
        }
        if ($this->LOCKED->Required) {
            if (!$this->LOCKED->IsDetailKey && EmptyValue($this->LOCKED->FormValue)) {
                $this->LOCKED->addErrorMessage(str_replace("%s", $this->LOCKED->caption(), $this->LOCKED->RequiredErrorMessage));
            }
        }
        if ($this->tanggal_rujukan->Required) {
            if (!$this->tanggal_rujukan->IsDetailKey && EmptyValue($this->tanggal_rujukan->FormValue)) {
                $this->tanggal_rujukan->addErrorMessage(str_replace("%s", $this->tanggal_rujukan->caption(), $this->tanggal_rujukan->RequiredErrorMessage));
            }
        }
        if (!CheckShortEuroDate($this->tanggal_rujukan->FormValue)) {
            $this->tanggal_rujukan->addErrorMessage($this->tanggal_rujukan->getErrorMessage(false));
        }
        if ($this->ISRJ->Required) {
            if (!$this->ISRJ->IsDetailKey && EmptyValue($this->ISRJ->FormValue)) {
                $this->ISRJ->addErrorMessage(str_replace("%s", $this->ISRJ->caption(), $this->ISRJ->RequiredErrorMessage));
            }
        }
        if ($this->NORUJUKAN->Required) {
            if (!$this->NORUJUKAN->IsDetailKey && EmptyValue($this->NORUJUKAN->FormValue)) {
                $this->NORUJUKAN->addErrorMessage(str_replace("%s", $this->NORUJUKAN->caption(), $this->NORUJUKAN->RequiredErrorMessage));
            }
        }
        if ($this->CALL_TIMES->Required) {
            if (!$this->CALL_TIMES->IsDetailKey && EmptyValue($this->CALL_TIMES->FormValue)) {
                $this->CALL_TIMES->addErrorMessage(str_replace("%s", $this->CALL_TIMES->caption(), $this->CALL_TIMES->RequiredErrorMessage));
            }
        }
        if ($this->KDDPJP->Required) {
            if (!$this->KDDPJP->IsDetailKey && EmptyValue($this->KDDPJP->FormValue)) {
                $this->KDDPJP->addErrorMessage(str_replace("%s", $this->KDDPJP->caption(), $this->KDDPJP->RequiredErrorMessage));
            }
        }
        if ($this->DESCRIPTION->Required) {
            if (!$this->DESCRIPTION->IsDetailKey && EmptyValue($this->DESCRIPTION->FormValue)) {
                $this->DESCRIPTION->addErrorMessage(str_replace("%s", $this->DESCRIPTION->caption(), $this->DESCRIPTION->RequiredErrorMessage));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->setDbValueDef($rsnew, $this->ORG_UNIT_CODE->CurrentValue, "", false);

        // NO_REGISTRATION
        $this->NO_REGISTRATION->setDbValueDef($rsnew, $this->NO_REGISTRATION->CurrentValue, "", false);

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->setDbValueDef($rsnew, $this->STATUS_PASIEN_ID->CurrentValue, null, false);

        // RUJUKAN_ID
        $this->RUJUKAN_ID->setDbValueDef($rsnew, $this->RUJUKAN_ID->CurrentValue, null, false);

        // REASON_ID
        $this->REASON_ID->setDbValueDef($rsnew, $this->REASON_ID->CurrentValue, null, false);

        // WAY_ID
        $this->WAY_ID->setDbValueDef($rsnew, $this->WAY_ID->CurrentValue, null, false);

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->setDbValueDef($rsnew, $this->PATIENT_CATEGORY_ID->CurrentValue, null, false);

        // VISIT_DATE
        $this->VISIT_DATE->setDbValueDef($rsnew, UnFormatDateTime($this->VISIT_DATE->CurrentValue, 11), null, false);

        // BOOKED_DATE
        $this->BOOKED_DATE->setDbValueDef($rsnew, UnFormatDateTime($this->BOOKED_DATE->CurrentValue, 11), null, false);

        // ISNEW
        $this->ISNEW->setDbValueDef($rsnew, $this->ISNEW->CurrentValue, null, false);

        // KDPOLI_EKS
        $this->KDPOLI_EKS->setDbValueDef($rsnew, $this->KDPOLI_EKS->CurrentValue, null, strval($this->KDPOLI_EKS->CurrentValue) == "");

        // FOLLOW_UP
        $this->FOLLOW_UP->setDbValueDef($rsnew, $this->FOLLOW_UP->CurrentValue, null, false);

        // PLACE_TYPE
        $this->PLACE_TYPE->setDbValueDef($rsnew, $this->PLACE_TYPE->CurrentValue, null, false);

        // CLINIC_ID
        $this->CLINIC_ID->setDbValueDef($rsnew, $this->CLINIC_ID->CurrentValue, null, false);

        // RESPONTGLPLG_DESC
        $this->RESPONTGLPLG_DESC->setDbValueDef($rsnew, $this->RESPONTGLPLG_DESC->CurrentValue, null, false);

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->setDbValueDef($rsnew, $this->CLINIC_ID_FROM->CurrentValue, null, false);

        // MODIFIED_BY
        $this->MODIFIED_BY->CurrentValue = CurrentUserName();
        $this->MODIFIED_BY->setDbValueDef($rsnew, $this->MODIFIED_BY->CurrentValue, null);

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CurrentValue = CurrentDateTime();
        $this->MODIFIED_DATE->setDbValueDef($rsnew, $this->MODIFIED_DATE->CurrentValue, null);

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CurrentValue = CurrentUserName();
        $this->MODIFIED_FROM->setDbValueDef($rsnew, $this->MODIFIED_FROM->CurrentValue, null);

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->setDbValueDef($rsnew, $this->EMPLOYEE_ID->CurrentValue, null, false);

        // RESPONSIBLE_ID
        $this->RESPONSIBLE_ID->setDbValueDef($rsnew, $this->RESPONSIBLE_ID->CurrentValue, null, false);

        // ISPERTARIF
        $this->ISPERTARIF->setDbValueDef($rsnew, $this->ISPERTARIF->CurrentValue, null, strval($this->ISPERTARIF->CurrentValue) == "");

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->setDbValueDef($rsnew, $this->CLASS_ID_PLAFOND->CurrentValue, null, false);

        // BACKCHARGE
        $this->BACKCHARGE->setDbValueDef($rsnew, $this->BACKCHARGE->CurrentValue, null, false);

        // LOCKED
        $this->LOCKED->setDbValueDef($rsnew, $this->LOCKED->CurrentValue, null, false);

        // tanggal_rujukan
        $this->tanggal_rujukan->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_rujukan->CurrentValue, 17), null, false);

        // ISRJ
        $this->ISRJ->setDbValueDef($rsnew, $this->ISRJ->CurrentValue, null, strval($this->ISRJ->CurrentValue) == "");

        // NORUJUKAN
        $this->NORUJUKAN->setDbValueDef($rsnew, $this->NORUJUKAN->CurrentValue, null, false);

        // CALL_TIMES
        $this->CALL_TIMES->setDbValueDef($rsnew, $this->CALL_TIMES->CurrentValue, null, false);

        // KDDPJP
        $this->KDDPJP->setDbValueDef($rsnew, $this->KDDPJP->CurrentValue, null, false);

        // DESCRIPTION
        $this->DESCRIPTION->setDbValueDef($rsnew, $this->DESCRIPTION->CurrentValue, null, false);

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
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "cv_pasien") {
                $validMaster = true;
                $masterTbl = Container("cv_pasien");
                if (($parm = Get("fk_NO_REGISTRATION", Get("NO_REGISTRATION"))) !== null) {
                    $masterTbl->NO_REGISTRATION->setQueryStringValue($parm);
                    $this->NO_REGISTRATION->setQueryStringValue($masterTbl->NO_REGISTRATION->QueryStringValue);
                    $this->NO_REGISTRATION->setSessionValue($this->NO_REGISTRATION->QueryStringValue);
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
            if ($masterTblVar == "cv_pasien") {
                $validMaster = true;
                $masterTbl = Container("cv_pasien");
                if (($parm = Post("fk_NO_REGISTRATION", Post("NO_REGISTRATION"))) !== null) {
                    $masterTbl->NO_REGISTRATION->setFormValue($parm);
                    $this->NO_REGISTRATION->setFormValue($masterTbl->NO_REGISTRATION->FormValue);
                    $this->NO_REGISTRATION->setSessionValue($this->NO_REGISTRATION->FormValue);
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "cv_pasien") {
                if ($this->NO_REGISTRATION->CurrentValue == "") {
                    $this->NO_REGISTRATION->setSessionValue("");
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PasienVisitationList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
        //$this->KDDPJP->Visible = FALSE;
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
     if ($this->IsInsert()) {
    $url = "https://192.168.1.234/simrs/pendaftaran/PasienVisitationEdit/" . $_SESSION["id"] . "?showmaster=cv_pasien&fk_NO_REGISTRATION=" . $_SESSION["no"];
    }
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
