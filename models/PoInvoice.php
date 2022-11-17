<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for PO_INVOICE
 */
class PoInvoice extends DbTable
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
    public $INVOICE_ID2;
    public $INVOICE_DATE;
    public $PO;
    public $COMPANY_ID;
    public $RECEIVED_DATE;
    public $AMOUNT;
    public $PAYMENT_DUE;
    public $DESCRIPTION;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $RECEIVED_BY;
    public $PRIORITY;
    public $CREDIT_NOTE;
    public $CREDIT_AMOUNT;
    public $PPN;
    public $MATERAI;
    public $SENT_BY;
    public $ACCOUNT_ID;
    public $FINANCE_ID;
    public $potongan;
    public $RECEIVED_VALUE;
    public $NO_ORDER;
    public $CONTRACT_NO;
    public $ORG_ID;
    public $CLINIC_ID;
    public $PPN_VALUE;
    public $DISCOUNT_VALUE;
    public $PAID_VALUE;
    public $ISCETAK;
    public $PRINT_DATE;
    public $PRINTED_BY;
    public $PRINTQ;
    public $FAKTUR_DATE;
    public $DISTRIBUTION_TYPE;
    public $DISCOUNTOFF_VALUE;
    public $THECOUNTER;
    public $FUND_ID;
    public $ORDER_BY;
    public $ACKNOWLEDGEBY;
    public $NUM;
    public $ISPO;
    public $DOCS_TYPE;
    public $PO_DATE;
    public $PO_VALUE;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'PO_INVOICE';
        $this->TableName = 'PO_INVOICE';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[PO_INVOICE]";
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
        $this->ORG_UNIT_CODE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // INVOICE_ID
        $this->INVOICE_ID = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_INVOICE_ID', 'INVOICE_ID', '[INVOICE_ID]', '[INVOICE_ID]', 200, 50, -1, false, '[INVOICE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_ID->IsPrimaryKey = true; // Primary key field
        $this->INVOICE_ID->Nullable = false; // NOT NULL field
        $this->INVOICE_ID->Required = true; // Required field
        $this->INVOICE_ID->Sortable = true; // Allow sort
        $this->INVOICE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_ID->Param, "CustomMsg");
        $this->Fields['INVOICE_ID'] = &$this->INVOICE_ID;

        // INVOICE_ID2
        $this->INVOICE_ID2 = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_INVOICE_ID2', 'INVOICE_ID2', '[INVOICE_ID2]', '[INVOICE_ID2]', 200, 25, -1, false, '[INVOICE_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_ID2->Sortable = true; // Allow sort
        $this->INVOICE_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_ID2->Param, "CustomMsg");
        $this->Fields['INVOICE_ID2'] = &$this->INVOICE_ID2;

        // INVOICE_DATE
        $this->INVOICE_DATE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_INVOICE_DATE', 'INVOICE_DATE', '[INVOICE_DATE]', CastDateFieldForLike("[INVOICE_DATE]", 0, "DB"), 135, 8, 0, false, '[INVOICE_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_DATE->Sortable = true; // Allow sort
        $this->INVOICE_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->INVOICE_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_DATE->Param, "CustomMsg");
        $this->Fields['INVOICE_DATE'] = &$this->INVOICE_DATE;

        // PO
        $this->PO = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PO', 'PO', '[PO]', '[PO]', 200, 50, -1, false, '[PO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PO->Sortable = true; // Allow sort
        $this->PO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PO->Param, "CustomMsg");
        $this->Fields['PO'] = &$this->PO;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // RECEIVED_DATE
        $this->RECEIVED_DATE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_RECEIVED_DATE', 'RECEIVED_DATE', '[RECEIVED_DATE]', CastDateFieldForLike("[RECEIVED_DATE]", 0, "DB"), 135, 8, 0, false, '[RECEIVED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_DATE->Sortable = true; // Allow sort
        $this->RECEIVED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RECEIVED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_DATE->Param, "CustomMsg");
        $this->Fields['RECEIVED_DATE'] = &$this->RECEIVED_DATE;

        // AMOUNT
        $this->AMOUNT = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = true; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // PAYMENT_DUE
        $this->PAYMENT_DUE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PAYMENT_DUE', 'PAYMENT_DUE', '[PAYMENT_DUE]', CastDateFieldForLike("[PAYMENT_DUE]", 0, "DB"), 135, 8, 0, false, '[PAYMENT_DUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYMENT_DUE->Sortable = true; // Allow sort
        $this->PAYMENT_DUE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PAYMENT_DUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYMENT_DUE->Param, "CustomMsg");
        $this->Fields['PAYMENT_DUE'] = &$this->PAYMENT_DUE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // RECEIVED_BY
        $this->RECEIVED_BY = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_RECEIVED_BY', 'RECEIVED_BY', '[RECEIVED_BY]', '[RECEIVED_BY]', 200, 100, -1, false, '[RECEIVED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_BY->Sortable = true; // Allow sort
        $this->RECEIVED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_BY->Param, "CustomMsg");
        $this->Fields['RECEIVED_BY'] = &$this->RECEIVED_BY;

        // PRIORITY
        $this->PRIORITY = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PRIORITY', 'PRIORITY', '[PRIORITY]', 'CAST([PRIORITY] AS NVARCHAR)', 17, 1, -1, false, '[PRIORITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRIORITY->Sortable = true; // Allow sort
        $this->PRIORITY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PRIORITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRIORITY->Param, "CustomMsg");
        $this->Fields['PRIORITY'] = &$this->PRIORITY;

        // CREDIT_NOTE
        $this->CREDIT_NOTE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_CREDIT_NOTE', 'CREDIT_NOTE', '[CREDIT_NOTE]', '[CREDIT_NOTE]', 200, 50, -1, false, '[CREDIT_NOTE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CREDIT_NOTE->Sortable = true; // Allow sort
        $this->CREDIT_NOTE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CREDIT_NOTE->Param, "CustomMsg");
        $this->Fields['CREDIT_NOTE'] = &$this->CREDIT_NOTE;

        // CREDIT_AMOUNT
        $this->CREDIT_AMOUNT = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_CREDIT_AMOUNT', 'CREDIT_AMOUNT', '[CREDIT_AMOUNT]', 'CAST([CREDIT_AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[CREDIT_AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CREDIT_AMOUNT->Sortable = true; // Allow sort
        $this->CREDIT_AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->CREDIT_AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->CREDIT_AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CREDIT_AMOUNT->Param, "CustomMsg");
        $this->Fields['CREDIT_AMOUNT'] = &$this->CREDIT_AMOUNT;

        // PPN
        $this->PPN = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PPN', 'PPN', '[PPN]', 'CAST([PPN] AS NVARCHAR)', 131, 8, -1, false, '[PPN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPN->Sortable = true; // Allow sort
        $this->PPN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPN->Param, "CustomMsg");
        $this->Fields['PPN'] = &$this->PPN;

        // MATERAI
        $this->MATERAI = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_MATERAI', 'MATERAI', '[MATERAI]', 'CAST([MATERAI] AS NVARCHAR)', 6, 8, -1, false, '[MATERAI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MATERAI->Sortable = true; // Allow sort
        $this->MATERAI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MATERAI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MATERAI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MATERAI->Param, "CustomMsg");
        $this->Fields['MATERAI'] = &$this->MATERAI;

        // SENT_BY
        $this->SENT_BY = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_SENT_BY', 'SENT_BY', '[SENT_BY]', '[SENT_BY]', 200, 100, -1, false, '[SENT_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SENT_BY->Sortable = true; // Allow sort
        $this->SENT_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SENT_BY->Param, "CustomMsg");
        $this->Fields['SENT_BY'] = &$this->SENT_BY;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', 'CAST([ACCOUNT_ID] AS NVARCHAR)', 2, 2, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // FINANCE_ID
        $this->FINANCE_ID = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_FINANCE_ID', 'FINANCE_ID', '[FINANCE_ID]', 'CAST([FINANCE_ID] AS NVARCHAR)', 2, 2, -1, false, '[FINANCE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FINANCE_ID->Sortable = true; // Allow sort
        $this->FINANCE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FINANCE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FINANCE_ID->Param, "CustomMsg");
        $this->Fields['FINANCE_ID'] = &$this->FINANCE_ID;

        // potongan
        $this->potongan = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_potongan', 'potongan', '[potongan]', 'CAST([potongan] AS NVARCHAR)', 131, 8, -1, false, '[potongan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->potongan->Sortable = true; // Allow sort
        $this->potongan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->potongan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->potongan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->potongan->Param, "CustomMsg");
        $this->Fields['potongan'] = &$this->potongan;

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_RECEIVED_VALUE', 'RECEIVED_VALUE', '[RECEIVED_VALUE]', 'CAST([RECEIVED_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[RECEIVED_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_VALUE->Sortable = true; // Allow sort
        $this->RECEIVED_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->RECEIVED_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->RECEIVED_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_VALUE->Param, "CustomMsg");
        $this->Fields['RECEIVED_VALUE'] = &$this->RECEIVED_VALUE;

        // NO_ORDER
        $this->NO_ORDER = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_NO_ORDER', 'NO_ORDER', '[NO_ORDER]', '[NO_ORDER]', 200, 50, -1, false, '[NO_ORDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_ORDER->Sortable = true; // Allow sort
        $this->NO_ORDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_ORDER->Param, "CustomMsg");
        $this->Fields['NO_ORDER'] = &$this->NO_ORDER;

        // CONTRACT_NO
        $this->CONTRACT_NO = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_CONTRACT_NO', 'CONTRACT_NO', '[CONTRACT_NO]', '[CONTRACT_NO]', 200, 25, -1, false, '[CONTRACT_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRACT_NO->Sortable = true; // Allow sort
        $this->CONTRACT_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRACT_NO->Param, "CustomMsg");
        $this->Fields['CONTRACT_NO'] = &$this->CONTRACT_NO;

        // ORG_ID
        $this->ORG_ID = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 50, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // PPN_VALUE
        $this->PPN_VALUE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PPN_VALUE', 'PPN_VALUE', '[PPN_VALUE]', 'CAST([PPN_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[PPN_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPN_VALUE->Sortable = true; // Allow sort
        $this->PPN_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPN_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPN_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPN_VALUE->Param, "CustomMsg");
        $this->Fields['PPN_VALUE'] = &$this->PPN_VALUE;

        // DISCOUNT_VALUE
        $this->DISCOUNT_VALUE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_DISCOUNT_VALUE', 'DISCOUNT_VALUE', '[DISCOUNT_VALUE]', 'CAST([DISCOUNT_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[DISCOUNT_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT_VALUE->Sortable = true; // Allow sort
        $this->DISCOUNT_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT_VALUE->Param, "CustomMsg");
        $this->Fields['DISCOUNT_VALUE'] = &$this->DISCOUNT_VALUE;

        // PAID_VALUE
        $this->PAID_VALUE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PAID_VALUE', 'PAID_VALUE', '[PAID_VALUE]', 'CAST([PAID_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[PAID_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAID_VALUE->Sortable = true; // Allow sort
        $this->PAID_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PAID_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PAID_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAID_VALUE->Param, "CustomMsg");
        $this->Fields['PAID_VALUE'] = &$this->PAID_VALUE;

        // ISCETAK
        $this->ISCETAK = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_ISCETAK', 'ISCETAK', '[ISCETAK]', '[ISCETAK]', 129, 1, -1, false, '[ISCETAK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISCETAK->Sortable = true; // Allow sort
        $this->ISCETAK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISCETAK->Param, "CustomMsg");
        $this->Fields['ISCETAK'] = &$this->ISCETAK;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = true; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // PRINTED_BY
        $this->PRINTED_BY = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PRINTED_BY', 'PRINTED_BY', '[PRINTED_BY]', '[PRINTED_BY]', 200, 50, -1, false, '[PRINTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTED_BY->Sortable = true; // Allow sort
        $this->PRINTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTED_BY->Param, "CustomMsg");
        $this->Fields['PRINTED_BY'] = &$this->PRINTED_BY;

        // PRINTQ
        $this->PRINTQ = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PRINTQ', 'PRINTQ', '[PRINTQ]', 'CAST([PRINTQ] AS NVARCHAR)', 17, 1, -1, false, '[PRINTQ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTQ->Sortable = true; // Allow sort
        $this->PRINTQ->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PRINTQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTQ->Param, "CustomMsg");
        $this->Fields['PRINTQ'] = &$this->PRINTQ;

        // FAKTUR_DATE
        $this->FAKTUR_DATE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_FAKTUR_DATE', 'FAKTUR_DATE', '[FAKTUR_DATE]', CastDateFieldForLike("[FAKTUR_DATE]", 0, "DB"), 135, 8, 0, false, '[FAKTUR_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAKTUR_DATE->Sortable = true; // Allow sort
        $this->FAKTUR_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->FAKTUR_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAKTUR_DATE->Param, "CustomMsg");
        $this->Fields['FAKTUR_DATE'] = &$this->FAKTUR_DATE;

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_DISTRIBUTION_TYPE', 'DISTRIBUTION_TYPE', '[DISTRIBUTION_TYPE]', 'CAST([DISTRIBUTION_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[DISTRIBUTION_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISTRIBUTION_TYPE->Sortable = true; // Allow sort
        $this->DISTRIBUTION_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DISTRIBUTION_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISTRIBUTION_TYPE->Param, "CustomMsg");
        $this->Fields['DISTRIBUTION_TYPE'] = &$this->DISTRIBUTION_TYPE;

        // DISCOUNTOFF_VALUE
        $this->DISCOUNTOFF_VALUE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_DISCOUNTOFF_VALUE', 'DISCOUNTOFF_VALUE', '[DISCOUNTOFF_VALUE]', 'CAST([DISCOUNTOFF_VALUE] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNTOFF_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNTOFF_VALUE->Sortable = true; // Allow sort
        $this->DISCOUNTOFF_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNTOFF_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNTOFF_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNTOFF_VALUE->Param, "CustomMsg");
        $this->Fields['DISCOUNTOFF_VALUE'] = &$this->DISCOUNTOFF_VALUE;

        // THECOUNTER
        $this->THECOUNTER = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_THECOUNTER', 'THECOUNTER', '[THECOUNTER]', 'CAST([THECOUNTER] AS NVARCHAR)', 3, 4, -1, false, '[THECOUNTER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THECOUNTER->Sortable = true; // Allow sort
        $this->THECOUNTER->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->THECOUNTER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THECOUNTER->Param, "CustomMsg");
        $this->Fields['THECOUNTER'] = &$this->THECOUNTER;

        // FUND_ID
        $this->FUND_ID = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_FUND_ID', 'FUND_ID', '[FUND_ID]', 'CAST([FUND_ID] AS NVARCHAR)', 17, 1, -1, false, '[FUND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FUND_ID->Sortable = true; // Allow sort
        $this->FUND_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FUND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FUND_ID->Param, "CustomMsg");
        $this->Fields['FUND_ID'] = &$this->FUND_ID;

        // ORDER_BY
        $this->ORDER_BY = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_ORDER_BY', 'ORDER_BY', '[ORDER_BY]', '[ORDER_BY]', 200, 100, -1, false, '[ORDER_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORDER_BY->Sortable = true; // Allow sort
        $this->ORDER_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORDER_BY->Param, "CustomMsg");
        $this->Fields['ORDER_BY'] = &$this->ORDER_BY;

        // ACKNOWLEDGEBY
        $this->ACKNOWLEDGEBY = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_ACKNOWLEDGEBY', 'ACKNOWLEDGEBY', '[ACKNOWLEDGEBY]', '[ACKNOWLEDGEBY]', 200, 100, -1, false, '[ACKNOWLEDGEBY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACKNOWLEDGEBY->Sortable = true; // Allow sort
        $this->ACKNOWLEDGEBY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACKNOWLEDGEBY->Param, "CustomMsg");
        $this->Fields['ACKNOWLEDGEBY'] = &$this->ACKNOWLEDGEBY;

        // NUM
        $this->NUM = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_NUM', 'NUM', '[NUM]', 'CAST([NUM] AS NVARCHAR)', 2, 2, -1, false, '[NUM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NUM->Sortable = true; // Allow sort
        $this->NUM->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NUM->Param, "CustomMsg");
        $this->Fields['NUM'] = &$this->NUM;

        // ISPO
        $this->ISPO = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_ISPO', 'ISPO', '[ISPO]', '[ISPO]', 129, 1, -1, false, '[ISPO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISPO->Sortable = true; // Allow sort
        $this->ISPO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISPO->Param, "CustomMsg");
        $this->Fields['ISPO'] = &$this->ISPO;

        // DOCS_TYPE
        $this->DOCS_TYPE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_DOCS_TYPE', 'DOCS_TYPE', '[DOCS_TYPE]', 'CAST([DOCS_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[DOCS_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCS_TYPE->Sortable = true; // Allow sort
        $this->DOCS_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DOCS_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCS_TYPE->Param, "CustomMsg");
        $this->Fields['DOCS_TYPE'] = &$this->DOCS_TYPE;

        // PO_DATE
        $this->PO_DATE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PO_DATE', 'PO_DATE', '[PO_DATE]', CastDateFieldForLike("[PO_DATE]", 0, "DB"), 135, 8, 0, false, '[PO_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PO_DATE->Sortable = true; // Allow sort
        $this->PO_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PO_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PO_DATE->Param, "CustomMsg");
        $this->Fields['PO_DATE'] = &$this->PO_DATE;

        // PO_VALUE
        $this->PO_VALUE = new DbField('PO_INVOICE', 'PO_INVOICE', 'x_PO_VALUE', 'PO_VALUE', '[PO_VALUE]', 'CAST([PO_VALUE] AS NVARCHAR)', 131, 8, -1, false, '[PO_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PO_VALUE->Sortable = true; // Allow sort
        $this->PO_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PO_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PO_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PO_VALUE->Param, "CustomMsg");
        $this->Fields['PO_VALUE'] = &$this->PO_VALUE;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[PO_INVOICE]";
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
        $this->INVOICE_ID2->DbValue = $row['INVOICE_ID2'];
        $this->INVOICE_DATE->DbValue = $row['INVOICE_DATE'];
        $this->PO->DbValue = $row['PO'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->RECEIVED_DATE->DbValue = $row['RECEIVED_DATE'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->PAYMENT_DUE->DbValue = $row['PAYMENT_DUE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->RECEIVED_BY->DbValue = $row['RECEIVED_BY'];
        $this->PRIORITY->DbValue = $row['PRIORITY'];
        $this->CREDIT_NOTE->DbValue = $row['CREDIT_NOTE'];
        $this->CREDIT_AMOUNT->DbValue = $row['CREDIT_AMOUNT'];
        $this->PPN->DbValue = $row['PPN'];
        $this->MATERAI->DbValue = $row['MATERAI'];
        $this->SENT_BY->DbValue = $row['SENT_BY'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->FINANCE_ID->DbValue = $row['FINANCE_ID'];
        $this->potongan->DbValue = $row['potongan'];
        $this->RECEIVED_VALUE->DbValue = $row['RECEIVED_VALUE'];
        $this->NO_ORDER->DbValue = $row['NO_ORDER'];
        $this->CONTRACT_NO->DbValue = $row['CONTRACT_NO'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->PPN_VALUE->DbValue = $row['PPN_VALUE'];
        $this->DISCOUNT_VALUE->DbValue = $row['DISCOUNT_VALUE'];
        $this->PAID_VALUE->DbValue = $row['PAID_VALUE'];
        $this->ISCETAK->DbValue = $row['ISCETAK'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->PRINTED_BY->DbValue = $row['PRINTED_BY'];
        $this->PRINTQ->DbValue = $row['PRINTQ'];
        $this->FAKTUR_DATE->DbValue = $row['FAKTUR_DATE'];
        $this->DISTRIBUTION_TYPE->DbValue = $row['DISTRIBUTION_TYPE'];
        $this->DISCOUNTOFF_VALUE->DbValue = $row['DISCOUNTOFF_VALUE'];
        $this->THECOUNTER->DbValue = $row['THECOUNTER'];
        $this->FUND_ID->DbValue = $row['FUND_ID'];
        $this->ORDER_BY->DbValue = $row['ORDER_BY'];
        $this->ACKNOWLEDGEBY->DbValue = $row['ACKNOWLEDGEBY'];
        $this->NUM->DbValue = $row['NUM'];
        $this->ISPO->DbValue = $row['ISPO'];
        $this->DOCS_TYPE->DbValue = $row['DOCS_TYPE'];
        $this->PO_DATE->DbValue = $row['PO_DATE'];
        $this->PO_VALUE->DbValue = $row['PO_VALUE'];
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
        return $_SESSION[$name] ?? GetUrl("PoInvoiceList");
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
        if ($pageName == "PoInvoiceView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PoInvoiceEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PoInvoiceAdd") {
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
                return "PoInvoiceView";
            case Config("API_ADD_ACTION"):
                return "PoInvoiceAdd";
            case Config("API_EDIT_ACTION"):
                return "PoInvoiceEdit";
            case Config("API_DELETE_ACTION"):
                return "PoInvoiceDelete";
            case Config("API_LIST_ACTION"):
                return "PoInvoiceList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PoInvoiceList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PoInvoiceView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PoInvoiceView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PoInvoiceAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PoInvoiceAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PoInvoiceEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PoInvoiceAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PoInvoiceDelete", $this->getUrlParm());
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
        $this->INVOICE_ID2->setDbValue($row['INVOICE_ID2']);
        $this->INVOICE_DATE->setDbValue($row['INVOICE_DATE']);
        $this->PO->setDbValue($row['PO']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->RECEIVED_DATE->setDbValue($row['RECEIVED_DATE']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->PAYMENT_DUE->setDbValue($row['PAYMENT_DUE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->RECEIVED_BY->setDbValue($row['RECEIVED_BY']);
        $this->PRIORITY->setDbValue($row['PRIORITY']);
        $this->CREDIT_NOTE->setDbValue($row['CREDIT_NOTE']);
        $this->CREDIT_AMOUNT->setDbValue($row['CREDIT_AMOUNT']);
        $this->PPN->setDbValue($row['PPN']);
        $this->MATERAI->setDbValue($row['MATERAI']);
        $this->SENT_BY->setDbValue($row['SENT_BY']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->FINANCE_ID->setDbValue($row['FINANCE_ID']);
        $this->potongan->setDbValue($row['potongan']);
        $this->RECEIVED_VALUE->setDbValue($row['RECEIVED_VALUE']);
        $this->NO_ORDER->setDbValue($row['NO_ORDER']);
        $this->CONTRACT_NO->setDbValue($row['CONTRACT_NO']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->PPN_VALUE->setDbValue($row['PPN_VALUE']);
        $this->DISCOUNT_VALUE->setDbValue($row['DISCOUNT_VALUE']);
        $this->PAID_VALUE->setDbValue($row['PAID_VALUE']);
        $this->ISCETAK->setDbValue($row['ISCETAK']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->FAKTUR_DATE->setDbValue($row['FAKTUR_DATE']);
        $this->DISTRIBUTION_TYPE->setDbValue($row['DISTRIBUTION_TYPE']);
        $this->DISCOUNTOFF_VALUE->setDbValue($row['DISCOUNTOFF_VALUE']);
        $this->THECOUNTER->setDbValue($row['THECOUNTER']);
        $this->FUND_ID->setDbValue($row['FUND_ID']);
        $this->ORDER_BY->setDbValue($row['ORDER_BY']);
        $this->ACKNOWLEDGEBY->setDbValue($row['ACKNOWLEDGEBY']);
        $this->NUM->setDbValue($row['NUM']);
        $this->ISPO->setDbValue($row['ISPO']);
        $this->DOCS_TYPE->setDbValue($row['DOCS_TYPE']);
        $this->PO_DATE->setDbValue($row['PO_DATE']);
        $this->PO_VALUE->setDbValue($row['PO_VALUE']);
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

        // INVOICE_ID2

        // INVOICE_DATE

        // PO

        // COMPANY_ID

        // RECEIVED_DATE

        // AMOUNT

        // PAYMENT_DUE

        // DESCRIPTION

        // MODIFIED_DATE

        // MODIFIED_BY

        // RECEIVED_BY

        // PRIORITY

        // CREDIT_NOTE

        // CREDIT_AMOUNT

        // PPN

        // MATERAI

        // SENT_BY

        // ACCOUNT_ID

        // FINANCE_ID

        // potongan

        // RECEIVED_VALUE

        // NO_ORDER

        // CONTRACT_NO

        // ORG_ID

        // CLINIC_ID

        // PPN_VALUE

        // DISCOUNT_VALUE

        // PAID_VALUE

        // ISCETAK

        // PRINT_DATE

        // PRINTED_BY

        // PRINTQ

        // FAKTUR_DATE

        // DISTRIBUTION_TYPE

        // DISCOUNTOFF_VALUE

        // THECOUNTER

        // FUND_ID

        // ORDER_BY

        // ACKNOWLEDGEBY

        // NUM

        // ISPO

        // DOCS_TYPE

        // PO_DATE

        // PO_VALUE

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // INVOICE_ID
        $this->INVOICE_ID->ViewValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->ViewCustomAttributes = "";

        // INVOICE_ID2
        $this->INVOICE_ID2->ViewValue = $this->INVOICE_ID2->CurrentValue;
        $this->INVOICE_ID2->ViewCustomAttributes = "";

        // INVOICE_DATE
        $this->INVOICE_DATE->ViewValue = $this->INVOICE_DATE->CurrentValue;
        $this->INVOICE_DATE->ViewValue = FormatDateTime($this->INVOICE_DATE->ViewValue, 0);
        $this->INVOICE_DATE->ViewCustomAttributes = "";

        // PO
        $this->PO->ViewValue = $this->PO->CurrentValue;
        $this->PO->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // RECEIVED_DATE
        $this->RECEIVED_DATE->ViewValue = $this->RECEIVED_DATE->CurrentValue;
        $this->RECEIVED_DATE->ViewValue = FormatDateTime($this->RECEIVED_DATE->ViewValue, 0);
        $this->RECEIVED_DATE->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // PAYMENT_DUE
        $this->PAYMENT_DUE->ViewValue = $this->PAYMENT_DUE->CurrentValue;
        $this->PAYMENT_DUE->ViewValue = FormatDateTime($this->PAYMENT_DUE->ViewValue, 0);
        $this->PAYMENT_DUE->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // RECEIVED_BY
        $this->RECEIVED_BY->ViewValue = $this->RECEIVED_BY->CurrentValue;
        $this->RECEIVED_BY->ViewCustomAttributes = "";

        // PRIORITY
        $this->PRIORITY->ViewValue = $this->PRIORITY->CurrentValue;
        $this->PRIORITY->ViewValue = FormatNumber($this->PRIORITY->ViewValue, 0, -2, -2, -2);
        $this->PRIORITY->ViewCustomAttributes = "";

        // CREDIT_NOTE
        $this->CREDIT_NOTE->ViewValue = $this->CREDIT_NOTE->CurrentValue;
        $this->CREDIT_NOTE->ViewCustomAttributes = "";

        // CREDIT_AMOUNT
        $this->CREDIT_AMOUNT->ViewValue = $this->CREDIT_AMOUNT->CurrentValue;
        $this->CREDIT_AMOUNT->ViewValue = FormatNumber($this->CREDIT_AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->CREDIT_AMOUNT->ViewCustomAttributes = "";

        // PPN
        $this->PPN->ViewValue = $this->PPN->CurrentValue;
        $this->PPN->ViewValue = FormatNumber($this->PPN->ViewValue, 2, -2, -2, -2);
        $this->PPN->ViewCustomAttributes = "";

        // MATERAI
        $this->MATERAI->ViewValue = $this->MATERAI->CurrentValue;
        $this->MATERAI->ViewValue = FormatNumber($this->MATERAI->ViewValue, 2, -2, -2, -2);
        $this->MATERAI->ViewCustomAttributes = "";

        // SENT_BY
        $this->SENT_BY->ViewValue = $this->SENT_BY->CurrentValue;
        $this->SENT_BY->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewValue = FormatNumber($this->ACCOUNT_ID->ViewValue, 0, -2, -2, -2);
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // FINANCE_ID
        $this->FINANCE_ID->ViewValue = $this->FINANCE_ID->CurrentValue;
        $this->FINANCE_ID->ViewValue = FormatNumber($this->FINANCE_ID->ViewValue, 0, -2, -2, -2);
        $this->FINANCE_ID->ViewCustomAttributes = "";

        // potongan
        $this->potongan->ViewValue = $this->potongan->CurrentValue;
        $this->potongan->ViewValue = FormatNumber($this->potongan->ViewValue, 2, -2, -2, -2);
        $this->potongan->ViewCustomAttributes = "";

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->ViewValue = $this->RECEIVED_VALUE->CurrentValue;
        $this->RECEIVED_VALUE->ViewValue = FormatNumber($this->RECEIVED_VALUE->ViewValue, 2, -2, -2, -2);
        $this->RECEIVED_VALUE->ViewCustomAttributes = "";

        // NO_ORDER
        $this->NO_ORDER->ViewValue = $this->NO_ORDER->CurrentValue;
        $this->NO_ORDER->ViewCustomAttributes = "";

        // CONTRACT_NO
        $this->CONTRACT_NO->ViewValue = $this->CONTRACT_NO->CurrentValue;
        $this->CONTRACT_NO->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // PPN_VALUE
        $this->PPN_VALUE->ViewValue = $this->PPN_VALUE->CurrentValue;
        $this->PPN_VALUE->ViewValue = FormatNumber($this->PPN_VALUE->ViewValue, 2, -2, -2, -2);
        $this->PPN_VALUE->ViewCustomAttributes = "";

        // DISCOUNT_VALUE
        $this->DISCOUNT_VALUE->ViewValue = $this->DISCOUNT_VALUE->CurrentValue;
        $this->DISCOUNT_VALUE->ViewValue = FormatNumber($this->DISCOUNT_VALUE->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT_VALUE->ViewCustomAttributes = "";

        // PAID_VALUE
        $this->PAID_VALUE->ViewValue = $this->PAID_VALUE->CurrentValue;
        $this->PAID_VALUE->ViewValue = FormatNumber($this->PAID_VALUE->ViewValue, 2, -2, -2, -2);
        $this->PAID_VALUE->ViewCustomAttributes = "";

        // ISCETAK
        $this->ISCETAK->ViewValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->ViewCustomAttributes = "";

        // PRINT_DATE
        $this->PRINT_DATE->ViewValue = $this->PRINT_DATE->CurrentValue;
        $this->PRINT_DATE->ViewValue = FormatDateTime($this->PRINT_DATE->ViewValue, 0);
        $this->PRINT_DATE->ViewCustomAttributes = "";

        // PRINTED_BY
        $this->PRINTED_BY->ViewValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->ViewCustomAttributes = "";

        // PRINTQ
        $this->PRINTQ->ViewValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->ViewValue = FormatNumber($this->PRINTQ->ViewValue, 0, -2, -2, -2);
        $this->PRINTQ->ViewCustomAttributes = "";

        // FAKTUR_DATE
        $this->FAKTUR_DATE->ViewValue = $this->FAKTUR_DATE->CurrentValue;
        $this->FAKTUR_DATE->ViewValue = FormatDateTime($this->FAKTUR_DATE->ViewValue, 0);
        $this->FAKTUR_DATE->ViewCustomAttributes = "";

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->CurrentValue;
        $this->DISTRIBUTION_TYPE->ViewValue = FormatNumber($this->DISTRIBUTION_TYPE->ViewValue, 0, -2, -2, -2);
        $this->DISTRIBUTION_TYPE->ViewCustomAttributes = "";

        // DISCOUNTOFF_VALUE
        $this->DISCOUNTOFF_VALUE->ViewValue = $this->DISCOUNTOFF_VALUE->CurrentValue;
        $this->DISCOUNTOFF_VALUE->ViewValue = FormatNumber($this->DISCOUNTOFF_VALUE->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNTOFF_VALUE->ViewCustomAttributes = "";

        // THECOUNTER
        $this->THECOUNTER->ViewValue = $this->THECOUNTER->CurrentValue;
        $this->THECOUNTER->ViewValue = FormatNumber($this->THECOUNTER->ViewValue, 0, -2, -2, -2);
        $this->THECOUNTER->ViewCustomAttributes = "";

        // FUND_ID
        $this->FUND_ID->ViewValue = $this->FUND_ID->CurrentValue;
        $this->FUND_ID->ViewValue = FormatNumber($this->FUND_ID->ViewValue, 0, -2, -2, -2);
        $this->FUND_ID->ViewCustomAttributes = "";

        // ORDER_BY
        $this->ORDER_BY->ViewValue = $this->ORDER_BY->CurrentValue;
        $this->ORDER_BY->ViewCustomAttributes = "";

        // ACKNOWLEDGEBY
        $this->ACKNOWLEDGEBY->ViewValue = $this->ACKNOWLEDGEBY->CurrentValue;
        $this->ACKNOWLEDGEBY->ViewCustomAttributes = "";

        // NUM
        $this->NUM->ViewValue = $this->NUM->CurrentValue;
        $this->NUM->ViewValue = FormatNumber($this->NUM->ViewValue, 0, -2, -2, -2);
        $this->NUM->ViewCustomAttributes = "";

        // ISPO
        $this->ISPO->ViewValue = $this->ISPO->CurrentValue;
        $this->ISPO->ViewCustomAttributes = "";

        // DOCS_TYPE
        $this->DOCS_TYPE->ViewValue = $this->DOCS_TYPE->CurrentValue;
        $this->DOCS_TYPE->ViewValue = FormatNumber($this->DOCS_TYPE->ViewValue, 0, -2, -2, -2);
        $this->DOCS_TYPE->ViewCustomAttributes = "";

        // PO_DATE
        $this->PO_DATE->ViewValue = $this->PO_DATE->CurrentValue;
        $this->PO_DATE->ViewValue = FormatDateTime($this->PO_DATE->ViewValue, 0);
        $this->PO_DATE->ViewCustomAttributes = "";

        // PO_VALUE
        $this->PO_VALUE->ViewValue = $this->PO_VALUE->CurrentValue;
        $this->PO_VALUE->ViewValue = FormatNumber($this->PO_VALUE->ViewValue, 2, -2, -2, -2);
        $this->PO_VALUE->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // INVOICE_ID
        $this->INVOICE_ID->LinkCustomAttributes = "";
        $this->INVOICE_ID->HrefValue = "";
        $this->INVOICE_ID->TooltipValue = "";

        // INVOICE_ID2
        $this->INVOICE_ID2->LinkCustomAttributes = "";
        $this->INVOICE_ID2->HrefValue = "";
        $this->INVOICE_ID2->TooltipValue = "";

        // INVOICE_DATE
        $this->INVOICE_DATE->LinkCustomAttributes = "";
        $this->INVOICE_DATE->HrefValue = "";
        $this->INVOICE_DATE->TooltipValue = "";

        // PO
        $this->PO->LinkCustomAttributes = "";
        $this->PO->HrefValue = "";
        $this->PO->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // RECEIVED_DATE
        $this->RECEIVED_DATE->LinkCustomAttributes = "";
        $this->RECEIVED_DATE->HrefValue = "";
        $this->RECEIVED_DATE->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // PAYMENT_DUE
        $this->PAYMENT_DUE->LinkCustomAttributes = "";
        $this->PAYMENT_DUE->HrefValue = "";
        $this->PAYMENT_DUE->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // RECEIVED_BY
        $this->RECEIVED_BY->LinkCustomAttributes = "";
        $this->RECEIVED_BY->HrefValue = "";
        $this->RECEIVED_BY->TooltipValue = "";

        // PRIORITY
        $this->PRIORITY->LinkCustomAttributes = "";
        $this->PRIORITY->HrefValue = "";
        $this->PRIORITY->TooltipValue = "";

        // CREDIT_NOTE
        $this->CREDIT_NOTE->LinkCustomAttributes = "";
        $this->CREDIT_NOTE->HrefValue = "";
        $this->CREDIT_NOTE->TooltipValue = "";

        // CREDIT_AMOUNT
        $this->CREDIT_AMOUNT->LinkCustomAttributes = "";
        $this->CREDIT_AMOUNT->HrefValue = "";
        $this->CREDIT_AMOUNT->TooltipValue = "";

        // PPN
        $this->PPN->LinkCustomAttributes = "";
        $this->PPN->HrefValue = "";
        $this->PPN->TooltipValue = "";

        // MATERAI
        $this->MATERAI->LinkCustomAttributes = "";
        $this->MATERAI->HrefValue = "";
        $this->MATERAI->TooltipValue = "";

        // SENT_BY
        $this->SENT_BY->LinkCustomAttributes = "";
        $this->SENT_BY->HrefValue = "";
        $this->SENT_BY->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // FINANCE_ID
        $this->FINANCE_ID->LinkCustomAttributes = "";
        $this->FINANCE_ID->HrefValue = "";
        $this->FINANCE_ID->TooltipValue = "";

        // potongan
        $this->potongan->LinkCustomAttributes = "";
        $this->potongan->HrefValue = "";
        $this->potongan->TooltipValue = "";

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->LinkCustomAttributes = "";
        $this->RECEIVED_VALUE->HrefValue = "";
        $this->RECEIVED_VALUE->TooltipValue = "";

        // NO_ORDER
        $this->NO_ORDER->LinkCustomAttributes = "";
        $this->NO_ORDER->HrefValue = "";
        $this->NO_ORDER->TooltipValue = "";

        // CONTRACT_NO
        $this->CONTRACT_NO->LinkCustomAttributes = "";
        $this->CONTRACT_NO->HrefValue = "";
        $this->CONTRACT_NO->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // PPN_VALUE
        $this->PPN_VALUE->LinkCustomAttributes = "";
        $this->PPN_VALUE->HrefValue = "";
        $this->PPN_VALUE->TooltipValue = "";

        // DISCOUNT_VALUE
        $this->DISCOUNT_VALUE->LinkCustomAttributes = "";
        $this->DISCOUNT_VALUE->HrefValue = "";
        $this->DISCOUNT_VALUE->TooltipValue = "";

        // PAID_VALUE
        $this->PAID_VALUE->LinkCustomAttributes = "";
        $this->PAID_VALUE->HrefValue = "";
        $this->PAID_VALUE->TooltipValue = "";

        // ISCETAK
        $this->ISCETAK->LinkCustomAttributes = "";
        $this->ISCETAK->HrefValue = "";
        $this->ISCETAK->TooltipValue = "";

        // PRINT_DATE
        $this->PRINT_DATE->LinkCustomAttributes = "";
        $this->PRINT_DATE->HrefValue = "";
        $this->PRINT_DATE->TooltipValue = "";

        // PRINTED_BY
        $this->PRINTED_BY->LinkCustomAttributes = "";
        $this->PRINTED_BY->HrefValue = "";
        $this->PRINTED_BY->TooltipValue = "";

        // PRINTQ
        $this->PRINTQ->LinkCustomAttributes = "";
        $this->PRINTQ->HrefValue = "";
        $this->PRINTQ->TooltipValue = "";

        // FAKTUR_DATE
        $this->FAKTUR_DATE->LinkCustomAttributes = "";
        $this->FAKTUR_DATE->HrefValue = "";
        $this->FAKTUR_DATE->TooltipValue = "";

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->LinkCustomAttributes = "";
        $this->DISTRIBUTION_TYPE->HrefValue = "";
        $this->DISTRIBUTION_TYPE->TooltipValue = "";

        // DISCOUNTOFF_VALUE
        $this->DISCOUNTOFF_VALUE->LinkCustomAttributes = "";
        $this->DISCOUNTOFF_VALUE->HrefValue = "";
        $this->DISCOUNTOFF_VALUE->TooltipValue = "";

        // THECOUNTER
        $this->THECOUNTER->LinkCustomAttributes = "";
        $this->THECOUNTER->HrefValue = "";
        $this->THECOUNTER->TooltipValue = "";

        // FUND_ID
        $this->FUND_ID->LinkCustomAttributes = "";
        $this->FUND_ID->HrefValue = "";
        $this->FUND_ID->TooltipValue = "";

        // ORDER_BY
        $this->ORDER_BY->LinkCustomAttributes = "";
        $this->ORDER_BY->HrefValue = "";
        $this->ORDER_BY->TooltipValue = "";

        // ACKNOWLEDGEBY
        $this->ACKNOWLEDGEBY->LinkCustomAttributes = "";
        $this->ACKNOWLEDGEBY->HrefValue = "";
        $this->ACKNOWLEDGEBY->TooltipValue = "";

        // NUM
        $this->NUM->LinkCustomAttributes = "";
        $this->NUM->HrefValue = "";
        $this->NUM->TooltipValue = "";

        // ISPO
        $this->ISPO->LinkCustomAttributes = "";
        $this->ISPO->HrefValue = "";
        $this->ISPO->TooltipValue = "";

        // DOCS_TYPE
        $this->DOCS_TYPE->LinkCustomAttributes = "";
        $this->DOCS_TYPE->HrefValue = "";
        $this->DOCS_TYPE->TooltipValue = "";

        // PO_DATE
        $this->PO_DATE->LinkCustomAttributes = "";
        $this->PO_DATE->HrefValue = "";
        $this->PO_DATE->TooltipValue = "";

        // PO_VALUE
        $this->PO_VALUE->LinkCustomAttributes = "";
        $this->PO_VALUE->HrefValue = "";
        $this->PO_VALUE->TooltipValue = "";

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

        // INVOICE_ID2
        $this->INVOICE_ID2->EditAttrs["class"] = "form-control";
        $this->INVOICE_ID2->EditCustomAttributes = "";
        if (!$this->INVOICE_ID2->Raw) {
            $this->INVOICE_ID2->CurrentValue = HtmlDecode($this->INVOICE_ID2->CurrentValue);
        }
        $this->INVOICE_ID2->EditValue = $this->INVOICE_ID2->CurrentValue;
        $this->INVOICE_ID2->PlaceHolder = RemoveHtml($this->INVOICE_ID2->caption());

        // INVOICE_DATE
        $this->INVOICE_DATE->EditAttrs["class"] = "form-control";
        $this->INVOICE_DATE->EditCustomAttributes = "";
        $this->INVOICE_DATE->EditValue = FormatDateTime($this->INVOICE_DATE->CurrentValue, 8);
        $this->INVOICE_DATE->PlaceHolder = RemoveHtml($this->INVOICE_DATE->caption());

        // PO
        $this->PO->EditAttrs["class"] = "form-control";
        $this->PO->EditCustomAttributes = "";
        if (!$this->PO->Raw) {
            $this->PO->CurrentValue = HtmlDecode($this->PO->CurrentValue);
        }
        $this->PO->EditValue = $this->PO->CurrentValue;
        $this->PO->PlaceHolder = RemoveHtml($this->PO->caption());

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // RECEIVED_DATE
        $this->RECEIVED_DATE->EditAttrs["class"] = "form-control";
        $this->RECEIVED_DATE->EditCustomAttributes = "";
        $this->RECEIVED_DATE->EditValue = FormatDateTime($this->RECEIVED_DATE->CurrentValue, 8);
        $this->RECEIVED_DATE->PlaceHolder = RemoveHtml($this->RECEIVED_DATE->caption());

        // AMOUNT
        $this->AMOUNT->EditAttrs["class"] = "form-control";
        $this->AMOUNT->EditCustomAttributes = "";
        $this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
        if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue)) {
            $this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // PAYMENT_DUE
        $this->PAYMENT_DUE->EditAttrs["class"] = "form-control";
        $this->PAYMENT_DUE->EditCustomAttributes = "";
        $this->PAYMENT_DUE->EditValue = FormatDateTime($this->PAYMENT_DUE->CurrentValue, 8);
        $this->PAYMENT_DUE->PlaceHolder = RemoveHtml($this->PAYMENT_DUE->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

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

        // RECEIVED_BY
        $this->RECEIVED_BY->EditAttrs["class"] = "form-control";
        $this->RECEIVED_BY->EditCustomAttributes = "";
        if (!$this->RECEIVED_BY->Raw) {
            $this->RECEIVED_BY->CurrentValue = HtmlDecode($this->RECEIVED_BY->CurrentValue);
        }
        $this->RECEIVED_BY->EditValue = $this->RECEIVED_BY->CurrentValue;
        $this->RECEIVED_BY->PlaceHolder = RemoveHtml($this->RECEIVED_BY->caption());

        // PRIORITY
        $this->PRIORITY->EditAttrs["class"] = "form-control";
        $this->PRIORITY->EditCustomAttributes = "";
        $this->PRIORITY->EditValue = $this->PRIORITY->CurrentValue;
        $this->PRIORITY->PlaceHolder = RemoveHtml($this->PRIORITY->caption());

        // CREDIT_NOTE
        $this->CREDIT_NOTE->EditAttrs["class"] = "form-control";
        $this->CREDIT_NOTE->EditCustomAttributes = "";
        if (!$this->CREDIT_NOTE->Raw) {
            $this->CREDIT_NOTE->CurrentValue = HtmlDecode($this->CREDIT_NOTE->CurrentValue);
        }
        $this->CREDIT_NOTE->EditValue = $this->CREDIT_NOTE->CurrentValue;
        $this->CREDIT_NOTE->PlaceHolder = RemoveHtml($this->CREDIT_NOTE->caption());

        // CREDIT_AMOUNT
        $this->CREDIT_AMOUNT->EditAttrs["class"] = "form-control";
        $this->CREDIT_AMOUNT->EditCustomAttributes = "";
        $this->CREDIT_AMOUNT->EditValue = $this->CREDIT_AMOUNT->CurrentValue;
        $this->CREDIT_AMOUNT->PlaceHolder = RemoveHtml($this->CREDIT_AMOUNT->caption());
        if (strval($this->CREDIT_AMOUNT->EditValue) != "" && is_numeric($this->CREDIT_AMOUNT->EditValue)) {
            $this->CREDIT_AMOUNT->EditValue = FormatNumber($this->CREDIT_AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // PPN
        $this->PPN->EditAttrs["class"] = "form-control";
        $this->PPN->EditCustomAttributes = "";
        $this->PPN->EditValue = $this->PPN->CurrentValue;
        $this->PPN->PlaceHolder = RemoveHtml($this->PPN->caption());
        if (strval($this->PPN->EditValue) != "" && is_numeric($this->PPN->EditValue)) {
            $this->PPN->EditValue = FormatNumber($this->PPN->EditValue, -2, -2, -2, -2);
        }

        // MATERAI
        $this->MATERAI->EditAttrs["class"] = "form-control";
        $this->MATERAI->EditCustomAttributes = "";
        $this->MATERAI->EditValue = $this->MATERAI->CurrentValue;
        $this->MATERAI->PlaceHolder = RemoveHtml($this->MATERAI->caption());
        if (strval($this->MATERAI->EditValue) != "" && is_numeric($this->MATERAI->EditValue)) {
            $this->MATERAI->EditValue = FormatNumber($this->MATERAI->EditValue, -2, -2, -2, -2);
        }

        // SENT_BY
        $this->SENT_BY->EditAttrs["class"] = "form-control";
        $this->SENT_BY->EditCustomAttributes = "";
        if (!$this->SENT_BY->Raw) {
            $this->SENT_BY->CurrentValue = HtmlDecode($this->SENT_BY->CurrentValue);
        }
        $this->SENT_BY->EditValue = $this->SENT_BY->CurrentValue;
        $this->SENT_BY->PlaceHolder = RemoveHtml($this->SENT_BY->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // FINANCE_ID
        $this->FINANCE_ID->EditAttrs["class"] = "form-control";
        $this->FINANCE_ID->EditCustomAttributes = "";
        $this->FINANCE_ID->EditValue = $this->FINANCE_ID->CurrentValue;
        $this->FINANCE_ID->PlaceHolder = RemoveHtml($this->FINANCE_ID->caption());

        // potongan
        $this->potongan->EditAttrs["class"] = "form-control";
        $this->potongan->EditCustomAttributes = "";
        $this->potongan->EditValue = $this->potongan->CurrentValue;
        $this->potongan->PlaceHolder = RemoveHtml($this->potongan->caption());
        if (strval($this->potongan->EditValue) != "" && is_numeric($this->potongan->EditValue)) {
            $this->potongan->EditValue = FormatNumber($this->potongan->EditValue, -2, -2, -2, -2);
        }

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->EditAttrs["class"] = "form-control";
        $this->RECEIVED_VALUE->EditCustomAttributes = "";
        $this->RECEIVED_VALUE->EditValue = $this->RECEIVED_VALUE->CurrentValue;
        $this->RECEIVED_VALUE->PlaceHolder = RemoveHtml($this->RECEIVED_VALUE->caption());
        if (strval($this->RECEIVED_VALUE->EditValue) != "" && is_numeric($this->RECEIVED_VALUE->EditValue)) {
            $this->RECEIVED_VALUE->EditValue = FormatNumber($this->RECEIVED_VALUE->EditValue, -2, -2, -2, -2);
        }

        // NO_ORDER
        $this->NO_ORDER->EditAttrs["class"] = "form-control";
        $this->NO_ORDER->EditCustomAttributes = "";
        if (!$this->NO_ORDER->Raw) {
            $this->NO_ORDER->CurrentValue = HtmlDecode($this->NO_ORDER->CurrentValue);
        }
        $this->NO_ORDER->EditValue = $this->NO_ORDER->CurrentValue;
        $this->NO_ORDER->PlaceHolder = RemoveHtml($this->NO_ORDER->caption());

        // CONTRACT_NO
        $this->CONTRACT_NO->EditAttrs["class"] = "form-control";
        $this->CONTRACT_NO->EditCustomAttributes = "";
        if (!$this->CONTRACT_NO->Raw) {
            $this->CONTRACT_NO->CurrentValue = HtmlDecode($this->CONTRACT_NO->CurrentValue);
        }
        $this->CONTRACT_NO->EditValue = $this->CONTRACT_NO->CurrentValue;
        $this->CONTRACT_NO->PlaceHolder = RemoveHtml($this->CONTRACT_NO->caption());

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        if (!$this->ORG_ID->Raw) {
            $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
        }
        $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // PPN_VALUE
        $this->PPN_VALUE->EditAttrs["class"] = "form-control";
        $this->PPN_VALUE->EditCustomAttributes = "";
        $this->PPN_VALUE->EditValue = $this->PPN_VALUE->CurrentValue;
        $this->PPN_VALUE->PlaceHolder = RemoveHtml($this->PPN_VALUE->caption());
        if (strval($this->PPN_VALUE->EditValue) != "" && is_numeric($this->PPN_VALUE->EditValue)) {
            $this->PPN_VALUE->EditValue = FormatNumber($this->PPN_VALUE->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT_VALUE
        $this->DISCOUNT_VALUE->EditAttrs["class"] = "form-control";
        $this->DISCOUNT_VALUE->EditCustomAttributes = "";
        $this->DISCOUNT_VALUE->EditValue = $this->DISCOUNT_VALUE->CurrentValue;
        $this->DISCOUNT_VALUE->PlaceHolder = RemoveHtml($this->DISCOUNT_VALUE->caption());
        if (strval($this->DISCOUNT_VALUE->EditValue) != "" && is_numeric($this->DISCOUNT_VALUE->EditValue)) {
            $this->DISCOUNT_VALUE->EditValue = FormatNumber($this->DISCOUNT_VALUE->EditValue, -2, -2, -2, -2);
        }

        // PAID_VALUE
        $this->PAID_VALUE->EditAttrs["class"] = "form-control";
        $this->PAID_VALUE->EditCustomAttributes = "";
        $this->PAID_VALUE->EditValue = $this->PAID_VALUE->CurrentValue;
        $this->PAID_VALUE->PlaceHolder = RemoveHtml($this->PAID_VALUE->caption());
        if (strval($this->PAID_VALUE->EditValue) != "" && is_numeric($this->PAID_VALUE->EditValue)) {
            $this->PAID_VALUE->EditValue = FormatNumber($this->PAID_VALUE->EditValue, -2, -2, -2, -2);
        }

        // ISCETAK
        $this->ISCETAK->EditAttrs["class"] = "form-control";
        $this->ISCETAK->EditCustomAttributes = "";
        if (!$this->ISCETAK->Raw) {
            $this->ISCETAK->CurrentValue = HtmlDecode($this->ISCETAK->CurrentValue);
        }
        $this->ISCETAK->EditValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->PlaceHolder = RemoveHtml($this->ISCETAK->caption());

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

        // PRINTQ
        $this->PRINTQ->EditAttrs["class"] = "form-control";
        $this->PRINTQ->EditCustomAttributes = "";
        $this->PRINTQ->EditValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->PlaceHolder = RemoveHtml($this->PRINTQ->caption());

        // FAKTUR_DATE
        $this->FAKTUR_DATE->EditAttrs["class"] = "form-control";
        $this->FAKTUR_DATE->EditCustomAttributes = "";
        $this->FAKTUR_DATE->EditValue = FormatDateTime($this->FAKTUR_DATE->CurrentValue, 8);
        $this->FAKTUR_DATE->PlaceHolder = RemoveHtml($this->FAKTUR_DATE->caption());

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->EditAttrs["class"] = "form-control";
        $this->DISTRIBUTION_TYPE->EditCustomAttributes = "";
        $this->DISTRIBUTION_TYPE->EditValue = $this->DISTRIBUTION_TYPE->CurrentValue;
        $this->DISTRIBUTION_TYPE->PlaceHolder = RemoveHtml($this->DISTRIBUTION_TYPE->caption());

        // DISCOUNTOFF_VALUE
        $this->DISCOUNTOFF_VALUE->EditAttrs["class"] = "form-control";
        $this->DISCOUNTOFF_VALUE->EditCustomAttributes = "";
        $this->DISCOUNTOFF_VALUE->EditValue = $this->DISCOUNTOFF_VALUE->CurrentValue;
        $this->DISCOUNTOFF_VALUE->PlaceHolder = RemoveHtml($this->DISCOUNTOFF_VALUE->caption());
        if (strval($this->DISCOUNTOFF_VALUE->EditValue) != "" && is_numeric($this->DISCOUNTOFF_VALUE->EditValue)) {
            $this->DISCOUNTOFF_VALUE->EditValue = FormatNumber($this->DISCOUNTOFF_VALUE->EditValue, -2, -2, -2, -2);
        }

        // THECOUNTER
        $this->THECOUNTER->EditAttrs["class"] = "form-control";
        $this->THECOUNTER->EditCustomAttributes = "";
        $this->THECOUNTER->EditValue = $this->THECOUNTER->CurrentValue;
        $this->THECOUNTER->PlaceHolder = RemoveHtml($this->THECOUNTER->caption());

        // FUND_ID
        $this->FUND_ID->EditAttrs["class"] = "form-control";
        $this->FUND_ID->EditCustomAttributes = "";
        $this->FUND_ID->EditValue = $this->FUND_ID->CurrentValue;
        $this->FUND_ID->PlaceHolder = RemoveHtml($this->FUND_ID->caption());

        // ORDER_BY
        $this->ORDER_BY->EditAttrs["class"] = "form-control";
        $this->ORDER_BY->EditCustomAttributes = "";
        if (!$this->ORDER_BY->Raw) {
            $this->ORDER_BY->CurrentValue = HtmlDecode($this->ORDER_BY->CurrentValue);
        }
        $this->ORDER_BY->EditValue = $this->ORDER_BY->CurrentValue;
        $this->ORDER_BY->PlaceHolder = RemoveHtml($this->ORDER_BY->caption());

        // ACKNOWLEDGEBY
        $this->ACKNOWLEDGEBY->EditAttrs["class"] = "form-control";
        $this->ACKNOWLEDGEBY->EditCustomAttributes = "";
        if (!$this->ACKNOWLEDGEBY->Raw) {
            $this->ACKNOWLEDGEBY->CurrentValue = HtmlDecode($this->ACKNOWLEDGEBY->CurrentValue);
        }
        $this->ACKNOWLEDGEBY->EditValue = $this->ACKNOWLEDGEBY->CurrentValue;
        $this->ACKNOWLEDGEBY->PlaceHolder = RemoveHtml($this->ACKNOWLEDGEBY->caption());

        // NUM
        $this->NUM->EditAttrs["class"] = "form-control";
        $this->NUM->EditCustomAttributes = "";
        $this->NUM->EditValue = $this->NUM->CurrentValue;
        $this->NUM->PlaceHolder = RemoveHtml($this->NUM->caption());

        // ISPO
        $this->ISPO->EditAttrs["class"] = "form-control";
        $this->ISPO->EditCustomAttributes = "";
        if (!$this->ISPO->Raw) {
            $this->ISPO->CurrentValue = HtmlDecode($this->ISPO->CurrentValue);
        }
        $this->ISPO->EditValue = $this->ISPO->CurrentValue;
        $this->ISPO->PlaceHolder = RemoveHtml($this->ISPO->caption());

        // DOCS_TYPE
        $this->DOCS_TYPE->EditAttrs["class"] = "form-control";
        $this->DOCS_TYPE->EditCustomAttributes = "";
        $this->DOCS_TYPE->EditValue = $this->DOCS_TYPE->CurrentValue;
        $this->DOCS_TYPE->PlaceHolder = RemoveHtml($this->DOCS_TYPE->caption());

        // PO_DATE
        $this->PO_DATE->EditAttrs["class"] = "form-control";
        $this->PO_DATE->EditCustomAttributes = "";
        $this->PO_DATE->EditValue = FormatDateTime($this->PO_DATE->CurrentValue, 8);
        $this->PO_DATE->PlaceHolder = RemoveHtml($this->PO_DATE->caption());

        // PO_VALUE
        $this->PO_VALUE->EditAttrs["class"] = "form-control";
        $this->PO_VALUE->EditCustomAttributes = "";
        $this->PO_VALUE->EditValue = $this->PO_VALUE->CurrentValue;
        $this->PO_VALUE->PlaceHolder = RemoveHtml($this->PO_VALUE->caption());
        if (strval($this->PO_VALUE->EditValue) != "" && is_numeric($this->PO_VALUE->EditValue)) {
            $this->PO_VALUE->EditValue = FormatNumber($this->PO_VALUE->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->INVOICE_ID2);
                    $doc->exportCaption($this->INVOICE_DATE);
                    $doc->exportCaption($this->PO);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->RECEIVED_DATE);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->PAYMENT_DUE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->RECEIVED_BY);
                    $doc->exportCaption($this->PRIORITY);
                    $doc->exportCaption($this->CREDIT_NOTE);
                    $doc->exportCaption($this->CREDIT_AMOUNT);
                    $doc->exportCaption($this->PPN);
                    $doc->exportCaption($this->MATERAI);
                    $doc->exportCaption($this->SENT_BY);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->FINANCE_ID);
                    $doc->exportCaption($this->potongan);
                    $doc->exportCaption($this->RECEIVED_VALUE);
                    $doc->exportCaption($this->NO_ORDER);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->PPN_VALUE);
                    $doc->exportCaption($this->DISCOUNT_VALUE);
                    $doc->exportCaption($this->PAID_VALUE);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->FAKTUR_DATE);
                    $doc->exportCaption($this->DISTRIBUTION_TYPE);
                    $doc->exportCaption($this->DISCOUNTOFF_VALUE);
                    $doc->exportCaption($this->THECOUNTER);
                    $doc->exportCaption($this->FUND_ID);
                    $doc->exportCaption($this->ORDER_BY);
                    $doc->exportCaption($this->ACKNOWLEDGEBY);
                    $doc->exportCaption($this->NUM);
                    $doc->exportCaption($this->ISPO);
                    $doc->exportCaption($this->DOCS_TYPE);
                    $doc->exportCaption($this->PO_DATE);
                    $doc->exportCaption($this->PO_VALUE);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->INVOICE_ID2);
                    $doc->exportCaption($this->INVOICE_DATE);
                    $doc->exportCaption($this->PO);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->RECEIVED_DATE);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->PAYMENT_DUE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->RECEIVED_BY);
                    $doc->exportCaption($this->PRIORITY);
                    $doc->exportCaption($this->CREDIT_NOTE);
                    $doc->exportCaption($this->CREDIT_AMOUNT);
                    $doc->exportCaption($this->PPN);
                    $doc->exportCaption($this->MATERAI);
                    $doc->exportCaption($this->SENT_BY);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->FINANCE_ID);
                    $doc->exportCaption($this->potongan);
                    $doc->exportCaption($this->RECEIVED_VALUE);
                    $doc->exportCaption($this->NO_ORDER);
                    $doc->exportCaption($this->CONTRACT_NO);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->PPN_VALUE);
                    $doc->exportCaption($this->DISCOUNT_VALUE);
                    $doc->exportCaption($this->PAID_VALUE);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->FAKTUR_DATE);
                    $doc->exportCaption($this->DISTRIBUTION_TYPE);
                    $doc->exportCaption($this->DISCOUNTOFF_VALUE);
                    $doc->exportCaption($this->THECOUNTER);
                    $doc->exportCaption($this->FUND_ID);
                    $doc->exportCaption($this->ORDER_BY);
                    $doc->exportCaption($this->ACKNOWLEDGEBY);
                    $doc->exportCaption($this->NUM);
                    $doc->exportCaption($this->ISPO);
                    $doc->exportCaption($this->DOCS_TYPE);
                    $doc->exportCaption($this->PO_DATE);
                    $doc->exportCaption($this->PO_VALUE);
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
                        $doc->exportField($this->INVOICE_ID2);
                        $doc->exportField($this->INVOICE_DATE);
                        $doc->exportField($this->PO);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->RECEIVED_DATE);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->PAYMENT_DUE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->RECEIVED_BY);
                        $doc->exportField($this->PRIORITY);
                        $doc->exportField($this->CREDIT_NOTE);
                        $doc->exportField($this->CREDIT_AMOUNT);
                        $doc->exportField($this->PPN);
                        $doc->exportField($this->MATERAI);
                        $doc->exportField($this->SENT_BY);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->FINANCE_ID);
                        $doc->exportField($this->potongan);
                        $doc->exportField($this->RECEIVED_VALUE);
                        $doc->exportField($this->NO_ORDER);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->PPN_VALUE);
                        $doc->exportField($this->DISCOUNT_VALUE);
                        $doc->exportField($this->PAID_VALUE);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->FAKTUR_DATE);
                        $doc->exportField($this->DISTRIBUTION_TYPE);
                        $doc->exportField($this->DISCOUNTOFF_VALUE);
                        $doc->exportField($this->THECOUNTER);
                        $doc->exportField($this->FUND_ID);
                        $doc->exportField($this->ORDER_BY);
                        $doc->exportField($this->ACKNOWLEDGEBY);
                        $doc->exportField($this->NUM);
                        $doc->exportField($this->ISPO);
                        $doc->exportField($this->DOCS_TYPE);
                        $doc->exportField($this->PO_DATE);
                        $doc->exportField($this->PO_VALUE);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->INVOICE_ID2);
                        $doc->exportField($this->INVOICE_DATE);
                        $doc->exportField($this->PO);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->RECEIVED_DATE);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->PAYMENT_DUE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->RECEIVED_BY);
                        $doc->exportField($this->PRIORITY);
                        $doc->exportField($this->CREDIT_NOTE);
                        $doc->exportField($this->CREDIT_AMOUNT);
                        $doc->exportField($this->PPN);
                        $doc->exportField($this->MATERAI);
                        $doc->exportField($this->SENT_BY);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->FINANCE_ID);
                        $doc->exportField($this->potongan);
                        $doc->exportField($this->RECEIVED_VALUE);
                        $doc->exportField($this->NO_ORDER);
                        $doc->exportField($this->CONTRACT_NO);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->PPN_VALUE);
                        $doc->exportField($this->DISCOUNT_VALUE);
                        $doc->exportField($this->PAID_VALUE);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->FAKTUR_DATE);
                        $doc->exportField($this->DISTRIBUTION_TYPE);
                        $doc->exportField($this->DISCOUNTOFF_VALUE);
                        $doc->exportField($this->THECOUNTER);
                        $doc->exportField($this->FUND_ID);
                        $doc->exportField($this->ORDER_BY);
                        $doc->exportField($this->ACKNOWLEDGEBY);
                        $doc->exportField($this->NUM);
                        $doc->exportField($this->ISPO);
                        $doc->exportField($this->DOCS_TYPE);
                        $doc->exportField($this->PO_DATE);
                        $doc->exportField($this->PO_VALUE);
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
