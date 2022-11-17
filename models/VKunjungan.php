<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for V_KUNJUNGAN
 */
class VKunjungan extends DbTable
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
    public $NO_REGISTRATION;
    public $VISIT_ID;
    public $DIANTAR_OLEH;
    public $VISIT_DATE;
    public $PAYOR_ID;
    public $CLASS_ID;
    public $ISRJ;
    public $CLINIC_ID;
    public $MONTH;
    public $YEAR;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'V_KUNJUNGAN';
        $this->TableName = 'V_KUNJUNGAN';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "dbo.PASIEN_VISITATION";
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

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_NO_REGISTRATION', 'NO_REGISTRATION', 'dbo.PASIEN_VISITATION.NO_REGISTRATION', 'dbo.PASIEN_VISITATION.NO_REGISTRATION', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.NO_REGISTRATION', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->NO_REGISTRATION->IsPrimaryKey = true; // Primary key field
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NO_REGISTRATION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","STATUS_PASIEN_ID",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","STATUS_PASIEN_ID",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_VISIT_ID', 'VISIT_ID', 'dbo.PASIEN_VISITATION.VISIT_ID', 'dbo.PASIEN_VISITATION.VISIT_ID', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.VISIT_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->IsPrimaryKey = true; // Primary key field
        $this->VISIT_ID->Required = true; // Required field
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_DIANTAR_OLEH', 'DIANTAR_OLEH', 'dbo.PASIEN_VISITATION.DIANTAR_OLEH', 'dbo.PASIEN_VISITATION.DIANTAR_OLEH', 200, 255, -1, false, 'dbo.PASIEN_VISITATION.DIANTAR_OLEH', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIANTAR_OLEH->Sortable = true; // Allow sort
        $this->DIANTAR_OLEH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIANTAR_OLEH->Param, "CustomMsg");
        $this->Fields['DIANTAR_OLEH'] = &$this->DIANTAR_OLEH;

        // VISIT_DATE
        $this->VISIT_DATE = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_VISIT_DATE', 'VISIT_DATE', 'dbo.PASIEN_VISITATION.VISIT_DATE', CastDateFieldForLike("dbo.PASIEN_VISITATION.VISIT_DATE", 11, "DB"), 135, 8, 11, false, 'dbo.PASIEN_VISITATION.VISIT_DATE', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_DATE->Sortable = true; // Allow sort
        $this->VISIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->VISIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_DATE->Param, "CustomMsg");
        $this->Fields['VISIT_DATE'] = &$this->VISIT_DATE;

        // PAYOR_ID
        $this->PAYOR_ID = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_PAYOR_ID', 'PAYOR_ID', 'dbo.PASIEN_VISITATION.PAYOR_ID', 'dbo.PASIEN_VISITATION.PAYOR_ID', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.PAYOR_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->PAYOR_ID->Sortable = true; // Allow sort
        $this->PAYOR_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->PAYOR_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->PAYOR_ID->Lookup = new Lookup('PAYOR_ID', 'PAYOR_INFO', false, 'PAYOR_ID', ["PAYOR","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->PAYOR_ID->Lookup = new Lookup('PAYOR_ID', 'PAYOR_INFO', false, 'PAYOR_ID', ["PAYOR","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->PAYOR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ID->Param, "CustomMsg");
        $this->Fields['PAYOR_ID'] = &$this->PAYOR_ID;

        // CLASS_ID
        $this->CLASS_ID = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_CLASS_ID', 'CLASS_ID', 'dbo.PASIEN_VISITATION.CLASS_ID', 'CAST(dbo.PASIEN_VISITATION.CLASS_ID AS NVARCHAR)', 17, 1, -1, false, 'dbo.PASIEN_VISITATION.CLASS_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLASS_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLASS_ID->Lookup = new Lookup('CLASS_ID', 'CLASS2', false, 'CLASS_ID', ["NAME_OF_CLASS","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->CLASS_ID->Lookup = new Lookup('CLASS_ID', 'CLASS2', false, 'CLASS_ID', ["NAME_OF_CLASS","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // ISRJ
        $this->ISRJ = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_ISRJ', 'ISRJ', 'dbo.PASIEN_VISITATION.ISRJ', 'dbo.PASIEN_VISITATION.ISRJ', 129, 1, -1, false, 'dbo.PASIEN_VISITATION.ISRJ', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->ISRJ->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->ISRJ->Lookup = new Lookup('ISRJ', 'CARA_KELUAR', false, 'KELUAR_ID', ["CARA_KELUAR","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ISRJ->Lookup = new Lookup('ISRJ', 'CARA_KELUAR', false, 'KELUAR_ID', ["CARA_KELUAR","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_CLINIC_ID', 'CLINIC_ID', 'dbo.PASIEN_VISITATION.CLINIC_ID', 'dbo.PASIEN_VISITATION.CLINIC_ID', 200, 8, -1, false, 'dbo.PASIEN_VISITATION.CLINIC_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLINIC_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // MONTH
        $this->MONTH = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_MONTH', 'MONTH', 'Month(dbo.PASIEN_VISITATION.VISIT_DATE)', 'CAST(Month(dbo.PASIEN_VISITATION.VISIT_DATE) AS NVARCHAR)', 3, 4, -1, false, 'Month(dbo.PASIEN_VISITATION.VISIT_DATE)', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MONTH->Sortable = true; // Allow sort
        $this->MONTH->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MONTH->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->MONTH->Lookup = new Lookup('MONTH', 'MONTHS', false, 'MONTH_ID', ["MONTHS","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->MONTH->Lookup = new Lookup('MONTH', 'MONTHS', false, 'MONTH_ID', ["MONTHS","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->MONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MONTH->Param, "CustomMsg");
        $this->Fields['MONTH'] = &$this->MONTH;

        // YEAR
        $this->YEAR = new DbField('V_KUNJUNGAN', 'V_KUNJUNGAN', 'x_YEAR', 'YEAR', 'Year(dbo.PASIEN_VISITATION.VISIT_DATE)', 'CAST(Year(dbo.PASIEN_VISITATION.VISIT_DATE) AS NVARCHAR)', 3, 4, -1, false, 'Year(dbo.PASIEN_VISITATION.VISIT_DATE)', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->YEAR->Sortable = true; // Allow sort
        $this->YEAR->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->YEAR->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->YEAR->Lookup = new Lookup('YEAR', 'YEARS', false, 'YEAR_ID', ["YEAR_ID","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->YEAR->Lookup = new Lookup('YEAR', 'YEARS', false, 'YEAR_ID', ["YEAR_ID","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->YEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR->Param, "CustomMsg");
        $this->Fields['YEAR'] = &$this->YEAR;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "dbo.PASIEN_VISITATION";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("dbo.PASIEN_VISITATION.NO_REGISTRATION, dbo.PASIEN_VISITATION.VISIT_ID, dbo.PASIEN_VISITATION.CLASS_ID, dbo.PASIEN_VISITATION.PAYOR_ID, dbo.PASIEN_VISITATION.VISIT_DATE, dbo.PASIEN_VISITATION.ISRJ, dbo.PASIEN_VISITATION.CLINIC_ID, dbo.PASIEN_VISITATION.DIANTAR_OLEH, Month(dbo.PASIEN_VISITATION.VISIT_DATE) AS MONTH, Year(dbo.PASIEN_VISITATION.VISIT_DATE) AS YEAR");
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
            if (array_key_exists('NO_REGISTRATION', $rs)) {
                AddFilter($where, QuotedName('NO_REGISTRATION', $this->Dbid) . '=' . QuotedValue($rs['NO_REGISTRATION'], $this->NO_REGISTRATION->DataType, $this->Dbid));
            }
            if (array_key_exists('VISIT_ID', $rs)) {
                AddFilter($where, QuotedName('VISIT_ID', $this->Dbid) . '=' . QuotedValue($rs['VISIT_ID'], $this->VISIT_ID->DataType, $this->Dbid));
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
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->DIANTAR_OLEH->DbValue = $row['DIANTAR_OLEH'];
        $this->VISIT_DATE->DbValue = $row['VISIT_DATE'];
        $this->PAYOR_ID->DbValue = $row['PAYOR_ID'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->MONTH->DbValue = $row['MONTH'];
        $this->YEAR->DbValue = $row['YEAR'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "dbo.PASIEN_VISITATION.NO_REGISTRATION = '@NO_REGISTRATION@' AND dbo.PASIEN_VISITATION.VISIT_ID = '@VISIT_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->NO_REGISTRATION->CurrentValue : $this->NO_REGISTRATION->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->VISIT_ID->CurrentValue : $this->VISIT_ID->OldValue;
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
                $this->NO_REGISTRATION->CurrentValue = $keys[0];
            } else {
                $this->NO_REGISTRATION->OldValue = $keys[0];
            }
            if ($current) {
                $this->VISIT_ID->CurrentValue = $keys[1];
            } else {
                $this->VISIT_ID->OldValue = $keys[1];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('NO_REGISTRATION', $row) ? $row['NO_REGISTRATION'] : null;
        } else {
            $val = $this->NO_REGISTRATION->OldValue !== null ? $this->NO_REGISTRATION->OldValue : $this->NO_REGISTRATION->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NO_REGISTRATION@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('VISIT_ID', $row) ? $row['VISIT_ID'] : null;
        } else {
            $val = $this->VISIT_ID->OldValue !== null ? $this->VISIT_ID->OldValue : $this->VISIT_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@VISIT_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("VKunjunganList");
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
        if ($pageName == "VKunjunganView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VKunjunganEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VKunjunganAdd") {
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
                return "VKunjunganView";
            case Config("API_ADD_ACTION"):
                return "VKunjunganAdd";
            case Config("API_EDIT_ACTION"):
                return "VKunjunganEdit";
            case Config("API_DELETE_ACTION"):
                return "VKunjunganDelete";
            case Config("API_LIST_ACTION"):
                return "VKunjunganList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VKunjunganList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VKunjunganView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VKunjunganView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VKunjunganAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VKunjunganAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("VKunjunganEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("VKunjunganAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("VKunjunganDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "NO_REGISTRATION:" . JsonEncode($this->NO_REGISTRATION->CurrentValue, "string");
        $json .= ",VISIT_ID:" . JsonEncode($this->VISIT_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NO_REGISTRATION->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NO_REGISTRATION->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->VISIT_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->VISIT_ID->CurrentValue);
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
            if (($keyValue = Param("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("VISIT_ID") ?? Route("VISIT_ID")) !== null) {
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
                $this->NO_REGISTRATION->CurrentValue = $key[0];
            } else {
                $this->NO_REGISTRATION->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->VISIT_ID->CurrentValue = $key[1];
            } else {
                $this->VISIT_ID->OldValue = $key[1];
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
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->DIANTAR_OLEH->setDbValue($row['DIANTAR_OLEH']);
        $this->VISIT_DATE->setDbValue($row['VISIT_DATE']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->MONTH->setDbValue($row['MONTH']);
        $this->YEAR->setDbValue($row['YEAR']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->CellCssStyle = "white-space: nowrap;";

        // VISIT_DATE
        $this->VISIT_DATE->CellCssStyle = "white-space: nowrap;";

        // PAYOR_ID
        $this->PAYOR_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID
        $this->CLASS_ID->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

        // MONTH
        $this->MONTH->CellCssStyle = "white-space: nowrap;";

        // YEAR
        $this->YEAR->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION
        $curVal = trim(strval($this->NO_REGISTRATION->CurrentValue));
        if ($curVal != "") {
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->lookupCacheOption($curVal);
            if ($this->NO_REGISTRATION->ViewValue === null) { // Lookup from database
                $filterWrk = "[NO_REGISTRATION]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->NO_REGISTRATION->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->NO_REGISTRATION->Lookup->renderViewRow($rswrk[0]);
                    $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->displayValue($arwrk);
                } else {
                    $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
                }
            }
        } else {
            $this->NO_REGISTRATION->ViewValue = null;
        }
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->ViewValue = $this->DIANTAR_OLEH->CurrentValue;
        $this->DIANTAR_OLEH->ViewCustomAttributes = "";

        // VISIT_DATE
        $this->VISIT_DATE->ViewValue = $this->VISIT_DATE->CurrentValue;
        $this->VISIT_DATE->ViewValue = FormatDateTime($this->VISIT_DATE->ViewValue, 11);
        $this->VISIT_DATE->ViewCustomAttributes = "";

        // PAYOR_ID
        $curVal = trim(strval($this->PAYOR_ID->CurrentValue));
        if ($curVal != "") {
            $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->lookupCacheOption($curVal);
            if ($this->PAYOR_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[PAYOR_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->PAYOR_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->PAYOR_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->displayValue($arwrk);
                } else {
                    $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
                }
            }
        } else {
            $this->PAYOR_ID->ViewValue = null;
        }
        $this->PAYOR_ID->ViewCustomAttributes = "";

        // CLASS_ID
        $curVal = trim(strval($this->CLASS_ID->CurrentValue));
        if ($curVal != "") {
            $this->CLASS_ID->ViewValue = $this->CLASS_ID->lookupCacheOption($curVal);
            if ($this->CLASS_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[CLASS_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->CLASS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLASS_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLASS_ID->ViewValue = $this->CLASS_ID->displayValue($arwrk);
                } else {
                    $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
                }
            }
        } else {
            $this->CLASS_ID->ViewValue = null;
        }
        $this->CLASS_ID->ViewCustomAttributes = "";

        // ISRJ
        $curVal = trim(strval($this->ISRJ->CurrentValue));
        if ($curVal != "") {
            $this->ISRJ->ViewValue = $this->ISRJ->lookupCacheOption($curVal);
            if ($this->ISRJ->ViewValue === null) { // Lookup from database
                $filterWrk = "[KELUAR_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->ISRJ->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->ISRJ->Lookup->renderViewRow($rswrk[0]);
                    $this->ISRJ->ViewValue = $this->ISRJ->displayValue($arwrk);
                } else {
                    $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
                }
            }
        } else {
            $this->ISRJ->ViewValue = null;
        }
        $this->ISRJ->ViewCustomAttributes = "";

        // CLINIC_ID
        $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
        if ($curVal != "") {
            $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
            if ($this->CLINIC_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "[STYPE_ID] = 1 OR [STYPE_ID] = 2 OR [STYPE_ID] = 5";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLINIC_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->displayValue($arwrk);
                } else {
                    $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
                }
            }
        } else {
            $this->CLINIC_ID->ViewValue = null;
        }
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // MONTH
        $curVal = trim(strval($this->MONTH->CurrentValue));
        if ($curVal != "") {
            $this->MONTH->ViewValue = $this->MONTH->lookupCacheOption($curVal);
            if ($this->MONTH->ViewValue === null) { // Lookup from database
                $filterWrk = "[MONTH_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->MONTH->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MONTH->Lookup->renderViewRow($rswrk[0]);
                    $this->MONTH->ViewValue = $this->MONTH->displayValue($arwrk);
                } else {
                    $this->MONTH->ViewValue = $this->MONTH->CurrentValue;
                }
            }
        } else {
            $this->MONTH->ViewValue = null;
        }
        $this->MONTH->ViewCustomAttributes = "";

        // YEAR
        $curVal = trim(strval($this->YEAR->CurrentValue));
        if ($curVal != "") {
            $this->YEAR->ViewValue = $this->YEAR->lookupCacheOption($curVal);
            if ($this->YEAR->ViewValue === null) { // Lookup from database
                $filterWrk = "[YEAR_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->YEAR->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->YEAR->Lookup->renderViewRow($rswrk[0]);
                    $this->YEAR->ViewValue = $this->YEAR->displayValue($arwrk);
                } else {
                    $this->YEAR->ViewValue = $this->YEAR->CurrentValue;
                }
            }
        } else {
            $this->YEAR->ViewValue = null;
        }
        $this->YEAR->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->LinkCustomAttributes = "";
        $this->DIANTAR_OLEH->HrefValue = "";
        $this->DIANTAR_OLEH->TooltipValue = "";

        // VISIT_DATE
        $this->VISIT_DATE->LinkCustomAttributes = "";
        $this->VISIT_DATE->HrefValue = "";
        $this->VISIT_DATE->TooltipValue = "";

        // PAYOR_ID
        $this->PAYOR_ID->LinkCustomAttributes = "";
        $this->PAYOR_ID->HrefValue = "";
        $this->PAYOR_ID->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // ISRJ
        $this->ISRJ->LinkCustomAttributes = "";
        $this->ISRJ->HrefValue = "";
        $this->ISRJ->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // MONTH
        $this->MONTH->LinkCustomAttributes = "";
        $this->MONTH->HrefValue = "";
        $this->MONTH->TooltipValue = "";

        // YEAR
        $this->YEAR->LinkCustomAttributes = "";
        $this->YEAR->HrefValue = "";
        $this->YEAR->TooltipValue = "";

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

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->EditAttrs["class"] = "form-control";
        $this->DIANTAR_OLEH->EditCustomAttributes = "";
        if (!$this->DIANTAR_OLEH->Raw) {
            $this->DIANTAR_OLEH->CurrentValue = HtmlDecode($this->DIANTAR_OLEH->CurrentValue);
        }
        $this->DIANTAR_OLEH->EditValue = $this->DIANTAR_OLEH->CurrentValue;
        $this->DIANTAR_OLEH->PlaceHolder = RemoveHtml($this->DIANTAR_OLEH->caption());

        // VISIT_DATE

        // PAYOR_ID
        $this->PAYOR_ID->EditAttrs["class"] = "form-control";
        $this->PAYOR_ID->EditCustomAttributes = "";
        $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // ISRJ
        $this->ISRJ->EditAttrs["class"] = "form-control";
        $this->ISRJ->EditCustomAttributes = "";
        $this->ISRJ->PlaceHolder = RemoveHtml($this->ISRJ->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // MONTH
        $this->MONTH->EditAttrs["class"] = "form-control";
        $this->MONTH->EditCustomAttributes = "";
        $this->MONTH->PlaceHolder = RemoveHtml($this->MONTH->caption());

        // YEAR
        $this->YEAR->EditAttrs["class"] = "form-control";
        $this->YEAR->EditCustomAttributes = "";
        $this->YEAR->PlaceHolder = RemoveHtml($this->YEAR->caption());

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
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_DATE);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->MONTH);
                    $doc->exportCaption($this->YEAR);
                } else {
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->DIANTAR_OLEH);
                    $doc->exportCaption($this->VISIT_DATE);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->MONTH);
                    $doc->exportCaption($this->YEAR);
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
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_DATE);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->MONTH);
                        $doc->exportField($this->YEAR);
                    } else {
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->DIANTAR_OLEH);
                        $doc->exportField($this->VISIT_DATE);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->MONTH);
                        $doc->exportField($this->YEAR);
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
