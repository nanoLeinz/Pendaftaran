<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for V_FARMASI
 */
class VFarmasi extends DbTable
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
    public $NO_SKPINAP;
    public $DIAGNOSA_ID;
    public $ticket_all;
    public $tanggal_rujukan;
    public $ISRJ;
    public $NORUJUKAN;
    public $PPKRUJUKAN;
    public $LOKASILAKA;
    public $KDPOLI;
    public $EDIT_SEP;
    public $DELETE_SEP;
    public $KODE_AGAMA;
    public $DIAG_AWAL;
    public $AKTIF;
    public $BILL_INAP;
    public $SEP_PRINTDATE;
    public $MAPPING_SEP;
    public $TRANS_ID;
    public $KDPOLI_EKS;
    public $COB;
    public $PENJAMIN;
    public $ASALRUJUKAN;
    public $RESPONSEP;
    public $APPROVAL_DESC;
    public $APPROVAL_RESPONAJUKAN;
    public $APPROVAL_RESPONAPPROV;
    public $RESPONTGLPLG_DESC;
    public $RESPONPOST_VKLAIM;
    public $RESPONPUT_VKLAIM;
    public $RESPONDEL_VKLAIM;
    public $CALL_TIMES;
    public $CALL_DATE;
    public $CALL_DATES;
    public $SERVED_DATE;
    public $SERVED_INAP;
    public $KDDPJP1;
    public $KDDPJP;
    public $IDXDAFTAR;
    public $tgl_kontrol;
    public $idbooking;
    public $id_tujuan;
    public $id_penunjang;
    public $id_pembiayaan;
    public $id_procedure;
    public $id_aspel;
    public $id_kelas;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'V_FARMASI';
        $this->TableName = 'V_FARMASI';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "dbo.PASIEN_VISITATION";
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
        $this->ShowMultipleDetails = true; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('V_FARMASI', 'V_FARMASI', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('V_FARMASI', 'V_FARMASI', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NO_REGISTRATION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","STATUS_PASIEN_ID",""], [], [], [], [], [], [], '[REGISTRATION_DATE] DESC', '');
                break;
            default:
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","STATUS_PASIEN_ID",""], [], [], [], [], [], [], '[REGISTRATION_DATE] DESC', '');
                break;
        }
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->IsForeignKey = true; // Foreign key field
        $this->VISIT_ID->Required = true; // Required field
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->STATUS_PASIEN_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->STATUS_PASIEN_ID->Lookup = new Lookup('STATUS_PASIEN_ID', 'STATUS_PASIEN', false, 'STATUS_PASIEN_ID', ["NAME_OF_STATUS_PASIEN","","",""], [], [], [], [], ["PAYOR_ID"], ["x_PAYOR_ID"], '', '');
                break;
            default:
                $this->STATUS_PASIEN_ID->Lookup = new Lookup('STATUS_PASIEN_ID', 'STATUS_PASIEN', false, 'STATUS_PASIEN_ID', ["NAME_OF_STATUS_PASIEN","","",""], [], [], [], [], ["PAYOR_ID"], ["x_PAYOR_ID"], '', '');
                break;
        }
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // RUJUKAN_ID
        $this->RUJUKAN_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_RUJUKAN_ID', 'RUJUKAN_ID', '[RUJUKAN_ID]', 'CAST([RUJUKAN_ID] AS NVARCHAR)', 20, 8, -1, false, '[RUJUKAN_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->RUJUKAN_ID->Sortable = true; // Allow sort
        $this->RUJUKAN_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->RUJUKAN_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->RUJUKAN_ID->Lookup = new Lookup('RUJUKAN_ID', 'RUJUKAN', false, 'RUJUKAN_ID', ["NAME_OF_RUJUKAN","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->RUJUKAN_ID->Lookup = new Lookup('RUJUKAN_ID', 'RUJUKAN', false, 'RUJUKAN_ID', ["NAME_OF_RUJUKAN","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->RUJUKAN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RUJUKAN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RUJUKAN_ID->Param, "CustomMsg");
        $this->Fields['RUJUKAN_ID'] = &$this->RUJUKAN_ID;

        // ADDRESS_OF_RUJUKAN
        $this->ADDRESS_OF_RUJUKAN = new DbField('V_FARMASI', 'V_FARMASI', 'x_ADDRESS_OF_RUJUKAN', 'ADDRESS_OF_RUJUKAN', '[ADDRESS_OF_RUJUKAN]', '[ADDRESS_OF_RUJUKAN]', 200, 100, -1, false, '[ADDRESS_OF_RUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ADDRESS_OF_RUJUKAN->Sortable = true; // Allow sort
        $this->ADDRESS_OF_RUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ADDRESS_OF_RUJUKAN->Param, "CustomMsg");
        $this->Fields['ADDRESS_OF_RUJUKAN'] = &$this->ADDRESS_OF_RUJUKAN;

        // REASON_ID
        $this->REASON_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_REASON_ID', 'REASON_ID', '[REASON_ID]', 'CAST([REASON_ID] AS NVARCHAR)', 17, 1, -1, false, '[REASON_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->REASON_ID->Sortable = true; // Allow sort
        $this->REASON_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->REASON_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->REASON_ID->Lookup = new Lookup('REASON_ID', 'VISIT_REASON', false, 'REASON_ID', ["REASON","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->REASON_ID->Lookup = new Lookup('REASON_ID', 'VISIT_REASON', false, 'REASON_ID', ["REASON","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->REASON_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REASON_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REASON_ID->Param, "CustomMsg");
        $this->Fields['REASON_ID'] = &$this->REASON_ID;

        // WAY_ID
        $this->WAY_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_WAY_ID', 'WAY_ID', '[WAY_ID]', 'CAST([WAY_ID] AS NVARCHAR)', 17, 1, -1, false, '[WAY_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->WAY_ID->Sortable = true; // Allow sort
        $this->WAY_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->WAY_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->WAY_ID->Lookup = new Lookup('WAY_ID', 'VISIT_WAY', false, 'WAY_ID', ["WAY","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->WAY_ID->Lookup = new Lookup('WAY_ID', 'VISIT_WAY', false, 'WAY_ID', ["WAY","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->WAY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->WAY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WAY_ID->Param, "CustomMsg");
        $this->Fields['WAY_ID'] = &$this->WAY_ID;

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_PATIENT_CATEGORY_ID', 'PATIENT_CATEGORY_ID', '[PATIENT_CATEGORY_ID]', 'CAST([PATIENT_CATEGORY_ID] AS NVARCHAR)', 17, 1, -1, false, '[PATIENT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->PATIENT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->PATIENT_CATEGORY_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->PATIENT_CATEGORY_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->PATIENT_CATEGORY_ID->Lookup = new Lookup('PATIENT_CATEGORY_ID', 'PATIENT_CATEGORY', false, 'PATIENT_CATEGORY_ID', ["PATIENT_CATEGORY","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->PATIENT_CATEGORY_ID->Lookup = new Lookup('PATIENT_CATEGORY_ID', 'PATIENT_CATEGORY', false, 'PATIENT_CATEGORY_ID', ["PATIENT_CATEGORY","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->PATIENT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PATIENT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PATIENT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['PATIENT_CATEGORY_ID'] = &$this->PATIENT_CATEGORY_ID;

        // BOOKED_DATE
        $this->BOOKED_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_BOOKED_DATE', 'BOOKED_DATE', '[BOOKED_DATE]', CastDateFieldForLike("[BOOKED_DATE]", 0, "DB"), 135, 8, 0, false, '[BOOKED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BOOKED_DATE->Sortable = true; // Allow sort
        $this->BOOKED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->BOOKED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BOOKED_DATE->Param, "CustomMsg");
        $this->Fields['BOOKED_DATE'] = &$this->BOOKED_DATE;

        // VISIT_DATE
        $this->VISIT_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_VISIT_DATE', 'VISIT_DATE', '[VISIT_DATE]', CastDateFieldForLike("[VISIT_DATE]", 0, "DB"), 135, 8, 0, false, '[VISIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_DATE->Sortable = true; // Allow sort
        $this->VISIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VISIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_DATE->Param, "CustomMsg");
        $this->Fields['VISIT_DATE'] = &$this->VISIT_DATE;

        // ISNEW
        $this->ISNEW = new DbField('V_FARMASI', 'V_FARMASI', 'x_ISNEW', 'ISNEW', '[ISNEW]', '[ISNEW]', 129, 1, -1, false, '[ISNEW]', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->ISNEW->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->ISNEW->Lookup = new Lookup('ISNEW', 'V_FARMASI', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ISNEW->Lookup = new Lookup('ISNEW', 'V_FARMASI', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ISNEW->OptionCount = 2;
        $this->ISNEW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISNEW->Param, "CustomMsg");
        $this->Fields['ISNEW'] = &$this->ISNEW;

        // FOLLOW_UP
        $this->FOLLOW_UP = new DbField('V_FARMASI', 'V_FARMASI', 'x_FOLLOW_UP', 'FOLLOW_UP', '[FOLLOW_UP]', 'CAST([FOLLOW_UP] AS NVARCHAR)', 17, 1, -1, false, '[FOLLOW_UP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FOLLOW_UP->Sortable = true; // Allow sort
        $this->FOLLOW_UP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FOLLOW_UP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FOLLOW_UP->Param, "CustomMsg");
        $this->Fields['FOLLOW_UP'] = &$this->FOLLOW_UP;

        // PLACE_TYPE
        $this->PLACE_TYPE = new DbField('V_FARMASI', 'V_FARMASI', 'x_PLACE_TYPE', 'PLACE_TYPE', '[PLACE_TYPE]', 'CAST([PLACE_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[PLACE_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PLACE_TYPE->Sortable = true; // Allow sort
        $this->PLACE_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PLACE_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PLACE_TYPE->Param, "CustomMsg");
        $this->Fields['PLACE_TYPE'] = &$this->PLACE_TYPE;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLINIC_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], ["KDPOLI"], ["x_KDPOLI"], '', '');
                break;
            default:
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], ["KDPOLI"], ["x_KDPOLI"], '', '');
                break;
        }
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM = new DbField('V_FARMASI', 'V_FARMASI', 'x_CLINIC_ID_FROM', 'CLINIC_ID_FROM', '[CLINIC_ID_FROM]', '[CLINIC_ID_FROM]', 200, 8, -1, false, '[CLINIC_ID_FROM]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLINIC_ID_FROM->Sortable = true; // Allow sort
        $this->CLINIC_ID_FROM->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLINIC_ID_FROM->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLINIC_ID_FROM->Lookup = new Lookup('CLINIC_ID_FROM', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->CLINIC_ID_FROM->Lookup = new Lookup('CLINIC_ID_FROM', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->CLINIC_ID_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID_FROM->Param, "CustomMsg");
        $this->Fields['CLINIC_ID_FROM'] = &$this->CLINIC_ID_FROM;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 16, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // BED_ID
        $this->BED_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = true; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // KELUAR_ID
        $this->KELUAR_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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

        // IN_DATE
        $this->IN_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_IN_DATE', 'IN_DATE', '[IN_DATE]', CastDateFieldForLike("[IN_DATE]", 0, "DB"), 135, 8, 0, false, '[IN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IN_DATE->Sortable = true; // Allow sort
        $this->IN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->IN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IN_DATE->Param, "CustomMsg");
        $this->Fields['IN_DATE'] = &$this->IN_DATE;

        // EXIT_DATE
        $this->EXIT_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_EXIT_DATE', 'EXIT_DATE', '[EXIT_DATE]', CastDateFieldForLike("[EXIT_DATE]", 0, "DB"), 135, 8, 0, false, '[EXIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXIT_DATE->Sortable = true; // Allow sort
        $this->EXIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXIT_DATE->Param, "CustomMsg");
        $this->Fields['EXIT_DATE'] = &$this->EXIT_DATE;

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH = new DbField('V_FARMASI', 'V_FARMASI', 'x_DIANTAR_OLEH', 'DIANTAR_OLEH', '[DIANTAR_OLEH]', '[DIANTAR_OLEH]', 200, 255, -1, false, '[DIANTAR_OLEH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIANTAR_OLEH->Sortable = true; // Allow sort
        $this->DIANTAR_OLEH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIANTAR_OLEH->Param, "CustomMsg");
        $this->Fields['DIANTAR_OLEH'] = &$this->DIANTAR_OLEH;

        // GENDER
        $this->GENDER = new DbField('V_FARMASI', 'V_FARMASI', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->GENDER->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->GENDER->Lookup = new Lookup('GENDER', 'SEX', false, 'GENDER', ["NAME_OF_GENDER","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->GENDER->Lookup = new Lookup('GENDER', 'SEX', false, 'GENDER', ["NAME_OF_GENDER","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('V_FARMASI', 'V_FARMASI', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // VISITOR_ADDRESS
        $this->VISITOR_ADDRESS = new DbField('V_FARMASI', 'V_FARMASI', 'x_VISITOR_ADDRESS', 'VISITOR_ADDRESS', '[VISITOR_ADDRESS]', '[VISITOR_ADDRESS]', 200, 150, -1, false, '[VISITOR_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISITOR_ADDRESS->Sortable = true; // Allow sort
        $this->VISITOR_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISITOR_ADDRESS->Param, "CustomMsg");
        $this->Fields['VISITOR_ADDRESS'] = &$this->VISITOR_ADDRESS;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('V_FARMASI', 'V_FARMASI', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('V_FARMASI', 'V_FARMASI', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
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

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM = new DbField('V_FARMASI', 'V_FARMASI', 'x_EMPLOYEE_ID_FROM', 'EMPLOYEE_ID_FROM', '[EMPLOYEE_ID_FROM]', '[EMPLOYEE_ID_FROM]', 200, 50, -1, false, '[EMPLOYEE_ID_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID_FROM->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID_FROM->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID_FROM'] = &$this->EMPLOYEE_ID_FROM;

        // RESPONSIBLE_ID
        $this->RESPONSIBLE_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_RESPONSIBLE_ID', 'RESPONSIBLE_ID', '[RESPONSIBLE_ID]', 'CAST([RESPONSIBLE_ID] AS NVARCHAR)', 17, 1, -1, false, '[RESPONSIBLE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONSIBLE_ID->Sortable = true; // Allow sort
        $this->RESPONSIBLE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RESPONSIBLE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONSIBLE_ID->Param, "CustomMsg");
        $this->Fields['RESPONSIBLE_ID'] = &$this->RESPONSIBLE_ID;

        // RESPONSIBLE
        $this->RESPONSIBLE = new DbField('V_FARMASI', 'V_FARMASI', 'x_RESPONSIBLE', 'RESPONSIBLE', '[RESPONSIBLE]', '[RESPONSIBLE]', 200, 150, -1, false, '[RESPONSIBLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONSIBLE->Sortable = true; // Allow sort
        $this->RESPONSIBLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONSIBLE->Param, "CustomMsg");
        $this->Fields['RESPONSIBLE'] = &$this->RESPONSIBLE;

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_FAMILY_STATUS_ID', 'FAMILY_STATUS_ID', '[FAMILY_STATUS_ID]', 'CAST([FAMILY_STATUS_ID] AS NVARCHAR)', 17, 1, -1, false, '[FAMILY_STATUS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAMILY_STATUS_ID->Sortable = true; // Allow sort
        $this->FAMILY_STATUS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FAMILY_STATUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAMILY_STATUS_ID->Param, "CustomMsg");
        $this->Fields['FAMILY_STATUS_ID'] = &$this->FAMILY_STATUS_ID;

        // TICKET_NO
        $this->TICKET_NO = new DbField('V_FARMASI', 'V_FARMASI', 'x_TICKET_NO', 'TICKET_NO', '[TICKET_NO]', 'CAST([TICKET_NO] AS NVARCHAR)', 2, 2, -1, false, '[TICKET_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TICKET_NO->Sortable = true; // Allow sort
        $this->TICKET_NO->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TICKET_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TICKET_NO->Param, "CustomMsg");
        $this->Fields['TICKET_NO'] = &$this->TICKET_NO;

        // ISATTENDED
        $this->ISATTENDED = new DbField('V_FARMASI', 'V_FARMASI', 'x_ISATTENDED', 'ISATTENDED', '[ISATTENDED]', '[ISATTENDED]', 129, 1, -1, false, '[ISATTENDED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISATTENDED->Sortable = true; // Allow sort
        $this->ISATTENDED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISATTENDED->Param, "CustomMsg");
        $this->Fields['ISATTENDED'] = &$this->ISATTENDED;

        // PAYOR_ID
        $this->PAYOR_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_PAYOR_ID', 'PAYOR_ID', '[PAYOR_ID]', '[PAYOR_ID]', 200, 50, -1, false, '[PAYOR_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->PAYOR_ID->Sortable = true; // Allow sort
        $this->PAYOR_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->PAYOR_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->PAYOR_ID->Lookup = new Lookup('PAYOR_ID', 'PAYOR_INFO', false, 'PAYOR_ID', ["PAYOR","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->PAYOR_ID->Lookup = new Lookup('PAYOR_ID', 'PAYOR_INFO', false, 'PAYOR_ID', ["PAYOR","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->PAYOR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ID->Param, "CustomMsg");
        $this->Fields['PAYOR_ID'] = &$this->PAYOR_ID;

        // CLASS_ID
        $this->CLASS_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLASS_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLASS_ID->Lookup = new Lookup('CLASS_ID', 'CLASS2', false, 'CLASS_ID', ["NAME_OF_CLASS","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->CLASS_ID->Lookup = new Lookup('CLASS_ID', 'CLASS2', false, 'CLASS_ID', ["NAME_OF_CLASS","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // ISPERTARIF
        $this->ISPERTARIF = new DbField('V_FARMASI', 'V_FARMASI', 'x_ISPERTARIF', 'ISPERTARIF', '[ISPERTARIF]', '[ISPERTARIF]', 129, 1, -1, false, '[ISPERTARIF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISPERTARIF->Sortable = true; // Allow sort
        $this->ISPERTARIF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISPERTARIF->Param, "CustomMsg");
        $this->Fields['ISPERTARIF'] = &$this->ISPERTARIF;

        // KAL_ID
        $this->KAL_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KAL_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->KAL_ID->Lookup = new Lookup('KAL_ID', 'KALURAHAN', false, 'KAL_ID', ["KALURAHAN","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->KAL_ID->Lookup = new Lookup('KAL_ID', 'KALURAHAN', false, 'KAL_ID', ["KALURAHAN","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // EMPLOYEE_INAP
        $this->EMPLOYEE_INAP = new DbField('V_FARMASI', 'V_FARMASI', 'x_EMPLOYEE_INAP', 'EMPLOYEE_INAP', '[EMPLOYEE_INAP]', '[EMPLOYEE_INAP]', 200, 50, -1, false, '[EMPLOYEE_INAP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_INAP->Sortable = true; // Allow sort
        $this->EMPLOYEE_INAP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_INAP->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_INAP'] = &$this->EMPLOYEE_INAP;

        // PASIEN_ID
        $this->PASIEN_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_PASIEN_ID', 'PASIEN_ID', '[PASIEN_ID]', '[PASIEN_ID]', 200, 30, -1, false, '[PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_ID->Sortable = true; // Allow sort
        $this->PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_ID->Param, "CustomMsg");
        $this->Fields['PASIEN_ID'] = &$this->PASIEN_ID;

        // KARYAWAN
        $this->KARYAWAN = new DbField('V_FARMASI', 'V_FARMASI', 'x_KARYAWAN', 'KARYAWAN', '[KARYAWAN]', '[KARYAWAN]', 200, 50, -1, false, '[KARYAWAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KARYAWAN->Sortable = true; // Allow sort
        $this->KARYAWAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KARYAWAN->Param, "CustomMsg");
        $this->Fields['KARYAWAN'] = &$this->KARYAWAN;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND = new DbField('V_FARMASI', 'V_FARMASI', 'x_CLASS_ID_PLAFOND', 'CLASS_ID_PLAFOND', '[CLASS_ID_PLAFOND]', 'CAST([CLASS_ID_PLAFOND] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID_PLAFOND]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID_PLAFOND->Sortable = true; // Allow sort
        $this->CLASS_ID_PLAFOND->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID_PLAFOND->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID_PLAFOND->Param, "CustomMsg");
        $this->Fields['CLASS_ID_PLAFOND'] = &$this->CLASS_ID_PLAFOND;

        // BACKCHARGE
        $this->BACKCHARGE = new DbField('V_FARMASI', 'V_FARMASI', 'x_BACKCHARGE', 'BACKCHARGE', '[BACKCHARGE]', '[BACKCHARGE]', 129, 1, -1, false, '[BACKCHARGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BACKCHARGE->Sortable = true; // Allow sort
        $this->BACKCHARGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BACKCHARGE->Param, "CustomMsg");
        $this->Fields['BACKCHARGE'] = &$this->BACKCHARGE;

        // COVERAGE_ID
        $this->COVERAGE_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_COVERAGE_ID', 'COVERAGE_ID', '[COVERAGE_ID]', 'CAST([COVERAGE_ID] AS NVARCHAR)', 17, 1, -1, false, '[COVERAGE_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->COVERAGE_ID->Sortable = true; // Allow sort
        $this->COVERAGE_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->COVERAGE_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->COVERAGE_ID->Lookup = new Lookup('COVERAGE_ID', 'COVERAGE_TYPE', false, 'COVERAGE_ID', ["COVERAGETYPE","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->COVERAGE_ID->Lookup = new Lookup('COVERAGE_ID', 'COVERAGE_TYPE', false, 'COVERAGE_ID', ["COVERAGETYPE","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->COVERAGE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->COVERAGE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COVERAGE_ID->Param, "CustomMsg");
        $this->Fields['COVERAGE_ID'] = &$this->COVERAGE_ID;

        // AGEYEAR
        $this->AGEYEAR = new DbField('V_FARMASI', 'V_FARMASI', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 2, 2, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('V_FARMASI', 'V_FARMASI', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 2, 2, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('V_FARMASI', 'V_FARMASI', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 2, 2, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // RECOMENDATION
        $this->RECOMENDATION = new DbField('V_FARMASI', 'V_FARMASI', 'x_RECOMENDATION', 'RECOMENDATION', '[RECOMENDATION]', '[RECOMENDATION]', 200, 8000, -1, false, '[RECOMENDATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECOMENDATION->Sortable = true; // Allow sort
        $this->RECOMENDATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECOMENDATION->Param, "CustomMsg");
        $this->Fields['RECOMENDATION'] = &$this->RECOMENDATION;

        // CONCLUSION
        $this->CONCLUSION = new DbField('V_FARMASI', 'V_FARMASI', 'x_CONCLUSION', 'CONCLUSION', '[CONCLUSION]', '[CONCLUSION]', 200, 8000, -1, false, '[CONCLUSION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONCLUSION->Sortable = true; // Allow sort
        $this->CONCLUSION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONCLUSION->Param, "CustomMsg");
        $this->Fields['CONCLUSION'] = &$this->CONCLUSION;

        // SPECIMENNO
        $this->SPECIMENNO = new DbField('V_FARMASI', 'V_FARMASI', 'x_SPECIMENNO', 'SPECIMENNO', '[SPECIMENNO]', '[SPECIMENNO]', 200, 50, -1, false, '[SPECIMENNO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPECIMENNO->Sortable = true; // Allow sort
        $this->SPECIMENNO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPECIMENNO->Param, "CustomMsg");
        $this->Fields['SPECIMENNO'] = &$this->SPECIMENNO;

        // LOCKED
        $this->LOCKED = new DbField('V_FARMASI', 'V_FARMASI', 'x_LOCKED', 'LOCKED', '[LOCKED]', '[LOCKED]', 200, 1, -1, false, '[LOCKED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LOCKED->Sortable = true; // Allow sort
        $this->LOCKED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LOCKED->Param, "CustomMsg");
        $this->Fields['LOCKED'] = &$this->LOCKED;

        // RM_OUT_DATE
        $this->RM_OUT_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_RM_OUT_DATE', 'RM_OUT_DATE', '[RM_OUT_DATE]', CastDateFieldForLike("[RM_OUT_DATE]", 0, "DB"), 135, 8, 0, false, '[RM_OUT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RM_OUT_DATE->Sortable = true; // Allow sort
        $this->RM_OUT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RM_OUT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RM_OUT_DATE->Param, "CustomMsg");
        $this->Fields['RM_OUT_DATE'] = &$this->RM_OUT_DATE;

        // RM_IN_DATE
        $this->RM_IN_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_RM_IN_DATE', 'RM_IN_DATE', '[RM_IN_DATE]', CastDateFieldForLike("[RM_IN_DATE]", 0, "DB"), 135, 8, 0, false, '[RM_IN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RM_IN_DATE->Sortable = true; // Allow sort
        $this->RM_IN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RM_IN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RM_IN_DATE->Param, "CustomMsg");
        $this->Fields['RM_IN_DATE'] = &$this->RM_IN_DATE;

        // LAMA_PINJAM
        $this->LAMA_PINJAM = new DbField('V_FARMASI', 'V_FARMASI', 'x_LAMA_PINJAM', 'LAMA_PINJAM', '[LAMA_PINJAM]', CastDateFieldForLike("[LAMA_PINJAM]", 0, "DB"), 135, 8, 0, false, '[LAMA_PINJAM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LAMA_PINJAM->Sortable = true; // Allow sort
        $this->LAMA_PINJAM->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->LAMA_PINJAM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LAMA_PINJAM->Param, "CustomMsg");
        $this->Fields['LAMA_PINJAM'] = &$this->LAMA_PINJAM;

        // STANDAR_RJ
        $this->STANDAR_RJ = new DbField('V_FARMASI', 'V_FARMASI', 'x_STANDAR_RJ', 'STANDAR_RJ', '[STANDAR_RJ]', '[STANDAR_RJ]', 129, 1, -1, false, '[STANDAR_RJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STANDAR_RJ->Sortable = true; // Allow sort
        $this->STANDAR_RJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STANDAR_RJ->Param, "CustomMsg");
        $this->Fields['STANDAR_RJ'] = &$this->STANDAR_RJ;

        // LENGKAP_RJ
        $this->LENGKAP_RJ = new DbField('V_FARMASI', 'V_FARMASI', 'x_LENGKAP_RJ', 'LENGKAP_RJ', '[LENGKAP_RJ]', '[LENGKAP_RJ]', 129, 1, -1, false, '[LENGKAP_RJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_RJ->Sortable = true; // Allow sort
        $this->LENGKAP_RJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_RJ->Param, "CustomMsg");
        $this->Fields['LENGKAP_RJ'] = &$this->LENGKAP_RJ;

        // LENGKAP_RI
        $this->LENGKAP_RI = new DbField('V_FARMASI', 'V_FARMASI', 'x_LENGKAP_RI', 'LENGKAP_RI', '[LENGKAP_RI]', '[LENGKAP_RI]', 129, 1, -1, false, '[LENGKAP_RI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_RI->Sortable = true; // Allow sort
        $this->LENGKAP_RI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_RI->Param, "CustomMsg");
        $this->Fields['LENGKAP_RI'] = &$this->LENGKAP_RI;

        // RESEND_RM_DATE
        $this->RESEND_RM_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_RESEND_RM_DATE', 'RESEND_RM_DATE', '[RESEND_RM_DATE]', CastDateFieldForLike("[RESEND_RM_DATE]", 0, "DB"), 135, 8, 0, false, '[RESEND_RM_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESEND_RM_DATE->Sortable = true; // Allow sort
        $this->RESEND_RM_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RESEND_RM_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESEND_RM_DATE->Param, "CustomMsg");
        $this->Fields['RESEND_RM_DATE'] = &$this->RESEND_RM_DATE;

        // LENGKAP_RM1
        $this->LENGKAP_RM1 = new DbField('V_FARMASI', 'V_FARMASI', 'x_LENGKAP_RM1', 'LENGKAP_RM1', '[LENGKAP_RM1]', '[LENGKAP_RM1]', 129, 1, -1, false, '[LENGKAP_RM1]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_RM1->Sortable = true; // Allow sort
        $this->LENGKAP_RM1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_RM1->Param, "CustomMsg");
        $this->Fields['LENGKAP_RM1'] = &$this->LENGKAP_RM1;

        // LENGKAP_RESUME
        $this->LENGKAP_RESUME = new DbField('V_FARMASI', 'V_FARMASI', 'x_LENGKAP_RESUME', 'LENGKAP_RESUME', '[LENGKAP_RESUME]', '[LENGKAP_RESUME]', 129, 1, -1, false, '[LENGKAP_RESUME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_RESUME->Sortable = true; // Allow sort
        $this->LENGKAP_RESUME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_RESUME->Param, "CustomMsg");
        $this->Fields['LENGKAP_RESUME'] = &$this->LENGKAP_RESUME;

        // LENGKAP_ANAMNESIS
        $this->LENGKAP_ANAMNESIS = new DbField('V_FARMASI', 'V_FARMASI', 'x_LENGKAP_ANAMNESIS', 'LENGKAP_ANAMNESIS', '[LENGKAP_ANAMNESIS]', '[LENGKAP_ANAMNESIS]', 129, 1, -1, false, '[LENGKAP_ANAMNESIS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_ANAMNESIS->Sortable = true; // Allow sort
        $this->LENGKAP_ANAMNESIS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_ANAMNESIS->Param, "CustomMsg");
        $this->Fields['LENGKAP_ANAMNESIS'] = &$this->LENGKAP_ANAMNESIS;

        // LENGKAP_CONSENT
        $this->LENGKAP_CONSENT = new DbField('V_FARMASI', 'V_FARMASI', 'x_LENGKAP_CONSENT', 'LENGKAP_CONSENT', '[LENGKAP_CONSENT]', '[LENGKAP_CONSENT]', 129, 1, -1, false, '[LENGKAP_CONSENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_CONSENT->Sortable = true; // Allow sort
        $this->LENGKAP_CONSENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_CONSENT->Param, "CustomMsg");
        $this->Fields['LENGKAP_CONSENT'] = &$this->LENGKAP_CONSENT;

        // LENGKAP_ANESTESI
        $this->LENGKAP_ANESTESI = new DbField('V_FARMASI', 'V_FARMASI', 'x_LENGKAP_ANESTESI', 'LENGKAP_ANESTESI', '[LENGKAP_ANESTESI]', '[LENGKAP_ANESTESI]', 129, 1, -1, false, '[LENGKAP_ANESTESI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_ANESTESI->Sortable = true; // Allow sort
        $this->LENGKAP_ANESTESI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_ANESTESI->Param, "CustomMsg");
        $this->Fields['LENGKAP_ANESTESI'] = &$this->LENGKAP_ANESTESI;

        // LENGKAP_OP
        $this->LENGKAP_OP = new DbField('V_FARMASI', 'V_FARMASI', 'x_LENGKAP_OP', 'LENGKAP_OP', '[LENGKAP_OP]', '[LENGKAP_OP]', 129, 1, -1, false, '[LENGKAP_OP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LENGKAP_OP->Sortable = true; // Allow sort
        $this->LENGKAP_OP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LENGKAP_OP->Param, "CustomMsg");
        $this->Fields['LENGKAP_OP'] = &$this->LENGKAP_OP;

        // BACK_RM_DATE
        $this->BACK_RM_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_BACK_RM_DATE', 'BACK_RM_DATE', '[BACK_RM_DATE]', CastDateFieldForLike("[BACK_RM_DATE]", 0, "DB"), 135, 8, 0, false, '[BACK_RM_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BACK_RM_DATE->Sortable = true; // Allow sort
        $this->BACK_RM_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->BACK_RM_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BACK_RM_DATE->Param, "CustomMsg");
        $this->Fields['BACK_RM_DATE'] = &$this->BACK_RM_DATE;

        // VALID_RM_DATE
        $this->VALID_RM_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_VALID_RM_DATE', 'VALID_RM_DATE', '[VALID_RM_DATE]', CastDateFieldForLike("[VALID_RM_DATE]", 0, "DB"), 135, 8, 0, false, '[VALID_RM_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VALID_RM_DATE->Sortable = true; // Allow sort
        $this->VALID_RM_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VALID_RM_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VALID_RM_DATE->Param, "CustomMsg");
        $this->Fields['VALID_RM_DATE'] = &$this->VALID_RM_DATE;

        // NO_SKP
        $this->NO_SKP = new DbField('V_FARMASI', 'V_FARMASI', 'x_NO_SKP', 'NO_SKP', '[NO_SKP]', '[NO_SKP]', 200, 50, -1, false, '[NO_SKP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_SKP->Sortable = true; // Allow sort
        $this->NO_SKP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_SKP->Param, "CustomMsg");
        $this->Fields['NO_SKP'] = &$this->NO_SKP;

        // NO_SKPINAP
        $this->NO_SKPINAP = new DbField('V_FARMASI', 'V_FARMASI', 'x_NO_SKPINAP', 'NO_SKPINAP', '[NO_SKPINAP]', '[NO_SKPINAP]', 200, 50, -1, false, '[NO_SKPINAP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_SKPINAP->Sortable = true; // Allow sort
        $this->NO_SKPINAP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_SKPINAP->Param, "CustomMsg");
        $this->Fields['NO_SKPINAP'] = &$this->NO_SKPINAP;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 10, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAGNOSA_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAGNOSA_ID->Lookup = new Lookup('DIAGNOSA_ID', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["NAME_OF_DIAGNOSA","DIAGNOSA_ID","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAGNOSA_ID->Lookup = new Lookup('DIAGNOSA_ID', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["NAME_OF_DIAGNOSA","DIAGNOSA_ID","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // ticket_all
        $this->ticket_all = new DbField('V_FARMASI', 'V_FARMASI', 'x_ticket_all', 'ticket_all', '[ticket_all]', 'CAST([ticket_all] AS NVARCHAR)', 20, 8, -1, false, '[ticket_all]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ticket_all->Sortable = true; // Allow sort
        $this->ticket_all->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ticket_all->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ticket_all->Param, "CustomMsg");
        $this->Fields['ticket_all'] = &$this->ticket_all;

        // tanggal_rujukan
        $this->tanggal_rujukan = new DbField('V_FARMASI', 'V_FARMASI', 'x_tanggal_rujukan', 'tanggal_rujukan', '[tanggal_rujukan]', CastDateFieldForLike("[tanggal_rujukan]", 0, "DB"), 135, 8, 0, false, '[tanggal_rujukan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_rujukan->Sortable = true; // Allow sort
        $this->tanggal_rujukan->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_rujukan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_rujukan->Param, "CustomMsg");
        $this->Fields['tanggal_rujukan'] = &$this->tanggal_rujukan;

        // ISRJ
        $this->ISRJ = new DbField('V_FARMASI', 'V_FARMASI', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->ISRJ->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->ISRJ->Lookup = new Lookup('ISRJ', 'CARA_KELUAR', false, 'KELUAR_ID', ["CARA_KELUAR","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ISRJ->Lookup = new Lookup('ISRJ', 'CARA_KELUAR', false, 'KELUAR_ID', ["CARA_KELUAR","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // NORUJUKAN
        $this->NORUJUKAN = new DbField('V_FARMASI', 'V_FARMASI', 'x_NORUJUKAN', 'NORUJUKAN', '[NORUJUKAN]', '[NORUJUKAN]', 200, 50, -1, false, '[NORUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NORUJUKAN->Sortable = true; // Allow sort
        $this->NORUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NORUJUKAN->Param, "CustomMsg");
        $this->Fields['NORUJUKAN'] = &$this->NORUJUKAN;

        // PPKRUJUKAN
        $this->PPKRUJUKAN = new DbField('V_FARMASI', 'V_FARMASI', 'x_PPKRUJUKAN', 'PPKRUJUKAN', '[PPKRUJUKAN]', '[PPKRUJUKAN]', 200, 50, -1, false, '[PPKRUJUKAN]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->PPKRUJUKAN->Sortable = true; // Allow sort
        $this->PPKRUJUKAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->PPKRUJUKAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->PPKRUJUKAN->Lookup = new Lookup('PPKRUJUKAN', 'INASIS_GET_FASKES', false, 'KDPROVIDER', ["NMPROVIDER","KDPROVIDER","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->PPKRUJUKAN->Lookup = new Lookup('PPKRUJUKAN', 'INASIS_GET_FASKES', false, 'KDPROVIDER', ["NMPROVIDER","KDPROVIDER","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->PPKRUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PPKRUJUKAN->Param, "CustomMsg");
        $this->Fields['PPKRUJUKAN'] = &$this->PPKRUJUKAN;

        // LOKASILAKA
        $this->LOKASILAKA = new DbField('V_FARMASI', 'V_FARMASI', 'x_LOKASILAKA', 'LOKASILAKA', '[LOKASILAKA]', '[LOKASILAKA]', 200, 50, -1, false, '[LOKASILAKA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LOKASILAKA->Sortable = true; // Allow sort
        $this->LOKASILAKA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LOKASILAKA->Param, "CustomMsg");
        $this->Fields['LOKASILAKA'] = &$this->LOKASILAKA;

        // KDPOLI
        $this->KDPOLI = new DbField('V_FARMASI', 'V_FARMASI', 'x_KDPOLI', 'KDPOLI', '[KDPOLI]', '[KDPOLI]', 200, 3, -1, false, '[KDPOLI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDPOLI->Sortable = true; // Allow sort
        $this->KDPOLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDPOLI->Param, "CustomMsg");
        $this->Fields['KDPOLI'] = &$this->KDPOLI;

        // EDIT_SEP
        $this->EDIT_SEP = new DbField('V_FARMASI', 'V_FARMASI', 'x_EDIT_SEP', 'EDIT_SEP', '[EDIT_SEP]', '[EDIT_SEP]', 200, 250, -1, false, '[EDIT_SEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EDIT_SEP->Sortable = true; // Allow sort
        $this->EDIT_SEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EDIT_SEP->Param, "CustomMsg");
        $this->Fields['EDIT_SEP'] = &$this->EDIT_SEP;

        // DELETE_SEP
        $this->DELETE_SEP = new DbField('V_FARMASI', 'V_FARMASI', 'x_DELETE_SEP', 'DELETE_SEP', '[DELETE_SEP]', '[DELETE_SEP]', 200, 250, -1, false, '[DELETE_SEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DELETE_SEP->Sortable = true; // Allow sort
        $this->DELETE_SEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DELETE_SEP->Param, "CustomMsg");
        $this->Fields['DELETE_SEP'] = &$this->DELETE_SEP;

        // KODE_AGAMA
        $this->KODE_AGAMA = new DbField('V_FARMASI', 'V_FARMASI', 'x_KODE_AGAMA', 'KODE_AGAMA', '[KODE_AGAMA]', 'CAST([KODE_AGAMA] AS NVARCHAR)', 17, 1, -1, false, '[KODE_AGAMA]', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->KODE_AGAMA->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->KODE_AGAMA->Lookup = new Lookup('KODE_AGAMA', 'AGAMA', false, 'KODE_AGAMA', ["NAMA_AGAMA","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->KODE_AGAMA->Lookup = new Lookup('KODE_AGAMA', 'AGAMA', false, 'KODE_AGAMA', ["NAMA_AGAMA","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->KODE_AGAMA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KODE_AGAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE_AGAMA->Param, "CustomMsg");
        $this->Fields['KODE_AGAMA'] = &$this->KODE_AGAMA;

        // DIAG_AWAL
        $this->DIAG_AWAL = new DbField('V_FARMASI', 'V_FARMASI', 'x_DIAG_AWAL', 'DIAG_AWAL', '[DIAG_AWAL]', '[DIAG_AWAL]', 200, 10, -1, false, '[DIAG_AWAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAG_AWAL->Sortable = true; // Allow sort
        $this->DIAG_AWAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAG_AWAL->Param, "CustomMsg");
        $this->Fields['DIAG_AWAL'] = &$this->DIAG_AWAL;

        // AKTIF
        $this->AKTIF = new DbField('V_FARMASI', 'V_FARMASI', 'x_AKTIF', 'AKTIF', '[AKTIF]', '[AKTIF]', 200, 2, -1, false, '[AKTIF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AKTIF->Sortable = true; // Allow sort
        $this->AKTIF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AKTIF->Param, "CustomMsg");
        $this->Fields['AKTIF'] = &$this->AKTIF;

        // BILL_INAP
        $this->BILL_INAP = new DbField('V_FARMASI', 'V_FARMASI', 'x_BILL_INAP', 'BILL_INAP', '[BILL_INAP]', '[BILL_INAP]', 200, 50, -1, false, '[BILL_INAP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_INAP->Sortable = true; // Allow sort
        $this->BILL_INAP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_INAP->Param, "CustomMsg");
        $this->Fields['BILL_INAP'] = &$this->BILL_INAP;

        // SEP_PRINTDATE
        $this->SEP_PRINTDATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_SEP_PRINTDATE', 'SEP_PRINTDATE', '[SEP_PRINTDATE]', CastDateFieldForLike("[SEP_PRINTDATE]", 0, "DB"), 135, 8, 0, false, '[SEP_PRINTDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SEP_PRINTDATE->Sortable = true; // Allow sort
        $this->SEP_PRINTDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SEP_PRINTDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEP_PRINTDATE->Param, "CustomMsg");
        $this->Fields['SEP_PRINTDATE'] = &$this->SEP_PRINTDATE;

        // MAPPING_SEP
        $this->MAPPING_SEP = new DbField('V_FARMASI', 'V_FARMASI', 'x_MAPPING_SEP', 'MAPPING_SEP', '[MAPPING_SEP]', '[MAPPING_SEP]', 200, 250, -1, false, '[MAPPING_SEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MAPPING_SEP->Sortable = true; // Allow sort
        $this->MAPPING_SEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MAPPING_SEP->Param, "CustomMsg");
        $this->Fields['MAPPING_SEP'] = &$this->MAPPING_SEP;

        // TRANS_ID
        $this->TRANS_ID = new DbField('V_FARMASI', 'V_FARMASI', 'x_TRANS_ID', 'TRANS_ID', '[TRANS_ID]', '[TRANS_ID]', 200, 50, -1, false, '[TRANS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TRANS_ID->Sortable = true; // Allow sort
        $this->TRANS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TRANS_ID->Param, "CustomMsg");
        $this->Fields['TRANS_ID'] = &$this->TRANS_ID;

        // KDPOLI_EKS
        $this->KDPOLI_EKS = new DbField('V_FARMASI', 'V_FARMASI', 'x_KDPOLI_EKS', 'KDPOLI_EKS', '[KDPOLI_EKS]', '[KDPOLI_EKS]', 129, 1, -1, false, '[KDPOLI_EKS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDPOLI_EKS->Sortable = true; // Allow sort
        $this->KDPOLI_EKS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDPOLI_EKS->Param, "CustomMsg");
        $this->Fields['KDPOLI_EKS'] = &$this->KDPOLI_EKS;

        // COB
        $this->COB = new DbField('V_FARMASI', 'V_FARMASI', 'x_COB', 'COB', '[COB]', '[COB]', 129, 1, -1, false, '[COB]', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->COB->Sortable = true; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->COB->Lookup = new Lookup('COB', 'V_FARMASI', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->COB->Lookup = new Lookup('COB', 'V_FARMASI', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->COB->OptionCount = 2;
        $this->COB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COB->Param, "CustomMsg");
        $this->Fields['COB'] = &$this->COB;

        // PENJAMIN
        $this->PENJAMIN = new DbField('V_FARMASI', 'V_FARMASI', 'x_PENJAMIN', 'PENJAMIN', '[PENJAMIN]', '[PENJAMIN]', 200, 25, -1, false, '[PENJAMIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PENJAMIN->Sortable = true; // Allow sort
        $this->PENJAMIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PENJAMIN->Param, "CustomMsg");
        $this->Fields['PENJAMIN'] = &$this->PENJAMIN;

        // ASALRUJUKAN
        $this->ASALRUJUKAN = new DbField('V_FARMASI', 'V_FARMASI', 'x_ASALRUJUKAN', 'ASALRUJUKAN', '[ASALRUJUKAN]', '[ASALRUJUKAN]', 129, 1, -1, false, '[ASALRUJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ASALRUJUKAN->Sortable = true; // Allow sort
        $this->ASALRUJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ASALRUJUKAN->Param, "CustomMsg");
        $this->Fields['ASALRUJUKAN'] = &$this->ASALRUJUKAN;

        // RESPONSEP
        $this->RESPONSEP = new DbField('V_FARMASI', 'V_FARMASI', 'x_RESPONSEP', 'RESPONSEP', '[RESPONSEP]', '[RESPONSEP]', 200, 0, -1, false, '[RESPONSEP]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONSEP->Sortable = true; // Allow sort
        $this->RESPONSEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONSEP->Param, "CustomMsg");
        $this->Fields['RESPONSEP'] = &$this->RESPONSEP;

        // APPROVAL_DESC
        $this->APPROVAL_DESC = new DbField('V_FARMASI', 'V_FARMASI', 'x_APPROVAL_DESC', 'APPROVAL_DESC', '[APPROVAL_DESC]', '[APPROVAL_DESC]', 200, 250, -1, false, '[APPROVAL_DESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVAL_DESC->Sortable = true; // Allow sort
        $this->APPROVAL_DESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVAL_DESC->Param, "CustomMsg");
        $this->Fields['APPROVAL_DESC'] = &$this->APPROVAL_DESC;

        // APPROVAL_RESPONAJUKAN
        $this->APPROVAL_RESPONAJUKAN = new DbField('V_FARMASI', 'V_FARMASI', 'x_APPROVAL_RESPONAJUKAN', 'APPROVAL_RESPONAJUKAN', '[APPROVAL_RESPONAJUKAN]', '[APPROVAL_RESPONAJUKAN]', 200, 250, -1, false, '[APPROVAL_RESPONAJUKAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVAL_RESPONAJUKAN->Sortable = true; // Allow sort
        $this->APPROVAL_RESPONAJUKAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVAL_RESPONAJUKAN->Param, "CustomMsg");
        $this->Fields['APPROVAL_RESPONAJUKAN'] = &$this->APPROVAL_RESPONAJUKAN;

        // APPROVAL_RESPONAPPROV
        $this->APPROVAL_RESPONAPPROV = new DbField('V_FARMASI', 'V_FARMASI', 'x_APPROVAL_RESPONAPPROV', 'APPROVAL_RESPONAPPROV', '[APPROVAL_RESPONAPPROV]', '[APPROVAL_RESPONAPPROV]', 200, 250, -1, false, '[APPROVAL_RESPONAPPROV]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APPROVAL_RESPONAPPROV->Sortable = true; // Allow sort
        $this->APPROVAL_RESPONAPPROV->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APPROVAL_RESPONAPPROV->Param, "CustomMsg");
        $this->Fields['APPROVAL_RESPONAPPROV'] = &$this->APPROVAL_RESPONAPPROV;

        // RESPONTGLPLG_DESC
        $this->RESPONTGLPLG_DESC = new DbField('V_FARMASI', 'V_FARMASI', 'x_RESPONTGLPLG_DESC', 'RESPONTGLPLG_DESC', '[RESPONTGLPLG_DESC]', '[RESPONTGLPLG_DESC]', 200, 250, -1, false, '[RESPONTGLPLG_DESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONTGLPLG_DESC->Sortable = true; // Allow sort
        $this->RESPONTGLPLG_DESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONTGLPLG_DESC->Param, "CustomMsg");
        $this->Fields['RESPONTGLPLG_DESC'] = &$this->RESPONTGLPLG_DESC;

        // RESPONPOST_VKLAIM
        $this->RESPONPOST_VKLAIM = new DbField('V_FARMASI', 'V_FARMASI', 'x_RESPONPOST_VKLAIM', 'RESPONPOST_VKLAIM', '[RESPONPOST_VKLAIM]', '[RESPONPOST_VKLAIM]', 200, 0, -1, false, '[RESPONPOST_VKLAIM]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONPOST_VKLAIM->Sortable = true; // Allow sort
        $this->RESPONPOST_VKLAIM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONPOST_VKLAIM->Param, "CustomMsg");
        $this->Fields['RESPONPOST_VKLAIM'] = &$this->RESPONPOST_VKLAIM;

        // RESPONPUT_VKLAIM
        $this->RESPONPUT_VKLAIM = new DbField('V_FARMASI', 'V_FARMASI', 'x_RESPONPUT_VKLAIM', 'RESPONPUT_VKLAIM', '[RESPONPUT_VKLAIM]', '[RESPONPUT_VKLAIM]', 200, 0, -1, false, '[RESPONPUT_VKLAIM]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONPUT_VKLAIM->Sortable = true; // Allow sort
        $this->RESPONPUT_VKLAIM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONPUT_VKLAIM->Param, "CustomMsg");
        $this->Fields['RESPONPUT_VKLAIM'] = &$this->RESPONPUT_VKLAIM;

        // RESPONDEL_VKLAIM
        $this->RESPONDEL_VKLAIM = new DbField('V_FARMASI', 'V_FARMASI', 'x_RESPONDEL_VKLAIM', 'RESPONDEL_VKLAIM', '[RESPONDEL_VKLAIM]', '[RESPONDEL_VKLAIM]', 200, 0, -1, false, '[RESPONDEL_VKLAIM]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONDEL_VKLAIM->Sortable = true; // Allow sort
        $this->RESPONDEL_VKLAIM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONDEL_VKLAIM->Param, "CustomMsg");
        $this->Fields['RESPONDEL_VKLAIM'] = &$this->RESPONDEL_VKLAIM;

        // CALL_TIMES
        $this->CALL_TIMES = new DbField('V_FARMASI', 'V_FARMASI', 'x_CALL_TIMES', 'CALL_TIMES', '[CALL_TIMES]', 'CAST([CALL_TIMES] AS NVARCHAR)', 3, 4, -1, false, '[CALL_TIMES]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CALL_TIMES->Sortable = true; // Allow sort
        $this->CALL_TIMES->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CALL_TIMES->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CALL_TIMES->Param, "CustomMsg");
        $this->Fields['CALL_TIMES'] = &$this->CALL_TIMES;

        // CALL_DATE
        $this->CALL_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_CALL_DATE', 'CALL_DATE', '[CALL_DATE]', CastDateFieldForLike("[CALL_DATE]", 0, "DB"), 135, 8, 0, false, '[CALL_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CALL_DATE->Sortable = true; // Allow sort
        $this->CALL_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->CALL_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CALL_DATE->Param, "CustomMsg");
        $this->Fields['CALL_DATE'] = &$this->CALL_DATE;

        // CALL_DATES
        $this->CALL_DATES = new DbField('V_FARMASI', 'V_FARMASI', 'x_CALL_DATES', 'CALL_DATES', '[CALL_DATES]', CastDateFieldForLike("[CALL_DATES]", 0, "DB"), 135, 8, 0, false, '[CALL_DATES]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CALL_DATES->Sortable = true; // Allow sort
        $this->CALL_DATES->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->CALL_DATES->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CALL_DATES->Param, "CustomMsg");
        $this->Fields['CALL_DATES'] = &$this->CALL_DATES;

        // SERVED_DATE
        $this->SERVED_DATE = new DbField('V_FARMASI', 'V_FARMASI', 'x_SERVED_DATE', 'SERVED_DATE', '[SERVED_DATE]', CastDateFieldForLike("[SERVED_DATE]", 0, "DB"), 135, 8, 0, false, '[SERVED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SERVED_DATE->Sortable = true; // Allow sort
        $this->SERVED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SERVED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SERVED_DATE->Param, "CustomMsg");
        $this->Fields['SERVED_DATE'] = &$this->SERVED_DATE;

        // SERVED_INAP
        $this->SERVED_INAP = new DbField('V_FARMASI', 'V_FARMASI', 'x_SERVED_INAP', 'SERVED_INAP', '[SERVED_INAP]', CastDateFieldForLike("[SERVED_INAP]", 0, "DB"), 135, 8, 0, false, '[SERVED_INAP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SERVED_INAP->Sortable = true; // Allow sort
        $this->SERVED_INAP->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SERVED_INAP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SERVED_INAP->Param, "CustomMsg");
        $this->Fields['SERVED_INAP'] = &$this->SERVED_INAP;

        // KDDPJP1
        $this->KDDPJP1 = new DbField('V_FARMASI', 'V_FARMASI', 'x_KDDPJP1', 'KDDPJP1', '[KDDPJP1]', '[KDDPJP1]', 200, 25, -1, false, '[KDDPJP1]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDDPJP1->Sortable = true; // Allow sort
        $this->KDDPJP1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDDPJP1->Param, "CustomMsg");
        $this->Fields['KDDPJP1'] = &$this->KDDPJP1;

        // KDDPJP
        $this->KDDPJP = new DbField('V_FARMASI', 'V_FARMASI', 'x_KDDPJP', 'KDDPJP', '[KDDPJP]', '[KDDPJP]', 200, 25, -1, false, '[KDDPJP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDDPJP->Sortable = true; // Allow sort
        $this->KDDPJP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDDPJP->Param, "CustomMsg");
        $this->Fields['KDDPJP'] = &$this->KDDPJP;

        // IDXDAFTAR
        $this->IDXDAFTAR = new DbField('V_FARMASI', 'V_FARMASI', 'x_IDXDAFTAR', 'IDXDAFTAR', '[IDXDAFTAR]', 'CAST([IDXDAFTAR] AS NVARCHAR)', 3, 4, -1, false, '[IDXDAFTAR]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->IDXDAFTAR->IsAutoIncrement = true; // Autoincrement field
        $this->IDXDAFTAR->IsPrimaryKey = true; // Primary key field
        $this->IDXDAFTAR->Nullable = false; // NOT NULL field
        $this->IDXDAFTAR->Sortable = true; // Allow sort
        $this->IDXDAFTAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->IDXDAFTAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IDXDAFTAR->Param, "CustomMsg");
        $this->Fields['IDXDAFTAR'] = &$this->IDXDAFTAR;

        // tgl_kontrol
        $this->tgl_kontrol = new DbField('V_FARMASI', 'V_FARMASI', 'x_tgl_kontrol', 'tgl_kontrol', '[tgl_kontrol]', CastDateFieldForLike("[tgl_kontrol]", 0, "DB"), 135, 8, 0, false, '[tgl_kontrol]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl_kontrol->Sortable = true; // Allow sort
        $this->tgl_kontrol->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl_kontrol->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl_kontrol->Param, "CustomMsg");
        $this->Fields['tgl_kontrol'] = &$this->tgl_kontrol;

        // idbooking
        $this->idbooking = new DbField('V_FARMASI', 'V_FARMASI', 'x_idbooking', 'idbooking', '[idbooking]', '[idbooking]', 200, 20, -1, false, '[idbooking]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->idbooking->Sortable = true; // Allow sort
        $this->idbooking->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idbooking->Param, "CustomMsg");
        $this->Fields['idbooking'] = &$this->idbooking;

        // id_tujuan
        $this->id_tujuan = new DbField('V_FARMASI', 'V_FARMASI', 'x_id_tujuan', 'id_tujuan', '[id_tujuan]', 'CAST([id_tujuan] AS NVARCHAR)', 3, 4, -1, false, '[id_tujuan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_tujuan->Sortable = true; // Allow sort
        $this->id_tujuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_tujuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_tujuan->Param, "CustomMsg");
        $this->Fields['id_tujuan'] = &$this->id_tujuan;

        // id_penunjang
        $this->id_penunjang = new DbField('V_FARMASI', 'V_FARMASI', 'x_id_penunjang', 'id_penunjang', '[id_penunjang]', 'CAST([id_penunjang] AS NVARCHAR)', 3, 4, -1, false, '[id_penunjang]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_penunjang->Sortable = true; // Allow sort
        $this->id_penunjang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_penunjang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_penunjang->Param, "CustomMsg");
        $this->Fields['id_penunjang'] = &$this->id_penunjang;

        // id_pembiayaan
        $this->id_pembiayaan = new DbField('V_FARMASI', 'V_FARMASI', 'x_id_pembiayaan', 'id_pembiayaan', '[id_pembiayaan]', 'CAST([id_pembiayaan] AS NVARCHAR)', 3, 4, -1, false, '[id_pembiayaan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_pembiayaan->Sortable = true; // Allow sort
        $this->id_pembiayaan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_pembiayaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_pembiayaan->Param, "CustomMsg");
        $this->Fields['id_pembiayaan'] = &$this->id_pembiayaan;

        // id_procedure
        $this->id_procedure = new DbField('V_FARMASI', 'V_FARMASI', 'x_id_procedure', 'id_procedure', '[id_procedure]', 'CAST([id_procedure] AS NVARCHAR)', 3, 4, -1, false, '[id_procedure]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_procedure->Sortable = true; // Allow sort
        $this->id_procedure->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_procedure->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_procedure->Param, "CustomMsg");
        $this->Fields['id_procedure'] = &$this->id_procedure;

        // id_aspel
        $this->id_aspel = new DbField('V_FARMASI', 'V_FARMASI', 'x_id_aspel', 'id_aspel', '[id_aspel]', 'CAST([id_aspel] AS NVARCHAR)', 3, 4, -1, false, '[id_aspel]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_aspel->Sortable = true; // Allow sort
        $this->id_aspel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_aspel->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_aspel->Param, "CustomMsg");
        $this->Fields['id_aspel'] = &$this->id_aspel;

        // id_kelas
        $this->id_kelas = new DbField('V_FARMASI', 'V_FARMASI', 'x_id_kelas', 'id_kelas', '[id_kelas]', 'CAST([id_kelas] AS NVARCHAR)', 3, 4, -1, false, '[id_kelas]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_kelas->Sortable = true; // Allow sort
        $this->id_kelas->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_kelas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_kelas->Param, "CustomMsg");
        $this->Fields['id_kelas'] = &$this->id_kelas;
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
        if ($this->getCurrentDetailTable() == "TREATMENT_OBAT") {
            $detailUrl = Container("TREATMENT_OBAT")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "TREATMENT_BILL") {
            $detailUrl = Container("TREATMENT_BILL")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_VISIT_ID", $this->VISIT_ID->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "VFarmasiList";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "dbo.PASIEN_VISITATION";
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
            $this->IDXDAFTAR->setDbValue($conn->lastInsertId());
            $rs['IDXDAFTAR'] = $this->IDXDAFTAR->DbValue;
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
            if (array_key_exists('IDXDAFTAR', $rs)) {
                AddFilter($where, QuotedName('IDXDAFTAR', $this->Dbid) . '=' . QuotedValue($rs['IDXDAFTAR'], $this->IDXDAFTAR->DataType, $this->Dbid));
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
        $this->NO_SKPINAP->DbValue = $row['NO_SKPINAP'];
        $this->DIAGNOSA_ID->DbValue = $row['DIAGNOSA_ID'];
        $this->ticket_all->DbValue = $row['ticket_all'];
        $this->tanggal_rujukan->DbValue = $row['tanggal_rujukan'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->NORUJUKAN->DbValue = $row['NORUJUKAN'];
        $this->PPKRUJUKAN->DbValue = $row['PPKRUJUKAN'];
        $this->LOKASILAKA->DbValue = $row['LOKASILAKA'];
        $this->KDPOLI->DbValue = $row['KDPOLI'];
        $this->EDIT_SEP->DbValue = $row['EDIT_SEP'];
        $this->DELETE_SEP->DbValue = $row['DELETE_SEP'];
        $this->KODE_AGAMA->DbValue = $row['KODE_AGAMA'];
        $this->DIAG_AWAL->DbValue = $row['DIAG_AWAL'];
        $this->AKTIF->DbValue = $row['AKTIF'];
        $this->BILL_INAP->DbValue = $row['BILL_INAP'];
        $this->SEP_PRINTDATE->DbValue = $row['SEP_PRINTDATE'];
        $this->MAPPING_SEP->DbValue = $row['MAPPING_SEP'];
        $this->TRANS_ID->DbValue = $row['TRANS_ID'];
        $this->KDPOLI_EKS->DbValue = $row['KDPOLI_EKS'];
        $this->COB->DbValue = $row['COB'];
        $this->PENJAMIN->DbValue = $row['PENJAMIN'];
        $this->ASALRUJUKAN->DbValue = $row['ASALRUJUKAN'];
        $this->RESPONSEP->DbValue = $row['RESPONSEP'];
        $this->APPROVAL_DESC->DbValue = $row['APPROVAL_DESC'];
        $this->APPROVAL_RESPONAJUKAN->DbValue = $row['APPROVAL_RESPONAJUKAN'];
        $this->APPROVAL_RESPONAPPROV->DbValue = $row['APPROVAL_RESPONAPPROV'];
        $this->RESPONTGLPLG_DESC->DbValue = $row['RESPONTGLPLG_DESC'];
        $this->RESPONPOST_VKLAIM->DbValue = $row['RESPONPOST_VKLAIM'];
        $this->RESPONPUT_VKLAIM->DbValue = $row['RESPONPUT_VKLAIM'];
        $this->RESPONDEL_VKLAIM->DbValue = $row['RESPONDEL_VKLAIM'];
        $this->CALL_TIMES->DbValue = $row['CALL_TIMES'];
        $this->CALL_DATE->DbValue = $row['CALL_DATE'];
        $this->CALL_DATES->DbValue = $row['CALL_DATES'];
        $this->SERVED_DATE->DbValue = $row['SERVED_DATE'];
        $this->SERVED_INAP->DbValue = $row['SERVED_INAP'];
        $this->KDDPJP1->DbValue = $row['KDDPJP1'];
        $this->KDDPJP->DbValue = $row['KDDPJP'];
        $this->IDXDAFTAR->DbValue = $row['IDXDAFTAR'];
        $this->tgl_kontrol->DbValue = $row['tgl_kontrol'];
        $this->idbooking->DbValue = $row['idbooking'];
        $this->id_tujuan->DbValue = $row['id_tujuan'];
        $this->id_penunjang->DbValue = $row['id_penunjang'];
        $this->id_pembiayaan->DbValue = $row['id_pembiayaan'];
        $this->id_procedure->DbValue = $row['id_procedure'];
        $this->id_aspel->DbValue = $row['id_aspel'];
        $this->id_kelas->DbValue = $row['id_kelas'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[IDXDAFTAR] = @IDXDAFTAR@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->IDXDAFTAR->CurrentValue : $this->IDXDAFTAR->OldValue;
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
                $this->IDXDAFTAR->CurrentValue = $keys[0];
            } else {
                $this->IDXDAFTAR->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('IDXDAFTAR', $row) ? $row['IDXDAFTAR'] : null;
        } else {
            $val = $this->IDXDAFTAR->OldValue !== null ? $this->IDXDAFTAR->OldValue : $this->IDXDAFTAR->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@IDXDAFTAR@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("VFarmasiList");
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
        if ($pageName == "VFarmasiView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VFarmasiEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VFarmasiAdd") {
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
                return "VFarmasiView";
            case Config("API_ADD_ACTION"):
                return "VFarmasiAdd";
            case Config("API_EDIT_ACTION"):
                return "VFarmasiEdit";
            case Config("API_DELETE_ACTION"):
                return "VFarmasiDelete";
            case Config("API_LIST_ACTION"):
                return "VFarmasiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VFarmasiList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VFarmasiView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VFarmasiView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VFarmasiAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VFarmasiAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VFarmasiEdit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VFarmasiEdit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
            $url = $this->keyUrl("VFarmasiAdd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VFarmasiAdd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
        return $this->keyUrl("VFarmasiDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "IDXDAFTAR:" . JsonEncode($this->IDXDAFTAR->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->IDXDAFTAR->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->IDXDAFTAR->CurrentValue);
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
            if (($keyValue = Param("IDXDAFTAR") ?? Route("IDXDAFTAR")) !== null) {
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
                $this->IDXDAFTAR->CurrentValue = $key;
            } else {
                $this->IDXDAFTAR->OldValue = $key;
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
        $this->NO_SKPINAP->setDbValue($row['NO_SKPINAP']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->ticket_all->setDbValue($row['ticket_all']);
        $this->tanggal_rujukan->setDbValue($row['tanggal_rujukan']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->NORUJUKAN->setDbValue($row['NORUJUKAN']);
        $this->PPKRUJUKAN->setDbValue($row['PPKRUJUKAN']);
        $this->LOKASILAKA->setDbValue($row['LOKASILAKA']);
        $this->KDPOLI->setDbValue($row['KDPOLI']);
        $this->EDIT_SEP->setDbValue($row['EDIT_SEP']);
        $this->DELETE_SEP->setDbValue($row['DELETE_SEP']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->DIAG_AWAL->setDbValue($row['DIAG_AWAL']);
        $this->AKTIF->setDbValue($row['AKTIF']);
        $this->BILL_INAP->setDbValue($row['BILL_INAP']);
        $this->SEP_PRINTDATE->setDbValue($row['SEP_PRINTDATE']);
        $this->MAPPING_SEP->setDbValue($row['MAPPING_SEP']);
        $this->TRANS_ID->setDbValue($row['TRANS_ID']);
        $this->KDPOLI_EKS->setDbValue($row['KDPOLI_EKS']);
        $this->COB->setDbValue($row['COB']);
        $this->PENJAMIN->setDbValue($row['PENJAMIN']);
        $this->ASALRUJUKAN->setDbValue($row['ASALRUJUKAN']);
        $this->RESPONSEP->setDbValue($row['RESPONSEP']);
        $this->APPROVAL_DESC->setDbValue($row['APPROVAL_DESC']);
        $this->APPROVAL_RESPONAJUKAN->setDbValue($row['APPROVAL_RESPONAJUKAN']);
        $this->APPROVAL_RESPONAPPROV->setDbValue($row['APPROVAL_RESPONAPPROV']);
        $this->RESPONTGLPLG_DESC->setDbValue($row['RESPONTGLPLG_DESC']);
        $this->RESPONPOST_VKLAIM->setDbValue($row['RESPONPOST_VKLAIM']);
        $this->RESPONPUT_VKLAIM->setDbValue($row['RESPONPUT_VKLAIM']);
        $this->RESPONDEL_VKLAIM->setDbValue($row['RESPONDEL_VKLAIM']);
        $this->CALL_TIMES->setDbValue($row['CALL_TIMES']);
        $this->CALL_DATE->setDbValue($row['CALL_DATE']);
        $this->CALL_DATES->setDbValue($row['CALL_DATES']);
        $this->SERVED_DATE->setDbValue($row['SERVED_DATE']);
        $this->SERVED_INAP->setDbValue($row['SERVED_INAP']);
        $this->KDDPJP1->setDbValue($row['KDDPJP1']);
        $this->KDDPJP->setDbValue($row['KDDPJP']);
        $this->IDXDAFTAR->setDbValue($row['IDXDAFTAR']);
        $this->tgl_kontrol->setDbValue($row['tgl_kontrol']);
        $this->idbooking->setDbValue($row['idbooking']);
        $this->id_tujuan->setDbValue($row['id_tujuan']);
        $this->id_penunjang->setDbValue($row['id_penunjang']);
        $this->id_pembiayaan->setDbValue($row['id_pembiayaan']);
        $this->id_procedure->setDbValue($row['id_procedure']);
        $this->id_aspel->setDbValue($row['id_aspel']);
        $this->id_kelas->setDbValue($row['id_kelas']);
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

        // NO_REGISTRATION
        $this->NO_REGISTRATION->CellCssStyle = "white-space: nowrap;";

        // VISIT_ID
        $this->VISIT_ID->CellCssStyle = "white-space: nowrap;";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // RUJUKAN_ID
        $this->RUJUKAN_ID->CellCssStyle = "white-space: nowrap;";

        // ADDRESS_OF_RUJUKAN
        $this->ADDRESS_OF_RUJUKAN->CellCssStyle = "white-space: nowrap;";

        // REASON_ID
        $this->REASON_ID->CellCssStyle = "white-space: nowrap;";

        // WAY_ID
        $this->WAY_ID->CellCssStyle = "white-space: nowrap;";

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->CellCssStyle = "white-space: nowrap;";

        // BOOKED_DATE
        $this->BOOKED_DATE->CellCssStyle = "white-space: nowrap;";

        // VISIT_DATE
        $this->VISIT_DATE->CellCssStyle = "white-space: nowrap;";

        // ISNEW
        $this->ISNEW->CellCssStyle = "white-space: nowrap;";

        // FOLLOW_UP
        $this->FOLLOW_UP->CellCssStyle = "white-space: nowrap;";

        // PLACE_TYPE
        $this->PLACE_TYPE->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID
        $this->CLINIC_ID->CellCssStyle = "white-space: nowrap;";

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->CellCssStyle = "white-space: nowrap;";

        // BED_ID
        $this->BED_ID->CellCssStyle = "white-space: nowrap;";

        // KELUAR_ID
        $this->KELUAR_ID->CellCssStyle = "white-space: nowrap;";

        // IN_DATE
        $this->IN_DATE->CellCssStyle = "white-space: nowrap;";

        // EXIT_DATE
        $this->EXIT_DATE->CellCssStyle = "white-space: nowrap;";

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // VISITOR_ADDRESS
        $this->VISITOR_ADDRESS->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID_FROM
        $this->EMPLOYEE_ID_FROM->CellCssStyle = "white-space: nowrap;";

        // RESPONSIBLE_ID
        $this->RESPONSIBLE_ID->CellCssStyle = "white-space: nowrap;";

        // RESPONSIBLE
        $this->RESPONSIBLE->CellCssStyle = "white-space: nowrap;";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->CellCssStyle = "white-space: nowrap;";

        // TICKET_NO
        $this->TICKET_NO->CellCssStyle = "white-space: nowrap;";

        // ISATTENDED
        $this->ISATTENDED->CellCssStyle = "white-space: nowrap;";

        // PAYOR_ID
        $this->PAYOR_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID
        $this->CLASS_ID->CellCssStyle = "white-space: nowrap;";

        // ISPERTARIF
        $this->ISPERTARIF->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_INAP
        $this->EMPLOYEE_INAP->CellCssStyle = "white-space: nowrap;";

        // PASIEN_ID
        $this->PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // KARYAWAN
        $this->KARYAWAN->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID_PLAFOND
        $this->CLASS_ID_PLAFOND->CellCssStyle = "white-space: nowrap;";

        // BACKCHARGE
        $this->BACKCHARGE->CellCssStyle = "white-space: nowrap;";

        // COVERAGE_ID
        $this->COVERAGE_ID->CellCssStyle = "white-space: nowrap;";

        // AGEYEAR
        $this->AGEYEAR->CellCssStyle = "white-space: nowrap;";

        // AGEMONTH
        $this->AGEMONTH->CellCssStyle = "white-space: nowrap;";

        // AGEDAY
        $this->AGEDAY->CellCssStyle = "white-space: nowrap;";

        // RECOMENDATION
        $this->RECOMENDATION->CellCssStyle = "white-space: nowrap;";

        // CONCLUSION
        $this->CONCLUSION->CellCssStyle = "white-space: nowrap;";

        // SPECIMENNO
        $this->SPECIMENNO->CellCssStyle = "white-space: nowrap;";

        // LOCKED
        $this->LOCKED->CellCssStyle = "white-space: nowrap;";

        // RM_OUT_DATE
        $this->RM_OUT_DATE->CellCssStyle = "white-space: nowrap;";

        // RM_IN_DATE
        $this->RM_IN_DATE->CellCssStyle = "white-space: nowrap;";

        // LAMA_PINJAM
        $this->LAMA_PINJAM->CellCssStyle = "white-space: nowrap;";

        // STANDAR_RJ
        $this->STANDAR_RJ->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_RJ
        $this->LENGKAP_RJ->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_RI
        $this->LENGKAP_RI->CellCssStyle = "white-space: nowrap;";

        // RESEND_RM_DATE
        $this->RESEND_RM_DATE->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_RM1
        $this->LENGKAP_RM1->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_RESUME
        $this->LENGKAP_RESUME->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_ANAMNESIS
        $this->LENGKAP_ANAMNESIS->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_CONSENT
        $this->LENGKAP_CONSENT->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_ANESTESI
        $this->LENGKAP_ANESTESI->CellCssStyle = "white-space: nowrap;";

        // LENGKAP_OP
        $this->LENGKAP_OP->CellCssStyle = "white-space: nowrap;";

        // BACK_RM_DATE
        $this->BACK_RM_DATE->CellCssStyle = "white-space: nowrap;";

        // VALID_RM_DATE
        $this->VALID_RM_DATE->CellCssStyle = "white-space: nowrap;";

        // NO_SKP
        $this->NO_SKP->CellCssStyle = "white-space: nowrap;";

        // NO_SKPINAP
        $this->NO_SKPINAP->CellCssStyle = "white-space: nowrap;";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->CellCssStyle = "white-space: nowrap;";

        // ticket_all
        $this->ticket_all->CellCssStyle = "white-space: nowrap;";

        // tanggal_rujukan
        $this->tanggal_rujukan->CellCssStyle = "white-space: nowrap;";

        // ISRJ
        $this->ISRJ->CellCssStyle = "white-space: nowrap;";

        // NORUJUKAN
        $this->NORUJUKAN->CellCssStyle = "white-space: nowrap;";

        // PPKRUJUKAN
        $this->PPKRUJUKAN->CellCssStyle = "white-space: nowrap;";

        // LOKASILAKA
        $this->LOKASILAKA->CellCssStyle = "white-space: nowrap;";

        // KDPOLI
        $this->KDPOLI->CellCssStyle = "white-space: nowrap;";

        // EDIT_SEP
        $this->EDIT_SEP->CellCssStyle = "white-space: nowrap;";

        // DELETE_SEP
        $this->DELETE_SEP->CellCssStyle = "white-space: nowrap;";

        // KODE_AGAMA
        $this->KODE_AGAMA->CellCssStyle = "white-space: nowrap;";

        // DIAG_AWAL
        $this->DIAG_AWAL->CellCssStyle = "white-space: nowrap;";

        // AKTIF
        $this->AKTIF->CellCssStyle = "white-space: nowrap;";

        // BILL_INAP
        $this->BILL_INAP->CellCssStyle = "white-space: nowrap;";

        // SEP_PRINTDATE
        $this->SEP_PRINTDATE->CellCssStyle = "white-space: nowrap;";

        // MAPPING_SEP
        $this->MAPPING_SEP->CellCssStyle = "white-space: nowrap;";

        // TRANS_ID
        $this->TRANS_ID->CellCssStyle = "white-space: nowrap;";

        // KDPOLI_EKS
        $this->KDPOLI_EKS->CellCssStyle = "white-space: nowrap;";

        // COB
        $this->COB->CellCssStyle = "white-space: nowrap;";

        // PENJAMIN
        $this->PENJAMIN->CellCssStyle = "white-space: nowrap;";

        // ASALRUJUKAN
        $this->ASALRUJUKAN->CellCssStyle = "white-space: nowrap;";

        // RESPONSEP
        $this->RESPONSEP->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_DESC
        $this->APPROVAL_DESC->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_RESPONAJUKAN
        $this->APPROVAL_RESPONAJUKAN->CellCssStyle = "white-space: nowrap;";

        // APPROVAL_RESPONAPPROV
        $this->APPROVAL_RESPONAPPROV->CellCssStyle = "white-space: nowrap;";

        // RESPONTGLPLG_DESC
        $this->RESPONTGLPLG_DESC->CellCssStyle = "white-space: nowrap;";

        // RESPONPOST_VKLAIM
        $this->RESPONPOST_VKLAIM->CellCssStyle = "white-space: nowrap;";

        // RESPONPUT_VKLAIM
        $this->RESPONPUT_VKLAIM->CellCssStyle = "white-space: nowrap;";

        // RESPONDEL_VKLAIM
        $this->RESPONDEL_VKLAIM->CellCssStyle = "white-space: nowrap;";

        // CALL_TIMES
        $this->CALL_TIMES->CellCssStyle = "white-space: nowrap;";

        // CALL_DATE
        $this->CALL_DATE->CellCssStyle = "white-space: nowrap;";

        // CALL_DATES
        $this->CALL_DATES->CellCssStyle = "white-space: nowrap;";

        // SERVED_DATE
        $this->SERVED_DATE->CellCssStyle = "white-space: nowrap;";

        // SERVED_INAP
        $this->SERVED_INAP->CellCssStyle = "white-space: nowrap;";

        // KDDPJP1
        $this->KDDPJP1->CellCssStyle = "white-space: nowrap;";

        // KDDPJP
        $this->KDDPJP->CellCssStyle = "white-space: nowrap;";

        // IDXDAFTAR
        $this->IDXDAFTAR->CellCssStyle = "white-space: nowrap;";

        // tgl_kontrol

        // idbooking

        // id_tujuan

        // id_penunjang

        // id_pembiayaan

        // id_procedure

        // id_aspel

        // id_kelas

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

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

        // STATUS_PASIEN_ID
        $curVal = trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
        if ($curVal != "") {
            $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
            if ($this->STATUS_PASIEN_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "[ISACTIVE] = 1";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->STATUS_PASIEN_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->STATUS_PASIEN_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->displayValue($arwrk);
                } else {
                    $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
                }
            }
        } else {
            $this->STATUS_PASIEN_ID->ViewValue = null;
        }
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // RUJUKAN_ID
        $curVal = trim(strval($this->RUJUKAN_ID->CurrentValue));
        if ($curVal != "") {
            $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->lookupCacheOption($curVal);
            if ($this->RUJUKAN_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[RUJUKAN_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->RUJUKAN_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->RUJUKAN_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->displayValue($arwrk);
                } else {
                    $this->RUJUKAN_ID->ViewValue = $this->RUJUKAN_ID->CurrentValue;
                }
            }
        } else {
            $this->RUJUKAN_ID->ViewValue = null;
        }
        $this->RUJUKAN_ID->ViewCustomAttributes = "";

        // ADDRESS_OF_RUJUKAN
        $this->ADDRESS_OF_RUJUKAN->ViewValue = $this->ADDRESS_OF_RUJUKAN->CurrentValue;
        $this->ADDRESS_OF_RUJUKAN->ViewCustomAttributes = "";

        // REASON_ID
        $curVal = trim(strval($this->REASON_ID->CurrentValue));
        if ($curVal != "") {
            $this->REASON_ID->ViewValue = $this->REASON_ID->lookupCacheOption($curVal);
            if ($this->REASON_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[REASON_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->REASON_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->REASON_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->REASON_ID->ViewValue = $this->REASON_ID->displayValue($arwrk);
                } else {
                    $this->REASON_ID->ViewValue = $this->REASON_ID->CurrentValue;
                }
            }
        } else {
            $this->REASON_ID->ViewValue = null;
        }
        $this->REASON_ID->ViewCustomAttributes = "";

        // WAY_ID
        $curVal = trim(strval($this->WAY_ID->CurrentValue));
        if ($curVal != "") {
            $this->WAY_ID->ViewValue = $this->WAY_ID->lookupCacheOption($curVal);
            if ($this->WAY_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[WAY_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->WAY_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->WAY_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->WAY_ID->ViewValue = $this->WAY_ID->displayValue($arwrk);
                } else {
                    $this->WAY_ID->ViewValue = $this->WAY_ID->CurrentValue;
                }
            }
        } else {
            $this->WAY_ID->ViewValue = null;
        }
        $this->WAY_ID->ViewCustomAttributes = "";

        // PATIENT_CATEGORY_ID
        $curVal = trim(strval($this->PATIENT_CATEGORY_ID->CurrentValue));
        if ($curVal != "") {
            $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->lookupCacheOption($curVal);
            if ($this->PATIENT_CATEGORY_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[PATIENT_CATEGORY_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->PATIENT_CATEGORY_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->PATIENT_CATEGORY_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->displayValue($arwrk);
                } else {
                    $this->PATIENT_CATEGORY_ID->ViewValue = $this->PATIENT_CATEGORY_ID->CurrentValue;
                }
            }
        } else {
            $this->PATIENT_CATEGORY_ID->ViewValue = null;
        }
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
        if (strval($this->ISNEW->CurrentValue) != "") {
            $this->ISNEW->ViewValue = $this->ISNEW->optionCaption($this->ISNEW->CurrentValue);
        } else {
            $this->ISNEW->ViewValue = null;
        }
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
        $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
        if ($curVal != "") {
            $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
            if ($this->CLINIC_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "[STYPE_ID] = 1 OR [STYPE_ID] = 2 OR [STYPE_ID] = 5";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
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
        $curVal = trim(strval($this->CLINIC_ID_FROM->CurrentValue));
        if ($curVal != "") {
            $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->lookupCacheOption($curVal);
            if ($this->CLINIC_ID_FROM->ViewValue === null) { // Lookup from database
                $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->CLINIC_ID_FROM->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLINIC_ID_FROM->Lookup->renderViewRow($rswrk[0]);
                    $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->displayValue($arwrk);
                } else {
                    $this->CLINIC_ID_FROM->ViewValue = $this->CLINIC_ID_FROM->CurrentValue;
                }
            }
        } else {
            $this->CLINIC_ID_FROM->ViewValue = null;
        }
        $this->CLINIC_ID_FROM->ViewCustomAttributes = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

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
        $curVal = trim(strval($this->GENDER->CurrentValue));
        if ($curVal != "") {
            $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
            if ($this->GENDER->ViewValue === null) { // Lookup from database
                $filterWrk = "[GENDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->GENDER->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->GENDER->Lookup->renderViewRow($rswrk[0]);
                    $this->GENDER->ViewValue = $this->GENDER->displayValue($arwrk);
                } else {
                    $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
                }
            }
        } else {
            $this->GENDER->ViewValue = null;
        }
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
        $curVal = trim(strval($this->PAYOR_ID->CurrentValue));
        if ($curVal != "") {
            $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->lookupCacheOption($curVal);
            if ($this->PAYOR_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[PAYOR_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->PAYOR_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->PAYOR_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->displayValue($arwrk);
                } else {
                    $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
                }
            }
        } else {
            $this->PAYOR_ID->ViewValue = null;
        }
        $this->PAYOR_ID->ViewCustomAttributes = "";

        // CLASS_ID
        $curVal = trim(strval($this->CLASS_ID->CurrentValue));
        if ($curVal != "") {
            $this->CLASS_ID->ViewValue = $this->CLASS_ID->lookupCacheOption($curVal);
            if ($this->CLASS_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[CLASS_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->CLASS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLASS_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLASS_ID->ViewValue = $this->CLASS_ID->displayValue($arwrk);
                } else {
                    $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
                }
            }
        } else {
            $this->CLASS_ID->ViewValue = null;
        }
        $this->CLASS_ID->ViewCustomAttributes = "";

        // ISPERTARIF
        $this->ISPERTARIF->ViewValue = $this->ISPERTARIF->CurrentValue;
        $this->ISPERTARIF->ViewCustomAttributes = "";

        // KAL_ID
        $curVal = trim(strval($this->KAL_ID->CurrentValue));
        if ($curVal != "") {
            $this->KAL_ID->ViewValue = $this->KAL_ID->lookupCacheOption($curVal);
            if ($this->KAL_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[KAL_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->KAL_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->KAL_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->KAL_ID->ViewValue = $this->KAL_ID->displayValue($arwrk);
                } else {
                    $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
                }
            }
        } else {
            $this->KAL_ID->ViewValue = null;
        }
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
        $curVal = trim(strval($this->COVERAGE_ID->CurrentValue));
        if ($curVal != "") {
            $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->lookupCacheOption($curVal);
            if ($this->COVERAGE_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[COVERAGE_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->COVERAGE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->COVERAGE_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->displayValue($arwrk);
                } else {
                    $this->COVERAGE_ID->ViewValue = $this->COVERAGE_ID->CurrentValue;
                }
            }
        } else {
            $this->COVERAGE_ID->ViewValue = null;
        }
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

        // NO_SKPINAP
        $this->NO_SKPINAP->ViewValue = $this->NO_SKPINAP->CurrentValue;
        $this->NO_SKPINAP->ViewCustomAttributes = "";

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

        // ticket_all
        $this->ticket_all->ViewValue = $this->ticket_all->CurrentValue;
        $this->ticket_all->ViewValue = FormatNumber($this->ticket_all->ViewValue, 0, -2, -2, -2);
        $this->ticket_all->ViewCustomAttributes = "";

        // tanggal_rujukan
        $this->tanggal_rujukan->ViewValue = $this->tanggal_rujukan->CurrentValue;
        $this->tanggal_rujukan->ViewValue = FormatDateTime($this->tanggal_rujukan->ViewValue, 0);
        $this->tanggal_rujukan->ViewCustomAttributes = "";

        // ISRJ
        $curVal = trim(strval($this->ISRJ->CurrentValue));
        if ($curVal != "") {
            $this->ISRJ->ViewValue = $this->ISRJ->lookupCacheOption($curVal);
            if ($this->ISRJ->ViewValue === null) { // Lookup from database
                $filterWrk = "[KELUAR_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->ISRJ->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->ISRJ->Lookup->renderViewRow($rswrk[0]);
                    $this->ISRJ->ViewValue = $this->ISRJ->displayValue($arwrk);
                } else {
                    $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
                }
            }
        } else {
            $this->ISRJ->ViewValue = null;
        }
        $this->ISRJ->ViewCustomAttributes = "";

        // NORUJUKAN
        $this->NORUJUKAN->ViewValue = $this->NORUJUKAN->CurrentValue;
        $this->NORUJUKAN->ViewCustomAttributes = "";

        // PPKRUJUKAN
        $curVal = trim(strval($this->PPKRUJUKAN->CurrentValue));
        if ($curVal != "") {
            $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->lookupCacheOption($curVal);
            if ($this->PPKRUJUKAN->ViewValue === null) { // Lookup from database
                $filterWrk = "[KDPROVIDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->PPKRUJUKAN->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->PPKRUJUKAN->Lookup->renderViewRow($rswrk[0]);
                    $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->displayValue($arwrk);
                } else {
                    $this->PPKRUJUKAN->ViewValue = $this->PPKRUJUKAN->CurrentValue;
                }
            }
        } else {
            $this->PPKRUJUKAN->ViewValue = null;
        }
        $this->PPKRUJUKAN->ViewCustomAttributes = "";

        // LOKASILAKA
        $this->LOKASILAKA->ViewValue = $this->LOKASILAKA->CurrentValue;
        $this->LOKASILAKA->ViewCustomAttributes = "";

        // KDPOLI
        $this->KDPOLI->ViewValue = $this->KDPOLI->CurrentValue;
        $this->KDPOLI->ViewCustomAttributes = "";

        // EDIT_SEP
        $this->EDIT_SEP->ViewValue = $this->EDIT_SEP->CurrentValue;
        $this->EDIT_SEP->ViewCustomAttributes = "";

        // DELETE_SEP
        $this->DELETE_SEP->ViewValue = $this->DELETE_SEP->CurrentValue;
        $this->DELETE_SEP->ViewCustomAttributes = "";

        // KODE_AGAMA
        $curVal = trim(strval($this->KODE_AGAMA->CurrentValue));
        if ($curVal != "") {
            $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->lookupCacheOption($curVal);
            if ($this->KODE_AGAMA->ViewValue === null) { // Lookup from database
                $filterWrk = "[KODE_AGAMA]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->KODE_AGAMA->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->KODE_AGAMA->Lookup->renderViewRow($rswrk[0]);
                    $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->displayValue($arwrk);
                } else {
                    $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->CurrentValue;
                }
            }
        } else {
            $this->KODE_AGAMA->ViewValue = null;
        }
        $this->KODE_AGAMA->ViewCustomAttributes = "";

        // DIAG_AWAL
        $this->DIAG_AWAL->ViewValue = $this->DIAG_AWAL->CurrentValue;
        $this->DIAG_AWAL->ViewCustomAttributes = "";

        // AKTIF
        $this->AKTIF->ViewValue = $this->AKTIF->CurrentValue;
        $this->AKTIF->ViewCustomAttributes = "";

        // BILL_INAP
        $this->BILL_INAP->ViewValue = $this->BILL_INAP->CurrentValue;
        $this->BILL_INAP->ViewCustomAttributes = "";

        // SEP_PRINTDATE
        $this->SEP_PRINTDATE->ViewValue = $this->SEP_PRINTDATE->CurrentValue;
        $this->SEP_PRINTDATE->ViewValue = FormatDateTime($this->SEP_PRINTDATE->ViewValue, 0);
        $this->SEP_PRINTDATE->ViewCustomAttributes = "";

        // MAPPING_SEP
        $this->MAPPING_SEP->ViewValue = $this->MAPPING_SEP->CurrentValue;
        $this->MAPPING_SEP->ViewCustomAttributes = "";

        // TRANS_ID
        $this->TRANS_ID->ViewValue = $this->TRANS_ID->CurrentValue;
        $this->TRANS_ID->ViewCustomAttributes = "";

        // KDPOLI_EKS
        $this->KDPOLI_EKS->ViewValue = $this->KDPOLI_EKS->CurrentValue;
        $this->KDPOLI_EKS->ViewCustomAttributes = "";

        // COB
        if (strval($this->COB->CurrentValue) != "") {
            $this->COB->ViewValue = new OptionValues();
            $arwrk = explode(",", strval($this->COB->CurrentValue));
            $cnt = count($arwrk);
            for ($ari = 0; $ari < $cnt; $ari++)
                $this->COB->ViewValue->add($this->COB->optionCaption(trim($arwrk[$ari])));
        } else {
            $this->COB->ViewValue = null;
        }
        $this->COB->ViewCustomAttributes = "";

        // PENJAMIN
        $this->PENJAMIN->ViewValue = $this->PENJAMIN->CurrentValue;
        $this->PENJAMIN->ViewCustomAttributes = "";

        // ASALRUJUKAN
        $this->ASALRUJUKAN->ViewValue = $this->ASALRUJUKAN->CurrentValue;
        $this->ASALRUJUKAN->ViewCustomAttributes = "";

        // RESPONSEP
        $this->RESPONSEP->ViewValue = $this->RESPONSEP->CurrentValue;
        $this->RESPONSEP->ViewCustomAttributes = "";

        // APPROVAL_DESC
        $this->APPROVAL_DESC->ViewValue = $this->APPROVAL_DESC->CurrentValue;
        $this->APPROVAL_DESC->ViewCustomAttributes = "";

        // APPROVAL_RESPONAJUKAN
        $this->APPROVAL_RESPONAJUKAN->ViewValue = $this->APPROVAL_RESPONAJUKAN->CurrentValue;
        $this->APPROVAL_RESPONAJUKAN->ViewCustomAttributes = "";

        // APPROVAL_RESPONAPPROV
        $this->APPROVAL_RESPONAPPROV->ViewValue = $this->APPROVAL_RESPONAPPROV->CurrentValue;
        $this->APPROVAL_RESPONAPPROV->ViewCustomAttributes = "";

        // RESPONTGLPLG_DESC
        $this->RESPONTGLPLG_DESC->ViewValue = $this->RESPONTGLPLG_DESC->CurrentValue;
        $this->RESPONTGLPLG_DESC->ViewCustomAttributes = "";

        // RESPONPOST_VKLAIM
        $this->RESPONPOST_VKLAIM->ViewValue = $this->RESPONPOST_VKLAIM->CurrentValue;
        $this->RESPONPOST_VKLAIM->ViewCustomAttributes = "";

        // RESPONPUT_VKLAIM
        $this->RESPONPUT_VKLAIM->ViewValue = $this->RESPONPUT_VKLAIM->CurrentValue;
        $this->RESPONPUT_VKLAIM->ViewCustomAttributes = "";

        // RESPONDEL_VKLAIM
        $this->RESPONDEL_VKLAIM->ViewValue = $this->RESPONDEL_VKLAIM->CurrentValue;
        $this->RESPONDEL_VKLAIM->ViewCustomAttributes = "";

        // CALL_TIMES
        $this->CALL_TIMES->ViewValue = $this->CALL_TIMES->CurrentValue;
        $this->CALL_TIMES->ViewValue = FormatNumber($this->CALL_TIMES->ViewValue, 0, -2, -2, -2);
        $this->CALL_TIMES->ViewCustomAttributes = "";

        // CALL_DATE
        $this->CALL_DATE->ViewValue = $this->CALL_DATE->CurrentValue;
        $this->CALL_DATE->ViewValue = FormatDateTime($this->CALL_DATE->ViewValue, 0);
        $this->CALL_DATE->ViewCustomAttributes = "";

        // CALL_DATES
        $this->CALL_DATES->ViewValue = $this->CALL_DATES->CurrentValue;
        $this->CALL_DATES->ViewValue = FormatDateTime($this->CALL_DATES->ViewValue, 0);
        $this->CALL_DATES->ViewCustomAttributes = "";

        // SERVED_DATE
        $this->SERVED_DATE->ViewValue = $this->SERVED_DATE->CurrentValue;
        $this->SERVED_DATE->ViewValue = FormatDateTime($this->SERVED_DATE->ViewValue, 0);
        $this->SERVED_DATE->ViewCustomAttributes = "";

        // SERVED_INAP
        $this->SERVED_INAP->ViewValue = $this->SERVED_INAP->CurrentValue;
        $this->SERVED_INAP->ViewValue = FormatDateTime($this->SERVED_INAP->ViewValue, 0);
        $this->SERVED_INAP->ViewCustomAttributes = "";

        // KDDPJP1
        $this->KDDPJP1->ViewValue = $this->KDDPJP1->CurrentValue;
        $this->KDDPJP1->ViewCustomAttributes = "";

        // KDDPJP
        $this->KDDPJP->ViewValue = $this->KDDPJP->CurrentValue;
        $this->KDDPJP->ViewCustomAttributes = "";

        // IDXDAFTAR
        $this->IDXDAFTAR->ViewValue = $this->IDXDAFTAR->CurrentValue;
        $this->IDXDAFTAR->ViewCustomAttributes = "";

        // tgl_kontrol
        $this->tgl_kontrol->ViewValue = $this->tgl_kontrol->CurrentValue;
        $this->tgl_kontrol->ViewValue = FormatDateTime($this->tgl_kontrol->ViewValue, 0);
        $this->tgl_kontrol->ViewCustomAttributes = "";

        // idbooking
        $this->idbooking->ViewValue = $this->idbooking->CurrentValue;
        $this->idbooking->ViewCustomAttributes = "";

        // id_tujuan
        $this->id_tujuan->ViewValue = $this->id_tujuan->CurrentValue;
        $this->id_tujuan->ViewValue = FormatNumber($this->id_tujuan->ViewValue, 0, -2, -2, -2);
        $this->id_tujuan->ViewCustomAttributes = "";

        // id_penunjang
        $this->id_penunjang->ViewValue = $this->id_penunjang->CurrentValue;
        $this->id_penunjang->ViewValue = FormatNumber($this->id_penunjang->ViewValue, 0, -2, -2, -2);
        $this->id_penunjang->ViewCustomAttributes = "";

        // id_pembiayaan
        $this->id_pembiayaan->ViewValue = $this->id_pembiayaan->CurrentValue;
        $this->id_pembiayaan->ViewValue = FormatNumber($this->id_pembiayaan->ViewValue, 0, -2, -2, -2);
        $this->id_pembiayaan->ViewCustomAttributes = "";

        // id_procedure
        $this->id_procedure->ViewValue = $this->id_procedure->CurrentValue;
        $this->id_procedure->ViewValue = FormatNumber($this->id_procedure->ViewValue, 0, -2, -2, -2);
        $this->id_procedure->ViewCustomAttributes = "";

        // id_aspel
        $this->id_aspel->ViewValue = $this->id_aspel->CurrentValue;
        $this->id_aspel->ViewValue = FormatNumber($this->id_aspel->ViewValue, 0, -2, -2, -2);
        $this->id_aspel->ViewCustomAttributes = "";

        // id_kelas
        $this->id_kelas->ViewValue = $this->id_kelas->CurrentValue;
        $this->id_kelas->ViewValue = FormatNumber($this->id_kelas->ViewValue, 0, -2, -2, -2);
        $this->id_kelas->ViewCustomAttributes = "";

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

        // NO_SKPINAP
        $this->NO_SKPINAP->LinkCustomAttributes = "";
        $this->NO_SKPINAP->HrefValue = "";
        $this->NO_SKPINAP->TooltipValue = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID->HrefValue = "";
        $this->DIAGNOSA_ID->TooltipValue = "";

        // ticket_all
        $this->ticket_all->LinkCustomAttributes = "";
        $this->ticket_all->HrefValue = "";
        $this->ticket_all->TooltipValue = "";

        // tanggal_rujukan
        $this->tanggal_rujukan->LinkCustomAttributes = "";
        $this->tanggal_rujukan->HrefValue = "";
        $this->tanggal_rujukan->TooltipValue = "";

        // ISRJ
        $this->ISRJ->LinkCustomAttributes = "";
        $this->ISRJ->HrefValue = "";
        $this->ISRJ->TooltipValue = "";

        // NORUJUKAN
        $this->NORUJUKAN->LinkCustomAttributes = "";
        $this->NORUJUKAN->HrefValue = "";
        $this->NORUJUKAN->TooltipValue = "";

        // PPKRUJUKAN
        $this->PPKRUJUKAN->LinkCustomAttributes = "";
        $this->PPKRUJUKAN->HrefValue = "";
        $this->PPKRUJUKAN->TooltipValue = "";

        // LOKASILAKA
        $this->LOKASILAKA->LinkCustomAttributes = "";
        $this->LOKASILAKA->HrefValue = "";
        $this->LOKASILAKA->TooltipValue = "";

        // KDPOLI
        $this->KDPOLI->LinkCustomAttributes = "";
        $this->KDPOLI->HrefValue = "";
        $this->KDPOLI->TooltipValue = "";

        // EDIT_SEP
        $this->EDIT_SEP->LinkCustomAttributes = "";
        $this->EDIT_SEP->HrefValue = "";
        $this->EDIT_SEP->TooltipValue = "";

        // DELETE_SEP
        $this->DELETE_SEP->LinkCustomAttributes = "";
        $this->DELETE_SEP->HrefValue = "";
        $this->DELETE_SEP->TooltipValue = "";

        // KODE_AGAMA
        $this->KODE_AGAMA->LinkCustomAttributes = "";
        $this->KODE_AGAMA->HrefValue = "";
        $this->KODE_AGAMA->TooltipValue = "";

        // DIAG_AWAL
        $this->DIAG_AWAL->LinkCustomAttributes = "";
        $this->DIAG_AWAL->HrefValue = "";
        $this->DIAG_AWAL->TooltipValue = "";

        // AKTIF
        $this->AKTIF->LinkCustomAttributes = "";
        $this->AKTIF->HrefValue = "";
        $this->AKTIF->TooltipValue = "";

        // BILL_INAP
        $this->BILL_INAP->LinkCustomAttributes = "";
        $this->BILL_INAP->HrefValue = "";
        $this->BILL_INAP->TooltipValue = "";

        // SEP_PRINTDATE
        $this->SEP_PRINTDATE->LinkCustomAttributes = "";
        $this->SEP_PRINTDATE->HrefValue = "";
        $this->SEP_PRINTDATE->TooltipValue = "";

        // MAPPING_SEP
        $this->MAPPING_SEP->LinkCustomAttributes = "";
        $this->MAPPING_SEP->HrefValue = "";
        $this->MAPPING_SEP->TooltipValue = "";

        // TRANS_ID
        $this->TRANS_ID->LinkCustomAttributes = "";
        $this->TRANS_ID->HrefValue = "";
        $this->TRANS_ID->TooltipValue = "";

        // KDPOLI_EKS
        $this->KDPOLI_EKS->LinkCustomAttributes = "";
        $this->KDPOLI_EKS->HrefValue = "";
        $this->KDPOLI_EKS->TooltipValue = "";

        // COB
        $this->COB->LinkCustomAttributes = "";
        $this->COB->HrefValue = "";
        $this->COB->TooltipValue = "";

        // PENJAMIN
        $this->PENJAMIN->LinkCustomAttributes = "";
        $this->PENJAMIN->HrefValue = "";
        $this->PENJAMIN->TooltipValue = "";

        // ASALRUJUKAN
        $this->ASALRUJUKAN->LinkCustomAttributes = "";
        $this->ASALRUJUKAN->HrefValue = "";
        $this->ASALRUJUKAN->TooltipValue = "";

        // RESPONSEP
        $this->RESPONSEP->LinkCustomAttributes = "";
        $this->RESPONSEP->HrefValue = "";
        $this->RESPONSEP->TooltipValue = "";

        // APPROVAL_DESC
        $this->APPROVAL_DESC->LinkCustomAttributes = "";
        $this->APPROVAL_DESC->HrefValue = "";
        $this->APPROVAL_DESC->TooltipValue = "";

        // APPROVAL_RESPONAJUKAN
        $this->APPROVAL_RESPONAJUKAN->LinkCustomAttributes = "";
        $this->APPROVAL_RESPONAJUKAN->HrefValue = "";
        $this->APPROVAL_RESPONAJUKAN->TooltipValue = "";

        // APPROVAL_RESPONAPPROV
        $this->APPROVAL_RESPONAPPROV->LinkCustomAttributes = "";
        $this->APPROVAL_RESPONAPPROV->HrefValue = "";
        $this->APPROVAL_RESPONAPPROV->TooltipValue = "";

        // RESPONTGLPLG_DESC
        $this->RESPONTGLPLG_DESC->LinkCustomAttributes = "";
        $this->RESPONTGLPLG_DESC->HrefValue = "";
        $this->RESPONTGLPLG_DESC->TooltipValue = "";

        // RESPONPOST_VKLAIM
        $this->RESPONPOST_VKLAIM->LinkCustomAttributes = "";
        $this->RESPONPOST_VKLAIM->HrefValue = "";
        $this->RESPONPOST_VKLAIM->TooltipValue = "";

        // RESPONPUT_VKLAIM
        $this->RESPONPUT_VKLAIM->LinkCustomAttributes = "";
        $this->RESPONPUT_VKLAIM->HrefValue = "";
        $this->RESPONPUT_VKLAIM->TooltipValue = "";

        // RESPONDEL_VKLAIM
        $this->RESPONDEL_VKLAIM->LinkCustomAttributes = "";
        $this->RESPONDEL_VKLAIM->HrefValue = "";
        $this->RESPONDEL_VKLAIM->TooltipValue = "";

        // CALL_TIMES
        $this->CALL_TIMES->LinkCustomAttributes = "";
        $this->CALL_TIMES->HrefValue = "";
        $this->CALL_TIMES->TooltipValue = "";

        // CALL_DATE
        $this->CALL_DATE->LinkCustomAttributes = "";
        $this->CALL_DATE->HrefValue = "";
        $this->CALL_DATE->TooltipValue = "";

        // CALL_DATES
        $this->CALL_DATES->LinkCustomAttributes = "";
        $this->CALL_DATES->HrefValue = "";
        $this->CALL_DATES->TooltipValue = "";

        // SERVED_DATE
        $this->SERVED_DATE->LinkCustomAttributes = "";
        $this->SERVED_DATE->HrefValue = "";
        $this->SERVED_DATE->TooltipValue = "";

        // SERVED_INAP
        $this->SERVED_INAP->LinkCustomAttributes = "";
        $this->SERVED_INAP->HrefValue = "";
        $this->SERVED_INAP->TooltipValue = "";

        // KDDPJP1
        $this->KDDPJP1->LinkCustomAttributes = "";
        $this->KDDPJP1->HrefValue = "";
        $this->KDDPJP1->TooltipValue = "";

        // KDDPJP
        $this->KDDPJP->LinkCustomAttributes = "";
        $this->KDDPJP->HrefValue = "";
        $this->KDDPJP->TooltipValue = "";

        // IDXDAFTAR
        $this->IDXDAFTAR->LinkCustomAttributes = "";
        $this->IDXDAFTAR->HrefValue = "";
        $this->IDXDAFTAR->TooltipValue = "";

        // tgl_kontrol
        $this->tgl_kontrol->LinkCustomAttributes = "";
        $this->tgl_kontrol->HrefValue = "";
        $this->tgl_kontrol->TooltipValue = "";

        // idbooking
        $this->idbooking->LinkCustomAttributes = "";
        $this->idbooking->HrefValue = "";
        $this->idbooking->TooltipValue = "";

        // id_tujuan
        $this->id_tujuan->LinkCustomAttributes = "";
        $this->id_tujuan->HrefValue = "";
        $this->id_tujuan->TooltipValue = "";

        // id_penunjang
        $this->id_penunjang->LinkCustomAttributes = "";
        $this->id_penunjang->HrefValue = "";
        $this->id_penunjang->TooltipValue = "";

        // id_pembiayaan
        $this->id_pembiayaan->LinkCustomAttributes = "";
        $this->id_pembiayaan->HrefValue = "";
        $this->id_pembiayaan->TooltipValue = "";

        // id_procedure
        $this->id_procedure->LinkCustomAttributes = "";
        $this->id_procedure->HrefValue = "";
        $this->id_procedure->TooltipValue = "";

        // id_aspel
        $this->id_aspel->LinkCustomAttributes = "";
        $this->id_aspel->HrefValue = "";
        $this->id_aspel->TooltipValue = "";

        // id_kelas
        $this->id_kelas->LinkCustomAttributes = "";
        $this->id_kelas->HrefValue = "";
        $this->id_kelas->TooltipValue = "";

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

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
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
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // RUJUKAN_ID
        $this->RUJUKAN_ID->EditAttrs["class"] = "form-control";
        $this->RUJUKAN_ID->EditCustomAttributes = "";
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
        $this->REASON_ID->PlaceHolder = RemoveHtml($this->REASON_ID->caption());

        // WAY_ID
        $this->WAY_ID->EditAttrs["class"] = "form-control";
        $this->WAY_ID->EditCustomAttributes = "";
        $this->WAY_ID->PlaceHolder = RemoveHtml($this->WAY_ID->caption());

        // PATIENT_CATEGORY_ID
        $this->PATIENT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->PATIENT_CATEGORY_ID->EditCustomAttributes = "";
        $this->PATIENT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->PATIENT_CATEGORY_ID->caption());

        // BOOKED_DATE

        // VISIT_DATE

        // ISNEW
        $this->ISNEW->EditCustomAttributes = "";
        $this->ISNEW->EditValue = $this->ISNEW->options(false);
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
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // CLINIC_ID_FROM
        $this->CLINIC_ID_FROM->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID_FROM->EditCustomAttributes = "";
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

        // MODIFIED_DATE

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
        $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
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
        $this->NO_SKP->EditValue = $this->NO_SKP->CurrentValue;
        $this->NO_SKP->ViewCustomAttributes = "";

        // NO_SKPINAP
        $this->NO_SKPINAP->EditAttrs["class"] = "form-control";
        $this->NO_SKPINAP->EditCustomAttributes = "";
        $this->NO_SKPINAP->EditValue = $this->NO_SKPINAP->CurrentValue;
        $this->NO_SKPINAP->ViewCustomAttributes = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID->EditCustomAttributes = "";
        $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

        // ticket_all
        $this->ticket_all->EditAttrs["class"] = "form-control";
        $this->ticket_all->EditCustomAttributes = "";
        $this->ticket_all->EditValue = $this->ticket_all->CurrentValue;
        $this->ticket_all->PlaceHolder = RemoveHtml($this->ticket_all->caption());

        // tanggal_rujukan
        $this->tanggal_rujukan->EditAttrs["class"] = "form-control";
        $this->tanggal_rujukan->EditCustomAttributes = "";
        $this->tanggal_rujukan->EditValue = FormatDateTime($this->tanggal_rujukan->CurrentValue, 8);
        $this->tanggal_rujukan->PlaceHolder = RemoveHtml($this->tanggal_rujukan->caption());

        // ISRJ
        $this->ISRJ->EditAttrs["class"] = "form-control";
        $this->ISRJ->EditCustomAttributes = "";
        $this->ISRJ->PlaceHolder = RemoveHtml($this->ISRJ->caption());

        // NORUJUKAN
        $this->NORUJUKAN->EditAttrs["class"] = "form-control";
        $this->NORUJUKAN->EditCustomAttributes = "";
        $this->NORUJUKAN->EditValue = $this->NORUJUKAN->CurrentValue;
        $this->NORUJUKAN->ViewCustomAttributes = "";

        // PPKRUJUKAN
        $this->PPKRUJUKAN->EditAttrs["class"] = "form-control";
        $this->PPKRUJUKAN->EditCustomAttributes = "";
        $this->PPKRUJUKAN->PlaceHolder = RemoveHtml($this->PPKRUJUKAN->caption());

        // LOKASILAKA
        $this->LOKASILAKA->EditAttrs["class"] = "form-control";
        $this->LOKASILAKA->EditCustomAttributes = "";
        if (!$this->LOKASILAKA->Raw) {
            $this->LOKASILAKA->CurrentValue = HtmlDecode($this->LOKASILAKA->CurrentValue);
        }
        $this->LOKASILAKA->EditValue = $this->LOKASILAKA->CurrentValue;
        $this->LOKASILAKA->PlaceHolder = RemoveHtml($this->LOKASILAKA->caption());

        // KDPOLI
        $this->KDPOLI->EditAttrs["class"] = "form-control";
        $this->KDPOLI->EditCustomAttributes = "";
        if (!$this->KDPOLI->Raw) {
            $this->KDPOLI->CurrentValue = HtmlDecode($this->KDPOLI->CurrentValue);
        }
        $this->KDPOLI->EditValue = $this->KDPOLI->CurrentValue;
        $this->KDPOLI->PlaceHolder = RemoveHtml($this->KDPOLI->caption());

        // EDIT_SEP
        $this->EDIT_SEP->EditAttrs["class"] = "form-control";
        $this->EDIT_SEP->EditCustomAttributes = "";
        $this->EDIT_SEP->EditValue = $this->EDIT_SEP->CurrentValue;
        $this->EDIT_SEP->ViewCustomAttributes = "";

        // DELETE_SEP
        $this->DELETE_SEP->EditAttrs["class"] = "form-control";
        $this->DELETE_SEP->EditCustomAttributes = "";
        if (!$this->DELETE_SEP->Raw) {
            $this->DELETE_SEP->CurrentValue = HtmlDecode($this->DELETE_SEP->CurrentValue);
        }
        $this->DELETE_SEP->EditValue = $this->DELETE_SEP->CurrentValue;
        $this->DELETE_SEP->PlaceHolder = RemoveHtml($this->DELETE_SEP->caption());

        // KODE_AGAMA
        $this->KODE_AGAMA->EditCustomAttributes = "";
        $this->KODE_AGAMA->PlaceHolder = RemoveHtml($this->KODE_AGAMA->caption());

        // DIAG_AWAL
        $this->DIAG_AWAL->EditAttrs["class"] = "form-control";
        $this->DIAG_AWAL->EditCustomAttributes = "";
        if (!$this->DIAG_AWAL->Raw) {
            $this->DIAG_AWAL->CurrentValue = HtmlDecode($this->DIAG_AWAL->CurrentValue);
        }
        $this->DIAG_AWAL->EditValue = $this->DIAG_AWAL->CurrentValue;
        $this->DIAG_AWAL->PlaceHolder = RemoveHtml($this->DIAG_AWAL->caption());

        // AKTIF
        $this->AKTIF->EditAttrs["class"] = "form-control";
        $this->AKTIF->EditCustomAttributes = "";
        if (!$this->AKTIF->Raw) {
            $this->AKTIF->CurrentValue = HtmlDecode($this->AKTIF->CurrentValue);
        }
        $this->AKTIF->EditValue = $this->AKTIF->CurrentValue;
        $this->AKTIF->PlaceHolder = RemoveHtml($this->AKTIF->caption());

        // BILL_INAP
        $this->BILL_INAP->EditAttrs["class"] = "form-control";
        $this->BILL_INAP->EditCustomAttributes = "";
        if (!$this->BILL_INAP->Raw) {
            $this->BILL_INAP->CurrentValue = HtmlDecode($this->BILL_INAP->CurrentValue);
        }
        $this->BILL_INAP->EditValue = $this->BILL_INAP->CurrentValue;
        $this->BILL_INAP->PlaceHolder = RemoveHtml($this->BILL_INAP->caption());

        // SEP_PRINTDATE
        $this->SEP_PRINTDATE->EditAttrs["class"] = "form-control";
        $this->SEP_PRINTDATE->EditCustomAttributes = "";
        $this->SEP_PRINTDATE->EditValue = FormatDateTime($this->SEP_PRINTDATE->CurrentValue, 8);
        $this->SEP_PRINTDATE->PlaceHolder = RemoveHtml($this->SEP_PRINTDATE->caption());

        // MAPPING_SEP
        $this->MAPPING_SEP->EditAttrs["class"] = "form-control";
        $this->MAPPING_SEP->EditCustomAttributes = "";
        if (!$this->MAPPING_SEP->Raw) {
            $this->MAPPING_SEP->CurrentValue = HtmlDecode($this->MAPPING_SEP->CurrentValue);
        }
        $this->MAPPING_SEP->EditValue = $this->MAPPING_SEP->CurrentValue;
        $this->MAPPING_SEP->PlaceHolder = RemoveHtml($this->MAPPING_SEP->caption());

        // TRANS_ID
        $this->TRANS_ID->EditAttrs["class"] = "form-control";
        $this->TRANS_ID->EditCustomAttributes = "";
        if (!$this->TRANS_ID->Raw) {
            $this->TRANS_ID->CurrentValue = HtmlDecode($this->TRANS_ID->CurrentValue);
        }
        $this->TRANS_ID->EditValue = $this->TRANS_ID->CurrentValue;
        $this->TRANS_ID->PlaceHolder = RemoveHtml($this->TRANS_ID->caption());

        // KDPOLI_EKS
        $this->KDPOLI_EKS->EditAttrs["class"] = "form-control";
        $this->KDPOLI_EKS->EditCustomAttributes = "";
        if (!$this->KDPOLI_EKS->Raw) {
            $this->KDPOLI_EKS->CurrentValue = HtmlDecode($this->KDPOLI_EKS->CurrentValue);
        }
        $this->KDPOLI_EKS->EditValue = $this->KDPOLI_EKS->CurrentValue;
        $this->KDPOLI_EKS->PlaceHolder = RemoveHtml($this->KDPOLI_EKS->caption());

        // COB
        $this->COB->EditCustomAttributes = "";
        $this->COB->EditValue = $this->COB->options(false);
        $this->COB->PlaceHolder = RemoveHtml($this->COB->caption());

        // PENJAMIN
        $this->PENJAMIN->EditAttrs["class"] = "form-control";
        $this->PENJAMIN->EditCustomAttributes = "";
        if (!$this->PENJAMIN->Raw) {
            $this->PENJAMIN->CurrentValue = HtmlDecode($this->PENJAMIN->CurrentValue);
        }
        $this->PENJAMIN->EditValue = $this->PENJAMIN->CurrentValue;
        $this->PENJAMIN->PlaceHolder = RemoveHtml($this->PENJAMIN->caption());

        // ASALRUJUKAN
        $this->ASALRUJUKAN->EditAttrs["class"] = "form-control";
        $this->ASALRUJUKAN->EditCustomAttributes = "";
        if (!$this->ASALRUJUKAN->Raw) {
            $this->ASALRUJUKAN->CurrentValue = HtmlDecode($this->ASALRUJUKAN->CurrentValue);
        }
        $this->ASALRUJUKAN->EditValue = $this->ASALRUJUKAN->CurrentValue;
        $this->ASALRUJUKAN->PlaceHolder = RemoveHtml($this->ASALRUJUKAN->caption());

        // RESPONSEP
        $this->RESPONSEP->EditAttrs["class"] = "form-control";
        $this->RESPONSEP->EditCustomAttributes = "";
        $this->RESPONSEP->EditValue = $this->RESPONSEP->CurrentValue;
        $this->RESPONSEP->PlaceHolder = RemoveHtml($this->RESPONSEP->caption());

        // APPROVAL_DESC
        $this->APPROVAL_DESC->EditAttrs["class"] = "form-control";
        $this->APPROVAL_DESC->EditCustomAttributes = "";
        if (!$this->APPROVAL_DESC->Raw) {
            $this->APPROVAL_DESC->CurrentValue = HtmlDecode($this->APPROVAL_DESC->CurrentValue);
        }
        $this->APPROVAL_DESC->EditValue = $this->APPROVAL_DESC->CurrentValue;
        $this->APPROVAL_DESC->PlaceHolder = RemoveHtml($this->APPROVAL_DESC->caption());

        // APPROVAL_RESPONAJUKAN
        $this->APPROVAL_RESPONAJUKAN->EditAttrs["class"] = "form-control";
        $this->APPROVAL_RESPONAJUKAN->EditCustomAttributes = "";
        if (!$this->APPROVAL_RESPONAJUKAN->Raw) {
            $this->APPROVAL_RESPONAJUKAN->CurrentValue = HtmlDecode($this->APPROVAL_RESPONAJUKAN->CurrentValue);
        }
        $this->APPROVAL_RESPONAJUKAN->EditValue = $this->APPROVAL_RESPONAJUKAN->CurrentValue;
        $this->APPROVAL_RESPONAJUKAN->PlaceHolder = RemoveHtml($this->APPROVAL_RESPONAJUKAN->caption());

        // APPROVAL_RESPONAPPROV
        $this->APPROVAL_RESPONAPPROV->EditAttrs["class"] = "form-control";
        $this->APPROVAL_RESPONAPPROV->EditCustomAttributes = "";
        if (!$this->APPROVAL_RESPONAPPROV->Raw) {
            $this->APPROVAL_RESPONAPPROV->CurrentValue = HtmlDecode($this->APPROVAL_RESPONAPPROV->CurrentValue);
        }
        $this->APPROVAL_RESPONAPPROV->EditValue = $this->APPROVAL_RESPONAPPROV->CurrentValue;
        $this->APPROVAL_RESPONAPPROV->PlaceHolder = RemoveHtml($this->APPROVAL_RESPONAPPROV->caption());

        // RESPONTGLPLG_DESC
        $this->RESPONTGLPLG_DESC->EditAttrs["class"] = "form-control";
        $this->RESPONTGLPLG_DESC->EditCustomAttributes = "";
        if (!$this->RESPONTGLPLG_DESC->Raw) {
            $this->RESPONTGLPLG_DESC->CurrentValue = HtmlDecode($this->RESPONTGLPLG_DESC->CurrentValue);
        }
        $this->RESPONTGLPLG_DESC->EditValue = $this->RESPONTGLPLG_DESC->CurrentValue;
        $this->RESPONTGLPLG_DESC->PlaceHolder = RemoveHtml($this->RESPONTGLPLG_DESC->caption());

        // RESPONPOST_VKLAIM
        $this->RESPONPOST_VKLAIM->EditAttrs["class"] = "form-control";
        $this->RESPONPOST_VKLAIM->EditCustomAttributes = "";
        $this->RESPONPOST_VKLAIM->EditValue = $this->RESPONPOST_VKLAIM->CurrentValue;
        $this->RESPONPOST_VKLAIM->PlaceHolder = RemoveHtml($this->RESPONPOST_VKLAIM->caption());

        // RESPONPUT_VKLAIM
        $this->RESPONPUT_VKLAIM->EditAttrs["class"] = "form-control";
        $this->RESPONPUT_VKLAIM->EditCustomAttributes = "";
        $this->RESPONPUT_VKLAIM->EditValue = $this->RESPONPUT_VKLAIM->CurrentValue;
        $this->RESPONPUT_VKLAIM->PlaceHolder = RemoveHtml($this->RESPONPUT_VKLAIM->caption());

        // RESPONDEL_VKLAIM
        $this->RESPONDEL_VKLAIM->EditAttrs["class"] = "form-control";
        $this->RESPONDEL_VKLAIM->EditCustomAttributes = "";
        $this->RESPONDEL_VKLAIM->EditValue = $this->RESPONDEL_VKLAIM->CurrentValue;
        $this->RESPONDEL_VKLAIM->PlaceHolder = RemoveHtml($this->RESPONDEL_VKLAIM->caption());

        // CALL_TIMES
        $this->CALL_TIMES->EditAttrs["class"] = "form-control";
        $this->CALL_TIMES->EditCustomAttributes = "";
        $this->CALL_TIMES->EditValue = $this->CALL_TIMES->CurrentValue;
        $this->CALL_TIMES->PlaceHolder = RemoveHtml($this->CALL_TIMES->caption());

        // CALL_DATE
        $this->CALL_DATE->EditAttrs["class"] = "form-control";
        $this->CALL_DATE->EditCustomAttributes = "";
        $this->CALL_DATE->EditValue = FormatDateTime($this->CALL_DATE->CurrentValue, 8);
        $this->CALL_DATE->PlaceHolder = RemoveHtml($this->CALL_DATE->caption());

        // CALL_DATES
        $this->CALL_DATES->EditAttrs["class"] = "form-control";
        $this->CALL_DATES->EditCustomAttributes = "";
        $this->CALL_DATES->EditValue = FormatDateTime($this->CALL_DATES->CurrentValue, 8);
        $this->CALL_DATES->PlaceHolder = RemoveHtml($this->CALL_DATES->caption());

        // SERVED_DATE
        $this->SERVED_DATE->EditAttrs["class"] = "form-control";
        $this->SERVED_DATE->EditCustomAttributes = "";
        $this->SERVED_DATE->EditValue = FormatDateTime($this->SERVED_DATE->CurrentValue, 8);
        $this->SERVED_DATE->PlaceHolder = RemoveHtml($this->SERVED_DATE->caption());

        // SERVED_INAP
        $this->SERVED_INAP->EditAttrs["class"] = "form-control";
        $this->SERVED_INAP->EditCustomAttributes = "";
        $this->SERVED_INAP->EditValue = FormatDateTime($this->SERVED_INAP->CurrentValue, 8);
        $this->SERVED_INAP->PlaceHolder = RemoveHtml($this->SERVED_INAP->caption());

        // KDDPJP1
        $this->KDDPJP1->EditAttrs["class"] = "form-control";
        $this->KDDPJP1->EditCustomAttributes = "";
        if (!$this->KDDPJP1->Raw) {
            $this->KDDPJP1->CurrentValue = HtmlDecode($this->KDDPJP1->CurrentValue);
        }
        $this->KDDPJP1->EditValue = $this->KDDPJP1->CurrentValue;
        $this->KDDPJP1->PlaceHolder = RemoveHtml($this->KDDPJP1->caption());

        // KDDPJP
        $this->KDDPJP->EditAttrs["class"] = "form-control";
        $this->KDDPJP->EditCustomAttributes = "";
        if (!$this->KDDPJP->Raw) {
            $this->KDDPJP->CurrentValue = HtmlDecode($this->KDDPJP->CurrentValue);
        }
        $this->KDDPJP->EditValue = $this->KDDPJP->CurrentValue;
        $this->KDDPJP->PlaceHolder = RemoveHtml($this->KDDPJP->caption());

        // IDXDAFTAR
        $this->IDXDAFTAR->EditAttrs["class"] = "form-control";
        $this->IDXDAFTAR->EditCustomAttributes = "";
        $this->IDXDAFTAR->EditValue = $this->IDXDAFTAR->CurrentValue;
        $this->IDXDAFTAR->ViewCustomAttributes = "";

        // tgl_kontrol
        $this->tgl_kontrol->EditAttrs["class"] = "form-control";
        $this->tgl_kontrol->EditCustomAttributes = "";
        $this->tgl_kontrol->EditValue = FormatDateTime($this->tgl_kontrol->CurrentValue, 8);
        $this->tgl_kontrol->PlaceHolder = RemoveHtml($this->tgl_kontrol->caption());

        // idbooking
        $this->idbooking->EditAttrs["class"] = "form-control";
        $this->idbooking->EditCustomAttributes = "";
        if (!$this->idbooking->Raw) {
            $this->idbooking->CurrentValue = HtmlDecode($this->idbooking->CurrentValue);
        }
        $this->idbooking->EditValue = $this->idbooking->CurrentValue;
        $this->idbooking->PlaceHolder = RemoveHtml($this->idbooking->caption());

        // id_tujuan
        $this->id_tujuan->EditAttrs["class"] = "form-control";
        $this->id_tujuan->EditCustomAttributes = "";
        $this->id_tujuan->EditValue = $this->id_tujuan->CurrentValue;
        $this->id_tujuan->PlaceHolder = RemoveHtml($this->id_tujuan->caption());

        // id_penunjang
        $this->id_penunjang->EditAttrs["class"] = "form-control";
        $this->id_penunjang->EditCustomAttributes = "";
        $this->id_penunjang->EditValue = $this->id_penunjang->CurrentValue;
        $this->id_penunjang->PlaceHolder = RemoveHtml($this->id_penunjang->caption());

        // id_pembiayaan
        $this->id_pembiayaan->EditAttrs["class"] = "form-control";
        $this->id_pembiayaan->EditCustomAttributes = "";
        $this->id_pembiayaan->EditValue = $this->id_pembiayaan->CurrentValue;
        $this->id_pembiayaan->PlaceHolder = RemoveHtml($this->id_pembiayaan->caption());

        // id_procedure
        $this->id_procedure->EditAttrs["class"] = "form-control";
        $this->id_procedure->EditCustomAttributes = "";
        $this->id_procedure->EditValue = $this->id_procedure->CurrentValue;
        $this->id_procedure->PlaceHolder = RemoveHtml($this->id_procedure->caption());

        // id_aspel
        $this->id_aspel->EditAttrs["class"] = "form-control";
        $this->id_aspel->EditCustomAttributes = "";
        $this->id_aspel->EditValue = $this->id_aspel->CurrentValue;
        $this->id_aspel->PlaceHolder = RemoveHtml($this->id_aspel->caption());

        // id_kelas
        $this->id_kelas->EditAttrs["class"] = "form-control";
        $this->id_kelas->EditCustomAttributes = "";
        $this->id_kelas->EditValue = $this->id_kelas->CurrentValue;
        $this->id_kelas->PlaceHolder = RemoveHtml($this->id_kelas->caption());

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
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->RUJUKAN_ID);
                    $doc->exportCaption($this->REASON_ID);
                    $doc->exportCaption($this->WAY_ID);
                    $doc->exportCaption($this->BOOKED_DATE);
                    $doc->exportCaption($this->VISIT_DATE);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->COVERAGE_ID);
                    $doc->exportCaption($this->NO_SKP);
                    $doc->exportCaption($this->NO_SKPINAP);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->NORUJUKAN);
                    $doc->exportCaption($this->PPKRUJUKAN);
                    $doc->exportCaption($this->EDIT_SEP);
                    $doc->exportCaption($this->DIAG_AWAL);
                    $doc->exportCaption($this->COB);
                    $doc->exportCaption($this->ASALRUJUKAN);
                    $doc->exportCaption($this->tgl_kontrol);
                    $doc->exportCaption($this->idbooking);
                    $doc->exportCaption($this->id_tujuan);
                    $doc->exportCaption($this->id_penunjang);
                    $doc->exportCaption($this->id_pembiayaan);
                    $doc->exportCaption($this->id_procedure);
                    $doc->exportCaption($this->id_aspel);
                    $doc->exportCaption($this->id_kelas);
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
                    $doc->exportCaption($this->NO_SKPINAP);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->ticket_all);
                    $doc->exportCaption($this->tanggal_rujukan);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->NORUJUKAN);
                    $doc->exportCaption($this->PPKRUJUKAN);
                    $doc->exportCaption($this->LOKASILAKA);
                    $doc->exportCaption($this->KDPOLI);
                    $doc->exportCaption($this->EDIT_SEP);
                    $doc->exportCaption($this->DELETE_SEP);
                    $doc->exportCaption($this->KODE_AGAMA);
                    $doc->exportCaption($this->DIAG_AWAL);
                    $doc->exportCaption($this->AKTIF);
                    $doc->exportCaption($this->BILL_INAP);
                    $doc->exportCaption($this->SEP_PRINTDATE);
                    $doc->exportCaption($this->MAPPING_SEP);
                    $doc->exportCaption($this->TRANS_ID);
                    $doc->exportCaption($this->KDPOLI_EKS);
                    $doc->exportCaption($this->COB);
                    $doc->exportCaption($this->PENJAMIN);
                    $doc->exportCaption($this->ASALRUJUKAN);
                    $doc->exportCaption($this->RESPONSEP);
                    $doc->exportCaption($this->APPROVAL_DESC);
                    $doc->exportCaption($this->APPROVAL_RESPONAJUKAN);
                    $doc->exportCaption($this->APPROVAL_RESPONAPPROV);
                    $doc->exportCaption($this->RESPONTGLPLG_DESC);
                    $doc->exportCaption($this->RESPONPOST_VKLAIM);
                    $doc->exportCaption($this->RESPONPUT_VKLAIM);
                    $doc->exportCaption($this->RESPONDEL_VKLAIM);
                    $doc->exportCaption($this->CALL_TIMES);
                    $doc->exportCaption($this->CALL_DATE);
                    $doc->exportCaption($this->CALL_DATES);
                    $doc->exportCaption($this->SERVED_DATE);
                    $doc->exportCaption($this->SERVED_INAP);
                    $doc->exportCaption($this->KDDPJP1);
                    $doc->exportCaption($this->KDDPJP);
                    $doc->exportCaption($this->IDXDAFTAR);
                    $doc->exportCaption($this->tgl_kontrol);
                    $doc->exportCaption($this->idbooking);
                    $doc->exportCaption($this->id_tujuan);
                    $doc->exportCaption($this->id_penunjang);
                    $doc->exportCaption($this->id_pembiayaan);
                    $doc->exportCaption($this->id_procedure);
                    $doc->exportCaption($this->id_aspel);
                    $doc->exportCaption($this->id_kelas);
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
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->RUJUKAN_ID);
                        $doc->exportField($this->REASON_ID);
                        $doc->exportField($this->WAY_ID);
                        $doc->exportField($this->BOOKED_DATE);
                        $doc->exportField($this->VISIT_DATE);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->COVERAGE_ID);
                        $doc->exportField($this->NO_SKP);
                        $doc->exportField($this->NO_SKPINAP);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->NORUJUKAN);
                        $doc->exportField($this->PPKRUJUKAN);
                        $doc->exportField($this->EDIT_SEP);
                        $doc->exportField($this->DIAG_AWAL);
                        $doc->exportField($this->COB);
                        $doc->exportField($this->ASALRUJUKAN);
                        $doc->exportField($this->tgl_kontrol);
                        $doc->exportField($this->idbooking);
                        $doc->exportField($this->id_tujuan);
                        $doc->exportField($this->id_penunjang);
                        $doc->exportField($this->id_pembiayaan);
                        $doc->exportField($this->id_procedure);
                        $doc->exportField($this->id_aspel);
                        $doc->exportField($this->id_kelas);
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
                        $doc->exportField($this->NO_SKPINAP);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->ticket_all);
                        $doc->exportField($this->tanggal_rujukan);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->NORUJUKAN);
                        $doc->exportField($this->PPKRUJUKAN);
                        $doc->exportField($this->LOKASILAKA);
                        $doc->exportField($this->KDPOLI);
                        $doc->exportField($this->EDIT_SEP);
                        $doc->exportField($this->DELETE_SEP);
                        $doc->exportField($this->KODE_AGAMA);
                        $doc->exportField($this->DIAG_AWAL);
                        $doc->exportField($this->AKTIF);
                        $doc->exportField($this->BILL_INAP);
                        $doc->exportField($this->SEP_PRINTDATE);
                        $doc->exportField($this->MAPPING_SEP);
                        $doc->exportField($this->TRANS_ID);
                        $doc->exportField($this->KDPOLI_EKS);
                        $doc->exportField($this->COB);
                        $doc->exportField($this->PENJAMIN);
                        $doc->exportField($this->ASALRUJUKAN);
                        $doc->exportField($this->RESPONSEP);
                        $doc->exportField($this->APPROVAL_DESC);
                        $doc->exportField($this->APPROVAL_RESPONAJUKAN);
                        $doc->exportField($this->APPROVAL_RESPONAPPROV);
                        $doc->exportField($this->RESPONTGLPLG_DESC);
                        $doc->exportField($this->RESPONPOST_VKLAIM);
                        $doc->exportField($this->RESPONPUT_VKLAIM);
                        $doc->exportField($this->RESPONDEL_VKLAIM);
                        $doc->exportField($this->CALL_TIMES);
                        $doc->exportField($this->CALL_DATE);
                        $doc->exportField($this->CALL_DATES);
                        $doc->exportField($this->SERVED_DATE);
                        $doc->exportField($this->SERVED_INAP);
                        $doc->exportField($this->KDDPJP1);
                        $doc->exportField($this->KDDPJP);
                        $doc->exportField($this->IDXDAFTAR);
                        $doc->exportField($this->tgl_kontrol);
                        $doc->exportField($this->idbooking);
                        $doc->exportField($this->id_tujuan);
                        $doc->exportField($this->id_penunjang);
                        $doc->exportField($this->id_pembiayaan);
                        $doc->exportField($this->id_procedure);
                        $doc->exportField($this->id_aspel);
                        $doc->exportField($this->id_kelas);
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
