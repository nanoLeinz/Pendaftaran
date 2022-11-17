<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for ORGANIZATIONUNIT
 */
class Organizationunit extends DbTable
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
    public $OBJECT_CATEGORY_ID;
    public $ORG_UNIT_CODE;
    public $ORG_TYPE;
    public $CLASS_ID;
    public $HIRARKI_ID;
    public $NAME_OF_ORG_UNIT;
    public $EMPLOYEE_ID;
    public $CONTACT_ADDRESS;
    public $KEC_ID;
    public $KAL_ID;
    public $KODE_KOTA;
    public $SK;
    public $PENETAP_ID;
    public $BY_ID;
    public $ACCREDITATION;
    public $ACCREDIT_STATUS;
    public $SK_STATUS;
    public $WEBSITE;
    public $_EMAIL;
    public $WIN_MENU;
    public $LOGOFILE;
    public $IP_ADDRESS;
    public $DESCRIPTION;
    public $DENAH_FILE;
    public $BIDANG_ID;
    public $MAIN_PARENT;
    public $DIRECT_PARENT;
    public $WHOLE_PARENT;
    public $HEADER;
    public $PHONE;
    public $FAX;
    public $POSTAL_CODE;
    public $DISPLAY;
    public $OTHER_CODE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $ISSTATE;
    public $REGISTRATION_DATE;
    public $LUAS_TANAH;
    public $LUAS_BANGUNAN;
    public $SK_MASA;
    public $ACCREDITATION_DATE;
    public $TT_VVIP;
    public $TT_VIP;
    public $TT_1;
    public $TT_2;
    public $TT_3;
    public $DR_SPA;
    public $DR_SPOG;
    public $dr_sppd;
    public $dr_spb;
    public $dr_sprad;
    public $dr_sprm;
    public $dr_span;
    public $dr_spjp;
    public $dr_spm;
    public $dr_sptht;
    public $dr_spkj;
    public $dr_um;
    public $drg;
    public $drg_sp;
    public $prwt;
    public $bdn;
    public $far;
    public $tkes;
    public $tNONkes;
    public $sk_date;
    public $KECAMATAN;
    public $KELURAHAN;
    public $KOTA;
    public $SERVERNAME;
    public $DBNAMES;
    public $DBPARENT;
    public $CONSID;
    public $CONSECRET;
    public $PCAREUN;
    public $PCAREPSW;
    public $KDAPLIKASI;
    public $PCAREDIR;
    public $PCAREBASEURL0;
    public $PCAREBASEURL1;
    public $PCAREBASEURL2;
    public $DBUN;
    public $DBPSW;
    public $PICTUREFILE;
    public $PROVINSI;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'ORGANIZATIONUNIT';
        $this->TableName = 'ORGANIZATIONUNIT';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[ORGANIZATIONUNIT]";
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

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_OBJECT_CATEGORY_ID', 'OBJECT_CATEGORY_ID', '[OBJECT_CATEGORY_ID]', 'CAST([OBJECT_CATEGORY_ID] AS NVARCHAR)', 2, 2, -1, false, '[OBJECT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECT_CATEGORY_ID->Nullable = false; // NOT NULL field
        $this->OBJECT_CATEGORY_ID->Required = true; // Required field
        $this->OBJECT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->OBJECT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->OBJECT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['OBJECT_CATEGORY_ID'] = &$this->OBJECT_CATEGORY_ID;

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // ORG_TYPE
        $this->ORG_TYPE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_ORG_TYPE', 'ORG_TYPE', '[ORG_TYPE]', '[ORG_TYPE]', 200, 5, -1, false, '[ORG_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_TYPE->Sortable = true; // Allow sort
        $this->ORG_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_TYPE->Param, "CustomMsg");
        $this->Fields['ORG_TYPE'] = &$this->ORG_TYPE;

        // CLASS_ID
        $this->CLASS_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // HIRARKI_ID
        $this->HIRARKI_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_HIRARKI_ID', 'HIRARKI_ID', '[HIRARKI_ID]', 'CAST([HIRARKI_ID] AS NVARCHAR)', 17, 1, -1, false, '[HIRARKI_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HIRARKI_ID->Sortable = true; // Allow sort
        $this->HIRARKI_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->HIRARKI_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HIRARKI_ID->Param, "CustomMsg");
        $this->Fields['HIRARKI_ID'] = &$this->HIRARKI_ID;

        // NAME_OF_ORG_UNIT
        $this->NAME_OF_ORG_UNIT = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_NAME_OF_ORG_UNIT', 'NAME_OF_ORG_UNIT', '[NAME_OF_ORG_UNIT]', '[NAME_OF_ORG_UNIT]', 200, 100, -1, false, '[NAME_OF_ORG_UNIT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_OF_ORG_UNIT->Sortable = true; // Allow sort
        $this->NAME_OF_ORG_UNIT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_OF_ORG_UNIT->Param, "CustomMsg");
        $this->Fields['NAME_OF_ORG_UNIT'] = &$this->NAME_OF_ORG_UNIT;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 50, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_CONTACT_ADDRESS', 'CONTACT_ADDRESS', '[CONTACT_ADDRESS]', '[CONTACT_ADDRESS]', 200, 100, -1, false, '[CONTACT_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTACT_ADDRESS->Sortable = true; // Allow sort
        $this->CONTACT_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTACT_ADDRESS->Param, "CustomMsg");
        $this->Fields['CONTACT_ADDRESS'] = &$this->CONTACT_ADDRESS;

        // KEC_ID
        $this->KEC_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_KEC_ID', 'KEC_ID', '[KEC_ID]', '[KEC_ID]', 200, 8, -1, false, '[KEC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KEC_ID->Sortable = true; // Allow sort
        $this->KEC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KEC_ID->Param, "CustomMsg");
        $this->Fields['KEC_ID'] = &$this->KEC_ID;

        // KAL_ID
        $this->KAL_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 8, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // KODE_KOTA
        $this->KODE_KOTA = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_KODE_KOTA', 'KODE_KOTA', '[KODE_KOTA]', '[KODE_KOTA]', 200, 8, -1, false, '[KODE_KOTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODE_KOTA->Sortable = true; // Allow sort
        $this->KODE_KOTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE_KOTA->Param, "CustomMsg");
        $this->Fields['KODE_KOTA'] = &$this->KODE_KOTA;

        // SK
        $this->SK = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_SK', 'SK', '[SK]', '[SK]', 200, 100, -1, false, '[SK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SK->Sortable = true; // Allow sort
        $this->SK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SK->Param, "CustomMsg");
        $this->Fields['SK'] = &$this->SK;

        // PENETAP_ID
        $this->PENETAP_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PENETAP_ID', 'PENETAP_ID', '[PENETAP_ID]', 'CAST([PENETAP_ID] AS NVARCHAR)', 17, 1, -1, false, '[PENETAP_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PENETAP_ID->Sortable = true; // Allow sort
        $this->PENETAP_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PENETAP_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PENETAP_ID->Param, "CustomMsg");
        $this->Fields['PENETAP_ID'] = &$this->PENETAP_ID;

        // BY_ID
        $this->BY_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_BY_ID', 'BY_ID', '[BY_ID]', 'CAST([BY_ID] AS NVARCHAR)', 17, 1, -1, false, '[BY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BY_ID->Sortable = true; // Allow sort
        $this->BY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BY_ID->Param, "CustomMsg");
        $this->Fields['BY_ID'] = &$this->BY_ID;

        // ACCREDITATION
        $this->ACCREDITATION = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_ACCREDITATION', 'ACCREDITATION', '[ACCREDITATION]', 'CAST([ACCREDITATION] AS NVARCHAR)', 17, 1, -1, false, '[ACCREDITATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCREDITATION->Sortable = true; // Allow sort
        $this->ACCREDITATION->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ACCREDITATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCREDITATION->Param, "CustomMsg");
        $this->Fields['ACCREDITATION'] = &$this->ACCREDITATION;

        // ACCREDIT_STATUS
        $this->ACCREDIT_STATUS = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_ACCREDIT_STATUS', 'ACCREDIT_STATUS', '[ACCREDIT_STATUS]', 'CAST([ACCREDIT_STATUS] AS NVARCHAR)', 17, 1, -1, false, '[ACCREDIT_STATUS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCREDIT_STATUS->Sortable = true; // Allow sort
        $this->ACCREDIT_STATUS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ACCREDIT_STATUS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCREDIT_STATUS->Param, "CustomMsg");
        $this->Fields['ACCREDIT_STATUS'] = &$this->ACCREDIT_STATUS;

        // SK_STATUS
        $this->SK_STATUS = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_SK_STATUS', 'SK_STATUS', '[SK_STATUS]', 'CAST([SK_STATUS] AS NVARCHAR)', 17, 1, -1, false, '[SK_STATUS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SK_STATUS->Sortable = true; // Allow sort
        $this->SK_STATUS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SK_STATUS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SK_STATUS->Param, "CustomMsg");
        $this->Fields['SK_STATUS'] = &$this->SK_STATUS;

        // WEBSITE
        $this->WEBSITE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_WEBSITE', 'WEBSITE', '[WEBSITE]', '[WEBSITE]', 200, 100, -1, false, '[WEBSITE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WEBSITE->Sortable = true; // Allow sort
        $this->WEBSITE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WEBSITE->Param, "CustomMsg");
        $this->Fields['WEBSITE'] = &$this->WEBSITE;

        // EMAIL
        $this->_EMAIL = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x__EMAIL', 'EMAIL', '[EMAIL]', '[EMAIL]', 200, 100, -1, false, '[EMAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_EMAIL->Sortable = true; // Allow sort
        $this->_EMAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_EMAIL->Param, "CustomMsg");
        $this->Fields['EMAIL'] = &$this->_EMAIL;

        // WIN_MENU
        $this->WIN_MENU = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_WIN_MENU', 'WIN_MENU', '[WIN_MENU]', '[WIN_MENU]', 200, 50, -1, false, '[WIN_MENU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WIN_MENU->Sortable = true; // Allow sort
        $this->WIN_MENU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WIN_MENU->Param, "CustomMsg");
        $this->Fields['WIN_MENU'] = &$this->WIN_MENU;

        // LOGOFILE
        $this->LOGOFILE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_LOGOFILE', 'LOGOFILE', '[LOGOFILE]', '[LOGOFILE]', 200, 200, -1, false, '[LOGOFILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LOGOFILE->Sortable = true; // Allow sort
        $this->LOGOFILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LOGOFILE->Param, "CustomMsg");
        $this->Fields['LOGOFILE'] = &$this->LOGOFILE;

        // IP_ADDRESS
        $this->IP_ADDRESS = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_IP_ADDRESS', 'IP_ADDRESS', '[IP_ADDRESS]', '[IP_ADDRESS]', 200, 100, -1, false, '[IP_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IP_ADDRESS->Sortable = true; // Allow sort
        $this->IP_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IP_ADDRESS->Param, "CustomMsg");
        $this->Fields['IP_ADDRESS'] = &$this->IP_ADDRESS;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 0, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // DENAH_FILE
        $this->DENAH_FILE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DENAH_FILE', 'DENAH_FILE', '[DENAH_FILE]', '[DENAH_FILE]', 200, 100, -1, false, '[DENAH_FILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DENAH_FILE->Sortable = true; // Allow sort
        $this->DENAH_FILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DENAH_FILE->Param, "CustomMsg");
        $this->Fields['DENAH_FILE'] = &$this->DENAH_FILE;

        // BIDANG_ID
        $this->BIDANG_ID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_BIDANG_ID', 'BIDANG_ID', '[BIDANG_ID]', 'CAST([BIDANG_ID] AS NVARCHAR)', 17, 1, -1, false, '[BIDANG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIDANG_ID->Sortable = true; // Allow sort
        $this->BIDANG_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BIDANG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIDANG_ID->Param, "CustomMsg");
        $this->Fields['BIDANG_ID'] = &$this->BIDANG_ID;

        // MAIN_PARENT
        $this->MAIN_PARENT = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_MAIN_PARENT', 'MAIN_PARENT', '[MAIN_PARENT]', '[MAIN_PARENT]', 200, 50, -1, false, '[MAIN_PARENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MAIN_PARENT->Sortable = true; // Allow sort
        $this->MAIN_PARENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MAIN_PARENT->Param, "CustomMsg");
        $this->Fields['MAIN_PARENT'] = &$this->MAIN_PARENT;

        // DIRECT_PARENT
        $this->DIRECT_PARENT = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DIRECT_PARENT', 'DIRECT_PARENT', '[DIRECT_PARENT]', '[DIRECT_PARENT]', 200, 50, -1, false, '[DIRECT_PARENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIRECT_PARENT->Sortable = true; // Allow sort
        $this->DIRECT_PARENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIRECT_PARENT->Param, "CustomMsg");
        $this->Fields['DIRECT_PARENT'] = &$this->DIRECT_PARENT;

        // WHOLE_PARENT
        $this->WHOLE_PARENT = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_WHOLE_PARENT', 'WHOLE_PARENT', '[WHOLE_PARENT]', '[WHOLE_PARENT]', 200, 50, -1, false, '[WHOLE_PARENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WHOLE_PARENT->Sortable = true; // Allow sort
        $this->WHOLE_PARENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WHOLE_PARENT->Param, "CustomMsg");
        $this->Fields['WHOLE_PARENT'] = &$this->WHOLE_PARENT;

        // HEADER
        $this->HEADER = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_HEADER', 'HEADER', '[HEADER]', '[HEADER]', 200, 200, -1, false, '[HEADER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HEADER->Sortable = true; // Allow sort
        $this->HEADER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HEADER->Param, "CustomMsg");
        $this->Fields['HEADER'] = &$this->HEADER;

        // PHONE
        $this->PHONE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PHONE', 'PHONE', '[PHONE]', '[PHONE]', 200, 50, -1, false, '[PHONE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE->Sortable = true; // Allow sort
        $this->PHONE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE->Param, "CustomMsg");
        $this->Fields['PHONE'] = &$this->PHONE;

        // FAX
        $this->FAX = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_FAX', 'FAX', '[FAX]', '[FAX]', 200, 50, -1, false, '[FAX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX->Sortable = true; // Allow sort
        $this->FAX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX->Param, "CustomMsg");
        $this->Fields['FAX'] = &$this->FAX;

        // POSTAL_CODE
        $this->POSTAL_CODE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_POSTAL_CODE', 'POSTAL_CODE', '[POSTAL_CODE]', '[POSTAL_CODE]', 200, 10, -1, false, '[POSTAL_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POSTAL_CODE->Sortable = true; // Allow sort
        $this->POSTAL_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POSTAL_CODE->Param, "CustomMsg");
        $this->Fields['POSTAL_CODE'] = &$this->POSTAL_CODE;

        // DISPLAY
        $this->DISPLAY = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DISPLAY', 'DISPLAY', '[DISPLAY]', '[DISPLAY]', 200, 50, -1, false, '[DISPLAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISPLAY->Sortable = true; // Allow sort
        $this->DISPLAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISPLAY->Param, "CustomMsg");
        $this->Fields['DISPLAY'] = &$this->DISPLAY;

        // OTHER_CODE
        $this->OTHER_CODE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_OTHER_CODE', 'OTHER_CODE', '[OTHER_CODE]', '[OTHER_CODE]', 200, 50, -1, false, '[OTHER_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_CODE->Sortable = true; // Allow sort
        $this->OTHER_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_CODE->Param, "CustomMsg");
        $this->Fields['OTHER_CODE'] = &$this->OTHER_CODE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // ISSTATE
        $this->ISSTATE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_ISSTATE', 'ISSTATE', '[ISSTATE]', '[ISSTATE]', 129, 1, -1, false, '[ISSTATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISSTATE->Sortable = true; // Allow sort
        $this->ISSTATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISSTATE->Param, "CustomMsg");
        $this->Fields['ISSTATE'] = &$this->ISSTATE;

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_REGISTRATION_DATE', 'REGISTRATION_DATE', '[REGISTRATION_DATE]', CastDateFieldForLike("[REGISTRATION_DATE]", 0, "DB"), 135, 8, 0, false, '[REGISTRATION_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REGISTRATION_DATE->Sortable = true; // Allow sort
        $this->REGISTRATION_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REGISTRATION_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REGISTRATION_DATE->Param, "CustomMsg");
        $this->Fields['REGISTRATION_DATE'] = &$this->REGISTRATION_DATE;

        // LUAS_TANAH
        $this->LUAS_TANAH = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_LUAS_TANAH', 'LUAS_TANAH', '[LUAS_TANAH]', 'CAST([LUAS_TANAH] AS NVARCHAR)', 131, 8, -1, false, '[LUAS_TANAH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LUAS_TANAH->Sortable = true; // Allow sort
        $this->LUAS_TANAH->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->LUAS_TANAH->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->LUAS_TANAH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LUAS_TANAH->Param, "CustomMsg");
        $this->Fields['LUAS_TANAH'] = &$this->LUAS_TANAH;

        // LUAS_BANGUNAN
        $this->LUAS_BANGUNAN = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_LUAS_BANGUNAN', 'LUAS_BANGUNAN', '[LUAS_BANGUNAN]', 'CAST([LUAS_BANGUNAN] AS NVARCHAR)', 131, 8, -1, false, '[LUAS_BANGUNAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LUAS_BANGUNAN->Sortable = true; // Allow sort
        $this->LUAS_BANGUNAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->LUAS_BANGUNAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->LUAS_BANGUNAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LUAS_BANGUNAN->Param, "CustomMsg");
        $this->Fields['LUAS_BANGUNAN'] = &$this->LUAS_BANGUNAN;

        // SK_MASA
        $this->SK_MASA = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_SK_MASA', 'SK_MASA', '[SK_MASA]', CastDateFieldForLike("[SK_MASA]", 0, "DB"), 135, 8, 0, false, '[SK_MASA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SK_MASA->Sortable = true; // Allow sort
        $this->SK_MASA->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SK_MASA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SK_MASA->Param, "CustomMsg");
        $this->Fields['SK_MASA'] = &$this->SK_MASA;

        // ACCREDITATION_DATE
        $this->ACCREDITATION_DATE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_ACCREDITATION_DATE', 'ACCREDITATION_DATE', '[ACCREDITATION_DATE]', CastDateFieldForLike("[ACCREDITATION_DATE]", 0, "DB"), 135, 8, 0, false, '[ACCREDITATION_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCREDITATION_DATE->Sortable = true; // Allow sort
        $this->ACCREDITATION_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->ACCREDITATION_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCREDITATION_DATE->Param, "CustomMsg");
        $this->Fields['ACCREDITATION_DATE'] = &$this->ACCREDITATION_DATE;

        // TT_VVIP
        $this->TT_VVIP = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_TT_VVIP', 'TT_VVIP', '[TT_VVIP]', 'CAST([TT_VVIP] AS NVARCHAR)', 2, 2, -1, false, '[TT_VVIP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TT_VVIP->Sortable = true; // Allow sort
        $this->TT_VVIP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TT_VVIP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TT_VVIP->Param, "CustomMsg");
        $this->Fields['TT_VVIP'] = &$this->TT_VVIP;

        // TT_VIP
        $this->TT_VIP = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_TT_VIP', 'TT_VIP', '[TT_VIP]', 'CAST([TT_VIP] AS NVARCHAR)', 2, 2, -1, false, '[TT_VIP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TT_VIP->Sortable = true; // Allow sort
        $this->TT_VIP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TT_VIP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TT_VIP->Param, "CustomMsg");
        $this->Fields['TT_VIP'] = &$this->TT_VIP;

        // TT_1
        $this->TT_1 = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_TT_1', 'TT_1', '[TT_1]', 'CAST([TT_1] AS NVARCHAR)', 2, 2, -1, false, '[TT_1]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TT_1->Sortable = true; // Allow sort
        $this->TT_1->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TT_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TT_1->Param, "CustomMsg");
        $this->Fields['TT_1'] = &$this->TT_1;

        // TT_2
        $this->TT_2 = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_TT_2', 'TT_2', '[TT_2]', 'CAST([TT_2] AS NVARCHAR)', 2, 2, -1, false, '[TT_2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TT_2->Sortable = true; // Allow sort
        $this->TT_2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TT_2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TT_2->Param, "CustomMsg");
        $this->Fields['TT_2'] = &$this->TT_2;

        // TT_3
        $this->TT_3 = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_TT_3', 'TT_3', '[TT_3]', 'CAST([TT_3] AS NVARCHAR)', 2, 2, -1, false, '[TT_3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TT_3->Sortable = true; // Allow sort
        $this->TT_3->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TT_3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TT_3->Param, "CustomMsg");
        $this->Fields['TT_3'] = &$this->TT_3;

        // DR_SPA
        $this->DR_SPA = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DR_SPA', 'DR_SPA', '[DR_SPA]', 'CAST([DR_SPA] AS NVARCHAR)', 2, 2, -1, false, '[DR_SPA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DR_SPA->Sortable = true; // Allow sort
        $this->DR_SPA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DR_SPA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DR_SPA->Param, "CustomMsg");
        $this->Fields['DR_SPA'] = &$this->DR_SPA;

        // DR_SPOG
        $this->DR_SPOG = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DR_SPOG', 'DR_SPOG', '[DR_SPOG]', 'CAST([DR_SPOG] AS NVARCHAR)', 2, 2, -1, false, '[DR_SPOG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DR_SPOG->Sortable = true; // Allow sort
        $this->DR_SPOG->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DR_SPOG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DR_SPOG->Param, "CustomMsg");
        $this->Fields['DR_SPOG'] = &$this->DR_SPOG;

        // dr_sppd
        $this->dr_sppd = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_sppd', 'dr_sppd', '[dr_sppd]', 'CAST([dr_sppd] AS NVARCHAR)', 2, 2, -1, false, '[dr_sppd]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_sppd->Sortable = true; // Allow sort
        $this->dr_sppd->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_sppd->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_sppd->Param, "CustomMsg");
        $this->Fields['dr_sppd'] = &$this->dr_sppd;

        // dr_spb
        $this->dr_spb = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_spb', 'dr_spb', '[dr_spb]', 'CAST([dr_spb] AS NVARCHAR)', 2, 2, -1, false, '[dr_spb]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_spb->Sortable = true; // Allow sort
        $this->dr_spb->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_spb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_spb->Param, "CustomMsg");
        $this->Fields['dr_spb'] = &$this->dr_spb;

        // dr_sprad
        $this->dr_sprad = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_sprad', 'dr_sprad', '[dr_sprad]', 'CAST([dr_sprad] AS NVARCHAR)', 2, 2, -1, false, '[dr_sprad]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_sprad->Sortable = true; // Allow sort
        $this->dr_sprad->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_sprad->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_sprad->Param, "CustomMsg");
        $this->Fields['dr_sprad'] = &$this->dr_sprad;

        // dr_sprm
        $this->dr_sprm = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_sprm', 'dr_sprm', '[dr_sprm]', 'CAST([dr_sprm] AS NVARCHAR)', 2, 2, -1, false, '[dr_sprm]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_sprm->Sortable = true; // Allow sort
        $this->dr_sprm->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_sprm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_sprm->Param, "CustomMsg");
        $this->Fields['dr_sprm'] = &$this->dr_sprm;

        // dr_span
        $this->dr_span = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_span', 'dr_span', '[dr_span]', 'CAST([dr_span] AS NVARCHAR)', 2, 2, -1, false, '[dr_span]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_span->Sortable = true; // Allow sort
        $this->dr_span->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_span->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_span->Param, "CustomMsg");
        $this->Fields['dr_span'] = &$this->dr_span;

        // dr_spjp
        $this->dr_spjp = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_spjp', 'dr_spjp', '[dr_spjp]', 'CAST([dr_spjp] AS NVARCHAR)', 2, 2, -1, false, '[dr_spjp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_spjp->Sortable = true; // Allow sort
        $this->dr_spjp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_spjp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_spjp->Param, "CustomMsg");
        $this->Fields['dr_spjp'] = &$this->dr_spjp;

        // dr_spm
        $this->dr_spm = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_spm', 'dr_spm', '[dr_spm]', 'CAST([dr_spm] AS NVARCHAR)', 2, 2, -1, false, '[dr_spm]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_spm->Sortable = true; // Allow sort
        $this->dr_spm->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_spm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_spm->Param, "CustomMsg");
        $this->Fields['dr_spm'] = &$this->dr_spm;

        // dr_sptht
        $this->dr_sptht = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_sptht', 'dr_sptht', '[dr_sptht]', 'CAST([dr_sptht] AS NVARCHAR)', 2, 2, -1, false, '[dr_sptht]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_sptht->Sortable = true; // Allow sort
        $this->dr_sptht->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_sptht->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_sptht->Param, "CustomMsg");
        $this->Fields['dr_sptht'] = &$this->dr_sptht;

        // dr_spkj
        $this->dr_spkj = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_spkj', 'dr_spkj', '[dr_spkj]', 'CAST([dr_spkj] AS NVARCHAR)', 2, 2, -1, false, '[dr_spkj]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_spkj->Sortable = true; // Allow sort
        $this->dr_spkj->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_spkj->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_spkj->Param, "CustomMsg");
        $this->Fields['dr_spkj'] = &$this->dr_spkj;

        // dr_um
        $this->dr_um = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_dr_um', 'dr_um', '[dr_um]', 'CAST([dr_um] AS NVARCHAR)', 2, 2, -1, false, '[dr_um]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dr_um->Sortable = true; // Allow sort
        $this->dr_um->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->dr_um->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dr_um->Param, "CustomMsg");
        $this->Fields['dr_um'] = &$this->dr_um;

        // drg
        $this->drg = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_drg', 'drg', '[drg]', 'CAST([drg] AS NVARCHAR)', 2, 2, -1, false, '[drg]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->drg->Sortable = true; // Allow sort
        $this->drg->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->drg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->drg->Param, "CustomMsg");
        $this->Fields['drg'] = &$this->drg;

        // drg_sp
        $this->drg_sp = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_drg_sp', 'drg_sp', '[drg_sp]', 'CAST([drg_sp] AS NVARCHAR)', 2, 2, -1, false, '[drg_sp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->drg_sp->Sortable = true; // Allow sort
        $this->drg_sp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->drg_sp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->drg_sp->Param, "CustomMsg");
        $this->Fields['drg_sp'] = &$this->drg_sp;

        // prwt
        $this->prwt = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_prwt', 'prwt', '[prwt]', 'CAST([prwt] AS NVARCHAR)', 2, 2, -1, false, '[prwt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->prwt->Sortable = true; // Allow sort
        $this->prwt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->prwt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->prwt->Param, "CustomMsg");
        $this->Fields['prwt'] = &$this->prwt;

        // bdn
        $this->bdn = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_bdn', 'bdn', '[bdn]', 'CAST([bdn] AS NVARCHAR)', 2, 2, -1, false, '[bdn]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bdn->Sortable = true; // Allow sort
        $this->bdn->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bdn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bdn->Param, "CustomMsg");
        $this->Fields['bdn'] = &$this->bdn;

        // far
        $this->far = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_far', 'far', '[far]', 'CAST([far] AS NVARCHAR)', 2, 2, -1, false, '[far]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->far->Sortable = true; // Allow sort
        $this->far->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->far->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->far->Param, "CustomMsg");
        $this->Fields['far'] = &$this->far;

        // tkes
        $this->tkes = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_tkes', 'tkes', '[tkes]', 'CAST([tkes] AS NVARCHAR)', 2, 2, -1, false, '[tkes]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tkes->Sortable = true; // Allow sort
        $this->tkes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->tkes->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tkes->Param, "CustomMsg");
        $this->Fields['tkes'] = &$this->tkes;

        // tNONkes
        $this->tNONkes = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_tNONkes', 'tNONkes', '[tNONkes]', 'CAST([tNONkes] AS NVARCHAR)', 2, 2, -1, false, '[tNONkes]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tNONkes->Sortable = true; // Allow sort
        $this->tNONkes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->tNONkes->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tNONkes->Param, "CustomMsg");
        $this->Fields['tNONkes'] = &$this->tNONkes;

        // sk_date
        $this->sk_date = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_sk_date', 'sk_date', '[sk_date]', CastDateFieldForLike("[sk_date]", 0, "DB"), 135, 8, 0, false, '[sk_date]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sk_date->Sortable = true; // Allow sort
        $this->sk_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->sk_date->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sk_date->Param, "CustomMsg");
        $this->Fields['sk_date'] = &$this->sk_date;

        // KECAMATAN
        $this->KECAMATAN = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_KECAMATAN', 'KECAMATAN', '[KECAMATAN]', '[KECAMATAN]', 200, 50, -1, false, '[KECAMATAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KECAMATAN->Sortable = true; // Allow sort
        $this->KECAMATAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KECAMATAN->Param, "CustomMsg");
        $this->Fields['KECAMATAN'] = &$this->KECAMATAN;

        // KELURAHAN
        $this->KELURAHAN = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_KELURAHAN', 'KELURAHAN', '[KELURAHAN]', '[KELURAHAN]', 200, 50, -1, false, '[KELURAHAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELURAHAN->Sortable = true; // Allow sort
        $this->KELURAHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELURAHAN->Param, "CustomMsg");
        $this->Fields['KELURAHAN'] = &$this->KELURAHAN;

        // KOTA
        $this->KOTA = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_KOTA', 'KOTA', '[KOTA]', '[KOTA]', 200, 50, -1, false, '[KOTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KOTA->Sortable = true; // Allow sort
        $this->KOTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KOTA->Param, "CustomMsg");
        $this->Fields['KOTA'] = &$this->KOTA;

        // SERVERNAME
        $this->SERVERNAME = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_SERVERNAME', 'SERVERNAME', '[SERVERNAME]', '[SERVERNAME]', 200, 50, -1, false, '[SERVERNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SERVERNAME->Sortable = true; // Allow sort
        $this->SERVERNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SERVERNAME->Param, "CustomMsg");
        $this->Fields['SERVERNAME'] = &$this->SERVERNAME;

        // DBNAMES
        $this->DBNAMES = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DBNAMES', 'DBNAMES', '[DBNAMES]', '[DBNAMES]', 200, 50, -1, false, '[DBNAMES]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DBNAMES->Sortable = true; // Allow sort
        $this->DBNAMES->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DBNAMES->Param, "CustomMsg");
        $this->Fields['DBNAMES'] = &$this->DBNAMES;

        // DBPARENT
        $this->DBPARENT = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DBPARENT', 'DBPARENT', '[DBPARENT]', '[DBPARENT]', 200, 50, -1, false, '[DBPARENT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DBPARENT->Sortable = true; // Allow sort
        $this->DBPARENT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DBPARENT->Param, "CustomMsg");
        $this->Fields['DBPARENT'] = &$this->DBPARENT;

        // CONSID
        $this->CONSID = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_CONSID', 'CONSID', '[CONSID]', '[CONSID]', 200, 10, -1, false, '[CONSID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONSID->Sortable = true; // Allow sort
        $this->CONSID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONSID->Param, "CustomMsg");
        $this->Fields['CONSID'] = &$this->CONSID;

        // CONSECRET
        $this->CONSECRET = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_CONSECRET', 'CONSECRET', '[CONSECRET]', '[CONSECRET]', 200, 15, -1, false, '[CONSECRET]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONSECRET->Sortable = true; // Allow sort
        $this->CONSECRET->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONSECRET->Param, "CustomMsg");
        $this->Fields['CONSECRET'] = &$this->CONSECRET;

        // PCAREUN
        $this->PCAREUN = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PCAREUN', 'PCAREUN', '[PCAREUN]', '[PCAREUN]', 200, 10, -1, false, '[PCAREUN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PCAREUN->Sortable = true; // Allow sort
        $this->PCAREUN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PCAREUN->Param, "CustomMsg");
        $this->Fields['PCAREUN'] = &$this->PCAREUN;

        // PCAREPSW
        $this->PCAREPSW = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PCAREPSW', 'PCAREPSW', '[PCAREPSW]', '[PCAREPSW]', 200, 10, -1, false, '[PCAREPSW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PCAREPSW->Sortable = true; // Allow sort
        $this->PCAREPSW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PCAREPSW->Param, "CustomMsg");
        $this->Fields['PCAREPSW'] = &$this->PCAREPSW;

        // KDAPLIKASI
        $this->KDAPLIKASI = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_KDAPLIKASI', 'KDAPLIKASI', '[KDAPLIKASI]', '[KDAPLIKASI]', 129, 3, -1, false, '[KDAPLIKASI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDAPLIKASI->Sortable = true; // Allow sort
        $this->KDAPLIKASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDAPLIKASI->Param, "CustomMsg");
        $this->Fields['KDAPLIKASI'] = &$this->KDAPLIKASI;

        // PCAREDIR
        $this->PCAREDIR = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PCAREDIR', 'PCAREDIR', '[PCAREDIR]', '[PCAREDIR]', 200, 200, -1, false, '[PCAREDIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PCAREDIR->Sortable = true; // Allow sort
        $this->PCAREDIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PCAREDIR->Param, "CustomMsg");
        $this->Fields['PCAREDIR'] = &$this->PCAREDIR;

        // PCAREBASEURL0
        $this->PCAREBASEURL0 = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PCAREBASEURL0', 'PCAREBASEURL0', '[PCAREBASEURL0]', '[PCAREBASEURL0]', 200, 200, -1, false, '[PCAREBASEURL0]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PCAREBASEURL0->Sortable = true; // Allow sort
        $this->PCAREBASEURL0->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PCAREBASEURL0->Param, "CustomMsg");
        $this->Fields['PCAREBASEURL0'] = &$this->PCAREBASEURL0;

        // PCAREBASEURL1
        $this->PCAREBASEURL1 = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PCAREBASEURL1', 'PCAREBASEURL1', '[PCAREBASEURL1]', '[PCAREBASEURL1]', 200, 200, -1, false, '[PCAREBASEURL1]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PCAREBASEURL1->Sortable = true; // Allow sort
        $this->PCAREBASEURL1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PCAREBASEURL1->Param, "CustomMsg");
        $this->Fields['PCAREBASEURL1'] = &$this->PCAREBASEURL1;

        // PCAREBASEURL2
        $this->PCAREBASEURL2 = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PCAREBASEURL2', 'PCAREBASEURL2', '[PCAREBASEURL2]', '[PCAREBASEURL2]', 200, 200, -1, false, '[PCAREBASEURL2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PCAREBASEURL2->Sortable = true; // Allow sort
        $this->PCAREBASEURL2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PCAREBASEURL2->Param, "CustomMsg");
        $this->Fields['PCAREBASEURL2'] = &$this->PCAREBASEURL2;

        // DBUN
        $this->DBUN = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DBUN', 'DBUN', '[DBUN]', '[DBUN]', 200, 10, -1, false, '[DBUN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DBUN->Sortable = true; // Allow sort
        $this->DBUN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DBUN->Param, "CustomMsg");
        $this->Fields['DBUN'] = &$this->DBUN;

        // DBPSW
        $this->DBPSW = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_DBPSW', 'DBPSW', '[DBPSW]', '[DBPSW]', 200, 10, -1, false, '[DBPSW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DBPSW->Sortable = true; // Allow sort
        $this->DBPSW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DBPSW->Param, "CustomMsg");
        $this->Fields['DBPSW'] = &$this->DBPSW;

        // PICTUREFILE
        $this->PICTUREFILE = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PICTUREFILE', 'PICTUREFILE', '[PICTUREFILE]', '[PICTUREFILE]', 204, 50, -1, true, '[PICTUREFILE]', false, false, false, 'FORMATTED TEXT', 'FILE');
        $this->PICTUREFILE->Sortable = true; // Allow sort
        $this->PICTUREFILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PICTUREFILE->Param, "CustomMsg");
        $this->Fields['PICTUREFILE'] = &$this->PICTUREFILE;

        // PROVINSI
        $this->PROVINSI = new DbField('ORGANIZATIONUNIT', 'ORGANIZATIONUNIT', 'x_PROVINSI', 'PROVINSI', '[PROVINSI]', '[PROVINSI]', 200, 50, -1, false, '[PROVINSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROVINSI->Sortable = true; // Allow sort
        $this->PROVINSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROVINSI->Param, "CustomMsg");
        $this->Fields['PROVINSI'] = &$this->PROVINSI;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[ORGANIZATIONUNIT]";
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
        $this->OBJECT_CATEGORY_ID->DbValue = $row['OBJECT_CATEGORY_ID'];
        $this->ORG_UNIT_CODE->DbValue = $row['ORG_UNIT_CODE'];
        $this->ORG_TYPE->DbValue = $row['ORG_TYPE'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->HIRARKI_ID->DbValue = $row['HIRARKI_ID'];
        $this->NAME_OF_ORG_UNIT->DbValue = $row['NAME_OF_ORG_UNIT'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->CONTACT_ADDRESS->DbValue = $row['CONTACT_ADDRESS'];
        $this->KEC_ID->DbValue = $row['KEC_ID'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->KODE_KOTA->DbValue = $row['KODE_KOTA'];
        $this->SK->DbValue = $row['SK'];
        $this->PENETAP_ID->DbValue = $row['PENETAP_ID'];
        $this->BY_ID->DbValue = $row['BY_ID'];
        $this->ACCREDITATION->DbValue = $row['ACCREDITATION'];
        $this->ACCREDIT_STATUS->DbValue = $row['ACCREDIT_STATUS'];
        $this->SK_STATUS->DbValue = $row['SK_STATUS'];
        $this->WEBSITE->DbValue = $row['WEBSITE'];
        $this->_EMAIL->DbValue = $row['EMAIL'];
        $this->WIN_MENU->DbValue = $row['WIN_MENU'];
        $this->LOGOFILE->DbValue = $row['LOGOFILE'];
        $this->IP_ADDRESS->DbValue = $row['IP_ADDRESS'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->DENAH_FILE->DbValue = $row['DENAH_FILE'];
        $this->BIDANG_ID->DbValue = $row['BIDANG_ID'];
        $this->MAIN_PARENT->DbValue = $row['MAIN_PARENT'];
        $this->DIRECT_PARENT->DbValue = $row['DIRECT_PARENT'];
        $this->WHOLE_PARENT->DbValue = $row['WHOLE_PARENT'];
        $this->HEADER->DbValue = $row['HEADER'];
        $this->PHONE->DbValue = $row['PHONE'];
        $this->FAX->DbValue = $row['FAX'];
        $this->POSTAL_CODE->DbValue = $row['POSTAL_CODE'];
        $this->DISPLAY->DbValue = $row['DISPLAY'];
        $this->OTHER_CODE->DbValue = $row['OTHER_CODE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->ISSTATE->DbValue = $row['ISSTATE'];
        $this->REGISTRATION_DATE->DbValue = $row['REGISTRATION_DATE'];
        $this->LUAS_TANAH->DbValue = $row['LUAS_TANAH'];
        $this->LUAS_BANGUNAN->DbValue = $row['LUAS_BANGUNAN'];
        $this->SK_MASA->DbValue = $row['SK_MASA'];
        $this->ACCREDITATION_DATE->DbValue = $row['ACCREDITATION_DATE'];
        $this->TT_VVIP->DbValue = $row['TT_VVIP'];
        $this->TT_VIP->DbValue = $row['TT_VIP'];
        $this->TT_1->DbValue = $row['TT_1'];
        $this->TT_2->DbValue = $row['TT_2'];
        $this->TT_3->DbValue = $row['TT_3'];
        $this->DR_SPA->DbValue = $row['DR_SPA'];
        $this->DR_SPOG->DbValue = $row['DR_SPOG'];
        $this->dr_sppd->DbValue = $row['dr_sppd'];
        $this->dr_spb->DbValue = $row['dr_spb'];
        $this->dr_sprad->DbValue = $row['dr_sprad'];
        $this->dr_sprm->DbValue = $row['dr_sprm'];
        $this->dr_span->DbValue = $row['dr_span'];
        $this->dr_spjp->DbValue = $row['dr_spjp'];
        $this->dr_spm->DbValue = $row['dr_spm'];
        $this->dr_sptht->DbValue = $row['dr_sptht'];
        $this->dr_spkj->DbValue = $row['dr_spkj'];
        $this->dr_um->DbValue = $row['dr_um'];
        $this->drg->DbValue = $row['drg'];
        $this->drg_sp->DbValue = $row['drg_sp'];
        $this->prwt->DbValue = $row['prwt'];
        $this->bdn->DbValue = $row['bdn'];
        $this->far->DbValue = $row['far'];
        $this->tkes->DbValue = $row['tkes'];
        $this->tNONkes->DbValue = $row['tNONkes'];
        $this->sk_date->DbValue = $row['sk_date'];
        $this->KECAMATAN->DbValue = $row['KECAMATAN'];
        $this->KELURAHAN->DbValue = $row['KELURAHAN'];
        $this->KOTA->DbValue = $row['KOTA'];
        $this->SERVERNAME->DbValue = $row['SERVERNAME'];
        $this->DBNAMES->DbValue = $row['DBNAMES'];
        $this->DBPARENT->DbValue = $row['DBPARENT'];
        $this->CONSID->DbValue = $row['CONSID'];
        $this->CONSECRET->DbValue = $row['CONSECRET'];
        $this->PCAREUN->DbValue = $row['PCAREUN'];
        $this->PCAREPSW->DbValue = $row['PCAREPSW'];
        $this->KDAPLIKASI->DbValue = $row['KDAPLIKASI'];
        $this->PCAREDIR->DbValue = $row['PCAREDIR'];
        $this->PCAREBASEURL0->DbValue = $row['PCAREBASEURL0'];
        $this->PCAREBASEURL1->DbValue = $row['PCAREBASEURL1'];
        $this->PCAREBASEURL2->DbValue = $row['PCAREBASEURL2'];
        $this->DBUN->DbValue = $row['DBUN'];
        $this->DBPSW->DbValue = $row['DBPSW'];
        $this->PICTUREFILE->Upload->DbValue = $row['PICTUREFILE'];
        $this->PROVINSI->DbValue = $row['PROVINSI'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@'";
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
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
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
        return $_SESSION[$name] ?? GetUrl("OrganizationunitList");
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
        if ($pageName == "OrganizationunitView") {
            return $Language->phrase("View");
        } elseif ($pageName == "OrganizationunitEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "OrganizationunitAdd") {
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
                return "OrganizationunitView";
            case Config("API_ADD_ACTION"):
                return "OrganizationunitAdd";
            case Config("API_EDIT_ACTION"):
                return "OrganizationunitEdit";
            case Config("API_DELETE_ACTION"):
                return "OrganizationunitDelete";
            case Config("API_LIST_ACTION"):
                return "OrganizationunitList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "OrganizationunitList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("OrganizationunitView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("OrganizationunitView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "OrganizationunitAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "OrganizationunitAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("OrganizationunitEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("OrganizationunitAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("OrganizationunitDelete", $this->getUrlParm());
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
            if (($keyValue = Param("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
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
                $this->ORG_UNIT_CODE->CurrentValue = $key;
            } else {
                $this->ORG_UNIT_CODE->OldValue = $key;
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
        $this->OBJECT_CATEGORY_ID->setDbValue($row['OBJECT_CATEGORY_ID']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->ORG_TYPE->setDbValue($row['ORG_TYPE']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->HIRARKI_ID->setDbValue($row['HIRARKI_ID']);
        $this->NAME_OF_ORG_UNIT->setDbValue($row['NAME_OF_ORG_UNIT']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->CONTACT_ADDRESS->setDbValue($row['CONTACT_ADDRESS']);
        $this->KEC_ID->setDbValue($row['KEC_ID']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->KODE_KOTA->setDbValue($row['KODE_KOTA']);
        $this->SK->setDbValue($row['SK']);
        $this->PENETAP_ID->setDbValue($row['PENETAP_ID']);
        $this->BY_ID->setDbValue($row['BY_ID']);
        $this->ACCREDITATION->setDbValue($row['ACCREDITATION']);
        $this->ACCREDIT_STATUS->setDbValue($row['ACCREDIT_STATUS']);
        $this->SK_STATUS->setDbValue($row['SK_STATUS']);
        $this->WEBSITE->setDbValue($row['WEBSITE']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->WIN_MENU->setDbValue($row['WIN_MENU']);
        $this->LOGOFILE->setDbValue($row['LOGOFILE']);
        $this->IP_ADDRESS->setDbValue($row['IP_ADDRESS']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->DENAH_FILE->setDbValue($row['DENAH_FILE']);
        $this->BIDANG_ID->setDbValue($row['BIDANG_ID']);
        $this->MAIN_PARENT->setDbValue($row['MAIN_PARENT']);
        $this->DIRECT_PARENT->setDbValue($row['DIRECT_PARENT']);
        $this->WHOLE_PARENT->setDbValue($row['WHOLE_PARENT']);
        $this->HEADER->setDbValue($row['HEADER']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->FAX->setDbValue($row['FAX']);
        $this->POSTAL_CODE->setDbValue($row['POSTAL_CODE']);
        $this->DISPLAY->setDbValue($row['DISPLAY']);
        $this->OTHER_CODE->setDbValue($row['OTHER_CODE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->ISSTATE->setDbValue($row['ISSTATE']);
        $this->REGISTRATION_DATE->setDbValue($row['REGISTRATION_DATE']);
        $this->LUAS_TANAH->setDbValue($row['LUAS_TANAH']);
        $this->LUAS_BANGUNAN->setDbValue($row['LUAS_BANGUNAN']);
        $this->SK_MASA->setDbValue($row['SK_MASA']);
        $this->ACCREDITATION_DATE->setDbValue($row['ACCREDITATION_DATE']);
        $this->TT_VVIP->setDbValue($row['TT_VVIP']);
        $this->TT_VIP->setDbValue($row['TT_VIP']);
        $this->TT_1->setDbValue($row['TT_1']);
        $this->TT_2->setDbValue($row['TT_2']);
        $this->TT_3->setDbValue($row['TT_3']);
        $this->DR_SPA->setDbValue($row['DR_SPA']);
        $this->DR_SPOG->setDbValue($row['DR_SPOG']);
        $this->dr_sppd->setDbValue($row['dr_sppd']);
        $this->dr_spb->setDbValue($row['dr_spb']);
        $this->dr_sprad->setDbValue($row['dr_sprad']);
        $this->dr_sprm->setDbValue($row['dr_sprm']);
        $this->dr_span->setDbValue($row['dr_span']);
        $this->dr_spjp->setDbValue($row['dr_spjp']);
        $this->dr_spm->setDbValue($row['dr_spm']);
        $this->dr_sptht->setDbValue($row['dr_sptht']);
        $this->dr_spkj->setDbValue($row['dr_spkj']);
        $this->dr_um->setDbValue($row['dr_um']);
        $this->drg->setDbValue($row['drg']);
        $this->drg_sp->setDbValue($row['drg_sp']);
        $this->prwt->setDbValue($row['prwt']);
        $this->bdn->setDbValue($row['bdn']);
        $this->far->setDbValue($row['far']);
        $this->tkes->setDbValue($row['tkes']);
        $this->tNONkes->setDbValue($row['tNONkes']);
        $this->sk_date->setDbValue($row['sk_date']);
        $this->KECAMATAN->setDbValue($row['KECAMATAN']);
        $this->KELURAHAN->setDbValue($row['KELURAHAN']);
        $this->KOTA->setDbValue($row['KOTA']);
        $this->SERVERNAME->setDbValue($row['SERVERNAME']);
        $this->DBNAMES->setDbValue($row['DBNAMES']);
        $this->DBPARENT->setDbValue($row['DBPARENT']);
        $this->CONSID->setDbValue($row['CONSID']);
        $this->CONSECRET->setDbValue($row['CONSECRET']);
        $this->PCAREUN->setDbValue($row['PCAREUN']);
        $this->PCAREPSW->setDbValue($row['PCAREPSW']);
        $this->KDAPLIKASI->setDbValue($row['KDAPLIKASI']);
        $this->PCAREDIR->setDbValue($row['PCAREDIR']);
        $this->PCAREBASEURL0->setDbValue($row['PCAREBASEURL0']);
        $this->PCAREBASEURL1->setDbValue($row['PCAREBASEURL1']);
        $this->PCAREBASEURL2->setDbValue($row['PCAREBASEURL2']);
        $this->DBUN->setDbValue($row['DBUN']);
        $this->DBPSW->setDbValue($row['DBPSW']);
        $this->PICTUREFILE->Upload->DbValue = $row['PICTUREFILE'];
        if (is_resource($this->PICTUREFILE->Upload->DbValue) && get_resource_type($this->PICTUREFILE->Upload->DbValue) == "stream") { // Byte array
            $this->PICTUREFILE->Upload->DbValue = stream_get_contents($this->PICTUREFILE->Upload->DbValue);
        }
        $this->PROVINSI->setDbValue($row['PROVINSI']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // OBJECT_CATEGORY_ID

        // ORG_UNIT_CODE

        // ORG_TYPE

        // CLASS_ID

        // HIRARKI_ID

        // NAME_OF_ORG_UNIT

        // EMPLOYEE_ID

        // CONTACT_ADDRESS

        // KEC_ID

        // KAL_ID

        // KODE_KOTA

        // SK

        // PENETAP_ID

        // BY_ID

        // ACCREDITATION

        // ACCREDIT_STATUS

        // SK_STATUS

        // WEBSITE

        // EMAIL

        // WIN_MENU

        // LOGOFILE

        // IP_ADDRESS

        // DESCRIPTION

        // DENAH_FILE

        // BIDANG_ID

        // MAIN_PARENT

        // DIRECT_PARENT

        // WHOLE_PARENT

        // HEADER

        // PHONE

        // FAX

        // POSTAL_CODE

        // DISPLAY

        // OTHER_CODE

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // ISSTATE

        // REGISTRATION_DATE

        // LUAS_TANAH

        // LUAS_BANGUNAN

        // SK_MASA

        // ACCREDITATION_DATE

        // TT_VVIP

        // TT_VIP

        // TT_1

        // TT_2

        // TT_3

        // DR_SPA

        // DR_SPOG

        // dr_sppd

        // dr_spb

        // dr_sprad

        // dr_sprm

        // dr_span

        // dr_spjp

        // dr_spm

        // dr_sptht

        // dr_spkj

        // dr_um

        // drg

        // drg_sp

        // prwt

        // bdn

        // far

        // tkes

        // tNONkes

        // sk_date

        // KECAMATAN

        // KELURAHAN

        // KOTA

        // SERVERNAME

        // DBNAMES

        // DBPARENT

        // CONSID

        // CONSECRET

        // PCAREUN

        // PCAREPSW

        // KDAPLIKASI

        // PCAREDIR

        // PCAREBASEURL0

        // PCAREBASEURL1

        // PCAREBASEURL2

        // DBUN

        // DBPSW

        // PICTUREFILE

        // PROVINSI

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->ViewValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->ViewValue = FormatNumber($this->OBJECT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
        $this->OBJECT_CATEGORY_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // ORG_TYPE
        $this->ORG_TYPE->ViewValue = $this->ORG_TYPE->CurrentValue;
        $this->ORG_TYPE->ViewCustomAttributes = "";

        // CLASS_ID
        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID->ViewCustomAttributes = "";

        // HIRARKI_ID
        $this->HIRARKI_ID->ViewValue = $this->HIRARKI_ID->CurrentValue;
        $this->HIRARKI_ID->ViewValue = FormatNumber($this->HIRARKI_ID->ViewValue, 0, -2, -2, -2);
        $this->HIRARKI_ID->ViewCustomAttributes = "";

        // NAME_OF_ORG_UNIT
        $this->NAME_OF_ORG_UNIT->ViewValue = $this->NAME_OF_ORG_UNIT->CurrentValue;
        $this->NAME_OF_ORG_UNIT->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->ViewValue = $this->CONTACT_ADDRESS->CurrentValue;
        $this->CONTACT_ADDRESS->ViewCustomAttributes = "";

        // KEC_ID
        $this->KEC_ID->ViewValue = $this->KEC_ID->CurrentValue;
        $this->KEC_ID->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // KODE_KOTA
        $this->KODE_KOTA->ViewValue = $this->KODE_KOTA->CurrentValue;
        $this->KODE_KOTA->ViewCustomAttributes = "";

        // SK
        $this->SK->ViewValue = $this->SK->CurrentValue;
        $this->SK->ViewCustomAttributes = "";

        // PENETAP_ID
        $this->PENETAP_ID->ViewValue = $this->PENETAP_ID->CurrentValue;
        $this->PENETAP_ID->ViewValue = FormatNumber($this->PENETAP_ID->ViewValue, 0, -2, -2, -2);
        $this->PENETAP_ID->ViewCustomAttributes = "";

        // BY_ID
        $this->BY_ID->ViewValue = $this->BY_ID->CurrentValue;
        $this->BY_ID->ViewValue = FormatNumber($this->BY_ID->ViewValue, 0, -2, -2, -2);
        $this->BY_ID->ViewCustomAttributes = "";

        // ACCREDITATION
        $this->ACCREDITATION->ViewValue = $this->ACCREDITATION->CurrentValue;
        $this->ACCREDITATION->ViewValue = FormatNumber($this->ACCREDITATION->ViewValue, 0, -2, -2, -2);
        $this->ACCREDITATION->ViewCustomAttributes = "";

        // ACCREDIT_STATUS
        $this->ACCREDIT_STATUS->ViewValue = $this->ACCREDIT_STATUS->CurrentValue;
        $this->ACCREDIT_STATUS->ViewValue = FormatNumber($this->ACCREDIT_STATUS->ViewValue, 0, -2, -2, -2);
        $this->ACCREDIT_STATUS->ViewCustomAttributes = "";

        // SK_STATUS
        $this->SK_STATUS->ViewValue = $this->SK_STATUS->CurrentValue;
        $this->SK_STATUS->ViewValue = FormatNumber($this->SK_STATUS->ViewValue, 0, -2, -2, -2);
        $this->SK_STATUS->ViewCustomAttributes = "";

        // WEBSITE
        $this->WEBSITE->ViewValue = $this->WEBSITE->CurrentValue;
        $this->WEBSITE->ViewCustomAttributes = "";

        // EMAIL
        $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->ViewCustomAttributes = "";

        // WIN_MENU
        $this->WIN_MENU->ViewValue = $this->WIN_MENU->CurrentValue;
        $this->WIN_MENU->ViewCustomAttributes = "";

        // LOGOFILE
        $this->LOGOFILE->ViewValue = $this->LOGOFILE->CurrentValue;
        $this->LOGOFILE->ViewCustomAttributes = "";

        // IP_ADDRESS
        $this->IP_ADDRESS->ViewValue = $this->IP_ADDRESS->CurrentValue;
        $this->IP_ADDRESS->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // DENAH_FILE
        $this->DENAH_FILE->ViewValue = $this->DENAH_FILE->CurrentValue;
        $this->DENAH_FILE->ViewCustomAttributes = "";

        // BIDANG_ID
        $this->BIDANG_ID->ViewValue = $this->BIDANG_ID->CurrentValue;
        $this->BIDANG_ID->ViewValue = FormatNumber($this->BIDANG_ID->ViewValue, 0, -2, -2, -2);
        $this->BIDANG_ID->ViewCustomAttributes = "";

        // MAIN_PARENT
        $this->MAIN_PARENT->ViewValue = $this->MAIN_PARENT->CurrentValue;
        $this->MAIN_PARENT->ViewCustomAttributes = "";

        // DIRECT_PARENT
        $this->DIRECT_PARENT->ViewValue = $this->DIRECT_PARENT->CurrentValue;
        $this->DIRECT_PARENT->ViewCustomAttributes = "";

        // WHOLE_PARENT
        $this->WHOLE_PARENT->ViewValue = $this->WHOLE_PARENT->CurrentValue;
        $this->WHOLE_PARENT->ViewCustomAttributes = "";

        // HEADER
        $this->HEADER->ViewValue = $this->HEADER->CurrentValue;
        $this->HEADER->ViewCustomAttributes = "";

        // PHONE
        $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
        $this->PHONE->ViewCustomAttributes = "";

        // FAX
        $this->FAX->ViewValue = $this->FAX->CurrentValue;
        $this->FAX->ViewCustomAttributes = "";

        // POSTAL_CODE
        $this->POSTAL_CODE->ViewValue = $this->POSTAL_CODE->CurrentValue;
        $this->POSTAL_CODE->ViewCustomAttributes = "";

        // DISPLAY
        $this->DISPLAY->ViewValue = $this->DISPLAY->CurrentValue;
        $this->DISPLAY->ViewCustomAttributes = "";

        // OTHER_CODE
        $this->OTHER_CODE->ViewValue = $this->OTHER_CODE->CurrentValue;
        $this->OTHER_CODE->ViewCustomAttributes = "";

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

        // ISSTATE
        $this->ISSTATE->ViewValue = $this->ISSTATE->CurrentValue;
        $this->ISSTATE->ViewCustomAttributes = "";

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE->ViewValue = $this->REGISTRATION_DATE->CurrentValue;
        $this->REGISTRATION_DATE->ViewValue = FormatDateTime($this->REGISTRATION_DATE->ViewValue, 0);
        $this->REGISTRATION_DATE->ViewCustomAttributes = "";

        // LUAS_TANAH
        $this->LUAS_TANAH->ViewValue = $this->LUAS_TANAH->CurrentValue;
        $this->LUAS_TANAH->ViewValue = FormatNumber($this->LUAS_TANAH->ViewValue, 2, -2, -2, -2);
        $this->LUAS_TANAH->ViewCustomAttributes = "";

        // LUAS_BANGUNAN
        $this->LUAS_BANGUNAN->ViewValue = $this->LUAS_BANGUNAN->CurrentValue;
        $this->LUAS_BANGUNAN->ViewValue = FormatNumber($this->LUAS_BANGUNAN->ViewValue, 2, -2, -2, -2);
        $this->LUAS_BANGUNAN->ViewCustomAttributes = "";

        // SK_MASA
        $this->SK_MASA->ViewValue = $this->SK_MASA->CurrentValue;
        $this->SK_MASA->ViewValue = FormatDateTime($this->SK_MASA->ViewValue, 0);
        $this->SK_MASA->ViewCustomAttributes = "";

        // ACCREDITATION_DATE
        $this->ACCREDITATION_DATE->ViewValue = $this->ACCREDITATION_DATE->CurrentValue;
        $this->ACCREDITATION_DATE->ViewValue = FormatDateTime($this->ACCREDITATION_DATE->ViewValue, 0);
        $this->ACCREDITATION_DATE->ViewCustomAttributes = "";

        // TT_VVIP
        $this->TT_VVIP->ViewValue = $this->TT_VVIP->CurrentValue;
        $this->TT_VVIP->ViewValue = FormatNumber($this->TT_VVIP->ViewValue, 0, -2, -2, -2);
        $this->TT_VVIP->ViewCustomAttributes = "";

        // TT_VIP
        $this->TT_VIP->ViewValue = $this->TT_VIP->CurrentValue;
        $this->TT_VIP->ViewValue = FormatNumber($this->TT_VIP->ViewValue, 0, -2, -2, -2);
        $this->TT_VIP->ViewCustomAttributes = "";

        // TT_1
        $this->TT_1->ViewValue = $this->TT_1->CurrentValue;
        $this->TT_1->ViewValue = FormatNumber($this->TT_1->ViewValue, 0, -2, -2, -2);
        $this->TT_1->ViewCustomAttributes = "";

        // TT_2
        $this->TT_2->ViewValue = $this->TT_2->CurrentValue;
        $this->TT_2->ViewValue = FormatNumber($this->TT_2->ViewValue, 0, -2, -2, -2);
        $this->TT_2->ViewCustomAttributes = "";

        // TT_3
        $this->TT_3->ViewValue = $this->TT_3->CurrentValue;
        $this->TT_3->ViewValue = FormatNumber($this->TT_3->ViewValue, 0, -2, -2, -2);
        $this->TT_3->ViewCustomAttributes = "";

        // DR_SPA
        $this->DR_SPA->ViewValue = $this->DR_SPA->CurrentValue;
        $this->DR_SPA->ViewValue = FormatNumber($this->DR_SPA->ViewValue, 0, -2, -2, -2);
        $this->DR_SPA->ViewCustomAttributes = "";

        // DR_SPOG
        $this->DR_SPOG->ViewValue = $this->DR_SPOG->CurrentValue;
        $this->DR_SPOG->ViewValue = FormatNumber($this->DR_SPOG->ViewValue, 0, -2, -2, -2);
        $this->DR_SPOG->ViewCustomAttributes = "";

        // dr_sppd
        $this->dr_sppd->ViewValue = $this->dr_sppd->CurrentValue;
        $this->dr_sppd->ViewValue = FormatNumber($this->dr_sppd->ViewValue, 0, -2, -2, -2);
        $this->dr_sppd->ViewCustomAttributes = "";

        // dr_spb
        $this->dr_spb->ViewValue = $this->dr_spb->CurrentValue;
        $this->dr_spb->ViewValue = FormatNumber($this->dr_spb->ViewValue, 0, -2, -2, -2);
        $this->dr_spb->ViewCustomAttributes = "";

        // dr_sprad
        $this->dr_sprad->ViewValue = $this->dr_sprad->CurrentValue;
        $this->dr_sprad->ViewValue = FormatNumber($this->dr_sprad->ViewValue, 0, -2, -2, -2);
        $this->dr_sprad->ViewCustomAttributes = "";

        // dr_sprm
        $this->dr_sprm->ViewValue = $this->dr_sprm->CurrentValue;
        $this->dr_sprm->ViewValue = FormatNumber($this->dr_sprm->ViewValue, 0, -2, -2, -2);
        $this->dr_sprm->ViewCustomAttributes = "";

        // dr_span
        $this->dr_span->ViewValue = $this->dr_span->CurrentValue;
        $this->dr_span->ViewValue = FormatNumber($this->dr_span->ViewValue, 0, -2, -2, -2);
        $this->dr_span->ViewCustomAttributes = "";

        // dr_spjp
        $this->dr_spjp->ViewValue = $this->dr_spjp->CurrentValue;
        $this->dr_spjp->ViewValue = FormatNumber($this->dr_spjp->ViewValue, 0, -2, -2, -2);
        $this->dr_spjp->ViewCustomAttributes = "";

        // dr_spm
        $this->dr_spm->ViewValue = $this->dr_spm->CurrentValue;
        $this->dr_spm->ViewValue = FormatNumber($this->dr_spm->ViewValue, 0, -2, -2, -2);
        $this->dr_spm->ViewCustomAttributes = "";

        // dr_sptht
        $this->dr_sptht->ViewValue = $this->dr_sptht->CurrentValue;
        $this->dr_sptht->ViewValue = FormatNumber($this->dr_sptht->ViewValue, 0, -2, -2, -2);
        $this->dr_sptht->ViewCustomAttributes = "";

        // dr_spkj
        $this->dr_spkj->ViewValue = $this->dr_spkj->CurrentValue;
        $this->dr_spkj->ViewValue = FormatNumber($this->dr_spkj->ViewValue, 0, -2, -2, -2);
        $this->dr_spkj->ViewCustomAttributes = "";

        // dr_um
        $this->dr_um->ViewValue = $this->dr_um->CurrentValue;
        $this->dr_um->ViewValue = FormatNumber($this->dr_um->ViewValue, 0, -2, -2, -2);
        $this->dr_um->ViewCustomAttributes = "";

        // drg
        $this->drg->ViewValue = $this->drg->CurrentValue;
        $this->drg->ViewValue = FormatNumber($this->drg->ViewValue, 0, -2, -2, -2);
        $this->drg->ViewCustomAttributes = "";

        // drg_sp
        $this->drg_sp->ViewValue = $this->drg_sp->CurrentValue;
        $this->drg_sp->ViewValue = FormatNumber($this->drg_sp->ViewValue, 0, -2, -2, -2);
        $this->drg_sp->ViewCustomAttributes = "";

        // prwt
        $this->prwt->ViewValue = $this->prwt->CurrentValue;
        $this->prwt->ViewValue = FormatNumber($this->prwt->ViewValue, 0, -2, -2, -2);
        $this->prwt->ViewCustomAttributes = "";

        // bdn
        $this->bdn->ViewValue = $this->bdn->CurrentValue;
        $this->bdn->ViewValue = FormatNumber($this->bdn->ViewValue, 0, -2, -2, -2);
        $this->bdn->ViewCustomAttributes = "";

        // far
        $this->far->ViewValue = $this->far->CurrentValue;
        $this->far->ViewValue = FormatNumber($this->far->ViewValue, 0, -2, -2, -2);
        $this->far->ViewCustomAttributes = "";

        // tkes
        $this->tkes->ViewValue = $this->tkes->CurrentValue;
        $this->tkes->ViewValue = FormatNumber($this->tkes->ViewValue, 0, -2, -2, -2);
        $this->tkes->ViewCustomAttributes = "";

        // tNONkes
        $this->tNONkes->ViewValue = $this->tNONkes->CurrentValue;
        $this->tNONkes->ViewValue = FormatNumber($this->tNONkes->ViewValue, 0, -2, -2, -2);
        $this->tNONkes->ViewCustomAttributes = "";

        // sk_date
        $this->sk_date->ViewValue = $this->sk_date->CurrentValue;
        $this->sk_date->ViewValue = FormatDateTime($this->sk_date->ViewValue, 0);
        $this->sk_date->ViewCustomAttributes = "";

        // KECAMATAN
        $this->KECAMATAN->ViewValue = $this->KECAMATAN->CurrentValue;
        $this->KECAMATAN->ViewCustomAttributes = "";

        // KELURAHAN
        $this->KELURAHAN->ViewValue = $this->KELURAHAN->CurrentValue;
        $this->KELURAHAN->ViewCustomAttributes = "";

        // KOTA
        $this->KOTA->ViewValue = $this->KOTA->CurrentValue;
        $this->KOTA->ViewCustomAttributes = "";

        // SERVERNAME
        $this->SERVERNAME->ViewValue = $this->SERVERNAME->CurrentValue;
        $this->SERVERNAME->ViewCustomAttributes = "";

        // DBNAMES
        $this->DBNAMES->ViewValue = $this->DBNAMES->CurrentValue;
        $this->DBNAMES->ViewCustomAttributes = "";

        // DBPARENT
        $this->DBPARENT->ViewValue = $this->DBPARENT->CurrentValue;
        $this->DBPARENT->ViewCustomAttributes = "";

        // CONSID
        $this->CONSID->ViewValue = $this->CONSID->CurrentValue;
        $this->CONSID->ViewCustomAttributes = "";

        // CONSECRET
        $this->CONSECRET->ViewValue = $this->CONSECRET->CurrentValue;
        $this->CONSECRET->ViewCustomAttributes = "";

        // PCAREUN
        $this->PCAREUN->ViewValue = $this->PCAREUN->CurrentValue;
        $this->PCAREUN->ViewCustomAttributes = "";

        // PCAREPSW
        $this->PCAREPSW->ViewValue = $this->PCAREPSW->CurrentValue;
        $this->PCAREPSW->ViewCustomAttributes = "";

        // KDAPLIKASI
        $this->KDAPLIKASI->ViewValue = $this->KDAPLIKASI->CurrentValue;
        $this->KDAPLIKASI->ViewCustomAttributes = "";

        // PCAREDIR
        $this->PCAREDIR->ViewValue = $this->PCAREDIR->CurrentValue;
        $this->PCAREDIR->ViewCustomAttributes = "";

        // PCAREBASEURL0
        $this->PCAREBASEURL0->ViewValue = $this->PCAREBASEURL0->CurrentValue;
        $this->PCAREBASEURL0->ViewCustomAttributes = "";

        // PCAREBASEURL1
        $this->PCAREBASEURL1->ViewValue = $this->PCAREBASEURL1->CurrentValue;
        $this->PCAREBASEURL1->ViewCustomAttributes = "";

        // PCAREBASEURL2
        $this->PCAREBASEURL2->ViewValue = $this->PCAREBASEURL2->CurrentValue;
        $this->PCAREBASEURL2->ViewCustomAttributes = "";

        // DBUN
        $this->DBUN->ViewValue = $this->DBUN->CurrentValue;
        $this->DBUN->ViewCustomAttributes = "";

        // DBPSW
        $this->DBPSW->ViewValue = $this->DBPSW->CurrentValue;
        $this->DBPSW->ViewCustomAttributes = "";

        // PICTUREFILE
        if (!EmptyValue($this->PICTUREFILE->Upload->DbValue)) {
            $this->PICTUREFILE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->PICTUREFILE->IsBlobImage = IsImageFile(ContentExtension($this->PICTUREFILE->Upload->DbValue));
        } else {
            $this->PICTUREFILE->ViewValue = "";
        }
        $this->PICTUREFILE->ViewCustomAttributes = "";

        // PROVINSI
        $this->PROVINSI->ViewValue = $this->PROVINSI->CurrentValue;
        $this->PROVINSI->ViewCustomAttributes = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->HrefValue = "";
        $this->OBJECT_CATEGORY_ID->TooltipValue = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // ORG_TYPE
        $this->ORG_TYPE->LinkCustomAttributes = "";
        $this->ORG_TYPE->HrefValue = "";
        $this->ORG_TYPE->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // HIRARKI_ID
        $this->HIRARKI_ID->LinkCustomAttributes = "";
        $this->HIRARKI_ID->HrefValue = "";
        $this->HIRARKI_ID->TooltipValue = "";

        // NAME_OF_ORG_UNIT
        $this->NAME_OF_ORG_UNIT->LinkCustomAttributes = "";
        $this->NAME_OF_ORG_UNIT->HrefValue = "";
        $this->NAME_OF_ORG_UNIT->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->LinkCustomAttributes = "";
        $this->CONTACT_ADDRESS->HrefValue = "";
        $this->CONTACT_ADDRESS->TooltipValue = "";

        // KEC_ID
        $this->KEC_ID->LinkCustomAttributes = "";
        $this->KEC_ID->HrefValue = "";
        $this->KEC_ID->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // KODE_KOTA
        $this->KODE_KOTA->LinkCustomAttributes = "";
        $this->KODE_KOTA->HrefValue = "";
        $this->KODE_KOTA->TooltipValue = "";

        // SK
        $this->SK->LinkCustomAttributes = "";
        $this->SK->HrefValue = "";
        $this->SK->TooltipValue = "";

        // PENETAP_ID
        $this->PENETAP_ID->LinkCustomAttributes = "";
        $this->PENETAP_ID->HrefValue = "";
        $this->PENETAP_ID->TooltipValue = "";

        // BY_ID
        $this->BY_ID->LinkCustomAttributes = "";
        $this->BY_ID->HrefValue = "";
        $this->BY_ID->TooltipValue = "";

        // ACCREDITATION
        $this->ACCREDITATION->LinkCustomAttributes = "";
        $this->ACCREDITATION->HrefValue = "";
        $this->ACCREDITATION->TooltipValue = "";

        // ACCREDIT_STATUS
        $this->ACCREDIT_STATUS->LinkCustomAttributes = "";
        $this->ACCREDIT_STATUS->HrefValue = "";
        $this->ACCREDIT_STATUS->TooltipValue = "";

        // SK_STATUS
        $this->SK_STATUS->LinkCustomAttributes = "";
        $this->SK_STATUS->HrefValue = "";
        $this->SK_STATUS->TooltipValue = "";

        // WEBSITE
        $this->WEBSITE->LinkCustomAttributes = "";
        $this->WEBSITE->HrefValue = "";
        $this->WEBSITE->TooltipValue = "";

        // EMAIL
        $this->_EMAIL->LinkCustomAttributes = "";
        $this->_EMAIL->HrefValue = "";
        $this->_EMAIL->TooltipValue = "";

        // WIN_MENU
        $this->WIN_MENU->LinkCustomAttributes = "";
        $this->WIN_MENU->HrefValue = "";
        $this->WIN_MENU->TooltipValue = "";

        // LOGOFILE
        $this->LOGOFILE->LinkCustomAttributes = "";
        $this->LOGOFILE->HrefValue = "";
        $this->LOGOFILE->TooltipValue = "";

        // IP_ADDRESS
        $this->IP_ADDRESS->LinkCustomAttributes = "";
        $this->IP_ADDRESS->HrefValue = "";
        $this->IP_ADDRESS->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // DENAH_FILE
        $this->DENAH_FILE->LinkCustomAttributes = "";
        $this->DENAH_FILE->HrefValue = "";
        $this->DENAH_FILE->TooltipValue = "";

        // BIDANG_ID
        $this->BIDANG_ID->LinkCustomAttributes = "";
        $this->BIDANG_ID->HrefValue = "";
        $this->BIDANG_ID->TooltipValue = "";

        // MAIN_PARENT
        $this->MAIN_PARENT->LinkCustomAttributes = "";
        $this->MAIN_PARENT->HrefValue = "";
        $this->MAIN_PARENT->TooltipValue = "";

        // DIRECT_PARENT
        $this->DIRECT_PARENT->LinkCustomAttributes = "";
        $this->DIRECT_PARENT->HrefValue = "";
        $this->DIRECT_PARENT->TooltipValue = "";

        // WHOLE_PARENT
        $this->WHOLE_PARENT->LinkCustomAttributes = "";
        $this->WHOLE_PARENT->HrefValue = "";
        $this->WHOLE_PARENT->TooltipValue = "";

        // HEADER
        $this->HEADER->LinkCustomAttributes = "";
        $this->HEADER->HrefValue = "";
        $this->HEADER->TooltipValue = "";

        // PHONE
        $this->PHONE->LinkCustomAttributes = "";
        $this->PHONE->HrefValue = "";
        $this->PHONE->TooltipValue = "";

        // FAX
        $this->FAX->LinkCustomAttributes = "";
        $this->FAX->HrefValue = "";
        $this->FAX->TooltipValue = "";

        // POSTAL_CODE
        $this->POSTAL_CODE->LinkCustomAttributes = "";
        $this->POSTAL_CODE->HrefValue = "";
        $this->POSTAL_CODE->TooltipValue = "";

        // DISPLAY
        $this->DISPLAY->LinkCustomAttributes = "";
        $this->DISPLAY->HrefValue = "";
        $this->DISPLAY->TooltipValue = "";

        // OTHER_CODE
        $this->OTHER_CODE->LinkCustomAttributes = "";
        $this->OTHER_CODE->HrefValue = "";
        $this->OTHER_CODE->TooltipValue = "";

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

        // ISSTATE
        $this->ISSTATE->LinkCustomAttributes = "";
        $this->ISSTATE->HrefValue = "";
        $this->ISSTATE->TooltipValue = "";

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE->LinkCustomAttributes = "";
        $this->REGISTRATION_DATE->HrefValue = "";
        $this->REGISTRATION_DATE->TooltipValue = "";

        // LUAS_TANAH
        $this->LUAS_TANAH->LinkCustomAttributes = "";
        $this->LUAS_TANAH->HrefValue = "";
        $this->LUAS_TANAH->TooltipValue = "";

        // LUAS_BANGUNAN
        $this->LUAS_BANGUNAN->LinkCustomAttributes = "";
        $this->LUAS_BANGUNAN->HrefValue = "";
        $this->LUAS_BANGUNAN->TooltipValue = "";

        // SK_MASA
        $this->SK_MASA->LinkCustomAttributes = "";
        $this->SK_MASA->HrefValue = "";
        $this->SK_MASA->TooltipValue = "";

        // ACCREDITATION_DATE
        $this->ACCREDITATION_DATE->LinkCustomAttributes = "";
        $this->ACCREDITATION_DATE->HrefValue = "";
        $this->ACCREDITATION_DATE->TooltipValue = "";

        // TT_VVIP
        $this->TT_VVIP->LinkCustomAttributes = "";
        $this->TT_VVIP->HrefValue = "";
        $this->TT_VVIP->TooltipValue = "";

        // TT_VIP
        $this->TT_VIP->LinkCustomAttributes = "";
        $this->TT_VIP->HrefValue = "";
        $this->TT_VIP->TooltipValue = "";

        // TT_1
        $this->TT_1->LinkCustomAttributes = "";
        $this->TT_1->HrefValue = "";
        $this->TT_1->TooltipValue = "";

        // TT_2
        $this->TT_2->LinkCustomAttributes = "";
        $this->TT_2->HrefValue = "";
        $this->TT_2->TooltipValue = "";

        // TT_3
        $this->TT_3->LinkCustomAttributes = "";
        $this->TT_3->HrefValue = "";
        $this->TT_3->TooltipValue = "";

        // DR_SPA
        $this->DR_SPA->LinkCustomAttributes = "";
        $this->DR_SPA->HrefValue = "";
        $this->DR_SPA->TooltipValue = "";

        // DR_SPOG
        $this->DR_SPOG->LinkCustomAttributes = "";
        $this->DR_SPOG->HrefValue = "";
        $this->DR_SPOG->TooltipValue = "";

        // dr_sppd
        $this->dr_sppd->LinkCustomAttributes = "";
        $this->dr_sppd->HrefValue = "";
        $this->dr_sppd->TooltipValue = "";

        // dr_spb
        $this->dr_spb->LinkCustomAttributes = "";
        $this->dr_spb->HrefValue = "";
        $this->dr_spb->TooltipValue = "";

        // dr_sprad
        $this->dr_sprad->LinkCustomAttributes = "";
        $this->dr_sprad->HrefValue = "";
        $this->dr_sprad->TooltipValue = "";

        // dr_sprm
        $this->dr_sprm->LinkCustomAttributes = "";
        $this->dr_sprm->HrefValue = "";
        $this->dr_sprm->TooltipValue = "";

        // dr_span
        $this->dr_span->LinkCustomAttributes = "";
        $this->dr_span->HrefValue = "";
        $this->dr_span->TooltipValue = "";

        // dr_spjp
        $this->dr_spjp->LinkCustomAttributes = "";
        $this->dr_spjp->HrefValue = "";
        $this->dr_spjp->TooltipValue = "";

        // dr_spm
        $this->dr_spm->LinkCustomAttributes = "";
        $this->dr_spm->HrefValue = "";
        $this->dr_spm->TooltipValue = "";

        // dr_sptht
        $this->dr_sptht->LinkCustomAttributes = "";
        $this->dr_sptht->HrefValue = "";
        $this->dr_sptht->TooltipValue = "";

        // dr_spkj
        $this->dr_spkj->LinkCustomAttributes = "";
        $this->dr_spkj->HrefValue = "";
        $this->dr_spkj->TooltipValue = "";

        // dr_um
        $this->dr_um->LinkCustomAttributes = "";
        $this->dr_um->HrefValue = "";
        $this->dr_um->TooltipValue = "";

        // drg
        $this->drg->LinkCustomAttributes = "";
        $this->drg->HrefValue = "";
        $this->drg->TooltipValue = "";

        // drg_sp
        $this->drg_sp->LinkCustomAttributes = "";
        $this->drg_sp->HrefValue = "";
        $this->drg_sp->TooltipValue = "";

        // prwt
        $this->prwt->LinkCustomAttributes = "";
        $this->prwt->HrefValue = "";
        $this->prwt->TooltipValue = "";

        // bdn
        $this->bdn->LinkCustomAttributes = "";
        $this->bdn->HrefValue = "";
        $this->bdn->TooltipValue = "";

        // far
        $this->far->LinkCustomAttributes = "";
        $this->far->HrefValue = "";
        $this->far->TooltipValue = "";

        // tkes
        $this->tkes->LinkCustomAttributes = "";
        $this->tkes->HrefValue = "";
        $this->tkes->TooltipValue = "";

        // tNONkes
        $this->tNONkes->LinkCustomAttributes = "";
        $this->tNONkes->HrefValue = "";
        $this->tNONkes->TooltipValue = "";

        // sk_date
        $this->sk_date->LinkCustomAttributes = "";
        $this->sk_date->HrefValue = "";
        $this->sk_date->TooltipValue = "";

        // KECAMATAN
        $this->KECAMATAN->LinkCustomAttributes = "";
        $this->KECAMATAN->HrefValue = "";
        $this->KECAMATAN->TooltipValue = "";

        // KELURAHAN
        $this->KELURAHAN->LinkCustomAttributes = "";
        $this->KELURAHAN->HrefValue = "";
        $this->KELURAHAN->TooltipValue = "";

        // KOTA
        $this->KOTA->LinkCustomAttributes = "";
        $this->KOTA->HrefValue = "";
        $this->KOTA->TooltipValue = "";

        // SERVERNAME
        $this->SERVERNAME->LinkCustomAttributes = "";
        $this->SERVERNAME->HrefValue = "";
        $this->SERVERNAME->TooltipValue = "";

        // DBNAMES
        $this->DBNAMES->LinkCustomAttributes = "";
        $this->DBNAMES->HrefValue = "";
        $this->DBNAMES->TooltipValue = "";

        // DBPARENT
        $this->DBPARENT->LinkCustomAttributes = "";
        $this->DBPARENT->HrefValue = "";
        $this->DBPARENT->TooltipValue = "";

        // CONSID
        $this->CONSID->LinkCustomAttributes = "";
        $this->CONSID->HrefValue = "";
        $this->CONSID->TooltipValue = "";

        // CONSECRET
        $this->CONSECRET->LinkCustomAttributes = "";
        $this->CONSECRET->HrefValue = "";
        $this->CONSECRET->TooltipValue = "";

        // PCAREUN
        $this->PCAREUN->LinkCustomAttributes = "";
        $this->PCAREUN->HrefValue = "";
        $this->PCAREUN->TooltipValue = "";

        // PCAREPSW
        $this->PCAREPSW->LinkCustomAttributes = "";
        $this->PCAREPSW->HrefValue = "";
        $this->PCAREPSW->TooltipValue = "";

        // KDAPLIKASI
        $this->KDAPLIKASI->LinkCustomAttributes = "";
        $this->KDAPLIKASI->HrefValue = "";
        $this->KDAPLIKASI->TooltipValue = "";

        // PCAREDIR
        $this->PCAREDIR->LinkCustomAttributes = "";
        $this->PCAREDIR->HrefValue = "";
        $this->PCAREDIR->TooltipValue = "";

        // PCAREBASEURL0
        $this->PCAREBASEURL0->LinkCustomAttributes = "";
        $this->PCAREBASEURL0->HrefValue = "";
        $this->PCAREBASEURL0->TooltipValue = "";

        // PCAREBASEURL1
        $this->PCAREBASEURL1->LinkCustomAttributes = "";
        $this->PCAREBASEURL1->HrefValue = "";
        $this->PCAREBASEURL1->TooltipValue = "";

        // PCAREBASEURL2
        $this->PCAREBASEURL2->LinkCustomAttributes = "";
        $this->PCAREBASEURL2->HrefValue = "";
        $this->PCAREBASEURL2->TooltipValue = "";

        // DBUN
        $this->DBUN->LinkCustomAttributes = "";
        $this->DBUN->HrefValue = "";
        $this->DBUN->TooltipValue = "";

        // DBPSW
        $this->DBPSW->LinkCustomAttributes = "";
        $this->DBPSW->HrefValue = "";
        $this->DBPSW->TooltipValue = "";

        // PICTUREFILE
        $this->PICTUREFILE->LinkCustomAttributes = "";
        if (!empty($this->PICTUREFILE->Upload->DbValue)) {
            $this->PICTUREFILE->HrefValue = GetFileUploadUrl($this->PICTUREFILE, $this->ORG_UNIT_CODE->CurrentValue);
            $this->PICTUREFILE->LinkAttrs["target"] = "";
            if ($this->PICTUREFILE->IsBlobImage && empty($this->PICTUREFILE->LinkAttrs["target"])) {
                $this->PICTUREFILE->LinkAttrs["target"] = "_blank";
            }
            if ($this->isExport()) {
                $this->PICTUREFILE->HrefValue = FullUrl($this->PICTUREFILE->HrefValue, "href");
            }
        } else {
            $this->PICTUREFILE->HrefValue = "";
        }
        $this->PICTUREFILE->ExportHrefValue = GetFileUploadUrl($this->PICTUREFILE, $this->ORG_UNIT_CODE->CurrentValue);
        $this->PICTUREFILE->TooltipValue = "";

        // PROVINSI
        $this->PROVINSI->LinkCustomAttributes = "";
        $this->PROVINSI->HrefValue = "";
        $this->PROVINSI->TooltipValue = "";

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

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->OBJECT_CATEGORY_ID->EditCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->EditValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->OBJECT_CATEGORY_ID->caption());

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
        $this->ORG_UNIT_CODE->EditCustomAttributes = "";
        if (!$this->ORG_UNIT_CODE->Raw) {
            $this->ORG_UNIT_CODE->CurrentValue = HtmlDecode($this->ORG_UNIT_CODE->CurrentValue);
        }
        $this->ORG_UNIT_CODE->EditValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->PlaceHolder = RemoveHtml($this->ORG_UNIT_CODE->caption());

        // ORG_TYPE
        $this->ORG_TYPE->EditAttrs["class"] = "form-control";
        $this->ORG_TYPE->EditCustomAttributes = "";
        if (!$this->ORG_TYPE->Raw) {
            $this->ORG_TYPE->CurrentValue = HtmlDecode($this->ORG_TYPE->CurrentValue);
        }
        $this->ORG_TYPE->EditValue = $this->ORG_TYPE->CurrentValue;
        $this->ORG_TYPE->PlaceHolder = RemoveHtml($this->ORG_TYPE->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->EditValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // HIRARKI_ID
        $this->HIRARKI_ID->EditAttrs["class"] = "form-control";
        $this->HIRARKI_ID->EditCustomAttributes = "";
        $this->HIRARKI_ID->EditValue = $this->HIRARKI_ID->CurrentValue;
        $this->HIRARKI_ID->PlaceHolder = RemoveHtml($this->HIRARKI_ID->caption());

        // NAME_OF_ORG_UNIT
        $this->NAME_OF_ORG_UNIT->EditAttrs["class"] = "form-control";
        $this->NAME_OF_ORG_UNIT->EditCustomAttributes = "";
        if (!$this->NAME_OF_ORG_UNIT->Raw) {
            $this->NAME_OF_ORG_UNIT->CurrentValue = HtmlDecode($this->NAME_OF_ORG_UNIT->CurrentValue);
        }
        $this->NAME_OF_ORG_UNIT->EditValue = $this->NAME_OF_ORG_UNIT->CurrentValue;
        $this->NAME_OF_ORG_UNIT->PlaceHolder = RemoveHtml($this->NAME_OF_ORG_UNIT->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->EditAttrs["class"] = "form-control";
        $this->CONTACT_ADDRESS->EditCustomAttributes = "";
        if (!$this->CONTACT_ADDRESS->Raw) {
            $this->CONTACT_ADDRESS->CurrentValue = HtmlDecode($this->CONTACT_ADDRESS->CurrentValue);
        }
        $this->CONTACT_ADDRESS->EditValue = $this->CONTACT_ADDRESS->CurrentValue;
        $this->CONTACT_ADDRESS->PlaceHolder = RemoveHtml($this->CONTACT_ADDRESS->caption());

        // KEC_ID
        $this->KEC_ID->EditAttrs["class"] = "form-control";
        $this->KEC_ID->EditCustomAttributes = "";
        if (!$this->KEC_ID->Raw) {
            $this->KEC_ID->CurrentValue = HtmlDecode($this->KEC_ID->CurrentValue);
        }
        $this->KEC_ID->EditValue = $this->KEC_ID->CurrentValue;
        $this->KEC_ID->PlaceHolder = RemoveHtml($this->KEC_ID->caption());

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // KODE_KOTA
        $this->KODE_KOTA->EditAttrs["class"] = "form-control";
        $this->KODE_KOTA->EditCustomAttributes = "";
        if (!$this->KODE_KOTA->Raw) {
            $this->KODE_KOTA->CurrentValue = HtmlDecode($this->KODE_KOTA->CurrentValue);
        }
        $this->KODE_KOTA->EditValue = $this->KODE_KOTA->CurrentValue;
        $this->KODE_KOTA->PlaceHolder = RemoveHtml($this->KODE_KOTA->caption());

        // SK
        $this->SK->EditAttrs["class"] = "form-control";
        $this->SK->EditCustomAttributes = "";
        if (!$this->SK->Raw) {
            $this->SK->CurrentValue = HtmlDecode($this->SK->CurrentValue);
        }
        $this->SK->EditValue = $this->SK->CurrentValue;
        $this->SK->PlaceHolder = RemoveHtml($this->SK->caption());

        // PENETAP_ID
        $this->PENETAP_ID->EditAttrs["class"] = "form-control";
        $this->PENETAP_ID->EditCustomAttributes = "";
        $this->PENETAP_ID->EditValue = $this->PENETAP_ID->CurrentValue;
        $this->PENETAP_ID->PlaceHolder = RemoveHtml($this->PENETAP_ID->caption());

        // BY_ID
        $this->BY_ID->EditAttrs["class"] = "form-control";
        $this->BY_ID->EditCustomAttributes = "";
        $this->BY_ID->EditValue = $this->BY_ID->CurrentValue;
        $this->BY_ID->PlaceHolder = RemoveHtml($this->BY_ID->caption());

        // ACCREDITATION
        $this->ACCREDITATION->EditAttrs["class"] = "form-control";
        $this->ACCREDITATION->EditCustomAttributes = "";
        $this->ACCREDITATION->EditValue = $this->ACCREDITATION->CurrentValue;
        $this->ACCREDITATION->PlaceHolder = RemoveHtml($this->ACCREDITATION->caption());

        // ACCREDIT_STATUS
        $this->ACCREDIT_STATUS->EditAttrs["class"] = "form-control";
        $this->ACCREDIT_STATUS->EditCustomAttributes = "";
        $this->ACCREDIT_STATUS->EditValue = $this->ACCREDIT_STATUS->CurrentValue;
        $this->ACCREDIT_STATUS->PlaceHolder = RemoveHtml($this->ACCREDIT_STATUS->caption());

        // SK_STATUS
        $this->SK_STATUS->EditAttrs["class"] = "form-control";
        $this->SK_STATUS->EditCustomAttributes = "";
        $this->SK_STATUS->EditValue = $this->SK_STATUS->CurrentValue;
        $this->SK_STATUS->PlaceHolder = RemoveHtml($this->SK_STATUS->caption());

        // WEBSITE
        $this->WEBSITE->EditAttrs["class"] = "form-control";
        $this->WEBSITE->EditCustomAttributes = "";
        if (!$this->WEBSITE->Raw) {
            $this->WEBSITE->CurrentValue = HtmlDecode($this->WEBSITE->CurrentValue);
        }
        $this->WEBSITE->EditValue = $this->WEBSITE->CurrentValue;
        $this->WEBSITE->PlaceHolder = RemoveHtml($this->WEBSITE->caption());

        // EMAIL
        $this->_EMAIL->EditAttrs["class"] = "form-control";
        $this->_EMAIL->EditCustomAttributes = "";
        if (!$this->_EMAIL->Raw) {
            $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
        }
        $this->_EMAIL->EditValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

        // WIN_MENU
        $this->WIN_MENU->EditAttrs["class"] = "form-control";
        $this->WIN_MENU->EditCustomAttributes = "";
        if (!$this->WIN_MENU->Raw) {
            $this->WIN_MENU->CurrentValue = HtmlDecode($this->WIN_MENU->CurrentValue);
        }
        $this->WIN_MENU->EditValue = $this->WIN_MENU->CurrentValue;
        $this->WIN_MENU->PlaceHolder = RemoveHtml($this->WIN_MENU->caption());

        // LOGOFILE
        $this->LOGOFILE->EditAttrs["class"] = "form-control";
        $this->LOGOFILE->EditCustomAttributes = "";
        if (!$this->LOGOFILE->Raw) {
            $this->LOGOFILE->CurrentValue = HtmlDecode($this->LOGOFILE->CurrentValue);
        }
        $this->LOGOFILE->EditValue = $this->LOGOFILE->CurrentValue;
        $this->LOGOFILE->PlaceHolder = RemoveHtml($this->LOGOFILE->caption());

        // IP_ADDRESS
        $this->IP_ADDRESS->EditAttrs["class"] = "form-control";
        $this->IP_ADDRESS->EditCustomAttributes = "";
        if (!$this->IP_ADDRESS->Raw) {
            $this->IP_ADDRESS->CurrentValue = HtmlDecode($this->IP_ADDRESS->CurrentValue);
        }
        $this->IP_ADDRESS->EditValue = $this->IP_ADDRESS->CurrentValue;
        $this->IP_ADDRESS->PlaceHolder = RemoveHtml($this->IP_ADDRESS->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // DENAH_FILE
        $this->DENAH_FILE->EditAttrs["class"] = "form-control";
        $this->DENAH_FILE->EditCustomAttributes = "";
        if (!$this->DENAH_FILE->Raw) {
            $this->DENAH_FILE->CurrentValue = HtmlDecode($this->DENAH_FILE->CurrentValue);
        }
        $this->DENAH_FILE->EditValue = $this->DENAH_FILE->CurrentValue;
        $this->DENAH_FILE->PlaceHolder = RemoveHtml($this->DENAH_FILE->caption());

        // BIDANG_ID
        $this->BIDANG_ID->EditAttrs["class"] = "form-control";
        $this->BIDANG_ID->EditCustomAttributes = "";
        $this->BIDANG_ID->EditValue = $this->BIDANG_ID->CurrentValue;
        $this->BIDANG_ID->PlaceHolder = RemoveHtml($this->BIDANG_ID->caption());

        // MAIN_PARENT
        $this->MAIN_PARENT->EditAttrs["class"] = "form-control";
        $this->MAIN_PARENT->EditCustomAttributes = "";
        if (!$this->MAIN_PARENT->Raw) {
            $this->MAIN_PARENT->CurrentValue = HtmlDecode($this->MAIN_PARENT->CurrentValue);
        }
        $this->MAIN_PARENT->EditValue = $this->MAIN_PARENT->CurrentValue;
        $this->MAIN_PARENT->PlaceHolder = RemoveHtml($this->MAIN_PARENT->caption());

        // DIRECT_PARENT
        $this->DIRECT_PARENT->EditAttrs["class"] = "form-control";
        $this->DIRECT_PARENT->EditCustomAttributes = "";
        if (!$this->DIRECT_PARENT->Raw) {
            $this->DIRECT_PARENT->CurrentValue = HtmlDecode($this->DIRECT_PARENT->CurrentValue);
        }
        $this->DIRECT_PARENT->EditValue = $this->DIRECT_PARENT->CurrentValue;
        $this->DIRECT_PARENT->PlaceHolder = RemoveHtml($this->DIRECT_PARENT->caption());

        // WHOLE_PARENT
        $this->WHOLE_PARENT->EditAttrs["class"] = "form-control";
        $this->WHOLE_PARENT->EditCustomAttributes = "";
        if (!$this->WHOLE_PARENT->Raw) {
            $this->WHOLE_PARENT->CurrentValue = HtmlDecode($this->WHOLE_PARENT->CurrentValue);
        }
        $this->WHOLE_PARENT->EditValue = $this->WHOLE_PARENT->CurrentValue;
        $this->WHOLE_PARENT->PlaceHolder = RemoveHtml($this->WHOLE_PARENT->caption());

        // HEADER
        $this->HEADER->EditAttrs["class"] = "form-control";
        $this->HEADER->EditCustomAttributes = "";
        if (!$this->HEADER->Raw) {
            $this->HEADER->CurrentValue = HtmlDecode($this->HEADER->CurrentValue);
        }
        $this->HEADER->EditValue = $this->HEADER->CurrentValue;
        $this->HEADER->PlaceHolder = RemoveHtml($this->HEADER->caption());

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

        // POSTAL_CODE
        $this->POSTAL_CODE->EditAttrs["class"] = "form-control";
        $this->POSTAL_CODE->EditCustomAttributes = "";
        if (!$this->POSTAL_CODE->Raw) {
            $this->POSTAL_CODE->CurrentValue = HtmlDecode($this->POSTAL_CODE->CurrentValue);
        }
        $this->POSTAL_CODE->EditValue = $this->POSTAL_CODE->CurrentValue;
        $this->POSTAL_CODE->PlaceHolder = RemoveHtml($this->POSTAL_CODE->caption());

        // DISPLAY
        $this->DISPLAY->EditAttrs["class"] = "form-control";
        $this->DISPLAY->EditCustomAttributes = "";
        if (!$this->DISPLAY->Raw) {
            $this->DISPLAY->CurrentValue = HtmlDecode($this->DISPLAY->CurrentValue);
        }
        $this->DISPLAY->EditValue = $this->DISPLAY->CurrentValue;
        $this->DISPLAY->PlaceHolder = RemoveHtml($this->DISPLAY->caption());

        // OTHER_CODE
        $this->OTHER_CODE->EditAttrs["class"] = "form-control";
        $this->OTHER_CODE->EditCustomAttributes = "";
        if (!$this->OTHER_CODE->Raw) {
            $this->OTHER_CODE->CurrentValue = HtmlDecode($this->OTHER_CODE->CurrentValue);
        }
        $this->OTHER_CODE->EditValue = $this->OTHER_CODE->CurrentValue;
        $this->OTHER_CODE->PlaceHolder = RemoveHtml($this->OTHER_CODE->caption());

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

        // ISSTATE
        $this->ISSTATE->EditAttrs["class"] = "form-control";
        $this->ISSTATE->EditCustomAttributes = "";
        if (!$this->ISSTATE->Raw) {
            $this->ISSTATE->CurrentValue = HtmlDecode($this->ISSTATE->CurrentValue);
        }
        $this->ISSTATE->EditValue = $this->ISSTATE->CurrentValue;
        $this->ISSTATE->PlaceHolder = RemoveHtml($this->ISSTATE->caption());

        // REGISTRATION_DATE
        $this->REGISTRATION_DATE->EditAttrs["class"] = "form-control";
        $this->REGISTRATION_DATE->EditCustomAttributes = "";
        $this->REGISTRATION_DATE->EditValue = FormatDateTime($this->REGISTRATION_DATE->CurrentValue, 8);
        $this->REGISTRATION_DATE->PlaceHolder = RemoveHtml($this->REGISTRATION_DATE->caption());

        // LUAS_TANAH
        $this->LUAS_TANAH->EditAttrs["class"] = "form-control";
        $this->LUAS_TANAH->EditCustomAttributes = "";
        $this->LUAS_TANAH->EditValue = $this->LUAS_TANAH->CurrentValue;
        $this->LUAS_TANAH->PlaceHolder = RemoveHtml($this->LUAS_TANAH->caption());
        if (strval($this->LUAS_TANAH->EditValue) != "" && is_numeric($this->LUAS_TANAH->EditValue)) {
            $this->LUAS_TANAH->EditValue = FormatNumber($this->LUAS_TANAH->EditValue, -2, -2, -2, -2);
        }

        // LUAS_BANGUNAN
        $this->LUAS_BANGUNAN->EditAttrs["class"] = "form-control";
        $this->LUAS_BANGUNAN->EditCustomAttributes = "";
        $this->LUAS_BANGUNAN->EditValue = $this->LUAS_BANGUNAN->CurrentValue;
        $this->LUAS_BANGUNAN->PlaceHolder = RemoveHtml($this->LUAS_BANGUNAN->caption());
        if (strval($this->LUAS_BANGUNAN->EditValue) != "" && is_numeric($this->LUAS_BANGUNAN->EditValue)) {
            $this->LUAS_BANGUNAN->EditValue = FormatNumber($this->LUAS_BANGUNAN->EditValue, -2, -2, -2, -2);
        }

        // SK_MASA
        $this->SK_MASA->EditAttrs["class"] = "form-control";
        $this->SK_MASA->EditCustomAttributes = "";
        $this->SK_MASA->EditValue = FormatDateTime($this->SK_MASA->CurrentValue, 8);
        $this->SK_MASA->PlaceHolder = RemoveHtml($this->SK_MASA->caption());

        // ACCREDITATION_DATE
        $this->ACCREDITATION_DATE->EditAttrs["class"] = "form-control";
        $this->ACCREDITATION_DATE->EditCustomAttributes = "";
        $this->ACCREDITATION_DATE->EditValue = FormatDateTime($this->ACCREDITATION_DATE->CurrentValue, 8);
        $this->ACCREDITATION_DATE->PlaceHolder = RemoveHtml($this->ACCREDITATION_DATE->caption());

        // TT_VVIP
        $this->TT_VVIP->EditAttrs["class"] = "form-control";
        $this->TT_VVIP->EditCustomAttributes = "";
        $this->TT_VVIP->EditValue = $this->TT_VVIP->CurrentValue;
        $this->TT_VVIP->PlaceHolder = RemoveHtml($this->TT_VVIP->caption());

        // TT_VIP
        $this->TT_VIP->EditAttrs["class"] = "form-control";
        $this->TT_VIP->EditCustomAttributes = "";
        $this->TT_VIP->EditValue = $this->TT_VIP->CurrentValue;
        $this->TT_VIP->PlaceHolder = RemoveHtml($this->TT_VIP->caption());

        // TT_1
        $this->TT_1->EditAttrs["class"] = "form-control";
        $this->TT_1->EditCustomAttributes = "";
        $this->TT_1->EditValue = $this->TT_1->CurrentValue;
        $this->TT_1->PlaceHolder = RemoveHtml($this->TT_1->caption());

        // TT_2
        $this->TT_2->EditAttrs["class"] = "form-control";
        $this->TT_2->EditCustomAttributes = "";
        $this->TT_2->EditValue = $this->TT_2->CurrentValue;
        $this->TT_2->PlaceHolder = RemoveHtml($this->TT_2->caption());

        // TT_3
        $this->TT_3->EditAttrs["class"] = "form-control";
        $this->TT_3->EditCustomAttributes = "";
        $this->TT_3->EditValue = $this->TT_3->CurrentValue;
        $this->TT_3->PlaceHolder = RemoveHtml($this->TT_3->caption());

        // DR_SPA
        $this->DR_SPA->EditAttrs["class"] = "form-control";
        $this->DR_SPA->EditCustomAttributes = "";
        $this->DR_SPA->EditValue = $this->DR_SPA->CurrentValue;
        $this->DR_SPA->PlaceHolder = RemoveHtml($this->DR_SPA->caption());

        // DR_SPOG
        $this->DR_SPOG->EditAttrs["class"] = "form-control";
        $this->DR_SPOG->EditCustomAttributes = "";
        $this->DR_SPOG->EditValue = $this->DR_SPOG->CurrentValue;
        $this->DR_SPOG->PlaceHolder = RemoveHtml($this->DR_SPOG->caption());

        // dr_sppd
        $this->dr_sppd->EditAttrs["class"] = "form-control";
        $this->dr_sppd->EditCustomAttributes = "";
        $this->dr_sppd->EditValue = $this->dr_sppd->CurrentValue;
        $this->dr_sppd->PlaceHolder = RemoveHtml($this->dr_sppd->caption());

        // dr_spb
        $this->dr_spb->EditAttrs["class"] = "form-control";
        $this->dr_spb->EditCustomAttributes = "";
        $this->dr_spb->EditValue = $this->dr_spb->CurrentValue;
        $this->dr_spb->PlaceHolder = RemoveHtml($this->dr_spb->caption());

        // dr_sprad
        $this->dr_sprad->EditAttrs["class"] = "form-control";
        $this->dr_sprad->EditCustomAttributes = "";
        $this->dr_sprad->EditValue = $this->dr_sprad->CurrentValue;
        $this->dr_sprad->PlaceHolder = RemoveHtml($this->dr_sprad->caption());

        // dr_sprm
        $this->dr_sprm->EditAttrs["class"] = "form-control";
        $this->dr_sprm->EditCustomAttributes = "";
        $this->dr_sprm->EditValue = $this->dr_sprm->CurrentValue;
        $this->dr_sprm->PlaceHolder = RemoveHtml($this->dr_sprm->caption());

        // dr_span
        $this->dr_span->EditAttrs["class"] = "form-control";
        $this->dr_span->EditCustomAttributes = "";
        $this->dr_span->EditValue = $this->dr_span->CurrentValue;
        $this->dr_span->PlaceHolder = RemoveHtml($this->dr_span->caption());

        // dr_spjp
        $this->dr_spjp->EditAttrs["class"] = "form-control";
        $this->dr_spjp->EditCustomAttributes = "";
        $this->dr_spjp->EditValue = $this->dr_spjp->CurrentValue;
        $this->dr_spjp->PlaceHolder = RemoveHtml($this->dr_spjp->caption());

        // dr_spm
        $this->dr_spm->EditAttrs["class"] = "form-control";
        $this->dr_spm->EditCustomAttributes = "";
        $this->dr_spm->EditValue = $this->dr_spm->CurrentValue;
        $this->dr_spm->PlaceHolder = RemoveHtml($this->dr_spm->caption());

        // dr_sptht
        $this->dr_sptht->EditAttrs["class"] = "form-control";
        $this->dr_sptht->EditCustomAttributes = "";
        $this->dr_sptht->EditValue = $this->dr_sptht->CurrentValue;
        $this->dr_sptht->PlaceHolder = RemoveHtml($this->dr_sptht->caption());

        // dr_spkj
        $this->dr_spkj->EditAttrs["class"] = "form-control";
        $this->dr_spkj->EditCustomAttributes = "";
        $this->dr_spkj->EditValue = $this->dr_spkj->CurrentValue;
        $this->dr_spkj->PlaceHolder = RemoveHtml($this->dr_spkj->caption());

        // dr_um
        $this->dr_um->EditAttrs["class"] = "form-control";
        $this->dr_um->EditCustomAttributes = "";
        $this->dr_um->EditValue = $this->dr_um->CurrentValue;
        $this->dr_um->PlaceHolder = RemoveHtml($this->dr_um->caption());

        // drg
        $this->drg->EditAttrs["class"] = "form-control";
        $this->drg->EditCustomAttributes = "";
        $this->drg->EditValue = $this->drg->CurrentValue;
        $this->drg->PlaceHolder = RemoveHtml($this->drg->caption());

        // drg_sp
        $this->drg_sp->EditAttrs["class"] = "form-control";
        $this->drg_sp->EditCustomAttributes = "";
        $this->drg_sp->EditValue = $this->drg_sp->CurrentValue;
        $this->drg_sp->PlaceHolder = RemoveHtml($this->drg_sp->caption());

        // prwt
        $this->prwt->EditAttrs["class"] = "form-control";
        $this->prwt->EditCustomAttributes = "";
        $this->prwt->EditValue = $this->prwt->CurrentValue;
        $this->prwt->PlaceHolder = RemoveHtml($this->prwt->caption());

        // bdn
        $this->bdn->EditAttrs["class"] = "form-control";
        $this->bdn->EditCustomAttributes = "";
        $this->bdn->EditValue = $this->bdn->CurrentValue;
        $this->bdn->PlaceHolder = RemoveHtml($this->bdn->caption());

        // far
        $this->far->EditAttrs["class"] = "form-control";
        $this->far->EditCustomAttributes = "";
        $this->far->EditValue = $this->far->CurrentValue;
        $this->far->PlaceHolder = RemoveHtml($this->far->caption());

        // tkes
        $this->tkes->EditAttrs["class"] = "form-control";
        $this->tkes->EditCustomAttributes = "";
        $this->tkes->EditValue = $this->tkes->CurrentValue;
        $this->tkes->PlaceHolder = RemoveHtml($this->tkes->caption());

        // tNONkes
        $this->tNONkes->EditAttrs["class"] = "form-control";
        $this->tNONkes->EditCustomAttributes = "";
        $this->tNONkes->EditValue = $this->tNONkes->CurrentValue;
        $this->tNONkes->PlaceHolder = RemoveHtml($this->tNONkes->caption());

        // sk_date
        $this->sk_date->EditAttrs["class"] = "form-control";
        $this->sk_date->EditCustomAttributes = "";
        $this->sk_date->EditValue = FormatDateTime($this->sk_date->CurrentValue, 8);
        $this->sk_date->PlaceHolder = RemoveHtml($this->sk_date->caption());

        // KECAMATAN
        $this->KECAMATAN->EditAttrs["class"] = "form-control";
        $this->KECAMATAN->EditCustomAttributes = "";
        if (!$this->KECAMATAN->Raw) {
            $this->KECAMATAN->CurrentValue = HtmlDecode($this->KECAMATAN->CurrentValue);
        }
        $this->KECAMATAN->EditValue = $this->KECAMATAN->CurrentValue;
        $this->KECAMATAN->PlaceHolder = RemoveHtml($this->KECAMATAN->caption());

        // KELURAHAN
        $this->KELURAHAN->EditAttrs["class"] = "form-control";
        $this->KELURAHAN->EditCustomAttributes = "";
        if (!$this->KELURAHAN->Raw) {
            $this->KELURAHAN->CurrentValue = HtmlDecode($this->KELURAHAN->CurrentValue);
        }
        $this->KELURAHAN->EditValue = $this->KELURAHAN->CurrentValue;
        $this->KELURAHAN->PlaceHolder = RemoveHtml($this->KELURAHAN->caption());

        // KOTA
        $this->KOTA->EditAttrs["class"] = "form-control";
        $this->KOTA->EditCustomAttributes = "";
        if (!$this->KOTA->Raw) {
            $this->KOTA->CurrentValue = HtmlDecode($this->KOTA->CurrentValue);
        }
        $this->KOTA->EditValue = $this->KOTA->CurrentValue;
        $this->KOTA->PlaceHolder = RemoveHtml($this->KOTA->caption());

        // SERVERNAME
        $this->SERVERNAME->EditAttrs["class"] = "form-control";
        $this->SERVERNAME->EditCustomAttributes = "";
        if (!$this->SERVERNAME->Raw) {
            $this->SERVERNAME->CurrentValue = HtmlDecode($this->SERVERNAME->CurrentValue);
        }
        $this->SERVERNAME->EditValue = $this->SERVERNAME->CurrentValue;
        $this->SERVERNAME->PlaceHolder = RemoveHtml($this->SERVERNAME->caption());

        // DBNAMES
        $this->DBNAMES->EditAttrs["class"] = "form-control";
        $this->DBNAMES->EditCustomAttributes = "";
        if (!$this->DBNAMES->Raw) {
            $this->DBNAMES->CurrentValue = HtmlDecode($this->DBNAMES->CurrentValue);
        }
        $this->DBNAMES->EditValue = $this->DBNAMES->CurrentValue;
        $this->DBNAMES->PlaceHolder = RemoveHtml($this->DBNAMES->caption());

        // DBPARENT
        $this->DBPARENT->EditAttrs["class"] = "form-control";
        $this->DBPARENT->EditCustomAttributes = "";
        if (!$this->DBPARENT->Raw) {
            $this->DBPARENT->CurrentValue = HtmlDecode($this->DBPARENT->CurrentValue);
        }
        $this->DBPARENT->EditValue = $this->DBPARENT->CurrentValue;
        $this->DBPARENT->PlaceHolder = RemoveHtml($this->DBPARENT->caption());

        // CONSID
        $this->CONSID->EditAttrs["class"] = "form-control";
        $this->CONSID->EditCustomAttributes = "";
        if (!$this->CONSID->Raw) {
            $this->CONSID->CurrentValue = HtmlDecode($this->CONSID->CurrentValue);
        }
        $this->CONSID->EditValue = $this->CONSID->CurrentValue;
        $this->CONSID->PlaceHolder = RemoveHtml($this->CONSID->caption());

        // CONSECRET
        $this->CONSECRET->EditAttrs["class"] = "form-control";
        $this->CONSECRET->EditCustomAttributes = "";
        if (!$this->CONSECRET->Raw) {
            $this->CONSECRET->CurrentValue = HtmlDecode($this->CONSECRET->CurrentValue);
        }
        $this->CONSECRET->EditValue = $this->CONSECRET->CurrentValue;
        $this->CONSECRET->PlaceHolder = RemoveHtml($this->CONSECRET->caption());

        // PCAREUN
        $this->PCAREUN->EditAttrs["class"] = "form-control";
        $this->PCAREUN->EditCustomAttributes = "";
        if (!$this->PCAREUN->Raw) {
            $this->PCAREUN->CurrentValue = HtmlDecode($this->PCAREUN->CurrentValue);
        }
        $this->PCAREUN->EditValue = $this->PCAREUN->CurrentValue;
        $this->PCAREUN->PlaceHolder = RemoveHtml($this->PCAREUN->caption());

        // PCAREPSW
        $this->PCAREPSW->EditAttrs["class"] = "form-control";
        $this->PCAREPSW->EditCustomAttributes = "";
        if (!$this->PCAREPSW->Raw) {
            $this->PCAREPSW->CurrentValue = HtmlDecode($this->PCAREPSW->CurrentValue);
        }
        $this->PCAREPSW->EditValue = $this->PCAREPSW->CurrentValue;
        $this->PCAREPSW->PlaceHolder = RemoveHtml($this->PCAREPSW->caption());

        // KDAPLIKASI
        $this->KDAPLIKASI->EditAttrs["class"] = "form-control";
        $this->KDAPLIKASI->EditCustomAttributes = "";
        if (!$this->KDAPLIKASI->Raw) {
            $this->KDAPLIKASI->CurrentValue = HtmlDecode($this->KDAPLIKASI->CurrentValue);
        }
        $this->KDAPLIKASI->EditValue = $this->KDAPLIKASI->CurrentValue;
        $this->KDAPLIKASI->PlaceHolder = RemoveHtml($this->KDAPLIKASI->caption());

        // PCAREDIR
        $this->PCAREDIR->EditAttrs["class"] = "form-control";
        $this->PCAREDIR->EditCustomAttributes = "";
        if (!$this->PCAREDIR->Raw) {
            $this->PCAREDIR->CurrentValue = HtmlDecode($this->PCAREDIR->CurrentValue);
        }
        $this->PCAREDIR->EditValue = $this->PCAREDIR->CurrentValue;
        $this->PCAREDIR->PlaceHolder = RemoveHtml($this->PCAREDIR->caption());

        // PCAREBASEURL0
        $this->PCAREBASEURL0->EditAttrs["class"] = "form-control";
        $this->PCAREBASEURL0->EditCustomAttributes = "";
        if (!$this->PCAREBASEURL0->Raw) {
            $this->PCAREBASEURL0->CurrentValue = HtmlDecode($this->PCAREBASEURL0->CurrentValue);
        }
        $this->PCAREBASEURL0->EditValue = $this->PCAREBASEURL0->CurrentValue;
        $this->PCAREBASEURL0->PlaceHolder = RemoveHtml($this->PCAREBASEURL0->caption());

        // PCAREBASEURL1
        $this->PCAREBASEURL1->EditAttrs["class"] = "form-control";
        $this->PCAREBASEURL1->EditCustomAttributes = "";
        if (!$this->PCAREBASEURL1->Raw) {
            $this->PCAREBASEURL1->CurrentValue = HtmlDecode($this->PCAREBASEURL1->CurrentValue);
        }
        $this->PCAREBASEURL1->EditValue = $this->PCAREBASEURL1->CurrentValue;
        $this->PCAREBASEURL1->PlaceHolder = RemoveHtml($this->PCAREBASEURL1->caption());

        // PCAREBASEURL2
        $this->PCAREBASEURL2->EditAttrs["class"] = "form-control";
        $this->PCAREBASEURL2->EditCustomAttributes = "";
        if (!$this->PCAREBASEURL2->Raw) {
            $this->PCAREBASEURL2->CurrentValue = HtmlDecode($this->PCAREBASEURL2->CurrentValue);
        }
        $this->PCAREBASEURL2->EditValue = $this->PCAREBASEURL2->CurrentValue;
        $this->PCAREBASEURL2->PlaceHolder = RemoveHtml($this->PCAREBASEURL2->caption());

        // DBUN
        $this->DBUN->EditAttrs["class"] = "form-control";
        $this->DBUN->EditCustomAttributes = "";
        if (!$this->DBUN->Raw) {
            $this->DBUN->CurrentValue = HtmlDecode($this->DBUN->CurrentValue);
        }
        $this->DBUN->EditValue = $this->DBUN->CurrentValue;
        $this->DBUN->PlaceHolder = RemoveHtml($this->DBUN->caption());

        // DBPSW
        $this->DBPSW->EditAttrs["class"] = "form-control";
        $this->DBPSW->EditCustomAttributes = "";
        if (!$this->DBPSW->Raw) {
            $this->DBPSW->CurrentValue = HtmlDecode($this->DBPSW->CurrentValue);
        }
        $this->DBPSW->EditValue = $this->DBPSW->CurrentValue;
        $this->DBPSW->PlaceHolder = RemoveHtml($this->DBPSW->caption());

        // PICTUREFILE
        $this->PICTUREFILE->EditAttrs["class"] = "form-control";
        $this->PICTUREFILE->EditCustomAttributes = "";
        if (!EmptyValue($this->PICTUREFILE->Upload->DbValue)) {
            $this->PICTUREFILE->EditValue = $this->ORG_UNIT_CODE->CurrentValue;
            $this->PICTUREFILE->IsBlobImage = IsImageFile(ContentExtension($this->PICTUREFILE->Upload->DbValue));
        } else {
            $this->PICTUREFILE->EditValue = "";
        }

        // PROVINSI
        $this->PROVINSI->EditAttrs["class"] = "form-control";
        $this->PROVINSI->EditCustomAttributes = "";
        if (!$this->PROVINSI->Raw) {
            $this->PROVINSI->CurrentValue = HtmlDecode($this->PROVINSI->CurrentValue);
        }
        $this->PROVINSI->EditValue = $this->PROVINSI->CurrentValue;
        $this->PROVINSI->PlaceHolder = RemoveHtml($this->PROVINSI->caption());

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
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->ORG_TYPE);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->HIRARKI_ID);
                    $doc->exportCaption($this->NAME_OF_ORG_UNIT);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->CONTACT_ADDRESS);
                    $doc->exportCaption($this->KEC_ID);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->KODE_KOTA);
                    $doc->exportCaption($this->SK);
                    $doc->exportCaption($this->PENETAP_ID);
                    $doc->exportCaption($this->BY_ID);
                    $doc->exportCaption($this->ACCREDITATION);
                    $doc->exportCaption($this->ACCREDIT_STATUS);
                    $doc->exportCaption($this->SK_STATUS);
                    $doc->exportCaption($this->WEBSITE);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->WIN_MENU);
                    $doc->exportCaption($this->LOGOFILE);
                    $doc->exportCaption($this->IP_ADDRESS);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DENAH_FILE);
                    $doc->exportCaption($this->BIDANG_ID);
                    $doc->exportCaption($this->MAIN_PARENT);
                    $doc->exportCaption($this->DIRECT_PARENT);
                    $doc->exportCaption($this->WHOLE_PARENT);
                    $doc->exportCaption($this->HEADER);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->POSTAL_CODE);
                    $doc->exportCaption($this->DISPLAY);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->ISSTATE);
                    $doc->exportCaption($this->REGISTRATION_DATE);
                    $doc->exportCaption($this->LUAS_TANAH);
                    $doc->exportCaption($this->LUAS_BANGUNAN);
                    $doc->exportCaption($this->SK_MASA);
                    $doc->exportCaption($this->ACCREDITATION_DATE);
                    $doc->exportCaption($this->TT_VVIP);
                    $doc->exportCaption($this->TT_VIP);
                    $doc->exportCaption($this->TT_1);
                    $doc->exportCaption($this->TT_2);
                    $doc->exportCaption($this->TT_3);
                    $doc->exportCaption($this->DR_SPA);
                    $doc->exportCaption($this->DR_SPOG);
                    $doc->exportCaption($this->dr_sppd);
                    $doc->exportCaption($this->dr_spb);
                    $doc->exportCaption($this->dr_sprad);
                    $doc->exportCaption($this->dr_sprm);
                    $doc->exportCaption($this->dr_span);
                    $doc->exportCaption($this->dr_spjp);
                    $doc->exportCaption($this->dr_spm);
                    $doc->exportCaption($this->dr_sptht);
                    $doc->exportCaption($this->dr_spkj);
                    $doc->exportCaption($this->dr_um);
                    $doc->exportCaption($this->drg);
                    $doc->exportCaption($this->drg_sp);
                    $doc->exportCaption($this->prwt);
                    $doc->exportCaption($this->bdn);
                    $doc->exportCaption($this->far);
                    $doc->exportCaption($this->tkes);
                    $doc->exportCaption($this->tNONkes);
                    $doc->exportCaption($this->sk_date);
                    $doc->exportCaption($this->KECAMATAN);
                    $doc->exportCaption($this->KELURAHAN);
                    $doc->exportCaption($this->KOTA);
                    $doc->exportCaption($this->SERVERNAME);
                    $doc->exportCaption($this->DBNAMES);
                    $doc->exportCaption($this->DBPARENT);
                    $doc->exportCaption($this->CONSID);
                    $doc->exportCaption($this->CONSECRET);
                    $doc->exportCaption($this->PCAREUN);
                    $doc->exportCaption($this->PCAREPSW);
                    $doc->exportCaption($this->KDAPLIKASI);
                    $doc->exportCaption($this->PCAREDIR);
                    $doc->exportCaption($this->PCAREBASEURL0);
                    $doc->exportCaption($this->PCAREBASEURL1);
                    $doc->exportCaption($this->PCAREBASEURL2);
                    $doc->exportCaption($this->DBUN);
                    $doc->exportCaption($this->DBPSW);
                    $doc->exportCaption($this->PICTUREFILE);
                    $doc->exportCaption($this->PROVINSI);
                } else {
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->ORG_TYPE);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->HIRARKI_ID);
                    $doc->exportCaption($this->NAME_OF_ORG_UNIT);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->CONTACT_ADDRESS);
                    $doc->exportCaption($this->KEC_ID);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->KODE_KOTA);
                    $doc->exportCaption($this->SK);
                    $doc->exportCaption($this->PENETAP_ID);
                    $doc->exportCaption($this->BY_ID);
                    $doc->exportCaption($this->ACCREDITATION);
                    $doc->exportCaption($this->ACCREDIT_STATUS);
                    $doc->exportCaption($this->SK_STATUS);
                    $doc->exportCaption($this->WEBSITE);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->WIN_MENU);
                    $doc->exportCaption($this->LOGOFILE);
                    $doc->exportCaption($this->IP_ADDRESS);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DENAH_FILE);
                    $doc->exportCaption($this->BIDANG_ID);
                    $doc->exportCaption($this->MAIN_PARENT);
                    $doc->exportCaption($this->DIRECT_PARENT);
                    $doc->exportCaption($this->WHOLE_PARENT);
                    $doc->exportCaption($this->HEADER);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->POSTAL_CODE);
                    $doc->exportCaption($this->DISPLAY);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->ISSTATE);
                    $doc->exportCaption($this->REGISTRATION_DATE);
                    $doc->exportCaption($this->LUAS_TANAH);
                    $doc->exportCaption($this->LUAS_BANGUNAN);
                    $doc->exportCaption($this->SK_MASA);
                    $doc->exportCaption($this->ACCREDITATION_DATE);
                    $doc->exportCaption($this->TT_VVIP);
                    $doc->exportCaption($this->TT_VIP);
                    $doc->exportCaption($this->TT_1);
                    $doc->exportCaption($this->TT_2);
                    $doc->exportCaption($this->TT_3);
                    $doc->exportCaption($this->DR_SPA);
                    $doc->exportCaption($this->DR_SPOG);
                    $doc->exportCaption($this->dr_sppd);
                    $doc->exportCaption($this->dr_spb);
                    $doc->exportCaption($this->dr_sprad);
                    $doc->exportCaption($this->dr_sprm);
                    $doc->exportCaption($this->dr_span);
                    $doc->exportCaption($this->dr_spjp);
                    $doc->exportCaption($this->dr_spm);
                    $doc->exportCaption($this->dr_sptht);
                    $doc->exportCaption($this->dr_spkj);
                    $doc->exportCaption($this->dr_um);
                    $doc->exportCaption($this->drg);
                    $doc->exportCaption($this->drg_sp);
                    $doc->exportCaption($this->prwt);
                    $doc->exportCaption($this->bdn);
                    $doc->exportCaption($this->far);
                    $doc->exportCaption($this->tkes);
                    $doc->exportCaption($this->tNONkes);
                    $doc->exportCaption($this->sk_date);
                    $doc->exportCaption($this->KECAMATAN);
                    $doc->exportCaption($this->KELURAHAN);
                    $doc->exportCaption($this->KOTA);
                    $doc->exportCaption($this->SERVERNAME);
                    $doc->exportCaption($this->DBNAMES);
                    $doc->exportCaption($this->DBPARENT);
                    $doc->exportCaption($this->CONSID);
                    $doc->exportCaption($this->CONSECRET);
                    $doc->exportCaption($this->PCAREUN);
                    $doc->exportCaption($this->PCAREPSW);
                    $doc->exportCaption($this->KDAPLIKASI);
                    $doc->exportCaption($this->PCAREDIR);
                    $doc->exportCaption($this->PCAREBASEURL0);
                    $doc->exportCaption($this->PCAREBASEURL1);
                    $doc->exportCaption($this->PCAREBASEURL2);
                    $doc->exportCaption($this->DBUN);
                    $doc->exportCaption($this->DBPSW);
                    $doc->exportCaption($this->PROVINSI);
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
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->ORG_TYPE);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->HIRARKI_ID);
                        $doc->exportField($this->NAME_OF_ORG_UNIT);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->CONTACT_ADDRESS);
                        $doc->exportField($this->KEC_ID);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->KODE_KOTA);
                        $doc->exportField($this->SK);
                        $doc->exportField($this->PENETAP_ID);
                        $doc->exportField($this->BY_ID);
                        $doc->exportField($this->ACCREDITATION);
                        $doc->exportField($this->ACCREDIT_STATUS);
                        $doc->exportField($this->SK_STATUS);
                        $doc->exportField($this->WEBSITE);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->WIN_MENU);
                        $doc->exportField($this->LOGOFILE);
                        $doc->exportField($this->IP_ADDRESS);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DENAH_FILE);
                        $doc->exportField($this->BIDANG_ID);
                        $doc->exportField($this->MAIN_PARENT);
                        $doc->exportField($this->DIRECT_PARENT);
                        $doc->exportField($this->WHOLE_PARENT);
                        $doc->exportField($this->HEADER);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->POSTAL_CODE);
                        $doc->exportField($this->DISPLAY);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->ISSTATE);
                        $doc->exportField($this->REGISTRATION_DATE);
                        $doc->exportField($this->LUAS_TANAH);
                        $doc->exportField($this->LUAS_BANGUNAN);
                        $doc->exportField($this->SK_MASA);
                        $doc->exportField($this->ACCREDITATION_DATE);
                        $doc->exportField($this->TT_VVIP);
                        $doc->exportField($this->TT_VIP);
                        $doc->exportField($this->TT_1);
                        $doc->exportField($this->TT_2);
                        $doc->exportField($this->TT_3);
                        $doc->exportField($this->DR_SPA);
                        $doc->exportField($this->DR_SPOG);
                        $doc->exportField($this->dr_sppd);
                        $doc->exportField($this->dr_spb);
                        $doc->exportField($this->dr_sprad);
                        $doc->exportField($this->dr_sprm);
                        $doc->exportField($this->dr_span);
                        $doc->exportField($this->dr_spjp);
                        $doc->exportField($this->dr_spm);
                        $doc->exportField($this->dr_sptht);
                        $doc->exportField($this->dr_spkj);
                        $doc->exportField($this->dr_um);
                        $doc->exportField($this->drg);
                        $doc->exportField($this->drg_sp);
                        $doc->exportField($this->prwt);
                        $doc->exportField($this->bdn);
                        $doc->exportField($this->far);
                        $doc->exportField($this->tkes);
                        $doc->exportField($this->tNONkes);
                        $doc->exportField($this->sk_date);
                        $doc->exportField($this->KECAMATAN);
                        $doc->exportField($this->KELURAHAN);
                        $doc->exportField($this->KOTA);
                        $doc->exportField($this->SERVERNAME);
                        $doc->exportField($this->DBNAMES);
                        $doc->exportField($this->DBPARENT);
                        $doc->exportField($this->CONSID);
                        $doc->exportField($this->CONSECRET);
                        $doc->exportField($this->PCAREUN);
                        $doc->exportField($this->PCAREPSW);
                        $doc->exportField($this->KDAPLIKASI);
                        $doc->exportField($this->PCAREDIR);
                        $doc->exportField($this->PCAREBASEURL0);
                        $doc->exportField($this->PCAREBASEURL1);
                        $doc->exportField($this->PCAREBASEURL2);
                        $doc->exportField($this->DBUN);
                        $doc->exportField($this->DBPSW);
                        $doc->exportField($this->PICTUREFILE);
                        $doc->exportField($this->PROVINSI);
                    } else {
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->ORG_TYPE);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->HIRARKI_ID);
                        $doc->exportField($this->NAME_OF_ORG_UNIT);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->CONTACT_ADDRESS);
                        $doc->exportField($this->KEC_ID);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->KODE_KOTA);
                        $doc->exportField($this->SK);
                        $doc->exportField($this->PENETAP_ID);
                        $doc->exportField($this->BY_ID);
                        $doc->exportField($this->ACCREDITATION);
                        $doc->exportField($this->ACCREDIT_STATUS);
                        $doc->exportField($this->SK_STATUS);
                        $doc->exportField($this->WEBSITE);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->WIN_MENU);
                        $doc->exportField($this->LOGOFILE);
                        $doc->exportField($this->IP_ADDRESS);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DENAH_FILE);
                        $doc->exportField($this->BIDANG_ID);
                        $doc->exportField($this->MAIN_PARENT);
                        $doc->exportField($this->DIRECT_PARENT);
                        $doc->exportField($this->WHOLE_PARENT);
                        $doc->exportField($this->HEADER);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->POSTAL_CODE);
                        $doc->exportField($this->DISPLAY);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->ISSTATE);
                        $doc->exportField($this->REGISTRATION_DATE);
                        $doc->exportField($this->LUAS_TANAH);
                        $doc->exportField($this->LUAS_BANGUNAN);
                        $doc->exportField($this->SK_MASA);
                        $doc->exportField($this->ACCREDITATION_DATE);
                        $doc->exportField($this->TT_VVIP);
                        $doc->exportField($this->TT_VIP);
                        $doc->exportField($this->TT_1);
                        $doc->exportField($this->TT_2);
                        $doc->exportField($this->TT_3);
                        $doc->exportField($this->DR_SPA);
                        $doc->exportField($this->DR_SPOG);
                        $doc->exportField($this->dr_sppd);
                        $doc->exportField($this->dr_spb);
                        $doc->exportField($this->dr_sprad);
                        $doc->exportField($this->dr_sprm);
                        $doc->exportField($this->dr_span);
                        $doc->exportField($this->dr_spjp);
                        $doc->exportField($this->dr_spm);
                        $doc->exportField($this->dr_sptht);
                        $doc->exportField($this->dr_spkj);
                        $doc->exportField($this->dr_um);
                        $doc->exportField($this->drg);
                        $doc->exportField($this->drg_sp);
                        $doc->exportField($this->prwt);
                        $doc->exportField($this->bdn);
                        $doc->exportField($this->far);
                        $doc->exportField($this->tkes);
                        $doc->exportField($this->tNONkes);
                        $doc->exportField($this->sk_date);
                        $doc->exportField($this->KECAMATAN);
                        $doc->exportField($this->KELURAHAN);
                        $doc->exportField($this->KOTA);
                        $doc->exportField($this->SERVERNAME);
                        $doc->exportField($this->DBNAMES);
                        $doc->exportField($this->DBPARENT);
                        $doc->exportField($this->CONSID);
                        $doc->exportField($this->CONSECRET);
                        $doc->exportField($this->PCAREUN);
                        $doc->exportField($this->PCAREPSW);
                        $doc->exportField($this->KDAPLIKASI);
                        $doc->exportField($this->PCAREDIR);
                        $doc->exportField($this->PCAREBASEURL0);
                        $doc->exportField($this->PCAREBASEURL1);
                        $doc->exportField($this->PCAREBASEURL2);
                        $doc->exportField($this->DBUN);
                        $doc->exportField($this->DBPSW);
                        $doc->exportField($this->PROVINSI);
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
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'PICTUREFILE') {
            $fldName = "PICTUREFILE";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->ORG_UNIT_CODE->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssoc($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, 100, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
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
