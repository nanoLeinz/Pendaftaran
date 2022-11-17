<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for SALARY_PERIOD
 */
class SalaryPeriod extends DbTable
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
    public $MONTHID;
    public $PERIOD_NAME;
    public $STARTDATE;
    public $STARTMONTH;
    public $ENDDATE;
    public $ENDMONTH;
    public $PAIDDATE;
    public $PAIDMONTH;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'SALARY_PERIOD';
        $this->TableName = 'SALARY_PERIOD';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[SALARY_PERIOD]";
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

        // MONTHID
        $this->MONTHID = new DbField('SALARY_PERIOD', 'SALARY_PERIOD', 'x_MONTHID', 'MONTHID', '[MONTHID]', 'CAST([MONTHID] AS NVARCHAR)', 17, 1, -1, false, '[MONTHID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MONTHID->IsPrimaryKey = true; // Primary key field
        $this->MONTHID->Nullable = false; // NOT NULL field
        $this->MONTHID->Required = true; // Required field
        $this->MONTHID->Sortable = true; // Allow sort
        $this->MONTHID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MONTHID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MONTHID->Param, "CustomMsg");
        $this->Fields['MONTHID'] = &$this->MONTHID;

        // PERIOD_NAME
        $this->PERIOD_NAME = new DbField('SALARY_PERIOD', 'SALARY_PERIOD', 'x_PERIOD_NAME', 'PERIOD_NAME', '[PERIOD_NAME]', '[PERIOD_NAME]', 200, 50, -1, false, '[PERIOD_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PERIOD_NAME->Sortable = true; // Allow sort
        $this->PERIOD_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PERIOD_NAME->Param, "CustomMsg");
        $this->Fields['PERIOD_NAME'] = &$this->PERIOD_NAME;

        // STARTDATE
        $this->STARTDATE = new DbField('SALARY_PERIOD', 'SALARY_PERIOD', 'x_STARTDATE', 'STARTDATE', '[STARTDATE]', 'CAST([STARTDATE] AS NVARCHAR)', 17, 1, -1, false, '[STARTDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STARTDATE->Sortable = true; // Allow sort
        $this->STARTDATE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STARTDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STARTDATE->Param, "CustomMsg");
        $this->Fields['STARTDATE'] = &$this->STARTDATE;

        // STARTMONTH
        $this->STARTMONTH = new DbField('SALARY_PERIOD', 'SALARY_PERIOD', 'x_STARTMONTH', 'STARTMONTH', '[STARTMONTH]', 'CAST([STARTMONTH] AS NVARCHAR)', 17, 1, -1, false, '[STARTMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STARTMONTH->Sortable = true; // Allow sort
        $this->STARTMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STARTMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STARTMONTH->Param, "CustomMsg");
        $this->Fields['STARTMONTH'] = &$this->STARTMONTH;

        // ENDDATE
        $this->ENDDATE = new DbField('SALARY_PERIOD', 'SALARY_PERIOD', 'x_ENDDATE', 'ENDDATE', '[ENDDATE]', 'CAST([ENDDATE] AS NVARCHAR)', 17, 1, -1, false, '[ENDDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ENDDATE->Sortable = true; // Allow sort
        $this->ENDDATE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ENDDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ENDDATE->Param, "CustomMsg");
        $this->Fields['ENDDATE'] = &$this->ENDDATE;

        // ENDMONTH
        $this->ENDMONTH = new DbField('SALARY_PERIOD', 'SALARY_PERIOD', 'x_ENDMONTH', 'ENDMONTH', '[ENDMONTH]', 'CAST([ENDMONTH] AS NVARCHAR)', 17, 1, -1, false, '[ENDMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ENDMONTH->Sortable = true; // Allow sort
        $this->ENDMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ENDMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ENDMONTH->Param, "CustomMsg");
        $this->Fields['ENDMONTH'] = &$this->ENDMONTH;

        // PAIDDATE
        $this->PAIDDATE = new DbField('SALARY_PERIOD', 'SALARY_PERIOD', 'x_PAIDDATE', 'PAIDDATE', '[PAIDDATE]', 'CAST([PAIDDATE] AS NVARCHAR)', 17, 1, -1, false, '[PAIDDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAIDDATE->Sortable = true; // Allow sort
        $this->PAIDDATE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PAIDDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAIDDATE->Param, "CustomMsg");
        $this->Fields['PAIDDATE'] = &$this->PAIDDATE;

        // PAIDMONTH
        $this->PAIDMONTH = new DbField('SALARY_PERIOD', 'SALARY_PERIOD', 'x_PAIDMONTH', 'PAIDMONTH', '[PAIDMONTH]', 'CAST([PAIDMONTH] AS NVARCHAR)', 17, 1, -1, false, '[PAIDMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAIDMONTH->Sortable = true; // Allow sort
        $this->PAIDMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PAIDMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAIDMONTH->Param, "CustomMsg");
        $this->Fields['PAIDMONTH'] = &$this->PAIDMONTH;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[SALARY_PERIOD]";
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
            if (array_key_exists('MONTHID', $rs)) {
                AddFilter($where, QuotedName('MONTHID', $this->Dbid) . '=' . QuotedValue($rs['MONTHID'], $this->MONTHID->DataType, $this->Dbid));
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
        $this->MONTHID->DbValue = $row['MONTHID'];
        $this->PERIOD_NAME->DbValue = $row['PERIOD_NAME'];
        $this->STARTDATE->DbValue = $row['STARTDATE'];
        $this->STARTMONTH->DbValue = $row['STARTMONTH'];
        $this->ENDDATE->DbValue = $row['ENDDATE'];
        $this->ENDMONTH->DbValue = $row['ENDMONTH'];
        $this->PAIDDATE->DbValue = $row['PAIDDATE'];
        $this->PAIDMONTH->DbValue = $row['PAIDMONTH'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[MONTHID] = @MONTHID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->MONTHID->CurrentValue : $this->MONTHID->OldValue;
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
                $this->MONTHID->CurrentValue = $keys[0];
            } else {
                $this->MONTHID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('MONTHID', $row) ? $row['MONTHID'] : null;
        } else {
            $val = $this->MONTHID->OldValue !== null ? $this->MONTHID->OldValue : $this->MONTHID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@MONTHID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("SalaryPeriodList");
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
        if ($pageName == "SalaryPeriodView") {
            return $Language->phrase("View");
        } elseif ($pageName == "SalaryPeriodEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "SalaryPeriodAdd") {
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
                return "SalaryPeriodView";
            case Config("API_ADD_ACTION"):
                return "SalaryPeriodAdd";
            case Config("API_EDIT_ACTION"):
                return "SalaryPeriodEdit";
            case Config("API_DELETE_ACTION"):
                return "SalaryPeriodDelete";
            case Config("API_LIST_ACTION"):
                return "SalaryPeriodList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "SalaryPeriodList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SalaryPeriodView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("SalaryPeriodView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SalaryPeriodAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "SalaryPeriodAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SalaryPeriodEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("SalaryPeriodAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("SalaryPeriodDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "MONTHID:" . JsonEncode($this->MONTHID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->MONTHID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->MONTHID->CurrentValue);
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
            if (($keyValue = Param("MONTHID") ?? Route("MONTHID")) !== null) {
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
                $this->MONTHID->CurrentValue = $key;
            } else {
                $this->MONTHID->OldValue = $key;
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
        $this->MONTHID->setDbValue($row['MONTHID']);
        $this->PERIOD_NAME->setDbValue($row['PERIOD_NAME']);
        $this->STARTDATE->setDbValue($row['STARTDATE']);
        $this->STARTMONTH->setDbValue($row['STARTMONTH']);
        $this->ENDDATE->setDbValue($row['ENDDATE']);
        $this->ENDMONTH->setDbValue($row['ENDMONTH']);
        $this->PAIDDATE->setDbValue($row['PAIDDATE']);
        $this->PAIDMONTH->setDbValue($row['PAIDMONTH']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // MONTHID

        // PERIOD_NAME

        // STARTDATE

        // STARTMONTH

        // ENDDATE

        // ENDMONTH

        // PAIDDATE

        // PAIDMONTH

        // MONTHID
        $this->MONTHID->ViewValue = $this->MONTHID->CurrentValue;
        $this->MONTHID->ViewValue = FormatNumber($this->MONTHID->ViewValue, 0, -2, -2, -2);
        $this->MONTHID->ViewCustomAttributes = "";

        // PERIOD_NAME
        $this->PERIOD_NAME->ViewValue = $this->PERIOD_NAME->CurrentValue;
        $this->PERIOD_NAME->ViewCustomAttributes = "";

        // STARTDATE
        $this->STARTDATE->ViewValue = $this->STARTDATE->CurrentValue;
        $this->STARTDATE->ViewValue = FormatNumber($this->STARTDATE->ViewValue, 0, -2, -2, -2);
        $this->STARTDATE->ViewCustomAttributes = "";

        // STARTMONTH
        $this->STARTMONTH->ViewValue = $this->STARTMONTH->CurrentValue;
        $this->STARTMONTH->ViewValue = FormatNumber($this->STARTMONTH->ViewValue, 0, -2, -2, -2);
        $this->STARTMONTH->ViewCustomAttributes = "";

        // ENDDATE
        $this->ENDDATE->ViewValue = $this->ENDDATE->CurrentValue;
        $this->ENDDATE->ViewValue = FormatNumber($this->ENDDATE->ViewValue, 0, -2, -2, -2);
        $this->ENDDATE->ViewCustomAttributes = "";

        // ENDMONTH
        $this->ENDMONTH->ViewValue = $this->ENDMONTH->CurrentValue;
        $this->ENDMONTH->ViewValue = FormatNumber($this->ENDMONTH->ViewValue, 0, -2, -2, -2);
        $this->ENDMONTH->ViewCustomAttributes = "";

        // PAIDDATE
        $this->PAIDDATE->ViewValue = $this->PAIDDATE->CurrentValue;
        $this->PAIDDATE->ViewValue = FormatNumber($this->PAIDDATE->ViewValue, 0, -2, -2, -2);
        $this->PAIDDATE->ViewCustomAttributes = "";

        // PAIDMONTH
        $this->PAIDMONTH->ViewValue = $this->PAIDMONTH->CurrentValue;
        $this->PAIDMONTH->ViewValue = FormatNumber($this->PAIDMONTH->ViewValue, 0, -2, -2, -2);
        $this->PAIDMONTH->ViewCustomAttributes = "";

        // MONTHID
        $this->MONTHID->LinkCustomAttributes = "";
        $this->MONTHID->HrefValue = "";
        $this->MONTHID->TooltipValue = "";

        // PERIOD_NAME
        $this->PERIOD_NAME->LinkCustomAttributes = "";
        $this->PERIOD_NAME->HrefValue = "";
        $this->PERIOD_NAME->TooltipValue = "";

        // STARTDATE
        $this->STARTDATE->LinkCustomAttributes = "";
        $this->STARTDATE->HrefValue = "";
        $this->STARTDATE->TooltipValue = "";

        // STARTMONTH
        $this->STARTMONTH->LinkCustomAttributes = "";
        $this->STARTMONTH->HrefValue = "";
        $this->STARTMONTH->TooltipValue = "";

        // ENDDATE
        $this->ENDDATE->LinkCustomAttributes = "";
        $this->ENDDATE->HrefValue = "";
        $this->ENDDATE->TooltipValue = "";

        // ENDMONTH
        $this->ENDMONTH->LinkCustomAttributes = "";
        $this->ENDMONTH->HrefValue = "";
        $this->ENDMONTH->TooltipValue = "";

        // PAIDDATE
        $this->PAIDDATE->LinkCustomAttributes = "";
        $this->PAIDDATE->HrefValue = "";
        $this->PAIDDATE->TooltipValue = "";

        // PAIDMONTH
        $this->PAIDMONTH->LinkCustomAttributes = "";
        $this->PAIDMONTH->HrefValue = "";
        $this->PAIDMONTH->TooltipValue = "";

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

        // MONTHID
        $this->MONTHID->EditAttrs["class"] = "form-control";
        $this->MONTHID->EditCustomAttributes = "";
        $this->MONTHID->EditValue = $this->MONTHID->CurrentValue;
        $this->MONTHID->PlaceHolder = RemoveHtml($this->MONTHID->caption());

        // PERIOD_NAME
        $this->PERIOD_NAME->EditAttrs["class"] = "form-control";
        $this->PERIOD_NAME->EditCustomAttributes = "";
        if (!$this->PERIOD_NAME->Raw) {
            $this->PERIOD_NAME->CurrentValue = HtmlDecode($this->PERIOD_NAME->CurrentValue);
        }
        $this->PERIOD_NAME->EditValue = $this->PERIOD_NAME->CurrentValue;
        $this->PERIOD_NAME->PlaceHolder = RemoveHtml($this->PERIOD_NAME->caption());

        // STARTDATE
        $this->STARTDATE->EditAttrs["class"] = "form-control";
        $this->STARTDATE->EditCustomAttributes = "";
        $this->STARTDATE->EditValue = $this->STARTDATE->CurrentValue;
        $this->STARTDATE->PlaceHolder = RemoveHtml($this->STARTDATE->caption());

        // STARTMONTH
        $this->STARTMONTH->EditAttrs["class"] = "form-control";
        $this->STARTMONTH->EditCustomAttributes = "";
        $this->STARTMONTH->EditValue = $this->STARTMONTH->CurrentValue;
        $this->STARTMONTH->PlaceHolder = RemoveHtml($this->STARTMONTH->caption());

        // ENDDATE
        $this->ENDDATE->EditAttrs["class"] = "form-control";
        $this->ENDDATE->EditCustomAttributes = "";
        $this->ENDDATE->EditValue = $this->ENDDATE->CurrentValue;
        $this->ENDDATE->PlaceHolder = RemoveHtml($this->ENDDATE->caption());

        // ENDMONTH
        $this->ENDMONTH->EditAttrs["class"] = "form-control";
        $this->ENDMONTH->EditCustomAttributes = "";
        $this->ENDMONTH->EditValue = $this->ENDMONTH->CurrentValue;
        $this->ENDMONTH->PlaceHolder = RemoveHtml($this->ENDMONTH->caption());

        // PAIDDATE
        $this->PAIDDATE->EditAttrs["class"] = "form-control";
        $this->PAIDDATE->EditCustomAttributes = "";
        $this->PAIDDATE->EditValue = $this->PAIDDATE->CurrentValue;
        $this->PAIDDATE->PlaceHolder = RemoveHtml($this->PAIDDATE->caption());

        // PAIDMONTH
        $this->PAIDMONTH->EditAttrs["class"] = "form-control";
        $this->PAIDMONTH->EditCustomAttributes = "";
        $this->PAIDMONTH->EditValue = $this->PAIDMONTH->CurrentValue;
        $this->PAIDMONTH->PlaceHolder = RemoveHtml($this->PAIDMONTH->caption());

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
                    $doc->exportCaption($this->MONTHID);
                    $doc->exportCaption($this->PERIOD_NAME);
                    $doc->exportCaption($this->STARTDATE);
                    $doc->exportCaption($this->STARTMONTH);
                    $doc->exportCaption($this->ENDDATE);
                    $doc->exportCaption($this->ENDMONTH);
                    $doc->exportCaption($this->PAIDDATE);
                    $doc->exportCaption($this->PAIDMONTH);
                } else {
                    $doc->exportCaption($this->MONTHID);
                    $doc->exportCaption($this->PERIOD_NAME);
                    $doc->exportCaption($this->STARTDATE);
                    $doc->exportCaption($this->STARTMONTH);
                    $doc->exportCaption($this->ENDDATE);
                    $doc->exportCaption($this->ENDMONTH);
                    $doc->exportCaption($this->PAIDDATE);
                    $doc->exportCaption($this->PAIDMONTH);
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
                        $doc->exportField($this->MONTHID);
                        $doc->exportField($this->PERIOD_NAME);
                        $doc->exportField($this->STARTDATE);
                        $doc->exportField($this->STARTMONTH);
                        $doc->exportField($this->ENDDATE);
                        $doc->exportField($this->ENDMONTH);
                        $doc->exportField($this->PAIDDATE);
                        $doc->exportField($this->PAIDMONTH);
                    } else {
                        $doc->exportField($this->MONTHID);
                        $doc->exportField($this->PERIOD_NAME);
                        $doc->exportField($this->STARTDATE);
                        $doc->exportField($this->STARTMONTH);
                        $doc->exportField($this->ENDDATE);
                        $doc->exportField($this->ENDMONTH);
                        $doc->exportField($this->PAIDDATE);
                        $doc->exportField($this->PAIDMONTH);
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
