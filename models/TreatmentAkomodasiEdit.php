<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TreatmentAkomodasiEdit extends TreatmentAkomodasi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'TREATMENT_AKOMODASI';

    // Page object name
    public $PageObjName = "TreatmentAkomodasiEdit";

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

        // Table object (TREATMENT_AKOMODASI)
        if (!isset($GLOBALS["TREATMENT_AKOMODASI"]) || get_class($GLOBALS["TREATMENT_AKOMODASI"]) == PROJECT_NAMESPACE . "TREATMENT_AKOMODASI") {
            $GLOBALS["TREATMENT_AKOMODASI"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'TREATMENT_AKOMODASI');
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
                $doc = new $class(Container("TREATMENT_AKOMODASI"));
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
                    if ($pageName == "TreatmentAkomodasiView") {
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
        $this->BILL_ID->Visible = false;
        $this->NO_REGISTRATION->Visible = false;
        $this->VISIT_ID->Visible = false;
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
        $this->THENAME->Visible = false;
        $this->THEADDRESS->Visible = false;
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

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->TARIF_ID);
        $this->setupLookupOptions($this->CLINIC_ID);
        $this->setupLookupOptions($this->CLINIC_ID_FROM);
        $this->setupLookupOptions($this->CLASS_ROOM_ID);
        $this->setupLookupOptions($this->KELUAR_ID);
        $this->setupLookupOptions($this->BED_ID);
        $this->setupLookupOptions($this->EMPLOYEE_ID);

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
            if (($keyValue = Get("ID") ?? Key(0) ?? Route(2)) !== null) {
                $this->ID->setQueryStringValue($keyValue);
                $this->ID->setOldValue($this->ID->QueryStringValue);
            } elseif (Post("ID") !== null) {
                $this->ID->setFormValue(Post("ID"));
                $this->ID->setOldValue($this->ID->FormValue);
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
                if (($keyValue = Get("ID") ?? Route("ID")) !== null) {
                    $this->ID->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->ID->CurrentValue = null;
                }
            }

            // Set up master detail parameters
            $this->setupMasterParms();

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
                    $this->terminate("TreatmentAkomodasiList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "TreatmentAkomodasiList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
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

        // Check field name 'ORG_UNIT_CODE' first before field var 'x_ORG_UNIT_CODE'
        $val = $CurrentForm->hasValue("ORG_UNIT_CODE") ? $CurrentForm->getValue("ORG_UNIT_CODE") : $CurrentForm->getValue("x_ORG_UNIT_CODE");
        if (!$this->ORG_UNIT_CODE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ORG_UNIT_CODE->Visible = false; // Disable update for API request
            } else {
                $this->ORG_UNIT_CODE->setFormValue($val);
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

        // Check field name 'TREATMENT' first before field var 'x_TREATMENT'
        $val = $CurrentForm->hasValue("TREATMENT") ? $CurrentForm->getValue("TREATMENT") : $CurrentForm->getValue("x_TREATMENT");
        if (!$this->TREATMENT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TREATMENT->Visible = false; // Disable update for API request
            } else {
                $this->TREATMENT->setFormValue($val);
            }
        }

        // Check field name 'TREAT_DATE' first before field var 'x_TREAT_DATE'
        $val = $CurrentForm->hasValue("TREAT_DATE") ? $CurrentForm->getValue("TREAT_DATE") : $CurrentForm->getValue("x_TREAT_DATE");
        if (!$this->TREAT_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TREAT_DATE->Visible = false; // Disable update for API request
            } else {
                $this->TREAT_DATE->setFormValue($val);
            }
            $this->TREAT_DATE->CurrentValue = UnFormatDateTime($this->TREAT_DATE->CurrentValue, 0);
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

        // Check field name 'CLASS_ROOM_ID' first before field var 'x_CLASS_ROOM_ID'
        $val = $CurrentForm->hasValue("CLASS_ROOM_ID") ? $CurrentForm->getValue("CLASS_ROOM_ID") : $CurrentForm->getValue("x_CLASS_ROOM_ID");
        if (!$this->CLASS_ROOM_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLASS_ROOM_ID->Visible = false; // Disable update for API request
            } else {
                $this->CLASS_ROOM_ID->setFormValue($val);
            }
        }

        // Check field name 'KELUAR_ID' first before field var 'x_KELUAR_ID'
        $val = $CurrentForm->hasValue("KELUAR_ID") ? $CurrentForm->getValue("KELUAR_ID") : $CurrentForm->getValue("x_KELUAR_ID");
        if (!$this->KELUAR_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KELUAR_ID->Visible = false; // Disable update for API request
            } else {
                $this->KELUAR_ID->setFormValue($val);
            }
        }

        // Check field name 'BED_ID' first before field var 'x_BED_ID'
        $val = $CurrentForm->hasValue("BED_ID") ? $CurrentForm->getValue("BED_ID") : $CurrentForm->getValue("x_BED_ID");
        if (!$this->BED_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->BED_ID->Visible = false; // Disable update for API request
            } else {
                $this->BED_ID->setFormValue($val);
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

        // Check field name 'NO_SURAT_KET' first before field var 'x_NO_SURAT_KET'
        $val = $CurrentForm->hasValue("NO_SURAT_KET") ? $CurrentForm->getValue("NO_SURAT_KET") : $CurrentForm->getValue("x_NO_SURAT_KET");
        if (!$this->NO_SURAT_KET->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_SURAT_KET->Visible = false; // Disable update for API request
            } else {
                $this->NO_SURAT_KET->setFormValue($val);
            }
        }

        // Check field name 'ID' first before field var 'x_ID'
        $val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
        if (!$this->ID->IsDetailKey) {
            $this->ID->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ORG_UNIT_CODE->CurrentValue = $this->ORG_UNIT_CODE->FormValue;
        $this->CLINIC_ID->CurrentValue = $this->CLINIC_ID->FormValue;
        $this->TREATMENT->CurrentValue = $this->TREATMENT->FormValue;
        $this->TREAT_DATE->CurrentValue = $this->TREAT_DATE->FormValue;
        $this->TREAT_DATE->CurrentValue = UnFormatDateTime($this->TREAT_DATE->CurrentValue, 0);
        $this->DESCRIPTION->CurrentValue = $this->DESCRIPTION->FormValue;
        $this->CLASS_ROOM_ID->CurrentValue = $this->CLASS_ROOM_ID->FormValue;
        $this->KELUAR_ID->CurrentValue = $this->KELUAR_ID->FormValue;
        $this->BED_ID->CurrentValue = $this->BED_ID->FormValue;
        $this->EMPLOYEE_ID->CurrentValue = $this->EMPLOYEE_ID->FormValue;
        $this->NO_SURAT_KET->CurrentValue = $this->NO_SURAT_KET->FormValue;
        $this->ID->CurrentValue = $this->ID->FormValue;
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
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
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
        $row['THENAME'] = null;
        $row['THEADDRESS'] = null;
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

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE

        // BILL_ID

        // NO_REGISTRATION

        // VISIT_ID

        // TARIF_ID

        // CLASS_ID

        // CLINIC_ID

        // CLINIC_ID_FROM

        // TREATMENT

        // TREAT_DATE

        // QUANTITY

        // MEASURE_ID

        // DESCRIPTION

        // CLASS_ROOM_ID

        // KELUAR_ID

        // BED_ID

        // EMPLOYEE_ID

        // DOCTOR

        // EXIT_DATE

        // EMPLOYEE_ID_FROM

        // DOCTOR_FROM

        // STATUS_PASIEN_ID

        // DIAGNOSA_ID

        // THENAME

        // THEADDRESS

        // THEID

        // ISRJ

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // GENDER

        // KARYAWAN

        // MODIFIED_BY

        // MODIFIED_DATE

        // MODIFIED_FROM

        // POTONGAN

        // BAYAR

        // RETUR

        // TARIF_TYPE

        // PPNVALUE

        // TAGIHAN

        // KOREKSI

        // AMOUNT_PAID

        // DISKON

        // NOTA_NO

        // SELL_PRICE

        // ACCOUNT_ID

        // subsidi

        // DISCOUNT

        // AMOUNT

        // PPN

        // SUBSIDISAT

        // PRINTQ

        // PRINTED_BY

        // STATUS_TARIF

        // CLINIC_TYPE

        // PACKAGE_ID

        // MODULE_ID

        // THEORDER

        // CORRECTION_ID

        // CORRECTION_BY

        // CASHIER

        // PAYOR_ID

        // KAL_ID

        // NO_SKPINAP

        // RESPON

        // NOKARTU

        // PASIEN_ID

        // modified_datesys

        // MAPPING_SEP

        // TRANS_ID

        // SPPBILL

        // SPPBILLDATE

        // SPPBILLUSER

        // SPPKASIR

        // SPPKASIRDATE

        // SPPKASIRUSER

        // SPPPOLI

        // SPPPOLIUSER

        // SPPPOLIDATE

        // NO_SURAT_KET

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
            $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 0);
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

            // THENAME
            $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
            $this->THENAME->ViewCustomAttributes = "";

            // THEADDRESS
            $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
            $this->THEADDRESS->ViewCustomAttributes = "";

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

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // ORG_UNIT_CODE

            // CLINIC_ID
            $this->CLINIC_ID->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID->EditValue = $this->CLINIC_ID->lookupCacheOption($curVal);
                if ($this->CLINIC_ID->EditValue === null) { // Lookup from database
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLINIC_ID->Lookup->renderViewRow($rswrk[0]);
                        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->displayValue($arwrk);
                    } else {
                        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
                    }
                }
            } else {
                $this->CLINIC_ID->EditValue = null;
            }
            $this->CLINIC_ID->ViewCustomAttributes = "";

            // TREATMENT
            $this->TREATMENT->EditAttrs["class"] = "form-control";
            $this->TREATMENT->EditCustomAttributes = "";
            $this->TREATMENT->EditValue = $this->TREATMENT->CurrentValue;
            $this->TREATMENT->ViewCustomAttributes = "";

            // TREAT_DATE
            $this->TREAT_DATE->EditAttrs["class"] = "form-control";
            $this->TREAT_DATE->EditCustomAttributes = "";
            $this->TREAT_DATE->EditValue = $this->TREAT_DATE->CurrentValue;
            $this->TREAT_DATE->EditValue = FormatDateTime($this->TREAT_DATE->EditValue, 0);
            $this->TREAT_DATE->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->EditAttrs["class"] = "form-control";
            $this->DESCRIPTION->EditCustomAttributes = "";
            if (!$this->DESCRIPTION->Raw) {
                $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
            }
            $this->DESCRIPTION->EditValue = HtmlEncode($this->DESCRIPTION->CurrentValue);
            $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLASS_ROOM_ID->CurrentValue));
            if ($curVal != "") {
                $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->lookupCacheOption($curVal);
            } else {
                $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->Lookup !== null && is_array($this->CLASS_ROOM_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLASS_ROOM_ID->ViewValue !== null) { // Load from cache
                $this->CLASS_ROOM_ID->EditValue = array_values($this->CLASS_ROOM_ID->Lookup->Options);
                if ($this->CLASS_ROOM_ID->ViewValue == "") {
                    $this->CLASS_ROOM_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLASS_ROOM_ID]" . SearchString("=", $this->CLASS_ROOM_ID->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->CLASS_ROOM_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLASS_ROOM_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->displayValue($arwrk);
                } else {
                    $this->CLASS_ROOM_ID->ViewValue = $Language->phrase("PleaseSelect");
                }
                $arwrk = $rswrk;
                $this->CLASS_ROOM_ID->EditValue = $arwrk;
            }
            $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

            // KELUAR_ID
            $this->KELUAR_ID->EditAttrs["class"] = "form-control";
            $this->KELUAR_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->KELUAR_ID->CurrentValue));
            if ($curVal != "") {
                $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->lookupCacheOption($curVal);
            } else {
                $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->Lookup !== null && is_array($this->KELUAR_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->KELUAR_ID->ViewValue !== null) { // Load from cache
                $this->KELUAR_ID->EditValue = array_values($this->KELUAR_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[KELUAR_ID]" . SearchString("=", $this->KELUAR_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->KELUAR_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KELUAR_ID->EditValue = $arwrk;
            }
            $this->KELUAR_ID->PlaceHolder = RemoveHtml($this->KELUAR_ID->caption());

            // BED_ID
            $this->BED_ID->EditAttrs["class"] = "form-control";
            $this->BED_ID->EditCustomAttributes = "";
            $curVal = trim(strval($this->BED_ID->CurrentValue));
            if ($curVal != "") {
                $this->BED_ID->ViewValue = $this->BED_ID->lookupCacheOption($curVal);
            } else {
                $this->BED_ID->ViewValue = $this->BED_ID->Lookup !== null && is_array($this->BED_ID->Lookup->Options) ? $curVal : null;
            }
            if ($this->BED_ID->ViewValue !== null) { // Load from cache
                $this->BED_ID->EditValue = array_values($this->BED_ID->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[BED_ID]" . SearchString("=", $this->BED_ID->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->BED_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                foreach ($arwrk as &$row)
                    $row = $this->BED_ID->Lookup->renderViewRow($row);
                $this->BED_ID->EditValue = $arwrk;
            }
            $this->BED_ID->PlaceHolder = RemoveHtml($this->BED_ID->caption());

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
                $sqlWrk = $this->EMPLOYEE_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->EMPLOYEE_ID->EditValue = $arwrk;
            }
            $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

            // NO_SURAT_KET
            $this->NO_SURAT_KET->EditAttrs["class"] = "form-control";
            $this->NO_SURAT_KET->EditCustomAttributes = "";
            if (!$this->NO_SURAT_KET->Raw) {
                $this->NO_SURAT_KET->CurrentValue = HtmlDecode($this->NO_SURAT_KET->CurrentValue);
            }
            $this->NO_SURAT_KET->EditValue = HtmlEncode($this->NO_SURAT_KET->CurrentValue);
            $this->NO_SURAT_KET->PlaceHolder = RemoveHtml($this->NO_SURAT_KET->caption());

            // ID
            $this->ID->EditAttrs["class"] = "form-control";
            $this->ID->EditCustomAttributes = "";
            $this->ID->EditValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // Edit refer script

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";

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

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
            $this->CLASS_ROOM_ID->HrefValue = "";

            // KELUAR_ID
            $this->KELUAR_ID->LinkCustomAttributes = "";
            $this->KELUAR_ID->HrefValue = "";

            // BED_ID
            $this->BED_ID->LinkCustomAttributes = "";
            $this->BED_ID->HrefValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";

            // NO_SURAT_KET
            $this->NO_SURAT_KET->LinkCustomAttributes = "";
            $this->NO_SURAT_KET->HrefValue = "";

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";
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
        if ($this->CLINIC_ID->Required) {
            if (!$this->CLINIC_ID->IsDetailKey && EmptyValue($this->CLINIC_ID->FormValue)) {
                $this->CLINIC_ID->addErrorMessage(str_replace("%s", $this->CLINIC_ID->caption(), $this->CLINIC_ID->RequiredErrorMessage));
            }
        }
        if ($this->TREATMENT->Required) {
            if (!$this->TREATMENT->IsDetailKey && EmptyValue($this->TREATMENT->FormValue)) {
                $this->TREATMENT->addErrorMessage(str_replace("%s", $this->TREATMENT->caption(), $this->TREATMENT->RequiredErrorMessage));
            }
        }
        if ($this->TREAT_DATE->Required) {
            if (!$this->TREAT_DATE->IsDetailKey && EmptyValue($this->TREAT_DATE->FormValue)) {
                $this->TREAT_DATE->addErrorMessage(str_replace("%s", $this->TREAT_DATE->caption(), $this->TREAT_DATE->RequiredErrorMessage));
            }
        }
        if ($this->DESCRIPTION->Required) {
            if (!$this->DESCRIPTION->IsDetailKey && EmptyValue($this->DESCRIPTION->FormValue)) {
                $this->DESCRIPTION->addErrorMessage(str_replace("%s", $this->DESCRIPTION->caption(), $this->DESCRIPTION->RequiredErrorMessage));
            }
        }
        if ($this->CLASS_ROOM_ID->Required) {
            if (!$this->CLASS_ROOM_ID->IsDetailKey && EmptyValue($this->CLASS_ROOM_ID->FormValue)) {
                $this->CLASS_ROOM_ID->addErrorMessage(str_replace("%s", $this->CLASS_ROOM_ID->caption(), $this->CLASS_ROOM_ID->RequiredErrorMessage));
            }
        }
        if ($this->KELUAR_ID->Required) {
            if (!$this->KELUAR_ID->IsDetailKey && EmptyValue($this->KELUAR_ID->FormValue)) {
                $this->KELUAR_ID->addErrorMessage(str_replace("%s", $this->KELUAR_ID->caption(), $this->KELUAR_ID->RequiredErrorMessage));
            }
        }
        if ($this->BED_ID->Required) {
            if (!$this->BED_ID->IsDetailKey && EmptyValue($this->BED_ID->FormValue)) {
                $this->BED_ID->addErrorMessage(str_replace("%s", $this->BED_ID->caption(), $this->BED_ID->RequiredErrorMessage));
            }
        }
        if ($this->EMPLOYEE_ID->Required) {
            if (!$this->EMPLOYEE_ID->IsDetailKey && EmptyValue($this->EMPLOYEE_ID->FormValue)) {
                $this->EMPLOYEE_ID->addErrorMessage(str_replace("%s", $this->EMPLOYEE_ID->caption(), $this->EMPLOYEE_ID->RequiredErrorMessage));
            }
        }
        if ($this->NO_SURAT_KET->Required) {
            if (!$this->NO_SURAT_KET->IsDetailKey && EmptyValue($this->NO_SURAT_KET->FormValue)) {
                $this->NO_SURAT_KET->addErrorMessage(str_replace("%s", $this->NO_SURAT_KET->caption(), $this->NO_SURAT_KET->RequiredErrorMessage));
            }
        }
        if ($this->ID->Required) {
            if (!$this->ID->IsDetailKey && EmptyValue($this->ID->FormValue)) {
                $this->ID->addErrorMessage(str_replace("%s", $this->ID->caption(), $this->ID->RequiredErrorMessage));
            }
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
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->CurrentValue = CurrentOrgId();
            $this->ORG_UNIT_CODE->setDbValueDef($rsnew, $this->ORG_UNIT_CODE->CurrentValue, "");

            // DESCRIPTION
            $this->DESCRIPTION->setDbValueDef($rsnew, $this->DESCRIPTION->CurrentValue, null, $this->DESCRIPTION->ReadOnly);

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->setDbValueDef($rsnew, $this->CLASS_ROOM_ID->CurrentValue, null, $this->CLASS_ROOM_ID->ReadOnly);

            // KELUAR_ID
            $this->KELUAR_ID->setDbValueDef($rsnew, $this->KELUAR_ID->CurrentValue, null, $this->KELUAR_ID->ReadOnly);

            // BED_ID
            $this->BED_ID->setDbValueDef($rsnew, $this->BED_ID->CurrentValue, null, $this->BED_ID->ReadOnly);

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->setDbValueDef($rsnew, $this->EMPLOYEE_ID->CurrentValue, null, $this->EMPLOYEE_ID->ReadOnly);

            // NO_SURAT_KET
            $this->NO_SURAT_KET->setDbValueDef($rsnew, $this->NO_SURAT_KET->CurrentValue, null, $this->NO_SURAT_KET->ReadOnly);

            // Check referential integrity for master table 'V_KASIR'
            $validMasterRecord = true;
            $masterFilter = $this->sqlMasterFilter_V_KASIR();
            $keyValue = $rsnew['VISIT_ID'] ?? $rsold['VISIT_ID'];
            if (strval($keyValue) != "") {
                $masterFilter = str_replace("@VISIT_ID@", AdjustSql($keyValue), $masterFilter);
            } else {
                $validMasterRecord = false;
            }
            if ($validMasterRecord) {
                $rsmaster = Container("V_KASIR")->loadRs($masterFilter)->fetch();
                $validMasterRecord = $rsmaster !== false;
            }
            if (!$validMasterRecord) {
                $relatedRecordMsg = str_replace("%t", "V_KASIR", $Language->phrase("RelatedRecordRequired"));
                $this->setFailureMessage($relatedRecordMsg);
                return false;
            }

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
            if ($masterTblVar == "V_KASIR") {
                $validMaster = true;
                $masterTbl = Container("V_KASIR");
                if (($parm = Get("fk_VISIT_ID", Get("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setQueryStringValue($parm);
                    $this->VISIT_ID->setQueryStringValue($masterTbl->VISIT_ID->QueryStringValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->QueryStringValue);
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "TREATMENT_BILL") {
                $validMaster = true;
                $masterTbl = Container("TREATMENT_BILL");
                if (($parm = Get("fk_BILL_ID", Get("BILL_ID"))) !== null) {
                    $masterTbl->BILL_ID->setQueryStringValue($parm);
                    $this->BILL_ID->setQueryStringValue($masterTbl->BILL_ID->QueryStringValue);
                    $this->BILL_ID->setSessionValue($this->BILL_ID->QueryStringValue);
                } else {
                    $validMaster = false;
                }
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
            if ($masterTblVar == "V_KASIR") {
                $validMaster = true;
                $masterTbl = Container("V_KASIR");
                if (($parm = Post("fk_VISIT_ID", Post("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setFormValue($parm);
                    $this->VISIT_ID->setFormValue($masterTbl->VISIT_ID->FormValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->FormValue);
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "TREATMENT_BILL") {
                $validMaster = true;
                $masterTbl = Container("TREATMENT_BILL");
                if (($parm = Post("fk_BILL_ID", Post("BILL_ID"))) !== null) {
                    $masterTbl->BILL_ID->setFormValue($parm);
                    $this->BILL_ID->setFormValue($masterTbl->BILL_ID->FormValue);
                    $this->BILL_ID->setSessionValue($this->BILL_ID->FormValue);
                } else {
                    $validMaster = false;
                }
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
            $this->setSessionWhere($this->getDetailFilter());

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "V_KASIR") {
                if ($this->VISIT_ID->CurrentValue == "") {
                    $this->VISIT_ID->setSessionValue("");
                }
            }
            if ($masterTblVar != "TREATMENT_BILL") {
                if ($this->BILL_ID->CurrentValue == "") {
                    $this->BILL_ID->setSessionValue("");
                }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("TreatmentAkomodasiList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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
}
