<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for GOODS_RELATION
 */
class GoodsRelation extends DbTable
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
    public $STATUS_PASIEN_ID;
    public $CLASS_ID;
    public $NET_PRICE;
    public $PPN;
    public $MARGIN;
    public $DISCOUNT;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $MARGIN2;
    public $MARGIN3;
    public $MARGIN4;
    public $MARGIN5;
    public $DISCOUNT2;
    public $DISCOUNT3;
    public $DISCOUNT4;
    public $DISCOUNT5;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'GOODS_RELATION';
        $this->TableName = 'GOODS_RELATION';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[GOODS_RELATION]";
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
        $this->ORG_UNIT_CODE = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // BRAND_ID
        $this->BRAND_ID = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_BRAND_ID', 'BRAND_ID', '[BRAND_ID]', '[BRAND_ID]', 200, 50, -1, false, '[BRAND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_ID->IsPrimaryKey = true; // Primary key field
        $this->BRAND_ID->Nullable = false; // NOT NULL field
        $this->BRAND_ID->Required = true; // Required field
        $this->BRAND_ID->Sortable = true; // Allow sort
        $this->BRAND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_ID->Param, "CustomMsg");
        $this->Fields['BRAND_ID'] = &$this->BRAND_ID;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->IsPrimaryKey = true; // Primary key field
        $this->STATUS_PASIEN_ID->Nullable = false; // NOT NULL field
        $this->STATUS_PASIEN_ID->Required = true; // Required field
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // CLASS_ID
        $this->CLASS_ID = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID->IsPrimaryKey = true; // Primary key field
        $this->CLASS_ID->Nullable = false; // NOT NULL field
        $this->CLASS_ID->Required = true; // Required field
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // NET_PRICE
        $this->NET_PRICE = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_NET_PRICE', 'NET_PRICE', '[NET_PRICE]', 'CAST([NET_PRICE] AS NVARCHAR)', 6, 8, -1, false, '[NET_PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NET_PRICE->Sortable = true; // Allow sort
        $this->NET_PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NET_PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NET_PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NET_PRICE->Param, "CustomMsg");
        $this->Fields['NET_PRICE'] = &$this->NET_PRICE;

        // PPN
        $this->PPN = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_PPN', 'PPN', '[PPN]', 'CAST([PPN] AS NVARCHAR)', 131, 8, -1, false, '[PPN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPN->Sortable = true; // Allow sort
        $this->PPN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPN->Param, "CustomMsg");
        $this->Fields['PPN'] = &$this->PPN;

        // MARGIN
        $this->MARGIN = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_MARGIN', 'MARGIN', '[MARGIN]', 'CAST([MARGIN] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN->Sortable = true; // Allow sort
        $this->MARGIN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN->Param, "CustomMsg");
        $this->Fields['MARGIN'] = &$this->MARGIN;

        // DISCOUNT
        $this->DISCOUNT = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_DISCOUNT', 'DISCOUNT', '[DISCOUNT]', 'CAST([DISCOUNT] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT->Sortable = true; // Allow sort
        $this->DISCOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT->Param, "CustomMsg");
        $this->Fields['DISCOUNT'] = &$this->DISCOUNT;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // MARGIN2
        $this->MARGIN2 = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_MARGIN2', 'MARGIN2', '[MARGIN2]', 'CAST([MARGIN2] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN2->Sortable = true; // Allow sort
        $this->MARGIN2->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN2->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN2->Param, "CustomMsg");
        $this->Fields['MARGIN2'] = &$this->MARGIN2;

        // MARGIN3
        $this->MARGIN3 = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_MARGIN3', 'MARGIN3', '[MARGIN3]', 'CAST([MARGIN3] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN3->Sortable = true; // Allow sort
        $this->MARGIN3->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN3->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN3->Param, "CustomMsg");
        $this->Fields['MARGIN3'] = &$this->MARGIN3;

        // MARGIN4
        $this->MARGIN4 = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_MARGIN4', 'MARGIN4', '[MARGIN4]', 'CAST([MARGIN4] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN4]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN4->Sortable = true; // Allow sort
        $this->MARGIN4->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN4->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN4->Param, "CustomMsg");
        $this->Fields['MARGIN4'] = &$this->MARGIN4;

        // MARGIN5
        $this->MARGIN5 = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_MARGIN5', 'MARGIN5', '[MARGIN5]', 'CAST([MARGIN5] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN5]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN5->Sortable = true; // Allow sort
        $this->MARGIN5->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN5->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN5->Param, "CustomMsg");
        $this->Fields['MARGIN5'] = &$this->MARGIN5;

        // DISCOUNT2
        $this->DISCOUNT2 = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_DISCOUNT2', 'DISCOUNT2', '[DISCOUNT2]', 'CAST([DISCOUNT2] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNT2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT2->Sortable = true; // Allow sort
        $this->DISCOUNT2->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT2->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT2->Param, "CustomMsg");
        $this->Fields['DISCOUNT2'] = &$this->DISCOUNT2;

        // DISCOUNT3
        $this->DISCOUNT3 = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_DISCOUNT3', 'DISCOUNT3', '[DISCOUNT3]', 'CAST([DISCOUNT3] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNT3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT3->Sortable = true; // Allow sort
        $this->DISCOUNT3->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT3->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT3->Param, "CustomMsg");
        $this->Fields['DISCOUNT3'] = &$this->DISCOUNT3;

        // DISCOUNT4
        $this->DISCOUNT4 = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_DISCOUNT4', 'DISCOUNT4', '[DISCOUNT4]', 'CAST([DISCOUNT4] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNT4]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT4->Sortable = true; // Allow sort
        $this->DISCOUNT4->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT4->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT4->Param, "CustomMsg");
        $this->Fields['DISCOUNT4'] = &$this->DISCOUNT4;

        // DISCOUNT5
        $this->DISCOUNT5 = new DbField('GOODS_RELATION', 'GOODS_RELATION', 'x_DISCOUNT5', 'DISCOUNT5', '[DISCOUNT5]', 'CAST([DISCOUNT5] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNT5]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT5->Sortable = true; // Allow sort
        $this->DISCOUNT5->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT5->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT5->Param, "CustomMsg");
        $this->Fields['DISCOUNT5'] = &$this->DISCOUNT5;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[GOODS_RELATION]";
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
            if (array_key_exists('STATUS_PASIEN_ID', $rs)) {
                AddFilter($where, QuotedName('STATUS_PASIEN_ID', $this->Dbid) . '=' . QuotedValue($rs['STATUS_PASIEN_ID'], $this->STATUS_PASIEN_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('CLASS_ID', $rs)) {
                AddFilter($where, QuotedName('CLASS_ID', $this->Dbid) . '=' . QuotedValue($rs['CLASS_ID'], $this->CLASS_ID->DataType, $this->Dbid));
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
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->NET_PRICE->DbValue = $row['NET_PRICE'];
        $this->PPN->DbValue = $row['PPN'];
        $this->MARGIN->DbValue = $row['MARGIN'];
        $this->DISCOUNT->DbValue = $row['DISCOUNT'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->MARGIN2->DbValue = $row['MARGIN2'];
        $this->MARGIN3->DbValue = $row['MARGIN3'];
        $this->MARGIN4->DbValue = $row['MARGIN4'];
        $this->MARGIN5->DbValue = $row['MARGIN5'];
        $this->DISCOUNT2->DbValue = $row['DISCOUNT2'];
        $this->DISCOUNT3->DbValue = $row['DISCOUNT3'];
        $this->DISCOUNT4->DbValue = $row['DISCOUNT4'];
        $this->DISCOUNT5->DbValue = $row['DISCOUNT5'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [BRAND_ID] = '@BRAND_ID@' AND [STATUS_PASIEN_ID] = @STATUS_PASIEN_ID@ AND [CLASS_ID] = @CLASS_ID@";
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
        $val = $current ? $this->STATUS_PASIEN_ID->CurrentValue : $this->STATUS_PASIEN_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->CLASS_ID->CurrentValue : $this->CLASS_ID->OldValue;
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
        if (count($keys) == 4) {
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
                $this->STATUS_PASIEN_ID->CurrentValue = $keys[2];
            } else {
                $this->STATUS_PASIEN_ID->OldValue = $keys[2];
            }
            if ($current) {
                $this->CLASS_ID->CurrentValue = $keys[3];
            } else {
                $this->CLASS_ID->OldValue = $keys[3];
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
            $val = array_key_exists('STATUS_PASIEN_ID', $row) ? $row['STATUS_PASIEN_ID'] : null;
        } else {
            $val = $this->STATUS_PASIEN_ID->OldValue !== null ? $this->STATUS_PASIEN_ID->OldValue : $this->STATUS_PASIEN_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@STATUS_PASIEN_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('CLASS_ID', $row) ? $row['CLASS_ID'] : null;
        } else {
            $val = $this->CLASS_ID->OldValue !== null ? $this->CLASS_ID->OldValue : $this->CLASS_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@CLASS_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("GoodsRelationList");
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
        if ($pageName == "GoodsRelationView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GoodsRelationEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GoodsRelationAdd") {
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
                return "GoodsRelationView";
            case Config("API_ADD_ACTION"):
                return "GoodsRelationAdd";
            case Config("API_EDIT_ACTION"):
                return "GoodsRelationEdit";
            case Config("API_DELETE_ACTION"):
                return "GoodsRelationDelete";
            case Config("API_LIST_ACTION"):
                return "GoodsRelationList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GoodsRelationList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GoodsRelationView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GoodsRelationView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GoodsRelationAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GoodsRelationAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GoodsRelationEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("GoodsRelationAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("GoodsRelationDelete", $this->getUrlParm());
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
        $json .= ",STATUS_PASIEN_ID:" . JsonEncode($this->STATUS_PASIEN_ID->CurrentValue, "number");
        $json .= ",CLASS_ID:" . JsonEncode($this->CLASS_ID->CurrentValue, "number");
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
        if ($this->STATUS_PASIEN_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->STATUS_PASIEN_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->CLASS_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->CLASS_ID->CurrentValue);
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
            if (($keyValue = Param("STATUS_PASIEN_ID") ?? Route("STATUS_PASIEN_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(2) ?? Route(4)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("CLASS_ID") ?? Route("CLASS_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(3) ?? Route(5)) !== null)) {
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
                if (!is_array($key) || count($key) != 4) {
                    continue; // Just skip so other keys will still work
                }
                if (!is_numeric($key[2])) { // STATUS_PASIEN_ID
                    continue;
                }
                if (!is_numeric($key[3])) { // CLASS_ID
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
                $this->STATUS_PASIEN_ID->CurrentValue = $key[2];
            } else {
                $this->STATUS_PASIEN_ID->OldValue = $key[2];
            }
            if ($setCurrent) {
                $this->CLASS_ID->CurrentValue = $key[3];
            } else {
                $this->CLASS_ID->OldValue = $key[3];
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
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->NET_PRICE->setDbValue($row['NET_PRICE']);
        $this->PPN->setDbValue($row['PPN']);
        $this->MARGIN->setDbValue($row['MARGIN']);
        $this->DISCOUNT->setDbValue($row['DISCOUNT']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->MARGIN2->setDbValue($row['MARGIN2']);
        $this->MARGIN3->setDbValue($row['MARGIN3']);
        $this->MARGIN4->setDbValue($row['MARGIN4']);
        $this->MARGIN5->setDbValue($row['MARGIN5']);
        $this->DISCOUNT2->setDbValue($row['DISCOUNT2']);
        $this->DISCOUNT3->setDbValue($row['DISCOUNT3']);
        $this->DISCOUNT4->setDbValue($row['DISCOUNT4']);
        $this->DISCOUNT5->setDbValue($row['DISCOUNT5']);
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

        // STATUS_PASIEN_ID

        // CLASS_ID

        // NET_PRICE

        // PPN

        // MARGIN

        // DISCOUNT

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // MARGIN2

        // MARGIN3

        // MARGIN4

        // MARGIN5

        // DISCOUNT2

        // DISCOUNT3

        // DISCOUNT4

        // DISCOUNT5

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // BRAND_ID
        $this->BRAND_ID->ViewValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // CLASS_ID
        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID->ViewCustomAttributes = "";

        // NET_PRICE
        $this->NET_PRICE->ViewValue = $this->NET_PRICE->CurrentValue;
        $this->NET_PRICE->ViewValue = FormatNumber($this->NET_PRICE->ViewValue, 2, -2, -2, -2);
        $this->NET_PRICE->ViewCustomAttributes = "";

        // PPN
        $this->PPN->ViewValue = $this->PPN->CurrentValue;
        $this->PPN->ViewValue = FormatNumber($this->PPN->ViewValue, 2, -2, -2, -2);
        $this->PPN->ViewCustomAttributes = "";

        // MARGIN
        $this->MARGIN->ViewValue = $this->MARGIN->CurrentValue;
        $this->MARGIN->ViewValue = FormatNumber($this->MARGIN->ViewValue, 2, -2, -2, -2);
        $this->MARGIN->ViewCustomAttributes = "";

        // DISCOUNT
        $this->DISCOUNT->ViewValue = $this->DISCOUNT->CurrentValue;
        $this->DISCOUNT->ViewValue = FormatNumber($this->DISCOUNT->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->ViewCustomAttributes = "";

        // MARGIN2
        $this->MARGIN2->ViewValue = $this->MARGIN2->CurrentValue;
        $this->MARGIN2->ViewValue = FormatNumber($this->MARGIN2->ViewValue, 2, -2, -2, -2);
        $this->MARGIN2->ViewCustomAttributes = "";

        // MARGIN3
        $this->MARGIN3->ViewValue = $this->MARGIN3->CurrentValue;
        $this->MARGIN3->ViewValue = FormatNumber($this->MARGIN3->ViewValue, 2, -2, -2, -2);
        $this->MARGIN3->ViewCustomAttributes = "";

        // MARGIN4
        $this->MARGIN4->ViewValue = $this->MARGIN4->CurrentValue;
        $this->MARGIN4->ViewValue = FormatNumber($this->MARGIN4->ViewValue, 2, -2, -2, -2);
        $this->MARGIN4->ViewCustomAttributes = "";

        // MARGIN5
        $this->MARGIN5->ViewValue = $this->MARGIN5->CurrentValue;
        $this->MARGIN5->ViewValue = FormatNumber($this->MARGIN5->ViewValue, 2, -2, -2, -2);
        $this->MARGIN5->ViewCustomAttributes = "";

        // DISCOUNT2
        $this->DISCOUNT2->ViewValue = $this->DISCOUNT2->CurrentValue;
        $this->DISCOUNT2->ViewValue = FormatNumber($this->DISCOUNT2->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT2->ViewCustomAttributes = "";

        // DISCOUNT3
        $this->DISCOUNT3->ViewValue = $this->DISCOUNT3->CurrentValue;
        $this->DISCOUNT3->ViewValue = FormatNumber($this->DISCOUNT3->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT3->ViewCustomAttributes = "";

        // DISCOUNT4
        $this->DISCOUNT4->ViewValue = $this->DISCOUNT4->CurrentValue;
        $this->DISCOUNT4->ViewValue = FormatNumber($this->DISCOUNT4->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT4->ViewCustomAttributes = "";

        // DISCOUNT5
        $this->DISCOUNT5->ViewValue = $this->DISCOUNT5->CurrentValue;
        $this->DISCOUNT5->ViewValue = FormatNumber($this->DISCOUNT5->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT5->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // BRAND_ID
        $this->BRAND_ID->LinkCustomAttributes = "";
        $this->BRAND_ID->HrefValue = "";
        $this->BRAND_ID->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // NET_PRICE
        $this->NET_PRICE->LinkCustomAttributes = "";
        $this->NET_PRICE->HrefValue = "";
        $this->NET_PRICE->TooltipValue = "";

        // PPN
        $this->PPN->LinkCustomAttributes = "";
        $this->PPN->HrefValue = "";
        $this->PPN->TooltipValue = "";

        // MARGIN
        $this->MARGIN->LinkCustomAttributes = "";
        $this->MARGIN->HrefValue = "";
        $this->MARGIN->TooltipValue = "";

        // DISCOUNT
        $this->DISCOUNT->LinkCustomAttributes = "";
        $this->DISCOUNT->HrefValue = "";
        $this->DISCOUNT->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->LinkCustomAttributes = "";
        $this->MODIFIED_FROM->HrefValue = "";
        $this->MODIFIED_FROM->TooltipValue = "";

        // MARGIN2
        $this->MARGIN2->LinkCustomAttributes = "";
        $this->MARGIN2->HrefValue = "";
        $this->MARGIN2->TooltipValue = "";

        // MARGIN3
        $this->MARGIN3->LinkCustomAttributes = "";
        $this->MARGIN3->HrefValue = "";
        $this->MARGIN3->TooltipValue = "";

        // MARGIN4
        $this->MARGIN4->LinkCustomAttributes = "";
        $this->MARGIN4->HrefValue = "";
        $this->MARGIN4->TooltipValue = "";

        // MARGIN5
        $this->MARGIN5->LinkCustomAttributes = "";
        $this->MARGIN5->HrefValue = "";
        $this->MARGIN5->TooltipValue = "";

        // DISCOUNT2
        $this->DISCOUNT2->LinkCustomAttributes = "";
        $this->DISCOUNT2->HrefValue = "";
        $this->DISCOUNT2->TooltipValue = "";

        // DISCOUNT3
        $this->DISCOUNT3->LinkCustomAttributes = "";
        $this->DISCOUNT3->HrefValue = "";
        $this->DISCOUNT3->TooltipValue = "";

        // DISCOUNT4
        $this->DISCOUNT4->LinkCustomAttributes = "";
        $this->DISCOUNT4->HrefValue = "";
        $this->DISCOUNT4->TooltipValue = "";

        // DISCOUNT5
        $this->DISCOUNT5->LinkCustomAttributes = "";
        $this->DISCOUNT5->HrefValue = "";
        $this->DISCOUNT5->TooltipValue = "";

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

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->EditValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // NET_PRICE
        $this->NET_PRICE->EditAttrs["class"] = "form-control";
        $this->NET_PRICE->EditCustomAttributes = "";
        $this->NET_PRICE->EditValue = $this->NET_PRICE->CurrentValue;
        $this->NET_PRICE->PlaceHolder = RemoveHtml($this->NET_PRICE->caption());
        if (strval($this->NET_PRICE->EditValue) != "" && is_numeric($this->NET_PRICE->EditValue)) {
            $this->NET_PRICE->EditValue = FormatNumber($this->NET_PRICE->EditValue, -2, -2, -2, -2);
        }

        // PPN
        $this->PPN->EditAttrs["class"] = "form-control";
        $this->PPN->EditCustomAttributes = "";
        $this->PPN->EditValue = $this->PPN->CurrentValue;
        $this->PPN->PlaceHolder = RemoveHtml($this->PPN->caption());
        if (strval($this->PPN->EditValue) != "" && is_numeric($this->PPN->EditValue)) {
            $this->PPN->EditValue = FormatNumber($this->PPN->EditValue, -2, -2, -2, -2);
        }

        // MARGIN
        $this->MARGIN->EditAttrs["class"] = "form-control";
        $this->MARGIN->EditCustomAttributes = "";
        $this->MARGIN->EditValue = $this->MARGIN->CurrentValue;
        $this->MARGIN->PlaceHolder = RemoveHtml($this->MARGIN->caption());
        if (strval($this->MARGIN->EditValue) != "" && is_numeric($this->MARGIN->EditValue)) {
            $this->MARGIN->EditValue = FormatNumber($this->MARGIN->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT
        $this->DISCOUNT->EditAttrs["class"] = "form-control";
        $this->DISCOUNT->EditCustomAttributes = "";
        $this->DISCOUNT->EditValue = $this->DISCOUNT->CurrentValue;
        $this->DISCOUNT->PlaceHolder = RemoveHtml($this->DISCOUNT->caption());
        if (strval($this->DISCOUNT->EditValue) != "" && is_numeric($this->DISCOUNT->EditValue)) {
            $this->DISCOUNT->EditValue = FormatNumber($this->DISCOUNT->EditValue, -2, -2, -2, -2);
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

        // MODIFIED_FROM
        $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
        $this->MODIFIED_FROM->EditCustomAttributes = "";
        if (!$this->MODIFIED_FROM->Raw) {
            $this->MODIFIED_FROM->CurrentValue = HtmlDecode($this->MODIFIED_FROM->CurrentValue);
        }
        $this->MODIFIED_FROM->EditValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

        // MARGIN2
        $this->MARGIN2->EditAttrs["class"] = "form-control";
        $this->MARGIN2->EditCustomAttributes = "";
        $this->MARGIN2->EditValue = $this->MARGIN2->CurrentValue;
        $this->MARGIN2->PlaceHolder = RemoveHtml($this->MARGIN2->caption());
        if (strval($this->MARGIN2->EditValue) != "" && is_numeric($this->MARGIN2->EditValue)) {
            $this->MARGIN2->EditValue = FormatNumber($this->MARGIN2->EditValue, -2, -2, -2, -2);
        }

        // MARGIN3
        $this->MARGIN3->EditAttrs["class"] = "form-control";
        $this->MARGIN3->EditCustomAttributes = "";
        $this->MARGIN3->EditValue = $this->MARGIN3->CurrentValue;
        $this->MARGIN3->PlaceHolder = RemoveHtml($this->MARGIN3->caption());
        if (strval($this->MARGIN3->EditValue) != "" && is_numeric($this->MARGIN3->EditValue)) {
            $this->MARGIN3->EditValue = FormatNumber($this->MARGIN3->EditValue, -2, -2, -2, -2);
        }

        // MARGIN4
        $this->MARGIN4->EditAttrs["class"] = "form-control";
        $this->MARGIN4->EditCustomAttributes = "";
        $this->MARGIN4->EditValue = $this->MARGIN4->CurrentValue;
        $this->MARGIN4->PlaceHolder = RemoveHtml($this->MARGIN4->caption());
        if (strval($this->MARGIN4->EditValue) != "" && is_numeric($this->MARGIN4->EditValue)) {
            $this->MARGIN4->EditValue = FormatNumber($this->MARGIN4->EditValue, -2, -2, -2, -2);
        }

        // MARGIN5
        $this->MARGIN5->EditAttrs["class"] = "form-control";
        $this->MARGIN5->EditCustomAttributes = "";
        $this->MARGIN5->EditValue = $this->MARGIN5->CurrentValue;
        $this->MARGIN5->PlaceHolder = RemoveHtml($this->MARGIN5->caption());
        if (strval($this->MARGIN5->EditValue) != "" && is_numeric($this->MARGIN5->EditValue)) {
            $this->MARGIN5->EditValue = FormatNumber($this->MARGIN5->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT2
        $this->DISCOUNT2->EditAttrs["class"] = "form-control";
        $this->DISCOUNT2->EditCustomAttributes = "";
        $this->DISCOUNT2->EditValue = $this->DISCOUNT2->CurrentValue;
        $this->DISCOUNT2->PlaceHolder = RemoveHtml($this->DISCOUNT2->caption());
        if (strval($this->DISCOUNT2->EditValue) != "" && is_numeric($this->DISCOUNT2->EditValue)) {
            $this->DISCOUNT2->EditValue = FormatNumber($this->DISCOUNT2->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT3
        $this->DISCOUNT3->EditAttrs["class"] = "form-control";
        $this->DISCOUNT3->EditCustomAttributes = "";
        $this->DISCOUNT3->EditValue = $this->DISCOUNT3->CurrentValue;
        $this->DISCOUNT3->PlaceHolder = RemoveHtml($this->DISCOUNT3->caption());
        if (strval($this->DISCOUNT3->EditValue) != "" && is_numeric($this->DISCOUNT3->EditValue)) {
            $this->DISCOUNT3->EditValue = FormatNumber($this->DISCOUNT3->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT4
        $this->DISCOUNT4->EditAttrs["class"] = "form-control";
        $this->DISCOUNT4->EditCustomAttributes = "";
        $this->DISCOUNT4->EditValue = $this->DISCOUNT4->CurrentValue;
        $this->DISCOUNT4->PlaceHolder = RemoveHtml($this->DISCOUNT4->caption());
        if (strval($this->DISCOUNT4->EditValue) != "" && is_numeric($this->DISCOUNT4->EditValue)) {
            $this->DISCOUNT4->EditValue = FormatNumber($this->DISCOUNT4->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT5
        $this->DISCOUNT5->EditAttrs["class"] = "form-control";
        $this->DISCOUNT5->EditCustomAttributes = "";
        $this->DISCOUNT5->EditValue = $this->DISCOUNT5->CurrentValue;
        $this->DISCOUNT5->PlaceHolder = RemoveHtml($this->DISCOUNT5->caption());
        if (strval($this->DISCOUNT5->EditValue) != "" && is_numeric($this->DISCOUNT5->EditValue)) {
            $this->DISCOUNT5->EditValue = FormatNumber($this->DISCOUNT5->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->NET_PRICE);
                    $doc->exportCaption($this->PPN);
                    $doc->exportCaption($this->MARGIN);
                    $doc->exportCaption($this->DISCOUNT);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->MARGIN2);
                    $doc->exportCaption($this->MARGIN3);
                    $doc->exportCaption($this->MARGIN4);
                    $doc->exportCaption($this->MARGIN5);
                    $doc->exportCaption($this->DISCOUNT2);
                    $doc->exportCaption($this->DISCOUNT3);
                    $doc->exportCaption($this->DISCOUNT4);
                    $doc->exportCaption($this->DISCOUNT5);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->NET_PRICE);
                    $doc->exportCaption($this->PPN);
                    $doc->exportCaption($this->MARGIN);
                    $doc->exportCaption($this->DISCOUNT);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->MARGIN2);
                    $doc->exportCaption($this->MARGIN3);
                    $doc->exportCaption($this->MARGIN4);
                    $doc->exportCaption($this->MARGIN5);
                    $doc->exportCaption($this->DISCOUNT2);
                    $doc->exportCaption($this->DISCOUNT3);
                    $doc->exportCaption($this->DISCOUNT4);
                    $doc->exportCaption($this->DISCOUNT5);
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
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->NET_PRICE);
                        $doc->exportField($this->PPN);
                        $doc->exportField($this->MARGIN);
                        $doc->exportField($this->DISCOUNT);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->MARGIN2);
                        $doc->exportField($this->MARGIN3);
                        $doc->exportField($this->MARGIN4);
                        $doc->exportField($this->MARGIN5);
                        $doc->exportField($this->DISCOUNT2);
                        $doc->exportField($this->DISCOUNT3);
                        $doc->exportField($this->DISCOUNT4);
                        $doc->exportField($this->DISCOUNT5);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->NET_PRICE);
                        $doc->exportField($this->PPN);
                        $doc->exportField($this->MARGIN);
                        $doc->exportField($this->DISCOUNT);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->MARGIN2);
                        $doc->exportField($this->MARGIN3);
                        $doc->exportField($this->MARGIN4);
                        $doc->exportField($this->MARGIN5);
                        $doc->exportField($this->DISCOUNT2);
                        $doc->exportField($this->DISCOUNT3);
                        $doc->exportField($this->DISCOUNT4);
                        $doc->exportField($this->DISCOUNT5);
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
