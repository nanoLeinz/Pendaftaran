<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for PASIEN_LABORAT
 */
class PasienLaborat extends DbTable
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
    public $VACTINATION_ID;
    public $NO_REGISTRATION;
    public $VISIT_ID;
    public $BILL_ID;
    public $CLINIC_ID;
    public $VALIDATION;
    public $TERLAYANI;
    public $EMPLOYEE_ID;
    public $PATIENT_CATEGORY_ID;
    public $VACTINATION_DATE;
    public $DESCRIPTION;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
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
    public $KAL_ID;
    public $CLASS_ROOM_ID;
    public $BED_ID;
    public $KELUAR_ID;
    public $LED;
    public $HEMATOKRIT;
    public $HB;
    public $ERITRO;
    public $LEUKO;
    public $TROMBO;
    public $RETIKU;
    public $SDIFF;
    public $MASSPDR;
    public $MASSPBK;
    public $RUMPELLEEDE;
    public $DARAHTEPI;
    public $MCV;
    public $MCH;
    public $MCHC;
    public $RDW;
    public $SITBC;
    public $APTT;
    public $FIBRIN;
    public $DIMER;
    public $PT;
    public $GDS;
    public $GDP;
    public $GDPP;
    public $CHLTOT;
    public $TRIGLE;
    public $HDL;
    public $LDL;
    public $URICACID;
    public $UREUM;
    public $CREATIN;
    public $PROTEIN;
    public $ALBUMIN;
    public $GLOBULIN;
    public $BILITOTAL;
    public $BILIDIRECT;
    public $BILIINDIRET;
    public $ALKALIN;
    public $GAMMA;
    public $SGOT;
    public $SGPT;
    public $LDH;
    public $CK;
    public $CKMB;
    public $HBAC;
    public $NATRIUM;
    public $KALIUM;
    public $CHLORID;
    public $CALSIUM;
    public $MAGNESIUM;
    public $AGD;
    public $HBSAG;
    public $ANTIHBS;
    public $VDRL;
    public $ASTO;
    public $CRP;
    public $RHEMOTOID;
    public $WIDAL;
    public $HIV;
    public $DHF;
    public $TORCH;
    public $T3;
    public $T4;
    public $TSH;
    public $TROPONIN;
    public $MALARIA;
    public $CACING;
    public $BTA;
    public $FILARIA;
    public $SCRURET;
    public $SCRVAG;
    public $URINLKP;
    public $FACESLKP;
    public $BTASPT;
    public $BTASPUT;
    public $SPERMA;
    public $pandi;
    public $NARKOBA;
    public $HAMIL;
    public $ACITES;
    public $LCS;
    public $SENDI;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'PASIEN_LABORAT';
        $this->TableName = 'PASIEN_LABORAT';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[PASIEN_LABORAT]";
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
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // VACTINATION_ID
        $this->VACTINATION_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_VACTINATION_ID', 'VACTINATION_ID', '[VACTINATION_ID]', '[VACTINATION_ID]', 200, 50, -1, false, '[VACTINATION_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VACTINATION_ID->IsPrimaryKey = true; // Primary key field
        $this->VACTINATION_ID->Nullable = false; // NOT NULL field
        $this->VACTINATION_ID->Required = true; // Required field
        $this->VACTINATION_ID->Sortable = true; // Allow sort
        $this->VACTINATION_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VACTINATION_ID->Param, "CustomMsg");
        $this->Fields['VACTINATION_ID'] = &$this->VACTINATION_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // BILL_ID
        $this->BILL_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_BILL_ID', 'BILL_ID', '[BILL_ID]', '[BILL_ID]', 200, 50, -1, false, '[BILL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_ID->Sortable = true; // Allow sort
        $this->BILL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_ID->Param, "CustomMsg");
        $this->Fields['BILL_ID'] = &$this->BILL_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // VALIDATION
        $this->VALIDATION = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_VALIDATION', 'VALIDATION', '[VALIDATION]', 'CAST([VALIDATION] AS NVARCHAR)', 17, 1, -1, false, '[VALIDATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VALIDATION->Sortable = true; // Allow sort
        $this->VALIDATION->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->VALIDATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VALIDATION->Param, "CustomMsg");
        $this->Fields['VALIDATION'] = &$this->VALIDATION;

        // TERLAYANI
        $this->TERLAYANI = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_TERLAYANI', 'TERLAYANI', '[TERLAYANI]', 'CAST([TERLAYANI] AS NVARCHAR)', 17, 1, -1, false, '[TERLAYANI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERLAYANI->Sortable = true; // Allow sort
        $this->TERLAYANI->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TERLAYANI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERLAYANI->Param, "CustomMsg");
        $this->Fields['TERLAYANI'] = &$this->TERLAYANI;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_PATIENT_CATEGORY_ID', 'PATIENT_CATEGORY_ID', '[PATIENT_CATEGORY_ID]', 'CAST([PATIENT_CATEGORY_ID] AS NVARCHAR)', 17, 1, -1, false, '[PATIENT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PATIENT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->PATIENT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PATIENT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PATIENT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['PATIENT_CATEGORY_ID'] = &$this->PATIENT_CATEGORY_ID;

        // VACTINATION_DATE
        $this->VACTINATION_DATE = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_VACTINATION_DATE', 'VACTINATION_DATE', '[VACTINATION_DATE]', CastDateFieldForLike("[VACTINATION_DATE]", 0, "DB"), 135, 8, 0, false, '[VACTINATION_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VACTINATION_DATE->Sortable = true; // Allow sort
        $this->VACTINATION_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VACTINATION_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VACTINATION_DATE->Param, "CustomMsg");
        $this->Fields['VACTINATION_DATE'] = &$this->VACTINATION_DATE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // THENAME
        $this->THENAME = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // THEADDRESS
        $this->THEADDRESS = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 150, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEID
        $this->THEID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 50, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = true; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->Fields['THEID'] = &$this->THEID;

        // ISRJ
        $this->ISRJ = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // AGEYEAR
        $this->AGEYEAR = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // GENDER
        $this->GENDER = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // DOCTOR
        $this->DOCTOR = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_DOCTOR', 'DOCTOR', '[DOCTOR]', '[DOCTOR]', 200, 150, -1, false, '[DOCTOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR->Sortable = true; // Allow sort
        $this->DOCTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR->Param, "CustomMsg");
        $this->Fields['DOCTOR'] = &$this->DOCTOR;

        // KAL_ID
        $this->KAL_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 15, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // BED_ID
        $this->BED_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = true; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // KELUAR_ID
        $this->KELUAR_ID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELUAR_ID->Sortable = true; // Allow sort
        $this->KELUAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KELUAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELUAR_ID->Param, "CustomMsg");
        $this->Fields['KELUAR_ID'] = &$this->KELUAR_ID;

        // LED
        $this->LED = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_LED', 'LED', '[LED]', '[LED]', 129, 1, -1, false, '[LED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LED->Sortable = true; // Allow sort
        $this->LED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LED->Param, "CustomMsg");
        $this->Fields['LED'] = &$this->LED;

        // HEMATOKRIT
        $this->HEMATOKRIT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_HEMATOKRIT', 'HEMATOKRIT', '[HEMATOKRIT]', '[HEMATOKRIT]', 129, 1, -1, false, '[HEMATOKRIT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HEMATOKRIT->Sortable = true; // Allow sort
        $this->HEMATOKRIT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HEMATOKRIT->Param, "CustomMsg");
        $this->Fields['HEMATOKRIT'] = &$this->HEMATOKRIT;

        // HB
        $this->HB = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_HB', 'HB', '[HB]', '[HB]', 129, 1, -1, false, '[HB]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HB->Sortable = true; // Allow sort
        $this->HB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HB->Param, "CustomMsg");
        $this->Fields['HB'] = &$this->HB;

        // ERITRO
        $this->ERITRO = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_ERITRO', 'ERITRO', '[ERITRO]', '[ERITRO]', 129, 1, -1, false, '[ERITRO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ERITRO->Sortable = true; // Allow sort
        $this->ERITRO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ERITRO->Param, "CustomMsg");
        $this->Fields['ERITRO'] = &$this->ERITRO;

        // LEUKO
        $this->LEUKO = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_LEUKO', 'LEUKO', '[LEUKO]', '[LEUKO]', 129, 1, -1, false, '[LEUKO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LEUKO->Sortable = true; // Allow sort
        $this->LEUKO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LEUKO->Param, "CustomMsg");
        $this->Fields['LEUKO'] = &$this->LEUKO;

        // TROMBO
        $this->TROMBO = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_TROMBO', 'TROMBO', '[TROMBO]', '[TROMBO]', 129, 1, -1, false, '[TROMBO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TROMBO->Sortable = true; // Allow sort
        $this->TROMBO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TROMBO->Param, "CustomMsg");
        $this->Fields['TROMBO'] = &$this->TROMBO;

        // RETIKU
        $this->RETIKU = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_RETIKU', 'RETIKU', '[RETIKU]', '[RETIKU]', 129, 1, -1, false, '[RETIKU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RETIKU->Sortable = true; // Allow sort
        $this->RETIKU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RETIKU->Param, "CustomMsg");
        $this->Fields['RETIKU'] = &$this->RETIKU;

        // SDIFF
        $this->SDIFF = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_SDIFF', 'SDIFF', '[SDIFF]', '[SDIFF]', 129, 1, -1, false, '[SDIFF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDIFF->Sortable = true; // Allow sort
        $this->SDIFF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDIFF->Param, "CustomMsg");
        $this->Fields['SDIFF'] = &$this->SDIFF;

        // MASSPDR
        $this->MASSPDR = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MASSPDR', 'MASSPDR', '[MASSPDR]', '[MASSPDR]', 129, 1, -1, false, '[MASSPDR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MASSPDR->Sortable = true; // Allow sort
        $this->MASSPDR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MASSPDR->Param, "CustomMsg");
        $this->Fields['MASSPDR'] = &$this->MASSPDR;

        // MASSPBK
        $this->MASSPBK = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MASSPBK', 'MASSPBK', '[MASSPBK]', '[MASSPBK]', 129, 1, -1, false, '[MASSPBK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MASSPBK->Sortable = true; // Allow sort
        $this->MASSPBK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MASSPBK->Param, "CustomMsg");
        $this->Fields['MASSPBK'] = &$this->MASSPBK;

        // RUMPELLEEDE
        $this->RUMPELLEEDE = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_RUMPELLEEDE', 'RUMPELLEEDE', '[RUMPELLEEDE]', '[RUMPELLEEDE]', 129, 1, -1, false, '[RUMPELLEEDE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RUMPELLEEDE->Sortable = true; // Allow sort
        $this->RUMPELLEEDE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RUMPELLEEDE->Param, "CustomMsg");
        $this->Fields['RUMPELLEEDE'] = &$this->RUMPELLEEDE;

        // DARAHTEPI
        $this->DARAHTEPI = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_DARAHTEPI', 'DARAHTEPI', '[DARAHTEPI]', '[DARAHTEPI]', 129, 1, -1, false, '[DARAHTEPI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DARAHTEPI->Sortable = true; // Allow sort
        $this->DARAHTEPI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DARAHTEPI->Param, "CustomMsg");
        $this->Fields['DARAHTEPI'] = &$this->DARAHTEPI;

        // MCV
        $this->MCV = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MCV', 'MCV', '[MCV]', '[MCV]', 129, 1, -1, false, '[MCV]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MCV->Sortable = true; // Allow sort
        $this->MCV->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MCV->Param, "CustomMsg");
        $this->Fields['MCV'] = &$this->MCV;

        // MCH
        $this->MCH = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MCH', 'MCH', '[MCH]', '[MCH]', 129, 1, -1, false, '[MCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MCH->Sortable = true; // Allow sort
        $this->MCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MCH->Param, "CustomMsg");
        $this->Fields['MCH'] = &$this->MCH;

        // MCHC
        $this->MCHC = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MCHC', 'MCHC', '[MCHC]', '[MCHC]', 129, 1, -1, false, '[MCHC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MCHC->Sortable = true; // Allow sort
        $this->MCHC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MCHC->Param, "CustomMsg");
        $this->Fields['MCHC'] = &$this->MCHC;

        // RDW
        $this->RDW = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_RDW', 'RDW', '[RDW]', '[RDW]', 129, 1, -1, false, '[RDW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RDW->Sortable = true; // Allow sort
        $this->RDW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RDW->Param, "CustomMsg");
        $this->Fields['RDW'] = &$this->RDW;

        // SITBC
        $this->SITBC = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_SITBC', 'SITBC', '[SITBC]', '[SITBC]', 129, 1, -1, false, '[SITBC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SITBC->Sortable = true; // Allow sort
        $this->SITBC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SITBC->Param, "CustomMsg");
        $this->Fields['SITBC'] = &$this->SITBC;

        // APTT
        $this->APTT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_APTT', 'APTT', '[APTT]', '[APTT]', 129, 1, -1, false, '[APTT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APTT->Sortable = true; // Allow sort
        $this->APTT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APTT->Param, "CustomMsg");
        $this->Fields['APTT'] = &$this->APTT;

        // FIBRIN
        $this->FIBRIN = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_FIBRIN', 'FIBRIN', '[FIBRIN]', '[FIBRIN]', 129, 1, -1, false, '[FIBRIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FIBRIN->Sortable = true; // Allow sort
        $this->FIBRIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FIBRIN->Param, "CustomMsg");
        $this->Fields['FIBRIN'] = &$this->FIBRIN;

        // DIMER
        $this->DIMER = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_DIMER', 'DIMER', '[DIMER]', '[DIMER]', 129, 1, -1, false, '[DIMER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIMER->Sortable = true; // Allow sort
        $this->DIMER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIMER->Param, "CustomMsg");
        $this->Fields['DIMER'] = &$this->DIMER;

        // PT
        $this->PT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_PT', 'PT', '[PT]', '[PT]', 129, 1, -1, false, '[PT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PT->Sortable = true; // Allow sort
        $this->PT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PT->Param, "CustomMsg");
        $this->Fields['PT'] = &$this->PT;

        // GDS
        $this->GDS = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_GDS', 'GDS', '[GDS]', '[GDS]', 129, 1, -1, false, '[GDS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GDS->Sortable = true; // Allow sort
        $this->GDS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GDS->Param, "CustomMsg");
        $this->Fields['GDS'] = &$this->GDS;

        // GDP
        $this->GDP = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_GDP', 'GDP', '[GDP]', '[GDP]', 129, 1, -1, false, '[GDP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GDP->Sortable = true; // Allow sort
        $this->GDP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GDP->Param, "CustomMsg");
        $this->Fields['GDP'] = &$this->GDP;

        // GDPP
        $this->GDPP = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_GDPP', 'GDPP', '[GDPP]', '[GDPP]', 129, 1, -1, false, '[GDPP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GDPP->Sortable = true; // Allow sort
        $this->GDPP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GDPP->Param, "CustomMsg");
        $this->Fields['GDPP'] = &$this->GDPP;

        // CHLTOT
        $this->CHLTOT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CHLTOT', 'CHLTOT', '[CHLTOT]', '[CHLTOT]', 129, 1, -1, false, '[CHLTOT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CHLTOT->Sortable = true; // Allow sort
        $this->CHLTOT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CHLTOT->Param, "CustomMsg");
        $this->Fields['CHLTOT'] = &$this->CHLTOT;

        // TRIGLE
        $this->TRIGLE = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_TRIGLE', 'TRIGLE', '[TRIGLE]', '[TRIGLE]', 129, 1, -1, false, '[TRIGLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TRIGLE->Sortable = true; // Allow sort
        $this->TRIGLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TRIGLE->Param, "CustomMsg");
        $this->Fields['TRIGLE'] = &$this->TRIGLE;

        // HDL
        $this->HDL = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_HDL', 'HDL', '[HDL]', '[HDL]', 129, 1, -1, false, '[HDL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HDL->Sortable = true; // Allow sort
        $this->HDL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HDL->Param, "CustomMsg");
        $this->Fields['HDL'] = &$this->HDL;

        // LDL
        $this->LDL = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_LDL', 'LDL', '[LDL]', '[LDL]', 129, 1, -1, false, '[LDL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LDL->Sortable = true; // Allow sort
        $this->LDL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LDL->Param, "CustomMsg");
        $this->Fields['LDL'] = &$this->LDL;

        // URICACID
        $this->URICACID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_URICACID', 'URICACID', '[URICACID]', '[URICACID]', 129, 1, -1, false, '[URICACID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->URICACID->Sortable = true; // Allow sort
        $this->URICACID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->URICACID->Param, "CustomMsg");
        $this->Fields['URICACID'] = &$this->URICACID;

        // UREUM
        $this->UREUM = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_UREUM', 'UREUM', '[UREUM]', '[UREUM]', 129, 1, -1, false, '[UREUM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->UREUM->Sortable = true; // Allow sort
        $this->UREUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->UREUM->Param, "CustomMsg");
        $this->Fields['UREUM'] = &$this->UREUM;

        // CREATIN
        $this->CREATIN = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CREATIN', 'CREATIN', '[CREATIN]', '[CREATIN]', 129, 1, -1, false, '[CREATIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CREATIN->Sortable = true; // Allow sort
        $this->CREATIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CREATIN->Param, "CustomMsg");
        $this->Fields['CREATIN'] = &$this->CREATIN;

        // PROTEIN
        $this->PROTEIN = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_PROTEIN', 'PROTEIN', '[PROTEIN]', '[PROTEIN]', 129, 1, -1, false, '[PROTEIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROTEIN->Sortable = true; // Allow sort
        $this->PROTEIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROTEIN->Param, "CustomMsg");
        $this->Fields['PROTEIN'] = &$this->PROTEIN;

        // ALBUMIN
        $this->ALBUMIN = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_ALBUMIN', 'ALBUMIN', '[ALBUMIN]', '[ALBUMIN]', 129, 1, -1, false, '[ALBUMIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ALBUMIN->Sortable = true; // Allow sort
        $this->ALBUMIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ALBUMIN->Param, "CustomMsg");
        $this->Fields['ALBUMIN'] = &$this->ALBUMIN;

        // GLOBULIN
        $this->GLOBULIN = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_GLOBULIN', 'GLOBULIN', '[GLOBULIN]', '[GLOBULIN]', 129, 1, -1, false, '[GLOBULIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GLOBULIN->Sortable = true; // Allow sort
        $this->GLOBULIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GLOBULIN->Param, "CustomMsg");
        $this->Fields['GLOBULIN'] = &$this->GLOBULIN;

        // BILITOTAL
        $this->BILITOTAL = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_BILITOTAL', 'BILITOTAL', '[BILITOTAL]', '[BILITOTAL]', 129, 1, -1, false, '[BILITOTAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILITOTAL->Sortable = true; // Allow sort
        $this->BILITOTAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILITOTAL->Param, "CustomMsg");
        $this->Fields['BILITOTAL'] = &$this->BILITOTAL;

        // BILIDIRECT
        $this->BILIDIRECT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_BILIDIRECT', 'BILIDIRECT', '[BILIDIRECT]', '[BILIDIRECT]', 129, 1, -1, false, '[BILIDIRECT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILIDIRECT->Sortable = true; // Allow sort
        $this->BILIDIRECT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILIDIRECT->Param, "CustomMsg");
        $this->Fields['BILIDIRECT'] = &$this->BILIDIRECT;

        // BILIINDIRET
        $this->BILIINDIRET = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_BILIINDIRET', 'BILIINDIRET', '[BILIINDIRET]', '[BILIINDIRET]', 129, 1, -1, false, '[BILIINDIRET]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILIINDIRET->Sortable = true; // Allow sort
        $this->BILIINDIRET->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILIINDIRET->Param, "CustomMsg");
        $this->Fields['BILIINDIRET'] = &$this->BILIINDIRET;

        // ALKALIN
        $this->ALKALIN = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_ALKALIN', 'ALKALIN', '[ALKALIN]', '[ALKALIN]', 129, 1, -1, false, '[ALKALIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ALKALIN->Sortable = true; // Allow sort
        $this->ALKALIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ALKALIN->Param, "CustomMsg");
        $this->Fields['ALKALIN'] = &$this->ALKALIN;

        // GAMMA
        $this->GAMMA = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_GAMMA', 'GAMMA', '[GAMMA]', '[GAMMA]', 129, 1, -1, false, '[GAMMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GAMMA->Sortable = true; // Allow sort
        $this->GAMMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GAMMA->Param, "CustomMsg");
        $this->Fields['GAMMA'] = &$this->GAMMA;

        // SGOT
        $this->SGOT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_SGOT', 'SGOT', '[SGOT]', '[SGOT]', 129, 1, -1, false, '[SGOT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SGOT->Sortable = true; // Allow sort
        $this->SGOT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SGOT->Param, "CustomMsg");
        $this->Fields['SGOT'] = &$this->SGOT;

        // SGPT
        $this->SGPT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_SGPT', 'SGPT', '[SGPT]', '[SGPT]', 129, 1, -1, false, '[SGPT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SGPT->Sortable = true; // Allow sort
        $this->SGPT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SGPT->Param, "CustomMsg");
        $this->Fields['SGPT'] = &$this->SGPT;

        // LDH
        $this->LDH = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_LDH', 'LDH', '[LDH]', '[LDH]', 129, 1, -1, false, '[LDH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LDH->Sortable = true; // Allow sort
        $this->LDH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LDH->Param, "CustomMsg");
        $this->Fields['LDH'] = &$this->LDH;

        // CK
        $this->CK = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CK', 'CK', '[CK]', '[CK]', 129, 1, -1, false, '[CK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CK->Sortable = true; // Allow sort
        $this->CK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CK->Param, "CustomMsg");
        $this->Fields['CK'] = &$this->CK;

        // CKMB
        $this->CKMB = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CKMB', 'CKMB', '[CKMB]', '[CKMB]', 129, 1, -1, false, '[CKMB]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CKMB->Sortable = true; // Allow sort
        $this->CKMB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CKMB->Param, "CustomMsg");
        $this->Fields['CKMB'] = &$this->CKMB;

        // HBAC
        $this->HBAC = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_HBAC', 'HBAC', '[HBAC]', '[HBAC]', 129, 1, -1, false, '[HBAC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HBAC->Sortable = true; // Allow sort
        $this->HBAC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HBAC->Param, "CustomMsg");
        $this->Fields['HBAC'] = &$this->HBAC;

        // NATRIUM
        $this->NATRIUM = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_NATRIUM', 'NATRIUM', '[NATRIUM]', '[NATRIUM]', 129, 1, -1, false, '[NATRIUM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NATRIUM->Sortable = true; // Allow sort
        $this->NATRIUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NATRIUM->Param, "CustomMsg");
        $this->Fields['NATRIUM'] = &$this->NATRIUM;

        // KALIUM
        $this->KALIUM = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_KALIUM', 'KALIUM', '[KALIUM]', '[KALIUM]', 129, 1, -1, false, '[KALIUM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KALIUM->Sortable = true; // Allow sort
        $this->KALIUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KALIUM->Param, "CustomMsg");
        $this->Fields['KALIUM'] = &$this->KALIUM;

        // CHLORID
        $this->CHLORID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CHLORID', 'CHLORID', '[CHLORID]', '[CHLORID]', 129, 1, -1, false, '[CHLORID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CHLORID->Sortable = true; // Allow sort
        $this->CHLORID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CHLORID->Param, "CustomMsg");
        $this->Fields['CHLORID'] = &$this->CHLORID;

        // CALSIUM
        $this->CALSIUM = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CALSIUM', 'CALSIUM', '[CALSIUM]', '[CALSIUM]', 129, 1, -1, false, '[CALSIUM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CALSIUM->Sortable = true; // Allow sort
        $this->CALSIUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CALSIUM->Param, "CustomMsg");
        $this->Fields['CALSIUM'] = &$this->CALSIUM;

        // MAGNESIUM
        $this->MAGNESIUM = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MAGNESIUM', 'MAGNESIUM', '[MAGNESIUM]', '[MAGNESIUM]', 129, 1, -1, false, '[MAGNESIUM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MAGNESIUM->Sortable = true; // Allow sort
        $this->MAGNESIUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MAGNESIUM->Param, "CustomMsg");
        $this->Fields['MAGNESIUM'] = &$this->MAGNESIUM;

        // AGD
        $this->AGD = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_AGD', 'AGD', '[AGD]', '[AGD]', 129, 1, -1, false, '[AGD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGD->Sortable = true; // Allow sort
        $this->AGD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGD->Param, "CustomMsg");
        $this->Fields['AGD'] = &$this->AGD;

        // HBSAG
        $this->HBSAG = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_HBSAG', 'HBSAG', '[HBSAG]', '[HBSAG]', 129, 1, -1, false, '[HBSAG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HBSAG->Sortable = true; // Allow sort
        $this->HBSAG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HBSAG->Param, "CustomMsg");
        $this->Fields['HBSAG'] = &$this->HBSAG;

        // ANTIHBS
        $this->ANTIHBS = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_ANTIHBS', 'ANTIHBS', '[ANTIHBS]', '[ANTIHBS]', 129, 1, -1, false, '[ANTIHBS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ANTIHBS->Sortable = true; // Allow sort
        $this->ANTIHBS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ANTIHBS->Param, "CustomMsg");
        $this->Fields['ANTIHBS'] = &$this->ANTIHBS;

        // VDRL
        $this->VDRL = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_VDRL', 'VDRL', '[VDRL]', '[VDRL]', 129, 1, -1, false, '[VDRL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VDRL->Sortable = true; // Allow sort
        $this->VDRL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VDRL->Param, "CustomMsg");
        $this->Fields['VDRL'] = &$this->VDRL;

        // ASTO
        $this->ASTO = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_ASTO', 'ASTO', '[ASTO]', '[ASTO]', 129, 1, -1, false, '[ASTO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ASTO->Sortable = true; // Allow sort
        $this->ASTO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ASTO->Param, "CustomMsg");
        $this->Fields['ASTO'] = &$this->ASTO;

        // CRP
        $this->CRP = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CRP', 'CRP', '[CRP]', '[CRP]', 129, 1, -1, false, '[CRP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CRP->Sortable = true; // Allow sort
        $this->CRP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CRP->Param, "CustomMsg");
        $this->Fields['CRP'] = &$this->CRP;

        // RHEMOTOID
        $this->RHEMOTOID = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_RHEMOTOID', 'RHEMOTOID', '[RHEMOTOID]', '[RHEMOTOID]', 129, 1, -1, false, '[RHEMOTOID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RHEMOTOID->Sortable = true; // Allow sort
        $this->RHEMOTOID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RHEMOTOID->Param, "CustomMsg");
        $this->Fields['RHEMOTOID'] = &$this->RHEMOTOID;

        // WIDAL
        $this->WIDAL = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_WIDAL', 'WIDAL', '[WIDAL]', '[WIDAL]', 129, 1, -1, false, '[WIDAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WIDAL->Sortable = true; // Allow sort
        $this->WIDAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WIDAL->Param, "CustomMsg");
        $this->Fields['WIDAL'] = &$this->WIDAL;

        // HIV
        $this->HIV = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_HIV', 'HIV', '[HIV]', '[HIV]', 129, 1, -1, false, '[HIV]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HIV->Sortable = true; // Allow sort
        $this->HIV->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HIV->Param, "CustomMsg");
        $this->Fields['HIV'] = &$this->HIV;

        // DHF
        $this->DHF = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_DHF', 'DHF', '[DHF]', '[DHF]', 129, 1, -1, false, '[DHF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DHF->Sortable = true; // Allow sort
        $this->DHF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DHF->Param, "CustomMsg");
        $this->Fields['DHF'] = &$this->DHF;

        // TORCH
        $this->TORCH = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_TORCH', 'TORCH', '[TORCH]', '[TORCH]', 129, 1, -1, false, '[TORCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TORCH->Sortable = true; // Allow sort
        $this->TORCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TORCH->Param, "CustomMsg");
        $this->Fields['TORCH'] = &$this->TORCH;

        // T3
        $this->T3 = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_T3', 'T3', '[T3]', '[T3]', 129, 1, -1, false, '[T3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->T3->Sortable = true; // Allow sort
        $this->T3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->T3->Param, "CustomMsg");
        $this->Fields['T3'] = &$this->T3;

        // T4
        $this->T4 = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_T4', 'T4', '[T4]', '[T4]', 129, 1, -1, false, '[T4]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->T4->Sortable = true; // Allow sort
        $this->T4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->T4->Param, "CustomMsg");
        $this->Fields['T4'] = &$this->T4;

        // TSH
        $this->TSH = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_TSH', 'TSH', '[TSH]', '[TSH]', 129, 1, -1, false, '[TSH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TSH->Sortable = true; // Allow sort
        $this->TSH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TSH->Param, "CustomMsg");
        $this->Fields['TSH'] = &$this->TSH;

        // TROPONIN
        $this->TROPONIN = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_TROPONIN', 'TROPONIN', '[TROPONIN]', '[TROPONIN]', 129, 1, -1, false, '[TROPONIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TROPONIN->Sortable = true; // Allow sort
        $this->TROPONIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TROPONIN->Param, "CustomMsg");
        $this->Fields['TROPONIN'] = &$this->TROPONIN;

        // MALARIA
        $this->MALARIA = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_MALARIA', 'MALARIA', '[MALARIA]', '[MALARIA]', 129, 1, -1, false, '[MALARIA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MALARIA->Sortable = true; // Allow sort
        $this->MALARIA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MALARIA->Param, "CustomMsg");
        $this->Fields['MALARIA'] = &$this->MALARIA;

        // CACING
        $this->CACING = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_CACING', 'CACING', '[CACING]', '[CACING]', 129, 1, -1, false, '[CACING]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CACING->Sortable = true; // Allow sort
        $this->CACING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CACING->Param, "CustomMsg");
        $this->Fields['CACING'] = &$this->CACING;

        // BTA
        $this->BTA = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_BTA', 'BTA', '[BTA]', '[BTA]', 129, 1, -1, false, '[BTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BTA->Sortable = true; // Allow sort
        $this->BTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BTA->Param, "CustomMsg");
        $this->Fields['BTA'] = &$this->BTA;

        // FILARIA
        $this->FILARIA = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_FILARIA', 'FILARIA', '[FILARIA]', '[FILARIA]', 129, 1, -1, false, '[FILARIA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FILARIA->Sortable = true; // Allow sort
        $this->FILARIA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FILARIA->Param, "CustomMsg");
        $this->Fields['FILARIA'] = &$this->FILARIA;

        // SCRURET
        $this->SCRURET = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_SCRURET', 'SCRURET', '[SCRURET]', '[SCRURET]', 129, 1, -1, false, '[SCRURET]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SCRURET->Sortable = true; // Allow sort
        $this->SCRURET->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SCRURET->Param, "CustomMsg");
        $this->Fields['SCRURET'] = &$this->SCRURET;

        // SCRVAG
        $this->SCRVAG = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_SCRVAG', 'SCRVAG', '[SCRVAG]', '[SCRVAG]', 129, 1, -1, false, '[SCRVAG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SCRVAG->Sortable = true; // Allow sort
        $this->SCRVAG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SCRVAG->Param, "CustomMsg");
        $this->Fields['SCRVAG'] = &$this->SCRVAG;

        // URINLKP
        $this->URINLKP = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_URINLKP', 'URINLKP', '[URINLKP]', '[URINLKP]', 129, 1, -1, false, '[URINLKP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->URINLKP->Sortable = true; // Allow sort
        $this->URINLKP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->URINLKP->Param, "CustomMsg");
        $this->Fields['URINLKP'] = &$this->URINLKP;

        // FACESLKP
        $this->FACESLKP = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_FACESLKP', 'FACESLKP', '[FACESLKP]', '[FACESLKP]', 129, 1, -1, false, '[FACESLKP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FACESLKP->Sortable = true; // Allow sort
        $this->FACESLKP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FACESLKP->Param, "CustomMsg");
        $this->Fields['FACESLKP'] = &$this->FACESLKP;

        // BTASPT
        $this->BTASPT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_BTASPT', 'BTASPT', '[BTASPT]', '[BTASPT]', 129, 1, -1, false, '[BTASPT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BTASPT->Sortable = true; // Allow sort
        $this->BTASPT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BTASPT->Param, "CustomMsg");
        $this->Fields['BTASPT'] = &$this->BTASPT;

        // BTASPUT
        $this->BTASPUT = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_BTASPUT', 'BTASPUT', '[BTASPUT]', '[BTASPUT]', 129, 1, -1, false, '[BTASPUT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BTASPUT->Sortable = true; // Allow sort
        $this->BTASPUT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BTASPUT->Param, "CustomMsg");
        $this->Fields['BTASPUT'] = &$this->BTASPUT;

        // SPERMA
        $this->SPERMA = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_SPERMA', 'SPERMA', '[SPERMA]', '[SPERMA]', 129, 1, -1, false, '[SPERMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPERMA->Sortable = true; // Allow sort
        $this->SPERMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPERMA->Param, "CustomMsg");
        $this->Fields['SPERMA'] = &$this->SPERMA;

        // pandi
        $this->pandi = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_pandi', 'pandi', '[pandi]', '[pandi]', 129, 1, -1, false, '[pandi]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pandi->Sortable = true; // Allow sort
        $this->pandi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pandi->Param, "CustomMsg");
        $this->Fields['pandi'] = &$this->pandi;

        // NARKOBA
        $this->NARKOBA = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_NARKOBA', 'NARKOBA', '[NARKOBA]', '[NARKOBA]', 129, 1, -1, false, '[NARKOBA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NARKOBA->Sortable = true; // Allow sort
        $this->NARKOBA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NARKOBA->Param, "CustomMsg");
        $this->Fields['NARKOBA'] = &$this->NARKOBA;

        // HAMIL
        $this->HAMIL = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_HAMIL', 'HAMIL', '[HAMIL]', '[HAMIL]', 129, 1, -1, false, '[HAMIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HAMIL->Sortable = true; // Allow sort
        $this->HAMIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HAMIL->Param, "CustomMsg");
        $this->Fields['HAMIL'] = &$this->HAMIL;

        // ACITES
        $this->ACITES = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_ACITES', 'ACITES', '[ACITES]', '[ACITES]', 129, 1, -1, false, '[ACITES]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACITES->Sortable = true; // Allow sort
        $this->ACITES->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACITES->Param, "CustomMsg");
        $this->Fields['ACITES'] = &$this->ACITES;

        // LCS
        $this->LCS = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_LCS', 'LCS', '[LCS]', '[LCS]', 129, 1, -1, false, '[LCS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LCS->Sortable = true; // Allow sort
        $this->LCS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LCS->Param, "CustomMsg");
        $this->Fields['LCS'] = &$this->LCS;

        // SENDI
        $this->SENDI = new DbField('PASIEN_LABORAT', 'PASIEN_LABORAT', 'x_SENDI', 'SENDI', '[SENDI]', '[SENDI]', 129, 1, -1, false, '[SENDI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SENDI->Sortable = true; // Allow sort
        $this->SENDI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SENDI->Param, "CustomMsg");
        $this->Fields['SENDI'] = &$this->SENDI;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[PASIEN_LABORAT]";
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
            if (array_key_exists('VACTINATION_ID', $rs)) {
                AddFilter($where, QuotedName('VACTINATION_ID', $this->Dbid) . '=' . QuotedValue($rs['VACTINATION_ID'], $this->VACTINATION_ID->DataType, $this->Dbid));
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
        $this->VACTINATION_ID->DbValue = $row['VACTINATION_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->BILL_ID->DbValue = $row['BILL_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->VALIDATION->DbValue = $row['VALIDATION'];
        $this->TERLAYANI->DbValue = $row['TERLAYANI'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->PATIENT_CATEGORY_ID->DbValue = $row['PATIENT_CATEGORY_ID'];
        $this->VACTINATION_DATE->DbValue = $row['VACTINATION_DATE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
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
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->BED_ID->DbValue = $row['BED_ID'];
        $this->KELUAR_ID->DbValue = $row['KELUAR_ID'];
        $this->LED->DbValue = $row['LED'];
        $this->HEMATOKRIT->DbValue = $row['HEMATOKRIT'];
        $this->HB->DbValue = $row['HB'];
        $this->ERITRO->DbValue = $row['ERITRO'];
        $this->LEUKO->DbValue = $row['LEUKO'];
        $this->TROMBO->DbValue = $row['TROMBO'];
        $this->RETIKU->DbValue = $row['RETIKU'];
        $this->SDIFF->DbValue = $row['SDIFF'];
        $this->MASSPDR->DbValue = $row['MASSPDR'];
        $this->MASSPBK->DbValue = $row['MASSPBK'];
        $this->RUMPELLEEDE->DbValue = $row['RUMPELLEEDE'];
        $this->DARAHTEPI->DbValue = $row['DARAHTEPI'];
        $this->MCV->DbValue = $row['MCV'];
        $this->MCH->DbValue = $row['MCH'];
        $this->MCHC->DbValue = $row['MCHC'];
        $this->RDW->DbValue = $row['RDW'];
        $this->SITBC->DbValue = $row['SITBC'];
        $this->APTT->DbValue = $row['APTT'];
        $this->FIBRIN->DbValue = $row['FIBRIN'];
        $this->DIMER->DbValue = $row['DIMER'];
        $this->PT->DbValue = $row['PT'];
        $this->GDS->DbValue = $row['GDS'];
        $this->GDP->DbValue = $row['GDP'];
        $this->GDPP->DbValue = $row['GDPP'];
        $this->CHLTOT->DbValue = $row['CHLTOT'];
        $this->TRIGLE->DbValue = $row['TRIGLE'];
        $this->HDL->DbValue = $row['HDL'];
        $this->LDL->DbValue = $row['LDL'];
        $this->URICACID->DbValue = $row['URICACID'];
        $this->UREUM->DbValue = $row['UREUM'];
        $this->CREATIN->DbValue = $row['CREATIN'];
        $this->PROTEIN->DbValue = $row['PROTEIN'];
        $this->ALBUMIN->DbValue = $row['ALBUMIN'];
        $this->GLOBULIN->DbValue = $row['GLOBULIN'];
        $this->BILITOTAL->DbValue = $row['BILITOTAL'];
        $this->BILIDIRECT->DbValue = $row['BILIDIRECT'];
        $this->BILIINDIRET->DbValue = $row['BILIINDIRET'];
        $this->ALKALIN->DbValue = $row['ALKALIN'];
        $this->GAMMA->DbValue = $row['GAMMA'];
        $this->SGOT->DbValue = $row['SGOT'];
        $this->SGPT->DbValue = $row['SGPT'];
        $this->LDH->DbValue = $row['LDH'];
        $this->CK->DbValue = $row['CK'];
        $this->CKMB->DbValue = $row['CKMB'];
        $this->HBAC->DbValue = $row['HBAC'];
        $this->NATRIUM->DbValue = $row['NATRIUM'];
        $this->KALIUM->DbValue = $row['KALIUM'];
        $this->CHLORID->DbValue = $row['CHLORID'];
        $this->CALSIUM->DbValue = $row['CALSIUM'];
        $this->MAGNESIUM->DbValue = $row['MAGNESIUM'];
        $this->AGD->DbValue = $row['AGD'];
        $this->HBSAG->DbValue = $row['HBSAG'];
        $this->ANTIHBS->DbValue = $row['ANTIHBS'];
        $this->VDRL->DbValue = $row['VDRL'];
        $this->ASTO->DbValue = $row['ASTO'];
        $this->CRP->DbValue = $row['CRP'];
        $this->RHEMOTOID->DbValue = $row['RHEMOTOID'];
        $this->WIDAL->DbValue = $row['WIDAL'];
        $this->HIV->DbValue = $row['HIV'];
        $this->DHF->DbValue = $row['DHF'];
        $this->TORCH->DbValue = $row['TORCH'];
        $this->T3->DbValue = $row['T3'];
        $this->T4->DbValue = $row['T4'];
        $this->TSH->DbValue = $row['TSH'];
        $this->TROPONIN->DbValue = $row['TROPONIN'];
        $this->MALARIA->DbValue = $row['MALARIA'];
        $this->CACING->DbValue = $row['CACING'];
        $this->BTA->DbValue = $row['BTA'];
        $this->FILARIA->DbValue = $row['FILARIA'];
        $this->SCRURET->DbValue = $row['SCRURET'];
        $this->SCRVAG->DbValue = $row['SCRVAG'];
        $this->URINLKP->DbValue = $row['URINLKP'];
        $this->FACESLKP->DbValue = $row['FACESLKP'];
        $this->BTASPT->DbValue = $row['BTASPT'];
        $this->BTASPUT->DbValue = $row['BTASPUT'];
        $this->SPERMA->DbValue = $row['SPERMA'];
        $this->pandi->DbValue = $row['pandi'];
        $this->NARKOBA->DbValue = $row['NARKOBA'];
        $this->HAMIL->DbValue = $row['HAMIL'];
        $this->ACITES->DbValue = $row['ACITES'];
        $this->LCS->DbValue = $row['LCS'];
        $this->SENDI->DbValue = $row['SENDI'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [VACTINATION_ID] = '@VACTINATION_ID@'";
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
        $val = $current ? $this->VACTINATION_ID->CurrentValue : $this->VACTINATION_ID->OldValue;
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
                $this->VACTINATION_ID->CurrentValue = $keys[1];
            } else {
                $this->VACTINATION_ID->OldValue = $keys[1];
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
            $val = array_key_exists('VACTINATION_ID', $row) ? $row['VACTINATION_ID'] : null;
        } else {
            $val = $this->VACTINATION_ID->OldValue !== null ? $this->VACTINATION_ID->OldValue : $this->VACTINATION_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@VACTINATION_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PasienLaboratList");
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
        if ($pageName == "PasienLaboratView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PasienLaboratEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PasienLaboratAdd") {
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
                return "PasienLaboratView";
            case Config("API_ADD_ACTION"):
                return "PasienLaboratAdd";
            case Config("API_EDIT_ACTION"):
                return "PasienLaboratEdit";
            case Config("API_DELETE_ACTION"):
                return "PasienLaboratDelete";
            case Config("API_LIST_ACTION"):
                return "PasienLaboratList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PasienLaboratList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PasienLaboratView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PasienLaboratView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PasienLaboratAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PasienLaboratAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PasienLaboratEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PasienLaboratAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PasienLaboratDelete", $this->getUrlParm());
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
        $json .= ",VACTINATION_ID:" . JsonEncode($this->VACTINATION_ID->CurrentValue, "string");
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
        if ($this->VACTINATION_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->VACTINATION_ID->CurrentValue);
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
            if (($keyValue = Param("VACTINATION_ID") ?? Route("VACTINATION_ID")) !== null) {
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
                $this->VACTINATION_ID->CurrentValue = $key[1];
            } else {
                $this->VACTINATION_ID->OldValue = $key[1];
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
        $this->VACTINATION_ID->setDbValue($row['VACTINATION_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->VALIDATION->setDbValue($row['VALIDATION']);
        $this->TERLAYANI->setDbValue($row['TERLAYANI']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->PATIENT_CATEGORY_ID->setDbValue($row['PATIENT_CATEGORY_ID']);
        $this->VACTINATION_DATE->setDbValue($row['VACTINATION_DATE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
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
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->LED->setDbValue($row['LED']);
        $this->HEMATOKRIT->setDbValue($row['HEMATOKRIT']);
        $this->HB->setDbValue($row['HB']);
        $this->ERITRO->setDbValue($row['ERITRO']);
        $this->LEUKO->setDbValue($row['LEUKO']);
        $this->TROMBO->setDbValue($row['TROMBO']);
        $this->RETIKU->setDbValue($row['RETIKU']);
        $this->SDIFF->setDbValue($row['SDIFF']);
        $this->MASSPDR->setDbValue($row['MASSPDR']);
        $this->MASSPBK->setDbValue($row['MASSPBK']);
        $this->RUMPELLEEDE->setDbValue($row['RUMPELLEEDE']);
        $this->DARAHTEPI->setDbValue($row['DARAHTEPI']);
        $this->MCV->setDbValue($row['MCV']);
        $this->MCH->setDbValue($row['MCH']);
        $this->MCHC->setDbValue($row['MCHC']);
        $this->RDW->setDbValue($row['RDW']);
        $this->SITBC->setDbValue($row['SITBC']);
        $this->APTT->setDbValue($row['APTT']);
        $this->FIBRIN->setDbValue($row['FIBRIN']);
        $this->DIMER->setDbValue($row['DIMER']);
        $this->PT->setDbValue($row['PT']);
        $this->GDS->setDbValue($row['GDS']);
        $this->GDP->setDbValue($row['GDP']);
        $this->GDPP->setDbValue($row['GDPP']);
        $this->CHLTOT->setDbValue($row['CHLTOT']);
        $this->TRIGLE->setDbValue($row['TRIGLE']);
        $this->HDL->setDbValue($row['HDL']);
        $this->LDL->setDbValue($row['LDL']);
        $this->URICACID->setDbValue($row['URICACID']);
        $this->UREUM->setDbValue($row['UREUM']);
        $this->CREATIN->setDbValue($row['CREATIN']);
        $this->PROTEIN->setDbValue($row['PROTEIN']);
        $this->ALBUMIN->setDbValue($row['ALBUMIN']);
        $this->GLOBULIN->setDbValue($row['GLOBULIN']);
        $this->BILITOTAL->setDbValue($row['BILITOTAL']);
        $this->BILIDIRECT->setDbValue($row['BILIDIRECT']);
        $this->BILIINDIRET->setDbValue($row['BILIINDIRET']);
        $this->ALKALIN->setDbValue($row['ALKALIN']);
        $this->GAMMA->setDbValue($row['GAMMA']);
        $this->SGOT->setDbValue($row['SGOT']);
        $this->SGPT->setDbValue($row['SGPT']);
        $this->LDH->setDbValue($row['LDH']);
        $this->CK->setDbValue($row['CK']);
        $this->CKMB->setDbValue($row['CKMB']);
        $this->HBAC->setDbValue($row['HBAC']);
        $this->NATRIUM->setDbValue($row['NATRIUM']);
        $this->KALIUM->setDbValue($row['KALIUM']);
        $this->CHLORID->setDbValue($row['CHLORID']);
        $this->CALSIUM->setDbValue($row['CALSIUM']);
        $this->MAGNESIUM->setDbValue($row['MAGNESIUM']);
        $this->AGD->setDbValue($row['AGD']);
        $this->HBSAG->setDbValue($row['HBSAG']);
        $this->ANTIHBS->setDbValue($row['ANTIHBS']);
        $this->VDRL->setDbValue($row['VDRL']);
        $this->ASTO->setDbValue($row['ASTO']);
        $this->CRP->setDbValue($row['CRP']);
        $this->RHEMOTOID->setDbValue($row['RHEMOTOID']);
        $this->WIDAL->setDbValue($row['WIDAL']);
        $this->HIV->setDbValue($row['HIV']);
        $this->DHF->setDbValue($row['DHF']);
        $this->TORCH->setDbValue($row['TORCH']);
        $this->T3->setDbValue($row['T3']);
        $this->T4->setDbValue($row['T4']);
        $this->TSH->setDbValue($row['TSH']);
        $this->TROPONIN->setDbValue($row['TROPONIN']);
        $this->MALARIA->setDbValue($row['MALARIA']);
        $this->CACING->setDbValue($row['CACING']);
        $this->BTA->setDbValue($row['BTA']);
        $this->FILARIA->setDbValue($row['FILARIA']);
        $this->SCRURET->setDbValue($row['SCRURET']);
        $this->SCRVAG->setDbValue($row['SCRVAG']);
        $this->URINLKP->setDbValue($row['URINLKP']);
        $this->FACESLKP->setDbValue($row['FACESLKP']);
        $this->BTASPT->setDbValue($row['BTASPT']);
        $this->BTASPUT->setDbValue($row['BTASPUT']);
        $this->SPERMA->setDbValue($row['SPERMA']);
        $this->pandi->setDbValue($row['pandi']);
        $this->NARKOBA->setDbValue($row['NARKOBA']);
        $this->HAMIL->setDbValue($row['HAMIL']);
        $this->ACITES->setDbValue($row['ACITES']);
        $this->LCS->setDbValue($row['LCS']);
        $this->SENDI->setDbValue($row['SENDI']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // VACTINATION_ID

        // NO_REGISTRATION

        // VISIT_ID

        // BILL_ID

        // CLINIC_ID

        // VALIDATION

        // TERLAYANI

        // EMPLOYEE_ID

        // PATIENT_CATEGORY_ID

        // VACTINATION_DATE

        // DESCRIPTION

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

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

        // KAL_ID

        // CLASS_ROOM_ID

        // BED_ID

        // KELUAR_ID

        // LED

        // HEMATOKRIT

        // HB

        // ERITRO

        // LEUKO

        // TROMBO

        // RETIKU

        // SDIFF

        // MASSPDR

        // MASSPBK

        // RUMPELLEEDE

        // DARAHTEPI

        // MCV

        // MCH

        // MCHC

        // RDW

        // SITBC

        // APTT

        // FIBRIN

        // DIMER

        // PT

        // GDS

        // GDP

        // GDPP

        // CHLTOT

        // TRIGLE

        // HDL

        // LDL

        // URICACID

        // UREUM

        // CREATIN

        // PROTEIN

        // ALBUMIN

        // GLOBULIN

        // BILITOTAL

        // BILIDIRECT

        // BILIINDIRET

        // ALKALIN

        // GAMMA

        // SGOT

        // SGPT

        // LDH

        // CK

        // CKMB

        // HBAC

        // NATRIUM

        // KALIUM

        // CHLORID

        // CALSIUM

        // MAGNESIUM

        // AGD

        // HBSAG

        // ANTIHBS

        // VDRL

        // ASTO

        // CRP

        // RHEMOTOID

        // WIDAL

        // HIV

        // DHF

        // TORCH

        // T3

        // T4

        // TSH

        // TROPONIN

        // MALARIA

        // CACING

        // BTA

        // FILARIA

        // SCRURET

        // SCRVAG

        // URINLKP

        // FACESLKP

        // BTASPT

        // BTASPUT

        // SPERMA

        // pandi

        // NARKOBA

        // HAMIL

        // ACITES

        // LCS

        // SENDI

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // VACTINATION_ID
        $this->VACTINATION_ID->ViewValue = $this->VACTINATION_ID->CurrentValue;
        $this->VACTINATION_ID->ViewCustomAttributes = "";

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

        // VALIDATION
        $this->VALIDATION->ViewValue = $this->VALIDATION->CurrentValue;
        $this->VALIDATION->ViewValue = FormatNumber($this->VALIDATION->ViewValue, 0, -2, -2, -2);
        $this->VALIDATION->ViewCustomAttributes = "";

        // TERLAYANI
        $this->TERLAYANI->ViewValue = $this->TERLAYANI->CurrentValue;
        $this->TERLAYANI->ViewValue = FormatNumber($this->TERLAYANI->ViewValue, 0, -2, -2, -2);
        $this->TERLAYANI->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->CurrentValue;
        $this->PATIENT_CATEGORY_ID->ViewValue = FormatNumber($this->PATIENT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
        $this->PATIENT_CATEGORY_ID->ViewCustomAttributes = "";

        // VACTINATION_DATE
        $this->VACTINATION_DATE->ViewValue = $this->VACTINATION_DATE->CurrentValue;
        $this->VACTINATION_DATE->ViewValue = FormatDateTime($this->VACTINATION_DATE->ViewValue, 0);
        $this->VACTINATION_DATE->ViewCustomAttributes = "";

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

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

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

        // LED
        $this->LED->ViewValue = $this->LED->CurrentValue;
        $this->LED->ViewCustomAttributes = "";

        // HEMATOKRIT
        $this->HEMATOKRIT->ViewValue = $this->HEMATOKRIT->CurrentValue;
        $this->HEMATOKRIT->ViewCustomAttributes = "";

        // HB
        $this->HB->ViewValue = $this->HB->CurrentValue;
        $this->HB->ViewCustomAttributes = "";

        // ERITRO
        $this->ERITRO->ViewValue = $this->ERITRO->CurrentValue;
        $this->ERITRO->ViewCustomAttributes = "";

        // LEUKO
        $this->LEUKO->ViewValue = $this->LEUKO->CurrentValue;
        $this->LEUKO->ViewCustomAttributes = "";

        // TROMBO
        $this->TROMBO->ViewValue = $this->TROMBO->CurrentValue;
        $this->TROMBO->ViewCustomAttributes = "";

        // RETIKU
        $this->RETIKU->ViewValue = $this->RETIKU->CurrentValue;
        $this->RETIKU->ViewCustomAttributes = "";

        // SDIFF
        $this->SDIFF->ViewValue = $this->SDIFF->CurrentValue;
        $this->SDIFF->ViewCustomAttributes = "";

        // MASSPDR
        $this->MASSPDR->ViewValue = $this->MASSPDR->CurrentValue;
        $this->MASSPDR->ViewCustomAttributes = "";

        // MASSPBK
        $this->MASSPBK->ViewValue = $this->MASSPBK->CurrentValue;
        $this->MASSPBK->ViewCustomAttributes = "";

        // RUMPELLEEDE
        $this->RUMPELLEEDE->ViewValue = $this->RUMPELLEEDE->CurrentValue;
        $this->RUMPELLEEDE->ViewCustomAttributes = "";

        // DARAHTEPI
        $this->DARAHTEPI->ViewValue = $this->DARAHTEPI->CurrentValue;
        $this->DARAHTEPI->ViewCustomAttributes = "";

        // MCV
        $this->MCV->ViewValue = $this->MCV->CurrentValue;
        $this->MCV->ViewCustomAttributes = "";

        // MCH
        $this->MCH->ViewValue = $this->MCH->CurrentValue;
        $this->MCH->ViewCustomAttributes = "";

        // MCHC
        $this->MCHC->ViewValue = $this->MCHC->CurrentValue;
        $this->MCHC->ViewCustomAttributes = "";

        // RDW
        $this->RDW->ViewValue = $this->RDW->CurrentValue;
        $this->RDW->ViewCustomAttributes = "";

        // SITBC
        $this->SITBC->ViewValue = $this->SITBC->CurrentValue;
        $this->SITBC->ViewCustomAttributes = "";

        // APTT
        $this->APTT->ViewValue = $this->APTT->CurrentValue;
        $this->APTT->ViewCustomAttributes = "";

        // FIBRIN
        $this->FIBRIN->ViewValue = $this->FIBRIN->CurrentValue;
        $this->FIBRIN->ViewCustomAttributes = "";

        // DIMER
        $this->DIMER->ViewValue = $this->DIMER->CurrentValue;
        $this->DIMER->ViewCustomAttributes = "";

        // PT
        $this->PT->ViewValue = $this->PT->CurrentValue;
        $this->PT->ViewCustomAttributes = "";

        // GDS
        $this->GDS->ViewValue = $this->GDS->CurrentValue;
        $this->GDS->ViewCustomAttributes = "";

        // GDP
        $this->GDP->ViewValue = $this->GDP->CurrentValue;
        $this->GDP->ViewCustomAttributes = "";

        // GDPP
        $this->GDPP->ViewValue = $this->GDPP->CurrentValue;
        $this->GDPP->ViewCustomAttributes = "";

        // CHLTOT
        $this->CHLTOT->ViewValue = $this->CHLTOT->CurrentValue;
        $this->CHLTOT->ViewCustomAttributes = "";

        // TRIGLE
        $this->TRIGLE->ViewValue = $this->TRIGLE->CurrentValue;
        $this->TRIGLE->ViewCustomAttributes = "";

        // HDL
        $this->HDL->ViewValue = $this->HDL->CurrentValue;
        $this->HDL->ViewCustomAttributes = "";

        // LDL
        $this->LDL->ViewValue = $this->LDL->CurrentValue;
        $this->LDL->ViewCustomAttributes = "";

        // URICACID
        $this->URICACID->ViewValue = $this->URICACID->CurrentValue;
        $this->URICACID->ViewCustomAttributes = "";

        // UREUM
        $this->UREUM->ViewValue = $this->UREUM->CurrentValue;
        $this->UREUM->ViewCustomAttributes = "";

        // CREATIN
        $this->CREATIN->ViewValue = $this->CREATIN->CurrentValue;
        $this->CREATIN->ViewCustomAttributes = "";

        // PROTEIN
        $this->PROTEIN->ViewValue = $this->PROTEIN->CurrentValue;
        $this->PROTEIN->ViewCustomAttributes = "";

        // ALBUMIN
        $this->ALBUMIN->ViewValue = $this->ALBUMIN->CurrentValue;
        $this->ALBUMIN->ViewCustomAttributes = "";

        // GLOBULIN
        $this->GLOBULIN->ViewValue = $this->GLOBULIN->CurrentValue;
        $this->GLOBULIN->ViewCustomAttributes = "";

        // BILITOTAL
        $this->BILITOTAL->ViewValue = $this->BILITOTAL->CurrentValue;
        $this->BILITOTAL->ViewCustomAttributes = "";

        // BILIDIRECT
        $this->BILIDIRECT->ViewValue = $this->BILIDIRECT->CurrentValue;
        $this->BILIDIRECT->ViewCustomAttributes = "";

        // BILIINDIRET
        $this->BILIINDIRET->ViewValue = $this->BILIINDIRET->CurrentValue;
        $this->BILIINDIRET->ViewCustomAttributes = "";

        // ALKALIN
        $this->ALKALIN->ViewValue = $this->ALKALIN->CurrentValue;
        $this->ALKALIN->ViewCustomAttributes = "";

        // GAMMA
        $this->GAMMA->ViewValue = $this->GAMMA->CurrentValue;
        $this->GAMMA->ViewCustomAttributes = "";

        // SGOT
        $this->SGOT->ViewValue = $this->SGOT->CurrentValue;
        $this->SGOT->ViewCustomAttributes = "";

        // SGPT
        $this->SGPT->ViewValue = $this->SGPT->CurrentValue;
        $this->SGPT->ViewCustomAttributes = "";

        // LDH
        $this->LDH->ViewValue = $this->LDH->CurrentValue;
        $this->LDH->ViewCustomAttributes = "";

        // CK
        $this->CK->ViewValue = $this->CK->CurrentValue;
        $this->CK->ViewCustomAttributes = "";

        // CKMB
        $this->CKMB->ViewValue = $this->CKMB->CurrentValue;
        $this->CKMB->ViewCustomAttributes = "";

        // HBAC
        $this->HBAC->ViewValue = $this->HBAC->CurrentValue;
        $this->HBAC->ViewCustomAttributes = "";

        // NATRIUM
        $this->NATRIUM->ViewValue = $this->NATRIUM->CurrentValue;
        $this->NATRIUM->ViewCustomAttributes = "";

        // KALIUM
        $this->KALIUM->ViewValue = $this->KALIUM->CurrentValue;
        $this->KALIUM->ViewCustomAttributes = "";

        // CHLORID
        $this->CHLORID->ViewValue = $this->CHLORID->CurrentValue;
        $this->CHLORID->ViewCustomAttributes = "";

        // CALSIUM
        $this->CALSIUM->ViewValue = $this->CALSIUM->CurrentValue;
        $this->CALSIUM->ViewCustomAttributes = "";

        // MAGNESIUM
        $this->MAGNESIUM->ViewValue = $this->MAGNESIUM->CurrentValue;
        $this->MAGNESIUM->ViewCustomAttributes = "";

        // AGD
        $this->AGD->ViewValue = $this->AGD->CurrentValue;
        $this->AGD->ViewCustomAttributes = "";

        // HBSAG
        $this->HBSAG->ViewValue = $this->HBSAG->CurrentValue;
        $this->HBSAG->ViewCustomAttributes = "";

        // ANTIHBS
        $this->ANTIHBS->ViewValue = $this->ANTIHBS->CurrentValue;
        $this->ANTIHBS->ViewCustomAttributes = "";

        // VDRL
        $this->VDRL->ViewValue = $this->VDRL->CurrentValue;
        $this->VDRL->ViewCustomAttributes = "";

        // ASTO
        $this->ASTO->ViewValue = $this->ASTO->CurrentValue;
        $this->ASTO->ViewCustomAttributes = "";

        // CRP
        $this->CRP->ViewValue = $this->CRP->CurrentValue;
        $this->CRP->ViewCustomAttributes = "";

        // RHEMOTOID
        $this->RHEMOTOID->ViewValue = $this->RHEMOTOID->CurrentValue;
        $this->RHEMOTOID->ViewCustomAttributes = "";

        // WIDAL
        $this->WIDAL->ViewValue = $this->WIDAL->CurrentValue;
        $this->WIDAL->ViewCustomAttributes = "";

        // HIV
        $this->HIV->ViewValue = $this->HIV->CurrentValue;
        $this->HIV->ViewCustomAttributes = "";

        // DHF
        $this->DHF->ViewValue = $this->DHF->CurrentValue;
        $this->DHF->ViewCustomAttributes = "";

        // TORCH
        $this->TORCH->ViewValue = $this->TORCH->CurrentValue;
        $this->TORCH->ViewCustomAttributes = "";

        // T3
        $this->T3->ViewValue = $this->T3->CurrentValue;
        $this->T3->ViewCustomAttributes = "";

        // T4
        $this->T4->ViewValue = $this->T4->CurrentValue;
        $this->T4->ViewCustomAttributes = "";

        // TSH
        $this->TSH->ViewValue = $this->TSH->CurrentValue;
        $this->TSH->ViewCustomAttributes = "";

        // TROPONIN
        $this->TROPONIN->ViewValue = $this->TROPONIN->CurrentValue;
        $this->TROPONIN->ViewCustomAttributes = "";

        // MALARIA
        $this->MALARIA->ViewValue = $this->MALARIA->CurrentValue;
        $this->MALARIA->ViewCustomAttributes = "";

        // CACING
        $this->CACING->ViewValue = $this->CACING->CurrentValue;
        $this->CACING->ViewCustomAttributes = "";

        // BTA
        $this->BTA->ViewValue = $this->BTA->CurrentValue;
        $this->BTA->ViewCustomAttributes = "";

        // FILARIA
        $this->FILARIA->ViewValue = $this->FILARIA->CurrentValue;
        $this->FILARIA->ViewCustomAttributes = "";

        // SCRURET
        $this->SCRURET->ViewValue = $this->SCRURET->CurrentValue;
        $this->SCRURET->ViewCustomAttributes = "";

        // SCRVAG
        $this->SCRVAG->ViewValue = $this->SCRVAG->CurrentValue;
        $this->SCRVAG->ViewCustomAttributes = "";

        // URINLKP
        $this->URINLKP->ViewValue = $this->URINLKP->CurrentValue;
        $this->URINLKP->ViewCustomAttributes = "";

        // FACESLKP
        $this->FACESLKP->ViewValue = $this->FACESLKP->CurrentValue;
        $this->FACESLKP->ViewCustomAttributes = "";

        // BTASPT
        $this->BTASPT->ViewValue = $this->BTASPT->CurrentValue;
        $this->BTASPT->ViewCustomAttributes = "";

        // BTASPUT
        $this->BTASPUT->ViewValue = $this->BTASPUT->CurrentValue;
        $this->BTASPUT->ViewCustomAttributes = "";

        // SPERMA
        $this->SPERMA->ViewValue = $this->SPERMA->CurrentValue;
        $this->SPERMA->ViewCustomAttributes = "";

        // pandi
        $this->pandi->ViewValue = $this->pandi->CurrentValue;
        $this->pandi->ViewCustomAttributes = "";

        // NARKOBA
        $this->NARKOBA->ViewValue = $this->NARKOBA->CurrentValue;
        $this->NARKOBA->ViewCustomAttributes = "";

        // HAMIL
        $this->HAMIL->ViewValue = $this->HAMIL->CurrentValue;
        $this->HAMIL->ViewCustomAttributes = "";

        // ACITES
        $this->ACITES->ViewValue = $this->ACITES->CurrentValue;
        $this->ACITES->ViewCustomAttributes = "";

        // LCS
        $this->LCS->ViewValue = $this->LCS->CurrentValue;
        $this->LCS->ViewCustomAttributes = "";

        // SENDI
        $this->SENDI->ViewValue = $this->SENDI->CurrentValue;
        $this->SENDI->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // VACTINATION_ID
        $this->VACTINATION_ID->LinkCustomAttributes = "";
        $this->VACTINATION_ID->HrefValue = "";
        $this->VACTINATION_ID->TooltipValue = "";

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

        // VALIDATION
        $this->VALIDATION->LinkCustomAttributes = "";
        $this->VALIDATION->HrefValue = "";
        $this->VALIDATION->TooltipValue = "";

        // TERLAYANI
        $this->TERLAYANI->LinkCustomAttributes = "";
        $this->TERLAYANI->HrefValue = "";
        $this->TERLAYANI->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->PATIENT_CATEGORY_ID->HrefValue = "";
        $this->PATIENT_CATEGORY_ID->TooltipValue = "";

        // VACTINATION_DATE
        $this->VACTINATION_DATE->LinkCustomAttributes = "";
        $this->VACTINATION_DATE->HrefValue = "";
        $this->VACTINATION_DATE->TooltipValue = "";

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

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

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

        // LED
        $this->LED->LinkCustomAttributes = "";
        $this->LED->HrefValue = "";
        $this->LED->TooltipValue = "";

        // HEMATOKRIT
        $this->HEMATOKRIT->LinkCustomAttributes = "";
        $this->HEMATOKRIT->HrefValue = "";
        $this->HEMATOKRIT->TooltipValue = "";

        // HB
        $this->HB->LinkCustomAttributes = "";
        $this->HB->HrefValue = "";
        $this->HB->TooltipValue = "";

        // ERITRO
        $this->ERITRO->LinkCustomAttributes = "";
        $this->ERITRO->HrefValue = "";
        $this->ERITRO->TooltipValue = "";

        // LEUKO
        $this->LEUKO->LinkCustomAttributes = "";
        $this->LEUKO->HrefValue = "";
        $this->LEUKO->TooltipValue = "";

        // TROMBO
        $this->TROMBO->LinkCustomAttributes = "";
        $this->TROMBO->HrefValue = "";
        $this->TROMBO->TooltipValue = "";

        // RETIKU
        $this->RETIKU->LinkCustomAttributes = "";
        $this->RETIKU->HrefValue = "";
        $this->RETIKU->TooltipValue = "";

        // SDIFF
        $this->SDIFF->LinkCustomAttributes = "";
        $this->SDIFF->HrefValue = "";
        $this->SDIFF->TooltipValue = "";

        // MASSPDR
        $this->MASSPDR->LinkCustomAttributes = "";
        $this->MASSPDR->HrefValue = "";
        $this->MASSPDR->TooltipValue = "";

        // MASSPBK
        $this->MASSPBK->LinkCustomAttributes = "";
        $this->MASSPBK->HrefValue = "";
        $this->MASSPBK->TooltipValue = "";

        // RUMPELLEEDE
        $this->RUMPELLEEDE->LinkCustomAttributes = "";
        $this->RUMPELLEEDE->HrefValue = "";
        $this->RUMPELLEEDE->TooltipValue = "";

        // DARAHTEPI
        $this->DARAHTEPI->LinkCustomAttributes = "";
        $this->DARAHTEPI->HrefValue = "";
        $this->DARAHTEPI->TooltipValue = "";

        // MCV
        $this->MCV->LinkCustomAttributes = "";
        $this->MCV->HrefValue = "";
        $this->MCV->TooltipValue = "";

        // MCH
        $this->MCH->LinkCustomAttributes = "";
        $this->MCH->HrefValue = "";
        $this->MCH->TooltipValue = "";

        // MCHC
        $this->MCHC->LinkCustomAttributes = "";
        $this->MCHC->HrefValue = "";
        $this->MCHC->TooltipValue = "";

        // RDW
        $this->RDW->LinkCustomAttributes = "";
        $this->RDW->HrefValue = "";
        $this->RDW->TooltipValue = "";

        // SITBC
        $this->SITBC->LinkCustomAttributes = "";
        $this->SITBC->HrefValue = "";
        $this->SITBC->TooltipValue = "";

        // APTT
        $this->APTT->LinkCustomAttributes = "";
        $this->APTT->HrefValue = "";
        $this->APTT->TooltipValue = "";

        // FIBRIN
        $this->FIBRIN->LinkCustomAttributes = "";
        $this->FIBRIN->HrefValue = "";
        $this->FIBRIN->TooltipValue = "";

        // DIMER
        $this->DIMER->LinkCustomAttributes = "";
        $this->DIMER->HrefValue = "";
        $this->DIMER->TooltipValue = "";

        // PT
        $this->PT->LinkCustomAttributes = "";
        $this->PT->HrefValue = "";
        $this->PT->TooltipValue = "";

        // GDS
        $this->GDS->LinkCustomAttributes = "";
        $this->GDS->HrefValue = "";
        $this->GDS->TooltipValue = "";

        // GDP
        $this->GDP->LinkCustomAttributes = "";
        $this->GDP->HrefValue = "";
        $this->GDP->TooltipValue = "";

        // GDPP
        $this->GDPP->LinkCustomAttributes = "";
        $this->GDPP->HrefValue = "";
        $this->GDPP->TooltipValue = "";

        // CHLTOT
        $this->CHLTOT->LinkCustomAttributes = "";
        $this->CHLTOT->HrefValue = "";
        $this->CHLTOT->TooltipValue = "";

        // TRIGLE
        $this->TRIGLE->LinkCustomAttributes = "";
        $this->TRIGLE->HrefValue = "";
        $this->TRIGLE->TooltipValue = "";

        // HDL
        $this->HDL->LinkCustomAttributes = "";
        $this->HDL->HrefValue = "";
        $this->HDL->TooltipValue = "";

        // LDL
        $this->LDL->LinkCustomAttributes = "";
        $this->LDL->HrefValue = "";
        $this->LDL->TooltipValue = "";

        // URICACID
        $this->URICACID->LinkCustomAttributes = "";
        $this->URICACID->HrefValue = "";
        $this->URICACID->TooltipValue = "";

        // UREUM
        $this->UREUM->LinkCustomAttributes = "";
        $this->UREUM->HrefValue = "";
        $this->UREUM->TooltipValue = "";

        // CREATIN
        $this->CREATIN->LinkCustomAttributes = "";
        $this->CREATIN->HrefValue = "";
        $this->CREATIN->TooltipValue = "";

        // PROTEIN
        $this->PROTEIN->LinkCustomAttributes = "";
        $this->PROTEIN->HrefValue = "";
        $this->PROTEIN->TooltipValue = "";

        // ALBUMIN
        $this->ALBUMIN->LinkCustomAttributes = "";
        $this->ALBUMIN->HrefValue = "";
        $this->ALBUMIN->TooltipValue = "";

        // GLOBULIN
        $this->GLOBULIN->LinkCustomAttributes = "";
        $this->GLOBULIN->HrefValue = "";
        $this->GLOBULIN->TooltipValue = "";

        // BILITOTAL
        $this->BILITOTAL->LinkCustomAttributes = "";
        $this->BILITOTAL->HrefValue = "";
        $this->BILITOTAL->TooltipValue = "";

        // BILIDIRECT
        $this->BILIDIRECT->LinkCustomAttributes = "";
        $this->BILIDIRECT->HrefValue = "";
        $this->BILIDIRECT->TooltipValue = "";

        // BILIINDIRET
        $this->BILIINDIRET->LinkCustomAttributes = "";
        $this->BILIINDIRET->HrefValue = "";
        $this->BILIINDIRET->TooltipValue = "";

        // ALKALIN
        $this->ALKALIN->LinkCustomAttributes = "";
        $this->ALKALIN->HrefValue = "";
        $this->ALKALIN->TooltipValue = "";

        // GAMMA
        $this->GAMMA->LinkCustomAttributes = "";
        $this->GAMMA->HrefValue = "";
        $this->GAMMA->TooltipValue = "";

        // SGOT
        $this->SGOT->LinkCustomAttributes = "";
        $this->SGOT->HrefValue = "";
        $this->SGOT->TooltipValue = "";

        // SGPT
        $this->SGPT->LinkCustomAttributes = "";
        $this->SGPT->HrefValue = "";
        $this->SGPT->TooltipValue = "";

        // LDH
        $this->LDH->LinkCustomAttributes = "";
        $this->LDH->HrefValue = "";
        $this->LDH->TooltipValue = "";

        // CK
        $this->CK->LinkCustomAttributes = "";
        $this->CK->HrefValue = "";
        $this->CK->TooltipValue = "";

        // CKMB
        $this->CKMB->LinkCustomAttributes = "";
        $this->CKMB->HrefValue = "";
        $this->CKMB->TooltipValue = "";

        // HBAC
        $this->HBAC->LinkCustomAttributes = "";
        $this->HBAC->HrefValue = "";
        $this->HBAC->TooltipValue = "";

        // NATRIUM
        $this->NATRIUM->LinkCustomAttributes = "";
        $this->NATRIUM->HrefValue = "";
        $this->NATRIUM->TooltipValue = "";

        // KALIUM
        $this->KALIUM->LinkCustomAttributes = "";
        $this->KALIUM->HrefValue = "";
        $this->KALIUM->TooltipValue = "";

        // CHLORID
        $this->CHLORID->LinkCustomAttributes = "";
        $this->CHLORID->HrefValue = "";
        $this->CHLORID->TooltipValue = "";

        // CALSIUM
        $this->CALSIUM->LinkCustomAttributes = "";
        $this->CALSIUM->HrefValue = "";
        $this->CALSIUM->TooltipValue = "";

        // MAGNESIUM
        $this->MAGNESIUM->LinkCustomAttributes = "";
        $this->MAGNESIUM->HrefValue = "";
        $this->MAGNESIUM->TooltipValue = "";

        // AGD
        $this->AGD->LinkCustomAttributes = "";
        $this->AGD->HrefValue = "";
        $this->AGD->TooltipValue = "";

        // HBSAG
        $this->HBSAG->LinkCustomAttributes = "";
        $this->HBSAG->HrefValue = "";
        $this->HBSAG->TooltipValue = "";

        // ANTIHBS
        $this->ANTIHBS->LinkCustomAttributes = "";
        $this->ANTIHBS->HrefValue = "";
        $this->ANTIHBS->TooltipValue = "";

        // VDRL
        $this->VDRL->LinkCustomAttributes = "";
        $this->VDRL->HrefValue = "";
        $this->VDRL->TooltipValue = "";

        // ASTO
        $this->ASTO->LinkCustomAttributes = "";
        $this->ASTO->HrefValue = "";
        $this->ASTO->TooltipValue = "";

        // CRP
        $this->CRP->LinkCustomAttributes = "";
        $this->CRP->HrefValue = "";
        $this->CRP->TooltipValue = "";

        // RHEMOTOID
        $this->RHEMOTOID->LinkCustomAttributes = "";
        $this->RHEMOTOID->HrefValue = "";
        $this->RHEMOTOID->TooltipValue = "";

        // WIDAL
        $this->WIDAL->LinkCustomAttributes = "";
        $this->WIDAL->HrefValue = "";
        $this->WIDAL->TooltipValue = "";

        // HIV
        $this->HIV->LinkCustomAttributes = "";
        $this->HIV->HrefValue = "";
        $this->HIV->TooltipValue = "";

        // DHF
        $this->DHF->LinkCustomAttributes = "";
        $this->DHF->HrefValue = "";
        $this->DHF->TooltipValue = "";

        // TORCH
        $this->TORCH->LinkCustomAttributes = "";
        $this->TORCH->HrefValue = "";
        $this->TORCH->TooltipValue = "";

        // T3
        $this->T3->LinkCustomAttributes = "";
        $this->T3->HrefValue = "";
        $this->T3->TooltipValue = "";

        // T4
        $this->T4->LinkCustomAttributes = "";
        $this->T4->HrefValue = "";
        $this->T4->TooltipValue = "";

        // TSH
        $this->TSH->LinkCustomAttributes = "";
        $this->TSH->HrefValue = "";
        $this->TSH->TooltipValue = "";

        // TROPONIN
        $this->TROPONIN->LinkCustomAttributes = "";
        $this->TROPONIN->HrefValue = "";
        $this->TROPONIN->TooltipValue = "";

        // MALARIA
        $this->MALARIA->LinkCustomAttributes = "";
        $this->MALARIA->HrefValue = "";
        $this->MALARIA->TooltipValue = "";

        // CACING
        $this->CACING->LinkCustomAttributes = "";
        $this->CACING->HrefValue = "";
        $this->CACING->TooltipValue = "";

        // BTA
        $this->BTA->LinkCustomAttributes = "";
        $this->BTA->HrefValue = "";
        $this->BTA->TooltipValue = "";

        // FILARIA
        $this->FILARIA->LinkCustomAttributes = "";
        $this->FILARIA->HrefValue = "";
        $this->FILARIA->TooltipValue = "";

        // SCRURET
        $this->SCRURET->LinkCustomAttributes = "";
        $this->SCRURET->HrefValue = "";
        $this->SCRURET->TooltipValue = "";

        // SCRVAG
        $this->SCRVAG->LinkCustomAttributes = "";
        $this->SCRVAG->HrefValue = "";
        $this->SCRVAG->TooltipValue = "";

        // URINLKP
        $this->URINLKP->LinkCustomAttributes = "";
        $this->URINLKP->HrefValue = "";
        $this->URINLKP->TooltipValue = "";

        // FACESLKP
        $this->FACESLKP->LinkCustomAttributes = "";
        $this->FACESLKP->HrefValue = "";
        $this->FACESLKP->TooltipValue = "";

        // BTASPT
        $this->BTASPT->LinkCustomAttributes = "";
        $this->BTASPT->HrefValue = "";
        $this->BTASPT->TooltipValue = "";

        // BTASPUT
        $this->BTASPUT->LinkCustomAttributes = "";
        $this->BTASPUT->HrefValue = "";
        $this->BTASPUT->TooltipValue = "";

        // SPERMA
        $this->SPERMA->LinkCustomAttributes = "";
        $this->SPERMA->HrefValue = "";
        $this->SPERMA->TooltipValue = "";

        // pandi
        $this->pandi->LinkCustomAttributes = "";
        $this->pandi->HrefValue = "";
        $this->pandi->TooltipValue = "";

        // NARKOBA
        $this->NARKOBA->LinkCustomAttributes = "";
        $this->NARKOBA->HrefValue = "";
        $this->NARKOBA->TooltipValue = "";

        // HAMIL
        $this->HAMIL->LinkCustomAttributes = "";
        $this->HAMIL->HrefValue = "";
        $this->HAMIL->TooltipValue = "";

        // ACITES
        $this->ACITES->LinkCustomAttributes = "";
        $this->ACITES->HrefValue = "";
        $this->ACITES->TooltipValue = "";

        // LCS
        $this->LCS->LinkCustomAttributes = "";
        $this->LCS->HrefValue = "";
        $this->LCS->TooltipValue = "";

        // SENDI
        $this->SENDI->LinkCustomAttributes = "";
        $this->SENDI->HrefValue = "";
        $this->SENDI->TooltipValue = "";

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

        // VACTINATION_ID
        $this->VACTINATION_ID->EditAttrs["class"] = "form-control";
        $this->VACTINATION_ID->EditCustomAttributes = "";
        if (!$this->VACTINATION_ID->Raw) {
            $this->VACTINATION_ID->CurrentValue = HtmlDecode($this->VACTINATION_ID->CurrentValue);
        }
        $this->VACTINATION_ID->EditValue = $this->VACTINATION_ID->CurrentValue;
        $this->VACTINATION_ID->PlaceHolder = RemoveHtml($this->VACTINATION_ID->caption());

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

        // VALIDATION
        $this->VALIDATION->EditAttrs["class"] = "form-control";
        $this->VALIDATION->EditCustomAttributes = "";
        $this->VALIDATION->EditValue = $this->VALIDATION->CurrentValue;
        $this->VALIDATION->PlaceHolder = RemoveHtml($this->VALIDATION->caption());

        // TERLAYANI
        $this->TERLAYANI->EditAttrs["class"] = "form-control";
        $this->TERLAYANI->EditCustomAttributes = "";
        $this->TERLAYANI->EditValue = $this->TERLAYANI->CurrentValue;
        $this->TERLAYANI->PlaceHolder = RemoveHtml($this->TERLAYANI->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->PATIENT_CATEGORY_ID->EditCustomAttributes = "";
        $this->PATIENT_CATEGORY_ID->EditValue = $this->PATIENT_CATEGORY_ID->CurrentValue;
        $this->PATIENT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->PATIENT_CATEGORY_ID->caption());

        // VACTINATION_DATE
        $this->VACTINATION_DATE->EditAttrs["class"] = "form-control";
        $this->VACTINATION_DATE->EditCustomAttributes = "";
        $this->VACTINATION_DATE->EditValue = FormatDateTime($this->VACTINATION_DATE->CurrentValue, 8);
        $this->VACTINATION_DATE->PlaceHolder = RemoveHtml($this->VACTINATION_DATE->caption());

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

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

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

        // LED
        $this->LED->EditAttrs["class"] = "form-control";
        $this->LED->EditCustomAttributes = "";
        if (!$this->LED->Raw) {
            $this->LED->CurrentValue = HtmlDecode($this->LED->CurrentValue);
        }
        $this->LED->EditValue = $this->LED->CurrentValue;
        $this->LED->PlaceHolder = RemoveHtml($this->LED->caption());

        // HEMATOKRIT
        $this->HEMATOKRIT->EditAttrs["class"] = "form-control";
        $this->HEMATOKRIT->EditCustomAttributes = "";
        if (!$this->HEMATOKRIT->Raw) {
            $this->HEMATOKRIT->CurrentValue = HtmlDecode($this->HEMATOKRIT->CurrentValue);
        }
        $this->HEMATOKRIT->EditValue = $this->HEMATOKRIT->CurrentValue;
        $this->HEMATOKRIT->PlaceHolder = RemoveHtml($this->HEMATOKRIT->caption());

        // HB
        $this->HB->EditAttrs["class"] = "form-control";
        $this->HB->EditCustomAttributes = "";
        if (!$this->HB->Raw) {
            $this->HB->CurrentValue = HtmlDecode($this->HB->CurrentValue);
        }
        $this->HB->EditValue = $this->HB->CurrentValue;
        $this->HB->PlaceHolder = RemoveHtml($this->HB->caption());

        // ERITRO
        $this->ERITRO->EditAttrs["class"] = "form-control";
        $this->ERITRO->EditCustomAttributes = "";
        if (!$this->ERITRO->Raw) {
            $this->ERITRO->CurrentValue = HtmlDecode($this->ERITRO->CurrentValue);
        }
        $this->ERITRO->EditValue = $this->ERITRO->CurrentValue;
        $this->ERITRO->PlaceHolder = RemoveHtml($this->ERITRO->caption());

        // LEUKO
        $this->LEUKO->EditAttrs["class"] = "form-control";
        $this->LEUKO->EditCustomAttributes = "";
        if (!$this->LEUKO->Raw) {
            $this->LEUKO->CurrentValue = HtmlDecode($this->LEUKO->CurrentValue);
        }
        $this->LEUKO->EditValue = $this->LEUKO->CurrentValue;
        $this->LEUKO->PlaceHolder = RemoveHtml($this->LEUKO->caption());

        // TROMBO
        $this->TROMBO->EditAttrs["class"] = "form-control";
        $this->TROMBO->EditCustomAttributes = "";
        if (!$this->TROMBO->Raw) {
            $this->TROMBO->CurrentValue = HtmlDecode($this->TROMBO->CurrentValue);
        }
        $this->TROMBO->EditValue = $this->TROMBO->CurrentValue;
        $this->TROMBO->PlaceHolder = RemoveHtml($this->TROMBO->caption());

        // RETIKU
        $this->RETIKU->EditAttrs["class"] = "form-control";
        $this->RETIKU->EditCustomAttributes = "";
        if (!$this->RETIKU->Raw) {
            $this->RETIKU->CurrentValue = HtmlDecode($this->RETIKU->CurrentValue);
        }
        $this->RETIKU->EditValue = $this->RETIKU->CurrentValue;
        $this->RETIKU->PlaceHolder = RemoveHtml($this->RETIKU->caption());

        // SDIFF
        $this->SDIFF->EditAttrs["class"] = "form-control";
        $this->SDIFF->EditCustomAttributes = "";
        if (!$this->SDIFF->Raw) {
            $this->SDIFF->CurrentValue = HtmlDecode($this->SDIFF->CurrentValue);
        }
        $this->SDIFF->EditValue = $this->SDIFF->CurrentValue;
        $this->SDIFF->PlaceHolder = RemoveHtml($this->SDIFF->caption());

        // MASSPDR
        $this->MASSPDR->EditAttrs["class"] = "form-control";
        $this->MASSPDR->EditCustomAttributes = "";
        if (!$this->MASSPDR->Raw) {
            $this->MASSPDR->CurrentValue = HtmlDecode($this->MASSPDR->CurrentValue);
        }
        $this->MASSPDR->EditValue = $this->MASSPDR->CurrentValue;
        $this->MASSPDR->PlaceHolder = RemoveHtml($this->MASSPDR->caption());

        // MASSPBK
        $this->MASSPBK->EditAttrs["class"] = "form-control";
        $this->MASSPBK->EditCustomAttributes = "";
        if (!$this->MASSPBK->Raw) {
            $this->MASSPBK->CurrentValue = HtmlDecode($this->MASSPBK->CurrentValue);
        }
        $this->MASSPBK->EditValue = $this->MASSPBK->CurrentValue;
        $this->MASSPBK->PlaceHolder = RemoveHtml($this->MASSPBK->caption());

        // RUMPELLEEDE
        $this->RUMPELLEEDE->EditAttrs["class"] = "form-control";
        $this->RUMPELLEEDE->EditCustomAttributes = "";
        if (!$this->RUMPELLEEDE->Raw) {
            $this->RUMPELLEEDE->CurrentValue = HtmlDecode($this->RUMPELLEEDE->CurrentValue);
        }
        $this->RUMPELLEEDE->EditValue = $this->RUMPELLEEDE->CurrentValue;
        $this->RUMPELLEEDE->PlaceHolder = RemoveHtml($this->RUMPELLEEDE->caption());

        // DARAHTEPI
        $this->DARAHTEPI->EditAttrs["class"] = "form-control";
        $this->DARAHTEPI->EditCustomAttributes = "";
        if (!$this->DARAHTEPI->Raw) {
            $this->DARAHTEPI->CurrentValue = HtmlDecode($this->DARAHTEPI->CurrentValue);
        }
        $this->DARAHTEPI->EditValue = $this->DARAHTEPI->CurrentValue;
        $this->DARAHTEPI->PlaceHolder = RemoveHtml($this->DARAHTEPI->caption());

        // MCV
        $this->MCV->EditAttrs["class"] = "form-control";
        $this->MCV->EditCustomAttributes = "";
        if (!$this->MCV->Raw) {
            $this->MCV->CurrentValue = HtmlDecode($this->MCV->CurrentValue);
        }
        $this->MCV->EditValue = $this->MCV->CurrentValue;
        $this->MCV->PlaceHolder = RemoveHtml($this->MCV->caption());

        // MCH
        $this->MCH->EditAttrs["class"] = "form-control";
        $this->MCH->EditCustomAttributes = "";
        if (!$this->MCH->Raw) {
            $this->MCH->CurrentValue = HtmlDecode($this->MCH->CurrentValue);
        }
        $this->MCH->EditValue = $this->MCH->CurrentValue;
        $this->MCH->PlaceHolder = RemoveHtml($this->MCH->caption());

        // MCHC
        $this->MCHC->EditAttrs["class"] = "form-control";
        $this->MCHC->EditCustomAttributes = "";
        if (!$this->MCHC->Raw) {
            $this->MCHC->CurrentValue = HtmlDecode($this->MCHC->CurrentValue);
        }
        $this->MCHC->EditValue = $this->MCHC->CurrentValue;
        $this->MCHC->PlaceHolder = RemoveHtml($this->MCHC->caption());

        // RDW
        $this->RDW->EditAttrs["class"] = "form-control";
        $this->RDW->EditCustomAttributes = "";
        if (!$this->RDW->Raw) {
            $this->RDW->CurrentValue = HtmlDecode($this->RDW->CurrentValue);
        }
        $this->RDW->EditValue = $this->RDW->CurrentValue;
        $this->RDW->PlaceHolder = RemoveHtml($this->RDW->caption());

        // SITBC
        $this->SITBC->EditAttrs["class"] = "form-control";
        $this->SITBC->EditCustomAttributes = "";
        if (!$this->SITBC->Raw) {
            $this->SITBC->CurrentValue = HtmlDecode($this->SITBC->CurrentValue);
        }
        $this->SITBC->EditValue = $this->SITBC->CurrentValue;
        $this->SITBC->PlaceHolder = RemoveHtml($this->SITBC->caption());

        // APTT
        $this->APTT->EditAttrs["class"] = "form-control";
        $this->APTT->EditCustomAttributes = "";
        if (!$this->APTT->Raw) {
            $this->APTT->CurrentValue = HtmlDecode($this->APTT->CurrentValue);
        }
        $this->APTT->EditValue = $this->APTT->CurrentValue;
        $this->APTT->PlaceHolder = RemoveHtml($this->APTT->caption());

        // FIBRIN
        $this->FIBRIN->EditAttrs["class"] = "form-control";
        $this->FIBRIN->EditCustomAttributes = "";
        if (!$this->FIBRIN->Raw) {
            $this->FIBRIN->CurrentValue = HtmlDecode($this->FIBRIN->CurrentValue);
        }
        $this->FIBRIN->EditValue = $this->FIBRIN->CurrentValue;
        $this->FIBRIN->PlaceHolder = RemoveHtml($this->FIBRIN->caption());

        // DIMER
        $this->DIMER->EditAttrs["class"] = "form-control";
        $this->DIMER->EditCustomAttributes = "";
        if (!$this->DIMER->Raw) {
            $this->DIMER->CurrentValue = HtmlDecode($this->DIMER->CurrentValue);
        }
        $this->DIMER->EditValue = $this->DIMER->CurrentValue;
        $this->DIMER->PlaceHolder = RemoveHtml($this->DIMER->caption());

        // PT
        $this->PT->EditAttrs["class"] = "form-control";
        $this->PT->EditCustomAttributes = "";
        if (!$this->PT->Raw) {
            $this->PT->CurrentValue = HtmlDecode($this->PT->CurrentValue);
        }
        $this->PT->EditValue = $this->PT->CurrentValue;
        $this->PT->PlaceHolder = RemoveHtml($this->PT->caption());

        // GDS
        $this->GDS->EditAttrs["class"] = "form-control";
        $this->GDS->EditCustomAttributes = "";
        if (!$this->GDS->Raw) {
            $this->GDS->CurrentValue = HtmlDecode($this->GDS->CurrentValue);
        }
        $this->GDS->EditValue = $this->GDS->CurrentValue;
        $this->GDS->PlaceHolder = RemoveHtml($this->GDS->caption());

        // GDP
        $this->GDP->EditAttrs["class"] = "form-control";
        $this->GDP->EditCustomAttributes = "";
        if (!$this->GDP->Raw) {
            $this->GDP->CurrentValue = HtmlDecode($this->GDP->CurrentValue);
        }
        $this->GDP->EditValue = $this->GDP->CurrentValue;
        $this->GDP->PlaceHolder = RemoveHtml($this->GDP->caption());

        // GDPP
        $this->GDPP->EditAttrs["class"] = "form-control";
        $this->GDPP->EditCustomAttributes = "";
        if (!$this->GDPP->Raw) {
            $this->GDPP->CurrentValue = HtmlDecode($this->GDPP->CurrentValue);
        }
        $this->GDPP->EditValue = $this->GDPP->CurrentValue;
        $this->GDPP->PlaceHolder = RemoveHtml($this->GDPP->caption());

        // CHLTOT
        $this->CHLTOT->EditAttrs["class"] = "form-control";
        $this->CHLTOT->EditCustomAttributes = "";
        if (!$this->CHLTOT->Raw) {
            $this->CHLTOT->CurrentValue = HtmlDecode($this->CHLTOT->CurrentValue);
        }
        $this->CHLTOT->EditValue = $this->CHLTOT->CurrentValue;
        $this->CHLTOT->PlaceHolder = RemoveHtml($this->CHLTOT->caption());

        // TRIGLE
        $this->TRIGLE->EditAttrs["class"] = "form-control";
        $this->TRIGLE->EditCustomAttributes = "";
        if (!$this->TRIGLE->Raw) {
            $this->TRIGLE->CurrentValue = HtmlDecode($this->TRIGLE->CurrentValue);
        }
        $this->TRIGLE->EditValue = $this->TRIGLE->CurrentValue;
        $this->TRIGLE->PlaceHolder = RemoveHtml($this->TRIGLE->caption());

        // HDL
        $this->HDL->EditAttrs["class"] = "form-control";
        $this->HDL->EditCustomAttributes = "";
        if (!$this->HDL->Raw) {
            $this->HDL->CurrentValue = HtmlDecode($this->HDL->CurrentValue);
        }
        $this->HDL->EditValue = $this->HDL->CurrentValue;
        $this->HDL->PlaceHolder = RemoveHtml($this->HDL->caption());

        // LDL
        $this->LDL->EditAttrs["class"] = "form-control";
        $this->LDL->EditCustomAttributes = "";
        if (!$this->LDL->Raw) {
            $this->LDL->CurrentValue = HtmlDecode($this->LDL->CurrentValue);
        }
        $this->LDL->EditValue = $this->LDL->CurrentValue;
        $this->LDL->PlaceHolder = RemoveHtml($this->LDL->caption());

        // URICACID
        $this->URICACID->EditAttrs["class"] = "form-control";
        $this->URICACID->EditCustomAttributes = "";
        if (!$this->URICACID->Raw) {
            $this->URICACID->CurrentValue = HtmlDecode($this->URICACID->CurrentValue);
        }
        $this->URICACID->EditValue = $this->URICACID->CurrentValue;
        $this->URICACID->PlaceHolder = RemoveHtml($this->URICACID->caption());

        // UREUM
        $this->UREUM->EditAttrs["class"] = "form-control";
        $this->UREUM->EditCustomAttributes = "";
        if (!$this->UREUM->Raw) {
            $this->UREUM->CurrentValue = HtmlDecode($this->UREUM->CurrentValue);
        }
        $this->UREUM->EditValue = $this->UREUM->CurrentValue;
        $this->UREUM->PlaceHolder = RemoveHtml($this->UREUM->caption());

        // CREATIN
        $this->CREATIN->EditAttrs["class"] = "form-control";
        $this->CREATIN->EditCustomAttributes = "";
        if (!$this->CREATIN->Raw) {
            $this->CREATIN->CurrentValue = HtmlDecode($this->CREATIN->CurrentValue);
        }
        $this->CREATIN->EditValue = $this->CREATIN->CurrentValue;
        $this->CREATIN->PlaceHolder = RemoveHtml($this->CREATIN->caption());

        // PROTEIN
        $this->PROTEIN->EditAttrs["class"] = "form-control";
        $this->PROTEIN->EditCustomAttributes = "";
        if (!$this->PROTEIN->Raw) {
            $this->PROTEIN->CurrentValue = HtmlDecode($this->PROTEIN->CurrentValue);
        }
        $this->PROTEIN->EditValue = $this->PROTEIN->CurrentValue;
        $this->PROTEIN->PlaceHolder = RemoveHtml($this->PROTEIN->caption());

        // ALBUMIN
        $this->ALBUMIN->EditAttrs["class"] = "form-control";
        $this->ALBUMIN->EditCustomAttributes = "";
        if (!$this->ALBUMIN->Raw) {
            $this->ALBUMIN->CurrentValue = HtmlDecode($this->ALBUMIN->CurrentValue);
        }
        $this->ALBUMIN->EditValue = $this->ALBUMIN->CurrentValue;
        $this->ALBUMIN->PlaceHolder = RemoveHtml($this->ALBUMIN->caption());

        // GLOBULIN
        $this->GLOBULIN->EditAttrs["class"] = "form-control";
        $this->GLOBULIN->EditCustomAttributes = "";
        if (!$this->GLOBULIN->Raw) {
            $this->GLOBULIN->CurrentValue = HtmlDecode($this->GLOBULIN->CurrentValue);
        }
        $this->GLOBULIN->EditValue = $this->GLOBULIN->CurrentValue;
        $this->GLOBULIN->PlaceHolder = RemoveHtml($this->GLOBULIN->caption());

        // BILITOTAL
        $this->BILITOTAL->EditAttrs["class"] = "form-control";
        $this->BILITOTAL->EditCustomAttributes = "";
        if (!$this->BILITOTAL->Raw) {
            $this->BILITOTAL->CurrentValue = HtmlDecode($this->BILITOTAL->CurrentValue);
        }
        $this->BILITOTAL->EditValue = $this->BILITOTAL->CurrentValue;
        $this->BILITOTAL->PlaceHolder = RemoveHtml($this->BILITOTAL->caption());

        // BILIDIRECT
        $this->BILIDIRECT->EditAttrs["class"] = "form-control";
        $this->BILIDIRECT->EditCustomAttributes = "";
        if (!$this->BILIDIRECT->Raw) {
            $this->BILIDIRECT->CurrentValue = HtmlDecode($this->BILIDIRECT->CurrentValue);
        }
        $this->BILIDIRECT->EditValue = $this->BILIDIRECT->CurrentValue;
        $this->BILIDIRECT->PlaceHolder = RemoveHtml($this->BILIDIRECT->caption());

        // BILIINDIRET
        $this->BILIINDIRET->EditAttrs["class"] = "form-control";
        $this->BILIINDIRET->EditCustomAttributes = "";
        if (!$this->BILIINDIRET->Raw) {
            $this->BILIINDIRET->CurrentValue = HtmlDecode($this->BILIINDIRET->CurrentValue);
        }
        $this->BILIINDIRET->EditValue = $this->BILIINDIRET->CurrentValue;
        $this->BILIINDIRET->PlaceHolder = RemoveHtml($this->BILIINDIRET->caption());

        // ALKALIN
        $this->ALKALIN->EditAttrs["class"] = "form-control";
        $this->ALKALIN->EditCustomAttributes = "";
        if (!$this->ALKALIN->Raw) {
            $this->ALKALIN->CurrentValue = HtmlDecode($this->ALKALIN->CurrentValue);
        }
        $this->ALKALIN->EditValue = $this->ALKALIN->CurrentValue;
        $this->ALKALIN->PlaceHolder = RemoveHtml($this->ALKALIN->caption());

        // GAMMA
        $this->GAMMA->EditAttrs["class"] = "form-control";
        $this->GAMMA->EditCustomAttributes = "";
        if (!$this->GAMMA->Raw) {
            $this->GAMMA->CurrentValue = HtmlDecode($this->GAMMA->CurrentValue);
        }
        $this->GAMMA->EditValue = $this->GAMMA->CurrentValue;
        $this->GAMMA->PlaceHolder = RemoveHtml($this->GAMMA->caption());

        // SGOT
        $this->SGOT->EditAttrs["class"] = "form-control";
        $this->SGOT->EditCustomAttributes = "";
        if (!$this->SGOT->Raw) {
            $this->SGOT->CurrentValue = HtmlDecode($this->SGOT->CurrentValue);
        }
        $this->SGOT->EditValue = $this->SGOT->CurrentValue;
        $this->SGOT->PlaceHolder = RemoveHtml($this->SGOT->caption());

        // SGPT
        $this->SGPT->EditAttrs["class"] = "form-control";
        $this->SGPT->EditCustomAttributes = "";
        if (!$this->SGPT->Raw) {
            $this->SGPT->CurrentValue = HtmlDecode($this->SGPT->CurrentValue);
        }
        $this->SGPT->EditValue = $this->SGPT->CurrentValue;
        $this->SGPT->PlaceHolder = RemoveHtml($this->SGPT->caption());

        // LDH
        $this->LDH->EditAttrs["class"] = "form-control";
        $this->LDH->EditCustomAttributes = "";
        if (!$this->LDH->Raw) {
            $this->LDH->CurrentValue = HtmlDecode($this->LDH->CurrentValue);
        }
        $this->LDH->EditValue = $this->LDH->CurrentValue;
        $this->LDH->PlaceHolder = RemoveHtml($this->LDH->caption());

        // CK
        $this->CK->EditAttrs["class"] = "form-control";
        $this->CK->EditCustomAttributes = "";
        if (!$this->CK->Raw) {
            $this->CK->CurrentValue = HtmlDecode($this->CK->CurrentValue);
        }
        $this->CK->EditValue = $this->CK->CurrentValue;
        $this->CK->PlaceHolder = RemoveHtml($this->CK->caption());

        // CKMB
        $this->CKMB->EditAttrs["class"] = "form-control";
        $this->CKMB->EditCustomAttributes = "";
        if (!$this->CKMB->Raw) {
            $this->CKMB->CurrentValue = HtmlDecode($this->CKMB->CurrentValue);
        }
        $this->CKMB->EditValue = $this->CKMB->CurrentValue;
        $this->CKMB->PlaceHolder = RemoveHtml($this->CKMB->caption());

        // HBAC
        $this->HBAC->EditAttrs["class"] = "form-control";
        $this->HBAC->EditCustomAttributes = "";
        if (!$this->HBAC->Raw) {
            $this->HBAC->CurrentValue = HtmlDecode($this->HBAC->CurrentValue);
        }
        $this->HBAC->EditValue = $this->HBAC->CurrentValue;
        $this->HBAC->PlaceHolder = RemoveHtml($this->HBAC->caption());

        // NATRIUM
        $this->NATRIUM->EditAttrs["class"] = "form-control";
        $this->NATRIUM->EditCustomAttributes = "";
        if (!$this->NATRIUM->Raw) {
            $this->NATRIUM->CurrentValue = HtmlDecode($this->NATRIUM->CurrentValue);
        }
        $this->NATRIUM->EditValue = $this->NATRIUM->CurrentValue;
        $this->NATRIUM->PlaceHolder = RemoveHtml($this->NATRIUM->caption());

        // KALIUM
        $this->KALIUM->EditAttrs["class"] = "form-control";
        $this->KALIUM->EditCustomAttributes = "";
        if (!$this->KALIUM->Raw) {
            $this->KALIUM->CurrentValue = HtmlDecode($this->KALIUM->CurrentValue);
        }
        $this->KALIUM->EditValue = $this->KALIUM->CurrentValue;
        $this->KALIUM->PlaceHolder = RemoveHtml($this->KALIUM->caption());

        // CHLORID
        $this->CHLORID->EditAttrs["class"] = "form-control";
        $this->CHLORID->EditCustomAttributes = "";
        if (!$this->CHLORID->Raw) {
            $this->CHLORID->CurrentValue = HtmlDecode($this->CHLORID->CurrentValue);
        }
        $this->CHLORID->EditValue = $this->CHLORID->CurrentValue;
        $this->CHLORID->PlaceHolder = RemoveHtml($this->CHLORID->caption());

        // CALSIUM
        $this->CALSIUM->EditAttrs["class"] = "form-control";
        $this->CALSIUM->EditCustomAttributes = "";
        if (!$this->CALSIUM->Raw) {
            $this->CALSIUM->CurrentValue = HtmlDecode($this->CALSIUM->CurrentValue);
        }
        $this->CALSIUM->EditValue = $this->CALSIUM->CurrentValue;
        $this->CALSIUM->PlaceHolder = RemoveHtml($this->CALSIUM->caption());

        // MAGNESIUM
        $this->MAGNESIUM->EditAttrs["class"] = "form-control";
        $this->MAGNESIUM->EditCustomAttributes = "";
        if (!$this->MAGNESIUM->Raw) {
            $this->MAGNESIUM->CurrentValue = HtmlDecode($this->MAGNESIUM->CurrentValue);
        }
        $this->MAGNESIUM->EditValue = $this->MAGNESIUM->CurrentValue;
        $this->MAGNESIUM->PlaceHolder = RemoveHtml($this->MAGNESIUM->caption());

        // AGD
        $this->AGD->EditAttrs["class"] = "form-control";
        $this->AGD->EditCustomAttributes = "";
        if (!$this->AGD->Raw) {
            $this->AGD->CurrentValue = HtmlDecode($this->AGD->CurrentValue);
        }
        $this->AGD->EditValue = $this->AGD->CurrentValue;
        $this->AGD->PlaceHolder = RemoveHtml($this->AGD->caption());

        // HBSAG
        $this->HBSAG->EditAttrs["class"] = "form-control";
        $this->HBSAG->EditCustomAttributes = "";
        if (!$this->HBSAG->Raw) {
            $this->HBSAG->CurrentValue = HtmlDecode($this->HBSAG->CurrentValue);
        }
        $this->HBSAG->EditValue = $this->HBSAG->CurrentValue;
        $this->HBSAG->PlaceHolder = RemoveHtml($this->HBSAG->caption());

        // ANTIHBS
        $this->ANTIHBS->EditAttrs["class"] = "form-control";
        $this->ANTIHBS->EditCustomAttributes = "";
        if (!$this->ANTIHBS->Raw) {
            $this->ANTIHBS->CurrentValue = HtmlDecode($this->ANTIHBS->CurrentValue);
        }
        $this->ANTIHBS->EditValue = $this->ANTIHBS->CurrentValue;
        $this->ANTIHBS->PlaceHolder = RemoveHtml($this->ANTIHBS->caption());

        // VDRL
        $this->VDRL->EditAttrs["class"] = "form-control";
        $this->VDRL->EditCustomAttributes = "";
        if (!$this->VDRL->Raw) {
            $this->VDRL->CurrentValue = HtmlDecode($this->VDRL->CurrentValue);
        }
        $this->VDRL->EditValue = $this->VDRL->CurrentValue;
        $this->VDRL->PlaceHolder = RemoveHtml($this->VDRL->caption());

        // ASTO
        $this->ASTO->EditAttrs["class"] = "form-control";
        $this->ASTO->EditCustomAttributes = "";
        if (!$this->ASTO->Raw) {
            $this->ASTO->CurrentValue = HtmlDecode($this->ASTO->CurrentValue);
        }
        $this->ASTO->EditValue = $this->ASTO->CurrentValue;
        $this->ASTO->PlaceHolder = RemoveHtml($this->ASTO->caption());

        // CRP
        $this->CRP->EditAttrs["class"] = "form-control";
        $this->CRP->EditCustomAttributes = "";
        if (!$this->CRP->Raw) {
            $this->CRP->CurrentValue = HtmlDecode($this->CRP->CurrentValue);
        }
        $this->CRP->EditValue = $this->CRP->CurrentValue;
        $this->CRP->PlaceHolder = RemoveHtml($this->CRP->caption());

        // RHEMOTOID
        $this->RHEMOTOID->EditAttrs["class"] = "form-control";
        $this->RHEMOTOID->EditCustomAttributes = "";
        if (!$this->RHEMOTOID->Raw) {
            $this->RHEMOTOID->CurrentValue = HtmlDecode($this->RHEMOTOID->CurrentValue);
        }
        $this->RHEMOTOID->EditValue = $this->RHEMOTOID->CurrentValue;
        $this->RHEMOTOID->PlaceHolder = RemoveHtml($this->RHEMOTOID->caption());

        // WIDAL
        $this->WIDAL->EditAttrs["class"] = "form-control";
        $this->WIDAL->EditCustomAttributes = "";
        if (!$this->WIDAL->Raw) {
            $this->WIDAL->CurrentValue = HtmlDecode($this->WIDAL->CurrentValue);
        }
        $this->WIDAL->EditValue = $this->WIDAL->CurrentValue;
        $this->WIDAL->PlaceHolder = RemoveHtml($this->WIDAL->caption());

        // HIV
        $this->HIV->EditAttrs["class"] = "form-control";
        $this->HIV->EditCustomAttributes = "";
        if (!$this->HIV->Raw) {
            $this->HIV->CurrentValue = HtmlDecode($this->HIV->CurrentValue);
        }
        $this->HIV->EditValue = $this->HIV->CurrentValue;
        $this->HIV->PlaceHolder = RemoveHtml($this->HIV->caption());

        // DHF
        $this->DHF->EditAttrs["class"] = "form-control";
        $this->DHF->EditCustomAttributes = "";
        if (!$this->DHF->Raw) {
            $this->DHF->CurrentValue = HtmlDecode($this->DHF->CurrentValue);
        }
        $this->DHF->EditValue = $this->DHF->CurrentValue;
        $this->DHF->PlaceHolder = RemoveHtml($this->DHF->caption());

        // TORCH
        $this->TORCH->EditAttrs["class"] = "form-control";
        $this->TORCH->EditCustomAttributes = "";
        if (!$this->TORCH->Raw) {
            $this->TORCH->CurrentValue = HtmlDecode($this->TORCH->CurrentValue);
        }
        $this->TORCH->EditValue = $this->TORCH->CurrentValue;
        $this->TORCH->PlaceHolder = RemoveHtml($this->TORCH->caption());

        // T3
        $this->T3->EditAttrs["class"] = "form-control";
        $this->T3->EditCustomAttributes = "";
        if (!$this->T3->Raw) {
            $this->T3->CurrentValue = HtmlDecode($this->T3->CurrentValue);
        }
        $this->T3->EditValue = $this->T3->CurrentValue;
        $this->T3->PlaceHolder = RemoveHtml($this->T3->caption());

        // T4
        $this->T4->EditAttrs["class"] = "form-control";
        $this->T4->EditCustomAttributes = "";
        if (!$this->T4->Raw) {
            $this->T4->CurrentValue = HtmlDecode($this->T4->CurrentValue);
        }
        $this->T4->EditValue = $this->T4->CurrentValue;
        $this->T4->PlaceHolder = RemoveHtml($this->T4->caption());

        // TSH
        $this->TSH->EditAttrs["class"] = "form-control";
        $this->TSH->EditCustomAttributes = "";
        if (!$this->TSH->Raw) {
            $this->TSH->CurrentValue = HtmlDecode($this->TSH->CurrentValue);
        }
        $this->TSH->EditValue = $this->TSH->CurrentValue;
        $this->TSH->PlaceHolder = RemoveHtml($this->TSH->caption());

        // TROPONIN
        $this->TROPONIN->EditAttrs["class"] = "form-control";
        $this->TROPONIN->EditCustomAttributes = "";
        if (!$this->TROPONIN->Raw) {
            $this->TROPONIN->CurrentValue = HtmlDecode($this->TROPONIN->CurrentValue);
        }
        $this->TROPONIN->EditValue = $this->TROPONIN->CurrentValue;
        $this->TROPONIN->PlaceHolder = RemoveHtml($this->TROPONIN->caption());

        // MALARIA
        $this->MALARIA->EditAttrs["class"] = "form-control";
        $this->MALARIA->EditCustomAttributes = "";
        if (!$this->MALARIA->Raw) {
            $this->MALARIA->CurrentValue = HtmlDecode($this->MALARIA->CurrentValue);
        }
        $this->MALARIA->EditValue = $this->MALARIA->CurrentValue;
        $this->MALARIA->PlaceHolder = RemoveHtml($this->MALARIA->caption());

        // CACING
        $this->CACING->EditAttrs["class"] = "form-control";
        $this->CACING->EditCustomAttributes = "";
        if (!$this->CACING->Raw) {
            $this->CACING->CurrentValue = HtmlDecode($this->CACING->CurrentValue);
        }
        $this->CACING->EditValue = $this->CACING->CurrentValue;
        $this->CACING->PlaceHolder = RemoveHtml($this->CACING->caption());

        // BTA
        $this->BTA->EditAttrs["class"] = "form-control";
        $this->BTA->EditCustomAttributes = "";
        if (!$this->BTA->Raw) {
            $this->BTA->CurrentValue = HtmlDecode($this->BTA->CurrentValue);
        }
        $this->BTA->EditValue = $this->BTA->CurrentValue;
        $this->BTA->PlaceHolder = RemoveHtml($this->BTA->caption());

        // FILARIA
        $this->FILARIA->EditAttrs["class"] = "form-control";
        $this->FILARIA->EditCustomAttributes = "";
        if (!$this->FILARIA->Raw) {
            $this->FILARIA->CurrentValue = HtmlDecode($this->FILARIA->CurrentValue);
        }
        $this->FILARIA->EditValue = $this->FILARIA->CurrentValue;
        $this->FILARIA->PlaceHolder = RemoveHtml($this->FILARIA->caption());

        // SCRURET
        $this->SCRURET->EditAttrs["class"] = "form-control";
        $this->SCRURET->EditCustomAttributes = "";
        if (!$this->SCRURET->Raw) {
            $this->SCRURET->CurrentValue = HtmlDecode($this->SCRURET->CurrentValue);
        }
        $this->SCRURET->EditValue = $this->SCRURET->CurrentValue;
        $this->SCRURET->PlaceHolder = RemoveHtml($this->SCRURET->caption());

        // SCRVAG
        $this->SCRVAG->EditAttrs["class"] = "form-control";
        $this->SCRVAG->EditCustomAttributes = "";
        if (!$this->SCRVAG->Raw) {
            $this->SCRVAG->CurrentValue = HtmlDecode($this->SCRVAG->CurrentValue);
        }
        $this->SCRVAG->EditValue = $this->SCRVAG->CurrentValue;
        $this->SCRVAG->PlaceHolder = RemoveHtml($this->SCRVAG->caption());

        // URINLKP
        $this->URINLKP->EditAttrs["class"] = "form-control";
        $this->URINLKP->EditCustomAttributes = "";
        if (!$this->URINLKP->Raw) {
            $this->URINLKP->CurrentValue = HtmlDecode($this->URINLKP->CurrentValue);
        }
        $this->URINLKP->EditValue = $this->URINLKP->CurrentValue;
        $this->URINLKP->PlaceHolder = RemoveHtml($this->URINLKP->caption());

        // FACESLKP
        $this->FACESLKP->EditAttrs["class"] = "form-control";
        $this->FACESLKP->EditCustomAttributes = "";
        if (!$this->FACESLKP->Raw) {
            $this->FACESLKP->CurrentValue = HtmlDecode($this->FACESLKP->CurrentValue);
        }
        $this->FACESLKP->EditValue = $this->FACESLKP->CurrentValue;
        $this->FACESLKP->PlaceHolder = RemoveHtml($this->FACESLKP->caption());

        // BTASPT
        $this->BTASPT->EditAttrs["class"] = "form-control";
        $this->BTASPT->EditCustomAttributes = "";
        if (!$this->BTASPT->Raw) {
            $this->BTASPT->CurrentValue = HtmlDecode($this->BTASPT->CurrentValue);
        }
        $this->BTASPT->EditValue = $this->BTASPT->CurrentValue;
        $this->BTASPT->PlaceHolder = RemoveHtml($this->BTASPT->caption());

        // BTASPUT
        $this->BTASPUT->EditAttrs["class"] = "form-control";
        $this->BTASPUT->EditCustomAttributes = "";
        if (!$this->BTASPUT->Raw) {
            $this->BTASPUT->CurrentValue = HtmlDecode($this->BTASPUT->CurrentValue);
        }
        $this->BTASPUT->EditValue = $this->BTASPUT->CurrentValue;
        $this->BTASPUT->PlaceHolder = RemoveHtml($this->BTASPUT->caption());

        // SPERMA
        $this->SPERMA->EditAttrs["class"] = "form-control";
        $this->SPERMA->EditCustomAttributes = "";
        if (!$this->SPERMA->Raw) {
            $this->SPERMA->CurrentValue = HtmlDecode($this->SPERMA->CurrentValue);
        }
        $this->SPERMA->EditValue = $this->SPERMA->CurrentValue;
        $this->SPERMA->PlaceHolder = RemoveHtml($this->SPERMA->caption());

        // pandi
        $this->pandi->EditAttrs["class"] = "form-control";
        $this->pandi->EditCustomAttributes = "";
        if (!$this->pandi->Raw) {
            $this->pandi->CurrentValue = HtmlDecode($this->pandi->CurrentValue);
        }
        $this->pandi->EditValue = $this->pandi->CurrentValue;
        $this->pandi->PlaceHolder = RemoveHtml($this->pandi->caption());

        // NARKOBA
        $this->NARKOBA->EditAttrs["class"] = "form-control";
        $this->NARKOBA->EditCustomAttributes = "";
        if (!$this->NARKOBA->Raw) {
            $this->NARKOBA->CurrentValue = HtmlDecode($this->NARKOBA->CurrentValue);
        }
        $this->NARKOBA->EditValue = $this->NARKOBA->CurrentValue;
        $this->NARKOBA->PlaceHolder = RemoveHtml($this->NARKOBA->caption());

        // HAMIL
        $this->HAMIL->EditAttrs["class"] = "form-control";
        $this->HAMIL->EditCustomAttributes = "";
        if (!$this->HAMIL->Raw) {
            $this->HAMIL->CurrentValue = HtmlDecode($this->HAMIL->CurrentValue);
        }
        $this->HAMIL->EditValue = $this->HAMIL->CurrentValue;
        $this->HAMIL->PlaceHolder = RemoveHtml($this->HAMIL->caption());

        // ACITES
        $this->ACITES->EditAttrs["class"] = "form-control";
        $this->ACITES->EditCustomAttributes = "";
        if (!$this->ACITES->Raw) {
            $this->ACITES->CurrentValue = HtmlDecode($this->ACITES->CurrentValue);
        }
        $this->ACITES->EditValue = $this->ACITES->CurrentValue;
        $this->ACITES->PlaceHolder = RemoveHtml($this->ACITES->caption());

        // LCS
        $this->LCS->EditAttrs["class"] = "form-control";
        $this->LCS->EditCustomAttributes = "";
        if (!$this->LCS->Raw) {
            $this->LCS->CurrentValue = HtmlDecode($this->LCS->CurrentValue);
        }
        $this->LCS->EditValue = $this->LCS->CurrentValue;
        $this->LCS->PlaceHolder = RemoveHtml($this->LCS->caption());

        // SENDI
        $this->SENDI->EditAttrs["class"] = "form-control";
        $this->SENDI->EditCustomAttributes = "";
        if (!$this->SENDI->Raw) {
            $this->SENDI->CurrentValue = HtmlDecode($this->SENDI->CurrentValue);
        }
        $this->SENDI->EditValue = $this->SENDI->CurrentValue;
        $this->SENDI->PlaceHolder = RemoveHtml($this->SENDI->caption());

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
                    $doc->exportCaption($this->VACTINATION_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->VALIDATION);
                    $doc->exportCaption($this->TERLAYANI);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->PATIENT_CATEGORY_ID);
                    $doc->exportCaption($this->VACTINATION_DATE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
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
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->LED);
                    $doc->exportCaption($this->HEMATOKRIT);
                    $doc->exportCaption($this->HB);
                    $doc->exportCaption($this->ERITRO);
                    $doc->exportCaption($this->LEUKO);
                    $doc->exportCaption($this->TROMBO);
                    $doc->exportCaption($this->RETIKU);
                    $doc->exportCaption($this->SDIFF);
                    $doc->exportCaption($this->MASSPDR);
                    $doc->exportCaption($this->MASSPBK);
                    $doc->exportCaption($this->RUMPELLEEDE);
                    $doc->exportCaption($this->DARAHTEPI);
                    $doc->exportCaption($this->MCV);
                    $doc->exportCaption($this->MCH);
                    $doc->exportCaption($this->MCHC);
                    $doc->exportCaption($this->RDW);
                    $doc->exportCaption($this->SITBC);
                    $doc->exportCaption($this->APTT);
                    $doc->exportCaption($this->FIBRIN);
                    $doc->exportCaption($this->DIMER);
                    $doc->exportCaption($this->PT);
                    $doc->exportCaption($this->GDS);
                    $doc->exportCaption($this->GDP);
                    $doc->exportCaption($this->GDPP);
                    $doc->exportCaption($this->CHLTOT);
                    $doc->exportCaption($this->TRIGLE);
                    $doc->exportCaption($this->HDL);
                    $doc->exportCaption($this->LDL);
                    $doc->exportCaption($this->URICACID);
                    $doc->exportCaption($this->UREUM);
                    $doc->exportCaption($this->CREATIN);
                    $doc->exportCaption($this->PROTEIN);
                    $doc->exportCaption($this->ALBUMIN);
                    $doc->exportCaption($this->GLOBULIN);
                    $doc->exportCaption($this->BILITOTAL);
                    $doc->exportCaption($this->BILIDIRECT);
                    $doc->exportCaption($this->BILIINDIRET);
                    $doc->exportCaption($this->ALKALIN);
                    $doc->exportCaption($this->GAMMA);
                    $doc->exportCaption($this->SGOT);
                    $doc->exportCaption($this->SGPT);
                    $doc->exportCaption($this->LDH);
                    $doc->exportCaption($this->CK);
                    $doc->exportCaption($this->CKMB);
                    $doc->exportCaption($this->HBAC);
                    $doc->exportCaption($this->NATRIUM);
                    $doc->exportCaption($this->KALIUM);
                    $doc->exportCaption($this->CHLORID);
                    $doc->exportCaption($this->CALSIUM);
                    $doc->exportCaption($this->MAGNESIUM);
                    $doc->exportCaption($this->AGD);
                    $doc->exportCaption($this->HBSAG);
                    $doc->exportCaption($this->ANTIHBS);
                    $doc->exportCaption($this->VDRL);
                    $doc->exportCaption($this->ASTO);
                    $doc->exportCaption($this->CRP);
                    $doc->exportCaption($this->RHEMOTOID);
                    $doc->exportCaption($this->WIDAL);
                    $doc->exportCaption($this->HIV);
                    $doc->exportCaption($this->DHF);
                    $doc->exportCaption($this->TORCH);
                    $doc->exportCaption($this->T3);
                    $doc->exportCaption($this->T4);
                    $doc->exportCaption($this->TSH);
                    $doc->exportCaption($this->TROPONIN);
                    $doc->exportCaption($this->MALARIA);
                    $doc->exportCaption($this->CACING);
                    $doc->exportCaption($this->BTA);
                    $doc->exportCaption($this->FILARIA);
                    $doc->exportCaption($this->SCRURET);
                    $doc->exportCaption($this->SCRVAG);
                    $doc->exportCaption($this->URINLKP);
                    $doc->exportCaption($this->FACESLKP);
                    $doc->exportCaption($this->BTASPT);
                    $doc->exportCaption($this->BTASPUT);
                    $doc->exportCaption($this->SPERMA);
                    $doc->exportCaption($this->pandi);
                    $doc->exportCaption($this->NARKOBA);
                    $doc->exportCaption($this->HAMIL);
                    $doc->exportCaption($this->ACITES);
                    $doc->exportCaption($this->LCS);
                    $doc->exportCaption($this->SENDI);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->VACTINATION_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->VALIDATION);
                    $doc->exportCaption($this->TERLAYANI);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->PATIENT_CATEGORY_ID);
                    $doc->exportCaption($this->VACTINATION_DATE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
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
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->LED);
                    $doc->exportCaption($this->HEMATOKRIT);
                    $doc->exportCaption($this->HB);
                    $doc->exportCaption($this->ERITRO);
                    $doc->exportCaption($this->LEUKO);
                    $doc->exportCaption($this->TROMBO);
                    $doc->exportCaption($this->RETIKU);
                    $doc->exportCaption($this->SDIFF);
                    $doc->exportCaption($this->MASSPDR);
                    $doc->exportCaption($this->MASSPBK);
                    $doc->exportCaption($this->RUMPELLEEDE);
                    $doc->exportCaption($this->DARAHTEPI);
                    $doc->exportCaption($this->MCV);
                    $doc->exportCaption($this->MCH);
                    $doc->exportCaption($this->MCHC);
                    $doc->exportCaption($this->RDW);
                    $doc->exportCaption($this->SITBC);
                    $doc->exportCaption($this->APTT);
                    $doc->exportCaption($this->FIBRIN);
                    $doc->exportCaption($this->DIMER);
                    $doc->exportCaption($this->PT);
                    $doc->exportCaption($this->GDS);
                    $doc->exportCaption($this->GDP);
                    $doc->exportCaption($this->GDPP);
                    $doc->exportCaption($this->CHLTOT);
                    $doc->exportCaption($this->TRIGLE);
                    $doc->exportCaption($this->HDL);
                    $doc->exportCaption($this->LDL);
                    $doc->exportCaption($this->URICACID);
                    $doc->exportCaption($this->UREUM);
                    $doc->exportCaption($this->CREATIN);
                    $doc->exportCaption($this->PROTEIN);
                    $doc->exportCaption($this->ALBUMIN);
                    $doc->exportCaption($this->GLOBULIN);
                    $doc->exportCaption($this->BILITOTAL);
                    $doc->exportCaption($this->BILIDIRECT);
                    $doc->exportCaption($this->BILIINDIRET);
                    $doc->exportCaption($this->ALKALIN);
                    $doc->exportCaption($this->GAMMA);
                    $doc->exportCaption($this->SGOT);
                    $doc->exportCaption($this->SGPT);
                    $doc->exportCaption($this->LDH);
                    $doc->exportCaption($this->CK);
                    $doc->exportCaption($this->CKMB);
                    $doc->exportCaption($this->HBAC);
                    $doc->exportCaption($this->NATRIUM);
                    $doc->exportCaption($this->KALIUM);
                    $doc->exportCaption($this->CHLORID);
                    $doc->exportCaption($this->CALSIUM);
                    $doc->exportCaption($this->MAGNESIUM);
                    $doc->exportCaption($this->AGD);
                    $doc->exportCaption($this->HBSAG);
                    $doc->exportCaption($this->ANTIHBS);
                    $doc->exportCaption($this->VDRL);
                    $doc->exportCaption($this->ASTO);
                    $doc->exportCaption($this->CRP);
                    $doc->exportCaption($this->RHEMOTOID);
                    $doc->exportCaption($this->WIDAL);
                    $doc->exportCaption($this->HIV);
                    $doc->exportCaption($this->DHF);
                    $doc->exportCaption($this->TORCH);
                    $doc->exportCaption($this->T3);
                    $doc->exportCaption($this->T4);
                    $doc->exportCaption($this->TSH);
                    $doc->exportCaption($this->TROPONIN);
                    $doc->exportCaption($this->MALARIA);
                    $doc->exportCaption($this->CACING);
                    $doc->exportCaption($this->BTA);
                    $doc->exportCaption($this->FILARIA);
                    $doc->exportCaption($this->SCRURET);
                    $doc->exportCaption($this->SCRVAG);
                    $doc->exportCaption($this->URINLKP);
                    $doc->exportCaption($this->FACESLKP);
                    $doc->exportCaption($this->BTASPT);
                    $doc->exportCaption($this->BTASPUT);
                    $doc->exportCaption($this->SPERMA);
                    $doc->exportCaption($this->pandi);
                    $doc->exportCaption($this->NARKOBA);
                    $doc->exportCaption($this->HAMIL);
                    $doc->exportCaption($this->ACITES);
                    $doc->exportCaption($this->LCS);
                    $doc->exportCaption($this->SENDI);
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
                        $doc->exportField($this->VACTINATION_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->VALIDATION);
                        $doc->exportField($this->TERLAYANI);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->PATIENT_CATEGORY_ID);
                        $doc->exportField($this->VACTINATION_DATE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
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
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->LED);
                        $doc->exportField($this->HEMATOKRIT);
                        $doc->exportField($this->HB);
                        $doc->exportField($this->ERITRO);
                        $doc->exportField($this->LEUKO);
                        $doc->exportField($this->TROMBO);
                        $doc->exportField($this->RETIKU);
                        $doc->exportField($this->SDIFF);
                        $doc->exportField($this->MASSPDR);
                        $doc->exportField($this->MASSPBK);
                        $doc->exportField($this->RUMPELLEEDE);
                        $doc->exportField($this->DARAHTEPI);
                        $doc->exportField($this->MCV);
                        $doc->exportField($this->MCH);
                        $doc->exportField($this->MCHC);
                        $doc->exportField($this->RDW);
                        $doc->exportField($this->SITBC);
                        $doc->exportField($this->APTT);
                        $doc->exportField($this->FIBRIN);
                        $doc->exportField($this->DIMER);
                        $doc->exportField($this->PT);
                        $doc->exportField($this->GDS);
                        $doc->exportField($this->GDP);
                        $doc->exportField($this->GDPP);
                        $doc->exportField($this->CHLTOT);
                        $doc->exportField($this->TRIGLE);
                        $doc->exportField($this->HDL);
                        $doc->exportField($this->LDL);
                        $doc->exportField($this->URICACID);
                        $doc->exportField($this->UREUM);
                        $doc->exportField($this->CREATIN);
                        $doc->exportField($this->PROTEIN);
                        $doc->exportField($this->ALBUMIN);
                        $doc->exportField($this->GLOBULIN);
                        $doc->exportField($this->BILITOTAL);
                        $doc->exportField($this->BILIDIRECT);
                        $doc->exportField($this->BILIINDIRET);
                        $doc->exportField($this->ALKALIN);
                        $doc->exportField($this->GAMMA);
                        $doc->exportField($this->SGOT);
                        $doc->exportField($this->SGPT);
                        $doc->exportField($this->LDH);
                        $doc->exportField($this->CK);
                        $doc->exportField($this->CKMB);
                        $doc->exportField($this->HBAC);
                        $doc->exportField($this->NATRIUM);
                        $doc->exportField($this->KALIUM);
                        $doc->exportField($this->CHLORID);
                        $doc->exportField($this->CALSIUM);
                        $doc->exportField($this->MAGNESIUM);
                        $doc->exportField($this->AGD);
                        $doc->exportField($this->HBSAG);
                        $doc->exportField($this->ANTIHBS);
                        $doc->exportField($this->VDRL);
                        $doc->exportField($this->ASTO);
                        $doc->exportField($this->CRP);
                        $doc->exportField($this->RHEMOTOID);
                        $doc->exportField($this->WIDAL);
                        $doc->exportField($this->HIV);
                        $doc->exportField($this->DHF);
                        $doc->exportField($this->TORCH);
                        $doc->exportField($this->T3);
                        $doc->exportField($this->T4);
                        $doc->exportField($this->TSH);
                        $doc->exportField($this->TROPONIN);
                        $doc->exportField($this->MALARIA);
                        $doc->exportField($this->CACING);
                        $doc->exportField($this->BTA);
                        $doc->exportField($this->FILARIA);
                        $doc->exportField($this->SCRURET);
                        $doc->exportField($this->SCRVAG);
                        $doc->exportField($this->URINLKP);
                        $doc->exportField($this->FACESLKP);
                        $doc->exportField($this->BTASPT);
                        $doc->exportField($this->BTASPUT);
                        $doc->exportField($this->SPERMA);
                        $doc->exportField($this->pandi);
                        $doc->exportField($this->NARKOBA);
                        $doc->exportField($this->HAMIL);
                        $doc->exportField($this->ACITES);
                        $doc->exportField($this->LCS);
                        $doc->exportField($this->SENDI);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->VACTINATION_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->VALIDATION);
                        $doc->exportField($this->TERLAYANI);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->PATIENT_CATEGORY_ID);
                        $doc->exportField($this->VACTINATION_DATE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
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
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->LED);
                        $doc->exportField($this->HEMATOKRIT);
                        $doc->exportField($this->HB);
                        $doc->exportField($this->ERITRO);
                        $doc->exportField($this->LEUKO);
                        $doc->exportField($this->TROMBO);
                        $doc->exportField($this->RETIKU);
                        $doc->exportField($this->SDIFF);
                        $doc->exportField($this->MASSPDR);
                        $doc->exportField($this->MASSPBK);
                        $doc->exportField($this->RUMPELLEEDE);
                        $doc->exportField($this->DARAHTEPI);
                        $doc->exportField($this->MCV);
                        $doc->exportField($this->MCH);
                        $doc->exportField($this->MCHC);
                        $doc->exportField($this->RDW);
                        $doc->exportField($this->SITBC);
                        $doc->exportField($this->APTT);
                        $doc->exportField($this->FIBRIN);
                        $doc->exportField($this->DIMER);
                        $doc->exportField($this->PT);
                        $doc->exportField($this->GDS);
                        $doc->exportField($this->GDP);
                        $doc->exportField($this->GDPP);
                        $doc->exportField($this->CHLTOT);
                        $doc->exportField($this->TRIGLE);
                        $doc->exportField($this->HDL);
                        $doc->exportField($this->LDL);
                        $doc->exportField($this->URICACID);
                        $doc->exportField($this->UREUM);
                        $doc->exportField($this->CREATIN);
                        $doc->exportField($this->PROTEIN);
                        $doc->exportField($this->ALBUMIN);
                        $doc->exportField($this->GLOBULIN);
                        $doc->exportField($this->BILITOTAL);
                        $doc->exportField($this->BILIDIRECT);
                        $doc->exportField($this->BILIINDIRET);
                        $doc->exportField($this->ALKALIN);
                        $doc->exportField($this->GAMMA);
                        $doc->exportField($this->SGOT);
                        $doc->exportField($this->SGPT);
                        $doc->exportField($this->LDH);
                        $doc->exportField($this->CK);
                        $doc->exportField($this->CKMB);
                        $doc->exportField($this->HBAC);
                        $doc->exportField($this->NATRIUM);
                        $doc->exportField($this->KALIUM);
                        $doc->exportField($this->CHLORID);
                        $doc->exportField($this->CALSIUM);
                        $doc->exportField($this->MAGNESIUM);
                        $doc->exportField($this->AGD);
                        $doc->exportField($this->HBSAG);
                        $doc->exportField($this->ANTIHBS);
                        $doc->exportField($this->VDRL);
                        $doc->exportField($this->ASTO);
                        $doc->exportField($this->CRP);
                        $doc->exportField($this->RHEMOTOID);
                        $doc->exportField($this->WIDAL);
                        $doc->exportField($this->HIV);
                        $doc->exportField($this->DHF);
                        $doc->exportField($this->TORCH);
                        $doc->exportField($this->T3);
                        $doc->exportField($this->T4);
                        $doc->exportField($this->TSH);
                        $doc->exportField($this->TROPONIN);
                        $doc->exportField($this->MALARIA);
                        $doc->exportField($this->CACING);
                        $doc->exportField($this->BTA);
                        $doc->exportField($this->FILARIA);
                        $doc->exportField($this->SCRURET);
                        $doc->exportField($this->SCRVAG);
                        $doc->exportField($this->URINLKP);
                        $doc->exportField($this->FACESLKP);
                        $doc->exportField($this->BTASPT);
                        $doc->exportField($this->BTASPUT);
                        $doc->exportField($this->SPERMA);
                        $doc->exportField($this->pandi);
                        $doc->exportField($this->NARKOBA);
                        $doc->exportField($this->HAMIL);
                        $doc->exportField($this->ACITES);
                        $doc->exportField($this->LCS);
                        $doc->exportField($this->SENDI);
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
