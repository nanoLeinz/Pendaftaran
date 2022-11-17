<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for INASIS_GET_PESERTA
 */
class InasisGetPeserta extends DbTable
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
    public $NOKARTU;
    public $INFO_DINSOS;
    public $INFO_IURAN;
    public $INFO_PROLANISPRB;
    public $KDJNSPESERTA;
    public $NMJNSPESERTA;
    public $KDKLSTANGGUNGAN;
    public $NMKLSTANGGUNGAN;
    public $NAMA;
    public $NIK;
    public $NOMR;
    public $PISA;
    public $PROVUMUM_KDCABANG;
    public $PROVUMUM_KDPROVIDER;
    public $PROVUMUM_NMCABANG;
    public $PROVUMUM_NMPROVIDER;
    public $SEX;
    public $STATUS_PESERTA;
    public $STATUS_PESERTA_KODE;
    public $TGLCETAKKARTU;
    public $TGLLAHIR;
    public $TGLTAT;
    public $TGLTMT;
    public $UMURSAATPELAYANAN;
    public $UMURSEKARANG;
    public $REST_CODE;
    public $REST_MESSAGE;
    public $REST_DATE;
    public $REST_METHOD;
    public $RESPON;
    public $COB_NMASURANSI;
    public $COB_NOASURANSI;
    public $COB_TGL_TAT;
    public $COB_TGL_TMT;
    public $NOTELEPON;
    public $INFO_NOSKTM;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'INASIS_GET_PESERTA';
        $this->TableName = 'INASIS_GET_PESERTA';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[INASIS_GET_PESERTA]";
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

        // NOKARTU
        $this->NOKARTU = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_NOKARTU', 'NOKARTU', '[NOKARTU]', '[NOKARTU]', 200, 50, -1, false, '[NOKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOKARTU->IsPrimaryKey = true; // Primary key field
        $this->NOKARTU->Nullable = false; // NOT NULL field
        $this->NOKARTU->Required = true; // Required field
        $this->NOKARTU->Sortable = true; // Allow sort
        $this->NOKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOKARTU->Param, "CustomMsg");
        $this->Fields['NOKARTU'] = &$this->NOKARTU;

        // INFO_DINSOS
        $this->INFO_DINSOS = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_INFO_DINSOS', 'INFO_DINSOS', '[INFO_DINSOS]', '[INFO_DINSOS]', 200, 150, -1, false, '[INFO_DINSOS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFO_DINSOS->Sortable = true; // Allow sort
        $this->INFO_DINSOS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFO_DINSOS->Param, "CustomMsg");
        $this->Fields['INFO_DINSOS'] = &$this->INFO_DINSOS;

        // INFO_IURAN
        $this->INFO_IURAN = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_INFO_IURAN', 'INFO_IURAN', '[INFO_IURAN]', '[INFO_IURAN]', 200, 50, -1, false, '[INFO_IURAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFO_IURAN->Sortable = true; // Allow sort
        $this->INFO_IURAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFO_IURAN->Param, "CustomMsg");
        $this->Fields['INFO_IURAN'] = &$this->INFO_IURAN;

        // INFO_PROLANISPRB
        $this->INFO_PROLANISPRB = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_INFO_PROLANISPRB', 'INFO_PROLANISPRB', '[INFO_PROLANISPRB]', '[INFO_PROLANISPRB]', 200, 150, -1, false, '[INFO_PROLANISPRB]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFO_PROLANISPRB->Sortable = true; // Allow sort
        $this->INFO_PROLANISPRB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFO_PROLANISPRB->Param, "CustomMsg");
        $this->Fields['INFO_PROLANISPRB'] = &$this->INFO_PROLANISPRB;

        // KDJNSPESERTA
        $this->KDJNSPESERTA = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_KDJNSPESERTA', 'KDJNSPESERTA', '[KDJNSPESERTA]', '[KDJNSPESERTA]', 129, 3, -1, false, '[KDJNSPESERTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDJNSPESERTA->Sortable = true; // Allow sort
        $this->KDJNSPESERTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDJNSPESERTA->Param, "CustomMsg");
        $this->Fields['KDJNSPESERTA'] = &$this->KDJNSPESERTA;

        // NMJNSPESERTA
        $this->NMJNSPESERTA = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_NMJNSPESERTA', 'NMJNSPESERTA', '[NMJNSPESERTA]', '[NMJNSPESERTA]', 200, 150, -1, false, '[NMJNSPESERTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMJNSPESERTA->Sortable = true; // Allow sort
        $this->NMJNSPESERTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMJNSPESERTA->Param, "CustomMsg");
        $this->Fields['NMJNSPESERTA'] = &$this->NMJNSPESERTA;

        // KDKLSTANGGUNGAN
        $this->KDKLSTANGGUNGAN = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_KDKLSTANGGUNGAN', 'KDKLSTANGGUNGAN', '[KDKLSTANGGUNGAN]', '[KDKLSTANGGUNGAN]', 129, 3, -1, false, '[KDKLSTANGGUNGAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDKLSTANGGUNGAN->Sortable = true; // Allow sort
        $this->KDKLSTANGGUNGAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDKLSTANGGUNGAN->Param, "CustomMsg");
        $this->Fields['KDKLSTANGGUNGAN'] = &$this->KDKLSTANGGUNGAN;

        // NMKLSTANGGUNGAN
        $this->NMKLSTANGGUNGAN = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_NMKLSTANGGUNGAN', 'NMKLSTANGGUNGAN', '[NMKLSTANGGUNGAN]', '[NMKLSTANGGUNGAN]', 200, 150, -1, false, '[NMKLSTANGGUNGAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMKLSTANGGUNGAN->Sortable = true; // Allow sort
        $this->NMKLSTANGGUNGAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMKLSTANGGUNGAN->Param, "CustomMsg");
        $this->Fields['NMKLSTANGGUNGAN'] = &$this->NMKLSTANGGUNGAN;

        // NAMA
        $this->NAMA = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_NAMA', 'NAMA', '[NAMA]', '[NAMA]', 200, 250, -1, false, '[NAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA->Sortable = true; // Allow sort
        $this->NAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA->Param, "CustomMsg");
        $this->Fields['NAMA'] = &$this->NAMA;

        // NIK
        $this->NIK = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_NIK', 'NIK', '[NIK]', '[NIK]', 200, 50, -1, false, '[NIK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // NOMR
        $this->NOMR = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_NOMR', 'NOMR', '[NOMR]', '[NOMR]', 200, 50, -1, false, '[NOMR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOMR->Sortable = true; // Allow sort
        $this->NOMR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOMR->Param, "CustomMsg");
        $this->Fields['NOMR'] = &$this->NOMR;

        // PISA
        $this->PISA = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_PISA', 'PISA', '[PISA]', '[PISA]', 129, 3, -1, false, '[PISA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PISA->Sortable = true; // Allow sort
        $this->PISA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PISA->Param, "CustomMsg");
        $this->Fields['PISA'] = &$this->PISA;

        // PROVUMUM_KDCABANG
        $this->PROVUMUM_KDCABANG = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_PROVUMUM_KDCABANG', 'PROVUMUM_KDCABANG', '[PROVUMUM_KDCABANG]', '[PROVUMUM_KDCABANG]', 200, 10, -1, false, '[PROVUMUM_KDCABANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVUMUM_KDCABANG->Sortable = true; // Allow sort
        $this->PROVUMUM_KDCABANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVUMUM_KDCABANG->Param, "CustomMsg");
        $this->Fields['PROVUMUM_KDCABANG'] = &$this->PROVUMUM_KDCABANG;

        // PROVUMUM_KDPROVIDER
        $this->PROVUMUM_KDPROVIDER = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_PROVUMUM_KDPROVIDER', 'PROVUMUM_KDPROVIDER', '[PROVUMUM_KDPROVIDER]', '[PROVUMUM_KDPROVIDER]', 200, 10, -1, false, '[PROVUMUM_KDPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVUMUM_KDPROVIDER->Sortable = true; // Allow sort
        $this->PROVUMUM_KDPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVUMUM_KDPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVUMUM_KDPROVIDER'] = &$this->PROVUMUM_KDPROVIDER;

        // PROVUMUM_NMCABANG
        $this->PROVUMUM_NMCABANG = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_PROVUMUM_NMCABANG', 'PROVUMUM_NMCABANG', '[PROVUMUM_NMCABANG]', '[PROVUMUM_NMCABANG]', 200, 200, -1, false, '[PROVUMUM_NMCABANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVUMUM_NMCABANG->Sortable = true; // Allow sort
        $this->PROVUMUM_NMCABANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVUMUM_NMCABANG->Param, "CustomMsg");
        $this->Fields['PROVUMUM_NMCABANG'] = &$this->PROVUMUM_NMCABANG;

        // PROVUMUM_NMPROVIDER
        $this->PROVUMUM_NMPROVIDER = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_PROVUMUM_NMPROVIDER', 'PROVUMUM_NMPROVIDER', '[PROVUMUM_NMPROVIDER]', '[PROVUMUM_NMPROVIDER]', 200, 200, -1, false, '[PROVUMUM_NMPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVUMUM_NMPROVIDER->Sortable = true; // Allow sort
        $this->PROVUMUM_NMPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVUMUM_NMPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVUMUM_NMPROVIDER'] = &$this->PROVUMUM_NMPROVIDER;

        // SEX
        $this->SEX = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_SEX', 'SEX', '[SEX]', '[SEX]', 200, 3, -1, false, '[SEX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SEX->Sortable = true; // Allow sort
        $this->SEX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEX->Param, "CustomMsg");
        $this->Fields['SEX'] = &$this->SEX;

        // STATUS_PESERTA
        $this->STATUS_PESERTA = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_STATUS_PESERTA', 'STATUS_PESERTA', '[STATUS_PESERTA]', '[STATUS_PESERTA]', 200, 200, -1, false, '[STATUS_PESERTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PESERTA->Sortable = true; // Allow sort
        $this->STATUS_PESERTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PESERTA->Param, "CustomMsg");
        $this->Fields['STATUS_PESERTA'] = &$this->STATUS_PESERTA;

        // STATUS_PESERTA_KODE
        $this->STATUS_PESERTA_KODE = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_STATUS_PESERTA_KODE', 'STATUS_PESERTA_KODE', '[STATUS_PESERTA_KODE]', '[STATUS_PESERTA_KODE]', 200, 3, -1, false, '[STATUS_PESERTA_KODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PESERTA_KODE->Sortable = true; // Allow sort
        $this->STATUS_PESERTA_KODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PESERTA_KODE->Param, "CustomMsg");
        $this->Fields['STATUS_PESERTA_KODE'] = &$this->STATUS_PESERTA_KODE;

        // TGLCETAKKARTU
        $this->TGLCETAKKARTU = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_TGLCETAKKARTU', 'TGLCETAKKARTU', '[TGLCETAKKARTU]', CastDateFieldForLike("[TGLCETAKKARTU]", 0, "DB"), 135, 8, 0, false, '[TGLCETAKKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLCETAKKARTU->Sortable = true; // Allow sort
        $this->TGLCETAKKARTU->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLCETAKKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLCETAKKARTU->Param, "CustomMsg");
        $this->Fields['TGLCETAKKARTU'] = &$this->TGLCETAKKARTU;

        // TGLLAHIR
        $this->TGLLAHIR = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_TGLLAHIR', 'TGLLAHIR', '[TGLLAHIR]', CastDateFieldForLike("[TGLLAHIR]", 0, "DB"), 135, 8, 0, false, '[TGLLAHIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLLAHIR->Sortable = true; // Allow sort
        $this->TGLLAHIR->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLLAHIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLLAHIR->Param, "CustomMsg");
        $this->Fields['TGLLAHIR'] = &$this->TGLLAHIR;

        // TGLTAT
        $this->TGLTAT = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_TGLTAT', 'TGLTAT', '[TGLTAT]', CastDateFieldForLike("[TGLTAT]", 0, "DB"), 135, 8, 0, false, '[TGLTAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLTAT->Sortable = true; // Allow sort
        $this->TGLTAT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLTAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLTAT->Param, "CustomMsg");
        $this->Fields['TGLTAT'] = &$this->TGLTAT;

        // TGLTMT
        $this->TGLTMT = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_TGLTMT', 'TGLTMT', '[TGLTMT]', CastDateFieldForLike("[TGLTMT]", 0, "DB"), 135, 8, 0, false, '[TGLTMT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLTMT->Sortable = true; // Allow sort
        $this->TGLTMT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLTMT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLTMT->Param, "CustomMsg");
        $this->Fields['TGLTMT'] = &$this->TGLTMT;

        // UMURSAATPELAYANAN
        $this->UMURSAATPELAYANAN = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_UMURSAATPELAYANAN', 'UMURSAATPELAYANAN', '[UMURSAATPELAYANAN]', '[UMURSAATPELAYANAN]', 200, 50, -1, false, '[UMURSAATPELAYANAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->UMURSAATPELAYANAN->Sortable = true; // Allow sort
        $this->UMURSAATPELAYANAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->UMURSAATPELAYANAN->Param, "CustomMsg");
        $this->Fields['UMURSAATPELAYANAN'] = &$this->UMURSAATPELAYANAN;

        // UMURSEKARANG
        $this->UMURSEKARANG = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_UMURSEKARANG', 'UMURSEKARANG', '[UMURSEKARANG]', '[UMURSEKARANG]', 200, 50, -1, false, '[UMURSEKARANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->UMURSEKARANG->Sortable = true; // Allow sort
        $this->UMURSEKARANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->UMURSEKARANG->Param, "CustomMsg");
        $this->Fields['UMURSEKARANG'] = &$this->UMURSEKARANG;

        // REST_CODE
        $this->REST_CODE = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_REST_CODE', 'REST_CODE', '[REST_CODE]', '[REST_CODE]', 200, 3, -1, false, '[REST_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REST_CODE->Sortable = true; // Allow sort
        $this->REST_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_CODE->Param, "CustomMsg");
        $this->Fields['REST_CODE'] = &$this->REST_CODE;

        // REST_MESSAGE
        $this->REST_MESSAGE = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_REST_MESSAGE', 'REST_MESSAGE', '[REST_MESSAGE]', '[REST_MESSAGE]', 200, 150, -1, false, '[REST_MESSAGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REST_MESSAGE->Sortable = true; // Allow sort
        $this->REST_MESSAGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_MESSAGE->Param, "CustomMsg");
        $this->Fields['REST_MESSAGE'] = &$this->REST_MESSAGE;

        // REST_DATE
        $this->REST_DATE = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_REST_DATE', 'REST_DATE', '[REST_DATE]', CastDateFieldForLike("[REST_DATE]", 0, "DB"), 135, 8, 0, false, '[REST_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REST_DATE->Sortable = true; // Allow sort
        $this->REST_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REST_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_DATE->Param, "CustomMsg");
        $this->Fields['REST_DATE'] = &$this->REST_DATE;

        // REST_METHOD
        $this->REST_METHOD = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_REST_METHOD', 'REST_METHOD', '[REST_METHOD]', '[REST_METHOD]', 200, 10, -1, false, '[REST_METHOD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REST_METHOD->Sortable = true; // Allow sort
        $this->REST_METHOD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_METHOD->Param, "CustomMsg");
        $this->Fields['REST_METHOD'] = &$this->REST_METHOD;

        // RESPON
        $this->RESPON = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_RESPON', 'RESPON', '[RESPON]', '[RESPON]', 201, 0, -1, false, '[RESPON]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPON->Sortable = true; // Allow sort
        $this->RESPON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPON->Param, "CustomMsg");
        $this->Fields['RESPON'] = &$this->RESPON;

        // COB_NMASURANSI
        $this->COB_NMASURANSI = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_COB_NMASURANSI', 'COB_NMASURANSI', '[COB_NMASURANSI]', '[COB_NMASURANSI]', 200, 150, -1, false, '[COB_NMASURANSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COB_NMASURANSI->Sortable = true; // Allow sort
        $this->COB_NMASURANSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COB_NMASURANSI->Param, "CustomMsg");
        $this->Fields['COB_NMASURANSI'] = &$this->COB_NMASURANSI;

        // COB_NOASURANSI
        $this->COB_NOASURANSI = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_COB_NOASURANSI', 'COB_NOASURANSI', '[COB_NOASURANSI]', '[COB_NOASURANSI]', 200, 50, -1, false, '[COB_NOASURANSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COB_NOASURANSI->Sortable = true; // Allow sort
        $this->COB_NOASURANSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COB_NOASURANSI->Param, "CustomMsg");
        $this->Fields['COB_NOASURANSI'] = &$this->COB_NOASURANSI;

        // COB_TGL_TAT
        $this->COB_TGL_TAT = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_COB_TGL_TAT', 'COB_TGL_TAT', '[COB_TGL_TAT]', CastDateFieldForLike("[COB_TGL_TAT]", 0, "DB"), 135, 8, 0, false, '[COB_TGL_TAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COB_TGL_TAT->Sortable = true; // Allow sort
        $this->COB_TGL_TAT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->COB_TGL_TAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COB_TGL_TAT->Param, "CustomMsg");
        $this->Fields['COB_TGL_TAT'] = &$this->COB_TGL_TAT;

        // COB_TGL_TMT
        $this->COB_TGL_TMT = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_COB_TGL_TMT', 'COB_TGL_TMT', '[COB_TGL_TMT]', CastDateFieldForLike("[COB_TGL_TMT]", 0, "DB"), 135, 8, 0, false, '[COB_TGL_TMT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COB_TGL_TMT->Sortable = true; // Allow sort
        $this->COB_TGL_TMT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->COB_TGL_TMT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COB_TGL_TMT->Param, "CustomMsg");
        $this->Fields['COB_TGL_TMT'] = &$this->COB_TGL_TMT;

        // NOTELEPON
        $this->NOTELEPON = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_NOTELEPON', 'NOTELEPON', '[NOTELEPON]', '[NOTELEPON]', 200, 25, -1, false, '[NOTELEPON]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOTELEPON->Sortable = true; // Allow sort
        $this->NOTELEPON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOTELEPON->Param, "CustomMsg");
        $this->Fields['NOTELEPON'] = &$this->NOTELEPON;

        // INFO_NOSKTM
        $this->INFO_NOSKTM = new DbField('INASIS_GET_PESERTA', 'INASIS_GET_PESERTA', 'x_INFO_NOSKTM', 'INFO_NOSKTM', '[INFO_NOSKTM]', '[INFO_NOSKTM]', 200, 50, -1, false, '[INFO_NOSKTM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFO_NOSKTM->Sortable = true; // Allow sort
        $this->INFO_NOSKTM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFO_NOSKTM->Param, "CustomMsg");
        $this->Fields['INFO_NOSKTM'] = &$this->INFO_NOSKTM;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[INASIS_GET_PESERTA]";
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
            if (array_key_exists('NOKARTU', $rs)) {
                AddFilter($where, QuotedName('NOKARTU', $this->Dbid) . '=' . QuotedValue($rs['NOKARTU'], $this->NOKARTU->DataType, $this->Dbid));
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
        $this->NOKARTU->DbValue = $row['NOKARTU'];
        $this->INFO_DINSOS->DbValue = $row['INFO_DINSOS'];
        $this->INFO_IURAN->DbValue = $row['INFO_IURAN'];
        $this->INFO_PROLANISPRB->DbValue = $row['INFO_PROLANISPRB'];
        $this->KDJNSPESERTA->DbValue = $row['KDJNSPESERTA'];
        $this->NMJNSPESERTA->DbValue = $row['NMJNSPESERTA'];
        $this->KDKLSTANGGUNGAN->DbValue = $row['KDKLSTANGGUNGAN'];
        $this->NMKLSTANGGUNGAN->DbValue = $row['NMKLSTANGGUNGAN'];
        $this->NAMA->DbValue = $row['NAMA'];
        $this->NIK->DbValue = $row['NIK'];
        $this->NOMR->DbValue = $row['NOMR'];
        $this->PISA->DbValue = $row['PISA'];
        $this->PROVUMUM_KDCABANG->DbValue = $row['PROVUMUM_KDCABANG'];
        $this->PROVUMUM_KDPROVIDER->DbValue = $row['PROVUMUM_KDPROVIDER'];
        $this->PROVUMUM_NMCABANG->DbValue = $row['PROVUMUM_NMCABANG'];
        $this->PROVUMUM_NMPROVIDER->DbValue = $row['PROVUMUM_NMPROVIDER'];
        $this->SEX->DbValue = $row['SEX'];
        $this->STATUS_PESERTA->DbValue = $row['STATUS_PESERTA'];
        $this->STATUS_PESERTA_KODE->DbValue = $row['STATUS_PESERTA_KODE'];
        $this->TGLCETAKKARTU->DbValue = $row['TGLCETAKKARTU'];
        $this->TGLLAHIR->DbValue = $row['TGLLAHIR'];
        $this->TGLTAT->DbValue = $row['TGLTAT'];
        $this->TGLTMT->DbValue = $row['TGLTMT'];
        $this->UMURSAATPELAYANAN->DbValue = $row['UMURSAATPELAYANAN'];
        $this->UMURSEKARANG->DbValue = $row['UMURSEKARANG'];
        $this->REST_CODE->DbValue = $row['REST_CODE'];
        $this->REST_MESSAGE->DbValue = $row['REST_MESSAGE'];
        $this->REST_DATE->DbValue = $row['REST_DATE'];
        $this->REST_METHOD->DbValue = $row['REST_METHOD'];
        $this->RESPON->DbValue = $row['RESPON'];
        $this->COB_NMASURANSI->DbValue = $row['COB_NMASURANSI'];
        $this->COB_NOASURANSI->DbValue = $row['COB_NOASURANSI'];
        $this->COB_TGL_TAT->DbValue = $row['COB_TGL_TAT'];
        $this->COB_TGL_TMT->DbValue = $row['COB_TGL_TMT'];
        $this->NOTELEPON->DbValue = $row['NOTELEPON'];
        $this->INFO_NOSKTM->DbValue = $row['INFO_NOSKTM'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[NOKARTU] = '@NOKARTU@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->NOKARTU->CurrentValue : $this->NOKARTU->OldValue;
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
                $this->NOKARTU->CurrentValue = $keys[0];
            } else {
                $this->NOKARTU->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('NOKARTU', $row) ? $row['NOKARTU'] : null;
        } else {
            $val = $this->NOKARTU->OldValue !== null ? $this->NOKARTU->OldValue : $this->NOKARTU->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NOKARTU@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("InasisGetPesertaList");
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
        if ($pageName == "InasisGetPesertaView") {
            return $Language->phrase("View");
        } elseif ($pageName == "InasisGetPesertaEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "InasisGetPesertaAdd") {
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
                return "InasisGetPesertaView";
            case Config("API_ADD_ACTION"):
                return "InasisGetPesertaAdd";
            case Config("API_EDIT_ACTION"):
                return "InasisGetPesertaEdit";
            case Config("API_DELETE_ACTION"):
                return "InasisGetPesertaDelete";
            case Config("API_LIST_ACTION"):
                return "InasisGetPesertaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "InasisGetPesertaList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("InasisGetPesertaView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("InasisGetPesertaView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "InasisGetPesertaAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "InasisGetPesertaAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("InasisGetPesertaEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("InasisGetPesertaAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("InasisGetPesertaDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "NOKARTU:" . JsonEncode($this->NOKARTU->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NOKARTU->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NOKARTU->CurrentValue);
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
            if (($keyValue = Param("NOKARTU") ?? Route("NOKARTU")) !== null) {
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
                $this->NOKARTU->CurrentValue = $key;
            } else {
                $this->NOKARTU->OldValue = $key;
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
        $this->NOKARTU->setDbValue($row['NOKARTU']);
        $this->INFO_DINSOS->setDbValue($row['INFO_DINSOS']);
        $this->INFO_IURAN->setDbValue($row['INFO_IURAN']);
        $this->INFO_PROLANISPRB->setDbValue($row['INFO_PROLANISPRB']);
        $this->KDJNSPESERTA->setDbValue($row['KDJNSPESERTA']);
        $this->NMJNSPESERTA->setDbValue($row['NMJNSPESERTA']);
        $this->KDKLSTANGGUNGAN->setDbValue($row['KDKLSTANGGUNGAN']);
        $this->NMKLSTANGGUNGAN->setDbValue($row['NMKLSTANGGUNGAN']);
        $this->NAMA->setDbValue($row['NAMA']);
        $this->NIK->setDbValue($row['NIK']);
        $this->NOMR->setDbValue($row['NOMR']);
        $this->PISA->setDbValue($row['PISA']);
        $this->PROVUMUM_KDCABANG->setDbValue($row['PROVUMUM_KDCABANG']);
        $this->PROVUMUM_KDPROVIDER->setDbValue($row['PROVUMUM_KDPROVIDER']);
        $this->PROVUMUM_NMCABANG->setDbValue($row['PROVUMUM_NMCABANG']);
        $this->PROVUMUM_NMPROVIDER->setDbValue($row['PROVUMUM_NMPROVIDER']);
        $this->SEX->setDbValue($row['SEX']);
        $this->STATUS_PESERTA->setDbValue($row['STATUS_PESERTA']);
        $this->STATUS_PESERTA_KODE->setDbValue($row['STATUS_PESERTA_KODE']);
        $this->TGLCETAKKARTU->setDbValue($row['TGLCETAKKARTU']);
        $this->TGLLAHIR->setDbValue($row['TGLLAHIR']);
        $this->TGLTAT->setDbValue($row['TGLTAT']);
        $this->TGLTMT->setDbValue($row['TGLTMT']);
        $this->UMURSAATPELAYANAN->setDbValue($row['UMURSAATPELAYANAN']);
        $this->UMURSEKARANG->setDbValue($row['UMURSEKARANG']);
        $this->REST_CODE->setDbValue($row['REST_CODE']);
        $this->REST_MESSAGE->setDbValue($row['REST_MESSAGE']);
        $this->REST_DATE->setDbValue($row['REST_DATE']);
        $this->REST_METHOD->setDbValue($row['REST_METHOD']);
        $this->RESPON->setDbValue($row['RESPON']);
        $this->COB_NMASURANSI->setDbValue($row['COB_NMASURANSI']);
        $this->COB_NOASURANSI->setDbValue($row['COB_NOASURANSI']);
        $this->COB_TGL_TAT->setDbValue($row['COB_TGL_TAT']);
        $this->COB_TGL_TMT->setDbValue($row['COB_TGL_TMT']);
        $this->NOTELEPON->setDbValue($row['NOTELEPON']);
        $this->INFO_NOSKTM->setDbValue($row['INFO_NOSKTM']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NOKARTU

        // INFO_DINSOS

        // INFO_IURAN

        // INFO_PROLANISPRB

        // KDJNSPESERTA

        // NMJNSPESERTA

        // KDKLSTANGGUNGAN

        // NMKLSTANGGUNGAN

        // NAMA

        // NIK

        // NOMR

        // PISA

        // PROVUMUM_KDCABANG

        // PROVUMUM_KDPROVIDER

        // PROVUMUM_NMCABANG

        // PROVUMUM_NMPROVIDER

        // SEX

        // STATUS_PESERTA

        // STATUS_PESERTA_KODE

        // TGLCETAKKARTU

        // TGLLAHIR

        // TGLTAT

        // TGLTMT

        // UMURSAATPELAYANAN

        // UMURSEKARANG

        // REST_CODE

        // REST_MESSAGE

        // REST_DATE

        // REST_METHOD

        // RESPON

        // COB_NMASURANSI

        // COB_NOASURANSI

        // COB_TGL_TAT

        // COB_TGL_TMT

        // NOTELEPON

        // INFO_NOSKTM

        // NOKARTU
        $this->NOKARTU->ViewValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->ViewCustomAttributes = "";

        // INFO_DINSOS
        $this->INFO_DINSOS->ViewValue = $this->INFO_DINSOS->CurrentValue;
        $this->INFO_DINSOS->ViewCustomAttributes = "";

        // INFO_IURAN
        $this->INFO_IURAN->ViewValue = $this->INFO_IURAN->CurrentValue;
        $this->INFO_IURAN->ViewCustomAttributes = "";

        // INFO_PROLANISPRB
        $this->INFO_PROLANISPRB->ViewValue = $this->INFO_PROLANISPRB->CurrentValue;
        $this->INFO_PROLANISPRB->ViewCustomAttributes = "";

        // KDJNSPESERTA
        $this->KDJNSPESERTA->ViewValue = $this->KDJNSPESERTA->CurrentValue;
        $this->KDJNSPESERTA->ViewCustomAttributes = "";

        // NMJNSPESERTA
        $this->NMJNSPESERTA->ViewValue = $this->NMJNSPESERTA->CurrentValue;
        $this->NMJNSPESERTA->ViewCustomAttributes = "";

        // KDKLSTANGGUNGAN
        $this->KDKLSTANGGUNGAN->ViewValue = $this->KDKLSTANGGUNGAN->CurrentValue;
        $this->KDKLSTANGGUNGAN->ViewCustomAttributes = "";

        // NMKLSTANGGUNGAN
        $this->NMKLSTANGGUNGAN->ViewValue = $this->NMKLSTANGGUNGAN->CurrentValue;
        $this->NMKLSTANGGUNGAN->ViewCustomAttributes = "";

        // NAMA
        $this->NAMA->ViewValue = $this->NAMA->CurrentValue;
        $this->NAMA->ViewCustomAttributes = "";

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // NOMR
        $this->NOMR->ViewValue = $this->NOMR->CurrentValue;
        $this->NOMR->ViewCustomAttributes = "";

        // PISA
        $this->PISA->ViewValue = $this->PISA->CurrentValue;
        $this->PISA->ViewCustomAttributes = "";

        // PROVUMUM_KDCABANG
        $this->PROVUMUM_KDCABANG->ViewValue = $this->PROVUMUM_KDCABANG->CurrentValue;
        $this->PROVUMUM_KDCABANG->ViewCustomAttributes = "";

        // PROVUMUM_KDPROVIDER
        $this->PROVUMUM_KDPROVIDER->ViewValue = $this->PROVUMUM_KDPROVIDER->CurrentValue;
        $this->PROVUMUM_KDPROVIDER->ViewCustomAttributes = "";

        // PROVUMUM_NMCABANG
        $this->PROVUMUM_NMCABANG->ViewValue = $this->PROVUMUM_NMCABANG->CurrentValue;
        $this->PROVUMUM_NMCABANG->ViewCustomAttributes = "";

        // PROVUMUM_NMPROVIDER
        $this->PROVUMUM_NMPROVIDER->ViewValue = $this->PROVUMUM_NMPROVIDER->CurrentValue;
        $this->PROVUMUM_NMPROVIDER->ViewCustomAttributes = "";

        // SEX
        $this->SEX->ViewValue = $this->SEX->CurrentValue;
        $this->SEX->ViewCustomAttributes = "";

        // STATUS_PESERTA
        $this->STATUS_PESERTA->ViewValue = $this->STATUS_PESERTA->CurrentValue;
        $this->STATUS_PESERTA->ViewCustomAttributes = "";

        // STATUS_PESERTA_KODE
        $this->STATUS_PESERTA_KODE->ViewValue = $this->STATUS_PESERTA_KODE->CurrentValue;
        $this->STATUS_PESERTA_KODE->ViewCustomAttributes = "";

        // TGLCETAKKARTU
        $this->TGLCETAKKARTU->ViewValue = $this->TGLCETAKKARTU->CurrentValue;
        $this->TGLCETAKKARTU->ViewValue = FormatDateTime($this->TGLCETAKKARTU->ViewValue, 0);
        $this->TGLCETAKKARTU->ViewCustomAttributes = "";

        // TGLLAHIR
        $this->TGLLAHIR->ViewValue = $this->TGLLAHIR->CurrentValue;
        $this->TGLLAHIR->ViewValue = FormatDateTime($this->TGLLAHIR->ViewValue, 0);
        $this->TGLLAHIR->ViewCustomAttributes = "";

        // TGLTAT
        $this->TGLTAT->ViewValue = $this->TGLTAT->CurrentValue;
        $this->TGLTAT->ViewValue = FormatDateTime($this->TGLTAT->ViewValue, 0);
        $this->TGLTAT->ViewCustomAttributes = "";

        // TGLTMT
        $this->TGLTMT->ViewValue = $this->TGLTMT->CurrentValue;
        $this->TGLTMT->ViewValue = FormatDateTime($this->TGLTMT->ViewValue, 0);
        $this->TGLTMT->ViewCustomAttributes = "";

        // UMURSAATPELAYANAN
        $this->UMURSAATPELAYANAN->ViewValue = $this->UMURSAATPELAYANAN->CurrentValue;
        $this->UMURSAATPELAYANAN->ViewCustomAttributes = "";

        // UMURSEKARANG
        $this->UMURSEKARANG->ViewValue = $this->UMURSEKARANG->CurrentValue;
        $this->UMURSEKARANG->ViewCustomAttributes = "";

        // REST_CODE
        $this->REST_CODE->ViewValue = $this->REST_CODE->CurrentValue;
        $this->REST_CODE->ViewCustomAttributes = "";

        // REST_MESSAGE
        $this->REST_MESSAGE->ViewValue = $this->REST_MESSAGE->CurrentValue;
        $this->REST_MESSAGE->ViewCustomAttributes = "";

        // REST_DATE
        $this->REST_DATE->ViewValue = $this->REST_DATE->CurrentValue;
        $this->REST_DATE->ViewValue = FormatDateTime($this->REST_DATE->ViewValue, 0);
        $this->REST_DATE->ViewCustomAttributes = "";

        // REST_METHOD
        $this->REST_METHOD->ViewValue = $this->REST_METHOD->CurrentValue;
        $this->REST_METHOD->ViewCustomAttributes = "";

        // RESPON
        $this->RESPON->ViewValue = $this->RESPON->CurrentValue;
        $this->RESPON->ViewCustomAttributes = "";

        // COB_NMASURANSI
        $this->COB_NMASURANSI->ViewValue = $this->COB_NMASURANSI->CurrentValue;
        $this->COB_NMASURANSI->ViewCustomAttributes = "";

        // COB_NOASURANSI
        $this->COB_NOASURANSI->ViewValue = $this->COB_NOASURANSI->CurrentValue;
        $this->COB_NOASURANSI->ViewCustomAttributes = "";

        // COB_TGL_TAT
        $this->COB_TGL_TAT->ViewValue = $this->COB_TGL_TAT->CurrentValue;
        $this->COB_TGL_TAT->ViewValue = FormatDateTime($this->COB_TGL_TAT->ViewValue, 0);
        $this->COB_TGL_TAT->ViewCustomAttributes = "";

        // COB_TGL_TMT
        $this->COB_TGL_TMT->ViewValue = $this->COB_TGL_TMT->CurrentValue;
        $this->COB_TGL_TMT->ViewValue = FormatDateTime($this->COB_TGL_TMT->ViewValue, 0);
        $this->COB_TGL_TMT->ViewCustomAttributes = "";

        // NOTELEPON
        $this->NOTELEPON->ViewValue = $this->NOTELEPON->CurrentValue;
        $this->NOTELEPON->ViewCustomAttributes = "";

        // INFO_NOSKTM
        $this->INFO_NOSKTM->ViewValue = $this->INFO_NOSKTM->CurrentValue;
        $this->INFO_NOSKTM->ViewCustomAttributes = "";

        // NOKARTU
        $this->NOKARTU->LinkCustomAttributes = "";
        $this->NOKARTU->HrefValue = "";
        $this->NOKARTU->TooltipValue = "";

        // INFO_DINSOS
        $this->INFO_DINSOS->LinkCustomAttributes = "";
        $this->INFO_DINSOS->HrefValue = "";
        $this->INFO_DINSOS->TooltipValue = "";

        // INFO_IURAN
        $this->INFO_IURAN->LinkCustomAttributes = "";
        $this->INFO_IURAN->HrefValue = "";
        $this->INFO_IURAN->TooltipValue = "";

        // INFO_PROLANISPRB
        $this->INFO_PROLANISPRB->LinkCustomAttributes = "";
        $this->INFO_PROLANISPRB->HrefValue = "";
        $this->INFO_PROLANISPRB->TooltipValue = "";

        // KDJNSPESERTA
        $this->KDJNSPESERTA->LinkCustomAttributes = "";
        $this->KDJNSPESERTA->HrefValue = "";
        $this->KDJNSPESERTA->TooltipValue = "";

        // NMJNSPESERTA
        $this->NMJNSPESERTA->LinkCustomAttributes = "";
        $this->NMJNSPESERTA->HrefValue = "";
        $this->NMJNSPESERTA->TooltipValue = "";

        // KDKLSTANGGUNGAN
        $this->KDKLSTANGGUNGAN->LinkCustomAttributes = "";
        $this->KDKLSTANGGUNGAN->HrefValue = "";
        $this->KDKLSTANGGUNGAN->TooltipValue = "";

        // NMKLSTANGGUNGAN
        $this->NMKLSTANGGUNGAN->LinkCustomAttributes = "";
        $this->NMKLSTANGGUNGAN->HrefValue = "";
        $this->NMKLSTANGGUNGAN->TooltipValue = "";

        // NAMA
        $this->NAMA->LinkCustomAttributes = "";
        $this->NAMA->HrefValue = "";
        $this->NAMA->TooltipValue = "";

        // NIK
        $this->NIK->LinkCustomAttributes = "";
        $this->NIK->HrefValue = "";
        $this->NIK->TooltipValue = "";

        // NOMR
        $this->NOMR->LinkCustomAttributes = "";
        $this->NOMR->HrefValue = "";
        $this->NOMR->TooltipValue = "";

        // PISA
        $this->PISA->LinkCustomAttributes = "";
        $this->PISA->HrefValue = "";
        $this->PISA->TooltipValue = "";

        // PROVUMUM_KDCABANG
        $this->PROVUMUM_KDCABANG->LinkCustomAttributes = "";
        $this->PROVUMUM_KDCABANG->HrefValue = "";
        $this->PROVUMUM_KDCABANG->TooltipValue = "";

        // PROVUMUM_KDPROVIDER
        $this->PROVUMUM_KDPROVIDER->LinkCustomAttributes = "";
        $this->PROVUMUM_KDPROVIDER->HrefValue = "";
        $this->PROVUMUM_KDPROVIDER->TooltipValue = "";

        // PROVUMUM_NMCABANG
        $this->PROVUMUM_NMCABANG->LinkCustomAttributes = "";
        $this->PROVUMUM_NMCABANG->HrefValue = "";
        $this->PROVUMUM_NMCABANG->TooltipValue = "";

        // PROVUMUM_NMPROVIDER
        $this->PROVUMUM_NMPROVIDER->LinkCustomAttributes = "";
        $this->PROVUMUM_NMPROVIDER->HrefValue = "";
        $this->PROVUMUM_NMPROVIDER->TooltipValue = "";

        // SEX
        $this->SEX->LinkCustomAttributes = "";
        $this->SEX->HrefValue = "";
        $this->SEX->TooltipValue = "";

        // STATUS_PESERTA
        $this->STATUS_PESERTA->LinkCustomAttributes = "";
        $this->STATUS_PESERTA->HrefValue = "";
        $this->STATUS_PESERTA->TooltipValue = "";

        // STATUS_PESERTA_KODE
        $this->STATUS_PESERTA_KODE->LinkCustomAttributes = "";
        $this->STATUS_PESERTA_KODE->HrefValue = "";
        $this->STATUS_PESERTA_KODE->TooltipValue = "";

        // TGLCETAKKARTU
        $this->TGLCETAKKARTU->LinkCustomAttributes = "";
        $this->TGLCETAKKARTU->HrefValue = "";
        $this->TGLCETAKKARTU->TooltipValue = "";

        // TGLLAHIR
        $this->TGLLAHIR->LinkCustomAttributes = "";
        $this->TGLLAHIR->HrefValue = "";
        $this->TGLLAHIR->TooltipValue = "";

        // TGLTAT
        $this->TGLTAT->LinkCustomAttributes = "";
        $this->TGLTAT->HrefValue = "";
        $this->TGLTAT->TooltipValue = "";

        // TGLTMT
        $this->TGLTMT->LinkCustomAttributes = "";
        $this->TGLTMT->HrefValue = "";
        $this->TGLTMT->TooltipValue = "";

        // UMURSAATPELAYANAN
        $this->UMURSAATPELAYANAN->LinkCustomAttributes = "";
        $this->UMURSAATPELAYANAN->HrefValue = "";
        $this->UMURSAATPELAYANAN->TooltipValue = "";

        // UMURSEKARANG
        $this->UMURSEKARANG->LinkCustomAttributes = "";
        $this->UMURSEKARANG->HrefValue = "";
        $this->UMURSEKARANG->TooltipValue = "";

        // REST_CODE
        $this->REST_CODE->LinkCustomAttributes = "";
        $this->REST_CODE->HrefValue = "";
        $this->REST_CODE->TooltipValue = "";

        // REST_MESSAGE
        $this->REST_MESSAGE->LinkCustomAttributes = "";
        $this->REST_MESSAGE->HrefValue = "";
        $this->REST_MESSAGE->TooltipValue = "";

        // REST_DATE
        $this->REST_DATE->LinkCustomAttributes = "";
        $this->REST_DATE->HrefValue = "";
        $this->REST_DATE->TooltipValue = "";

        // REST_METHOD
        $this->REST_METHOD->LinkCustomAttributes = "";
        $this->REST_METHOD->HrefValue = "";
        $this->REST_METHOD->TooltipValue = "";

        // RESPON
        $this->RESPON->LinkCustomAttributes = "";
        $this->RESPON->HrefValue = "";
        $this->RESPON->TooltipValue = "";

        // COB_NMASURANSI
        $this->COB_NMASURANSI->LinkCustomAttributes = "";
        $this->COB_NMASURANSI->HrefValue = "";
        $this->COB_NMASURANSI->TooltipValue = "";

        // COB_NOASURANSI
        $this->COB_NOASURANSI->LinkCustomAttributes = "";
        $this->COB_NOASURANSI->HrefValue = "";
        $this->COB_NOASURANSI->TooltipValue = "";

        // COB_TGL_TAT
        $this->COB_TGL_TAT->LinkCustomAttributes = "";
        $this->COB_TGL_TAT->HrefValue = "";
        $this->COB_TGL_TAT->TooltipValue = "";

        // COB_TGL_TMT
        $this->COB_TGL_TMT->LinkCustomAttributes = "";
        $this->COB_TGL_TMT->HrefValue = "";
        $this->COB_TGL_TMT->TooltipValue = "";

        // NOTELEPON
        $this->NOTELEPON->LinkCustomAttributes = "";
        $this->NOTELEPON->HrefValue = "";
        $this->NOTELEPON->TooltipValue = "";

        // INFO_NOSKTM
        $this->INFO_NOSKTM->LinkCustomAttributes = "";
        $this->INFO_NOSKTM->HrefValue = "";
        $this->INFO_NOSKTM->TooltipValue = "";

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

        // NOKARTU
        $this->NOKARTU->EditAttrs["class"] = "form-control";
        $this->NOKARTU->EditCustomAttributes = "";
        if (!$this->NOKARTU->Raw) {
            $this->NOKARTU->CurrentValue = HtmlDecode($this->NOKARTU->CurrentValue);
        }
        $this->NOKARTU->EditValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->PlaceHolder = RemoveHtml($this->NOKARTU->caption());

        // INFO_DINSOS
        $this->INFO_DINSOS->EditAttrs["class"] = "form-control";
        $this->INFO_DINSOS->EditCustomAttributes = "";
        if (!$this->INFO_DINSOS->Raw) {
            $this->INFO_DINSOS->CurrentValue = HtmlDecode($this->INFO_DINSOS->CurrentValue);
        }
        $this->INFO_DINSOS->EditValue = $this->INFO_DINSOS->CurrentValue;
        $this->INFO_DINSOS->PlaceHolder = RemoveHtml($this->INFO_DINSOS->caption());

        // INFO_IURAN
        $this->INFO_IURAN->EditAttrs["class"] = "form-control";
        $this->INFO_IURAN->EditCustomAttributes = "";
        if (!$this->INFO_IURAN->Raw) {
            $this->INFO_IURAN->CurrentValue = HtmlDecode($this->INFO_IURAN->CurrentValue);
        }
        $this->INFO_IURAN->EditValue = $this->INFO_IURAN->CurrentValue;
        $this->INFO_IURAN->PlaceHolder = RemoveHtml($this->INFO_IURAN->caption());

        // INFO_PROLANISPRB
        $this->INFO_PROLANISPRB->EditAttrs["class"] = "form-control";
        $this->INFO_PROLANISPRB->EditCustomAttributes = "";
        if (!$this->INFO_PROLANISPRB->Raw) {
            $this->INFO_PROLANISPRB->CurrentValue = HtmlDecode($this->INFO_PROLANISPRB->CurrentValue);
        }
        $this->INFO_PROLANISPRB->EditValue = $this->INFO_PROLANISPRB->CurrentValue;
        $this->INFO_PROLANISPRB->PlaceHolder = RemoveHtml($this->INFO_PROLANISPRB->caption());

        // KDJNSPESERTA
        $this->KDJNSPESERTA->EditAttrs["class"] = "form-control";
        $this->KDJNSPESERTA->EditCustomAttributes = "";
        if (!$this->KDJNSPESERTA->Raw) {
            $this->KDJNSPESERTA->CurrentValue = HtmlDecode($this->KDJNSPESERTA->CurrentValue);
        }
        $this->KDJNSPESERTA->EditValue = $this->KDJNSPESERTA->CurrentValue;
        $this->KDJNSPESERTA->PlaceHolder = RemoveHtml($this->KDJNSPESERTA->caption());

        // NMJNSPESERTA
        $this->NMJNSPESERTA->EditAttrs["class"] = "form-control";
        $this->NMJNSPESERTA->EditCustomAttributes = "";
        if (!$this->NMJNSPESERTA->Raw) {
            $this->NMJNSPESERTA->CurrentValue = HtmlDecode($this->NMJNSPESERTA->CurrentValue);
        }
        $this->NMJNSPESERTA->EditValue = $this->NMJNSPESERTA->CurrentValue;
        $this->NMJNSPESERTA->PlaceHolder = RemoveHtml($this->NMJNSPESERTA->caption());

        // KDKLSTANGGUNGAN
        $this->KDKLSTANGGUNGAN->EditAttrs["class"] = "form-control";
        $this->KDKLSTANGGUNGAN->EditCustomAttributes = "";
        if (!$this->KDKLSTANGGUNGAN->Raw) {
            $this->KDKLSTANGGUNGAN->CurrentValue = HtmlDecode($this->KDKLSTANGGUNGAN->CurrentValue);
        }
        $this->KDKLSTANGGUNGAN->EditValue = $this->KDKLSTANGGUNGAN->CurrentValue;
        $this->KDKLSTANGGUNGAN->PlaceHolder = RemoveHtml($this->KDKLSTANGGUNGAN->caption());

        // NMKLSTANGGUNGAN
        $this->NMKLSTANGGUNGAN->EditAttrs["class"] = "form-control";
        $this->NMKLSTANGGUNGAN->EditCustomAttributes = "";
        if (!$this->NMKLSTANGGUNGAN->Raw) {
            $this->NMKLSTANGGUNGAN->CurrentValue = HtmlDecode($this->NMKLSTANGGUNGAN->CurrentValue);
        }
        $this->NMKLSTANGGUNGAN->EditValue = $this->NMKLSTANGGUNGAN->CurrentValue;
        $this->NMKLSTANGGUNGAN->PlaceHolder = RemoveHtml($this->NMKLSTANGGUNGAN->caption());

        // NAMA
        $this->NAMA->EditAttrs["class"] = "form-control";
        $this->NAMA->EditCustomAttributes = "";
        if (!$this->NAMA->Raw) {
            $this->NAMA->CurrentValue = HtmlDecode($this->NAMA->CurrentValue);
        }
        $this->NAMA->EditValue = $this->NAMA->CurrentValue;
        $this->NAMA->PlaceHolder = RemoveHtml($this->NAMA->caption());

        // NIK
        $this->NIK->EditAttrs["class"] = "form-control";
        $this->NIK->EditCustomAttributes = "";
        if (!$this->NIK->Raw) {
            $this->NIK->CurrentValue = HtmlDecode($this->NIK->CurrentValue);
        }
        $this->NIK->EditValue = $this->NIK->CurrentValue;
        $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

        // NOMR
        $this->NOMR->EditAttrs["class"] = "form-control";
        $this->NOMR->EditCustomAttributes = "";
        if (!$this->NOMR->Raw) {
            $this->NOMR->CurrentValue = HtmlDecode($this->NOMR->CurrentValue);
        }
        $this->NOMR->EditValue = $this->NOMR->CurrentValue;
        $this->NOMR->PlaceHolder = RemoveHtml($this->NOMR->caption());

        // PISA
        $this->PISA->EditAttrs["class"] = "form-control";
        $this->PISA->EditCustomAttributes = "";
        if (!$this->PISA->Raw) {
            $this->PISA->CurrentValue = HtmlDecode($this->PISA->CurrentValue);
        }
        $this->PISA->EditValue = $this->PISA->CurrentValue;
        $this->PISA->PlaceHolder = RemoveHtml($this->PISA->caption());

        // PROVUMUM_KDCABANG
        $this->PROVUMUM_KDCABANG->EditAttrs["class"] = "form-control";
        $this->PROVUMUM_KDCABANG->EditCustomAttributes = "";
        if (!$this->PROVUMUM_KDCABANG->Raw) {
            $this->PROVUMUM_KDCABANG->CurrentValue = HtmlDecode($this->PROVUMUM_KDCABANG->CurrentValue);
        }
        $this->PROVUMUM_KDCABANG->EditValue = $this->PROVUMUM_KDCABANG->CurrentValue;
        $this->PROVUMUM_KDCABANG->PlaceHolder = RemoveHtml($this->PROVUMUM_KDCABANG->caption());

        // PROVUMUM_KDPROVIDER
        $this->PROVUMUM_KDPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVUMUM_KDPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVUMUM_KDPROVIDER->Raw) {
            $this->PROVUMUM_KDPROVIDER->CurrentValue = HtmlDecode($this->PROVUMUM_KDPROVIDER->CurrentValue);
        }
        $this->PROVUMUM_KDPROVIDER->EditValue = $this->PROVUMUM_KDPROVIDER->CurrentValue;
        $this->PROVUMUM_KDPROVIDER->PlaceHolder = RemoveHtml($this->PROVUMUM_KDPROVIDER->caption());

        // PROVUMUM_NMCABANG
        $this->PROVUMUM_NMCABANG->EditAttrs["class"] = "form-control";
        $this->PROVUMUM_NMCABANG->EditCustomAttributes = "";
        if (!$this->PROVUMUM_NMCABANG->Raw) {
            $this->PROVUMUM_NMCABANG->CurrentValue = HtmlDecode($this->PROVUMUM_NMCABANG->CurrentValue);
        }
        $this->PROVUMUM_NMCABANG->EditValue = $this->PROVUMUM_NMCABANG->CurrentValue;
        $this->PROVUMUM_NMCABANG->PlaceHolder = RemoveHtml($this->PROVUMUM_NMCABANG->caption());

        // PROVUMUM_NMPROVIDER
        $this->PROVUMUM_NMPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVUMUM_NMPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVUMUM_NMPROVIDER->Raw) {
            $this->PROVUMUM_NMPROVIDER->CurrentValue = HtmlDecode($this->PROVUMUM_NMPROVIDER->CurrentValue);
        }
        $this->PROVUMUM_NMPROVIDER->EditValue = $this->PROVUMUM_NMPROVIDER->CurrentValue;
        $this->PROVUMUM_NMPROVIDER->PlaceHolder = RemoveHtml($this->PROVUMUM_NMPROVIDER->caption());

        // SEX
        $this->SEX->EditAttrs["class"] = "form-control";
        $this->SEX->EditCustomAttributes = "";
        if (!$this->SEX->Raw) {
            $this->SEX->CurrentValue = HtmlDecode($this->SEX->CurrentValue);
        }
        $this->SEX->EditValue = $this->SEX->CurrentValue;
        $this->SEX->PlaceHolder = RemoveHtml($this->SEX->caption());

        // STATUS_PESERTA
        $this->STATUS_PESERTA->EditAttrs["class"] = "form-control";
        $this->STATUS_PESERTA->EditCustomAttributes = "";
        if (!$this->STATUS_PESERTA->Raw) {
            $this->STATUS_PESERTA->CurrentValue = HtmlDecode($this->STATUS_PESERTA->CurrentValue);
        }
        $this->STATUS_PESERTA->EditValue = $this->STATUS_PESERTA->CurrentValue;
        $this->STATUS_PESERTA->PlaceHolder = RemoveHtml($this->STATUS_PESERTA->caption());

        // STATUS_PESERTA_KODE
        $this->STATUS_PESERTA_KODE->EditAttrs["class"] = "form-control";
        $this->STATUS_PESERTA_KODE->EditCustomAttributes = "";
        if (!$this->STATUS_PESERTA_KODE->Raw) {
            $this->STATUS_PESERTA_KODE->CurrentValue = HtmlDecode($this->STATUS_PESERTA_KODE->CurrentValue);
        }
        $this->STATUS_PESERTA_KODE->EditValue = $this->STATUS_PESERTA_KODE->CurrentValue;
        $this->STATUS_PESERTA_KODE->PlaceHolder = RemoveHtml($this->STATUS_PESERTA_KODE->caption());

        // TGLCETAKKARTU
        $this->TGLCETAKKARTU->EditAttrs["class"] = "form-control";
        $this->TGLCETAKKARTU->EditCustomAttributes = "";
        $this->TGLCETAKKARTU->EditValue = FormatDateTime($this->TGLCETAKKARTU->CurrentValue, 8);
        $this->TGLCETAKKARTU->PlaceHolder = RemoveHtml($this->TGLCETAKKARTU->caption());

        // TGLLAHIR
        $this->TGLLAHIR->EditAttrs["class"] = "form-control";
        $this->TGLLAHIR->EditCustomAttributes = "";
        $this->TGLLAHIR->EditValue = FormatDateTime($this->TGLLAHIR->CurrentValue, 8);
        $this->TGLLAHIR->PlaceHolder = RemoveHtml($this->TGLLAHIR->caption());

        // TGLTAT
        $this->TGLTAT->EditAttrs["class"] = "form-control";
        $this->TGLTAT->EditCustomAttributes = "";
        $this->TGLTAT->EditValue = FormatDateTime($this->TGLTAT->CurrentValue, 8);
        $this->TGLTAT->PlaceHolder = RemoveHtml($this->TGLTAT->caption());

        // TGLTMT
        $this->TGLTMT->EditAttrs["class"] = "form-control";
        $this->TGLTMT->EditCustomAttributes = "";
        $this->TGLTMT->EditValue = FormatDateTime($this->TGLTMT->CurrentValue, 8);
        $this->TGLTMT->PlaceHolder = RemoveHtml($this->TGLTMT->caption());

        // UMURSAATPELAYANAN
        $this->UMURSAATPELAYANAN->EditAttrs["class"] = "form-control";
        $this->UMURSAATPELAYANAN->EditCustomAttributes = "";
        if (!$this->UMURSAATPELAYANAN->Raw) {
            $this->UMURSAATPELAYANAN->CurrentValue = HtmlDecode($this->UMURSAATPELAYANAN->CurrentValue);
        }
        $this->UMURSAATPELAYANAN->EditValue = $this->UMURSAATPELAYANAN->CurrentValue;
        $this->UMURSAATPELAYANAN->PlaceHolder = RemoveHtml($this->UMURSAATPELAYANAN->caption());

        // UMURSEKARANG
        $this->UMURSEKARANG->EditAttrs["class"] = "form-control";
        $this->UMURSEKARANG->EditCustomAttributes = "";
        if (!$this->UMURSEKARANG->Raw) {
            $this->UMURSEKARANG->CurrentValue = HtmlDecode($this->UMURSEKARANG->CurrentValue);
        }
        $this->UMURSEKARANG->EditValue = $this->UMURSEKARANG->CurrentValue;
        $this->UMURSEKARANG->PlaceHolder = RemoveHtml($this->UMURSEKARANG->caption());

        // REST_CODE
        $this->REST_CODE->EditAttrs["class"] = "form-control";
        $this->REST_CODE->EditCustomAttributes = "";
        if (!$this->REST_CODE->Raw) {
            $this->REST_CODE->CurrentValue = HtmlDecode($this->REST_CODE->CurrentValue);
        }
        $this->REST_CODE->EditValue = $this->REST_CODE->CurrentValue;
        $this->REST_CODE->PlaceHolder = RemoveHtml($this->REST_CODE->caption());

        // REST_MESSAGE
        $this->REST_MESSAGE->EditAttrs["class"] = "form-control";
        $this->REST_MESSAGE->EditCustomAttributes = "";
        if (!$this->REST_MESSAGE->Raw) {
            $this->REST_MESSAGE->CurrentValue = HtmlDecode($this->REST_MESSAGE->CurrentValue);
        }
        $this->REST_MESSAGE->EditValue = $this->REST_MESSAGE->CurrentValue;
        $this->REST_MESSAGE->PlaceHolder = RemoveHtml($this->REST_MESSAGE->caption());

        // REST_DATE
        $this->REST_DATE->EditAttrs["class"] = "form-control";
        $this->REST_DATE->EditCustomAttributes = "";
        $this->REST_DATE->EditValue = FormatDateTime($this->REST_DATE->CurrentValue, 8);
        $this->REST_DATE->PlaceHolder = RemoveHtml($this->REST_DATE->caption());

        // REST_METHOD
        $this->REST_METHOD->EditAttrs["class"] = "form-control";
        $this->REST_METHOD->EditCustomAttributes = "";
        if (!$this->REST_METHOD->Raw) {
            $this->REST_METHOD->CurrentValue = HtmlDecode($this->REST_METHOD->CurrentValue);
        }
        $this->REST_METHOD->EditValue = $this->REST_METHOD->CurrentValue;
        $this->REST_METHOD->PlaceHolder = RemoveHtml($this->REST_METHOD->caption());

        // RESPON
        $this->RESPON->EditAttrs["class"] = "form-control";
        $this->RESPON->EditCustomAttributes = "";
        $this->RESPON->EditValue = $this->RESPON->CurrentValue;
        $this->RESPON->PlaceHolder = RemoveHtml($this->RESPON->caption());

        // COB_NMASURANSI
        $this->COB_NMASURANSI->EditAttrs["class"] = "form-control";
        $this->COB_NMASURANSI->EditCustomAttributes = "";
        if (!$this->COB_NMASURANSI->Raw) {
            $this->COB_NMASURANSI->CurrentValue = HtmlDecode($this->COB_NMASURANSI->CurrentValue);
        }
        $this->COB_NMASURANSI->EditValue = $this->COB_NMASURANSI->CurrentValue;
        $this->COB_NMASURANSI->PlaceHolder = RemoveHtml($this->COB_NMASURANSI->caption());

        // COB_NOASURANSI
        $this->COB_NOASURANSI->EditAttrs["class"] = "form-control";
        $this->COB_NOASURANSI->EditCustomAttributes = "";
        if (!$this->COB_NOASURANSI->Raw) {
            $this->COB_NOASURANSI->CurrentValue = HtmlDecode($this->COB_NOASURANSI->CurrentValue);
        }
        $this->COB_NOASURANSI->EditValue = $this->COB_NOASURANSI->CurrentValue;
        $this->COB_NOASURANSI->PlaceHolder = RemoveHtml($this->COB_NOASURANSI->caption());

        // COB_TGL_TAT
        $this->COB_TGL_TAT->EditAttrs["class"] = "form-control";
        $this->COB_TGL_TAT->EditCustomAttributes = "";
        $this->COB_TGL_TAT->EditValue = FormatDateTime($this->COB_TGL_TAT->CurrentValue, 8);
        $this->COB_TGL_TAT->PlaceHolder = RemoveHtml($this->COB_TGL_TAT->caption());

        // COB_TGL_TMT
        $this->COB_TGL_TMT->EditAttrs["class"] = "form-control";
        $this->COB_TGL_TMT->EditCustomAttributes = "";
        $this->COB_TGL_TMT->EditValue = FormatDateTime($this->COB_TGL_TMT->CurrentValue, 8);
        $this->COB_TGL_TMT->PlaceHolder = RemoveHtml($this->COB_TGL_TMT->caption());

        // NOTELEPON
        $this->NOTELEPON->EditAttrs["class"] = "form-control";
        $this->NOTELEPON->EditCustomAttributes = "";
        if (!$this->NOTELEPON->Raw) {
            $this->NOTELEPON->CurrentValue = HtmlDecode($this->NOTELEPON->CurrentValue);
        }
        $this->NOTELEPON->EditValue = $this->NOTELEPON->CurrentValue;
        $this->NOTELEPON->PlaceHolder = RemoveHtml($this->NOTELEPON->caption());

        // INFO_NOSKTM
        $this->INFO_NOSKTM->EditAttrs["class"] = "form-control";
        $this->INFO_NOSKTM->EditCustomAttributes = "";
        if (!$this->INFO_NOSKTM->Raw) {
            $this->INFO_NOSKTM->CurrentValue = HtmlDecode($this->INFO_NOSKTM->CurrentValue);
        }
        $this->INFO_NOSKTM->EditValue = $this->INFO_NOSKTM->CurrentValue;
        $this->INFO_NOSKTM->PlaceHolder = RemoveHtml($this->INFO_NOSKTM->caption());

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
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->INFO_DINSOS);
                    $doc->exportCaption($this->INFO_IURAN);
                    $doc->exportCaption($this->INFO_PROLANISPRB);
                    $doc->exportCaption($this->KDJNSPESERTA);
                    $doc->exportCaption($this->NMJNSPESERTA);
                    $doc->exportCaption($this->KDKLSTANGGUNGAN);
                    $doc->exportCaption($this->NMKLSTANGGUNGAN);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->NOMR);
                    $doc->exportCaption($this->PISA);
                    $doc->exportCaption($this->PROVUMUM_KDCABANG);
                    $doc->exportCaption($this->PROVUMUM_KDPROVIDER);
                    $doc->exportCaption($this->PROVUMUM_NMCABANG);
                    $doc->exportCaption($this->PROVUMUM_NMPROVIDER);
                    $doc->exportCaption($this->SEX);
                    $doc->exportCaption($this->STATUS_PESERTA);
                    $doc->exportCaption($this->STATUS_PESERTA_KODE);
                    $doc->exportCaption($this->TGLCETAKKARTU);
                    $doc->exportCaption($this->TGLLAHIR);
                    $doc->exportCaption($this->TGLTAT);
                    $doc->exportCaption($this->TGLTMT);
                    $doc->exportCaption($this->UMURSAATPELAYANAN);
                    $doc->exportCaption($this->UMURSEKARANG);
                    $doc->exportCaption($this->REST_CODE);
                    $doc->exportCaption($this->REST_MESSAGE);
                    $doc->exportCaption($this->REST_DATE);
                    $doc->exportCaption($this->REST_METHOD);
                    $doc->exportCaption($this->RESPON);
                    $doc->exportCaption($this->COB_NMASURANSI);
                    $doc->exportCaption($this->COB_NOASURANSI);
                    $doc->exportCaption($this->COB_TGL_TAT);
                    $doc->exportCaption($this->COB_TGL_TMT);
                    $doc->exportCaption($this->NOTELEPON);
                    $doc->exportCaption($this->INFO_NOSKTM);
                } else {
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->INFO_DINSOS);
                    $doc->exportCaption($this->INFO_IURAN);
                    $doc->exportCaption($this->INFO_PROLANISPRB);
                    $doc->exportCaption($this->KDJNSPESERTA);
                    $doc->exportCaption($this->NMJNSPESERTA);
                    $doc->exportCaption($this->KDKLSTANGGUNGAN);
                    $doc->exportCaption($this->NMKLSTANGGUNGAN);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->NOMR);
                    $doc->exportCaption($this->PISA);
                    $doc->exportCaption($this->PROVUMUM_KDCABANG);
                    $doc->exportCaption($this->PROVUMUM_KDPROVIDER);
                    $doc->exportCaption($this->PROVUMUM_NMCABANG);
                    $doc->exportCaption($this->PROVUMUM_NMPROVIDER);
                    $doc->exportCaption($this->SEX);
                    $doc->exportCaption($this->STATUS_PESERTA);
                    $doc->exportCaption($this->STATUS_PESERTA_KODE);
                    $doc->exportCaption($this->TGLCETAKKARTU);
                    $doc->exportCaption($this->TGLLAHIR);
                    $doc->exportCaption($this->TGLTAT);
                    $doc->exportCaption($this->TGLTMT);
                    $doc->exportCaption($this->UMURSAATPELAYANAN);
                    $doc->exportCaption($this->UMURSEKARANG);
                    $doc->exportCaption($this->REST_CODE);
                    $doc->exportCaption($this->REST_MESSAGE);
                    $doc->exportCaption($this->REST_DATE);
                    $doc->exportCaption($this->REST_METHOD);
                    $doc->exportCaption($this->COB_NMASURANSI);
                    $doc->exportCaption($this->COB_NOASURANSI);
                    $doc->exportCaption($this->COB_TGL_TAT);
                    $doc->exportCaption($this->COB_TGL_TMT);
                    $doc->exportCaption($this->NOTELEPON);
                    $doc->exportCaption($this->INFO_NOSKTM);
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
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->INFO_DINSOS);
                        $doc->exportField($this->INFO_IURAN);
                        $doc->exportField($this->INFO_PROLANISPRB);
                        $doc->exportField($this->KDJNSPESERTA);
                        $doc->exportField($this->NMJNSPESERTA);
                        $doc->exportField($this->KDKLSTANGGUNGAN);
                        $doc->exportField($this->NMKLSTANGGUNGAN);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->NOMR);
                        $doc->exportField($this->PISA);
                        $doc->exportField($this->PROVUMUM_KDCABANG);
                        $doc->exportField($this->PROVUMUM_KDPROVIDER);
                        $doc->exportField($this->PROVUMUM_NMCABANG);
                        $doc->exportField($this->PROVUMUM_NMPROVIDER);
                        $doc->exportField($this->SEX);
                        $doc->exportField($this->STATUS_PESERTA);
                        $doc->exportField($this->STATUS_PESERTA_KODE);
                        $doc->exportField($this->TGLCETAKKARTU);
                        $doc->exportField($this->TGLLAHIR);
                        $doc->exportField($this->TGLTAT);
                        $doc->exportField($this->TGLTMT);
                        $doc->exportField($this->UMURSAATPELAYANAN);
                        $doc->exportField($this->UMURSEKARANG);
                        $doc->exportField($this->REST_CODE);
                        $doc->exportField($this->REST_MESSAGE);
                        $doc->exportField($this->REST_DATE);
                        $doc->exportField($this->REST_METHOD);
                        $doc->exportField($this->RESPON);
                        $doc->exportField($this->COB_NMASURANSI);
                        $doc->exportField($this->COB_NOASURANSI);
                        $doc->exportField($this->COB_TGL_TAT);
                        $doc->exportField($this->COB_TGL_TMT);
                        $doc->exportField($this->NOTELEPON);
                        $doc->exportField($this->INFO_NOSKTM);
                    } else {
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->INFO_DINSOS);
                        $doc->exportField($this->INFO_IURAN);
                        $doc->exportField($this->INFO_PROLANISPRB);
                        $doc->exportField($this->KDJNSPESERTA);
                        $doc->exportField($this->NMJNSPESERTA);
                        $doc->exportField($this->KDKLSTANGGUNGAN);
                        $doc->exportField($this->NMKLSTANGGUNGAN);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->NOMR);
                        $doc->exportField($this->PISA);
                        $doc->exportField($this->PROVUMUM_KDCABANG);
                        $doc->exportField($this->PROVUMUM_KDPROVIDER);
                        $doc->exportField($this->PROVUMUM_NMCABANG);
                        $doc->exportField($this->PROVUMUM_NMPROVIDER);
                        $doc->exportField($this->SEX);
                        $doc->exportField($this->STATUS_PESERTA);
                        $doc->exportField($this->STATUS_PESERTA_KODE);
                        $doc->exportField($this->TGLCETAKKARTU);
                        $doc->exportField($this->TGLLAHIR);
                        $doc->exportField($this->TGLTAT);
                        $doc->exportField($this->TGLTMT);
                        $doc->exportField($this->UMURSAATPELAYANAN);
                        $doc->exportField($this->UMURSEKARANG);
                        $doc->exportField($this->REST_CODE);
                        $doc->exportField($this->REST_MESSAGE);
                        $doc->exportField($this->REST_DATE);
                        $doc->exportField($this->REST_METHOD);
                        $doc->exportField($this->COB_NMASURANSI);
                        $doc->exportField($this->COB_NOASURANSI);
                        $doc->exportField($this->COB_TGL_TAT);
                        $doc->exportField($this->COB_TGL_TMT);
                        $doc->exportField($this->NOTELEPON);
                        $doc->exportField($this->INFO_NOSKTM);
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
