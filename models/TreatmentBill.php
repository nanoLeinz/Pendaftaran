<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for TREATMENT_BILL
 */
class TreatmentBill extends DbTable
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
    public $BILL_ID;
    public $NO_REGISTRATION;
    public $VISIT_ID;
    public $TARIF_ID;
    public $CLASS_ID;
    public $CLINIC_ID;
    public $CLINIC_ID_FROM;
    public $TREATMENT;
    public $TREAT_DATE;
    public $AMOUNT;
    public $QUANTITY;
    public $MEASURE_ID;
    public $POKOK_JUAL;
    public $PPN;
    public $MARGIN;
    public $SUBSIDI;
    public $EMBALACE;
    public $PROFESI;
    public $DISCOUNT;
    public $PAY_METHOD_ID;
    public $PAYMENT_DATE;
    public $ISLUNAS;
    public $DUEDATE_ANGSURAN;
    public $DESCRIPTION;
    public $KUITANSI_ID;
    public $NOTA_NO;
    public $ISCETAK;
    public $PRINT_DATE;
    public $RESEP_NO;
    public $RESEP_KE;
    public $DOSE;
    public $ORIG_DOSE;
    public $DOSE_PRESC;
    public $ITER;
    public $ITER_KE;
    public $SOLD_STATUS;
    public $RACIKAN;
    public $CLASS_ROOM_ID;
    public $KELUAR_ID;
    public $BED_ID;
    public $PERDA_ID;
    public $EMPLOYEE_ID;
    public $DESCRIPTION2;
    public $MODIFIED_BY;
    public $MODIFIED_DATE;
    public $MODIFIED_FROM;
    public $BRAND_ID;
    public $DOCTOR;
    public $JML_BKS;
    public $EXIT_DATE;
    public $FA_V;
    public $TASK_ID;
    public $EMPLOYEE_ID_FROM;
    public $DOCTOR_FROM;
    public $status_pasien_id;
    public $amount_paid;
    public $THENAME;
    public $THEADDRESS;
    public $THEID;
    public $serial_nb;
    public $TREATMENT_PLAFOND;
    public $AMOUNT_PLAFOND;
    public $AMOUNT_PAID_PLAFOND;
    public $CLASS_ID_PLAFOND;
    public $PAYOR_ID;
    public $PEMBULATAN;
    public $ISRJ;
    public $AGEYEAR;
    public $AGEMONTH;
    public $AGEDAY;
    public $GENDER;
    public $KAL_ID;
    public $CORRECTION_ID;
    public $CORRECTION_BY;
    public $KARYAWAN;
    public $ACCOUNT_ID;
    public $sell_price;
    public $diskon;
    public $INVOICE_ID;
    public $NUMER;
    public $MEASURE_ID2;
    public $POTONGAN;
    public $BAYAR;
    public $RETUR;
    public $TARIF_TYPE;
    public $PPNVALUE;
    public $TAGIHAN;
    public $KOREKSI;
    public $STATUS_OBAT;
    public $SUBSIDISAT;
    public $PRINTQ;
    public $PRINTED_BY;
    public $STOCK_AVAILABLE;
    public $STATUS_TARIF;
    public $CLINIC_TYPE;
    public $PACKAGE_ID;
    public $MODULE_ID;
    public $profession;
    public $THEORDER;
    public $CASHIER;
    public $SPPFEE;
    public $SPPBILL;
    public $SPPRJK;
    public $SPPJMN;
    public $SPPKASIR;
    public $PERUJUK;
    public $PERUJUKFEE;
    public $modified_datesys;
    public $TRANS_ID;
    public $SPPBILLDATE;
    public $SPPBILLUSER;
    public $SPPKASIRDATE;
    public $SPPKASIRUSER;
    public $SPPPOLI;
    public $SPPPOLIUSER;
    public $SPPPOLIDATE;
    public $nota_temp;
    public $CLINIC_ID_TEMP;
    public $NOSEP;
    public $ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'TREATMENT_BILL';
        $this->TableName = 'TREATMENT_BILL';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[TREATMENT_BILL]";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = true; // Allow detail add
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Sortable = false; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // BILL_ID
        $this->BILL_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_BILL_ID', 'BILL_ID', '[BILL_ID]', '[BILL_ID]', 200, 50, -1, false, '[BILL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_ID->IsForeignKey = true; // Foreign key field
        $this->BILL_ID->Nullable = false; // NOT NULL field
        $this->BILL_ID->Sortable = false; // Allow sort
        $this->BILL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_ID->Param, "CustomMsg");
        $this->Fields['BILL_ID'] = &$this->BILL_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NO_REGISTRATION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'HIDDEN');
        $this->VISIT_ID->IsForeignKey = true; // Foreign key field
        $this->VISIT_ID->Nullable = false; // NOT NULL field
        $this->VISIT_ID->Sortable = false; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // TARIF_ID
        $this->TARIF_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_TARIF_ID', 'TARIF_ID', '[TARIF_ID]', '[TARIF_ID]', 200, 25, -1, false, '[TARIF_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->TARIF_ID->Sortable = false; // Allow sort
        $this->TARIF_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->TARIF_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->TARIF_ID->Lookup = new Lookup('TARIF_ID', 'TREAT_TARIF', false, 'TARIF_ID', ["TARIF_NAME","AMOUNT_PAID","",""], [], [], [], [], ["TARIF_NAME","AMOUNT_PAID"], ["x_TREATMENT","x_amount_paid"], '[TARIF_NAME] ASC', '');
                break;
            default:
                $this->TARIF_ID->Lookup = new Lookup('TARIF_ID', 'TREAT_TARIF', false, 'TARIF_ID', ["TARIF_NAME","AMOUNT_PAID","",""], [], [], [], [], ["TARIF_NAME","AMOUNT_PAID"], ["x_TREATMENT","x_amount_paid"], '[TARIF_NAME] ASC', '');
                break;
        }
        $this->TARIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_ID->Param, "CustomMsg");
        $this->Fields['TARIF_ID'] = &$this->TARIF_ID;

        // CLASS_ID
        $this->CLASS_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID->Sortable = false; // Allow sort
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 15, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLINIC_ID->Sortable = false; // Allow sort
        $this->CLINIC_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLINIC_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CLINIC_ID_FROM', 'CLINIC_ID_FROM', '[CLINIC_ID_FROM]', '[CLINIC_ID_FROM]', 200, 15, -1, false, '[CLINIC_ID_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID_FROM->Sortable = false; // Allow sort
        $this->CLINIC_ID_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID_FROM->Param, "CustomMsg");
        $this->Fields['CLINIC_ID_FROM'] = &$this->CLINIC_ID_FROM;

        // TREATMENT
        $this->TREATMENT = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_TREATMENT', 'TREATMENT', '[TREATMENT]', '[TREATMENT]', 200, 200, -1, false, '[TREATMENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREATMENT->Sortable = false; // Allow sort
        $this->TREATMENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREATMENT->Param, "CustomMsg");
        $this->Fields['TREATMENT'] = &$this->TREATMENT;

        // TREAT_DATE
        $this->TREAT_DATE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_TREAT_DATE', 'TREAT_DATE', '[TREAT_DATE]', CastDateFieldForLike("[TREAT_DATE]", 11, "DB"), 135, 8, 11, false, '[TREAT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREAT_DATE->Sortable = false; // Allow sort
        $this->TREAT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->TREAT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREAT_DATE->Param, "CustomMsg");
        $this->Fields['TREAT_DATE'] = &$this->TREAT_DATE;

        // AMOUNT
        $this->AMOUNT = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = false; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // QUANTITY
        $this->QUANTITY = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_QUANTITY', 'QUANTITY', '[QUANTITY]', 'CAST([QUANTITY] AS NVARCHAR)', 131, 8, -1, false, '[QUANTITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->QUANTITY->Sortable = false; // Allow sort
        $this->QUANTITY->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->QUANTITY->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->QUANTITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->QUANTITY->Param, "CustomMsg");
        $this->Fields['QUANTITY'] = &$this->QUANTITY;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = false; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // POKOK_JUAL
        $this->POKOK_JUAL = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_POKOK_JUAL', 'POKOK_JUAL', '[POKOK_JUAL]', 'CAST([POKOK_JUAL] AS NVARCHAR)', 131, 8, -1, false, '[POKOK_JUAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POKOK_JUAL->Sortable = false; // Allow sort
        $this->POKOK_JUAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->POKOK_JUAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->POKOK_JUAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POKOK_JUAL->Param, "CustomMsg");
        $this->Fields['POKOK_JUAL'] = &$this->POKOK_JUAL;

        // PPN
        $this->PPN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PPN', 'PPN', '[PPN]', 'CAST([PPN] AS NVARCHAR)', 131, 8, -1, false, '[PPN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPN->Sortable = false; // Allow sort
        $this->PPN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPN->Param, "CustomMsg");
        $this->Fields['PPN'] = &$this->PPN;

        // MARGIN
        $this->MARGIN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_MARGIN', 'MARGIN', '[MARGIN]', 'CAST([MARGIN] AS NVARCHAR)', 131, 8, -1, false, '[MARGIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARGIN->Sortable = false; // Allow sort
        $this->MARGIN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MARGIN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MARGIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARGIN->Param, "CustomMsg");
        $this->Fields['MARGIN'] = &$this->MARGIN;

        // SUBSIDI
        $this->SUBSIDI = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SUBSIDI', 'SUBSIDI', '[SUBSIDI]', 'CAST([SUBSIDI] AS NVARCHAR)', 6, 8, -1, false, '[SUBSIDI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SUBSIDI->Sortable = false; // Allow sort
        $this->SUBSIDI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SUBSIDI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SUBSIDI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SUBSIDI->Param, "CustomMsg");
        $this->Fields['SUBSIDI'] = &$this->SUBSIDI;

        // EMBALACE
        $this->EMBALACE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_EMBALACE', 'EMBALACE', '[EMBALACE]', 'CAST([EMBALACE] AS NVARCHAR)', 6, 8, -1, false, '[EMBALACE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMBALACE->Sortable = false; // Allow sort
        $this->EMBALACE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->EMBALACE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->EMBALACE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMBALACE->Param, "CustomMsg");
        $this->Fields['EMBALACE'] = &$this->EMBALACE;

        // PROFESI
        $this->PROFESI = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PROFESI', 'PROFESI', '[PROFESI]', 'CAST([PROFESI] AS NVARCHAR)', 6, 8, -1, false, '[PROFESI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROFESI->Sortable = false; // Allow sort
        $this->PROFESI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PROFESI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PROFESI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROFESI->Param, "CustomMsg");
        $this->Fields['PROFESI'] = &$this->PROFESI;

        // DISCOUNT
        $this->DISCOUNT = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_DISCOUNT', 'DISCOUNT', '[DISCOUNT]', 'CAST([DISCOUNT] AS NVARCHAR)', 131, 8, -1, false, '[DISCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISCOUNT->Sortable = false; // Allow sort
        $this->DISCOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DISCOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DISCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISCOUNT->Param, "CustomMsg");
        $this->Fields['DISCOUNT'] = &$this->DISCOUNT;

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PAY_METHOD_ID', 'PAY_METHOD_ID', '[PAY_METHOD_ID]', 'CAST([PAY_METHOD_ID] AS NVARCHAR)', 17, 1, -1, false, '[PAY_METHOD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAY_METHOD_ID->Sortable = false; // Allow sort
        $this->PAY_METHOD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PAY_METHOD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAY_METHOD_ID->Param, "CustomMsg");
        $this->Fields['PAY_METHOD_ID'] = &$this->PAY_METHOD_ID;

        // PAYMENT_DATE
        $this->PAYMENT_DATE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PAYMENT_DATE', 'PAYMENT_DATE', '[PAYMENT_DATE]', CastDateFieldForLike("[PAYMENT_DATE]", 11, "DB"), 135, 8, 11, false, '[PAYMENT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYMENT_DATE->Sortable = false; // Allow sort
        $this->PAYMENT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->PAYMENT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYMENT_DATE->Param, "CustomMsg");
        $this->Fields['PAYMENT_DATE'] = &$this->PAYMENT_DATE;

        // ISLUNAS
        $this->ISLUNAS = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ISLUNAS', 'ISLUNAS', '[ISLUNAS]', '[ISLUNAS]', 129, 1, -1, false, '[ISLUNAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISLUNAS->Sortable = false; // Allow sort
        $this->ISLUNAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISLUNAS->Param, "CustomMsg");
        $this->Fields['ISLUNAS'] = &$this->ISLUNAS;

        // DUEDATE_ANGSURAN
        $this->DUEDATE_ANGSURAN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_DUEDATE_ANGSURAN', 'DUEDATE_ANGSURAN', '[DUEDATE_ANGSURAN]', CastDateFieldForLike("[DUEDATE_ANGSURAN]", 0, "DB"), 135, 8, 0, false, '[DUEDATE_ANGSURAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DUEDATE_ANGSURAN->Sortable = false; // Allow sort
        $this->DUEDATE_ANGSURAN->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DUEDATE_ANGSURAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DUEDATE_ANGSURAN->Param, "CustomMsg");
        $this->Fields['DUEDATE_ANGSURAN'] = &$this->DUEDATE_ANGSURAN;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = false; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // KUITANSI_ID
        $this->KUITANSI_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_KUITANSI_ID', 'KUITANSI_ID', '[KUITANSI_ID]', '[KUITANSI_ID]', 200, 100, -1, false, '[KUITANSI_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KUITANSI_ID->Sortable = false; // Allow sort
        $this->KUITANSI_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KUITANSI_ID->Param, "CustomMsg");
        $this->Fields['KUITANSI_ID'] = &$this->KUITANSI_ID;

        // NOTA_NO
        $this->NOTA_NO = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_NOTA_NO', 'NOTA_NO', '[NOTA_NO]', '[NOTA_NO]', 200, 50, -1, false, '[NOTA_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOTA_NO->Sortable = false; // Allow sort
        $this->NOTA_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOTA_NO->Param, "CustomMsg");
        $this->Fields['NOTA_NO'] = &$this->NOTA_NO;

        // ISCETAK
        $this->ISCETAK = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ISCETAK', 'ISCETAK', '[ISCETAK]', '[ISCETAK]', 129, 1, -1, false, '[ISCETAK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISCETAK->Sortable = false; // Allow sort
        $this->ISCETAK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISCETAK->Param, "CustomMsg");
        $this->Fields['ISCETAK'] = &$this->ISCETAK;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = false; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // RESEP_NO
        $this->RESEP_NO = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_RESEP_NO', 'RESEP_NO', '[RESEP_NO]', '[RESEP_NO]', 200, 50, -1, false, '[RESEP_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESEP_NO->Sortable = false; // Allow sort
        $this->RESEP_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESEP_NO->Param, "CustomMsg");
        $this->Fields['RESEP_NO'] = &$this->RESEP_NO;

        // RESEP_KE
        $this->RESEP_KE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_RESEP_KE', 'RESEP_KE', '[RESEP_KE]', 'CAST([RESEP_KE] AS NVARCHAR)', 17, 1, -1, false, '[RESEP_KE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESEP_KE->Sortable = false; // Allow sort
        $this->RESEP_KE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RESEP_KE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESEP_KE->Param, "CustomMsg");
        $this->Fields['RESEP_KE'] = &$this->RESEP_KE;

        // DOSE
        $this->DOSE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_DOSE', 'DOSE', '[DOSE]', 'CAST([DOSE] AS NVARCHAR)', 131, 8, -1, false, '[DOSE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOSE->Sortable = false; // Allow sort
        $this->DOSE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DOSE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DOSE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOSE->Param, "CustomMsg");
        $this->Fields['DOSE'] = &$this->DOSE;

        // ORIG_DOSE
        $this->ORIG_DOSE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ORIG_DOSE', 'ORIG_DOSE', '[ORIG_DOSE]', 'CAST([ORIG_DOSE] AS NVARCHAR)', 131, 8, -1, false, '[ORIG_DOSE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORIG_DOSE->Sortable = false; // Allow sort
        $this->ORIG_DOSE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ORIG_DOSE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ORIG_DOSE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORIG_DOSE->Param, "CustomMsg");
        $this->Fields['ORIG_DOSE'] = &$this->ORIG_DOSE;

        // DOSE_PRESC
        $this->DOSE_PRESC = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_DOSE_PRESC', 'DOSE_PRESC', '[DOSE_PRESC]', 'CAST([DOSE_PRESC] AS NVARCHAR)', 131, 8, -1, false, '[DOSE_PRESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOSE_PRESC->Sortable = false; // Allow sort
        $this->DOSE_PRESC->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->DOSE_PRESC->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->DOSE_PRESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOSE_PRESC->Param, "CustomMsg");
        $this->Fields['DOSE_PRESC'] = &$this->DOSE_PRESC;

        // ITER
        $this->ITER = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ITER', 'ITER', '[ITER]', 'CAST([ITER] AS NVARCHAR)', 17, 1, -1, false, '[ITER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ITER->Sortable = false; // Allow sort
        $this->ITER->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ITER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ITER->Param, "CustomMsg");
        $this->Fields['ITER'] = &$this->ITER;

        // ITER_KE
        $this->ITER_KE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ITER_KE', 'ITER_KE', '[ITER_KE]', 'CAST([ITER_KE] AS NVARCHAR)', 17, 1, -1, false, '[ITER_KE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ITER_KE->Sortable = false; // Allow sort
        $this->ITER_KE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ITER_KE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ITER_KE->Param, "CustomMsg");
        $this->Fields['ITER_KE'] = &$this->ITER_KE;

        // SOLD_STATUS
        $this->SOLD_STATUS = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SOLD_STATUS', 'SOLD_STATUS', '[SOLD_STATUS]', 'CAST([SOLD_STATUS] AS NVARCHAR)', 17, 1, -1, false, '[SOLD_STATUS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SOLD_STATUS->Sortable = false; // Allow sort
        $this->SOLD_STATUS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SOLD_STATUS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SOLD_STATUS->Param, "CustomMsg");
        $this->Fields['SOLD_STATUS'] = &$this->SOLD_STATUS;

        // RACIKAN
        $this->RACIKAN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_RACIKAN', 'RACIKAN', '[RACIKAN]', 'CAST([RACIKAN] AS NVARCHAR)', 2, 2, -1, false, '[RACIKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RACIKAN->Sortable = false; // Allow sort
        $this->RACIKAN->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RACIKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RACIKAN->Param, "CustomMsg");
        $this->Fields['RACIKAN'] = &$this->RACIKAN;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 16, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = false; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // KELUAR_ID
        $this->KELUAR_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELUAR_ID->Sortable = false; // Allow sort
        $this->KELUAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KELUAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELUAR_ID->Param, "CustomMsg");
        $this->Fields['KELUAR_ID'] = &$this->KELUAR_ID;

        // BED_ID
        $this->BED_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = false; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // PERDA_ID
        $this->PERDA_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PERDA_ID', 'PERDA_ID', '[PERDA_ID]', 'CAST([PERDA_ID] AS NVARCHAR)', 17, 1, -1, false, '[PERDA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PERDA_ID->Sortable = false; // Allow sort
        $this->PERDA_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PERDA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PERDA_ID->Param, "CustomMsg");
        $this->Fields['PERDA_ID'] = &$this->PERDA_ID;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->EMPLOYEE_ID->Sortable = false; // Allow sort
        $this->EMPLOYEE_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->EMPLOYEE_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->EMPLOYEE_ID->Lookup = new Lookup('EMPLOYEE_ID', 'EMPLOYEE_ALL', false, 'EMPLOYEE_ID', ["FULLNAME","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->EMPLOYEE_ID->Lookup = new Lookup('EMPLOYEE_ID', 'EMPLOYEE_ALL', false, 'EMPLOYEE_ID', ["FULLNAME","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // DESCRIPTION2
        $this->DESCRIPTION2 = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_DESCRIPTION2', 'DESCRIPTION2', '[DESCRIPTION2]', '[DESCRIPTION2]', 200, 50, -1, false, '[DESCRIPTION2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION2->Sortable = false; // Allow sort
        $this->DESCRIPTION2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION2->Param, "CustomMsg");
        $this->Fields['DESCRIPTION2'] = &$this->DESCRIPTION2;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 200, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = false; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = false; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = false; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // BRAND_ID
        $this->BRAND_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_BRAND_ID', 'BRAND_ID', '[BRAND_ID]', '[BRAND_ID]', 200, 50, -1, false, '[BRAND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_ID->Sortable = false; // Allow sort
        $this->BRAND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_ID->Param, "CustomMsg");
        $this->Fields['BRAND_ID'] = &$this->BRAND_ID;

        // DOCTOR
        $this->DOCTOR = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_DOCTOR', 'DOCTOR', '[DOCTOR]', '[DOCTOR]', 200, 100, -1, false, '[DOCTOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR->Sortable = false; // Allow sort
        $this->DOCTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR->Param, "CustomMsg");
        $this->Fields['DOCTOR'] = &$this->DOCTOR;

        // JML_BKS
        $this->JML_BKS = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_JML_BKS', 'JML_BKS', '[JML_BKS]', 'CAST([JML_BKS] AS NVARCHAR)', 17, 1, -1, false, '[JML_BKS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JML_BKS->Sortable = false; // Allow sort
        $this->JML_BKS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->JML_BKS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JML_BKS->Param, "CustomMsg");
        $this->Fields['JML_BKS'] = &$this->JML_BKS;

        // EXIT_DATE
        $this->EXIT_DATE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_EXIT_DATE', 'EXIT_DATE', '[EXIT_DATE]', CastDateFieldForLike("[EXIT_DATE]", 0, "DB"), 135, 8, 0, false, '[EXIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXIT_DATE->Sortable = false; // Allow sort
        $this->EXIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXIT_DATE->Param, "CustomMsg");
        $this->Fields['EXIT_DATE'] = &$this->EXIT_DATE;

        // FA_V
        $this->FA_V = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_FA_V', 'FA_V', '[FA_V]', 'CAST([FA_V] AS NVARCHAR)', 2, 2, -1, false, '[FA_V]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V->Sortable = false; // Allow sort
        $this->FA_V->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FA_V->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V->Param, "CustomMsg");
        $this->Fields['FA_V'] = &$this->FA_V;

        // TASK_ID
        $this->TASK_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_TASK_ID', 'TASK_ID', '[TASK_ID]', 'CAST([TASK_ID] AS NVARCHAR)', 2, 2, -1, false, '[TASK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TASK_ID->Sortable = false; // Allow sort
        $this->TASK_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TASK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TASK_ID->Param, "CustomMsg");
        $this->Fields['TASK_ID'] = &$this->TASK_ID;

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_EMPLOYEE_ID_FROM', 'EMPLOYEE_ID_FROM', '[EMPLOYEE_ID_FROM]', '[EMPLOYEE_ID_FROM]', 200, 50, -1, false, '[EMPLOYEE_ID_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID_FROM->Sortable = false; // Allow sort
        $this->EMPLOYEE_ID_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID_FROM->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID_FROM'] = &$this->EMPLOYEE_ID_FROM;

        // DOCTOR_FROM
        $this->DOCTOR_FROM = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_DOCTOR_FROM', 'DOCTOR_FROM', '[DOCTOR_FROM]', '[DOCTOR_FROM]', 200, 50, -1, false, '[DOCTOR_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR_FROM->Sortable = false; // Allow sort
        $this->DOCTOR_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR_FROM->Param, "CustomMsg");
        $this->Fields['DOCTOR_FROM'] = &$this->DOCTOR_FROM;

        // status_pasien_id
        $this->status_pasien_id = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_status_pasien_id', 'status_pasien_id', '[status_pasien_id]', 'CAST([status_pasien_id] AS NVARCHAR)', 17, 1, -1, false, '[status_pasien_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status_pasien_id->Sortable = false; // Allow sort
        $this->status_pasien_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status_pasien_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_pasien_id->Param, "CustomMsg");
        $this->Fields['status_pasien_id'] = &$this->status_pasien_id;

        // amount_paid
        $this->amount_paid = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_amount_paid', 'amount_paid', '[amount_paid]', 'CAST([amount_paid] AS NVARCHAR)', 6, 8, -1, false, '[amount_paid]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->amount_paid->Sortable = false; // Allow sort
        $this->amount_paid->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->amount_paid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->amount_paid->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->amount_paid->Param, "CustomMsg");
        $this->Fields['amount_paid'] = &$this->amount_paid;

        // THENAME
        $this->THENAME = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = false; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // THEADDRESS
        $this->THEADDRESS = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 150, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = false; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEID
        $this->THEID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 25, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = false; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->Fields['THEID'] = &$this->THEID;

        // serial_nb
        $this->serial_nb = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_serial_nb', 'serial_nb', '[serial_nb]', '[serial_nb]', 200, 50, -1, false, '[serial_nb]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->serial_nb->Sortable = false; // Allow sort
        $this->serial_nb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->serial_nb->Param, "CustomMsg");
        $this->Fields['serial_nb'] = &$this->serial_nb;

        // TREATMENT_PLAFOND
        $this->TREATMENT_PLAFOND = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_TREATMENT_PLAFOND', 'TREATMENT_PLAFOND', '[TREATMENT_PLAFOND]', '[TREATMENT_PLAFOND]', 200, 150, -1, false, '[TREATMENT_PLAFOND]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREATMENT_PLAFOND->Sortable = false; // Allow sort
        $this->TREATMENT_PLAFOND->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREATMENT_PLAFOND->Param, "CustomMsg");
        $this->Fields['TREATMENT_PLAFOND'] = &$this->TREATMENT_PLAFOND;

        // AMOUNT_PLAFOND
        $this->AMOUNT_PLAFOND = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_AMOUNT_PLAFOND', 'AMOUNT_PLAFOND', '[AMOUNT_PLAFOND]', 'CAST([AMOUNT_PLAFOND] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_PLAFOND]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PLAFOND->Sortable = false; // Allow sort
        $this->AMOUNT_PLAFOND->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_PLAFOND->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_PLAFOND->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PLAFOND->Param, "CustomMsg");
        $this->Fields['AMOUNT_PLAFOND'] = &$this->AMOUNT_PLAFOND;

        // AMOUNT_PAID_PLAFOND
        $this->AMOUNT_PAID_PLAFOND = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_AMOUNT_PAID_PLAFOND', 'AMOUNT_PAID_PLAFOND', '[AMOUNT_PAID_PLAFOND]', 'CAST([AMOUNT_PAID_PLAFOND] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_PAID_PLAFOND]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PAID_PLAFOND->Sortable = false; // Allow sort
        $this->AMOUNT_PAID_PLAFOND->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_PAID_PLAFOND->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_PAID_PLAFOND->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PAID_PLAFOND->Param, "CustomMsg");
        $this->Fields['AMOUNT_PAID_PLAFOND'] = &$this->AMOUNT_PAID_PLAFOND;

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CLASS_ID_PLAFOND', 'CLASS_ID_PLAFOND', '[CLASS_ID_PLAFOND]', 'CAST([CLASS_ID_PLAFOND] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID_PLAFOND]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID_PLAFOND->Sortable = false; // Allow sort
        $this->CLASS_ID_PLAFOND->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID_PLAFOND->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID_PLAFOND->Param, "CustomMsg");
        $this->Fields['CLASS_ID_PLAFOND'] = &$this->CLASS_ID_PLAFOND;

        // PAYOR_ID
        $this->PAYOR_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PAYOR_ID', 'PAYOR_ID', '[PAYOR_ID]', '[PAYOR_ID]', 200, 50, -1, false, '[PAYOR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYOR_ID->Sortable = false; // Allow sort
        $this->PAYOR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ID->Param, "CustomMsg");
        $this->Fields['PAYOR_ID'] = &$this->PAYOR_ID;

        // PEMBULATAN
        $this->PEMBULATAN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PEMBULATAN', 'PEMBULATAN', '[PEMBULATAN]', 'CAST([PEMBULATAN] AS NVARCHAR)', 6, 8, -1, false, '[PEMBULATAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEMBULATAN->Sortable = false; // Allow sort
        $this->PEMBULATAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PEMBULATAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PEMBULATAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEMBULATAN->Param, "CustomMsg");
        $this->Fields['PEMBULATAN'] = &$this->PEMBULATAN;

        // ISRJ
        $this->ISRJ = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = false; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // AGEYEAR
        $this->AGEYEAR = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = false; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = false; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = false; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // GENDER
        $this->GENDER = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = false; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // KAL_ID
        $this->KAL_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = false; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // CORRECTION_ID
        $this->CORRECTION_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CORRECTION_ID', 'CORRECTION_ID', '[CORRECTION_ID]', '[CORRECTION_ID]', 200, 50, -1, false, '[CORRECTION_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CORRECTION_ID->Sortable = false; // Allow sort
        $this->CORRECTION_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CORRECTION_ID->Param, "CustomMsg");
        $this->Fields['CORRECTION_ID'] = &$this->CORRECTION_ID;

        // CORRECTION_BY
        $this->CORRECTION_BY = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CORRECTION_BY', 'CORRECTION_BY', '[CORRECTION_BY]', '[CORRECTION_BY]', 200, 50, -1, false, '[CORRECTION_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CORRECTION_BY->Sortable = false; // Allow sort
        $this->CORRECTION_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CORRECTION_BY->Param, "CustomMsg");
        $this->Fields['CORRECTION_BY'] = &$this->CORRECTION_BY;

        // KARYAWAN
        $this->KARYAWAN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_KARYAWAN', 'KARYAWAN', '[KARYAWAN]', '[KARYAWAN]', 200, 50, -1, false, '[KARYAWAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KARYAWAN->Sortable = false; // Allow sort
        $this->KARYAWAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KARYAWAN->Param, "CustomMsg");
        $this->Fields['KARYAWAN'] = &$this->KARYAWAN;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = false; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // sell_price
        $this->sell_price = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_sell_price', 'sell_price', '[sell_price]', 'CAST([sell_price] AS NVARCHAR)', 6, 8, -1, false, '[sell_price]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sell_price->Sortable = false; // Allow sort
        $this->sell_price->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->sell_price->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->sell_price->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sell_price->Param, "CustomMsg");
        $this->Fields['sell_price'] = &$this->sell_price;

        // diskon
        $this->diskon = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_diskon', 'diskon', '[diskon]', 'CAST([diskon] AS NVARCHAR)', 6, 8, -1, false, '[diskon]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->diskon->Sortable = false; // Allow sort
        $this->diskon->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->diskon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->diskon->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->diskon->Param, "CustomMsg");
        $this->Fields['diskon'] = &$this->diskon;

        // INVOICE_ID
        $this->INVOICE_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_INVOICE_ID', 'INVOICE_ID', '[INVOICE_ID]', '[INVOICE_ID]', 200, 50, -1, false, '[INVOICE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_ID->Sortable = false; // Allow sort
        $this->INVOICE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_ID->Param, "CustomMsg");
        $this->Fields['INVOICE_ID'] = &$this->INVOICE_ID;

        // NUMER
        $this->NUMER = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_NUMER', 'NUMER', '[NUMER]', '[NUMER]', 200, 15, -1, false, '[NUMER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NUMER->Sortable = false; // Allow sort
        $this->NUMER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NUMER->Param, "CustomMsg");
        $this->Fields['NUMER'] = &$this->NUMER;

        // MEASURE_ID2
        $this->MEASURE_ID2 = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_MEASURE_ID2', 'MEASURE_ID2', '[MEASURE_ID2]', 'CAST([MEASURE_ID2] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID2->Sortable = false; // Allow sort
        $this->MEASURE_ID2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID2->Param, "CustomMsg");
        $this->Fields['MEASURE_ID2'] = &$this->MEASURE_ID2;

        // POTONGAN
        $this->POTONGAN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_POTONGAN', 'POTONGAN', '[POTONGAN]', 'CAST([POTONGAN] AS NVARCHAR)', 6, 8, -1, false, '[POTONGAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POTONGAN->Sortable = false; // Allow sort
        $this->POTONGAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->POTONGAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->POTONGAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POTONGAN->Param, "CustomMsg");
        $this->Fields['POTONGAN'] = &$this->POTONGAN;

        // BAYAR
        $this->BAYAR = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_BAYAR', 'BAYAR', '[BAYAR]', 'CAST([BAYAR] AS NVARCHAR)', 6, 8, -1, false, '[BAYAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BAYAR->Sortable = false; // Allow sort
        $this->BAYAR->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->BAYAR->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->BAYAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BAYAR->Param, "CustomMsg");
        $this->Fields['BAYAR'] = &$this->BAYAR;

        // RETUR
        $this->RETUR = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_RETUR', 'RETUR', '[RETUR]', 'CAST([RETUR] AS NVARCHAR)', 6, 8, -1, false, '[RETUR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RETUR->Sortable = false; // Allow sort
        $this->RETUR->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->RETUR->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->RETUR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RETUR->Param, "CustomMsg");
        $this->Fields['RETUR'] = &$this->RETUR;

        // TARIF_TYPE
        $this->TARIF_TYPE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_TARIF_TYPE', 'TARIF_TYPE', '[TARIF_TYPE]', '[TARIF_TYPE]', 200, 50, -1, false, '[TARIF_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_TYPE->Sortable = false; // Allow sort
        $this->TARIF_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_TYPE->Param, "CustomMsg");
        $this->Fields['TARIF_TYPE'] = &$this->TARIF_TYPE;

        // PPNVALUE
        $this->PPNVALUE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PPNVALUE', 'PPNVALUE', '[PPNVALUE]', 'CAST([PPNVALUE] AS NVARCHAR)', 6, 8, -1, false, '[PPNVALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PPNVALUE->Sortable = false; // Allow sort
        $this->PPNVALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PPNVALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PPNVALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPNVALUE->Param, "CustomMsg");
        $this->Fields['PPNVALUE'] = &$this->PPNVALUE;

        // TAGIHAN
        $this->TAGIHAN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_TAGIHAN', 'TAGIHAN', '[TAGIHAN]', 'CAST([TAGIHAN] AS NVARCHAR)', 6, 8, -1, false, '[TAGIHAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TAGIHAN->Sortable = false; // Allow sort
        $this->TAGIHAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TAGIHAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TAGIHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TAGIHAN->Param, "CustomMsg");
        $this->Fields['TAGIHAN'] = &$this->TAGIHAN;

        // KOREKSI
        $this->KOREKSI = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_KOREKSI', 'KOREKSI', '[KOREKSI]', 'CAST([KOREKSI] AS NVARCHAR)', 6, 8, -1, false, '[KOREKSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KOREKSI->Sortable = false; // Allow sort
        $this->KOREKSI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->KOREKSI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->KOREKSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KOREKSI->Param, "CustomMsg");
        $this->Fields['KOREKSI'] = &$this->KOREKSI;

        // STATUS_OBAT
        $this->STATUS_OBAT = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_STATUS_OBAT', 'STATUS_OBAT', '[STATUS_OBAT]', 'CAST([STATUS_OBAT] AS NVARCHAR)', 2, 2, -1, false, '[STATUS_OBAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_OBAT->Sortable = false; // Allow sort
        $this->STATUS_OBAT->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_OBAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_OBAT->Param, "CustomMsg");
        $this->Fields['STATUS_OBAT'] = &$this->STATUS_OBAT;

        // SUBSIDISAT
        $this->SUBSIDISAT = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SUBSIDISAT', 'SUBSIDISAT', '[SUBSIDISAT]', 'CAST([SUBSIDISAT] AS NVARCHAR)', 6, 8, -1, false, '[SUBSIDISAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SUBSIDISAT->Sortable = false; // Allow sort
        $this->SUBSIDISAT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SUBSIDISAT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SUBSIDISAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SUBSIDISAT->Param, "CustomMsg");
        $this->Fields['SUBSIDISAT'] = &$this->SUBSIDISAT;

        // PRINTQ
        $this->PRINTQ = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PRINTQ', 'PRINTQ', '[PRINTQ]', 'CAST([PRINTQ] AS NVARCHAR)', 2, 2, -1, false, '[PRINTQ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTQ->Sortable = false; // Allow sort
        $this->PRINTQ->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PRINTQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTQ->Param, "CustomMsg");
        $this->Fields['PRINTQ'] = &$this->PRINTQ;

        // PRINTED_BY
        $this->PRINTED_BY = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PRINTED_BY', 'PRINTED_BY', '[PRINTED_BY]', '[PRINTED_BY]', 200, 50, -1, false, '[PRINTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTED_BY->Sortable = false; // Allow sort
        $this->PRINTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTED_BY->Param, "CustomMsg");
        $this->Fields['PRINTED_BY'] = &$this->PRINTED_BY;

        // STOCK_AVAILABLE
        $this->STOCK_AVAILABLE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_STOCK_AVAILABLE', 'STOCK_AVAILABLE', '[STOCK_AVAILABLE]', 'CAST([STOCK_AVAILABLE] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_AVAILABLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_AVAILABLE->Sortable = false; // Allow sort
        $this->STOCK_AVAILABLE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_AVAILABLE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_AVAILABLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_AVAILABLE->Param, "CustomMsg");
        $this->Fields['STOCK_AVAILABLE'] = &$this->STOCK_AVAILABLE;

        // STATUS_TARIF
        $this->STATUS_TARIF = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_STATUS_TARIF', 'STATUS_TARIF', '[STATUS_TARIF]', 'CAST([STATUS_TARIF] AS NVARCHAR)', 2, 2, -1, false, '[STATUS_TARIF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_TARIF->Sortable = false; // Allow sort
        $this->STATUS_TARIF->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_TARIF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_TARIF->Param, "CustomMsg");
        $this->Fields['STATUS_TARIF'] = &$this->STATUS_TARIF;

        // CLINIC_TYPE
        $this->CLINIC_TYPE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CLINIC_TYPE', 'CLINIC_TYPE', '[CLINIC_TYPE]', 'CAST([CLINIC_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[CLINIC_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_TYPE->Sortable = false; // Allow sort
        $this->CLINIC_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLINIC_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_TYPE->Param, "CustomMsg");
        $this->Fields['CLINIC_TYPE'] = &$this->CLINIC_TYPE;

        // PACKAGE_ID
        $this->PACKAGE_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PACKAGE_ID', 'PACKAGE_ID', '[PACKAGE_ID]', '[PACKAGE_ID]', 200, 50, -1, false, '[PACKAGE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PACKAGE_ID->Sortable = false; // Allow sort
        $this->PACKAGE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PACKAGE_ID->Param, "CustomMsg");
        $this->Fields['PACKAGE_ID'] = &$this->PACKAGE_ID;

        // MODULE_ID
        $this->MODULE_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_MODULE_ID', 'MODULE_ID', '[MODULE_ID]', '[MODULE_ID]', 200, 50, -1, false, '[MODULE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODULE_ID->Sortable = false; // Allow sort
        $this->MODULE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODULE_ID->Param, "CustomMsg");
        $this->Fields['MODULE_ID'] = &$this->MODULE_ID;

        // profession
        $this->profession = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_profession', 'profession', '[profession]', 'CAST([profession] AS NVARCHAR)', 131, 8, -1, false, '[profession]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->profession->Sortable = false; // Allow sort
        $this->profession->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->profession->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->profession->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->profession->Param, "CustomMsg");
        $this->Fields['profession'] = &$this->profession;

        // THEORDER
        $this->THEORDER = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_THEORDER', 'THEORDER', '[THEORDER]', 'CAST([THEORDER] AS NVARCHAR)', 2, 2, -1, false, '[THEORDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEORDER->Sortable = false; // Allow sort
        $this->THEORDER->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->THEORDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEORDER->Param, "CustomMsg");
        $this->Fields['THEORDER'] = &$this->THEORDER;

        // CASHIER
        $this->CASHIER = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CASHIER', 'CASHIER', '[CASHIER]', '[CASHIER]', 200, 50, -1, false, '[CASHIER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CASHIER->Sortable = false; // Allow sort
        $this->CASHIER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CASHIER->Param, "CustomMsg");
        $this->Fields['CASHIER'] = &$this->CASHIER;

        // SPPFEE
        $this->SPPFEE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPFEE', 'SPPFEE', '[SPPFEE]', '[SPPFEE]', 200, 50, -1, false, '[SPPFEE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPFEE->Sortable = false; // Allow sort
        $this->SPPFEE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPFEE->Param, "CustomMsg");
        $this->Fields['SPPFEE'] = &$this->SPPFEE;

        // SPPBILL
        $this->SPPBILL = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPBILL', 'SPPBILL', '[SPPBILL]', '[SPPBILL]', 200, 50, -1, false, '[SPPBILL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPBILL->Sortable = false; // Allow sort
        $this->SPPBILL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPBILL->Param, "CustomMsg");
        $this->Fields['SPPBILL'] = &$this->SPPBILL;

        // SPPRJK
        $this->SPPRJK = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPRJK', 'SPPRJK', '[SPPRJK]', '[SPPRJK]', 200, 50, -1, false, '[SPPRJK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPRJK->Sortable = false; // Allow sort
        $this->SPPRJK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPRJK->Param, "CustomMsg");
        $this->Fields['SPPRJK'] = &$this->SPPRJK;

        // SPPJMN
        $this->SPPJMN = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPJMN', 'SPPJMN', '[SPPJMN]', '[SPPJMN]', 200, 50, -1, false, '[SPPJMN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPJMN->Sortable = false; // Allow sort
        $this->SPPJMN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPJMN->Param, "CustomMsg");
        $this->Fields['SPPJMN'] = &$this->SPPJMN;

        // SPPKASIR
        $this->SPPKASIR = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPKASIR', 'SPPKASIR', '[SPPKASIR]', '[SPPKASIR]', 200, 50, -1, false, '[SPPKASIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPKASIR->Sortable = false; // Allow sort
        $this->SPPKASIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPKASIR->Param, "CustomMsg");
        $this->Fields['SPPKASIR'] = &$this->SPPKASIR;

        // PERUJUK
        $this->PERUJUK = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PERUJUK', 'PERUJUK', '[PERUJUK]', '[PERUJUK]', 200, 50, -1, false, '[PERUJUK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PERUJUK->Sortable = false; // Allow sort
        $this->PERUJUK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PERUJUK->Param, "CustomMsg");
        $this->Fields['PERUJUK'] = &$this->PERUJUK;

        // PERUJUKFEE
        $this->PERUJUKFEE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_PERUJUKFEE', 'PERUJUKFEE', '[PERUJUKFEE]', 'CAST([PERUJUKFEE] AS NVARCHAR)', 6, 8, -1, false, '[PERUJUKFEE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PERUJUKFEE->Sortable = false; // Allow sort
        $this->PERUJUKFEE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PERUJUKFEE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PERUJUKFEE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PERUJUKFEE->Param, "CustomMsg");
        $this->Fields['PERUJUKFEE'] = &$this->PERUJUKFEE;

        // modified_datesys
        $this->modified_datesys = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_modified_datesys', 'modified_datesys', '[modified_datesys]', CastDateFieldForLike("[modified_datesys]", 0, "DB"), 135, 8, 0, false, '[modified_datesys]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->modified_datesys->Sortable = false; // Allow sort
        $this->modified_datesys->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->modified_datesys->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->modified_datesys->Param, "CustomMsg");
        $this->Fields['modified_datesys'] = &$this->modified_datesys;

        // TRANS_ID
        $this->TRANS_ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_TRANS_ID', 'TRANS_ID', '[TRANS_ID]', '[TRANS_ID]', 200, 50, -1, false, '[TRANS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TRANS_ID->Sortable = false; // Allow sort
        $this->TRANS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TRANS_ID->Param, "CustomMsg");
        $this->Fields['TRANS_ID'] = &$this->TRANS_ID;

        // SPPBILLDATE
        $this->SPPBILLDATE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPBILLDATE', 'SPPBILLDATE', '[SPPBILLDATE]', CastDateFieldForLike("[SPPBILLDATE]", 0, "DB"), 135, 8, 0, false, '[SPPBILLDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPBILLDATE->Sortable = false; // Allow sort
        $this->SPPBILLDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SPPBILLDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPBILLDATE->Param, "CustomMsg");
        $this->Fields['SPPBILLDATE'] = &$this->SPPBILLDATE;

        // SPPBILLUSER
        $this->SPPBILLUSER = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPBILLUSER', 'SPPBILLUSER', '[SPPBILLUSER]', '[SPPBILLUSER]', 200, 50, -1, false, '[SPPBILLUSER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPBILLUSER->Sortable = false; // Allow sort
        $this->SPPBILLUSER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPBILLUSER->Param, "CustomMsg");
        $this->Fields['SPPBILLUSER'] = &$this->SPPBILLUSER;

        // SPPKASIRDATE
        $this->SPPKASIRDATE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPKASIRDATE', 'SPPKASIRDATE', '[SPPKASIRDATE]', CastDateFieldForLike("[SPPKASIRDATE]", 0, "DB"), 135, 8, 0, false, '[SPPKASIRDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPKASIRDATE->Sortable = false; // Allow sort
        $this->SPPKASIRDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SPPKASIRDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPKASIRDATE->Param, "CustomMsg");
        $this->Fields['SPPKASIRDATE'] = &$this->SPPKASIRDATE;

        // SPPKASIRUSER
        $this->SPPKASIRUSER = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPKASIRUSER', 'SPPKASIRUSER', '[SPPKASIRUSER]', '[SPPKASIRUSER]', 200, 50, -1, false, '[SPPKASIRUSER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPKASIRUSER->Sortable = false; // Allow sort
        $this->SPPKASIRUSER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPKASIRUSER->Param, "CustomMsg");
        $this->Fields['SPPKASIRUSER'] = &$this->SPPKASIRUSER;

        // SPPPOLI
        $this->SPPPOLI = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPPOLI', 'SPPPOLI', '[SPPPOLI]', '[SPPPOLI]', 200, 50, -1, false, '[SPPPOLI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPPOLI->Sortable = false; // Allow sort
        $this->SPPPOLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPPOLI->Param, "CustomMsg");
        $this->Fields['SPPPOLI'] = &$this->SPPPOLI;

        // SPPPOLIUSER
        $this->SPPPOLIUSER = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPPOLIUSER', 'SPPPOLIUSER', '[SPPPOLIUSER]', '[SPPPOLIUSER]', 200, 50, -1, false, '[SPPPOLIUSER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPPOLIUSER->Sortable = false; // Allow sort
        $this->SPPPOLIUSER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPPOLIUSER->Param, "CustomMsg");
        $this->Fields['SPPPOLIUSER'] = &$this->SPPPOLIUSER;

        // SPPPOLIDATE
        $this->SPPPOLIDATE = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_SPPPOLIDATE', 'SPPPOLIDATE', '[SPPPOLIDATE]', CastDateFieldForLike("[SPPPOLIDATE]", 0, "DB"), 135, 8, 0, false, '[SPPPOLIDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPPOLIDATE->Sortable = false; // Allow sort
        $this->SPPPOLIDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SPPPOLIDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPPOLIDATE->Param, "CustomMsg");
        $this->Fields['SPPPOLIDATE'] = &$this->SPPPOLIDATE;

        // nota_temp
        $this->nota_temp = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_nota_temp', 'nota_temp', '[nota_temp]', '[nota_temp]', 200, 50, -1, false, '[nota_temp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nota_temp->Sortable = false; // Allow sort
        $this->nota_temp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nota_temp->Param, "CustomMsg");
        $this->Fields['nota_temp'] = &$this->nota_temp;

        // CLINIC_ID_TEMP
        $this->CLINIC_ID_TEMP = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_CLINIC_ID_TEMP', 'CLINIC_ID_TEMP', '[CLINIC_ID_TEMP]', '[CLINIC_ID_TEMP]', 200, 50, -1, false, '[CLINIC_ID_TEMP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID_TEMP->Sortable = false; // Allow sort
        $this->CLINIC_ID_TEMP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID_TEMP->Param, "CustomMsg");
        $this->Fields['CLINIC_ID_TEMP'] = &$this->CLINIC_ID_TEMP;

        // NOSEP
        $this->NOSEP = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_NOSEP', 'NOSEP', '[NOSEP]', '[NOSEP]', 200, 50, -1, false, '[NOSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSEP->Sortable = false; // Allow sort
        $this->NOSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSEP->Param, "CustomMsg");
        $this->Fields['NOSEP'] = &$this->NOSEP;

        // ID
        $this->ID = new DbField('TREATMENT_BILL', 'TREATMENT_BILL', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 3, 4, -1, false, '[ID]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->Nullable = false; // NOT NULL field
        $this->ID->Sortable = false; // Allow sort
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID->Param, "CustomMsg");
        $this->Fields['ID'] = &$this->ID;
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

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Session master WHERE clause
    public function getMasterFilter()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "V_LABORATORIUM") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "V_RADIOLOGI") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "V_FARMASI") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "V_KASIR") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Session detail WHERE clause
    public function getDetailFilter()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "V_LABORATORIUM") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "V_RADIOLOGI") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "V_FARMASI") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "V_KASIR") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    // Master filter
    public function sqlMasterFilter_V_LABORATORIUM()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }
    // Detail filter
    public function sqlDetailFilter_V_LABORATORIUM()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }

    // Master filter
    public function sqlMasterFilter_V_RADIOLOGI()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }
    // Detail filter
    public function sqlDetailFilter_V_RADIOLOGI()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }

    // Master filter
    public function sqlMasterFilter_V_FARMASI()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }
    // Detail filter
    public function sqlDetailFilter_V_FARMASI()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }

    // Master filter
    public function sqlMasterFilter_V_KASIR()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }
    // Detail filter
    public function sqlDetailFilter_V_KASIR()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE"));
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "TREATMENT_AKOMODASI") {
            $detailUrl = Container("TREATMENT_AKOMODASI")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_BILL_ID", $this->BILL_ID->CurrentValue);
            $detailUrl .= "&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "TreatmentBillList";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[TREATMENT_BILL]";
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
            // Get insert id if necessary
            $this->ID->setDbValue($conn->lastInsertId());
            $rs['ID'] = $this->ID->DbValue;
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
            if (array_key_exists('ID', $rs)) {
                AddFilter($where, QuotedName('ID', $this->Dbid) . '=' . QuotedValue($rs['ID'], $this->ID->DataType, $this->Dbid));
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
        $this->BILL_ID->DbValue = $row['BILL_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->TARIF_ID->DbValue = $row['TARIF_ID'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->CLINIC_ID_FROM->DbValue = $row['CLINIC_ID_FROM'];
        $this->TREATMENT->DbValue = $row['TREATMENT'];
        $this->TREAT_DATE->DbValue = $row['TREAT_DATE'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->QUANTITY->DbValue = $row['QUANTITY'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->POKOK_JUAL->DbValue = $row['POKOK_JUAL'];
        $this->PPN->DbValue = $row['PPN'];
        $this->MARGIN->DbValue = $row['MARGIN'];
        $this->SUBSIDI->DbValue = $row['SUBSIDI'];
        $this->EMBALACE->DbValue = $row['EMBALACE'];
        $this->PROFESI->DbValue = $row['PROFESI'];
        $this->DISCOUNT->DbValue = $row['DISCOUNT'];
        $this->PAY_METHOD_ID->DbValue = $row['PAY_METHOD_ID'];
        $this->PAYMENT_DATE->DbValue = $row['PAYMENT_DATE'];
        $this->ISLUNAS->DbValue = $row['ISLUNAS'];
        $this->DUEDATE_ANGSURAN->DbValue = $row['DUEDATE_ANGSURAN'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->KUITANSI_ID->DbValue = $row['KUITANSI_ID'];
        $this->NOTA_NO->DbValue = $row['NOTA_NO'];
        $this->ISCETAK->DbValue = $row['ISCETAK'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->RESEP_NO->DbValue = $row['RESEP_NO'];
        $this->RESEP_KE->DbValue = $row['RESEP_KE'];
        $this->DOSE->DbValue = $row['DOSE'];
        $this->ORIG_DOSE->DbValue = $row['ORIG_DOSE'];
        $this->DOSE_PRESC->DbValue = $row['DOSE_PRESC'];
        $this->ITER->DbValue = $row['ITER'];
        $this->ITER_KE->DbValue = $row['ITER_KE'];
        $this->SOLD_STATUS->DbValue = $row['SOLD_STATUS'];
        $this->RACIKAN->DbValue = $row['RACIKAN'];
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->KELUAR_ID->DbValue = $row['KELUAR_ID'];
        $this->BED_ID->DbValue = $row['BED_ID'];
        $this->PERDA_ID->DbValue = $row['PERDA_ID'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->DESCRIPTION2->DbValue = $row['DESCRIPTION2'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->BRAND_ID->DbValue = $row['BRAND_ID'];
        $this->DOCTOR->DbValue = $row['DOCTOR'];
        $this->JML_BKS->DbValue = $row['JML_BKS'];
        $this->EXIT_DATE->DbValue = $row['EXIT_DATE'];
        $this->FA_V->DbValue = $row['FA_V'];
        $this->TASK_ID->DbValue = $row['TASK_ID'];
        $this->EMPLOYEE_ID_FROM->DbValue = $row['EMPLOYEE_ID_FROM'];
        $this->DOCTOR_FROM->DbValue = $row['DOCTOR_FROM'];
        $this->status_pasien_id->DbValue = $row['status_pasien_id'];
        $this->amount_paid->DbValue = $row['amount_paid'];
        $this->THENAME->DbValue = $row['THENAME'];
        $this->THEADDRESS->DbValue = $row['THEADDRESS'];
        $this->THEID->DbValue = $row['THEID'];
        $this->serial_nb->DbValue = $row['serial_nb'];
        $this->TREATMENT_PLAFOND->DbValue = $row['TREATMENT_PLAFOND'];
        $this->AMOUNT_PLAFOND->DbValue = $row['AMOUNT_PLAFOND'];
        $this->AMOUNT_PAID_PLAFOND->DbValue = $row['AMOUNT_PAID_PLAFOND'];
        $this->CLASS_ID_PLAFOND->DbValue = $row['CLASS_ID_PLAFOND'];
        $this->PAYOR_ID->DbValue = $row['PAYOR_ID'];
        $this->PEMBULATAN->DbValue = $row['PEMBULATAN'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->AGEYEAR->DbValue = $row['AGEYEAR'];
        $this->AGEMONTH->DbValue = $row['AGEMONTH'];
        $this->AGEDAY->DbValue = $row['AGEDAY'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->CORRECTION_ID->DbValue = $row['CORRECTION_ID'];
        $this->CORRECTION_BY->DbValue = $row['CORRECTION_BY'];
        $this->KARYAWAN->DbValue = $row['KARYAWAN'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->sell_price->DbValue = $row['sell_price'];
        $this->diskon->DbValue = $row['diskon'];
        $this->INVOICE_ID->DbValue = $row['INVOICE_ID'];
        $this->NUMER->DbValue = $row['NUMER'];
        $this->MEASURE_ID2->DbValue = $row['MEASURE_ID2'];
        $this->POTONGAN->DbValue = $row['POTONGAN'];
        $this->BAYAR->DbValue = $row['BAYAR'];
        $this->RETUR->DbValue = $row['RETUR'];
        $this->TARIF_TYPE->DbValue = $row['TARIF_TYPE'];
        $this->PPNVALUE->DbValue = $row['PPNVALUE'];
        $this->TAGIHAN->DbValue = $row['TAGIHAN'];
        $this->KOREKSI->DbValue = $row['KOREKSI'];
        $this->STATUS_OBAT->DbValue = $row['STATUS_OBAT'];
        $this->SUBSIDISAT->DbValue = $row['SUBSIDISAT'];
        $this->PRINTQ->DbValue = $row['PRINTQ'];
        $this->PRINTED_BY->DbValue = $row['PRINTED_BY'];
        $this->STOCK_AVAILABLE->DbValue = $row['STOCK_AVAILABLE'];
        $this->STATUS_TARIF->DbValue = $row['STATUS_TARIF'];
        $this->CLINIC_TYPE->DbValue = $row['CLINIC_TYPE'];
        $this->PACKAGE_ID->DbValue = $row['PACKAGE_ID'];
        $this->MODULE_ID->DbValue = $row['MODULE_ID'];
        $this->profession->DbValue = $row['profession'];
        $this->THEORDER->DbValue = $row['THEORDER'];
        $this->CASHIER->DbValue = $row['CASHIER'];
        $this->SPPFEE->DbValue = $row['SPPFEE'];
        $this->SPPBILL->DbValue = $row['SPPBILL'];
        $this->SPPRJK->DbValue = $row['SPPRJK'];
        $this->SPPJMN->DbValue = $row['SPPJMN'];
        $this->SPPKASIR->DbValue = $row['SPPKASIR'];
        $this->PERUJUK->DbValue = $row['PERUJUK'];
        $this->PERUJUKFEE->DbValue = $row['PERUJUKFEE'];
        $this->modified_datesys->DbValue = $row['modified_datesys'];
        $this->TRANS_ID->DbValue = $row['TRANS_ID'];
        $this->SPPBILLDATE->DbValue = $row['SPPBILLDATE'];
        $this->SPPBILLUSER->DbValue = $row['SPPBILLUSER'];
        $this->SPPKASIRDATE->DbValue = $row['SPPKASIRDATE'];
        $this->SPPKASIRUSER->DbValue = $row['SPPKASIRUSER'];
        $this->SPPPOLI->DbValue = $row['SPPPOLI'];
        $this->SPPPOLIUSER->DbValue = $row['SPPPOLIUSER'];
        $this->SPPPOLIDATE->DbValue = $row['SPPPOLIDATE'];
        $this->nota_temp->DbValue = $row['nota_temp'];
        $this->CLINIC_ID_TEMP->DbValue = $row['CLINIC_ID_TEMP'];
        $this->NOSEP->DbValue = $row['NOSEP'];
        $this->ID->DbValue = $row['ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ID] = @ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->ID->CurrentValue : $this->ID->OldValue;
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
                $this->ID->CurrentValue = $keys[0];
            } else {
                $this->ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ID', $row) ? $row['ID'] : null;
        } else {
            $val = $this->ID->OldValue !== null ? $this->ID->OldValue : $this->ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("TreatmentBillList");
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
        if ($pageName == "TreatmentBillView") {
            return $Language->phrase("View");
        } elseif ($pageName == "TreatmentBillEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "TreatmentBillAdd") {
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
                return "TreatmentBillView";
            case Config("API_ADD_ACTION"):
                return "TreatmentBillAdd";
            case Config("API_EDIT_ACTION"):
                return "TreatmentBillEdit";
            case Config("API_DELETE_ACTION"):
                return "TreatmentBillDelete";
            case Config("API_LIST_ACTION"):
                return "TreatmentBillList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "TreatmentBillList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TreatmentBillView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("TreatmentBillView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "TreatmentBillAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "TreatmentBillAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TreatmentBillEdit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("TreatmentBillEdit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        if ($parm != "") {
            $url = $this->keyUrl("TreatmentBillAdd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("TreatmentBillAdd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        return $this->keyUrl("TreatmentBillDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "V_LABORATORIUM" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue ?? $this->VISIT_ID->getSessionValue());
        }
        if ($this->getCurrentMasterTable() == "V_RADIOLOGI" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue ?? $this->VISIT_ID->getSessionValue());
        }
        if ($this->getCurrentMasterTable() == "V_FARMASI" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue ?? $this->VISIT_ID->getSessionValue());
        }
        if ($this->getCurrentMasterTable() == "V_KASIR" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue ?? $this->VISIT_ID->getSessionValue());
        }
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "ID:" . JsonEncode($this->ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ID->CurrentValue);
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
            if (($keyValue = Param("ID") ?? Route("ID")) !== null) {
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
                if (!is_numeric($key)) {
                    continue;
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
                $this->ID->CurrentValue = $key;
            } else {
                $this->ID->OldValue = $key;
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
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->CLINIC_ID_FROM->setDbValue($row['CLINIC_ID_FROM']);
        $this->TREATMENT->setDbValue($row['TREATMENT']);
        $this->TREAT_DATE->setDbValue($row['TREAT_DATE']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->QUANTITY->setDbValue($row['QUANTITY']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->POKOK_JUAL->setDbValue($row['POKOK_JUAL']);
        $this->PPN->setDbValue($row['PPN']);
        $this->MARGIN->setDbValue($row['MARGIN']);
        $this->SUBSIDI->setDbValue($row['SUBSIDI']);
        $this->EMBALACE->setDbValue($row['EMBALACE']);
        $this->PROFESI->setDbValue($row['PROFESI']);
        $this->DISCOUNT->setDbValue($row['DISCOUNT']);
        $this->PAY_METHOD_ID->setDbValue($row['PAY_METHOD_ID']);
        $this->PAYMENT_DATE->setDbValue($row['PAYMENT_DATE']);
        $this->ISLUNAS->setDbValue($row['ISLUNAS']);
        $this->DUEDATE_ANGSURAN->setDbValue($row['DUEDATE_ANGSURAN']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->KUITANSI_ID->setDbValue($row['KUITANSI_ID']);
        $this->NOTA_NO->setDbValue($row['NOTA_NO']);
        $this->ISCETAK->setDbValue($row['ISCETAK']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->RESEP_NO->setDbValue($row['RESEP_NO']);
        $this->RESEP_KE->setDbValue($row['RESEP_KE']);
        $this->DOSE->setDbValue($row['DOSE']);
        $this->ORIG_DOSE->setDbValue($row['ORIG_DOSE']);
        $this->DOSE_PRESC->setDbValue($row['DOSE_PRESC']);
        $this->ITER->setDbValue($row['ITER']);
        $this->ITER_KE->setDbValue($row['ITER_KE']);
        $this->SOLD_STATUS->setDbValue($row['SOLD_STATUS']);
        $this->RACIKAN->setDbValue($row['RACIKAN']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->PERDA_ID->setDbValue($row['PERDA_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->DESCRIPTION2->setDbValue($row['DESCRIPTION2']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->BRAND_ID->setDbValue($row['BRAND_ID']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->JML_BKS->setDbValue($row['JML_BKS']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->TASK_ID->setDbValue($row['TASK_ID']);
        $this->EMPLOYEE_ID_FROM->setDbValue($row['EMPLOYEE_ID_FROM']);
        $this->DOCTOR_FROM->setDbValue($row['DOCTOR_FROM']);
        $this->status_pasien_id->setDbValue($row['status_pasien_id']);
        $this->amount_paid->setDbValue($row['amount_paid']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEID->setDbValue($row['THEID']);
        $this->serial_nb->setDbValue($row['serial_nb']);
        $this->TREATMENT_PLAFOND->setDbValue($row['TREATMENT_PLAFOND']);
        $this->AMOUNT_PLAFOND->setDbValue($row['AMOUNT_PLAFOND']);
        $this->AMOUNT_PAID_PLAFOND->setDbValue($row['AMOUNT_PAID_PLAFOND']);
        $this->CLASS_ID_PLAFOND->setDbValue($row['CLASS_ID_PLAFOND']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->PEMBULATAN->setDbValue($row['PEMBULATAN']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->CORRECTION_ID->setDbValue($row['CORRECTION_ID']);
        $this->CORRECTION_BY->setDbValue($row['CORRECTION_BY']);
        $this->KARYAWAN->setDbValue($row['KARYAWAN']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->sell_price->setDbValue($row['sell_price']);
        $this->diskon->setDbValue($row['diskon']);
        $this->INVOICE_ID->setDbValue($row['INVOICE_ID']);
        $this->NUMER->setDbValue($row['NUMER']);
        $this->MEASURE_ID2->setDbValue($row['MEASURE_ID2']);
        $this->POTONGAN->setDbValue($row['POTONGAN']);
        $this->BAYAR->setDbValue($row['BAYAR']);
        $this->RETUR->setDbValue($row['RETUR']);
        $this->TARIF_TYPE->setDbValue($row['TARIF_TYPE']);
        $this->PPNVALUE->setDbValue($row['PPNVALUE']);
        $this->TAGIHAN->setDbValue($row['TAGIHAN']);
        $this->KOREKSI->setDbValue($row['KOREKSI']);
        $this->STATUS_OBAT->setDbValue($row['STATUS_OBAT']);
        $this->SUBSIDISAT->setDbValue($row['SUBSIDISAT']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->STOCK_AVAILABLE->setDbValue($row['STOCK_AVAILABLE']);
        $this->STATUS_TARIF->setDbValue($row['STATUS_TARIF']);
        $this->CLINIC_TYPE->setDbValue($row['CLINIC_TYPE']);
        $this->PACKAGE_ID->setDbValue($row['PACKAGE_ID']);
        $this->MODULE_ID->setDbValue($row['MODULE_ID']);
        $this->profession->setDbValue($row['profession']);
        $this->THEORDER->setDbValue($row['THEORDER']);
        $this->CASHIER->setDbValue($row['CASHIER']);
        $this->SPPFEE->setDbValue($row['SPPFEE']);
        $this->SPPBILL->setDbValue($row['SPPBILL']);
        $this->SPPRJK->setDbValue($row['SPPRJK']);
        $this->SPPJMN->setDbValue($row['SPPJMN']);
        $this->SPPKASIR->setDbValue($row['SPPKASIR']);
        $this->PERUJUK->setDbValue($row['PERUJUK']);
        $this->PERUJUKFEE->setDbValue($row['PERUJUKFEE']);
        $this->modified_datesys->setDbValue($row['modified_datesys']);
        $this->TRANS_ID->setDbValue($row['TRANS_ID']);
        $this->SPPBILLDATE->setDbValue($row['SPPBILLDATE']);
        $this->SPPBILLUSER->setDbValue($row['SPPBILLUSER']);
        $this->SPPKASIRDATE->setDbValue($row['SPPKASIRDATE']);
        $this->SPPKASIRUSER->setDbValue($row['SPPKASIRUSER']);
        $this->SPPPOLI->setDbValue($row['SPPPOLI']);
        $this->SPPPOLIUSER->setDbValue($row['SPPPOLIUSER']);
        $this->SPPPOLIDATE->setDbValue($row['SPPPOLIDATE']);
        $this->nota_temp->setDbValue($row['nota_temp']);
        $this->CLINIC_ID_TEMP->setDbValue($row['CLINIC_ID_TEMP']);
        $this->NOSEP->setDbValue($row['NOSEP']);
        $this->ID->setDbValue($row['ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->CellCssStyle = "white-space: nowrap;";

        // BILL_ID
        $this->BILL_ID->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // TARIF_ID

        // CLASS_ID
        $this->CLASS_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // TREATMENT
        $this->TREATMENT->CellCssStyle = "white-space: nowrap;";

        // TREAT_DATE
        $this->TREAT_DATE->CellCssStyle = "white-space: nowrap;";

        // AMOUNT
        $this->AMOUNT->CellCssStyle = "white-space: nowrap;";

        // QUANTITY
        $this->QUANTITY->CellCssStyle = "white-space: nowrap;";

        // MEASURE_ID
        $this->MEASURE_ID->CellCssStyle = "white-space: nowrap;";

        // POKOK_JUAL
        $this->POKOK_JUAL->CellCssStyle = "white-space: nowrap;";

        // PPN
        $this->PPN->CellCssStyle = "white-space: nowrap;";

        // MARGIN
        $this->MARGIN->CellCssStyle = "white-space: nowrap;";

        // SUBSIDI
        $this->SUBSIDI->CellCssStyle = "white-space: nowrap;";

        // EMBALACE
        $this->EMBALACE->CellCssStyle = "white-space: nowrap;";

        // PROFESI
        $this->PROFESI->CellCssStyle = "white-space: nowrap;";

        // DISCOUNT
        $this->DISCOUNT->CellCssStyle = "white-space: nowrap;";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->CellCssStyle = "white-space: nowrap;";

        // PAYMENT_DATE
        $this->PAYMENT_DATE->CellCssStyle = "white-space: nowrap;";

        // ISLUNAS
        $this->ISLUNAS->CellCssStyle = "white-space: nowrap;";

        // DUEDATE_ANGSURAN
        $this->DUEDATE_ANGSURAN->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // KUITANSI_ID
        $this->KUITANSI_ID->CellCssStyle = "white-space: nowrap;";

        // NOTA_NO
        $this->NOTA_NO->CellCssStyle = "white-space: nowrap;";

        // ISCETAK
        $this->ISCETAK->CellCssStyle = "white-space: nowrap;";

        // PRINT_DATE
        $this->PRINT_DATE->CellCssStyle = "white-space: nowrap;";

        // RESEP_NO
        $this->RESEP_NO->CellCssStyle = "white-space: nowrap;";

        // RESEP_KE
        $this->RESEP_KE->CellCssStyle = "white-space: nowrap;";

        // DOSE
        $this->DOSE->CellCssStyle = "white-space: nowrap;";

        // ORIG_DOSE
        $this->ORIG_DOSE->CellCssStyle = "white-space: nowrap;";

        // DOSE_PRESC
        $this->DOSE_PRESC->CellCssStyle = "white-space: nowrap;";

        // ITER
        $this->ITER->CellCssStyle = "white-space: nowrap;";

        // ITER_KE
        $this->ITER_KE->CellCssStyle = "white-space: nowrap;";

        // SOLD_STATUS
        $this->SOLD_STATUS->CellCssStyle = "white-space: nowrap;";

        // RACIKAN
        $this->RACIKAN->CellCssStyle = "white-space: nowrap;";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->CellCssStyle = "white-space: nowrap;";

        // KELUAR_ID
        $this->KELUAR_ID->CellCssStyle = "white-space: nowrap;";

        // BED_ID
        $this->BED_ID->CellCssStyle = "white-space: nowrap;";

        // PERDA_ID
        $this->PERDA_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION2
        $this->DESCRIPTION2->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // BRAND_ID
        $this->BRAND_ID->CellCssStyle = "white-space: nowrap;";

        // DOCTOR
        $this->DOCTOR->CellCssStyle = "white-space: nowrap;";

        // JML_BKS
        $this->JML_BKS->CellCssStyle = "white-space: nowrap;";

        // EXIT_DATE
        $this->EXIT_DATE->CellCssStyle = "white-space: nowrap;";

        // FA_V
        $this->FA_V->CellCssStyle = "white-space: nowrap;";

        // TASK_ID
        $this->TASK_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // DOCTOR_FROM
        $this->DOCTOR_FROM->CellCssStyle = "white-space: nowrap;";

        // status_pasien_id
        $this->status_pasien_id->CellCssStyle = "white-space: nowrap;";

        // amount_paid
        $this->amount_paid->CellCssStyle = "white-space: nowrap;";

        // THENAME
        $this->THENAME->CellCssStyle = "white-space: nowrap;";

        // THEADDRESS
        $this->THEADDRESS->CellCssStyle = "white-space: nowrap;";

        // THEID
        $this->THEID->CellCssStyle = "white-space: nowrap;";

        // serial_nb
        $this->serial_nb->CellCssStyle = "white-space: nowrap;";

        // TREATMENT_PLAFOND
        $this->TREATMENT_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // AMOUNT_PLAFOND
        $this->AMOUNT_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // AMOUNT_PAID_PLAFOND
        $this->AMOUNT_PAID_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // PAYOR_ID
        $this->PAYOR_ID->CellCssStyle = "white-space: nowrap;";

        // PEMBULATAN
        $this->PEMBULATAN->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // AGEYEAR
        $this->AGEYEAR->CellCssStyle = "white-space: nowrap;";

        // AGEMONTH
        $this->AGEMONTH->CellCssStyle = "white-space: nowrap;";

        // AGEDAY
        $this->AGEDAY->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // CORRECTION_ID
        $this->CORRECTION_ID->CellCssStyle = "white-space: nowrap;";

        // CORRECTION_BY
        $this->CORRECTION_BY->CellCssStyle = "white-space: nowrap;";

        // KARYAWAN
        $this->KARYAWAN->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // sell_price
        $this->sell_price->CellCssStyle = "white-space: nowrap;";

        // diskon
        $this->diskon->CellCssStyle = "white-space: nowrap;";

        // INVOICE_ID
        $this->INVOICE_ID->CellCssStyle = "white-space: nowrap;";

        // NUMER
        $this->NUMER->CellCssStyle = "white-space: nowrap;";

        // MEASURE_ID2
        $this->MEASURE_ID2->CellCssStyle = "white-space: nowrap;";

        // POTONGAN
        $this->POTONGAN->CellCssStyle = "white-space: nowrap;";

        // BAYAR
        $this->BAYAR->CellCssStyle = "white-space: nowrap;";

        // RETUR
        $this->RETUR->CellCssStyle = "white-space: nowrap;";

        // TARIF_TYPE
        $this->TARIF_TYPE->CellCssStyle = "white-space: nowrap;";

        // PPNVALUE
        $this->PPNVALUE->CellCssStyle = "white-space: nowrap;";

        // TAGIHAN
        $this->TAGIHAN->CellCssStyle = "white-space: nowrap;";

        // KOREKSI
        $this->KOREKSI->CellCssStyle = "white-space: nowrap;";

        // STATUS_OBAT
        $this->STATUS_OBAT->CellCssStyle = "white-space: nowrap;";

        // SUBSIDISAT
        $this->SUBSIDISAT->CellCssStyle = "white-space: nowrap;";

        // PRINTQ
        $this->PRINTQ->CellCssStyle = "white-space: nowrap;";

        // PRINTED_BY
        $this->PRINTED_BY->CellCssStyle = "white-space: nowrap;";

        // STOCK_AVAILABLE
        $this->STOCK_AVAILABLE->CellCssStyle = "white-space: nowrap;";

        // STATUS_TARIF
        $this->STATUS_TARIF->CellCssStyle = "white-space: nowrap;";

        // CLINIC_TYPE
        $this->CLINIC_TYPE->CellCssStyle = "white-space: nowrap;";

        // PACKAGE_ID
        $this->PACKAGE_ID->CellCssStyle = "white-space: nowrap;";

        // MODULE_ID
        $this->MODULE_ID->CellCssStyle = "white-space: nowrap;";

        // profession
        $this->profession->CellCssStyle = "white-space: nowrap;";

        // THEORDER
        $this->THEORDER->CellCssStyle = "white-space: nowrap;";

        // CASHIER
        $this->CASHIER->CellCssStyle = "white-space: nowrap;";

        // SPPFEE
        $this->SPPFEE->CellCssStyle = "white-space: nowrap;";

        // SPPBILL
        $this->SPPBILL->CellCssStyle = "white-space: nowrap;";

        // SPPRJK
        $this->SPPRJK->CellCssStyle = "white-space: nowrap;";

        // SPPJMN
        $this->SPPJMN->CellCssStyle = "white-space: nowrap;";

        // SPPKASIR
        $this->SPPKASIR->CellCssStyle = "white-space: nowrap;";

        // PERUJUK
        $this->PERUJUK->CellCssStyle = "white-space: nowrap;";

        // PERUJUKFEE
        $this->PERUJUKFEE->CellCssStyle = "white-space: nowrap;";

        // modified_datesys
        $this->modified_datesys->CellCssStyle = "white-space: nowrap;";

        // TRANS_ID
        $this->TRANS_ID->CellCssStyle = "white-space: nowrap;";

        // SPPBILLDATE
        $this->SPPBILLDATE->CellCssStyle = "white-space: nowrap;";

        // SPPBILLUSER
        $this->SPPBILLUSER->CellCssStyle = "white-space: nowrap;";

        // SPPKASIRDATE
        $this->SPPKASIRDATE->CellCssStyle = "white-space: nowrap;";

        // SPPKASIRUSER
        $this->SPPKASIRUSER->CellCssStyle = "white-space: nowrap;";

        // SPPPOLI
        $this->SPPPOLI->CellCssStyle = "white-space: nowrap;";

        // SPPPOLIUSER
        $this->SPPPOLIUSER->CellCssStyle = "white-space: nowrap;";

        // SPPPOLIDATE
        $this->SPPPOLIDATE->CellCssStyle = "white-space: nowrap;";

        // nota_temp
        $this->nota_temp->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID_TEMP
        $this->CLINIC_ID_TEMP->CellCssStyle = "white-space: nowrap;";

        // NOSEP
        $this->NOSEP->CellCssStyle = "white-space: nowrap;";

        // ID
        $this->ID->CellCssStyle = "white-space: nowrap;";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // BILL_ID
        $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $curVal = trim(strval($this->NO_REGISTRATION->CurrentValue));
        if ($curVal != "") {
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->lookupCacheOption($curVal);
            if ($this->NO_REGISTRATION->ViewValue === null) { // Lookup from database
                $filterWrk = "[NO_REGISTRATION]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->NO_REGISTRATION->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->NO_REGISTRATION->Lookup->renderViewRow($rswrk[0]);
                    $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->displayValue($arwrk);
                } else {
                    $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
                }
            }
        } else {
            $this->NO_REGISTRATION->ViewValue = null;
        }
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // TARIF_ID
        $curVal = trim(strval($this->TARIF_ID->CurrentValue));
        if ($curVal != "") {
            $this->TARIF_ID->ViewValue = $this->TARIF_ID->lookupCacheOption($curVal);
            if ($this->TARIF_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[TARIF_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "[IMPLEMENTED] = 1";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->TARIF_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->TARIF_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->TARIF_ID->ViewValue = $this->TARIF_ID->displayValue($arwrk);
                } else {
                    $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
                }
            }
        } else {
            $this->TARIF_ID->ViewValue = null;
        }
        $this->TARIF_ID->ViewCustomAttributes = "";

        // CLASS_ID
        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
        if ($curVal != "") {
            $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
            if ($this->CLINIC_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLINIC_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->displayValue($arwrk);
                } else {
                    $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
                }
            }
        } else {
            $this->CLINIC_ID->ViewValue = null;
        }
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->CurrentValue;
        $this->CLINIC_ID_FROM->ViewCustomAttributes = "";

        // TREATMENT
        $this->TREATMENT->ViewValue = $this->TREATMENT->CurrentValue;
        $this->TREATMENT->ViewCustomAttributes = "";

        // TREAT_DATE
        $this->TREAT_DATE->ViewValue = $this->TREAT_DATE->CurrentValue;
        $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 11);
        $this->TREAT_DATE->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // QUANTITY
        $this->QUANTITY->ViewValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->ViewValue = FormatNumber($this->QUANTITY->ViewValue, 2, -2, -2, -2);
        $this->QUANTITY->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // POKOK_JUAL
        $this->POKOK_JUAL->ViewValue = $this->POKOK_JUAL->CurrentValue;
        $this->POKOK_JUAL->ViewValue = FormatNumber($this->POKOK_JUAL->ViewValue, 2, -2, -2, -2);
        $this->POKOK_JUAL->ViewCustomAttributes = "";

        // PPN
        $this->PPN->ViewValue = $this->PPN->CurrentValue;
        $this->PPN->ViewValue = FormatNumber($this->PPN->ViewValue, 2, -2, -2, -2);
        $this->PPN->ViewCustomAttributes = "";

        // MARGIN
        $this->MARGIN->ViewValue = $this->MARGIN->CurrentValue;
        $this->MARGIN->ViewValue = FormatNumber($this->MARGIN->ViewValue, 2, -2, -2, -2);
        $this->MARGIN->ViewCustomAttributes = "";

        // SUBSIDI
        $this->SUBSIDI->ViewValue = $this->SUBSIDI->CurrentValue;
        $this->SUBSIDI->ViewValue = FormatNumber($this->SUBSIDI->ViewValue, 2, -2, -2, -2);
        $this->SUBSIDI->ViewCustomAttributes = "";

        // EMBALACE
        $this->EMBALACE->ViewValue = $this->EMBALACE->CurrentValue;
        $this->EMBALACE->ViewValue = FormatNumber($this->EMBALACE->ViewValue, 2, -2, -2, -2);
        $this->EMBALACE->ViewCustomAttributes = "";

        // PROFESI
        $this->PROFESI->ViewValue = $this->PROFESI->CurrentValue;
        $this->PROFESI->ViewValue = FormatNumber($this->PROFESI->ViewValue, 2, -2, -2, -2);
        $this->PROFESI->ViewCustomAttributes = "";

        // DISCOUNT
        $this->DISCOUNT->ViewValue = $this->DISCOUNT->CurrentValue;
        $this->DISCOUNT->ViewValue = FormatNumber($this->DISCOUNT->ViewValue, 2, -2, -2, -2);
        $this->DISCOUNT->ViewCustomAttributes = "";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->ViewValue = $this->PAY_METHOD_ID->CurrentValue;
        $this->PAY_METHOD_ID->ViewValue = FormatNumber($this->PAY_METHOD_ID->ViewValue, 0, -2, -2, -2);
        $this->PAY_METHOD_ID->ViewCustomAttributes = "";

        // PAYMENT_DATE
        $this->PAYMENT_DATE->ViewValue = $this->PAYMENT_DATE->CurrentValue;
        $this->PAYMENT_DATE->ViewValue = FormatDateTime($this->PAYMENT_DATE->ViewValue, 11);
        $this->PAYMENT_DATE->ViewCustomAttributes = "";

        // ISLUNAS
        $this->ISLUNAS->ViewValue = $this->ISLUNAS->CurrentValue;
        $this->ISLUNAS->ViewCustomAttributes = "";

        // DUEDATE_ANGSURAN
        $this->DUEDATE_ANGSURAN->ViewValue = $this->DUEDATE_ANGSURAN->CurrentValue;
        $this->DUEDATE_ANGSURAN->ViewValue = FormatDateTime($this->DUEDATE_ANGSURAN->ViewValue, 0);
        $this->DUEDATE_ANGSURAN->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // KUITANSI_ID
        $this->KUITANSI_ID->ViewValue = $this->KUITANSI_ID->CurrentValue;
        $this->KUITANSI_ID->ViewCustomAttributes = "";

        // NOTA_NO
        $this->NOTA_NO->ViewValue = $this->NOTA_NO->CurrentValue;
        $this->NOTA_NO->ViewCustomAttributes = "";

        // ISCETAK
        $this->ISCETAK->ViewValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->ViewCustomAttributes = "";

        // PRINT_DATE
        $this->PRINT_DATE->ViewValue = $this->PRINT_DATE->CurrentValue;
        $this->PRINT_DATE->ViewValue = FormatDateTime($this->PRINT_DATE->ViewValue, 0);
        $this->PRINT_DATE->ViewCustomAttributes = "";

        // RESEP_NO
        $this->RESEP_NO->ViewValue = $this->RESEP_NO->CurrentValue;
        $this->RESEP_NO->ViewCustomAttributes = "";

        // RESEP_KE
        $this->RESEP_KE->ViewValue = $this->RESEP_KE->CurrentValue;
        $this->RESEP_KE->ViewValue = FormatNumber($this->RESEP_KE->ViewValue, 0, -2, -2, -2);
        $this->RESEP_KE->ViewCustomAttributes = "";

        // DOSE
        $this->DOSE->ViewValue = $this->DOSE->CurrentValue;
        $this->DOSE->ViewValue = FormatNumber($this->DOSE->ViewValue, 2, -2, -2, -2);
        $this->DOSE->ViewCustomAttributes = "";

        // ORIG_DOSE
        $this->ORIG_DOSE->ViewValue = $this->ORIG_DOSE->CurrentValue;
        $this->ORIG_DOSE->ViewValue = FormatNumber($this->ORIG_DOSE->ViewValue, 2, -2, -2, -2);
        $this->ORIG_DOSE->ViewCustomAttributes = "";

        // DOSE_PRESC
        $this->DOSE_PRESC->ViewValue = $this->DOSE_PRESC->CurrentValue;
        $this->DOSE_PRESC->ViewValue = FormatNumber($this->DOSE_PRESC->ViewValue, 2, -2, -2, -2);
        $this->DOSE_PRESC->ViewCustomAttributes = "";

        // ITER
        $this->ITER->ViewValue = $this->ITER->CurrentValue;
        $this->ITER->ViewValue = FormatNumber($this->ITER->ViewValue, 0, -2, -2, -2);
        $this->ITER->ViewCustomAttributes = "";

        // ITER_KE
        $this->ITER_KE->ViewValue = $this->ITER_KE->CurrentValue;
        $this->ITER_KE->ViewValue = FormatNumber($this->ITER_KE->ViewValue, 0, -2, -2, -2);
        $this->ITER_KE->ViewCustomAttributes = "";

        // SOLD_STATUS
        $this->SOLD_STATUS->ViewValue = $this->SOLD_STATUS->CurrentValue;
        $this->SOLD_STATUS->ViewValue = FormatNumber($this->SOLD_STATUS->ViewValue, 0, -2, -2, -2);
        $this->SOLD_STATUS->ViewCustomAttributes = "";

        // RACIKAN
        $this->RACIKAN->ViewValue = $this->RACIKAN->CurrentValue;
        $this->RACIKAN->ViewValue = FormatNumber($this->RACIKAN->ViewValue, 0, -2, -2, -2);
        $this->RACIKAN->ViewCustomAttributes = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

        // KELUAR_ID
        $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->CurrentValue;
        $this->KELUAR_ID->ViewValue = FormatNumber($this->KELUAR_ID->ViewValue, 0, -2, -2, -2);
        $this->KELUAR_ID->ViewCustomAttributes = "";

        // BED_ID
        $this->BED_ID->ViewValue = $this->BED_ID->CurrentValue;
        $this->BED_ID->ViewValue = FormatNumber($this->BED_ID->ViewValue, 0, -2, -2, -2);
        $this->BED_ID->ViewCustomAttributes = "";

        // PERDA_ID
        $this->PERDA_ID->ViewValue = $this->PERDA_ID->CurrentValue;
        $this->PERDA_ID->ViewValue = FormatNumber($this->PERDA_ID->ViewValue, 0, -2, -2, -2);
        $this->PERDA_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $curVal = trim(strval($this->EMPLOYEE_ID->CurrentValue));
        if ($curVal != "") {
            $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->lookupCacheOption($curVal);
            if ($this->EMPLOYEE_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[EMPLOYEE_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->EMPLOYEE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->EMPLOYEE_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->displayValue($arwrk);
                } else {
                    $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
                }
            }
        } else {
            $this->EMPLOYEE_ID->ViewValue = null;
        }
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // DESCRIPTION2
        $this->DESCRIPTION2->ViewValue = $this->DESCRIPTION2->CurrentValue;
        $this->DESCRIPTION2->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->ViewCustomAttributes = "";

        // BRAND_ID
        $this->BRAND_ID->ViewValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->ViewCustomAttributes = "";

        // DOCTOR
        $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->ViewCustomAttributes = "";

        // JML_BKS
        $this->JML_BKS->ViewValue = $this->JML_BKS->CurrentValue;
        $this->JML_BKS->ViewValue = FormatNumber($this->JML_BKS->ViewValue, 0, -2, -2, -2);
        $this->JML_BKS->ViewCustomAttributes = "";

        // EXIT_DATE
        $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
        $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
        $this->EXIT_DATE->ViewCustomAttributes = "";

        // FA_V
        $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
        $this->FA_V->ViewValue = FormatNumber($this->FA_V->ViewValue, 0, -2, -2, -2);
        $this->FA_V->ViewCustomAttributes = "";

        // TASK_ID
        $this->TASK_ID->ViewValue = $this->TASK_ID->CurrentValue;
        $this->TASK_ID->ViewValue = FormatNumber($this->TASK_ID->ViewValue, 0, -2, -2, -2);
        $this->TASK_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->ViewValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $this->EMPLOYEE_ID_FROM->ViewCustomAttributes = "";

        // DOCTOR_FROM
        $this->DOCTOR_FROM->ViewValue = $this->DOCTOR_FROM->CurrentValue;
        $this->DOCTOR_FROM->ViewCustomAttributes = "";

        // status_pasien_id
        $this->status_pasien_id->ViewValue = $this->status_pasien_id->CurrentValue;
        $this->status_pasien_id->ViewValue = FormatNumber($this->status_pasien_id->ViewValue, 0, -2, -2, -2);
        $this->status_pasien_id->ViewCustomAttributes = "";

        // amount_paid
        $this->amount_paid->ViewValue = $this->amount_paid->CurrentValue;
        $this->amount_paid->ViewValue = FormatNumber($this->amount_paid->ViewValue, 2, -2, -2, -2);
        $this->amount_paid->ViewCustomAttributes = "";

        // THENAME
        $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
        $this->THENAME->ViewCustomAttributes = "";

        // THEADDRESS
        $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
        $this->THEADDRESS->ViewCustomAttributes = "";

        // THEID
        $this->THEID->ViewValue = $this->THEID->CurrentValue;
        $this->THEID->ViewCustomAttributes = "";

        // serial_nb
        $this->serial_nb->ViewValue = $this->serial_nb->CurrentValue;
        $this->serial_nb->ViewCustomAttributes = "";

        // TREATMENT_PLAFOND
        $this->TREATMENT_PLAFOND->ViewValue = $this->TREATMENT_PLAFOND->CurrentValue;
        $this->TREATMENT_PLAFOND->ViewCustomAttributes = "";

        // AMOUNT_PLAFOND
        $this->AMOUNT_PLAFOND->ViewValue = $this->AMOUNT_PLAFOND->CurrentValue;
        $this->AMOUNT_PLAFOND->ViewValue = FormatNumber($this->AMOUNT_PLAFOND->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_PLAFOND->ViewCustomAttributes = "";

        // AMOUNT_PAID_PLAFOND
        $this->AMOUNT_PAID_PLAFOND->ViewValue = $this->AMOUNT_PAID_PLAFOND->CurrentValue;
        $this->AMOUNT_PAID_PLAFOND->ViewValue = FormatNumber($this->AMOUNT_PAID_PLAFOND->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_PAID_PLAFOND->ViewCustomAttributes = "";

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->ViewValue = $this->CLASS_ID_PLAFOND->CurrentValue;
        $this->CLASS_ID_PLAFOND->ViewValue = FormatNumber($this->CLASS_ID_PLAFOND->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID_PLAFOND->ViewCustomAttributes = "";

        // PAYOR_ID
        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->ViewCustomAttributes = "";

        // PEMBULATAN
        $this->PEMBULATAN->ViewValue = $this->PEMBULATAN->CurrentValue;
        $this->PEMBULATAN->ViewValue = FormatNumber($this->PEMBULATAN->ViewValue, 2, -2, -2, -2);
        $this->PEMBULATAN->ViewCustomAttributes = "";

        // ISRJ
        $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
        $this->ISRJ->ViewCustomAttributes = "";

        // AGEYEAR
        $this->AGEYEAR->ViewValue = $this->AGEYEAR->CurrentValue;
        $this->AGEYEAR->ViewValue = FormatNumber($this->AGEYEAR->ViewValue, 0, -2, -2, -2);
        $this->AGEYEAR->ViewCustomAttributes = "";

        // AGEMONTH
        $this->AGEMONTH->ViewValue = $this->AGEMONTH->CurrentValue;
        $this->AGEMONTH->ViewValue = FormatNumber($this->AGEMONTH->ViewValue, 0, -2, -2, -2);
        $this->AGEMONTH->ViewCustomAttributes = "";

        // AGEDAY
        $this->AGEDAY->ViewValue = $this->AGEDAY->CurrentValue;
        $this->AGEDAY->ViewValue = FormatNumber($this->AGEDAY->ViewValue, 0, -2, -2, -2);
        $this->AGEDAY->ViewCustomAttributes = "";

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // CORRECTION_ID
        $this->CORRECTION_ID->ViewValue = $this->CORRECTION_ID->CurrentValue;
        $this->CORRECTION_ID->ViewCustomAttributes = "";

        // CORRECTION_BY
        $this->CORRECTION_BY->ViewValue = $this->CORRECTION_BY->CurrentValue;
        $this->CORRECTION_BY->ViewCustomAttributes = "";

        // KARYAWAN
        $this->KARYAWAN->ViewValue = $this->KARYAWAN->CurrentValue;
        $this->KARYAWAN->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // sell_price
        $this->sell_price->ViewValue = $this->sell_price->CurrentValue;
        $this->sell_price->ViewValue = FormatNumber($this->sell_price->ViewValue, 2, -2, -2, -2);
        $this->sell_price->ViewCustomAttributes = "";

        // diskon
        $this->diskon->ViewValue = $this->diskon->CurrentValue;
        $this->diskon->ViewValue = FormatNumber($this->diskon->ViewValue, 2, -2, -2, -2);
        $this->diskon->ViewCustomAttributes = "";

        // INVOICE_ID
        $this->INVOICE_ID->ViewValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->ViewCustomAttributes = "";

        // NUMER
        $this->NUMER->ViewValue = $this->NUMER->CurrentValue;
        $this->NUMER->ViewCustomAttributes = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->ViewValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->ViewValue = FormatNumber($this->MEASURE_ID2->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID2->ViewCustomAttributes = "";

        // POTONGAN
        $this->POTONGAN->ViewValue = $this->POTONGAN->CurrentValue;
        $this->POTONGAN->ViewValue = FormatNumber($this->POTONGAN->ViewValue, 2, -2, -2, -2);
        $this->POTONGAN->ViewCustomAttributes = "";

        // BAYAR
        $this->BAYAR->ViewValue = $this->BAYAR->CurrentValue;
        $this->BAYAR->ViewValue = FormatNumber($this->BAYAR->ViewValue, 2, -2, -2, -2);
        $this->BAYAR->ViewCustomAttributes = "";

        // RETUR
        $this->RETUR->ViewValue = $this->RETUR->CurrentValue;
        $this->RETUR->ViewValue = FormatNumber($this->RETUR->ViewValue, 2, -2, -2, -2);
        $this->RETUR->ViewCustomAttributes = "";

        // TARIF_TYPE
        $this->TARIF_TYPE->ViewValue = $this->TARIF_TYPE->CurrentValue;
        $this->TARIF_TYPE->ViewCustomAttributes = "";

        // PPNVALUE
        $this->PPNVALUE->ViewValue = $this->PPNVALUE->CurrentValue;
        $this->PPNVALUE->ViewValue = FormatNumber($this->PPNVALUE->ViewValue, 2, -2, -2, -2);
        $this->PPNVALUE->ViewCustomAttributes = "";

        // TAGIHAN
        $this->TAGIHAN->ViewValue = $this->TAGIHAN->CurrentValue;
        $this->TAGIHAN->ViewValue = FormatNumber($this->TAGIHAN->ViewValue, 2, -2, -2, -2);
        $this->TAGIHAN->ViewCustomAttributes = "";

        // KOREKSI
        $this->KOREKSI->ViewValue = $this->KOREKSI->CurrentValue;
        $this->KOREKSI->ViewValue = FormatNumber($this->KOREKSI->ViewValue, 2, -2, -2, -2);
        $this->KOREKSI->ViewCustomAttributes = "";

        // STATUS_OBAT
        $this->STATUS_OBAT->ViewValue = $this->STATUS_OBAT->CurrentValue;
        $this->STATUS_OBAT->ViewValue = FormatNumber($this->STATUS_OBAT->ViewValue, 0, -2, -2, -2);
        $this->STATUS_OBAT->ViewCustomAttributes = "";

        // SUBSIDISAT
        $this->SUBSIDISAT->ViewValue = $this->SUBSIDISAT->CurrentValue;
        $this->SUBSIDISAT->ViewValue = FormatNumber($this->SUBSIDISAT->ViewValue, 2, -2, -2, -2);
        $this->SUBSIDISAT->ViewCustomAttributes = "";

        // PRINTQ
        $this->PRINTQ->ViewValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->ViewValue = FormatNumber($this->PRINTQ->ViewValue, 0, -2, -2, -2);
        $this->PRINTQ->ViewCustomAttributes = "";

        // PRINTED_BY
        $this->PRINTED_BY->ViewValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->ViewCustomAttributes = "";

        // STOCK_AVAILABLE
        $this->STOCK_AVAILABLE->ViewValue = $this->STOCK_AVAILABLE->CurrentValue;
        $this->STOCK_AVAILABLE->ViewValue = FormatNumber($this->STOCK_AVAILABLE->ViewValue, 2, -2, -2, -2);
        $this->STOCK_AVAILABLE->ViewCustomAttributes = "";

        // STATUS_TARIF
        $this->STATUS_TARIF->ViewValue = $this->STATUS_TARIF->CurrentValue;
        $this->STATUS_TARIF->ViewValue = FormatNumber($this->STATUS_TARIF->ViewValue, 0, -2, -2, -2);
        $this->STATUS_TARIF->ViewCustomAttributes = "";

        // CLINIC_TYPE
        $this->CLINIC_TYPE->ViewValue = $this->CLINIC_TYPE->CurrentValue;
        $this->CLINIC_TYPE->ViewValue = FormatNumber($this->CLINIC_TYPE->ViewValue, 0, -2, -2, -2);
        $this->CLINIC_TYPE->ViewCustomAttributes = "";

        // PACKAGE_ID
        $this->PACKAGE_ID->ViewValue = $this->PACKAGE_ID->CurrentValue;
        $this->PACKAGE_ID->ViewCustomAttributes = "";

        // MODULE_ID
        $this->MODULE_ID->ViewValue = $this->MODULE_ID->CurrentValue;
        $this->MODULE_ID->ViewCustomAttributes = "";

        // profession
        $this->profession->ViewValue = $this->profession->CurrentValue;
        $this->profession->ViewValue = FormatNumber($this->profession->ViewValue, 2, -2, -2, -2);
        $this->profession->ViewCustomAttributes = "";

        // THEORDER
        $this->THEORDER->ViewValue = $this->THEORDER->CurrentValue;
        $this->THEORDER->ViewValue = FormatNumber($this->THEORDER->ViewValue, 0, -2, -2, -2);
        $this->THEORDER->ViewCustomAttributes = "";

        // CASHIER
        $this->CASHIER->ViewValue = $this->CASHIER->CurrentValue;
        $this->CASHIER->ViewCustomAttributes = "";

        // SPPFEE
        $this->SPPFEE->ViewValue = $this->SPPFEE->CurrentValue;
        $this->SPPFEE->ViewCustomAttributes = "";

        // SPPBILL
        $this->SPPBILL->ViewValue = $this->SPPBILL->CurrentValue;
        $this->SPPBILL->ViewCustomAttributes = "";

        // SPPRJK
        $this->SPPRJK->ViewValue = $this->SPPRJK->CurrentValue;
        $this->SPPRJK->ViewCustomAttributes = "";

        // SPPJMN
        $this->SPPJMN->ViewValue = $this->SPPJMN->CurrentValue;
        $this->SPPJMN->ViewCustomAttributes = "";

        // SPPKASIR
        $this->SPPKASIR->ViewValue = $this->SPPKASIR->CurrentValue;
        $this->SPPKASIR->ViewCustomAttributes = "";

        // PERUJUK
        $this->PERUJUK->ViewValue = $this->PERUJUK->CurrentValue;
        $this->PERUJUK->ViewCustomAttributes = "";

        // PERUJUKFEE
        $this->PERUJUKFEE->ViewValue = $this->PERUJUKFEE->CurrentValue;
        $this->PERUJUKFEE->ViewValue = FormatNumber($this->PERUJUKFEE->ViewValue, 2, -2, -2, -2);
        $this->PERUJUKFEE->ViewCustomAttributes = "";

        // modified_datesys
        $this->modified_datesys->ViewValue = $this->modified_datesys->CurrentValue;
        $this->modified_datesys->ViewValue = FormatDateTime($this->modified_datesys->ViewValue, 0);
        $this->modified_datesys->ViewCustomAttributes = "";

        // TRANS_ID
        $this->TRANS_ID->ViewValue = $this->TRANS_ID->CurrentValue;
        $this->TRANS_ID->ViewCustomAttributes = "";

        // SPPBILLDATE
        $this->SPPBILLDATE->ViewValue = $this->SPPBILLDATE->CurrentValue;
        $this->SPPBILLDATE->ViewValue = FormatDateTime($this->SPPBILLDATE->ViewValue, 0);
        $this->SPPBILLDATE->ViewCustomAttributes = "";

        // SPPBILLUSER
        $this->SPPBILLUSER->ViewValue = $this->SPPBILLUSER->CurrentValue;
        $this->SPPBILLUSER->ViewCustomAttributes = "";

        // SPPKASIRDATE
        $this->SPPKASIRDATE->ViewValue = $this->SPPKASIRDATE->CurrentValue;
        $this->SPPKASIRDATE->ViewValue = FormatDateTime($this->SPPKASIRDATE->ViewValue, 0);
        $this->SPPKASIRDATE->ViewCustomAttributes = "";

        // SPPKASIRUSER
        $this->SPPKASIRUSER->ViewValue = $this->SPPKASIRUSER->CurrentValue;
        $this->SPPKASIRUSER->ViewCustomAttributes = "";

        // SPPPOLI
        $this->SPPPOLI->ViewValue = $this->SPPPOLI->CurrentValue;
        $this->SPPPOLI->ViewCustomAttributes = "";

        // SPPPOLIUSER
        $this->SPPPOLIUSER->ViewValue = $this->SPPPOLIUSER->CurrentValue;
        $this->SPPPOLIUSER->ViewCustomAttributes = "";

        // SPPPOLIDATE
        $this->SPPPOLIDATE->ViewValue = $this->SPPPOLIDATE->CurrentValue;
        $this->SPPPOLIDATE->ViewValue = FormatDateTime($this->SPPPOLIDATE->ViewValue, 0);
        $this->SPPPOLIDATE->ViewCustomAttributes = "";

        // nota_temp
        $this->nota_temp->ViewValue = $this->nota_temp->CurrentValue;
        $this->nota_temp->ViewCustomAttributes = "";

        // CLINIC_ID_TEMP
        $this->CLINIC_ID_TEMP->ViewValue = $this->CLINIC_ID_TEMP->CurrentValue;
        $this->CLINIC_ID_TEMP->ViewCustomAttributes = "";

        // NOSEP
        $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->ViewCustomAttributes = "";

        // ID
        $this->ID->ViewValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // BILL_ID
        $this->BILL_ID->LinkCustomAttributes = "";
        $this->BILL_ID->HrefValue = "";
        $this->BILL_ID->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // TARIF_ID
        $this->TARIF_ID->LinkCustomAttributes = "";
        $this->TARIF_ID->HrefValue = "";
        $this->TARIF_ID->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->LinkCustomAttributes = "";
        $this->CLINIC_ID_FROM->HrefValue = "";
        $this->CLINIC_ID_FROM->TooltipValue = "";

        // TREATMENT
        $this->TREATMENT->LinkCustomAttributes = "";
        $this->TREATMENT->HrefValue = "";
        $this->TREATMENT->TooltipValue = "";

        // TREAT_DATE
        $this->TREAT_DATE->LinkCustomAttributes = "";
        $this->TREAT_DATE->HrefValue = "";
        $this->TREAT_DATE->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // QUANTITY
        $this->QUANTITY->LinkCustomAttributes = "";
        $this->QUANTITY->HrefValue = "";
        $this->QUANTITY->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // POKOK_JUAL
        $this->POKOK_JUAL->LinkCustomAttributes = "";
        $this->POKOK_JUAL->HrefValue = "";
        $this->POKOK_JUAL->TooltipValue = "";

        // PPN
        $this->PPN->LinkCustomAttributes = "";
        $this->PPN->HrefValue = "";
        $this->PPN->TooltipValue = "";

        // MARGIN
        $this->MARGIN->LinkCustomAttributes = "";
        $this->MARGIN->HrefValue = "";
        $this->MARGIN->TooltipValue = "";

        // SUBSIDI
        $this->SUBSIDI->LinkCustomAttributes = "";
        $this->SUBSIDI->HrefValue = "";
        $this->SUBSIDI->TooltipValue = "";

        // EMBALACE
        $this->EMBALACE->LinkCustomAttributes = "";
        $this->EMBALACE->HrefValue = "";
        $this->EMBALACE->TooltipValue = "";

        // PROFESI
        $this->PROFESI->LinkCustomAttributes = "";
        $this->PROFESI->HrefValue = "";
        $this->PROFESI->TooltipValue = "";

        // DISCOUNT
        $this->DISCOUNT->LinkCustomAttributes = "";
        $this->DISCOUNT->HrefValue = "";
        $this->DISCOUNT->TooltipValue = "";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->LinkCustomAttributes = "";
        $this->PAY_METHOD_ID->HrefValue = "";
        $this->PAY_METHOD_ID->TooltipValue = "";

        // PAYMENT_DATE
        $this->PAYMENT_DATE->LinkCustomAttributes = "";
        $this->PAYMENT_DATE->HrefValue = "";
        $this->PAYMENT_DATE->TooltipValue = "";

        // ISLUNAS
        $this->ISLUNAS->LinkCustomAttributes = "";
        $this->ISLUNAS->HrefValue = "";
        $this->ISLUNAS->TooltipValue = "";

        // DUEDATE_ANGSURAN
        $this->DUEDATE_ANGSURAN->LinkCustomAttributes = "";
        $this->DUEDATE_ANGSURAN->HrefValue = "";
        $this->DUEDATE_ANGSURAN->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // KUITANSI_ID
        $this->KUITANSI_ID->LinkCustomAttributes = "";
        $this->KUITANSI_ID->HrefValue = "";
        $this->KUITANSI_ID->TooltipValue = "";

        // NOTA_NO
        $this->NOTA_NO->LinkCustomAttributes = "";
        $this->NOTA_NO->HrefValue = "";
        $this->NOTA_NO->TooltipValue = "";

        // ISCETAK
        $this->ISCETAK->LinkCustomAttributes = "";
        $this->ISCETAK->HrefValue = "";
        $this->ISCETAK->TooltipValue = "";

        // PRINT_DATE
        $this->PRINT_DATE->LinkCustomAttributes = "";
        $this->PRINT_DATE->HrefValue = "";
        $this->PRINT_DATE->TooltipValue = "";

        // RESEP_NO
        $this->RESEP_NO->LinkCustomAttributes = "";
        $this->RESEP_NO->HrefValue = "";
        $this->RESEP_NO->TooltipValue = "";

        // RESEP_KE
        $this->RESEP_KE->LinkCustomAttributes = "";
        $this->RESEP_KE->HrefValue = "";
        $this->RESEP_KE->TooltipValue = "";

        // DOSE
        $this->DOSE->LinkCustomAttributes = "";
        $this->DOSE->HrefValue = "";
        $this->DOSE->TooltipValue = "";

        // ORIG_DOSE
        $this->ORIG_DOSE->LinkCustomAttributes = "";
        $this->ORIG_DOSE->HrefValue = "";
        $this->ORIG_DOSE->TooltipValue = "";

        // DOSE_PRESC
        $this->DOSE_PRESC->LinkCustomAttributes = "";
        $this->DOSE_PRESC->HrefValue = "";
        $this->DOSE_PRESC->TooltipValue = "";

        // ITER
        $this->ITER->LinkCustomAttributes = "";
        $this->ITER->HrefValue = "";
        $this->ITER->TooltipValue = "";

        // ITER_KE
        $this->ITER_KE->LinkCustomAttributes = "";
        $this->ITER_KE->HrefValue = "";
        $this->ITER_KE->TooltipValue = "";

        // SOLD_STATUS
        $this->SOLD_STATUS->LinkCustomAttributes = "";
        $this->SOLD_STATUS->HrefValue = "";
        $this->SOLD_STATUS->TooltipValue = "";

        // RACIKAN
        $this->RACIKAN->LinkCustomAttributes = "";
        $this->RACIKAN->HrefValue = "";
        $this->RACIKAN->TooltipValue = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
        $this->CLASS_ROOM_ID->HrefValue = "";
        $this->CLASS_ROOM_ID->TooltipValue = "";

        // KELUAR_ID
        $this->KELUAR_ID->LinkCustomAttributes = "";
        $this->KELUAR_ID->HrefValue = "";
        $this->KELUAR_ID->TooltipValue = "";

        // BED_ID
        $this->BED_ID->LinkCustomAttributes = "";
        $this->BED_ID->HrefValue = "";
        $this->BED_ID->TooltipValue = "";

        // PERDA_ID
        $this->PERDA_ID->LinkCustomAttributes = "";
        $this->PERDA_ID->HrefValue = "";
        $this->PERDA_ID->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // DESCRIPTION2
        $this->DESCRIPTION2->LinkCustomAttributes = "";
        $this->DESCRIPTION2->HrefValue = "";
        $this->DESCRIPTION2->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->LinkCustomAttributes = "";
        $this->MODIFIED_FROM->HrefValue = "";
        $this->MODIFIED_FROM->TooltipValue = "";

        // BRAND_ID
        $this->BRAND_ID->LinkCustomAttributes = "";
        $this->BRAND_ID->HrefValue = "";
        $this->BRAND_ID->TooltipValue = "";

        // DOCTOR
        $this->DOCTOR->LinkCustomAttributes = "";
        $this->DOCTOR->HrefValue = "";
        $this->DOCTOR->TooltipValue = "";

        // JML_BKS
        $this->JML_BKS->LinkCustomAttributes = "";
        $this->JML_BKS->HrefValue = "";
        $this->JML_BKS->TooltipValue = "";

        // EXIT_DATE
        $this->EXIT_DATE->LinkCustomAttributes = "";
        $this->EXIT_DATE->HrefValue = "";
        $this->EXIT_DATE->TooltipValue = "";

        // FA_V
        $this->FA_V->LinkCustomAttributes = "";
        $this->FA_V->HrefValue = "";
        $this->FA_V->TooltipValue = "";

        // TASK_ID
        $this->TASK_ID->LinkCustomAttributes = "";
        $this->TASK_ID->HrefValue = "";
        $this->TASK_ID->TooltipValue = "";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID_FROM->HrefValue = "";
        $this->EMPLOYEE_ID_FROM->TooltipValue = "";

        // DOCTOR_FROM
        $this->DOCTOR_FROM->LinkCustomAttributes = "";
        $this->DOCTOR_FROM->HrefValue = "";
        $this->DOCTOR_FROM->TooltipValue = "";

        // status_pasien_id
        $this->status_pasien_id->LinkCustomAttributes = "";
        $this->status_pasien_id->HrefValue = "";
        $this->status_pasien_id->TooltipValue = "";

        // amount_paid
        $this->amount_paid->LinkCustomAttributes = "";
        $this->amount_paid->HrefValue = "";
        $this->amount_paid->TooltipValue = "";

        // THENAME
        $this->THENAME->LinkCustomAttributes = "";
        $this->THENAME->HrefValue = "";
        $this->THENAME->TooltipValue = "";

        // THEADDRESS
        $this->THEADDRESS->LinkCustomAttributes = "";
        $this->THEADDRESS->HrefValue = "";
        $this->THEADDRESS->TooltipValue = "";

        // THEID
        $this->THEID->LinkCustomAttributes = "";
        $this->THEID->HrefValue = "";
        $this->THEID->TooltipValue = "";

        // serial_nb
        $this->serial_nb->LinkCustomAttributes = "";
        $this->serial_nb->HrefValue = "";
        $this->serial_nb->TooltipValue = "";

        // TREATMENT_PLAFOND
        $this->TREATMENT_PLAFOND->LinkCustomAttributes = "";
        $this->TREATMENT_PLAFOND->HrefValue = "";
        $this->TREATMENT_PLAFOND->TooltipValue = "";

        // AMOUNT_PLAFOND
        $this->AMOUNT_PLAFOND->LinkCustomAttributes = "";
        $this->AMOUNT_PLAFOND->HrefValue = "";
        $this->AMOUNT_PLAFOND->TooltipValue = "";

        // AMOUNT_PAID_PLAFOND
        $this->AMOUNT_PAID_PLAFOND->LinkCustomAttributes = "";
        $this->AMOUNT_PAID_PLAFOND->HrefValue = "";
        $this->AMOUNT_PAID_PLAFOND->TooltipValue = "";

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->LinkCustomAttributes = "";
        $this->CLASS_ID_PLAFOND->HrefValue = "";
        $this->CLASS_ID_PLAFOND->TooltipValue = "";

        // PAYOR_ID
        $this->PAYOR_ID->LinkCustomAttributes = "";
        $this->PAYOR_ID->HrefValue = "";
        $this->PAYOR_ID->TooltipValue = "";

        // PEMBULATAN
        $this->PEMBULATAN->LinkCustomAttributes = "";
        $this->PEMBULATAN->HrefValue = "";
        $this->PEMBULATAN->TooltipValue = "";

        // ISRJ
        $this->ISRJ->LinkCustomAttributes = "";
        $this->ISRJ->HrefValue = "";
        $this->ISRJ->TooltipValue = "";

        // AGEYEAR
        $this->AGEYEAR->LinkCustomAttributes = "";
        $this->AGEYEAR->HrefValue = "";
        $this->AGEYEAR->TooltipValue = "";

        // AGEMONTH
        $this->AGEMONTH->LinkCustomAttributes = "";
        $this->AGEMONTH->HrefValue = "";
        $this->AGEMONTH->TooltipValue = "";

        // AGEDAY
        $this->AGEDAY->LinkCustomAttributes = "";
        $this->AGEDAY->HrefValue = "";
        $this->AGEDAY->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // CORRECTION_ID
        $this->CORRECTION_ID->LinkCustomAttributes = "";
        $this->CORRECTION_ID->HrefValue = "";
        $this->CORRECTION_ID->TooltipValue = "";

        // CORRECTION_BY
        $this->CORRECTION_BY->LinkCustomAttributes = "";
        $this->CORRECTION_BY->HrefValue = "";
        $this->CORRECTION_BY->TooltipValue = "";

        // KARYAWAN
        $this->KARYAWAN->LinkCustomAttributes = "";
        $this->KARYAWAN->HrefValue = "";
        $this->KARYAWAN->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // sell_price
        $this->sell_price->LinkCustomAttributes = "";
        $this->sell_price->HrefValue = "";
        $this->sell_price->TooltipValue = "";

        // diskon
        $this->diskon->LinkCustomAttributes = "";
        $this->diskon->HrefValue = "";
        $this->diskon->TooltipValue = "";

        // INVOICE_ID
        $this->INVOICE_ID->LinkCustomAttributes = "";
        $this->INVOICE_ID->HrefValue = "";
        $this->INVOICE_ID->TooltipValue = "";

        // NUMER
        $this->NUMER->LinkCustomAttributes = "";
        $this->NUMER->HrefValue = "";
        $this->NUMER->TooltipValue = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->LinkCustomAttributes = "";
        $this->MEASURE_ID2->HrefValue = "";
        $this->MEASURE_ID2->TooltipValue = "";

        // POTONGAN
        $this->POTONGAN->LinkCustomAttributes = "";
        $this->POTONGAN->HrefValue = "";
        $this->POTONGAN->TooltipValue = "";

        // BAYAR
        $this->BAYAR->LinkCustomAttributes = "";
        $this->BAYAR->HrefValue = "";
        $this->BAYAR->TooltipValue = "";

        // RETUR
        $this->RETUR->LinkCustomAttributes = "";
        $this->RETUR->HrefValue = "";
        $this->RETUR->TooltipValue = "";

        // TARIF_TYPE
        $this->TARIF_TYPE->LinkCustomAttributes = "";
        $this->TARIF_TYPE->HrefValue = "";
        $this->TARIF_TYPE->TooltipValue = "";

        // PPNVALUE
        $this->PPNVALUE->LinkCustomAttributes = "";
        $this->PPNVALUE->HrefValue = "";
        $this->PPNVALUE->TooltipValue = "";

        // TAGIHAN
        $this->TAGIHAN->LinkCustomAttributes = "";
        $this->TAGIHAN->HrefValue = "";
        $this->TAGIHAN->TooltipValue = "";

        // KOREKSI
        $this->KOREKSI->LinkCustomAttributes = "";
        $this->KOREKSI->HrefValue = "";
        $this->KOREKSI->TooltipValue = "";

        // STATUS_OBAT
        $this->STATUS_OBAT->LinkCustomAttributes = "";
        $this->STATUS_OBAT->HrefValue = "";
        $this->STATUS_OBAT->TooltipValue = "";

        // SUBSIDISAT
        $this->SUBSIDISAT->LinkCustomAttributes = "";
        $this->SUBSIDISAT->HrefValue = "";
        $this->SUBSIDISAT->TooltipValue = "";

        // PRINTQ
        $this->PRINTQ->LinkCustomAttributes = "";
        $this->PRINTQ->HrefValue = "";
        $this->PRINTQ->TooltipValue = "";

        // PRINTED_BY
        $this->PRINTED_BY->LinkCustomAttributes = "";
        $this->PRINTED_BY->HrefValue = "";
        $this->PRINTED_BY->TooltipValue = "";

        // STOCK_AVAILABLE
        $this->STOCK_AVAILABLE->LinkCustomAttributes = "";
        $this->STOCK_AVAILABLE->HrefValue = "";
        $this->STOCK_AVAILABLE->TooltipValue = "";

        // STATUS_TARIF
        $this->STATUS_TARIF->LinkCustomAttributes = "";
        $this->STATUS_TARIF->HrefValue = "";
        $this->STATUS_TARIF->TooltipValue = "";

        // CLINIC_TYPE
        $this->CLINIC_TYPE->LinkCustomAttributes = "";
        $this->CLINIC_TYPE->HrefValue = "";
        $this->CLINIC_TYPE->TooltipValue = "";

        // PACKAGE_ID
        $this->PACKAGE_ID->LinkCustomAttributes = "";
        $this->PACKAGE_ID->HrefValue = "";
        $this->PACKAGE_ID->TooltipValue = "";

        // MODULE_ID
        $this->MODULE_ID->LinkCustomAttributes = "";
        $this->MODULE_ID->HrefValue = "";
        $this->MODULE_ID->TooltipValue = "";

        // profession
        $this->profession->LinkCustomAttributes = "";
        $this->profession->HrefValue = "";
        $this->profession->TooltipValue = "";

        // THEORDER
        $this->THEORDER->LinkCustomAttributes = "";
        $this->THEORDER->HrefValue = "";
        $this->THEORDER->TooltipValue = "";

        // CASHIER
        $this->CASHIER->LinkCustomAttributes = "";
        $this->CASHIER->HrefValue = "";
        $this->CASHIER->TooltipValue = "";

        // SPPFEE
        $this->SPPFEE->LinkCustomAttributes = "";
        $this->SPPFEE->HrefValue = "";
        $this->SPPFEE->TooltipValue = "";

        // SPPBILL
        $this->SPPBILL->LinkCustomAttributes = "";
        $this->SPPBILL->HrefValue = "";
        $this->SPPBILL->TooltipValue = "";

        // SPPRJK
        $this->SPPRJK->LinkCustomAttributes = "";
        $this->SPPRJK->HrefValue = "";
        $this->SPPRJK->TooltipValue = "";

        // SPPJMN
        $this->SPPJMN->LinkCustomAttributes = "";
        $this->SPPJMN->HrefValue = "";
        $this->SPPJMN->TooltipValue = "";

        // SPPKASIR
        $this->SPPKASIR->LinkCustomAttributes = "";
        $this->SPPKASIR->HrefValue = "";
        $this->SPPKASIR->TooltipValue = "";

        // PERUJUK
        $this->PERUJUK->LinkCustomAttributes = "";
        $this->PERUJUK->HrefValue = "";
        $this->PERUJUK->TooltipValue = "";

        // PERUJUKFEE
        $this->PERUJUKFEE->LinkCustomAttributes = "";
        $this->PERUJUKFEE->HrefValue = "";
        $this->PERUJUKFEE->TooltipValue = "";

        // modified_datesys
        $this->modified_datesys->LinkCustomAttributes = "";
        $this->modified_datesys->HrefValue = "";
        $this->modified_datesys->TooltipValue = "";

        // TRANS_ID
        $this->TRANS_ID->LinkCustomAttributes = "";
        $this->TRANS_ID->HrefValue = "";
        $this->TRANS_ID->TooltipValue = "";

        // SPPBILLDATE
        $this->SPPBILLDATE->LinkCustomAttributes = "";
        $this->SPPBILLDATE->HrefValue = "";
        $this->SPPBILLDATE->TooltipValue = "";

        // SPPBILLUSER
        $this->SPPBILLUSER->LinkCustomAttributes = "";
        $this->SPPBILLUSER->HrefValue = "";
        $this->SPPBILLUSER->TooltipValue = "";

        // SPPKASIRDATE
        $this->SPPKASIRDATE->LinkCustomAttributes = "";
        $this->SPPKASIRDATE->HrefValue = "";
        $this->SPPKASIRDATE->TooltipValue = "";

        // SPPKASIRUSER
        $this->SPPKASIRUSER->LinkCustomAttributes = "";
        $this->SPPKASIRUSER->HrefValue = "";
        $this->SPPKASIRUSER->TooltipValue = "";

        // SPPPOLI
        $this->SPPPOLI->LinkCustomAttributes = "";
        $this->SPPPOLI->HrefValue = "";
        $this->SPPPOLI->TooltipValue = "";

        // SPPPOLIUSER
        $this->SPPPOLIUSER->LinkCustomAttributes = "";
        $this->SPPPOLIUSER->HrefValue = "";
        $this->SPPPOLIUSER->TooltipValue = "";

        // SPPPOLIDATE
        $this->SPPPOLIDATE->LinkCustomAttributes = "";
        $this->SPPPOLIDATE->HrefValue = "";
        $this->SPPPOLIDATE->TooltipValue = "";

        // nota_temp
        $this->nota_temp->LinkCustomAttributes = "";
        $this->nota_temp->HrefValue = "";
        $this->nota_temp->TooltipValue = "";

        // CLINIC_ID_TEMP
        $this->CLINIC_ID_TEMP->LinkCustomAttributes = "";
        $this->CLINIC_ID_TEMP->HrefValue = "";
        $this->CLINIC_ID_TEMP->TooltipValue = "";

        // NOSEP
        $this->NOSEP->LinkCustomAttributes = "";
        $this->NOSEP->HrefValue = "";
        $this->NOSEP->TooltipValue = "";

        // ID
        $this->ID->LinkCustomAttributes = "";
        $this->ID->HrefValue = "";
        $this->ID->TooltipValue = "";

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

        // BILL_ID

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if ($this->VISIT_ID->getSessionValue() != "") {
            $this->VISIT_ID->CurrentValue = GetForeignKeyValue($this->VISIT_ID->getSessionValue());
            $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
            $this->VISIT_ID->ViewCustomAttributes = "";
        } else {
        }

        // TARIF_ID
        $this->TARIF_ID->EditAttrs["class"] = "form-control";
        $this->TARIF_ID->EditCustomAttributes = "";
        $this->TARIF_ID->PlaceHolder = RemoveHtml($this->TARIF_ID->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->EditValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
        if ($curVal != "") {
            $this->CLINIC_ID->EditValue = $this->CLINIC_ID->lookupCacheOption($curVal);
            if ($this->CLINIC_ID->EditValue === null) { // Lookup from database
                $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLINIC_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLINIC_ID->EditValue = $this->CLINIC_ID->displayValue($arwrk);
                } else {
                    $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
                }
            }
        } else {
            $this->CLINIC_ID->EditValue = null;
        }
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID_FROM->EditCustomAttributes = "";
        if (!$this->CLINIC_ID_FROM->Raw) {
            $this->CLINIC_ID_FROM->CurrentValue = HtmlDecode($this->CLINIC_ID_FROM->CurrentValue);
        }
        $this->CLINIC_ID_FROM->EditValue = $this->CLINIC_ID_FROM->CurrentValue;
        $this->CLINIC_ID_FROM->PlaceHolder = RemoveHtml($this->CLINIC_ID_FROM->caption());

        // TREATMENT
        $this->TREATMENT->EditAttrs["class"] = "form-control";
        $this->TREATMENT->EditCustomAttributes = "";
        if (!$this->TREATMENT->Raw) {
            $this->TREATMENT->CurrentValue = HtmlDecode($this->TREATMENT->CurrentValue);
        }
        $this->TREATMENT->EditValue = $this->TREATMENT->CurrentValue;
        $this->TREATMENT->PlaceHolder = RemoveHtml($this->TREATMENT->caption());

        // TREAT_DATE
        $this->TREAT_DATE->EditAttrs["class"] = "form-control";
        $this->TREAT_DATE->EditCustomAttributes = "";
        $this->TREAT_DATE->EditValue = FormatDateTime($this->TREAT_DATE->CurrentValue, 11);
        $this->TREAT_DATE->PlaceHolder = RemoveHtml($this->TREAT_DATE->caption());

        // AMOUNT
        $this->AMOUNT->EditAttrs["class"] = "form-control";
        $this->AMOUNT->EditCustomAttributes = "";
        $this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
        if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue)) {
            $this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // QUANTITY
        $this->QUANTITY->EditAttrs["class"] = "form-control";
        $this->QUANTITY->EditCustomAttributes = "";
        $this->QUANTITY->EditValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->PlaceHolder = RemoveHtml($this->QUANTITY->caption());
        if (strval($this->QUANTITY->EditValue) != "" && is_numeric($this->QUANTITY->EditValue)) {
            $this->QUANTITY->EditValue = FormatNumber($this->QUANTITY->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // POKOK_JUAL
        $this->POKOK_JUAL->EditAttrs["class"] = "form-control";
        $this->POKOK_JUAL->EditCustomAttributes = "";
        $this->POKOK_JUAL->EditValue = $this->POKOK_JUAL->CurrentValue;
        $this->POKOK_JUAL->PlaceHolder = RemoveHtml($this->POKOK_JUAL->caption());
        if (strval($this->POKOK_JUAL->EditValue) != "" && is_numeric($this->POKOK_JUAL->EditValue)) {
            $this->POKOK_JUAL->EditValue = FormatNumber($this->POKOK_JUAL->EditValue, -2, -2, -2, -2);
        }

        // PPN
        $this->PPN->EditAttrs["class"] = "form-control";
        $this->PPN->EditCustomAttributes = "";
        $this->PPN->EditValue = $this->PPN->CurrentValue;
        $this->PPN->PlaceHolder = RemoveHtml($this->PPN->caption());
        if (strval($this->PPN->EditValue) != "" && is_numeric($this->PPN->EditValue)) {
            $this->PPN->EditValue = FormatNumber($this->PPN->EditValue, -2, -2, -2, -2);
        }

        // MARGIN
        $this->MARGIN->EditAttrs["class"] = "form-control";
        $this->MARGIN->EditCustomAttributes = "";
        $this->MARGIN->EditValue = $this->MARGIN->CurrentValue;
        $this->MARGIN->PlaceHolder = RemoveHtml($this->MARGIN->caption());
        if (strval($this->MARGIN->EditValue) != "" && is_numeric($this->MARGIN->EditValue)) {
            $this->MARGIN->EditValue = FormatNumber($this->MARGIN->EditValue, -2, -2, -2, -2);
        }

        // SUBSIDI
        $this->SUBSIDI->EditAttrs["class"] = "form-control";
        $this->SUBSIDI->EditCustomAttributes = "";
        $this->SUBSIDI->EditValue = $this->SUBSIDI->CurrentValue;
        $this->SUBSIDI->PlaceHolder = RemoveHtml($this->SUBSIDI->caption());
        if (strval($this->SUBSIDI->EditValue) != "" && is_numeric($this->SUBSIDI->EditValue)) {
            $this->SUBSIDI->EditValue = FormatNumber($this->SUBSIDI->EditValue, -2, -2, -2, -2);
        }

        // EMBALACE
        $this->EMBALACE->EditAttrs["class"] = "form-control";
        $this->EMBALACE->EditCustomAttributes = "";
        $this->EMBALACE->EditValue = $this->EMBALACE->CurrentValue;
        $this->EMBALACE->PlaceHolder = RemoveHtml($this->EMBALACE->caption());
        if (strval($this->EMBALACE->EditValue) != "" && is_numeric($this->EMBALACE->EditValue)) {
            $this->EMBALACE->EditValue = FormatNumber($this->EMBALACE->EditValue, -2, -2, -2, -2);
        }

        // PROFESI
        $this->PROFESI->EditAttrs["class"] = "form-control";
        $this->PROFESI->EditCustomAttributes = "";
        $this->PROFESI->EditValue = $this->PROFESI->CurrentValue;
        $this->PROFESI->PlaceHolder = RemoveHtml($this->PROFESI->caption());
        if (strval($this->PROFESI->EditValue) != "" && is_numeric($this->PROFESI->EditValue)) {
            $this->PROFESI->EditValue = FormatNumber($this->PROFESI->EditValue, -2, -2, -2, -2);
        }

        // DISCOUNT
        $this->DISCOUNT->EditAttrs["class"] = "form-control";
        $this->DISCOUNT->EditCustomAttributes = "";
        $this->DISCOUNT->EditValue = $this->DISCOUNT->CurrentValue;
        $this->DISCOUNT->PlaceHolder = RemoveHtml($this->DISCOUNT->caption());
        if (strval($this->DISCOUNT->EditValue) != "" && is_numeric($this->DISCOUNT->EditValue)) {
            $this->DISCOUNT->EditValue = FormatNumber($this->DISCOUNT->EditValue, -2, -2, -2, -2);
        }

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->EditAttrs["class"] = "form-control";
        $this->PAY_METHOD_ID->EditCustomAttributes = "";
        $this->PAY_METHOD_ID->EditValue = $this->PAY_METHOD_ID->CurrentValue;
        $this->PAY_METHOD_ID->PlaceHolder = RemoveHtml($this->PAY_METHOD_ID->caption());

        // PAYMENT_DATE
        $this->PAYMENT_DATE->EditAttrs["class"] = "form-control";
        $this->PAYMENT_DATE->EditCustomAttributes = "";
        $this->PAYMENT_DATE->EditValue = FormatDateTime($this->PAYMENT_DATE->CurrentValue, 11);
        $this->PAYMENT_DATE->PlaceHolder = RemoveHtml($this->PAYMENT_DATE->caption());

        // ISLUNAS
        $this->ISLUNAS->EditAttrs["class"] = "form-control";
        $this->ISLUNAS->EditCustomAttributes = "";
        if (!$this->ISLUNAS->Raw) {
            $this->ISLUNAS->CurrentValue = HtmlDecode($this->ISLUNAS->CurrentValue);
        }
        $this->ISLUNAS->EditValue = $this->ISLUNAS->CurrentValue;
        $this->ISLUNAS->PlaceHolder = RemoveHtml($this->ISLUNAS->caption());

        // DUEDATE_ANGSURAN
        $this->DUEDATE_ANGSURAN->EditAttrs["class"] = "form-control";
        $this->DUEDATE_ANGSURAN->EditCustomAttributes = "";
        $this->DUEDATE_ANGSURAN->EditValue = FormatDateTime($this->DUEDATE_ANGSURAN->CurrentValue, 8);
        $this->DUEDATE_ANGSURAN->PlaceHolder = RemoveHtml($this->DUEDATE_ANGSURAN->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // KUITANSI_ID
        $this->KUITANSI_ID->EditAttrs["class"] = "form-control";
        $this->KUITANSI_ID->EditCustomAttributes = "";
        if (!$this->KUITANSI_ID->Raw) {
            $this->KUITANSI_ID->CurrentValue = HtmlDecode($this->KUITANSI_ID->CurrentValue);
        }
        $this->KUITANSI_ID->EditValue = $this->KUITANSI_ID->CurrentValue;
        $this->KUITANSI_ID->PlaceHolder = RemoveHtml($this->KUITANSI_ID->caption());

        // NOTA_NO
        $this->NOTA_NO->EditAttrs["class"] = "form-control";
        $this->NOTA_NO->EditCustomAttributes = "";
        if (!$this->NOTA_NO->Raw) {
            $this->NOTA_NO->CurrentValue = HtmlDecode($this->NOTA_NO->CurrentValue);
        }
        $this->NOTA_NO->EditValue = $this->NOTA_NO->CurrentValue;
        $this->NOTA_NO->PlaceHolder = RemoveHtml($this->NOTA_NO->caption());

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

        // RESEP_NO
        $this->RESEP_NO->EditAttrs["class"] = "form-control";
        $this->RESEP_NO->EditCustomAttributes = "";
        if (!$this->RESEP_NO->Raw) {
            $this->RESEP_NO->CurrentValue = HtmlDecode($this->RESEP_NO->CurrentValue);
        }
        $this->RESEP_NO->EditValue = $this->RESEP_NO->CurrentValue;
        $this->RESEP_NO->PlaceHolder = RemoveHtml($this->RESEP_NO->caption());

        // RESEP_KE
        $this->RESEP_KE->EditAttrs["class"] = "form-control";
        $this->RESEP_KE->EditCustomAttributes = "";
        $this->RESEP_KE->EditValue = $this->RESEP_KE->CurrentValue;
        $this->RESEP_KE->PlaceHolder = RemoveHtml($this->RESEP_KE->caption());

        // DOSE
        $this->DOSE->EditAttrs["class"] = "form-control";
        $this->DOSE->EditCustomAttributes = "";
        $this->DOSE->EditValue = $this->DOSE->CurrentValue;
        $this->DOSE->PlaceHolder = RemoveHtml($this->DOSE->caption());
        if (strval($this->DOSE->EditValue) != "" && is_numeric($this->DOSE->EditValue)) {
            $this->DOSE->EditValue = FormatNumber($this->DOSE->EditValue, -2, -2, -2, -2);
        }

        // ORIG_DOSE
        $this->ORIG_DOSE->EditAttrs["class"] = "form-control";
        $this->ORIG_DOSE->EditCustomAttributes = "";
        $this->ORIG_DOSE->EditValue = $this->ORIG_DOSE->CurrentValue;
        $this->ORIG_DOSE->PlaceHolder = RemoveHtml($this->ORIG_DOSE->caption());
        if (strval($this->ORIG_DOSE->EditValue) != "" && is_numeric($this->ORIG_DOSE->EditValue)) {
            $this->ORIG_DOSE->EditValue = FormatNumber($this->ORIG_DOSE->EditValue, -2, -2, -2, -2);
        }

        // DOSE_PRESC
        $this->DOSE_PRESC->EditAttrs["class"] = "form-control";
        $this->DOSE_PRESC->EditCustomAttributes = "";
        $this->DOSE_PRESC->EditValue = $this->DOSE_PRESC->CurrentValue;
        $this->DOSE_PRESC->PlaceHolder = RemoveHtml($this->DOSE_PRESC->caption());
        if (strval($this->DOSE_PRESC->EditValue) != "" && is_numeric($this->DOSE_PRESC->EditValue)) {
            $this->DOSE_PRESC->EditValue = FormatNumber($this->DOSE_PRESC->EditValue, -2, -2, -2, -2);
        }

        // ITER
        $this->ITER->EditAttrs["class"] = "form-control";
        $this->ITER->EditCustomAttributes = "";
        $this->ITER->EditValue = $this->ITER->CurrentValue;
        $this->ITER->PlaceHolder = RemoveHtml($this->ITER->caption());

        // ITER_KE
        $this->ITER_KE->EditAttrs["class"] = "form-control";
        $this->ITER_KE->EditCustomAttributes = "";
        $this->ITER_KE->EditValue = $this->ITER_KE->CurrentValue;
        $this->ITER_KE->PlaceHolder = RemoveHtml($this->ITER_KE->caption());

        // SOLD_STATUS
        $this->SOLD_STATUS->EditAttrs["class"] = "form-control";
        $this->SOLD_STATUS->EditCustomAttributes = "";
        $this->SOLD_STATUS->EditValue = $this->SOLD_STATUS->CurrentValue;
        $this->SOLD_STATUS->PlaceHolder = RemoveHtml($this->SOLD_STATUS->caption());

        // RACIKAN
        $this->RACIKAN->EditAttrs["class"] = "form-control";
        $this->RACIKAN->EditCustomAttributes = "";
        $this->RACIKAN->EditValue = $this->RACIKAN->CurrentValue;
        $this->RACIKAN->PlaceHolder = RemoveHtml($this->RACIKAN->caption());

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ROOM_ID->EditCustomAttributes = "";
        if (!$this->CLASS_ROOM_ID->Raw) {
            $this->CLASS_ROOM_ID->CurrentValue = HtmlDecode($this->CLASS_ROOM_ID->CurrentValue);
        }
        $this->CLASS_ROOM_ID->EditValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

        // KELUAR_ID
        $this->KELUAR_ID->EditAttrs["class"] = "form-control";
        $this->KELUAR_ID->EditCustomAttributes = "";
        $this->KELUAR_ID->EditValue = $this->KELUAR_ID->CurrentValue;
        $this->KELUAR_ID->PlaceHolder = RemoveHtml($this->KELUAR_ID->caption());

        // BED_ID
        $this->BED_ID->EditAttrs["class"] = "form-control";
        $this->BED_ID->EditCustomAttributes = "";
        $this->BED_ID->EditValue = $this->BED_ID->CurrentValue;
        $this->BED_ID->PlaceHolder = RemoveHtml($this->BED_ID->caption());

        // PERDA_ID
        $this->PERDA_ID->EditAttrs["class"] = "form-control";
        $this->PERDA_ID->EditCustomAttributes = "";
        $this->PERDA_ID->EditValue = $this->PERDA_ID->CurrentValue;
        $this->PERDA_ID->PlaceHolder = RemoveHtml($this->PERDA_ID->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // DESCRIPTION2
        $this->DESCRIPTION2->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION2->EditCustomAttributes = "";
        if (!$this->DESCRIPTION2->Raw) {
            $this->DESCRIPTION2->CurrentValue = HtmlDecode($this->DESCRIPTION2->CurrentValue);
        }
        $this->DESCRIPTION2->EditValue = $this->DESCRIPTION2->CurrentValue;
        $this->DESCRIPTION2->PlaceHolder = RemoveHtml($this->DESCRIPTION2->caption());

        // MODIFIED_BY
        $this->MODIFIED_BY->EditAttrs["class"] = "form-control";
        $this->MODIFIED_BY->EditCustomAttributes = "";
        if (!$this->MODIFIED_BY->Raw) {
            $this->MODIFIED_BY->CurrentValue = HtmlDecode($this->MODIFIED_BY->CurrentValue);
        }
        $this->MODIFIED_BY->EditValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->PlaceHolder = RemoveHtml($this->MODIFIED_BY->caption());

        // MODIFIED_DATE

        // MODIFIED_FROM
        $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
        $this->MODIFIED_FROM->EditCustomAttributes = "";
        if (!$this->MODIFIED_FROM->Raw) {
            $this->MODIFIED_FROM->CurrentValue = HtmlDecode($this->MODIFIED_FROM->CurrentValue);
        }
        $this->MODIFIED_FROM->EditValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

        // BRAND_ID
        $this->BRAND_ID->EditAttrs["class"] = "form-control";
        $this->BRAND_ID->EditCustomAttributes = "";
        if (!$this->BRAND_ID->Raw) {
            $this->BRAND_ID->CurrentValue = HtmlDecode($this->BRAND_ID->CurrentValue);
        }
        $this->BRAND_ID->EditValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->PlaceHolder = RemoveHtml($this->BRAND_ID->caption());

        // DOCTOR
        $this->DOCTOR->EditAttrs["class"] = "form-control";
        $this->DOCTOR->EditCustomAttributes = "";
        if (!$this->DOCTOR->Raw) {
            $this->DOCTOR->CurrentValue = HtmlDecode($this->DOCTOR->CurrentValue);
        }
        $this->DOCTOR->EditValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->PlaceHolder = RemoveHtml($this->DOCTOR->caption());

        // JML_BKS
        $this->JML_BKS->EditAttrs["class"] = "form-control";
        $this->JML_BKS->EditCustomAttributes = "";
        $this->JML_BKS->EditValue = $this->JML_BKS->CurrentValue;
        $this->JML_BKS->PlaceHolder = RemoveHtml($this->JML_BKS->caption());

        // EXIT_DATE
        $this->EXIT_DATE->EditAttrs["class"] = "form-control";
        $this->EXIT_DATE->EditCustomAttributes = "";
        $this->EXIT_DATE->EditValue = FormatDateTime($this->EXIT_DATE->CurrentValue, 8);
        $this->EXIT_DATE->PlaceHolder = RemoveHtml($this->EXIT_DATE->caption());

        // FA_V
        $this->FA_V->EditAttrs["class"] = "form-control";
        $this->FA_V->EditCustomAttributes = "";
        $this->FA_V->EditValue = $this->FA_V->CurrentValue;
        $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

        // TASK_ID
        $this->TASK_ID->EditAttrs["class"] = "form-control";
        $this->TASK_ID->EditCustomAttributes = "";
        $this->TASK_ID->EditValue = $this->TASK_ID->CurrentValue;
        $this->TASK_ID->PlaceHolder = RemoveHtml($this->TASK_ID->caption());

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID_FROM->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID_FROM->Raw) {
            $this->EMPLOYEE_ID_FROM->CurrentValue = HtmlDecode($this->EMPLOYEE_ID_FROM->CurrentValue);
        }
        $this->EMPLOYEE_ID_FROM->EditValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $this->EMPLOYEE_ID_FROM->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID_FROM->caption());

        // DOCTOR_FROM
        $this->DOCTOR_FROM->EditAttrs["class"] = "form-control";
        $this->DOCTOR_FROM->EditCustomAttributes = "";
        if (!$this->DOCTOR_FROM->Raw) {
            $this->DOCTOR_FROM->CurrentValue = HtmlDecode($this->DOCTOR_FROM->CurrentValue);
        }
        $this->DOCTOR_FROM->EditValue = $this->DOCTOR_FROM->CurrentValue;
        $this->DOCTOR_FROM->PlaceHolder = RemoveHtml($this->DOCTOR_FROM->caption());

        // status_pasien_id
        $this->status_pasien_id->EditAttrs["class"] = "form-control";
        $this->status_pasien_id->EditCustomAttributes = "";
        $this->status_pasien_id->EditValue = $this->status_pasien_id->CurrentValue;
        $this->status_pasien_id->PlaceHolder = RemoveHtml($this->status_pasien_id->caption());

        // amount_paid
        $this->amount_paid->EditAttrs["class"] = "form-control";
        $this->amount_paid->EditCustomAttributes = "";
        $this->amount_paid->EditValue = $this->amount_paid->CurrentValue;
        $this->amount_paid->PlaceHolder = RemoveHtml($this->amount_paid->caption());
        if (strval($this->amount_paid->EditValue) != "" && is_numeric($this->amount_paid->EditValue)) {
            $this->amount_paid->EditValue = FormatNumber($this->amount_paid->EditValue, -2, -2, -2, -2);
        }

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

        // THEID
        $this->THEID->EditAttrs["class"] = "form-control";
        $this->THEID->EditCustomAttributes = "";
        if (!$this->THEID->Raw) {
            $this->THEID->CurrentValue = HtmlDecode($this->THEID->CurrentValue);
        }
        $this->THEID->EditValue = $this->THEID->CurrentValue;
        $this->THEID->PlaceHolder = RemoveHtml($this->THEID->caption());

        // serial_nb
        $this->serial_nb->EditAttrs["class"] = "form-control";
        $this->serial_nb->EditCustomAttributes = "";
        if (!$this->serial_nb->Raw) {
            $this->serial_nb->CurrentValue = HtmlDecode($this->serial_nb->CurrentValue);
        }
        $this->serial_nb->EditValue = $this->serial_nb->CurrentValue;
        $this->serial_nb->PlaceHolder = RemoveHtml($this->serial_nb->caption());

        // TREATMENT_PLAFOND
        $this->TREATMENT_PLAFOND->EditAttrs["class"] = "form-control";
        $this->TREATMENT_PLAFOND->EditCustomAttributes = "";
        if (!$this->TREATMENT_PLAFOND->Raw) {
            $this->TREATMENT_PLAFOND->CurrentValue = HtmlDecode($this->TREATMENT_PLAFOND->CurrentValue);
        }
        $this->TREATMENT_PLAFOND->EditValue = $this->TREATMENT_PLAFOND->CurrentValue;
        $this->TREATMENT_PLAFOND->PlaceHolder = RemoveHtml($this->TREATMENT_PLAFOND->caption());

        // AMOUNT_PLAFOND
        $this->AMOUNT_PLAFOND->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PLAFOND->EditCustomAttributes = "";
        $this->AMOUNT_PLAFOND->EditValue = $this->AMOUNT_PLAFOND->CurrentValue;
        $this->AMOUNT_PLAFOND->PlaceHolder = RemoveHtml($this->AMOUNT_PLAFOND->caption());
        if (strval($this->AMOUNT_PLAFOND->EditValue) != "" && is_numeric($this->AMOUNT_PLAFOND->EditValue)) {
            $this->AMOUNT_PLAFOND->EditValue = FormatNumber($this->AMOUNT_PLAFOND->EditValue, -2, -2, -2, -2);
        }

        // AMOUNT_PAID_PLAFOND
        $this->AMOUNT_PAID_PLAFOND->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PAID_PLAFOND->EditCustomAttributes = "";
        $this->AMOUNT_PAID_PLAFOND->EditValue = $this->AMOUNT_PAID_PLAFOND->CurrentValue;
        $this->AMOUNT_PAID_PLAFOND->PlaceHolder = RemoveHtml($this->AMOUNT_PAID_PLAFOND->caption());
        if (strval($this->AMOUNT_PAID_PLAFOND->EditValue) != "" && is_numeric($this->AMOUNT_PAID_PLAFOND->EditValue)) {
            $this->AMOUNT_PAID_PLAFOND->EditValue = FormatNumber($this->AMOUNT_PAID_PLAFOND->EditValue, -2, -2, -2, -2);
        }

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->EditAttrs["class"] = "form-control";
        $this->CLASS_ID_PLAFOND->EditCustomAttributes = "";
        $this->CLASS_ID_PLAFOND->EditValue = $this->CLASS_ID_PLAFOND->CurrentValue;
        $this->CLASS_ID_PLAFOND->PlaceHolder = RemoveHtml($this->CLASS_ID_PLAFOND->caption());

        // PAYOR_ID
        $this->PAYOR_ID->EditAttrs["class"] = "form-control";
        $this->PAYOR_ID->EditCustomAttributes = "";
        if (!$this->PAYOR_ID->Raw) {
            $this->PAYOR_ID->CurrentValue = HtmlDecode($this->PAYOR_ID->CurrentValue);
        }
        $this->PAYOR_ID->EditValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

        // PEMBULATAN
        $this->PEMBULATAN->EditAttrs["class"] = "form-control";
        $this->PEMBULATAN->EditCustomAttributes = "";
        $this->PEMBULATAN->EditValue = $this->PEMBULATAN->CurrentValue;
        $this->PEMBULATAN->PlaceHolder = RemoveHtml($this->PEMBULATAN->caption());
        if (strval($this->PEMBULATAN->EditValue) != "" && is_numeric($this->PEMBULATAN->EditValue)) {
            $this->PEMBULATAN->EditValue = FormatNumber($this->PEMBULATAN->EditValue, -2, -2, -2, -2);
        }

        // ISRJ
        $this->ISRJ->EditAttrs["class"] = "form-control";
        $this->ISRJ->EditCustomAttributes = "";
        if (!$this->ISRJ->Raw) {
            $this->ISRJ->CurrentValue = HtmlDecode($this->ISRJ->CurrentValue);
        }
        $this->ISRJ->EditValue = $this->ISRJ->CurrentValue;
        $this->ISRJ->PlaceHolder = RemoveHtml($this->ISRJ->caption());

        // AGEYEAR
        $this->AGEYEAR->EditAttrs["class"] = "form-control";
        $this->AGEYEAR->EditCustomAttributes = "";
        $this->AGEYEAR->EditValue = $this->AGEYEAR->CurrentValue;
        $this->AGEYEAR->PlaceHolder = RemoveHtml($this->AGEYEAR->caption());

        // AGEMONTH
        $this->AGEMONTH->EditAttrs["class"] = "form-control";
        $this->AGEMONTH->EditCustomAttributes = "";
        $this->AGEMONTH->EditValue = $this->AGEMONTH->CurrentValue;
        $this->AGEMONTH->PlaceHolder = RemoveHtml($this->AGEMONTH->caption());

        // AGEDAY
        $this->AGEDAY->EditAttrs["class"] = "form-control";
        $this->AGEDAY->EditCustomAttributes = "";
        $this->AGEDAY->EditValue = $this->AGEDAY->CurrentValue;
        $this->AGEDAY->PlaceHolder = RemoveHtml($this->AGEDAY->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        if (!$this->GENDER->Raw) {
            $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
        }
        $this->GENDER->EditValue = $this->GENDER->CurrentValue;
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // CORRECTION_ID
        $this->CORRECTION_ID->EditAttrs["class"] = "form-control";
        $this->CORRECTION_ID->EditCustomAttributes = "";
        if (!$this->CORRECTION_ID->Raw) {
            $this->CORRECTION_ID->CurrentValue = HtmlDecode($this->CORRECTION_ID->CurrentValue);
        }
        $this->CORRECTION_ID->EditValue = $this->CORRECTION_ID->CurrentValue;
        $this->CORRECTION_ID->PlaceHolder = RemoveHtml($this->CORRECTION_ID->caption());

        // CORRECTION_BY
        $this->CORRECTION_BY->EditAttrs["class"] = "form-control";
        $this->CORRECTION_BY->EditCustomAttributes = "";
        if (!$this->CORRECTION_BY->Raw) {
            $this->CORRECTION_BY->CurrentValue = HtmlDecode($this->CORRECTION_BY->CurrentValue);
        }
        $this->CORRECTION_BY->EditValue = $this->CORRECTION_BY->CurrentValue;
        $this->CORRECTION_BY->PlaceHolder = RemoveHtml($this->CORRECTION_BY->caption());

        // KARYAWAN
        $this->KARYAWAN->EditAttrs["class"] = "form-control";
        $this->KARYAWAN->EditCustomAttributes = "";
        if (!$this->KARYAWAN->Raw) {
            $this->KARYAWAN->CurrentValue = HtmlDecode($this->KARYAWAN->CurrentValue);
        }
        $this->KARYAWAN->EditValue = $this->KARYAWAN->CurrentValue;
        $this->KARYAWAN->PlaceHolder = RemoveHtml($this->KARYAWAN->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // sell_price
        $this->sell_price->EditAttrs["class"] = "form-control";
        $this->sell_price->EditCustomAttributes = "";
        $this->sell_price->EditValue = $this->sell_price->CurrentValue;
        $this->sell_price->PlaceHolder = RemoveHtml($this->sell_price->caption());
        if (strval($this->sell_price->EditValue) != "" && is_numeric($this->sell_price->EditValue)) {
            $this->sell_price->EditValue = FormatNumber($this->sell_price->EditValue, -2, -2, -2, -2);
        }

        // diskon
        $this->diskon->EditAttrs["class"] = "form-control";
        $this->diskon->EditCustomAttributes = "";
        $this->diskon->EditValue = $this->diskon->CurrentValue;
        $this->diskon->PlaceHolder = RemoveHtml($this->diskon->caption());
        if (strval($this->diskon->EditValue) != "" && is_numeric($this->diskon->EditValue)) {
            $this->diskon->EditValue = FormatNumber($this->diskon->EditValue, -2, -2, -2, -2);
        }

        // INVOICE_ID
        $this->INVOICE_ID->EditAttrs["class"] = "form-control";
        $this->INVOICE_ID->EditCustomAttributes = "";
        if (!$this->INVOICE_ID->Raw) {
            $this->INVOICE_ID->CurrentValue = HtmlDecode($this->INVOICE_ID->CurrentValue);
        }
        $this->INVOICE_ID->EditValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->PlaceHolder = RemoveHtml($this->INVOICE_ID->caption());

        // NUMER
        $this->NUMER->EditAttrs["class"] = "form-control";
        $this->NUMER->EditCustomAttributes = "";
        if (!$this->NUMER->Raw) {
            $this->NUMER->CurrentValue = HtmlDecode($this->NUMER->CurrentValue);
        }
        $this->NUMER->EditValue = $this->NUMER->CurrentValue;
        $this->NUMER->PlaceHolder = RemoveHtml($this->NUMER->caption());

        // MEASURE_ID2
        $this->MEASURE_ID2->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID2->EditCustomAttributes = "";
        $this->MEASURE_ID2->EditValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->PlaceHolder = RemoveHtml($this->MEASURE_ID2->caption());

        // POTONGAN
        $this->POTONGAN->EditAttrs["class"] = "form-control";
        $this->POTONGAN->EditCustomAttributes = "";
        $this->POTONGAN->EditValue = $this->POTONGAN->CurrentValue;
        $this->POTONGAN->PlaceHolder = RemoveHtml($this->POTONGAN->caption());
        if (strval($this->POTONGAN->EditValue) != "" && is_numeric($this->POTONGAN->EditValue)) {
            $this->POTONGAN->EditValue = FormatNumber($this->POTONGAN->EditValue, -2, -2, -2, -2);
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

        // TARIF_TYPE
        $this->TARIF_TYPE->EditAttrs["class"] = "form-control";
        $this->TARIF_TYPE->EditCustomAttributes = "";
        if (!$this->TARIF_TYPE->Raw) {
            $this->TARIF_TYPE->CurrentValue = HtmlDecode($this->TARIF_TYPE->CurrentValue);
        }
        $this->TARIF_TYPE->EditValue = $this->TARIF_TYPE->CurrentValue;
        $this->TARIF_TYPE->PlaceHolder = RemoveHtml($this->TARIF_TYPE->caption());

        // PPNVALUE
        $this->PPNVALUE->EditAttrs["class"] = "form-control";
        $this->PPNVALUE->EditCustomAttributes = "";
        $this->PPNVALUE->EditValue = $this->PPNVALUE->CurrentValue;
        $this->PPNVALUE->PlaceHolder = RemoveHtml($this->PPNVALUE->caption());
        if (strval($this->PPNVALUE->EditValue) != "" && is_numeric($this->PPNVALUE->EditValue)) {
            $this->PPNVALUE->EditValue = FormatNumber($this->PPNVALUE->EditValue, -2, -2, -2, -2);
        }

        // TAGIHAN
        $this->TAGIHAN->EditAttrs["class"] = "form-control";
        $this->TAGIHAN->EditCustomAttributes = "";
        $this->TAGIHAN->EditValue = $this->TAGIHAN->CurrentValue;
        $this->TAGIHAN->PlaceHolder = RemoveHtml($this->TAGIHAN->caption());
        if (strval($this->TAGIHAN->EditValue) != "" && is_numeric($this->TAGIHAN->EditValue)) {
            $this->TAGIHAN->EditValue = FormatNumber($this->TAGIHAN->EditValue, -2, -2, -2, -2);
        }

        // KOREKSI
        $this->KOREKSI->EditAttrs["class"] = "form-control";
        $this->KOREKSI->EditCustomAttributes = "";
        $this->KOREKSI->EditValue = $this->KOREKSI->CurrentValue;
        $this->KOREKSI->PlaceHolder = RemoveHtml($this->KOREKSI->caption());
        if (strval($this->KOREKSI->EditValue) != "" && is_numeric($this->KOREKSI->EditValue)) {
            $this->KOREKSI->EditValue = FormatNumber($this->KOREKSI->EditValue, -2, -2, -2, -2);
        }

        // STATUS_OBAT
        $this->STATUS_OBAT->EditAttrs["class"] = "form-control";
        $this->STATUS_OBAT->EditCustomAttributes = "";
        $this->STATUS_OBAT->EditValue = $this->STATUS_OBAT->CurrentValue;
        $this->STATUS_OBAT->PlaceHolder = RemoveHtml($this->STATUS_OBAT->caption());

        // SUBSIDISAT
        $this->SUBSIDISAT->EditAttrs["class"] = "form-control";
        $this->SUBSIDISAT->EditCustomAttributes = "";
        $this->SUBSIDISAT->EditValue = $this->SUBSIDISAT->CurrentValue;
        $this->SUBSIDISAT->PlaceHolder = RemoveHtml($this->SUBSIDISAT->caption());
        if (strval($this->SUBSIDISAT->EditValue) != "" && is_numeric($this->SUBSIDISAT->EditValue)) {
            $this->SUBSIDISAT->EditValue = FormatNumber($this->SUBSIDISAT->EditValue, -2, -2, -2, -2);
        }

        // PRINTQ
        $this->PRINTQ->EditAttrs["class"] = "form-control";
        $this->PRINTQ->EditCustomAttributes = "";
        $this->PRINTQ->EditValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->PlaceHolder = RemoveHtml($this->PRINTQ->caption());

        // PRINTED_BY
        $this->PRINTED_BY->EditAttrs["class"] = "form-control";
        $this->PRINTED_BY->EditCustomAttributes = "";
        if (!$this->PRINTED_BY->Raw) {
            $this->PRINTED_BY->CurrentValue = HtmlDecode($this->PRINTED_BY->CurrentValue);
        }
        $this->PRINTED_BY->EditValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->PlaceHolder = RemoveHtml($this->PRINTED_BY->caption());

        // STOCK_AVAILABLE
        $this->STOCK_AVAILABLE->EditAttrs["class"] = "form-control";
        $this->STOCK_AVAILABLE->EditCustomAttributes = "";
        $this->STOCK_AVAILABLE->EditValue = $this->STOCK_AVAILABLE->CurrentValue;
        $this->STOCK_AVAILABLE->PlaceHolder = RemoveHtml($this->STOCK_AVAILABLE->caption());
        if (strval($this->STOCK_AVAILABLE->EditValue) != "" && is_numeric($this->STOCK_AVAILABLE->EditValue)) {
            $this->STOCK_AVAILABLE->EditValue = FormatNumber($this->STOCK_AVAILABLE->EditValue, -2, -2, -2, -2);
        }

        // STATUS_TARIF
        $this->STATUS_TARIF->EditAttrs["class"] = "form-control";
        $this->STATUS_TARIF->EditCustomAttributes = "";
        $this->STATUS_TARIF->EditValue = $this->STATUS_TARIF->CurrentValue;
        $this->STATUS_TARIF->PlaceHolder = RemoveHtml($this->STATUS_TARIF->caption());

        // CLINIC_TYPE
        $this->CLINIC_TYPE->EditAttrs["class"] = "form-control";
        $this->CLINIC_TYPE->EditCustomAttributes = "";
        $this->CLINIC_TYPE->EditValue = $this->CLINIC_TYPE->CurrentValue;
        $this->CLINIC_TYPE->PlaceHolder = RemoveHtml($this->CLINIC_TYPE->caption());

        // PACKAGE_ID
        $this->PACKAGE_ID->EditAttrs["class"] = "form-control";
        $this->PACKAGE_ID->EditCustomAttributes = "";
        if (!$this->PACKAGE_ID->Raw) {
            $this->PACKAGE_ID->CurrentValue = HtmlDecode($this->PACKAGE_ID->CurrentValue);
        }
        $this->PACKAGE_ID->EditValue = $this->PACKAGE_ID->CurrentValue;
        $this->PACKAGE_ID->PlaceHolder = RemoveHtml($this->PACKAGE_ID->caption());

        // MODULE_ID
        $this->MODULE_ID->EditAttrs["class"] = "form-control";
        $this->MODULE_ID->EditCustomAttributes = "";
        if (!$this->MODULE_ID->Raw) {
            $this->MODULE_ID->CurrentValue = HtmlDecode($this->MODULE_ID->CurrentValue);
        }
        $this->MODULE_ID->EditValue = $this->MODULE_ID->CurrentValue;
        $this->MODULE_ID->PlaceHolder = RemoveHtml($this->MODULE_ID->caption());

        // profession
        $this->profession->EditAttrs["class"] = "form-control";
        $this->profession->EditCustomAttributes = "";
        $this->profession->EditValue = $this->profession->CurrentValue;
        $this->profession->PlaceHolder = RemoveHtml($this->profession->caption());
        if (strval($this->profession->EditValue) != "" && is_numeric($this->profession->EditValue)) {
            $this->profession->EditValue = FormatNumber($this->profession->EditValue, -2, -2, -2, -2);
        }

        // THEORDER
        $this->THEORDER->EditAttrs["class"] = "form-control";
        $this->THEORDER->EditCustomAttributes = "";
        $this->THEORDER->EditValue = $this->THEORDER->CurrentValue;
        $this->THEORDER->PlaceHolder = RemoveHtml($this->THEORDER->caption());

        // CASHIER
        $this->CASHIER->EditAttrs["class"] = "form-control";
        $this->CASHIER->EditCustomAttributes = "";
        if (!$this->CASHIER->Raw) {
            $this->CASHIER->CurrentValue = HtmlDecode($this->CASHIER->CurrentValue);
        }
        $this->CASHIER->EditValue = $this->CASHIER->CurrentValue;
        $this->CASHIER->PlaceHolder = RemoveHtml($this->CASHIER->caption());

        // SPPFEE
        $this->SPPFEE->EditAttrs["class"] = "form-control";
        $this->SPPFEE->EditCustomAttributes = "";
        if (!$this->SPPFEE->Raw) {
            $this->SPPFEE->CurrentValue = HtmlDecode($this->SPPFEE->CurrentValue);
        }
        $this->SPPFEE->EditValue = $this->SPPFEE->CurrentValue;
        $this->SPPFEE->PlaceHolder = RemoveHtml($this->SPPFEE->caption());

        // SPPBILL
        $this->SPPBILL->EditAttrs["class"] = "form-control";
        $this->SPPBILL->EditCustomAttributes = "";
        if (!$this->SPPBILL->Raw) {
            $this->SPPBILL->CurrentValue = HtmlDecode($this->SPPBILL->CurrentValue);
        }
        $this->SPPBILL->EditValue = $this->SPPBILL->CurrentValue;
        $this->SPPBILL->PlaceHolder = RemoveHtml($this->SPPBILL->caption());

        // SPPRJK
        $this->SPPRJK->EditAttrs["class"] = "form-control";
        $this->SPPRJK->EditCustomAttributes = "";
        if (!$this->SPPRJK->Raw) {
            $this->SPPRJK->CurrentValue = HtmlDecode($this->SPPRJK->CurrentValue);
        }
        $this->SPPRJK->EditValue = $this->SPPRJK->CurrentValue;
        $this->SPPRJK->PlaceHolder = RemoveHtml($this->SPPRJK->caption());

        // SPPJMN
        $this->SPPJMN->EditAttrs["class"] = "form-control";
        $this->SPPJMN->EditCustomAttributes = "";
        if (!$this->SPPJMN->Raw) {
            $this->SPPJMN->CurrentValue = HtmlDecode($this->SPPJMN->CurrentValue);
        }
        $this->SPPJMN->EditValue = $this->SPPJMN->CurrentValue;
        $this->SPPJMN->PlaceHolder = RemoveHtml($this->SPPJMN->caption());

        // SPPKASIR
        $this->SPPKASIR->EditAttrs["class"] = "form-control";
        $this->SPPKASIR->EditCustomAttributes = "";
        if (!$this->SPPKASIR->Raw) {
            $this->SPPKASIR->CurrentValue = HtmlDecode($this->SPPKASIR->CurrentValue);
        }
        $this->SPPKASIR->EditValue = $this->SPPKASIR->CurrentValue;
        $this->SPPKASIR->PlaceHolder = RemoveHtml($this->SPPKASIR->caption());

        // PERUJUK
        $this->PERUJUK->EditAttrs["class"] = "form-control";
        $this->PERUJUK->EditCustomAttributes = "";
        if (!$this->PERUJUK->Raw) {
            $this->PERUJUK->CurrentValue = HtmlDecode($this->PERUJUK->CurrentValue);
        }
        $this->PERUJUK->EditValue = $this->PERUJUK->CurrentValue;
        $this->PERUJUK->PlaceHolder = RemoveHtml($this->PERUJUK->caption());

        // PERUJUKFEE
        $this->PERUJUKFEE->EditAttrs["class"] = "form-control";
        $this->PERUJUKFEE->EditCustomAttributes = "";
        $this->PERUJUKFEE->EditValue = $this->PERUJUKFEE->CurrentValue;
        $this->PERUJUKFEE->PlaceHolder = RemoveHtml($this->PERUJUKFEE->caption());
        if (strval($this->PERUJUKFEE->EditValue) != "" && is_numeric($this->PERUJUKFEE->EditValue)) {
            $this->PERUJUKFEE->EditValue = FormatNumber($this->PERUJUKFEE->EditValue, -2, -2, -2, -2);
        }

        // modified_datesys
        $this->modified_datesys->EditAttrs["class"] = "form-control";
        $this->modified_datesys->EditCustomAttributes = "";
        $this->modified_datesys->EditValue = FormatDateTime($this->modified_datesys->CurrentValue, 8);
        $this->modified_datesys->PlaceHolder = RemoveHtml($this->modified_datesys->caption());

        // TRANS_ID
        $this->TRANS_ID->EditAttrs["class"] = "form-control";
        $this->TRANS_ID->EditCustomAttributes = "";
        if (!$this->TRANS_ID->Raw) {
            $this->TRANS_ID->CurrentValue = HtmlDecode($this->TRANS_ID->CurrentValue);
        }
        $this->TRANS_ID->EditValue = $this->TRANS_ID->CurrentValue;
        $this->TRANS_ID->PlaceHolder = RemoveHtml($this->TRANS_ID->caption());

        // SPPBILLDATE
        $this->SPPBILLDATE->EditAttrs["class"] = "form-control";
        $this->SPPBILLDATE->EditCustomAttributes = "";
        $this->SPPBILLDATE->EditValue = FormatDateTime($this->SPPBILLDATE->CurrentValue, 8);
        $this->SPPBILLDATE->PlaceHolder = RemoveHtml($this->SPPBILLDATE->caption());

        // SPPBILLUSER
        $this->SPPBILLUSER->EditAttrs["class"] = "form-control";
        $this->SPPBILLUSER->EditCustomAttributes = "";
        if (!$this->SPPBILLUSER->Raw) {
            $this->SPPBILLUSER->CurrentValue = HtmlDecode($this->SPPBILLUSER->CurrentValue);
        }
        $this->SPPBILLUSER->EditValue = $this->SPPBILLUSER->CurrentValue;
        $this->SPPBILLUSER->PlaceHolder = RemoveHtml($this->SPPBILLUSER->caption());

        // SPPKASIRDATE
        $this->SPPKASIRDATE->EditAttrs["class"] = "form-control";
        $this->SPPKASIRDATE->EditCustomAttributes = "";
        $this->SPPKASIRDATE->EditValue = FormatDateTime($this->SPPKASIRDATE->CurrentValue, 8);
        $this->SPPKASIRDATE->PlaceHolder = RemoveHtml($this->SPPKASIRDATE->caption());

        // SPPKASIRUSER
        $this->SPPKASIRUSER->EditAttrs["class"] = "form-control";
        $this->SPPKASIRUSER->EditCustomAttributes = "";
        if (!$this->SPPKASIRUSER->Raw) {
            $this->SPPKASIRUSER->CurrentValue = HtmlDecode($this->SPPKASIRUSER->CurrentValue);
        }
        $this->SPPKASIRUSER->EditValue = $this->SPPKASIRUSER->CurrentValue;
        $this->SPPKASIRUSER->PlaceHolder = RemoveHtml($this->SPPKASIRUSER->caption());

        // SPPPOLI
        $this->SPPPOLI->EditAttrs["class"] = "form-control";
        $this->SPPPOLI->EditCustomAttributes = "";
        if (!$this->SPPPOLI->Raw) {
            $this->SPPPOLI->CurrentValue = HtmlDecode($this->SPPPOLI->CurrentValue);
        }
        $this->SPPPOLI->EditValue = $this->SPPPOLI->CurrentValue;
        $this->SPPPOLI->PlaceHolder = RemoveHtml($this->SPPPOLI->caption());

        // SPPPOLIUSER
        $this->SPPPOLIUSER->EditAttrs["class"] = "form-control";
        $this->SPPPOLIUSER->EditCustomAttributes = "";
        if (!$this->SPPPOLIUSER->Raw) {
            $this->SPPPOLIUSER->CurrentValue = HtmlDecode($this->SPPPOLIUSER->CurrentValue);
        }
        $this->SPPPOLIUSER->EditValue = $this->SPPPOLIUSER->CurrentValue;
        $this->SPPPOLIUSER->PlaceHolder = RemoveHtml($this->SPPPOLIUSER->caption());

        // SPPPOLIDATE
        $this->SPPPOLIDATE->EditAttrs["class"] = "form-control";
        $this->SPPPOLIDATE->EditCustomAttributes = "";
        $this->SPPPOLIDATE->EditValue = FormatDateTime($this->SPPPOLIDATE->CurrentValue, 8);
        $this->SPPPOLIDATE->PlaceHolder = RemoveHtml($this->SPPPOLIDATE->caption());

        // nota_temp
        $this->nota_temp->EditAttrs["class"] = "form-control";
        $this->nota_temp->EditCustomAttributes = "";
        if (!$this->nota_temp->Raw) {
            $this->nota_temp->CurrentValue = HtmlDecode($this->nota_temp->CurrentValue);
        }
        $this->nota_temp->EditValue = $this->nota_temp->CurrentValue;
        $this->nota_temp->PlaceHolder = RemoveHtml($this->nota_temp->caption());

        // CLINIC_ID_TEMP
        $this->CLINIC_ID_TEMP->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID_TEMP->EditCustomAttributes = "";
        if (!$this->CLINIC_ID_TEMP->Raw) {
            $this->CLINIC_ID_TEMP->CurrentValue = HtmlDecode($this->CLINIC_ID_TEMP->CurrentValue);
        }
        $this->CLINIC_ID_TEMP->EditValue = $this->CLINIC_ID_TEMP->CurrentValue;
        $this->CLINIC_ID_TEMP->PlaceHolder = RemoveHtml($this->CLINIC_ID_TEMP->caption());

        // NOSEP
        $this->NOSEP->EditAttrs["class"] = "form-control";
        $this->NOSEP->EditCustomAttributes = "";
        if (!$this->NOSEP->Raw) {
            $this->NOSEP->CurrentValue = HtmlDecode($this->NOSEP->CurrentValue);
        }
        $this->NOSEP->EditValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->PlaceHolder = RemoveHtml($this->NOSEP->caption());

        // ID
        $this->ID->EditAttrs["class"] = "form-control";
        $this->ID->EditCustomAttributes = "";
        $this->ID->EditValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

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
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->TREATMENT);
                    $doc->exportCaption($this->QUANTITY);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->CLINIC_ID_FROM);
                    $doc->exportCaption($this->TREATMENT);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->POKOK_JUAL);
                    $doc->exportCaption($this->PPN);
                    $doc->exportCaption($this->MARGIN);
                    $doc->exportCaption($this->SUBSIDI);
                    $doc->exportCaption($this->EMBALACE);
                    $doc->exportCaption($this->PROFESI);
                    $doc->exportCaption($this->DISCOUNT);
                    $doc->exportCaption($this->PAY_METHOD_ID);
                    $doc->exportCaption($this->PAYMENT_DATE);
                    $doc->exportCaption($this->ISLUNAS);
                    $doc->exportCaption($this->DUEDATE_ANGSURAN);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->KUITANSI_ID);
                    $doc->exportCaption($this->NOTA_NO);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->RESEP_NO);
                    $doc->exportCaption($this->RESEP_KE);
                    $doc->exportCaption($this->DOSE);
                    $doc->exportCaption($this->ORIG_DOSE);
                    $doc->exportCaption($this->DOSE_PRESC);
                    $doc->exportCaption($this->ITER);
                    $doc->exportCaption($this->ITER_KE);
                    $doc->exportCaption($this->SOLD_STATUS);
                    $doc->exportCaption($this->RACIKAN);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->PERDA_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->DESCRIPTION2);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->JML_BKS);
                    $doc->exportCaption($this->EXIT_DATE);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->TASK_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID_FROM);
                    $doc->exportCaption($this->DOCTOR_FROM);
                    $doc->exportCaption($this->status_pasien_id);
                    $doc->exportCaption($this->amount_paid);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->serial_nb);
                    $doc->exportCaption($this->TREATMENT_PLAFOND);
                    $doc->exportCaption($this->AMOUNT_PLAFOND);
                    $doc->exportCaption($this->AMOUNT_PAID_PLAFOND);
                    $doc->exportCaption($this->CLASS_ID_PLAFOND);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->PEMBULATAN);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->CORRECTION_ID);
                    $doc->exportCaption($this->CORRECTION_BY);
                    $doc->exportCaption($this->KARYAWAN);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->sell_price);
                    $doc->exportCaption($this->diskon);
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->NUMER);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->POTONGAN);
                    $doc->exportCaption($this->BAYAR);
                    $doc->exportCaption($this->RETUR);
                    $doc->exportCaption($this->TARIF_TYPE);
                    $doc->exportCaption($this->PPNVALUE);
                    $doc->exportCaption($this->TAGIHAN);
                    $doc->exportCaption($this->KOREKSI);
                    $doc->exportCaption($this->STATUS_OBAT);
                    $doc->exportCaption($this->SUBSIDISAT);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->STOCK_AVAILABLE);
                    $doc->exportCaption($this->STATUS_TARIF);
                    $doc->exportCaption($this->CLINIC_TYPE);
                    $doc->exportCaption($this->PACKAGE_ID);
                    $doc->exportCaption($this->MODULE_ID);
                    $doc->exportCaption($this->profession);
                    $doc->exportCaption($this->THEORDER);
                    $doc->exportCaption($this->CASHIER);
                    $doc->exportCaption($this->SPPFEE);
                    $doc->exportCaption($this->SPPBILL);
                    $doc->exportCaption($this->SPPRJK);
                    $doc->exportCaption($this->SPPJMN);
                    $doc->exportCaption($this->SPPKASIR);
                    $doc->exportCaption($this->PERUJUK);
                    $doc->exportCaption($this->PERUJUKFEE);
                    $doc->exportCaption($this->modified_datesys);
                    $doc->exportCaption($this->TRANS_ID);
                    $doc->exportCaption($this->SPPBILLDATE);
                    $doc->exportCaption($this->SPPBILLUSER);
                    $doc->exportCaption($this->SPPKASIRDATE);
                    $doc->exportCaption($this->SPPKASIRUSER);
                    $doc->exportCaption($this->SPPPOLI);
                    $doc->exportCaption($this->SPPPOLIUSER);
                    $doc->exportCaption($this->SPPPOLIDATE);
                    $doc->exportCaption($this->nota_temp);
                    $doc->exportCaption($this->CLINIC_ID_TEMP);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->ID);
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
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->TREATMENT);
                        $doc->exportField($this->QUANTITY);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->CLINIC_ID_FROM);
                        $doc->exportField($this->TREATMENT);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->POKOK_JUAL);
                        $doc->exportField($this->PPN);
                        $doc->exportField($this->MARGIN);
                        $doc->exportField($this->SUBSIDI);
                        $doc->exportField($this->EMBALACE);
                        $doc->exportField($this->PROFESI);
                        $doc->exportField($this->DISCOUNT);
                        $doc->exportField($this->PAY_METHOD_ID);
                        $doc->exportField($this->PAYMENT_DATE);
                        $doc->exportField($this->ISLUNAS);
                        $doc->exportField($this->DUEDATE_ANGSURAN);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->KUITANSI_ID);
                        $doc->exportField($this->NOTA_NO);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->RESEP_NO);
                        $doc->exportField($this->RESEP_KE);
                        $doc->exportField($this->DOSE);
                        $doc->exportField($this->ORIG_DOSE);
                        $doc->exportField($this->DOSE_PRESC);
                        $doc->exportField($this->ITER);
                        $doc->exportField($this->ITER_KE);
                        $doc->exportField($this->SOLD_STATUS);
                        $doc->exportField($this->RACIKAN);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->PERDA_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->DESCRIPTION2);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->JML_BKS);
                        $doc->exportField($this->EXIT_DATE);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->TASK_ID);
                        $doc->exportField($this->EMPLOYEE_ID_FROM);
                        $doc->exportField($this->DOCTOR_FROM);
                        $doc->exportField($this->status_pasien_id);
                        $doc->exportField($this->amount_paid);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->serial_nb);
                        $doc->exportField($this->TREATMENT_PLAFOND);
                        $doc->exportField($this->AMOUNT_PLAFOND);
                        $doc->exportField($this->AMOUNT_PAID_PLAFOND);
                        $doc->exportField($this->CLASS_ID_PLAFOND);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->PEMBULATAN);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->CORRECTION_ID);
                        $doc->exportField($this->CORRECTION_BY);
                        $doc->exportField($this->KARYAWAN);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->sell_price);
                        $doc->exportField($this->diskon);
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->NUMER);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->POTONGAN);
                        $doc->exportField($this->BAYAR);
                        $doc->exportField($this->RETUR);
                        $doc->exportField($this->TARIF_TYPE);
                        $doc->exportField($this->PPNVALUE);
                        $doc->exportField($this->TAGIHAN);
                        $doc->exportField($this->KOREKSI);
                        $doc->exportField($this->STATUS_OBAT);
                        $doc->exportField($this->SUBSIDISAT);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->STOCK_AVAILABLE);
                        $doc->exportField($this->STATUS_TARIF);
                        $doc->exportField($this->CLINIC_TYPE);
                        $doc->exportField($this->PACKAGE_ID);
                        $doc->exportField($this->MODULE_ID);
                        $doc->exportField($this->profession);
                        $doc->exportField($this->THEORDER);
                        $doc->exportField($this->CASHIER);
                        $doc->exportField($this->SPPFEE);
                        $doc->exportField($this->SPPBILL);
                        $doc->exportField($this->SPPRJK);
                        $doc->exportField($this->SPPJMN);
                        $doc->exportField($this->SPPKASIR);
                        $doc->exportField($this->PERUJUK);
                        $doc->exportField($this->PERUJUKFEE);
                        $doc->exportField($this->modified_datesys);
                        $doc->exportField($this->TRANS_ID);
                        $doc->exportField($this->SPPBILLDATE);
                        $doc->exportField($this->SPPBILLUSER);
                        $doc->exportField($this->SPPKASIRDATE);
                        $doc->exportField($this->SPPKASIRUSER);
                        $doc->exportField($this->SPPPOLI);
                        $doc->exportField($this->SPPPOLIUSER);
                        $doc->exportField($this->SPPPOLIDATE);
                        $doc->exportField($this->nota_temp);
                        $doc->exportField($this->CLINIC_ID_TEMP);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->ID);
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
