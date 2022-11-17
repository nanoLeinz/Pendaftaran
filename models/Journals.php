<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for JOURNALS
 */
class Journals extends DbTable
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
    public $ITEM_ID;
    public $YEAR_ID;
    public $PROGRAM_ID;
    public $PACTIVITY_ID;
    public $COMPANY_ID;
    public $REF_ID;
    public $REF_TYPE;
    public $REF_NO;
    public $REF_DATE;
    public $TREAT_DATE;
    public $ACCOUNT_ID;
    public $ACT;
    public $DESCRIPTION;
    public $FA_V;
    public $AMOUNT;
    public $ISDEBIT;
    public $DEBIT;
    public $CREDIT;
    public $CURRENCY_ID;
    public $THEORDER;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $ISAPPROVED;
    public $APPROVED_DATE;
    public $APPROVED_BY;
    public $DEBIT_START;
    public $CREDIT_START;
    public $MONTH_ID;
    public $REF_BATCH;
    public $QUANTITY;
    public $CLINIC_ID;
    public $DOC_NO;
    public $DOC_DATE;
    public $DOC_TYPE;
    public $DOC_BATCH;
    public $MEASURE_ID;
    public $REF2_NO;
    public $REF2_TYPE;
    public $REF2_BATCH;
    public $REF2_DATE;
    public $ACTIVITY_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'JOURNALS';
        $this->TableName = 'JOURNALS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[JOURNALS]";
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
        $this->ORG_UNIT_CODE = new DbField('JOURNALS', 'JOURNALS', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // ITEM_ID
        $this->ITEM_ID = new DbField('JOURNALS', 'JOURNALS', 'x_ITEM_ID', 'ITEM_ID', '[ITEM_ID]', '[ITEM_ID]', 200, 50, -1, false, '[ITEM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ITEM_ID->IsPrimaryKey = true; // Primary key field
        $this->ITEM_ID->Nullable = false; // NOT NULL field
        $this->ITEM_ID->Required = true; // Required field
        $this->ITEM_ID->Sortable = true; // Allow sort
        $this->ITEM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ITEM_ID->Param, "CustomMsg");
        $this->Fields['ITEM_ID'] = &$this->ITEM_ID;

        // YEAR_ID
        $this->YEAR_ID = new DbField('JOURNALS', 'JOURNALS', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // PROGRAM_ID
        $this->PROGRAM_ID = new DbField('JOURNALS', 'JOURNALS', 'x_PROGRAM_ID', 'PROGRAM_ID', '[PROGRAM_ID]', '[PROGRAM_ID]', 200, 50, -1, false, '[PROGRAM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROGRAM_ID->Sortable = true; // Allow sort
        $this->PROGRAM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROGRAM_ID->Param, "CustomMsg");
        $this->Fields['PROGRAM_ID'] = &$this->PROGRAM_ID;

        // PACTIVITY_ID
        $this->PACTIVITY_ID = new DbField('JOURNALS', 'JOURNALS', 'x_PACTIVITY_ID', 'PACTIVITY_ID', '[PACTIVITY_ID]', '[PACTIVITY_ID]', 200, 50, -1, false, '[PACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PACTIVITY_ID->Sortable = true; // Allow sort
        $this->PACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['PACTIVITY_ID'] = &$this->PACTIVITY_ID;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('JOURNALS', 'JOURNALS', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // REF_ID
        $this->REF_ID = new DbField('JOURNALS', 'JOURNALS', 'x_REF_ID', 'REF_ID', '[REF_ID]', '[REF_ID]', 200, 50, -1, false, '[REF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_ID->Nullable = false; // NOT NULL field
        $this->REF_ID->Required = true; // Required field
        $this->REF_ID->Sortable = true; // Allow sort
        $this->REF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_ID->Param, "CustomMsg");
        $this->Fields['REF_ID'] = &$this->REF_ID;

        // REF_TYPE
        $this->REF_TYPE = new DbField('JOURNALS', 'JOURNALS', 'x_REF_TYPE', 'REF_TYPE', '[REF_TYPE]', 'CAST([REF_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[REF_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_TYPE->Sortable = true; // Allow sort
        $this->REF_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REF_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_TYPE->Param, "CustomMsg");
        $this->Fields['REF_TYPE'] = &$this->REF_TYPE;

        // REF_NO
        $this->REF_NO = new DbField('JOURNALS', 'JOURNALS', 'x_REF_NO', 'REF_NO', '[REF_NO]', '[REF_NO]', 200, 50, -1, false, '[REF_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_NO->Sortable = true; // Allow sort
        $this->REF_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_NO->Param, "CustomMsg");
        $this->Fields['REF_NO'] = &$this->REF_NO;

        // REF_DATE
        $this->REF_DATE = new DbField('JOURNALS', 'JOURNALS', 'x_REF_DATE', 'REF_DATE', '[REF_DATE]', CastDateFieldForLike("[REF_DATE]", 0, "DB"), 135, 8, 0, false, '[REF_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_DATE->Sortable = true; // Allow sort
        $this->REF_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REF_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_DATE->Param, "CustomMsg");
        $this->Fields['REF_DATE'] = &$this->REF_DATE;

        // TREAT_DATE
        $this->TREAT_DATE = new DbField('JOURNALS', 'JOURNALS', 'x_TREAT_DATE', 'TREAT_DATE', '[TREAT_DATE]', CastDateFieldForLike("[TREAT_DATE]", 0, "DB"), 135, 8, 0, false, '[TREAT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREAT_DATE->Sortable = true; // Allow sort
        $this->TREAT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TREAT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREAT_DATE->Param, "CustomMsg");
        $this->Fields['TREAT_DATE'] = &$this->TREAT_DATE;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('JOURNALS', 'JOURNALS', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // ACT
        $this->ACT = new DbField('JOURNALS', 'JOURNALS', 'x_ACT', 'ACT', '[ACT]', '[ACT]', 200, 5, -1, false, '[ACT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACT->Sortable = true; // Allow sort
        $this->ACT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACT->Param, "CustomMsg");
        $this->Fields['ACT'] = &$this->ACT;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('JOURNALS', 'JOURNALS', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // FA_V
        $this->FA_V = new DbField('JOURNALS', 'JOURNALS', 'x_FA_V', 'FA_V', '[FA_V]', '[FA_V]', 200, 50, -1, false, '[FA_V]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V->Nullable = false; // NOT NULL field
        $this->FA_V->Required = true; // Required field
        $this->FA_V->Sortable = true; // Allow sort
        $this->FA_V->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V->Param, "CustomMsg");
        $this->Fields['FA_V'] = &$this->FA_V;

        // AMOUNT
        $this->AMOUNT = new DbField('JOURNALS', 'JOURNALS', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = true; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // ISDEBIT
        $this->ISDEBIT = new DbField('JOURNALS', 'JOURNALS', 'x_ISDEBIT', 'ISDEBIT', '[ISDEBIT]', '[ISDEBIT]', 129, 1, -1, false, '[ISDEBIT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISDEBIT->Sortable = true; // Allow sort
        $this->ISDEBIT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISDEBIT->Param, "CustomMsg");
        $this->Fields['ISDEBIT'] = &$this->ISDEBIT;

        // DEBIT
        $this->DEBIT = new DbField('JOURNALS', 'JOURNALS', 'x_DEBIT', 'DEBIT', '[DEBIT]', 'CAST([DEBIT] AS NVARCHAR)', 6, 8, -1, false, '[DEBIT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DEBIT->Sortable = true; // Allow sort
        $this->DEBIT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DEBIT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DEBIT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DEBIT->Param, "CustomMsg");
        $this->Fields['DEBIT'] = &$this->DEBIT;

        // CREDIT
        $this->CREDIT = new DbField('JOURNALS', 'JOURNALS', 'x_CREDIT', 'CREDIT', '[CREDIT]', 'CAST([CREDIT] AS NVARCHAR)', 6, 8, -1, false, '[CREDIT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CREDIT->Sortable = true; // Allow sort
        $this->CREDIT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->CREDIT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->CREDIT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CREDIT->Param, "CustomMsg");
        $this->Fields['CREDIT'] = &$this->CREDIT;

        // CURRENCY_ID
        $this->CURRENCY_ID = new DbField('JOURNALS', 'JOURNALS', 'x_CURRENCY_ID', 'CURRENCY_ID', '[CURRENCY_ID]', '[CURRENCY_ID]', 200, 50, -1, false, '[CURRENCY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CURRENCY_ID->Sortable = true; // Allow sort
        $this->CURRENCY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CURRENCY_ID->Param, "CustomMsg");
        $this->Fields['CURRENCY_ID'] = &$this->CURRENCY_ID;

        // THEORDER
        $this->THEORDER = new DbField('JOURNALS', 'JOURNALS', 'x_THEORDER', 'THEORDER', '[THEORDER]', 'CAST([THEORDER] AS NVARCHAR)', 2, 2, -1, false, '[THEORDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEORDER->Sortable = true; // Allow sort
        $this->THEORDER->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->THEORDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEORDER->Param, "CustomMsg");
        $this->Fields['THEORDER'] = &$this->THEORDER;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('JOURNALS', 'JOURNALS', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('JOURNALS', 'JOURNALS', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // ISAPPROVED
        $this->ISAPPROVED = new DbField('JOURNALS', 'JOURNALS', 'x_ISAPPROVED', 'ISAPPROVED', '[ISAPPROVED]', '[ISAPPROVED]', 200, 1, -1, false, '[ISAPPROVED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISAPPROVED->Sortable = true; // Allow sort
        $this->ISAPPROVED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISAPPROVED->Param, "CustomMsg");
        $this->Fields['ISAPPROVED'] = &$this->ISAPPROVED;

        // APPROVED_DATE
        $this->APPROVED_DATE = new DbField('JOURNALS', 'JOURNALS', 'x_APPROVED_DATE', 'APPROVED_DATE', '[APPROVED_DATE]', CastDateFieldForLike("[APPROVED_DATE]", 0, "DB"), 135, 8, 0, false, '[APPROVED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_DATE->Sortable = true; // Allow sort
        $this->APPROVED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->APPROVED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_DATE->Param, "CustomMsg");
        $this->Fields['APPROVED_DATE'] = &$this->APPROVED_DATE;

        // APPROVED_BY
        $this->APPROVED_BY = new DbField('JOURNALS', 'JOURNALS', 'x_APPROVED_BY', 'APPROVED_BY', '[APPROVED_BY]', '[APPROVED_BY]', 200, 50, -1, false, '[APPROVED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_BY->Sortable = true; // Allow sort
        $this->APPROVED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_BY->Param, "CustomMsg");
        $this->Fields['APPROVED_BY'] = &$this->APPROVED_BY;

        // DEBIT_START
        $this->DEBIT_START = new DbField('JOURNALS', 'JOURNALS', 'x_DEBIT_START', 'DEBIT_START', '[DEBIT_START]', 'CAST([DEBIT_START] AS NVARCHAR)', 6, 8, -1, false, '[DEBIT_START]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DEBIT_START->Sortable = true; // Allow sort
        $this->DEBIT_START->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DEBIT_START->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DEBIT_START->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DEBIT_START->Param, "CustomMsg");
        $this->Fields['DEBIT_START'] = &$this->DEBIT_START;

        // CREDIT_START
        $this->CREDIT_START = new DbField('JOURNALS', 'JOURNALS', 'x_CREDIT_START', 'CREDIT_START', '[CREDIT_START]', 'CAST([CREDIT_START] AS NVARCHAR)', 6, 8, -1, false, '[CREDIT_START]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CREDIT_START->Sortable = true; // Allow sort
        $this->CREDIT_START->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->CREDIT_START->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->CREDIT_START->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CREDIT_START->Param, "CustomMsg");
        $this->Fields['CREDIT_START'] = &$this->CREDIT_START;

        // MONTH_ID
        $this->MONTH_ID = new DbField('JOURNALS', 'JOURNALS', 'x_MONTH_ID', 'MONTH_ID', '[MONTH_ID]', 'CAST([MONTH_ID] AS NVARCHAR)', 17, 1, -1, false, '[MONTH_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MONTH_ID->Sortable = true; // Allow sort
        $this->MONTH_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MONTH_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MONTH_ID->Param, "CustomMsg");
        $this->Fields['MONTH_ID'] = &$this->MONTH_ID;

        // REF_BATCH
        $this->REF_BATCH = new DbField('JOURNALS', 'JOURNALS', 'x_REF_BATCH', 'REF_BATCH', '[REF_BATCH]', '[REF_BATCH]', 200, 50, -1, false, '[REF_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_BATCH->Sortable = true; // Allow sort
        $this->REF_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_BATCH->Param, "CustomMsg");
        $this->Fields['REF_BATCH'] = &$this->REF_BATCH;

        // QUANTITY
        $this->QUANTITY = new DbField('JOURNALS', 'JOURNALS', 'x_QUANTITY', 'QUANTITY', '[QUANTITY]', 'CAST([QUANTITY] AS NVARCHAR)', 131, 8, -1, false, '[QUANTITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->QUANTITY->Sortable = true; // Allow sort
        $this->QUANTITY->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->QUANTITY->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->QUANTITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->QUANTITY->Param, "CustomMsg");
        $this->Fields['QUANTITY'] = &$this->QUANTITY;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('JOURNALS', 'JOURNALS', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 50, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // DOC_NO
        $this->DOC_NO = new DbField('JOURNALS', 'JOURNALS', 'x_DOC_NO', 'DOC_NO', '[DOC_NO]', '[DOC_NO]', 200, 50, -1, false, '[DOC_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_NO->Sortable = true; // Allow sort
        $this->DOC_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_NO->Param, "CustomMsg");
        $this->Fields['DOC_NO'] = &$this->DOC_NO;

        // DOC_DATE
        $this->DOC_DATE = new DbField('JOURNALS', 'JOURNALS', 'x_DOC_DATE', 'DOC_DATE', '[DOC_DATE]', CastDateFieldForLike("[DOC_DATE]", 0, "DB"), 135, 8, 0, false, '[DOC_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_DATE->Sortable = true; // Allow sort
        $this->DOC_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DOC_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_DATE->Param, "CustomMsg");
        $this->Fields['DOC_DATE'] = &$this->DOC_DATE;

        // DOC_TYPE
        $this->DOC_TYPE = new DbField('JOURNALS', 'JOURNALS', 'x_DOC_TYPE', 'DOC_TYPE', '[DOC_TYPE]', 'CAST([DOC_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[DOC_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_TYPE->Sortable = true; // Allow sort
        $this->DOC_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DOC_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_TYPE->Param, "CustomMsg");
        $this->Fields['DOC_TYPE'] = &$this->DOC_TYPE;

        // DOC_BATCH
        $this->DOC_BATCH = new DbField('JOURNALS', 'JOURNALS', 'x_DOC_BATCH', 'DOC_BATCH', '[DOC_BATCH]', '[DOC_BATCH]', 200, 50, -1, false, '[DOC_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_BATCH->Sortable = true; // Allow sort
        $this->DOC_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_BATCH->Param, "CustomMsg");
        $this->Fields['DOC_BATCH'] = &$this->DOC_BATCH;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('JOURNALS', 'JOURNALS', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // REF2_NO
        $this->REF2_NO = new DbField('JOURNALS', 'JOURNALS', 'x_REF2_NO', 'REF2_NO', '[REF2_NO]', '[REF2_NO]', 200, 50, -1, false, '[REF2_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF2_NO->Sortable = true; // Allow sort
        $this->REF2_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF2_NO->Param, "CustomMsg");
        $this->Fields['REF2_NO'] = &$this->REF2_NO;

        // REF2_TYPE
        $this->REF2_TYPE = new DbField('JOURNALS', 'JOURNALS', 'x_REF2_TYPE', 'REF2_TYPE', '[REF2_TYPE]', 'CAST([REF2_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[REF2_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF2_TYPE->Sortable = true; // Allow sort
        $this->REF2_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REF2_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF2_TYPE->Param, "CustomMsg");
        $this->Fields['REF2_TYPE'] = &$this->REF2_TYPE;

        // REF2_BATCH
        $this->REF2_BATCH = new DbField('JOURNALS', 'JOURNALS', 'x_REF2_BATCH', 'REF2_BATCH', '[REF2_BATCH]', '[REF2_BATCH]', 200, 50, -1, false, '[REF2_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF2_BATCH->Sortable = true; // Allow sort
        $this->REF2_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF2_BATCH->Param, "CustomMsg");
        $this->Fields['REF2_BATCH'] = &$this->REF2_BATCH;

        // REF2_DATE
        $this->REF2_DATE = new DbField('JOURNALS', 'JOURNALS', 'x_REF2_DATE', 'REF2_DATE', '[REF2_DATE]', CastDateFieldForLike("[REF2_DATE]", 0, "DB"), 135, 8, 0, false, '[REF2_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF2_DATE->Sortable = true; // Allow sort
        $this->REF2_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REF2_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF2_DATE->Param, "CustomMsg");
        $this->Fields['REF2_DATE'] = &$this->REF2_DATE;

        // ACTIVITY_ID
        $this->ACTIVITY_ID = new DbField('JOURNALS', 'JOURNALS', 'x_ACTIVITY_ID', 'ACTIVITY_ID', '[ACTIVITY_ID]', 'CAST([ACTIVITY_ID] AS NVARCHAR)', 2, 2, -1, false, '[ACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACTIVITY_ID->Sortable = true; // Allow sort
        $this->ACTIVITY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['ACTIVITY_ID'] = &$this->ACTIVITY_ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[JOURNALS]";
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
            if (array_key_exists('ITEM_ID', $rs)) {
                AddFilter($where, QuotedName('ITEM_ID', $this->Dbid) . '=' . QuotedValue($rs['ITEM_ID'], $this->ITEM_ID->DataType, $this->Dbid));
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
        $this->ITEM_ID->DbValue = $row['ITEM_ID'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->PROGRAM_ID->DbValue = $row['PROGRAM_ID'];
        $this->PACTIVITY_ID->DbValue = $row['PACTIVITY_ID'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->REF_ID->DbValue = $row['REF_ID'];
        $this->REF_TYPE->DbValue = $row['REF_TYPE'];
        $this->REF_NO->DbValue = $row['REF_NO'];
        $this->REF_DATE->DbValue = $row['REF_DATE'];
        $this->TREAT_DATE->DbValue = $row['TREAT_DATE'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->ACT->DbValue = $row['ACT'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->FA_V->DbValue = $row['FA_V'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->ISDEBIT->DbValue = $row['ISDEBIT'];
        $this->DEBIT->DbValue = $row['DEBIT'];
        $this->CREDIT->DbValue = $row['CREDIT'];
        $this->CURRENCY_ID->DbValue = $row['CURRENCY_ID'];
        $this->THEORDER->DbValue = $row['THEORDER'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->ISAPPROVED->DbValue = $row['ISAPPROVED'];
        $this->APPROVED_DATE->DbValue = $row['APPROVED_DATE'];
        $this->APPROVED_BY->DbValue = $row['APPROVED_BY'];
        $this->DEBIT_START->DbValue = $row['DEBIT_START'];
        $this->CREDIT_START->DbValue = $row['CREDIT_START'];
        $this->MONTH_ID->DbValue = $row['MONTH_ID'];
        $this->REF_BATCH->DbValue = $row['REF_BATCH'];
        $this->QUANTITY->DbValue = $row['QUANTITY'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->DOC_NO->DbValue = $row['DOC_NO'];
        $this->DOC_DATE->DbValue = $row['DOC_DATE'];
        $this->DOC_TYPE->DbValue = $row['DOC_TYPE'];
        $this->DOC_BATCH->DbValue = $row['DOC_BATCH'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->REF2_NO->DbValue = $row['REF2_NO'];
        $this->REF2_TYPE->DbValue = $row['REF2_TYPE'];
        $this->REF2_BATCH->DbValue = $row['REF2_BATCH'];
        $this->REF2_DATE->DbValue = $row['REF2_DATE'];
        $this->ACTIVITY_ID->DbValue = $row['ACTIVITY_ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [ITEM_ID] = '@ITEM_ID@'";
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
        $val = $current ? $this->ITEM_ID->CurrentValue : $this->ITEM_ID->OldValue;
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
                $this->ITEM_ID->CurrentValue = $keys[1];
            } else {
                $this->ITEM_ID->OldValue = $keys[1];
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
            $val = array_key_exists('ITEM_ID', $row) ? $row['ITEM_ID'] : null;
        } else {
            $val = $this->ITEM_ID->OldValue !== null ? $this->ITEM_ID->OldValue : $this->ITEM_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ITEM_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("JournalsList");
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
        if ($pageName == "JournalsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "JournalsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "JournalsAdd") {
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
                return "JournalsView";
            case Config("API_ADD_ACTION"):
                return "JournalsAdd";
            case Config("API_EDIT_ACTION"):
                return "JournalsEdit";
            case Config("API_DELETE_ACTION"):
                return "JournalsDelete";
            case Config("API_LIST_ACTION"):
                return "JournalsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "JournalsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("JournalsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("JournalsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "JournalsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "JournalsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("JournalsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("JournalsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("JournalsDelete", $this->getUrlParm());
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
        $json .= ",ITEM_ID:" . JsonEncode($this->ITEM_ID->CurrentValue, "string");
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
        if ($this->ITEM_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ITEM_ID->CurrentValue);
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
            if (($keyValue = Param("ITEM_ID") ?? Route("ITEM_ID")) !== null) {
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
                $this->ITEM_ID->CurrentValue = $key[1];
            } else {
                $this->ITEM_ID->OldValue = $key[1];
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
        $this->ITEM_ID->setDbValue($row['ITEM_ID']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->PROGRAM_ID->setDbValue($row['PROGRAM_ID']);
        $this->PACTIVITY_ID->setDbValue($row['PACTIVITY_ID']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->REF_ID->setDbValue($row['REF_ID']);
        $this->REF_TYPE->setDbValue($row['REF_TYPE']);
        $this->REF_NO->setDbValue($row['REF_NO']);
        $this->REF_DATE->setDbValue($row['REF_DATE']);
        $this->TREAT_DATE->setDbValue($row['TREAT_DATE']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->ACT->setDbValue($row['ACT']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->ISDEBIT->setDbValue($row['ISDEBIT']);
        $this->DEBIT->setDbValue($row['DEBIT']);
        $this->CREDIT->setDbValue($row['CREDIT']);
        $this->CURRENCY_ID->setDbValue($row['CURRENCY_ID']);
        $this->THEORDER->setDbValue($row['THEORDER']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->ISAPPROVED->setDbValue($row['ISAPPROVED']);
        $this->APPROVED_DATE->setDbValue($row['APPROVED_DATE']);
        $this->APPROVED_BY->setDbValue($row['APPROVED_BY']);
        $this->DEBIT_START->setDbValue($row['DEBIT_START']);
        $this->CREDIT_START->setDbValue($row['CREDIT_START']);
        $this->MONTH_ID->setDbValue($row['MONTH_ID']);
        $this->REF_BATCH->setDbValue($row['REF_BATCH']);
        $this->QUANTITY->setDbValue($row['QUANTITY']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->DOC_NO->setDbValue($row['DOC_NO']);
        $this->DOC_DATE->setDbValue($row['DOC_DATE']);
        $this->DOC_TYPE->setDbValue($row['DOC_TYPE']);
        $this->DOC_BATCH->setDbValue($row['DOC_BATCH']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->REF2_NO->setDbValue($row['REF2_NO']);
        $this->REF2_TYPE->setDbValue($row['REF2_TYPE']);
        $this->REF2_BATCH->setDbValue($row['REF2_BATCH']);
        $this->REF2_DATE->setDbValue($row['REF2_DATE']);
        $this->ACTIVITY_ID->setDbValue($row['ACTIVITY_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // ITEM_ID

        // YEAR_ID

        // PROGRAM_ID

        // PACTIVITY_ID

        // COMPANY_ID

        // REF_ID

        // REF_TYPE

        // REF_NO

        // REF_DATE

        // TREAT_DATE

        // ACCOUNT_ID

        // ACT

        // DESCRIPTION

        // FA_V

        // AMOUNT

        // ISDEBIT

        // DEBIT

        // CREDIT

        // CURRENCY_ID

        // THEORDER

        // MODIFIED_DATE

        // MODIFIED_BY

        // ISAPPROVED

        // APPROVED_DATE

        // APPROVED_BY

        // DEBIT_START

        // CREDIT_START

        // MONTH_ID

        // REF_BATCH

        // QUANTITY

        // CLINIC_ID

        // DOC_NO

        // DOC_DATE

        // DOC_TYPE

        // DOC_BATCH

        // MEASURE_ID

        // REF2_NO

        // REF2_TYPE

        // REF2_BATCH

        // REF2_DATE

        // ACTIVITY_ID

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // ITEM_ID
        $this->ITEM_ID->ViewValue = $this->ITEM_ID->CurrentValue;
        $this->ITEM_ID->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // PROGRAM_ID
        $this->PROGRAM_ID->ViewValue = $this->PROGRAM_ID->CurrentValue;
        $this->PROGRAM_ID->ViewCustomAttributes = "";

        // PACTIVITY_ID
        $this->PACTIVITY_ID->ViewValue = $this->PACTIVITY_ID->CurrentValue;
        $this->PACTIVITY_ID->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // REF_ID
        $this->REF_ID->ViewValue = $this->REF_ID->CurrentValue;
        $this->REF_ID->ViewCustomAttributes = "";

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

        // TREAT_DATE
        $this->TREAT_DATE->ViewValue = $this->TREAT_DATE->CurrentValue;
        $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 0);
        $this->TREAT_DATE->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // ACT
        $this->ACT->ViewValue = $this->ACT->CurrentValue;
        $this->ACT->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // FA_V
        $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
        $this->FA_V->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // ISDEBIT
        $this->ISDEBIT->ViewValue = $this->ISDEBIT->CurrentValue;
        $this->ISDEBIT->ViewCustomAttributes = "";

        // DEBIT
        $this->DEBIT->ViewValue = $this->DEBIT->CurrentValue;
        $this->DEBIT->ViewValue = FormatNumber($this->DEBIT->ViewValue, 2, -2, -2, -2);
        $this->DEBIT->ViewCustomAttributes = "";

        // CREDIT
        $this->CREDIT->ViewValue = $this->CREDIT->CurrentValue;
        $this->CREDIT->ViewValue = FormatNumber($this->CREDIT->ViewValue, 2, -2, -2, -2);
        $this->CREDIT->ViewCustomAttributes = "";

        // CURRENCY_ID
        $this->CURRENCY_ID->ViewValue = $this->CURRENCY_ID->CurrentValue;
        $this->CURRENCY_ID->ViewCustomAttributes = "";

        // THEORDER
        $this->THEORDER->ViewValue = $this->THEORDER->CurrentValue;
        $this->THEORDER->ViewValue = FormatNumber($this->THEORDER->ViewValue, 0, -2, -2, -2);
        $this->THEORDER->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // ISAPPROVED
        $this->ISAPPROVED->ViewValue = $this->ISAPPROVED->CurrentValue;
        $this->ISAPPROVED->ViewCustomAttributes = "";

        // APPROVED_DATE
        $this->APPROVED_DATE->ViewValue = $this->APPROVED_DATE->CurrentValue;
        $this->APPROVED_DATE->ViewValue = FormatDateTime($this->APPROVED_DATE->ViewValue, 0);
        $this->APPROVED_DATE->ViewCustomAttributes = "";

        // APPROVED_BY
        $this->APPROVED_BY->ViewValue = $this->APPROVED_BY->CurrentValue;
        $this->APPROVED_BY->ViewCustomAttributes = "";

        // DEBIT_START
        $this->DEBIT_START->ViewValue = $this->DEBIT_START->CurrentValue;
        $this->DEBIT_START->ViewValue = FormatNumber($this->DEBIT_START->ViewValue, 2, -2, -2, -2);
        $this->DEBIT_START->ViewCustomAttributes = "";

        // CREDIT_START
        $this->CREDIT_START->ViewValue = $this->CREDIT_START->CurrentValue;
        $this->CREDIT_START->ViewValue = FormatNumber($this->CREDIT_START->ViewValue, 2, -2, -2, -2);
        $this->CREDIT_START->ViewCustomAttributes = "";

        // MONTH_ID
        $this->MONTH_ID->ViewValue = $this->MONTH_ID->CurrentValue;
        $this->MONTH_ID->ViewValue = FormatNumber($this->MONTH_ID->ViewValue, 0, -2, -2, -2);
        $this->MONTH_ID->ViewCustomAttributes = "";

        // REF_BATCH
        $this->REF_BATCH->ViewValue = $this->REF_BATCH->CurrentValue;
        $this->REF_BATCH->ViewCustomAttributes = "";

        // QUANTITY
        $this->QUANTITY->ViewValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->ViewValue = FormatNumber($this->QUANTITY->ViewValue, 2, -2, -2, -2);
        $this->QUANTITY->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // DOC_NO
        $this->DOC_NO->ViewValue = $this->DOC_NO->CurrentValue;
        $this->DOC_NO->ViewCustomAttributes = "";

        // DOC_DATE
        $this->DOC_DATE->ViewValue = $this->DOC_DATE->CurrentValue;
        $this->DOC_DATE->ViewValue = FormatDateTime($this->DOC_DATE->ViewValue, 0);
        $this->DOC_DATE->ViewCustomAttributes = "";

        // DOC_TYPE
        $this->DOC_TYPE->ViewValue = $this->DOC_TYPE->CurrentValue;
        $this->DOC_TYPE->ViewValue = FormatNumber($this->DOC_TYPE->ViewValue, 0, -2, -2, -2);
        $this->DOC_TYPE->ViewCustomAttributes = "";

        // DOC_BATCH
        $this->DOC_BATCH->ViewValue = $this->DOC_BATCH->CurrentValue;
        $this->DOC_BATCH->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // REF2_NO
        $this->REF2_NO->ViewValue = $this->REF2_NO->CurrentValue;
        $this->REF2_NO->ViewCustomAttributes = "";

        // REF2_TYPE
        $this->REF2_TYPE->ViewValue = $this->REF2_TYPE->CurrentValue;
        $this->REF2_TYPE->ViewValue = FormatNumber($this->REF2_TYPE->ViewValue, 0, -2, -2, -2);
        $this->REF2_TYPE->ViewCustomAttributes = "";

        // REF2_BATCH
        $this->REF2_BATCH->ViewValue = $this->REF2_BATCH->CurrentValue;
        $this->REF2_BATCH->ViewCustomAttributes = "";

        // REF2_DATE
        $this->REF2_DATE->ViewValue = $this->REF2_DATE->CurrentValue;
        $this->REF2_DATE->ViewValue = FormatDateTime($this->REF2_DATE->ViewValue, 0);
        $this->REF2_DATE->ViewCustomAttributes = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->ViewValue = FormatNumber($this->ACTIVITY_ID->ViewValue, 0, -2, -2, -2);
        $this->ACTIVITY_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // ITEM_ID
        $this->ITEM_ID->LinkCustomAttributes = "";
        $this->ITEM_ID->HrefValue = "";
        $this->ITEM_ID->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // PROGRAM_ID
        $this->PROGRAM_ID->LinkCustomAttributes = "";
        $this->PROGRAM_ID->HrefValue = "";
        $this->PROGRAM_ID->TooltipValue = "";

        // PACTIVITY_ID
        $this->PACTIVITY_ID->LinkCustomAttributes = "";
        $this->PACTIVITY_ID->HrefValue = "";
        $this->PACTIVITY_ID->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // REF_ID
        $this->REF_ID->LinkCustomAttributes = "";
        $this->REF_ID->HrefValue = "";
        $this->REF_ID->TooltipValue = "";

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

        // TREAT_DATE
        $this->TREAT_DATE->LinkCustomAttributes = "";
        $this->TREAT_DATE->HrefValue = "";
        $this->TREAT_DATE->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // ACT
        $this->ACT->LinkCustomAttributes = "";
        $this->ACT->HrefValue = "";
        $this->ACT->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // FA_V
        $this->FA_V->LinkCustomAttributes = "";
        $this->FA_V->HrefValue = "";
        $this->FA_V->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // ISDEBIT
        $this->ISDEBIT->LinkCustomAttributes = "";
        $this->ISDEBIT->HrefValue = "";
        $this->ISDEBIT->TooltipValue = "";

        // DEBIT
        $this->DEBIT->LinkCustomAttributes = "";
        $this->DEBIT->HrefValue = "";
        $this->DEBIT->TooltipValue = "";

        // CREDIT
        $this->CREDIT->LinkCustomAttributes = "";
        $this->CREDIT->HrefValue = "";
        $this->CREDIT->TooltipValue = "";

        // CURRENCY_ID
        $this->CURRENCY_ID->LinkCustomAttributes = "";
        $this->CURRENCY_ID->HrefValue = "";
        $this->CURRENCY_ID->TooltipValue = "";

        // THEORDER
        $this->THEORDER->LinkCustomAttributes = "";
        $this->THEORDER->HrefValue = "";
        $this->THEORDER->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // ISAPPROVED
        $this->ISAPPROVED->LinkCustomAttributes = "";
        $this->ISAPPROVED->HrefValue = "";
        $this->ISAPPROVED->TooltipValue = "";

        // APPROVED_DATE
        $this->APPROVED_DATE->LinkCustomAttributes = "";
        $this->APPROVED_DATE->HrefValue = "";
        $this->APPROVED_DATE->TooltipValue = "";

        // APPROVED_BY
        $this->APPROVED_BY->LinkCustomAttributes = "";
        $this->APPROVED_BY->HrefValue = "";
        $this->APPROVED_BY->TooltipValue = "";

        // DEBIT_START
        $this->DEBIT_START->LinkCustomAttributes = "";
        $this->DEBIT_START->HrefValue = "";
        $this->DEBIT_START->TooltipValue = "";

        // CREDIT_START
        $this->CREDIT_START->LinkCustomAttributes = "";
        $this->CREDIT_START->HrefValue = "";
        $this->CREDIT_START->TooltipValue = "";

        // MONTH_ID
        $this->MONTH_ID->LinkCustomAttributes = "";
        $this->MONTH_ID->HrefValue = "";
        $this->MONTH_ID->TooltipValue = "";

        // REF_BATCH
        $this->REF_BATCH->LinkCustomAttributes = "";
        $this->REF_BATCH->HrefValue = "";
        $this->REF_BATCH->TooltipValue = "";

        // QUANTITY
        $this->QUANTITY->LinkCustomAttributes = "";
        $this->QUANTITY->HrefValue = "";
        $this->QUANTITY->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // DOC_NO
        $this->DOC_NO->LinkCustomAttributes = "";
        $this->DOC_NO->HrefValue = "";
        $this->DOC_NO->TooltipValue = "";

        // DOC_DATE
        $this->DOC_DATE->LinkCustomAttributes = "";
        $this->DOC_DATE->HrefValue = "";
        $this->DOC_DATE->TooltipValue = "";

        // DOC_TYPE
        $this->DOC_TYPE->LinkCustomAttributes = "";
        $this->DOC_TYPE->HrefValue = "";
        $this->DOC_TYPE->TooltipValue = "";

        // DOC_BATCH
        $this->DOC_BATCH->LinkCustomAttributes = "";
        $this->DOC_BATCH->HrefValue = "";
        $this->DOC_BATCH->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // REF2_NO
        $this->REF2_NO->LinkCustomAttributes = "";
        $this->REF2_NO->HrefValue = "";
        $this->REF2_NO->TooltipValue = "";

        // REF2_TYPE
        $this->REF2_TYPE->LinkCustomAttributes = "";
        $this->REF2_TYPE->HrefValue = "";
        $this->REF2_TYPE->TooltipValue = "";

        // REF2_BATCH
        $this->REF2_BATCH->LinkCustomAttributes = "";
        $this->REF2_BATCH->HrefValue = "";
        $this->REF2_BATCH->TooltipValue = "";

        // REF2_DATE
        $this->REF2_DATE->LinkCustomAttributes = "";
        $this->REF2_DATE->HrefValue = "";
        $this->REF2_DATE->TooltipValue = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->LinkCustomAttributes = "";
        $this->ACTIVITY_ID->HrefValue = "";
        $this->ACTIVITY_ID->TooltipValue = "";

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

        // ITEM_ID
        $this->ITEM_ID->EditAttrs["class"] = "form-control";
        $this->ITEM_ID->EditCustomAttributes = "";
        if (!$this->ITEM_ID->Raw) {
            $this->ITEM_ID->CurrentValue = HtmlDecode($this->ITEM_ID->CurrentValue);
        }
        $this->ITEM_ID->EditValue = $this->ITEM_ID->CurrentValue;
        $this->ITEM_ID->PlaceHolder = RemoveHtml($this->ITEM_ID->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // PROGRAM_ID
        $this->PROGRAM_ID->EditAttrs["class"] = "form-control";
        $this->PROGRAM_ID->EditCustomAttributes = "";
        if (!$this->PROGRAM_ID->Raw) {
            $this->PROGRAM_ID->CurrentValue = HtmlDecode($this->PROGRAM_ID->CurrentValue);
        }
        $this->PROGRAM_ID->EditValue = $this->PROGRAM_ID->CurrentValue;
        $this->PROGRAM_ID->PlaceHolder = RemoveHtml($this->PROGRAM_ID->caption());

        // PACTIVITY_ID
        $this->PACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->PACTIVITY_ID->EditCustomAttributes = "";
        if (!$this->PACTIVITY_ID->Raw) {
            $this->PACTIVITY_ID->CurrentValue = HtmlDecode($this->PACTIVITY_ID->CurrentValue);
        }
        $this->PACTIVITY_ID->EditValue = $this->PACTIVITY_ID->CurrentValue;
        $this->PACTIVITY_ID->PlaceHolder = RemoveHtml($this->PACTIVITY_ID->caption());

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // REF_ID
        $this->REF_ID->EditAttrs["class"] = "form-control";
        $this->REF_ID->EditCustomAttributes = "";
        if (!$this->REF_ID->Raw) {
            $this->REF_ID->CurrentValue = HtmlDecode($this->REF_ID->CurrentValue);
        }
        $this->REF_ID->EditValue = $this->REF_ID->CurrentValue;
        $this->REF_ID->PlaceHolder = RemoveHtml($this->REF_ID->caption());

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

        // TREAT_DATE
        $this->TREAT_DATE->EditAttrs["class"] = "form-control";
        $this->TREAT_DATE->EditCustomAttributes = "";
        $this->TREAT_DATE->EditValue = FormatDateTime($this->TREAT_DATE->CurrentValue, 8);
        $this->TREAT_DATE->PlaceHolder = RemoveHtml($this->TREAT_DATE->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // ACT
        $this->ACT->EditAttrs["class"] = "form-control";
        $this->ACT->EditCustomAttributes = "";
        if (!$this->ACT->Raw) {
            $this->ACT->CurrentValue = HtmlDecode($this->ACT->CurrentValue);
        }
        $this->ACT->EditValue = $this->ACT->CurrentValue;
        $this->ACT->PlaceHolder = RemoveHtml($this->ACT->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // FA_V
        $this->FA_V->EditAttrs["class"] = "form-control";
        $this->FA_V->EditCustomAttributes = "";
        if (!$this->FA_V->Raw) {
            $this->FA_V->CurrentValue = HtmlDecode($this->FA_V->CurrentValue);
        }
        $this->FA_V->EditValue = $this->FA_V->CurrentValue;
        $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

        // AMOUNT
        $this->AMOUNT->EditAttrs["class"] = "form-control";
        $this->AMOUNT->EditCustomAttributes = "";
        $this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
        if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue)) {
            $this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // ISDEBIT
        $this->ISDEBIT->EditAttrs["class"] = "form-control";
        $this->ISDEBIT->EditCustomAttributes = "";
        if (!$this->ISDEBIT->Raw) {
            $this->ISDEBIT->CurrentValue = HtmlDecode($this->ISDEBIT->CurrentValue);
        }
        $this->ISDEBIT->EditValue = $this->ISDEBIT->CurrentValue;
        $this->ISDEBIT->PlaceHolder = RemoveHtml($this->ISDEBIT->caption());

        // DEBIT
        $this->DEBIT->EditAttrs["class"] = "form-control";
        $this->DEBIT->EditCustomAttributes = "";
        $this->DEBIT->EditValue = $this->DEBIT->CurrentValue;
        $this->DEBIT->PlaceHolder = RemoveHtml($this->DEBIT->caption());
        if (strval($this->DEBIT->EditValue) != "" && is_numeric($this->DEBIT->EditValue)) {
            $this->DEBIT->EditValue = FormatNumber($this->DEBIT->EditValue, -2, -2, -2, -2);
        }

        // CREDIT
        $this->CREDIT->EditAttrs["class"] = "form-control";
        $this->CREDIT->EditCustomAttributes = "";
        $this->CREDIT->EditValue = $this->CREDIT->CurrentValue;
        $this->CREDIT->PlaceHolder = RemoveHtml($this->CREDIT->caption());
        if (strval($this->CREDIT->EditValue) != "" && is_numeric($this->CREDIT->EditValue)) {
            $this->CREDIT->EditValue = FormatNumber($this->CREDIT->EditValue, -2, -2, -2, -2);
        }

        // CURRENCY_ID
        $this->CURRENCY_ID->EditAttrs["class"] = "form-control";
        $this->CURRENCY_ID->EditCustomAttributes = "";
        if (!$this->CURRENCY_ID->Raw) {
            $this->CURRENCY_ID->CurrentValue = HtmlDecode($this->CURRENCY_ID->CurrentValue);
        }
        $this->CURRENCY_ID->EditValue = $this->CURRENCY_ID->CurrentValue;
        $this->CURRENCY_ID->PlaceHolder = RemoveHtml($this->CURRENCY_ID->caption());

        // THEORDER
        $this->THEORDER->EditAttrs["class"] = "form-control";
        $this->THEORDER->EditCustomAttributes = "";
        $this->THEORDER->EditValue = $this->THEORDER->CurrentValue;
        $this->THEORDER->PlaceHolder = RemoveHtml($this->THEORDER->caption());

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

        // ISAPPROVED
        $this->ISAPPROVED->EditAttrs["class"] = "form-control";
        $this->ISAPPROVED->EditCustomAttributes = "";
        if (!$this->ISAPPROVED->Raw) {
            $this->ISAPPROVED->CurrentValue = HtmlDecode($this->ISAPPROVED->CurrentValue);
        }
        $this->ISAPPROVED->EditValue = $this->ISAPPROVED->CurrentValue;
        $this->ISAPPROVED->PlaceHolder = RemoveHtml($this->ISAPPROVED->caption());

        // APPROVED_DATE
        $this->APPROVED_DATE->EditAttrs["class"] = "form-control";
        $this->APPROVED_DATE->EditCustomAttributes = "";
        $this->APPROVED_DATE->EditValue = FormatDateTime($this->APPROVED_DATE->CurrentValue, 8);
        $this->APPROVED_DATE->PlaceHolder = RemoveHtml($this->APPROVED_DATE->caption());

        // APPROVED_BY
        $this->APPROVED_BY->EditAttrs["class"] = "form-control";
        $this->APPROVED_BY->EditCustomAttributes = "";
        if (!$this->APPROVED_BY->Raw) {
            $this->APPROVED_BY->CurrentValue = HtmlDecode($this->APPROVED_BY->CurrentValue);
        }
        $this->APPROVED_BY->EditValue = $this->APPROVED_BY->CurrentValue;
        $this->APPROVED_BY->PlaceHolder = RemoveHtml($this->APPROVED_BY->caption());

        // DEBIT_START
        $this->DEBIT_START->EditAttrs["class"] = "form-control";
        $this->DEBIT_START->EditCustomAttributes = "";
        $this->DEBIT_START->EditValue = $this->DEBIT_START->CurrentValue;
        $this->DEBIT_START->PlaceHolder = RemoveHtml($this->DEBIT_START->caption());
        if (strval($this->DEBIT_START->EditValue) != "" && is_numeric($this->DEBIT_START->EditValue)) {
            $this->DEBIT_START->EditValue = FormatNumber($this->DEBIT_START->EditValue, -2, -2, -2, -2);
        }

        // CREDIT_START
        $this->CREDIT_START->EditAttrs["class"] = "form-control";
        $this->CREDIT_START->EditCustomAttributes = "";
        $this->CREDIT_START->EditValue = $this->CREDIT_START->CurrentValue;
        $this->CREDIT_START->PlaceHolder = RemoveHtml($this->CREDIT_START->caption());
        if (strval($this->CREDIT_START->EditValue) != "" && is_numeric($this->CREDIT_START->EditValue)) {
            $this->CREDIT_START->EditValue = FormatNumber($this->CREDIT_START->EditValue, -2, -2, -2, -2);
        }

        // MONTH_ID
        $this->MONTH_ID->EditAttrs["class"] = "form-control";
        $this->MONTH_ID->EditCustomAttributes = "";
        $this->MONTH_ID->EditValue = $this->MONTH_ID->CurrentValue;
        $this->MONTH_ID->PlaceHolder = RemoveHtml($this->MONTH_ID->caption());

        // REF_BATCH
        $this->REF_BATCH->EditAttrs["class"] = "form-control";
        $this->REF_BATCH->EditCustomAttributes = "";
        if (!$this->REF_BATCH->Raw) {
            $this->REF_BATCH->CurrentValue = HtmlDecode($this->REF_BATCH->CurrentValue);
        }
        $this->REF_BATCH->EditValue = $this->REF_BATCH->CurrentValue;
        $this->REF_BATCH->PlaceHolder = RemoveHtml($this->REF_BATCH->caption());

        // QUANTITY
        $this->QUANTITY->EditAttrs["class"] = "form-control";
        $this->QUANTITY->EditCustomAttributes = "";
        $this->QUANTITY->EditValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->PlaceHolder = RemoveHtml($this->QUANTITY->caption());
        if (strval($this->QUANTITY->EditValue) != "" && is_numeric($this->QUANTITY->EditValue)) {
            $this->QUANTITY->EditValue = FormatNumber($this->QUANTITY->EditValue, -2, -2, -2, -2);
        }

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // DOC_NO
        $this->DOC_NO->EditAttrs["class"] = "form-control";
        $this->DOC_NO->EditCustomAttributes = "";
        if (!$this->DOC_NO->Raw) {
            $this->DOC_NO->CurrentValue = HtmlDecode($this->DOC_NO->CurrentValue);
        }
        $this->DOC_NO->EditValue = $this->DOC_NO->CurrentValue;
        $this->DOC_NO->PlaceHolder = RemoveHtml($this->DOC_NO->caption());

        // DOC_DATE
        $this->DOC_DATE->EditAttrs["class"] = "form-control";
        $this->DOC_DATE->EditCustomAttributes = "";
        $this->DOC_DATE->EditValue = FormatDateTime($this->DOC_DATE->CurrentValue, 8);
        $this->DOC_DATE->PlaceHolder = RemoveHtml($this->DOC_DATE->caption());

        // DOC_TYPE
        $this->DOC_TYPE->EditAttrs["class"] = "form-control";
        $this->DOC_TYPE->EditCustomAttributes = "";
        $this->DOC_TYPE->EditValue = $this->DOC_TYPE->CurrentValue;
        $this->DOC_TYPE->PlaceHolder = RemoveHtml($this->DOC_TYPE->caption());

        // DOC_BATCH
        $this->DOC_BATCH->EditAttrs["class"] = "form-control";
        $this->DOC_BATCH->EditCustomAttributes = "";
        if (!$this->DOC_BATCH->Raw) {
            $this->DOC_BATCH->CurrentValue = HtmlDecode($this->DOC_BATCH->CurrentValue);
        }
        $this->DOC_BATCH->EditValue = $this->DOC_BATCH->CurrentValue;
        $this->DOC_BATCH->PlaceHolder = RemoveHtml($this->DOC_BATCH->caption());

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // REF2_NO
        $this->REF2_NO->EditAttrs["class"] = "form-control";
        $this->REF2_NO->EditCustomAttributes = "";
        if (!$this->REF2_NO->Raw) {
            $this->REF2_NO->CurrentValue = HtmlDecode($this->REF2_NO->CurrentValue);
        }
        $this->REF2_NO->EditValue = $this->REF2_NO->CurrentValue;
        $this->REF2_NO->PlaceHolder = RemoveHtml($this->REF2_NO->caption());

        // REF2_TYPE
        $this->REF2_TYPE->EditAttrs["class"] = "form-control";
        $this->REF2_TYPE->EditCustomAttributes = "";
        $this->REF2_TYPE->EditValue = $this->REF2_TYPE->CurrentValue;
        $this->REF2_TYPE->PlaceHolder = RemoveHtml($this->REF2_TYPE->caption());

        // REF2_BATCH
        $this->REF2_BATCH->EditAttrs["class"] = "form-control";
        $this->REF2_BATCH->EditCustomAttributes = "";
        if (!$this->REF2_BATCH->Raw) {
            $this->REF2_BATCH->CurrentValue = HtmlDecode($this->REF2_BATCH->CurrentValue);
        }
        $this->REF2_BATCH->EditValue = $this->REF2_BATCH->CurrentValue;
        $this->REF2_BATCH->PlaceHolder = RemoveHtml($this->REF2_BATCH->caption());

        // REF2_DATE
        $this->REF2_DATE->EditAttrs["class"] = "form-control";
        $this->REF2_DATE->EditCustomAttributes = "";
        $this->REF2_DATE->EditValue = FormatDateTime($this->REF2_DATE->CurrentValue, 8);
        $this->REF2_DATE->PlaceHolder = RemoveHtml($this->REF2_DATE->caption());

        // ACTIVITY_ID
        $this->ACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->ACTIVITY_ID->EditCustomAttributes = "";
        $this->ACTIVITY_ID->EditValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->PlaceHolder = RemoveHtml($this->ACTIVITY_ID->caption());

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
                    $doc->exportCaption($this->ITEM_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->PROGRAM_ID);
                    $doc->exportCaption($this->PACTIVITY_ID);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->REF_ID);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REF_NO);
                    $doc->exportCaption($this->REF_DATE);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->ACT);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->ISDEBIT);
                    $doc->exportCaption($this->DEBIT);
                    $doc->exportCaption($this->CREDIT);
                    $doc->exportCaption($this->CURRENCY_ID);
                    $doc->exportCaption($this->THEORDER);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->ISAPPROVED);
                    $doc->exportCaption($this->APPROVED_DATE);
                    $doc->exportCaption($this->APPROVED_BY);
                    $doc->exportCaption($this->DEBIT_START);
                    $doc->exportCaption($this->CREDIT_START);
                    $doc->exportCaption($this->MONTH_ID);
                    $doc->exportCaption($this->REF_BATCH);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->DOC_NO);
                    $doc->exportCaption($this->DOC_DATE);
                    $doc->exportCaption($this->DOC_TYPE);
                    $doc->exportCaption($this->DOC_BATCH);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->REF2_NO);
                    $doc->exportCaption($this->REF2_TYPE);
                    $doc->exportCaption($this->REF2_BATCH);
                    $doc->exportCaption($this->REF2_DATE);
                    $doc->exportCaption($this->ACTIVITY_ID);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->ITEM_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->PROGRAM_ID);
                    $doc->exportCaption($this->PACTIVITY_ID);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->REF_ID);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REF_NO);
                    $doc->exportCaption($this->REF_DATE);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->ACT);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->ISDEBIT);
                    $doc->exportCaption($this->DEBIT);
                    $doc->exportCaption($this->CREDIT);
                    $doc->exportCaption($this->CURRENCY_ID);
                    $doc->exportCaption($this->THEORDER);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->ISAPPROVED);
                    $doc->exportCaption($this->APPROVED_DATE);
                    $doc->exportCaption($this->APPROVED_BY);
                    $doc->exportCaption($this->DEBIT_START);
                    $doc->exportCaption($this->CREDIT_START);
                    $doc->exportCaption($this->MONTH_ID);
                    $doc->exportCaption($this->REF_BATCH);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->DOC_NO);
                    $doc->exportCaption($this->DOC_DATE);
                    $doc->exportCaption($this->DOC_TYPE);
                    $doc->exportCaption($this->DOC_BATCH);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->REF2_NO);
                    $doc->exportCaption($this->REF2_TYPE);
                    $doc->exportCaption($this->REF2_BATCH);
                    $doc->exportCaption($this->REF2_DATE);
                    $doc->exportCaption($this->ACTIVITY_ID);
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
                        $doc->exportField($this->ITEM_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->PROGRAM_ID);
                        $doc->exportField($this->PACTIVITY_ID);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->REF_ID);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REF_NO);
                        $doc->exportField($this->REF_DATE);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->ACT);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->ISDEBIT);
                        $doc->exportField($this->DEBIT);
                        $doc->exportField($this->CREDIT);
                        $doc->exportField($this->CURRENCY_ID);
                        $doc->exportField($this->THEORDER);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->ISAPPROVED);
                        $doc->exportField($this->APPROVED_DATE);
                        $doc->exportField($this->APPROVED_BY);
                        $doc->exportField($this->DEBIT_START);
                        $doc->exportField($this->CREDIT_START);
                        $doc->exportField($this->MONTH_ID);
                        $doc->exportField($this->REF_BATCH);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->DOC_NO);
                        $doc->exportField($this->DOC_DATE);
                        $doc->exportField($this->DOC_TYPE);
                        $doc->exportField($this->DOC_BATCH);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->REF2_NO);
                        $doc->exportField($this->REF2_TYPE);
                        $doc->exportField($this->REF2_BATCH);
                        $doc->exportField($this->REF2_DATE);
                        $doc->exportField($this->ACTIVITY_ID);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->ITEM_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->PROGRAM_ID);
                        $doc->exportField($this->PACTIVITY_ID);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->REF_ID);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REF_NO);
                        $doc->exportField($this->REF_DATE);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->ACT);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->ISDEBIT);
                        $doc->exportField($this->DEBIT);
                        $doc->exportField($this->CREDIT);
                        $doc->exportField($this->CURRENCY_ID);
                        $doc->exportField($this->THEORDER);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->ISAPPROVED);
                        $doc->exportField($this->APPROVED_DATE);
                        $doc->exportField($this->APPROVED_BY);
                        $doc->exportField($this->DEBIT_START);
                        $doc->exportField($this->CREDIT_START);
                        $doc->exportField($this->MONTH_ID);
                        $doc->exportField($this->REF_BATCH);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->DOC_NO);
                        $doc->exportField($this->DOC_DATE);
                        $doc->exportField($this->DOC_TYPE);
                        $doc->exportField($this->DOC_BATCH);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->REF2_NO);
                        $doc->exportField($this->REF2_TYPE);
                        $doc->exportField($this->REF2_BATCH);
                        $doc->exportField($this->REF2_DATE);
                        $doc->exportField($this->ACTIVITY_ID);
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
