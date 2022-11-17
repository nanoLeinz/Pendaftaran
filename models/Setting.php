<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for SETTING
 */
class Setting extends DbTable
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
    public $PPN;
    public $EMBALACE;
    public $EMBALACER;
    public $R_EMBALACE;
    public $PROFESSION_COST;
    public $R_PROFESSION;
    public $POKOK_JUAL;
    public $LEAD_TIME;
    public $HOLDING_COSTP;
    public $ORDERING_COST;
    public $PAGU;
    public $PPN_RJ;
    public $PPN_RI;
    public $PPN_UGD;
    public $MARGINBEBAS;
    public $MARGINGENERIK;
    public $MARGINOWA;
    public $MARGININTERNAL;
    public $MARGINLUAR;
    public $MARGINVIP12;
    public $MARGINRJ;
    public $MARGIN2;
    public $MARGIN3;
    public $MARGIN4;
    public $MARGIN5;
    public $DISKON1;
    public $DISKON2;
    public $DISKON3;
    public $DISKON4;
    public $DISKON5;
    public $DISKONBEBAS;
    public $DISKONGENERIK;
    public $DISKONOWA;
    public $DISKONINTERNAL;
    public $DISKONLUAR;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $STATUSCHANGED;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'SETTING';
        $this->TableName = 'SETTING';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[SETTING]";
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
        $this->ORG_UNIT_CODE = new DbField('SETTING', 'SETTING', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // PPN
        $this->PPN = new DbField('SETTING', 'SETTING', 'x_PPN', 'PPN', '[PPN]', 'CAST([PPN] AS NVARCHAR)', 131, 8, -1, false, '[PPN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPN->Nullable = false; // NOT NULL field
        $this->PPN->Required = true; // Required field
        $this->PPN->Sortable = true; // Allow sort
        $this->PPN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPN->Param, "CustomMsg");
        $this->Fields['PPN'] = &$this->PPN;

        // EMBALACE
        $this->EMBALACE = new DbField('SETTING', 'SETTING', 'x_EMBALACE', 'EMBALACE', '[EMBALACE]', 'CAST([EMBALACE] AS NVARCHAR)', 131, 8, -1, false, '[EMBALACE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMBALACE->Sortable = true; // Allow sort
        $this->EMBALACE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->EMBALACE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->EMBALACE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMBALACE->Param, "CustomMsg");
        $this->Fields['EMBALACE'] = &$this->EMBALACE;

        // EMBALACER
        $this->EMBALACER = new DbField('SETTING', 'SETTING', 'x_EMBALACER', 'EMBALACER', '[EMBALACER]', 'CAST([EMBALACER] AS NVARCHAR)', 131, 8, -1, false, '[EMBALACER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMBALACER->Sortable = true; // Allow sort
        $this->EMBALACER->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->EMBALACER->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->EMBALACER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMBALACER->Param, "CustomMsg");
        $this->Fields['EMBALACER'] = &$this->EMBALACER;

        // R_EMBALACE
        $this->R_EMBALACE = new DbField('SETTING', 'SETTING', 'x_R_EMBALACE', 'R_EMBALACE', '[R_EMBALACE]', '[R_EMBALACE]', 129, 1, -1, false, '[R_EMBALACE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->R_EMBALACE->Sortable = true; // Allow sort
        $this->R_EMBALACE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->R_EMBALACE->Param, "CustomMsg");
        $this->Fields['R_EMBALACE'] = &$this->R_EMBALACE;

        // PROFESSION_COST
        $this->PROFESSION_COST = new DbField('SETTING', 'SETTING', 'x_PROFESSION_COST', 'PROFESSION_COST', '[PROFESSION_COST]', 'CAST([PROFESSION_COST] AS NVARCHAR)', 131, 8, -1, false, '[PROFESSION_COST]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROFESSION_COST->Sortable = true; // Allow sort
        $this->PROFESSION_COST->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PROFESSION_COST->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PROFESSION_COST->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROFESSION_COST->Param, "CustomMsg");
        $this->Fields['PROFESSION_COST'] = &$this->PROFESSION_COST;

        // R_PROFESSION
        $this->R_PROFESSION = new DbField('SETTING', 'SETTING', 'x_R_PROFESSION', 'R_PROFESSION', '[R_PROFESSION]', '[R_PROFESSION]', 129, 1, -1, false, '[R_PROFESSION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->R_PROFESSION->Sortable = true; // Allow sort
        $this->R_PROFESSION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->R_PROFESSION->Param, "CustomMsg");
        $this->Fields['R_PROFESSION'] = &$this->R_PROFESSION;

        // POKOK_JUAL
        $this->POKOK_JUAL = new DbField('SETTING', 'SETTING', 'x_POKOK_JUAL', 'POKOK_JUAL', '[POKOK_JUAL]', 'CAST([POKOK_JUAL] AS NVARCHAR)', 131, 8, -1, false, '[POKOK_JUAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POKOK_JUAL->Sortable = true; // Allow sort
        $this->POKOK_JUAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->POKOK_JUAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->POKOK_JUAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POKOK_JUAL->Param, "CustomMsg");
        $this->Fields['POKOK_JUAL'] = &$this->POKOK_JUAL;

        // LEAD_TIME
        $this->LEAD_TIME = new DbField('SETTING', 'SETTING', 'x_LEAD_TIME', 'LEAD_TIME', '[LEAD_TIME]', 'CAST([LEAD_TIME] AS NVARCHAR)', 2, 2, -1, false, '[LEAD_TIME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LEAD_TIME->Sortable = true; // Allow sort
        $this->LEAD_TIME->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->LEAD_TIME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LEAD_TIME->Param, "CustomMsg");
        $this->Fields['LEAD_TIME'] = &$this->LEAD_TIME;

        // HOLDING_COSTP
        $this->HOLDING_COSTP = new DbField('SETTING', 'SETTING', 'x_HOLDING_COSTP', 'HOLDING_COSTP', '[HOLDING_COSTP]', 'CAST([HOLDING_COSTP] AS NVARCHAR)', 131, 8, -1, false, '[HOLDING_COSTP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HOLDING_COSTP->Sortable = true; // Allow sort
        $this->HOLDING_COSTP->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->HOLDING_COSTP->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->HOLDING_COSTP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HOLDING_COSTP->Param, "CustomMsg");
        $this->Fields['HOLDING_COSTP'] = &$this->HOLDING_COSTP;

        // ORDERING_COST
        $this->ORDERING_COST = new DbField('SETTING', 'SETTING', 'x_ORDERING_COST', 'ORDERING_COST', '[ORDERING_COST]', 'CAST([ORDERING_COST] AS NVARCHAR)', 6, 8, -1, false, '[ORDERING_COST]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORDERING_COST->Sortable = true; // Allow sort
        $this->ORDERING_COST->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ORDERING_COST->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ORDERING_COST->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORDERING_COST->Param, "CustomMsg");
        $this->Fields['ORDERING_COST'] = &$this->ORDERING_COST;

        // PAGU
        $this->PAGU = new DbField('SETTING', 'SETTING', 'x_PAGU', 'PAGU', '[PAGU]', 'CAST([PAGU] AS NVARCHAR)', 6, 8, -1, false, '[PAGU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAGU->Sortable = true; // Allow sort
        $this->PAGU->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PAGU->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PAGU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAGU->Param, "CustomMsg");
        $this->Fields['PAGU'] = &$this->PAGU;

        // PPN_RJ
        $this->PPN_RJ = new DbField('SETTING', 'SETTING', 'x_PPN_RJ', 'PPN_RJ', '[PPN_RJ]', 'CAST([PPN_RJ] AS NVARCHAR)', 131, 8, -1, false, '[PPN_RJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPN_RJ->Sortable = true; // Allow sort
        $this->PPN_RJ->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPN_RJ->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPN_RJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPN_RJ->Param, "CustomMsg");
        $this->Fields['PPN_RJ'] = &$this->PPN_RJ;

        // PPN_RI
        $this->PPN_RI = new DbField('SETTING', 'SETTING', 'x_PPN_RI', 'PPN_RI', '[PPN_RI]', 'CAST([PPN_RI] AS NVARCHAR)', 131, 8, -1, false, '[PPN_RI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPN_RI->Sortable = true; // Allow sort
        $this->PPN_RI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPN_RI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPN_RI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPN_RI->Param, "CustomMsg");
        $this->Fields['PPN_RI'] = &$this->PPN_RI;

        // PPN_UGD
        $this->PPN_UGD = new DbField('SETTING', 'SETTING', 'x_PPN_UGD', 'PPN_UGD', '[PPN_UGD]', 'CAST([PPN_UGD] AS NVARCHAR)', 131, 8, -1, false, '[PPN_UGD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPN_UGD->Sortable = true; // Allow sort
        $this->PPN_UGD->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPN_UGD->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPN_UGD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPN_UGD->Param, "CustomMsg");
        $this->Fields['PPN_UGD'] = &$this->PPN_UGD;

        // MARGINBEBAS
        $this->MARGINBEBAS = new DbField('SETTING', 'SETTING', 'x_MARGINBEBAS', 'MARGINBEBAS', '[MARGINBEBAS]', 'CAST([MARGINBEBAS] AS NVARCHAR)', 131, 8, -1, false, '[MARGINBEBAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGINBEBAS->Sortable = true; // Allow sort
        $this->MARGINBEBAS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGINBEBAS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGINBEBAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGINBEBAS->Param, "CustomMsg");
        $this->Fields['MARGINBEBAS'] = &$this->MARGINBEBAS;

        // MARGINGENERIK
        $this->MARGINGENERIK = new DbField('SETTING', 'SETTING', 'x_MARGINGENERIK', 'MARGINGENERIK', '[MARGINGENERIK]', 'CAST([MARGINGENERIK] AS NVARCHAR)', 131, 8, -1, false, '[MARGINGENERIK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGINGENERIK->Sortable = true; // Allow sort
        $this->MARGINGENERIK->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGINGENERIK->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGINGENERIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGINGENERIK->Param, "CustomMsg");
        $this->Fields['MARGINGENERIK'] = &$this->MARGINGENERIK;

        // MARGINOWA
        $this->MARGINOWA = new DbField('SETTING', 'SETTING', 'x_MARGINOWA', 'MARGINOWA', '[MARGINOWA]', 'CAST([MARGINOWA] AS NVARCHAR)', 131, 8, -1, false, '[MARGINOWA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGINOWA->Sortable = true; // Allow sort
        $this->MARGINOWA->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGINOWA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGINOWA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGINOWA->Param, "CustomMsg");
        $this->Fields['MARGINOWA'] = &$this->MARGINOWA;

        // MARGININTERNAL
        $this->MARGININTERNAL = new DbField('SETTING', 'SETTING', 'x_MARGININTERNAL', 'MARGININTERNAL', '[MARGININTERNAL]', 'CAST([MARGININTERNAL] AS NVARCHAR)', 131, 8, -1, false, '[MARGININTERNAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGININTERNAL->Sortable = true; // Allow sort
        $this->MARGININTERNAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGININTERNAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGININTERNAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGININTERNAL->Param, "CustomMsg");
        $this->Fields['MARGININTERNAL'] = &$this->MARGININTERNAL;

        // MARGINLUAR
        $this->MARGINLUAR = new DbField('SETTING', 'SETTING', 'x_MARGINLUAR', 'MARGINLUAR', '[MARGINLUAR]', 'CAST([MARGINLUAR] AS NVARCHAR)', 131, 8, -1, false, '[MARGINLUAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGINLUAR->Sortable = true; // Allow sort
        $this->MARGINLUAR->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGINLUAR->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGINLUAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGINLUAR->Param, "CustomMsg");
        $this->Fields['MARGINLUAR'] = &$this->MARGINLUAR;

        // MARGINVIP12
        $this->MARGINVIP12 = new DbField('SETTING', 'SETTING', 'x_MARGINVIP12', 'MARGINVIP12', '[MARGINVIP12]', 'CAST([MARGINVIP12] AS NVARCHAR)', 131, 8, -1, false, '[MARGINVIP12]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGINVIP12->Sortable = true; // Allow sort
        $this->MARGINVIP12->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGINVIP12->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGINVIP12->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGINVIP12->Param, "CustomMsg");
        $this->Fields['MARGINVIP12'] = &$this->MARGINVIP12;

        // MARGINRJ
        $this->MARGINRJ = new DbField('SETTING', 'SETTING', 'x_MARGINRJ', 'MARGINRJ', '[MARGINRJ]', 'CAST([MARGINRJ] AS NVARCHAR)', 131, 8, -1, false, '[MARGINRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGINRJ->Sortable = true; // Allow sort
        $this->MARGINRJ->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGINRJ->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGINRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGINRJ->Param, "CustomMsg");
        $this->Fields['MARGINRJ'] = &$this->MARGINRJ;

        // MARGIN2
        $this->MARGIN2 = new DbField('SETTING', 'SETTING', 'x_MARGIN2', 'MARGIN2', '[MARGIN2]', 'CAST([MARGIN2] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN2->Sortable = true; // Allow sort
        $this->MARGIN2->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN2->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN2->Param, "CustomMsg");
        $this->Fields['MARGIN2'] = &$this->MARGIN2;

        // MARGIN3
        $this->MARGIN3 = new DbField('SETTING', 'SETTING', 'x_MARGIN3', 'MARGIN3', '[MARGIN3]', 'CAST([MARGIN3] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN3->Sortable = true; // Allow sort
        $this->MARGIN3->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN3->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN3->Param, "CustomMsg");
        $this->Fields['MARGIN3'] = &$this->MARGIN3;

        // MARGIN4
        $this->MARGIN4 = new DbField('SETTING', 'SETTING', 'x_MARGIN4', 'MARGIN4', '[MARGIN4]', 'CAST([MARGIN4] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN4]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN4->Sortable = true; // Allow sort
        $this->MARGIN4->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN4->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN4->Param, "CustomMsg");
        $this->Fields['MARGIN4'] = &$this->MARGIN4;

        // MARGIN5
        $this->MARGIN5 = new DbField('SETTING', 'SETTING', 'x_MARGIN5', 'MARGIN5', '[MARGIN5]', 'CAST([MARGIN5] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN5]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN5->Sortable = true; // Allow sort
        $this->MARGIN5->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN5->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN5->Param, "CustomMsg");
        $this->Fields['MARGIN5'] = &$this->MARGIN5;

        // DISKON1
        $this->DISKON1 = new DbField('SETTING', 'SETTING', 'x_DISKON1', 'DISKON1', '[DISKON1]', 'CAST([DISKON1] AS NVARCHAR)', 131, 8, -1, false, '[DISKON1]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKON1->Sortable = true; // Allow sort
        $this->DISKON1->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKON1->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKON1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKON1->Param, "CustomMsg");
        $this->Fields['DISKON1'] = &$this->DISKON1;

        // DISKON2
        $this->DISKON2 = new DbField('SETTING', 'SETTING', 'x_DISKON2', 'DISKON2', '[DISKON2]', 'CAST([DISKON2] AS NVARCHAR)', 131, 8, -1, false, '[DISKON2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKON2->Sortable = true; // Allow sort
        $this->DISKON2->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKON2->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKON2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKON2->Param, "CustomMsg");
        $this->Fields['DISKON2'] = &$this->DISKON2;

        // DISKON3
        $this->DISKON3 = new DbField('SETTING', 'SETTING', 'x_DISKON3', 'DISKON3', '[DISKON3]', 'CAST([DISKON3] AS NVARCHAR)', 131, 8, -1, false, '[DISKON3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKON3->Sortable = true; // Allow sort
        $this->DISKON3->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKON3->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKON3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKON3->Param, "CustomMsg");
        $this->Fields['DISKON3'] = &$this->DISKON3;

        // DISKON4
        $this->DISKON4 = new DbField('SETTING', 'SETTING', 'x_DISKON4', 'DISKON4', '[DISKON4]', 'CAST([DISKON4] AS NVARCHAR)', 131, 8, -1, false, '[DISKON4]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKON4->Sortable = true; // Allow sort
        $this->DISKON4->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKON4->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKON4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKON4->Param, "CustomMsg");
        $this->Fields['DISKON4'] = &$this->DISKON4;

        // DISKON5
        $this->DISKON5 = new DbField('SETTING', 'SETTING', 'x_DISKON5', 'DISKON5', '[DISKON5]', 'CAST([DISKON5] AS NVARCHAR)', 131, 8, -1, false, '[DISKON5]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKON5->Sortable = true; // Allow sort
        $this->DISKON5->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKON5->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKON5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKON5->Param, "CustomMsg");
        $this->Fields['DISKON5'] = &$this->DISKON5;

        // DISKONBEBAS
        $this->DISKONBEBAS = new DbField('SETTING', 'SETTING', 'x_DISKONBEBAS', 'DISKONBEBAS', '[DISKONBEBAS]', 'CAST([DISKONBEBAS] AS NVARCHAR)', 131, 8, -1, false, '[DISKONBEBAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKONBEBAS->Sortable = true; // Allow sort
        $this->DISKONBEBAS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKONBEBAS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKONBEBAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKONBEBAS->Param, "CustomMsg");
        $this->Fields['DISKONBEBAS'] = &$this->DISKONBEBAS;

        // DISKONGENERIK
        $this->DISKONGENERIK = new DbField('SETTING', 'SETTING', 'x_DISKONGENERIK', 'DISKONGENERIK', '[DISKONGENERIK]', 'CAST([DISKONGENERIK] AS NVARCHAR)', 131, 8, -1, false, '[DISKONGENERIK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKONGENERIK->Sortable = true; // Allow sort
        $this->DISKONGENERIK->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKONGENERIK->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKONGENERIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKONGENERIK->Param, "CustomMsg");
        $this->Fields['DISKONGENERIK'] = &$this->DISKONGENERIK;

        // DISKONOWA
        $this->DISKONOWA = new DbField('SETTING', 'SETTING', 'x_DISKONOWA', 'DISKONOWA', '[DISKONOWA]', 'CAST([DISKONOWA] AS NVARCHAR)', 131, 8, -1, false, '[DISKONOWA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKONOWA->Sortable = true; // Allow sort
        $this->DISKONOWA->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKONOWA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKONOWA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKONOWA->Param, "CustomMsg");
        $this->Fields['DISKONOWA'] = &$this->DISKONOWA;

        // DISKONINTERNAL
        $this->DISKONINTERNAL = new DbField('SETTING', 'SETTING', 'x_DISKONINTERNAL', 'DISKONINTERNAL', '[DISKONINTERNAL]', 'CAST([DISKONINTERNAL] AS NVARCHAR)', 131, 8, -1, false, '[DISKONINTERNAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKONINTERNAL->Sortable = true; // Allow sort
        $this->DISKONINTERNAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKONINTERNAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKONINTERNAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKONINTERNAL->Param, "CustomMsg");
        $this->Fields['DISKONINTERNAL'] = &$this->DISKONINTERNAL;

        // DISKONLUAR
        $this->DISKONLUAR = new DbField('SETTING', 'SETTING', 'x_DISKONLUAR', 'DISKONLUAR', '[DISKONLUAR]', 'CAST([DISKONLUAR] AS NVARCHAR)', 131, 8, -1, false, '[DISKONLUAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKONLUAR->Sortable = true; // Allow sort
        $this->DISKONLUAR->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKONLUAR->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKONLUAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKONLUAR->Param, "CustomMsg");
        $this->Fields['DISKONLUAR'] = &$this->DISKONLUAR;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('SETTING', 'SETTING', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('SETTING', 'SETTING', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('SETTING', 'SETTING', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 100, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // STATUSCHANGED
        $this->STATUSCHANGED = new DbField('SETTING', 'SETTING', 'x_STATUSCHANGED', 'STATUSCHANGED', '[STATUSCHANGED]', 'CAST([STATUSCHANGED] AS NVARCHAR)', 131, 8, -1, false, '[STATUSCHANGED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUSCHANGED->Sortable = true; // Allow sort
        $this->STATUSCHANGED->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STATUSCHANGED->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STATUSCHANGED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUSCHANGED->Param, "CustomMsg");
        $this->Fields['STATUSCHANGED'] = &$this->STATUSCHANGED;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[SETTING]";
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
        $this->PPN->DbValue = $row['PPN'];
        $this->EMBALACE->DbValue = $row['EMBALACE'];
        $this->EMBALACER->DbValue = $row['EMBALACER'];
        $this->R_EMBALACE->DbValue = $row['R_EMBALACE'];
        $this->PROFESSION_COST->DbValue = $row['PROFESSION_COST'];
        $this->R_PROFESSION->DbValue = $row['R_PROFESSION'];
        $this->POKOK_JUAL->DbValue = $row['POKOK_JUAL'];
        $this->LEAD_TIME->DbValue = $row['LEAD_TIME'];
        $this->HOLDING_COSTP->DbValue = $row['HOLDING_COSTP'];
        $this->ORDERING_COST->DbValue = $row['ORDERING_COST'];
        $this->PAGU->DbValue = $row['PAGU'];
        $this->PPN_RJ->DbValue = $row['PPN_RJ'];
        $this->PPN_RI->DbValue = $row['PPN_RI'];
        $this->PPN_UGD->DbValue = $row['PPN_UGD'];
        $this->MARGINBEBAS->DbValue = $row['MARGINBEBAS'];
        $this->MARGINGENERIK->DbValue = $row['MARGINGENERIK'];
        $this->MARGINOWA->DbValue = $row['MARGINOWA'];
        $this->MARGININTERNAL->DbValue = $row['MARGININTERNAL'];
        $this->MARGINLUAR->DbValue = $row['MARGINLUAR'];
        $this->MARGINVIP12->DbValue = $row['MARGINVIP12'];
        $this->MARGINRJ->DbValue = $row['MARGINRJ'];
        $this->MARGIN2->DbValue = $row['MARGIN2'];
        $this->MARGIN3->DbValue = $row['MARGIN3'];
        $this->MARGIN4->DbValue = $row['MARGIN4'];
        $this->MARGIN5->DbValue = $row['MARGIN5'];
        $this->DISKON1->DbValue = $row['DISKON1'];
        $this->DISKON2->DbValue = $row['DISKON2'];
        $this->DISKON3->DbValue = $row['DISKON3'];
        $this->DISKON4->DbValue = $row['DISKON4'];
        $this->DISKON5->DbValue = $row['DISKON5'];
        $this->DISKONBEBAS->DbValue = $row['DISKONBEBAS'];
        $this->DISKONGENERIK->DbValue = $row['DISKONGENERIK'];
        $this->DISKONOWA->DbValue = $row['DISKONOWA'];
        $this->DISKONINTERNAL->DbValue = $row['DISKONINTERNAL'];
        $this->DISKONLUAR->DbValue = $row['DISKONLUAR'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->STATUSCHANGED->DbValue = $row['STATUSCHANGED'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@'";
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
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
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
        return $_SESSION[$name] ?? GetUrl("SettingList");
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
        if ($pageName == "SettingView") {
            return $Language->phrase("View");
        } elseif ($pageName == "SettingEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "SettingAdd") {
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
                return "SettingView";
            case Config("API_ADD_ACTION"):
                return "SettingAdd";
            case Config("API_EDIT_ACTION"):
                return "SettingEdit";
            case Config("API_DELETE_ACTION"):
                return "SettingDelete";
            case Config("API_LIST_ACTION"):
                return "SettingList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "SettingList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SettingView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("SettingView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SettingAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "SettingAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SettingEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("SettingAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("SettingDelete", $this->getUrlParm());
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
            if (($keyValue = Param("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
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
                $this->ORG_UNIT_CODE->CurrentValue = $key;
            } else {
                $this->ORG_UNIT_CODE->OldValue = $key;
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
        $this->PPN->setDbValue($row['PPN']);
        $this->EMBALACE->setDbValue($row['EMBALACE']);
        $this->EMBALACER->setDbValue($row['EMBALACER']);
        $this->R_EMBALACE->setDbValue($row['R_EMBALACE']);
        $this->PROFESSION_COST->setDbValue($row['PROFESSION_COST']);
        $this->R_PROFESSION->setDbValue($row['R_PROFESSION']);
        $this->POKOK_JUAL->setDbValue($row['POKOK_JUAL']);
        $this->LEAD_TIME->setDbValue($row['LEAD_TIME']);
        $this->HOLDING_COSTP->setDbValue($row['HOLDING_COSTP']);
        $this->ORDERING_COST->setDbValue($row['ORDERING_COST']);
        $this->PAGU->setDbValue($row['PAGU']);
        $this->PPN_RJ->setDbValue($row['PPN_RJ']);
        $this->PPN_RI->setDbValue($row['PPN_RI']);
        $this->PPN_UGD->setDbValue($row['PPN_UGD']);
        $this->MARGINBEBAS->setDbValue($row['MARGINBEBAS']);
        $this->MARGINGENERIK->setDbValue($row['MARGINGENERIK']);
        $this->MARGINOWA->setDbValue($row['MARGINOWA']);
        $this->MARGININTERNAL->setDbValue($row['MARGININTERNAL']);
        $this->MARGINLUAR->setDbValue($row['MARGINLUAR']);
        $this->MARGINVIP12->setDbValue($row['MARGINVIP12']);
        $this->MARGINRJ->setDbValue($row['MARGINRJ']);
        $this->MARGIN2->setDbValue($row['MARGIN2']);
        $this->MARGIN3->setDbValue($row['MARGIN3']);
        $this->MARGIN4->setDbValue($row['MARGIN4']);
        $this->MARGIN5->setDbValue($row['MARGIN5']);
        $this->DISKON1->setDbValue($row['DISKON1']);
        $this->DISKON2->setDbValue($row['DISKON2']);
        $this->DISKON3->setDbValue($row['DISKON3']);
        $this->DISKON4->setDbValue($row['DISKON4']);
        $this->DISKON5->setDbValue($row['DISKON5']);
        $this->DISKONBEBAS->setDbValue($row['DISKONBEBAS']);
        $this->DISKONGENERIK->setDbValue($row['DISKONGENERIK']);
        $this->DISKONOWA->setDbValue($row['DISKONOWA']);
        $this->DISKONINTERNAL->setDbValue($row['DISKONINTERNAL']);
        $this->DISKONLUAR->setDbValue($row['DISKONLUAR']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->STATUSCHANGED->setDbValue($row['STATUSCHANGED']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // PPN

        // EMBALACE

        // EMBALACER

        // R_EMBALACE

        // PROFESSION_COST

        // R_PROFESSION

        // POKOK_JUAL

        // LEAD_TIME

        // HOLDING_COSTP

        // ORDERING_COST

        // PAGU

        // PPN_RJ

        // PPN_RI

        // PPN_UGD

        // MARGINBEBAS

        // MARGINGENERIK

        // MARGINOWA

        // MARGININTERNAL

        // MARGINLUAR

        // MARGINVIP12

        // MARGINRJ

        // MARGIN2

        // MARGIN3

        // MARGIN4

        // MARGIN5

        // DISKON1

        // DISKON2

        // DISKON3

        // DISKON4

        // DISKON5

        // DISKONBEBAS

        // DISKONGENERIK

        // DISKONOWA

        // DISKONINTERNAL

        // DISKONLUAR

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // STATUSCHANGED

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // PPN
        $this->PPN->ViewValue = $this->PPN->CurrentValue;
        $this->PPN->ViewValue = FormatNumber($this->PPN->ViewValue, 2, -2, -2, -2);
        $this->PPN->ViewCustomAttributes = "";

        // EMBALACE
        $this->EMBALACE->ViewValue = $this->EMBALACE->CurrentValue;
        $this->EMBALACE->ViewValue = FormatNumber($this->EMBALACE->ViewValue, 2, -2, -2, -2);
        $this->EMBALACE->ViewCustomAttributes = "";

        // EMBALACER
        $this->EMBALACER->ViewValue = $this->EMBALACER->CurrentValue;
        $this->EMBALACER->ViewValue = FormatNumber($this->EMBALACER->ViewValue, 2, -2, -2, -2);
        $this->EMBALACER->ViewCustomAttributes = "";

        // R_EMBALACE
        $this->R_EMBALACE->ViewValue = $this->R_EMBALACE->CurrentValue;
        $this->R_EMBALACE->ViewCustomAttributes = "";

        // PROFESSION_COST
        $this->PROFESSION_COST->ViewValue = $this->PROFESSION_COST->CurrentValue;
        $this->PROFESSION_COST->ViewValue = FormatNumber($this->PROFESSION_COST->ViewValue, 2, -2, -2, -2);
        $this->PROFESSION_COST->ViewCustomAttributes = "";

        // R_PROFESSION
        $this->R_PROFESSION->ViewValue = $this->R_PROFESSION->CurrentValue;
        $this->R_PROFESSION->ViewCustomAttributes = "";

        // POKOK_JUAL
        $this->POKOK_JUAL->ViewValue = $this->POKOK_JUAL->CurrentValue;
        $this->POKOK_JUAL->ViewValue = FormatNumber($this->POKOK_JUAL->ViewValue, 2, -2, -2, -2);
        $this->POKOK_JUAL->ViewCustomAttributes = "";

        // LEAD_TIME
        $this->LEAD_TIME->ViewValue = $this->LEAD_TIME->CurrentValue;
        $this->LEAD_TIME->ViewValue = FormatNumber($this->LEAD_TIME->ViewValue, 0, -2, -2, -2);
        $this->LEAD_TIME->ViewCustomAttributes = "";

        // HOLDING_COSTP
        $this->HOLDING_COSTP->ViewValue = $this->HOLDING_COSTP->CurrentValue;
        $this->HOLDING_COSTP->ViewValue = FormatNumber($this->HOLDING_COSTP->ViewValue, 2, -2, -2, -2);
        $this->HOLDING_COSTP->ViewCustomAttributes = "";

        // ORDERING_COST
        $this->ORDERING_COST->ViewValue = $this->ORDERING_COST->CurrentValue;
        $this->ORDERING_COST->ViewValue = FormatNumber($this->ORDERING_COST->ViewValue, 2, -2, -2, -2);
        $this->ORDERING_COST->ViewCustomAttributes = "";

        // PAGU
        $this->PAGU->ViewValue = $this->PAGU->CurrentValue;
        $this->PAGU->ViewValue = FormatNumber($this->PAGU->ViewValue, 2, -2, -2, -2);
        $this->PAGU->ViewCustomAttributes = "";

        // PPN_RJ
        $this->PPN_RJ->ViewValue = $this->PPN_RJ->CurrentValue;
        $this->PPN_RJ->ViewValue = FormatNumber($this->PPN_RJ->ViewValue, 2, -2, -2, -2);
        $this->PPN_RJ->ViewCustomAttributes = "";

        // PPN_RI
        $this->PPN_RI->ViewValue = $this->PPN_RI->CurrentValue;
        $this->PPN_RI->ViewValue = FormatNumber($this->PPN_RI->ViewValue, 2, -2, -2, -2);
        $this->PPN_RI->ViewCustomAttributes = "";

        // PPN_UGD
        $this->PPN_UGD->ViewValue = $this->PPN_UGD->CurrentValue;
        $this->PPN_UGD->ViewValue = FormatNumber($this->PPN_UGD->ViewValue, 2, -2, -2, -2);
        $this->PPN_UGD->ViewCustomAttributes = "";

        // MARGINBEBAS
        $this->MARGINBEBAS->ViewValue = $this->MARGINBEBAS->CurrentValue;
        $this->MARGINBEBAS->ViewValue = FormatNumber($this->MARGINBEBAS->ViewValue, 2, -2, -2, -2);
        $this->MARGINBEBAS->ViewCustomAttributes = "";

        // MARGINGENERIK
        $this->MARGINGENERIK->ViewValue = $this->MARGINGENERIK->CurrentValue;
        $this->MARGINGENERIK->ViewValue = FormatNumber($this->MARGINGENERIK->ViewValue, 2, -2, -2, -2);
        $this->MARGINGENERIK->ViewCustomAttributes = "";

        // MARGINOWA
        $this->MARGINOWA->ViewValue = $this->MARGINOWA->CurrentValue;
        $this->MARGINOWA->ViewValue = FormatNumber($this->MARGINOWA->ViewValue, 2, -2, -2, -2);
        $this->MARGINOWA->ViewCustomAttributes = "";

        // MARGININTERNAL
        $this->MARGININTERNAL->ViewValue = $this->MARGININTERNAL->CurrentValue;
        $this->MARGININTERNAL->ViewValue = FormatNumber($this->MARGININTERNAL->ViewValue, 2, -2, -2, -2);
        $this->MARGININTERNAL->ViewCustomAttributes = "";

        // MARGINLUAR
        $this->MARGINLUAR->ViewValue = $this->MARGINLUAR->CurrentValue;
        $this->MARGINLUAR->ViewValue = FormatNumber($this->MARGINLUAR->ViewValue, 2, -2, -2, -2);
        $this->MARGINLUAR->ViewCustomAttributes = "";

        // MARGINVIP12
        $this->MARGINVIP12->ViewValue = $this->MARGINVIP12->CurrentValue;
        $this->MARGINVIP12->ViewValue = FormatNumber($this->MARGINVIP12->ViewValue, 2, -2, -2, -2);
        $this->MARGINVIP12->ViewCustomAttributes = "";

        // MARGINRJ
        $this->MARGINRJ->ViewValue = $this->MARGINRJ->CurrentValue;
        $this->MARGINRJ->ViewValue = FormatNumber($this->MARGINRJ->ViewValue, 2, -2, -2, -2);
        $this->MARGINRJ->ViewCustomAttributes = "";

        // MARGIN2
        $this->MARGIN2->ViewValue = $this->MARGIN2->CurrentValue;
        $this->MARGIN2->ViewValue = FormatNumber($this->MARGIN2->ViewValue, 2, -2, -2, -2);
        $this->MARGIN2->ViewCustomAttributes = "";

        // MARGIN3
        $this->MARGIN3->ViewValue = $this->MARGIN3->CurrentValue;
        $this->MARGIN3->ViewValue = FormatNumber($this->MARGIN3->ViewValue, 2, -2, -2, -2);
        $this->MARGIN3->ViewCustomAttributes = "";

        // MARGIN4
        $this->MARGIN4->ViewValue = $this->MARGIN4->CurrentValue;
        $this->MARGIN4->ViewValue = FormatNumber($this->MARGIN4->ViewValue, 2, -2, -2, -2);
        $this->MARGIN4->ViewCustomAttributes = "";

        // MARGIN5
        $this->MARGIN5->ViewValue = $this->MARGIN5->CurrentValue;
        $this->MARGIN5->ViewValue = FormatNumber($this->MARGIN5->ViewValue, 2, -2, -2, -2);
        $this->MARGIN5->ViewCustomAttributes = "";

        // DISKON1
        $this->DISKON1->ViewValue = $this->DISKON1->CurrentValue;
        $this->DISKON1->ViewValue = FormatNumber($this->DISKON1->ViewValue, 2, -2, -2, -2);
        $this->DISKON1->ViewCustomAttributes = "";

        // DISKON2
        $this->DISKON2->ViewValue = $this->DISKON2->CurrentValue;
        $this->DISKON2->ViewValue = FormatNumber($this->DISKON2->ViewValue, 2, -2, -2, -2);
        $this->DISKON2->ViewCustomAttributes = "";

        // DISKON3
        $this->DISKON3->ViewValue = $this->DISKON3->CurrentValue;
        $this->DISKON3->ViewValue = FormatNumber($this->DISKON3->ViewValue, 2, -2, -2, -2);
        $this->DISKON3->ViewCustomAttributes = "";

        // DISKON4
        $this->DISKON4->ViewValue = $this->DISKON4->CurrentValue;
        $this->DISKON4->ViewValue = FormatNumber($this->DISKON4->ViewValue, 2, -2, -2, -2);
        $this->DISKON4->ViewCustomAttributes = "";

        // DISKON5
        $this->DISKON5->ViewValue = $this->DISKON5->CurrentValue;
        $this->DISKON5->ViewValue = FormatNumber($this->DISKON5->ViewValue, 2, -2, -2, -2);
        $this->DISKON5->ViewCustomAttributes = "";

        // DISKONBEBAS
        $this->DISKONBEBAS->ViewValue = $this->DISKONBEBAS->CurrentValue;
        $this->DISKONBEBAS->ViewValue = FormatNumber($this->DISKONBEBAS->ViewValue, 2, -2, -2, -2);
        $this->DISKONBEBAS->ViewCustomAttributes = "";

        // DISKONGENERIK
        $this->DISKONGENERIK->ViewValue = $this->DISKONGENERIK->CurrentValue;
        $this->DISKONGENERIK->ViewValue = FormatNumber($this->DISKONGENERIK->ViewValue, 2, -2, -2, -2);
        $this->DISKONGENERIK->ViewCustomAttributes = "";

        // DISKONOWA
        $this->DISKONOWA->ViewValue = $this->DISKONOWA->CurrentValue;
        $this->DISKONOWA->ViewValue = FormatNumber($this->DISKONOWA->ViewValue, 2, -2, -2, -2);
        $this->DISKONOWA->ViewCustomAttributes = "";

        // DISKONINTERNAL
        $this->DISKONINTERNAL->ViewValue = $this->DISKONINTERNAL->CurrentValue;
        $this->DISKONINTERNAL->ViewValue = FormatNumber($this->DISKONINTERNAL->ViewValue, 2, -2, -2, -2);
        $this->DISKONINTERNAL->ViewCustomAttributes = "";

        // DISKONLUAR
        $this->DISKONLUAR->ViewValue = $this->DISKONLUAR->CurrentValue;
        $this->DISKONLUAR->ViewValue = FormatNumber($this->DISKONLUAR->ViewValue, 2, -2, -2, -2);
        $this->DISKONLUAR->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->ViewCustomAttributes = "";

        // STATUSCHANGED
        $this->STATUSCHANGED->ViewValue = $this->STATUSCHANGED->CurrentValue;
        $this->STATUSCHANGED->ViewValue = FormatNumber($this->STATUSCHANGED->ViewValue, 2, -2, -2, -2);
        $this->STATUSCHANGED->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // PPN
        $this->PPN->LinkCustomAttributes = "";
        $this->PPN->HrefValue = "";
        $this->PPN->TooltipValue = "";

        // EMBALACE
        $this->EMBALACE->LinkCustomAttributes = "";
        $this->EMBALACE->HrefValue = "";
        $this->EMBALACE->TooltipValue = "";

        // EMBALACER
        $this->EMBALACER->LinkCustomAttributes = "";
        $this->EMBALACER->HrefValue = "";
        $this->EMBALACER->TooltipValue = "";

        // R_EMBALACE
        $this->R_EMBALACE->LinkCustomAttributes = "";
        $this->R_EMBALACE->HrefValue = "";
        $this->R_EMBALACE->TooltipValue = "";

        // PROFESSION_COST
        $this->PROFESSION_COST->LinkCustomAttributes = "";
        $this->PROFESSION_COST->HrefValue = "";
        $this->PROFESSION_COST->TooltipValue = "";

        // R_PROFESSION
        $this->R_PROFESSION->LinkCustomAttributes = "";
        $this->R_PROFESSION->HrefValue = "";
        $this->R_PROFESSION->TooltipValue = "";

        // POKOK_JUAL
        $this->POKOK_JUAL->LinkCustomAttributes = "";
        $this->POKOK_JUAL->HrefValue = "";
        $this->POKOK_JUAL->TooltipValue = "";

        // LEAD_TIME
        $this->LEAD_TIME->LinkCustomAttributes = "";
        $this->LEAD_TIME->HrefValue = "";
        $this->LEAD_TIME->TooltipValue = "";

        // HOLDING_COSTP
        $this->HOLDING_COSTP->LinkCustomAttributes = "";
        $this->HOLDING_COSTP->HrefValue = "";
        $this->HOLDING_COSTP->TooltipValue = "";

        // ORDERING_COST
        $this->ORDERING_COST->LinkCustomAttributes = "";
        $this->ORDERING_COST->HrefValue = "";
        $this->ORDERING_COST->TooltipValue = "";

        // PAGU
        $this->PAGU->LinkCustomAttributes = "";
        $this->PAGU->HrefValue = "";
        $this->PAGU->TooltipValue = "";

        // PPN_RJ
        $this->PPN_RJ->LinkCustomAttributes = "";
        $this->PPN_RJ->HrefValue = "";
        $this->PPN_RJ->TooltipValue = "";

        // PPN_RI
        $this->PPN_RI->LinkCustomAttributes = "";
        $this->PPN_RI->HrefValue = "";
        $this->PPN_RI->TooltipValue = "";

        // PPN_UGD
        $this->PPN_UGD->LinkCustomAttributes = "";
        $this->PPN_UGD->HrefValue = "";
        $this->PPN_UGD->TooltipValue = "";

        // MARGINBEBAS
        $this->MARGINBEBAS->LinkCustomAttributes = "";
        $this->MARGINBEBAS->HrefValue = "";
        $this->MARGINBEBAS->TooltipValue = "";

        // MARGINGENERIK
        $this->MARGINGENERIK->LinkCustomAttributes = "";
        $this->MARGINGENERIK->HrefValue = "";
        $this->MARGINGENERIK->TooltipValue = "";

        // MARGINOWA
        $this->MARGINOWA->LinkCustomAttributes = "";
        $this->MARGINOWA->HrefValue = "";
        $this->MARGINOWA->TooltipValue = "";

        // MARGININTERNAL
        $this->MARGININTERNAL->LinkCustomAttributes = "";
        $this->MARGININTERNAL->HrefValue = "";
        $this->MARGININTERNAL->TooltipValue = "";

        // MARGINLUAR
        $this->MARGINLUAR->LinkCustomAttributes = "";
        $this->MARGINLUAR->HrefValue = "";
        $this->MARGINLUAR->TooltipValue = "";

        // MARGINVIP12
        $this->MARGINVIP12->LinkCustomAttributes = "";
        $this->MARGINVIP12->HrefValue = "";
        $this->MARGINVIP12->TooltipValue = "";

        // MARGINRJ
        $this->MARGINRJ->LinkCustomAttributes = "";
        $this->MARGINRJ->HrefValue = "";
        $this->MARGINRJ->TooltipValue = "";

        // MARGIN2
        $this->MARGIN2->LinkCustomAttributes = "";
        $this->MARGIN2->HrefValue = "";
        $this->MARGIN2->TooltipValue = "";

        // MARGIN3
        $this->MARGIN3->LinkCustomAttributes = "";
        $this->MARGIN3->HrefValue = "";
        $this->MARGIN3->TooltipValue = "";

        // MARGIN4
        $this->MARGIN4->LinkCustomAttributes = "";
        $this->MARGIN4->HrefValue = "";
        $this->MARGIN4->TooltipValue = "";

        // MARGIN5
        $this->MARGIN5->LinkCustomAttributes = "";
        $this->MARGIN5->HrefValue = "";
        $this->MARGIN5->TooltipValue = "";

        // DISKON1
        $this->DISKON1->LinkCustomAttributes = "";
        $this->DISKON1->HrefValue = "";
        $this->DISKON1->TooltipValue = "";

        // DISKON2
        $this->DISKON2->LinkCustomAttributes = "";
        $this->DISKON2->HrefValue = "";
        $this->DISKON2->TooltipValue = "";

        // DISKON3
        $this->DISKON3->LinkCustomAttributes = "";
        $this->DISKON3->HrefValue = "";
        $this->DISKON3->TooltipValue = "";

        // DISKON4
        $this->DISKON4->LinkCustomAttributes = "";
        $this->DISKON4->HrefValue = "";
        $this->DISKON4->TooltipValue = "";

        // DISKON5
        $this->DISKON5->LinkCustomAttributes = "";
        $this->DISKON5->HrefValue = "";
        $this->DISKON5->TooltipValue = "";

        // DISKONBEBAS
        $this->DISKONBEBAS->LinkCustomAttributes = "";
        $this->DISKONBEBAS->HrefValue = "";
        $this->DISKONBEBAS->TooltipValue = "";

        // DISKONGENERIK
        $this->DISKONGENERIK->LinkCustomAttributes = "";
        $this->DISKONGENERIK->HrefValue = "";
        $this->DISKONGENERIK->TooltipValue = "";

        // DISKONOWA
        $this->DISKONOWA->LinkCustomAttributes = "";
        $this->DISKONOWA->HrefValue = "";
        $this->DISKONOWA->TooltipValue = "";

        // DISKONINTERNAL
        $this->DISKONINTERNAL->LinkCustomAttributes = "";
        $this->DISKONINTERNAL->HrefValue = "";
        $this->DISKONINTERNAL->TooltipValue = "";

        // DISKONLUAR
        $this->DISKONLUAR->LinkCustomAttributes = "";
        $this->DISKONLUAR->HrefValue = "";
        $this->DISKONLUAR->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->LinkCustomAttributes = "";
        $this->MODIFIED_FROM->HrefValue = "";
        $this->MODIFIED_FROM->TooltipValue = "";

        // STATUSCHANGED
        $this->STATUSCHANGED->LinkCustomAttributes = "";
        $this->STATUSCHANGED->HrefValue = "";
        $this->STATUSCHANGED->TooltipValue = "";

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

        // PPN
        $this->PPN->EditAttrs["class"] = "form-control";
        $this->PPN->EditCustomAttributes = "";
        $this->PPN->EditValue = $this->PPN->CurrentValue;
        $this->PPN->PlaceHolder = RemoveHtml($this->PPN->caption());
        if (strval($this->PPN->EditValue) != "" && is_numeric($this->PPN->EditValue)) {
            $this->PPN->EditValue = FormatNumber($this->PPN->EditValue, -2, -2, -2, -2);
        }

        // EMBALACE
        $this->EMBALACE->EditAttrs["class"] = "form-control";
        $this->EMBALACE->EditCustomAttributes = "";
        $this->EMBALACE->EditValue = $this->EMBALACE->CurrentValue;
        $this->EMBALACE->PlaceHolder = RemoveHtml($this->EMBALACE->caption());
        if (strval($this->EMBALACE->EditValue) != "" && is_numeric($this->EMBALACE->EditValue)) {
            $this->EMBALACE->EditValue = FormatNumber($this->EMBALACE->EditValue, -2, -2, -2, -2);
        }

        // EMBALACER
        $this->EMBALACER->EditAttrs["class"] = "form-control";
        $this->EMBALACER->EditCustomAttributes = "";
        $this->EMBALACER->EditValue = $this->EMBALACER->CurrentValue;
        $this->EMBALACER->PlaceHolder = RemoveHtml($this->EMBALACER->caption());
        if (strval($this->EMBALACER->EditValue) != "" && is_numeric($this->EMBALACER->EditValue)) {
            $this->EMBALACER->EditValue = FormatNumber($this->EMBALACER->EditValue, -2, -2, -2, -2);
        }

        // R_EMBALACE
        $this->R_EMBALACE->EditAttrs["class"] = "form-control";
        $this->R_EMBALACE->EditCustomAttributes = "";
        if (!$this->R_EMBALACE->Raw) {
            $this->R_EMBALACE->CurrentValue = HtmlDecode($this->R_EMBALACE->CurrentValue);
        }
        $this->R_EMBALACE->EditValue = $this->R_EMBALACE->CurrentValue;
        $this->R_EMBALACE->PlaceHolder = RemoveHtml($this->R_EMBALACE->caption());

        // PROFESSION_COST
        $this->PROFESSION_COST->EditAttrs["class"] = "form-control";
        $this->PROFESSION_COST->EditCustomAttributes = "";
        $this->PROFESSION_COST->EditValue = $this->PROFESSION_COST->CurrentValue;
        $this->PROFESSION_COST->PlaceHolder = RemoveHtml($this->PROFESSION_COST->caption());
        if (strval($this->PROFESSION_COST->EditValue) != "" && is_numeric($this->PROFESSION_COST->EditValue)) {
            $this->PROFESSION_COST->EditValue = FormatNumber($this->PROFESSION_COST->EditValue, -2, -2, -2, -2);
        }

        // R_PROFESSION
        $this->R_PROFESSION->EditAttrs["class"] = "form-control";
        $this->R_PROFESSION->EditCustomAttributes = "";
        if (!$this->R_PROFESSION->Raw) {
            $this->R_PROFESSION->CurrentValue = HtmlDecode($this->R_PROFESSION->CurrentValue);
        }
        $this->R_PROFESSION->EditValue = $this->R_PROFESSION->CurrentValue;
        $this->R_PROFESSION->PlaceHolder = RemoveHtml($this->R_PROFESSION->caption());

        // POKOK_JUAL
        $this->POKOK_JUAL->EditAttrs["class"] = "form-control";
        $this->POKOK_JUAL->EditCustomAttributes = "";
        $this->POKOK_JUAL->EditValue = $this->POKOK_JUAL->CurrentValue;
        $this->POKOK_JUAL->PlaceHolder = RemoveHtml($this->POKOK_JUAL->caption());
        if (strval($this->POKOK_JUAL->EditValue) != "" && is_numeric($this->POKOK_JUAL->EditValue)) {
            $this->POKOK_JUAL->EditValue = FormatNumber($this->POKOK_JUAL->EditValue, -2, -2, -2, -2);
        }

        // LEAD_TIME
        $this->LEAD_TIME->EditAttrs["class"] = "form-control";
        $this->LEAD_TIME->EditCustomAttributes = "";
        $this->LEAD_TIME->EditValue = $this->LEAD_TIME->CurrentValue;
        $this->LEAD_TIME->PlaceHolder = RemoveHtml($this->LEAD_TIME->caption());

        // HOLDING_COSTP
        $this->HOLDING_COSTP->EditAttrs["class"] = "form-control";
        $this->HOLDING_COSTP->EditCustomAttributes = "";
        $this->HOLDING_COSTP->EditValue = $this->HOLDING_COSTP->CurrentValue;
        $this->HOLDING_COSTP->PlaceHolder = RemoveHtml($this->HOLDING_COSTP->caption());
        if (strval($this->HOLDING_COSTP->EditValue) != "" && is_numeric($this->HOLDING_COSTP->EditValue)) {
            $this->HOLDING_COSTP->EditValue = FormatNumber($this->HOLDING_COSTP->EditValue, -2, -2, -2, -2);
        }

        // ORDERING_COST
        $this->ORDERING_COST->EditAttrs["class"] = "form-control";
        $this->ORDERING_COST->EditCustomAttributes = "";
        $this->ORDERING_COST->EditValue = $this->ORDERING_COST->CurrentValue;
        $this->ORDERING_COST->PlaceHolder = RemoveHtml($this->ORDERING_COST->caption());
        if (strval($this->ORDERING_COST->EditValue) != "" && is_numeric($this->ORDERING_COST->EditValue)) {
            $this->ORDERING_COST->EditValue = FormatNumber($this->ORDERING_COST->EditValue, -2, -2, -2, -2);
        }

        // PAGU
        $this->PAGU->EditAttrs["class"] = "form-control";
        $this->PAGU->EditCustomAttributes = "";
        $this->PAGU->EditValue = $this->PAGU->CurrentValue;
        $this->PAGU->PlaceHolder = RemoveHtml($this->PAGU->caption());
        if (strval($this->PAGU->EditValue) != "" && is_numeric($this->PAGU->EditValue)) {
            $this->PAGU->EditValue = FormatNumber($this->PAGU->EditValue, -2, -2, -2, -2);
        }

        // PPN_RJ
        $this->PPN_RJ->EditAttrs["class"] = "form-control";
        $this->PPN_RJ->EditCustomAttributes = "";
        $this->PPN_RJ->EditValue = $this->PPN_RJ->CurrentValue;
        $this->PPN_RJ->PlaceHolder = RemoveHtml($this->PPN_RJ->caption());
        if (strval($this->PPN_RJ->EditValue) != "" && is_numeric($this->PPN_RJ->EditValue)) {
            $this->PPN_RJ->EditValue = FormatNumber($this->PPN_RJ->EditValue, -2, -2, -2, -2);
        }

        // PPN_RI
        $this->PPN_RI->EditAttrs["class"] = "form-control";
        $this->PPN_RI->EditCustomAttributes = "";
        $this->PPN_RI->EditValue = $this->PPN_RI->CurrentValue;
        $this->PPN_RI->PlaceHolder = RemoveHtml($this->PPN_RI->caption());
        if (strval($this->PPN_RI->EditValue) != "" && is_numeric($this->PPN_RI->EditValue)) {
            $this->PPN_RI->EditValue = FormatNumber($this->PPN_RI->EditValue, -2, -2, -2, -2);
        }

        // PPN_UGD
        $this->PPN_UGD->EditAttrs["class"] = "form-control";
        $this->PPN_UGD->EditCustomAttributes = "";
        $this->PPN_UGD->EditValue = $this->PPN_UGD->CurrentValue;
        $this->PPN_UGD->PlaceHolder = RemoveHtml($this->PPN_UGD->caption());
        if (strval($this->PPN_UGD->EditValue) != "" && is_numeric($this->PPN_UGD->EditValue)) {
            $this->PPN_UGD->EditValue = FormatNumber($this->PPN_UGD->EditValue, -2, -2, -2, -2);
        }

        // MARGINBEBAS
        $this->MARGINBEBAS->EditAttrs["class"] = "form-control";
        $this->MARGINBEBAS->EditCustomAttributes = "";
        $this->MARGINBEBAS->EditValue = $this->MARGINBEBAS->CurrentValue;
        $this->MARGINBEBAS->PlaceHolder = RemoveHtml($this->MARGINBEBAS->caption());
        if (strval($this->MARGINBEBAS->EditValue) != "" && is_numeric($this->MARGINBEBAS->EditValue)) {
            $this->MARGINBEBAS->EditValue = FormatNumber($this->MARGINBEBAS->EditValue, -2, -2, -2, -2);
        }

        // MARGINGENERIK
        $this->MARGINGENERIK->EditAttrs["class"] = "form-control";
        $this->MARGINGENERIK->EditCustomAttributes = "";
        $this->MARGINGENERIK->EditValue = $this->MARGINGENERIK->CurrentValue;
        $this->MARGINGENERIK->PlaceHolder = RemoveHtml($this->MARGINGENERIK->caption());
        if (strval($this->MARGINGENERIK->EditValue) != "" && is_numeric($this->MARGINGENERIK->EditValue)) {
            $this->MARGINGENERIK->EditValue = FormatNumber($this->MARGINGENERIK->EditValue, -2, -2, -2, -2);
        }

        // MARGINOWA
        $this->MARGINOWA->EditAttrs["class"] = "form-control";
        $this->MARGINOWA->EditCustomAttributes = "";
        $this->MARGINOWA->EditValue = $this->MARGINOWA->CurrentValue;
        $this->MARGINOWA->PlaceHolder = RemoveHtml($this->MARGINOWA->caption());
        if (strval($this->MARGINOWA->EditValue) != "" && is_numeric($this->MARGINOWA->EditValue)) {
            $this->MARGINOWA->EditValue = FormatNumber($this->MARGINOWA->EditValue, -2, -2, -2, -2);
        }

        // MARGININTERNAL
        $this->MARGININTERNAL->EditAttrs["class"] = "form-control";
        $this->MARGININTERNAL->EditCustomAttributes = "";
        $this->MARGININTERNAL->EditValue = $this->MARGININTERNAL->CurrentValue;
        $this->MARGININTERNAL->PlaceHolder = RemoveHtml($this->MARGININTERNAL->caption());
        if (strval($this->MARGININTERNAL->EditValue) != "" && is_numeric($this->MARGININTERNAL->EditValue)) {
            $this->MARGININTERNAL->EditValue = FormatNumber($this->MARGININTERNAL->EditValue, -2, -2, -2, -2);
        }

        // MARGINLUAR
        $this->MARGINLUAR->EditAttrs["class"] = "form-control";
        $this->MARGINLUAR->EditCustomAttributes = "";
        $this->MARGINLUAR->EditValue = $this->MARGINLUAR->CurrentValue;
        $this->MARGINLUAR->PlaceHolder = RemoveHtml($this->MARGINLUAR->caption());
        if (strval($this->MARGINLUAR->EditValue) != "" && is_numeric($this->MARGINLUAR->EditValue)) {
            $this->MARGINLUAR->EditValue = FormatNumber($this->MARGINLUAR->EditValue, -2, -2, -2, -2);
        }

        // MARGINVIP12
        $this->MARGINVIP12->EditAttrs["class"] = "form-control";
        $this->MARGINVIP12->EditCustomAttributes = "";
        $this->MARGINVIP12->EditValue = $this->MARGINVIP12->CurrentValue;
        $this->MARGINVIP12->PlaceHolder = RemoveHtml($this->MARGINVIP12->caption());
        if (strval($this->MARGINVIP12->EditValue) != "" && is_numeric($this->MARGINVIP12->EditValue)) {
            $this->MARGINVIP12->EditValue = FormatNumber($this->MARGINVIP12->EditValue, -2, -2, -2, -2);
        }

        // MARGINRJ
        $this->MARGINRJ->EditAttrs["class"] = "form-control";
        $this->MARGINRJ->EditCustomAttributes = "";
        $this->MARGINRJ->EditValue = $this->MARGINRJ->CurrentValue;
        $this->MARGINRJ->PlaceHolder = RemoveHtml($this->MARGINRJ->caption());
        if (strval($this->MARGINRJ->EditValue) != "" && is_numeric($this->MARGINRJ->EditValue)) {
            $this->MARGINRJ->EditValue = FormatNumber($this->MARGINRJ->EditValue, -2, -2, -2, -2);
        }

        // MARGIN2
        $this->MARGIN2->EditAttrs["class"] = "form-control";
        $this->MARGIN2->EditCustomAttributes = "";
        $this->MARGIN2->EditValue = $this->MARGIN2->CurrentValue;
        $this->MARGIN2->PlaceHolder = RemoveHtml($this->MARGIN2->caption());
        if (strval($this->MARGIN2->EditValue) != "" && is_numeric($this->MARGIN2->EditValue)) {
            $this->MARGIN2->EditValue = FormatNumber($this->MARGIN2->EditValue, -2, -2, -2, -2);
        }

        // MARGIN3
        $this->MARGIN3->EditAttrs["class"] = "form-control";
        $this->MARGIN3->EditCustomAttributes = "";
        $this->MARGIN3->EditValue = $this->MARGIN3->CurrentValue;
        $this->MARGIN3->PlaceHolder = RemoveHtml($this->MARGIN3->caption());
        if (strval($this->MARGIN3->EditValue) != "" && is_numeric($this->MARGIN3->EditValue)) {
            $this->MARGIN3->EditValue = FormatNumber($this->MARGIN3->EditValue, -2, -2, -2, -2);
        }

        // MARGIN4
        $this->MARGIN4->EditAttrs["class"] = "form-control";
        $this->MARGIN4->EditCustomAttributes = "";
        $this->MARGIN4->EditValue = $this->MARGIN4->CurrentValue;
        $this->MARGIN4->PlaceHolder = RemoveHtml($this->MARGIN4->caption());
        if (strval($this->MARGIN4->EditValue) != "" && is_numeric($this->MARGIN4->EditValue)) {
            $this->MARGIN4->EditValue = FormatNumber($this->MARGIN4->EditValue, -2, -2, -2, -2);
        }

        // MARGIN5
        $this->MARGIN5->EditAttrs["class"] = "form-control";
        $this->MARGIN5->EditCustomAttributes = "";
        $this->MARGIN5->EditValue = $this->MARGIN5->CurrentValue;
        $this->MARGIN5->PlaceHolder = RemoveHtml($this->MARGIN5->caption());
        if (strval($this->MARGIN5->EditValue) != "" && is_numeric($this->MARGIN5->EditValue)) {
            $this->MARGIN5->EditValue = FormatNumber($this->MARGIN5->EditValue, -2, -2, -2, -2);
        }

        // DISKON1
        $this->DISKON1->EditAttrs["class"] = "form-control";
        $this->DISKON1->EditCustomAttributes = "";
        $this->DISKON1->EditValue = $this->DISKON1->CurrentValue;
        $this->DISKON1->PlaceHolder = RemoveHtml($this->DISKON1->caption());
        if (strval($this->DISKON1->EditValue) != "" && is_numeric($this->DISKON1->EditValue)) {
            $this->DISKON1->EditValue = FormatNumber($this->DISKON1->EditValue, -2, -2, -2, -2);
        }

        // DISKON2
        $this->DISKON2->EditAttrs["class"] = "form-control";
        $this->DISKON2->EditCustomAttributes = "";
        $this->DISKON2->EditValue = $this->DISKON2->CurrentValue;
        $this->DISKON2->PlaceHolder = RemoveHtml($this->DISKON2->caption());
        if (strval($this->DISKON2->EditValue) != "" && is_numeric($this->DISKON2->EditValue)) {
            $this->DISKON2->EditValue = FormatNumber($this->DISKON2->EditValue, -2, -2, -2, -2);
        }

        // DISKON3
        $this->DISKON3->EditAttrs["class"] = "form-control";
        $this->DISKON3->EditCustomAttributes = "";
        $this->DISKON3->EditValue = $this->DISKON3->CurrentValue;
        $this->DISKON3->PlaceHolder = RemoveHtml($this->DISKON3->caption());
        if (strval($this->DISKON3->EditValue) != "" && is_numeric($this->DISKON3->EditValue)) {
            $this->DISKON3->EditValue = FormatNumber($this->DISKON3->EditValue, -2, -2, -2, -2);
        }

        // DISKON4
        $this->DISKON4->EditAttrs["class"] = "form-control";
        $this->DISKON4->EditCustomAttributes = "";
        $this->DISKON4->EditValue = $this->DISKON4->CurrentValue;
        $this->DISKON4->PlaceHolder = RemoveHtml($this->DISKON4->caption());
        if (strval($this->DISKON4->EditValue) != "" && is_numeric($this->DISKON4->EditValue)) {
            $this->DISKON4->EditValue = FormatNumber($this->DISKON4->EditValue, -2, -2, -2, -2);
        }

        // DISKON5
        $this->DISKON5->EditAttrs["class"] = "form-control";
        $this->DISKON5->EditCustomAttributes = "";
        $this->DISKON5->EditValue = $this->DISKON5->CurrentValue;
        $this->DISKON5->PlaceHolder = RemoveHtml($this->DISKON5->caption());
        if (strval($this->DISKON5->EditValue) != "" && is_numeric($this->DISKON5->EditValue)) {
            $this->DISKON5->EditValue = FormatNumber($this->DISKON5->EditValue, -2, -2, -2, -2);
        }

        // DISKONBEBAS
        $this->DISKONBEBAS->EditAttrs["class"] = "form-control";
        $this->DISKONBEBAS->EditCustomAttributes = "";
        $this->DISKONBEBAS->EditValue = $this->DISKONBEBAS->CurrentValue;
        $this->DISKONBEBAS->PlaceHolder = RemoveHtml($this->DISKONBEBAS->caption());
        if (strval($this->DISKONBEBAS->EditValue) != "" && is_numeric($this->DISKONBEBAS->EditValue)) {
            $this->DISKONBEBAS->EditValue = FormatNumber($this->DISKONBEBAS->EditValue, -2, -2, -2, -2);
        }

        // DISKONGENERIK
        $this->DISKONGENERIK->EditAttrs["class"] = "form-control";
        $this->DISKONGENERIK->EditCustomAttributes = "";
        $this->DISKONGENERIK->EditValue = $this->DISKONGENERIK->CurrentValue;
        $this->DISKONGENERIK->PlaceHolder = RemoveHtml($this->DISKONGENERIK->caption());
        if (strval($this->DISKONGENERIK->EditValue) != "" && is_numeric($this->DISKONGENERIK->EditValue)) {
            $this->DISKONGENERIK->EditValue = FormatNumber($this->DISKONGENERIK->EditValue, -2, -2, -2, -2);
        }

        // DISKONOWA
        $this->DISKONOWA->EditAttrs["class"] = "form-control";
        $this->DISKONOWA->EditCustomAttributes = "";
        $this->DISKONOWA->EditValue = $this->DISKONOWA->CurrentValue;
        $this->DISKONOWA->PlaceHolder = RemoveHtml($this->DISKONOWA->caption());
        if (strval($this->DISKONOWA->EditValue) != "" && is_numeric($this->DISKONOWA->EditValue)) {
            $this->DISKONOWA->EditValue = FormatNumber($this->DISKONOWA->EditValue, -2, -2, -2, -2);
        }

        // DISKONINTERNAL
        $this->DISKONINTERNAL->EditAttrs["class"] = "form-control";
        $this->DISKONINTERNAL->EditCustomAttributes = "";
        $this->DISKONINTERNAL->EditValue = $this->DISKONINTERNAL->CurrentValue;
        $this->DISKONINTERNAL->PlaceHolder = RemoveHtml($this->DISKONINTERNAL->caption());
        if (strval($this->DISKONINTERNAL->EditValue) != "" && is_numeric($this->DISKONINTERNAL->EditValue)) {
            $this->DISKONINTERNAL->EditValue = FormatNumber($this->DISKONINTERNAL->EditValue, -2, -2, -2, -2);
        }

        // DISKONLUAR
        $this->DISKONLUAR->EditAttrs["class"] = "form-control";
        $this->DISKONLUAR->EditCustomAttributes = "";
        $this->DISKONLUAR->EditValue = $this->DISKONLUAR->CurrentValue;
        $this->DISKONLUAR->PlaceHolder = RemoveHtml($this->DISKONLUAR->caption());
        if (strval($this->DISKONLUAR->EditValue) != "" && is_numeric($this->DISKONLUAR->EditValue)) {
            $this->DISKONLUAR->EditValue = FormatNumber($this->DISKONLUAR->EditValue, -2, -2, -2, -2);
        }

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

        // MODIFIED_FROM
        $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
        $this->MODIFIED_FROM->EditCustomAttributes = "";
        if (!$this->MODIFIED_FROM->Raw) {
            $this->MODIFIED_FROM->CurrentValue = HtmlDecode($this->MODIFIED_FROM->CurrentValue);
        }
        $this->MODIFIED_FROM->EditValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

        // STATUSCHANGED
        $this->STATUSCHANGED->EditAttrs["class"] = "form-control";
        $this->STATUSCHANGED->EditCustomAttributes = "";
        $this->STATUSCHANGED->EditValue = $this->STATUSCHANGED->CurrentValue;
        $this->STATUSCHANGED->PlaceHolder = RemoveHtml($this->STATUSCHANGED->caption());
        if (strval($this->STATUSCHANGED->EditValue) != "" && is_numeric($this->STATUSCHANGED->EditValue)) {
            $this->STATUSCHANGED->EditValue = FormatNumber($this->STATUSCHANGED->EditValue, -2, -2, -2, -2);
        }

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
                    $doc->exportCaption($this->PPN);
                    $doc->exportCaption($this->EMBALACE);
                    $doc->exportCaption($this->EMBALACER);
                    $doc->exportCaption($this->R_EMBALACE);
                    $doc->exportCaption($this->PROFESSION_COST);
                    $doc->exportCaption($this->R_PROFESSION);
                    $doc->exportCaption($this->POKOK_JUAL);
                    $doc->exportCaption($this->LEAD_TIME);
                    $doc->exportCaption($this->HOLDING_COSTP);
                    $doc->exportCaption($this->ORDERING_COST);
                    $doc->exportCaption($this->PAGU);
                    $doc->exportCaption($this->PPN_RJ);
                    $doc->exportCaption($this->PPN_RI);
                    $doc->exportCaption($this->PPN_UGD);
                    $doc->exportCaption($this->MARGINBEBAS);
                    $doc->exportCaption($this->MARGINGENERIK);
                    $doc->exportCaption($this->MARGINOWA);
                    $doc->exportCaption($this->MARGININTERNAL);
                    $doc->exportCaption($this->MARGINLUAR);
                    $doc->exportCaption($this->MARGINVIP12);
                    $doc->exportCaption($this->MARGINRJ);
                    $doc->exportCaption($this->MARGIN2);
                    $doc->exportCaption($this->MARGIN3);
                    $doc->exportCaption($this->MARGIN4);
                    $doc->exportCaption($this->MARGIN5);
                    $doc->exportCaption($this->DISKON1);
                    $doc->exportCaption($this->DISKON2);
                    $doc->exportCaption($this->DISKON3);
                    $doc->exportCaption($this->DISKON4);
                    $doc->exportCaption($this->DISKON5);
                    $doc->exportCaption($this->DISKONBEBAS);
                    $doc->exportCaption($this->DISKONGENERIK);
                    $doc->exportCaption($this->DISKONOWA);
                    $doc->exportCaption($this->DISKONINTERNAL);
                    $doc->exportCaption($this->DISKONLUAR);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->STATUSCHANGED);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->PPN);
                    $doc->exportCaption($this->EMBALACE);
                    $doc->exportCaption($this->EMBALACER);
                    $doc->exportCaption($this->R_EMBALACE);
                    $doc->exportCaption($this->PROFESSION_COST);
                    $doc->exportCaption($this->R_PROFESSION);
                    $doc->exportCaption($this->POKOK_JUAL);
                    $doc->exportCaption($this->LEAD_TIME);
                    $doc->exportCaption($this->HOLDING_COSTP);
                    $doc->exportCaption($this->ORDERING_COST);
                    $doc->exportCaption($this->PAGU);
                    $doc->exportCaption($this->PPN_RJ);
                    $doc->exportCaption($this->PPN_RI);
                    $doc->exportCaption($this->PPN_UGD);
                    $doc->exportCaption($this->MARGINBEBAS);
                    $doc->exportCaption($this->MARGINGENERIK);
                    $doc->exportCaption($this->MARGINOWA);
                    $doc->exportCaption($this->MARGININTERNAL);
                    $doc->exportCaption($this->MARGINLUAR);
                    $doc->exportCaption($this->MARGINVIP12);
                    $doc->exportCaption($this->MARGINRJ);
                    $doc->exportCaption($this->MARGIN2);
                    $doc->exportCaption($this->MARGIN3);
                    $doc->exportCaption($this->MARGIN4);
                    $doc->exportCaption($this->MARGIN5);
                    $doc->exportCaption($this->DISKON1);
                    $doc->exportCaption($this->DISKON2);
                    $doc->exportCaption($this->DISKON3);
                    $doc->exportCaption($this->DISKON4);
                    $doc->exportCaption($this->DISKON5);
                    $doc->exportCaption($this->DISKONBEBAS);
                    $doc->exportCaption($this->DISKONGENERIK);
                    $doc->exportCaption($this->DISKONOWA);
                    $doc->exportCaption($this->DISKONINTERNAL);
                    $doc->exportCaption($this->DISKONLUAR);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->STATUSCHANGED);
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
                        $doc->exportField($this->PPN);
                        $doc->exportField($this->EMBALACE);
                        $doc->exportField($this->EMBALACER);
                        $doc->exportField($this->R_EMBALACE);
                        $doc->exportField($this->PROFESSION_COST);
                        $doc->exportField($this->R_PROFESSION);
                        $doc->exportField($this->POKOK_JUAL);
                        $doc->exportField($this->LEAD_TIME);
                        $doc->exportField($this->HOLDING_COSTP);
                        $doc->exportField($this->ORDERING_COST);
                        $doc->exportField($this->PAGU);
                        $doc->exportField($this->PPN_RJ);
                        $doc->exportField($this->PPN_RI);
                        $doc->exportField($this->PPN_UGD);
                        $doc->exportField($this->MARGINBEBAS);
                        $doc->exportField($this->MARGINGENERIK);
                        $doc->exportField($this->MARGINOWA);
                        $doc->exportField($this->MARGININTERNAL);
                        $doc->exportField($this->MARGINLUAR);
                        $doc->exportField($this->MARGINVIP12);
                        $doc->exportField($this->MARGINRJ);
                        $doc->exportField($this->MARGIN2);
                        $doc->exportField($this->MARGIN3);
                        $doc->exportField($this->MARGIN4);
                        $doc->exportField($this->MARGIN5);
                        $doc->exportField($this->DISKON1);
                        $doc->exportField($this->DISKON2);
                        $doc->exportField($this->DISKON3);
                        $doc->exportField($this->DISKON4);
                        $doc->exportField($this->DISKON5);
                        $doc->exportField($this->DISKONBEBAS);
                        $doc->exportField($this->DISKONGENERIK);
                        $doc->exportField($this->DISKONOWA);
                        $doc->exportField($this->DISKONINTERNAL);
                        $doc->exportField($this->DISKONLUAR);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->STATUSCHANGED);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->PPN);
                        $doc->exportField($this->EMBALACE);
                        $doc->exportField($this->EMBALACER);
                        $doc->exportField($this->R_EMBALACE);
                        $doc->exportField($this->PROFESSION_COST);
                        $doc->exportField($this->R_PROFESSION);
                        $doc->exportField($this->POKOK_JUAL);
                        $doc->exportField($this->LEAD_TIME);
                        $doc->exportField($this->HOLDING_COSTP);
                        $doc->exportField($this->ORDERING_COST);
                        $doc->exportField($this->PAGU);
                        $doc->exportField($this->PPN_RJ);
                        $doc->exportField($this->PPN_RI);
                        $doc->exportField($this->PPN_UGD);
                        $doc->exportField($this->MARGINBEBAS);
                        $doc->exportField($this->MARGINGENERIK);
                        $doc->exportField($this->MARGINOWA);
                        $doc->exportField($this->MARGININTERNAL);
                        $doc->exportField($this->MARGINLUAR);
                        $doc->exportField($this->MARGINVIP12);
                        $doc->exportField($this->MARGINRJ);
                        $doc->exportField($this->MARGIN2);
                        $doc->exportField($this->MARGIN3);
                        $doc->exportField($this->MARGIN4);
                        $doc->exportField($this->MARGIN5);
                        $doc->exportField($this->DISKON1);
                        $doc->exportField($this->DISKON2);
                        $doc->exportField($this->DISKON3);
                        $doc->exportField($this->DISKON4);
                        $doc->exportField($this->DISKON5);
                        $doc->exportField($this->DISKONBEBAS);
                        $doc->exportField($this->DISKONGENERIK);
                        $doc->exportField($this->DISKONOWA);
                        $doc->exportField($this->DISKONINTERNAL);
                        $doc->exportField($this->DISKONLUAR);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->STATUSCHANGED);
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
