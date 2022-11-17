<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for PAYMENT_PO
 */
class PaymentPo extends DbTable
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
    public $PAY_ID;
    public $INVOICE_ID;
    public $PAY_DATE;
    public $AMOUNT;
    public $DISCOUNT;
    public $CORRECTION;
    public $CORRECTION_ID;
    public $PAY_METHOD_ID;
    public $POSTING;
    public $BANK_ID;
    public $TRANSACT_BY;
    public $ISVALID;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $quantity;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'PAYMENT_PO';
        $this->TableName = 'PAYMENT_PO';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[PAYMENT_PO]";
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
        $this->ORG_UNIT_CODE = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // PAY_ID
        $this->PAY_ID = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_PAY_ID', 'PAY_ID', '[PAY_ID]', '[PAY_ID]', 200, 50, -1, false, '[PAY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAY_ID->IsPrimaryKey = true; // Primary key field
        $this->PAY_ID->Nullable = false; // NOT NULL field
        $this->PAY_ID->Required = true; // Required field
        $this->PAY_ID->Sortable = true; // Allow sort
        $this->PAY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAY_ID->Param, "CustomMsg");
        $this->Fields['PAY_ID'] = &$this->PAY_ID;

        // INVOICE_ID
        $this->INVOICE_ID = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_INVOICE_ID', 'INVOICE_ID', '[INVOICE_ID]', '[INVOICE_ID]', 200, 50, -1, false, '[INVOICE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_ID->Sortable = true; // Allow sort
        $this->INVOICE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_ID->Param, "CustomMsg");
        $this->Fields['INVOICE_ID'] = &$this->INVOICE_ID;

        // PAY_DATE
        $this->PAY_DATE = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_PAY_DATE', 'PAY_DATE', '[PAY_DATE]', CastDateFieldForLike("[PAY_DATE]", 0, "DB"), 135, 8, 0, false, '[PAY_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAY_DATE->Sortable = true; // Allow sort
        $this->PAY_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PAY_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAY_DATE->Param, "CustomMsg");
        $this->Fields['PAY_DATE'] = &$this->PAY_DATE;

        // AMOUNT
        $this->AMOUNT = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = true; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // DISCOUNT
        $this->DISCOUNT = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_DISCOUNT', 'DISCOUNT', '[DISCOUNT]', 'CAST([DISCOUNT] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT->Sortable = true; // Allow sort
        $this->DISCOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT->Param, "CustomMsg");
        $this->Fields['DISCOUNT'] = &$this->DISCOUNT;

        // CORRECTION
        $this->CORRECTION = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_CORRECTION', 'CORRECTION', '[CORRECTION]', 'CAST([CORRECTION] AS NVARCHAR)', 17, 1, -1, false, '[CORRECTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CORRECTION->Sortable = true; // Allow sort
        $this->CORRECTION->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CORRECTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CORRECTION->Param, "CustomMsg");
        $this->Fields['CORRECTION'] = &$this->CORRECTION;

        // CORRECTION_ID
        $this->CORRECTION_ID = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_CORRECTION_ID', 'CORRECTION_ID', '[CORRECTION_ID]', '[CORRECTION_ID]', 200, 50, -1, false, '[CORRECTION_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CORRECTION_ID->Sortable = true; // Allow sort
        $this->CORRECTION_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CORRECTION_ID->Param, "CustomMsg");
        $this->Fields['CORRECTION_ID'] = &$this->CORRECTION_ID;

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_PAY_METHOD_ID', 'PAY_METHOD_ID', '[PAY_METHOD_ID]', 'CAST([PAY_METHOD_ID] AS NVARCHAR)', 17, 1, -1, false, '[PAY_METHOD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAY_METHOD_ID->Sortable = true; // Allow sort
        $this->PAY_METHOD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PAY_METHOD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAY_METHOD_ID->Param, "CustomMsg");
        $this->Fields['PAY_METHOD_ID'] = &$this->PAY_METHOD_ID;

        // POSTING
        $this->POSTING = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_POSTING', 'POSTING', '[POSTING]', 'CAST([POSTING] AS NVARCHAR)', 17, 1, -1, false, '[POSTING]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POSTING->Sortable = true; // Allow sort
        $this->POSTING->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->POSTING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POSTING->Param, "CustomMsg");
        $this->Fields['POSTING'] = &$this->POSTING;

        // BANK_ID
        $this->BANK_ID = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_BANK_ID', 'BANK_ID', '[BANK_ID]', '[BANK_ID]', 200, 15, -1, false, '[BANK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANK_ID->Sortable = true; // Allow sort
        $this->BANK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANK_ID->Param, "CustomMsg");
        $this->Fields['BANK_ID'] = &$this->BANK_ID;

        // TRANSACT_BY
        $this->TRANSACT_BY = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_TRANSACT_BY', 'TRANSACT_BY', '[TRANSACT_BY]', '[TRANSACT_BY]', 200, 100, -1, false, '[TRANSACT_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TRANSACT_BY->Sortable = true; // Allow sort
        $this->TRANSACT_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TRANSACT_BY->Param, "CustomMsg");
        $this->Fields['TRANSACT_BY'] = &$this->TRANSACT_BY;

        // ISVALID
        $this->ISVALID = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_ISVALID', 'ISVALID', '[ISVALID]', '[ISVALID]', 129, 1, -1, false, '[ISVALID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISVALID->Sortable = true; // Allow sort
        $this->ISVALID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISVALID->Param, "CustomMsg");
        $this->Fields['ISVALID'] = &$this->ISVALID;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // quantity
        $this->quantity = new DbField('PAYMENT_PO', 'PAYMENT_PO', 'x_quantity', 'quantity', '[quantity]', 'CAST([quantity] AS NVARCHAR)', 131, 8, -1, false, '[quantity]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->quantity->Sortable = true; // Allow sort
        $this->quantity->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->quantity->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->quantity->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->quantity->Param, "CustomMsg");
        $this->Fields['quantity'] = &$this->quantity;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[PAYMENT_PO]";
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
            if (array_key_exists('PAY_ID', $rs)) {
                AddFilter($where, QuotedName('PAY_ID', $this->Dbid) . '=' . QuotedValue($rs['PAY_ID'], $this->PAY_ID->DataType, $this->Dbid));
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
        $this->PAY_ID->DbValue = $row['PAY_ID'];
        $this->INVOICE_ID->DbValue = $row['INVOICE_ID'];
        $this->PAY_DATE->DbValue = $row['PAY_DATE'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->DISCOUNT->DbValue = $row['DISCOUNT'];
        $this->CORRECTION->DbValue = $row['CORRECTION'];
        $this->CORRECTION_ID->DbValue = $row['CORRECTION_ID'];
        $this->PAY_METHOD_ID->DbValue = $row['PAY_METHOD_ID'];
        $this->POSTING->DbValue = $row['POSTING'];
        $this->BANK_ID->DbValue = $row['BANK_ID'];
        $this->TRANSACT_BY->DbValue = $row['TRANSACT_BY'];
        $this->ISVALID->DbValue = $row['ISVALID'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->quantity->DbValue = $row['quantity'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [PAY_ID] = '@PAY_ID@'";
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
        $val = $current ? $this->PAY_ID->CurrentValue : $this->PAY_ID->OldValue;
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
                $this->PAY_ID->CurrentValue = $keys[1];
            } else {
                $this->PAY_ID->OldValue = $keys[1];
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
            $val = array_key_exists('PAY_ID', $row) ? $row['PAY_ID'] : null;
        } else {
            $val = $this->PAY_ID->OldValue !== null ? $this->PAY_ID->OldValue : $this->PAY_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@PAY_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PaymentPoList");
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
        if ($pageName == "PaymentPoView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PaymentPoEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PaymentPoAdd") {
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
                return "PaymentPoView";
            case Config("API_ADD_ACTION"):
                return "PaymentPoAdd";
            case Config("API_EDIT_ACTION"):
                return "PaymentPoEdit";
            case Config("API_DELETE_ACTION"):
                return "PaymentPoDelete";
            case Config("API_LIST_ACTION"):
                return "PaymentPoList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PaymentPoList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PaymentPoView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PaymentPoView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PaymentPoAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PaymentPoAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PaymentPoEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PaymentPoAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PaymentPoDelete", $this->getUrlParm());
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
        $json .= ",PAY_ID:" . JsonEncode($this->PAY_ID->CurrentValue, "string");
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
        if ($this->PAY_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->PAY_ID->CurrentValue);
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
            if (($keyValue = Param("PAY_ID") ?? Route("PAY_ID")) !== null) {
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
                $this->PAY_ID->CurrentValue = $key[1];
            } else {
                $this->PAY_ID->OldValue = $key[1];
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
        $this->PAY_ID->setDbValue($row['PAY_ID']);
        $this->INVOICE_ID->setDbValue($row['INVOICE_ID']);
        $this->PAY_DATE->setDbValue($row['PAY_DATE']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->DISCOUNT->setDbValue($row['DISCOUNT']);
        $this->CORRECTION->setDbValue($row['CORRECTION']);
        $this->CORRECTION_ID->setDbValue($row['CORRECTION_ID']);
        $this->PAY_METHOD_ID->setDbValue($row['PAY_METHOD_ID']);
        $this->POSTING->setDbValue($row['POSTING']);
        $this->BANK_ID->setDbValue($row['BANK_ID']);
        $this->TRANSACT_BY->setDbValue($row['TRANSACT_BY']);
        $this->ISVALID->setDbValue($row['ISVALID']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->quantity->setDbValue($row['quantity']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // PAY_ID

        // INVOICE_ID

        // PAY_DATE

        // AMOUNT

        // DISCOUNT

        // CORRECTION

        // CORRECTION_ID

        // PAY_METHOD_ID

        // POSTING

        // BANK_ID

        // TRANSACT_BY

        // ISVALID

        // MODIFIED_DATE

        // MODIFIED_BY

        // quantity

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // PAY_ID
        $this->PAY_ID->ViewValue = $this->PAY_ID->CurrentValue;
        $this->PAY_ID->ViewCustomAttributes = "";

        // INVOICE_ID
        $this->INVOICE_ID->ViewValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->ViewCustomAttributes = "";

        // PAY_DATE
        $this->PAY_DATE->ViewValue = $this->PAY_DATE->CurrentValue;
        $this->PAY_DATE->ViewValue = FormatDateTime($this->PAY_DATE->ViewValue, 0);
        $this->PAY_DATE->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // DISCOUNT
        $this->DISCOUNT->ViewValue = $this->DISCOUNT->CurrentValue;
        $this->DISCOUNT->ViewValue = FormatNumber($this->DISCOUNT->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT->ViewCustomAttributes = "";

        // CORRECTION
        $this->CORRECTION->ViewValue = $this->CORRECTION->CurrentValue;
        $this->CORRECTION->ViewValue = FormatNumber($this->CORRECTION->ViewValue, 0, -2, -2, -2);
        $this->CORRECTION->ViewCustomAttributes = "";

        // CORRECTION_ID
        $this->CORRECTION_ID->ViewValue = $this->CORRECTION_ID->CurrentValue;
        $this->CORRECTION_ID->ViewCustomAttributes = "";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->ViewValue = $this->PAY_METHOD_ID->CurrentValue;
        $this->PAY_METHOD_ID->ViewValue = FormatNumber($this->PAY_METHOD_ID->ViewValue, 0, -2, -2, -2);
        $this->PAY_METHOD_ID->ViewCustomAttributes = "";

        // POSTING
        $this->POSTING->ViewValue = $this->POSTING->CurrentValue;
        $this->POSTING->ViewValue = FormatNumber($this->POSTING->ViewValue, 0, -2, -2, -2);
        $this->POSTING->ViewCustomAttributes = "";

        // BANK_ID
        $this->BANK_ID->ViewValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->ViewCustomAttributes = "";

        // TRANSACT_BY
        $this->TRANSACT_BY->ViewValue = $this->TRANSACT_BY->CurrentValue;
        $this->TRANSACT_BY->ViewCustomAttributes = "";

        // ISVALID
        $this->ISVALID->ViewValue = $this->ISVALID->CurrentValue;
        $this->ISVALID->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // quantity
        $this->quantity->ViewValue = $this->quantity->CurrentValue;
        $this->quantity->ViewValue = FormatNumber($this->quantity->ViewValue, 2, -2, -2, -2);
        $this->quantity->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // PAY_ID
        $this->PAY_ID->LinkCustomAttributes = "";
        $this->PAY_ID->HrefValue = "";
        $this->PAY_ID->TooltipValue = "";

        // INVOICE_ID
        $this->INVOICE_ID->LinkCustomAttributes = "";
        $this->INVOICE_ID->HrefValue = "";
        $this->INVOICE_ID->TooltipValue = "";

        // PAY_DATE
        $this->PAY_DATE->LinkCustomAttributes = "";
        $this->PAY_DATE->HrefValue = "";
        $this->PAY_DATE->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // DISCOUNT
        $this->DISCOUNT->LinkCustomAttributes = "";
        $this->DISCOUNT->HrefValue = "";
        $this->DISCOUNT->TooltipValue = "";

        // CORRECTION
        $this->CORRECTION->LinkCustomAttributes = "";
        $this->CORRECTION->HrefValue = "";
        $this->CORRECTION->TooltipValue = "";

        // CORRECTION_ID
        $this->CORRECTION_ID->LinkCustomAttributes = "";
        $this->CORRECTION_ID->HrefValue = "";
        $this->CORRECTION_ID->TooltipValue = "";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->LinkCustomAttributes = "";
        $this->PAY_METHOD_ID->HrefValue = "";
        $this->PAY_METHOD_ID->TooltipValue = "";

        // POSTING
        $this->POSTING->LinkCustomAttributes = "";
        $this->POSTING->HrefValue = "";
        $this->POSTING->TooltipValue = "";

        // BANK_ID
        $this->BANK_ID->LinkCustomAttributes = "";
        $this->BANK_ID->HrefValue = "";
        $this->BANK_ID->TooltipValue = "";

        // TRANSACT_BY
        $this->TRANSACT_BY->LinkCustomAttributes = "";
        $this->TRANSACT_BY->HrefValue = "";
        $this->TRANSACT_BY->TooltipValue = "";

        // ISVALID
        $this->ISVALID->LinkCustomAttributes = "";
        $this->ISVALID->HrefValue = "";
        $this->ISVALID->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // quantity
        $this->quantity->LinkCustomAttributes = "";
        $this->quantity->HrefValue = "";
        $this->quantity->TooltipValue = "";

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

        // PAY_ID
        $this->PAY_ID->EditAttrs["class"] = "form-control";
        $this->PAY_ID->EditCustomAttributes = "";
        if (!$this->PAY_ID->Raw) {
            $this->PAY_ID->CurrentValue = HtmlDecode($this->PAY_ID->CurrentValue);
        }
        $this->PAY_ID->EditValue = $this->PAY_ID->CurrentValue;
        $this->PAY_ID->PlaceHolder = RemoveHtml($this->PAY_ID->caption());

        // INVOICE_ID
        $this->INVOICE_ID->EditAttrs["class"] = "form-control";
        $this->INVOICE_ID->EditCustomAttributes = "";
        if (!$this->INVOICE_ID->Raw) {
            $this->INVOICE_ID->CurrentValue = HtmlDecode($this->INVOICE_ID->CurrentValue);
        }
        $this->INVOICE_ID->EditValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->PlaceHolder = RemoveHtml($this->INVOICE_ID->caption());

        // PAY_DATE
        $this->PAY_DATE->EditAttrs["class"] = "form-control";
        $this->PAY_DATE->EditCustomAttributes = "";
        $this->PAY_DATE->EditValue = FormatDateTime($this->PAY_DATE->CurrentValue, 8);
        $this->PAY_DATE->PlaceHolder = RemoveHtml($this->PAY_DATE->caption());

        // AMOUNT
        $this->AMOUNT->EditAttrs["class"] = "form-control";
        $this->AMOUNT->EditCustomAttributes = "";
        $this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
        if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue)) {
            $this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT
        $this->DISCOUNT->EditAttrs["class"] = "form-control";
        $this->DISCOUNT->EditCustomAttributes = "";
        $this->DISCOUNT->EditValue = $this->DISCOUNT->CurrentValue;
        $this->DISCOUNT->PlaceHolder = RemoveHtml($this->DISCOUNT->caption());
        if (strval($this->DISCOUNT->EditValue) != "" && is_numeric($this->DISCOUNT->EditValue)) {
            $this->DISCOUNT->EditValue = FormatNumber($this->DISCOUNT->EditValue, -2, -2, -2, -2);
        }

        // CORRECTION
        $this->CORRECTION->EditAttrs["class"] = "form-control";
        $this->CORRECTION->EditCustomAttributes = "";
        $this->CORRECTION->EditValue = $this->CORRECTION->CurrentValue;
        $this->CORRECTION->PlaceHolder = RemoveHtml($this->CORRECTION->caption());

        // CORRECTION_ID
        $this->CORRECTION_ID->EditAttrs["class"] = "form-control";
        $this->CORRECTION_ID->EditCustomAttributes = "";
        if (!$this->CORRECTION_ID->Raw) {
            $this->CORRECTION_ID->CurrentValue = HtmlDecode($this->CORRECTION_ID->CurrentValue);
        }
        $this->CORRECTION_ID->EditValue = $this->CORRECTION_ID->CurrentValue;
        $this->CORRECTION_ID->PlaceHolder = RemoveHtml($this->CORRECTION_ID->caption());

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->EditAttrs["class"] = "form-control";
        $this->PAY_METHOD_ID->EditCustomAttributes = "";
        $this->PAY_METHOD_ID->EditValue = $this->PAY_METHOD_ID->CurrentValue;
        $this->PAY_METHOD_ID->PlaceHolder = RemoveHtml($this->PAY_METHOD_ID->caption());

        // POSTING
        $this->POSTING->EditAttrs["class"] = "form-control";
        $this->POSTING->EditCustomAttributes = "";
        $this->POSTING->EditValue = $this->POSTING->CurrentValue;
        $this->POSTING->PlaceHolder = RemoveHtml($this->POSTING->caption());

        // BANK_ID
        $this->BANK_ID->EditAttrs["class"] = "form-control";
        $this->BANK_ID->EditCustomAttributes = "";
        if (!$this->BANK_ID->Raw) {
            $this->BANK_ID->CurrentValue = HtmlDecode($this->BANK_ID->CurrentValue);
        }
        $this->BANK_ID->EditValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->PlaceHolder = RemoveHtml($this->BANK_ID->caption());

        // TRANSACT_BY
        $this->TRANSACT_BY->EditAttrs["class"] = "form-control";
        $this->TRANSACT_BY->EditCustomAttributes = "";
        if (!$this->TRANSACT_BY->Raw) {
            $this->TRANSACT_BY->CurrentValue = HtmlDecode($this->TRANSACT_BY->CurrentValue);
        }
        $this->TRANSACT_BY->EditValue = $this->TRANSACT_BY->CurrentValue;
        $this->TRANSACT_BY->PlaceHolder = RemoveHtml($this->TRANSACT_BY->caption());

        // ISVALID
        $this->ISVALID->EditAttrs["class"] = "form-control";
        $this->ISVALID->EditCustomAttributes = "";
        if (!$this->ISVALID->Raw) {
            $this->ISVALID->CurrentValue = HtmlDecode($this->ISVALID->CurrentValue);
        }
        $this->ISVALID->EditValue = $this->ISVALID->CurrentValue;
        $this->ISVALID->PlaceHolder = RemoveHtml($this->ISVALID->caption());

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

        // quantity
        $this->quantity->EditAttrs["class"] = "form-control";
        $this->quantity->EditCustomAttributes = "";
        $this->quantity->EditValue = $this->quantity->CurrentValue;
        $this->quantity->PlaceHolder = RemoveHtml($this->quantity->caption());
        if (strval($this->quantity->EditValue) != "" && is_numeric($this->quantity->EditValue)) {
            $this->quantity->EditValue = FormatNumber($this->quantity->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->PAY_ID);
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->PAY_DATE);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->DISCOUNT);
                    $doc->exportCaption($this->CORRECTION);
                    $doc->exportCaption($this->CORRECTION_ID);
                    $doc->exportCaption($this->PAY_METHOD_ID);
                    $doc->exportCaption($this->POSTING);
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->TRANSACT_BY);
                    $doc->exportCaption($this->ISVALID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->quantity);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->PAY_ID);
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->PAY_DATE);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->DISCOUNT);
                    $doc->exportCaption($this->CORRECTION);
                    $doc->exportCaption($this->CORRECTION_ID);
                    $doc->exportCaption($this->PAY_METHOD_ID);
                    $doc->exportCaption($this->POSTING);
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->TRANSACT_BY);
                    $doc->exportCaption($this->ISVALID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->quantity);
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
                        $doc->exportField($this->PAY_ID);
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->PAY_DATE);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->DISCOUNT);
                        $doc->exportField($this->CORRECTION);
                        $doc->exportField($this->CORRECTION_ID);
                        $doc->exportField($this->PAY_METHOD_ID);
                        $doc->exportField($this->POSTING);
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->TRANSACT_BY);
                        $doc->exportField($this->ISVALID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->quantity);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->PAY_ID);
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->PAY_DATE);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->DISCOUNT);
                        $doc->exportField($this->CORRECTION);
                        $doc->exportField($this->CORRECTION_ID);
                        $doc->exportField($this->PAY_METHOD_ID);
                        $doc->exportField($this->POSTING);
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->TRANSACT_BY);
                        $doc->exportField($this->ISVALID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->quantity);
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
