<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for INASIS_RUJUKAN
 */
class InasisRujukan extends DbTable
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
    public $VISIT_ID;
    public $NOSEP;
    public $TGLSEP;
    public $TGLRUJUKAN;
    public $TIPERUJUKAN;
    public $KDJNSPELAYANAN;
    public $JNSPELAYANAN;
    public $CATATAN;
    public $KELUHAN;
    public $PEMFISIKLAIN;
    public $KDDIAG;
    public $NMDIAG;
    public $POLIRUJUKAN_KDPOLI;
    public $POLIRUJUKAN_NMPOLI;
    public $PROVRUJUKAN_KDPROVIDER;
    public $PROVRUJUKAN_NMPROVIDER;
    public $PROVKUNJUNGAN_KDPROVIDER;
    public $PROVKUNJUNGAN_NMPROVIDER;
    public $NOKUNJUNGAN;
    public $NOSURANSI;
    public $NMASURANSI;
    public $KLSTANGGUNGAN_KDKELAS;
    public $KLSTANGGUNGAN_NMKELAS;
    public $KDJNSPESERTA;
    public $NMJNSPESERTA;
    public $SEX;
    public $NAMA;
    public $NOKARTU;
    public $NOMR;
    public $TGLLAHIR;
    public $MODIFIED_BY;
    public $MODIFIED_DATE;
    public $RESPONPOST;
    public $RESPONPUT;
    public $RESPONDEL;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'INASIS_RUJUKAN';
        $this->TableName = 'INASIS_RUJUKAN';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[INASIS_RUJUKAN]";
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

        // VISIT_ID
        $this->VISIT_ID = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->IsPrimaryKey = true; // Primary key field
        $this->VISIT_ID->Nullable = false; // NOT NULL field
        $this->VISIT_ID->Required = true; // Required field
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // NOSEP
        $this->NOSEP = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NOSEP', 'NOSEP', '[NOSEP]', '[NOSEP]', 200, 50, -1, false, '[NOSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSEP->IsPrimaryKey = true; // Primary key field
        $this->NOSEP->Nullable = false; // NOT NULL field
        $this->NOSEP->Required = true; // Required field
        $this->NOSEP->Sortable = true; // Allow sort
        $this->NOSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSEP->Param, "CustomMsg");
        $this->Fields['NOSEP'] = &$this->NOSEP;

        // TGLSEP
        $this->TGLSEP = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_TGLSEP', 'TGLSEP', '[TGLSEP]', CastDateFieldForLike("[TGLSEP]", 0, "DB"), 135, 8, 0, false, '[TGLSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLSEP->Nullable = false; // NOT NULL field
        $this->TGLSEP->Required = true; // Required field
        $this->TGLSEP->Sortable = true; // Allow sort
        $this->TGLSEP->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLSEP->Param, "CustomMsg");
        $this->Fields['TGLSEP'] = &$this->TGLSEP;

        // TGLRUJUKAN
        $this->TGLRUJUKAN = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_TGLRUJUKAN', 'TGLRUJUKAN', '[TGLRUJUKAN]', CastDateFieldForLike("[TGLRUJUKAN]", 0, "DB"), 135, 8, 0, false, '[TGLRUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLRUJUKAN->Nullable = false; // NOT NULL field
        $this->TGLRUJUKAN->Required = true; // Required field
        $this->TGLRUJUKAN->Sortable = true; // Allow sort
        $this->TGLRUJUKAN->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLRUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLRUJUKAN->Param, "CustomMsg");
        $this->Fields['TGLRUJUKAN'] = &$this->TGLRUJUKAN;

        // TIPERUJUKAN
        $this->TIPERUJUKAN = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_TIPERUJUKAN', 'TIPERUJUKAN', '[TIPERUJUKAN]', '[TIPERUJUKAN]', 200, 1, -1, false, '[TIPERUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TIPERUJUKAN->Sortable = true; // Allow sort
        $this->TIPERUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TIPERUJUKAN->Param, "CustomMsg");
        $this->Fields['TIPERUJUKAN'] = &$this->TIPERUJUKAN;

        // KDJNSPELAYANAN
        $this->KDJNSPELAYANAN = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_KDJNSPELAYANAN', 'KDJNSPELAYANAN', '[KDJNSPELAYANAN]', '[KDJNSPELAYANAN]', 200, 1, -1, false, '[KDJNSPELAYANAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDJNSPELAYANAN->Sortable = true; // Allow sort
        $this->KDJNSPELAYANAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDJNSPELAYANAN->Param, "CustomMsg");
        $this->Fields['KDJNSPELAYANAN'] = &$this->KDJNSPELAYANAN;

        // JNSPELAYANAN
        $this->JNSPELAYANAN = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_JNSPELAYANAN', 'JNSPELAYANAN', '[JNSPELAYANAN]', '[JNSPELAYANAN]', 200, 100, -1, false, '[JNSPELAYANAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JNSPELAYANAN->Sortable = true; // Allow sort
        $this->JNSPELAYANAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JNSPELAYANAN->Param, "CustomMsg");
        $this->Fields['JNSPELAYANAN'] = &$this->JNSPELAYANAN;

        // CATATAN
        $this->CATATAN = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_CATATAN', 'CATATAN', '[CATATAN]', '[CATATAN]', 200, 250, -1, false, '[CATATAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CATATAN->Sortable = true; // Allow sort
        $this->CATATAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CATATAN->Param, "CustomMsg");
        $this->Fields['CATATAN'] = &$this->CATATAN;

        // KELUHAN
        $this->KELUHAN = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_KELUHAN', 'KELUHAN', '[KELUHAN]', '[KELUHAN]', 200, 250, -1, false, '[KELUHAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELUHAN->Sortable = true; // Allow sort
        $this->KELUHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELUHAN->Param, "CustomMsg");
        $this->Fields['KELUHAN'] = &$this->KELUHAN;

        // PEMFISIKLAIN
        $this->PEMFISIKLAIN = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_PEMFISIKLAIN', 'PEMFISIKLAIN', '[PEMFISIKLAIN]', '[PEMFISIKLAIN]', 200, 250, -1, false, '[PEMFISIKLAIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEMFISIKLAIN->Sortable = true; // Allow sort
        $this->PEMFISIKLAIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEMFISIKLAIN->Param, "CustomMsg");
        $this->Fields['PEMFISIKLAIN'] = &$this->PEMFISIKLAIN;

        // KDDIAG
        $this->KDDIAG = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_KDDIAG', 'KDDIAG', '[KDDIAG]', '[KDDIAG]', 200, 10, -1, false, '[KDDIAG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDDIAG->Sortable = true; // Allow sort
        $this->KDDIAG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDDIAG->Param, "CustomMsg");
        $this->Fields['KDDIAG'] = &$this->KDDIAG;

        // NMDIAG
        $this->NMDIAG = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NMDIAG', 'NMDIAG', '[NMDIAG]', '[NMDIAG]', 200, 250, -1, false, '[NMDIAG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMDIAG->Sortable = true; // Allow sort
        $this->NMDIAG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMDIAG->Param, "CustomMsg");
        $this->Fields['NMDIAG'] = &$this->NMDIAG;

        // POLIRUJUKAN_KDPOLI
        $this->POLIRUJUKAN_KDPOLI = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_POLIRUJUKAN_KDPOLI', 'POLIRUJUKAN_KDPOLI', '[POLIRUJUKAN_KDPOLI]', '[POLIRUJUKAN_KDPOLI]', 200, 3, -1, false, '[POLIRUJUKAN_KDPOLI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POLIRUJUKAN_KDPOLI->Nullable = false; // NOT NULL field
        $this->POLIRUJUKAN_KDPOLI->Required = true; // Required field
        $this->POLIRUJUKAN_KDPOLI->Sortable = true; // Allow sort
        $this->POLIRUJUKAN_KDPOLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POLIRUJUKAN_KDPOLI->Param, "CustomMsg");
        $this->Fields['POLIRUJUKAN_KDPOLI'] = &$this->POLIRUJUKAN_KDPOLI;

        // POLIRUJUKAN_NMPOLI
        $this->POLIRUJUKAN_NMPOLI = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_POLIRUJUKAN_NMPOLI', 'POLIRUJUKAN_NMPOLI', '[POLIRUJUKAN_NMPOLI]', '[POLIRUJUKAN_NMPOLI]', 200, 200, -1, false, '[POLIRUJUKAN_NMPOLI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POLIRUJUKAN_NMPOLI->Sortable = true; // Allow sort
        $this->POLIRUJUKAN_NMPOLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POLIRUJUKAN_NMPOLI->Param, "CustomMsg");
        $this->Fields['POLIRUJUKAN_NMPOLI'] = &$this->POLIRUJUKAN_NMPOLI;

        // PROVRUJUKAN_KDPROVIDER
        $this->PROVRUJUKAN_KDPROVIDER = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_PROVRUJUKAN_KDPROVIDER', 'PROVRUJUKAN_KDPROVIDER', '[PROVRUJUKAN_KDPROVIDER]', '[PROVRUJUKAN_KDPROVIDER]', 200, 10, -1, false, '[PROVRUJUKAN_KDPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVRUJUKAN_KDPROVIDER->Sortable = true; // Allow sort
        $this->PROVRUJUKAN_KDPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVRUJUKAN_KDPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVRUJUKAN_KDPROVIDER'] = &$this->PROVRUJUKAN_KDPROVIDER;

        // PROVRUJUKAN_NMPROVIDER
        $this->PROVRUJUKAN_NMPROVIDER = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_PROVRUJUKAN_NMPROVIDER', 'PROVRUJUKAN_NMPROVIDER', '[PROVRUJUKAN_NMPROVIDER]', '[PROVRUJUKAN_NMPROVIDER]', 200, 200, -1, false, '[PROVRUJUKAN_NMPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVRUJUKAN_NMPROVIDER->Sortable = true; // Allow sort
        $this->PROVRUJUKAN_NMPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVRUJUKAN_NMPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVRUJUKAN_NMPROVIDER'] = &$this->PROVRUJUKAN_NMPROVIDER;

        // PROVKUNJUNGAN_KDPROVIDER
        $this->PROVKUNJUNGAN_KDPROVIDER = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_PROVKUNJUNGAN_KDPROVIDER', 'PROVKUNJUNGAN_KDPROVIDER', '[PROVKUNJUNGAN_KDPROVIDER]', '[PROVKUNJUNGAN_KDPROVIDER]', 200, 10, -1, false, '[PROVKUNJUNGAN_KDPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVKUNJUNGAN_KDPROVIDER->Sortable = true; // Allow sort
        $this->PROVKUNJUNGAN_KDPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVKUNJUNGAN_KDPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVKUNJUNGAN_KDPROVIDER'] = &$this->PROVKUNJUNGAN_KDPROVIDER;

        // PROVKUNJUNGAN_NMPROVIDER
        $this->PROVKUNJUNGAN_NMPROVIDER = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_PROVKUNJUNGAN_NMPROVIDER', 'PROVKUNJUNGAN_NMPROVIDER', '[PROVKUNJUNGAN_NMPROVIDER]', '[PROVKUNJUNGAN_NMPROVIDER]', 200, 200, -1, false, '[PROVKUNJUNGAN_NMPROVIDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVKUNJUNGAN_NMPROVIDER->Sortable = true; // Allow sort
        $this->PROVKUNJUNGAN_NMPROVIDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVKUNJUNGAN_NMPROVIDER->Param, "CustomMsg");
        $this->Fields['PROVKUNJUNGAN_NMPROVIDER'] = &$this->PROVKUNJUNGAN_NMPROVIDER;

        // NOKUNJUNGAN
        $this->NOKUNJUNGAN = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NOKUNJUNGAN', 'NOKUNJUNGAN', '[NOKUNJUNGAN]', '[NOKUNJUNGAN]', 200, 50, -1, false, '[NOKUNJUNGAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOKUNJUNGAN->Sortable = true; // Allow sort
        $this->NOKUNJUNGAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOKUNJUNGAN->Param, "CustomMsg");
        $this->Fields['NOKUNJUNGAN'] = &$this->NOKUNJUNGAN;

        // NOSURANSI
        $this->NOSURANSI = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NOSURANSI', 'NOSURANSI', '[NOSURANSI]', '[NOSURANSI]', 200, 50, -1, false, '[NOSURANSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSURANSI->Sortable = true; // Allow sort
        $this->NOSURANSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSURANSI->Param, "CustomMsg");
        $this->Fields['NOSURANSI'] = &$this->NOSURANSI;

        // NMASURANSI
        $this->NMASURANSI = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NMASURANSI', 'NMASURANSI', '[NMASURANSI]', '[NMASURANSI]', 200, 200, -1, false, '[NMASURANSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMASURANSI->Sortable = true; // Allow sort
        $this->NMASURANSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMASURANSI->Param, "CustomMsg");
        $this->Fields['NMASURANSI'] = &$this->NMASURANSI;

        // KLSTANGGUNGAN_KDKELAS
        $this->KLSTANGGUNGAN_KDKELAS = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_KLSTANGGUNGAN_KDKELAS', 'KLSTANGGUNGAN_KDKELAS', '[KLSTANGGUNGAN_KDKELAS]', '[KLSTANGGUNGAN_KDKELAS]', 200, 3, -1, false, '[KLSTANGGUNGAN_KDKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KLSTANGGUNGAN_KDKELAS->Sortable = true; // Allow sort
        $this->KLSTANGGUNGAN_KDKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KLSTANGGUNGAN_KDKELAS->Param, "CustomMsg");
        $this->Fields['KLSTANGGUNGAN_KDKELAS'] = &$this->KLSTANGGUNGAN_KDKELAS;

        // KLSTANGGUNGAN_NMKELAS
        $this->KLSTANGGUNGAN_NMKELAS = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_KLSTANGGUNGAN_NMKELAS', 'KLSTANGGUNGAN_NMKELAS', '[KLSTANGGUNGAN_NMKELAS]', '[KLSTANGGUNGAN_NMKELAS]', 200, 150, -1, false, '[KLSTANGGUNGAN_NMKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KLSTANGGUNGAN_NMKELAS->Sortable = true; // Allow sort
        $this->KLSTANGGUNGAN_NMKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KLSTANGGUNGAN_NMKELAS->Param, "CustomMsg");
        $this->Fields['KLSTANGGUNGAN_NMKELAS'] = &$this->KLSTANGGUNGAN_NMKELAS;

        // KDJNSPESERTA
        $this->KDJNSPESERTA = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_KDJNSPESERTA', 'KDJNSPESERTA', '[KDJNSPESERTA]', '[KDJNSPESERTA]', 200, 3, -1, false, '[KDJNSPESERTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDJNSPESERTA->Sortable = true; // Allow sort
        $this->KDJNSPESERTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDJNSPESERTA->Param, "CustomMsg");
        $this->Fields['KDJNSPESERTA'] = &$this->KDJNSPESERTA;

        // NMJNSPESERTA
        $this->NMJNSPESERTA = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NMJNSPESERTA', 'NMJNSPESERTA', '[NMJNSPESERTA]', '[NMJNSPESERTA]', 200, 150, -1, false, '[NMJNSPESERTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NMJNSPESERTA->Sortable = true; // Allow sort
        $this->NMJNSPESERTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NMJNSPESERTA->Param, "CustomMsg");
        $this->Fields['NMJNSPESERTA'] = &$this->NMJNSPESERTA;

        // SEX
        $this->SEX = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_SEX', 'SEX', '[SEX]', '[SEX]', 200, 3, -1, false, '[SEX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SEX->Sortable = true; // Allow sort
        $this->SEX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEX->Param, "CustomMsg");
        $this->Fields['SEX'] = &$this->SEX;

        // NAMA
        $this->NAMA = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NAMA', 'NAMA', '[NAMA]', '[NAMA]', 200, 250, -1, false, '[NAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA->Sortable = true; // Allow sort
        $this->NAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA->Param, "CustomMsg");
        $this->Fields['NAMA'] = &$this->NAMA;

        // NOKARTU
        $this->NOKARTU = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NOKARTU', 'NOKARTU', '[NOKARTU]', '[NOKARTU]', 200, 50, -1, false, '[NOKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOKARTU->Sortable = true; // Allow sort
        $this->NOKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOKARTU->Param, "CustomMsg");
        $this->Fields['NOKARTU'] = &$this->NOKARTU;

        // NOMR
        $this->NOMR = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_NOMR', 'NOMR', '[NOMR]', '[NOMR]', 200, 50, -1, false, '[NOMR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOMR->Sortable = true; // Allow sort
        $this->NOMR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOMR->Param, "CustomMsg");
        $this->Fields['NOMR'] = &$this->NOMR;

        // TGLLAHIR
        $this->TGLLAHIR = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_TGLLAHIR', 'TGLLAHIR', '[TGLLAHIR]', CastDateFieldForLike("[TGLLAHIR]", 0, "DB"), 135, 8, 0, false, '[TGLLAHIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLLAHIR->Sortable = true; // Allow sort
        $this->TGLLAHIR->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLLAHIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLLAHIR->Param, "CustomMsg");
        $this->Fields['TGLLAHIR'] = &$this->TGLLAHIR;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // RESPONPOST
        $this->RESPONPOST = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_RESPONPOST', 'RESPONPOST', '[RESPONPOST]', '[RESPONPOST]', 201, 0, -1, false, '[RESPONPOST]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONPOST->Sortable = true; // Allow sort
        $this->RESPONPOST->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONPOST->Param, "CustomMsg");
        $this->Fields['RESPONPOST'] = &$this->RESPONPOST;

        // RESPONPUT
        $this->RESPONPUT = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_RESPONPUT', 'RESPONPUT', '[RESPONPUT]', '[RESPONPUT]', 201, 0, -1, false, '[RESPONPUT]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONPUT->Sortable = true; // Allow sort
        $this->RESPONPUT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONPUT->Param, "CustomMsg");
        $this->Fields['RESPONPUT'] = &$this->RESPONPUT;

        // RESPONDEL
        $this->RESPONDEL = new DbField('INASIS_RUJUKAN', 'INASIS_RUJUKAN', 'x_RESPONDEL', 'RESPONDEL', '[RESPONDEL]', '[RESPONDEL]', 201, 0, -1, false, '[RESPONDEL]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONDEL->Sortable = true; // Allow sort
        $this->RESPONDEL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONDEL->Param, "CustomMsg");
        $this->Fields['RESPONDEL'] = &$this->RESPONDEL;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[INASIS_RUJUKAN]";
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
            if (array_key_exists('VISIT_ID', $rs)) {
                AddFilter($where, QuotedName('VISIT_ID', $this->Dbid) . '=' . QuotedValue($rs['VISIT_ID'], $this->VISIT_ID->DataType, $this->Dbid));
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
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->NOSEP->DbValue = $row['NOSEP'];
        $this->TGLSEP->DbValue = $row['TGLSEP'];
        $this->TGLRUJUKAN->DbValue = $row['TGLRUJUKAN'];
        $this->TIPERUJUKAN->DbValue = $row['TIPERUJUKAN'];
        $this->KDJNSPELAYANAN->DbValue = $row['KDJNSPELAYANAN'];
        $this->JNSPELAYANAN->DbValue = $row['JNSPELAYANAN'];
        $this->CATATAN->DbValue = $row['CATATAN'];
        $this->KELUHAN->DbValue = $row['KELUHAN'];
        $this->PEMFISIKLAIN->DbValue = $row['PEMFISIKLAIN'];
        $this->KDDIAG->DbValue = $row['KDDIAG'];
        $this->NMDIAG->DbValue = $row['NMDIAG'];
        $this->POLIRUJUKAN_KDPOLI->DbValue = $row['POLIRUJUKAN_KDPOLI'];
        $this->POLIRUJUKAN_NMPOLI->DbValue = $row['POLIRUJUKAN_NMPOLI'];
        $this->PROVRUJUKAN_KDPROVIDER->DbValue = $row['PROVRUJUKAN_KDPROVIDER'];
        $this->PROVRUJUKAN_NMPROVIDER->DbValue = $row['PROVRUJUKAN_NMPROVIDER'];
        $this->PROVKUNJUNGAN_KDPROVIDER->DbValue = $row['PROVKUNJUNGAN_KDPROVIDER'];
        $this->PROVKUNJUNGAN_NMPROVIDER->DbValue = $row['PROVKUNJUNGAN_NMPROVIDER'];
        $this->NOKUNJUNGAN->DbValue = $row['NOKUNJUNGAN'];
        $this->NOSURANSI->DbValue = $row['NOSURANSI'];
        $this->NMASURANSI->DbValue = $row['NMASURANSI'];
        $this->KLSTANGGUNGAN_KDKELAS->DbValue = $row['KLSTANGGUNGAN_KDKELAS'];
        $this->KLSTANGGUNGAN_NMKELAS->DbValue = $row['KLSTANGGUNGAN_NMKELAS'];
        $this->KDJNSPESERTA->DbValue = $row['KDJNSPESERTA'];
        $this->NMJNSPESERTA->DbValue = $row['NMJNSPESERTA'];
        $this->SEX->DbValue = $row['SEX'];
        $this->NAMA->DbValue = $row['NAMA'];
        $this->NOKARTU->DbValue = $row['NOKARTU'];
        $this->NOMR->DbValue = $row['NOMR'];
        $this->TGLLAHIR->DbValue = $row['TGLLAHIR'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->RESPONPOST->DbValue = $row['RESPONPOST'];
        $this->RESPONPUT->DbValue = $row['RESPONPUT'];
        $this->RESPONDEL->DbValue = $row['RESPONDEL'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[VISIT_ID] = '@VISIT_ID@' AND [NOSEP] = '@NOSEP@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->VISIT_ID->CurrentValue : $this->VISIT_ID->OldValue;
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
                $this->VISIT_ID->CurrentValue = $keys[0];
            } else {
                $this->VISIT_ID->OldValue = $keys[0];
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
            $val = array_key_exists('VISIT_ID', $row) ? $row['VISIT_ID'] : null;
        } else {
            $val = $this->VISIT_ID->OldValue !== null ? $this->VISIT_ID->OldValue : $this->VISIT_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@VISIT_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("InasisRujukanList");
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
        if ($pageName == "InasisRujukanView") {
            return $Language->phrase("View");
        } elseif ($pageName == "InasisRujukanEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "InasisRujukanAdd") {
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
                return "InasisRujukanView";
            case Config("API_ADD_ACTION"):
                return "InasisRujukanAdd";
            case Config("API_EDIT_ACTION"):
                return "InasisRujukanEdit";
            case Config("API_DELETE_ACTION"):
                return "InasisRujukanDelete";
            case Config("API_LIST_ACTION"):
                return "InasisRujukanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "InasisRujukanList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("InasisRujukanView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("InasisRujukanView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "InasisRujukanAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "InasisRujukanAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("InasisRujukanEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("InasisRujukanAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("InasisRujukanDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "VISIT_ID:" . JsonEncode($this->VISIT_ID->CurrentValue, "string");
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
        if ($this->VISIT_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->VISIT_ID->CurrentValue);
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
            if (($keyValue = Param("VISIT_ID") ?? Route("VISIT_ID")) !== null) {
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
                $this->VISIT_ID->CurrentValue = $key[0];
            } else {
                $this->VISIT_ID->OldValue = $key[0];
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
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->NOSEP->setDbValue($row['NOSEP']);
        $this->TGLSEP->setDbValue($row['TGLSEP']);
        $this->TGLRUJUKAN->setDbValue($row['TGLRUJUKAN']);
        $this->TIPERUJUKAN->setDbValue($row['TIPERUJUKAN']);
        $this->KDJNSPELAYANAN->setDbValue($row['KDJNSPELAYANAN']);
        $this->JNSPELAYANAN->setDbValue($row['JNSPELAYANAN']);
        $this->CATATAN->setDbValue($row['CATATAN']);
        $this->KELUHAN->setDbValue($row['KELUHAN']);
        $this->PEMFISIKLAIN->setDbValue($row['PEMFISIKLAIN']);
        $this->KDDIAG->setDbValue($row['KDDIAG']);
        $this->NMDIAG->setDbValue($row['NMDIAG']);
        $this->POLIRUJUKAN_KDPOLI->setDbValue($row['POLIRUJUKAN_KDPOLI']);
        $this->POLIRUJUKAN_NMPOLI->setDbValue($row['POLIRUJUKAN_NMPOLI']);
        $this->PROVRUJUKAN_KDPROVIDER->setDbValue($row['PROVRUJUKAN_KDPROVIDER']);
        $this->PROVRUJUKAN_NMPROVIDER->setDbValue($row['PROVRUJUKAN_NMPROVIDER']);
        $this->PROVKUNJUNGAN_KDPROVIDER->setDbValue($row['PROVKUNJUNGAN_KDPROVIDER']);
        $this->PROVKUNJUNGAN_NMPROVIDER->setDbValue($row['PROVKUNJUNGAN_NMPROVIDER']);
        $this->NOKUNJUNGAN->setDbValue($row['NOKUNJUNGAN']);
        $this->NOSURANSI->setDbValue($row['NOSURANSI']);
        $this->NMASURANSI->setDbValue($row['NMASURANSI']);
        $this->KLSTANGGUNGAN_KDKELAS->setDbValue($row['KLSTANGGUNGAN_KDKELAS']);
        $this->KLSTANGGUNGAN_NMKELAS->setDbValue($row['KLSTANGGUNGAN_NMKELAS']);
        $this->KDJNSPESERTA->setDbValue($row['KDJNSPESERTA']);
        $this->NMJNSPESERTA->setDbValue($row['NMJNSPESERTA']);
        $this->SEX->setDbValue($row['SEX']);
        $this->NAMA->setDbValue($row['NAMA']);
        $this->NOKARTU->setDbValue($row['NOKARTU']);
        $this->NOMR->setDbValue($row['NOMR']);
        $this->TGLLAHIR->setDbValue($row['TGLLAHIR']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->RESPONPOST->setDbValue($row['RESPONPOST']);
        $this->RESPONPUT->setDbValue($row['RESPONPUT']);
        $this->RESPONDEL->setDbValue($row['RESPONDEL']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // VISIT_ID

        // NOSEP

        // TGLSEP

        // TGLRUJUKAN

        // TIPERUJUKAN

        // KDJNSPELAYANAN

        // JNSPELAYANAN

        // CATATAN

        // KELUHAN

        // PEMFISIKLAIN

        // KDDIAG

        // NMDIAG

        // POLIRUJUKAN_KDPOLI

        // POLIRUJUKAN_NMPOLI

        // PROVRUJUKAN_KDPROVIDER

        // PROVRUJUKAN_NMPROVIDER

        // PROVKUNJUNGAN_KDPROVIDER

        // PROVKUNJUNGAN_NMPROVIDER

        // NOKUNJUNGAN

        // NOSURANSI

        // NMASURANSI

        // KLSTANGGUNGAN_KDKELAS

        // KLSTANGGUNGAN_NMKELAS

        // KDJNSPESERTA

        // NMJNSPESERTA

        // SEX

        // NAMA

        // NOKARTU

        // NOMR

        // TGLLAHIR

        // MODIFIED_BY

        // MODIFIED_DATE

        // RESPONPOST

        // RESPONPUT

        // RESPONDEL

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // NOSEP
        $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->ViewCustomAttributes = "";

        // TGLSEP
        $this->TGLSEP->ViewValue = $this->TGLSEP->CurrentValue;
        $this->TGLSEP->ViewValue = FormatDateTime($this->TGLSEP->ViewValue, 0);
        $this->TGLSEP->ViewCustomAttributes = "";

        // TGLRUJUKAN
        $this->TGLRUJUKAN->ViewValue = $this->TGLRUJUKAN->CurrentValue;
        $this->TGLRUJUKAN->ViewValue = FormatDateTime($this->TGLRUJUKAN->ViewValue, 0);
        $this->TGLRUJUKAN->ViewCustomAttributes = "";

        // TIPERUJUKAN
        $this->TIPERUJUKAN->ViewValue = $this->TIPERUJUKAN->CurrentValue;
        $this->TIPERUJUKAN->ViewCustomAttributes = "";

        // KDJNSPELAYANAN
        $this->KDJNSPELAYANAN->ViewValue = $this->KDJNSPELAYANAN->CurrentValue;
        $this->KDJNSPELAYANAN->ViewCustomAttributes = "";

        // JNSPELAYANAN
        $this->JNSPELAYANAN->ViewValue = $this->JNSPELAYANAN->CurrentValue;
        $this->JNSPELAYANAN->ViewCustomAttributes = "";

        // CATATAN
        $this->CATATAN->ViewValue = $this->CATATAN->CurrentValue;
        $this->CATATAN->ViewCustomAttributes = "";

        // KELUHAN
        $this->KELUHAN->ViewValue = $this->KELUHAN->CurrentValue;
        $this->KELUHAN->ViewCustomAttributes = "";

        // PEMFISIKLAIN
        $this->PEMFISIKLAIN->ViewValue = $this->PEMFISIKLAIN->CurrentValue;
        $this->PEMFISIKLAIN->ViewCustomAttributes = "";

        // KDDIAG
        $this->KDDIAG->ViewValue = $this->KDDIAG->CurrentValue;
        $this->KDDIAG->ViewCustomAttributes = "";

        // NMDIAG
        $this->NMDIAG->ViewValue = $this->NMDIAG->CurrentValue;
        $this->NMDIAG->ViewCustomAttributes = "";

        // POLIRUJUKAN_KDPOLI
        $this->POLIRUJUKAN_KDPOLI->ViewValue = $this->POLIRUJUKAN_KDPOLI->CurrentValue;
        $this->POLIRUJUKAN_KDPOLI->ViewCustomAttributes = "";

        // POLIRUJUKAN_NMPOLI
        $this->POLIRUJUKAN_NMPOLI->ViewValue = $this->POLIRUJUKAN_NMPOLI->CurrentValue;
        $this->POLIRUJUKAN_NMPOLI->ViewCustomAttributes = "";

        // PROVRUJUKAN_KDPROVIDER
        $this->PROVRUJUKAN_KDPROVIDER->ViewValue = $this->PROVRUJUKAN_KDPROVIDER->CurrentValue;
        $this->PROVRUJUKAN_KDPROVIDER->ViewCustomAttributes = "";

        // PROVRUJUKAN_NMPROVIDER
        $this->PROVRUJUKAN_NMPROVIDER->ViewValue = $this->PROVRUJUKAN_NMPROVIDER->CurrentValue;
        $this->PROVRUJUKAN_NMPROVIDER->ViewCustomAttributes = "";

        // PROVKUNJUNGAN_KDPROVIDER
        $this->PROVKUNJUNGAN_KDPROVIDER->ViewValue = $this->PROVKUNJUNGAN_KDPROVIDER->CurrentValue;
        $this->PROVKUNJUNGAN_KDPROVIDER->ViewCustomAttributes = "";

        // PROVKUNJUNGAN_NMPROVIDER
        $this->PROVKUNJUNGAN_NMPROVIDER->ViewValue = $this->PROVKUNJUNGAN_NMPROVIDER->CurrentValue;
        $this->PROVKUNJUNGAN_NMPROVIDER->ViewCustomAttributes = "";

        // NOKUNJUNGAN
        $this->NOKUNJUNGAN->ViewValue = $this->NOKUNJUNGAN->CurrentValue;
        $this->NOKUNJUNGAN->ViewCustomAttributes = "";

        // NOSURANSI
        $this->NOSURANSI->ViewValue = $this->NOSURANSI->CurrentValue;
        $this->NOSURANSI->ViewCustomAttributes = "";

        // NMASURANSI
        $this->NMASURANSI->ViewValue = $this->NMASURANSI->CurrentValue;
        $this->NMASURANSI->ViewCustomAttributes = "";

        // KLSTANGGUNGAN_KDKELAS
        $this->KLSTANGGUNGAN_KDKELAS->ViewValue = $this->KLSTANGGUNGAN_KDKELAS->CurrentValue;
        $this->KLSTANGGUNGAN_KDKELAS->ViewCustomAttributes = "";

        // KLSTANGGUNGAN_NMKELAS
        $this->KLSTANGGUNGAN_NMKELAS->ViewValue = $this->KLSTANGGUNGAN_NMKELAS->CurrentValue;
        $this->KLSTANGGUNGAN_NMKELAS->ViewCustomAttributes = "";

        // KDJNSPESERTA
        $this->KDJNSPESERTA->ViewValue = $this->KDJNSPESERTA->CurrentValue;
        $this->KDJNSPESERTA->ViewCustomAttributes = "";

        // NMJNSPESERTA
        $this->NMJNSPESERTA->ViewValue = $this->NMJNSPESERTA->CurrentValue;
        $this->NMJNSPESERTA->ViewCustomAttributes = "";

        // SEX
        $this->SEX->ViewValue = $this->SEX->CurrentValue;
        $this->SEX->ViewCustomAttributes = "";

        // NAMA
        $this->NAMA->ViewValue = $this->NAMA->CurrentValue;
        $this->NAMA->ViewCustomAttributes = "";

        // NOKARTU
        $this->NOKARTU->ViewValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->ViewCustomAttributes = "";

        // NOMR
        $this->NOMR->ViewValue = $this->NOMR->CurrentValue;
        $this->NOMR->ViewCustomAttributes = "";

        // TGLLAHIR
        $this->TGLLAHIR->ViewValue = $this->TGLLAHIR->CurrentValue;
        $this->TGLLAHIR->ViewValue = FormatDateTime($this->TGLLAHIR->ViewValue, 0);
        $this->TGLLAHIR->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // RESPONPOST
        $this->RESPONPOST->ViewValue = $this->RESPONPOST->CurrentValue;
        $this->RESPONPOST->ViewCustomAttributes = "";

        // RESPONPUT
        $this->RESPONPUT->ViewValue = $this->RESPONPUT->CurrentValue;
        $this->RESPONPUT->ViewCustomAttributes = "";

        // RESPONDEL
        $this->RESPONDEL->ViewValue = $this->RESPONDEL->CurrentValue;
        $this->RESPONDEL->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // NOSEP
        $this->NOSEP->LinkCustomAttributes = "";
        $this->NOSEP->HrefValue = "";
        $this->NOSEP->TooltipValue = "";

        // TGLSEP
        $this->TGLSEP->LinkCustomAttributes = "";
        $this->TGLSEP->HrefValue = "";
        $this->TGLSEP->TooltipValue = "";

        // TGLRUJUKAN
        $this->TGLRUJUKAN->LinkCustomAttributes = "";
        $this->TGLRUJUKAN->HrefValue = "";
        $this->TGLRUJUKAN->TooltipValue = "";

        // TIPERUJUKAN
        $this->TIPERUJUKAN->LinkCustomAttributes = "";
        $this->TIPERUJUKAN->HrefValue = "";
        $this->TIPERUJUKAN->TooltipValue = "";

        // KDJNSPELAYANAN
        $this->KDJNSPELAYANAN->LinkCustomAttributes = "";
        $this->KDJNSPELAYANAN->HrefValue = "";
        $this->KDJNSPELAYANAN->TooltipValue = "";

        // JNSPELAYANAN
        $this->JNSPELAYANAN->LinkCustomAttributes = "";
        $this->JNSPELAYANAN->HrefValue = "";
        $this->JNSPELAYANAN->TooltipValue = "";

        // CATATAN
        $this->CATATAN->LinkCustomAttributes = "";
        $this->CATATAN->HrefValue = "";
        $this->CATATAN->TooltipValue = "";

        // KELUHAN
        $this->KELUHAN->LinkCustomAttributes = "";
        $this->KELUHAN->HrefValue = "";
        $this->KELUHAN->TooltipValue = "";

        // PEMFISIKLAIN
        $this->PEMFISIKLAIN->LinkCustomAttributes = "";
        $this->PEMFISIKLAIN->HrefValue = "";
        $this->PEMFISIKLAIN->TooltipValue = "";

        // KDDIAG
        $this->KDDIAG->LinkCustomAttributes = "";
        $this->KDDIAG->HrefValue = "";
        $this->KDDIAG->TooltipValue = "";

        // NMDIAG
        $this->NMDIAG->LinkCustomAttributes = "";
        $this->NMDIAG->HrefValue = "";
        $this->NMDIAG->TooltipValue = "";

        // POLIRUJUKAN_KDPOLI
        $this->POLIRUJUKAN_KDPOLI->LinkCustomAttributes = "";
        $this->POLIRUJUKAN_KDPOLI->HrefValue = "";
        $this->POLIRUJUKAN_KDPOLI->TooltipValue = "";

        // POLIRUJUKAN_NMPOLI
        $this->POLIRUJUKAN_NMPOLI->LinkCustomAttributes = "";
        $this->POLIRUJUKAN_NMPOLI->HrefValue = "";
        $this->POLIRUJUKAN_NMPOLI->TooltipValue = "";

        // PROVRUJUKAN_KDPROVIDER
        $this->PROVRUJUKAN_KDPROVIDER->LinkCustomAttributes = "";
        $this->PROVRUJUKAN_KDPROVIDER->HrefValue = "";
        $this->PROVRUJUKAN_KDPROVIDER->TooltipValue = "";

        // PROVRUJUKAN_NMPROVIDER
        $this->PROVRUJUKAN_NMPROVIDER->LinkCustomAttributes = "";
        $this->PROVRUJUKAN_NMPROVIDER->HrefValue = "";
        $this->PROVRUJUKAN_NMPROVIDER->TooltipValue = "";

        // PROVKUNJUNGAN_KDPROVIDER
        $this->PROVKUNJUNGAN_KDPROVIDER->LinkCustomAttributes = "";
        $this->PROVKUNJUNGAN_KDPROVIDER->HrefValue = "";
        $this->PROVKUNJUNGAN_KDPROVIDER->TooltipValue = "";

        // PROVKUNJUNGAN_NMPROVIDER
        $this->PROVKUNJUNGAN_NMPROVIDER->LinkCustomAttributes = "";
        $this->PROVKUNJUNGAN_NMPROVIDER->HrefValue = "";
        $this->PROVKUNJUNGAN_NMPROVIDER->TooltipValue = "";

        // NOKUNJUNGAN
        $this->NOKUNJUNGAN->LinkCustomAttributes = "";
        $this->NOKUNJUNGAN->HrefValue = "";
        $this->NOKUNJUNGAN->TooltipValue = "";

        // NOSURANSI
        $this->NOSURANSI->LinkCustomAttributes = "";
        $this->NOSURANSI->HrefValue = "";
        $this->NOSURANSI->TooltipValue = "";

        // NMASURANSI
        $this->NMASURANSI->LinkCustomAttributes = "";
        $this->NMASURANSI->HrefValue = "";
        $this->NMASURANSI->TooltipValue = "";

        // KLSTANGGUNGAN_KDKELAS
        $this->KLSTANGGUNGAN_KDKELAS->LinkCustomAttributes = "";
        $this->KLSTANGGUNGAN_KDKELAS->HrefValue = "";
        $this->KLSTANGGUNGAN_KDKELAS->TooltipValue = "";

        // KLSTANGGUNGAN_NMKELAS
        $this->KLSTANGGUNGAN_NMKELAS->LinkCustomAttributes = "";
        $this->KLSTANGGUNGAN_NMKELAS->HrefValue = "";
        $this->KLSTANGGUNGAN_NMKELAS->TooltipValue = "";

        // KDJNSPESERTA
        $this->KDJNSPESERTA->LinkCustomAttributes = "";
        $this->KDJNSPESERTA->HrefValue = "";
        $this->KDJNSPESERTA->TooltipValue = "";

        // NMJNSPESERTA
        $this->NMJNSPESERTA->LinkCustomAttributes = "";
        $this->NMJNSPESERTA->HrefValue = "";
        $this->NMJNSPESERTA->TooltipValue = "";

        // SEX
        $this->SEX->LinkCustomAttributes = "";
        $this->SEX->HrefValue = "";
        $this->SEX->TooltipValue = "";

        // NAMA
        $this->NAMA->LinkCustomAttributes = "";
        $this->NAMA->HrefValue = "";
        $this->NAMA->TooltipValue = "";

        // NOKARTU
        $this->NOKARTU->LinkCustomAttributes = "";
        $this->NOKARTU->HrefValue = "";
        $this->NOKARTU->TooltipValue = "";

        // NOMR
        $this->NOMR->LinkCustomAttributes = "";
        $this->NOMR->HrefValue = "";
        $this->NOMR->TooltipValue = "";

        // TGLLAHIR
        $this->TGLLAHIR->LinkCustomAttributes = "";
        $this->TGLLAHIR->HrefValue = "";
        $this->TGLLAHIR->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // RESPONPOST
        $this->RESPONPOST->LinkCustomAttributes = "";
        $this->RESPONPOST->HrefValue = "";
        $this->RESPONPOST->TooltipValue = "";

        // RESPONPUT
        $this->RESPONPUT->LinkCustomAttributes = "";
        $this->RESPONPUT->HrefValue = "";
        $this->RESPONPUT->TooltipValue = "";

        // RESPONDEL
        $this->RESPONDEL->LinkCustomAttributes = "";
        $this->RESPONDEL->HrefValue = "";
        $this->RESPONDEL->TooltipValue = "";

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

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

        // NOSEP
        $this->NOSEP->EditAttrs["class"] = "form-control";
        $this->NOSEP->EditCustomAttributes = "";
        if (!$this->NOSEP->Raw) {
            $this->NOSEP->CurrentValue = HtmlDecode($this->NOSEP->CurrentValue);
        }
        $this->NOSEP->EditValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->PlaceHolder = RemoveHtml($this->NOSEP->caption());

        // TGLSEP
        $this->TGLSEP->EditAttrs["class"] = "form-control";
        $this->TGLSEP->EditCustomAttributes = "";
        $this->TGLSEP->EditValue = FormatDateTime($this->TGLSEP->CurrentValue, 8);
        $this->TGLSEP->PlaceHolder = RemoveHtml($this->TGLSEP->caption());

        // TGLRUJUKAN
        $this->TGLRUJUKAN->EditAttrs["class"] = "form-control";
        $this->TGLRUJUKAN->EditCustomAttributes = "";
        $this->TGLRUJUKAN->EditValue = FormatDateTime($this->TGLRUJUKAN->CurrentValue, 8);
        $this->TGLRUJUKAN->PlaceHolder = RemoveHtml($this->TGLRUJUKAN->caption());

        // TIPERUJUKAN
        $this->TIPERUJUKAN->EditAttrs["class"] = "form-control";
        $this->TIPERUJUKAN->EditCustomAttributes = "";
        if (!$this->TIPERUJUKAN->Raw) {
            $this->TIPERUJUKAN->CurrentValue = HtmlDecode($this->TIPERUJUKAN->CurrentValue);
        }
        $this->TIPERUJUKAN->EditValue = $this->TIPERUJUKAN->CurrentValue;
        $this->TIPERUJUKAN->PlaceHolder = RemoveHtml($this->TIPERUJUKAN->caption());

        // KDJNSPELAYANAN
        $this->KDJNSPELAYANAN->EditAttrs["class"] = "form-control";
        $this->KDJNSPELAYANAN->EditCustomAttributes = "";
        if (!$this->KDJNSPELAYANAN->Raw) {
            $this->KDJNSPELAYANAN->CurrentValue = HtmlDecode($this->KDJNSPELAYANAN->CurrentValue);
        }
        $this->KDJNSPELAYANAN->EditValue = $this->KDJNSPELAYANAN->CurrentValue;
        $this->KDJNSPELAYANAN->PlaceHolder = RemoveHtml($this->KDJNSPELAYANAN->caption());

        // JNSPELAYANAN
        $this->JNSPELAYANAN->EditAttrs["class"] = "form-control";
        $this->JNSPELAYANAN->EditCustomAttributes = "";
        if (!$this->JNSPELAYANAN->Raw) {
            $this->JNSPELAYANAN->CurrentValue = HtmlDecode($this->JNSPELAYANAN->CurrentValue);
        }
        $this->JNSPELAYANAN->EditValue = $this->JNSPELAYANAN->CurrentValue;
        $this->JNSPELAYANAN->PlaceHolder = RemoveHtml($this->JNSPELAYANAN->caption());

        // CATATAN
        $this->CATATAN->EditAttrs["class"] = "form-control";
        $this->CATATAN->EditCustomAttributes = "";
        if (!$this->CATATAN->Raw) {
            $this->CATATAN->CurrentValue = HtmlDecode($this->CATATAN->CurrentValue);
        }
        $this->CATATAN->EditValue = $this->CATATAN->CurrentValue;
        $this->CATATAN->PlaceHolder = RemoveHtml($this->CATATAN->caption());

        // KELUHAN
        $this->KELUHAN->EditAttrs["class"] = "form-control";
        $this->KELUHAN->EditCustomAttributes = "";
        if (!$this->KELUHAN->Raw) {
            $this->KELUHAN->CurrentValue = HtmlDecode($this->KELUHAN->CurrentValue);
        }
        $this->KELUHAN->EditValue = $this->KELUHAN->CurrentValue;
        $this->KELUHAN->PlaceHolder = RemoveHtml($this->KELUHAN->caption());

        // PEMFISIKLAIN
        $this->PEMFISIKLAIN->EditAttrs["class"] = "form-control";
        $this->PEMFISIKLAIN->EditCustomAttributes = "";
        if (!$this->PEMFISIKLAIN->Raw) {
            $this->PEMFISIKLAIN->CurrentValue = HtmlDecode($this->PEMFISIKLAIN->CurrentValue);
        }
        $this->PEMFISIKLAIN->EditValue = $this->PEMFISIKLAIN->CurrentValue;
        $this->PEMFISIKLAIN->PlaceHolder = RemoveHtml($this->PEMFISIKLAIN->caption());

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

        // POLIRUJUKAN_KDPOLI
        $this->POLIRUJUKAN_KDPOLI->EditAttrs["class"] = "form-control";
        $this->POLIRUJUKAN_KDPOLI->EditCustomAttributes = "";
        if (!$this->POLIRUJUKAN_KDPOLI->Raw) {
            $this->POLIRUJUKAN_KDPOLI->CurrentValue = HtmlDecode($this->POLIRUJUKAN_KDPOLI->CurrentValue);
        }
        $this->POLIRUJUKAN_KDPOLI->EditValue = $this->POLIRUJUKAN_KDPOLI->CurrentValue;
        $this->POLIRUJUKAN_KDPOLI->PlaceHolder = RemoveHtml($this->POLIRUJUKAN_KDPOLI->caption());

        // POLIRUJUKAN_NMPOLI
        $this->POLIRUJUKAN_NMPOLI->EditAttrs["class"] = "form-control";
        $this->POLIRUJUKAN_NMPOLI->EditCustomAttributes = "";
        if (!$this->POLIRUJUKAN_NMPOLI->Raw) {
            $this->POLIRUJUKAN_NMPOLI->CurrentValue = HtmlDecode($this->POLIRUJUKAN_NMPOLI->CurrentValue);
        }
        $this->POLIRUJUKAN_NMPOLI->EditValue = $this->POLIRUJUKAN_NMPOLI->CurrentValue;
        $this->POLIRUJUKAN_NMPOLI->PlaceHolder = RemoveHtml($this->POLIRUJUKAN_NMPOLI->caption());

        // PROVRUJUKAN_KDPROVIDER
        $this->PROVRUJUKAN_KDPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVRUJUKAN_KDPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVRUJUKAN_KDPROVIDER->Raw) {
            $this->PROVRUJUKAN_KDPROVIDER->CurrentValue = HtmlDecode($this->PROVRUJUKAN_KDPROVIDER->CurrentValue);
        }
        $this->PROVRUJUKAN_KDPROVIDER->EditValue = $this->PROVRUJUKAN_KDPROVIDER->CurrentValue;
        $this->PROVRUJUKAN_KDPROVIDER->PlaceHolder = RemoveHtml($this->PROVRUJUKAN_KDPROVIDER->caption());

        // PROVRUJUKAN_NMPROVIDER
        $this->PROVRUJUKAN_NMPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVRUJUKAN_NMPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVRUJUKAN_NMPROVIDER->Raw) {
            $this->PROVRUJUKAN_NMPROVIDER->CurrentValue = HtmlDecode($this->PROVRUJUKAN_NMPROVIDER->CurrentValue);
        }
        $this->PROVRUJUKAN_NMPROVIDER->EditValue = $this->PROVRUJUKAN_NMPROVIDER->CurrentValue;
        $this->PROVRUJUKAN_NMPROVIDER->PlaceHolder = RemoveHtml($this->PROVRUJUKAN_NMPROVIDER->caption());

        // PROVKUNJUNGAN_KDPROVIDER
        $this->PROVKUNJUNGAN_KDPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVKUNJUNGAN_KDPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVKUNJUNGAN_KDPROVIDER->Raw) {
            $this->PROVKUNJUNGAN_KDPROVIDER->CurrentValue = HtmlDecode($this->PROVKUNJUNGAN_KDPROVIDER->CurrentValue);
        }
        $this->PROVKUNJUNGAN_KDPROVIDER->EditValue = $this->PROVKUNJUNGAN_KDPROVIDER->CurrentValue;
        $this->PROVKUNJUNGAN_KDPROVIDER->PlaceHolder = RemoveHtml($this->PROVKUNJUNGAN_KDPROVIDER->caption());

        // PROVKUNJUNGAN_NMPROVIDER
        $this->PROVKUNJUNGAN_NMPROVIDER->EditAttrs["class"] = "form-control";
        $this->PROVKUNJUNGAN_NMPROVIDER->EditCustomAttributes = "";
        if (!$this->PROVKUNJUNGAN_NMPROVIDER->Raw) {
            $this->PROVKUNJUNGAN_NMPROVIDER->CurrentValue = HtmlDecode($this->PROVKUNJUNGAN_NMPROVIDER->CurrentValue);
        }
        $this->PROVKUNJUNGAN_NMPROVIDER->EditValue = $this->PROVKUNJUNGAN_NMPROVIDER->CurrentValue;
        $this->PROVKUNJUNGAN_NMPROVIDER->PlaceHolder = RemoveHtml($this->PROVKUNJUNGAN_NMPROVIDER->caption());

        // NOKUNJUNGAN
        $this->NOKUNJUNGAN->EditAttrs["class"] = "form-control";
        $this->NOKUNJUNGAN->EditCustomAttributes = "";
        if (!$this->NOKUNJUNGAN->Raw) {
            $this->NOKUNJUNGAN->CurrentValue = HtmlDecode($this->NOKUNJUNGAN->CurrentValue);
        }
        $this->NOKUNJUNGAN->EditValue = $this->NOKUNJUNGAN->CurrentValue;
        $this->NOKUNJUNGAN->PlaceHolder = RemoveHtml($this->NOKUNJUNGAN->caption());

        // NOSURANSI
        $this->NOSURANSI->EditAttrs["class"] = "form-control";
        $this->NOSURANSI->EditCustomAttributes = "";
        if (!$this->NOSURANSI->Raw) {
            $this->NOSURANSI->CurrentValue = HtmlDecode($this->NOSURANSI->CurrentValue);
        }
        $this->NOSURANSI->EditValue = $this->NOSURANSI->CurrentValue;
        $this->NOSURANSI->PlaceHolder = RemoveHtml($this->NOSURANSI->caption());

        // NMASURANSI
        $this->NMASURANSI->EditAttrs["class"] = "form-control";
        $this->NMASURANSI->EditCustomAttributes = "";
        if (!$this->NMASURANSI->Raw) {
            $this->NMASURANSI->CurrentValue = HtmlDecode($this->NMASURANSI->CurrentValue);
        }
        $this->NMASURANSI->EditValue = $this->NMASURANSI->CurrentValue;
        $this->NMASURANSI->PlaceHolder = RemoveHtml($this->NMASURANSI->caption());

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

        // SEX
        $this->SEX->EditAttrs["class"] = "form-control";
        $this->SEX->EditCustomAttributes = "";
        if (!$this->SEX->Raw) {
            $this->SEX->CurrentValue = HtmlDecode($this->SEX->CurrentValue);
        }
        $this->SEX->EditValue = $this->SEX->CurrentValue;
        $this->SEX->PlaceHolder = RemoveHtml($this->SEX->caption());

        // NAMA
        $this->NAMA->EditAttrs["class"] = "form-control";
        $this->NAMA->EditCustomAttributes = "";
        if (!$this->NAMA->Raw) {
            $this->NAMA->CurrentValue = HtmlDecode($this->NAMA->CurrentValue);
        }
        $this->NAMA->EditValue = $this->NAMA->CurrentValue;
        $this->NAMA->PlaceHolder = RemoveHtml($this->NAMA->caption());

        // NOKARTU
        $this->NOKARTU->EditAttrs["class"] = "form-control";
        $this->NOKARTU->EditCustomAttributes = "";
        if (!$this->NOKARTU->Raw) {
            $this->NOKARTU->CurrentValue = HtmlDecode($this->NOKARTU->CurrentValue);
        }
        $this->NOKARTU->EditValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->PlaceHolder = RemoveHtml($this->NOKARTU->caption());

        // NOMR
        $this->NOMR->EditAttrs["class"] = "form-control";
        $this->NOMR->EditCustomAttributes = "";
        if (!$this->NOMR->Raw) {
            $this->NOMR->CurrentValue = HtmlDecode($this->NOMR->CurrentValue);
        }
        $this->NOMR->EditValue = $this->NOMR->CurrentValue;
        $this->NOMR->PlaceHolder = RemoveHtml($this->NOMR->caption());

        // TGLLAHIR
        $this->TGLLAHIR->EditAttrs["class"] = "form-control";
        $this->TGLLAHIR->EditCustomAttributes = "";
        $this->TGLLAHIR->EditValue = FormatDateTime($this->TGLLAHIR->CurrentValue, 8);
        $this->TGLLAHIR->PlaceHolder = RemoveHtml($this->TGLLAHIR->caption());

        // MODIFIED_BY
        $this->MODIFIED_BY->EditAttrs["class"] = "form-control";
        $this->MODIFIED_BY->EditCustomAttributes = "";
        if (!$this->MODIFIED_BY->Raw) {
            $this->MODIFIED_BY->CurrentValue = HtmlDecode($this->MODIFIED_BY->CurrentValue);
        }
        $this->MODIFIED_BY->EditValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->PlaceHolder = RemoveHtml($this->MODIFIED_BY->caption());

        // MODIFIED_DATE
        $this->MODIFIED_DATE->EditAttrs["class"] = "form-control";
        $this->MODIFIED_DATE->EditCustomAttributes = "";
        $this->MODIFIED_DATE->EditValue = FormatDateTime($this->MODIFIED_DATE->CurrentValue, 8);
        $this->MODIFIED_DATE->PlaceHolder = RemoveHtml($this->MODIFIED_DATE->caption());

        // RESPONPOST
        $this->RESPONPOST->EditAttrs["class"] = "form-control";
        $this->RESPONPOST->EditCustomAttributes = "";
        $this->RESPONPOST->EditValue = $this->RESPONPOST->CurrentValue;
        $this->RESPONPOST->PlaceHolder = RemoveHtml($this->RESPONPOST->caption());

        // RESPONPUT
        $this->RESPONPUT->EditAttrs["class"] = "form-control";
        $this->RESPONPUT->EditCustomAttributes = "";
        $this->RESPONPUT->EditValue = $this->RESPONPUT->CurrentValue;
        $this->RESPONPUT->PlaceHolder = RemoveHtml($this->RESPONPUT->caption());

        // RESPONDEL
        $this->RESPONDEL->EditAttrs["class"] = "form-control";
        $this->RESPONDEL->EditCustomAttributes = "";
        $this->RESPONDEL->EditValue = $this->RESPONDEL->CurrentValue;
        $this->RESPONDEL->PlaceHolder = RemoveHtml($this->RESPONDEL->caption());

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
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->TGLSEP);
                    $doc->exportCaption($this->TGLRUJUKAN);
                    $doc->exportCaption($this->TIPERUJUKAN);
                    $doc->exportCaption($this->KDJNSPELAYANAN);
                    $doc->exportCaption($this->JNSPELAYANAN);
                    $doc->exportCaption($this->CATATAN);
                    $doc->exportCaption($this->KELUHAN);
                    $doc->exportCaption($this->PEMFISIKLAIN);
                    $doc->exportCaption($this->KDDIAG);
                    $doc->exportCaption($this->NMDIAG);
                    $doc->exportCaption($this->POLIRUJUKAN_KDPOLI);
                    $doc->exportCaption($this->POLIRUJUKAN_NMPOLI);
                    $doc->exportCaption($this->PROVRUJUKAN_KDPROVIDER);
                    $doc->exportCaption($this->PROVRUJUKAN_NMPROVIDER);
                    $doc->exportCaption($this->PROVKUNJUNGAN_KDPROVIDER);
                    $doc->exportCaption($this->PROVKUNJUNGAN_NMPROVIDER);
                    $doc->exportCaption($this->NOKUNJUNGAN);
                    $doc->exportCaption($this->NOSURANSI);
                    $doc->exportCaption($this->NMASURANSI);
                    $doc->exportCaption($this->KLSTANGGUNGAN_KDKELAS);
                    $doc->exportCaption($this->KLSTANGGUNGAN_NMKELAS);
                    $doc->exportCaption($this->KDJNSPESERTA);
                    $doc->exportCaption($this->NMJNSPESERTA);
                    $doc->exportCaption($this->SEX);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->NOMR);
                    $doc->exportCaption($this->TGLLAHIR);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->RESPONPOST);
                    $doc->exportCaption($this->RESPONPUT);
                    $doc->exportCaption($this->RESPONDEL);
                } else {
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->TGLSEP);
                    $doc->exportCaption($this->TGLRUJUKAN);
                    $doc->exportCaption($this->TIPERUJUKAN);
                    $doc->exportCaption($this->KDJNSPELAYANAN);
                    $doc->exportCaption($this->JNSPELAYANAN);
                    $doc->exportCaption($this->CATATAN);
                    $doc->exportCaption($this->KELUHAN);
                    $doc->exportCaption($this->PEMFISIKLAIN);
                    $doc->exportCaption($this->KDDIAG);
                    $doc->exportCaption($this->NMDIAG);
                    $doc->exportCaption($this->POLIRUJUKAN_KDPOLI);
                    $doc->exportCaption($this->POLIRUJUKAN_NMPOLI);
                    $doc->exportCaption($this->PROVRUJUKAN_KDPROVIDER);
                    $doc->exportCaption($this->PROVRUJUKAN_NMPROVIDER);
                    $doc->exportCaption($this->PROVKUNJUNGAN_KDPROVIDER);
                    $doc->exportCaption($this->PROVKUNJUNGAN_NMPROVIDER);
                    $doc->exportCaption($this->NOKUNJUNGAN);
                    $doc->exportCaption($this->NOSURANSI);
                    $doc->exportCaption($this->NMASURANSI);
                    $doc->exportCaption($this->KLSTANGGUNGAN_KDKELAS);
                    $doc->exportCaption($this->KLSTANGGUNGAN_NMKELAS);
                    $doc->exportCaption($this->KDJNSPESERTA);
                    $doc->exportCaption($this->NMJNSPESERTA);
                    $doc->exportCaption($this->SEX);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->NOMR);
                    $doc->exportCaption($this->TGLLAHIR);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
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
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->TGLSEP);
                        $doc->exportField($this->TGLRUJUKAN);
                        $doc->exportField($this->TIPERUJUKAN);
                        $doc->exportField($this->KDJNSPELAYANAN);
                        $doc->exportField($this->JNSPELAYANAN);
                        $doc->exportField($this->CATATAN);
                        $doc->exportField($this->KELUHAN);
                        $doc->exportField($this->PEMFISIKLAIN);
                        $doc->exportField($this->KDDIAG);
                        $doc->exportField($this->NMDIAG);
                        $doc->exportField($this->POLIRUJUKAN_KDPOLI);
                        $doc->exportField($this->POLIRUJUKAN_NMPOLI);
                        $doc->exportField($this->PROVRUJUKAN_KDPROVIDER);
                        $doc->exportField($this->PROVRUJUKAN_NMPROVIDER);
                        $doc->exportField($this->PROVKUNJUNGAN_KDPROVIDER);
                        $doc->exportField($this->PROVKUNJUNGAN_NMPROVIDER);
                        $doc->exportField($this->NOKUNJUNGAN);
                        $doc->exportField($this->NOSURANSI);
                        $doc->exportField($this->NMASURANSI);
                        $doc->exportField($this->KLSTANGGUNGAN_KDKELAS);
                        $doc->exportField($this->KLSTANGGUNGAN_NMKELAS);
                        $doc->exportField($this->KDJNSPESERTA);
                        $doc->exportField($this->NMJNSPESERTA);
                        $doc->exportField($this->SEX);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->NOMR);
                        $doc->exportField($this->TGLLAHIR);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->RESPONPOST);
                        $doc->exportField($this->RESPONPUT);
                        $doc->exportField($this->RESPONDEL);
                    } else {
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->TGLSEP);
                        $doc->exportField($this->TGLRUJUKAN);
                        $doc->exportField($this->TIPERUJUKAN);
                        $doc->exportField($this->KDJNSPELAYANAN);
                        $doc->exportField($this->JNSPELAYANAN);
                        $doc->exportField($this->CATATAN);
                        $doc->exportField($this->KELUHAN);
                        $doc->exportField($this->PEMFISIKLAIN);
                        $doc->exportField($this->KDDIAG);
                        $doc->exportField($this->NMDIAG);
                        $doc->exportField($this->POLIRUJUKAN_KDPOLI);
                        $doc->exportField($this->POLIRUJUKAN_NMPOLI);
                        $doc->exportField($this->PROVRUJUKAN_KDPROVIDER);
                        $doc->exportField($this->PROVRUJUKAN_NMPROVIDER);
                        $doc->exportField($this->PROVKUNJUNGAN_KDPROVIDER);
                        $doc->exportField($this->PROVKUNJUNGAN_NMPROVIDER);
                        $doc->exportField($this->NOKUNJUNGAN);
                        $doc->exportField($this->NOSURANSI);
                        $doc->exportField($this->NMASURANSI);
                        $doc->exportField($this->KLSTANGGUNGAN_KDKELAS);
                        $doc->exportField($this->KLSTANGGUNGAN_NMKELAS);
                        $doc->exportField($this->KDJNSPESERTA);
                        $doc->exportField($this->NMJNSPESERTA);
                        $doc->exportField($this->SEX);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->NOMR);
                        $doc->exportField($this->TGLLAHIR);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
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
