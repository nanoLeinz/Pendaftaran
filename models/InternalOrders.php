<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for INTERNAL_ORDERS
 */
class InternalOrders extends DbTable
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
    public $ORDER_ID;
    public $ORG_UNIT_FROM;
    public $ORG_ID;
    public $YEAR_ID;
    public $ORDER_DATE;
    public $ORDER_BY;
    public $ORDER_VALUE;
    public $RECEIVED_VALUE;
    public $RECEIVED_BY;
    public $DOC_NO;
    public $ACCEPTED_BY;
    public $ACCOUNT_ID;
    public $FINANCE_ID;
    public $ATP_DATE;
    public $DELIVERY_DATE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $CLINIC_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'INTERNAL_ORDERS';
        $this->TableName = 'INTERNAL_ORDERS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[INTERNAL_ORDERS]";
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
        $this->ORG_UNIT_CODE = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // ORDER_ID
        $this->ORDER_ID = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ORDER_ID', 'ORDER_ID', '[ORDER_ID]', '[ORDER_ID]', 200, 50, -1, false, '[ORDER_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORDER_ID->IsPrimaryKey = true; // Primary key field
        $this->ORDER_ID->Nullable = false; // NOT NULL field
        $this->ORDER_ID->Required = true; // Required field
        $this->ORDER_ID->Sortable = true; // Allow sort
        $this->ORDER_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORDER_ID->Param, "CustomMsg");
        $this->Fields['ORDER_ID'] = &$this->ORDER_ID;

        // ORG_UNIT_FROM
        $this->ORG_UNIT_FROM = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ORG_UNIT_FROM', 'ORG_UNIT_FROM', '[ORG_UNIT_FROM]', '[ORG_UNIT_FROM]', 200, 50, -1, false, '[ORG_UNIT_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_FROM->Sortable = true; // Allow sort
        $this->ORG_UNIT_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_FROM->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_FROM'] = &$this->ORG_UNIT_FROM;

        // ORG_ID
        $this->ORG_ID = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // YEAR_ID
        $this->YEAR_ID = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // ORDER_DATE
        $this->ORDER_DATE = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ORDER_DATE', 'ORDER_DATE', '[ORDER_DATE]', CastDateFieldForLike("[ORDER_DATE]", 0, "DB"), 135, 8, 0, false, '[ORDER_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORDER_DATE->Sortable = true; // Allow sort
        $this->ORDER_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->ORDER_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORDER_DATE->Param, "CustomMsg");
        $this->Fields['ORDER_DATE'] = &$this->ORDER_DATE;

        // ORDER_BY
        $this->ORDER_BY = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ORDER_BY', 'ORDER_BY', '[ORDER_BY]', '[ORDER_BY]', 200, 100, -1, false, '[ORDER_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORDER_BY->Sortable = true; // Allow sort
        $this->ORDER_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORDER_BY->Param, "CustomMsg");
        $this->Fields['ORDER_BY'] = &$this->ORDER_BY;

        // ORDER_VALUE
        $this->ORDER_VALUE = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ORDER_VALUE', 'ORDER_VALUE', '[ORDER_VALUE]', 'CAST([ORDER_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[ORDER_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORDER_VALUE->Sortable = true; // Allow sort
        $this->ORDER_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ORDER_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ORDER_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORDER_VALUE->Param, "CustomMsg");
        $this->Fields['ORDER_VALUE'] = &$this->ORDER_VALUE;

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_RECEIVED_VALUE', 'RECEIVED_VALUE', '[RECEIVED_VALUE]', 'CAST([RECEIVED_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[RECEIVED_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_VALUE->Sortable = true; // Allow sort
        $this->RECEIVED_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->RECEIVED_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->RECEIVED_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_VALUE->Param, "CustomMsg");
        $this->Fields['RECEIVED_VALUE'] = &$this->RECEIVED_VALUE;

        // RECEIVED_BY
        $this->RECEIVED_BY = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_RECEIVED_BY', 'RECEIVED_BY', '[RECEIVED_BY]', '[RECEIVED_BY]', 200, 100, -1, false, '[RECEIVED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_BY->Sortable = true; // Allow sort
        $this->RECEIVED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_BY->Param, "CustomMsg");
        $this->Fields['RECEIVED_BY'] = &$this->RECEIVED_BY;

        // DOC_NO
        $this->DOC_NO = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_DOC_NO', 'DOC_NO', '[DOC_NO]', '[DOC_NO]', 200, 50, -1, false, '[DOC_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_NO->Sortable = true; // Allow sort
        $this->DOC_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_NO->Param, "CustomMsg");
        $this->Fields['DOC_NO'] = &$this->DOC_NO;

        // ACCEPTED_BY
        $this->ACCEPTED_BY = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ACCEPTED_BY', 'ACCEPTED_BY', '[ACCEPTED_BY]', '[ACCEPTED_BY]', 200, 100, -1, false, '[ACCEPTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCEPTED_BY->Sortable = true; // Allow sort
        $this->ACCEPTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCEPTED_BY->Param, "CustomMsg");
        $this->Fields['ACCEPTED_BY'] = &$this->ACCEPTED_BY;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // FINANCE_ID
        $this->FINANCE_ID = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_FINANCE_ID', 'FINANCE_ID', '[FINANCE_ID]', 'CAST([FINANCE_ID] AS NVARCHAR)', 2, 2, -1, false, '[FINANCE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FINANCE_ID->Sortable = true; // Allow sort
        $this->FINANCE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FINANCE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FINANCE_ID->Param, "CustomMsg");
        $this->Fields['FINANCE_ID'] = &$this->FINANCE_ID;

        // ATP_DATE
        $this->ATP_DATE = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_ATP_DATE', 'ATP_DATE', '[ATP_DATE]', CastDateFieldForLike("[ATP_DATE]", 0, "DB"), 135, 8, 0, false, '[ATP_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ATP_DATE->Sortable = true; // Allow sort
        $this->ATP_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->ATP_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ATP_DATE->Param, "CustomMsg");
        $this->Fields['ATP_DATE'] = &$this->ATP_DATE;

        // DELIVERY_DATE
        $this->DELIVERY_DATE = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_DELIVERY_DATE', 'DELIVERY_DATE', '[DELIVERY_DATE]', CastDateFieldForLike("[DELIVERY_DATE]", 0, "DB"), 135, 8, 0, false, '[DELIVERY_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DELIVERY_DATE->Sortable = true; // Allow sort
        $this->DELIVERY_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DELIVERY_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DELIVERY_DATE->Param, "CustomMsg");
        $this->Fields['DELIVERY_DATE'] = &$this->DELIVERY_DATE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('INTERNAL_ORDERS', 'INTERNAL_ORDERS', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 25, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[INTERNAL_ORDERS]";
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
            if (array_key_exists('ORDER_ID', $rs)) {
                AddFilter($where, QuotedName('ORDER_ID', $this->Dbid) . '=' . QuotedValue($rs['ORDER_ID'], $this->ORDER_ID->DataType, $this->Dbid));
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
        $this->ORDER_ID->DbValue = $row['ORDER_ID'];
        $this->ORG_UNIT_FROM->DbValue = $row['ORG_UNIT_FROM'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->ORDER_DATE->DbValue = $row['ORDER_DATE'];
        $this->ORDER_BY->DbValue = $row['ORDER_BY'];
        $this->ORDER_VALUE->DbValue = $row['ORDER_VALUE'];
        $this->RECEIVED_VALUE->DbValue = $row['RECEIVED_VALUE'];
        $this->RECEIVED_BY->DbValue = $row['RECEIVED_BY'];
        $this->DOC_NO->DbValue = $row['DOC_NO'];
        $this->ACCEPTED_BY->DbValue = $row['ACCEPTED_BY'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->FINANCE_ID->DbValue = $row['FINANCE_ID'];
        $this->ATP_DATE->DbValue = $row['ATP_DATE'];
        $this->DELIVERY_DATE->DbValue = $row['DELIVERY_DATE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [ORDER_ID] = '@ORDER_ID@'";
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
        $val = $current ? $this->ORDER_ID->CurrentValue : $this->ORDER_ID->OldValue;
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
                $this->ORDER_ID->CurrentValue = $keys[1];
            } else {
                $this->ORDER_ID->OldValue = $keys[1];
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
            $val = array_key_exists('ORDER_ID', $row) ? $row['ORDER_ID'] : null;
        } else {
            $val = $this->ORDER_ID->OldValue !== null ? $this->ORDER_ID->OldValue : $this->ORDER_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ORDER_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("InternalOrdersList");
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
        if ($pageName == "InternalOrdersView") {
            return $Language->phrase("View");
        } elseif ($pageName == "InternalOrdersEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "InternalOrdersAdd") {
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
                return "InternalOrdersView";
            case Config("API_ADD_ACTION"):
                return "InternalOrdersAdd";
            case Config("API_EDIT_ACTION"):
                return "InternalOrdersEdit";
            case Config("API_DELETE_ACTION"):
                return "InternalOrdersDelete";
            case Config("API_LIST_ACTION"):
                return "InternalOrdersList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "InternalOrdersList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("InternalOrdersView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("InternalOrdersView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "InternalOrdersAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "InternalOrdersAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("InternalOrdersEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("InternalOrdersAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("InternalOrdersDelete", $this->getUrlParm());
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
        $json .= ",ORDER_ID:" . JsonEncode($this->ORDER_ID->CurrentValue, "string");
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
        if ($this->ORDER_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ORDER_ID->CurrentValue);
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
            if (($keyValue = Param("ORDER_ID") ?? Route("ORDER_ID")) !== null) {
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
                $this->ORDER_ID->CurrentValue = $key[1];
            } else {
                $this->ORDER_ID->OldValue = $key[1];
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
        $this->ORDER_ID->setDbValue($row['ORDER_ID']);
        $this->ORG_UNIT_FROM->setDbValue($row['ORG_UNIT_FROM']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->ORDER_DATE->setDbValue($row['ORDER_DATE']);
        $this->ORDER_BY->setDbValue($row['ORDER_BY']);
        $this->ORDER_VALUE->setDbValue($row['ORDER_VALUE']);
        $this->RECEIVED_VALUE->setDbValue($row['RECEIVED_VALUE']);
        $this->RECEIVED_BY->setDbValue($row['RECEIVED_BY']);
        $this->DOC_NO->setDbValue($row['DOC_NO']);
        $this->ACCEPTED_BY->setDbValue($row['ACCEPTED_BY']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->FINANCE_ID->setDbValue($row['FINANCE_ID']);
        $this->ATP_DATE->setDbValue($row['ATP_DATE']);
        $this->DELIVERY_DATE->setDbValue($row['DELIVERY_DATE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // ORDER_ID

        // ORG_UNIT_FROM

        // ORG_ID

        // YEAR_ID

        // ORDER_DATE

        // ORDER_BY

        // ORDER_VALUE

        // RECEIVED_VALUE

        // RECEIVED_BY

        // DOC_NO

        // ACCEPTED_BY

        // ACCOUNT_ID

        // FINANCE_ID

        // ATP_DATE

        // DELIVERY_DATE

        // MODIFIED_DATE

        // MODIFIED_BY

        // CLINIC_ID

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // ORDER_ID
        $this->ORDER_ID->ViewValue = $this->ORDER_ID->CurrentValue;
        $this->ORDER_ID->ViewCustomAttributes = "";

        // ORG_UNIT_FROM
        $this->ORG_UNIT_FROM->ViewValue = $this->ORG_UNIT_FROM->CurrentValue;
        $this->ORG_UNIT_FROM->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // ORDER_DATE
        $this->ORDER_DATE->ViewValue = $this->ORDER_DATE->CurrentValue;
        $this->ORDER_DATE->ViewValue = FormatDateTime($this->ORDER_DATE->ViewValue, 0);
        $this->ORDER_DATE->ViewCustomAttributes = "";

        // ORDER_BY
        $this->ORDER_BY->ViewValue = $this->ORDER_BY->CurrentValue;
        $this->ORDER_BY->ViewCustomAttributes = "";

        // ORDER_VALUE
        $this->ORDER_VALUE->ViewValue = $this->ORDER_VALUE->CurrentValue;
        $this->ORDER_VALUE->ViewValue = FormatNumber($this->ORDER_VALUE->ViewValue, 2, -2, -2, -2);
        $this->ORDER_VALUE->ViewCustomAttributes = "";

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->ViewValue = $this->RECEIVED_VALUE->CurrentValue;
        $this->RECEIVED_VALUE->ViewValue = FormatNumber($this->RECEIVED_VALUE->ViewValue, 2, -2, -2, -2);
        $this->RECEIVED_VALUE->ViewCustomAttributes = "";

        // RECEIVED_BY
        $this->RECEIVED_BY->ViewValue = $this->RECEIVED_BY->CurrentValue;
        $this->RECEIVED_BY->ViewCustomAttributes = "";

        // DOC_NO
        $this->DOC_NO->ViewValue = $this->DOC_NO->CurrentValue;
        $this->DOC_NO->ViewCustomAttributes = "";

        // ACCEPTED_BY
        $this->ACCEPTED_BY->ViewValue = $this->ACCEPTED_BY->CurrentValue;
        $this->ACCEPTED_BY->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // FINANCE_ID
        $this->FINANCE_ID->ViewValue = $this->FINANCE_ID->CurrentValue;
        $this->FINANCE_ID->ViewValue = FormatNumber($this->FINANCE_ID->ViewValue, 0, -2, -2, -2);
        $this->FINANCE_ID->ViewCustomAttributes = "";

        // ATP_DATE
        $this->ATP_DATE->ViewValue = $this->ATP_DATE->CurrentValue;
        $this->ATP_DATE->ViewValue = FormatDateTime($this->ATP_DATE->ViewValue, 0);
        $this->ATP_DATE->ViewCustomAttributes = "";

        // DELIVERY_DATE
        $this->DELIVERY_DATE->ViewValue = $this->DELIVERY_DATE->CurrentValue;
        $this->DELIVERY_DATE->ViewValue = FormatDateTime($this->DELIVERY_DATE->ViewValue, 0);
        $this->DELIVERY_DATE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // ORDER_ID
        $this->ORDER_ID->LinkCustomAttributes = "";
        $this->ORDER_ID->HrefValue = "";
        $this->ORDER_ID->TooltipValue = "";

        // ORG_UNIT_FROM
        $this->ORG_UNIT_FROM->LinkCustomAttributes = "";
        $this->ORG_UNIT_FROM->HrefValue = "";
        $this->ORG_UNIT_FROM->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // ORDER_DATE
        $this->ORDER_DATE->LinkCustomAttributes = "";
        $this->ORDER_DATE->HrefValue = "";
        $this->ORDER_DATE->TooltipValue = "";

        // ORDER_BY
        $this->ORDER_BY->LinkCustomAttributes = "";
        $this->ORDER_BY->HrefValue = "";
        $this->ORDER_BY->TooltipValue = "";

        // ORDER_VALUE
        $this->ORDER_VALUE->LinkCustomAttributes = "";
        $this->ORDER_VALUE->HrefValue = "";
        $this->ORDER_VALUE->TooltipValue = "";

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->LinkCustomAttributes = "";
        $this->RECEIVED_VALUE->HrefValue = "";
        $this->RECEIVED_VALUE->TooltipValue = "";

        // RECEIVED_BY
        $this->RECEIVED_BY->LinkCustomAttributes = "";
        $this->RECEIVED_BY->HrefValue = "";
        $this->RECEIVED_BY->TooltipValue = "";

        // DOC_NO
        $this->DOC_NO->LinkCustomAttributes = "";
        $this->DOC_NO->HrefValue = "";
        $this->DOC_NO->TooltipValue = "";

        // ACCEPTED_BY
        $this->ACCEPTED_BY->LinkCustomAttributes = "";
        $this->ACCEPTED_BY->HrefValue = "";
        $this->ACCEPTED_BY->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // FINANCE_ID
        $this->FINANCE_ID->LinkCustomAttributes = "";
        $this->FINANCE_ID->HrefValue = "";
        $this->FINANCE_ID->TooltipValue = "";

        // ATP_DATE
        $this->ATP_DATE->LinkCustomAttributes = "";
        $this->ATP_DATE->HrefValue = "";
        $this->ATP_DATE->TooltipValue = "";

        // DELIVERY_DATE
        $this->DELIVERY_DATE->LinkCustomAttributes = "";
        $this->DELIVERY_DATE->HrefValue = "";
        $this->DELIVERY_DATE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

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

        // ORDER_ID
        $this->ORDER_ID->EditAttrs["class"] = "form-control";
        $this->ORDER_ID->EditCustomAttributes = "";
        if (!$this->ORDER_ID->Raw) {
            $this->ORDER_ID->CurrentValue = HtmlDecode($this->ORDER_ID->CurrentValue);
        }
        $this->ORDER_ID->EditValue = $this->ORDER_ID->CurrentValue;
        $this->ORDER_ID->PlaceHolder = RemoveHtml($this->ORDER_ID->caption());

        // ORG_UNIT_FROM
        $this->ORG_UNIT_FROM->EditAttrs["class"] = "form-control";
        $this->ORG_UNIT_FROM->EditCustomAttributes = "";
        if (!$this->ORG_UNIT_FROM->Raw) {
            $this->ORG_UNIT_FROM->CurrentValue = HtmlDecode($this->ORG_UNIT_FROM->CurrentValue);
        }
        $this->ORG_UNIT_FROM->EditValue = $this->ORG_UNIT_FROM->CurrentValue;
        $this->ORG_UNIT_FROM->PlaceHolder = RemoveHtml($this->ORG_UNIT_FROM->caption());

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        if (!$this->ORG_ID->Raw) {
            $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
        }
        $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // ORDER_DATE
        $this->ORDER_DATE->EditAttrs["class"] = "form-control";
        $this->ORDER_DATE->EditCustomAttributes = "";
        $this->ORDER_DATE->EditValue = FormatDateTime($this->ORDER_DATE->CurrentValue, 8);
        $this->ORDER_DATE->PlaceHolder = RemoveHtml($this->ORDER_DATE->caption());

        // ORDER_BY
        $this->ORDER_BY->EditAttrs["class"] = "form-control";
        $this->ORDER_BY->EditCustomAttributes = "";
        if (!$this->ORDER_BY->Raw) {
            $this->ORDER_BY->CurrentValue = HtmlDecode($this->ORDER_BY->CurrentValue);
        }
        $this->ORDER_BY->EditValue = $this->ORDER_BY->CurrentValue;
        $this->ORDER_BY->PlaceHolder = RemoveHtml($this->ORDER_BY->caption());

        // ORDER_VALUE
        $this->ORDER_VALUE->EditAttrs["class"] = "form-control";
        $this->ORDER_VALUE->EditCustomAttributes = "";
        $this->ORDER_VALUE->EditValue = $this->ORDER_VALUE->CurrentValue;
        $this->ORDER_VALUE->PlaceHolder = RemoveHtml($this->ORDER_VALUE->caption());
        if (strval($this->ORDER_VALUE->EditValue) != "" && is_numeric($this->ORDER_VALUE->EditValue)) {
            $this->ORDER_VALUE->EditValue = FormatNumber($this->ORDER_VALUE->EditValue, -2, -2, -2, -2);
        }

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->EditAttrs["class"] = "form-control";
        $this->RECEIVED_VALUE->EditCustomAttributes = "";
        $this->RECEIVED_VALUE->EditValue = $this->RECEIVED_VALUE->CurrentValue;
        $this->RECEIVED_VALUE->PlaceHolder = RemoveHtml($this->RECEIVED_VALUE->caption());
        if (strval($this->RECEIVED_VALUE->EditValue) != "" && is_numeric($this->RECEIVED_VALUE->EditValue)) {
            $this->RECEIVED_VALUE->EditValue = FormatNumber($this->RECEIVED_VALUE->EditValue, -2, -2, -2, -2);
        }

        // RECEIVED_BY
        $this->RECEIVED_BY->EditAttrs["class"] = "form-control";
        $this->RECEIVED_BY->EditCustomAttributes = "";
        if (!$this->RECEIVED_BY->Raw) {
            $this->RECEIVED_BY->CurrentValue = HtmlDecode($this->RECEIVED_BY->CurrentValue);
        }
        $this->RECEIVED_BY->EditValue = $this->RECEIVED_BY->CurrentValue;
        $this->RECEIVED_BY->PlaceHolder = RemoveHtml($this->RECEIVED_BY->caption());

        // DOC_NO
        $this->DOC_NO->EditAttrs["class"] = "form-control";
        $this->DOC_NO->EditCustomAttributes = "";
        if (!$this->DOC_NO->Raw) {
            $this->DOC_NO->CurrentValue = HtmlDecode($this->DOC_NO->CurrentValue);
        }
        $this->DOC_NO->EditValue = $this->DOC_NO->CurrentValue;
        $this->DOC_NO->PlaceHolder = RemoveHtml($this->DOC_NO->caption());

        // ACCEPTED_BY
        $this->ACCEPTED_BY->EditAttrs["class"] = "form-control";
        $this->ACCEPTED_BY->EditCustomAttributes = "";
        if (!$this->ACCEPTED_BY->Raw) {
            $this->ACCEPTED_BY->CurrentValue = HtmlDecode($this->ACCEPTED_BY->CurrentValue);
        }
        $this->ACCEPTED_BY->EditValue = $this->ACCEPTED_BY->CurrentValue;
        $this->ACCEPTED_BY->PlaceHolder = RemoveHtml($this->ACCEPTED_BY->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // FINANCE_ID
        $this->FINANCE_ID->EditAttrs["class"] = "form-control";
        $this->FINANCE_ID->EditCustomAttributes = "";
        $this->FINANCE_ID->EditValue = $this->FINANCE_ID->CurrentValue;
        $this->FINANCE_ID->PlaceHolder = RemoveHtml($this->FINANCE_ID->caption());

        // ATP_DATE
        $this->ATP_DATE->EditAttrs["class"] = "form-control";
        $this->ATP_DATE->EditCustomAttributes = "";
        $this->ATP_DATE->EditValue = FormatDateTime($this->ATP_DATE->CurrentValue, 8);
        $this->ATP_DATE->PlaceHolder = RemoveHtml($this->ATP_DATE->caption());

        // DELIVERY_DATE
        $this->DELIVERY_DATE->EditAttrs["class"] = "form-control";
        $this->DELIVERY_DATE->EditCustomAttributes = "";
        $this->DELIVERY_DATE->EditValue = FormatDateTime($this->DELIVERY_DATE->CurrentValue, 8);
        $this->DELIVERY_DATE->PlaceHolder = RemoveHtml($this->DELIVERY_DATE->caption());

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

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

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
                    $doc->exportCaption($this->ORDER_ID);
                    $doc->exportCaption($this->ORG_UNIT_FROM);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ORDER_DATE);
                    $doc->exportCaption($this->ORDER_BY);
                    $doc->exportCaption($this->ORDER_VALUE);
                    $doc->exportCaption($this->RECEIVED_VALUE);
                    $doc->exportCaption($this->RECEIVED_BY);
                    $doc->exportCaption($this->DOC_NO);
                    $doc->exportCaption($this->ACCEPTED_BY);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->FINANCE_ID);
                    $doc->exportCaption($this->ATP_DATE);
                    $doc->exportCaption($this->DELIVERY_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->CLINIC_ID);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->ORDER_ID);
                    $doc->exportCaption($this->ORG_UNIT_FROM);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ORDER_DATE);
                    $doc->exportCaption($this->ORDER_BY);
                    $doc->exportCaption($this->ORDER_VALUE);
                    $doc->exportCaption($this->RECEIVED_VALUE);
                    $doc->exportCaption($this->RECEIVED_BY);
                    $doc->exportCaption($this->DOC_NO);
                    $doc->exportCaption($this->ACCEPTED_BY);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->FINANCE_ID);
                    $doc->exportCaption($this->ATP_DATE);
                    $doc->exportCaption($this->DELIVERY_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->CLINIC_ID);
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
                        $doc->exportField($this->ORDER_ID);
                        $doc->exportField($this->ORG_UNIT_FROM);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ORDER_DATE);
                        $doc->exportField($this->ORDER_BY);
                        $doc->exportField($this->ORDER_VALUE);
                        $doc->exportField($this->RECEIVED_VALUE);
                        $doc->exportField($this->RECEIVED_BY);
                        $doc->exportField($this->DOC_NO);
                        $doc->exportField($this->ACCEPTED_BY);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->FINANCE_ID);
                        $doc->exportField($this->ATP_DATE);
                        $doc->exportField($this->DELIVERY_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->CLINIC_ID);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->ORDER_ID);
                        $doc->exportField($this->ORG_UNIT_FROM);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ORDER_DATE);
                        $doc->exportField($this->ORDER_BY);
                        $doc->exportField($this->ORDER_VALUE);
                        $doc->exportField($this->RECEIVED_VALUE);
                        $doc->exportField($this->RECEIVED_BY);
                        $doc->exportField($this->DOC_NO);
                        $doc->exportField($this->ACCEPTED_BY);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->FINANCE_ID);
                        $doc->exportField($this->ATP_DATE);
                        $doc->exportField($this->DELIVERY_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->CLINIC_ID);
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
