<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for PASIEN_APPOINTMENT
 */
class PasienAppointment extends DbTable
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
    public $STATUS_PASIEN_ID;
    public $RUJUKAN_ID;
    public $ADDRESS_OF_RUJUKAN;
    public $REASON_ID;
    public $WAY_ID;
    public $PATIENT_CATEGORY_ID;
    public $BOOKED_DATE;
    public $VISIT_DATE;
    public $ISNEW;
    public $FOLLOW_UP;
    public $PLACE_TYPE;
    public $CLINIC_ID;
    public $CLINIC_ID_FROM;
    public $CLASS_ROOM_ID;
    public $BED_ID;
    public $KELUAR_ID;
    public $IN_DATE;
    public $EXIT_DATE;
    public $DIANTAR_OLEH;
    public $GENDER;
    public $DESCRIPTION;
    public $VISITOR_ADDRESS;
    public $MODIFIED_BY;
    public $MODIFIED_DATE;
    public $MODIFIED_FROM;
    public $EMPLOYEE_ID;
    public $EMPLOYEE_ID_FROM;
    public $RESPONSIBLE_ID;
    public $RESPONSIBLE;
    public $FAMILY_STATUS_ID;
    public $TICKET_NO;
    public $ISATTENDED;
    public $PAYOR_ID;
    public $CLASS_ID;
    public $ISPERTARIF;
    public $KAL_ID;
    public $EMPLOYEE_INAP;
    public $PASIEN_ID;
    public $KARYAWAN;
    public $ACCOUNT_ID;
    public $CLASS_ID_PLAFOND;
    public $BACKCHARGE;
    public $COVERAGE_ID;
    public $AGEYEAR;
    public $AGEMONTH;
    public $AGEDAY;
    public $RECOMENDATION;
    public $CONCLUSION;
    public $SPECIMENNO;
    public $LOCKED;
    public $RM_OUT_DATE;
    public $RM_IN_DATE;
    public $LAMA_PINJAM;
    public $STANDAR_RJ;
    public $LENGKAP_RJ;
    public $LENGKAP_RI;
    public $RESEND_RM_DATE;
    public $LENGKAP_RM1;
    public $LENGKAP_RESUME;
    public $LENGKAP_ANAMNESIS;
    public $LENGKAP_CONSENT;
    public $LENGKAP_ANESTESI;
    public $LENGKAP_OP;
    public $BACK_RM_DATE;
    public $VALID_RM_DATE;
    public $NO_SKP;
    public $DIAGNOSA_ID;
    public $TICKET_ALL;
    public $TANGGAL_RUJUKAN;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'PASIEN_APPOINTMENT';
        $this->TableName = 'PASIEN_APPOINTMENT';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[PASIEN_APPOINTMENT]";
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
        $this->ORG_UNIT_CODE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->IsPrimaryKey = true; // Primary key field
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->IsPrimaryKey = true; // Primary key field
        $this->VISIT_ID->Nullable = false; // NOT NULL field
        $this->VISIT_ID->Required = true; // Required field
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // RUJUKAN_ID
        $this->RUJUKAN_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_RUJUKAN_ID', 'RUJUKAN_ID', '[RUJUKAN_ID]', 'CAST([RUJUKAN_ID] AS NVARCHAR)', 17, 1, -1, false, '[RUJUKAN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RUJUKAN_ID->Sortable = true; // Allow sort
        $this->RUJUKAN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RUJUKAN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RUJUKAN_ID->Param, "CustomMsg");
        $this->Fields['RUJUKAN_ID'] = &$this->RUJUKAN_ID;

        // ADDRESS_OF_RUJUKAN
        $this->ADDRESS_OF_RUJUKAN = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_ADDRESS_OF_RUJUKAN', 'ADDRESS_OF_RUJUKAN', '[ADDRESS_OF_RUJUKAN]', '[ADDRESS_OF_RUJUKAN]', 200, 100, -1, false, '[ADDRESS_OF_RUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ADDRESS_OF_RUJUKAN->Sortable = true; // Allow sort
        $this->ADDRESS_OF_RUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ADDRESS_OF_RUJUKAN->Param, "CustomMsg");
        $this->Fields['ADDRESS_OF_RUJUKAN'] = &$this->ADDRESS_OF_RUJUKAN;

        // REASON_ID
        $this->REASON_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_REASON_ID', 'REASON_ID', '[REASON_ID]', 'CAST([REASON_ID] AS NVARCHAR)', 17, 1, -1, false, '[REASON_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REASON_ID->Sortable = true; // Allow sort
        $this->REASON_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REASON_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REASON_ID->Param, "CustomMsg");
        $this->Fields['REASON_ID'] = &$this->REASON_ID;

        // WAY_ID
        $this->WAY_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_WAY_ID', 'WAY_ID', '[WAY_ID]', 'CAST([WAY_ID] AS NVARCHAR)', 17, 1, -1, false, '[WAY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WAY_ID->Sortable = true; // Allow sort
        $this->WAY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->WAY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WAY_ID->Param, "CustomMsg");
        $this->Fields['WAY_ID'] = &$this->WAY_ID;

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_PATIENT_CATEGORY_ID', 'PATIENT_CATEGORY_ID', '[PATIENT_CATEGORY_ID]', 'CAST([PATIENT_CATEGORY_ID] AS NVARCHAR)', 17, 1, -1, false, '[PATIENT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PATIENT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->PATIENT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PATIENT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PATIENT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['PATIENT_CATEGORY_ID'] = &$this->PATIENT_CATEGORY_ID;

        // BOOKED_DATE
        $this->BOOKED_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_BOOKED_DATE', 'BOOKED_DATE', '[BOOKED_DATE]', CastDateFieldForLike("[BOOKED_DATE]", 0, "DB"), 135, 8, 0, false, '[BOOKED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BOOKED_DATE->Sortable = true; // Allow sort
        $this->BOOKED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->BOOKED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BOOKED_DATE->Param, "CustomMsg");
        $this->Fields['BOOKED_DATE'] = &$this->BOOKED_DATE;

        // VISIT_DATE
        $this->VISIT_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_VISIT_DATE', 'VISIT_DATE', '[VISIT_DATE]', CastDateFieldForLike("[VISIT_DATE]", 0, "DB"), 135, 8, 0, false, '[VISIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_DATE->Sortable = true; // Allow sort
        $this->VISIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VISIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_DATE->Param, "CustomMsg");
        $this->Fields['VISIT_DATE'] = &$this->VISIT_DATE;

        // ISNEW
        $this->ISNEW = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_ISNEW', 'ISNEW', '[ISNEW]', '[ISNEW]', 129, 1, -1, false, '[ISNEW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISNEW->Sortable = true; // Allow sort
        $this->ISNEW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISNEW->Param, "CustomMsg");
        $this->Fields['ISNEW'] = &$this->ISNEW;

        // FOLLOW_UP
        $this->FOLLOW_UP = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_FOLLOW_UP', 'FOLLOW_UP', '[FOLLOW_UP]', 'CAST([FOLLOW_UP] AS NVARCHAR)', 17, 1, -1, false, '[FOLLOW_UP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FOLLOW_UP->Sortable = true; // Allow sort
        $this->FOLLOW_UP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FOLLOW_UP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FOLLOW_UP->Param, "CustomMsg");
        $this->Fields['FOLLOW_UP'] = &$this->FOLLOW_UP;

        // PLACE_TYPE
        $this->PLACE_TYPE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_PLACE_TYPE', 'PLACE_TYPE', '[PLACE_TYPE]', 'CAST([PLACE_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[PLACE_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PLACE_TYPE->Sortable = true; // Allow sort
        $this->PLACE_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PLACE_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PLACE_TYPE->Param, "CustomMsg");
        $this->Fields['PLACE_TYPE'] = &$this->PLACE_TYPE;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_CLINIC_ID_FROM', 'CLINIC_ID_FROM', '[CLINIC_ID_FROM]', '[CLINIC_ID_FROM]', 200, 8, -1, false, '[CLINIC_ID_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID_FROM->Sortable = true; // Allow sort
        $this->CLINIC_ID_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID_FROM->Param, "CustomMsg");
        $this->Fields['CLINIC_ID_FROM'] = &$this->CLINIC_ID_FROM;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 16, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // BED_ID
        $this->BED_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = true; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // KELUAR_ID
        $this->KELUAR_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELUAR_ID->Sortable = true; // Allow sort
        $this->KELUAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KELUAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELUAR_ID->Param, "CustomMsg");
        $this->Fields['KELUAR_ID'] = &$this->KELUAR_ID;

        // IN_DATE
        $this->IN_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_IN_DATE', 'IN_DATE', '[IN_DATE]', CastDateFieldForLike("[IN_DATE]", 0, "DB"), 135, 8, 0, false, '[IN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IN_DATE->Sortable = true; // Allow sort
        $this->IN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->IN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IN_DATE->Param, "CustomMsg");
        $this->Fields['IN_DATE'] = &$this->IN_DATE;

        // EXIT_DATE
        $this->EXIT_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_EXIT_DATE', 'EXIT_DATE', '[EXIT_DATE]', CastDateFieldForLike("[EXIT_DATE]", 0, "DB"), 135, 8, 0, false, '[EXIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXIT_DATE->Sortable = true; // Allow sort
        $this->EXIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXIT_DATE->Param, "CustomMsg");
        $this->Fields['EXIT_DATE'] = &$this->EXIT_DATE;

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_DIANTAR_OLEH', 'DIANTAR_OLEH', '[DIANTAR_OLEH]', '[DIANTAR_OLEH]', 200, 255, -1, false, '[DIANTAR_OLEH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIANTAR_OLEH->Sortable = true; // Allow sort
        $this->DIANTAR_OLEH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIANTAR_OLEH->Param, "CustomMsg");
        $this->Fields['DIANTAR_OLEH'] = &$this->DIANTAR_OLEH;

        // GENDER
        $this->GENDER = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // VISITOR_ADDRESS
        $this->VISITOR_ADDRESS = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_VISITOR_ADDRESS', 'VISITOR_ADDRESS', '[VISITOR_ADDRESS]', '[VISITOR_ADDRESS]', 200, 150, -1, false, '[VISITOR_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISITOR_ADDRESS->Sortable = true; // Allow sort
        $this->VISITOR_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISITOR_ADDRESS->Param, "CustomMsg");
        $this->Fields['VISITOR_ADDRESS'] = &$this->VISITOR_ADDRESS;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_EMPLOYEE_ID_FROM', 'EMPLOYEE_ID_FROM', '[EMPLOYEE_ID_FROM]', '[EMPLOYEE_ID_FROM]', 200, 50, -1, false, '[EMPLOYEE_ID_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID_FROM->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID_FROM->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID_FROM'] = &$this->EMPLOYEE_ID_FROM;

        // RESPONSIBLE_ID
        $this->RESPONSIBLE_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_RESPONSIBLE_ID', 'RESPONSIBLE_ID', '[RESPONSIBLE_ID]', 'CAST([RESPONSIBLE_ID] AS NVARCHAR)', 17, 1, -1, false, '[RESPONSIBLE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONSIBLE_ID->Sortable = true; // Allow sort
        $this->RESPONSIBLE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RESPONSIBLE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONSIBLE_ID->Param, "CustomMsg");
        $this->Fields['RESPONSIBLE_ID'] = &$this->RESPONSIBLE_ID;

        // RESPONSIBLE
        $this->RESPONSIBLE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_RESPONSIBLE', 'RESPONSIBLE', '[RESPONSIBLE]', '[RESPONSIBLE]', 200, 150, -1, false, '[RESPONSIBLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONSIBLE->Sortable = true; // Allow sort
        $this->RESPONSIBLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONSIBLE->Param, "CustomMsg");
        $this->Fields['RESPONSIBLE'] = &$this->RESPONSIBLE;

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_FAMILY_STATUS_ID', 'FAMILY_STATUS_ID', '[FAMILY_STATUS_ID]', 'CAST([FAMILY_STATUS_ID] AS NVARCHAR)', 17, 1, -1, false, '[FAMILY_STATUS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAMILY_STATUS_ID->Sortable = true; // Allow sort
        $this->FAMILY_STATUS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FAMILY_STATUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAMILY_STATUS_ID->Param, "CustomMsg");
        $this->Fields['FAMILY_STATUS_ID'] = &$this->FAMILY_STATUS_ID;

        // TICKET_NO
        $this->TICKET_NO = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_TICKET_NO', 'TICKET_NO', '[TICKET_NO]', 'CAST([TICKET_NO] AS NVARCHAR)', 2, 2, -1, false, '[TICKET_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TICKET_NO->Sortable = true; // Allow sort
        $this->TICKET_NO->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TICKET_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TICKET_NO->Param, "CustomMsg");
        $this->Fields['TICKET_NO'] = &$this->TICKET_NO;

        // ISATTENDED
        $this->ISATTENDED = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_ISATTENDED', 'ISATTENDED', '[ISATTENDED]', '[ISATTENDED]', 129, 1, -1, false, '[ISATTENDED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISATTENDED->Sortable = true; // Allow sort
        $this->ISATTENDED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISATTENDED->Param, "CustomMsg");
        $this->Fields['ISATTENDED'] = &$this->ISATTENDED;

        // PAYOR_ID
        $this->PAYOR_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_PAYOR_ID', 'PAYOR_ID', '[PAYOR_ID]', '[PAYOR_ID]', 200, 50, -1, false, '[PAYOR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYOR_ID->Sortable = true; // Allow sort
        $this->PAYOR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ID->Param, "CustomMsg");
        $this->Fields['PAYOR_ID'] = &$this->PAYOR_ID;

        // CLASS_ID
        $this->CLASS_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // ISPERTARIF
        $this->ISPERTARIF = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_ISPERTARIF', 'ISPERTARIF', '[ISPERTARIF]', '[ISPERTARIF]', 129, 1, -1, false, '[ISPERTARIF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISPERTARIF->Sortable = true; // Allow sort
        $this->ISPERTARIF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISPERTARIF->Param, "CustomMsg");
        $this->Fields['ISPERTARIF'] = &$this->ISPERTARIF;

        // KAL_ID
        $this->KAL_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // EMPLOYEE_INAP
        $this->EMPLOYEE_INAP = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_EMPLOYEE_INAP', 'EMPLOYEE_INAP', '[EMPLOYEE_INAP]', '[EMPLOYEE_INAP]', 200, 50, -1, false, '[EMPLOYEE_INAP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_INAP->Sortable = true; // Allow sort
        $this->EMPLOYEE_INAP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_INAP->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_INAP'] = &$this->EMPLOYEE_INAP;

        // PASIEN_ID
        $this->PASIEN_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_PASIEN_ID', 'PASIEN_ID', '[PASIEN_ID]', '[PASIEN_ID]', 200, 30, -1, false, '[PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_ID->Sortable = true; // Allow sort
        $this->PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_ID->Param, "CustomMsg");
        $this->Fields['PASIEN_ID'] = &$this->PASIEN_ID;

        // KARYAWAN
        $this->KARYAWAN = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_KARYAWAN', 'KARYAWAN', '[KARYAWAN]', '[KARYAWAN]', 200, 50, -1, false, '[KARYAWAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KARYAWAN->Sortable = true; // Allow sort
        $this->KARYAWAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KARYAWAN->Param, "CustomMsg");
        $this->Fields['KARYAWAN'] = &$this->KARYAWAN;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_CLASS_ID_PLAFOND', 'CLASS_ID_PLAFOND', '[CLASS_ID_PLAFOND]', 'CAST([CLASS_ID_PLAFOND] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID_PLAFOND]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID_PLAFOND->Sortable = true; // Allow sort
        $this->CLASS_ID_PLAFOND->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID_PLAFOND->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID_PLAFOND->Param, "CustomMsg");
        $this->Fields['CLASS_ID_PLAFOND'] = &$this->CLASS_ID_PLAFOND;

        // BACKCHARGE
        $this->BACKCHARGE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_BACKCHARGE', 'BACKCHARGE', '[BACKCHARGE]', '[BACKCHARGE]', 129, 1, -1, false, '[BACKCHARGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BACKCHARGE->Sortable = true; // Allow sort
        $this->BACKCHARGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BACKCHARGE->Param, "CustomMsg");
        $this->Fields['BACKCHARGE'] = &$this->BACKCHARGE;

        // COVERAGE_ID
        $this->COVERAGE_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_COVERAGE_ID', 'COVERAGE_ID', '[COVERAGE_ID]', 'CAST([COVERAGE_ID] AS NVARCHAR)', 17, 1, -1, false, '[COVERAGE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COVERAGE_ID->Sortable = true; // Allow sort
        $this->COVERAGE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->COVERAGE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COVERAGE_ID->Param, "CustomMsg");
        $this->Fields['COVERAGE_ID'] = &$this->COVERAGE_ID;

        // AGEYEAR
        $this->AGEYEAR = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // RECOMENDATION
        $this->RECOMENDATION = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_RECOMENDATION', 'RECOMENDATION', '[RECOMENDATION]', '[RECOMENDATION]', 200, 8000, -1, false, '[RECOMENDATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECOMENDATION->Sortable = true; // Allow sort
        $this->RECOMENDATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECOMENDATION->Param, "CustomMsg");
        $this->Fields['RECOMENDATION'] = &$this->RECOMENDATION;

        // CONCLUSION
        $this->CONCLUSION = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_CONCLUSION', 'CONCLUSION', '[CONCLUSION]', '[CONCLUSION]', 200, 8000, -1, false, '[CONCLUSION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONCLUSION->Sortable = true; // Allow sort
        $this->CONCLUSION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONCLUSION->Param, "CustomMsg");
        $this->Fields['CONCLUSION'] = &$this->CONCLUSION;

        // SPECIMENNO
        $this->SPECIMENNO = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_SPECIMENNO', 'SPECIMENNO', '[SPECIMENNO]', '[SPECIMENNO]', 200, 50, -1, false, '[SPECIMENNO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPECIMENNO->Sortable = true; // Allow sort
        $this->SPECIMENNO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPECIMENNO->Param, "CustomMsg");
        $this->Fields['SPECIMENNO'] = &$this->SPECIMENNO;

        // LOCKED
        $this->LOCKED = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LOCKED', 'LOCKED', '[LOCKED]', '[LOCKED]', 200, 1, -1, false, '[LOCKED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LOCKED->Sortable = true; // Allow sort
        $this->LOCKED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LOCKED->Param, "CustomMsg");
        $this->Fields['LOCKED'] = &$this->LOCKED;

        // RM_OUT_DATE
        $this->RM_OUT_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_RM_OUT_DATE', 'RM_OUT_DATE', '[RM_OUT_DATE]', CastDateFieldForLike("[RM_OUT_DATE]", 0, "DB"), 135, 8, 0, false, '[RM_OUT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RM_OUT_DATE->Sortable = true; // Allow sort
        $this->RM_OUT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RM_OUT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RM_OUT_DATE->Param, "CustomMsg");
        $this->Fields['RM_OUT_DATE'] = &$this->RM_OUT_DATE;

        // RM_IN_DATE
        $this->RM_IN_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_RM_IN_DATE', 'RM_IN_DATE', '[RM_IN_DATE]', CastDateFieldForLike("[RM_IN_DATE]", 0, "DB"), 135, 8, 0, false, '[RM_IN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RM_IN_DATE->Sortable = true; // Allow sort
        $this->RM_IN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RM_IN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RM_IN_DATE->Param, "CustomMsg");
        $this->Fields['RM_IN_DATE'] = &$this->RM_IN_DATE;

        // LAMA_PINJAM
        $this->LAMA_PINJAM = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LAMA_PINJAM', 'LAMA_PINJAM', '[LAMA_PINJAM]', CastDateFieldForLike("[LAMA_PINJAM]", 0, "DB"), 135, 8, 0, false, '[LAMA_PINJAM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LAMA_PINJAM->Sortable = true; // Allow sort
        $this->LAMA_PINJAM->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->LAMA_PINJAM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LAMA_PINJAM->Param, "CustomMsg");
        $this->Fields['LAMA_PINJAM'] = &$this->LAMA_PINJAM;

        // STANDAR_RJ
        $this->STANDAR_RJ = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_STANDAR_RJ', 'STANDAR_RJ', '[STANDAR_RJ]', '[STANDAR_RJ]', 129, 1, -1, false, '[STANDAR_RJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STANDAR_RJ->Sortable = true; // Allow sort
        $this->STANDAR_RJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STANDAR_RJ->Param, "CustomMsg");
        $this->Fields['STANDAR_RJ'] = &$this->STANDAR_RJ;

        // LENGKAP_RJ
        $this->LENGKAP_RJ = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LENGKAP_RJ', 'LENGKAP_RJ', '[LENGKAP_RJ]', '[LENGKAP_RJ]', 129, 1, -1, false, '[LENGKAP_RJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_RJ->Sortable = true; // Allow sort
        $this->LENGKAP_RJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_RJ->Param, "CustomMsg");
        $this->Fields['LENGKAP_RJ'] = &$this->LENGKAP_RJ;

        // LENGKAP_RI
        $this->LENGKAP_RI = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LENGKAP_RI', 'LENGKAP_RI', '[LENGKAP_RI]', '[LENGKAP_RI]', 129, 1, -1, false, '[LENGKAP_RI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_RI->Sortable = true; // Allow sort
        $this->LENGKAP_RI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_RI->Param, "CustomMsg");
        $this->Fields['LENGKAP_RI'] = &$this->LENGKAP_RI;

        // RESEND_RM_DATE
        $this->RESEND_RM_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_RESEND_RM_DATE', 'RESEND_RM_DATE', '[RESEND_RM_DATE]', CastDateFieldForLike("[RESEND_RM_DATE]", 0, "DB"), 135, 8, 0, false, '[RESEND_RM_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESEND_RM_DATE->Sortable = true; // Allow sort
        $this->RESEND_RM_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RESEND_RM_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESEND_RM_DATE->Param, "CustomMsg");
        $this->Fields['RESEND_RM_DATE'] = &$this->RESEND_RM_DATE;

        // LENGKAP_RM1
        $this->LENGKAP_RM1 = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LENGKAP_RM1', 'LENGKAP_RM1', '[LENGKAP_RM1]', '[LENGKAP_RM1]', 129, 1, -1, false, '[LENGKAP_RM1]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_RM1->Sortable = true; // Allow sort
        $this->LENGKAP_RM1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_RM1->Param, "CustomMsg");
        $this->Fields['LENGKAP_RM1'] = &$this->LENGKAP_RM1;

        // LENGKAP_RESUME
        $this->LENGKAP_RESUME = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LENGKAP_RESUME', 'LENGKAP_RESUME', '[LENGKAP_RESUME]', '[LENGKAP_RESUME]', 129, 1, -1, false, '[LENGKAP_RESUME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_RESUME->Sortable = true; // Allow sort
        $this->LENGKAP_RESUME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_RESUME->Param, "CustomMsg");
        $this->Fields['LENGKAP_RESUME'] = &$this->LENGKAP_RESUME;

        // LENGKAP_ANAMNESIS
        $this->LENGKAP_ANAMNESIS = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LENGKAP_ANAMNESIS', 'LENGKAP_ANAMNESIS', '[LENGKAP_ANAMNESIS]', '[LENGKAP_ANAMNESIS]', 129, 1, -1, false, '[LENGKAP_ANAMNESIS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_ANAMNESIS->Sortable = true; // Allow sort
        $this->LENGKAP_ANAMNESIS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_ANAMNESIS->Param, "CustomMsg");
        $this->Fields['LENGKAP_ANAMNESIS'] = &$this->LENGKAP_ANAMNESIS;

        // LENGKAP_CONSENT
        $this->LENGKAP_CONSENT = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LENGKAP_CONSENT', 'LENGKAP_CONSENT', '[LENGKAP_CONSENT]', '[LENGKAP_CONSENT]', 129, 1, -1, false, '[LENGKAP_CONSENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_CONSENT->Sortable = true; // Allow sort
        $this->LENGKAP_CONSENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_CONSENT->Param, "CustomMsg");
        $this->Fields['LENGKAP_CONSENT'] = &$this->LENGKAP_CONSENT;

        // LENGKAP_ANESTESI
        $this->LENGKAP_ANESTESI = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LENGKAP_ANESTESI', 'LENGKAP_ANESTESI', '[LENGKAP_ANESTESI]', '[LENGKAP_ANESTESI]', 129, 1, -1, false, '[LENGKAP_ANESTESI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_ANESTESI->Sortable = true; // Allow sort
        $this->LENGKAP_ANESTESI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_ANESTESI->Param, "CustomMsg");
        $this->Fields['LENGKAP_ANESTESI'] = &$this->LENGKAP_ANESTESI;

        // LENGKAP_OP
        $this->LENGKAP_OP = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_LENGKAP_OP', 'LENGKAP_OP', '[LENGKAP_OP]', '[LENGKAP_OP]', 129, 1, -1, false, '[LENGKAP_OP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_OP->Sortable = true; // Allow sort
        $this->LENGKAP_OP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_OP->Param, "CustomMsg");
        $this->Fields['LENGKAP_OP'] = &$this->LENGKAP_OP;

        // BACK_RM_DATE
        $this->BACK_RM_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_BACK_RM_DATE', 'BACK_RM_DATE', '[BACK_RM_DATE]', CastDateFieldForLike("[BACK_RM_DATE]", 0, "DB"), 135, 8, 0, false, '[BACK_RM_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BACK_RM_DATE->Sortable = true; // Allow sort
        $this->BACK_RM_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->BACK_RM_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BACK_RM_DATE->Param, "CustomMsg");
        $this->Fields['BACK_RM_DATE'] = &$this->BACK_RM_DATE;

        // VALID_RM_DATE
        $this->VALID_RM_DATE = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_VALID_RM_DATE', 'VALID_RM_DATE', '[VALID_RM_DATE]', CastDateFieldForLike("[VALID_RM_DATE]", 0, "DB"), 135, 8, 0, false, '[VALID_RM_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VALID_RM_DATE->Sortable = true; // Allow sort
        $this->VALID_RM_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VALID_RM_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VALID_RM_DATE->Param, "CustomMsg");
        $this->Fields['VALID_RM_DATE'] = &$this->VALID_RM_DATE;

        // NO_SKP
        $this->NO_SKP = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_NO_SKP', 'NO_SKP', '[NO_SKP]', '[NO_SKP]', 200, 50, -1, false, '[NO_SKP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_SKP->Sortable = true; // Allow sort
        $this->NO_SKP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_SKP->Param, "CustomMsg");
        $this->Fields['NO_SKP'] = &$this->NO_SKP;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 10, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // TICKET_ALL
        $this->TICKET_ALL = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_TICKET_ALL', 'TICKET_ALL', '[TICKET_ALL]', 'CAST([TICKET_ALL] AS NVARCHAR)', 20, 8, -1, false, '[TICKET_ALL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TICKET_ALL->Sortable = true; // Allow sort
        $this->TICKET_ALL->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TICKET_ALL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TICKET_ALL->Param, "CustomMsg");
        $this->Fields['TICKET_ALL'] = &$this->TICKET_ALL;

        // TANGGAL_RUJUKAN
        $this->TANGGAL_RUJUKAN = new DbField('PASIEN_APPOINTMENT', 'PASIEN_APPOINTMENT', 'x_TANGGAL_RUJUKAN', 'TANGGAL_RUJUKAN', '[TANGGAL_RUJUKAN]', CastDateFieldForLike("[TANGGAL_RUJUKAN]", 0, "DB"), 135, 8, 0, false, '[TANGGAL_RUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TANGGAL_RUJUKAN->Sortable = true; // Allow sort
        $this->TANGGAL_RUJUKAN->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TANGGAL_RUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TANGGAL_RUJUKAN->Param, "CustomMsg");
        $this->Fields['TANGGAL_RUJUKAN'] = &$this->TANGGAL_RUJUKAN;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[PASIEN_APPOINTMENT]";
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
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->RUJUKAN_ID->DbValue = $row['RUJUKAN_ID'];
        $this->ADDRESS_OF_RUJUKAN->DbValue = $row['ADDRESS_OF_RUJUKAN'];
        $this->REASON_ID->DbValue = $row['REASON_ID'];
        $this->WAY_ID->DbValue = $row['WAY_ID'];
        $this->PATIENT_CATEGORY_ID->DbValue = $row['PATIENT_CATEGORY_ID'];
        $this->BOOKED_DATE->DbValue = $row['BOOKED_DATE'];
        $this->VISIT_DATE->DbValue = $row['VISIT_DATE'];
        $this->ISNEW->DbValue = $row['ISNEW'];
        $this->FOLLOW_UP->DbValue = $row['FOLLOW_UP'];
        $this->PLACE_TYPE->DbValue = $row['PLACE_TYPE'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->CLINIC_ID_FROM->DbValue = $row['CLINIC_ID_FROM'];
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->BED_ID->DbValue = $row['BED_ID'];
        $this->KELUAR_ID->DbValue = $row['KELUAR_ID'];
        $this->IN_DATE->DbValue = $row['IN_DATE'];
        $this->EXIT_DATE->DbValue = $row['EXIT_DATE'];
        $this->DIANTAR_OLEH->DbValue = $row['DIANTAR_OLEH'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->VISITOR_ADDRESS->DbValue = $row['VISITOR_ADDRESS'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->EMPLOYEE_ID_FROM->DbValue = $row['EMPLOYEE_ID_FROM'];
        $this->RESPONSIBLE_ID->DbValue = $row['RESPONSIBLE_ID'];
        $this->RESPONSIBLE->DbValue = $row['RESPONSIBLE'];
        $this->FAMILY_STATUS_ID->DbValue = $row['FAMILY_STATUS_ID'];
        $this->TICKET_NO->DbValue = $row['TICKET_NO'];
        $this->ISATTENDED->DbValue = $row['ISATTENDED'];
        $this->PAYOR_ID->DbValue = $row['PAYOR_ID'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->ISPERTARIF->DbValue = $row['ISPERTARIF'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->EMPLOYEE_INAP->DbValue = $row['EMPLOYEE_INAP'];
        $this->PASIEN_ID->DbValue = $row['PASIEN_ID'];
        $this->KARYAWAN->DbValue = $row['KARYAWAN'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->CLASS_ID_PLAFOND->DbValue = $row['CLASS_ID_PLAFOND'];
        $this->BACKCHARGE->DbValue = $row['BACKCHARGE'];
        $this->COVERAGE_ID->DbValue = $row['COVERAGE_ID'];
        $this->AGEYEAR->DbValue = $row['AGEYEAR'];
        $this->AGEMONTH->DbValue = $row['AGEMONTH'];
        $this->AGEDAY->DbValue = $row['AGEDAY'];
        $this->RECOMENDATION->DbValue = $row['RECOMENDATION'];
        $this->CONCLUSION->DbValue = $row['CONCLUSION'];
        $this->SPECIMENNO->DbValue = $row['SPECIMENNO'];
        $this->LOCKED->DbValue = $row['LOCKED'];
        $this->RM_OUT_DATE->DbValue = $row['RM_OUT_DATE'];
        $this->RM_IN_DATE->DbValue = $row['RM_IN_DATE'];
        $this->LAMA_PINJAM->DbValue = $row['LAMA_PINJAM'];
        $this->STANDAR_RJ->DbValue = $row['STANDAR_RJ'];
        $this->LENGKAP_RJ->DbValue = $row['LENGKAP_RJ'];
        $this->LENGKAP_RI->DbValue = $row['LENGKAP_RI'];
        $this->RESEND_RM_DATE->DbValue = $row['RESEND_RM_DATE'];
        $this->LENGKAP_RM1->DbValue = $row['LENGKAP_RM1'];
        $this->LENGKAP_RESUME->DbValue = $row['LENGKAP_RESUME'];
        $this->LENGKAP_ANAMNESIS->DbValue = $row['LENGKAP_ANAMNESIS'];
        $this->LENGKAP_CONSENT->DbValue = $row['LENGKAP_CONSENT'];
        $this->LENGKAP_ANESTESI->DbValue = $row['LENGKAP_ANESTESI'];
        $this->LENGKAP_OP->DbValue = $row['LENGKAP_OP'];
        $this->BACK_RM_DATE->DbValue = $row['BACK_RM_DATE'];
        $this->VALID_RM_DATE->DbValue = $row['VALID_RM_DATE'];
        $this->NO_SKP->DbValue = $row['NO_SKP'];
        $this->DIAGNOSA_ID->DbValue = $row['DIAGNOSA_ID'];
        $this->TICKET_ALL->DbValue = $row['TICKET_ALL'];
        $this->TANGGAL_RUJUKAN->DbValue = $row['TANGGAL_RUJUKAN'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [NO_REGISTRATION] = '@NO_REGISTRATION@' AND [VISIT_ID] = '@VISIT_ID@'";
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
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 3) {
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
        return $_SESSION[$name] ?? GetUrl("PasienAppointmentList");
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
        if ($pageName == "PasienAppointmentView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PasienAppointmentEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PasienAppointmentAdd") {
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
                return "PasienAppointmentView";
            case Config("API_ADD_ACTION"):
                return "PasienAppointmentAdd";
            case Config("API_EDIT_ACTION"):
                return "PasienAppointmentEdit";
            case Config("API_DELETE_ACTION"):
                return "PasienAppointmentDelete";
            case Config("API_LIST_ACTION"):
                return "PasienAppointmentList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PasienAppointmentList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PasienAppointmentView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PasienAppointmentView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PasienAppointmentAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PasienAppointmentAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PasienAppointmentEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PasienAppointmentAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PasienAppointmentDelete", $this->getUrlParm());
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
            if (is_array($arKeys)) {
                $arKeys[] = $arKey;
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_array($key) || count($key) != 3) {
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
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->RUJUKAN_ID->setDbValue($row['RUJUKAN_ID']);
        $this->ADDRESS_OF_RUJUKAN->setDbValue($row['ADDRESS_OF_RUJUKAN']);
        $this->REASON_ID->setDbValue($row['REASON_ID']);
        $this->WAY_ID->setDbValue($row['WAY_ID']);
        $this->PATIENT_CATEGORY_ID->setDbValue($row['PATIENT_CATEGORY_ID']);
        $this->BOOKED_DATE->setDbValue($row['BOOKED_DATE']);
        $this->VISIT_DATE->setDbValue($row['VISIT_DATE']);
        $this->ISNEW->setDbValue($row['ISNEW']);
        $this->FOLLOW_UP->setDbValue($row['FOLLOW_UP']);
        $this->PLACE_TYPE->setDbValue($row['PLACE_TYPE']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->CLINIC_ID_FROM->setDbValue($row['CLINIC_ID_FROM']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->IN_DATE->setDbValue($row['IN_DATE']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->DIANTAR_OLEH->setDbValue($row['DIANTAR_OLEH']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->VISITOR_ADDRESS->setDbValue($row['VISITOR_ADDRESS']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->EMPLOYEE_ID_FROM->setDbValue($row['EMPLOYEE_ID_FROM']);
        $this->RESPONSIBLE_ID->setDbValue($row['RESPONSIBLE_ID']);
        $this->RESPONSIBLE->setDbValue($row['RESPONSIBLE']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->TICKET_NO->setDbValue($row['TICKET_NO']);
        $this->ISATTENDED->setDbValue($row['ISATTENDED']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->ISPERTARIF->setDbValue($row['ISPERTARIF']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->EMPLOYEE_INAP->setDbValue($row['EMPLOYEE_INAP']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->KARYAWAN->setDbValue($row['KARYAWAN']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->CLASS_ID_PLAFOND->setDbValue($row['CLASS_ID_PLAFOND']);
        $this->BACKCHARGE->setDbValue($row['BACKCHARGE']);
        $this->COVERAGE_ID->setDbValue($row['COVERAGE_ID']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->RECOMENDATION->setDbValue($row['RECOMENDATION']);
        $this->CONCLUSION->setDbValue($row['CONCLUSION']);
        $this->SPECIMENNO->setDbValue($row['SPECIMENNO']);
        $this->LOCKED->setDbValue($row['LOCKED']);
        $this->RM_OUT_DATE->setDbValue($row['RM_OUT_DATE']);
        $this->RM_IN_DATE->setDbValue($row['RM_IN_DATE']);
        $this->LAMA_PINJAM->setDbValue($row['LAMA_PINJAM']);
        $this->STANDAR_RJ->setDbValue($row['STANDAR_RJ']);
        $this->LENGKAP_RJ->setDbValue($row['LENGKAP_RJ']);
        $this->LENGKAP_RI->setDbValue($row['LENGKAP_RI']);
        $this->RESEND_RM_DATE->setDbValue($row['RESEND_RM_DATE']);
        $this->LENGKAP_RM1->setDbValue($row['LENGKAP_RM1']);
        $this->LENGKAP_RESUME->setDbValue($row['LENGKAP_RESUME']);
        $this->LENGKAP_ANAMNESIS->setDbValue($row['LENGKAP_ANAMNESIS']);
        $this->LENGKAP_CONSENT->setDbValue($row['LENGKAP_CONSENT']);
        $this->LENGKAP_ANESTESI->setDbValue($row['LENGKAP_ANESTESI']);
        $this->LENGKAP_OP->setDbValue($row['LENGKAP_OP']);
        $this->BACK_RM_DATE->setDbValue($row['BACK_RM_DATE']);
        $this->VALID_RM_DATE->setDbValue($row['VALID_RM_DATE']);
        $this->NO_SKP->setDbValue($row['NO_SKP']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->TICKET_ALL->setDbValue($row['TICKET_ALL']);
        $this->TANGGAL_RUJUKAN->setDbValue($row['TANGGAL_RUJUKAN']);
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

        // STATUS_PASIEN_ID

        // RUJUKAN_ID

        // ADDRESS_OF_RUJUKAN

        // REASON_ID

        // WAY_ID

        // PATIENT_CATEGORY_ID

        // BOOKED_DATE

        // VISIT_DATE

        // ISNEW

        // FOLLOW_UP

        // PLACE_TYPE

        // CLINIC_ID

        // CLINIC_ID_FROM

        // CLASS_ROOM_ID

        // BED_ID

        // KELUAR_ID

        // IN_DATE

        // EXIT_DATE

        // DIANTAR_OLEH

        // GENDER

        // DESCRIPTION

        // VISITOR_ADDRESS

        // MODIFIED_BY

        // MODIFIED_DATE

        // MODIFIED_FROM

        // EMPLOYEE_ID

        // EMPLOYEE_ID_FROM

        // RESPONSIBLE_ID

        // RESPONSIBLE

        // FAMILY_STATUS_ID

        // TICKET_NO

        // ISATTENDED

        // PAYOR_ID

        // CLASS_ID

        // ISPERTARIF

        // KAL_ID

        // EMPLOYEE_INAP

        // PASIEN_ID

        // KARYAWAN

        // ACCOUNT_ID

        // CLASS_ID_PLAFOND

        // BACKCHARGE

        // COVERAGE_ID

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // RECOMENDATION

        // CONCLUSION

        // SPECIMENNO

        // LOCKED

        // RM_OUT_DATE

        // RM_IN_DATE

        // LAMA_PINJAM

        // STANDAR_RJ

        // LENGKAP_RJ

        // LENGKAP_RI

        // RESEND_RM_DATE

        // LENGKAP_RM1

        // LENGKAP_RESUME

        // LENGKAP_ANAMNESIS

        // LENGKAP_CONSENT

        // LENGKAP_ANESTESI

        // LENGKAP_OP

        // BACK_RM_DATE

        // VALID_RM_DATE

        // NO_SKP

        // DIAGNOSA_ID

        // TICKET_ALL

        // TANGGAL_RUJUKAN

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // RUJUKAN_ID
        $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->CurrentValue;
        $this->RUJUKAN_ID->ViewValue = FormatNumber($this->RUJUKAN_ID->ViewValue, 0, -2, -2, -2);
        $this->RUJUKAN_ID->ViewCustomAttributes = "";

        // ADDRESS_OF_RUJUKAN
        $this->ADDRESS_OF_RUJUKAN->ViewValue = $this->ADDRESS_OF_RUJUKAN->CurrentValue;
        $this->ADDRESS_OF_RUJUKAN->ViewCustomAttributes = "";

        // REASON_ID
        $this->REASON_ID->ViewValue = $this->REASON_ID->CurrentValue;
        $this->REASON_ID->ViewValue = FormatNumber($this->REASON_ID->ViewValue, 0, -2, -2, -2);
        $this->REASON_ID->ViewCustomAttributes = "";

        // WAY_ID
        $this->WAY_ID->ViewValue = $this->WAY_ID->CurrentValue;
        $this->WAY_ID->ViewValue = FormatNumber($this->WAY_ID->ViewValue, 0, -2, -2, -2);
        $this->WAY_ID->ViewCustomAttributes = "";

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->CurrentValue;
        $this->PATIENT_CATEGORY_ID->ViewValue = FormatNumber($this->PATIENT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
        $this->PATIENT_CATEGORY_ID->ViewCustomAttributes = "";

        // BOOKED_DATE
        $this->BOOKED_DATE->ViewValue = $this->BOOKED_DATE->CurrentValue;
        $this->BOOKED_DATE->ViewValue = FormatDateTime($this->BOOKED_DATE->ViewValue, 0);
        $this->BOOKED_DATE->ViewCustomAttributes = "";

        // VISIT_DATE
        $this->VISIT_DATE->ViewValue = $this->VISIT_DATE->CurrentValue;
        $this->VISIT_DATE->ViewValue = FormatDateTime($this->VISIT_DATE->ViewValue, 0);
        $this->VISIT_DATE->ViewCustomAttributes = "";

        // ISNEW
        $this->ISNEW->ViewValue = $this->ISNEW->CurrentValue;
        $this->ISNEW->ViewCustomAttributes = "";

        // FOLLOW_UP
        $this->FOLLOW_UP->ViewValue = $this->FOLLOW_UP->CurrentValue;
        $this->FOLLOW_UP->ViewValue = FormatNumber($this->FOLLOW_UP->ViewValue, 0, -2, -2, -2);
        $this->FOLLOW_UP->ViewCustomAttributes = "";

        // PLACE_TYPE
        $this->PLACE_TYPE->ViewValue = $this->PLACE_TYPE->CurrentValue;
        $this->PLACE_TYPE->ViewValue = FormatNumber($this->PLACE_TYPE->ViewValue, 0, -2, -2, -2);
        $this->PLACE_TYPE->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->CurrentValue;
        $this->CLINIC_ID_FROM->ViewCustomAttributes = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

        // BED_ID
        $this->BED_ID->ViewValue = $this->BED_ID->CurrentValue;
        $this->BED_ID->ViewValue = FormatNumber($this->BED_ID->ViewValue, 0, -2, -2, -2);
        $this->BED_ID->ViewCustomAttributes = "";

        // KELUAR_ID
        $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->CurrentValue;
        $this->KELUAR_ID->ViewValue = FormatNumber($this->KELUAR_ID->ViewValue, 0, -2, -2, -2);
        $this->KELUAR_ID->ViewCustomAttributes = "";

        // IN_DATE
        $this->IN_DATE->ViewValue = $this->IN_DATE->CurrentValue;
        $this->IN_DATE->ViewValue = FormatDateTime($this->IN_DATE->ViewValue, 0);
        $this->IN_DATE->ViewCustomAttributes = "";

        // EXIT_DATE
        $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
        $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
        $this->EXIT_DATE->ViewCustomAttributes = "";

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->ViewValue = $this->DIANTAR_OLEH->CurrentValue;
        $this->DIANTAR_OLEH->ViewCustomAttributes = "";

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // VISITOR_ADDRESS
        $this->VISITOR_ADDRESS->ViewValue = $this->VISITOR_ADDRESS->CurrentValue;
        $this->VISITOR_ADDRESS->ViewCustomAttributes = "";

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

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->ViewValue = $this->EMPLOYEE_ID_FROM->CurrentValue;
        $this->EMPLOYEE_ID_FROM->ViewCustomAttributes = "";

        // RESPONSIBLE_ID
        $this->RESPONSIBLE_ID->ViewValue = $this->RESPONSIBLE_ID->CurrentValue;
        $this->RESPONSIBLE_ID->ViewValue = FormatNumber($this->RESPONSIBLE_ID->ViewValue, 0, -2, -2, -2);
        $this->RESPONSIBLE_ID->ViewCustomAttributes = "";

        // RESPONSIBLE
        $this->RESPONSIBLE->ViewValue = $this->RESPONSIBLE->CurrentValue;
        $this->RESPONSIBLE->ViewCustomAttributes = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
        $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

        // TICKET_NO
        $this->TICKET_NO->ViewValue = $this->TICKET_NO->CurrentValue;
        $this->TICKET_NO->ViewValue = FormatNumber($this->TICKET_NO->ViewValue, 0, -2, -2, -2);
        $this->TICKET_NO->ViewCustomAttributes = "";

        // ISATTENDED
        $this->ISATTENDED->ViewValue = $this->ISATTENDED->CurrentValue;
        $this->ISATTENDED->ViewCustomAttributes = "";

        // PAYOR_ID
        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->ViewCustomAttributes = "";

        // CLASS_ID
        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID->ViewCustomAttributes = "";

        // ISPERTARIF
        $this->ISPERTARIF->ViewValue = $this->ISPERTARIF->CurrentValue;
        $this->ISPERTARIF->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // EMPLOYEE_INAP
        $this->EMPLOYEE_INAP->ViewValue = $this->EMPLOYEE_INAP->CurrentValue;
        $this->EMPLOYEE_INAP->ViewCustomAttributes = "";

        // PASIEN_ID
        $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->ViewCustomAttributes = "";

        // KARYAWAN
        $this->KARYAWAN->ViewValue = $this->KARYAWAN->CurrentValue;
        $this->KARYAWAN->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->ViewValue = $this->CLASS_ID_PLAFOND->CurrentValue;
        $this->CLASS_ID_PLAFOND->ViewValue = FormatNumber($this->CLASS_ID_PLAFOND->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID_PLAFOND->ViewCustomAttributes = "";

        // BACKCHARGE
        $this->BACKCHARGE->ViewValue = $this->BACKCHARGE->CurrentValue;
        $this->BACKCHARGE->ViewCustomAttributes = "";

        // COVERAGE_ID
        $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->CurrentValue;
        $this->COVERAGE_ID->ViewValue = FormatNumber($this->COVERAGE_ID->ViewValue, 0, -2, -2, -2);
        $this->COVERAGE_ID->ViewCustomAttributes = "";

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

        // RECOMENDATION
        $this->RECOMENDATION->ViewValue = $this->RECOMENDATION->CurrentValue;
        $this->RECOMENDATION->ViewCustomAttributes = "";

        // CONCLUSION
        $this->CONCLUSION->ViewValue = $this->CONCLUSION->CurrentValue;
        $this->CONCLUSION->ViewCustomAttributes = "";

        // SPECIMENNO
        $this->SPECIMENNO->ViewValue = $this->SPECIMENNO->CurrentValue;
        $this->SPECIMENNO->ViewCustomAttributes = "";

        // LOCKED
        $this->LOCKED->ViewValue = $this->LOCKED->CurrentValue;
        $this->LOCKED->ViewCustomAttributes = "";

        // RM_OUT_DATE
        $this->RM_OUT_DATE->ViewValue = $this->RM_OUT_DATE->CurrentValue;
        $this->RM_OUT_DATE->ViewValue = FormatDateTime($this->RM_OUT_DATE->ViewValue, 0);
        $this->RM_OUT_DATE->ViewCustomAttributes = "";

        // RM_IN_DATE
        $this->RM_IN_DATE->ViewValue = $this->RM_IN_DATE->CurrentValue;
        $this->RM_IN_DATE->ViewValue = FormatDateTime($this->RM_IN_DATE->ViewValue, 0);
        $this->RM_IN_DATE->ViewCustomAttributes = "";

        // LAMA_PINJAM
        $this->LAMA_PINJAM->ViewValue = $this->LAMA_PINJAM->CurrentValue;
        $this->LAMA_PINJAM->ViewValue = FormatDateTime($this->LAMA_PINJAM->ViewValue, 0);
        $this->LAMA_PINJAM->ViewCustomAttributes = "";

        // STANDAR_RJ
        $this->STANDAR_RJ->ViewValue = $this->STANDAR_RJ->CurrentValue;
        $this->STANDAR_RJ->ViewCustomAttributes = "";

        // LENGKAP_RJ
        $this->LENGKAP_RJ->ViewValue = $this->LENGKAP_RJ->CurrentValue;
        $this->LENGKAP_RJ->ViewCustomAttributes = "";

        // LENGKAP_RI
        $this->LENGKAP_RI->ViewValue = $this->LENGKAP_RI->CurrentValue;
        $this->LENGKAP_RI->ViewCustomAttributes = "";

        // RESEND_RM_DATE
        $this->RESEND_RM_DATE->ViewValue = $this->RESEND_RM_DATE->CurrentValue;
        $this->RESEND_RM_DATE->ViewValue = FormatDateTime($this->RESEND_RM_DATE->ViewValue, 0);
        $this->RESEND_RM_DATE->ViewCustomAttributes = "";

        // LENGKAP_RM1
        $this->LENGKAP_RM1->ViewValue = $this->LENGKAP_RM1->CurrentValue;
        $this->LENGKAP_RM1->ViewCustomAttributes = "";

        // LENGKAP_RESUME
        $this->LENGKAP_RESUME->ViewValue = $this->LENGKAP_RESUME->CurrentValue;
        $this->LENGKAP_RESUME->ViewCustomAttributes = "";

        // LENGKAP_ANAMNESIS
        $this->LENGKAP_ANAMNESIS->ViewValue = $this->LENGKAP_ANAMNESIS->CurrentValue;
        $this->LENGKAP_ANAMNESIS->ViewCustomAttributes = "";

        // LENGKAP_CONSENT
        $this->LENGKAP_CONSENT->ViewValue = $this->LENGKAP_CONSENT->CurrentValue;
        $this->LENGKAP_CONSENT->ViewCustomAttributes = "";

        // LENGKAP_ANESTESI
        $this->LENGKAP_ANESTESI->ViewValue = $this->LENGKAP_ANESTESI->CurrentValue;
        $this->LENGKAP_ANESTESI->ViewCustomAttributes = "";

        // LENGKAP_OP
        $this->LENGKAP_OP->ViewValue = $this->LENGKAP_OP->CurrentValue;
        $this->LENGKAP_OP->ViewCustomAttributes = "";

        // BACK_RM_DATE
        $this->BACK_RM_DATE->ViewValue = $this->BACK_RM_DATE->CurrentValue;
        $this->BACK_RM_DATE->ViewValue = FormatDateTime($this->BACK_RM_DATE->ViewValue, 0);
        $this->BACK_RM_DATE->ViewCustomAttributes = "";

        // VALID_RM_DATE
        $this->VALID_RM_DATE->ViewValue = $this->VALID_RM_DATE->CurrentValue;
        $this->VALID_RM_DATE->ViewValue = FormatDateTime($this->VALID_RM_DATE->ViewValue, 0);
        $this->VALID_RM_DATE->ViewCustomAttributes = "";

        // NO_SKP
        $this->NO_SKP->ViewValue = $this->NO_SKP->CurrentValue;
        $this->NO_SKP->ViewCustomAttributes = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->ViewCustomAttributes = "";

        // TICKET_ALL
        $this->TICKET_ALL->ViewValue = $this->TICKET_ALL->CurrentValue;
        $this->TICKET_ALL->ViewValue = FormatNumber($this->TICKET_ALL->ViewValue, 0, -2, -2, -2);
        $this->TICKET_ALL->ViewCustomAttributes = "";

        // TANGGAL_RUJUKAN
        $this->TANGGAL_RUJUKAN->ViewValue = $this->TANGGAL_RUJUKAN->CurrentValue;
        $this->TANGGAL_RUJUKAN->ViewValue = FormatDateTime($this->TANGGAL_RUJUKAN->ViewValue, 0);
        $this->TANGGAL_RUJUKAN->ViewCustomAttributes = "";

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

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // RUJUKAN_ID
        $this->RUJUKAN_ID->LinkCustomAttributes = "";
        $this->RUJUKAN_ID->HrefValue = "";
        $this->RUJUKAN_ID->TooltipValue = "";

        // ADDRESS_OF_RUJUKAN
        $this->ADDRESS_OF_RUJUKAN->LinkCustomAttributes = "";
        $this->ADDRESS_OF_RUJUKAN->HrefValue = "";
        $this->ADDRESS_OF_RUJUKAN->TooltipValue = "";

        // REASON_ID
        $this->REASON_ID->LinkCustomAttributes = "";
        $this->REASON_ID->HrefValue = "";
        $this->REASON_ID->TooltipValue = "";

        // WAY_ID
        $this->WAY_ID->LinkCustomAttributes = "";
        $this->WAY_ID->HrefValue = "";
        $this->WAY_ID->TooltipValue = "";

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->PATIENT_CATEGORY_ID->HrefValue = "";
        $this->PATIENT_CATEGORY_ID->TooltipValue = "";

        // BOOKED_DATE
        $this->BOOKED_DATE->LinkCustomAttributes = "";
        $this->BOOKED_DATE->HrefValue = "";
        $this->BOOKED_DATE->TooltipValue = "";

        // VISIT_DATE
        $this->VISIT_DATE->LinkCustomAttributes = "";
        $this->VISIT_DATE->HrefValue = "";
        $this->VISIT_DATE->TooltipValue = "";

        // ISNEW
        $this->ISNEW->LinkCustomAttributes = "";
        $this->ISNEW->HrefValue = "";
        $this->ISNEW->TooltipValue = "";

        // FOLLOW_UP
        $this->FOLLOW_UP->LinkCustomAttributes = "";
        $this->FOLLOW_UP->HrefValue = "";
        $this->FOLLOW_UP->TooltipValue = "";

        // PLACE_TYPE
        $this->PLACE_TYPE->LinkCustomAttributes = "";
        $this->PLACE_TYPE->HrefValue = "";
        $this->PLACE_TYPE->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->LinkCustomAttributes = "";
        $this->CLINIC_ID_FROM->HrefValue = "";
        $this->CLINIC_ID_FROM->TooltipValue = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
        $this->CLASS_ROOM_ID->HrefValue = "";
        $this->CLASS_ROOM_ID->TooltipValue = "";

        // BED_ID
        $this->BED_ID->LinkCustomAttributes = "";
        $this->BED_ID->HrefValue = "";
        $this->BED_ID->TooltipValue = "";

        // KELUAR_ID
        $this->KELUAR_ID->LinkCustomAttributes = "";
        $this->KELUAR_ID->HrefValue = "";
        $this->KELUAR_ID->TooltipValue = "";

        // IN_DATE
        $this->IN_DATE->LinkCustomAttributes = "";
        $this->IN_DATE->HrefValue = "";
        $this->IN_DATE->TooltipValue = "";

        // EXIT_DATE
        $this->EXIT_DATE->LinkCustomAttributes = "";
        $this->EXIT_DATE->HrefValue = "";
        $this->EXIT_DATE->TooltipValue = "";

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->LinkCustomAttributes = "";
        $this->DIANTAR_OLEH->HrefValue = "";
        $this->DIANTAR_OLEH->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // VISITOR_ADDRESS
        $this->VISITOR_ADDRESS->LinkCustomAttributes = "";
        $this->VISITOR_ADDRESS->HrefValue = "";
        $this->VISITOR_ADDRESS->TooltipValue = "";

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

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID_FROM->HrefValue = "";
        $this->EMPLOYEE_ID_FROM->TooltipValue = "";

        // RESPONSIBLE_ID
        $this->RESPONSIBLE_ID->LinkCustomAttributes = "";
        $this->RESPONSIBLE_ID->HrefValue = "";
        $this->RESPONSIBLE_ID->TooltipValue = "";

        // RESPONSIBLE
        $this->RESPONSIBLE->LinkCustomAttributes = "";
        $this->RESPONSIBLE->HrefValue = "";
        $this->RESPONSIBLE->TooltipValue = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
        $this->FAMILY_STATUS_ID->HrefValue = "";
        $this->FAMILY_STATUS_ID->TooltipValue = "";

        // TICKET_NO
        $this->TICKET_NO->LinkCustomAttributes = "";
        $this->TICKET_NO->HrefValue = "";
        $this->TICKET_NO->TooltipValue = "";

        // ISATTENDED
        $this->ISATTENDED->LinkCustomAttributes = "";
        $this->ISATTENDED->HrefValue = "";
        $this->ISATTENDED->TooltipValue = "";

        // PAYOR_ID
        $this->PAYOR_ID->LinkCustomAttributes = "";
        $this->PAYOR_ID->HrefValue = "";
        $this->PAYOR_ID->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // ISPERTARIF
        $this->ISPERTARIF->LinkCustomAttributes = "";
        $this->ISPERTARIF->HrefValue = "";
        $this->ISPERTARIF->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // EMPLOYEE_INAP
        $this->EMPLOYEE_INAP->LinkCustomAttributes = "";
        $this->EMPLOYEE_INAP->HrefValue = "";
        $this->EMPLOYEE_INAP->TooltipValue = "";

        // PASIEN_ID
        $this->PASIEN_ID->LinkCustomAttributes = "";
        $this->PASIEN_ID->HrefValue = "";
        $this->PASIEN_ID->TooltipValue = "";

        // KARYAWAN
        $this->KARYAWAN->LinkCustomAttributes = "";
        $this->KARYAWAN->HrefValue = "";
        $this->KARYAWAN->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->LinkCustomAttributes = "";
        $this->CLASS_ID_PLAFOND->HrefValue = "";
        $this->CLASS_ID_PLAFOND->TooltipValue = "";

        // BACKCHARGE
        $this->BACKCHARGE->LinkCustomAttributes = "";
        $this->BACKCHARGE->HrefValue = "";
        $this->BACKCHARGE->TooltipValue = "";

        // COVERAGE_ID
        $this->COVERAGE_ID->LinkCustomAttributes = "";
        $this->COVERAGE_ID->HrefValue = "";
        $this->COVERAGE_ID->TooltipValue = "";

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

        // RECOMENDATION
        $this->RECOMENDATION->LinkCustomAttributes = "";
        $this->RECOMENDATION->HrefValue = "";
        $this->RECOMENDATION->TooltipValue = "";

        // CONCLUSION
        $this->CONCLUSION->LinkCustomAttributes = "";
        $this->CONCLUSION->HrefValue = "";
        $this->CONCLUSION->TooltipValue = "";

        // SPECIMENNO
        $this->SPECIMENNO->LinkCustomAttributes = "";
        $this->SPECIMENNO->HrefValue = "";
        $this->SPECIMENNO->TooltipValue = "";

        // LOCKED
        $this->LOCKED->LinkCustomAttributes = "";
        $this->LOCKED->HrefValue = "";
        $this->LOCKED->TooltipValue = "";

        // RM_OUT_DATE
        $this->RM_OUT_DATE->LinkCustomAttributes = "";
        $this->RM_OUT_DATE->HrefValue = "";
        $this->RM_OUT_DATE->TooltipValue = "";

        // RM_IN_DATE
        $this->RM_IN_DATE->LinkCustomAttributes = "";
        $this->RM_IN_DATE->HrefValue = "";
        $this->RM_IN_DATE->TooltipValue = "";

        // LAMA_PINJAM
        $this->LAMA_PINJAM->LinkCustomAttributes = "";
        $this->LAMA_PINJAM->HrefValue = "";
        $this->LAMA_PINJAM->TooltipValue = "";

        // STANDAR_RJ
        $this->STANDAR_RJ->LinkCustomAttributes = "";
        $this->STANDAR_RJ->HrefValue = "";
        $this->STANDAR_RJ->TooltipValue = "";

        // LENGKAP_RJ
        $this->LENGKAP_RJ->LinkCustomAttributes = "";
        $this->LENGKAP_RJ->HrefValue = "";
        $this->LENGKAP_RJ->TooltipValue = "";

        // LENGKAP_RI
        $this->LENGKAP_RI->LinkCustomAttributes = "";
        $this->LENGKAP_RI->HrefValue = "";
        $this->LENGKAP_RI->TooltipValue = "";

        // RESEND_RM_DATE
        $this->RESEND_RM_DATE->LinkCustomAttributes = "";
        $this->RESEND_RM_DATE->HrefValue = "";
        $this->RESEND_RM_DATE->TooltipValue = "";

        // LENGKAP_RM1
        $this->LENGKAP_RM1->LinkCustomAttributes = "";
        $this->LENGKAP_RM1->HrefValue = "";
        $this->LENGKAP_RM1->TooltipValue = "";

        // LENGKAP_RESUME
        $this->LENGKAP_RESUME->LinkCustomAttributes = "";
        $this->LENGKAP_RESUME->HrefValue = "";
        $this->LENGKAP_RESUME->TooltipValue = "";

        // LENGKAP_ANAMNESIS
        $this->LENGKAP_ANAMNESIS->LinkCustomAttributes = "";
        $this->LENGKAP_ANAMNESIS->HrefValue = "";
        $this->LENGKAP_ANAMNESIS->TooltipValue = "";

        // LENGKAP_CONSENT
        $this->LENGKAP_CONSENT->LinkCustomAttributes = "";
        $this->LENGKAP_CONSENT->HrefValue = "";
        $this->LENGKAP_CONSENT->TooltipValue = "";

        // LENGKAP_ANESTESI
        $this->LENGKAP_ANESTESI->LinkCustomAttributes = "";
        $this->LENGKAP_ANESTESI->HrefValue = "";
        $this->LENGKAP_ANESTESI->TooltipValue = "";

        // LENGKAP_OP
        $this->LENGKAP_OP->LinkCustomAttributes = "";
        $this->LENGKAP_OP->HrefValue = "";
        $this->LENGKAP_OP->TooltipValue = "";

        // BACK_RM_DATE
        $this->BACK_RM_DATE->LinkCustomAttributes = "";
        $this->BACK_RM_DATE->HrefValue = "";
        $this->BACK_RM_DATE->TooltipValue = "";

        // VALID_RM_DATE
        $this->VALID_RM_DATE->LinkCustomAttributes = "";
        $this->VALID_RM_DATE->HrefValue = "";
        $this->VALID_RM_DATE->TooltipValue = "";

        // NO_SKP
        $this->NO_SKP->LinkCustomAttributes = "";
        $this->NO_SKP->HrefValue = "";
        $this->NO_SKP->TooltipValue = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID->HrefValue = "";
        $this->DIAGNOSA_ID->TooltipValue = "";

        // TICKET_ALL
        $this->TICKET_ALL->LinkCustomAttributes = "";
        $this->TICKET_ALL->HrefValue = "";
        $this->TICKET_ALL->TooltipValue = "";

        // TANGGAL_RUJUKAN
        $this->TANGGAL_RUJUKAN->LinkCustomAttributes = "";
        $this->TANGGAL_RUJUKAN->HrefValue = "";
        $this->TANGGAL_RUJUKAN->TooltipValue = "";

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

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // RUJUKAN_ID
        $this->RUJUKAN_ID->EditAttrs["class"] = "form-control";
        $this->RUJUKAN_ID->EditCustomAttributes = "";
        $this->RUJUKAN_ID->EditValue = $this->RUJUKAN_ID->CurrentValue;
        $this->RUJUKAN_ID->PlaceHolder = RemoveHtml($this->RUJUKAN_ID->caption());

        // ADDRESS_OF_RUJUKAN
        $this->ADDRESS_OF_RUJUKAN->EditAttrs["class"] = "form-control";
        $this->ADDRESS_OF_RUJUKAN->EditCustomAttributes = "";
        if (!$this->ADDRESS_OF_RUJUKAN->Raw) {
            $this->ADDRESS_OF_RUJUKAN->CurrentValue = HtmlDecode($this->ADDRESS_OF_RUJUKAN->CurrentValue);
        }
        $this->ADDRESS_OF_RUJUKAN->EditValue = $this->ADDRESS_OF_RUJUKAN->CurrentValue;
        $this->ADDRESS_OF_RUJUKAN->PlaceHolder = RemoveHtml($this->ADDRESS_OF_RUJUKAN->caption());

        // REASON_ID
        $this->REASON_ID->EditAttrs["class"] = "form-control";
        $this->REASON_ID->EditCustomAttributes = "";
        $this->REASON_ID->EditValue = $this->REASON_ID->CurrentValue;
        $this->REASON_ID->PlaceHolder = RemoveHtml($this->REASON_ID->caption());

        // WAY_ID
        $this->WAY_ID->EditAttrs["class"] = "form-control";
        $this->WAY_ID->EditCustomAttributes = "";
        $this->WAY_ID->EditValue = $this->WAY_ID->CurrentValue;
        $this->WAY_ID->PlaceHolder = RemoveHtml($this->WAY_ID->caption());

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->PATIENT_CATEGORY_ID->EditCustomAttributes = "";
        $this->PATIENT_CATEGORY_ID->EditValue = $this->PATIENT_CATEGORY_ID->CurrentValue;
        $this->PATIENT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->PATIENT_CATEGORY_ID->caption());

        // BOOKED_DATE
        $this->BOOKED_DATE->EditAttrs["class"] = "form-control";
        $this->BOOKED_DATE->EditCustomAttributes = "";
        $this->BOOKED_DATE->EditValue = FormatDateTime($this->BOOKED_DATE->CurrentValue, 8);
        $this->BOOKED_DATE->PlaceHolder = RemoveHtml($this->BOOKED_DATE->caption());

        // VISIT_DATE
        $this->VISIT_DATE->EditAttrs["class"] = "form-control";
        $this->VISIT_DATE->EditCustomAttributes = "";
        $this->VISIT_DATE->EditValue = FormatDateTime($this->VISIT_DATE->CurrentValue, 8);
        $this->VISIT_DATE->PlaceHolder = RemoveHtml($this->VISIT_DATE->caption());

        // ISNEW
        $this->ISNEW->EditAttrs["class"] = "form-control";
        $this->ISNEW->EditCustomAttributes = "";
        if (!$this->ISNEW->Raw) {
            $this->ISNEW->CurrentValue = HtmlDecode($this->ISNEW->CurrentValue);
        }
        $this->ISNEW->EditValue = $this->ISNEW->CurrentValue;
        $this->ISNEW->PlaceHolder = RemoveHtml($this->ISNEW->caption());

        // FOLLOW_UP
        $this->FOLLOW_UP->EditAttrs["class"] = "form-control";
        $this->FOLLOW_UP->EditCustomAttributes = "";
        $this->FOLLOW_UP->EditValue = $this->FOLLOW_UP->CurrentValue;
        $this->FOLLOW_UP->PlaceHolder = RemoveHtml($this->FOLLOW_UP->caption());

        // PLACE_TYPE
        $this->PLACE_TYPE->EditAttrs["class"] = "form-control";
        $this->PLACE_TYPE->EditCustomAttributes = "";
        $this->PLACE_TYPE->EditValue = $this->PLACE_TYPE->CurrentValue;
        $this->PLACE_TYPE->PlaceHolder = RemoveHtml($this->PLACE_TYPE->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID_FROM->EditCustomAttributes = "";
        if (!$this->CLINIC_ID_FROM->Raw) {
            $this->CLINIC_ID_FROM->CurrentValue = HtmlDecode($this->CLINIC_ID_FROM->CurrentValue);
        }
        $this->CLINIC_ID_FROM->EditValue = $this->CLINIC_ID_FROM->CurrentValue;
        $this->CLINIC_ID_FROM->PlaceHolder = RemoveHtml($this->CLINIC_ID_FROM->caption());

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

        // KELUAR_ID
        $this->KELUAR_ID->EditAttrs["class"] = "form-control";
        $this->KELUAR_ID->EditCustomAttributes = "";
        $this->KELUAR_ID->EditValue = $this->KELUAR_ID->CurrentValue;
        $this->KELUAR_ID->PlaceHolder = RemoveHtml($this->KELUAR_ID->caption());

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

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->EditAttrs["class"] = "form-control";
        $this->DIANTAR_OLEH->EditCustomAttributes = "";
        if (!$this->DIANTAR_OLEH->Raw) {
            $this->DIANTAR_OLEH->CurrentValue = HtmlDecode($this->DIANTAR_OLEH->CurrentValue);
        }
        $this->DIANTAR_OLEH->EditValue = $this->DIANTAR_OLEH->CurrentValue;
        $this->DIANTAR_OLEH->PlaceHolder = RemoveHtml($this->DIANTAR_OLEH->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        if (!$this->GENDER->Raw) {
            $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
        }
        $this->GENDER->EditValue = $this->GENDER->CurrentValue;
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // VISITOR_ADDRESS
        $this->VISITOR_ADDRESS->EditAttrs["class"] = "form-control";
        $this->VISITOR_ADDRESS->EditCustomAttributes = "";
        if (!$this->VISITOR_ADDRESS->Raw) {
            $this->VISITOR_ADDRESS->CurrentValue = HtmlDecode($this->VISITOR_ADDRESS->CurrentValue);
        }
        $this->VISITOR_ADDRESS->EditValue = $this->VISITOR_ADDRESS->CurrentValue;
        $this->VISITOR_ADDRESS->PlaceHolder = RemoveHtml($this->VISITOR_ADDRESS->caption());

        // MODIFIED_BY
        $this->MODIFIED_BY->EditAttrs["class"] = "form-control";
        $this->MODIFIED_BY->EditCustomAttributes = "";
        if (!$this->MODIFIED_BY->Raw) {
            $this->MODIFIED_BY->CurrentValue = HtmlDecode($this->MODIFIED_BY->CurrentValue);
        }
        $this->MODIFIED_BY->EditValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->PlaceHolder = RemoveHtml($this->MODIFIED_BY->caption());

        // MODIFIED_DATE
        $this->MODIFIED_DATE->EditAttrs["class"] = "form-control";
        $this->MODIFIED_DATE->EditCustomAttributes = "";
        $this->MODIFIED_DATE->EditValue = FormatDateTime($this->MODIFIED_DATE->CurrentValue, 8);
        $this->MODIFIED_DATE->PlaceHolder = RemoveHtml($this->MODIFIED_DATE->caption());

        // MODIFIED_FROM
        $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
        $this->MODIFIED_FROM->EditCustomAttributes = "";
        if (!$this->MODIFIED_FROM->Raw) {
            $this->MODIFIED_FROM->CurrentValue = HtmlDecode($this->MODIFIED_FROM->CurrentValue);
        }
        $this->MODIFIED_FROM->EditValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

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

        // RESPONSIBLE_ID
        $this->RESPONSIBLE_ID->EditAttrs["class"] = "form-control";
        $this->RESPONSIBLE_ID->EditCustomAttributes = "";
        $this->RESPONSIBLE_ID->EditValue = $this->RESPONSIBLE_ID->CurrentValue;
        $this->RESPONSIBLE_ID->PlaceHolder = RemoveHtml($this->RESPONSIBLE_ID->caption());

        // RESPONSIBLE
        $this->RESPONSIBLE->EditAttrs["class"] = "form-control";
        $this->RESPONSIBLE->EditCustomAttributes = "";
        if (!$this->RESPONSIBLE->Raw) {
            $this->RESPONSIBLE->CurrentValue = HtmlDecode($this->RESPONSIBLE->CurrentValue);
        }
        $this->RESPONSIBLE->EditValue = $this->RESPONSIBLE->CurrentValue;
        $this->RESPONSIBLE->PlaceHolder = RemoveHtml($this->RESPONSIBLE->caption());

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->EditAttrs["class"] = "form-control";
        $this->FAMILY_STATUS_ID->EditCustomAttributes = "";
        $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->PlaceHolder = RemoveHtml($this->FAMILY_STATUS_ID->caption());

        // TICKET_NO
        $this->TICKET_NO->EditAttrs["class"] = "form-control";
        $this->TICKET_NO->EditCustomAttributes = "";
        $this->TICKET_NO->EditValue = $this->TICKET_NO->CurrentValue;
        $this->TICKET_NO->PlaceHolder = RemoveHtml($this->TICKET_NO->caption());

        // ISATTENDED
        $this->ISATTENDED->EditAttrs["class"] = "form-control";
        $this->ISATTENDED->EditCustomAttributes = "";
        if (!$this->ISATTENDED->Raw) {
            $this->ISATTENDED->CurrentValue = HtmlDecode($this->ISATTENDED->CurrentValue);
        }
        $this->ISATTENDED->EditValue = $this->ISATTENDED->CurrentValue;
        $this->ISATTENDED->PlaceHolder = RemoveHtml($this->ISATTENDED->caption());

        // PAYOR_ID
        $this->PAYOR_ID->EditAttrs["class"] = "form-control";
        $this->PAYOR_ID->EditCustomAttributes = "";
        if (!$this->PAYOR_ID->Raw) {
            $this->PAYOR_ID->CurrentValue = HtmlDecode($this->PAYOR_ID->CurrentValue);
        }
        $this->PAYOR_ID->EditValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->EditValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // ISPERTARIF
        $this->ISPERTARIF->EditAttrs["class"] = "form-control";
        $this->ISPERTARIF->EditCustomAttributes = "";
        if (!$this->ISPERTARIF->Raw) {
            $this->ISPERTARIF->CurrentValue = HtmlDecode($this->ISPERTARIF->CurrentValue);
        }
        $this->ISPERTARIF->EditValue = $this->ISPERTARIF->CurrentValue;
        $this->ISPERTARIF->PlaceHolder = RemoveHtml($this->ISPERTARIF->caption());

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // EMPLOYEE_INAP
        $this->EMPLOYEE_INAP->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_INAP->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_INAP->Raw) {
            $this->EMPLOYEE_INAP->CurrentValue = HtmlDecode($this->EMPLOYEE_INAP->CurrentValue);
        }
        $this->EMPLOYEE_INAP->EditValue = $this->EMPLOYEE_INAP->CurrentValue;
        $this->EMPLOYEE_INAP->PlaceHolder = RemoveHtml($this->EMPLOYEE_INAP->caption());

        // PASIEN_ID
        $this->PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->PASIEN_ID->EditCustomAttributes = "";
        if (!$this->PASIEN_ID->Raw) {
            $this->PASIEN_ID->CurrentValue = HtmlDecode($this->PASIEN_ID->CurrentValue);
        }
        $this->PASIEN_ID->EditValue = $this->PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

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

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->EditAttrs["class"] = "form-control";
        $this->CLASS_ID_PLAFOND->EditCustomAttributes = "";
        $this->CLASS_ID_PLAFOND->EditValue = $this->CLASS_ID_PLAFOND->CurrentValue;
        $this->CLASS_ID_PLAFOND->PlaceHolder = RemoveHtml($this->CLASS_ID_PLAFOND->caption());

        // BACKCHARGE
        $this->BACKCHARGE->EditAttrs["class"] = "form-control";
        $this->BACKCHARGE->EditCustomAttributes = "";
        if (!$this->BACKCHARGE->Raw) {
            $this->BACKCHARGE->CurrentValue = HtmlDecode($this->BACKCHARGE->CurrentValue);
        }
        $this->BACKCHARGE->EditValue = $this->BACKCHARGE->CurrentValue;
        $this->BACKCHARGE->PlaceHolder = RemoveHtml($this->BACKCHARGE->caption());

        // COVERAGE_ID
        $this->COVERAGE_ID->EditAttrs["class"] = "form-control";
        $this->COVERAGE_ID->EditCustomAttributes = "";
        $this->COVERAGE_ID->EditValue = $this->COVERAGE_ID->CurrentValue;
        $this->COVERAGE_ID->PlaceHolder = RemoveHtml($this->COVERAGE_ID->caption());

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

        // RECOMENDATION
        $this->RECOMENDATION->EditAttrs["class"] = "form-control";
        $this->RECOMENDATION->EditCustomAttributes = "";
        if (!$this->RECOMENDATION->Raw) {
            $this->RECOMENDATION->CurrentValue = HtmlDecode($this->RECOMENDATION->CurrentValue);
        }
        $this->RECOMENDATION->EditValue = $this->RECOMENDATION->CurrentValue;
        $this->RECOMENDATION->PlaceHolder = RemoveHtml($this->RECOMENDATION->caption());

        // CONCLUSION
        $this->CONCLUSION->EditAttrs["class"] = "form-control";
        $this->CONCLUSION->EditCustomAttributes = "";
        if (!$this->CONCLUSION->Raw) {
            $this->CONCLUSION->CurrentValue = HtmlDecode($this->CONCLUSION->CurrentValue);
        }
        $this->CONCLUSION->EditValue = $this->CONCLUSION->CurrentValue;
        $this->CONCLUSION->PlaceHolder = RemoveHtml($this->CONCLUSION->caption());

        // SPECIMENNO
        $this->SPECIMENNO->EditAttrs["class"] = "form-control";
        $this->SPECIMENNO->EditCustomAttributes = "";
        if (!$this->SPECIMENNO->Raw) {
            $this->SPECIMENNO->CurrentValue = HtmlDecode($this->SPECIMENNO->CurrentValue);
        }
        $this->SPECIMENNO->EditValue = $this->SPECIMENNO->CurrentValue;
        $this->SPECIMENNO->PlaceHolder = RemoveHtml($this->SPECIMENNO->caption());

        // LOCKED
        $this->LOCKED->EditAttrs["class"] = "form-control";
        $this->LOCKED->EditCustomAttributes = "";
        if (!$this->LOCKED->Raw) {
            $this->LOCKED->CurrentValue = HtmlDecode($this->LOCKED->CurrentValue);
        }
        $this->LOCKED->EditValue = $this->LOCKED->CurrentValue;
        $this->LOCKED->PlaceHolder = RemoveHtml($this->LOCKED->caption());

        // RM_OUT_DATE
        $this->RM_OUT_DATE->EditAttrs["class"] = "form-control";
        $this->RM_OUT_DATE->EditCustomAttributes = "";
        $this->RM_OUT_DATE->EditValue = FormatDateTime($this->RM_OUT_DATE->CurrentValue, 8);
        $this->RM_OUT_DATE->PlaceHolder = RemoveHtml($this->RM_OUT_DATE->caption());

        // RM_IN_DATE
        $this->RM_IN_DATE->EditAttrs["class"] = "form-control";
        $this->RM_IN_DATE->EditCustomAttributes = "";
        $this->RM_IN_DATE->EditValue = FormatDateTime($this->RM_IN_DATE->CurrentValue, 8);
        $this->RM_IN_DATE->PlaceHolder = RemoveHtml($this->RM_IN_DATE->caption());

        // LAMA_PINJAM
        $this->LAMA_PINJAM->EditAttrs["class"] = "form-control";
        $this->LAMA_PINJAM->EditCustomAttributes = "";
        $this->LAMA_PINJAM->EditValue = FormatDateTime($this->LAMA_PINJAM->CurrentValue, 8);
        $this->LAMA_PINJAM->PlaceHolder = RemoveHtml($this->LAMA_PINJAM->caption());

        // STANDAR_RJ
        $this->STANDAR_RJ->EditAttrs["class"] = "form-control";
        $this->STANDAR_RJ->EditCustomAttributes = "";
        if (!$this->STANDAR_RJ->Raw) {
            $this->STANDAR_RJ->CurrentValue = HtmlDecode($this->STANDAR_RJ->CurrentValue);
        }
        $this->STANDAR_RJ->EditValue = $this->STANDAR_RJ->CurrentValue;
        $this->STANDAR_RJ->PlaceHolder = RemoveHtml($this->STANDAR_RJ->caption());

        // LENGKAP_RJ
        $this->LENGKAP_RJ->EditAttrs["class"] = "form-control";
        $this->LENGKAP_RJ->EditCustomAttributes = "";
        if (!$this->LENGKAP_RJ->Raw) {
            $this->LENGKAP_RJ->CurrentValue = HtmlDecode($this->LENGKAP_RJ->CurrentValue);
        }
        $this->LENGKAP_RJ->EditValue = $this->LENGKAP_RJ->CurrentValue;
        $this->LENGKAP_RJ->PlaceHolder = RemoveHtml($this->LENGKAP_RJ->caption());

        // LENGKAP_RI
        $this->LENGKAP_RI->EditAttrs["class"] = "form-control";
        $this->LENGKAP_RI->EditCustomAttributes = "";
        if (!$this->LENGKAP_RI->Raw) {
            $this->LENGKAP_RI->CurrentValue = HtmlDecode($this->LENGKAP_RI->CurrentValue);
        }
        $this->LENGKAP_RI->EditValue = $this->LENGKAP_RI->CurrentValue;
        $this->LENGKAP_RI->PlaceHolder = RemoveHtml($this->LENGKAP_RI->caption());

        // RESEND_RM_DATE
        $this->RESEND_RM_DATE->EditAttrs["class"] = "form-control";
        $this->RESEND_RM_DATE->EditCustomAttributes = "";
        $this->RESEND_RM_DATE->EditValue = FormatDateTime($this->RESEND_RM_DATE->CurrentValue, 8);
        $this->RESEND_RM_DATE->PlaceHolder = RemoveHtml($this->RESEND_RM_DATE->caption());

        // LENGKAP_RM1
        $this->LENGKAP_RM1->EditAttrs["class"] = "form-control";
        $this->LENGKAP_RM1->EditCustomAttributes = "";
        if (!$this->LENGKAP_RM1->Raw) {
            $this->LENGKAP_RM1->CurrentValue = HtmlDecode($this->LENGKAP_RM1->CurrentValue);
        }
        $this->LENGKAP_RM1->EditValue = $this->LENGKAP_RM1->CurrentValue;
        $this->LENGKAP_RM1->PlaceHolder = RemoveHtml($this->LENGKAP_RM1->caption());

        // LENGKAP_RESUME
        $this->LENGKAP_RESUME->EditAttrs["class"] = "form-control";
        $this->LENGKAP_RESUME->EditCustomAttributes = "";
        if (!$this->LENGKAP_RESUME->Raw) {
            $this->LENGKAP_RESUME->CurrentValue = HtmlDecode($this->LENGKAP_RESUME->CurrentValue);
        }
        $this->LENGKAP_RESUME->EditValue = $this->LENGKAP_RESUME->CurrentValue;
        $this->LENGKAP_RESUME->PlaceHolder = RemoveHtml($this->LENGKAP_RESUME->caption());

        // LENGKAP_ANAMNESIS
        $this->LENGKAP_ANAMNESIS->EditAttrs["class"] = "form-control";
        $this->LENGKAP_ANAMNESIS->EditCustomAttributes = "";
        if (!$this->LENGKAP_ANAMNESIS->Raw) {
            $this->LENGKAP_ANAMNESIS->CurrentValue = HtmlDecode($this->LENGKAP_ANAMNESIS->CurrentValue);
        }
        $this->LENGKAP_ANAMNESIS->EditValue = $this->LENGKAP_ANAMNESIS->CurrentValue;
        $this->LENGKAP_ANAMNESIS->PlaceHolder = RemoveHtml($this->LENGKAP_ANAMNESIS->caption());

        // LENGKAP_CONSENT
        $this->LENGKAP_CONSENT->EditAttrs["class"] = "form-control";
        $this->LENGKAP_CONSENT->EditCustomAttributes = "";
        if (!$this->LENGKAP_CONSENT->Raw) {
            $this->LENGKAP_CONSENT->CurrentValue = HtmlDecode($this->LENGKAP_CONSENT->CurrentValue);
        }
        $this->LENGKAP_CONSENT->EditValue = $this->LENGKAP_CONSENT->CurrentValue;
        $this->LENGKAP_CONSENT->PlaceHolder = RemoveHtml($this->LENGKAP_CONSENT->caption());

        // LENGKAP_ANESTESI
        $this->LENGKAP_ANESTESI->EditAttrs["class"] = "form-control";
        $this->LENGKAP_ANESTESI->EditCustomAttributes = "";
        if (!$this->LENGKAP_ANESTESI->Raw) {
            $this->LENGKAP_ANESTESI->CurrentValue = HtmlDecode($this->LENGKAP_ANESTESI->CurrentValue);
        }
        $this->LENGKAP_ANESTESI->EditValue = $this->LENGKAP_ANESTESI->CurrentValue;
        $this->LENGKAP_ANESTESI->PlaceHolder = RemoveHtml($this->LENGKAP_ANESTESI->caption());

        // LENGKAP_OP
        $this->LENGKAP_OP->EditAttrs["class"] = "form-control";
        $this->LENGKAP_OP->EditCustomAttributes = "";
        if (!$this->LENGKAP_OP->Raw) {
            $this->LENGKAP_OP->CurrentValue = HtmlDecode($this->LENGKAP_OP->CurrentValue);
        }
        $this->LENGKAP_OP->EditValue = $this->LENGKAP_OP->CurrentValue;
        $this->LENGKAP_OP->PlaceHolder = RemoveHtml($this->LENGKAP_OP->caption());

        // BACK_RM_DATE
        $this->BACK_RM_DATE->EditAttrs["class"] = "form-control";
        $this->BACK_RM_DATE->EditCustomAttributes = "";
        $this->BACK_RM_DATE->EditValue = FormatDateTime($this->BACK_RM_DATE->CurrentValue, 8);
        $this->BACK_RM_DATE->PlaceHolder = RemoveHtml($this->BACK_RM_DATE->caption());

        // VALID_RM_DATE
        $this->VALID_RM_DATE->EditAttrs["class"] = "form-control";
        $this->VALID_RM_DATE->EditCustomAttributes = "";
        $this->VALID_RM_DATE->EditValue = FormatDateTime($this->VALID_RM_DATE->CurrentValue, 8);
        $this->VALID_RM_DATE->PlaceHolder = RemoveHtml($this->VALID_RM_DATE->caption());

        // NO_SKP
        $this->NO_SKP->EditAttrs["class"] = "form-control";
        $this->NO_SKP->EditCustomAttributes = "";
        if (!$this->NO_SKP->Raw) {
            $this->NO_SKP->CurrentValue = HtmlDecode($this->NO_SKP->CurrentValue);
        }
        $this->NO_SKP->EditValue = $this->NO_SKP->CurrentValue;
        $this->NO_SKP->PlaceHolder = RemoveHtml($this->NO_SKP->caption());

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID->Raw) {
            $this->DIAGNOSA_ID->CurrentValue = HtmlDecode($this->DIAGNOSA_ID->CurrentValue);
        }
        $this->DIAGNOSA_ID->EditValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

        // TICKET_ALL
        $this->TICKET_ALL->EditAttrs["class"] = "form-control";
        $this->TICKET_ALL->EditCustomAttributes = "";
        $this->TICKET_ALL->EditValue = $this->TICKET_ALL->CurrentValue;
        $this->TICKET_ALL->PlaceHolder = RemoveHtml($this->TICKET_ALL->caption());

        // TANGGAL_RUJUKAN
        $this->TANGGAL_RUJUKAN->EditAttrs["class"] = "form-control";
        $this->TANGGAL_RUJUKAN->EditCustomAttributes = "";
        $this->TANGGAL_RUJUKAN->EditValue = FormatDateTime($this->TANGGAL_RUJUKAN->CurrentValue, 8);
        $this->TANGGAL_RUJUKAN->PlaceHolder = RemoveHtml($this->TANGGAL_RUJUKAN->caption());

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
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->RUJUKAN_ID);
                    $doc->exportCaption($this->ADDRESS_OF_RUJUKAN);
                    $doc->exportCaption($this->REASON_ID);
                    $doc->exportCaption($this->WAY_ID);
                    $doc->exportCaption($this->PATIENT_CATEGORY_ID);
                    $doc->exportCaption($this->BOOKED_DATE);
                    $doc->exportCaption($this->VISIT_DATE);
                    $doc->exportCaption($this->ISNEW);
                    $doc->exportCaption($this->FOLLOW_UP);
                    $doc->exportCaption($this->PLACE_TYPE);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->CLINIC_ID_FROM);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->IN_DATE);
                    $doc->exportCaption($this->EXIT_DATE);
                    $doc->exportCaption($this->DIANTAR_OLEH);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->VISITOR_ADDRESS);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID_FROM);
                    $doc->exportCaption($this->RESPONSIBLE_ID);
                    $doc->exportCaption($this->RESPONSIBLE);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->TICKET_NO);
                    $doc->exportCaption($this->ISATTENDED);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->ISPERTARIF);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->EMPLOYEE_INAP);
                    $doc->exportCaption($this->PASIEN_ID);
                    $doc->exportCaption($this->KARYAWAN);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->CLASS_ID_PLAFOND);
                    $doc->exportCaption($this->BACKCHARGE);
                    $doc->exportCaption($this->COVERAGE_ID);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->RECOMENDATION);
                    $doc->exportCaption($this->CONCLUSION);
                    $doc->exportCaption($this->SPECIMENNO);
                    $doc->exportCaption($this->LOCKED);
                    $doc->exportCaption($this->RM_OUT_DATE);
                    $doc->exportCaption($this->RM_IN_DATE);
                    $doc->exportCaption($this->LAMA_PINJAM);
                    $doc->exportCaption($this->STANDAR_RJ);
                    $doc->exportCaption($this->LENGKAP_RJ);
                    $doc->exportCaption($this->LENGKAP_RI);
                    $doc->exportCaption($this->RESEND_RM_DATE);
                    $doc->exportCaption($this->LENGKAP_RM1);
                    $doc->exportCaption($this->LENGKAP_RESUME);
                    $doc->exportCaption($this->LENGKAP_ANAMNESIS);
                    $doc->exportCaption($this->LENGKAP_CONSENT);
                    $doc->exportCaption($this->LENGKAP_ANESTESI);
                    $doc->exportCaption($this->LENGKAP_OP);
                    $doc->exportCaption($this->BACK_RM_DATE);
                    $doc->exportCaption($this->VALID_RM_DATE);
                    $doc->exportCaption($this->NO_SKP);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->TICKET_ALL);
                    $doc->exportCaption($this->TANGGAL_RUJUKAN);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->RUJUKAN_ID);
                    $doc->exportCaption($this->ADDRESS_OF_RUJUKAN);
                    $doc->exportCaption($this->REASON_ID);
                    $doc->exportCaption($this->WAY_ID);
                    $doc->exportCaption($this->PATIENT_CATEGORY_ID);
                    $doc->exportCaption($this->BOOKED_DATE);
                    $doc->exportCaption($this->VISIT_DATE);
                    $doc->exportCaption($this->ISNEW);
                    $doc->exportCaption($this->FOLLOW_UP);
                    $doc->exportCaption($this->PLACE_TYPE);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->CLINIC_ID_FROM);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->IN_DATE);
                    $doc->exportCaption($this->EXIT_DATE);
                    $doc->exportCaption($this->DIANTAR_OLEH);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->VISITOR_ADDRESS);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID_FROM);
                    $doc->exportCaption($this->RESPONSIBLE_ID);
                    $doc->exportCaption($this->RESPONSIBLE);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->TICKET_NO);
                    $doc->exportCaption($this->ISATTENDED);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->ISPERTARIF);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->EMPLOYEE_INAP);
                    $doc->exportCaption($this->PASIEN_ID);
                    $doc->exportCaption($this->KARYAWAN);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->CLASS_ID_PLAFOND);
                    $doc->exportCaption($this->BACKCHARGE);
                    $doc->exportCaption($this->COVERAGE_ID);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->RECOMENDATION);
                    $doc->exportCaption($this->CONCLUSION);
                    $doc->exportCaption($this->SPECIMENNO);
                    $doc->exportCaption($this->LOCKED);
                    $doc->exportCaption($this->RM_OUT_DATE);
                    $doc->exportCaption($this->RM_IN_DATE);
                    $doc->exportCaption($this->LAMA_PINJAM);
                    $doc->exportCaption($this->STANDAR_RJ);
                    $doc->exportCaption($this->LENGKAP_RJ);
                    $doc->exportCaption($this->LENGKAP_RI);
                    $doc->exportCaption($this->RESEND_RM_DATE);
                    $doc->exportCaption($this->LENGKAP_RM1);
                    $doc->exportCaption($this->LENGKAP_RESUME);
                    $doc->exportCaption($this->LENGKAP_ANAMNESIS);
                    $doc->exportCaption($this->LENGKAP_CONSENT);
                    $doc->exportCaption($this->LENGKAP_ANESTESI);
                    $doc->exportCaption($this->LENGKAP_OP);
                    $doc->exportCaption($this->BACK_RM_DATE);
                    $doc->exportCaption($this->VALID_RM_DATE);
                    $doc->exportCaption($this->NO_SKP);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->TICKET_ALL);
                    $doc->exportCaption($this->TANGGAL_RUJUKAN);
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
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->RUJUKAN_ID);
                        $doc->exportField($this->ADDRESS_OF_RUJUKAN);
                        $doc->exportField($this->REASON_ID);
                        $doc->exportField($this->WAY_ID);
                        $doc->exportField($this->PATIENT_CATEGORY_ID);
                        $doc->exportField($this->BOOKED_DATE);
                        $doc->exportField($this->VISIT_DATE);
                        $doc->exportField($this->ISNEW);
                        $doc->exportField($this->FOLLOW_UP);
                        $doc->exportField($this->PLACE_TYPE);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->CLINIC_ID_FROM);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->IN_DATE);
                        $doc->exportField($this->EXIT_DATE);
                        $doc->exportField($this->DIANTAR_OLEH);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->VISITOR_ADDRESS);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->EMPLOYEE_ID_FROM);
                        $doc->exportField($this->RESPONSIBLE_ID);
                        $doc->exportField($this->RESPONSIBLE);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->TICKET_NO);
                        $doc->exportField($this->ISATTENDED);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->ISPERTARIF);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->EMPLOYEE_INAP);
                        $doc->exportField($this->PASIEN_ID);
                        $doc->exportField($this->KARYAWAN);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->CLASS_ID_PLAFOND);
                        $doc->exportField($this->BACKCHARGE);
                        $doc->exportField($this->COVERAGE_ID);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->RECOMENDATION);
                        $doc->exportField($this->CONCLUSION);
                        $doc->exportField($this->SPECIMENNO);
                        $doc->exportField($this->LOCKED);
                        $doc->exportField($this->RM_OUT_DATE);
                        $doc->exportField($this->RM_IN_DATE);
                        $doc->exportField($this->LAMA_PINJAM);
                        $doc->exportField($this->STANDAR_RJ);
                        $doc->exportField($this->LENGKAP_RJ);
                        $doc->exportField($this->LENGKAP_RI);
                        $doc->exportField($this->RESEND_RM_DATE);
                        $doc->exportField($this->LENGKAP_RM1);
                        $doc->exportField($this->LENGKAP_RESUME);
                        $doc->exportField($this->LENGKAP_ANAMNESIS);
                        $doc->exportField($this->LENGKAP_CONSENT);
                        $doc->exportField($this->LENGKAP_ANESTESI);
                        $doc->exportField($this->LENGKAP_OP);
                        $doc->exportField($this->BACK_RM_DATE);
                        $doc->exportField($this->VALID_RM_DATE);
                        $doc->exportField($this->NO_SKP);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->TICKET_ALL);
                        $doc->exportField($this->TANGGAL_RUJUKAN);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->RUJUKAN_ID);
                        $doc->exportField($this->ADDRESS_OF_RUJUKAN);
                        $doc->exportField($this->REASON_ID);
                        $doc->exportField($this->WAY_ID);
                        $doc->exportField($this->PATIENT_CATEGORY_ID);
                        $doc->exportField($this->BOOKED_DATE);
                        $doc->exportField($this->VISIT_DATE);
                        $doc->exportField($this->ISNEW);
                        $doc->exportField($this->FOLLOW_UP);
                        $doc->exportField($this->PLACE_TYPE);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->CLINIC_ID_FROM);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->IN_DATE);
                        $doc->exportField($this->EXIT_DATE);
                        $doc->exportField($this->DIANTAR_OLEH);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->VISITOR_ADDRESS);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->EMPLOYEE_ID_FROM);
                        $doc->exportField($this->RESPONSIBLE_ID);
                        $doc->exportField($this->RESPONSIBLE);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->TICKET_NO);
                        $doc->exportField($this->ISATTENDED);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->ISPERTARIF);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->EMPLOYEE_INAP);
                        $doc->exportField($this->PASIEN_ID);
                        $doc->exportField($this->KARYAWAN);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->CLASS_ID_PLAFOND);
                        $doc->exportField($this->BACKCHARGE);
                        $doc->exportField($this->COVERAGE_ID);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->RECOMENDATION);
                        $doc->exportField($this->CONCLUSION);
                        $doc->exportField($this->SPECIMENNO);
                        $doc->exportField($this->LOCKED);
                        $doc->exportField($this->RM_OUT_DATE);
                        $doc->exportField($this->RM_IN_DATE);
                        $doc->exportField($this->LAMA_PINJAM);
                        $doc->exportField($this->STANDAR_RJ);
                        $doc->exportField($this->LENGKAP_RJ);
                        $doc->exportField($this->LENGKAP_RI);
                        $doc->exportField($this->RESEND_RM_DATE);
                        $doc->exportField($this->LENGKAP_RM1);
                        $doc->exportField($this->LENGKAP_RESUME);
                        $doc->exportField($this->LENGKAP_ANAMNESIS);
                        $doc->exportField($this->LENGKAP_CONSENT);
                        $doc->exportField($this->LENGKAP_ANESTESI);
                        $doc->exportField($this->LENGKAP_OP);
                        $doc->exportField($this->BACK_RM_DATE);
                        $doc->exportField($this->VALID_RM_DATE);
                        $doc->exportField($this->NO_SKP);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->TICKET_ALL);
                        $doc->exportField($this->TANGGAL_RUJUKAN);
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
