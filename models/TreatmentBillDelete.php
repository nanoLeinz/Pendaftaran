<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TreatmentBillDelete extends TreatmentBill
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'TREATMENT_BILL';

    // Page object name
    public $PageObjName = "TreatmentBillDelete";

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

        // Table object (TREATMENT_BILL)
        if (!isset($GLOBALS["TREATMENT_BILL"]) || get_class($GLOBALS["TREATMENT_BILL"]) == PROJECT_NAMESPACE . "TREATMENT_BILL") {
            $GLOBALS["TREATMENT_BILL"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'TREATMENT_BILL');
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
                $doc = new $class(Container("TREATMENT_BILL"));
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
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;
        $this->CurrentAction = Param("action"); // Set up current action
        $this->ORG_UNIT_CODE->Visible = false;
        $this->BILL_ID->Visible = false;
        $this->NO_REGISTRATION->Visible = false;
        $this->VISIT_ID->Visible = false;
        $this->TARIF_ID->setVisibility();
        $this->CLASS_ID->Visible = false;
        $this->CLINIC_ID->setVisibility();
        $this->CLINIC_ID_FROM->Visible = false;
        $this->TREATMENT->Visible = false;
        $this->TREAT_DATE->setVisibility();
        $this->AMOUNT->Visible = false;
        $this->QUANTITY->setVisibility();
        $this->MEASURE_ID->Visible = false;
        $this->POKOK_JUAL->Visible = false;
        $this->PPN->Visible = false;
        $this->MARGIN->Visible = false;
        $this->SUBSIDI->Visible = false;
        $this->EMBALACE->Visible = false;
        $this->PROFESI->Visible = false;
        $this->DISCOUNT->Visible = false;
        $this->PAY_METHOD_ID->Visible = false;
        $this->PAYMENT_DATE->Visible = false;
        $this->ISLUNAS->Visible = false;
        $this->DUEDATE_ANGSURAN->Visible = false;
        $this->DESCRIPTION->Visible = false;
        $this->KUITANSI_ID->Visible = false;
        $this->NOTA_NO->Visible = false;
        $this->ISCETAK->Visible = false;
        $this->PRINT_DATE->Visible = false;
        $this->RESEP_NO->Visible = false;
        $this->RESEP_KE->Visible = false;
        $this->DOSE->Visible = false;
        $this->ORIG_DOSE->Visible = false;
        $this->DOSE_PRESC->Visible = false;
        $this->ITER->Visible = false;
        $this->ITER_KE->Visible = false;
        $this->SOLD_STATUS->Visible = false;
        $this->RACIKAN->Visible = false;
        $this->CLASS_ROOM_ID->Visible = false;
        $this->KELUAR_ID->Visible = false;
        $this->BED_ID->Visible = false;
        $this->PERDA_ID->Visible = false;
        $this->EMPLOYEE_ID->setVisibility();
        $this->DESCRIPTION2->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_FROM->Visible = false;
        $this->BRAND_ID->Visible = false;
        $this->DOCTOR->Visible = false;
        $this->JML_BKS->Visible = false;
        $this->EXIT_DATE->Visible = false;
        $this->FA_V->Visible = false;
        $this->TASK_ID->Visible = false;
        $this->EMPLOYEE_ID_FROM->Visible = false;
        $this->DOCTOR_FROM->Visible = false;
        $this->status_pasien_id->Visible = false;
        $this->amount_paid->setVisibility();
        $this->THENAME->Visible = false;
        $this->THEADDRESS->Visible = false;
        $this->THEID->Visible = false;
        $this->serial_nb->Visible = false;
        $this->TREATMENT_PLAFOND->Visible = false;
        $this->AMOUNT_PLAFOND->Visible = false;
        $this->AMOUNT_PAID_PLAFOND->Visible = false;
        $this->CLASS_ID_PLAFOND->Visible = false;
        $this->PAYOR_ID->Visible = false;
        $this->PEMBULATAN->Visible = false;
        $this->ISRJ->Visible = false;
        $this->AGEYEAR->Visible = false;
        $this->AGEMONTH->Visible = false;
        $this->AGEDAY->Visible = false;
        $this->GENDER->Visible = false;
        $this->KAL_ID->Visible = false;
        $this->CORRECTION_ID->Visible = false;
        $this->CORRECTION_BY->Visible = false;
        $this->KARYAWAN->Visible = false;
        $this->ACCOUNT_ID->Visible = false;
        $this->sell_price->Visible = false;
        $this->diskon->Visible = false;
        $this->INVOICE_ID->Visible = false;
        $this->NUMER->Visible = false;
        $this->MEASURE_ID2->Visible = false;
        $this->POTONGAN->Visible = false;
        $this->BAYAR->Visible = false;
        $this->RETUR->Visible = false;
        $this->TARIF_TYPE->Visible = false;
        $this->PPNVALUE->Visible = false;
        $this->TAGIHAN->Visible = false;
        $this->KOREKSI->Visible = false;
        $this->STATUS_OBAT->Visible = false;
        $this->SUBSIDISAT->Visible = false;
        $this->PRINTQ->Visible = false;
        $this->PRINTED_BY->Visible = false;
        $this->STOCK_AVAILABLE->Visible = false;
        $this->STATUS_TARIF->Visible = false;
        $this->CLINIC_TYPE->Visible = false;
        $this->PACKAGE_ID->Visible = false;
        $this->MODULE_ID->Visible = false;
        $this->profession->Visible = false;
        $this->THEORDER->Visible = false;
        $this->CASHIER->Visible = false;
        $this->SPPFEE->Visible = false;
        $this->SPPBILL->Visible = false;
        $this->SPPRJK->Visible = false;
        $this->SPPJMN->Visible = false;
        $this->SPPKASIR->Visible = false;
        $this->PERUJUK->Visible = false;
        $this->PERUJUKFEE->Visible = false;
        $this->modified_datesys->Visible = false;
        $this->TRANS_ID->Visible = false;
        $this->SPPBILLDATE->Visible = false;
        $this->SPPBILLUSER->Visible = false;
        $this->SPPKASIRDATE->Visible = false;
        $this->SPPKASIRUSER->Visible = false;
        $this->SPPPOLI->Visible = false;
        $this->SPPPOLIUSER->Visible = false;
        $this->SPPPOLIDATE->Visible = false;
        $this->nota_temp->Visible = false;
        $this->CLINIC_ID_TEMP->Visible = false;
        $this->NOSEP->Visible = false;
        $this->ID->Visible = false;
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
        $this->setupLookupOptions($this->TARIF_ID);
        $this->setupLookupOptions($this->CLINIC_ID);
        $this->setupLookupOptions($this->EMPLOYEE_ID);

        // Set up master/detail parameters
        $this->setupMasterParms();

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("TreatmentBillList"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("TreatmentBillList"); // Return to list
                return;
            }
        }

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
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->CLINIC_ID_FROM->setDbValue($row['CLINIC_ID_FROM']);
        $this->TREATMENT->setDbValue($row['TREATMENT']);
        $this->TREAT_DATE->setDbValue($row['TREAT_DATE']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->QUANTITY->setDbValue($row['QUANTITY']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->POKOK_JUAL->setDbValue($row['POKOK_JUAL']);
        $this->PPN->setDbValue($row['PPN']);
        $this->MARGIN->setDbValue($row['MARGIN']);
        $this->SUBSIDI->setDbValue($row['SUBSIDI']);
        $this->EMBALACE->setDbValue($row['EMBALACE']);
        $this->PROFESI->setDbValue($row['PROFESI']);
        $this->DISCOUNT->setDbValue($row['DISCOUNT']);
        $this->PAY_METHOD_ID->setDbValue($row['PAY_METHOD_ID']);
        $this->PAYMENT_DATE->setDbValue($row['PAYMENT_DATE']);
        $this->ISLUNAS->setDbValue($row['ISLUNAS']);
        $this->DUEDATE_ANGSURAN->setDbValue($row['DUEDATE_ANGSURAN']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->KUITANSI_ID->setDbValue($row['KUITANSI_ID']);
        $this->NOTA_NO->setDbValue($row['NOTA_NO']);
        $this->ISCETAK->setDbValue($row['ISCETAK']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->RESEP_NO->setDbValue($row['RESEP_NO']);
        $this->RESEP_KE->setDbValue($row['RESEP_KE']);
        $this->DOSE->setDbValue($row['DOSE']);
        $this->ORIG_DOSE->setDbValue($row['ORIG_DOSE']);
        $this->DOSE_PRESC->setDbValue($row['DOSE_PRESC']);
        $this->ITER->setDbValue($row['ITER']);
        $this->ITER_KE->setDbValue($row['ITER_KE']);
        $this->SOLD_STATUS->setDbValue($row['SOLD_STATUS']);
        $this->RACIKAN->setDbValue($row['RACIKAN']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->PERDA_ID->setDbValue($row['PERDA_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->DESCRIPTION2->setDbValue($row['DESCRIPTION2']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->BRAND_ID->setDbValue($row['BRAND_ID']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->JML_BKS->setDbValue($row['JML_BKS']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->TASK_ID->setDbValue($row['TASK_ID']);
        $this->EMPLOYEE_ID_FROM->setDbValue($row['EMPLOYEE_ID_FROM']);
        $this->DOCTOR_FROM->setDbValue($row['DOCTOR_FROM']);
        $this->status_pasien_id->setDbValue($row['status_pasien_id']);
        $this->amount_paid->setDbValue($row['amount_paid']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEID->setDbValue($row['THEID']);
        $this->serial_nb->setDbValue($row['serial_nb']);
        $this->TREATMENT_PLAFOND->setDbValue($row['TREATMENT_PLAFOND']);
        $this->AMOUNT_PLAFOND->setDbValue($row['AMOUNT_PLAFOND']);
        $this->AMOUNT_PAID_PLAFOND->setDbValue($row['AMOUNT_PAID_PLAFOND']);
        $this->CLASS_ID_PLAFOND->setDbValue($row['CLASS_ID_PLAFOND']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->PEMBULATAN->setDbValue($row['PEMBULATAN']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->CORRECTION_ID->setDbValue($row['CORRECTION_ID']);
        $this->CORRECTION_BY->setDbValue($row['CORRECTION_BY']);
        $this->KARYAWAN->setDbValue($row['KARYAWAN']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->sell_price->setDbValue($row['sell_price']);
        $this->diskon->setDbValue($row['diskon']);
        $this->INVOICE_ID->setDbValue($row['INVOICE_ID']);
        $this->NUMER->setDbValue($row['NUMER']);
        $this->MEASURE_ID2->setDbValue($row['MEASURE_ID2']);
        $this->POTONGAN->setDbValue($row['POTONGAN']);
        $this->BAYAR->setDbValue($row['BAYAR']);
        $this->RETUR->setDbValue($row['RETUR']);
        $this->TARIF_TYPE->setDbValue($row['TARIF_TYPE']);
        $this->PPNVALUE->setDbValue($row['PPNVALUE']);
        $this->TAGIHAN->setDbValue($row['TAGIHAN']);
        $this->KOREKSI->setDbValue($row['KOREKSI']);
        $this->STATUS_OBAT->setDbValue($row['STATUS_OBAT']);
        $this->SUBSIDISAT->setDbValue($row['SUBSIDISAT']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->STOCK_AVAILABLE->setDbValue($row['STOCK_AVAILABLE']);
        $this->STATUS_TARIF->setDbValue($row['STATUS_TARIF']);
        $this->CLINIC_TYPE->setDbValue($row['CLINIC_TYPE']);
        $this->PACKAGE_ID->setDbValue($row['PACKAGE_ID']);
        $this->MODULE_ID->setDbValue($row['MODULE_ID']);
        $this->profession->setDbValue($row['profession']);
        $this->THEORDER->setDbValue($row['THEORDER']);
        $this->CASHIER->setDbValue($row['CASHIER']);
        $this->SPPFEE->setDbValue($row['SPPFEE']);
        $this->SPPBILL->setDbValue($row['SPPBILL']);
        $this->SPPRJK->setDbValue($row['SPPRJK']);
        $this->SPPJMN->setDbValue($row['SPPJMN']);
        $this->SPPKASIR->setDbValue($row['SPPKASIR']);
        $this->PERUJUK->setDbValue($row['PERUJUK']);
        $this->PERUJUKFEE->setDbValue($row['PERUJUKFEE']);
        $this->modified_datesys->setDbValue($row['modified_datesys']);
        $this->TRANS_ID->setDbValue($row['TRANS_ID']);
        $this->SPPBILLDATE->setDbValue($row['SPPBILLDATE']);
        $this->SPPBILLUSER->setDbValue($row['SPPBILLUSER']);
        $this->SPPKASIRDATE->setDbValue($row['SPPKASIRDATE']);
        $this->SPPKASIRUSER->setDbValue($row['SPPKASIRUSER']);
        $this->SPPPOLI->setDbValue($row['SPPPOLI']);
        $this->SPPPOLIUSER->setDbValue($row['SPPPOLIUSER']);
        $this->SPPPOLIDATE->setDbValue($row['SPPPOLIDATE']);
        $this->nota_temp->setDbValue($row['nota_temp']);
        $this->CLINIC_ID_TEMP->setDbValue($row['CLINIC_ID_TEMP']);
        $this->NOSEP->setDbValue($row['NOSEP']);
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
        $row['AMOUNT'] = null;
        $row['QUANTITY'] = null;
        $row['MEASURE_ID'] = null;
        $row['POKOK_JUAL'] = null;
        $row['PPN'] = null;
        $row['MARGIN'] = null;
        $row['SUBSIDI'] = null;
        $row['EMBALACE'] = null;
        $row['PROFESI'] = null;
        $row['DISCOUNT'] = null;
        $row['PAY_METHOD_ID'] = null;
        $row['PAYMENT_DATE'] = null;
        $row['ISLUNAS'] = null;
        $row['DUEDATE_ANGSURAN'] = null;
        $row['DESCRIPTION'] = null;
        $row['KUITANSI_ID'] = null;
        $row['NOTA_NO'] = null;
        $row['ISCETAK'] = null;
        $row['PRINT_DATE'] = null;
        $row['RESEP_NO'] = null;
        $row['RESEP_KE'] = null;
        $row['DOSE'] = null;
        $row['ORIG_DOSE'] = null;
        $row['DOSE_PRESC'] = null;
        $row['ITER'] = null;
        $row['ITER_KE'] = null;
        $row['SOLD_STATUS'] = null;
        $row['RACIKAN'] = null;
        $row['CLASS_ROOM_ID'] = null;
        $row['KELUAR_ID'] = null;
        $row['BED_ID'] = null;
        $row['PERDA_ID'] = null;
        $row['EMPLOYEE_ID'] = null;
        $row['DESCRIPTION2'] = null;
        $row['MODIFIED_BY'] = null;
        $row['MODIFIED_DATE'] = null;
        $row['MODIFIED_FROM'] = null;
        $row['BRAND_ID'] = null;
        $row['DOCTOR'] = null;
        $row['JML_BKS'] = null;
        $row['EXIT_DATE'] = null;
        $row['FA_V'] = null;
        $row['TASK_ID'] = null;
        $row['EMPLOYEE_ID_FROM'] = null;
        $row['DOCTOR_FROM'] = null;
        $row['status_pasien_id'] = null;
        $row['amount_paid'] = null;
        $row['THENAME'] = null;
        $row['THEADDRESS'] = null;
        $row['THEID'] = null;
        $row['serial_nb'] = null;
        $row['TREATMENT_PLAFOND'] = null;
        $row['AMOUNT_PLAFOND'] = null;
        $row['AMOUNT_PAID_PLAFOND'] = null;
        $row['CLASS_ID_PLAFOND'] = null;
        $row['PAYOR_ID'] = null;
        $row['PEMBULATAN'] = null;
        $row['ISRJ'] = null;
        $row['AGEYEAR'] = null;
        $row['AGEMONTH'] = null;
        $row['AGEDAY'] = null;
        $row['GENDER'] = null;
        $row['KAL_ID'] = null;
        $row['CORRECTION_ID'] = null;
        $row['CORRECTION_BY'] = null;
        $row['KARYAWAN'] = null;
        $row['ACCOUNT_ID'] = null;
        $row['sell_price'] = null;
        $row['diskon'] = null;
        $row['INVOICE_ID'] = null;
        $row['NUMER'] = null;
        $row['MEASURE_ID2'] = null;
        $row['POTONGAN'] = null;
        $row['BAYAR'] = null;
        $row['RETUR'] = null;
        $row['TARIF_TYPE'] = null;
        $row['PPNVALUE'] = null;
        $row['TAGIHAN'] = null;
        $row['KOREKSI'] = null;
        $row['STATUS_OBAT'] = null;
        $row['SUBSIDISAT'] = null;
        $row['PRINTQ'] = null;
        $row['PRINTED_BY'] = null;
        $row['STOCK_AVAILABLE'] = null;
        $row['STATUS_TARIF'] = null;
        $row['CLINIC_TYPE'] = null;
        $row['PACKAGE_ID'] = null;
        $row['MODULE_ID'] = null;
        $row['profession'] = null;
        $row['THEORDER'] = null;
        $row['CASHIER'] = null;
        $row['SPPFEE'] = null;
        $row['SPPBILL'] = null;
        $row['SPPRJK'] = null;
        $row['SPPJMN'] = null;
        $row['SPPKASIR'] = null;
        $row['PERUJUK'] = null;
        $row['PERUJUKFEE'] = null;
        $row['modified_datesys'] = null;
        $row['TRANS_ID'] = null;
        $row['SPPBILLDATE'] = null;
        $row['SPPBILLUSER'] = null;
        $row['SPPKASIRDATE'] = null;
        $row['SPPKASIRUSER'] = null;
        $row['SPPPOLI'] = null;
        $row['SPPPOLIUSER'] = null;
        $row['SPPPOLIDATE'] = null;
        $row['nota_temp'] = null;
        $row['CLINIC_ID_TEMP'] = null;
        $row['NOSEP'] = null;
        $row['ID'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->QUANTITY->FormValue == $this->QUANTITY->CurrentValue && is_numeric(ConvertToFloatString($this->QUANTITY->CurrentValue))) {
            $this->QUANTITY->CurrentValue = ConvertToFloatString($this->QUANTITY->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->amount_paid->FormValue == $this->amount_paid->CurrentValue && is_numeric(ConvertToFloatString($this->amount_paid->CurrentValue))) {
            $this->amount_paid->CurrentValue = ConvertToFloatString($this->amount_paid->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->CellCssStyle = "white-space: nowrap;";

        // BILL_ID
        $this->BILL_ID->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // TARIF_ID

        // CLASS_ID
        $this->CLASS_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // TREATMENT
        $this->TREATMENT->CellCssStyle = "white-space: nowrap;";

        // TREAT_DATE
        $this->TREAT_DATE->CellCssStyle = "white-space: nowrap;";

        // AMOUNT
        $this->AMOUNT->CellCssStyle = "white-space: nowrap;";

        // QUANTITY
        $this->QUANTITY->CellCssStyle = "white-space: nowrap;";

        // MEASURE_ID
        $this->MEASURE_ID->CellCssStyle = "white-space: nowrap;";

        // POKOK_JUAL
        $this->POKOK_JUAL->CellCssStyle = "white-space: nowrap;";

        // PPN
        $this->PPN->CellCssStyle = "white-space: nowrap;";

        // MARGIN
        $this->MARGIN->CellCssStyle = "white-space: nowrap;";

        // SUBSIDI
        $this->SUBSIDI->CellCssStyle = "white-space: nowrap;";

        // EMBALACE
        $this->EMBALACE->CellCssStyle = "white-space: nowrap;";

        // PROFESI
        $this->PROFESI->CellCssStyle = "white-space: nowrap;";

        // DISCOUNT
        $this->DISCOUNT->CellCssStyle = "white-space: nowrap;";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->CellCssStyle = "white-space: nowrap;";

        // PAYMENT_DATE
        $this->PAYMENT_DATE->CellCssStyle = "white-space: nowrap;";

        // ISLUNAS
        $this->ISLUNAS->CellCssStyle = "white-space: nowrap;";

        // DUEDATE_ANGSURAN
        $this->DUEDATE_ANGSURAN->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // KUITANSI_ID
        $this->KUITANSI_ID->CellCssStyle = "white-space: nowrap;";

        // NOTA_NO
        $this->NOTA_NO->CellCssStyle = "white-space: nowrap;";

        // ISCETAK
        $this->ISCETAK->CellCssStyle = "white-space: nowrap;";

        // PRINT_DATE
        $this->PRINT_DATE->CellCssStyle = "white-space: nowrap;";

        // RESEP_NO
        $this->RESEP_NO->CellCssStyle = "white-space: nowrap;";

        // RESEP_KE
        $this->RESEP_KE->CellCssStyle = "white-space: nowrap;";

        // DOSE
        $this->DOSE->CellCssStyle = "white-space: nowrap;";

        // ORIG_DOSE
        $this->ORIG_DOSE->CellCssStyle = "white-space: nowrap;";

        // DOSE_PRESC
        $this->DOSE_PRESC->CellCssStyle = "white-space: nowrap;";

        // ITER
        $this->ITER->CellCssStyle = "white-space: nowrap;";

        // ITER_KE
        $this->ITER_KE->CellCssStyle = "white-space: nowrap;";

        // SOLD_STATUS
        $this->SOLD_STATUS->CellCssStyle = "white-space: nowrap;";

        // RACIKAN
        $this->RACIKAN->CellCssStyle = "white-space: nowrap;";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->CellCssStyle = "white-space: nowrap;";

        // KELUAR_ID
        $this->KELUAR_ID->CellCssStyle = "white-space: nowrap;";

        // BED_ID
        $this->BED_ID->CellCssStyle = "white-space: nowrap;";

        // PERDA_ID
        $this->PERDA_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION2
        $this->DESCRIPTION2->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // BRAND_ID
        $this->BRAND_ID->CellCssStyle = "white-space: nowrap;";

        // DOCTOR
        $this->DOCTOR->CellCssStyle = "white-space: nowrap;";

        // JML_BKS
        $this->JML_BKS->CellCssStyle = "white-space: nowrap;";

        // EXIT_DATE
        $this->EXIT_DATE->CellCssStyle = "white-space: nowrap;";

        // FA_V
        $this->FA_V->CellCssStyle = "white-space: nowrap;";

        // TASK_ID
        $this->TASK_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // DOCTOR_FROM
        $this->DOCTOR_FROM->CellCssStyle = "white-space: nowrap;";

        // status_pasien_id
        $this->status_pasien_id->CellCssStyle = "white-space: nowrap;";

        // amount_paid
        $this->amount_paid->CellCssStyle = "white-space: nowrap;";

        // THENAME
        $this->THENAME->CellCssStyle = "white-space: nowrap;";

        // THEADDRESS
        $this->THEADDRESS->CellCssStyle = "white-space: nowrap;";

        // THEID
        $this->THEID->CellCssStyle = "white-space: nowrap;";

        // serial_nb
        $this->serial_nb->CellCssStyle = "white-space: nowrap;";

        // TREATMENT_PLAFOND
        $this->TREATMENT_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // AMOUNT_PLAFOND
        $this->AMOUNT_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // AMOUNT_PAID_PLAFOND
        $this->AMOUNT_PAID_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // PAYOR_ID
        $this->PAYOR_ID->CellCssStyle = "white-space: nowrap;";

        // PEMBULATAN
        $this->PEMBULATAN->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // AGEYEAR
        $this->AGEYEAR->CellCssStyle = "white-space: nowrap;";

        // AGEMONTH
        $this->AGEMONTH->CellCssStyle = "white-space: nowrap;";

        // AGEDAY
        $this->AGEDAY->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // CORRECTION_ID
        $this->CORRECTION_ID->CellCssStyle = "white-space: nowrap;";

        // CORRECTION_BY
        $this->CORRECTION_BY->CellCssStyle = "white-space: nowrap;";

        // KARYAWAN
        $this->KARYAWAN->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // sell_price
        $this->sell_price->CellCssStyle = "white-space: nowrap;";

        // diskon
        $this->diskon->CellCssStyle = "white-space: nowrap;";

        // INVOICE_ID
        $this->INVOICE_ID->CellCssStyle = "white-space: nowrap;";

        // NUMER
        $this->NUMER->CellCssStyle = "white-space: nowrap;";

        // MEASURE_ID2
        $this->MEASURE_ID2->CellCssStyle = "white-space: nowrap;";

        // POTONGAN
        $this->POTONGAN->CellCssStyle = "white-space: nowrap;";

        // BAYAR
        $this->BAYAR->CellCssStyle = "white-space: nowrap;";

        // RETUR
        $this->RETUR->CellCssStyle = "white-space: nowrap;";

        // TARIF_TYPE
        $this->TARIF_TYPE->CellCssStyle = "white-space: nowrap;";

        // PPNVALUE
        $this->PPNVALUE->CellCssStyle = "white-space: nowrap;";

        // TAGIHAN
        $this->TAGIHAN->CellCssStyle = "white-space: nowrap;";

        // KOREKSI
        $this->KOREKSI->CellCssStyle = "white-space: nowrap;";

        // STATUS_OBAT
        $this->STATUS_OBAT->CellCssStyle = "white-space: nowrap;";

        // SUBSIDISAT
        $this->SUBSIDISAT->CellCssStyle = "white-space: nowrap;";

        // PRINTQ
        $this->PRINTQ->CellCssStyle = "white-space: nowrap;";

        // PRINTED_BY
        $this->PRINTED_BY->CellCssStyle = "white-space: nowrap;";

        // STOCK_AVAILABLE
        $this->STOCK_AVAILABLE->CellCssStyle = "white-space: nowrap;";

        // STATUS_TARIF
        $this->STATUS_TARIF->CellCssStyle = "white-space: nowrap;";

        // CLINIC_TYPE
        $this->CLINIC_TYPE->CellCssStyle = "white-space: nowrap;";

        // PACKAGE_ID
        $this->PACKAGE_ID->CellCssStyle = "white-space: nowrap;";

        // MODULE_ID
        $this->MODULE_ID->CellCssStyle = "white-space: nowrap;";

        // profession
        $this->profession->CellCssStyle = "white-space: nowrap;";

        // THEORDER
        $this->THEORDER->CellCssStyle = "white-space: nowrap;";

        // CASHIER
        $this->CASHIER->CellCssStyle = "white-space: nowrap;";

        // SPPFEE
        $this->SPPFEE->CellCssStyle = "white-space: nowrap;";

        // SPPBILL
        $this->SPPBILL->CellCssStyle = "white-space: nowrap;";

        // SPPRJK
        $this->SPPRJK->CellCssStyle = "white-space: nowrap;";

        // SPPJMN
        $this->SPPJMN->CellCssStyle = "white-space: nowrap;";

        // SPPKASIR
        $this->SPPKASIR->CellCssStyle = "white-space: nowrap;";

        // PERUJUK
        $this->PERUJUK->CellCssStyle = "white-space: nowrap;";

        // PERUJUKFEE
        $this->PERUJUKFEE->CellCssStyle = "white-space: nowrap;";

        // modified_datesys
        $this->modified_datesys->CellCssStyle = "white-space: nowrap;";

        // TRANS_ID
        $this->TRANS_ID->CellCssStyle = "white-space: nowrap;";

        // SPPBILLDATE
        $this->SPPBILLDATE->CellCssStyle = "white-space: nowrap;";

        // SPPBILLUSER
        $this->SPPBILLUSER->CellCssStyle = "white-space: nowrap;";

        // SPPKASIRDATE
        $this->SPPKASIRDATE->CellCssStyle = "white-space: nowrap;";

        // SPPKASIRUSER
        $this->SPPKASIRUSER->CellCssStyle = "white-space: nowrap;";

        // SPPPOLI
        $this->SPPPOLI->CellCssStyle = "white-space: nowrap;";

        // SPPPOLIUSER
        $this->SPPPOLIUSER->CellCssStyle = "white-space: nowrap;";

        // SPPPOLIDATE
        $this->SPPPOLIDATE->CellCssStyle = "white-space: nowrap;";

        // nota_temp
        $this->nota_temp->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID_TEMP
        $this->CLINIC_ID_TEMP->CellCssStyle = "white-space: nowrap;";

        // NOSEP
        $this->NOSEP->CellCssStyle = "white-space: nowrap;";

        // ID
        $this->ID->CellCssStyle = "white-space: nowrap;";
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // BILL_ID
            $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
            $this->BILL_ID->ViewCustomAttributes = "";

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

            // TARIF_ID
            $curVal = trim(strval($this->TARIF_ID->CurrentValue));
            if ($curVal != "") {
                $this->TARIF_ID->ViewValue = $this->TARIF_ID->lookupCacheOption($curVal);
                if ($this->TARIF_ID->ViewValue === null) { // Lookup from database
                    $filterWrk = "[TARIF_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "[IMPLEMENTED] = 1";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->TARIF_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
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
            $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->CurrentValue;
            $this->CLINIC_ID_FROM->ViewCustomAttributes = "";

            // TREATMENT
            $this->TREATMENT->ViewValue = $this->TREATMENT->CurrentValue;
            $this->TREATMENT->ViewCustomAttributes = "";

            // TREAT_DATE
            $this->TREAT_DATE->ViewValue = $this->TREAT_DATE->CurrentValue;
            $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 11);
            $this->TREAT_DATE->ViewCustomAttributes = "";

            // AMOUNT
            $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
            $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
            $this->AMOUNT->ViewCustomAttributes = "";

            // QUANTITY
            $this->QUANTITY->ViewValue = $this->QUANTITY->CurrentValue;
            $this->QUANTITY->ViewValue = FormatNumber($this->QUANTITY->ViewValue, 2, -2, -2, -2);
            $this->QUANTITY->ViewCustomAttributes = "";

            // MEASURE_ID
            $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
            $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
            $this->MEASURE_ID->ViewCustomAttributes = "";

            // POKOK_JUAL
            $this->POKOK_JUAL->ViewValue = $this->POKOK_JUAL->CurrentValue;
            $this->POKOK_JUAL->ViewValue = FormatNumber($this->POKOK_JUAL->ViewValue, 2, -2, -2, -2);
            $this->POKOK_JUAL->ViewCustomAttributes = "";

            // PPN
            $this->PPN->ViewValue = $this->PPN->CurrentValue;
            $this->PPN->ViewValue = FormatNumber($this->PPN->ViewValue, 2, -2, -2, -2);
            $this->PPN->ViewCustomAttributes = "";

            // MARGIN
            $this->MARGIN->ViewValue = $this->MARGIN->CurrentValue;
            $this->MARGIN->ViewValue = FormatNumber($this->MARGIN->ViewValue, 2, -2, -2, -2);
            $this->MARGIN->ViewCustomAttributes = "";

            // SUBSIDI
            $this->SUBSIDI->ViewValue = $this->SUBSIDI->CurrentValue;
            $this->SUBSIDI->ViewValue = FormatNumber($this->SUBSIDI->ViewValue, 2, -2, -2, -2);
            $this->SUBSIDI->ViewCustomAttributes = "";

            // EMBALACE
            $this->EMBALACE->ViewValue = $this->EMBALACE->CurrentValue;
            $this->EMBALACE->ViewValue = FormatNumber($this->EMBALACE->ViewValue, 2, -2, -2, -2);
            $this->EMBALACE->ViewCustomAttributes = "";

            // PROFESI
            $this->PROFESI->ViewValue = $this->PROFESI->CurrentValue;
            $this->PROFESI->ViewValue = FormatNumber($this->PROFESI->ViewValue, 2, -2, -2, -2);
            $this->PROFESI->ViewCustomAttributes = "";

            // DISCOUNT
            $this->DISCOUNT->ViewValue = $this->DISCOUNT->CurrentValue;
            $this->DISCOUNT->ViewValue = FormatNumber($this->DISCOUNT->ViewValue, 2, -2, -2, -2);
            $this->DISCOUNT->ViewCustomAttributes = "";

            // PAY_METHOD_ID
            $this->PAY_METHOD_ID->ViewValue = $this->PAY_METHOD_ID->CurrentValue;
            $this->PAY_METHOD_ID->ViewValue = FormatNumber($this->PAY_METHOD_ID->ViewValue, 0, -2, -2, -2);
            $this->PAY_METHOD_ID->ViewCustomAttributes = "";

            // PAYMENT_DATE
            $this->PAYMENT_DATE->ViewValue = $this->PAYMENT_DATE->CurrentValue;
            $this->PAYMENT_DATE->ViewValue = FormatDateTime($this->PAYMENT_DATE->ViewValue, 11);
            $this->PAYMENT_DATE->ViewCustomAttributes = "";

            // ISLUNAS
            $this->ISLUNAS->ViewValue = $this->ISLUNAS->CurrentValue;
            $this->ISLUNAS->ViewCustomAttributes = "";

            // DUEDATE_ANGSURAN
            $this->DUEDATE_ANGSURAN->ViewValue = $this->DUEDATE_ANGSURAN->CurrentValue;
            $this->DUEDATE_ANGSURAN->ViewValue = FormatDateTime($this->DUEDATE_ANGSURAN->ViewValue, 0);
            $this->DUEDATE_ANGSURAN->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // KUITANSI_ID
            $this->KUITANSI_ID->ViewValue = $this->KUITANSI_ID->CurrentValue;
            $this->KUITANSI_ID->ViewCustomAttributes = "";

            // NOTA_NO
            $this->NOTA_NO->ViewValue = $this->NOTA_NO->CurrentValue;
            $this->NOTA_NO->ViewCustomAttributes = "";

            // ISCETAK
            $this->ISCETAK->ViewValue = $this->ISCETAK->CurrentValue;
            $this->ISCETAK->ViewCustomAttributes = "";

            // PRINT_DATE
            $this->PRINT_DATE->ViewValue = $this->PRINT_DATE->CurrentValue;
            $this->PRINT_DATE->ViewValue = FormatDateTime($this->PRINT_DATE->ViewValue, 0);
            $this->PRINT_DATE->ViewCustomAttributes = "";

            // RESEP_NO
            $this->RESEP_NO->ViewValue = $this->RESEP_NO->CurrentValue;
            $this->RESEP_NO->ViewCustomAttributes = "";

            // RESEP_KE
            $this->RESEP_KE->ViewValue = $this->RESEP_KE->CurrentValue;
            $this->RESEP_KE->ViewValue = FormatNumber($this->RESEP_KE->ViewValue, 0, -2, -2, -2);
            $this->RESEP_KE->ViewCustomAttributes = "";

            // DOSE
            $this->DOSE->ViewValue = $this->DOSE->CurrentValue;
            $this->DOSE->ViewValue = FormatNumber($this->DOSE->ViewValue, 2, -2, -2, -2);
            $this->DOSE->ViewCustomAttributes = "";

            // ORIG_DOSE
            $this->ORIG_DOSE->ViewValue = $this->ORIG_DOSE->CurrentValue;
            $this->ORIG_DOSE->ViewValue = FormatNumber($this->ORIG_DOSE->ViewValue, 2, -2, -2, -2);
            $this->ORIG_DOSE->ViewCustomAttributes = "";

            // DOSE_PRESC
            $this->DOSE_PRESC->ViewValue = $this->DOSE_PRESC->CurrentValue;
            $this->DOSE_PRESC->ViewValue = FormatNumber($this->DOSE_PRESC->ViewValue, 2, -2, -2, -2);
            $this->DOSE_PRESC->ViewCustomAttributes = "";

            // ITER
            $this->ITER->ViewValue = $this->ITER->CurrentValue;
            $this->ITER->ViewValue = FormatNumber($this->ITER->ViewValue, 0, -2, -2, -2);
            $this->ITER->ViewCustomAttributes = "";

            // ITER_KE
            $this->ITER_KE->ViewValue = $this->ITER_KE->CurrentValue;
            $this->ITER_KE->ViewValue = FormatNumber($this->ITER_KE->ViewValue, 0, -2, -2, -2);
            $this->ITER_KE->ViewCustomAttributes = "";

            // SOLD_STATUS
            $this->SOLD_STATUS->ViewValue = $this->SOLD_STATUS->CurrentValue;
            $this->SOLD_STATUS->ViewValue = FormatNumber($this->SOLD_STATUS->ViewValue, 0, -2, -2, -2);
            $this->SOLD_STATUS->ViewCustomAttributes = "";

            // RACIKAN
            $this->RACIKAN->ViewValue = $this->RACIKAN->CurrentValue;
            $this->RACIKAN->ViewValue = FormatNumber($this->RACIKAN->ViewValue, 0, -2, -2, -2);
            $this->RACIKAN->ViewCustomAttributes = "";

            // CLASS_ROOM_ID
            $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
            $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

            // KELUAR_ID
            $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->CurrentValue;
            $this->KELUAR_ID->ViewValue = FormatNumber($this->KELUAR_ID->ViewValue, 0, -2, -2, -2);
            $this->KELUAR_ID->ViewCustomAttributes = "";

            // BED_ID
            $this->BED_ID->ViewValue = $this->BED_ID->CurrentValue;
            $this->BED_ID->ViewValue = FormatNumber($this->BED_ID->ViewValue, 0, -2, -2, -2);
            $this->BED_ID->ViewCustomAttributes = "";

            // PERDA_ID
            $this->PERDA_ID->ViewValue = $this->PERDA_ID->CurrentValue;
            $this->PERDA_ID->ViewValue = FormatNumber($this->PERDA_ID->ViewValue, 0, -2, -2, -2);
            $this->PERDA_ID->ViewCustomAttributes = "";

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

            // DESCRIPTION2
            $this->DESCRIPTION2->ViewValue = $this->DESCRIPTION2->CurrentValue;
            $this->DESCRIPTION2->ViewCustomAttributes = "";

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

            // BRAND_ID
            $this->BRAND_ID->ViewValue = $this->BRAND_ID->CurrentValue;
            $this->BRAND_ID->ViewCustomAttributes = "";

            // DOCTOR
            $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
            $this->DOCTOR->ViewCustomAttributes = "";

            // JML_BKS
            $this->JML_BKS->ViewValue = $this->JML_BKS->CurrentValue;
            $this->JML_BKS->ViewValue = FormatNumber($this->JML_BKS->ViewValue, 0, -2, -2, -2);
            $this->JML_BKS->ViewCustomAttributes = "";

            // EXIT_DATE
            $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
            $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
            $this->EXIT_DATE->ViewCustomAttributes = "";

            // FA_V
            $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
            $this->FA_V->ViewValue = FormatNumber($this->FA_V->ViewValue, 0, -2, -2, -2);
            $this->FA_V->ViewCustomAttributes = "";

            // TASK_ID
            $this->TASK_ID->ViewValue = $this->TASK_ID->CurrentValue;
            $this->TASK_ID->ViewValue = FormatNumber($this->TASK_ID->ViewValue, 0, -2, -2, -2);
            $this->TASK_ID->ViewCustomAttributes = "";

            // EMPLOYEE_ID_FROM
            $this->EMPLOYEE_ID_FROM->ViewValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
            $this->EMPLOYEE_ID_FROM->ViewCustomAttributes = "";

            // DOCTOR_FROM
            $this->DOCTOR_FROM->ViewValue = $this->DOCTOR_FROM->CurrentValue;
            $this->DOCTOR_FROM->ViewCustomAttributes = "";

            // status_pasien_id
            $this->status_pasien_id->ViewValue = $this->status_pasien_id->CurrentValue;
            $this->status_pasien_id->ViewValue = FormatNumber($this->status_pasien_id->ViewValue, 0, -2, -2, -2);
            $this->status_pasien_id->ViewCustomAttributes = "";

            // amount_paid
            $this->amount_paid->ViewValue = $this->amount_paid->CurrentValue;
            $this->amount_paid->ViewValue = FormatNumber($this->amount_paid->ViewValue, 2, -2, -2, -2);
            $this->amount_paid->ViewCustomAttributes = "";

            // THENAME
            $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
            $this->THENAME->ViewCustomAttributes = "";

            // THEADDRESS
            $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
            $this->THEADDRESS->ViewCustomAttributes = "";

            // THEID
            $this->THEID->ViewValue = $this->THEID->CurrentValue;
            $this->THEID->ViewCustomAttributes = "";

            // serial_nb
            $this->serial_nb->ViewValue = $this->serial_nb->CurrentValue;
            $this->serial_nb->ViewCustomAttributes = "";

            // TREATMENT_PLAFOND
            $this->TREATMENT_PLAFOND->ViewValue = $this->TREATMENT_PLAFOND->CurrentValue;
            $this->TREATMENT_PLAFOND->ViewCustomAttributes = "";

            // AMOUNT_PLAFOND
            $this->AMOUNT_PLAFOND->ViewValue = $this->AMOUNT_PLAFOND->CurrentValue;
            $this->AMOUNT_PLAFOND->ViewValue = FormatNumber($this->AMOUNT_PLAFOND->ViewValue, 2, -2, -2, -2);
            $this->AMOUNT_PLAFOND->ViewCustomAttributes = "";

            // AMOUNT_PAID_PLAFOND
            $this->AMOUNT_PAID_PLAFOND->ViewValue = $this->AMOUNT_PAID_PLAFOND->CurrentValue;
            $this->AMOUNT_PAID_PLAFOND->ViewValue = FormatNumber($this->AMOUNT_PAID_PLAFOND->ViewValue, 2, -2, -2, -2);
            $this->AMOUNT_PAID_PLAFOND->ViewCustomAttributes = "";

            // CLASS_ID_PLAFOND
            $this->CLASS_ID_PLAFOND->ViewValue = $this->CLASS_ID_PLAFOND->CurrentValue;
            $this->CLASS_ID_PLAFOND->ViewValue = FormatNumber($this->CLASS_ID_PLAFOND->ViewValue, 0, -2, -2, -2);
            $this->CLASS_ID_PLAFOND->ViewCustomAttributes = "";

            // PAYOR_ID
            $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
            $this->PAYOR_ID->ViewCustomAttributes = "";

            // PEMBULATAN
            $this->PEMBULATAN->ViewValue = $this->PEMBULATAN->CurrentValue;
            $this->PEMBULATAN->ViewValue = FormatNumber($this->PEMBULATAN->ViewValue, 2, -2, -2, -2);
            $this->PEMBULATAN->ViewCustomAttributes = "";

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

            // KAL_ID
            $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
            $this->KAL_ID->ViewCustomAttributes = "";

            // CORRECTION_ID
            $this->CORRECTION_ID->ViewValue = $this->CORRECTION_ID->CurrentValue;
            $this->CORRECTION_ID->ViewCustomAttributes = "";

            // CORRECTION_BY
            $this->CORRECTION_BY->ViewValue = $this->CORRECTION_BY->CurrentValue;
            $this->CORRECTION_BY->ViewCustomAttributes = "";

            // KARYAWAN
            $this->KARYAWAN->ViewValue = $this->KARYAWAN->CurrentValue;
            $this->KARYAWAN->ViewCustomAttributes = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
            $this->ACCOUNT_ID->ViewCustomAttributes = "";

            // sell_price
            $this->sell_price->ViewValue = $this->sell_price->CurrentValue;
            $this->sell_price->ViewValue = FormatNumber($this->sell_price->ViewValue, 2, -2, -2, -2);
            $this->sell_price->ViewCustomAttributes = "";

            // diskon
            $this->diskon->ViewValue = $this->diskon->CurrentValue;
            $this->diskon->ViewValue = FormatNumber($this->diskon->ViewValue, 2, -2, -2, -2);
            $this->diskon->ViewCustomAttributes = "";

            // INVOICE_ID
            $this->INVOICE_ID->ViewValue = $this->INVOICE_ID->CurrentValue;
            $this->INVOICE_ID->ViewCustomAttributes = "";

            // NUMER
            $this->NUMER->ViewValue = $this->NUMER->CurrentValue;
            $this->NUMER->ViewCustomAttributes = "";

            // MEASURE_ID2
            $this->MEASURE_ID2->ViewValue = $this->MEASURE_ID2->CurrentValue;
            $this->MEASURE_ID2->ViewValue = FormatNumber($this->MEASURE_ID2->ViewValue, 0, -2, -2, -2);
            $this->MEASURE_ID2->ViewCustomAttributes = "";

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

            // STATUS_OBAT
            $this->STATUS_OBAT->ViewValue = $this->STATUS_OBAT->CurrentValue;
            $this->STATUS_OBAT->ViewValue = FormatNumber($this->STATUS_OBAT->ViewValue, 0, -2, -2, -2);
            $this->STATUS_OBAT->ViewCustomAttributes = "";

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

            // STOCK_AVAILABLE
            $this->STOCK_AVAILABLE->ViewValue = $this->STOCK_AVAILABLE->CurrentValue;
            $this->STOCK_AVAILABLE->ViewValue = FormatNumber($this->STOCK_AVAILABLE->ViewValue, 2, -2, -2, -2);
            $this->STOCK_AVAILABLE->ViewCustomAttributes = "";

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

            // profession
            $this->profession->ViewValue = $this->profession->CurrentValue;
            $this->profession->ViewValue = FormatNumber($this->profession->ViewValue, 2, -2, -2, -2);
            $this->profession->ViewCustomAttributes = "";

            // THEORDER
            $this->THEORDER->ViewValue = $this->THEORDER->CurrentValue;
            $this->THEORDER->ViewValue = FormatNumber($this->THEORDER->ViewValue, 0, -2, -2, -2);
            $this->THEORDER->ViewCustomAttributes = "";

            // CASHIER
            $this->CASHIER->ViewValue = $this->CASHIER->CurrentValue;
            $this->CASHIER->ViewCustomAttributes = "";

            // SPPFEE
            $this->SPPFEE->ViewValue = $this->SPPFEE->CurrentValue;
            $this->SPPFEE->ViewCustomAttributes = "";

            // SPPBILL
            $this->SPPBILL->ViewValue = $this->SPPBILL->CurrentValue;
            $this->SPPBILL->ViewCustomAttributes = "";

            // SPPRJK
            $this->SPPRJK->ViewValue = $this->SPPRJK->CurrentValue;
            $this->SPPRJK->ViewCustomAttributes = "";

            // SPPJMN
            $this->SPPJMN->ViewValue = $this->SPPJMN->CurrentValue;
            $this->SPPJMN->ViewCustomAttributes = "";

            // SPPKASIR
            $this->SPPKASIR->ViewValue = $this->SPPKASIR->CurrentValue;
            $this->SPPKASIR->ViewCustomAttributes = "";

            // PERUJUK
            $this->PERUJUK->ViewValue = $this->PERUJUK->CurrentValue;
            $this->PERUJUK->ViewCustomAttributes = "";

            // PERUJUKFEE
            $this->PERUJUKFEE->ViewValue = $this->PERUJUKFEE->CurrentValue;
            $this->PERUJUKFEE->ViewValue = FormatNumber($this->PERUJUKFEE->ViewValue, 2, -2, -2, -2);
            $this->PERUJUKFEE->ViewCustomAttributes = "";

            // modified_datesys
            $this->modified_datesys->ViewValue = $this->modified_datesys->CurrentValue;
            $this->modified_datesys->ViewValue = FormatDateTime($this->modified_datesys->ViewValue, 0);
            $this->modified_datesys->ViewCustomAttributes = "";

            // TRANS_ID
            $this->TRANS_ID->ViewValue = $this->TRANS_ID->CurrentValue;
            $this->TRANS_ID->ViewCustomAttributes = "";

            // SPPBILLDATE
            $this->SPPBILLDATE->ViewValue = $this->SPPBILLDATE->CurrentValue;
            $this->SPPBILLDATE->ViewValue = FormatDateTime($this->SPPBILLDATE->ViewValue, 0);
            $this->SPPBILLDATE->ViewCustomAttributes = "";

            // SPPBILLUSER
            $this->SPPBILLUSER->ViewValue = $this->SPPBILLUSER->CurrentValue;
            $this->SPPBILLUSER->ViewCustomAttributes = "";

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

            // nota_temp
            $this->nota_temp->ViewValue = $this->nota_temp->CurrentValue;
            $this->nota_temp->ViewCustomAttributes = "";

            // CLINIC_ID_TEMP
            $this->CLINIC_ID_TEMP->ViewValue = $this->CLINIC_ID_TEMP->CurrentValue;
            $this->CLINIC_ID_TEMP->ViewCustomAttributes = "";

            // NOSEP
            $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
            $this->NOSEP->ViewCustomAttributes = "";

            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // TARIF_ID
            $this->TARIF_ID->LinkCustomAttributes = "";
            $this->TARIF_ID->HrefValue = "";
            $this->TARIF_ID->TooltipValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";
            $this->CLINIC_ID->TooltipValue = "";

            // TREAT_DATE
            $this->TREAT_DATE->LinkCustomAttributes = "";
            $this->TREAT_DATE->HrefValue = "";
            $this->TREAT_DATE->TooltipValue = "";

            // QUANTITY
            $this->QUANTITY->LinkCustomAttributes = "";
            $this->QUANTITY->HrefValue = "";
            $this->QUANTITY->TooltipValue = "";

            // EMPLOYEE_ID
            $this->EMPLOYEE_ID->LinkCustomAttributes = "";
            $this->EMPLOYEE_ID->HrefValue = "";
            $this->EMPLOYEE_ID->TooltipValue = "";

            // amount_paid
            $this->amount_paid->LinkCustomAttributes = "";
            $this->amount_paid->HrefValue = "";
            $this->amount_paid->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $deleteRows = true;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAll($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }
        $conn->beginTransaction();

        // Clone old rows
        $rsold = $rows;

        // Call row deleting event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $deleteRows = $this->rowDeleting($row);
                if (!$deleteRows) {
                    break;
                }
            }
        }
        if ($deleteRows) {
            $key = "";
            foreach ($rsold as $row) {
                $thisKey = "";
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['ID'];
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }
                $deleteRows = $this->delete($row); // Delete
                if ($deleteRows === false) {
                    break;
                }
                if ($key != "") {
                    $key .= ", ";
                }
                $key .= $thisKey;
            }
        }
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }
        if ($deleteRows) {
            $conn->commit(); // Commit the changes
        } else {
            $conn->rollback(); // Rollback changes
        }

        // Call Row Deleted event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $this->rowDeleted($row);
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
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
            if ($masterTblVar == "V_LABORATORIUM") {
                $validMaster = true;
                $masterTbl = Container("V_LABORATORIUM");
                if (($parm = Get("fk_VISIT_ID", Get("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setQueryStringValue($parm);
                    $this->VISIT_ID->setQueryStringValue($masterTbl->VISIT_ID->QueryStringValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->QueryStringValue);
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "V_RADIOLOGI") {
                $validMaster = true;
                $masterTbl = Container("V_RADIOLOGI");
                if (($parm = Get("fk_VISIT_ID", Get("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setQueryStringValue($parm);
                    $this->VISIT_ID->setQueryStringValue($masterTbl->VISIT_ID->QueryStringValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->QueryStringValue);
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "V_FARMASI") {
                $validMaster = true;
                $masterTbl = Container("V_FARMASI");
                if (($parm = Get("fk_VISIT_ID", Get("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setQueryStringValue($parm);
                    $this->VISIT_ID->setQueryStringValue($masterTbl->VISIT_ID->QueryStringValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->QueryStringValue);
                } else {
                    $validMaster = false;
                }
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
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "V_LABORATORIUM") {
                $validMaster = true;
                $masterTbl = Container("V_LABORATORIUM");
                if (($parm = Post("fk_VISIT_ID", Post("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setFormValue($parm);
                    $this->VISIT_ID->setFormValue($masterTbl->VISIT_ID->FormValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->FormValue);
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "V_RADIOLOGI") {
                $validMaster = true;
                $masterTbl = Container("V_RADIOLOGI");
                if (($parm = Post("fk_VISIT_ID", Post("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setFormValue($parm);
                    $this->VISIT_ID->setFormValue($masterTbl->VISIT_ID->FormValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->FormValue);
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "V_FARMASI") {
                $validMaster = true;
                $masterTbl = Container("V_FARMASI");
                if (($parm = Post("fk_VISIT_ID", Post("VISIT_ID"))) !== null) {
                    $masterTbl->VISIT_ID->setFormValue($parm);
                    $this->VISIT_ID->setFormValue($masterTbl->VISIT_ID->FormValue);
                    $this->VISIT_ID->setSessionValue($this->VISIT_ID->FormValue);
                } else {
                    $validMaster = false;
                }
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
            if ($masterTblVar != "V_LABORATORIUM") {
                if ($this->VISIT_ID->CurrentValue == "") {
                    $this->VISIT_ID->setSessionValue("");
                }
            }
            if ($masterTblVar != "V_RADIOLOGI") {
                if ($this->VISIT_ID->CurrentValue == "") {
                    $this->VISIT_ID->setSessionValue("");
                }
            }
            if ($masterTblVar != "V_FARMASI") {
                if ($this->VISIT_ID->CurrentValue == "") {
                    $this->VISIT_ID->setSessionValue("");
                }
            }
            if ($masterTblVar != "V_KASIR") {
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("TreatmentBillList"), "", $this->TableVar, true);
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
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
                case "x_TARIF_ID":
                    $lookupFilter = function () {
                        return "[IMPLEMENTED] = 1";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_CLINIC_ID":
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
}
