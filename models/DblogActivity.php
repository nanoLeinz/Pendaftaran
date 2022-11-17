<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for DBLOG_ACTIVITY
 */
class DblogActivity extends DbTable
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
    public $LOG_ID;
    public $LOG_DATE;
    public $LOGINNAME;
    public $_USERID;
    public $SERVERNAME;
    public $DBNAME;
    public $OBJECTTYPE;
    public $OBJECTNAME;
    public $EVENTS;
    public $SCHEMAS;
    public $TSQL;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'DBLOG_ACTIVITY';
        $this->TableName = 'DBLOG_ACTIVITY';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[DBLOG_ACTIVITY]";
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

        // LOG_ID
        $this->LOG_ID = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_LOG_ID', 'LOG_ID', '[LOG_ID]', '[LOG_ID]', 200, 50, -1, false, '[LOG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LOG_ID->IsPrimaryKey = true; // Primary key field
        $this->LOG_ID->Nullable = false; // NOT NULL field
        $this->LOG_ID->Required = true; // Required field
        $this->LOG_ID->Sortable = true; // Allow sort
        $this->LOG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LOG_ID->Param, "CustomMsg");
        $this->Fields['LOG_ID'] = &$this->LOG_ID;

        // LOG_DATE
        $this->LOG_DATE = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_LOG_DATE', 'LOG_DATE', '[LOG_DATE]', CastDateFieldForLike("[LOG_DATE]", 0, "DB"), 135, 8, 0, false, '[LOG_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LOG_DATE->Sortable = true; // Allow sort
        $this->LOG_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->LOG_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LOG_DATE->Param, "CustomMsg");
        $this->Fields['LOG_DATE'] = &$this->LOG_DATE;

        // LOGINNAME
        $this->LOGINNAME = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_LOGINNAME', 'LOGINNAME', '[LOGINNAME]', '[LOGINNAME]', 200, 200, -1, false, '[LOGINNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LOGINNAME->Sortable = true; // Allow sort
        $this->LOGINNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LOGINNAME->Param, "CustomMsg");
        $this->Fields['LOGINNAME'] = &$this->LOGINNAME;

        // USERID
        $this->_USERID = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x__USERID', 'USERID', '[USERID]', '[USERID]', 200, 200, -1, false, '[USERID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_USERID->Sortable = true; // Allow sort
        $this->_USERID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_USERID->Param, "CustomMsg");
        $this->Fields['USERID'] = &$this->_USERID;

        // SERVERNAME
        $this->SERVERNAME = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_SERVERNAME', 'SERVERNAME', '[SERVERNAME]', '[SERVERNAME]', 200, 200, -1, false, '[SERVERNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SERVERNAME->Sortable = true; // Allow sort
        $this->SERVERNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SERVERNAME->Param, "CustomMsg");
        $this->Fields['SERVERNAME'] = &$this->SERVERNAME;

        // DBNAME
        $this->DBNAME = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_DBNAME', 'DBNAME', '[DBNAME]', '[DBNAME]', 200, 200, -1, false, '[DBNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DBNAME->Sortable = true; // Allow sort
        $this->DBNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DBNAME->Param, "CustomMsg");
        $this->Fields['DBNAME'] = &$this->DBNAME;

        // OBJECTTYPE
        $this->OBJECTTYPE = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_OBJECTTYPE', 'OBJECTTYPE', '[OBJECTTYPE]', '[OBJECTTYPE]', 200, 200, -1, false, '[OBJECTTYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECTTYPE->Sortable = true; // Allow sort
        $this->OBJECTTYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECTTYPE->Param, "CustomMsg");
        $this->Fields['OBJECTTYPE'] = &$this->OBJECTTYPE;

        // OBJECTNAME
        $this->OBJECTNAME = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_OBJECTNAME', 'OBJECTNAME', '[OBJECTNAME]', '[OBJECTNAME]', 200, 200, -1, false, '[OBJECTNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECTNAME->Sortable = true; // Allow sort
        $this->OBJECTNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECTNAME->Param, "CustomMsg");
        $this->Fields['OBJECTNAME'] = &$this->OBJECTNAME;

        // EVENTS
        $this->EVENTS = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_EVENTS', 'EVENTS', '[EVENTS]', '[EVENTS]', 200, 200, -1, false, '[EVENTS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EVENTS->Sortable = true; // Allow sort
        $this->EVENTS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EVENTS->Param, "CustomMsg");
        $this->Fields['EVENTS'] = &$this->EVENTS;

        // SCHEMAS
        $this->SCHEMAS = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_SCHEMAS', 'SCHEMAS', '[SCHEMAS]', '[SCHEMAS]', 200, 200, -1, false, '[SCHEMAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SCHEMAS->Sortable = true; // Allow sort
        $this->SCHEMAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SCHEMAS->Param, "CustomMsg");
        $this->Fields['SCHEMAS'] = &$this->SCHEMAS;

        // TSQL
        $this->TSQL = new DbField('DBLOG_ACTIVITY', 'DBLOG_ACTIVITY', 'x_TSQL', 'TSQL', '[TSQL]', '[TSQL]', 201, 0, -1, false, '[TSQL]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->TSQL->Sortable = true; // Allow sort
        $this->TSQL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TSQL->Param, "CustomMsg");
        $this->Fields['TSQL'] = &$this->TSQL;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[DBLOG_ACTIVITY]";
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
            if (array_key_exists('LOG_ID', $rs)) {
                AddFilter($where, QuotedName('LOG_ID', $this->Dbid) . '=' . QuotedValue($rs['LOG_ID'], $this->LOG_ID->DataType, $this->Dbid));
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
        $this->LOG_ID->DbValue = $row['LOG_ID'];
        $this->LOG_DATE->DbValue = $row['LOG_DATE'];
        $this->LOGINNAME->DbValue = $row['LOGINNAME'];
        $this->_USERID->DbValue = $row['USERID'];
        $this->SERVERNAME->DbValue = $row['SERVERNAME'];
        $this->DBNAME->DbValue = $row['DBNAME'];
        $this->OBJECTTYPE->DbValue = $row['OBJECTTYPE'];
        $this->OBJECTNAME->DbValue = $row['OBJECTNAME'];
        $this->EVENTS->DbValue = $row['EVENTS'];
        $this->SCHEMAS->DbValue = $row['SCHEMAS'];
        $this->TSQL->DbValue = $row['TSQL'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[LOG_ID] = '@LOG_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->LOG_ID->CurrentValue : $this->LOG_ID->OldValue;
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
                $this->LOG_ID->CurrentValue = $keys[0];
            } else {
                $this->LOG_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('LOG_ID', $row) ? $row['LOG_ID'] : null;
        } else {
            $val = $this->LOG_ID->OldValue !== null ? $this->LOG_ID->OldValue : $this->LOG_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@LOG_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("DblogActivityList");
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
        if ($pageName == "DblogActivityView") {
            return $Language->phrase("View");
        } elseif ($pageName == "DblogActivityEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "DblogActivityAdd") {
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
                return "DblogActivityView";
            case Config("API_ADD_ACTION"):
                return "DblogActivityAdd";
            case Config("API_EDIT_ACTION"):
                return "DblogActivityEdit";
            case Config("API_DELETE_ACTION"):
                return "DblogActivityDelete";
            case Config("API_LIST_ACTION"):
                return "DblogActivityList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "DblogActivityList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("DblogActivityView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("DblogActivityView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "DblogActivityAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "DblogActivityAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("DblogActivityEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("DblogActivityAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("DblogActivityDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "LOG_ID:" . JsonEncode($this->LOG_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->LOG_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->LOG_ID->CurrentValue);
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
            if (($keyValue = Param("LOG_ID") ?? Route("LOG_ID")) !== null) {
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
                $this->LOG_ID->CurrentValue = $key;
            } else {
                $this->LOG_ID->OldValue = $key;
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
        $this->LOG_ID->setDbValue($row['LOG_ID']);
        $this->LOG_DATE->setDbValue($row['LOG_DATE']);
        $this->LOGINNAME->setDbValue($row['LOGINNAME']);
        $this->_USERID->setDbValue($row['USERID']);
        $this->SERVERNAME->setDbValue($row['SERVERNAME']);
        $this->DBNAME->setDbValue($row['DBNAME']);
        $this->OBJECTTYPE->setDbValue($row['OBJECTTYPE']);
        $this->OBJECTNAME->setDbValue($row['OBJECTNAME']);
        $this->EVENTS->setDbValue($row['EVENTS']);
        $this->SCHEMAS->setDbValue($row['SCHEMAS']);
        $this->TSQL->setDbValue($row['TSQL']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // LOG_ID

        // LOG_DATE

        // LOGINNAME

        // USERID

        // SERVERNAME

        // DBNAME

        // OBJECTTYPE

        // OBJECTNAME

        // EVENTS

        // SCHEMAS

        // TSQL

        // LOG_ID
        $this->LOG_ID->ViewValue = $this->LOG_ID->CurrentValue;
        $this->LOG_ID->ViewCustomAttributes = "";

        // LOG_DATE
        $this->LOG_DATE->ViewValue = $this->LOG_DATE->CurrentValue;
        $this->LOG_DATE->ViewValue = FormatDateTime($this->LOG_DATE->ViewValue, 0);
        $this->LOG_DATE->ViewCustomAttributes = "";

        // LOGINNAME
        $this->LOGINNAME->ViewValue = $this->LOGINNAME->CurrentValue;
        $this->LOGINNAME->ViewCustomAttributes = "";

        // USERID
        $this->_USERID->ViewValue = $this->_USERID->CurrentValue;
        $this->_USERID->ViewCustomAttributes = "";

        // SERVERNAME
        $this->SERVERNAME->ViewValue = $this->SERVERNAME->CurrentValue;
        $this->SERVERNAME->ViewCustomAttributes = "";

        // DBNAME
        $this->DBNAME->ViewValue = $this->DBNAME->CurrentValue;
        $this->DBNAME->ViewCustomAttributes = "";

        // OBJECTTYPE
        $this->OBJECTTYPE->ViewValue = $this->OBJECTTYPE->CurrentValue;
        $this->OBJECTTYPE->ViewCustomAttributes = "";

        // OBJECTNAME
        $this->OBJECTNAME->ViewValue = $this->OBJECTNAME->CurrentValue;
        $this->OBJECTNAME->ViewCustomAttributes = "";

        // EVENTS
        $this->EVENTS->ViewValue = $this->EVENTS->CurrentValue;
        $this->EVENTS->ViewCustomAttributes = "";

        // SCHEMAS
        $this->SCHEMAS->ViewValue = $this->SCHEMAS->CurrentValue;
        $this->SCHEMAS->ViewCustomAttributes = "";

        // TSQL
        $this->TSQL->ViewValue = $this->TSQL->CurrentValue;
        $this->TSQL->ViewCustomAttributes = "";

        // LOG_ID
        $this->LOG_ID->LinkCustomAttributes = "";
        $this->LOG_ID->HrefValue = "";
        $this->LOG_ID->TooltipValue = "";

        // LOG_DATE
        $this->LOG_DATE->LinkCustomAttributes = "";
        $this->LOG_DATE->HrefValue = "";
        $this->LOG_DATE->TooltipValue = "";

        // LOGINNAME
        $this->LOGINNAME->LinkCustomAttributes = "";
        $this->LOGINNAME->HrefValue = "";
        $this->LOGINNAME->TooltipValue = "";

        // USERID
        $this->_USERID->LinkCustomAttributes = "";
        $this->_USERID->HrefValue = "";
        $this->_USERID->TooltipValue = "";

        // SERVERNAME
        $this->SERVERNAME->LinkCustomAttributes = "";
        $this->SERVERNAME->HrefValue = "";
        $this->SERVERNAME->TooltipValue = "";

        // DBNAME
        $this->DBNAME->LinkCustomAttributes = "";
        $this->DBNAME->HrefValue = "";
        $this->DBNAME->TooltipValue = "";

        // OBJECTTYPE
        $this->OBJECTTYPE->LinkCustomAttributes = "";
        $this->OBJECTTYPE->HrefValue = "";
        $this->OBJECTTYPE->TooltipValue = "";

        // OBJECTNAME
        $this->OBJECTNAME->LinkCustomAttributes = "";
        $this->OBJECTNAME->HrefValue = "";
        $this->OBJECTNAME->TooltipValue = "";

        // EVENTS
        $this->EVENTS->LinkCustomAttributes = "";
        $this->EVENTS->HrefValue = "";
        $this->EVENTS->TooltipValue = "";

        // SCHEMAS
        $this->SCHEMAS->LinkCustomAttributes = "";
        $this->SCHEMAS->HrefValue = "";
        $this->SCHEMAS->TooltipValue = "";

        // TSQL
        $this->TSQL->LinkCustomAttributes = "";
        $this->TSQL->HrefValue = "";
        $this->TSQL->TooltipValue = "";

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

        // LOG_ID
        $this->LOG_ID->EditAttrs["class"] = "form-control";
        $this->LOG_ID->EditCustomAttributes = "";
        if (!$this->LOG_ID->Raw) {
            $this->LOG_ID->CurrentValue = HtmlDecode($this->LOG_ID->CurrentValue);
        }
        $this->LOG_ID->EditValue = $this->LOG_ID->CurrentValue;
        $this->LOG_ID->PlaceHolder = RemoveHtml($this->LOG_ID->caption());

        // LOG_DATE
        $this->LOG_DATE->EditAttrs["class"] = "form-control";
        $this->LOG_DATE->EditCustomAttributes = "";
        $this->LOG_DATE->EditValue = FormatDateTime($this->LOG_DATE->CurrentValue, 8);
        $this->LOG_DATE->PlaceHolder = RemoveHtml($this->LOG_DATE->caption());

        // LOGINNAME
        $this->LOGINNAME->EditAttrs["class"] = "form-control";
        $this->LOGINNAME->EditCustomAttributes = "";
        if (!$this->LOGINNAME->Raw) {
            $this->LOGINNAME->CurrentValue = HtmlDecode($this->LOGINNAME->CurrentValue);
        }
        $this->LOGINNAME->EditValue = $this->LOGINNAME->CurrentValue;
        $this->LOGINNAME->PlaceHolder = RemoveHtml($this->LOGINNAME->caption());

        // USERID
        $this->_USERID->EditAttrs["class"] = "form-control";
        $this->_USERID->EditCustomAttributes = "";
        if (!$this->_USERID->Raw) {
            $this->_USERID->CurrentValue = HtmlDecode($this->_USERID->CurrentValue);
        }
        $this->_USERID->EditValue = $this->_USERID->CurrentValue;
        $this->_USERID->PlaceHolder = RemoveHtml($this->_USERID->caption());

        // SERVERNAME
        $this->SERVERNAME->EditAttrs["class"] = "form-control";
        $this->SERVERNAME->EditCustomAttributes = "";
        if (!$this->SERVERNAME->Raw) {
            $this->SERVERNAME->CurrentValue = HtmlDecode($this->SERVERNAME->CurrentValue);
        }
        $this->SERVERNAME->EditValue = $this->SERVERNAME->CurrentValue;
        $this->SERVERNAME->PlaceHolder = RemoveHtml($this->SERVERNAME->caption());

        // DBNAME
        $this->DBNAME->EditAttrs["class"] = "form-control";
        $this->DBNAME->EditCustomAttributes = "";
        if (!$this->DBNAME->Raw) {
            $this->DBNAME->CurrentValue = HtmlDecode($this->DBNAME->CurrentValue);
        }
        $this->DBNAME->EditValue = $this->DBNAME->CurrentValue;
        $this->DBNAME->PlaceHolder = RemoveHtml($this->DBNAME->caption());

        // OBJECTTYPE
        $this->OBJECTTYPE->EditAttrs["class"] = "form-control";
        $this->OBJECTTYPE->EditCustomAttributes = "";
        if (!$this->OBJECTTYPE->Raw) {
            $this->OBJECTTYPE->CurrentValue = HtmlDecode($this->OBJECTTYPE->CurrentValue);
        }
        $this->OBJECTTYPE->EditValue = $this->OBJECTTYPE->CurrentValue;
        $this->OBJECTTYPE->PlaceHolder = RemoveHtml($this->OBJECTTYPE->caption());

        // OBJECTNAME
        $this->OBJECTNAME->EditAttrs["class"] = "form-control";
        $this->OBJECTNAME->EditCustomAttributes = "";
        if (!$this->OBJECTNAME->Raw) {
            $this->OBJECTNAME->CurrentValue = HtmlDecode($this->OBJECTNAME->CurrentValue);
        }
        $this->OBJECTNAME->EditValue = $this->OBJECTNAME->CurrentValue;
        $this->OBJECTNAME->PlaceHolder = RemoveHtml($this->OBJECTNAME->caption());

        // EVENTS
        $this->EVENTS->EditAttrs["class"] = "form-control";
        $this->EVENTS->EditCustomAttributes = "";
        if (!$this->EVENTS->Raw) {
            $this->EVENTS->CurrentValue = HtmlDecode($this->EVENTS->CurrentValue);
        }
        $this->EVENTS->EditValue = $this->EVENTS->CurrentValue;
        $this->EVENTS->PlaceHolder = RemoveHtml($this->EVENTS->caption());

        // SCHEMAS
        $this->SCHEMAS->EditAttrs["class"] = "form-control";
        $this->SCHEMAS->EditCustomAttributes = "";
        if (!$this->SCHEMAS->Raw) {
            $this->SCHEMAS->CurrentValue = HtmlDecode($this->SCHEMAS->CurrentValue);
        }
        $this->SCHEMAS->EditValue = $this->SCHEMAS->CurrentValue;
        $this->SCHEMAS->PlaceHolder = RemoveHtml($this->SCHEMAS->caption());

        // TSQL
        $this->TSQL->EditAttrs["class"] = "form-control";
        $this->TSQL->EditCustomAttributes = "";
        $this->TSQL->EditValue = $this->TSQL->CurrentValue;
        $this->TSQL->PlaceHolder = RemoveHtml($this->TSQL->caption());

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
                    $doc->exportCaption($this->LOG_ID);
                    $doc->exportCaption($this->LOG_DATE);
                    $doc->exportCaption($this->LOGINNAME);
                    $doc->exportCaption($this->_USERID);
                    $doc->exportCaption($this->SERVERNAME);
                    $doc->exportCaption($this->DBNAME);
                    $doc->exportCaption($this->OBJECTTYPE);
                    $doc->exportCaption($this->OBJECTNAME);
                    $doc->exportCaption($this->EVENTS);
                    $doc->exportCaption($this->SCHEMAS);
                    $doc->exportCaption($this->TSQL);
                } else {
                    $doc->exportCaption($this->LOG_ID);
                    $doc->exportCaption($this->LOG_DATE);
                    $doc->exportCaption($this->LOGINNAME);
                    $doc->exportCaption($this->_USERID);
                    $doc->exportCaption($this->SERVERNAME);
                    $doc->exportCaption($this->DBNAME);
                    $doc->exportCaption($this->OBJECTTYPE);
                    $doc->exportCaption($this->OBJECTNAME);
                    $doc->exportCaption($this->EVENTS);
                    $doc->exportCaption($this->SCHEMAS);
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
                        $doc->exportField($this->LOG_ID);
                        $doc->exportField($this->LOG_DATE);
                        $doc->exportField($this->LOGINNAME);
                        $doc->exportField($this->_USERID);
                        $doc->exportField($this->SERVERNAME);
                        $doc->exportField($this->DBNAME);
                        $doc->exportField($this->OBJECTTYPE);
                        $doc->exportField($this->OBJECTNAME);
                        $doc->exportField($this->EVENTS);
                        $doc->exportField($this->SCHEMAS);
                        $doc->exportField($this->TSQL);
                    } else {
                        $doc->exportField($this->LOG_ID);
                        $doc->exportField($this->LOG_DATE);
                        $doc->exportField($this->LOGINNAME);
                        $doc->exportField($this->_USERID);
                        $doc->exportField($this->SERVERNAME);
                        $doc->exportField($this->DBNAME);
                        $doc->exportField($this->OBJECTTYPE);
                        $doc->exportField($this->OBJECTNAME);
                        $doc->exportField($this->EVENTS);
                        $doc->exportField($this->SCHEMAS);
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
