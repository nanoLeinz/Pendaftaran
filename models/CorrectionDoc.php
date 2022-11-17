<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for CORRECTION_DOC
 */
class CorrectionDoc extends DbTable
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
    public $CORRECTION_DOC;
    public $CORRECTIONDATE;
    public $CORRECTED_BY;
    public $CORRECTION_VALUE;
    public $APPROVED_BY;
    public $ACKNOWLEDGEDBY;
    public $DESCRIPTION;
    public $FINANCE_ID;
    public $ACCOUNT_ID;
    public $MONTH_ID;
    public $YEAR_ID;
    public $ORG_ID;
    public $CLINIC_ID;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $DISTRIBUTION_TYPE;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'CORRECTION_DOC';
        $this->TableName = 'CORRECTION_DOC';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[CORRECTION_DOC]";
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
        $this->ORG_UNIT_CODE = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // CORRECTION_DOC
        $this->CORRECTION_DOC = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_CORRECTION_DOC', 'CORRECTION_DOC', '[CORRECTION_DOC]', '[CORRECTION_DOC]', 200, 50, -1, false, '[CORRECTION_DOC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CORRECTION_DOC->IsPrimaryKey = true; // Primary key field
        $this->CORRECTION_DOC->Nullable = false; // NOT NULL field
        $this->CORRECTION_DOC->Required = true; // Required field
        $this->CORRECTION_DOC->Sortable = true; // Allow sort
        $this->CORRECTION_DOC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CORRECTION_DOC->Param, "CustomMsg");
        $this->Fields['CORRECTION_DOC'] = &$this->CORRECTION_DOC;

        // CORRECTIONDATE
        $this->CORRECTIONDATE = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_CORRECTIONDATE', 'CORRECTIONDATE', '[CORRECTIONDATE]', CastDateFieldForLike("[CORRECTIONDATE]", 0, "DB"), 135, 8, 0, false, '[CORRECTIONDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CORRECTIONDATE->Sortable = true; // Allow sort
        $this->CORRECTIONDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->CORRECTIONDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CORRECTIONDATE->Param, "CustomMsg");
        $this->Fields['CORRECTIONDATE'] = &$this->CORRECTIONDATE;

        // CORRECTED_BY
        $this->CORRECTED_BY = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_CORRECTED_BY', 'CORRECTED_BY', '[CORRECTED_BY]', '[CORRECTED_BY]', 200, 200, -1, false, '[CORRECTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CORRECTED_BY->Sortable = true; // Allow sort
        $this->CORRECTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CORRECTED_BY->Param, "CustomMsg");
        $this->Fields['CORRECTED_BY'] = &$this->CORRECTED_BY;

        // CORRECTION_VALUE
        $this->CORRECTION_VALUE = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_CORRECTION_VALUE', 'CORRECTION_VALUE', '[CORRECTION_VALUE]', 'CAST([CORRECTION_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[CORRECTION_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CORRECTION_VALUE->Sortable = true; // Allow sort
        $this->CORRECTION_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->CORRECTION_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->CORRECTION_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CORRECTION_VALUE->Param, "CustomMsg");
        $this->Fields['CORRECTION_VALUE'] = &$this->CORRECTION_VALUE;

        // APPROVED_BY
        $this->APPROVED_BY = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_APPROVED_BY', 'APPROVED_BY', '[APPROVED_BY]', '[APPROVED_BY]', 200, 200, -1, false, '[APPROVED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_BY->Sortable = true; // Allow sort
        $this->APPROVED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_BY->Param, "CustomMsg");
        $this->Fields['APPROVED_BY'] = &$this->APPROVED_BY;

        // ACKNOWLEDGEDBY
        $this->ACKNOWLEDGEDBY = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_ACKNOWLEDGEDBY', 'ACKNOWLEDGEDBY', '[ACKNOWLEDGEDBY]', '[ACKNOWLEDGEDBY]', 200, 200, -1, false, '[ACKNOWLEDGEDBY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACKNOWLEDGEDBY->Sortable = true; // Allow sort
        $this->ACKNOWLEDGEDBY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACKNOWLEDGEDBY->Param, "CustomMsg");
        $this->Fields['ACKNOWLEDGEDBY'] = &$this->ACKNOWLEDGEDBY;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // FINANCE_ID
        $this->FINANCE_ID = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_FINANCE_ID', 'FINANCE_ID', '[FINANCE_ID]', 'CAST([FINANCE_ID] AS NVARCHAR)', 2, 2, -1, false, '[FINANCE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FINANCE_ID->Sortable = true; // Allow sort
        $this->FINANCE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FINANCE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FINANCE_ID->Param, "CustomMsg");
        $this->Fields['FINANCE_ID'] = &$this->FINANCE_ID;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // MONTH_ID
        $this->MONTH_ID = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_MONTH_ID', 'MONTH_ID', '[MONTH_ID]', 'CAST([MONTH_ID] AS NVARCHAR)', 17, 1, -1, false, '[MONTH_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MONTH_ID->Sortable = true; // Allow sort
        $this->MONTH_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MONTH_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MONTH_ID->Param, "CustomMsg");
        $this->Fields['MONTH_ID'] = &$this->MONTH_ID;

        // YEAR_ID
        $this->YEAR_ID = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // ORG_ID
        $this->ORG_ID = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 50, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE = new DbField('CORRECTION_DOC', 'CORRECTION_DOC', 'x_DISTRIBUTION_TYPE', 'DISTRIBUTION_TYPE', '[DISTRIBUTION_TYPE]', 'CAST([DISTRIBUTION_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[DISTRIBUTION_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISTRIBUTION_TYPE->Sortable = true; // Allow sort
        $this->DISTRIBUTION_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DISTRIBUTION_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISTRIBUTION_TYPE->Param, "CustomMsg");
        $this->Fields['DISTRIBUTION_TYPE'] = &$this->DISTRIBUTION_TYPE;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[CORRECTION_DOC]";
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
            if (array_key_exists('CORRECTION_DOC', $rs)) {
                AddFilter($where, QuotedName('CORRECTION_DOC', $this->Dbid) . '=' . QuotedValue($rs['CORRECTION_DOC'], $this->CORRECTION_DOC->DataType, $this->Dbid));
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
        $this->CORRECTION_DOC->DbValue = $row['CORRECTION_DOC'];
        $this->CORRECTIONDATE->DbValue = $row['CORRECTIONDATE'];
        $this->CORRECTED_BY->DbValue = $row['CORRECTED_BY'];
        $this->CORRECTION_VALUE->DbValue = $row['CORRECTION_VALUE'];
        $this->APPROVED_BY->DbValue = $row['APPROVED_BY'];
        $this->ACKNOWLEDGEDBY->DbValue = $row['ACKNOWLEDGEDBY'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->FINANCE_ID->DbValue = $row['FINANCE_ID'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->MONTH_ID->DbValue = $row['MONTH_ID'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->DISTRIBUTION_TYPE->DbValue = $row['DISTRIBUTION_TYPE'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [CORRECTION_DOC] = '@CORRECTION_DOC@'";
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
        $val = $current ? $this->CORRECTION_DOC->CurrentValue : $this->CORRECTION_DOC->OldValue;
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
                $this->CORRECTION_DOC->CurrentValue = $keys[1];
            } else {
                $this->CORRECTION_DOC->OldValue = $keys[1];
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
            $val = array_key_exists('CORRECTION_DOC', $row) ? $row['CORRECTION_DOC'] : null;
        } else {
            $val = $this->CORRECTION_DOC->OldValue !== null ? $this->CORRECTION_DOC->OldValue : $this->CORRECTION_DOC->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@CORRECTION_DOC@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("CorrectionDocList");
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
        if ($pageName == "CorrectionDocView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CorrectionDocEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CorrectionDocAdd") {
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
                return "CorrectionDocView";
            case Config("API_ADD_ACTION"):
                return "CorrectionDocAdd";
            case Config("API_EDIT_ACTION"):
                return "CorrectionDocEdit";
            case Config("API_DELETE_ACTION"):
                return "CorrectionDocDelete";
            case Config("API_LIST_ACTION"):
                return "CorrectionDocList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CorrectionDocList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CorrectionDocView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CorrectionDocView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CorrectionDocAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CorrectionDocAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CorrectionDocEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CorrectionDocAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CorrectionDocDelete", $this->getUrlParm());
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
        $json .= ",CORRECTION_DOC:" . JsonEncode($this->CORRECTION_DOC->CurrentValue, "string");
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
        if ($this->CORRECTION_DOC->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->CORRECTION_DOC->CurrentValue);
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
            if (($keyValue = Param("CORRECTION_DOC") ?? Route("CORRECTION_DOC")) !== null) {
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
                $this->CORRECTION_DOC->CurrentValue = $key[1];
            } else {
                $this->CORRECTION_DOC->OldValue = $key[1];
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
        $this->CORRECTION_DOC->setDbValue($row['CORRECTION_DOC']);
        $this->CORRECTIONDATE->setDbValue($row['CORRECTIONDATE']);
        $this->CORRECTED_BY->setDbValue($row['CORRECTED_BY']);
        $this->CORRECTION_VALUE->setDbValue($row['CORRECTION_VALUE']);
        $this->APPROVED_BY->setDbValue($row['APPROVED_BY']);
        $this->ACKNOWLEDGEDBY->setDbValue($row['ACKNOWLEDGEDBY']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->FINANCE_ID->setDbValue($row['FINANCE_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->MONTH_ID->setDbValue($row['MONTH_ID']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->DISTRIBUTION_TYPE->setDbValue($row['DISTRIBUTION_TYPE']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // CORRECTION_DOC

        // CORRECTIONDATE

        // CORRECTED_BY

        // CORRECTION_VALUE

        // APPROVED_BY

        // ACKNOWLEDGEDBY

        // DESCRIPTION

        // FINANCE_ID

        // ACCOUNT_ID

        // MONTH_ID

        // YEAR_ID

        // ORG_ID

        // CLINIC_ID

        // MODIFIED_DATE

        // MODIFIED_BY

        // DISTRIBUTION_TYPE

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // CORRECTION_DOC
        $this->CORRECTION_DOC->ViewValue = $this->CORRECTION_DOC->CurrentValue;
        $this->CORRECTION_DOC->ViewCustomAttributes = "";

        // CORRECTIONDATE
        $this->CORRECTIONDATE->ViewValue = $this->CORRECTIONDATE->CurrentValue;
        $this->CORRECTIONDATE->ViewValue = FormatDateTime($this->CORRECTIONDATE->ViewValue, 0);
        $this->CORRECTIONDATE->ViewCustomAttributes = "";

        // CORRECTED_BY
        $this->CORRECTED_BY->ViewValue = $this->CORRECTED_BY->CurrentValue;
        $this->CORRECTED_BY->ViewCustomAttributes = "";

        // CORRECTION_VALUE
        $this->CORRECTION_VALUE->ViewValue = $this->CORRECTION_VALUE->CurrentValue;
        $this->CORRECTION_VALUE->ViewValue = FormatNumber($this->CORRECTION_VALUE->ViewValue, 2, -2, -2, -2);
        $this->CORRECTION_VALUE->ViewCustomAttributes = "";

        // APPROVED_BY
        $this->APPROVED_BY->ViewValue = $this->APPROVED_BY->CurrentValue;
        $this->APPROVED_BY->ViewCustomAttributes = "";

        // ACKNOWLEDGEDBY
        $this->ACKNOWLEDGEDBY->ViewValue = $this->ACKNOWLEDGEDBY->CurrentValue;
        $this->ACKNOWLEDGEDBY->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // FINANCE_ID
        $this->FINANCE_ID->ViewValue = $this->FINANCE_ID->CurrentValue;
        $this->FINANCE_ID->ViewValue = FormatNumber($this->FINANCE_ID->ViewValue, 0, -2, -2, -2);
        $this->FINANCE_ID->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // MONTH_ID
        $this->MONTH_ID->ViewValue = $this->MONTH_ID->CurrentValue;
        $this->MONTH_ID->ViewValue = FormatNumber($this->MONTH_ID->ViewValue, 0, -2, -2, -2);
        $this->MONTH_ID->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->CurrentValue;
        $this->DISTRIBUTION_TYPE->ViewValue = FormatNumber($this->DISTRIBUTION_TYPE->ViewValue, 0, -2, -2, -2);
        $this->DISTRIBUTION_TYPE->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // CORRECTION_DOC
        $this->CORRECTION_DOC->LinkCustomAttributes = "";
        $this->CORRECTION_DOC->HrefValue = "";
        $this->CORRECTION_DOC->TooltipValue = "";

        // CORRECTIONDATE
        $this->CORRECTIONDATE->LinkCustomAttributes = "";
        $this->CORRECTIONDATE->HrefValue = "";
        $this->CORRECTIONDATE->TooltipValue = "";

        // CORRECTED_BY
        $this->CORRECTED_BY->LinkCustomAttributes = "";
        $this->CORRECTED_BY->HrefValue = "";
        $this->CORRECTED_BY->TooltipValue = "";

        // CORRECTION_VALUE
        $this->CORRECTION_VALUE->LinkCustomAttributes = "";
        $this->CORRECTION_VALUE->HrefValue = "";
        $this->CORRECTION_VALUE->TooltipValue = "";

        // APPROVED_BY
        $this->APPROVED_BY->LinkCustomAttributes = "";
        $this->APPROVED_BY->HrefValue = "";
        $this->APPROVED_BY->TooltipValue = "";

        // ACKNOWLEDGEDBY
        $this->ACKNOWLEDGEDBY->LinkCustomAttributes = "";
        $this->ACKNOWLEDGEDBY->HrefValue = "";
        $this->ACKNOWLEDGEDBY->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // FINANCE_ID
        $this->FINANCE_ID->LinkCustomAttributes = "";
        $this->FINANCE_ID->HrefValue = "";
        $this->FINANCE_ID->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // MONTH_ID
        $this->MONTH_ID->LinkCustomAttributes = "";
        $this->MONTH_ID->HrefValue = "";
        $this->MONTH_ID->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->LinkCustomAttributes = "";
        $this->DISTRIBUTION_TYPE->HrefValue = "";
        $this->DISTRIBUTION_TYPE->TooltipValue = "";

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

        // CORRECTION_DOC
        $this->CORRECTION_DOC->EditAttrs["class"] = "form-control";
        $this->CORRECTION_DOC->EditCustomAttributes = "";
        if (!$this->CORRECTION_DOC->Raw) {
            $this->CORRECTION_DOC->CurrentValue = HtmlDecode($this->CORRECTION_DOC->CurrentValue);
        }
        $this->CORRECTION_DOC->EditValue = $this->CORRECTION_DOC->CurrentValue;
        $this->CORRECTION_DOC->PlaceHolder = RemoveHtml($this->CORRECTION_DOC->caption());

        // CORRECTIONDATE
        $this->CORRECTIONDATE->EditAttrs["class"] = "form-control";
        $this->CORRECTIONDATE->EditCustomAttributes = "";
        $this->CORRECTIONDATE->EditValue = FormatDateTime($this->CORRECTIONDATE->CurrentValue, 8);
        $this->CORRECTIONDATE->PlaceHolder = RemoveHtml($this->CORRECTIONDATE->caption());

        // CORRECTED_BY
        $this->CORRECTED_BY->EditAttrs["class"] = "form-control";
        $this->CORRECTED_BY->EditCustomAttributes = "";
        if (!$this->CORRECTED_BY->Raw) {
            $this->CORRECTED_BY->CurrentValue = HtmlDecode($this->CORRECTED_BY->CurrentValue);
        }
        $this->CORRECTED_BY->EditValue = $this->CORRECTED_BY->CurrentValue;
        $this->CORRECTED_BY->PlaceHolder = RemoveHtml($this->CORRECTED_BY->caption());

        // CORRECTION_VALUE
        $this->CORRECTION_VALUE->EditAttrs["class"] = "form-control";
        $this->CORRECTION_VALUE->EditCustomAttributes = "";
        $this->CORRECTION_VALUE->EditValue = $this->CORRECTION_VALUE->CurrentValue;
        $this->CORRECTION_VALUE->PlaceHolder = RemoveHtml($this->CORRECTION_VALUE->caption());
        if (strval($this->CORRECTION_VALUE->EditValue) != "" && is_numeric($this->CORRECTION_VALUE->EditValue)) {
            $this->CORRECTION_VALUE->EditValue = FormatNumber($this->CORRECTION_VALUE->EditValue, -2, -2, -2, -2);
        }

        // APPROVED_BY
        $this->APPROVED_BY->EditAttrs["class"] = "form-control";
        $this->APPROVED_BY->EditCustomAttributes = "";
        if (!$this->APPROVED_BY->Raw) {
            $this->APPROVED_BY->CurrentValue = HtmlDecode($this->APPROVED_BY->CurrentValue);
        }
        $this->APPROVED_BY->EditValue = $this->APPROVED_BY->CurrentValue;
        $this->APPROVED_BY->PlaceHolder = RemoveHtml($this->APPROVED_BY->caption());

        // ACKNOWLEDGEDBY
        $this->ACKNOWLEDGEDBY->EditAttrs["class"] = "form-control";
        $this->ACKNOWLEDGEDBY->EditCustomAttributes = "";
        if (!$this->ACKNOWLEDGEDBY->Raw) {
            $this->ACKNOWLEDGEDBY->CurrentValue = HtmlDecode($this->ACKNOWLEDGEDBY->CurrentValue);
        }
        $this->ACKNOWLEDGEDBY->EditValue = $this->ACKNOWLEDGEDBY->CurrentValue;
        $this->ACKNOWLEDGEDBY->PlaceHolder = RemoveHtml($this->ACKNOWLEDGEDBY->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // FINANCE_ID
        $this->FINANCE_ID->EditAttrs["class"] = "form-control";
        $this->FINANCE_ID->EditCustomAttributes = "";
        $this->FINANCE_ID->EditValue = $this->FINANCE_ID->CurrentValue;
        $this->FINANCE_ID->PlaceHolder = RemoveHtml($this->FINANCE_ID->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // MONTH_ID
        $this->MONTH_ID->EditAttrs["class"] = "form-control";
        $this->MONTH_ID->EditCustomAttributes = "";
        $this->MONTH_ID->EditValue = $this->MONTH_ID->CurrentValue;
        $this->MONTH_ID->PlaceHolder = RemoveHtml($this->MONTH_ID->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

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

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->EditAttrs["class"] = "form-control";
        $this->DISTRIBUTION_TYPE->EditCustomAttributes = "";
        $this->DISTRIBUTION_TYPE->EditValue = $this->DISTRIBUTION_TYPE->CurrentValue;
        $this->DISTRIBUTION_TYPE->PlaceHolder = RemoveHtml($this->DISTRIBUTION_TYPE->caption());

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
                    $doc->exportCaption($this->CORRECTION_DOC);
                    $doc->exportCaption($this->CORRECTIONDATE);
                    $doc->exportCaption($this->CORRECTED_BY);
                    $doc->exportCaption($this->CORRECTION_VALUE);
                    $doc->exportCaption($this->APPROVED_BY);
                    $doc->exportCaption($this->ACKNOWLEDGEDBY);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->FINANCE_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->MONTH_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->DISTRIBUTION_TYPE);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->CORRECTION_DOC);
                    $doc->exportCaption($this->CORRECTIONDATE);
                    $doc->exportCaption($this->CORRECTED_BY);
                    $doc->exportCaption($this->CORRECTION_VALUE);
                    $doc->exportCaption($this->APPROVED_BY);
                    $doc->exportCaption($this->ACKNOWLEDGEDBY);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->FINANCE_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->MONTH_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->DISTRIBUTION_TYPE);
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
                        $doc->exportField($this->CORRECTION_DOC);
                        $doc->exportField($this->CORRECTIONDATE);
                        $doc->exportField($this->CORRECTED_BY);
                        $doc->exportField($this->CORRECTION_VALUE);
                        $doc->exportField($this->APPROVED_BY);
                        $doc->exportField($this->ACKNOWLEDGEDBY);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->FINANCE_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->MONTH_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->DISTRIBUTION_TYPE);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->CORRECTION_DOC);
                        $doc->exportField($this->CORRECTIONDATE);
                        $doc->exportField($this->CORRECTED_BY);
                        $doc->exportField($this->CORRECTION_VALUE);
                        $doc->exportField($this->APPROVED_BY);
                        $doc->exportField($this->ACKNOWLEDGEDBY);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->FINANCE_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->MONTH_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->DISTRIBUTION_TYPE);
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
