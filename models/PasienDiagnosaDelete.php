<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienDiagnosaDelete extends PasienDiagnosa
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'PASIEN_DIAGNOSA';

    // Page object name
    public $PageObjName = "PasienDiagnosaDelete";

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

        // Table object (PASIEN_DIAGNOSA)
        if (!isset($GLOBALS["PASIEN_DIAGNOSA"]) || get_class($GLOBALS["PASIEN_DIAGNOSA"]) == PROJECT_NAMESPACE . "PASIEN_DIAGNOSA") {
            $GLOBALS["PASIEN_DIAGNOSA"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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

        // Set up master/detail parameters
        $this->setupMasterParms();

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("PasienDiagnosaList"); // Prevent SQL injection, return to list
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
                $this->terminate("PasienDiagnosaList"); // Return to list
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

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PasienDiagnosaList"), "", $this->TableVar, true);
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
