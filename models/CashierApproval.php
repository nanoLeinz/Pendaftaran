<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for CASHIER_APPROVAL
 */
class CashierApproval extends DbTable
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
    public $TRANS_ID;
    public $COMPANY_ID;
    public $COMPANY;
    public $ACCOUNT_ID;
    public $REF_TYPE;
    public $VISIT_TRANS;
    public $CLINIC_ID;
    public $NOTA_NO;
    public $NO_REGISTRATION;
    public $THENAME;
    public $THEADDRESS;
    public $THEAGE;
    public $STATUS_PASIEN_ID;
    public $PAYOR_ID;
    public $TAGIHAN;
    public $DISKON;
    public $AMOUNT_PAID;
    public $BAYAR;
    public $RETUR;
    public $FEE;
    public $ACTIVITY_ID;
    public $YEAR_ID;
    public $MONTH_ID;
    public $TREAT_DATE;
    public $FA_V_DEBIT;
    public $FA_V_CREDIT;
    public $APPROVED_DATE;
    public $SPP_ID;
    public $SPP_NO;
    public $SPP_DATE;
    public $SPP_TYPE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'CASHIER_APPROVAL';
        $this->TableName = 'CASHIER_APPROVAL';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[CASHIER_APPROVAL]";
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
        $this->ORG_UNIT_CODE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // TRANS_ID
        $this->TRANS_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_TRANS_ID', 'TRANS_ID', '[TRANS_ID]', '[TRANS_ID]', 200, 50, -1, false, '[TRANS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TRANS_ID->IsPrimaryKey = true; // Primary key field
        $this->TRANS_ID->Nullable = false; // NOT NULL field
        $this->TRANS_ID->Required = true; // Required field
        $this->TRANS_ID->Sortable = true; // Allow sort
        $this->TRANS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TRANS_ID->Param, "CustomMsg");
        $this->Fields['TRANS_ID'] = &$this->TRANS_ID;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // COMPANY
        $this->COMPANY = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_COMPANY', 'COMPANY', '[COMPANY]', '[COMPANY]', 200, 100, -1, false, '[COMPANY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY->Sortable = true; // Allow sort
        $this->COMPANY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY->Param, "CustomMsg");
        $this->Fields['COMPANY'] = &$this->COMPANY;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // REF_TYPE
        $this->REF_TYPE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_REF_TYPE', 'REF_TYPE', '[REF_TYPE]', 'CAST([REF_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[REF_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_TYPE->Sortable = true; // Allow sort
        $this->REF_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REF_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_TYPE->Param, "CustomMsg");
        $this->Fields['REF_TYPE'] = &$this->REF_TYPE;

        // VISIT_TRANS
        $this->VISIT_TRANS = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_VISIT_TRANS', 'VISIT_TRANS', '[VISIT_TRANS]', '[VISIT_TRANS]', 200, 50, -1, false, '[VISIT_TRANS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_TRANS->Sortable = true; // Allow sort
        $this->VISIT_TRANS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_TRANS->Param, "CustomMsg");
        $this->Fields['VISIT_TRANS'] = &$this->VISIT_TRANS;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 50, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // NOTA_NO
        $this->NOTA_NO = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_NOTA_NO', 'NOTA_NO', '[NOTA_NO]', '[NOTA_NO]', 200, 50, -1, false, '[NOTA_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOTA_NO->Sortable = true; // Allow sort
        $this->NOTA_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOTA_NO->Param, "CustomMsg");
        $this->Fields['NOTA_NO'] = &$this->NOTA_NO;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // THENAME
        $this->THENAME = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // THEADDRESS
        $this->THEADDRESS = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 100, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEAGE
        $this->THEAGE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_THEAGE', 'THEAGE', '[THEAGE]', '[THEAGE]', 200, 100, -1, false, '[THEAGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEAGE->Sortable = true; // Allow sort
        $this->THEAGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEAGE->Param, "CustomMsg");
        $this->Fields['THEAGE'] = &$this->THEAGE;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 2, 2, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // PAYOR_ID
        $this->PAYOR_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_PAYOR_ID', 'PAYOR_ID', '[PAYOR_ID]', '[PAYOR_ID]', 200, 50, -1, false, '[PAYOR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYOR_ID->Sortable = true; // Allow sort
        $this->PAYOR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ID->Param, "CustomMsg");
        $this->Fields['PAYOR_ID'] = &$this->PAYOR_ID;

        // TAGIHAN
        $this->TAGIHAN = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_TAGIHAN', 'TAGIHAN', '[TAGIHAN]', 'CAST([TAGIHAN] AS NVARCHAR)', 6, 8, -1, false, '[TAGIHAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TAGIHAN->Sortable = true; // Allow sort
        $this->TAGIHAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TAGIHAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TAGIHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TAGIHAN->Param, "CustomMsg");
        $this->Fields['TAGIHAN'] = &$this->TAGIHAN;

        // DISKON
        $this->DISKON = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_DISKON', 'DISKON', '[DISKON]', 'CAST([DISKON] AS NVARCHAR)', 6, 8, -1, false, '[DISKON]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISKON->Sortable = true; // Allow sort
        $this->DISKON->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISKON->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISKON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISKON->Param, "CustomMsg");
        $this->Fields['DISKON'] = &$this->DISKON;

        // AMOUNT_PAID
        $this->AMOUNT_PAID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_AMOUNT_PAID', 'AMOUNT_PAID', '[AMOUNT_PAID]', 'CAST([AMOUNT_PAID] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_PAID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PAID->Sortable = true; // Allow sort
        $this->AMOUNT_PAID->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_PAID->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_PAID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PAID->Param, "CustomMsg");
        $this->Fields['AMOUNT_PAID'] = &$this->AMOUNT_PAID;

        // BAYAR
        $this->BAYAR = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_BAYAR', 'BAYAR', '[BAYAR]', 'CAST([BAYAR] AS NVARCHAR)', 6, 8, -1, false, '[BAYAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BAYAR->Sortable = true; // Allow sort
        $this->BAYAR->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->BAYAR->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->BAYAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BAYAR->Param, "CustomMsg");
        $this->Fields['BAYAR'] = &$this->BAYAR;

        // RETUR
        $this->RETUR = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_RETUR', 'RETUR', '[RETUR]', 'CAST([RETUR] AS NVARCHAR)', 6, 8, -1, false, '[RETUR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RETUR->Sortable = true; // Allow sort
        $this->RETUR->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->RETUR->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->RETUR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RETUR->Param, "CustomMsg");
        $this->Fields['RETUR'] = &$this->RETUR;

        // FEE
        $this->FEE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_FEE', 'FEE', '[FEE]', 'CAST([FEE] AS NVARCHAR)', 6, 8, -1, false, '[FEE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FEE->Sortable = true; // Allow sort
        $this->FEE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->FEE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->FEE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FEE->Param, "CustomMsg");
        $this->Fields['FEE'] = &$this->FEE;

        // ACTIVITY_ID
        $this->ACTIVITY_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_ACTIVITY_ID', 'ACTIVITY_ID', '[ACTIVITY_ID]', 'CAST([ACTIVITY_ID] AS NVARCHAR)', 2, 2, -1, false, '[ACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACTIVITY_ID->Sortable = true; // Allow sort
        $this->ACTIVITY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['ACTIVITY_ID'] = &$this->ACTIVITY_ID;

        // YEAR_ID
        $this->YEAR_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // MONTH_ID
        $this->MONTH_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_MONTH_ID', 'MONTH_ID', '[MONTH_ID]', 'CAST([MONTH_ID] AS NVARCHAR)', 17, 1, -1, false, '[MONTH_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MONTH_ID->Sortable = true; // Allow sort
        $this->MONTH_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MONTH_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MONTH_ID->Param, "CustomMsg");
        $this->Fields['MONTH_ID'] = &$this->MONTH_ID;

        // TREAT_DATE
        $this->TREAT_DATE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_TREAT_DATE', 'TREAT_DATE', '[TREAT_DATE]', CastDateFieldForLike("[TREAT_DATE]", 0, "DB"), 135, 8, 0, false, '[TREAT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREAT_DATE->Sortable = true; // Allow sort
        $this->TREAT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TREAT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREAT_DATE->Param, "CustomMsg");
        $this->Fields['TREAT_DATE'] = &$this->TREAT_DATE;

        // FA_V_DEBIT
        $this->FA_V_DEBIT = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_FA_V_DEBIT', 'FA_V_DEBIT', '[FA_V_DEBIT]', '[FA_V_DEBIT]', 200, 50, -1, false, '[FA_V_DEBIT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V_DEBIT->Sortable = true; // Allow sort
        $this->FA_V_DEBIT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V_DEBIT->Param, "CustomMsg");
        $this->Fields['FA_V_DEBIT'] = &$this->FA_V_DEBIT;

        // FA_V_CREDIT
        $this->FA_V_CREDIT = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_FA_V_CREDIT', 'FA_V_CREDIT', '[FA_V_CREDIT]', '[FA_V_CREDIT]', 200, 50, -1, false, '[FA_V_CREDIT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V_CREDIT->Sortable = true; // Allow sort
        $this->FA_V_CREDIT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V_CREDIT->Param, "CustomMsg");
        $this->Fields['FA_V_CREDIT'] = &$this->FA_V_CREDIT;

        // APPROVED_DATE
        $this->APPROVED_DATE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_APPROVED_DATE', 'APPROVED_DATE', '[APPROVED_DATE]', CastDateFieldForLike("[APPROVED_DATE]", 0, "DB"), 135, 8, 0, false, '[APPROVED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVED_DATE->Sortable = true; // Allow sort
        $this->APPROVED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->APPROVED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVED_DATE->Param, "CustomMsg");
        $this->Fields['APPROVED_DATE'] = &$this->APPROVED_DATE;

        // SPP_ID
        $this->SPP_ID = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_SPP_ID', 'SPP_ID', '[SPP_ID]', '[SPP_ID]', 200, 50, -1, false, '[SPP_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_ID->Sortable = true; // Allow sort
        $this->SPP_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_ID->Param, "CustomMsg");
        $this->Fields['SPP_ID'] = &$this->SPP_ID;

        // SPP_NO
        $this->SPP_NO = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_SPP_NO', 'SPP_NO', '[SPP_NO]', '[SPP_NO]', 200, 50, -1, false, '[SPP_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_NO->Sortable = true; // Allow sort
        $this->SPP_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_NO->Param, "CustomMsg");
        $this->Fields['SPP_NO'] = &$this->SPP_NO;

        // SPP_DATE
        $this->SPP_DATE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_SPP_DATE', 'SPP_DATE', '[SPP_DATE]', CastDateFieldForLike("[SPP_DATE]", 0, "DB"), 135, 8, 0, false, '[SPP_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_DATE->Sortable = true; // Allow sort
        $this->SPP_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SPP_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_DATE->Param, "CustomMsg");
        $this->Fields['SPP_DATE'] = &$this->SPP_DATE;

        // SPP_TYPE
        $this->SPP_TYPE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_SPP_TYPE', 'SPP_TYPE', '[SPP_TYPE]', 'CAST([SPP_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[SPP_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_TYPE->Sortable = true; // Allow sort
        $this->SPP_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SPP_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_TYPE->Param, "CustomMsg");
        $this->Fields['SPP_TYPE'] = &$this->SPP_TYPE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('CASHIER_APPROVAL', 'CASHIER_APPROVAL', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[CASHIER_APPROVAL]";
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
            if (array_key_exists('TRANS_ID', $rs)) {
                AddFilter($where, QuotedName('TRANS_ID', $this->Dbid) . '=' . QuotedValue($rs['TRANS_ID'], $this->TRANS_ID->DataType, $this->Dbid));
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
        $this->TRANS_ID->DbValue = $row['TRANS_ID'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->COMPANY->DbValue = $row['COMPANY'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->REF_TYPE->DbValue = $row['REF_TYPE'];
        $this->VISIT_TRANS->DbValue = $row['VISIT_TRANS'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->NOTA_NO->DbValue = $row['NOTA_NO'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->THENAME->DbValue = $row['THENAME'];
        $this->THEADDRESS->DbValue = $row['THEADDRESS'];
        $this->THEAGE->DbValue = $row['THEAGE'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->PAYOR_ID->DbValue = $row['PAYOR_ID'];
        $this->TAGIHAN->DbValue = $row['TAGIHAN'];
        $this->DISKON->DbValue = $row['DISKON'];
        $this->AMOUNT_PAID->DbValue = $row['AMOUNT_PAID'];
        $this->BAYAR->DbValue = $row['BAYAR'];
        $this->RETUR->DbValue = $row['RETUR'];
        $this->FEE->DbValue = $row['FEE'];
        $this->ACTIVITY_ID->DbValue = $row['ACTIVITY_ID'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->MONTH_ID->DbValue = $row['MONTH_ID'];
        $this->TREAT_DATE->DbValue = $row['TREAT_DATE'];
        $this->FA_V_DEBIT->DbValue = $row['FA_V_DEBIT'];
        $this->FA_V_CREDIT->DbValue = $row['FA_V_CREDIT'];
        $this->APPROVED_DATE->DbValue = $row['APPROVED_DATE'];
        $this->SPP_ID->DbValue = $row['SPP_ID'];
        $this->SPP_NO->DbValue = $row['SPP_NO'];
        $this->SPP_DATE->DbValue = $row['SPP_DATE'];
        $this->SPP_TYPE->DbValue = $row['SPP_TYPE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [TRANS_ID] = '@TRANS_ID@'";
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
        $val = $current ? $this->TRANS_ID->CurrentValue : $this->TRANS_ID->OldValue;
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
                $this->TRANS_ID->CurrentValue = $keys[1];
            } else {
                $this->TRANS_ID->OldValue = $keys[1];
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
            $val = array_key_exists('TRANS_ID', $row) ? $row['TRANS_ID'] : null;
        } else {
            $val = $this->TRANS_ID->OldValue !== null ? $this->TRANS_ID->OldValue : $this->TRANS_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@TRANS_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("CashierApprovalList");
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
        if ($pageName == "CashierApprovalView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CashierApprovalEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CashierApprovalAdd") {
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
                return "CashierApprovalView";
            case Config("API_ADD_ACTION"):
                return "CashierApprovalAdd";
            case Config("API_EDIT_ACTION"):
                return "CashierApprovalEdit";
            case Config("API_DELETE_ACTION"):
                return "CashierApprovalDelete";
            case Config("API_LIST_ACTION"):
                return "CashierApprovalList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CashierApprovalList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CashierApprovalView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CashierApprovalView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CashierApprovalAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CashierApprovalAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CashierApprovalEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CashierApprovalAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CashierApprovalDelete", $this->getUrlParm());
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
        $json .= ",TRANS_ID:" . JsonEncode($this->TRANS_ID->CurrentValue, "string");
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
        if ($this->TRANS_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->TRANS_ID->CurrentValue);
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
            if (($keyValue = Param("TRANS_ID") ?? Route("TRANS_ID")) !== null) {
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
                $this->TRANS_ID->CurrentValue = $key[1];
            } else {
                $this->TRANS_ID->OldValue = $key[1];
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
        $this->TRANS_ID->setDbValue($row['TRANS_ID']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->COMPANY->setDbValue($row['COMPANY']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->REF_TYPE->setDbValue($row['REF_TYPE']);
        $this->VISIT_TRANS->setDbValue($row['VISIT_TRANS']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->NOTA_NO->setDbValue($row['NOTA_NO']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEAGE->setDbValue($row['THEAGE']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->TAGIHAN->setDbValue($row['TAGIHAN']);
        $this->DISKON->setDbValue($row['DISKON']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
        $this->BAYAR->setDbValue($row['BAYAR']);
        $this->RETUR->setDbValue($row['RETUR']);
        $this->FEE->setDbValue($row['FEE']);
        $this->ACTIVITY_ID->setDbValue($row['ACTIVITY_ID']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->MONTH_ID->setDbValue($row['MONTH_ID']);
        $this->TREAT_DATE->setDbValue($row['TREAT_DATE']);
        $this->FA_V_DEBIT->setDbValue($row['FA_V_DEBIT']);
        $this->FA_V_CREDIT->setDbValue($row['FA_V_CREDIT']);
        $this->APPROVED_DATE->setDbValue($row['APPROVED_DATE']);
        $this->SPP_ID->setDbValue($row['SPP_ID']);
        $this->SPP_NO->setDbValue($row['SPP_NO']);
        $this->SPP_DATE->setDbValue($row['SPP_DATE']);
        $this->SPP_TYPE->setDbValue($row['SPP_TYPE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // TRANS_ID

        // COMPANY_ID

        // COMPANY

        // ACCOUNT_ID

        // REF_TYPE

        // VISIT_TRANS

        // CLINIC_ID

        // NOTA_NO

        // NO_REGISTRATION

        // THENAME

        // THEADDRESS

        // THEAGE

        // STATUS_PASIEN_ID

        // PAYOR_ID

        // TAGIHAN

        // DISKON

        // AMOUNT_PAID

        // BAYAR

        // RETUR

        // FEE

        // ACTIVITY_ID

        // YEAR_ID

        // MONTH_ID

        // TREAT_DATE

        // FA_V_DEBIT

        // FA_V_CREDIT

        // APPROVED_DATE

        // SPP_ID

        // SPP_NO

        // SPP_DATE

        // SPP_TYPE

        // MODIFIED_DATE

        // MODIFIED_BY

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // TRANS_ID
        $this->TRANS_ID->ViewValue = $this->TRANS_ID->CurrentValue;
        $this->TRANS_ID->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // COMPANY
        $this->COMPANY->ViewValue = $this->COMPANY->CurrentValue;
        $this->COMPANY->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // REF_TYPE
        $this->REF_TYPE->ViewValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->ViewValue = FormatNumber($this->REF_TYPE->ViewValue, 0, -2, -2, -2);
        $this->REF_TYPE->ViewCustomAttributes = "";

        // VISIT_TRANS
        $this->VISIT_TRANS->ViewValue = $this->VISIT_TRANS->CurrentValue;
        $this->VISIT_TRANS->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // NOTA_NO
        $this->NOTA_NO->ViewValue = $this->NOTA_NO->CurrentValue;
        $this->NOTA_NO->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // THENAME
        $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
        $this->THENAME->ViewCustomAttributes = "";

        // THEADDRESS
        $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
        $this->THEADDRESS->ViewCustomAttributes = "";

        // THEAGE
        $this->THEAGE->ViewValue = $this->THEAGE->CurrentValue;
        $this->THEAGE->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // PAYOR_ID
        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->ViewCustomAttributes = "";

        // TAGIHAN
        $this->TAGIHAN->ViewValue = $this->TAGIHAN->CurrentValue;
        $this->TAGIHAN->ViewValue = FormatNumber($this->TAGIHAN->ViewValue, 2, -2, -2, -2);
        $this->TAGIHAN->ViewCustomAttributes = "";

        // DISKON
        $this->DISKON->ViewValue = $this->DISKON->CurrentValue;
        $this->DISKON->ViewValue = FormatNumber($this->DISKON->ViewValue, 2, -2, -2, -2);
        $this->DISKON->ViewCustomAttributes = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->ViewValue = FormatNumber($this->AMOUNT_PAID->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_PAID->ViewCustomAttributes = "";

        // BAYAR
        $this->BAYAR->ViewValue = $this->BAYAR->CurrentValue;
        $this->BAYAR->ViewValue = FormatNumber($this->BAYAR->ViewValue, 2, -2, -2, -2);
        $this->BAYAR->ViewCustomAttributes = "";

        // RETUR
        $this->RETUR->ViewValue = $this->RETUR->CurrentValue;
        $this->RETUR->ViewValue = FormatNumber($this->RETUR->ViewValue, 2, -2, -2, -2);
        $this->RETUR->ViewCustomAttributes = "";

        // FEE
        $this->FEE->ViewValue = $this->FEE->CurrentValue;
        $this->FEE->ViewValue = FormatNumber($this->FEE->ViewValue, 2, -2, -2, -2);
        $this->FEE->ViewCustomAttributes = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->ViewValue = FormatNumber($this->ACTIVITY_ID->ViewValue, 0, -2, -2, -2);
        $this->ACTIVITY_ID->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // MONTH_ID
        $this->MONTH_ID->ViewValue = $this->MONTH_ID->CurrentValue;
        $this->MONTH_ID->ViewValue = FormatNumber($this->MONTH_ID->ViewValue, 0, -2, -2, -2);
        $this->MONTH_ID->ViewCustomAttributes = "";

        // TREAT_DATE
        $this->TREAT_DATE->ViewValue = $this->TREAT_DATE->CurrentValue;
        $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 0);
        $this->TREAT_DATE->ViewCustomAttributes = "";

        // FA_V_DEBIT
        $this->FA_V_DEBIT->ViewValue = $this->FA_V_DEBIT->CurrentValue;
        $this->FA_V_DEBIT->ViewCustomAttributes = "";

        // FA_V_CREDIT
        $this->FA_V_CREDIT->ViewValue = $this->FA_V_CREDIT->CurrentValue;
        $this->FA_V_CREDIT->ViewCustomAttributes = "";

        // APPROVED_DATE
        $this->APPROVED_DATE->ViewValue = $this->APPROVED_DATE->CurrentValue;
        $this->APPROVED_DATE->ViewValue = FormatDateTime($this->APPROVED_DATE->ViewValue, 0);
        $this->APPROVED_DATE->ViewCustomAttributes = "";

        // SPP_ID
        $this->SPP_ID->ViewValue = $this->SPP_ID->CurrentValue;
        $this->SPP_ID->ViewCustomAttributes = "";

        // SPP_NO
        $this->SPP_NO->ViewValue = $this->SPP_NO->CurrentValue;
        $this->SPP_NO->ViewCustomAttributes = "";

        // SPP_DATE
        $this->SPP_DATE->ViewValue = $this->SPP_DATE->CurrentValue;
        $this->SPP_DATE->ViewValue = FormatDateTime($this->SPP_DATE->ViewValue, 0);
        $this->SPP_DATE->ViewCustomAttributes = "";

        // SPP_TYPE
        $this->SPP_TYPE->ViewValue = $this->SPP_TYPE->CurrentValue;
        $this->SPP_TYPE->ViewValue = FormatNumber($this->SPP_TYPE->ViewValue, 0, -2, -2, -2);
        $this->SPP_TYPE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // TRANS_ID
        $this->TRANS_ID->LinkCustomAttributes = "";
        $this->TRANS_ID->HrefValue = "";
        $this->TRANS_ID->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // COMPANY
        $this->COMPANY->LinkCustomAttributes = "";
        $this->COMPANY->HrefValue = "";
        $this->COMPANY->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // REF_TYPE
        $this->REF_TYPE->LinkCustomAttributes = "";
        $this->REF_TYPE->HrefValue = "";
        $this->REF_TYPE->TooltipValue = "";

        // VISIT_TRANS
        $this->VISIT_TRANS->LinkCustomAttributes = "";
        $this->VISIT_TRANS->HrefValue = "";
        $this->VISIT_TRANS->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // NOTA_NO
        $this->NOTA_NO->LinkCustomAttributes = "";
        $this->NOTA_NO->HrefValue = "";
        $this->NOTA_NO->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // THENAME
        $this->THENAME->LinkCustomAttributes = "";
        $this->THENAME->HrefValue = "";
        $this->THENAME->TooltipValue = "";

        // THEADDRESS
        $this->THEADDRESS->LinkCustomAttributes = "";
        $this->THEADDRESS->HrefValue = "";
        $this->THEADDRESS->TooltipValue = "";

        // THEAGE
        $this->THEAGE->LinkCustomAttributes = "";
        $this->THEAGE->HrefValue = "";
        $this->THEAGE->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // PAYOR_ID
        $this->PAYOR_ID->LinkCustomAttributes = "";
        $this->PAYOR_ID->HrefValue = "";
        $this->PAYOR_ID->TooltipValue = "";

        // TAGIHAN
        $this->TAGIHAN->LinkCustomAttributes = "";
        $this->TAGIHAN->HrefValue = "";
        $this->TAGIHAN->TooltipValue = "";

        // DISKON
        $this->DISKON->LinkCustomAttributes = "";
        $this->DISKON->HrefValue = "";
        $this->DISKON->TooltipValue = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->LinkCustomAttributes = "";
        $this->AMOUNT_PAID->HrefValue = "";
        $this->AMOUNT_PAID->TooltipValue = "";

        // BAYAR
        $this->BAYAR->LinkCustomAttributes = "";
        $this->BAYAR->HrefValue = "";
        $this->BAYAR->TooltipValue = "";

        // RETUR
        $this->RETUR->LinkCustomAttributes = "";
        $this->RETUR->HrefValue = "";
        $this->RETUR->TooltipValue = "";

        // FEE
        $this->FEE->LinkCustomAttributes = "";
        $this->FEE->HrefValue = "";
        $this->FEE->TooltipValue = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->LinkCustomAttributes = "";
        $this->ACTIVITY_ID->HrefValue = "";
        $this->ACTIVITY_ID->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // MONTH_ID
        $this->MONTH_ID->LinkCustomAttributes = "";
        $this->MONTH_ID->HrefValue = "";
        $this->MONTH_ID->TooltipValue = "";

        // TREAT_DATE
        $this->TREAT_DATE->LinkCustomAttributes = "";
        $this->TREAT_DATE->HrefValue = "";
        $this->TREAT_DATE->TooltipValue = "";

        // FA_V_DEBIT
        $this->FA_V_DEBIT->LinkCustomAttributes = "";
        $this->FA_V_DEBIT->HrefValue = "";
        $this->FA_V_DEBIT->TooltipValue = "";

        // FA_V_CREDIT
        $this->FA_V_CREDIT->LinkCustomAttributes = "";
        $this->FA_V_CREDIT->HrefValue = "";
        $this->FA_V_CREDIT->TooltipValue = "";

        // APPROVED_DATE
        $this->APPROVED_DATE->LinkCustomAttributes = "";
        $this->APPROVED_DATE->HrefValue = "";
        $this->APPROVED_DATE->TooltipValue = "";

        // SPP_ID
        $this->SPP_ID->LinkCustomAttributes = "";
        $this->SPP_ID->HrefValue = "";
        $this->SPP_ID->TooltipValue = "";

        // SPP_NO
        $this->SPP_NO->LinkCustomAttributes = "";
        $this->SPP_NO->HrefValue = "";
        $this->SPP_NO->TooltipValue = "";

        // SPP_DATE
        $this->SPP_DATE->LinkCustomAttributes = "";
        $this->SPP_DATE->HrefValue = "";
        $this->SPP_DATE->TooltipValue = "";

        // SPP_TYPE
        $this->SPP_TYPE->LinkCustomAttributes = "";
        $this->SPP_TYPE->HrefValue = "";
        $this->SPP_TYPE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

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

        // TRANS_ID
        $this->TRANS_ID->EditAttrs["class"] = "form-control";
        $this->TRANS_ID->EditCustomAttributes = "";
        if (!$this->TRANS_ID->Raw) {
            $this->TRANS_ID->CurrentValue = HtmlDecode($this->TRANS_ID->CurrentValue);
        }
        $this->TRANS_ID->EditValue = $this->TRANS_ID->CurrentValue;
        $this->TRANS_ID->PlaceHolder = RemoveHtml($this->TRANS_ID->caption());

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

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // REF_TYPE
        $this->REF_TYPE->EditAttrs["class"] = "form-control";
        $this->REF_TYPE->EditCustomAttributes = "";
        $this->REF_TYPE->EditValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->PlaceHolder = RemoveHtml($this->REF_TYPE->caption());

        // VISIT_TRANS
        $this->VISIT_TRANS->EditAttrs["class"] = "form-control";
        $this->VISIT_TRANS->EditCustomAttributes = "";
        if (!$this->VISIT_TRANS->Raw) {
            $this->VISIT_TRANS->CurrentValue = HtmlDecode($this->VISIT_TRANS->CurrentValue);
        }
        $this->VISIT_TRANS->EditValue = $this->VISIT_TRANS->CurrentValue;
        $this->VISIT_TRANS->PlaceHolder = RemoveHtml($this->VISIT_TRANS->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // NOTA_NO
        $this->NOTA_NO->EditAttrs["class"] = "form-control";
        $this->NOTA_NO->EditCustomAttributes = "";
        if (!$this->NOTA_NO->Raw) {
            $this->NOTA_NO->CurrentValue = HtmlDecode($this->NOTA_NO->CurrentValue);
        }
        $this->NOTA_NO->EditValue = $this->NOTA_NO->CurrentValue;
        $this->NOTA_NO->PlaceHolder = RemoveHtml($this->NOTA_NO->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // THENAME
        $this->THENAME->EditAttrs["class"] = "form-control";
        $this->THENAME->EditCustomAttributes = "";
        if (!$this->THENAME->Raw) {
            $this->THENAME->CurrentValue = HtmlDecode($this->THENAME->CurrentValue);
        }
        $this->THENAME->EditValue = $this->THENAME->CurrentValue;
        $this->THENAME->PlaceHolder = RemoveHtml($this->THENAME->caption());

        // THEADDRESS
        $this->THEADDRESS->EditAttrs["class"] = "form-control";
        $this->THEADDRESS->EditCustomAttributes = "";
        if (!$this->THEADDRESS->Raw) {
            $this->THEADDRESS->CurrentValue = HtmlDecode($this->THEADDRESS->CurrentValue);
        }
        $this->THEADDRESS->EditValue = $this->THEADDRESS->CurrentValue;
        $this->THEADDRESS->PlaceHolder = RemoveHtml($this->THEADDRESS->caption());

        // THEAGE
        $this->THEAGE->EditAttrs["class"] = "form-control";
        $this->THEAGE->EditCustomAttributes = "";
        if (!$this->THEAGE->Raw) {
            $this->THEAGE->CurrentValue = HtmlDecode($this->THEAGE->CurrentValue);
        }
        $this->THEAGE->EditValue = $this->THEAGE->CurrentValue;
        $this->THEAGE->PlaceHolder = RemoveHtml($this->THEAGE->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // PAYOR_ID
        $this->PAYOR_ID->EditAttrs["class"] = "form-control";
        $this->PAYOR_ID->EditCustomAttributes = "";
        if (!$this->PAYOR_ID->Raw) {
            $this->PAYOR_ID->CurrentValue = HtmlDecode($this->PAYOR_ID->CurrentValue);
        }
        $this->PAYOR_ID->EditValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

        // TAGIHAN
        $this->TAGIHAN->EditAttrs["class"] = "form-control";
        $this->TAGIHAN->EditCustomAttributes = "";
        $this->TAGIHAN->EditValue = $this->TAGIHAN->CurrentValue;
        $this->TAGIHAN->PlaceHolder = RemoveHtml($this->TAGIHAN->caption());
        if (strval($this->TAGIHAN->EditValue) != "" && is_numeric($this->TAGIHAN->EditValue)) {
            $this->TAGIHAN->EditValue = FormatNumber($this->TAGIHAN->EditValue, -2, -2, -2, -2);
        }

        // DISKON
        $this->DISKON->EditAttrs["class"] = "form-control";
        $this->DISKON->EditCustomAttributes = "";
        $this->DISKON->EditValue = $this->DISKON->CurrentValue;
        $this->DISKON->PlaceHolder = RemoveHtml($this->DISKON->caption());
        if (strval($this->DISKON->EditValue) != "" && is_numeric($this->DISKON->EditValue)) {
            $this->DISKON->EditValue = FormatNumber($this->DISKON->EditValue, -2, -2, -2, -2);
        }

        // AMOUNT_PAID
        $this->AMOUNT_PAID->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PAID->EditCustomAttributes = "";
        $this->AMOUNT_PAID->EditValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->PlaceHolder = RemoveHtml($this->AMOUNT_PAID->caption());
        if (strval($this->AMOUNT_PAID->EditValue) != "" && is_numeric($this->AMOUNT_PAID->EditValue)) {
            $this->AMOUNT_PAID->EditValue = FormatNumber($this->AMOUNT_PAID->EditValue, -2, -2, -2, -2);
        }

        // BAYAR
        $this->BAYAR->EditAttrs["class"] = "form-control";
        $this->BAYAR->EditCustomAttributes = "";
        $this->BAYAR->EditValue = $this->BAYAR->CurrentValue;
        $this->BAYAR->PlaceHolder = RemoveHtml($this->BAYAR->caption());
        if (strval($this->BAYAR->EditValue) != "" && is_numeric($this->BAYAR->EditValue)) {
            $this->BAYAR->EditValue = FormatNumber($this->BAYAR->EditValue, -2, -2, -2, -2);
        }

        // RETUR
        $this->RETUR->EditAttrs["class"] = "form-control";
        $this->RETUR->EditCustomAttributes = "";
        $this->RETUR->EditValue = $this->RETUR->CurrentValue;
        $this->RETUR->PlaceHolder = RemoveHtml($this->RETUR->caption());
        if (strval($this->RETUR->EditValue) != "" && is_numeric($this->RETUR->EditValue)) {
            $this->RETUR->EditValue = FormatNumber($this->RETUR->EditValue, -2, -2, -2, -2);
        }

        // FEE
        $this->FEE->EditAttrs["class"] = "form-control";
        $this->FEE->EditCustomAttributes = "";
        $this->FEE->EditValue = $this->FEE->CurrentValue;
        $this->FEE->PlaceHolder = RemoveHtml($this->FEE->caption());
        if (strval($this->FEE->EditValue) != "" && is_numeric($this->FEE->EditValue)) {
            $this->FEE->EditValue = FormatNumber($this->FEE->EditValue, -2, -2, -2, -2);
        }

        // ACTIVITY_ID
        $this->ACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->ACTIVITY_ID->EditCustomAttributes = "";
        $this->ACTIVITY_ID->EditValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->PlaceHolder = RemoveHtml($this->ACTIVITY_ID->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // MONTH_ID
        $this->MONTH_ID->EditAttrs["class"] = "form-control";
        $this->MONTH_ID->EditCustomAttributes = "";
        $this->MONTH_ID->EditValue = $this->MONTH_ID->CurrentValue;
        $this->MONTH_ID->PlaceHolder = RemoveHtml($this->MONTH_ID->caption());

        // TREAT_DATE
        $this->TREAT_DATE->EditAttrs["class"] = "form-control";
        $this->TREAT_DATE->EditCustomAttributes = "";
        $this->TREAT_DATE->EditValue = FormatDateTime($this->TREAT_DATE->CurrentValue, 8);
        $this->TREAT_DATE->PlaceHolder = RemoveHtml($this->TREAT_DATE->caption());

        // FA_V_DEBIT
        $this->FA_V_DEBIT->EditAttrs["class"] = "form-control";
        $this->FA_V_DEBIT->EditCustomAttributes = "";
        if (!$this->FA_V_DEBIT->Raw) {
            $this->FA_V_DEBIT->CurrentValue = HtmlDecode($this->FA_V_DEBIT->CurrentValue);
        }
        $this->FA_V_DEBIT->EditValue = $this->FA_V_DEBIT->CurrentValue;
        $this->FA_V_DEBIT->PlaceHolder = RemoveHtml($this->FA_V_DEBIT->caption());

        // FA_V_CREDIT
        $this->FA_V_CREDIT->EditAttrs["class"] = "form-control";
        $this->FA_V_CREDIT->EditCustomAttributes = "";
        if (!$this->FA_V_CREDIT->Raw) {
            $this->FA_V_CREDIT->CurrentValue = HtmlDecode($this->FA_V_CREDIT->CurrentValue);
        }
        $this->FA_V_CREDIT->EditValue = $this->FA_V_CREDIT->CurrentValue;
        $this->FA_V_CREDIT->PlaceHolder = RemoveHtml($this->FA_V_CREDIT->caption());

        // APPROVED_DATE
        $this->APPROVED_DATE->EditAttrs["class"] = "form-control";
        $this->APPROVED_DATE->EditCustomAttributes = "";
        $this->APPROVED_DATE->EditValue = FormatDateTime($this->APPROVED_DATE->CurrentValue, 8);
        $this->APPROVED_DATE->PlaceHolder = RemoveHtml($this->APPROVED_DATE->caption());

        // SPP_ID
        $this->SPP_ID->EditAttrs["class"] = "form-control";
        $this->SPP_ID->EditCustomAttributes = "";
        if (!$this->SPP_ID->Raw) {
            $this->SPP_ID->CurrentValue = HtmlDecode($this->SPP_ID->CurrentValue);
        }
        $this->SPP_ID->EditValue = $this->SPP_ID->CurrentValue;
        $this->SPP_ID->PlaceHolder = RemoveHtml($this->SPP_ID->caption());

        // SPP_NO
        $this->SPP_NO->EditAttrs["class"] = "form-control";
        $this->SPP_NO->EditCustomAttributes = "";
        if (!$this->SPP_NO->Raw) {
            $this->SPP_NO->CurrentValue = HtmlDecode($this->SPP_NO->CurrentValue);
        }
        $this->SPP_NO->EditValue = $this->SPP_NO->CurrentValue;
        $this->SPP_NO->PlaceHolder = RemoveHtml($this->SPP_NO->caption());

        // SPP_DATE
        $this->SPP_DATE->EditAttrs["class"] = "form-control";
        $this->SPP_DATE->EditCustomAttributes = "";
        $this->SPP_DATE->EditValue = FormatDateTime($this->SPP_DATE->CurrentValue, 8);
        $this->SPP_DATE->PlaceHolder = RemoveHtml($this->SPP_DATE->caption());

        // SPP_TYPE
        $this->SPP_TYPE->EditAttrs["class"] = "form-control";
        $this->SPP_TYPE->EditCustomAttributes = "";
        $this->SPP_TYPE->EditValue = $this->SPP_TYPE->CurrentValue;
        $this->SPP_TYPE->PlaceHolder = RemoveHtml($this->SPP_TYPE->caption());

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
                    $doc->exportCaption($this->TRANS_ID);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->VISIT_TRANS);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->NOTA_NO);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEAGE);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->TAGIHAN);
                    $doc->exportCaption($this->DISKON);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->BAYAR);
                    $doc->exportCaption($this->RETUR);
                    $doc->exportCaption($this->FEE);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->MONTH_ID);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->FA_V_DEBIT);
                    $doc->exportCaption($this->FA_V_CREDIT);
                    $doc->exportCaption($this->APPROVED_DATE);
                    $doc->exportCaption($this->SPP_ID);
                    $doc->exportCaption($this->SPP_NO);
                    $doc->exportCaption($this->SPP_DATE);
                    $doc->exportCaption($this->SPP_TYPE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->TRANS_ID);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->VISIT_TRANS);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->NOTA_NO);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEAGE);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->TAGIHAN);
                    $doc->exportCaption($this->DISKON);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->BAYAR);
                    $doc->exportCaption($this->RETUR);
                    $doc->exportCaption($this->FEE);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->MONTH_ID);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->FA_V_DEBIT);
                    $doc->exportCaption($this->FA_V_CREDIT);
                    $doc->exportCaption($this->APPROVED_DATE);
                    $doc->exportCaption($this->SPP_ID);
                    $doc->exportCaption($this->SPP_NO);
                    $doc->exportCaption($this->SPP_DATE);
                    $doc->exportCaption($this->SPP_TYPE);
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
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->TRANS_ID);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->VISIT_TRANS);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->NOTA_NO);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEAGE);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->TAGIHAN);
                        $doc->exportField($this->DISKON);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->BAYAR);
                        $doc->exportField($this->RETUR);
                        $doc->exportField($this->FEE);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->MONTH_ID);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->FA_V_DEBIT);
                        $doc->exportField($this->FA_V_CREDIT);
                        $doc->exportField($this->APPROVED_DATE);
                        $doc->exportField($this->SPP_ID);
                        $doc->exportField($this->SPP_NO);
                        $doc->exportField($this->SPP_DATE);
                        $doc->exportField($this->SPP_TYPE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->TRANS_ID);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->VISIT_TRANS);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->NOTA_NO);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEAGE);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->TAGIHAN);
                        $doc->exportField($this->DISKON);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->BAYAR);
                        $doc->exportField($this->RETUR);
                        $doc->exportField($this->FEE);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->MONTH_ID);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->FA_V_DEBIT);
                        $doc->exportField($this->FA_V_CREDIT);
                        $doc->exportField($this->APPROVED_DATE);
                        $doc->exportField($this->SPP_ID);
                        $doc->exportField($this->SPP_NO);
                        $doc->exportField($this->SPP_DATE);
                        $doc->exportField($this->SPP_TYPE);
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
