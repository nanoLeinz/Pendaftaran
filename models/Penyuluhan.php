<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for PENYULUHAN
 */
class Penyuluhan extends DbTable
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
    public $PENYULUHAN_ID;
    public $PENYULUHAN_TOPIK;
    public $PENYULUHAN_DATE;
    public $POSTER;
    public $KASET;
    public $CERAMAH;
    public $DEMO;
    public $PAMERAN;
    public $TRAINING;
    public $OTHER;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'PENYULUHAN';
        $this->TableName = 'PENYULUHAN';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[PENYULUHAN]";
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
        $this->ORG_UNIT_CODE = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // PENYULUHAN_ID
        $this->PENYULUHAN_ID = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_PENYULUHAN_ID', 'PENYULUHAN_ID', '[PENYULUHAN_ID]', '[PENYULUHAN_ID]', 200, 50, -1, false, '[PENYULUHAN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PENYULUHAN_ID->IsPrimaryKey = true; // Primary key field
        $this->PENYULUHAN_ID->Nullable = false; // NOT NULL field
        $this->PENYULUHAN_ID->Required = true; // Required field
        $this->PENYULUHAN_ID->Sortable = true; // Allow sort
        $this->PENYULUHAN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PENYULUHAN_ID->Param, "CustomMsg");
        $this->Fields['PENYULUHAN_ID'] = &$this->PENYULUHAN_ID;

        // PENYULUHAN_TOPIK
        $this->PENYULUHAN_TOPIK = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_PENYULUHAN_TOPIK', 'PENYULUHAN_TOPIK', '[PENYULUHAN_TOPIK]', 'CAST([PENYULUHAN_TOPIK] AS NVARCHAR)', 17, 1, -1, false, '[PENYULUHAN_TOPIK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PENYULUHAN_TOPIK->Sortable = true; // Allow sort
        $this->PENYULUHAN_TOPIK->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PENYULUHAN_TOPIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PENYULUHAN_TOPIK->Param, "CustomMsg");
        $this->Fields['PENYULUHAN_TOPIK'] = &$this->PENYULUHAN_TOPIK;

        // PENYULUHAN_DATE
        $this->PENYULUHAN_DATE = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_PENYULUHAN_DATE', 'PENYULUHAN_DATE', '[PENYULUHAN_DATE]', CastDateFieldForLike("[PENYULUHAN_DATE]", 0, "DB"), 135, 8, 0, false, '[PENYULUHAN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PENYULUHAN_DATE->Sortable = true; // Allow sort
        $this->PENYULUHAN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PENYULUHAN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PENYULUHAN_DATE->Param, "CustomMsg");
        $this->Fields['PENYULUHAN_DATE'] = &$this->PENYULUHAN_DATE;

        // POSTER
        $this->POSTER = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_POSTER', 'POSTER', '[POSTER]', '[POSTER]', 129, 1, -1, false, '[POSTER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POSTER->Sortable = true; // Allow sort
        $this->POSTER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POSTER->Param, "CustomMsg");
        $this->Fields['POSTER'] = &$this->POSTER;

        // KASET
        $this->KASET = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_KASET', 'KASET', '[KASET]', 'CAST([KASET] AS NVARCHAR)', 131, 8, -1, false, '[KASET]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KASET->Sortable = true; // Allow sort
        $this->KASET->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->KASET->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->KASET->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KASET->Param, "CustomMsg");
        $this->Fields['KASET'] = &$this->KASET;

        // CERAMAH
        $this->CERAMAH = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_CERAMAH', 'CERAMAH', '[CERAMAH]', 'CAST([CERAMAH] AS NVARCHAR)', 131, 8, -1, false, '[CERAMAH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CERAMAH->Sortable = true; // Allow sort
        $this->CERAMAH->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->CERAMAH->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->CERAMAH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CERAMAH->Param, "CustomMsg");
        $this->Fields['CERAMAH'] = &$this->CERAMAH;

        // DEMO
        $this->DEMO = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_DEMO', 'DEMO', '[DEMO]', 'CAST([DEMO] AS NVARCHAR)', 131, 8, -1, false, '[DEMO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DEMO->Sortable = true; // Allow sort
        $this->DEMO->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DEMO->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DEMO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DEMO->Param, "CustomMsg");
        $this->Fields['DEMO'] = &$this->DEMO;

        // PAMERAN
        $this->PAMERAN = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_PAMERAN', 'PAMERAN', '[PAMERAN]', 'CAST([PAMERAN] AS NVARCHAR)', 131, 8, -1, false, '[PAMERAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAMERAN->Sortable = true; // Allow sort
        $this->PAMERAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PAMERAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PAMERAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAMERAN->Param, "CustomMsg");
        $this->Fields['PAMERAN'] = &$this->PAMERAN;

        // TRAINING
        $this->TRAINING = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_TRAINING', 'TRAINING', '[TRAINING]', 'CAST([TRAINING] AS NVARCHAR)', 131, 8, -1, false, '[TRAINING]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TRAINING->Sortable = true; // Allow sort
        $this->TRAINING->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TRAINING->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TRAINING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TRAINING->Param, "CustomMsg");
        $this->Fields['TRAINING'] = &$this->TRAINING;

        // OTHER
        $this->OTHER = new DbField('PENYULUHAN', 'PENYULUHAN', 'x_OTHER', 'OTHER', '[OTHER]', 'CAST([OTHER] AS NVARCHAR)', 131, 8, -1, false, '[OTHER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER->Sortable = true; // Allow sort
        $this->OTHER->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->OTHER->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->OTHER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER->Param, "CustomMsg");
        $this->Fields['OTHER'] = &$this->OTHER;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[PENYULUHAN]";
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
            if (array_key_exists('PENYULUHAN_ID', $rs)) {
                AddFilter($where, QuotedName('PENYULUHAN_ID', $this->Dbid) . '=' . QuotedValue($rs['PENYULUHAN_ID'], $this->PENYULUHAN_ID->DataType, $this->Dbid));
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
        $this->PENYULUHAN_ID->DbValue = $row['PENYULUHAN_ID'];
        $this->PENYULUHAN_TOPIK->DbValue = $row['PENYULUHAN_TOPIK'];
        $this->PENYULUHAN_DATE->DbValue = $row['PENYULUHAN_DATE'];
        $this->POSTER->DbValue = $row['POSTER'];
        $this->KASET->DbValue = $row['KASET'];
        $this->CERAMAH->DbValue = $row['CERAMAH'];
        $this->DEMO->DbValue = $row['DEMO'];
        $this->PAMERAN->DbValue = $row['PAMERAN'];
        $this->TRAINING->DbValue = $row['TRAINING'];
        $this->OTHER->DbValue = $row['OTHER'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [PENYULUHAN_ID] = '@PENYULUHAN_ID@'";
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
        $val = $current ? $this->PENYULUHAN_ID->CurrentValue : $this->PENYULUHAN_ID->OldValue;
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
                $this->PENYULUHAN_ID->CurrentValue = $keys[1];
            } else {
                $this->PENYULUHAN_ID->OldValue = $keys[1];
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
            $val = array_key_exists('PENYULUHAN_ID', $row) ? $row['PENYULUHAN_ID'] : null;
        } else {
            $val = $this->PENYULUHAN_ID->OldValue !== null ? $this->PENYULUHAN_ID->OldValue : $this->PENYULUHAN_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@PENYULUHAN_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PenyuluhanList");
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
        if ($pageName == "PenyuluhanView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PenyuluhanEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PenyuluhanAdd") {
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
                return "PenyuluhanView";
            case Config("API_ADD_ACTION"):
                return "PenyuluhanAdd";
            case Config("API_EDIT_ACTION"):
                return "PenyuluhanEdit";
            case Config("API_DELETE_ACTION"):
                return "PenyuluhanDelete";
            case Config("API_LIST_ACTION"):
                return "PenyuluhanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PenyuluhanList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PenyuluhanView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PenyuluhanView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PenyuluhanAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PenyuluhanAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PenyuluhanEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PenyuluhanAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PenyuluhanDelete", $this->getUrlParm());
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
        $json .= ",PENYULUHAN_ID:" . JsonEncode($this->PENYULUHAN_ID->CurrentValue, "string");
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
        if ($this->PENYULUHAN_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->PENYULUHAN_ID->CurrentValue);
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
            if (($keyValue = Param("PENYULUHAN_ID") ?? Route("PENYULUHAN_ID")) !== null) {
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
                $this->PENYULUHAN_ID->CurrentValue = $key[1];
            } else {
                $this->PENYULUHAN_ID->OldValue = $key[1];
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
        $this->PENYULUHAN_ID->setDbValue($row['PENYULUHAN_ID']);
        $this->PENYULUHAN_TOPIK->setDbValue($row['PENYULUHAN_TOPIK']);
        $this->PENYULUHAN_DATE->setDbValue($row['PENYULUHAN_DATE']);
        $this->POSTER->setDbValue($row['POSTER']);
        $this->KASET->setDbValue($row['KASET']);
        $this->CERAMAH->setDbValue($row['CERAMAH']);
        $this->DEMO->setDbValue($row['DEMO']);
        $this->PAMERAN->setDbValue($row['PAMERAN']);
        $this->TRAINING->setDbValue($row['TRAINING']);
        $this->OTHER->setDbValue($row['OTHER']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // PENYULUHAN_ID

        // PENYULUHAN_TOPIK

        // PENYULUHAN_DATE

        // POSTER

        // KASET

        // CERAMAH

        // DEMO

        // PAMERAN

        // TRAINING

        // OTHER

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // PENYULUHAN_ID
        $this->PENYULUHAN_ID->ViewValue = $this->PENYULUHAN_ID->CurrentValue;
        $this->PENYULUHAN_ID->ViewCustomAttributes = "";

        // PENYULUHAN_TOPIK
        $this->PENYULUHAN_TOPIK->ViewValue = $this->PENYULUHAN_TOPIK->CurrentValue;
        $this->PENYULUHAN_TOPIK->ViewValue = FormatNumber($this->PENYULUHAN_TOPIK->ViewValue, 0, -2, -2, -2);
        $this->PENYULUHAN_TOPIK->ViewCustomAttributes = "";

        // PENYULUHAN_DATE
        $this->PENYULUHAN_DATE->ViewValue = $this->PENYULUHAN_DATE->CurrentValue;
        $this->PENYULUHAN_DATE->ViewValue = FormatDateTime($this->PENYULUHAN_DATE->ViewValue, 0);
        $this->PENYULUHAN_DATE->ViewCustomAttributes = "";

        // POSTER
        $this->POSTER->ViewValue = $this->POSTER->CurrentValue;
        $this->POSTER->ViewCustomAttributes = "";

        // KASET
        $this->KASET->ViewValue = $this->KASET->CurrentValue;
        $this->KASET->ViewValue = FormatNumber($this->KASET->ViewValue, 2, -2, -2, -2);
        $this->KASET->ViewCustomAttributes = "";

        // CERAMAH
        $this->CERAMAH->ViewValue = $this->CERAMAH->CurrentValue;
        $this->CERAMAH->ViewValue = FormatNumber($this->CERAMAH->ViewValue, 2, -2, -2, -2);
        $this->CERAMAH->ViewCustomAttributes = "";

        // DEMO
        $this->DEMO->ViewValue = $this->DEMO->CurrentValue;
        $this->DEMO->ViewValue = FormatNumber($this->DEMO->ViewValue, 2, -2, -2, -2);
        $this->DEMO->ViewCustomAttributes = "";

        // PAMERAN
        $this->PAMERAN->ViewValue = $this->PAMERAN->CurrentValue;
        $this->PAMERAN->ViewValue = FormatNumber($this->PAMERAN->ViewValue, 2, -2, -2, -2);
        $this->PAMERAN->ViewCustomAttributes = "";

        // TRAINING
        $this->TRAINING->ViewValue = $this->TRAINING->CurrentValue;
        $this->TRAINING->ViewValue = FormatNumber($this->TRAINING->ViewValue, 2, -2, -2, -2);
        $this->TRAINING->ViewCustomAttributes = "";

        // OTHER
        $this->OTHER->ViewValue = $this->OTHER->CurrentValue;
        $this->OTHER->ViewValue = FormatNumber($this->OTHER->ViewValue, 2, -2, -2, -2);
        $this->OTHER->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // PENYULUHAN_ID
        $this->PENYULUHAN_ID->LinkCustomAttributes = "";
        $this->PENYULUHAN_ID->HrefValue = "";
        $this->PENYULUHAN_ID->TooltipValue = "";

        // PENYULUHAN_TOPIK
        $this->PENYULUHAN_TOPIK->LinkCustomAttributes = "";
        $this->PENYULUHAN_TOPIK->HrefValue = "";
        $this->PENYULUHAN_TOPIK->TooltipValue = "";

        // PENYULUHAN_DATE
        $this->PENYULUHAN_DATE->LinkCustomAttributes = "";
        $this->PENYULUHAN_DATE->HrefValue = "";
        $this->PENYULUHAN_DATE->TooltipValue = "";

        // POSTER
        $this->POSTER->LinkCustomAttributes = "";
        $this->POSTER->HrefValue = "";
        $this->POSTER->TooltipValue = "";

        // KASET
        $this->KASET->LinkCustomAttributes = "";
        $this->KASET->HrefValue = "";
        $this->KASET->TooltipValue = "";

        // CERAMAH
        $this->CERAMAH->LinkCustomAttributes = "";
        $this->CERAMAH->HrefValue = "";
        $this->CERAMAH->TooltipValue = "";

        // DEMO
        $this->DEMO->LinkCustomAttributes = "";
        $this->DEMO->HrefValue = "";
        $this->DEMO->TooltipValue = "";

        // PAMERAN
        $this->PAMERAN->LinkCustomAttributes = "";
        $this->PAMERAN->HrefValue = "";
        $this->PAMERAN->TooltipValue = "";

        // TRAINING
        $this->TRAINING->LinkCustomAttributes = "";
        $this->TRAINING->HrefValue = "";
        $this->TRAINING->TooltipValue = "";

        // OTHER
        $this->OTHER->LinkCustomAttributes = "";
        $this->OTHER->HrefValue = "";
        $this->OTHER->TooltipValue = "";

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

        // PENYULUHAN_ID
        $this->PENYULUHAN_ID->EditAttrs["class"] = "form-control";
        $this->PENYULUHAN_ID->EditCustomAttributes = "";
        if (!$this->PENYULUHAN_ID->Raw) {
            $this->PENYULUHAN_ID->CurrentValue = HtmlDecode($this->PENYULUHAN_ID->CurrentValue);
        }
        $this->PENYULUHAN_ID->EditValue = $this->PENYULUHAN_ID->CurrentValue;
        $this->PENYULUHAN_ID->PlaceHolder = RemoveHtml($this->PENYULUHAN_ID->caption());

        // PENYULUHAN_TOPIK
        $this->PENYULUHAN_TOPIK->EditAttrs["class"] = "form-control";
        $this->PENYULUHAN_TOPIK->EditCustomAttributes = "";
        $this->PENYULUHAN_TOPIK->EditValue = $this->PENYULUHAN_TOPIK->CurrentValue;
        $this->PENYULUHAN_TOPIK->PlaceHolder = RemoveHtml($this->PENYULUHAN_TOPIK->caption());

        // PENYULUHAN_DATE
        $this->PENYULUHAN_DATE->EditAttrs["class"] = "form-control";
        $this->PENYULUHAN_DATE->EditCustomAttributes = "";
        $this->PENYULUHAN_DATE->EditValue = FormatDateTime($this->PENYULUHAN_DATE->CurrentValue, 8);
        $this->PENYULUHAN_DATE->PlaceHolder = RemoveHtml($this->PENYULUHAN_DATE->caption());

        // POSTER
        $this->POSTER->EditAttrs["class"] = "form-control";
        $this->POSTER->EditCustomAttributes = "";
        if (!$this->POSTER->Raw) {
            $this->POSTER->CurrentValue = HtmlDecode($this->POSTER->CurrentValue);
        }
        $this->POSTER->EditValue = $this->POSTER->CurrentValue;
        $this->POSTER->PlaceHolder = RemoveHtml($this->POSTER->caption());

        // KASET
        $this->KASET->EditAttrs["class"] = "form-control";
        $this->KASET->EditCustomAttributes = "";
        $this->KASET->EditValue = $this->KASET->CurrentValue;
        $this->KASET->PlaceHolder = RemoveHtml($this->KASET->caption());
        if (strval($this->KASET->EditValue) != "" && is_numeric($this->KASET->EditValue)) {
            $this->KASET->EditValue = FormatNumber($this->KASET->EditValue, -2, -2, -2, -2);
        }

        // CERAMAH
        $this->CERAMAH->EditAttrs["class"] = "form-control";
        $this->CERAMAH->EditCustomAttributes = "";
        $this->CERAMAH->EditValue = $this->CERAMAH->CurrentValue;
        $this->CERAMAH->PlaceHolder = RemoveHtml($this->CERAMAH->caption());
        if (strval($this->CERAMAH->EditValue) != "" && is_numeric($this->CERAMAH->EditValue)) {
            $this->CERAMAH->EditValue = FormatNumber($this->CERAMAH->EditValue, -2, -2, -2, -2);
        }

        // DEMO
        $this->DEMO->EditAttrs["class"] = "form-control";
        $this->DEMO->EditCustomAttributes = "";
        $this->DEMO->EditValue = $this->DEMO->CurrentValue;
        $this->DEMO->PlaceHolder = RemoveHtml($this->DEMO->caption());
        if (strval($this->DEMO->EditValue) != "" && is_numeric($this->DEMO->EditValue)) {
            $this->DEMO->EditValue = FormatNumber($this->DEMO->EditValue, -2, -2, -2, -2);
        }

        // PAMERAN
        $this->PAMERAN->EditAttrs["class"] = "form-control";
        $this->PAMERAN->EditCustomAttributes = "";
        $this->PAMERAN->EditValue = $this->PAMERAN->CurrentValue;
        $this->PAMERAN->PlaceHolder = RemoveHtml($this->PAMERAN->caption());
        if (strval($this->PAMERAN->EditValue) != "" && is_numeric($this->PAMERAN->EditValue)) {
            $this->PAMERAN->EditValue = FormatNumber($this->PAMERAN->EditValue, -2, -2, -2, -2);
        }

        // TRAINING
        $this->TRAINING->EditAttrs["class"] = "form-control";
        $this->TRAINING->EditCustomAttributes = "";
        $this->TRAINING->EditValue = $this->TRAINING->CurrentValue;
        $this->TRAINING->PlaceHolder = RemoveHtml($this->TRAINING->caption());
        if (strval($this->TRAINING->EditValue) != "" && is_numeric($this->TRAINING->EditValue)) {
            $this->TRAINING->EditValue = FormatNumber($this->TRAINING->EditValue, -2, -2, -2, -2);
        }

        // OTHER
        $this->OTHER->EditAttrs["class"] = "form-control";
        $this->OTHER->EditCustomAttributes = "";
        $this->OTHER->EditValue = $this->OTHER->CurrentValue;
        $this->OTHER->PlaceHolder = RemoveHtml($this->OTHER->caption());
        if (strval($this->OTHER->EditValue) != "" && is_numeric($this->OTHER->EditValue)) {
            $this->OTHER->EditValue = FormatNumber($this->OTHER->EditValue, -2, -2, -2, -2);
        }

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
                    $doc->exportCaption($this->PENYULUHAN_ID);
                    $doc->exportCaption($this->PENYULUHAN_TOPIK);
                    $doc->exportCaption($this->PENYULUHAN_DATE);
                    $doc->exportCaption($this->POSTER);
                    $doc->exportCaption($this->KASET);
                    $doc->exportCaption($this->CERAMAH);
                    $doc->exportCaption($this->DEMO);
                    $doc->exportCaption($this->PAMERAN);
                    $doc->exportCaption($this->TRAINING);
                    $doc->exportCaption($this->OTHER);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->PENYULUHAN_ID);
                    $doc->exportCaption($this->PENYULUHAN_TOPIK);
                    $doc->exportCaption($this->PENYULUHAN_DATE);
                    $doc->exportCaption($this->POSTER);
                    $doc->exportCaption($this->KASET);
                    $doc->exportCaption($this->CERAMAH);
                    $doc->exportCaption($this->DEMO);
                    $doc->exportCaption($this->PAMERAN);
                    $doc->exportCaption($this->TRAINING);
                    $doc->exportCaption($this->OTHER);
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
                        $doc->exportField($this->PENYULUHAN_ID);
                        $doc->exportField($this->PENYULUHAN_TOPIK);
                        $doc->exportField($this->PENYULUHAN_DATE);
                        $doc->exportField($this->POSTER);
                        $doc->exportField($this->KASET);
                        $doc->exportField($this->CERAMAH);
                        $doc->exportField($this->DEMO);
                        $doc->exportField($this->PAMERAN);
                        $doc->exportField($this->TRAINING);
                        $doc->exportField($this->OTHER);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->PENYULUHAN_ID);
                        $doc->exportField($this->PENYULUHAN_TOPIK);
                        $doc->exportField($this->PENYULUHAN_DATE);
                        $doc->exportField($this->POSTER);
                        $doc->exportField($this->KASET);
                        $doc->exportField($this->CERAMAH);
                        $doc->exportField($this->DEMO);
                        $doc->exportField($this->PAMERAN);
                        $doc->exportField($this->TRAINING);
                        $doc->exportField($this->OTHER);
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
