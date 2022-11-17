<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class FamilyDelete extends Family
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'FAMILY';

    // Page object name
    public $PageObjName = "FamilyDelete";

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

        // Table object (FAMILY)
        if (!isset($GLOBALS["FAMILY"]) || get_class($GLOBALS["FAMILY"]) == PROJECT_NAMESPACE . "FAMILY") {
            $GLOBALS["FAMILY"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'FAMILY');
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
                $doc = new $class(Container("FAMILY"));
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
            $key .= @$ar['ORG_UNIT_CODE'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['NO_REGISTRATION'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['FAMILY_ID'];
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
        $this->ORG_UNIT_CODE->setVisibility();
        $this->NO_REGISTRATION->setVisibility();
        $this->FAMILY_ID->setVisibility();
        $this->FAMILY_STATUS_ID->setVisibility();
        $this->NO_REGISTRATION2->setVisibility();
        $this->FULLNAME->setVisibility();
        $this->ISRESPONSIBLE->setVisibility();
        $this->GENDER->setVisibility();
        $this->DATE_OF_BIRTH->setVisibility();
        $this->PLACE_OF_BIRTH->setVisibility();
        $this->KODE_AGAMA->setVisibility();
        $this->EDUCATION_TYPE_CODE->setVisibility();
        $this->JOB_ID->setVisibility();
        $this->BLOOD_ID->setVisibility();
        $this->MARITALSTATUSID->setVisibility();
        $this->ADDRESS->setVisibility();
        $this->KOTA->setVisibility();
        $this->RT->setVisibility();
        $this->RW->setVisibility();
        $this->PHONE->setVisibility();
        $this->MOBILE->setVisibility();
        $this->FAX->setVisibility();
        $this->_EMAIL->setVisibility();
        $this->DESCRIPTION->setVisibility();
        $this->MODIFIED_DATE->setVisibility();
        $this->MODIFIED_BY->setVisibility();
        $this->MODIFIED_FROM->setVisibility();
        $this->COUNTRY_CODE->setVisibility();
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
            $this->terminate("FamilyList"); // Prevent SQL injection, return to list
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
                $this->terminate("FamilyList"); // Return to list
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
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->FAMILY_ID->setDbValue($row['FAMILY_ID']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->NO_REGISTRATION2->setDbValue($row['NO_REGISTRATION2']);
        $this->FULLNAME->setDbValue($row['FULLNAME']);
        $this->ISRESPONSIBLE->setDbValue($row['ISRESPONSIBLE']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DATE_OF_BIRTH->setDbValue($row['DATE_OF_BIRTH']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->EDUCATION_TYPE_CODE->setDbValue($row['EDUCATION_TYPE_CODE']);
        $this->JOB_ID->setDbValue($row['JOB_ID']);
        $this->BLOOD_ID->setDbValue($row['BLOOD_ID']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->ADDRESS->setDbValue($row['ADDRESS']);
        $this->KOTA->setDbValue($row['KOTA']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->FAX->setDbValue($row['FAX']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->COUNTRY_CODE->setDbValue($row['COUNTRY_CODE']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ORG_UNIT_CODE'] = null;
        $row['NO_REGISTRATION'] = null;
        $row['FAMILY_ID'] = null;
        $row['FAMILY_STATUS_ID'] = null;
        $row['NO_REGISTRATION2'] = null;
        $row['FULLNAME'] = null;
        $row['ISRESPONSIBLE'] = null;
        $row['GENDER'] = null;
        $row['DATE_OF_BIRTH'] = null;
        $row['PLACE_OF_BIRTH'] = null;
        $row['KODE_AGAMA'] = null;
        $row['EDUCATION_TYPE_CODE'] = null;
        $row['JOB_ID'] = null;
        $row['BLOOD_ID'] = null;
        $row['MARITALSTATUSID'] = null;
        $row['ADDRESS'] = null;
        $row['KOTA'] = null;
        $row['RT'] = null;
        $row['RW'] = null;
        $row['PHONE'] = null;
        $row['MOBILE'] = null;
        $row['FAX'] = null;
        $row['EMAIL'] = null;
        $row['DESCRIPTION'] = null;
        $row['MODIFIED_DATE'] = null;
        $row['MODIFIED_BY'] = null;
        $row['MODIFIED_FROM'] = null;
        $row['COUNTRY_CODE'] = null;
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

        // NO_REGISTRATION

        // FAMILY_ID

        // FAMILY_STATUS_ID

        // NO_REGISTRATION2

        // FULLNAME

        // ISRESPONSIBLE

        // GENDER

        // DATE_OF_BIRTH

        // PLACE_OF_BIRTH

        // KODE_AGAMA

        // EDUCATION_TYPE_CODE

        // JOB_ID

        // BLOOD_ID

        // MARITALSTATUSID

        // ADDRESS

        // KOTA

        // RT

        // RW

        // PHONE

        // MOBILE

        // FAX

        // EMAIL

        // DESCRIPTION

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // COUNTRY_CODE
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // FAMILY_ID
            $this->FAMILY_ID->ViewValue = $this->FAMILY_ID->CurrentValue;
            $this->FAMILY_ID->ViewValue = FormatNumber($this->FAMILY_ID->ViewValue, 0, -2, -2, -2);
            $this->FAMILY_ID->ViewCustomAttributes = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
            $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
            $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

            // NO_REGISTRATION2
            $this->NO_REGISTRATION2->ViewValue = $this->NO_REGISTRATION2->CurrentValue;
            $this->NO_REGISTRATION2->ViewCustomAttributes = "";

            // FULLNAME
            $this->FULLNAME->ViewValue = $this->FULLNAME->CurrentValue;
            $this->FULLNAME->ViewCustomAttributes = "";

            // ISRESPONSIBLE
            $this->ISRESPONSIBLE->ViewValue = $this->ISRESPONSIBLE->CurrentValue;
            $this->ISRESPONSIBLE->ViewCustomAttributes = "";

            // GENDER
            $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
            $this->GENDER->ViewCustomAttributes = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->ViewValue = $this->DATE_OF_BIRTH->CurrentValue;
            $this->DATE_OF_BIRTH->ViewValue = FormatDateTime($this->DATE_OF_BIRTH->ViewValue, 0);
            $this->DATE_OF_BIRTH->ViewCustomAttributes = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
            $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->CurrentValue;
            $this->KODE_AGAMA->ViewValue = FormatNumber($this->KODE_AGAMA->ViewValue, 0, -2, -2, -2);
            $this->KODE_AGAMA->ViewCustomAttributes = "";

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
            $this->EDUCATION_TYPE_CODE->ViewValue = FormatNumber($this->EDUCATION_TYPE_CODE->ViewValue, 0, -2, -2, -2);
            $this->EDUCATION_TYPE_CODE->ViewCustomAttributes = "";

            // JOB_ID
            $this->JOB_ID->ViewValue = $this->JOB_ID->CurrentValue;
            $this->JOB_ID->ViewValue = FormatNumber($this->JOB_ID->ViewValue, 0, -2, -2, -2);
            $this->JOB_ID->ViewCustomAttributes = "";

            // BLOOD_ID
            $this->BLOOD_ID->ViewValue = $this->BLOOD_ID->CurrentValue;
            $this->BLOOD_ID->ViewValue = FormatNumber($this->BLOOD_ID->ViewValue, 0, -2, -2, -2);
            $this->BLOOD_ID->ViewCustomAttributes = "";

            // MARITALSTATUSID
            $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
            $this->MARITALSTATUSID->ViewValue = FormatNumber($this->MARITALSTATUSID->ViewValue, 0, -2, -2, -2);
            $this->MARITALSTATUSID->ViewCustomAttributes = "";

            // ADDRESS
            $this->ADDRESS->ViewValue = $this->ADDRESS->CurrentValue;
            $this->ADDRESS->ViewCustomAttributes = "";

            // KOTA
            $this->KOTA->ViewValue = $this->KOTA->CurrentValue;
            $this->KOTA->ViewCustomAttributes = "";

            // RT
            $this->RT->ViewValue = $this->RT->CurrentValue;
            $this->RT->ViewCustomAttributes = "";

            // RW
            $this->RW->ViewValue = $this->RW->CurrentValue;
            $this->RW->ViewCustomAttributes = "";

            // PHONE
            $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
            $this->PHONE->ViewCustomAttributes = "";

            // MOBILE
            $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
            $this->MOBILE->ViewCustomAttributes = "";

            // FAX
            $this->FAX->ViewValue = $this->FAX->CurrentValue;
            $this->FAX->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

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

            // COUNTRY_CODE
            $this->COUNTRY_CODE->ViewValue = $this->COUNTRY_CODE->CurrentValue;
            $this->COUNTRY_CODE->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // FAMILY_ID
            $this->FAMILY_ID->LinkCustomAttributes = "";
            $this->FAMILY_ID->HrefValue = "";
            $this->FAMILY_ID->TooltipValue = "";

            // FAMILY_STATUS_ID
            $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
            $this->FAMILY_STATUS_ID->HrefValue = "";
            $this->FAMILY_STATUS_ID->TooltipValue = "";

            // NO_REGISTRATION2
            $this->NO_REGISTRATION2->LinkCustomAttributes = "";
            $this->NO_REGISTRATION2->HrefValue = "";
            $this->NO_REGISTRATION2->TooltipValue = "";

            // FULLNAME
            $this->FULLNAME->LinkCustomAttributes = "";
            $this->FULLNAME->HrefValue = "";
            $this->FULLNAME->TooltipValue = "";

            // ISRESPONSIBLE
            $this->ISRESPONSIBLE->LinkCustomAttributes = "";
            $this->ISRESPONSIBLE->HrefValue = "";
            $this->ISRESPONSIBLE->TooltipValue = "";

            // GENDER
            $this->GENDER->LinkCustomAttributes = "";
            $this->GENDER->HrefValue = "";
            $this->GENDER->TooltipValue = "";

            // DATE_OF_BIRTH
            $this->DATE_OF_BIRTH->LinkCustomAttributes = "";
            $this->DATE_OF_BIRTH->HrefValue = "";
            $this->DATE_OF_BIRTH->TooltipValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";
            $this->PLACE_OF_BIRTH->TooltipValue = "";

            // KODE_AGAMA
            $this->KODE_AGAMA->LinkCustomAttributes = "";
            $this->KODE_AGAMA->HrefValue = "";
            $this->KODE_AGAMA->TooltipValue = "";

            // EDUCATION_TYPE_CODE
            $this->EDUCATION_TYPE_CODE->LinkCustomAttributes = "";
            $this->EDUCATION_TYPE_CODE->HrefValue = "";
            $this->EDUCATION_TYPE_CODE->TooltipValue = "";

            // JOB_ID
            $this->JOB_ID->LinkCustomAttributes = "";
            $this->JOB_ID->HrefValue = "";
            $this->JOB_ID->TooltipValue = "";

            // BLOOD_ID
            $this->BLOOD_ID->LinkCustomAttributes = "";
            $this->BLOOD_ID->HrefValue = "";
            $this->BLOOD_ID->TooltipValue = "";

            // MARITALSTATUSID
            $this->MARITALSTATUSID->LinkCustomAttributes = "";
            $this->MARITALSTATUSID->HrefValue = "";
            $this->MARITALSTATUSID->TooltipValue = "";

            // ADDRESS
            $this->ADDRESS->LinkCustomAttributes = "";
            $this->ADDRESS->HrefValue = "";
            $this->ADDRESS->TooltipValue = "";

            // KOTA
            $this->KOTA->LinkCustomAttributes = "";
            $this->KOTA->HrefValue = "";
            $this->KOTA->TooltipValue = "";

            // RT
            $this->RT->LinkCustomAttributes = "";
            $this->RT->HrefValue = "";
            $this->RT->TooltipValue = "";

            // RW
            $this->RW->LinkCustomAttributes = "";
            $this->RW->HrefValue = "";
            $this->RW->TooltipValue = "";

            // PHONE
            $this->PHONE->LinkCustomAttributes = "";
            $this->PHONE->HrefValue = "";
            $this->PHONE->TooltipValue = "";

            // MOBILE
            $this->MOBILE->LinkCustomAttributes = "";
            $this->MOBILE->HrefValue = "";
            $this->MOBILE->TooltipValue = "";

            // FAX
            $this->FAX->LinkCustomAttributes = "";
            $this->FAX->HrefValue = "";
            $this->FAX->TooltipValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";
            $this->_EMAIL->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";
            $this->DESCRIPTION->TooltipValue = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->LinkCustomAttributes = "";
            $this->MODIFIED_DATE->HrefValue = "";
            $this->MODIFIED_DATE->TooltipValue = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->LinkCustomAttributes = "";
            $this->MODIFIED_BY->HrefValue = "";
            $this->MODIFIED_BY->TooltipValue = "";

            // MODIFIED_FROM
            $this->MODIFIED_FROM->LinkCustomAttributes = "";
            $this->MODIFIED_FROM->HrefValue = "";
            $this->MODIFIED_FROM->TooltipValue = "";

            // COUNTRY_CODE
            $this->COUNTRY_CODE->LinkCustomAttributes = "";
            $this->COUNTRY_CODE->HrefValue = "";
            $this->COUNTRY_CODE->TooltipValue = "";
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
                $thisKey .= $row['ORG_UNIT_CODE'];
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['NO_REGISTRATION'];
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['FAMILY_ID'];
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("FamilyList"), "", $this->TableVar, true);
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
