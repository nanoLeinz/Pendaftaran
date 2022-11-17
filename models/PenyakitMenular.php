<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for penyakit_menular
 */
class PenyakitMenular extends ReportTable
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
    public $ShowGroupHeaderAsRow = false;
    public $ShowCompactSummaryFooter = true;

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
        $this->TableVar = 'penyakit_menular';
        $this->TableName = 'penyakit_menular';
        $this->TableType = 'REPORT';

        // Update Table
        $this->UpdateTable = "[dbo].[PASIEN_DIAGNOSA]";
        $this->ReportSourceTable = 'PASIEN_DIAGNOSA'; // Report source table
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (report only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->ORG_UNIT_CODE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PASIEN_DIAGNOSA_ID', 'PASIEN_DIAGNOSA_ID', '[PASIEN_DIAGNOSA_ID]', '[PASIEN_DIAGNOSA_ID]', 200, 50, -1, false, '[PASIEN_DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_DIAGNOSA_ID->Nullable = false; // NOT NULL field
        $this->PASIEN_DIAGNOSA_ID->Required = true; // Required field
        $this->PASIEN_DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->PASIEN_DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_DIAGNOSA_ID->Param, "CustomMsg");
        $this->PASIEN_DIAGNOSA_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PASIEN_DIAGNOSA_ID'] = &$this->PASIEN_DIAGNOSA_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new ReportField('penyakit_menular', 'penyakit_menular', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NO_REGISTRATION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->NO_REGISTRATION->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // THENAME
        $this->THENAME = new ReportField('penyakit_menular', 'penyakit_menular', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->THENAME->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['THENAME'] = &$this->THENAME;

        // VISIT_ID
        $this->VISIT_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->VISIT_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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
        $this->CLINIC_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // BILL_ID
        $this->BILL_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_BILL_ID', 'BILL_ID', '[BILL_ID]', '[BILL_ID]', 200, 50, -1, false, '[BILL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_ID->Sortable = true; // Allow sort
        $this->BILL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_ID->Param, "CustomMsg");
        $this->BILL_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['BILL_ID'] = &$this->BILL_ID;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 50, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->CLASS_ROOM_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // IN_DATE
        $this->IN_DATE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_IN_DATE', 'IN_DATE', '[IN_DATE]', CastDateFieldForLike("[IN_DATE]", 0, "DB"), 135, 8, 0, false, '[IN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IN_DATE->Sortable = true; // Allow sort
        $this->IN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->IN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IN_DATE->Param, "CustomMsg");
        $this->IN_DATE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['IN_DATE'] = &$this->IN_DATE;

        // EXIT_DATE
        $this->EXIT_DATE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_EXIT_DATE', 'EXIT_DATE', '[EXIT_DATE]', CastDateFieldForLike("[EXIT_DATE]", 0, "DB"), 135, 8, 0, false, '[EXIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXIT_DATE->Sortable = true; // Allow sort
        $this->EXIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXIT_DATE->Param, "CustomMsg");
        $this->EXIT_DATE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['EXIT_DATE'] = &$this->EXIT_DATE;

        // BED_ID
        $this->BED_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = true; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->BED_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // KELUAR_ID
        $this->KELUAR_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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
        $this->KELUAR_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['KELUAR_ID'] = &$this->KELUAR_ID;

        // DATE_OF_DIAGNOSA
        $this->DATE_OF_DIAGNOSA = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DATE_OF_DIAGNOSA', 'DATE_OF_DIAGNOSA', '[DATE_OF_DIAGNOSA]', CastDateFieldForLike("[DATE_OF_DIAGNOSA]", 0, "DB"), 135, 8, 0, false, '[DATE_OF_DIAGNOSA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DATE_OF_DIAGNOSA->Sortable = true; // Allow sort
        $this->DATE_OF_DIAGNOSA->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DATE_OF_DIAGNOSA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DATE_OF_DIAGNOSA->Param, "CustomMsg");
        $this->DATE_OF_DIAGNOSA->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DATE_OF_DIAGNOSA'] = &$this->DATE_OF_DIAGNOSA;

        // REPORT_DATE
        $this->REPORT_DATE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_REPORT_DATE', 'REPORT_DATE', '[REPORT_DATE]', CastDateFieldForLike("[REPORT_DATE]", 0, "DB"), 135, 8, 0, false, '[REPORT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REPORT_DATE->Sortable = true; // Allow sort
        $this->REPORT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REPORT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REPORT_DATE->Param, "CustomMsg");
        $this->REPORT_DATE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['REPORT_DATE'] = &$this->REPORT_DATE;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 50, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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
        $this->DIAGNOSA_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // DIAGNOSA_DESC
        $this->DIAGNOSA_DESC = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_DESC', 'DIAGNOSA_DESC', '[DIAGNOSA_DESC]', '[DIAGNOSA_DESC]', 200, 200, -1, false, '[DIAGNOSA_DESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC->Param, "CustomMsg");
        $this->DIAGNOSA_DESC->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_DESC'] = &$this->DIAGNOSA_DESC;

        // ANAMNASE
        $this->ANAMNASE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_ANAMNASE', 'ANAMNASE', '[ANAMNASE]', '[ANAMNASE]', 200, 200, -1, false, '[ANAMNASE]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ANAMNASE->Sortable = true; // Allow sort
        $this->ANAMNASE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ANAMNASE->Param, "CustomMsg");
        $this->ANAMNASE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['ANAMNASE'] = &$this->ANAMNASE;

        // PEMERIKSAAN
        $this->PEMERIKSAAN = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PEMERIKSAAN', 'PEMERIKSAAN', '[PEMERIKSAAN]', '[PEMERIKSAAN]', 200, 200, -1, false, '[PEMERIKSAAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEMERIKSAAN->Sortable = true; // Allow sort
        $this->PEMERIKSAAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEMERIKSAAN->Param, "CustomMsg");
        $this->PEMERIKSAAN->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PEMERIKSAAN'] = &$this->PEMERIKSAAN;

        // TERAPHY_DESC
        $this->TERAPHY_DESC = new ReportField('penyakit_menular', 'penyakit_menular', 'x_TERAPHY_DESC', 'TERAPHY_DESC', '[TERAPHY_DESC]', '[TERAPHY_DESC]', 200, 200, -1, false, '[TERAPHY_DESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERAPHY_DESC->Sortable = true; // Allow sort
        $this->TERAPHY_DESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERAPHY_DESC->Param, "CustomMsg");
        $this->TERAPHY_DESC->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['TERAPHY_DESC'] = &$this->TERAPHY_DESC;

        // INSTRUCTION
        $this->INSTRUCTION = new ReportField('penyakit_menular', 'penyakit_menular', 'x_INSTRUCTION', 'INSTRUCTION', '[INSTRUCTION]', '[INSTRUCTION]', 200, 200, -1, false, '[INSTRUCTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INSTRUCTION->Sortable = true; // Allow sort
        $this->INSTRUCTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INSTRUCTION->Param, "CustomMsg");
        $this->INSTRUCTION->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['INSTRUCTION'] = &$this->INSTRUCTION;

        // SUFFER_TYPE
        $this->SUFFER_TYPE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_SUFFER_TYPE', 'SUFFER_TYPE', '[SUFFER_TYPE]', 'CAST([SUFFER_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[SUFFER_TYPE]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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
        $this->SUFFER_TYPE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['SUFFER_TYPE'] = &$this->SUFFER_TYPE;

        // INFECTED_BODY
        $this->INFECTED_BODY = new ReportField('penyakit_menular', 'penyakit_menular', 'x_INFECTED_BODY', 'INFECTED_BODY', '[INFECTED_BODY]', 'CAST([INFECTED_BODY] AS NVARCHAR)', 17, 1, -1, false, '[INFECTED_BODY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFECTED_BODY->Sortable = true; // Allow sort
        $this->INFECTED_BODY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INFECTED_BODY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFECTED_BODY->Param, "CustomMsg");
        $this->INFECTED_BODY->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['INFECTED_BODY'] = &$this->INFECTED_BODY;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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
        $this->EMPLOYEE_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // RISK_LEVEL
        $this->RISK_LEVEL = new ReportField('penyakit_menular', 'penyakit_menular', 'x_RISK_LEVEL', 'RISK_LEVEL', '[RISK_LEVEL]', 'CAST([RISK_LEVEL] AS NVARCHAR)', 17, 1, -1, false, '[RISK_LEVEL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RISK_LEVEL->Sortable = true; // Allow sort
        $this->RISK_LEVEL->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RISK_LEVEL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RISK_LEVEL->Param, "CustomMsg");
        $this->RISK_LEVEL->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['RISK_LEVEL'] = &$this->RISK_LEVEL;

        // MORFOLOGI_NEOPLASMA
        $this->MORFOLOGI_NEOPLASMA = new ReportField('penyakit_menular', 'penyakit_menular', 'x_MORFOLOGI_NEOPLASMA', 'MORFOLOGI_NEOPLASMA', '[MORFOLOGI_NEOPLASMA]', '[MORFOLOGI_NEOPLASMA]', 200, 200, -1, false, '[MORFOLOGI_NEOPLASMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MORFOLOGI_NEOPLASMA->Sortable = true; // Allow sort
        $this->MORFOLOGI_NEOPLASMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MORFOLOGI_NEOPLASMA->Param, "CustomMsg");
        $this->MORFOLOGI_NEOPLASMA->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['MORFOLOGI_NEOPLASMA'] = &$this->MORFOLOGI_NEOPLASMA;

        // HURT
        $this->HURT = new ReportField('penyakit_menular', 'penyakit_menular', 'x_HURT', 'HURT', '[HURT]', '[HURT]', 200, 200, -1, false, '[HURT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HURT->Sortable = true; // Allow sort
        $this->HURT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HURT->Param, "CustomMsg");
        $this->HURT->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['HURT'] = &$this->HURT;

        // HURT_TYPE
        $this->HURT_TYPE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_HURT_TYPE', 'HURT_TYPE', '[HURT_TYPE]', 'CAST([HURT_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[HURT_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HURT_TYPE->Sortable = true; // Allow sort
        $this->HURT_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->HURT_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HURT_TYPE->Param, "CustomMsg");
        $this->HURT_TYPE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['HURT_TYPE'] = &$this->HURT_TYPE;

        // DIAG_CAT
        $this->DIAG_CAT = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAG_CAT', 'DIAG_CAT', '[DIAG_CAT]', '[DIAG_CAT]', 129, 1, -1, false, '[DIAG_CAT]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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
        $this->DIAG_CAT->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAG_CAT'] = &$this->DIAG_CAT;

        // ADDICTION_MATERIAL
        $this->ADDICTION_MATERIAL = new ReportField('penyakit_menular', 'penyakit_menular', 'x_ADDICTION_MATERIAL', 'ADDICTION_MATERIAL', '[ADDICTION_MATERIAL]', '[ADDICTION_MATERIAL]', 200, 10, -1, false, '[ADDICTION_MATERIAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ADDICTION_MATERIAL->Sortable = true; // Allow sort
        $this->ADDICTION_MATERIAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ADDICTION_MATERIAL->Param, "CustomMsg");
        $this->ADDICTION_MATERIAL->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['ADDICTION_MATERIAL'] = &$this->ADDICTION_MATERIAL;

        // INFECTED_QUANTITY
        $this->INFECTED_QUANTITY = new ReportField('penyakit_menular', 'penyakit_menular', 'x_INFECTED_QUANTITY', 'INFECTED_QUANTITY', '[INFECTED_QUANTITY]', 'CAST([INFECTED_QUANTITY] AS NVARCHAR)', 2, 2, -1, false, '[INFECTED_QUANTITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFECTED_QUANTITY->Sortable = true; // Allow sort
        $this->INFECTED_QUANTITY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INFECTED_QUANTITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFECTED_QUANTITY->Param, "CustomMsg");
        $this->INFECTED_QUANTITY->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['INFECTED_QUANTITY'] = &$this->INFECTED_QUANTITY;

        // CONTAGIOUS_TYPE
        $this->CONTAGIOUS_TYPE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_CONTAGIOUS_TYPE', 'CONTAGIOUS_TYPE', '[CONTAGIOUS_TYPE]', 'CAST([CONTAGIOUS_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[CONTAGIOUS_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTAGIOUS_TYPE->Sortable = true; // Allow sort
        $this->CONTAGIOUS_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CONTAGIOUS_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTAGIOUS_TYPE->Param, "CustomMsg");
        $this->CONTAGIOUS_TYPE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['CONTAGIOUS_TYPE'] = &$this->CONTAGIOUS_TYPE;

        // CURATIF_ID
        $this->CURATIF_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_CURATIF_ID', 'CURATIF_ID', '[CURATIF_ID]', 'CAST([CURATIF_ID] AS NVARCHAR)', 17, 1, -1, false, '[CURATIF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CURATIF_ID->Sortable = true; // Allow sort
        $this->CURATIF_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CURATIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CURATIF_ID->Param, "CustomMsg");
        $this->CURATIF_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['CURATIF_ID'] = &$this->CURATIF_ID;

        // RESULT_ID
        $this->RESULT_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_RESULT_ID', 'RESULT_ID', '[RESULT_ID]', 'CAST([RESULT_ID] AS NVARCHAR)', 17, 1, -1, false, '[RESULT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESULT_ID->Sortable = true; // Allow sort
        $this->RESULT_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RESULT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESULT_ID->Param, "CustomMsg");
        $this->RESULT_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['RESULT_ID'] = &$this->RESULT_ID;

        // INFECTION_TYPE
        $this->INFECTION_TYPE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_INFECTION_TYPE', 'INFECTION_TYPE', '[INFECTION_TYPE]', 'CAST([INFECTION_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[INFECTION_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INFECTION_TYPE->Sortable = true; // Allow sort
        $this->INFECTION_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INFECTION_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INFECTION_TYPE->Param, "CustomMsg");
        $this->INFECTION_TYPE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['INFECTION_TYPE'] = &$this->INFECTION_TYPE;

        // INVESTIGATION_ID
        $this->INVESTIGATION_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_INVESTIGATION_ID', 'INVESTIGATION_ID', '[INVESTIGATION_ID]', 'CAST([INVESTIGATION_ID] AS NVARCHAR)', 17, 1, -1, false, '[INVESTIGATION_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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
        $this->INVESTIGATION_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['INVESTIGATION_ID'] = &$this->INVESTIGATION_ID;

        // DISABILITY
        $this->DISABILITY = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DISABILITY', 'DISABILITY', '[DISABILITY]', '[DISABILITY]', 200, 200, -1, false, '[DISABILITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISABILITY->Sortable = true; // Allow sort
        $this->DISABILITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISABILITY->Param, "CustomMsg");
        $this->DISABILITY->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DISABILITY'] = &$this->DISABILITY;

        // DESCRIPTION
        $this->DESCRIPTION = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 100, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->DESCRIPTION->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // KOMPLIKASI
        $this->KOMPLIKASI = new ReportField('penyakit_menular', 'penyakit_menular', 'x_KOMPLIKASI', 'KOMPLIKASI', '[KOMPLIKASI]', '[KOMPLIKASI]', 200, 255, -1, false, '[KOMPLIKASI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KOMPLIKASI->Sortable = true; // Allow sort
        $this->KOMPLIKASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KOMPLIKASI->Param, "CustomMsg");
        $this->KOMPLIKASI->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['KOMPLIKASI'] = &$this->KOMPLIKASI;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->MODIFIED_DATE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new ReportField('penyakit_menular', 'penyakit_menular', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->MODIFIED_BY->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new ReportField('penyakit_menular', 'penyakit_menular', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->MODIFIED_FROM->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->STATUS_PASIEN_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // AGEYEAR
        $this->AGEYEAR = new ReportField('penyakit_menular', 'penyakit_menular', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->AGEYEAR->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new ReportField('penyakit_menular', 'penyakit_menular', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->AGEMONTH->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new ReportField('penyakit_menular', 'penyakit_menular', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->AGEDAY->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // THEADDRESS
        $this->THEADDRESS = new ReportField('penyakit_menular', 'penyakit_menular', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 150, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->THEADDRESS->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEID
        $this->THEID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 25, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = true; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->THEID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['THEID'] = &$this->THEID;

        // ISRJ
        $this->ISRJ = new ReportField('penyakit_menular', 'penyakit_menular', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->ISRJ->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // GENDER
        $this->GENDER = new ReportField('penyakit_menular', 'penyakit_menular', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->GENDER->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['GENDER'] = &$this->GENDER;

        // DOCTOR
        $this->DOCTOR = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DOCTOR', 'DOCTOR', '[DOCTOR]', '[DOCTOR]', 200, 150, -1, false, '[DOCTOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR->Sortable = true; // Allow sort
        $this->DOCTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR->Param, "CustomMsg");
        $this->DOCTOR->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DOCTOR'] = &$this->DOCTOR;

        // KAL_ID
        $this->KAL_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->KAL_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->ACCOUNT_ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // DIAGNOSA_ID_02
        $this->DIAGNOSA_ID_02 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_02', 'DIAGNOSA_ID_02', '[DIAGNOSA_ID_02]', '[DIAGNOSA_ID_02]', 200, 10, -1, false, '[DIAGNOSA_ID_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_02->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_02->Param, "CustomMsg");
        $this->DIAGNOSA_ID_02->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_02'] = &$this->DIAGNOSA_ID_02;

        // DIAGNOSA_ID_03
        $this->DIAGNOSA_ID_03 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_03', 'DIAGNOSA_ID_03', '[DIAGNOSA_ID_03]', '[DIAGNOSA_ID_03]', 200, 10, -1, false, '[DIAGNOSA_ID_03]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_03->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_03->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_03->Param, "CustomMsg");
        $this->DIAGNOSA_ID_03->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_03'] = &$this->DIAGNOSA_ID_03;

        // DIAGNOSA_ID_04
        $this->DIAGNOSA_ID_04 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_04', 'DIAGNOSA_ID_04', '[DIAGNOSA_ID_04]', '[DIAGNOSA_ID_04]', 200, 10, -1, false, '[DIAGNOSA_ID_04]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_04->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_04->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_04->Param, "CustomMsg");
        $this->DIAGNOSA_ID_04->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_04'] = &$this->DIAGNOSA_ID_04;

        // DIAGNOSA_ID_05
        $this->DIAGNOSA_ID_05 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_05', 'DIAGNOSA_ID_05', '[DIAGNOSA_ID_05]', '[DIAGNOSA_ID_05]', 200, 10, -1, false, '[DIAGNOSA_ID_05]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_05->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_05->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_05->Param, "CustomMsg");
        $this->DIAGNOSA_ID_05->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_05'] = &$this->DIAGNOSA_ID_05;

        // DIAGNOSA_ID_06
        $this->DIAGNOSA_ID_06 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_06', 'DIAGNOSA_ID_06', '[DIAGNOSA_ID_06]', '[DIAGNOSA_ID_06]', 200, 10, -1, false, '[DIAGNOSA_ID_06]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_06->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_06->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_06->Param, "CustomMsg");
        $this->DIAGNOSA_ID_06->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_06'] = &$this->DIAGNOSA_ID_06;

        // DIAGNOSA_ID_07
        $this->DIAGNOSA_ID_07 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_07', 'DIAGNOSA_ID_07', '[DIAGNOSA_ID_07]', '[DIAGNOSA_ID_07]', 200, 10, -1, false, '[DIAGNOSA_ID_07]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_07->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_07->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_07->Param, "CustomMsg");
        $this->DIAGNOSA_ID_07->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_07'] = &$this->DIAGNOSA_ID_07;

        // DIAGNOSA_ID_08
        $this->DIAGNOSA_ID_08 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_08', 'DIAGNOSA_ID_08', '[DIAGNOSA_ID_08]', '[DIAGNOSA_ID_08]', 200, 10, -1, false, '[DIAGNOSA_ID_08]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_08->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_08->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_08->Param, "CustomMsg");
        $this->DIAGNOSA_ID_08->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_08'] = &$this->DIAGNOSA_ID_08;

        // DIAGNOSA_ID_09
        $this->DIAGNOSA_ID_09 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_09', 'DIAGNOSA_ID_09', '[DIAGNOSA_ID_09]', '[DIAGNOSA_ID_09]', 200, 10, -1, false, '[DIAGNOSA_ID_09]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_09->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_09->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_09->Param, "CustomMsg");
        $this->DIAGNOSA_ID_09->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_09'] = &$this->DIAGNOSA_ID_09;

        // DIAGNOSA_ID_10
        $this->DIAGNOSA_ID_10 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID_10', 'DIAGNOSA_ID_10', '[DIAGNOSA_ID_10]', '[DIAGNOSA_ID_10]', 200, 10, -1, false, '[DIAGNOSA_ID_10]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID_10->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID_10->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID_10->Param, "CustomMsg");
        $this->DIAGNOSA_ID_10->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID_10'] = &$this->DIAGNOSA_ID_10;

        // PROCEDURE_01
        $this->PROCEDURE_01 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_01', 'PROCEDURE_01', '[PROCEDURE_01]', '[PROCEDURE_01]', 200, 10, -1, false, '[PROCEDURE_01]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_01->Sortable = true; // Allow sort
        $this->PROCEDURE_01->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_01->Param, "CustomMsg");
        $this->PROCEDURE_01->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_01'] = &$this->PROCEDURE_01;

        // PROCEDURE_02
        $this->PROCEDURE_02 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_02', 'PROCEDURE_02', '[PROCEDURE_02]', '[PROCEDURE_02]', 200, 10, -1, false, '[PROCEDURE_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_02->Sortable = true; // Allow sort
        $this->PROCEDURE_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_02->Param, "CustomMsg");
        $this->PROCEDURE_02->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_02'] = &$this->PROCEDURE_02;

        // PROCEDURE_03
        $this->PROCEDURE_03 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_03', 'PROCEDURE_03', '[PROCEDURE_03]', '[PROCEDURE_03]', 200, 10, -1, false, '[PROCEDURE_03]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_03->Sortable = true; // Allow sort
        $this->PROCEDURE_03->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_03->Param, "CustomMsg");
        $this->PROCEDURE_03->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_03'] = &$this->PROCEDURE_03;

        // PROCEDURE_04
        $this->PROCEDURE_04 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_04', 'PROCEDURE_04', '[PROCEDURE_04]', '[PROCEDURE_04]', 200, 10, -1, false, '[PROCEDURE_04]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_04->Sortable = true; // Allow sort
        $this->PROCEDURE_04->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_04->Param, "CustomMsg");
        $this->PROCEDURE_04->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_04'] = &$this->PROCEDURE_04;

        // PROCEDURE_05
        $this->PROCEDURE_05 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_05', 'PROCEDURE_05', '[PROCEDURE_05]', '[PROCEDURE_05]', 200, 10, -1, false, '[PROCEDURE_05]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_05->Sortable = true; // Allow sort
        $this->PROCEDURE_05->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_05->Param, "CustomMsg");
        $this->PROCEDURE_05->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_05'] = &$this->PROCEDURE_05;

        // PROCEDURE_06
        $this->PROCEDURE_06 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_06', 'PROCEDURE_06', '[PROCEDURE_06]', '[PROCEDURE_06]', 200, 10, -1, false, '[PROCEDURE_06]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_06->Sortable = true; // Allow sort
        $this->PROCEDURE_06->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_06->Param, "CustomMsg");
        $this->PROCEDURE_06->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_06'] = &$this->PROCEDURE_06;

        // PROCEDURE_07
        $this->PROCEDURE_07 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_07', 'PROCEDURE_07', '[PROCEDURE_07]', '[PROCEDURE_07]', 200, 10, -1, false, '[PROCEDURE_07]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_07->Sortable = true; // Allow sort
        $this->PROCEDURE_07->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_07->Param, "CustomMsg");
        $this->PROCEDURE_07->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_07'] = &$this->PROCEDURE_07;

        // PROCEDURE_08
        $this->PROCEDURE_08 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_08', 'PROCEDURE_08', '[PROCEDURE_08]', '[PROCEDURE_08]', 200, 10, -1, false, '[PROCEDURE_08]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_08->Sortable = true; // Allow sort
        $this->PROCEDURE_08->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_08->Param, "CustomMsg");
        $this->PROCEDURE_08->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_08'] = &$this->PROCEDURE_08;

        // PROCEDURE_09
        $this->PROCEDURE_09 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_09', 'PROCEDURE_09', '[PROCEDURE_09]', '[PROCEDURE_09]', 200, 10, -1, false, '[PROCEDURE_09]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_09->Sortable = true; // Allow sort
        $this->PROCEDURE_09->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_09->Param, "CustomMsg");
        $this->PROCEDURE_09->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_09'] = &$this->PROCEDURE_09;

        // PROCEDURE_10
        $this->PROCEDURE_10 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_10', 'PROCEDURE_10', '[PROCEDURE_10]', '[PROCEDURE_10]', 200, 10, -1, false, '[PROCEDURE_10]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_10->Sortable = true; // Allow sort
        $this->PROCEDURE_10->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_10->Param, "CustomMsg");
        $this->PROCEDURE_10->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_10'] = &$this->PROCEDURE_10;

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_ID2', 'DIAGNOSA_ID2', '[DIAGNOSA_ID2]', '[DIAGNOSA_ID2]', 200, 50, -1, false, '[DIAGNOSA_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID2->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID2->Param, "CustomMsg");
        $this->DIAGNOSA_ID2->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_ID2'] = &$this->DIAGNOSA_ID2;

        // WEIGHT
        $this->WEIGHT = new ReportField('penyakit_menular', 'penyakit_menular', 'x_WEIGHT', 'WEIGHT', '[WEIGHT]', 'CAST([WEIGHT] AS NVARCHAR)', 131, 8, -1, false, '[WEIGHT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WEIGHT->Sortable = true; // Allow sort
        $this->WEIGHT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->WEIGHT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->WEIGHT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WEIGHT->Param, "CustomMsg");
        $this->WEIGHT->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['WEIGHT'] = &$this->WEIGHT;

        // NOKARTU
        $this->NOKARTU = new ReportField('penyakit_menular', 'penyakit_menular', 'x_NOKARTU', 'NOKARTU', '[NOKARTU]', '[NOKARTU]', 200, 50, -1, false, '[NOKARTU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOKARTU->Sortable = true; // Allow sort
        $this->NOKARTU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOKARTU->Param, "CustomMsg");
        $this->NOKARTU->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['NOKARTU'] = &$this->NOKARTU;

        // NOSEP
        $this->NOSEP = new ReportField('penyakit_menular', 'penyakit_menular', 'x_NOSEP', 'NOSEP', '[NOSEP]', '[NOSEP]', 200, 50, -1, false, '[NOSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOSEP->Sortable = true; // Allow sort
        $this->NOSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOSEP->Param, "CustomMsg");
        $this->NOSEP->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['NOSEP'] = &$this->NOSEP;

        // TGLSEP
        $this->TGLSEP = new ReportField('penyakit_menular', 'penyakit_menular', 'x_TGLSEP', 'TGLSEP', '[TGLSEP]', CastDateFieldForLike("[TGLSEP]", 0, "DB"), 135, 8, 0, false, '[TGLSEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLSEP->Sortable = true; // Allow sort
        $this->TGLSEP->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLSEP->Param, "CustomMsg");
        $this->TGLSEP->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['TGLSEP'] = &$this->TGLSEP;

        // RENCANATL
        $this->RENCANATL = new ReportField('penyakit_menular', 'penyakit_menular', 'x_RENCANATL', 'RENCANATL', '[RENCANATL]', '[RENCANATL]', 200, 3, -1, false, '[RENCANATL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RENCANATL->Sortable = true; // Allow sort
        $this->RENCANATL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RENCANATL->Param, "CustomMsg");
        $this->RENCANATL->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['RENCANATL'] = &$this->RENCANATL;

        // DIRUJUKKE
        $this->DIRUJUKKE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIRUJUKKE', 'DIRUJUKKE', '[DIRUJUKKE]', '[DIRUJUKKE]', 200, 10, -1, false, '[DIRUJUKKE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIRUJUKKE->Sortable = true; // Allow sort
        $this->DIRUJUKKE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIRUJUKKE->Param, "CustomMsg");
        $this->DIRUJUKKE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIRUJUKKE'] = &$this->DIRUJUKKE;

        // TGLKONTROL
        $this->TGLKONTROL = new ReportField('penyakit_menular', 'penyakit_menular', 'x_TGLKONTROL', 'TGLKONTROL', '[TGLKONTROL]', CastDateFieldForLike("[TGLKONTROL]", 0, "DB"), 135, 8, 0, false, '[TGLKONTROL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TGLKONTROL->Sortable = true; // Allow sort
        $this->TGLKONTROL->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TGLKONTROL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TGLKONTROL->Param, "CustomMsg");
        $this->TGLKONTROL->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['TGLKONTROL'] = &$this->TGLKONTROL;

        // KDPOLI_KONTROL
        $this->KDPOLI_KONTROL = new ReportField('penyakit_menular', 'penyakit_menular', 'x_KDPOLI_KONTROL', 'KDPOLI_KONTROL', '[KDPOLI_KONTROL]', '[KDPOLI_KONTROL]', 200, 10, -1, false, '[KDPOLI_KONTROL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDPOLI_KONTROL->Sortable = true; // Allow sort
        $this->KDPOLI_KONTROL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDPOLI_KONTROL->Param, "CustomMsg");
        $this->KDPOLI_KONTROL->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['KDPOLI_KONTROL'] = &$this->KDPOLI_KONTROL;

        // JAMINAN
        $this->JAMINAN = new ReportField('penyakit_menular', 'penyakit_menular', 'x_JAMINAN', 'JAMINAN', '[JAMINAN]', '[JAMINAN]', 200, 1, -1, false, '[JAMINAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JAMINAN->Sortable = true; // Allow sort
        $this->JAMINAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JAMINAN->Param, "CustomMsg");
        $this->JAMINAN->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['JAMINAN'] = &$this->JAMINAN;

        // SPESIALISTIK
        $this->SPESIALISTIK = new ReportField('penyakit_menular', 'penyakit_menular', 'x_SPESIALISTIK', 'SPESIALISTIK', '[SPESIALISTIK]', '[SPESIALISTIK]', 200, 3, -1, false, '[SPESIALISTIK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPESIALISTIK->Sortable = true; // Allow sort
        $this->SPESIALISTIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPESIALISTIK->Param, "CustomMsg");
        $this->SPESIALISTIK->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['SPESIALISTIK'] = &$this->SPESIALISTIK;

        // PEMERIKSAAN_02
        $this->PEMERIKSAAN_02 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PEMERIKSAAN_02', 'PEMERIKSAAN_02', '[PEMERIKSAAN_02]', '[PEMERIKSAAN_02]', 200, 250, -1, false, '[PEMERIKSAAN_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEMERIKSAAN_02->Sortable = true; // Allow sort
        $this->PEMERIKSAAN_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEMERIKSAAN_02->Param, "CustomMsg");
        $this->PEMERIKSAAN_02->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PEMERIKSAAN_02'] = &$this->PEMERIKSAAN_02;

        // DIAGNOSA_DESC_02
        $this->DIAGNOSA_DESC_02 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_DESC_02', 'DIAGNOSA_DESC_02', '[DIAGNOSA_DESC_02]', '[DIAGNOSA_DESC_02]', 200, 250, -1, false, '[DIAGNOSA_DESC_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_02->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_02->Param, "CustomMsg");
        $this->DIAGNOSA_DESC_02->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_DESC_02'] = &$this->DIAGNOSA_DESC_02;

        // DIAGNOSA_DESC_03
        $this->DIAGNOSA_DESC_03 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_DESC_03', 'DIAGNOSA_DESC_03', '[DIAGNOSA_DESC_03]', '[DIAGNOSA_DESC_03]', 200, 250, -1, false, '[DIAGNOSA_DESC_03]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_03->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_03->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_03->Param, "CustomMsg");
        $this->DIAGNOSA_DESC_03->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_DESC_03'] = &$this->DIAGNOSA_DESC_03;

        // DIAGNOSA_DESC_04
        $this->DIAGNOSA_DESC_04 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_DESC_04', 'DIAGNOSA_DESC_04', '[DIAGNOSA_DESC_04]', '[DIAGNOSA_DESC_04]', 200, 250, -1, false, '[DIAGNOSA_DESC_04]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_04->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_04->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_04->Param, "CustomMsg");
        $this->DIAGNOSA_DESC_04->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_DESC_04'] = &$this->DIAGNOSA_DESC_04;

        // DIAGNOSA_DESC_05
        $this->DIAGNOSA_DESC_05 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_DESC_05', 'DIAGNOSA_DESC_05', '[DIAGNOSA_DESC_05]', '[DIAGNOSA_DESC_05]', 200, 250, -1, false, '[DIAGNOSA_DESC_05]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_05->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_05->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_05->Param, "CustomMsg");
        $this->DIAGNOSA_DESC_05->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_DESC_05'] = &$this->DIAGNOSA_DESC_05;

        // DIAGNOSA_DESC_06
        $this->DIAGNOSA_DESC_06 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_DIAGNOSA_DESC_06', 'DIAGNOSA_DESC_06', '[DIAGNOSA_DESC_06]', '[DIAGNOSA_DESC_06]', 200, 250, -1, false, '[DIAGNOSA_DESC_06]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_DESC_06->Sortable = true; // Allow sort
        $this->DIAGNOSA_DESC_06->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_DESC_06->Param, "CustomMsg");
        $this->DIAGNOSA_DESC_06->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['DIAGNOSA_DESC_06'] = &$this->DIAGNOSA_DESC_06;

        // PROCEDURE_DESC_01
        $this->PROCEDURE_DESC_01 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_DESC_01', 'PROCEDURE_DESC_01', '[PROCEDURE_DESC_01]', '[PROCEDURE_DESC_01]', 200, 250, -1, false, '[PROCEDURE_DESC_01]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_01->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_01->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_01->Param, "CustomMsg");
        $this->PROCEDURE_DESC_01->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_DESC_01'] = &$this->PROCEDURE_DESC_01;

        // PROCEDURE_DESC_02
        $this->PROCEDURE_DESC_02 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_DESC_02', 'PROCEDURE_DESC_02', '[PROCEDURE_DESC_02]', '[PROCEDURE_DESC_02]', 200, 250, -1, false, '[PROCEDURE_DESC_02]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_02->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_02->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_02->Param, "CustomMsg");
        $this->PROCEDURE_DESC_02->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_DESC_02'] = &$this->PROCEDURE_DESC_02;

        // PROCEDURE_DESC_03
        $this->PROCEDURE_DESC_03 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_DESC_03', 'PROCEDURE_DESC_03', '[PROCEDURE_DESC_03]', '[PROCEDURE_DESC_03]', 200, 250, -1, false, '[PROCEDURE_DESC_03]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_03->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_03->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_03->Param, "CustomMsg");
        $this->PROCEDURE_DESC_03->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_DESC_03'] = &$this->PROCEDURE_DESC_03;

        // PROCEDURE_DESC_04
        $this->PROCEDURE_DESC_04 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_DESC_04', 'PROCEDURE_DESC_04', '[PROCEDURE_DESC_04]', '[PROCEDURE_DESC_04]', 200, 250, -1, false, '[PROCEDURE_DESC_04]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_04->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_04->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_04->Param, "CustomMsg");
        $this->PROCEDURE_DESC_04->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_DESC_04'] = &$this->PROCEDURE_DESC_04;

        // PROCEDURE_DESC_05
        $this->PROCEDURE_DESC_05 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_PROCEDURE_DESC_05', 'PROCEDURE_DESC_05', '[PROCEDURE_DESC_05]', '[PROCEDURE_DESC_05]', 200, 250, -1, false, '[PROCEDURE_DESC_05]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROCEDURE_DESC_05->Sortable = true; // Allow sort
        $this->PROCEDURE_DESC_05->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROCEDURE_DESC_05->Param, "CustomMsg");
        $this->PROCEDURE_DESC_05->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['PROCEDURE_DESC_05'] = &$this->PROCEDURE_DESC_05;

        // RESPONPOST
        $this->RESPONPOST = new ReportField('penyakit_menular', 'penyakit_menular', 'x_RESPONPOST', 'RESPONPOST', '[RESPONPOST]', '[RESPONPOST]', 201, 0, -1, false, '[RESPONPOST]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONPOST->Sortable = true; // Allow sort
        $this->RESPONPOST->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONPOST->Param, "CustomMsg");
        $this->RESPONPOST->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['RESPONPOST'] = &$this->RESPONPOST;

        // RESPONPUT
        $this->RESPONPUT = new ReportField('penyakit_menular', 'penyakit_menular', 'x_RESPONPUT', 'RESPONPUT', '[RESPONPUT]', '[RESPONPUT]', 201, 0, -1, false, '[RESPONPUT]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONPUT->Sortable = true; // Allow sort
        $this->RESPONPUT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONPUT->Param, "CustomMsg");
        $this->RESPONPUT->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['RESPONPUT'] = &$this->RESPONPUT;

        // RESPONDEL
        $this->RESPONDEL = new ReportField('penyakit_menular', 'penyakit_menular', 'x_RESPONDEL', 'RESPONDEL', '[RESPONDEL]', '[RESPONDEL]', 201, 0, -1, false, '[RESPONDEL]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONDEL->Sortable = true; // Allow sort
        $this->RESPONDEL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONDEL->Param, "CustomMsg");
        $this->RESPONDEL->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['RESPONDEL'] = &$this->RESPONDEL;

        // JSONPOST
        $this->JSONPOST = new ReportField('penyakit_menular', 'penyakit_menular', 'x_JSONPOST', 'JSONPOST', '[JSONPOST]', '[JSONPOST]', 201, 0, -1, false, '[JSONPOST]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->JSONPOST->Sortable = true; // Allow sort
        $this->JSONPOST->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JSONPOST->Param, "CustomMsg");
        $this->JSONPOST->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['JSONPOST'] = &$this->JSONPOST;

        // JSONPUT
        $this->JSONPUT = new ReportField('penyakit_menular', 'penyakit_menular', 'x_JSONPUT', 'JSONPUT', '[JSONPUT]', '[JSONPUT]', 201, 0, -1, false, '[JSONPUT]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->JSONPUT->Sortable = true; // Allow sort
        $this->JSONPUT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JSONPUT->Param, "CustomMsg");
        $this->JSONPUT->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['JSONPUT'] = &$this->JSONPUT;

        // JSONDEL
        $this->JSONDEL = new ReportField('penyakit_menular', 'penyakit_menular', 'x_JSONDEL', 'JSONDEL', '[JSONDEL]', '[JSONDEL]', 201, 0, -1, false, '[JSONDEL]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->JSONDEL->Sortable = true; // Allow sort
        $this->JSONDEL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JSONDEL->Param, "CustomMsg");
        $this->JSONDEL->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['JSONDEL'] = &$this->JSONDEL;

        // height
        $this->height = new ReportField('penyakit_menular', 'penyakit_menular', 'x_height', 'height', '[height]', '[height]', 200, 5, -1, false, '[height]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->height->Sortable = true; // Allow sort
        $this->height->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->height->Param, "CustomMsg");
        $this->height->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['height'] = &$this->height;

        // TEMPERATURE
        $this->TEMPERATURE = new ReportField('penyakit_menular', 'penyakit_menular', 'x_TEMPERATURE', 'TEMPERATURE', '[TEMPERATURE]', 'CAST([TEMPERATURE] AS NVARCHAR)', 131, 8, -1, false, '[TEMPERATURE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TEMPERATURE->Sortable = true; // Allow sort
        $this->TEMPERATURE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TEMPERATURE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TEMPERATURE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TEMPERATURE->Param, "CustomMsg");
        $this->TEMPERATURE->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['TEMPERATURE'] = &$this->TEMPERATURE;

        // TENSION_UPPER
        $this->TENSION_UPPER = new ReportField('penyakit_menular', 'penyakit_menular', 'x_TENSION_UPPER', 'TENSION_UPPER', '[TENSION_UPPER]', 'CAST([TENSION_UPPER] AS NVARCHAR)', 131, 8, -1, false, '[TENSION_UPPER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENSION_UPPER->Sortable = true; // Allow sort
        $this->TENSION_UPPER->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TENSION_UPPER->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TENSION_UPPER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENSION_UPPER->Param, "CustomMsg");
        $this->TENSION_UPPER->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['TENSION_UPPER'] = &$this->TENSION_UPPER;

        // TENSION_BELOW
        $this->TENSION_BELOW = new ReportField('penyakit_menular', 'penyakit_menular', 'x_TENSION_BELOW', 'TENSION_BELOW', '[TENSION_BELOW]', 'CAST([TENSION_BELOW] AS NVARCHAR)', 131, 8, -1, false, '[TENSION_BELOW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENSION_BELOW->Sortable = true; // Allow sort
        $this->TENSION_BELOW->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TENSION_BELOW->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TENSION_BELOW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENSION_BELOW->Param, "CustomMsg");
        $this->TENSION_BELOW->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['TENSION_BELOW'] = &$this->TENSION_BELOW;

        // NADI
        $this->NADI = new ReportField('penyakit_menular', 'penyakit_menular', 'x_NADI', 'NADI', '[NADI]', 'CAST([NADI] AS NVARCHAR)', 131, 8, -1, false, '[NADI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NADI->Sortable = true; // Allow sort
        $this->NADI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NADI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NADI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NADI->Param, "CustomMsg");
        $this->NADI->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['NADI'] = &$this->NADI;

        // NAFAS
        $this->NAFAS = new ReportField('penyakit_menular', 'penyakit_menular', 'x_NAFAS', 'NAFAS', '[NAFAS]', 'CAST([NAFAS] AS NVARCHAR)', 131, 8, -1, false, '[NAFAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAFAS->Sortable = true; // Allow sort
        $this->NAFAS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NAFAS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NAFAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAFAS->Param, "CustomMsg");
        $this->NAFAS->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['NAFAS'] = &$this->NAFAS;

        // spec_procedures
        $this->spec_procedures = new ReportField('penyakit_menular', 'penyakit_menular', 'x_spec_procedures', 'spec_procedures', '[spec_procedures]', '[spec_procedures]', 200, 200, -1, false, '[spec_procedures]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spec_procedures->Sortable = true; // Allow sort
        $this->spec_procedures->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spec_procedures->Param, "CustomMsg");
        $this->spec_procedures->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['spec_procedures'] = &$this->spec_procedures;

        // spec_drug
        $this->spec_drug = new ReportField('penyakit_menular', 'penyakit_menular', 'x_spec_drug', 'spec_drug', '[spec_drug]', '[spec_drug]', 200, 200, -1, false, '[spec_drug]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spec_drug->Sortable = true; // Allow sort
        $this->spec_drug->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spec_drug->Param, "CustomMsg");
        $this->spec_drug->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['spec_drug'] = &$this->spec_drug;

        // spec_prothesis
        $this->spec_prothesis = new ReportField('penyakit_menular', 'penyakit_menular', 'x_spec_prothesis', 'spec_prothesis', '[spec_prothesis]', '[spec_prothesis]', 200, 200, -1, false, '[spec_prothesis]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spec_prothesis->Sortable = true; // Allow sort
        $this->spec_prothesis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spec_prothesis->Param, "CustomMsg");
        $this->spec_prothesis->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['spec_prothesis'] = &$this->spec_prothesis;

        // spec_investigation
        $this->spec_investigation = new ReportField('penyakit_menular', 'penyakit_menular', 'x_spec_investigation', 'spec_investigation', '[spec_investigation]', '[spec_investigation]', 200, 200, -1, false, '[spec_investigation]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->spec_investigation->Sortable = true; // Allow sort
        $this->spec_investigation->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->spec_investigation->Param, "CustomMsg");
        $this->spec_investigation->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['spec_investigation'] = &$this->spec_investigation;

        // procedure_11
        $this->procedure_11 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_procedure_11', 'procedure_11', '[procedure_11]', '[procedure_11]', 200, 10, -1, false, '[procedure_11]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_11->Sortable = true; // Allow sort
        $this->procedure_11->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_11->Param, "CustomMsg");
        $this->procedure_11->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['procedure_11'] = &$this->procedure_11;

        // procedure_12
        $this->procedure_12 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_procedure_12', 'procedure_12', '[procedure_12]', '[procedure_12]', 200, 10, -1, false, '[procedure_12]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_12->Sortable = true; // Allow sort
        $this->procedure_12->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_12->Param, "CustomMsg");
        $this->procedure_12->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['procedure_12'] = &$this->procedure_12;

        // procedure_13
        $this->procedure_13 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_procedure_13', 'procedure_13', '[procedure_13]', '[procedure_13]', 200, 10, -1, false, '[procedure_13]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_13->Sortable = true; // Allow sort
        $this->procedure_13->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_13->Param, "CustomMsg");
        $this->procedure_13->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['procedure_13'] = &$this->procedure_13;

        // procedure_14
        $this->procedure_14 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_procedure_14', 'procedure_14', '[procedure_14]', '[procedure_14]', 200, 10, -1, false, '[procedure_14]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_14->Sortable = true; // Allow sort
        $this->procedure_14->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_14->Param, "CustomMsg");
        $this->procedure_14->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['procedure_14'] = &$this->procedure_14;

        // procedure_15
        $this->procedure_15 = new ReportField('penyakit_menular', 'penyakit_menular', 'x_procedure_15', 'procedure_15', '[procedure_15]', '[procedure_15]', 200, 10, -1, false, '[procedure_15]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->procedure_15->Sortable = true; // Allow sort
        $this->procedure_15->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->procedure_15->Param, "CustomMsg");
        $this->procedure_15->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['procedure_15'] = &$this->procedure_15;

        // isanestesi
        $this->isanestesi = new ReportField('penyakit_menular', 'penyakit_menular', 'x_isanestesi', 'isanestesi', '[isanestesi]', '[isanestesi]', 129, 1, -1, false, '[isanestesi]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isanestesi->Sortable = true; // Allow sort
        $this->isanestesi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isanestesi->Param, "CustomMsg");
        $this->isanestesi->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['isanestesi'] = &$this->isanestesi;

        // isreposisi
        $this->isreposisi = new ReportField('penyakit_menular', 'penyakit_menular', 'x_isreposisi', 'isreposisi', '[isreposisi]', '[isreposisi]', 129, 1, -1, false, '[isreposisi]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isreposisi->Sortable = true; // Allow sort
        $this->isreposisi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isreposisi->Param, "CustomMsg");
        $this->isreposisi->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['isreposisi'] = &$this->isreposisi;

        // islab
        $this->islab = new ReportField('penyakit_menular', 'penyakit_menular', 'x_islab', 'islab', '[islab]', '[islab]', 129, 1, -1, false, '[islab]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->islab->Sortable = true; // Allow sort
        $this->islab->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->islab->Param, "CustomMsg");
        $this->islab->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['islab'] = &$this->islab;

        // isro
        $this->isro = new ReportField('penyakit_menular', 'penyakit_menular', 'x_isro', 'isro', '[isro]', '[isro]', 129, 1, -1, false, '[isro]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isro->Sortable = true; // Allow sort
        $this->isro->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isro->Param, "CustomMsg");
        $this->isro->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['isro'] = &$this->isro;

        // isekg
        $this->isekg = new ReportField('penyakit_menular', 'penyakit_menular', 'x_isekg', 'isekg', '[isekg]', '[isekg]', 129, 1, -1, false, '[isekg]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isekg->Sortable = true; // Allow sort
        $this->isekg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isekg->Param, "CustomMsg");
        $this->isekg->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['isekg'] = &$this->isekg;

        // ishecting
        $this->ishecting = new ReportField('penyakit_menular', 'penyakit_menular', 'x_ishecting', 'ishecting', '[ishecting]', '[ishecting]', 129, 1, -1, false, '[ishecting]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ishecting->Sortable = true; // Allow sort
        $this->ishecting->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ishecting->Param, "CustomMsg");
        $this->ishecting->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['ishecting'] = &$this->ishecting;

        // isgips
        $this->isgips = new ReportField('penyakit_menular', 'penyakit_menular', 'x_isgips', 'isgips', '[isgips]', '[isgips]', 129, 1, -1, false, '[isgips]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isgips->Sortable = true; // Allow sort
        $this->isgips->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isgips->Param, "CustomMsg");
        $this->isgips->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['isgips'] = &$this->isgips;

        // islengkap
        $this->islengkap = new ReportField('penyakit_menular', 'penyakit_menular', 'x_islengkap', 'islengkap', '[islengkap]', '[islengkap]', 129, 1, -1, false, '[islengkap]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->islengkap->Sortable = true; // Allow sort
        $this->islengkap->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->islengkap->Param, "CustomMsg");
        $this->islengkap->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['islengkap'] = &$this->islengkap;

        // ID
        $this->ID = new ReportField('penyakit_menular', 'penyakit_menular', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 3, 4, -1, false, '[ID]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->Nullable = false; // NOT NULL field
        $this->ID->Sortable = true; // Allow sort
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID->Param, "CustomMsg");
        $this->ID->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['ID'] = &$this->ID;

        // IDXDAFTAR
        $this->IDXDAFTAR = new ReportField('penyakit_menular', 'penyakit_menular', 'x_IDXDAFTAR', 'IDXDAFTAR', '[IDXDAFTAR]', 'CAST([IDXDAFTAR] AS NVARCHAR)', 3, 4, -1, false, '[IDXDAFTAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IDXDAFTAR->Sortable = true; // Allow sort
        $this->IDXDAFTAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->IDXDAFTAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IDXDAFTAR->Param, "CustomMsg");
        $this->IDXDAFTAR->SourceTableVar = 'PASIEN_DIAGNOSA';
        $this->Fields['IDXDAFTAR'] = &$this->IDXDAFTAR;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Single column sort
    protected function updateSort(&$fld)
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
            $lastOrderBy = in_array($lastSort, ["ASC", "DESC"]) ? $sortField . " " . $lastSort : "";
            $curOrderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            if ($fld->GroupingFieldId == 0) {
                $this->setDetailOrderBy($curOrderBy); // Save to Session
            }
        } else {
            if ($fld->GroupingFieldId == 0) {
                $fld->setSort("");
            }
        }
    }

    // Get Sort SQL
    protected function sortSql()
    {
        $dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
        $argrps = [];
        foreach ($this->Fields as $fld) {
            if (in_array($fld->getSort(), ["ASC", "DESC"])) {
                $fldsql = $fld->Expression;
                if ($fld->GroupingFieldId > 0) {
                    if ($fld->GroupSql != "") {
                        $argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
                    } else {
                        $argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
                    }
                }
            }
        }
        $sortSql = "";
        foreach ($argrps as $grp) {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $grp;
        }
        if ($dtlSortSql != "") {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $dtlSortSql;
        }
        return $sortSql;
    }

    // Summary properties
    private $sqlSelectAggregate = null;
    private $sqlAggregatePrefix = "";
    private $sqlAggregateSuffix = "";
    private $sqlSelectCount = null;

    // Select Aggregate
    public function getSqlSelectAggregate()
    {
        return $this->sqlSelectAggregate ?? $this->getQueryBuilder()->select("*");
    }

    public function setSqlSelectAggregate($v)
    {
        $this->sqlSelectAggregate = $v;
    }

    // Aggregate Prefix
    public function getSqlAggregatePrefix()
    {
        return ($this->sqlAggregatePrefix != "") ? $this->sqlAggregatePrefix : "";
    }

    public function setSqlAggregatePrefix($v)
    {
        $this->sqlAggregatePrefix = $v;
    }

    // Aggregate Suffix
    public function getSqlAggregateSuffix()
    {
        return ($this->sqlAggregateSuffix != "") ? $this->sqlAggregateSuffix : "";
    }

    public function setSqlAggregateSuffix($v)
    {
        $this->sqlAggregateSuffix = $v;
    }

    // Select Count
    public function getSqlSelectCount()
    {
        return $this->sqlSelectCount ?? $this->getQueryBuilder()->select("COUNT(*)");
    }

    public function setSqlSelectCount($v)
    {
        $this->sqlSelectCount = $v;
    }

    // Render for lookup
    public function renderLookup()
    {
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
        if ($this->SqlSelect) {
            return $this->SqlSelect;
        }
        $select = $this->getQueryBuilder()->select("*");
        return $select;
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
        return $_SESSION[$name] ?? GetUrl("");
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
        if ($pageName == "") {
            return $Language->phrase("View");
        } elseif ($pageName == "") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "") {
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
                return "";
            case Config("API_ADD_ACTION"):
                return "";
            case Config("API_EDIT_ACTION"):
                return "";
            case Config("API_DELETE_ACTION"):
                return "";
            case Config("API_LIST_ACTION"):
                return "";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "?" . $this->getUrlParm($parm);
        } else {
            $url = "";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("", $this->getUrlParm($parm));
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
        return $this->keyUrl("", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
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
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            $this->DrillDown || $DashboardReport ||
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

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
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
