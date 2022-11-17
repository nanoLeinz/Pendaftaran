<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for DEATH
 */
class Death extends DbTable
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
    public $DEATH_ID;
    public $NO_REGISTRATION;
    public $ORIGINALITY;
    public $DIAGNOSA_ID;
    public $BILL_ID;
    public $EMPLOYEE_ID;
    public $DESCRIPTION_ID;
    public $PETUGAS_ID;
    public $DEATH_DATE;
    public $CLASS_ROOM_ID;
    public $BED_ID;
    public $IN_DATE;
    public $EXIT_DATE;
    public $KELUAR_ID;
    public $CLINIC_ID;
    public $DESCRIPTION;
    public $RESPONSIBLE;
    public $RESPONSIBLE_ADDRESS;
    public $KTP_NO;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $VISIT_ID;
    public $THENAME;
    public $THEADDRESS;
    public $THEID;
    public $ISRJ;
    public $AGEYEAR;
    public $AGEMONTH;
    public $AGEDAY;
    public $STATUS_PASIEN_ID;
    public $GENDER;
    public $DOCTOR;
    public $PETUGAS;
    public $KAL_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'DEATH';
        $this->TableName = 'DEATH';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[DEATH]";
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
        $this->ORG_UNIT_CODE = new DbField('DEATH', 'DEATH', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // DEATH_ID
        $this->DEATH_ID = new DbField('DEATH', 'DEATH', 'x_DEATH_ID', 'DEATH_ID', '[DEATH_ID]', '[DEATH_ID]', 200, 50, -1, false, '[DEATH_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DEATH_ID->IsPrimaryKey = true; // Primary key field
        $this->DEATH_ID->Nullable = false; // NOT NULL field
        $this->DEATH_ID->Required = true; // Required field
        $this->DEATH_ID->Sortable = true; // Allow sort
        $this->DEATH_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DEATH_ID->Param, "CustomMsg");
        $this->Fields['DEATH_ID'] = &$this->DEATH_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('DEATH', 'DEATH', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 25, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // ORIGINALITY
        $this->ORIGINALITY = new DbField('DEATH', 'DEATH', 'x_ORIGINALITY', 'ORIGINALITY', '[ORIGINALITY]', '[ORIGINALITY]', 200, 100, -1, false, '[ORIGINALITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORIGINALITY->Sortable = true; // Allow sort
        $this->ORIGINALITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORIGINALITY->Param, "CustomMsg");
        $this->Fields['ORIGINALITY'] = &$this->ORIGINALITY;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new DbField('DEATH', 'DEATH', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 50, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // BILL_ID
        $this->BILL_ID = new DbField('DEATH', 'DEATH', 'x_BILL_ID', 'BILL_ID', '[BILL_ID]', '[BILL_ID]', 200, 50, -1, false, '[BILL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_ID->Sortable = true; // Allow sort
        $this->BILL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_ID->Param, "CustomMsg");
        $this->Fields['BILL_ID'] = &$this->BILL_ID;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('DEATH', 'DEATH', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // DESCRIPTION_ID
        $this->DESCRIPTION_ID = new DbField('DEATH', 'DEATH', 'x_DESCRIPTION_ID', 'DESCRIPTION_ID', '[DESCRIPTION_ID]', '[DESCRIPTION_ID]', 200, 10, -1, false, '[DESCRIPTION_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION_ID->Sortable = true; // Allow sort
        $this->DESCRIPTION_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION_ID->Param, "CustomMsg");
        $this->Fields['DESCRIPTION_ID'] = &$this->DESCRIPTION_ID;

        // PETUGAS_ID
        $this->PETUGAS_ID = new DbField('DEATH', 'DEATH', 'x_PETUGAS_ID', 'PETUGAS_ID', '[PETUGAS_ID]', '[PETUGAS_ID]', 200, 15, -1, false, '[PETUGAS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PETUGAS_ID->Sortable = true; // Allow sort
        $this->PETUGAS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PETUGAS_ID->Param, "CustomMsg");
        $this->Fields['PETUGAS_ID'] = &$this->PETUGAS_ID;

        // DEATH_DATE
        $this->DEATH_DATE = new DbField('DEATH', 'DEATH', 'x_DEATH_DATE', 'DEATH_DATE', '[DEATH_DATE]', CastDateFieldForLike("[DEATH_DATE]", 0, "DB"), 135, 8, 0, false, '[DEATH_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DEATH_DATE->Sortable = true; // Allow sort
        $this->DEATH_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DEATH_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DEATH_DATE->Param, "CustomMsg");
        $this->Fields['DEATH_DATE'] = &$this->DEATH_DATE;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('DEATH', 'DEATH', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 16, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // BED_ID
        $this->BED_ID = new DbField('DEATH', 'DEATH', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = true; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // IN_DATE
        $this->IN_DATE = new DbField('DEATH', 'DEATH', 'x_IN_DATE', 'IN_DATE', '[IN_DATE]', CastDateFieldForLike("[IN_DATE]", 0, "DB"), 135, 8, 0, false, '[IN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IN_DATE->Sortable = true; // Allow sort
        $this->IN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->IN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IN_DATE->Param, "CustomMsg");
        $this->Fields['IN_DATE'] = &$this->IN_DATE;

        // EXIT_DATE
        $this->EXIT_DATE = new DbField('DEATH', 'DEATH', 'x_EXIT_DATE', 'EXIT_DATE', '[EXIT_DATE]', CastDateFieldForLike("[EXIT_DATE]", 0, "DB"), 135, 8, 0, false, '[EXIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXIT_DATE->Sortable = true; // Allow sort
        $this->EXIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXIT_DATE->Param, "CustomMsg");
        $this->Fields['EXIT_DATE'] = &$this->EXIT_DATE;

        // KELUAR_ID
        $this->KELUAR_ID = new DbField('DEATH', 'DEATH', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELUAR_ID->Sortable = true; // Allow sort
        $this->KELUAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KELUAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELUAR_ID->Param, "CustomMsg");
        $this->Fields['KELUAR_ID'] = &$this->KELUAR_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('DEATH', 'DEATH', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('DEATH', 'DEATH', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 100, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // RESPONSIBLE
        $this->RESPONSIBLE = new DbField('DEATH', 'DEATH', 'x_RESPONSIBLE', 'RESPONSIBLE', '[RESPONSIBLE]', '[RESPONSIBLE]', 200, 100, -1, false, '[RESPONSIBLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONSIBLE->Sortable = true; // Allow sort
        $this->RESPONSIBLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONSIBLE->Param, "CustomMsg");
        $this->Fields['RESPONSIBLE'] = &$this->RESPONSIBLE;

        // RESPONSIBLE_ADDRESS
        $this->RESPONSIBLE_ADDRESS = new DbField('DEATH', 'DEATH', 'x_RESPONSIBLE_ADDRESS', 'RESPONSIBLE_ADDRESS', '[RESPONSIBLE_ADDRESS]', '[RESPONSIBLE_ADDRESS]', 200, 100, -1, false, '[RESPONSIBLE_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONSIBLE_ADDRESS->Sortable = true; // Allow sort
        $this->RESPONSIBLE_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONSIBLE_ADDRESS->Param, "CustomMsg");
        $this->Fields['RESPONSIBLE_ADDRESS'] = &$this->RESPONSIBLE_ADDRESS;

        // KTP_NO
        $this->KTP_NO = new DbField('DEATH', 'DEATH', 'x_KTP_NO', 'KTP_NO', '[KTP_NO]', '[KTP_NO]', 200, 50, -1, false, '[KTP_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KTP_NO->Sortable = true; // Allow sort
        $this->KTP_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KTP_NO->Param, "CustomMsg");
        $this->Fields['KTP_NO'] = &$this->KTP_NO;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('DEATH', 'DEATH', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('DEATH', 'DEATH', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('DEATH', 'DEATH', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // VISIT_ID
        $this->VISIT_ID = new DbField('DEATH', 'DEATH', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // THENAME
        $this->THENAME = new DbField('DEATH', 'DEATH', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // THEADDRESS
        $this->THEADDRESS = new DbField('DEATH', 'DEATH', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 150, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEID
        $this->THEID = new DbField('DEATH', 'DEATH', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 50, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = true; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->Fields['THEID'] = &$this->THEID;

        // ISRJ
        $this->ISRJ = new DbField('DEATH', 'DEATH', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // AGEYEAR
        $this->AGEYEAR = new DbField('DEATH', 'DEATH', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('DEATH', 'DEATH', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('DEATH', 'DEATH', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('DEATH', 'DEATH', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // GENDER
        $this->GENDER = new DbField('DEATH', 'DEATH', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // DOCTOR
        $this->DOCTOR = new DbField('DEATH', 'DEATH', 'x_DOCTOR', 'DOCTOR', '[DOCTOR]', '[DOCTOR]', 200, 150, -1, false, '[DOCTOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR->Sortable = true; // Allow sort
        $this->DOCTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR->Param, "CustomMsg");
        $this->Fields['DOCTOR'] = &$this->DOCTOR;

        // PETUGAS
        $this->PETUGAS = new DbField('DEATH', 'DEATH', 'x_PETUGAS', 'PETUGAS', '[PETUGAS]', '[PETUGAS]', 200, 150, -1, false, '[PETUGAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PETUGAS->Sortable = true; // Allow sort
        $this->PETUGAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PETUGAS->Param, "CustomMsg");
        $this->Fields['PETUGAS'] = &$this->PETUGAS;

        // KAL_ID
        $this->KAL_ID = new DbField('DEATH', 'DEATH', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[DEATH]";
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
            if (array_key_exists('DEATH_ID', $rs)) {
                AddFilter($where, QuotedName('DEATH_ID', $this->Dbid) . '=' . QuotedValue($rs['DEATH_ID'], $this->DEATH_ID->DataType, $this->Dbid));
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
        $this->DEATH_ID->DbValue = $row['DEATH_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->ORIGINALITY->DbValue = $row['ORIGINALITY'];
        $this->DIAGNOSA_ID->DbValue = $row['DIAGNOSA_ID'];
        $this->BILL_ID->DbValue = $row['BILL_ID'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->DESCRIPTION_ID->DbValue = $row['DESCRIPTION_ID'];
        $this->PETUGAS_ID->DbValue = $row['PETUGAS_ID'];
        $this->DEATH_DATE->DbValue = $row['DEATH_DATE'];
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->BED_ID->DbValue = $row['BED_ID'];
        $this->IN_DATE->DbValue = $row['IN_DATE'];
        $this->EXIT_DATE->DbValue = $row['EXIT_DATE'];
        $this->KELUAR_ID->DbValue = $row['KELUAR_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->RESPONSIBLE->DbValue = $row['RESPONSIBLE'];
        $this->RESPONSIBLE_ADDRESS->DbValue = $row['RESPONSIBLE_ADDRESS'];
        $this->KTP_NO->DbValue = $row['KTP_NO'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->THENAME->DbValue = $row['THENAME'];
        $this->THEADDRESS->DbValue = $row['THEADDRESS'];
        $this->THEID->DbValue = $row['THEID'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->AGEYEAR->DbValue = $row['AGEYEAR'];
        $this->AGEMONTH->DbValue = $row['AGEMONTH'];
        $this->AGEDAY->DbValue = $row['AGEDAY'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->DOCTOR->DbValue = $row['DOCTOR'];
        $this->PETUGAS->DbValue = $row['PETUGAS'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [DEATH_ID] = '@DEATH_ID@'";
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
        $val = $current ? $this->DEATH_ID->CurrentValue : $this->DEATH_ID->OldValue;
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
                $this->DEATH_ID->CurrentValue = $keys[1];
            } else {
                $this->DEATH_ID->OldValue = $keys[1];
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
            $val = array_key_exists('DEATH_ID', $row) ? $row['DEATH_ID'] : null;
        } else {
            $val = $this->DEATH_ID->OldValue !== null ? $this->DEATH_ID->OldValue : $this->DEATH_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@DEATH_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("DeathList");
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
        if ($pageName == "DeathView") {
            return $Language->phrase("View");
        } elseif ($pageName == "DeathEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "DeathAdd") {
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
                return "DeathView";
            case Config("API_ADD_ACTION"):
                return "DeathAdd";
            case Config("API_EDIT_ACTION"):
                return "DeathEdit";
            case Config("API_DELETE_ACTION"):
                return "DeathDelete";
            case Config("API_LIST_ACTION"):
                return "DeathList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "DeathList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("DeathView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("DeathView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "DeathAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "DeathAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("DeathEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("DeathAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("DeathDelete", $this->getUrlParm());
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
        $json .= ",DEATH_ID:" . JsonEncode($this->DEATH_ID->CurrentValue, "string");
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
        if ($this->DEATH_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->DEATH_ID->CurrentValue);
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
            if (($keyValue = Param("DEATH_ID") ?? Route("DEATH_ID")) !== null) {
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
                $this->DEATH_ID->CurrentValue = $key[1];
            } else {
                $this->DEATH_ID->OldValue = $key[1];
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
        $this->DEATH_ID->setDbValue($row['DEATH_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->ORIGINALITY->setDbValue($row['ORIGINALITY']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->DESCRIPTION_ID->setDbValue($row['DESCRIPTION_ID']);
        $this->PETUGAS_ID->setDbValue($row['PETUGAS_ID']);
        $this->DEATH_DATE->setDbValue($row['DEATH_DATE']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->IN_DATE->setDbValue($row['IN_DATE']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->RESPONSIBLE->setDbValue($row['RESPONSIBLE']);
        $this->RESPONSIBLE_ADDRESS->setDbValue($row['RESPONSIBLE_ADDRESS']);
        $this->KTP_NO->setDbValue($row['KTP_NO']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEID->setDbValue($row['THEID']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->PETUGAS->setDbValue($row['PETUGAS']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // DEATH_ID

        // NO_REGISTRATION

        // ORIGINALITY

        // DIAGNOSA_ID

        // BILL_ID

        // EMPLOYEE_ID

        // DESCRIPTION_ID

        // PETUGAS_ID

        // DEATH_DATE

        // CLASS_ROOM_ID

        // BED_ID

        // IN_DATE

        // EXIT_DATE

        // KELUAR_ID

        // CLINIC_ID

        // DESCRIPTION

        // RESPONSIBLE

        // RESPONSIBLE_ADDRESS

        // KTP_NO

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // VISIT_ID

        // THENAME

        // THEADDRESS

        // THEID

        // ISRJ

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // STATUS_PASIEN_ID

        // GENDER

        // DOCTOR

        // PETUGAS

        // KAL_ID

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // DEATH_ID
        $this->DEATH_ID->ViewValue = $this->DEATH_ID->CurrentValue;
        $this->DEATH_ID->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // ORIGINALITY
        $this->ORIGINALITY->ViewValue = $this->ORIGINALITY->CurrentValue;
        $this->ORIGINALITY->ViewCustomAttributes = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->ViewCustomAttributes = "";

        // BILL_ID
        $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // DESCRIPTION_ID
        $this->DESCRIPTION_ID->ViewValue = $this->DESCRIPTION_ID->CurrentValue;
        $this->DESCRIPTION_ID->ViewCustomAttributes = "";

        // PETUGAS_ID
        $this->PETUGAS_ID->ViewValue = $this->PETUGAS_ID->CurrentValue;
        $this->PETUGAS_ID->ViewCustomAttributes = "";

        // DEATH_DATE
        $this->DEATH_DATE->ViewValue = $this->DEATH_DATE->CurrentValue;
        $this->DEATH_DATE->ViewValue = FormatDateTime($this->DEATH_DATE->ViewValue, 0);
        $this->DEATH_DATE->ViewCustomAttributes = "";

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

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // RESPONSIBLE
        $this->RESPONSIBLE->ViewValue = $this->RESPONSIBLE->CurrentValue;
        $this->RESPONSIBLE->ViewCustomAttributes = "";

        // RESPONSIBLE_ADDRESS
        $this->RESPONSIBLE_ADDRESS->ViewValue = $this->RESPONSIBLE_ADDRESS->CurrentValue;
        $this->RESPONSIBLE_ADDRESS->ViewCustomAttributes = "";

        // KTP_NO
        $this->KTP_NO->ViewValue = $this->KTP_NO->CurrentValue;
        $this->KTP_NO->ViewCustomAttributes = "";

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

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

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

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

        // DOCTOR
        $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->ViewCustomAttributes = "";

        // PETUGAS
        $this->PETUGAS->ViewValue = $this->PETUGAS->CurrentValue;
        $this->PETUGAS->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // DEATH_ID
        $this->DEATH_ID->LinkCustomAttributes = "";
        $this->DEATH_ID->HrefValue = "";
        $this->DEATH_ID->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // ORIGINALITY
        $this->ORIGINALITY->LinkCustomAttributes = "";
        $this->ORIGINALITY->HrefValue = "";
        $this->ORIGINALITY->TooltipValue = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID->HrefValue = "";
        $this->DIAGNOSA_ID->TooltipValue = "";

        // BILL_ID
        $this->BILL_ID->LinkCustomAttributes = "";
        $this->BILL_ID->HrefValue = "";
        $this->BILL_ID->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // DESCRIPTION_ID
        $this->DESCRIPTION_ID->LinkCustomAttributes = "";
        $this->DESCRIPTION_ID->HrefValue = "";
        $this->DESCRIPTION_ID->TooltipValue = "";

        // PETUGAS_ID
        $this->PETUGAS_ID->LinkCustomAttributes = "";
        $this->PETUGAS_ID->HrefValue = "";
        $this->PETUGAS_ID->TooltipValue = "";

        // DEATH_DATE
        $this->DEATH_DATE->LinkCustomAttributes = "";
        $this->DEATH_DATE->HrefValue = "";
        $this->DEATH_DATE->TooltipValue = "";

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

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // RESPONSIBLE
        $this->RESPONSIBLE->LinkCustomAttributes = "";
        $this->RESPONSIBLE->HrefValue = "";
        $this->RESPONSIBLE->TooltipValue = "";

        // RESPONSIBLE_ADDRESS
        $this->RESPONSIBLE_ADDRESS->LinkCustomAttributes = "";
        $this->RESPONSIBLE_ADDRESS->HrefValue = "";
        $this->RESPONSIBLE_ADDRESS->TooltipValue = "";

        // KTP_NO
        $this->KTP_NO->LinkCustomAttributes = "";
        $this->KTP_NO->HrefValue = "";
        $this->KTP_NO->TooltipValue = "";

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

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

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

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // DOCTOR
        $this->DOCTOR->LinkCustomAttributes = "";
        $this->DOCTOR->HrefValue = "";
        $this->DOCTOR->TooltipValue = "";

        // PETUGAS
        $this->PETUGAS->LinkCustomAttributes = "";
        $this->PETUGAS->HrefValue = "";
        $this->PETUGAS->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

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

        // DEATH_ID
        $this->DEATH_ID->EditAttrs["class"] = "form-control";
        $this->DEATH_ID->EditCustomAttributes = "";
        if (!$this->DEATH_ID->Raw) {
            $this->DEATH_ID->CurrentValue = HtmlDecode($this->DEATH_ID->CurrentValue);
        }
        $this->DEATH_ID->EditValue = $this->DEATH_ID->CurrentValue;
        $this->DEATH_ID->PlaceHolder = RemoveHtml($this->DEATH_ID->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // ORIGINALITY
        $this->ORIGINALITY->EditAttrs["class"] = "form-control";
        $this->ORIGINALITY->EditCustomAttributes = "";
        if (!$this->ORIGINALITY->Raw) {
            $this->ORIGINALITY->CurrentValue = HtmlDecode($this->ORIGINALITY->CurrentValue);
        }
        $this->ORIGINALITY->EditValue = $this->ORIGINALITY->CurrentValue;
        $this->ORIGINALITY->PlaceHolder = RemoveHtml($this->ORIGINALITY->caption());

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID->Raw) {
            $this->DIAGNOSA_ID->CurrentValue = HtmlDecode($this->DIAGNOSA_ID->CurrentValue);
        }
        $this->DIAGNOSA_ID->EditValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

        // BILL_ID
        $this->BILL_ID->EditAttrs["class"] = "form-control";
        $this->BILL_ID->EditCustomAttributes = "";
        if (!$this->BILL_ID->Raw) {
            $this->BILL_ID->CurrentValue = HtmlDecode($this->BILL_ID->CurrentValue);
        }
        $this->BILL_ID->EditValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->PlaceHolder = RemoveHtml($this->BILL_ID->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // DESCRIPTION_ID
        $this->DESCRIPTION_ID->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION_ID->EditCustomAttributes = "";
        if (!$this->DESCRIPTION_ID->Raw) {
            $this->DESCRIPTION_ID->CurrentValue = HtmlDecode($this->DESCRIPTION_ID->CurrentValue);
        }
        $this->DESCRIPTION_ID->EditValue = $this->DESCRIPTION_ID->CurrentValue;
        $this->DESCRIPTION_ID->PlaceHolder = RemoveHtml($this->DESCRIPTION_ID->caption());

        // PETUGAS_ID
        $this->PETUGAS_ID->EditAttrs["class"] = "form-control";
        $this->PETUGAS_ID->EditCustomAttributes = "";
        if (!$this->PETUGAS_ID->Raw) {
            $this->PETUGAS_ID->CurrentValue = HtmlDecode($this->PETUGAS_ID->CurrentValue);
        }
        $this->PETUGAS_ID->EditValue = $this->PETUGAS_ID->CurrentValue;
        $this->PETUGAS_ID->PlaceHolder = RemoveHtml($this->PETUGAS_ID->caption());

        // DEATH_DATE
        $this->DEATH_DATE->EditAttrs["class"] = "form-control";
        $this->DEATH_DATE->EditCustomAttributes = "";
        $this->DEATH_DATE->EditValue = FormatDateTime($this->DEATH_DATE->CurrentValue, 8);
        $this->DEATH_DATE->PlaceHolder = RemoveHtml($this->DEATH_DATE->caption());

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

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // RESPONSIBLE
        $this->RESPONSIBLE->EditAttrs["class"] = "form-control";
        $this->RESPONSIBLE->EditCustomAttributes = "";
        if (!$this->RESPONSIBLE->Raw) {
            $this->RESPONSIBLE->CurrentValue = HtmlDecode($this->RESPONSIBLE->CurrentValue);
        }
        $this->RESPONSIBLE->EditValue = $this->RESPONSIBLE->CurrentValue;
        $this->RESPONSIBLE->PlaceHolder = RemoveHtml($this->RESPONSIBLE->caption());

        // RESPONSIBLE_ADDRESS
        $this->RESPONSIBLE_ADDRESS->EditAttrs["class"] = "form-control";
        $this->RESPONSIBLE_ADDRESS->EditCustomAttributes = "";
        if (!$this->RESPONSIBLE_ADDRESS->Raw) {
            $this->RESPONSIBLE_ADDRESS->CurrentValue = HtmlDecode($this->RESPONSIBLE_ADDRESS->CurrentValue);
        }
        $this->RESPONSIBLE_ADDRESS->EditValue = $this->RESPONSIBLE_ADDRESS->CurrentValue;
        $this->RESPONSIBLE_ADDRESS->PlaceHolder = RemoveHtml($this->RESPONSIBLE_ADDRESS->caption());

        // KTP_NO
        $this->KTP_NO->EditAttrs["class"] = "form-control";
        $this->KTP_NO->EditCustomAttributes = "";
        if (!$this->KTP_NO->Raw) {
            $this->KTP_NO->CurrentValue = HtmlDecode($this->KTP_NO->CurrentValue);
        }
        $this->KTP_NO->EditValue = $this->KTP_NO->CurrentValue;
        $this->KTP_NO->PlaceHolder = RemoveHtml($this->KTP_NO->caption());

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

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

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

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

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

        // PETUGAS
        $this->PETUGAS->EditAttrs["class"] = "form-control";
        $this->PETUGAS->EditCustomAttributes = "";
        if (!$this->PETUGAS->Raw) {
            $this->PETUGAS->CurrentValue = HtmlDecode($this->PETUGAS->CurrentValue);
        }
        $this->PETUGAS->EditValue = $this->PETUGAS->CurrentValue;
        $this->PETUGAS->PlaceHolder = RemoveHtml($this->PETUGAS->caption());

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

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
                    $doc->exportCaption($this->DEATH_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->ORIGINALITY);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->DESCRIPTION_ID);
                    $doc->exportCaption($this->PETUGAS_ID);
                    $doc->exportCaption($this->DEATH_DATE);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->IN_DATE);
                    $doc->exportCaption($this->EXIT_DATE);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->RESPONSIBLE);
                    $doc->exportCaption($this->RESPONSIBLE_ADDRESS);
                    $doc->exportCaption($this->KTP_NO);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->PETUGAS);
                    $doc->exportCaption($this->KAL_ID);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->DEATH_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->ORIGINALITY);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->DESCRIPTION_ID);
                    $doc->exportCaption($this->PETUGAS_ID);
                    $doc->exportCaption($this->DEATH_DATE);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->IN_DATE);
                    $doc->exportCaption($this->EXIT_DATE);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->RESPONSIBLE);
                    $doc->exportCaption($this->RESPONSIBLE_ADDRESS);
                    $doc->exportCaption($this->KTP_NO);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->PETUGAS);
                    $doc->exportCaption($this->KAL_ID);
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
                        $doc->exportField($this->DEATH_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->ORIGINALITY);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->DESCRIPTION_ID);
                        $doc->exportField($this->PETUGAS_ID);
                        $doc->exportField($this->DEATH_DATE);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->IN_DATE);
                        $doc->exportField($this->EXIT_DATE);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->RESPONSIBLE);
                        $doc->exportField($this->RESPONSIBLE_ADDRESS);
                        $doc->exportField($this->KTP_NO);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->PETUGAS);
                        $doc->exportField($this->KAL_ID);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->DEATH_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->ORIGINALITY);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->DESCRIPTION_ID);
                        $doc->exportField($this->PETUGAS_ID);
                        $doc->exportField($this->DEATH_DATE);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->IN_DATE);
                        $doc->exportField($this->EXIT_DATE);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->RESPONSIBLE);
                        $doc->exportField($this->RESPONSIBLE_ADDRESS);
                        $doc->exportField($this->KTP_NO);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->PETUGAS);
                        $doc->exportField($this->KAL_ID);
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
