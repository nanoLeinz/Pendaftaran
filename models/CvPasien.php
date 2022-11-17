<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for cv_pasien
 */
class CvPasien extends DbTable
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
    public $NAME_OF_PASIEN;
    public $PASIEN_ID;
    public $EMPLOYEE_ID;
    public $KK_NO;
    public $PLACE_OF_BIRTH;
    public $DATE_OF_BIRTH;
    public $GENDER;
    public $NATION_ID;
    public $EDUCATION_TYPE_CODE;
    public $MARITALSTATUSID;
    public $KODE_AGAMA;
    public $KAL_ID;
    public $RT;
    public $RW;
    public $JOB_ID;
    public $STATUS_PASIEN_ID;
    public $ANAK_KE;
    public $CONTACT_ADDRESS;
    public $PHONE_NUMBER;
    public $MOBILE;
    public $_EMAIL;
    public $PHOTO_LOCATION;
    public $REGISTRATION_DATE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $POSTAL_CODE;
    public $GELAR;
    public $BLOOD_TYPE_ID;
    public $FAMILY_STATUS_ID;
    public $ISMENINGGAL;
    public $DEATH_DATE;
    public $PAYOR_ID;
    public $CLASS_ID;
    public $ACCOUNT_ID;
    public $KARYAWAN;
    public $DESCRIPTION;
    public $NEWCARD;
    public $BACKCHARGE;
    public $ORG_ID;
    public $COVERAGE_ID;
    public $MOTHER;
    public $FATHER;
    public $SPOUSE;
    public $AKTIF;
    public $TMT;
    public $TAT;
    public $CARD_ID;
    public $MEDICAL_NOTES;
    public $ID;
    public $newapp;
    public $cek;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'cv_pasien';
        $this->TableName = 'cv_pasien';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "dbo.PASIEN";
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
        $this->ORG_UNIT_CODE = new DbField('cv_pasien', 'cv_pasien', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'HIDDEN');
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Sortable = false; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('cv_pasien', 'cv_pasien', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 25, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->IsForeignKey = true; // Foreign key field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN = new DbField('cv_pasien', 'cv_pasien', 'x_NAME_OF_PASIEN', 'NAME_OF_PASIEN', '[NAME_OF_PASIEN]', '[NAME_OF_PASIEN]', 200, 100, -1, false, '[NAME_OF_PASIEN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_OF_PASIEN->Sortable = true; // Allow sort
        $this->NAME_OF_PASIEN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_OF_PASIEN->Param, "CustomMsg");
        $this->Fields['NAME_OF_PASIEN'] = &$this->NAME_OF_PASIEN;

        // PASIEN_ID
        $this->PASIEN_ID = new DbField('cv_pasien', 'cv_pasien', 'x_PASIEN_ID', 'PASIEN_ID', '[PASIEN_ID]', '[PASIEN_ID]', 200, 30, -1, false, '[PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_ID->Sortable = true; // Allow sort
        $this->PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_ID->Param, "CustomMsg");
        $this->Fields['PASIEN_ID'] = &$this->PASIEN_ID;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('cv_pasien', 'cv_pasien', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = false; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // KK_NO
        $this->KK_NO = new DbField('cv_pasien', 'cv_pasien', 'x_KK_NO', 'KK_NO', '[KK_NO]', '[KK_NO]', 200, 30, -1, false, '[KK_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KK_NO->Sortable = true; // Allow sort
        $this->KK_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KK_NO->Param, "CustomMsg");
        $this->Fields['KK_NO'] = &$this->KK_NO;

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH = new DbField('cv_pasien', 'cv_pasien', 'x_PLACE_OF_BIRTH', 'PLACE_OF_BIRTH', '[PLACE_OF_BIRTH]', '[PLACE_OF_BIRTH]', 200, 50, -1, false, '[PLACE_OF_BIRTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PLACE_OF_BIRTH->Sortable = false; // Allow sort
        $this->PLACE_OF_BIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PLACE_OF_BIRTH->Param, "CustomMsg");
        $this->Fields['PLACE_OF_BIRTH'] = &$this->PLACE_OF_BIRTH;

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH = new DbField('cv_pasien', 'cv_pasien', 'x_DATE_OF_BIRTH', 'DATE_OF_BIRTH', '[DATE_OF_BIRTH]', CastDateFieldForLike("[DATE_OF_BIRTH]", 11, "DB"), 135, 8, 11, false, '[DATE_OF_BIRTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DATE_OF_BIRTH->Sortable = false; // Allow sort
        $this->DATE_OF_BIRTH->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->DATE_OF_BIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DATE_OF_BIRTH->Param, "CustomMsg");
        $this->Fields['DATE_OF_BIRTH'] = &$this->DATE_OF_BIRTH;

        // GENDER
        $this->GENDER = new DbField('cv_pasien', 'cv_pasien', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->GENDER->Sortable = false; // Allow sort
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

        // NATION_ID
        $this->NATION_ID = new DbField('cv_pasien', 'cv_pasien', 'x_NATION_ID', 'NATION_ID', '[NATION_ID]', 'CAST([NATION_ID] AS NVARCHAR)', 17, 1, -1, false, '[NATION_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NATION_ID->Sortable = false; // Allow sort
        $this->NATION_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NATION_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NATION_ID->Param, "CustomMsg");
        $this->Fields['NATION_ID'] = &$this->NATION_ID;

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE = new DbField('cv_pasien', 'cv_pasien', 'x_EDUCATION_TYPE_CODE', 'EDUCATION_TYPE_CODE', '[EDUCATION_TYPE_CODE]', 'CAST([EDUCATION_TYPE_CODE] AS NVARCHAR)', 17, 1, -1, false, '[EDUCATION_TYPE_CODE]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->EDUCATION_TYPE_CODE->Sortable = false; // Allow sort
        $this->EDUCATION_TYPE_CODE->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->EDUCATION_TYPE_CODE->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->EDUCATION_TYPE_CODE->Lookup = new Lookup('EDUCATION_TYPE_CODE', 'EDUCATION_TYPE', false, 'EDUCATION_TYPE_CODE', ["NAME_OF_EDU_TYPE","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->EDUCATION_TYPE_CODE->Lookup = new Lookup('EDUCATION_TYPE_CODE', 'EDUCATION_TYPE', false, 'EDUCATION_TYPE_CODE', ["NAME_OF_EDU_TYPE","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->EDUCATION_TYPE_CODE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->EDUCATION_TYPE_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EDUCATION_TYPE_CODE->Param, "CustomMsg");
        $this->Fields['EDUCATION_TYPE_CODE'] = &$this->EDUCATION_TYPE_CODE;

        // MARITALSTATUSID
        $this->MARITALSTATUSID = new DbField('cv_pasien', 'cv_pasien', 'x_MARITALSTATUSID', 'MARITALSTATUSID', '[MARITALSTATUSID]', 'CAST([MARITALSTATUSID] AS NVARCHAR)', 17, 1, -1, false, '[MARITALSTATUSID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MARITALSTATUSID->Sortable = false; // Allow sort
        $this->MARITALSTATUSID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MARITALSTATUSID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->MARITALSTATUSID->Lookup = new Lookup('MARITALSTATUSID', 'MARITAL_STATUS', false, 'MARITALSTATUSID', ["NAME_OF_MARITALSTATUS","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->MARITALSTATUSID->Lookup = new Lookup('MARITALSTATUSID', 'MARITAL_STATUS', false, 'MARITALSTATUSID', ["NAME_OF_MARITALSTATUS","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->MARITALSTATUSID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MARITALSTATUSID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARITALSTATUSID->Param, "CustomMsg");
        $this->Fields['MARITALSTATUSID'] = &$this->MARITALSTATUSID;

        // KODE_AGAMA
        $this->KODE_AGAMA = new DbField('cv_pasien', 'cv_pasien', 'x_KODE_AGAMA', 'KODE_AGAMA', '[KODE_AGAMA]', 'CAST([KODE_AGAMA] AS NVARCHAR)', 17, 1, -1, false, '[KODE_AGAMA]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KODE_AGAMA->Sortable = false; // Allow sort
        $this->KODE_AGAMA->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KODE_AGAMA->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
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

        // KAL_ID
        $this->KAL_ID = new DbField('cv_pasien', 'cv_pasien', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KAL_ID->Sortable = false; // Allow sort
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

        // RT
        $this->RT = new DbField('cv_pasien', 'cv_pasien', 'x_RT', 'RT', '[RT]', '[RT]', 200, 8, -1, false, '[RT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RT->Sortable = false; // Allow sort
        $this->RT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RT->Param, "CustomMsg");
        $this->Fields['RT'] = &$this->RT;

        // RW
        $this->RW = new DbField('cv_pasien', 'cv_pasien', 'x_RW', 'RW', '[RW]', '[RW]', 200, 20, -1, false, '[RW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RW->Sortable = false; // Allow sort
        $this->RW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RW->Param, "CustomMsg");
        $this->Fields['RW'] = &$this->RW;

        // JOB_ID
        $this->JOB_ID = new DbField('cv_pasien', 'cv_pasien', 'x_JOB_ID', 'JOB_ID', '[JOB_ID]', 'CAST([JOB_ID] AS NVARCHAR)', 17, 1, -1, false, '[JOB_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->JOB_ID->Sortable = false; // Allow sort
        $this->JOB_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->JOB_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->JOB_ID->Lookup = new Lookup('JOB_ID', 'JOB_CATEGORY', false, 'JOB_ID', ["NAME_OF_JOB","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->JOB_ID->Lookup = new Lookup('JOB_ID', 'JOB_CATEGORY', false, 'JOB_ID', ["NAME_OF_JOB","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->JOB_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->JOB_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JOB_ID->Param, "CustomMsg");
        $this->Fields['JOB_ID'] = &$this->JOB_ID;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('cv_pasien', 'cv_pasien', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->STATUS_PASIEN_ID->Sortable = false; // Allow sort
        $this->STATUS_PASIEN_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->STATUS_PASIEN_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->STATUS_PASIEN_ID->Lookup = new Lookup('STATUS_PASIEN_ID', 'STATUS_PASIEN', false, 'STATUS_PASIEN_ID', ["NAME_OF_STATUS_PASIEN","","",""], [], [], [], [], [], [], '[STATUS_PASIEN_ID] ASC', '');
                break;
            default:
                $this->STATUS_PASIEN_ID->Lookup = new Lookup('STATUS_PASIEN_ID', 'STATUS_PASIEN', false, 'STATUS_PASIEN_ID', ["NAME_OF_STATUS_PASIEN","","",""], [], [], [], [], [], [], '[STATUS_PASIEN_ID] ASC', '');
                break;
        }
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // ANAK_KE
        $this->ANAK_KE = new DbField('cv_pasien', 'cv_pasien', 'x_ANAK_KE', 'ANAK_KE', '[ANAK_KE]', 'CAST([ANAK_KE] AS NVARCHAR)', 17, 1, -1, false, '[ANAK_KE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ANAK_KE->Sortable = false; // Allow sort
        $this->ANAK_KE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ANAK_KE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ANAK_KE->Param, "CustomMsg");
        $this->Fields['ANAK_KE'] = &$this->ANAK_KE;

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS = new DbField('cv_pasien', 'cv_pasien', 'x_CONTACT_ADDRESS', 'CONTACT_ADDRESS', '[CONTACT_ADDRESS]', '[CONTACT_ADDRESS]', 200, 100, -1, false, '[CONTACT_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->CONTACT_ADDRESS->Sortable = false; // Allow sort
        $this->CONTACT_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTACT_ADDRESS->Param, "CustomMsg");
        $this->Fields['CONTACT_ADDRESS'] = &$this->CONTACT_ADDRESS;

        // PHONE_NUMBER
        $this->PHONE_NUMBER = new DbField('cv_pasien', 'cv_pasien', 'x_PHONE_NUMBER', 'PHONE_NUMBER', '[PHONE_NUMBER]', '[PHONE_NUMBER]', 200, 20, -1, false, '[PHONE_NUMBER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE_NUMBER->Sortable = false; // Allow sort
        $this->PHONE_NUMBER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE_NUMBER->Param, "CustomMsg");
        $this->Fields['PHONE_NUMBER'] = &$this->PHONE_NUMBER;

        // MOBILE
        $this->MOBILE = new DbField('cv_pasien', 'cv_pasien', 'x_MOBILE', 'MOBILE', '[MOBILE]', '[MOBILE]', 200, 20, -1, false, '[MOBILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MOBILE->Sortable = false; // Allow sort
        $this->MOBILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MOBILE->Param, "CustomMsg");
        $this->Fields['MOBILE'] = &$this->MOBILE;

        // EMAIL
        $this->_EMAIL = new DbField('cv_pasien', 'cv_pasien', 'x__EMAIL', 'EMAIL', '[EMAIL]', '[EMAIL]', 200, 50, -1, false, '[EMAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_EMAIL->Sortable = false; // Allow sort
        $this->_EMAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_EMAIL->Param, "CustomMsg");
        $this->Fields['EMAIL'] = &$this->_EMAIL;

        // PHOTO_LOCATION
        $this->PHOTO_LOCATION = new DbField('cv_pasien', 'cv_pasien', 'x_PHOTO_LOCATION', 'PHOTO_LOCATION', '[PHOTO_LOCATION]', '[PHOTO_LOCATION]', 200, 50, -1, false, '[PHOTO_LOCATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHOTO_LOCATION->Sortable = false; // Allow sort
        $this->PHOTO_LOCATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHOTO_LOCATION->Param, "CustomMsg");
        $this->Fields['PHOTO_LOCATION'] = &$this->PHOTO_LOCATION;

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE = new DbField('cv_pasien', 'cv_pasien', 'x_REGISTRATION_DATE', 'REGISTRATION_DATE', '[REGISTRATION_DATE]', CastDateFieldForLike("[REGISTRATION_DATE]", 11, "DB"), 135, 8, 11, false, '[REGISTRATION_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REGISTRATION_DATE->Sortable = false; // Allow sort
        $this->REGISTRATION_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->REGISTRATION_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REGISTRATION_DATE->Param, "CustomMsg");
        $this->REGISTRATION_DATE->AdvancedSearch->SearchValueDefault = CurrentDate();
        $this->REGISTRATION_DATE->AdvancedSearch->SearchOperatorDefault = "=";
        $this->REGISTRATION_DATE->AdvancedSearch->SearchOperatorDefault2 = "";
        $this->REGISTRATION_DATE->AdvancedSearch->SearchConditionDefault = "AND";
        $this->Fields['REGISTRATION_DATE'] = &$this->REGISTRATION_DATE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('cv_pasien', 'cv_pasien', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 11, "DB"), 135, 8, 11, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = false; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('cv_pasien', 'cv_pasien', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = false; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('cv_pasien', 'cv_pasien', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = false; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // POSTAL_CODE
        $this->POSTAL_CODE = new DbField('cv_pasien', 'cv_pasien', 'x_POSTAL_CODE', 'POSTAL_CODE', '[POSTAL_CODE]', '[POSTAL_CODE]', 200, 10, -1, false, '[POSTAL_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POSTAL_CODE->Sortable = false; // Allow sort
        $this->POSTAL_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POSTAL_CODE->Param, "CustomMsg");
        $this->Fields['POSTAL_CODE'] = &$this->POSTAL_CODE;

        // GELAR
        $this->GELAR = new DbField('cv_pasien', 'cv_pasien', 'x_GELAR', 'GELAR', '[GELAR]', '[GELAR]', 200, 50, -1, false, '[GELAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GELAR->Sortable = false; // Allow sort
        $this->GELAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GELAR->Param, "CustomMsg");
        $this->Fields['GELAR'] = &$this->GELAR;

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID = new DbField('cv_pasien', 'cv_pasien', 'x_BLOOD_TYPE_ID', 'BLOOD_TYPE_ID', '[BLOOD_TYPE_ID]', 'CAST([BLOOD_TYPE_ID] AS NVARCHAR)', 17, 1, -1, false, '[BLOOD_TYPE_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->BLOOD_TYPE_ID->Sortable = false; // Allow sort
        $this->BLOOD_TYPE_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->BLOOD_TYPE_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->BLOOD_TYPE_ID->Lookup = new Lookup('BLOOD_TYPE_ID', 'BLOOD_TYPE', false, 'BLOOD_TYPE_ID', ["NAME_OF_TYPE","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->BLOOD_TYPE_ID->Lookup = new Lookup('BLOOD_TYPE_ID', 'BLOOD_TYPE', false, 'BLOOD_TYPE_ID', ["NAME_OF_TYPE","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->BLOOD_TYPE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BLOOD_TYPE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BLOOD_TYPE_ID->Param, "CustomMsg");
        $this->Fields['BLOOD_TYPE_ID'] = &$this->BLOOD_TYPE_ID;

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID = new DbField('cv_pasien', 'cv_pasien', 'x_FAMILY_STATUS_ID', 'FAMILY_STATUS_ID', '[FAMILY_STATUS_ID]', 'CAST([FAMILY_STATUS_ID] AS NVARCHAR)', 17, 1, -1, false, '[FAMILY_STATUS_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->FAMILY_STATUS_ID->Sortable = false; // Allow sort
        $this->FAMILY_STATUS_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->FAMILY_STATUS_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->FAMILY_STATUS_ID->Lookup = new Lookup('FAMILY_STATUS_ID', 'INASIS_JENIS_PESERTA', false, 'KDJNSPESERTA', ["NMJNSPESERTA","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->FAMILY_STATUS_ID->Lookup = new Lookup('FAMILY_STATUS_ID', 'INASIS_JENIS_PESERTA', false, 'KDJNSPESERTA', ["NMJNSPESERTA","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->FAMILY_STATUS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FAMILY_STATUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAMILY_STATUS_ID->Param, "CustomMsg");
        $this->Fields['FAMILY_STATUS_ID'] = &$this->FAMILY_STATUS_ID;

        // ISMENINGGAL
        $this->ISMENINGGAL = new DbField('cv_pasien', 'cv_pasien', 'x_ISMENINGGAL', 'ISMENINGGAL', '[ISMENINGGAL]', '[ISMENINGGAL]', 129, 1, -1, false, '[ISMENINGGAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISMENINGGAL->Sortable = false; // Allow sort
        $this->ISMENINGGAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISMENINGGAL->Param, "CustomMsg");
        $this->Fields['ISMENINGGAL'] = &$this->ISMENINGGAL;

        // DEATH_DATE
        $this->DEATH_DATE = new DbField('cv_pasien', 'cv_pasien', 'x_DEATH_DATE', 'DEATH_DATE', '[DEATH_DATE]', CastDateFieldForLike("[DEATH_DATE]", 11, "DB"), 135, 8, 11, false, '[DEATH_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DEATH_DATE->Sortable = false; // Allow sort
        $this->DEATH_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->DEATH_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DEATH_DATE->Param, "CustomMsg");
        $this->Fields['DEATH_DATE'] = &$this->DEATH_DATE;

        // PAYOR_ID
        $this->PAYOR_ID = new DbField('cv_pasien', 'cv_pasien', 'x_PAYOR_ID', 'PAYOR_ID', '[PAYOR_ID]', '[PAYOR_ID]', 200, 50, -1, false, '[PAYOR_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->PAYOR_ID->Sortable = false; // Allow sort
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
        $this->CLASS_ID = new DbField('cv_pasien', 'cv_pasien', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLASS_ID->Sortable = false; // Allow sort
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

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('cv_pasien', 'cv_pasien', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = false; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // KARYAWAN
        $this->KARYAWAN = new DbField('cv_pasien', 'cv_pasien', 'x_KARYAWAN', 'KARYAWAN', '[KARYAWAN]', '[KARYAWAN]', 200, 50, -1, false, '[KARYAWAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KARYAWAN->Sortable = false; // Allow sort
        $this->KARYAWAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KARYAWAN->Param, "CustomMsg");
        $this->Fields['KARYAWAN'] = &$this->KARYAWAN;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('cv_pasien', 'cv_pasien', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = false; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // NEWCARD
        $this->NEWCARD = new DbField('cv_pasien', 'cv_pasien', 'x_NEWCARD', 'NEWCARD', '[NEWCARD]', CastDateFieldForLike("[NEWCARD]", 0, "DB"), 135, 8, 0, false, '[NEWCARD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NEWCARD->Sortable = false; // Allow sort
        $this->NEWCARD->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->NEWCARD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NEWCARD->Param, "CustomMsg");
        $this->Fields['NEWCARD'] = &$this->NEWCARD;

        // BACKCHARGE
        $this->BACKCHARGE = new DbField('cv_pasien', 'cv_pasien', 'x_BACKCHARGE', 'BACKCHARGE', '[BACKCHARGE]', '[BACKCHARGE]', 129, 1, -1, false, '[BACKCHARGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BACKCHARGE->Sortable = false; // Allow sort
        $this->BACKCHARGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BACKCHARGE->Param, "CustomMsg");
        $this->Fields['BACKCHARGE'] = &$this->BACKCHARGE;

        // ORG_ID
        $this->ORG_ID = new DbField('cv_pasien', 'cv_pasien', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = false; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // COVERAGE_ID
        $this->COVERAGE_ID = new DbField('cv_pasien', 'cv_pasien', 'x_COVERAGE_ID', 'COVERAGE_ID', '[COVERAGE_ID]', 'CAST([COVERAGE_ID] AS NVARCHAR)', 17, 1, -1, false, '[COVERAGE_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->COVERAGE_ID->Sortable = false; // Allow sort
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

        // MOTHER
        $this->MOTHER = new DbField('cv_pasien', 'cv_pasien', 'x_MOTHER', 'MOTHER', '[MOTHER]', '[MOTHER]', 200, 150, -1, false, '[MOTHER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MOTHER->Sortable = false; // Allow sort
        $this->MOTHER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MOTHER->Param, "CustomMsg");
        $this->Fields['MOTHER'] = &$this->MOTHER;

        // FATHER
        $this->FATHER = new DbField('cv_pasien', 'cv_pasien', 'x_FATHER', 'FATHER', '[FATHER]', '[FATHER]', 200, 150, -1, false, '[FATHER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FATHER->Sortable = false; // Allow sort
        $this->FATHER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FATHER->Param, "CustomMsg");
        $this->Fields['FATHER'] = &$this->FATHER;

        // SPOUSE
        $this->SPOUSE = new DbField('cv_pasien', 'cv_pasien', 'x_SPOUSE', 'SPOUSE', '[SPOUSE]', '[SPOUSE]', 200, 150, -1, false, '[SPOUSE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPOUSE->Sortable = false; // Allow sort
        $this->SPOUSE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPOUSE->Param, "CustomMsg");
        $this->Fields['SPOUSE'] = &$this->SPOUSE;

        // AKTIF
        $this->AKTIF = new DbField('cv_pasien', 'cv_pasien', 'x_AKTIF', 'AKTIF', '[AKTIF]', '[AKTIF]', 129, 1, -1, false, '[AKTIF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AKTIF->Sortable = false; // Allow sort
        switch ($CurrentLanguage) {
            case "en":
                $this->AKTIF->Lookup = new Lookup('AKTIF', 'INASIS_STATUS_PESERTA', false, 'STATUS_PESERTA_KODE', ["STATUS_PESERTA","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->AKTIF->Lookup = new Lookup('AKTIF', 'INASIS_STATUS_PESERTA', false, 'STATUS_PESERTA_KODE', ["STATUS_PESERTA","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->AKTIF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AKTIF->Param, "CustomMsg");
        $this->Fields['AKTIF'] = &$this->AKTIF;

        // TMT
        $this->TMT = new DbField('cv_pasien', 'cv_pasien', 'x_TMT', 'TMT', '[TMT]', CastDateFieldForLike("[TMT]", 11, "DB"), 135, 8, 11, false, '[TMT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TMT->Sortable = false; // Allow sort
        $this->TMT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->TMT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TMT->Param, "CustomMsg");
        $this->Fields['TMT'] = &$this->TMT;

        // TAT
        $this->TAT = new DbField('cv_pasien', 'cv_pasien', 'x_TAT', 'TAT', '[TAT]', CastDateFieldForLike("[TAT]", 11, "DB"), 135, 8, 11, false, '[TAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TAT->Sortable = false; // Allow sort
        $this->TAT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->TAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TAT->Param, "CustomMsg");
        $this->Fields['TAT'] = &$this->TAT;

        // CARD_ID
        $this->CARD_ID = new DbField('cv_pasien', 'cv_pasien', 'x_CARD_ID', 'CARD_ID', '[CARD_ID]', '[CARD_ID]', 200, 50, -1, false, '[CARD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CARD_ID->Sortable = false; // Allow sort
        $this->CARD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CARD_ID->Param, "CustomMsg");
        $this->Fields['CARD_ID'] = &$this->CARD_ID;

        // MEDICAL_NOTES
        $this->MEDICAL_NOTES = new DbField('cv_pasien', 'cv_pasien', 'x_MEDICAL_NOTES', 'MEDICAL_NOTES', '[MEDICAL_NOTES]', '[MEDICAL_NOTES]', 200, 0, -1, false, '[MEDICAL_NOTES]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->MEDICAL_NOTES->Sortable = false; // Allow sort
        $this->MEDICAL_NOTES->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEDICAL_NOTES->Param, "CustomMsg");
        $this->Fields['MEDICAL_NOTES'] = &$this->MEDICAL_NOTES;

        // ID
        $this->ID = new DbField('cv_pasien', 'cv_pasien', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 3, 4, -1, false, '[ID]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->Nullable = false; // NOT NULL field
        $this->ID->Sortable = false; // Allow sort
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID->Param, "CustomMsg");
        $this->Fields['ID'] = &$this->ID;

        // newapp
        $this->newapp = new DbField('cv_pasien', 'cv_pasien', 'x_newapp', 'newapp', '[newapp]', '[newapp]', 129, 1, -1, false, '[newapp]', false, false, false, 'FORMATTED TEXT', 'HIDDEN');
        $this->newapp->Sortable = true; // Allow sort
        $this->newapp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->newapp->Param, "CustomMsg");
        $this->Fields['newapp'] = &$this->newapp;

        // cek
        $this->cek = new DbField('cv_pasien', 'cv_pasien', 'x_cek', 'cek', '\'\'', '\'\'', 200, 1, -1, false, '\'\'', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->cek->IsCustom = true; // Custom field
        $this->cek->Sortable = true; // Allow sort
        $this->cek->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->cek->Param, "CustomMsg");
        $this->Fields['cek'] = &$this->cek;
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
        if ($this->getCurrentDetailTable() == "PASIEN_VISITATION") {
            $detailUrl = Container("PASIEN_VISITATION")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_NO_REGISTRATION", $this->NO_REGISTRATION->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "CvPasienList";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "dbo.PASIEN";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("dbo.PASIEN.*, '' AS [cek]");
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
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->NAME_OF_PASIEN->DbValue = $row['NAME_OF_PASIEN'];
        $this->PASIEN_ID->DbValue = $row['PASIEN_ID'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->KK_NO->DbValue = $row['KK_NO'];
        $this->PLACE_OF_BIRTH->DbValue = $row['PLACE_OF_BIRTH'];
        $this->DATE_OF_BIRTH->DbValue = $row['DATE_OF_BIRTH'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->NATION_ID->DbValue = $row['NATION_ID'];
        $this->EDUCATION_TYPE_CODE->DbValue = $row['EDUCATION_TYPE_CODE'];
        $this->MARITALSTATUSID->DbValue = $row['MARITALSTATUSID'];
        $this->KODE_AGAMA->DbValue = $row['KODE_AGAMA'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->RT->DbValue = $row['RT'];
        $this->RW->DbValue = $row['RW'];
        $this->JOB_ID->DbValue = $row['JOB_ID'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->ANAK_KE->DbValue = $row['ANAK_KE'];
        $this->CONTACT_ADDRESS->DbValue = $row['CONTACT_ADDRESS'];
        $this->PHONE_NUMBER->DbValue = $row['PHONE_NUMBER'];
        $this->MOBILE->DbValue = $row['MOBILE'];
        $this->_EMAIL->DbValue = $row['EMAIL'];
        $this->PHOTO_LOCATION->DbValue = $row['PHOTO_LOCATION'];
        $this->REGISTRATION_DATE->DbValue = $row['REGISTRATION_DATE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->POSTAL_CODE->DbValue = $row['POSTAL_CODE'];
        $this->GELAR->DbValue = $row['GELAR'];
        $this->BLOOD_TYPE_ID->DbValue = $row['BLOOD_TYPE_ID'];
        $this->FAMILY_STATUS_ID->DbValue = $row['FAMILY_STATUS_ID'];
        $this->ISMENINGGAL->DbValue = $row['ISMENINGGAL'];
        $this->DEATH_DATE->DbValue = $row['DEATH_DATE'];
        $this->PAYOR_ID->DbValue = $row['PAYOR_ID'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->KARYAWAN->DbValue = $row['KARYAWAN'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->NEWCARD->DbValue = $row['NEWCARD'];
        $this->BACKCHARGE->DbValue = $row['BACKCHARGE'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->COVERAGE_ID->DbValue = $row['COVERAGE_ID'];
        $this->MOTHER->DbValue = $row['MOTHER'];
        $this->FATHER->DbValue = $row['FATHER'];
        $this->SPOUSE->DbValue = $row['SPOUSE'];
        $this->AKTIF->DbValue = $row['AKTIF'];
        $this->TMT->DbValue = $row['TMT'];
        $this->TAT->DbValue = $row['TAT'];
        $this->CARD_ID->DbValue = $row['CARD_ID'];
        $this->MEDICAL_NOTES->DbValue = $row['MEDICAL_NOTES'];
        $this->ID->DbValue = $row['ID'];
        $this->newapp->DbValue = $row['newapp'];
        $this->cek->DbValue = $row['cek'];
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
        return $_SESSION[$name] ?? GetUrl("CvPasienList");
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
        if ($pageName == "CvPasienView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CvPasienEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CvPasienAdd") {
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
                return "CvPasienView";
            case Config("API_ADD_ACTION"):
                return "CvPasienAdd";
            case Config("API_EDIT_ACTION"):
                return "CvPasienEdit";
            case Config("API_DELETE_ACTION"):
                return "CvPasienDelete";
            case Config("API_LIST_ACTION"):
                return "CvPasienList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CvPasienList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CvPasienView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CvPasienView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CvPasienAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CvPasienAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CvPasienEdit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CvPasienEdit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
            $url = $this->keyUrl("CvPasienAdd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CvPasienAdd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
        return $this->keyUrl("CvPasienDelete", $this->getUrlParm());
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
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->NAME_OF_PASIEN->setDbValue($row['NAME_OF_PASIEN']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->KK_NO->setDbValue($row['KK_NO']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->DATE_OF_BIRTH->setDbValue($row['DATE_OF_BIRTH']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->NATION_ID->setDbValue($row['NATION_ID']);
        $this->EDUCATION_TYPE_CODE->setDbValue($row['EDUCATION_TYPE_CODE']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->JOB_ID->setDbValue($row['JOB_ID']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->ANAK_KE->setDbValue($row['ANAK_KE']);
        $this->CONTACT_ADDRESS->setDbValue($row['CONTACT_ADDRESS']);
        $this->PHONE_NUMBER->setDbValue($row['PHONE_NUMBER']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->PHOTO_LOCATION->setDbValue($row['PHOTO_LOCATION']);
        $this->REGISTRATION_DATE->setDbValue($row['REGISTRATION_DATE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->POSTAL_CODE->setDbValue($row['POSTAL_CODE']);
        $this->GELAR->setDbValue($row['GELAR']);
        $this->BLOOD_TYPE_ID->setDbValue($row['BLOOD_TYPE_ID']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->ISMENINGGAL->setDbValue($row['ISMENINGGAL']);
        $this->DEATH_DATE->setDbValue($row['DEATH_DATE']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->KARYAWAN->setDbValue($row['KARYAWAN']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->NEWCARD->setDbValue($row['NEWCARD']);
        $this->BACKCHARGE->setDbValue($row['BACKCHARGE']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->COVERAGE_ID->setDbValue($row['COVERAGE_ID']);
        $this->MOTHER->setDbValue($row['MOTHER']);
        $this->FATHER->setDbValue($row['FATHER']);
        $this->SPOUSE->setDbValue($row['SPOUSE']);
        $this->AKTIF->setDbValue($row['AKTIF']);
        $this->TMT->setDbValue($row['TMT']);
        $this->TAT->setDbValue($row['TAT']);
        $this->CARD_ID->setDbValue($row['CARD_ID']);
        $this->MEDICAL_NOTES->setDbValue($row['MEDICAL_NOTES']);
        $this->ID->setDbValue($row['ID']);
        $this->newapp->setDbValue($row['newapp']);
        $this->cek->setDbValue($row['cek']);
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

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->CellCssStyle = "white-space: nowrap;";

        // PASIEN_ID
        $this->PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // KK_NO
        $this->KK_NO->CellCssStyle = "white-space: nowrap;";

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->CellCssStyle = "white-space: nowrap;";

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // NATION_ID
        $this->NATION_ID->CellCssStyle = "white-space: nowrap;";

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->CellCssStyle = "white-space: nowrap;";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->CellCssStyle = "white-space: nowrap;";

        // KODE_AGAMA
        $this->KODE_AGAMA->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // RT
        $this->RT->CellCssStyle = "white-space: nowrap;";

        // RW
        $this->RW->CellCssStyle = "white-space: nowrap;";

        // JOB_ID
        $this->JOB_ID->CellCssStyle = "white-space: nowrap;";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->CellCssStyle = "white-space: nowrap;";

        // ANAK_KE
        $this->ANAK_KE->CellCssStyle = "white-space: nowrap;";

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->CellCssStyle = "white-space: nowrap;";

        // PHONE_NUMBER
        $this->PHONE_NUMBER->CellCssStyle = "white-space: nowrap;";

        // MOBILE
        $this->MOBILE->CellCssStyle = "white-space: nowrap;";

        // EMAIL
        $this->_EMAIL->CellCssStyle = "white-space: nowrap;";

        // PHOTO_LOCATION
        $this->PHOTO_LOCATION->CellCssStyle = "white-space: nowrap;";

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_BY
        $this->MODIFIED_BY->CellCssStyle = "white-space: nowrap;";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->CellCssStyle = "white-space: nowrap;";

        // POSTAL_CODE
        $this->POSTAL_CODE->CellCssStyle = "white-space: nowrap;";

        // GELAR
        $this->GELAR->CellCssStyle = "white-space: nowrap;";

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID->CellCssStyle = "white-space: nowrap;";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->CellCssStyle = "white-space: nowrap;";

        // ISMENINGGAL
        $this->ISMENINGGAL->CellCssStyle = "white-space: nowrap;";

        // DEATH_DATE
        $this->DEATH_DATE->CellCssStyle = "white-space: nowrap;";

        // PAYOR_ID
        $this->PAYOR_ID->CellCssStyle = "white-space: nowrap;";

        // CLASS_ID
        $this->CLASS_ID->CellCssStyle = "white-space: nowrap;";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->CellCssStyle = "white-space: nowrap;";

        // KARYAWAN
        $this->KARYAWAN->CellCssStyle = "white-space: nowrap;";

        // DESCRIPTION
        $this->DESCRIPTION->CellCssStyle = "white-space: nowrap;";

        // NEWCARD
        $this->NEWCARD->CellCssStyle = "white-space: nowrap;";

        // BACKCHARGE
        $this->BACKCHARGE->CellCssStyle = "white-space: nowrap;";

        // ORG_ID
        $this->ORG_ID->CellCssStyle = "white-space: nowrap;";

        // COVERAGE_ID
        $this->COVERAGE_ID->CellCssStyle = "white-space: nowrap;";

        // MOTHER
        $this->MOTHER->CellCssStyle = "white-space: nowrap;";

        // FATHER
        $this->FATHER->CellCssStyle = "white-space: nowrap;";

        // SPOUSE
        $this->SPOUSE->CellCssStyle = "white-space: nowrap;";

        // AKTIF
        $this->AKTIF->CellCssStyle = "white-space: nowrap;";

        // TMT
        $this->TMT->CellCssStyle = "white-space: nowrap;";

        // TAT
        $this->TAT->CellCssStyle = "white-space: nowrap;";

        // CARD_ID
        $this->CARD_ID->CellCssStyle = "white-space: nowrap;";

        // MEDICAL_NOTES
        $this->MEDICAL_NOTES->CellCssStyle = "white-space: nowrap;";

        // ID
        $this->ID->CellCssStyle = "white-space: nowrap;";

        // newapp

        // cek

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->ViewValue = $this->NAME_OF_PASIEN->CurrentValue;
        $this->NAME_OF_PASIEN->ViewCustomAttributes = "";

        // PASIEN_ID
        $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // KK_NO
        $this->KK_NO->ViewValue = $this->KK_NO->CurrentValue;
        $this->KK_NO->ViewCustomAttributes = "";

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
        $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->ViewValue = $this->DATE_OF_BIRTH->CurrentValue;
        $this->DATE_OF_BIRTH->ViewValue = FormatDateTime($this->DATE_OF_BIRTH->ViewValue, 11);
        $this->DATE_OF_BIRTH->ViewCustomAttributes = "";

        // GENDER
        $curVal = trim(strval($this->GENDER->CurrentValue));
        if ($curVal != "") {
            $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
            if ($this->GENDER->ViewValue === null) { // Lookup from database
                $filterWrk = "[GENDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "[GENDER] = 1 OR [GENDER] = 2";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->GENDER->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
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

        // NATION_ID
        $this->NATION_ID->ViewValue = $this->NATION_ID->CurrentValue;
        $this->NATION_ID->ViewValue = FormatNumber($this->NATION_ID->ViewValue, 0, -2, -2, -2);
        $this->NATION_ID->ViewCustomAttributes = "";

        // EDUCATION_TYPE_CODE
        $curVal = trim(strval($this->EDUCATION_TYPE_CODE->CurrentValue));
        if ($curVal != "") {
            $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->lookupCacheOption($curVal);
            if ($this->EDUCATION_TYPE_CODE->ViewValue === null) { // Lookup from database
                $filterWrk = "[EDUCATION_TYPE_CODE]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->EDUCATION_TYPE_CODE->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->EDUCATION_TYPE_CODE->Lookup->renderViewRow($rswrk[0]);
                    $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->displayValue($arwrk);
                } else {
                    $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
                }
            }
        } else {
            $this->EDUCATION_TYPE_CODE->ViewValue = null;
        }
        $this->EDUCATION_TYPE_CODE->ViewCustomAttributes = "";

        // MARITALSTATUSID
        $curVal = trim(strval($this->MARITALSTATUSID->CurrentValue));
        if ($curVal != "") {
            $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->lookupCacheOption($curVal);
            if ($this->MARITALSTATUSID->ViewValue === null) { // Lookup from database
                $filterWrk = "[MARITALSTATUSID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->MARITALSTATUSID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MARITALSTATUSID->Lookup->renderViewRow($rswrk[0]);
                    $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->displayValue($arwrk);
                } else {
                    $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
                }
            }
        } else {
            $this->MARITALSTATUSID->ViewValue = null;
        }
        $this->MARITALSTATUSID->ViewCustomAttributes = "";

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

        // RT
        $this->RT->ViewValue = $this->RT->CurrentValue;
        $this->RT->ViewCustomAttributes = "";

        // RW
        $this->RW->ViewValue = $this->RW->CurrentValue;
        $this->RW->ViewCustomAttributes = "";

        // JOB_ID
        $curVal = trim(strval($this->JOB_ID->CurrentValue));
        if ($curVal != "") {
            $this->JOB_ID->ViewValue = $this->JOB_ID->lookupCacheOption($curVal);
            if ($this->JOB_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[JOB_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->JOB_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->JOB_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->JOB_ID->ViewValue = $this->JOB_ID->displayValue($arwrk);
                } else {
                    $this->JOB_ID->ViewValue = $this->JOB_ID->CurrentValue;
                }
            }
        } else {
            $this->JOB_ID->ViewValue = null;
        }
        $this->JOB_ID->ViewCustomAttributes = "";

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

        // ANAK_KE
        $this->ANAK_KE->ViewValue = $this->ANAK_KE->CurrentValue;
        $this->ANAK_KE->ViewValue = FormatNumber($this->ANAK_KE->ViewValue, 0, -2, -2, -2);
        $this->ANAK_KE->ViewCustomAttributes = "";

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->ViewValue = $this->CONTACT_ADDRESS->CurrentValue;
        $this->CONTACT_ADDRESS->ViewCustomAttributes = "";

        // PHONE_NUMBER
        $this->PHONE_NUMBER->ViewValue = $this->PHONE_NUMBER->CurrentValue;
        $this->PHONE_NUMBER->ViewCustomAttributes = "";

        // MOBILE
        $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->ViewCustomAttributes = "";

        // EMAIL
        $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->ViewCustomAttributes = "";

        // PHOTO_LOCATION
        $this->PHOTO_LOCATION->ViewValue = $this->PHOTO_LOCATION->CurrentValue;
        $this->PHOTO_LOCATION->ViewCustomAttributes = "";

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE->ViewValue = $this->REGISTRATION_DATE->CurrentValue;
        $this->REGISTRATION_DATE->ViewValue = FormatDateTime($this->REGISTRATION_DATE->ViewValue, 11);
        $this->REGISTRATION_DATE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 11);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->ViewCustomAttributes = "";

        // POSTAL_CODE
        $this->POSTAL_CODE->ViewValue = $this->POSTAL_CODE->CurrentValue;
        $this->POSTAL_CODE->ViewCustomAttributes = "";

        // GELAR
        $this->GELAR->ViewValue = $this->GELAR->CurrentValue;
        $this->GELAR->ViewCustomAttributes = "";

        // BLOOD_TYPE_ID
        $curVal = trim(strval($this->BLOOD_TYPE_ID->CurrentValue));
        if ($curVal != "") {
            $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->lookupCacheOption($curVal);
            if ($this->BLOOD_TYPE_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[BLOOD_TYPE_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->BLOOD_TYPE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->BLOOD_TYPE_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->displayValue($arwrk);
                } else {
                    $this->BLOOD_TYPE_ID->ViewValue = $this->BLOOD_TYPE_ID->CurrentValue;
                }
            }
        } else {
            $this->BLOOD_TYPE_ID->ViewValue = null;
        }
        $this->BLOOD_TYPE_ID->ViewCustomAttributes = "";

        // FAMILY_STATUS_ID
        $curVal = trim(strval($this->FAMILY_STATUS_ID->CurrentValue));
        if ($curVal != "") {
            $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->lookupCacheOption($curVal);
            if ($this->FAMILY_STATUS_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[KDJNSPESERTA]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->FAMILY_STATUS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->FAMILY_STATUS_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->displayValue($arwrk);
                } else {
                    $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
                }
            }
        } else {
            $this->FAMILY_STATUS_ID->ViewValue = null;
        }
        $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

        // ISMENINGGAL
        $this->ISMENINGGAL->ViewValue = $this->ISMENINGGAL->CurrentValue;
        $this->ISMENINGGAL->ViewCustomAttributes = "";

        // DEATH_DATE
        $this->DEATH_DATE->ViewValue = $this->DEATH_DATE->CurrentValue;
        $this->DEATH_DATE->ViewValue = FormatDateTime($this->DEATH_DATE->ViewValue, 11);
        $this->DEATH_DATE->ViewCustomAttributes = "";

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

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // KARYAWAN
        $this->KARYAWAN->ViewValue = $this->KARYAWAN->CurrentValue;
        $this->KARYAWAN->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // NEWCARD
        $this->NEWCARD->ViewValue = $this->NEWCARD->CurrentValue;
        $this->NEWCARD->ViewValue = FormatDateTime($this->NEWCARD->ViewValue, 0);
        $this->NEWCARD->ViewCustomAttributes = "";

        // BACKCHARGE
        $this->BACKCHARGE->ViewValue = $this->BACKCHARGE->CurrentValue;
        $this->BACKCHARGE->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

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

        // MOTHER
        $this->MOTHER->ViewValue = $this->MOTHER->CurrentValue;
        $this->MOTHER->ViewCustomAttributes = "";

        // FATHER
        $this->FATHER->ViewValue = $this->FATHER->CurrentValue;
        $this->FATHER->ViewCustomAttributes = "";

        // SPOUSE
        $this->SPOUSE->ViewValue = $this->SPOUSE->CurrentValue;
        $this->SPOUSE->ViewCustomAttributes = "";

        // AKTIF
        $this->AKTIF->ViewValue = $this->AKTIF->CurrentValue;
        $curVal = trim(strval($this->AKTIF->CurrentValue));
        if ($curVal != "") {
            $this->AKTIF->ViewValue = $this->AKTIF->lookupCacheOption($curVal);
            if ($this->AKTIF->ViewValue === null) { // Lookup from database
                $filterWrk = "[STATUS_PESERTA_KODE]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->AKTIF->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->AKTIF->Lookup->renderViewRow($rswrk[0]);
                    $this->AKTIF->ViewValue = $this->AKTIF->displayValue($arwrk);
                } else {
                    $this->AKTIF->ViewValue = $this->AKTIF->CurrentValue;
                }
            }
        } else {
            $this->AKTIF->ViewValue = null;
        }
        $this->AKTIF->ViewCustomAttributes = "";

        // TMT
        $this->TMT->ViewValue = $this->TMT->CurrentValue;
        $this->TMT->ViewValue = FormatDateTime($this->TMT->ViewValue, 11);
        $this->TMT->ViewCustomAttributes = "";

        // TAT
        $this->TAT->ViewValue = $this->TAT->CurrentValue;
        $this->TAT->ViewValue = FormatDateTime($this->TAT->ViewValue, 11);
        $this->TAT->ViewCustomAttributes = "";

        // CARD_ID
        $this->CARD_ID->ViewValue = $this->CARD_ID->CurrentValue;
        $this->CARD_ID->ViewCustomAttributes = "";

        // MEDICAL_NOTES
        $this->MEDICAL_NOTES->ViewValue = $this->MEDICAL_NOTES->CurrentValue;
        $this->MEDICAL_NOTES->ViewCustomAttributes = "";

        // ID
        $this->ID->ViewValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // newapp
        $this->newapp->ViewValue = $this->newapp->CurrentValue;
        $this->newapp->ViewCustomAttributes = "";

        // cek
        $this->cek->ViewValue = $this->cek->CurrentValue;
        $this->cek->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
        $this->NAME_OF_PASIEN->HrefValue = "";
        $this->NAME_OF_PASIEN->TooltipValue = "";

        // PASIEN_ID
        $this->PASIEN_ID->LinkCustomAttributes = "";
        $this->PASIEN_ID->HrefValue = "";
        $this->PASIEN_ID->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // KK_NO
        $this->KK_NO->LinkCustomAttributes = "";
        $this->KK_NO->HrefValue = "";
        $this->KK_NO->TooltipValue = "";

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
        $this->PLACE_OF_BIRTH->HrefValue = "";
        $this->PLACE_OF_BIRTH->TooltipValue = "";

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->LinkCustomAttributes = "";
        $this->DATE_OF_BIRTH->HrefValue = "";
        $this->DATE_OF_BIRTH->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // NATION_ID
        $this->NATION_ID->LinkCustomAttributes = "";
        $this->NATION_ID->HrefValue = "";
        $this->NATION_ID->TooltipValue = "";

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->LinkCustomAttributes = "";
        $this->EDUCATION_TYPE_CODE->HrefValue = "";
        $this->EDUCATION_TYPE_CODE->TooltipValue = "";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->LinkCustomAttributes = "";
        $this->MARITALSTATUSID->HrefValue = "";
        $this->MARITALSTATUSID->TooltipValue = "";

        // KODE_AGAMA
        $this->KODE_AGAMA->LinkCustomAttributes = "";
        $this->KODE_AGAMA->HrefValue = "";
        $this->KODE_AGAMA->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // RT
        $this->RT->LinkCustomAttributes = "";
        $this->RT->HrefValue = "";
        $this->RT->TooltipValue = "";

        // RW
        $this->RW->LinkCustomAttributes = "";
        $this->RW->HrefValue = "";
        $this->RW->TooltipValue = "";

        // JOB_ID
        $this->JOB_ID->LinkCustomAttributes = "";
        $this->JOB_ID->HrefValue = "";
        $this->JOB_ID->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // ANAK_KE
        $this->ANAK_KE->LinkCustomAttributes = "";
        $this->ANAK_KE->HrefValue = "";
        $this->ANAK_KE->TooltipValue = "";

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->LinkCustomAttributes = "";
        $this->CONTACT_ADDRESS->HrefValue = "";
        $this->CONTACT_ADDRESS->TooltipValue = "";

        // PHONE_NUMBER
        $this->PHONE_NUMBER->LinkCustomAttributes = "";
        $this->PHONE_NUMBER->HrefValue = "";
        $this->PHONE_NUMBER->TooltipValue = "";

        // MOBILE
        $this->MOBILE->LinkCustomAttributes = "";
        $this->MOBILE->HrefValue = "";
        $this->MOBILE->TooltipValue = "";

        // EMAIL
        $this->_EMAIL->LinkCustomAttributes = "";
        $this->_EMAIL->HrefValue = "";
        $this->_EMAIL->TooltipValue = "";

        // PHOTO_LOCATION
        $this->PHOTO_LOCATION->LinkCustomAttributes = "";
        $this->PHOTO_LOCATION->HrefValue = "";
        $this->PHOTO_LOCATION->TooltipValue = "";

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE->LinkCustomAttributes = "";
        $this->REGISTRATION_DATE->HrefValue = "";
        $this->REGISTRATION_DATE->TooltipValue = "";

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

        // POSTAL_CODE
        $this->POSTAL_CODE->LinkCustomAttributes = "";
        $this->POSTAL_CODE->HrefValue = "";
        $this->POSTAL_CODE->TooltipValue = "";

        // GELAR
        $this->GELAR->LinkCustomAttributes = "";
        $this->GELAR->HrefValue = "";
        $this->GELAR->TooltipValue = "";

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID->LinkCustomAttributes = "";
        $this->BLOOD_TYPE_ID->HrefValue = "";
        $this->BLOOD_TYPE_ID->TooltipValue = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
        $this->FAMILY_STATUS_ID->HrefValue = "";
        $this->FAMILY_STATUS_ID->TooltipValue = "";

        // ISMENINGGAL
        $this->ISMENINGGAL->LinkCustomAttributes = "";
        $this->ISMENINGGAL->HrefValue = "";
        $this->ISMENINGGAL->TooltipValue = "";

        // DEATH_DATE
        $this->DEATH_DATE->LinkCustomAttributes = "";
        $this->DEATH_DATE->HrefValue = "";
        $this->DEATH_DATE->TooltipValue = "";

        // PAYOR_ID
        $this->PAYOR_ID->LinkCustomAttributes = "";
        $this->PAYOR_ID->HrefValue = "";
        $this->PAYOR_ID->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // KARYAWAN
        $this->KARYAWAN->LinkCustomAttributes = "";
        $this->KARYAWAN->HrefValue = "";
        $this->KARYAWAN->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // NEWCARD
        $this->NEWCARD->LinkCustomAttributes = "";
        $this->NEWCARD->HrefValue = "";
        $this->NEWCARD->TooltipValue = "";

        // BACKCHARGE
        $this->BACKCHARGE->LinkCustomAttributes = "";
        $this->BACKCHARGE->HrefValue = "";
        $this->BACKCHARGE->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // COVERAGE_ID
        $this->COVERAGE_ID->LinkCustomAttributes = "";
        $this->COVERAGE_ID->HrefValue = "";
        $this->COVERAGE_ID->TooltipValue = "";

        // MOTHER
        $this->MOTHER->LinkCustomAttributes = "";
        $this->MOTHER->HrefValue = "";
        $this->MOTHER->TooltipValue = "";

        // FATHER
        $this->FATHER->LinkCustomAttributes = "";
        $this->FATHER->HrefValue = "";
        $this->FATHER->TooltipValue = "";

        // SPOUSE
        $this->SPOUSE->LinkCustomAttributes = "";
        $this->SPOUSE->HrefValue = "";
        $this->SPOUSE->TooltipValue = "";

        // AKTIF
        $this->AKTIF->LinkCustomAttributes = "";
        $this->AKTIF->HrefValue = "";
        $this->AKTIF->TooltipValue = "";

        // TMT
        $this->TMT->LinkCustomAttributes = "";
        $this->TMT->HrefValue = "";
        $this->TMT->TooltipValue = "";

        // TAT
        $this->TAT->LinkCustomAttributes = "";
        $this->TAT->HrefValue = "";
        $this->TAT->TooltipValue = "";

        // CARD_ID
        $this->CARD_ID->LinkCustomAttributes = "";
        $this->CARD_ID->HrefValue = "";
        $this->CARD_ID->TooltipValue = "";

        // MEDICAL_NOTES
        $this->MEDICAL_NOTES->LinkCustomAttributes = "";
        $this->MEDICAL_NOTES->HrefValue = "";
        $this->MEDICAL_NOTES->TooltipValue = "";

        // ID
        $this->ID->LinkCustomAttributes = "";
        $this->ID->HrefValue = "";
        $this->ID->TooltipValue = "";

        // newapp
        $this->newapp->LinkCustomAttributes = "";
        $this->newapp->HrefValue = "";
        $this->newapp->TooltipValue = "";

        // cek
        $this->cek->LinkCustomAttributes = "";
        $this->cek->HrefValue = "";
        $this->cek->TooltipValue = "";

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
        $this->NO_REGISTRATION->EditCustomAttributes = 'readonly';
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->EditAttrs["class"] = "form-control";
        $this->NAME_OF_PASIEN->EditCustomAttributes = "";
        if (!$this->NAME_OF_PASIEN->Raw) {
            $this->NAME_OF_PASIEN->CurrentValue = HtmlDecode($this->NAME_OF_PASIEN->CurrentValue);
        }
        $this->NAME_OF_PASIEN->EditValue = $this->NAME_OF_PASIEN->CurrentValue;
        $this->NAME_OF_PASIEN->PlaceHolder = RemoveHtml($this->NAME_OF_PASIEN->caption());

        // PASIEN_ID
        $this->PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->PASIEN_ID->EditCustomAttributes = "";
        if (!$this->PASIEN_ID->Raw) {
            $this->PASIEN_ID->CurrentValue = HtmlDecode($this->PASIEN_ID->CurrentValue);
        }
        $this->PASIEN_ID->EditValue = $this->PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // KK_NO
        $this->KK_NO->EditAttrs["class"] = "form-control";
        $this->KK_NO->EditCustomAttributes = "";
        if (!$this->KK_NO->Raw) {
            $this->KK_NO->CurrentValue = HtmlDecode($this->KK_NO->CurrentValue);
        }
        $this->KK_NO->EditValue = $this->KK_NO->CurrentValue;
        $this->KK_NO->PlaceHolder = RemoveHtml($this->KK_NO->caption());

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->EditAttrs["class"] = "form-control";
        $this->PLACE_OF_BIRTH->EditCustomAttributes = "";
        if (!$this->PLACE_OF_BIRTH->Raw) {
            $this->PLACE_OF_BIRTH->CurrentValue = HtmlDecode($this->PLACE_OF_BIRTH->CurrentValue);
        }
        $this->PLACE_OF_BIRTH->EditValue = $this->PLACE_OF_BIRTH->CurrentValue;
        $this->PLACE_OF_BIRTH->PlaceHolder = RemoveHtml($this->PLACE_OF_BIRTH->caption());

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->EditAttrs["class"] = "form-control";
        $this->DATE_OF_BIRTH->EditCustomAttributes = "";
        $this->DATE_OF_BIRTH->EditValue = FormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 11);
        $this->DATE_OF_BIRTH->PlaceHolder = RemoveHtml($this->DATE_OF_BIRTH->caption());

        // GENDER
        $this->GENDER->EditCustomAttributes = "";
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // NATION_ID
        $this->NATION_ID->EditAttrs["class"] = "form-control";
        $this->NATION_ID->EditCustomAttributes = "";
        $this->NATION_ID->EditValue = $this->NATION_ID->CurrentValue;
        $this->NATION_ID->PlaceHolder = RemoveHtml($this->NATION_ID->caption());

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->EditAttrs["class"] = "form-control";
        $this->EDUCATION_TYPE_CODE->EditCustomAttributes = "";
        $this->EDUCATION_TYPE_CODE->PlaceHolder = RemoveHtml($this->EDUCATION_TYPE_CODE->caption());

        // MARITALSTATUSID
        $this->MARITALSTATUSID->EditAttrs["class"] = "form-control";
        $this->MARITALSTATUSID->EditCustomAttributes = "";
        $this->MARITALSTATUSID->PlaceHolder = RemoveHtml($this->MARITALSTATUSID->caption());

        // KODE_AGAMA
        $this->KODE_AGAMA->EditAttrs["class"] = "form-control";
        $this->KODE_AGAMA->EditCustomAttributes = "";
        $this->KODE_AGAMA->PlaceHolder = RemoveHtml($this->KODE_AGAMA->caption());

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // RT
        $this->RT->EditAttrs["class"] = "form-control";
        $this->RT->EditCustomAttributes = "";
        if (!$this->RT->Raw) {
            $this->RT->CurrentValue = HtmlDecode($this->RT->CurrentValue);
        }
        $this->RT->EditValue = $this->RT->CurrentValue;
        $this->RT->PlaceHolder = RemoveHtml($this->RT->caption());

        // RW
        $this->RW->EditAttrs["class"] = "form-control";
        $this->RW->EditCustomAttributes = "";
        if (!$this->RW->Raw) {
            $this->RW->CurrentValue = HtmlDecode($this->RW->CurrentValue);
        }
        $this->RW->EditValue = $this->RW->CurrentValue;
        $this->RW->PlaceHolder = RemoveHtml($this->RW->caption());

        // JOB_ID
        $this->JOB_ID->EditAttrs["class"] = "form-control";
        $this->JOB_ID->EditCustomAttributes = "";
        $this->JOB_ID->PlaceHolder = RemoveHtml($this->JOB_ID->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // ANAK_KE
        $this->ANAK_KE->EditAttrs["class"] = "form-control";
        $this->ANAK_KE->EditCustomAttributes = "";
        $this->ANAK_KE->EditValue = $this->ANAK_KE->CurrentValue;
        $this->ANAK_KE->PlaceHolder = RemoveHtml($this->ANAK_KE->caption());

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->EditAttrs["class"] = "form-control";
        $this->CONTACT_ADDRESS->EditCustomAttributes = "";
        $this->CONTACT_ADDRESS->EditValue = $this->CONTACT_ADDRESS->CurrentValue;
        $this->CONTACT_ADDRESS->PlaceHolder = RemoveHtml($this->CONTACT_ADDRESS->caption());

        // PHONE_NUMBER
        $this->PHONE_NUMBER->EditAttrs["class"] = "form-control";
        $this->PHONE_NUMBER->EditCustomAttributes = "";
        if (!$this->PHONE_NUMBER->Raw) {
            $this->PHONE_NUMBER->CurrentValue = HtmlDecode($this->PHONE_NUMBER->CurrentValue);
        }
        $this->PHONE_NUMBER->EditValue = $this->PHONE_NUMBER->CurrentValue;
        $this->PHONE_NUMBER->PlaceHolder = RemoveHtml($this->PHONE_NUMBER->caption());

        // MOBILE
        $this->MOBILE->EditAttrs["class"] = "form-control";
        $this->MOBILE->EditCustomAttributes = "";
        if (!$this->MOBILE->Raw) {
            $this->MOBILE->CurrentValue = HtmlDecode($this->MOBILE->CurrentValue);
        }
        $this->MOBILE->EditValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->PlaceHolder = RemoveHtml($this->MOBILE->caption());

        // EMAIL
        $this->_EMAIL->EditAttrs["class"] = "form-control";
        $this->_EMAIL->EditCustomAttributes = "";
        if (!$this->_EMAIL->Raw) {
            $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
        }
        $this->_EMAIL->EditValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

        // PHOTO_LOCATION
        $this->PHOTO_LOCATION->EditAttrs["class"] = "form-control";
        $this->PHOTO_LOCATION->EditCustomAttributes = "";
        if (!$this->PHOTO_LOCATION->Raw) {
            $this->PHOTO_LOCATION->CurrentValue = HtmlDecode($this->PHOTO_LOCATION->CurrentValue);
        }
        $this->PHOTO_LOCATION->EditValue = $this->PHOTO_LOCATION->CurrentValue;
        $this->PHOTO_LOCATION->PlaceHolder = RemoveHtml($this->PHOTO_LOCATION->caption());

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE->EditAttrs["class"] = "form-control";
        $this->REGISTRATION_DATE->EditCustomAttributes = 'readonly';
        $this->REGISTRATION_DATE->EditValue = $this->REGISTRATION_DATE->CurrentValue;
        $this->REGISTRATION_DATE->EditValue = FormatDateTime($this->REGISTRATION_DATE->EditValue, 11);
        $this->REGISTRATION_DATE->ViewCustomAttributes = "";

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM
        $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
        $this->MODIFIED_FROM->EditCustomAttributes = "";
        if (!$this->MODIFIED_FROM->Raw) {
            $this->MODIFIED_FROM->CurrentValue = HtmlDecode($this->MODIFIED_FROM->CurrentValue);
        }
        $this->MODIFIED_FROM->EditValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

        // POSTAL_CODE
        $this->POSTAL_CODE->EditAttrs["class"] = "form-control";
        $this->POSTAL_CODE->EditCustomAttributes = "";
        if (!$this->POSTAL_CODE->Raw) {
            $this->POSTAL_CODE->CurrentValue = HtmlDecode($this->POSTAL_CODE->CurrentValue);
        }
        $this->POSTAL_CODE->EditValue = $this->POSTAL_CODE->CurrentValue;
        $this->POSTAL_CODE->PlaceHolder = RemoveHtml($this->POSTAL_CODE->caption());

        // GELAR
        $this->GELAR->EditAttrs["class"] = "form-control";
        $this->GELAR->EditCustomAttributes = "";
        if (!$this->GELAR->Raw) {
            $this->GELAR->CurrentValue = HtmlDecode($this->GELAR->CurrentValue);
        }
        $this->GELAR->EditValue = $this->GELAR->CurrentValue;
        $this->GELAR->PlaceHolder = RemoveHtml($this->GELAR->caption());

        // BLOOD_TYPE_ID
        $this->BLOOD_TYPE_ID->EditAttrs["class"] = "form-control";
        $this->BLOOD_TYPE_ID->EditCustomAttributes = "";
        $this->BLOOD_TYPE_ID->PlaceHolder = RemoveHtml($this->BLOOD_TYPE_ID->caption());

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->EditAttrs["class"] = "form-control";
        $this->FAMILY_STATUS_ID->EditCustomAttributes = "";
        $curVal = trim(strval($this->FAMILY_STATUS_ID->CurrentValue));
        if ($curVal != "") {
            $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->lookupCacheOption($curVal);
            if ($this->FAMILY_STATUS_ID->EditValue === null) { // Lookup from database
                $filterWrk = "[KDJNSPESERTA]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->FAMILY_STATUS_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->FAMILY_STATUS_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->displayValue($arwrk);
                } else {
                    $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->CurrentValue;
                }
            }
        } else {
            $this->FAMILY_STATUS_ID->EditValue = null;
        }
        $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

        // ISMENINGGAL
        $this->ISMENINGGAL->EditAttrs["class"] = "form-control";
        $this->ISMENINGGAL->EditCustomAttributes = "";
        if (!$this->ISMENINGGAL->Raw) {
            $this->ISMENINGGAL->CurrentValue = HtmlDecode($this->ISMENINGGAL->CurrentValue);
        }
        $this->ISMENINGGAL->EditValue = $this->ISMENINGGAL->CurrentValue;
        $this->ISMENINGGAL->PlaceHolder = RemoveHtml($this->ISMENINGGAL->caption());

        // DEATH_DATE
        $this->DEATH_DATE->EditAttrs["class"] = "form-control";
        $this->DEATH_DATE->EditCustomAttributes = "";
        $this->DEATH_DATE->EditValue = FormatDateTime($this->DEATH_DATE->CurrentValue, 11);
        $this->DEATH_DATE->PlaceHolder = RemoveHtml($this->DEATH_DATE->caption());

        // PAYOR_ID
        $this->PAYOR_ID->EditAttrs["class"] = "form-control";
        $this->PAYOR_ID->EditCustomAttributes = "";
        $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // KARYAWAN
        $this->KARYAWAN->EditAttrs["class"] = "form-control";
        $this->KARYAWAN->EditCustomAttributes = "";
        if (!$this->KARYAWAN->Raw) {
            $this->KARYAWAN->CurrentValue = HtmlDecode($this->KARYAWAN->CurrentValue);
        }
        $this->KARYAWAN->EditValue = $this->KARYAWAN->CurrentValue;
        $this->KARYAWAN->PlaceHolder = RemoveHtml($this->KARYAWAN->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // NEWCARD
        $this->NEWCARD->EditAttrs["class"] = "form-control";
        $this->NEWCARD->EditCustomAttributes = "";
        $this->NEWCARD->EditValue = FormatDateTime($this->NEWCARD->CurrentValue, 8);
        $this->NEWCARD->PlaceHolder = RemoveHtml($this->NEWCARD->caption());

        // BACKCHARGE
        $this->BACKCHARGE->EditAttrs["class"] = "form-control";
        $this->BACKCHARGE->EditCustomAttributes = "";
        if (!$this->BACKCHARGE->Raw) {
            $this->BACKCHARGE->CurrentValue = HtmlDecode($this->BACKCHARGE->CurrentValue);
        }
        $this->BACKCHARGE->EditValue = $this->BACKCHARGE->CurrentValue;
        $this->BACKCHARGE->PlaceHolder = RemoveHtml($this->BACKCHARGE->caption());

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // COVERAGE_ID
        $this->COVERAGE_ID->EditAttrs["class"] = "form-control";
        $this->COVERAGE_ID->EditCustomAttributes = "";
        $this->COVERAGE_ID->PlaceHolder = RemoveHtml($this->COVERAGE_ID->caption());

        // MOTHER
        $this->MOTHER->EditAttrs["class"] = "form-control";
        $this->MOTHER->EditCustomAttributes = "";
        if (!$this->MOTHER->Raw) {
            $this->MOTHER->CurrentValue = HtmlDecode($this->MOTHER->CurrentValue);
        }
        $this->MOTHER->EditValue = $this->MOTHER->CurrentValue;
        $this->MOTHER->PlaceHolder = RemoveHtml($this->MOTHER->caption());

        // FATHER
        $this->FATHER->EditAttrs["class"] = "form-control";
        $this->FATHER->EditCustomAttributes = "";
        if (!$this->FATHER->Raw) {
            $this->FATHER->CurrentValue = HtmlDecode($this->FATHER->CurrentValue);
        }
        $this->FATHER->EditValue = $this->FATHER->CurrentValue;
        $this->FATHER->PlaceHolder = RemoveHtml($this->FATHER->caption());

        // SPOUSE
        $this->SPOUSE->EditAttrs["class"] = "form-control";
        $this->SPOUSE->EditCustomAttributes = "";
        if (!$this->SPOUSE->Raw) {
            $this->SPOUSE->CurrentValue = HtmlDecode($this->SPOUSE->CurrentValue);
        }
        $this->SPOUSE->EditValue = $this->SPOUSE->CurrentValue;
        $this->SPOUSE->PlaceHolder = RemoveHtml($this->SPOUSE->caption());

        // AKTIF
        $this->AKTIF->EditAttrs["class"] = "form-control";
        $this->AKTIF->EditCustomAttributes = "";
        $this->AKTIF->EditValue = $this->AKTIF->CurrentValue;
        $curVal = trim(strval($this->AKTIF->CurrentValue));
        if ($curVal != "") {
            $this->AKTIF->EditValue = $this->AKTIF->lookupCacheOption($curVal);
            if ($this->AKTIF->EditValue === null) { // Lookup from database
                $filterWrk = "[STATUS_PESERTA_KODE]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->AKTIF->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->AKTIF->Lookup->renderViewRow($rswrk[0]);
                    $this->AKTIF->EditValue = $this->AKTIF->displayValue($arwrk);
                } else {
                    $this->AKTIF->EditValue = $this->AKTIF->CurrentValue;
                }
            }
        } else {
            $this->AKTIF->EditValue = null;
        }
        $this->AKTIF->ViewCustomAttributes = "";

        // TMT
        $this->TMT->EditAttrs["class"] = "form-control";
        $this->TMT->EditCustomAttributes = "";
        $this->TMT->EditValue = $this->TMT->CurrentValue;
        $this->TMT->EditValue = FormatDateTime($this->TMT->EditValue, 11);
        $this->TMT->ViewCustomAttributes = "";

        // TAT
        $this->TAT->EditAttrs["class"] = "form-control";
        $this->TAT->EditCustomAttributes = "";
        $this->TAT->EditValue = $this->TAT->CurrentValue;
        $this->TAT->EditValue = FormatDateTime($this->TAT->EditValue, 11);
        $this->TAT->ViewCustomAttributes = "";

        // CARD_ID
        $this->CARD_ID->EditAttrs["class"] = "form-control";
        $this->CARD_ID->EditCustomAttributes = "";
        if (!$this->CARD_ID->Raw) {
            $this->CARD_ID->CurrentValue = HtmlDecode($this->CARD_ID->CurrentValue);
        }
        $this->CARD_ID->EditValue = $this->CARD_ID->CurrentValue;
        $this->CARD_ID->PlaceHolder = RemoveHtml($this->CARD_ID->caption());

        // MEDICAL_NOTES
        $this->MEDICAL_NOTES->EditAttrs["class"] = "form-control";
        $this->MEDICAL_NOTES->EditCustomAttributes = "";
        $this->MEDICAL_NOTES->EditValue = $this->MEDICAL_NOTES->CurrentValue;
        $this->MEDICAL_NOTES->PlaceHolder = RemoveHtml($this->MEDICAL_NOTES->caption());

        // ID
        $this->ID->EditAttrs["class"] = "form-control";
        $this->ID->EditCustomAttributes = "";
        $this->ID->EditValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // newapp
        $this->newapp->EditAttrs["class"] = "form-control";
        $this->newapp->EditCustomAttributes = "";

        // cek
        $this->cek->EditAttrs["class"] = "form-control";
        $this->cek->EditCustomAttributes = "";
        if (!$this->cek->Raw) {
            $this->cek->CurrentValue = HtmlDecode($this->cek->CurrentValue);
        }
        $this->cek->EditValue = $this->cek->CurrentValue;
        $this->cek->PlaceHolder = RemoveHtml($this->cek->caption());

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
                    $doc->exportCaption($this->NAME_OF_PASIEN);
                    $doc->exportCaption($this->PASIEN_ID);
                    $doc->exportCaption($this->KK_NO);
                    $doc->exportCaption($this->PLACE_OF_BIRTH);
                    $doc->exportCaption($this->DATE_OF_BIRTH);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->EDUCATION_TYPE_CODE);
                    $doc->exportCaption($this->MARITALSTATUSID);
                    $doc->exportCaption($this->KODE_AGAMA);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->RT);
                    $doc->exportCaption($this->RW);
                    $doc->exportCaption($this->JOB_ID);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->CONTACT_ADDRESS);
                    $doc->exportCaption($this->PHONE_NUMBER);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->REGISTRATION_DATE);
                    $doc->exportCaption($this->POSTAL_CODE);
                    $doc->exportCaption($this->BLOOD_TYPE_ID);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->COVERAGE_ID);
                    $doc->exportCaption($this->MOTHER);
                    $doc->exportCaption($this->FATHER);
                    $doc->exportCaption($this->SPOUSE);
                    $doc->exportCaption($this->AKTIF);
                    $doc->exportCaption($this->TMT);
                    $doc->exportCaption($this->TAT);
                    $doc->exportCaption($this->MEDICAL_NOTES);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->NAME_OF_PASIEN);
                    $doc->exportCaption($this->PASIEN_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->KK_NO);
                    $doc->exportCaption($this->PLACE_OF_BIRTH);
                    $doc->exportCaption($this->DATE_OF_BIRTH);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->NATION_ID);
                    $doc->exportCaption($this->EDUCATION_TYPE_CODE);
                    $doc->exportCaption($this->MARITALSTATUSID);
                    $doc->exportCaption($this->KODE_AGAMA);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->RT);
                    $doc->exportCaption($this->RW);
                    $doc->exportCaption($this->JOB_ID);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->ANAK_KE);
                    $doc->exportCaption($this->CONTACT_ADDRESS);
                    $doc->exportCaption($this->PHONE_NUMBER);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->PHOTO_LOCATION);
                    $doc->exportCaption($this->REGISTRATION_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->POSTAL_CODE);
                    $doc->exportCaption($this->GELAR);
                    $doc->exportCaption($this->BLOOD_TYPE_ID);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->ISMENINGGAL);
                    $doc->exportCaption($this->DEATH_DATE);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->KARYAWAN);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->NEWCARD);
                    $doc->exportCaption($this->BACKCHARGE);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->COVERAGE_ID);
                    $doc->exportCaption($this->MOTHER);
                    $doc->exportCaption($this->FATHER);
                    $doc->exportCaption($this->SPOUSE);
                    $doc->exportCaption($this->AKTIF);
                    $doc->exportCaption($this->TMT);
                    $doc->exportCaption($this->TAT);
                    $doc->exportCaption($this->CARD_ID);
                    $doc->exportCaption($this->ID);
                    $doc->exportCaption($this->newapp);
                    $doc->exportCaption($this->cek);
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
                        $doc->exportField($this->NAME_OF_PASIEN);
                        $doc->exportField($this->PASIEN_ID);
                        $doc->exportField($this->KK_NO);
                        $doc->exportField($this->PLACE_OF_BIRTH);
                        $doc->exportField($this->DATE_OF_BIRTH);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->EDUCATION_TYPE_CODE);
                        $doc->exportField($this->MARITALSTATUSID);
                        $doc->exportField($this->KODE_AGAMA);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->RT);
                        $doc->exportField($this->RW);
                        $doc->exportField($this->JOB_ID);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->CONTACT_ADDRESS);
                        $doc->exportField($this->PHONE_NUMBER);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->REGISTRATION_DATE);
                        $doc->exportField($this->POSTAL_CODE);
                        $doc->exportField($this->BLOOD_TYPE_ID);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->COVERAGE_ID);
                        $doc->exportField($this->MOTHER);
                        $doc->exportField($this->FATHER);
                        $doc->exportField($this->SPOUSE);
                        $doc->exportField($this->AKTIF);
                        $doc->exportField($this->TMT);
                        $doc->exportField($this->TAT);
                        $doc->exportField($this->MEDICAL_NOTES);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->NAME_OF_PASIEN);
                        $doc->exportField($this->PASIEN_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->KK_NO);
                        $doc->exportField($this->PLACE_OF_BIRTH);
                        $doc->exportField($this->DATE_OF_BIRTH);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->NATION_ID);
                        $doc->exportField($this->EDUCATION_TYPE_CODE);
                        $doc->exportField($this->MARITALSTATUSID);
                        $doc->exportField($this->KODE_AGAMA);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->RT);
                        $doc->exportField($this->RW);
                        $doc->exportField($this->JOB_ID);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->ANAK_KE);
                        $doc->exportField($this->CONTACT_ADDRESS);
                        $doc->exportField($this->PHONE_NUMBER);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->PHOTO_LOCATION);
                        $doc->exportField($this->REGISTRATION_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->POSTAL_CODE);
                        $doc->exportField($this->GELAR);
                        $doc->exportField($this->BLOOD_TYPE_ID);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->ISMENINGGAL);
                        $doc->exportField($this->DEATH_DATE);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->KARYAWAN);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->NEWCARD);
                        $doc->exportField($this->BACKCHARGE);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->COVERAGE_ID);
                        $doc->exportField($this->MOTHER);
                        $doc->exportField($this->FATHER);
                        $doc->exportField($this->SPOUSE);
                        $doc->exportField($this->AKTIF);
                        $doc->exportField($this->TMT);
                        $doc->exportField($this->TAT);
                        $doc->exportField($this->CARD_ID);
                        $doc->exportField($this->ID);
                        $doc->exportField($this->newapp);
                        $doc->exportField($this->cek);
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
