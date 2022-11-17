<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for TREAT_RESULTS
 */
class TreatResults extends DbTable
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
    public $NO_REGISTRATION;
    public $VISIT_ID;
    public $RESULT_ID;
    public $CLINIC_ID;
    public $BILL_ID;
    public $PACKAGE_ID;
    public $TARIF_ID;
    public $TARIF_NAME;
    public $EMPLOYEE_ID;
    public $EMPLOYEE_ID_FROM;
    public $PICKUP_DATE;
    public $REAGENT_ID;
    public $SPECIMEN_ID;
    public $METHOD_ID;
    public $CONCLUSION;
    public $RESULT_VALUE;
    public $RESULT_ENGLISH;
    public $NORMAL_VALUE;
    public $CONVERSION;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $DESCRIPTION;
    public $DOCTOR;
    public $DOCTOR_FROM;
    public $STATUS_PASIEN_ID;
    public $THENAME;
    public $THEADDRESS;
    public $AGEYEAR;
    public $AGEMONTH;
    public $AGEDAY;
    public $THEID;
    public $GENDER;
    public $ISRJ;
    public $KAL_ID;
    public $ISNEW;
    public $ISNEW_CLINIC;
    public $VISIT_TRANS;
    public $REAGENT_NAME;
    public $BOUND_ID;
    public $MEASURE_ID;
    public $MEASURE_ENGLISH;
    public $SATUAN;
    public $SATUAN_ENG;
    public $RESULT_TYPE;
    public $MAX_VALUE;
    public $MIN_VALUE;
    public $NORMAL_ENGLISH;
    public $DESC_ENGLISH;
    public $LISS_ID;
    public $NOTA_NO;
    public $KUITANSI_ID;
    public $PRINT_DATE;
    public $PRINTED_BY;
    public $PRINTQ;
    public $clinic_id_from;
    public $NOSEP;
    public $nota_temp;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'TREAT_RESULTS';
        $this->TableName = 'TREAT_RESULTS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[TREAT_RESULTS]";
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
        $this->ORG_UNIT_CODE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->IsPrimaryKey = true; // Primary key field
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->IsPrimaryKey = true; // Primary key field
        $this->VISIT_ID->Nullable = false; // NOT NULL field
        $this->VISIT_ID->Required = true; // Required field
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // RESULT_ID
        $this->RESULT_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_RESULT_ID', 'RESULT_ID', '[RESULT_ID]', '[RESULT_ID]', 200, 50, -1, false, '[RESULT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESULT_ID->IsPrimaryKey = true; // Primary key field
        $this->RESULT_ID->Nullable = false; // NOT NULL field
        $this->RESULT_ID->Required = true; // Required field
        $this->RESULT_ID->Sortable = true; // Allow sort
        $this->RESULT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESULT_ID->Param, "CustomMsg");
        $this->Fields['RESULT_ID'] = &$this->RESULT_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 50, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // BILL_ID
        $this->BILL_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_BILL_ID', 'BILL_ID', '[BILL_ID]', '[BILL_ID]', 200, 50, -1, false, '[BILL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_ID->Sortable = true; // Allow sort
        $this->BILL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_ID->Param, "CustomMsg");
        $this->Fields['BILL_ID'] = &$this->BILL_ID;

        // PACKAGE_ID
        $this->PACKAGE_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_PACKAGE_ID', 'PACKAGE_ID', '[PACKAGE_ID]', '[PACKAGE_ID]', 200, 50, -1, false, '[PACKAGE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PACKAGE_ID->Sortable = true; // Allow sort
        $this->PACKAGE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PACKAGE_ID->Param, "CustomMsg");
        $this->Fields['PACKAGE_ID'] = &$this->PACKAGE_ID;

        // TARIF_ID
        $this->TARIF_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_TARIF_ID', 'TARIF_ID', '[TARIF_ID]', '[TARIF_ID]', 200, 50, -1, false, '[TARIF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_ID->Sortable = true; // Allow sort
        $this->TARIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_ID->Param, "CustomMsg");
        $this->Fields['TARIF_ID'] = &$this->TARIF_ID;

        // TARIF_NAME
        $this->TARIF_NAME = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_TARIF_NAME', 'TARIF_NAME', '[TARIF_NAME]', '[TARIF_NAME]', 200, 200, -1, false, '[TARIF_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_NAME->Sortable = true; // Allow sort
        $this->TARIF_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_NAME->Param, "CustomMsg");
        $this->Fields['TARIF_NAME'] = &$this->TARIF_NAME;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_EMPLOYEE_ID_FROM', 'EMPLOYEE_ID_FROM', '[EMPLOYEE_ID_FROM]', '[EMPLOYEE_ID_FROM]', 200, 15, -1, false, '[EMPLOYEE_ID_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID_FROM->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID_FROM->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID_FROM'] = &$this->EMPLOYEE_ID_FROM;

        // PICKUP_DATE
        $this->PICKUP_DATE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_PICKUP_DATE', 'PICKUP_DATE', '[PICKUP_DATE]', CastDateFieldForLike("[PICKUP_DATE]", 0, "DB"), 135, 8, 0, false, '[PICKUP_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PICKUP_DATE->Sortable = true; // Allow sort
        $this->PICKUP_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PICKUP_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PICKUP_DATE->Param, "CustomMsg");
        $this->Fields['PICKUP_DATE'] = &$this->PICKUP_DATE;

        // REAGENT_ID
        $this->REAGENT_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_REAGENT_ID', 'REAGENT_ID', '[REAGENT_ID]', '[REAGENT_ID]', 200, 50, -1, false, '[REAGENT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REAGENT_ID->Sortable = true; // Allow sort
        $this->REAGENT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REAGENT_ID->Param, "CustomMsg");
        $this->Fields['REAGENT_ID'] = &$this->REAGENT_ID;

        // SPECIMEN_ID
        $this->SPECIMEN_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_SPECIMEN_ID', 'SPECIMEN_ID', '[SPECIMEN_ID]', '[SPECIMEN_ID]', 200, 50, -1, false, '[SPECIMEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPECIMEN_ID->Sortable = true; // Allow sort
        $this->SPECIMEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPECIMEN_ID->Param, "CustomMsg");
        $this->Fields['SPECIMEN_ID'] = &$this->SPECIMEN_ID;

        // METHOD_ID
        $this->METHOD_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_METHOD_ID', 'METHOD_ID', '[METHOD_ID]', 'CAST([METHOD_ID] AS NVARCHAR)', 17, 1, -1, false, '[METHOD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->METHOD_ID->Sortable = true; // Allow sort
        $this->METHOD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->METHOD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->METHOD_ID->Param, "CustomMsg");
        $this->Fields['METHOD_ID'] = &$this->METHOD_ID;

        // CONCLUSION
        $this->CONCLUSION = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_CONCLUSION', 'CONCLUSION', '[CONCLUSION]', '[CONCLUSION]', 200, 8000, -1, false, '[CONCLUSION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONCLUSION->Sortable = true; // Allow sort
        $this->CONCLUSION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONCLUSION->Param, "CustomMsg");
        $this->Fields['CONCLUSION'] = &$this->CONCLUSION;

        // RESULT_VALUE
        $this->RESULT_VALUE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_RESULT_VALUE', 'RESULT_VALUE', '[RESULT_VALUE]', '[RESULT_VALUE]', 200, 0, -1, false, '[RESULT_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESULT_VALUE->Sortable = true; // Allow sort
        $this->RESULT_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESULT_VALUE->Param, "CustomMsg");
        $this->Fields['RESULT_VALUE'] = &$this->RESULT_VALUE;

        // RESULT_ENGLISH
        $this->RESULT_ENGLISH = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_RESULT_ENGLISH', 'RESULT_ENGLISH', '[RESULT_ENGLISH]', '[RESULT_ENGLISH]', 200, 200, -1, false, '[RESULT_ENGLISH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESULT_ENGLISH->Sortable = true; // Allow sort
        $this->RESULT_ENGLISH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESULT_ENGLISH->Param, "CustomMsg");
        $this->Fields['RESULT_ENGLISH'] = &$this->RESULT_ENGLISH;

        // NORMAL_VALUE
        $this->NORMAL_VALUE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_NORMAL_VALUE', 'NORMAL_VALUE', '[NORMAL_VALUE]', '[NORMAL_VALUE]', 200, 4000, -1, false, '[NORMAL_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NORMAL_VALUE->Sortable = true; // Allow sort
        $this->NORMAL_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NORMAL_VALUE->Param, "CustomMsg");
        $this->Fields['NORMAL_VALUE'] = &$this->NORMAL_VALUE;

        // CONVERSION
        $this->CONVERSION = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_CONVERSION', 'CONVERSION', '[CONVERSION]', 'CAST([CONVERSION] AS NVARCHAR)', 131, 8, -1, false, '[CONVERSION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONVERSION->Sortable = true; // Allow sort
        $this->CONVERSION->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->CONVERSION->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->CONVERSION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONVERSION->Param, "CustomMsg");
        $this->Fields['CONVERSION'] = &$this->CONVERSION;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 200, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // DOCTOR
        $this->DOCTOR = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_DOCTOR', 'DOCTOR', '[DOCTOR]', '[DOCTOR]', 200, 150, -1, false, '[DOCTOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR->Sortable = true; // Allow sort
        $this->DOCTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR->Param, "CustomMsg");
        $this->Fields['DOCTOR'] = &$this->DOCTOR;

        // DOCTOR_FROM
        $this->DOCTOR_FROM = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_DOCTOR_FROM', 'DOCTOR_FROM', '[DOCTOR_FROM]', '[DOCTOR_FROM]', 200, 150, -1, false, '[DOCTOR_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR_FROM->Sortable = true; // Allow sort
        $this->DOCTOR_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR_FROM->Param, "CustomMsg");
        $this->Fields['DOCTOR_FROM'] = &$this->DOCTOR_FROM;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // THENAME
        $this->THENAME = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // THEADDRESS
        $this->THEADDRESS = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 150, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // AGEYEAR
        $this->AGEYEAR = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // THEID
        $this->THEID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 50, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = true; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->Fields['THEID'] = &$this->THEID;

        // GENDER
        $this->GENDER = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // ISRJ
        $this->ISRJ = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // KAL_ID
        $this->KAL_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // ISNEW
        $this->ISNEW = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_ISNEW', 'ISNEW', '[ISNEW]', '[ISNEW]', 129, 1, -1, false, '[ISNEW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISNEW->Sortable = true; // Allow sort
        $this->ISNEW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISNEW->Param, "CustomMsg");
        $this->Fields['ISNEW'] = &$this->ISNEW;

        // ISNEW_CLINIC
        $this->ISNEW_CLINIC = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_ISNEW_CLINIC', 'ISNEW_CLINIC', '[ISNEW_CLINIC]', '[ISNEW_CLINIC]', 129, 1, -1, false, '[ISNEW_CLINIC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISNEW_CLINIC->Sortable = true; // Allow sort
        $this->ISNEW_CLINIC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISNEW_CLINIC->Param, "CustomMsg");
        $this->Fields['ISNEW_CLINIC'] = &$this->ISNEW_CLINIC;

        // VISIT_TRANS
        $this->VISIT_TRANS = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_VISIT_TRANS', 'VISIT_TRANS', '[VISIT_TRANS]', '[VISIT_TRANS]', 200, 50, -1, false, '[VISIT_TRANS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_TRANS->Sortable = true; // Allow sort
        $this->VISIT_TRANS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_TRANS->Param, "CustomMsg");
        $this->Fields['VISIT_TRANS'] = &$this->VISIT_TRANS;

        // REAGENT_NAME
        $this->REAGENT_NAME = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_REAGENT_NAME', 'REAGENT_NAME', '[REAGENT_NAME]', '[REAGENT_NAME]', 200, 200, -1, false, '[REAGENT_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REAGENT_NAME->Sortable = true; // Allow sort
        $this->REAGENT_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REAGENT_NAME->Param, "CustomMsg");
        $this->Fields['REAGENT_NAME'] = &$this->REAGENT_NAME;

        // BOUND_ID
        $this->BOUND_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_BOUND_ID', 'BOUND_ID', '[BOUND_ID]', '[BOUND_ID]', 200, 50, -1, false, '[BOUND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BOUND_ID->Sortable = true; // Allow sort
        $this->BOUND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BOUND_ID->Param, "CustomMsg");
        $this->Fields['BOUND_ID'] = &$this->BOUND_ID;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // MEASURE_ENGLISH
        $this->MEASURE_ENGLISH = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_MEASURE_ENGLISH', 'MEASURE_ENGLISH', '[MEASURE_ENGLISH]', 'CAST([MEASURE_ENGLISH] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ENGLISH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ENGLISH->Sortable = true; // Allow sort
        $this->MEASURE_ENGLISH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ENGLISH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ENGLISH->Param, "CustomMsg");
        $this->Fields['MEASURE_ENGLISH'] = &$this->MEASURE_ENGLISH;

        // SATUAN
        $this->SATUAN = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_SATUAN', 'SATUAN', '[SATUAN]', '[SATUAN]', 200, 50, -1, false, '[SATUAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SATUAN->Sortable = true; // Allow sort
        $this->SATUAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SATUAN->Param, "CustomMsg");
        $this->Fields['SATUAN'] = &$this->SATUAN;

        // SATUAN_ENG
        $this->SATUAN_ENG = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_SATUAN_ENG', 'SATUAN_ENG', '[SATUAN_ENG]', '[SATUAN_ENG]', 200, 50, -1, false, '[SATUAN_ENG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SATUAN_ENG->Sortable = true; // Allow sort
        $this->SATUAN_ENG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SATUAN_ENG->Param, "CustomMsg");
        $this->Fields['SATUAN_ENG'] = &$this->SATUAN_ENG;

        // RESULT_TYPE
        $this->RESULT_TYPE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_RESULT_TYPE', 'RESULT_TYPE', '[RESULT_TYPE]', 'CAST([RESULT_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[RESULT_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESULT_TYPE->Sortable = true; // Allow sort
        $this->RESULT_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RESULT_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESULT_TYPE->Param, "CustomMsg");
        $this->Fields['RESULT_TYPE'] = &$this->RESULT_TYPE;

        // MAX_VALUE
        $this->MAX_VALUE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_MAX_VALUE', 'MAX_VALUE', '[MAX_VALUE]', '[MAX_VALUE]', 200, 50, -1, false, '[MAX_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MAX_VALUE->Sortable = true; // Allow sort
        $this->MAX_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MAX_VALUE->Param, "CustomMsg");
        $this->Fields['MAX_VALUE'] = &$this->MAX_VALUE;

        // MIN_VALUE
        $this->MIN_VALUE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_MIN_VALUE', 'MIN_VALUE', '[MIN_VALUE]', '[MIN_VALUE]', 200, 50, -1, false, '[MIN_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MIN_VALUE->Sortable = true; // Allow sort
        $this->MIN_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MIN_VALUE->Param, "CustomMsg");
        $this->Fields['MIN_VALUE'] = &$this->MIN_VALUE;

        // NORMAL_ENGLISH
        $this->NORMAL_ENGLISH = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_NORMAL_ENGLISH', 'NORMAL_ENGLISH', '[NORMAL_ENGLISH]', '[NORMAL_ENGLISH]', 200, 4000, -1, false, '[NORMAL_ENGLISH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NORMAL_ENGLISH->Sortable = true; // Allow sort
        $this->NORMAL_ENGLISH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NORMAL_ENGLISH->Param, "CustomMsg");
        $this->Fields['NORMAL_ENGLISH'] = &$this->NORMAL_ENGLISH;

        // DESC_ENGLISH
        $this->DESC_ENGLISH = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_DESC_ENGLISH', 'DESC_ENGLISH', '[DESC_ENGLISH]', '[DESC_ENGLISH]', 200, 255, -1, false, '[DESC_ENGLISH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESC_ENGLISH->Sortable = true; // Allow sort
        $this->DESC_ENGLISH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESC_ENGLISH->Param, "CustomMsg");
        $this->Fields['DESC_ENGLISH'] = &$this->DESC_ENGLISH;

        // LISS_ID
        $this->LISS_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_LISS_ID', 'LISS_ID', '[LISS_ID]', '[LISS_ID]', 200, 50, -1, false, '[LISS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LISS_ID->Sortable = true; // Allow sort
        $this->LISS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LISS_ID->Param, "CustomMsg");
        $this->Fields['LISS_ID'] = &$this->LISS_ID;

        // NOTA_NO
        $this->NOTA_NO = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_NOTA_NO', 'NOTA_NO', '[NOTA_NO]', '[NOTA_NO]', 200, 50, -1, false, '[NOTA_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOTA_NO->Sortable = true; // Allow sort
        $this->NOTA_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOTA_NO->Param, "CustomMsg");
        $this->Fields['NOTA_NO'] = &$this->NOTA_NO;

        // KUITANSI_ID
        $this->KUITANSI_ID = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_KUITANSI_ID', 'KUITANSI_ID', '[KUITANSI_ID]', '[KUITANSI_ID]', 200, 50, -1, false, '[KUITANSI_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KUITANSI_ID->Sortable = true; // Allow sort
        $this->KUITANSI_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KUITANSI_ID->Param, "CustomMsg");
        $this->Fields['KUITANSI_ID'] = &$this->KUITANSI_ID;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = true; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // PRINTED_BY
        $this->PRINTED_BY = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_PRINTED_BY', 'PRINTED_BY', '[PRINTED_BY]', '[PRINTED_BY]', 200, 50, -1, false, '[PRINTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTED_BY->Sortable = true; // Allow sort
        $this->PRINTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTED_BY->Param, "CustomMsg");
        $this->Fields['PRINTED_BY'] = &$this->PRINTED_BY;

        // PRINTQ
        $this->PRINTQ = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_PRINTQ', 'PRINTQ', '[PRINTQ]', 'CAST([PRINTQ] AS NVARCHAR)', 2, 2, -1, false, '[PRINTQ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTQ->Sortable = true; // Allow sort
        $this->PRINTQ->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PRINTQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTQ->Param, "CustomMsg");
        $this->Fields['PRINTQ'] = &$this->PRINTQ;

        // clinic_id_from
        $this->clinic_id_from = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_clinic_id_from', 'clinic_id_from', '[clinic_id_from]', '[clinic_id_from]', 200, 20, -1, false, '[clinic_id_from]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->clinic_id_from->Sortable = true; // Allow sort
        $this->clinic_id_from->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->clinic_id_from->Param, "CustomMsg");
        $this->Fields['clinic_id_from'] = &$this->clinic_id_from;

        // NOSEP
        $this->NOSEP = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_NOSEP', 'NOSEP', '[NOSEP]', '[NOSEP]', 200, 50, -1, false, '[NOSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSEP->Sortable = true; // Allow sort
        $this->NOSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSEP->Param, "CustomMsg");
        $this->Fields['NOSEP'] = &$this->NOSEP;

        // nota_temp
        $this->nota_temp = new DbField('TREAT_RESULTS', 'TREAT_RESULTS', 'x_nota_temp', 'nota_temp', '[nota_temp]', '[nota_temp]', 200, 50, -1, false, '[nota_temp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nota_temp->Sortable = true; // Allow sort
        $this->nota_temp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nota_temp->Param, "CustomMsg");
        $this->Fields['nota_temp'] = &$this->nota_temp;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[TREAT_RESULTS]";
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
            if (array_key_exists('NO_REGISTRATION', $rs)) {
                AddFilter($where, QuotedName('NO_REGISTRATION', $this->Dbid) . '=' . QuotedValue($rs['NO_REGISTRATION'], $this->NO_REGISTRATION->DataType, $this->Dbid));
            }
            if (array_key_exists('VISIT_ID', $rs)) {
                AddFilter($where, QuotedName('VISIT_ID', $this->Dbid) . '=' . QuotedValue($rs['VISIT_ID'], $this->VISIT_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('RESULT_ID', $rs)) {
                AddFilter($where, QuotedName('RESULT_ID', $this->Dbid) . '=' . QuotedValue($rs['RESULT_ID'], $this->RESULT_ID->DataType, $this->Dbid));
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
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->RESULT_ID->DbValue = $row['RESULT_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->BILL_ID->DbValue = $row['BILL_ID'];
        $this->PACKAGE_ID->DbValue = $row['PACKAGE_ID'];
        $this->TARIF_ID->DbValue = $row['TARIF_ID'];
        $this->TARIF_NAME->DbValue = $row['TARIF_NAME'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->EMPLOYEE_ID_FROM->DbValue = $row['EMPLOYEE_ID_FROM'];
        $this->PICKUP_DATE->DbValue = $row['PICKUP_DATE'];
        $this->REAGENT_ID->DbValue = $row['REAGENT_ID'];
        $this->SPECIMEN_ID->DbValue = $row['SPECIMEN_ID'];
        $this->METHOD_ID->DbValue = $row['METHOD_ID'];
        $this->CONCLUSION->DbValue = $row['CONCLUSION'];
        $this->RESULT_VALUE->DbValue = $row['RESULT_VALUE'];
        $this->RESULT_ENGLISH->DbValue = $row['RESULT_ENGLISH'];
        $this->NORMAL_VALUE->DbValue = $row['NORMAL_VALUE'];
        $this->CONVERSION->DbValue = $row['CONVERSION'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->DOCTOR->DbValue = $row['DOCTOR'];
        $this->DOCTOR_FROM->DbValue = $row['DOCTOR_FROM'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->THENAME->DbValue = $row['THENAME'];
        $this->THEADDRESS->DbValue = $row['THEADDRESS'];
        $this->AGEYEAR->DbValue = $row['AGEYEAR'];
        $this->AGEMONTH->DbValue = $row['AGEMONTH'];
        $this->AGEDAY->DbValue = $row['AGEDAY'];
        $this->THEID->DbValue = $row['THEID'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->ISNEW->DbValue = $row['ISNEW'];
        $this->ISNEW_CLINIC->DbValue = $row['ISNEW_CLINIC'];
        $this->VISIT_TRANS->DbValue = $row['VISIT_TRANS'];
        $this->REAGENT_NAME->DbValue = $row['REAGENT_NAME'];
        $this->BOUND_ID->DbValue = $row['BOUND_ID'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->MEASURE_ENGLISH->DbValue = $row['MEASURE_ENGLISH'];
        $this->SATUAN->DbValue = $row['SATUAN'];
        $this->SATUAN_ENG->DbValue = $row['SATUAN_ENG'];
        $this->RESULT_TYPE->DbValue = $row['RESULT_TYPE'];
        $this->MAX_VALUE->DbValue = $row['MAX_VALUE'];
        $this->MIN_VALUE->DbValue = $row['MIN_VALUE'];
        $this->NORMAL_ENGLISH->DbValue = $row['NORMAL_ENGLISH'];
        $this->DESC_ENGLISH->DbValue = $row['DESC_ENGLISH'];
        $this->LISS_ID->DbValue = $row['LISS_ID'];
        $this->NOTA_NO->DbValue = $row['NOTA_NO'];
        $this->KUITANSI_ID->DbValue = $row['KUITANSI_ID'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->PRINTED_BY->DbValue = $row['PRINTED_BY'];
        $this->PRINTQ->DbValue = $row['PRINTQ'];
        $this->clinic_id_from->DbValue = $row['clinic_id_from'];
        $this->NOSEP->DbValue = $row['NOSEP'];
        $this->nota_temp->DbValue = $row['nota_temp'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [NO_REGISTRATION] = '@NO_REGISTRATION@' AND [VISIT_ID] = '@VISIT_ID@' AND [RESULT_ID] = '@RESULT_ID@'";
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
        $val = $current ? $this->NO_REGISTRATION->CurrentValue : $this->NO_REGISTRATION->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->VISIT_ID->CurrentValue : $this->VISIT_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->RESULT_ID->CurrentValue : $this->RESULT_ID->OldValue;
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
        if (count($keys) == 4) {
            if ($current) {
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
            }
            if ($current) {
                $this->NO_REGISTRATION->CurrentValue = $keys[1];
            } else {
                $this->NO_REGISTRATION->OldValue = $keys[1];
            }
            if ($current) {
                $this->VISIT_ID->CurrentValue = $keys[2];
            } else {
                $this->VISIT_ID->OldValue = $keys[2];
            }
            if ($current) {
                $this->RESULT_ID->CurrentValue = $keys[3];
            } else {
                $this->RESULT_ID->OldValue = $keys[3];
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
            $val = array_key_exists('NO_REGISTRATION', $row) ? $row['NO_REGISTRATION'] : null;
        } else {
            $val = $this->NO_REGISTRATION->OldValue !== null ? $this->NO_REGISTRATION->OldValue : $this->NO_REGISTRATION->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NO_REGISTRATION@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
            $val = array_key_exists('RESULT_ID', $row) ? $row['RESULT_ID'] : null;
        } else {
            $val = $this->RESULT_ID->OldValue !== null ? $this->RESULT_ID->OldValue : $this->RESULT_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@RESULT_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("TreatResultsList");
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
        if ($pageName == "TreatResultsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "TreatResultsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "TreatResultsAdd") {
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
                return "TreatResultsView";
            case Config("API_ADD_ACTION"):
                return "TreatResultsAdd";
            case Config("API_EDIT_ACTION"):
                return "TreatResultsEdit";
            case Config("API_DELETE_ACTION"):
                return "TreatResultsDelete";
            case Config("API_LIST_ACTION"):
                return "TreatResultsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "TreatResultsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TreatResultsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("TreatResultsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "TreatResultsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "TreatResultsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("TreatResultsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("TreatResultsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("TreatResultsDelete", $this->getUrlParm());
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
        $json .= ",NO_REGISTRATION:" . JsonEncode($this->NO_REGISTRATION->CurrentValue, "string");
        $json .= ",VISIT_ID:" . JsonEncode($this->VISIT_ID->CurrentValue, "string");
        $json .= ",RESULT_ID:" . JsonEncode($this->RESULT_ID->CurrentValue, "string");
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
        if ($this->NO_REGISTRATION->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NO_REGISTRATION->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->VISIT_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->VISIT_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->RESULT_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->RESULT_ID->CurrentValue);
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
            if (($keyValue = Param("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("VISIT_ID") ?? Route("VISIT_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(2) ?? Route(4)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("RESULT_ID") ?? Route("RESULT_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(3) ?? Route(5)) !== null)) {
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
                if (!is_array($key) || count($key) != 4) {
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
                $this->NO_REGISTRATION->CurrentValue = $key[1];
            } else {
                $this->NO_REGISTRATION->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->VISIT_ID->CurrentValue = $key[2];
            } else {
                $this->VISIT_ID->OldValue = $key[2];
            }
            if ($setCurrent) {
                $this->RESULT_ID->CurrentValue = $key[3];
            } else {
                $this->RESULT_ID->OldValue = $key[3];
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
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->RESULT_ID->setDbValue($row['RESULT_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->PACKAGE_ID->setDbValue($row['PACKAGE_ID']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->TARIF_NAME->setDbValue($row['TARIF_NAME']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->EMPLOYEE_ID_FROM->setDbValue($row['EMPLOYEE_ID_FROM']);
        $this->PICKUP_DATE->setDbValue($row['PICKUP_DATE']);
        $this->REAGENT_ID->setDbValue($row['REAGENT_ID']);
        $this->SPECIMEN_ID->setDbValue($row['SPECIMEN_ID']);
        $this->METHOD_ID->setDbValue($row['METHOD_ID']);
        $this->CONCLUSION->setDbValue($row['CONCLUSION']);
        $this->RESULT_VALUE->setDbValue($row['RESULT_VALUE']);
        $this->RESULT_ENGLISH->setDbValue($row['RESULT_ENGLISH']);
        $this->NORMAL_VALUE->setDbValue($row['NORMAL_VALUE']);
        $this->CONVERSION->setDbValue($row['CONVERSION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->DOCTOR_FROM->setDbValue($row['DOCTOR_FROM']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->THEID->setDbValue($row['THEID']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->ISNEW->setDbValue($row['ISNEW']);
        $this->ISNEW_CLINIC->setDbValue($row['ISNEW_CLINIC']);
        $this->VISIT_TRANS->setDbValue($row['VISIT_TRANS']);
        $this->REAGENT_NAME->setDbValue($row['REAGENT_NAME']);
        $this->BOUND_ID->setDbValue($row['BOUND_ID']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->MEASURE_ENGLISH->setDbValue($row['MEASURE_ENGLISH']);
        $this->SATUAN->setDbValue($row['SATUAN']);
        $this->SATUAN_ENG->setDbValue($row['SATUAN_ENG']);
        $this->RESULT_TYPE->setDbValue($row['RESULT_TYPE']);
        $this->MAX_VALUE->setDbValue($row['MAX_VALUE']);
        $this->MIN_VALUE->setDbValue($row['MIN_VALUE']);
        $this->NORMAL_ENGLISH->setDbValue($row['NORMAL_ENGLISH']);
        $this->DESC_ENGLISH->setDbValue($row['DESC_ENGLISH']);
        $this->LISS_ID->setDbValue($row['LISS_ID']);
        $this->NOTA_NO->setDbValue($row['NOTA_NO']);
        $this->KUITANSI_ID->setDbValue($row['KUITANSI_ID']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->clinic_id_from->setDbValue($row['clinic_id_from']);
        $this->NOSEP->setDbValue($row['NOSEP']);
        $this->nota_temp->setDbValue($row['nota_temp']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // NO_REGISTRATION

        // VISIT_ID

        // RESULT_ID

        // CLINIC_ID

        // BILL_ID

        // PACKAGE_ID

        // TARIF_ID

        // TARIF_NAME

        // EMPLOYEE_ID

        // EMPLOYEE_ID_FROM

        // PICKUP_DATE

        // REAGENT_ID

        // SPECIMEN_ID

        // METHOD_ID

        // CONCLUSION

        // RESULT_VALUE

        // RESULT_ENGLISH

        // NORMAL_VALUE

        // CONVERSION

        // MODIFIED_DATE

        // MODIFIED_BY

        // DESCRIPTION

        // DOCTOR

        // DOCTOR_FROM

        // STATUS_PASIEN_ID

        // THENAME

        // THEADDRESS

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // THEID

        // GENDER

        // ISRJ

        // KAL_ID

        // ISNEW

        // ISNEW_CLINIC

        // VISIT_TRANS

        // REAGENT_NAME

        // BOUND_ID

        // MEASURE_ID

        // MEASURE_ENGLISH

        // SATUAN

        // SATUAN_ENG

        // RESULT_TYPE

        // MAX_VALUE

        // MIN_VALUE

        // NORMAL_ENGLISH

        // DESC_ENGLISH

        // LISS_ID

        // NOTA_NO

        // KUITANSI_ID

        // PRINT_DATE

        // PRINTED_BY

        // PRINTQ

        // clinic_id_from

        // NOSEP

        // nota_temp

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // RESULT_ID
        $this->RESULT_ID->ViewValue = $this->RESULT_ID->CurrentValue;
        $this->RESULT_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // BILL_ID
        $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->ViewCustomAttributes = "";

        // PACKAGE_ID
        $this->PACKAGE_ID->ViewValue = $this->PACKAGE_ID->CurrentValue;
        $this->PACKAGE_ID->ViewCustomAttributes = "";

        // TARIF_ID
        $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->ViewCustomAttributes = "";

        // TARIF_NAME
        $this->TARIF_NAME->ViewValue = $this->TARIF_NAME->CurrentValue;
        $this->TARIF_NAME->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->ViewValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $this->EMPLOYEE_ID_FROM->ViewCustomAttributes = "";

        // PICKUP_DATE
        $this->PICKUP_DATE->ViewValue = $this->PICKUP_DATE->CurrentValue;
        $this->PICKUP_DATE->ViewValue = FormatDateTime($this->PICKUP_DATE->ViewValue, 0);
        $this->PICKUP_DATE->ViewCustomAttributes = "";

        // REAGENT_ID
        $this->REAGENT_ID->ViewValue = $this->REAGENT_ID->CurrentValue;
        $this->REAGENT_ID->ViewCustomAttributes = "";

        // SPECIMEN_ID
        $this->SPECIMEN_ID->ViewValue = $this->SPECIMEN_ID->CurrentValue;
        $this->SPECIMEN_ID->ViewCustomAttributes = "";

        // METHOD_ID
        $this->METHOD_ID->ViewValue = $this->METHOD_ID->CurrentValue;
        $this->METHOD_ID->ViewValue = FormatNumber($this->METHOD_ID->ViewValue, 0, -2, -2, -2);
        $this->METHOD_ID->ViewCustomAttributes = "";

        // CONCLUSION
        $this->CONCLUSION->ViewValue = $this->CONCLUSION->CurrentValue;
        $this->CONCLUSION->ViewCustomAttributes = "";

        // RESULT_VALUE
        $this->RESULT_VALUE->ViewValue = $this->RESULT_VALUE->CurrentValue;
        $this->RESULT_VALUE->ViewCustomAttributes = "";

        // RESULT_ENGLISH
        $this->RESULT_ENGLISH->ViewValue = $this->RESULT_ENGLISH->CurrentValue;
        $this->RESULT_ENGLISH->ViewCustomAttributes = "";

        // NORMAL_VALUE
        $this->NORMAL_VALUE->ViewValue = $this->NORMAL_VALUE->CurrentValue;
        $this->NORMAL_VALUE->ViewCustomAttributes = "";

        // CONVERSION
        $this->CONVERSION->ViewValue = $this->CONVERSION->CurrentValue;
        $this->CONVERSION->ViewValue = FormatNumber($this->CONVERSION->ViewValue, 2, -2, -2, -2);
        $this->CONVERSION->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // DOCTOR
        $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->ViewCustomAttributes = "";

        // DOCTOR_FROM
        $this->DOCTOR_FROM->ViewValue = $this->DOCTOR_FROM->CurrentValue;
        $this->DOCTOR_FROM->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // THENAME
        $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
        $this->THENAME->ViewCustomAttributes = "";

        // THEADDRESS
        $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
        $this->THEADDRESS->ViewCustomAttributes = "";

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

        // THEID
        $this->THEID->ViewValue = $this->THEID->CurrentValue;
        $this->THEID->ViewCustomAttributes = "";

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

        // ISRJ
        $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
        $this->ISRJ->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // ISNEW
        $this->ISNEW->ViewValue = $this->ISNEW->CurrentValue;
        $this->ISNEW->ViewCustomAttributes = "";

        // ISNEW_CLINIC
        $this->ISNEW_CLINIC->ViewValue = $this->ISNEW_CLINIC->CurrentValue;
        $this->ISNEW_CLINIC->ViewCustomAttributes = "";

        // VISIT_TRANS
        $this->VISIT_TRANS->ViewValue = $this->VISIT_TRANS->CurrentValue;
        $this->VISIT_TRANS->ViewCustomAttributes = "";

        // REAGENT_NAME
        $this->REAGENT_NAME->ViewValue = $this->REAGENT_NAME->CurrentValue;
        $this->REAGENT_NAME->ViewCustomAttributes = "";

        // BOUND_ID
        $this->BOUND_ID->ViewValue = $this->BOUND_ID->CurrentValue;
        $this->BOUND_ID->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // MEASURE_ENGLISH
        $this->MEASURE_ENGLISH->ViewValue = $this->MEASURE_ENGLISH->CurrentValue;
        $this->MEASURE_ENGLISH->ViewValue = FormatNumber($this->MEASURE_ENGLISH->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ENGLISH->ViewCustomAttributes = "";

        // SATUAN
        $this->SATUAN->ViewValue = $this->SATUAN->CurrentValue;
        $this->SATUAN->ViewCustomAttributes = "";

        // SATUAN_ENG
        $this->SATUAN_ENG->ViewValue = $this->SATUAN_ENG->CurrentValue;
        $this->SATUAN_ENG->ViewCustomAttributes = "";

        // RESULT_TYPE
        $this->RESULT_TYPE->ViewValue = $this->RESULT_TYPE->CurrentValue;
        $this->RESULT_TYPE->ViewValue = FormatNumber($this->RESULT_TYPE->ViewValue, 0, -2, -2, -2);
        $this->RESULT_TYPE->ViewCustomAttributes = "";

        // MAX_VALUE
        $this->MAX_VALUE->ViewValue = $this->MAX_VALUE->CurrentValue;
        $this->MAX_VALUE->ViewCustomAttributes = "";

        // MIN_VALUE
        $this->MIN_VALUE->ViewValue = $this->MIN_VALUE->CurrentValue;
        $this->MIN_VALUE->ViewCustomAttributes = "";

        // NORMAL_ENGLISH
        $this->NORMAL_ENGLISH->ViewValue = $this->NORMAL_ENGLISH->CurrentValue;
        $this->NORMAL_ENGLISH->ViewCustomAttributes = "";

        // DESC_ENGLISH
        $this->DESC_ENGLISH->ViewValue = $this->DESC_ENGLISH->CurrentValue;
        $this->DESC_ENGLISH->ViewCustomAttributes = "";

        // LISS_ID
        $this->LISS_ID->ViewValue = $this->LISS_ID->CurrentValue;
        $this->LISS_ID->ViewCustomAttributes = "";

        // NOTA_NO
        $this->NOTA_NO->ViewValue = $this->NOTA_NO->CurrentValue;
        $this->NOTA_NO->ViewCustomAttributes = "";

        // KUITANSI_ID
        $this->KUITANSI_ID->ViewValue = $this->KUITANSI_ID->CurrentValue;
        $this->KUITANSI_ID->ViewCustomAttributes = "";

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

        // clinic_id_from
        $this->clinic_id_from->ViewValue = $this->clinic_id_from->CurrentValue;
        $this->clinic_id_from->ViewCustomAttributes = "";

        // NOSEP
        $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->ViewCustomAttributes = "";

        // nota_temp
        $this->nota_temp->ViewValue = $this->nota_temp->CurrentValue;
        $this->nota_temp->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // RESULT_ID
        $this->RESULT_ID->LinkCustomAttributes = "";
        $this->RESULT_ID->HrefValue = "";
        $this->RESULT_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // BILL_ID
        $this->BILL_ID->LinkCustomAttributes = "";
        $this->BILL_ID->HrefValue = "";
        $this->BILL_ID->TooltipValue = "";

        // PACKAGE_ID
        $this->PACKAGE_ID->LinkCustomAttributes = "";
        $this->PACKAGE_ID->HrefValue = "";
        $this->PACKAGE_ID->TooltipValue = "";

        // TARIF_ID
        $this->TARIF_ID->LinkCustomAttributes = "";
        $this->TARIF_ID->HrefValue = "";
        $this->TARIF_ID->TooltipValue = "";

        // TARIF_NAME
        $this->TARIF_NAME->LinkCustomAttributes = "";
        $this->TARIF_NAME->HrefValue = "";
        $this->TARIF_NAME->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID_FROM->HrefValue = "";
        $this->EMPLOYEE_ID_FROM->TooltipValue = "";

        // PICKUP_DATE
        $this->PICKUP_DATE->LinkCustomAttributes = "";
        $this->PICKUP_DATE->HrefValue = "";
        $this->PICKUP_DATE->TooltipValue = "";

        // REAGENT_ID
        $this->REAGENT_ID->LinkCustomAttributes = "";
        $this->REAGENT_ID->HrefValue = "";
        $this->REAGENT_ID->TooltipValue = "";

        // SPECIMEN_ID
        $this->SPECIMEN_ID->LinkCustomAttributes = "";
        $this->SPECIMEN_ID->HrefValue = "";
        $this->SPECIMEN_ID->TooltipValue = "";

        // METHOD_ID
        $this->METHOD_ID->LinkCustomAttributes = "";
        $this->METHOD_ID->HrefValue = "";
        $this->METHOD_ID->TooltipValue = "";

        // CONCLUSION
        $this->CONCLUSION->LinkCustomAttributes = "";
        $this->CONCLUSION->HrefValue = "";
        $this->CONCLUSION->TooltipValue = "";

        // RESULT_VALUE
        $this->RESULT_VALUE->LinkCustomAttributes = "";
        $this->RESULT_VALUE->HrefValue = "";
        $this->RESULT_VALUE->TooltipValue = "";

        // RESULT_ENGLISH
        $this->RESULT_ENGLISH->LinkCustomAttributes = "";
        $this->RESULT_ENGLISH->HrefValue = "";
        $this->RESULT_ENGLISH->TooltipValue = "";

        // NORMAL_VALUE
        $this->NORMAL_VALUE->LinkCustomAttributes = "";
        $this->NORMAL_VALUE->HrefValue = "";
        $this->NORMAL_VALUE->TooltipValue = "";

        // CONVERSION
        $this->CONVERSION->LinkCustomAttributes = "";
        $this->CONVERSION->HrefValue = "";
        $this->CONVERSION->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // DOCTOR
        $this->DOCTOR->LinkCustomAttributes = "";
        $this->DOCTOR->HrefValue = "";
        $this->DOCTOR->TooltipValue = "";

        // DOCTOR_FROM
        $this->DOCTOR_FROM->LinkCustomAttributes = "";
        $this->DOCTOR_FROM->HrefValue = "";
        $this->DOCTOR_FROM->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // THENAME
        $this->THENAME->LinkCustomAttributes = "";
        $this->THENAME->HrefValue = "";
        $this->THENAME->TooltipValue = "";

        // THEADDRESS
        $this->THEADDRESS->LinkCustomAttributes = "";
        $this->THEADDRESS->HrefValue = "";
        $this->THEADDRESS->TooltipValue = "";

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

        // THEID
        $this->THEID->LinkCustomAttributes = "";
        $this->THEID->HrefValue = "";
        $this->THEID->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // ISRJ
        $this->ISRJ->LinkCustomAttributes = "";
        $this->ISRJ->HrefValue = "";
        $this->ISRJ->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // ISNEW
        $this->ISNEW->LinkCustomAttributes = "";
        $this->ISNEW->HrefValue = "";
        $this->ISNEW->TooltipValue = "";

        // ISNEW_CLINIC
        $this->ISNEW_CLINIC->LinkCustomAttributes = "";
        $this->ISNEW_CLINIC->HrefValue = "";
        $this->ISNEW_CLINIC->TooltipValue = "";

        // VISIT_TRANS
        $this->VISIT_TRANS->LinkCustomAttributes = "";
        $this->VISIT_TRANS->HrefValue = "";
        $this->VISIT_TRANS->TooltipValue = "";

        // REAGENT_NAME
        $this->REAGENT_NAME->LinkCustomAttributes = "";
        $this->REAGENT_NAME->HrefValue = "";
        $this->REAGENT_NAME->TooltipValue = "";

        // BOUND_ID
        $this->BOUND_ID->LinkCustomAttributes = "";
        $this->BOUND_ID->HrefValue = "";
        $this->BOUND_ID->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // MEASURE_ENGLISH
        $this->MEASURE_ENGLISH->LinkCustomAttributes = "";
        $this->MEASURE_ENGLISH->HrefValue = "";
        $this->MEASURE_ENGLISH->TooltipValue = "";

        // SATUAN
        $this->SATUAN->LinkCustomAttributes = "";
        $this->SATUAN->HrefValue = "";
        $this->SATUAN->TooltipValue = "";

        // SATUAN_ENG
        $this->SATUAN_ENG->LinkCustomAttributes = "";
        $this->SATUAN_ENG->HrefValue = "";
        $this->SATUAN_ENG->TooltipValue = "";

        // RESULT_TYPE
        $this->RESULT_TYPE->LinkCustomAttributes = "";
        $this->RESULT_TYPE->HrefValue = "";
        $this->RESULT_TYPE->TooltipValue = "";

        // MAX_VALUE
        $this->MAX_VALUE->LinkCustomAttributes = "";
        $this->MAX_VALUE->HrefValue = "";
        $this->MAX_VALUE->TooltipValue = "";

        // MIN_VALUE
        $this->MIN_VALUE->LinkCustomAttributes = "";
        $this->MIN_VALUE->HrefValue = "";
        $this->MIN_VALUE->TooltipValue = "";

        // NORMAL_ENGLISH
        $this->NORMAL_ENGLISH->LinkCustomAttributes = "";
        $this->NORMAL_ENGLISH->HrefValue = "";
        $this->NORMAL_ENGLISH->TooltipValue = "";

        // DESC_ENGLISH
        $this->DESC_ENGLISH->LinkCustomAttributes = "";
        $this->DESC_ENGLISH->HrefValue = "";
        $this->DESC_ENGLISH->TooltipValue = "";

        // LISS_ID
        $this->LISS_ID->LinkCustomAttributes = "";
        $this->LISS_ID->HrefValue = "";
        $this->LISS_ID->TooltipValue = "";

        // NOTA_NO
        $this->NOTA_NO->LinkCustomAttributes = "";
        $this->NOTA_NO->HrefValue = "";
        $this->NOTA_NO->TooltipValue = "";

        // KUITANSI_ID
        $this->KUITANSI_ID->LinkCustomAttributes = "";
        $this->KUITANSI_ID->HrefValue = "";
        $this->KUITANSI_ID->TooltipValue = "";

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

        // clinic_id_from
        $this->clinic_id_from->LinkCustomAttributes = "";
        $this->clinic_id_from->HrefValue = "";
        $this->clinic_id_from->TooltipValue = "";

        // NOSEP
        $this->NOSEP->LinkCustomAttributes = "";
        $this->NOSEP->HrefValue = "";
        $this->NOSEP->TooltipValue = "";

        // nota_temp
        $this->nota_temp->LinkCustomAttributes = "";
        $this->nota_temp->HrefValue = "";
        $this->nota_temp->TooltipValue = "";

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

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

        // RESULT_ID
        $this->RESULT_ID->EditAttrs["class"] = "form-control";
        $this->RESULT_ID->EditCustomAttributes = "";
        if (!$this->RESULT_ID->Raw) {
            $this->RESULT_ID->CurrentValue = HtmlDecode($this->RESULT_ID->CurrentValue);
        }
        $this->RESULT_ID->EditValue = $this->RESULT_ID->CurrentValue;
        $this->RESULT_ID->PlaceHolder = RemoveHtml($this->RESULT_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // BILL_ID
        $this->BILL_ID->EditAttrs["class"] = "form-control";
        $this->BILL_ID->EditCustomAttributes = "";
        if (!$this->BILL_ID->Raw) {
            $this->BILL_ID->CurrentValue = HtmlDecode($this->BILL_ID->CurrentValue);
        }
        $this->BILL_ID->EditValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->PlaceHolder = RemoveHtml($this->BILL_ID->caption());

        // PACKAGE_ID
        $this->PACKAGE_ID->EditAttrs["class"] = "form-control";
        $this->PACKAGE_ID->EditCustomAttributes = "";
        if (!$this->PACKAGE_ID->Raw) {
            $this->PACKAGE_ID->CurrentValue = HtmlDecode($this->PACKAGE_ID->CurrentValue);
        }
        $this->PACKAGE_ID->EditValue = $this->PACKAGE_ID->CurrentValue;
        $this->PACKAGE_ID->PlaceHolder = RemoveHtml($this->PACKAGE_ID->caption());

        // TARIF_ID
        $this->TARIF_ID->EditAttrs["class"] = "form-control";
        $this->TARIF_ID->EditCustomAttributes = "";
        if (!$this->TARIF_ID->Raw) {
            $this->TARIF_ID->CurrentValue = HtmlDecode($this->TARIF_ID->CurrentValue);
        }
        $this->TARIF_ID->EditValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->PlaceHolder = RemoveHtml($this->TARIF_ID->caption());

        // TARIF_NAME
        $this->TARIF_NAME->EditAttrs["class"] = "form-control";
        $this->TARIF_NAME->EditCustomAttributes = "";
        if (!$this->TARIF_NAME->Raw) {
            $this->TARIF_NAME->CurrentValue = HtmlDecode($this->TARIF_NAME->CurrentValue);
        }
        $this->TARIF_NAME->EditValue = $this->TARIF_NAME->CurrentValue;
        $this->TARIF_NAME->PlaceHolder = RemoveHtml($this->TARIF_NAME->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID_FROM->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID_FROM->Raw) {
            $this->EMPLOYEE_ID_FROM->CurrentValue = HtmlDecode($this->EMPLOYEE_ID_FROM->CurrentValue);
        }
        $this->EMPLOYEE_ID_FROM->EditValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $this->EMPLOYEE_ID_FROM->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID_FROM->caption());

        // PICKUP_DATE
        $this->PICKUP_DATE->EditAttrs["class"] = "form-control";
        $this->PICKUP_DATE->EditCustomAttributes = "";
        $this->PICKUP_DATE->EditValue = FormatDateTime($this->PICKUP_DATE->CurrentValue, 8);
        $this->PICKUP_DATE->PlaceHolder = RemoveHtml($this->PICKUP_DATE->caption());

        // REAGENT_ID
        $this->REAGENT_ID->EditAttrs["class"] = "form-control";
        $this->REAGENT_ID->EditCustomAttributes = "";
        if (!$this->REAGENT_ID->Raw) {
            $this->REAGENT_ID->CurrentValue = HtmlDecode($this->REAGENT_ID->CurrentValue);
        }
        $this->REAGENT_ID->EditValue = $this->REAGENT_ID->CurrentValue;
        $this->REAGENT_ID->PlaceHolder = RemoveHtml($this->REAGENT_ID->caption());

        // SPECIMEN_ID
        $this->SPECIMEN_ID->EditAttrs["class"] = "form-control";
        $this->SPECIMEN_ID->EditCustomAttributes = "";
        if (!$this->SPECIMEN_ID->Raw) {
            $this->SPECIMEN_ID->CurrentValue = HtmlDecode($this->SPECIMEN_ID->CurrentValue);
        }
        $this->SPECIMEN_ID->EditValue = $this->SPECIMEN_ID->CurrentValue;
        $this->SPECIMEN_ID->PlaceHolder = RemoveHtml($this->SPECIMEN_ID->caption());

        // METHOD_ID
        $this->METHOD_ID->EditAttrs["class"] = "form-control";
        $this->METHOD_ID->EditCustomAttributes = "";
        $this->METHOD_ID->EditValue = $this->METHOD_ID->CurrentValue;
        $this->METHOD_ID->PlaceHolder = RemoveHtml($this->METHOD_ID->caption());

        // CONCLUSION
        $this->CONCLUSION->EditAttrs["class"] = "form-control";
        $this->CONCLUSION->EditCustomAttributes = "";
        if (!$this->CONCLUSION->Raw) {
            $this->CONCLUSION->CurrentValue = HtmlDecode($this->CONCLUSION->CurrentValue);
        }
        $this->CONCLUSION->EditValue = $this->CONCLUSION->CurrentValue;
        $this->CONCLUSION->PlaceHolder = RemoveHtml($this->CONCLUSION->caption());

        // RESULT_VALUE
        $this->RESULT_VALUE->EditAttrs["class"] = "form-control";
        $this->RESULT_VALUE->EditCustomAttributes = "";
        if (!$this->RESULT_VALUE->Raw) {
            $this->RESULT_VALUE->CurrentValue = HtmlDecode($this->RESULT_VALUE->CurrentValue);
        }
        $this->RESULT_VALUE->EditValue = $this->RESULT_VALUE->CurrentValue;
        $this->RESULT_VALUE->PlaceHolder = RemoveHtml($this->RESULT_VALUE->caption());

        // RESULT_ENGLISH
        $this->RESULT_ENGLISH->EditAttrs["class"] = "form-control";
        $this->RESULT_ENGLISH->EditCustomAttributes = "";
        if (!$this->RESULT_ENGLISH->Raw) {
            $this->RESULT_ENGLISH->CurrentValue = HtmlDecode($this->RESULT_ENGLISH->CurrentValue);
        }
        $this->RESULT_ENGLISH->EditValue = $this->RESULT_ENGLISH->CurrentValue;
        $this->RESULT_ENGLISH->PlaceHolder = RemoveHtml($this->RESULT_ENGLISH->caption());

        // NORMAL_VALUE
        $this->NORMAL_VALUE->EditAttrs["class"] = "form-control";
        $this->NORMAL_VALUE->EditCustomAttributes = "";
        if (!$this->NORMAL_VALUE->Raw) {
            $this->NORMAL_VALUE->CurrentValue = HtmlDecode($this->NORMAL_VALUE->CurrentValue);
        }
        $this->NORMAL_VALUE->EditValue = $this->NORMAL_VALUE->CurrentValue;
        $this->NORMAL_VALUE->PlaceHolder = RemoveHtml($this->NORMAL_VALUE->caption());

        // CONVERSION
        $this->CONVERSION->EditAttrs["class"] = "form-control";
        $this->CONVERSION->EditCustomAttributes = "";
        $this->CONVERSION->EditValue = $this->CONVERSION->CurrentValue;
        $this->CONVERSION->PlaceHolder = RemoveHtml($this->CONVERSION->caption());
        if (strval($this->CONVERSION->EditValue) != "" && is_numeric($this->CONVERSION->EditValue)) {
            $this->CONVERSION->EditValue = FormatNumber($this->CONVERSION->EditValue, -2, -2, -2, -2);
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

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // DOCTOR
        $this->DOCTOR->EditAttrs["class"] = "form-control";
        $this->DOCTOR->EditCustomAttributes = "";
        if (!$this->DOCTOR->Raw) {
            $this->DOCTOR->CurrentValue = HtmlDecode($this->DOCTOR->CurrentValue);
        }
        $this->DOCTOR->EditValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->PlaceHolder = RemoveHtml($this->DOCTOR->caption());

        // DOCTOR_FROM
        $this->DOCTOR_FROM->EditAttrs["class"] = "form-control";
        $this->DOCTOR_FROM->EditCustomAttributes = "";
        if (!$this->DOCTOR_FROM->Raw) {
            $this->DOCTOR_FROM->CurrentValue = HtmlDecode($this->DOCTOR_FROM->CurrentValue);
        }
        $this->DOCTOR_FROM->EditValue = $this->DOCTOR_FROM->CurrentValue;
        $this->DOCTOR_FROM->PlaceHolder = RemoveHtml($this->DOCTOR_FROM->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

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

        // THEID
        $this->THEID->EditAttrs["class"] = "form-control";
        $this->THEID->EditCustomAttributes = "";
        if (!$this->THEID->Raw) {
            $this->THEID->CurrentValue = HtmlDecode($this->THEID->CurrentValue);
        }
        $this->THEID->EditValue = $this->THEID->CurrentValue;
        $this->THEID->PlaceHolder = RemoveHtml($this->THEID->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        if (!$this->GENDER->Raw) {
            $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
        }
        $this->GENDER->EditValue = $this->GENDER->CurrentValue;
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // ISRJ
        $this->ISRJ->EditAttrs["class"] = "form-control";
        $this->ISRJ->EditCustomAttributes = "";
        if (!$this->ISRJ->Raw) {
            $this->ISRJ->CurrentValue = HtmlDecode($this->ISRJ->CurrentValue);
        }
        $this->ISRJ->EditValue = $this->ISRJ->CurrentValue;
        $this->ISRJ->PlaceHolder = RemoveHtml($this->ISRJ->caption());

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // ISNEW
        $this->ISNEW->EditAttrs["class"] = "form-control";
        $this->ISNEW->EditCustomAttributes = "";
        if (!$this->ISNEW->Raw) {
            $this->ISNEW->CurrentValue = HtmlDecode($this->ISNEW->CurrentValue);
        }
        $this->ISNEW->EditValue = $this->ISNEW->CurrentValue;
        $this->ISNEW->PlaceHolder = RemoveHtml($this->ISNEW->caption());

        // ISNEW_CLINIC
        $this->ISNEW_CLINIC->EditAttrs["class"] = "form-control";
        $this->ISNEW_CLINIC->EditCustomAttributes = "";
        if (!$this->ISNEW_CLINIC->Raw) {
            $this->ISNEW_CLINIC->CurrentValue = HtmlDecode($this->ISNEW_CLINIC->CurrentValue);
        }
        $this->ISNEW_CLINIC->EditValue = $this->ISNEW_CLINIC->CurrentValue;
        $this->ISNEW_CLINIC->PlaceHolder = RemoveHtml($this->ISNEW_CLINIC->caption());

        // VISIT_TRANS
        $this->VISIT_TRANS->EditAttrs["class"] = "form-control";
        $this->VISIT_TRANS->EditCustomAttributes = "";
        if (!$this->VISIT_TRANS->Raw) {
            $this->VISIT_TRANS->CurrentValue = HtmlDecode($this->VISIT_TRANS->CurrentValue);
        }
        $this->VISIT_TRANS->EditValue = $this->VISIT_TRANS->CurrentValue;
        $this->VISIT_TRANS->PlaceHolder = RemoveHtml($this->VISIT_TRANS->caption());

        // REAGENT_NAME
        $this->REAGENT_NAME->EditAttrs["class"] = "form-control";
        $this->REAGENT_NAME->EditCustomAttributes = "";
        if (!$this->REAGENT_NAME->Raw) {
            $this->REAGENT_NAME->CurrentValue = HtmlDecode($this->REAGENT_NAME->CurrentValue);
        }
        $this->REAGENT_NAME->EditValue = $this->REAGENT_NAME->CurrentValue;
        $this->REAGENT_NAME->PlaceHolder = RemoveHtml($this->REAGENT_NAME->caption());

        // BOUND_ID
        $this->BOUND_ID->EditAttrs["class"] = "form-control";
        $this->BOUND_ID->EditCustomAttributes = "";
        if (!$this->BOUND_ID->Raw) {
            $this->BOUND_ID->CurrentValue = HtmlDecode($this->BOUND_ID->CurrentValue);
        }
        $this->BOUND_ID->EditValue = $this->BOUND_ID->CurrentValue;
        $this->BOUND_ID->PlaceHolder = RemoveHtml($this->BOUND_ID->caption());

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // MEASURE_ENGLISH
        $this->MEASURE_ENGLISH->EditAttrs["class"] = "form-control";
        $this->MEASURE_ENGLISH->EditCustomAttributes = "";
        $this->MEASURE_ENGLISH->EditValue = $this->MEASURE_ENGLISH->CurrentValue;
        $this->MEASURE_ENGLISH->PlaceHolder = RemoveHtml($this->MEASURE_ENGLISH->caption());

        // SATUAN
        $this->SATUAN->EditAttrs["class"] = "form-control";
        $this->SATUAN->EditCustomAttributes = "";
        if (!$this->SATUAN->Raw) {
            $this->SATUAN->CurrentValue = HtmlDecode($this->SATUAN->CurrentValue);
        }
        $this->SATUAN->EditValue = $this->SATUAN->CurrentValue;
        $this->SATUAN->PlaceHolder = RemoveHtml($this->SATUAN->caption());

        // SATUAN_ENG
        $this->SATUAN_ENG->EditAttrs["class"] = "form-control";
        $this->SATUAN_ENG->EditCustomAttributes = "";
        if (!$this->SATUAN_ENG->Raw) {
            $this->SATUAN_ENG->CurrentValue = HtmlDecode($this->SATUAN_ENG->CurrentValue);
        }
        $this->SATUAN_ENG->EditValue = $this->SATUAN_ENG->CurrentValue;
        $this->SATUAN_ENG->PlaceHolder = RemoveHtml($this->SATUAN_ENG->caption());

        // RESULT_TYPE
        $this->RESULT_TYPE->EditAttrs["class"] = "form-control";
        $this->RESULT_TYPE->EditCustomAttributes = "";
        $this->RESULT_TYPE->EditValue = $this->RESULT_TYPE->CurrentValue;
        $this->RESULT_TYPE->PlaceHolder = RemoveHtml($this->RESULT_TYPE->caption());

        // MAX_VALUE
        $this->MAX_VALUE->EditAttrs["class"] = "form-control";
        $this->MAX_VALUE->EditCustomAttributes = "";
        if (!$this->MAX_VALUE->Raw) {
            $this->MAX_VALUE->CurrentValue = HtmlDecode($this->MAX_VALUE->CurrentValue);
        }
        $this->MAX_VALUE->EditValue = $this->MAX_VALUE->CurrentValue;
        $this->MAX_VALUE->PlaceHolder = RemoveHtml($this->MAX_VALUE->caption());

        // MIN_VALUE
        $this->MIN_VALUE->EditAttrs["class"] = "form-control";
        $this->MIN_VALUE->EditCustomAttributes = "";
        if (!$this->MIN_VALUE->Raw) {
            $this->MIN_VALUE->CurrentValue = HtmlDecode($this->MIN_VALUE->CurrentValue);
        }
        $this->MIN_VALUE->EditValue = $this->MIN_VALUE->CurrentValue;
        $this->MIN_VALUE->PlaceHolder = RemoveHtml($this->MIN_VALUE->caption());

        // NORMAL_ENGLISH
        $this->NORMAL_ENGLISH->EditAttrs["class"] = "form-control";
        $this->NORMAL_ENGLISH->EditCustomAttributes = "";
        if (!$this->NORMAL_ENGLISH->Raw) {
            $this->NORMAL_ENGLISH->CurrentValue = HtmlDecode($this->NORMAL_ENGLISH->CurrentValue);
        }
        $this->NORMAL_ENGLISH->EditValue = $this->NORMAL_ENGLISH->CurrentValue;
        $this->NORMAL_ENGLISH->PlaceHolder = RemoveHtml($this->NORMAL_ENGLISH->caption());

        // DESC_ENGLISH
        $this->DESC_ENGLISH->EditAttrs["class"] = "form-control";
        $this->DESC_ENGLISH->EditCustomAttributes = "";
        if (!$this->DESC_ENGLISH->Raw) {
            $this->DESC_ENGLISH->CurrentValue = HtmlDecode($this->DESC_ENGLISH->CurrentValue);
        }
        $this->DESC_ENGLISH->EditValue = $this->DESC_ENGLISH->CurrentValue;
        $this->DESC_ENGLISH->PlaceHolder = RemoveHtml($this->DESC_ENGLISH->caption());

        // LISS_ID
        $this->LISS_ID->EditAttrs["class"] = "form-control";
        $this->LISS_ID->EditCustomAttributes = "";
        if (!$this->LISS_ID->Raw) {
            $this->LISS_ID->CurrentValue = HtmlDecode($this->LISS_ID->CurrentValue);
        }
        $this->LISS_ID->EditValue = $this->LISS_ID->CurrentValue;
        $this->LISS_ID->PlaceHolder = RemoveHtml($this->LISS_ID->caption());

        // NOTA_NO
        $this->NOTA_NO->EditAttrs["class"] = "form-control";
        $this->NOTA_NO->EditCustomAttributes = "";
        if (!$this->NOTA_NO->Raw) {
            $this->NOTA_NO->CurrentValue = HtmlDecode($this->NOTA_NO->CurrentValue);
        }
        $this->NOTA_NO->EditValue = $this->NOTA_NO->CurrentValue;
        $this->NOTA_NO->PlaceHolder = RemoveHtml($this->NOTA_NO->caption());

        // KUITANSI_ID
        $this->KUITANSI_ID->EditAttrs["class"] = "form-control";
        $this->KUITANSI_ID->EditCustomAttributes = "";
        if (!$this->KUITANSI_ID->Raw) {
            $this->KUITANSI_ID->CurrentValue = HtmlDecode($this->KUITANSI_ID->CurrentValue);
        }
        $this->KUITANSI_ID->EditValue = $this->KUITANSI_ID->CurrentValue;
        $this->KUITANSI_ID->PlaceHolder = RemoveHtml($this->KUITANSI_ID->caption());

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

        // clinic_id_from
        $this->clinic_id_from->EditAttrs["class"] = "form-control";
        $this->clinic_id_from->EditCustomAttributes = "";
        if (!$this->clinic_id_from->Raw) {
            $this->clinic_id_from->CurrentValue = HtmlDecode($this->clinic_id_from->CurrentValue);
        }
        $this->clinic_id_from->EditValue = $this->clinic_id_from->CurrentValue;
        $this->clinic_id_from->PlaceHolder = RemoveHtml($this->clinic_id_from->caption());

        // NOSEP
        $this->NOSEP->EditAttrs["class"] = "form-control";
        $this->NOSEP->EditCustomAttributes = "";
        if (!$this->NOSEP->Raw) {
            $this->NOSEP->CurrentValue = HtmlDecode($this->NOSEP->CurrentValue);
        }
        $this->NOSEP->EditValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->PlaceHolder = RemoveHtml($this->NOSEP->caption());

        // nota_temp
        $this->nota_temp->EditAttrs["class"] = "form-control";
        $this->nota_temp->EditCustomAttributes = "";
        if (!$this->nota_temp->Raw) {
            $this->nota_temp->CurrentValue = HtmlDecode($this->nota_temp->CurrentValue);
        }
        $this->nota_temp->EditValue = $this->nota_temp->CurrentValue;
        $this->nota_temp->PlaceHolder = RemoveHtml($this->nota_temp->caption());

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
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->RESULT_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->PACKAGE_ID);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->TARIF_NAME);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID_FROM);
                    $doc->exportCaption($this->PICKUP_DATE);
                    $doc->exportCaption($this->REAGENT_ID);
                    $doc->exportCaption($this->SPECIMEN_ID);
                    $doc->exportCaption($this->METHOD_ID);
                    $doc->exportCaption($this->CONCLUSION);
                    $doc->exportCaption($this->RESULT_VALUE);
                    $doc->exportCaption($this->RESULT_ENGLISH);
                    $doc->exportCaption($this->NORMAL_VALUE);
                    $doc->exportCaption($this->CONVERSION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->DOCTOR_FROM);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->ISNEW);
                    $doc->exportCaption($this->ISNEW_CLINIC);
                    $doc->exportCaption($this->VISIT_TRANS);
                    $doc->exportCaption($this->REAGENT_NAME);
                    $doc->exportCaption($this->BOUND_ID);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->MEASURE_ENGLISH);
                    $doc->exportCaption($this->SATUAN);
                    $doc->exportCaption($this->SATUAN_ENG);
                    $doc->exportCaption($this->RESULT_TYPE);
                    $doc->exportCaption($this->MAX_VALUE);
                    $doc->exportCaption($this->MIN_VALUE);
                    $doc->exportCaption($this->NORMAL_ENGLISH);
                    $doc->exportCaption($this->DESC_ENGLISH);
                    $doc->exportCaption($this->LISS_ID);
                    $doc->exportCaption($this->NOTA_NO);
                    $doc->exportCaption($this->KUITANSI_ID);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->clinic_id_from);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->nota_temp);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->RESULT_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->PACKAGE_ID);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->TARIF_NAME);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID_FROM);
                    $doc->exportCaption($this->PICKUP_DATE);
                    $doc->exportCaption($this->REAGENT_ID);
                    $doc->exportCaption($this->SPECIMEN_ID);
                    $doc->exportCaption($this->METHOD_ID);
                    $doc->exportCaption($this->CONCLUSION);
                    $doc->exportCaption($this->RESULT_VALUE);
                    $doc->exportCaption($this->RESULT_ENGLISH);
                    $doc->exportCaption($this->NORMAL_VALUE);
                    $doc->exportCaption($this->CONVERSION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->DOCTOR_FROM);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->ISNEW);
                    $doc->exportCaption($this->ISNEW_CLINIC);
                    $doc->exportCaption($this->VISIT_TRANS);
                    $doc->exportCaption($this->REAGENT_NAME);
                    $doc->exportCaption($this->BOUND_ID);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->MEASURE_ENGLISH);
                    $doc->exportCaption($this->SATUAN);
                    $doc->exportCaption($this->SATUAN_ENG);
                    $doc->exportCaption($this->RESULT_TYPE);
                    $doc->exportCaption($this->MAX_VALUE);
                    $doc->exportCaption($this->MIN_VALUE);
                    $doc->exportCaption($this->NORMAL_ENGLISH);
                    $doc->exportCaption($this->DESC_ENGLISH);
                    $doc->exportCaption($this->LISS_ID);
                    $doc->exportCaption($this->NOTA_NO);
                    $doc->exportCaption($this->KUITANSI_ID);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->clinic_id_from);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->nota_temp);
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
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->RESULT_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->PACKAGE_ID);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->TARIF_NAME);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->EMPLOYEE_ID_FROM);
                        $doc->exportField($this->PICKUP_DATE);
                        $doc->exportField($this->REAGENT_ID);
                        $doc->exportField($this->SPECIMEN_ID);
                        $doc->exportField($this->METHOD_ID);
                        $doc->exportField($this->CONCLUSION);
                        $doc->exportField($this->RESULT_VALUE);
                        $doc->exportField($this->RESULT_ENGLISH);
                        $doc->exportField($this->NORMAL_VALUE);
                        $doc->exportField($this->CONVERSION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->DOCTOR_FROM);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->ISNEW);
                        $doc->exportField($this->ISNEW_CLINIC);
                        $doc->exportField($this->VISIT_TRANS);
                        $doc->exportField($this->REAGENT_NAME);
                        $doc->exportField($this->BOUND_ID);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->MEASURE_ENGLISH);
                        $doc->exportField($this->SATUAN);
                        $doc->exportField($this->SATUAN_ENG);
                        $doc->exportField($this->RESULT_TYPE);
                        $doc->exportField($this->MAX_VALUE);
                        $doc->exportField($this->MIN_VALUE);
                        $doc->exportField($this->NORMAL_ENGLISH);
                        $doc->exportField($this->DESC_ENGLISH);
                        $doc->exportField($this->LISS_ID);
                        $doc->exportField($this->NOTA_NO);
                        $doc->exportField($this->KUITANSI_ID);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->clinic_id_from);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->nota_temp);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->RESULT_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->PACKAGE_ID);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->TARIF_NAME);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->EMPLOYEE_ID_FROM);
                        $doc->exportField($this->PICKUP_DATE);
                        $doc->exportField($this->REAGENT_ID);
                        $doc->exportField($this->SPECIMEN_ID);
                        $doc->exportField($this->METHOD_ID);
                        $doc->exportField($this->CONCLUSION);
                        $doc->exportField($this->RESULT_VALUE);
                        $doc->exportField($this->RESULT_ENGLISH);
                        $doc->exportField($this->NORMAL_VALUE);
                        $doc->exportField($this->CONVERSION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->DOCTOR_FROM);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->ISNEW);
                        $doc->exportField($this->ISNEW_CLINIC);
                        $doc->exportField($this->VISIT_TRANS);
                        $doc->exportField($this->REAGENT_NAME);
                        $doc->exportField($this->BOUND_ID);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->MEASURE_ENGLISH);
                        $doc->exportField($this->SATUAN);
                        $doc->exportField($this->SATUAN_ENG);
                        $doc->exportField($this->RESULT_TYPE);
                        $doc->exportField($this->MAX_VALUE);
                        $doc->exportField($this->MIN_VALUE);
                        $doc->exportField($this->NORMAL_ENGLISH);
                        $doc->exportField($this->DESC_ENGLISH);
                        $doc->exportField($this->LISS_ID);
                        $doc->exportField($this->NOTA_NO);
                        $doc->exportField($this->KUITANSI_ID);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->clinic_id_from);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->nota_temp);
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
