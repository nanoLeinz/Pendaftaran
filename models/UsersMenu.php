<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for USERS_MENU
 */
class UsersMenu extends DbTable
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
    public $ORG_UNIT_CODE;
    public $_USERNAME;
    public $MENU_ID;
    public $STYPE_ID;
    public $GROUP_ID;
    public $C;
    public $R;
    public $U;
    public $D;
    public $P;
    public $E;
    public $C_TIME;
    public $U_TIME;
    public $D_TIME;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'USERS_MENU';
        $this->TableName = 'USERS_MENU';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[USERS_MENU]";
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

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('USERS_MENU', 'USERS_MENU', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // USERNAME
        $this->_USERNAME = new DbField('USERS_MENU', 'USERS_MENU', 'x__USERNAME', 'USERNAME', '[USERNAME]', '[USERNAME]', 200, 50, -1, false, '[USERNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_USERNAME->IsPrimaryKey = true; // Primary key field
        $this->_USERNAME->Nullable = false; // NOT NULL field
        $this->_USERNAME->Required = true; // Required field
        $this->_USERNAME->Sortable = true; // Allow sort
        $this->_USERNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_USERNAME->Param, "CustomMsg");
        $this->Fields['USERNAME'] = &$this->_USERNAME;

        // MENU_ID
        $this->MENU_ID = new DbField('USERS_MENU', 'USERS_MENU', 'x_MENU_ID', 'MENU_ID', '[MENU_ID]', '[MENU_ID]', 200, 50, -1, false, '[MENU_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MENU_ID->IsPrimaryKey = true; // Primary key field
        $this->MENU_ID->Nullable = false; // NOT NULL field
        $this->MENU_ID->Required = true; // Required field
        $this->MENU_ID->Sortable = true; // Allow sort
        $this->MENU_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MENU_ID->Param, "CustomMsg");
        $this->Fields['MENU_ID'] = &$this->MENU_ID;

        // STYPE_ID
        $this->STYPE_ID = new DbField('USERS_MENU', 'USERS_MENU', 'x_STYPE_ID', 'STYPE_ID', '[STYPE_ID]', 'CAST([STYPE_ID] AS NVARCHAR)', 2, 2, -1, false, '[STYPE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STYPE_ID->IsPrimaryKey = true; // Primary key field
        $this->STYPE_ID->Nullable = false; // NOT NULL field
        $this->STYPE_ID->Required = true; // Required field
        $this->STYPE_ID->Sortable = true; // Allow sort
        $this->STYPE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STYPE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STYPE_ID->Param, "CustomMsg");
        $this->Fields['STYPE_ID'] = &$this->STYPE_ID;

        // GROUP_ID
        $this->GROUP_ID = new DbField('USERS_MENU', 'USERS_MENU', 'x_GROUP_ID', 'GROUP_ID', '[GROUP_ID]', 'CAST([GROUP_ID] AS NVARCHAR)', 3, 4, -1, false, '[GROUP_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GROUP_ID->Nullable = false; // NOT NULL field
        $this->GROUP_ID->Required = true; // Required field
        $this->GROUP_ID->Sortable = true; // Allow sort
        $this->GROUP_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->GROUP_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GROUP_ID->Param, "CustomMsg");
        $this->Fields['GROUP_ID'] = &$this->GROUP_ID;

        // C
        $this->C = new DbField('USERS_MENU', 'USERS_MENU', 'x_C', 'C', '[C]', '[C]', 200, 1, -1, false, '[C]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->C->Sortable = true; // Allow sort
        $this->C->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->C->Param, "CustomMsg");
        $this->Fields['C'] = &$this->C;

        // R
        $this->R = new DbField('USERS_MENU', 'USERS_MENU', 'x_R', 'R', '[R]', '[R]', 200, 1, -1, false, '[R]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->R->Sortable = true; // Allow sort
        $this->R->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->R->Param, "CustomMsg");
        $this->Fields['R'] = &$this->R;

        // U
        $this->U = new DbField('USERS_MENU', 'USERS_MENU', 'x_U', 'U', '[U]', '[U]', 200, 1, -1, false, '[U]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->U->Sortable = true; // Allow sort
        $this->U->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->U->Param, "CustomMsg");
        $this->Fields['U'] = &$this->U;

        // D
        $this->D = new DbField('USERS_MENU', 'USERS_MENU', 'x_D', 'D', '[D]', '[D]', 200, 1, -1, false, '[D]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->D->Sortable = true; // Allow sort
        $this->D->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->D->Param, "CustomMsg");
        $this->Fields['D'] = &$this->D;

        // P
        $this->P = new DbField('USERS_MENU', 'USERS_MENU', 'x_P', 'P', '[P]', '[P]', 200, 1, -1, false, '[P]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->P->Sortable = true; // Allow sort
        $this->P->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->P->Param, "CustomMsg");
        $this->Fields['P'] = &$this->P;

        // E
        $this->E = new DbField('USERS_MENU', 'USERS_MENU', 'x_E', 'E', '[E]', '[E]', 200, 1, -1, false, '[E]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->E->Sortable = true; // Allow sort
        $this->E->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->E->Param, "CustomMsg");
        $this->Fields['E'] = &$this->E;

        // C_TIME
        $this->C_TIME = new DbField('USERS_MENU', 'USERS_MENU', 'x_C_TIME', 'C_TIME', '[C_TIME]', 'CAST([C_TIME] AS NVARCHAR)', 3, 4, -1, false, '[C_TIME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->C_TIME->Sortable = true; // Allow sort
        $this->C_TIME->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->C_TIME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->C_TIME->Param, "CustomMsg");
        $this->Fields['C_TIME'] = &$this->C_TIME;

        // U_TIME
        $this->U_TIME = new DbField('USERS_MENU', 'USERS_MENU', 'x_U_TIME', 'U_TIME', '[U_TIME]', 'CAST([U_TIME] AS NVARCHAR)', 3, 4, -1, false, '[U_TIME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->U_TIME->Sortable = true; // Allow sort
        $this->U_TIME->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->U_TIME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->U_TIME->Param, "CustomMsg");
        $this->Fields['U_TIME'] = &$this->U_TIME;

        // D_TIME
        $this->D_TIME = new DbField('USERS_MENU', 'USERS_MENU', 'x_D_TIME', 'D_TIME', '[D_TIME]', 'CAST([D_TIME] AS NVARCHAR)', 3, 4, -1, false, '[D_TIME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->D_TIME->Sortable = true; // Allow sort
        $this->D_TIME->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->D_TIME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->D_TIME->Param, "CustomMsg");
        $this->Fields['D_TIME'] = &$this->D_TIME;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('USERS_MENU', 'USERS_MENU', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('USERS_MENU', 'USERS_MENU', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[USERS_MENU]";
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
            if (array_key_exists('ORG_UNIT_CODE', $rs)) {
                AddFilter($where, QuotedName('ORG_UNIT_CODE', $this->Dbid) . '=' . QuotedValue($rs['ORG_UNIT_CODE'], $this->ORG_UNIT_CODE->DataType, $this->Dbid));
            }
            if (array_key_exists('USERNAME', $rs)) {
                AddFilter($where, QuotedName('USERNAME', $this->Dbid) . '=' . QuotedValue($rs['USERNAME'], $this->_USERNAME->DataType, $this->Dbid));
            }
            if (array_key_exists('MENU_ID', $rs)) {
                AddFilter($where, QuotedName('MENU_ID', $this->Dbid) . '=' . QuotedValue($rs['MENU_ID'], $this->MENU_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('STYPE_ID', $rs)) {
                AddFilter($where, QuotedName('STYPE_ID', $this->Dbid) . '=' . QuotedValue($rs['STYPE_ID'], $this->STYPE_ID->DataType, $this->Dbid));
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
        $this->ORG_UNIT_CODE->DbValue = $row['ORG_UNIT_CODE'];
        $this->_USERNAME->DbValue = $row['USERNAME'];
        $this->MENU_ID->DbValue = $row['MENU_ID'];
        $this->STYPE_ID->DbValue = $row['STYPE_ID'];
        $this->GROUP_ID->DbValue = $row['GROUP_ID'];
        $this->C->DbValue = $row['C'];
        $this->R->DbValue = $row['R'];
        $this->U->DbValue = $row['U'];
        $this->D->DbValue = $row['D'];
        $this->P->DbValue = $row['P'];
        $this->E->DbValue = $row['E'];
        $this->C_TIME->DbValue = $row['C_TIME'];
        $this->U_TIME->DbValue = $row['U_TIME'];
        $this->D_TIME->DbValue = $row['D_TIME'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [USERNAME] = '@_USERNAME@' AND [MENU_ID] = '@MENU_ID@' AND [STYPE_ID] = @STYPE_ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->ORG_UNIT_CODE->CurrentValue : $this->ORG_UNIT_CODE->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->_USERNAME->CurrentValue : $this->_USERNAME->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->MENU_ID->CurrentValue : $this->MENU_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->STYPE_ID->CurrentValue : $this->STYPE_ID->OldValue;
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
        if (count($keys) == 4) {
            if ($current) {
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
            }
            if ($current) {
                $this->_USERNAME->CurrentValue = $keys[1];
            } else {
                $this->_USERNAME->OldValue = $keys[1];
            }
            if ($current) {
                $this->MENU_ID->CurrentValue = $keys[2];
            } else {
                $this->MENU_ID->OldValue = $keys[2];
            }
            if ($current) {
                $this->STYPE_ID->CurrentValue = $keys[3];
            } else {
                $this->STYPE_ID->OldValue = $keys[3];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ORG_UNIT_CODE', $row) ? $row['ORG_UNIT_CODE'] : null;
        } else {
            $val = $this->ORG_UNIT_CODE->OldValue !== null ? $this->ORG_UNIT_CODE->OldValue : $this->ORG_UNIT_CODE->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ORG_UNIT_CODE@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('USERNAME', $row) ? $row['USERNAME'] : null;
        } else {
            $val = $this->_USERNAME->OldValue !== null ? $this->_USERNAME->OldValue : $this->_USERNAME->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@_USERNAME@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('MENU_ID', $row) ? $row['MENU_ID'] : null;
        } else {
            $val = $this->MENU_ID->OldValue !== null ? $this->MENU_ID->OldValue : $this->MENU_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@MENU_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('STYPE_ID', $row) ? $row['STYPE_ID'] : null;
        } else {
            $val = $this->STYPE_ID->OldValue !== null ? $this->STYPE_ID->OldValue : $this->STYPE_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@STYPE_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("UsersMenuList");
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
        if ($pageName == "UsersMenuView") {
            return $Language->phrase("View");
        } elseif ($pageName == "UsersMenuEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "UsersMenuAdd") {
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
                return "UsersMenuView";
            case Config("API_ADD_ACTION"):
                return "UsersMenuAdd";
            case Config("API_EDIT_ACTION"):
                return "UsersMenuEdit";
            case Config("API_DELETE_ACTION"):
                return "UsersMenuDelete";
            case Config("API_LIST_ACTION"):
                return "UsersMenuList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "UsersMenuList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("UsersMenuView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("UsersMenuView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "UsersMenuAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "UsersMenuAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("UsersMenuEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("UsersMenuAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("UsersMenuDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "ORG_UNIT_CODE:" . JsonEncode($this->ORG_UNIT_CODE->CurrentValue, "string");
        $json .= ",_USERNAME:" . JsonEncode($this->_USERNAME->CurrentValue, "string");
        $json .= ",MENU_ID:" . JsonEncode($this->MENU_ID->CurrentValue, "string");
        $json .= ",STYPE_ID:" . JsonEncode($this->STYPE_ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ORG_UNIT_CODE->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ORG_UNIT_CODE->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->_USERNAME->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->_USERNAME->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->MENU_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->MENU_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->STYPE_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->STYPE_ID->CurrentValue);
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
            if (($keyValue = Param("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("_USERNAME") ?? Route("_USERNAME")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("MENU_ID") ?? Route("MENU_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(2) ?? Route(4)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("STYPE_ID") ?? Route("STYPE_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(3) ?? Route(5)) !== null)) {
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
                if (!is_array($key) || count($key) != 4) {
                    continue; // Just skip so other keys will still work
                }
                if (!is_numeric($key[3])) { // STYPE_ID
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
                $this->ORG_UNIT_CODE->CurrentValue = $key[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->_USERNAME->CurrentValue = $key[1];
            } else {
                $this->_USERNAME->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->MENU_ID->CurrentValue = $key[2];
            } else {
                $this->MENU_ID->OldValue = $key[2];
            }
            if ($setCurrent) {
                $this->STYPE_ID->CurrentValue = $key[3];
            } else {
                $this->STYPE_ID->OldValue = $key[3];
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
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->_USERNAME->setDbValue($row['USERNAME']);
        $this->MENU_ID->setDbValue($row['MENU_ID']);
        $this->STYPE_ID->setDbValue($row['STYPE_ID']);
        $this->GROUP_ID->setDbValue($row['GROUP_ID']);
        $this->C->setDbValue($row['C']);
        $this->R->setDbValue($row['R']);
        $this->U->setDbValue($row['U']);
        $this->D->setDbValue($row['D']);
        $this->P->setDbValue($row['P']);
        $this->E->setDbValue($row['E']);
        $this->C_TIME->setDbValue($row['C_TIME']);
        $this->U_TIME->setDbValue($row['U_TIME']);
        $this->D_TIME->setDbValue($row['D_TIME']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // USERNAME

        // MENU_ID

        // STYPE_ID

        // GROUP_ID

        // C

        // R

        // U

        // D

        // P

        // E

        // C_TIME

        // U_TIME

        // D_TIME

        // MODIFIED_DATE

        // MODIFIED_BY

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // USERNAME
        $this->_USERNAME->ViewValue = $this->_USERNAME->CurrentValue;
        $this->_USERNAME->ViewCustomAttributes = "";

        // MENU_ID
        $this->MENU_ID->ViewValue = $this->MENU_ID->CurrentValue;
        $this->MENU_ID->ViewCustomAttributes = "";

        // STYPE_ID
        $this->STYPE_ID->ViewValue = $this->STYPE_ID->CurrentValue;
        $this->STYPE_ID->ViewValue = FormatNumber($this->STYPE_ID->ViewValue, 0, -2, -2, -2);
        $this->STYPE_ID->ViewCustomAttributes = "";

        // GROUP_ID
        $this->GROUP_ID->ViewValue = $this->GROUP_ID->CurrentValue;
        $this->GROUP_ID->ViewValue = FormatNumber($this->GROUP_ID->ViewValue, 0, -2, -2, -2);
        $this->GROUP_ID->ViewCustomAttributes = "";

        // C
        $this->C->ViewValue = $this->C->CurrentValue;
        $this->C->ViewCustomAttributes = "";

        // R
        $this->R->ViewValue = $this->R->CurrentValue;
        $this->R->ViewCustomAttributes = "";

        // U
        $this->U->ViewValue = $this->U->CurrentValue;
        $this->U->ViewCustomAttributes = "";

        // D
        $this->D->ViewValue = $this->D->CurrentValue;
        $this->D->ViewCustomAttributes = "";

        // P
        $this->P->ViewValue = $this->P->CurrentValue;
        $this->P->ViewCustomAttributes = "";

        // E
        $this->E->ViewValue = $this->E->CurrentValue;
        $this->E->ViewCustomAttributes = "";

        // C_TIME
        $this->C_TIME->ViewValue = $this->C_TIME->CurrentValue;
        $this->C_TIME->ViewValue = FormatNumber($this->C_TIME->ViewValue, 0, -2, -2, -2);
        $this->C_TIME->ViewCustomAttributes = "";

        // U_TIME
        $this->U_TIME->ViewValue = $this->U_TIME->CurrentValue;
        $this->U_TIME->ViewValue = FormatNumber($this->U_TIME->ViewValue, 0, -2, -2, -2);
        $this->U_TIME->ViewCustomAttributes = "";

        // D_TIME
        $this->D_TIME->ViewValue = $this->D_TIME->CurrentValue;
        $this->D_TIME->ViewValue = FormatNumber($this->D_TIME->ViewValue, 0, -2, -2, -2);
        $this->D_TIME->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // USERNAME
        $this->_USERNAME->LinkCustomAttributes = "";
        $this->_USERNAME->HrefValue = "";
        $this->_USERNAME->TooltipValue = "";

        // MENU_ID
        $this->MENU_ID->LinkCustomAttributes = "";
        $this->MENU_ID->HrefValue = "";
        $this->MENU_ID->TooltipValue = "";

        // STYPE_ID
        $this->STYPE_ID->LinkCustomAttributes = "";
        $this->STYPE_ID->HrefValue = "";
        $this->STYPE_ID->TooltipValue = "";

        // GROUP_ID
        $this->GROUP_ID->LinkCustomAttributes = "";
        $this->GROUP_ID->HrefValue = "";
        $this->GROUP_ID->TooltipValue = "";

        // C
        $this->C->LinkCustomAttributes = "";
        $this->C->HrefValue = "";
        $this->C->TooltipValue = "";

        // R
        $this->R->LinkCustomAttributes = "";
        $this->R->HrefValue = "";
        $this->R->TooltipValue = "";

        // U
        $this->U->LinkCustomAttributes = "";
        $this->U->HrefValue = "";
        $this->U->TooltipValue = "";

        // D
        $this->D->LinkCustomAttributes = "";
        $this->D->HrefValue = "";
        $this->D->TooltipValue = "";

        // P
        $this->P->LinkCustomAttributes = "";
        $this->P->HrefValue = "";
        $this->P->TooltipValue = "";

        // E
        $this->E->LinkCustomAttributes = "";
        $this->E->HrefValue = "";
        $this->E->TooltipValue = "";

        // C_TIME
        $this->C_TIME->LinkCustomAttributes = "";
        $this->C_TIME->HrefValue = "";
        $this->C_TIME->TooltipValue = "";

        // U_TIME
        $this->U_TIME->LinkCustomAttributes = "";
        $this->U_TIME->HrefValue = "";
        $this->U_TIME->TooltipValue = "";

        // D_TIME
        $this->D_TIME->LinkCustomAttributes = "";
        $this->D_TIME->HrefValue = "";
        $this->D_TIME->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

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

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
        $this->ORG_UNIT_CODE->EditCustomAttributes = "";
        if (!$this->ORG_UNIT_CODE->Raw) {
            $this->ORG_UNIT_CODE->CurrentValue = HtmlDecode($this->ORG_UNIT_CODE->CurrentValue);
        }
        $this->ORG_UNIT_CODE->EditValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->PlaceHolder = RemoveHtml($this->ORG_UNIT_CODE->caption());

        // USERNAME
        $this->_USERNAME->EditAttrs["class"] = "form-control";
        $this->_USERNAME->EditCustomAttributes = "";
        if (!$this->_USERNAME->Raw) {
            $this->_USERNAME->CurrentValue = HtmlDecode($this->_USERNAME->CurrentValue);
        }
        $this->_USERNAME->EditValue = $this->_USERNAME->CurrentValue;
        $this->_USERNAME->PlaceHolder = RemoveHtml($this->_USERNAME->caption());

        // MENU_ID
        $this->MENU_ID->EditAttrs["class"] = "form-control";
        $this->MENU_ID->EditCustomAttributes = "";
        if (!$this->MENU_ID->Raw) {
            $this->MENU_ID->CurrentValue = HtmlDecode($this->MENU_ID->CurrentValue);
        }
        $this->MENU_ID->EditValue = $this->MENU_ID->CurrentValue;
        $this->MENU_ID->PlaceHolder = RemoveHtml($this->MENU_ID->caption());

        // STYPE_ID
        $this->STYPE_ID->EditAttrs["class"] = "form-control";
        $this->STYPE_ID->EditCustomAttributes = "";
        $this->STYPE_ID->EditValue = $this->STYPE_ID->CurrentValue;
        $this->STYPE_ID->PlaceHolder = RemoveHtml($this->STYPE_ID->caption());

        // GROUP_ID
        $this->GROUP_ID->EditAttrs["class"] = "form-control";
        $this->GROUP_ID->EditCustomAttributes = "";
        $this->GROUP_ID->EditValue = $this->GROUP_ID->CurrentValue;
        $this->GROUP_ID->PlaceHolder = RemoveHtml($this->GROUP_ID->caption());

        // C
        $this->C->EditAttrs["class"] = "form-control";
        $this->C->EditCustomAttributes = "";
        if (!$this->C->Raw) {
            $this->C->CurrentValue = HtmlDecode($this->C->CurrentValue);
        }
        $this->C->EditValue = $this->C->CurrentValue;
        $this->C->PlaceHolder = RemoveHtml($this->C->caption());

        // R
        $this->R->EditAttrs["class"] = "form-control";
        $this->R->EditCustomAttributes = "";
        if (!$this->R->Raw) {
            $this->R->CurrentValue = HtmlDecode($this->R->CurrentValue);
        }
        $this->R->EditValue = $this->R->CurrentValue;
        $this->R->PlaceHolder = RemoveHtml($this->R->caption());

        // U
        $this->U->EditAttrs["class"] = "form-control";
        $this->U->EditCustomAttributes = "";
        if (!$this->U->Raw) {
            $this->U->CurrentValue = HtmlDecode($this->U->CurrentValue);
        }
        $this->U->EditValue = $this->U->CurrentValue;
        $this->U->PlaceHolder = RemoveHtml($this->U->caption());

        // D
        $this->D->EditAttrs["class"] = "form-control";
        $this->D->EditCustomAttributes = "";
        if (!$this->D->Raw) {
            $this->D->CurrentValue = HtmlDecode($this->D->CurrentValue);
        }
        $this->D->EditValue = $this->D->CurrentValue;
        $this->D->PlaceHolder = RemoveHtml($this->D->caption());

        // P
        $this->P->EditAttrs["class"] = "form-control";
        $this->P->EditCustomAttributes = "";
        if (!$this->P->Raw) {
            $this->P->CurrentValue = HtmlDecode($this->P->CurrentValue);
        }
        $this->P->EditValue = $this->P->CurrentValue;
        $this->P->PlaceHolder = RemoveHtml($this->P->caption());

        // E
        $this->E->EditAttrs["class"] = "form-control";
        $this->E->EditCustomAttributes = "";
        if (!$this->E->Raw) {
            $this->E->CurrentValue = HtmlDecode($this->E->CurrentValue);
        }
        $this->E->EditValue = $this->E->CurrentValue;
        $this->E->PlaceHolder = RemoveHtml($this->E->caption());

        // C_TIME
        $this->C_TIME->EditAttrs["class"] = "form-control";
        $this->C_TIME->EditCustomAttributes = "";
        $this->C_TIME->EditValue = $this->C_TIME->CurrentValue;
        $this->C_TIME->PlaceHolder = RemoveHtml($this->C_TIME->caption());

        // U_TIME
        $this->U_TIME->EditAttrs["class"] = "form-control";
        $this->U_TIME->EditCustomAttributes = "";
        $this->U_TIME->EditValue = $this->U_TIME->CurrentValue;
        $this->U_TIME->PlaceHolder = RemoveHtml($this->U_TIME->caption());

        // D_TIME
        $this->D_TIME->EditAttrs["class"] = "form-control";
        $this->D_TIME->EditCustomAttributes = "";
        $this->D_TIME->EditValue = $this->D_TIME->CurrentValue;
        $this->D_TIME->PlaceHolder = RemoveHtml($this->D_TIME->caption());

        // MODIFIED_DATE
        $this->MODIFIED_DATE->EditAttrs["class"] = "form-control";
        $this->MODIFIED_DATE->EditCustomAttributes = "";
        $this->MODIFIED_DATE->EditValue = FormatDateTime($this->MODIFIED_DATE->CurrentValue, 8);
        $this->MODIFIED_DATE->PlaceHolder = RemoveHtml($this->MODIFIED_DATE->caption());

        // MODIFIED_BY
        $this->MODIFIED_BY->EditAttrs["class"] = "form-control";
        $this->MODIFIED_BY->EditCustomAttributes = "";
        if (!$this->MODIFIED_BY->Raw) {
            $this->MODIFIED_BY->CurrentValue = HtmlDecode($this->MODIFIED_BY->CurrentValue);
        }
        $this->MODIFIED_BY->EditValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->PlaceHolder = RemoveHtml($this->MODIFIED_BY->caption());

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
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->_USERNAME);
                    $doc->exportCaption($this->MENU_ID);
                    $doc->exportCaption($this->STYPE_ID);
                    $doc->exportCaption($this->GROUP_ID);
                    $doc->exportCaption($this->C);
                    $doc->exportCaption($this->R);
                    $doc->exportCaption($this->U);
                    $doc->exportCaption($this->D);
                    $doc->exportCaption($this->P);
                    $doc->exportCaption($this->E);
                    $doc->exportCaption($this->C_TIME);
                    $doc->exportCaption($this->U_TIME);
                    $doc->exportCaption($this->D_TIME);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->_USERNAME);
                    $doc->exportCaption($this->MENU_ID);
                    $doc->exportCaption($this->STYPE_ID);
                    $doc->exportCaption($this->GROUP_ID);
                    $doc->exportCaption($this->C);
                    $doc->exportCaption($this->R);
                    $doc->exportCaption($this->U);
                    $doc->exportCaption($this->D);
                    $doc->exportCaption($this->P);
                    $doc->exportCaption($this->E);
                    $doc->exportCaption($this->C_TIME);
                    $doc->exportCaption($this->U_TIME);
                    $doc->exportCaption($this->D_TIME);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
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
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->_USERNAME);
                        $doc->exportField($this->MENU_ID);
                        $doc->exportField($this->STYPE_ID);
                        $doc->exportField($this->GROUP_ID);
                        $doc->exportField($this->C);
                        $doc->exportField($this->R);
                        $doc->exportField($this->U);
                        $doc->exportField($this->D);
                        $doc->exportField($this->P);
                        $doc->exportField($this->E);
                        $doc->exportField($this->C_TIME);
                        $doc->exportField($this->U_TIME);
                        $doc->exportField($this->D_TIME);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->_USERNAME);
                        $doc->exportField($this->MENU_ID);
                        $doc->exportField($this->STYPE_ID);
                        $doc->exportField($this->GROUP_ID);
                        $doc->exportField($this->C);
                        $doc->exportField($this->R);
                        $doc->exportField($this->U);
                        $doc->exportField($this->D);
                        $doc->exportField($this->P);
                        $doc->exportField($this->E);
                        $doc->exportField($this->C_TIME);
                        $doc->exportField($this->U_TIME);
                        $doc->exportField($this->D_TIME);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
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
