<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for EMPLOYEE_ALL
 */
class EmployeeAll extends DbTable
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
    public $DESCRIPTION;
    public $OBJECT_CATEGORY_ID;
    public $ORG_UNIT_CODE;
    public $EMPLOYEE_ID;
    public $MYADDRESS;
    public $POSTAL_CODE;
    public $RT;
    public $RW;
    public $KAL_ID;
    public $KEC_ID;
    public $KODE_KOTA;
    public $PROVINCE_CODE;
    public $COUNTRY_CODE;
    public $PHONE;
    public $FAX;
    public $_EMAIL;
    public $HANDPHONE;
    public $KARPEG;
    public $KARIS;
    public $ASKES;
    public $TASPEN;
    public $FULLNAME;
    public $GELAR_DEPAN;
    public $GELAR_BELAKANG;
    public $NICKNAME;
    public $PLACEOFBIRTH;
    public $DATEOFBIRTH;
    public $KODE_AGAMA;
    public $GENDER;
    public $MARITALSTATUSID;
    public $BLOOD_ID;
    public $ORG_ID;
    public $KODE_JABATAN;
    public $EMPLOYEED_DATE;
    public $EMP_TYPE;
    public $STATUS_ID;
    public $CURRENT_GOLF_ID;
    public $FUNCTIONAL;
    public $TOTAL_CCP;
    public $PWORKING_PERIOD_TH;
    public $P_WORKING_PERIOD_BLN;
    public $RWORKING_PERIOD_TH;
    public $RWORKING_PERIOD_BLN;
    public $CURRENT_GOL_ID;
    public $GWORKING_PERIOD_TH;
    public $GWORKING_PERIOD_BLN;
    public $EDUCATION_TYPE_CODE;
    public $NPWP;
    public $NATION_ID;
    public $PAID_ID;
    public $NONACTIVE;
    public $NONACTIVE_DATE;
    public $NON_ACTIVE_TYPE;
    public $PENSION_DATE;
    public $MORTGAGEYEAR;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $PICTUREFILE;
    public $FINGERSCANFILE;
    public $ISFULLTIME;
    public $SPECIALIST_TYPE_ID;
    public $BANK_ID;
    public $BANK_ACCOUNT;
    public $NPK;
    public $OTHER_ADDRESS;
    public $DEATH_DATE;
    public $WEBSITE;
    public $NIP;
    public $DPJP;
    public $SK_NO;
    public $SK_TMT;
    public $SK_TAT;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'EMPLOYEE_ALL';
        $this->TableName = 'EMPLOYEE_ALL';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[EMPLOYEE_ALL]";
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

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_OBJECT_CATEGORY_ID', 'OBJECT_CATEGORY_ID', '[OBJECT_CATEGORY_ID]', 'CAST([OBJECT_CATEGORY_ID] AS NVARCHAR)', 2, 2, -1, false, '[OBJECT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->OBJECT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->OBJECT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['OBJECT_CATEGORY_ID'] = &$this->OBJECT_CATEGORY_ID;

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 15, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->IsPrimaryKey = true; // Primary key field
        $this->EMPLOYEE_ID->Nullable = false; // NOT NULL field
        $this->EMPLOYEE_ID->Required = true; // Required field
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // MYADDRESS
        $this->MYADDRESS = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_MYADDRESS', 'MYADDRESS', '[MYADDRESS]', '[MYADDRESS]', 200, 200, -1, false, '[MYADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MYADDRESS->Sortable = true; // Allow sort
        $this->MYADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MYADDRESS->Param, "CustomMsg");
        $this->Fields['MYADDRESS'] = &$this->MYADDRESS;

        // POSTAL_CODE
        $this->POSTAL_CODE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_POSTAL_CODE', 'POSTAL_CODE', '[POSTAL_CODE]', '[POSTAL_CODE]', 200, 15, -1, false, '[POSTAL_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POSTAL_CODE->Sortable = true; // Allow sort
        $this->POSTAL_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POSTAL_CODE->Param, "CustomMsg");
        $this->Fields['POSTAL_CODE'] = &$this->POSTAL_CODE;

        // RT
        $this->RT = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_RT', 'RT', '[RT]', '[RT]', 200, 5, -1, false, '[RT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RT->Sortable = true; // Allow sort
        $this->RT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RT->Param, "CustomMsg");
        $this->Fields['RT'] = &$this->RT;

        // RW
        $this->RW = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_RW', 'RW', '[RW]', '[RW]', 200, 5, -1, false, '[RW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RW->Sortable = true; // Allow sort
        $this->RW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RW->Param, "CustomMsg");
        $this->Fields['RW'] = &$this->RW;

        // KAL_ID
        $this->KAL_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 8, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // KEC_ID
        $this->KEC_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_KEC_ID', 'KEC_ID', '[KEC_ID]', '[KEC_ID]', 200, 8, -1, false, '[KEC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KEC_ID->Sortable = true; // Allow sort
        $this->KEC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KEC_ID->Param, "CustomMsg");
        $this->Fields['KEC_ID'] = &$this->KEC_ID;

        // KODE_KOTA
        $this->KODE_KOTA = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_KODE_KOTA', 'KODE_KOTA', '[KODE_KOTA]', '[KODE_KOTA]', 200, 8, -1, false, '[KODE_KOTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODE_KOTA->Sortable = true; // Allow sort
        $this->KODE_KOTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE_KOTA->Param, "CustomMsg");
        $this->Fields['KODE_KOTA'] = &$this->KODE_KOTA;

        // PROVINCE_CODE
        $this->PROVINCE_CODE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_PROVINCE_CODE', 'PROVINCE_CODE', '[PROVINCE_CODE]', '[PROVINCE_CODE]', 200, 8, -1, false, '[PROVINCE_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVINCE_CODE->Sortable = true; // Allow sort
        $this->PROVINCE_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVINCE_CODE->Param, "CustomMsg");
        $this->Fields['PROVINCE_CODE'] = &$this->PROVINCE_CODE;

        // COUNTRY_CODE
        $this->COUNTRY_CODE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_COUNTRY_CODE', 'COUNTRY_CODE', '[COUNTRY_CODE]', '[COUNTRY_CODE]', 200, 8, -1, false, '[COUNTRY_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COUNTRY_CODE->Sortable = true; // Allow sort
        $this->COUNTRY_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COUNTRY_CODE->Param, "CustomMsg");
        $this->Fields['COUNTRY_CODE'] = &$this->COUNTRY_CODE;

        // PHONE
        $this->PHONE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_PHONE', 'PHONE', '[PHONE]', '[PHONE]', 200, 20, -1, false, '[PHONE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE->Sortable = true; // Allow sort
        $this->PHONE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE->Param, "CustomMsg");
        $this->Fields['PHONE'] = &$this->PHONE;

        // FAX
        $this->FAX = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_FAX', 'FAX', '[FAX]', '[FAX]', 200, 20, -1, false, '[FAX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX->Sortable = true; // Allow sort
        $this->FAX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX->Param, "CustomMsg");
        $this->Fields['FAX'] = &$this->FAX;

        // EMAIL
        $this->_EMAIL = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x__EMAIL', 'EMAIL', '[EMAIL]', '[EMAIL]', 200, 200, -1, false, '[EMAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_EMAIL->Sortable = true; // Allow sort
        $this->_EMAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_EMAIL->Param, "CustomMsg");
        $this->Fields['EMAIL'] = &$this->_EMAIL;

        // HANDPHONE
        $this->HANDPHONE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_HANDPHONE', 'HANDPHONE', '[HANDPHONE]', '[HANDPHONE]', 200, 30, -1, false, '[HANDPHONE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HANDPHONE->Sortable = true; // Allow sort
        $this->HANDPHONE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HANDPHONE->Param, "CustomMsg");
        $this->Fields['HANDPHONE'] = &$this->HANDPHONE;

        // KARPEG
        $this->KARPEG = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_KARPEG', 'KARPEG', '[KARPEG]', '[KARPEG]', 200, 20, -1, false, '[KARPEG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KARPEG->Sortable = true; // Allow sort
        $this->KARPEG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KARPEG->Param, "CustomMsg");
        $this->Fields['KARPEG'] = &$this->KARPEG;

        // KARIS
        $this->KARIS = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_KARIS', 'KARIS', '[KARIS]', '[KARIS]', 200, 20, -1, false, '[KARIS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KARIS->Sortable = true; // Allow sort
        $this->KARIS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KARIS->Param, "CustomMsg");
        $this->Fields['KARIS'] = &$this->KARIS;

        // ASKES
        $this->ASKES = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_ASKES', 'ASKES', '[ASKES]', '[ASKES]', 200, 20, -1, false, '[ASKES]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ASKES->Sortable = true; // Allow sort
        $this->ASKES->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ASKES->Param, "CustomMsg");
        $this->Fields['ASKES'] = &$this->ASKES;

        // TASPEN
        $this->TASPEN = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_TASPEN', 'TASPEN', '[TASPEN]', '[TASPEN]', 200, 20, -1, false, '[TASPEN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TASPEN->Sortable = true; // Allow sort
        $this->TASPEN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TASPEN->Param, "CustomMsg");
        $this->Fields['TASPEN'] = &$this->TASPEN;

        // FULLNAME
        $this->FULLNAME = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_FULLNAME', 'FULLNAME', '[FULLNAME]', '[FULLNAME]', 200, 50, -1, false, '[FULLNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FULLNAME->Sortable = true; // Allow sort
        $this->FULLNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FULLNAME->Param, "CustomMsg");
        $this->Fields['FULLNAME'] = &$this->FULLNAME;

        // GELAR_DEPAN
        $this->GELAR_DEPAN = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_GELAR_DEPAN', 'GELAR_DEPAN', '[GELAR_DEPAN]', '[GELAR_DEPAN]', 200, 150, -1, false, '[GELAR_DEPAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GELAR_DEPAN->Sortable = true; // Allow sort
        $this->GELAR_DEPAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GELAR_DEPAN->Param, "CustomMsg");
        $this->Fields['GELAR_DEPAN'] = &$this->GELAR_DEPAN;

        // GELAR_BELAKANG
        $this->GELAR_BELAKANG = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_GELAR_BELAKANG', 'GELAR_BELAKANG', '[GELAR_BELAKANG]', '[GELAR_BELAKANG]', 200, 150, -1, false, '[GELAR_BELAKANG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GELAR_BELAKANG->Sortable = true; // Allow sort
        $this->GELAR_BELAKANG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GELAR_BELAKANG->Param, "CustomMsg");
        $this->Fields['GELAR_BELAKANG'] = &$this->GELAR_BELAKANG;

        // NICKNAME
        $this->NICKNAME = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_NICKNAME', 'NICKNAME', '[NICKNAME]', '[NICKNAME]', 200, 30, -1, false, '[NICKNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NICKNAME->Sortable = true; // Allow sort
        $this->NICKNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NICKNAME->Param, "CustomMsg");
        $this->Fields['NICKNAME'] = &$this->NICKNAME;

        // PLACEOFBIRTH
        $this->PLACEOFBIRTH = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_PLACEOFBIRTH', 'PLACEOFBIRTH', '[PLACEOFBIRTH]', '[PLACEOFBIRTH]', 129, 20, -1, false, '[PLACEOFBIRTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PLACEOFBIRTH->Sortable = true; // Allow sort
        $this->PLACEOFBIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PLACEOFBIRTH->Param, "CustomMsg");
        $this->Fields['PLACEOFBIRTH'] = &$this->PLACEOFBIRTH;

        // DATEOFBIRTH
        $this->DATEOFBIRTH = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_DATEOFBIRTH', 'DATEOFBIRTH', '[DATEOFBIRTH]', CastDateFieldForLike("[DATEOFBIRTH]", 0, "DB"), 135, 8, 0, false, '[DATEOFBIRTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DATEOFBIRTH->Sortable = true; // Allow sort
        $this->DATEOFBIRTH->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DATEOFBIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DATEOFBIRTH->Param, "CustomMsg");
        $this->Fields['DATEOFBIRTH'] = &$this->DATEOFBIRTH;

        // KODE_AGAMA
        $this->KODE_AGAMA = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_KODE_AGAMA', 'KODE_AGAMA', '[KODE_AGAMA]', 'CAST([KODE_AGAMA] AS NVARCHAR)', 17, 1, -1, false, '[KODE_AGAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODE_AGAMA->Sortable = true; // Allow sort
        $this->KODE_AGAMA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KODE_AGAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE_AGAMA->Param, "CustomMsg");
        $this->Fields['KODE_AGAMA'] = &$this->KODE_AGAMA;

        // GENDER
        $this->GENDER = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'SELECT');
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

        // MARITALSTATUSID
        $this->MARITALSTATUSID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_MARITALSTATUSID', 'MARITALSTATUSID', '[MARITALSTATUSID]', 'CAST([MARITALSTATUSID] AS NVARCHAR)', 17, 1, -1, false, '[MARITALSTATUSID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARITALSTATUSID->Sortable = true; // Allow sort
        $this->MARITALSTATUSID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MARITALSTATUSID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARITALSTATUSID->Param, "CustomMsg");
        $this->Fields['MARITALSTATUSID'] = &$this->MARITALSTATUSID;

        // BLOOD_ID
        $this->BLOOD_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_BLOOD_ID', 'BLOOD_ID', '[BLOOD_ID]', 'CAST([BLOOD_ID] AS NVARCHAR)', 17, 1, -1, false, '[BLOOD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BLOOD_ID->Sortable = true; // Allow sort
        $this->BLOOD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BLOOD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BLOOD_ID->Param, "CustomMsg");
        $this->Fields['BLOOD_ID'] = &$this->BLOOD_ID;

        // ORG_ID
        $this->ORG_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->ORG_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->ORG_ID->Lookup = new Lookup('ORG_ID', 'CLINIC', false, 'ORG_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ORG_ID->Lookup = new Lookup('ORG_ID', 'CLINIC', false, 'ORG_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // KODE_JABATAN
        $this->KODE_JABATAN = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_KODE_JABATAN', 'KODE_JABATAN', '[KODE_JABATAN]', '[KODE_JABATAN]', 200, 25, -1, false, '[KODE_JABATAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODE_JABATAN->Sortable = true; // Allow sort
        $this->KODE_JABATAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE_JABATAN->Param, "CustomMsg");
        $this->Fields['KODE_JABATAN'] = &$this->KODE_JABATAN;

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_EMPLOYEED_DATE', 'EMPLOYEED_DATE', '[EMPLOYEED_DATE]', CastDateFieldForLike("[EMPLOYEED_DATE]", 0, "DB"), 135, 8, 0, false, '[EMPLOYEED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEED_DATE->Sortable = true; // Allow sort
        $this->EMPLOYEED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EMPLOYEED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEED_DATE->Param, "CustomMsg");
        $this->Fields['EMPLOYEED_DATE'] = &$this->EMPLOYEED_DATE;

        // EMP_TYPE
        $this->EMP_TYPE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_EMP_TYPE', 'EMP_TYPE', '[EMP_TYPE]', 'CAST([EMP_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[EMP_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMP_TYPE->Sortable = true; // Allow sort
        $this->EMP_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->EMP_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMP_TYPE->Param, "CustomMsg");
        $this->Fields['EMP_TYPE'] = &$this->EMP_TYPE;

        // STATUS_ID
        $this->STATUS_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_STATUS_ID', 'STATUS_ID', '[STATUS_ID]', 'CAST([STATUS_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_ID->Sortable = true; // Allow sort
        $this->STATUS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_ID->Param, "CustomMsg");
        $this->Fields['STATUS_ID'] = &$this->STATUS_ID;

        // CURRENT_GOLF_ID
        $this->CURRENT_GOLF_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_CURRENT_GOLF_ID', 'CURRENT_GOLF_ID', '[CURRENT_GOLF_ID]', '[CURRENT_GOLF_ID]', 200, 8, -1, false, '[CURRENT_GOLF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CURRENT_GOLF_ID->Sortable = true; // Allow sort
        $this->CURRENT_GOLF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CURRENT_GOLF_ID->Param, "CustomMsg");
        $this->Fields['CURRENT_GOLF_ID'] = &$this->CURRENT_GOLF_ID;

        // FUNCTIONAL
        $this->FUNCTIONAL = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_FUNCTIONAL', 'FUNCTIONAL', '[FUNCTIONAL]', '[FUNCTIONAL]', 200, 15, -1, false, '[FUNCTIONAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FUNCTIONAL->Sortable = true; // Allow sort
        $this->FUNCTIONAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FUNCTIONAL->Param, "CustomMsg");
        $this->Fields['FUNCTIONAL'] = &$this->FUNCTIONAL;

        // TOTAL_CCP
        $this->TOTAL_CCP = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_TOTAL_CCP', 'TOTAL_CCP', '[TOTAL_CCP]', 'CAST([TOTAL_CCP] AS NVARCHAR)', 4, 4, -1, false, '[TOTAL_CCP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TOTAL_CCP->Sortable = true; // Allow sort
        $this->TOTAL_CCP->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TOTAL_CCP->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TOTAL_CCP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TOTAL_CCP->Param, "CustomMsg");
        $this->Fields['TOTAL_CCP'] = &$this->TOTAL_CCP;

        // PWORKING_PERIOD_TH
        $this->PWORKING_PERIOD_TH = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_PWORKING_PERIOD_TH', 'PWORKING_PERIOD_TH', '[PWORKING_PERIOD_TH]', 'CAST([PWORKING_PERIOD_TH] AS NVARCHAR)', 2, 2, -1, false, '[PWORKING_PERIOD_TH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PWORKING_PERIOD_TH->Sortable = true; // Allow sort
        $this->PWORKING_PERIOD_TH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PWORKING_PERIOD_TH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PWORKING_PERIOD_TH->Param, "CustomMsg");
        $this->Fields['PWORKING_PERIOD_TH'] = &$this->PWORKING_PERIOD_TH;

        // P_WORKING_PERIOD_BLN
        $this->P_WORKING_PERIOD_BLN = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_P_WORKING_PERIOD_BLN', 'P_WORKING_PERIOD_BLN', '[P_WORKING_PERIOD_BLN]', 'CAST([P_WORKING_PERIOD_BLN] AS NVARCHAR)', 2, 2, -1, false, '[P_WORKING_PERIOD_BLN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->P_WORKING_PERIOD_BLN->Sortable = true; // Allow sort
        $this->P_WORKING_PERIOD_BLN->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->P_WORKING_PERIOD_BLN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->P_WORKING_PERIOD_BLN->Param, "CustomMsg");
        $this->Fields['P_WORKING_PERIOD_BLN'] = &$this->P_WORKING_PERIOD_BLN;

        // RWORKING_PERIOD_TH
        $this->RWORKING_PERIOD_TH = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_RWORKING_PERIOD_TH', 'RWORKING_PERIOD_TH', '[RWORKING_PERIOD_TH]', 'CAST([RWORKING_PERIOD_TH] AS NVARCHAR)', 2, 2, -1, false, '[RWORKING_PERIOD_TH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RWORKING_PERIOD_TH->Sortable = true; // Allow sort
        $this->RWORKING_PERIOD_TH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RWORKING_PERIOD_TH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RWORKING_PERIOD_TH->Param, "CustomMsg");
        $this->Fields['RWORKING_PERIOD_TH'] = &$this->RWORKING_PERIOD_TH;

        // RWORKING_PERIOD_BLN
        $this->RWORKING_PERIOD_BLN = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_RWORKING_PERIOD_BLN', 'RWORKING_PERIOD_BLN', '[RWORKING_PERIOD_BLN]', 'CAST([RWORKING_PERIOD_BLN] AS NVARCHAR)', 2, 2, -1, false, '[RWORKING_PERIOD_BLN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RWORKING_PERIOD_BLN->Sortable = true; // Allow sort
        $this->RWORKING_PERIOD_BLN->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RWORKING_PERIOD_BLN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RWORKING_PERIOD_BLN->Param, "CustomMsg");
        $this->Fields['RWORKING_PERIOD_BLN'] = &$this->RWORKING_PERIOD_BLN;

        // CURRENT_GOL_ID
        $this->CURRENT_GOL_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_CURRENT_GOL_ID', 'CURRENT_GOL_ID', '[CURRENT_GOL_ID]', '[CURRENT_GOL_ID]', 200, 8, -1, false, '[CURRENT_GOL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CURRENT_GOL_ID->Sortable = true; // Allow sort
        $this->CURRENT_GOL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CURRENT_GOL_ID->Param, "CustomMsg");
        $this->Fields['CURRENT_GOL_ID'] = &$this->CURRENT_GOL_ID;

        // GWORKING_PERIOD_TH
        $this->GWORKING_PERIOD_TH = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_GWORKING_PERIOD_TH', 'GWORKING_PERIOD_TH', '[GWORKING_PERIOD_TH]', 'CAST([GWORKING_PERIOD_TH] AS NVARCHAR)', 2, 2, -1, false, '[GWORKING_PERIOD_TH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GWORKING_PERIOD_TH->Sortable = true; // Allow sort
        $this->GWORKING_PERIOD_TH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->GWORKING_PERIOD_TH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GWORKING_PERIOD_TH->Param, "CustomMsg");
        $this->Fields['GWORKING_PERIOD_TH'] = &$this->GWORKING_PERIOD_TH;

        // GWORKING_PERIOD_BLN
        $this->GWORKING_PERIOD_BLN = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_GWORKING_PERIOD_BLN', 'GWORKING_PERIOD_BLN', '[GWORKING_PERIOD_BLN]', 'CAST([GWORKING_PERIOD_BLN] AS NVARCHAR)', 2, 2, -1, false, '[GWORKING_PERIOD_BLN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GWORKING_PERIOD_BLN->Sortable = true; // Allow sort
        $this->GWORKING_PERIOD_BLN->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->GWORKING_PERIOD_BLN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GWORKING_PERIOD_BLN->Param, "CustomMsg");
        $this->Fields['GWORKING_PERIOD_BLN'] = &$this->GWORKING_PERIOD_BLN;

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_EDUCATION_TYPE_CODE', 'EDUCATION_TYPE_CODE', '[EDUCATION_TYPE_CODE]', 'CAST([EDUCATION_TYPE_CODE] AS NVARCHAR)', 17, 1, -1, false, '[EDUCATION_TYPE_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EDUCATION_TYPE_CODE->Sortable = true; // Allow sort
        $this->EDUCATION_TYPE_CODE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->EDUCATION_TYPE_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EDUCATION_TYPE_CODE->Param, "CustomMsg");
        $this->Fields['EDUCATION_TYPE_CODE'] = &$this->EDUCATION_TYPE_CODE;

        // NPWP
        $this->NPWP = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_NPWP', 'NPWP', '[NPWP]', '[NPWP]', 200, 50, -1, false, '[NPWP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPWP->Sortable = true; // Allow sort
        $this->NPWP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPWP->Param, "CustomMsg");
        $this->Fields['NPWP'] = &$this->NPWP;

        // NATION_ID
        $this->NATION_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_NATION_ID', 'NATION_ID', '[NATION_ID]', 'CAST([NATION_ID] AS NVARCHAR)', 17, 1, -1, false, '[NATION_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NATION_ID->Sortable = true; // Allow sort
        $this->NATION_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NATION_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NATION_ID->Param, "CustomMsg");
        $this->Fields['NATION_ID'] = &$this->NATION_ID;

        // PAID_ID
        $this->PAID_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_PAID_ID', 'PAID_ID', '[PAID_ID]', '[PAID_ID]', 200, 15, -1, false, '[PAID_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAID_ID->Sortable = true; // Allow sort
        $this->PAID_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAID_ID->Param, "CustomMsg");
        $this->Fields['PAID_ID'] = &$this->PAID_ID;

        // NONACTIVE
        $this->NONACTIVE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_NONACTIVE', 'NONACTIVE', '[NONACTIVE]', '[NONACTIVE]', 129, 1, -1, false, '[NONACTIVE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NONACTIVE->Sortable = true; // Allow sort
        $this->NONACTIVE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NONACTIVE->Param, "CustomMsg");
        $this->Fields['NONACTIVE'] = &$this->NONACTIVE;

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_NONACTIVE_DATE', 'NONACTIVE_DATE', '[NONACTIVE_DATE]', CastDateFieldForLike("[NONACTIVE_DATE]", 0, "DB"), 135, 8, 0, false, '[NONACTIVE_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NONACTIVE_DATE->Sortable = true; // Allow sort
        $this->NONACTIVE_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->NONACTIVE_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NONACTIVE_DATE->Param, "CustomMsg");
        $this->Fields['NONACTIVE_DATE'] = &$this->NONACTIVE_DATE;

        // NON_ACTIVE_TYPE
        $this->NON_ACTIVE_TYPE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_NON_ACTIVE_TYPE', 'NON_ACTIVE_TYPE', '[NON_ACTIVE_TYPE]', 'CAST([NON_ACTIVE_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[NON_ACTIVE_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NON_ACTIVE_TYPE->Sortable = true; // Allow sort
        $this->NON_ACTIVE_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NON_ACTIVE_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NON_ACTIVE_TYPE->Param, "CustomMsg");
        $this->Fields['NON_ACTIVE_TYPE'] = &$this->NON_ACTIVE_TYPE;

        // PENSION_DATE
        $this->PENSION_DATE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_PENSION_DATE', 'PENSION_DATE', '[PENSION_DATE]', CastDateFieldForLike("[PENSION_DATE]", 0, "DB"), 135, 8, 0, false, '[PENSION_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PENSION_DATE->Sortable = true; // Allow sort
        $this->PENSION_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PENSION_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PENSION_DATE->Param, "CustomMsg");
        $this->Fields['PENSION_DATE'] = &$this->PENSION_DATE;

        // MORTGAGEYEAR
        $this->MORTGAGEYEAR = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_MORTGAGEYEAR', 'MORTGAGEYEAR', '[MORTGAGEYEAR]', 'CAST([MORTGAGEYEAR] AS NVARCHAR)', 2, 2, -1, false, '[MORTGAGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MORTGAGEYEAR->Sortable = true; // Allow sort
        $this->MORTGAGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MORTGAGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MORTGAGEYEAR->Param, "CustomMsg");
        $this->Fields['MORTGAGEYEAR'] = &$this->MORTGAGEYEAR;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // PICTUREFILE
        $this->PICTUREFILE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_PICTUREFILE', 'PICTUREFILE', '[PICTUREFILE]', '[PICTUREFILE]', 200, 200, -1, false, '[PICTUREFILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PICTUREFILE->Sortable = true; // Allow sort
        $this->PICTUREFILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PICTUREFILE->Param, "CustomMsg");
        $this->Fields['PICTUREFILE'] = &$this->PICTUREFILE;

        // FINGERSCANFILE
        $this->FINGERSCANFILE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_FINGERSCANFILE', 'FINGERSCANFILE', '[FINGERSCANFILE]', '[FINGERSCANFILE]', 200, 225, -1, false, '[FINGERSCANFILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FINGERSCANFILE->Sortable = true; // Allow sort
        $this->FINGERSCANFILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FINGERSCANFILE->Param, "CustomMsg");
        $this->Fields['FINGERSCANFILE'] = &$this->FINGERSCANFILE;

        // ISFULLTIME
        $this->ISFULLTIME = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_ISFULLTIME', 'ISFULLTIME', '[ISFULLTIME]', '[ISFULLTIME]', 129, 1, -1, false, '[ISFULLTIME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISFULLTIME->Sortable = true; // Allow sort
        $this->ISFULLTIME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISFULLTIME->Param, "CustomMsg");
        $this->Fields['ISFULLTIME'] = &$this->ISFULLTIME;

        // SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_SPECIALIST_TYPE_ID', 'SPECIALIST_TYPE_ID', '[SPECIALIST_TYPE_ID]', '[SPECIALIST_TYPE_ID]', 200, 50, -1, false, '[SPECIALIST_TYPE_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->SPECIALIST_TYPE_ID->Sortable = true; // Allow sort
        $this->SPECIALIST_TYPE_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->SPECIALIST_TYPE_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->SPECIALIST_TYPE_ID->Lookup = new Lookup('SPECIALIST_TYPE_ID', 'SPECIALIST_TYPE', false, 'SPECIALIST_TYPE_ID', ["SPESIALISTIK","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->SPECIALIST_TYPE_ID->Lookup = new Lookup('SPECIALIST_TYPE_ID', 'SPECIALIST_TYPE', false, 'SPECIALIST_TYPE_ID', ["SPESIALISTIK","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->SPECIALIST_TYPE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPECIALIST_TYPE_ID->Param, "CustomMsg");
        $this->Fields['SPECIALIST_TYPE_ID'] = &$this->SPECIALIST_TYPE_ID;

        // BANK_ID
        $this->BANK_ID = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_BANK_ID', 'BANK_ID', '[BANK_ID]', '[BANK_ID]', 200, 50, -1, false, '[BANK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANK_ID->Sortable = true; // Allow sort
        $this->BANK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANK_ID->Param, "CustomMsg");
        $this->Fields['BANK_ID'] = &$this->BANK_ID;

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_BANK_ACCOUNT', 'BANK_ACCOUNT', '[BANK_ACCOUNT]', '[BANK_ACCOUNT]', 200, 100, -1, false, '[BANK_ACCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANK_ACCOUNT->Sortable = true; // Allow sort
        $this->BANK_ACCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANK_ACCOUNT->Param, "CustomMsg");
        $this->Fields['BANK_ACCOUNT'] = &$this->BANK_ACCOUNT;

        // NPK
        $this->NPK = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_NPK', 'NPK', '[NPK]', '[NPK]', 200, 15, -1, false, '[NPK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPK->Sortable = true; // Allow sort
        $this->NPK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPK->Param, "CustomMsg");
        $this->Fields['NPK'] = &$this->NPK;

        // OTHER_ADDRESS
        $this->OTHER_ADDRESS = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_OTHER_ADDRESS', 'OTHER_ADDRESS', '[OTHER_ADDRESS]', '[OTHER_ADDRESS]', 200, 200, -1, false, '[OTHER_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_ADDRESS->Sortable = true; // Allow sort
        $this->OTHER_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_ADDRESS->Param, "CustomMsg");
        $this->Fields['OTHER_ADDRESS'] = &$this->OTHER_ADDRESS;

        // DEATH_DATE
        $this->DEATH_DATE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_DEATH_DATE', 'DEATH_DATE', '[DEATH_DATE]', CastDateFieldForLike("[DEATH_DATE]", 0, "DB"), 135, 8, 0, false, '[DEATH_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DEATH_DATE->Sortable = true; // Allow sort
        $this->DEATH_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DEATH_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DEATH_DATE->Param, "CustomMsg");
        $this->Fields['DEATH_DATE'] = &$this->DEATH_DATE;

        // WEBSITE
        $this->WEBSITE = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_WEBSITE', 'WEBSITE', '[WEBSITE]', '[WEBSITE]', 200, 100, -1, false, '[WEBSITE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WEBSITE->Sortable = true; // Allow sort
        $this->WEBSITE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WEBSITE->Param, "CustomMsg");
        $this->Fields['WEBSITE'] = &$this->WEBSITE;

        // NIP
        $this->NIP = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_NIP', 'NIP', '[NIP]', '[NIP]', 200, 30, -1, false, '[NIP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIP->Sortable = true; // Allow sort
        $this->NIP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIP->Param, "CustomMsg");
        $this->Fields['NIP'] = &$this->NIP;

        // DPJP
        $this->DPJP = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_DPJP', 'DPJP', '[DPJP]', '[DPJP]', 200, 25, -1, false, '[DPJP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DPJP->Sortable = true; // Allow sort
        $this->DPJP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DPJP->Param, "CustomMsg");
        $this->Fields['DPJP'] = &$this->DPJP;

        // SK_NO
        $this->SK_NO = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_SK_NO', 'SK_NO', '[SK_NO]', '[SK_NO]', 200, 50, -1, false, '[SK_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SK_NO->Sortable = true; // Allow sort
        $this->SK_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SK_NO->Param, "CustomMsg");
        $this->Fields['SK_NO'] = &$this->SK_NO;

        // SK_TMT
        $this->SK_TMT = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_SK_TMT', 'SK_TMT', '[SK_TMT]', CastDateFieldForLike("[SK_TMT]", 0, "DB"), 135, 8, 0, false, '[SK_TMT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SK_TMT->Sortable = true; // Allow sort
        $this->SK_TMT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SK_TMT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SK_TMT->Param, "CustomMsg");
        $this->Fields['SK_TMT'] = &$this->SK_TMT;

        // SK_TAT
        $this->SK_TAT = new DbField('EMPLOYEE_ALL', 'EMPLOYEE_ALL', 'x_SK_TAT', 'SK_TAT', '[SK_TAT]', CastDateFieldForLike("[SK_TAT]", 0, "DB"), 135, 8, 0, false, '[SK_TAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SK_TAT->Sortable = true; // Allow sort
        $this->SK_TAT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SK_TAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SK_TAT->Param, "CustomMsg");
        $this->Fields['SK_TAT'] = &$this->SK_TAT;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[EMPLOYEE_ALL]";
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
        $this->DefaultFilter = "[OBJECT_CATEGORY_ID] = 20";
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
            if (array_key_exists('EMPLOYEE_ID', $rs)) {
                AddFilter($where, QuotedName('EMPLOYEE_ID', $this->Dbid) . '=' . QuotedValue($rs['EMPLOYEE_ID'], $this->EMPLOYEE_ID->DataType, $this->Dbid));
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
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->OBJECT_CATEGORY_ID->DbValue = $row['OBJECT_CATEGORY_ID'];
        $this->ORG_UNIT_CODE->DbValue = $row['ORG_UNIT_CODE'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->MYADDRESS->DbValue = $row['MYADDRESS'];
        $this->POSTAL_CODE->DbValue = $row['POSTAL_CODE'];
        $this->RT->DbValue = $row['RT'];
        $this->RW->DbValue = $row['RW'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->KEC_ID->DbValue = $row['KEC_ID'];
        $this->KODE_KOTA->DbValue = $row['KODE_KOTA'];
        $this->PROVINCE_CODE->DbValue = $row['PROVINCE_CODE'];
        $this->COUNTRY_CODE->DbValue = $row['COUNTRY_CODE'];
        $this->PHONE->DbValue = $row['PHONE'];
        $this->FAX->DbValue = $row['FAX'];
        $this->_EMAIL->DbValue = $row['EMAIL'];
        $this->HANDPHONE->DbValue = $row['HANDPHONE'];
        $this->KARPEG->DbValue = $row['KARPEG'];
        $this->KARIS->DbValue = $row['KARIS'];
        $this->ASKES->DbValue = $row['ASKES'];
        $this->TASPEN->DbValue = $row['TASPEN'];
        $this->FULLNAME->DbValue = $row['FULLNAME'];
        $this->GELAR_DEPAN->DbValue = $row['GELAR_DEPAN'];
        $this->GELAR_BELAKANG->DbValue = $row['GELAR_BELAKANG'];
        $this->NICKNAME->DbValue = $row['NICKNAME'];
        $this->PLACEOFBIRTH->DbValue = $row['PLACEOFBIRTH'];
        $this->DATEOFBIRTH->DbValue = $row['DATEOFBIRTH'];
        $this->KODE_AGAMA->DbValue = $row['KODE_AGAMA'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->MARITALSTATUSID->DbValue = $row['MARITALSTATUSID'];
        $this->BLOOD_ID->DbValue = $row['BLOOD_ID'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->KODE_JABATAN->DbValue = $row['KODE_JABATAN'];
        $this->EMPLOYEED_DATE->DbValue = $row['EMPLOYEED_DATE'];
        $this->EMP_TYPE->DbValue = $row['EMP_TYPE'];
        $this->STATUS_ID->DbValue = $row['STATUS_ID'];
        $this->CURRENT_GOLF_ID->DbValue = $row['CURRENT_GOLF_ID'];
        $this->FUNCTIONAL->DbValue = $row['FUNCTIONAL'];
        $this->TOTAL_CCP->DbValue = $row['TOTAL_CCP'];
        $this->PWORKING_PERIOD_TH->DbValue = $row['PWORKING_PERIOD_TH'];
        $this->P_WORKING_PERIOD_BLN->DbValue = $row['P_WORKING_PERIOD_BLN'];
        $this->RWORKING_PERIOD_TH->DbValue = $row['RWORKING_PERIOD_TH'];
        $this->RWORKING_PERIOD_BLN->DbValue = $row['RWORKING_PERIOD_BLN'];
        $this->CURRENT_GOL_ID->DbValue = $row['CURRENT_GOL_ID'];
        $this->GWORKING_PERIOD_TH->DbValue = $row['GWORKING_PERIOD_TH'];
        $this->GWORKING_PERIOD_BLN->DbValue = $row['GWORKING_PERIOD_BLN'];
        $this->EDUCATION_TYPE_CODE->DbValue = $row['EDUCATION_TYPE_CODE'];
        $this->NPWP->DbValue = $row['NPWP'];
        $this->NATION_ID->DbValue = $row['NATION_ID'];
        $this->PAID_ID->DbValue = $row['PAID_ID'];
        $this->NONACTIVE->DbValue = $row['NONACTIVE'];
        $this->NONACTIVE_DATE->DbValue = $row['NONACTIVE_DATE'];
        $this->NON_ACTIVE_TYPE->DbValue = $row['NON_ACTIVE_TYPE'];
        $this->PENSION_DATE->DbValue = $row['PENSION_DATE'];
        $this->MORTGAGEYEAR->DbValue = $row['MORTGAGEYEAR'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->PICTUREFILE->DbValue = $row['PICTUREFILE'];
        $this->FINGERSCANFILE->DbValue = $row['FINGERSCANFILE'];
        $this->ISFULLTIME->DbValue = $row['ISFULLTIME'];
        $this->SPECIALIST_TYPE_ID->DbValue = $row['SPECIALIST_TYPE_ID'];
        $this->BANK_ID->DbValue = $row['BANK_ID'];
        $this->BANK_ACCOUNT->DbValue = $row['BANK_ACCOUNT'];
        $this->NPK->DbValue = $row['NPK'];
        $this->OTHER_ADDRESS->DbValue = $row['OTHER_ADDRESS'];
        $this->DEATH_DATE->DbValue = $row['DEATH_DATE'];
        $this->WEBSITE->DbValue = $row['WEBSITE'];
        $this->NIP->DbValue = $row['NIP'];
        $this->DPJP->DbValue = $row['DPJP'];
        $this->SK_NO->DbValue = $row['SK_NO'];
        $this->SK_TMT->DbValue = $row['SK_TMT'];
        $this->SK_TAT->DbValue = $row['SK_TAT'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [EMPLOYEE_ID] = '@EMPLOYEE_ID@'";
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
        $val = $current ? $this->EMPLOYEE_ID->CurrentValue : $this->EMPLOYEE_ID->OldValue;
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
                $this->EMPLOYEE_ID->CurrentValue = $keys[1];
            } else {
                $this->EMPLOYEE_ID->OldValue = $keys[1];
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
            $val = array_key_exists('EMPLOYEE_ID', $row) ? $row['EMPLOYEE_ID'] : null;
        } else {
            $val = $this->EMPLOYEE_ID->OldValue !== null ? $this->EMPLOYEE_ID->OldValue : $this->EMPLOYEE_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@EMPLOYEE_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("EmployeeAllList");
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
        if ($pageName == "EmployeeAllView") {
            return $Language->phrase("View");
        } elseif ($pageName == "EmployeeAllEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "EmployeeAllAdd") {
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
                return "EmployeeAllView";
            case Config("API_ADD_ACTION"):
                return "EmployeeAllAdd";
            case Config("API_EDIT_ACTION"):
                return "EmployeeAllEdit";
            case Config("API_DELETE_ACTION"):
                return "EmployeeAllDelete";
            case Config("API_LIST_ACTION"):
                return "EmployeeAllList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "EmployeeAllList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("EmployeeAllView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("EmployeeAllView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "EmployeeAllAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "EmployeeAllAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("EmployeeAllEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("EmployeeAllAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("EmployeeAllDelete", $this->getUrlParm());
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
        $json .= ",EMPLOYEE_ID:" . JsonEncode($this->EMPLOYEE_ID->CurrentValue, "string");
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
        if ($this->EMPLOYEE_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->EMPLOYEE_ID->CurrentValue);
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
            if (($keyValue = Param("EMPLOYEE_ID") ?? Route("EMPLOYEE_ID")) !== null) {
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
                $this->EMPLOYEE_ID->CurrentValue = $key[1];
            } else {
                $this->EMPLOYEE_ID->OldValue = $key[1];
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
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->OBJECT_CATEGORY_ID->setDbValue($row['OBJECT_CATEGORY_ID']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->MYADDRESS->setDbValue($row['MYADDRESS']);
        $this->POSTAL_CODE->setDbValue($row['POSTAL_CODE']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->KEC_ID->setDbValue($row['KEC_ID']);
        $this->KODE_KOTA->setDbValue($row['KODE_KOTA']);
        $this->PROVINCE_CODE->setDbValue($row['PROVINCE_CODE']);
        $this->COUNTRY_CODE->setDbValue($row['COUNTRY_CODE']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->FAX->setDbValue($row['FAX']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->HANDPHONE->setDbValue($row['HANDPHONE']);
        $this->KARPEG->setDbValue($row['KARPEG']);
        $this->KARIS->setDbValue($row['KARIS']);
        $this->ASKES->setDbValue($row['ASKES']);
        $this->TASPEN->setDbValue($row['TASPEN']);
        $this->FULLNAME->setDbValue($row['FULLNAME']);
        $this->GELAR_DEPAN->setDbValue($row['GELAR_DEPAN']);
        $this->GELAR_BELAKANG->setDbValue($row['GELAR_BELAKANG']);
        $this->NICKNAME->setDbValue($row['NICKNAME']);
        $this->PLACEOFBIRTH->setDbValue($row['PLACEOFBIRTH']);
        $this->DATEOFBIRTH->setDbValue($row['DATEOFBIRTH']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->BLOOD_ID->setDbValue($row['BLOOD_ID']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->KODE_JABATAN->setDbValue($row['KODE_JABATAN']);
        $this->EMPLOYEED_DATE->setDbValue($row['EMPLOYEED_DATE']);
        $this->EMP_TYPE->setDbValue($row['EMP_TYPE']);
        $this->STATUS_ID->setDbValue($row['STATUS_ID']);
        $this->CURRENT_GOLF_ID->setDbValue($row['CURRENT_GOLF_ID']);
        $this->FUNCTIONAL->setDbValue($row['FUNCTIONAL']);
        $this->TOTAL_CCP->setDbValue($row['TOTAL_CCP']);
        $this->PWORKING_PERIOD_TH->setDbValue($row['PWORKING_PERIOD_TH']);
        $this->P_WORKING_PERIOD_BLN->setDbValue($row['P_WORKING_PERIOD_BLN']);
        $this->RWORKING_PERIOD_TH->setDbValue($row['RWORKING_PERIOD_TH']);
        $this->RWORKING_PERIOD_BLN->setDbValue($row['RWORKING_PERIOD_BLN']);
        $this->CURRENT_GOL_ID->setDbValue($row['CURRENT_GOL_ID']);
        $this->GWORKING_PERIOD_TH->setDbValue($row['GWORKING_PERIOD_TH']);
        $this->GWORKING_PERIOD_BLN->setDbValue($row['GWORKING_PERIOD_BLN']);
        $this->EDUCATION_TYPE_CODE->setDbValue($row['EDUCATION_TYPE_CODE']);
        $this->NPWP->setDbValue($row['NPWP']);
        $this->NATION_ID->setDbValue($row['NATION_ID']);
        $this->PAID_ID->setDbValue($row['PAID_ID']);
        $this->NONACTIVE->setDbValue($row['NONACTIVE']);
        $this->NONACTIVE_DATE->setDbValue($row['NONACTIVE_DATE']);
        $this->NON_ACTIVE_TYPE->setDbValue($row['NON_ACTIVE_TYPE']);
        $this->PENSION_DATE->setDbValue($row['PENSION_DATE']);
        $this->MORTGAGEYEAR->setDbValue($row['MORTGAGEYEAR']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->PICTUREFILE->setDbValue($row['PICTUREFILE']);
        $this->FINGERSCANFILE->setDbValue($row['FINGERSCANFILE']);
        $this->ISFULLTIME->setDbValue($row['ISFULLTIME']);
        $this->SPECIALIST_TYPE_ID->setDbValue($row['SPECIALIST_TYPE_ID']);
        $this->BANK_ID->setDbValue($row['BANK_ID']);
        $this->BANK_ACCOUNT->setDbValue($row['BANK_ACCOUNT']);
        $this->NPK->setDbValue($row['NPK']);
        $this->OTHER_ADDRESS->setDbValue($row['OTHER_ADDRESS']);
        $this->DEATH_DATE->setDbValue($row['DEATH_DATE']);
        $this->WEBSITE->setDbValue($row['WEBSITE']);
        $this->NIP->setDbValue($row['NIP']);
        $this->DPJP->setDbValue($row['DPJP']);
        $this->SK_NO->setDbValue($row['SK_NO']);
        $this->SK_TMT->setDbValue($row['SK_TMT']);
        $this->SK_TAT->setDbValue($row['SK_TAT']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // DESCRIPTION

        // OBJECT_CATEGORY_ID

        // ORG_UNIT_CODE

        // EMPLOYEE_ID

        // MYADDRESS

        // POSTAL_CODE

        // RT

        // RW

        // KAL_ID

        // KEC_ID

        // KODE_KOTA

        // PROVINCE_CODE

        // COUNTRY_CODE

        // PHONE

        // FAX

        // EMAIL

        // HANDPHONE

        // KARPEG

        // KARIS

        // ASKES

        // TASPEN

        // FULLNAME

        // GELAR_DEPAN

        // GELAR_BELAKANG

        // NICKNAME

        // PLACEOFBIRTH

        // DATEOFBIRTH

        // KODE_AGAMA

        // GENDER

        // MARITALSTATUSID

        // BLOOD_ID

        // ORG_ID

        // KODE_JABATAN

        // EMPLOYEED_DATE

        // EMP_TYPE

        // STATUS_ID

        // CURRENT_GOLF_ID

        // FUNCTIONAL

        // TOTAL_CCP

        // PWORKING_PERIOD_TH

        // P_WORKING_PERIOD_BLN

        // RWORKING_PERIOD_TH

        // RWORKING_PERIOD_BLN

        // CURRENT_GOL_ID

        // GWORKING_PERIOD_TH

        // GWORKING_PERIOD_BLN

        // EDUCATION_TYPE_CODE

        // NPWP

        // NATION_ID

        // PAID_ID

        // NONACTIVE

        // NONACTIVE_DATE

        // NON_ACTIVE_TYPE

        // PENSION_DATE

        // MORTGAGEYEAR

        // MODIFIED_DATE

        // MODIFIED_BY

        // PICTUREFILE

        // FINGERSCANFILE

        // ISFULLTIME

        // SPECIALIST_TYPE_ID

        // BANK_ID

        // BANK_ACCOUNT

        // NPK

        // OTHER_ADDRESS

        // DEATH_DATE

        // WEBSITE

        // NIP

        // DPJP

        // SK_NO

        // SK_TMT

        // SK_TAT

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->ViewValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->ViewValue = FormatNumber($this->OBJECT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
        $this->OBJECT_CATEGORY_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // MYADDRESS
        $this->MYADDRESS->ViewValue = $this->MYADDRESS->CurrentValue;
        $this->MYADDRESS->ViewCustomAttributes = "";

        // POSTAL_CODE
        $this->POSTAL_CODE->ViewValue = $this->POSTAL_CODE->CurrentValue;
        $this->POSTAL_CODE->ViewCustomAttributes = "";

        // RT
        $this->RT->ViewValue = $this->RT->CurrentValue;
        $this->RT->ViewCustomAttributes = "";

        // RW
        $this->RW->ViewValue = $this->RW->CurrentValue;
        $this->RW->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // KEC_ID
        $this->KEC_ID->ViewValue = $this->KEC_ID->CurrentValue;
        $this->KEC_ID->ViewCustomAttributes = "";

        // KODE_KOTA
        $this->KODE_KOTA->ViewValue = $this->KODE_KOTA->CurrentValue;
        $this->KODE_KOTA->ViewCustomAttributes = "";

        // PROVINCE_CODE
        $this->PROVINCE_CODE->ViewValue = $this->PROVINCE_CODE->CurrentValue;
        $this->PROVINCE_CODE->ViewCustomAttributes = "";

        // COUNTRY_CODE
        $this->COUNTRY_CODE->ViewValue = $this->COUNTRY_CODE->CurrentValue;
        $this->COUNTRY_CODE->ViewCustomAttributes = "";

        // PHONE
        $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
        $this->PHONE->ViewCustomAttributes = "";

        // FAX
        $this->FAX->ViewValue = $this->FAX->CurrentValue;
        $this->FAX->ViewCustomAttributes = "";

        // EMAIL
        $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->ViewCustomAttributes = "";

        // HANDPHONE
        $this->HANDPHONE->ViewValue = $this->HANDPHONE->CurrentValue;
        $this->HANDPHONE->ViewCustomAttributes = "";

        // KARPEG
        $this->KARPEG->ViewValue = $this->KARPEG->CurrentValue;
        $this->KARPEG->ViewCustomAttributes = "";

        // KARIS
        $this->KARIS->ViewValue = $this->KARIS->CurrentValue;
        $this->KARIS->ViewCustomAttributes = "";

        // ASKES
        $this->ASKES->ViewValue = $this->ASKES->CurrentValue;
        $this->ASKES->ViewCustomAttributes = "";

        // TASPEN
        $this->TASPEN->ViewValue = $this->TASPEN->CurrentValue;
        $this->TASPEN->ViewCustomAttributes = "";

        // FULLNAME
        $this->FULLNAME->ViewValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->ViewCustomAttributes = "";

        // GELAR_DEPAN
        $this->GELAR_DEPAN->ViewValue = $this->GELAR_DEPAN->CurrentValue;
        $this->GELAR_DEPAN->ViewCustomAttributes = "";

        // GELAR_BELAKANG
        $this->GELAR_BELAKANG->ViewValue = $this->GELAR_BELAKANG->CurrentValue;
        $this->GELAR_BELAKANG->ViewCustomAttributes = "";

        // NICKNAME
        $this->NICKNAME->ViewValue = $this->NICKNAME->CurrentValue;
        $this->NICKNAME->ViewCustomAttributes = "";

        // PLACEOFBIRTH
        $this->PLACEOFBIRTH->ViewValue = $this->PLACEOFBIRTH->CurrentValue;
        $this->PLACEOFBIRTH->ViewCustomAttributes = "";

        // DATEOFBIRTH
        $this->DATEOFBIRTH->ViewValue = $this->DATEOFBIRTH->CurrentValue;
        $this->DATEOFBIRTH->ViewValue = FormatDateTime($this->DATEOFBIRTH->ViewValue, 0);
        $this->DATEOFBIRTH->ViewCustomAttributes = "";

        // KODE_AGAMA
        $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->CurrentValue;
        $this->KODE_AGAMA->ViewValue = FormatNumber($this->KODE_AGAMA->ViewValue, 0, -2, -2, -2);
        $this->KODE_AGAMA->ViewCustomAttributes = "";

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

        // MARITALSTATUSID
        $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
        $this->MARITALSTATUSID->ViewValue = FormatNumber($this->MARITALSTATUSID->ViewValue, 0, -2, -2, -2);
        $this->MARITALSTATUSID->ViewCustomAttributes = "";

        // BLOOD_ID
        $this->BLOOD_ID->ViewValue = $this->BLOOD_ID->CurrentValue;
        $this->BLOOD_ID->ViewValue = FormatNumber($this->BLOOD_ID->ViewValue, 0, -2, -2, -2);
        $this->BLOOD_ID->ViewCustomAttributes = "";

        // ORG_ID
        $curVal = trim(strval($this->ORG_ID->CurrentValue));
        if ($curVal != "") {
            $this->ORG_ID->ViewValue = $this->ORG_ID->lookupCacheOption($curVal);
            if ($this->ORG_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[ORG_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->ORG_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->ORG_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->ORG_ID->ViewValue = $this->ORG_ID->displayValue($arwrk);
                } else {
                    $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
                }
            }
        } else {
            $this->ORG_ID->ViewValue = null;
        }
        $this->ORG_ID->ViewCustomAttributes = "";

        // KODE_JABATAN
        $this->KODE_JABATAN->ViewValue = $this->KODE_JABATAN->CurrentValue;
        $this->KODE_JABATAN->ViewCustomAttributes = "";

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE->ViewValue = $this->EMPLOYEED_DATE->CurrentValue;
        $this->EMPLOYEED_DATE->ViewValue = FormatDateTime($this->EMPLOYEED_DATE->ViewValue, 0);
        $this->EMPLOYEED_DATE->ViewCustomAttributes = "";

        // EMP_TYPE
        $this->EMP_TYPE->ViewValue = $this->EMP_TYPE->CurrentValue;
        $this->EMP_TYPE->ViewValue = FormatNumber($this->EMP_TYPE->ViewValue, 0, -2, -2, -2);
        $this->EMP_TYPE->ViewCustomAttributes = "";

        // STATUS_ID
        $this->STATUS_ID->ViewValue = $this->STATUS_ID->CurrentValue;
        $this->STATUS_ID->ViewValue = FormatNumber($this->STATUS_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_ID->ViewCustomAttributes = "";

        // CURRENT_GOLF_ID
        $this->CURRENT_GOLF_ID->ViewValue = $this->CURRENT_GOLF_ID->CurrentValue;
        $this->CURRENT_GOLF_ID->ViewCustomAttributes = "";

        // FUNCTIONAL
        $this->FUNCTIONAL->ViewValue = $this->FUNCTIONAL->CurrentValue;
        $this->FUNCTIONAL->ViewCustomAttributes = "";

        // TOTAL_CCP
        $this->TOTAL_CCP->ViewValue = $this->TOTAL_CCP->CurrentValue;
        $this->TOTAL_CCP->ViewValue = FormatNumber($this->TOTAL_CCP->ViewValue, 2, -2, -2, -2);
        $this->TOTAL_CCP->ViewCustomAttributes = "";

        // PWORKING_PERIOD_TH
        $this->PWORKING_PERIOD_TH->ViewValue = $this->PWORKING_PERIOD_TH->CurrentValue;
        $this->PWORKING_PERIOD_TH->ViewValue = FormatNumber($this->PWORKING_PERIOD_TH->ViewValue, 0, -2, -2, -2);
        $this->PWORKING_PERIOD_TH->ViewCustomAttributes = "";

        // P_WORKING_PERIOD_BLN
        $this->P_WORKING_PERIOD_BLN->ViewValue = $this->P_WORKING_PERIOD_BLN->CurrentValue;
        $this->P_WORKING_PERIOD_BLN->ViewValue = FormatNumber($this->P_WORKING_PERIOD_BLN->ViewValue, 0, -2, -2, -2);
        $this->P_WORKING_PERIOD_BLN->ViewCustomAttributes = "";

        // RWORKING_PERIOD_TH
        $this->RWORKING_PERIOD_TH->ViewValue = $this->RWORKING_PERIOD_TH->CurrentValue;
        $this->RWORKING_PERIOD_TH->ViewValue = FormatNumber($this->RWORKING_PERIOD_TH->ViewValue, 0, -2, -2, -2);
        $this->RWORKING_PERIOD_TH->ViewCustomAttributes = "";

        // RWORKING_PERIOD_BLN
        $this->RWORKING_PERIOD_BLN->ViewValue = $this->RWORKING_PERIOD_BLN->CurrentValue;
        $this->RWORKING_PERIOD_BLN->ViewValue = FormatNumber($this->RWORKING_PERIOD_BLN->ViewValue, 0, -2, -2, -2);
        $this->RWORKING_PERIOD_BLN->ViewCustomAttributes = "";

        // CURRENT_GOL_ID
        $this->CURRENT_GOL_ID->ViewValue = $this->CURRENT_GOL_ID->CurrentValue;
        $this->CURRENT_GOL_ID->ViewCustomAttributes = "";

        // GWORKING_PERIOD_TH
        $this->GWORKING_PERIOD_TH->ViewValue = $this->GWORKING_PERIOD_TH->CurrentValue;
        $this->GWORKING_PERIOD_TH->ViewValue = FormatNumber($this->GWORKING_PERIOD_TH->ViewValue, 0, -2, -2, -2);
        $this->GWORKING_PERIOD_TH->ViewCustomAttributes = "";

        // GWORKING_PERIOD_BLN
        $this->GWORKING_PERIOD_BLN->ViewValue = $this->GWORKING_PERIOD_BLN->CurrentValue;
        $this->GWORKING_PERIOD_BLN->ViewValue = FormatNumber($this->GWORKING_PERIOD_BLN->ViewValue, 0, -2, -2, -2);
        $this->GWORKING_PERIOD_BLN->ViewCustomAttributes = "";

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
        $this->EDUCATION_TYPE_CODE->ViewValue = FormatNumber($this->EDUCATION_TYPE_CODE->ViewValue, 0, -2, -2, -2);
        $this->EDUCATION_TYPE_CODE->ViewCustomAttributes = "";

        // NPWP
        $this->NPWP->ViewValue = $this->NPWP->CurrentValue;
        $this->NPWP->ViewCustomAttributes = "";

        // NATION_ID
        $this->NATION_ID->ViewValue = $this->NATION_ID->CurrentValue;
        $this->NATION_ID->ViewValue = FormatNumber($this->NATION_ID->ViewValue, 0, -2, -2, -2);
        $this->NATION_ID->ViewCustomAttributes = "";

        // PAID_ID
        $this->PAID_ID->ViewValue = $this->PAID_ID->CurrentValue;
        $this->PAID_ID->ViewCustomAttributes = "";

        // NONACTIVE
        $this->NONACTIVE->ViewValue = $this->NONACTIVE->CurrentValue;
        $this->NONACTIVE->ViewCustomAttributes = "";

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE->ViewValue = $this->NONACTIVE_DATE->CurrentValue;
        $this->NONACTIVE_DATE->ViewValue = FormatDateTime($this->NONACTIVE_DATE->ViewValue, 0);
        $this->NONACTIVE_DATE->ViewCustomAttributes = "";

        // NON_ACTIVE_TYPE
        $this->NON_ACTIVE_TYPE->ViewValue = $this->NON_ACTIVE_TYPE->CurrentValue;
        $this->NON_ACTIVE_TYPE->ViewValue = FormatNumber($this->NON_ACTIVE_TYPE->ViewValue, 0, -2, -2, -2);
        $this->NON_ACTIVE_TYPE->ViewCustomAttributes = "";

        // PENSION_DATE
        $this->PENSION_DATE->ViewValue = $this->PENSION_DATE->CurrentValue;
        $this->PENSION_DATE->ViewValue = FormatDateTime($this->PENSION_DATE->ViewValue, 0);
        $this->PENSION_DATE->ViewCustomAttributes = "";

        // MORTGAGEYEAR
        $this->MORTGAGEYEAR->ViewValue = $this->MORTGAGEYEAR->CurrentValue;
        $this->MORTGAGEYEAR->ViewValue = FormatNumber($this->MORTGAGEYEAR->ViewValue, 0, -2, -2, -2);
        $this->MORTGAGEYEAR->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // PICTUREFILE
        $this->PICTUREFILE->ViewValue = $this->PICTUREFILE->CurrentValue;
        $this->PICTUREFILE->ViewCustomAttributes = "";

        // FINGERSCANFILE
        $this->FINGERSCANFILE->ViewValue = $this->FINGERSCANFILE->CurrentValue;
        $this->FINGERSCANFILE->ViewCustomAttributes = "";

        // ISFULLTIME
        $this->ISFULLTIME->ViewValue = $this->ISFULLTIME->CurrentValue;
        $this->ISFULLTIME->ViewCustomAttributes = "";

        // SPECIALIST_TYPE_ID
        $curVal = trim(strval($this->SPECIALIST_TYPE_ID->CurrentValue));
        if ($curVal != "") {
            $this->SPECIALIST_TYPE_ID->ViewValue = $this->SPECIALIST_TYPE_ID->lookupCacheOption($curVal);
            if ($this->SPECIALIST_TYPE_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[SPECIALIST_TYPE_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->SPECIALIST_TYPE_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->SPECIALIST_TYPE_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->SPECIALIST_TYPE_ID->ViewValue = $this->SPECIALIST_TYPE_ID->displayValue($arwrk);
                } else {
                    $this->SPECIALIST_TYPE_ID->ViewValue = $this->SPECIALIST_TYPE_ID->CurrentValue;
                }
            }
        } else {
            $this->SPECIALIST_TYPE_ID->ViewValue = null;
        }
        $this->SPECIALIST_TYPE_ID->ViewCustomAttributes = "";

        // BANK_ID
        $this->BANK_ID->ViewValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->ViewCustomAttributes = "";

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->ViewValue = $this->BANK_ACCOUNT->CurrentValue;
        $this->BANK_ACCOUNT->ViewCustomAttributes = "";

        // NPK
        $this->NPK->ViewValue = $this->NPK->CurrentValue;
        $this->NPK->ViewCustomAttributes = "";

        // OTHER_ADDRESS
        $this->OTHER_ADDRESS->ViewValue = $this->OTHER_ADDRESS->CurrentValue;
        $this->OTHER_ADDRESS->ViewCustomAttributes = "";

        // DEATH_DATE
        $this->DEATH_DATE->ViewValue = $this->DEATH_DATE->CurrentValue;
        $this->DEATH_DATE->ViewValue = FormatDateTime($this->DEATH_DATE->ViewValue, 0);
        $this->DEATH_DATE->ViewCustomAttributes = "";

        // WEBSITE
        $this->WEBSITE->ViewValue = $this->WEBSITE->CurrentValue;
        $this->WEBSITE->ViewCustomAttributes = "";

        // NIP
        $this->NIP->ViewValue = $this->NIP->CurrentValue;
        $this->NIP->ViewCustomAttributes = "";

        // DPJP
        $this->DPJP->ViewValue = $this->DPJP->CurrentValue;
        $this->DPJP->ViewCustomAttributes = "";

        // SK_NO
        $this->SK_NO->ViewValue = $this->SK_NO->CurrentValue;
        $this->SK_NO->ViewCustomAttributes = "";

        // SK_TMT
        $this->SK_TMT->ViewValue = $this->SK_TMT->CurrentValue;
        $this->SK_TMT->ViewValue = FormatDateTime($this->SK_TMT->ViewValue, 0);
        $this->SK_TMT->ViewCustomAttributes = "";

        // SK_TAT
        $this->SK_TAT->ViewValue = $this->SK_TAT->CurrentValue;
        $this->SK_TAT->ViewValue = FormatDateTime($this->SK_TAT->ViewValue, 0);
        $this->SK_TAT->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->HrefValue = "";
        $this->OBJECT_CATEGORY_ID->TooltipValue = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // MYADDRESS
        $this->MYADDRESS->LinkCustomAttributes = "";
        $this->MYADDRESS->HrefValue = "";
        $this->MYADDRESS->TooltipValue = "";

        // POSTAL_CODE
        $this->POSTAL_CODE->LinkCustomAttributes = "";
        $this->POSTAL_CODE->HrefValue = "";
        $this->POSTAL_CODE->TooltipValue = "";

        // RT
        $this->RT->LinkCustomAttributes = "";
        $this->RT->HrefValue = "";
        $this->RT->TooltipValue = "";

        // RW
        $this->RW->LinkCustomAttributes = "";
        $this->RW->HrefValue = "";
        $this->RW->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // KEC_ID
        $this->KEC_ID->LinkCustomAttributes = "";
        $this->KEC_ID->HrefValue = "";
        $this->KEC_ID->TooltipValue = "";

        // KODE_KOTA
        $this->KODE_KOTA->LinkCustomAttributes = "";
        $this->KODE_KOTA->HrefValue = "";
        $this->KODE_KOTA->TooltipValue = "";

        // PROVINCE_CODE
        $this->PROVINCE_CODE->LinkCustomAttributes = "";
        $this->PROVINCE_CODE->HrefValue = "";
        $this->PROVINCE_CODE->TooltipValue = "";

        // COUNTRY_CODE
        $this->COUNTRY_CODE->LinkCustomAttributes = "";
        $this->COUNTRY_CODE->HrefValue = "";
        $this->COUNTRY_CODE->TooltipValue = "";

        // PHONE
        $this->PHONE->LinkCustomAttributes = "";
        $this->PHONE->HrefValue = "";
        $this->PHONE->TooltipValue = "";

        // FAX
        $this->FAX->LinkCustomAttributes = "";
        $this->FAX->HrefValue = "";
        $this->FAX->TooltipValue = "";

        // EMAIL
        $this->_EMAIL->LinkCustomAttributes = "";
        $this->_EMAIL->HrefValue = "";
        $this->_EMAIL->TooltipValue = "";

        // HANDPHONE
        $this->HANDPHONE->LinkCustomAttributes = "";
        $this->HANDPHONE->HrefValue = "";
        $this->HANDPHONE->TooltipValue = "";

        // KARPEG
        $this->KARPEG->LinkCustomAttributes = "";
        $this->KARPEG->HrefValue = "";
        $this->KARPEG->TooltipValue = "";

        // KARIS
        $this->KARIS->LinkCustomAttributes = "";
        $this->KARIS->HrefValue = "";
        $this->KARIS->TooltipValue = "";

        // ASKES
        $this->ASKES->LinkCustomAttributes = "";
        $this->ASKES->HrefValue = "";
        $this->ASKES->TooltipValue = "";

        // TASPEN
        $this->TASPEN->LinkCustomAttributes = "";
        $this->TASPEN->HrefValue = "";
        $this->TASPEN->TooltipValue = "";

        // FULLNAME
        $this->FULLNAME->LinkCustomAttributes = "";
        $this->FULLNAME->HrefValue = "";
        $this->FULLNAME->TooltipValue = "";

        // GELAR_DEPAN
        $this->GELAR_DEPAN->LinkCustomAttributes = "";
        $this->GELAR_DEPAN->HrefValue = "";
        $this->GELAR_DEPAN->TooltipValue = "";

        // GELAR_BELAKANG
        $this->GELAR_BELAKANG->LinkCustomAttributes = "";
        $this->GELAR_BELAKANG->HrefValue = "";
        $this->GELAR_BELAKANG->TooltipValue = "";

        // NICKNAME
        $this->NICKNAME->LinkCustomAttributes = "";
        $this->NICKNAME->HrefValue = "";
        $this->NICKNAME->TooltipValue = "";

        // PLACEOFBIRTH
        $this->PLACEOFBIRTH->LinkCustomAttributes = "";
        $this->PLACEOFBIRTH->HrefValue = "";
        $this->PLACEOFBIRTH->TooltipValue = "";

        // DATEOFBIRTH
        $this->DATEOFBIRTH->LinkCustomAttributes = "";
        $this->DATEOFBIRTH->HrefValue = "";
        $this->DATEOFBIRTH->TooltipValue = "";

        // KODE_AGAMA
        $this->KODE_AGAMA->LinkCustomAttributes = "";
        $this->KODE_AGAMA->HrefValue = "";
        $this->KODE_AGAMA->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->LinkCustomAttributes = "";
        $this->MARITALSTATUSID->HrefValue = "";
        $this->MARITALSTATUSID->TooltipValue = "";

        // BLOOD_ID
        $this->BLOOD_ID->LinkCustomAttributes = "";
        $this->BLOOD_ID->HrefValue = "";
        $this->BLOOD_ID->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // KODE_JABATAN
        $this->KODE_JABATAN->LinkCustomAttributes = "";
        $this->KODE_JABATAN->HrefValue = "";
        $this->KODE_JABATAN->TooltipValue = "";

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE->LinkCustomAttributes = "";
        $this->EMPLOYEED_DATE->HrefValue = "";
        $this->EMPLOYEED_DATE->TooltipValue = "";

        // EMP_TYPE
        $this->EMP_TYPE->LinkCustomAttributes = "";
        $this->EMP_TYPE->HrefValue = "";
        $this->EMP_TYPE->TooltipValue = "";

        // STATUS_ID
        $this->STATUS_ID->LinkCustomAttributes = "";
        $this->STATUS_ID->HrefValue = "";
        $this->STATUS_ID->TooltipValue = "";

        // CURRENT_GOLF_ID
        $this->CURRENT_GOLF_ID->LinkCustomAttributes = "";
        $this->CURRENT_GOLF_ID->HrefValue = "";
        $this->CURRENT_GOLF_ID->TooltipValue = "";

        // FUNCTIONAL
        $this->FUNCTIONAL->LinkCustomAttributes = "";
        $this->FUNCTIONAL->HrefValue = "";
        $this->FUNCTIONAL->TooltipValue = "";

        // TOTAL_CCP
        $this->TOTAL_CCP->LinkCustomAttributes = "";
        $this->TOTAL_CCP->HrefValue = "";
        $this->TOTAL_CCP->TooltipValue = "";

        // PWORKING_PERIOD_TH
        $this->PWORKING_PERIOD_TH->LinkCustomAttributes = "";
        $this->PWORKING_PERIOD_TH->HrefValue = "";
        $this->PWORKING_PERIOD_TH->TooltipValue = "";

        // P_WORKING_PERIOD_BLN
        $this->P_WORKING_PERIOD_BLN->LinkCustomAttributes = "";
        $this->P_WORKING_PERIOD_BLN->HrefValue = "";
        $this->P_WORKING_PERIOD_BLN->TooltipValue = "";

        // RWORKING_PERIOD_TH
        $this->RWORKING_PERIOD_TH->LinkCustomAttributes = "";
        $this->RWORKING_PERIOD_TH->HrefValue = "";
        $this->RWORKING_PERIOD_TH->TooltipValue = "";

        // RWORKING_PERIOD_BLN
        $this->RWORKING_PERIOD_BLN->LinkCustomAttributes = "";
        $this->RWORKING_PERIOD_BLN->HrefValue = "";
        $this->RWORKING_PERIOD_BLN->TooltipValue = "";

        // CURRENT_GOL_ID
        $this->CURRENT_GOL_ID->LinkCustomAttributes = "";
        $this->CURRENT_GOL_ID->HrefValue = "";
        $this->CURRENT_GOL_ID->TooltipValue = "";

        // GWORKING_PERIOD_TH
        $this->GWORKING_PERIOD_TH->LinkCustomAttributes = "";
        $this->GWORKING_PERIOD_TH->HrefValue = "";
        $this->GWORKING_PERIOD_TH->TooltipValue = "";

        // GWORKING_PERIOD_BLN
        $this->GWORKING_PERIOD_BLN->LinkCustomAttributes = "";
        $this->GWORKING_PERIOD_BLN->HrefValue = "";
        $this->GWORKING_PERIOD_BLN->TooltipValue = "";

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->LinkCustomAttributes = "";
        $this->EDUCATION_TYPE_CODE->HrefValue = "";
        $this->EDUCATION_TYPE_CODE->TooltipValue = "";

        // NPWP
        $this->NPWP->LinkCustomAttributes = "";
        $this->NPWP->HrefValue = "";
        $this->NPWP->TooltipValue = "";

        // NATION_ID
        $this->NATION_ID->LinkCustomAttributes = "";
        $this->NATION_ID->HrefValue = "";
        $this->NATION_ID->TooltipValue = "";

        // PAID_ID
        $this->PAID_ID->LinkCustomAttributes = "";
        $this->PAID_ID->HrefValue = "";
        $this->PAID_ID->TooltipValue = "";

        // NONACTIVE
        $this->NONACTIVE->LinkCustomAttributes = "";
        $this->NONACTIVE->HrefValue = "";
        $this->NONACTIVE->TooltipValue = "";

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE->LinkCustomAttributes = "";
        $this->NONACTIVE_DATE->HrefValue = "";
        $this->NONACTIVE_DATE->TooltipValue = "";

        // NON_ACTIVE_TYPE
        $this->NON_ACTIVE_TYPE->LinkCustomAttributes = "";
        $this->NON_ACTIVE_TYPE->HrefValue = "";
        $this->NON_ACTIVE_TYPE->TooltipValue = "";

        // PENSION_DATE
        $this->PENSION_DATE->LinkCustomAttributes = "";
        $this->PENSION_DATE->HrefValue = "";
        $this->PENSION_DATE->TooltipValue = "";

        // MORTGAGEYEAR
        $this->MORTGAGEYEAR->LinkCustomAttributes = "";
        $this->MORTGAGEYEAR->HrefValue = "";
        $this->MORTGAGEYEAR->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // PICTUREFILE
        $this->PICTUREFILE->LinkCustomAttributes = "";
        $this->PICTUREFILE->HrefValue = "";
        $this->PICTUREFILE->TooltipValue = "";

        // FINGERSCANFILE
        $this->FINGERSCANFILE->LinkCustomAttributes = "";
        $this->FINGERSCANFILE->HrefValue = "";
        $this->FINGERSCANFILE->TooltipValue = "";

        // ISFULLTIME
        $this->ISFULLTIME->LinkCustomAttributes = "";
        $this->ISFULLTIME->HrefValue = "";
        $this->ISFULLTIME->TooltipValue = "";

        // SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID->LinkCustomAttributes = "";
        $this->SPECIALIST_TYPE_ID->HrefValue = "";
        $this->SPECIALIST_TYPE_ID->TooltipValue = "";

        // BANK_ID
        $this->BANK_ID->LinkCustomAttributes = "";
        $this->BANK_ID->HrefValue = "";
        $this->BANK_ID->TooltipValue = "";

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->LinkCustomAttributes = "";
        $this->BANK_ACCOUNT->HrefValue = "";
        $this->BANK_ACCOUNT->TooltipValue = "";

        // NPK
        $this->NPK->LinkCustomAttributes = "";
        $this->NPK->HrefValue = "";
        $this->NPK->TooltipValue = "";

        // OTHER_ADDRESS
        $this->OTHER_ADDRESS->LinkCustomAttributes = "";
        $this->OTHER_ADDRESS->HrefValue = "";
        $this->OTHER_ADDRESS->TooltipValue = "";

        // DEATH_DATE
        $this->DEATH_DATE->LinkCustomAttributes = "";
        $this->DEATH_DATE->HrefValue = "";
        $this->DEATH_DATE->TooltipValue = "";

        // WEBSITE
        $this->WEBSITE->LinkCustomAttributes = "";
        $this->WEBSITE->HrefValue = "";
        $this->WEBSITE->TooltipValue = "";

        // NIP
        $this->NIP->LinkCustomAttributes = "";
        $this->NIP->HrefValue = "";
        $this->NIP->TooltipValue = "";

        // DPJP
        $this->DPJP->LinkCustomAttributes = "";
        $this->DPJP->HrefValue = "";
        $this->DPJP->TooltipValue = "";

        // SK_NO
        $this->SK_NO->LinkCustomAttributes = "";
        $this->SK_NO->HrefValue = "";
        $this->SK_NO->TooltipValue = "";

        // SK_TMT
        $this->SK_TMT->LinkCustomAttributes = "";
        $this->SK_TMT->HrefValue = "";
        $this->SK_TMT->TooltipValue = "";

        // SK_TAT
        $this->SK_TAT->LinkCustomAttributes = "";
        $this->SK_TAT->HrefValue = "";
        $this->SK_TAT->TooltipValue = "";

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

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->OBJECT_CATEGORY_ID->EditCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->EditValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->OBJECT_CATEGORY_ID->caption());

        // ORG_UNIT_CODE

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // MYADDRESS
        $this->MYADDRESS->EditAttrs["class"] = "form-control";
        $this->MYADDRESS->EditCustomAttributes = "";
        if (!$this->MYADDRESS->Raw) {
            $this->MYADDRESS->CurrentValue = HtmlDecode($this->MYADDRESS->CurrentValue);
        }
        $this->MYADDRESS->EditValue = $this->MYADDRESS->CurrentValue;
        $this->MYADDRESS->PlaceHolder = RemoveHtml($this->MYADDRESS->caption());

        // POSTAL_CODE
        $this->POSTAL_CODE->EditAttrs["class"] = "form-control";
        $this->POSTAL_CODE->EditCustomAttributes = "";
        if (!$this->POSTAL_CODE->Raw) {
            $this->POSTAL_CODE->CurrentValue = HtmlDecode($this->POSTAL_CODE->CurrentValue);
        }
        $this->POSTAL_CODE->EditValue = $this->POSTAL_CODE->CurrentValue;
        $this->POSTAL_CODE->PlaceHolder = RemoveHtml($this->POSTAL_CODE->caption());

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

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // KEC_ID
        $this->KEC_ID->EditAttrs["class"] = "form-control";
        $this->KEC_ID->EditCustomAttributes = "";
        if (!$this->KEC_ID->Raw) {
            $this->KEC_ID->CurrentValue = HtmlDecode($this->KEC_ID->CurrentValue);
        }
        $this->KEC_ID->EditValue = $this->KEC_ID->CurrentValue;
        $this->KEC_ID->PlaceHolder = RemoveHtml($this->KEC_ID->caption());

        // KODE_KOTA
        $this->KODE_KOTA->EditAttrs["class"] = "form-control";
        $this->KODE_KOTA->EditCustomAttributes = "";
        if (!$this->KODE_KOTA->Raw) {
            $this->KODE_KOTA->CurrentValue = HtmlDecode($this->KODE_KOTA->CurrentValue);
        }
        $this->KODE_KOTA->EditValue = $this->KODE_KOTA->CurrentValue;
        $this->KODE_KOTA->PlaceHolder = RemoveHtml($this->KODE_KOTA->caption());

        // PROVINCE_CODE
        $this->PROVINCE_CODE->EditAttrs["class"] = "form-control";
        $this->PROVINCE_CODE->EditCustomAttributes = "";
        if (!$this->PROVINCE_CODE->Raw) {
            $this->PROVINCE_CODE->CurrentValue = HtmlDecode($this->PROVINCE_CODE->CurrentValue);
        }
        $this->PROVINCE_CODE->EditValue = $this->PROVINCE_CODE->CurrentValue;
        $this->PROVINCE_CODE->PlaceHolder = RemoveHtml($this->PROVINCE_CODE->caption());

        // COUNTRY_CODE
        $this->COUNTRY_CODE->EditAttrs["class"] = "form-control";
        $this->COUNTRY_CODE->EditCustomAttributes = "";
        if (!$this->COUNTRY_CODE->Raw) {
            $this->COUNTRY_CODE->CurrentValue = HtmlDecode($this->COUNTRY_CODE->CurrentValue);
        }
        $this->COUNTRY_CODE->EditValue = $this->COUNTRY_CODE->CurrentValue;
        $this->COUNTRY_CODE->PlaceHolder = RemoveHtml($this->COUNTRY_CODE->caption());

        // PHONE
        $this->PHONE->EditAttrs["class"] = "form-control";
        $this->PHONE->EditCustomAttributes = "";
        if (!$this->PHONE->Raw) {
            $this->PHONE->CurrentValue = HtmlDecode($this->PHONE->CurrentValue);
        }
        $this->PHONE->EditValue = $this->PHONE->CurrentValue;
        $this->PHONE->PlaceHolder = RemoveHtml($this->PHONE->caption());

        // FAX
        $this->FAX->EditAttrs["class"] = "form-control";
        $this->FAX->EditCustomAttributes = "";
        if (!$this->FAX->Raw) {
            $this->FAX->CurrentValue = HtmlDecode($this->FAX->CurrentValue);
        }
        $this->FAX->EditValue = $this->FAX->CurrentValue;
        $this->FAX->PlaceHolder = RemoveHtml($this->FAX->caption());

        // EMAIL
        $this->_EMAIL->EditAttrs["class"] = "form-control";
        $this->_EMAIL->EditCustomAttributes = "";
        if (!$this->_EMAIL->Raw) {
            $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
        }
        $this->_EMAIL->EditValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

        // HANDPHONE
        $this->HANDPHONE->EditAttrs["class"] = "form-control";
        $this->HANDPHONE->EditCustomAttributes = "";
        if (!$this->HANDPHONE->Raw) {
            $this->HANDPHONE->CurrentValue = HtmlDecode($this->HANDPHONE->CurrentValue);
        }
        $this->HANDPHONE->EditValue = $this->HANDPHONE->CurrentValue;
        $this->HANDPHONE->PlaceHolder = RemoveHtml($this->HANDPHONE->caption());

        // KARPEG
        $this->KARPEG->EditAttrs["class"] = "form-control";
        $this->KARPEG->EditCustomAttributes = "";
        if (!$this->KARPEG->Raw) {
            $this->KARPEG->CurrentValue = HtmlDecode($this->KARPEG->CurrentValue);
        }
        $this->KARPEG->EditValue = $this->KARPEG->CurrentValue;
        $this->KARPEG->PlaceHolder = RemoveHtml($this->KARPEG->caption());

        // KARIS
        $this->KARIS->EditAttrs["class"] = "form-control";
        $this->KARIS->EditCustomAttributes = "";
        if (!$this->KARIS->Raw) {
            $this->KARIS->CurrentValue = HtmlDecode($this->KARIS->CurrentValue);
        }
        $this->KARIS->EditValue = $this->KARIS->CurrentValue;
        $this->KARIS->PlaceHolder = RemoveHtml($this->KARIS->caption());

        // ASKES
        $this->ASKES->EditAttrs["class"] = "form-control";
        $this->ASKES->EditCustomAttributes = "";
        if (!$this->ASKES->Raw) {
            $this->ASKES->CurrentValue = HtmlDecode($this->ASKES->CurrentValue);
        }
        $this->ASKES->EditValue = $this->ASKES->CurrentValue;
        $this->ASKES->PlaceHolder = RemoveHtml($this->ASKES->caption());

        // TASPEN
        $this->TASPEN->EditAttrs["class"] = "form-control";
        $this->TASPEN->EditCustomAttributes = "";
        if (!$this->TASPEN->Raw) {
            $this->TASPEN->CurrentValue = HtmlDecode($this->TASPEN->CurrentValue);
        }
        $this->TASPEN->EditValue = $this->TASPEN->CurrentValue;
        $this->TASPEN->PlaceHolder = RemoveHtml($this->TASPEN->caption());

        // FULLNAME
        $this->FULLNAME->EditAttrs["class"] = "form-control";
        $this->FULLNAME->EditCustomAttributes = "";
        if (!$this->FULLNAME->Raw) {
            $this->FULLNAME->CurrentValue = HtmlDecode($this->FULLNAME->CurrentValue);
        }
        $this->FULLNAME->EditValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->PlaceHolder = RemoveHtml($this->FULLNAME->caption());

        // GELAR_DEPAN
        $this->GELAR_DEPAN->EditAttrs["class"] = "form-control";
        $this->GELAR_DEPAN->EditCustomAttributes = "";
        if (!$this->GELAR_DEPAN->Raw) {
            $this->GELAR_DEPAN->CurrentValue = HtmlDecode($this->GELAR_DEPAN->CurrentValue);
        }
        $this->GELAR_DEPAN->EditValue = $this->GELAR_DEPAN->CurrentValue;
        $this->GELAR_DEPAN->PlaceHolder = RemoveHtml($this->GELAR_DEPAN->caption());

        // GELAR_BELAKANG
        $this->GELAR_BELAKANG->EditAttrs["class"] = "form-control";
        $this->GELAR_BELAKANG->EditCustomAttributes = "";
        if (!$this->GELAR_BELAKANG->Raw) {
            $this->GELAR_BELAKANG->CurrentValue = HtmlDecode($this->GELAR_BELAKANG->CurrentValue);
        }
        $this->GELAR_BELAKANG->EditValue = $this->GELAR_BELAKANG->CurrentValue;
        $this->GELAR_BELAKANG->PlaceHolder = RemoveHtml($this->GELAR_BELAKANG->caption());

        // NICKNAME
        $this->NICKNAME->EditAttrs["class"] = "form-control";
        $this->NICKNAME->EditCustomAttributes = "";
        if (!$this->NICKNAME->Raw) {
            $this->NICKNAME->CurrentValue = HtmlDecode($this->NICKNAME->CurrentValue);
        }
        $this->NICKNAME->EditValue = $this->NICKNAME->CurrentValue;
        $this->NICKNAME->PlaceHolder = RemoveHtml($this->NICKNAME->caption());

        // PLACEOFBIRTH
        $this->PLACEOFBIRTH->EditAttrs["class"] = "form-control";
        $this->PLACEOFBIRTH->EditCustomAttributes = "";
        if (!$this->PLACEOFBIRTH->Raw) {
            $this->PLACEOFBIRTH->CurrentValue = HtmlDecode($this->PLACEOFBIRTH->CurrentValue);
        }
        $this->PLACEOFBIRTH->EditValue = $this->PLACEOFBIRTH->CurrentValue;
        $this->PLACEOFBIRTH->PlaceHolder = RemoveHtml($this->PLACEOFBIRTH->caption());

        // DATEOFBIRTH
        $this->DATEOFBIRTH->EditAttrs["class"] = "form-control";
        $this->DATEOFBIRTH->EditCustomAttributes = "";
        $this->DATEOFBIRTH->EditValue = FormatDateTime($this->DATEOFBIRTH->CurrentValue, 8);
        $this->DATEOFBIRTH->PlaceHolder = RemoveHtml($this->DATEOFBIRTH->caption());

        // KODE_AGAMA
        $this->KODE_AGAMA->EditAttrs["class"] = "form-control";
        $this->KODE_AGAMA->EditCustomAttributes = "";
        $this->KODE_AGAMA->EditValue = $this->KODE_AGAMA->CurrentValue;
        $this->KODE_AGAMA->PlaceHolder = RemoveHtml($this->KODE_AGAMA->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // MARITALSTATUSID
        $this->MARITALSTATUSID->EditAttrs["class"] = "form-control";
        $this->MARITALSTATUSID->EditCustomAttributes = "";
        $this->MARITALSTATUSID->EditValue = $this->MARITALSTATUSID->CurrentValue;
        $this->MARITALSTATUSID->PlaceHolder = RemoveHtml($this->MARITALSTATUSID->caption());

        // BLOOD_ID
        $this->BLOOD_ID->EditAttrs["class"] = "form-control";
        $this->BLOOD_ID->EditCustomAttributes = "";
        $this->BLOOD_ID->EditValue = $this->BLOOD_ID->CurrentValue;
        $this->BLOOD_ID->PlaceHolder = RemoveHtml($this->BLOOD_ID->caption());

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

        // KODE_JABATAN
        $this->KODE_JABATAN->EditAttrs["class"] = "form-control";
        $this->KODE_JABATAN->EditCustomAttributes = "";
        if (!$this->KODE_JABATAN->Raw) {
            $this->KODE_JABATAN->CurrentValue = HtmlDecode($this->KODE_JABATAN->CurrentValue);
        }
        $this->KODE_JABATAN->EditValue = $this->KODE_JABATAN->CurrentValue;
        $this->KODE_JABATAN->PlaceHolder = RemoveHtml($this->KODE_JABATAN->caption());

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE->EditAttrs["class"] = "form-control";
        $this->EMPLOYEED_DATE->EditCustomAttributes = "";
        $this->EMPLOYEED_DATE->EditValue = FormatDateTime($this->EMPLOYEED_DATE->CurrentValue, 8);
        $this->EMPLOYEED_DATE->PlaceHolder = RemoveHtml($this->EMPLOYEED_DATE->caption());

        // EMP_TYPE
        $this->EMP_TYPE->EditAttrs["class"] = "form-control";
        $this->EMP_TYPE->EditCustomAttributes = "";
        $this->EMP_TYPE->EditValue = $this->EMP_TYPE->CurrentValue;
        $this->EMP_TYPE->PlaceHolder = RemoveHtml($this->EMP_TYPE->caption());

        // STATUS_ID
        $this->STATUS_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_ID->EditCustomAttributes = "";
        $this->STATUS_ID->EditValue = $this->STATUS_ID->CurrentValue;
        $this->STATUS_ID->PlaceHolder = RemoveHtml($this->STATUS_ID->caption());

        // CURRENT_GOLF_ID
        $this->CURRENT_GOLF_ID->EditAttrs["class"] = "form-control";
        $this->CURRENT_GOLF_ID->EditCustomAttributes = "";
        if (!$this->CURRENT_GOLF_ID->Raw) {
            $this->CURRENT_GOLF_ID->CurrentValue = HtmlDecode($this->CURRENT_GOLF_ID->CurrentValue);
        }
        $this->CURRENT_GOLF_ID->EditValue = $this->CURRENT_GOLF_ID->CurrentValue;
        $this->CURRENT_GOLF_ID->PlaceHolder = RemoveHtml($this->CURRENT_GOLF_ID->caption());

        // FUNCTIONAL
        $this->FUNCTIONAL->EditAttrs["class"] = "form-control";
        $this->FUNCTIONAL->EditCustomAttributes = "";
        if (!$this->FUNCTIONAL->Raw) {
            $this->FUNCTIONAL->CurrentValue = HtmlDecode($this->FUNCTIONAL->CurrentValue);
        }
        $this->FUNCTIONAL->EditValue = $this->FUNCTIONAL->CurrentValue;
        $this->FUNCTIONAL->PlaceHolder = RemoveHtml($this->FUNCTIONAL->caption());

        // TOTAL_CCP
        $this->TOTAL_CCP->EditAttrs["class"] = "form-control";
        $this->TOTAL_CCP->EditCustomAttributes = "";
        $this->TOTAL_CCP->EditValue = $this->TOTAL_CCP->CurrentValue;
        $this->TOTAL_CCP->PlaceHolder = RemoveHtml($this->TOTAL_CCP->caption());
        if (strval($this->TOTAL_CCP->EditValue) != "" && is_numeric($this->TOTAL_CCP->EditValue)) {
            $this->TOTAL_CCP->EditValue = FormatNumber($this->TOTAL_CCP->EditValue, -2, -2, -2, -2);
        }

        // PWORKING_PERIOD_TH
        $this->PWORKING_PERIOD_TH->EditAttrs["class"] = "form-control";
        $this->PWORKING_PERIOD_TH->EditCustomAttributes = "";
        $this->PWORKING_PERIOD_TH->EditValue = $this->PWORKING_PERIOD_TH->CurrentValue;
        $this->PWORKING_PERIOD_TH->PlaceHolder = RemoveHtml($this->PWORKING_PERIOD_TH->caption());

        // P_WORKING_PERIOD_BLN
        $this->P_WORKING_PERIOD_BLN->EditAttrs["class"] = "form-control";
        $this->P_WORKING_PERIOD_BLN->EditCustomAttributes = "";
        $this->P_WORKING_PERIOD_BLN->EditValue = $this->P_WORKING_PERIOD_BLN->CurrentValue;
        $this->P_WORKING_PERIOD_BLN->PlaceHolder = RemoveHtml($this->P_WORKING_PERIOD_BLN->caption());

        // RWORKING_PERIOD_TH
        $this->RWORKING_PERIOD_TH->EditAttrs["class"] = "form-control";
        $this->RWORKING_PERIOD_TH->EditCustomAttributes = "";
        $this->RWORKING_PERIOD_TH->EditValue = $this->RWORKING_PERIOD_TH->CurrentValue;
        $this->RWORKING_PERIOD_TH->PlaceHolder = RemoveHtml($this->RWORKING_PERIOD_TH->caption());

        // RWORKING_PERIOD_BLN
        $this->RWORKING_PERIOD_BLN->EditAttrs["class"] = "form-control";
        $this->RWORKING_PERIOD_BLN->EditCustomAttributes = "";
        $this->RWORKING_PERIOD_BLN->EditValue = $this->RWORKING_PERIOD_BLN->CurrentValue;
        $this->RWORKING_PERIOD_BLN->PlaceHolder = RemoveHtml($this->RWORKING_PERIOD_BLN->caption());

        // CURRENT_GOL_ID
        $this->CURRENT_GOL_ID->EditAttrs["class"] = "form-control";
        $this->CURRENT_GOL_ID->EditCustomAttributes = "";
        if (!$this->CURRENT_GOL_ID->Raw) {
            $this->CURRENT_GOL_ID->CurrentValue = HtmlDecode($this->CURRENT_GOL_ID->CurrentValue);
        }
        $this->CURRENT_GOL_ID->EditValue = $this->CURRENT_GOL_ID->CurrentValue;
        $this->CURRENT_GOL_ID->PlaceHolder = RemoveHtml($this->CURRENT_GOL_ID->caption());

        // GWORKING_PERIOD_TH
        $this->GWORKING_PERIOD_TH->EditAttrs["class"] = "form-control";
        $this->GWORKING_PERIOD_TH->EditCustomAttributes = "";
        $this->GWORKING_PERIOD_TH->EditValue = $this->GWORKING_PERIOD_TH->CurrentValue;
        $this->GWORKING_PERIOD_TH->PlaceHolder = RemoveHtml($this->GWORKING_PERIOD_TH->caption());

        // GWORKING_PERIOD_BLN
        $this->GWORKING_PERIOD_BLN->EditAttrs["class"] = "form-control";
        $this->GWORKING_PERIOD_BLN->EditCustomAttributes = "";
        $this->GWORKING_PERIOD_BLN->EditValue = $this->GWORKING_PERIOD_BLN->CurrentValue;
        $this->GWORKING_PERIOD_BLN->PlaceHolder = RemoveHtml($this->GWORKING_PERIOD_BLN->caption());

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->EditAttrs["class"] = "form-control";
        $this->EDUCATION_TYPE_CODE->EditCustomAttributes = "";
        $this->EDUCATION_TYPE_CODE->EditValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
        $this->EDUCATION_TYPE_CODE->PlaceHolder = RemoveHtml($this->EDUCATION_TYPE_CODE->caption());

        // NPWP
        $this->NPWP->EditAttrs["class"] = "form-control";
        $this->NPWP->EditCustomAttributes = "";
        if (!$this->NPWP->Raw) {
            $this->NPWP->CurrentValue = HtmlDecode($this->NPWP->CurrentValue);
        }
        $this->NPWP->EditValue = $this->NPWP->CurrentValue;
        $this->NPWP->PlaceHolder = RemoveHtml($this->NPWP->caption());

        // NATION_ID
        $this->NATION_ID->EditAttrs["class"] = "form-control";
        $this->NATION_ID->EditCustomAttributes = "";
        $this->NATION_ID->EditValue = $this->NATION_ID->CurrentValue;
        $this->NATION_ID->PlaceHolder = RemoveHtml($this->NATION_ID->caption());

        // PAID_ID
        $this->PAID_ID->EditAttrs["class"] = "form-control";
        $this->PAID_ID->EditCustomAttributes = "";
        if (!$this->PAID_ID->Raw) {
            $this->PAID_ID->CurrentValue = HtmlDecode($this->PAID_ID->CurrentValue);
        }
        $this->PAID_ID->EditValue = $this->PAID_ID->CurrentValue;
        $this->PAID_ID->PlaceHolder = RemoveHtml($this->PAID_ID->caption());

        // NONACTIVE
        $this->NONACTIVE->EditAttrs["class"] = "form-control";
        $this->NONACTIVE->EditCustomAttributes = "";
        if (!$this->NONACTIVE->Raw) {
            $this->NONACTIVE->CurrentValue = HtmlDecode($this->NONACTIVE->CurrentValue);
        }
        $this->NONACTIVE->EditValue = $this->NONACTIVE->CurrentValue;
        $this->NONACTIVE->PlaceHolder = RemoveHtml($this->NONACTIVE->caption());

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE->EditAttrs["class"] = "form-control";
        $this->NONACTIVE_DATE->EditCustomAttributes = "";
        $this->NONACTIVE_DATE->EditValue = FormatDateTime($this->NONACTIVE_DATE->CurrentValue, 8);
        $this->NONACTIVE_DATE->PlaceHolder = RemoveHtml($this->NONACTIVE_DATE->caption());

        // NON_ACTIVE_TYPE
        $this->NON_ACTIVE_TYPE->EditAttrs["class"] = "form-control";
        $this->NON_ACTIVE_TYPE->EditCustomAttributes = "";
        $this->NON_ACTIVE_TYPE->EditValue = $this->NON_ACTIVE_TYPE->CurrentValue;
        $this->NON_ACTIVE_TYPE->PlaceHolder = RemoveHtml($this->NON_ACTIVE_TYPE->caption());

        // PENSION_DATE
        $this->PENSION_DATE->EditAttrs["class"] = "form-control";
        $this->PENSION_DATE->EditCustomAttributes = "";
        $this->PENSION_DATE->EditValue = FormatDateTime($this->PENSION_DATE->CurrentValue, 8);
        $this->PENSION_DATE->PlaceHolder = RemoveHtml($this->PENSION_DATE->caption());

        // MORTGAGEYEAR
        $this->MORTGAGEYEAR->EditAttrs["class"] = "form-control";
        $this->MORTGAGEYEAR->EditCustomAttributes = "";
        $this->MORTGAGEYEAR->EditValue = $this->MORTGAGEYEAR->CurrentValue;
        $this->MORTGAGEYEAR->PlaceHolder = RemoveHtml($this->MORTGAGEYEAR->caption());

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

        // PICTUREFILE
        $this->PICTUREFILE->EditAttrs["class"] = "form-control";
        $this->PICTUREFILE->EditCustomAttributes = "";
        if (!$this->PICTUREFILE->Raw) {
            $this->PICTUREFILE->CurrentValue = HtmlDecode($this->PICTUREFILE->CurrentValue);
        }
        $this->PICTUREFILE->EditValue = $this->PICTUREFILE->CurrentValue;
        $this->PICTUREFILE->PlaceHolder = RemoveHtml($this->PICTUREFILE->caption());

        // FINGERSCANFILE
        $this->FINGERSCANFILE->EditAttrs["class"] = "form-control";
        $this->FINGERSCANFILE->EditCustomAttributes = "";
        if (!$this->FINGERSCANFILE->Raw) {
            $this->FINGERSCANFILE->CurrentValue = HtmlDecode($this->FINGERSCANFILE->CurrentValue);
        }
        $this->FINGERSCANFILE->EditValue = $this->FINGERSCANFILE->CurrentValue;
        $this->FINGERSCANFILE->PlaceHolder = RemoveHtml($this->FINGERSCANFILE->caption());

        // ISFULLTIME
        $this->ISFULLTIME->EditAttrs["class"] = "form-control";
        $this->ISFULLTIME->EditCustomAttributes = "";
        if (!$this->ISFULLTIME->Raw) {
            $this->ISFULLTIME->CurrentValue = HtmlDecode($this->ISFULLTIME->CurrentValue);
        }
        $this->ISFULLTIME->EditValue = $this->ISFULLTIME->CurrentValue;
        $this->ISFULLTIME->PlaceHolder = RemoveHtml($this->ISFULLTIME->caption());

        // SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID->EditAttrs["class"] = "form-control";
        $this->SPECIALIST_TYPE_ID->EditCustomAttributes = "";
        $this->SPECIALIST_TYPE_ID->PlaceHolder = RemoveHtml($this->SPECIALIST_TYPE_ID->caption());

        // BANK_ID
        $this->BANK_ID->EditAttrs["class"] = "form-control";
        $this->BANK_ID->EditCustomAttributes = "";
        if (!$this->BANK_ID->Raw) {
            $this->BANK_ID->CurrentValue = HtmlDecode($this->BANK_ID->CurrentValue);
        }
        $this->BANK_ID->EditValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->PlaceHolder = RemoveHtml($this->BANK_ID->caption());

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->EditAttrs["class"] = "form-control";
        $this->BANK_ACCOUNT->EditCustomAttributes = "";
        if (!$this->BANK_ACCOUNT->Raw) {
            $this->BANK_ACCOUNT->CurrentValue = HtmlDecode($this->BANK_ACCOUNT->CurrentValue);
        }
        $this->BANK_ACCOUNT->EditValue = $this->BANK_ACCOUNT->CurrentValue;
        $this->BANK_ACCOUNT->PlaceHolder = RemoveHtml($this->BANK_ACCOUNT->caption());

        // NPK
        $this->NPK->EditAttrs["class"] = "form-control";
        $this->NPK->EditCustomAttributes = "";
        if (!$this->NPK->Raw) {
            $this->NPK->CurrentValue = HtmlDecode($this->NPK->CurrentValue);
        }
        $this->NPK->EditValue = $this->NPK->CurrentValue;
        $this->NPK->PlaceHolder = RemoveHtml($this->NPK->caption());

        // OTHER_ADDRESS
        $this->OTHER_ADDRESS->EditAttrs["class"] = "form-control";
        $this->OTHER_ADDRESS->EditCustomAttributes = "";
        if (!$this->OTHER_ADDRESS->Raw) {
            $this->OTHER_ADDRESS->CurrentValue = HtmlDecode($this->OTHER_ADDRESS->CurrentValue);
        }
        $this->OTHER_ADDRESS->EditValue = $this->OTHER_ADDRESS->CurrentValue;
        $this->OTHER_ADDRESS->PlaceHolder = RemoveHtml($this->OTHER_ADDRESS->caption());

        // DEATH_DATE
        $this->DEATH_DATE->EditAttrs["class"] = "form-control";
        $this->DEATH_DATE->EditCustomAttributes = "";
        $this->DEATH_DATE->EditValue = FormatDateTime($this->DEATH_DATE->CurrentValue, 8);
        $this->DEATH_DATE->PlaceHolder = RemoveHtml($this->DEATH_DATE->caption());

        // WEBSITE
        $this->WEBSITE->EditAttrs["class"] = "form-control";
        $this->WEBSITE->EditCustomAttributes = "";
        if (!$this->WEBSITE->Raw) {
            $this->WEBSITE->CurrentValue = HtmlDecode($this->WEBSITE->CurrentValue);
        }
        $this->WEBSITE->EditValue = $this->WEBSITE->CurrentValue;
        $this->WEBSITE->PlaceHolder = RemoveHtml($this->WEBSITE->caption());

        // NIP
        $this->NIP->EditAttrs["class"] = "form-control";
        $this->NIP->EditCustomAttributes = "";
        if (!$this->NIP->Raw) {
            $this->NIP->CurrentValue = HtmlDecode($this->NIP->CurrentValue);
        }
        $this->NIP->EditValue = $this->NIP->CurrentValue;
        $this->NIP->PlaceHolder = RemoveHtml($this->NIP->caption());

        // DPJP
        $this->DPJP->EditAttrs["class"] = "form-control";
        $this->DPJP->EditCustomAttributes = "";
        if (!$this->DPJP->Raw) {
            $this->DPJP->CurrentValue = HtmlDecode($this->DPJP->CurrentValue);
        }
        $this->DPJP->EditValue = $this->DPJP->CurrentValue;
        $this->DPJP->PlaceHolder = RemoveHtml($this->DPJP->caption());

        // SK_NO
        $this->SK_NO->EditAttrs["class"] = "form-control";
        $this->SK_NO->EditCustomAttributes = "";
        if (!$this->SK_NO->Raw) {
            $this->SK_NO->CurrentValue = HtmlDecode($this->SK_NO->CurrentValue);
        }
        $this->SK_NO->EditValue = $this->SK_NO->CurrentValue;
        $this->SK_NO->PlaceHolder = RemoveHtml($this->SK_NO->caption());

        // SK_TMT
        $this->SK_TMT->EditAttrs["class"] = "form-control";
        $this->SK_TMT->EditCustomAttributes = "";
        $this->SK_TMT->EditValue = FormatDateTime($this->SK_TMT->CurrentValue, 8);
        $this->SK_TMT->PlaceHolder = RemoveHtml($this->SK_TMT->caption());

        // SK_TAT
        $this->SK_TAT->EditAttrs["class"] = "form-control";
        $this->SK_TAT->EditCustomAttributes = "";
        $this->SK_TAT->EditValue = FormatDateTime($this->SK_TAT->CurrentValue, 8);
        $this->SK_TAT->PlaceHolder = RemoveHtml($this->SK_TAT->caption());

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
                } else {
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->MYADDRESS);
                    $doc->exportCaption($this->POSTAL_CODE);
                    $doc->exportCaption($this->RT);
                    $doc->exportCaption($this->RW);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->KEC_ID);
                    $doc->exportCaption($this->KODE_KOTA);
                    $doc->exportCaption($this->PROVINCE_CODE);
                    $doc->exportCaption($this->COUNTRY_CODE);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->HANDPHONE);
                    $doc->exportCaption($this->KARPEG);
                    $doc->exportCaption($this->KARIS);
                    $doc->exportCaption($this->ASKES);
                    $doc->exportCaption($this->TASPEN);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->GELAR_DEPAN);
                    $doc->exportCaption($this->GELAR_BELAKANG);
                    $doc->exportCaption($this->NICKNAME);
                    $doc->exportCaption($this->PLACEOFBIRTH);
                    $doc->exportCaption($this->DATEOFBIRTH);
                    $doc->exportCaption($this->KODE_AGAMA);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->MARITALSTATUSID);
                    $doc->exportCaption($this->BLOOD_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->KODE_JABATAN);
                    $doc->exportCaption($this->EMPLOYEED_DATE);
                    $doc->exportCaption($this->EMP_TYPE);
                    $doc->exportCaption($this->STATUS_ID);
                    $doc->exportCaption($this->CURRENT_GOLF_ID);
                    $doc->exportCaption($this->FUNCTIONAL);
                    $doc->exportCaption($this->TOTAL_CCP);
                    $doc->exportCaption($this->PWORKING_PERIOD_TH);
                    $doc->exportCaption($this->P_WORKING_PERIOD_BLN);
                    $doc->exportCaption($this->RWORKING_PERIOD_TH);
                    $doc->exportCaption($this->RWORKING_PERIOD_BLN);
                    $doc->exportCaption($this->CURRENT_GOL_ID);
                    $doc->exportCaption($this->GWORKING_PERIOD_TH);
                    $doc->exportCaption($this->GWORKING_PERIOD_BLN);
                    $doc->exportCaption($this->EDUCATION_TYPE_CODE);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->NATION_ID);
                    $doc->exportCaption($this->PAID_ID);
                    $doc->exportCaption($this->NONACTIVE);
                    $doc->exportCaption($this->NONACTIVE_DATE);
                    $doc->exportCaption($this->NON_ACTIVE_TYPE);
                    $doc->exportCaption($this->PENSION_DATE);
                    $doc->exportCaption($this->MORTGAGEYEAR);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->PICTUREFILE);
                    $doc->exportCaption($this->FINGERSCANFILE);
                    $doc->exportCaption($this->ISFULLTIME);
                    $doc->exportCaption($this->SPECIALIST_TYPE_ID);
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->BANK_ACCOUNT);
                    $doc->exportCaption($this->NPK);
                    $doc->exportCaption($this->OTHER_ADDRESS);
                    $doc->exportCaption($this->DEATH_DATE);
                    $doc->exportCaption($this->WEBSITE);
                    $doc->exportCaption($this->NIP);
                    $doc->exportCaption($this->DPJP);
                    $doc->exportCaption($this->SK_NO);
                    $doc->exportCaption($this->SK_TMT);
                    $doc->exportCaption($this->SK_TAT);
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
                    } else {
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->MYADDRESS);
                        $doc->exportField($this->POSTAL_CODE);
                        $doc->exportField($this->RT);
                        $doc->exportField($this->RW);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->KEC_ID);
                        $doc->exportField($this->KODE_KOTA);
                        $doc->exportField($this->PROVINCE_CODE);
                        $doc->exportField($this->COUNTRY_CODE);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->HANDPHONE);
                        $doc->exportField($this->KARPEG);
                        $doc->exportField($this->KARIS);
                        $doc->exportField($this->ASKES);
                        $doc->exportField($this->TASPEN);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->GELAR_DEPAN);
                        $doc->exportField($this->GELAR_BELAKANG);
                        $doc->exportField($this->NICKNAME);
                        $doc->exportField($this->PLACEOFBIRTH);
                        $doc->exportField($this->DATEOFBIRTH);
                        $doc->exportField($this->KODE_AGAMA);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->MARITALSTATUSID);
                        $doc->exportField($this->BLOOD_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->KODE_JABATAN);
                        $doc->exportField($this->EMPLOYEED_DATE);
                        $doc->exportField($this->EMP_TYPE);
                        $doc->exportField($this->STATUS_ID);
                        $doc->exportField($this->CURRENT_GOLF_ID);
                        $doc->exportField($this->FUNCTIONAL);
                        $doc->exportField($this->TOTAL_CCP);
                        $doc->exportField($this->PWORKING_PERIOD_TH);
                        $doc->exportField($this->P_WORKING_PERIOD_BLN);
                        $doc->exportField($this->RWORKING_PERIOD_TH);
                        $doc->exportField($this->RWORKING_PERIOD_BLN);
                        $doc->exportField($this->CURRENT_GOL_ID);
                        $doc->exportField($this->GWORKING_PERIOD_TH);
                        $doc->exportField($this->GWORKING_PERIOD_BLN);
                        $doc->exportField($this->EDUCATION_TYPE_CODE);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->NATION_ID);
                        $doc->exportField($this->PAID_ID);
                        $doc->exportField($this->NONACTIVE);
                        $doc->exportField($this->NONACTIVE_DATE);
                        $doc->exportField($this->NON_ACTIVE_TYPE);
                        $doc->exportField($this->PENSION_DATE);
                        $doc->exportField($this->MORTGAGEYEAR);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->PICTUREFILE);
                        $doc->exportField($this->FINGERSCANFILE);
                        $doc->exportField($this->ISFULLTIME);
                        $doc->exportField($this->SPECIALIST_TYPE_ID);
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->BANK_ACCOUNT);
                        $doc->exportField($this->NPK);
                        $doc->exportField($this->OTHER_ADDRESS);
                        $doc->exportField($this->DEATH_DATE);
                        $doc->exportField($this->WEBSITE);
                        $doc->exportField($this->NIP);
                        $doc->exportField($this->DPJP);
                        $doc->exportField($this->SK_NO);
                        $doc->exportField($this->SK_TMT);
                        $doc->exportField($this->SK_TAT);
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
