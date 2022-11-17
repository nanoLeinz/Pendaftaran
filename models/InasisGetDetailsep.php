<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for INASIS_GET_DETAILSEP
 */
class InasisGetDetailsep extends DbTable
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
    public $NOSEP;
    public $BYTAGIHAN;
    public $CATATAN;
    public $KDDIAG;
    public $NMDIAG;
    public $JNSPELAYANAN;
    public $KLSRAWAT_KDKELAS;
    public $KLSRAWAT_NMKELAS;
    public $LAKALANTAS_KET;
    public $LAKALANTAS_STATUS;
    public $NORUJUKAN;
    public $KDJNSPESERTA;
    public $NMJNSPESERTA;
    public $KLSTANGGUNGAN_KDKELAS;
    public $KLSTANGGUNGAN_NMKELAS;
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
    public $TGLCETAKKARTU;
    public $TGLLAHIR;
    public $TGLTAT;
    public $TGLTMT;
    public $UMUR;
    public $POLITUJUAN_KDPOLI;
    public $POLITUJUAN_NMPOLI;
    public $PROVPELAYANAN_KDCABANG;
    public $PROVPELAYANAN_KDPROVIDER;
    public $PROVPELAYANAN_NMCABANG;
    public $PROVPELAYANAN_NMPROVIDER;
    public $PROVRUJUKAN_KDCABANG;
    public $PROVRUJUKAN_KDPROVIDER;
    public $PROVRUJUKAN_NMCABANG;
    public $PROVRUJUKAN_NMPROVIDER;
    public $KDSTATSEP;
    public $NMSTATSEP;
    public $KDCOB;
    public $NMCOB;
    public $TGLPULANG;
    public $TGLRUJUKAN;
    public $TGLSEP;
    public $REST_CODE;
    public $REST_MESSAGE;
    public $REST_DATE;
    public $REST_METHOD;
    public $RESPONDETAILSEP;
    public $DINSOS;
    public $PROLANISPRB;
    public $NOSKTM;
    public $SEXNAME;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'INASIS_GET_DETAILSEP';
        $this->TableName = 'INASIS_GET_DETAILSEP';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[INASIS_GET_DETAILSEP]";
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
        $this->NOKARTU = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NOKARTU', 'NOKARTU', '[NOKARTU]', '[NOKARTU]', 200, 50, -1, false, '[NOKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOKARTU->IsPrimaryKey = true; // Primary key field
        $this->NOKARTU->Nullable = false; // NOT NULL field
        $this->NOKARTU->Required = true; // Required field
        $this->NOKARTU->Sortable = true; // Allow sort
        $this->NOKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOKARTU->Param, "CustomMsg");
        $this->Fields['NOKARTU'] = &$this->NOKARTU;

        // NOSEP
        $this->NOSEP = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NOSEP', 'NOSEP', '[NOSEP]', '[NOSEP]', 200, 50, -1, false, '[NOSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSEP->IsPrimaryKey = true; // Primary key field
        $this->NOSEP->Nullable = false; // NOT NULL field
        $this->NOSEP->Required = true; // Required field
        $this->NOSEP->Sortable = true; // Allow sort
        $this->NOSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSEP->Param, "CustomMsg");
        $this->Fields['NOSEP'] = &$this->NOSEP;

        // BYTAGIHAN
        $this->BYTAGIHAN = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_BYTAGIHAN', 'BYTAGIHAN', '[BYTAGIHAN]', '[BYTAGIHAN]', 200, 50, -1, false, '[BYTAGIHAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BYTAGIHAN->Sortable = true; // Allow sort
        $this->BYTAGIHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BYTAGIHAN->Param, "CustomMsg");
        $this->Fields['BYTAGIHAN'] = &$this->BYTAGIHAN;

        // CATATAN
        $this->CATATAN = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_CATATAN', 'CATATAN', '[CATATAN]', '[CATATAN]', 200, 250, -1, false, '[CATATAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CATATAN->Sortable = true; // Allow sort
        $this->CATATAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CATATAN->Param, "CustomMsg");
        $this->Fields['CATATAN'] = &$this->CATATAN;

        // KDDIAG
        $this->KDDIAG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_KDDIAG', 'KDDIAG', '[KDDIAG]', '[KDDIAG]', 200, 10, -1, false, '[KDDIAG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDDIAG->Sortable = true; // Allow sort
        $this->KDDIAG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDDIAG->Param, "CustomMsg");
        $this->Fields['KDDIAG'] = &$this->KDDIAG;

        // NMDIAG
        $this->NMDIAG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NMDIAG', 'NMDIAG', '[NMDIAG]', '[NMDIAG]', 200, 250, -1, false, '[NMDIAG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMDIAG->Sortable = true; // Allow sort
        $this->NMDIAG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMDIAG->Param, "CustomMsg");
        $this->Fields['NMDIAG'] = &$this->NMDIAG;

        // JNSPELAYANAN
        $this->JNSPELAYANAN = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_JNSPELAYANAN', 'JNSPELAYANAN', '[JNSPELAYANAN]', '[JNSPELAYANAN]', 200, 50, -1, false, '[JNSPELAYANAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JNSPELAYANAN->Sortable = true; // Allow sort
        $this->JNSPELAYANAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JNSPELAYANAN->Param, "CustomMsg");
        $this->Fields['JNSPELAYANAN'] = &$this->JNSPELAYANAN;

        // KLSRAWAT_KDKELAS
        $this->KLSRAWAT_KDKELAS = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_KLSRAWAT_KDKELAS', 'KLSRAWAT_KDKELAS', '[KLSRAWAT_KDKELAS]', '[KLSRAWAT_KDKELAS]', 200, 3, -1, false, '[KLSRAWAT_KDKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KLSRAWAT_KDKELAS->Sortable = true; // Allow sort
        $this->KLSRAWAT_KDKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KLSRAWAT_KDKELAS->Param, "CustomMsg");
        $this->Fields['KLSRAWAT_KDKELAS'] = &$this->KLSRAWAT_KDKELAS;

        // KLSRAWAT_NMKELAS
        $this->KLSRAWAT_NMKELAS = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_KLSRAWAT_NMKELAS', 'KLSRAWAT_NMKELAS', '[KLSRAWAT_NMKELAS]', '[KLSRAWAT_NMKELAS]', 200, 150, -1, false, '[KLSRAWAT_NMKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KLSRAWAT_NMKELAS->Sortable = true; // Allow sort
        $this->KLSRAWAT_NMKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KLSRAWAT_NMKELAS->Param, "CustomMsg");
        $this->Fields['KLSRAWAT_NMKELAS'] = &$this->KLSRAWAT_NMKELAS;

        // LAKALANTAS_KET
        $this->LAKALANTAS_KET = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_LAKALANTAS_KET', 'LAKALANTAS_KET', '[LAKALANTAS_KET]', '[LAKALANTAS_KET]', 200, 250, -1, false, '[LAKALANTAS_KET]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LAKALANTAS_KET->Sortable = true; // Allow sort
        $this->LAKALANTAS_KET->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LAKALANTAS_KET->Param, "CustomMsg");
        $this->Fields['LAKALANTAS_KET'] = &$this->LAKALANTAS_KET;

        // LAKALANTAS_STATUS
        $this->LAKALANTAS_STATUS = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_LAKALANTAS_STATUS', 'LAKALANTAS_STATUS', '[LAKALANTAS_STATUS]', '[LAKALANTAS_STATUS]', 200, 10, -1, false, '[LAKALANTAS_STATUS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LAKALANTAS_STATUS->Sortable = true; // Allow sort
        $this->LAKALANTAS_STATUS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LAKALANTAS_STATUS->Param, "CustomMsg");
        $this->Fields['LAKALANTAS_STATUS'] = &$this->LAKALANTAS_STATUS;

        // NORUJUKAN
        $this->NORUJUKAN = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NORUJUKAN', 'NORUJUKAN', '[NORUJUKAN]', '[NORUJUKAN]', 200, 50, -1, false, '[NORUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NORUJUKAN->Sortable = true; // Allow sort
        $this->NORUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NORUJUKAN->Param, "CustomMsg");
        $this->Fields['NORUJUKAN'] = &$this->NORUJUKAN;

        // KDJNSPESERTA
        $this->KDJNSPESERTA = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_KDJNSPESERTA', 'KDJNSPESERTA', '[KDJNSPESERTA]', '[KDJNSPESERTA]', 200, 3, -1, false, '[KDJNSPESERTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDJNSPESERTA->Sortable = true; // Allow sort
        $this->KDJNSPESERTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDJNSPESERTA->Param, "CustomMsg");
        $this->Fields['KDJNSPESERTA'] = &$this->KDJNSPESERTA;

        // NMJNSPESERTA
        $this->NMJNSPESERTA = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NMJNSPESERTA', 'NMJNSPESERTA', '[NMJNSPESERTA]', '[NMJNSPESERTA]', 200, 150, -1, false, '[NMJNSPESERTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMJNSPESERTA->Sortable = true; // Allow sort
        $this->NMJNSPESERTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMJNSPESERTA->Param, "CustomMsg");
        $this->Fields['NMJNSPESERTA'] = &$this->NMJNSPESERTA;

        // KLSTANGGUNGAN_KDKELAS
        $this->KLSTANGGUNGAN_KDKELAS = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_KLSTANGGUNGAN_KDKELAS', 'KLSTANGGUNGAN_KDKELAS', '[KLSTANGGUNGAN_KDKELAS]', '[KLSTANGGUNGAN_KDKELAS]', 200, 3, -1, false, '[KLSTANGGUNGAN_KDKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KLSTANGGUNGAN_KDKELAS->Sortable = true; // Allow sort
        $this->KLSTANGGUNGAN_KDKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KLSTANGGUNGAN_KDKELAS->Param, "CustomMsg");
        $this->Fields['KLSTANGGUNGAN_KDKELAS'] = &$this->KLSTANGGUNGAN_KDKELAS;

        // KLSTANGGUNGAN_NMKELAS
        $this->KLSTANGGUNGAN_NMKELAS = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_KLSTANGGUNGAN_NMKELAS', 'KLSTANGGUNGAN_NMKELAS', '[KLSTANGGUNGAN_NMKELAS]', '[KLSTANGGUNGAN_NMKELAS]', 200, 150, -1, false, '[KLSTANGGUNGAN_NMKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KLSTANGGUNGAN_NMKELAS->Sortable = true; // Allow sort
        $this->KLSTANGGUNGAN_NMKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KLSTANGGUNGAN_NMKELAS->Param, "CustomMsg");
        $this->Fields['KLSTANGGUNGAN_NMKELAS'] = &$this->KLSTANGGUNGAN_NMKELAS;

        // NAMA
        $this->NAMA = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NAMA', 'NAMA', '[NAMA]', '[NAMA]', 200, 250, -1, false, '[NAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA->Sortable = true; // Allow sort
        $this->NAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA->Param, "CustomMsg");
        $this->Fields['NAMA'] = &$this->NAMA;

        // NIK
        $this->NIK = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NIK', 'NIK', '[NIK]', '[NIK]', 200, 50, -1, false, '[NIK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // NOMR
        $this->NOMR = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NOMR', 'NOMR', '[NOMR]', '[NOMR]', 200, 50, -1, false, '[NOMR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOMR->Sortable = true; // Allow sort
        $this->NOMR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOMR->Param, "CustomMsg");
        $this->Fields['NOMR'] = &$this->NOMR;

        // PISA
        $this->PISA = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PISA', 'PISA', '[PISA]', '[PISA]', 129, 2, -1, false, '[PISA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PISA->Sortable = true; // Allow sort
        $this->PISA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PISA->Param, "CustomMsg");
        $this->Fields['PISA'] = &$this->PISA;

        // PROVUMUM_KDCABANG
        $this->PROVUMUM_KDCABANG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVUMUM_KDCABANG', 'PROVUMUM_KDCABANG', '[PROVUMUM_KDCABANG]', '[PROVUMUM_KDCABANG]', 200, 10, -1, false, '[PROVUMUM_KDCABANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVUMUM_KDCABANG->Sortable = true; // Allow sort
        $this->PROVUMUM_KDCABANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVUMUM_KDCABANG->Param, "CustomMsg");
        $this->Fields['PROVUMUM_KDCABANG'] = &$this->PROVUMUM_KDCABANG;

        // PROVUMUM_KDPROVIDER
        $this->PROVUMUM_KDPROVIDER = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVUMUM_KDPROVIDER', 'PROVUMUM_KDPROVIDER', '[PROVUMUM_KDPROVIDER]', '[PROVUMUM_KDPROVIDER]', 200, 10, -1, false, '[PROVUMUM_KDPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVUMUM_KDPROVIDER->Sortable = true; // Allow sort
        $this->PROVUMUM_KDPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVUMUM_KDPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVUMUM_KDPROVIDER'] = &$this->PROVUMUM_KDPROVIDER;

        // PROVUMUM_NMCABANG
        $this->PROVUMUM_NMCABANG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVUMUM_NMCABANG', 'PROVUMUM_NMCABANG', '[PROVUMUM_NMCABANG]', '[PROVUMUM_NMCABANG]', 200, 200, -1, false, '[PROVUMUM_NMCABANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVUMUM_NMCABANG->Sortable = true; // Allow sort
        $this->PROVUMUM_NMCABANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVUMUM_NMCABANG->Param, "CustomMsg");
        $this->Fields['PROVUMUM_NMCABANG'] = &$this->PROVUMUM_NMCABANG;

        // PROVUMUM_NMPROVIDER
        $this->PROVUMUM_NMPROVIDER = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVUMUM_NMPROVIDER', 'PROVUMUM_NMPROVIDER', '[PROVUMUM_NMPROVIDER]', '[PROVUMUM_NMPROVIDER]', 200, 200, -1, false, '[PROVUMUM_NMPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVUMUM_NMPROVIDER->Sortable = true; // Allow sort
        $this->PROVUMUM_NMPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVUMUM_NMPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVUMUM_NMPROVIDER'] = &$this->PROVUMUM_NMPROVIDER;

        // SEX
        $this->SEX = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_SEX', 'SEX', '[SEX]', '[SEX]', 200, 3, -1, false, '[SEX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SEX->Sortable = true; // Allow sort
        $this->SEX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEX->Param, "CustomMsg");
        $this->Fields['SEX'] = &$this->SEX;

        // STATUS_PESERTA
        $this->STATUS_PESERTA = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_STATUS_PESERTA', 'STATUS_PESERTA', '[STATUS_PESERTA]', '[STATUS_PESERTA]', 200, 200, -1, false, '[STATUS_PESERTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PESERTA->Sortable = true; // Allow sort
        $this->STATUS_PESERTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PESERTA->Param, "CustomMsg");
        $this->Fields['STATUS_PESERTA'] = &$this->STATUS_PESERTA;

        // TGLCETAKKARTU
        $this->TGLCETAKKARTU = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_TGLCETAKKARTU', 'TGLCETAKKARTU', '[TGLCETAKKARTU]', CastDateFieldForLike("[TGLCETAKKARTU]", 0, "DB"), 135, 8, 0, false, '[TGLCETAKKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLCETAKKARTU->Sortable = true; // Allow sort
        $this->TGLCETAKKARTU->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLCETAKKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLCETAKKARTU->Param, "CustomMsg");
        $this->Fields['TGLCETAKKARTU'] = &$this->TGLCETAKKARTU;

        // TGLLAHIR
        $this->TGLLAHIR = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_TGLLAHIR', 'TGLLAHIR', '[TGLLAHIR]', CastDateFieldForLike("[TGLLAHIR]", 0, "DB"), 135, 8, 0, false, '[TGLLAHIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLLAHIR->Sortable = true; // Allow sort
        $this->TGLLAHIR->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLLAHIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLLAHIR->Param, "CustomMsg");
        $this->Fields['TGLLAHIR'] = &$this->TGLLAHIR;

        // TGLTAT
        $this->TGLTAT = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_TGLTAT', 'TGLTAT', '[TGLTAT]', CastDateFieldForLike("[TGLTAT]", 0, "DB"), 135, 8, 0, false, '[TGLTAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLTAT->Sortable = true; // Allow sort
        $this->TGLTAT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLTAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLTAT->Param, "CustomMsg");
        $this->Fields['TGLTAT'] = &$this->TGLTAT;

        // TGLTMT
        $this->TGLTMT = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_TGLTMT', 'TGLTMT', '[TGLTMT]', CastDateFieldForLike("[TGLTMT]", 0, "DB"), 135, 8, 0, false, '[TGLTMT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLTMT->Sortable = true; // Allow sort
        $this->TGLTMT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLTMT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLTMT->Param, "CustomMsg");
        $this->Fields['TGLTMT'] = &$this->TGLTMT;

        // UMUR
        $this->UMUR = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_UMUR', 'UMUR', '[UMUR]', '[UMUR]', 200, 50, -1, false, '[UMUR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->UMUR->Sortable = true; // Allow sort
        $this->UMUR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->UMUR->Param, "CustomMsg");
        $this->Fields['UMUR'] = &$this->UMUR;

        // POLITUJUAN_KDPOLI
        $this->POLITUJUAN_KDPOLI = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_POLITUJUAN_KDPOLI', 'POLITUJUAN_KDPOLI', '[POLITUJUAN_KDPOLI]', '[POLITUJUAN_KDPOLI]', 200, 3, -1, false, '[POLITUJUAN_KDPOLI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POLITUJUAN_KDPOLI->Sortable = true; // Allow sort
        $this->POLITUJUAN_KDPOLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POLITUJUAN_KDPOLI->Param, "CustomMsg");
        $this->Fields['POLITUJUAN_KDPOLI'] = &$this->POLITUJUAN_KDPOLI;

        // POLITUJUAN_NMPOLI
        $this->POLITUJUAN_NMPOLI = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_POLITUJUAN_NMPOLI', 'POLITUJUAN_NMPOLI', '[POLITUJUAN_NMPOLI]', '[POLITUJUAN_NMPOLI]', 200, 200, -1, false, '[POLITUJUAN_NMPOLI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POLITUJUAN_NMPOLI->Sortable = true; // Allow sort
        $this->POLITUJUAN_NMPOLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POLITUJUAN_NMPOLI->Param, "CustomMsg");
        $this->Fields['POLITUJUAN_NMPOLI'] = &$this->POLITUJUAN_NMPOLI;

        // PROVPELAYANAN_KDCABANG
        $this->PROVPELAYANAN_KDCABANG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVPELAYANAN_KDCABANG', 'PROVPELAYANAN_KDCABANG', '[PROVPELAYANAN_KDCABANG]', '[PROVPELAYANAN_KDCABANG]', 200, 10, -1, false, '[PROVPELAYANAN_KDCABANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVPELAYANAN_KDCABANG->Sortable = true; // Allow sort
        $this->PROVPELAYANAN_KDCABANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVPELAYANAN_KDCABANG->Param, "CustomMsg");
        $this->Fields['PROVPELAYANAN_KDCABANG'] = &$this->PROVPELAYANAN_KDCABANG;

        // PROVPELAYANAN_KDPROVIDER
        $this->PROVPELAYANAN_KDPROVIDER = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVPELAYANAN_KDPROVIDER', 'PROVPELAYANAN_KDPROVIDER', '[PROVPELAYANAN_KDPROVIDER]', '[PROVPELAYANAN_KDPROVIDER]', 200, 10, -1, false, '[PROVPELAYANAN_KDPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVPELAYANAN_KDPROVIDER->Sortable = true; // Allow sort
        $this->PROVPELAYANAN_KDPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVPELAYANAN_KDPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVPELAYANAN_KDPROVIDER'] = &$this->PROVPELAYANAN_KDPROVIDER;

        // PROVPELAYANAN_NMCABANG
        $this->PROVPELAYANAN_NMCABANG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVPELAYANAN_NMCABANG', 'PROVPELAYANAN_NMCABANG', '[PROVPELAYANAN_NMCABANG]', '[PROVPELAYANAN_NMCABANG]', 200, 200, -1, false, '[PROVPELAYANAN_NMCABANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVPELAYANAN_NMCABANG->Sortable = true; // Allow sort
        $this->PROVPELAYANAN_NMCABANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVPELAYANAN_NMCABANG->Param, "CustomMsg");
        $this->Fields['PROVPELAYANAN_NMCABANG'] = &$this->PROVPELAYANAN_NMCABANG;

        // PROVPELAYANAN_NMPROVIDER
        $this->PROVPELAYANAN_NMPROVIDER = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVPELAYANAN_NMPROVIDER', 'PROVPELAYANAN_NMPROVIDER', '[PROVPELAYANAN_NMPROVIDER]', '[PROVPELAYANAN_NMPROVIDER]', 200, 200, -1, false, '[PROVPELAYANAN_NMPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVPELAYANAN_NMPROVIDER->Sortable = true; // Allow sort
        $this->PROVPELAYANAN_NMPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVPELAYANAN_NMPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVPELAYANAN_NMPROVIDER'] = &$this->PROVPELAYANAN_NMPROVIDER;

        // PROVRUJUKAN_KDCABANG
        $this->PROVRUJUKAN_KDCABANG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVRUJUKAN_KDCABANG', 'PROVRUJUKAN_KDCABANG', '[PROVRUJUKAN_KDCABANG]', '[PROVRUJUKAN_KDCABANG]', 200, 10, -1, false, '[PROVRUJUKAN_KDCABANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVRUJUKAN_KDCABANG->Sortable = true; // Allow sort
        $this->PROVRUJUKAN_KDCABANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVRUJUKAN_KDCABANG->Param, "CustomMsg");
        $this->Fields['PROVRUJUKAN_KDCABANG'] = &$this->PROVRUJUKAN_KDCABANG;

        // PROVRUJUKAN_KDPROVIDER
        $this->PROVRUJUKAN_KDPROVIDER = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVRUJUKAN_KDPROVIDER', 'PROVRUJUKAN_KDPROVIDER', '[PROVRUJUKAN_KDPROVIDER]', '[PROVRUJUKAN_KDPROVIDER]', 200, 10, -1, false, '[PROVRUJUKAN_KDPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVRUJUKAN_KDPROVIDER->Sortable = true; // Allow sort
        $this->PROVRUJUKAN_KDPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVRUJUKAN_KDPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVRUJUKAN_KDPROVIDER'] = &$this->PROVRUJUKAN_KDPROVIDER;

        // PROVRUJUKAN_NMCABANG
        $this->PROVRUJUKAN_NMCABANG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVRUJUKAN_NMCABANG', 'PROVRUJUKAN_NMCABANG', '[PROVRUJUKAN_NMCABANG]', '[PROVRUJUKAN_NMCABANG]', 200, 200, -1, false, '[PROVRUJUKAN_NMCABANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVRUJUKAN_NMCABANG->Sortable = true; // Allow sort
        $this->PROVRUJUKAN_NMCABANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVRUJUKAN_NMCABANG->Param, "CustomMsg");
        $this->Fields['PROVRUJUKAN_NMCABANG'] = &$this->PROVRUJUKAN_NMCABANG;

        // PROVRUJUKAN_NMPROVIDER
        $this->PROVRUJUKAN_NMPROVIDER = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROVRUJUKAN_NMPROVIDER', 'PROVRUJUKAN_NMPROVIDER', '[PROVRUJUKAN_NMPROVIDER]', '[PROVRUJUKAN_NMPROVIDER]', 200, 200, -1, false, '[PROVRUJUKAN_NMPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVRUJUKAN_NMPROVIDER->Sortable = true; // Allow sort
        $this->PROVRUJUKAN_NMPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVRUJUKAN_NMPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVRUJUKAN_NMPROVIDER'] = &$this->PROVRUJUKAN_NMPROVIDER;

        // KDSTATSEP
        $this->KDSTATSEP = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_KDSTATSEP', 'KDSTATSEP', '[KDSTATSEP]', '[KDSTATSEP]', 200, 10, -1, false, '[KDSTATSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDSTATSEP->Sortable = true; // Allow sort
        $this->KDSTATSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDSTATSEP->Param, "CustomMsg");
        $this->Fields['KDSTATSEP'] = &$this->KDSTATSEP;

        // NMSTATSEP
        $this->NMSTATSEP = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NMSTATSEP', 'NMSTATSEP', '[NMSTATSEP]', '[NMSTATSEP]', 200, 200, -1, false, '[NMSTATSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMSTATSEP->Sortable = true; // Allow sort
        $this->NMSTATSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMSTATSEP->Param, "CustomMsg");
        $this->Fields['NMSTATSEP'] = &$this->NMSTATSEP;

        // KDCOB
        $this->KDCOB = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_KDCOB', 'KDCOB', '[KDCOB]', '[KDCOB]', 200, 10, -1, false, '[KDCOB]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDCOB->Sortable = true; // Allow sort
        $this->KDCOB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDCOB->Param, "CustomMsg");
        $this->Fields['KDCOB'] = &$this->KDCOB;

        // NMCOB
        $this->NMCOB = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NMCOB', 'NMCOB', '[NMCOB]', '[NMCOB]', 200, 200, -1, false, '[NMCOB]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMCOB->Sortable = true; // Allow sort
        $this->NMCOB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMCOB->Param, "CustomMsg");
        $this->Fields['NMCOB'] = &$this->NMCOB;

        // TGLPULANG
        $this->TGLPULANG = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_TGLPULANG', 'TGLPULANG', '[TGLPULANG]', CastDateFieldForLike("[TGLPULANG]", 0, "DB"), 135, 8, 0, false, '[TGLPULANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLPULANG->Sortable = true; // Allow sort
        $this->TGLPULANG->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLPULANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLPULANG->Param, "CustomMsg");
        $this->Fields['TGLPULANG'] = &$this->TGLPULANG;

        // TGLRUJUKAN
        $this->TGLRUJUKAN = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_TGLRUJUKAN', 'TGLRUJUKAN', '[TGLRUJUKAN]', CastDateFieldForLike("[TGLRUJUKAN]", 0, "DB"), 135, 8, 0, false, '[TGLRUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLRUJUKAN->Sortable = true; // Allow sort
        $this->TGLRUJUKAN->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLRUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLRUJUKAN->Param, "CustomMsg");
        $this->Fields['TGLRUJUKAN'] = &$this->TGLRUJUKAN;

        // TGLSEP
        $this->TGLSEP = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_TGLSEP', 'TGLSEP', '[TGLSEP]', CastDateFieldForLike("[TGLSEP]", 0, "DB"), 135, 8, 0, false, '[TGLSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLSEP->Sortable = true; // Allow sort
        $this->TGLSEP->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLSEP->Param, "CustomMsg");
        $this->Fields['TGLSEP'] = &$this->TGLSEP;

        // REST_CODE
        $this->REST_CODE = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_REST_CODE', 'REST_CODE', '[REST_CODE]', '[REST_CODE]', 200, 3, -1, false, '[REST_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REST_CODE->Sortable = true; // Allow sort
        $this->REST_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_CODE->Param, "CustomMsg");
        $this->Fields['REST_CODE'] = &$this->REST_CODE;

        // REST_MESSAGE
        $this->REST_MESSAGE = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_REST_MESSAGE', 'REST_MESSAGE', '[REST_MESSAGE]', '[REST_MESSAGE]', 200, 50, -1, false, '[REST_MESSAGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REST_MESSAGE->Sortable = true; // Allow sort
        $this->REST_MESSAGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_MESSAGE->Param, "CustomMsg");
        $this->Fields['REST_MESSAGE'] = &$this->REST_MESSAGE;

        // REST_DATE
        $this->REST_DATE = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_REST_DATE', 'REST_DATE', '[REST_DATE]', CastDateFieldForLike("[REST_DATE]", 0, "DB"), 135, 8, 0, false, '[REST_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REST_DATE->Sortable = true; // Allow sort
        $this->REST_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REST_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_DATE->Param, "CustomMsg");
        $this->Fields['REST_DATE'] = &$this->REST_DATE;

        // REST_METHOD
        $this->REST_METHOD = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_REST_METHOD', 'REST_METHOD', '[REST_METHOD]', '[REST_METHOD]', 200, 10, -1, false, '[REST_METHOD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REST_METHOD->Sortable = true; // Allow sort
        $this->REST_METHOD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_METHOD->Param, "CustomMsg");
        $this->Fields['REST_METHOD'] = &$this->REST_METHOD;

        // RESPONDETAILSEP
        $this->RESPONDETAILSEP = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_RESPONDETAILSEP', 'RESPONDETAILSEP', '[RESPONDETAILSEP]', '[RESPONDETAILSEP]', 201, 0, -1, false, '[RESPONDETAILSEP]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONDETAILSEP->Sortable = true; // Allow sort
        $this->RESPONDETAILSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONDETAILSEP->Param, "CustomMsg");
        $this->Fields['RESPONDETAILSEP'] = &$this->RESPONDETAILSEP;

        // DINSOS
        $this->DINSOS = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_DINSOS', 'DINSOS', '[DINSOS]', '[DINSOS]', 200, 100, -1, false, '[DINSOS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DINSOS->Sortable = true; // Allow sort
        $this->DINSOS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DINSOS->Param, "CustomMsg");
        $this->Fields['DINSOS'] = &$this->DINSOS;

        // PROLANISPRB
        $this->PROLANISPRB = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_PROLANISPRB', 'PROLANISPRB', '[PROLANISPRB]', '[PROLANISPRB]', 200, 100, -1, false, '[PROLANISPRB]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROLANISPRB->Sortable = true; // Allow sort
        $this->PROLANISPRB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROLANISPRB->Param, "CustomMsg");
        $this->Fields['PROLANISPRB'] = &$this->PROLANISPRB;

        // NOSKTM
        $this->NOSKTM = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_NOSKTM', 'NOSKTM', '[NOSKTM]', '[NOSKTM]', 200, 100, -1, false, '[NOSKTM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSKTM->Sortable = true; // Allow sort
        $this->NOSKTM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSKTM->Param, "CustomMsg");
        $this->Fields['NOSKTM'] = &$this->NOSKTM;

        // SEXNAME
        $this->SEXNAME = new DbField('INASIS_GET_DETAILSEP', 'INASIS_GET_DETAILSEP', 'x_SEXNAME', 'SEXNAME', '[SEXNAME]', '[SEXNAME]', 200, 25, -1, false, '[SEXNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SEXNAME->Sortable = true; // Allow sort
        $this->SEXNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEXNAME->Param, "CustomMsg");
        $this->Fields['SEXNAME'] = &$this->SEXNAME;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[INASIS_GET_DETAILSEP]";
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
            if (array_key_exists('NOSEP', $rs)) {
                AddFilter($where, QuotedName('NOSEP', $this->Dbid) . '=' . QuotedValue($rs['NOSEP'], $this->NOSEP->DataType, $this->Dbid));
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
        $this->NOSEP->DbValue = $row['NOSEP'];
        $this->BYTAGIHAN->DbValue = $row['BYTAGIHAN'];
        $this->CATATAN->DbValue = $row['CATATAN'];
        $this->KDDIAG->DbValue = $row['KDDIAG'];
        $this->NMDIAG->DbValue = $row['NMDIAG'];
        $this->JNSPELAYANAN->DbValue = $row['JNSPELAYANAN'];
        $this->KLSRAWAT_KDKELAS->DbValue = $row['KLSRAWAT_KDKELAS'];
        $this->KLSRAWAT_NMKELAS->DbValue = $row['KLSRAWAT_NMKELAS'];
        $this->LAKALANTAS_KET->DbValue = $row['LAKALANTAS_KET'];
        $this->LAKALANTAS_STATUS->DbValue = $row['LAKALANTAS_STATUS'];
        $this->NORUJUKAN->DbValue = $row['NORUJUKAN'];
        $this->KDJNSPESERTA->DbValue = $row['KDJNSPESERTA'];
        $this->NMJNSPESERTA->DbValue = $row['NMJNSPESERTA'];
        $this->KLSTANGGUNGAN_KDKELAS->DbValue = $row['KLSTANGGUNGAN_KDKELAS'];
        $this->KLSTANGGUNGAN_NMKELAS->DbValue = $row['KLSTANGGUNGAN_NMKELAS'];
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
        $this->TGLCETAKKARTU->DbValue = $row['TGLCETAKKARTU'];
        $this->TGLLAHIR->DbValue = $row['TGLLAHIR'];
        $this->TGLTAT->DbValue = $row['TGLTAT'];
        $this->TGLTMT->DbValue = $row['TGLTMT'];
        $this->UMUR->DbValue = $row['UMUR'];
        $this->POLITUJUAN_KDPOLI->DbValue = $row['POLITUJUAN_KDPOLI'];
        $this->POLITUJUAN_NMPOLI->DbValue = $row['POLITUJUAN_NMPOLI'];
        $this->PROVPELAYANAN_KDCABANG->DbValue = $row['PROVPELAYANAN_KDCABANG'];
        $this->PROVPELAYANAN_KDPROVIDER->DbValue = $row['PROVPELAYANAN_KDPROVIDER'];
        $this->PROVPELAYANAN_NMCABANG->DbValue = $row['PROVPELAYANAN_NMCABANG'];
        $this->PROVPELAYANAN_NMPROVIDER->DbValue = $row['PROVPELAYANAN_NMPROVIDER'];
        $this->PROVRUJUKAN_KDCABANG->DbValue = $row['PROVRUJUKAN_KDCABANG'];
        $this->PROVRUJUKAN_KDPROVIDER->DbValue = $row['PROVRUJUKAN_KDPROVIDER'];
        $this->PROVRUJUKAN_NMCABANG->DbValue = $row['PROVRUJUKAN_NMCABANG'];
        $this->PROVRUJUKAN_NMPROVIDER->DbValue = $row['PROVRUJUKAN_NMPROVIDER'];
        $this->KDSTATSEP->DbValue = $row['KDSTATSEP'];
        $this->NMSTATSEP->DbValue = $row['NMSTATSEP'];
        $this->KDCOB->DbValue = $row['KDCOB'];
        $this->NMCOB->DbValue = $row['NMCOB'];
        $this->TGLPULANG->DbValue = $row['TGLPULANG'];
        $this->TGLRUJUKAN->DbValue = $row['TGLRUJUKAN'];
        $this->TGLSEP->DbValue = $row['TGLSEP'];
        $this->REST_CODE->DbValue = $row['REST_CODE'];
        $this->REST_MESSAGE->DbValue = $row['REST_MESSAGE'];
        $this->REST_DATE->DbValue = $row['REST_DATE'];
        $this->REST_METHOD->DbValue = $row['REST_METHOD'];
        $this->RESPONDETAILSEP->DbValue = $row['RESPONDETAILSEP'];
        $this->DINSOS->DbValue = $row['DINSOS'];
        $this->PROLANISPRB->DbValue = $row['PROLANISPRB'];
        $this->NOSKTM->DbValue = $row['NOSKTM'];
        $this->SEXNAME->DbValue = $row['SEXNAME'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[NOKARTU] = '@NOKARTU@' AND [NOSEP] = '@NOSEP@'";
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
        $val = $current ? $this->NOSEP->CurrentValue : $this->NOSEP->OldValue;
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
                $this->NOKARTU->CurrentValue = $keys[0];
            } else {
                $this->NOKARTU->OldValue = $keys[0];
            }
            if ($current) {
                $this->NOSEP->CurrentValue = $keys[1];
            } else {
                $this->NOSEP->OldValue = $keys[1];
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
        if (is_array($row)) {
            $val = array_key_exists('NOSEP', $row) ? $row['NOSEP'] : null;
        } else {
            $val = $this->NOSEP->OldValue !== null ? $this->NOSEP->OldValue : $this->NOSEP->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NOSEP@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("InasisGetDetailsepList");
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
        if ($pageName == "InasisGetDetailsepView") {
            return $Language->phrase("View");
        } elseif ($pageName == "InasisGetDetailsepEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "InasisGetDetailsepAdd") {
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
                return "InasisGetDetailsepView";
            case Config("API_ADD_ACTION"):
                return "InasisGetDetailsepAdd";
            case Config("API_EDIT_ACTION"):
                return "InasisGetDetailsepEdit";
            case Config("API_DELETE_ACTION"):
                return "InasisGetDetailsepDelete";
            case Config("API_LIST_ACTION"):
                return "InasisGetDetailsepList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "InasisGetDetailsepList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("InasisGetDetailsepView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("InasisGetDetailsepView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "InasisGetDetailsepAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "InasisGetDetailsepAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("InasisGetDetailsepEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("InasisGetDetailsepAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("InasisGetDetailsepDelete", $this->getUrlParm());
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
        $json .= ",NOSEP:" . JsonEncode($this->NOSEP->CurrentValue, "string");
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
        if ($this->NOSEP->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NOSEP->CurrentValue);
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
            if (($keyValue = Param("NOKARTU") ?? Route("NOKARTU")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("NOSEP") ?? Route("NOSEP")) !== null) {
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
                $this->NOKARTU->CurrentValue = $key[0];
            } else {
                $this->NOKARTU->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->NOSEP->CurrentValue = $key[1];
            } else {
                $this->NOSEP->OldValue = $key[1];
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
        $this->NOSEP->setDbValue($row['NOSEP']);
        $this->BYTAGIHAN->setDbValue($row['BYTAGIHAN']);
        $this->CATATAN->setDbValue($row['CATATAN']);
        $this->KDDIAG->setDbValue($row['KDDIAG']);
        $this->NMDIAG->setDbValue($row['NMDIAG']);
        $this->JNSPELAYANAN->setDbValue($row['JNSPELAYANAN']);
        $this->KLSRAWAT_KDKELAS->setDbValue($row['KLSRAWAT_KDKELAS']);
        $this->KLSRAWAT_NMKELAS->setDbValue($row['KLSRAWAT_NMKELAS']);
        $this->LAKALANTAS_KET->setDbValue($row['LAKALANTAS_KET']);
        $this->LAKALANTAS_STATUS->setDbValue($row['LAKALANTAS_STATUS']);
        $this->NORUJUKAN->setDbValue($row['NORUJUKAN']);
        $this->KDJNSPESERTA->setDbValue($row['KDJNSPESERTA']);
        $this->NMJNSPESERTA->setDbValue($row['NMJNSPESERTA']);
        $this->KLSTANGGUNGAN_KDKELAS->setDbValue($row['KLSTANGGUNGAN_KDKELAS']);
        $this->KLSTANGGUNGAN_NMKELAS->setDbValue($row['KLSTANGGUNGAN_NMKELAS']);
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
        $this->TGLCETAKKARTU->setDbValue($row['TGLCETAKKARTU']);
        $this->TGLLAHIR->setDbValue($row['TGLLAHIR']);
        $this->TGLTAT->setDbValue($row['TGLTAT']);
        $this->TGLTMT->setDbValue($row['TGLTMT']);
        $this->UMUR->setDbValue($row['UMUR']);
        $this->POLITUJUAN_KDPOLI->setDbValue($row['POLITUJUAN_KDPOLI']);
        $this->POLITUJUAN_NMPOLI->setDbValue($row['POLITUJUAN_NMPOLI']);
        $this->PROVPELAYANAN_KDCABANG->setDbValue($row['PROVPELAYANAN_KDCABANG']);
        $this->PROVPELAYANAN_KDPROVIDER->setDbValue($row['PROVPELAYANAN_KDPROVIDER']);
        $this->PROVPELAYANAN_NMCABANG->setDbValue($row['PROVPELAYANAN_NMCABANG']);
        $this->PROVPELAYANAN_NMPROVIDER->setDbValue($row['PROVPELAYANAN_NMPROVIDER']);
        $this->PROVRUJUKAN_KDCABANG->setDbValue($row['PROVRUJUKAN_KDCABANG']);
        $this->PROVRUJUKAN_KDPROVIDER->setDbValue($row['PROVRUJUKAN_KDPROVIDER']);
        $this->PROVRUJUKAN_NMCABANG->setDbValue($row['PROVRUJUKAN_NMCABANG']);
        $this->PROVRUJUKAN_NMPROVIDER->setDbValue($row['PROVRUJUKAN_NMPROVIDER']);
        $this->KDSTATSEP->setDbValue($row['KDSTATSEP']);
        $this->NMSTATSEP->setDbValue($row['NMSTATSEP']);
        $this->KDCOB->setDbValue($row['KDCOB']);
        $this->NMCOB->setDbValue($row['NMCOB']);
        $this->TGLPULANG->setDbValue($row['TGLPULANG']);
        $this->TGLRUJUKAN->setDbValue($row['TGLRUJUKAN']);
        $this->TGLSEP->setDbValue($row['TGLSEP']);
        $this->REST_CODE->setDbValue($row['REST_CODE']);
        $this->REST_MESSAGE->setDbValue($row['REST_MESSAGE']);
        $this->REST_DATE->setDbValue($row['REST_DATE']);
        $this->REST_METHOD->setDbValue($row['REST_METHOD']);
        $this->RESPONDETAILSEP->setDbValue($row['RESPONDETAILSEP']);
        $this->DINSOS->setDbValue($row['DINSOS']);
        $this->PROLANISPRB->setDbValue($row['PROLANISPRB']);
        $this->NOSKTM->setDbValue($row['NOSKTM']);
        $this->SEXNAME->setDbValue($row['SEXNAME']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NOKARTU

        // NOSEP

        // BYTAGIHAN

        // CATATAN

        // KDDIAG

        // NMDIAG

        // JNSPELAYANAN

        // KLSRAWAT_KDKELAS

        // KLSRAWAT_NMKELAS

        // LAKALANTAS_KET

        // LAKALANTAS_STATUS

        // NORUJUKAN

        // KDJNSPESERTA

        // NMJNSPESERTA

        // KLSTANGGUNGAN_KDKELAS

        // KLSTANGGUNGAN_NMKELAS

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

        // TGLCETAKKARTU

        // TGLLAHIR

        // TGLTAT

        // TGLTMT

        // UMUR

        // POLITUJUAN_KDPOLI

        // POLITUJUAN_NMPOLI

        // PROVPELAYANAN_KDCABANG

        // PROVPELAYANAN_KDPROVIDER

        // PROVPELAYANAN_NMCABANG

        // PROVPELAYANAN_NMPROVIDER

        // PROVRUJUKAN_KDCABANG

        // PROVRUJUKAN_KDPROVIDER

        // PROVRUJUKAN_NMCABANG

        // PROVRUJUKAN_NMPROVIDER

        // KDSTATSEP

        // NMSTATSEP

        // KDCOB

        // NMCOB

        // TGLPULANG

        // TGLRUJUKAN

        // TGLSEP

        // REST_CODE

        // REST_MESSAGE

        // REST_DATE

        // REST_METHOD

        // RESPONDETAILSEP

        // DINSOS

        // PROLANISPRB

        // NOSKTM

        // SEXNAME

        // NOKARTU
        $this->NOKARTU->ViewValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->ViewCustomAttributes = "";

        // NOSEP
        $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->ViewCustomAttributes = "";

        // BYTAGIHAN
        $this->BYTAGIHAN->ViewValue = $this->BYTAGIHAN->CurrentValue;
        $this->BYTAGIHAN->ViewCustomAttributes = "";

        // CATATAN
        $this->CATATAN->ViewValue = $this->CATATAN->CurrentValue;
        $this->CATATAN->ViewCustomAttributes = "";

        // KDDIAG
        $this->KDDIAG->ViewValue = $this->KDDIAG->CurrentValue;
        $this->KDDIAG->ViewCustomAttributes = "";

        // NMDIAG
        $this->NMDIAG->ViewValue = $this->NMDIAG->CurrentValue;
        $this->NMDIAG->ViewCustomAttributes = "";

        // JNSPELAYANAN
        $this->JNSPELAYANAN->ViewValue = $this->JNSPELAYANAN->CurrentValue;
        $this->JNSPELAYANAN->ViewCustomAttributes = "";

        // KLSRAWAT_KDKELAS
        $this->KLSRAWAT_KDKELAS->ViewValue = $this->KLSRAWAT_KDKELAS->CurrentValue;
        $this->KLSRAWAT_KDKELAS->ViewCustomAttributes = "";

        // KLSRAWAT_NMKELAS
        $this->KLSRAWAT_NMKELAS->ViewValue = $this->KLSRAWAT_NMKELAS->CurrentValue;
        $this->KLSRAWAT_NMKELAS->ViewCustomAttributes = "";

        // LAKALANTAS_KET
        $this->LAKALANTAS_KET->ViewValue = $this->LAKALANTAS_KET->CurrentValue;
        $this->LAKALANTAS_KET->ViewCustomAttributes = "";

        // LAKALANTAS_STATUS
        $this->LAKALANTAS_STATUS->ViewValue = $this->LAKALANTAS_STATUS->CurrentValue;
        $this->LAKALANTAS_STATUS->ViewCustomAttributes = "";

        // NORUJUKAN
        $this->NORUJUKAN->ViewValue = $this->NORUJUKAN->CurrentValue;
        $this->NORUJUKAN->ViewCustomAttributes = "";

        // KDJNSPESERTA
        $this->KDJNSPESERTA->ViewValue = $this->KDJNSPESERTA->CurrentValue;
        $this->KDJNSPESERTA->ViewCustomAttributes = "";

        // NMJNSPESERTA
        $this->NMJNSPESERTA->ViewValue = $this->NMJNSPESERTA->CurrentValue;
        $this->NMJNSPESERTA->ViewCustomAttributes = "";

        // KLSTANGGUNGAN_KDKELAS
        $this->KLSTANGGUNGAN_KDKELAS->ViewValue = $this->KLSTANGGUNGAN_KDKELAS->CurrentValue;
        $this->KLSTANGGUNGAN_KDKELAS->ViewCustomAttributes = "";

        // KLSTANGGUNGAN_NMKELAS
        $this->KLSTANGGUNGAN_NMKELAS->ViewValue = $this->KLSTANGGUNGAN_NMKELAS->CurrentValue;
        $this->KLSTANGGUNGAN_NMKELAS->ViewCustomAttributes = "";

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

        // UMUR
        $this->UMUR->ViewValue = $this->UMUR->CurrentValue;
        $this->UMUR->ViewCustomAttributes = "";

        // POLITUJUAN_KDPOLI
        $this->POLITUJUAN_KDPOLI->ViewValue = $this->POLITUJUAN_KDPOLI->CurrentValue;
        $this->POLITUJUAN_KDPOLI->ViewCustomAttributes = "";

        // POLITUJUAN_NMPOLI
        $this->POLITUJUAN_NMPOLI->ViewValue = $this->POLITUJUAN_NMPOLI->CurrentValue;
        $this->POLITUJUAN_NMPOLI->ViewCustomAttributes = "";

        // PROVPELAYANAN_KDCABANG
        $this->PROVPELAYANAN_KDCABANG->ViewValue = $this->PROVPELAYANAN_KDCABANG->CurrentValue;
        $this->PROVPELAYANAN_KDCABANG->ViewCustomAttributes = "";

        // PROVPELAYANAN_KDPROVIDER
        $this->PROVPELAYANAN_KDPROVIDER->ViewValue = $this->PROVPELAYANAN_KDPROVIDER->CurrentValue;
        $this->PROVPELAYANAN_KDPROVIDER->ViewCustomAttributes = "";

        // PROVPELAYANAN_NMCABANG
        $this->PROVPELAYANAN_NMCABANG->ViewValue = $this->PROVPELAYANAN_NMCABANG->CurrentValue;
        $this->PROVPELAYANAN_NMCABANG->ViewCustomAttributes = "";

        // PROVPELAYANAN_NMPROVIDER
        $this->PROVPELAYANAN_NMPROVIDER->ViewValue = $this->PROVPELAYANAN_NMPROVIDER->CurrentValue;
        $this->PROVPELAYANAN_NMPROVIDER->ViewCustomAttributes = "";

        // PROVRUJUKAN_KDCABANG
        $this->PROVRUJUKAN_KDCABANG->ViewValue = $this->PROVRUJUKAN_KDCABANG->CurrentValue;
        $this->PROVRUJUKAN_KDCABANG->ViewCustomAttributes = "";

        // PROVRUJUKAN_KDPROVIDER
        $this->PROVRUJUKAN_KDPROVIDER->ViewValue = $this->PROVRUJUKAN_KDPROVIDER->CurrentValue;
        $this->PROVRUJUKAN_KDPROVIDER->ViewCustomAttributes = "";

        // PROVRUJUKAN_NMCABANG
        $this->PROVRUJUKAN_NMCABANG->ViewValue = $this->PROVRUJUKAN_NMCABANG->CurrentValue;
        $this->PROVRUJUKAN_NMCABANG->ViewCustomAttributes = "";

        // PROVRUJUKAN_NMPROVIDER
        $this->PROVRUJUKAN_NMPROVIDER->ViewValue = $this->PROVRUJUKAN_NMPROVIDER->CurrentValue;
        $this->PROVRUJUKAN_NMPROVIDER->ViewCustomAttributes = "";

        // KDSTATSEP
        $this->KDSTATSEP->ViewValue = $this->KDSTATSEP->CurrentValue;
        $this->KDSTATSEP->ViewCustomAttributes = "";

        // NMSTATSEP
        $this->NMSTATSEP->ViewValue = $this->NMSTATSEP->CurrentValue;
        $this->NMSTATSEP->ViewCustomAttributes = "";

        // KDCOB
        $this->KDCOB->ViewValue = $this->KDCOB->CurrentValue;
        $this->KDCOB->ViewCustomAttributes = "";

        // NMCOB
        $this->NMCOB->ViewValue = $this->NMCOB->CurrentValue;
        $this->NMCOB->ViewCustomAttributes = "";

        // TGLPULANG
        $this->TGLPULANG->ViewValue = $this->TGLPULANG->CurrentValue;
        $this->TGLPULANG->ViewValue = FormatDateTime($this->TGLPULANG->ViewValue, 0);
        $this->TGLPULANG->ViewCustomAttributes = "";

        // TGLRUJUKAN
        $this->TGLRUJUKAN->ViewValue = $this->TGLRUJUKAN->CurrentValue;
        $this->TGLRUJUKAN->ViewValue = FormatDateTime($this->TGLRUJUKAN->ViewValue, 0);
        $this->TGLRUJUKAN->ViewCustomAttributes = "";

        // TGLSEP
        $this->TGLSEP->ViewValue = $this->TGLSEP->CurrentValue;
        $this->TGLSEP->ViewValue = FormatDateTime($this->TGLSEP->ViewValue, 0);
        $this->TGLSEP->ViewCustomAttributes = "";

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

        // RESPONDETAILSEP
        $this->RESPONDETAILSEP->ViewValue = $this->RESPONDETAILSEP->CurrentValue;
        $this->RESPONDETAILSEP->ViewCustomAttributes = "";

        // DINSOS
        $this->DINSOS->ViewValue = $this->DINSOS->CurrentValue;
        $this->DINSOS->ViewCustomAttributes = "";

        // PROLANISPRB
        $this->PROLANISPRB->ViewValue = $this->PROLANISPRB->CurrentValue;
        $this->PROLANISPRB->ViewCustomAttributes = "";

        // NOSKTM
        $this->NOSKTM->ViewValue = $this->NOSKTM->CurrentValue;
        $this->NOSKTM->ViewCustomAttributes = "";

        // SEXNAME
        $this->SEXNAME->ViewValue = $this->SEXNAME->CurrentValue;
        $this->SEXNAME->ViewCustomAttributes = "";

        // NOKARTU
        $this->NOKARTU->LinkCustomAttributes = "";
        $this->NOKARTU->HrefValue = "";
        $this->NOKARTU->TooltipValue = "";

        // NOSEP
        $this->NOSEP->LinkCustomAttributes = "";
        $this->NOSEP->HrefValue = "";
        $this->NOSEP->TooltipValue = "";

        // BYTAGIHAN
        $this->BYTAGIHAN->LinkCustomAttributes = "";
        $this->BYTAGIHAN->HrefValue = "";
        $this->BYTAGIHAN->TooltipValue = "";

        // CATATAN
        $this->CATATAN->LinkCustomAttributes = "";
        $this->CATATAN->HrefValue = "";
        $this->CATATAN->TooltipValue = "";

        // KDDIAG
        $this->KDDIAG->LinkCustomAttributes = "";
        $this->KDDIAG->HrefValue = "";
        $this->KDDIAG->TooltipValue = "";

        // NMDIAG
        $this->NMDIAG->LinkCustomAttributes = "";
        $this->NMDIAG->HrefValue = "";
        $this->NMDIAG->TooltipValue = "";

        // JNSPELAYANAN
        $this->JNSPELAYANAN->LinkCustomAttributes = "";
        $this->JNSPELAYANAN->HrefValue = "";
        $this->JNSPELAYANAN->TooltipValue = "";

        // KLSRAWAT_KDKELAS
        $this->KLSRAWAT_KDKELAS->LinkCustomAttributes = "";
        $this->KLSRAWAT_KDKELAS->HrefValue = "";
        $this->KLSRAWAT_KDKELAS->TooltipValue = "";

        // KLSRAWAT_NMKELAS
        $this->KLSRAWAT_NMKELAS->LinkCustomAttributes = "";
        $this->KLSRAWAT_NMKELAS->HrefValue = "";
        $this->KLSRAWAT_NMKELAS->TooltipValue = "";

        // LAKALANTAS_KET
        $this->LAKALANTAS_KET->LinkCustomAttributes = "";
        $this->LAKALANTAS_KET->HrefValue = "";
        $this->LAKALANTAS_KET->TooltipValue = "";

        // LAKALANTAS_STATUS
        $this->LAKALANTAS_STATUS->LinkCustomAttributes = "";
        $this->LAKALANTAS_STATUS->HrefValue = "";
        $this->LAKALANTAS_STATUS->TooltipValue = "";

        // NORUJUKAN
        $this->NORUJUKAN->LinkCustomAttributes = "";
        $this->NORUJUKAN->HrefValue = "";
        $this->NORUJUKAN->TooltipValue = "";

        // KDJNSPESERTA
        $this->KDJNSPESERTA->LinkCustomAttributes = "";
        $this->KDJNSPESERTA->HrefValue = "";
        $this->KDJNSPESERTA->TooltipValue = "";

        // NMJNSPESERTA
        $this->NMJNSPESERTA->LinkCustomAttributes = "";
        $this->NMJNSPESERTA->HrefValue = "";
        $this->NMJNSPESERTA->TooltipValue = "";

        // KLSTANGGUNGAN_KDKELAS
        $this->KLSTANGGUNGAN_KDKELAS->LinkCustomAttributes = "";
        $this->KLSTANGGUNGAN_KDKELAS->HrefValue = "";
        $this->KLSTANGGUNGAN_KDKELAS->TooltipValue = "";

        // KLSTANGGUNGAN_NMKELAS
        $this->KLSTANGGUNGAN_NMKELAS->LinkCustomAttributes = "";
        $this->KLSTANGGUNGAN_NMKELAS->HrefValue = "";
        $this->KLSTANGGUNGAN_NMKELAS->TooltipValue = "";

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

        // UMUR
        $this->UMUR->LinkCustomAttributes = "";
        $this->UMUR->HrefValue = "";
        $this->UMUR->TooltipValue = "";

        // POLITUJUAN_KDPOLI
        $this->POLITUJUAN_KDPOLI->LinkCustomAttributes = "";
        $this->POLITUJUAN_KDPOLI->HrefValue = "";
        $this->POLITUJUAN_KDPOLI->TooltipValue = "";

        // POLITUJUAN_NMPOLI
        $this->POLITUJUAN_NMPOLI->LinkCustomAttributes = "";
        $this->POLITUJUAN_NMPOLI->HrefValue = "";
        $this->POLITUJUAN_NMPOLI->TooltipValue = "";

        // PROVPELAYANAN_KDCABANG
        $this->PROVPELAYANAN_KDCABANG->LinkCustomAttributes = "";
        $this->PROVPELAYANAN_KDCABANG->HrefValue = "";
        $this->PROVPELAYANAN_KDCABANG->TooltipValue = "";

        // PROVPELAYANAN_KDPROVIDER
        $this->PROVPELAYANAN_KDPROVIDER->LinkCustomAttributes = "";
        $this->PROVPELAYANAN_KDPROVIDER->HrefValue = "";
        $this->PROVPELAYANAN_KDPROVIDER->TooltipValue = "";

        // PROVPELAYANAN_NMCABANG
        $this->PROVPELAYANAN_NMCABANG->LinkCustomAttributes = "";
        $this->PROVPELAYANAN_NMCABANG->HrefValue = "";
        $this->PROVPELAYANAN_NMCABANG->TooltipValue = "";

        // PROVPELAYANAN_NMPROVIDER
        $this->PROVPELAYANAN_NMPROVIDER->LinkCustomAttributes = "";
        $this->PROVPELAYANAN_NMPROVIDER->HrefValue = "";
        $this->PROVPELAYANAN_NMPROVIDER->TooltipValue = "";

        // PROVRUJUKAN_KDCABANG
        $this->PROVRUJUKAN_KDCABANG->LinkCustomAttributes = "";
        $this->PROVRUJUKAN_KDCABANG->HrefValue = "";
        $this->PROVRUJUKAN_KDCABANG->TooltipValue = "";

        // PROVRUJUKAN_KDPROVIDER
        $this->PROVRUJUKAN_KDPROVIDER->LinkCustomAttributes = "";
        $this->PROVRUJUKAN_KDPROVIDER->HrefValue = "";
        $this->PROVRUJUKAN_KDPROVIDER->TooltipValue = "";

        // PROVRUJUKAN_NMCABANG
        $this->PROVRUJUKAN_NMCABANG->LinkCustomAttributes = "";
        $this->PROVRUJUKAN_NMCABANG->HrefValue = "";
        $this->PROVRUJUKAN_NMCABANG->TooltipValue = "";

        // PROVRUJUKAN_NMPROVIDER
        $this->PROVRUJUKAN_NMPROVIDER->LinkCustomAttributes = "";
        $this->PROVRUJUKAN_NMPROVIDER->HrefValue = "";
        $this->PROVRUJUKAN_NMPROVIDER->TooltipValue = "";

        // KDSTATSEP
        $this->KDSTATSEP->LinkCustomAttributes = "";
        $this->KDSTATSEP->HrefValue = "";
        $this->KDSTATSEP->TooltipValue = "";

        // NMSTATSEP
        $this->NMSTATSEP->LinkCustomAttributes = "";
        $this->NMSTATSEP->HrefValue = "";
        $this->NMSTATSEP->TooltipValue = "";

        // KDCOB
        $this->KDCOB->LinkCustomAttributes = "";
        $this->KDCOB->HrefValue = "";
        $this->KDCOB->TooltipValue = "";

        // NMCOB
        $this->NMCOB->LinkCustomAttributes = "";
        $this->NMCOB->HrefValue = "";
        $this->NMCOB->TooltipValue = "";

        // TGLPULANG
        $this->TGLPULANG->LinkCustomAttributes = "";
        $this->TGLPULANG->HrefValue = "";
        $this->TGLPULANG->TooltipValue = "";

        // TGLRUJUKAN
        $this->TGLRUJUKAN->LinkCustomAttributes = "";
        $this->TGLRUJUKAN->HrefValue = "";
        $this->TGLRUJUKAN->TooltipValue = "";

        // TGLSEP
        $this->TGLSEP->LinkCustomAttributes = "";
        $this->TGLSEP->HrefValue = "";
        $this->TGLSEP->TooltipValue = "";

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

        // RESPONDETAILSEP
        $this->RESPONDETAILSEP->LinkCustomAttributes = "";
        $this->RESPONDETAILSEP->HrefValue = "";
        $this->RESPONDETAILSEP->TooltipValue = "";

        // DINSOS
        $this->DINSOS->LinkCustomAttributes = "";
        $this->DINSOS->HrefValue = "";
        $this->DINSOS->TooltipValue = "";

        // PROLANISPRB
        $this->PROLANISPRB->LinkCustomAttributes = "";
        $this->PROLANISPRB->HrefValue = "";
        $this->PROLANISPRB->TooltipValue = "";

        // NOSKTM
        $this->NOSKTM->LinkCustomAttributes = "";
        $this->NOSKTM->HrefValue = "";
        $this->NOSKTM->TooltipValue = "";

        // SEXNAME
        $this->SEXNAME->LinkCustomAttributes = "";
        $this->SEXNAME->HrefValue = "";
        $this->SEXNAME->TooltipValue = "";

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

        // NOSEP
        $this->NOSEP->EditAttrs["class"] = "form-control";
        $this->NOSEP->EditCustomAttributes = "";
        if (!$this->NOSEP->Raw) {
            $this->NOSEP->CurrentValue = HtmlDecode($this->NOSEP->CurrentValue);
        }
        $this->NOSEP->EditValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->PlaceHolder = RemoveHtml($this->NOSEP->caption());

        // BYTAGIHAN
        $this->BYTAGIHAN->EditAttrs["class"] = "form-control";
        $this->BYTAGIHAN->EditCustomAttributes = "";
        if (!$this->BYTAGIHAN->Raw) {
            $this->BYTAGIHAN->CurrentValue = HtmlDecode($this->BYTAGIHAN->CurrentValue);
        }
        $this->BYTAGIHAN->EditValue = $this->BYTAGIHAN->CurrentValue;
        $this->BYTAGIHAN->PlaceHolder = RemoveHtml($this->BYTAGIHAN->caption());

        // CATATAN
        $this->CATATAN->EditAttrs["class"] = "form-control";
        $this->CATATAN->EditCustomAttributes = "";
        if (!$this->CATATAN->Raw) {
            $this->CATATAN->CurrentValue = HtmlDecode($this->CATATAN->CurrentValue);
        }
        $this->CATATAN->EditValue = $this->CATATAN->CurrentValue;
        $this->CATATAN->PlaceHolder = RemoveHtml($this->CATATAN->caption());

        // KDDIAG
        $this->KDDIAG->EditAttrs["class"] = "form-control";
        $this->KDDIAG->EditCustomAttributes = "";
        if (!$this->KDDIAG->Raw) {
            $this->KDDIAG->CurrentValue = HtmlDecode($this->KDDIAG->CurrentValue);
        }
        $this->KDDIAG->EditValue = $this->KDDIAG->CurrentValue;
        $this->KDDIAG->PlaceHolder = RemoveHtml($this->KDDIAG->caption());

        // NMDIAG
        $this->NMDIAG->EditAttrs["class"] = "form-control";
        $this->NMDIAG->EditCustomAttributes = "";
        if (!$this->NMDIAG->Raw) {
            $this->NMDIAG->CurrentValue = HtmlDecode($this->NMDIAG->CurrentValue);
        }
        $this->NMDIAG->EditValue = $this->NMDIAG->CurrentValue;
        $this->NMDIAG->PlaceHolder = RemoveHtml($this->NMDIAG->caption());

        // JNSPELAYANAN
        $this->JNSPELAYANAN->EditAttrs["class"] = "form-control";
        $this->JNSPELAYANAN->EditCustomAttributes = "";
        if (!$this->JNSPELAYANAN->Raw) {
            $this->JNSPELAYANAN->CurrentValue = HtmlDecode($this->JNSPELAYANAN->CurrentValue);
        }
        $this->JNSPELAYANAN->EditValue = $this->JNSPELAYANAN->CurrentValue;
        $this->JNSPELAYANAN->PlaceHolder = RemoveHtml($this->JNSPELAYANAN->caption());

        // KLSRAWAT_KDKELAS
        $this->KLSRAWAT_KDKELAS->EditAttrs["class"] = "form-control";
        $this->KLSRAWAT_KDKELAS->EditCustomAttributes = "";
        if (!$this->KLSRAWAT_KDKELAS->Raw) {
            $this->KLSRAWAT_KDKELAS->CurrentValue = HtmlDecode($this->KLSRAWAT_KDKELAS->CurrentValue);
        }
        $this->KLSRAWAT_KDKELAS->EditValue = $this->KLSRAWAT_KDKELAS->CurrentValue;
        $this->KLSRAWAT_KDKELAS->PlaceHolder = RemoveHtml($this->KLSRAWAT_KDKELAS->caption());

        // KLSRAWAT_NMKELAS
        $this->KLSRAWAT_NMKELAS->EditAttrs["class"] = "form-control";
        $this->KLSRAWAT_NMKELAS->EditCustomAttributes = "";
        if (!$this->KLSRAWAT_NMKELAS->Raw) {
            $this->KLSRAWAT_NMKELAS->CurrentValue = HtmlDecode($this->KLSRAWAT_NMKELAS->CurrentValue);
        }
        $this->KLSRAWAT_NMKELAS->EditValue = $this->KLSRAWAT_NMKELAS->CurrentValue;
        $this->KLSRAWAT_NMKELAS->PlaceHolder = RemoveHtml($this->KLSRAWAT_NMKELAS->caption());

        // LAKALANTAS_KET
        $this->LAKALANTAS_KET->EditAttrs["class"] = "form-control";
        $this->LAKALANTAS_KET->EditCustomAttributes = "";
        if (!$this->LAKALANTAS_KET->Raw) {
            $this->LAKALANTAS_KET->CurrentValue = HtmlDecode($this->LAKALANTAS_KET->CurrentValue);
        }
        $this->LAKALANTAS_KET->EditValue = $this->LAKALANTAS_KET->CurrentValue;
        $this->LAKALANTAS_KET->PlaceHolder = RemoveHtml($this->LAKALANTAS_KET->caption());

        // LAKALANTAS_STATUS
        $this->LAKALANTAS_STATUS->EditAttrs["class"] = "form-control";
        $this->LAKALANTAS_STATUS->EditCustomAttributes = "";
        if (!$this->LAKALANTAS_STATUS->Raw) {
            $this->LAKALANTAS_STATUS->CurrentValue = HtmlDecode($this->LAKALANTAS_STATUS->CurrentValue);
        }
        $this->LAKALANTAS_STATUS->EditValue = $this->LAKALANTAS_STATUS->CurrentValue;
        $this->LAKALANTAS_STATUS->PlaceHolder = RemoveHtml($this->LAKALANTAS_STATUS->caption());

        // NORUJUKAN
        $this->NORUJUKAN->EditAttrs["class"] = "form-control";
        $this->NORUJUKAN->EditCustomAttributes = "";
        if (!$this->NORUJUKAN->Raw) {
            $this->NORUJUKAN->CurrentValue = HtmlDecode($this->NORUJUKAN->CurrentValue);
        }
        $this->NORUJUKAN->EditValue = $this->NORUJUKAN->CurrentValue;
        $this->NORUJUKAN->PlaceHolder = RemoveHtml($this->NORUJUKAN->caption());

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

        // KLSTANGGUNGAN_KDKELAS
        $this->KLSTANGGUNGAN_KDKELAS->EditAttrs["class"] = "form-control";
        $this->KLSTANGGUNGAN_KDKELAS->EditCustomAttributes = "";
        if (!$this->KLSTANGGUNGAN_KDKELAS->Raw) {
            $this->KLSTANGGUNGAN_KDKELAS->CurrentValue = HtmlDecode($this->KLSTANGGUNGAN_KDKELAS->CurrentValue);
        }
        $this->KLSTANGGUNGAN_KDKELAS->EditValue = $this->KLSTANGGUNGAN_KDKELAS->CurrentValue;
        $this->KLSTANGGUNGAN_KDKELAS->PlaceHolder = RemoveHtml($this->KLSTANGGUNGAN_KDKELAS->caption());

        // KLSTANGGUNGAN_NMKELAS
        $this->KLSTANGGUNGAN_NMKELAS->EditAttrs["class"] = "form-control";
        $this->KLSTANGGUNGAN_NMKELAS->EditCustomAttributes = "";
        if (!$this->KLSTANGGUNGAN_NMKELAS->Raw) {
            $this->KLSTANGGUNGAN_NMKELAS->CurrentValue = HtmlDecode($this->KLSTANGGUNGAN_NMKELAS->CurrentValue);
        }
        $this->KLSTANGGUNGAN_NMKELAS->EditValue = $this->KLSTANGGUNGAN_NMKELAS->CurrentValue;
        $this->KLSTANGGUNGAN_NMKELAS->PlaceHolder = RemoveHtml($this->KLSTANGGUNGAN_NMKELAS->caption());

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

        // UMUR
        $this->UMUR->EditAttrs["class"] = "form-control";
        $this->UMUR->EditCustomAttributes = "";
        if (!$this->UMUR->Raw) {
            $this->UMUR->CurrentValue = HtmlDecode($this->UMUR->CurrentValue);
        }
        $this->UMUR->EditValue = $this->UMUR->CurrentValue;
        $this->UMUR->PlaceHolder = RemoveHtml($this->UMUR->caption());

        // POLITUJUAN_KDPOLI
        $this->POLITUJUAN_KDPOLI->EditAttrs["class"] = "form-control";
        $this->POLITUJUAN_KDPOLI->EditCustomAttributes = "";
        if (!$this->POLITUJUAN_KDPOLI->Raw) {
            $this->POLITUJUAN_KDPOLI->CurrentValue = HtmlDecode($this->POLITUJUAN_KDPOLI->CurrentValue);
        }
        $this->POLITUJUAN_KDPOLI->EditValue = $this->POLITUJUAN_KDPOLI->CurrentValue;
        $this->POLITUJUAN_KDPOLI->PlaceHolder = RemoveHtml($this->POLITUJUAN_KDPOLI->caption());

        // POLITUJUAN_NMPOLI
        $this->POLITUJUAN_NMPOLI->EditAttrs["class"] = "form-control";
        $this->POLITUJUAN_NMPOLI->EditCustomAttributes = "";
        if (!$this->POLITUJUAN_NMPOLI->Raw) {
            $this->POLITUJUAN_NMPOLI->CurrentValue = HtmlDecode($this->POLITUJUAN_NMPOLI->CurrentValue);
        }
        $this->POLITUJUAN_NMPOLI->EditValue = $this->POLITUJUAN_NMPOLI->CurrentValue;
        $this->POLITUJUAN_NMPOLI->PlaceHolder = RemoveHtml($this->POLITUJUAN_NMPOLI->caption());

        // PROVPELAYANAN_KDCABANG
        $this->PROVPELAYANAN_KDCABANG->EditAttrs["class"] = "form-control";
        $this->PROVPELAYANAN_KDCABANG->EditCustomAttributes = "";
        if (!$this->PROVPELAYANAN_KDCABANG->Raw) {
            $this->PROVPELAYANAN_KDCABANG->CurrentValue = HtmlDecode($this->PROVPELAYANAN_KDCABANG->CurrentValue);
        }
        $this->PROVPELAYANAN_KDCABANG->EditValue = $this->PROVPELAYANAN_KDCABANG->CurrentValue;
        $this->PROVPELAYANAN_KDCABANG->PlaceHolder = RemoveHtml($this->PROVPELAYANAN_KDCABANG->caption());

        // PROVPELAYANAN_KDPROVIDER
        $this->PROVPELAYANAN_KDPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVPELAYANAN_KDPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVPELAYANAN_KDPROVIDER->Raw) {
            $this->PROVPELAYANAN_KDPROVIDER->CurrentValue = HtmlDecode($this->PROVPELAYANAN_KDPROVIDER->CurrentValue);
        }
        $this->PROVPELAYANAN_KDPROVIDER->EditValue = $this->PROVPELAYANAN_KDPROVIDER->CurrentValue;
        $this->PROVPELAYANAN_KDPROVIDER->PlaceHolder = RemoveHtml($this->PROVPELAYANAN_KDPROVIDER->caption());

        // PROVPELAYANAN_NMCABANG
        $this->PROVPELAYANAN_NMCABANG->EditAttrs["class"] = "form-control";
        $this->PROVPELAYANAN_NMCABANG->EditCustomAttributes = "";
        if (!$this->PROVPELAYANAN_NMCABANG->Raw) {
            $this->PROVPELAYANAN_NMCABANG->CurrentValue = HtmlDecode($this->PROVPELAYANAN_NMCABANG->CurrentValue);
        }
        $this->PROVPELAYANAN_NMCABANG->EditValue = $this->PROVPELAYANAN_NMCABANG->CurrentValue;
        $this->PROVPELAYANAN_NMCABANG->PlaceHolder = RemoveHtml($this->PROVPELAYANAN_NMCABANG->caption());

        // PROVPELAYANAN_NMPROVIDER
        $this->PROVPELAYANAN_NMPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVPELAYANAN_NMPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVPELAYANAN_NMPROVIDER->Raw) {
            $this->PROVPELAYANAN_NMPROVIDER->CurrentValue = HtmlDecode($this->PROVPELAYANAN_NMPROVIDER->CurrentValue);
        }
        $this->PROVPELAYANAN_NMPROVIDER->EditValue = $this->PROVPELAYANAN_NMPROVIDER->CurrentValue;
        $this->PROVPELAYANAN_NMPROVIDER->PlaceHolder = RemoveHtml($this->PROVPELAYANAN_NMPROVIDER->caption());

        // PROVRUJUKAN_KDCABANG
        $this->PROVRUJUKAN_KDCABANG->EditAttrs["class"] = "form-control";
        $this->PROVRUJUKAN_KDCABANG->EditCustomAttributes = "";
        if (!$this->PROVRUJUKAN_KDCABANG->Raw) {
            $this->PROVRUJUKAN_KDCABANG->CurrentValue = HtmlDecode($this->PROVRUJUKAN_KDCABANG->CurrentValue);
        }
        $this->PROVRUJUKAN_KDCABANG->EditValue = $this->PROVRUJUKAN_KDCABANG->CurrentValue;
        $this->PROVRUJUKAN_KDCABANG->PlaceHolder = RemoveHtml($this->PROVRUJUKAN_KDCABANG->caption());

        // PROVRUJUKAN_KDPROVIDER
        $this->PROVRUJUKAN_KDPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVRUJUKAN_KDPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVRUJUKAN_KDPROVIDER->Raw) {
            $this->PROVRUJUKAN_KDPROVIDER->CurrentValue = HtmlDecode($this->PROVRUJUKAN_KDPROVIDER->CurrentValue);
        }
        $this->PROVRUJUKAN_KDPROVIDER->EditValue = $this->PROVRUJUKAN_KDPROVIDER->CurrentValue;
        $this->PROVRUJUKAN_KDPROVIDER->PlaceHolder = RemoveHtml($this->PROVRUJUKAN_KDPROVIDER->caption());

        // PROVRUJUKAN_NMCABANG
        $this->PROVRUJUKAN_NMCABANG->EditAttrs["class"] = "form-control";
        $this->PROVRUJUKAN_NMCABANG->EditCustomAttributes = "";
        if (!$this->PROVRUJUKAN_NMCABANG->Raw) {
            $this->PROVRUJUKAN_NMCABANG->CurrentValue = HtmlDecode($this->PROVRUJUKAN_NMCABANG->CurrentValue);
        }
        $this->PROVRUJUKAN_NMCABANG->EditValue = $this->PROVRUJUKAN_NMCABANG->CurrentValue;
        $this->PROVRUJUKAN_NMCABANG->PlaceHolder = RemoveHtml($this->PROVRUJUKAN_NMCABANG->caption());

        // PROVRUJUKAN_NMPROVIDER
        $this->PROVRUJUKAN_NMPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVRUJUKAN_NMPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVRUJUKAN_NMPROVIDER->Raw) {
            $this->PROVRUJUKAN_NMPROVIDER->CurrentValue = HtmlDecode($this->PROVRUJUKAN_NMPROVIDER->CurrentValue);
        }
        $this->PROVRUJUKAN_NMPROVIDER->EditValue = $this->PROVRUJUKAN_NMPROVIDER->CurrentValue;
        $this->PROVRUJUKAN_NMPROVIDER->PlaceHolder = RemoveHtml($this->PROVRUJUKAN_NMPROVIDER->caption());

        // KDSTATSEP
        $this->KDSTATSEP->EditAttrs["class"] = "form-control";
        $this->KDSTATSEP->EditCustomAttributes = "";
        if (!$this->KDSTATSEP->Raw) {
            $this->KDSTATSEP->CurrentValue = HtmlDecode($this->KDSTATSEP->CurrentValue);
        }
        $this->KDSTATSEP->EditValue = $this->KDSTATSEP->CurrentValue;
        $this->KDSTATSEP->PlaceHolder = RemoveHtml($this->KDSTATSEP->caption());

        // NMSTATSEP
        $this->NMSTATSEP->EditAttrs["class"] = "form-control";
        $this->NMSTATSEP->EditCustomAttributes = "";
        if (!$this->NMSTATSEP->Raw) {
            $this->NMSTATSEP->CurrentValue = HtmlDecode($this->NMSTATSEP->CurrentValue);
        }
        $this->NMSTATSEP->EditValue = $this->NMSTATSEP->CurrentValue;
        $this->NMSTATSEP->PlaceHolder = RemoveHtml($this->NMSTATSEP->caption());

        // KDCOB
        $this->KDCOB->EditAttrs["class"] = "form-control";
        $this->KDCOB->EditCustomAttributes = "";
        if (!$this->KDCOB->Raw) {
            $this->KDCOB->CurrentValue = HtmlDecode($this->KDCOB->CurrentValue);
        }
        $this->KDCOB->EditValue = $this->KDCOB->CurrentValue;
        $this->KDCOB->PlaceHolder = RemoveHtml($this->KDCOB->caption());

        // NMCOB
        $this->NMCOB->EditAttrs["class"] = "form-control";
        $this->NMCOB->EditCustomAttributes = "";
        if (!$this->NMCOB->Raw) {
            $this->NMCOB->CurrentValue = HtmlDecode($this->NMCOB->CurrentValue);
        }
        $this->NMCOB->EditValue = $this->NMCOB->CurrentValue;
        $this->NMCOB->PlaceHolder = RemoveHtml($this->NMCOB->caption());

        // TGLPULANG
        $this->TGLPULANG->EditAttrs["class"] = "form-control";
        $this->TGLPULANG->EditCustomAttributes = "";
        $this->TGLPULANG->EditValue = FormatDateTime($this->TGLPULANG->CurrentValue, 8);
        $this->TGLPULANG->PlaceHolder = RemoveHtml($this->TGLPULANG->caption());

        // TGLRUJUKAN
        $this->TGLRUJUKAN->EditAttrs["class"] = "form-control";
        $this->TGLRUJUKAN->EditCustomAttributes = "";
        $this->TGLRUJUKAN->EditValue = FormatDateTime($this->TGLRUJUKAN->CurrentValue, 8);
        $this->TGLRUJUKAN->PlaceHolder = RemoveHtml($this->TGLRUJUKAN->caption());

        // TGLSEP
        $this->TGLSEP->EditAttrs["class"] = "form-control";
        $this->TGLSEP->EditCustomAttributes = "";
        $this->TGLSEP->EditValue = FormatDateTime($this->TGLSEP->CurrentValue, 8);
        $this->TGLSEP->PlaceHolder = RemoveHtml($this->TGLSEP->caption());

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

        // RESPONDETAILSEP
        $this->RESPONDETAILSEP->EditAttrs["class"] = "form-control";
        $this->RESPONDETAILSEP->EditCustomAttributes = "";
        $this->RESPONDETAILSEP->EditValue = $this->RESPONDETAILSEP->CurrentValue;
        $this->RESPONDETAILSEP->PlaceHolder = RemoveHtml($this->RESPONDETAILSEP->caption());

        // DINSOS
        $this->DINSOS->EditAttrs["class"] = "form-control";
        $this->DINSOS->EditCustomAttributes = "";
        if (!$this->DINSOS->Raw) {
            $this->DINSOS->CurrentValue = HtmlDecode($this->DINSOS->CurrentValue);
        }
        $this->DINSOS->EditValue = $this->DINSOS->CurrentValue;
        $this->DINSOS->PlaceHolder = RemoveHtml($this->DINSOS->caption());

        // PROLANISPRB
        $this->PROLANISPRB->EditAttrs["class"] = "form-control";
        $this->PROLANISPRB->EditCustomAttributes = "";
        if (!$this->PROLANISPRB->Raw) {
            $this->PROLANISPRB->CurrentValue = HtmlDecode($this->PROLANISPRB->CurrentValue);
        }
        $this->PROLANISPRB->EditValue = $this->PROLANISPRB->CurrentValue;
        $this->PROLANISPRB->PlaceHolder = RemoveHtml($this->PROLANISPRB->caption());

        // NOSKTM
        $this->NOSKTM->EditAttrs["class"] = "form-control";
        $this->NOSKTM->EditCustomAttributes = "";
        if (!$this->NOSKTM->Raw) {
            $this->NOSKTM->CurrentValue = HtmlDecode($this->NOSKTM->CurrentValue);
        }
        $this->NOSKTM->EditValue = $this->NOSKTM->CurrentValue;
        $this->NOSKTM->PlaceHolder = RemoveHtml($this->NOSKTM->caption());

        // SEXNAME
        $this->SEXNAME->EditAttrs["class"] = "form-control";
        $this->SEXNAME->EditCustomAttributes = "";
        if (!$this->SEXNAME->Raw) {
            $this->SEXNAME->CurrentValue = HtmlDecode($this->SEXNAME->CurrentValue);
        }
        $this->SEXNAME->EditValue = $this->SEXNAME->CurrentValue;
        $this->SEXNAME->PlaceHolder = RemoveHtml($this->SEXNAME->caption());

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
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->BYTAGIHAN);
                    $doc->exportCaption($this->CATATAN);
                    $doc->exportCaption($this->KDDIAG);
                    $doc->exportCaption($this->NMDIAG);
                    $doc->exportCaption($this->JNSPELAYANAN);
                    $doc->exportCaption($this->KLSRAWAT_KDKELAS);
                    $doc->exportCaption($this->KLSRAWAT_NMKELAS);
                    $doc->exportCaption($this->LAKALANTAS_KET);
                    $doc->exportCaption($this->LAKALANTAS_STATUS);
                    $doc->exportCaption($this->NORUJUKAN);
                    $doc->exportCaption($this->KDJNSPESERTA);
                    $doc->exportCaption($this->NMJNSPESERTA);
                    $doc->exportCaption($this->KLSTANGGUNGAN_KDKELAS);
                    $doc->exportCaption($this->KLSTANGGUNGAN_NMKELAS);
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
                    $doc->exportCaption($this->TGLCETAKKARTU);
                    $doc->exportCaption($this->TGLLAHIR);
                    $doc->exportCaption($this->TGLTAT);
                    $doc->exportCaption($this->TGLTMT);
                    $doc->exportCaption($this->UMUR);
                    $doc->exportCaption($this->POLITUJUAN_KDPOLI);
                    $doc->exportCaption($this->POLITUJUAN_NMPOLI);
                    $doc->exportCaption($this->PROVPELAYANAN_KDCABANG);
                    $doc->exportCaption($this->PROVPELAYANAN_KDPROVIDER);
                    $doc->exportCaption($this->PROVPELAYANAN_NMCABANG);
                    $doc->exportCaption($this->PROVPELAYANAN_NMPROVIDER);
                    $doc->exportCaption($this->PROVRUJUKAN_KDCABANG);
                    $doc->exportCaption($this->PROVRUJUKAN_KDPROVIDER);
                    $doc->exportCaption($this->PROVRUJUKAN_NMCABANG);
                    $doc->exportCaption($this->PROVRUJUKAN_NMPROVIDER);
                    $doc->exportCaption($this->KDSTATSEP);
                    $doc->exportCaption($this->NMSTATSEP);
                    $doc->exportCaption($this->KDCOB);
                    $doc->exportCaption($this->NMCOB);
                    $doc->exportCaption($this->TGLPULANG);
                    $doc->exportCaption($this->TGLRUJUKAN);
                    $doc->exportCaption($this->TGLSEP);
                    $doc->exportCaption($this->REST_CODE);
                    $doc->exportCaption($this->REST_MESSAGE);
                    $doc->exportCaption($this->REST_DATE);
                    $doc->exportCaption($this->REST_METHOD);
                    $doc->exportCaption($this->RESPONDETAILSEP);
                    $doc->exportCaption($this->DINSOS);
                    $doc->exportCaption($this->PROLANISPRB);
                    $doc->exportCaption($this->NOSKTM);
                    $doc->exportCaption($this->SEXNAME);
                } else {
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->BYTAGIHAN);
                    $doc->exportCaption($this->CATATAN);
                    $doc->exportCaption($this->KDDIAG);
                    $doc->exportCaption($this->NMDIAG);
                    $doc->exportCaption($this->JNSPELAYANAN);
                    $doc->exportCaption($this->KLSRAWAT_KDKELAS);
                    $doc->exportCaption($this->KLSRAWAT_NMKELAS);
                    $doc->exportCaption($this->LAKALANTAS_KET);
                    $doc->exportCaption($this->LAKALANTAS_STATUS);
                    $doc->exportCaption($this->NORUJUKAN);
                    $doc->exportCaption($this->KDJNSPESERTA);
                    $doc->exportCaption($this->NMJNSPESERTA);
                    $doc->exportCaption($this->KLSTANGGUNGAN_KDKELAS);
                    $doc->exportCaption($this->KLSTANGGUNGAN_NMKELAS);
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
                    $doc->exportCaption($this->TGLCETAKKARTU);
                    $doc->exportCaption($this->TGLLAHIR);
                    $doc->exportCaption($this->TGLTAT);
                    $doc->exportCaption($this->TGLTMT);
                    $doc->exportCaption($this->UMUR);
                    $doc->exportCaption($this->POLITUJUAN_KDPOLI);
                    $doc->exportCaption($this->POLITUJUAN_NMPOLI);
                    $doc->exportCaption($this->PROVPELAYANAN_KDCABANG);
                    $doc->exportCaption($this->PROVPELAYANAN_KDPROVIDER);
                    $doc->exportCaption($this->PROVPELAYANAN_NMCABANG);
                    $doc->exportCaption($this->PROVPELAYANAN_NMPROVIDER);
                    $doc->exportCaption($this->PROVRUJUKAN_KDCABANG);
                    $doc->exportCaption($this->PROVRUJUKAN_KDPROVIDER);
                    $doc->exportCaption($this->PROVRUJUKAN_NMCABANG);
                    $doc->exportCaption($this->PROVRUJUKAN_NMPROVIDER);
                    $doc->exportCaption($this->KDSTATSEP);
                    $doc->exportCaption($this->NMSTATSEP);
                    $doc->exportCaption($this->KDCOB);
                    $doc->exportCaption($this->NMCOB);
                    $doc->exportCaption($this->TGLPULANG);
                    $doc->exportCaption($this->TGLRUJUKAN);
                    $doc->exportCaption($this->TGLSEP);
                    $doc->exportCaption($this->REST_CODE);
                    $doc->exportCaption($this->REST_MESSAGE);
                    $doc->exportCaption($this->REST_DATE);
                    $doc->exportCaption($this->REST_METHOD);
                    $doc->exportCaption($this->DINSOS);
                    $doc->exportCaption($this->PROLANISPRB);
                    $doc->exportCaption($this->NOSKTM);
                    $doc->exportCaption($this->SEXNAME);
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
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->BYTAGIHAN);
                        $doc->exportField($this->CATATAN);
                        $doc->exportField($this->KDDIAG);
                        $doc->exportField($this->NMDIAG);
                        $doc->exportField($this->JNSPELAYANAN);
                        $doc->exportField($this->KLSRAWAT_KDKELAS);
                        $doc->exportField($this->KLSRAWAT_NMKELAS);
                        $doc->exportField($this->LAKALANTAS_KET);
                        $doc->exportField($this->LAKALANTAS_STATUS);
                        $doc->exportField($this->NORUJUKAN);
                        $doc->exportField($this->KDJNSPESERTA);
                        $doc->exportField($this->NMJNSPESERTA);
                        $doc->exportField($this->KLSTANGGUNGAN_KDKELAS);
                        $doc->exportField($this->KLSTANGGUNGAN_NMKELAS);
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
                        $doc->exportField($this->TGLCETAKKARTU);
                        $doc->exportField($this->TGLLAHIR);
                        $doc->exportField($this->TGLTAT);
                        $doc->exportField($this->TGLTMT);
                        $doc->exportField($this->UMUR);
                        $doc->exportField($this->POLITUJUAN_KDPOLI);
                        $doc->exportField($this->POLITUJUAN_NMPOLI);
                        $doc->exportField($this->PROVPELAYANAN_KDCABANG);
                        $doc->exportField($this->PROVPELAYANAN_KDPROVIDER);
                        $doc->exportField($this->PROVPELAYANAN_NMCABANG);
                        $doc->exportField($this->PROVPELAYANAN_NMPROVIDER);
                        $doc->exportField($this->PROVRUJUKAN_KDCABANG);
                        $doc->exportField($this->PROVRUJUKAN_KDPROVIDER);
                        $doc->exportField($this->PROVRUJUKAN_NMCABANG);
                        $doc->exportField($this->PROVRUJUKAN_NMPROVIDER);
                        $doc->exportField($this->KDSTATSEP);
                        $doc->exportField($this->NMSTATSEP);
                        $doc->exportField($this->KDCOB);
                        $doc->exportField($this->NMCOB);
                        $doc->exportField($this->TGLPULANG);
                        $doc->exportField($this->TGLRUJUKAN);
                        $doc->exportField($this->TGLSEP);
                        $doc->exportField($this->REST_CODE);
                        $doc->exportField($this->REST_MESSAGE);
                        $doc->exportField($this->REST_DATE);
                        $doc->exportField($this->REST_METHOD);
                        $doc->exportField($this->RESPONDETAILSEP);
                        $doc->exportField($this->DINSOS);
                        $doc->exportField($this->PROLANISPRB);
                        $doc->exportField($this->NOSKTM);
                        $doc->exportField($this->SEXNAME);
                    } else {
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->BYTAGIHAN);
                        $doc->exportField($this->CATATAN);
                        $doc->exportField($this->KDDIAG);
                        $doc->exportField($this->NMDIAG);
                        $doc->exportField($this->JNSPELAYANAN);
                        $doc->exportField($this->KLSRAWAT_KDKELAS);
                        $doc->exportField($this->KLSRAWAT_NMKELAS);
                        $doc->exportField($this->LAKALANTAS_KET);
                        $doc->exportField($this->LAKALANTAS_STATUS);
                        $doc->exportField($this->NORUJUKAN);
                        $doc->exportField($this->KDJNSPESERTA);
                        $doc->exportField($this->NMJNSPESERTA);
                        $doc->exportField($this->KLSTANGGUNGAN_KDKELAS);
                        $doc->exportField($this->KLSTANGGUNGAN_NMKELAS);
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
                        $doc->exportField($this->TGLCETAKKARTU);
                        $doc->exportField($this->TGLLAHIR);
                        $doc->exportField($this->TGLTAT);
                        $doc->exportField($this->TGLTMT);
                        $doc->exportField($this->UMUR);
                        $doc->exportField($this->POLITUJUAN_KDPOLI);
                        $doc->exportField($this->POLITUJUAN_NMPOLI);
                        $doc->exportField($this->PROVPELAYANAN_KDCABANG);
                        $doc->exportField($this->PROVPELAYANAN_KDPROVIDER);
                        $doc->exportField($this->PROVPELAYANAN_NMCABANG);
                        $doc->exportField($this->PROVPELAYANAN_NMPROVIDER);
                        $doc->exportField($this->PROVRUJUKAN_KDCABANG);
                        $doc->exportField($this->PROVRUJUKAN_KDPROVIDER);
                        $doc->exportField($this->PROVRUJUKAN_NMCABANG);
                        $doc->exportField($this->PROVRUJUKAN_NMPROVIDER);
                        $doc->exportField($this->KDSTATSEP);
                        $doc->exportField($this->NMSTATSEP);
                        $doc->exportField($this->KDCOB);
                        $doc->exportField($this->NMCOB);
                        $doc->exportField($this->TGLPULANG);
                        $doc->exportField($this->TGLRUJUKAN);
                        $doc->exportField($this->TGLSEP);
                        $doc->exportField($this->REST_CODE);
                        $doc->exportField($this->REST_MESSAGE);
                        $doc->exportField($this->REST_DATE);
                        $doc->exportField($this->REST_METHOD);
                        $doc->exportField($this->DINSOS);
                        $doc->exportField($this->PROLANISPRB);
                        $doc->exportField($this->NOSKTM);
                        $doc->exportField($this->SEXNAME);
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
