<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for INASIS_GET_KETERSEDIAANKAMAR
 */
class InasisGetKetersediaankamar extends DbTable
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
    public $KODEPPK;
    public $KODEKELAS;
    public $NAMAKELAS;
    public $KODERUANG;
    public $NAMARUANG;
    public $KAPASITAS;
    public $TERSEDIA;
    public $TERSEDIAPRIA;
    public $TERSEDIAWANITA;
    public $TERSEDIAPRIAWANITA;
    public $ROWNUMBER;
    public $LASTUPDATEALL;
    public $LASTUPDATE;
    public $REST_RESPON;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'INASIS_GET_KETERSEDIAANKAMAR';
        $this->TableName = 'INASIS_GET_KETERSEDIAANKAMAR';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[INASIS_GET_KETERSEDIAANKAMAR]";
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

        // KODEPPK
        $this->KODEPPK = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_KODEPPK', 'KODEPPK', '[KODEPPK]', '[KODEPPK]', 200, 8, -1, false, '[KODEPPK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODEPPK->IsPrimaryKey = true; // Primary key field
        $this->KODEPPK->Nullable = false; // NOT NULL field
        $this->KODEPPK->Required = true; // Required field
        $this->KODEPPK->Sortable = true; // Allow sort
        $this->KODEPPK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODEPPK->Param, "CustomMsg");
        $this->Fields['KODEPPK'] = &$this->KODEPPK;

        // KODEKELAS
        $this->KODEKELAS = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_KODEKELAS', 'KODEKELAS', '[KODEKELAS]', '[KODEKELAS]', 200, 5, -1, false, '[KODEKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODEKELAS->IsPrimaryKey = true; // Primary key field
        $this->KODEKELAS->Nullable = false; // NOT NULL field
        $this->KODEKELAS->Required = true; // Required field
        $this->KODEKELAS->Sortable = true; // Allow sort
        $this->KODEKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODEKELAS->Param, "CustomMsg");
        $this->Fields['KODEKELAS'] = &$this->KODEKELAS;

        // NAMAKELAS
        $this->NAMAKELAS = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_NAMAKELAS', 'NAMAKELAS', '[NAMAKELAS]', '[NAMAKELAS]', 200, 50, -1, false, '[NAMAKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMAKELAS->Sortable = true; // Allow sort
        $this->NAMAKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMAKELAS->Param, "CustomMsg");
        $this->Fields['NAMAKELAS'] = &$this->NAMAKELAS;

        // KODERUANG
        $this->KODERUANG = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_KODERUANG', 'KODERUANG', '[KODERUANG]', '[KODERUANG]', 200, 10, -1, false, '[KODERUANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODERUANG->IsPrimaryKey = true; // Primary key field
        $this->KODERUANG->Nullable = false; // NOT NULL field
        $this->KODERUANG->Required = true; // Required field
        $this->KODERUANG->Sortable = true; // Allow sort
        $this->KODERUANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODERUANG->Param, "CustomMsg");
        $this->Fields['KODERUANG'] = &$this->KODERUANG;

        // NAMARUANG
        $this->NAMARUANG = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_NAMARUANG', 'NAMARUANG', '[NAMARUANG]', '[NAMARUANG]', 200, 150, -1, false, '[NAMARUANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMARUANG->Sortable = true; // Allow sort
        $this->NAMARUANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMARUANG->Param, "CustomMsg");
        $this->Fields['NAMARUANG'] = &$this->NAMARUANG;

        // KAPASITAS
        $this->KAPASITAS = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_KAPASITAS', 'KAPASITAS', '[KAPASITAS]', 'CAST([KAPASITAS] AS NVARCHAR)', 2, 2, -1, false, '[KAPASITAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAPASITAS->Sortable = true; // Allow sort
        $this->KAPASITAS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KAPASITAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAPASITAS->Param, "CustomMsg");
        $this->Fields['KAPASITAS'] = &$this->KAPASITAS;

        // TERSEDIA
        $this->TERSEDIA = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_TERSEDIA', 'TERSEDIA', '[TERSEDIA]', 'CAST([TERSEDIA] AS NVARCHAR)', 2, 2, -1, false, '[TERSEDIA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERSEDIA->Sortable = true; // Allow sort
        $this->TERSEDIA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TERSEDIA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERSEDIA->Param, "CustomMsg");
        $this->Fields['TERSEDIA'] = &$this->TERSEDIA;

        // TERSEDIAPRIA
        $this->TERSEDIAPRIA = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_TERSEDIAPRIA', 'TERSEDIAPRIA', '[TERSEDIAPRIA]', 'CAST([TERSEDIAPRIA] AS NVARCHAR)', 2, 2, -1, false, '[TERSEDIAPRIA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERSEDIAPRIA->Sortable = true; // Allow sort
        $this->TERSEDIAPRIA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TERSEDIAPRIA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERSEDIAPRIA->Param, "CustomMsg");
        $this->Fields['TERSEDIAPRIA'] = &$this->TERSEDIAPRIA;

        // TERSEDIAWANITA
        $this->TERSEDIAWANITA = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_TERSEDIAWANITA', 'TERSEDIAWANITA', '[TERSEDIAWANITA]', 'CAST([TERSEDIAWANITA] AS NVARCHAR)', 2, 2, -1, false, '[TERSEDIAWANITA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERSEDIAWANITA->Sortable = true; // Allow sort
        $this->TERSEDIAWANITA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TERSEDIAWANITA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERSEDIAWANITA->Param, "CustomMsg");
        $this->Fields['TERSEDIAWANITA'] = &$this->TERSEDIAWANITA;

        // TERSEDIAPRIAWANITA
        $this->TERSEDIAPRIAWANITA = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_TERSEDIAPRIAWANITA', 'TERSEDIAPRIAWANITA', '[TERSEDIAPRIAWANITA]', 'CAST([TERSEDIAPRIAWANITA] AS NVARCHAR)', 2, 2, -1, false, '[TERSEDIAPRIAWANITA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERSEDIAPRIAWANITA->Sortable = true; // Allow sort
        $this->TERSEDIAPRIAWANITA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TERSEDIAPRIAWANITA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERSEDIAPRIAWANITA->Param, "CustomMsg");
        $this->Fields['TERSEDIAPRIAWANITA'] = &$this->TERSEDIAPRIAWANITA;

        // ROWNUMBER
        $this->ROWNUMBER = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_ROWNUMBER', 'ROWNUMBER', '[ROWNUMBER]', 'CAST([ROWNUMBER] AS NVARCHAR)', 2, 2, -1, false, '[ROWNUMBER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ROWNUMBER->Sortable = true; // Allow sort
        $this->ROWNUMBER->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ROWNUMBER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ROWNUMBER->Param, "CustomMsg");
        $this->Fields['ROWNUMBER'] = &$this->ROWNUMBER;

        // LASTUPDATEALL
        $this->LASTUPDATEALL = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_LASTUPDATEALL', 'LASTUPDATEALL', '[LASTUPDATEALL]', '[LASTUPDATEALL]', 200, 50, -1, false, '[LASTUPDATEALL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LASTUPDATEALL->Sortable = true; // Allow sort
        $this->LASTUPDATEALL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LASTUPDATEALL->Param, "CustomMsg");
        $this->Fields['LASTUPDATEALL'] = &$this->LASTUPDATEALL;

        // LASTUPDATE
        $this->LASTUPDATE = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_LASTUPDATE', 'LASTUPDATE', '[LASTUPDATE]', '[LASTUPDATE]', 200, 50, -1, false, '[LASTUPDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LASTUPDATE->Sortable = true; // Allow sort
        $this->LASTUPDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LASTUPDATE->Param, "CustomMsg");
        $this->Fields['LASTUPDATE'] = &$this->LASTUPDATE;

        // REST_RESPON
        $this->REST_RESPON = new DbField('INASIS_GET_KETERSEDIAANKAMAR', 'INASIS_GET_KETERSEDIAANKAMAR', 'x_REST_RESPON', 'REST_RESPON', '[REST_RESPON]', '[REST_RESPON]', 201, 0, -1, false, '[REST_RESPON]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->REST_RESPON->Sortable = true; // Allow sort
        $this->REST_RESPON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_RESPON->Param, "CustomMsg");
        $this->Fields['REST_RESPON'] = &$this->REST_RESPON;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[INASIS_GET_KETERSEDIAANKAMAR]";
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
            if (array_key_exists('KODEPPK', $rs)) {
                AddFilter($where, QuotedName('KODEPPK', $this->Dbid) . '=' . QuotedValue($rs['KODEPPK'], $this->KODEPPK->DataType, $this->Dbid));
            }
            if (array_key_exists('KODEKELAS', $rs)) {
                AddFilter($where, QuotedName('KODEKELAS', $this->Dbid) . '=' . QuotedValue($rs['KODEKELAS'], $this->KODEKELAS->DataType, $this->Dbid));
            }
            if (array_key_exists('KODERUANG', $rs)) {
                AddFilter($where, QuotedName('KODERUANG', $this->Dbid) . '=' . QuotedValue($rs['KODERUANG'], $this->KODERUANG->DataType, $this->Dbid));
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
        $this->KODEPPK->DbValue = $row['KODEPPK'];
        $this->KODEKELAS->DbValue = $row['KODEKELAS'];
        $this->NAMAKELAS->DbValue = $row['NAMAKELAS'];
        $this->KODERUANG->DbValue = $row['KODERUANG'];
        $this->NAMARUANG->DbValue = $row['NAMARUANG'];
        $this->KAPASITAS->DbValue = $row['KAPASITAS'];
        $this->TERSEDIA->DbValue = $row['TERSEDIA'];
        $this->TERSEDIAPRIA->DbValue = $row['TERSEDIAPRIA'];
        $this->TERSEDIAWANITA->DbValue = $row['TERSEDIAWANITA'];
        $this->TERSEDIAPRIAWANITA->DbValue = $row['TERSEDIAPRIAWANITA'];
        $this->ROWNUMBER->DbValue = $row['ROWNUMBER'];
        $this->LASTUPDATEALL->DbValue = $row['LASTUPDATEALL'];
        $this->LASTUPDATE->DbValue = $row['LASTUPDATE'];
        $this->REST_RESPON->DbValue = $row['REST_RESPON'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[KODEPPK] = '@KODEPPK@' AND [KODEKELAS] = '@KODEKELAS@' AND [KODERUANG] = '@KODERUANG@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->KODEPPK->CurrentValue : $this->KODEPPK->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->KODEKELAS->CurrentValue : $this->KODEKELAS->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->KODERUANG->CurrentValue : $this->KODERUANG->OldValue;
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
                $this->KODEPPK->CurrentValue = $keys[0];
            } else {
                $this->KODEPPK->OldValue = $keys[0];
            }
            if ($current) {
                $this->KODEKELAS->CurrentValue = $keys[1];
            } else {
                $this->KODEKELAS->OldValue = $keys[1];
            }
            if ($current) {
                $this->KODERUANG->CurrentValue = $keys[2];
            } else {
                $this->KODERUANG->OldValue = $keys[2];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('KODEPPK', $row) ? $row['KODEPPK'] : null;
        } else {
            $val = $this->KODEPPK->OldValue !== null ? $this->KODEPPK->OldValue : $this->KODEPPK->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@KODEPPK@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('KODEKELAS', $row) ? $row['KODEKELAS'] : null;
        } else {
            $val = $this->KODEKELAS->OldValue !== null ? $this->KODEKELAS->OldValue : $this->KODEKELAS->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@KODEKELAS@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('KODERUANG', $row) ? $row['KODERUANG'] : null;
        } else {
            $val = $this->KODERUANG->OldValue !== null ? $this->KODERUANG->OldValue : $this->KODERUANG->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@KODERUANG@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("InasisGetKetersediaankamarList");
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
        if ($pageName == "InasisGetKetersediaankamarView") {
            return $Language->phrase("View");
        } elseif ($pageName == "InasisGetKetersediaankamarEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "InasisGetKetersediaankamarAdd") {
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
                return "InasisGetKetersediaankamarView";
            case Config("API_ADD_ACTION"):
                return "InasisGetKetersediaankamarAdd";
            case Config("API_EDIT_ACTION"):
                return "InasisGetKetersediaankamarEdit";
            case Config("API_DELETE_ACTION"):
                return "InasisGetKetersediaankamarDelete";
            case Config("API_LIST_ACTION"):
                return "InasisGetKetersediaankamarList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "InasisGetKetersediaankamarList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("InasisGetKetersediaankamarView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("InasisGetKetersediaankamarView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "InasisGetKetersediaankamarAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "InasisGetKetersediaankamarAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("InasisGetKetersediaankamarEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("InasisGetKetersediaankamarAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("InasisGetKetersediaankamarDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "KODEPPK:" . JsonEncode($this->KODEPPK->CurrentValue, "string");
        $json .= ",KODEKELAS:" . JsonEncode($this->KODEKELAS->CurrentValue, "string");
        $json .= ",KODERUANG:" . JsonEncode($this->KODERUANG->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->KODEPPK->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->KODEPPK->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->KODEKELAS->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->KODEKELAS->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->KODERUANG->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->KODERUANG->CurrentValue);
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
            if (($keyValue = Param("KODEPPK") ?? Route("KODEPPK")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("KODEKELAS") ?? Route("KODEKELAS")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("KODERUANG") ?? Route("KODERUANG")) !== null) {
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
                $this->KODEPPK->CurrentValue = $key[0];
            } else {
                $this->KODEPPK->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->KODEKELAS->CurrentValue = $key[1];
            } else {
                $this->KODEKELAS->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->KODERUANG->CurrentValue = $key[2];
            } else {
                $this->KODERUANG->OldValue = $key[2];
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
        $this->KODEPPK->setDbValue($row['KODEPPK']);
        $this->KODEKELAS->setDbValue($row['KODEKELAS']);
        $this->NAMAKELAS->setDbValue($row['NAMAKELAS']);
        $this->KODERUANG->setDbValue($row['KODERUANG']);
        $this->NAMARUANG->setDbValue($row['NAMARUANG']);
        $this->KAPASITAS->setDbValue($row['KAPASITAS']);
        $this->TERSEDIA->setDbValue($row['TERSEDIA']);
        $this->TERSEDIAPRIA->setDbValue($row['TERSEDIAPRIA']);
        $this->TERSEDIAWANITA->setDbValue($row['TERSEDIAWANITA']);
        $this->TERSEDIAPRIAWANITA->setDbValue($row['TERSEDIAPRIAWANITA']);
        $this->ROWNUMBER->setDbValue($row['ROWNUMBER']);
        $this->LASTUPDATEALL->setDbValue($row['LASTUPDATEALL']);
        $this->LASTUPDATE->setDbValue($row['LASTUPDATE']);
        $this->REST_RESPON->setDbValue($row['REST_RESPON']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // KODEPPK

        // KODEKELAS

        // NAMAKELAS

        // KODERUANG

        // NAMARUANG

        // KAPASITAS

        // TERSEDIA

        // TERSEDIAPRIA

        // TERSEDIAWANITA

        // TERSEDIAPRIAWANITA

        // ROWNUMBER

        // LASTUPDATEALL

        // LASTUPDATE

        // REST_RESPON

        // KODEPPK
        $this->KODEPPK->ViewValue = $this->KODEPPK->CurrentValue;
        $this->KODEPPK->ViewCustomAttributes = "";

        // KODEKELAS
        $this->KODEKELAS->ViewValue = $this->KODEKELAS->CurrentValue;
        $this->KODEKELAS->ViewCustomAttributes = "";

        // NAMAKELAS
        $this->NAMAKELAS->ViewValue = $this->NAMAKELAS->CurrentValue;
        $this->NAMAKELAS->ViewCustomAttributes = "";

        // KODERUANG
        $this->KODERUANG->ViewValue = $this->KODERUANG->CurrentValue;
        $this->KODERUANG->ViewCustomAttributes = "";

        // NAMARUANG
        $this->NAMARUANG->ViewValue = $this->NAMARUANG->CurrentValue;
        $this->NAMARUANG->ViewCustomAttributes = "";

        // KAPASITAS
        $this->KAPASITAS->ViewValue = $this->KAPASITAS->CurrentValue;
        $this->KAPASITAS->ViewValue = FormatNumber($this->KAPASITAS->ViewValue, 0, -2, -2, -2);
        $this->KAPASITAS->ViewCustomAttributes = "";

        // TERSEDIA
        $this->TERSEDIA->ViewValue = $this->TERSEDIA->CurrentValue;
        $this->TERSEDIA->ViewValue = FormatNumber($this->TERSEDIA->ViewValue, 0, -2, -2, -2);
        $this->TERSEDIA->ViewCustomAttributes = "";

        // TERSEDIAPRIA
        $this->TERSEDIAPRIA->ViewValue = $this->TERSEDIAPRIA->CurrentValue;
        $this->TERSEDIAPRIA->ViewValue = FormatNumber($this->TERSEDIAPRIA->ViewValue, 0, -2, -2, -2);
        $this->TERSEDIAPRIA->ViewCustomAttributes = "";

        // TERSEDIAWANITA
        $this->TERSEDIAWANITA->ViewValue = $this->TERSEDIAWANITA->CurrentValue;
        $this->TERSEDIAWANITA->ViewValue = FormatNumber($this->TERSEDIAWANITA->ViewValue, 0, -2, -2, -2);
        $this->TERSEDIAWANITA->ViewCustomAttributes = "";

        // TERSEDIAPRIAWANITA
        $this->TERSEDIAPRIAWANITA->ViewValue = $this->TERSEDIAPRIAWANITA->CurrentValue;
        $this->TERSEDIAPRIAWANITA->ViewValue = FormatNumber($this->TERSEDIAPRIAWANITA->ViewValue, 0, -2, -2, -2);
        $this->TERSEDIAPRIAWANITA->ViewCustomAttributes = "";

        // ROWNUMBER
        $this->ROWNUMBER->ViewValue = $this->ROWNUMBER->CurrentValue;
        $this->ROWNUMBER->ViewValue = FormatNumber($this->ROWNUMBER->ViewValue, 0, -2, -2, -2);
        $this->ROWNUMBER->ViewCustomAttributes = "";

        // LASTUPDATEALL
        $this->LASTUPDATEALL->ViewValue = $this->LASTUPDATEALL->CurrentValue;
        $this->LASTUPDATEALL->ViewCustomAttributes = "";

        // LASTUPDATE
        $this->LASTUPDATE->ViewValue = $this->LASTUPDATE->CurrentValue;
        $this->LASTUPDATE->ViewCustomAttributes = "";

        // REST_RESPON
        $this->REST_RESPON->ViewValue = $this->REST_RESPON->CurrentValue;
        $this->REST_RESPON->ViewCustomAttributes = "";

        // KODEPPK
        $this->KODEPPK->LinkCustomAttributes = "";
        $this->KODEPPK->HrefValue = "";
        $this->KODEPPK->TooltipValue = "";

        // KODEKELAS
        $this->KODEKELAS->LinkCustomAttributes = "";
        $this->KODEKELAS->HrefValue = "";
        $this->KODEKELAS->TooltipValue = "";

        // NAMAKELAS
        $this->NAMAKELAS->LinkCustomAttributes = "";
        $this->NAMAKELAS->HrefValue = "";
        $this->NAMAKELAS->TooltipValue = "";

        // KODERUANG
        $this->KODERUANG->LinkCustomAttributes = "";
        $this->KODERUANG->HrefValue = "";
        $this->KODERUANG->TooltipValue = "";

        // NAMARUANG
        $this->NAMARUANG->LinkCustomAttributes = "";
        $this->NAMARUANG->HrefValue = "";
        $this->NAMARUANG->TooltipValue = "";

        // KAPASITAS
        $this->KAPASITAS->LinkCustomAttributes = "";
        $this->KAPASITAS->HrefValue = "";
        $this->KAPASITAS->TooltipValue = "";

        // TERSEDIA
        $this->TERSEDIA->LinkCustomAttributes = "";
        $this->TERSEDIA->HrefValue = "";
        $this->TERSEDIA->TooltipValue = "";

        // TERSEDIAPRIA
        $this->TERSEDIAPRIA->LinkCustomAttributes = "";
        $this->TERSEDIAPRIA->HrefValue = "";
        $this->TERSEDIAPRIA->TooltipValue = "";

        // TERSEDIAWANITA
        $this->TERSEDIAWANITA->LinkCustomAttributes = "";
        $this->TERSEDIAWANITA->HrefValue = "";
        $this->TERSEDIAWANITA->TooltipValue = "";

        // TERSEDIAPRIAWANITA
        $this->TERSEDIAPRIAWANITA->LinkCustomAttributes = "";
        $this->TERSEDIAPRIAWANITA->HrefValue = "";
        $this->TERSEDIAPRIAWANITA->TooltipValue = "";

        // ROWNUMBER
        $this->ROWNUMBER->LinkCustomAttributes = "";
        $this->ROWNUMBER->HrefValue = "";
        $this->ROWNUMBER->TooltipValue = "";

        // LASTUPDATEALL
        $this->LASTUPDATEALL->LinkCustomAttributes = "";
        $this->LASTUPDATEALL->HrefValue = "";
        $this->LASTUPDATEALL->TooltipValue = "";

        // LASTUPDATE
        $this->LASTUPDATE->LinkCustomAttributes = "";
        $this->LASTUPDATE->HrefValue = "";
        $this->LASTUPDATE->TooltipValue = "";

        // REST_RESPON
        $this->REST_RESPON->LinkCustomAttributes = "";
        $this->REST_RESPON->HrefValue = "";
        $this->REST_RESPON->TooltipValue = "";

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

        // KODEPPK
        $this->KODEPPK->EditAttrs["class"] = "form-control";
        $this->KODEPPK->EditCustomAttributes = "";
        if (!$this->KODEPPK->Raw) {
            $this->KODEPPK->CurrentValue = HtmlDecode($this->KODEPPK->CurrentValue);
        }
        $this->KODEPPK->EditValue = $this->KODEPPK->CurrentValue;
        $this->KODEPPK->PlaceHolder = RemoveHtml($this->KODEPPK->caption());

        // KODEKELAS
        $this->KODEKELAS->EditAttrs["class"] = "form-control";
        $this->KODEKELAS->EditCustomAttributes = "";
        if (!$this->KODEKELAS->Raw) {
            $this->KODEKELAS->CurrentValue = HtmlDecode($this->KODEKELAS->CurrentValue);
        }
        $this->KODEKELAS->EditValue = $this->KODEKELAS->CurrentValue;
        $this->KODEKELAS->PlaceHolder = RemoveHtml($this->KODEKELAS->caption());

        // NAMAKELAS
        $this->NAMAKELAS->EditAttrs["class"] = "form-control";
        $this->NAMAKELAS->EditCustomAttributes = "";
        if (!$this->NAMAKELAS->Raw) {
            $this->NAMAKELAS->CurrentValue = HtmlDecode($this->NAMAKELAS->CurrentValue);
        }
        $this->NAMAKELAS->EditValue = $this->NAMAKELAS->CurrentValue;
        $this->NAMAKELAS->PlaceHolder = RemoveHtml($this->NAMAKELAS->caption());

        // KODERUANG
        $this->KODERUANG->EditAttrs["class"] = "form-control";
        $this->KODERUANG->EditCustomAttributes = "";
        if (!$this->KODERUANG->Raw) {
            $this->KODERUANG->CurrentValue = HtmlDecode($this->KODERUANG->CurrentValue);
        }
        $this->KODERUANG->EditValue = $this->KODERUANG->CurrentValue;
        $this->KODERUANG->PlaceHolder = RemoveHtml($this->KODERUANG->caption());

        // NAMARUANG
        $this->NAMARUANG->EditAttrs["class"] = "form-control";
        $this->NAMARUANG->EditCustomAttributes = "";
        if (!$this->NAMARUANG->Raw) {
            $this->NAMARUANG->CurrentValue = HtmlDecode($this->NAMARUANG->CurrentValue);
        }
        $this->NAMARUANG->EditValue = $this->NAMARUANG->CurrentValue;
        $this->NAMARUANG->PlaceHolder = RemoveHtml($this->NAMARUANG->caption());

        // KAPASITAS
        $this->KAPASITAS->EditAttrs["class"] = "form-control";
        $this->KAPASITAS->EditCustomAttributes = "";
        $this->KAPASITAS->EditValue = $this->KAPASITAS->CurrentValue;
        $this->KAPASITAS->PlaceHolder = RemoveHtml($this->KAPASITAS->caption());

        // TERSEDIA
        $this->TERSEDIA->EditAttrs["class"] = "form-control";
        $this->TERSEDIA->EditCustomAttributes = "";
        $this->TERSEDIA->EditValue = $this->TERSEDIA->CurrentValue;
        $this->TERSEDIA->PlaceHolder = RemoveHtml($this->TERSEDIA->caption());

        // TERSEDIAPRIA
        $this->TERSEDIAPRIA->EditAttrs["class"] = "form-control";
        $this->TERSEDIAPRIA->EditCustomAttributes = "";
        $this->TERSEDIAPRIA->EditValue = $this->TERSEDIAPRIA->CurrentValue;
        $this->TERSEDIAPRIA->PlaceHolder = RemoveHtml($this->TERSEDIAPRIA->caption());

        // TERSEDIAWANITA
        $this->TERSEDIAWANITA->EditAttrs["class"] = "form-control";
        $this->TERSEDIAWANITA->EditCustomAttributes = "";
        $this->TERSEDIAWANITA->EditValue = $this->TERSEDIAWANITA->CurrentValue;
        $this->TERSEDIAWANITA->PlaceHolder = RemoveHtml($this->TERSEDIAWANITA->caption());

        // TERSEDIAPRIAWANITA
        $this->TERSEDIAPRIAWANITA->EditAttrs["class"] = "form-control";
        $this->TERSEDIAPRIAWANITA->EditCustomAttributes = "";
        $this->TERSEDIAPRIAWANITA->EditValue = $this->TERSEDIAPRIAWANITA->CurrentValue;
        $this->TERSEDIAPRIAWANITA->PlaceHolder = RemoveHtml($this->TERSEDIAPRIAWANITA->caption());

        // ROWNUMBER
        $this->ROWNUMBER->EditAttrs["class"] = "form-control";
        $this->ROWNUMBER->EditCustomAttributes = "";
        $this->ROWNUMBER->EditValue = $this->ROWNUMBER->CurrentValue;
        $this->ROWNUMBER->PlaceHolder = RemoveHtml($this->ROWNUMBER->caption());

        // LASTUPDATEALL
        $this->LASTUPDATEALL->EditAttrs["class"] = "form-control";
        $this->LASTUPDATEALL->EditCustomAttributes = "";
        if (!$this->LASTUPDATEALL->Raw) {
            $this->LASTUPDATEALL->CurrentValue = HtmlDecode($this->LASTUPDATEALL->CurrentValue);
        }
        $this->LASTUPDATEALL->EditValue = $this->LASTUPDATEALL->CurrentValue;
        $this->LASTUPDATEALL->PlaceHolder = RemoveHtml($this->LASTUPDATEALL->caption());

        // LASTUPDATE
        $this->LASTUPDATE->EditAttrs["class"] = "form-control";
        $this->LASTUPDATE->EditCustomAttributes = "";
        if (!$this->LASTUPDATE->Raw) {
            $this->LASTUPDATE->CurrentValue = HtmlDecode($this->LASTUPDATE->CurrentValue);
        }
        $this->LASTUPDATE->EditValue = $this->LASTUPDATE->CurrentValue;
        $this->LASTUPDATE->PlaceHolder = RemoveHtml($this->LASTUPDATE->caption());

        // REST_RESPON
        $this->REST_RESPON->EditAttrs["class"] = "form-control";
        $this->REST_RESPON->EditCustomAttributes = "";
        $this->REST_RESPON->EditValue = $this->REST_RESPON->CurrentValue;
        $this->REST_RESPON->PlaceHolder = RemoveHtml($this->REST_RESPON->caption());

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
                    $doc->exportCaption($this->KODEPPK);
                    $doc->exportCaption($this->KODEKELAS);
                    $doc->exportCaption($this->NAMAKELAS);
                    $doc->exportCaption($this->KODERUANG);
                    $doc->exportCaption($this->NAMARUANG);
                    $doc->exportCaption($this->KAPASITAS);
                    $doc->exportCaption($this->TERSEDIA);
                    $doc->exportCaption($this->TERSEDIAPRIA);
                    $doc->exportCaption($this->TERSEDIAWANITA);
                    $doc->exportCaption($this->TERSEDIAPRIAWANITA);
                    $doc->exportCaption($this->ROWNUMBER);
                    $doc->exportCaption($this->LASTUPDATEALL);
                    $doc->exportCaption($this->LASTUPDATE);
                    $doc->exportCaption($this->REST_RESPON);
                } else {
                    $doc->exportCaption($this->KODEPPK);
                    $doc->exportCaption($this->KODEKELAS);
                    $doc->exportCaption($this->NAMAKELAS);
                    $doc->exportCaption($this->KODERUANG);
                    $doc->exportCaption($this->NAMARUANG);
                    $doc->exportCaption($this->KAPASITAS);
                    $doc->exportCaption($this->TERSEDIA);
                    $doc->exportCaption($this->TERSEDIAPRIA);
                    $doc->exportCaption($this->TERSEDIAWANITA);
                    $doc->exportCaption($this->TERSEDIAPRIAWANITA);
                    $doc->exportCaption($this->ROWNUMBER);
                    $doc->exportCaption($this->LASTUPDATEALL);
                    $doc->exportCaption($this->LASTUPDATE);
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
                        $doc->exportField($this->KODEPPK);
                        $doc->exportField($this->KODEKELAS);
                        $doc->exportField($this->NAMAKELAS);
                        $doc->exportField($this->KODERUANG);
                        $doc->exportField($this->NAMARUANG);
                        $doc->exportField($this->KAPASITAS);
                        $doc->exportField($this->TERSEDIA);
                        $doc->exportField($this->TERSEDIAPRIA);
                        $doc->exportField($this->TERSEDIAWANITA);
                        $doc->exportField($this->TERSEDIAPRIAWANITA);
                        $doc->exportField($this->ROWNUMBER);
                        $doc->exportField($this->LASTUPDATEALL);
                        $doc->exportField($this->LASTUPDATE);
                        $doc->exportField($this->REST_RESPON);
                    } else {
                        $doc->exportField($this->KODEPPK);
                        $doc->exportField($this->KODEKELAS);
                        $doc->exportField($this->NAMAKELAS);
                        $doc->exportField($this->KODERUANG);
                        $doc->exportField($this->NAMARUANG);
                        $doc->exportField($this->KAPASITAS);
                        $doc->exportField($this->TERSEDIA);
                        $doc->exportField($this->TERSEDIAPRIA);
                        $doc->exportField($this->TERSEDIAWANITA);
                        $doc->exportField($this->TERSEDIAPRIAWANITA);
                        $doc->exportField($this->ROWNUMBER);
                        $doc->exportField($this->LASTUPDATEALL);
                        $doc->exportField($this->LASTUPDATE);
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
