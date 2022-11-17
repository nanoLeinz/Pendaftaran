<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PayorInfoEdit extends PayorInfo
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'PAYOR_INFO';

    // Page object name
    public $PageObjName = "PayorInfoEdit";

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

        // Table object (PAYOR_INFO)
        if (!isset($GLOBALS["PAYOR_INFO"]) || get_class($GLOBALS["PAYOR_INFO"]) == PROJECT_NAMESPACE . "PAYOR_INFO") {
            $GLOBALS["PAYOR_INFO"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'PAYOR_INFO');
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
                $doc = new $class(Container("PAYOR_INFO"));
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
                    if ($pageName == "PayorInfoView") {
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
            $key .= @$ar['PAYOR_ID'];
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
        $this->PAYOR_ID->setVisibility();
        $this->PAYOR_TYPE->setVisibility();
        $this->PAYOR->setVisibility();
        $this->ADDRESS->setVisibility();
        $this->CITY->setVisibility();
        $this->PHONE->setVisibility();
        $this->FAX->setVisibility();
        $this->KDVKLAIM->setVisibility();
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
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("PAYOR_ID") ?? Key(0) ?? Route(2)) !== null) {
                $this->PAYOR_ID->setQueryStringValue($keyValue);
                $this->PAYOR_ID->setOldValue($this->PAYOR_ID->QueryStringValue);
            } elseif (Post("PAYOR_ID") !== null) {
                $this->PAYOR_ID->setFormValue(Post("PAYOR_ID"));
                $this->PAYOR_ID->setOldValue($this->PAYOR_ID->FormValue);
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
                if (($keyValue = Get("PAYOR_ID") ?? Route("PAYOR_ID")) !== null) {
                    $this->PAYOR_ID->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->PAYOR_ID->CurrentValue = null;
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
                    $this->terminate("PayorInfoList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "PayorInfoList") {
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

        // Check field name 'PAYOR_ID' first before field var 'x_PAYOR_ID'
        $val = $CurrentForm->hasValue("PAYOR_ID") ? $CurrentForm->getValue("PAYOR_ID") : $CurrentForm->getValue("x_PAYOR_ID");
        if (!$this->PAYOR_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PAYOR_ID->Visible = false; // Disable update for API request
            } else {
                $this->PAYOR_ID->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_PAYOR_ID")) {
            $this->PAYOR_ID->setOldValue($CurrentForm->getValue("o_PAYOR_ID"));
        }

        // Check field name 'PAYOR_TYPE' first before field var 'x_PAYOR_TYPE'
        $val = $CurrentForm->hasValue("PAYOR_TYPE") ? $CurrentForm->getValue("PAYOR_TYPE") : $CurrentForm->getValue("x_PAYOR_TYPE");
        if (!$this->PAYOR_TYPE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PAYOR_TYPE->Visible = false; // Disable update for API request
            } else {
                $this->PAYOR_TYPE->setFormValue($val);
            }
        }

        // Check field name 'PAYOR' first before field var 'x_PAYOR'
        $val = $CurrentForm->hasValue("PAYOR") ? $CurrentForm->getValue("PAYOR") : $CurrentForm->getValue("x_PAYOR");
        if (!$this->PAYOR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PAYOR->Visible = false; // Disable update for API request
            } else {
                $this->PAYOR->setFormValue($val);
            }
        }

        // Check field name 'ADDRESS' first before field var 'x_ADDRESS'
        $val = $CurrentForm->hasValue("ADDRESS") ? $CurrentForm->getValue("ADDRESS") : $CurrentForm->getValue("x_ADDRESS");
        if (!$this->ADDRESS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ADDRESS->Visible = false; // Disable update for API request
            } else {
                $this->ADDRESS->setFormValue($val);
            }
        }

        // Check field name 'CITY' first before field var 'x_CITY'
        $val = $CurrentForm->hasValue("CITY") ? $CurrentForm->getValue("CITY") : $CurrentForm->getValue("x_CITY");
        if (!$this->CITY->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CITY->Visible = false; // Disable update for API request
            } else {
                $this->CITY->setFormValue($val);
            }
        }

        // Check field name 'PHONE' first before field var 'x_PHONE'
        $val = $CurrentForm->hasValue("PHONE") ? $CurrentForm->getValue("PHONE") : $CurrentForm->getValue("x_PHONE");
        if (!$this->PHONE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PHONE->Visible = false; // Disable update for API request
            } else {
                $this->PHONE->setFormValue($val);
            }
        }

        // Check field name 'FAX' first before field var 'x_FAX'
        $val = $CurrentForm->hasValue("FAX") ? $CurrentForm->getValue("FAX") : $CurrentForm->getValue("x_FAX");
        if (!$this->FAX->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->FAX->Visible = false; // Disable update for API request
            } else {
                $this->FAX->setFormValue($val);
            }
        }

        // Check field name 'KDVKLAIM' first before field var 'x_KDVKLAIM'
        $val = $CurrentForm->hasValue("KDVKLAIM") ? $CurrentForm->getValue("KDVKLAIM") : $CurrentForm->getValue("x_KDVKLAIM");
        if (!$this->KDVKLAIM->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KDVKLAIM->Visible = false; // Disable update for API request
            } else {
                $this->KDVKLAIM->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ORG_UNIT_CODE->CurrentValue = $this->ORG_UNIT_CODE->FormValue;
        $this->PAYOR_ID->CurrentValue = $this->PAYOR_ID->FormValue;
        $this->PAYOR_TYPE->CurrentValue = $this->PAYOR_TYPE->FormValue;
        $this->PAYOR->CurrentValue = $this->PAYOR->FormValue;
        $this->ADDRESS->CurrentValue = $this->ADDRESS->FormValue;
        $this->CITY->CurrentValue = $this->CITY->FormValue;
        $this->PHONE->CurrentValue = $this->PHONE->FormValue;
        $this->FAX->CurrentValue = $this->FAX->FormValue;
        $this->KDVKLAIM->CurrentValue = $this->KDVKLAIM->FormValue;
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
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->PAYOR_TYPE->setDbValue($row['PAYOR_TYPE']);
        $this->PAYOR->setDbValue($row['PAYOR']);
        $this->ADDRESS->setDbValue($row['ADDRESS']);
        $this->CITY->setDbValue($row['CITY']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->FAX->setDbValue($row['FAX']);
        $this->KDVKLAIM->setDbValue($row['KDVKLAIM']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['ORG_UNIT_CODE'] = null;
        $row['PAYOR_ID'] = null;
        $row['PAYOR_TYPE'] = null;
        $row['PAYOR'] = null;
        $row['ADDRESS'] = null;
        $row['CITY'] = null;
        $row['PHONE'] = null;
        $row['FAX'] = null;
        $row['KDVKLAIM'] = null;
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

        // PAYOR_ID

        // PAYOR_TYPE

        // PAYOR

        // ADDRESS

        // CITY

        // PHONE

        // FAX

        // KDVKLAIM
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // PAYOR_ID
            $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
            $this->PAYOR_ID->ViewCustomAttributes = "";

            // PAYOR_TYPE
            $this->PAYOR_TYPE->ViewValue = $this->PAYOR_TYPE->CurrentValue;
            $this->PAYOR_TYPE->ViewValue = FormatNumber($this->PAYOR_TYPE->ViewValue, 0, -2, -2, -2);
            $this->PAYOR_TYPE->ViewCustomAttributes = "";

            // PAYOR
            $this->PAYOR->ViewValue = $this->PAYOR->CurrentValue;
            $this->PAYOR->ViewCustomAttributes = "";

            // ADDRESS
            $this->ADDRESS->ViewValue = $this->ADDRESS->CurrentValue;
            $this->ADDRESS->ViewCustomAttributes = "";

            // CITY
            $this->CITY->ViewValue = $this->CITY->CurrentValue;
            $this->CITY->ViewCustomAttributes = "";

            // PHONE
            $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
            $this->PHONE->ViewCustomAttributes = "";

            // FAX
            $this->FAX->ViewValue = $this->FAX->CurrentValue;
            $this->FAX->ViewCustomAttributes = "";

            // KDVKLAIM
            $this->KDVKLAIM->ViewValue = $this->KDVKLAIM->CurrentValue;
            $this->KDVKLAIM->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";
            $this->PAYOR_ID->TooltipValue = "";

            // PAYOR_TYPE
            $this->PAYOR_TYPE->LinkCustomAttributes = "";
            $this->PAYOR_TYPE->HrefValue = "";
            $this->PAYOR_TYPE->TooltipValue = "";

            // PAYOR
            $this->PAYOR->LinkCustomAttributes = "";
            $this->PAYOR->HrefValue = "";
            $this->PAYOR->TooltipValue = "";

            // ADDRESS
            $this->ADDRESS->LinkCustomAttributes = "";
            $this->ADDRESS->HrefValue = "";
            $this->ADDRESS->TooltipValue = "";

            // CITY
            $this->CITY->LinkCustomAttributes = "";
            $this->CITY->HrefValue = "";
            $this->CITY->TooltipValue = "";

            // PHONE
            $this->PHONE->LinkCustomAttributes = "";
            $this->PHONE->HrefValue = "";
            $this->PHONE->TooltipValue = "";

            // FAX
            $this->FAX->LinkCustomAttributes = "";
            $this->FAX->HrefValue = "";
            $this->FAX->TooltipValue = "";

            // KDVKLAIM
            $this->KDVKLAIM->LinkCustomAttributes = "";
            $this->KDVKLAIM->HrefValue = "";
            $this->KDVKLAIM->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
            $this->ORG_UNIT_CODE->EditCustomAttributes = "";
            if (!$this->ORG_UNIT_CODE->Raw) {
                $this->ORG_UNIT_CODE->CurrentValue = HtmlDecode($this->ORG_UNIT_CODE->CurrentValue);
            }
            $this->ORG_UNIT_CODE->EditValue = HtmlEncode($this->ORG_UNIT_CODE->CurrentValue);
            $this->ORG_UNIT_CODE->PlaceHolder = RemoveHtml($this->ORG_UNIT_CODE->caption());

            // PAYOR_ID
            $this->PAYOR_ID->EditAttrs["class"] = "form-control";
            $this->PAYOR_ID->EditCustomAttributes = "";
            if (!$this->PAYOR_ID->Raw) {
                $this->PAYOR_ID->CurrentValue = HtmlDecode($this->PAYOR_ID->CurrentValue);
            }
            $this->PAYOR_ID->EditValue = HtmlEncode($this->PAYOR_ID->CurrentValue);
            $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

            // PAYOR_TYPE
            $this->PAYOR_TYPE->EditAttrs["class"] = "form-control";
            $this->PAYOR_TYPE->EditCustomAttributes = "";
            $this->PAYOR_TYPE->EditValue = HtmlEncode($this->PAYOR_TYPE->CurrentValue);
            $this->PAYOR_TYPE->PlaceHolder = RemoveHtml($this->PAYOR_TYPE->caption());

            // PAYOR
            $this->PAYOR->EditAttrs["class"] = "form-control";
            $this->PAYOR->EditCustomAttributes = "";
            if (!$this->PAYOR->Raw) {
                $this->PAYOR->CurrentValue = HtmlDecode($this->PAYOR->CurrentValue);
            }
            $this->PAYOR->EditValue = HtmlEncode($this->PAYOR->CurrentValue);
            $this->PAYOR->PlaceHolder = RemoveHtml($this->PAYOR->caption());

            // ADDRESS
            $this->ADDRESS->EditAttrs["class"] = "form-control";
            $this->ADDRESS->EditCustomAttributes = "";
            if (!$this->ADDRESS->Raw) {
                $this->ADDRESS->CurrentValue = HtmlDecode($this->ADDRESS->CurrentValue);
            }
            $this->ADDRESS->EditValue = HtmlEncode($this->ADDRESS->CurrentValue);
            $this->ADDRESS->PlaceHolder = RemoveHtml($this->ADDRESS->caption());

            // CITY
            $this->CITY->EditAttrs["class"] = "form-control";
            $this->CITY->EditCustomAttributes = "";
            if (!$this->CITY->Raw) {
                $this->CITY->CurrentValue = HtmlDecode($this->CITY->CurrentValue);
            }
            $this->CITY->EditValue = HtmlEncode($this->CITY->CurrentValue);
            $this->CITY->PlaceHolder = RemoveHtml($this->CITY->caption());

            // PHONE
            $this->PHONE->EditAttrs["class"] = "form-control";
            $this->PHONE->EditCustomAttributes = "";
            if (!$this->PHONE->Raw) {
                $this->PHONE->CurrentValue = HtmlDecode($this->PHONE->CurrentValue);
            }
            $this->PHONE->EditValue = HtmlEncode($this->PHONE->CurrentValue);
            $this->PHONE->PlaceHolder = RemoveHtml($this->PHONE->caption());

            // FAX
            $this->FAX->EditAttrs["class"] = "form-control";
            $this->FAX->EditCustomAttributes = "";
            if (!$this->FAX->Raw) {
                $this->FAX->CurrentValue = HtmlDecode($this->FAX->CurrentValue);
            }
            $this->FAX->EditValue = HtmlEncode($this->FAX->CurrentValue);
            $this->FAX->PlaceHolder = RemoveHtml($this->FAX->caption());

            // KDVKLAIM
            $this->KDVKLAIM->EditAttrs["class"] = "form-control";
            $this->KDVKLAIM->EditCustomAttributes = "";
            if (!$this->KDVKLAIM->Raw) {
                $this->KDVKLAIM->CurrentValue = HtmlDecode($this->KDVKLAIM->CurrentValue);
            }
            $this->KDVKLAIM->EditValue = HtmlEncode($this->KDVKLAIM->CurrentValue);
            $this->KDVKLAIM->PlaceHolder = RemoveHtml($this->KDVKLAIM->caption());

            // Edit refer script

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";

            // PAYOR_ID
            $this->PAYOR_ID->LinkCustomAttributes = "";
            $this->PAYOR_ID->HrefValue = "";

            // PAYOR_TYPE
            $this->PAYOR_TYPE->LinkCustomAttributes = "";
            $this->PAYOR_TYPE->HrefValue = "";

            // PAYOR
            $this->PAYOR->LinkCustomAttributes = "";
            $this->PAYOR->HrefValue = "";

            // ADDRESS
            $this->ADDRESS->LinkCustomAttributes = "";
            $this->ADDRESS->HrefValue = "";

            // CITY
            $this->CITY->LinkCustomAttributes = "";
            $this->CITY->HrefValue = "";

            // PHONE
            $this->PHONE->LinkCustomAttributes = "";
            $this->PHONE->HrefValue = "";

            // FAX
            $this->FAX->LinkCustomAttributes = "";
            $this->FAX->HrefValue = "";

            // KDVKLAIM
            $this->KDVKLAIM->LinkCustomAttributes = "";
            $this->KDVKLAIM->HrefValue = "";
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
        if ($this->PAYOR_ID->Required) {
            if (!$this->PAYOR_ID->IsDetailKey && EmptyValue($this->PAYOR_ID->FormValue)) {
                $this->PAYOR_ID->addErrorMessage(str_replace("%s", $this->PAYOR_ID->caption(), $this->PAYOR_ID->RequiredErrorMessage));
            }
        }
        if ($this->PAYOR_TYPE->Required) {
            if (!$this->PAYOR_TYPE->IsDetailKey && EmptyValue($this->PAYOR_TYPE->FormValue)) {
                $this->PAYOR_TYPE->addErrorMessage(str_replace("%s", $this->PAYOR_TYPE->caption(), $this->PAYOR_TYPE->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->PAYOR_TYPE->FormValue)) {
            $this->PAYOR_TYPE->addErrorMessage($this->PAYOR_TYPE->getErrorMessage(false));
        }
        if ($this->PAYOR->Required) {
            if (!$this->PAYOR->IsDetailKey && EmptyValue($this->PAYOR->FormValue)) {
                $this->PAYOR->addErrorMessage(str_replace("%s", $this->PAYOR->caption(), $this->PAYOR->RequiredErrorMessage));
            }
        }
        if ($this->ADDRESS->Required) {
            if (!$this->ADDRESS->IsDetailKey && EmptyValue($this->ADDRESS->FormValue)) {
                $this->ADDRESS->addErrorMessage(str_replace("%s", $this->ADDRESS->caption(), $this->ADDRESS->RequiredErrorMessage));
            }
        }
        if ($this->CITY->Required) {
            if (!$this->CITY->IsDetailKey && EmptyValue($this->CITY->FormValue)) {
                $this->CITY->addErrorMessage(str_replace("%s", $this->CITY->caption(), $this->CITY->RequiredErrorMessage));
            }
        }
        if ($this->PHONE->Required) {
            if (!$this->PHONE->IsDetailKey && EmptyValue($this->PHONE->FormValue)) {
                $this->PHONE->addErrorMessage(str_replace("%s", $this->PHONE->caption(), $this->PHONE->RequiredErrorMessage));
            }
        }
        if ($this->FAX->Required) {
            if (!$this->FAX->IsDetailKey && EmptyValue($this->FAX->FormValue)) {
                $this->FAX->addErrorMessage(str_replace("%s", $this->FAX->caption(), $this->FAX->RequiredErrorMessage));
            }
        }
        if ($this->KDVKLAIM->Required) {
            if (!$this->KDVKLAIM->IsDetailKey && EmptyValue($this->KDVKLAIM->FormValue)) {
                $this->KDVKLAIM->addErrorMessage(str_replace("%s", $this->KDVKLAIM->caption(), $this->KDVKLAIM->RequiredErrorMessage));
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
            $this->ORG_UNIT_CODE->setDbValueDef($rsnew, $this->ORG_UNIT_CODE->CurrentValue, null, $this->ORG_UNIT_CODE->ReadOnly);

            // PAYOR_ID
            $this->PAYOR_ID->setDbValueDef($rsnew, $this->PAYOR_ID->CurrentValue, "", $this->PAYOR_ID->ReadOnly);

            // PAYOR_TYPE
            $this->PAYOR_TYPE->setDbValueDef($rsnew, $this->PAYOR_TYPE->CurrentValue, null, $this->PAYOR_TYPE->ReadOnly);

            // PAYOR
            $this->PAYOR->setDbValueDef($rsnew, $this->PAYOR->CurrentValue, null, $this->PAYOR->ReadOnly);

            // ADDRESS
            $this->ADDRESS->setDbValueDef($rsnew, $this->ADDRESS->CurrentValue, null, $this->ADDRESS->ReadOnly);

            // CITY
            $this->CITY->setDbValueDef($rsnew, $this->CITY->CurrentValue, null, $this->CITY->ReadOnly);

            // PHONE
            $this->PHONE->setDbValueDef($rsnew, $this->PHONE->CurrentValue, null, $this->PHONE->ReadOnly);

            // FAX
            $this->FAX->setDbValueDef($rsnew, $this->FAX->CurrentValue, null, $this->FAX->ReadOnly);

            // KDVKLAIM
            $this->KDVKLAIM->setDbValueDef($rsnew, $this->KDVKLAIM->CurrentValue, null, $this->KDVKLAIM->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);

            // Check for duplicate key when key changed
            if ($updateRow) {
                $newKeyFilter = $this->getRecordFilter($rsnew);
                if ($newKeyFilter != $oldKeyFilter) {
                    $rsChk = $this->loadRs($newKeyFilter)->fetch();
                    if ($rsChk !== false) {
                        $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                        $this->setFailureMessage($keyErrMsg);
                        $updateRow = false;
                    }
                }
            }
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PayorInfoList"), "", $this->TableVar, true);
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
