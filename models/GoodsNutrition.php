<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for GOODS_NUTRITION
 */
class GoodsNutrition extends DbTable
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
    public $BRAND_ID;
    public $NAME;
    public $OTHER_CODE;
    public $DESCRIPTION;
    public $REORDER_POINT;
    public $SIZE_KEMASAN;
    public $MEASURE_ID2;
    public $MEASURE_ID;
    public $SIZE_ORDER;
    public $MEASURE_ID3;
    public $NET_PRICE;
    public $AVERAGE_PRICE;
    public $STOCK_AWAL;
    public $STOCK_DITERIMA;
    public $STOCK_DISTRIBUSI;
    public $STOCK_DIJUAL;
    public $STOCK_DIRETUR;
    public $STOCK_DIHAPUS;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $ISACTIVE;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'GOODS_NUTRITION';
        $this->TableName = 'GOODS_NUTRITION';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[GOODS_NUTRITION]";
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

        // BRAND_ID
        $this->BRAND_ID = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_BRAND_ID', 'BRAND_ID', '[BRAND_ID]', '[BRAND_ID]', 200, 50, -1, false, '[BRAND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_ID->IsPrimaryKey = true; // Primary key field
        $this->BRAND_ID->Nullable = false; // NOT NULL field
        $this->BRAND_ID->Required = true; // Required field
        $this->BRAND_ID->Sortable = true; // Allow sort
        $this->BRAND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_ID->Param, "CustomMsg");
        $this->Fields['BRAND_ID'] = &$this->BRAND_ID;

        // NAME
        $this->NAME = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_NAME', 'NAME', '[NAME]', '[NAME]', 200, 100, -1, false, '[NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME->Sortable = true; // Allow sort
        $this->NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME->Param, "CustomMsg");
        $this->Fields['NAME'] = &$this->NAME;

        // OTHER_CODE
        $this->OTHER_CODE = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_OTHER_CODE', 'OTHER_CODE', '[OTHER_CODE]', '[OTHER_CODE]', 200, 25, -1, false, '[OTHER_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_CODE->Sortable = true; // Allow sort
        $this->OTHER_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_CODE->Param, "CustomMsg");
        $this->Fields['OTHER_CODE'] = &$this->OTHER_CODE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // REORDER_POINT
        $this->REORDER_POINT = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_REORDER_POINT', 'REORDER_POINT', '[REORDER_POINT]', 'CAST([REORDER_POINT] AS NVARCHAR)', 131, 8, -1, false, '[REORDER_POINT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REORDER_POINT->Sortable = true; // Allow sort
        $this->REORDER_POINT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->REORDER_POINT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->REORDER_POINT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REORDER_POINT->Param, "CustomMsg");
        $this->Fields['REORDER_POINT'] = &$this->REORDER_POINT;

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_SIZE_KEMASAN', 'SIZE_KEMASAN', '[SIZE_KEMASAN]', 'CAST([SIZE_KEMASAN] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_KEMASAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_KEMASAN->Sortable = true; // Allow sort
        $this->SIZE_KEMASAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_KEMASAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_KEMASAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_KEMASAN->Param, "CustomMsg");
        $this->Fields['SIZE_KEMASAN'] = &$this->SIZE_KEMASAN;

        // MEASURE_ID2
        $this->MEASURE_ID2 = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_MEASURE_ID2', 'MEASURE_ID2', '[MEASURE_ID2]', 'CAST([MEASURE_ID2] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID2->Sortable = true; // Allow sort
        $this->MEASURE_ID2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID2->Param, "CustomMsg");
        $this->Fields['MEASURE_ID2'] = &$this->MEASURE_ID2;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // SIZE_ORDER
        $this->SIZE_ORDER = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_SIZE_ORDER', 'SIZE_ORDER', '[SIZE_ORDER]', 'CAST([SIZE_ORDER] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_ORDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_ORDER->Sortable = true; // Allow sort
        $this->SIZE_ORDER->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_ORDER->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_ORDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_ORDER->Param, "CustomMsg");
        $this->Fields['SIZE_ORDER'] = &$this->SIZE_ORDER;

        // MEASURE_ID3
        $this->MEASURE_ID3 = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_MEASURE_ID3', 'MEASURE_ID3', '[MEASURE_ID3]', 'CAST([MEASURE_ID3] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID3->Sortable = true; // Allow sort
        $this->MEASURE_ID3->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID3->Param, "CustomMsg");
        $this->Fields['MEASURE_ID3'] = &$this->MEASURE_ID3;

        // NET_PRICE
        $this->NET_PRICE = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_NET_PRICE', 'NET_PRICE', '[NET_PRICE]', 'CAST([NET_PRICE] AS NVARCHAR)', 6, 8, -1, false, '[NET_PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NET_PRICE->Sortable = true; // Allow sort
        $this->NET_PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NET_PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NET_PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NET_PRICE->Param, "CustomMsg");
        $this->Fields['NET_PRICE'] = &$this->NET_PRICE;

        // AVERAGE_PRICE
        $this->AVERAGE_PRICE = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_AVERAGE_PRICE', 'AVERAGE_PRICE', '[AVERAGE_PRICE]', 'CAST([AVERAGE_PRICE] AS NVARCHAR)', 6, 8, -1, false, '[AVERAGE_PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AVERAGE_PRICE->Sortable = true; // Allow sort
        $this->AVERAGE_PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AVERAGE_PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AVERAGE_PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AVERAGE_PRICE->Param, "CustomMsg");
        $this->Fields['AVERAGE_PRICE'] = &$this->AVERAGE_PRICE;

        // STOCK_AWAL
        $this->STOCK_AWAL = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_STOCK_AWAL', 'STOCK_AWAL', '[STOCK_AWAL]', 'CAST([STOCK_AWAL] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_AWAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_AWAL->Sortable = true; // Allow sort
        $this->STOCK_AWAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_AWAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_AWAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_AWAL->Param, "CustomMsg");
        $this->Fields['STOCK_AWAL'] = &$this->STOCK_AWAL;

        // STOCK_DITERIMA
        $this->STOCK_DITERIMA = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_STOCK_DITERIMA', 'STOCK_DITERIMA', '[STOCK_DITERIMA]', 'CAST([STOCK_DITERIMA] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_DITERIMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_DITERIMA->Sortable = true; // Allow sort
        $this->STOCK_DITERIMA->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_DITERIMA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_DITERIMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_DITERIMA->Param, "CustomMsg");
        $this->Fields['STOCK_DITERIMA'] = &$this->STOCK_DITERIMA;

        // STOCK_DISTRIBUSI
        $this->STOCK_DISTRIBUSI = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_STOCK_DISTRIBUSI', 'STOCK_DISTRIBUSI', '[STOCK_DISTRIBUSI]', 'CAST([STOCK_DISTRIBUSI] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_DISTRIBUSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_DISTRIBUSI->Sortable = true; // Allow sort
        $this->STOCK_DISTRIBUSI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_DISTRIBUSI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_DISTRIBUSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_DISTRIBUSI->Param, "CustomMsg");
        $this->Fields['STOCK_DISTRIBUSI'] = &$this->STOCK_DISTRIBUSI;

        // STOCK_DIJUAL
        $this->STOCK_DIJUAL = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_STOCK_DIJUAL', 'STOCK_DIJUAL', '[STOCK_DIJUAL]', 'CAST([STOCK_DIJUAL] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_DIJUAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_DIJUAL->Sortable = true; // Allow sort
        $this->STOCK_DIJUAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_DIJUAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_DIJUAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_DIJUAL->Param, "CustomMsg");
        $this->Fields['STOCK_DIJUAL'] = &$this->STOCK_DIJUAL;

        // STOCK_DIRETUR
        $this->STOCK_DIRETUR = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_STOCK_DIRETUR', 'STOCK_DIRETUR', '[STOCK_DIRETUR]', 'CAST([STOCK_DIRETUR] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_DIRETUR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_DIRETUR->Sortable = true; // Allow sort
        $this->STOCK_DIRETUR->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_DIRETUR->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_DIRETUR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_DIRETUR->Param, "CustomMsg");
        $this->Fields['STOCK_DIRETUR'] = &$this->STOCK_DIRETUR;

        // STOCK_DIHAPUS
        $this->STOCK_DIHAPUS = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_STOCK_DIHAPUS', 'STOCK_DIHAPUS', '[STOCK_DIHAPUS]', 'CAST([STOCK_DIHAPUS] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_DIHAPUS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_DIHAPUS->Sortable = true; // Allow sort
        $this->STOCK_DIHAPUS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_DIHAPUS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_DIHAPUS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_DIHAPUS->Param, "CustomMsg");
        $this->Fields['STOCK_DIHAPUS'] = &$this->STOCK_DIHAPUS;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 25, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // ISACTIVE
        $this->ISACTIVE = new DbField('GOODS_NUTRITION', 'GOODS_NUTRITION', 'x_ISACTIVE', 'ISACTIVE', '[ISACTIVE]', '[ISACTIVE]', 129, 1, -1, false, '[ISACTIVE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISACTIVE->Sortable = true; // Allow sort
        $this->ISACTIVE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISACTIVE->Param, "CustomMsg");
        $this->Fields['ISACTIVE'] = &$this->ISACTIVE;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[GOODS_NUTRITION]";
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
            if (array_key_exists('BRAND_ID', $rs)) {
                AddFilter($where, QuotedName('BRAND_ID', $this->Dbid) . '=' . QuotedValue($rs['BRAND_ID'], $this->BRAND_ID->DataType, $this->Dbid));
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
        $this->BRAND_ID->DbValue = $row['BRAND_ID'];
        $this->NAME->DbValue = $row['NAME'];
        $this->OTHER_CODE->DbValue = $row['OTHER_CODE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->REORDER_POINT->DbValue = $row['REORDER_POINT'];
        $this->SIZE_KEMASAN->DbValue = $row['SIZE_KEMASAN'];
        $this->MEASURE_ID2->DbValue = $row['MEASURE_ID2'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->SIZE_ORDER->DbValue = $row['SIZE_ORDER'];
        $this->MEASURE_ID3->DbValue = $row['MEASURE_ID3'];
        $this->NET_PRICE->DbValue = $row['NET_PRICE'];
        $this->AVERAGE_PRICE->DbValue = $row['AVERAGE_PRICE'];
        $this->STOCK_AWAL->DbValue = $row['STOCK_AWAL'];
        $this->STOCK_DITERIMA->DbValue = $row['STOCK_DITERIMA'];
        $this->STOCK_DISTRIBUSI->DbValue = $row['STOCK_DISTRIBUSI'];
        $this->STOCK_DIJUAL->DbValue = $row['STOCK_DIJUAL'];
        $this->STOCK_DIRETUR->DbValue = $row['STOCK_DIRETUR'];
        $this->STOCK_DIHAPUS->DbValue = $row['STOCK_DIHAPUS'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->ISACTIVE->DbValue = $row['ISACTIVE'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[BRAND_ID] = '@BRAND_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->BRAND_ID->CurrentValue : $this->BRAND_ID->OldValue;
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
                $this->BRAND_ID->CurrentValue = $keys[0];
            } else {
                $this->BRAND_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("GoodsNutritionList");
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
        if ($pageName == "GoodsNutritionView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GoodsNutritionEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GoodsNutritionAdd") {
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
                return "GoodsNutritionView";
            case Config("API_ADD_ACTION"):
                return "GoodsNutritionAdd";
            case Config("API_EDIT_ACTION"):
                return "GoodsNutritionEdit";
            case Config("API_DELETE_ACTION"):
                return "GoodsNutritionDelete";
            case Config("API_LIST_ACTION"):
                return "GoodsNutritionList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GoodsNutritionList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GoodsNutritionView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GoodsNutritionView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GoodsNutritionAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GoodsNutritionAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GoodsNutritionEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("GoodsNutritionAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("GoodsNutritionDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "BRAND_ID:" . JsonEncode($this->BRAND_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->BRAND_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BRAND_ID->CurrentValue);
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
            if (($keyValue = Param("BRAND_ID") ?? Route("BRAND_ID")) !== null) {
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
                $this->BRAND_ID->CurrentValue = $key;
            } else {
                $this->BRAND_ID->OldValue = $key;
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
        $this->BRAND_ID->setDbValue($row['BRAND_ID']);
        $this->NAME->setDbValue($row['NAME']);
        $this->OTHER_CODE->setDbValue($row['OTHER_CODE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->REORDER_POINT->setDbValue($row['REORDER_POINT']);
        $this->SIZE_KEMASAN->setDbValue($row['SIZE_KEMASAN']);
        $this->MEASURE_ID2->setDbValue($row['MEASURE_ID2']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->SIZE_ORDER->setDbValue($row['SIZE_ORDER']);
        $this->MEASURE_ID3->setDbValue($row['MEASURE_ID3']);
        $this->NET_PRICE->setDbValue($row['NET_PRICE']);
        $this->AVERAGE_PRICE->setDbValue($row['AVERAGE_PRICE']);
        $this->STOCK_AWAL->setDbValue($row['STOCK_AWAL']);
        $this->STOCK_DITERIMA->setDbValue($row['STOCK_DITERIMA']);
        $this->STOCK_DISTRIBUSI->setDbValue($row['STOCK_DISTRIBUSI']);
        $this->STOCK_DIJUAL->setDbValue($row['STOCK_DIJUAL']);
        $this->STOCK_DIRETUR->setDbValue($row['STOCK_DIRETUR']);
        $this->STOCK_DIHAPUS->setDbValue($row['STOCK_DIHAPUS']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->ISACTIVE->setDbValue($row['ISACTIVE']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // BRAND_ID

        // NAME

        // OTHER_CODE

        // DESCRIPTION

        // REORDER_POINT

        // SIZE_KEMASAN

        // MEASURE_ID2

        // MEASURE_ID

        // SIZE_ORDER

        // MEASURE_ID3

        // NET_PRICE

        // AVERAGE_PRICE

        // STOCK_AWAL

        // STOCK_DITERIMA

        // STOCK_DISTRIBUSI

        // STOCK_DIJUAL

        // STOCK_DIRETUR

        // STOCK_DIHAPUS

        // MODIFIED_DATE

        // MODIFIED_BY

        // ISACTIVE

        // BRAND_ID
        $this->BRAND_ID->ViewValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->ViewCustomAttributes = "";

        // NAME
        $this->NAME->ViewValue = $this->NAME->CurrentValue;
        $this->NAME->ViewCustomAttributes = "";

        // OTHER_CODE
        $this->OTHER_CODE->ViewValue = $this->OTHER_CODE->CurrentValue;
        $this->OTHER_CODE->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // REORDER_POINT
        $this->REORDER_POINT->ViewValue = $this->REORDER_POINT->CurrentValue;
        $this->REORDER_POINT->ViewValue = FormatNumber($this->REORDER_POINT->ViewValue, 2, -2, -2, -2);
        $this->REORDER_POINT->ViewCustomAttributes = "";

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->ViewValue = $this->SIZE_KEMASAN->CurrentValue;
        $this->SIZE_KEMASAN->ViewValue = FormatNumber($this->SIZE_KEMASAN->ViewValue, 2, -2, -2, -2);
        $this->SIZE_KEMASAN->ViewCustomAttributes = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->ViewValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->ViewValue = FormatNumber($this->MEASURE_ID2->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID2->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // SIZE_ORDER
        $this->SIZE_ORDER->ViewValue = $this->SIZE_ORDER->CurrentValue;
        $this->SIZE_ORDER->ViewValue = FormatNumber($this->SIZE_ORDER->ViewValue, 2, -2, -2, -2);
        $this->SIZE_ORDER->ViewCustomAttributes = "";

        // MEASURE_ID3
        $this->MEASURE_ID3->ViewValue = $this->MEASURE_ID3->CurrentValue;
        $this->MEASURE_ID3->ViewValue = FormatNumber($this->MEASURE_ID3->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID3->ViewCustomAttributes = "";

        // NET_PRICE
        $this->NET_PRICE->ViewValue = $this->NET_PRICE->CurrentValue;
        $this->NET_PRICE->ViewValue = FormatNumber($this->NET_PRICE->ViewValue, 2, -2, -2, -2);
        $this->NET_PRICE->ViewCustomAttributes = "";

        // AVERAGE_PRICE
        $this->AVERAGE_PRICE->ViewValue = $this->AVERAGE_PRICE->CurrentValue;
        $this->AVERAGE_PRICE->ViewValue = FormatNumber($this->AVERAGE_PRICE->ViewValue, 2, -2, -2, -2);
        $this->AVERAGE_PRICE->ViewCustomAttributes = "";

        // STOCK_AWAL
        $this->STOCK_AWAL->ViewValue = $this->STOCK_AWAL->CurrentValue;
        $this->STOCK_AWAL->ViewValue = FormatNumber($this->STOCK_AWAL->ViewValue, 2, -2, -2, -2);
        $this->STOCK_AWAL->ViewCustomAttributes = "";

        // STOCK_DITERIMA
        $this->STOCK_DITERIMA->ViewValue = $this->STOCK_DITERIMA->CurrentValue;
        $this->STOCK_DITERIMA->ViewValue = FormatNumber($this->STOCK_DITERIMA->ViewValue, 2, -2, -2, -2);
        $this->STOCK_DITERIMA->ViewCustomAttributes = "";

        // STOCK_DISTRIBUSI
        $this->STOCK_DISTRIBUSI->ViewValue = $this->STOCK_DISTRIBUSI->CurrentValue;
        $this->STOCK_DISTRIBUSI->ViewValue = FormatNumber($this->STOCK_DISTRIBUSI->ViewValue, 2, -2, -2, -2);
        $this->STOCK_DISTRIBUSI->ViewCustomAttributes = "";

        // STOCK_DIJUAL
        $this->STOCK_DIJUAL->ViewValue = $this->STOCK_DIJUAL->CurrentValue;
        $this->STOCK_DIJUAL->ViewValue = FormatNumber($this->STOCK_DIJUAL->ViewValue, 2, -2, -2, -2);
        $this->STOCK_DIJUAL->ViewCustomAttributes = "";

        // STOCK_DIRETUR
        $this->STOCK_DIRETUR->ViewValue = $this->STOCK_DIRETUR->CurrentValue;
        $this->STOCK_DIRETUR->ViewValue = FormatNumber($this->STOCK_DIRETUR->ViewValue, 2, -2, -2, -2);
        $this->STOCK_DIRETUR->ViewCustomAttributes = "";

        // STOCK_DIHAPUS
        $this->STOCK_DIHAPUS->ViewValue = $this->STOCK_DIHAPUS->CurrentValue;
        $this->STOCK_DIHAPUS->ViewValue = FormatNumber($this->STOCK_DIHAPUS->ViewValue, 2, -2, -2, -2);
        $this->STOCK_DIHAPUS->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // ISACTIVE
        $this->ISACTIVE->ViewValue = $this->ISACTIVE->CurrentValue;
        $this->ISACTIVE->ViewCustomAttributes = "";

        // BRAND_ID
        $this->BRAND_ID->LinkCustomAttributes = "";
        $this->BRAND_ID->HrefValue = "";
        $this->BRAND_ID->TooltipValue = "";

        // NAME
        $this->NAME->LinkCustomAttributes = "";
        $this->NAME->HrefValue = "";
        $this->NAME->TooltipValue = "";

        // OTHER_CODE
        $this->OTHER_CODE->LinkCustomAttributes = "";
        $this->OTHER_CODE->HrefValue = "";
        $this->OTHER_CODE->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // REORDER_POINT
        $this->REORDER_POINT->LinkCustomAttributes = "";
        $this->REORDER_POINT->HrefValue = "";
        $this->REORDER_POINT->TooltipValue = "";

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->LinkCustomAttributes = "";
        $this->SIZE_KEMASAN->HrefValue = "";
        $this->SIZE_KEMASAN->TooltipValue = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->LinkCustomAttributes = "";
        $this->MEASURE_ID2->HrefValue = "";
        $this->MEASURE_ID2->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // SIZE_ORDER
        $this->SIZE_ORDER->LinkCustomAttributes = "";
        $this->SIZE_ORDER->HrefValue = "";
        $this->SIZE_ORDER->TooltipValue = "";

        // MEASURE_ID3
        $this->MEASURE_ID3->LinkCustomAttributes = "";
        $this->MEASURE_ID3->HrefValue = "";
        $this->MEASURE_ID3->TooltipValue = "";

        // NET_PRICE
        $this->NET_PRICE->LinkCustomAttributes = "";
        $this->NET_PRICE->HrefValue = "";
        $this->NET_PRICE->TooltipValue = "";

        // AVERAGE_PRICE
        $this->AVERAGE_PRICE->LinkCustomAttributes = "";
        $this->AVERAGE_PRICE->HrefValue = "";
        $this->AVERAGE_PRICE->TooltipValue = "";

        // STOCK_AWAL
        $this->STOCK_AWAL->LinkCustomAttributes = "";
        $this->STOCK_AWAL->HrefValue = "";
        $this->STOCK_AWAL->TooltipValue = "";

        // STOCK_DITERIMA
        $this->STOCK_DITERIMA->LinkCustomAttributes = "";
        $this->STOCK_DITERIMA->HrefValue = "";
        $this->STOCK_DITERIMA->TooltipValue = "";

        // STOCK_DISTRIBUSI
        $this->STOCK_DISTRIBUSI->LinkCustomAttributes = "";
        $this->STOCK_DISTRIBUSI->HrefValue = "";
        $this->STOCK_DISTRIBUSI->TooltipValue = "";

        // STOCK_DIJUAL
        $this->STOCK_DIJUAL->LinkCustomAttributes = "";
        $this->STOCK_DIJUAL->HrefValue = "";
        $this->STOCK_DIJUAL->TooltipValue = "";

        // STOCK_DIRETUR
        $this->STOCK_DIRETUR->LinkCustomAttributes = "";
        $this->STOCK_DIRETUR->HrefValue = "";
        $this->STOCK_DIRETUR->TooltipValue = "";

        // STOCK_DIHAPUS
        $this->STOCK_DIHAPUS->LinkCustomAttributes = "";
        $this->STOCK_DIHAPUS->HrefValue = "";
        $this->STOCK_DIHAPUS->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // ISACTIVE
        $this->ISACTIVE->LinkCustomAttributes = "";
        $this->ISACTIVE->HrefValue = "";
        $this->ISACTIVE->TooltipValue = "";

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

        // BRAND_ID
        $this->BRAND_ID->EditAttrs["class"] = "form-control";
        $this->BRAND_ID->EditCustomAttributes = "";
        if (!$this->BRAND_ID->Raw) {
            $this->BRAND_ID->CurrentValue = HtmlDecode($this->BRAND_ID->CurrentValue);
        }
        $this->BRAND_ID->EditValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->PlaceHolder = RemoveHtml($this->BRAND_ID->caption());

        // NAME
        $this->NAME->EditAttrs["class"] = "form-control";
        $this->NAME->EditCustomAttributes = "";
        if (!$this->NAME->Raw) {
            $this->NAME->CurrentValue = HtmlDecode($this->NAME->CurrentValue);
        }
        $this->NAME->EditValue = $this->NAME->CurrentValue;
        $this->NAME->PlaceHolder = RemoveHtml($this->NAME->caption());

        // OTHER_CODE
        $this->OTHER_CODE->EditAttrs["class"] = "form-control";
        $this->OTHER_CODE->EditCustomAttributes = "";
        if (!$this->OTHER_CODE->Raw) {
            $this->OTHER_CODE->CurrentValue = HtmlDecode($this->OTHER_CODE->CurrentValue);
        }
        $this->OTHER_CODE->EditValue = $this->OTHER_CODE->CurrentValue;
        $this->OTHER_CODE->PlaceHolder = RemoveHtml($this->OTHER_CODE->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // REORDER_POINT
        $this->REORDER_POINT->EditAttrs["class"] = "form-control";
        $this->REORDER_POINT->EditCustomAttributes = "";
        $this->REORDER_POINT->EditValue = $this->REORDER_POINT->CurrentValue;
        $this->REORDER_POINT->PlaceHolder = RemoveHtml($this->REORDER_POINT->caption());
        if (strval($this->REORDER_POINT->EditValue) != "" && is_numeric($this->REORDER_POINT->EditValue)) {
            $this->REORDER_POINT->EditValue = FormatNumber($this->REORDER_POINT->EditValue, -2, -2, -2, -2);
        }

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

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // SIZE_ORDER
        $this->SIZE_ORDER->EditAttrs["class"] = "form-control";
        $this->SIZE_ORDER->EditCustomAttributes = "";
        $this->SIZE_ORDER->EditValue = $this->SIZE_ORDER->CurrentValue;
        $this->SIZE_ORDER->PlaceHolder = RemoveHtml($this->SIZE_ORDER->caption());
        if (strval($this->SIZE_ORDER->EditValue) != "" && is_numeric($this->SIZE_ORDER->EditValue)) {
            $this->SIZE_ORDER->EditValue = FormatNumber($this->SIZE_ORDER->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_ID3
        $this->MEASURE_ID3->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID3->EditCustomAttributes = "";
        $this->MEASURE_ID3->EditValue = $this->MEASURE_ID3->CurrentValue;
        $this->MEASURE_ID3->PlaceHolder = RemoveHtml($this->MEASURE_ID3->caption());

        // NET_PRICE
        $this->NET_PRICE->EditAttrs["class"] = "form-control";
        $this->NET_PRICE->EditCustomAttributes = "";
        $this->NET_PRICE->EditValue = $this->NET_PRICE->CurrentValue;
        $this->NET_PRICE->PlaceHolder = RemoveHtml($this->NET_PRICE->caption());
        if (strval($this->NET_PRICE->EditValue) != "" && is_numeric($this->NET_PRICE->EditValue)) {
            $this->NET_PRICE->EditValue = FormatNumber($this->NET_PRICE->EditValue, -2, -2, -2, -2);
        }

        // AVERAGE_PRICE
        $this->AVERAGE_PRICE->EditAttrs["class"] = "form-control";
        $this->AVERAGE_PRICE->EditCustomAttributes = "";
        $this->AVERAGE_PRICE->EditValue = $this->AVERAGE_PRICE->CurrentValue;
        $this->AVERAGE_PRICE->PlaceHolder = RemoveHtml($this->AVERAGE_PRICE->caption());
        if (strval($this->AVERAGE_PRICE->EditValue) != "" && is_numeric($this->AVERAGE_PRICE->EditValue)) {
            $this->AVERAGE_PRICE->EditValue = FormatNumber($this->AVERAGE_PRICE->EditValue, -2, -2, -2, -2);
        }

        // STOCK_AWAL
        $this->STOCK_AWAL->EditAttrs["class"] = "form-control";
        $this->STOCK_AWAL->EditCustomAttributes = "";
        $this->STOCK_AWAL->EditValue = $this->STOCK_AWAL->CurrentValue;
        $this->STOCK_AWAL->PlaceHolder = RemoveHtml($this->STOCK_AWAL->caption());
        if (strval($this->STOCK_AWAL->EditValue) != "" && is_numeric($this->STOCK_AWAL->EditValue)) {
            $this->STOCK_AWAL->EditValue = FormatNumber($this->STOCK_AWAL->EditValue, -2, -2, -2, -2);
        }

        // STOCK_DITERIMA
        $this->STOCK_DITERIMA->EditAttrs["class"] = "form-control";
        $this->STOCK_DITERIMA->EditCustomAttributes = "";
        $this->STOCK_DITERIMA->EditValue = $this->STOCK_DITERIMA->CurrentValue;
        $this->STOCK_DITERIMA->PlaceHolder = RemoveHtml($this->STOCK_DITERIMA->caption());
        if (strval($this->STOCK_DITERIMA->EditValue) != "" && is_numeric($this->STOCK_DITERIMA->EditValue)) {
            $this->STOCK_DITERIMA->EditValue = FormatNumber($this->STOCK_DITERIMA->EditValue, -2, -2, -2, -2);
        }

        // STOCK_DISTRIBUSI
        $this->STOCK_DISTRIBUSI->EditAttrs["class"] = "form-control";
        $this->STOCK_DISTRIBUSI->EditCustomAttributes = "";
        $this->STOCK_DISTRIBUSI->EditValue = $this->STOCK_DISTRIBUSI->CurrentValue;
        $this->STOCK_DISTRIBUSI->PlaceHolder = RemoveHtml($this->STOCK_DISTRIBUSI->caption());
        if (strval($this->STOCK_DISTRIBUSI->EditValue) != "" && is_numeric($this->STOCK_DISTRIBUSI->EditValue)) {
            $this->STOCK_DISTRIBUSI->EditValue = FormatNumber($this->STOCK_DISTRIBUSI->EditValue, -2, -2, -2, -2);
        }

        // STOCK_DIJUAL
        $this->STOCK_DIJUAL->EditAttrs["class"] = "form-control";
        $this->STOCK_DIJUAL->EditCustomAttributes = "";
        $this->STOCK_DIJUAL->EditValue = $this->STOCK_DIJUAL->CurrentValue;
        $this->STOCK_DIJUAL->PlaceHolder = RemoveHtml($this->STOCK_DIJUAL->caption());
        if (strval($this->STOCK_DIJUAL->EditValue) != "" && is_numeric($this->STOCK_DIJUAL->EditValue)) {
            $this->STOCK_DIJUAL->EditValue = FormatNumber($this->STOCK_DIJUAL->EditValue, -2, -2, -2, -2);
        }

        // STOCK_DIRETUR
        $this->STOCK_DIRETUR->EditAttrs["class"] = "form-control";
        $this->STOCK_DIRETUR->EditCustomAttributes = "";
        $this->STOCK_DIRETUR->EditValue = $this->STOCK_DIRETUR->CurrentValue;
        $this->STOCK_DIRETUR->PlaceHolder = RemoveHtml($this->STOCK_DIRETUR->caption());
        if (strval($this->STOCK_DIRETUR->EditValue) != "" && is_numeric($this->STOCK_DIRETUR->EditValue)) {
            $this->STOCK_DIRETUR->EditValue = FormatNumber($this->STOCK_DIRETUR->EditValue, -2, -2, -2, -2);
        }

        // STOCK_DIHAPUS
        $this->STOCK_DIHAPUS->EditAttrs["class"] = "form-control";
        $this->STOCK_DIHAPUS->EditCustomAttributes = "";
        $this->STOCK_DIHAPUS->EditValue = $this->STOCK_DIHAPUS->CurrentValue;
        $this->STOCK_DIHAPUS->PlaceHolder = RemoveHtml($this->STOCK_DIHAPUS->caption());
        if (strval($this->STOCK_DIHAPUS->EditValue) != "" && is_numeric($this->STOCK_DIHAPUS->EditValue)) {
            $this->STOCK_DIHAPUS->EditValue = FormatNumber($this->STOCK_DIHAPUS->EditValue, -2, -2, -2, -2);
        }

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

        // ISACTIVE
        $this->ISACTIVE->EditAttrs["class"] = "form-control";
        $this->ISACTIVE->EditCustomAttributes = "";
        if (!$this->ISACTIVE->Raw) {
            $this->ISACTIVE->CurrentValue = HtmlDecode($this->ISACTIVE->CurrentValue);
        }
        $this->ISACTIVE->EditValue = $this->ISACTIVE->CurrentValue;
        $this->ISACTIVE->PlaceHolder = RemoveHtml($this->ISACTIVE->caption());

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
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->NAME);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->REORDER_POINT);
                    $doc->exportCaption($this->SIZE_KEMASAN);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->SIZE_ORDER);
                    $doc->exportCaption($this->MEASURE_ID3);
                    $doc->exportCaption($this->NET_PRICE);
                    $doc->exportCaption($this->AVERAGE_PRICE);
                    $doc->exportCaption($this->STOCK_AWAL);
                    $doc->exportCaption($this->STOCK_DITERIMA);
                    $doc->exportCaption($this->STOCK_DISTRIBUSI);
                    $doc->exportCaption($this->STOCK_DIJUAL);
                    $doc->exportCaption($this->STOCK_DIRETUR);
                    $doc->exportCaption($this->STOCK_DIHAPUS);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->ISACTIVE);
                } else {
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->NAME);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->REORDER_POINT);
                    $doc->exportCaption($this->SIZE_KEMASAN);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->SIZE_ORDER);
                    $doc->exportCaption($this->MEASURE_ID3);
                    $doc->exportCaption($this->NET_PRICE);
                    $doc->exportCaption($this->AVERAGE_PRICE);
                    $doc->exportCaption($this->STOCK_AWAL);
                    $doc->exportCaption($this->STOCK_DITERIMA);
                    $doc->exportCaption($this->STOCK_DISTRIBUSI);
                    $doc->exportCaption($this->STOCK_DIJUAL);
                    $doc->exportCaption($this->STOCK_DIRETUR);
                    $doc->exportCaption($this->STOCK_DIHAPUS);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->ISACTIVE);
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
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->NAME);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->REORDER_POINT);
                        $doc->exportField($this->SIZE_KEMASAN);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->SIZE_ORDER);
                        $doc->exportField($this->MEASURE_ID3);
                        $doc->exportField($this->NET_PRICE);
                        $doc->exportField($this->AVERAGE_PRICE);
                        $doc->exportField($this->STOCK_AWAL);
                        $doc->exportField($this->STOCK_DITERIMA);
                        $doc->exportField($this->STOCK_DISTRIBUSI);
                        $doc->exportField($this->STOCK_DIJUAL);
                        $doc->exportField($this->STOCK_DIRETUR);
                        $doc->exportField($this->STOCK_DIHAPUS);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->ISACTIVE);
                    } else {
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->NAME);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->REORDER_POINT);
                        $doc->exportField($this->SIZE_KEMASAN);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->SIZE_ORDER);
                        $doc->exportField($this->MEASURE_ID3);
                        $doc->exportField($this->NET_PRICE);
                        $doc->exportField($this->AVERAGE_PRICE);
                        $doc->exportField($this->STOCK_AWAL);
                        $doc->exportField($this->STOCK_DITERIMA);
                        $doc->exportField($this->STOCK_DISTRIBUSI);
                        $doc->exportField($this->STOCK_DIJUAL);
                        $doc->exportField($this->STOCK_DIRETUR);
                        $doc->exportField($this->STOCK_DIHAPUS);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->ISACTIVE);
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
