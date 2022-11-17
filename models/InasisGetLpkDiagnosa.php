<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for INASIS_GET_LPK_DIAGNOSA
 */
class InasisGetLpkDiagnosa extends DbTable
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
    public $LPK_ID;
    public $NOKARTU;
    public $NOSEP;
    public $KDDIAG;
    public $NMDIAG;
    public $LEVELS;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $RESPON;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'INASIS_GET_LPK_DIAGNOSA';
        $this->TableName = 'INASIS_GET_LPK_DIAGNOSA';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[INASIS_GET_LPK_DIAGNOSA]";
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

        // LPK_ID
        $this->LPK_ID = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_LPK_ID', 'LPK_ID', '[LPK_ID]', '[LPK_ID]', 200, 50, -1, false, '[LPK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LPK_ID->IsPrimaryKey = true; // Primary key field
        $this->LPK_ID->Nullable = false; // NOT NULL field
        $this->LPK_ID->Required = true; // Required field
        $this->LPK_ID->Sortable = true; // Allow sort
        $this->LPK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LPK_ID->Param, "CustomMsg");
        $this->Fields['LPK_ID'] = &$this->LPK_ID;

        // NOKARTU
        $this->NOKARTU = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_NOKARTU', 'NOKARTU', '[NOKARTU]', '[NOKARTU]', 200, 50, -1, false, '[NOKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOKARTU->IsPrimaryKey = true; // Primary key field
        $this->NOKARTU->Nullable = false; // NOT NULL field
        $this->NOKARTU->Required = true; // Required field
        $this->NOKARTU->Sortable = true; // Allow sort
        $this->NOKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOKARTU->Param, "CustomMsg");
        $this->Fields['NOKARTU'] = &$this->NOKARTU;

        // NOSEP
        $this->NOSEP = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_NOSEP', 'NOSEP', '[NOSEP]', '[NOSEP]', 200, 50, -1, false, '[NOSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSEP->IsPrimaryKey = true; // Primary key field
        $this->NOSEP->Nullable = false; // NOT NULL field
        $this->NOSEP->Required = true; // Required field
        $this->NOSEP->Sortable = true; // Allow sort
        $this->NOSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSEP->Param, "CustomMsg");
        $this->Fields['NOSEP'] = &$this->NOSEP;

        // KDDIAG
        $this->KDDIAG = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_KDDIAG', 'KDDIAG', '[KDDIAG]', '[KDDIAG]', 200, 10, -1, false, '[KDDIAG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDDIAG->IsPrimaryKey = true; // Primary key field
        $this->KDDIAG->Nullable = false; // NOT NULL field
        $this->KDDIAG->Required = true; // Required field
        $this->KDDIAG->Sortable = true; // Allow sort
        $this->KDDIAG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDDIAG->Param, "CustomMsg");
        $this->Fields['KDDIAG'] = &$this->KDDIAG;

        // NMDIAG
        $this->NMDIAG = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_NMDIAG', 'NMDIAG', '[NMDIAG]', '[NMDIAG]', 200, 150, -1, false, '[NMDIAG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMDIAG->Sortable = true; // Allow sort
        $this->NMDIAG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMDIAG->Param, "CustomMsg");
        $this->Fields['NMDIAG'] = &$this->NMDIAG;

        // LEVELS
        $this->LEVELS = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_LEVELS', 'LEVELS', '[LEVELS]', 'CAST([LEVELS] AS NVARCHAR)', 17, 1, -1, false, '[LEVELS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LEVELS->Sortable = true; // Allow sort
        $this->LEVELS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->LEVELS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LEVELS->Param, "CustomMsg");
        $this->Fields['LEVELS'] = &$this->LEVELS;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // RESPON
        $this->RESPON = new DbField('INASIS_GET_LPK_DIAGNOSA', 'INASIS_GET_LPK_DIAGNOSA', 'x_RESPON', 'RESPON', '[RESPON]', '[RESPON]', 201, 0, -1, false, '[RESPON]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPON->Sortable = true; // Allow sort
        $this->RESPON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPON->Param, "CustomMsg");
        $this->Fields['RESPON'] = &$this->RESPON;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[INASIS_GET_LPK_DIAGNOSA]";
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
            if (array_key_exists('LPK_ID', $rs)) {
                AddFilter($where, QuotedName('LPK_ID', $this->Dbid) . '=' . QuotedValue($rs['LPK_ID'], $this->LPK_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('NOKARTU', $rs)) {
                AddFilter($where, QuotedName('NOKARTU', $this->Dbid) . '=' . QuotedValue($rs['NOKARTU'], $this->NOKARTU->DataType, $this->Dbid));
            }
            if (array_key_exists('NOSEP', $rs)) {
                AddFilter($where, QuotedName('NOSEP', $this->Dbid) . '=' . QuotedValue($rs['NOSEP'], $this->NOSEP->DataType, $this->Dbid));
            }
            if (array_key_exists('KDDIAG', $rs)) {
                AddFilter($where, QuotedName('KDDIAG', $this->Dbid) . '=' . QuotedValue($rs['KDDIAG'], $this->KDDIAG->DataType, $this->Dbid));
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
        $this->LPK_ID->DbValue = $row['LPK_ID'];
        $this->NOKARTU->DbValue = $row['NOKARTU'];
        $this->NOSEP->DbValue = $row['NOSEP'];
        $this->KDDIAG->DbValue = $row['KDDIAG'];
        $this->NMDIAG->DbValue = $row['NMDIAG'];
        $this->LEVELS->DbValue = $row['LEVELS'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->RESPON->DbValue = $row['RESPON'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[LPK_ID] = '@LPK_ID@' AND [NOKARTU] = '@NOKARTU@' AND [NOSEP] = '@NOSEP@' AND [KDDIAG] = '@KDDIAG@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->LPK_ID->CurrentValue : $this->LPK_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->NOKARTU->CurrentValue : $this->NOKARTU->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->NOSEP->CurrentValue : $this->NOSEP->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->KDDIAG->CurrentValue : $this->KDDIAG->OldValue;
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
                $this->LPK_ID->CurrentValue = $keys[0];
            } else {
                $this->LPK_ID->OldValue = $keys[0];
            }
            if ($current) {
                $this->NOKARTU->CurrentValue = $keys[1];
            } else {
                $this->NOKARTU->OldValue = $keys[1];
            }
            if ($current) {
                $this->NOSEP->CurrentValue = $keys[2];
            } else {
                $this->NOSEP->OldValue = $keys[2];
            }
            if ($current) {
                $this->KDDIAG->CurrentValue = $keys[3];
            } else {
                $this->KDDIAG->OldValue = $keys[3];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('LPK_ID', $row) ? $row['LPK_ID'] : null;
        } else {
            $val = $this->LPK_ID->OldValue !== null ? $this->LPK_ID->OldValue : $this->LPK_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@LPK_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('NOKARTU', $row) ? $row['NOKARTU'] : null;
        } else {
            $val = $this->NOKARTU->OldValue !== null ? $this->NOKARTU->OldValue : $this->NOKARTU->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NOKARTU@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('NOSEP', $row) ? $row['NOSEP'] : null;
        } else {
            $val = $this->NOSEP->OldValue !== null ? $this->NOSEP->OldValue : $this->NOSEP->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NOSEP@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('KDDIAG', $row) ? $row['KDDIAG'] : null;
        } else {
            $val = $this->KDDIAG->OldValue !== null ? $this->KDDIAG->OldValue : $this->KDDIAG->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@KDDIAG@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("InasisGetLpkDiagnosaList");
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
        if ($pageName == "InasisGetLpkDiagnosaView") {
            return $Language->phrase("View");
        } elseif ($pageName == "InasisGetLpkDiagnosaEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "InasisGetLpkDiagnosaAdd") {
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
                return "InasisGetLpkDiagnosaView";
            case Config("API_ADD_ACTION"):
                return "InasisGetLpkDiagnosaAdd";
            case Config("API_EDIT_ACTION"):
                return "InasisGetLpkDiagnosaEdit";
            case Config("API_DELETE_ACTION"):
                return "InasisGetLpkDiagnosaDelete";
            case Config("API_LIST_ACTION"):
                return "InasisGetLpkDiagnosaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "InasisGetLpkDiagnosaList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("InasisGetLpkDiagnosaView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("InasisGetLpkDiagnosaView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "InasisGetLpkDiagnosaAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "InasisGetLpkDiagnosaAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("InasisGetLpkDiagnosaEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("InasisGetLpkDiagnosaAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("InasisGetLpkDiagnosaDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "LPK_ID:" . JsonEncode($this->LPK_ID->CurrentValue, "string");
        $json .= ",NOKARTU:" . JsonEncode($this->NOKARTU->CurrentValue, "string");
        $json .= ",NOSEP:" . JsonEncode($this->NOSEP->CurrentValue, "string");
        $json .= ",KDDIAG:" . JsonEncode($this->KDDIAG->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->LPK_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->LPK_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->NOKARTU->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NOKARTU->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->NOSEP->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NOSEP->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->KDDIAG->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->KDDIAG->CurrentValue);
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
            if (($keyValue = Param("LPK_ID") ?? Route("LPK_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("NOKARTU") ?? Route("NOKARTU")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("NOSEP") ?? Route("NOSEP")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(2) ?? Route(4)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("KDDIAG") ?? Route("KDDIAG")) !== null) {
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
                $this->LPK_ID->CurrentValue = $key[0];
            } else {
                $this->LPK_ID->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->NOKARTU->CurrentValue = $key[1];
            } else {
                $this->NOKARTU->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->NOSEP->CurrentValue = $key[2];
            } else {
                $this->NOSEP->OldValue = $key[2];
            }
            if ($setCurrent) {
                $this->KDDIAG->CurrentValue = $key[3];
            } else {
                $this->KDDIAG->OldValue = $key[3];
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
        $this->LPK_ID->setDbValue($row['LPK_ID']);
        $this->NOKARTU->setDbValue($row['NOKARTU']);
        $this->NOSEP->setDbValue($row['NOSEP']);
        $this->KDDIAG->setDbValue($row['KDDIAG']);
        $this->NMDIAG->setDbValue($row['NMDIAG']);
        $this->LEVELS->setDbValue($row['LEVELS']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->RESPON->setDbValue($row['RESPON']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // LPK_ID

        // NOKARTU

        // NOSEP

        // KDDIAG

        // NMDIAG

        // LEVELS

        // MODIFIED_DATE

        // MODIFIED_BY

        // RESPON

        // LPK_ID
        $this->LPK_ID->ViewValue = $this->LPK_ID->CurrentValue;
        $this->LPK_ID->ViewCustomAttributes = "";

        // NOKARTU
        $this->NOKARTU->ViewValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->ViewCustomAttributes = "";

        // NOSEP
        $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->ViewCustomAttributes = "";

        // KDDIAG
        $this->KDDIAG->ViewValue = $this->KDDIAG->CurrentValue;
        $this->KDDIAG->ViewCustomAttributes = "";

        // NMDIAG
        $this->NMDIAG->ViewValue = $this->NMDIAG->CurrentValue;
        $this->NMDIAG->ViewCustomAttributes = "";

        // LEVELS
        $this->LEVELS->ViewValue = $this->LEVELS->CurrentValue;
        $this->LEVELS->ViewValue = FormatNumber($this->LEVELS->ViewValue, 0, -2, -2, -2);
        $this->LEVELS->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // RESPON
        $this->RESPON->ViewValue = $this->RESPON->CurrentValue;
        $this->RESPON->ViewCustomAttributes = "";

        // LPK_ID
        $this->LPK_ID->LinkCustomAttributes = "";
        $this->LPK_ID->HrefValue = "";
        $this->LPK_ID->TooltipValue = "";

        // NOKARTU
        $this->NOKARTU->LinkCustomAttributes = "";
        $this->NOKARTU->HrefValue = "";
        $this->NOKARTU->TooltipValue = "";

        // NOSEP
        $this->NOSEP->LinkCustomAttributes = "";
        $this->NOSEP->HrefValue = "";
        $this->NOSEP->TooltipValue = "";

        // KDDIAG
        $this->KDDIAG->LinkCustomAttributes = "";
        $this->KDDIAG->HrefValue = "";
        $this->KDDIAG->TooltipValue = "";

        // NMDIAG
        $this->NMDIAG->LinkCustomAttributes = "";
        $this->NMDIAG->HrefValue = "";
        $this->NMDIAG->TooltipValue = "";

        // LEVELS
        $this->LEVELS->LinkCustomAttributes = "";
        $this->LEVELS->HrefValue = "";
        $this->LEVELS->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // RESPON
        $this->RESPON->LinkCustomAttributes = "";
        $this->RESPON->HrefValue = "";
        $this->RESPON->TooltipValue = "";

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

        // LPK_ID
        $this->LPK_ID->EditAttrs["class"] = "form-control";
        $this->LPK_ID->EditCustomAttributes = "";
        if (!$this->LPK_ID->Raw) {
            $this->LPK_ID->CurrentValue = HtmlDecode($this->LPK_ID->CurrentValue);
        }
        $this->LPK_ID->EditValue = $this->LPK_ID->CurrentValue;
        $this->LPK_ID->PlaceHolder = RemoveHtml($this->LPK_ID->caption());

        // NOKARTU
        $this->NOKARTU->EditAttrs["class"] = "form-control";
        $this->NOKARTU->EditCustomAttributes = "";
        if (!$this->NOKARTU->Raw) {
            $this->NOKARTU->CurrentValue = HtmlDecode($this->NOKARTU->CurrentValue);
        }
        $this->NOKARTU->EditValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->PlaceHolder = RemoveHtml($this->NOKARTU->caption());

        // NOSEP
        $this->NOSEP->EditAttrs["class"] = "form-control";
        $this->NOSEP->EditCustomAttributes = "";
        if (!$this->NOSEP->Raw) {
            $this->NOSEP->CurrentValue = HtmlDecode($this->NOSEP->CurrentValue);
        }
        $this->NOSEP->EditValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->PlaceHolder = RemoveHtml($this->NOSEP->caption());

        // KDDIAG
        $this->KDDIAG->EditAttrs["class"] = "form-control";
        $this->KDDIAG->EditCustomAttributes = "";
        if (!$this->KDDIAG->Raw) {
            $this->KDDIAG->CurrentValue = HtmlDecode($this->KDDIAG->CurrentValue);
        }
        $this->KDDIAG->EditValue = $this->KDDIAG->CurrentValue;
        $this->KDDIAG->PlaceHolder = RemoveHtml($this->KDDIAG->caption());

        // NMDIAG
        $this->NMDIAG->EditAttrs["class"] = "form-control";
        $this->NMDIAG->EditCustomAttributes = "";
        if (!$this->NMDIAG->Raw) {
            $this->NMDIAG->CurrentValue = HtmlDecode($this->NMDIAG->CurrentValue);
        }
        $this->NMDIAG->EditValue = $this->NMDIAG->CurrentValue;
        $this->NMDIAG->PlaceHolder = RemoveHtml($this->NMDIAG->caption());

        // LEVELS
        $this->LEVELS->EditAttrs["class"] = "form-control";
        $this->LEVELS->EditCustomAttributes = "";
        $this->LEVELS->EditValue = $this->LEVELS->CurrentValue;
        $this->LEVELS->PlaceHolder = RemoveHtml($this->LEVELS->caption());

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

        // RESPON
        $this->RESPON->EditAttrs["class"] = "form-control";
        $this->RESPON->EditCustomAttributes = "";
        $this->RESPON->EditValue = $this->RESPON->CurrentValue;
        $this->RESPON->PlaceHolder = RemoveHtml($this->RESPON->caption());

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
                    $doc->exportCaption($this->LPK_ID);
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->KDDIAG);
                    $doc->exportCaption($this->NMDIAG);
                    $doc->exportCaption($this->LEVELS);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->RESPON);
                } else {
                    $doc->exportCaption($this->LPK_ID);
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->KDDIAG);
                    $doc->exportCaption($this->NMDIAG);
                    $doc->exportCaption($this->LEVELS);
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
                        $doc->exportField($this->LPK_ID);
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->KDDIAG);
                        $doc->exportField($this->NMDIAG);
                        $doc->exportField($this->LEVELS);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->RESPON);
                    } else {
                        $doc->exportField($this->LPK_ID);
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->KDDIAG);
                        $doc->exportField($this->NMDIAG);
                        $doc->exportField($this->LEVELS);
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
