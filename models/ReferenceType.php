<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for REFERENCE_TYPE
 */
class ReferenceType extends DbTable
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
    public $REF_TYPE;
    public $REFTYPE;
    public $DISPLAY;
    public $REF_CODE;
    public $REF_BATCH;
    public $REF_DETAIL;
    public $REF_PRINT;
    public $REF_PRINT2;
    public $REF_PRINT3;
    public $TEMPLATES;
    public $TERBILANG;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $DOCS_TYPE;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'REFERENCE_TYPE';
        $this->TableName = 'REFERENCE_TYPE';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[REFERENCE_TYPE]";
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

        // REF_TYPE
        $this->REF_TYPE = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_REF_TYPE', 'REF_TYPE', '[REF_TYPE]', 'CAST([REF_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[REF_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_TYPE->IsPrimaryKey = true; // Primary key field
        $this->REF_TYPE->Nullable = false; // NOT NULL field
        $this->REF_TYPE->Required = true; // Required field
        $this->REF_TYPE->Sortable = true; // Allow sort
        $this->REF_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REF_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_TYPE->Param, "CustomMsg");
        $this->Fields['REF_TYPE'] = &$this->REF_TYPE;

        // REFTYPE
        $this->REFTYPE = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_REFTYPE', 'REFTYPE', '[REFTYPE]', '[REFTYPE]', 200, 100, -1, false, '[REFTYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REFTYPE->Sortable = true; // Allow sort
        $this->REFTYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REFTYPE->Param, "CustomMsg");
        $this->Fields['REFTYPE'] = &$this->REFTYPE;

        // DISPLAY
        $this->DISPLAY = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_DISPLAY', 'DISPLAY', '[DISPLAY]', '[DISPLAY]', 200, 50, -1, false, '[DISPLAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISPLAY->Sortable = true; // Allow sort
        $this->DISPLAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISPLAY->Param, "CustomMsg");
        $this->Fields['DISPLAY'] = &$this->DISPLAY;

        // REF_CODE
        $this->REF_CODE = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_REF_CODE', 'REF_CODE', '[REF_CODE]', '[REF_CODE]', 200, 15, -1, false, '[REF_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_CODE->Sortable = true; // Allow sort
        $this->REF_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_CODE->Param, "CustomMsg");
        $this->Fields['REF_CODE'] = &$this->REF_CODE;

        // REF_BATCH
        $this->REF_BATCH = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_REF_BATCH', 'REF_BATCH', '[REF_BATCH]', '[REF_BATCH]', 200, 5, -1, false, '[REF_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_BATCH->Sortable = true; // Allow sort
        $this->REF_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_BATCH->Param, "CustomMsg");
        $this->Fields['REF_BATCH'] = &$this->REF_BATCH;

        // REF_DETAIL
        $this->REF_DETAIL = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_REF_DETAIL', 'REF_DETAIL', '[REF_DETAIL]', '[REF_DETAIL]', 200, 255, -1, false, '[REF_DETAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_DETAIL->Sortable = true; // Allow sort
        $this->REF_DETAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_DETAIL->Param, "CustomMsg");
        $this->Fields['REF_DETAIL'] = &$this->REF_DETAIL;

        // REF_PRINT
        $this->REF_PRINT = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_REF_PRINT', 'REF_PRINT', '[REF_PRINT]', '[REF_PRINT]', 200, 255, -1, false, '[REF_PRINT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_PRINT->Sortable = true; // Allow sort
        $this->REF_PRINT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_PRINT->Param, "CustomMsg");
        $this->Fields['REF_PRINT'] = &$this->REF_PRINT;

        // REF_PRINT2
        $this->REF_PRINT2 = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_REF_PRINT2', 'REF_PRINT2', '[REF_PRINT2]', '[REF_PRINT2]', 200, 255, -1, false, '[REF_PRINT2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_PRINT2->Sortable = true; // Allow sort
        $this->REF_PRINT2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_PRINT2->Param, "CustomMsg");
        $this->Fields['REF_PRINT2'] = &$this->REF_PRINT2;

        // REF_PRINT3
        $this->REF_PRINT3 = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_REF_PRINT3', 'REF_PRINT3', '[REF_PRINT3]', '[REF_PRINT3]', 200, 255, -1, false, '[REF_PRINT3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_PRINT3->Sortable = true; // Allow sort
        $this->REF_PRINT3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_PRINT3->Param, "CustomMsg");
        $this->Fields['REF_PRINT3'] = &$this->REF_PRINT3;

        // TEMPLATES
        $this->TEMPLATES = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_TEMPLATES', 'TEMPLATES', '[TEMPLATES]', '[TEMPLATES]', 200, 255, -1, false, '[TEMPLATES]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TEMPLATES->Sortable = true; // Allow sort
        $this->TEMPLATES->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TEMPLATES->Param, "CustomMsg");
        $this->Fields['TEMPLATES'] = &$this->TEMPLATES;

        // TERBILANG
        $this->TERBILANG = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_TERBILANG', 'TERBILANG', '[TERBILANG]', '[TERBILANG]', 200, 1, -1, false, '[TERBILANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERBILANG->Sortable = true; // Allow sort
        $this->TERBILANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERBILANG->Param, "CustomMsg");
        $this->Fields['TERBILANG'] = &$this->TERBILANG;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // DOCS_TYPE
        $this->DOCS_TYPE = new DbField('REFERENCE_TYPE', 'REFERENCE_TYPE', 'x_DOCS_TYPE', 'DOCS_TYPE', '[DOCS_TYPE]', 'CAST([DOCS_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[DOCS_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCS_TYPE->Sortable = true; // Allow sort
        $this->DOCS_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DOCS_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCS_TYPE->Param, "CustomMsg");
        $this->Fields['DOCS_TYPE'] = &$this->DOCS_TYPE;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[REFERENCE_TYPE]";
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
            if (array_key_exists('REF_TYPE', $rs)) {
                AddFilter($where, QuotedName('REF_TYPE', $this->Dbid) . '=' . QuotedValue($rs['REF_TYPE'], $this->REF_TYPE->DataType, $this->Dbid));
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
        $this->REF_TYPE->DbValue = $row['REF_TYPE'];
        $this->REFTYPE->DbValue = $row['REFTYPE'];
        $this->DISPLAY->DbValue = $row['DISPLAY'];
        $this->REF_CODE->DbValue = $row['REF_CODE'];
        $this->REF_BATCH->DbValue = $row['REF_BATCH'];
        $this->REF_DETAIL->DbValue = $row['REF_DETAIL'];
        $this->REF_PRINT->DbValue = $row['REF_PRINT'];
        $this->REF_PRINT2->DbValue = $row['REF_PRINT2'];
        $this->REF_PRINT3->DbValue = $row['REF_PRINT3'];
        $this->TEMPLATES->DbValue = $row['TEMPLATES'];
        $this->TERBILANG->DbValue = $row['TERBILANG'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->DOCS_TYPE->DbValue = $row['DOCS_TYPE'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[REF_TYPE] = @REF_TYPE@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->REF_TYPE->CurrentValue : $this->REF_TYPE->OldValue;
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
                $this->REF_TYPE->CurrentValue = $keys[0];
            } else {
                $this->REF_TYPE->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('REF_TYPE', $row) ? $row['REF_TYPE'] : null;
        } else {
            $val = $this->REF_TYPE->OldValue !== null ? $this->REF_TYPE->OldValue : $this->REF_TYPE->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@REF_TYPE@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ReferenceTypeList");
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
        if ($pageName == "ReferenceTypeView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ReferenceTypeEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ReferenceTypeAdd") {
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
                return "ReferenceTypeView";
            case Config("API_ADD_ACTION"):
                return "ReferenceTypeAdd";
            case Config("API_EDIT_ACTION"):
                return "ReferenceTypeEdit";
            case Config("API_DELETE_ACTION"):
                return "ReferenceTypeDelete";
            case Config("API_LIST_ACTION"):
                return "ReferenceTypeList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ReferenceTypeList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ReferenceTypeView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ReferenceTypeView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ReferenceTypeAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ReferenceTypeAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ReferenceTypeEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ReferenceTypeAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ReferenceTypeDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "REF_TYPE:" . JsonEncode($this->REF_TYPE->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->REF_TYPE->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->REF_TYPE->CurrentValue);
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
            if (($keyValue = Param("REF_TYPE") ?? Route("REF_TYPE")) !== null) {
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
                $this->REF_TYPE->CurrentValue = $key;
            } else {
                $this->REF_TYPE->OldValue = $key;
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
        $this->REF_TYPE->setDbValue($row['REF_TYPE']);
        $this->REFTYPE->setDbValue($row['REFTYPE']);
        $this->DISPLAY->setDbValue($row['DISPLAY']);
        $this->REF_CODE->setDbValue($row['REF_CODE']);
        $this->REF_BATCH->setDbValue($row['REF_BATCH']);
        $this->REF_DETAIL->setDbValue($row['REF_DETAIL']);
        $this->REF_PRINT->setDbValue($row['REF_PRINT']);
        $this->REF_PRINT2->setDbValue($row['REF_PRINT2']);
        $this->REF_PRINT3->setDbValue($row['REF_PRINT3']);
        $this->TEMPLATES->setDbValue($row['TEMPLATES']);
        $this->TERBILANG->setDbValue($row['TERBILANG']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->DOCS_TYPE->setDbValue($row['DOCS_TYPE']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // REF_TYPE

        // REFTYPE

        // DISPLAY

        // REF_CODE

        // REF_BATCH

        // REF_DETAIL

        // REF_PRINT

        // REF_PRINT2

        // REF_PRINT3

        // TEMPLATES

        // TERBILANG

        // MODIFIED_DATE

        // MODIFIED_BY

        // DOCS_TYPE

        // REF_TYPE
        $this->REF_TYPE->ViewValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->ViewValue = FormatNumber($this->REF_TYPE->ViewValue, 0, -2, -2, -2);
        $this->REF_TYPE->ViewCustomAttributes = "";

        // REFTYPE
        $this->REFTYPE->ViewValue = $this->REFTYPE->CurrentValue;
        $this->REFTYPE->ViewCustomAttributes = "";

        // DISPLAY
        $this->DISPLAY->ViewValue = $this->DISPLAY->CurrentValue;
        $this->DISPLAY->ViewCustomAttributes = "";

        // REF_CODE
        $this->REF_CODE->ViewValue = $this->REF_CODE->CurrentValue;
        $this->REF_CODE->ViewCustomAttributes = "";

        // REF_BATCH
        $this->REF_BATCH->ViewValue = $this->REF_BATCH->CurrentValue;
        $this->REF_BATCH->ViewCustomAttributes = "";

        // REF_DETAIL
        $this->REF_DETAIL->ViewValue = $this->REF_DETAIL->CurrentValue;
        $this->REF_DETAIL->ViewCustomAttributes = "";

        // REF_PRINT
        $this->REF_PRINT->ViewValue = $this->REF_PRINT->CurrentValue;
        $this->REF_PRINT->ViewCustomAttributes = "";

        // REF_PRINT2
        $this->REF_PRINT2->ViewValue = $this->REF_PRINT2->CurrentValue;
        $this->REF_PRINT2->ViewCustomAttributes = "";

        // REF_PRINT3
        $this->REF_PRINT3->ViewValue = $this->REF_PRINT3->CurrentValue;
        $this->REF_PRINT3->ViewCustomAttributes = "";

        // TEMPLATES
        $this->TEMPLATES->ViewValue = $this->TEMPLATES->CurrentValue;
        $this->TEMPLATES->ViewCustomAttributes = "";

        // TERBILANG
        $this->TERBILANG->ViewValue = $this->TERBILANG->CurrentValue;
        $this->TERBILANG->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // DOCS_TYPE
        $this->DOCS_TYPE->ViewValue = $this->DOCS_TYPE->CurrentValue;
        $this->DOCS_TYPE->ViewValue = FormatNumber($this->DOCS_TYPE->ViewValue, 0, -2, -2, -2);
        $this->DOCS_TYPE->ViewCustomAttributes = "";

        // REF_TYPE
        $this->REF_TYPE->LinkCustomAttributes = "";
        $this->REF_TYPE->HrefValue = "";
        $this->REF_TYPE->TooltipValue = "";

        // REFTYPE
        $this->REFTYPE->LinkCustomAttributes = "";
        $this->REFTYPE->HrefValue = "";
        $this->REFTYPE->TooltipValue = "";

        // DISPLAY
        $this->DISPLAY->LinkCustomAttributes = "";
        $this->DISPLAY->HrefValue = "";
        $this->DISPLAY->TooltipValue = "";

        // REF_CODE
        $this->REF_CODE->LinkCustomAttributes = "";
        $this->REF_CODE->HrefValue = "";
        $this->REF_CODE->TooltipValue = "";

        // REF_BATCH
        $this->REF_BATCH->LinkCustomAttributes = "";
        $this->REF_BATCH->HrefValue = "";
        $this->REF_BATCH->TooltipValue = "";

        // REF_DETAIL
        $this->REF_DETAIL->LinkCustomAttributes = "";
        $this->REF_DETAIL->HrefValue = "";
        $this->REF_DETAIL->TooltipValue = "";

        // REF_PRINT
        $this->REF_PRINT->LinkCustomAttributes = "";
        $this->REF_PRINT->HrefValue = "";
        $this->REF_PRINT->TooltipValue = "";

        // REF_PRINT2
        $this->REF_PRINT2->LinkCustomAttributes = "";
        $this->REF_PRINT2->HrefValue = "";
        $this->REF_PRINT2->TooltipValue = "";

        // REF_PRINT3
        $this->REF_PRINT3->LinkCustomAttributes = "";
        $this->REF_PRINT3->HrefValue = "";
        $this->REF_PRINT3->TooltipValue = "";

        // TEMPLATES
        $this->TEMPLATES->LinkCustomAttributes = "";
        $this->TEMPLATES->HrefValue = "";
        $this->TEMPLATES->TooltipValue = "";

        // TERBILANG
        $this->TERBILANG->LinkCustomAttributes = "";
        $this->TERBILANG->HrefValue = "";
        $this->TERBILANG->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // DOCS_TYPE
        $this->DOCS_TYPE->LinkCustomAttributes = "";
        $this->DOCS_TYPE->HrefValue = "";
        $this->DOCS_TYPE->TooltipValue = "";

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

        // REF_TYPE
        $this->REF_TYPE->EditAttrs["class"] = "form-control";
        $this->REF_TYPE->EditCustomAttributes = "";
        $this->REF_TYPE->EditValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->PlaceHolder = RemoveHtml($this->REF_TYPE->caption());

        // REFTYPE
        $this->REFTYPE->EditAttrs["class"] = "form-control";
        $this->REFTYPE->EditCustomAttributes = "";
        if (!$this->REFTYPE->Raw) {
            $this->REFTYPE->CurrentValue = HtmlDecode($this->REFTYPE->CurrentValue);
        }
        $this->REFTYPE->EditValue = $this->REFTYPE->CurrentValue;
        $this->REFTYPE->PlaceHolder = RemoveHtml($this->REFTYPE->caption());

        // DISPLAY
        $this->DISPLAY->EditAttrs["class"] = "form-control";
        $this->DISPLAY->EditCustomAttributes = "";
        if (!$this->DISPLAY->Raw) {
            $this->DISPLAY->CurrentValue = HtmlDecode($this->DISPLAY->CurrentValue);
        }
        $this->DISPLAY->EditValue = $this->DISPLAY->CurrentValue;
        $this->DISPLAY->PlaceHolder = RemoveHtml($this->DISPLAY->caption());

        // REF_CODE
        $this->REF_CODE->EditAttrs["class"] = "form-control";
        $this->REF_CODE->EditCustomAttributes = "";
        if (!$this->REF_CODE->Raw) {
            $this->REF_CODE->CurrentValue = HtmlDecode($this->REF_CODE->CurrentValue);
        }
        $this->REF_CODE->EditValue = $this->REF_CODE->CurrentValue;
        $this->REF_CODE->PlaceHolder = RemoveHtml($this->REF_CODE->caption());

        // REF_BATCH
        $this->REF_BATCH->EditAttrs["class"] = "form-control";
        $this->REF_BATCH->EditCustomAttributes = "";
        if (!$this->REF_BATCH->Raw) {
            $this->REF_BATCH->CurrentValue = HtmlDecode($this->REF_BATCH->CurrentValue);
        }
        $this->REF_BATCH->EditValue = $this->REF_BATCH->CurrentValue;
        $this->REF_BATCH->PlaceHolder = RemoveHtml($this->REF_BATCH->caption());

        // REF_DETAIL
        $this->REF_DETAIL->EditAttrs["class"] = "form-control";
        $this->REF_DETAIL->EditCustomAttributes = "";
        if (!$this->REF_DETAIL->Raw) {
            $this->REF_DETAIL->CurrentValue = HtmlDecode($this->REF_DETAIL->CurrentValue);
        }
        $this->REF_DETAIL->EditValue = $this->REF_DETAIL->CurrentValue;
        $this->REF_DETAIL->PlaceHolder = RemoveHtml($this->REF_DETAIL->caption());

        // REF_PRINT
        $this->REF_PRINT->EditAttrs["class"] = "form-control";
        $this->REF_PRINT->EditCustomAttributes = "";
        if (!$this->REF_PRINT->Raw) {
            $this->REF_PRINT->CurrentValue = HtmlDecode($this->REF_PRINT->CurrentValue);
        }
        $this->REF_PRINT->EditValue = $this->REF_PRINT->CurrentValue;
        $this->REF_PRINT->PlaceHolder = RemoveHtml($this->REF_PRINT->caption());

        // REF_PRINT2
        $this->REF_PRINT2->EditAttrs["class"] = "form-control";
        $this->REF_PRINT2->EditCustomAttributes = "";
        if (!$this->REF_PRINT2->Raw) {
            $this->REF_PRINT2->CurrentValue = HtmlDecode($this->REF_PRINT2->CurrentValue);
        }
        $this->REF_PRINT2->EditValue = $this->REF_PRINT2->CurrentValue;
        $this->REF_PRINT2->PlaceHolder = RemoveHtml($this->REF_PRINT2->caption());

        // REF_PRINT3
        $this->REF_PRINT3->EditAttrs["class"] = "form-control";
        $this->REF_PRINT3->EditCustomAttributes = "";
        if (!$this->REF_PRINT3->Raw) {
            $this->REF_PRINT3->CurrentValue = HtmlDecode($this->REF_PRINT3->CurrentValue);
        }
        $this->REF_PRINT3->EditValue = $this->REF_PRINT3->CurrentValue;
        $this->REF_PRINT3->PlaceHolder = RemoveHtml($this->REF_PRINT3->caption());

        // TEMPLATES
        $this->TEMPLATES->EditAttrs["class"] = "form-control";
        $this->TEMPLATES->EditCustomAttributes = "";
        if (!$this->TEMPLATES->Raw) {
            $this->TEMPLATES->CurrentValue = HtmlDecode($this->TEMPLATES->CurrentValue);
        }
        $this->TEMPLATES->EditValue = $this->TEMPLATES->CurrentValue;
        $this->TEMPLATES->PlaceHolder = RemoveHtml($this->TEMPLATES->caption());

        // TERBILANG
        $this->TERBILANG->EditAttrs["class"] = "form-control";
        $this->TERBILANG->EditCustomAttributes = "";
        if (!$this->TERBILANG->Raw) {
            $this->TERBILANG->CurrentValue = HtmlDecode($this->TERBILANG->CurrentValue);
        }
        $this->TERBILANG->EditValue = $this->TERBILANG->CurrentValue;
        $this->TERBILANG->PlaceHolder = RemoveHtml($this->TERBILANG->caption());

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

        // DOCS_TYPE
        $this->DOCS_TYPE->EditAttrs["class"] = "form-control";
        $this->DOCS_TYPE->EditCustomAttributes = "";
        $this->DOCS_TYPE->EditValue = $this->DOCS_TYPE->CurrentValue;
        $this->DOCS_TYPE->PlaceHolder = RemoveHtml($this->DOCS_TYPE->caption());

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
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REFTYPE);
                    $doc->exportCaption($this->DISPLAY);
                    $doc->exportCaption($this->REF_CODE);
                    $doc->exportCaption($this->REF_BATCH);
                    $doc->exportCaption($this->REF_DETAIL);
                    $doc->exportCaption($this->REF_PRINT);
                    $doc->exportCaption($this->REF_PRINT2);
                    $doc->exportCaption($this->REF_PRINT3);
                    $doc->exportCaption($this->TEMPLATES);
                    $doc->exportCaption($this->TERBILANG);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->DOCS_TYPE);
                } else {
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REFTYPE);
                    $doc->exportCaption($this->DISPLAY);
                    $doc->exportCaption($this->REF_CODE);
                    $doc->exportCaption($this->REF_BATCH);
                    $doc->exportCaption($this->REF_DETAIL);
                    $doc->exportCaption($this->REF_PRINT);
                    $doc->exportCaption($this->REF_PRINT2);
                    $doc->exportCaption($this->REF_PRINT3);
                    $doc->exportCaption($this->TEMPLATES);
                    $doc->exportCaption($this->TERBILANG);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->DOCS_TYPE);
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
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REFTYPE);
                        $doc->exportField($this->DISPLAY);
                        $doc->exportField($this->REF_CODE);
                        $doc->exportField($this->REF_BATCH);
                        $doc->exportField($this->REF_DETAIL);
                        $doc->exportField($this->REF_PRINT);
                        $doc->exportField($this->REF_PRINT2);
                        $doc->exportField($this->REF_PRINT3);
                        $doc->exportField($this->TEMPLATES);
                        $doc->exportField($this->TERBILANG);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->DOCS_TYPE);
                    } else {
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REFTYPE);
                        $doc->exportField($this->DISPLAY);
                        $doc->exportField($this->REF_CODE);
                        $doc->exportField($this->REF_BATCH);
                        $doc->exportField($this->REF_DETAIL);
                        $doc->exportField($this->REF_PRINT);
                        $doc->exportField($this->REF_PRINT2);
                        $doc->exportField($this->REF_PRINT3);
                        $doc->exportField($this->TEMPLATES);
                        $doc->exportField($this->TERBILANG);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->DOCS_TYPE);
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
