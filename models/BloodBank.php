<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for BLOOD_BANK
 */
class BloodBank extends DbTable
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
    public $BLOOD_BANK;
    public $BLOOD_TYPE_ID;
    public $BLOOD_CON;
    public $QUANTITY;
    public $MEASURE_ID;
    public $DONOR_DATE;
    public $EXPIRY_DATE;
    public $DONOR;
    public $DONOR_ADDRESS;
    public $DESCRIPTION;
    public $DONOR_TYPE;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'BLOOD_BANK';
        $this->TableName = 'BLOOD_BANK';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[BLOOD_BANK]";
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
        $this->ORG_UNIT_CODE = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // BLOOD_BANK
        $this->BLOOD_BANK = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_BLOOD_BANK', 'BLOOD_BANK', '[BLOOD_BANK]', '[BLOOD_BANK]', 200, 50, -1, false, '[BLOOD_BANK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BLOOD_BANK->IsPrimaryKey = true; // Primary key field
        $this->BLOOD_BANK->Nullable = false; // NOT NULL field
        $this->BLOOD_BANK->Required = true; // Required field
        $this->BLOOD_BANK->Sortable = true; // Allow sort
        $this->BLOOD_BANK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BLOOD_BANK->Param, "CustomMsg");
        $this->Fields['BLOOD_BANK'] = &$this->BLOOD_BANK;

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_BLOOD_TYPE_ID', 'BLOOD_TYPE_ID', '[BLOOD_TYPE_ID]', 'CAST([BLOOD_TYPE_ID] AS NVARCHAR)', 17, 1, -1, false, '[BLOOD_TYPE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BLOOD_TYPE_ID->Sortable = true; // Allow sort
        $this->BLOOD_TYPE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BLOOD_TYPE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BLOOD_TYPE_ID->Param, "CustomMsg");
        $this->Fields['BLOOD_TYPE_ID'] = &$this->BLOOD_TYPE_ID;

        // BLOOD_CON
        $this->BLOOD_CON = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_BLOOD_CON', 'BLOOD_CON', '[BLOOD_CON]', 'CAST([BLOOD_CON] AS NVARCHAR)', 2, 2, -1, false, '[BLOOD_CON]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BLOOD_CON->Sortable = true; // Allow sort
        $this->BLOOD_CON->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BLOOD_CON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BLOOD_CON->Param, "CustomMsg");
        $this->Fields['BLOOD_CON'] = &$this->BLOOD_CON;

        // QUANTITY
        $this->QUANTITY = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_QUANTITY', 'QUANTITY', '[QUANTITY]', 'CAST([QUANTITY] AS NVARCHAR)', 131, 8, -1, false, '[QUANTITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->QUANTITY->Sortable = true; // Allow sort
        $this->QUANTITY->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->QUANTITY->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->QUANTITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->QUANTITY->Param, "CustomMsg");
        $this->Fields['QUANTITY'] = &$this->QUANTITY;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', '[MEASURE_ID]', 200, 50, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // DONOR_DATE
        $this->DONOR_DATE = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_DONOR_DATE', 'DONOR_DATE', '[DONOR_DATE]', CastDateFieldForLike("[DONOR_DATE]", 0, "DB"), 135, 8, 0, false, '[DONOR_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DONOR_DATE->Sortable = true; // Allow sort
        $this->DONOR_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DONOR_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DONOR_DATE->Param, "CustomMsg");
        $this->Fields['DONOR_DATE'] = &$this->DONOR_DATE;

        // EXPIRY_DATE
        $this->EXPIRY_DATE = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_EXPIRY_DATE', 'EXPIRY_DATE', '[EXPIRY_DATE]', CastDateFieldForLike("[EXPIRY_DATE]", 0, "DB"), 135, 8, 0, false, '[EXPIRY_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXPIRY_DATE->Sortable = true; // Allow sort
        $this->EXPIRY_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXPIRY_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXPIRY_DATE->Param, "CustomMsg");
        $this->Fields['EXPIRY_DATE'] = &$this->EXPIRY_DATE;

        // DONOR
        $this->DONOR = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_DONOR', 'DONOR', '[DONOR]', '[DONOR]', 200, 100, -1, false, '[DONOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DONOR->Sortable = true; // Allow sort
        $this->DONOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DONOR->Param, "CustomMsg");
        $this->Fields['DONOR'] = &$this->DONOR;

        // DONOR_ADDRESS
        $this->DONOR_ADDRESS = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_DONOR_ADDRESS', 'DONOR_ADDRESS', '[DONOR_ADDRESS]', '[DONOR_ADDRESS]', 200, 255, -1, false, '[DONOR_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DONOR_ADDRESS->Sortable = true; // Allow sort
        $this->DONOR_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DONOR_ADDRESS->Param, "CustomMsg");
        $this->Fields['DONOR_ADDRESS'] = &$this->DONOR_ADDRESS;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // DONOR_TYPE
        $this->DONOR_TYPE = new DbField('BLOOD_BANK', 'BLOOD_BANK', 'x_DONOR_TYPE', 'DONOR_TYPE', '[DONOR_TYPE]', 'CAST([DONOR_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[DONOR_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DONOR_TYPE->Sortable = true; // Allow sort
        $this->DONOR_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DONOR_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DONOR_TYPE->Param, "CustomMsg");
        $this->Fields['DONOR_TYPE'] = &$this->DONOR_TYPE;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[BLOOD_BANK]";
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
            if (array_key_exists('BLOOD_BANK', $rs)) {
                AddFilter($where, QuotedName('BLOOD_BANK', $this->Dbid) . '=' . QuotedValue($rs['BLOOD_BANK'], $this->BLOOD_BANK->DataType, $this->Dbid));
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
        $this->BLOOD_BANK->DbValue = $row['BLOOD_BANK'];
        $this->BLOOD_TYPE_ID->DbValue = $row['BLOOD_TYPE_ID'];
        $this->BLOOD_CON->DbValue = $row['BLOOD_CON'];
        $this->QUANTITY->DbValue = $row['QUANTITY'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->DONOR_DATE->DbValue = $row['DONOR_DATE'];
        $this->EXPIRY_DATE->DbValue = $row['EXPIRY_DATE'];
        $this->DONOR->DbValue = $row['DONOR'];
        $this->DONOR_ADDRESS->DbValue = $row['DONOR_ADDRESS'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->DONOR_TYPE->DbValue = $row['DONOR_TYPE'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [BLOOD_BANK] = '@BLOOD_BANK@'";
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
        $val = $current ? $this->BLOOD_BANK->CurrentValue : $this->BLOOD_BANK->OldValue;
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
                $this->BLOOD_BANK->CurrentValue = $keys[1];
            } else {
                $this->BLOOD_BANK->OldValue = $keys[1];
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
            $val = array_key_exists('BLOOD_BANK', $row) ? $row['BLOOD_BANK'] : null;
        } else {
            $val = $this->BLOOD_BANK->OldValue !== null ? $this->BLOOD_BANK->OldValue : $this->BLOOD_BANK->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@BLOOD_BANK@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("BloodBankList");
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
        if ($pageName == "BloodBankView") {
            return $Language->phrase("View");
        } elseif ($pageName == "BloodBankEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "BloodBankAdd") {
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
                return "BloodBankView";
            case Config("API_ADD_ACTION"):
                return "BloodBankAdd";
            case Config("API_EDIT_ACTION"):
                return "BloodBankEdit";
            case Config("API_DELETE_ACTION"):
                return "BloodBankDelete";
            case Config("API_LIST_ACTION"):
                return "BloodBankList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "BloodBankList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BloodBankView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("BloodBankView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BloodBankAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "BloodBankAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BloodBankEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("BloodBankAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("BloodBankDelete", $this->getUrlParm());
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
        $json .= ",BLOOD_BANK:" . JsonEncode($this->BLOOD_BANK->CurrentValue, "string");
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
        if ($this->BLOOD_BANK->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BLOOD_BANK->CurrentValue);
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
            if (($keyValue = Param("BLOOD_BANK") ?? Route("BLOOD_BANK")) !== null) {
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
                $this->BLOOD_BANK->CurrentValue = $key[1];
            } else {
                $this->BLOOD_BANK->OldValue = $key[1];
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
        $this->BLOOD_BANK->setDbValue($row['BLOOD_BANK']);
        $this->BLOOD_TYPE_ID->setDbValue($row['BLOOD_TYPE_ID']);
        $this->BLOOD_CON->setDbValue($row['BLOOD_CON']);
        $this->QUANTITY->setDbValue($row['QUANTITY']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->DONOR_DATE->setDbValue($row['DONOR_DATE']);
        $this->EXPIRY_DATE->setDbValue($row['EXPIRY_DATE']);
        $this->DONOR->setDbValue($row['DONOR']);
        $this->DONOR_ADDRESS->setDbValue($row['DONOR_ADDRESS']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->DONOR_TYPE->setDbValue($row['DONOR_TYPE']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // BLOOD_BANK

        // BLOOD_TYPE_ID

        // BLOOD_CON

        // QUANTITY

        // MEASURE_ID

        // DONOR_DATE

        // EXPIRY_DATE

        // DONOR

        // DONOR_ADDRESS

        // DESCRIPTION

        // DONOR_TYPE

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // BLOOD_BANK
        $this->BLOOD_BANK->ViewValue = $this->BLOOD_BANK->CurrentValue;
        $this->BLOOD_BANK->ViewCustomAttributes = "";

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->CurrentValue;
        $this->BLOOD_TYPE_ID->ViewValue = FormatNumber($this->BLOOD_TYPE_ID->ViewValue, 0, -2, -2, -2);
        $this->BLOOD_TYPE_ID->ViewCustomAttributes = "";

        // BLOOD_CON
        $this->BLOOD_CON->ViewValue = $this->BLOOD_CON->CurrentValue;
        $this->BLOOD_CON->ViewValue = FormatNumber($this->BLOOD_CON->ViewValue, 0, -2, -2, -2);
        $this->BLOOD_CON->ViewCustomAttributes = "";

        // QUANTITY
        $this->QUANTITY->ViewValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->ViewValue = FormatNumber($this->QUANTITY->ViewValue, 2, -2, -2, -2);
        $this->QUANTITY->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // DONOR_DATE
        $this->DONOR_DATE->ViewValue = $this->DONOR_DATE->CurrentValue;
        $this->DONOR_DATE->ViewValue = FormatDateTime($this->DONOR_DATE->ViewValue, 0);
        $this->DONOR_DATE->ViewCustomAttributes = "";

        // EXPIRY_DATE
        $this->EXPIRY_DATE->ViewValue = $this->EXPIRY_DATE->CurrentValue;
        $this->EXPIRY_DATE->ViewValue = FormatDateTime($this->EXPIRY_DATE->ViewValue, 0);
        $this->EXPIRY_DATE->ViewCustomAttributes = "";

        // DONOR
        $this->DONOR->ViewValue = $this->DONOR->CurrentValue;
        $this->DONOR->ViewCustomAttributes = "";

        // DONOR_ADDRESS
        $this->DONOR_ADDRESS->ViewValue = $this->DONOR_ADDRESS->CurrentValue;
        $this->DONOR_ADDRESS->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // DONOR_TYPE
        $this->DONOR_TYPE->ViewValue = $this->DONOR_TYPE->CurrentValue;
        $this->DONOR_TYPE->ViewValue = FormatNumber($this->DONOR_TYPE->ViewValue, 0, -2, -2, -2);
        $this->DONOR_TYPE->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // BLOOD_BANK
        $this->BLOOD_BANK->LinkCustomAttributes = "";
        $this->BLOOD_BANK->HrefValue = "";
        $this->BLOOD_BANK->TooltipValue = "";

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID->LinkCustomAttributes = "";
        $this->BLOOD_TYPE_ID->HrefValue = "";
        $this->BLOOD_TYPE_ID->TooltipValue = "";

        // BLOOD_CON
        $this->BLOOD_CON->LinkCustomAttributes = "";
        $this->BLOOD_CON->HrefValue = "";
        $this->BLOOD_CON->TooltipValue = "";

        // QUANTITY
        $this->QUANTITY->LinkCustomAttributes = "";
        $this->QUANTITY->HrefValue = "";
        $this->QUANTITY->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // DONOR_DATE
        $this->DONOR_DATE->LinkCustomAttributes = "";
        $this->DONOR_DATE->HrefValue = "";
        $this->DONOR_DATE->TooltipValue = "";

        // EXPIRY_DATE
        $this->EXPIRY_DATE->LinkCustomAttributes = "";
        $this->EXPIRY_DATE->HrefValue = "";
        $this->EXPIRY_DATE->TooltipValue = "";

        // DONOR
        $this->DONOR->LinkCustomAttributes = "";
        $this->DONOR->HrefValue = "";
        $this->DONOR->TooltipValue = "";

        // DONOR_ADDRESS
        $this->DONOR_ADDRESS->LinkCustomAttributes = "";
        $this->DONOR_ADDRESS->HrefValue = "";
        $this->DONOR_ADDRESS->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // DONOR_TYPE
        $this->DONOR_TYPE->LinkCustomAttributes = "";
        $this->DONOR_TYPE->HrefValue = "";
        $this->DONOR_TYPE->TooltipValue = "";

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

        // BLOOD_BANK
        $this->BLOOD_BANK->EditAttrs["class"] = "form-control";
        $this->BLOOD_BANK->EditCustomAttributes = "";
        if (!$this->BLOOD_BANK->Raw) {
            $this->BLOOD_BANK->CurrentValue = HtmlDecode($this->BLOOD_BANK->CurrentValue);
        }
        $this->BLOOD_BANK->EditValue = $this->BLOOD_BANK->CurrentValue;
        $this->BLOOD_BANK->PlaceHolder = RemoveHtml($this->BLOOD_BANK->caption());

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID->EditAttrs["class"] = "form-control";
        $this->BLOOD_TYPE_ID->EditCustomAttributes = "";
        $this->BLOOD_TYPE_ID->EditValue = $this->BLOOD_TYPE_ID->CurrentValue;
        $this->BLOOD_TYPE_ID->PlaceHolder = RemoveHtml($this->BLOOD_TYPE_ID->caption());

        // BLOOD_CON
        $this->BLOOD_CON->EditAttrs["class"] = "form-control";
        $this->BLOOD_CON->EditCustomAttributes = "";
        $this->BLOOD_CON->EditValue = $this->BLOOD_CON->CurrentValue;
        $this->BLOOD_CON->PlaceHolder = RemoveHtml($this->BLOOD_CON->caption());

        // QUANTITY
        $this->QUANTITY->EditAttrs["class"] = "form-control";
        $this->QUANTITY->EditCustomAttributes = "";
        $this->QUANTITY->EditValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->PlaceHolder = RemoveHtml($this->QUANTITY->caption());
        if (strval($this->QUANTITY->EditValue) != "" && is_numeric($this->QUANTITY->EditValue)) {
            $this->QUANTITY->EditValue = FormatNumber($this->QUANTITY->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        if (!$this->MEASURE_ID->Raw) {
            $this->MEASURE_ID->CurrentValue = HtmlDecode($this->MEASURE_ID->CurrentValue);
        }
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // DONOR_DATE
        $this->DONOR_DATE->EditAttrs["class"] = "form-control";
        $this->DONOR_DATE->EditCustomAttributes = "";
        $this->DONOR_DATE->EditValue = FormatDateTime($this->DONOR_DATE->CurrentValue, 8);
        $this->DONOR_DATE->PlaceHolder = RemoveHtml($this->DONOR_DATE->caption());

        // EXPIRY_DATE
        $this->EXPIRY_DATE->EditAttrs["class"] = "form-control";
        $this->EXPIRY_DATE->EditCustomAttributes = "";
        $this->EXPIRY_DATE->EditValue = FormatDateTime($this->EXPIRY_DATE->CurrentValue, 8);
        $this->EXPIRY_DATE->PlaceHolder = RemoveHtml($this->EXPIRY_DATE->caption());

        // DONOR
        $this->DONOR->EditAttrs["class"] = "form-control";
        $this->DONOR->EditCustomAttributes = "";
        if (!$this->DONOR->Raw) {
            $this->DONOR->CurrentValue = HtmlDecode($this->DONOR->CurrentValue);
        }
        $this->DONOR->EditValue = $this->DONOR->CurrentValue;
        $this->DONOR->PlaceHolder = RemoveHtml($this->DONOR->caption());

        // DONOR_ADDRESS
        $this->DONOR_ADDRESS->EditAttrs["class"] = "form-control";
        $this->DONOR_ADDRESS->EditCustomAttributes = "";
        if (!$this->DONOR_ADDRESS->Raw) {
            $this->DONOR_ADDRESS->CurrentValue = HtmlDecode($this->DONOR_ADDRESS->CurrentValue);
        }
        $this->DONOR_ADDRESS->EditValue = $this->DONOR_ADDRESS->CurrentValue;
        $this->DONOR_ADDRESS->PlaceHolder = RemoveHtml($this->DONOR_ADDRESS->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // DONOR_TYPE
        $this->DONOR_TYPE->EditAttrs["class"] = "form-control";
        $this->DONOR_TYPE->EditCustomAttributes = "";
        $this->DONOR_TYPE->EditValue = $this->DONOR_TYPE->CurrentValue;
        $this->DONOR_TYPE->PlaceHolder = RemoveHtml($this->DONOR_TYPE->caption());

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
                    $doc->exportCaption($this->BLOOD_BANK);
                    $doc->exportCaption($this->BLOOD_TYPE_ID);
                    $doc->exportCaption($this->BLOOD_CON);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->DONOR_DATE);
                    $doc->exportCaption($this->EXPIRY_DATE);
                    $doc->exportCaption($this->DONOR);
                    $doc->exportCaption($this->DONOR_ADDRESS);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DONOR_TYPE);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->BLOOD_BANK);
                    $doc->exportCaption($this->BLOOD_TYPE_ID);
                    $doc->exportCaption($this->BLOOD_CON);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->DONOR_DATE);
                    $doc->exportCaption($this->EXPIRY_DATE);
                    $doc->exportCaption($this->DONOR);
                    $doc->exportCaption($this->DONOR_ADDRESS);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DONOR_TYPE);
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
                        $doc->exportField($this->BLOOD_BANK);
                        $doc->exportField($this->BLOOD_TYPE_ID);
                        $doc->exportField($this->BLOOD_CON);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->DONOR_DATE);
                        $doc->exportField($this->EXPIRY_DATE);
                        $doc->exportField($this->DONOR);
                        $doc->exportField($this->DONOR_ADDRESS);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DONOR_TYPE);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->BLOOD_BANK);
                        $doc->exportField($this->BLOOD_TYPE_ID);
                        $doc->exportField($this->BLOOD_CON);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->DONOR_DATE);
                        $doc->exportField($this->EXPIRY_DATE);
                        $doc->exportField($this->DONOR);
                        $doc->exportField($this->DONOR_ADDRESS);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DONOR_TYPE);
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
