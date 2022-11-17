<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for V_PASIENVISITATIONRJ
 */
class VPasienvisitationrj extends DbTable
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
    public $NAME_OF_PASIEN;
    public $NO_REGISTRATION;
    public $ORG_UNIT_CODE;
    public $date_of_birth;
    public $CONTACT_ADDRESS;
    public $PHONE_NUMBER;
    public $MOBILE;
    public $KAL_ID;
    public $PLACE_OF_BIRTH;
    public $KALURAHAN;
    public $clinic_id;
    public $name_of_clinic;
    public $clinic_id_from;
    public $fullname;
    public $employee_id;
    public $employee_id_from;
    public $booked_Date;
    public $visit_date;
    public $visit_id;
    public $isattended;
    public $diantar_oleh;
    public $visitor_address;
    public $address_of_rujukan;
    public $rujukan_id;
    public $DESCRIPTION;
    public $patient_category_id;
    public $payor_id;
    public $reason_id;
    public $STATUS_PASIEN_ID;
    public $way_id;
    public $follow_up;
    public $isnew;
    public $family_status_id;
    public $urutan;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'V_PASIENVISITATIONRJ';
        $this->TableName = 'V_PASIENVISITATIONRJ';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "[dbo].[V_PASIENVISITATIONRJ]";
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

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_NAME_OF_PASIEN', 'NAME_OF_PASIEN', '[NAME_OF_PASIEN]', '[NAME_OF_PASIEN]', 200, 100, -1, false, '[NAME_OF_PASIEN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_OF_PASIEN->Sortable = true; // Allow sort
        $this->NAME_OF_PASIEN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_OF_PASIEN->Param, "CustomMsg");
        $this->Fields['NAME_OF_PASIEN'] = &$this->NAME_OF_PASIEN;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 25, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->IsPrimaryKey = true; // Primary key field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // date_of_birth
        $this->date_of_birth = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_date_of_birth', 'date_of_birth', '[date_of_birth]', CastDateFieldForLike("[date_of_birth]", 0, "DB"), 135, 8, 0, false, '[date_of_birth]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->date_of_birth->Sortable = true; // Allow sort
        $this->date_of_birth->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->date_of_birth->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->date_of_birth->Param, "CustomMsg");
        $this->Fields['date_of_birth'] = &$this->date_of_birth;

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_CONTACT_ADDRESS', 'CONTACT_ADDRESS', '[CONTACT_ADDRESS]', '[CONTACT_ADDRESS]', 200, 100, -1, false, '[CONTACT_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTACT_ADDRESS->Sortable = true; // Allow sort
        $this->CONTACT_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTACT_ADDRESS->Param, "CustomMsg");
        $this->Fields['CONTACT_ADDRESS'] = &$this->CONTACT_ADDRESS;

        // PHONE_NUMBER
        $this->PHONE_NUMBER = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_PHONE_NUMBER', 'PHONE_NUMBER', '[PHONE_NUMBER]', '[PHONE_NUMBER]', 200, 20, -1, false, '[PHONE_NUMBER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE_NUMBER->Sortable = true; // Allow sort
        $this->PHONE_NUMBER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE_NUMBER->Param, "CustomMsg");
        $this->Fields['PHONE_NUMBER'] = &$this->PHONE_NUMBER;

        // MOBILE
        $this->MOBILE = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_MOBILE', 'MOBILE', '[MOBILE]', '[MOBILE]', 200, 20, -1, false, '[MOBILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MOBILE->Sortable = true; // Allow sort
        $this->MOBILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MOBILE->Param, "CustomMsg");
        $this->Fields['MOBILE'] = &$this->MOBILE;

        // KAL_ID
        $this->KAL_ID = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_PLACE_OF_BIRTH', 'PLACE_OF_BIRTH', '[PLACE_OF_BIRTH]', '[PLACE_OF_BIRTH]', 200, 50, -1, false, '[PLACE_OF_BIRTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PLACE_OF_BIRTH->Sortable = true; // Allow sort
        $this->PLACE_OF_BIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PLACE_OF_BIRTH->Param, "CustomMsg");
        $this->Fields['PLACE_OF_BIRTH'] = &$this->PLACE_OF_BIRTH;

        // KALURAHAN
        $this->KALURAHAN = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_KALURAHAN', 'KALURAHAN', '[KALURAHAN]', '[KALURAHAN]', 200, 200, -1, false, '[KALURAHAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KALURAHAN->Sortable = true; // Allow sort
        $this->KALURAHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KALURAHAN->Param, "CustomMsg");
        $this->Fields['KALURAHAN'] = &$this->KALURAHAN;

        // clinic_id
        $this->clinic_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_clinic_id', 'clinic_id', '[clinic_id]', '[clinic_id]', 200, 8, -1, false, '[clinic_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->clinic_id->Sortable = true; // Allow sort
        $this->clinic_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->clinic_id->Param, "CustomMsg");
        $this->Fields['clinic_id'] = &$this->clinic_id;

        // name_of_clinic
        $this->name_of_clinic = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_name_of_clinic', 'name_of_clinic', '[name_of_clinic]', '[name_of_clinic]', 200, 100, -1, false, '[name_of_clinic]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->name_of_clinic->Sortable = true; // Allow sort
        $this->name_of_clinic->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->name_of_clinic->Param, "CustomMsg");
        $this->Fields['name_of_clinic'] = &$this->name_of_clinic;

        // clinic_id_from
        $this->clinic_id_from = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_clinic_id_from', 'clinic_id_from', '[clinic_id_from]', '[clinic_id_from]', 200, 8, -1, false, '[clinic_id_from]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->clinic_id_from->Sortable = true; // Allow sort
        $this->clinic_id_from->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->clinic_id_from->Param, "CustomMsg");
        $this->Fields['clinic_id_from'] = &$this->clinic_id_from;

        // fullname
        $this->fullname = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_fullname', 'fullname', '[fullname]', '[fullname]', 200, 50, -1, false, '[fullname]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->fullname->Sortable = true; // Allow sort
        $this->fullname->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fullname->Param, "CustomMsg");
        $this->Fields['fullname'] = &$this->fullname;

        // employee_id
        $this->employee_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_employee_id', 'employee_id', '[employee_id]', '[employee_id]', 200, 15, -1, false, '[employee_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_id->Sortable = true; // Allow sort
        $this->employee_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_id->Param, "CustomMsg");
        $this->Fields['employee_id'] = &$this->employee_id;

        // employee_id_from
        $this->employee_id_from = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_employee_id_from', 'employee_id_from', '[employee_id_from]', '[employee_id_from]', 200, 50, -1, false, '[employee_id_from]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->employee_id_from->Sortable = true; // Allow sort
        $this->employee_id_from->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->employee_id_from->Param, "CustomMsg");
        $this->Fields['employee_id_from'] = &$this->employee_id_from;

        // booked_Date
        $this->booked_Date = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_booked_Date', 'booked_Date', '[booked_Date]', CastDateFieldForLike("[booked_Date]", 0, "DB"), 135, 8, 0, false, '[booked_Date]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->booked_Date->Sortable = true; // Allow sort
        $this->booked_Date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->booked_Date->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->booked_Date->Param, "CustomMsg");
        $this->Fields['booked_Date'] = &$this->booked_Date;

        // visit_date
        $this->visit_date = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_visit_date', 'visit_date', '[visit_date]', CastDateFieldForLike("[visit_date]", 0, "DB"), 135, 8, 0, false, '[visit_date]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->visit_date->Sortable = true; // Allow sort
        $this->visit_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->visit_date->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->visit_date->Param, "CustomMsg");
        $this->Fields['visit_date'] = &$this->visit_date;

        // visit_id
        $this->visit_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_visit_id', 'visit_id', '[visit_id]', '[visit_id]', 200, 50, -1, false, '[visit_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->visit_id->IsPrimaryKey = true; // Primary key field
        $this->visit_id->Required = true; // Required field
        $this->visit_id->Sortable = true; // Allow sort
        $this->visit_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->visit_id->Param, "CustomMsg");
        $this->Fields['visit_id'] = &$this->visit_id;

        // isattended
        $this->isattended = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_isattended', 'isattended', '[isattended]', '[isattended]', 129, 1, -1, false, '[isattended]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isattended->Sortable = true; // Allow sort
        $this->isattended->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isattended->Param, "CustomMsg");
        $this->Fields['isattended'] = &$this->isattended;

        // diantar_oleh
        $this->diantar_oleh = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_diantar_oleh', 'diantar_oleh', '[diantar_oleh]', '[diantar_oleh]', 200, 255, -1, false, '[diantar_oleh]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->diantar_oleh->Sortable = true; // Allow sort
        $this->diantar_oleh->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->diantar_oleh->Param, "CustomMsg");
        $this->Fields['diantar_oleh'] = &$this->diantar_oleh;

        // visitor_address
        $this->visitor_address = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_visitor_address', 'visitor_address', '[visitor_address]', '[visitor_address]', 200, 150, -1, false, '[visitor_address]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->visitor_address->Sortable = true; // Allow sort
        $this->visitor_address->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->visitor_address->Param, "CustomMsg");
        $this->Fields['visitor_address'] = &$this->visitor_address;

        // address_of_rujukan
        $this->address_of_rujukan = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_address_of_rujukan', 'address_of_rujukan', '[address_of_rujukan]', '[address_of_rujukan]', 200, 100, -1, false, '[address_of_rujukan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->address_of_rujukan->Sortable = true; // Allow sort
        $this->address_of_rujukan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->address_of_rujukan->Param, "CustomMsg");
        $this->Fields['address_of_rujukan'] = &$this->address_of_rujukan;

        // rujukan_id
        $this->rujukan_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_rujukan_id', 'rujukan_id', '[rujukan_id]', 'CAST([rujukan_id] AS NVARCHAR)', 17, 8, -1, false, '[rujukan_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rujukan_id->Sortable = true; // Allow sort
        $this->rujukan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rujukan_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rujukan_id->Param, "CustomMsg");
        $this->Fields['rujukan_id'] = &$this->rujukan_id;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // patient_category_id
        $this->patient_category_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_patient_category_id', 'patient_category_id', '[patient_category_id]', 'CAST([patient_category_id] AS NVARCHAR)', 17, 1, -1, false, '[patient_category_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->patient_category_id->Sortable = true; // Allow sort
        $this->patient_category_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->patient_category_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->patient_category_id->Param, "CustomMsg");
        $this->Fields['patient_category_id'] = &$this->patient_category_id;

        // payor_id
        $this->payor_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_payor_id', 'payor_id', '[payor_id]', '[payor_id]', 200, 50, -1, false, '[payor_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->payor_id->Sortable = true; // Allow sort
        $this->payor_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->payor_id->Param, "CustomMsg");
        $this->Fields['payor_id'] = &$this->payor_id;

        // reason_id
        $this->reason_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_reason_id', 'reason_id', '[reason_id]', 'CAST([reason_id] AS NVARCHAR)', 17, 1, -1, false, '[reason_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->reason_id->Sortable = true; // Allow sort
        $this->reason_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->reason_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->reason_id->Param, "CustomMsg");
        $this->Fields['reason_id'] = &$this->reason_id;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // way_id
        $this->way_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_way_id', 'way_id', '[way_id]', 'CAST([way_id] AS NVARCHAR)', 17, 1, -1, false, '[way_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->way_id->Sortable = true; // Allow sort
        $this->way_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->way_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->way_id->Param, "CustomMsg");
        $this->Fields['way_id'] = &$this->way_id;

        // follow_up
        $this->follow_up = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_follow_up', 'follow_up', '[follow_up]', 'CAST([follow_up] AS NVARCHAR)', 17, 1, -1, false, '[follow_up]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->follow_up->Sortable = true; // Allow sort
        $this->follow_up->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->follow_up->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->follow_up->Param, "CustomMsg");
        $this->Fields['follow_up'] = &$this->follow_up;

        // isnew
        $this->isnew = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_isnew', 'isnew', '[isnew]', '[isnew]', 129, 1, -1, false, '[isnew]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isnew->Sortable = true; // Allow sort
        $this->isnew->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isnew->Param, "CustomMsg");
        $this->Fields['isnew'] = &$this->isnew;

        // family_status_id
        $this->family_status_id = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_family_status_id', 'family_status_id', '[family_status_id]', 'CAST([family_status_id] AS NVARCHAR)', 17, 1, -1, false, '[family_status_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->family_status_id->Sortable = true; // Allow sort
        $this->family_status_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->family_status_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->family_status_id->Param, "CustomMsg");
        $this->Fields['family_status_id'] = &$this->family_status_id;

        // urutan
        $this->urutan = new DbField('V_PASIENVISITATIONRJ', 'V_PASIENVISITATIONRJ', 'x_urutan', 'urutan', '[urutan]', 'CAST([urutan] AS NVARCHAR)', 3, 4, -1, false, '[urutan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->urutan->Nullable = false; // NOT NULL field
        $this->urutan->Required = true; // Required field
        $this->urutan->Sortable = true; // Allow sort
        $this->urutan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->urutan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->urutan->Param, "CustomMsg");
        $this->Fields['urutan'] = &$this->urutan;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[V_PASIENVISITATIONRJ]";
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
            if (array_key_exists('NO_REGISTRATION', $rs)) {
                AddFilter($where, QuotedName('NO_REGISTRATION', $this->Dbid) . '=' . QuotedValue($rs['NO_REGISTRATION'], $this->NO_REGISTRATION->DataType, $this->Dbid));
            }
            if (array_key_exists('ORG_UNIT_CODE', $rs)) {
                AddFilter($where, QuotedName('ORG_UNIT_CODE', $this->Dbid) . '=' . QuotedValue($rs['ORG_UNIT_CODE'], $this->ORG_UNIT_CODE->DataType, $this->Dbid));
            }
            if (array_key_exists('visit_id', $rs)) {
                AddFilter($where, QuotedName('visit_id', $this->Dbid) . '=' . QuotedValue($rs['visit_id'], $this->visit_id->DataType, $this->Dbid));
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
        $this->NAME_OF_PASIEN->DbValue = $row['NAME_OF_PASIEN'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->ORG_UNIT_CODE->DbValue = $row['ORG_UNIT_CODE'];
        $this->date_of_birth->DbValue = $row['date_of_birth'];
        $this->CONTACT_ADDRESS->DbValue = $row['CONTACT_ADDRESS'];
        $this->PHONE_NUMBER->DbValue = $row['PHONE_NUMBER'];
        $this->MOBILE->DbValue = $row['MOBILE'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->PLACE_OF_BIRTH->DbValue = $row['PLACE_OF_BIRTH'];
        $this->KALURAHAN->DbValue = $row['KALURAHAN'];
        $this->clinic_id->DbValue = $row['clinic_id'];
        $this->name_of_clinic->DbValue = $row['name_of_clinic'];
        $this->clinic_id_from->DbValue = $row['clinic_id_from'];
        $this->fullname->DbValue = $row['fullname'];
        $this->employee_id->DbValue = $row['employee_id'];
        $this->employee_id_from->DbValue = $row['employee_id_from'];
        $this->booked_Date->DbValue = $row['booked_Date'];
        $this->visit_date->DbValue = $row['visit_date'];
        $this->visit_id->DbValue = $row['visit_id'];
        $this->isattended->DbValue = $row['isattended'];
        $this->diantar_oleh->DbValue = $row['diantar_oleh'];
        $this->visitor_address->DbValue = $row['visitor_address'];
        $this->address_of_rujukan->DbValue = $row['address_of_rujukan'];
        $this->rujukan_id->DbValue = $row['rujukan_id'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->patient_category_id->DbValue = $row['patient_category_id'];
        $this->payor_id->DbValue = $row['payor_id'];
        $this->reason_id->DbValue = $row['reason_id'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->way_id->DbValue = $row['way_id'];
        $this->follow_up->DbValue = $row['follow_up'];
        $this->isnew->DbValue = $row['isnew'];
        $this->family_status_id->DbValue = $row['family_status_id'];
        $this->urutan->DbValue = $row['urutan'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[NO_REGISTRATION] = '@NO_REGISTRATION@' AND [ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [visit_id] = '@visit_id@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->NO_REGISTRATION->CurrentValue : $this->NO_REGISTRATION->OldValue;
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
        $val = $current ? $this->visit_id->CurrentValue : $this->visit_id->OldValue;
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
                $this->NO_REGISTRATION->CurrentValue = $keys[0];
            } else {
                $this->NO_REGISTRATION->OldValue = $keys[0];
            }
            if ($current) {
                $this->ORG_UNIT_CODE->CurrentValue = $keys[1];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[1];
            }
            if ($current) {
                $this->visit_id->CurrentValue = $keys[2];
            } else {
                $this->visit_id->OldValue = $keys[2];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
            $val = array_key_exists('visit_id', $row) ? $row['visit_id'] : null;
        } else {
            $val = $this->visit_id->OldValue !== null ? $this->visit_id->OldValue : $this->visit_id->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@visit_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("VPasienvisitationrjList");
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
        if ($pageName == "VPasienvisitationrjView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VPasienvisitationrjEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VPasienvisitationrjAdd") {
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
                return "VPasienvisitationrjView";
            case Config("API_ADD_ACTION"):
                return "VPasienvisitationrjAdd";
            case Config("API_EDIT_ACTION"):
                return "VPasienvisitationrjEdit";
            case Config("API_DELETE_ACTION"):
                return "VPasienvisitationrjDelete";
            case Config("API_LIST_ACTION"):
                return "VPasienvisitationrjList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VPasienvisitationrjList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VPasienvisitationrjView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VPasienvisitationrjView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VPasienvisitationrjAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VPasienvisitationrjAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("VPasienvisitationrjEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("VPasienvisitationrjAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("VPasienvisitationrjDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "NO_REGISTRATION:" . JsonEncode($this->NO_REGISTRATION->CurrentValue, "string");
        $json .= ",ORG_UNIT_CODE:" . JsonEncode($this->ORG_UNIT_CODE->CurrentValue, "string");
        $json .= ",visit_id:" . JsonEncode($this->visit_id->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NO_REGISTRATION->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NO_REGISTRATION->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->ORG_UNIT_CODE->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ORG_UNIT_CODE->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->visit_id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->visit_id->CurrentValue);
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
            if (($keyValue = Param("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
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
            if (($keyValue = Param("visit_id") ?? Route("visit_id")) !== null) {
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
                $this->NO_REGISTRATION->CurrentValue = $key[0];
            } else {
                $this->NO_REGISTRATION->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->ORG_UNIT_CODE->CurrentValue = $key[1];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->visit_id->CurrentValue = $key[2];
            } else {
                $this->visit_id->OldValue = $key[2];
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
        $this->NAME_OF_PASIEN->setDbValue($row['NAME_OF_PASIEN']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->date_of_birth->setDbValue($row['date_of_birth']);
        $this->CONTACT_ADDRESS->setDbValue($row['CONTACT_ADDRESS']);
        $this->PHONE_NUMBER->setDbValue($row['PHONE_NUMBER']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->clinic_id->setDbValue($row['clinic_id']);
        $this->name_of_clinic->setDbValue($row['name_of_clinic']);
        $this->clinic_id_from->setDbValue($row['clinic_id_from']);
        $this->fullname->setDbValue($row['fullname']);
        $this->employee_id->setDbValue($row['employee_id']);
        $this->employee_id_from->setDbValue($row['employee_id_from']);
        $this->booked_Date->setDbValue($row['booked_Date']);
        $this->visit_date->setDbValue($row['visit_date']);
        $this->visit_id->setDbValue($row['visit_id']);
        $this->isattended->setDbValue($row['isattended']);
        $this->diantar_oleh->setDbValue($row['diantar_oleh']);
        $this->visitor_address->setDbValue($row['visitor_address']);
        $this->address_of_rujukan->setDbValue($row['address_of_rujukan']);
        $this->rujukan_id->setDbValue($row['rujukan_id']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->patient_category_id->setDbValue($row['patient_category_id']);
        $this->payor_id->setDbValue($row['payor_id']);
        $this->reason_id->setDbValue($row['reason_id']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->way_id->setDbValue($row['way_id']);
        $this->follow_up->setDbValue($row['follow_up']);
        $this->isnew->setDbValue($row['isnew']);
        $this->family_status_id->setDbValue($row['family_status_id']);
        $this->urutan->setDbValue($row['urutan']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NAME_OF_PASIEN

        // NO_REGISTRATION

        // ORG_UNIT_CODE

        // date_of_birth

        // CONTACT_ADDRESS

        // PHONE_NUMBER

        // MOBILE

        // KAL_ID

        // PLACE_OF_BIRTH

        // KALURAHAN

        // clinic_id

        // name_of_clinic

        // clinic_id_from

        // fullname

        // employee_id

        // employee_id_from

        // booked_Date

        // visit_date

        // visit_id

        // isattended

        // diantar_oleh

        // visitor_address

        // address_of_rujukan

        // rujukan_id

        // DESCRIPTION

        // patient_category_id

        // payor_id

        // reason_id

        // STATUS_PASIEN_ID

        // way_id

        // follow_up

        // isnew

        // family_status_id

        // urutan

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->ViewValue = $this->NAME_OF_PASIEN->CurrentValue;
        $this->NAME_OF_PASIEN->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // date_of_birth
        $this->date_of_birth->ViewValue = $this->date_of_birth->CurrentValue;
        $this->date_of_birth->ViewValue = FormatDateTime($this->date_of_birth->ViewValue, 0);
        $this->date_of_birth->ViewCustomAttributes = "";

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->ViewValue = $this->CONTACT_ADDRESS->CurrentValue;
        $this->CONTACT_ADDRESS->ViewCustomAttributes = "";

        // PHONE_NUMBER
        $this->PHONE_NUMBER->ViewValue = $this->PHONE_NUMBER->CurrentValue;
        $this->PHONE_NUMBER->ViewCustomAttributes = "";

        // MOBILE
        $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
        $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

        // KALURAHAN
        $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
        $this->KALURAHAN->ViewCustomAttributes = "";

        // clinic_id
        $this->clinic_id->ViewValue = $this->clinic_id->CurrentValue;
        $this->clinic_id->ViewCustomAttributes = "";

        // name_of_clinic
        $this->name_of_clinic->ViewValue = $this->name_of_clinic->CurrentValue;
        $this->name_of_clinic->ViewCustomAttributes = "";

        // clinic_id_from
        $this->clinic_id_from->ViewValue = $this->clinic_id_from->CurrentValue;
        $this->clinic_id_from->ViewCustomAttributes = "";

        // fullname
        $this->fullname->ViewValue = $this->fullname->CurrentValue;
        $this->fullname->ViewCustomAttributes = "";

        // employee_id
        $this->employee_id->ViewValue = $this->employee_id->CurrentValue;
        $this->employee_id->ViewCustomAttributes = "";

        // employee_id_from
        $this->employee_id_from->ViewValue = $this->employee_id_from->CurrentValue;
        $this->employee_id_from->ViewCustomAttributes = "";

        // booked_Date
        $this->booked_Date->ViewValue = $this->booked_Date->CurrentValue;
        $this->booked_Date->ViewValue = FormatDateTime($this->booked_Date->ViewValue, 0);
        $this->booked_Date->ViewCustomAttributes = "";

        // visit_date
        $this->visit_date->ViewValue = $this->visit_date->CurrentValue;
        $this->visit_date->ViewValue = FormatDateTime($this->visit_date->ViewValue, 0);
        $this->visit_date->ViewCustomAttributes = "";

        // visit_id
        $this->visit_id->ViewValue = $this->visit_id->CurrentValue;
        $this->visit_id->ViewCustomAttributes = "";

        // isattended
        $this->isattended->ViewValue = $this->isattended->CurrentValue;
        $this->isattended->ViewCustomAttributes = "";

        // diantar_oleh
        $this->diantar_oleh->ViewValue = $this->diantar_oleh->CurrentValue;
        $this->diantar_oleh->ViewCustomAttributes = "";

        // visitor_address
        $this->visitor_address->ViewValue = $this->visitor_address->CurrentValue;
        $this->visitor_address->ViewCustomAttributes = "";

        // address_of_rujukan
        $this->address_of_rujukan->ViewValue = $this->address_of_rujukan->CurrentValue;
        $this->address_of_rujukan->ViewCustomAttributes = "";

        // rujukan_id
        $this->rujukan_id->ViewValue = $this->rujukan_id->CurrentValue;
        $this->rujukan_id->ViewValue = FormatNumber($this->rujukan_id->ViewValue, 0, -2, -2, -2);
        $this->rujukan_id->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // patient_category_id
        $this->patient_category_id->ViewValue = $this->patient_category_id->CurrentValue;
        $this->patient_category_id->ViewValue = FormatNumber($this->patient_category_id->ViewValue, 0, -2, -2, -2);
        $this->patient_category_id->ViewCustomAttributes = "";

        // payor_id
        $this->payor_id->ViewValue = $this->payor_id->CurrentValue;
        $this->payor_id->ViewCustomAttributes = "";

        // reason_id
        $this->reason_id->ViewValue = $this->reason_id->CurrentValue;
        $this->reason_id->ViewValue = FormatNumber($this->reason_id->ViewValue, 0, -2, -2, -2);
        $this->reason_id->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // way_id
        $this->way_id->ViewValue = $this->way_id->CurrentValue;
        $this->way_id->ViewValue = FormatNumber($this->way_id->ViewValue, 0, -2, -2, -2);
        $this->way_id->ViewCustomAttributes = "";

        // follow_up
        $this->follow_up->ViewValue = $this->follow_up->CurrentValue;
        $this->follow_up->ViewValue = FormatNumber($this->follow_up->ViewValue, 0, -2, -2, -2);
        $this->follow_up->ViewCustomAttributes = "";

        // isnew
        $this->isnew->ViewValue = $this->isnew->CurrentValue;
        $this->isnew->ViewCustomAttributes = "";

        // family_status_id
        $this->family_status_id->ViewValue = $this->family_status_id->CurrentValue;
        $this->family_status_id->ViewValue = FormatNumber($this->family_status_id->ViewValue, 0, -2, -2, -2);
        $this->family_status_id->ViewCustomAttributes = "";

        // urutan
        $this->urutan->ViewValue = $this->urutan->CurrentValue;
        $this->urutan->ViewValue = FormatNumber($this->urutan->ViewValue, 0, -2, -2, -2);
        $this->urutan->ViewCustomAttributes = "";

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->LinkCustomAttributes = "";
        $this->NAME_OF_PASIEN->HrefValue = "";
        $this->NAME_OF_PASIEN->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // date_of_birth
        $this->date_of_birth->LinkCustomAttributes = "";
        $this->date_of_birth->HrefValue = "";
        $this->date_of_birth->TooltipValue = "";

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

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
        $this->PLACE_OF_BIRTH->HrefValue = "";
        $this->PLACE_OF_BIRTH->TooltipValue = "";

        // KALURAHAN
        $this->KALURAHAN->LinkCustomAttributes = "";
        $this->KALURAHAN->HrefValue = "";
        $this->KALURAHAN->TooltipValue = "";

        // clinic_id
        $this->clinic_id->LinkCustomAttributes = "";
        $this->clinic_id->HrefValue = "";
        $this->clinic_id->TooltipValue = "";

        // name_of_clinic
        $this->name_of_clinic->LinkCustomAttributes = "";
        $this->name_of_clinic->HrefValue = "";
        $this->name_of_clinic->TooltipValue = "";

        // clinic_id_from
        $this->clinic_id_from->LinkCustomAttributes = "";
        $this->clinic_id_from->HrefValue = "";
        $this->clinic_id_from->TooltipValue = "";

        // fullname
        $this->fullname->LinkCustomAttributes = "";
        $this->fullname->HrefValue = "";
        $this->fullname->TooltipValue = "";

        // employee_id
        $this->employee_id->LinkCustomAttributes = "";
        $this->employee_id->HrefValue = "";
        $this->employee_id->TooltipValue = "";

        // employee_id_from
        $this->employee_id_from->LinkCustomAttributes = "";
        $this->employee_id_from->HrefValue = "";
        $this->employee_id_from->TooltipValue = "";

        // booked_Date
        $this->booked_Date->LinkCustomAttributes = "";
        $this->booked_Date->HrefValue = "";
        $this->booked_Date->TooltipValue = "";

        // visit_date
        $this->visit_date->LinkCustomAttributes = "";
        $this->visit_date->HrefValue = "";
        $this->visit_date->TooltipValue = "";

        // visit_id
        $this->visit_id->LinkCustomAttributes = "";
        $this->visit_id->HrefValue = "";
        $this->visit_id->TooltipValue = "";

        // isattended
        $this->isattended->LinkCustomAttributes = "";
        $this->isattended->HrefValue = "";
        $this->isattended->TooltipValue = "";

        // diantar_oleh
        $this->diantar_oleh->LinkCustomAttributes = "";
        $this->diantar_oleh->HrefValue = "";
        $this->diantar_oleh->TooltipValue = "";

        // visitor_address
        $this->visitor_address->LinkCustomAttributes = "";
        $this->visitor_address->HrefValue = "";
        $this->visitor_address->TooltipValue = "";

        // address_of_rujukan
        $this->address_of_rujukan->LinkCustomAttributes = "";
        $this->address_of_rujukan->HrefValue = "";
        $this->address_of_rujukan->TooltipValue = "";

        // rujukan_id
        $this->rujukan_id->LinkCustomAttributes = "";
        $this->rujukan_id->HrefValue = "";
        $this->rujukan_id->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // patient_category_id
        $this->patient_category_id->LinkCustomAttributes = "";
        $this->patient_category_id->HrefValue = "";
        $this->patient_category_id->TooltipValue = "";

        // payor_id
        $this->payor_id->LinkCustomAttributes = "";
        $this->payor_id->HrefValue = "";
        $this->payor_id->TooltipValue = "";

        // reason_id
        $this->reason_id->LinkCustomAttributes = "";
        $this->reason_id->HrefValue = "";
        $this->reason_id->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // way_id
        $this->way_id->LinkCustomAttributes = "";
        $this->way_id->HrefValue = "";
        $this->way_id->TooltipValue = "";

        // follow_up
        $this->follow_up->LinkCustomAttributes = "";
        $this->follow_up->HrefValue = "";
        $this->follow_up->TooltipValue = "";

        // isnew
        $this->isnew->LinkCustomAttributes = "";
        $this->isnew->HrefValue = "";
        $this->isnew->TooltipValue = "";

        // family_status_id
        $this->family_status_id->LinkCustomAttributes = "";
        $this->family_status_id->HrefValue = "";
        $this->family_status_id->TooltipValue = "";

        // urutan
        $this->urutan->LinkCustomAttributes = "";
        $this->urutan->HrefValue = "";
        $this->urutan->TooltipValue = "";

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

        // NAME_OF_PASIEN
        $this->NAME_OF_PASIEN->EditAttrs["class"] = "form-control";
        $this->NAME_OF_PASIEN->EditCustomAttributes = "";
        if (!$this->NAME_OF_PASIEN->Raw) {
            $this->NAME_OF_PASIEN->CurrentValue = HtmlDecode($this->NAME_OF_PASIEN->CurrentValue);
        }
        $this->NAME_OF_PASIEN->EditValue = $this->NAME_OF_PASIEN->CurrentValue;
        $this->NAME_OF_PASIEN->PlaceHolder = RemoveHtml($this->NAME_OF_PASIEN->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // ORG_UNIT_CODE

        // date_of_birth
        $this->date_of_birth->EditAttrs["class"] = "form-control";
        $this->date_of_birth->EditCustomAttributes = "";
        $this->date_of_birth->EditValue = FormatDateTime($this->date_of_birth->CurrentValue, 8);
        $this->date_of_birth->PlaceHolder = RemoveHtml($this->date_of_birth->caption());

        // CONTACT_ADDRESS
        $this->CONTACT_ADDRESS->EditAttrs["class"] = "form-control";
        $this->CONTACT_ADDRESS->EditCustomAttributes = "";
        if (!$this->CONTACT_ADDRESS->Raw) {
            $this->CONTACT_ADDRESS->CurrentValue = HtmlDecode($this->CONTACT_ADDRESS->CurrentValue);
        }
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

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->EditAttrs["class"] = "form-control";
        $this->PLACE_OF_BIRTH->EditCustomAttributes = "";
        if (!$this->PLACE_OF_BIRTH->Raw) {
            $this->PLACE_OF_BIRTH->CurrentValue = HtmlDecode($this->PLACE_OF_BIRTH->CurrentValue);
        }
        $this->PLACE_OF_BIRTH->EditValue = $this->PLACE_OF_BIRTH->CurrentValue;
        $this->PLACE_OF_BIRTH->PlaceHolder = RemoveHtml($this->PLACE_OF_BIRTH->caption());

        // KALURAHAN
        $this->KALURAHAN->EditAttrs["class"] = "form-control";
        $this->KALURAHAN->EditCustomAttributes = "";
        if (!$this->KALURAHAN->Raw) {
            $this->KALURAHAN->CurrentValue = HtmlDecode($this->KALURAHAN->CurrentValue);
        }
        $this->KALURAHAN->EditValue = $this->KALURAHAN->CurrentValue;
        $this->KALURAHAN->PlaceHolder = RemoveHtml($this->KALURAHAN->caption());

        // clinic_id
        $this->clinic_id->EditAttrs["class"] = "form-control";
        $this->clinic_id->EditCustomAttributes = "";
        if (!$this->clinic_id->Raw) {
            $this->clinic_id->CurrentValue = HtmlDecode($this->clinic_id->CurrentValue);
        }
        $this->clinic_id->EditValue = $this->clinic_id->CurrentValue;
        $this->clinic_id->PlaceHolder = RemoveHtml($this->clinic_id->caption());

        // name_of_clinic
        $this->name_of_clinic->EditAttrs["class"] = "form-control";
        $this->name_of_clinic->EditCustomAttributes = "";
        if (!$this->name_of_clinic->Raw) {
            $this->name_of_clinic->CurrentValue = HtmlDecode($this->name_of_clinic->CurrentValue);
        }
        $this->name_of_clinic->EditValue = $this->name_of_clinic->CurrentValue;
        $this->name_of_clinic->PlaceHolder = RemoveHtml($this->name_of_clinic->caption());

        // clinic_id_from
        $this->clinic_id_from->EditAttrs["class"] = "form-control";
        $this->clinic_id_from->EditCustomAttributes = "";
        if (!$this->clinic_id_from->Raw) {
            $this->clinic_id_from->CurrentValue = HtmlDecode($this->clinic_id_from->CurrentValue);
        }
        $this->clinic_id_from->EditValue = $this->clinic_id_from->CurrentValue;
        $this->clinic_id_from->PlaceHolder = RemoveHtml($this->clinic_id_from->caption());

        // fullname
        $this->fullname->EditAttrs["class"] = "form-control";
        $this->fullname->EditCustomAttributes = "";
        if (!$this->fullname->Raw) {
            $this->fullname->CurrentValue = HtmlDecode($this->fullname->CurrentValue);
        }
        $this->fullname->EditValue = $this->fullname->CurrentValue;
        $this->fullname->PlaceHolder = RemoveHtml($this->fullname->caption());

        // employee_id
        $this->employee_id->EditAttrs["class"] = "form-control";
        $this->employee_id->EditCustomAttributes = "";
        if (!$this->employee_id->Raw) {
            $this->employee_id->CurrentValue = HtmlDecode($this->employee_id->CurrentValue);
        }
        $this->employee_id->EditValue = $this->employee_id->CurrentValue;
        $this->employee_id->PlaceHolder = RemoveHtml($this->employee_id->caption());

        // employee_id_from
        $this->employee_id_from->EditAttrs["class"] = "form-control";
        $this->employee_id_from->EditCustomAttributes = "";
        if (!$this->employee_id_from->Raw) {
            $this->employee_id_from->CurrentValue = HtmlDecode($this->employee_id_from->CurrentValue);
        }
        $this->employee_id_from->EditValue = $this->employee_id_from->CurrentValue;
        $this->employee_id_from->PlaceHolder = RemoveHtml($this->employee_id_from->caption());

        // booked_Date
        $this->booked_Date->EditAttrs["class"] = "form-control";
        $this->booked_Date->EditCustomAttributes = "";
        $this->booked_Date->EditValue = FormatDateTime($this->booked_Date->CurrentValue, 8);
        $this->booked_Date->PlaceHolder = RemoveHtml($this->booked_Date->caption());

        // visit_date
        $this->visit_date->EditAttrs["class"] = "form-control";
        $this->visit_date->EditCustomAttributes = "";
        $this->visit_date->EditValue = FormatDateTime($this->visit_date->CurrentValue, 8);
        $this->visit_date->PlaceHolder = RemoveHtml($this->visit_date->caption());

        // visit_id
        $this->visit_id->EditAttrs["class"] = "form-control";
        $this->visit_id->EditCustomAttributes = "";
        if (!$this->visit_id->Raw) {
            $this->visit_id->CurrentValue = HtmlDecode($this->visit_id->CurrentValue);
        }
        $this->visit_id->EditValue = $this->visit_id->CurrentValue;
        $this->visit_id->PlaceHolder = RemoveHtml($this->visit_id->caption());

        // isattended
        $this->isattended->EditAttrs["class"] = "form-control";
        $this->isattended->EditCustomAttributes = "";
        if (!$this->isattended->Raw) {
            $this->isattended->CurrentValue = HtmlDecode($this->isattended->CurrentValue);
        }
        $this->isattended->EditValue = $this->isattended->CurrentValue;
        $this->isattended->PlaceHolder = RemoveHtml($this->isattended->caption());

        // diantar_oleh
        $this->diantar_oleh->EditAttrs["class"] = "form-control";
        $this->diantar_oleh->EditCustomAttributes = "";
        if (!$this->diantar_oleh->Raw) {
            $this->diantar_oleh->CurrentValue = HtmlDecode($this->diantar_oleh->CurrentValue);
        }
        $this->diantar_oleh->EditValue = $this->diantar_oleh->CurrentValue;
        $this->diantar_oleh->PlaceHolder = RemoveHtml($this->diantar_oleh->caption());

        // visitor_address
        $this->visitor_address->EditAttrs["class"] = "form-control";
        $this->visitor_address->EditCustomAttributes = "";
        if (!$this->visitor_address->Raw) {
            $this->visitor_address->CurrentValue = HtmlDecode($this->visitor_address->CurrentValue);
        }
        $this->visitor_address->EditValue = $this->visitor_address->CurrentValue;
        $this->visitor_address->PlaceHolder = RemoveHtml($this->visitor_address->caption());

        // address_of_rujukan
        $this->address_of_rujukan->EditAttrs["class"] = "form-control";
        $this->address_of_rujukan->EditCustomAttributes = "";
        if (!$this->address_of_rujukan->Raw) {
            $this->address_of_rujukan->CurrentValue = HtmlDecode($this->address_of_rujukan->CurrentValue);
        }
        $this->address_of_rujukan->EditValue = $this->address_of_rujukan->CurrentValue;
        $this->address_of_rujukan->PlaceHolder = RemoveHtml($this->address_of_rujukan->caption());

        // rujukan_id
        $this->rujukan_id->EditAttrs["class"] = "form-control";
        $this->rujukan_id->EditCustomAttributes = "";
        $this->rujukan_id->EditValue = $this->rujukan_id->CurrentValue;
        $this->rujukan_id->PlaceHolder = RemoveHtml($this->rujukan_id->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // patient_category_id
        $this->patient_category_id->EditAttrs["class"] = "form-control";
        $this->patient_category_id->EditCustomAttributes = "";
        $this->patient_category_id->EditValue = $this->patient_category_id->CurrentValue;
        $this->patient_category_id->PlaceHolder = RemoveHtml($this->patient_category_id->caption());

        // payor_id
        $this->payor_id->EditAttrs["class"] = "form-control";
        $this->payor_id->EditCustomAttributes = "";
        if (!$this->payor_id->Raw) {
            $this->payor_id->CurrentValue = HtmlDecode($this->payor_id->CurrentValue);
        }
        $this->payor_id->EditValue = $this->payor_id->CurrentValue;
        $this->payor_id->PlaceHolder = RemoveHtml($this->payor_id->caption());

        // reason_id
        $this->reason_id->EditAttrs["class"] = "form-control";
        $this->reason_id->EditCustomAttributes = "";
        $this->reason_id->EditValue = $this->reason_id->CurrentValue;
        $this->reason_id->PlaceHolder = RemoveHtml($this->reason_id->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // way_id
        $this->way_id->EditAttrs["class"] = "form-control";
        $this->way_id->EditCustomAttributes = "";
        $this->way_id->EditValue = $this->way_id->CurrentValue;
        $this->way_id->PlaceHolder = RemoveHtml($this->way_id->caption());

        // follow_up
        $this->follow_up->EditAttrs["class"] = "form-control";
        $this->follow_up->EditCustomAttributes = "";
        $this->follow_up->EditValue = $this->follow_up->CurrentValue;
        $this->follow_up->PlaceHolder = RemoveHtml($this->follow_up->caption());

        // isnew
        $this->isnew->EditAttrs["class"] = "form-control";
        $this->isnew->EditCustomAttributes = "";
        if (!$this->isnew->Raw) {
            $this->isnew->CurrentValue = HtmlDecode($this->isnew->CurrentValue);
        }
        $this->isnew->EditValue = $this->isnew->CurrentValue;
        $this->isnew->PlaceHolder = RemoveHtml($this->isnew->caption());

        // family_status_id
        $this->family_status_id->EditAttrs["class"] = "form-control";
        $this->family_status_id->EditCustomAttributes = "";
        $this->family_status_id->EditValue = $this->family_status_id->CurrentValue;
        $this->family_status_id->PlaceHolder = RemoveHtml($this->family_status_id->caption());

        // urutan
        $this->urutan->EditAttrs["class"] = "form-control";
        $this->urutan->EditCustomAttributes = "";
        $this->urutan->EditValue = $this->urutan->CurrentValue;
        $this->urutan->PlaceHolder = RemoveHtml($this->urutan->caption());

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
                    $doc->exportCaption($this->NAME_OF_PASIEN);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->date_of_birth);
                    $doc->exportCaption($this->CONTACT_ADDRESS);
                    $doc->exportCaption($this->PHONE_NUMBER);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->PLACE_OF_BIRTH);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->clinic_id);
                    $doc->exportCaption($this->name_of_clinic);
                    $doc->exportCaption($this->clinic_id_from);
                    $doc->exportCaption($this->fullname);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->employee_id_from);
                    $doc->exportCaption($this->booked_Date);
                    $doc->exportCaption($this->visit_date);
                    $doc->exportCaption($this->visit_id);
                    $doc->exportCaption($this->isattended);
                    $doc->exportCaption($this->diantar_oleh);
                    $doc->exportCaption($this->visitor_address);
                    $doc->exportCaption($this->address_of_rujukan);
                    $doc->exportCaption($this->rujukan_id);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->patient_category_id);
                    $doc->exportCaption($this->payor_id);
                    $doc->exportCaption($this->reason_id);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->way_id);
                    $doc->exportCaption($this->follow_up);
                    $doc->exportCaption($this->isnew);
                    $doc->exportCaption($this->family_status_id);
                    $doc->exportCaption($this->urutan);
                } else {
                    $doc->exportCaption($this->NAME_OF_PASIEN);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->date_of_birth);
                    $doc->exportCaption($this->CONTACT_ADDRESS);
                    $doc->exportCaption($this->PHONE_NUMBER);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->PLACE_OF_BIRTH);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->clinic_id);
                    $doc->exportCaption($this->name_of_clinic);
                    $doc->exportCaption($this->clinic_id_from);
                    $doc->exportCaption($this->fullname);
                    $doc->exportCaption($this->employee_id);
                    $doc->exportCaption($this->employee_id_from);
                    $doc->exportCaption($this->booked_Date);
                    $doc->exportCaption($this->visit_date);
                    $doc->exportCaption($this->visit_id);
                    $doc->exportCaption($this->isattended);
                    $doc->exportCaption($this->diantar_oleh);
                    $doc->exportCaption($this->visitor_address);
                    $doc->exportCaption($this->address_of_rujukan);
                    $doc->exportCaption($this->rujukan_id);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->patient_category_id);
                    $doc->exportCaption($this->payor_id);
                    $doc->exportCaption($this->reason_id);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->way_id);
                    $doc->exportCaption($this->follow_up);
                    $doc->exportCaption($this->isnew);
                    $doc->exportCaption($this->family_status_id);
                    $doc->exportCaption($this->urutan);
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
                        $doc->exportField($this->NAME_OF_PASIEN);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->date_of_birth);
                        $doc->exportField($this->CONTACT_ADDRESS);
                        $doc->exportField($this->PHONE_NUMBER);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->PLACE_OF_BIRTH);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->clinic_id);
                        $doc->exportField($this->name_of_clinic);
                        $doc->exportField($this->clinic_id_from);
                        $doc->exportField($this->fullname);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->employee_id_from);
                        $doc->exportField($this->booked_Date);
                        $doc->exportField($this->visit_date);
                        $doc->exportField($this->visit_id);
                        $doc->exportField($this->isattended);
                        $doc->exportField($this->diantar_oleh);
                        $doc->exportField($this->visitor_address);
                        $doc->exportField($this->address_of_rujukan);
                        $doc->exportField($this->rujukan_id);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->patient_category_id);
                        $doc->exportField($this->payor_id);
                        $doc->exportField($this->reason_id);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->way_id);
                        $doc->exportField($this->follow_up);
                        $doc->exportField($this->isnew);
                        $doc->exportField($this->family_status_id);
                        $doc->exportField($this->urutan);
                    } else {
                        $doc->exportField($this->NAME_OF_PASIEN);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->date_of_birth);
                        $doc->exportField($this->CONTACT_ADDRESS);
                        $doc->exportField($this->PHONE_NUMBER);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->PLACE_OF_BIRTH);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->clinic_id);
                        $doc->exportField($this->name_of_clinic);
                        $doc->exportField($this->clinic_id_from);
                        $doc->exportField($this->fullname);
                        $doc->exportField($this->employee_id);
                        $doc->exportField($this->employee_id_from);
                        $doc->exportField($this->booked_Date);
                        $doc->exportField($this->visit_date);
                        $doc->exportField($this->visit_id);
                        $doc->exportField($this->isattended);
                        $doc->exportField($this->diantar_oleh);
                        $doc->exportField($this->visitor_address);
                        $doc->exportField($this->address_of_rujukan);
                        $doc->exportField($this->rujukan_id);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->patient_category_id);
                        $doc->exportField($this->payor_id);
                        $doc->exportField($this->reason_id);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->way_id);
                        $doc->exportField($this->follow_up);
                        $doc->exportField($this->isnew);
                        $doc->exportField($this->family_status_id);
                        $doc->exportField($this->urutan);
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
