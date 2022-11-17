<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for INVOICE
 */
class Invoice extends DbTable
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
    public $INVOICE_ID;
    public $INVOICE_TYPE;
    public $INVOICE_NO;
    public $INV_COUNTER;
    public $INV_DATE;
    public $INVOICE_TRANS;
    public $INVOICE_DUE;
    public $REF_TYPE;
    public $REF_NO;
    public $REF_NO2;
    public $REF_DATE;
    public $ACCOUNT_ID;
    public $YEAR_ID;
    public $ORG_ID;
    public $PROGRAM_ID;
    public $PROGRAMS;
    public $PACTIVITY_ID;
    public $ACTIVITY_ID;
    public $ACTIVITY_NAME;
    public $KEPERLUAN;
    public $PPTK;
    public $PPTK_NAME;
    public $COMPANY_ID;
    public $COMPANY_TO;
    public $COMPANY_TYPE;
    public $COMPANY;
    public $COMPANY_CHIEF;
    public $COMPANY_INFO;
    public $CONTRACT_NO;
    public $NPWP;
    public $COMPANY_BANK;
    public $COMPANY_ACCOUNT;
    public $PAGU;
    public $PAGU_REALISASI;
    public $AMOUNT;
    public $AMOUNT_PAID;
    public $PAYMENT_INSTRUCTIONS;
    public $ISAPPROVED;
    public $APPROVED_BY;
    public $APPROVED_DATE;
    public $ISCETAK;
    public $PRINTQ;
    public $PRINT_DATE;
    public $PRINTED_BY;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $PPTK_TITLE;
    public $APPROVED_ID;
    public $APPROVED_TITLE;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'INVOICE';
        $this->TableName = 'INVOICE';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[INVOICE]";
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
        $this->ORG_UNIT_CODE = new DbField('INVOICE', 'INVOICE', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // INVOICE_ID
        $this->INVOICE_ID = new DbField('INVOICE', 'INVOICE', 'x_INVOICE_ID', 'INVOICE_ID', '[INVOICE_ID]', '[INVOICE_ID]', 200, 50, -1, false, '[INVOICE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_ID->IsPrimaryKey = true; // Primary key field
        $this->INVOICE_ID->Nullable = false; // NOT NULL field
        $this->INVOICE_ID->Required = true; // Required field
        $this->INVOICE_ID->Sortable = true; // Allow sort
        $this->INVOICE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_ID->Param, "CustomMsg");
        $this->Fields['INVOICE_ID'] = &$this->INVOICE_ID;

        // INVOICE_TYPE
        $this->INVOICE_TYPE = new DbField('INVOICE', 'INVOICE', 'x_INVOICE_TYPE', 'INVOICE_TYPE', '[INVOICE_TYPE]', 'CAST([INVOICE_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[INVOICE_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_TYPE->Sortable = true; // Allow sort
        $this->INVOICE_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INVOICE_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_TYPE->Param, "CustomMsg");
        $this->Fields['INVOICE_TYPE'] = &$this->INVOICE_TYPE;

        // INVOICE_NO
        $this->INVOICE_NO = new DbField('INVOICE', 'INVOICE', 'x_INVOICE_NO', 'INVOICE_NO', '[INVOICE_NO]', '[INVOICE_NO]', 200, 50, -1, false, '[INVOICE_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_NO->Sortable = true; // Allow sort
        $this->INVOICE_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_NO->Param, "CustomMsg");
        $this->Fields['INVOICE_NO'] = &$this->INVOICE_NO;

        // INV_COUNTER
        $this->INV_COUNTER = new DbField('INVOICE', 'INVOICE', 'x_INV_COUNTER', 'INV_COUNTER', '[INV_COUNTER]', 'CAST([INV_COUNTER] AS NVARCHAR)', 3, 4, -1, false, '[INV_COUNTER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INV_COUNTER->Sortable = true; // Allow sort
        $this->INV_COUNTER->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INV_COUNTER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INV_COUNTER->Param, "CustomMsg");
        $this->Fields['INV_COUNTER'] = &$this->INV_COUNTER;

        // INV_DATE
        $this->INV_DATE = new DbField('INVOICE', 'INVOICE', 'x_INV_DATE', 'INV_DATE', '[INV_DATE]', CastDateFieldForLike("[INV_DATE]", 0, "DB"), 135, 8, 0, false, '[INV_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INV_DATE->Sortable = true; // Allow sort
        $this->INV_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->INV_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INV_DATE->Param, "CustomMsg");
        $this->Fields['INV_DATE'] = &$this->INV_DATE;

        // INVOICE_TRANS
        $this->INVOICE_TRANS = new DbField('INVOICE', 'INVOICE', 'x_INVOICE_TRANS', 'INVOICE_TRANS', '[INVOICE_TRANS]', CastDateFieldForLike("[INVOICE_TRANS]", 0, "DB"), 135, 8, 0, false, '[INVOICE_TRANS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_TRANS->Sortable = true; // Allow sort
        $this->INVOICE_TRANS->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->INVOICE_TRANS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_TRANS->Param, "CustomMsg");
        $this->Fields['INVOICE_TRANS'] = &$this->INVOICE_TRANS;

        // INVOICE_DUE
        $this->INVOICE_DUE = new DbField('INVOICE', 'INVOICE', 'x_INVOICE_DUE', 'INVOICE_DUE', '[INVOICE_DUE]', CastDateFieldForLike("[INVOICE_DUE]", 0, "DB"), 135, 8, 0, false, '[INVOICE_DUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_DUE->Sortable = true; // Allow sort
        $this->INVOICE_DUE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->INVOICE_DUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_DUE->Param, "CustomMsg");
        $this->Fields['INVOICE_DUE'] = &$this->INVOICE_DUE;

        // REF_TYPE
        $this->REF_TYPE = new DbField('INVOICE', 'INVOICE', 'x_REF_TYPE', 'REF_TYPE', '[REF_TYPE]', 'CAST([REF_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[REF_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_TYPE->Sortable = true; // Allow sort
        $this->REF_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REF_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_TYPE->Param, "CustomMsg");
        $this->Fields['REF_TYPE'] = &$this->REF_TYPE;

        // REF_NO
        $this->REF_NO = new DbField('INVOICE', 'INVOICE', 'x_REF_NO', 'REF_NO', '[REF_NO]', '[REF_NO]', 200, 75, -1, false, '[REF_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_NO->Sortable = true; // Allow sort
        $this->REF_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_NO->Param, "CustomMsg");
        $this->Fields['REF_NO'] = &$this->REF_NO;

        // REF_NO2
        $this->REF_NO2 = new DbField('INVOICE', 'INVOICE', 'x_REF_NO2', 'REF_NO2', '[REF_NO2]', '[REF_NO2]', 200, 75, -1, false, '[REF_NO2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_NO2->Sortable = true; // Allow sort
        $this->REF_NO2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_NO2->Param, "CustomMsg");
        $this->Fields['REF_NO2'] = &$this->REF_NO2;

        // REF_DATE
        $this->REF_DATE = new DbField('INVOICE', 'INVOICE', 'x_REF_DATE', 'REF_DATE', '[REF_DATE]', CastDateFieldForLike("[REF_DATE]", 0, "DB"), 135, 8, 0, false, '[REF_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_DATE->Sortable = true; // Allow sort
        $this->REF_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REF_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_DATE->Param, "CustomMsg");
        $this->Fields['REF_DATE'] = &$this->REF_DATE;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('INVOICE', 'INVOICE', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // YEAR_ID
        $this->YEAR_ID = new DbField('INVOICE', 'INVOICE', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // ORG_ID
        $this->ORG_ID = new DbField('INVOICE', 'INVOICE', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // PROGRAM_ID
        $this->PROGRAM_ID = new DbField('INVOICE', 'INVOICE', 'x_PROGRAM_ID', 'PROGRAM_ID', '[PROGRAM_ID]', '[PROGRAM_ID]', 200, 50, -1, false, '[PROGRAM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROGRAM_ID->Sortable = true; // Allow sort
        $this->PROGRAM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROGRAM_ID->Param, "CustomMsg");
        $this->Fields['PROGRAM_ID'] = &$this->PROGRAM_ID;

        // PROGRAMS
        $this->PROGRAMS = new DbField('INVOICE', 'INVOICE', 'x_PROGRAMS', 'PROGRAMS', '[PROGRAMS]', '[PROGRAMS]', 200, 200, -1, false, '[PROGRAMS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROGRAMS->Sortable = true; // Allow sort
        $this->PROGRAMS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROGRAMS->Param, "CustomMsg");
        $this->Fields['PROGRAMS'] = &$this->PROGRAMS;

        // PACTIVITY_ID
        $this->PACTIVITY_ID = new DbField('INVOICE', 'INVOICE', 'x_PACTIVITY_ID', 'PACTIVITY_ID', '[PACTIVITY_ID]', '[PACTIVITY_ID]', 200, 50, -1, false, '[PACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PACTIVITY_ID->Sortable = true; // Allow sort
        $this->PACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['PACTIVITY_ID'] = &$this->PACTIVITY_ID;

        // ACTIVITY_ID
        $this->ACTIVITY_ID = new DbField('INVOICE', 'INVOICE', 'x_ACTIVITY_ID', 'ACTIVITY_ID', '[ACTIVITY_ID]', '[ACTIVITY_ID]', 200, 50, -1, false, '[ACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACTIVITY_ID->Sortable = true; // Allow sort
        $this->ACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['ACTIVITY_ID'] = &$this->ACTIVITY_ID;

        // ACTIVITY_NAME
        $this->ACTIVITY_NAME = new DbField('INVOICE', 'INVOICE', 'x_ACTIVITY_NAME', 'ACTIVITY_NAME', '[ACTIVITY_NAME]', '[ACTIVITY_NAME]', 200, 200, -1, false, '[ACTIVITY_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACTIVITY_NAME->Sortable = true; // Allow sort
        $this->ACTIVITY_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACTIVITY_NAME->Param, "CustomMsg");
        $this->Fields['ACTIVITY_NAME'] = &$this->ACTIVITY_NAME;

        // KEPERLUAN
        $this->KEPERLUAN = new DbField('INVOICE', 'INVOICE', 'x_KEPERLUAN', 'KEPERLUAN', '[KEPERLUAN]', '[KEPERLUAN]', 200, 255, -1, false, '[KEPERLUAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KEPERLUAN->Sortable = true; // Allow sort
        $this->KEPERLUAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KEPERLUAN->Param, "CustomMsg");
        $this->Fields['KEPERLUAN'] = &$this->KEPERLUAN;

        // PPTK
        $this->PPTK = new DbField('INVOICE', 'INVOICE', 'x_PPTK', 'PPTK', '[PPTK]', '[PPTK]', 200, 50, -1, false, '[PPTK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPTK->Sortable = true; // Allow sort
        $this->PPTK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPTK->Param, "CustomMsg");
        $this->Fields['PPTK'] = &$this->PPTK;

        // PPTK_NAME
        $this->PPTK_NAME = new DbField('INVOICE', 'INVOICE', 'x_PPTK_NAME', 'PPTK_NAME', '[PPTK_NAME]', '[PPTK_NAME]', 200, 200, -1, false, '[PPTK_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPTK_NAME->Sortable = true; // Allow sort
        $this->PPTK_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPTK_NAME->Param, "CustomMsg");
        $this->Fields['PPTK_NAME'] = &$this->PPTK_NAME;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('INVOICE', 'INVOICE', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // COMPANY_TO
        $this->COMPANY_TO = new DbField('INVOICE', 'INVOICE', 'x_COMPANY_TO', 'COMPANY_TO', '[COMPANY_TO]', '[COMPANY_TO]', 200, 200, -1, false, '[COMPANY_TO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_TO->Sortable = true; // Allow sort
        $this->COMPANY_TO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_TO->Param, "CustomMsg");
        $this->Fields['COMPANY_TO'] = &$this->COMPANY_TO;

        // COMPANY_TYPE
        $this->COMPANY_TYPE = new DbField('INVOICE', 'INVOICE', 'x_COMPANY_TYPE', 'COMPANY_TYPE', '[COMPANY_TYPE]', '[COMPANY_TYPE]', 200, 15, -1, false, '[COMPANY_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_TYPE->Sortable = true; // Allow sort
        $this->COMPANY_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_TYPE->Param, "CustomMsg");
        $this->Fields['COMPANY_TYPE'] = &$this->COMPANY_TYPE;

        // COMPANY
        $this->COMPANY = new DbField('INVOICE', 'INVOICE', 'x_COMPANY', 'COMPANY', '[COMPANY]', '[COMPANY]', 200, 200, -1, false, '[COMPANY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY->Sortable = true; // Allow sort
        $this->COMPANY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY->Param, "CustomMsg");
        $this->Fields['COMPANY'] = &$this->COMPANY;

        // COMPANY_CHIEF
        $this->COMPANY_CHIEF = new DbField('INVOICE', 'INVOICE', 'x_COMPANY_CHIEF', 'COMPANY_CHIEF', '[COMPANY_CHIEF]', '[COMPANY_CHIEF]', 200, 200, -1, false, '[COMPANY_CHIEF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_CHIEF->Sortable = true; // Allow sort
        $this->COMPANY_CHIEF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_CHIEF->Param, "CustomMsg");
        $this->Fields['COMPANY_CHIEF'] = &$this->COMPANY_CHIEF;

        // COMPANY_INFO
        $this->COMPANY_INFO = new DbField('INVOICE', 'INVOICE', 'x_COMPANY_INFO', 'COMPANY_INFO', '[COMPANY_INFO]', '[COMPANY_INFO]', 200, 200, -1, false, '[COMPANY_INFO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_INFO->Sortable = true; // Allow sort
        $this->COMPANY_INFO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_INFO->Param, "CustomMsg");
        $this->Fields['COMPANY_INFO'] = &$this->COMPANY_INFO;

        // CONTRACT_NO
        $this->CONTRACT_NO = new DbField('INVOICE', 'INVOICE', 'x_CONTRACT_NO', 'CONTRACT_NO', '[CONTRACT_NO]', '[CONTRACT_NO]', 200, 200, -1, false, '[CONTRACT_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRACT_NO->Sortable = true; // Allow sort
        $this->CONTRACT_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRACT_NO->Param, "CustomMsg");
        $this->Fields['CONTRACT_NO'] = &$this->CONTRACT_NO;

        // NPWP
        $this->NPWP = new DbField('INVOICE', 'INVOICE', 'x_NPWP', 'NPWP', '[NPWP]', '[NPWP]', 200, 50, -1, false, '[NPWP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPWP->Sortable = true; // Allow sort
        $this->NPWP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPWP->Param, "CustomMsg");
        $this->Fields['NPWP'] = &$this->NPWP;

        // COMPANY_BANK
        $this->COMPANY_BANK = new DbField('INVOICE', 'INVOICE', 'x_COMPANY_BANK', 'COMPANY_BANK', '[COMPANY_BANK]', '[COMPANY_BANK]', 200, 50, -1, false, '[COMPANY_BANK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_BANK->Sortable = true; // Allow sort
        $this->COMPANY_BANK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_BANK->Param, "CustomMsg");
        $this->Fields['COMPANY_BANK'] = &$this->COMPANY_BANK;

        // COMPANY_ACCOUNT
        $this->COMPANY_ACCOUNT = new DbField('INVOICE', 'INVOICE', 'x_COMPANY_ACCOUNT', 'COMPANY_ACCOUNT', '[COMPANY_ACCOUNT]', '[COMPANY_ACCOUNT]', 200, 50, -1, false, '[COMPANY_ACCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ACCOUNT->Sortable = true; // Allow sort
        $this->COMPANY_ACCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ACCOUNT->Param, "CustomMsg");
        $this->Fields['COMPANY_ACCOUNT'] = &$this->COMPANY_ACCOUNT;

        // PAGU
        $this->PAGU = new DbField('INVOICE', 'INVOICE', 'x_PAGU', 'PAGU', '[PAGU]', 'CAST([PAGU] AS NVARCHAR)', 6, 8, -1, false, '[PAGU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAGU->Sortable = true; // Allow sort
        $this->PAGU->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PAGU->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PAGU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAGU->Param, "CustomMsg");
        $this->Fields['PAGU'] = &$this->PAGU;

        // PAGU_REALISASI
        $this->PAGU_REALISASI = new DbField('INVOICE', 'INVOICE', 'x_PAGU_REALISASI', 'PAGU_REALISASI', '[PAGU_REALISASI]', 'CAST([PAGU_REALISASI] AS NVARCHAR)', 6, 8, -1, false, '[PAGU_REALISASI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAGU_REALISASI->Sortable = true; // Allow sort
        $this->PAGU_REALISASI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PAGU_REALISASI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PAGU_REALISASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAGU_REALISASI->Param, "CustomMsg");
        $this->Fields['PAGU_REALISASI'] = &$this->PAGU_REALISASI;

        // AMOUNT
        $this->AMOUNT = new DbField('INVOICE', 'INVOICE', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = true; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // AMOUNT_PAID
        $this->AMOUNT_PAID = new DbField('INVOICE', 'INVOICE', 'x_AMOUNT_PAID', 'AMOUNT_PAID', '[AMOUNT_PAID]', 'CAST([AMOUNT_PAID] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_PAID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PAID->Sortable = true; // Allow sort
        $this->AMOUNT_PAID->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_PAID->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_PAID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PAID->Param, "CustomMsg");
        $this->Fields['AMOUNT_PAID'] = &$this->AMOUNT_PAID;

        // PAYMENT_INSTRUCTIONS
        $this->PAYMENT_INSTRUCTIONS = new DbField('INVOICE', 'INVOICE', 'x_PAYMENT_INSTRUCTIONS', 'PAYMENT_INSTRUCTIONS', '[PAYMENT_INSTRUCTIONS]', '[PAYMENT_INSTRUCTIONS]', 200, 255, -1, false, '[PAYMENT_INSTRUCTIONS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYMENT_INSTRUCTIONS->Sortable = true; // Allow sort
        $this->PAYMENT_INSTRUCTIONS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYMENT_INSTRUCTIONS->Param, "CustomMsg");
        $this->Fields['PAYMENT_INSTRUCTIONS'] = &$this->PAYMENT_INSTRUCTIONS;

        // ISAPPROVED
        $this->ISAPPROVED = new DbField('INVOICE', 'INVOICE', 'x_ISAPPROVED', 'ISAPPROVED', '[ISAPPROVED]', '[ISAPPROVED]', 129, 1, -1, false, '[ISAPPROVED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISAPPROVED->Sortable = true; // Allow sort
        $this->ISAPPROVED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISAPPROVED->Param, "CustomMsg");
        $this->Fields['ISAPPROVED'] = &$this->ISAPPROVED;

        // APPROVED_BY
        $this->APPROVED_BY = new DbField('INVOICE', 'INVOICE', 'x_APPROVED_BY', 'APPROVED_BY', '[APPROVED_BY]', '[APPROVED_BY]', 200, 50, -1, false, '[APPROVED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_BY->Sortable = true; // Allow sort
        $this->APPROVED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_BY->Param, "CustomMsg");
        $this->Fields['APPROVED_BY'] = &$this->APPROVED_BY;

        // APPROVED_DATE
        $this->APPROVED_DATE = new DbField('INVOICE', 'INVOICE', 'x_APPROVED_DATE', 'APPROVED_DATE', '[APPROVED_DATE]', CastDateFieldForLike("[APPROVED_DATE]", 0, "DB"), 135, 8, 0, false, '[APPROVED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_DATE->Sortable = true; // Allow sort
        $this->APPROVED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->APPROVED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_DATE->Param, "CustomMsg");
        $this->Fields['APPROVED_DATE'] = &$this->APPROVED_DATE;

        // ISCETAK
        $this->ISCETAK = new DbField('INVOICE', 'INVOICE', 'x_ISCETAK', 'ISCETAK', '[ISCETAK]', '[ISCETAK]', 129, 1, -1, false, '[ISCETAK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISCETAK->Sortable = true; // Allow sort
        $this->ISCETAK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISCETAK->Param, "CustomMsg");
        $this->Fields['ISCETAK'] = &$this->ISCETAK;

        // PRINTQ
        $this->PRINTQ = new DbField('INVOICE', 'INVOICE', 'x_PRINTQ', 'PRINTQ', '[PRINTQ]', 'CAST([PRINTQ] AS NVARCHAR)', 2, 2, -1, false, '[PRINTQ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTQ->Sortable = true; // Allow sort
        $this->PRINTQ->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PRINTQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTQ->Param, "CustomMsg");
        $this->Fields['PRINTQ'] = &$this->PRINTQ;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('INVOICE', 'INVOICE', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = true; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // PRINTED_BY
        $this->PRINTED_BY = new DbField('INVOICE', 'INVOICE', 'x_PRINTED_BY', 'PRINTED_BY', '[PRINTED_BY]', '[PRINTED_BY]', 200, 50, -1, false, '[PRINTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTED_BY->Sortable = true; // Allow sort
        $this->PRINTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTED_BY->Param, "CustomMsg");
        $this->Fields['PRINTED_BY'] = &$this->PRINTED_BY;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('INVOICE', 'INVOICE', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('INVOICE', 'INVOICE', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // PPTK_TITLE
        $this->PPTK_TITLE = new DbField('INVOICE', 'INVOICE', 'x_PPTK_TITLE', 'PPTK_TITLE', '[PPTK_TITLE]', '[PPTK_TITLE]', 200, 50, -1, false, '[PPTK_TITLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPTK_TITLE->Sortable = true; // Allow sort
        $this->PPTK_TITLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPTK_TITLE->Param, "CustomMsg");
        $this->Fields['PPTK_TITLE'] = &$this->PPTK_TITLE;

        // APPROVED_ID
        $this->APPROVED_ID = new DbField('INVOICE', 'INVOICE', 'x_APPROVED_ID', 'APPROVED_ID', '[APPROVED_ID]', '[APPROVED_ID]', 200, 50, -1, false, '[APPROVED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_ID->Sortable = true; // Allow sort
        $this->APPROVED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_ID->Param, "CustomMsg");
        $this->Fields['APPROVED_ID'] = &$this->APPROVED_ID;

        // APPROVED_TITLE
        $this->APPROVED_TITLE = new DbField('INVOICE', 'INVOICE', 'x_APPROVED_TITLE', 'APPROVED_TITLE', '[APPROVED_TITLE]', '[APPROVED_TITLE]', 200, 50, -1, false, '[APPROVED_TITLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_TITLE->Sortable = true; // Allow sort
        $this->APPROVED_TITLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_TITLE->Param, "CustomMsg");
        $this->Fields['APPROVED_TITLE'] = &$this->APPROVED_TITLE;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[INVOICE]";
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
            if (array_key_exists('INVOICE_ID', $rs)) {
                AddFilter($where, QuotedName('INVOICE_ID', $this->Dbid) . '=' . QuotedValue($rs['INVOICE_ID'], $this->INVOICE_ID->DataType, $this->Dbid));
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
        $this->INVOICE_ID->DbValue = $row['INVOICE_ID'];
        $this->INVOICE_TYPE->DbValue = $row['INVOICE_TYPE'];
        $this->INVOICE_NO->DbValue = $row['INVOICE_NO'];
        $this->INV_COUNTER->DbValue = $row['INV_COUNTER'];
        $this->INV_DATE->DbValue = $row['INV_DATE'];
        $this->INVOICE_TRANS->DbValue = $row['INVOICE_TRANS'];
        $this->INVOICE_DUE->DbValue = $row['INVOICE_DUE'];
        $this->REF_TYPE->DbValue = $row['REF_TYPE'];
        $this->REF_NO->DbValue = $row['REF_NO'];
        $this->REF_NO2->DbValue = $row['REF_NO2'];
        $this->REF_DATE->DbValue = $row['REF_DATE'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->PROGRAM_ID->DbValue = $row['PROGRAM_ID'];
        $this->PROGRAMS->DbValue = $row['PROGRAMS'];
        $this->PACTIVITY_ID->DbValue = $row['PACTIVITY_ID'];
        $this->ACTIVITY_ID->DbValue = $row['ACTIVITY_ID'];
        $this->ACTIVITY_NAME->DbValue = $row['ACTIVITY_NAME'];
        $this->KEPERLUAN->DbValue = $row['KEPERLUAN'];
        $this->PPTK->DbValue = $row['PPTK'];
        $this->PPTK_NAME->DbValue = $row['PPTK_NAME'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->COMPANY_TO->DbValue = $row['COMPANY_TO'];
        $this->COMPANY_TYPE->DbValue = $row['COMPANY_TYPE'];
        $this->COMPANY->DbValue = $row['COMPANY'];
        $this->COMPANY_CHIEF->DbValue = $row['COMPANY_CHIEF'];
        $this->COMPANY_INFO->DbValue = $row['COMPANY_INFO'];
        $this->CONTRACT_NO->DbValue = $row['CONTRACT_NO'];
        $this->NPWP->DbValue = $row['NPWP'];
        $this->COMPANY_BANK->DbValue = $row['COMPANY_BANK'];
        $this->COMPANY_ACCOUNT->DbValue = $row['COMPANY_ACCOUNT'];
        $this->PAGU->DbValue = $row['PAGU'];
        $this->PAGU_REALISASI->DbValue = $row['PAGU_REALISASI'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->AMOUNT_PAID->DbValue = $row['AMOUNT_PAID'];
        $this->PAYMENT_INSTRUCTIONS->DbValue = $row['PAYMENT_INSTRUCTIONS'];
        $this->ISAPPROVED->DbValue = $row['ISAPPROVED'];
        $this->APPROVED_BY->DbValue = $row['APPROVED_BY'];
        $this->APPROVED_DATE->DbValue = $row['APPROVED_DATE'];
        $this->ISCETAK->DbValue = $row['ISCETAK'];
        $this->PRINTQ->DbValue = $row['PRINTQ'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->PRINTED_BY->DbValue = $row['PRINTED_BY'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->PPTK_TITLE->DbValue = $row['PPTK_TITLE'];
        $this->APPROVED_ID->DbValue = $row['APPROVED_ID'];
        $this->APPROVED_TITLE->DbValue = $row['APPROVED_TITLE'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [INVOICE_ID] = '@INVOICE_ID@'";
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
        $val = $current ? $this->INVOICE_ID->CurrentValue : $this->INVOICE_ID->OldValue;
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
                $this->INVOICE_ID->CurrentValue = $keys[1];
            } else {
                $this->INVOICE_ID->OldValue = $keys[1];
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
            $val = array_key_exists('INVOICE_ID', $row) ? $row['INVOICE_ID'] : null;
        } else {
            $val = $this->INVOICE_ID->OldValue !== null ? $this->INVOICE_ID->OldValue : $this->INVOICE_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@INVOICE_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("InvoiceList");
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
        if ($pageName == "InvoiceView") {
            return $Language->phrase("View");
        } elseif ($pageName == "InvoiceEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "InvoiceAdd") {
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
                return "InvoiceView";
            case Config("API_ADD_ACTION"):
                return "InvoiceAdd";
            case Config("API_EDIT_ACTION"):
                return "InvoiceEdit";
            case Config("API_DELETE_ACTION"):
                return "InvoiceDelete";
            case Config("API_LIST_ACTION"):
                return "InvoiceList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "InvoiceList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("InvoiceView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("InvoiceView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "InvoiceAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "InvoiceAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("InvoiceEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("InvoiceAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("InvoiceDelete", $this->getUrlParm());
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
        $json .= ",INVOICE_ID:" . JsonEncode($this->INVOICE_ID->CurrentValue, "string");
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
        if ($this->INVOICE_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->INVOICE_ID->CurrentValue);
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
            if (($keyValue = Param("INVOICE_ID") ?? Route("INVOICE_ID")) !== null) {
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
                $this->INVOICE_ID->CurrentValue = $key[1];
            } else {
                $this->INVOICE_ID->OldValue = $key[1];
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
        $this->INVOICE_ID->setDbValue($row['INVOICE_ID']);
        $this->INVOICE_TYPE->setDbValue($row['INVOICE_TYPE']);
        $this->INVOICE_NO->setDbValue($row['INVOICE_NO']);
        $this->INV_COUNTER->setDbValue($row['INV_COUNTER']);
        $this->INV_DATE->setDbValue($row['INV_DATE']);
        $this->INVOICE_TRANS->setDbValue($row['INVOICE_TRANS']);
        $this->INVOICE_DUE->setDbValue($row['INVOICE_DUE']);
        $this->REF_TYPE->setDbValue($row['REF_TYPE']);
        $this->REF_NO->setDbValue($row['REF_NO']);
        $this->REF_NO2->setDbValue($row['REF_NO2']);
        $this->REF_DATE->setDbValue($row['REF_DATE']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->PROGRAM_ID->setDbValue($row['PROGRAM_ID']);
        $this->PROGRAMS->setDbValue($row['PROGRAMS']);
        $this->PACTIVITY_ID->setDbValue($row['PACTIVITY_ID']);
        $this->ACTIVITY_ID->setDbValue($row['ACTIVITY_ID']);
        $this->ACTIVITY_NAME->setDbValue($row['ACTIVITY_NAME']);
        $this->KEPERLUAN->setDbValue($row['KEPERLUAN']);
        $this->PPTK->setDbValue($row['PPTK']);
        $this->PPTK_NAME->setDbValue($row['PPTK_NAME']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->COMPANY_TO->setDbValue($row['COMPANY_TO']);
        $this->COMPANY_TYPE->setDbValue($row['COMPANY_TYPE']);
        $this->COMPANY->setDbValue($row['COMPANY']);
        $this->COMPANY_CHIEF->setDbValue($row['COMPANY_CHIEF']);
        $this->COMPANY_INFO->setDbValue($row['COMPANY_INFO']);
        $this->CONTRACT_NO->setDbValue($row['CONTRACT_NO']);
        $this->NPWP->setDbValue($row['NPWP']);
        $this->COMPANY_BANK->setDbValue($row['COMPANY_BANK']);
        $this->COMPANY_ACCOUNT->setDbValue($row['COMPANY_ACCOUNT']);
        $this->PAGU->setDbValue($row['PAGU']);
        $this->PAGU_REALISASI->setDbValue($row['PAGU_REALISASI']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
        $this->PAYMENT_INSTRUCTIONS->setDbValue($row['PAYMENT_INSTRUCTIONS']);
        $this->ISAPPROVED->setDbValue($row['ISAPPROVED']);
        $this->APPROVED_BY->setDbValue($row['APPROVED_BY']);
        $this->APPROVED_DATE->setDbValue($row['APPROVED_DATE']);
        $this->ISCETAK->setDbValue($row['ISCETAK']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->PPTK_TITLE->setDbValue($row['PPTK_TITLE']);
        $this->APPROVED_ID->setDbValue($row['APPROVED_ID']);
        $this->APPROVED_TITLE->setDbValue($row['APPROVED_TITLE']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // INVOICE_ID

        // INVOICE_TYPE

        // INVOICE_NO

        // INV_COUNTER

        // INV_DATE

        // INVOICE_TRANS

        // INVOICE_DUE

        // REF_TYPE

        // REF_NO

        // REF_NO2

        // REF_DATE

        // ACCOUNT_ID

        // YEAR_ID

        // ORG_ID

        // PROGRAM_ID

        // PROGRAMS

        // PACTIVITY_ID

        // ACTIVITY_ID

        // ACTIVITY_NAME

        // KEPERLUAN

        // PPTK

        // PPTK_NAME

        // COMPANY_ID

        // COMPANY_TO

        // COMPANY_TYPE

        // COMPANY

        // COMPANY_CHIEF

        // COMPANY_INFO

        // CONTRACT_NO

        // NPWP

        // COMPANY_BANK

        // COMPANY_ACCOUNT

        // PAGU

        // PAGU_REALISASI

        // AMOUNT

        // AMOUNT_PAID

        // PAYMENT_INSTRUCTIONS

        // ISAPPROVED

        // APPROVED_BY

        // APPROVED_DATE

        // ISCETAK

        // PRINTQ

        // PRINT_DATE

        // PRINTED_BY

        // MODIFIED_DATE

        // MODIFIED_BY

        // PPTK_TITLE

        // APPROVED_ID

        // APPROVED_TITLE

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // INVOICE_ID
        $this->INVOICE_ID->ViewValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->ViewCustomAttributes = "";

        // INVOICE_TYPE
        $this->INVOICE_TYPE->ViewValue = $this->INVOICE_TYPE->CurrentValue;
        $this->INVOICE_TYPE->ViewValue = FormatNumber($this->INVOICE_TYPE->ViewValue, 0, -2, -2, -2);
        $this->INVOICE_TYPE->ViewCustomAttributes = "";

        // INVOICE_NO
        $this->INVOICE_NO->ViewValue = $this->INVOICE_NO->CurrentValue;
        $this->INVOICE_NO->ViewCustomAttributes = "";

        // INV_COUNTER
        $this->INV_COUNTER->ViewValue = $this->INV_COUNTER->CurrentValue;
        $this->INV_COUNTER->ViewValue = FormatNumber($this->INV_COUNTER->ViewValue, 0, -2, -2, -2);
        $this->INV_COUNTER->ViewCustomAttributes = "";

        // INV_DATE
        $this->INV_DATE->ViewValue = $this->INV_DATE->CurrentValue;
        $this->INV_DATE->ViewValue = FormatDateTime($this->INV_DATE->ViewValue, 0);
        $this->INV_DATE->ViewCustomAttributes = "";

        // INVOICE_TRANS
        $this->INVOICE_TRANS->ViewValue = $this->INVOICE_TRANS->CurrentValue;
        $this->INVOICE_TRANS->ViewValue = FormatDateTime($this->INVOICE_TRANS->ViewValue, 0);
        $this->INVOICE_TRANS->ViewCustomAttributes = "";

        // INVOICE_DUE
        $this->INVOICE_DUE->ViewValue = $this->INVOICE_DUE->CurrentValue;
        $this->INVOICE_DUE->ViewValue = FormatDateTime($this->INVOICE_DUE->ViewValue, 0);
        $this->INVOICE_DUE->ViewCustomAttributes = "";

        // REF_TYPE
        $this->REF_TYPE->ViewValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->ViewValue = FormatNumber($this->REF_TYPE->ViewValue, 0, -2, -2, -2);
        $this->REF_TYPE->ViewCustomAttributes = "";

        // REF_NO
        $this->REF_NO->ViewValue = $this->REF_NO->CurrentValue;
        $this->REF_NO->ViewCustomAttributes = "";

        // REF_NO2
        $this->REF_NO2->ViewValue = $this->REF_NO2->CurrentValue;
        $this->REF_NO2->ViewCustomAttributes = "";

        // REF_DATE
        $this->REF_DATE->ViewValue = $this->REF_DATE->CurrentValue;
        $this->REF_DATE->ViewValue = FormatDateTime($this->REF_DATE->ViewValue, 0);
        $this->REF_DATE->ViewCustomAttributes = "";

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

        // PACTIVITY_ID
        $this->PACTIVITY_ID->ViewValue = $this->PACTIVITY_ID->CurrentValue;
        $this->PACTIVITY_ID->ViewCustomAttributes = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->ViewCustomAttributes = "";

        // ACTIVITY_NAME
        $this->ACTIVITY_NAME->ViewValue = $this->ACTIVITY_NAME->CurrentValue;
        $this->ACTIVITY_NAME->ViewCustomAttributes = "";

        // KEPERLUAN
        $this->KEPERLUAN->ViewValue = $this->KEPERLUAN->CurrentValue;
        $this->KEPERLUAN->ViewCustomAttributes = "";

        // PPTK
        $this->PPTK->ViewValue = $this->PPTK->CurrentValue;
        $this->PPTK->ViewCustomAttributes = "";

        // PPTK_NAME
        $this->PPTK_NAME->ViewValue = $this->PPTK_NAME->CurrentValue;
        $this->PPTK_NAME->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // COMPANY_TO
        $this->COMPANY_TO->ViewValue = $this->COMPANY_TO->CurrentValue;
        $this->COMPANY_TO->ViewCustomAttributes = "";

        // COMPANY_TYPE
        $this->COMPANY_TYPE->ViewValue = $this->COMPANY_TYPE->CurrentValue;
        $this->COMPANY_TYPE->ViewCustomAttributes = "";

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

        // PAGU
        $this->PAGU->ViewValue = $this->PAGU->CurrentValue;
        $this->PAGU->ViewValue = FormatNumber($this->PAGU->ViewValue, 2, -2, -2, -2);
        $this->PAGU->ViewCustomAttributes = "";

        // PAGU_REALISASI
        $this->PAGU_REALISASI->ViewValue = $this->PAGU_REALISASI->CurrentValue;
        $this->PAGU_REALISASI->ViewValue = FormatNumber($this->PAGU_REALISASI->ViewValue, 2, -2, -2, -2);
        $this->PAGU_REALISASI->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->ViewValue = FormatNumber($this->AMOUNT_PAID->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_PAID->ViewCustomAttributes = "";

        // PAYMENT_INSTRUCTIONS
        $this->PAYMENT_INSTRUCTIONS->ViewValue = $this->PAYMENT_INSTRUCTIONS->CurrentValue;
        $this->PAYMENT_INSTRUCTIONS->ViewCustomAttributes = "";

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

        // PPTK_TITLE
        $this->PPTK_TITLE->ViewValue = $this->PPTK_TITLE->CurrentValue;
        $this->PPTK_TITLE->ViewCustomAttributes = "";

        // APPROVED_ID
        $this->APPROVED_ID->ViewValue = $this->APPROVED_ID->CurrentValue;
        $this->APPROVED_ID->ViewCustomAttributes = "";

        // APPROVED_TITLE
        $this->APPROVED_TITLE->ViewValue = $this->APPROVED_TITLE->CurrentValue;
        $this->APPROVED_TITLE->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // INVOICE_ID
        $this->INVOICE_ID->LinkCustomAttributes = "";
        $this->INVOICE_ID->HrefValue = "";
        $this->INVOICE_ID->TooltipValue = "";

        // INVOICE_TYPE
        $this->INVOICE_TYPE->LinkCustomAttributes = "";
        $this->INVOICE_TYPE->HrefValue = "";
        $this->INVOICE_TYPE->TooltipValue = "";

        // INVOICE_NO
        $this->INVOICE_NO->LinkCustomAttributes = "";
        $this->INVOICE_NO->HrefValue = "";
        $this->INVOICE_NO->TooltipValue = "";

        // INV_COUNTER
        $this->INV_COUNTER->LinkCustomAttributes = "";
        $this->INV_COUNTER->HrefValue = "";
        $this->INV_COUNTER->TooltipValue = "";

        // INV_DATE
        $this->INV_DATE->LinkCustomAttributes = "";
        $this->INV_DATE->HrefValue = "";
        $this->INV_DATE->TooltipValue = "";

        // INVOICE_TRANS
        $this->INVOICE_TRANS->LinkCustomAttributes = "";
        $this->INVOICE_TRANS->HrefValue = "";
        $this->INVOICE_TRANS->TooltipValue = "";

        // INVOICE_DUE
        $this->INVOICE_DUE->LinkCustomAttributes = "";
        $this->INVOICE_DUE->HrefValue = "";
        $this->INVOICE_DUE->TooltipValue = "";

        // REF_TYPE
        $this->REF_TYPE->LinkCustomAttributes = "";
        $this->REF_TYPE->HrefValue = "";
        $this->REF_TYPE->TooltipValue = "";

        // REF_NO
        $this->REF_NO->LinkCustomAttributes = "";
        $this->REF_NO->HrefValue = "";
        $this->REF_NO->TooltipValue = "";

        // REF_NO2
        $this->REF_NO2->LinkCustomAttributes = "";
        $this->REF_NO2->HrefValue = "";
        $this->REF_NO2->TooltipValue = "";

        // REF_DATE
        $this->REF_DATE->LinkCustomAttributes = "";
        $this->REF_DATE->HrefValue = "";
        $this->REF_DATE->TooltipValue = "";

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

        // PACTIVITY_ID
        $this->PACTIVITY_ID->LinkCustomAttributes = "";
        $this->PACTIVITY_ID->HrefValue = "";
        $this->PACTIVITY_ID->TooltipValue = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->LinkCustomAttributes = "";
        $this->ACTIVITY_ID->HrefValue = "";
        $this->ACTIVITY_ID->TooltipValue = "";

        // ACTIVITY_NAME
        $this->ACTIVITY_NAME->LinkCustomAttributes = "";
        $this->ACTIVITY_NAME->HrefValue = "";
        $this->ACTIVITY_NAME->TooltipValue = "";

        // KEPERLUAN
        $this->KEPERLUAN->LinkCustomAttributes = "";
        $this->KEPERLUAN->HrefValue = "";
        $this->KEPERLUAN->TooltipValue = "";

        // PPTK
        $this->PPTK->LinkCustomAttributes = "";
        $this->PPTK->HrefValue = "";
        $this->PPTK->TooltipValue = "";

        // PPTK_NAME
        $this->PPTK_NAME->LinkCustomAttributes = "";
        $this->PPTK_NAME->HrefValue = "";
        $this->PPTK_NAME->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // COMPANY_TO
        $this->COMPANY_TO->LinkCustomAttributes = "";
        $this->COMPANY_TO->HrefValue = "";
        $this->COMPANY_TO->TooltipValue = "";

        // COMPANY_TYPE
        $this->COMPANY_TYPE->LinkCustomAttributes = "";
        $this->COMPANY_TYPE->HrefValue = "";
        $this->COMPANY_TYPE->TooltipValue = "";

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

        // PAGU
        $this->PAGU->LinkCustomAttributes = "";
        $this->PAGU->HrefValue = "";
        $this->PAGU->TooltipValue = "";

        // PAGU_REALISASI
        $this->PAGU_REALISASI->LinkCustomAttributes = "";
        $this->PAGU_REALISASI->HrefValue = "";
        $this->PAGU_REALISASI->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->LinkCustomAttributes = "";
        $this->AMOUNT_PAID->HrefValue = "";
        $this->AMOUNT_PAID->TooltipValue = "";

        // PAYMENT_INSTRUCTIONS
        $this->PAYMENT_INSTRUCTIONS->LinkCustomAttributes = "";
        $this->PAYMENT_INSTRUCTIONS->HrefValue = "";
        $this->PAYMENT_INSTRUCTIONS->TooltipValue = "";

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

        // PPTK_TITLE
        $this->PPTK_TITLE->LinkCustomAttributes = "";
        $this->PPTK_TITLE->HrefValue = "";
        $this->PPTK_TITLE->TooltipValue = "";

        // APPROVED_ID
        $this->APPROVED_ID->LinkCustomAttributes = "";
        $this->APPROVED_ID->HrefValue = "";
        $this->APPROVED_ID->TooltipValue = "";

        // APPROVED_TITLE
        $this->APPROVED_TITLE->LinkCustomAttributes = "";
        $this->APPROVED_TITLE->HrefValue = "";
        $this->APPROVED_TITLE->TooltipValue = "";

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

        // INVOICE_ID
        $this->INVOICE_ID->EditAttrs["class"] = "form-control";
        $this->INVOICE_ID->EditCustomAttributes = "";
        if (!$this->INVOICE_ID->Raw) {
            $this->INVOICE_ID->CurrentValue = HtmlDecode($this->INVOICE_ID->CurrentValue);
        }
        $this->INVOICE_ID->EditValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->PlaceHolder = RemoveHtml($this->INVOICE_ID->caption());

        // INVOICE_TYPE
        $this->INVOICE_TYPE->EditAttrs["class"] = "form-control";
        $this->INVOICE_TYPE->EditCustomAttributes = "";
        $this->INVOICE_TYPE->EditValue = $this->INVOICE_TYPE->CurrentValue;
        $this->INVOICE_TYPE->PlaceHolder = RemoveHtml($this->INVOICE_TYPE->caption());

        // INVOICE_NO
        $this->INVOICE_NO->EditAttrs["class"] = "form-control";
        $this->INVOICE_NO->EditCustomAttributes = "";
        if (!$this->INVOICE_NO->Raw) {
            $this->INVOICE_NO->CurrentValue = HtmlDecode($this->INVOICE_NO->CurrentValue);
        }
        $this->INVOICE_NO->EditValue = $this->INVOICE_NO->CurrentValue;
        $this->INVOICE_NO->PlaceHolder = RemoveHtml($this->INVOICE_NO->caption());

        // INV_COUNTER
        $this->INV_COUNTER->EditAttrs["class"] = "form-control";
        $this->INV_COUNTER->EditCustomAttributes = "";
        $this->INV_COUNTER->EditValue = $this->INV_COUNTER->CurrentValue;
        $this->INV_COUNTER->PlaceHolder = RemoveHtml($this->INV_COUNTER->caption());

        // INV_DATE
        $this->INV_DATE->EditAttrs["class"] = "form-control";
        $this->INV_DATE->EditCustomAttributes = "";
        $this->INV_DATE->EditValue = FormatDateTime($this->INV_DATE->CurrentValue, 8);
        $this->INV_DATE->PlaceHolder = RemoveHtml($this->INV_DATE->caption());

        // INVOICE_TRANS
        $this->INVOICE_TRANS->EditAttrs["class"] = "form-control";
        $this->INVOICE_TRANS->EditCustomAttributes = "";
        $this->INVOICE_TRANS->EditValue = FormatDateTime($this->INVOICE_TRANS->CurrentValue, 8);
        $this->INVOICE_TRANS->PlaceHolder = RemoveHtml($this->INVOICE_TRANS->caption());

        // INVOICE_DUE
        $this->INVOICE_DUE->EditAttrs["class"] = "form-control";
        $this->INVOICE_DUE->EditCustomAttributes = "";
        $this->INVOICE_DUE->EditValue = FormatDateTime($this->INVOICE_DUE->CurrentValue, 8);
        $this->INVOICE_DUE->PlaceHolder = RemoveHtml($this->INVOICE_DUE->caption());

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

        // REF_NO2
        $this->REF_NO2->EditAttrs["class"] = "form-control";
        $this->REF_NO2->EditCustomAttributes = "";
        if (!$this->REF_NO2->Raw) {
            $this->REF_NO2->CurrentValue = HtmlDecode($this->REF_NO2->CurrentValue);
        }
        $this->REF_NO2->EditValue = $this->REF_NO2->CurrentValue;
        $this->REF_NO2->PlaceHolder = RemoveHtml($this->REF_NO2->caption());

        // REF_DATE
        $this->REF_DATE->EditAttrs["class"] = "form-control";
        $this->REF_DATE->EditCustomAttributes = "";
        $this->REF_DATE->EditValue = FormatDateTime($this->REF_DATE->CurrentValue, 8);
        $this->REF_DATE->PlaceHolder = RemoveHtml($this->REF_DATE->caption());

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

        // PACTIVITY_ID
        $this->PACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->PACTIVITY_ID->EditCustomAttributes = "";
        if (!$this->PACTIVITY_ID->Raw) {
            $this->PACTIVITY_ID->CurrentValue = HtmlDecode($this->PACTIVITY_ID->CurrentValue);
        }
        $this->PACTIVITY_ID->EditValue = $this->PACTIVITY_ID->CurrentValue;
        $this->PACTIVITY_ID->PlaceHolder = RemoveHtml($this->PACTIVITY_ID->caption());

        // ACTIVITY_ID
        $this->ACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->ACTIVITY_ID->EditCustomAttributes = "";
        if (!$this->ACTIVITY_ID->Raw) {
            $this->ACTIVITY_ID->CurrentValue = HtmlDecode($this->ACTIVITY_ID->CurrentValue);
        }
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

        // KEPERLUAN
        $this->KEPERLUAN->EditAttrs["class"] = "form-control";
        $this->KEPERLUAN->EditCustomAttributes = "";
        if (!$this->KEPERLUAN->Raw) {
            $this->KEPERLUAN->CurrentValue = HtmlDecode($this->KEPERLUAN->CurrentValue);
        }
        $this->KEPERLUAN->EditValue = $this->KEPERLUAN->CurrentValue;
        $this->KEPERLUAN->PlaceHolder = RemoveHtml($this->KEPERLUAN->caption());

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

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // COMPANY_TO
        $this->COMPANY_TO->EditAttrs["class"] = "form-control";
        $this->COMPANY_TO->EditCustomAttributes = "";
        if (!$this->COMPANY_TO->Raw) {
            $this->COMPANY_TO->CurrentValue = HtmlDecode($this->COMPANY_TO->CurrentValue);
        }
        $this->COMPANY_TO->EditValue = $this->COMPANY_TO->CurrentValue;
        $this->COMPANY_TO->PlaceHolder = RemoveHtml($this->COMPANY_TO->caption());

        // COMPANY_TYPE
        $this->COMPANY_TYPE->EditAttrs["class"] = "form-control";
        $this->COMPANY_TYPE->EditCustomAttributes = "";
        if (!$this->COMPANY_TYPE->Raw) {
            $this->COMPANY_TYPE->CurrentValue = HtmlDecode($this->COMPANY_TYPE->CurrentValue);
        }
        $this->COMPANY_TYPE->EditValue = $this->COMPANY_TYPE->CurrentValue;
        $this->COMPANY_TYPE->PlaceHolder = RemoveHtml($this->COMPANY_TYPE->caption());

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

        // AMOUNT
        $this->AMOUNT->EditAttrs["class"] = "form-control";
        $this->AMOUNT->EditCustomAttributes = "";
        $this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
        if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue)) {
            $this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // AMOUNT_PAID
        $this->AMOUNT_PAID->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PAID->EditCustomAttributes = "";
        $this->AMOUNT_PAID->EditValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->PlaceHolder = RemoveHtml($this->AMOUNT_PAID->caption());
        if (strval($this->AMOUNT_PAID->EditValue) != "" && is_numeric($this->AMOUNT_PAID->EditValue)) {
            $this->AMOUNT_PAID->EditValue = FormatNumber($this->AMOUNT_PAID->EditValue, -2, -2, -2, -2);
        }

        // PAYMENT_INSTRUCTIONS
        $this->PAYMENT_INSTRUCTIONS->EditAttrs["class"] = "form-control";
        $this->PAYMENT_INSTRUCTIONS->EditCustomAttributes = "";
        if (!$this->PAYMENT_INSTRUCTIONS->Raw) {
            $this->PAYMENT_INSTRUCTIONS->CurrentValue = HtmlDecode($this->PAYMENT_INSTRUCTIONS->CurrentValue);
        }
        $this->PAYMENT_INSTRUCTIONS->EditValue = $this->PAYMENT_INSTRUCTIONS->CurrentValue;
        $this->PAYMENT_INSTRUCTIONS->PlaceHolder = RemoveHtml($this->PAYMENT_INSTRUCTIONS->caption());

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

        // PPTK_TITLE
        $this->PPTK_TITLE->EditAttrs["class"] = "form-control";
        $this->PPTK_TITLE->EditCustomAttributes = "";
        if (!$this->PPTK_TITLE->Raw) {
            $this->PPTK_TITLE->CurrentValue = HtmlDecode($this->PPTK_TITLE->CurrentValue);
        }
        $this->PPTK_TITLE->EditValue = $this->PPTK_TITLE->CurrentValue;
        $this->PPTK_TITLE->PlaceHolder = RemoveHtml($this->PPTK_TITLE->caption());

        // APPROVED_ID
        $this->APPROVED_ID->EditAttrs["class"] = "form-control";
        $this->APPROVED_ID->EditCustomAttributes = "";
        if (!$this->APPROVED_ID->Raw) {
            $this->APPROVED_ID->CurrentValue = HtmlDecode($this->APPROVED_ID->CurrentValue);
        }
        $this->APPROVED_ID->EditValue = $this->APPROVED_ID->CurrentValue;
        $this->APPROVED_ID->PlaceHolder = RemoveHtml($this->APPROVED_ID->caption());

        // APPROVED_TITLE
        $this->APPROVED_TITLE->EditAttrs["class"] = "form-control";
        $this->APPROVED_TITLE->EditCustomAttributes = "";
        if (!$this->APPROVED_TITLE->Raw) {
            $this->APPROVED_TITLE->CurrentValue = HtmlDecode($this->APPROVED_TITLE->CurrentValue);
        }
        $this->APPROVED_TITLE->EditValue = $this->APPROVED_TITLE->CurrentValue;
        $this->APPROVED_TITLE->PlaceHolder = RemoveHtml($this->APPROVED_TITLE->caption());

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
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->INVOICE_TYPE);
                    $doc->exportCaption($this->INVOICE_NO);
                    $doc->exportCaption($this->INV_COUNTER);
                    $doc->exportCaption($this->INV_DATE);
                    $doc->exportCaption($this->INVOICE_TRANS);
                    $doc->exportCaption($this->INVOICE_DUE);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REF_NO);
                    $doc->exportCaption($this->REF_NO2);
                    $doc->exportCaption($this->REF_DATE);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->PROGRAM_ID);
                    $doc->exportCaption($this->PROGRAMS);
                    $doc->exportCaption($this->PACTIVITY_ID);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->ACTIVITY_NAME);
                    $doc->exportCaption($this->KEPERLUAN);
                    $doc->exportCaption($this->PPTK);
                    $doc->exportCaption($this->PPTK_NAME);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY_TO);
                    $doc->exportCaption($this->COMPANY_TYPE);
                    $doc->exportCaption($this->COMPANY);
                    $doc->exportCaption($this->COMPANY_CHIEF);
                    $doc->exportCaption($this->COMPANY_INFO);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->COMPANY_BANK);
                    $doc->exportCaption($this->COMPANY_ACCOUNT);
                    $doc->exportCaption($this->PAGU);
                    $doc->exportCaption($this->PAGU_REALISASI);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->PAYMENT_INSTRUCTIONS);
                    $doc->exportCaption($this->ISAPPROVED);
                    $doc->exportCaption($this->APPROVED_BY);
                    $doc->exportCaption($this->APPROVED_DATE);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->PPTK_TITLE);
                    $doc->exportCaption($this->APPROVED_ID);
                    $doc->exportCaption($this->APPROVED_TITLE);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->INVOICE_TYPE);
                    $doc->exportCaption($this->INVOICE_NO);
                    $doc->exportCaption($this->INV_COUNTER);
                    $doc->exportCaption($this->INV_DATE);
                    $doc->exportCaption($this->INVOICE_TRANS);
                    $doc->exportCaption($this->INVOICE_DUE);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REF_NO);
                    $doc->exportCaption($this->REF_NO2);
                    $doc->exportCaption($this->REF_DATE);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->PROGRAM_ID);
                    $doc->exportCaption($this->PROGRAMS);
                    $doc->exportCaption($this->PACTIVITY_ID);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->ACTIVITY_NAME);
                    $doc->exportCaption($this->KEPERLUAN);
                    $doc->exportCaption($this->PPTK);
                    $doc->exportCaption($this->PPTK_NAME);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY_TO);
                    $doc->exportCaption($this->COMPANY_TYPE);
                    $doc->exportCaption($this->COMPANY);
                    $doc->exportCaption($this->COMPANY_CHIEF);
                    $doc->exportCaption($this->COMPANY_INFO);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->COMPANY_BANK);
                    $doc->exportCaption($this->COMPANY_ACCOUNT);
                    $doc->exportCaption($this->PAGU);
                    $doc->exportCaption($this->PAGU_REALISASI);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->PAYMENT_INSTRUCTIONS);
                    $doc->exportCaption($this->ISAPPROVED);
                    $doc->exportCaption($this->APPROVED_BY);
                    $doc->exportCaption($this->APPROVED_DATE);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->PPTK_TITLE);
                    $doc->exportCaption($this->APPROVED_ID);
                    $doc->exportCaption($this->APPROVED_TITLE);
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
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->INVOICE_TYPE);
                        $doc->exportField($this->INVOICE_NO);
                        $doc->exportField($this->INV_COUNTER);
                        $doc->exportField($this->INV_DATE);
                        $doc->exportField($this->INVOICE_TRANS);
                        $doc->exportField($this->INVOICE_DUE);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REF_NO);
                        $doc->exportField($this->REF_NO2);
                        $doc->exportField($this->REF_DATE);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->PROGRAM_ID);
                        $doc->exportField($this->PROGRAMS);
                        $doc->exportField($this->PACTIVITY_ID);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->ACTIVITY_NAME);
                        $doc->exportField($this->KEPERLUAN);
                        $doc->exportField($this->PPTK);
                        $doc->exportField($this->PPTK_NAME);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY_TO);
                        $doc->exportField($this->COMPANY_TYPE);
                        $doc->exportField($this->COMPANY);
                        $doc->exportField($this->COMPANY_CHIEF);
                        $doc->exportField($this->COMPANY_INFO);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->COMPANY_BANK);
                        $doc->exportField($this->COMPANY_ACCOUNT);
                        $doc->exportField($this->PAGU);
                        $doc->exportField($this->PAGU_REALISASI);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->PAYMENT_INSTRUCTIONS);
                        $doc->exportField($this->ISAPPROVED);
                        $doc->exportField($this->APPROVED_BY);
                        $doc->exportField($this->APPROVED_DATE);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->PPTK_TITLE);
                        $doc->exportField($this->APPROVED_ID);
                        $doc->exportField($this->APPROVED_TITLE);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->INVOICE_TYPE);
                        $doc->exportField($this->INVOICE_NO);
                        $doc->exportField($this->INV_COUNTER);
                        $doc->exportField($this->INV_DATE);
                        $doc->exportField($this->INVOICE_TRANS);
                        $doc->exportField($this->INVOICE_DUE);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REF_NO);
                        $doc->exportField($this->REF_NO2);
                        $doc->exportField($this->REF_DATE);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->PROGRAM_ID);
                        $doc->exportField($this->PROGRAMS);
                        $doc->exportField($this->PACTIVITY_ID);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->ACTIVITY_NAME);
                        $doc->exportField($this->KEPERLUAN);
                        $doc->exportField($this->PPTK);
                        $doc->exportField($this->PPTK_NAME);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY_TO);
                        $doc->exportField($this->COMPANY_TYPE);
                        $doc->exportField($this->COMPANY);
                        $doc->exportField($this->COMPANY_CHIEF);
                        $doc->exportField($this->COMPANY_INFO);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->COMPANY_BANK);
                        $doc->exportField($this->COMPANY_ACCOUNT);
                        $doc->exportField($this->PAGU);
                        $doc->exportField($this->PAGU_REALISASI);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->PAYMENT_INSTRUCTIONS);
                        $doc->exportField($this->ISAPPROVED);
                        $doc->exportField($this->APPROVED_BY);
                        $doc->exportField($this->APPROVED_DATE);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->PPTK_TITLE);
                        $doc->exportField($this->APPROVED_ID);
                        $doc->exportField($this->APPROVED_TITLE);
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
