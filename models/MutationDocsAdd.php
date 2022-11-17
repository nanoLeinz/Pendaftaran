<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class MutationDocsAdd extends MutationDocs
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'MUTATION_DOCS';

    // Page object name
    public $PageObjName = "MutationDocsAdd";

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

        // Table object (MUTATION_DOCS)
        if (!isset($GLOBALS["MUTATION_DOCS"]) || get_class($GLOBALS["MUTATION_DOCS"]) == PROJECT_NAMESPACE . "MUTATION_DOCS") {
            $GLOBALS["MUTATION_DOCS"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'MUTATION_DOCS');
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
                $doc = new $class(Container("MUTATION_DOCS"));
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
                    if ($pageName == "MutationDocsView") {
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
            $key .= @$ar['ORG_UNIT_CODE'] . Config("COMPOSITE_KEY_SEPARATOR");
            $key .= @$ar['DOC_NO'];
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
        $this->DOC_NO->Visible = false;
        $this->ORDER_ID->Visible = false;
        $this->ORG_UNIT_FROM->Visible = false;
        $this->ORG_ID->setVisibility();
        $this->CLINIC_ID->setVisibility();
        $this->ORG_ID_TO->Visible = false;
        $this->CLINIC_ID_TO->setVisibility();
        $this->MUTATION_DATE->setVisibility();
        $this->MUTATION_BY->Visible = false;
        $this->MUTATION_VALUE->setVisibility();
        $this->ORDER_VALUE->setVisibility();
        $this->YEAR_ID->Visible = false;
        $this->RECEIVED_BY->setVisibility();
        $this->ACCOUNT_ID->Visible = false;
        $this->FINANCE_ID->Visible = false;
        $this->DESCRIPTION->Visible = false;
        $this->DISTRIBUTION_TYPE->setVisibility();
        $this->MODIFIED_DATE->Visible = false;
        $this->MODIFIED_BY->Visible = false;
        $this->ACKNOWLEDGEBY->Visible = false;
        $this->COMPANY_ID->Visible = false;
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
        $this->setupLookupOptions($this->CLINIC_ID);
        $this->setupLookupOptions($this->CLINIC_ID_TO);
        $this->setupLookupOptions($this->DISTRIBUTION_TYPE);

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
            if (($keyValue = Get("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
                $this->ORG_UNIT_CODE->setQueryStringValue($keyValue);
            }
            if (($keyValue = Get("DOC_NO") ?? Route("DOC_NO")) !== null) {
                $this->DOC_NO->setQueryStringValue($keyValue);
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
                    $this->terminate("MutationDocsList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "MutationDocsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "MutationDocsView") {
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
        $this->ORG_UNIT_CODE->CurrentValue = null;
        $this->ORG_UNIT_CODE->OldValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->DOC_NO->CurrentValue = null;
        $this->DOC_NO->OldValue = $this->DOC_NO->CurrentValue;
        $this->ORDER_ID->CurrentValue = null;
        $this->ORDER_ID->OldValue = $this->ORDER_ID->CurrentValue;
        $this->ORG_UNIT_FROM->CurrentValue = null;
        $this->ORG_UNIT_FROM->OldValue = $this->ORG_UNIT_FROM->CurrentValue;
        $this->ORG_ID->CurrentValue = null;
        $this->ORG_ID->OldValue = $this->ORG_ID->CurrentValue;
        $this->CLINIC_ID->CurrentValue = null;
        $this->CLINIC_ID->OldValue = $this->CLINIC_ID->CurrentValue;
        $this->ORG_ID_TO->CurrentValue = null;
        $this->ORG_ID_TO->OldValue = $this->ORG_ID_TO->CurrentValue;
        $this->CLINIC_ID_TO->CurrentValue = null;
        $this->CLINIC_ID_TO->OldValue = $this->CLINIC_ID_TO->CurrentValue;
        $this->MUTATION_DATE->CurrentValue = CurrentDateTime();
        $this->MUTATION_BY->CurrentValue = null;
        $this->MUTATION_BY->OldValue = $this->MUTATION_BY->CurrentValue;
        $this->MUTATION_VALUE->CurrentValue = null;
        $this->MUTATION_VALUE->OldValue = $this->MUTATION_VALUE->CurrentValue;
        $this->ORDER_VALUE->CurrentValue = null;
        $this->ORDER_VALUE->OldValue = $this->ORDER_VALUE->CurrentValue;
        $this->YEAR_ID->CurrentValue = null;
        $this->YEAR_ID->OldValue = $this->YEAR_ID->CurrentValue;
        $this->RECEIVED_BY->CurrentValue = null;
        $this->RECEIVED_BY->OldValue = $this->RECEIVED_BY->CurrentValue;
        $this->ACCOUNT_ID->CurrentValue = null;
        $this->ACCOUNT_ID->OldValue = $this->ACCOUNT_ID->CurrentValue;
        $this->FINANCE_ID->CurrentValue = null;
        $this->FINANCE_ID->OldValue = $this->FINANCE_ID->CurrentValue;
        $this->DESCRIPTION->CurrentValue = null;
        $this->DESCRIPTION->OldValue = $this->DESCRIPTION->CurrentValue;
        $this->DISTRIBUTION_TYPE->CurrentValue = "10";
        $this->MODIFIED_DATE->CurrentValue = null;
        $this->MODIFIED_DATE->OldValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_BY->CurrentValue = null;
        $this->MODIFIED_BY->OldValue = $this->MODIFIED_BY->CurrentValue;
        $this->ACKNOWLEDGEBY->CurrentValue = null;
        $this->ACKNOWLEDGEBY->OldValue = $this->ACKNOWLEDGEBY->CurrentValue;
        $this->COMPANY_ID->CurrentValue = null;
        $this->COMPANY_ID->OldValue = $this->COMPANY_ID->CurrentValue;
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

        // Check field name 'ORG_ID' first before field var 'x_ORG_ID'
        $val = $CurrentForm->hasValue("ORG_ID") ? $CurrentForm->getValue("ORG_ID") : $CurrentForm->getValue("x_ORG_ID");
        if (!$this->ORG_ID->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ORG_ID->Visible = false; // Disable update for API request
            } else {
                $this->ORG_ID->setFormValue($val);
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

        // Check field name 'CLINIC_ID_TO' first before field var 'x_CLINIC_ID_TO'
        $val = $CurrentForm->hasValue("CLINIC_ID_TO") ? $CurrentForm->getValue("CLINIC_ID_TO") : $CurrentForm->getValue("x_CLINIC_ID_TO");
        if (!$this->CLINIC_ID_TO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->CLINIC_ID_TO->Visible = false; // Disable update for API request
            } else {
                $this->CLINIC_ID_TO->setFormValue($val);
            }
        }

        // Check field name 'MUTATION_DATE' first before field var 'x_MUTATION_DATE'
        $val = $CurrentForm->hasValue("MUTATION_DATE") ? $CurrentForm->getValue("MUTATION_DATE") : $CurrentForm->getValue("x_MUTATION_DATE");
        if (!$this->MUTATION_DATE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MUTATION_DATE->Visible = false; // Disable update for API request
            } else {
                $this->MUTATION_DATE->setFormValue($val);
            }
            $this->MUTATION_DATE->CurrentValue = UnFormatDateTime($this->MUTATION_DATE->CurrentValue, 11);
        }

        // Check field name 'MUTATION_VALUE' first before field var 'x_MUTATION_VALUE'
        $val = $CurrentForm->hasValue("MUTATION_VALUE") ? $CurrentForm->getValue("MUTATION_VALUE") : $CurrentForm->getValue("x_MUTATION_VALUE");
        if (!$this->MUTATION_VALUE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MUTATION_VALUE->Visible = false; // Disable update for API request
            } else {
                $this->MUTATION_VALUE->setFormValue($val);
            }
        }

        // Check field name 'ORDER_VALUE' first before field var 'x_ORDER_VALUE'
        $val = $CurrentForm->hasValue("ORDER_VALUE") ? $CurrentForm->getValue("ORDER_VALUE") : $CurrentForm->getValue("x_ORDER_VALUE");
        if (!$this->ORDER_VALUE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ORDER_VALUE->Visible = false; // Disable update for API request
            } else {
                $this->ORDER_VALUE->setFormValue($val);
            }
        }

        // Check field name 'RECEIVED_BY' first before field var 'x_RECEIVED_BY'
        $val = $CurrentForm->hasValue("RECEIVED_BY") ? $CurrentForm->getValue("RECEIVED_BY") : $CurrentForm->getValue("x_RECEIVED_BY");
        if (!$this->RECEIVED_BY->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->RECEIVED_BY->Visible = false; // Disable update for API request
            } else {
                $this->RECEIVED_BY->setFormValue($val);
            }
        }

        // Check field name 'DISTRIBUTION_TYPE' first before field var 'x_DISTRIBUTION_TYPE'
        $val = $CurrentForm->hasValue("DISTRIBUTION_TYPE") ? $CurrentForm->getValue("DISTRIBUTION_TYPE") : $CurrentForm->getValue("x_DISTRIBUTION_TYPE");
        if (!$this->DISTRIBUTION_TYPE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DISTRIBUTION_TYPE->Visible = false; // Disable update for API request
            } else {
                $this->DISTRIBUTION_TYPE->setFormValue($val);
            }
        }

        // Check field name 'DOC_NO' first before field var 'x_DOC_NO'
        $val = $CurrentForm->hasValue("DOC_NO") ? $CurrentForm->getValue("DOC_NO") : $CurrentForm->getValue("x_DOC_NO");
        if (!$this->DOC_NO->IsDetailKey) {
            $this->DOC_NO->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
                        $this->DOC_NO->CurrentValue = $this->DOC_NO->FormValue;
        $this->ORG_UNIT_CODE->CurrentValue = $this->ORG_UNIT_CODE->FormValue;
        $this->ORG_ID->CurrentValue = $this->ORG_ID->FormValue;
        $this->CLINIC_ID->CurrentValue = $this->CLINIC_ID->FormValue;
        $this->CLINIC_ID_TO->CurrentValue = $this->CLINIC_ID_TO->FormValue;
        $this->MUTATION_DATE->CurrentValue = $this->MUTATION_DATE->FormValue;
        $this->MUTATION_DATE->CurrentValue = UnFormatDateTime($this->MUTATION_DATE->CurrentValue, 11);
        $this->MUTATION_VALUE->CurrentValue = $this->MUTATION_VALUE->FormValue;
        $this->ORDER_VALUE->CurrentValue = $this->ORDER_VALUE->FormValue;
        $this->RECEIVED_BY->CurrentValue = $this->RECEIVED_BY->FormValue;
        $this->DISTRIBUTION_TYPE->CurrentValue = $this->DISTRIBUTION_TYPE->FormValue;
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
        $this->DOC_NO->setDbValue($row['DOC_NO']);
        $this->ORDER_ID->setDbValue($row['ORDER_ID']);
        $this->ORG_UNIT_FROM->setDbValue($row['ORG_UNIT_FROM']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->ORG_ID_TO->setDbValue($row['ORG_ID_TO']);
        $this->CLINIC_ID_TO->setDbValue($row['CLINIC_ID_TO']);
        $this->MUTATION_DATE->setDbValue($row['MUTATION_DATE']);
        $this->MUTATION_BY->setDbValue($row['MUTATION_BY']);
        $this->MUTATION_VALUE->setDbValue($row['MUTATION_VALUE']);
        $this->ORDER_VALUE->setDbValue($row['ORDER_VALUE']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->RECEIVED_BY->setDbValue($row['RECEIVED_BY']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->FINANCE_ID->setDbValue($row['FINANCE_ID']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->DISTRIBUTION_TYPE->setDbValue($row['DISTRIBUTION_TYPE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->ACKNOWLEDGEBY->setDbValue($row['ACKNOWLEDGEBY']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['ORG_UNIT_CODE'] = $this->ORG_UNIT_CODE->CurrentValue;
        $row['DOC_NO'] = $this->DOC_NO->CurrentValue;
        $row['ORDER_ID'] = $this->ORDER_ID->CurrentValue;
        $row['ORG_UNIT_FROM'] = $this->ORG_UNIT_FROM->CurrentValue;
        $row['ORG_ID'] = $this->ORG_ID->CurrentValue;
        $row['CLINIC_ID'] = $this->CLINIC_ID->CurrentValue;
        $row['ORG_ID_TO'] = $this->ORG_ID_TO->CurrentValue;
        $row['CLINIC_ID_TO'] = $this->CLINIC_ID_TO->CurrentValue;
        $row['MUTATION_DATE'] = $this->MUTATION_DATE->CurrentValue;
        $row['MUTATION_BY'] = $this->MUTATION_BY->CurrentValue;
        $row['MUTATION_VALUE'] = $this->MUTATION_VALUE->CurrentValue;
        $row['ORDER_VALUE'] = $this->ORDER_VALUE->CurrentValue;
        $row['YEAR_ID'] = $this->YEAR_ID->CurrentValue;
        $row['RECEIVED_BY'] = $this->RECEIVED_BY->CurrentValue;
        $row['ACCOUNT_ID'] = $this->ACCOUNT_ID->CurrentValue;
        $row['FINANCE_ID'] = $this->FINANCE_ID->CurrentValue;
        $row['DESCRIPTION'] = $this->DESCRIPTION->CurrentValue;
        $row['DISTRIBUTION_TYPE'] = $this->DISTRIBUTION_TYPE->CurrentValue;
        $row['MODIFIED_DATE'] = $this->MODIFIED_DATE->CurrentValue;
        $row['MODIFIED_BY'] = $this->MODIFIED_BY->CurrentValue;
        $row['ACKNOWLEDGEBY'] = $this->ACKNOWLEDGEBY->CurrentValue;
        $row['COMPANY_ID'] = $this->COMPANY_ID->CurrentValue;
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

        // Convert decimal values if posted back
        if ($this->MUTATION_VALUE->FormValue == $this->MUTATION_VALUE->CurrentValue && is_numeric(ConvertToFloatString($this->MUTATION_VALUE->CurrentValue))) {
            $this->MUTATION_VALUE->CurrentValue = ConvertToFloatString($this->MUTATION_VALUE->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->ORDER_VALUE->FormValue == $this->ORDER_VALUE->CurrentValue && is_numeric(ConvertToFloatString($this->ORDER_VALUE->CurrentValue))) {
            $this->ORDER_VALUE->CurrentValue = ConvertToFloatString($this->ORDER_VALUE->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // ORG_UNIT_CODE

        // DOC_NO

        // ORDER_ID

        // ORG_UNIT_FROM

        // ORG_ID

        // CLINIC_ID

        // ORG_ID_TO

        // CLINIC_ID_TO

        // MUTATION_DATE

        // MUTATION_BY

        // MUTATION_VALUE

        // ORDER_VALUE

        // YEAR_ID

        // RECEIVED_BY

        // ACCOUNT_ID

        // FINANCE_ID

        // DESCRIPTION

        // DISTRIBUTION_TYPE

        // MODIFIED_DATE

        // MODIFIED_BY

        // ACKNOWLEDGEBY

        // COMPANY_ID
        if ($this->RowType == ROWTYPE_VIEW) {
            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

            // DOC_NO
            $this->DOC_NO->ViewValue = $this->DOC_NO->CurrentValue;
            $this->DOC_NO->ViewCustomAttributes = "";

            // ORDER_ID
            $this->ORDER_ID->ViewValue = $this->ORDER_ID->CurrentValue;
            $this->ORDER_ID->ViewCustomAttributes = "";

            // ORG_UNIT_FROM
            $this->ORG_UNIT_FROM->ViewValue = $this->ORG_UNIT_FROM->CurrentValue;
            $this->ORG_UNIT_FROM->ViewCustomAttributes = "";

            // ORG_ID
            $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
            $this->ORG_ID->ViewCustomAttributes = "";

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

            // ORG_ID_TO
            $this->ORG_ID_TO->ViewValue = $this->ORG_ID_TO->CurrentValue;
            $this->ORG_ID_TO->ViewCustomAttributes = "";

            // CLINIC_ID_TO
            $curVal = trim(strval($this->CLINIC_ID_TO->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID_TO->ViewValue = $this->CLINIC_ID_TO->lookupCacheOption($curVal);
                if ($this->CLINIC_ID_TO->ViewValue === null) { // Lookup from database
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->CLINIC_ID_TO->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->CLINIC_ID_TO->Lookup->renderViewRow($rswrk[0]);
                        $this->CLINIC_ID_TO->ViewValue = $this->CLINIC_ID_TO->displayValue($arwrk);
                    } else {
                        $this->CLINIC_ID_TO->ViewValue = $this->CLINIC_ID_TO->CurrentValue;
                    }
                }
            } else {
                $this->CLINIC_ID_TO->ViewValue = null;
            }
            $this->CLINIC_ID_TO->ViewCustomAttributes = "";

            // MUTATION_DATE
            $this->MUTATION_DATE->ViewValue = $this->MUTATION_DATE->CurrentValue;
            $this->MUTATION_DATE->ViewValue = FormatDateTime($this->MUTATION_DATE->ViewValue, 11);
            $this->MUTATION_DATE->ViewCustomAttributes = "";

            // MUTATION_BY
            $this->MUTATION_BY->ViewValue = $this->MUTATION_BY->CurrentValue;
            $this->MUTATION_BY->ViewCustomAttributes = "";

            // MUTATION_VALUE
            $this->MUTATION_VALUE->ViewValue = $this->MUTATION_VALUE->CurrentValue;
            $this->MUTATION_VALUE->ViewValue = FormatNumber($this->MUTATION_VALUE->ViewValue, 2, -2, -2, -2);
            $this->MUTATION_VALUE->ViewCustomAttributes = "";

            // ORDER_VALUE
            $this->ORDER_VALUE->ViewValue = $this->ORDER_VALUE->CurrentValue;
            $this->ORDER_VALUE->ViewValue = FormatNumber($this->ORDER_VALUE->ViewValue, 2, -2, -2, -2);
            $this->ORDER_VALUE->ViewCustomAttributes = "";

            // YEAR_ID
            $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
            $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
            $this->YEAR_ID->ViewCustomAttributes = "";

            // RECEIVED_BY
            $this->RECEIVED_BY->ViewValue = $this->RECEIVED_BY->CurrentValue;
            $this->RECEIVED_BY->ViewCustomAttributes = "";

            // ACCOUNT_ID
            $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
            $this->ACCOUNT_ID->ViewCustomAttributes = "";

            // FINANCE_ID
            $this->FINANCE_ID->ViewValue = $this->FINANCE_ID->CurrentValue;
            $this->FINANCE_ID->ViewValue = FormatNumber($this->FINANCE_ID->ViewValue, 0, -2, -2, -2);
            $this->FINANCE_ID->ViewCustomAttributes = "";

            // DESCRIPTION
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
            $this->DESCRIPTION->ViewCustomAttributes = "";

            // DISTRIBUTION_TYPE
            $curVal = trim(strval($this->DISTRIBUTION_TYPE->CurrentValue));
            if ($curVal != "") {
                $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->lookupCacheOption($curVal);
                if ($this->DISTRIBUTION_TYPE->ViewValue === null) { // Lookup from database
                    $filterWrk = "[DISTRIBUTION_TYPE]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->DISTRIBUTION_TYPE->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DISTRIBUTION_TYPE->Lookup->renderViewRow($rswrk[0]);
                        $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->displayValue($arwrk);
                    } else {
                        $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->CurrentValue;
                    }
                }
            } else {
                $this->DISTRIBUTION_TYPE->ViewValue = null;
            }
            $this->DISTRIBUTION_TYPE->ViewCustomAttributes = "";

            // MODIFIED_DATE
            $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
            $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
            $this->MODIFIED_DATE->ViewCustomAttributes = "";

            // MODIFIED_BY
            $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
            $this->MODIFIED_BY->ViewCustomAttributes = "";

            // ACKNOWLEDGEBY
            $this->ACKNOWLEDGEBY->ViewValue = $this->ACKNOWLEDGEBY->CurrentValue;
            $this->ACKNOWLEDGEBY->ViewCustomAttributes = "";

            // COMPANY_ID
            $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
            $this->COMPANY_ID->ViewCustomAttributes = "";

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";
            $this->ORG_UNIT_CODE->TooltipValue = "";

            // ORG_ID
            $this->ORG_ID->LinkCustomAttributes = "";
            $this->ORG_ID->HrefValue = "";
            $this->ORG_ID->TooltipValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";
            $this->CLINIC_ID->TooltipValue = "";

            // CLINIC_ID_TO
            $this->CLINIC_ID_TO->LinkCustomAttributes = "";
            $this->CLINIC_ID_TO->HrefValue = "";
            $this->CLINIC_ID_TO->TooltipValue = "";

            // MUTATION_DATE
            $this->MUTATION_DATE->LinkCustomAttributes = "";
            $this->MUTATION_DATE->HrefValue = "";
            $this->MUTATION_DATE->TooltipValue = "";

            // MUTATION_VALUE
            $this->MUTATION_VALUE->LinkCustomAttributes = "";
            $this->MUTATION_VALUE->HrefValue = "";
            $this->MUTATION_VALUE->TooltipValue = "";

            // ORDER_VALUE
            $this->ORDER_VALUE->LinkCustomAttributes = "";
            $this->ORDER_VALUE->HrefValue = "";
            $this->ORDER_VALUE->TooltipValue = "";

            // RECEIVED_BY
            $this->RECEIVED_BY->LinkCustomAttributes = "";
            $this->RECEIVED_BY->HrefValue = "";
            $this->RECEIVED_BY->TooltipValue = "";

            // DISTRIBUTION_TYPE
            $this->DISTRIBUTION_TYPE->LinkCustomAttributes = "";
            $this->DISTRIBUTION_TYPE->HrefValue = "";
            $this->DISTRIBUTION_TYPE->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // ORG_UNIT_CODE

            // ORG_ID
            $this->ORG_ID->EditAttrs["class"] = "form-control";
            $this->ORG_ID->EditCustomAttributes = "";
            if (!$this->ORG_ID->Raw) {
                $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
            }
            $this->ORG_ID->EditValue = HtmlEncode($this->ORG_ID->CurrentValue);
            $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

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
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLINIC_ID->EditValue = $arwrk;
            }
            $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

            // CLINIC_ID_TO
            $this->CLINIC_ID_TO->EditAttrs["class"] = "form-control";
            $this->CLINIC_ID_TO->EditCustomAttributes = "";
            $curVal = trim(strval($this->CLINIC_ID_TO->CurrentValue));
            if ($curVal != "") {
                $this->CLINIC_ID_TO->ViewValue = $this->CLINIC_ID_TO->lookupCacheOption($curVal);
            } else {
                $this->CLINIC_ID_TO->ViewValue = $this->CLINIC_ID_TO->Lookup !== null && is_array($this->CLINIC_ID_TO->Lookup->Options) ? $curVal : null;
            }
            if ($this->CLINIC_ID_TO->ViewValue !== null) { // Load from cache
                $this->CLINIC_ID_TO->EditValue = array_values($this->CLINIC_ID_TO->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[CLINIC_ID]" . SearchString("=", $this->CLINIC_ID_TO->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->CLINIC_ID_TO->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->CLINIC_ID_TO->EditValue = $arwrk;
            }
            $this->CLINIC_ID_TO->PlaceHolder = RemoveHtml($this->CLINIC_ID_TO->caption());

            // MUTATION_DATE
            $this->MUTATION_DATE->EditAttrs["class"] = "form-control";
            $this->MUTATION_DATE->EditCustomAttributes = "";
            $this->MUTATION_DATE->EditValue = HtmlEncode(FormatDateTime($this->MUTATION_DATE->CurrentValue, 11));
            $this->MUTATION_DATE->PlaceHolder = RemoveHtml($this->MUTATION_DATE->caption());

            // MUTATION_VALUE
            $this->MUTATION_VALUE->EditAttrs["class"] = "form-control";
            $this->MUTATION_VALUE->EditCustomAttributes = "";
            $this->MUTATION_VALUE->EditValue = HtmlEncode($this->MUTATION_VALUE->CurrentValue);
            $this->MUTATION_VALUE->PlaceHolder = RemoveHtml($this->MUTATION_VALUE->caption());
            if (strval($this->MUTATION_VALUE->EditValue) != "" && is_numeric($this->MUTATION_VALUE->EditValue)) {
                $this->MUTATION_VALUE->EditValue = FormatNumber($this->MUTATION_VALUE->EditValue, -2, -2, -2, -2);
            }

            // ORDER_VALUE
            $this->ORDER_VALUE->EditAttrs["class"] = "form-control";
            $this->ORDER_VALUE->EditCustomAttributes = "";
            $this->ORDER_VALUE->EditValue = HtmlEncode($this->ORDER_VALUE->CurrentValue);
            $this->ORDER_VALUE->PlaceHolder = RemoveHtml($this->ORDER_VALUE->caption());
            if (strval($this->ORDER_VALUE->EditValue) != "" && is_numeric($this->ORDER_VALUE->EditValue)) {
                $this->ORDER_VALUE->EditValue = FormatNumber($this->ORDER_VALUE->EditValue, -2, -2, -2, -2);
            }

            // RECEIVED_BY
            $this->RECEIVED_BY->EditAttrs["class"] = "form-control";
            $this->RECEIVED_BY->EditCustomAttributes = "";
            if (!$this->RECEIVED_BY->Raw) {
                $this->RECEIVED_BY->CurrentValue = HtmlDecode($this->RECEIVED_BY->CurrentValue);
            }
            $this->RECEIVED_BY->EditValue = HtmlEncode($this->RECEIVED_BY->CurrentValue);
            $this->RECEIVED_BY->PlaceHolder = RemoveHtml($this->RECEIVED_BY->caption());

            // DISTRIBUTION_TYPE
            $this->DISTRIBUTION_TYPE->EditAttrs["class"] = "form-control";
            $this->DISTRIBUTION_TYPE->EditCustomAttributes = "";
            $curVal = trim(strval($this->DISTRIBUTION_TYPE->CurrentValue));
            if ($curVal != "") {
                $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->lookupCacheOption($curVal);
            } else {
                $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->Lookup !== null && is_array($this->DISTRIBUTION_TYPE->Lookup->Options) ? $curVal : null;
            }
            if ($this->DISTRIBUTION_TYPE->ViewValue !== null) { // Load from cache
                $this->DISTRIBUTION_TYPE->EditValue = array_values($this->DISTRIBUTION_TYPE->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "[DISTRIBUTION_TYPE]" . SearchString("=", $this->DISTRIBUTION_TYPE->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->DISTRIBUTION_TYPE->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DISTRIBUTION_TYPE->EditValue = $arwrk;
            }
            $this->DISTRIBUTION_TYPE->PlaceHolder = RemoveHtml($this->DISTRIBUTION_TYPE->caption());

            // Add refer script

            // ORG_UNIT_CODE
            $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
            $this->ORG_UNIT_CODE->HrefValue = "";

            // ORG_ID
            $this->ORG_ID->LinkCustomAttributes = "";
            $this->ORG_ID->HrefValue = "";

            // CLINIC_ID
            $this->CLINIC_ID->LinkCustomAttributes = "";
            $this->CLINIC_ID->HrefValue = "";

            // CLINIC_ID_TO
            $this->CLINIC_ID_TO->LinkCustomAttributes = "";
            $this->CLINIC_ID_TO->HrefValue = "";

            // MUTATION_DATE
            $this->MUTATION_DATE->LinkCustomAttributes = "";
            $this->MUTATION_DATE->HrefValue = "";

            // MUTATION_VALUE
            $this->MUTATION_VALUE->LinkCustomAttributes = "";
            $this->MUTATION_VALUE->HrefValue = "";

            // ORDER_VALUE
            $this->ORDER_VALUE->LinkCustomAttributes = "";
            $this->ORDER_VALUE->HrefValue = "";

            // RECEIVED_BY
            $this->RECEIVED_BY->LinkCustomAttributes = "";
            $this->RECEIVED_BY->HrefValue = "";

            // DISTRIBUTION_TYPE
            $this->DISTRIBUTION_TYPE->LinkCustomAttributes = "";
            $this->DISTRIBUTION_TYPE->HrefValue = "";
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
        if ($this->ORG_ID->Required) {
            if (!$this->ORG_ID->IsDetailKey && EmptyValue($this->ORG_ID->FormValue)) {
                $this->ORG_ID->addErrorMessage(str_replace("%s", $this->ORG_ID->caption(), $this->ORG_ID->RequiredErrorMessage));
            }
        }
        if ($this->CLINIC_ID->Required) {
            if (!$this->CLINIC_ID->IsDetailKey && EmptyValue($this->CLINIC_ID->FormValue)) {
                $this->CLINIC_ID->addErrorMessage(str_replace("%s", $this->CLINIC_ID->caption(), $this->CLINIC_ID->RequiredErrorMessage));
            }
        }
        if ($this->CLINIC_ID_TO->Required) {
            if (!$this->CLINIC_ID_TO->IsDetailKey && EmptyValue($this->CLINIC_ID_TO->FormValue)) {
                $this->CLINIC_ID_TO->addErrorMessage(str_replace("%s", $this->CLINIC_ID_TO->caption(), $this->CLINIC_ID_TO->RequiredErrorMessage));
            }
        }
        if ($this->MUTATION_DATE->Required) {
            if (!$this->MUTATION_DATE->IsDetailKey && EmptyValue($this->MUTATION_DATE->FormValue)) {
                $this->MUTATION_DATE->addErrorMessage(str_replace("%s", $this->MUTATION_DATE->caption(), $this->MUTATION_DATE->RequiredErrorMessage));
            }
        }
        if (!CheckEuroDate($this->MUTATION_DATE->FormValue)) {
            $this->MUTATION_DATE->addErrorMessage($this->MUTATION_DATE->getErrorMessage(false));
        }
        if ($this->MUTATION_VALUE->Required) {
            if (!$this->MUTATION_VALUE->IsDetailKey && EmptyValue($this->MUTATION_VALUE->FormValue)) {
                $this->MUTATION_VALUE->addErrorMessage(str_replace("%s", $this->MUTATION_VALUE->caption(), $this->MUTATION_VALUE->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->MUTATION_VALUE->FormValue)) {
            $this->MUTATION_VALUE->addErrorMessage($this->MUTATION_VALUE->getErrorMessage(false));
        }
        if ($this->ORDER_VALUE->Required) {
            if (!$this->ORDER_VALUE->IsDetailKey && EmptyValue($this->ORDER_VALUE->FormValue)) {
                $this->ORDER_VALUE->addErrorMessage(str_replace("%s", $this->ORDER_VALUE->caption(), $this->ORDER_VALUE->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->ORDER_VALUE->FormValue)) {
            $this->ORDER_VALUE->addErrorMessage($this->ORDER_VALUE->getErrorMessage(false));
        }
        if ($this->RECEIVED_BY->Required) {
            if (!$this->RECEIVED_BY->IsDetailKey && EmptyValue($this->RECEIVED_BY->FormValue)) {
                $this->RECEIVED_BY->addErrorMessage(str_replace("%s", $this->RECEIVED_BY->caption(), $this->RECEIVED_BY->RequiredErrorMessage));
            }
        }
        if ($this->DISTRIBUTION_TYPE->Required) {
            if (!$this->DISTRIBUTION_TYPE->IsDetailKey && EmptyValue($this->DISTRIBUTION_TYPE->FormValue)) {
                $this->DISTRIBUTION_TYPE->addErrorMessage(str_replace("%s", $this->DISTRIBUTION_TYPE->caption(), $this->DISTRIBUTION_TYPE->RequiredErrorMessage));
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
        $this->ORG_UNIT_CODE->CurrentValue = CurrentOrgId();
        $this->ORG_UNIT_CODE->setDbValueDef($rsnew, $this->ORG_UNIT_CODE->CurrentValue, "");

        // ORG_ID
        $this->ORG_ID->setDbValueDef($rsnew, $this->ORG_ID->CurrentValue, null, false);

        // CLINIC_ID
        $this->CLINIC_ID->setDbValueDef($rsnew, $this->CLINIC_ID->CurrentValue, null, false);

        // CLINIC_ID_TO
        $this->CLINIC_ID_TO->setDbValueDef($rsnew, $this->CLINIC_ID_TO->CurrentValue, null, false);

        // MUTATION_DATE
        $this->MUTATION_DATE->setDbValueDef($rsnew, UnFormatDateTime($this->MUTATION_DATE->CurrentValue, 11), null, false);

        // MUTATION_VALUE
        $this->MUTATION_VALUE->setDbValueDef($rsnew, $this->MUTATION_VALUE->CurrentValue, null, false);

        // ORDER_VALUE
        $this->ORDER_VALUE->setDbValueDef($rsnew, $this->ORDER_VALUE->CurrentValue, null, false);

        // RECEIVED_BY
        $this->RECEIVED_BY->setDbValueDef($rsnew, $this->RECEIVED_BY->CurrentValue, null, false);

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->setDbValueDef($rsnew, $this->DISTRIBUTION_TYPE->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['ORG_UNIT_CODE']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['DOC_NO']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("MutationDocsList"), "", $this->TableVar, true);
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
                case "x_CLINIC_ID":
                    break;
                case "x_CLINIC_ID_TO":
                    break;
                case "x_DISTRIBUTION_TYPE":
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
