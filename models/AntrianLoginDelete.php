<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class AntrianLoginDelete extends AntrianLogin
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'ANTRIAN_LOGIN';

    // Page object name
    public $PageObjName = "AntrianLoginDelete";

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

        // Table object (ANTRIAN_LOGIN)
        if (!isset($GLOBALS["ANTRIAN_LOGIN"]) || get_class($GLOBALS["ANTRIAN_LOGIN"]) == PROJECT_NAMESPACE . "ANTRIAN_LOGIN") {
            $GLOBALS["ANTRIAN_LOGIN"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'ANTRIAN_LOGIN');
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
                $doc = new $class(Container("ANTRIAN_LOGIN"));
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
        $this->ID->setVisibility();
        $this->NOMR->setVisibility();
        $this->NO_BPJS->setVisibility();
        $this->NAMA->setVisibility();
        $this->TEMPAT_LAHIR->setVisibility();
        $this->TANGGAL_LAHIR->setVisibility();
        $this->JENIS_KELAMIN->setVisibility();
        $this->AGAMA->setVisibility();
        $this->PEKERJAAN->setVisibility();
        $this->ALAMAT->setVisibility();
        $this->NO_TELP->setVisibility();
        $this->NO_HP->setVisibility();
        $this->_EMAIL->setVisibility();
        $this->FOTO->setVisibility();
        $this->TANGGAL_REGIS->setVisibility();
        $this->NAMA_IBU->setVisibility();
        $this->NAMA_AYAH->setVisibility();
        $this->NAMA_PASANGAN->setVisibility();
        $this->_PASSWORD->setVisibility();
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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("AntrianLoginList"); // Prevent SQL injection, return to list
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
                $this->terminate("AntrianLoginList"); // Return to list
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
        $this->ID->setDbValue($row['ID']);
        $this->NOMR->setDbValue($row['NOMR']);
        $this->NO_BPJS->setDbValue($row['NO_BPJS']);
        $this->NAMA->setDbValue($row['NAMA']);
        $this->TEMPAT_LAHIR->setDbValue($row['TEMPAT_LAHIR']);
        $this->TANGGAL_LAHIR->setDbValue($row['TANGGAL_LAHIR']);
        $this->JENIS_KELAMIN->setDbValue($row['JENIS_KELAMIN']);
        $this->AGAMA->setDbValue($row['AGAMA']);
        $this->PEKERJAAN->setDbValue($row['PEKERJAAN']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->NO_TELP->setDbValue($row['NO_TELP']);
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->FOTO->setDbValue($row['FOTO']);
        $this->TANGGAL_REGIS->setDbValue($row['TANGGAL_REGIS']);
        $this->NAMA_IBU->setDbValue($row['NAMA_IBU']);
        $this->NAMA_AYAH->setDbValue($row['NAMA_AYAH']);
        $this->NAMA_PASANGAN->setDbValue($row['NAMA_PASANGAN']);
        $this->_PASSWORD->setDbValue($row['PASSWORD']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ID'] = null;
        $row['NOMR'] = null;
        $row['NO_BPJS'] = null;
        $row['NAMA'] = null;
        $row['TEMPAT_LAHIR'] = null;
        $row['TANGGAL_LAHIR'] = null;
        $row['JENIS_KELAMIN'] = null;
        $row['AGAMA'] = null;
        $row['PEKERJAAN'] = null;
        $row['ALAMAT'] = null;
        $row['NO_TELP'] = null;
        $row['NO_HP'] = null;
        $row['EMAIL'] = null;
        $row['FOTO'] = null;
        $row['TANGGAL_REGIS'] = null;
        $row['NAMA_IBU'] = null;
        $row['NAMA_AYAH'] = null;
        $row['NAMA_PASANGAN'] = null;
        $row['PASSWORD'] = null;
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

        // ID

        // NOMR

        // NO_BPJS

        // NAMA

        // TEMPAT_LAHIR

        // TANGGAL_LAHIR

        // JENIS_KELAMIN

        // AGAMA

        // PEKERJAAN

        // ALAMAT

        // NO_TELP

        // NO_HP

        // EMAIL

        // FOTO

        // TANGGAL_REGIS

        // NAMA_IBU

        // NAMA_AYAH

        // NAMA_PASANGAN

        // PASSWORD
        if ($this->RowType == ROWTYPE_VIEW) {
            // ID
            $this->ID->ViewValue = $this->ID->CurrentValue;
            $this->ID->ViewCustomAttributes = "";

            // NOMR
            $this->NOMR->ViewValue = $this->NOMR->CurrentValue;
            $this->NOMR->ViewCustomAttributes = "";

            // NO_BPJS
            $this->NO_BPJS->ViewValue = $this->NO_BPJS->CurrentValue;
            $this->NO_BPJS->ViewCustomAttributes = "";

            // NAMA
            $this->NAMA->ViewValue = $this->NAMA->CurrentValue;
            $this->NAMA->ViewCustomAttributes = "";

            // TEMPAT_LAHIR
            $this->TEMPAT_LAHIR->ViewValue = $this->TEMPAT_LAHIR->CurrentValue;
            $this->TEMPAT_LAHIR->ViewCustomAttributes = "";

            // TANGGAL_LAHIR
            $this->TANGGAL_LAHIR->ViewValue = $this->TANGGAL_LAHIR->CurrentValue;
            $this->TANGGAL_LAHIR->ViewValue = FormatDateTime($this->TANGGAL_LAHIR->ViewValue, 0);
            $this->TANGGAL_LAHIR->ViewCustomAttributes = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->ViewValue = $this->JENIS_KELAMIN->CurrentValue;
            $this->JENIS_KELAMIN->ViewCustomAttributes = "";

            // AGAMA
            $this->AGAMA->ViewValue = $this->AGAMA->CurrentValue;
            $this->AGAMA->ViewValue = FormatNumber($this->AGAMA->ViewValue, 0, -2, -2, -2);
            $this->AGAMA->ViewCustomAttributes = "";

            // PEKERJAAN
            $this->PEKERJAAN->ViewValue = $this->PEKERJAAN->CurrentValue;
            $this->PEKERJAAN->ViewValue = FormatNumber($this->PEKERJAAN->ViewValue, 0, -2, -2, -2);
            $this->PEKERJAAN->ViewCustomAttributes = "";

            // ALAMAT
            $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
            $this->ALAMAT->ViewCustomAttributes = "";

            // NO_TELP
            $this->NO_TELP->ViewValue = $this->NO_TELP->CurrentValue;
            $this->NO_TELP->ViewCustomAttributes = "";

            // NO_HP
            $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
            $this->NO_HP->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // FOTO
            $this->FOTO->ViewValue = $this->FOTO->CurrentValue;
            $this->FOTO->ViewCustomAttributes = "";

            // TANGGAL_REGIS
            $this->TANGGAL_REGIS->ViewValue = $this->TANGGAL_REGIS->CurrentValue;
            $this->TANGGAL_REGIS->ViewValue = FormatDateTime($this->TANGGAL_REGIS->ViewValue, 0);
            $this->TANGGAL_REGIS->ViewCustomAttributes = "";

            // NAMA_IBU
            $this->NAMA_IBU->ViewValue = $this->NAMA_IBU->CurrentValue;
            $this->NAMA_IBU->ViewCustomAttributes = "";

            // NAMA_AYAH
            $this->NAMA_AYAH->ViewValue = $this->NAMA_AYAH->CurrentValue;
            $this->NAMA_AYAH->ViewCustomAttributes = "";

            // NAMA_PASANGAN
            $this->NAMA_PASANGAN->ViewValue = $this->NAMA_PASANGAN->CurrentValue;
            $this->NAMA_PASANGAN->ViewCustomAttributes = "";

            // PASSWORD
            $this->_PASSWORD->ViewValue = $this->_PASSWORD->CurrentValue;
            $this->_PASSWORD->ViewCustomAttributes = "";

            // ID
            $this->ID->LinkCustomAttributes = "";
            $this->ID->HrefValue = "";
            $this->ID->TooltipValue = "";

            // NOMR
            $this->NOMR->LinkCustomAttributes = "";
            $this->NOMR->HrefValue = "";
            $this->NOMR->TooltipValue = "";

            // NO_BPJS
            $this->NO_BPJS->LinkCustomAttributes = "";
            $this->NO_BPJS->HrefValue = "";
            $this->NO_BPJS->TooltipValue = "";

            // NAMA
            $this->NAMA->LinkCustomAttributes = "";
            $this->NAMA->HrefValue = "";
            $this->NAMA->TooltipValue = "";

            // TEMPAT_LAHIR
            $this->TEMPAT_LAHIR->LinkCustomAttributes = "";
            $this->TEMPAT_LAHIR->HrefValue = "";
            $this->TEMPAT_LAHIR->TooltipValue = "";

            // TANGGAL_LAHIR
            $this->TANGGAL_LAHIR->LinkCustomAttributes = "";
            $this->TANGGAL_LAHIR->HrefValue = "";
            $this->TANGGAL_LAHIR->TooltipValue = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->LinkCustomAttributes = "";
            $this->JENIS_KELAMIN->HrefValue = "";
            $this->JENIS_KELAMIN->TooltipValue = "";

            // AGAMA
            $this->AGAMA->LinkCustomAttributes = "";
            $this->AGAMA->HrefValue = "";
            $this->AGAMA->TooltipValue = "";

            // PEKERJAAN
            $this->PEKERJAAN->LinkCustomAttributes = "";
            $this->PEKERJAAN->HrefValue = "";
            $this->PEKERJAAN->TooltipValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";
            $this->ALAMAT->TooltipValue = "";

            // NO_TELP
            $this->NO_TELP->LinkCustomAttributes = "";
            $this->NO_TELP->HrefValue = "";
            $this->NO_TELP->TooltipValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";
            $this->NO_HP->TooltipValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";
            $this->_EMAIL->TooltipValue = "";

            // FOTO
            $this->FOTO->LinkCustomAttributes = "";
            $this->FOTO->HrefValue = "";
            $this->FOTO->TooltipValue = "";

            // TANGGAL_REGIS
            $this->TANGGAL_REGIS->LinkCustomAttributes = "";
            $this->TANGGAL_REGIS->HrefValue = "";
            $this->TANGGAL_REGIS->TooltipValue = "";

            // NAMA_IBU
            $this->NAMA_IBU->LinkCustomAttributes = "";
            $this->NAMA_IBU->HrefValue = "";
            $this->NAMA_IBU->TooltipValue = "";

            // NAMA_AYAH
            $this->NAMA_AYAH->LinkCustomAttributes = "";
            $this->NAMA_AYAH->HrefValue = "";
            $this->NAMA_AYAH->TooltipValue = "";

            // NAMA_PASANGAN
            $this->NAMA_PASANGAN->LinkCustomAttributes = "";
            $this->NAMA_PASANGAN->HrefValue = "";
            $this->NAMA_PASANGAN->TooltipValue = "";

            // PASSWORD
            $this->_PASSWORD->LinkCustomAttributes = "";
            $this->_PASSWORD->HrefValue = "";
            $this->_PASSWORD->TooltipValue = "";
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("AntrianLoginList"), "", $this->TableVar, true);
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
