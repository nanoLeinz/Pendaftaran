<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for GOODS_ROOMS
 */
class GoodsRooms extends DbTable
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
    public $BRAND_NAME;
    public $ROOMS_ID;
    public $ALLOCATED_DATE;
    public $MEASURE_ID;
    public $PRICE;
    public $AVGPRICE;
    public $STOK_AWAL;
    public $STOCKIN;
    public $STOCKOUT;
    public $DIMINTA;
    public $ISCETAK;
    public $PRINTQ;
    public $PRINTED_BY;
    public $PRINT_DATE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $EXPIRY_DATE;
    public $STOCKININT;
    public $STOCKOUTINT;
    public $idx;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'GOODS_ROOMS';
        $this->TableName = 'GOODS_ROOMS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[GOODS_ROOMS]";
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
        $this->ORG_UNIT_CODE = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // BRAND_ID
        $this->BRAND_ID = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_BRAND_ID', 'BRAND_ID', '[BRAND_ID]', '[BRAND_ID]', 200, 50, -1, false, '[BRAND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_ID->IsPrimaryKey = true; // Primary key field
        $this->BRAND_ID->Nullable = false; // NOT NULL field
        $this->BRAND_ID->Required = true; // Required field
        $this->BRAND_ID->Sortable = true; // Allow sort
        $this->BRAND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_ID->Param, "CustomMsg");
        $this->Fields['BRAND_ID'] = &$this->BRAND_ID;

        // BRAND_NAME
        $this->BRAND_NAME = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_BRAND_NAME', 'BRAND_NAME', '[BRAND_NAME]', '[BRAND_NAME]', 200, 150, -1, false, '[BRAND_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_NAME->Nullable = false; // NOT NULL field
        $this->BRAND_NAME->Required = true; // Required field
        $this->BRAND_NAME->Sortable = true; // Allow sort
        $this->BRAND_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_NAME->Param, "CustomMsg");
        $this->Fields['BRAND_NAME'] = &$this->BRAND_NAME;

        // ROOMS_ID
        $this->ROOMS_ID = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_ROOMS_ID', 'ROOMS_ID', '[ROOMS_ID]', '[ROOMS_ID]', 200, 10, -1, false, '[ROOMS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ROOMS_ID->IsPrimaryKey = true; // Primary key field
        $this->ROOMS_ID->Nullable = false; // NOT NULL field
        $this->ROOMS_ID->Required = true; // Required field
        $this->ROOMS_ID->Sortable = true; // Allow sort
        $this->ROOMS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ROOMS_ID->Param, "CustomMsg");
        $this->Fields['ROOMS_ID'] = &$this->ROOMS_ID;

        // ALLOCATED_DATE
        $this->ALLOCATED_DATE = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_ALLOCATED_DATE', 'ALLOCATED_DATE', '[ALLOCATED_DATE]', CastDateFieldForLike("[ALLOCATED_DATE]", 0, "DB"), 135, 8, 0, false, '[ALLOCATED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ALLOCATED_DATE->Nullable = false; // NOT NULL field
        $this->ALLOCATED_DATE->Required = true; // Required field
        $this->ALLOCATED_DATE->Sortable = true; // Allow sort
        $this->ALLOCATED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->ALLOCATED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ALLOCATED_DATE->Param, "CustomMsg");
        $this->Fields['ALLOCATED_DATE'] = &$this->ALLOCATED_DATE;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // PRICE
        $this->PRICE = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_PRICE', 'PRICE', '[PRICE]', 'CAST([PRICE] AS NVARCHAR)', 6, 8, -1, false, '[PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRICE->Sortable = true; // Allow sort
        $this->PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRICE->Param, "CustomMsg");
        $this->Fields['PRICE'] = &$this->PRICE;

        // AVGPRICE
        $this->AVGPRICE = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_AVGPRICE', 'AVGPRICE', '[AVGPRICE]', 'CAST([AVGPRICE] AS NVARCHAR)', 6, 8, -1, false, '[AVGPRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AVGPRICE->Sortable = true; // Allow sort
        $this->AVGPRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AVGPRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AVGPRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AVGPRICE->Param, "CustomMsg");
        $this->Fields['AVGPRICE'] = &$this->AVGPRICE;

        // STOK_AWAL
        $this->STOK_AWAL = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_STOK_AWAL', 'STOK_AWAL', '[STOK_AWAL]', 'CAST([STOK_AWAL] AS NVARCHAR)', 131, 8, -1, false, '[STOK_AWAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOK_AWAL->Sortable = true; // Allow sort
        $this->STOK_AWAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOK_AWAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOK_AWAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOK_AWAL->Param, "CustomMsg");
        $this->Fields['STOK_AWAL'] = &$this->STOK_AWAL;

        // STOCKIN
        $this->STOCKIN = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_STOCKIN', 'STOCKIN', '[STOCKIN]', 'CAST([STOCKIN] AS NVARCHAR)', 131, 8, -1, false, '[STOCKIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCKIN->Sortable = true; // Allow sort
        $this->STOCKIN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCKIN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCKIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCKIN->Param, "CustomMsg");
        $this->Fields['STOCKIN'] = &$this->STOCKIN;

        // STOCKOUT
        $this->STOCKOUT = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_STOCKOUT', 'STOCKOUT', '[STOCKOUT]', 'CAST([STOCKOUT] AS NVARCHAR)', 131, 8, -1, false, '[STOCKOUT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCKOUT->Sortable = true; // Allow sort
        $this->STOCKOUT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCKOUT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCKOUT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCKOUT->Param, "CustomMsg");
        $this->Fields['STOCKOUT'] = &$this->STOCKOUT;

        // DIMINTA
        $this->DIMINTA = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_DIMINTA', 'DIMINTA', '[DIMINTA]', 'CAST([DIMINTA] AS NVARCHAR)', 131, 8, -1, false, '[DIMINTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIMINTA->Sortable = true; // Allow sort
        $this->DIMINTA->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DIMINTA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DIMINTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIMINTA->Param, "CustomMsg");
        $this->Fields['DIMINTA'] = &$this->DIMINTA;

        // ISCETAK
        $this->ISCETAK = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_ISCETAK', 'ISCETAK', '[ISCETAK]', '[ISCETAK]', 129, 1, -1, false, '[ISCETAK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISCETAK->Sortable = true; // Allow sort
        $this->ISCETAK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISCETAK->Param, "CustomMsg");
        $this->Fields['ISCETAK'] = &$this->ISCETAK;

        // PRINTQ
        $this->PRINTQ = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_PRINTQ', 'PRINTQ', '[PRINTQ]', 'CAST([PRINTQ] AS NVARCHAR)', 17, 1, -1, false, '[PRINTQ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTQ->Sortable = true; // Allow sort
        $this->PRINTQ->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PRINTQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTQ->Param, "CustomMsg");
        $this->Fields['PRINTQ'] = &$this->PRINTQ;

        // PRINTED_BY
        $this->PRINTED_BY = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_PRINTED_BY', 'PRINTED_BY', '[PRINTED_BY]', '[PRINTED_BY]', 200, 50, -1, false, '[PRINTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTED_BY->Sortable = true; // Allow sort
        $this->PRINTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTED_BY->Param, "CustomMsg");
        $this->Fields['PRINTED_BY'] = &$this->PRINTED_BY;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = true; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // EXPIRY_DATE
        $this->EXPIRY_DATE = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_EXPIRY_DATE', 'EXPIRY_DATE', '[EXPIRY_DATE]', CastDateFieldForLike("[EXPIRY_DATE]", 0, "DB"), 135, 8, 0, false, '[EXPIRY_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXPIRY_DATE->Sortable = true; // Allow sort
        $this->EXPIRY_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXPIRY_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXPIRY_DATE->Param, "CustomMsg");
        $this->Fields['EXPIRY_DATE'] = &$this->EXPIRY_DATE;

        // STOCKININT
        $this->STOCKININT = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_STOCKININT', 'STOCKININT', '[STOCKININT]', 'CAST([STOCKININT] AS NVARCHAR)', 131, 8, -1, false, '[STOCKININT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCKININT->Sortable = true; // Allow sort
        $this->STOCKININT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCKININT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCKININT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCKININT->Param, "CustomMsg");
        $this->Fields['STOCKININT'] = &$this->STOCKININT;

        // STOCKOUTINT
        $this->STOCKOUTINT = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_STOCKOUTINT', 'STOCKOUTINT', '[STOCKOUTINT]', 'CAST([STOCKOUTINT] AS NVARCHAR)', 131, 8, -1, false, '[STOCKOUTINT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCKOUTINT->Sortable = true; // Allow sort
        $this->STOCKOUTINT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCKOUTINT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCKOUTINT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCKOUTINT->Param, "CustomMsg");
        $this->Fields['STOCKOUTINT'] = &$this->STOCKOUTINT;

        // idx
        $this->idx = new DbField('GOODS_ROOMS', 'GOODS_ROOMS', 'x_idx', 'idx', '[idx]', 'CAST([idx] AS NVARCHAR)', 3, 4, -1, false, '[idx]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->idx->Sortable = true; // Allow sort
        $this->idx->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->idx->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idx->Param, "CustomMsg");
        $this->Fields['idx'] = &$this->idx;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[GOODS_ROOMS]";
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
            if (array_key_exists('ROOMS_ID', $rs)) {
                AddFilter($where, QuotedName('ROOMS_ID', $this->Dbid) . '=' . QuotedValue($rs['ROOMS_ID'], $this->ROOMS_ID->DataType, $this->Dbid));
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
        $this->BRAND_NAME->DbValue = $row['BRAND_NAME'];
        $this->ROOMS_ID->DbValue = $row['ROOMS_ID'];
        $this->ALLOCATED_DATE->DbValue = $row['ALLOCATED_DATE'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->PRICE->DbValue = $row['PRICE'];
        $this->AVGPRICE->DbValue = $row['AVGPRICE'];
        $this->STOK_AWAL->DbValue = $row['STOK_AWAL'];
        $this->STOCKIN->DbValue = $row['STOCKIN'];
        $this->STOCKOUT->DbValue = $row['STOCKOUT'];
        $this->DIMINTA->DbValue = $row['DIMINTA'];
        $this->ISCETAK->DbValue = $row['ISCETAK'];
        $this->PRINTQ->DbValue = $row['PRINTQ'];
        $this->PRINTED_BY->DbValue = $row['PRINTED_BY'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->EXPIRY_DATE->DbValue = $row['EXPIRY_DATE'];
        $this->STOCKININT->DbValue = $row['STOCKININT'];
        $this->STOCKOUTINT->DbValue = $row['STOCKOUTINT'];
        $this->idx->DbValue = $row['idx'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [BRAND_ID] = '@BRAND_ID@' AND [ROOMS_ID] = '@ROOMS_ID@'";
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
        $val = $current ? $this->ROOMS_ID->CurrentValue : $this->ROOMS_ID->OldValue;
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
                $this->ROOMS_ID->CurrentValue = $keys[2];
            } else {
                $this->ROOMS_ID->OldValue = $keys[2];
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
            $val = array_key_exists('ROOMS_ID', $row) ? $row['ROOMS_ID'] : null;
        } else {
            $val = $this->ROOMS_ID->OldValue !== null ? $this->ROOMS_ID->OldValue : $this->ROOMS_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ROOMS_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("GoodsRoomsList");
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
        if ($pageName == "GoodsRoomsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GoodsRoomsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GoodsRoomsAdd") {
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
                return "GoodsRoomsView";
            case Config("API_ADD_ACTION"):
                return "GoodsRoomsAdd";
            case Config("API_EDIT_ACTION"):
                return "GoodsRoomsEdit";
            case Config("API_DELETE_ACTION"):
                return "GoodsRoomsDelete";
            case Config("API_LIST_ACTION"):
                return "GoodsRoomsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GoodsRoomsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GoodsRoomsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GoodsRoomsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GoodsRoomsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GoodsRoomsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GoodsRoomsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("GoodsRoomsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("GoodsRoomsDelete", $this->getUrlParm());
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
        $json .= ",ROOMS_ID:" . JsonEncode($this->ROOMS_ID->CurrentValue, "string");
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
        if ($this->ROOMS_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ROOMS_ID->CurrentValue);
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
            if (($keyValue = Param("ROOMS_ID") ?? Route("ROOMS_ID")) !== null) {
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
                $this->ROOMS_ID->CurrentValue = $key[2];
            } else {
                $this->ROOMS_ID->OldValue = $key[2];
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
        $this->BRAND_NAME->setDbValue($row['BRAND_NAME']);
        $this->ROOMS_ID->setDbValue($row['ROOMS_ID']);
        $this->ALLOCATED_DATE->setDbValue($row['ALLOCATED_DATE']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->PRICE->setDbValue($row['PRICE']);
        $this->AVGPRICE->setDbValue($row['AVGPRICE']);
        $this->STOK_AWAL->setDbValue($row['STOK_AWAL']);
        $this->STOCKIN->setDbValue($row['STOCKIN']);
        $this->STOCKOUT->setDbValue($row['STOCKOUT']);
        $this->DIMINTA->setDbValue($row['DIMINTA']);
        $this->ISCETAK->setDbValue($row['ISCETAK']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->EXPIRY_DATE->setDbValue($row['EXPIRY_DATE']);
        $this->STOCKININT->setDbValue($row['STOCKININT']);
        $this->STOCKOUTINT->setDbValue($row['STOCKOUTINT']);
        $this->idx->setDbValue($row['idx']);
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

        // BRAND_NAME

        // ROOMS_ID

        // ALLOCATED_DATE

        // MEASURE_ID

        // PRICE

        // AVGPRICE

        // STOK_AWAL

        // STOCKIN

        // STOCKOUT

        // DIMINTA

        // ISCETAK

        // PRINTQ

        // PRINTED_BY

        // PRINT_DATE

        // MODIFIED_DATE

        // MODIFIED_BY

        // EXPIRY_DATE

        // STOCKININT

        // STOCKOUTINT

        // idx

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // BRAND_ID
        $this->BRAND_ID->ViewValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->ViewCustomAttributes = "";

        // BRAND_NAME
        $this->BRAND_NAME->ViewValue = $this->BRAND_NAME->CurrentValue;
        $this->BRAND_NAME->ViewCustomAttributes = "";

        // ROOMS_ID
        $this->ROOMS_ID->ViewValue = $this->ROOMS_ID->CurrentValue;
        $this->ROOMS_ID->ViewCustomAttributes = "";

        // ALLOCATED_DATE
        $this->ALLOCATED_DATE->ViewValue = $this->ALLOCATED_DATE->CurrentValue;
        $this->ALLOCATED_DATE->ViewValue = FormatDateTime($this->ALLOCATED_DATE->ViewValue, 0);
        $this->ALLOCATED_DATE->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // PRICE
        $this->PRICE->ViewValue = $this->PRICE->CurrentValue;
        $this->PRICE->ViewValue = FormatNumber($this->PRICE->ViewValue, 2, -2, -2, -2);
        $this->PRICE->ViewCustomAttributes = "";

        // AVGPRICE
        $this->AVGPRICE->ViewValue = $this->AVGPRICE->CurrentValue;
        $this->AVGPRICE->ViewValue = FormatNumber($this->AVGPRICE->ViewValue, 2, -2, -2, -2);
        $this->AVGPRICE->ViewCustomAttributes = "";

        // STOK_AWAL
        $this->STOK_AWAL->ViewValue = $this->STOK_AWAL->CurrentValue;
        $this->STOK_AWAL->ViewValue = FormatNumber($this->STOK_AWAL->ViewValue, 2, -2, -2, -2);
        $this->STOK_AWAL->ViewCustomAttributes = "";

        // STOCKIN
        $this->STOCKIN->ViewValue = $this->STOCKIN->CurrentValue;
        $this->STOCKIN->ViewValue = FormatNumber($this->STOCKIN->ViewValue, 2, -2, -2, -2);
        $this->STOCKIN->ViewCustomAttributes = "";

        // STOCKOUT
        $this->STOCKOUT->ViewValue = $this->STOCKOUT->CurrentValue;
        $this->STOCKOUT->ViewValue = FormatNumber($this->STOCKOUT->ViewValue, 2, -2, -2, -2);
        $this->STOCKOUT->ViewCustomAttributes = "";

        // DIMINTA
        $this->DIMINTA->ViewValue = $this->DIMINTA->CurrentValue;
        $this->DIMINTA->ViewValue = FormatNumber($this->DIMINTA->ViewValue, 2, -2, -2, -2);
        $this->DIMINTA->ViewCustomAttributes = "";

        // ISCETAK
        $this->ISCETAK->ViewValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->ViewCustomAttributes = "";

        // PRINTQ
        $this->PRINTQ->ViewValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->ViewValue = FormatNumber($this->PRINTQ->ViewValue, 0, -2, -2, -2);
        $this->PRINTQ->ViewCustomAttributes = "";

        // PRINTED_BY
        $this->PRINTED_BY->ViewValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->ViewCustomAttributes = "";

        // PRINT_DATE
        $this->PRINT_DATE->ViewValue = $this->PRINT_DATE->CurrentValue;
        $this->PRINT_DATE->ViewValue = FormatDateTime($this->PRINT_DATE->ViewValue, 0);
        $this->PRINT_DATE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // EXPIRY_DATE
        $this->EXPIRY_DATE->ViewValue = $this->EXPIRY_DATE->CurrentValue;
        $this->EXPIRY_DATE->ViewValue = FormatDateTime($this->EXPIRY_DATE->ViewValue, 0);
        $this->EXPIRY_DATE->ViewCustomAttributes = "";

        // STOCKININT
        $this->STOCKININT->ViewValue = $this->STOCKININT->CurrentValue;
        $this->STOCKININT->ViewValue = FormatNumber($this->STOCKININT->ViewValue, 2, -2, -2, -2);
        $this->STOCKININT->ViewCustomAttributes = "";

        // STOCKOUTINT
        $this->STOCKOUTINT->ViewValue = $this->STOCKOUTINT->CurrentValue;
        $this->STOCKOUTINT->ViewValue = FormatNumber($this->STOCKOUTINT->ViewValue, 2, -2, -2, -2);
        $this->STOCKOUTINT->ViewCustomAttributes = "";

        // idx
        $this->idx->ViewValue = $this->idx->CurrentValue;
        $this->idx->ViewValue = FormatNumber($this->idx->ViewValue, 0, -2, -2, -2);
        $this->idx->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // BRAND_ID
        $this->BRAND_ID->LinkCustomAttributes = "";
        $this->BRAND_ID->HrefValue = "";
        $this->BRAND_ID->TooltipValue = "";

        // BRAND_NAME
        $this->BRAND_NAME->LinkCustomAttributes = "";
        $this->BRAND_NAME->HrefValue = "";
        $this->BRAND_NAME->TooltipValue = "";

        // ROOMS_ID
        $this->ROOMS_ID->LinkCustomAttributes = "";
        $this->ROOMS_ID->HrefValue = "";
        $this->ROOMS_ID->TooltipValue = "";

        // ALLOCATED_DATE
        $this->ALLOCATED_DATE->LinkCustomAttributes = "";
        $this->ALLOCATED_DATE->HrefValue = "";
        $this->ALLOCATED_DATE->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // PRICE
        $this->PRICE->LinkCustomAttributes = "";
        $this->PRICE->HrefValue = "";
        $this->PRICE->TooltipValue = "";

        // AVGPRICE
        $this->AVGPRICE->LinkCustomAttributes = "";
        $this->AVGPRICE->HrefValue = "";
        $this->AVGPRICE->TooltipValue = "";

        // STOK_AWAL
        $this->STOK_AWAL->LinkCustomAttributes = "";
        $this->STOK_AWAL->HrefValue = "";
        $this->STOK_AWAL->TooltipValue = "";

        // STOCKIN
        $this->STOCKIN->LinkCustomAttributes = "";
        $this->STOCKIN->HrefValue = "";
        $this->STOCKIN->TooltipValue = "";

        // STOCKOUT
        $this->STOCKOUT->LinkCustomAttributes = "";
        $this->STOCKOUT->HrefValue = "";
        $this->STOCKOUT->TooltipValue = "";

        // DIMINTA
        $this->DIMINTA->LinkCustomAttributes = "";
        $this->DIMINTA->HrefValue = "";
        $this->DIMINTA->TooltipValue = "";

        // ISCETAK
        $this->ISCETAK->LinkCustomAttributes = "";
        $this->ISCETAK->HrefValue = "";
        $this->ISCETAK->TooltipValue = "";

        // PRINTQ
        $this->PRINTQ->LinkCustomAttributes = "";
        $this->PRINTQ->HrefValue = "";
        $this->PRINTQ->TooltipValue = "";

        // PRINTED_BY
        $this->PRINTED_BY->LinkCustomAttributes = "";
        $this->PRINTED_BY->HrefValue = "";
        $this->PRINTED_BY->TooltipValue = "";

        // PRINT_DATE
        $this->PRINT_DATE->LinkCustomAttributes = "";
        $this->PRINT_DATE->HrefValue = "";
        $this->PRINT_DATE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // EXPIRY_DATE
        $this->EXPIRY_DATE->LinkCustomAttributes = "";
        $this->EXPIRY_DATE->HrefValue = "";
        $this->EXPIRY_DATE->TooltipValue = "";

        // STOCKININT
        $this->STOCKININT->LinkCustomAttributes = "";
        $this->STOCKININT->HrefValue = "";
        $this->STOCKININT->TooltipValue = "";

        // STOCKOUTINT
        $this->STOCKOUTINT->LinkCustomAttributes = "";
        $this->STOCKOUTINT->HrefValue = "";
        $this->STOCKOUTINT->TooltipValue = "";

        // idx
        $this->idx->LinkCustomAttributes = "";
        $this->idx->HrefValue = "";
        $this->idx->TooltipValue = "";

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

        // BRAND_NAME
        $this->BRAND_NAME->EditAttrs["class"] = "form-control";
        $this->BRAND_NAME->EditCustomAttributes = "";
        if (!$this->BRAND_NAME->Raw) {
            $this->BRAND_NAME->CurrentValue = HtmlDecode($this->BRAND_NAME->CurrentValue);
        }
        $this->BRAND_NAME->EditValue = $this->BRAND_NAME->CurrentValue;
        $this->BRAND_NAME->PlaceHolder = RemoveHtml($this->BRAND_NAME->caption());

        // ROOMS_ID
        $this->ROOMS_ID->EditAttrs["class"] = "form-control";
        $this->ROOMS_ID->EditCustomAttributes = "";
        if (!$this->ROOMS_ID->Raw) {
            $this->ROOMS_ID->CurrentValue = HtmlDecode($this->ROOMS_ID->CurrentValue);
        }
        $this->ROOMS_ID->EditValue = $this->ROOMS_ID->CurrentValue;
        $this->ROOMS_ID->PlaceHolder = RemoveHtml($this->ROOMS_ID->caption());

        // ALLOCATED_DATE
        $this->ALLOCATED_DATE->EditAttrs["class"] = "form-control";
        $this->ALLOCATED_DATE->EditCustomAttributes = "";
        $this->ALLOCATED_DATE->EditValue = FormatDateTime($this->ALLOCATED_DATE->CurrentValue, 8);
        $this->ALLOCATED_DATE->PlaceHolder = RemoveHtml($this->ALLOCATED_DATE->caption());

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // PRICE
        $this->PRICE->EditAttrs["class"] = "form-control";
        $this->PRICE->EditCustomAttributes = "";
        $this->PRICE->EditValue = $this->PRICE->CurrentValue;
        $this->PRICE->PlaceHolder = RemoveHtml($this->PRICE->caption());
        if (strval($this->PRICE->EditValue) != "" && is_numeric($this->PRICE->EditValue)) {
            $this->PRICE->EditValue = FormatNumber($this->PRICE->EditValue, -2, -2, -2, -2);
        }

        // AVGPRICE
        $this->AVGPRICE->EditAttrs["class"] = "form-control";
        $this->AVGPRICE->EditCustomAttributes = "";
        $this->AVGPRICE->EditValue = $this->AVGPRICE->CurrentValue;
        $this->AVGPRICE->PlaceHolder = RemoveHtml($this->AVGPRICE->caption());
        if (strval($this->AVGPRICE->EditValue) != "" && is_numeric($this->AVGPRICE->EditValue)) {
            $this->AVGPRICE->EditValue = FormatNumber($this->AVGPRICE->EditValue, -2, -2, -2, -2);
        }

        // STOK_AWAL
        $this->STOK_AWAL->EditAttrs["class"] = "form-control";
        $this->STOK_AWAL->EditCustomAttributes = "";
        $this->STOK_AWAL->EditValue = $this->STOK_AWAL->CurrentValue;
        $this->STOK_AWAL->PlaceHolder = RemoveHtml($this->STOK_AWAL->caption());
        if (strval($this->STOK_AWAL->EditValue) != "" && is_numeric($this->STOK_AWAL->EditValue)) {
            $this->STOK_AWAL->EditValue = FormatNumber($this->STOK_AWAL->EditValue, -2, -2, -2, -2);
        }

        // STOCKIN
        $this->STOCKIN->EditAttrs["class"] = "form-control";
        $this->STOCKIN->EditCustomAttributes = "";
        $this->STOCKIN->EditValue = $this->STOCKIN->CurrentValue;
        $this->STOCKIN->PlaceHolder = RemoveHtml($this->STOCKIN->caption());
        if (strval($this->STOCKIN->EditValue) != "" && is_numeric($this->STOCKIN->EditValue)) {
            $this->STOCKIN->EditValue = FormatNumber($this->STOCKIN->EditValue, -2, -2, -2, -2);
        }

        // STOCKOUT
        $this->STOCKOUT->EditAttrs["class"] = "form-control";
        $this->STOCKOUT->EditCustomAttributes = "";
        $this->STOCKOUT->EditValue = $this->STOCKOUT->CurrentValue;
        $this->STOCKOUT->PlaceHolder = RemoveHtml($this->STOCKOUT->caption());
        if (strval($this->STOCKOUT->EditValue) != "" && is_numeric($this->STOCKOUT->EditValue)) {
            $this->STOCKOUT->EditValue = FormatNumber($this->STOCKOUT->EditValue, -2, -2, -2, -2);
        }

        // DIMINTA
        $this->DIMINTA->EditAttrs["class"] = "form-control";
        $this->DIMINTA->EditCustomAttributes = "";
        $this->DIMINTA->EditValue = $this->DIMINTA->CurrentValue;
        $this->DIMINTA->PlaceHolder = RemoveHtml($this->DIMINTA->caption());
        if (strval($this->DIMINTA->EditValue) != "" && is_numeric($this->DIMINTA->EditValue)) {
            $this->DIMINTA->EditValue = FormatNumber($this->DIMINTA->EditValue, -2, -2, -2, -2);
        }

        // ISCETAK
        $this->ISCETAK->EditAttrs["class"] = "form-control";
        $this->ISCETAK->EditCustomAttributes = "";
        if (!$this->ISCETAK->Raw) {
            $this->ISCETAK->CurrentValue = HtmlDecode($this->ISCETAK->CurrentValue);
        }
        $this->ISCETAK->EditValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->PlaceHolder = RemoveHtml($this->ISCETAK->caption());

        // PRINTQ
        $this->PRINTQ->EditAttrs["class"] = "form-control";
        $this->PRINTQ->EditCustomAttributes = "";
        $this->PRINTQ->EditValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->PlaceHolder = RemoveHtml($this->PRINTQ->caption());

        // PRINTED_BY
        $this->PRINTED_BY->EditAttrs["class"] = "form-control";
        $this->PRINTED_BY->EditCustomAttributes = "";
        if (!$this->PRINTED_BY->Raw) {
            $this->PRINTED_BY->CurrentValue = HtmlDecode($this->PRINTED_BY->CurrentValue);
        }
        $this->PRINTED_BY->EditValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->PlaceHolder = RemoveHtml($this->PRINTED_BY->caption());

        // PRINT_DATE
        $this->PRINT_DATE->EditAttrs["class"] = "form-control";
        $this->PRINT_DATE->EditCustomAttributes = "";
        $this->PRINT_DATE->EditValue = FormatDateTime($this->PRINT_DATE->CurrentValue, 8);
        $this->PRINT_DATE->PlaceHolder = RemoveHtml($this->PRINT_DATE->caption());

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

        // EXPIRY_DATE
        $this->EXPIRY_DATE->EditAttrs["class"] = "form-control";
        $this->EXPIRY_DATE->EditCustomAttributes = "";
        $this->EXPIRY_DATE->EditValue = FormatDateTime($this->EXPIRY_DATE->CurrentValue, 8);
        $this->EXPIRY_DATE->PlaceHolder = RemoveHtml($this->EXPIRY_DATE->caption());

        // STOCKININT
        $this->STOCKININT->EditAttrs["class"] = "form-control";
        $this->STOCKININT->EditCustomAttributes = "";
        $this->STOCKININT->EditValue = $this->STOCKININT->CurrentValue;
        $this->STOCKININT->PlaceHolder = RemoveHtml($this->STOCKININT->caption());
        if (strval($this->STOCKININT->EditValue) != "" && is_numeric($this->STOCKININT->EditValue)) {
            $this->STOCKININT->EditValue = FormatNumber($this->STOCKININT->EditValue, -2, -2, -2, -2);
        }

        // STOCKOUTINT
        $this->STOCKOUTINT->EditAttrs["class"] = "form-control";
        $this->STOCKOUTINT->EditCustomAttributes = "";
        $this->STOCKOUTINT->EditValue = $this->STOCKOUTINT->CurrentValue;
        $this->STOCKOUTINT->PlaceHolder = RemoveHtml($this->STOCKOUTINT->caption());
        if (strval($this->STOCKOUTINT->EditValue) != "" && is_numeric($this->STOCKOUTINT->EditValue)) {
            $this->STOCKOUTINT->EditValue = FormatNumber($this->STOCKOUTINT->EditValue, -2, -2, -2, -2);
        }

        // idx
        $this->idx->EditAttrs["class"] = "form-control";
        $this->idx->EditCustomAttributes = "";
        $this->idx->EditValue = $this->idx->CurrentValue;
        $this->idx->PlaceHolder = RemoveHtml($this->idx->caption());

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
                    $doc->exportCaption($this->BRAND_NAME);
                    $doc->exportCaption($this->ROOMS_ID);
                    $doc->exportCaption($this->ALLOCATED_DATE);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->PRICE);
                    $doc->exportCaption($this->AVGPRICE);
                    $doc->exportCaption($this->STOK_AWAL);
                    $doc->exportCaption($this->STOCKIN);
                    $doc->exportCaption($this->STOCKOUT);
                    $doc->exportCaption($this->DIMINTA);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->EXPIRY_DATE);
                    $doc->exportCaption($this->STOCKININT);
                    $doc->exportCaption($this->STOCKOUTINT);
                    $doc->exportCaption($this->idx);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->BRAND_NAME);
                    $doc->exportCaption($this->ROOMS_ID);
                    $doc->exportCaption($this->ALLOCATED_DATE);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->PRICE);
                    $doc->exportCaption($this->AVGPRICE);
                    $doc->exportCaption($this->STOK_AWAL);
                    $doc->exportCaption($this->STOCKIN);
                    $doc->exportCaption($this->STOCKOUT);
                    $doc->exportCaption($this->DIMINTA);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->EXPIRY_DATE);
                    $doc->exportCaption($this->STOCKININT);
                    $doc->exportCaption($this->STOCKOUTINT);
                    $doc->exportCaption($this->idx);
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
                        $doc->exportField($this->BRAND_NAME);
                        $doc->exportField($this->ROOMS_ID);
                        $doc->exportField($this->ALLOCATED_DATE);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->PRICE);
                        $doc->exportField($this->AVGPRICE);
                        $doc->exportField($this->STOK_AWAL);
                        $doc->exportField($this->STOCKIN);
                        $doc->exportField($this->STOCKOUT);
                        $doc->exportField($this->DIMINTA);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->EXPIRY_DATE);
                        $doc->exportField($this->STOCKININT);
                        $doc->exportField($this->STOCKOUTINT);
                        $doc->exportField($this->idx);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->BRAND_NAME);
                        $doc->exportField($this->ROOMS_ID);
                        $doc->exportField($this->ALLOCATED_DATE);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->PRICE);
                        $doc->exportField($this->AVGPRICE);
                        $doc->exportField($this->STOK_AWAL);
                        $doc->exportField($this->STOCKIN);
                        $doc->exportField($this->STOCKOUT);
                        $doc->exportField($this->DIMINTA);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->EXPIRY_DATE);
                        $doc->exportField($this->STOCKININT);
                        $doc->exportField($this->STOCKOUTINT);
                        $doc->exportField($this->idx);
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
