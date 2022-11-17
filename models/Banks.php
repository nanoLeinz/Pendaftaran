<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for BANKS
 */
class Banks extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $BANK_ID;
    public $BANKS;
    public $TADDRESS;
    public $CITY;
    public $PHONE;
    public $FAX;
    public $ISBRANCH;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'BANKS';
        $this->TableName = 'BANKS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[BANKS]";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // BANK_ID
        $this->BANK_ID = new DbField('BANKS', 'BANKS', 'x_BANK_ID', 'BANK_ID', '[BANK_ID]', 'CAST([BANK_ID] AS NVARCHAR)', 17, 1, -1, false, '[BANK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANK_ID->IsPrimaryKey = true; // Primary key field
        $this->BANK_ID->Nullable = false; // NOT NULL field
        $this->BANK_ID->Required = true; // Required field
        $this->BANK_ID->Sortable = true; // Allow sort
        $this->BANK_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BANK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANK_ID->Param, "CustomMsg");
        $this->Fields['BANK_ID'] = &$this->BANK_ID;

        // BANKS
        $this->BANKS = new DbField('BANKS', 'BANKS', 'x_BANKS', 'BANKS', '[BANKS]', '[BANKS]', 200, 100, -1, false, '[BANKS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANKS->Sortable = true; // Allow sort
        $this->BANKS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANKS->Param, "CustomMsg");
        $this->Fields['BANKS'] = &$this->BANKS;

        // TADDRESS
        $this->TADDRESS = new DbField('BANKS', 'BANKS', 'x_TADDRESS', 'TADDRESS', '[TADDRESS]', '[TADDRESS]', 200, 255, -1, false, '[TADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TADDRESS->Sortable = true; // Allow sort
        $this->TADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TADDRESS->Param, "CustomMsg");
        $this->Fields['TADDRESS'] = &$this->TADDRESS;

        // CITY
        $this->CITY = new DbField('BANKS', 'BANKS', 'x_CITY', 'CITY', '[CITY]', '[CITY]', 200, 100, -1, false, '[CITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CITY->Sortable = true; // Allow sort
        $this->CITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CITY->Param, "CustomMsg");
        $this->Fields['CITY'] = &$this->CITY;

        // PHONE
        $this->PHONE = new DbField('BANKS', 'BANKS', 'x_PHONE', 'PHONE', '[PHONE]', '[PHONE]', 200, 100, -1, false, '[PHONE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE->Sortable = true; // Allow sort
        $this->PHONE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE->Param, "CustomMsg");
        $this->Fields['PHONE'] = &$this->PHONE;

        // FAX
        $this->FAX = new DbField('BANKS', 'BANKS', 'x_FAX', 'FAX', '[FAX]', '[FAX]', 200, 100, -1, false, '[FAX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX->Sortable = true; // Allow sort
        $this->FAX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX->Param, "CustomMsg");
        $this->Fields['FAX'] = &$this->FAX;

        // ISBRANCH
        $this->ISBRANCH = new DbField('BANKS', 'BANKS', 'x_ISBRANCH', 'ISBRANCH', '[ISBRANCH]', '[ISBRANCH]', 129, 1, -1, false, '[ISBRANCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISBRANCH->Sortable = true; // Allow sort
        $this->ISBRANCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISBRANCH->Param, "CustomMsg");
        $this->Fields['ISBRANCH'] = &$this->ISBRANCH;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[BANKS]";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('BANK_ID', $rs)) {
                AddFilter($where, QuotedName('BANK_ID', $this->Dbid) . '=' . QuotedValue($rs['BANK_ID'], $this->BANK_ID->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->BANK_ID->DbValue = $row['BANK_ID'];
        $this->BANKS->DbValue = $row['BANKS'];
        $this->TADDRESS->DbValue = $row['TADDRESS'];
        $this->CITY->DbValue = $row['CITY'];
        $this->PHONE->DbValue = $row['PHONE'];
        $this->FAX->DbValue = $row['FAX'];
        $this->ISBRANCH->DbValue = $row['ISBRANCH'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[BANK_ID] = @BANK_ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->BANK_ID->CurrentValue : $this->BANK_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->BANK_ID->CurrentValue = $keys[0];
            } else {
                $this->BANK_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('BANK_ID', $row) ? $row['BANK_ID'] : null;
        } else {
            $val = $this->BANK_ID->OldValue !== null ? $this->BANK_ID->OldValue : $this->BANK_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@BANK_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("BanksList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "BanksView") {
            return $Language->phrase("View");
        } elseif ($pageName == "BanksEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "BanksAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "BanksView";
            case Config("API_ADD_ACTION"):
                return "BanksAdd";
            case Config("API_EDIT_ACTION"):
                return "BanksEdit";
            case Config("API_DELETE_ACTION"):
                return "BanksDelete";
            case Config("API_LIST_ACTION"):
                return "BanksList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "BanksList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BanksView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("BanksView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BanksAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "BanksAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BanksEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("BanksAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("BanksDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "BANK_ID:" . JsonEncode($this->BANK_ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->BANK_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BANK_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [141, 201, 203, 128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("BANK_ID") ?? Route("BANK_ID")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->BANK_ID->CurrentValue = $key;
            } else {
                $this->BANK_ID->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->BANK_ID->setDbValue($row['BANK_ID']);
        $this->BANKS->setDbValue($row['BANKS']);
        $this->TADDRESS->setDbValue($row['TADDRESS']);
        $this->CITY->setDbValue($row['CITY']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->FAX->setDbValue($row['FAX']);
        $this->ISBRANCH->setDbValue($row['ISBRANCH']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // BANK_ID

        // BANKS

        // TADDRESS

        // CITY

        // PHONE

        // FAX

        // ISBRANCH

        // BANK_ID
        $this->BANK_ID->ViewValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->ViewValue = FormatNumber($this->BANK_ID->ViewValue, 0, -2, -2, -2);
        $this->BANK_ID->ViewCustomAttributes = "";

        // BANKS
        $this->BANKS->ViewValue = $this->BANKS->CurrentValue;
        $this->BANKS->ViewCustomAttributes = "";

        // TADDRESS
        $this->TADDRESS->ViewValue = $this->TADDRESS->CurrentValue;
        $this->TADDRESS->ViewCustomAttributes = "";

        // CITY
        $this->CITY->ViewValue = $this->CITY->CurrentValue;
        $this->CITY->ViewCustomAttributes = "";

        // PHONE
        $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
        $this->PHONE->ViewCustomAttributes = "";

        // FAX
        $this->FAX->ViewValue = $this->FAX->CurrentValue;
        $this->FAX->ViewCustomAttributes = "";

        // ISBRANCH
        $this->ISBRANCH->ViewValue = $this->ISBRANCH->CurrentValue;
        $this->ISBRANCH->ViewCustomAttributes = "";

        // BANK_ID
        $this->BANK_ID->LinkCustomAttributes = "";
        $this->BANK_ID->HrefValue = "";
        $this->BANK_ID->TooltipValue = "";

        // BANKS
        $this->BANKS->LinkCustomAttributes = "";
        $this->BANKS->HrefValue = "";
        $this->BANKS->TooltipValue = "";

        // TADDRESS
        $this->TADDRESS->LinkCustomAttributes = "";
        $this->TADDRESS->HrefValue = "";
        $this->TADDRESS->TooltipValue = "";

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

        // ISBRANCH
        $this->ISBRANCH->LinkCustomAttributes = "";
        $this->ISBRANCH->HrefValue = "";
        $this->ISBRANCH->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // BANK_ID
        $this->BANK_ID->EditAttrs["class"] = "form-control";
        $this->BANK_ID->EditCustomAttributes = "";
        $this->BANK_ID->EditValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->PlaceHolder = RemoveHtml($this->BANK_ID->caption());

        // BANKS
        $this->BANKS->EditAttrs["class"] = "form-control";
        $this->BANKS->EditCustomAttributes = "";
        if (!$this->BANKS->Raw) {
            $this->BANKS->CurrentValue = HtmlDecode($this->BANKS->CurrentValue);
        }
        $this->BANKS->EditValue = $this->BANKS->CurrentValue;
        $this->BANKS->PlaceHolder = RemoveHtml($this->BANKS->caption());

        // TADDRESS
        $this->TADDRESS->EditAttrs["class"] = "form-control";
        $this->TADDRESS->EditCustomAttributes = "";
        if (!$this->TADDRESS->Raw) {
            $this->TADDRESS->CurrentValue = HtmlDecode($this->TADDRESS->CurrentValue);
        }
        $this->TADDRESS->EditValue = $this->TADDRESS->CurrentValue;
        $this->TADDRESS->PlaceHolder = RemoveHtml($this->TADDRESS->caption());

        // CITY
        $this->CITY->EditAttrs["class"] = "form-control";
        $this->CITY->EditCustomAttributes = "";
        if (!$this->CITY->Raw) {
            $this->CITY->CurrentValue = HtmlDecode($this->CITY->CurrentValue);
        }
        $this->CITY->EditValue = $this->CITY->CurrentValue;
        $this->CITY->PlaceHolder = RemoveHtml($this->CITY->caption());

        // PHONE
        $this->PHONE->EditAttrs["class"] = "form-control";
        $this->PHONE->EditCustomAttributes = "";
        if (!$this->PHONE->Raw) {
            $this->PHONE->CurrentValue = HtmlDecode($this->PHONE->CurrentValue);
        }
        $this->PHONE->EditValue = $this->PHONE->CurrentValue;
        $this->PHONE->PlaceHolder = RemoveHtml($this->PHONE->caption());

        // FAX
        $this->FAX->EditAttrs["class"] = "form-control";
        $this->FAX->EditCustomAttributes = "";
        if (!$this->FAX->Raw) {
            $this->FAX->CurrentValue = HtmlDecode($this->FAX->CurrentValue);
        }
        $this->FAX->EditValue = $this->FAX->CurrentValue;
        $this->FAX->PlaceHolder = RemoveHtml($this->FAX->caption());

        // ISBRANCH
        $this->ISBRANCH->EditAttrs["class"] = "form-control";
        $this->ISBRANCH->EditCustomAttributes = "";
        if (!$this->ISBRANCH->Raw) {
            $this->ISBRANCH->CurrentValue = HtmlDecode($this->ISBRANCH->CurrentValue);
        }
        $this->ISBRANCH->EditValue = $this->ISBRANCH->CurrentValue;
        $this->ISBRANCH->PlaceHolder = RemoveHtml($this->ISBRANCH->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->BANKS);
                    $doc->exportCaption($this->TADDRESS);
                    $doc->exportCaption($this->CITY);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->ISBRANCH);
                } else {
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->BANKS);
                    $doc->exportCaption($this->TADDRESS);
                    $doc->exportCaption($this->CITY);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->ISBRANCH);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->BANKS);
                        $doc->exportField($this->TADDRESS);
                        $doc->exportField($this->CITY);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->ISBRANCH);
                    } else {
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->BANKS);
                        $doc->exportField($this->TADDRESS);
                        $doc->exportField($this->CITY);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->ISBRANCH);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
