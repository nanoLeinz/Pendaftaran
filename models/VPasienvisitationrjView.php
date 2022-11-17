<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class VPasienvisitationrjView extends VPasienvisitationrj
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'V_PASIENVISITATIONRJ';

    // Page object name
    public $PageObjName = "VPasienvisitationrjView";

    // Rendering View
    public $RenderingView = false;

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

        // Table object (V_PASIENVISITATIONRJ)
        if (!isset($GLOBALS["V_PASIENVISITATIONRJ"]) || get_class($GLOBALS["V_PASIENVISITATIONRJ"]) == PROJECT_NAMESPACE . "V_PASIENVISITATIONRJ") {
            $GLOBALS["V_PASIENVISITATIONRJ"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        if (($keyValue = Get("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
            $this->RecKey["NO_REGISTRATION"] = $keyValue;
        }
        if (($keyValue = Get("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
            $this->RecKey["ORG_UNIT_CODE"] = $keyValue;
        }
        if (($keyValue = Get("visit_id") ?? Route("visit_id")) !== null) {
            $this->RecKey["visit_id"] = $keyValue;
        }
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'V_PASIENVISITATIONRJ');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
                $doc = new $class(Container("V_PASIENVISITATIONRJ"));
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
                    if ($pageName == "VPasienvisitationrjView") {
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
            $key .= @$ar['NO_REGISTRATION'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['ORG_UNIT_CODE'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['visit_id'];
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
            $this->KALURAHAN->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->clinic_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->name_of_clinic->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->clinic_id_from->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->fullname->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->employee_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->employee_id_from->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->booked_Date->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->visit_date->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->visit_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->isattended->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->diantar_oleh->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->visitor_address->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->address_of_rujukan->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->rujukan_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->DESCRIPTION->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->patient_category_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->payor_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->reason_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->STATUS_PASIEN_ID->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->way_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->follow_up->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->isnew->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->family_status_id->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->urutan->Visible = false;
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
    public $ExportOptions; // Export options
    public $OtherOptions; // Other options
    public $DisplayRecords = 1;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecKey = [];
    public $IsModal = false;

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
        $this->CurrentAction = Param("action"); // Set up current action
        $this->NAME_OF_PASIEN->setVisibility();
        $this->NO_REGISTRATION->setVisibility();
        $this->ORG_UNIT_CODE->setVisibility();
        $this->date_of_birth->setVisibility();
        $this->CONTACT_ADDRESS->setVisibility();
        $this->PHONE_NUMBER->setVisibility();
        $this->MOBILE->setVisibility();
        $this->KAL_ID->setVisibility();
        $this->PLACE_OF_BIRTH->setVisibility();
        $this->KALURAHAN->setVisibility();
        $this->clinic_id->setVisibility();
        $this->name_of_clinic->setVisibility();
        $this->clinic_id_from->setVisibility();
        $this->fullname->setVisibility();
        $this->employee_id->setVisibility();
        $this->employee_id_from->setVisibility();
        $this->booked_Date->setVisibility();
        $this->visit_date->setVisibility();
        $this->visit_id->setVisibility();
        $this->isattended->setVisibility();
        $this->diantar_oleh->setVisibility();
        $this->visitor_address->setVisibility();
        $this->address_of_rujukan->setVisibility();
        $this->rujukan_id->setVisibility();
        $this->DESCRIPTION->setVisibility();
        $this->patient_category_id->setVisibility();
        $this->payor_id->setVisibility();
        $this->reason_id->setVisibility();
        $this->STATUS_PASIEN_ID->setVisibility();
        $this->way_id->setVisibility();
        $this->follow_up->setVisibility();
        $this->isnew->setVisibility();
        $this->family_status_id->setVisibility();
        $this->urutan->setVisibility();
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

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }

        // Load current record
        $loadCurrentRecord = false;
        $returnUrl = "";
        $matchRecord = false;
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
                $this->NO_REGISTRATION->setQueryStringValue($keyValue);
                $this->RecKey["NO_REGISTRATION"] = $this->NO_REGISTRATION->QueryStringValue;
            } elseif (Post("NO_REGISTRATION") !== null) {
                $this->NO_REGISTRATION->setFormValue(Post("NO_REGISTRATION"));
                $this->RecKey["NO_REGISTRATION"] = $this->NO_REGISTRATION->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->NO_REGISTRATION->setQueryStringValue($keyValue);
                $this->RecKey["NO_REGISTRATION"] = $this->NO_REGISTRATION->QueryStringValue;
            } else {
                $returnUrl = "VPasienvisitationrjList"; // Return to list
            }
            if (($keyValue = Get("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
                $this->ORG_UNIT_CODE->setQueryStringValue($keyValue);
                $this->RecKey["ORG_UNIT_CODE"] = $this->ORG_UNIT_CODE->QueryStringValue;
            } elseif (Post("ORG_UNIT_CODE") !== null) {
                $this->ORG_UNIT_CODE->setFormValue(Post("ORG_UNIT_CODE"));
                $this->RecKey["ORG_UNIT_CODE"] = $this->ORG_UNIT_CODE->FormValue;
            } elseif (IsApi() && ($keyValue = Key(1) ?? Route(3)) !== null) {
                $this->ORG_UNIT_CODE->setQueryStringValue($keyValue);
                $this->RecKey["ORG_UNIT_CODE"] = $this->ORG_UNIT_CODE->QueryStringValue;
            } else {
                $returnUrl = "VPasienvisitationrjList"; // Return to list
            }
            if (($keyValue = Get("visit_id") ?? Route("visit_id")) !== null) {
                $this->visit_id->setQueryStringValue($keyValue);
                $this->RecKey["visit_id"] = $this->visit_id->QueryStringValue;
            } elseif (Post("visit_id") !== null) {
                $this->visit_id->setFormValue(Post("visit_id"));
                $this->RecKey["visit_id"] = $this->visit_id->FormValue;
            } elseif (IsApi() && ($keyValue = Key(2) ?? Route(4)) !== null) {
                $this->visit_id->setQueryStringValue($keyValue);
                $this->RecKey["visit_id"] = $this->visit_id->QueryStringValue;
            } else {
                $returnUrl = "VPasienvisitationrjList"; // Return to list
            }

            // Get action
            $this->CurrentAction = "show"; // Display
            switch ($this->CurrentAction) {
                case "show": // Get a record to display

                    // Load record based on key
                    if (IsApi()) {
                        $filter = $this->getRecordFilter();
                        $this->CurrentFilter = $filter;
                        $sql = $this->getCurrentSql();
                        $conn = $this->getConnection();
                        $this->Recordset = LoadRecordset($sql, $conn);
                        $res = $this->Recordset && !$this->Recordset->EOF;
                    } else {
                        $res = $this->loadRow();
                    }
                    if (!$res) { // Load record based on key
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $returnUrl = "VPasienvisitationrjList"; // No matching record, return to list
                    }
                    break;
            }
        } else {
            $returnUrl = "VPasienvisitationrjList"; // Not page request, return to list
        }
        if ($returnUrl != "") {
            $this->terminate($returnUrl);
            return;
        }

        // Set up Breadcrumb
        if (!$this->isExport()) {
            $this->setupBreadcrumb();
        }

        // Render row
        $this->RowType = ROWTYPE_VIEW;
        $this->resetAttributes();
        $this->renderRow();

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset, true); // Get current record only
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows]);
            $this->terminate(true);
            return;
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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        }
        $item->Visible = ($this->AddUrl != "" && $Security->canAdd());

        // Edit
        $item = &$option->add("edit");
        $editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->EditUrl)) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        }
        $item->Visible = ($this->EditUrl != "" && $Security->canEdit());

        // Set up action default
        $option = $options["action"];
        $option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
        $option->UseDropDownButton = false;
        $option->UseButtonGroup = true;
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
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
        $this->NAME_OF_PASIEN->setDbValue($row['NAME_OF_PASIEN']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->date_of_birth->setDbValue($row['date_of_birth']);
        $this->CONTACT_ADDRESS->setDbValue($row['CONTACT_ADDRESS']);
        $this->PHONE_NUMBER->setDbValue($row['PHONE_NUMBER']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->clinic_id->setDbValue($row['clinic_id']);
        $this->name_of_clinic->setDbValue($row['name_of_clinic']);
        $this->clinic_id_from->setDbValue($row['clinic_id_from']);
        $this->fullname->setDbValue($row['fullname']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->employee_id_from->setDbValue($row['employee_id_from']);
        $this->booked_Date->setDbValue($row['booked_Date']);
        $this->visit_date->setDbValue($row['visit_date']);
        $this->visit_id->setDbValue($row['visit_id']);
        $this->isattended->setDbValue($row['isattended']);
        $this->diantar_oleh->setDbValue($row['diantar_oleh']);
        $this->visitor_address->setDbValue($row['visitor_address']);
        $this->address_of_rujukan->setDbValue($row['address_of_rujukan']);
        $this->rujukan_id->setDbValue($row['rujukan_id']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->patient_category_id->setDbValue($row['patient_category_id']);
        $this->payor_id->setDbValue($row['payor_id']);
        $this->reason_id->setDbValue($row['reason_id']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->way_id->setDbValue($row['way_id']);
        $this->follow_up->setDbValue($row['follow_up']);
        $this->isnew->setDbValue($row['isnew']);
        $this->family_status_id->setDbValue($row['family_status_id']);
        $this->urutan->setDbValue($row['urutan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NAME_OF_PASIEN'] = null;
        $row['NO_REGISTRATION'] = null;
        $row['ORG_UNIT_CODE'] = null;
        $row['date_of_birth'] = null;
        $row['CONTACT_ADDRESS'] = null;
        $row['PHONE_NUMBER'] = null;
        $row['MOBILE'] = null;
        $row['KAL_ID'] = null;
        $row['PLACE_OF_BIRTH'] = null;
        $row['KALURAHAN'] = null;
        $row['clinic_id'] = null;
        $row['name_of_clinic'] = null;
        $row['clinic_id_from'] = null;
        $row['fullname'] = null;
        $row['employee_id'] = null;
        $row['employee_id_from'] = null;
        $row['booked_Date'] = null;
        $row['visit_date'] = null;
        $row['visit_id'] = null;
        $row['isattended'] = null;
        $row['diantar_oleh'] = null;
        $row['visitor_address'] = null;
        $row['address_of_rujukan'] = null;
        $row['rujukan_id'] = null;
        $row['DESCRIPTION'] = null;
        $row['patient_category_id'] = null;
        $row['payor_id'] = null;
        $row['reason_id'] = null;
        $row['STATUS_PASIEN_ID'] = null;
        $row['way_id'] = null;
        $row['follow_up'] = null;
        $row['isnew'] = null;
        $row['family_status_id'] = null;
        $row['urutan'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->AddUrl = $this->getAddUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();
        $this->ListUrl = $this->getListUrl();
        $this->setupOtherOptions();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NAME_OF_PASIEN

        // NO_REGISTRATION

        // ORG_UNIT_CODE

        // date_of_birth

        // CONTACT_ADDRESS

        // PHONE_NUMBER

        // MOBILE

        // KAL_ID

        // PLACE_OF_BIRTH

        // KALURAHAN

        // clinic_id

        // name_of_clinic

        // clinic_id_from

        // fullname

        // employee_id

        // employee_id_from

        // booked_Date

        // visit_date

        // visit_id

        // isattended

        // diantar_oleh

        // visitor_address

        // address_of_rujukan

        // rujukan_id

        // DESCRIPTION

        // patient_category_id

        // payor_id

        // reason_id

        // STATUS_PASIEN_ID

        // way_id

        // follow_up

        // isnew

        // family_status_id

        // urutan
        if ($this->RowType == ROWTYPE_VIEW) {
            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->ViewValue = $this->NAME_OF_PASIEN->CurrentValue;
            $this->NAME_OF_PASIEN->ViewCustomAttributes = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
            $this->NO_REGISTRATION->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // date_of_birth
            $this->date_of_birth->ViewValue = $this->date_of_birth->CurrentValue;
            $this->date_of_birth->ViewValue = FormatDateTime($this->date_of_birth->ViewValue, 0);
            $this->date_of_birth->ViewCustomAttributes = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->ViewValue = $this->CONTACT_ADDRESS->CurrentValue;
            $this->CONTACT_ADDRESS->ViewCustomAttributes = "";

            // PHONE_NUMBER
            $this->PHONE_NUMBER->ViewValue = $this->PHONE_NUMBER->CurrentValue;
            $this->PHONE_NUMBER->ViewCustomAttributes = "";

            // MOBILE
            $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
            $this->MOBILE->ViewCustomAttributes = "";

            // KAL_ID
            $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
            $this->KAL_ID->ViewCustomAttributes = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
            $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

            // KALURAHAN
            $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
            $this->KALURAHAN->ViewCustomAttributes = "";

            // clinic_id
            $this->clinic_id->ViewValue = $this->clinic_id->CurrentValue;
            $this->clinic_id->ViewCustomAttributes = "";

            // name_of_clinic
            $this->name_of_clinic->ViewValue = $this->name_of_clinic->CurrentValue;
            $this->name_of_clinic->ViewCustomAttributes = "";

            // clinic_id_from
            $this->clinic_id_from->ViewValue = $this->clinic_id_from->CurrentValue;
            $this->clinic_id_from->ViewCustomAttributes = "";

            // fullname
            $this->fullname->ViewValue = $this->fullname->CurrentValue;
            $this->fullname->ViewCustomAttributes = "";

            // employee_id
            $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
            $this->employee_id->ViewCustomAttributes = "";

            // employee_id_from
            $this->employee_id_from->ViewValue = $this->employee_id_from->CurrentValue;
            $this->employee_id_from->ViewCustomAttributes = "";

            // booked_Date
            $this->booked_Date->ViewValue = $this->booked_Date->CurrentValue;
            $this->booked_Date->ViewValue = FormatDateTime($this->booked_Date->ViewValue, 0);
            $this->booked_Date->ViewCustomAttributes = "";

            // visit_date
            $this->visit_date->ViewValue = $this->visit_date->CurrentValue;
            $this->visit_date->ViewValue = FormatDateTime($this->visit_date->ViewValue, 0);
            $this->visit_date->ViewCustomAttributes = "";

            // visit_id
            $this->visit_id->ViewValue = $this->visit_id->CurrentValue;
            $this->visit_id->ViewCustomAttributes = "";

            // isattended
            $this->isattended->ViewValue = $this->isattended->CurrentValue;
            $this->isattended->ViewCustomAttributes = "";

            // diantar_oleh
            $this->diantar_oleh->ViewValue = $this->diantar_oleh->CurrentValue;
            $this->diantar_oleh->ViewCustomAttributes = "";

            // visitor_address
            $this->visitor_address->ViewValue = $this->visitor_address->CurrentValue;
            $this->visitor_address->ViewCustomAttributes = "";

            // address_of_rujukan
            $this->address_of_rujukan->ViewValue = $this->address_of_rujukan->CurrentValue;
            $this->address_of_rujukan->ViewCustomAttributes = "";

            // rujukan_id
            $this->rujukan_id->ViewValue = $this->rujukan_id->CurrentValue;
            $this->rujukan_id->ViewValue = FormatNumber($this->rujukan_id->ViewValue, 0, -2, -2, -2);
            $this->rujukan_id->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // patient_category_id
            $this->patient_category_id->ViewValue = $this->patient_category_id->CurrentValue;
            $this->patient_category_id->ViewValue = FormatNumber($this->patient_category_id->ViewValue, 0, -2, -2, -2);
            $this->patient_category_id->ViewCustomAttributes = "";

            // payor_id
            $this->payor_id->ViewValue = $this->payor_id->CurrentValue;
            $this->payor_id->ViewCustomAttributes = "";

            // reason_id
            $this->reason_id->ViewValue = $this->reason_id->CurrentValue;
            $this->reason_id->ViewValue = FormatNumber($this->reason_id->ViewValue, 0, -2, -2, -2);
            $this->reason_id->ViewCustomAttributes = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
            $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
            $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

            // way_id
            $this->way_id->ViewValue = $this->way_id->CurrentValue;
            $this->way_id->ViewValue = FormatNumber($this->way_id->ViewValue, 0, -2, -2, -2);
            $this->way_id->ViewCustomAttributes = "";

            // follow_up
            $this->follow_up->ViewValue = $this->follow_up->CurrentValue;
            $this->follow_up->ViewValue = FormatNumber($this->follow_up->ViewValue, 0, -2, -2, -2);
            $this->follow_up->ViewCustomAttributes = "";

            // isnew
            $this->isnew->ViewValue = $this->isnew->CurrentValue;
            $this->isnew->ViewCustomAttributes = "";

            // family_status_id
            $this->family_status_id->ViewValue = $this->family_status_id->CurrentValue;
            $this->family_status_id->ViewValue = FormatNumber($this->family_status_id->ViewValue, 0, -2, -2, -2);
            $this->family_status_id->ViewCustomAttributes = "";

            // urutan
            $this->urutan->ViewValue = $this->urutan->CurrentValue;
            $this->urutan->ViewValue = FormatNumber($this->urutan->ViewValue, 0, -2, -2, -2);
            $this->urutan->ViewCustomAttributes = "";

            // NAME_OF_PASIEN
            $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
            $this->NAME_OF_PASIEN->HrefValue = "";
            $this->NAME_OF_PASIEN->TooltipValue = "";

            // NO_REGISTRATION
            $this->NO_REGISTRATION->LinkCustomAttributes = "";
            $this->NO_REGISTRATION->HrefValue = "";
            $this->NO_REGISTRATION->TooltipValue = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // date_of_birth
            $this->date_of_birth->LinkCustomAttributes = "";
            $this->date_of_birth->HrefValue = "";
            $this->date_of_birth->TooltipValue = "";

            // CONTACT_ADDRESS
            $this->CONTACT_ADDRESS->LinkCustomAttributes = "";
            $this->CONTACT_ADDRESS->HrefValue = "";
            $this->CONTACT_ADDRESS->TooltipValue = "";

            // PHONE_NUMBER
            $this->PHONE_NUMBER->LinkCustomAttributes = "";
            $this->PHONE_NUMBER->HrefValue = "";
            $this->PHONE_NUMBER->TooltipValue = "";

            // MOBILE
            $this->MOBILE->LinkCustomAttributes = "";
            $this->MOBILE->HrefValue = "";
            $this->MOBILE->TooltipValue = "";

            // KAL_ID
            $this->KAL_ID->LinkCustomAttributes = "";
            $this->KAL_ID->HrefValue = "";
            $this->KAL_ID->TooltipValue = "";

            // PLACE_OF_BIRTH
            $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
            $this->PLACE_OF_BIRTH->HrefValue = "";
            $this->PLACE_OF_BIRTH->TooltipValue = "";

            // KALURAHAN
            $this->KALURAHAN->LinkCustomAttributes = "";
            $this->KALURAHAN->HrefValue = "";
            $this->KALURAHAN->TooltipValue = "";

            // clinic_id
            $this->clinic_id->LinkCustomAttributes = "";
            $this->clinic_id->HrefValue = "";
            $this->clinic_id->TooltipValue = "";

            // name_of_clinic
            $this->name_of_clinic->LinkCustomAttributes = "";
            $this->name_of_clinic->HrefValue = "";
            $this->name_of_clinic->TooltipValue = "";

            // clinic_id_from
            $this->clinic_id_from->LinkCustomAttributes = "";
            $this->clinic_id_from->HrefValue = "";
            $this->clinic_id_from->TooltipValue = "";

            // fullname
            $this->fullname->LinkCustomAttributes = "";
            $this->fullname->HrefValue = "";
            $this->fullname->TooltipValue = "";

            // employee_id
            $this->employee_id->LinkCustomAttributes = "";
            $this->employee_id->HrefValue = "";
            $this->employee_id->TooltipValue = "";

            // employee_id_from
            $this->employee_id_from->LinkCustomAttributes = "";
            $this->employee_id_from->HrefValue = "";
            $this->employee_id_from->TooltipValue = "";

            // booked_Date
            $this->booked_Date->LinkCustomAttributes = "";
            $this->booked_Date->HrefValue = "";
            $this->booked_Date->TooltipValue = "";

            // visit_date
            $this->visit_date->LinkCustomAttributes = "";
            $this->visit_date->HrefValue = "";
            $this->visit_date->TooltipValue = "";

            // visit_id
            $this->visit_id->LinkCustomAttributes = "";
            $this->visit_id->HrefValue = "";
            $this->visit_id->TooltipValue = "";

            // isattended
            $this->isattended->LinkCustomAttributes = "";
            $this->isattended->HrefValue = "";
            $this->isattended->TooltipValue = "";

            // diantar_oleh
            $this->diantar_oleh->LinkCustomAttributes = "";
            $this->diantar_oleh->HrefValue = "";
            $this->diantar_oleh->TooltipValue = "";

            // visitor_address
            $this->visitor_address->LinkCustomAttributes = "";
            $this->visitor_address->HrefValue = "";
            $this->visitor_address->TooltipValue = "";

            // address_of_rujukan
            $this->address_of_rujukan->LinkCustomAttributes = "";
            $this->address_of_rujukan->HrefValue = "";
            $this->address_of_rujukan->TooltipValue = "";

            // rujukan_id
            $this->rujukan_id->LinkCustomAttributes = "";
            $this->rujukan_id->HrefValue = "";
            $this->rujukan_id->TooltipValue = "";

            // DESCRIPTION
            $this->DESCRIPTION->LinkCustomAttributes = "";
            $this->DESCRIPTION->HrefValue = "";
            $this->DESCRIPTION->TooltipValue = "";

            // patient_category_id
            $this->patient_category_id->LinkCustomAttributes = "";
            $this->patient_category_id->HrefValue = "";
            $this->patient_category_id->TooltipValue = "";

            // payor_id
            $this->payor_id->LinkCustomAttributes = "";
            $this->payor_id->HrefValue = "";
            $this->payor_id->TooltipValue = "";

            // reason_id
            $this->reason_id->LinkCustomAttributes = "";
            $this->reason_id->HrefValue = "";
            $this->reason_id->TooltipValue = "";

            // STATUS_PASIEN_ID
            $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
            $this->STATUS_PASIEN_ID->HrefValue = "";
            $this->STATUS_PASIEN_ID->TooltipValue = "";

            // way_id
            $this->way_id->LinkCustomAttributes = "";
            $this->way_id->HrefValue = "";
            $this->way_id->TooltipValue = "";

            // follow_up
            $this->follow_up->LinkCustomAttributes = "";
            $this->follow_up->HrefValue = "";
            $this->follow_up->TooltipValue = "";

            // isnew
            $this->isnew->LinkCustomAttributes = "";
            $this->isnew->HrefValue = "";
            $this->isnew->TooltipValue = "";

            // family_status_id
            $this->family_status_id->LinkCustomAttributes = "";
            $this->family_status_id->HrefValue = "";
            $this->family_status_id->TooltipValue = "";

            // urutan
            $this->urutan->LinkCustomAttributes = "";
            $this->urutan->HrefValue = "";
            $this->urutan->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("VPasienvisitationrjList"), "", $this->TableVar, true);
        $pageId = "view";
        $Breadcrumb->add("view", $pageId, $url);
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
}
