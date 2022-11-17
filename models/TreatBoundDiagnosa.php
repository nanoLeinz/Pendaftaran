<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for TREAT_BOUND_DIAGNOSA
 */
class TreatBoundDiagnosa extends DbTable
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
    public $BOUND_ID;
    public $REAGENT_ID;
    public $BOUND;
    public $DESCRIPTION;
    public $DIAGNOSA;
    public $ISNORMAL;
    public $BOUND_ENGLISH;
    public $DESC_ENGLISH;
    public $CONVERSION;
    public $METHOD_ID;
    public $TARIF_ID;
    public $SATUAN;
    public $SATUAN_ENG;
    public $MIN_VALUE;
    public $MAX_VALUE;
    public $LISS_ID;
    public $MEASURE_ID;
    public $MEASURE_ENGLISH;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'TREAT_BOUND_DIAGNOSA';
        $this->TableName = 'TREAT_BOUND_DIAGNOSA';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[TREAT_BOUND_DIAGNOSA]";
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
        $this->ORG_UNIT_CODE = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // BOUND_ID
        $this->BOUND_ID = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_BOUND_ID', 'BOUND_ID', '[BOUND_ID]', '[BOUND_ID]', 200, 50, -1, false, '[BOUND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BOUND_ID->IsPrimaryKey = true; // Primary key field
        $this->BOUND_ID->Nullable = false; // NOT NULL field
        $this->BOUND_ID->Required = true; // Required field
        $this->BOUND_ID->Sortable = true; // Allow sort
        $this->BOUND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BOUND_ID->Param, "CustomMsg");
        $this->Fields['BOUND_ID'] = &$this->BOUND_ID;

        // REAGENT_ID
        $this->REAGENT_ID = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_REAGENT_ID', 'REAGENT_ID', '[REAGENT_ID]', '[REAGENT_ID]', 200, 50, -1, false, '[REAGENT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REAGENT_ID->IsPrimaryKey = true; // Primary key field
        $this->REAGENT_ID->Nullable = false; // NOT NULL field
        $this->REAGENT_ID->Required = true; // Required field
        $this->REAGENT_ID->Sortable = true; // Allow sort
        $this->REAGENT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REAGENT_ID->Param, "CustomMsg");
        $this->Fields['REAGENT_ID'] = &$this->REAGENT_ID;

        // BOUND
        $this->BOUND = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_BOUND', 'BOUND', '[BOUND]', '[BOUND]', 200, 255, -1, false, '[BOUND]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BOUND->Sortable = true; // Allow sort
        $this->BOUND->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BOUND->Param, "CustomMsg");
        $this->Fields['BOUND'] = &$this->BOUND;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // DIAGNOSA
        $this->DIAGNOSA = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_DIAGNOSA', 'DIAGNOSA', '[DIAGNOSA]', '[DIAGNOSA]', 200, 255, -1, false, '[DIAGNOSA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA->Sortable = true; // Allow sort
        $this->DIAGNOSA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA->Param, "CustomMsg");
        $this->Fields['DIAGNOSA'] = &$this->DIAGNOSA;

        // ISNORMAL
        $this->ISNORMAL = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_ISNORMAL', 'ISNORMAL', '[ISNORMAL]', '[ISNORMAL]', 129, 1, -1, false, '[ISNORMAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISNORMAL->Sortable = true; // Allow sort
        $this->ISNORMAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISNORMAL->Param, "CustomMsg");
        $this->Fields['ISNORMAL'] = &$this->ISNORMAL;

        // BOUND_ENGLISH
        $this->BOUND_ENGLISH = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_BOUND_ENGLISH', 'BOUND_ENGLISH', '[BOUND_ENGLISH]', '[BOUND_ENGLISH]', 200, 200, -1, false, '[BOUND_ENGLISH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BOUND_ENGLISH->Sortable = true; // Allow sort
        $this->BOUND_ENGLISH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BOUND_ENGLISH->Param, "CustomMsg");
        $this->Fields['BOUND_ENGLISH'] = &$this->BOUND_ENGLISH;

        // DESC_ENGLISH
        $this->DESC_ENGLISH = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_DESC_ENGLISH', 'DESC_ENGLISH', '[DESC_ENGLISH]', '[DESC_ENGLISH]', 200, 200, -1, false, '[DESC_ENGLISH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESC_ENGLISH->Sortable = true; // Allow sort
        $this->DESC_ENGLISH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESC_ENGLISH->Param, "CustomMsg");
        $this->Fields['DESC_ENGLISH'] = &$this->DESC_ENGLISH;

        // CONVERSION
        $this->CONVERSION = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_CONVERSION', 'CONVERSION', '[CONVERSION]', 'CAST([CONVERSION] AS NVARCHAR)', 131, 8, -1, false, '[CONVERSION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONVERSION->Sortable = true; // Allow sort
        $this->CONVERSION->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->CONVERSION->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->CONVERSION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONVERSION->Param, "CustomMsg");
        $this->Fields['CONVERSION'] = &$this->CONVERSION;

        // METHOD_ID
        $this->METHOD_ID = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_METHOD_ID', 'METHOD_ID', '[METHOD_ID]', 'CAST([METHOD_ID] AS NVARCHAR)', 17, 1, -1, false, '[METHOD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->METHOD_ID->Sortable = true; // Allow sort
        $this->METHOD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->METHOD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->METHOD_ID->Param, "CustomMsg");
        $this->Fields['METHOD_ID'] = &$this->METHOD_ID;

        // TARIF_ID
        $this->TARIF_ID = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_TARIF_ID', 'TARIF_ID', '[TARIF_ID]', '[TARIF_ID]', 200, 50, -1, false, '[TARIF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_ID->Sortable = true; // Allow sort
        $this->TARIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_ID->Param, "CustomMsg");
        $this->Fields['TARIF_ID'] = &$this->TARIF_ID;

        // SATUAN
        $this->SATUAN = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_SATUAN', 'SATUAN', '[SATUAN]', '[SATUAN]', 200, 50, -1, false, '[SATUAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SATUAN->Sortable = true; // Allow sort
        $this->SATUAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SATUAN->Param, "CustomMsg");
        $this->Fields['SATUAN'] = &$this->SATUAN;

        // SATUAN_ENG
        $this->SATUAN_ENG = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_SATUAN_ENG', 'SATUAN_ENG', '[SATUAN_ENG]', '[SATUAN_ENG]', 200, 50, -1, false, '[SATUAN_ENG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SATUAN_ENG->Sortable = true; // Allow sort
        $this->SATUAN_ENG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SATUAN_ENG->Param, "CustomMsg");
        $this->Fields['SATUAN_ENG'] = &$this->SATUAN_ENG;

        // MIN_VALUE
        $this->MIN_VALUE = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_MIN_VALUE', 'MIN_VALUE', '[MIN_VALUE]', '[MIN_VALUE]', 200, 50, -1, false, '[MIN_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MIN_VALUE->Sortable = true; // Allow sort
        $this->MIN_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MIN_VALUE->Param, "CustomMsg");
        $this->Fields['MIN_VALUE'] = &$this->MIN_VALUE;

        // MAX_VALUE
        $this->MAX_VALUE = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_MAX_VALUE', 'MAX_VALUE', '[MAX_VALUE]', '[MAX_VALUE]', 200, 50, -1, false, '[MAX_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MAX_VALUE->Sortable = true; // Allow sort
        $this->MAX_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MAX_VALUE->Param, "CustomMsg");
        $this->Fields['MAX_VALUE'] = &$this->MAX_VALUE;

        // LISS_ID
        $this->LISS_ID = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_LISS_ID', 'LISS_ID', '[LISS_ID]', '[LISS_ID]', 200, 50, -1, false, '[LISS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LISS_ID->Sortable = true; // Allow sort
        $this->LISS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LISS_ID->Param, "CustomMsg");
        $this->Fields['LISS_ID'] = &$this->LISS_ID;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // MEASURE_ENGLISH
        $this->MEASURE_ENGLISH = new DbField('TREAT_BOUND_DIAGNOSA', 'TREAT_BOUND_DIAGNOSA', 'x_MEASURE_ENGLISH', 'MEASURE_ENGLISH', '[MEASURE_ENGLISH]', 'CAST([MEASURE_ENGLISH] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ENGLISH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ENGLISH->Sortable = true; // Allow sort
        $this->MEASURE_ENGLISH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ENGLISH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ENGLISH->Param, "CustomMsg");
        $this->Fields['MEASURE_ENGLISH'] = &$this->MEASURE_ENGLISH;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[TREAT_BOUND_DIAGNOSA]";
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
            if (array_key_exists('BOUND_ID', $rs)) {
                AddFilter($where, QuotedName('BOUND_ID', $this->Dbid) . '=' . QuotedValue($rs['BOUND_ID'], $this->BOUND_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('REAGENT_ID', $rs)) {
                AddFilter($where, QuotedName('REAGENT_ID', $this->Dbid) . '=' . QuotedValue($rs['REAGENT_ID'], $this->REAGENT_ID->DataType, $this->Dbid));
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
        $this->BOUND_ID->DbValue = $row['BOUND_ID'];
        $this->REAGENT_ID->DbValue = $row['REAGENT_ID'];
        $this->BOUND->DbValue = $row['BOUND'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->DIAGNOSA->DbValue = $row['DIAGNOSA'];
        $this->ISNORMAL->DbValue = $row['ISNORMAL'];
        $this->BOUND_ENGLISH->DbValue = $row['BOUND_ENGLISH'];
        $this->DESC_ENGLISH->DbValue = $row['DESC_ENGLISH'];
        $this->CONVERSION->DbValue = $row['CONVERSION'];
        $this->METHOD_ID->DbValue = $row['METHOD_ID'];
        $this->TARIF_ID->DbValue = $row['TARIF_ID'];
        $this->SATUAN->DbValue = $row['SATUAN'];
        $this->SATUAN_ENG->DbValue = $row['SATUAN_ENG'];
        $this->MIN_VALUE->DbValue = $row['MIN_VALUE'];
        $this->MAX_VALUE->DbValue = $row['MAX_VALUE'];
        $this->LISS_ID->DbValue = $row['LISS_ID'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->MEASURE_ENGLISH->DbValue = $row['MEASURE_ENGLISH'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [BOUND_ID] = '@BOUND_ID@' AND [REAGENT_ID] = '@REAGENT_ID@'";
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
        $val = $current ? $this->BOUND_ID->CurrentValue : $this->BOUND_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->REAGENT_ID->CurrentValue : $this->REAGENT_ID->OldValue;
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
                $this->BOUND_ID->CurrentValue = $keys[1];
            } else {
                $this->BOUND_ID->OldValue = $keys[1];
            }
            if ($current) {
                $this->REAGENT_ID->CurrentValue = $keys[2];
            } else {
                $this->REAGENT_ID->OldValue = $keys[2];
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
            $val = array_key_exists('BOUND_ID', $row) ? $row['BOUND_ID'] : null;
        } else {
            $val = $this->BOUND_ID->OldValue !== null ? $this->BOUND_ID->OldValue : $this->BOUND_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@BOUND_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('REAGENT_ID', $row) ? $row['REAGENT_ID'] : null;
        } else {
            $val = $this->REAGENT_ID->OldValue !== null ? $this->REAGENT_ID->OldValue : $this->REAGENT_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@REAGENT_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("TreatBoundDiagnosaList");
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
        if ($pageName == "TreatBoundDiagnosaView") {
            return $Language->phrase("View");
        } elseif ($pageName == "TreatBoundDiagnosaEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "TreatBoundDiagnosaAdd") {
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
                return "TreatBoundDiagnosaView";
            case Config("API_ADD_ACTION"):
                return "TreatBoundDiagnosaAdd";
            case Config("API_EDIT_ACTION"):
                return "TreatBoundDiagnosaEdit";
            case Config("API_DELETE_ACTION"):
                return "TreatBoundDiagnosaDelete";
            case Config("API_LIST_ACTION"):
                return "TreatBoundDiagnosaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "TreatBoundDiagnosaList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TreatBoundDiagnosaView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("TreatBoundDiagnosaView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "TreatBoundDiagnosaAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "TreatBoundDiagnosaAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("TreatBoundDiagnosaEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("TreatBoundDiagnosaAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("TreatBoundDiagnosaDelete", $this->getUrlParm());
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
        $json .= ",BOUND_ID:" . JsonEncode($this->BOUND_ID->CurrentValue, "string");
        $json .= ",REAGENT_ID:" . JsonEncode($this->REAGENT_ID->CurrentValue, "string");
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
        if ($this->BOUND_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BOUND_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->REAGENT_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->REAGENT_ID->CurrentValue);
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
            if (($keyValue = Param("BOUND_ID") ?? Route("BOUND_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("REAGENT_ID") ?? Route("REAGENT_ID")) !== null) {
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
                $this->BOUND_ID->CurrentValue = $key[1];
            } else {
                $this->BOUND_ID->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->REAGENT_ID->CurrentValue = $key[2];
            } else {
                $this->REAGENT_ID->OldValue = $key[2];
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
        $this->BOUND_ID->setDbValue($row['BOUND_ID']);
        $this->REAGENT_ID->setDbValue($row['REAGENT_ID']);
        $this->BOUND->setDbValue($row['BOUND']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->DIAGNOSA->setDbValue($row['DIAGNOSA']);
        $this->ISNORMAL->setDbValue($row['ISNORMAL']);
        $this->BOUND_ENGLISH->setDbValue($row['BOUND_ENGLISH']);
        $this->DESC_ENGLISH->setDbValue($row['DESC_ENGLISH']);
        $this->CONVERSION->setDbValue($row['CONVERSION']);
        $this->METHOD_ID->setDbValue($row['METHOD_ID']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->SATUAN->setDbValue($row['SATUAN']);
        $this->SATUAN_ENG->setDbValue($row['SATUAN_ENG']);
        $this->MIN_VALUE->setDbValue($row['MIN_VALUE']);
        $this->MAX_VALUE->setDbValue($row['MAX_VALUE']);
        $this->LISS_ID->setDbValue($row['LISS_ID']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->MEASURE_ENGLISH->setDbValue($row['MEASURE_ENGLISH']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // BOUND_ID

        // REAGENT_ID

        // BOUND

        // DESCRIPTION

        // DIAGNOSA

        // ISNORMAL

        // BOUND_ENGLISH

        // DESC_ENGLISH

        // CONVERSION

        // METHOD_ID

        // TARIF_ID

        // SATUAN

        // SATUAN_ENG

        // MIN_VALUE

        // MAX_VALUE

        // LISS_ID

        // MEASURE_ID

        // MEASURE_ENGLISH

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // BOUND_ID
        $this->BOUND_ID->ViewValue = $this->BOUND_ID->CurrentValue;
        $this->BOUND_ID->ViewCustomAttributes = "";

        // REAGENT_ID
        $this->REAGENT_ID->ViewValue = $this->REAGENT_ID->CurrentValue;
        $this->REAGENT_ID->ViewCustomAttributes = "";

        // BOUND
        $this->BOUND->ViewValue = $this->BOUND->CurrentValue;
        $this->BOUND->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // DIAGNOSA
        $this->DIAGNOSA->ViewValue = $this->DIAGNOSA->CurrentValue;
        $this->DIAGNOSA->ViewCustomAttributes = "";

        // ISNORMAL
        $this->ISNORMAL->ViewValue = $this->ISNORMAL->CurrentValue;
        $this->ISNORMAL->ViewCustomAttributes = "";

        // BOUND_ENGLISH
        $this->BOUND_ENGLISH->ViewValue = $this->BOUND_ENGLISH->CurrentValue;
        $this->BOUND_ENGLISH->ViewCustomAttributes = "";

        // DESC_ENGLISH
        $this->DESC_ENGLISH->ViewValue = $this->DESC_ENGLISH->CurrentValue;
        $this->DESC_ENGLISH->ViewCustomAttributes = "";

        // CONVERSION
        $this->CONVERSION->ViewValue = $this->CONVERSION->CurrentValue;
        $this->CONVERSION->ViewValue = FormatNumber($this->CONVERSION->ViewValue, 2, -2, -2, -2);
        $this->CONVERSION->ViewCustomAttributes = "";

        // METHOD_ID
        $this->METHOD_ID->ViewValue = $this->METHOD_ID->CurrentValue;
        $this->METHOD_ID->ViewValue = FormatNumber($this->METHOD_ID->ViewValue, 0, -2, -2, -2);
        $this->METHOD_ID->ViewCustomAttributes = "";

        // TARIF_ID
        $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->ViewCustomAttributes = "";

        // SATUAN
        $this->SATUAN->ViewValue = $this->SATUAN->CurrentValue;
        $this->SATUAN->ViewCustomAttributes = "";

        // SATUAN_ENG
        $this->SATUAN_ENG->ViewValue = $this->SATUAN_ENG->CurrentValue;
        $this->SATUAN_ENG->ViewCustomAttributes = "";

        // MIN_VALUE
        $this->MIN_VALUE->ViewValue = $this->MIN_VALUE->CurrentValue;
        $this->MIN_VALUE->ViewCustomAttributes = "";

        // MAX_VALUE
        $this->MAX_VALUE->ViewValue = $this->MAX_VALUE->CurrentValue;
        $this->MAX_VALUE->ViewCustomAttributes = "";

        // LISS_ID
        $this->LISS_ID->ViewValue = $this->LISS_ID->CurrentValue;
        $this->LISS_ID->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // MEASURE_ENGLISH
        $this->MEASURE_ENGLISH->ViewValue = $this->MEASURE_ENGLISH->CurrentValue;
        $this->MEASURE_ENGLISH->ViewValue = FormatNumber($this->MEASURE_ENGLISH->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ENGLISH->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // BOUND_ID
        $this->BOUND_ID->LinkCustomAttributes = "";
        $this->BOUND_ID->HrefValue = "";
        $this->BOUND_ID->TooltipValue = "";

        // REAGENT_ID
        $this->REAGENT_ID->LinkCustomAttributes = "";
        $this->REAGENT_ID->HrefValue = "";
        $this->REAGENT_ID->TooltipValue = "";

        // BOUND
        $this->BOUND->LinkCustomAttributes = "";
        $this->BOUND->HrefValue = "";
        $this->BOUND->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // DIAGNOSA
        $this->DIAGNOSA->LinkCustomAttributes = "";
        $this->DIAGNOSA->HrefValue = "";
        $this->DIAGNOSA->TooltipValue = "";

        // ISNORMAL
        $this->ISNORMAL->LinkCustomAttributes = "";
        $this->ISNORMAL->HrefValue = "";
        $this->ISNORMAL->TooltipValue = "";

        // BOUND_ENGLISH
        $this->BOUND_ENGLISH->LinkCustomAttributes = "";
        $this->BOUND_ENGLISH->HrefValue = "";
        $this->BOUND_ENGLISH->TooltipValue = "";

        // DESC_ENGLISH
        $this->DESC_ENGLISH->LinkCustomAttributes = "";
        $this->DESC_ENGLISH->HrefValue = "";
        $this->DESC_ENGLISH->TooltipValue = "";

        // CONVERSION
        $this->CONVERSION->LinkCustomAttributes = "";
        $this->CONVERSION->HrefValue = "";
        $this->CONVERSION->TooltipValue = "";

        // METHOD_ID
        $this->METHOD_ID->LinkCustomAttributes = "";
        $this->METHOD_ID->HrefValue = "";
        $this->METHOD_ID->TooltipValue = "";

        // TARIF_ID
        $this->TARIF_ID->LinkCustomAttributes = "";
        $this->TARIF_ID->HrefValue = "";
        $this->TARIF_ID->TooltipValue = "";

        // SATUAN
        $this->SATUAN->LinkCustomAttributes = "";
        $this->SATUAN->HrefValue = "";
        $this->SATUAN->TooltipValue = "";

        // SATUAN_ENG
        $this->SATUAN_ENG->LinkCustomAttributes = "";
        $this->SATUAN_ENG->HrefValue = "";
        $this->SATUAN_ENG->TooltipValue = "";

        // MIN_VALUE
        $this->MIN_VALUE->LinkCustomAttributes = "";
        $this->MIN_VALUE->HrefValue = "";
        $this->MIN_VALUE->TooltipValue = "";

        // MAX_VALUE
        $this->MAX_VALUE->LinkCustomAttributes = "";
        $this->MAX_VALUE->HrefValue = "";
        $this->MAX_VALUE->TooltipValue = "";

        // LISS_ID
        $this->LISS_ID->LinkCustomAttributes = "";
        $this->LISS_ID->HrefValue = "";
        $this->LISS_ID->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // MEASURE_ENGLISH
        $this->MEASURE_ENGLISH->LinkCustomAttributes = "";
        $this->MEASURE_ENGLISH->HrefValue = "";
        $this->MEASURE_ENGLISH->TooltipValue = "";

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

        // BOUND_ID
        $this->BOUND_ID->EditAttrs["class"] = "form-control";
        $this->BOUND_ID->EditCustomAttributes = "";
        if (!$this->BOUND_ID->Raw) {
            $this->BOUND_ID->CurrentValue = HtmlDecode($this->BOUND_ID->CurrentValue);
        }
        $this->BOUND_ID->EditValue = $this->BOUND_ID->CurrentValue;
        $this->BOUND_ID->PlaceHolder = RemoveHtml($this->BOUND_ID->caption());

        // REAGENT_ID
        $this->REAGENT_ID->EditAttrs["class"] = "form-control";
        $this->REAGENT_ID->EditCustomAttributes = "";
        if (!$this->REAGENT_ID->Raw) {
            $this->REAGENT_ID->CurrentValue = HtmlDecode($this->REAGENT_ID->CurrentValue);
        }
        $this->REAGENT_ID->EditValue = $this->REAGENT_ID->CurrentValue;
        $this->REAGENT_ID->PlaceHolder = RemoveHtml($this->REAGENT_ID->caption());

        // BOUND
        $this->BOUND->EditAttrs["class"] = "form-control";
        $this->BOUND->EditCustomAttributes = "";
        if (!$this->BOUND->Raw) {
            $this->BOUND->CurrentValue = HtmlDecode($this->BOUND->CurrentValue);
        }
        $this->BOUND->EditValue = $this->BOUND->CurrentValue;
        $this->BOUND->PlaceHolder = RemoveHtml($this->BOUND->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // DIAGNOSA
        $this->DIAGNOSA->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA->EditCustomAttributes = "";
        if (!$this->DIAGNOSA->Raw) {
            $this->DIAGNOSA->CurrentValue = HtmlDecode($this->DIAGNOSA->CurrentValue);
        }
        $this->DIAGNOSA->EditValue = $this->DIAGNOSA->CurrentValue;
        $this->DIAGNOSA->PlaceHolder = RemoveHtml($this->DIAGNOSA->caption());

        // ISNORMAL
        $this->ISNORMAL->EditAttrs["class"] = "form-control";
        $this->ISNORMAL->EditCustomAttributes = "";
        if (!$this->ISNORMAL->Raw) {
            $this->ISNORMAL->CurrentValue = HtmlDecode($this->ISNORMAL->CurrentValue);
        }
        $this->ISNORMAL->EditValue = $this->ISNORMAL->CurrentValue;
        $this->ISNORMAL->PlaceHolder = RemoveHtml($this->ISNORMAL->caption());

        // BOUND_ENGLISH
        $this->BOUND_ENGLISH->EditAttrs["class"] = "form-control";
        $this->BOUND_ENGLISH->EditCustomAttributes = "";
        if (!$this->BOUND_ENGLISH->Raw) {
            $this->BOUND_ENGLISH->CurrentValue = HtmlDecode($this->BOUND_ENGLISH->CurrentValue);
        }
        $this->BOUND_ENGLISH->EditValue = $this->BOUND_ENGLISH->CurrentValue;
        $this->BOUND_ENGLISH->PlaceHolder = RemoveHtml($this->BOUND_ENGLISH->caption());

        // DESC_ENGLISH
        $this->DESC_ENGLISH->EditAttrs["class"] = "form-control";
        $this->DESC_ENGLISH->EditCustomAttributes = "";
        if (!$this->DESC_ENGLISH->Raw) {
            $this->DESC_ENGLISH->CurrentValue = HtmlDecode($this->DESC_ENGLISH->CurrentValue);
        }
        $this->DESC_ENGLISH->EditValue = $this->DESC_ENGLISH->CurrentValue;
        $this->DESC_ENGLISH->PlaceHolder = RemoveHtml($this->DESC_ENGLISH->caption());

        // CONVERSION
        $this->CONVERSION->EditAttrs["class"] = "form-control";
        $this->CONVERSION->EditCustomAttributes = "";
        $this->CONVERSION->EditValue = $this->CONVERSION->CurrentValue;
        $this->CONVERSION->PlaceHolder = RemoveHtml($this->CONVERSION->caption());
        if (strval($this->CONVERSION->EditValue) != "" && is_numeric($this->CONVERSION->EditValue)) {
            $this->CONVERSION->EditValue = FormatNumber($this->CONVERSION->EditValue, -2, -2, -2, -2);
        }

        // METHOD_ID
        $this->METHOD_ID->EditAttrs["class"] = "form-control";
        $this->METHOD_ID->EditCustomAttributes = "";
        $this->METHOD_ID->EditValue = $this->METHOD_ID->CurrentValue;
        $this->METHOD_ID->PlaceHolder = RemoveHtml($this->METHOD_ID->caption());

        // TARIF_ID
        $this->TARIF_ID->EditAttrs["class"] = "form-control";
        $this->TARIF_ID->EditCustomAttributes = "";
        if (!$this->TARIF_ID->Raw) {
            $this->TARIF_ID->CurrentValue = HtmlDecode($this->TARIF_ID->CurrentValue);
        }
        $this->TARIF_ID->EditValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->PlaceHolder = RemoveHtml($this->TARIF_ID->caption());

        // SATUAN
        $this->SATUAN->EditAttrs["class"] = "form-control";
        $this->SATUAN->EditCustomAttributes = "";
        if (!$this->SATUAN->Raw) {
            $this->SATUAN->CurrentValue = HtmlDecode($this->SATUAN->CurrentValue);
        }
        $this->SATUAN->EditValue = $this->SATUAN->CurrentValue;
        $this->SATUAN->PlaceHolder = RemoveHtml($this->SATUAN->caption());

        // SATUAN_ENG
        $this->SATUAN_ENG->EditAttrs["class"] = "form-control";
        $this->SATUAN_ENG->EditCustomAttributes = "";
        if (!$this->SATUAN_ENG->Raw) {
            $this->SATUAN_ENG->CurrentValue = HtmlDecode($this->SATUAN_ENG->CurrentValue);
        }
        $this->SATUAN_ENG->EditValue = $this->SATUAN_ENG->CurrentValue;
        $this->SATUAN_ENG->PlaceHolder = RemoveHtml($this->SATUAN_ENG->caption());

        // MIN_VALUE
        $this->MIN_VALUE->EditAttrs["class"] = "form-control";
        $this->MIN_VALUE->EditCustomAttributes = "";
        if (!$this->MIN_VALUE->Raw) {
            $this->MIN_VALUE->CurrentValue = HtmlDecode($this->MIN_VALUE->CurrentValue);
        }
        $this->MIN_VALUE->EditValue = $this->MIN_VALUE->CurrentValue;
        $this->MIN_VALUE->PlaceHolder = RemoveHtml($this->MIN_VALUE->caption());

        // MAX_VALUE
        $this->MAX_VALUE->EditAttrs["class"] = "form-control";
        $this->MAX_VALUE->EditCustomAttributes = "";
        if (!$this->MAX_VALUE->Raw) {
            $this->MAX_VALUE->CurrentValue = HtmlDecode($this->MAX_VALUE->CurrentValue);
        }
        $this->MAX_VALUE->EditValue = $this->MAX_VALUE->CurrentValue;
        $this->MAX_VALUE->PlaceHolder = RemoveHtml($this->MAX_VALUE->caption());

        // LISS_ID
        $this->LISS_ID->EditAttrs["class"] = "form-control";
        $this->LISS_ID->EditCustomAttributes = "";
        if (!$this->LISS_ID->Raw) {
            $this->LISS_ID->CurrentValue = HtmlDecode($this->LISS_ID->CurrentValue);
        }
        $this->LISS_ID->EditValue = $this->LISS_ID->CurrentValue;
        $this->LISS_ID->PlaceHolder = RemoveHtml($this->LISS_ID->caption());

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // MEASURE_ENGLISH
        $this->MEASURE_ENGLISH->EditAttrs["class"] = "form-control";
        $this->MEASURE_ENGLISH->EditCustomAttributes = "";
        $this->MEASURE_ENGLISH->EditValue = $this->MEASURE_ENGLISH->CurrentValue;
        $this->MEASURE_ENGLISH->PlaceHolder = RemoveHtml($this->MEASURE_ENGLISH->caption());

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
                    $doc->exportCaption($this->BOUND_ID);
                    $doc->exportCaption($this->REAGENT_ID);
                    $doc->exportCaption($this->BOUND);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DIAGNOSA);
                    $doc->exportCaption($this->ISNORMAL);
                    $doc->exportCaption($this->BOUND_ENGLISH);
                    $doc->exportCaption($this->DESC_ENGLISH);
                    $doc->exportCaption($this->CONVERSION);
                    $doc->exportCaption($this->METHOD_ID);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->SATUAN);
                    $doc->exportCaption($this->SATUAN_ENG);
                    $doc->exportCaption($this->MIN_VALUE);
                    $doc->exportCaption($this->MAX_VALUE);
                    $doc->exportCaption($this->LISS_ID);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->MEASURE_ENGLISH);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->BOUND_ID);
                    $doc->exportCaption($this->REAGENT_ID);
                    $doc->exportCaption($this->BOUND);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DIAGNOSA);
                    $doc->exportCaption($this->ISNORMAL);
                    $doc->exportCaption($this->BOUND_ENGLISH);
                    $doc->exportCaption($this->DESC_ENGLISH);
                    $doc->exportCaption($this->CONVERSION);
                    $doc->exportCaption($this->METHOD_ID);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->SATUAN);
                    $doc->exportCaption($this->SATUAN_ENG);
                    $doc->exportCaption($this->MIN_VALUE);
                    $doc->exportCaption($this->MAX_VALUE);
                    $doc->exportCaption($this->LISS_ID);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->MEASURE_ENGLISH);
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
                        $doc->exportField($this->BOUND_ID);
                        $doc->exportField($this->REAGENT_ID);
                        $doc->exportField($this->BOUND);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DIAGNOSA);
                        $doc->exportField($this->ISNORMAL);
                        $doc->exportField($this->BOUND_ENGLISH);
                        $doc->exportField($this->DESC_ENGLISH);
                        $doc->exportField($this->CONVERSION);
                        $doc->exportField($this->METHOD_ID);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->SATUAN);
                        $doc->exportField($this->SATUAN_ENG);
                        $doc->exportField($this->MIN_VALUE);
                        $doc->exportField($this->MAX_VALUE);
                        $doc->exportField($this->LISS_ID);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->MEASURE_ENGLISH);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->BOUND_ID);
                        $doc->exportField($this->REAGENT_ID);
                        $doc->exportField($this->BOUND);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DIAGNOSA);
                        $doc->exportField($this->ISNORMAL);
                        $doc->exportField($this->BOUND_ENGLISH);
                        $doc->exportField($this->DESC_ENGLISH);
                        $doc->exportField($this->CONVERSION);
                        $doc->exportField($this->METHOD_ID);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->SATUAN);
                        $doc->exportField($this->SATUAN_ENG);
                        $doc->exportField($this->MIN_VALUE);
                        $doc->exportField($this->MAX_VALUE);
                        $doc->exportField($this->LISS_ID);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->MEASURE_ENGLISH);
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
