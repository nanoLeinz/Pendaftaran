<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for ANTRIAN_PENDAFTARAN
 */
class AntrianPendaftaran extends DbTable
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
    public $Id;
    public $no_urut;
    public $tanggal_daftar;
    public $tanggal_panggil;
    public $loket;
    public $status_panggil;
    public $user;
    public $newapp;
    public $kdpoli;
    public $tanggal_pesan;
    public $tujuan;
    public $disabilitas;
    public $nama;
    public $no_bpjs;
    public $nomr;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jk;
    public $alamat;
    public $agama;
    public $pekerjaan;
    public $no_telp;
    public $nama_ibu;
    public $nama_ayah;
    public $nama_pasangan;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'ANTRIAN_PENDAFTARAN';
        $this->TableName = 'ANTRIAN_PENDAFTARAN';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[ANTRIAN_PENDAFTARAN]";
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

        // Id
        $this->Id = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_Id', 'Id', '[Id]', 'CAST([Id] AS NVARCHAR)', 20, 8, -1, false, '[Id]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->Id->IsAutoIncrement = true; // Autoincrement field
        $this->Id->IsPrimaryKey = true; // Primary key field
        $this->Id->Nullable = false; // NOT NULL field
        $this->Id->Sortable = true; // Allow sort
        $this->Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Id->Param, "CustomMsg");
        $this->Fields['Id'] = &$this->Id;

        // no_urut
        $this->no_urut = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_no_urut', 'no_urut', '[no_urut]', 'CAST([no_urut] AS NVARCHAR)', 20, 8, -1, false, '[no_urut]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_urut->Sortable = true; // Allow sort
        $this->no_urut->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->no_urut->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_urut->Param, "CustomMsg");
        $this->Fields['no_urut'] = &$this->no_urut;

        // tanggal_daftar
        $this->tanggal_daftar = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_tanggal_daftar', 'tanggal_daftar', '[tanggal_daftar]', CastDateFieldForLike("[tanggal_daftar]", 0, "DB"), 135, 8, 0, false, '[tanggal_daftar]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_daftar->Sortable = true; // Allow sort
        $this->tanggal_daftar->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_daftar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_daftar->Param, "CustomMsg");
        $this->Fields['tanggal_daftar'] = &$this->tanggal_daftar;

        // tanggal_panggil
        $this->tanggal_panggil = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_tanggal_panggil', 'tanggal_panggil', '[tanggal_panggil]', CastDateFieldForLike("[tanggal_panggil]", 0, "DB"), 135, 8, 0, false, '[tanggal_panggil]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_panggil->Sortable = true; // Allow sort
        $this->tanggal_panggil->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_panggil->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_panggil->Param, "CustomMsg");
        $this->Fields['tanggal_panggil'] = &$this->tanggal_panggil;

        // loket
        $this->loket = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_loket', 'loket', '[loket]', '[loket]', 200, 10, -1, false, '[loket]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->loket->Sortable = true; // Allow sort
        $this->loket->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->loket->Param, "CustomMsg");
        $this->Fields['loket'] = &$this->loket;

        // status_panggil
        $this->status_panggil = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_status_panggil', 'status_panggil', '[status_panggil]', 'CAST([status_panggil] AS NVARCHAR)', 3, 4, -1, false, '[status_panggil]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status_panggil->Sortable = true; // Allow sort
        $this->status_panggil->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status_panggil->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_panggil->Param, "CustomMsg");
        $this->Fields['status_panggil'] = &$this->status_panggil;

        // user
        $this->user = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_user', 'user', '[user]', 'CAST([user] AS NVARCHAR)', 20, 8, -1, false, '[user]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->user->Sortable = true; // Allow sort
        $this->user->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->user->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->user->Param, "CustomMsg");
        $this->Fields['user'] = &$this->user;

        // newapp
        $this->newapp = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_newapp', 'newapp', '[newapp]', 'CAST([newapp] AS NVARCHAR)', 3, 4, -1, false, '[newapp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->newapp->Sortable = true; // Allow sort
        $this->newapp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->newapp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->newapp->Param, "CustomMsg");
        $this->Fields['newapp'] = &$this->newapp;

        // kdpoli
        $this->kdpoli = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_kdpoli', 'kdpoli', '[kdpoli]', '[kdpoli]', 200, 10, -1, false, '[kdpoli]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kdpoli->Sortable = true; // Allow sort
        $this->kdpoli->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kdpoli->Param, "CustomMsg");
        $this->Fields['kdpoli'] = &$this->kdpoli;

        // tanggal_pesan
        $this->tanggal_pesan = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_tanggal_pesan', 'tanggal_pesan', '[tanggal_pesan]', CastDateFieldForLike("[tanggal_pesan]", 0, "DB"), 135, 8, 0, false, '[tanggal_pesan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_pesan->Sortable = true; // Allow sort
        $this->tanggal_pesan->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_pesan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_pesan->Param, "CustomMsg");
        $this->Fields['tanggal_pesan'] = &$this->tanggal_pesan;

        // tujuan
        $this->tujuan = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_tujuan', 'tujuan', '[tujuan]', '[tujuan]', 200, 255, -1, false, '[tujuan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tujuan->Sortable = true; // Allow sort
        $this->tujuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tujuan->Param, "CustomMsg");
        $this->Fields['tujuan'] = &$this->tujuan;

        // disabilitas
        $this->disabilitas = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_disabilitas', 'disabilitas', '[disabilitas]', 'CAST([disabilitas] AS NVARCHAR)', 3, 4, -1, false, '[disabilitas]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->disabilitas->Sortable = true; // Allow sort
        $this->disabilitas->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->disabilitas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->disabilitas->Param, "CustomMsg");
        $this->Fields['disabilitas'] = &$this->disabilitas;

        // nama
        $this->nama = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_nama', 'nama', '[nama]', '[nama]', 200, 50, -1, false, '[nama]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama->Sortable = true; // Allow sort
        $this->nama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama->Param, "CustomMsg");
        $this->Fields['nama'] = &$this->nama;

        // no_bpjs
        $this->no_bpjs = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_no_bpjs', 'no_bpjs', '[no_bpjs]', 'CAST([no_bpjs] AS NVARCHAR)', 3, 4, -1, false, '[no_bpjs]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_bpjs->Sortable = true; // Allow sort
        $this->no_bpjs->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->no_bpjs->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_bpjs->Param, "CustomMsg");
        $this->Fields['no_bpjs'] = &$this->no_bpjs;

        // nomr
        $this->nomr = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_nomr', 'nomr', '[nomr]', 'CAST([nomr] AS NVARCHAR)', 3, 4, -1, false, '[nomr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nomr->Sortable = true; // Allow sort
        $this->nomr->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->nomr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nomr->Param, "CustomMsg");
        $this->Fields['nomr'] = &$this->nomr;

        // tempat_lahir
        $this->tempat_lahir = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_tempat_lahir', 'tempat_lahir', '[tempat_lahir]', '[tempat_lahir]', 200, 100, -1, false, '[tempat_lahir]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tempat_lahir->Sortable = true; // Allow sort
        $this->tempat_lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tempat_lahir->Param, "CustomMsg");
        $this->Fields['tempat_lahir'] = &$this->tempat_lahir;

        // tanggal_lahir
        $this->tanggal_lahir = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_tanggal_lahir', 'tanggal_lahir', '[tanggal_lahir]', CastDateFieldForLike("[tanggal_lahir]", 0, "DB"), 133, 8, 0, false, '[tanggal_lahir]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_lahir->Sortable = true; // Allow sort
        $this->tanggal_lahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_lahir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_lahir->Param, "CustomMsg");
        $this->Fields['tanggal_lahir'] = &$this->tanggal_lahir;

        // jk
        $this->jk = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_jk', 'jk', '[jk]', 'CAST([jk] AS NVARCHAR)', 3, 4, -1, false, '[jk]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jk->Sortable = true; // Allow sort
        $this->jk->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jk->Param, "CustomMsg");
        $this->Fields['jk'] = &$this->jk;

        // alamat
        $this->alamat = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_alamat', 'alamat', '[alamat]', '[alamat]', 200, 150, -1, false, '[alamat]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamat->Sortable = true; // Allow sort
        $this->alamat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat->Param, "CustomMsg");
        $this->Fields['alamat'] = &$this->alamat;

        // agama
        $this->agama = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_agama', 'agama', '[agama]', 'CAST([agama] AS NVARCHAR)', 3, 4, -1, false, '[agama]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->agama->Sortable = true; // Allow sort
        $this->agama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->agama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->agama->Param, "CustomMsg");
        $this->Fields['agama'] = &$this->agama;

        // pekerjaan
        $this->pekerjaan = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_pekerjaan', 'pekerjaan', '[pekerjaan]', 'CAST([pekerjaan] AS NVARCHAR)', 3, 4, -1, false, '[pekerjaan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pekerjaan->Sortable = true; // Allow sort
        $this->pekerjaan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pekerjaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pekerjaan->Param, "CustomMsg");
        $this->Fields['pekerjaan'] = &$this->pekerjaan;

        // no_telp
        $this->no_telp = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_no_telp', 'no_telp', '[no_telp]', 'CAST([no_telp] AS NVARCHAR)', 3, 4, -1, false, '[no_telp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_telp->Sortable = true; // Allow sort
        $this->no_telp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->no_telp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_telp->Param, "CustomMsg");
        $this->Fields['no_telp'] = &$this->no_telp;

        // nama_ibu
        $this->nama_ibu = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_nama_ibu', 'nama_ibu', '[nama_ibu]', '[nama_ibu]', 200, 100, -1, false, '[nama_ibu]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_ibu->Sortable = true; // Allow sort
        $this->nama_ibu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_ibu->Param, "CustomMsg");
        $this->Fields['nama_ibu'] = &$this->nama_ibu;

        // nama_ayah
        $this->nama_ayah = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_nama_ayah', 'nama_ayah', '[nama_ayah]', '[nama_ayah]', 200, 100, -1, false, '[nama_ayah]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_ayah->Sortable = true; // Allow sort
        $this->nama_ayah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_ayah->Param, "CustomMsg");
        $this->Fields['nama_ayah'] = &$this->nama_ayah;

        // nama_pasangan
        $this->nama_pasangan = new DbField('ANTRIAN_PENDAFTARAN', 'ANTRIAN_PENDAFTARAN', 'x_nama_pasangan', 'nama_pasangan', '[nama_pasangan]', '[nama_pasangan]', 200, 100, -1, false, '[nama_pasangan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_pasangan->Sortable = true; // Allow sort
        $this->nama_pasangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_pasangan->Param, "CustomMsg");
        $this->Fields['nama_pasangan'] = &$this->nama_pasangan;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[ANTRIAN_PENDAFTARAN]";
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
            $this->Id->setDbValue($conn->lastInsertId());
            $rs['Id'] = $this->Id->DbValue;
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
            if (array_key_exists('Id', $rs)) {
                AddFilter($where, QuotedName('Id', $this->Dbid) . '=' . QuotedValue($rs['Id'], $this->Id->DataType, $this->Dbid));
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
        $this->Id->DbValue = $row['Id'];
        $this->no_urut->DbValue = $row['no_urut'];
        $this->tanggal_daftar->DbValue = $row['tanggal_daftar'];
        $this->tanggal_panggil->DbValue = $row['tanggal_panggil'];
        $this->loket->DbValue = $row['loket'];
        $this->status_panggil->DbValue = $row['status_panggil'];
        $this->user->DbValue = $row['user'];
        $this->newapp->DbValue = $row['newapp'];
        $this->kdpoli->DbValue = $row['kdpoli'];
        $this->tanggal_pesan->DbValue = $row['tanggal_pesan'];
        $this->tujuan->DbValue = $row['tujuan'];
        $this->disabilitas->DbValue = $row['disabilitas'];
        $this->nama->DbValue = $row['nama'];
        $this->no_bpjs->DbValue = $row['no_bpjs'];
        $this->nomr->DbValue = $row['nomr'];
        $this->tempat_lahir->DbValue = $row['tempat_lahir'];
        $this->tanggal_lahir->DbValue = $row['tanggal_lahir'];
        $this->jk->DbValue = $row['jk'];
        $this->alamat->DbValue = $row['alamat'];
        $this->agama->DbValue = $row['agama'];
        $this->pekerjaan->DbValue = $row['pekerjaan'];
        $this->no_telp->DbValue = $row['no_telp'];
        $this->nama_ibu->DbValue = $row['nama_ibu'];
        $this->nama_ayah->DbValue = $row['nama_ayah'];
        $this->nama_pasangan->DbValue = $row['nama_pasangan'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[Id] = @Id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->Id->CurrentValue : $this->Id->OldValue;
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
                $this->Id->CurrentValue = $keys[0];
            } else {
                $this->Id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('Id', $row) ? $row['Id'] : null;
        } else {
            $val = $this->Id->OldValue !== null ? $this->Id->OldValue : $this->Id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("AntrianPendaftaranList");
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
        if ($pageName == "AntrianPendaftaranView") {
            return $Language->phrase("View");
        } elseif ($pageName == "AntrianPendaftaranEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "AntrianPendaftaranAdd") {
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
                return "AntrianPendaftaranView";
            case Config("API_ADD_ACTION"):
                return "AntrianPendaftaranAdd";
            case Config("API_EDIT_ACTION"):
                return "AntrianPendaftaranEdit";
            case Config("API_DELETE_ACTION"):
                return "AntrianPendaftaranDelete";
            case Config("API_LIST_ACTION"):
                return "AntrianPendaftaranList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "AntrianPendaftaranList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("AntrianPendaftaranView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("AntrianPendaftaranView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "AntrianPendaftaranAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "AntrianPendaftaranAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("AntrianPendaftaranEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("AntrianPendaftaranAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("AntrianPendaftaranDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "Id:" . JsonEncode($this->Id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->Id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->Id->CurrentValue);
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
            if (($keyValue = Param("Id") ?? Route("Id")) !== null) {
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
                $this->Id->CurrentValue = $key;
            } else {
                $this->Id->OldValue = $key;
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
        $this->Id->setDbValue($row['Id']);
        $this->no_urut->setDbValue($row['no_urut']);
        $this->tanggal_daftar->setDbValue($row['tanggal_daftar']);
        $this->tanggal_panggil->setDbValue($row['tanggal_panggil']);
        $this->loket->setDbValue($row['loket']);
        $this->status_panggil->setDbValue($row['status_panggil']);
        $this->user->setDbValue($row['user']);
        $this->newapp->setDbValue($row['newapp']);
        $this->kdpoli->setDbValue($row['kdpoli']);
        $this->tanggal_pesan->setDbValue($row['tanggal_pesan']);
        $this->tujuan->setDbValue($row['tujuan']);
        $this->disabilitas->setDbValue($row['disabilitas']);
        $this->nama->setDbValue($row['nama']);
        $this->no_bpjs->setDbValue($row['no_bpjs']);
        $this->nomr->setDbValue($row['nomr']);
        $this->tempat_lahir->setDbValue($row['tempat_lahir']);
        $this->tanggal_lahir->setDbValue($row['tanggal_lahir']);
        $this->jk->setDbValue($row['jk']);
        $this->alamat->setDbValue($row['alamat']);
        $this->agama->setDbValue($row['agama']);
        $this->pekerjaan->setDbValue($row['pekerjaan']);
        $this->no_telp->setDbValue($row['no_telp']);
        $this->nama_ibu->setDbValue($row['nama_ibu']);
        $this->nama_ayah->setDbValue($row['nama_ayah']);
        $this->nama_pasangan->setDbValue($row['nama_pasangan']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Id

        // no_urut

        // tanggal_daftar

        // tanggal_panggil

        // loket

        // status_panggil

        // user

        // newapp

        // kdpoli

        // tanggal_pesan

        // tujuan

        // disabilitas

        // nama

        // no_bpjs

        // nomr

        // tempat_lahir

        // tanggal_lahir

        // jk

        // alamat

        // agama

        // pekerjaan

        // no_telp

        // nama_ibu

        // nama_ayah

        // nama_pasangan

        // Id
        $this->Id->ViewValue = $this->Id->CurrentValue;
        $this->Id->ViewCustomAttributes = "";

        // no_urut
        $this->no_urut->ViewValue = $this->no_urut->CurrentValue;
        $this->no_urut->ViewValue = FormatNumber($this->no_urut->ViewValue, 0, -2, -2, -2);
        $this->no_urut->ViewCustomAttributes = "";

        // tanggal_daftar
        $this->tanggal_daftar->ViewValue = $this->tanggal_daftar->CurrentValue;
        $this->tanggal_daftar->ViewValue = FormatDateTime($this->tanggal_daftar->ViewValue, 0);
        $this->tanggal_daftar->ViewCustomAttributes = "";

        // tanggal_panggil
        $this->tanggal_panggil->ViewValue = $this->tanggal_panggil->CurrentValue;
        $this->tanggal_panggil->ViewValue = FormatDateTime($this->tanggal_panggil->ViewValue, 0);
        $this->tanggal_panggil->ViewCustomAttributes = "";

        // loket
        $this->loket->ViewValue = $this->loket->CurrentValue;
        $this->loket->ViewCustomAttributes = "";

        // status_panggil
        $this->status_panggil->ViewValue = $this->status_panggil->CurrentValue;
        $this->status_panggil->ViewValue = FormatNumber($this->status_panggil->ViewValue, 0, -2, -2, -2);
        $this->status_panggil->ViewCustomAttributes = "";

        // user
        $this->user->ViewValue = $this->user->CurrentValue;
        $this->user->ViewValue = FormatNumber($this->user->ViewValue, 0, -2, -2, -2);
        $this->user->ViewCustomAttributes = "";

        // newapp
        $this->newapp->ViewValue = $this->newapp->CurrentValue;
        $this->newapp->ViewValue = FormatNumber($this->newapp->ViewValue, 0, -2, -2, -2);
        $this->newapp->ViewCustomAttributes = "";

        // kdpoli
        $this->kdpoli->ViewValue = $this->kdpoli->CurrentValue;
        $this->kdpoli->ViewCustomAttributes = "";

        // tanggal_pesan
        $this->tanggal_pesan->ViewValue = $this->tanggal_pesan->CurrentValue;
        $this->tanggal_pesan->ViewValue = FormatDateTime($this->tanggal_pesan->ViewValue, 0);
        $this->tanggal_pesan->ViewCustomAttributes = "";

        // tujuan
        $this->tujuan->ViewValue = $this->tujuan->CurrentValue;
        $this->tujuan->ViewCustomAttributes = "";

        // disabilitas
        $this->disabilitas->ViewValue = $this->disabilitas->CurrentValue;
        $this->disabilitas->ViewValue = FormatNumber($this->disabilitas->ViewValue, 0, -2, -2, -2);
        $this->disabilitas->ViewCustomAttributes = "";

        // nama
        $this->nama->ViewValue = $this->nama->CurrentValue;
        $this->nama->ViewCustomAttributes = "";

        // no_bpjs
        $this->no_bpjs->ViewValue = $this->no_bpjs->CurrentValue;
        $this->no_bpjs->ViewValue = FormatNumber($this->no_bpjs->ViewValue, 0, -2, -2, -2);
        $this->no_bpjs->ViewCustomAttributes = "";

        // nomr
        $this->nomr->ViewValue = $this->nomr->CurrentValue;
        $this->nomr->ViewValue = FormatNumber($this->nomr->ViewValue, 0, -2, -2, -2);
        $this->nomr->ViewCustomAttributes = "";

        // tempat_lahir
        $this->tempat_lahir->ViewValue = $this->tempat_lahir->CurrentValue;
        $this->tempat_lahir->ViewCustomAttributes = "";

        // tanggal_lahir
        $this->tanggal_lahir->ViewValue = $this->tanggal_lahir->CurrentValue;
        $this->tanggal_lahir->ViewValue = FormatDateTime($this->tanggal_lahir->ViewValue, 0);
        $this->tanggal_lahir->ViewCustomAttributes = "";

        // jk
        $this->jk->ViewValue = $this->jk->CurrentValue;
        $this->jk->ViewValue = FormatNumber($this->jk->ViewValue, 0, -2, -2, -2);
        $this->jk->ViewCustomAttributes = "";

        // alamat
        $this->alamat->ViewValue = $this->alamat->CurrentValue;
        $this->alamat->ViewCustomAttributes = "";

        // agama
        $this->agama->ViewValue = $this->agama->CurrentValue;
        $this->agama->ViewValue = FormatNumber($this->agama->ViewValue, 0, -2, -2, -2);
        $this->agama->ViewCustomAttributes = "";

        // pekerjaan
        $this->pekerjaan->ViewValue = $this->pekerjaan->CurrentValue;
        $this->pekerjaan->ViewValue = FormatNumber($this->pekerjaan->ViewValue, 0, -2, -2, -2);
        $this->pekerjaan->ViewCustomAttributes = "";

        // no_telp
        $this->no_telp->ViewValue = $this->no_telp->CurrentValue;
        $this->no_telp->ViewValue = FormatNumber($this->no_telp->ViewValue, 0, -2, -2, -2);
        $this->no_telp->ViewCustomAttributes = "";

        // nama_ibu
        $this->nama_ibu->ViewValue = $this->nama_ibu->CurrentValue;
        $this->nama_ibu->ViewCustomAttributes = "";

        // nama_ayah
        $this->nama_ayah->ViewValue = $this->nama_ayah->CurrentValue;
        $this->nama_ayah->ViewCustomAttributes = "";

        // nama_pasangan
        $this->nama_pasangan->ViewValue = $this->nama_pasangan->CurrentValue;
        $this->nama_pasangan->ViewCustomAttributes = "";

        // Id
        $this->Id->LinkCustomAttributes = "";
        $this->Id->HrefValue = "";
        $this->Id->TooltipValue = "";

        // no_urut
        $this->no_urut->LinkCustomAttributes = "";
        $this->no_urut->HrefValue = "";
        $this->no_urut->TooltipValue = "";

        // tanggal_daftar
        $this->tanggal_daftar->LinkCustomAttributes = "";
        $this->tanggal_daftar->HrefValue = "";
        $this->tanggal_daftar->TooltipValue = "";

        // tanggal_panggil
        $this->tanggal_panggil->LinkCustomAttributes = "";
        $this->tanggal_panggil->HrefValue = "";
        $this->tanggal_panggil->TooltipValue = "";

        // loket
        $this->loket->LinkCustomAttributes = "";
        $this->loket->HrefValue = "";
        $this->loket->TooltipValue = "";

        // status_panggil
        $this->status_panggil->LinkCustomAttributes = "";
        $this->status_panggil->HrefValue = "";
        $this->status_panggil->TooltipValue = "";

        // user
        $this->user->LinkCustomAttributes = "";
        $this->user->HrefValue = "";
        $this->user->TooltipValue = "";

        // newapp
        $this->newapp->LinkCustomAttributes = "";
        $this->newapp->HrefValue = "";
        $this->newapp->TooltipValue = "";

        // kdpoli
        $this->kdpoli->LinkCustomAttributes = "";
        $this->kdpoli->HrefValue = "";
        $this->kdpoli->TooltipValue = "";

        // tanggal_pesan
        $this->tanggal_pesan->LinkCustomAttributes = "";
        $this->tanggal_pesan->HrefValue = "";
        $this->tanggal_pesan->TooltipValue = "";

        // tujuan
        $this->tujuan->LinkCustomAttributes = "";
        $this->tujuan->HrefValue = "";
        $this->tujuan->TooltipValue = "";

        // disabilitas
        $this->disabilitas->LinkCustomAttributes = "";
        $this->disabilitas->HrefValue = "";
        $this->disabilitas->TooltipValue = "";

        // nama
        $this->nama->LinkCustomAttributes = "";
        $this->nama->HrefValue = "";
        $this->nama->TooltipValue = "";

        // no_bpjs
        $this->no_bpjs->LinkCustomAttributes = "";
        $this->no_bpjs->HrefValue = "";
        $this->no_bpjs->TooltipValue = "";

        // nomr
        $this->nomr->LinkCustomAttributes = "";
        $this->nomr->HrefValue = "";
        $this->nomr->TooltipValue = "";

        // tempat_lahir
        $this->tempat_lahir->LinkCustomAttributes = "";
        $this->tempat_lahir->HrefValue = "";
        $this->tempat_lahir->TooltipValue = "";

        // tanggal_lahir
        $this->tanggal_lahir->LinkCustomAttributes = "";
        $this->tanggal_lahir->HrefValue = "";
        $this->tanggal_lahir->TooltipValue = "";

        // jk
        $this->jk->LinkCustomAttributes = "";
        $this->jk->HrefValue = "";
        $this->jk->TooltipValue = "";

        // alamat
        $this->alamat->LinkCustomAttributes = "";
        $this->alamat->HrefValue = "";
        $this->alamat->TooltipValue = "";

        // agama
        $this->agama->LinkCustomAttributes = "";
        $this->agama->HrefValue = "";
        $this->agama->TooltipValue = "";

        // pekerjaan
        $this->pekerjaan->LinkCustomAttributes = "";
        $this->pekerjaan->HrefValue = "";
        $this->pekerjaan->TooltipValue = "";

        // no_telp
        $this->no_telp->LinkCustomAttributes = "";
        $this->no_telp->HrefValue = "";
        $this->no_telp->TooltipValue = "";

        // nama_ibu
        $this->nama_ibu->LinkCustomAttributes = "";
        $this->nama_ibu->HrefValue = "";
        $this->nama_ibu->TooltipValue = "";

        // nama_ayah
        $this->nama_ayah->LinkCustomAttributes = "";
        $this->nama_ayah->HrefValue = "";
        $this->nama_ayah->TooltipValue = "";

        // nama_pasangan
        $this->nama_pasangan->LinkCustomAttributes = "";
        $this->nama_pasangan->HrefValue = "";
        $this->nama_pasangan->TooltipValue = "";

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

        // Id
        $this->Id->EditAttrs["class"] = "form-control";
        $this->Id->EditCustomAttributes = "";
        $this->Id->EditValue = $this->Id->CurrentValue;
        $this->Id->ViewCustomAttributes = "";

        // no_urut
        $this->no_urut->EditAttrs["class"] = "form-control";
        $this->no_urut->EditCustomAttributes = "";
        $this->no_urut->EditValue = $this->no_urut->CurrentValue;
        $this->no_urut->PlaceHolder = RemoveHtml($this->no_urut->caption());

        // tanggal_daftar
        $this->tanggal_daftar->EditAttrs["class"] = "form-control";
        $this->tanggal_daftar->EditCustomAttributes = "";
        $this->tanggal_daftar->EditValue = FormatDateTime($this->tanggal_daftar->CurrentValue, 8);
        $this->tanggal_daftar->PlaceHolder = RemoveHtml($this->tanggal_daftar->caption());

        // tanggal_panggil
        $this->tanggal_panggil->EditAttrs["class"] = "form-control";
        $this->tanggal_panggil->EditCustomAttributes = "";
        $this->tanggal_panggil->EditValue = FormatDateTime($this->tanggal_panggil->CurrentValue, 8);
        $this->tanggal_panggil->PlaceHolder = RemoveHtml($this->tanggal_panggil->caption());

        // loket
        $this->loket->EditAttrs["class"] = "form-control";
        $this->loket->EditCustomAttributes = "";
        if (!$this->loket->Raw) {
            $this->loket->CurrentValue = HtmlDecode($this->loket->CurrentValue);
        }
        $this->loket->EditValue = $this->loket->CurrentValue;
        $this->loket->PlaceHolder = RemoveHtml($this->loket->caption());

        // status_panggil
        $this->status_panggil->EditAttrs["class"] = "form-control";
        $this->status_panggil->EditCustomAttributes = "";
        $this->status_panggil->EditValue = $this->status_panggil->CurrentValue;
        $this->status_panggil->PlaceHolder = RemoveHtml($this->status_panggil->caption());

        // user
        $this->user->EditAttrs["class"] = "form-control";
        $this->user->EditCustomAttributes = "";
        $this->user->EditValue = $this->user->CurrentValue;
        $this->user->PlaceHolder = RemoveHtml($this->user->caption());

        // newapp
        $this->newapp->EditAttrs["class"] = "form-control";
        $this->newapp->EditCustomAttributes = "";
        $this->newapp->EditValue = $this->newapp->CurrentValue;
        $this->newapp->PlaceHolder = RemoveHtml($this->newapp->caption());

        // kdpoli
        $this->kdpoli->EditAttrs["class"] = "form-control";
        $this->kdpoli->EditCustomAttributes = "";
        if (!$this->kdpoli->Raw) {
            $this->kdpoli->CurrentValue = HtmlDecode($this->kdpoli->CurrentValue);
        }
        $this->kdpoli->EditValue = $this->kdpoli->CurrentValue;
        $this->kdpoli->PlaceHolder = RemoveHtml($this->kdpoli->caption());

        // tanggal_pesan
        $this->tanggal_pesan->EditAttrs["class"] = "form-control";
        $this->tanggal_pesan->EditCustomAttributes = "";
        $this->tanggal_pesan->EditValue = FormatDateTime($this->tanggal_pesan->CurrentValue, 8);
        $this->tanggal_pesan->PlaceHolder = RemoveHtml($this->tanggal_pesan->caption());

        // tujuan
        $this->tujuan->EditAttrs["class"] = "form-control";
        $this->tujuan->EditCustomAttributes = "";
        if (!$this->tujuan->Raw) {
            $this->tujuan->CurrentValue = HtmlDecode($this->tujuan->CurrentValue);
        }
        $this->tujuan->EditValue = $this->tujuan->CurrentValue;
        $this->tujuan->PlaceHolder = RemoveHtml($this->tujuan->caption());

        // disabilitas
        $this->disabilitas->EditAttrs["class"] = "form-control";
        $this->disabilitas->EditCustomAttributes = "";
        $this->disabilitas->EditValue = $this->disabilitas->CurrentValue;
        $this->disabilitas->PlaceHolder = RemoveHtml($this->disabilitas->caption());

        // nama
        $this->nama->EditAttrs["class"] = "form-control";
        $this->nama->EditCustomAttributes = "";
        if (!$this->nama->Raw) {
            $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
        }
        $this->nama->EditValue = $this->nama->CurrentValue;
        $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

        // no_bpjs
        $this->no_bpjs->EditAttrs["class"] = "form-control";
        $this->no_bpjs->EditCustomAttributes = "";
        $this->no_bpjs->EditValue = $this->no_bpjs->CurrentValue;
        $this->no_bpjs->PlaceHolder = RemoveHtml($this->no_bpjs->caption());

        // nomr
        $this->nomr->EditAttrs["class"] = "form-control";
        $this->nomr->EditCustomAttributes = "";
        $this->nomr->EditValue = $this->nomr->CurrentValue;
        $this->nomr->PlaceHolder = RemoveHtml($this->nomr->caption());

        // tempat_lahir
        $this->tempat_lahir->EditAttrs["class"] = "form-control";
        $this->tempat_lahir->EditCustomAttributes = "";
        if (!$this->tempat_lahir->Raw) {
            $this->tempat_lahir->CurrentValue = HtmlDecode($this->tempat_lahir->CurrentValue);
        }
        $this->tempat_lahir->EditValue = $this->tempat_lahir->CurrentValue;
        $this->tempat_lahir->PlaceHolder = RemoveHtml($this->tempat_lahir->caption());

        // tanggal_lahir
        $this->tanggal_lahir->EditAttrs["class"] = "form-control";
        $this->tanggal_lahir->EditCustomAttributes = "";
        $this->tanggal_lahir->EditValue = FormatDateTime($this->tanggal_lahir->CurrentValue, 8);
        $this->tanggal_lahir->PlaceHolder = RemoveHtml($this->tanggal_lahir->caption());

        // jk
        $this->jk->EditAttrs["class"] = "form-control";
        $this->jk->EditCustomAttributes = "";
        $this->jk->EditValue = $this->jk->CurrentValue;
        $this->jk->PlaceHolder = RemoveHtml($this->jk->caption());

        // alamat
        $this->alamat->EditAttrs["class"] = "form-control";
        $this->alamat->EditCustomAttributes = "";
        if (!$this->alamat->Raw) {
            $this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
        }
        $this->alamat->EditValue = $this->alamat->CurrentValue;
        $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

        // agama
        $this->agama->EditAttrs["class"] = "form-control";
        $this->agama->EditCustomAttributes = "";
        $this->agama->EditValue = $this->agama->CurrentValue;
        $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

        // pekerjaan
        $this->pekerjaan->EditAttrs["class"] = "form-control";
        $this->pekerjaan->EditCustomAttributes = "";
        $this->pekerjaan->EditValue = $this->pekerjaan->CurrentValue;
        $this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

        // no_telp
        $this->no_telp->EditAttrs["class"] = "form-control";
        $this->no_telp->EditCustomAttributes = "";
        $this->no_telp->EditValue = $this->no_telp->CurrentValue;
        $this->no_telp->PlaceHolder = RemoveHtml($this->no_telp->caption());

        // nama_ibu
        $this->nama_ibu->EditAttrs["class"] = "form-control";
        $this->nama_ibu->EditCustomAttributes = "";
        if (!$this->nama_ibu->Raw) {
            $this->nama_ibu->CurrentValue = HtmlDecode($this->nama_ibu->CurrentValue);
        }
        $this->nama_ibu->EditValue = $this->nama_ibu->CurrentValue;
        $this->nama_ibu->PlaceHolder = RemoveHtml($this->nama_ibu->caption());

        // nama_ayah
        $this->nama_ayah->EditAttrs["class"] = "form-control";
        $this->nama_ayah->EditCustomAttributes = "";
        if (!$this->nama_ayah->Raw) {
            $this->nama_ayah->CurrentValue = HtmlDecode($this->nama_ayah->CurrentValue);
        }
        $this->nama_ayah->EditValue = $this->nama_ayah->CurrentValue;
        $this->nama_ayah->PlaceHolder = RemoveHtml($this->nama_ayah->caption());

        // nama_pasangan
        $this->nama_pasangan->EditAttrs["class"] = "form-control";
        $this->nama_pasangan->EditCustomAttributes = "";
        if (!$this->nama_pasangan->Raw) {
            $this->nama_pasangan->CurrentValue = HtmlDecode($this->nama_pasangan->CurrentValue);
        }
        $this->nama_pasangan->EditValue = $this->nama_pasangan->CurrentValue;
        $this->nama_pasangan->PlaceHolder = RemoveHtml($this->nama_pasangan->caption());

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
                    $doc->exportCaption($this->Id);
                    $doc->exportCaption($this->no_urut);
                    $doc->exportCaption($this->tanggal_daftar);
                    $doc->exportCaption($this->tanggal_panggil);
                    $doc->exportCaption($this->loket);
                    $doc->exportCaption($this->status_panggil);
                    $doc->exportCaption($this->user);
                    $doc->exportCaption($this->newapp);
                    $doc->exportCaption($this->kdpoli);
                    $doc->exportCaption($this->tanggal_pesan);
                    $doc->exportCaption($this->tujuan);
                    $doc->exportCaption($this->disabilitas);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->no_bpjs);
                    $doc->exportCaption($this->nomr);
                    $doc->exportCaption($this->tempat_lahir);
                    $doc->exportCaption($this->tanggal_lahir);
                    $doc->exportCaption($this->jk);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->pekerjaan);
                    $doc->exportCaption($this->no_telp);
                    $doc->exportCaption($this->nama_ibu);
                    $doc->exportCaption($this->nama_ayah);
                    $doc->exportCaption($this->nama_pasangan);
                } else {
                    $doc->exportCaption($this->Id);
                    $doc->exportCaption($this->no_urut);
                    $doc->exportCaption($this->tanggal_daftar);
                    $doc->exportCaption($this->tanggal_panggil);
                    $doc->exportCaption($this->loket);
                    $doc->exportCaption($this->status_panggil);
                    $doc->exportCaption($this->user);
                    $doc->exportCaption($this->newapp);
                    $doc->exportCaption($this->kdpoli);
                    $doc->exportCaption($this->tanggal_pesan);
                    $doc->exportCaption($this->tujuan);
                    $doc->exportCaption($this->disabilitas);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->no_bpjs);
                    $doc->exportCaption($this->nomr);
                    $doc->exportCaption($this->tempat_lahir);
                    $doc->exportCaption($this->tanggal_lahir);
                    $doc->exportCaption($this->jk);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->pekerjaan);
                    $doc->exportCaption($this->no_telp);
                    $doc->exportCaption($this->nama_ibu);
                    $doc->exportCaption($this->nama_ayah);
                    $doc->exportCaption($this->nama_pasangan);
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
                        $doc->exportField($this->Id);
                        $doc->exportField($this->no_urut);
                        $doc->exportField($this->tanggal_daftar);
                        $doc->exportField($this->tanggal_panggil);
                        $doc->exportField($this->loket);
                        $doc->exportField($this->status_panggil);
                        $doc->exportField($this->user);
                        $doc->exportField($this->newapp);
                        $doc->exportField($this->kdpoli);
                        $doc->exportField($this->tanggal_pesan);
                        $doc->exportField($this->tujuan);
                        $doc->exportField($this->disabilitas);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->no_bpjs);
                        $doc->exportField($this->nomr);
                        $doc->exportField($this->tempat_lahir);
                        $doc->exportField($this->tanggal_lahir);
                        $doc->exportField($this->jk);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->pekerjaan);
                        $doc->exportField($this->no_telp);
                        $doc->exportField($this->nama_ibu);
                        $doc->exportField($this->nama_ayah);
                        $doc->exportField($this->nama_pasangan);
                    } else {
                        $doc->exportField($this->Id);
                        $doc->exportField($this->no_urut);
                        $doc->exportField($this->tanggal_daftar);
                        $doc->exportField($this->tanggal_panggil);
                        $doc->exportField($this->loket);
                        $doc->exportField($this->status_panggil);
                        $doc->exportField($this->user);
                        $doc->exportField($this->newapp);
                        $doc->exportField($this->kdpoli);
                        $doc->exportField($this->tanggal_pesan);
                        $doc->exportField($this->tujuan);
                        $doc->exportField($this->disabilitas);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->no_bpjs);
                        $doc->exportField($this->nomr);
                        $doc->exportField($this->tempat_lahir);
                        $doc->exportField($this->tanggal_lahir);
                        $doc->exportField($this->jk);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->pekerjaan);
                        $doc->exportField($this->no_telp);
                        $doc->exportField($this->nama_ibu);
                        $doc->exportField($this->nama_ayah);
                        $doc->exportField($this->nama_pasangan);
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
