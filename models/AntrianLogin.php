<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for ANTRIAN_LOGIN
 */
class AntrianLogin extends DbTable
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
    public $ID;
    public $NOMR;
    public $NO_BPJS;
    public $NAMA;
    public $TEMPAT_LAHIR;
    public $TANGGAL_LAHIR;
    public $JENIS_KELAMIN;
    public $AGAMA;
    public $PEKERJAAN;
    public $ALAMAT;
    public $NO_TELP;
    public $NO_HP;
    public $_EMAIL;
    public $FOTO;
    public $TANGGAL_REGIS;
    public $NAMA_IBU;
    public $NAMA_AYAH;
    public $NAMA_PASANGAN;
    public $_PASSWORD;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'ANTRIAN_LOGIN';
        $this->TableName = 'ANTRIAN_LOGIN';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[ANTRIAN_LOGIN]";
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

        // ID
        $this->ID = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 20, 8, -1, false, '[ID]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->Nullable = false; // NOT NULL field
        $this->ID->Sortable = true; // Allow sort
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID->Param, "CustomMsg");
        $this->Fields['ID'] = &$this->ID;

        // NOMR
        $this->NOMR = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_NOMR', 'NOMR', '[NOMR]', '[NOMR]', 200, 25, -1, false, '[NOMR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOMR->Sortable = true; // Allow sort
        $this->NOMR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOMR->Param, "CustomMsg");
        $this->Fields['NOMR'] = &$this->NOMR;

        // NO_BPJS
        $this->NO_BPJS = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_NO_BPJS', 'NO_BPJS', '[NO_BPJS]', '[NO_BPJS]', 200, 30, -1, false, '[NO_BPJS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_BPJS->Sortable = true; // Allow sort
        $this->NO_BPJS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_BPJS->Param, "CustomMsg");
        $this->Fields['NO_BPJS'] = &$this->NO_BPJS;

        // NAMA
        $this->NAMA = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_NAMA', 'NAMA', '[NAMA]', '[NAMA]', 200, 100, -1, false, '[NAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA->Sortable = true; // Allow sort
        $this->NAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA->Param, "CustomMsg");
        $this->Fields['NAMA'] = &$this->NAMA;

        // TEMPAT_LAHIR
        $this->TEMPAT_LAHIR = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_TEMPAT_LAHIR', 'TEMPAT_LAHIR', '[TEMPAT_LAHIR]', '[TEMPAT_LAHIR]', 200, 50, -1, false, '[TEMPAT_LAHIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TEMPAT_LAHIR->Sortable = true; // Allow sort
        $this->TEMPAT_LAHIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TEMPAT_LAHIR->Param, "CustomMsg");
        $this->Fields['TEMPAT_LAHIR'] = &$this->TEMPAT_LAHIR;

        // TANGGAL_LAHIR
        $this->TANGGAL_LAHIR = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_TANGGAL_LAHIR', 'TANGGAL_LAHIR', '[TANGGAL_LAHIR]', CastDateFieldForLike("[TANGGAL_LAHIR]", 0, "DB"), 135, 8, 0, false, '[TANGGAL_LAHIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TANGGAL_LAHIR->Sortable = true; // Allow sort
        $this->TANGGAL_LAHIR->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TANGGAL_LAHIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TANGGAL_LAHIR->Param, "CustomMsg");
        $this->Fields['TANGGAL_LAHIR'] = &$this->TANGGAL_LAHIR;

        // JENIS_KELAMIN
        $this->JENIS_KELAMIN = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_JENIS_KELAMIN', 'JENIS_KELAMIN', '[JENIS_KELAMIN]', '[JENIS_KELAMIN]', 129, 1, -1, false, '[JENIS_KELAMIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JENIS_KELAMIN->Sortable = true; // Allow sort
        $this->JENIS_KELAMIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JENIS_KELAMIN->Param, "CustomMsg");
        $this->Fields['JENIS_KELAMIN'] = &$this->JENIS_KELAMIN;

        // AGAMA
        $this->AGAMA = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_AGAMA', 'AGAMA', '[AGAMA]', 'CAST([AGAMA] AS NVARCHAR)', 17, 1, -1, false, '[AGAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGAMA->Sortable = true; // Allow sort
        $this->AGAMA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGAMA->Param, "CustomMsg");
        $this->Fields['AGAMA'] = &$this->AGAMA;

        // PEKERJAAN
        $this->PEKERJAAN = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_PEKERJAAN', 'PEKERJAAN', '[PEKERJAAN]', 'CAST([PEKERJAAN] AS NVARCHAR)', 17, 1, -1, false, '[PEKERJAAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEKERJAAN->Sortable = true; // Allow sort
        $this->PEKERJAAN->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PEKERJAAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEKERJAAN->Param, "CustomMsg");
        $this->Fields['PEKERJAAN'] = &$this->PEKERJAAN;

        // ALAMAT
        $this->ALAMAT = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_ALAMAT', 'ALAMAT', '[ALAMAT]', '[ALAMAT]', 200, 100, -1, false, '[ALAMAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ALAMAT->Sortable = true; // Allow sort
        $this->ALAMAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ALAMAT->Param, "CustomMsg");
        $this->Fields['ALAMAT'] = &$this->ALAMAT;

        // NO_TELP
        $this->NO_TELP = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_NO_TELP', 'NO_TELP', '[NO_TELP]', '[NO_TELP]', 200, 20, -1, false, '[NO_TELP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_TELP->Sortable = true; // Allow sort
        $this->NO_TELP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_TELP->Param, "CustomMsg");
        $this->Fields['NO_TELP'] = &$this->NO_TELP;

        // NO_HP
        $this->NO_HP = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_NO_HP', 'NO_HP', '[NO_HP]', '[NO_HP]', 200, 20, -1, false, '[NO_HP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_HP->Sortable = true; // Allow sort
        $this->NO_HP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_HP->Param, "CustomMsg");
        $this->Fields['NO_HP'] = &$this->NO_HP;

        // EMAIL
        $this->_EMAIL = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x__EMAIL', 'EMAIL', '[EMAIL]', '[EMAIL]', 200, 50, -1, false, '[EMAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_EMAIL->Sortable = true; // Allow sort
        $this->_EMAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_EMAIL->Param, "CustomMsg");
        $this->Fields['EMAIL'] = &$this->_EMAIL;

        // FOTO
        $this->FOTO = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_FOTO', 'FOTO', '[FOTO]', '[FOTO]', 200, 50, -1, false, '[FOTO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FOTO->Sortable = true; // Allow sort
        $this->FOTO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FOTO->Param, "CustomMsg");
        $this->Fields['FOTO'] = &$this->FOTO;

        // TANGGAL_REGIS
        $this->TANGGAL_REGIS = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_TANGGAL_REGIS', 'TANGGAL_REGIS', '[TANGGAL_REGIS]', CastDateFieldForLike("[TANGGAL_REGIS]", 0, "DB"), 135, 8, 0, false, '[TANGGAL_REGIS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TANGGAL_REGIS->Sortable = true; // Allow sort
        $this->TANGGAL_REGIS->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TANGGAL_REGIS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TANGGAL_REGIS->Param, "CustomMsg");
        $this->Fields['TANGGAL_REGIS'] = &$this->TANGGAL_REGIS;

        // NAMA_IBU
        $this->NAMA_IBU = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_NAMA_IBU', 'NAMA_IBU', '[NAMA_IBU]', '[NAMA_IBU]', 200, 150, -1, false, '[NAMA_IBU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_IBU->Sortable = true; // Allow sort
        $this->NAMA_IBU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_IBU->Param, "CustomMsg");
        $this->Fields['NAMA_IBU'] = &$this->NAMA_IBU;

        // NAMA_AYAH
        $this->NAMA_AYAH = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_NAMA_AYAH', 'NAMA_AYAH', '[NAMA_AYAH]', '[NAMA_AYAH]', 200, 150, -1, false, '[NAMA_AYAH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_AYAH->Sortable = true; // Allow sort
        $this->NAMA_AYAH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_AYAH->Param, "CustomMsg");
        $this->Fields['NAMA_AYAH'] = &$this->NAMA_AYAH;

        // NAMA_PASANGAN
        $this->NAMA_PASANGAN = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x_NAMA_PASANGAN', 'NAMA_PASANGAN', '[NAMA_PASANGAN]', '[NAMA_PASANGAN]', 200, 150, -1, false, '[NAMA_PASANGAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_PASANGAN->Sortable = true; // Allow sort
        $this->NAMA_PASANGAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_PASANGAN->Param, "CustomMsg");
        $this->Fields['NAMA_PASANGAN'] = &$this->NAMA_PASANGAN;

        // PASSWORD
        $this->_PASSWORD = new DbField('ANTRIAN_LOGIN', 'ANTRIAN_LOGIN', 'x__PASSWORD', 'PASSWORD', '[PASSWORD]', '[PASSWORD]', 200, 100, -1, false, '[PASSWORD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_PASSWORD->Sortable = true; // Allow sort
        $this->_PASSWORD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_PASSWORD->Param, "CustomMsg");
        $this->Fields['PASSWORD'] = &$this->_PASSWORD;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[ANTRIAN_LOGIN]";
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
            // Get insert id if necessary
            $this->ID->setDbValue($conn->lastInsertId());
            $rs['ID'] = $this->ID->DbValue;
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
            if (array_key_exists('ID', $rs)) {
                AddFilter($where, QuotedName('ID', $this->Dbid) . '=' . QuotedValue($rs['ID'], $this->ID->DataType, $this->Dbid));
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
        $this->ID->DbValue = $row['ID'];
        $this->NOMR->DbValue = $row['NOMR'];
        $this->NO_BPJS->DbValue = $row['NO_BPJS'];
        $this->NAMA->DbValue = $row['NAMA'];
        $this->TEMPAT_LAHIR->DbValue = $row['TEMPAT_LAHIR'];
        $this->TANGGAL_LAHIR->DbValue = $row['TANGGAL_LAHIR'];
        $this->JENIS_KELAMIN->DbValue = $row['JENIS_KELAMIN'];
        $this->AGAMA->DbValue = $row['AGAMA'];
        $this->PEKERJAAN->DbValue = $row['PEKERJAAN'];
        $this->ALAMAT->DbValue = $row['ALAMAT'];
        $this->NO_TELP->DbValue = $row['NO_TELP'];
        $this->NO_HP->DbValue = $row['NO_HP'];
        $this->_EMAIL->DbValue = $row['EMAIL'];
        $this->FOTO->DbValue = $row['FOTO'];
        $this->TANGGAL_REGIS->DbValue = $row['TANGGAL_REGIS'];
        $this->NAMA_IBU->DbValue = $row['NAMA_IBU'];
        $this->NAMA_AYAH->DbValue = $row['NAMA_AYAH'];
        $this->NAMA_PASANGAN->DbValue = $row['NAMA_PASANGAN'];
        $this->_PASSWORD->DbValue = $row['PASSWORD'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ID] = @ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->ID->CurrentValue : $this->ID->OldValue;
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
                $this->ID->CurrentValue = $keys[0];
            } else {
                $this->ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ID', $row) ? $row['ID'] : null;
        } else {
            $val = $this->ID->OldValue !== null ? $this->ID->OldValue : $this->ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("AntrianLoginList");
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
        if ($pageName == "AntrianLoginView") {
            return $Language->phrase("View");
        } elseif ($pageName == "AntrianLoginEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "AntrianLoginAdd") {
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
                return "AntrianLoginView";
            case Config("API_ADD_ACTION"):
                return "AntrianLoginAdd";
            case Config("API_EDIT_ACTION"):
                return "AntrianLoginEdit";
            case Config("API_DELETE_ACTION"):
                return "AntrianLoginDelete";
            case Config("API_LIST_ACTION"):
                return "AntrianLoginList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "AntrianLoginList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("AntrianLoginView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("AntrianLoginView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "AntrianLoginAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "AntrianLoginAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("AntrianLoginEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("AntrianLoginAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("AntrianLoginDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "ID:" . JsonEncode($this->ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ID->CurrentValue);
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
            if (($keyValue = Param("ID") ?? Route("ID")) !== null) {
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
                if (!is_numeric($key)) {
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
                $this->ID->CurrentValue = $key;
            } else {
                $this->ID->OldValue = $key;
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
        $this->ID->setDbValue($row['ID']);
        $this->NOMR->setDbValue($row['NOMR']);
        $this->NO_BPJS->setDbValue($row['NO_BPJS']);
        $this->NAMA->setDbValue($row['NAMA']);
        $this->TEMPAT_LAHIR->setDbValue($row['TEMPAT_LAHIR']);
        $this->TANGGAL_LAHIR->setDbValue($row['TANGGAL_LAHIR']);
        $this->JENIS_KELAMIN->setDbValue($row['JENIS_KELAMIN']);
        $this->AGAMA->setDbValue($row['AGAMA']);
        $this->PEKERJAAN->setDbValue($row['PEKERJAAN']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->NO_TELP->setDbValue($row['NO_TELP']);
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->FOTO->setDbValue($row['FOTO']);
        $this->TANGGAL_REGIS->setDbValue($row['TANGGAL_REGIS']);
        $this->NAMA_IBU->setDbValue($row['NAMA_IBU']);
        $this->NAMA_AYAH->setDbValue($row['NAMA_AYAH']);
        $this->NAMA_PASANGAN->setDbValue($row['NAMA_PASANGAN']);
        $this->_PASSWORD->setDbValue($row['PASSWORD']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ID

        // NOMR

        // NO_BPJS

        // NAMA

        // TEMPAT_LAHIR

        // TANGGAL_LAHIR

        // JENIS_KELAMIN

        // AGAMA

        // PEKERJAAN

        // ALAMAT

        // NO_TELP

        // NO_HP

        // EMAIL

        // FOTO

        // TANGGAL_REGIS

        // NAMA_IBU

        // NAMA_AYAH

        // NAMA_PASANGAN

        // PASSWORD

        // ID
        $this->ID->ViewValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // NOMR
        $this->NOMR->ViewValue = $this->NOMR->CurrentValue;
        $this->NOMR->ViewCustomAttributes = "";

        // NO_BPJS
        $this->NO_BPJS->ViewValue = $this->NO_BPJS->CurrentValue;
        $this->NO_BPJS->ViewCustomAttributes = "";

        // NAMA
        $this->NAMA->ViewValue = $this->NAMA->CurrentValue;
        $this->NAMA->ViewCustomAttributes = "";

        // TEMPAT_LAHIR
        $this->TEMPAT_LAHIR->ViewValue = $this->TEMPAT_LAHIR->CurrentValue;
        $this->TEMPAT_LAHIR->ViewCustomAttributes = "";

        // TANGGAL_LAHIR
        $this->TANGGAL_LAHIR->ViewValue = $this->TANGGAL_LAHIR->CurrentValue;
        $this->TANGGAL_LAHIR->ViewValue = FormatDateTime($this->TANGGAL_LAHIR->ViewValue, 0);
        $this->TANGGAL_LAHIR->ViewCustomAttributes = "";

        // JENIS_KELAMIN
        $this->JENIS_KELAMIN->ViewValue = $this->JENIS_KELAMIN->CurrentValue;
        $this->JENIS_KELAMIN->ViewCustomAttributes = "";

        // AGAMA
        $this->AGAMA->ViewValue = $this->AGAMA->CurrentValue;
        $this->AGAMA->ViewValue = FormatNumber($this->AGAMA->ViewValue, 0, -2, -2, -2);
        $this->AGAMA->ViewCustomAttributes = "";

        // PEKERJAAN
        $this->PEKERJAAN->ViewValue = $this->PEKERJAAN->CurrentValue;
        $this->PEKERJAAN->ViewValue = FormatNumber($this->PEKERJAAN->ViewValue, 0, -2, -2, -2);
        $this->PEKERJAAN->ViewCustomAttributes = "";

        // ALAMAT
        $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
        $this->ALAMAT->ViewCustomAttributes = "";

        // NO_TELP
        $this->NO_TELP->ViewValue = $this->NO_TELP->CurrentValue;
        $this->NO_TELP->ViewCustomAttributes = "";

        // NO_HP
        $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
        $this->NO_HP->ViewCustomAttributes = "";

        // EMAIL
        $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->ViewCustomAttributes = "";

        // FOTO
        $this->FOTO->ViewValue = $this->FOTO->CurrentValue;
        $this->FOTO->ViewCustomAttributes = "";

        // TANGGAL_REGIS
        $this->TANGGAL_REGIS->ViewValue = $this->TANGGAL_REGIS->CurrentValue;
        $this->TANGGAL_REGIS->ViewValue = FormatDateTime($this->TANGGAL_REGIS->ViewValue, 0);
        $this->TANGGAL_REGIS->ViewCustomAttributes = "";

        // NAMA_IBU
        $this->NAMA_IBU->ViewValue = $this->NAMA_IBU->CurrentValue;
        $this->NAMA_IBU->ViewCustomAttributes = "";

        // NAMA_AYAH
        $this->NAMA_AYAH->ViewValue = $this->NAMA_AYAH->CurrentValue;
        $this->NAMA_AYAH->ViewCustomAttributes = "";

        // NAMA_PASANGAN
        $this->NAMA_PASANGAN->ViewValue = $this->NAMA_PASANGAN->CurrentValue;
        $this->NAMA_PASANGAN->ViewCustomAttributes = "";

        // PASSWORD
        $this->_PASSWORD->ViewValue = $this->_PASSWORD->CurrentValue;
        $this->_PASSWORD->ViewCustomAttributes = "";

        // ID
        $this->ID->LinkCustomAttributes = "";
        $this->ID->HrefValue = "";
        $this->ID->TooltipValue = "";

        // NOMR
        $this->NOMR->LinkCustomAttributes = "";
        $this->NOMR->HrefValue = "";
        $this->NOMR->TooltipValue = "";

        // NO_BPJS
        $this->NO_BPJS->LinkCustomAttributes = "";
        $this->NO_BPJS->HrefValue = "";
        $this->NO_BPJS->TooltipValue = "";

        // NAMA
        $this->NAMA->LinkCustomAttributes = "";
        $this->NAMA->HrefValue = "";
        $this->NAMA->TooltipValue = "";

        // TEMPAT_LAHIR
        $this->TEMPAT_LAHIR->LinkCustomAttributes = "";
        $this->TEMPAT_LAHIR->HrefValue = "";
        $this->TEMPAT_LAHIR->TooltipValue = "";

        // TANGGAL_LAHIR
        $this->TANGGAL_LAHIR->LinkCustomAttributes = "";
        $this->TANGGAL_LAHIR->HrefValue = "";
        $this->TANGGAL_LAHIR->TooltipValue = "";

        // JENIS_KELAMIN
        $this->JENIS_KELAMIN->LinkCustomAttributes = "";
        $this->JENIS_KELAMIN->HrefValue = "";
        $this->JENIS_KELAMIN->TooltipValue = "";

        // AGAMA
        $this->AGAMA->LinkCustomAttributes = "";
        $this->AGAMA->HrefValue = "";
        $this->AGAMA->TooltipValue = "";

        // PEKERJAAN
        $this->PEKERJAAN->LinkCustomAttributes = "";
        $this->PEKERJAAN->HrefValue = "";
        $this->PEKERJAAN->TooltipValue = "";

        // ALAMAT
        $this->ALAMAT->LinkCustomAttributes = "";
        $this->ALAMAT->HrefValue = "";
        $this->ALAMAT->TooltipValue = "";

        // NO_TELP
        $this->NO_TELP->LinkCustomAttributes = "";
        $this->NO_TELP->HrefValue = "";
        $this->NO_TELP->TooltipValue = "";

        // NO_HP
        $this->NO_HP->LinkCustomAttributes = "";
        $this->NO_HP->HrefValue = "";
        $this->NO_HP->TooltipValue = "";

        // EMAIL
        $this->_EMAIL->LinkCustomAttributes = "";
        $this->_EMAIL->HrefValue = "";
        $this->_EMAIL->TooltipValue = "";

        // FOTO
        $this->FOTO->LinkCustomAttributes = "";
        $this->FOTO->HrefValue = "";
        $this->FOTO->TooltipValue = "";

        // TANGGAL_REGIS
        $this->TANGGAL_REGIS->LinkCustomAttributes = "";
        $this->TANGGAL_REGIS->HrefValue = "";
        $this->TANGGAL_REGIS->TooltipValue = "";

        // NAMA_IBU
        $this->NAMA_IBU->LinkCustomAttributes = "";
        $this->NAMA_IBU->HrefValue = "";
        $this->NAMA_IBU->TooltipValue = "";

        // NAMA_AYAH
        $this->NAMA_AYAH->LinkCustomAttributes = "";
        $this->NAMA_AYAH->HrefValue = "";
        $this->NAMA_AYAH->TooltipValue = "";

        // NAMA_PASANGAN
        $this->NAMA_PASANGAN->LinkCustomAttributes = "";
        $this->NAMA_PASANGAN->HrefValue = "";
        $this->NAMA_PASANGAN->TooltipValue = "";

        // PASSWORD
        $this->_PASSWORD->LinkCustomAttributes = "";
        $this->_PASSWORD->HrefValue = "";
        $this->_PASSWORD->TooltipValue = "";

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

        // ID
        $this->ID->EditAttrs["class"] = "form-control";
        $this->ID->EditCustomAttributes = "";
        $this->ID->EditValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // NOMR
        $this->NOMR->EditAttrs["class"] = "form-control";
        $this->NOMR->EditCustomAttributes = "";
        if (!$this->NOMR->Raw) {
            $this->NOMR->CurrentValue = HtmlDecode($this->NOMR->CurrentValue);
        }
        $this->NOMR->EditValue = $this->NOMR->CurrentValue;
        $this->NOMR->PlaceHolder = RemoveHtml($this->NOMR->caption());

        // NO_BPJS
        $this->NO_BPJS->EditAttrs["class"] = "form-control";
        $this->NO_BPJS->EditCustomAttributes = "";
        if (!$this->NO_BPJS->Raw) {
            $this->NO_BPJS->CurrentValue = HtmlDecode($this->NO_BPJS->CurrentValue);
        }
        $this->NO_BPJS->EditValue = $this->NO_BPJS->CurrentValue;
        $this->NO_BPJS->PlaceHolder = RemoveHtml($this->NO_BPJS->caption());

        // NAMA
        $this->NAMA->EditAttrs["class"] = "form-control";
        $this->NAMA->EditCustomAttributes = "";
        if (!$this->NAMA->Raw) {
            $this->NAMA->CurrentValue = HtmlDecode($this->NAMA->CurrentValue);
        }
        $this->NAMA->EditValue = $this->NAMA->CurrentValue;
        $this->NAMA->PlaceHolder = RemoveHtml($this->NAMA->caption());

        // TEMPAT_LAHIR
        $this->TEMPAT_LAHIR->EditAttrs["class"] = "form-control";
        $this->TEMPAT_LAHIR->EditCustomAttributes = "";
        if (!$this->TEMPAT_LAHIR->Raw) {
            $this->TEMPAT_LAHIR->CurrentValue = HtmlDecode($this->TEMPAT_LAHIR->CurrentValue);
        }
        $this->TEMPAT_LAHIR->EditValue = $this->TEMPAT_LAHIR->CurrentValue;
        $this->TEMPAT_LAHIR->PlaceHolder = RemoveHtml($this->TEMPAT_LAHIR->caption());

        // TANGGAL_LAHIR
        $this->TANGGAL_LAHIR->EditAttrs["class"] = "form-control";
        $this->TANGGAL_LAHIR->EditCustomAttributes = "";
        $this->TANGGAL_LAHIR->EditValue = FormatDateTime($this->TANGGAL_LAHIR->CurrentValue, 8);
        $this->TANGGAL_LAHIR->PlaceHolder = RemoveHtml($this->TANGGAL_LAHIR->caption());

        // JENIS_KELAMIN
        $this->JENIS_KELAMIN->EditAttrs["class"] = "form-control";
        $this->JENIS_KELAMIN->EditCustomAttributes = "";
        if (!$this->JENIS_KELAMIN->Raw) {
            $this->JENIS_KELAMIN->CurrentValue = HtmlDecode($this->JENIS_KELAMIN->CurrentValue);
        }
        $this->JENIS_KELAMIN->EditValue = $this->JENIS_KELAMIN->CurrentValue;
        $this->JENIS_KELAMIN->PlaceHolder = RemoveHtml($this->JENIS_KELAMIN->caption());

        // AGAMA
        $this->AGAMA->EditAttrs["class"] = "form-control";
        $this->AGAMA->EditCustomAttributes = "";
        $this->AGAMA->EditValue = $this->AGAMA->CurrentValue;
        $this->AGAMA->PlaceHolder = RemoveHtml($this->AGAMA->caption());

        // PEKERJAAN
        $this->PEKERJAAN->EditAttrs["class"] = "form-control";
        $this->PEKERJAAN->EditCustomAttributes = "";
        $this->PEKERJAAN->EditValue = $this->PEKERJAAN->CurrentValue;
        $this->PEKERJAAN->PlaceHolder = RemoveHtml($this->PEKERJAAN->caption());

        // ALAMAT
        $this->ALAMAT->EditAttrs["class"] = "form-control";
        $this->ALAMAT->EditCustomAttributes = "";
        if (!$this->ALAMAT->Raw) {
            $this->ALAMAT->CurrentValue = HtmlDecode($this->ALAMAT->CurrentValue);
        }
        $this->ALAMAT->EditValue = $this->ALAMAT->CurrentValue;
        $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

        // NO_TELP
        $this->NO_TELP->EditAttrs["class"] = "form-control";
        $this->NO_TELP->EditCustomAttributes = "";
        if (!$this->NO_TELP->Raw) {
            $this->NO_TELP->CurrentValue = HtmlDecode($this->NO_TELP->CurrentValue);
        }
        $this->NO_TELP->EditValue = $this->NO_TELP->CurrentValue;
        $this->NO_TELP->PlaceHolder = RemoveHtml($this->NO_TELP->caption());

        // NO_HP
        $this->NO_HP->EditAttrs["class"] = "form-control";
        $this->NO_HP->EditCustomAttributes = "";
        if (!$this->NO_HP->Raw) {
            $this->NO_HP->CurrentValue = HtmlDecode($this->NO_HP->CurrentValue);
        }
        $this->NO_HP->EditValue = $this->NO_HP->CurrentValue;
        $this->NO_HP->PlaceHolder = RemoveHtml($this->NO_HP->caption());

        // EMAIL
        $this->_EMAIL->EditAttrs["class"] = "form-control";
        $this->_EMAIL->EditCustomAttributes = "";
        if (!$this->_EMAIL->Raw) {
            $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
        }
        $this->_EMAIL->EditValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

        // FOTO
        $this->FOTO->EditAttrs["class"] = "form-control";
        $this->FOTO->EditCustomAttributes = "";
        if (!$this->FOTO->Raw) {
            $this->FOTO->CurrentValue = HtmlDecode($this->FOTO->CurrentValue);
        }
        $this->FOTO->EditValue = $this->FOTO->CurrentValue;
        $this->FOTO->PlaceHolder = RemoveHtml($this->FOTO->caption());

        // TANGGAL_REGIS
        $this->TANGGAL_REGIS->EditAttrs["class"] = "form-control";
        $this->TANGGAL_REGIS->EditCustomAttributes = "";
        $this->TANGGAL_REGIS->EditValue = FormatDateTime($this->TANGGAL_REGIS->CurrentValue, 8);
        $this->TANGGAL_REGIS->PlaceHolder = RemoveHtml($this->TANGGAL_REGIS->caption());

        // NAMA_IBU
        $this->NAMA_IBU->EditAttrs["class"] = "form-control";
        $this->NAMA_IBU->EditCustomAttributes = "";
        if (!$this->NAMA_IBU->Raw) {
            $this->NAMA_IBU->CurrentValue = HtmlDecode($this->NAMA_IBU->CurrentValue);
        }
        $this->NAMA_IBU->EditValue = $this->NAMA_IBU->CurrentValue;
        $this->NAMA_IBU->PlaceHolder = RemoveHtml($this->NAMA_IBU->caption());

        // NAMA_AYAH
        $this->NAMA_AYAH->EditAttrs["class"] = "form-control";
        $this->NAMA_AYAH->EditCustomAttributes = "";
        if (!$this->NAMA_AYAH->Raw) {
            $this->NAMA_AYAH->CurrentValue = HtmlDecode($this->NAMA_AYAH->CurrentValue);
        }
        $this->NAMA_AYAH->EditValue = $this->NAMA_AYAH->CurrentValue;
        $this->NAMA_AYAH->PlaceHolder = RemoveHtml($this->NAMA_AYAH->caption());

        // NAMA_PASANGAN
        $this->NAMA_PASANGAN->EditAttrs["class"] = "form-control";
        $this->NAMA_PASANGAN->EditCustomAttributes = "";
        if (!$this->NAMA_PASANGAN->Raw) {
            $this->NAMA_PASANGAN->CurrentValue = HtmlDecode($this->NAMA_PASANGAN->CurrentValue);
        }
        $this->NAMA_PASANGAN->EditValue = $this->NAMA_PASANGAN->CurrentValue;
        $this->NAMA_PASANGAN->PlaceHolder = RemoveHtml($this->NAMA_PASANGAN->caption());

        // PASSWORD
        $this->_PASSWORD->EditAttrs["class"] = "form-control";
        $this->_PASSWORD->EditCustomAttributes = "";
        if (!$this->_PASSWORD->Raw) {
            $this->_PASSWORD->CurrentValue = HtmlDecode($this->_PASSWORD->CurrentValue);
        }
        $this->_PASSWORD->EditValue = $this->_PASSWORD->CurrentValue;
        $this->_PASSWORD->PlaceHolder = RemoveHtml($this->_PASSWORD->caption());

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
                    $doc->exportCaption($this->ID);
                    $doc->exportCaption($this->NOMR);
                    $doc->exportCaption($this->NO_BPJS);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->TEMPAT_LAHIR);
                    $doc->exportCaption($this->TANGGAL_LAHIR);
                    $doc->exportCaption($this->JENIS_KELAMIN);
                    $doc->exportCaption($this->AGAMA);
                    $doc->exportCaption($this->PEKERJAAN);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->NO_TELP);
                    $doc->exportCaption($this->NO_HP);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->FOTO);
                    $doc->exportCaption($this->TANGGAL_REGIS);
                    $doc->exportCaption($this->NAMA_IBU);
                    $doc->exportCaption($this->NAMA_AYAH);
                    $doc->exportCaption($this->NAMA_PASANGAN);
                    $doc->exportCaption($this->_PASSWORD);
                } else {
                    $doc->exportCaption($this->ID);
                    $doc->exportCaption($this->NOMR);
                    $doc->exportCaption($this->NO_BPJS);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->TEMPAT_LAHIR);
                    $doc->exportCaption($this->TANGGAL_LAHIR);
                    $doc->exportCaption($this->JENIS_KELAMIN);
                    $doc->exportCaption($this->AGAMA);
                    $doc->exportCaption($this->PEKERJAAN);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->NO_TELP);
                    $doc->exportCaption($this->NO_HP);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->FOTO);
                    $doc->exportCaption($this->TANGGAL_REGIS);
                    $doc->exportCaption($this->NAMA_IBU);
                    $doc->exportCaption($this->NAMA_AYAH);
                    $doc->exportCaption($this->NAMA_PASANGAN);
                    $doc->exportCaption($this->_PASSWORD);
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
                        $doc->exportField($this->ID);
                        $doc->exportField($this->NOMR);
                        $doc->exportField($this->NO_BPJS);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->TEMPAT_LAHIR);
                        $doc->exportField($this->TANGGAL_LAHIR);
                        $doc->exportField($this->JENIS_KELAMIN);
                        $doc->exportField($this->AGAMA);
                        $doc->exportField($this->PEKERJAAN);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->NO_TELP);
                        $doc->exportField($this->NO_HP);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->FOTO);
                        $doc->exportField($this->TANGGAL_REGIS);
                        $doc->exportField($this->NAMA_IBU);
                        $doc->exportField($this->NAMA_AYAH);
                        $doc->exportField($this->NAMA_PASANGAN);
                        $doc->exportField($this->_PASSWORD);
                    } else {
                        $doc->exportField($this->ID);
                        $doc->exportField($this->NOMR);
                        $doc->exportField($this->NO_BPJS);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->TEMPAT_LAHIR);
                        $doc->exportField($this->TANGGAL_LAHIR);
                        $doc->exportField($this->JENIS_KELAMIN);
                        $doc->exportField($this->AGAMA);
                        $doc->exportField($this->PEKERJAAN);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->NO_TELP);
                        $doc->exportField($this->NO_HP);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->FOTO);
                        $doc->exportField($this->TANGGAL_REGIS);
                        $doc->exportField($this->NAMA_IBU);
                        $doc->exportField($this->NAMA_AYAH);
                        $doc->exportField($this->NAMA_PASANGAN);
                        $doc->exportField($this->_PASSWORD);
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
