<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for SPP
 */
class Spp extends DbTable
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
    public $SPP_ID;
    public $SPP_TYPE;
    public $SPP_NO;
    public $SPP_COUNTER;
    public $SPP_BATCH;
    public $SPP_DATE;
    public $SPP_DUE;
    public $REF_TYPE;
    public $REF_NO;
    public $REF_DATE;
    public $PACTIVITY_ID;
    public $ACCOUNT_ID;
    public $YEAR_ID;
    public $ORG_ID;
    public $PROGRAM_ID;
    public $PROGRAMS;
    public $ACTIVITY_ID;
    public $ACTIVITY_NAME;
    public $PAGU;
    public $PAGU_REALISASI;
    public $KEPERLUAN;
    public $BENDAHARA_ID;
    public $BENDAHARA;
    public $PPTK;
    public $PPTK_NAME;
    public $PA;
    public $PA_NAME;
    public $COMPANY_TYPE;
    public $COMPANY_ID;
    public $COMPANY;
    public $COMPANY_CHIEF;
    public $COMPANY_INFO;
    public $CONTRACT_NO;
    public $NPWP;
    public $COMPANY_BANK;
    public $COMPANY_ACCOUNT;
    public $AMOUNT_PAID;
    public $AMOUNT;
    public $BANK_ID;
    public $BANK_ACCOUNT;
    public $ISAPPROVED;
    public $APPROVED_BY;
    public $APPROVED_DATE;
    public $ISCETAK;
    public $PRINTQ;
    public $PRINT_DATE;
    public $PRINTED_BY;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $BEND_TITLE;
    public $PPTK_TITLE;
    public $PA_TITLE;
    public $APPROVED_TITLE;
    public $APPROVED_ID;
    public $REF_BATCH;
    public $KLIRING_DATE;
    public $FA_V_BANK;
    public $FA_V_KLIRING;
    public $COMPANY_TO;
    public $PAY_METHOD_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'SPP';
        $this->TableName = 'SPP';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[SPP]";
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
        $this->ORG_UNIT_CODE = new DbField('SPP', 'SPP', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // SPP_ID
        $this->SPP_ID = new DbField('SPP', 'SPP', 'x_SPP_ID', 'SPP_ID', '[SPP_ID]', '[SPP_ID]', 200, 50, -1, false, '[SPP_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_ID->IsPrimaryKey = true; // Primary key field
        $this->SPP_ID->Nullable = false; // NOT NULL field
        $this->SPP_ID->Required = true; // Required field
        $this->SPP_ID->Sortable = true; // Allow sort
        $this->SPP_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_ID->Param, "CustomMsg");
        $this->Fields['SPP_ID'] = &$this->SPP_ID;

        // SPP_TYPE
        $this->SPP_TYPE = new DbField('SPP', 'SPP', 'x_SPP_TYPE', 'SPP_TYPE', '[SPP_TYPE]', 'CAST([SPP_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[SPP_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_TYPE->Sortable = true; // Allow sort
        $this->SPP_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SPP_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_TYPE->Param, "CustomMsg");
        $this->Fields['SPP_TYPE'] = &$this->SPP_TYPE;

        // SPP_NO
        $this->SPP_NO = new DbField('SPP', 'SPP', 'x_SPP_NO', 'SPP_NO', '[SPP_NO]', '[SPP_NO]', 200, 50, -1, false, '[SPP_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_NO->Sortable = true; // Allow sort
        $this->SPP_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_NO->Param, "CustomMsg");
        $this->Fields['SPP_NO'] = &$this->SPP_NO;

        // SPP_COUNTER
        $this->SPP_COUNTER = new DbField('SPP', 'SPP', 'x_SPP_COUNTER', 'SPP_COUNTER', '[SPP_COUNTER]', 'CAST([SPP_COUNTER] AS NVARCHAR)', 3, 4, -1, false, '[SPP_COUNTER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_COUNTER->Sortable = true; // Allow sort
        $this->SPP_COUNTER->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SPP_COUNTER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_COUNTER->Param, "CustomMsg");
        $this->Fields['SPP_COUNTER'] = &$this->SPP_COUNTER;

        // SPP_BATCH
        $this->SPP_BATCH = new DbField('SPP', 'SPP', 'x_SPP_BATCH', 'SPP_BATCH', '[SPP_BATCH]', '[SPP_BATCH]', 200, 50, -1, false, '[SPP_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_BATCH->Sortable = true; // Allow sort
        $this->SPP_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_BATCH->Param, "CustomMsg");
        $this->Fields['SPP_BATCH'] = &$this->SPP_BATCH;

        // SPP_DATE
        $this->SPP_DATE = new DbField('SPP', 'SPP', 'x_SPP_DATE', 'SPP_DATE', '[SPP_DATE]', CastDateFieldForLike("[SPP_DATE]", 0, "DB"), 135, 8, 0, false, '[SPP_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_DATE->Sortable = true; // Allow sort
        $this->SPP_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SPP_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_DATE->Param, "CustomMsg");
        $this->Fields['SPP_DATE'] = &$this->SPP_DATE;

        // SPP_DUE
        $this->SPP_DUE = new DbField('SPP', 'SPP', 'x_SPP_DUE', 'SPP_DUE', '[SPP_DUE]', CastDateFieldForLike("[SPP_DUE]", 0, "DB"), 135, 8, 0, false, '[SPP_DUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_DUE->Sortable = true; // Allow sort
        $this->SPP_DUE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SPP_DUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_DUE->Param, "CustomMsg");
        $this->Fields['SPP_DUE'] = &$this->SPP_DUE;

        // REF_TYPE
        $this->REF_TYPE = new DbField('SPP', 'SPP', 'x_REF_TYPE', 'REF_TYPE', '[REF_TYPE]', 'CAST([REF_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[REF_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_TYPE->Sortable = true; // Allow sort
        $this->REF_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REF_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_TYPE->Param, "CustomMsg");
        $this->Fields['REF_TYPE'] = &$this->REF_TYPE;

        // REF_NO
        $this->REF_NO = new DbField('SPP', 'SPP', 'x_REF_NO', 'REF_NO', '[REF_NO]', '[REF_NO]', 200, 50, -1, false, '[REF_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_NO->Sortable = true; // Allow sort
        $this->REF_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_NO->Param, "CustomMsg");
        $this->Fields['REF_NO'] = &$this->REF_NO;

        // REF_DATE
        $this->REF_DATE = new DbField('SPP', 'SPP', 'x_REF_DATE', 'REF_DATE', '[REF_DATE]', CastDateFieldForLike("[REF_DATE]", 0, "DB"), 135, 8, 0, false, '[REF_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_DATE->Sortable = true; // Allow sort
        $this->REF_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REF_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_DATE->Param, "CustomMsg");
        $this->Fields['REF_DATE'] = &$this->REF_DATE;

        // PACTIVITY_ID
        $this->PACTIVITY_ID = new DbField('SPP', 'SPP', 'x_PACTIVITY_ID', 'PACTIVITY_ID', '[PACTIVITY_ID]', '[PACTIVITY_ID]', 200, 50, -1, false, '[PACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PACTIVITY_ID->Sortable = true; // Allow sort
        $this->PACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['PACTIVITY_ID'] = &$this->PACTIVITY_ID;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('SPP', 'SPP', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // YEAR_ID
        $this->YEAR_ID = new DbField('SPP', 'SPP', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // ORG_ID
        $this->ORG_ID = new DbField('SPP', 'SPP', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // PROGRAM_ID
        $this->PROGRAM_ID = new DbField('SPP', 'SPP', 'x_PROGRAM_ID', 'PROGRAM_ID', '[PROGRAM_ID]', '[PROGRAM_ID]', 200, 50, -1, false, '[PROGRAM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROGRAM_ID->Sortable = true; // Allow sort
        $this->PROGRAM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROGRAM_ID->Param, "CustomMsg");
        $this->Fields['PROGRAM_ID'] = &$this->PROGRAM_ID;

        // PROGRAMS
        $this->PROGRAMS = new DbField('SPP', 'SPP', 'x_PROGRAMS', 'PROGRAMS', '[PROGRAMS]', '[PROGRAMS]', 200, 200, -1, false, '[PROGRAMS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROGRAMS->Sortable = true; // Allow sort
        $this->PROGRAMS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROGRAMS->Param, "CustomMsg");
        $this->Fields['PROGRAMS'] = &$this->PROGRAMS;

        // ACTIVITY_ID
        $this->ACTIVITY_ID = new DbField('SPP', 'SPP', 'x_ACTIVITY_ID', 'ACTIVITY_ID', '[ACTIVITY_ID]', 'CAST([ACTIVITY_ID] AS NVARCHAR)', 2, 2, -1, false, '[ACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACTIVITY_ID->Sortable = true; // Allow sort
        $this->ACTIVITY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['ACTIVITY_ID'] = &$this->ACTIVITY_ID;

        // ACTIVITY_NAME
        $this->ACTIVITY_NAME = new DbField('SPP', 'SPP', 'x_ACTIVITY_NAME', 'ACTIVITY_NAME', '[ACTIVITY_NAME]', '[ACTIVITY_NAME]', 200, 200, -1, false, '[ACTIVITY_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACTIVITY_NAME->Sortable = true; // Allow sort
        $this->ACTIVITY_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACTIVITY_NAME->Param, "CustomMsg");
        $this->Fields['ACTIVITY_NAME'] = &$this->ACTIVITY_NAME;

        // PAGU
        $this->PAGU = new DbField('SPP', 'SPP', 'x_PAGU', 'PAGU', '[PAGU]', 'CAST([PAGU] AS NVARCHAR)', 6, 8, -1, false, '[PAGU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAGU->Sortable = true; // Allow sort
        $this->PAGU->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PAGU->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PAGU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAGU->Param, "CustomMsg");
        $this->Fields['PAGU'] = &$this->PAGU;

        // PAGU_REALISASI
        $this->PAGU_REALISASI = new DbField('SPP', 'SPP', 'x_PAGU_REALISASI', 'PAGU_REALISASI', '[PAGU_REALISASI]', 'CAST([PAGU_REALISASI] AS NVARCHAR)', 6, 8, -1, false, '[PAGU_REALISASI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAGU_REALISASI->Sortable = true; // Allow sort
        $this->PAGU_REALISASI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PAGU_REALISASI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PAGU_REALISASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAGU_REALISASI->Param, "CustomMsg");
        $this->Fields['PAGU_REALISASI'] = &$this->PAGU_REALISASI;

        // KEPERLUAN
        $this->KEPERLUAN = new DbField('SPP', 'SPP', 'x_KEPERLUAN', 'KEPERLUAN', '[KEPERLUAN]', '[KEPERLUAN]', 200, 255, -1, false, '[KEPERLUAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KEPERLUAN->Sortable = true; // Allow sort
        $this->KEPERLUAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KEPERLUAN->Param, "CustomMsg");
        $this->Fields['KEPERLUAN'] = &$this->KEPERLUAN;

        // BENDAHARA_ID
        $this->BENDAHARA_ID = new DbField('SPP', 'SPP', 'x_BENDAHARA_ID', 'BENDAHARA_ID', '[BENDAHARA_ID]', '[BENDAHARA_ID]', 200, 50, -1, false, '[BENDAHARA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BENDAHARA_ID->Sortable = true; // Allow sort
        $this->BENDAHARA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BENDAHARA_ID->Param, "CustomMsg");
        $this->Fields['BENDAHARA_ID'] = &$this->BENDAHARA_ID;

        // BENDAHARA
        $this->BENDAHARA = new DbField('SPP', 'SPP', 'x_BENDAHARA', 'BENDAHARA', '[BENDAHARA]', '[BENDAHARA]', 200, 200, -1, false, '[BENDAHARA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BENDAHARA->Sortable = true; // Allow sort
        $this->BENDAHARA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BENDAHARA->Param, "CustomMsg");
        $this->Fields['BENDAHARA'] = &$this->BENDAHARA;

        // PPTK
        $this->PPTK = new DbField('SPP', 'SPP', 'x_PPTK', 'PPTK', '[PPTK]', '[PPTK]', 200, 50, -1, false, '[PPTK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPTK->Sortable = true; // Allow sort
        $this->PPTK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPTK->Param, "CustomMsg");
        $this->Fields['PPTK'] = &$this->PPTK;

        // PPTK_NAME
        $this->PPTK_NAME = new DbField('SPP', 'SPP', 'x_PPTK_NAME', 'PPTK_NAME', '[PPTK_NAME]', '[PPTK_NAME]', 200, 200, -1, false, '[PPTK_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPTK_NAME->Sortable = true; // Allow sort
        $this->PPTK_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPTK_NAME->Param, "CustomMsg");
        $this->Fields['PPTK_NAME'] = &$this->PPTK_NAME;

        // PA
        $this->PA = new DbField('SPP', 'SPP', 'x_PA', 'PA', '[PA]', '[PA]', 200, 200, -1, false, '[PA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PA->Sortable = true; // Allow sort
        $this->PA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PA->Param, "CustomMsg");
        $this->Fields['PA'] = &$this->PA;

        // PA_NAME
        $this->PA_NAME = new DbField('SPP', 'SPP', 'x_PA_NAME', 'PA_NAME', '[PA_NAME]', '[PA_NAME]', 200, 200, -1, false, '[PA_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PA_NAME->Sortable = true; // Allow sort
        $this->PA_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PA_NAME->Param, "CustomMsg");
        $this->Fields['PA_NAME'] = &$this->PA_NAME;

        // COMPANY_TYPE
        $this->COMPANY_TYPE = new DbField('SPP', 'SPP', 'x_COMPANY_TYPE', 'COMPANY_TYPE', '[COMPANY_TYPE]', '[COMPANY_TYPE]', 200, 15, -1, false, '[COMPANY_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_TYPE->Sortable = true; // Allow sort
        $this->COMPANY_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_TYPE->Param, "CustomMsg");
        $this->Fields['COMPANY_TYPE'] = &$this->COMPANY_TYPE;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('SPP', 'SPP', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // COMPANY
        $this->COMPANY = new DbField('SPP', 'SPP', 'x_COMPANY', 'COMPANY', '[COMPANY]', '[COMPANY]', 200, 200, -1, false, '[COMPANY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY->Sortable = true; // Allow sort
        $this->COMPANY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY->Param, "CustomMsg");
        $this->Fields['COMPANY'] = &$this->COMPANY;

        // COMPANY_CHIEF
        $this->COMPANY_CHIEF = new DbField('SPP', 'SPP', 'x_COMPANY_CHIEF', 'COMPANY_CHIEF', '[COMPANY_CHIEF]', '[COMPANY_CHIEF]', 200, 200, -1, false, '[COMPANY_CHIEF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_CHIEF->Sortable = true; // Allow sort
        $this->COMPANY_CHIEF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_CHIEF->Param, "CustomMsg");
        $this->Fields['COMPANY_CHIEF'] = &$this->COMPANY_CHIEF;

        // COMPANY_INFO
        $this->COMPANY_INFO = new DbField('SPP', 'SPP', 'x_COMPANY_INFO', 'COMPANY_INFO', '[COMPANY_INFO]', '[COMPANY_INFO]', 200, 200, -1, false, '[COMPANY_INFO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_INFO->Sortable = true; // Allow sort
        $this->COMPANY_INFO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_INFO->Param, "CustomMsg");
        $this->Fields['COMPANY_INFO'] = &$this->COMPANY_INFO;

        // CONTRACT_NO
        $this->CONTRACT_NO = new DbField('SPP', 'SPP', 'x_CONTRACT_NO', 'CONTRACT_NO', '[CONTRACT_NO]', '[CONTRACT_NO]', 200, 200, -1, false, '[CONTRACT_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRACT_NO->Sortable = true; // Allow sort
        $this->CONTRACT_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRACT_NO->Param, "CustomMsg");
        $this->Fields['CONTRACT_NO'] = &$this->CONTRACT_NO;

        // NPWP
        $this->NPWP = new DbField('SPP', 'SPP', 'x_NPWP', 'NPWP', '[NPWP]', '[NPWP]', 200, 50, -1, false, '[NPWP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPWP->Sortable = true; // Allow sort
        $this->NPWP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPWP->Param, "CustomMsg");
        $this->Fields['NPWP'] = &$this->NPWP;

        // COMPANY_BANK
        $this->COMPANY_BANK = new DbField('SPP', 'SPP', 'x_COMPANY_BANK', 'COMPANY_BANK', '[COMPANY_BANK]', '[COMPANY_BANK]', 200, 50, -1, false, '[COMPANY_BANK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_BANK->Sortable = true; // Allow sort
        $this->COMPANY_BANK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_BANK->Param, "CustomMsg");
        $this->Fields['COMPANY_BANK'] = &$this->COMPANY_BANK;

        // COMPANY_ACCOUNT
        $this->COMPANY_ACCOUNT = new DbField('SPP', 'SPP', 'x_COMPANY_ACCOUNT', 'COMPANY_ACCOUNT', '[COMPANY_ACCOUNT]', '[COMPANY_ACCOUNT]', 200, 50, -1, false, '[COMPANY_ACCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ACCOUNT->Sortable = true; // Allow sort
        $this->COMPANY_ACCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ACCOUNT->Param, "CustomMsg");
        $this->Fields['COMPANY_ACCOUNT'] = &$this->COMPANY_ACCOUNT;

        // AMOUNT_PAID
        $this->AMOUNT_PAID = new DbField('SPP', 'SPP', 'x_AMOUNT_PAID', 'AMOUNT_PAID', '[AMOUNT_PAID]', 'CAST([AMOUNT_PAID] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_PAID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PAID->Sortable = true; // Allow sort
        $this->AMOUNT_PAID->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_PAID->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_PAID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PAID->Param, "CustomMsg");
        $this->Fields['AMOUNT_PAID'] = &$this->AMOUNT_PAID;

        // AMOUNT
        $this->AMOUNT = new DbField('SPP', 'SPP', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = true; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // BANK_ID
        $this->BANK_ID = new DbField('SPP', 'SPP', 'x_BANK_ID', 'BANK_ID', '[BANK_ID]', '[BANK_ID]', 200, 200, -1, false, '[BANK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANK_ID->Sortable = true; // Allow sort
        $this->BANK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANK_ID->Param, "CustomMsg");
        $this->Fields['BANK_ID'] = &$this->BANK_ID;

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT = new DbField('SPP', 'SPP', 'x_BANK_ACCOUNT', 'BANK_ACCOUNT', '[BANK_ACCOUNT]', '[BANK_ACCOUNT]', 200, 200, -1, false, '[BANK_ACCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANK_ACCOUNT->Sortable = true; // Allow sort
        $this->BANK_ACCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANK_ACCOUNT->Param, "CustomMsg");
        $this->Fields['BANK_ACCOUNT'] = &$this->BANK_ACCOUNT;

        // ISAPPROVED
        $this->ISAPPROVED = new DbField('SPP', 'SPP', 'x_ISAPPROVED', 'ISAPPROVED', '[ISAPPROVED]', '[ISAPPROVED]', 129, 1, -1, false, '[ISAPPROVED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISAPPROVED->Sortable = true; // Allow sort
        $this->ISAPPROVED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISAPPROVED->Param, "CustomMsg");
        $this->Fields['ISAPPROVED'] = &$this->ISAPPROVED;

        // APPROVED_BY
        $this->APPROVED_BY = new DbField('SPP', 'SPP', 'x_APPROVED_BY', 'APPROVED_BY', '[APPROVED_BY]', '[APPROVED_BY]', 200, 50, -1, false, '[APPROVED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_BY->Sortable = true; // Allow sort
        $this->APPROVED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_BY->Param, "CustomMsg");
        $this->Fields['APPROVED_BY'] = &$this->APPROVED_BY;

        // APPROVED_DATE
        $this->APPROVED_DATE = new DbField('SPP', 'SPP', 'x_APPROVED_DATE', 'APPROVED_DATE', '[APPROVED_DATE]', CastDateFieldForLike("[APPROVED_DATE]", 0, "DB"), 135, 8, 0, false, '[APPROVED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_DATE->Sortable = true; // Allow sort
        $this->APPROVED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->APPROVED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_DATE->Param, "CustomMsg");
        $this->Fields['APPROVED_DATE'] = &$this->APPROVED_DATE;

        // ISCETAK
        $this->ISCETAK = new DbField('SPP', 'SPP', 'x_ISCETAK', 'ISCETAK', '[ISCETAK]', '[ISCETAK]', 129, 1, -1, false, '[ISCETAK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISCETAK->Sortable = true; // Allow sort
        $this->ISCETAK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISCETAK->Param, "CustomMsg");
        $this->Fields['ISCETAK'] = &$this->ISCETAK;

        // PRINTQ
        $this->PRINTQ = new DbField('SPP', 'SPP', 'x_PRINTQ', 'PRINTQ', '[PRINTQ]', 'CAST([PRINTQ] AS NVARCHAR)', 2, 2, -1, false, '[PRINTQ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTQ->Sortable = true; // Allow sort
        $this->PRINTQ->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PRINTQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTQ->Param, "CustomMsg");
        $this->Fields['PRINTQ'] = &$this->PRINTQ;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('SPP', 'SPP', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = true; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // PRINTED_BY
        $this->PRINTED_BY = new DbField('SPP', 'SPP', 'x_PRINTED_BY', 'PRINTED_BY', '[PRINTED_BY]', '[PRINTED_BY]', 200, 50, -1, false, '[PRINTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTED_BY->Sortable = true; // Allow sort
        $this->PRINTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTED_BY->Param, "CustomMsg");
        $this->Fields['PRINTED_BY'] = &$this->PRINTED_BY;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('SPP', 'SPP', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('SPP', 'SPP', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // BEND_TITLE
        $this->BEND_TITLE = new DbField('SPP', 'SPP', 'x_BEND_TITLE', 'BEND_TITLE', '[BEND_TITLE]', '[BEND_TITLE]', 200, 50, -1, false, '[BEND_TITLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BEND_TITLE->Sortable = true; // Allow sort
        $this->BEND_TITLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BEND_TITLE->Param, "CustomMsg");
        $this->Fields['BEND_TITLE'] = &$this->BEND_TITLE;

        // PPTK_TITLE
        $this->PPTK_TITLE = new DbField('SPP', 'SPP', 'x_PPTK_TITLE', 'PPTK_TITLE', '[PPTK_TITLE]', '[PPTK_TITLE]', 200, 50, -1, false, '[PPTK_TITLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPTK_TITLE->Sortable = true; // Allow sort
        $this->PPTK_TITLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPTK_TITLE->Param, "CustomMsg");
        $this->Fields['PPTK_TITLE'] = &$this->PPTK_TITLE;

        // PA_TITLE
        $this->PA_TITLE = new DbField('SPP', 'SPP', 'x_PA_TITLE', 'PA_TITLE', '[PA_TITLE]', '[PA_TITLE]', 200, 50, -1, false, '[PA_TITLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PA_TITLE->Sortable = true; // Allow sort
        $this->PA_TITLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PA_TITLE->Param, "CustomMsg");
        $this->Fields['PA_TITLE'] = &$this->PA_TITLE;

        // APPROVED_TITLE
        $this->APPROVED_TITLE = new DbField('SPP', 'SPP', 'x_APPROVED_TITLE', 'APPROVED_TITLE', '[APPROVED_TITLE]', '[APPROVED_TITLE]', 200, 50, -1, false, '[APPROVED_TITLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_TITLE->Sortable = true; // Allow sort
        $this->APPROVED_TITLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_TITLE->Param, "CustomMsg");
        $this->Fields['APPROVED_TITLE'] = &$this->APPROVED_TITLE;

        // APPROVED_ID
        $this->APPROVED_ID = new DbField('SPP', 'SPP', 'x_APPROVED_ID', 'APPROVED_ID', '[APPROVED_ID]', '[APPROVED_ID]', 200, 50, -1, false, '[APPROVED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_ID->Sortable = true; // Allow sort
        $this->APPROVED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_ID->Param, "CustomMsg");
        $this->Fields['APPROVED_ID'] = &$this->APPROVED_ID;

        // REF_BATCH
        $this->REF_BATCH = new DbField('SPP', 'SPP', 'x_REF_BATCH', 'REF_BATCH', '[REF_BATCH]', '[REF_BATCH]', 200, 50, -1, false, '[REF_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_BATCH->Sortable = true; // Allow sort
        $this->REF_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_BATCH->Param, "CustomMsg");
        $this->Fields['REF_BATCH'] = &$this->REF_BATCH;

        // KLIRING_DATE
        $this->KLIRING_DATE = new DbField('SPP', 'SPP', 'x_KLIRING_DATE', 'KLIRING_DATE', '[KLIRING_DATE]', CastDateFieldForLike("[KLIRING_DATE]", 0, "DB"), 135, 8, 0, false, '[KLIRING_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KLIRING_DATE->Sortable = true; // Allow sort
        $this->KLIRING_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->KLIRING_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KLIRING_DATE->Param, "CustomMsg");
        $this->Fields['KLIRING_DATE'] = &$this->KLIRING_DATE;

        // FA_V_BANK
        $this->FA_V_BANK = new DbField('SPP', 'SPP', 'x_FA_V_BANK', 'FA_V_BANK', '[FA_V_BANK]', '[FA_V_BANK]', 200, 50, -1, false, '[FA_V_BANK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V_BANK->Sortable = true; // Allow sort
        $this->FA_V_BANK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V_BANK->Param, "CustomMsg");
        $this->Fields['FA_V_BANK'] = &$this->FA_V_BANK;

        // FA_V_KLIRING
        $this->FA_V_KLIRING = new DbField('SPP', 'SPP', 'x_FA_V_KLIRING', 'FA_V_KLIRING', '[FA_V_KLIRING]', '[FA_V_KLIRING]', 200, 50, -1, false, '[FA_V_KLIRING]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V_KLIRING->Sortable = true; // Allow sort
        $this->FA_V_KLIRING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V_KLIRING->Param, "CustomMsg");
        $this->Fields['FA_V_KLIRING'] = &$this->FA_V_KLIRING;

        // COMPANY_TO
        $this->COMPANY_TO = new DbField('SPP', 'SPP', 'x_COMPANY_TO', 'COMPANY_TO', '[COMPANY_TO]', '[COMPANY_TO]', 200, 100, -1, false, '[COMPANY_TO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_TO->Sortable = true; // Allow sort
        $this->COMPANY_TO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_TO->Param, "CustomMsg");
        $this->Fields['COMPANY_TO'] = &$this->COMPANY_TO;

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID = new DbField('SPP', 'SPP', 'x_PAY_METHOD_ID', 'PAY_METHOD_ID', '[PAY_METHOD_ID]', 'CAST([PAY_METHOD_ID] AS NVARCHAR)', 2, 2, -1, false, '[PAY_METHOD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAY_METHOD_ID->Sortable = true; // Allow sort
        $this->PAY_METHOD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PAY_METHOD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAY_METHOD_ID->Param, "CustomMsg");
        $this->Fields['PAY_METHOD_ID'] = &$this->PAY_METHOD_ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[SPP]";
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
            if (array_key_exists('SPP_ID', $rs)) {
                AddFilter($where, QuotedName('SPP_ID', $this->Dbid) . '=' . QuotedValue($rs['SPP_ID'], $this->SPP_ID->DataType, $this->Dbid));
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
        $this->SPP_ID->DbValue = $row['SPP_ID'];
        $this->SPP_TYPE->DbValue = $row['SPP_TYPE'];
        $this->SPP_NO->DbValue = $row['SPP_NO'];
        $this->SPP_COUNTER->DbValue = $row['SPP_COUNTER'];
        $this->SPP_BATCH->DbValue = $row['SPP_BATCH'];
        $this->SPP_DATE->DbValue = $row['SPP_DATE'];
        $this->SPP_DUE->DbValue = $row['SPP_DUE'];
        $this->REF_TYPE->DbValue = $row['REF_TYPE'];
        $this->REF_NO->DbValue = $row['REF_NO'];
        $this->REF_DATE->DbValue = $row['REF_DATE'];
        $this->PACTIVITY_ID->DbValue = $row['PACTIVITY_ID'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->PROGRAM_ID->DbValue = $row['PROGRAM_ID'];
        $this->PROGRAMS->DbValue = $row['PROGRAMS'];
        $this->ACTIVITY_ID->DbValue = $row['ACTIVITY_ID'];
        $this->ACTIVITY_NAME->DbValue = $row['ACTIVITY_NAME'];
        $this->PAGU->DbValue = $row['PAGU'];
        $this->PAGU_REALISASI->DbValue = $row['PAGU_REALISASI'];
        $this->KEPERLUAN->DbValue = $row['KEPERLUAN'];
        $this->BENDAHARA_ID->DbValue = $row['BENDAHARA_ID'];
        $this->BENDAHARA->DbValue = $row['BENDAHARA'];
        $this->PPTK->DbValue = $row['PPTK'];
        $this->PPTK_NAME->DbValue = $row['PPTK_NAME'];
        $this->PA->DbValue = $row['PA'];
        $this->PA_NAME->DbValue = $row['PA_NAME'];
        $this->COMPANY_TYPE->DbValue = $row['COMPANY_TYPE'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->COMPANY->DbValue = $row['COMPANY'];
        $this->COMPANY_CHIEF->DbValue = $row['COMPANY_CHIEF'];
        $this->COMPANY_INFO->DbValue = $row['COMPANY_INFO'];
        $this->CONTRACT_NO->DbValue = $row['CONTRACT_NO'];
        $this->NPWP->DbValue = $row['NPWP'];
        $this->COMPANY_BANK->DbValue = $row['COMPANY_BANK'];
        $this->COMPANY_ACCOUNT->DbValue = $row['COMPANY_ACCOUNT'];
        $this->AMOUNT_PAID->DbValue = $row['AMOUNT_PAID'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->BANK_ID->DbValue = $row['BANK_ID'];
        $this->BANK_ACCOUNT->DbValue = $row['BANK_ACCOUNT'];
        $this->ISAPPROVED->DbValue = $row['ISAPPROVED'];
        $this->APPROVED_BY->DbValue = $row['APPROVED_BY'];
        $this->APPROVED_DATE->DbValue = $row['APPROVED_DATE'];
        $this->ISCETAK->DbValue = $row['ISCETAK'];
        $this->PRINTQ->DbValue = $row['PRINTQ'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->PRINTED_BY->DbValue = $row['PRINTED_BY'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->BEND_TITLE->DbValue = $row['BEND_TITLE'];
        $this->PPTK_TITLE->DbValue = $row['PPTK_TITLE'];
        $this->PA_TITLE->DbValue = $row['PA_TITLE'];
        $this->APPROVED_TITLE->DbValue = $row['APPROVED_TITLE'];
        $this->APPROVED_ID->DbValue = $row['APPROVED_ID'];
        $this->REF_BATCH->DbValue = $row['REF_BATCH'];
        $this->KLIRING_DATE->DbValue = $row['KLIRING_DATE'];
        $this->FA_V_BANK->DbValue = $row['FA_V_BANK'];
        $this->FA_V_KLIRING->DbValue = $row['FA_V_KLIRING'];
        $this->COMPANY_TO->DbValue = $row['COMPANY_TO'];
        $this->PAY_METHOD_ID->DbValue = $row['PAY_METHOD_ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [SPP_ID] = '@SPP_ID@'";
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
        $val = $current ? $this->SPP_ID->CurrentValue : $this->SPP_ID->OldValue;
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
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
            }
            if ($current) {
                $this->SPP_ID->CurrentValue = $keys[1];
            } else {
                $this->SPP_ID->OldValue = $keys[1];
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
        if (is_array($row)) {
            $val = array_key_exists('SPP_ID', $row) ? $row['SPP_ID'] : null;
        } else {
            $val = $this->SPP_ID->OldValue !== null ? $this->SPP_ID->OldValue : $this->SPP_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@SPP_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("SppList");
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
        if ($pageName == "SppView") {
            return $Language->phrase("View");
        } elseif ($pageName == "SppEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "SppAdd") {
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
                return "SppView";
            case Config("API_ADD_ACTION"):
                return "SppAdd";
            case Config("API_EDIT_ACTION"):
                return "SppEdit";
            case Config("API_DELETE_ACTION"):
                return "SppDelete";
            case Config("API_LIST_ACTION"):
                return "SppList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "SppList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SppView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("SppView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SppAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "SppAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SppEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("SppAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("SppDelete", $this->getUrlParm());
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
        $json .= ",SPP_ID:" . JsonEncode($this->SPP_ID->CurrentValue, "string");
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
        if ($this->SPP_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->SPP_ID->CurrentValue);
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
            if (($keyValue = Param("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("SPP_ID") ?? Route("SPP_ID")) !== null) {
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
                $this->ORG_UNIT_CODE->CurrentValue = $key[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->SPP_ID->CurrentValue = $key[1];
            } else {
                $this->SPP_ID->OldValue = $key[1];
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
        $this->SPP_ID->setDbValue($row['SPP_ID']);
        $this->SPP_TYPE->setDbValue($row['SPP_TYPE']);
        $this->SPP_NO->setDbValue($row['SPP_NO']);
        $this->SPP_COUNTER->setDbValue($row['SPP_COUNTER']);
        $this->SPP_BATCH->setDbValue($row['SPP_BATCH']);
        $this->SPP_DATE->setDbValue($row['SPP_DATE']);
        $this->SPP_DUE->setDbValue($row['SPP_DUE']);
        $this->REF_TYPE->setDbValue($row['REF_TYPE']);
        $this->REF_NO->setDbValue($row['REF_NO']);
        $this->REF_DATE->setDbValue($row['REF_DATE']);
        $this->PACTIVITY_ID->setDbValue($row['PACTIVITY_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->PROGRAM_ID->setDbValue($row['PROGRAM_ID']);
        $this->PROGRAMS->setDbValue($row['PROGRAMS']);
        $this->ACTIVITY_ID->setDbValue($row['ACTIVITY_ID']);
        $this->ACTIVITY_NAME->setDbValue($row['ACTIVITY_NAME']);
        $this->PAGU->setDbValue($row['PAGU']);
        $this->PAGU_REALISASI->setDbValue($row['PAGU_REALISASI']);
        $this->KEPERLUAN->setDbValue($row['KEPERLUAN']);
        $this->BENDAHARA_ID->setDbValue($row['BENDAHARA_ID']);
        $this->BENDAHARA->setDbValue($row['BENDAHARA']);
        $this->PPTK->setDbValue($row['PPTK']);
        $this->PPTK_NAME->setDbValue($row['PPTK_NAME']);
        $this->PA->setDbValue($row['PA']);
        $this->PA_NAME->setDbValue($row['PA_NAME']);
        $this->COMPANY_TYPE->setDbValue($row['COMPANY_TYPE']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->COMPANY->setDbValue($row['COMPANY']);
        $this->COMPANY_CHIEF->setDbValue($row['COMPANY_CHIEF']);
        $this->COMPANY_INFO->setDbValue($row['COMPANY_INFO']);
        $this->CONTRACT_NO->setDbValue($row['CONTRACT_NO']);
        $this->NPWP->setDbValue($row['NPWP']);
        $this->COMPANY_BANK->setDbValue($row['COMPANY_BANK']);
        $this->COMPANY_ACCOUNT->setDbValue($row['COMPANY_ACCOUNT']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->BANK_ID->setDbValue($row['BANK_ID']);
        $this->BANK_ACCOUNT->setDbValue($row['BANK_ACCOUNT']);
        $this->ISAPPROVED->setDbValue($row['ISAPPROVED']);
        $this->APPROVED_BY->setDbValue($row['APPROVED_BY']);
        $this->APPROVED_DATE->setDbValue($row['APPROVED_DATE']);
        $this->ISCETAK->setDbValue($row['ISCETAK']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->BEND_TITLE->setDbValue($row['BEND_TITLE']);
        $this->PPTK_TITLE->setDbValue($row['PPTK_TITLE']);
        $this->PA_TITLE->setDbValue($row['PA_TITLE']);
        $this->APPROVED_TITLE->setDbValue($row['APPROVED_TITLE']);
        $this->APPROVED_ID->setDbValue($row['APPROVED_ID']);
        $this->REF_BATCH->setDbValue($row['REF_BATCH']);
        $this->KLIRING_DATE->setDbValue($row['KLIRING_DATE']);
        $this->FA_V_BANK->setDbValue($row['FA_V_BANK']);
        $this->FA_V_KLIRING->setDbValue($row['FA_V_KLIRING']);
        $this->COMPANY_TO->setDbValue($row['COMPANY_TO']);
        $this->PAY_METHOD_ID->setDbValue($row['PAY_METHOD_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // SPP_ID

        // SPP_TYPE

        // SPP_NO

        // SPP_COUNTER

        // SPP_BATCH

        // SPP_DATE

        // SPP_DUE

        // REF_TYPE

        // REF_NO

        // REF_DATE

        // PACTIVITY_ID

        // ACCOUNT_ID

        // YEAR_ID

        // ORG_ID

        // PROGRAM_ID

        // PROGRAMS

        // ACTIVITY_ID

        // ACTIVITY_NAME

        // PAGU

        // PAGU_REALISASI

        // KEPERLUAN

        // BENDAHARA_ID

        // BENDAHARA

        // PPTK

        // PPTK_NAME

        // PA

        // PA_NAME

        // COMPANY_TYPE

        // COMPANY_ID

        // COMPANY

        // COMPANY_CHIEF

        // COMPANY_INFO

        // CONTRACT_NO

        // NPWP

        // COMPANY_BANK

        // COMPANY_ACCOUNT

        // AMOUNT_PAID

        // AMOUNT

        // BANK_ID

        // BANK_ACCOUNT

        // ISAPPROVED

        // APPROVED_BY

        // APPROVED_DATE

        // ISCETAK

        // PRINTQ

        // PRINT_DATE

        // PRINTED_BY

        // MODIFIED_DATE

        // MODIFIED_BY

        // BEND_TITLE

        // PPTK_TITLE

        // PA_TITLE

        // APPROVED_TITLE

        // APPROVED_ID

        // REF_BATCH

        // KLIRING_DATE

        // FA_V_BANK

        // FA_V_KLIRING

        // COMPANY_TO

        // PAY_METHOD_ID

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // SPP_ID
        $this->SPP_ID->ViewValue = $this->SPP_ID->CurrentValue;
        $this->SPP_ID->ViewCustomAttributes = "";

        // SPP_TYPE
        $this->SPP_TYPE->ViewValue = $this->SPP_TYPE->CurrentValue;
        $this->SPP_TYPE->ViewValue = FormatNumber($this->SPP_TYPE->ViewValue, 0, -2, -2, -2);
        $this->SPP_TYPE->ViewCustomAttributes = "";

        // SPP_NO
        $this->SPP_NO->ViewValue = $this->SPP_NO->CurrentValue;
        $this->SPP_NO->ViewCustomAttributes = "";

        // SPP_COUNTER
        $this->SPP_COUNTER->ViewValue = $this->SPP_COUNTER->CurrentValue;
        $this->SPP_COUNTER->ViewValue = FormatNumber($this->SPP_COUNTER->ViewValue, 0, -2, -2, -2);
        $this->SPP_COUNTER->ViewCustomAttributes = "";

        // SPP_BATCH
        $this->SPP_BATCH->ViewValue = $this->SPP_BATCH->CurrentValue;
        $this->SPP_BATCH->ViewCustomAttributes = "";

        // SPP_DATE
        $this->SPP_DATE->ViewValue = $this->SPP_DATE->CurrentValue;
        $this->SPP_DATE->ViewValue = FormatDateTime($this->SPP_DATE->ViewValue, 0);
        $this->SPP_DATE->ViewCustomAttributes = "";

        // SPP_DUE
        $this->SPP_DUE->ViewValue = $this->SPP_DUE->CurrentValue;
        $this->SPP_DUE->ViewValue = FormatDateTime($this->SPP_DUE->ViewValue, 0);
        $this->SPP_DUE->ViewCustomAttributes = "";

        // REF_TYPE
        $this->REF_TYPE->ViewValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->ViewValue = FormatNumber($this->REF_TYPE->ViewValue, 0, -2, -2, -2);
        $this->REF_TYPE->ViewCustomAttributes = "";

        // REF_NO
        $this->REF_NO->ViewValue = $this->REF_NO->CurrentValue;
        $this->REF_NO->ViewCustomAttributes = "";

        // REF_DATE
        $this->REF_DATE->ViewValue = $this->REF_DATE->CurrentValue;
        $this->REF_DATE->ViewValue = FormatDateTime($this->REF_DATE->ViewValue, 0);
        $this->REF_DATE->ViewCustomAttributes = "";

        // PACTIVITY_ID
        $this->PACTIVITY_ID->ViewValue = $this->PACTIVITY_ID->CurrentValue;
        $this->PACTIVITY_ID->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // PROGRAM_ID
        $this->PROGRAM_ID->ViewValue = $this->PROGRAM_ID->CurrentValue;
        $this->PROGRAM_ID->ViewCustomAttributes = "";

        // PROGRAMS
        $this->PROGRAMS->ViewValue = $this->PROGRAMS->CurrentValue;
        $this->PROGRAMS->ViewCustomAttributes = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->ViewValue = FormatNumber($this->ACTIVITY_ID->ViewValue, 0, -2, -2, -2);
        $this->ACTIVITY_ID->ViewCustomAttributes = "";

        // ACTIVITY_NAME
        $this->ACTIVITY_NAME->ViewValue = $this->ACTIVITY_NAME->CurrentValue;
        $this->ACTIVITY_NAME->ViewCustomAttributes = "";

        // PAGU
        $this->PAGU->ViewValue = $this->PAGU->CurrentValue;
        $this->PAGU->ViewValue = FormatNumber($this->PAGU->ViewValue, 2, -2, -2, -2);
        $this->PAGU->ViewCustomAttributes = "";

        // PAGU_REALISASI
        $this->PAGU_REALISASI->ViewValue = $this->PAGU_REALISASI->CurrentValue;
        $this->PAGU_REALISASI->ViewValue = FormatNumber($this->PAGU_REALISASI->ViewValue, 2, -2, -2, -2);
        $this->PAGU_REALISASI->ViewCustomAttributes = "";

        // KEPERLUAN
        $this->KEPERLUAN->ViewValue = $this->KEPERLUAN->CurrentValue;
        $this->KEPERLUAN->ViewCustomAttributes = "";

        // BENDAHARA_ID
        $this->BENDAHARA_ID->ViewValue = $this->BENDAHARA_ID->CurrentValue;
        $this->BENDAHARA_ID->ViewCustomAttributes = "";

        // BENDAHARA
        $this->BENDAHARA->ViewValue = $this->BENDAHARA->CurrentValue;
        $this->BENDAHARA->ViewCustomAttributes = "";

        // PPTK
        $this->PPTK->ViewValue = $this->PPTK->CurrentValue;
        $this->PPTK->ViewCustomAttributes = "";

        // PPTK_NAME
        $this->PPTK_NAME->ViewValue = $this->PPTK_NAME->CurrentValue;
        $this->PPTK_NAME->ViewCustomAttributes = "";

        // PA
        $this->PA->ViewValue = $this->PA->CurrentValue;
        $this->PA->ViewCustomAttributes = "";

        // PA_NAME
        $this->PA_NAME->ViewValue = $this->PA_NAME->CurrentValue;
        $this->PA_NAME->ViewCustomAttributes = "";

        // COMPANY_TYPE
        $this->COMPANY_TYPE->ViewValue = $this->COMPANY_TYPE->CurrentValue;
        $this->COMPANY_TYPE->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // COMPANY
        $this->COMPANY->ViewValue = $this->COMPANY->CurrentValue;
        $this->COMPANY->ViewCustomAttributes = "";

        // COMPANY_CHIEF
        $this->COMPANY_CHIEF->ViewValue = $this->COMPANY_CHIEF->CurrentValue;
        $this->COMPANY_CHIEF->ViewCustomAttributes = "";

        // COMPANY_INFO
        $this->COMPANY_INFO->ViewValue = $this->COMPANY_INFO->CurrentValue;
        $this->COMPANY_INFO->ViewCustomAttributes = "";

        // CONTRACT_NO
        $this->CONTRACT_NO->ViewValue = $this->CONTRACT_NO->CurrentValue;
        $this->CONTRACT_NO->ViewCustomAttributes = "";

        // NPWP
        $this->NPWP->ViewValue = $this->NPWP->CurrentValue;
        $this->NPWP->ViewCustomAttributes = "";

        // COMPANY_BANK
        $this->COMPANY_BANK->ViewValue = $this->COMPANY_BANK->CurrentValue;
        $this->COMPANY_BANK->ViewCustomAttributes = "";

        // COMPANY_ACCOUNT
        $this->COMPANY_ACCOUNT->ViewValue = $this->COMPANY_ACCOUNT->CurrentValue;
        $this->COMPANY_ACCOUNT->ViewCustomAttributes = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->ViewValue = FormatNumber($this->AMOUNT_PAID->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_PAID->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // BANK_ID
        $this->BANK_ID->ViewValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->ViewCustomAttributes = "";

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->ViewValue = $this->BANK_ACCOUNT->CurrentValue;
        $this->BANK_ACCOUNT->ViewCustomAttributes = "";

        // ISAPPROVED
        $this->ISAPPROVED->ViewValue = $this->ISAPPROVED->CurrentValue;
        $this->ISAPPROVED->ViewCustomAttributes = "";

        // APPROVED_BY
        $this->APPROVED_BY->ViewValue = $this->APPROVED_BY->CurrentValue;
        $this->APPROVED_BY->ViewCustomAttributes = "";

        // APPROVED_DATE
        $this->APPROVED_DATE->ViewValue = $this->APPROVED_DATE->CurrentValue;
        $this->APPROVED_DATE->ViewValue = FormatDateTime($this->APPROVED_DATE->ViewValue, 0);
        $this->APPROVED_DATE->ViewCustomAttributes = "";

        // ISCETAK
        $this->ISCETAK->ViewValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->ViewCustomAttributes = "";

        // PRINTQ
        $this->PRINTQ->ViewValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->ViewValue = FormatNumber($this->PRINTQ->ViewValue, 0, -2, -2, -2);
        $this->PRINTQ->ViewCustomAttributes = "";

        // PRINT_DATE
        $this->PRINT_DATE->ViewValue = $this->PRINT_DATE->CurrentValue;
        $this->PRINT_DATE->ViewValue = FormatDateTime($this->PRINT_DATE->ViewValue, 0);
        $this->PRINT_DATE->ViewCustomAttributes = "";

        // PRINTED_BY
        $this->PRINTED_BY->ViewValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // BEND_TITLE
        $this->BEND_TITLE->ViewValue = $this->BEND_TITLE->CurrentValue;
        $this->BEND_TITLE->ViewCustomAttributes = "";

        // PPTK_TITLE
        $this->PPTK_TITLE->ViewValue = $this->PPTK_TITLE->CurrentValue;
        $this->PPTK_TITLE->ViewCustomAttributes = "";

        // PA_TITLE
        $this->PA_TITLE->ViewValue = $this->PA_TITLE->CurrentValue;
        $this->PA_TITLE->ViewCustomAttributes = "";

        // APPROVED_TITLE
        $this->APPROVED_TITLE->ViewValue = $this->APPROVED_TITLE->CurrentValue;
        $this->APPROVED_TITLE->ViewCustomAttributes = "";

        // APPROVED_ID
        $this->APPROVED_ID->ViewValue = $this->APPROVED_ID->CurrentValue;
        $this->APPROVED_ID->ViewCustomAttributes = "";

        // REF_BATCH
        $this->REF_BATCH->ViewValue = $this->REF_BATCH->CurrentValue;
        $this->REF_BATCH->ViewCustomAttributes = "";

        // KLIRING_DATE
        $this->KLIRING_DATE->ViewValue = $this->KLIRING_DATE->CurrentValue;
        $this->KLIRING_DATE->ViewValue = FormatDateTime($this->KLIRING_DATE->ViewValue, 0);
        $this->KLIRING_DATE->ViewCustomAttributes = "";

        // FA_V_BANK
        $this->FA_V_BANK->ViewValue = $this->FA_V_BANK->CurrentValue;
        $this->FA_V_BANK->ViewCustomAttributes = "";

        // FA_V_KLIRING
        $this->FA_V_KLIRING->ViewValue = $this->FA_V_KLIRING->CurrentValue;
        $this->FA_V_KLIRING->ViewCustomAttributes = "";

        // COMPANY_TO
        $this->COMPANY_TO->ViewValue = $this->COMPANY_TO->CurrentValue;
        $this->COMPANY_TO->ViewCustomAttributes = "";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->ViewValue = $this->PAY_METHOD_ID->CurrentValue;
        $this->PAY_METHOD_ID->ViewValue = FormatNumber($this->PAY_METHOD_ID->ViewValue, 0, -2, -2, -2);
        $this->PAY_METHOD_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // SPP_ID
        $this->SPP_ID->LinkCustomAttributes = "";
        $this->SPP_ID->HrefValue = "";
        $this->SPP_ID->TooltipValue = "";

        // SPP_TYPE
        $this->SPP_TYPE->LinkCustomAttributes = "";
        $this->SPP_TYPE->HrefValue = "";
        $this->SPP_TYPE->TooltipValue = "";

        // SPP_NO
        $this->SPP_NO->LinkCustomAttributes = "";
        $this->SPP_NO->HrefValue = "";
        $this->SPP_NO->TooltipValue = "";

        // SPP_COUNTER
        $this->SPP_COUNTER->LinkCustomAttributes = "";
        $this->SPP_COUNTER->HrefValue = "";
        $this->SPP_COUNTER->TooltipValue = "";

        // SPP_BATCH
        $this->SPP_BATCH->LinkCustomAttributes = "";
        $this->SPP_BATCH->HrefValue = "";
        $this->SPP_BATCH->TooltipValue = "";

        // SPP_DATE
        $this->SPP_DATE->LinkCustomAttributes = "";
        $this->SPP_DATE->HrefValue = "";
        $this->SPP_DATE->TooltipValue = "";

        // SPP_DUE
        $this->SPP_DUE->LinkCustomAttributes = "";
        $this->SPP_DUE->HrefValue = "";
        $this->SPP_DUE->TooltipValue = "";

        // REF_TYPE
        $this->REF_TYPE->LinkCustomAttributes = "";
        $this->REF_TYPE->HrefValue = "";
        $this->REF_TYPE->TooltipValue = "";

        // REF_NO
        $this->REF_NO->LinkCustomAttributes = "";
        $this->REF_NO->HrefValue = "";
        $this->REF_NO->TooltipValue = "";

        // REF_DATE
        $this->REF_DATE->LinkCustomAttributes = "";
        $this->REF_DATE->HrefValue = "";
        $this->REF_DATE->TooltipValue = "";

        // PACTIVITY_ID
        $this->PACTIVITY_ID->LinkCustomAttributes = "";
        $this->PACTIVITY_ID->HrefValue = "";
        $this->PACTIVITY_ID->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // PROGRAM_ID
        $this->PROGRAM_ID->LinkCustomAttributes = "";
        $this->PROGRAM_ID->HrefValue = "";
        $this->PROGRAM_ID->TooltipValue = "";

        // PROGRAMS
        $this->PROGRAMS->LinkCustomAttributes = "";
        $this->PROGRAMS->HrefValue = "";
        $this->PROGRAMS->TooltipValue = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->LinkCustomAttributes = "";
        $this->ACTIVITY_ID->HrefValue = "";
        $this->ACTIVITY_ID->TooltipValue = "";

        // ACTIVITY_NAME
        $this->ACTIVITY_NAME->LinkCustomAttributes = "";
        $this->ACTIVITY_NAME->HrefValue = "";
        $this->ACTIVITY_NAME->TooltipValue = "";

        // PAGU
        $this->PAGU->LinkCustomAttributes = "";
        $this->PAGU->HrefValue = "";
        $this->PAGU->TooltipValue = "";

        // PAGU_REALISASI
        $this->PAGU_REALISASI->LinkCustomAttributes = "";
        $this->PAGU_REALISASI->HrefValue = "";
        $this->PAGU_REALISASI->TooltipValue = "";

        // KEPERLUAN
        $this->KEPERLUAN->LinkCustomAttributes = "";
        $this->KEPERLUAN->HrefValue = "";
        $this->KEPERLUAN->TooltipValue = "";

        // BENDAHARA_ID
        $this->BENDAHARA_ID->LinkCustomAttributes = "";
        $this->BENDAHARA_ID->HrefValue = "";
        $this->BENDAHARA_ID->TooltipValue = "";

        // BENDAHARA
        $this->BENDAHARA->LinkCustomAttributes = "";
        $this->BENDAHARA->HrefValue = "";
        $this->BENDAHARA->TooltipValue = "";

        // PPTK
        $this->PPTK->LinkCustomAttributes = "";
        $this->PPTK->HrefValue = "";
        $this->PPTK->TooltipValue = "";

        // PPTK_NAME
        $this->PPTK_NAME->LinkCustomAttributes = "";
        $this->PPTK_NAME->HrefValue = "";
        $this->PPTK_NAME->TooltipValue = "";

        // PA
        $this->PA->LinkCustomAttributes = "";
        $this->PA->HrefValue = "";
        $this->PA->TooltipValue = "";

        // PA_NAME
        $this->PA_NAME->LinkCustomAttributes = "";
        $this->PA_NAME->HrefValue = "";
        $this->PA_NAME->TooltipValue = "";

        // COMPANY_TYPE
        $this->COMPANY_TYPE->LinkCustomAttributes = "";
        $this->COMPANY_TYPE->HrefValue = "";
        $this->COMPANY_TYPE->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // COMPANY
        $this->COMPANY->LinkCustomAttributes = "";
        $this->COMPANY->HrefValue = "";
        $this->COMPANY->TooltipValue = "";

        // COMPANY_CHIEF
        $this->COMPANY_CHIEF->LinkCustomAttributes = "";
        $this->COMPANY_CHIEF->HrefValue = "";
        $this->COMPANY_CHIEF->TooltipValue = "";

        // COMPANY_INFO
        $this->COMPANY_INFO->LinkCustomAttributes = "";
        $this->COMPANY_INFO->HrefValue = "";
        $this->COMPANY_INFO->TooltipValue = "";

        // CONTRACT_NO
        $this->CONTRACT_NO->LinkCustomAttributes = "";
        $this->CONTRACT_NO->HrefValue = "";
        $this->CONTRACT_NO->TooltipValue = "";

        // NPWP
        $this->NPWP->LinkCustomAttributes = "";
        $this->NPWP->HrefValue = "";
        $this->NPWP->TooltipValue = "";

        // COMPANY_BANK
        $this->COMPANY_BANK->LinkCustomAttributes = "";
        $this->COMPANY_BANK->HrefValue = "";
        $this->COMPANY_BANK->TooltipValue = "";

        // COMPANY_ACCOUNT
        $this->COMPANY_ACCOUNT->LinkCustomAttributes = "";
        $this->COMPANY_ACCOUNT->HrefValue = "";
        $this->COMPANY_ACCOUNT->TooltipValue = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->LinkCustomAttributes = "";
        $this->AMOUNT_PAID->HrefValue = "";
        $this->AMOUNT_PAID->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // BANK_ID
        $this->BANK_ID->LinkCustomAttributes = "";
        $this->BANK_ID->HrefValue = "";
        $this->BANK_ID->TooltipValue = "";

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->LinkCustomAttributes = "";
        $this->BANK_ACCOUNT->HrefValue = "";
        $this->BANK_ACCOUNT->TooltipValue = "";

        // ISAPPROVED
        $this->ISAPPROVED->LinkCustomAttributes = "";
        $this->ISAPPROVED->HrefValue = "";
        $this->ISAPPROVED->TooltipValue = "";

        // APPROVED_BY
        $this->APPROVED_BY->LinkCustomAttributes = "";
        $this->APPROVED_BY->HrefValue = "";
        $this->APPROVED_BY->TooltipValue = "";

        // APPROVED_DATE
        $this->APPROVED_DATE->LinkCustomAttributes = "";
        $this->APPROVED_DATE->HrefValue = "";
        $this->APPROVED_DATE->TooltipValue = "";

        // ISCETAK
        $this->ISCETAK->LinkCustomAttributes = "";
        $this->ISCETAK->HrefValue = "";
        $this->ISCETAK->TooltipValue = "";

        // PRINTQ
        $this->PRINTQ->LinkCustomAttributes = "";
        $this->PRINTQ->HrefValue = "";
        $this->PRINTQ->TooltipValue = "";

        // PRINT_DATE
        $this->PRINT_DATE->LinkCustomAttributes = "";
        $this->PRINT_DATE->HrefValue = "";
        $this->PRINT_DATE->TooltipValue = "";

        // PRINTED_BY
        $this->PRINTED_BY->LinkCustomAttributes = "";
        $this->PRINTED_BY->HrefValue = "";
        $this->PRINTED_BY->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // BEND_TITLE
        $this->BEND_TITLE->LinkCustomAttributes = "";
        $this->BEND_TITLE->HrefValue = "";
        $this->BEND_TITLE->TooltipValue = "";

        // PPTK_TITLE
        $this->PPTK_TITLE->LinkCustomAttributes = "";
        $this->PPTK_TITLE->HrefValue = "";
        $this->PPTK_TITLE->TooltipValue = "";

        // PA_TITLE
        $this->PA_TITLE->LinkCustomAttributes = "";
        $this->PA_TITLE->HrefValue = "";
        $this->PA_TITLE->TooltipValue = "";

        // APPROVED_TITLE
        $this->APPROVED_TITLE->LinkCustomAttributes = "";
        $this->APPROVED_TITLE->HrefValue = "";
        $this->APPROVED_TITLE->TooltipValue = "";

        // APPROVED_ID
        $this->APPROVED_ID->LinkCustomAttributes = "";
        $this->APPROVED_ID->HrefValue = "";
        $this->APPROVED_ID->TooltipValue = "";

        // REF_BATCH
        $this->REF_BATCH->LinkCustomAttributes = "";
        $this->REF_BATCH->HrefValue = "";
        $this->REF_BATCH->TooltipValue = "";

        // KLIRING_DATE
        $this->KLIRING_DATE->LinkCustomAttributes = "";
        $this->KLIRING_DATE->HrefValue = "";
        $this->KLIRING_DATE->TooltipValue = "";

        // FA_V_BANK
        $this->FA_V_BANK->LinkCustomAttributes = "";
        $this->FA_V_BANK->HrefValue = "";
        $this->FA_V_BANK->TooltipValue = "";

        // FA_V_KLIRING
        $this->FA_V_KLIRING->LinkCustomAttributes = "";
        $this->FA_V_KLIRING->HrefValue = "";
        $this->FA_V_KLIRING->TooltipValue = "";

        // COMPANY_TO
        $this->COMPANY_TO->LinkCustomAttributes = "";
        $this->COMPANY_TO->HrefValue = "";
        $this->COMPANY_TO->TooltipValue = "";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->LinkCustomAttributes = "";
        $this->PAY_METHOD_ID->HrefValue = "";
        $this->PAY_METHOD_ID->TooltipValue = "";

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

        // SPP_ID
        $this->SPP_ID->EditAttrs["class"] = "form-control";
        $this->SPP_ID->EditCustomAttributes = "";
        if (!$this->SPP_ID->Raw) {
            $this->SPP_ID->CurrentValue = HtmlDecode($this->SPP_ID->CurrentValue);
        }
        $this->SPP_ID->EditValue = $this->SPP_ID->CurrentValue;
        $this->SPP_ID->PlaceHolder = RemoveHtml($this->SPP_ID->caption());

        // SPP_TYPE
        $this->SPP_TYPE->EditAttrs["class"] = "form-control";
        $this->SPP_TYPE->EditCustomAttributes = "";
        $this->SPP_TYPE->EditValue = $this->SPP_TYPE->CurrentValue;
        $this->SPP_TYPE->PlaceHolder = RemoveHtml($this->SPP_TYPE->caption());

        // SPP_NO
        $this->SPP_NO->EditAttrs["class"] = "form-control";
        $this->SPP_NO->EditCustomAttributes = "";
        if (!$this->SPP_NO->Raw) {
            $this->SPP_NO->CurrentValue = HtmlDecode($this->SPP_NO->CurrentValue);
        }
        $this->SPP_NO->EditValue = $this->SPP_NO->CurrentValue;
        $this->SPP_NO->PlaceHolder = RemoveHtml($this->SPP_NO->caption());

        // SPP_COUNTER
        $this->SPP_COUNTER->EditAttrs["class"] = "form-control";
        $this->SPP_COUNTER->EditCustomAttributes = "";
        $this->SPP_COUNTER->EditValue = $this->SPP_COUNTER->CurrentValue;
        $this->SPP_COUNTER->PlaceHolder = RemoveHtml($this->SPP_COUNTER->caption());

        // SPP_BATCH
        $this->SPP_BATCH->EditAttrs["class"] = "form-control";
        $this->SPP_BATCH->EditCustomAttributes = "";
        if (!$this->SPP_BATCH->Raw) {
            $this->SPP_BATCH->CurrentValue = HtmlDecode($this->SPP_BATCH->CurrentValue);
        }
        $this->SPP_BATCH->EditValue = $this->SPP_BATCH->CurrentValue;
        $this->SPP_BATCH->PlaceHolder = RemoveHtml($this->SPP_BATCH->caption());

        // SPP_DATE
        $this->SPP_DATE->EditAttrs["class"] = "form-control";
        $this->SPP_DATE->EditCustomAttributes = "";
        $this->SPP_DATE->EditValue = FormatDateTime($this->SPP_DATE->CurrentValue, 8);
        $this->SPP_DATE->PlaceHolder = RemoveHtml($this->SPP_DATE->caption());

        // SPP_DUE
        $this->SPP_DUE->EditAttrs["class"] = "form-control";
        $this->SPP_DUE->EditCustomAttributes = "";
        $this->SPP_DUE->EditValue = FormatDateTime($this->SPP_DUE->CurrentValue, 8);
        $this->SPP_DUE->PlaceHolder = RemoveHtml($this->SPP_DUE->caption());

        // REF_TYPE
        $this->REF_TYPE->EditAttrs["class"] = "form-control";
        $this->REF_TYPE->EditCustomAttributes = "";
        $this->REF_TYPE->EditValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->PlaceHolder = RemoveHtml($this->REF_TYPE->caption());

        // REF_NO
        $this->REF_NO->EditAttrs["class"] = "form-control";
        $this->REF_NO->EditCustomAttributes = "";
        if (!$this->REF_NO->Raw) {
            $this->REF_NO->CurrentValue = HtmlDecode($this->REF_NO->CurrentValue);
        }
        $this->REF_NO->EditValue = $this->REF_NO->CurrentValue;
        $this->REF_NO->PlaceHolder = RemoveHtml($this->REF_NO->caption());

        // REF_DATE
        $this->REF_DATE->EditAttrs["class"] = "form-control";
        $this->REF_DATE->EditCustomAttributes = "";
        $this->REF_DATE->EditValue = FormatDateTime($this->REF_DATE->CurrentValue, 8);
        $this->REF_DATE->PlaceHolder = RemoveHtml($this->REF_DATE->caption());

        // PACTIVITY_ID
        $this->PACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->PACTIVITY_ID->EditCustomAttributes = "";
        if (!$this->PACTIVITY_ID->Raw) {
            $this->PACTIVITY_ID->CurrentValue = HtmlDecode($this->PACTIVITY_ID->CurrentValue);
        }
        $this->PACTIVITY_ID->EditValue = $this->PACTIVITY_ID->CurrentValue;
        $this->PACTIVITY_ID->PlaceHolder = RemoveHtml($this->PACTIVITY_ID->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        if (!$this->ORG_ID->Raw) {
            $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
        }
        $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

        // PROGRAM_ID
        $this->PROGRAM_ID->EditAttrs["class"] = "form-control";
        $this->PROGRAM_ID->EditCustomAttributes = "";
        if (!$this->PROGRAM_ID->Raw) {
            $this->PROGRAM_ID->CurrentValue = HtmlDecode($this->PROGRAM_ID->CurrentValue);
        }
        $this->PROGRAM_ID->EditValue = $this->PROGRAM_ID->CurrentValue;
        $this->PROGRAM_ID->PlaceHolder = RemoveHtml($this->PROGRAM_ID->caption());

        // PROGRAMS
        $this->PROGRAMS->EditAttrs["class"] = "form-control";
        $this->PROGRAMS->EditCustomAttributes = "";
        if (!$this->PROGRAMS->Raw) {
            $this->PROGRAMS->CurrentValue = HtmlDecode($this->PROGRAMS->CurrentValue);
        }
        $this->PROGRAMS->EditValue = $this->PROGRAMS->CurrentValue;
        $this->PROGRAMS->PlaceHolder = RemoveHtml($this->PROGRAMS->caption());

        // ACTIVITY_ID
        $this->ACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->ACTIVITY_ID->EditCustomAttributes = "";
        $this->ACTIVITY_ID->EditValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->PlaceHolder = RemoveHtml($this->ACTIVITY_ID->caption());

        // ACTIVITY_NAME
        $this->ACTIVITY_NAME->EditAttrs["class"] = "form-control";
        $this->ACTIVITY_NAME->EditCustomAttributes = "";
        if (!$this->ACTIVITY_NAME->Raw) {
            $this->ACTIVITY_NAME->CurrentValue = HtmlDecode($this->ACTIVITY_NAME->CurrentValue);
        }
        $this->ACTIVITY_NAME->EditValue = $this->ACTIVITY_NAME->CurrentValue;
        $this->ACTIVITY_NAME->PlaceHolder = RemoveHtml($this->ACTIVITY_NAME->caption());

        // PAGU
        $this->PAGU->EditAttrs["class"] = "form-control";
        $this->PAGU->EditCustomAttributes = "";
        $this->PAGU->EditValue = $this->PAGU->CurrentValue;
        $this->PAGU->PlaceHolder = RemoveHtml($this->PAGU->caption());
        if (strval($this->PAGU->EditValue) != "" && is_numeric($this->PAGU->EditValue)) {
            $this->PAGU->EditValue = FormatNumber($this->PAGU->EditValue, -2, -2, -2, -2);
        }

        // PAGU_REALISASI
        $this->PAGU_REALISASI->EditAttrs["class"] = "form-control";
        $this->PAGU_REALISASI->EditCustomAttributes = "";
        $this->PAGU_REALISASI->EditValue = $this->PAGU_REALISASI->CurrentValue;
        $this->PAGU_REALISASI->PlaceHolder = RemoveHtml($this->PAGU_REALISASI->caption());
        if (strval($this->PAGU_REALISASI->EditValue) != "" && is_numeric($this->PAGU_REALISASI->EditValue)) {
            $this->PAGU_REALISASI->EditValue = FormatNumber($this->PAGU_REALISASI->EditValue, -2, -2, -2, -2);
        }

        // KEPERLUAN
        $this->KEPERLUAN->EditAttrs["class"] = "form-control";
        $this->KEPERLUAN->EditCustomAttributes = "";
        if (!$this->KEPERLUAN->Raw) {
            $this->KEPERLUAN->CurrentValue = HtmlDecode($this->KEPERLUAN->CurrentValue);
        }
        $this->KEPERLUAN->EditValue = $this->KEPERLUAN->CurrentValue;
        $this->KEPERLUAN->PlaceHolder = RemoveHtml($this->KEPERLUAN->caption());

        // BENDAHARA_ID
        $this->BENDAHARA_ID->EditAttrs["class"] = "form-control";
        $this->BENDAHARA_ID->EditCustomAttributes = "";
        if (!$this->BENDAHARA_ID->Raw) {
            $this->BENDAHARA_ID->CurrentValue = HtmlDecode($this->BENDAHARA_ID->CurrentValue);
        }
        $this->BENDAHARA_ID->EditValue = $this->BENDAHARA_ID->CurrentValue;
        $this->BENDAHARA_ID->PlaceHolder = RemoveHtml($this->BENDAHARA_ID->caption());

        // BENDAHARA
        $this->BENDAHARA->EditAttrs["class"] = "form-control";
        $this->BENDAHARA->EditCustomAttributes = "";
        if (!$this->BENDAHARA->Raw) {
            $this->BENDAHARA->CurrentValue = HtmlDecode($this->BENDAHARA->CurrentValue);
        }
        $this->BENDAHARA->EditValue = $this->BENDAHARA->CurrentValue;
        $this->BENDAHARA->PlaceHolder = RemoveHtml($this->BENDAHARA->caption());

        // PPTK
        $this->PPTK->EditAttrs["class"] = "form-control";
        $this->PPTK->EditCustomAttributes = "";
        if (!$this->PPTK->Raw) {
            $this->PPTK->CurrentValue = HtmlDecode($this->PPTK->CurrentValue);
        }
        $this->PPTK->EditValue = $this->PPTK->CurrentValue;
        $this->PPTK->PlaceHolder = RemoveHtml($this->PPTK->caption());

        // PPTK_NAME
        $this->PPTK_NAME->EditAttrs["class"] = "form-control";
        $this->PPTK_NAME->EditCustomAttributes = "";
        if (!$this->PPTK_NAME->Raw) {
            $this->PPTK_NAME->CurrentValue = HtmlDecode($this->PPTK_NAME->CurrentValue);
        }
        $this->PPTK_NAME->EditValue = $this->PPTK_NAME->CurrentValue;
        $this->PPTK_NAME->PlaceHolder = RemoveHtml($this->PPTK_NAME->caption());

        // PA
        $this->PA->EditAttrs["class"] = "form-control";
        $this->PA->EditCustomAttributes = "";
        if (!$this->PA->Raw) {
            $this->PA->CurrentValue = HtmlDecode($this->PA->CurrentValue);
        }
        $this->PA->EditValue = $this->PA->CurrentValue;
        $this->PA->PlaceHolder = RemoveHtml($this->PA->caption());

        // PA_NAME
        $this->PA_NAME->EditAttrs["class"] = "form-control";
        $this->PA_NAME->EditCustomAttributes = "";
        if (!$this->PA_NAME->Raw) {
            $this->PA_NAME->CurrentValue = HtmlDecode($this->PA_NAME->CurrentValue);
        }
        $this->PA_NAME->EditValue = $this->PA_NAME->CurrentValue;
        $this->PA_NAME->PlaceHolder = RemoveHtml($this->PA_NAME->caption());

        // COMPANY_TYPE
        $this->COMPANY_TYPE->EditAttrs["class"] = "form-control";
        $this->COMPANY_TYPE->EditCustomAttributes = "";
        if (!$this->COMPANY_TYPE->Raw) {
            $this->COMPANY_TYPE->CurrentValue = HtmlDecode($this->COMPANY_TYPE->CurrentValue);
        }
        $this->COMPANY_TYPE->EditValue = $this->COMPANY_TYPE->CurrentValue;
        $this->COMPANY_TYPE->PlaceHolder = RemoveHtml($this->COMPANY_TYPE->caption());

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // COMPANY
        $this->COMPANY->EditAttrs["class"] = "form-control";
        $this->COMPANY->EditCustomAttributes = "";
        if (!$this->COMPANY->Raw) {
            $this->COMPANY->CurrentValue = HtmlDecode($this->COMPANY->CurrentValue);
        }
        $this->COMPANY->EditValue = $this->COMPANY->CurrentValue;
        $this->COMPANY->PlaceHolder = RemoveHtml($this->COMPANY->caption());

        // COMPANY_CHIEF
        $this->COMPANY_CHIEF->EditAttrs["class"] = "form-control";
        $this->COMPANY_CHIEF->EditCustomAttributes = "";
        if (!$this->COMPANY_CHIEF->Raw) {
            $this->COMPANY_CHIEF->CurrentValue = HtmlDecode($this->COMPANY_CHIEF->CurrentValue);
        }
        $this->COMPANY_CHIEF->EditValue = $this->COMPANY_CHIEF->CurrentValue;
        $this->COMPANY_CHIEF->PlaceHolder = RemoveHtml($this->COMPANY_CHIEF->caption());

        // COMPANY_INFO
        $this->COMPANY_INFO->EditAttrs["class"] = "form-control";
        $this->COMPANY_INFO->EditCustomAttributes = "";
        if (!$this->COMPANY_INFO->Raw) {
            $this->COMPANY_INFO->CurrentValue = HtmlDecode($this->COMPANY_INFO->CurrentValue);
        }
        $this->COMPANY_INFO->EditValue = $this->COMPANY_INFO->CurrentValue;
        $this->COMPANY_INFO->PlaceHolder = RemoveHtml($this->COMPANY_INFO->caption());

        // CONTRACT_NO
        $this->CONTRACT_NO->EditAttrs["class"] = "form-control";
        $this->CONTRACT_NO->EditCustomAttributes = "";
        if (!$this->CONTRACT_NO->Raw) {
            $this->CONTRACT_NO->CurrentValue = HtmlDecode($this->CONTRACT_NO->CurrentValue);
        }
        $this->CONTRACT_NO->EditValue = $this->CONTRACT_NO->CurrentValue;
        $this->CONTRACT_NO->PlaceHolder = RemoveHtml($this->CONTRACT_NO->caption());

        // NPWP
        $this->NPWP->EditAttrs["class"] = "form-control";
        $this->NPWP->EditCustomAttributes = "";
        if (!$this->NPWP->Raw) {
            $this->NPWP->CurrentValue = HtmlDecode($this->NPWP->CurrentValue);
        }
        $this->NPWP->EditValue = $this->NPWP->CurrentValue;
        $this->NPWP->PlaceHolder = RemoveHtml($this->NPWP->caption());

        // COMPANY_BANK
        $this->COMPANY_BANK->EditAttrs["class"] = "form-control";
        $this->COMPANY_BANK->EditCustomAttributes = "";
        if (!$this->COMPANY_BANK->Raw) {
            $this->COMPANY_BANK->CurrentValue = HtmlDecode($this->COMPANY_BANK->CurrentValue);
        }
        $this->COMPANY_BANK->EditValue = $this->COMPANY_BANK->CurrentValue;
        $this->COMPANY_BANK->PlaceHolder = RemoveHtml($this->COMPANY_BANK->caption());

        // COMPANY_ACCOUNT
        $this->COMPANY_ACCOUNT->EditAttrs["class"] = "form-control";
        $this->COMPANY_ACCOUNT->EditCustomAttributes = "";
        if (!$this->COMPANY_ACCOUNT->Raw) {
            $this->COMPANY_ACCOUNT->CurrentValue = HtmlDecode($this->COMPANY_ACCOUNT->CurrentValue);
        }
        $this->COMPANY_ACCOUNT->EditValue = $this->COMPANY_ACCOUNT->CurrentValue;
        $this->COMPANY_ACCOUNT->PlaceHolder = RemoveHtml($this->COMPANY_ACCOUNT->caption());

        // AMOUNT_PAID
        $this->AMOUNT_PAID->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PAID->EditCustomAttributes = "";
        $this->AMOUNT_PAID->EditValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->PlaceHolder = RemoveHtml($this->AMOUNT_PAID->caption());
        if (strval($this->AMOUNT_PAID->EditValue) != "" && is_numeric($this->AMOUNT_PAID->EditValue)) {
            $this->AMOUNT_PAID->EditValue = FormatNumber($this->AMOUNT_PAID->EditValue, -2, -2, -2, -2);
        }

        // AMOUNT
        $this->AMOUNT->EditAttrs["class"] = "form-control";
        $this->AMOUNT->EditCustomAttributes = "";
        $this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
        if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue)) {
            $this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // BANK_ID
        $this->BANK_ID->EditAttrs["class"] = "form-control";
        $this->BANK_ID->EditCustomAttributes = "";
        if (!$this->BANK_ID->Raw) {
            $this->BANK_ID->CurrentValue = HtmlDecode($this->BANK_ID->CurrentValue);
        }
        $this->BANK_ID->EditValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->PlaceHolder = RemoveHtml($this->BANK_ID->caption());

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->EditAttrs["class"] = "form-control";
        $this->BANK_ACCOUNT->EditCustomAttributes = "";
        if (!$this->BANK_ACCOUNT->Raw) {
            $this->BANK_ACCOUNT->CurrentValue = HtmlDecode($this->BANK_ACCOUNT->CurrentValue);
        }
        $this->BANK_ACCOUNT->EditValue = $this->BANK_ACCOUNT->CurrentValue;
        $this->BANK_ACCOUNT->PlaceHolder = RemoveHtml($this->BANK_ACCOUNT->caption());

        // ISAPPROVED
        $this->ISAPPROVED->EditAttrs["class"] = "form-control";
        $this->ISAPPROVED->EditCustomAttributes = "";
        if (!$this->ISAPPROVED->Raw) {
            $this->ISAPPROVED->CurrentValue = HtmlDecode($this->ISAPPROVED->CurrentValue);
        }
        $this->ISAPPROVED->EditValue = $this->ISAPPROVED->CurrentValue;
        $this->ISAPPROVED->PlaceHolder = RemoveHtml($this->ISAPPROVED->caption());

        // APPROVED_BY
        $this->APPROVED_BY->EditAttrs["class"] = "form-control";
        $this->APPROVED_BY->EditCustomAttributes = "";
        if (!$this->APPROVED_BY->Raw) {
            $this->APPROVED_BY->CurrentValue = HtmlDecode($this->APPROVED_BY->CurrentValue);
        }
        $this->APPROVED_BY->EditValue = $this->APPROVED_BY->CurrentValue;
        $this->APPROVED_BY->PlaceHolder = RemoveHtml($this->APPROVED_BY->caption());

        // APPROVED_DATE
        $this->APPROVED_DATE->EditAttrs["class"] = "form-control";
        $this->APPROVED_DATE->EditCustomAttributes = "";
        $this->APPROVED_DATE->EditValue = FormatDateTime($this->APPROVED_DATE->CurrentValue, 8);
        $this->APPROVED_DATE->PlaceHolder = RemoveHtml($this->APPROVED_DATE->caption());

        // ISCETAK
        $this->ISCETAK->EditAttrs["class"] = "form-control";
        $this->ISCETAK->EditCustomAttributes = "";
        if (!$this->ISCETAK->Raw) {
            $this->ISCETAK->CurrentValue = HtmlDecode($this->ISCETAK->CurrentValue);
        }
        $this->ISCETAK->EditValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->PlaceHolder = RemoveHtml($this->ISCETAK->caption());

        // PRINTQ
        $this->PRINTQ->EditAttrs["class"] = "form-control";
        $this->PRINTQ->EditCustomAttributes = "";
        $this->PRINTQ->EditValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->PlaceHolder = RemoveHtml($this->PRINTQ->caption());

        // PRINT_DATE
        $this->PRINT_DATE->EditAttrs["class"] = "form-control";
        $this->PRINT_DATE->EditCustomAttributes = "";
        $this->PRINT_DATE->EditValue = FormatDateTime($this->PRINT_DATE->CurrentValue, 8);
        $this->PRINT_DATE->PlaceHolder = RemoveHtml($this->PRINT_DATE->caption());

        // PRINTED_BY
        $this->PRINTED_BY->EditAttrs["class"] = "form-control";
        $this->PRINTED_BY->EditCustomAttributes = "";
        if (!$this->PRINTED_BY->Raw) {
            $this->PRINTED_BY->CurrentValue = HtmlDecode($this->PRINTED_BY->CurrentValue);
        }
        $this->PRINTED_BY->EditValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->PlaceHolder = RemoveHtml($this->PRINTED_BY->caption());

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

        // BEND_TITLE
        $this->BEND_TITLE->EditAttrs["class"] = "form-control";
        $this->BEND_TITLE->EditCustomAttributes = "";
        if (!$this->BEND_TITLE->Raw) {
            $this->BEND_TITLE->CurrentValue = HtmlDecode($this->BEND_TITLE->CurrentValue);
        }
        $this->BEND_TITLE->EditValue = $this->BEND_TITLE->CurrentValue;
        $this->BEND_TITLE->PlaceHolder = RemoveHtml($this->BEND_TITLE->caption());

        // PPTK_TITLE
        $this->PPTK_TITLE->EditAttrs["class"] = "form-control";
        $this->PPTK_TITLE->EditCustomAttributes = "";
        if (!$this->PPTK_TITLE->Raw) {
            $this->PPTK_TITLE->CurrentValue = HtmlDecode($this->PPTK_TITLE->CurrentValue);
        }
        $this->PPTK_TITLE->EditValue = $this->PPTK_TITLE->CurrentValue;
        $this->PPTK_TITLE->PlaceHolder = RemoveHtml($this->PPTK_TITLE->caption());

        // PA_TITLE
        $this->PA_TITLE->EditAttrs["class"] = "form-control";
        $this->PA_TITLE->EditCustomAttributes = "";
        if (!$this->PA_TITLE->Raw) {
            $this->PA_TITLE->CurrentValue = HtmlDecode($this->PA_TITLE->CurrentValue);
        }
        $this->PA_TITLE->EditValue = $this->PA_TITLE->CurrentValue;
        $this->PA_TITLE->PlaceHolder = RemoveHtml($this->PA_TITLE->caption());

        // APPROVED_TITLE
        $this->APPROVED_TITLE->EditAttrs["class"] = "form-control";
        $this->APPROVED_TITLE->EditCustomAttributes = "";
        if (!$this->APPROVED_TITLE->Raw) {
            $this->APPROVED_TITLE->CurrentValue = HtmlDecode($this->APPROVED_TITLE->CurrentValue);
        }
        $this->APPROVED_TITLE->EditValue = $this->APPROVED_TITLE->CurrentValue;
        $this->APPROVED_TITLE->PlaceHolder = RemoveHtml($this->APPROVED_TITLE->caption());

        // APPROVED_ID
        $this->APPROVED_ID->EditAttrs["class"] = "form-control";
        $this->APPROVED_ID->EditCustomAttributes = "";
        if (!$this->APPROVED_ID->Raw) {
            $this->APPROVED_ID->CurrentValue = HtmlDecode($this->APPROVED_ID->CurrentValue);
        }
        $this->APPROVED_ID->EditValue = $this->APPROVED_ID->CurrentValue;
        $this->APPROVED_ID->PlaceHolder = RemoveHtml($this->APPROVED_ID->caption());

        // REF_BATCH
        $this->REF_BATCH->EditAttrs["class"] = "form-control";
        $this->REF_BATCH->EditCustomAttributes = "";
        if (!$this->REF_BATCH->Raw) {
            $this->REF_BATCH->CurrentValue = HtmlDecode($this->REF_BATCH->CurrentValue);
        }
        $this->REF_BATCH->EditValue = $this->REF_BATCH->CurrentValue;
        $this->REF_BATCH->PlaceHolder = RemoveHtml($this->REF_BATCH->caption());

        // KLIRING_DATE
        $this->KLIRING_DATE->EditAttrs["class"] = "form-control";
        $this->KLIRING_DATE->EditCustomAttributes = "";
        $this->KLIRING_DATE->EditValue = FormatDateTime($this->KLIRING_DATE->CurrentValue, 8);
        $this->KLIRING_DATE->PlaceHolder = RemoveHtml($this->KLIRING_DATE->caption());

        // FA_V_BANK
        $this->FA_V_BANK->EditAttrs["class"] = "form-control";
        $this->FA_V_BANK->EditCustomAttributes = "";
        if (!$this->FA_V_BANK->Raw) {
            $this->FA_V_BANK->CurrentValue = HtmlDecode($this->FA_V_BANK->CurrentValue);
        }
        $this->FA_V_BANK->EditValue = $this->FA_V_BANK->CurrentValue;
        $this->FA_V_BANK->PlaceHolder = RemoveHtml($this->FA_V_BANK->caption());

        // FA_V_KLIRING
        $this->FA_V_KLIRING->EditAttrs["class"] = "form-control";
        $this->FA_V_KLIRING->EditCustomAttributes = "";
        if (!$this->FA_V_KLIRING->Raw) {
            $this->FA_V_KLIRING->CurrentValue = HtmlDecode($this->FA_V_KLIRING->CurrentValue);
        }
        $this->FA_V_KLIRING->EditValue = $this->FA_V_KLIRING->CurrentValue;
        $this->FA_V_KLIRING->PlaceHolder = RemoveHtml($this->FA_V_KLIRING->caption());

        // COMPANY_TO
        $this->COMPANY_TO->EditAttrs["class"] = "form-control";
        $this->COMPANY_TO->EditCustomAttributes = "";
        if (!$this->COMPANY_TO->Raw) {
            $this->COMPANY_TO->CurrentValue = HtmlDecode($this->COMPANY_TO->CurrentValue);
        }
        $this->COMPANY_TO->EditValue = $this->COMPANY_TO->CurrentValue;
        $this->COMPANY_TO->PlaceHolder = RemoveHtml($this->COMPANY_TO->caption());

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->EditAttrs["class"] = "form-control";
        $this->PAY_METHOD_ID->EditCustomAttributes = "";
        $this->PAY_METHOD_ID->EditValue = $this->PAY_METHOD_ID->CurrentValue;
        $this->PAY_METHOD_ID->PlaceHolder = RemoveHtml($this->PAY_METHOD_ID->caption());

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
                    $doc->exportCaption($this->SPP_ID);
                    $doc->exportCaption($this->SPP_TYPE);
                    $doc->exportCaption($this->SPP_NO);
                    $doc->exportCaption($this->SPP_COUNTER);
                    $doc->exportCaption($this->SPP_BATCH);
                    $doc->exportCaption($this->SPP_DATE);
                    $doc->exportCaption($this->SPP_DUE);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REF_NO);
                    $doc->exportCaption($this->REF_DATE);
                    $doc->exportCaption($this->PACTIVITY_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->PROGRAM_ID);
                    $doc->exportCaption($this->PROGRAMS);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->ACTIVITY_NAME);
                    $doc->exportCaption($this->PAGU);
                    $doc->exportCaption($this->PAGU_REALISASI);
                    $doc->exportCaption($this->KEPERLUAN);
                    $doc->exportCaption($this->BENDAHARA_ID);
                    $doc->exportCaption($this->BENDAHARA);
                    $doc->exportCaption($this->PPTK);
                    $doc->exportCaption($this->PPTK_NAME);
                    $doc->exportCaption($this->PA);
                    $doc->exportCaption($this->PA_NAME);
                    $doc->exportCaption($this->COMPANY_TYPE);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY);
                    $doc->exportCaption($this->COMPANY_CHIEF);
                    $doc->exportCaption($this->COMPANY_INFO);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->COMPANY_BANK);
                    $doc->exportCaption($this->COMPANY_ACCOUNT);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->BANK_ACCOUNT);
                    $doc->exportCaption($this->ISAPPROVED);
                    $doc->exportCaption($this->APPROVED_BY);
                    $doc->exportCaption($this->APPROVED_DATE);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->BEND_TITLE);
                    $doc->exportCaption($this->PPTK_TITLE);
                    $doc->exportCaption($this->PA_TITLE);
                    $doc->exportCaption($this->APPROVED_TITLE);
                    $doc->exportCaption($this->APPROVED_ID);
                    $doc->exportCaption($this->REF_BATCH);
                    $doc->exportCaption($this->KLIRING_DATE);
                    $doc->exportCaption($this->FA_V_BANK);
                    $doc->exportCaption($this->FA_V_KLIRING);
                    $doc->exportCaption($this->COMPANY_TO);
                    $doc->exportCaption($this->PAY_METHOD_ID);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->SPP_ID);
                    $doc->exportCaption($this->SPP_TYPE);
                    $doc->exportCaption($this->SPP_NO);
                    $doc->exportCaption($this->SPP_COUNTER);
                    $doc->exportCaption($this->SPP_BATCH);
                    $doc->exportCaption($this->SPP_DATE);
                    $doc->exportCaption($this->SPP_DUE);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REF_NO);
                    $doc->exportCaption($this->REF_DATE);
                    $doc->exportCaption($this->PACTIVITY_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->PROGRAM_ID);
                    $doc->exportCaption($this->PROGRAMS);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->ACTIVITY_NAME);
                    $doc->exportCaption($this->PAGU);
                    $doc->exportCaption($this->PAGU_REALISASI);
                    $doc->exportCaption($this->KEPERLUAN);
                    $doc->exportCaption($this->BENDAHARA_ID);
                    $doc->exportCaption($this->BENDAHARA);
                    $doc->exportCaption($this->PPTK);
                    $doc->exportCaption($this->PPTK_NAME);
                    $doc->exportCaption($this->PA);
                    $doc->exportCaption($this->PA_NAME);
                    $doc->exportCaption($this->COMPANY_TYPE);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY);
                    $doc->exportCaption($this->COMPANY_CHIEF);
                    $doc->exportCaption($this->COMPANY_INFO);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->COMPANY_BANK);
                    $doc->exportCaption($this->COMPANY_ACCOUNT);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->BANK_ACCOUNT);
                    $doc->exportCaption($this->ISAPPROVED);
                    $doc->exportCaption($this->APPROVED_BY);
                    $doc->exportCaption($this->APPROVED_DATE);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->BEND_TITLE);
                    $doc->exportCaption($this->PPTK_TITLE);
                    $doc->exportCaption($this->PA_TITLE);
                    $doc->exportCaption($this->APPROVED_TITLE);
                    $doc->exportCaption($this->APPROVED_ID);
                    $doc->exportCaption($this->REF_BATCH);
                    $doc->exportCaption($this->KLIRING_DATE);
                    $doc->exportCaption($this->FA_V_BANK);
                    $doc->exportCaption($this->FA_V_KLIRING);
                    $doc->exportCaption($this->COMPANY_TO);
                    $doc->exportCaption($this->PAY_METHOD_ID);
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
                        $doc->exportField($this->SPP_ID);
                        $doc->exportField($this->SPP_TYPE);
                        $doc->exportField($this->SPP_NO);
                        $doc->exportField($this->SPP_COUNTER);
                        $doc->exportField($this->SPP_BATCH);
                        $doc->exportField($this->SPP_DATE);
                        $doc->exportField($this->SPP_DUE);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REF_NO);
                        $doc->exportField($this->REF_DATE);
                        $doc->exportField($this->PACTIVITY_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->PROGRAM_ID);
                        $doc->exportField($this->PROGRAMS);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->ACTIVITY_NAME);
                        $doc->exportField($this->PAGU);
                        $doc->exportField($this->PAGU_REALISASI);
                        $doc->exportField($this->KEPERLUAN);
                        $doc->exportField($this->BENDAHARA_ID);
                        $doc->exportField($this->BENDAHARA);
                        $doc->exportField($this->PPTK);
                        $doc->exportField($this->PPTK_NAME);
                        $doc->exportField($this->PA);
                        $doc->exportField($this->PA_NAME);
                        $doc->exportField($this->COMPANY_TYPE);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY);
                        $doc->exportField($this->COMPANY_CHIEF);
                        $doc->exportField($this->COMPANY_INFO);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->COMPANY_BANK);
                        $doc->exportField($this->COMPANY_ACCOUNT);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->BANK_ACCOUNT);
                        $doc->exportField($this->ISAPPROVED);
                        $doc->exportField($this->APPROVED_BY);
                        $doc->exportField($this->APPROVED_DATE);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->BEND_TITLE);
                        $doc->exportField($this->PPTK_TITLE);
                        $doc->exportField($this->PA_TITLE);
                        $doc->exportField($this->APPROVED_TITLE);
                        $doc->exportField($this->APPROVED_ID);
                        $doc->exportField($this->REF_BATCH);
                        $doc->exportField($this->KLIRING_DATE);
                        $doc->exportField($this->FA_V_BANK);
                        $doc->exportField($this->FA_V_KLIRING);
                        $doc->exportField($this->COMPANY_TO);
                        $doc->exportField($this->PAY_METHOD_ID);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->SPP_ID);
                        $doc->exportField($this->SPP_TYPE);
                        $doc->exportField($this->SPP_NO);
                        $doc->exportField($this->SPP_COUNTER);
                        $doc->exportField($this->SPP_BATCH);
                        $doc->exportField($this->SPP_DATE);
                        $doc->exportField($this->SPP_DUE);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REF_NO);
                        $doc->exportField($this->REF_DATE);
                        $doc->exportField($this->PACTIVITY_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->PROGRAM_ID);
                        $doc->exportField($this->PROGRAMS);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->ACTIVITY_NAME);
                        $doc->exportField($this->PAGU);
                        $doc->exportField($this->PAGU_REALISASI);
                        $doc->exportField($this->KEPERLUAN);
                        $doc->exportField($this->BENDAHARA_ID);
                        $doc->exportField($this->BENDAHARA);
                        $doc->exportField($this->PPTK);
                        $doc->exportField($this->PPTK_NAME);
                        $doc->exportField($this->PA);
                        $doc->exportField($this->PA_NAME);
                        $doc->exportField($this->COMPANY_TYPE);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY);
                        $doc->exportField($this->COMPANY_CHIEF);
                        $doc->exportField($this->COMPANY_INFO);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->COMPANY_BANK);
                        $doc->exportField($this->COMPANY_ACCOUNT);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->BANK_ACCOUNT);
                        $doc->exportField($this->ISAPPROVED);
                        $doc->exportField($this->APPROVED_BY);
                        $doc->exportField($this->APPROVED_DATE);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->BEND_TITLE);
                        $doc->exportField($this->PPTK_TITLE);
                        $doc->exportField($this->PA_TITLE);
                        $doc->exportField($this->APPROVED_TITLE);
                        $doc->exportField($this->APPROVED_ID);
                        $doc->exportField($this->REF_BATCH);
                        $doc->exportField($this->KLIRING_DATE);
                        $doc->exportField($this->FA_V_BANK);
                        $doc->exportField($this->FA_V_KLIRING);
                        $doc->exportField($this->COMPANY_TO);
                        $doc->exportField($this->PAY_METHOD_ID);
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
