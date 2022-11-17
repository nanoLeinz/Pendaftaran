<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for EXAMINATION_INFO
 */
class ExaminationInfo extends DbTable
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
    public $BODY_ID;
    public $ORG_UNIT_CODE;
    public $PASIEN_DIAGNOSA_ID;
    public $DIAGNOSA_ID;
    public $NO_REGISTRATION;
    public $VISIT_ID;
    public $BILL_ID;
    public $CLINIC_ID;
    public $CLASS_ROOM_ID;
    public $BED_ID;
    public $IN_DATE;
    public $EXIT_DATE;
    public $KELUAR_ID;
    public $EXAMINATION_DATE;
    public $TEMPERATURE;
    public $TENSION_UPPER;
    public $TENSION_BELOW;
    public $NADI;
    public $NAFAS;
    public $WEIGHT;
    public $HEIGHT;
    public $ARM_DIAMETER;
    public $ANAMNASE;
    public $PEMERIKSAAN;
    public $TERAPHY_DESC;
    public $INSTRUCTION;
    public $MEDICAL_TREATMENT;
    public $EMPLOYEE_ID;
    public $DESCRIPTION;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $STATUS_PASIEN_ID;
    public $AGEYEAR;
    public $AGEMONTH;
    public $AGEDAY;
    public $THENAME;
    public $THEADDRESS;
    public $THEID;
    public $ISRJ;
    public $GENDER;
    public $DOCTOR;
    public $KAL_ID;
    public $PETUGAS_ID;
    public $PETUGAS;
    public $ACCOUNT_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'EXAMINATION_INFO';
        $this->TableName = 'EXAMINATION_INFO';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[EXAMINATION_INFO]";
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

        // BODY_ID
        $this->BODY_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_BODY_ID', 'BODY_ID', '[BODY_ID]', '[BODY_ID]', 200, 50, -1, false, '[BODY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BODY_ID->IsPrimaryKey = true; // Primary key field
        $this->BODY_ID->Nullable = false; // NOT NULL field
        $this->BODY_ID->Required = true; // Required field
        $this->BODY_ID->Sortable = true; // Allow sort
        $this->BODY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BODY_ID->Param, "CustomMsg");
        $this->Fields['BODY_ID'] = &$this->BODY_ID;

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_PASIEN_DIAGNOSA_ID', 'PASIEN_DIAGNOSA_ID', '[PASIEN_DIAGNOSA_ID]', '[PASIEN_DIAGNOSA_ID]', 200, 50, -1, false, '[PASIEN_DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->PASIEN_DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['PASIEN_DIAGNOSA_ID'] = &$this->PASIEN_DIAGNOSA_ID;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 50, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Nullable = false; // NOT NULL field
        $this->VISIT_ID->Required = true; // Required field
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // BILL_ID
        $this->BILL_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_BILL_ID', 'BILL_ID', '[BILL_ID]', '[BILL_ID]', 200, 50, -1, false, '[BILL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_ID->Sortable = true; // Allow sort
        $this->BILL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_ID->Param, "CustomMsg");
        $this->Fields['BILL_ID'] = &$this->BILL_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 16, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // BED_ID
        $this->BED_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = true; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // IN_DATE
        $this->IN_DATE = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_IN_DATE', 'IN_DATE', '[IN_DATE]', CastDateFieldForLike("[IN_DATE]", 0, "DB"), 135, 8, 0, false, '[IN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IN_DATE->Sortable = true; // Allow sort
        $this->IN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->IN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IN_DATE->Param, "CustomMsg");
        $this->Fields['IN_DATE'] = &$this->IN_DATE;

        // EXIT_DATE
        $this->EXIT_DATE = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_EXIT_DATE', 'EXIT_DATE', '[EXIT_DATE]', CastDateFieldForLike("[EXIT_DATE]", 0, "DB"), 135, 8, 0, false, '[EXIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXIT_DATE->Sortable = true; // Allow sort
        $this->EXIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXIT_DATE->Param, "CustomMsg");
        $this->Fields['EXIT_DATE'] = &$this->EXIT_DATE;

        // KELUAR_ID
        $this->KELUAR_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELUAR_ID->Sortable = true; // Allow sort
        $this->KELUAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KELUAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELUAR_ID->Param, "CustomMsg");
        $this->Fields['KELUAR_ID'] = &$this->KELUAR_ID;

        // EXAMINATION_DATE
        $this->EXAMINATION_DATE = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_EXAMINATION_DATE', 'EXAMINATION_DATE', '[EXAMINATION_DATE]', CastDateFieldForLike("[EXAMINATION_DATE]", 0, "DB"), 135, 8, 0, false, '[EXAMINATION_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXAMINATION_DATE->Sortable = true; // Allow sort
        $this->EXAMINATION_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXAMINATION_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXAMINATION_DATE->Param, "CustomMsg");
        $this->Fields['EXAMINATION_DATE'] = &$this->EXAMINATION_DATE;

        // TEMPERATURE
        $this->TEMPERATURE = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_TEMPERATURE', 'TEMPERATURE', '[TEMPERATURE]', 'CAST([TEMPERATURE] AS NVARCHAR)', 131, 8, -1, false, '[TEMPERATURE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TEMPERATURE->Sortable = true; // Allow sort
        $this->TEMPERATURE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TEMPERATURE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TEMPERATURE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TEMPERATURE->Param, "CustomMsg");
        $this->Fields['TEMPERATURE'] = &$this->TEMPERATURE;

        // TENSION_UPPER
        $this->TENSION_UPPER = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_TENSION_UPPER', 'TENSION_UPPER', '[TENSION_UPPER]', 'CAST([TENSION_UPPER] AS NVARCHAR)', 131, 8, -1, false, '[TENSION_UPPER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENSION_UPPER->Sortable = true; // Allow sort
        $this->TENSION_UPPER->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TENSION_UPPER->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TENSION_UPPER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENSION_UPPER->Param, "CustomMsg");
        $this->Fields['TENSION_UPPER'] = &$this->TENSION_UPPER;

        // TENSION_BELOW
        $this->TENSION_BELOW = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_TENSION_BELOW', 'TENSION_BELOW', '[TENSION_BELOW]', 'CAST([TENSION_BELOW] AS NVARCHAR)', 131, 8, -1, false, '[TENSION_BELOW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENSION_BELOW->Sortable = true; // Allow sort
        $this->TENSION_BELOW->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TENSION_BELOW->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TENSION_BELOW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENSION_BELOW->Param, "CustomMsg");
        $this->Fields['TENSION_BELOW'] = &$this->TENSION_BELOW;

        // NADI
        $this->NADI = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_NADI', 'NADI', '[NADI]', 'CAST([NADI] AS NVARCHAR)', 131, 8, -1, false, '[NADI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NADI->Sortable = true; // Allow sort
        $this->NADI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NADI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NADI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NADI->Param, "CustomMsg");
        $this->Fields['NADI'] = &$this->NADI;

        // NAFAS
        $this->NAFAS = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_NAFAS', 'NAFAS', '[NAFAS]', 'CAST([NAFAS] AS NVARCHAR)', 131, 8, -1, false, '[NAFAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAFAS->Sortable = true; // Allow sort
        $this->NAFAS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NAFAS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NAFAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAFAS->Param, "CustomMsg");
        $this->Fields['NAFAS'] = &$this->NAFAS;

        // WEIGHT
        $this->WEIGHT = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_WEIGHT', 'WEIGHT', '[WEIGHT]', 'CAST([WEIGHT] AS NVARCHAR)', 131, 8, -1, false, '[WEIGHT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WEIGHT->Sortable = true; // Allow sort
        $this->WEIGHT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->WEIGHT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->WEIGHT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WEIGHT->Param, "CustomMsg");
        $this->Fields['WEIGHT'] = &$this->WEIGHT;

        // HEIGHT
        $this->HEIGHT = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_HEIGHT', 'HEIGHT', '[HEIGHT]', 'CAST([HEIGHT] AS NVARCHAR)', 131, 8, -1, false, '[HEIGHT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HEIGHT->Sortable = true; // Allow sort
        $this->HEIGHT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->HEIGHT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->HEIGHT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HEIGHT->Param, "CustomMsg");
        $this->Fields['HEIGHT'] = &$this->HEIGHT;

        // ARM_DIAMETER
        $this->ARM_DIAMETER = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_ARM_DIAMETER', 'ARM_DIAMETER', '[ARM_DIAMETER]', 'CAST([ARM_DIAMETER] AS NVARCHAR)', 131, 8, -1, false, '[ARM_DIAMETER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ARM_DIAMETER->Sortable = true; // Allow sort
        $this->ARM_DIAMETER->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ARM_DIAMETER->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ARM_DIAMETER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ARM_DIAMETER->Param, "CustomMsg");
        $this->Fields['ARM_DIAMETER'] = &$this->ARM_DIAMETER;

        // ANAMNASE
        $this->ANAMNASE = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_ANAMNASE', 'ANAMNASE', '[ANAMNASE]', '[ANAMNASE]', 200, 200, -1, false, '[ANAMNASE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ANAMNASE->Sortable = true; // Allow sort
        $this->ANAMNASE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ANAMNASE->Param, "CustomMsg");
        $this->Fields['ANAMNASE'] = &$this->ANAMNASE;

        // PEMERIKSAAN
        $this->PEMERIKSAAN = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_PEMERIKSAAN', 'PEMERIKSAAN', '[PEMERIKSAAN]', '[PEMERIKSAAN]', 200, 200, -1, false, '[PEMERIKSAAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEMERIKSAAN->Sortable = true; // Allow sort
        $this->PEMERIKSAAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEMERIKSAAN->Param, "CustomMsg");
        $this->Fields['PEMERIKSAAN'] = &$this->PEMERIKSAAN;

        // TERAPHY_DESC
        $this->TERAPHY_DESC = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_TERAPHY_DESC', 'TERAPHY_DESC', '[TERAPHY_DESC]', '[TERAPHY_DESC]', 200, 200, -1, false, '[TERAPHY_DESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERAPHY_DESC->Sortable = true; // Allow sort
        $this->TERAPHY_DESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERAPHY_DESC->Param, "CustomMsg");
        $this->Fields['TERAPHY_DESC'] = &$this->TERAPHY_DESC;

        // INSTRUCTION
        $this->INSTRUCTION = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_INSTRUCTION', 'INSTRUCTION', '[INSTRUCTION]', '[INSTRUCTION]', 200, 200, -1, false, '[INSTRUCTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INSTRUCTION->Sortable = true; // Allow sort
        $this->INSTRUCTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INSTRUCTION->Param, "CustomMsg");
        $this->Fields['INSTRUCTION'] = &$this->INSTRUCTION;

        // MEDICAL_TREATMENT
        $this->MEDICAL_TREATMENT = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_MEDICAL_TREATMENT', 'MEDICAL_TREATMENT', '[MEDICAL_TREATMENT]', '[MEDICAL_TREATMENT]', 200, 255, -1, false, '[MEDICAL_TREATMENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEDICAL_TREATMENT->Sortable = true; // Allow sort
        $this->MEDICAL_TREATMENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEDICAL_TREATMENT->Param, "CustomMsg");
        $this->Fields['MEDICAL_TREATMENT'] = &$this->MEDICAL_TREATMENT;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 100, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // AGEYEAR
        $this->AGEYEAR = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // THENAME
        $this->THENAME = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // THEADDRESS
        $this->THEADDRESS = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 150, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEID
        $this->THEID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 50, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = true; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->Fields['THEID'] = &$this->THEID;

        // ISRJ
        $this->ISRJ = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // GENDER
        $this->GENDER = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // DOCTOR
        $this->DOCTOR = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_DOCTOR', 'DOCTOR', '[DOCTOR]', '[DOCTOR]', 200, 150, -1, false, '[DOCTOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR->Sortable = true; // Allow sort
        $this->DOCTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR->Param, "CustomMsg");
        $this->Fields['DOCTOR'] = &$this->DOCTOR;

        // KAL_ID
        $this->KAL_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // PETUGAS_ID
        $this->PETUGAS_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_PETUGAS_ID', 'PETUGAS_ID', '[PETUGAS_ID]', '[PETUGAS_ID]', 200, 50, -1, false, '[PETUGAS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PETUGAS_ID->Sortable = true; // Allow sort
        $this->PETUGAS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PETUGAS_ID->Param, "CustomMsg");
        $this->Fields['PETUGAS_ID'] = &$this->PETUGAS_ID;

        // PETUGAS
        $this->PETUGAS = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_PETUGAS', 'PETUGAS', '[PETUGAS]', '[PETUGAS]', 200, 100, -1, false, '[PETUGAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PETUGAS->Sortable = true; // Allow sort
        $this->PETUGAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PETUGAS->Param, "CustomMsg");
        $this->Fields['PETUGAS'] = &$this->PETUGAS;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('EXAMINATION_INFO', 'EXAMINATION_INFO', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[EXAMINATION_INFO]";
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
            if (array_key_exists('BODY_ID', $rs)) {
                AddFilter($where, QuotedName('BODY_ID', $this->Dbid) . '=' . QuotedValue($rs['BODY_ID'], $this->BODY_ID->DataType, $this->Dbid));
            }
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
        $this->BODY_ID->DbValue = $row['BODY_ID'];
        $this->ORG_UNIT_CODE->DbValue = $row['ORG_UNIT_CODE'];
        $this->PASIEN_DIAGNOSA_ID->DbValue = $row['PASIEN_DIAGNOSA_ID'];
        $this->DIAGNOSA_ID->DbValue = $row['DIAGNOSA_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->BILL_ID->DbValue = $row['BILL_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->BED_ID->DbValue = $row['BED_ID'];
        $this->IN_DATE->DbValue = $row['IN_DATE'];
        $this->EXIT_DATE->DbValue = $row['EXIT_DATE'];
        $this->KELUAR_ID->DbValue = $row['KELUAR_ID'];
        $this->EXAMINATION_DATE->DbValue = $row['EXAMINATION_DATE'];
        $this->TEMPERATURE->DbValue = $row['TEMPERATURE'];
        $this->TENSION_UPPER->DbValue = $row['TENSION_UPPER'];
        $this->TENSION_BELOW->DbValue = $row['TENSION_BELOW'];
        $this->NADI->DbValue = $row['NADI'];
        $this->NAFAS->DbValue = $row['NAFAS'];
        $this->WEIGHT->DbValue = $row['WEIGHT'];
        $this->HEIGHT->DbValue = $row['HEIGHT'];
        $this->ARM_DIAMETER->DbValue = $row['ARM_DIAMETER'];
        $this->ANAMNASE->DbValue = $row['ANAMNASE'];
        $this->PEMERIKSAAN->DbValue = $row['PEMERIKSAAN'];
        $this->TERAPHY_DESC->DbValue = $row['TERAPHY_DESC'];
        $this->INSTRUCTION->DbValue = $row['INSTRUCTION'];
        $this->MEDICAL_TREATMENT->DbValue = $row['MEDICAL_TREATMENT'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->AGEYEAR->DbValue = $row['AGEYEAR'];
        $this->AGEMONTH->DbValue = $row['AGEMONTH'];
        $this->AGEDAY->DbValue = $row['AGEDAY'];
        $this->THENAME->DbValue = $row['THENAME'];
        $this->THEADDRESS->DbValue = $row['THEADDRESS'];
        $this->THEID->DbValue = $row['THEID'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->DOCTOR->DbValue = $row['DOCTOR'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->PETUGAS_ID->DbValue = $row['PETUGAS_ID'];
        $this->PETUGAS->DbValue = $row['PETUGAS'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[BODY_ID] = '@BODY_ID@' AND [ORG_UNIT_CODE] = '@ORG_UNIT_CODE@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->BODY_ID->CurrentValue : $this->BODY_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
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
        if (count($keys) == 2) {
            if ($current) {
                $this->BODY_ID->CurrentValue = $keys[0];
            } else {
                $this->BODY_ID->OldValue = $keys[0];
            }
            if ($current) {
                $this->ORG_UNIT_CODE->CurrentValue = $keys[1];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[1];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('BODY_ID', $row) ? $row['BODY_ID'] : null;
        } else {
            $val = $this->BODY_ID->OldValue !== null ? $this->BODY_ID->OldValue : $this->BODY_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@BODY_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
        return $_SESSION[$name] ?? GetUrl("ExaminationInfoList");
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
        if ($pageName == "ExaminationInfoView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ExaminationInfoEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ExaminationInfoAdd") {
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
                return "ExaminationInfoView";
            case Config("API_ADD_ACTION"):
                return "ExaminationInfoAdd";
            case Config("API_EDIT_ACTION"):
                return "ExaminationInfoEdit";
            case Config("API_DELETE_ACTION"):
                return "ExaminationInfoDelete";
            case Config("API_LIST_ACTION"):
                return "ExaminationInfoList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ExaminationInfoList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ExaminationInfoView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ExaminationInfoView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ExaminationInfoAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ExaminationInfoAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ExaminationInfoEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ExaminationInfoAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ExaminationInfoDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "BODY_ID:" . JsonEncode($this->BODY_ID->CurrentValue, "string");
        $json .= ",ORG_UNIT_CODE:" . JsonEncode($this->ORG_UNIT_CODE->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->BODY_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BODY_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
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
            for ($i = 0; $i < $cnt; $i++) {
                $arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
            }
        } else {
            if (($keyValue = Param("BODY_ID") ?? Route("BODY_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
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
                $this->BODY_ID->CurrentValue = $key[0];
            } else {
                $this->BODY_ID->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->ORG_UNIT_CODE->CurrentValue = $key[1];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $key[1];
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
        $this->BODY_ID->setDbValue($row['BODY_ID']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->PASIEN_DIAGNOSA_ID->setDbValue($row['PASIEN_DIAGNOSA_ID']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->IN_DATE->setDbValue($row['IN_DATE']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->EXAMINATION_DATE->setDbValue($row['EXAMINATION_DATE']);
        $this->TEMPERATURE->setDbValue($row['TEMPERATURE']);
        $this->TENSION_UPPER->setDbValue($row['TENSION_UPPER']);
        $this->TENSION_BELOW->setDbValue($row['TENSION_BELOW']);
        $this->NADI->setDbValue($row['NADI']);
        $this->NAFAS->setDbValue($row['NAFAS']);
        $this->WEIGHT->setDbValue($row['WEIGHT']);
        $this->HEIGHT->setDbValue($row['HEIGHT']);
        $this->ARM_DIAMETER->setDbValue($row['ARM_DIAMETER']);
        $this->ANAMNASE->setDbValue($row['ANAMNASE']);
        $this->PEMERIKSAAN->setDbValue($row['PEMERIKSAAN']);
        $this->TERAPHY_DESC->setDbValue($row['TERAPHY_DESC']);
        $this->INSTRUCTION->setDbValue($row['INSTRUCTION']);
        $this->MEDICAL_TREATMENT->setDbValue($row['MEDICAL_TREATMENT']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEID->setDbValue($row['THEID']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->PETUGAS_ID->setDbValue($row['PETUGAS_ID']);
        $this->PETUGAS->setDbValue($row['PETUGAS']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // BODY_ID

        // ORG_UNIT_CODE

        // PASIEN_DIAGNOSA_ID

        // DIAGNOSA_ID

        // NO_REGISTRATION

        // VISIT_ID

        // BILL_ID

        // CLINIC_ID

        // CLASS_ROOM_ID

        // BED_ID

        // IN_DATE

        // EXIT_DATE

        // KELUAR_ID

        // EXAMINATION_DATE

        // TEMPERATURE

        // TENSION_UPPER

        // TENSION_BELOW

        // NADI

        // NAFAS

        // WEIGHT

        // HEIGHT

        // ARM_DIAMETER

        // ANAMNASE

        // PEMERIKSAAN

        // TERAPHY_DESC

        // INSTRUCTION

        // MEDICAL_TREATMENT

        // EMPLOYEE_ID

        // DESCRIPTION

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // STATUS_PASIEN_ID

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // THENAME

        // THEADDRESS

        // THEID

        // ISRJ

        // GENDER

        // DOCTOR

        // KAL_ID

        // PETUGAS_ID

        // PETUGAS

        // ACCOUNT_ID

        // BODY_ID
        $this->BODY_ID->ViewValue = $this->BODY_ID->CurrentValue;
        $this->BODY_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->ViewValue = $this->PASIEN_DIAGNOSA_ID->CurrentValue;
        $this->PASIEN_DIAGNOSA_ID->ViewCustomAttributes = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // BILL_ID
        $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

        // BED_ID
        $this->BED_ID->ViewValue = $this->BED_ID->CurrentValue;
        $this->BED_ID->ViewValue = FormatNumber($this->BED_ID->ViewValue, 0, -2, -2, -2);
        $this->BED_ID->ViewCustomAttributes = "";

        // IN_DATE
        $this->IN_DATE->ViewValue = $this->IN_DATE->CurrentValue;
        $this->IN_DATE->ViewValue = FormatDateTime($this->IN_DATE->ViewValue, 0);
        $this->IN_DATE->ViewCustomAttributes = "";

        // EXIT_DATE
        $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
        $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
        $this->EXIT_DATE->ViewCustomAttributes = "";

        // KELUAR_ID
        $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->CurrentValue;
        $this->KELUAR_ID->ViewValue = FormatNumber($this->KELUAR_ID->ViewValue, 0, -2, -2, -2);
        $this->KELUAR_ID->ViewCustomAttributes = "";

        // EXAMINATION_DATE
        $this->EXAMINATION_DATE->ViewValue = $this->EXAMINATION_DATE->CurrentValue;
        $this->EXAMINATION_DATE->ViewValue = FormatDateTime($this->EXAMINATION_DATE->ViewValue, 0);
        $this->EXAMINATION_DATE->ViewCustomAttributes = "";

        // TEMPERATURE
        $this->TEMPERATURE->ViewValue = $this->TEMPERATURE->CurrentValue;
        $this->TEMPERATURE->ViewValue = FormatNumber($this->TEMPERATURE->ViewValue, 2, -2, -2, -2);
        $this->TEMPERATURE->ViewCustomAttributes = "";

        // TENSION_UPPER
        $this->TENSION_UPPER->ViewValue = $this->TENSION_UPPER->CurrentValue;
        $this->TENSION_UPPER->ViewValue = FormatNumber($this->TENSION_UPPER->ViewValue, 2, -2, -2, -2);
        $this->TENSION_UPPER->ViewCustomAttributes = "";

        // TENSION_BELOW
        $this->TENSION_BELOW->ViewValue = $this->TENSION_BELOW->CurrentValue;
        $this->TENSION_BELOW->ViewValue = FormatNumber($this->TENSION_BELOW->ViewValue, 2, -2, -2, -2);
        $this->TENSION_BELOW->ViewCustomAttributes = "";

        // NADI
        $this->NADI->ViewValue = $this->NADI->CurrentValue;
        $this->NADI->ViewValue = FormatNumber($this->NADI->ViewValue, 2, -2, -2, -2);
        $this->NADI->ViewCustomAttributes = "";

        // NAFAS
        $this->NAFAS->ViewValue = $this->NAFAS->CurrentValue;
        $this->NAFAS->ViewValue = FormatNumber($this->NAFAS->ViewValue, 2, -2, -2, -2);
        $this->NAFAS->ViewCustomAttributes = "";

        // WEIGHT
        $this->WEIGHT->ViewValue = $this->WEIGHT->CurrentValue;
        $this->WEIGHT->ViewValue = FormatNumber($this->WEIGHT->ViewValue, 2, -2, -2, -2);
        $this->WEIGHT->ViewCustomAttributes = "";

        // HEIGHT
        $this->HEIGHT->ViewValue = $this->HEIGHT->CurrentValue;
        $this->HEIGHT->ViewValue = FormatNumber($this->HEIGHT->ViewValue, 2, -2, -2, -2);
        $this->HEIGHT->ViewCustomAttributes = "";

        // ARM_DIAMETER
        $this->ARM_DIAMETER->ViewValue = $this->ARM_DIAMETER->CurrentValue;
        $this->ARM_DIAMETER->ViewValue = FormatNumber($this->ARM_DIAMETER->ViewValue, 2, -2, -2, -2);
        $this->ARM_DIAMETER->ViewCustomAttributes = "";

        // ANAMNASE
        $this->ANAMNASE->ViewValue = $this->ANAMNASE->CurrentValue;
        $this->ANAMNASE->ViewCustomAttributes = "";

        // PEMERIKSAAN
        $this->PEMERIKSAAN->ViewValue = $this->PEMERIKSAAN->CurrentValue;
        $this->PEMERIKSAAN->ViewCustomAttributes = "";

        // TERAPHY_DESC
        $this->TERAPHY_DESC->ViewValue = $this->TERAPHY_DESC->CurrentValue;
        $this->TERAPHY_DESC->ViewCustomAttributes = "";

        // INSTRUCTION
        $this->INSTRUCTION->ViewValue = $this->INSTRUCTION->CurrentValue;
        $this->INSTRUCTION->ViewCustomAttributes = "";

        // MEDICAL_TREATMENT
        $this->MEDICAL_TREATMENT->ViewValue = $this->MEDICAL_TREATMENT->CurrentValue;
        $this->MEDICAL_TREATMENT->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

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

        // MODIFIED_FROM
        $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

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

        // THENAME
        $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
        $this->THENAME->ViewCustomAttributes = "";

        // THEADDRESS
        $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
        $this->THEADDRESS->ViewCustomAttributes = "";

        // THEID
        $this->THEID->ViewValue = $this->THEID->CurrentValue;
        $this->THEID->ViewCustomAttributes = "";

        // ISRJ
        $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
        $this->ISRJ->ViewCustomAttributes = "";

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

        // DOCTOR
        $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // PETUGAS_ID
        $this->PETUGAS_ID->ViewValue = $this->PETUGAS_ID->CurrentValue;
        $this->PETUGAS_ID->ViewCustomAttributes = "";

        // PETUGAS
        $this->PETUGAS->ViewValue = $this->PETUGAS->CurrentValue;
        $this->PETUGAS->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // BODY_ID
        $this->BODY_ID->LinkCustomAttributes = "";
        $this->BODY_ID->HrefValue = "";
        $this->BODY_ID->TooltipValue = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->PASIEN_DIAGNOSA_ID->HrefValue = "";
        $this->PASIEN_DIAGNOSA_ID->TooltipValue = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID->HrefValue = "";
        $this->DIAGNOSA_ID->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // BILL_ID
        $this->BILL_ID->LinkCustomAttributes = "";
        $this->BILL_ID->HrefValue = "";
        $this->BILL_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
        $this->CLASS_ROOM_ID->HrefValue = "";
        $this->CLASS_ROOM_ID->TooltipValue = "";

        // BED_ID
        $this->BED_ID->LinkCustomAttributes = "";
        $this->BED_ID->HrefValue = "";
        $this->BED_ID->TooltipValue = "";

        // IN_DATE
        $this->IN_DATE->LinkCustomAttributes = "";
        $this->IN_DATE->HrefValue = "";
        $this->IN_DATE->TooltipValue = "";

        // EXIT_DATE
        $this->EXIT_DATE->LinkCustomAttributes = "";
        $this->EXIT_DATE->HrefValue = "";
        $this->EXIT_DATE->TooltipValue = "";

        // KELUAR_ID
        $this->KELUAR_ID->LinkCustomAttributes = "";
        $this->KELUAR_ID->HrefValue = "";
        $this->KELUAR_ID->TooltipValue = "";

        // EXAMINATION_DATE
        $this->EXAMINATION_DATE->LinkCustomAttributes = "";
        $this->EXAMINATION_DATE->HrefValue = "";
        $this->EXAMINATION_DATE->TooltipValue = "";

        // TEMPERATURE
        $this->TEMPERATURE->LinkCustomAttributes = "";
        $this->TEMPERATURE->HrefValue = "";
        $this->TEMPERATURE->TooltipValue = "";

        // TENSION_UPPER
        $this->TENSION_UPPER->LinkCustomAttributes = "";
        $this->TENSION_UPPER->HrefValue = "";
        $this->TENSION_UPPER->TooltipValue = "";

        // TENSION_BELOW
        $this->TENSION_BELOW->LinkCustomAttributes = "";
        $this->TENSION_BELOW->HrefValue = "";
        $this->TENSION_BELOW->TooltipValue = "";

        // NADI
        $this->NADI->LinkCustomAttributes = "";
        $this->NADI->HrefValue = "";
        $this->NADI->TooltipValue = "";

        // NAFAS
        $this->NAFAS->LinkCustomAttributes = "";
        $this->NAFAS->HrefValue = "";
        $this->NAFAS->TooltipValue = "";

        // WEIGHT
        $this->WEIGHT->LinkCustomAttributes = "";
        $this->WEIGHT->HrefValue = "";
        $this->WEIGHT->TooltipValue = "";

        // HEIGHT
        $this->HEIGHT->LinkCustomAttributes = "";
        $this->HEIGHT->HrefValue = "";
        $this->HEIGHT->TooltipValue = "";

        // ARM_DIAMETER
        $this->ARM_DIAMETER->LinkCustomAttributes = "";
        $this->ARM_DIAMETER->HrefValue = "";
        $this->ARM_DIAMETER->TooltipValue = "";

        // ANAMNASE
        $this->ANAMNASE->LinkCustomAttributes = "";
        $this->ANAMNASE->HrefValue = "";
        $this->ANAMNASE->TooltipValue = "";

        // PEMERIKSAAN
        $this->PEMERIKSAAN->LinkCustomAttributes = "";
        $this->PEMERIKSAAN->HrefValue = "";
        $this->PEMERIKSAAN->TooltipValue = "";

        // TERAPHY_DESC
        $this->TERAPHY_DESC->LinkCustomAttributes = "";
        $this->TERAPHY_DESC->HrefValue = "";
        $this->TERAPHY_DESC->TooltipValue = "";

        // INSTRUCTION
        $this->INSTRUCTION->LinkCustomAttributes = "";
        $this->INSTRUCTION->HrefValue = "";
        $this->INSTRUCTION->TooltipValue = "";

        // MEDICAL_TREATMENT
        $this->MEDICAL_TREATMENT->LinkCustomAttributes = "";
        $this->MEDICAL_TREATMENT->HrefValue = "";
        $this->MEDICAL_TREATMENT->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

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

        // MODIFIED_FROM
        $this->MODIFIED_FROM->LinkCustomAttributes = "";
        $this->MODIFIED_FROM->HrefValue = "";
        $this->MODIFIED_FROM->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

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

        // ISRJ
        $this->ISRJ->LinkCustomAttributes = "";
        $this->ISRJ->HrefValue = "";
        $this->ISRJ->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // DOCTOR
        $this->DOCTOR->LinkCustomAttributes = "";
        $this->DOCTOR->HrefValue = "";
        $this->DOCTOR->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // PETUGAS_ID
        $this->PETUGAS_ID->LinkCustomAttributes = "";
        $this->PETUGAS_ID->HrefValue = "";
        $this->PETUGAS_ID->TooltipValue = "";

        // PETUGAS
        $this->PETUGAS->LinkCustomAttributes = "";
        $this->PETUGAS->HrefValue = "";
        $this->PETUGAS->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

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

        // BODY_ID
        $this->BODY_ID->EditAttrs["class"] = "form-control";
        $this->BODY_ID->EditCustomAttributes = "";
        if (!$this->BODY_ID->Raw) {
            $this->BODY_ID->CurrentValue = HtmlDecode($this->BODY_ID->CurrentValue);
        }
        $this->BODY_ID->EditValue = $this->BODY_ID->CurrentValue;
        $this->BODY_ID->PlaceHolder = RemoveHtml($this->BODY_ID->caption());

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
        $this->ORG_UNIT_CODE->EditCustomAttributes = "";
        if (!$this->ORG_UNIT_CODE->Raw) {
            $this->ORG_UNIT_CODE->CurrentValue = HtmlDecode($this->ORG_UNIT_CODE->CurrentValue);
        }
        $this->ORG_UNIT_CODE->EditValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->PlaceHolder = RemoveHtml($this->ORG_UNIT_CODE->caption());

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->PASIEN_DIAGNOSA_ID->EditCustomAttributes = "";
        if (!$this->PASIEN_DIAGNOSA_ID->Raw) {
            $this->PASIEN_DIAGNOSA_ID->CurrentValue = HtmlDecode($this->PASIEN_DIAGNOSA_ID->CurrentValue);
        }
        $this->PASIEN_DIAGNOSA_ID->EditValue = $this->PASIEN_DIAGNOSA_ID->CurrentValue;
        $this->PASIEN_DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->PASIEN_DIAGNOSA_ID->caption());

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID->Raw) {
            $this->DIAGNOSA_ID->CurrentValue = HtmlDecode($this->DIAGNOSA_ID->CurrentValue);
        }
        $this->DIAGNOSA_ID->EditValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

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

        // BILL_ID
        $this->BILL_ID->EditAttrs["class"] = "form-control";
        $this->BILL_ID->EditCustomAttributes = "";
        if (!$this->BILL_ID->Raw) {
            $this->BILL_ID->CurrentValue = HtmlDecode($this->BILL_ID->CurrentValue);
        }
        $this->BILL_ID->EditValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->PlaceHolder = RemoveHtml($this->BILL_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ROOM_ID->EditCustomAttributes = "";
        if (!$this->CLASS_ROOM_ID->Raw) {
            $this->CLASS_ROOM_ID->CurrentValue = HtmlDecode($this->CLASS_ROOM_ID->CurrentValue);
        }
        $this->CLASS_ROOM_ID->EditValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

        // BED_ID
        $this->BED_ID->EditAttrs["class"] = "form-control";
        $this->BED_ID->EditCustomAttributes = "";
        $this->BED_ID->EditValue = $this->BED_ID->CurrentValue;
        $this->BED_ID->PlaceHolder = RemoveHtml($this->BED_ID->caption());

        // IN_DATE
        $this->IN_DATE->EditAttrs["class"] = "form-control";
        $this->IN_DATE->EditCustomAttributes = "";
        $this->IN_DATE->EditValue = FormatDateTime($this->IN_DATE->CurrentValue, 8);
        $this->IN_DATE->PlaceHolder = RemoveHtml($this->IN_DATE->caption());

        // EXIT_DATE
        $this->EXIT_DATE->EditAttrs["class"] = "form-control";
        $this->EXIT_DATE->EditCustomAttributes = "";
        $this->EXIT_DATE->EditValue = FormatDateTime($this->EXIT_DATE->CurrentValue, 8);
        $this->EXIT_DATE->PlaceHolder = RemoveHtml($this->EXIT_DATE->caption());

        // KELUAR_ID
        $this->KELUAR_ID->EditAttrs["class"] = "form-control";
        $this->KELUAR_ID->EditCustomAttributes = "";
        $this->KELUAR_ID->EditValue = $this->KELUAR_ID->CurrentValue;
        $this->KELUAR_ID->PlaceHolder = RemoveHtml($this->KELUAR_ID->caption());

        // EXAMINATION_DATE
        $this->EXAMINATION_DATE->EditAttrs["class"] = "form-control";
        $this->EXAMINATION_DATE->EditCustomAttributes = "";
        $this->EXAMINATION_DATE->EditValue = FormatDateTime($this->EXAMINATION_DATE->CurrentValue, 8);
        $this->EXAMINATION_DATE->PlaceHolder = RemoveHtml($this->EXAMINATION_DATE->caption());

        // TEMPERATURE
        $this->TEMPERATURE->EditAttrs["class"] = "form-control";
        $this->TEMPERATURE->EditCustomAttributes = "";
        $this->TEMPERATURE->EditValue = $this->TEMPERATURE->CurrentValue;
        $this->TEMPERATURE->PlaceHolder = RemoveHtml($this->TEMPERATURE->caption());
        if (strval($this->TEMPERATURE->EditValue) != "" && is_numeric($this->TEMPERATURE->EditValue)) {
            $this->TEMPERATURE->EditValue = FormatNumber($this->TEMPERATURE->EditValue, -2, -2, -2, -2);
        }

        // TENSION_UPPER
        $this->TENSION_UPPER->EditAttrs["class"] = "form-control";
        $this->TENSION_UPPER->EditCustomAttributes = "";
        $this->TENSION_UPPER->EditValue = $this->TENSION_UPPER->CurrentValue;
        $this->TENSION_UPPER->PlaceHolder = RemoveHtml($this->TENSION_UPPER->caption());
        if (strval($this->TENSION_UPPER->EditValue) != "" && is_numeric($this->TENSION_UPPER->EditValue)) {
            $this->TENSION_UPPER->EditValue = FormatNumber($this->TENSION_UPPER->EditValue, -2, -2, -2, -2);
        }

        // TENSION_BELOW
        $this->TENSION_BELOW->EditAttrs["class"] = "form-control";
        $this->TENSION_BELOW->EditCustomAttributes = "";
        $this->TENSION_BELOW->EditValue = $this->TENSION_BELOW->CurrentValue;
        $this->TENSION_BELOW->PlaceHolder = RemoveHtml($this->TENSION_BELOW->caption());
        if (strval($this->TENSION_BELOW->EditValue) != "" && is_numeric($this->TENSION_BELOW->EditValue)) {
            $this->TENSION_BELOW->EditValue = FormatNumber($this->TENSION_BELOW->EditValue, -2, -2, -2, -2);
        }

        // NADI
        $this->NADI->EditAttrs["class"] = "form-control";
        $this->NADI->EditCustomAttributes = "";
        $this->NADI->EditValue = $this->NADI->CurrentValue;
        $this->NADI->PlaceHolder = RemoveHtml($this->NADI->caption());
        if (strval($this->NADI->EditValue) != "" && is_numeric($this->NADI->EditValue)) {
            $this->NADI->EditValue = FormatNumber($this->NADI->EditValue, -2, -2, -2, -2);
        }

        // NAFAS
        $this->NAFAS->EditAttrs["class"] = "form-control";
        $this->NAFAS->EditCustomAttributes = "";
        $this->NAFAS->EditValue = $this->NAFAS->CurrentValue;
        $this->NAFAS->PlaceHolder = RemoveHtml($this->NAFAS->caption());
        if (strval($this->NAFAS->EditValue) != "" && is_numeric($this->NAFAS->EditValue)) {
            $this->NAFAS->EditValue = FormatNumber($this->NAFAS->EditValue, -2, -2, -2, -2);
        }

        // WEIGHT
        $this->WEIGHT->EditAttrs["class"] = "form-control";
        $this->WEIGHT->EditCustomAttributes = "";
        $this->WEIGHT->EditValue = $this->WEIGHT->CurrentValue;
        $this->WEIGHT->PlaceHolder = RemoveHtml($this->WEIGHT->caption());
        if (strval($this->WEIGHT->EditValue) != "" && is_numeric($this->WEIGHT->EditValue)) {
            $this->WEIGHT->EditValue = FormatNumber($this->WEIGHT->EditValue, -2, -2, -2, -2);
        }

        // HEIGHT
        $this->HEIGHT->EditAttrs["class"] = "form-control";
        $this->HEIGHT->EditCustomAttributes = "";
        $this->HEIGHT->EditValue = $this->HEIGHT->CurrentValue;
        $this->HEIGHT->PlaceHolder = RemoveHtml($this->HEIGHT->caption());
        if (strval($this->HEIGHT->EditValue) != "" && is_numeric($this->HEIGHT->EditValue)) {
            $this->HEIGHT->EditValue = FormatNumber($this->HEIGHT->EditValue, -2, -2, -2, -2);
        }

        // ARM_DIAMETER
        $this->ARM_DIAMETER->EditAttrs["class"] = "form-control";
        $this->ARM_DIAMETER->EditCustomAttributes = "";
        $this->ARM_DIAMETER->EditValue = $this->ARM_DIAMETER->CurrentValue;
        $this->ARM_DIAMETER->PlaceHolder = RemoveHtml($this->ARM_DIAMETER->caption());
        if (strval($this->ARM_DIAMETER->EditValue) != "" && is_numeric($this->ARM_DIAMETER->EditValue)) {
            $this->ARM_DIAMETER->EditValue = FormatNumber($this->ARM_DIAMETER->EditValue, -2, -2, -2, -2);
        }

        // ANAMNASE
        $this->ANAMNASE->EditAttrs["class"] = "form-control";
        $this->ANAMNASE->EditCustomAttributes = "";
        if (!$this->ANAMNASE->Raw) {
            $this->ANAMNASE->CurrentValue = HtmlDecode($this->ANAMNASE->CurrentValue);
        }
        $this->ANAMNASE->EditValue = $this->ANAMNASE->CurrentValue;
        $this->ANAMNASE->PlaceHolder = RemoveHtml($this->ANAMNASE->caption());

        // PEMERIKSAAN
        $this->PEMERIKSAAN->EditAttrs["class"] = "form-control";
        $this->PEMERIKSAAN->EditCustomAttributes = "";
        if (!$this->PEMERIKSAAN->Raw) {
            $this->PEMERIKSAAN->CurrentValue = HtmlDecode($this->PEMERIKSAAN->CurrentValue);
        }
        $this->PEMERIKSAAN->EditValue = $this->PEMERIKSAAN->CurrentValue;
        $this->PEMERIKSAAN->PlaceHolder = RemoveHtml($this->PEMERIKSAAN->caption());

        // TERAPHY_DESC
        $this->TERAPHY_DESC->EditAttrs["class"] = "form-control";
        $this->TERAPHY_DESC->EditCustomAttributes = "";
        if (!$this->TERAPHY_DESC->Raw) {
            $this->TERAPHY_DESC->CurrentValue = HtmlDecode($this->TERAPHY_DESC->CurrentValue);
        }
        $this->TERAPHY_DESC->EditValue = $this->TERAPHY_DESC->CurrentValue;
        $this->TERAPHY_DESC->PlaceHolder = RemoveHtml($this->TERAPHY_DESC->caption());

        // INSTRUCTION
        $this->INSTRUCTION->EditAttrs["class"] = "form-control";
        $this->INSTRUCTION->EditCustomAttributes = "";
        if (!$this->INSTRUCTION->Raw) {
            $this->INSTRUCTION->CurrentValue = HtmlDecode($this->INSTRUCTION->CurrentValue);
        }
        $this->INSTRUCTION->EditValue = $this->INSTRUCTION->CurrentValue;
        $this->INSTRUCTION->PlaceHolder = RemoveHtml($this->INSTRUCTION->caption());

        // MEDICAL_TREATMENT
        $this->MEDICAL_TREATMENT->EditAttrs["class"] = "form-control";
        $this->MEDICAL_TREATMENT->EditCustomAttributes = "";
        if (!$this->MEDICAL_TREATMENT->Raw) {
            $this->MEDICAL_TREATMENT->CurrentValue = HtmlDecode($this->MEDICAL_TREATMENT->CurrentValue);
        }
        $this->MEDICAL_TREATMENT->EditValue = $this->MEDICAL_TREATMENT->CurrentValue;
        $this->MEDICAL_TREATMENT->PlaceHolder = RemoveHtml($this->MEDICAL_TREATMENT->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

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

        // MODIFIED_FROM
        $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
        $this->MODIFIED_FROM->EditCustomAttributes = "";
        if (!$this->MODIFIED_FROM->Raw) {
            $this->MODIFIED_FROM->CurrentValue = HtmlDecode($this->MODIFIED_FROM->CurrentValue);
        }
        $this->MODIFIED_FROM->EditValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

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

        // ISRJ
        $this->ISRJ->EditAttrs["class"] = "form-control";
        $this->ISRJ->EditCustomAttributes = "";
        if (!$this->ISRJ->Raw) {
            $this->ISRJ->CurrentValue = HtmlDecode($this->ISRJ->CurrentValue);
        }
        $this->ISRJ->EditValue = $this->ISRJ->CurrentValue;
        $this->ISRJ->PlaceHolder = RemoveHtml($this->ISRJ->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        if (!$this->GENDER->Raw) {
            $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
        }
        $this->GENDER->EditValue = $this->GENDER->CurrentValue;
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // DOCTOR
        $this->DOCTOR->EditAttrs["class"] = "form-control";
        $this->DOCTOR->EditCustomAttributes = "";
        if (!$this->DOCTOR->Raw) {
            $this->DOCTOR->CurrentValue = HtmlDecode($this->DOCTOR->CurrentValue);
        }
        $this->DOCTOR->EditValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->PlaceHolder = RemoveHtml($this->DOCTOR->caption());

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // PETUGAS_ID
        $this->PETUGAS_ID->EditAttrs["class"] = "form-control";
        $this->PETUGAS_ID->EditCustomAttributes = "";
        if (!$this->PETUGAS_ID->Raw) {
            $this->PETUGAS_ID->CurrentValue = HtmlDecode($this->PETUGAS_ID->CurrentValue);
        }
        $this->PETUGAS_ID->EditValue = $this->PETUGAS_ID->CurrentValue;
        $this->PETUGAS_ID->PlaceHolder = RemoveHtml($this->PETUGAS_ID->caption());

        // PETUGAS
        $this->PETUGAS->EditAttrs["class"] = "form-control";
        $this->PETUGAS->EditCustomAttributes = "";
        if (!$this->PETUGAS->Raw) {
            $this->PETUGAS->CurrentValue = HtmlDecode($this->PETUGAS->CurrentValue);
        }
        $this->PETUGAS->EditValue = $this->PETUGAS->CurrentValue;
        $this->PETUGAS->PlaceHolder = RemoveHtml($this->PETUGAS->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

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
                    $doc->exportCaption($this->BODY_ID);
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->PASIEN_DIAGNOSA_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->IN_DATE);
                    $doc->exportCaption($this->EXIT_DATE);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->EXAMINATION_DATE);
                    $doc->exportCaption($this->TEMPERATURE);
                    $doc->exportCaption($this->TENSION_UPPER);
                    $doc->exportCaption($this->TENSION_BELOW);
                    $doc->exportCaption($this->NADI);
                    $doc->exportCaption($this->NAFAS);
                    $doc->exportCaption($this->WEIGHT);
                    $doc->exportCaption($this->HEIGHT);
                    $doc->exportCaption($this->ARM_DIAMETER);
                    $doc->exportCaption($this->ANAMNASE);
                    $doc->exportCaption($this->PEMERIKSAAN);
                    $doc->exportCaption($this->TERAPHY_DESC);
                    $doc->exportCaption($this->INSTRUCTION);
                    $doc->exportCaption($this->MEDICAL_TREATMENT);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->PETUGAS_ID);
                    $doc->exportCaption($this->PETUGAS);
                    $doc->exportCaption($this->ACCOUNT_ID);
                } else {
                    $doc->exportCaption($this->BODY_ID);
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->PASIEN_DIAGNOSA_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->IN_DATE);
                    $doc->exportCaption($this->EXIT_DATE);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->EXAMINATION_DATE);
                    $doc->exportCaption($this->TEMPERATURE);
                    $doc->exportCaption($this->TENSION_UPPER);
                    $doc->exportCaption($this->TENSION_BELOW);
                    $doc->exportCaption($this->NADI);
                    $doc->exportCaption($this->NAFAS);
                    $doc->exportCaption($this->WEIGHT);
                    $doc->exportCaption($this->HEIGHT);
                    $doc->exportCaption($this->ARM_DIAMETER);
                    $doc->exportCaption($this->ANAMNASE);
                    $doc->exportCaption($this->PEMERIKSAAN);
                    $doc->exportCaption($this->TERAPHY_DESC);
                    $doc->exportCaption($this->INSTRUCTION);
                    $doc->exportCaption($this->MEDICAL_TREATMENT);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->PETUGAS_ID);
                    $doc->exportCaption($this->PETUGAS);
                    $doc->exportCaption($this->ACCOUNT_ID);
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
                        $doc->exportField($this->BODY_ID);
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->PASIEN_DIAGNOSA_ID);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->IN_DATE);
                        $doc->exportField($this->EXIT_DATE);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->EXAMINATION_DATE);
                        $doc->exportField($this->TEMPERATURE);
                        $doc->exportField($this->TENSION_UPPER);
                        $doc->exportField($this->TENSION_BELOW);
                        $doc->exportField($this->NADI);
                        $doc->exportField($this->NAFAS);
                        $doc->exportField($this->WEIGHT);
                        $doc->exportField($this->HEIGHT);
                        $doc->exportField($this->ARM_DIAMETER);
                        $doc->exportField($this->ANAMNASE);
                        $doc->exportField($this->PEMERIKSAAN);
                        $doc->exportField($this->TERAPHY_DESC);
                        $doc->exportField($this->INSTRUCTION);
                        $doc->exportField($this->MEDICAL_TREATMENT);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->PETUGAS_ID);
                        $doc->exportField($this->PETUGAS);
                        $doc->exportField($this->ACCOUNT_ID);
                    } else {
                        $doc->exportField($this->BODY_ID);
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->PASIEN_DIAGNOSA_ID);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->IN_DATE);
                        $doc->exportField($this->EXIT_DATE);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->EXAMINATION_DATE);
                        $doc->exportField($this->TEMPERATURE);
                        $doc->exportField($this->TENSION_UPPER);
                        $doc->exportField($this->TENSION_BELOW);
                        $doc->exportField($this->NADI);
                        $doc->exportField($this->NAFAS);
                        $doc->exportField($this->WEIGHT);
                        $doc->exportField($this->HEIGHT);
                        $doc->exportField($this->ARM_DIAMETER);
                        $doc->exportField($this->ANAMNASE);
                        $doc->exportField($this->PEMERIKSAAN);
                        $doc->exportField($this->TERAPHY_DESC);
                        $doc->exportField($this->INSTRUCTION);
                        $doc->exportField($this->MEDICAL_TREATMENT);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->PETUGAS_ID);
                        $doc->exportField($this->PETUGAS);
                        $doc->exportField($this->ACCOUNT_ID);
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
