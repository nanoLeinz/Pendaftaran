<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for COMPANY_GOODS
 */
class CompanyGoods extends DbTable
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
    public $BRAND_ID;
    public $COMPANY_ID;
    public $PRICE;
    public $ORDER_PRICE;
    public $QUANTITY;
    public $DISCOUNT;
    public $STARDATE;
    public $ENDDATE;
    public $CONTRACT_NO;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $LEADTIME;
    public $SIZE_KEMASAN;
    public $MEASURE_ID2;
    public $SIZE_GOODS;
    public $MEASURE_ID3;
    public $MEASURE_ID;
    public $BRAND_NAME;
    public $DISCOUNTOFF;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'COMPANY_GOODS';
        $this->TableName = 'COMPANY_GOODS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[COMPANY_GOODS]";
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
        $this->ORG_UNIT_CODE = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // BRAND_ID
        $this->BRAND_ID = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_BRAND_ID', 'BRAND_ID', '[BRAND_ID]', '[BRAND_ID]', 200, 50, -1, false, '[BRAND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_ID->IsPrimaryKey = true; // Primary key field
        $this->BRAND_ID->Nullable = false; // NOT NULL field
        $this->BRAND_ID->Required = true; // Required field
        $this->BRAND_ID->Sortable = true; // Allow sort
        $this->BRAND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_ID->Param, "CustomMsg");
        $this->Fields['BRAND_ID'] = &$this->BRAND_ID;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->IsPrimaryKey = true; // Primary key field
        $this->COMPANY_ID->Nullable = false; // NOT NULL field
        $this->COMPANY_ID->Required = true; // Required field
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // PRICE
        $this->PRICE = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_PRICE', 'PRICE', '[PRICE]', 'CAST([PRICE] AS NVARCHAR)', 6, 8, -1, false, '[PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRICE->Sortable = true; // Allow sort
        $this->PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRICE->Param, "CustomMsg");
        $this->Fields['PRICE'] = &$this->PRICE;

        // ORDER_PRICE
        $this->ORDER_PRICE = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_ORDER_PRICE', 'ORDER_PRICE', '[ORDER_PRICE]', 'CAST([ORDER_PRICE] AS NVARCHAR)', 6, 8, -1, false, '[ORDER_PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORDER_PRICE->Sortable = true; // Allow sort
        $this->ORDER_PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ORDER_PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ORDER_PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORDER_PRICE->Param, "CustomMsg");
        $this->Fields['ORDER_PRICE'] = &$this->ORDER_PRICE;

        // QUANTITY
        $this->QUANTITY = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_QUANTITY', 'QUANTITY', '[QUANTITY]', 'CAST([QUANTITY] AS NVARCHAR)', 131, 8, -1, false, '[QUANTITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->QUANTITY->Sortable = true; // Allow sort
        $this->QUANTITY->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->QUANTITY->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->QUANTITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->QUANTITY->Param, "CustomMsg");
        $this->Fields['QUANTITY'] = &$this->QUANTITY;

        // DISCOUNT
        $this->DISCOUNT = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_DISCOUNT', 'DISCOUNT', '[DISCOUNT]', 'CAST([DISCOUNT] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT->Sortable = true; // Allow sort
        $this->DISCOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT->Param, "CustomMsg");
        $this->Fields['DISCOUNT'] = &$this->DISCOUNT;

        // STARDATE
        $this->STARDATE = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_STARDATE', 'STARDATE', '[STARDATE]', CastDateFieldForLike("[STARDATE]", 0, "DB"), 135, 8, 0, false, '[STARDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STARDATE->Sortable = true; // Allow sort
        $this->STARDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->STARDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STARDATE->Param, "CustomMsg");
        $this->Fields['STARDATE'] = &$this->STARDATE;

        // ENDDATE
        $this->ENDDATE = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_ENDDATE', 'ENDDATE', '[ENDDATE]', CastDateFieldForLike("[ENDDATE]", 0, "DB"), 135, 8, 0, false, '[ENDDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ENDDATE->Sortable = true; // Allow sort
        $this->ENDDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->ENDDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ENDDATE->Param, "CustomMsg");
        $this->Fields['ENDDATE'] = &$this->ENDDATE;

        // CONTRACT_NO
        $this->CONTRACT_NO = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_CONTRACT_NO', 'CONTRACT_NO', '[CONTRACT_NO]', '[CONTRACT_NO]', 200, 50, -1, false, '[CONTRACT_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRACT_NO->Sortable = true; // Allow sort
        $this->CONTRACT_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRACT_NO->Param, "CustomMsg");
        $this->Fields['CONTRACT_NO'] = &$this->CONTRACT_NO;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // LEADTIME
        $this->LEADTIME = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_LEADTIME', 'LEADTIME', '[LEADTIME]', 'CAST([LEADTIME] AS NVARCHAR)', 3, 4, -1, false, '[LEADTIME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LEADTIME->Sortable = true; // Allow sort
        $this->LEADTIME->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->LEADTIME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LEADTIME->Param, "CustomMsg");
        $this->Fields['LEADTIME'] = &$this->LEADTIME;

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_SIZE_KEMASAN', 'SIZE_KEMASAN', '[SIZE_KEMASAN]', 'CAST([SIZE_KEMASAN] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_KEMASAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_KEMASAN->Sortable = true; // Allow sort
        $this->SIZE_KEMASAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_KEMASAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_KEMASAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_KEMASAN->Param, "CustomMsg");
        $this->Fields['SIZE_KEMASAN'] = &$this->SIZE_KEMASAN;

        // MEASURE_ID2
        $this->MEASURE_ID2 = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_MEASURE_ID2', 'MEASURE_ID2', '[MEASURE_ID2]', 'CAST([MEASURE_ID2] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID2->Sortable = true; // Allow sort
        $this->MEASURE_ID2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID2->Param, "CustomMsg");
        $this->Fields['MEASURE_ID2'] = &$this->MEASURE_ID2;

        // SIZE_GOODS
        $this->SIZE_GOODS = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_SIZE_GOODS', 'SIZE_GOODS', '[SIZE_GOODS]', 'CAST([SIZE_GOODS] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_GOODS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_GOODS->Sortable = true; // Allow sort
        $this->SIZE_GOODS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_GOODS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_GOODS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_GOODS->Param, "CustomMsg");
        $this->Fields['SIZE_GOODS'] = &$this->SIZE_GOODS;

        // MEASURE_ID3
        $this->MEASURE_ID3 = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_MEASURE_ID3', 'MEASURE_ID3', '[MEASURE_ID3]', 'CAST([MEASURE_ID3] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID3->Sortable = true; // Allow sort
        $this->MEASURE_ID3->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID3->Param, "CustomMsg");
        $this->Fields['MEASURE_ID3'] = &$this->MEASURE_ID3;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // BRAND_NAME
        $this->BRAND_NAME = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_BRAND_NAME', 'BRAND_NAME', '[BRAND_NAME]', '[BRAND_NAME]', 200, 150, -1, false, '[BRAND_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_NAME->Sortable = true; // Allow sort
        $this->BRAND_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_NAME->Param, "CustomMsg");
        $this->Fields['BRAND_NAME'] = &$this->BRAND_NAME;

        // DISCOUNTOFF
        $this->DISCOUNTOFF = new DbField('COMPANY_GOODS', 'COMPANY_GOODS', 'x_DISCOUNTOFF', 'DISCOUNTOFF', '[DISCOUNTOFF]', 'CAST([DISCOUNTOFF] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNTOFF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNTOFF->Sortable = true; // Allow sort
        $this->DISCOUNTOFF->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNTOFF->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNTOFF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNTOFF->Param, "CustomMsg");
        $this->Fields['DISCOUNTOFF'] = &$this->DISCOUNTOFF;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[COMPANY_GOODS]";
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
            if (array_key_exists('BRAND_ID', $rs)) {
                AddFilter($where, QuotedName('BRAND_ID', $this->Dbid) . '=' . QuotedValue($rs['BRAND_ID'], $this->BRAND_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('COMPANY_ID', $rs)) {
                AddFilter($where, QuotedName('COMPANY_ID', $this->Dbid) . '=' . QuotedValue($rs['COMPANY_ID'], $this->COMPANY_ID->DataType, $this->Dbid));
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
        $this->BRAND_ID->DbValue = $row['BRAND_ID'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->PRICE->DbValue = $row['PRICE'];
        $this->ORDER_PRICE->DbValue = $row['ORDER_PRICE'];
        $this->QUANTITY->DbValue = $row['QUANTITY'];
        $this->DISCOUNT->DbValue = $row['DISCOUNT'];
        $this->STARDATE->DbValue = $row['STARDATE'];
        $this->ENDDATE->DbValue = $row['ENDDATE'];
        $this->CONTRACT_NO->DbValue = $row['CONTRACT_NO'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->LEADTIME->DbValue = $row['LEADTIME'];
        $this->SIZE_KEMASAN->DbValue = $row['SIZE_KEMASAN'];
        $this->MEASURE_ID2->DbValue = $row['MEASURE_ID2'];
        $this->SIZE_GOODS->DbValue = $row['SIZE_GOODS'];
        $this->MEASURE_ID3->DbValue = $row['MEASURE_ID3'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->BRAND_NAME->DbValue = $row['BRAND_NAME'];
        $this->DISCOUNTOFF->DbValue = $row['DISCOUNTOFF'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [BRAND_ID] = '@BRAND_ID@' AND [COMPANY_ID] = '@COMPANY_ID@'";
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
        $val = $current ? $this->BRAND_ID->CurrentValue : $this->BRAND_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->COMPANY_ID->CurrentValue : $this->COMPANY_ID->OldValue;
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
        if (count($keys) == 3) {
            if ($current) {
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
            }
            if ($current) {
                $this->BRAND_ID->CurrentValue = $keys[1];
            } else {
                $this->BRAND_ID->OldValue = $keys[1];
            }
            if ($current) {
                $this->COMPANY_ID->CurrentValue = $keys[2];
            } else {
                $this->COMPANY_ID->OldValue = $keys[2];
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
            $val = array_key_exists('BRAND_ID', $row) ? $row['BRAND_ID'] : null;
        } else {
            $val = $this->BRAND_ID->OldValue !== null ? $this->BRAND_ID->OldValue : $this->BRAND_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@BRAND_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('COMPANY_ID', $row) ? $row['COMPANY_ID'] : null;
        } else {
            $val = $this->COMPANY_ID->OldValue !== null ? $this->COMPANY_ID->OldValue : $this->COMPANY_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@COMPANY_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("CompanyGoodsList");
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
        if ($pageName == "CompanyGoodsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CompanyGoodsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CompanyGoodsAdd") {
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
                return "CompanyGoodsView";
            case Config("API_ADD_ACTION"):
                return "CompanyGoodsAdd";
            case Config("API_EDIT_ACTION"):
                return "CompanyGoodsEdit";
            case Config("API_DELETE_ACTION"):
                return "CompanyGoodsDelete";
            case Config("API_LIST_ACTION"):
                return "CompanyGoodsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CompanyGoodsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CompanyGoodsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CompanyGoodsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CompanyGoodsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CompanyGoodsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CompanyGoodsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CompanyGoodsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CompanyGoodsDelete", $this->getUrlParm());
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
        $json .= ",BRAND_ID:" . JsonEncode($this->BRAND_ID->CurrentValue, "string");
        $json .= ",COMPANY_ID:" . JsonEncode($this->COMPANY_ID->CurrentValue, "string");
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
        if ($this->BRAND_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BRAND_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->COMPANY_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->COMPANY_ID->CurrentValue);
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
            if (($keyValue = Param("BRAND_ID") ?? Route("BRAND_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("COMPANY_ID") ?? Route("COMPANY_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(2) ?? Route(4)) !== null)) {
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
                if (!is_array($key) || count($key) != 3) {
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
                $this->BRAND_ID->CurrentValue = $key[1];
            } else {
                $this->BRAND_ID->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->COMPANY_ID->CurrentValue = $key[2];
            } else {
                $this->COMPANY_ID->OldValue = $key[2];
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
        $this->BRAND_ID->setDbValue($row['BRAND_ID']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->PRICE->setDbValue($row['PRICE']);
        $this->ORDER_PRICE->setDbValue($row['ORDER_PRICE']);
        $this->QUANTITY->setDbValue($row['QUANTITY']);
        $this->DISCOUNT->setDbValue($row['DISCOUNT']);
        $this->STARDATE->setDbValue($row['STARDATE']);
        $this->ENDDATE->setDbValue($row['ENDDATE']);
        $this->CONTRACT_NO->setDbValue($row['CONTRACT_NO']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->LEADTIME->setDbValue($row['LEADTIME']);
        $this->SIZE_KEMASAN->setDbValue($row['SIZE_KEMASAN']);
        $this->MEASURE_ID2->setDbValue($row['MEASURE_ID2']);
        $this->SIZE_GOODS->setDbValue($row['SIZE_GOODS']);
        $this->MEASURE_ID3->setDbValue($row['MEASURE_ID3']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->BRAND_NAME->setDbValue($row['BRAND_NAME']);
        $this->DISCOUNTOFF->setDbValue($row['DISCOUNTOFF']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // BRAND_ID

        // COMPANY_ID

        // PRICE

        // ORDER_PRICE

        // QUANTITY

        // DISCOUNT

        // STARDATE

        // ENDDATE

        // CONTRACT_NO

        // MODIFIED_DATE

        // MODIFIED_BY

        // LEADTIME

        // SIZE_KEMASAN

        // MEASURE_ID2

        // SIZE_GOODS

        // MEASURE_ID3

        // MEASURE_ID

        // BRAND_NAME

        // DISCOUNTOFF

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // BRAND_ID
        $this->BRAND_ID->ViewValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // PRICE
        $this->PRICE->ViewValue = $this->PRICE->CurrentValue;
        $this->PRICE->ViewValue = FormatNumber($this->PRICE->ViewValue, 2, -2, -2, -2);
        $this->PRICE->ViewCustomAttributes = "";

        // ORDER_PRICE
        $this->ORDER_PRICE->ViewValue = $this->ORDER_PRICE->CurrentValue;
        $this->ORDER_PRICE->ViewValue = FormatNumber($this->ORDER_PRICE->ViewValue, 2, -2, -2, -2);
        $this->ORDER_PRICE->ViewCustomAttributes = "";

        // QUANTITY
        $this->QUANTITY->ViewValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->ViewValue = FormatNumber($this->QUANTITY->ViewValue, 2, -2, -2, -2);
        $this->QUANTITY->ViewCustomAttributes = "";

        // DISCOUNT
        $this->DISCOUNT->ViewValue = $this->DISCOUNT->CurrentValue;
        $this->DISCOUNT->ViewValue = FormatNumber($this->DISCOUNT->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT->ViewCustomAttributes = "";

        // STARDATE
        $this->STARDATE->ViewValue = $this->STARDATE->CurrentValue;
        $this->STARDATE->ViewValue = FormatDateTime($this->STARDATE->ViewValue, 0);
        $this->STARDATE->ViewCustomAttributes = "";

        // ENDDATE
        $this->ENDDATE->ViewValue = $this->ENDDATE->CurrentValue;
        $this->ENDDATE->ViewValue = FormatDateTime($this->ENDDATE->ViewValue, 0);
        $this->ENDDATE->ViewCustomAttributes = "";

        // CONTRACT_NO
        $this->CONTRACT_NO->ViewValue = $this->CONTRACT_NO->CurrentValue;
        $this->CONTRACT_NO->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // LEADTIME
        $this->LEADTIME->ViewValue = $this->LEADTIME->CurrentValue;
        $this->LEADTIME->ViewValue = FormatNumber($this->LEADTIME->ViewValue, 0, -2, -2, -2);
        $this->LEADTIME->ViewCustomAttributes = "";

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->ViewValue = $this->SIZE_KEMASAN->CurrentValue;
        $this->SIZE_KEMASAN->ViewValue = FormatNumber($this->SIZE_KEMASAN->ViewValue, 2, -2, -2, -2);
        $this->SIZE_KEMASAN->ViewCustomAttributes = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->ViewValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->ViewValue = FormatNumber($this->MEASURE_ID2->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID2->ViewCustomAttributes = "";

        // SIZE_GOODS
        $this->SIZE_GOODS->ViewValue = $this->SIZE_GOODS->CurrentValue;
        $this->SIZE_GOODS->ViewValue = FormatNumber($this->SIZE_GOODS->ViewValue, 2, -2, -2, -2);
        $this->SIZE_GOODS->ViewCustomAttributes = "";

        // MEASURE_ID3
        $this->MEASURE_ID3->ViewValue = $this->MEASURE_ID3->CurrentValue;
        $this->MEASURE_ID3->ViewValue = FormatNumber($this->MEASURE_ID3->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID3->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // BRAND_NAME
        $this->BRAND_NAME->ViewValue = $this->BRAND_NAME->CurrentValue;
        $this->BRAND_NAME->ViewCustomAttributes = "";

        // DISCOUNTOFF
        $this->DISCOUNTOFF->ViewValue = $this->DISCOUNTOFF->CurrentValue;
        $this->DISCOUNTOFF->ViewValue = FormatNumber($this->DISCOUNTOFF->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNTOFF->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // BRAND_ID
        $this->BRAND_ID->LinkCustomAttributes = "";
        $this->BRAND_ID->HrefValue = "";
        $this->BRAND_ID->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // PRICE
        $this->PRICE->LinkCustomAttributes = "";
        $this->PRICE->HrefValue = "";
        $this->PRICE->TooltipValue = "";

        // ORDER_PRICE
        $this->ORDER_PRICE->LinkCustomAttributes = "";
        $this->ORDER_PRICE->HrefValue = "";
        $this->ORDER_PRICE->TooltipValue = "";

        // QUANTITY
        $this->QUANTITY->LinkCustomAttributes = "";
        $this->QUANTITY->HrefValue = "";
        $this->QUANTITY->TooltipValue = "";

        // DISCOUNT
        $this->DISCOUNT->LinkCustomAttributes = "";
        $this->DISCOUNT->HrefValue = "";
        $this->DISCOUNT->TooltipValue = "";

        // STARDATE
        $this->STARDATE->LinkCustomAttributes = "";
        $this->STARDATE->HrefValue = "";
        $this->STARDATE->TooltipValue = "";

        // ENDDATE
        $this->ENDDATE->LinkCustomAttributes = "";
        $this->ENDDATE->HrefValue = "";
        $this->ENDDATE->TooltipValue = "";

        // CONTRACT_NO
        $this->CONTRACT_NO->LinkCustomAttributes = "";
        $this->CONTRACT_NO->HrefValue = "";
        $this->CONTRACT_NO->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // LEADTIME
        $this->LEADTIME->LinkCustomAttributes = "";
        $this->LEADTIME->HrefValue = "";
        $this->LEADTIME->TooltipValue = "";

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->LinkCustomAttributes = "";
        $this->SIZE_KEMASAN->HrefValue = "";
        $this->SIZE_KEMASAN->TooltipValue = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->LinkCustomAttributes = "";
        $this->MEASURE_ID2->HrefValue = "";
        $this->MEASURE_ID2->TooltipValue = "";

        // SIZE_GOODS
        $this->SIZE_GOODS->LinkCustomAttributes = "";
        $this->SIZE_GOODS->HrefValue = "";
        $this->SIZE_GOODS->TooltipValue = "";

        // MEASURE_ID3
        $this->MEASURE_ID3->LinkCustomAttributes = "";
        $this->MEASURE_ID3->HrefValue = "";
        $this->MEASURE_ID3->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // BRAND_NAME
        $this->BRAND_NAME->LinkCustomAttributes = "";
        $this->BRAND_NAME->HrefValue = "";
        $this->BRAND_NAME->TooltipValue = "";

        // DISCOUNTOFF
        $this->DISCOUNTOFF->LinkCustomAttributes = "";
        $this->DISCOUNTOFF->HrefValue = "";
        $this->DISCOUNTOFF->TooltipValue = "";

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

        // BRAND_ID
        $this->BRAND_ID->EditAttrs["class"] = "form-control";
        $this->BRAND_ID->EditCustomAttributes = "";
        if (!$this->BRAND_ID->Raw) {
            $this->BRAND_ID->CurrentValue = HtmlDecode($this->BRAND_ID->CurrentValue);
        }
        $this->BRAND_ID->EditValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->PlaceHolder = RemoveHtml($this->BRAND_ID->caption());

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // PRICE
        $this->PRICE->EditAttrs["class"] = "form-control";
        $this->PRICE->EditCustomAttributes = "";
        $this->PRICE->EditValue = $this->PRICE->CurrentValue;
        $this->PRICE->PlaceHolder = RemoveHtml($this->PRICE->caption());
        if (strval($this->PRICE->EditValue) != "" && is_numeric($this->PRICE->EditValue)) {
            $this->PRICE->EditValue = FormatNumber($this->PRICE->EditValue, -2, -2, -2, -2);
        }

        // ORDER_PRICE
        $this->ORDER_PRICE->EditAttrs["class"] = "form-control";
        $this->ORDER_PRICE->EditCustomAttributes = "";
        $this->ORDER_PRICE->EditValue = $this->ORDER_PRICE->CurrentValue;
        $this->ORDER_PRICE->PlaceHolder = RemoveHtml($this->ORDER_PRICE->caption());
        if (strval($this->ORDER_PRICE->EditValue) != "" && is_numeric($this->ORDER_PRICE->EditValue)) {
            $this->ORDER_PRICE->EditValue = FormatNumber($this->ORDER_PRICE->EditValue, -2, -2, -2, -2);
        }

        // QUANTITY
        $this->QUANTITY->EditAttrs["class"] = "form-control";
        $this->QUANTITY->EditCustomAttributes = "";
        $this->QUANTITY->EditValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->PlaceHolder = RemoveHtml($this->QUANTITY->caption());
        if (strval($this->QUANTITY->EditValue) != "" && is_numeric($this->QUANTITY->EditValue)) {
            $this->QUANTITY->EditValue = FormatNumber($this->QUANTITY->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT
        $this->DISCOUNT->EditAttrs["class"] = "form-control";
        $this->DISCOUNT->EditCustomAttributes = "";
        $this->DISCOUNT->EditValue = $this->DISCOUNT->CurrentValue;
        $this->DISCOUNT->PlaceHolder = RemoveHtml($this->DISCOUNT->caption());
        if (strval($this->DISCOUNT->EditValue) != "" && is_numeric($this->DISCOUNT->EditValue)) {
            $this->DISCOUNT->EditValue = FormatNumber($this->DISCOUNT->EditValue, -2, -2, -2, -2);
        }

        // STARDATE
        $this->STARDATE->EditAttrs["class"] = "form-control";
        $this->STARDATE->EditCustomAttributes = "";
        $this->STARDATE->EditValue = FormatDateTime($this->STARDATE->CurrentValue, 8);
        $this->STARDATE->PlaceHolder = RemoveHtml($this->STARDATE->caption());

        // ENDDATE
        $this->ENDDATE->EditAttrs["class"] = "form-control";
        $this->ENDDATE->EditCustomAttributes = "";
        $this->ENDDATE->EditValue = FormatDateTime($this->ENDDATE->CurrentValue, 8);
        $this->ENDDATE->PlaceHolder = RemoveHtml($this->ENDDATE->caption());

        // CONTRACT_NO
        $this->CONTRACT_NO->EditAttrs["class"] = "form-control";
        $this->CONTRACT_NO->EditCustomAttributes = "";
        if (!$this->CONTRACT_NO->Raw) {
            $this->CONTRACT_NO->CurrentValue = HtmlDecode($this->CONTRACT_NO->CurrentValue);
        }
        $this->CONTRACT_NO->EditValue = $this->CONTRACT_NO->CurrentValue;
        $this->CONTRACT_NO->PlaceHolder = RemoveHtml($this->CONTRACT_NO->caption());

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

        // LEADTIME
        $this->LEADTIME->EditAttrs["class"] = "form-control";
        $this->LEADTIME->EditCustomAttributes = "";
        $this->LEADTIME->EditValue = $this->LEADTIME->CurrentValue;
        $this->LEADTIME->PlaceHolder = RemoveHtml($this->LEADTIME->caption());

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->EditAttrs["class"] = "form-control";
        $this->SIZE_KEMASAN->EditCustomAttributes = "";
        $this->SIZE_KEMASAN->EditValue = $this->SIZE_KEMASAN->CurrentValue;
        $this->SIZE_KEMASAN->PlaceHolder = RemoveHtml($this->SIZE_KEMASAN->caption());
        if (strval($this->SIZE_KEMASAN->EditValue) != "" && is_numeric($this->SIZE_KEMASAN->EditValue)) {
            $this->SIZE_KEMASAN->EditValue = FormatNumber($this->SIZE_KEMASAN->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_ID2
        $this->MEASURE_ID2->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID2->EditCustomAttributes = "";
        $this->MEASURE_ID2->EditValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->PlaceHolder = RemoveHtml($this->MEASURE_ID2->caption());

        // SIZE_GOODS
        $this->SIZE_GOODS->EditAttrs["class"] = "form-control";
        $this->SIZE_GOODS->EditCustomAttributes = "";
        $this->SIZE_GOODS->EditValue = $this->SIZE_GOODS->CurrentValue;
        $this->SIZE_GOODS->PlaceHolder = RemoveHtml($this->SIZE_GOODS->caption());
        if (strval($this->SIZE_GOODS->EditValue) != "" && is_numeric($this->SIZE_GOODS->EditValue)) {
            $this->SIZE_GOODS->EditValue = FormatNumber($this->SIZE_GOODS->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_ID3
        $this->MEASURE_ID3->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID3->EditCustomAttributes = "";
        $this->MEASURE_ID3->EditValue = $this->MEASURE_ID3->CurrentValue;
        $this->MEASURE_ID3->PlaceHolder = RemoveHtml($this->MEASURE_ID3->caption());

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // BRAND_NAME
        $this->BRAND_NAME->EditAttrs["class"] = "form-control";
        $this->BRAND_NAME->EditCustomAttributes = "";
        if (!$this->BRAND_NAME->Raw) {
            $this->BRAND_NAME->CurrentValue = HtmlDecode($this->BRAND_NAME->CurrentValue);
        }
        $this->BRAND_NAME->EditValue = $this->BRAND_NAME->CurrentValue;
        $this->BRAND_NAME->PlaceHolder = RemoveHtml($this->BRAND_NAME->caption());

        // DISCOUNTOFF
        $this->DISCOUNTOFF->EditAttrs["class"] = "form-control";
        $this->DISCOUNTOFF->EditCustomAttributes = "";
        $this->DISCOUNTOFF->EditValue = $this->DISCOUNTOFF->CurrentValue;
        $this->DISCOUNTOFF->PlaceHolder = RemoveHtml($this->DISCOUNTOFF->caption());
        if (strval($this->DISCOUNTOFF->EditValue) != "" && is_numeric($this->DISCOUNTOFF->EditValue)) {
            $this->DISCOUNTOFF->EditValue = FormatNumber($this->DISCOUNTOFF->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->PRICE);
                    $doc->exportCaption($this->ORDER_PRICE);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->DISCOUNT);
                    $doc->exportCaption($this->STARDATE);
                    $doc->exportCaption($this->ENDDATE);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->LEADTIME);
                    $doc->exportCaption($this->SIZE_KEMASAN);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->SIZE_GOODS);
                    $doc->exportCaption($this->MEASURE_ID3);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->BRAND_NAME);
                    $doc->exportCaption($this->DISCOUNTOFF);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->PRICE);
                    $doc->exportCaption($this->ORDER_PRICE);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->DISCOUNT);
                    $doc->exportCaption($this->STARDATE);
                    $doc->exportCaption($this->ENDDATE);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->LEADTIME);
                    $doc->exportCaption($this->SIZE_KEMASAN);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->SIZE_GOODS);
                    $doc->exportCaption($this->MEASURE_ID3);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->BRAND_NAME);
                    $doc->exportCaption($this->DISCOUNTOFF);
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
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->PRICE);
                        $doc->exportField($this->ORDER_PRICE);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->DISCOUNT);
                        $doc->exportField($this->STARDATE);
                        $doc->exportField($this->ENDDATE);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->LEADTIME);
                        $doc->exportField($this->SIZE_KEMASAN);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->SIZE_GOODS);
                        $doc->exportField($this->MEASURE_ID3);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->BRAND_NAME);
                        $doc->exportField($this->DISCOUNTOFF);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->PRICE);
                        $doc->exportField($this->ORDER_PRICE);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->DISCOUNT);
                        $doc->exportField($this->STARDATE);
                        $doc->exportField($this->ENDDATE);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->LEADTIME);
                        $doc->exportField($this->SIZE_KEMASAN);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->SIZE_GOODS);
                        $doc->exportField($this->MEASURE_ID3);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->BRAND_NAME);
                        $doc->exportField($this->DISCOUNTOFF);
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
