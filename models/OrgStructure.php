<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for ORG_STRUCTURE
 */
class OrgStructure extends DbTable
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
    public $ORG_ID;
    public $OTHER_CODE;
    public $NAME_ORG;
    public $HIRARKI_ID;
    public $MAIN_PARENT;
    public $DIRECT_PARENT;
    public $ROOMS_ID;
    public $EXTENSION;
    public $IP_ADDRESS;
    public $ACCOUNT_ID;
    public $OBJECT_CATEGORY_ID;
    public $PROFIT_ID;
    public $FA_V;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'ORG_STRUCTURE';
        $this->TableName = 'ORG_STRUCTURE';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[ORG_STRUCTURE]";
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
        $this->ORG_UNIT_CODE = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // ORG_ID
        $this->ORG_ID = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->IsPrimaryKey = true; // Primary key field
        $this->ORG_ID->Nullable = false; // NOT NULL field
        $this->ORG_ID->Required = true; // Required field
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // OTHER_CODE
        $this->OTHER_CODE = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_OTHER_CODE', 'OTHER_CODE', '[OTHER_CODE]', '[OTHER_CODE]', 200, 50, -1, false, '[OTHER_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_CODE->Sortable = true; // Allow sort
        $this->OTHER_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_CODE->Param, "CustomMsg");
        $this->Fields['OTHER_CODE'] = &$this->OTHER_CODE;

        // NAME_ORG
        $this->NAME_ORG = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_NAME_ORG', 'NAME_ORG', '[NAME_ORG]', '[NAME_ORG]', 200, 100, -1, false, '[NAME_ORG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_ORG->Sortable = true; // Allow sort
        $this->NAME_ORG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_ORG->Param, "CustomMsg");
        $this->Fields['NAME_ORG'] = &$this->NAME_ORG;

        // HIRARKI_ID
        $this->HIRARKI_ID = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_HIRARKI_ID', 'HIRARKI_ID', '[HIRARKI_ID]', 'CAST([HIRARKI_ID] AS NVARCHAR)', 2, 2, -1, false, '[HIRARKI_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HIRARKI_ID->Sortable = true; // Allow sort
        $this->HIRARKI_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->HIRARKI_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HIRARKI_ID->Param, "CustomMsg");
        $this->Fields['HIRARKI_ID'] = &$this->HIRARKI_ID;

        // MAIN_PARENT
        $this->MAIN_PARENT = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_MAIN_PARENT', 'MAIN_PARENT', '[MAIN_PARENT]', '[MAIN_PARENT]', 200, 50, -1, false, '[MAIN_PARENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MAIN_PARENT->Sortable = true; // Allow sort
        $this->MAIN_PARENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MAIN_PARENT->Param, "CustomMsg");
        $this->Fields['MAIN_PARENT'] = &$this->MAIN_PARENT;

        // DIRECT_PARENT
        $this->DIRECT_PARENT = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_DIRECT_PARENT', 'DIRECT_PARENT', '[DIRECT_PARENT]', '[DIRECT_PARENT]', 200, 50, -1, false, '[DIRECT_PARENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIRECT_PARENT->Sortable = true; // Allow sort
        $this->DIRECT_PARENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIRECT_PARENT->Param, "CustomMsg");
        $this->Fields['DIRECT_PARENT'] = &$this->DIRECT_PARENT;

        // ROOMS_ID
        $this->ROOMS_ID = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_ROOMS_ID', 'ROOMS_ID', '[ROOMS_ID]', '[ROOMS_ID]', 200, 10, -1, false, '[ROOMS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ROOMS_ID->Sortable = true; // Allow sort
        $this->ROOMS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ROOMS_ID->Param, "CustomMsg");
        $this->Fields['ROOMS_ID'] = &$this->ROOMS_ID;

        // EXTENSION
        $this->EXTENSION = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_EXTENSION', 'EXTENSION', '[EXTENSION]', '[EXTENSION]', 200, 3, -1, false, '[EXTENSION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXTENSION->Sortable = true; // Allow sort
        $this->EXTENSION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXTENSION->Param, "CustomMsg");
        $this->Fields['EXTENSION'] = &$this->EXTENSION;

        // IP_ADDRESS
        $this->IP_ADDRESS = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_IP_ADDRESS', 'IP_ADDRESS', '[IP_ADDRESS]', '[IP_ADDRESS]', 200, 50, -1, false, '[IP_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IP_ADDRESS->Sortable = true; // Allow sort
        $this->IP_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IP_ADDRESS->Param, "CustomMsg");
        $this->Fields['IP_ADDRESS'] = &$this->IP_ADDRESS;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_OBJECT_CATEGORY_ID', 'OBJECT_CATEGORY_ID', '[OBJECT_CATEGORY_ID]', 'CAST([OBJECT_CATEGORY_ID] AS NVARCHAR)', 2, 2, -1, false, '[OBJECT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->OBJECT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->OBJECT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['OBJECT_CATEGORY_ID'] = &$this->OBJECT_CATEGORY_ID;

        // PROFIT_ID
        $this->PROFIT_ID = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_PROFIT_ID', 'PROFIT_ID', '[PROFIT_ID]', '[PROFIT_ID]', 200, 50, -1, false, '[PROFIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROFIT_ID->Sortable = true; // Allow sort
        $this->PROFIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROFIT_ID->Param, "CustomMsg");
        $this->Fields['PROFIT_ID'] = &$this->PROFIT_ID;

        // FA_V
        $this->FA_V = new DbField('ORG_STRUCTURE', 'ORG_STRUCTURE', 'x_FA_V', 'FA_V', '[FA_V]', 'CAST([FA_V] AS NVARCHAR)', 3, 4, -1, false, '[FA_V]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V->Sortable = true; // Allow sort
        $this->FA_V->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FA_V->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V->Param, "CustomMsg");
        $this->Fields['FA_V'] = &$this->FA_V;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[ORG_STRUCTURE]";
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
            if (array_key_exists('ORG_ID', $rs)) {
                AddFilter($where, QuotedName('ORG_ID', $this->Dbid) . '=' . QuotedValue($rs['ORG_ID'], $this->ORG_ID->DataType, $this->Dbid));
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
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->OTHER_CODE->DbValue = $row['OTHER_CODE'];
        $this->NAME_ORG->DbValue = $row['NAME_ORG'];
        $this->HIRARKI_ID->DbValue = $row['HIRARKI_ID'];
        $this->MAIN_PARENT->DbValue = $row['MAIN_PARENT'];
        $this->DIRECT_PARENT->DbValue = $row['DIRECT_PARENT'];
        $this->ROOMS_ID->DbValue = $row['ROOMS_ID'];
        $this->EXTENSION->DbValue = $row['EXTENSION'];
        $this->IP_ADDRESS->DbValue = $row['IP_ADDRESS'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->OBJECT_CATEGORY_ID->DbValue = $row['OBJECT_CATEGORY_ID'];
        $this->PROFIT_ID->DbValue = $row['PROFIT_ID'];
        $this->FA_V->DbValue = $row['FA_V'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [ORG_ID] = '@ORG_ID@'";
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
        $val = $current ? $this->ORG_ID->CurrentValue : $this->ORG_ID->OldValue;
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
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
            }
            if ($current) {
                $this->ORG_ID->CurrentValue = $keys[1];
            } else {
                $this->ORG_ID->OldValue = $keys[1];
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
            $val = array_key_exists('ORG_ID', $row) ? $row['ORG_ID'] : null;
        } else {
            $val = $this->ORG_ID->OldValue !== null ? $this->ORG_ID->OldValue : $this->ORG_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ORG_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("OrgStructureList");
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
        if ($pageName == "OrgStructureView") {
            return $Language->phrase("View");
        } elseif ($pageName == "OrgStructureEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "OrgStructureAdd") {
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
                return "OrgStructureView";
            case Config("API_ADD_ACTION"):
                return "OrgStructureAdd";
            case Config("API_EDIT_ACTION"):
                return "OrgStructureEdit";
            case Config("API_DELETE_ACTION"):
                return "OrgStructureDelete";
            case Config("API_LIST_ACTION"):
                return "OrgStructureList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "OrgStructureList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("OrgStructureView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("OrgStructureView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "OrgStructureAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "OrgStructureAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("OrgStructureEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("OrgStructureAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("OrgStructureDelete", $this->getUrlParm());
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
        $json .= ",ORG_ID:" . JsonEncode($this->ORG_ID->CurrentValue, "string");
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
        if ($this->ORG_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ORG_ID->CurrentValue);
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
            if (($keyValue = Param("ORG_ID") ?? Route("ORG_ID")) !== null) {
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
                $this->ORG_ID->CurrentValue = $key[1];
            } else {
                $this->ORG_ID->OldValue = $key[1];
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
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->OTHER_CODE->setDbValue($row['OTHER_CODE']);
        $this->NAME_ORG->setDbValue($row['NAME_ORG']);
        $this->HIRARKI_ID->setDbValue($row['HIRARKI_ID']);
        $this->MAIN_PARENT->setDbValue($row['MAIN_PARENT']);
        $this->DIRECT_PARENT->setDbValue($row['DIRECT_PARENT']);
        $this->ROOMS_ID->setDbValue($row['ROOMS_ID']);
        $this->EXTENSION->setDbValue($row['EXTENSION']);
        $this->IP_ADDRESS->setDbValue($row['IP_ADDRESS']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->OBJECT_CATEGORY_ID->setDbValue($row['OBJECT_CATEGORY_ID']);
        $this->PROFIT_ID->setDbValue($row['PROFIT_ID']);
        $this->FA_V->setDbValue($row['FA_V']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // ORG_ID

        // OTHER_CODE

        // NAME_ORG

        // HIRARKI_ID

        // MAIN_PARENT

        // DIRECT_PARENT

        // ROOMS_ID

        // EXTENSION

        // IP_ADDRESS

        // ACCOUNT_ID

        // OBJECT_CATEGORY_ID

        // PROFIT_ID

        // FA_V

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // OTHER_CODE
        $this->OTHER_CODE->ViewValue = $this->OTHER_CODE->CurrentValue;
        $this->OTHER_CODE->ViewCustomAttributes = "";

        // NAME_ORG
        $this->NAME_ORG->ViewValue = $this->NAME_ORG->CurrentValue;
        $this->NAME_ORG->ViewCustomAttributes = "";

        // HIRARKI_ID
        $this->HIRARKI_ID->ViewValue = $this->HIRARKI_ID->CurrentValue;
        $this->HIRARKI_ID->ViewValue = FormatNumber($this->HIRARKI_ID->ViewValue, 0, -2, -2, -2);
        $this->HIRARKI_ID->ViewCustomAttributes = "";

        // MAIN_PARENT
        $this->MAIN_PARENT->ViewValue = $this->MAIN_PARENT->CurrentValue;
        $this->MAIN_PARENT->ViewCustomAttributes = "";

        // DIRECT_PARENT
        $this->DIRECT_PARENT->ViewValue = $this->DIRECT_PARENT->CurrentValue;
        $this->DIRECT_PARENT->ViewCustomAttributes = "";

        // ROOMS_ID
        $this->ROOMS_ID->ViewValue = $this->ROOMS_ID->CurrentValue;
        $this->ROOMS_ID->ViewCustomAttributes = "";

        // EXTENSION
        $this->EXTENSION->ViewValue = $this->EXTENSION->CurrentValue;
        $this->EXTENSION->ViewCustomAttributes = "";

        // IP_ADDRESS
        $this->IP_ADDRESS->ViewValue = $this->IP_ADDRESS->CurrentValue;
        $this->IP_ADDRESS->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->ViewValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->ViewValue = FormatNumber($this->OBJECT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
        $this->OBJECT_CATEGORY_ID->ViewCustomAttributes = "";

        // PROFIT_ID
        $this->PROFIT_ID->ViewValue = $this->PROFIT_ID->CurrentValue;
        $this->PROFIT_ID->ViewCustomAttributes = "";

        // FA_V
        $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
        $this->FA_V->ViewValue = FormatNumber($this->FA_V->ViewValue, 0, -2, -2, -2);
        $this->FA_V->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // OTHER_CODE
        $this->OTHER_CODE->LinkCustomAttributes = "";
        $this->OTHER_CODE->HrefValue = "";
        $this->OTHER_CODE->TooltipValue = "";

        // NAME_ORG
        $this->NAME_ORG->LinkCustomAttributes = "";
        $this->NAME_ORG->HrefValue = "";
        $this->NAME_ORG->TooltipValue = "";

        // HIRARKI_ID
        $this->HIRARKI_ID->LinkCustomAttributes = "";
        $this->HIRARKI_ID->HrefValue = "";
        $this->HIRARKI_ID->TooltipValue = "";

        // MAIN_PARENT
        $this->MAIN_PARENT->LinkCustomAttributes = "";
        $this->MAIN_PARENT->HrefValue = "";
        $this->MAIN_PARENT->TooltipValue = "";

        // DIRECT_PARENT
        $this->DIRECT_PARENT->LinkCustomAttributes = "";
        $this->DIRECT_PARENT->HrefValue = "";
        $this->DIRECT_PARENT->TooltipValue = "";

        // ROOMS_ID
        $this->ROOMS_ID->LinkCustomAttributes = "";
        $this->ROOMS_ID->HrefValue = "";
        $this->ROOMS_ID->TooltipValue = "";

        // EXTENSION
        $this->EXTENSION->LinkCustomAttributes = "";
        $this->EXTENSION->HrefValue = "";
        $this->EXTENSION->TooltipValue = "";

        // IP_ADDRESS
        $this->IP_ADDRESS->LinkCustomAttributes = "";
        $this->IP_ADDRESS->HrefValue = "";
        $this->IP_ADDRESS->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->HrefValue = "";
        $this->OBJECT_CATEGORY_ID->TooltipValue = "";

        // PROFIT_ID
        $this->PROFIT_ID->LinkCustomAttributes = "";
        $this->PROFIT_ID->HrefValue = "";
        $this->PROFIT_ID->TooltipValue = "";

        // FA_V
        $this->FA_V->LinkCustomAttributes = "";
        $this->FA_V->HrefValue = "";
        $this->FA_V->TooltipValue = "";

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

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        if (!$this->ORG_ID->Raw) {
            $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
        }
        $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

        // OTHER_CODE
        $this->OTHER_CODE->EditAttrs["class"] = "form-control";
        $this->OTHER_CODE->EditCustomAttributes = "";
        if (!$this->OTHER_CODE->Raw) {
            $this->OTHER_CODE->CurrentValue = HtmlDecode($this->OTHER_CODE->CurrentValue);
        }
        $this->OTHER_CODE->EditValue = $this->OTHER_CODE->CurrentValue;
        $this->OTHER_CODE->PlaceHolder = RemoveHtml($this->OTHER_CODE->caption());

        // NAME_ORG
        $this->NAME_ORG->EditAttrs["class"] = "form-control";
        $this->NAME_ORG->EditCustomAttributes = "";
        if (!$this->NAME_ORG->Raw) {
            $this->NAME_ORG->CurrentValue = HtmlDecode($this->NAME_ORG->CurrentValue);
        }
        $this->NAME_ORG->EditValue = $this->NAME_ORG->CurrentValue;
        $this->NAME_ORG->PlaceHolder = RemoveHtml($this->NAME_ORG->caption());

        // HIRARKI_ID
        $this->HIRARKI_ID->EditAttrs["class"] = "form-control";
        $this->HIRARKI_ID->EditCustomAttributes = "";
        $this->HIRARKI_ID->EditValue = $this->HIRARKI_ID->CurrentValue;
        $this->HIRARKI_ID->PlaceHolder = RemoveHtml($this->HIRARKI_ID->caption());

        // MAIN_PARENT
        $this->MAIN_PARENT->EditAttrs["class"] = "form-control";
        $this->MAIN_PARENT->EditCustomAttributes = "";
        if (!$this->MAIN_PARENT->Raw) {
            $this->MAIN_PARENT->CurrentValue = HtmlDecode($this->MAIN_PARENT->CurrentValue);
        }
        $this->MAIN_PARENT->EditValue = $this->MAIN_PARENT->CurrentValue;
        $this->MAIN_PARENT->PlaceHolder = RemoveHtml($this->MAIN_PARENT->caption());

        // DIRECT_PARENT
        $this->DIRECT_PARENT->EditAttrs["class"] = "form-control";
        $this->DIRECT_PARENT->EditCustomAttributes = "";
        if (!$this->DIRECT_PARENT->Raw) {
            $this->DIRECT_PARENT->CurrentValue = HtmlDecode($this->DIRECT_PARENT->CurrentValue);
        }
        $this->DIRECT_PARENT->EditValue = $this->DIRECT_PARENT->CurrentValue;
        $this->DIRECT_PARENT->PlaceHolder = RemoveHtml($this->DIRECT_PARENT->caption());

        // ROOMS_ID
        $this->ROOMS_ID->EditAttrs["class"] = "form-control";
        $this->ROOMS_ID->EditCustomAttributes = "";
        if (!$this->ROOMS_ID->Raw) {
            $this->ROOMS_ID->CurrentValue = HtmlDecode($this->ROOMS_ID->CurrentValue);
        }
        $this->ROOMS_ID->EditValue = $this->ROOMS_ID->CurrentValue;
        $this->ROOMS_ID->PlaceHolder = RemoveHtml($this->ROOMS_ID->caption());

        // EXTENSION
        $this->EXTENSION->EditAttrs["class"] = "form-control";
        $this->EXTENSION->EditCustomAttributes = "";
        if (!$this->EXTENSION->Raw) {
            $this->EXTENSION->CurrentValue = HtmlDecode($this->EXTENSION->CurrentValue);
        }
        $this->EXTENSION->EditValue = $this->EXTENSION->CurrentValue;
        $this->EXTENSION->PlaceHolder = RemoveHtml($this->EXTENSION->caption());

        // IP_ADDRESS
        $this->IP_ADDRESS->EditAttrs["class"] = "form-control";
        $this->IP_ADDRESS->EditCustomAttributes = "";
        if (!$this->IP_ADDRESS->Raw) {
            $this->IP_ADDRESS->CurrentValue = HtmlDecode($this->IP_ADDRESS->CurrentValue);
        }
        $this->IP_ADDRESS->EditValue = $this->IP_ADDRESS->CurrentValue;
        $this->IP_ADDRESS->PlaceHolder = RemoveHtml($this->IP_ADDRESS->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->OBJECT_CATEGORY_ID->EditCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->EditValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->OBJECT_CATEGORY_ID->caption());

        // PROFIT_ID
        $this->PROFIT_ID->EditAttrs["class"] = "form-control";
        $this->PROFIT_ID->EditCustomAttributes = "";
        if (!$this->PROFIT_ID->Raw) {
            $this->PROFIT_ID->CurrentValue = HtmlDecode($this->PROFIT_ID->CurrentValue);
        }
        $this->PROFIT_ID->EditValue = $this->PROFIT_ID->CurrentValue;
        $this->PROFIT_ID->PlaceHolder = RemoveHtml($this->PROFIT_ID->caption());

        // FA_V
        $this->FA_V->EditAttrs["class"] = "form-control";
        $this->FA_V->EditCustomAttributes = "";
        $this->FA_V->EditValue = $this->FA_V->CurrentValue;
        $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

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
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->NAME_ORG);
                    $doc->exportCaption($this->HIRARKI_ID);
                    $doc->exportCaption($this->MAIN_PARENT);
                    $doc->exportCaption($this->DIRECT_PARENT);
                    $doc->exportCaption($this->ROOMS_ID);
                    $doc->exportCaption($this->EXTENSION);
                    $doc->exportCaption($this->IP_ADDRESS);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->PROFIT_ID);
                    $doc->exportCaption($this->FA_V);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->NAME_ORG);
                    $doc->exportCaption($this->HIRARKI_ID);
                    $doc->exportCaption($this->MAIN_PARENT);
                    $doc->exportCaption($this->DIRECT_PARENT);
                    $doc->exportCaption($this->ROOMS_ID);
                    $doc->exportCaption($this->EXTENSION);
                    $doc->exportCaption($this->IP_ADDRESS);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->PROFIT_ID);
                    $doc->exportCaption($this->FA_V);
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
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->NAME_ORG);
                        $doc->exportField($this->HIRARKI_ID);
                        $doc->exportField($this->MAIN_PARENT);
                        $doc->exportField($this->DIRECT_PARENT);
                        $doc->exportField($this->ROOMS_ID);
                        $doc->exportField($this->EXTENSION);
                        $doc->exportField($this->IP_ADDRESS);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->PROFIT_ID);
                        $doc->exportField($this->FA_V);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->NAME_ORG);
                        $doc->exportField($this->HIRARKI_ID);
                        $doc->exportField($this->MAIN_PARENT);
                        $doc->exportField($this->DIRECT_PARENT);
                        $doc->exportField($this->ROOMS_ID);
                        $doc->exportField($this->EXTENSION);
                        $doc->exportField($this->IP_ADDRESS);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->PROFIT_ID);
                        $doc->exportField($this->FA_V);
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
