<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for asketam
 */
class Asketam extends DbTable
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
    public $CODE_5;
    public $BRAND_ID;
    public $NAME;
    public $OTHER_CODE;
    public $DESCRIPTION;
    public $REORDER_POINT;
    public $SIZE_GOODS;
    public $MEASURE_ID;
    public $MEASURE_ID2;
    public $SIZE_KEMASAN;
    public $MEASURE_ID3;
    public $COMPANY_ID;
    public $NET_PRICE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $TH;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'asketam';
        $this->TableName = 'asketam';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[asketam]";
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

        // CODE_5
        $this->CODE_5 = new DbField('asketam', 'asketam', 'x_CODE_5', 'CODE_5', '[CODE_5]', '[CODE_5]', 200, 20, -1, false, '[CODE_5]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CODE_5->Nullable = false; // NOT NULL field
        $this->CODE_5->Required = true; // Required field
        $this->CODE_5->Sortable = true; // Allow sort
        $this->CODE_5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CODE_5->Param, "CustomMsg");
        $this->Fields['CODE_5'] = &$this->CODE_5;

        // BRAND_ID
        $this->BRAND_ID = new DbField('asketam', 'asketam', 'x_BRAND_ID', 'BRAND_ID', '[BRAND_ID]', '[BRAND_ID]', 200, 50, -1, false, '[BRAND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_ID->Nullable = false; // NOT NULL field
        $this->BRAND_ID->Required = true; // Required field
        $this->BRAND_ID->Sortable = true; // Allow sort
        $this->BRAND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_ID->Param, "CustomMsg");
        $this->Fields['BRAND_ID'] = &$this->BRAND_ID;

        // NAME
        $this->NAME = new DbField('asketam', 'asketam', 'x_NAME', 'NAME', '[NAME]', '[NAME]', 200, 255, -1, false, '[NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME->Sortable = true; // Allow sort
        $this->NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME->Param, "CustomMsg");
        $this->Fields['NAME'] = &$this->NAME;

        // OTHER_CODE
        $this->OTHER_CODE = new DbField('asketam', 'asketam', 'x_OTHER_CODE', 'OTHER_CODE', '[OTHER_CODE]', '[OTHER_CODE]', 200, 255, -1, false, '[OTHER_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_CODE->Sortable = true; // Allow sort
        $this->OTHER_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_CODE->Param, "CustomMsg");
        $this->Fields['OTHER_CODE'] = &$this->OTHER_CODE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('asketam', 'asketam', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // REORDER_POINT
        $this->REORDER_POINT = new DbField('asketam', 'asketam', 'x_REORDER_POINT', 'REORDER_POINT', '[REORDER_POINT]', 'CAST([REORDER_POINT] AS NVARCHAR)', 131, 8, -1, false, '[REORDER_POINT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REORDER_POINT->Sortable = true; // Allow sort
        $this->REORDER_POINT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->REORDER_POINT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->REORDER_POINT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REORDER_POINT->Param, "CustomMsg");
        $this->Fields['REORDER_POINT'] = &$this->REORDER_POINT;

        // SIZE_GOODS
        $this->SIZE_GOODS = new DbField('asketam', 'asketam', 'x_SIZE_GOODS', 'SIZE_GOODS', '[SIZE_GOODS]', 'CAST([SIZE_GOODS] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_GOODS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_GOODS->Sortable = true; // Allow sort
        $this->SIZE_GOODS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_GOODS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_GOODS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_GOODS->Param, "CustomMsg");
        $this->Fields['SIZE_GOODS'] = &$this->SIZE_GOODS;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('asketam', 'asketam', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // MEASURE_ID2
        $this->MEASURE_ID2 = new DbField('asketam', 'asketam', 'x_MEASURE_ID2', 'MEASURE_ID2', '[MEASURE_ID2]', 'CAST([MEASURE_ID2] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID2->Sortable = true; // Allow sort
        $this->MEASURE_ID2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID2->Param, "CustomMsg");
        $this->Fields['MEASURE_ID2'] = &$this->MEASURE_ID2;

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN = new DbField('asketam', 'asketam', 'x_SIZE_KEMASAN', 'SIZE_KEMASAN', '[SIZE_KEMASAN]', 'CAST([SIZE_KEMASAN] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_KEMASAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_KEMASAN->Sortable = true; // Allow sort
        $this->SIZE_KEMASAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_KEMASAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_KEMASAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_KEMASAN->Param, "CustomMsg");
        $this->Fields['SIZE_KEMASAN'] = &$this->SIZE_KEMASAN;

        // MEASURE_ID3
        $this->MEASURE_ID3 = new DbField('asketam', 'asketam', 'x_MEASURE_ID3', 'MEASURE_ID3', '[MEASURE_ID3]', 'CAST([MEASURE_ID3] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID3->Sortable = true; // Allow sort
        $this->MEASURE_ID3->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID3->Param, "CustomMsg");
        $this->Fields['MEASURE_ID3'] = &$this->MEASURE_ID3;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('asketam', 'asketam', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 202, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // NET_PRICE
        $this->NET_PRICE = new DbField('asketam', 'asketam', 'x_NET_PRICE', 'NET_PRICE', '[NET_PRICE]', 'CAST([NET_PRICE] AS NVARCHAR)', 6, 8, -1, false, '[NET_PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NET_PRICE->Sortable = true; // Allow sort
        $this->NET_PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NET_PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NET_PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NET_PRICE->Param, "CustomMsg");
        $this->Fields['NET_PRICE'] = &$this->NET_PRICE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('asketam', 'asketam', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('asketam', 'asketam', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 25, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // TH
        $this->TH = new DbField('asketam', 'asketam', 'x_TH', 'TH', '[TH]', 'CAST([TH] AS NVARCHAR)', 2, 2, -1, false, '[TH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TH->Sortable = true; // Allow sort
        $this->TH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TH->Param, "CustomMsg");
        $this->Fields['TH'] = &$this->TH;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[asketam]";
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
        $this->CODE_5->DbValue = $row['CODE_5'];
        $this->BRAND_ID->DbValue = $row['BRAND_ID'];
        $this->NAME->DbValue = $row['NAME'];
        $this->OTHER_CODE->DbValue = $row['OTHER_CODE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->REORDER_POINT->DbValue = $row['REORDER_POINT'];
        $this->SIZE_GOODS->DbValue = $row['SIZE_GOODS'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->MEASURE_ID2->DbValue = $row['MEASURE_ID2'];
        $this->SIZE_KEMASAN->DbValue = $row['SIZE_KEMASAN'];
        $this->MEASURE_ID3->DbValue = $row['MEASURE_ID3'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->NET_PRICE->DbValue = $row['NET_PRICE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->TH->DbValue = $row['TH'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("AsketamList");
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
        if ($pageName == "AsketamView") {
            return $Language->phrase("View");
        } elseif ($pageName == "AsketamEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "AsketamAdd") {
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
                return "AsketamView";
            case Config("API_ADD_ACTION"):
                return "AsketamAdd";
            case Config("API_EDIT_ACTION"):
                return "AsketamEdit";
            case Config("API_DELETE_ACTION"):
                return "AsketamDelete";
            case Config("API_LIST_ACTION"):
                return "AsketamList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "AsketamList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("AsketamView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("AsketamView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "AsketamAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "AsketamAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("AsketamEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("AsketamAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("AsketamDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
        $this->CODE_5->setDbValue($row['CODE_5']);
        $this->BRAND_ID->setDbValue($row['BRAND_ID']);
        $this->NAME->setDbValue($row['NAME']);
        $this->OTHER_CODE->setDbValue($row['OTHER_CODE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->REORDER_POINT->setDbValue($row['REORDER_POINT']);
        $this->SIZE_GOODS->setDbValue($row['SIZE_GOODS']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->MEASURE_ID2->setDbValue($row['MEASURE_ID2']);
        $this->SIZE_KEMASAN->setDbValue($row['SIZE_KEMASAN']);
        $this->MEASURE_ID3->setDbValue($row['MEASURE_ID3']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->NET_PRICE->setDbValue($row['NET_PRICE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->TH->setDbValue($row['TH']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // CODE_5

        // BRAND_ID

        // NAME

        // OTHER_CODE

        // DESCRIPTION

        // REORDER_POINT

        // SIZE_GOODS

        // MEASURE_ID

        // MEASURE_ID2

        // SIZE_KEMASAN

        // MEASURE_ID3

        // COMPANY_ID

        // NET_PRICE

        // MODIFIED_DATE

        // MODIFIED_BY

        // TH

        // CODE_5
        $this->CODE_5->ViewValue = $this->CODE_5->CurrentValue;
        $this->CODE_5->ViewCustomAttributes = "";

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

        // SIZE_GOODS
        $this->SIZE_GOODS->ViewValue = $this->SIZE_GOODS->CurrentValue;
        $this->SIZE_GOODS->ViewValue = FormatNumber($this->SIZE_GOODS->ViewValue, 2, -2, -2, -2);
        $this->SIZE_GOODS->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->ViewValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->ViewValue = FormatNumber($this->MEASURE_ID2->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID2->ViewCustomAttributes = "";

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->ViewValue = $this->SIZE_KEMASAN->CurrentValue;
        $this->SIZE_KEMASAN->ViewValue = FormatNumber($this->SIZE_KEMASAN->ViewValue, 2, -2, -2, -2);
        $this->SIZE_KEMASAN->ViewCustomAttributes = "";

        // MEASURE_ID3
        $this->MEASURE_ID3->ViewValue = $this->MEASURE_ID3->CurrentValue;
        $this->MEASURE_ID3->ViewValue = FormatNumber($this->MEASURE_ID3->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID3->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // NET_PRICE
        $this->NET_PRICE->ViewValue = $this->NET_PRICE->CurrentValue;
        $this->NET_PRICE->ViewValue = FormatNumber($this->NET_PRICE->ViewValue, 2, -2, -2, -2);
        $this->NET_PRICE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // TH
        $this->TH->ViewValue = $this->TH->CurrentValue;
        $this->TH->ViewValue = FormatNumber($this->TH->ViewValue, 0, -2, -2, -2);
        $this->TH->ViewCustomAttributes = "";

        // CODE_5
        $this->CODE_5->LinkCustomAttributes = "";
        $this->CODE_5->HrefValue = "";
        $this->CODE_5->TooltipValue = "";

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

        // SIZE_GOODS
        $this->SIZE_GOODS->LinkCustomAttributes = "";
        $this->SIZE_GOODS->HrefValue = "";
        $this->SIZE_GOODS->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->LinkCustomAttributes = "";
        $this->MEASURE_ID2->HrefValue = "";
        $this->MEASURE_ID2->TooltipValue = "";

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->LinkCustomAttributes = "";
        $this->SIZE_KEMASAN->HrefValue = "";
        $this->SIZE_KEMASAN->TooltipValue = "";

        // MEASURE_ID3
        $this->MEASURE_ID3->LinkCustomAttributes = "";
        $this->MEASURE_ID3->HrefValue = "";
        $this->MEASURE_ID3->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // NET_PRICE
        $this->NET_PRICE->LinkCustomAttributes = "";
        $this->NET_PRICE->HrefValue = "";
        $this->NET_PRICE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // TH
        $this->TH->LinkCustomAttributes = "";
        $this->TH->HrefValue = "";
        $this->TH->TooltipValue = "";

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

        // CODE_5
        $this->CODE_5->EditAttrs["class"] = "form-control";
        $this->CODE_5->EditCustomAttributes = "";
        if (!$this->CODE_5->Raw) {
            $this->CODE_5->CurrentValue = HtmlDecode($this->CODE_5->CurrentValue);
        }
        $this->CODE_5->EditValue = $this->CODE_5->CurrentValue;
        $this->CODE_5->PlaceHolder = RemoveHtml($this->CODE_5->caption());

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

        // SIZE_GOODS
        $this->SIZE_GOODS->EditAttrs["class"] = "form-control";
        $this->SIZE_GOODS->EditCustomAttributes = "";
        $this->SIZE_GOODS->EditValue = $this->SIZE_GOODS->CurrentValue;
        $this->SIZE_GOODS->PlaceHolder = RemoveHtml($this->SIZE_GOODS->caption());
        if (strval($this->SIZE_GOODS->EditValue) != "" && is_numeric($this->SIZE_GOODS->EditValue)) {
            $this->SIZE_GOODS->EditValue = FormatNumber($this->SIZE_GOODS->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // MEASURE_ID2
        $this->MEASURE_ID2->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID2->EditCustomAttributes = "";
        $this->MEASURE_ID2->EditValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->PlaceHolder = RemoveHtml($this->MEASURE_ID2->caption());

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->EditAttrs["class"] = "form-control";
        $this->SIZE_KEMASAN->EditCustomAttributes = "";
        $this->SIZE_KEMASAN->EditValue = $this->SIZE_KEMASAN->CurrentValue;
        $this->SIZE_KEMASAN->PlaceHolder = RemoveHtml($this->SIZE_KEMASAN->caption());
        if (strval($this->SIZE_KEMASAN->EditValue) != "" && is_numeric($this->SIZE_KEMASAN->EditValue)) {
            $this->SIZE_KEMASAN->EditValue = FormatNumber($this->SIZE_KEMASAN->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_ID3
        $this->MEASURE_ID3->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID3->EditCustomAttributes = "";
        $this->MEASURE_ID3->EditValue = $this->MEASURE_ID3->CurrentValue;
        $this->MEASURE_ID3->PlaceHolder = RemoveHtml($this->MEASURE_ID3->caption());

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // NET_PRICE
        $this->NET_PRICE->EditAttrs["class"] = "form-control";
        $this->NET_PRICE->EditCustomAttributes = "";
        $this->NET_PRICE->EditValue = $this->NET_PRICE->CurrentValue;
        $this->NET_PRICE->PlaceHolder = RemoveHtml($this->NET_PRICE->caption());
        if (strval($this->NET_PRICE->EditValue) != "" && is_numeric($this->NET_PRICE->EditValue)) {
            $this->NET_PRICE->EditValue = FormatNumber($this->NET_PRICE->EditValue, -2, -2, -2, -2);
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

        // TH
        $this->TH->EditAttrs["class"] = "form-control";
        $this->TH->EditCustomAttributes = "";
        $this->TH->EditValue = $this->TH->CurrentValue;
        $this->TH->PlaceHolder = RemoveHtml($this->TH->caption());

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
                    $doc->exportCaption($this->CODE_5);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->NAME);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->REORDER_POINT);
                    $doc->exportCaption($this->SIZE_GOODS);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->SIZE_KEMASAN);
                    $doc->exportCaption($this->MEASURE_ID3);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->NET_PRICE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->TH);
                } else {
                    $doc->exportCaption($this->CODE_5);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->NAME);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->REORDER_POINT);
                    $doc->exportCaption($this->SIZE_GOODS);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->SIZE_KEMASAN);
                    $doc->exportCaption($this->MEASURE_ID3);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->NET_PRICE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->TH);
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
                        $doc->exportField($this->CODE_5);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->NAME);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->REORDER_POINT);
                        $doc->exportField($this->SIZE_GOODS);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->SIZE_KEMASAN);
                        $doc->exportField($this->MEASURE_ID3);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->NET_PRICE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->TH);
                    } else {
                        $doc->exportField($this->CODE_5);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->NAME);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->REORDER_POINT);
                        $doc->exportField($this->SIZE_GOODS);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->SIZE_KEMASAN);
                        $doc->exportField($this->MEASURE_ID3);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->NET_PRICE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->TH);
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
