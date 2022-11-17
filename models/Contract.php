<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for CONTRACT
 */
class Contract extends DbTable
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
    public $CONTRACT_NO;
    public $CONTRACT_DATE;
    public $CONTRACT_VALUE;
    public $RECEIVED_VALUE;
    public $START_DATE;
    public $END_DATE;
    public $YEAR_ID;
    public $ISOK;
    public $DESCRIPTION;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $CONTRACT_TYPE;
    public $ORG_ID;
    public $CLINIC_ID;
    public $ACCOUNT_ID;
    public $NUM;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'CONTRACT';
        $this->TableName = 'CONTRACT';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[CONTRACT]";
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
        $this->ORG_UNIT_CODE = new DbField('CONTRACT', 'CONTRACT', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // CONTRACT_NO
        $this->CONTRACT_NO = new DbField('CONTRACT', 'CONTRACT', 'x_CONTRACT_NO', 'CONTRACT_NO', '[CONTRACT_NO]', '[CONTRACT_NO]', 200, 50, -1, false, '[CONTRACT_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRACT_NO->IsPrimaryKey = true; // Primary key field
        $this->CONTRACT_NO->Nullable = false; // NOT NULL field
        $this->CONTRACT_NO->Required = true; // Required field
        $this->CONTRACT_NO->Sortable = true; // Allow sort
        $this->CONTRACT_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRACT_NO->Param, "CustomMsg");
        $this->Fields['CONTRACT_NO'] = &$this->CONTRACT_NO;

        // CONTRACT_DATE
        $this->CONTRACT_DATE = new DbField('CONTRACT', 'CONTRACT', 'x_CONTRACT_DATE', 'CONTRACT_DATE', '[CONTRACT_DATE]', CastDateFieldForLike("[CONTRACT_DATE]", 0, "DB"), 135, 8, 0, false, '[CONTRACT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRACT_DATE->Sortable = true; // Allow sort
        $this->CONTRACT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->CONTRACT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRACT_DATE->Param, "CustomMsg");
        $this->Fields['CONTRACT_DATE'] = &$this->CONTRACT_DATE;

        // CONTRACT_VALUE
        $this->CONTRACT_VALUE = new DbField('CONTRACT', 'CONTRACT', 'x_CONTRACT_VALUE', 'CONTRACT_VALUE', '[CONTRACT_VALUE]', 'CAST([CONTRACT_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[CONTRACT_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRACT_VALUE->Sortable = true; // Allow sort
        $this->CONTRACT_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->CONTRACT_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->CONTRACT_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRACT_VALUE->Param, "CustomMsg");
        $this->Fields['CONTRACT_VALUE'] = &$this->CONTRACT_VALUE;

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE = new DbField('CONTRACT', 'CONTRACT', 'x_RECEIVED_VALUE', 'RECEIVED_VALUE', '[RECEIVED_VALUE]', 'CAST([RECEIVED_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[RECEIVED_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_VALUE->Sortable = true; // Allow sort
        $this->RECEIVED_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->RECEIVED_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->RECEIVED_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_VALUE->Param, "CustomMsg");
        $this->Fields['RECEIVED_VALUE'] = &$this->RECEIVED_VALUE;

        // START_DATE
        $this->START_DATE = new DbField('CONTRACT', 'CONTRACT', 'x_START_DATE', 'START_DATE', '[START_DATE]', CastDateFieldForLike("[START_DATE]", 0, "DB"), 135, 8, 0, false, '[START_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->START_DATE->Sortable = true; // Allow sort
        $this->START_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->START_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->START_DATE->Param, "CustomMsg");
        $this->Fields['START_DATE'] = &$this->START_DATE;

        // END_DATE
        $this->END_DATE = new DbField('CONTRACT', 'CONTRACT', 'x_END_DATE', 'END_DATE', '[END_DATE]', CastDateFieldForLike("[END_DATE]", 0, "DB"), 135, 8, 0, false, '[END_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->END_DATE->Sortable = true; // Allow sort
        $this->END_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->END_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->END_DATE->Param, "CustomMsg");
        $this->Fields['END_DATE'] = &$this->END_DATE;

        // YEAR_ID
        $this->YEAR_ID = new DbField('CONTRACT', 'CONTRACT', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // ISOK
        $this->ISOK = new DbField('CONTRACT', 'CONTRACT', 'x_ISOK', 'ISOK', '[ISOK]', '[ISOK]', 129, 1, -1, false, '[ISOK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISOK->Sortable = true; // Allow sort
        $this->ISOK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISOK->Param, "CustomMsg");
        $this->Fields['ISOK'] = &$this->ISOK;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('CONTRACT', 'CONTRACT', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('CONTRACT', 'CONTRACT', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('CONTRACT', 'CONTRACT', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // CONTRACT_TYPE
        $this->CONTRACT_TYPE = new DbField('CONTRACT', 'CONTRACT', 'x_CONTRACT_TYPE', 'CONTRACT_TYPE', '[CONTRACT_TYPE]', 'CAST([CONTRACT_TYPE] AS NVARCHAR)', 2, 2, -1, false, '[CONTRACT_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRACT_TYPE->Sortable = true; // Allow sort
        $this->CONTRACT_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CONTRACT_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRACT_TYPE->Param, "CustomMsg");
        $this->Fields['CONTRACT_TYPE'] = &$this->CONTRACT_TYPE;

        // ORG_ID
        $this->ORG_ID = new DbField('CONTRACT', 'CONTRACT', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('CONTRACT', 'CONTRACT', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 50, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('CONTRACT', 'CONTRACT', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // NUM
        $this->NUM = new DbField('CONTRACT', 'CONTRACT', 'x_NUM', 'NUM', '[NUM]', 'CAST([NUM] AS NVARCHAR)', 2, 2, -1, false, '[NUM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NUM->Sortable = true; // Allow sort
        $this->NUM->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NUM->Param, "CustomMsg");
        $this->Fields['NUM'] = &$this->NUM;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[CONTRACT]";
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
            if (array_key_exists('CONTRACT_NO', $rs)) {
                AddFilter($where, QuotedName('CONTRACT_NO', $this->Dbid) . '=' . QuotedValue($rs['CONTRACT_NO'], $this->CONTRACT_NO->DataType, $this->Dbid));
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
        $this->CONTRACT_NO->DbValue = $row['CONTRACT_NO'];
        $this->CONTRACT_DATE->DbValue = $row['CONTRACT_DATE'];
        $this->CONTRACT_VALUE->DbValue = $row['CONTRACT_VALUE'];
        $this->RECEIVED_VALUE->DbValue = $row['RECEIVED_VALUE'];
        $this->START_DATE->DbValue = $row['START_DATE'];
        $this->END_DATE->DbValue = $row['END_DATE'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->ISOK->DbValue = $row['ISOK'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->CONTRACT_TYPE->DbValue = $row['CONTRACT_TYPE'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->NUM->DbValue = $row['NUM'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[CONTRACT_NO] = '@CONTRACT_NO@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->CONTRACT_NO->CurrentValue : $this->CONTRACT_NO->OldValue;
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
                $this->CONTRACT_NO->CurrentValue = $keys[0];
            } else {
                $this->CONTRACT_NO->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('CONTRACT_NO', $row) ? $row['CONTRACT_NO'] : null;
        } else {
            $val = $this->CONTRACT_NO->OldValue !== null ? $this->CONTRACT_NO->OldValue : $this->CONTRACT_NO->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@CONTRACT_NO@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ContractList");
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
        if ($pageName == "ContractView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ContractEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ContractAdd") {
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
                return "ContractView";
            case Config("API_ADD_ACTION"):
                return "ContractAdd";
            case Config("API_EDIT_ACTION"):
                return "ContractEdit";
            case Config("API_DELETE_ACTION"):
                return "ContractDelete";
            case Config("API_LIST_ACTION"):
                return "ContractList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ContractList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ContractView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ContractView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ContractAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ContractAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ContractEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ContractAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ContractDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "CONTRACT_NO:" . JsonEncode($this->CONTRACT_NO->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->CONTRACT_NO->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->CONTRACT_NO->CurrentValue);
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
            if (($keyValue = Param("CONTRACT_NO") ?? Route("CONTRACT_NO")) !== null) {
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
                $this->CONTRACT_NO->CurrentValue = $key;
            } else {
                $this->CONTRACT_NO->OldValue = $key;
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
        $this->CONTRACT_NO->setDbValue($row['CONTRACT_NO']);
        $this->CONTRACT_DATE->setDbValue($row['CONTRACT_DATE']);
        $this->CONTRACT_VALUE->setDbValue($row['CONTRACT_VALUE']);
        $this->RECEIVED_VALUE->setDbValue($row['RECEIVED_VALUE']);
        $this->START_DATE->setDbValue($row['START_DATE']);
        $this->END_DATE->setDbValue($row['END_DATE']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->ISOK->setDbValue($row['ISOK']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->CONTRACT_TYPE->setDbValue($row['CONTRACT_TYPE']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->NUM->setDbValue($row['NUM']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // CONTRACT_NO

        // CONTRACT_DATE

        // CONTRACT_VALUE

        // RECEIVED_VALUE

        // START_DATE

        // END_DATE

        // YEAR_ID

        // ISOK

        // DESCRIPTION

        // MODIFIED_DATE

        // MODIFIED_BY

        // CONTRACT_TYPE

        // ORG_ID

        // CLINIC_ID

        // ACCOUNT_ID

        // NUM

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // CONTRACT_NO
        $this->CONTRACT_NO->ViewValue = $this->CONTRACT_NO->CurrentValue;
        $this->CONTRACT_NO->ViewCustomAttributes = "";

        // CONTRACT_DATE
        $this->CONTRACT_DATE->ViewValue = $this->CONTRACT_DATE->CurrentValue;
        $this->CONTRACT_DATE->ViewValue = FormatDateTime($this->CONTRACT_DATE->ViewValue, 0);
        $this->CONTRACT_DATE->ViewCustomAttributes = "";

        // CONTRACT_VALUE
        $this->CONTRACT_VALUE->ViewValue = $this->CONTRACT_VALUE->CurrentValue;
        $this->CONTRACT_VALUE->ViewValue = FormatNumber($this->CONTRACT_VALUE->ViewValue, 2, -2, -2, -2);
        $this->CONTRACT_VALUE->ViewCustomAttributes = "";

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->ViewValue = $this->RECEIVED_VALUE->CurrentValue;
        $this->RECEIVED_VALUE->ViewValue = FormatNumber($this->RECEIVED_VALUE->ViewValue, 2, -2, -2, -2);
        $this->RECEIVED_VALUE->ViewCustomAttributes = "";

        // START_DATE
        $this->START_DATE->ViewValue = $this->START_DATE->CurrentValue;
        $this->START_DATE->ViewValue = FormatDateTime($this->START_DATE->ViewValue, 0);
        $this->START_DATE->ViewCustomAttributes = "";

        // END_DATE
        $this->END_DATE->ViewValue = $this->END_DATE->CurrentValue;
        $this->END_DATE->ViewValue = FormatDateTime($this->END_DATE->ViewValue, 0);
        $this->END_DATE->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // ISOK
        $this->ISOK->ViewValue = $this->ISOK->CurrentValue;
        $this->ISOK->ViewCustomAttributes = "";

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

        // CONTRACT_TYPE
        $this->CONTRACT_TYPE->ViewValue = $this->CONTRACT_TYPE->CurrentValue;
        $this->CONTRACT_TYPE->ViewValue = FormatNumber($this->CONTRACT_TYPE->ViewValue, 0, -2, -2, -2);
        $this->CONTRACT_TYPE->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // NUM
        $this->NUM->ViewValue = $this->NUM->CurrentValue;
        $this->NUM->ViewValue = FormatNumber($this->NUM->ViewValue, 0, -2, -2, -2);
        $this->NUM->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // CONTRACT_NO
        $this->CONTRACT_NO->LinkCustomAttributes = "";
        $this->CONTRACT_NO->HrefValue = "";
        $this->CONTRACT_NO->TooltipValue = "";

        // CONTRACT_DATE
        $this->CONTRACT_DATE->LinkCustomAttributes = "";
        $this->CONTRACT_DATE->HrefValue = "";
        $this->CONTRACT_DATE->TooltipValue = "";

        // CONTRACT_VALUE
        $this->CONTRACT_VALUE->LinkCustomAttributes = "";
        $this->CONTRACT_VALUE->HrefValue = "";
        $this->CONTRACT_VALUE->TooltipValue = "";

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->LinkCustomAttributes = "";
        $this->RECEIVED_VALUE->HrefValue = "";
        $this->RECEIVED_VALUE->TooltipValue = "";

        // START_DATE
        $this->START_DATE->LinkCustomAttributes = "";
        $this->START_DATE->HrefValue = "";
        $this->START_DATE->TooltipValue = "";

        // END_DATE
        $this->END_DATE->LinkCustomAttributes = "";
        $this->END_DATE->HrefValue = "";
        $this->END_DATE->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // ISOK
        $this->ISOK->LinkCustomAttributes = "";
        $this->ISOK->HrefValue = "";
        $this->ISOK->TooltipValue = "";

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

        // CONTRACT_TYPE
        $this->CONTRACT_TYPE->LinkCustomAttributes = "";
        $this->CONTRACT_TYPE->HrefValue = "";
        $this->CONTRACT_TYPE->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // NUM
        $this->NUM->LinkCustomAttributes = "";
        $this->NUM->HrefValue = "";
        $this->NUM->TooltipValue = "";

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

        // CONTRACT_NO
        $this->CONTRACT_NO->EditAttrs["class"] = "form-control";
        $this->CONTRACT_NO->EditCustomAttributes = "";
        if (!$this->CONTRACT_NO->Raw) {
            $this->CONTRACT_NO->CurrentValue = HtmlDecode($this->CONTRACT_NO->CurrentValue);
        }
        $this->CONTRACT_NO->EditValue = $this->CONTRACT_NO->CurrentValue;
        $this->CONTRACT_NO->PlaceHolder = RemoveHtml($this->CONTRACT_NO->caption());

        // CONTRACT_DATE
        $this->CONTRACT_DATE->EditAttrs["class"] = "form-control";
        $this->CONTRACT_DATE->EditCustomAttributes = "";
        $this->CONTRACT_DATE->EditValue = FormatDateTime($this->CONTRACT_DATE->CurrentValue, 8);
        $this->CONTRACT_DATE->PlaceHolder = RemoveHtml($this->CONTRACT_DATE->caption());

        // CONTRACT_VALUE
        $this->CONTRACT_VALUE->EditAttrs["class"] = "form-control";
        $this->CONTRACT_VALUE->EditCustomAttributes = "";
        $this->CONTRACT_VALUE->EditValue = $this->CONTRACT_VALUE->CurrentValue;
        $this->CONTRACT_VALUE->PlaceHolder = RemoveHtml($this->CONTRACT_VALUE->caption());
        if (strval($this->CONTRACT_VALUE->EditValue) != "" && is_numeric($this->CONTRACT_VALUE->EditValue)) {
            $this->CONTRACT_VALUE->EditValue = FormatNumber($this->CONTRACT_VALUE->EditValue, -2, -2, -2, -2);
        }

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->EditAttrs["class"] = "form-control";
        $this->RECEIVED_VALUE->EditCustomAttributes = "";
        $this->RECEIVED_VALUE->EditValue = $this->RECEIVED_VALUE->CurrentValue;
        $this->RECEIVED_VALUE->PlaceHolder = RemoveHtml($this->RECEIVED_VALUE->caption());
        if (strval($this->RECEIVED_VALUE->EditValue) != "" && is_numeric($this->RECEIVED_VALUE->EditValue)) {
            $this->RECEIVED_VALUE->EditValue = FormatNumber($this->RECEIVED_VALUE->EditValue, -2, -2, -2, -2);
        }

        // START_DATE
        $this->START_DATE->EditAttrs["class"] = "form-control";
        $this->START_DATE->EditCustomAttributes = "";
        $this->START_DATE->EditValue = FormatDateTime($this->START_DATE->CurrentValue, 8);
        $this->START_DATE->PlaceHolder = RemoveHtml($this->START_DATE->caption());

        // END_DATE
        $this->END_DATE->EditAttrs["class"] = "form-control";
        $this->END_DATE->EditCustomAttributes = "";
        $this->END_DATE->EditValue = FormatDateTime($this->END_DATE->CurrentValue, 8);
        $this->END_DATE->PlaceHolder = RemoveHtml($this->END_DATE->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // ISOK
        $this->ISOK->EditAttrs["class"] = "form-control";
        $this->ISOK->EditCustomAttributes = "";
        if (!$this->ISOK->Raw) {
            $this->ISOK->CurrentValue = HtmlDecode($this->ISOK->CurrentValue);
        }
        $this->ISOK->EditValue = $this->ISOK->CurrentValue;
        $this->ISOK->PlaceHolder = RemoveHtml($this->ISOK->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

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

        // CONTRACT_TYPE
        $this->CONTRACT_TYPE->EditAttrs["class"] = "form-control";
        $this->CONTRACT_TYPE->EditCustomAttributes = "";
        $this->CONTRACT_TYPE->EditValue = $this->CONTRACT_TYPE->CurrentValue;
        $this->CONTRACT_TYPE->PlaceHolder = RemoveHtml($this->CONTRACT_TYPE->caption());

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        if (!$this->ORG_ID->Raw) {
            $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
        }
        $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // NUM
        $this->NUM->EditAttrs["class"] = "form-control";
        $this->NUM->EditCustomAttributes = "";
        $this->NUM->EditValue = $this->NUM->CurrentValue;
        $this->NUM->PlaceHolder = RemoveHtml($this->NUM->caption());

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
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->CONTRACT_DATE);
                    $doc->exportCaption($this->CONTRACT_VALUE);
                    $doc->exportCaption($this->RECEIVED_VALUE);
                    $doc->exportCaption($this->START_DATE);
                    $doc->exportCaption($this->END_DATE);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ISOK);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->CONTRACT_TYPE);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->NUM);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->CONTRACT_DATE);
                    $doc->exportCaption($this->CONTRACT_VALUE);
                    $doc->exportCaption($this->RECEIVED_VALUE);
                    $doc->exportCaption($this->START_DATE);
                    $doc->exportCaption($this->END_DATE);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ISOK);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->CONTRACT_TYPE);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->NUM);
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
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->CONTRACT_DATE);
                        $doc->exportField($this->CONTRACT_VALUE);
                        $doc->exportField($this->RECEIVED_VALUE);
                        $doc->exportField($this->START_DATE);
                        $doc->exportField($this->END_DATE);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ISOK);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->CONTRACT_TYPE);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->NUM);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->CONTRACT_DATE);
                        $doc->exportField($this->CONTRACT_VALUE);
                        $doc->exportField($this->RECEIVED_VALUE);
                        $doc->exportField($this->START_DATE);
                        $doc->exportField($this->END_DATE);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ISOK);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->CONTRACT_TYPE);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->NUM);
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
