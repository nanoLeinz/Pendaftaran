<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for referensi_mobilejkn_bpjs
 */
class ReferensiMobilejknBpjs extends DbTable
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
    public $id;
    public $nobooking;
    public $no_rawat;
    public $nomorkartu;
    public $nik;
    public $nohp;
    public $kodepoli;
    public $pasienbaru;
    public $norm;
    public $tanggalperiksa;
    public $kodedokter;
    public $jampraktek;
    public $jeniskunjungan;
    public $nomorreferensi;
    public $nomorantrean;
    public $angkaantrean;
    public $estimasidilayani;
    public $sisakuotajkn;
    public $kuotajkn;
    public $sisakuotanonjkn;
    public $kuotanonjkn;
    public $status;
    public $validasi;
    public $statuskirim;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'referensi_mobilejkn_bpjs';
        $this->TableName = 'referensi_mobilejkn_bpjs';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[referensi_mobilejkn_bpjs]";
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

        // id
        $this->id = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_id', 'id', '[id]', 'CAST([id] AS NVARCHAR)', 3, 4, -1, false, '[id]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Nullable = false; // NOT NULL field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // nobooking
        $this->nobooking = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_nobooking', 'nobooking', '[nobooking]', '[nobooking]', 200, 15, -1, false, '[nobooking]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nobooking->Sortable = true; // Allow sort
        $this->nobooking->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nobooking->Param, "CustomMsg");
        $this->Fields['nobooking'] = &$this->nobooking;

        // no_rawat
        $this->no_rawat = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_no_rawat', 'no_rawat', '[no_rawat]', '[no_rawat]', 200, 17, -1, false, '[no_rawat]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rawat->Sortable = true; // Allow sort
        $this->no_rawat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rawat->Param, "CustomMsg");
        $this->Fields['no_rawat'] = &$this->no_rawat;

        // nomorkartu
        $this->nomorkartu = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_nomorkartu', 'nomorkartu', '[nomorkartu]', '[nomorkartu]', 200, 25, -1, false, '[nomorkartu]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nomorkartu->Sortable = true; // Allow sort
        $this->nomorkartu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nomorkartu->Param, "CustomMsg");
        $this->Fields['nomorkartu'] = &$this->nomorkartu;

        // nik
        $this->nik = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_nik', 'nik', '[nik]', '[nik]', 200, 30, -1, false, '[nik]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // nohp
        $this->nohp = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_nohp', 'nohp', '[nohp]', '[nohp]', 200, 15, -1, false, '[nohp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nohp->Sortable = true; // Allow sort
        $this->nohp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nohp->Param, "CustomMsg");
        $this->Fields['nohp'] = &$this->nohp;

        // kodepoli
        $this->kodepoli = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_kodepoli', 'kodepoli', '[kodepoli]', '[kodepoli]', 200, 15, -1, false, '[kodepoli]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kodepoli->Sortable = true; // Allow sort
        $this->kodepoli->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kodepoli->Param, "CustomMsg");
        $this->Fields['kodepoli'] = &$this->kodepoli;

        // pasienbaru
        $this->pasienbaru = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_pasienbaru', 'pasienbaru', '[pasienbaru]', 'CAST([pasienbaru] AS NVARCHAR)', 3, 4, -1, false, '[pasienbaru]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pasienbaru->Nullable = false; // NOT NULL field
        $this->pasienbaru->Required = true; // Required field
        $this->pasienbaru->Sortable = true; // Allow sort
        $this->pasienbaru->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pasienbaru->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pasienbaru->Param, "CustomMsg");
        $this->Fields['pasienbaru'] = &$this->pasienbaru;

        // norm
        $this->norm = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_norm', 'norm', '[norm]', '[norm]', 200, 15, -1, false, '[norm]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->norm->Sortable = true; // Allow sort
        $this->norm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->norm->Param, "CustomMsg");
        $this->Fields['norm'] = &$this->norm;

        // tanggalperiksa
        $this->tanggalperiksa = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_tanggalperiksa', 'tanggalperiksa', '[tanggalperiksa]', CastDateFieldForLike("[tanggalperiksa]", 0, "DB"), 133, 8, 0, false, '[tanggalperiksa]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggalperiksa->Sortable = true; // Allow sort
        $this->tanggalperiksa->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggalperiksa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggalperiksa->Param, "CustomMsg");
        $this->Fields['tanggalperiksa'] = &$this->tanggalperiksa;

        // kodedokter
        $this->kodedokter = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_kodedokter', 'kodedokter', '[kodedokter]', '[kodedokter]', 200, 20, -1, false, '[kodedokter]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kodedokter->Sortable = true; // Allow sort
        $this->kodedokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kodedokter->Param, "CustomMsg");
        $this->Fields['kodedokter'] = &$this->kodedokter;

        // jampraktek
        $this->jampraktek = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_jampraktek', 'jampraktek', '[jampraktek]', '[jampraktek]', 200, 12, -1, false, '[jampraktek]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jampraktek->Sortable = true; // Allow sort
        $this->jampraktek->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jampraktek->Param, "CustomMsg");
        $this->Fields['jampraktek'] = &$this->jampraktek;

        // jeniskunjungan
        $this->jeniskunjungan = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_jeniskunjungan', 'jeniskunjungan', '[jeniskunjungan]', '[jeniskunjungan]', 200, 20, -1, false, '[jeniskunjungan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jeniskunjungan->Sortable = true; // Allow sort
        $this->jeniskunjungan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jeniskunjungan->Param, "CustomMsg");
        $this->Fields['jeniskunjungan'] = &$this->jeniskunjungan;

        // nomorreferensi
        $this->nomorreferensi = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_nomorreferensi', 'nomorreferensi', '[nomorreferensi]', '[nomorreferensi]', 200, 40, -1, false, '[nomorreferensi]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nomorreferensi->Nullable = false; // NOT NULL field
        $this->nomorreferensi->Required = true; // Required field
        $this->nomorreferensi->Sortable = true; // Allow sort
        $this->nomorreferensi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nomorreferensi->Param, "CustomMsg");
        $this->Fields['nomorreferensi'] = &$this->nomorreferensi;

        // nomorantrean
        $this->nomorantrean = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_nomorantrean', 'nomorantrean', '[nomorantrean]', '[nomorantrean]', 200, 15, -1, false, '[nomorantrean]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nomorantrean->Sortable = true; // Allow sort
        $this->nomorantrean->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nomorantrean->Param, "CustomMsg");
        $this->Fields['nomorantrean'] = &$this->nomorantrean;

        // angkaantrean
        $this->angkaantrean = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_angkaantrean', 'angkaantrean', '[angkaantrean]', '[angkaantrean]', 200, 5, -1, false, '[angkaantrean]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->angkaantrean->Sortable = true; // Allow sort
        $this->angkaantrean->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->angkaantrean->Param, "CustomMsg");
        $this->Fields['angkaantrean'] = &$this->angkaantrean;

        // estimasidilayani
        $this->estimasidilayani = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_estimasidilayani', 'estimasidilayani', '[estimasidilayani]', '[estimasidilayani]', 200, 15, -1, false, '[estimasidilayani]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->estimasidilayani->Sortable = true; // Allow sort
        $this->estimasidilayani->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->estimasidilayani->Param, "CustomMsg");
        $this->Fields['estimasidilayani'] = &$this->estimasidilayani;

        // sisakuotajkn
        $this->sisakuotajkn = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_sisakuotajkn', 'sisakuotajkn', '[sisakuotajkn]', 'CAST([sisakuotajkn] AS NVARCHAR)', 3, 4, -1, false, '[sisakuotajkn]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sisakuotajkn->Sortable = true; // Allow sort
        $this->sisakuotajkn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->sisakuotajkn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sisakuotajkn->Param, "CustomMsg");
        $this->Fields['sisakuotajkn'] = &$this->sisakuotajkn;

        // kuotajkn
        $this->kuotajkn = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_kuotajkn', 'kuotajkn', '[kuotajkn]', 'CAST([kuotajkn] AS NVARCHAR)', 3, 4, -1, false, '[kuotajkn]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kuotajkn->Sortable = true; // Allow sort
        $this->kuotajkn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kuotajkn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kuotajkn->Param, "CustomMsg");
        $this->Fields['kuotajkn'] = &$this->kuotajkn;

        // sisakuotanonjkn
        $this->sisakuotanonjkn = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_sisakuotanonjkn', 'sisakuotanonjkn', '[sisakuotanonjkn]', 'CAST([sisakuotanonjkn] AS NVARCHAR)', 3, 4, -1, false, '[sisakuotanonjkn]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sisakuotanonjkn->Sortable = true; // Allow sort
        $this->sisakuotanonjkn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->sisakuotanonjkn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sisakuotanonjkn->Param, "CustomMsg");
        $this->Fields['sisakuotanonjkn'] = &$this->sisakuotanonjkn;

        // kuotanonjkn
        $this->kuotanonjkn = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_kuotanonjkn', 'kuotanonjkn', '[kuotanonjkn]', 'CAST([kuotanonjkn] AS NVARCHAR)', 3, 4, -1, false, '[kuotanonjkn]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kuotanonjkn->Sortable = true; // Allow sort
        $this->kuotanonjkn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kuotanonjkn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kuotanonjkn->Param, "CustomMsg");
        $this->Fields['kuotanonjkn'] = &$this->kuotanonjkn;

        // status
        $this->status = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_status', 'status', '[status]', '[status]', 200, 15, -1, false, '[status]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status->Sortable = true; // Allow sort
        $this->status->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status->Param, "CustomMsg");
        $this->Fields['status'] = &$this->status;

        // validasi
        $this->validasi = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_validasi', 'validasi', '[validasi]', CastDateFieldForLike("[validasi]", 0, "DB"), 135, 8, 0, false, '[validasi]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->validasi->Sortable = true; // Allow sort
        $this->validasi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->validasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->validasi->Param, "CustomMsg");
        $this->Fields['validasi'] = &$this->validasi;

        // statuskirim
        $this->statuskirim = new DbField('referensi_mobilejkn_bpjs', 'referensi_mobilejkn_bpjs', 'x_statuskirim', 'statuskirim', '[statuskirim]', '[statuskirim]', 200, 15, -1, false, '[statuskirim]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->statuskirim->Sortable = true; // Allow sort
        $this->statuskirim->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->statuskirim->Param, "CustomMsg");
        $this->Fields['statuskirim'] = &$this->statuskirim;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[referensi_mobilejkn_bpjs]";
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
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
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
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
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
        $this->id->DbValue = $row['id'];
        $this->nobooking->DbValue = $row['nobooking'];
        $this->no_rawat->DbValue = $row['no_rawat'];
        $this->nomorkartu->DbValue = $row['nomorkartu'];
        $this->nik->DbValue = $row['nik'];
        $this->nohp->DbValue = $row['nohp'];
        $this->kodepoli->DbValue = $row['kodepoli'];
        $this->pasienbaru->DbValue = $row['pasienbaru'];
        $this->norm->DbValue = $row['norm'];
        $this->tanggalperiksa->DbValue = $row['tanggalperiksa'];
        $this->kodedokter->DbValue = $row['kodedokter'];
        $this->jampraktek->DbValue = $row['jampraktek'];
        $this->jeniskunjungan->DbValue = $row['jeniskunjungan'];
        $this->nomorreferensi->DbValue = $row['nomorreferensi'];
        $this->nomorantrean->DbValue = $row['nomorantrean'];
        $this->angkaantrean->DbValue = $row['angkaantrean'];
        $this->estimasidilayani->DbValue = $row['estimasidilayani'];
        $this->sisakuotajkn->DbValue = $row['sisakuotajkn'];
        $this->kuotajkn->DbValue = $row['kuotajkn'];
        $this->sisakuotanonjkn->DbValue = $row['sisakuotanonjkn'];
        $this->kuotanonjkn->DbValue = $row['kuotanonjkn'];
        $this->status->DbValue = $row['status'];
        $this->validasi->DbValue = $row['validasi'];
        $this->statuskirim->DbValue = $row['statuskirim'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[id] = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
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
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ReferensiMobilejknBpjsList");
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
        if ($pageName == "ReferensiMobilejknBpjsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ReferensiMobilejknBpjsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ReferensiMobilejknBpjsAdd") {
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
                return "ReferensiMobilejknBpjsView";
            case Config("API_ADD_ACTION"):
                return "ReferensiMobilejknBpjsAdd";
            case Config("API_EDIT_ACTION"):
                return "ReferensiMobilejknBpjsEdit";
            case Config("API_DELETE_ACTION"):
                return "ReferensiMobilejknBpjsDelete";
            case Config("API_LIST_ACTION"):
                return "ReferensiMobilejknBpjsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ReferensiMobilejknBpjsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ReferensiMobilejknBpjsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ReferensiMobilejknBpjsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ReferensiMobilejknBpjsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ReferensiMobilejknBpjsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ReferensiMobilejknBpjsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ReferensiMobilejknBpjsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ReferensiMobilejknBpjsDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id->CurrentValue);
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
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
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
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
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
        $this->id->setDbValue($row['id']);
        $this->nobooking->setDbValue($row['nobooking']);
        $this->no_rawat->setDbValue($row['no_rawat']);
        $this->nomorkartu->setDbValue($row['nomorkartu']);
        $this->nik->setDbValue($row['nik']);
        $this->nohp->setDbValue($row['nohp']);
        $this->kodepoli->setDbValue($row['kodepoli']);
        $this->pasienbaru->setDbValue($row['pasienbaru']);
        $this->norm->setDbValue($row['norm']);
        $this->tanggalperiksa->setDbValue($row['tanggalperiksa']);
        $this->kodedokter->setDbValue($row['kodedokter']);
        $this->jampraktek->setDbValue($row['jampraktek']);
        $this->jeniskunjungan->setDbValue($row['jeniskunjungan']);
        $this->nomorreferensi->setDbValue($row['nomorreferensi']);
        $this->nomorantrean->setDbValue($row['nomorantrean']);
        $this->angkaantrean->setDbValue($row['angkaantrean']);
        $this->estimasidilayani->setDbValue($row['estimasidilayani']);
        $this->sisakuotajkn->setDbValue($row['sisakuotajkn']);
        $this->kuotajkn->setDbValue($row['kuotajkn']);
        $this->sisakuotanonjkn->setDbValue($row['sisakuotanonjkn']);
        $this->kuotanonjkn->setDbValue($row['kuotanonjkn']);
        $this->status->setDbValue($row['status']);
        $this->validasi->setDbValue($row['validasi']);
        $this->statuskirim->setDbValue($row['statuskirim']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // nobooking

        // no_rawat

        // nomorkartu

        // nik

        // nohp

        // kodepoli

        // pasienbaru

        // norm

        // tanggalperiksa

        // kodedokter

        // jampraktek

        // jeniskunjungan

        // nomorreferensi

        // nomorantrean

        // angkaantrean

        // estimasidilayani

        // sisakuotajkn

        // kuotajkn

        // sisakuotanonjkn

        // kuotanonjkn

        // status

        // validasi

        // statuskirim

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // nobooking
        $this->nobooking->ViewValue = $this->nobooking->CurrentValue;
        $this->nobooking->ViewCustomAttributes = "";

        // no_rawat
        $this->no_rawat->ViewValue = $this->no_rawat->CurrentValue;
        $this->no_rawat->ViewCustomAttributes = "";

        // nomorkartu
        $this->nomorkartu->ViewValue = $this->nomorkartu->CurrentValue;
        $this->nomorkartu->ViewCustomAttributes = "";

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // nohp
        $this->nohp->ViewValue = $this->nohp->CurrentValue;
        $this->nohp->ViewCustomAttributes = "";

        // kodepoli
        $this->kodepoli->ViewValue = $this->kodepoli->CurrentValue;
        $this->kodepoli->ViewCustomAttributes = "";

        // pasienbaru
        $this->pasienbaru->ViewValue = $this->pasienbaru->CurrentValue;
        $this->pasienbaru->ViewValue = FormatNumber($this->pasienbaru->ViewValue, 0, -2, -2, -2);
        $this->pasienbaru->ViewCustomAttributes = "";

        // norm
        $this->norm->ViewValue = $this->norm->CurrentValue;
        $this->norm->ViewCustomAttributes = "";

        // tanggalperiksa
        $this->tanggalperiksa->ViewValue = $this->tanggalperiksa->CurrentValue;
        $this->tanggalperiksa->ViewValue = FormatDateTime($this->tanggalperiksa->ViewValue, 0);
        $this->tanggalperiksa->ViewCustomAttributes = "";

        // kodedokter
        $this->kodedokter->ViewValue = $this->kodedokter->CurrentValue;
        $this->kodedokter->ViewCustomAttributes = "";

        // jampraktek
        $this->jampraktek->ViewValue = $this->jampraktek->CurrentValue;
        $this->jampraktek->ViewCustomAttributes = "";

        // jeniskunjungan
        $this->jeniskunjungan->ViewValue = $this->jeniskunjungan->CurrentValue;
        $this->jeniskunjungan->ViewCustomAttributes = "";

        // nomorreferensi
        $this->nomorreferensi->ViewValue = $this->nomorreferensi->CurrentValue;
        $this->nomorreferensi->ViewCustomAttributes = "";

        // nomorantrean
        $this->nomorantrean->ViewValue = $this->nomorantrean->CurrentValue;
        $this->nomorantrean->ViewCustomAttributes = "";

        // angkaantrean
        $this->angkaantrean->ViewValue = $this->angkaantrean->CurrentValue;
        $this->angkaantrean->ViewCustomAttributes = "";

        // estimasidilayani
        $this->estimasidilayani->ViewValue = $this->estimasidilayani->CurrentValue;
        $this->estimasidilayani->ViewCustomAttributes = "";

        // sisakuotajkn
        $this->sisakuotajkn->ViewValue = $this->sisakuotajkn->CurrentValue;
        $this->sisakuotajkn->ViewValue = FormatNumber($this->sisakuotajkn->ViewValue, 0, -2, -2, -2);
        $this->sisakuotajkn->ViewCustomAttributes = "";

        // kuotajkn
        $this->kuotajkn->ViewValue = $this->kuotajkn->CurrentValue;
        $this->kuotajkn->ViewValue = FormatNumber($this->kuotajkn->ViewValue, 0, -2, -2, -2);
        $this->kuotajkn->ViewCustomAttributes = "";

        // sisakuotanonjkn
        $this->sisakuotanonjkn->ViewValue = $this->sisakuotanonjkn->CurrentValue;
        $this->sisakuotanonjkn->ViewValue = FormatNumber($this->sisakuotanonjkn->ViewValue, 0, -2, -2, -2);
        $this->sisakuotanonjkn->ViewCustomAttributes = "";

        // kuotanonjkn
        $this->kuotanonjkn->ViewValue = $this->kuotanonjkn->CurrentValue;
        $this->kuotanonjkn->ViewValue = FormatNumber($this->kuotanonjkn->ViewValue, 0, -2, -2, -2);
        $this->kuotanonjkn->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // validasi
        $this->validasi->ViewValue = $this->validasi->CurrentValue;
        $this->validasi->ViewValue = FormatDateTime($this->validasi->ViewValue, 0);
        $this->validasi->ViewCustomAttributes = "";

        // statuskirim
        $this->statuskirim->ViewValue = $this->statuskirim->CurrentValue;
        $this->statuskirim->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // nobooking
        $this->nobooking->LinkCustomAttributes = "";
        $this->nobooking->HrefValue = "";
        $this->nobooking->TooltipValue = "";

        // no_rawat
        $this->no_rawat->LinkCustomAttributes = "";
        $this->no_rawat->HrefValue = "";
        $this->no_rawat->TooltipValue = "";

        // nomorkartu
        $this->nomorkartu->LinkCustomAttributes = "";
        $this->nomorkartu->HrefValue = "";
        $this->nomorkartu->TooltipValue = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // nohp
        $this->nohp->LinkCustomAttributes = "";
        $this->nohp->HrefValue = "";
        $this->nohp->TooltipValue = "";

        // kodepoli
        $this->kodepoli->LinkCustomAttributes = "";
        $this->kodepoli->HrefValue = "";
        $this->kodepoli->TooltipValue = "";

        // pasienbaru
        $this->pasienbaru->LinkCustomAttributes = "";
        $this->pasienbaru->HrefValue = "";
        $this->pasienbaru->TooltipValue = "";

        // norm
        $this->norm->LinkCustomAttributes = "";
        $this->norm->HrefValue = "";
        $this->norm->TooltipValue = "";

        // tanggalperiksa
        $this->tanggalperiksa->LinkCustomAttributes = "";
        $this->tanggalperiksa->HrefValue = "";
        $this->tanggalperiksa->TooltipValue = "";

        // kodedokter
        $this->kodedokter->LinkCustomAttributes = "";
        $this->kodedokter->HrefValue = "";
        $this->kodedokter->TooltipValue = "";

        // jampraktek
        $this->jampraktek->LinkCustomAttributes = "";
        $this->jampraktek->HrefValue = "";
        $this->jampraktek->TooltipValue = "";

        // jeniskunjungan
        $this->jeniskunjungan->LinkCustomAttributes = "";
        $this->jeniskunjungan->HrefValue = "";
        $this->jeniskunjungan->TooltipValue = "";

        // nomorreferensi
        $this->nomorreferensi->LinkCustomAttributes = "";
        $this->nomorreferensi->HrefValue = "";
        $this->nomorreferensi->TooltipValue = "";

        // nomorantrean
        $this->nomorantrean->LinkCustomAttributes = "";
        $this->nomorantrean->HrefValue = "";
        $this->nomorantrean->TooltipValue = "";

        // angkaantrean
        $this->angkaantrean->LinkCustomAttributes = "";
        $this->angkaantrean->HrefValue = "";
        $this->angkaantrean->TooltipValue = "";

        // estimasidilayani
        $this->estimasidilayani->LinkCustomAttributes = "";
        $this->estimasidilayani->HrefValue = "";
        $this->estimasidilayani->TooltipValue = "";

        // sisakuotajkn
        $this->sisakuotajkn->LinkCustomAttributes = "";
        $this->sisakuotajkn->HrefValue = "";
        $this->sisakuotajkn->TooltipValue = "";

        // kuotajkn
        $this->kuotajkn->LinkCustomAttributes = "";
        $this->kuotajkn->HrefValue = "";
        $this->kuotajkn->TooltipValue = "";

        // sisakuotanonjkn
        $this->sisakuotanonjkn->LinkCustomAttributes = "";
        $this->sisakuotanonjkn->HrefValue = "";
        $this->sisakuotanonjkn->TooltipValue = "";

        // kuotanonjkn
        $this->kuotanonjkn->LinkCustomAttributes = "";
        $this->kuotanonjkn->HrefValue = "";
        $this->kuotanonjkn->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // validasi
        $this->validasi->LinkCustomAttributes = "";
        $this->validasi->HrefValue = "";
        $this->validasi->TooltipValue = "";

        // statuskirim
        $this->statuskirim->LinkCustomAttributes = "";
        $this->statuskirim->HrefValue = "";
        $this->statuskirim->TooltipValue = "";

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

        // id
        $this->id->EditAttrs["class"] = "form-control";
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // nobooking
        $this->nobooking->EditAttrs["class"] = "form-control";
        $this->nobooking->EditCustomAttributes = "";
        if (!$this->nobooking->Raw) {
            $this->nobooking->CurrentValue = HtmlDecode($this->nobooking->CurrentValue);
        }
        $this->nobooking->EditValue = $this->nobooking->CurrentValue;
        $this->nobooking->PlaceHolder = RemoveHtml($this->nobooking->caption());

        // no_rawat
        $this->no_rawat->EditAttrs["class"] = "form-control";
        $this->no_rawat->EditCustomAttributes = "";
        if (!$this->no_rawat->Raw) {
            $this->no_rawat->CurrentValue = HtmlDecode($this->no_rawat->CurrentValue);
        }
        $this->no_rawat->EditValue = $this->no_rawat->CurrentValue;
        $this->no_rawat->PlaceHolder = RemoveHtml($this->no_rawat->caption());

        // nomorkartu
        $this->nomorkartu->EditAttrs["class"] = "form-control";
        $this->nomorkartu->EditCustomAttributes = "";
        if (!$this->nomorkartu->Raw) {
            $this->nomorkartu->CurrentValue = HtmlDecode($this->nomorkartu->CurrentValue);
        }
        $this->nomorkartu->EditValue = $this->nomorkartu->CurrentValue;
        $this->nomorkartu->PlaceHolder = RemoveHtml($this->nomorkartu->caption());

        // nik
        $this->nik->EditAttrs["class"] = "form-control";
        $this->nik->EditCustomAttributes = "";
        if (!$this->nik->Raw) {
            $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
        }
        $this->nik->EditValue = $this->nik->CurrentValue;
        $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

        // nohp
        $this->nohp->EditAttrs["class"] = "form-control";
        $this->nohp->EditCustomAttributes = "";
        if (!$this->nohp->Raw) {
            $this->nohp->CurrentValue = HtmlDecode($this->nohp->CurrentValue);
        }
        $this->nohp->EditValue = $this->nohp->CurrentValue;
        $this->nohp->PlaceHolder = RemoveHtml($this->nohp->caption());

        // kodepoli
        $this->kodepoli->EditAttrs["class"] = "form-control";
        $this->kodepoli->EditCustomAttributes = "";
        if (!$this->kodepoli->Raw) {
            $this->kodepoli->CurrentValue = HtmlDecode($this->kodepoli->CurrentValue);
        }
        $this->kodepoli->EditValue = $this->kodepoli->CurrentValue;
        $this->kodepoli->PlaceHolder = RemoveHtml($this->kodepoli->caption());

        // pasienbaru
        $this->pasienbaru->EditAttrs["class"] = "form-control";
        $this->pasienbaru->EditCustomAttributes = "";
        $this->pasienbaru->EditValue = $this->pasienbaru->CurrentValue;
        $this->pasienbaru->PlaceHolder = RemoveHtml($this->pasienbaru->caption());

        // norm
        $this->norm->EditAttrs["class"] = "form-control";
        $this->norm->EditCustomAttributes = "";
        if (!$this->norm->Raw) {
            $this->norm->CurrentValue = HtmlDecode($this->norm->CurrentValue);
        }
        $this->norm->EditValue = $this->norm->CurrentValue;
        $this->norm->PlaceHolder = RemoveHtml($this->norm->caption());

        // tanggalperiksa
        $this->tanggalperiksa->EditAttrs["class"] = "form-control";
        $this->tanggalperiksa->EditCustomAttributes = "";
        $this->tanggalperiksa->EditValue = FormatDateTime($this->tanggalperiksa->CurrentValue, 8);
        $this->tanggalperiksa->PlaceHolder = RemoveHtml($this->tanggalperiksa->caption());

        // kodedokter
        $this->kodedokter->EditAttrs["class"] = "form-control";
        $this->kodedokter->EditCustomAttributes = "";
        if (!$this->kodedokter->Raw) {
            $this->kodedokter->CurrentValue = HtmlDecode($this->kodedokter->CurrentValue);
        }
        $this->kodedokter->EditValue = $this->kodedokter->CurrentValue;
        $this->kodedokter->PlaceHolder = RemoveHtml($this->kodedokter->caption());

        // jampraktek
        $this->jampraktek->EditAttrs["class"] = "form-control";
        $this->jampraktek->EditCustomAttributes = "";
        if (!$this->jampraktek->Raw) {
            $this->jampraktek->CurrentValue = HtmlDecode($this->jampraktek->CurrentValue);
        }
        $this->jampraktek->EditValue = $this->jampraktek->CurrentValue;
        $this->jampraktek->PlaceHolder = RemoveHtml($this->jampraktek->caption());

        // jeniskunjungan
        $this->jeniskunjungan->EditAttrs["class"] = "form-control";
        $this->jeniskunjungan->EditCustomAttributes = "";
        if (!$this->jeniskunjungan->Raw) {
            $this->jeniskunjungan->CurrentValue = HtmlDecode($this->jeniskunjungan->CurrentValue);
        }
        $this->jeniskunjungan->EditValue = $this->jeniskunjungan->CurrentValue;
        $this->jeniskunjungan->PlaceHolder = RemoveHtml($this->jeniskunjungan->caption());

        // nomorreferensi
        $this->nomorreferensi->EditAttrs["class"] = "form-control";
        $this->nomorreferensi->EditCustomAttributes = "";
        if (!$this->nomorreferensi->Raw) {
            $this->nomorreferensi->CurrentValue = HtmlDecode($this->nomorreferensi->CurrentValue);
        }
        $this->nomorreferensi->EditValue = $this->nomorreferensi->CurrentValue;
        $this->nomorreferensi->PlaceHolder = RemoveHtml($this->nomorreferensi->caption());

        // nomorantrean
        $this->nomorantrean->EditAttrs["class"] = "form-control";
        $this->nomorantrean->EditCustomAttributes = "";
        if (!$this->nomorantrean->Raw) {
            $this->nomorantrean->CurrentValue = HtmlDecode($this->nomorantrean->CurrentValue);
        }
        $this->nomorantrean->EditValue = $this->nomorantrean->CurrentValue;
        $this->nomorantrean->PlaceHolder = RemoveHtml($this->nomorantrean->caption());

        // angkaantrean
        $this->angkaantrean->EditAttrs["class"] = "form-control";
        $this->angkaantrean->EditCustomAttributes = "";
        if (!$this->angkaantrean->Raw) {
            $this->angkaantrean->CurrentValue = HtmlDecode($this->angkaantrean->CurrentValue);
        }
        $this->angkaantrean->EditValue = $this->angkaantrean->CurrentValue;
        $this->angkaantrean->PlaceHolder = RemoveHtml($this->angkaantrean->caption());

        // estimasidilayani
        $this->estimasidilayani->EditAttrs["class"] = "form-control";
        $this->estimasidilayani->EditCustomAttributes = "";
        if (!$this->estimasidilayani->Raw) {
            $this->estimasidilayani->CurrentValue = HtmlDecode($this->estimasidilayani->CurrentValue);
        }
        $this->estimasidilayani->EditValue = $this->estimasidilayani->CurrentValue;
        $this->estimasidilayani->PlaceHolder = RemoveHtml($this->estimasidilayani->caption());

        // sisakuotajkn
        $this->sisakuotajkn->EditAttrs["class"] = "form-control";
        $this->sisakuotajkn->EditCustomAttributes = "";
        $this->sisakuotajkn->EditValue = $this->sisakuotajkn->CurrentValue;
        $this->sisakuotajkn->PlaceHolder = RemoveHtml($this->sisakuotajkn->caption());

        // kuotajkn
        $this->kuotajkn->EditAttrs["class"] = "form-control";
        $this->kuotajkn->EditCustomAttributes = "";
        $this->kuotajkn->EditValue = $this->kuotajkn->CurrentValue;
        $this->kuotajkn->PlaceHolder = RemoveHtml($this->kuotajkn->caption());

        // sisakuotanonjkn
        $this->sisakuotanonjkn->EditAttrs["class"] = "form-control";
        $this->sisakuotanonjkn->EditCustomAttributes = "";
        $this->sisakuotanonjkn->EditValue = $this->sisakuotanonjkn->CurrentValue;
        $this->sisakuotanonjkn->PlaceHolder = RemoveHtml($this->sisakuotanonjkn->caption());

        // kuotanonjkn
        $this->kuotanonjkn->EditAttrs["class"] = "form-control";
        $this->kuotanonjkn->EditCustomAttributes = "";
        $this->kuotanonjkn->EditValue = $this->kuotanonjkn->CurrentValue;
        $this->kuotanonjkn->PlaceHolder = RemoveHtml($this->kuotanonjkn->caption());

        // status
        $this->status->EditAttrs["class"] = "form-control";
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // validasi
        $this->validasi->EditAttrs["class"] = "form-control";
        $this->validasi->EditCustomAttributes = "";
        $this->validasi->EditValue = FormatDateTime($this->validasi->CurrentValue, 8);
        $this->validasi->PlaceHolder = RemoveHtml($this->validasi->caption());

        // statuskirim
        $this->statuskirim->EditAttrs["class"] = "form-control";
        $this->statuskirim->EditCustomAttributes = "";
        if (!$this->statuskirim->Raw) {
            $this->statuskirim->CurrentValue = HtmlDecode($this->statuskirim->CurrentValue);
        }
        $this->statuskirim->EditValue = $this->statuskirim->CurrentValue;
        $this->statuskirim->PlaceHolder = RemoveHtml($this->statuskirim->caption());

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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nobooking);
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->nomorkartu);
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->nohp);
                    $doc->exportCaption($this->kodepoli);
                    $doc->exportCaption($this->pasienbaru);
                    $doc->exportCaption($this->norm);
                    $doc->exportCaption($this->tanggalperiksa);
                    $doc->exportCaption($this->kodedokter);
                    $doc->exportCaption($this->jampraktek);
                    $doc->exportCaption($this->jeniskunjungan);
                    $doc->exportCaption($this->nomorreferensi);
                    $doc->exportCaption($this->nomorantrean);
                    $doc->exportCaption($this->angkaantrean);
                    $doc->exportCaption($this->estimasidilayani);
                    $doc->exportCaption($this->sisakuotajkn);
                    $doc->exportCaption($this->kuotajkn);
                    $doc->exportCaption($this->sisakuotanonjkn);
                    $doc->exportCaption($this->kuotanonjkn);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->validasi);
                    $doc->exportCaption($this->statuskirim);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nobooking);
                    $doc->exportCaption($this->no_rawat);
                    $doc->exportCaption($this->nomorkartu);
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->nohp);
                    $doc->exportCaption($this->kodepoli);
                    $doc->exportCaption($this->pasienbaru);
                    $doc->exportCaption($this->norm);
                    $doc->exportCaption($this->tanggalperiksa);
                    $doc->exportCaption($this->kodedokter);
                    $doc->exportCaption($this->jampraktek);
                    $doc->exportCaption($this->jeniskunjungan);
                    $doc->exportCaption($this->nomorreferensi);
                    $doc->exportCaption($this->nomorantrean);
                    $doc->exportCaption($this->angkaantrean);
                    $doc->exportCaption($this->estimasidilayani);
                    $doc->exportCaption($this->sisakuotajkn);
                    $doc->exportCaption($this->kuotajkn);
                    $doc->exportCaption($this->sisakuotanonjkn);
                    $doc->exportCaption($this->kuotanonjkn);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->validasi);
                    $doc->exportCaption($this->statuskirim);
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
                        $doc->exportField($this->id);
                        $doc->exportField($this->nobooking);
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->nomorkartu);
                        $doc->exportField($this->nik);
                        $doc->exportField($this->nohp);
                        $doc->exportField($this->kodepoli);
                        $doc->exportField($this->pasienbaru);
                        $doc->exportField($this->norm);
                        $doc->exportField($this->tanggalperiksa);
                        $doc->exportField($this->kodedokter);
                        $doc->exportField($this->jampraktek);
                        $doc->exportField($this->jeniskunjungan);
                        $doc->exportField($this->nomorreferensi);
                        $doc->exportField($this->nomorantrean);
                        $doc->exportField($this->angkaantrean);
                        $doc->exportField($this->estimasidilayani);
                        $doc->exportField($this->sisakuotajkn);
                        $doc->exportField($this->kuotajkn);
                        $doc->exportField($this->sisakuotanonjkn);
                        $doc->exportField($this->kuotanonjkn);
                        $doc->exportField($this->status);
                        $doc->exportField($this->validasi);
                        $doc->exportField($this->statuskirim);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->nobooking);
                        $doc->exportField($this->no_rawat);
                        $doc->exportField($this->nomorkartu);
                        $doc->exportField($this->nik);
                        $doc->exportField($this->nohp);
                        $doc->exportField($this->kodepoli);
                        $doc->exportField($this->pasienbaru);
                        $doc->exportField($this->norm);
                        $doc->exportField($this->tanggalperiksa);
                        $doc->exportField($this->kodedokter);
                        $doc->exportField($this->jampraktek);
                        $doc->exportField($this->jeniskunjungan);
                        $doc->exportField($this->nomorreferensi);
                        $doc->exportField($this->nomorantrean);
                        $doc->exportField($this->angkaantrean);
                        $doc->exportField($this->estimasidilayani);
                        $doc->exportField($this->sisakuotajkn);
                        $doc->exportField($this->kuotajkn);
                        $doc->exportField($this->sisakuotanonjkn);
                        $doc->exportField($this->kuotanonjkn);
                        $doc->exportField($this->status);
                        $doc->exportField($this->validasi);
                        $doc->exportField($this->statuskirim);
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
