<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for pbcatedt
 */
class Pbcatedt extends DbTable
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
    public $pbe_name;
    public $pbe_edit;
    public $pbe_type;
    public $pbe_cntr;
    public $pbe_seqn;
    public $pbe_flag;
    public $pbe_work;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pbcatedt';
        $this->TableName = 'pbcatedt';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[pbcatedt]";
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

        // pbe_name
        $this->pbe_name = new DbField('pbcatedt', 'pbcatedt', 'x_pbe_name', 'pbe_name', '[pbe_name]', '[pbe_name]', 200, 30, -1, false, '[pbe_name]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbe_name->IsPrimaryKey = true; // Primary key field
        $this->pbe_name->Nullable = false; // NOT NULL field
        $this->pbe_name->Required = true; // Required field
        $this->pbe_name->Sortable = true; // Allow sort
        $this->pbe_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbe_name->Param, "CustomMsg");
        $this->Fields['pbe_name'] = &$this->pbe_name;

        // pbe_edit
        $this->pbe_edit = new DbField('pbcatedt', 'pbcatedt', 'x_pbe_edit', 'pbe_edit', '[pbe_edit]', '[pbe_edit]', 200, 254, -1, false, '[pbe_edit]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbe_edit->Sortable = true; // Allow sort
        $this->pbe_edit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbe_edit->Param, "CustomMsg");
        $this->Fields['pbe_edit'] = &$this->pbe_edit;

        // pbe_type
        $this->pbe_type = new DbField('pbcatedt', 'pbcatedt', 'x_pbe_type', 'pbe_type', '[pbe_type]', 'CAST([pbe_type] AS NVARCHAR)', 2, 2, -1, false, '[pbe_type]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbe_type->Nullable = false; // NOT NULL field
        $this->pbe_type->Required = true; // Required field
        $this->pbe_type->Sortable = true; // Allow sort
        $this->pbe_type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbe_type->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbe_type->Param, "CustomMsg");
        $this->Fields['pbe_type'] = &$this->pbe_type;

        // pbe_cntr
        $this->pbe_cntr = new DbField('pbcatedt', 'pbcatedt', 'x_pbe_cntr', 'pbe_cntr', '[pbe_cntr]', 'CAST([pbe_cntr] AS NVARCHAR)', 3, 4, -1, false, '[pbe_cntr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbe_cntr->Sortable = true; // Allow sort
        $this->pbe_cntr->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbe_cntr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbe_cntr->Param, "CustomMsg");
        $this->Fields['pbe_cntr'] = &$this->pbe_cntr;

        // pbe_seqn
        $this->pbe_seqn = new DbField('pbcatedt', 'pbcatedt', 'x_pbe_seqn', 'pbe_seqn', '[pbe_seqn]', 'CAST([pbe_seqn] AS NVARCHAR)', 2, 2, -1, false, '[pbe_seqn]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbe_seqn->IsPrimaryKey = true; // Primary key field
        $this->pbe_seqn->Nullable = false; // NOT NULL field
        $this->pbe_seqn->Required = true; // Required field
        $this->pbe_seqn->Sortable = true; // Allow sort
        $this->pbe_seqn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbe_seqn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbe_seqn->Param, "CustomMsg");
        $this->Fields['pbe_seqn'] = &$this->pbe_seqn;

        // pbe_flag
        $this->pbe_flag = new DbField('pbcatedt', 'pbcatedt', 'x_pbe_flag', 'pbe_flag', '[pbe_flag]', 'CAST([pbe_flag] AS NVARCHAR)', 3, 4, -1, false, '[pbe_flag]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbe_flag->Sortable = true; // Allow sort
        $this->pbe_flag->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbe_flag->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbe_flag->Param, "CustomMsg");
        $this->Fields['pbe_flag'] = &$this->pbe_flag;

        // pbe_work
        $this->pbe_work = new DbField('pbcatedt', 'pbcatedt', 'x_pbe_work', 'pbe_work', '[pbe_work]', '[pbe_work]', 129, 32, -1, false, '[pbe_work]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbe_work->Sortable = true; // Allow sort
        $this->pbe_work->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbe_work->Param, "CustomMsg");
        $this->Fields['pbe_work'] = &$this->pbe_work;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[pbcatedt]";
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
            if (array_key_exists('pbe_name', $rs)) {
                AddFilter($where, QuotedName('pbe_name', $this->Dbid) . '=' . QuotedValue($rs['pbe_name'], $this->pbe_name->DataType, $this->Dbid));
            }
            if (array_key_exists('pbe_seqn', $rs)) {
                AddFilter($where, QuotedName('pbe_seqn', $this->Dbid) . '=' . QuotedValue($rs['pbe_seqn'], $this->pbe_seqn->DataType, $this->Dbid));
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
        $this->pbe_name->DbValue = $row['pbe_name'];
        $this->pbe_edit->DbValue = $row['pbe_edit'];
        $this->pbe_type->DbValue = $row['pbe_type'];
        $this->pbe_cntr->DbValue = $row['pbe_cntr'];
        $this->pbe_seqn->DbValue = $row['pbe_seqn'];
        $this->pbe_flag->DbValue = $row['pbe_flag'];
        $this->pbe_work->DbValue = $row['pbe_work'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[pbe_name] = '@pbe_name@' AND [pbe_seqn] = @pbe_seqn@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->pbe_name->CurrentValue : $this->pbe_name->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->pbe_seqn->CurrentValue : $this->pbe_seqn->OldValue;
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
        if (count($keys) == 2) {
            if ($current) {
                $this->pbe_name->CurrentValue = $keys[0];
            } else {
                $this->pbe_name->OldValue = $keys[0];
            }
            if ($current) {
                $this->pbe_seqn->CurrentValue = $keys[1];
            } else {
                $this->pbe_seqn->OldValue = $keys[1];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('pbe_name', $row) ? $row['pbe_name'] : null;
        } else {
            $val = $this->pbe_name->OldValue !== null ? $this->pbe_name->OldValue : $this->pbe_name->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@pbe_name@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('pbe_seqn', $row) ? $row['pbe_seqn'] : null;
        } else {
            $val = $this->pbe_seqn->OldValue !== null ? $this->pbe_seqn->OldValue : $this->pbe_seqn->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@pbe_seqn@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PbcatedtList");
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
        if ($pageName == "PbcatedtView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PbcatedtEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PbcatedtAdd") {
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
                return "PbcatedtView";
            case Config("API_ADD_ACTION"):
                return "PbcatedtAdd";
            case Config("API_EDIT_ACTION"):
                return "PbcatedtEdit";
            case Config("API_DELETE_ACTION"):
                return "PbcatedtDelete";
            case Config("API_LIST_ACTION"):
                return "PbcatedtList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PbcatedtList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PbcatedtView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PbcatedtView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PbcatedtAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PbcatedtAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PbcatedtEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PbcatedtAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PbcatedtDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "pbe_name:" . JsonEncode($this->pbe_name->CurrentValue, "string");
        $json .= ",pbe_seqn:" . JsonEncode($this->pbe_seqn->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->pbe_name->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->pbe_name->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->pbe_seqn->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->pbe_seqn->CurrentValue);
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
            for ($i = 0; $i < $cnt; $i++) {
                $arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
            }
        } else {
            if (($keyValue = Param("pbe_name") ?? Route("pbe_name")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("pbe_seqn") ?? Route("pbe_seqn")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (is_array($arKeys)) {
                $arKeys[] = $arKey;
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_array($key) || count($key) != 2) {
                    continue; // Just skip so other keys will still work
                }
                if (!is_numeric($key[1])) { // pbe_seqn
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
                $this->pbe_name->CurrentValue = $key[0];
            } else {
                $this->pbe_name->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->pbe_seqn->CurrentValue = $key[1];
            } else {
                $this->pbe_seqn->OldValue = $key[1];
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
        $this->pbe_name->setDbValue($row['pbe_name']);
        $this->pbe_edit->setDbValue($row['pbe_edit']);
        $this->pbe_type->setDbValue($row['pbe_type']);
        $this->pbe_cntr->setDbValue($row['pbe_cntr']);
        $this->pbe_seqn->setDbValue($row['pbe_seqn']);
        $this->pbe_flag->setDbValue($row['pbe_flag']);
        $this->pbe_work->setDbValue($row['pbe_work']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // pbe_name

        // pbe_edit

        // pbe_type

        // pbe_cntr

        // pbe_seqn

        // pbe_flag

        // pbe_work

        // pbe_name
        $this->pbe_name->ViewValue = $this->pbe_name->CurrentValue;
        $this->pbe_name->ViewCustomAttributes = "";

        // pbe_edit
        $this->pbe_edit->ViewValue = $this->pbe_edit->CurrentValue;
        $this->pbe_edit->ViewCustomAttributes = "";

        // pbe_type
        $this->pbe_type->ViewValue = $this->pbe_type->CurrentValue;
        $this->pbe_type->ViewValue = FormatNumber($this->pbe_type->ViewValue, 0, -2, -2, -2);
        $this->pbe_type->ViewCustomAttributes = "";

        // pbe_cntr
        $this->pbe_cntr->ViewValue = $this->pbe_cntr->CurrentValue;
        $this->pbe_cntr->ViewValue = FormatNumber($this->pbe_cntr->ViewValue, 0, -2, -2, -2);
        $this->pbe_cntr->ViewCustomAttributes = "";

        // pbe_seqn
        $this->pbe_seqn->ViewValue = $this->pbe_seqn->CurrentValue;
        $this->pbe_seqn->ViewValue = FormatNumber($this->pbe_seqn->ViewValue, 0, -2, -2, -2);
        $this->pbe_seqn->ViewCustomAttributes = "";

        // pbe_flag
        $this->pbe_flag->ViewValue = $this->pbe_flag->CurrentValue;
        $this->pbe_flag->ViewValue = FormatNumber($this->pbe_flag->ViewValue, 0, -2, -2, -2);
        $this->pbe_flag->ViewCustomAttributes = "";

        // pbe_work
        $this->pbe_work->ViewValue = $this->pbe_work->CurrentValue;
        $this->pbe_work->ViewCustomAttributes = "";

        // pbe_name
        $this->pbe_name->LinkCustomAttributes = "";
        $this->pbe_name->HrefValue = "";
        $this->pbe_name->TooltipValue = "";

        // pbe_edit
        $this->pbe_edit->LinkCustomAttributes = "";
        $this->pbe_edit->HrefValue = "";
        $this->pbe_edit->TooltipValue = "";

        // pbe_type
        $this->pbe_type->LinkCustomAttributes = "";
        $this->pbe_type->HrefValue = "";
        $this->pbe_type->TooltipValue = "";

        // pbe_cntr
        $this->pbe_cntr->LinkCustomAttributes = "";
        $this->pbe_cntr->HrefValue = "";
        $this->pbe_cntr->TooltipValue = "";

        // pbe_seqn
        $this->pbe_seqn->LinkCustomAttributes = "";
        $this->pbe_seqn->HrefValue = "";
        $this->pbe_seqn->TooltipValue = "";

        // pbe_flag
        $this->pbe_flag->LinkCustomAttributes = "";
        $this->pbe_flag->HrefValue = "";
        $this->pbe_flag->TooltipValue = "";

        // pbe_work
        $this->pbe_work->LinkCustomAttributes = "";
        $this->pbe_work->HrefValue = "";
        $this->pbe_work->TooltipValue = "";

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

        // pbe_name
        $this->pbe_name->EditAttrs["class"] = "form-control";
        $this->pbe_name->EditCustomAttributes = "";
        if (!$this->pbe_name->Raw) {
            $this->pbe_name->CurrentValue = HtmlDecode($this->pbe_name->CurrentValue);
        }
        $this->pbe_name->EditValue = $this->pbe_name->CurrentValue;
        $this->pbe_name->PlaceHolder = RemoveHtml($this->pbe_name->caption());

        // pbe_edit
        $this->pbe_edit->EditAttrs["class"] = "form-control";
        $this->pbe_edit->EditCustomAttributes = "";
        if (!$this->pbe_edit->Raw) {
            $this->pbe_edit->CurrentValue = HtmlDecode($this->pbe_edit->CurrentValue);
        }
        $this->pbe_edit->EditValue = $this->pbe_edit->CurrentValue;
        $this->pbe_edit->PlaceHolder = RemoveHtml($this->pbe_edit->caption());

        // pbe_type
        $this->pbe_type->EditAttrs["class"] = "form-control";
        $this->pbe_type->EditCustomAttributes = "";
        $this->pbe_type->EditValue = $this->pbe_type->CurrentValue;
        $this->pbe_type->PlaceHolder = RemoveHtml($this->pbe_type->caption());

        // pbe_cntr
        $this->pbe_cntr->EditAttrs["class"] = "form-control";
        $this->pbe_cntr->EditCustomAttributes = "";
        $this->pbe_cntr->EditValue = $this->pbe_cntr->CurrentValue;
        $this->pbe_cntr->PlaceHolder = RemoveHtml($this->pbe_cntr->caption());

        // pbe_seqn
        $this->pbe_seqn->EditAttrs["class"] = "form-control";
        $this->pbe_seqn->EditCustomAttributes = "";
        $this->pbe_seqn->EditValue = $this->pbe_seqn->CurrentValue;
        $this->pbe_seqn->PlaceHolder = RemoveHtml($this->pbe_seqn->caption());

        // pbe_flag
        $this->pbe_flag->EditAttrs["class"] = "form-control";
        $this->pbe_flag->EditCustomAttributes = "";
        $this->pbe_flag->EditValue = $this->pbe_flag->CurrentValue;
        $this->pbe_flag->PlaceHolder = RemoveHtml($this->pbe_flag->caption());

        // pbe_work
        $this->pbe_work->EditAttrs["class"] = "form-control";
        $this->pbe_work->EditCustomAttributes = "";
        if (!$this->pbe_work->Raw) {
            $this->pbe_work->CurrentValue = HtmlDecode($this->pbe_work->CurrentValue);
        }
        $this->pbe_work->EditValue = $this->pbe_work->CurrentValue;
        $this->pbe_work->PlaceHolder = RemoveHtml($this->pbe_work->caption());

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
                    $doc->exportCaption($this->pbe_name);
                    $doc->exportCaption($this->pbe_edit);
                    $doc->exportCaption($this->pbe_type);
                    $doc->exportCaption($this->pbe_cntr);
                    $doc->exportCaption($this->pbe_seqn);
                    $doc->exportCaption($this->pbe_flag);
                    $doc->exportCaption($this->pbe_work);
                } else {
                    $doc->exportCaption($this->pbe_name);
                    $doc->exportCaption($this->pbe_edit);
                    $doc->exportCaption($this->pbe_type);
                    $doc->exportCaption($this->pbe_cntr);
                    $doc->exportCaption($this->pbe_seqn);
                    $doc->exportCaption($this->pbe_flag);
                    $doc->exportCaption($this->pbe_work);
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
                        $doc->exportField($this->pbe_name);
                        $doc->exportField($this->pbe_edit);
                        $doc->exportField($this->pbe_type);
                        $doc->exportField($this->pbe_cntr);
                        $doc->exportField($this->pbe_seqn);
                        $doc->exportField($this->pbe_flag);
                        $doc->exportField($this->pbe_work);
                    } else {
                        $doc->exportField($this->pbe_name);
                        $doc->exportField($this->pbe_edit);
                        $doc->exportField($this->pbe_type);
                        $doc->exportField($this->pbe_cntr);
                        $doc->exportField($this->pbe_seqn);
                        $doc->exportField($this->pbe_flag);
                        $doc->exportField($this->pbe_work);
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
