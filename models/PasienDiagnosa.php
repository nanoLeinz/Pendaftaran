<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for PASIEN_DIAGNOSA
 */
class PasienDiagnosa extends DbTable
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
    public $PASIEN_DIAGNOSA_ID;
    public $NO_REGISTRATION;
    public $THENAME;
    public $VISIT_ID;
    public $CLINIC_ID;
    public $BILL_ID;
    public $CLASS_ROOM_ID;
    public $IN_DATE;
    public $EXIT_DATE;
    public $BED_ID;
    public $KELUAR_ID;
    public $DATE_OF_DIAGNOSA;
    public $REPORT_DATE;
    public $DIAGNOSA_ID;
    public $DIAGNOSA_DESC;
    public $ANAMNASE;
    public $PEMERIKSAAN;
    public $TERAPHY_DESC;
    public $INSTRUCTION;
    public $SUFFER_TYPE;
    public $INFECTED_BODY;
    public $EMPLOYEE_ID;
    public $RISK_LEVEL;
    public $MORFOLOGI_NEOPLASMA;
    public $HURT;
    public $HURT_TYPE;
    public $DIAG_CAT;
    public $ADDICTION_MATERIAL;
    public $INFECTED_QUANTITY;
    public $CONTAGIOUS_TYPE;
    public $CURATIF_ID;
    public $RESULT_ID;
    public $INFECTION_TYPE;
    public $INVESTIGATION_ID;
    public $DISABILITY;
    public $DESCRIPTION;
    public $KOMPLIKASI;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $STATUS_PASIEN_ID;
    public $AGEYEAR;
    public $AGEMONTH;
    public $AGEDAY;
    public $THEADDRESS;
    public $THEID;
    public $ISRJ;
    public $GENDER;
    public $DOCTOR;
    public $KAL_ID;
    public $ACCOUNT_ID;
    public $DIAGNOSA_ID_02;
    public $DIAGNOSA_ID_03;
    public $DIAGNOSA_ID_04;
    public $DIAGNOSA_ID_05;
    public $DIAGNOSA_ID_06;
    public $DIAGNOSA_ID_07;
    public $DIAGNOSA_ID_08;
    public $DIAGNOSA_ID_09;
    public $DIAGNOSA_ID_10;
    public $PROCEDURE_01;
    public $PROCEDURE_02;
    public $PROCEDURE_03;
    public $PROCEDURE_04;
    public $PROCEDURE_05;
    public $PROCEDURE_06;
    public $PROCEDURE_07;
    public $PROCEDURE_08;
    public $PROCEDURE_09;
    public $PROCEDURE_10;
    public $DIAGNOSA_ID2;
    public $WEIGHT;
    public $NOKARTU;
    public $NOSEP;
    public $TGLSEP;
    public $RENCANATL;
    public $DIRUJUKKE;
    public $TGLKONTROL;
    public $KDPOLI_KONTROL;
    public $JAMINAN;
    public $SPESIALISTIK;
    public $PEMERIKSAAN_02;
    public $DIAGNOSA_DESC_02;
    public $DIAGNOSA_DESC_03;
    public $DIAGNOSA_DESC_04;
    public $DIAGNOSA_DESC_05;
    public $DIAGNOSA_DESC_06;
    public $PROCEDURE_DESC_01;
    public $PROCEDURE_DESC_02;
    public $PROCEDURE_DESC_03;
    public $PROCEDURE_DESC_04;
    public $PROCEDURE_DESC_05;
    public $RESPONPOST;
    public $RESPONPUT;
    public $RESPONDEL;
    public $JSONPOST;
    public $JSONPUT;
    public $JSONDEL;
    public $height;
    public $TEMPERATURE;
    public $TENSION_UPPER;
    public $TENSION_BELOW;
    public $NADI;
    public $NAFAS;
    public $spec_procedures;
    public $spec_drug;
    public $spec_prothesis;
    public $spec_investigation;
    public $procedure_11;
    public $procedure_12;
    public $procedure_13;
    public $procedure_14;
    public $procedure_15;
    public $isanestesi;
    public $isreposisi;
    public $islab;
    public $isro;
    public $isekg;
    public $ishecting;
    public $isgips;
    public $islengkap;
    public $ID;
    public $IDXDAFTAR;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'PASIEN_DIAGNOSA';
        $this->TableName = 'PASIEN_DIAGNOSA';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[PASIEN_DIAGNOSA]";
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
        $this->ORG_UNIT_CODE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Sortable = false; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PASIEN_DIAGNOSA_ID', 'PASIEN_DIAGNOSA_ID', '[PASIEN_DIAGNOSA_ID]', '[PASIEN_DIAGNOSA_ID]', 200, 50, -1, false, '[PASIEN_DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_DIAGNOSA_ID->Nullable = false; // NOT NULL field
        $this->PASIEN_DIAGNOSA_ID->Sortable = false; // Allow sort
        $this->PASIEN_DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['PASIEN_DIAGNOSA_ID'] = &$this->PASIEN_DIAGNOSA_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NO_REGISTRATION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","",""], [], [], [], [], ["NAME_OF_PASIEN"], ["x_THENAME"], '', '');
                break;
            default:
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","",""], [], [], [], [], ["NAME_OF_PASIEN"], ["x_THENAME"], '', '');
                break;
        }
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // THENAME
        $this->THENAME = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // VISIT_ID
        $this->VISIT_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->IsForeignKey = true; // Foreign key field
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
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

        // BILL_ID
        $this->BILL_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_BILL_ID', 'BILL_ID', '[BILL_ID]', '[BILL_ID]', 200, 50, -1, false, '[BILL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_ID->Sortable = true; // Allow sort
        $this->BILL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_ID->Param, "CustomMsg");
        $this->Fields['BILL_ID'] = &$this->BILL_ID;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 50, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // IN_DATE
        $this->IN_DATE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_IN_DATE', 'IN_DATE', '[IN_DATE]', CastDateFieldForLike("[IN_DATE]", 0, "DB"), 135, 8, 0, false, '[IN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IN_DATE->Sortable = true; // Allow sort
        $this->IN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->IN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IN_DATE->Param, "CustomMsg");
        $this->Fields['IN_DATE'] = &$this->IN_DATE;

        // EXIT_DATE
        $this->EXIT_DATE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_EXIT_DATE', 'EXIT_DATE', '[EXIT_DATE]', CastDateFieldForLike("[EXIT_DATE]", 0, "DB"), 135, 8, 0, false, '[EXIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXIT_DATE->Sortable = true; // Allow sort
        $this->EXIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXIT_DATE->Param, "CustomMsg");
        $this->Fields['EXIT_DATE'] = &$this->EXIT_DATE;

        // BED_ID
        $this->BED_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = true; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // KELUAR_ID
        $this->KELUAR_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KELUAR_ID->Sortable = true; // Allow sort
        $this->KELUAR_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KELUAR_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->KELUAR_ID->Lookup = new Lookup('KELUAR_ID', 'CARA_KELUAR', false, 'KELUAR_ID', ["CARA_KELUAR","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->KELUAR_ID->Lookup = new Lookup('KELUAR_ID', 'CARA_KELUAR', false, 'KELUAR_ID', ["CARA_KELUAR","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->KELUAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KELUAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELUAR_ID->Param, "CustomMsg");
        $this->Fields['KELUAR_ID'] = &$this->KELUAR_ID;

        // DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DATE_OF_DIAGNOSA', 'DATE_OF_DIAGNOSA', '[DATE_OF_DIAGNOSA]', CastDateFieldForLike("[DATE_OF_DIAGNOSA]", 11, "DB"), 135, 8, 11, false, '[DATE_OF_DIAGNOSA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DATE_OF_DIAGNOSA->Sortable = true; // Allow sort
        $this->DATE_OF_DIAGNOSA->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->DATE_OF_DIAGNOSA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DATE_OF_DIAGNOSA->Param, "CustomMsg");
        $this->Fields['DATE_OF_DIAGNOSA'] = &$this->DATE_OF_DIAGNOSA;

        // REPORT_DATE
        $this->REPORT_DATE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_REPORT_DATE', 'REPORT_DATE', '[REPORT_DATE]', CastDateFieldForLike("[REPORT_DATE]", 0, "DB"), 135, 8, 0, false, '[REPORT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REPORT_DATE->Sortable = true; // Allow sort
        $this->REPORT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REPORT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REPORT_DATE->Param, "CustomMsg");
        $this->Fields['REPORT_DATE'] = &$this->REPORT_DATE;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 50, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAGNOSA_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAGNOSA_ID->Lookup = new Lookup('DIAGNOSA_ID', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAGNOSA_ID->Lookup = new Lookup('DIAGNOSA_ID', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // DIAGNOSA_DESC
        $this->DIAGNOSA_DESC = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_DESC', 'DIAGNOSA_DESC', '[DIAGNOSA_DESC]', '[DIAGNOSA_DESC]', 200, 200, -1, false, '[DIAGNOSA_DESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_DESC'] = &$this->DIAGNOSA_DESC;

        // ANAMNASE
        $this->ANAMNASE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_ANAMNASE', 'ANAMNASE', '[ANAMNASE]', '[ANAMNASE]', 200, 200, -1, false, '[ANAMNASE]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ANAMNASE->Sortable = true; // Allow sort
        $this->ANAMNASE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ANAMNASE->Param, "CustomMsg");
        $this->Fields['ANAMNASE'] = &$this->ANAMNASE;

        // PEMERIKSAAN
        $this->PEMERIKSAAN = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PEMERIKSAAN', 'PEMERIKSAAN', '[PEMERIKSAAN]', '[PEMERIKSAAN]', 200, 200, -1, false, '[PEMERIKSAAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEMERIKSAAN->Sortable = true; // Allow sort
        $this->PEMERIKSAAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEMERIKSAAN->Param, "CustomMsg");
        $this->Fields['PEMERIKSAAN'] = &$this->PEMERIKSAAN;

        // TERAPHY_DESC
        $this->TERAPHY_DESC = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_TERAPHY_DESC', 'TERAPHY_DESC', '[TERAPHY_DESC]', '[TERAPHY_DESC]', 200, 200, -1, false, '[TERAPHY_DESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERAPHY_DESC->Sortable = true; // Allow sort
        $this->TERAPHY_DESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERAPHY_DESC->Param, "CustomMsg");
        $this->Fields['TERAPHY_DESC'] = &$this->TERAPHY_DESC;

        // INSTRUCTION
        $this->INSTRUCTION = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_INSTRUCTION', 'INSTRUCTION', '[INSTRUCTION]', '[INSTRUCTION]', 200, 200, -1, false, '[INSTRUCTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INSTRUCTION->Sortable = true; // Allow sort
        $this->INSTRUCTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INSTRUCTION->Param, "CustomMsg");
        $this->Fields['INSTRUCTION'] = &$this->INSTRUCTION;

        // SUFFER_TYPE
        $this->SUFFER_TYPE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_SUFFER_TYPE', 'SUFFER_TYPE', '[SUFFER_TYPE]', 'CAST([SUFFER_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[SUFFER_TYPE]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->SUFFER_TYPE->Sortable = true; // Allow sort
        $this->SUFFER_TYPE->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->SUFFER_TYPE->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->SUFFER_TYPE->Lookup = new Lookup('SUFFER_TYPE', 'SUFFER_TYPE', false, 'SUFFER_TYPE', ["SUFFER","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->SUFFER_TYPE->Lookup = new Lookup('SUFFER_TYPE', 'SUFFER_TYPE', false, 'SUFFER_TYPE', ["SUFFER","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->SUFFER_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SUFFER_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SUFFER_TYPE->Param, "CustomMsg");
        $this->Fields['SUFFER_TYPE'] = &$this->SUFFER_TYPE;

        // INFECTED_BODY
        $this->INFECTED_BODY = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_INFECTED_BODY', 'INFECTED_BODY', '[INFECTED_BODY]', 'CAST([INFECTED_BODY] AS NVARCHAR)', 17, 1, -1, false, '[INFECTED_BODY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFECTED_BODY->Sortable = true; // Allow sort
        $this->INFECTED_BODY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INFECTED_BODY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFECTED_BODY->Param, "CustomMsg");
        $this->Fields['INFECTED_BODY'] = &$this->INFECTED_BODY;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
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

        // RISK_LEVEL
        $this->RISK_LEVEL = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_RISK_LEVEL', 'RISK_LEVEL', '[RISK_LEVEL]', 'CAST([RISK_LEVEL] AS NVARCHAR)', 17, 1, -1, false, '[RISK_LEVEL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RISK_LEVEL->Sortable = true; // Allow sort
        $this->RISK_LEVEL->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RISK_LEVEL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RISK_LEVEL->Param, "CustomMsg");
        $this->Fields['RISK_LEVEL'] = &$this->RISK_LEVEL;

        // MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_MORFOLOGI_NEOPLASMA', 'MORFOLOGI_NEOPLASMA', '[MORFOLOGI_NEOPLASMA]', '[MORFOLOGI_NEOPLASMA]', 200, 200, -1, false, '[MORFOLOGI_NEOPLASMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MORFOLOGI_NEOPLASMA->Sortable = true; // Allow sort
        $this->MORFOLOGI_NEOPLASMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MORFOLOGI_NEOPLASMA->Param, "CustomMsg");
        $this->Fields['MORFOLOGI_NEOPLASMA'] = &$this->MORFOLOGI_NEOPLASMA;

        // HURT
        $this->HURT = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_HURT', 'HURT', '[HURT]', '[HURT]', 200, 200, -1, false, '[HURT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HURT->Sortable = true; // Allow sort
        $this->HURT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HURT->Param, "CustomMsg");
        $this->Fields['HURT'] = &$this->HURT;

        // HURT_TYPE
        $this->HURT_TYPE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_HURT_TYPE', 'HURT_TYPE', '[HURT_TYPE]', 'CAST([HURT_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[HURT_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HURT_TYPE->Sortable = true; // Allow sort
        $this->HURT_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->HURT_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HURT_TYPE->Param, "CustomMsg");
        $this->Fields['HURT_TYPE'] = &$this->HURT_TYPE;

        // DIAG_CAT
        $this->DIAG_CAT = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAG_CAT', 'DIAG_CAT', '[DIAG_CAT]', '[DIAG_CAT]', 129, 1, -1, false, '[DIAG_CAT]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAG_CAT->Sortable = true; // Allow sort
        $this->DIAG_CAT->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAG_CAT->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAG_CAT->Lookup = new Lookup('DIAG_CAT', 'DIAGNOSA_CATEGORY', false, 'DIAG_CAT', ["DIAGNOSA_CATEGORY","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAG_CAT->Lookup = new Lookup('DIAG_CAT', 'DIAGNOSA_CATEGORY', false, 'DIAG_CAT', ["DIAGNOSA_CATEGORY","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAG_CAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAG_CAT->Param, "CustomMsg");
        $this->Fields['DIAG_CAT'] = &$this->DIAG_CAT;

        // ADDICTION_MATERIAL
        $this->ADDICTION_MATERIAL = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_ADDICTION_MATERIAL', 'ADDICTION_MATERIAL', '[ADDICTION_MATERIAL]', '[ADDICTION_MATERIAL]', 200, 10, -1, false, '[ADDICTION_MATERIAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ADDICTION_MATERIAL->Sortable = true; // Allow sort
        $this->ADDICTION_MATERIAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ADDICTION_MATERIAL->Param, "CustomMsg");
        $this->Fields['ADDICTION_MATERIAL'] = &$this->ADDICTION_MATERIAL;

        // INFECTED_QUANTITY
        $this->INFECTED_QUANTITY = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_INFECTED_QUANTITY', 'INFECTED_QUANTITY', '[INFECTED_QUANTITY]', 'CAST([INFECTED_QUANTITY] AS NVARCHAR)', 2, 2, -1, false, '[INFECTED_QUANTITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFECTED_QUANTITY->Sortable = true; // Allow sort
        $this->INFECTED_QUANTITY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INFECTED_QUANTITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFECTED_QUANTITY->Param, "CustomMsg");
        $this->Fields['INFECTED_QUANTITY'] = &$this->INFECTED_QUANTITY;

        // CONTAGIOUS_TYPE
        $this->CONTAGIOUS_TYPE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_CONTAGIOUS_TYPE', 'CONTAGIOUS_TYPE', '[CONTAGIOUS_TYPE]', 'CAST([CONTAGIOUS_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[CONTAGIOUS_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTAGIOUS_TYPE->Sortable = true; // Allow sort
        $this->CONTAGIOUS_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CONTAGIOUS_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTAGIOUS_TYPE->Param, "CustomMsg");
        $this->Fields['CONTAGIOUS_TYPE'] = &$this->CONTAGIOUS_TYPE;

        // CURATIF_ID
        $this->CURATIF_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_CURATIF_ID', 'CURATIF_ID', '[CURATIF_ID]', 'CAST([CURATIF_ID] AS NVARCHAR)', 17, 1, -1, false, '[CURATIF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CURATIF_ID->Sortable = true; // Allow sort
        $this->CURATIF_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CURATIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CURATIF_ID->Param, "CustomMsg");
        $this->Fields['CURATIF_ID'] = &$this->CURATIF_ID;

        // RESULT_ID
        $this->RESULT_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_RESULT_ID', 'RESULT_ID', '[RESULT_ID]', 'CAST([RESULT_ID] AS NVARCHAR)', 17, 1, -1, false, '[RESULT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESULT_ID->Sortable = true; // Allow sort
        $this->RESULT_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RESULT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESULT_ID->Param, "CustomMsg");
        $this->Fields['RESULT_ID'] = &$this->RESULT_ID;

        // INFECTION_TYPE
        $this->INFECTION_TYPE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_INFECTION_TYPE', 'INFECTION_TYPE', '[INFECTION_TYPE]', 'CAST([INFECTION_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[INFECTION_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFECTION_TYPE->Sortable = true; // Allow sort
        $this->INFECTION_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INFECTION_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFECTION_TYPE->Param, "CustomMsg");
        $this->Fields['INFECTION_TYPE'] = &$this->INFECTION_TYPE;

        // INVESTIGATION_ID
        $this->INVESTIGATION_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_INVESTIGATION_ID', 'INVESTIGATION_ID', '[INVESTIGATION_ID]', 'CAST([INVESTIGATION_ID] AS NVARCHAR)', 17, 1, -1, false, '[INVESTIGATION_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->INVESTIGATION_ID->Sortable = true; // Allow sort
        $this->INVESTIGATION_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->INVESTIGATION_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->INVESTIGATION_ID->Lookup = new Lookup('INVESTIGATION_ID', 'INVESTIGATION_TYPE', false, 'INVESTIGATION_ID', ["INVESTIGATION","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->INVESTIGATION_ID->Lookup = new Lookup('INVESTIGATION_ID', 'INVESTIGATION_TYPE', false, 'INVESTIGATION_ID', ["INVESTIGATION","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->INVESTIGATION_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INVESTIGATION_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVESTIGATION_ID->Param, "CustomMsg");
        $this->Fields['INVESTIGATION_ID'] = &$this->INVESTIGATION_ID;

        // DISABILITY
        $this->DISABILITY = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DISABILITY', 'DISABILITY', '[DISABILITY]', '[DISABILITY]', 200, 200, -1, false, '[DISABILITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISABILITY->Sortable = true; // Allow sort
        $this->DISABILITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISABILITY->Param, "CustomMsg");
        $this->Fields['DISABILITY'] = &$this->DISABILITY;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 100, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DESCRIPTION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DESCRIPTION->Lookup = new Lookup('DESCRIPTION', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DESCRIPTION->Lookup = new Lookup('DESCRIPTION', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // KOMPLIKASI
        $this->KOMPLIKASI = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_KOMPLIKASI', 'KOMPLIKASI', '[KOMPLIKASI]', '[KOMPLIKASI]', 200, 255, -1, false, '[KOMPLIKASI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KOMPLIKASI->Sortable = true; // Allow sort
        $this->KOMPLIKASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KOMPLIKASI->Param, "CustomMsg");
        $this->Fields['KOMPLIKASI'] = &$this->KOMPLIKASI;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // AGEYEAR
        $this->AGEYEAR = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // THEADDRESS
        $this->THEADDRESS = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 150, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEID
        $this->THEID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 25, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = true; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->Fields['THEID'] = &$this->THEID;

        // ISRJ
        $this->ISRJ = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // GENDER
        $this->GENDER = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // DOCTOR
        $this->DOCTOR = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DOCTOR', 'DOCTOR', '[DOCTOR]', '[DOCTOR]', 200, 150, -1, false, '[DOCTOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR->Sortable = true; // Allow sort
        $this->DOCTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR->Param, "CustomMsg");
        $this->Fields['DOCTOR'] = &$this->DOCTOR;

        // KAL_ID
        $this->KAL_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // DIAGNOSA_ID_02
        $this->DIAGNOSA_ID_02 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_02', 'DIAGNOSA_ID_02', '[DIAGNOSA_ID_02]', '[DIAGNOSA_ID_02]', 200, 10, -1, false, '[DIAGNOSA_ID_02]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAGNOSA_ID_02->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_02->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAGNOSA_ID_02->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAGNOSA_ID_02->Lookup = new Lookup('DIAGNOSA_ID_02', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAGNOSA_ID_02->Lookup = new Lookup('DIAGNOSA_ID_02', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAGNOSA_ID_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_02->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_02'] = &$this->DIAGNOSA_ID_02;

        // DIAGNOSA_ID_03
        $this->DIAGNOSA_ID_03 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_03', 'DIAGNOSA_ID_03', '[DIAGNOSA_ID_03]', '[DIAGNOSA_ID_03]', 200, 10, -1, false, '[DIAGNOSA_ID_03]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAGNOSA_ID_03->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_03->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAGNOSA_ID_03->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAGNOSA_ID_03->Lookup = new Lookup('DIAGNOSA_ID_03', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAGNOSA_ID_03->Lookup = new Lookup('DIAGNOSA_ID_03', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAGNOSA_ID_03->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_03->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_03'] = &$this->DIAGNOSA_ID_03;

        // DIAGNOSA_ID_04
        $this->DIAGNOSA_ID_04 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_04', 'DIAGNOSA_ID_04', '[DIAGNOSA_ID_04]', '[DIAGNOSA_ID_04]', 200, 10, -1, false, '[DIAGNOSA_ID_04]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAGNOSA_ID_04->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_04->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAGNOSA_ID_04->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAGNOSA_ID_04->Lookup = new Lookup('DIAGNOSA_ID_04', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAGNOSA_ID_04->Lookup = new Lookup('DIAGNOSA_ID_04', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAGNOSA_ID_04->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_04->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_04'] = &$this->DIAGNOSA_ID_04;

        // DIAGNOSA_ID_05
        $this->DIAGNOSA_ID_05 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_05', 'DIAGNOSA_ID_05', '[DIAGNOSA_ID_05]', '[DIAGNOSA_ID_05]', 200, 10, -1, false, '[DIAGNOSA_ID_05]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAGNOSA_ID_05->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_05->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAGNOSA_ID_05->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAGNOSA_ID_05->Lookup = new Lookup('DIAGNOSA_ID_05', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAGNOSA_ID_05->Lookup = new Lookup('DIAGNOSA_ID_05', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAGNOSA_ID_05->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_05->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_05'] = &$this->DIAGNOSA_ID_05;

        // DIAGNOSA_ID_06
        $this->DIAGNOSA_ID_06 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_06', 'DIAGNOSA_ID_06', '[DIAGNOSA_ID_06]', '[DIAGNOSA_ID_06]', 200, 10, -1, false, '[DIAGNOSA_ID_06]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAGNOSA_ID_06->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_06->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAGNOSA_ID_06->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAGNOSA_ID_06->Lookup = new Lookup('DIAGNOSA_ID_06', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAGNOSA_ID_06->Lookup = new Lookup('DIAGNOSA_ID_06', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAGNOSA_ID_06->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_06->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_06'] = &$this->DIAGNOSA_ID_06;

        // DIAGNOSA_ID_07
        $this->DIAGNOSA_ID_07 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_07', 'DIAGNOSA_ID_07', '[DIAGNOSA_ID_07]', '[DIAGNOSA_ID_07]', 200, 10, -1, false, '[DIAGNOSA_ID_07]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_07->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_07->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_07->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_07'] = &$this->DIAGNOSA_ID_07;

        // DIAGNOSA_ID_08
        $this->DIAGNOSA_ID_08 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_08', 'DIAGNOSA_ID_08', '[DIAGNOSA_ID_08]', '[DIAGNOSA_ID_08]', 200, 10, -1, false, '[DIAGNOSA_ID_08]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_08->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_08->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_08->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_08'] = &$this->DIAGNOSA_ID_08;

        // DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_09', 'DIAGNOSA_ID_09', '[DIAGNOSA_ID_09]', '[DIAGNOSA_ID_09]', 200, 10, -1, false, '[DIAGNOSA_ID_09]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_09->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_09->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_09->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_09'] = &$this->DIAGNOSA_ID_09;

        // DIAGNOSA_ID_10
        $this->DIAGNOSA_ID_10 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID_10', 'DIAGNOSA_ID_10', '[DIAGNOSA_ID_10]', '[DIAGNOSA_ID_10]', 200, 10, -1, false, '[DIAGNOSA_ID_10]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_10->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_10->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_10->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID_10'] = &$this->DIAGNOSA_ID_10;

        // PROCEDURE_01
        $this->PROCEDURE_01 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_01', 'PROCEDURE_01', '[PROCEDURE_01]', '[PROCEDURE_01]', 200, 10, -1, false, '[PROCEDURE_01]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_01->Sortable = true; // Allow sort
        $this->PROCEDURE_01->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_01->Param, "CustomMsg");
        $this->Fields['PROCEDURE_01'] = &$this->PROCEDURE_01;

        // PROCEDURE_02
        $this->PROCEDURE_02 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_02', 'PROCEDURE_02', '[PROCEDURE_02]', '[PROCEDURE_02]', 200, 10, -1, false, '[PROCEDURE_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_02->Sortable = true; // Allow sort
        $this->PROCEDURE_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_02->Param, "CustomMsg");
        $this->Fields['PROCEDURE_02'] = &$this->PROCEDURE_02;

        // PROCEDURE_03
        $this->PROCEDURE_03 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_03', 'PROCEDURE_03', '[PROCEDURE_03]', '[PROCEDURE_03]', 200, 10, -1, false, '[PROCEDURE_03]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_03->Sortable = true; // Allow sort
        $this->PROCEDURE_03->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_03->Param, "CustomMsg");
        $this->Fields['PROCEDURE_03'] = &$this->PROCEDURE_03;

        // PROCEDURE_04
        $this->PROCEDURE_04 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_04', 'PROCEDURE_04', '[PROCEDURE_04]', '[PROCEDURE_04]', 200, 10, -1, false, '[PROCEDURE_04]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_04->Sortable = true; // Allow sort
        $this->PROCEDURE_04->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_04->Param, "CustomMsg");
        $this->Fields['PROCEDURE_04'] = &$this->PROCEDURE_04;

        // PROCEDURE_05
        $this->PROCEDURE_05 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_05', 'PROCEDURE_05', '[PROCEDURE_05]', '[PROCEDURE_05]', 200, 10, -1, false, '[PROCEDURE_05]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_05->Sortable = true; // Allow sort
        $this->PROCEDURE_05->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_05->Param, "CustomMsg");
        $this->Fields['PROCEDURE_05'] = &$this->PROCEDURE_05;

        // PROCEDURE_06
        $this->PROCEDURE_06 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_06', 'PROCEDURE_06', '[PROCEDURE_06]', '[PROCEDURE_06]', 200, 10, -1, false, '[PROCEDURE_06]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_06->Sortable = true; // Allow sort
        $this->PROCEDURE_06->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_06->Param, "CustomMsg");
        $this->Fields['PROCEDURE_06'] = &$this->PROCEDURE_06;

        // PROCEDURE_07
        $this->PROCEDURE_07 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_07', 'PROCEDURE_07', '[PROCEDURE_07]', '[PROCEDURE_07]', 200, 10, -1, false, '[PROCEDURE_07]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_07->Sortable = true; // Allow sort
        $this->PROCEDURE_07->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_07->Param, "CustomMsg");
        $this->Fields['PROCEDURE_07'] = &$this->PROCEDURE_07;

        // PROCEDURE_08
        $this->PROCEDURE_08 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_08', 'PROCEDURE_08', '[PROCEDURE_08]', '[PROCEDURE_08]', 200, 10, -1, false, '[PROCEDURE_08]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_08->Sortable = true; // Allow sort
        $this->PROCEDURE_08->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_08->Param, "CustomMsg");
        $this->Fields['PROCEDURE_08'] = &$this->PROCEDURE_08;

        // PROCEDURE_09
        $this->PROCEDURE_09 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_09', 'PROCEDURE_09', '[PROCEDURE_09]', '[PROCEDURE_09]', 200, 10, -1, false, '[PROCEDURE_09]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_09->Sortable = true; // Allow sort
        $this->PROCEDURE_09->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_09->Param, "CustomMsg");
        $this->Fields['PROCEDURE_09'] = &$this->PROCEDURE_09;

        // PROCEDURE_10
        $this->PROCEDURE_10 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_10', 'PROCEDURE_10', '[PROCEDURE_10]', '[PROCEDURE_10]', 200, 10, -1, false, '[PROCEDURE_10]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_10->Sortable = true; // Allow sort
        $this->PROCEDURE_10->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_10->Param, "CustomMsg");
        $this->Fields['PROCEDURE_10'] = &$this->PROCEDURE_10;

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_ID2', 'DIAGNOSA_ID2', '[DIAGNOSA_ID2]', '[DIAGNOSA_ID2]', 200, 50, -1, false, '[DIAGNOSA_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID2->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID2->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID2'] = &$this->DIAGNOSA_ID2;

        // WEIGHT
        $this->WEIGHT = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_WEIGHT', 'WEIGHT', '[WEIGHT]', 'CAST([WEIGHT] AS NVARCHAR)', 131, 8, -1, false, '[WEIGHT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WEIGHT->Sortable = true; // Allow sort
        $this->WEIGHT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->WEIGHT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->WEIGHT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WEIGHT->Param, "CustomMsg");
        $this->Fields['WEIGHT'] = &$this->WEIGHT;

        // NOKARTU
        $this->NOKARTU = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_NOKARTU', 'NOKARTU', '[NOKARTU]', '[NOKARTU]', 200, 50, -1, false, '[NOKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOKARTU->Sortable = true; // Allow sort
        $this->NOKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOKARTU->Param, "CustomMsg");
        $this->Fields['NOKARTU'] = &$this->NOKARTU;

        // NOSEP
        $this->NOSEP = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_NOSEP', 'NOSEP', '[NOSEP]', '[NOSEP]', 200, 50, -1, false, '[NOSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSEP->Sortable = true; // Allow sort
        $this->NOSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSEP->Param, "CustomMsg");
        $this->Fields['NOSEP'] = &$this->NOSEP;

        // TGLSEP
        $this->TGLSEP = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_TGLSEP', 'TGLSEP', '[TGLSEP]', CastDateFieldForLike("[TGLSEP]", 0, "DB"), 135, 8, 0, false, '[TGLSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLSEP->Sortable = true; // Allow sort
        $this->TGLSEP->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLSEP->Param, "CustomMsg");
        $this->Fields['TGLSEP'] = &$this->TGLSEP;

        // RENCANATL
        $this->RENCANATL = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_RENCANATL', 'RENCANATL', '[RENCANATL]', '[RENCANATL]', 200, 3, -1, false, '[RENCANATL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RENCANATL->Sortable = true; // Allow sort
        $this->RENCANATL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RENCANATL->Param, "CustomMsg");
        $this->Fields['RENCANATL'] = &$this->RENCANATL;

        // DIRUJUKKE
        $this->DIRUJUKKE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIRUJUKKE', 'DIRUJUKKE', '[DIRUJUKKE]', '[DIRUJUKKE]', 200, 10, -1, false, '[DIRUJUKKE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIRUJUKKE->Sortable = true; // Allow sort
        $this->DIRUJUKKE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIRUJUKKE->Param, "CustomMsg");
        $this->Fields['DIRUJUKKE'] = &$this->DIRUJUKKE;

        // TGLKONTROL
        $this->TGLKONTROL = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_TGLKONTROL', 'TGLKONTROL', '[TGLKONTROL]', CastDateFieldForLike("[TGLKONTROL]", 0, "DB"), 135, 8, 0, false, '[TGLKONTROL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLKONTROL->Sortable = true; // Allow sort
        $this->TGLKONTROL->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLKONTROL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLKONTROL->Param, "CustomMsg");
        $this->Fields['TGLKONTROL'] = &$this->TGLKONTROL;

        // KDPOLI_KONTROL
        $this->KDPOLI_KONTROL = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_KDPOLI_KONTROL', 'KDPOLI_KONTROL', '[KDPOLI_KONTROL]', '[KDPOLI_KONTROL]', 200, 10, -1, false, '[KDPOLI_KONTROL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDPOLI_KONTROL->Sortable = true; // Allow sort
        $this->KDPOLI_KONTROL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDPOLI_KONTROL->Param, "CustomMsg");
        $this->Fields['KDPOLI_KONTROL'] = &$this->KDPOLI_KONTROL;

        // JAMINAN
        $this->JAMINAN = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_JAMINAN', 'JAMINAN', '[JAMINAN]', '[JAMINAN]', 200, 1, -1, false, '[JAMINAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JAMINAN->Sortable = true; // Allow sort
        $this->JAMINAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JAMINAN->Param, "CustomMsg");
        $this->Fields['JAMINAN'] = &$this->JAMINAN;

        // SPESIALISTIK
        $this->SPESIALISTIK = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_SPESIALISTIK', 'SPESIALISTIK', '[SPESIALISTIK]', '[SPESIALISTIK]', 200, 3, -1, false, '[SPESIALISTIK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPESIALISTIK->Sortable = true; // Allow sort
        $this->SPESIALISTIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPESIALISTIK->Param, "CustomMsg");
        $this->Fields['SPESIALISTIK'] = &$this->SPESIALISTIK;

        // PEMERIKSAAN_02
        $this->PEMERIKSAAN_02 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PEMERIKSAAN_02', 'PEMERIKSAAN_02', '[PEMERIKSAAN_02]', '[PEMERIKSAAN_02]', 200, 250, -1, false, '[PEMERIKSAAN_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEMERIKSAAN_02->Sortable = true; // Allow sort
        $this->PEMERIKSAAN_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEMERIKSAAN_02->Param, "CustomMsg");
        $this->Fields['PEMERIKSAAN_02'] = &$this->PEMERIKSAAN_02;

        // DIAGNOSA_DESC_02
        $this->DIAGNOSA_DESC_02 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_DESC_02', 'DIAGNOSA_DESC_02', '[DIAGNOSA_DESC_02]', '[DIAGNOSA_DESC_02]', 200, 250, -1, false, '[DIAGNOSA_DESC_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_02->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_02->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_DESC_02'] = &$this->DIAGNOSA_DESC_02;

        // DIAGNOSA_DESC_03
        $this->DIAGNOSA_DESC_03 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_DESC_03', 'DIAGNOSA_DESC_03', '[DIAGNOSA_DESC_03]', '[DIAGNOSA_DESC_03]', 200, 250, -1, false, '[DIAGNOSA_DESC_03]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_03->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_03->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_03->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_DESC_03'] = &$this->DIAGNOSA_DESC_03;

        // DIAGNOSA_DESC_04
        $this->DIAGNOSA_DESC_04 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_DESC_04', 'DIAGNOSA_DESC_04', '[DIAGNOSA_DESC_04]', '[DIAGNOSA_DESC_04]', 200, 250, -1, false, '[DIAGNOSA_DESC_04]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_04->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_04->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_04->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_DESC_04'] = &$this->DIAGNOSA_DESC_04;

        // DIAGNOSA_DESC_05
        $this->DIAGNOSA_DESC_05 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_DESC_05', 'DIAGNOSA_DESC_05', '[DIAGNOSA_DESC_05]', '[DIAGNOSA_DESC_05]', 200, 250, -1, false, '[DIAGNOSA_DESC_05]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_05->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_05->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_05->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_DESC_05'] = &$this->DIAGNOSA_DESC_05;

        // DIAGNOSA_DESC_06
        $this->DIAGNOSA_DESC_06 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_DIAGNOSA_DESC_06', 'DIAGNOSA_DESC_06', '[DIAGNOSA_DESC_06]', '[DIAGNOSA_DESC_06]', 200, 250, -1, false, '[DIAGNOSA_DESC_06]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_06->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_06->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_06->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_DESC_06'] = &$this->DIAGNOSA_DESC_06;

        // PROCEDURE_DESC_01
        $this->PROCEDURE_DESC_01 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_DESC_01', 'PROCEDURE_DESC_01', '[PROCEDURE_DESC_01]', '[PROCEDURE_DESC_01]', 200, 250, -1, false, '[PROCEDURE_DESC_01]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_01->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_01->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_01->Param, "CustomMsg");
        $this->Fields['PROCEDURE_DESC_01'] = &$this->PROCEDURE_DESC_01;

        // PROCEDURE_DESC_02
        $this->PROCEDURE_DESC_02 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_DESC_02', 'PROCEDURE_DESC_02', '[PROCEDURE_DESC_02]', '[PROCEDURE_DESC_02]', 200, 250, -1, false, '[PROCEDURE_DESC_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_02->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_02->Param, "CustomMsg");
        $this->Fields['PROCEDURE_DESC_02'] = &$this->PROCEDURE_DESC_02;

        // PROCEDURE_DESC_03
        $this->PROCEDURE_DESC_03 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_DESC_03', 'PROCEDURE_DESC_03', '[PROCEDURE_DESC_03]', '[PROCEDURE_DESC_03]', 200, 250, -1, false, '[PROCEDURE_DESC_03]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_03->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_03->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_03->Param, "CustomMsg");
        $this->Fields['PROCEDURE_DESC_03'] = &$this->PROCEDURE_DESC_03;

        // PROCEDURE_DESC_04
        $this->PROCEDURE_DESC_04 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_DESC_04', 'PROCEDURE_DESC_04', '[PROCEDURE_DESC_04]', '[PROCEDURE_DESC_04]', 200, 250, -1, false, '[PROCEDURE_DESC_04]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_04->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_04->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_04->Param, "CustomMsg");
        $this->Fields['PROCEDURE_DESC_04'] = &$this->PROCEDURE_DESC_04;

        // PROCEDURE_DESC_05
        $this->PROCEDURE_DESC_05 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_PROCEDURE_DESC_05', 'PROCEDURE_DESC_05', '[PROCEDURE_DESC_05]', '[PROCEDURE_DESC_05]', 200, 250, -1, false, '[PROCEDURE_DESC_05]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_05->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_05->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_05->Param, "CustomMsg");
        $this->Fields['PROCEDURE_DESC_05'] = &$this->PROCEDURE_DESC_05;

        // RESPONPOST
        $this->RESPONPOST = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_RESPONPOST', 'RESPONPOST', '[RESPONPOST]', '[RESPONPOST]', 201, 0, -1, false, '[RESPONPOST]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONPOST->Sortable = true; // Allow sort
        $this->RESPONPOST->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONPOST->Param, "CustomMsg");
        $this->Fields['RESPONPOST'] = &$this->RESPONPOST;

        // RESPONPUT
        $this->RESPONPUT = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_RESPONPUT', 'RESPONPUT', '[RESPONPUT]', '[RESPONPUT]', 201, 0, -1, false, '[RESPONPUT]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONPUT->Sortable = true; // Allow sort
        $this->RESPONPUT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONPUT->Param, "CustomMsg");
        $this->Fields['RESPONPUT'] = &$this->RESPONPUT;

        // RESPONDEL
        $this->RESPONDEL = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_RESPONDEL', 'RESPONDEL', '[RESPONDEL]', '[RESPONDEL]', 201, 0, -1, false, '[RESPONDEL]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONDEL->Sortable = true; // Allow sort
        $this->RESPONDEL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONDEL->Param, "CustomMsg");
        $this->Fields['RESPONDEL'] = &$this->RESPONDEL;

        // JSONPOST
        $this->JSONPOST = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_JSONPOST', 'JSONPOST', '[JSONPOST]', '[JSONPOST]', 201, 0, -1, false, '[JSONPOST]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->JSONPOST->Sortable = true; // Allow sort
        $this->JSONPOST->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JSONPOST->Param, "CustomMsg");
        $this->Fields['JSONPOST'] = &$this->JSONPOST;

        // JSONPUT
        $this->JSONPUT = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_JSONPUT', 'JSONPUT', '[JSONPUT]', '[JSONPUT]', 201, 0, -1, false, '[JSONPUT]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->JSONPUT->Sortable = true; // Allow sort
        $this->JSONPUT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JSONPUT->Param, "CustomMsg");
        $this->Fields['JSONPUT'] = &$this->JSONPUT;

        // JSONDEL
        $this->JSONDEL = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_JSONDEL', 'JSONDEL', '[JSONDEL]', '[JSONDEL]', 201, 0, -1, false, '[JSONDEL]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->JSONDEL->Sortable = true; // Allow sort
        $this->JSONDEL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JSONDEL->Param, "CustomMsg");
        $this->Fields['JSONDEL'] = &$this->JSONDEL;

        // height
        $this->height = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_height', 'height', '[height]', '[height]', 200, 5, -1, false, '[height]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->height->Sortable = true; // Allow sort
        $this->height->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->height->Param, "CustomMsg");
        $this->Fields['height'] = &$this->height;

        // TEMPERATURE
        $this->TEMPERATURE = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_TEMPERATURE', 'TEMPERATURE', '[TEMPERATURE]', 'CAST([TEMPERATURE] AS NVARCHAR)', 131, 8, -1, false, '[TEMPERATURE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TEMPERATURE->Sortable = true; // Allow sort
        $this->TEMPERATURE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TEMPERATURE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TEMPERATURE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TEMPERATURE->Param, "CustomMsg");
        $this->Fields['TEMPERATURE'] = &$this->TEMPERATURE;

        // TENSION_UPPER
        $this->TENSION_UPPER = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_TENSION_UPPER', 'TENSION_UPPER', '[TENSION_UPPER]', 'CAST([TENSION_UPPER] AS NVARCHAR)', 131, 8, -1, false, '[TENSION_UPPER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENSION_UPPER->Sortable = true; // Allow sort
        $this->TENSION_UPPER->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TENSION_UPPER->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TENSION_UPPER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENSION_UPPER->Param, "CustomMsg");
        $this->Fields['TENSION_UPPER'] = &$this->TENSION_UPPER;

        // TENSION_BELOW
        $this->TENSION_BELOW = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_TENSION_BELOW', 'TENSION_BELOW', '[TENSION_BELOW]', 'CAST([TENSION_BELOW] AS NVARCHAR)', 131, 8, -1, false, '[TENSION_BELOW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENSION_BELOW->Sortable = true; // Allow sort
        $this->TENSION_BELOW->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TENSION_BELOW->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TENSION_BELOW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENSION_BELOW->Param, "CustomMsg");
        $this->Fields['TENSION_BELOW'] = &$this->TENSION_BELOW;

        // NADI
        $this->NADI = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_NADI', 'NADI', '[NADI]', 'CAST([NADI] AS NVARCHAR)', 131, 8, -1, false, '[NADI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NADI->Sortable = true; // Allow sort
        $this->NADI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NADI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NADI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NADI->Param, "CustomMsg");
        $this->Fields['NADI'] = &$this->NADI;

        // NAFAS
        $this->NAFAS = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_NAFAS', 'NAFAS', '[NAFAS]', 'CAST([NAFAS] AS NVARCHAR)', 131, 8, -1, false, '[NAFAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAFAS->Sortable = true; // Allow sort
        $this->NAFAS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NAFAS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NAFAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAFAS->Param, "CustomMsg");
        $this->Fields['NAFAS'] = &$this->NAFAS;

        // spec_procedures
        $this->spec_procedures = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_spec_procedures', 'spec_procedures', '[spec_procedures]', '[spec_procedures]', 200, 200, -1, false, '[spec_procedures]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spec_procedures->Sortable = true; // Allow sort
        $this->spec_procedures->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spec_procedures->Param, "CustomMsg");
        $this->Fields['spec_procedures'] = &$this->spec_procedures;

        // spec_drug
        $this->spec_drug = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_spec_drug', 'spec_drug', '[spec_drug]', '[spec_drug]', 200, 200, -1, false, '[spec_drug]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spec_drug->Sortable = true; // Allow sort
        $this->spec_drug->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spec_drug->Param, "CustomMsg");
        $this->Fields['spec_drug'] = &$this->spec_drug;

        // spec_prothesis
        $this->spec_prothesis = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_spec_prothesis', 'spec_prothesis', '[spec_prothesis]', '[spec_prothesis]', 200, 200, -1, false, '[spec_prothesis]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spec_prothesis->Sortable = true; // Allow sort
        $this->spec_prothesis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spec_prothesis->Param, "CustomMsg");
        $this->Fields['spec_prothesis'] = &$this->spec_prothesis;

        // spec_investigation
        $this->spec_investigation = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_spec_investigation', 'spec_investigation', '[spec_investigation]', '[spec_investigation]', 200, 200, -1, false, '[spec_investigation]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spec_investigation->Sortable = true; // Allow sort
        $this->spec_investigation->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spec_investigation->Param, "CustomMsg");
        $this->Fields['spec_investigation'] = &$this->spec_investigation;

        // procedure_11
        $this->procedure_11 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_procedure_11', 'procedure_11', '[procedure_11]', '[procedure_11]', 200, 10, -1, false, '[procedure_11]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_11->Sortable = true; // Allow sort
        $this->procedure_11->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_11->Param, "CustomMsg");
        $this->Fields['procedure_11'] = &$this->procedure_11;

        // procedure_12
        $this->procedure_12 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_procedure_12', 'procedure_12', '[procedure_12]', '[procedure_12]', 200, 10, -1, false, '[procedure_12]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_12->Sortable = true; // Allow sort
        $this->procedure_12->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_12->Param, "CustomMsg");
        $this->Fields['procedure_12'] = &$this->procedure_12;

        // procedure_13
        $this->procedure_13 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_procedure_13', 'procedure_13', '[procedure_13]', '[procedure_13]', 200, 10, -1, false, '[procedure_13]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_13->Sortable = true; // Allow sort
        $this->procedure_13->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_13->Param, "CustomMsg");
        $this->Fields['procedure_13'] = &$this->procedure_13;

        // procedure_14
        $this->procedure_14 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_procedure_14', 'procedure_14', '[procedure_14]', '[procedure_14]', 200, 10, -1, false, '[procedure_14]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_14->Sortable = true; // Allow sort
        $this->procedure_14->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_14->Param, "CustomMsg");
        $this->Fields['procedure_14'] = &$this->procedure_14;

        // procedure_15
        $this->procedure_15 = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_procedure_15', 'procedure_15', '[procedure_15]', '[procedure_15]', 200, 10, -1, false, '[procedure_15]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_15->Sortable = true; // Allow sort
        $this->procedure_15->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_15->Param, "CustomMsg");
        $this->Fields['procedure_15'] = &$this->procedure_15;

        // isanestesi
        $this->isanestesi = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_isanestesi', 'isanestesi', '[isanestesi]', '[isanestesi]', 129, 1, -1, false, '[isanestesi]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isanestesi->Sortable = true; // Allow sort
        $this->isanestesi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isanestesi->Param, "CustomMsg");
        $this->Fields['isanestesi'] = &$this->isanestesi;

        // isreposisi
        $this->isreposisi = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_isreposisi', 'isreposisi', '[isreposisi]', '[isreposisi]', 129, 1, -1, false, '[isreposisi]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isreposisi->Sortable = true; // Allow sort
        $this->isreposisi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isreposisi->Param, "CustomMsg");
        $this->Fields['isreposisi'] = &$this->isreposisi;

        // islab
        $this->islab = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_islab', 'islab', '[islab]', '[islab]', 129, 1, -1, false, '[islab]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->islab->Sortable = true; // Allow sort
        $this->islab->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->islab->Param, "CustomMsg");
        $this->Fields['islab'] = &$this->islab;

        // isro
        $this->isro = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_isro', 'isro', '[isro]', '[isro]', 129, 1, -1, false, '[isro]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isro->Sortable = true; // Allow sort
        $this->isro->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isro->Param, "CustomMsg");
        $this->Fields['isro'] = &$this->isro;

        // isekg
        $this->isekg = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_isekg', 'isekg', '[isekg]', '[isekg]', 129, 1, -1, false, '[isekg]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isekg->Sortable = true; // Allow sort
        $this->isekg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isekg->Param, "CustomMsg");
        $this->Fields['isekg'] = &$this->isekg;

        // ishecting
        $this->ishecting = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_ishecting', 'ishecting', '[ishecting]', '[ishecting]', 129, 1, -1, false, '[ishecting]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ishecting->Sortable = true; // Allow sort
        $this->ishecting->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ishecting->Param, "CustomMsg");
        $this->Fields['ishecting'] = &$this->ishecting;

        // isgips
        $this->isgips = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_isgips', 'isgips', '[isgips]', '[isgips]', 129, 1, -1, false, '[isgips]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isgips->Sortable = true; // Allow sort
        $this->isgips->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isgips->Param, "CustomMsg");
        $this->Fields['isgips'] = &$this->isgips;

        // islengkap
        $this->islengkap = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_islengkap', 'islengkap', '[islengkap]', '[islengkap]', 129, 1, -1, false, '[islengkap]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->islengkap->Sortable = true; // Allow sort
        $this->islengkap->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->islengkap->Param, "CustomMsg");
        $this->Fields['islengkap'] = &$this->islengkap;

        // ID
        $this->ID = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 3, 4, -1, false, '[ID]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->Nullable = false; // NOT NULL field
        $this->ID->Sortable = true; // Allow sort
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID->Param, "CustomMsg");
        $this->Fields['ID'] = &$this->ID;

        // IDXDAFTAR
        $this->IDXDAFTAR = new DbField('PASIEN_DIAGNOSA', 'PASIEN_DIAGNOSA', 'x_IDXDAFTAR', 'IDXDAFTAR', '[IDXDAFTAR]', 'CAST([IDXDAFTAR] AS NVARCHAR)', 3, 4, -1, false, '[IDXDAFTAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IDXDAFTAR->Sortable = true; // Allow sort
        $this->IDXDAFTAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->IDXDAFTAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IDXDAFTAR->Param, "CustomMsg");
        $this->Fields['IDXDAFTAR'] = &$this->IDXDAFTAR;
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
        if ($this->getCurrentMasterTable() == "V_RIWAYAT_RM") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("dbo.PASIEN_VISITATION.VISIT_ID", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
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
        if ($this->getCurrentMasterTable() == "V_RIWAYAT_RM") {
            if ($this->VISIT_ID->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("[VISIT_ID]", $this->VISIT_ID->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    // Master filter
    public function sqlMasterFilter_V_RIWAYAT_RM()
    {
        return "dbo.PASIEN_VISITATION.VISIT_ID='@VISIT_ID@'";
    }
    // Detail filter
    public function sqlDetailFilter_V_RIWAYAT_RM()
    {
        return "[VISIT_ID]='@VISIT_ID@'";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[PASIEN_DIAGNOSA]";
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
        $this->PASIEN_DIAGNOSA_ID->DbValue = $row['PASIEN_DIAGNOSA_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->THENAME->DbValue = $row['THENAME'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->BILL_ID->DbValue = $row['BILL_ID'];
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->IN_DATE->DbValue = $row['IN_DATE'];
        $this->EXIT_DATE->DbValue = $row['EXIT_DATE'];
        $this->BED_ID->DbValue = $row['BED_ID'];
        $this->KELUAR_ID->DbValue = $row['KELUAR_ID'];
        $this->DATE_OF_DIAGNOSA->DbValue = $row['DATE_OF_DIAGNOSA'];
        $this->REPORT_DATE->DbValue = $row['REPORT_DATE'];
        $this->DIAGNOSA_ID->DbValue = $row['DIAGNOSA_ID'];
        $this->DIAGNOSA_DESC->DbValue = $row['DIAGNOSA_DESC'];
        $this->ANAMNASE->DbValue = $row['ANAMNASE'];
        $this->PEMERIKSAAN->DbValue = $row['PEMERIKSAAN'];
        $this->TERAPHY_DESC->DbValue = $row['TERAPHY_DESC'];
        $this->INSTRUCTION->DbValue = $row['INSTRUCTION'];
        $this->SUFFER_TYPE->DbValue = $row['SUFFER_TYPE'];
        $this->INFECTED_BODY->DbValue = $row['INFECTED_BODY'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->RISK_LEVEL->DbValue = $row['RISK_LEVEL'];
        $this->MORFOLOGI_NEOPLASMA->DbValue = $row['MORFOLOGI_NEOPLASMA'];
        $this->HURT->DbValue = $row['HURT'];
        $this->HURT_TYPE->DbValue = $row['HURT_TYPE'];
        $this->DIAG_CAT->DbValue = $row['DIAG_CAT'];
        $this->ADDICTION_MATERIAL->DbValue = $row['ADDICTION_MATERIAL'];
        $this->INFECTED_QUANTITY->DbValue = $row['INFECTED_QUANTITY'];
        $this->CONTAGIOUS_TYPE->DbValue = $row['CONTAGIOUS_TYPE'];
        $this->CURATIF_ID->DbValue = $row['CURATIF_ID'];
        $this->RESULT_ID->DbValue = $row['RESULT_ID'];
        $this->INFECTION_TYPE->DbValue = $row['INFECTION_TYPE'];
        $this->INVESTIGATION_ID->DbValue = $row['INVESTIGATION_ID'];
        $this->DISABILITY->DbValue = $row['DISABILITY'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->KOMPLIKASI->DbValue = $row['KOMPLIKASI'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->AGEYEAR->DbValue = $row['AGEYEAR'];
        $this->AGEMONTH->DbValue = $row['AGEMONTH'];
        $this->AGEDAY->DbValue = $row['AGEDAY'];
        $this->THEADDRESS->DbValue = $row['THEADDRESS'];
        $this->THEID->DbValue = $row['THEID'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->DOCTOR->DbValue = $row['DOCTOR'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->DIAGNOSA_ID_02->DbValue = $row['DIAGNOSA_ID_02'];
        $this->DIAGNOSA_ID_03->DbValue = $row['DIAGNOSA_ID_03'];
        $this->DIAGNOSA_ID_04->DbValue = $row['DIAGNOSA_ID_04'];
        $this->DIAGNOSA_ID_05->DbValue = $row['DIAGNOSA_ID_05'];
        $this->DIAGNOSA_ID_06->DbValue = $row['DIAGNOSA_ID_06'];
        $this->DIAGNOSA_ID_07->DbValue = $row['DIAGNOSA_ID_07'];
        $this->DIAGNOSA_ID_08->DbValue = $row['DIAGNOSA_ID_08'];
        $this->DIAGNOSA_ID_09->DbValue = $row['DIAGNOSA_ID_09'];
        $this->DIAGNOSA_ID_10->DbValue = $row['DIAGNOSA_ID_10'];
        $this->PROCEDURE_01->DbValue = $row['PROCEDURE_01'];
        $this->PROCEDURE_02->DbValue = $row['PROCEDURE_02'];
        $this->PROCEDURE_03->DbValue = $row['PROCEDURE_03'];
        $this->PROCEDURE_04->DbValue = $row['PROCEDURE_04'];
        $this->PROCEDURE_05->DbValue = $row['PROCEDURE_05'];
        $this->PROCEDURE_06->DbValue = $row['PROCEDURE_06'];
        $this->PROCEDURE_07->DbValue = $row['PROCEDURE_07'];
        $this->PROCEDURE_08->DbValue = $row['PROCEDURE_08'];
        $this->PROCEDURE_09->DbValue = $row['PROCEDURE_09'];
        $this->PROCEDURE_10->DbValue = $row['PROCEDURE_10'];
        $this->DIAGNOSA_ID2->DbValue = $row['DIAGNOSA_ID2'];
        $this->WEIGHT->DbValue = $row['WEIGHT'];
        $this->NOKARTU->DbValue = $row['NOKARTU'];
        $this->NOSEP->DbValue = $row['NOSEP'];
        $this->TGLSEP->DbValue = $row['TGLSEP'];
        $this->RENCANATL->DbValue = $row['RENCANATL'];
        $this->DIRUJUKKE->DbValue = $row['DIRUJUKKE'];
        $this->TGLKONTROL->DbValue = $row['TGLKONTROL'];
        $this->KDPOLI_KONTROL->DbValue = $row['KDPOLI_KONTROL'];
        $this->JAMINAN->DbValue = $row['JAMINAN'];
        $this->SPESIALISTIK->DbValue = $row['SPESIALISTIK'];
        $this->PEMERIKSAAN_02->DbValue = $row['PEMERIKSAAN_02'];
        $this->DIAGNOSA_DESC_02->DbValue = $row['DIAGNOSA_DESC_02'];
        $this->DIAGNOSA_DESC_03->DbValue = $row['DIAGNOSA_DESC_03'];
        $this->DIAGNOSA_DESC_04->DbValue = $row['DIAGNOSA_DESC_04'];
        $this->DIAGNOSA_DESC_05->DbValue = $row['DIAGNOSA_DESC_05'];
        $this->DIAGNOSA_DESC_06->DbValue = $row['DIAGNOSA_DESC_06'];
        $this->PROCEDURE_DESC_01->DbValue = $row['PROCEDURE_DESC_01'];
        $this->PROCEDURE_DESC_02->DbValue = $row['PROCEDURE_DESC_02'];
        $this->PROCEDURE_DESC_03->DbValue = $row['PROCEDURE_DESC_03'];
        $this->PROCEDURE_DESC_04->DbValue = $row['PROCEDURE_DESC_04'];
        $this->PROCEDURE_DESC_05->DbValue = $row['PROCEDURE_DESC_05'];
        $this->RESPONPOST->DbValue = $row['RESPONPOST'];
        $this->RESPONPUT->DbValue = $row['RESPONPUT'];
        $this->RESPONDEL->DbValue = $row['RESPONDEL'];
        $this->JSONPOST->DbValue = $row['JSONPOST'];
        $this->JSONPUT->DbValue = $row['JSONPUT'];
        $this->JSONDEL->DbValue = $row['JSONDEL'];
        $this->height->DbValue = $row['height'];
        $this->TEMPERATURE->DbValue = $row['TEMPERATURE'];
        $this->TENSION_UPPER->DbValue = $row['TENSION_UPPER'];
        $this->TENSION_BELOW->DbValue = $row['TENSION_BELOW'];
        $this->NADI->DbValue = $row['NADI'];
        $this->NAFAS->DbValue = $row['NAFAS'];
        $this->spec_procedures->DbValue = $row['spec_procedures'];
        $this->spec_drug->DbValue = $row['spec_drug'];
        $this->spec_prothesis->DbValue = $row['spec_prothesis'];
        $this->spec_investigation->DbValue = $row['spec_investigation'];
        $this->procedure_11->DbValue = $row['procedure_11'];
        $this->procedure_12->DbValue = $row['procedure_12'];
        $this->procedure_13->DbValue = $row['procedure_13'];
        $this->procedure_14->DbValue = $row['procedure_14'];
        $this->procedure_15->DbValue = $row['procedure_15'];
        $this->isanestesi->DbValue = $row['isanestesi'];
        $this->isreposisi->DbValue = $row['isreposisi'];
        $this->islab->DbValue = $row['islab'];
        $this->isro->DbValue = $row['isro'];
        $this->isekg->DbValue = $row['isekg'];
        $this->ishecting->DbValue = $row['ishecting'];
        $this->isgips->DbValue = $row['isgips'];
        $this->islengkap->DbValue = $row['islengkap'];
        $this->ID->DbValue = $row['ID'];
        $this->IDXDAFTAR->DbValue = $row['IDXDAFTAR'];
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
        return $_SESSION[$name] ?? GetUrl("PasienDiagnosaList");
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
        if ($pageName == "PasienDiagnosaView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PasienDiagnosaEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PasienDiagnosaAdd") {
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
                return "PasienDiagnosaView";
            case Config("API_ADD_ACTION"):
                return "PasienDiagnosaAdd";
            case Config("API_EDIT_ACTION"):
                return "PasienDiagnosaEdit";
            case Config("API_DELETE_ACTION"):
                return "PasienDiagnosaDelete";
            case Config("API_LIST_ACTION"):
                return "PasienDiagnosaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PasienDiagnosaList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PasienDiagnosaView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PasienDiagnosaView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PasienDiagnosaAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PasienDiagnosaAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PasienDiagnosaEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PasienDiagnosaAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PasienDiagnosaDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "V_RIWAYAT_RM" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
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
        $this->PASIEN_DIAGNOSA_ID->setDbValue($row['PASIEN_DIAGNOSA_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->IN_DATE->setDbValue($row['IN_DATE']);
        $this->EXIT_DATE->setDbValue($row['EXIT_DATE']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->DATE_OF_DIAGNOSA->setDbValue($row['DATE_OF_DIAGNOSA']);
        $this->REPORT_DATE->setDbValue($row['REPORT_DATE']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->DIAGNOSA_DESC->setDbValue($row['DIAGNOSA_DESC']);
        $this->ANAMNASE->setDbValue($row['ANAMNASE']);
        $this->PEMERIKSAAN->setDbValue($row['PEMERIKSAAN']);
        $this->TERAPHY_DESC->setDbValue($row['TERAPHY_DESC']);
        $this->INSTRUCTION->setDbValue($row['INSTRUCTION']);
        $this->SUFFER_TYPE->setDbValue($row['SUFFER_TYPE']);
        $this->INFECTED_BODY->setDbValue($row['INFECTED_BODY']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->RISK_LEVEL->setDbValue($row['RISK_LEVEL']);
        $this->MORFOLOGI_NEOPLASMA->setDbValue($row['MORFOLOGI_NEOPLASMA']);
        $this->HURT->setDbValue($row['HURT']);
        $this->HURT_TYPE->setDbValue($row['HURT_TYPE']);
        $this->DIAG_CAT->setDbValue($row['DIAG_CAT']);
        $this->ADDICTION_MATERIAL->setDbValue($row['ADDICTION_MATERIAL']);
        $this->INFECTED_QUANTITY->setDbValue($row['INFECTED_QUANTITY']);
        $this->CONTAGIOUS_TYPE->setDbValue($row['CONTAGIOUS_TYPE']);
        $this->CURATIF_ID->setDbValue($row['CURATIF_ID']);
        $this->RESULT_ID->setDbValue($row['RESULT_ID']);
        $this->INFECTION_TYPE->setDbValue($row['INFECTION_TYPE']);
        $this->INVESTIGATION_ID->setDbValue($row['INVESTIGATION_ID']);
        $this->DISABILITY->setDbValue($row['DISABILITY']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->KOMPLIKASI->setDbValue($row['KOMPLIKASI']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEID->setDbValue($row['THEID']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->DIAGNOSA_ID_02->setDbValue($row['DIAGNOSA_ID_02']);
        $this->DIAGNOSA_ID_03->setDbValue($row['DIAGNOSA_ID_03']);
        $this->DIAGNOSA_ID_04->setDbValue($row['DIAGNOSA_ID_04']);
        $this->DIAGNOSA_ID_05->setDbValue($row['DIAGNOSA_ID_05']);
        $this->DIAGNOSA_ID_06->setDbValue($row['DIAGNOSA_ID_06']);
        $this->DIAGNOSA_ID_07->setDbValue($row['DIAGNOSA_ID_07']);
        $this->DIAGNOSA_ID_08->setDbValue($row['DIAGNOSA_ID_08']);
        $this->DIAGNOSA_ID_09->setDbValue($row['DIAGNOSA_ID_09']);
        $this->DIAGNOSA_ID_10->setDbValue($row['DIAGNOSA_ID_10']);
        $this->PROCEDURE_01->setDbValue($row['PROCEDURE_01']);
        $this->PROCEDURE_02->setDbValue($row['PROCEDURE_02']);
        $this->PROCEDURE_03->setDbValue($row['PROCEDURE_03']);
        $this->PROCEDURE_04->setDbValue($row['PROCEDURE_04']);
        $this->PROCEDURE_05->setDbValue($row['PROCEDURE_05']);
        $this->PROCEDURE_06->setDbValue($row['PROCEDURE_06']);
        $this->PROCEDURE_07->setDbValue($row['PROCEDURE_07']);
        $this->PROCEDURE_08->setDbValue($row['PROCEDURE_08']);
        $this->PROCEDURE_09->setDbValue($row['PROCEDURE_09']);
        $this->PROCEDURE_10->setDbValue($row['PROCEDURE_10']);
        $this->DIAGNOSA_ID2->setDbValue($row['DIAGNOSA_ID2']);
        $this->WEIGHT->setDbValue($row['WEIGHT']);
        $this->NOKARTU->setDbValue($row['NOKARTU']);
        $this->NOSEP->setDbValue($row['NOSEP']);
        $this->TGLSEP->setDbValue($row['TGLSEP']);
        $this->RENCANATL->setDbValue($row['RENCANATL']);
        $this->DIRUJUKKE->setDbValue($row['DIRUJUKKE']);
        $this->TGLKONTROL->setDbValue($row['TGLKONTROL']);
        $this->KDPOLI_KONTROL->setDbValue($row['KDPOLI_KONTROL']);
        $this->JAMINAN->setDbValue($row['JAMINAN']);
        $this->SPESIALISTIK->setDbValue($row['SPESIALISTIK']);
        $this->PEMERIKSAAN_02->setDbValue($row['PEMERIKSAAN_02']);
        $this->DIAGNOSA_DESC_02->setDbValue($row['DIAGNOSA_DESC_02']);
        $this->DIAGNOSA_DESC_03->setDbValue($row['DIAGNOSA_DESC_03']);
        $this->DIAGNOSA_DESC_04->setDbValue($row['DIAGNOSA_DESC_04']);
        $this->DIAGNOSA_DESC_05->setDbValue($row['DIAGNOSA_DESC_05']);
        $this->DIAGNOSA_DESC_06->setDbValue($row['DIAGNOSA_DESC_06']);
        $this->PROCEDURE_DESC_01->setDbValue($row['PROCEDURE_DESC_01']);
        $this->PROCEDURE_DESC_02->setDbValue($row['PROCEDURE_DESC_02']);
        $this->PROCEDURE_DESC_03->setDbValue($row['PROCEDURE_DESC_03']);
        $this->PROCEDURE_DESC_04->setDbValue($row['PROCEDURE_DESC_04']);
        $this->PROCEDURE_DESC_05->setDbValue($row['PROCEDURE_DESC_05']);
        $this->RESPONPOST->setDbValue($row['RESPONPOST']);
        $this->RESPONPUT->setDbValue($row['RESPONPUT']);
        $this->RESPONDEL->setDbValue($row['RESPONDEL']);
        $this->JSONPOST->setDbValue($row['JSONPOST']);
        $this->JSONPUT->setDbValue($row['JSONPUT']);
        $this->JSONDEL->setDbValue($row['JSONDEL']);
        $this->height->setDbValue($row['height']);
        $this->TEMPERATURE->setDbValue($row['TEMPERATURE']);
        $this->TENSION_UPPER->setDbValue($row['TENSION_UPPER']);
        $this->TENSION_BELOW->setDbValue($row['TENSION_BELOW']);
        $this->NADI->setDbValue($row['NADI']);
        $this->NAFAS->setDbValue($row['NAFAS']);
        $this->spec_procedures->setDbValue($row['spec_procedures']);
        $this->spec_drug->setDbValue($row['spec_drug']);
        $this->spec_prothesis->setDbValue($row['spec_prothesis']);
        $this->spec_investigation->setDbValue($row['spec_investigation']);
        $this->procedure_11->setDbValue($row['procedure_11']);
        $this->procedure_12->setDbValue($row['procedure_12']);
        $this->procedure_13->setDbValue($row['procedure_13']);
        $this->procedure_14->setDbValue($row['procedure_14']);
        $this->procedure_15->setDbValue($row['procedure_15']);
        $this->isanestesi->setDbValue($row['isanestesi']);
        $this->isreposisi->setDbValue($row['isreposisi']);
        $this->islab->setDbValue($row['islab']);
        $this->isro->setDbValue($row['isro']);
        $this->isekg->setDbValue($row['isekg']);
        $this->ishecting->setDbValue($row['ishecting']);
        $this->isgips->setDbValue($row['isgips']);
        $this->islengkap->setDbValue($row['islengkap']);
        $this->ID->setDbValue($row['ID']);
        $this->IDXDAFTAR->setDbValue($row['IDXDAFTAR']);
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

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // THENAME
        $this->THENAME->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

        // BILL_ID
        $this->BILL_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->CellCssStyle = "white-space: nowrap;";

        // IN_DATE
        $this->IN_DATE->CellCssStyle = "white-space: nowrap;";

        // EXIT_DATE
        $this->EXIT_DATE->CellCssStyle = "white-space: nowrap;";

        // BED_ID
        $this->BED_ID->CellCssStyle = "white-space: nowrap;";

        // KELUAR_ID
        $this->KELUAR_ID->CellCssStyle = "white-space: nowrap;";

        // DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA->CellCssStyle = "white-space: nowrap;";

        // REPORT_DATE
        $this->REPORT_DATE->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC
        $this->DIAGNOSA_DESC->CellCssStyle = "white-space: nowrap;";

        // ANAMNASE
        $this->ANAMNASE->CellCssStyle = "white-space: nowrap;";

        // PEMERIKSAAN
        $this->PEMERIKSAAN->CellCssStyle = "white-space: nowrap;";

        // TERAPHY_DESC
        $this->TERAPHY_DESC->CellCssStyle = "white-space: nowrap;";

        // INSTRUCTION
        $this->INSTRUCTION->CellCssStyle = "white-space: nowrap;";

        // SUFFER_TYPE
        $this->SUFFER_TYPE->CellCssStyle = "white-space: nowrap;";

        // INFECTED_BODY
        $this->INFECTED_BODY->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // RISK_LEVEL
        $this->RISK_LEVEL->CellCssStyle = "white-space: nowrap;";

        // MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA->CellCssStyle = "white-space: nowrap;";

        // HURT
        $this->HURT->CellCssStyle = "white-space: nowrap;";

        // HURT_TYPE
        $this->HURT_TYPE->CellCssStyle = "white-space: nowrap;";

        // DIAG_CAT
        $this->DIAG_CAT->CellCssStyle = "white-space: nowrap;";

        // ADDICTION_MATERIAL
        $this->ADDICTION_MATERIAL->CellCssStyle = "white-space: nowrap;";

        // INFECTED_QUANTITY
        $this->INFECTED_QUANTITY->CellCssStyle = "white-space: nowrap;";

        // CONTAGIOUS_TYPE
        $this->CONTAGIOUS_TYPE->CellCssStyle = "white-space: nowrap;";

        // CURATIF_ID
        $this->CURATIF_ID->CellCssStyle = "white-space: nowrap;";

        // RESULT_ID
        $this->RESULT_ID->CellCssStyle = "white-space: nowrap;";

        // INFECTION_TYPE
        $this->INFECTION_TYPE->CellCssStyle = "white-space: nowrap;";

        // INVESTIGATION_ID
        $this->INVESTIGATION_ID->CellCssStyle = "white-space: nowrap;";

        // DISABILITY
        $this->DISABILITY->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // KOMPLIKASI
        $this->KOMPLIKASI->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // AGEYEAR
        $this->AGEYEAR->CellCssStyle = "white-space: nowrap;";

        // AGEMONTH
        $this->AGEMONTH->CellCssStyle = "white-space: nowrap;";

        // AGEDAY
        $this->AGEDAY->CellCssStyle = "white-space: nowrap;";

        // THEADDRESS
        $this->THEADDRESS->CellCssStyle = "white-space: nowrap;";

        // THEID
        $this->THEID->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // DOCTOR
        $this->DOCTOR->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_02
        $this->DIAGNOSA_ID_02->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_03
        $this->DIAGNOSA_ID_03->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_04
        $this->DIAGNOSA_ID_04->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_05
        $this->DIAGNOSA_ID_05->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_06
        $this->DIAGNOSA_ID_06->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_07
        $this->DIAGNOSA_ID_07->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_08
        $this->DIAGNOSA_ID_08->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID_10
        $this->DIAGNOSA_ID_10->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_01
        $this->PROCEDURE_01->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_02
        $this->PROCEDURE_02->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_03
        $this->PROCEDURE_03->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_04
        $this->PROCEDURE_04->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_05
        $this->PROCEDURE_05->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_06
        $this->PROCEDURE_06->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_07
        $this->PROCEDURE_07->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_08
        $this->PROCEDURE_08->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_09
        $this->PROCEDURE_09->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_10
        $this->PROCEDURE_10->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->CellCssStyle = "white-space: nowrap;";

        // WEIGHT
        $this->WEIGHT->CellCssStyle = "white-space: nowrap;";

        // NOKARTU
        $this->NOKARTU->CellCssStyle = "white-space: nowrap;";

        // NOSEP
        $this->NOSEP->CellCssStyle = "white-space: nowrap;";

        // TGLSEP
        $this->TGLSEP->CellCssStyle = "white-space: nowrap;";

        // RENCANATL
        $this->RENCANATL->CellCssStyle = "white-space: nowrap;";

        // DIRUJUKKE
        $this->DIRUJUKKE->CellCssStyle = "white-space: nowrap;";

        // TGLKONTROL
        $this->TGLKONTROL->CellCssStyle = "white-space: nowrap;";

        // KDPOLI_KONTROL
        $this->KDPOLI_KONTROL->CellCssStyle = "white-space: nowrap;";

        // JAMINAN
        $this->JAMINAN->CellCssStyle = "white-space: nowrap;";

        // SPESIALISTIK
        $this->SPESIALISTIK->CellCssStyle = "white-space: nowrap;";

        // PEMERIKSAAN_02
        $this->PEMERIKSAAN_02->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_02
        $this->DIAGNOSA_DESC_02->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_03
        $this->DIAGNOSA_DESC_03->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_04
        $this->DIAGNOSA_DESC_04->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_05
        $this->DIAGNOSA_DESC_05->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_DESC_06
        $this->DIAGNOSA_DESC_06->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_01
        $this->PROCEDURE_DESC_01->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_02
        $this->PROCEDURE_DESC_02->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_03
        $this->PROCEDURE_DESC_03->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_04
        $this->PROCEDURE_DESC_04->CellCssStyle = "white-space: nowrap;";

        // PROCEDURE_DESC_05
        $this->PROCEDURE_DESC_05->CellCssStyle = "white-space: nowrap;";

        // RESPONPOST
        $this->RESPONPOST->CellCssStyle = "white-space: nowrap;";

        // RESPONPUT
        $this->RESPONPUT->CellCssStyle = "white-space: nowrap;";

        // RESPONDEL
        $this->RESPONDEL->CellCssStyle = "white-space: nowrap;";

        // JSONPOST
        $this->JSONPOST->CellCssStyle = "white-space: nowrap;";

        // JSONPUT
        $this->JSONPUT->CellCssStyle = "white-space: nowrap;";

        // JSONDEL
        $this->JSONDEL->CellCssStyle = "white-space: nowrap;";

        // height
        $this->height->CellCssStyle = "white-space: nowrap;";

        // TEMPERATURE
        $this->TEMPERATURE->CellCssStyle = "white-space: nowrap;";

        // TENSION_UPPER
        $this->TENSION_UPPER->CellCssStyle = "white-space: nowrap;";

        // TENSION_BELOW
        $this->TENSION_BELOW->CellCssStyle = "white-space: nowrap;";

        // NADI
        $this->NADI->CellCssStyle = "white-space: nowrap;";

        // NAFAS
        $this->NAFAS->CellCssStyle = "white-space: nowrap;";

        // spec_procedures
        $this->spec_procedures->CellCssStyle = "white-space: nowrap;";

        // spec_drug
        $this->spec_drug->CellCssStyle = "white-space: nowrap;";

        // spec_prothesis
        $this->spec_prothesis->CellCssStyle = "white-space: nowrap;";

        // spec_investigation
        $this->spec_investigation->CellCssStyle = "white-space: nowrap;";

        // procedure_11
        $this->procedure_11->CellCssStyle = "white-space: nowrap;";

        // procedure_12
        $this->procedure_12->CellCssStyle = "white-space: nowrap;";

        // procedure_13
        $this->procedure_13->CellCssStyle = "white-space: nowrap;";

        // procedure_14
        $this->procedure_14->CellCssStyle = "white-space: nowrap;";

        // procedure_15
        $this->procedure_15->CellCssStyle = "white-space: nowrap;";

        // isanestesi
        $this->isanestesi->CellCssStyle = "white-space: nowrap;";

        // isreposisi
        $this->isreposisi->CellCssStyle = "white-space: nowrap;";

        // islab
        $this->islab->CellCssStyle = "white-space: nowrap;";

        // isro
        $this->isro->CellCssStyle = "white-space: nowrap;";

        // isekg
        $this->isekg->CellCssStyle = "white-space: nowrap;";

        // ishecting
        $this->ishecting->CellCssStyle = "white-space: nowrap;";

        // isgips
        $this->isgips->CellCssStyle = "white-space: nowrap;";

        // islengkap
        $this->islengkap->CellCssStyle = "white-space: nowrap;";

        // ID

        // IDXDAFTAR

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->ViewValue = $this->PASIEN_DIAGNOSA_ID->CurrentValue;
        $this->PASIEN_DIAGNOSA_ID->ViewCustomAttributes = "";

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

        // THENAME
        $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
        $this->THENAME->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

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

        // BILL_ID
        $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->ViewCustomAttributes = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

        // IN_DATE
        $this->IN_DATE->ViewValue = $this->IN_DATE->CurrentValue;
        $this->IN_DATE->ViewValue = FormatDateTime($this->IN_DATE->ViewValue, 0);
        $this->IN_DATE->ViewCustomAttributes = "";

        // EXIT_DATE
        $this->EXIT_DATE->ViewValue = $this->EXIT_DATE->CurrentValue;
        $this->EXIT_DATE->ViewValue = FormatDateTime($this->EXIT_DATE->ViewValue, 0);
        $this->EXIT_DATE->ViewCustomAttributes = "";

        // BED_ID
        $this->BED_ID->ViewValue = $this->BED_ID->CurrentValue;
        $this->BED_ID->ViewValue = FormatNumber($this->BED_ID->ViewValue, 0, -2, -2, -2);
        $this->BED_ID->ViewCustomAttributes = "";

        // KELUAR_ID
        $curVal = trim(strval($this->KELUAR_ID->CurrentValue));
        if ($curVal != "") {
            $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->lookupCacheOption($curVal);
            if ($this->KELUAR_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[KELUAR_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->KELUAR_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->KELUAR_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->displayValue($arwrk);
                } else {
                    $this->KELUAR_ID->ViewValue = $this->KELUAR_ID->CurrentValue;
                }
            }
        } else {
            $this->KELUAR_ID->ViewValue = null;
        }
        $this->KELUAR_ID->ViewCustomAttributes = "";

        // DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA->ViewValue = $this->DATE_OF_DIAGNOSA->CurrentValue;
        $this->DATE_OF_DIAGNOSA->ViewValue = FormatDateTime($this->DATE_OF_DIAGNOSA->ViewValue, 11);
        $this->DATE_OF_DIAGNOSA->ViewCustomAttributes = "";

        // REPORT_DATE
        $this->REPORT_DATE->ViewValue = $this->REPORT_DATE->CurrentValue;
        $this->REPORT_DATE->ViewValue = FormatDateTime($this->REPORT_DATE->ViewValue, 0);
        $this->REPORT_DATE->ViewCustomAttributes = "";

        // DIAGNOSA_ID
        $curVal = trim(strval($this->DIAGNOSA_ID->CurrentValue));
        if ($curVal != "") {
            $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->lookupCacheOption($curVal);
            if ($this->DIAGNOSA_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->DIAGNOSA_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
                }
            }
        } else {
            $this->DIAGNOSA_ID->ViewValue = null;
        }
        $this->DIAGNOSA_ID->ViewCustomAttributes = "";

        // DIAGNOSA_DESC
        $this->DIAGNOSA_DESC->ViewValue = $this->DIAGNOSA_DESC->CurrentValue;
        $this->DIAGNOSA_DESC->ViewCustomAttributes = "";

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

        // SUFFER_TYPE
        $curVal = trim(strval($this->SUFFER_TYPE->CurrentValue));
        if ($curVal != "") {
            $this->SUFFER_TYPE->ViewValue = $this->SUFFER_TYPE->lookupCacheOption($curVal);
            if ($this->SUFFER_TYPE->ViewValue === null) { // Lookup from database
                $filterWrk = "[SUFFER_TYPE]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->SUFFER_TYPE->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->SUFFER_TYPE->Lookup->renderViewRow($rswrk[0]);
                    $this->SUFFER_TYPE->ViewValue = $this->SUFFER_TYPE->displayValue($arwrk);
                } else {
                    $this->SUFFER_TYPE->ViewValue = $this->SUFFER_TYPE->CurrentValue;
                }
            }
        } else {
            $this->SUFFER_TYPE->ViewValue = null;
        }
        $this->SUFFER_TYPE->ViewCustomAttributes = "";

        // INFECTED_BODY
        $this->INFECTED_BODY->ViewValue = $this->INFECTED_BODY->CurrentValue;
        $this->INFECTED_BODY->ViewValue = FormatNumber($this->INFECTED_BODY->ViewValue, 0, -2, -2, -2);
        $this->INFECTED_BODY->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $curVal = trim(strval($this->EMPLOYEE_ID->CurrentValue));
        if ($curVal != "") {
            $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->lookupCacheOption($curVal);
            if ($this->EMPLOYEE_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[EMPLOYEE_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "[OBJECT_CATEGORY_ID]= 20";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->EMPLOYEE_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
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

        // RISK_LEVEL
        $this->RISK_LEVEL->ViewValue = $this->RISK_LEVEL->CurrentValue;
        $this->RISK_LEVEL->ViewValue = FormatNumber($this->RISK_LEVEL->ViewValue, 0, -2, -2, -2);
        $this->RISK_LEVEL->ViewCustomAttributes = "";

        // MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA->ViewValue = $this->MORFOLOGI_NEOPLASMA->CurrentValue;
        $this->MORFOLOGI_NEOPLASMA->ViewCustomAttributes = "";

        // HURT
        $this->HURT->ViewValue = $this->HURT->CurrentValue;
        $this->HURT->ViewCustomAttributes = "";

        // HURT_TYPE
        $this->HURT_TYPE->ViewValue = $this->HURT_TYPE->CurrentValue;
        $this->HURT_TYPE->ViewValue = FormatNumber($this->HURT_TYPE->ViewValue, 0, -2, -2, -2);
        $this->HURT_TYPE->ViewCustomAttributes = "";

        // DIAG_CAT
        $curVal = trim(strval($this->DIAG_CAT->CurrentValue));
        if ($curVal != "") {
            $this->DIAG_CAT->ViewValue = $this->DIAG_CAT->lookupCacheOption($curVal);
            if ($this->DIAG_CAT->ViewValue === null) { // Lookup from database
                $filterWrk = "[DIAG_CAT]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->DIAG_CAT->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAG_CAT->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAG_CAT->ViewValue = $this->DIAG_CAT->displayValue($arwrk);
                } else {
                    $this->DIAG_CAT->ViewValue = $this->DIAG_CAT->CurrentValue;
                }
            }
        } else {
            $this->DIAG_CAT->ViewValue = null;
        }
        $this->DIAG_CAT->ViewCustomAttributes = "";

        // ADDICTION_MATERIAL
        $this->ADDICTION_MATERIAL->ViewValue = $this->ADDICTION_MATERIAL->CurrentValue;
        $this->ADDICTION_MATERIAL->ViewCustomAttributes = "";

        // INFECTED_QUANTITY
        $this->INFECTED_QUANTITY->ViewValue = $this->INFECTED_QUANTITY->CurrentValue;
        $this->INFECTED_QUANTITY->ViewValue = FormatNumber($this->INFECTED_QUANTITY->ViewValue, 0, -2, -2, -2);
        $this->INFECTED_QUANTITY->ViewCustomAttributes = "";

        // CONTAGIOUS_TYPE
        $this->CONTAGIOUS_TYPE->ViewValue = $this->CONTAGIOUS_TYPE->CurrentValue;
        $this->CONTAGIOUS_TYPE->ViewValue = FormatNumber($this->CONTAGIOUS_TYPE->ViewValue, 0, -2, -2, -2);
        $this->CONTAGIOUS_TYPE->ViewCustomAttributes = "";

        // CURATIF_ID
        $this->CURATIF_ID->ViewValue = $this->CURATIF_ID->CurrentValue;
        $this->CURATIF_ID->ViewValue = FormatNumber($this->CURATIF_ID->ViewValue, 0, -2, -2, -2);
        $this->CURATIF_ID->ViewCustomAttributes = "";

        // RESULT_ID
        $this->RESULT_ID->ViewValue = $this->RESULT_ID->CurrentValue;
        $this->RESULT_ID->ViewValue = FormatNumber($this->RESULT_ID->ViewValue, 0, -2, -2, -2);
        $this->RESULT_ID->ViewCustomAttributes = "";

        // INFECTION_TYPE
        $this->INFECTION_TYPE->ViewValue = $this->INFECTION_TYPE->CurrentValue;
        $this->INFECTION_TYPE->ViewValue = FormatNumber($this->INFECTION_TYPE->ViewValue, 0, -2, -2, -2);
        $this->INFECTION_TYPE->ViewCustomAttributes = "";

        // INVESTIGATION_ID
        $curVal = trim(strval($this->INVESTIGATION_ID->CurrentValue));
        if ($curVal != "") {
            $this->INVESTIGATION_ID->ViewValue = $this->INVESTIGATION_ID->lookupCacheOption($curVal);
            if ($this->INVESTIGATION_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[INVESTIGATION_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->INVESTIGATION_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->INVESTIGATION_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->INVESTIGATION_ID->ViewValue = $this->INVESTIGATION_ID->displayValue($arwrk);
                } else {
                    $this->INVESTIGATION_ID->ViewValue = $this->INVESTIGATION_ID->CurrentValue;
                }
            }
        } else {
            $this->INVESTIGATION_ID->ViewValue = null;
        }
        $this->INVESTIGATION_ID->ViewCustomAttributes = "";

        // DISABILITY
        $this->DISABILITY->ViewValue = $this->DISABILITY->CurrentValue;
        $this->DISABILITY->ViewCustomAttributes = "";

        // DESCRIPTION
        $curVal = trim(strval($this->DESCRIPTION->CurrentValue));
        if ($curVal != "") {
            $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->lookupCacheOption($curVal);
            if ($this->DESCRIPTION->ViewValue === null) { // Lookup from database
                $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->DESCRIPTION->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DESCRIPTION->Lookup->renderViewRow($rswrk[0]);
                    $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->displayValue($arwrk);
                } else {
                    $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
                }
            }
        } else {
            $this->DESCRIPTION->ViewValue = null;
        }
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // KOMPLIKASI
        $this->KOMPLIKASI->ViewValue = $this->KOMPLIKASI->CurrentValue;
        $this->KOMPLIKASI->ViewCustomAttributes = "";

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

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // DIAGNOSA_ID_02
        $curVal = trim(strval($this->DIAGNOSA_ID_02->CurrentValue));
        if ($curVal != "") {
            $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->lookupCacheOption($curVal);
            if ($this->DIAGNOSA_ID_02->ViewValue === null) { // Lookup from database
                $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->DIAGNOSA_ID_02->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_02->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_02->ViewValue = $this->DIAGNOSA_ID_02->CurrentValue;
                }
            }
        } else {
            $this->DIAGNOSA_ID_02->ViewValue = null;
        }
        $this->DIAGNOSA_ID_02->ViewCustomAttributes = "";

        // DIAGNOSA_ID_03
        $curVal = trim(strval($this->DIAGNOSA_ID_03->CurrentValue));
        if ($curVal != "") {
            $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->lookupCacheOption($curVal);
            if ($this->DIAGNOSA_ID_03->ViewValue === null) { // Lookup from database
                $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->DIAGNOSA_ID_03->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_03->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_03->ViewValue = $this->DIAGNOSA_ID_03->CurrentValue;
                }
            }
        } else {
            $this->DIAGNOSA_ID_03->ViewValue = null;
        }
        $this->DIAGNOSA_ID_03->ViewCustomAttributes = "";

        // DIAGNOSA_ID_04
        $curVal = trim(strval($this->DIAGNOSA_ID_04->CurrentValue));
        if ($curVal != "") {
            $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->lookupCacheOption($curVal);
            if ($this->DIAGNOSA_ID_04->ViewValue === null) { // Lookup from database
                $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->DIAGNOSA_ID_04->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_04->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_04->ViewValue = $this->DIAGNOSA_ID_04->CurrentValue;
                }
            }
        } else {
            $this->DIAGNOSA_ID_04->ViewValue = null;
        }
        $this->DIAGNOSA_ID_04->ViewCustomAttributes = "";

        // DIAGNOSA_ID_05
        $curVal = trim(strval($this->DIAGNOSA_ID_05->CurrentValue));
        if ($curVal != "") {
            $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->lookupCacheOption($curVal);
            if ($this->DIAGNOSA_ID_05->ViewValue === null) { // Lookup from database
                $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->DIAGNOSA_ID_05->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_05->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_05->ViewValue = $this->DIAGNOSA_ID_05->CurrentValue;
                }
            }
        } else {
            $this->DIAGNOSA_ID_05->ViewValue = null;
        }
        $this->DIAGNOSA_ID_05->ViewCustomAttributes = "";

        // DIAGNOSA_ID_06
        $curVal = trim(strval($this->DIAGNOSA_ID_06->CurrentValue));
        if ($curVal != "") {
            $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->lookupCacheOption($curVal);
            if ($this->DIAGNOSA_ID_06->ViewValue === null) { // Lookup from database
                $filterWrk = "[DIAGNOSA_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->DIAGNOSA_ID_06->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->DIAGNOSA_ID_06->Lookup->renderViewRow($rswrk[0]);
                    $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->displayValue($arwrk);
                } else {
                    $this->DIAGNOSA_ID_06->ViewValue = $this->DIAGNOSA_ID_06->CurrentValue;
                }
            }
        } else {
            $this->DIAGNOSA_ID_06->ViewValue = null;
        }
        $this->DIAGNOSA_ID_06->ViewCustomAttributes = "";

        // DIAGNOSA_ID_07
        $this->DIAGNOSA_ID_07->ViewValue = $this->DIAGNOSA_ID_07->CurrentValue;
        $this->DIAGNOSA_ID_07->ViewCustomAttributes = "";

        // DIAGNOSA_ID_08
        $this->DIAGNOSA_ID_08->ViewValue = $this->DIAGNOSA_ID_08->CurrentValue;
        $this->DIAGNOSA_ID_08->ViewCustomAttributes = "";

        // DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09->ViewValue = $this->DIAGNOSA_ID_09->CurrentValue;
        $this->DIAGNOSA_ID_09->ViewCustomAttributes = "";

        // DIAGNOSA_ID_10
        $this->DIAGNOSA_ID_10->ViewValue = $this->DIAGNOSA_ID_10->CurrentValue;
        $this->DIAGNOSA_ID_10->ViewCustomAttributes = "";

        // PROCEDURE_01
        $this->PROCEDURE_01->ViewValue = $this->PROCEDURE_01->CurrentValue;
        $this->PROCEDURE_01->ViewCustomAttributes = "";

        // PROCEDURE_02
        $this->PROCEDURE_02->ViewValue = $this->PROCEDURE_02->CurrentValue;
        $this->PROCEDURE_02->ViewCustomAttributes = "";

        // PROCEDURE_03
        $this->PROCEDURE_03->ViewValue = $this->PROCEDURE_03->CurrentValue;
        $this->PROCEDURE_03->ViewCustomAttributes = "";

        // PROCEDURE_04
        $this->PROCEDURE_04->ViewValue = $this->PROCEDURE_04->CurrentValue;
        $this->PROCEDURE_04->ViewCustomAttributes = "";

        // PROCEDURE_05
        $this->PROCEDURE_05->ViewValue = $this->PROCEDURE_05->CurrentValue;
        $this->PROCEDURE_05->ViewCustomAttributes = "";

        // PROCEDURE_06
        $this->PROCEDURE_06->ViewValue = $this->PROCEDURE_06->CurrentValue;
        $this->PROCEDURE_06->ViewCustomAttributes = "";

        // PROCEDURE_07
        $this->PROCEDURE_07->ViewValue = $this->PROCEDURE_07->CurrentValue;
        $this->PROCEDURE_07->ViewCustomAttributes = "";

        // PROCEDURE_08
        $this->PROCEDURE_08->ViewValue = $this->PROCEDURE_08->CurrentValue;
        $this->PROCEDURE_08->ViewCustomAttributes = "";

        // PROCEDURE_09
        $this->PROCEDURE_09->ViewValue = $this->PROCEDURE_09->CurrentValue;
        $this->PROCEDURE_09->ViewCustomAttributes = "";

        // PROCEDURE_10
        $this->PROCEDURE_10->ViewValue = $this->PROCEDURE_10->CurrentValue;
        $this->PROCEDURE_10->ViewCustomAttributes = "";

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->ViewValue = $this->DIAGNOSA_ID2->CurrentValue;
        $this->DIAGNOSA_ID2->ViewCustomAttributes = "";

        // WEIGHT
        $this->WEIGHT->ViewValue = $this->WEIGHT->CurrentValue;
        $this->WEIGHT->ViewValue = FormatNumber($this->WEIGHT->ViewValue, 2, -2, -2, -2);
        $this->WEIGHT->ViewCustomAttributes = "";

        // NOKARTU
        $this->NOKARTU->ViewValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->ViewCustomAttributes = "";

        // NOSEP
        $this->NOSEP->ViewValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->ViewCustomAttributes = "";

        // TGLSEP
        $this->TGLSEP->ViewValue = $this->TGLSEP->CurrentValue;
        $this->TGLSEP->ViewValue = FormatDateTime($this->TGLSEP->ViewValue, 0);
        $this->TGLSEP->ViewCustomAttributes = "";

        // RENCANATL
        $this->RENCANATL->ViewValue = $this->RENCANATL->CurrentValue;
        $this->RENCANATL->ViewCustomAttributes = "";

        // DIRUJUKKE
        $this->DIRUJUKKE->ViewValue = $this->DIRUJUKKE->CurrentValue;
        $this->DIRUJUKKE->ViewCustomAttributes = "";

        // TGLKONTROL
        $this->TGLKONTROL->ViewValue = $this->TGLKONTROL->CurrentValue;
        $this->TGLKONTROL->ViewValue = FormatDateTime($this->TGLKONTROL->ViewValue, 0);
        $this->TGLKONTROL->ViewCustomAttributes = "";

        // KDPOLI_KONTROL
        $this->KDPOLI_KONTROL->ViewValue = $this->KDPOLI_KONTROL->CurrentValue;
        $this->KDPOLI_KONTROL->ViewCustomAttributes = "";

        // JAMINAN
        $this->JAMINAN->ViewValue = $this->JAMINAN->CurrentValue;
        $this->JAMINAN->ViewCustomAttributes = "";

        // SPESIALISTIK
        $this->SPESIALISTIK->ViewValue = $this->SPESIALISTIK->CurrentValue;
        $this->SPESIALISTIK->ViewCustomAttributes = "";

        // PEMERIKSAAN_02
        $this->PEMERIKSAAN_02->ViewValue = $this->PEMERIKSAAN_02->CurrentValue;
        $this->PEMERIKSAAN_02->ViewCustomAttributes = "";

        // DIAGNOSA_DESC_02
        $this->DIAGNOSA_DESC_02->ViewValue = $this->DIAGNOSA_DESC_02->CurrentValue;
        $this->DIAGNOSA_DESC_02->ViewCustomAttributes = "";

        // DIAGNOSA_DESC_03
        $this->DIAGNOSA_DESC_03->ViewValue = $this->DIAGNOSA_DESC_03->CurrentValue;
        $this->DIAGNOSA_DESC_03->ViewCustomAttributes = "";

        // DIAGNOSA_DESC_04
        $this->DIAGNOSA_DESC_04->ViewValue = $this->DIAGNOSA_DESC_04->CurrentValue;
        $this->DIAGNOSA_DESC_04->ViewCustomAttributes = "";

        // DIAGNOSA_DESC_05
        $this->DIAGNOSA_DESC_05->ViewValue = $this->DIAGNOSA_DESC_05->CurrentValue;
        $this->DIAGNOSA_DESC_05->ViewCustomAttributes = "";

        // DIAGNOSA_DESC_06
        $this->DIAGNOSA_DESC_06->ViewValue = $this->DIAGNOSA_DESC_06->CurrentValue;
        $this->DIAGNOSA_DESC_06->ViewCustomAttributes = "";

        // PROCEDURE_DESC_01
        $this->PROCEDURE_DESC_01->ViewValue = $this->PROCEDURE_DESC_01->CurrentValue;
        $this->PROCEDURE_DESC_01->ViewCustomAttributes = "";

        // PROCEDURE_DESC_02
        $this->PROCEDURE_DESC_02->ViewValue = $this->PROCEDURE_DESC_02->CurrentValue;
        $this->PROCEDURE_DESC_02->ViewCustomAttributes = "";

        // PROCEDURE_DESC_03
        $this->PROCEDURE_DESC_03->ViewValue = $this->PROCEDURE_DESC_03->CurrentValue;
        $this->PROCEDURE_DESC_03->ViewCustomAttributes = "";

        // PROCEDURE_DESC_04
        $this->PROCEDURE_DESC_04->ViewValue = $this->PROCEDURE_DESC_04->CurrentValue;
        $this->PROCEDURE_DESC_04->ViewCustomAttributes = "";

        // PROCEDURE_DESC_05
        $this->PROCEDURE_DESC_05->ViewValue = $this->PROCEDURE_DESC_05->CurrentValue;
        $this->PROCEDURE_DESC_05->ViewCustomAttributes = "";

        // RESPONPOST
        $this->RESPONPOST->ViewValue = $this->RESPONPOST->CurrentValue;
        $this->RESPONPOST->ViewCustomAttributes = "";

        // RESPONPUT
        $this->RESPONPUT->ViewValue = $this->RESPONPUT->CurrentValue;
        $this->RESPONPUT->ViewCustomAttributes = "";

        // RESPONDEL
        $this->RESPONDEL->ViewValue = $this->RESPONDEL->CurrentValue;
        $this->RESPONDEL->ViewCustomAttributes = "";

        // JSONPOST
        $this->JSONPOST->ViewValue = $this->JSONPOST->CurrentValue;
        $this->JSONPOST->ViewCustomAttributes = "";

        // JSONPUT
        $this->JSONPUT->ViewValue = $this->JSONPUT->CurrentValue;
        $this->JSONPUT->ViewCustomAttributes = "";

        // JSONDEL
        $this->JSONDEL->ViewValue = $this->JSONDEL->CurrentValue;
        $this->JSONDEL->ViewCustomAttributes = "";

        // height
        $this->height->ViewValue = $this->height->CurrentValue;
        $this->height->ViewCustomAttributes = "";

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

        // spec_procedures
        $this->spec_procedures->ViewValue = $this->spec_procedures->CurrentValue;
        $this->spec_procedures->ViewCustomAttributes = "";

        // spec_drug
        $this->spec_drug->ViewValue = $this->spec_drug->CurrentValue;
        $this->spec_drug->ViewCustomAttributes = "";

        // spec_prothesis
        $this->spec_prothesis->ViewValue = $this->spec_prothesis->CurrentValue;
        $this->spec_prothesis->ViewCustomAttributes = "";

        // spec_investigation
        $this->spec_investigation->ViewValue = $this->spec_investigation->CurrentValue;
        $this->spec_investigation->ViewCustomAttributes = "";

        // procedure_11
        $this->procedure_11->ViewValue = $this->procedure_11->CurrentValue;
        $this->procedure_11->ViewCustomAttributes = "";

        // procedure_12
        $this->procedure_12->ViewValue = $this->procedure_12->CurrentValue;
        $this->procedure_12->ViewCustomAttributes = "";

        // procedure_13
        $this->procedure_13->ViewValue = $this->procedure_13->CurrentValue;
        $this->procedure_13->ViewCustomAttributes = "";

        // procedure_14
        $this->procedure_14->ViewValue = $this->procedure_14->CurrentValue;
        $this->procedure_14->ViewCustomAttributes = "";

        // procedure_15
        $this->procedure_15->ViewValue = $this->procedure_15->CurrentValue;
        $this->procedure_15->ViewCustomAttributes = "";

        // isanestesi
        $this->isanestesi->ViewValue = $this->isanestesi->CurrentValue;
        $this->isanestesi->ViewCustomAttributes = "";

        // isreposisi
        $this->isreposisi->ViewValue = $this->isreposisi->CurrentValue;
        $this->isreposisi->ViewCustomAttributes = "";

        // islab
        $this->islab->ViewValue = $this->islab->CurrentValue;
        $this->islab->ViewCustomAttributes = "";

        // isro
        $this->isro->ViewValue = $this->isro->CurrentValue;
        $this->isro->ViewCustomAttributes = "";

        // isekg
        $this->isekg->ViewValue = $this->isekg->CurrentValue;
        $this->isekg->ViewCustomAttributes = "";

        // ishecting
        $this->ishecting->ViewValue = $this->ishecting->CurrentValue;
        $this->ishecting->ViewCustomAttributes = "";

        // isgips
        $this->isgips->ViewValue = $this->isgips->CurrentValue;
        $this->isgips->ViewCustomAttributes = "";

        // islengkap
        $this->islengkap->ViewValue = $this->islengkap->CurrentValue;
        $this->islengkap->ViewCustomAttributes = "";

        // ID
        $this->ID->ViewValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // IDXDAFTAR
        $this->IDXDAFTAR->ViewValue = $this->IDXDAFTAR->CurrentValue;
        $this->IDXDAFTAR->ViewValue = FormatNumber($this->IDXDAFTAR->ViewValue, 0, -2, -2, -2);
        $this->IDXDAFTAR->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->PASIEN_DIAGNOSA_ID->HrefValue = "";
        $this->PASIEN_DIAGNOSA_ID->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // THENAME
        $this->THENAME->LinkCustomAttributes = "";
        $this->THENAME->HrefValue = "";
        $this->THENAME->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // BILL_ID
        $this->BILL_ID->LinkCustomAttributes = "";
        $this->BILL_ID->HrefValue = "";
        $this->BILL_ID->TooltipValue = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
        $this->CLASS_ROOM_ID->HrefValue = "";
        $this->CLASS_ROOM_ID->TooltipValue = "";

        // IN_DATE
        $this->IN_DATE->LinkCustomAttributes = "";
        $this->IN_DATE->HrefValue = "";
        $this->IN_DATE->TooltipValue = "";

        // EXIT_DATE
        $this->EXIT_DATE->LinkCustomAttributes = "";
        $this->EXIT_DATE->HrefValue = "";
        $this->EXIT_DATE->TooltipValue = "";

        // BED_ID
        $this->BED_ID->LinkCustomAttributes = "";
        $this->BED_ID->HrefValue = "";
        $this->BED_ID->TooltipValue = "";

        // KELUAR_ID
        $this->KELUAR_ID->LinkCustomAttributes = "";
        $this->KELUAR_ID->HrefValue = "";
        $this->KELUAR_ID->TooltipValue = "";

        // DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA->LinkCustomAttributes = "";
        $this->DATE_OF_DIAGNOSA->HrefValue = "";
        $this->DATE_OF_DIAGNOSA->TooltipValue = "";

        // REPORT_DATE
        $this->REPORT_DATE->LinkCustomAttributes = "";
        $this->REPORT_DATE->HrefValue = "";
        $this->REPORT_DATE->TooltipValue = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID->HrefValue = "";
        $this->DIAGNOSA_ID->TooltipValue = "";

        // DIAGNOSA_DESC
        $this->DIAGNOSA_DESC->LinkCustomAttributes = "";
        $this->DIAGNOSA_DESC->HrefValue = "";
        $this->DIAGNOSA_DESC->TooltipValue = "";

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

        // SUFFER_TYPE
        $this->SUFFER_TYPE->LinkCustomAttributes = "";
        $this->SUFFER_TYPE->HrefValue = "";
        $this->SUFFER_TYPE->TooltipValue = "";

        // INFECTED_BODY
        $this->INFECTED_BODY->LinkCustomAttributes = "";
        $this->INFECTED_BODY->HrefValue = "";
        $this->INFECTED_BODY->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // RISK_LEVEL
        $this->RISK_LEVEL->LinkCustomAttributes = "";
        $this->RISK_LEVEL->HrefValue = "";
        $this->RISK_LEVEL->TooltipValue = "";

        // MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA->LinkCustomAttributes = "";
        $this->MORFOLOGI_NEOPLASMA->HrefValue = "";
        $this->MORFOLOGI_NEOPLASMA->TooltipValue = "";

        // HURT
        $this->HURT->LinkCustomAttributes = "";
        $this->HURT->HrefValue = "";
        $this->HURT->TooltipValue = "";

        // HURT_TYPE
        $this->HURT_TYPE->LinkCustomAttributes = "";
        $this->HURT_TYPE->HrefValue = "";
        $this->HURT_TYPE->TooltipValue = "";

        // DIAG_CAT
        $this->DIAG_CAT->LinkCustomAttributes = "";
        $this->DIAG_CAT->HrefValue = "";
        $this->DIAG_CAT->TooltipValue = "";

        // ADDICTION_MATERIAL
        $this->ADDICTION_MATERIAL->LinkCustomAttributes = "";
        $this->ADDICTION_MATERIAL->HrefValue = "";
        $this->ADDICTION_MATERIAL->TooltipValue = "";

        // INFECTED_QUANTITY
        $this->INFECTED_QUANTITY->LinkCustomAttributes = "";
        $this->INFECTED_QUANTITY->HrefValue = "";
        $this->INFECTED_QUANTITY->TooltipValue = "";

        // CONTAGIOUS_TYPE
        $this->CONTAGIOUS_TYPE->LinkCustomAttributes = "";
        $this->CONTAGIOUS_TYPE->HrefValue = "";
        $this->CONTAGIOUS_TYPE->TooltipValue = "";

        // CURATIF_ID
        $this->CURATIF_ID->LinkCustomAttributes = "";
        $this->CURATIF_ID->HrefValue = "";
        $this->CURATIF_ID->TooltipValue = "";

        // RESULT_ID
        $this->RESULT_ID->LinkCustomAttributes = "";
        $this->RESULT_ID->HrefValue = "";
        $this->RESULT_ID->TooltipValue = "";

        // INFECTION_TYPE
        $this->INFECTION_TYPE->LinkCustomAttributes = "";
        $this->INFECTION_TYPE->HrefValue = "";
        $this->INFECTION_TYPE->TooltipValue = "";

        // INVESTIGATION_ID
        $this->INVESTIGATION_ID->LinkCustomAttributes = "";
        $this->INVESTIGATION_ID->HrefValue = "";
        $this->INVESTIGATION_ID->TooltipValue = "";

        // DISABILITY
        $this->DISABILITY->LinkCustomAttributes = "";
        $this->DISABILITY->HrefValue = "";
        $this->DISABILITY->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // KOMPLIKASI
        $this->KOMPLIKASI->LinkCustomAttributes = "";
        $this->KOMPLIKASI->HrefValue = "";
        $this->KOMPLIKASI->TooltipValue = "";

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

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // DIAGNOSA_ID_02
        $this->DIAGNOSA_ID_02->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_02->HrefValue = "";
        $this->DIAGNOSA_ID_02->TooltipValue = "";

        // DIAGNOSA_ID_03
        $this->DIAGNOSA_ID_03->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_03->HrefValue = "";
        $this->DIAGNOSA_ID_03->TooltipValue = "";

        // DIAGNOSA_ID_04
        $this->DIAGNOSA_ID_04->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_04->HrefValue = "";
        $this->DIAGNOSA_ID_04->TooltipValue = "";

        // DIAGNOSA_ID_05
        $this->DIAGNOSA_ID_05->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_05->HrefValue = "";
        $this->DIAGNOSA_ID_05->TooltipValue = "";

        // DIAGNOSA_ID_06
        $this->DIAGNOSA_ID_06->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_06->HrefValue = "";
        $this->DIAGNOSA_ID_06->TooltipValue = "";

        // DIAGNOSA_ID_07
        $this->DIAGNOSA_ID_07->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_07->HrefValue = "";
        $this->DIAGNOSA_ID_07->TooltipValue = "";

        // DIAGNOSA_ID_08
        $this->DIAGNOSA_ID_08->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_08->HrefValue = "";
        $this->DIAGNOSA_ID_08->TooltipValue = "";

        // DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_09->HrefValue = "";
        $this->DIAGNOSA_ID_09->TooltipValue = "";

        // DIAGNOSA_ID_10
        $this->DIAGNOSA_ID_10->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID_10->HrefValue = "";
        $this->DIAGNOSA_ID_10->TooltipValue = "";

        // PROCEDURE_01
        $this->PROCEDURE_01->LinkCustomAttributes = "";
        $this->PROCEDURE_01->HrefValue = "";
        $this->PROCEDURE_01->TooltipValue = "";

        // PROCEDURE_02
        $this->PROCEDURE_02->LinkCustomAttributes = "";
        $this->PROCEDURE_02->HrefValue = "";
        $this->PROCEDURE_02->TooltipValue = "";

        // PROCEDURE_03
        $this->PROCEDURE_03->LinkCustomAttributes = "";
        $this->PROCEDURE_03->HrefValue = "";
        $this->PROCEDURE_03->TooltipValue = "";

        // PROCEDURE_04
        $this->PROCEDURE_04->LinkCustomAttributes = "";
        $this->PROCEDURE_04->HrefValue = "";
        $this->PROCEDURE_04->TooltipValue = "";

        // PROCEDURE_05
        $this->PROCEDURE_05->LinkCustomAttributes = "";
        $this->PROCEDURE_05->HrefValue = "";
        $this->PROCEDURE_05->TooltipValue = "";

        // PROCEDURE_06
        $this->PROCEDURE_06->LinkCustomAttributes = "";
        $this->PROCEDURE_06->HrefValue = "";
        $this->PROCEDURE_06->TooltipValue = "";

        // PROCEDURE_07
        $this->PROCEDURE_07->LinkCustomAttributes = "";
        $this->PROCEDURE_07->HrefValue = "";
        $this->PROCEDURE_07->TooltipValue = "";

        // PROCEDURE_08
        $this->PROCEDURE_08->LinkCustomAttributes = "";
        $this->PROCEDURE_08->HrefValue = "";
        $this->PROCEDURE_08->TooltipValue = "";

        // PROCEDURE_09
        $this->PROCEDURE_09->LinkCustomAttributes = "";
        $this->PROCEDURE_09->HrefValue = "";
        $this->PROCEDURE_09->TooltipValue = "";

        // PROCEDURE_10
        $this->PROCEDURE_10->LinkCustomAttributes = "";
        $this->PROCEDURE_10->HrefValue = "";
        $this->PROCEDURE_10->TooltipValue = "";

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID2->HrefValue = "";
        $this->DIAGNOSA_ID2->TooltipValue = "";

        // WEIGHT
        $this->WEIGHT->LinkCustomAttributes = "";
        $this->WEIGHT->HrefValue = "";
        $this->WEIGHT->TooltipValue = "";

        // NOKARTU
        $this->NOKARTU->LinkCustomAttributes = "";
        $this->NOKARTU->HrefValue = "";
        $this->NOKARTU->TooltipValue = "";

        // NOSEP
        $this->NOSEP->LinkCustomAttributes = "";
        $this->NOSEP->HrefValue = "";
        $this->NOSEP->TooltipValue = "";

        // TGLSEP
        $this->TGLSEP->LinkCustomAttributes = "";
        $this->TGLSEP->HrefValue = "";
        $this->TGLSEP->TooltipValue = "";

        // RENCANATL
        $this->RENCANATL->LinkCustomAttributes = "";
        $this->RENCANATL->HrefValue = "";
        $this->RENCANATL->TooltipValue = "";

        // DIRUJUKKE
        $this->DIRUJUKKE->LinkCustomAttributes = "";
        $this->DIRUJUKKE->HrefValue = "";
        $this->DIRUJUKKE->TooltipValue = "";

        // TGLKONTROL
        $this->TGLKONTROL->LinkCustomAttributes = "";
        $this->TGLKONTROL->HrefValue = "";
        $this->TGLKONTROL->TooltipValue = "";

        // KDPOLI_KONTROL
        $this->KDPOLI_KONTROL->LinkCustomAttributes = "";
        $this->KDPOLI_KONTROL->HrefValue = "";
        $this->KDPOLI_KONTROL->TooltipValue = "";

        // JAMINAN
        $this->JAMINAN->LinkCustomAttributes = "";
        $this->JAMINAN->HrefValue = "";
        $this->JAMINAN->TooltipValue = "";

        // SPESIALISTIK
        $this->SPESIALISTIK->LinkCustomAttributes = "";
        $this->SPESIALISTIK->HrefValue = "";
        $this->SPESIALISTIK->TooltipValue = "";

        // PEMERIKSAAN_02
        $this->PEMERIKSAAN_02->LinkCustomAttributes = "";
        $this->PEMERIKSAAN_02->HrefValue = "";
        $this->PEMERIKSAAN_02->TooltipValue = "";

        // DIAGNOSA_DESC_02
        $this->DIAGNOSA_DESC_02->LinkCustomAttributes = "";
        $this->DIAGNOSA_DESC_02->HrefValue = "";
        $this->DIAGNOSA_DESC_02->TooltipValue = "";

        // DIAGNOSA_DESC_03
        $this->DIAGNOSA_DESC_03->LinkCustomAttributes = "";
        $this->DIAGNOSA_DESC_03->HrefValue = "";
        $this->DIAGNOSA_DESC_03->TooltipValue = "";

        // DIAGNOSA_DESC_04
        $this->DIAGNOSA_DESC_04->LinkCustomAttributes = "";
        $this->DIAGNOSA_DESC_04->HrefValue = "";
        $this->DIAGNOSA_DESC_04->TooltipValue = "";

        // DIAGNOSA_DESC_05
        $this->DIAGNOSA_DESC_05->LinkCustomAttributes = "";
        $this->DIAGNOSA_DESC_05->HrefValue = "";
        $this->DIAGNOSA_DESC_05->TooltipValue = "";

        // DIAGNOSA_DESC_06
        $this->DIAGNOSA_DESC_06->LinkCustomAttributes = "";
        $this->DIAGNOSA_DESC_06->HrefValue = "";
        $this->DIAGNOSA_DESC_06->TooltipValue = "";

        // PROCEDURE_DESC_01
        $this->PROCEDURE_DESC_01->LinkCustomAttributes = "";
        $this->PROCEDURE_DESC_01->HrefValue = "";
        $this->PROCEDURE_DESC_01->TooltipValue = "";

        // PROCEDURE_DESC_02
        $this->PROCEDURE_DESC_02->LinkCustomAttributes = "";
        $this->PROCEDURE_DESC_02->HrefValue = "";
        $this->PROCEDURE_DESC_02->TooltipValue = "";

        // PROCEDURE_DESC_03
        $this->PROCEDURE_DESC_03->LinkCustomAttributes = "";
        $this->PROCEDURE_DESC_03->HrefValue = "";
        $this->PROCEDURE_DESC_03->TooltipValue = "";

        // PROCEDURE_DESC_04
        $this->PROCEDURE_DESC_04->LinkCustomAttributes = "";
        $this->PROCEDURE_DESC_04->HrefValue = "";
        $this->PROCEDURE_DESC_04->TooltipValue = "";

        // PROCEDURE_DESC_05
        $this->PROCEDURE_DESC_05->LinkCustomAttributes = "";
        $this->PROCEDURE_DESC_05->HrefValue = "";
        $this->PROCEDURE_DESC_05->TooltipValue = "";

        // RESPONPOST
        $this->RESPONPOST->LinkCustomAttributes = "";
        $this->RESPONPOST->HrefValue = "";
        $this->RESPONPOST->TooltipValue = "";

        // RESPONPUT
        $this->RESPONPUT->LinkCustomAttributes = "";
        $this->RESPONPUT->HrefValue = "";
        $this->RESPONPUT->TooltipValue = "";

        // RESPONDEL
        $this->RESPONDEL->LinkCustomAttributes = "";
        $this->RESPONDEL->HrefValue = "";
        $this->RESPONDEL->TooltipValue = "";

        // JSONPOST
        $this->JSONPOST->LinkCustomAttributes = "";
        $this->JSONPOST->HrefValue = "";
        $this->JSONPOST->TooltipValue = "";

        // JSONPUT
        $this->JSONPUT->LinkCustomAttributes = "";
        $this->JSONPUT->HrefValue = "";
        $this->JSONPUT->TooltipValue = "";

        // JSONDEL
        $this->JSONDEL->LinkCustomAttributes = "";
        $this->JSONDEL->HrefValue = "";
        $this->JSONDEL->TooltipValue = "";

        // height
        $this->height->LinkCustomAttributes = "";
        $this->height->HrefValue = "";
        $this->height->TooltipValue = "";

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

        // spec_procedures
        $this->spec_procedures->LinkCustomAttributes = "";
        $this->spec_procedures->HrefValue = "";
        $this->spec_procedures->TooltipValue = "";

        // spec_drug
        $this->spec_drug->LinkCustomAttributes = "";
        $this->spec_drug->HrefValue = "";
        $this->spec_drug->TooltipValue = "";

        // spec_prothesis
        $this->spec_prothesis->LinkCustomAttributes = "";
        $this->spec_prothesis->HrefValue = "";
        $this->spec_prothesis->TooltipValue = "";

        // spec_investigation
        $this->spec_investigation->LinkCustomAttributes = "";
        $this->spec_investigation->HrefValue = "";
        $this->spec_investigation->TooltipValue = "";

        // procedure_11
        $this->procedure_11->LinkCustomAttributes = "";
        $this->procedure_11->HrefValue = "";
        $this->procedure_11->TooltipValue = "";

        // procedure_12
        $this->procedure_12->LinkCustomAttributes = "";
        $this->procedure_12->HrefValue = "";
        $this->procedure_12->TooltipValue = "";

        // procedure_13
        $this->procedure_13->LinkCustomAttributes = "";
        $this->procedure_13->HrefValue = "";
        $this->procedure_13->TooltipValue = "";

        // procedure_14
        $this->procedure_14->LinkCustomAttributes = "";
        $this->procedure_14->HrefValue = "";
        $this->procedure_14->TooltipValue = "";

        // procedure_15
        $this->procedure_15->LinkCustomAttributes = "";
        $this->procedure_15->HrefValue = "";
        $this->procedure_15->TooltipValue = "";

        // isanestesi
        $this->isanestesi->LinkCustomAttributes = "";
        $this->isanestesi->HrefValue = "";
        $this->isanestesi->TooltipValue = "";

        // isreposisi
        $this->isreposisi->LinkCustomAttributes = "";
        $this->isreposisi->HrefValue = "";
        $this->isreposisi->TooltipValue = "";

        // islab
        $this->islab->LinkCustomAttributes = "";
        $this->islab->HrefValue = "";
        $this->islab->TooltipValue = "";

        // isro
        $this->isro->LinkCustomAttributes = "";
        $this->isro->HrefValue = "";
        $this->isro->TooltipValue = "";

        // isekg
        $this->isekg->LinkCustomAttributes = "";
        $this->isekg->HrefValue = "";
        $this->isekg->TooltipValue = "";

        // ishecting
        $this->ishecting->LinkCustomAttributes = "";
        $this->ishecting->HrefValue = "";
        $this->ishecting->TooltipValue = "";

        // isgips
        $this->isgips->LinkCustomAttributes = "";
        $this->isgips->HrefValue = "";
        $this->isgips->TooltipValue = "";

        // islengkap
        $this->islengkap->LinkCustomAttributes = "";
        $this->islengkap->HrefValue = "";
        $this->islengkap->TooltipValue = "";

        // ID
        $this->ID->LinkCustomAttributes = "";
        $this->ID->HrefValue = "";
        $this->ID->TooltipValue = "";

        // IDXDAFTAR
        $this->IDXDAFTAR->LinkCustomAttributes = "";
        $this->IDXDAFTAR->HrefValue = "";
        $this->IDXDAFTAR->TooltipValue = "";

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

        // PASIEN_DIAGNOSA_ID

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        $curVal = trim(strval($this->NO_REGISTRATION->CurrentValue));
        if ($curVal != "") {
            $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->lookupCacheOption($curVal);
            if ($this->NO_REGISTRATION->EditValue === null) { // Lookup from database
                $filterWrk = "[NO_REGISTRATION]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->NO_REGISTRATION->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->NO_REGISTRATION->Lookup->renderViewRow($rswrk[0]);
                    $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->displayValue($arwrk);
                } else {
                    $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
                }
            }
        } else {
            $this->NO_REGISTRATION->EditValue = null;
        }
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // THENAME
        $this->THENAME->EditAttrs["class"] = "form-control";
        $this->THENAME->EditCustomAttributes = "";
        if (!$this->THENAME->Raw) {
            $this->THENAME->CurrentValue = HtmlDecode($this->THENAME->CurrentValue);
        }
        $this->THENAME->EditValue = $this->THENAME->CurrentValue;
        $this->THENAME->PlaceHolder = RemoveHtml($this->THENAME->caption());

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if ($this->VISIT_ID->getSessionValue() != "") {
            $this->VISIT_ID->CurrentValue = GetForeignKeyValue($this->VISIT_ID->getSessionValue());
            $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
            $this->VISIT_ID->ViewCustomAttributes = "";
        } else {
            if (!$this->VISIT_ID->Raw) {
                $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
            }
            $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
            $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());
        }

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

        // BILL_ID
        $this->BILL_ID->EditAttrs["class"] = "form-control";
        $this->BILL_ID->EditCustomAttributes = "";
        if (!$this->BILL_ID->Raw) {
            $this->BILL_ID->CurrentValue = HtmlDecode($this->BILL_ID->CurrentValue);
        }
        $this->BILL_ID->EditValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->PlaceHolder = RemoveHtml($this->BILL_ID->caption());

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ROOM_ID->EditCustomAttributes = "";
        if (!$this->CLASS_ROOM_ID->Raw) {
            $this->CLASS_ROOM_ID->CurrentValue = HtmlDecode($this->CLASS_ROOM_ID->CurrentValue);
        }
        $this->CLASS_ROOM_ID->EditValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

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

        // BED_ID
        $this->BED_ID->EditAttrs["class"] = "form-control";
        $this->BED_ID->EditCustomAttributes = "";
        $this->BED_ID->EditValue = $this->BED_ID->CurrentValue;
        $this->BED_ID->PlaceHolder = RemoveHtml($this->BED_ID->caption());

        // KELUAR_ID
        $this->KELUAR_ID->EditAttrs["class"] = "form-control";
        $this->KELUAR_ID->EditCustomAttributes = "";
        $this->KELUAR_ID->PlaceHolder = RemoveHtml($this->KELUAR_ID->caption());

        // DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA->EditAttrs["class"] = "form-control";
        $this->DATE_OF_DIAGNOSA->EditCustomAttributes = "";
        $this->DATE_OF_DIAGNOSA->EditValue = FormatDateTime($this->DATE_OF_DIAGNOSA->CurrentValue, 11);
        $this->DATE_OF_DIAGNOSA->PlaceHolder = RemoveHtml($this->DATE_OF_DIAGNOSA->caption());

        // REPORT_DATE
        $this->REPORT_DATE->EditAttrs["class"] = "form-control";
        $this->REPORT_DATE->EditCustomAttributes = "";
        $this->REPORT_DATE->EditValue = FormatDateTime($this->REPORT_DATE->CurrentValue, 8);
        $this->REPORT_DATE->PlaceHolder = RemoveHtml($this->REPORT_DATE->caption());

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID->EditCustomAttributes = "";
        $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

        // DIAGNOSA_DESC
        $this->DIAGNOSA_DESC->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_DESC->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_DESC->Raw) {
            $this->DIAGNOSA_DESC->CurrentValue = HtmlDecode($this->DIAGNOSA_DESC->CurrentValue);
        }
        $this->DIAGNOSA_DESC->EditValue = $this->DIAGNOSA_DESC->CurrentValue;
        $this->DIAGNOSA_DESC->PlaceHolder = RemoveHtml($this->DIAGNOSA_DESC->caption());

        // ANAMNASE
        $this->ANAMNASE->EditAttrs["class"] = "form-control";
        $this->ANAMNASE->EditCustomAttributes = "";
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

        // SUFFER_TYPE
        $this->SUFFER_TYPE->EditAttrs["class"] = "form-control";
        $this->SUFFER_TYPE->EditCustomAttributes = "";
        $this->SUFFER_TYPE->PlaceHolder = RemoveHtml($this->SUFFER_TYPE->caption());

        // INFECTED_BODY
        $this->INFECTED_BODY->EditAttrs["class"] = "form-control";
        $this->INFECTED_BODY->EditCustomAttributes = "";
        $this->INFECTED_BODY->EditValue = $this->INFECTED_BODY->CurrentValue;
        $this->INFECTED_BODY->PlaceHolder = RemoveHtml($this->INFECTED_BODY->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // RISK_LEVEL
        $this->RISK_LEVEL->EditAttrs["class"] = "form-control";
        $this->RISK_LEVEL->EditCustomAttributes = "";
        $this->RISK_LEVEL->EditValue = $this->RISK_LEVEL->CurrentValue;
        $this->RISK_LEVEL->PlaceHolder = RemoveHtml($this->RISK_LEVEL->caption());

        // MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA->EditAttrs["class"] = "form-control";
        $this->MORFOLOGI_NEOPLASMA->EditCustomAttributes = "";
        if (!$this->MORFOLOGI_NEOPLASMA->Raw) {
            $this->MORFOLOGI_NEOPLASMA->CurrentValue = HtmlDecode($this->MORFOLOGI_NEOPLASMA->CurrentValue);
        }
        $this->MORFOLOGI_NEOPLASMA->EditValue = $this->MORFOLOGI_NEOPLASMA->CurrentValue;
        $this->MORFOLOGI_NEOPLASMA->PlaceHolder = RemoveHtml($this->MORFOLOGI_NEOPLASMA->caption());

        // HURT
        $this->HURT->EditAttrs["class"] = "form-control";
        $this->HURT->EditCustomAttributes = "";
        if (!$this->HURT->Raw) {
            $this->HURT->CurrentValue = HtmlDecode($this->HURT->CurrentValue);
        }
        $this->HURT->EditValue = $this->HURT->CurrentValue;
        $this->HURT->PlaceHolder = RemoveHtml($this->HURT->caption());

        // HURT_TYPE
        $this->HURT_TYPE->EditAttrs["class"] = "form-control";
        $this->HURT_TYPE->EditCustomAttributes = "";
        $this->HURT_TYPE->EditValue = $this->HURT_TYPE->CurrentValue;
        $this->HURT_TYPE->PlaceHolder = RemoveHtml($this->HURT_TYPE->caption());

        // DIAG_CAT
        $this->DIAG_CAT->EditAttrs["class"] = "form-control";
        $this->DIAG_CAT->EditCustomAttributes = "";
        $this->DIAG_CAT->PlaceHolder = RemoveHtml($this->DIAG_CAT->caption());

        // ADDICTION_MATERIAL
        $this->ADDICTION_MATERIAL->EditAttrs["class"] = "form-control";
        $this->ADDICTION_MATERIAL->EditCustomAttributes = "";
        if (!$this->ADDICTION_MATERIAL->Raw) {
            $this->ADDICTION_MATERIAL->CurrentValue = HtmlDecode($this->ADDICTION_MATERIAL->CurrentValue);
        }
        $this->ADDICTION_MATERIAL->EditValue = $this->ADDICTION_MATERIAL->CurrentValue;
        $this->ADDICTION_MATERIAL->PlaceHolder = RemoveHtml($this->ADDICTION_MATERIAL->caption());

        // INFECTED_QUANTITY
        $this->INFECTED_QUANTITY->EditAttrs["class"] = "form-control";
        $this->INFECTED_QUANTITY->EditCustomAttributes = "";
        $this->INFECTED_QUANTITY->EditValue = $this->INFECTED_QUANTITY->CurrentValue;
        $this->INFECTED_QUANTITY->PlaceHolder = RemoveHtml($this->INFECTED_QUANTITY->caption());

        // CONTAGIOUS_TYPE
        $this->CONTAGIOUS_TYPE->EditAttrs["class"] = "form-control";
        $this->CONTAGIOUS_TYPE->EditCustomAttributes = "";
        $this->CONTAGIOUS_TYPE->EditValue = $this->CONTAGIOUS_TYPE->CurrentValue;
        $this->CONTAGIOUS_TYPE->PlaceHolder = RemoveHtml($this->CONTAGIOUS_TYPE->caption());

        // CURATIF_ID
        $this->CURATIF_ID->EditAttrs["class"] = "form-control";
        $this->CURATIF_ID->EditCustomAttributes = "";
        $this->CURATIF_ID->EditValue = $this->CURATIF_ID->CurrentValue;
        $this->CURATIF_ID->PlaceHolder = RemoveHtml($this->CURATIF_ID->caption());

        // RESULT_ID
        $this->RESULT_ID->EditAttrs["class"] = "form-control";
        $this->RESULT_ID->EditCustomAttributes = "";
        $this->RESULT_ID->EditValue = $this->RESULT_ID->CurrentValue;
        $this->RESULT_ID->PlaceHolder = RemoveHtml($this->RESULT_ID->caption());

        // INFECTION_TYPE
        $this->INFECTION_TYPE->EditAttrs["class"] = "form-control";
        $this->INFECTION_TYPE->EditCustomAttributes = "";
        $this->INFECTION_TYPE->EditValue = $this->INFECTION_TYPE->CurrentValue;
        $this->INFECTION_TYPE->PlaceHolder = RemoveHtml($this->INFECTION_TYPE->caption());

        // INVESTIGATION_ID
        $this->INVESTIGATION_ID->EditAttrs["class"] = "form-control";
        $this->INVESTIGATION_ID->EditCustomAttributes = "";
        $this->INVESTIGATION_ID->PlaceHolder = RemoveHtml($this->INVESTIGATION_ID->caption());

        // DISABILITY
        $this->DISABILITY->EditAttrs["class"] = "form-control";
        $this->DISABILITY->EditCustomAttributes = "";
        if (!$this->DISABILITY->Raw) {
            $this->DISABILITY->CurrentValue = HtmlDecode($this->DISABILITY->CurrentValue);
        }
        $this->DISABILITY->EditValue = $this->DISABILITY->CurrentValue;
        $this->DISABILITY->PlaceHolder = RemoveHtml($this->DISABILITY->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // KOMPLIKASI
        $this->KOMPLIKASI->EditAttrs["class"] = "form-control";
        $this->KOMPLIKASI->EditCustomAttributes = "";
        if (!$this->KOMPLIKASI->Raw) {
            $this->KOMPLIKASI->CurrentValue = HtmlDecode($this->KOMPLIKASI->CurrentValue);
        }
        $this->KOMPLIKASI->EditValue = $this->KOMPLIKASI->CurrentValue;
        $this->KOMPLIKASI->PlaceHolder = RemoveHtml($this->KOMPLIKASI->caption());

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

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // DIAGNOSA_ID_02
        $this->DIAGNOSA_ID_02->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_02->EditCustomAttributes = "";
        $this->DIAGNOSA_ID_02->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_02->caption());

        // DIAGNOSA_ID_03
        $this->DIAGNOSA_ID_03->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_03->EditCustomAttributes = "";
        $this->DIAGNOSA_ID_03->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_03->caption());

        // DIAGNOSA_ID_04
        $this->DIAGNOSA_ID_04->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_04->EditCustomAttributes = "";
        $this->DIAGNOSA_ID_04->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_04->caption());

        // DIAGNOSA_ID_05
        $this->DIAGNOSA_ID_05->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_05->EditCustomAttributes = "";
        $this->DIAGNOSA_ID_05->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_05->caption());

        // DIAGNOSA_ID_06
        $this->DIAGNOSA_ID_06->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_06->EditCustomAttributes = "";
        $this->DIAGNOSA_ID_06->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_06->caption());

        // DIAGNOSA_ID_07
        $this->DIAGNOSA_ID_07->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_07->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID_07->Raw) {
            $this->DIAGNOSA_ID_07->CurrentValue = HtmlDecode($this->DIAGNOSA_ID_07->CurrentValue);
        }
        $this->DIAGNOSA_ID_07->EditValue = $this->DIAGNOSA_ID_07->CurrentValue;
        $this->DIAGNOSA_ID_07->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_07->caption());

        // DIAGNOSA_ID_08
        $this->DIAGNOSA_ID_08->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_08->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID_08->Raw) {
            $this->DIAGNOSA_ID_08->CurrentValue = HtmlDecode($this->DIAGNOSA_ID_08->CurrentValue);
        }
        $this->DIAGNOSA_ID_08->EditValue = $this->DIAGNOSA_ID_08->CurrentValue;
        $this->DIAGNOSA_ID_08->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_08->caption());

        // DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_09->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID_09->Raw) {
            $this->DIAGNOSA_ID_09->CurrentValue = HtmlDecode($this->DIAGNOSA_ID_09->CurrentValue);
        }
        $this->DIAGNOSA_ID_09->EditValue = $this->DIAGNOSA_ID_09->CurrentValue;
        $this->DIAGNOSA_ID_09->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_09->caption());

        // DIAGNOSA_ID_10
        $this->DIAGNOSA_ID_10->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID_10->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID_10->Raw) {
            $this->DIAGNOSA_ID_10->CurrentValue = HtmlDecode($this->DIAGNOSA_ID_10->CurrentValue);
        }
        $this->DIAGNOSA_ID_10->EditValue = $this->DIAGNOSA_ID_10->CurrentValue;
        $this->DIAGNOSA_ID_10->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID_10->caption());

        // PROCEDURE_01
        $this->PROCEDURE_01->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_01->EditCustomAttributes = "";
        if (!$this->PROCEDURE_01->Raw) {
            $this->PROCEDURE_01->CurrentValue = HtmlDecode($this->PROCEDURE_01->CurrentValue);
        }
        $this->PROCEDURE_01->EditValue = $this->PROCEDURE_01->CurrentValue;
        $this->PROCEDURE_01->PlaceHolder = RemoveHtml($this->PROCEDURE_01->caption());

        // PROCEDURE_02
        $this->PROCEDURE_02->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_02->EditCustomAttributes = "";
        if (!$this->PROCEDURE_02->Raw) {
            $this->PROCEDURE_02->CurrentValue = HtmlDecode($this->PROCEDURE_02->CurrentValue);
        }
        $this->PROCEDURE_02->EditValue = $this->PROCEDURE_02->CurrentValue;
        $this->PROCEDURE_02->PlaceHolder = RemoveHtml($this->PROCEDURE_02->caption());

        // PROCEDURE_03
        $this->PROCEDURE_03->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_03->EditCustomAttributes = "";
        if (!$this->PROCEDURE_03->Raw) {
            $this->PROCEDURE_03->CurrentValue = HtmlDecode($this->PROCEDURE_03->CurrentValue);
        }
        $this->PROCEDURE_03->EditValue = $this->PROCEDURE_03->CurrentValue;
        $this->PROCEDURE_03->PlaceHolder = RemoveHtml($this->PROCEDURE_03->caption());

        // PROCEDURE_04
        $this->PROCEDURE_04->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_04->EditCustomAttributes = "";
        if (!$this->PROCEDURE_04->Raw) {
            $this->PROCEDURE_04->CurrentValue = HtmlDecode($this->PROCEDURE_04->CurrentValue);
        }
        $this->PROCEDURE_04->EditValue = $this->PROCEDURE_04->CurrentValue;
        $this->PROCEDURE_04->PlaceHolder = RemoveHtml($this->PROCEDURE_04->caption());

        // PROCEDURE_05
        $this->PROCEDURE_05->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_05->EditCustomAttributes = "";
        if (!$this->PROCEDURE_05->Raw) {
            $this->PROCEDURE_05->CurrentValue = HtmlDecode($this->PROCEDURE_05->CurrentValue);
        }
        $this->PROCEDURE_05->EditValue = $this->PROCEDURE_05->CurrentValue;
        $this->PROCEDURE_05->PlaceHolder = RemoveHtml($this->PROCEDURE_05->caption());

        // PROCEDURE_06
        $this->PROCEDURE_06->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_06->EditCustomAttributes = "";
        if (!$this->PROCEDURE_06->Raw) {
            $this->PROCEDURE_06->CurrentValue = HtmlDecode($this->PROCEDURE_06->CurrentValue);
        }
        $this->PROCEDURE_06->EditValue = $this->PROCEDURE_06->CurrentValue;
        $this->PROCEDURE_06->PlaceHolder = RemoveHtml($this->PROCEDURE_06->caption());

        // PROCEDURE_07
        $this->PROCEDURE_07->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_07->EditCustomAttributes = "";
        if (!$this->PROCEDURE_07->Raw) {
            $this->PROCEDURE_07->CurrentValue = HtmlDecode($this->PROCEDURE_07->CurrentValue);
        }
        $this->PROCEDURE_07->EditValue = $this->PROCEDURE_07->CurrentValue;
        $this->PROCEDURE_07->PlaceHolder = RemoveHtml($this->PROCEDURE_07->caption());

        // PROCEDURE_08
        $this->PROCEDURE_08->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_08->EditCustomAttributes = "";
        if (!$this->PROCEDURE_08->Raw) {
            $this->PROCEDURE_08->CurrentValue = HtmlDecode($this->PROCEDURE_08->CurrentValue);
        }
        $this->PROCEDURE_08->EditValue = $this->PROCEDURE_08->CurrentValue;
        $this->PROCEDURE_08->PlaceHolder = RemoveHtml($this->PROCEDURE_08->caption());

        // PROCEDURE_09
        $this->PROCEDURE_09->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_09->EditCustomAttributes = "";
        if (!$this->PROCEDURE_09->Raw) {
            $this->PROCEDURE_09->CurrentValue = HtmlDecode($this->PROCEDURE_09->CurrentValue);
        }
        $this->PROCEDURE_09->EditValue = $this->PROCEDURE_09->CurrentValue;
        $this->PROCEDURE_09->PlaceHolder = RemoveHtml($this->PROCEDURE_09->caption());

        // PROCEDURE_10
        $this->PROCEDURE_10->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_10->EditCustomAttributes = "";
        if (!$this->PROCEDURE_10->Raw) {
            $this->PROCEDURE_10->CurrentValue = HtmlDecode($this->PROCEDURE_10->CurrentValue);
        }
        $this->PROCEDURE_10->EditValue = $this->PROCEDURE_10->CurrentValue;
        $this->PROCEDURE_10->PlaceHolder = RemoveHtml($this->PROCEDURE_10->caption());

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID2->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID2->Raw) {
            $this->DIAGNOSA_ID2->CurrentValue = HtmlDecode($this->DIAGNOSA_ID2->CurrentValue);
        }
        $this->DIAGNOSA_ID2->EditValue = $this->DIAGNOSA_ID2->CurrentValue;
        $this->DIAGNOSA_ID2->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID2->caption());

        // WEIGHT
        $this->WEIGHT->EditAttrs["class"] = "form-control";
        $this->WEIGHT->EditCustomAttributes = "";
        $this->WEIGHT->EditValue = $this->WEIGHT->CurrentValue;
        $this->WEIGHT->PlaceHolder = RemoveHtml($this->WEIGHT->caption());
        if (strval($this->WEIGHT->EditValue) != "" && is_numeric($this->WEIGHT->EditValue)) {
            $this->WEIGHT->EditValue = FormatNumber($this->WEIGHT->EditValue, -2, -2, -2, -2);
        }

        // NOKARTU
        $this->NOKARTU->EditAttrs["class"] = "form-control";
        $this->NOKARTU->EditCustomAttributes = "";
        if (!$this->NOKARTU->Raw) {
            $this->NOKARTU->CurrentValue = HtmlDecode($this->NOKARTU->CurrentValue);
        }
        $this->NOKARTU->EditValue = $this->NOKARTU->CurrentValue;
        $this->NOKARTU->PlaceHolder = RemoveHtml($this->NOKARTU->caption());

        // NOSEP
        $this->NOSEP->EditAttrs["class"] = "form-control";
        $this->NOSEP->EditCustomAttributes = "";
        if (!$this->NOSEP->Raw) {
            $this->NOSEP->CurrentValue = HtmlDecode($this->NOSEP->CurrentValue);
        }
        $this->NOSEP->EditValue = $this->NOSEP->CurrentValue;
        $this->NOSEP->PlaceHolder = RemoveHtml($this->NOSEP->caption());

        // TGLSEP
        $this->TGLSEP->EditAttrs["class"] = "form-control";
        $this->TGLSEP->EditCustomAttributes = "";
        $this->TGLSEP->EditValue = FormatDateTime($this->TGLSEP->CurrentValue, 8);
        $this->TGLSEP->PlaceHolder = RemoveHtml($this->TGLSEP->caption());

        // RENCANATL
        $this->RENCANATL->EditAttrs["class"] = "form-control";
        $this->RENCANATL->EditCustomAttributes = "";
        if (!$this->RENCANATL->Raw) {
            $this->RENCANATL->CurrentValue = HtmlDecode($this->RENCANATL->CurrentValue);
        }
        $this->RENCANATL->EditValue = $this->RENCANATL->CurrentValue;
        $this->RENCANATL->PlaceHolder = RemoveHtml($this->RENCANATL->caption());

        // DIRUJUKKE
        $this->DIRUJUKKE->EditAttrs["class"] = "form-control";
        $this->DIRUJUKKE->EditCustomAttributes = "";
        if (!$this->DIRUJUKKE->Raw) {
            $this->DIRUJUKKE->CurrentValue = HtmlDecode($this->DIRUJUKKE->CurrentValue);
        }
        $this->DIRUJUKKE->EditValue = $this->DIRUJUKKE->CurrentValue;
        $this->DIRUJUKKE->PlaceHolder = RemoveHtml($this->DIRUJUKKE->caption());

        // TGLKONTROL
        $this->TGLKONTROL->EditAttrs["class"] = "form-control";
        $this->TGLKONTROL->EditCustomAttributes = "";
        $this->TGLKONTROL->EditValue = FormatDateTime($this->TGLKONTROL->CurrentValue, 8);
        $this->TGLKONTROL->PlaceHolder = RemoveHtml($this->TGLKONTROL->caption());

        // KDPOLI_KONTROL
        $this->KDPOLI_KONTROL->EditAttrs["class"] = "form-control";
        $this->KDPOLI_KONTROL->EditCustomAttributes = "";
        if (!$this->KDPOLI_KONTROL->Raw) {
            $this->KDPOLI_KONTROL->CurrentValue = HtmlDecode($this->KDPOLI_KONTROL->CurrentValue);
        }
        $this->KDPOLI_KONTROL->EditValue = $this->KDPOLI_KONTROL->CurrentValue;
        $this->KDPOLI_KONTROL->PlaceHolder = RemoveHtml($this->KDPOLI_KONTROL->caption());

        // JAMINAN
        $this->JAMINAN->EditAttrs["class"] = "form-control";
        $this->JAMINAN->EditCustomAttributes = "";
        if (!$this->JAMINAN->Raw) {
            $this->JAMINAN->CurrentValue = HtmlDecode($this->JAMINAN->CurrentValue);
        }
        $this->JAMINAN->EditValue = $this->JAMINAN->CurrentValue;
        $this->JAMINAN->PlaceHolder = RemoveHtml($this->JAMINAN->caption());

        // SPESIALISTIK
        $this->SPESIALISTIK->EditAttrs["class"] = "form-control";
        $this->SPESIALISTIK->EditCustomAttributes = "";
        if (!$this->SPESIALISTIK->Raw) {
            $this->SPESIALISTIK->CurrentValue = HtmlDecode($this->SPESIALISTIK->CurrentValue);
        }
        $this->SPESIALISTIK->EditValue = $this->SPESIALISTIK->CurrentValue;
        $this->SPESIALISTIK->PlaceHolder = RemoveHtml($this->SPESIALISTIK->caption());

        // PEMERIKSAAN_02
        $this->PEMERIKSAAN_02->EditAttrs["class"] = "form-control";
        $this->PEMERIKSAAN_02->EditCustomAttributes = "";
        if (!$this->PEMERIKSAAN_02->Raw) {
            $this->PEMERIKSAAN_02->CurrentValue = HtmlDecode($this->PEMERIKSAAN_02->CurrentValue);
        }
        $this->PEMERIKSAAN_02->EditValue = $this->PEMERIKSAAN_02->CurrentValue;
        $this->PEMERIKSAAN_02->PlaceHolder = RemoveHtml($this->PEMERIKSAAN_02->caption());

        // DIAGNOSA_DESC_02
        $this->DIAGNOSA_DESC_02->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_DESC_02->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_DESC_02->Raw) {
            $this->DIAGNOSA_DESC_02->CurrentValue = HtmlDecode($this->DIAGNOSA_DESC_02->CurrentValue);
        }
        $this->DIAGNOSA_DESC_02->EditValue = $this->DIAGNOSA_DESC_02->CurrentValue;
        $this->DIAGNOSA_DESC_02->PlaceHolder = RemoveHtml($this->DIAGNOSA_DESC_02->caption());

        // DIAGNOSA_DESC_03
        $this->DIAGNOSA_DESC_03->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_DESC_03->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_DESC_03->Raw) {
            $this->DIAGNOSA_DESC_03->CurrentValue = HtmlDecode($this->DIAGNOSA_DESC_03->CurrentValue);
        }
        $this->DIAGNOSA_DESC_03->EditValue = $this->DIAGNOSA_DESC_03->CurrentValue;
        $this->DIAGNOSA_DESC_03->PlaceHolder = RemoveHtml($this->DIAGNOSA_DESC_03->caption());

        // DIAGNOSA_DESC_04
        $this->DIAGNOSA_DESC_04->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_DESC_04->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_DESC_04->Raw) {
            $this->DIAGNOSA_DESC_04->CurrentValue = HtmlDecode($this->DIAGNOSA_DESC_04->CurrentValue);
        }
        $this->DIAGNOSA_DESC_04->EditValue = $this->DIAGNOSA_DESC_04->CurrentValue;
        $this->DIAGNOSA_DESC_04->PlaceHolder = RemoveHtml($this->DIAGNOSA_DESC_04->caption());

        // DIAGNOSA_DESC_05
        $this->DIAGNOSA_DESC_05->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_DESC_05->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_DESC_05->Raw) {
            $this->DIAGNOSA_DESC_05->CurrentValue = HtmlDecode($this->DIAGNOSA_DESC_05->CurrentValue);
        }
        $this->DIAGNOSA_DESC_05->EditValue = $this->DIAGNOSA_DESC_05->CurrentValue;
        $this->DIAGNOSA_DESC_05->PlaceHolder = RemoveHtml($this->DIAGNOSA_DESC_05->caption());

        // DIAGNOSA_DESC_06
        $this->DIAGNOSA_DESC_06->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_DESC_06->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_DESC_06->Raw) {
            $this->DIAGNOSA_DESC_06->CurrentValue = HtmlDecode($this->DIAGNOSA_DESC_06->CurrentValue);
        }
        $this->DIAGNOSA_DESC_06->EditValue = $this->DIAGNOSA_DESC_06->CurrentValue;
        $this->DIAGNOSA_DESC_06->PlaceHolder = RemoveHtml($this->DIAGNOSA_DESC_06->caption());

        // PROCEDURE_DESC_01
        $this->PROCEDURE_DESC_01->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_DESC_01->EditCustomAttributes = "";
        if (!$this->PROCEDURE_DESC_01->Raw) {
            $this->PROCEDURE_DESC_01->CurrentValue = HtmlDecode($this->PROCEDURE_DESC_01->CurrentValue);
        }
        $this->PROCEDURE_DESC_01->EditValue = $this->PROCEDURE_DESC_01->CurrentValue;
        $this->PROCEDURE_DESC_01->PlaceHolder = RemoveHtml($this->PROCEDURE_DESC_01->caption());

        // PROCEDURE_DESC_02
        $this->PROCEDURE_DESC_02->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_DESC_02->EditCustomAttributes = "";
        if (!$this->PROCEDURE_DESC_02->Raw) {
            $this->PROCEDURE_DESC_02->CurrentValue = HtmlDecode($this->PROCEDURE_DESC_02->CurrentValue);
        }
        $this->PROCEDURE_DESC_02->EditValue = $this->PROCEDURE_DESC_02->CurrentValue;
        $this->PROCEDURE_DESC_02->PlaceHolder = RemoveHtml($this->PROCEDURE_DESC_02->caption());

        // PROCEDURE_DESC_03
        $this->PROCEDURE_DESC_03->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_DESC_03->EditCustomAttributes = "";
        if (!$this->PROCEDURE_DESC_03->Raw) {
            $this->PROCEDURE_DESC_03->CurrentValue = HtmlDecode($this->PROCEDURE_DESC_03->CurrentValue);
        }
        $this->PROCEDURE_DESC_03->EditValue = $this->PROCEDURE_DESC_03->CurrentValue;
        $this->PROCEDURE_DESC_03->PlaceHolder = RemoveHtml($this->PROCEDURE_DESC_03->caption());

        // PROCEDURE_DESC_04
        $this->PROCEDURE_DESC_04->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_DESC_04->EditCustomAttributes = "";
        if (!$this->PROCEDURE_DESC_04->Raw) {
            $this->PROCEDURE_DESC_04->CurrentValue = HtmlDecode($this->PROCEDURE_DESC_04->CurrentValue);
        }
        $this->PROCEDURE_DESC_04->EditValue = $this->PROCEDURE_DESC_04->CurrentValue;
        $this->PROCEDURE_DESC_04->PlaceHolder = RemoveHtml($this->PROCEDURE_DESC_04->caption());

        // PROCEDURE_DESC_05
        $this->PROCEDURE_DESC_05->EditAttrs["class"] = "form-control";
        $this->PROCEDURE_DESC_05->EditCustomAttributes = "";
        if (!$this->PROCEDURE_DESC_05->Raw) {
            $this->PROCEDURE_DESC_05->CurrentValue = HtmlDecode($this->PROCEDURE_DESC_05->CurrentValue);
        }
        $this->PROCEDURE_DESC_05->EditValue = $this->PROCEDURE_DESC_05->CurrentValue;
        $this->PROCEDURE_DESC_05->PlaceHolder = RemoveHtml($this->PROCEDURE_DESC_05->caption());

        // RESPONPOST
        $this->RESPONPOST->EditAttrs["class"] = "form-control";
        $this->RESPONPOST->EditCustomAttributes = "";
        $this->RESPONPOST->EditValue = $this->RESPONPOST->CurrentValue;
        $this->RESPONPOST->PlaceHolder = RemoveHtml($this->RESPONPOST->caption());

        // RESPONPUT
        $this->RESPONPUT->EditAttrs["class"] = "form-control";
        $this->RESPONPUT->EditCustomAttributes = "";
        $this->RESPONPUT->EditValue = $this->RESPONPUT->CurrentValue;
        $this->RESPONPUT->PlaceHolder = RemoveHtml($this->RESPONPUT->caption());

        // RESPONDEL
        $this->RESPONDEL->EditAttrs["class"] = "form-control";
        $this->RESPONDEL->EditCustomAttributes = "";
        $this->RESPONDEL->EditValue = $this->RESPONDEL->CurrentValue;
        $this->RESPONDEL->PlaceHolder = RemoveHtml($this->RESPONDEL->caption());

        // JSONPOST
        $this->JSONPOST->EditAttrs["class"] = "form-control";
        $this->JSONPOST->EditCustomAttributes = "";
        $this->JSONPOST->EditValue = $this->JSONPOST->CurrentValue;
        $this->JSONPOST->PlaceHolder = RemoveHtml($this->JSONPOST->caption());

        // JSONPUT
        $this->JSONPUT->EditAttrs["class"] = "form-control";
        $this->JSONPUT->EditCustomAttributes = "";
        $this->JSONPUT->EditValue = $this->JSONPUT->CurrentValue;
        $this->JSONPUT->PlaceHolder = RemoveHtml($this->JSONPUT->caption());

        // JSONDEL
        $this->JSONDEL->EditAttrs["class"] = "form-control";
        $this->JSONDEL->EditCustomAttributes = "";
        $this->JSONDEL->EditValue = $this->JSONDEL->CurrentValue;
        $this->JSONDEL->PlaceHolder = RemoveHtml($this->JSONDEL->caption());

        // height
        $this->height->EditAttrs["class"] = "form-control";
        $this->height->EditCustomAttributes = "";
        if (!$this->height->Raw) {
            $this->height->CurrentValue = HtmlDecode($this->height->CurrentValue);
        }
        $this->height->EditValue = $this->height->CurrentValue;
        $this->height->PlaceHolder = RemoveHtml($this->height->caption());

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

        // spec_procedures
        $this->spec_procedures->EditAttrs["class"] = "form-control";
        $this->spec_procedures->EditCustomAttributes = "";
        if (!$this->spec_procedures->Raw) {
            $this->spec_procedures->CurrentValue = HtmlDecode($this->spec_procedures->CurrentValue);
        }
        $this->spec_procedures->EditValue = $this->spec_procedures->CurrentValue;
        $this->spec_procedures->PlaceHolder = RemoveHtml($this->spec_procedures->caption());

        // spec_drug
        $this->spec_drug->EditAttrs["class"] = "form-control";
        $this->spec_drug->EditCustomAttributes = "";
        if (!$this->spec_drug->Raw) {
            $this->spec_drug->CurrentValue = HtmlDecode($this->spec_drug->CurrentValue);
        }
        $this->spec_drug->EditValue = $this->spec_drug->CurrentValue;
        $this->spec_drug->PlaceHolder = RemoveHtml($this->spec_drug->caption());

        // spec_prothesis
        $this->spec_prothesis->EditAttrs["class"] = "form-control";
        $this->spec_prothesis->EditCustomAttributes = "";
        if (!$this->spec_prothesis->Raw) {
            $this->spec_prothesis->CurrentValue = HtmlDecode($this->spec_prothesis->CurrentValue);
        }
        $this->spec_prothesis->EditValue = $this->spec_prothesis->CurrentValue;
        $this->spec_prothesis->PlaceHolder = RemoveHtml($this->spec_prothesis->caption());

        // spec_investigation
        $this->spec_investigation->EditAttrs["class"] = "form-control";
        $this->spec_investigation->EditCustomAttributes = "";
        if (!$this->spec_investigation->Raw) {
            $this->spec_investigation->CurrentValue = HtmlDecode($this->spec_investigation->CurrentValue);
        }
        $this->spec_investigation->EditValue = $this->spec_investigation->CurrentValue;
        $this->spec_investigation->PlaceHolder = RemoveHtml($this->spec_investigation->caption());

        // procedure_11
        $this->procedure_11->EditAttrs["class"] = "form-control";
        $this->procedure_11->EditCustomAttributes = "";
        if (!$this->procedure_11->Raw) {
            $this->procedure_11->CurrentValue = HtmlDecode($this->procedure_11->CurrentValue);
        }
        $this->procedure_11->EditValue = $this->procedure_11->CurrentValue;
        $this->procedure_11->PlaceHolder = RemoveHtml($this->procedure_11->caption());

        // procedure_12
        $this->procedure_12->EditAttrs["class"] = "form-control";
        $this->procedure_12->EditCustomAttributes = "";
        if (!$this->procedure_12->Raw) {
            $this->procedure_12->CurrentValue = HtmlDecode($this->procedure_12->CurrentValue);
        }
        $this->procedure_12->EditValue = $this->procedure_12->CurrentValue;
        $this->procedure_12->PlaceHolder = RemoveHtml($this->procedure_12->caption());

        // procedure_13
        $this->procedure_13->EditAttrs["class"] = "form-control";
        $this->procedure_13->EditCustomAttributes = "";
        if (!$this->procedure_13->Raw) {
            $this->procedure_13->CurrentValue = HtmlDecode($this->procedure_13->CurrentValue);
        }
        $this->procedure_13->EditValue = $this->procedure_13->CurrentValue;
        $this->procedure_13->PlaceHolder = RemoveHtml($this->procedure_13->caption());

        // procedure_14
        $this->procedure_14->EditAttrs["class"] = "form-control";
        $this->procedure_14->EditCustomAttributes = "";
        if (!$this->procedure_14->Raw) {
            $this->procedure_14->CurrentValue = HtmlDecode($this->procedure_14->CurrentValue);
        }
        $this->procedure_14->EditValue = $this->procedure_14->CurrentValue;
        $this->procedure_14->PlaceHolder = RemoveHtml($this->procedure_14->caption());

        // procedure_15
        $this->procedure_15->EditAttrs["class"] = "form-control";
        $this->procedure_15->EditCustomAttributes = "";
        if (!$this->procedure_15->Raw) {
            $this->procedure_15->CurrentValue = HtmlDecode($this->procedure_15->CurrentValue);
        }
        $this->procedure_15->EditValue = $this->procedure_15->CurrentValue;
        $this->procedure_15->PlaceHolder = RemoveHtml($this->procedure_15->caption());

        // isanestesi
        $this->isanestesi->EditAttrs["class"] = "form-control";
        $this->isanestesi->EditCustomAttributes = "";
        if (!$this->isanestesi->Raw) {
            $this->isanestesi->CurrentValue = HtmlDecode($this->isanestesi->CurrentValue);
        }
        $this->isanestesi->EditValue = $this->isanestesi->CurrentValue;
        $this->isanestesi->PlaceHolder = RemoveHtml($this->isanestesi->caption());

        // isreposisi
        $this->isreposisi->EditAttrs["class"] = "form-control";
        $this->isreposisi->EditCustomAttributes = "";
        if (!$this->isreposisi->Raw) {
            $this->isreposisi->CurrentValue = HtmlDecode($this->isreposisi->CurrentValue);
        }
        $this->isreposisi->EditValue = $this->isreposisi->CurrentValue;
        $this->isreposisi->PlaceHolder = RemoveHtml($this->isreposisi->caption());

        // islab
        $this->islab->EditAttrs["class"] = "form-control";
        $this->islab->EditCustomAttributes = "";
        if (!$this->islab->Raw) {
            $this->islab->CurrentValue = HtmlDecode($this->islab->CurrentValue);
        }
        $this->islab->EditValue = $this->islab->CurrentValue;
        $this->islab->PlaceHolder = RemoveHtml($this->islab->caption());

        // isro
        $this->isro->EditAttrs["class"] = "form-control";
        $this->isro->EditCustomAttributes = "";
        if (!$this->isro->Raw) {
            $this->isro->CurrentValue = HtmlDecode($this->isro->CurrentValue);
        }
        $this->isro->EditValue = $this->isro->CurrentValue;
        $this->isro->PlaceHolder = RemoveHtml($this->isro->caption());

        // isekg
        $this->isekg->EditAttrs["class"] = "form-control";
        $this->isekg->EditCustomAttributes = "";
        if (!$this->isekg->Raw) {
            $this->isekg->CurrentValue = HtmlDecode($this->isekg->CurrentValue);
        }
        $this->isekg->EditValue = $this->isekg->CurrentValue;
        $this->isekg->PlaceHolder = RemoveHtml($this->isekg->caption());

        // ishecting
        $this->ishecting->EditAttrs["class"] = "form-control";
        $this->ishecting->EditCustomAttributes = "";
        if (!$this->ishecting->Raw) {
            $this->ishecting->CurrentValue = HtmlDecode($this->ishecting->CurrentValue);
        }
        $this->ishecting->EditValue = $this->ishecting->CurrentValue;
        $this->ishecting->PlaceHolder = RemoveHtml($this->ishecting->caption());

        // isgips
        $this->isgips->EditAttrs["class"] = "form-control";
        $this->isgips->EditCustomAttributes = "";
        if (!$this->isgips->Raw) {
            $this->isgips->CurrentValue = HtmlDecode($this->isgips->CurrentValue);
        }
        $this->isgips->EditValue = $this->isgips->CurrentValue;
        $this->isgips->PlaceHolder = RemoveHtml($this->isgips->caption());

        // islengkap
        $this->islengkap->EditAttrs["class"] = "form-control";
        $this->islengkap->EditCustomAttributes = "";
        if (!$this->islengkap->Raw) {
            $this->islengkap->CurrentValue = HtmlDecode($this->islengkap->CurrentValue);
        }
        $this->islengkap->EditValue = $this->islengkap->CurrentValue;
        $this->islengkap->PlaceHolder = RemoveHtml($this->islengkap->caption());

        // ID
        $this->ID->EditAttrs["class"] = "form-control";
        $this->ID->EditCustomAttributes = "";
        $this->ID->EditValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // IDXDAFTAR
        $this->IDXDAFTAR->EditAttrs["class"] = "form-control";
        $this->IDXDAFTAR->EditCustomAttributes = "";
        $this->IDXDAFTAR->EditValue = $this->IDXDAFTAR->CurrentValue;
        $this->IDXDAFTAR->PlaceHolder = RemoveHtml($this->IDXDAFTAR->caption());

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
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->DATE_OF_DIAGNOSA);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->ANAMNASE);
                    $doc->exportCaption($this->PEMERIKSAAN);
                    $doc->exportCaption($this->TERAPHY_DESC);
                    $doc->exportCaption($this->INSTRUCTION);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->MORFOLOGI_NEOPLASMA);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->KOMPLIKASI);
                    $doc->exportCaption($this->DIAGNOSA_ID_02);
                    $doc->exportCaption($this->DIAGNOSA_ID_03);
                    $doc->exportCaption($this->DIAGNOSA_ID_04);
                    $doc->exportCaption($this->DIAGNOSA_ID_05);
                    $doc->exportCaption($this->DIAGNOSA_ID_06);
                    $doc->exportCaption($this->PROCEDURE_03);
                    $doc->exportCaption($this->PROCEDURE_05);
                    $doc->exportCaption($this->PROCEDURE_06);
                    $doc->exportCaption($this->DIAGNOSA_ID2);
                    $doc->exportCaption($this->WEIGHT);
                    $doc->exportCaption($this->TGLKONTROL);
                    $doc->exportCaption($this->PEMERIKSAAN_02);
                    $doc->exportCaption($this->height);
                    $doc->exportCaption($this->TEMPERATURE);
                    $doc->exportCaption($this->TENSION_UPPER);
                    $doc->exportCaption($this->NADI);
                    $doc->exportCaption($this->NAFAS);
                    $doc->exportCaption($this->IDXDAFTAR);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->PASIEN_DIAGNOSA_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->IN_DATE);
                    $doc->exportCaption($this->EXIT_DATE);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->DATE_OF_DIAGNOSA);
                    $doc->exportCaption($this->REPORT_DATE);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->DIAGNOSA_DESC);
                    $doc->exportCaption($this->ANAMNASE);
                    $doc->exportCaption($this->PEMERIKSAAN);
                    $doc->exportCaption($this->TERAPHY_DESC);
                    $doc->exportCaption($this->INSTRUCTION);
                    $doc->exportCaption($this->SUFFER_TYPE);
                    $doc->exportCaption($this->INFECTED_BODY);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->RISK_LEVEL);
                    $doc->exportCaption($this->MORFOLOGI_NEOPLASMA);
                    $doc->exportCaption($this->HURT);
                    $doc->exportCaption($this->HURT_TYPE);
                    $doc->exportCaption($this->DIAG_CAT);
                    $doc->exportCaption($this->ADDICTION_MATERIAL);
                    $doc->exportCaption($this->INFECTED_QUANTITY);
                    $doc->exportCaption($this->CONTAGIOUS_TYPE);
                    $doc->exportCaption($this->CURATIF_ID);
                    $doc->exportCaption($this->RESULT_ID);
                    $doc->exportCaption($this->INFECTION_TYPE);
                    $doc->exportCaption($this->INVESTIGATION_ID);
                    $doc->exportCaption($this->DISABILITY);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->KOMPLIKASI);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID_02);
                    $doc->exportCaption($this->DIAGNOSA_ID_03);
                    $doc->exportCaption($this->DIAGNOSA_ID_04);
                    $doc->exportCaption($this->DIAGNOSA_ID_05);
                    $doc->exportCaption($this->DIAGNOSA_ID_06);
                    $doc->exportCaption($this->DIAGNOSA_ID_07);
                    $doc->exportCaption($this->DIAGNOSA_ID_08);
                    $doc->exportCaption($this->DIAGNOSA_ID_09);
                    $doc->exportCaption($this->DIAGNOSA_ID_10);
                    $doc->exportCaption($this->PROCEDURE_01);
                    $doc->exportCaption($this->PROCEDURE_02);
                    $doc->exportCaption($this->PROCEDURE_03);
                    $doc->exportCaption($this->PROCEDURE_04);
                    $doc->exportCaption($this->PROCEDURE_05);
                    $doc->exportCaption($this->PROCEDURE_06);
                    $doc->exportCaption($this->PROCEDURE_07);
                    $doc->exportCaption($this->PROCEDURE_08);
                    $doc->exportCaption($this->PROCEDURE_09);
                    $doc->exportCaption($this->PROCEDURE_10);
                    $doc->exportCaption($this->DIAGNOSA_ID2);
                    $doc->exportCaption($this->WEIGHT);
                    $doc->exportCaption($this->NOKARTU);
                    $doc->exportCaption($this->NOSEP);
                    $doc->exportCaption($this->TGLSEP);
                    $doc->exportCaption($this->RENCANATL);
                    $doc->exportCaption($this->DIRUJUKKE);
                    $doc->exportCaption($this->TGLKONTROL);
                    $doc->exportCaption($this->KDPOLI_KONTROL);
                    $doc->exportCaption($this->JAMINAN);
                    $doc->exportCaption($this->SPESIALISTIK);
                    $doc->exportCaption($this->PEMERIKSAAN_02);
                    $doc->exportCaption($this->DIAGNOSA_DESC_02);
                    $doc->exportCaption($this->DIAGNOSA_DESC_03);
                    $doc->exportCaption($this->DIAGNOSA_DESC_04);
                    $doc->exportCaption($this->DIAGNOSA_DESC_05);
                    $doc->exportCaption($this->DIAGNOSA_DESC_06);
                    $doc->exportCaption($this->PROCEDURE_DESC_01);
                    $doc->exportCaption($this->PROCEDURE_DESC_02);
                    $doc->exportCaption($this->PROCEDURE_DESC_03);
                    $doc->exportCaption($this->PROCEDURE_DESC_04);
                    $doc->exportCaption($this->PROCEDURE_DESC_05);
                    $doc->exportCaption($this->height);
                    $doc->exportCaption($this->TEMPERATURE);
                    $doc->exportCaption($this->TENSION_UPPER);
                    $doc->exportCaption($this->TENSION_BELOW);
                    $doc->exportCaption($this->NADI);
                    $doc->exportCaption($this->NAFAS);
                    $doc->exportCaption($this->spec_procedures);
                    $doc->exportCaption($this->spec_drug);
                    $doc->exportCaption($this->spec_prothesis);
                    $doc->exportCaption($this->spec_investigation);
                    $doc->exportCaption($this->procedure_11);
                    $doc->exportCaption($this->procedure_12);
                    $doc->exportCaption($this->procedure_13);
                    $doc->exportCaption($this->procedure_14);
                    $doc->exportCaption($this->procedure_15);
                    $doc->exportCaption($this->isanestesi);
                    $doc->exportCaption($this->isreposisi);
                    $doc->exportCaption($this->islab);
                    $doc->exportCaption($this->isro);
                    $doc->exportCaption($this->isekg);
                    $doc->exportCaption($this->ishecting);
                    $doc->exportCaption($this->isgips);
                    $doc->exportCaption($this->islengkap);
                    $doc->exportCaption($this->ID);
                    $doc->exportCaption($this->IDXDAFTAR);
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
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->DATE_OF_DIAGNOSA);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->ANAMNASE);
                        $doc->exportField($this->PEMERIKSAAN);
                        $doc->exportField($this->TERAPHY_DESC);
                        $doc->exportField($this->INSTRUCTION);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->MORFOLOGI_NEOPLASMA);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->KOMPLIKASI);
                        $doc->exportField($this->DIAGNOSA_ID_02);
                        $doc->exportField($this->DIAGNOSA_ID_03);
                        $doc->exportField($this->DIAGNOSA_ID_04);
                        $doc->exportField($this->DIAGNOSA_ID_05);
                        $doc->exportField($this->DIAGNOSA_ID_06);
                        $doc->exportField($this->PROCEDURE_03);
                        $doc->exportField($this->PROCEDURE_05);
                        $doc->exportField($this->PROCEDURE_06);
                        $doc->exportField($this->DIAGNOSA_ID2);
                        $doc->exportField($this->WEIGHT);
                        $doc->exportField($this->TGLKONTROL);
                        $doc->exportField($this->PEMERIKSAAN_02);
                        $doc->exportField($this->height);
                        $doc->exportField($this->TEMPERATURE);
                        $doc->exportField($this->TENSION_UPPER);
                        $doc->exportField($this->NADI);
                        $doc->exportField($this->NAFAS);
                        $doc->exportField($this->IDXDAFTAR);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->PASIEN_DIAGNOSA_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->IN_DATE);
                        $doc->exportField($this->EXIT_DATE);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->DATE_OF_DIAGNOSA);
                        $doc->exportField($this->REPORT_DATE);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->DIAGNOSA_DESC);
                        $doc->exportField($this->ANAMNASE);
                        $doc->exportField($this->PEMERIKSAAN);
                        $doc->exportField($this->TERAPHY_DESC);
                        $doc->exportField($this->INSTRUCTION);
                        $doc->exportField($this->SUFFER_TYPE);
                        $doc->exportField($this->INFECTED_BODY);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->RISK_LEVEL);
                        $doc->exportField($this->MORFOLOGI_NEOPLASMA);
                        $doc->exportField($this->HURT);
                        $doc->exportField($this->HURT_TYPE);
                        $doc->exportField($this->DIAG_CAT);
                        $doc->exportField($this->ADDICTION_MATERIAL);
                        $doc->exportField($this->INFECTED_QUANTITY);
                        $doc->exportField($this->CONTAGIOUS_TYPE);
                        $doc->exportField($this->CURATIF_ID);
                        $doc->exportField($this->RESULT_ID);
                        $doc->exportField($this->INFECTION_TYPE);
                        $doc->exportField($this->INVESTIGATION_ID);
                        $doc->exportField($this->DISABILITY);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->KOMPLIKASI);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->DIAGNOSA_ID_02);
                        $doc->exportField($this->DIAGNOSA_ID_03);
                        $doc->exportField($this->DIAGNOSA_ID_04);
                        $doc->exportField($this->DIAGNOSA_ID_05);
                        $doc->exportField($this->DIAGNOSA_ID_06);
                        $doc->exportField($this->DIAGNOSA_ID_07);
                        $doc->exportField($this->DIAGNOSA_ID_08);
                        $doc->exportField($this->DIAGNOSA_ID_09);
                        $doc->exportField($this->DIAGNOSA_ID_10);
                        $doc->exportField($this->PROCEDURE_01);
                        $doc->exportField($this->PROCEDURE_02);
                        $doc->exportField($this->PROCEDURE_03);
                        $doc->exportField($this->PROCEDURE_04);
                        $doc->exportField($this->PROCEDURE_05);
                        $doc->exportField($this->PROCEDURE_06);
                        $doc->exportField($this->PROCEDURE_07);
                        $doc->exportField($this->PROCEDURE_08);
                        $doc->exportField($this->PROCEDURE_09);
                        $doc->exportField($this->PROCEDURE_10);
                        $doc->exportField($this->DIAGNOSA_ID2);
                        $doc->exportField($this->WEIGHT);
                        $doc->exportField($this->NOKARTU);
                        $doc->exportField($this->NOSEP);
                        $doc->exportField($this->TGLSEP);
                        $doc->exportField($this->RENCANATL);
                        $doc->exportField($this->DIRUJUKKE);
                        $doc->exportField($this->TGLKONTROL);
                        $doc->exportField($this->KDPOLI_KONTROL);
                        $doc->exportField($this->JAMINAN);
                        $doc->exportField($this->SPESIALISTIK);
                        $doc->exportField($this->PEMERIKSAAN_02);
                        $doc->exportField($this->DIAGNOSA_DESC_02);
                        $doc->exportField($this->DIAGNOSA_DESC_03);
                        $doc->exportField($this->DIAGNOSA_DESC_04);
                        $doc->exportField($this->DIAGNOSA_DESC_05);
                        $doc->exportField($this->DIAGNOSA_DESC_06);
                        $doc->exportField($this->PROCEDURE_DESC_01);
                        $doc->exportField($this->PROCEDURE_DESC_02);
                        $doc->exportField($this->PROCEDURE_DESC_03);
                        $doc->exportField($this->PROCEDURE_DESC_04);
                        $doc->exportField($this->PROCEDURE_DESC_05);
                        $doc->exportField($this->height);
                        $doc->exportField($this->TEMPERATURE);
                        $doc->exportField($this->TENSION_UPPER);
                        $doc->exportField($this->TENSION_BELOW);
                        $doc->exportField($this->NADI);
                        $doc->exportField($this->NAFAS);
                        $doc->exportField($this->spec_procedures);
                        $doc->exportField($this->spec_drug);
                        $doc->exportField($this->spec_prothesis);
                        $doc->exportField($this->spec_investigation);
                        $doc->exportField($this->procedure_11);
                        $doc->exportField($this->procedure_12);
                        $doc->exportField($this->procedure_13);
                        $doc->exportField($this->procedure_14);
                        $doc->exportField($this->procedure_15);
                        $doc->exportField($this->isanestesi);
                        $doc->exportField($this->isreposisi);
                        $doc->exportField($this->islab);
                        $doc->exportField($this->isro);
                        $doc->exportField($this->isekg);
                        $doc->exportField($this->ishecting);
                        $doc->exportField($this->isgips);
                        $doc->exportField($this->islengkap);
                        $doc->exportField($this->ID);
                        $doc->exportField($this->IDXDAFTAR);
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
