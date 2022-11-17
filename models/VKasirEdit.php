<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class VKasirEdit extends VKasir
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'V_KASIR';

    // Page object name
    public $PageObjName = "VKasirEdit";

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

        // Table object (V_KASIR)
        if (!isset($GLOBALS["V_KASIR"]) || get_class($GLOBALS["V_KASIR"]) == PROJECT_NAMESPACE . "V_KASIR") {
            $GLOBALS["V_KASIR"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "VKasirView") {
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
    public $FormClassName = "ew-horizontal ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;
    public $DetailPages; // Detail pages object

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
        $this->CETAK->setVisibility();
        $this->ORG_UNIT_CODE->Visible = false;
        $this->NO_REGISTRATION->setVisibility();
        $this->VISIT_ID->Visible = false;
        $this->STATUS_PASIEN_ID->setVisibility();
        $this->RUJUKAN_ID->setVisibility();
        $this->ADDRESS_OF_RUJUKAN->Visible = false;
        $this->REASON_ID->setVisibility();
        $this->WAY_ID->setVisibility();
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
        $this->EMPLOYEE_ID->Visible = false;
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
        $this->PASIEN_ID->Visible = false;
        $this->KARYAWAN->Visible = false;
        $this->ACCOUNT_ID->Visible = false;
        $this->CLASS_ID_PLAFOND->Visible = false;
        $this->BACKCHARGE->Visible = false;
        $this->COVERAGE_ID->setVisibility();
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
        $this->NO_SKP->setVisibility();
        $this->NO_SKPINAP->setVisibility();
        $this->DIAGNOSA_ID->setVisibility();
        $this->ticket_all->Visible = false;
        $this->tanggal_rujukan->Visible = false;
        $this->ISRJ->Visible = false;
        $this->NORUJUKAN->setVisibility();
        $this->PPKRUJUKAN->setVisibility();
        $this->LOKASILAKA->Visible = false;
        $this->KDPOLI->Visible = false;
        $this->EDIT_SEP->setVisibility();
        $this->DELETE_SEP->Visible = false;
        $this->KODE_AGAMA->Visible = false;
        $this->DIAG_AWAL->setVisibility();
        $this->AKTIF->Visible = false;
        $this->BILL_INAP->Visible = false;
        $this->SEP_PRINTDATE->Visible = false;
        $this->MAPPING_SEP->Visible = false;
        $this->TRANS_ID->Visible = false;
        $this->KDPOLI_EKS->Visible = false;
        $this->COB->setVisibility();
        $this->PENJAMIN->Visible = false;
        $this->ASALRUJUKAN->setVisibility();
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

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Set up detail page object
        $this->setupDetailPages();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
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

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("IDXDAFTAR") ?? Key(0) ?? Route(2)) !== null) {
                $this->IDXDAFTAR->setQueryStringValue($keyValue);
                $this->IDXDAFTAR->setOldValue($this->IDXDAFTAR->QueryStringValue);
            } elseif (Post("IDXDAFTAR") !== null) {
                $this->IDXDAFTAR->setFormValue(Post("IDXDAFTAR"));
                $this->IDXDAFTAR->setOldValue($this->IDXDAFTAR->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("IDXDAFTAR") ?? Route("IDXDAFTAR")) !== null) {
                    $this->IDXDAFTAR->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->IDXDAFTAR->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values

            // Set up detail parameters
            $this->setupDetailParms();
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("VKasirList"); // No matching record, return to list
                    return;
                }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "update": // Update
                $returnUrl = 'PasienVisitationView/'.urlencode(CurrentPage()->IDXDAFTAR->CurrentValue);
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed

                    // Set up detail parameters
                    $this->setupDetailParms();
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'CETAK' first before field var 'x_CETAK'
        $val = $CurrentForm->hasValue("CETAK") ? $CurrentForm->getValue("CETAK") : $CurrentForm->getValue("x_CETAK");
        if (!$this->CETAK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CETAK->Visible = false; // Disable update for API request
            } else {
                $this->CETAK->setFormValue($val);
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

        // Check field name 'VISIT_DATE' first before field var 'x_VISIT_DATE'
        $val = $CurrentForm->hasValue("VISIT_DATE") ? $CurrentForm->getValue("VISIT_DATE") : $CurrentForm->getValue("x_VISIT_DATE");
        if (!$this->VISIT_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->VISIT_DATE->Visible = false; // Disable update for API request
            } else {
                $this->VISIT_DATE->setFormValue($val);
            }
            $this->VISIT_DATE->CurrentValue = UnFormatDateTime($this->VISIT_DATE->CurrentValue, 0);
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

        // Check field name 'GENDER' first before field var 'x_GENDER'
        $val = $CurrentForm->hasValue("GENDER") ? $CurrentForm->getValue("GENDER") : $CurrentForm->getValue("x_GENDER");
        if (!$this->GENDER->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->GENDER->Visible = false; // Disable update for API request
            } else {
                $this->GENDER->setFormValue($val);
            }
        }

        // Check field name 'PAYOR_ID' first before field var 'x_PAYOR_ID'
        $val = $CurrentForm->hasValue("PAYOR_ID") ? $CurrentForm->getValue("PAYOR_ID") : $CurrentForm->getValue("x_PAYOR_ID");
        if (!$this->PAYOR_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PAYOR_ID->Visible = false; // Disable update for API request
            } else {
                $this->PAYOR_ID->setFormValue($val);
            }
        }

        // Check field name 'CLASS_ID' first before field var 'x_CLASS_ID'
        $val = $CurrentForm->hasValue("CLASS_ID") ? $CurrentForm->getValue("CLASS_ID") : $CurrentForm->getValue("x_CLASS_ID");
        if (!$this->CLASS_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLASS_ID->Visible = false; // Disable update for API request
            } else {
                $this->CLASS_ID->setFormValue($val);
            }
        }

        // Check field name 'COVERAGE_ID' first before field var 'x_COVERAGE_ID'
        $val = $CurrentForm->hasValue("COVERAGE_ID") ? $CurrentForm->getValue("COVERAGE_ID") : $CurrentForm->getValue("x_COVERAGE_ID");
        if (!$this->COVERAGE_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->COVERAGE_ID->Visible = false; // Disable update for API request
            } else {
                $this->COVERAGE_ID->setFormValue($val);
            }
        }

        // Check field name 'NO_SKP' first before field var 'x_NO_SKP'
        $val = $CurrentForm->hasValue("NO_SKP") ? $CurrentForm->getValue("NO_SKP") : $CurrentForm->getValue("x_NO_SKP");
        if (!$this->NO_SKP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_SKP->Visible = false; // Disable update for API request
            } else {
                $this->NO_SKP->setFormValue($val);
            }
        }

        // Check field name 'NO_SKPINAP' first before field var 'x_NO_SKPINAP'
        $val = $CurrentForm->hasValue("NO_SKPINAP") ? $CurrentForm->getValue("NO_SKPINAP") : $CurrentForm->getValue("x_NO_SKPINAP");
        if (!$this->NO_SKPINAP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_SKPINAP->Visible = false; // Disable update for API request
            } else {
                $this->NO_SKPINAP->setFormValue($val);
            }
        }

        // Check field name 'DIAGNOSA_ID' first before field var 'x_DIAGNOSA_ID'
        $val = $CurrentForm->hasValue("DIAGNOSA_ID") ? $CurrentForm->getValue("DIAGNOSA_ID") : $CurrentForm->getValue("x_DIAGNOSA_ID");
        if (!$this->DIAGNOSA_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAGNOSA_ID->Visible = false; // Disable update for API request
            } else {
                $this->DIAGNOSA_ID->setFormValue($val);
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

        // Check field name 'PPKRUJUKAN' first before field var 'x_PPKRUJUKAN'
        $val = $CurrentForm->hasValue("PPKRUJUKAN") ? $CurrentForm->getValue("PPKRUJUKAN") : $CurrentForm->getValue("x_PPKRUJUKAN");
        if (!$this->PPKRUJUKAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PPKRUJUKAN->Visible = false; // Disable update for API request
            } else {
                $this->PPKRUJUKAN->setFormValue($val);
            }
        }

        // Check field name 'EDIT_SEP' first before field var 'x_EDIT_SEP'
        $val = $CurrentForm->hasValue("EDIT_SEP") ? $CurrentForm->getValue("EDIT_SEP") : $CurrentForm->getValue("x_EDIT_SEP");
        if (!$this->EDIT_SEP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->EDIT_SEP->Visible = false; // Disable update for API request
            } else {
                $this->EDIT_SEP->setFormValue($val);
            }
        }

        // Check field name 'DIAG_AWAL' first before field var 'x_DIAG_AWAL'
        $val = $CurrentForm->hasValue("DIAG_AWAL") ? $CurrentForm->getValue("DIAG_AWAL") : $CurrentForm->getValue("x_DIAG_AWAL");
        if (!$this->DIAG_AWAL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DIAG_AWAL->Visible = false; // Disable update for API request
            } else {
                $this->DIAG_AWAL->setFormValue($val);
            }
        }

        // Check field name 'COB' first before field var 'x_COB'
        $val = $CurrentForm->hasValue("COB") ? $CurrentForm->getValue("COB") : $CurrentForm->getValue("x_COB");
        if (!$this->COB->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->COB->Visible = false; // Disable update for API request
            } else {
                $this->COB->setFormValue($val);
            }
        }

        // Check field name 'ASALRUJUKAN' first before field var 'x_ASALRUJUKAN'
        $val = $CurrentForm->hasValue("ASALRUJUKAN") ? $CurrentForm->getValue("ASALRUJUKAN") : $CurrentForm->getValue("x_ASALRUJUKAN");
        if (!$this->ASALRUJUKAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ASALRUJUKAN->Visible = false; // Disable update for API request
            } else {
                $this->ASALRUJUKAN->setFormValue($val);
            }
        }

        // Check field name 'tgl_kontrol' first before field var 'x_tgl_kontrol'
        $val = $CurrentForm->hasValue("tgl_kontrol") ? $CurrentForm->getValue("tgl_kontrol") : $CurrentForm->getValue("x_tgl_kontrol");
        if (!$this->tgl_kontrol->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_kontrol->Visible = false; // Disable update for API request
            } else {
                $this->tgl_kontrol->setFormValue($val);
            }
            $this->tgl_kontrol->CurrentValue = UnFormatDateTime($this->tgl_kontrol->CurrentValue, 0);
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
        if (!$this->IDXDAFTAR->IsDetailKey) {
            $this->IDXDAFTAR->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->IDXDAFTAR->CurrentValue = $this->IDXDAFTAR->FormValue;
        $this->CETAK->CurrentValue = $this->CETAK->FormValue;
        $this->NO_REGISTRATION->CurrentValue = $this->NO_REGISTRATION->FormValue;
        $this->STATUS_PASIEN_ID->CurrentValue = $this->STATUS_PASIEN_ID->FormValue;
        $this->RUJUKAN_ID->CurrentValue = $this->RUJUKAN_ID->FormValue;
        $this->REASON_ID->CurrentValue = $this->REASON_ID->FormValue;
        $this->WAY_ID->CurrentValue = $this->WAY_ID->FormValue;
        $this->VISIT_DATE->CurrentValue = $this->VISIT_DATE->FormValue;
        $this->VISIT_DATE->CurrentValue = UnFormatDateTime($this->VISIT_DATE->CurrentValue, 0);
        $this->CLINIC_ID->CurrentValue = $this->CLINIC_ID->FormValue;
        $this->GENDER->CurrentValue = $this->GENDER->FormValue;
        $this->PAYOR_ID->CurrentValue = $this->PAYOR_ID->FormValue;
        $this->CLASS_ID->CurrentValue = $this->CLASS_ID->FormValue;
        $this->COVERAGE_ID->CurrentValue = $this->COVERAGE_ID->FormValue;
        $this->NO_SKP->CurrentValue = $this->NO_SKP->FormValue;
        $this->NO_SKPINAP->CurrentValue = $this->NO_SKPINAP->FormValue;
        $this->DIAGNOSA_ID->CurrentValue = $this->DIAGNOSA_ID->FormValue;
        $this->NORUJUKAN->CurrentValue = $this->NORUJUKAN->FormValue;
        $this->PPKRUJUKAN->CurrentValue = $this->PPKRUJUKAN->FormValue;
        $this->EDIT_SEP->CurrentValue = $this->EDIT_SEP->FormValue;
        $this->DIAG_AWAL->CurrentValue = $this->DIAG_AWAL->FormValue;
        $this->COB->CurrentValue = $this->COB->FormValue;
        $this->ASALRUJUKAN->CurrentValue = $this->ASALRUJUKAN->FormValue;
        $this->tgl_kontrol->CurrentValue = $this->tgl_kontrol->FormValue;
        $this->tgl_kontrol->CurrentValue = UnFormatDateTime($this->tgl_kontrol->CurrentValue, 0);
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // CETAK

        // ORG_UNIT_CODE

        // NO_REGISTRATION

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

        // CLINIC_ID

        // CLINIC_ID_FROM

        // CLASS_ROOM_ID

        // BED_ID

        // KELUAR_ID

        // IN_DATE

        // EXIT_DATE

        // DIANTAR_OLEH

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

        // TICKET_NO

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

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";
            $this->PAYOR_ID->TooltipValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";
            $this->CLASS_ID->TooltipValue = "";

            // COVERAGE_ID
            $this->COVERAGE_ID->LinkCustomAttributes = "";
            $this->COVERAGE_ID->HrefValue = "";
            $this->COVERAGE_ID->TooltipValue = "";

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

            // NORUJUKAN
            $this->NORUJUKAN->LinkCustomAttributes = "";
            $this->NORUJUKAN->HrefValue = "";
            $this->NORUJUKAN->TooltipValue = "";

            // PPKRUJUKAN
            $this->PPKRUJUKAN->LinkCustomAttributes = "";
            $this->PPKRUJUKAN->HrefValue = "";
            $this->PPKRUJUKAN->TooltipValue = "";

            // EDIT_SEP
            $this->EDIT_SEP->LinkCustomAttributes = "";
            $this->EDIT_SEP->HrefValue = "";
            $this->EDIT_SEP->TooltipValue = "";

            // DIAG_AWAL
            $this->DIAG_AWAL->LinkCustomAttributes = "";
            $this->DIAG_AWAL->HrefValue = "";
            $this->DIAG_AWAL->TooltipValue = "";

            // COB
            $this->COB->LinkCustomAttributes = "";
            $this->COB->HrefValue = "";
            $this->COB->TooltipValue = "";

            // ASALRUJUKAN
            $this->ASALRUJUKAN->LinkCustomAttributes = "";
            $this->ASALRUJUKAN->HrefValue = "";
            $this->ASALRUJUKAN->TooltipValue = "";

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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // CETAK
            $this->CETAK->EditAttrs["class"] = "form-control";
            $this->CETAK->EditCustomAttributes = "";
            if (!$this->CETAK->Raw) {
                $this->CETAK->CurrentValue = HtmlDecode($this->CETAK->CurrentValue);
            }
            $this->CETAK->EditValue = HtmlEncode($this->CETAK->CurrentValue);
            $this->CETAK->PlaceHolder = RemoveHtml($this->CETAK->caption());

            // NO_REGISTRATION
            $this->NO_REGISTRATION->EditCustomAttributes = "";
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
                foreach ($arwrk as &$row)
                    $row = $this->NO_REGISTRATION->Lookup->renderViewRow($row);
                $this->NO_REGISTRATION->EditValue = $arwrk;
            }
            $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

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
            $curVal = trim(strval($this->RUJUKAN_ID->CurrentValue));
            if ($curVal != "") {
                $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->lookupCacheOption($curVal);
            } else {
                $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->Lookup !== null && is_array($this->RUJUKAN_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->RUJUKAN_ID->ViewValue !== null) { // Load from cache
                $this->RUJUKAN_ID->EditValue = array_values($this->RUJUKAN_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[RUJUKAN_ID]" . SearchString("=", $this->RUJUKAN_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->RUJUKAN_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->RUJUKAN_ID->EditValue = $arwrk;
            }
            $this->RUJUKAN_ID->PlaceHolder = RemoveHtml($this->RUJUKAN_ID->caption());

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

            // VISIT_DATE

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

            // GENDER
            $this->GENDER->EditAttrs["class"] = "form-control";
            $this->GENDER->EditCustomAttributes = "";
            $curVal = trim(strval($this->GENDER->CurrentValue));
            if ($curVal != "") {
                $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
            } else {
                $this->GENDER->ViewValue = $this->GENDER->Lookup !== null && is_array($this->GENDER->Lookup->Options) ? $curVal : null;
            }
            if ($this->GENDER->ViewValue !== null) { // Load from cache
                $this->GENDER->EditValue = array_values($this->GENDER->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[GENDER]" . SearchString("=", $this->GENDER->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->GENDER->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->GENDER->EditValue = $arwrk;
            }
            $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

            // PAYOR_ID
            $this->PAYOR_ID->EditAttrs["class"] = "form-control";
            $this->PAYOR_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->PAYOR_ID->CurrentValue));
            if ($curVal != "") {
                $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->lookupCacheOption($curVal);
            } else {
                $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->Lookup !== null && is_array($this->PAYOR_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->PAYOR_ID->ViewValue !== null) { // Load from cache
                $this->PAYOR_ID->EditValue = array_values($this->PAYOR_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[PAYOR_ID]" . SearchString("=", $this->PAYOR_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->PAYOR_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->PAYOR_ID->EditValue = $arwrk;
            }
            $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

            // CLASS_ID
            $this->CLASS_ID->EditAttrs["class"] = "form-control";
            $this->CLASS_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLASS_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ID->ViewValue = $this->CLASS_ID->lookupCacheOption($curVal);
            } else {
                $this->CLASS_ID->ViewValue = $this->CLASS_ID->Lookup !== null && is_array($this->CLASS_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLASS_ID->ViewValue !== null) { // Load from cache
                $this->CLASS_ID->EditValue = array_values($this->CLASS_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLASS_ID]" . SearchString("=", $this->CLASS_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->CLASS_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLASS_ID->EditValue = $arwrk;
            }
            $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

            // COVERAGE_ID
            $this->COVERAGE_ID->EditAttrs["class"] = "form-control";
            $this->COVERAGE_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->COVERAGE_ID->CurrentValue));
            if ($curVal != "") {
                $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->lookupCacheOption($curVal);
            } else {
                $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->Lookup !== null && is_array($this->COVERAGE_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->COVERAGE_ID->ViewValue !== null) { // Load from cache
                $this->COVERAGE_ID->EditValue = array_values($this->COVERAGE_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[COVERAGE_ID]" . SearchString("=", $this->COVERAGE_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->COVERAGE_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->COVERAGE_ID->EditValue = $arwrk;
            }
            $this->COVERAGE_ID->PlaceHolder = RemoveHtml($this->COVERAGE_ID->caption());

            // NO_SKP
            $this->NO_SKP->EditAttrs["class"] = "form-control";
            $this->NO_SKP->EditCustomAttributes = "";
            $this->NO_SKP->EditValue = $this->NO_SKP->CurrentValue;
            $this->NO_SKP->ViewCustomAttributes = "";

            // NO_SKPINAP
            $this->NO_SKPINAP->EditAttrs["class"] = "form-control";
            $this->NO_SKPINAP->EditCustomAttributes = "";
            $this->NO_SKPINAP->EditValue = $this->NO_SKPINAP->CurrentValue;
            $this->NO_SKPINAP->ViewCustomAttributes = "";

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->DIAGNOSA_ID->CurrentValue));
            if ($curVal != "") {
                $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->lookupCacheOption($curVal);
            } else {
                $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->Lookup !== null && is_array($this->DIAGNOSA_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->DIAGNOSA_ID->ViewValue !== null) { // Load from cache
                $this->DIAGNOSA_ID->EditValue = array_values($this->DIAGNOSA_ID->Lookup->Options);
                if ($this->DIAGNOSA_ID->ViewValue == "") {
                    $this->DIAGNOSA_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $this->DIAGNOSA_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->DIAGNOSA_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->DIAGNOSA_ID->EditValue = $arwrk;
            }
            $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

            // NORUJUKAN
            $this->NORUJUKAN->EditAttrs["class"] = "form-control";
            $this->NORUJUKAN->EditCustomAttributes = "";
            $this->NORUJUKAN->EditValue = $this->NORUJUKAN->CurrentValue;
            $this->NORUJUKAN->ViewCustomAttributes = "";

            // PPKRUJUKAN
            $this->PPKRUJUKAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->PPKRUJUKAN->CurrentValue));
            if ($curVal != "") {
                $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->lookupCacheOption($curVal);
            } else {
                $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->Lookup !== null && is_array($this->PPKRUJUKAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->PPKRUJUKAN->ViewValue !== null) { // Load from cache
                $this->PPKRUJUKAN->EditValue = array_values($this->PPKRUJUKAN->Lookup->Options);
                if ($this->PPKRUJUKAN->ViewValue == "") {
                    $this->PPKRUJUKAN->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[KDPROVIDER]" . SearchString("=", $this->PPKRUJUKAN->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->PPKRUJUKAN->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->PPKRUJUKAN->Lookup->renderViewRow($rswrk[0]);
                    $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->displayValue($arwrk);
                } else {
                    $this->PPKRUJUKAN->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->PPKRUJUKAN->EditValue = $arwrk;
            }
            $this->PPKRUJUKAN->PlaceHolder = RemoveHtml($this->PPKRUJUKAN->caption());

            // EDIT_SEP
            $this->EDIT_SEP->EditAttrs["class"] = "form-control";
            $this->EDIT_SEP->EditCustomAttributes = "";
            $this->EDIT_SEP->EditValue = $this->EDIT_SEP->CurrentValue;
            $this->EDIT_SEP->ViewCustomAttributes = "";

            // DIAG_AWAL
            $this->DIAG_AWAL->EditAttrs["class"] = "form-control";
            $this->DIAG_AWAL->EditCustomAttributes = "";
            if (!$this->DIAG_AWAL->Raw) {
                $this->DIAG_AWAL->CurrentValue = HtmlDecode($this->DIAG_AWAL->CurrentValue);
            }
            $this->DIAG_AWAL->EditValue = HtmlEncode($this->DIAG_AWAL->CurrentValue);
            $this->DIAG_AWAL->PlaceHolder = RemoveHtml($this->DIAG_AWAL->caption());

            // COB
            $this->COB->EditCustomAttributes = "";
            $this->COB->EditValue = $this->COB->options(false);
            $this->COB->PlaceHolder = RemoveHtml($this->COB->caption());

            // ASALRUJUKAN
            $this->ASALRUJUKAN->EditAttrs["class"] = "form-control";
            $this->ASALRUJUKAN->EditCustomAttributes = "";
            if (!$this->ASALRUJUKAN->Raw) {
                $this->ASALRUJUKAN->CurrentValue = HtmlDecode($this->ASALRUJUKAN->CurrentValue);
            }
            $this->ASALRUJUKAN->EditValue = HtmlEncode($this->ASALRUJUKAN->CurrentValue);
            $this->ASALRUJUKAN->PlaceHolder = RemoveHtml($this->ASALRUJUKAN->caption());

            // tgl_kontrol
            $this->tgl_kontrol->EditAttrs["class"] = "form-control";
            $this->tgl_kontrol->EditCustomAttributes = "";
            $this->tgl_kontrol->EditValue = HtmlEncode(FormatDateTime($this->tgl_kontrol->CurrentValue, 8));
            $this->tgl_kontrol->PlaceHolder = RemoveHtml($this->tgl_kontrol->caption());

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

            // Edit refer script

            // CETAK
            $this->CETAK->LinkCustomAttributes = "";
            $this->CETAK->HrefValue = "";

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

            // VISIT_DATE
            $this->VISIT_DATE->LinkCustomAttributes = "";
            $this->VISIT_DATE->HrefValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";

            // CLASS_ID
            $this->CLASS_ID->LinkCustomAttributes = "";
            $this->CLASS_ID->HrefValue = "";

            // COVERAGE_ID
            $this->COVERAGE_ID->LinkCustomAttributes = "";
            $this->COVERAGE_ID->HrefValue = "";

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

            // NORUJUKAN
            $this->NORUJUKAN->LinkCustomAttributes = "";
            $this->NORUJUKAN->HrefValue = "";
            $this->NORUJUKAN->TooltipValue = "";

            // PPKRUJUKAN
            $this->PPKRUJUKAN->LinkCustomAttributes = "";
            $this->PPKRUJUKAN->HrefValue = "";

            // EDIT_SEP
            $this->EDIT_SEP->LinkCustomAttributes = "";
            $this->EDIT_SEP->HrefValue = "";
            $this->EDIT_SEP->TooltipValue = "";

            // DIAG_AWAL
            $this->DIAG_AWAL->LinkCustomAttributes = "";
            $this->DIAG_AWAL->HrefValue = "";

            // COB
            $this->COB->LinkCustomAttributes = "";
            $this->COB->HrefValue = "";

            // ASALRUJUKAN
            $this->ASALRUJUKAN->LinkCustomAttributes = "";
            $this->ASALRUJUKAN->HrefValue = "";

            // tgl_kontrol
            $this->tgl_kontrol->LinkCustomAttributes = "";
            $this->tgl_kontrol->HrefValue = "";

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
        if ($this->CETAK->Required) {
            if (!$this->CETAK->IsDetailKey && EmptyValue($this->CETAK->FormValue)) {
                $this->CETAK->addErrorMessage(str_replace("%s", $this->CETAK->caption(), $this->CETAK->RequiredErrorMessage));
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
        if ($this->VISIT_DATE->Required) {
            if (!$this->VISIT_DATE->IsDetailKey && EmptyValue($this->VISIT_DATE->FormValue)) {
                $this->VISIT_DATE->addErrorMessage(str_replace("%s", $this->VISIT_DATE->caption(), $this->VISIT_DATE->RequiredErrorMessage));
            }
        }
        if ($this->CLINIC_ID->Required) {
            if (!$this->CLINIC_ID->IsDetailKey && EmptyValue($this->CLINIC_ID->FormValue)) {
                $this->CLINIC_ID->addErrorMessage(str_replace("%s", $this->CLINIC_ID->caption(), $this->CLINIC_ID->RequiredErrorMessage));
            }
        }
        if ($this->GENDER->Required) {
            if (!$this->GENDER->IsDetailKey && EmptyValue($this->GENDER->FormValue)) {
                $this->GENDER->addErrorMessage(str_replace("%s", $this->GENDER->caption(), $this->GENDER->RequiredErrorMessage));
            }
        }
        if ($this->PAYOR_ID->Required) {
            if (!$this->PAYOR_ID->IsDetailKey && EmptyValue($this->PAYOR_ID->FormValue)) {
                $this->PAYOR_ID->addErrorMessage(str_replace("%s", $this->PAYOR_ID->caption(), $this->PAYOR_ID->RequiredErrorMessage));
            }
        }
        if ($this->CLASS_ID->Required) {
            if (!$this->CLASS_ID->IsDetailKey && EmptyValue($this->CLASS_ID->FormValue)) {
                $this->CLASS_ID->addErrorMessage(str_replace("%s", $this->CLASS_ID->caption(), $this->CLASS_ID->RequiredErrorMessage));
            }
        }
        if ($this->COVERAGE_ID->Required) {
            if (!$this->COVERAGE_ID->IsDetailKey && EmptyValue($this->COVERAGE_ID->FormValue)) {
                $this->COVERAGE_ID->addErrorMessage(str_replace("%s", $this->COVERAGE_ID->caption(), $this->COVERAGE_ID->RequiredErrorMessage));
            }
        }
        if ($this->NO_SKP->Required) {
            if (!$this->NO_SKP->IsDetailKey && EmptyValue($this->NO_SKP->FormValue)) {
                $this->NO_SKP->addErrorMessage(str_replace("%s", $this->NO_SKP->caption(), $this->NO_SKP->RequiredErrorMessage));
            }
        }
        if ($this->NO_SKPINAP->Required) {
            if (!$this->NO_SKPINAP->IsDetailKey && EmptyValue($this->NO_SKPINAP->FormValue)) {
                $this->NO_SKPINAP->addErrorMessage(str_replace("%s", $this->NO_SKPINAP->caption(), $this->NO_SKPINAP->RequiredErrorMessage));
            }
        }
        if ($this->DIAGNOSA_ID->Required) {
            if (!$this->DIAGNOSA_ID->IsDetailKey && EmptyValue($this->DIAGNOSA_ID->FormValue)) {
                $this->DIAGNOSA_ID->addErrorMessage(str_replace("%s", $this->DIAGNOSA_ID->caption(), $this->DIAGNOSA_ID->RequiredErrorMessage));
            }
        }
        if ($this->NORUJUKAN->Required) {
            if (!$this->NORUJUKAN->IsDetailKey && EmptyValue($this->NORUJUKAN->FormValue)) {
                $this->NORUJUKAN->addErrorMessage(str_replace("%s", $this->NORUJUKAN->caption(), $this->NORUJUKAN->RequiredErrorMessage));
            }
        }
        if ($this->PPKRUJUKAN->Required) {
            if (!$this->PPKRUJUKAN->IsDetailKey && EmptyValue($this->PPKRUJUKAN->FormValue)) {
                $this->PPKRUJUKAN->addErrorMessage(str_replace("%s", $this->PPKRUJUKAN->caption(), $this->PPKRUJUKAN->RequiredErrorMessage));
            }
        }
        if ($this->EDIT_SEP->Required) {
            if (!$this->EDIT_SEP->IsDetailKey && EmptyValue($this->EDIT_SEP->FormValue)) {
                $this->EDIT_SEP->addErrorMessage(str_replace("%s", $this->EDIT_SEP->caption(), $this->EDIT_SEP->RequiredErrorMessage));
            }
        }
        if ($this->DIAG_AWAL->Required) {
            if (!$this->DIAG_AWAL->IsDetailKey && EmptyValue($this->DIAG_AWAL->FormValue)) {
                $this->DIAG_AWAL->addErrorMessage(str_replace("%s", $this->DIAG_AWAL->caption(), $this->DIAG_AWAL->RequiredErrorMessage));
            }
        }
        if ($this->COB->Required) {
            if ($this->COB->FormValue == "") {
                $this->COB->addErrorMessage(str_replace("%s", $this->COB->caption(), $this->COB->RequiredErrorMessage));
            }
        }
        if ($this->ASALRUJUKAN->Required) {
            if (!$this->ASALRUJUKAN->IsDetailKey && EmptyValue($this->ASALRUJUKAN->FormValue)) {
                $this->ASALRUJUKAN->addErrorMessage(str_replace("%s", $this->ASALRUJUKAN->caption(), $this->ASALRUJUKAN->RequiredErrorMessage));
            }
        }
        if ($this->tgl_kontrol->Required) {
            if (!$this->tgl_kontrol->IsDetailKey && EmptyValue($this->tgl_kontrol->FormValue)) {
                $this->tgl_kontrol->addErrorMessage(str_replace("%s", $this->tgl_kontrol->caption(), $this->tgl_kontrol->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_kontrol->FormValue)) {
            $this->tgl_kontrol->addErrorMessage($this->tgl_kontrol->getErrorMessage(false));
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

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("TreatmentAkomodasiGrid");
        if (in_array("TREATMENT_AKOMODASI", $detailTblVar) && $detailPage->DetailEdit) {
            $detailPage->validateGridForm();
        }
        $detailPage = Container("TreatmentBillGrid");
        if (in_array("TREATMENT_BILL", $detailTblVar) && $detailPage->DetailEdit) {
            $detailPage->validateGridForm();
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
            // Begin transaction
            if ($this->getCurrentDetailTable() != "") {
                $conn->beginTransaction();
            }

            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // CETAK
            $this->CETAK->setDbValueDef($rsnew, $this->CETAK->CurrentValue, "", $this->CETAK->ReadOnly);

            // NO_REGISTRATION
            $this->NO_REGISTRATION->setDbValueDef($rsnew, $this->NO_REGISTRATION->CurrentValue, "", $this->NO_REGISTRATION->ReadOnly);

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->setDbValueDef($rsnew, $this->STATUS_PASIEN_ID->CurrentValue, null, $this->STATUS_PASIEN_ID->ReadOnly);

            // RUJUKAN_ID
            $this->RUJUKAN_ID->setDbValueDef($rsnew, $this->RUJUKAN_ID->CurrentValue, null, $this->RUJUKAN_ID->ReadOnly);

            // REASON_ID
            $this->REASON_ID->setDbValueDef($rsnew, $this->REASON_ID->CurrentValue, null, $this->REASON_ID->ReadOnly);

            // WAY_ID
            $this->WAY_ID->setDbValueDef($rsnew, $this->WAY_ID->CurrentValue, null, $this->WAY_ID->ReadOnly);

            // VISIT_DATE
            $this->VISIT_DATE->CurrentValue = CurrentDateTime();
            $this->VISIT_DATE->setDbValueDef($rsnew, $this->VISIT_DATE->CurrentValue, null);

            // CLINIC_ID
            $this->CLINIC_ID->setDbValueDef($rsnew, $this->CLINIC_ID->CurrentValue, null, $this->CLINIC_ID->ReadOnly);

            // GENDER
            $this->GENDER->setDbValueDef($rsnew, $this->GENDER->CurrentValue, null, $this->GENDER->ReadOnly);

            // PAYOR_ID
            $this->PAYOR_ID->setDbValueDef($rsnew, $this->PAYOR_ID->CurrentValue, null, $this->PAYOR_ID->ReadOnly);

            // CLASS_ID
            $this->CLASS_ID->setDbValueDef($rsnew, $this->CLASS_ID->CurrentValue, null, $this->CLASS_ID->ReadOnly);

            // COVERAGE_ID
            $this->COVERAGE_ID->setDbValueDef($rsnew, $this->COVERAGE_ID->CurrentValue, null, $this->COVERAGE_ID->ReadOnly);

            // DIAGNOSA_ID
            $this->DIAGNOSA_ID->setDbValueDef($rsnew, $this->DIAGNOSA_ID->CurrentValue, null, $this->DIAGNOSA_ID->ReadOnly);

            // PPKRUJUKAN
            $this->PPKRUJUKAN->setDbValueDef($rsnew, $this->PPKRUJUKAN->CurrentValue, null, $this->PPKRUJUKAN->ReadOnly);

            // DIAG_AWAL
            $this->DIAG_AWAL->setDbValueDef($rsnew, $this->DIAG_AWAL->CurrentValue, null, $this->DIAG_AWAL->ReadOnly);

            // COB
            $this->COB->setDbValueDef($rsnew, $this->COB->CurrentValue, null, $this->COB->ReadOnly);

            // ASALRUJUKAN
            $this->ASALRUJUKAN->setDbValueDef($rsnew, $this->ASALRUJUKAN->CurrentValue, null, $this->ASALRUJUKAN->ReadOnly);

            // tgl_kontrol
            $this->tgl_kontrol->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_kontrol->CurrentValue, 0), null, $this->tgl_kontrol->ReadOnly);

            // idbooking
            $this->idbooking->setDbValueDef($rsnew, $this->idbooking->CurrentValue, null, $this->idbooking->ReadOnly);

            // id_tujuan
            $this->id_tujuan->setDbValueDef($rsnew, $this->id_tujuan->CurrentValue, null, $this->id_tujuan->ReadOnly);

            // id_penunjang
            $this->id_penunjang->setDbValueDef($rsnew, $this->id_penunjang->CurrentValue, null, $this->id_penunjang->ReadOnly);

            // id_pembiayaan
            $this->id_pembiayaan->setDbValueDef($rsnew, $this->id_pembiayaan->CurrentValue, null, $this->id_pembiayaan->ReadOnly);

            // id_procedure
            $this->id_procedure->setDbValueDef($rsnew, $this->id_procedure->CurrentValue, null, $this->id_procedure->ReadOnly);

            // id_aspel
            $this->id_aspel->setDbValueDef($rsnew, $this->id_aspel->CurrentValue, null, $this->id_aspel->ReadOnly);

            // id_kelas
            $this->id_kelas->setDbValueDef($rsnew, $this->id_kelas->CurrentValue, null, $this->id_kelas->ReadOnly);

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

                // Update detail records
                $detailTblVar = explode(",", $this->getCurrentDetailTable());
                if ($editRow) {
                    $detailPage = Container("TreatmentAkomodasiGrid");
                    if (in_array("TREATMENT_AKOMODASI", $detailTblVar) && $detailPage->DetailEdit) {
                        $Security->loadCurrentUserLevel($this->ProjectID . "TREATMENT_AKOMODASI"); // Load user level of detail table
                        $editRow = $detailPage->gridUpdate();
                        $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                    }
                }
                if ($editRow) {
                    $detailPage = Container("TreatmentBillGrid");
                    if (in_array("TREATMENT_BILL", $detailTblVar) && $detailPage->DetailEdit) {
                        $Security->loadCurrentUserLevel($this->ProjectID . "TREATMENT_BILL"); // Load user level of detail table
                        $editRow = $detailPage->gridUpdate();
                        $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                    }
                }

                // Commit/Rollback transaction
                if ($this->getCurrentDetailTable() != "") {
                    if ($editRow) {
                        $conn->commit(); // Commit transaction
                    } else {
                        $conn->rollback(); // Rollback transaction
                    }
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

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("TREATMENT_AKOMODASI", $detailTblVar)) {
                $detailPageObj = Container("TreatmentAkomodasiGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->VISIT_ID->IsDetailKey = true;
                    $detailPageObj->VISIT_ID->CurrentValue = $this->VISIT_ID->CurrentValue;
                    $detailPageObj->VISIT_ID->setSessionValue($detailPageObj->VISIT_ID->CurrentValue);
                    $detailPageObj->BILL_ID->setSessionValue(""); // Clear session key
                }
            }
            if (in_array("TREATMENT_BILL", $detailTblVar)) {
                $detailPageObj = Container("TreatmentBillGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->VISIT_ID->IsDetailKey = true;
                    $detailPageObj->VISIT_ID->CurrentValue = $this->VISIT_ID->CurrentValue;
                    $detailPageObj->VISIT_ID->setSessionValue($detailPageObj->VISIT_ID->CurrentValue);
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("VKasirList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Set up detail pages
    protected function setupDetailPages()
    {
        $pages = new SubPages();
        $pages->Style = "tabs";
        $pages->add('TREATMENT_AKOMODASI');
        $pages->add('TREATMENT_BILL');
        $this->DetailPages = $pages;
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
}
