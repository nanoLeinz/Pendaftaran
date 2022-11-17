<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for INASIS_GET_LPK
 */
class InasisGetLpk extends DbTable
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
    public $LPK_ID;
    public $VISIT_ID;
    public $NOKARTU;
    public $NOMR;
    public $NOSEP;
    public $TGLSEP;
    public $NAMA;
    public $SEX;
    public $TGLLAHIR;
    public $DPJP_KD;
    public $DPJP_NM;
    public $KDJNSPELAYANAN;
    public $JNSPELAYANAN;
    public $CARAKELUAR_KD;
    public $CARAKELUAR_NM;
    public $KELASRAWAT_KD;
    public $KELASRAWAT_NM;
    public $KONDISIPLG_KD;
    public $KONDISIPLG_NM;
    public $RUANGRAWAT_KD;
    public $RUANGRAWAT_NM;
    public $SPESIALISTIK_KD;
    public $SPESIALISTIK_NM;
    public $KDPOLI;
    public $KDPOLI_EKS;
    public $RENCANATL;
    public $TGLKELUAR;
    public $TGLMASUK;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $RESPON;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'INASIS_GET_LPK';
        $this->TableName = 'INASIS_GET_LPK';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[INASIS_GET_LPK]";
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

        // LPK_ID
        $this->LPK_ID = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_LPK_ID', 'LPK_ID', '[LPK_ID]', '[LPK_ID]', 200, 50, -1, false, '[LPK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LPK_ID->IsPrimaryKey = true; // Primary key field
        $this->LPK_ID->Nullable = false; // NOT NULL field
        $this->LPK_ID->Required = true; // Required field
        $this->LPK_ID->Sortable = true; // Allow sort
        $this->LPK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LPK_ID->Param, "CustomMsg");
        $this->Fields['LPK_ID'] = &$this->LPK_ID;

        // VISIT_ID
        $this->VISIT_ID = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // NOKARTU
        $this->NOKARTU = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_NOKARTU', 'NOKARTU', '[NOKARTU]', '[NOKARTU]', 200, 50, -1, false, '[NOKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOKARTU->IsPrimaryKey = true; // Primary key field
        $this->NOKARTU->Nullable = false; // NOT NULL field
        $this->NOKARTU->Required = true; // Required field
        $this->NOKARTU->Sortable = true; // Allow sort
        $this->NOKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOKARTU->Param, "CustomMsg");
        $this->Fields['NOKARTU'] = &$this->NOKARTU;

        // NOMR
        $this->NOMR = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_NOMR', 'NOMR', '[NOMR]', '[NOMR]', 200, 50, -1, false, '[NOMR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOMR->Sortable = true; // Allow sort
        $this->NOMR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOMR->Param, "CustomMsg");
        $this->Fields['NOMR'] = &$this->NOMR;

        // NOSEP
        $this->NOSEP = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_NOSEP', 'NOSEP', '[NOSEP]', '[NOSEP]', 200, 50, -1, false, '[NOSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSEP->IsPrimaryKey = true; // Primary key field
        $this->NOSEP->Nullable = false; // NOT NULL field
        $this->NOSEP->Required = true; // Required field
        $this->NOSEP->Sortable = true; // Allow sort
        $this->NOSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSEP->Param, "CustomMsg");
        $this->Fields['NOSEP'] = &$this->NOSEP;

        // TGLSEP
        $this->TGLSEP = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_TGLSEP', 'TGLSEP', '[TGLSEP]', CastDateFieldForLike("[TGLSEP]", 0, "DB"), 135, 8, 0, false, '[TGLSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLSEP->Sortable = true; // Allow sort
        $this->TGLSEP->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLSEP->Param, "CustomMsg");
        $this->Fields['TGLSEP'] = &$this->TGLSEP;

        // NAMA
        $this->NAMA = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_NAMA', 'NAMA', '[NAMA]', '[NAMA]', 200, 250, -1, false, '[NAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA->Sortable = true; // Allow sort
        $this->NAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA->Param, "CustomMsg");
        $this->Fields['NAMA'] = &$this->NAMA;

        // SEX
        $this->SEX = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_SEX', 'SEX', '[SEX]', '[SEX]', 200, 1, -1, false, '[SEX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SEX->Sortable = true; // Allow sort
        $this->SEX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEX->Param, "CustomMsg");
        $this->Fields['SEX'] = &$this->SEX;

        // TGLLAHIR
        $this->TGLLAHIR = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_TGLLAHIR', 'TGLLAHIR', '[TGLLAHIR]', CastDateFieldForLike("[TGLLAHIR]", 0, "DB"), 135, 8, 0, false, '[TGLLAHIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLLAHIR->Sortable = true; // Allow sort
        $this->TGLLAHIR->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLLAHIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLLAHIR->Param, "CustomMsg");
        $this->Fields['TGLLAHIR'] = &$this->TGLLAHIR;

        // DPJP_KD
        $this->DPJP_KD = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_DPJP_KD', 'DPJP_KD', '[DPJP_KD]', '[DPJP_KD]', 200, 50, -1, false, '[DPJP_KD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DPJP_KD->Sortable = true; // Allow sort
        $this->DPJP_KD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DPJP_KD->Param, "CustomMsg");
        $this->Fields['DPJP_KD'] = &$this->DPJP_KD;

        // DPJP_NM
        $this->DPJP_NM = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_DPJP_NM', 'DPJP_NM', '[DPJP_NM]', '[DPJP_NM]', 202, 250, -1, false, '[DPJP_NM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DPJP_NM->Sortable = true; // Allow sort
        $this->DPJP_NM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DPJP_NM->Param, "CustomMsg");
        $this->Fields['DPJP_NM'] = &$this->DPJP_NM;

        // KDJNSPELAYANAN
        $this->KDJNSPELAYANAN = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_KDJNSPELAYANAN', 'KDJNSPELAYANAN', '[KDJNSPELAYANAN]', '[KDJNSPELAYANAN]', 200, 2, -1, false, '[KDJNSPELAYANAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDJNSPELAYANAN->Sortable = true; // Allow sort
        $this->KDJNSPELAYANAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDJNSPELAYANAN->Param, "CustomMsg");
        $this->Fields['KDJNSPELAYANAN'] = &$this->KDJNSPELAYANAN;

        // JNSPELAYANAN
        $this->JNSPELAYANAN = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_JNSPELAYANAN', 'JNSPELAYANAN', '[JNSPELAYANAN]', '[JNSPELAYANAN]', 200, 50, -1, false, '[JNSPELAYANAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JNSPELAYANAN->Sortable = true; // Allow sort
        $this->JNSPELAYANAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JNSPELAYANAN->Param, "CustomMsg");
        $this->Fields['JNSPELAYANAN'] = &$this->JNSPELAYANAN;

        // CARAKELUAR_KD
        $this->CARAKELUAR_KD = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_CARAKELUAR_KD', 'CARAKELUAR_KD', '[CARAKELUAR_KD]', '[CARAKELUAR_KD]', 200, 2, -1, false, '[CARAKELUAR_KD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CARAKELUAR_KD->Sortable = true; // Allow sort
        $this->CARAKELUAR_KD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CARAKELUAR_KD->Param, "CustomMsg");
        $this->Fields['CARAKELUAR_KD'] = &$this->CARAKELUAR_KD;

        // CARAKELUAR_NM
        $this->CARAKELUAR_NM = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_CARAKELUAR_NM', 'CARAKELUAR_NM', '[CARAKELUAR_NM]', '[CARAKELUAR_NM]', 200, 250, -1, false, '[CARAKELUAR_NM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CARAKELUAR_NM->Sortable = true; // Allow sort
        $this->CARAKELUAR_NM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CARAKELUAR_NM->Param, "CustomMsg");
        $this->Fields['CARAKELUAR_NM'] = &$this->CARAKELUAR_NM;

        // KELASRAWAT_KD
        $this->KELASRAWAT_KD = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_KELASRAWAT_KD', 'KELASRAWAT_KD', '[KELASRAWAT_KD]', '[KELASRAWAT_KD]', 200, 2, -1, false, '[KELASRAWAT_KD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELASRAWAT_KD->Sortable = true; // Allow sort
        $this->KELASRAWAT_KD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELASRAWAT_KD->Param, "CustomMsg");
        $this->Fields['KELASRAWAT_KD'] = &$this->KELASRAWAT_KD;

        // KELASRAWAT_NM
        $this->KELASRAWAT_NM = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_KELASRAWAT_NM', 'KELASRAWAT_NM', '[KELASRAWAT_NM]', '[KELASRAWAT_NM]', 200, 150, -1, false, '[KELASRAWAT_NM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELASRAWAT_NM->Sortable = true; // Allow sort
        $this->KELASRAWAT_NM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELASRAWAT_NM->Param, "CustomMsg");
        $this->Fields['KELASRAWAT_NM'] = &$this->KELASRAWAT_NM;

        // KONDISIPLG_KD
        $this->KONDISIPLG_KD = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_KONDISIPLG_KD', 'KONDISIPLG_KD', '[KONDISIPLG_KD]', '[KONDISIPLG_KD]', 200, 2, -1, false, '[KONDISIPLG_KD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KONDISIPLG_KD->Sortable = true; // Allow sort
        $this->KONDISIPLG_KD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KONDISIPLG_KD->Param, "CustomMsg");
        $this->Fields['KONDISIPLG_KD'] = &$this->KONDISIPLG_KD;

        // KONDISIPLG_NM
        $this->KONDISIPLG_NM = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_KONDISIPLG_NM', 'KONDISIPLG_NM', '[KONDISIPLG_NM]', '[KONDISIPLG_NM]', 200, 150, -1, false, '[KONDISIPLG_NM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KONDISIPLG_NM->Sortable = true; // Allow sort
        $this->KONDISIPLG_NM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KONDISIPLG_NM->Param, "CustomMsg");
        $this->Fields['KONDISIPLG_NM'] = &$this->KONDISIPLG_NM;

        // RUANGRAWAT_KD
        $this->RUANGRAWAT_KD = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_RUANGRAWAT_KD', 'RUANGRAWAT_KD', '[RUANGRAWAT_KD]', '[RUANGRAWAT_KD]', 200, 3, -1, false, '[RUANGRAWAT_KD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RUANGRAWAT_KD->Sortable = true; // Allow sort
        $this->RUANGRAWAT_KD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RUANGRAWAT_KD->Param, "CustomMsg");
        $this->Fields['RUANGRAWAT_KD'] = &$this->RUANGRAWAT_KD;

        // RUANGRAWAT_NM
        $this->RUANGRAWAT_NM = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_RUANGRAWAT_NM', 'RUANGRAWAT_NM', '[RUANGRAWAT_NM]', '[RUANGRAWAT_NM]', 200, 150, -1, false, '[RUANGRAWAT_NM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RUANGRAWAT_NM->Sortable = true; // Allow sort
        $this->RUANGRAWAT_NM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RUANGRAWAT_NM->Param, "CustomMsg");
        $this->Fields['RUANGRAWAT_NM'] = &$this->RUANGRAWAT_NM;

        // SPESIALISTIK_KD
        $this->SPESIALISTIK_KD = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_SPESIALISTIK_KD', 'SPESIALISTIK_KD', '[SPESIALISTIK_KD]', '[SPESIALISTIK_KD]', 200, 3, -1, false, '[SPESIALISTIK_KD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPESIALISTIK_KD->Sortable = true; // Allow sort
        $this->SPESIALISTIK_KD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPESIALISTIK_KD->Param, "CustomMsg");
        $this->Fields['SPESIALISTIK_KD'] = &$this->SPESIALISTIK_KD;

        // SPESIALISTIK_NM
        $this->SPESIALISTIK_NM = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_SPESIALISTIK_NM', 'SPESIALISTIK_NM', '[SPESIALISTIK_NM]', '[SPESIALISTIK_NM]', 200, 150, -1, false, '[SPESIALISTIK_NM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPESIALISTIK_NM->Sortable = true; // Allow sort
        $this->SPESIALISTIK_NM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPESIALISTIK_NM->Param, "CustomMsg");
        $this->Fields['SPESIALISTIK_NM'] = &$this->SPESIALISTIK_NM;

        // KDPOLI
        $this->KDPOLI = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_KDPOLI', 'KDPOLI', '[KDPOLI]', '[KDPOLI]', 200, 3, -1, false, '[KDPOLI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDPOLI->Sortable = true; // Allow sort
        $this->KDPOLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDPOLI->Param, "CustomMsg");
        $this->Fields['KDPOLI'] = &$this->KDPOLI;

        // KDPOLI_EKS
        $this->KDPOLI_EKS = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_KDPOLI_EKS', 'KDPOLI_EKS', '[KDPOLI_EKS]', '[KDPOLI_EKS]', 200, 1, -1, false, '[KDPOLI_EKS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDPOLI_EKS->Sortable = true; // Allow sort
        $this->KDPOLI_EKS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDPOLI_EKS->Param, "CustomMsg");
        $this->Fields['KDPOLI_EKS'] = &$this->KDPOLI_EKS;

        // RENCANATL
        $this->RENCANATL = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_RENCANATL', 'RENCANATL', '[RENCANATL]', '[RENCANATL]', 200, 1, -1, false, '[RENCANATL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RENCANATL->Sortable = true; // Allow sort
        $this->RENCANATL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RENCANATL->Param, "CustomMsg");
        $this->Fields['RENCANATL'] = &$this->RENCANATL;

        // TGLKELUAR
        $this->TGLKELUAR = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_TGLKELUAR', 'TGLKELUAR', '[TGLKELUAR]', CastDateFieldForLike("[TGLKELUAR]", 0, "DB"), 135, 8, 0, false, '[TGLKELUAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLKELUAR->Sortable = true; // Allow sort
        $this->TGLKELUAR->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLKELUAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLKELUAR->Param, "CustomMsg");
        $this->Fields['TGLKELUAR'] = &$this->TGLKELUAR;

        // TGLMASUK
        $this->TGLMASUK = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_TGLMASUK', 'TGLMASUK', '[TGLMASUK]', CastDateFieldForLike("[TGLMASUK]", 0, "DB"), 135, 8, 0, false, '[TGLMASUK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLMASUK->Sortable = true; // Allow sort
        $this->TGLMASUK->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLMASUK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLMASUK->Param, "CustomMsg");
        $this->Fields['TGLMASUK'] = &$this->TGLMASUK;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // RESPON
        $this->RESPON = new DbField('INASIS_GET_LPK', 'INASIS_GET_LPK', 'x_RESPON', 'RESPON', '[RESPON]', '[RESPON]', 201, 0, -1, false, '[RESPON]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPON->Sortable = true; // Allow sort
        $this->RESPON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPON->Param, "CustomMsg");
        $this->Fields['RESPON'] = &$this->RESPON;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[INASIS_GET_LPK]";
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
            if (array_key_exists('LPK_ID', $rs)) {
                AddFilter($where, QuotedName('LPK_ID', $this->Dbid) . '=' . QuotedValue($rs['LPK_ID'], $this->LPK_ID->DataType, $this->Dbid));
            }
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
        $this->LPK_ID->DbValue = $row['LPK_ID'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->NOKARTU->DbValue = $row['NOKARTU'];
        $this->NOMR->DbValue = $row['NOMR'];
        $this->NOSEP->DbValue = $row['NOSEP'];
        $this->TGLSEP->DbValue = $row['TGLSEP'];
        $this->NAMA->DbValue = $row['NAMA'];
        $this->SEX->DbValue = $row['SEX'];
        $this->TGLLAHIR->DbValue = $row['TGLLAHIR'];
        $this->DPJP_KD->DbValue = $row['DPJP_KD'];
        $this->DPJP_NM->DbValue = $row['DPJP_NM'];
        $this->KDJNSPELAYANAN->DbValue = $row['KDJNSPELAYANAN'];
        $this->JNSPELAYANAN->DbValue = $row['JNSPELAYANAN'];
        $this->CARAKELUAR_KD->DbValue = $row['CARAKELUAR_KD'];
        $this->CARAKELUAR_NM->DbValue = $row['CARAKELUAR_NM'];
        $this->KELASRAWAT_KD->DbValue = $row['KELASRAWAT_KD'];
        $this->KELASRAWAT_NM->DbValue = $row['KELASRAWAT_NM'];
        $this->KONDISIPLG_KD->DbValue = $row['KONDISIPLG_KD'];
        $this->KONDISIPLG_NM->DbValue = $row['KONDISIPLG_NM'];
        $this->RUANGRAWAT_KD->DbValue = $row['RUANGRAWAT_KD'];
        $this->RUANGRAWAT_NM->DbValue = $row['RUANGRAWAT_NM'];
        $this->SPESIALISTIK_KD->DbValue = $row['SPESIALISTIK_KD'];
        $this->SPESIALISTIK_NM->DbValue = $row['SPESIALISTIK_NM'];
        $this->KDPOLI->DbValue = $row['KDPOLI'];
        $this->KDPOLI_EKS->DbValue = $row['KDPOLI_EKS'];
        $this->RENCANATL->DbValue = $row['RENCANATL'];
        $this->TGLKELUAR->DbValue = $row['TGLKELUAR'];
        $this->TGLMASUK->DbValue = $row['TGLMASUK'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->RESPON->DbValue = $row['RESPON'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[LPK_ID] = '@LPK_ID@' AND [NOKARTU] = '@NOKARTU@' AND [NOSEP] = '@NOSEP@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->LPK_ID->CurrentValue : $this->LPK_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
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
        if (count($keys) == 3) {
            if ($current) {
                $this->LPK_ID->CurrentValue = $keys[0];
            } else {
                $this->LPK_ID->OldValue = $keys[0];
            }
            if ($current) {
                $this->NOKARTU->CurrentValue = $keys[1];
            } else {
                $this->NOKARTU->OldValue = $keys[1];
            }
            if ($current) {
                $this->NOSEP->CurrentValue = $keys[2];
            } else {
                $this->NOSEP->OldValue = $keys[2];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('LPK_ID', $row) ? $row['LPK_ID'] : null;
        } else {
            $val = $this->LPK_ID->OldValue !== null ? $this->LPK_ID->OldValue : $this->LPK_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@LPK_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
        return $_SESSION[$name] ?? GetUrl("InasisGetLpkList");
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
        if ($pageName == "InasisGetLpkView") {
            return $Language->phrase("View");
        } elseif ($pageName == "InasisGetLpkEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "InasisGetLpkAdd") {
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
                return "InasisGetLpkView";
            case Config("API_ADD_ACTION"):
                return "InasisGetLpkAdd";
            case Config("API_EDIT_ACTION"):
                return "InasisGetLpkEdit";
            case Config("API_DELETE_ACTION"):
                return "InasisGetLpkDelete";
            case Config("API_LIST_ACTION"):
                return "InasisGetLpkList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "InasisGetLpkList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("InasisGetLpkView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("InasisGetLpkView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "InasisGetLpkAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "InasisGetLpkAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("InasisGetLpkEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("InasisGetLpkAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("InasisGetLpkDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "LPK_ID:" . JsonEncode($this->LPK_ID->CurrentValue, "string");
        $json .= ",NOKARTU:" . JsonEncode($this->NOKARTU->CurrentValue, "string");
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
        if ($this->LPK_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->LPK_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
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
            if (($keyValue = Param("LPK_ID") ?? Route("LPK_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("NOKARTU") ?? Route("NOKARTU")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("NOSEP") ?? Route("NOSEP")) !== null) {
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
                $this->LPK_ID->CurrentValue = $key[0];
            } else {
                $this->LPK_ID->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->NOKARTU->CurrentValue = $key[1];
            } else {
                $this->NOKARTU->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->NOSEP->CurrentValue = $key[2];
            } else {
                $this->NOSEP->OldValue = $key[2];
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
        $this->LPK_ID->setDbValue($row['LPK_ID']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->NOKARTU->setDbValue($row['NOKARTU']);
        $this->NOMR->setDbValue($row['NOMR']);
        $this->NOSEP->setDbValue($row['NOSEP']);
        $this->TGLSEP->setDbValue($row['TGLSEP']);
        $this->NAMA->setDbValue($row['NAMA']);
        $this->SEX->setDbValue($row['SEX']);
        $this->TGLLAHIR->setDbValue($row['TGLLAHIR']);
        $this->DPJP_KD->setDbValue($row['DPJP_KD']);
        $this->DPJP_NM->setDbValue($row['DPJP_NM']);
        $this->KDJNSPELAYANAN->setDbValue($row['KDJNSPELAYANAN']);
        $this->JNSPELAYANAN->setDbValue($row['JNSPELAYANAN']);
        $this->CARAKELUAR_KD->setDbValue($row['CARAKELUAR_KD']);
        $this->CARAKELUAR_NM->setDbValue($row['CARAKELUAR_NM']);
        $this->KELASRAWAT_KD->setDbValue($row['KELASRAWAT_KD']);
        $this->KELASRAWAT_NM->setDbValue($row['KELASRAWAT_NM']);
        $this->KONDISIPLG_KD->setDbValue($row['KONDISIPLG_KD']);
        $this->KONDISIPLG_NM->setDbValue($row['KONDISIPLG_NM']);
        $this->RUANGRAWAT_KD->setDbValue($row['RUANGRAWAT_KD']);
        $this->RUANGRAWAT_NM->setDbValue($row['RUANGRAWAT_NM']);
        $this->SPESIALISTIK_KD->setDbValue($row['SPESIALISTIK_KD']);
        $this->SPESIALISTIK_NM->setDbValue($row['SPESIALISTIK_NM']);
        $this->KDPOLI->setDbValue($row['KDPOLI']);
        $this->KDPOLI_EKS->setDbValue($row['KDPOLI_EKS']);
        $this->RENCANATL->setDbValue($row['RENCANATL']);
        $this->TGLKELUAR->setDbValue($row['TGLKELUAR']);
        $this->TGLMASUK->setDbValue($row['TGLMASUK']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->RESPON->setDbValue($row['RESPON']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // LPK_ID

        // VISIT_ID

        // NOKARTU

        // NOMR

        // NOSEP

        // TGLSEP

        // NAMA

        // SEX

        // TGLLAHIR

        // DPJP_KD

        // DPJP_NM

        // KDJNSPELAYANAN

        // JNSPELAYANAN

        // CARAKELUAR_KD

        // CARAKELUAR_NM

        // KELASRAWAT_KD

        // KELASRAWAT_NM

        // KONDISIPLG_KD

        // KONDISIPLG_NM

        // RUANGRAWAT_KD

        // RUANGRAWAT_NM

        // SPESIALISTIK_KD

        // SPESIALISTIK_NM

        // KDPOLI

        // KDPOLI_EKS

        // RENCANATL

        // TGLKELUAR

        // TGLMASUK

        // MODIFIED_DATE

        // MODIFIED_BY

        // RESPON

        // LPK_ID
        $this->LPK_ID->ViewValue = $this->LPK_ID->CurrentValue;
        $this->LPK_ID->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // NOKARTU
        $this->NOKARTU->ViewValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->ViewCustomAttributes = "";

        // NOMR
        $this->NOMR->ViewValue = $this->NOMR->CurrentValue;
        $this->NOMR->ViewCustomAttributes = "";

        // NOSEP
        $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->ViewCustomAttributes = "";

        // TGLSEP
        $this->TGLSEP->ViewValue = $this->TGLSEP->CurrentValue;
        $this->TGLSEP->ViewValue = FormatDateTime($this->TGLSEP->ViewValue, 0);
        $this->TGLSEP->ViewCustomAttributes = "";

        // NAMA
        $this->NAMA->ViewValue = $this->NAMA->CurrentValue;
        $this->NAMA->ViewCustomAttributes = "";

        // SEX
        $this->SEX->ViewValue = $this->SEX->CurrentValue;
        $this->SEX->ViewCustomAttributes = "";

        // TGLLAHIR
        $this->TGLLAHIR->ViewValue = $this->TGLLAHIR->CurrentValue;
        $this->TGLLAHIR->ViewValue = FormatDateTime($this->TGLLAHIR->ViewValue, 0);
        $this->TGLLAHIR->ViewCustomAttributes = "";

        // DPJP_KD
        $this->DPJP_KD->ViewValue = $this->DPJP_KD->CurrentValue;
        $this->DPJP_KD->ViewCustomAttributes = "";

        // DPJP_NM
        $this->DPJP_NM->ViewValue = $this->DPJP_NM->CurrentValue;
        $this->DPJP_NM->ViewCustomAttributes = "";

        // KDJNSPELAYANAN
        $this->KDJNSPELAYANAN->ViewValue = $this->KDJNSPELAYANAN->CurrentValue;
        $this->KDJNSPELAYANAN->ViewCustomAttributes = "";

        // JNSPELAYANAN
        $this->JNSPELAYANAN->ViewValue = $this->JNSPELAYANAN->CurrentValue;
        $this->JNSPELAYANAN->ViewCustomAttributes = "";

        // CARAKELUAR_KD
        $this->CARAKELUAR_KD->ViewValue = $this->CARAKELUAR_KD->CurrentValue;
        $this->CARAKELUAR_KD->ViewCustomAttributes = "";

        // CARAKELUAR_NM
        $this->CARAKELUAR_NM->ViewValue = $this->CARAKELUAR_NM->CurrentValue;
        $this->CARAKELUAR_NM->ViewCustomAttributes = "";

        // KELASRAWAT_KD
        $this->KELASRAWAT_KD->ViewValue = $this->KELASRAWAT_KD->CurrentValue;
        $this->KELASRAWAT_KD->ViewCustomAttributes = "";

        // KELASRAWAT_NM
        $this->KELASRAWAT_NM->ViewValue = $this->KELASRAWAT_NM->CurrentValue;
        $this->KELASRAWAT_NM->ViewCustomAttributes = "";

        // KONDISIPLG_KD
        $this->KONDISIPLG_KD->ViewValue = $this->KONDISIPLG_KD->CurrentValue;
        $this->KONDISIPLG_KD->ViewCustomAttributes = "";

        // KONDISIPLG_NM
        $this->KONDISIPLG_NM->ViewValue = $this->KONDISIPLG_NM->CurrentValue;
        $this->KONDISIPLG_NM->ViewCustomAttributes = "";

        // RUANGRAWAT_KD
        $this->RUANGRAWAT_KD->ViewValue = $this->RUANGRAWAT_KD->CurrentValue;
        $this->RUANGRAWAT_KD->ViewCustomAttributes = "";

        // RUANGRAWAT_NM
        $this->RUANGRAWAT_NM->ViewValue = $this->RUANGRAWAT_NM->CurrentValue;
        $this->RUANGRAWAT_NM->ViewCustomAttributes = "";

        // SPESIALISTIK_KD
        $this->SPESIALISTIK_KD->ViewValue = $this->SPESIALISTIK_KD->CurrentValue;
        $this->SPESIALISTIK_KD->ViewCustomAttributes = "";

        // SPESIALISTIK_NM
        $this->SPESIALISTIK_NM->ViewValue = $this->SPESIALISTIK_NM->CurrentValue;
        $this->SPESIALISTIK_NM->ViewCustomAttributes = "";

        // KDPOLI
        $this->KDPOLI->ViewValue = $this->KDPOLI->CurrentValue;
        $this->KDPOLI->ViewCustomAttributes = "";

        // KDPOLI_EKS
        $this->KDPOLI_EKS->ViewValue = $this->KDPOLI_EKS->CurrentValue;
        $this->KDPOLI_EKS->ViewCustomAttributes = "";

        // RENCANATL
        $this->RENCANATL->ViewValue = $this->RENCANATL->CurrentValue;
        $this->RENCANATL->ViewCustomAttributes = "";

        // TGLKELUAR
        $this->TGLKELUAR->ViewValue = $this->TGLKELUAR->CurrentValue;
        $this->TGLKELUAR->ViewValue = FormatDateTime($this->TGLKELUAR->ViewValue, 0);
        $this->TGLKELUAR->ViewCustomAttributes = "";

        // TGLMASUK
        $this->TGLMASUK->ViewValue = $this->TGLMASUK->CurrentValue;
        $this->TGLMASUK->ViewValue = FormatDateTime($this->TGLMASUK->ViewValue, 0);
        $this->TGLMASUK->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // RESPON
        $this->RESPON->ViewValue = $this->RESPON->CurrentValue;
        $this->RESPON->ViewCustomAttributes = "";

        // LPK_ID
        $this->LPK_ID->LinkCustomAttributes = "";
        $this->LPK_ID->HrefValue = "";
        $this->LPK_ID->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // NOKARTU
        $this->NOKARTU->LinkCustomAttributes = "";
        $this->NOKARTU->HrefValue = "";
        $this->NOKARTU->TooltipValue = "";

        // NOMR
        $this->NOMR->LinkCustomAttributes = "";
        $this->NOMR->HrefValue = "";
        $this->NOMR->TooltipValue = "";

        // NOSEP
        $this->NOSEP->LinkCustomAttributes = "";
        $this->NOSEP->HrefValue = "";
        $this->NOSEP->TooltipValue = "";

        // TGLSEP
        $this->TGLSEP->LinkCustomAttributes = "";
        $this->TGLSEP->HrefValue = "";
        $this->TGLSEP->TooltipValue = "";

        // NAMA
        $this->NAMA->LinkCustomAttributes = "";
        $this->NAMA->HrefValue = "";
        $this->NAMA->TooltipValue = "";

        // SEX
        $this->SEX->LinkCustomAttributes = "";
        $this->SEX->HrefValue = "";
        $this->SEX->TooltipValue = "";

        // TGLLAHIR
        $this->TGLLAHIR->LinkCustomAttributes = "";
        $this->TGLLAHIR->HrefValue = "";
        $this->TGLLAHIR->TooltipValue = "";

        // DPJP_KD
        $this->DPJP_KD->LinkCustomAttributes = "";
        $this->DPJP_KD->HrefValue = "";
        $this->DPJP_KD->TooltipValue = "";

        // DPJP_NM
        $this->DPJP_NM->LinkCustomAttributes = "";
        $this->DPJP_NM->HrefValue = "";
        $this->DPJP_NM->TooltipValue = "";

        // KDJNSPELAYANAN
        $this->KDJNSPELAYANAN->LinkCustomAttributes = "";
        $this->KDJNSPELAYANAN->HrefValue = "";
        $this->KDJNSPELAYANAN->TooltipValue = "";

        // JNSPELAYANAN
        $this->JNSPELAYANAN->LinkCustomAttributes = "";
        $this->JNSPELAYANAN->HrefValue = "";
        $this->JNSPELAYANAN->TooltipValue = "";

        // CARAKELUAR_KD
        $this->CARAKELUAR_KD->LinkCustomAttributes = "";
        $this->CARAKELUAR_KD->HrefValue = "";
        $this->CARAKELUAR_KD->TooltipValue = "";

        // CARAKELUAR_NM
        $this->CARAKELUAR_NM->LinkCustomAttributes = "";
        $this->CARAKELUAR_NM->HrefValue = "";
        $this->CARAKELUAR_NM->TooltipValue = "";

        // KELASRAWAT_KD
        $this->KELASRAWAT_KD->LinkCustomAttributes = "";
        $this->KELASRAWAT_KD->HrefValue = "";
        $this->KELASRAWAT_KD->TooltipValue = "";

        // KELASRAWAT_NM
        $this->KELASRAWAT_NM->LinkCustomAttributes = "";
        $this->KELASRAWAT_NM->HrefValue = "";
        $this->KELASRAWAT_NM->TooltipValue = "";

        // KONDISIPLG_KD
        $this->KONDISIPLG_KD->LinkCustomAttributes = "";
        $this->KONDISIPLG_KD->HrefValue = "";
        $this->KONDISIPLG_KD->TooltipValue = "";

        // KONDISIPLG_NM
        $this->KONDISIPLG_NM->LinkCustomAttributes = "";
        $this->KONDISIPLG_NM->HrefValue = "";
        $this->KONDISIPLG_NM->TooltipValue = "";

        // RUANGRAWAT_KD
        $this->RUANGRAWAT_KD->LinkCustomAttributes = "";
        $this->RUANGRAWAT_KD->HrefValue = "";
        $this->RUANGRAWAT_KD->TooltipValue = "";

        // RUANGRAWAT_NM
        $this->RUANGRAWAT_NM->LinkCustomAttributes = "";
        $this->RUANGRAWAT_NM->HrefValue = "";
        $this->RUANGRAWAT_NM->TooltipValue = "";

        // SPESIALISTIK_KD
        $this->SPESIALISTIK_KD->LinkCustomAttributes = "";
        $this->SPESIALISTIK_KD->HrefValue = "";
        $this->SPESIALISTIK_KD->TooltipValue = "";

        // SPESIALISTIK_NM
        $this->SPESIALISTIK_NM->LinkCustomAttributes = "";
        $this->SPESIALISTIK_NM->HrefValue = "";
        $this->SPESIALISTIK_NM->TooltipValue = "";

        // KDPOLI
        $this->KDPOLI->LinkCustomAttributes = "";
        $this->KDPOLI->HrefValue = "";
        $this->KDPOLI->TooltipValue = "";

        // KDPOLI_EKS
        $this->KDPOLI_EKS->LinkCustomAttributes = "";
        $this->KDPOLI_EKS->HrefValue = "";
        $this->KDPOLI_EKS->TooltipValue = "";

        // RENCANATL
        $this->RENCANATL->LinkCustomAttributes = "";
        $this->RENCANATL->HrefValue = "";
        $this->RENCANATL->TooltipValue = "";

        // TGLKELUAR
        $this->TGLKELUAR->LinkCustomAttributes = "";
        $this->TGLKELUAR->HrefValue = "";
        $this->TGLKELUAR->TooltipValue = "";

        // TGLMASUK
        $this->TGLMASUK->LinkCustomAttributes = "";
        $this->TGLMASUK->HrefValue = "";
        $this->TGLMASUK->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // RESPON
        $this->RESPON->LinkCustomAttributes = "";
        $this->RESPON->HrefValue = "";
        $this->RESPON->TooltipValue = "";

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

        // LPK_ID
        $this->LPK_ID->EditAttrs["class"] = "form-control";
        $this->LPK_ID->EditCustomAttributes = "";
        if (!$this->LPK_ID->Raw) {
            $this->LPK_ID->CurrentValue = HtmlDecode($this->LPK_ID->CurrentValue);
        }
        $this->LPK_ID->EditValue = $this->LPK_ID->CurrentValue;
        $this->LPK_ID->PlaceHolder = RemoveHtml($this->LPK_ID->caption());

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

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

        // NAMA
        $this->NAMA->EditAttrs["class"] = "form-control";
        $this->NAMA->EditCustomAttributes = "";
        if (!$this->NAMA->Raw) {
            $this->NAMA->CurrentValue = HtmlDecode($this->NAMA->CurrentValue);
        }
        $this->NAMA->EditValue = $this->NAMA->CurrentValue;
        $this->NAMA->PlaceHolder = RemoveHtml($this->NAMA->caption());

        // SEX
        $this->SEX->EditAttrs["class"] = "form-control";
        $this->SEX->EditCustomAttributes = "";
        if (!$this->SEX->Raw) {
            $this->SEX->CurrentValue = HtmlDecode($this->SEX->CurrentValue);
        }
        $this->SEX->EditValue = $this->SEX->CurrentValue;
        $this->SEX->PlaceHolder = RemoveHtml($this->SEX->caption());

        // TGLLAHIR
        $this->TGLLAHIR->EditAttrs["class"] = "form-control";
        $this->TGLLAHIR->EditCustomAttributes = "";
        $this->TGLLAHIR->EditValue = FormatDateTime($this->TGLLAHIR->CurrentValue, 8);
        $this->TGLLAHIR->PlaceHolder = RemoveHtml($this->TGLLAHIR->caption());

        // DPJP_KD
        $this->DPJP_KD->EditAttrs["class"] = "form-control";
        $this->DPJP_KD->EditCustomAttributes = "";
        if (!$this->DPJP_KD->Raw) {
            $this->DPJP_KD->CurrentValue = HtmlDecode($this->DPJP_KD->CurrentValue);
        }
        $this->DPJP_KD->EditValue = $this->DPJP_KD->CurrentValue;
        $this->DPJP_KD->PlaceHolder = RemoveHtml($this->DPJP_KD->caption());

        // DPJP_NM
        $this->DPJP_NM->EditAttrs["class"] = "form-control";
        $this->DPJP_NM->EditCustomAttributes = "";
        if (!$this->DPJP_NM->Raw) {
            $this->DPJP_NM->CurrentValue = HtmlDecode($this->DPJP_NM->CurrentValue);
        }
        $this->DPJP_NM->EditValue = $this->DPJP_NM->CurrentValue;
        $this->DPJP_NM->PlaceHolder = RemoveHtml($this->DPJP_NM->caption());

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

        // CARAKELUAR_KD
        $this->CARAKELUAR_KD->EditAttrs["class"] = "form-control";
        $this->CARAKELUAR_KD->EditCustomAttributes = "";
        if (!$this->CARAKELUAR_KD->Raw) {
            $this->CARAKELUAR_KD->CurrentValue = HtmlDecode($this->CARAKELUAR_KD->CurrentValue);
        }
        $this->CARAKELUAR_KD->EditValue = $this->CARAKELUAR_KD->CurrentValue;
        $this->CARAKELUAR_KD->PlaceHolder = RemoveHtml($this->CARAKELUAR_KD->caption());

        // CARAKELUAR_NM
        $this->CARAKELUAR_NM->EditAttrs["class"] = "form-control";
        $this->CARAKELUAR_NM->EditCustomAttributes = "";
        if (!$this->CARAKELUAR_NM->Raw) {
            $this->CARAKELUAR_NM->CurrentValue = HtmlDecode($this->CARAKELUAR_NM->CurrentValue);
        }
        $this->CARAKELUAR_NM->EditValue = $this->CARAKELUAR_NM->CurrentValue;
        $this->CARAKELUAR_NM->PlaceHolder = RemoveHtml($this->CARAKELUAR_NM->caption());

        // KELASRAWAT_KD
        $this->KELASRAWAT_KD->EditAttrs["class"] = "form-control";
        $this->KELASRAWAT_KD->EditCustomAttributes = "";
        if (!$this->KELASRAWAT_KD->Raw) {
            $this->KELASRAWAT_KD->CurrentValue = HtmlDecode($this->KELASRAWAT_KD->CurrentValue);
        }
        $this->KELASRAWAT_KD->EditValue = $this->KELASRAWAT_KD->CurrentValue;
        $this->KELASRAWAT_KD->PlaceHolder = RemoveHtml($this->KELASRAWAT_KD->caption());

        // KELASRAWAT_NM
        $this->KELASRAWAT_NM->EditAttrs["class"] = "form-control";
        $this->KELASRAWAT_NM->EditCustomAttributes = "";
        if (!$this->KELASRAWAT_NM->Raw) {
            $this->KELASRAWAT_NM->CurrentValue = HtmlDecode($this->KELASRAWAT_NM->CurrentValue);
        }
        $this->KELASRAWAT_NM->EditValue = $this->KELASRAWAT_NM->CurrentValue;
        $this->KELASRAWAT_NM->PlaceHolder = RemoveHtml($this->KELASRAWAT_NM->caption());

        // KONDISIPLG_KD
        $this->KONDISIPLG_KD->EditAttrs["class"] = "form-control";
        $this->KONDISIPLG_KD->EditCustomAttributes = "";
        if (!$this->KONDISIPLG_KD->Raw) {
            $this->KONDISIPLG_KD->CurrentValue = HtmlDecode($this->KONDISIPLG_KD->CurrentValue);
        }
        $this->KONDISIPLG_KD->EditValue = $this->KONDISIPLG_KD->CurrentValue;
        $this->KONDISIPLG_KD->PlaceHolder = RemoveHtml($this->KONDISIPLG_KD->caption());

        // KONDISIPLG_NM
        $this->KONDISIPLG_NM->EditAttrs["class"] = "form-control";
        $this->KONDISIPLG_NM->EditCustomAttributes = "";
        if (!$this->KONDISIPLG_NM->Raw) {
            $this->KONDISIPLG_NM->CurrentValue = HtmlDecode($this->KONDISIPLG_NM->CurrentValue);
        }
        $this->KONDISIPLG_NM->EditValue = $this->KONDISIPLG_NM->CurrentValue;
        $this->KONDISIPLG_NM->PlaceHolder = RemoveHtml($this->KONDISIPLG_NM->caption());

        // RUANGRAWAT_KD
        $this->RUANGRAWAT_KD->EditAttrs["class"] = "form-control";
        $this->RUANGRAWAT_KD->EditCustomAttributes = "";
        if (!$this->RUANGRAWAT_KD->Raw) {
            $this->RUANGRAWAT_KD->CurrentValue = HtmlDecode($this->RUANGRAWAT_KD->CurrentValue);
        }
        $this->RUANGRAWAT_KD->EditValue = $this->RUANGRAWAT_KD->CurrentValue;
        $this->RUANGRAWAT_KD->PlaceHolder = RemoveHtml($this->RUANGRAWAT_KD->caption());

        // RUANGRAWAT_NM
        $this->RUANGRAWAT_NM->EditAttrs["class"] = "form-control";
        $this->RUANGRAWAT_NM->EditCustomAttributes = "";
        if (!$this->RUANGRAWAT_NM->Raw) {
            $this->RUANGRAWAT_NM->CurrentValue = HtmlDecode($this->RUANGRAWAT_NM->CurrentValue);
        }
        $this->RUANGRAWAT_NM->EditValue = $this->RUANGRAWAT_NM->CurrentValue;
        $this->RUANGRAWAT_NM->PlaceHolder = RemoveHtml($this->RUANGRAWAT_NM->caption());

        // SPESIALISTIK_KD
        $this->SPESIALISTIK_KD->EditAttrs["class"] = "form-control";
        $this->SPESIALISTIK_KD->EditCustomAttributes = "";
        if (!$this->SPESIALISTIK_KD->Raw) {
            $this->SPESIALISTIK_KD->CurrentValue = HtmlDecode($this->SPESIALISTIK_KD->CurrentValue);
        }
        $this->SPESIALISTIK_KD->EditValue = $this->SPESIALISTIK_KD->CurrentValue;
        $this->SPESIALISTIK_KD->PlaceHolder = RemoveHtml($this->SPESIALISTIK_KD->caption());

        // SPESIALISTIK_NM
        $this->SPESIALISTIK_NM->EditAttrs["class"] = "form-control";
        $this->SPESIALISTIK_NM->EditCustomAttributes = "";
        if (!$this->SPESIALISTIK_NM->Raw) {
            $this->SPESIALISTIK_NM->CurrentValue = HtmlDecode($this->SPESIALISTIK_NM->CurrentValue);
        }
        $this->SPESIALISTIK_NM->EditValue = $this->SPESIALISTIK_NM->CurrentValue;
        $this->SPESIALISTIK_NM->PlaceHolder = RemoveHtml($this->SPESIALISTIK_NM->caption());

        // KDPOLI
        $this->KDPOLI->EditAttrs["class"] = "form-control";
        $this->KDPOLI->EditCustomAttributes = "";
        if (!$this->KDPOLI->Raw) {
            $this->KDPOLI->CurrentValue = HtmlDecode($this->KDPOLI->CurrentValue);
        }
        $this->KDPOLI->EditValue = $this->KDPOLI->CurrentValue;
        $this->KDPOLI->PlaceHolder = RemoveHtml($this->KDPOLI->caption());

        // KDPOLI_EKS
        $this->KDPOLI_EKS->EditAttrs["class"] = "form-control";
        $this->KDPOLI_EKS->EditCustomAttributes = "";
        if (!$this->KDPOLI_EKS->Raw) {
            $this->KDPOLI_EKS->CurrentValue = HtmlDecode($this->KDPOLI_EKS->CurrentValue);
        }
        $this->KDPOLI_EKS->EditValue = $this->KDPOLI_EKS->CurrentValue;
        $this->KDPOLI_EKS->PlaceHolder = RemoveHtml($this->KDPOLI_EKS->caption());

        // RENCANATL
        $this->RENCANATL->EditAttrs["class"] = "form-control";
        $this->RENCANATL->EditCustomAttributes = "";
        if (!$this->RENCANATL->Raw) {
            $this->RENCANATL->CurrentValue = HtmlDecode($this->RENCANATL->CurrentValue);
        }
        $this->RENCANATL->EditValue = $this->RENCANATL->CurrentValue;
        $this->RENCANATL->PlaceHolder = RemoveHtml($this->RENCANATL->caption());

        // TGLKELUAR
        $this->TGLKELUAR->EditAttrs["class"] = "form-control";
        $this->TGLKELUAR->EditCustomAttributes = "";
        $this->TGLKELUAR->EditValue = FormatDateTime($this->TGLKELUAR->CurrentValue, 8);
        $this->TGLKELUAR->PlaceHolder = RemoveHtml($this->TGLKELUAR->caption());

        // TGLMASUK
        $this->TGLMASUK->EditAttrs["class"] = "form-control";
        $this->TGLMASUK->EditCustomAttributes = "";
        $this->TGLMASUK->EditValue = FormatDateTime($this->TGLMASUK->CurrentValue, 8);
        $this->TGLMASUK->PlaceHolder = RemoveHtml($this->TGLMASUK->caption());

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

        // RESPON
        $this->RESPON->EditAttrs["class"] = "form-control";
        $this->RESPON->EditCustomAttributes = "";
        $this->RESPON->EditValue = $this->RESPON->CurrentValue;
        $this->RESPON->PlaceHolder = RemoveHtml($this->RESPON->caption());

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
                    $doc->exportCaption($this->LPK_ID);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->NOMR);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->TGLSEP);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->SEX);
                    $doc->exportCaption($this->TGLLAHIR);
                    $doc->exportCaption($this->DPJP_KD);
                    $doc->exportCaption($this->DPJP_NM);
                    $doc->exportCaption($this->KDJNSPELAYANAN);
                    $doc->exportCaption($this->JNSPELAYANAN);
                    $doc->exportCaption($this->CARAKELUAR_KD);
                    $doc->exportCaption($this->CARAKELUAR_NM);
                    $doc->exportCaption($this->KELASRAWAT_KD);
                    $doc->exportCaption($this->KELASRAWAT_NM);
                    $doc->exportCaption($this->KONDISIPLG_KD);
                    $doc->exportCaption($this->KONDISIPLG_NM);
                    $doc->exportCaption($this->RUANGRAWAT_KD);
                    $doc->exportCaption($this->RUANGRAWAT_NM);
                    $doc->exportCaption($this->SPESIALISTIK_KD);
                    $doc->exportCaption($this->SPESIALISTIK_NM);
                    $doc->exportCaption($this->KDPOLI);
                    $doc->exportCaption($this->KDPOLI_EKS);
                    $doc->exportCaption($this->RENCANATL);
                    $doc->exportCaption($this->TGLKELUAR);
                    $doc->exportCaption($this->TGLMASUK);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->RESPON);
                } else {
                    $doc->exportCaption($this->LPK_ID);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->NOMR);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->TGLSEP);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->SEX);
                    $doc->exportCaption($this->TGLLAHIR);
                    $doc->exportCaption($this->DPJP_KD);
                    $doc->exportCaption($this->DPJP_NM);
                    $doc->exportCaption($this->KDJNSPELAYANAN);
                    $doc->exportCaption($this->JNSPELAYANAN);
                    $doc->exportCaption($this->CARAKELUAR_KD);
                    $doc->exportCaption($this->CARAKELUAR_NM);
                    $doc->exportCaption($this->KELASRAWAT_KD);
                    $doc->exportCaption($this->KELASRAWAT_NM);
                    $doc->exportCaption($this->KONDISIPLG_KD);
                    $doc->exportCaption($this->KONDISIPLG_NM);
                    $doc->exportCaption($this->RUANGRAWAT_KD);
                    $doc->exportCaption($this->RUANGRAWAT_NM);
                    $doc->exportCaption($this->SPESIALISTIK_KD);
                    $doc->exportCaption($this->SPESIALISTIK_NM);
                    $doc->exportCaption($this->KDPOLI);
                    $doc->exportCaption($this->KDPOLI_EKS);
                    $doc->exportCaption($this->RENCANATL);
                    $doc->exportCaption($this->TGLKELUAR);
                    $doc->exportCaption($this->TGLMASUK);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
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
                        $doc->exportField($this->LPK_ID);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->NOMR);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->TGLSEP);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->SEX);
                        $doc->exportField($this->TGLLAHIR);
                        $doc->exportField($this->DPJP_KD);
                        $doc->exportField($this->DPJP_NM);
                        $doc->exportField($this->KDJNSPELAYANAN);
                        $doc->exportField($this->JNSPELAYANAN);
                        $doc->exportField($this->CARAKELUAR_KD);
                        $doc->exportField($this->CARAKELUAR_NM);
                        $doc->exportField($this->KELASRAWAT_KD);
                        $doc->exportField($this->KELASRAWAT_NM);
                        $doc->exportField($this->KONDISIPLG_KD);
                        $doc->exportField($this->KONDISIPLG_NM);
                        $doc->exportField($this->RUANGRAWAT_KD);
                        $doc->exportField($this->RUANGRAWAT_NM);
                        $doc->exportField($this->SPESIALISTIK_KD);
                        $doc->exportField($this->SPESIALISTIK_NM);
                        $doc->exportField($this->KDPOLI);
                        $doc->exportField($this->KDPOLI_EKS);
                        $doc->exportField($this->RENCANATL);
                        $doc->exportField($this->TGLKELUAR);
                        $doc->exportField($this->TGLMASUK);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->RESPON);
                    } else {
                        $doc->exportField($this->LPK_ID);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->NOMR);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->TGLSEP);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->SEX);
                        $doc->exportField($this->TGLLAHIR);
                        $doc->exportField($this->DPJP_KD);
                        $doc->exportField($this->DPJP_NM);
                        $doc->exportField($this->KDJNSPELAYANAN);
                        $doc->exportField($this->JNSPELAYANAN);
                        $doc->exportField($this->CARAKELUAR_KD);
                        $doc->exportField($this->CARAKELUAR_NM);
                        $doc->exportField($this->KELASRAWAT_KD);
                        $doc->exportField($this->KELASRAWAT_NM);
                        $doc->exportField($this->KONDISIPLG_KD);
                        $doc->exportField($this->KONDISIPLG_NM);
                        $doc->exportField($this->RUANGRAWAT_KD);
                        $doc->exportField($this->RUANGRAWAT_NM);
                        $doc->exportField($this->SPESIALISTIK_KD);
                        $doc->exportField($this->SPESIALISTIK_NM);
                        $doc->exportField($this->KDPOLI);
                        $doc->exportField($this->KDPOLI_EKS);
                        $doc->exportField($this->RENCANATL);
                        $doc->exportField($this->TGLKELUAR);
                        $doc->exportField($this->TGLMASUK);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
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
