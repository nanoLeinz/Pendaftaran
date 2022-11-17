<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for OBSTETRI
 */
class Obstetri extends DbTable
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
    public $OBSTETRI_ID;
    public $HPHT;
    public $HTP;
    public $PASIEN_DIAGNOSA_ID;
    public $DIAGNOSA_ID;
    public $NO_REGISTRATION;
    public $KOHORT_NB;
    public $BIRTH_NB;
    public $BIRTH_DURATION;
    public $BIRTH_PLACE;
    public $ANTE_NATAL;
    public $EMPLOYEE_ID;
    public $CLINIC_ID;
    public $BIRTH_WAY;
    public $BIRTH_BY;
    public $BIRTH_DATE;
    public $GESTASI;
    public $PARITY;
    public $NB_BABY;
    public $BABY_DIE;
    public $ABORTUS_KE;
    public $ABORTUS_ID;
    public $ABORTION_DATE;
    public $BIRTH_CAT;
    public $BIRTH_CON;
    public $BIRTH_RISK;
    public $RISK_TYPE;
    public $FOLLOW_UP;
    public $DIRUJUK_OLEH;
    public $INSPECTION_DATE;
    public $PORSIO;
    public $PEMBUKAAN;
    public $KETUBAN;
    public $PRESENTASI;
    public $POSISI;
    public $PENURUNAN;
    public $HEART_ID;
    public $JANIN_ID;
    public $FREK_DJJ;
    public $PLACENTA;
    public $LOCHIA;
    public $BAB_TYPE;
    public $BAB_BAB_TYPE;
    public $RAHIM_ID;
    public $BIR_RAHIM_ID;
    public $VISIT_ID;
    public $BLOODING;
    public $DESCRIPTION;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $RAHIM_SALIN;
    public $RAHIM_NIFAS;
    public $BAK_TYPE;
    public $THENAME;
    public $THEADDRESS;
    public $THEID;
    public $STATUS_PASIEN_ID;
    public $ISRJ;
    public $AGEYEAR;
    public $AGEMONTH;
    public $AGEDAY;
    public $GENDER;
    public $CLASS_ROOM_ID;
    public $BED_ID;
    public $KELUAR_ID;
    public $DOCTOR;
    public $NB_OBSTETRI;
    public $OBSTETRI_DIE;
    public $KAL_ID;
    public $DIAGNOSA_ID2;
    public $APGAR_ID;
    public $BIRTH_LAST_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'OBSTETRI';
        $this->TableName = 'OBSTETRI';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[OBSTETRI]";
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
        $this->ORG_UNIT_CODE = new DbField('OBSTETRI', 'OBSTETRI', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // OBSTETRI_ID
        $this->OBSTETRI_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_OBSTETRI_ID', 'OBSTETRI_ID', '[OBSTETRI_ID]', '[OBSTETRI_ID]', 200, 50, -1, false, '[OBSTETRI_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBSTETRI_ID->IsPrimaryKey = true; // Primary key field
        $this->OBSTETRI_ID->Nullable = false; // NOT NULL field
        $this->OBSTETRI_ID->Required = true; // Required field
        $this->OBSTETRI_ID->Sortable = true; // Allow sort
        $this->OBSTETRI_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBSTETRI_ID->Param, "CustomMsg");
        $this->Fields['OBSTETRI_ID'] = &$this->OBSTETRI_ID;

        // HPHT
        $this->HPHT = new DbField('OBSTETRI', 'OBSTETRI', 'x_HPHT', 'HPHT', '[HPHT]', CastDateFieldForLike("[HPHT]", 0, "DB"), 135, 8, 0, false, '[HPHT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HPHT->Sortable = true; // Allow sort
        $this->HPHT->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->HPHT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HPHT->Param, "CustomMsg");
        $this->Fields['HPHT'] = &$this->HPHT;

        // HTP
        $this->HTP = new DbField('OBSTETRI', 'OBSTETRI', 'x_HTP', 'HTP', '[HTP]', CastDateFieldForLike("[HTP]", 0, "DB"), 135, 8, 0, false, '[HTP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HTP->Sortable = true; // Allow sort
        $this->HTP->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->HTP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HTP->Param, "CustomMsg");
        $this->Fields['HTP'] = &$this->HTP;

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_PASIEN_DIAGNOSA_ID', 'PASIEN_DIAGNOSA_ID', '[PASIEN_DIAGNOSA_ID]', '[PASIEN_DIAGNOSA_ID]', 200, 50, -1, false, '[PASIEN_DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->PASIEN_DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['PASIEN_DIAGNOSA_ID'] = &$this->PASIEN_DIAGNOSA_ID;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 50, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('OBSTETRI', 'OBSTETRI', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // KOHORT_NB
        $this->KOHORT_NB = new DbField('OBSTETRI', 'OBSTETRI', 'x_KOHORT_NB', 'KOHORT_NB', '[KOHORT_NB]', '[KOHORT_NB]', 200, 25, -1, false, '[KOHORT_NB]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KOHORT_NB->Sortable = true; // Allow sort
        $this->KOHORT_NB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KOHORT_NB->Param, "CustomMsg");
        $this->Fields['KOHORT_NB'] = &$this->KOHORT_NB;

        // BIRTH_NB
        $this->BIRTH_NB = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_NB', 'BIRTH_NB', '[BIRTH_NB]', 'CAST([BIRTH_NB] AS NVARCHAR)', 17, 1, -1, false, '[BIRTH_NB]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_NB->Sortable = true; // Allow sort
        $this->BIRTH_NB->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BIRTH_NB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_NB->Param, "CustomMsg");
        $this->Fields['BIRTH_NB'] = &$this->BIRTH_NB;

        // BIRTH_DURATION
        $this->BIRTH_DURATION = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_DURATION', 'BIRTH_DURATION', '[BIRTH_DURATION]', 'CAST([BIRTH_DURATION] AS NVARCHAR)', 17, 1, -1, false, '[BIRTH_DURATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_DURATION->Sortable = true; // Allow sort
        $this->BIRTH_DURATION->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BIRTH_DURATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_DURATION->Param, "CustomMsg");
        $this->Fields['BIRTH_DURATION'] = &$this->BIRTH_DURATION;

        // BIRTH_PLACE
        $this->BIRTH_PLACE = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_PLACE', 'BIRTH_PLACE', '[BIRTH_PLACE]', 'CAST([BIRTH_PLACE] AS NVARCHAR)', 17, 1, -1, false, '[BIRTH_PLACE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_PLACE->Sortable = true; // Allow sort
        $this->BIRTH_PLACE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BIRTH_PLACE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_PLACE->Param, "CustomMsg");
        $this->Fields['BIRTH_PLACE'] = &$this->BIRTH_PLACE;

        // ANTE_NATAL
        $this->ANTE_NATAL = new DbField('OBSTETRI', 'OBSTETRI', 'x_ANTE_NATAL', 'ANTE_NATAL', '[ANTE_NATAL]', 'CAST([ANTE_NATAL] AS NVARCHAR)', 17, 1, -1, false, '[ANTE_NATAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ANTE_NATAL->Sortable = true; // Allow sort
        $this->ANTE_NATAL->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ANTE_NATAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ANTE_NATAL->Param, "CustomMsg");
        $this->Fields['ANTE_NATAL'] = &$this->ANTE_NATAL;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 50, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 50, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // BIRTH_WAY
        $this->BIRTH_WAY = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_WAY', 'BIRTH_WAY', '[BIRTH_WAY]', '[BIRTH_WAY]', 200, 50, -1, false, '[BIRTH_WAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_WAY->Sortable = true; // Allow sort
        $this->BIRTH_WAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_WAY->Param, "CustomMsg");
        $this->Fields['BIRTH_WAY'] = &$this->BIRTH_WAY;

        // BIRTH_BY
        $this->BIRTH_BY = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_BY', 'BIRTH_BY', '[BIRTH_BY]', 'CAST([BIRTH_BY] AS NVARCHAR)', 17, 1, -1, false, '[BIRTH_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_BY->Sortable = true; // Allow sort
        $this->BIRTH_BY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BIRTH_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_BY->Param, "CustomMsg");
        $this->Fields['BIRTH_BY'] = &$this->BIRTH_BY;

        // BIRTH_DATE
        $this->BIRTH_DATE = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_DATE', 'BIRTH_DATE', '[BIRTH_DATE]', CastDateFieldForLike("[BIRTH_DATE]", 0, "DB"), 135, 8, 0, false, '[BIRTH_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_DATE->Sortable = true; // Allow sort
        $this->BIRTH_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->BIRTH_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_DATE->Param, "CustomMsg");
        $this->Fields['BIRTH_DATE'] = &$this->BIRTH_DATE;

        // GESTASI
        $this->GESTASI = new DbField('OBSTETRI', 'OBSTETRI', 'x_GESTASI', 'GESTASI', '[GESTASI]', 'CAST([GESTASI] AS NVARCHAR)', 17, 1, -1, false, '[GESTASI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GESTASI->Sortable = true; // Allow sort
        $this->GESTASI->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->GESTASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GESTASI->Param, "CustomMsg");
        $this->Fields['GESTASI'] = &$this->GESTASI;

        // PARITY
        $this->PARITY = new DbField('OBSTETRI', 'OBSTETRI', 'x_PARITY', 'PARITY', '[PARITY]', 'CAST([PARITY] AS NVARCHAR)', 17, 1, -1, false, '[PARITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PARITY->Sortable = true; // Allow sort
        $this->PARITY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PARITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PARITY->Param, "CustomMsg");
        $this->Fields['PARITY'] = &$this->PARITY;

        // NB_BABY
        $this->NB_BABY = new DbField('OBSTETRI', 'OBSTETRI', 'x_NB_BABY', 'NB_BABY', '[NB_BABY]', 'CAST([NB_BABY] AS NVARCHAR)', 17, 1, -1, false, '[NB_BABY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NB_BABY->Sortable = true; // Allow sort
        $this->NB_BABY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NB_BABY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NB_BABY->Param, "CustomMsg");
        $this->Fields['NB_BABY'] = &$this->NB_BABY;

        // BABY_DIE
        $this->BABY_DIE = new DbField('OBSTETRI', 'OBSTETRI', 'x_BABY_DIE', 'BABY_DIE', '[BABY_DIE]', 'CAST([BABY_DIE] AS NVARCHAR)', 17, 1, -1, false, '[BABY_DIE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BABY_DIE->Sortable = true; // Allow sort
        $this->BABY_DIE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BABY_DIE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BABY_DIE->Param, "CustomMsg");
        $this->Fields['BABY_DIE'] = &$this->BABY_DIE;

        // ABORTUS_KE
        $this->ABORTUS_KE = new DbField('OBSTETRI', 'OBSTETRI', 'x_ABORTUS_KE', 'ABORTUS_KE', '[ABORTUS_KE]', 'CAST([ABORTUS_KE] AS NVARCHAR)', 17, 1, -1, false, '[ABORTUS_KE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ABORTUS_KE->Sortable = true; // Allow sort
        $this->ABORTUS_KE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ABORTUS_KE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ABORTUS_KE->Param, "CustomMsg");
        $this->Fields['ABORTUS_KE'] = &$this->ABORTUS_KE;

        // ABORTUS_ID
        $this->ABORTUS_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_ABORTUS_ID', 'ABORTUS_ID', '[ABORTUS_ID]', '[ABORTUS_ID]', 200, 10, -1, false, '[ABORTUS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ABORTUS_ID->Sortable = true; // Allow sort
        $this->ABORTUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ABORTUS_ID->Param, "CustomMsg");
        $this->Fields['ABORTUS_ID'] = &$this->ABORTUS_ID;

        // ABORTION_DATE
        $this->ABORTION_DATE = new DbField('OBSTETRI', 'OBSTETRI', 'x_ABORTION_DATE', 'ABORTION_DATE', '[ABORTION_DATE]', CastDateFieldForLike("[ABORTION_DATE]", 0, "DB"), 135, 8, 0, false, '[ABORTION_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ABORTION_DATE->Sortable = true; // Allow sort
        $this->ABORTION_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->ABORTION_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ABORTION_DATE->Param, "CustomMsg");
        $this->Fields['ABORTION_DATE'] = &$this->ABORTION_DATE;

        // BIRTH_CAT
        $this->BIRTH_CAT = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_CAT', 'BIRTH_CAT', '[BIRTH_CAT]', '[BIRTH_CAT]', 200, 50, -1, false, '[BIRTH_CAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_CAT->Sortable = true; // Allow sort
        $this->BIRTH_CAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_CAT->Param, "CustomMsg");
        $this->Fields['BIRTH_CAT'] = &$this->BIRTH_CAT;

        // BIRTH_CON
        $this->BIRTH_CON = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_CON', 'BIRTH_CON', '[BIRTH_CON]', 'CAST([BIRTH_CON] AS NVARCHAR)', 17, 1, -1, false, '[BIRTH_CON]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_CON->Sortable = true; // Allow sort
        $this->BIRTH_CON->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BIRTH_CON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_CON->Param, "CustomMsg");
        $this->Fields['BIRTH_CON'] = &$this->BIRTH_CON;

        // BIRTH_RISK
        $this->BIRTH_RISK = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_RISK', 'BIRTH_RISK', '[BIRTH_RISK]', 'CAST([BIRTH_RISK] AS NVARCHAR)', 17, 1, -1, false, '[BIRTH_RISK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_RISK->Sortable = true; // Allow sort
        $this->BIRTH_RISK->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BIRTH_RISK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_RISK->Param, "CustomMsg");
        $this->Fields['BIRTH_RISK'] = &$this->BIRTH_RISK;

        // RISK_TYPE
        $this->RISK_TYPE = new DbField('OBSTETRI', 'OBSTETRI', 'x_RISK_TYPE', 'RISK_TYPE', '[RISK_TYPE]', 'CAST([RISK_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[RISK_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RISK_TYPE->Sortable = true; // Allow sort
        $this->RISK_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RISK_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RISK_TYPE->Param, "CustomMsg");
        $this->Fields['RISK_TYPE'] = &$this->RISK_TYPE;

        // FOLLOW_UP
        $this->FOLLOW_UP = new DbField('OBSTETRI', 'OBSTETRI', 'x_FOLLOW_UP', 'FOLLOW_UP', '[FOLLOW_UP]', 'CAST([FOLLOW_UP] AS NVARCHAR)', 17, 1, -1, false, '[FOLLOW_UP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FOLLOW_UP->Sortable = true; // Allow sort
        $this->FOLLOW_UP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FOLLOW_UP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FOLLOW_UP->Param, "CustomMsg");
        $this->Fields['FOLLOW_UP'] = &$this->FOLLOW_UP;

        // DIRUJUK_OLEH
        $this->DIRUJUK_OLEH = new DbField('OBSTETRI', 'OBSTETRI', 'x_DIRUJUK_OLEH', 'DIRUJUK_OLEH', '[DIRUJUK_OLEH]', '[DIRUJUK_OLEH]', 200, 100, -1, false, '[DIRUJUK_OLEH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIRUJUK_OLEH->Sortable = true; // Allow sort
        $this->DIRUJUK_OLEH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIRUJUK_OLEH->Param, "CustomMsg");
        $this->Fields['DIRUJUK_OLEH'] = &$this->DIRUJUK_OLEH;

        // INSPECTION_DATE
        $this->INSPECTION_DATE = new DbField('OBSTETRI', 'OBSTETRI', 'x_INSPECTION_DATE', 'INSPECTION_DATE', '[INSPECTION_DATE]', CastDateFieldForLike("[INSPECTION_DATE]", 0, "DB"), 135, 8, 0, false, '[INSPECTION_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INSPECTION_DATE->Sortable = true; // Allow sort
        $this->INSPECTION_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->INSPECTION_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INSPECTION_DATE->Param, "CustomMsg");
        $this->Fields['INSPECTION_DATE'] = &$this->INSPECTION_DATE;

        // PORSIO
        $this->PORSIO = new DbField('OBSTETRI', 'OBSTETRI', 'x_PORSIO', 'PORSIO', '[PORSIO]', '[PORSIO]', 200, 100, -1, false, '[PORSIO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PORSIO->Sortable = true; // Allow sort
        $this->PORSIO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PORSIO->Param, "CustomMsg");
        $this->Fields['PORSIO'] = &$this->PORSIO;

        // PEMBUKAAN
        $this->PEMBUKAAN = new DbField('OBSTETRI', 'OBSTETRI', 'x_PEMBUKAAN', 'PEMBUKAAN', '[PEMBUKAAN]', '[PEMBUKAAN]', 200, 100, -1, false, '[PEMBUKAAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PEMBUKAAN->Sortable = true; // Allow sort
        $this->PEMBUKAAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PEMBUKAAN->Param, "CustomMsg");
        $this->Fields['PEMBUKAAN'] = &$this->PEMBUKAAN;

        // KETUBAN
        $this->KETUBAN = new DbField('OBSTETRI', 'OBSTETRI', 'x_KETUBAN', 'KETUBAN', '[KETUBAN]', '[KETUBAN]', 200, 100, -1, false, '[KETUBAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KETUBAN->Sortable = true; // Allow sort
        $this->KETUBAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KETUBAN->Param, "CustomMsg");
        $this->Fields['KETUBAN'] = &$this->KETUBAN;

        // PRESENTASI
        $this->PRESENTASI = new DbField('OBSTETRI', 'OBSTETRI', 'x_PRESENTASI', 'PRESENTASI', '[PRESENTASI]', '[PRESENTASI]', 200, 100, -1, false, '[PRESENTASI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRESENTASI->Sortable = true; // Allow sort
        $this->PRESENTASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRESENTASI->Param, "CustomMsg");
        $this->Fields['PRESENTASI'] = &$this->PRESENTASI;

        // POSISI
        $this->POSISI = new DbField('OBSTETRI', 'OBSTETRI', 'x_POSISI', 'POSISI', '[POSISI]', '[POSISI]', 200, 100, -1, false, '[POSISI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->POSISI->Sortable = true; // Allow sort
        $this->POSISI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->POSISI->Param, "CustomMsg");
        $this->Fields['POSISI'] = &$this->POSISI;

        // PENURUNAN
        $this->PENURUNAN = new DbField('OBSTETRI', 'OBSTETRI', 'x_PENURUNAN', 'PENURUNAN', '[PENURUNAN]', '[PENURUNAN]', 200, 100, -1, false, '[PENURUNAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PENURUNAN->Sortable = true; // Allow sort
        $this->PENURUNAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PENURUNAN->Param, "CustomMsg");
        $this->Fields['PENURUNAN'] = &$this->PENURUNAN;

        // HEART_ID
        $this->HEART_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_HEART_ID', 'HEART_ID', '[HEART_ID]', 'CAST([HEART_ID] AS NVARCHAR)', 17, 1, -1, false, '[HEART_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HEART_ID->Sortable = true; // Allow sort
        $this->HEART_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->HEART_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HEART_ID->Param, "CustomMsg");
        $this->Fields['HEART_ID'] = &$this->HEART_ID;

        // JANIN_ID
        $this->JANIN_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_JANIN_ID', 'JANIN_ID', '[JANIN_ID]', 'CAST([JANIN_ID] AS NVARCHAR)', 17, 1, -1, false, '[JANIN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JANIN_ID->Sortable = true; // Allow sort
        $this->JANIN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->JANIN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JANIN_ID->Param, "CustomMsg");
        $this->Fields['JANIN_ID'] = &$this->JANIN_ID;

        // FREK_DJJ
        $this->FREK_DJJ = new DbField('OBSTETRI', 'OBSTETRI', 'x_FREK_DJJ', 'FREK_DJJ', '[FREK_DJJ]', 'CAST([FREK_DJJ] AS NVARCHAR)', 131, 8, -1, false, '[FREK_DJJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FREK_DJJ->Sortable = true; // Allow sort
        $this->FREK_DJJ->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->FREK_DJJ->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->FREK_DJJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FREK_DJJ->Param, "CustomMsg");
        $this->Fields['FREK_DJJ'] = &$this->FREK_DJJ;

        // PLACENTA
        $this->PLACENTA = new DbField('OBSTETRI', 'OBSTETRI', 'x_PLACENTA', 'PLACENTA', '[PLACENTA]', '[PLACENTA]', 129, 1, -1, false, '[PLACENTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PLACENTA->Sortable = true; // Allow sort
        $this->PLACENTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PLACENTA->Param, "CustomMsg");
        $this->Fields['PLACENTA'] = &$this->PLACENTA;

        // LOCHIA
        $this->LOCHIA = new DbField('OBSTETRI', 'OBSTETRI', 'x_LOCHIA', 'LOCHIA', '[LOCHIA]', '[LOCHIA]', 129, 1, -1, false, '[LOCHIA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LOCHIA->Sortable = true; // Allow sort
        $this->LOCHIA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LOCHIA->Param, "CustomMsg");
        $this->Fields['LOCHIA'] = &$this->LOCHIA;

        // BAB_TYPE
        $this->BAB_TYPE = new DbField('OBSTETRI', 'OBSTETRI', 'x_BAB_TYPE', 'BAB_TYPE', '[BAB_TYPE]', 'CAST([BAB_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[BAB_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BAB_TYPE->Sortable = true; // Allow sort
        $this->BAB_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BAB_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BAB_TYPE->Param, "CustomMsg");
        $this->Fields['BAB_TYPE'] = &$this->BAB_TYPE;

        // BAB_BAB_TYPE
        $this->BAB_BAB_TYPE = new DbField('OBSTETRI', 'OBSTETRI', 'x_BAB_BAB_TYPE', 'BAB_BAB_TYPE', '[BAB_BAB_TYPE]', 'CAST([BAB_BAB_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[BAB_BAB_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BAB_BAB_TYPE->Sortable = true; // Allow sort
        $this->BAB_BAB_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BAB_BAB_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BAB_BAB_TYPE->Param, "CustomMsg");
        $this->Fields['BAB_BAB_TYPE'] = &$this->BAB_BAB_TYPE;

        // RAHIM_ID
        $this->RAHIM_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_RAHIM_ID', 'RAHIM_ID', '[RAHIM_ID]', '[RAHIM_ID]', 129, 1, -1, false, '[RAHIM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RAHIM_ID->Sortable = true; // Allow sort
        $this->RAHIM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RAHIM_ID->Param, "CustomMsg");
        $this->Fields['RAHIM_ID'] = &$this->RAHIM_ID;

        // BIR_RAHIM_ID
        $this->BIR_RAHIM_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIR_RAHIM_ID', 'BIR_RAHIM_ID', '[BIR_RAHIM_ID]', '[BIR_RAHIM_ID]', 129, 1, -1, false, '[BIR_RAHIM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIR_RAHIM_ID->Sortable = true; // Allow sort
        $this->BIR_RAHIM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIR_RAHIM_ID->Param, "CustomMsg");
        $this->Fields['BIR_RAHIM_ID'] = &$this->BIR_RAHIM_ID;

        // VISIT_ID
        $this->VISIT_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // BLOODING
        $this->BLOODING = new DbField('OBSTETRI', 'OBSTETRI', 'x_BLOODING', 'BLOODING', '[BLOODING]', '[BLOODING]', 129, 1, -1, false, '[BLOODING]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BLOODING->Sortable = true; // Allow sort
        $this->BLOODING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BLOODING->Param, "CustomMsg");
        $this->Fields['BLOODING'] = &$this->BLOODING;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('OBSTETRI', 'OBSTETRI', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('OBSTETRI', 'OBSTETRI', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('OBSTETRI', 'OBSTETRI', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('OBSTETRI', 'OBSTETRI', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // RAHIM_SALIN
        $this->RAHIM_SALIN = new DbField('OBSTETRI', 'OBSTETRI', 'x_RAHIM_SALIN', 'RAHIM_SALIN', '[RAHIM_SALIN]', '[RAHIM_SALIN]', 129, 1, -1, false, '[RAHIM_SALIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RAHIM_SALIN->Sortable = true; // Allow sort
        $this->RAHIM_SALIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RAHIM_SALIN->Param, "CustomMsg");
        $this->Fields['RAHIM_SALIN'] = &$this->RAHIM_SALIN;

        // RAHIM_NIFAS
        $this->RAHIM_NIFAS = new DbField('OBSTETRI', 'OBSTETRI', 'x_RAHIM_NIFAS', 'RAHIM_NIFAS', '[RAHIM_NIFAS]', '[RAHIM_NIFAS]', 129, 1, -1, false, '[RAHIM_NIFAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RAHIM_NIFAS->Sortable = true; // Allow sort
        $this->RAHIM_NIFAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RAHIM_NIFAS->Param, "CustomMsg");
        $this->Fields['RAHIM_NIFAS'] = &$this->RAHIM_NIFAS;

        // BAK_TYPE
        $this->BAK_TYPE = new DbField('OBSTETRI', 'OBSTETRI', 'x_BAK_TYPE', 'BAK_TYPE', '[BAK_TYPE]', 'CAST([BAK_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[BAK_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BAK_TYPE->Sortable = true; // Allow sort
        $this->BAK_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BAK_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BAK_TYPE->Param, "CustomMsg");
        $this->Fields['BAK_TYPE'] = &$this->BAK_TYPE;

        // THENAME
        $this->THENAME = new DbField('OBSTETRI', 'OBSTETRI', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 100, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // THEADDRESS
        $this->THEADDRESS = new DbField('OBSTETRI', 'OBSTETRI', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 150, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEID
        $this->THEID = new DbField('OBSTETRI', 'OBSTETRI', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 50, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = true; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->Fields['THEID'] = &$this->THEID;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // ISRJ
        $this->ISRJ = new DbField('OBSTETRI', 'OBSTETRI', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 129, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // AGEYEAR
        $this->AGEYEAR = new DbField('OBSTETRI', 'OBSTETRI', 'x_AGEYEAR', 'AGEYEAR', '[AGEYEAR]', 'CAST([AGEYEAR] AS NVARCHAR)', 17, 1, -1, false, '[AGEYEAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEYEAR->Sortable = true; // Allow sort
        $this->AGEYEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEYEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEYEAR->Param, "CustomMsg");
        $this->Fields['AGEYEAR'] = &$this->AGEYEAR;

        // AGEMONTH
        $this->AGEMONTH = new DbField('OBSTETRI', 'OBSTETRI', 'x_AGEMONTH', 'AGEMONTH', '[AGEMONTH]', 'CAST([AGEMONTH] AS NVARCHAR)', 17, 1, -1, false, '[AGEMONTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEMONTH->Sortable = true; // Allow sort
        $this->AGEMONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEMONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEMONTH->Param, "CustomMsg");
        $this->Fields['AGEMONTH'] = &$this->AGEMONTH;

        // AGEDAY
        $this->AGEDAY = new DbField('OBSTETRI', 'OBSTETRI', 'x_AGEDAY', 'AGEDAY', '[AGEDAY]', 'CAST([AGEDAY] AS NVARCHAR)', 17, 1, -1, false, '[AGEDAY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AGEDAY->Sortable = true; // Allow sort
        $this->AGEDAY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->AGEDAY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AGEDAY->Param, "CustomMsg");
        $this->Fields['AGEDAY'] = &$this->AGEDAY;

        // GENDER
        $this->GENDER = new DbField('OBSTETRI', 'OBSTETRI', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 15, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // BED_ID
        $this->BED_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_BED_ID', 'BED_ID', '[BED_ID]', 'CAST([BED_ID] AS NVARCHAR)', 17, 1, -1, false, '[BED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BED_ID->Sortable = true; // Allow sort
        $this->BED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BED_ID->Param, "CustomMsg");
        $this->Fields['BED_ID'] = &$this->BED_ID;

        // KELUAR_ID
        $this->KELUAR_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_KELUAR_ID', 'KELUAR_ID', '[KELUAR_ID]', 'CAST([KELUAR_ID] AS NVARCHAR)', 17, 1, -1, false, '[KELUAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELUAR_ID->Sortable = true; // Allow sort
        $this->KELUAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KELUAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELUAR_ID->Param, "CustomMsg");
        $this->Fields['KELUAR_ID'] = &$this->KELUAR_ID;

        // DOCTOR
        $this->DOCTOR = new DbField('OBSTETRI', 'OBSTETRI', 'x_DOCTOR', 'DOCTOR', '[DOCTOR]', '[DOCTOR]', 200, 100, -1, false, '[DOCTOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR->Sortable = true; // Allow sort
        $this->DOCTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR->Param, "CustomMsg");
        $this->Fields['DOCTOR'] = &$this->DOCTOR;

        // NB_OBSTETRI
        $this->NB_OBSTETRI = new DbField('OBSTETRI', 'OBSTETRI', 'x_NB_OBSTETRI', 'NB_OBSTETRI', '[NB_OBSTETRI]', 'CAST([NB_OBSTETRI] AS NVARCHAR)', 3, 4, -1, false, '[NB_OBSTETRI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NB_OBSTETRI->Sortable = true; // Allow sort
        $this->NB_OBSTETRI->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NB_OBSTETRI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NB_OBSTETRI->Param, "CustomMsg");
        $this->Fields['NB_OBSTETRI'] = &$this->NB_OBSTETRI;

        // OBSTETRI_DIE
        $this->OBSTETRI_DIE = new DbField('OBSTETRI', 'OBSTETRI', 'x_OBSTETRI_DIE', 'OBSTETRI_DIE', '[OBSTETRI_DIE]', 'CAST([OBSTETRI_DIE] AS NVARCHAR)', 2, 2, -1, false, '[OBSTETRI_DIE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBSTETRI_DIE->Sortable = true; // Allow sort
        $this->OBSTETRI_DIE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->OBSTETRI_DIE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBSTETRI_DIE->Param, "CustomMsg");
        $this->Fields['OBSTETRI_DIE'] = &$this->OBSTETRI_DIE;

        // KAL_ID
        $this->KAL_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_KAL_ID', 'KAL_ID', '[KAL_ID]', '[KAL_ID]', 200, 50, -1, false, '[KAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2 = new DbField('OBSTETRI', 'OBSTETRI', 'x_DIAGNOSA_ID2', 'DIAGNOSA_ID2', '[DIAGNOSA_ID2]', '[DIAGNOSA_ID2]', 200, 50, -1, false, '[DIAGNOSA_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID2->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID2->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID2'] = &$this->DIAGNOSA_ID2;

        // APGAR_ID
        $this->APGAR_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_APGAR_ID', 'APGAR_ID', '[APGAR_ID]', '[APGAR_ID]', 200, 10, -1, false, '[APGAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->APGAR_ID->Sortable = true; // Allow sort
        $this->APGAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->APGAR_ID->Param, "CustomMsg");
        $this->Fields['APGAR_ID'] = &$this->APGAR_ID;

        // BIRTH_LAST_ID
        $this->BIRTH_LAST_ID = new DbField('OBSTETRI', 'OBSTETRI', 'x_BIRTH_LAST_ID', 'BIRTH_LAST_ID', '[BIRTH_LAST_ID]', '[BIRTH_LAST_ID]', 200, 10, -1, false, '[BIRTH_LAST_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BIRTH_LAST_ID->Sortable = true; // Allow sort
        $this->BIRTH_LAST_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BIRTH_LAST_ID->Param, "CustomMsg");
        $this->Fields['BIRTH_LAST_ID'] = &$this->BIRTH_LAST_ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[OBSTETRI]";
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
            if (array_key_exists('OBSTETRI_ID', $rs)) {
                AddFilter($where, QuotedName('OBSTETRI_ID', $this->Dbid) . '=' . QuotedValue($rs['OBSTETRI_ID'], $this->OBSTETRI_ID->DataType, $this->Dbid));
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
        $this->OBSTETRI_ID->DbValue = $row['OBSTETRI_ID'];
        $this->HPHT->DbValue = $row['HPHT'];
        $this->HTP->DbValue = $row['HTP'];
        $this->PASIEN_DIAGNOSA_ID->DbValue = $row['PASIEN_DIAGNOSA_ID'];
        $this->DIAGNOSA_ID->DbValue = $row['DIAGNOSA_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->KOHORT_NB->DbValue = $row['KOHORT_NB'];
        $this->BIRTH_NB->DbValue = $row['BIRTH_NB'];
        $this->BIRTH_DURATION->DbValue = $row['BIRTH_DURATION'];
        $this->BIRTH_PLACE->DbValue = $row['BIRTH_PLACE'];
        $this->ANTE_NATAL->DbValue = $row['ANTE_NATAL'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->BIRTH_WAY->DbValue = $row['BIRTH_WAY'];
        $this->BIRTH_BY->DbValue = $row['BIRTH_BY'];
        $this->BIRTH_DATE->DbValue = $row['BIRTH_DATE'];
        $this->GESTASI->DbValue = $row['GESTASI'];
        $this->PARITY->DbValue = $row['PARITY'];
        $this->NB_BABY->DbValue = $row['NB_BABY'];
        $this->BABY_DIE->DbValue = $row['BABY_DIE'];
        $this->ABORTUS_KE->DbValue = $row['ABORTUS_KE'];
        $this->ABORTUS_ID->DbValue = $row['ABORTUS_ID'];
        $this->ABORTION_DATE->DbValue = $row['ABORTION_DATE'];
        $this->BIRTH_CAT->DbValue = $row['BIRTH_CAT'];
        $this->BIRTH_CON->DbValue = $row['BIRTH_CON'];
        $this->BIRTH_RISK->DbValue = $row['BIRTH_RISK'];
        $this->RISK_TYPE->DbValue = $row['RISK_TYPE'];
        $this->FOLLOW_UP->DbValue = $row['FOLLOW_UP'];
        $this->DIRUJUK_OLEH->DbValue = $row['DIRUJUK_OLEH'];
        $this->INSPECTION_DATE->DbValue = $row['INSPECTION_DATE'];
        $this->PORSIO->DbValue = $row['PORSIO'];
        $this->PEMBUKAAN->DbValue = $row['PEMBUKAAN'];
        $this->KETUBAN->DbValue = $row['KETUBAN'];
        $this->PRESENTASI->DbValue = $row['PRESENTASI'];
        $this->POSISI->DbValue = $row['POSISI'];
        $this->PENURUNAN->DbValue = $row['PENURUNAN'];
        $this->HEART_ID->DbValue = $row['HEART_ID'];
        $this->JANIN_ID->DbValue = $row['JANIN_ID'];
        $this->FREK_DJJ->DbValue = $row['FREK_DJJ'];
        $this->PLACENTA->DbValue = $row['PLACENTA'];
        $this->LOCHIA->DbValue = $row['LOCHIA'];
        $this->BAB_TYPE->DbValue = $row['BAB_TYPE'];
        $this->BAB_BAB_TYPE->DbValue = $row['BAB_BAB_TYPE'];
        $this->RAHIM_ID->DbValue = $row['RAHIM_ID'];
        $this->BIR_RAHIM_ID->DbValue = $row['BIR_RAHIM_ID'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->BLOODING->DbValue = $row['BLOODING'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->RAHIM_SALIN->DbValue = $row['RAHIM_SALIN'];
        $this->RAHIM_NIFAS->DbValue = $row['RAHIM_NIFAS'];
        $this->BAK_TYPE->DbValue = $row['BAK_TYPE'];
        $this->THENAME->DbValue = $row['THENAME'];
        $this->THEADDRESS->DbValue = $row['THEADDRESS'];
        $this->THEID->DbValue = $row['THEID'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->AGEYEAR->DbValue = $row['AGEYEAR'];
        $this->AGEMONTH->DbValue = $row['AGEMONTH'];
        $this->AGEDAY->DbValue = $row['AGEDAY'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->BED_ID->DbValue = $row['BED_ID'];
        $this->KELUAR_ID->DbValue = $row['KELUAR_ID'];
        $this->DOCTOR->DbValue = $row['DOCTOR'];
        $this->NB_OBSTETRI->DbValue = $row['NB_OBSTETRI'];
        $this->OBSTETRI_DIE->DbValue = $row['OBSTETRI_DIE'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->DIAGNOSA_ID2->DbValue = $row['DIAGNOSA_ID2'];
        $this->APGAR_ID->DbValue = $row['APGAR_ID'];
        $this->BIRTH_LAST_ID->DbValue = $row['BIRTH_LAST_ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [OBSTETRI_ID] = '@OBSTETRI_ID@'";
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
        $val = $current ? $this->OBSTETRI_ID->CurrentValue : $this->OBSTETRI_ID->OldValue;
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
                $this->OBSTETRI_ID->CurrentValue = $keys[1];
            } else {
                $this->OBSTETRI_ID->OldValue = $keys[1];
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
            $val = array_key_exists('OBSTETRI_ID', $row) ? $row['OBSTETRI_ID'] : null;
        } else {
            $val = $this->OBSTETRI_ID->OldValue !== null ? $this->OBSTETRI_ID->OldValue : $this->OBSTETRI_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@OBSTETRI_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ObstetriList");
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
        if ($pageName == "ObstetriView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ObstetriEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ObstetriAdd") {
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
                return "ObstetriView";
            case Config("API_ADD_ACTION"):
                return "ObstetriAdd";
            case Config("API_EDIT_ACTION"):
                return "ObstetriEdit";
            case Config("API_DELETE_ACTION"):
                return "ObstetriDelete";
            case Config("API_LIST_ACTION"):
                return "ObstetriList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ObstetriList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ObstetriView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ObstetriView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ObstetriAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ObstetriAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ObstetriEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ObstetriAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ObstetriDelete", $this->getUrlParm());
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
        $json .= ",OBSTETRI_ID:" . JsonEncode($this->OBSTETRI_ID->CurrentValue, "string");
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
        if ($this->OBSTETRI_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->OBSTETRI_ID->CurrentValue);
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
            if (($keyValue = Param("OBSTETRI_ID") ?? Route("OBSTETRI_ID")) !== null) {
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
                $this->OBSTETRI_ID->CurrentValue = $key[1];
            } else {
                $this->OBSTETRI_ID->OldValue = $key[1];
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
        $this->OBSTETRI_ID->setDbValue($row['OBSTETRI_ID']);
        $this->HPHT->setDbValue($row['HPHT']);
        $this->HTP->setDbValue($row['HTP']);
        $this->PASIEN_DIAGNOSA_ID->setDbValue($row['PASIEN_DIAGNOSA_ID']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->KOHORT_NB->setDbValue($row['KOHORT_NB']);
        $this->BIRTH_NB->setDbValue($row['BIRTH_NB']);
        $this->BIRTH_DURATION->setDbValue($row['BIRTH_DURATION']);
        $this->BIRTH_PLACE->setDbValue($row['BIRTH_PLACE']);
        $this->ANTE_NATAL->setDbValue($row['ANTE_NATAL']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->BIRTH_WAY->setDbValue($row['BIRTH_WAY']);
        $this->BIRTH_BY->setDbValue($row['BIRTH_BY']);
        $this->BIRTH_DATE->setDbValue($row['BIRTH_DATE']);
        $this->GESTASI->setDbValue($row['GESTASI']);
        $this->PARITY->setDbValue($row['PARITY']);
        $this->NB_BABY->setDbValue($row['NB_BABY']);
        $this->BABY_DIE->setDbValue($row['BABY_DIE']);
        $this->ABORTUS_KE->setDbValue($row['ABORTUS_KE']);
        $this->ABORTUS_ID->setDbValue($row['ABORTUS_ID']);
        $this->ABORTION_DATE->setDbValue($row['ABORTION_DATE']);
        $this->BIRTH_CAT->setDbValue($row['BIRTH_CAT']);
        $this->BIRTH_CON->setDbValue($row['BIRTH_CON']);
        $this->BIRTH_RISK->setDbValue($row['BIRTH_RISK']);
        $this->RISK_TYPE->setDbValue($row['RISK_TYPE']);
        $this->FOLLOW_UP->setDbValue($row['FOLLOW_UP']);
        $this->DIRUJUK_OLEH->setDbValue($row['DIRUJUK_OLEH']);
        $this->INSPECTION_DATE->setDbValue($row['INSPECTION_DATE']);
        $this->PORSIO->setDbValue($row['PORSIO']);
        $this->PEMBUKAAN->setDbValue($row['PEMBUKAAN']);
        $this->KETUBAN->setDbValue($row['KETUBAN']);
        $this->PRESENTASI->setDbValue($row['PRESENTASI']);
        $this->POSISI->setDbValue($row['POSISI']);
        $this->PENURUNAN->setDbValue($row['PENURUNAN']);
        $this->HEART_ID->setDbValue($row['HEART_ID']);
        $this->JANIN_ID->setDbValue($row['JANIN_ID']);
        $this->FREK_DJJ->setDbValue($row['FREK_DJJ']);
        $this->PLACENTA->setDbValue($row['PLACENTA']);
        $this->LOCHIA->setDbValue($row['LOCHIA']);
        $this->BAB_TYPE->setDbValue($row['BAB_TYPE']);
        $this->BAB_BAB_TYPE->setDbValue($row['BAB_BAB_TYPE']);
        $this->RAHIM_ID->setDbValue($row['RAHIM_ID']);
        $this->BIR_RAHIM_ID->setDbValue($row['BIR_RAHIM_ID']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->BLOODING->setDbValue($row['BLOODING']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->RAHIM_SALIN->setDbValue($row['RAHIM_SALIN']);
        $this->RAHIM_NIFAS->setDbValue($row['RAHIM_NIFAS']);
        $this->BAK_TYPE->setDbValue($row['BAK_TYPE']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEID->setDbValue($row['THEID']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->AGEYEAR->setDbValue($row['AGEYEAR']);
        $this->AGEMONTH->setDbValue($row['AGEMONTH']);
        $this->AGEDAY->setDbValue($row['AGEDAY']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->BED_ID->setDbValue($row['BED_ID']);
        $this->KELUAR_ID->setDbValue($row['KELUAR_ID']);
        $this->DOCTOR->setDbValue($row['DOCTOR']);
        $this->NB_OBSTETRI->setDbValue($row['NB_OBSTETRI']);
        $this->OBSTETRI_DIE->setDbValue($row['OBSTETRI_DIE']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->DIAGNOSA_ID2->setDbValue($row['DIAGNOSA_ID2']);
        $this->APGAR_ID->setDbValue($row['APGAR_ID']);
        $this->BIRTH_LAST_ID->setDbValue($row['BIRTH_LAST_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // OBSTETRI_ID

        // HPHT

        // HTP

        // PASIEN_DIAGNOSA_ID

        // DIAGNOSA_ID

        // NO_REGISTRATION

        // KOHORT_NB

        // BIRTH_NB

        // BIRTH_DURATION

        // BIRTH_PLACE

        // ANTE_NATAL

        // EMPLOYEE_ID

        // CLINIC_ID

        // BIRTH_WAY

        // BIRTH_BY

        // BIRTH_DATE

        // GESTASI

        // PARITY

        // NB_BABY

        // BABY_DIE

        // ABORTUS_KE

        // ABORTUS_ID

        // ABORTION_DATE

        // BIRTH_CAT

        // BIRTH_CON

        // BIRTH_RISK

        // RISK_TYPE

        // FOLLOW_UP

        // DIRUJUK_OLEH

        // INSPECTION_DATE

        // PORSIO

        // PEMBUKAAN

        // KETUBAN

        // PRESENTASI

        // POSISI

        // PENURUNAN

        // HEART_ID

        // JANIN_ID

        // FREK_DJJ

        // PLACENTA

        // LOCHIA

        // BAB_TYPE

        // BAB_BAB_TYPE

        // RAHIM_ID

        // BIR_RAHIM_ID

        // VISIT_ID

        // BLOODING

        // DESCRIPTION

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // RAHIM_SALIN

        // RAHIM_NIFAS

        // BAK_TYPE

        // THENAME

        // THEADDRESS

        // THEID

        // STATUS_PASIEN_ID

        // ISRJ

        // AGEYEAR

        // AGEMONTH

        // AGEDAY

        // GENDER

        // CLASS_ROOM_ID

        // BED_ID

        // KELUAR_ID

        // DOCTOR

        // NB_OBSTETRI

        // OBSTETRI_DIE

        // KAL_ID

        // DIAGNOSA_ID2

        // APGAR_ID

        // BIRTH_LAST_ID

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // OBSTETRI_ID
        $this->OBSTETRI_ID->ViewValue = $this->OBSTETRI_ID->CurrentValue;
        $this->OBSTETRI_ID->ViewCustomAttributes = "";

        // HPHT
        $this->HPHT->ViewValue = $this->HPHT->CurrentValue;
        $this->HPHT->ViewValue = FormatDateTime($this->HPHT->ViewValue, 0);
        $this->HPHT->ViewCustomAttributes = "";

        // HTP
        $this->HTP->ViewValue = $this->HTP->CurrentValue;
        $this->HTP->ViewValue = FormatDateTime($this->HTP->ViewValue, 0);
        $this->HTP->ViewCustomAttributes = "";

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->ViewValue = $this->PASIEN_DIAGNOSA_ID->CurrentValue;
        $this->PASIEN_DIAGNOSA_ID->ViewCustomAttributes = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // KOHORT_NB
        $this->KOHORT_NB->ViewValue = $this->KOHORT_NB->CurrentValue;
        $this->KOHORT_NB->ViewCustomAttributes = "";

        // BIRTH_NB
        $this->BIRTH_NB->ViewValue = $this->BIRTH_NB->CurrentValue;
        $this->BIRTH_NB->ViewValue = FormatNumber($this->BIRTH_NB->ViewValue, 0, -2, -2, -2);
        $this->BIRTH_NB->ViewCustomAttributes = "";

        // BIRTH_DURATION
        $this->BIRTH_DURATION->ViewValue = $this->BIRTH_DURATION->CurrentValue;
        $this->BIRTH_DURATION->ViewValue = FormatNumber($this->BIRTH_DURATION->ViewValue, 0, -2, -2, -2);
        $this->BIRTH_DURATION->ViewCustomAttributes = "";

        // BIRTH_PLACE
        $this->BIRTH_PLACE->ViewValue = $this->BIRTH_PLACE->CurrentValue;
        $this->BIRTH_PLACE->ViewValue = FormatNumber($this->BIRTH_PLACE->ViewValue, 0, -2, -2, -2);
        $this->BIRTH_PLACE->ViewCustomAttributes = "";

        // ANTE_NATAL
        $this->ANTE_NATAL->ViewValue = $this->ANTE_NATAL->CurrentValue;
        $this->ANTE_NATAL->ViewValue = FormatNumber($this->ANTE_NATAL->ViewValue, 0, -2, -2, -2);
        $this->ANTE_NATAL->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // BIRTH_WAY
        $this->BIRTH_WAY->ViewValue = $this->BIRTH_WAY->CurrentValue;
        $this->BIRTH_WAY->ViewCustomAttributes = "";

        // BIRTH_BY
        $this->BIRTH_BY->ViewValue = $this->BIRTH_BY->CurrentValue;
        $this->BIRTH_BY->ViewValue = FormatNumber($this->BIRTH_BY->ViewValue, 0, -2, -2, -2);
        $this->BIRTH_BY->ViewCustomAttributes = "";

        // BIRTH_DATE
        $this->BIRTH_DATE->ViewValue = $this->BIRTH_DATE->CurrentValue;
        $this->BIRTH_DATE->ViewValue = FormatDateTime($this->BIRTH_DATE->ViewValue, 0);
        $this->BIRTH_DATE->ViewCustomAttributes = "";

        // GESTASI
        $this->GESTASI->ViewValue = $this->GESTASI->CurrentValue;
        $this->GESTASI->ViewValue = FormatNumber($this->GESTASI->ViewValue, 0, -2, -2, -2);
        $this->GESTASI->ViewCustomAttributes = "";

        // PARITY
        $this->PARITY->ViewValue = $this->PARITY->CurrentValue;
        $this->PARITY->ViewValue = FormatNumber($this->PARITY->ViewValue, 0, -2, -2, -2);
        $this->PARITY->ViewCustomAttributes = "";

        // NB_BABY
        $this->NB_BABY->ViewValue = $this->NB_BABY->CurrentValue;
        $this->NB_BABY->ViewValue = FormatNumber($this->NB_BABY->ViewValue, 0, -2, -2, -2);
        $this->NB_BABY->ViewCustomAttributes = "";

        // BABY_DIE
        $this->BABY_DIE->ViewValue = $this->BABY_DIE->CurrentValue;
        $this->BABY_DIE->ViewValue = FormatNumber($this->BABY_DIE->ViewValue, 0, -2, -2, -2);
        $this->BABY_DIE->ViewCustomAttributes = "";

        // ABORTUS_KE
        $this->ABORTUS_KE->ViewValue = $this->ABORTUS_KE->CurrentValue;
        $this->ABORTUS_KE->ViewValue = FormatNumber($this->ABORTUS_KE->ViewValue, 0, -2, -2, -2);
        $this->ABORTUS_KE->ViewCustomAttributes = "";

        // ABORTUS_ID
        $this->ABORTUS_ID->ViewValue = $this->ABORTUS_ID->CurrentValue;
        $this->ABORTUS_ID->ViewCustomAttributes = "";

        // ABORTION_DATE
        $this->ABORTION_DATE->ViewValue = $this->ABORTION_DATE->CurrentValue;
        $this->ABORTION_DATE->ViewValue = FormatDateTime($this->ABORTION_DATE->ViewValue, 0);
        $this->ABORTION_DATE->ViewCustomAttributes = "";

        // BIRTH_CAT
        $this->BIRTH_CAT->ViewValue = $this->BIRTH_CAT->CurrentValue;
        $this->BIRTH_CAT->ViewCustomAttributes = "";

        // BIRTH_CON
        $this->BIRTH_CON->ViewValue = $this->BIRTH_CON->CurrentValue;
        $this->BIRTH_CON->ViewValue = FormatNumber($this->BIRTH_CON->ViewValue, 0, -2, -2, -2);
        $this->BIRTH_CON->ViewCustomAttributes = "";

        // BIRTH_RISK
        $this->BIRTH_RISK->ViewValue = $this->BIRTH_RISK->CurrentValue;
        $this->BIRTH_RISK->ViewValue = FormatNumber($this->BIRTH_RISK->ViewValue, 0, -2, -2, -2);
        $this->BIRTH_RISK->ViewCustomAttributes = "";

        // RISK_TYPE
        $this->RISK_TYPE->ViewValue = $this->RISK_TYPE->CurrentValue;
        $this->RISK_TYPE->ViewValue = FormatNumber($this->RISK_TYPE->ViewValue, 0, -2, -2, -2);
        $this->RISK_TYPE->ViewCustomAttributes = "";

        // FOLLOW_UP
        $this->FOLLOW_UP->ViewValue = $this->FOLLOW_UP->CurrentValue;
        $this->FOLLOW_UP->ViewValue = FormatNumber($this->FOLLOW_UP->ViewValue, 0, -2, -2, -2);
        $this->FOLLOW_UP->ViewCustomAttributes = "";

        // DIRUJUK_OLEH
        $this->DIRUJUK_OLEH->ViewValue = $this->DIRUJUK_OLEH->CurrentValue;
        $this->DIRUJUK_OLEH->ViewCustomAttributes = "";

        // INSPECTION_DATE
        $this->INSPECTION_DATE->ViewValue = $this->INSPECTION_DATE->CurrentValue;
        $this->INSPECTION_DATE->ViewValue = FormatDateTime($this->INSPECTION_DATE->ViewValue, 0);
        $this->INSPECTION_DATE->ViewCustomAttributes = "";

        // PORSIO
        $this->PORSIO->ViewValue = $this->PORSIO->CurrentValue;
        $this->PORSIO->ViewCustomAttributes = "";

        // PEMBUKAAN
        $this->PEMBUKAAN->ViewValue = $this->PEMBUKAAN->CurrentValue;
        $this->PEMBUKAAN->ViewCustomAttributes = "";

        // KETUBAN
        $this->KETUBAN->ViewValue = $this->KETUBAN->CurrentValue;
        $this->KETUBAN->ViewCustomAttributes = "";

        // PRESENTASI
        $this->PRESENTASI->ViewValue = $this->PRESENTASI->CurrentValue;
        $this->PRESENTASI->ViewCustomAttributes = "";

        // POSISI
        $this->POSISI->ViewValue = $this->POSISI->CurrentValue;
        $this->POSISI->ViewCustomAttributes = "";

        // PENURUNAN
        $this->PENURUNAN->ViewValue = $this->PENURUNAN->CurrentValue;
        $this->PENURUNAN->ViewCustomAttributes = "";

        // HEART_ID
        $this->HEART_ID->ViewValue = $this->HEART_ID->CurrentValue;
        $this->HEART_ID->ViewValue = FormatNumber($this->HEART_ID->ViewValue, 0, -2, -2, -2);
        $this->HEART_ID->ViewCustomAttributes = "";

        // JANIN_ID
        $this->JANIN_ID->ViewValue = $this->JANIN_ID->CurrentValue;
        $this->JANIN_ID->ViewValue = FormatNumber($this->JANIN_ID->ViewValue, 0, -2, -2, -2);
        $this->JANIN_ID->ViewCustomAttributes = "";

        // FREK_DJJ
        $this->FREK_DJJ->ViewValue = $this->FREK_DJJ->CurrentValue;
        $this->FREK_DJJ->ViewValue = FormatNumber($this->FREK_DJJ->ViewValue, 2, -2, -2, -2);
        $this->FREK_DJJ->ViewCustomAttributes = "";

        // PLACENTA
        $this->PLACENTA->ViewValue = $this->PLACENTA->CurrentValue;
        $this->PLACENTA->ViewCustomAttributes = "";

        // LOCHIA
        $this->LOCHIA->ViewValue = $this->LOCHIA->CurrentValue;
        $this->LOCHIA->ViewCustomAttributes = "";

        // BAB_TYPE
        $this->BAB_TYPE->ViewValue = $this->BAB_TYPE->CurrentValue;
        $this->BAB_TYPE->ViewValue = FormatNumber($this->BAB_TYPE->ViewValue, 0, -2, -2, -2);
        $this->BAB_TYPE->ViewCustomAttributes = "";

        // BAB_BAB_TYPE
        $this->BAB_BAB_TYPE->ViewValue = $this->BAB_BAB_TYPE->CurrentValue;
        $this->BAB_BAB_TYPE->ViewValue = FormatNumber($this->BAB_BAB_TYPE->ViewValue, 0, -2, -2, -2);
        $this->BAB_BAB_TYPE->ViewCustomAttributes = "";

        // RAHIM_ID
        $this->RAHIM_ID->ViewValue = $this->RAHIM_ID->CurrentValue;
        $this->RAHIM_ID->ViewCustomAttributes = "";

        // BIR_RAHIM_ID
        $this->BIR_RAHIM_ID->ViewValue = $this->BIR_RAHIM_ID->CurrentValue;
        $this->BIR_RAHIM_ID->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // BLOODING
        $this->BLOODING->ViewValue = $this->BLOODING->CurrentValue;
        $this->BLOODING->ViewCustomAttributes = "";

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

        // RAHIM_SALIN
        $this->RAHIM_SALIN->ViewValue = $this->RAHIM_SALIN->CurrentValue;
        $this->RAHIM_SALIN->ViewCustomAttributes = "";

        // RAHIM_NIFAS
        $this->RAHIM_NIFAS->ViewValue = $this->RAHIM_NIFAS->CurrentValue;
        $this->RAHIM_NIFAS->ViewCustomAttributes = "";

        // BAK_TYPE
        $this->BAK_TYPE->ViewValue = $this->BAK_TYPE->CurrentValue;
        $this->BAK_TYPE->ViewValue = FormatNumber($this->BAK_TYPE->ViewValue, 0, -2, -2, -2);
        $this->BAK_TYPE->ViewCustomAttributes = "";

        // THENAME
        $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
        $this->THENAME->ViewCustomAttributes = "";

        // THEADDRESS
        $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
        $this->THEADDRESS->ViewCustomAttributes = "";

        // THEID
        $this->THEID->ViewValue = $this->THEID->CurrentValue;
        $this->THEID->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

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

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

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

        // DOCTOR
        $this->DOCTOR->ViewValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->ViewCustomAttributes = "";

        // NB_OBSTETRI
        $this->NB_OBSTETRI->ViewValue = $this->NB_OBSTETRI->CurrentValue;
        $this->NB_OBSTETRI->ViewValue = FormatNumber($this->NB_OBSTETRI->ViewValue, 0, -2, -2, -2);
        $this->NB_OBSTETRI->ViewCustomAttributes = "";

        // OBSTETRI_DIE
        $this->OBSTETRI_DIE->ViewValue = $this->OBSTETRI_DIE->CurrentValue;
        $this->OBSTETRI_DIE->ViewValue = FormatNumber($this->OBSTETRI_DIE->ViewValue, 0, -2, -2, -2);
        $this->OBSTETRI_DIE->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->ViewValue = $this->DIAGNOSA_ID2->CurrentValue;
        $this->DIAGNOSA_ID2->ViewCustomAttributes = "";

        // APGAR_ID
        $this->APGAR_ID->ViewValue = $this->APGAR_ID->CurrentValue;
        $this->APGAR_ID->ViewCustomAttributes = "";

        // BIRTH_LAST_ID
        $this->BIRTH_LAST_ID->ViewValue = $this->BIRTH_LAST_ID->CurrentValue;
        $this->BIRTH_LAST_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // OBSTETRI_ID
        $this->OBSTETRI_ID->LinkCustomAttributes = "";
        $this->OBSTETRI_ID->HrefValue = "";
        $this->OBSTETRI_ID->TooltipValue = "";

        // HPHT
        $this->HPHT->LinkCustomAttributes = "";
        $this->HPHT->HrefValue = "";
        $this->HPHT->TooltipValue = "";

        // HTP
        $this->HTP->LinkCustomAttributes = "";
        $this->HTP->HrefValue = "";
        $this->HTP->TooltipValue = "";

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->PASIEN_DIAGNOSA_ID->HrefValue = "";
        $this->PASIEN_DIAGNOSA_ID->TooltipValue = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID->HrefValue = "";
        $this->DIAGNOSA_ID->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // KOHORT_NB
        $this->KOHORT_NB->LinkCustomAttributes = "";
        $this->KOHORT_NB->HrefValue = "";
        $this->KOHORT_NB->TooltipValue = "";

        // BIRTH_NB
        $this->BIRTH_NB->LinkCustomAttributes = "";
        $this->BIRTH_NB->HrefValue = "";
        $this->BIRTH_NB->TooltipValue = "";

        // BIRTH_DURATION
        $this->BIRTH_DURATION->LinkCustomAttributes = "";
        $this->BIRTH_DURATION->HrefValue = "";
        $this->BIRTH_DURATION->TooltipValue = "";

        // BIRTH_PLACE
        $this->BIRTH_PLACE->LinkCustomAttributes = "";
        $this->BIRTH_PLACE->HrefValue = "";
        $this->BIRTH_PLACE->TooltipValue = "";

        // ANTE_NATAL
        $this->ANTE_NATAL->LinkCustomAttributes = "";
        $this->ANTE_NATAL->HrefValue = "";
        $this->ANTE_NATAL->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // BIRTH_WAY
        $this->BIRTH_WAY->LinkCustomAttributes = "";
        $this->BIRTH_WAY->HrefValue = "";
        $this->BIRTH_WAY->TooltipValue = "";

        // BIRTH_BY
        $this->BIRTH_BY->LinkCustomAttributes = "";
        $this->BIRTH_BY->HrefValue = "";
        $this->BIRTH_BY->TooltipValue = "";

        // BIRTH_DATE
        $this->BIRTH_DATE->LinkCustomAttributes = "";
        $this->BIRTH_DATE->HrefValue = "";
        $this->BIRTH_DATE->TooltipValue = "";

        // GESTASI
        $this->GESTASI->LinkCustomAttributes = "";
        $this->GESTASI->HrefValue = "";
        $this->GESTASI->TooltipValue = "";

        // PARITY
        $this->PARITY->LinkCustomAttributes = "";
        $this->PARITY->HrefValue = "";
        $this->PARITY->TooltipValue = "";

        // NB_BABY
        $this->NB_BABY->LinkCustomAttributes = "";
        $this->NB_BABY->HrefValue = "";
        $this->NB_BABY->TooltipValue = "";

        // BABY_DIE
        $this->BABY_DIE->LinkCustomAttributes = "";
        $this->BABY_DIE->HrefValue = "";
        $this->BABY_DIE->TooltipValue = "";

        // ABORTUS_KE
        $this->ABORTUS_KE->LinkCustomAttributes = "";
        $this->ABORTUS_KE->HrefValue = "";
        $this->ABORTUS_KE->TooltipValue = "";

        // ABORTUS_ID
        $this->ABORTUS_ID->LinkCustomAttributes = "";
        $this->ABORTUS_ID->HrefValue = "";
        $this->ABORTUS_ID->TooltipValue = "";

        // ABORTION_DATE
        $this->ABORTION_DATE->LinkCustomAttributes = "";
        $this->ABORTION_DATE->HrefValue = "";
        $this->ABORTION_DATE->TooltipValue = "";

        // BIRTH_CAT
        $this->BIRTH_CAT->LinkCustomAttributes = "";
        $this->BIRTH_CAT->HrefValue = "";
        $this->BIRTH_CAT->TooltipValue = "";

        // BIRTH_CON
        $this->BIRTH_CON->LinkCustomAttributes = "";
        $this->BIRTH_CON->HrefValue = "";
        $this->BIRTH_CON->TooltipValue = "";

        // BIRTH_RISK
        $this->BIRTH_RISK->LinkCustomAttributes = "";
        $this->BIRTH_RISK->HrefValue = "";
        $this->BIRTH_RISK->TooltipValue = "";

        // RISK_TYPE
        $this->RISK_TYPE->LinkCustomAttributes = "";
        $this->RISK_TYPE->HrefValue = "";
        $this->RISK_TYPE->TooltipValue = "";

        // FOLLOW_UP
        $this->FOLLOW_UP->LinkCustomAttributes = "";
        $this->FOLLOW_UP->HrefValue = "";
        $this->FOLLOW_UP->TooltipValue = "";

        // DIRUJUK_OLEH
        $this->DIRUJUK_OLEH->LinkCustomAttributes = "";
        $this->DIRUJUK_OLEH->HrefValue = "";
        $this->DIRUJUK_OLEH->TooltipValue = "";

        // INSPECTION_DATE
        $this->INSPECTION_DATE->LinkCustomAttributes = "";
        $this->INSPECTION_DATE->HrefValue = "";
        $this->INSPECTION_DATE->TooltipValue = "";

        // PORSIO
        $this->PORSIO->LinkCustomAttributes = "";
        $this->PORSIO->HrefValue = "";
        $this->PORSIO->TooltipValue = "";

        // PEMBUKAAN
        $this->PEMBUKAAN->LinkCustomAttributes = "";
        $this->PEMBUKAAN->HrefValue = "";
        $this->PEMBUKAAN->TooltipValue = "";

        // KETUBAN
        $this->KETUBAN->LinkCustomAttributes = "";
        $this->KETUBAN->HrefValue = "";
        $this->KETUBAN->TooltipValue = "";

        // PRESENTASI
        $this->PRESENTASI->LinkCustomAttributes = "";
        $this->PRESENTASI->HrefValue = "";
        $this->PRESENTASI->TooltipValue = "";

        // POSISI
        $this->POSISI->LinkCustomAttributes = "";
        $this->POSISI->HrefValue = "";
        $this->POSISI->TooltipValue = "";

        // PENURUNAN
        $this->PENURUNAN->LinkCustomAttributes = "";
        $this->PENURUNAN->HrefValue = "";
        $this->PENURUNAN->TooltipValue = "";

        // HEART_ID
        $this->HEART_ID->LinkCustomAttributes = "";
        $this->HEART_ID->HrefValue = "";
        $this->HEART_ID->TooltipValue = "";

        // JANIN_ID
        $this->JANIN_ID->LinkCustomAttributes = "";
        $this->JANIN_ID->HrefValue = "";
        $this->JANIN_ID->TooltipValue = "";

        // FREK_DJJ
        $this->FREK_DJJ->LinkCustomAttributes = "";
        $this->FREK_DJJ->HrefValue = "";
        $this->FREK_DJJ->TooltipValue = "";

        // PLACENTA
        $this->PLACENTA->LinkCustomAttributes = "";
        $this->PLACENTA->HrefValue = "";
        $this->PLACENTA->TooltipValue = "";

        // LOCHIA
        $this->LOCHIA->LinkCustomAttributes = "";
        $this->LOCHIA->HrefValue = "";
        $this->LOCHIA->TooltipValue = "";

        // BAB_TYPE
        $this->BAB_TYPE->LinkCustomAttributes = "";
        $this->BAB_TYPE->HrefValue = "";
        $this->BAB_TYPE->TooltipValue = "";

        // BAB_BAB_TYPE
        $this->BAB_BAB_TYPE->LinkCustomAttributes = "";
        $this->BAB_BAB_TYPE->HrefValue = "";
        $this->BAB_BAB_TYPE->TooltipValue = "";

        // RAHIM_ID
        $this->RAHIM_ID->LinkCustomAttributes = "";
        $this->RAHIM_ID->HrefValue = "";
        $this->RAHIM_ID->TooltipValue = "";

        // BIR_RAHIM_ID
        $this->BIR_RAHIM_ID->LinkCustomAttributes = "";
        $this->BIR_RAHIM_ID->HrefValue = "";
        $this->BIR_RAHIM_ID->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // BLOODING
        $this->BLOODING->LinkCustomAttributes = "";
        $this->BLOODING->HrefValue = "";
        $this->BLOODING->TooltipValue = "";

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

        // RAHIM_SALIN
        $this->RAHIM_SALIN->LinkCustomAttributes = "";
        $this->RAHIM_SALIN->HrefValue = "";
        $this->RAHIM_SALIN->TooltipValue = "";

        // RAHIM_NIFAS
        $this->RAHIM_NIFAS->LinkCustomAttributes = "";
        $this->RAHIM_NIFAS->HrefValue = "";
        $this->RAHIM_NIFAS->TooltipValue = "";

        // BAK_TYPE
        $this->BAK_TYPE->LinkCustomAttributes = "";
        $this->BAK_TYPE->HrefValue = "";
        $this->BAK_TYPE->TooltipValue = "";

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

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

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

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

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

        // DOCTOR
        $this->DOCTOR->LinkCustomAttributes = "";
        $this->DOCTOR->HrefValue = "";
        $this->DOCTOR->TooltipValue = "";

        // NB_OBSTETRI
        $this->NB_OBSTETRI->LinkCustomAttributes = "";
        $this->NB_OBSTETRI->HrefValue = "";
        $this->NB_OBSTETRI->TooltipValue = "";

        // OBSTETRI_DIE
        $this->OBSTETRI_DIE->LinkCustomAttributes = "";
        $this->OBSTETRI_DIE->HrefValue = "";
        $this->OBSTETRI_DIE->TooltipValue = "";

        // KAL_ID
        $this->KAL_ID->LinkCustomAttributes = "";
        $this->KAL_ID->HrefValue = "";
        $this->KAL_ID->TooltipValue = "";

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID2->HrefValue = "";
        $this->DIAGNOSA_ID2->TooltipValue = "";

        // APGAR_ID
        $this->APGAR_ID->LinkCustomAttributes = "";
        $this->APGAR_ID->HrefValue = "";
        $this->APGAR_ID->TooltipValue = "";

        // BIRTH_LAST_ID
        $this->BIRTH_LAST_ID->LinkCustomAttributes = "";
        $this->BIRTH_LAST_ID->HrefValue = "";
        $this->BIRTH_LAST_ID->TooltipValue = "";

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

        // OBSTETRI_ID
        $this->OBSTETRI_ID->EditAttrs["class"] = "form-control";
        $this->OBSTETRI_ID->EditCustomAttributes = "";
        if (!$this->OBSTETRI_ID->Raw) {
            $this->OBSTETRI_ID->CurrentValue = HtmlDecode($this->OBSTETRI_ID->CurrentValue);
        }
        $this->OBSTETRI_ID->EditValue = $this->OBSTETRI_ID->CurrentValue;
        $this->OBSTETRI_ID->PlaceHolder = RemoveHtml($this->OBSTETRI_ID->caption());

        // HPHT
        $this->HPHT->EditAttrs["class"] = "form-control";
        $this->HPHT->EditCustomAttributes = "";
        $this->HPHT->EditValue = FormatDateTime($this->HPHT->CurrentValue, 8);
        $this->HPHT->PlaceHolder = RemoveHtml($this->HPHT->caption());

        // HTP
        $this->HTP->EditAttrs["class"] = "form-control";
        $this->HTP->EditCustomAttributes = "";
        $this->HTP->EditValue = FormatDateTime($this->HTP->CurrentValue, 8);
        $this->HTP->PlaceHolder = RemoveHtml($this->HTP->caption());

        // PASIEN_DIAGNOSA_ID
        $this->PASIEN_DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->PASIEN_DIAGNOSA_ID->EditCustomAttributes = "";
        if (!$this->PASIEN_DIAGNOSA_ID->Raw) {
            $this->PASIEN_DIAGNOSA_ID->CurrentValue = HtmlDecode($this->PASIEN_DIAGNOSA_ID->CurrentValue);
        }
        $this->PASIEN_DIAGNOSA_ID->EditValue = $this->PASIEN_DIAGNOSA_ID->CurrentValue;
        $this->PASIEN_DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->PASIEN_DIAGNOSA_ID->caption());

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID->Raw) {
            $this->DIAGNOSA_ID->CurrentValue = HtmlDecode($this->DIAGNOSA_ID->CurrentValue);
        }
        $this->DIAGNOSA_ID->EditValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // KOHORT_NB
        $this->KOHORT_NB->EditAttrs["class"] = "form-control";
        $this->KOHORT_NB->EditCustomAttributes = "";
        if (!$this->KOHORT_NB->Raw) {
            $this->KOHORT_NB->CurrentValue = HtmlDecode($this->KOHORT_NB->CurrentValue);
        }
        $this->KOHORT_NB->EditValue = $this->KOHORT_NB->CurrentValue;
        $this->KOHORT_NB->PlaceHolder = RemoveHtml($this->KOHORT_NB->caption());

        // BIRTH_NB
        $this->BIRTH_NB->EditAttrs["class"] = "form-control";
        $this->BIRTH_NB->EditCustomAttributes = "";
        $this->BIRTH_NB->EditValue = $this->BIRTH_NB->CurrentValue;
        $this->BIRTH_NB->PlaceHolder = RemoveHtml($this->BIRTH_NB->caption());

        // BIRTH_DURATION
        $this->BIRTH_DURATION->EditAttrs["class"] = "form-control";
        $this->BIRTH_DURATION->EditCustomAttributes = "";
        $this->BIRTH_DURATION->EditValue = $this->BIRTH_DURATION->CurrentValue;
        $this->BIRTH_DURATION->PlaceHolder = RemoveHtml($this->BIRTH_DURATION->caption());

        // BIRTH_PLACE
        $this->BIRTH_PLACE->EditAttrs["class"] = "form-control";
        $this->BIRTH_PLACE->EditCustomAttributes = "";
        $this->BIRTH_PLACE->EditValue = $this->BIRTH_PLACE->CurrentValue;
        $this->BIRTH_PLACE->PlaceHolder = RemoveHtml($this->BIRTH_PLACE->caption());

        // ANTE_NATAL
        $this->ANTE_NATAL->EditAttrs["class"] = "form-control";
        $this->ANTE_NATAL->EditCustomAttributes = "";
        $this->ANTE_NATAL->EditValue = $this->ANTE_NATAL->CurrentValue;
        $this->ANTE_NATAL->PlaceHolder = RemoveHtml($this->ANTE_NATAL->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // BIRTH_WAY
        $this->BIRTH_WAY->EditAttrs["class"] = "form-control";
        $this->BIRTH_WAY->EditCustomAttributes = "";
        if (!$this->BIRTH_WAY->Raw) {
            $this->BIRTH_WAY->CurrentValue = HtmlDecode($this->BIRTH_WAY->CurrentValue);
        }
        $this->BIRTH_WAY->EditValue = $this->BIRTH_WAY->CurrentValue;
        $this->BIRTH_WAY->PlaceHolder = RemoveHtml($this->BIRTH_WAY->caption());

        // BIRTH_BY
        $this->BIRTH_BY->EditAttrs["class"] = "form-control";
        $this->BIRTH_BY->EditCustomAttributes = "";
        $this->BIRTH_BY->EditValue = $this->BIRTH_BY->CurrentValue;
        $this->BIRTH_BY->PlaceHolder = RemoveHtml($this->BIRTH_BY->caption());

        // BIRTH_DATE
        $this->BIRTH_DATE->EditAttrs["class"] = "form-control";
        $this->BIRTH_DATE->EditCustomAttributes = "";
        $this->BIRTH_DATE->EditValue = FormatDateTime($this->BIRTH_DATE->CurrentValue, 8);
        $this->BIRTH_DATE->PlaceHolder = RemoveHtml($this->BIRTH_DATE->caption());

        // GESTASI
        $this->GESTASI->EditAttrs["class"] = "form-control";
        $this->GESTASI->EditCustomAttributes = "";
        $this->GESTASI->EditValue = $this->GESTASI->CurrentValue;
        $this->GESTASI->PlaceHolder = RemoveHtml($this->GESTASI->caption());

        // PARITY
        $this->PARITY->EditAttrs["class"] = "form-control";
        $this->PARITY->EditCustomAttributes = "";
        $this->PARITY->EditValue = $this->PARITY->CurrentValue;
        $this->PARITY->PlaceHolder = RemoveHtml($this->PARITY->caption());

        // NB_BABY
        $this->NB_BABY->EditAttrs["class"] = "form-control";
        $this->NB_BABY->EditCustomAttributes = "";
        $this->NB_BABY->EditValue = $this->NB_BABY->CurrentValue;
        $this->NB_BABY->PlaceHolder = RemoveHtml($this->NB_BABY->caption());

        // BABY_DIE
        $this->BABY_DIE->EditAttrs["class"] = "form-control";
        $this->BABY_DIE->EditCustomAttributes = "";
        $this->BABY_DIE->EditValue = $this->BABY_DIE->CurrentValue;
        $this->BABY_DIE->PlaceHolder = RemoveHtml($this->BABY_DIE->caption());

        // ABORTUS_KE
        $this->ABORTUS_KE->EditAttrs["class"] = "form-control";
        $this->ABORTUS_KE->EditCustomAttributes = "";
        $this->ABORTUS_KE->EditValue = $this->ABORTUS_KE->CurrentValue;
        $this->ABORTUS_KE->PlaceHolder = RemoveHtml($this->ABORTUS_KE->caption());

        // ABORTUS_ID
        $this->ABORTUS_ID->EditAttrs["class"] = "form-control";
        $this->ABORTUS_ID->EditCustomAttributes = "";
        if (!$this->ABORTUS_ID->Raw) {
            $this->ABORTUS_ID->CurrentValue = HtmlDecode($this->ABORTUS_ID->CurrentValue);
        }
        $this->ABORTUS_ID->EditValue = $this->ABORTUS_ID->CurrentValue;
        $this->ABORTUS_ID->PlaceHolder = RemoveHtml($this->ABORTUS_ID->caption());

        // ABORTION_DATE
        $this->ABORTION_DATE->EditAttrs["class"] = "form-control";
        $this->ABORTION_DATE->EditCustomAttributes = "";
        $this->ABORTION_DATE->EditValue = FormatDateTime($this->ABORTION_DATE->CurrentValue, 8);
        $this->ABORTION_DATE->PlaceHolder = RemoveHtml($this->ABORTION_DATE->caption());

        // BIRTH_CAT
        $this->BIRTH_CAT->EditAttrs["class"] = "form-control";
        $this->BIRTH_CAT->EditCustomAttributes = "";
        if (!$this->BIRTH_CAT->Raw) {
            $this->BIRTH_CAT->CurrentValue = HtmlDecode($this->BIRTH_CAT->CurrentValue);
        }
        $this->BIRTH_CAT->EditValue = $this->BIRTH_CAT->CurrentValue;
        $this->BIRTH_CAT->PlaceHolder = RemoveHtml($this->BIRTH_CAT->caption());

        // BIRTH_CON
        $this->BIRTH_CON->EditAttrs["class"] = "form-control";
        $this->BIRTH_CON->EditCustomAttributes = "";
        $this->BIRTH_CON->EditValue = $this->BIRTH_CON->CurrentValue;
        $this->BIRTH_CON->PlaceHolder = RemoveHtml($this->BIRTH_CON->caption());

        // BIRTH_RISK
        $this->BIRTH_RISK->EditAttrs["class"] = "form-control";
        $this->BIRTH_RISK->EditCustomAttributes = "";
        $this->BIRTH_RISK->EditValue = $this->BIRTH_RISK->CurrentValue;
        $this->BIRTH_RISK->PlaceHolder = RemoveHtml($this->BIRTH_RISK->caption());

        // RISK_TYPE
        $this->RISK_TYPE->EditAttrs["class"] = "form-control";
        $this->RISK_TYPE->EditCustomAttributes = "";
        $this->RISK_TYPE->EditValue = $this->RISK_TYPE->CurrentValue;
        $this->RISK_TYPE->PlaceHolder = RemoveHtml($this->RISK_TYPE->caption());

        // FOLLOW_UP
        $this->FOLLOW_UP->EditAttrs["class"] = "form-control";
        $this->FOLLOW_UP->EditCustomAttributes = "";
        $this->FOLLOW_UP->EditValue = $this->FOLLOW_UP->CurrentValue;
        $this->FOLLOW_UP->PlaceHolder = RemoveHtml($this->FOLLOW_UP->caption());

        // DIRUJUK_OLEH
        $this->DIRUJUK_OLEH->EditAttrs["class"] = "form-control";
        $this->DIRUJUK_OLEH->EditCustomAttributes = "";
        if (!$this->DIRUJUK_OLEH->Raw) {
            $this->DIRUJUK_OLEH->CurrentValue = HtmlDecode($this->DIRUJUK_OLEH->CurrentValue);
        }
        $this->DIRUJUK_OLEH->EditValue = $this->DIRUJUK_OLEH->CurrentValue;
        $this->DIRUJUK_OLEH->PlaceHolder = RemoveHtml($this->DIRUJUK_OLEH->caption());

        // INSPECTION_DATE
        $this->INSPECTION_DATE->EditAttrs["class"] = "form-control";
        $this->INSPECTION_DATE->EditCustomAttributes = "";
        $this->INSPECTION_DATE->EditValue = FormatDateTime($this->INSPECTION_DATE->CurrentValue, 8);
        $this->INSPECTION_DATE->PlaceHolder = RemoveHtml($this->INSPECTION_DATE->caption());

        // PORSIO
        $this->PORSIO->EditAttrs["class"] = "form-control";
        $this->PORSIO->EditCustomAttributes = "";
        if (!$this->PORSIO->Raw) {
            $this->PORSIO->CurrentValue = HtmlDecode($this->PORSIO->CurrentValue);
        }
        $this->PORSIO->EditValue = $this->PORSIO->CurrentValue;
        $this->PORSIO->PlaceHolder = RemoveHtml($this->PORSIO->caption());

        // PEMBUKAAN
        $this->PEMBUKAAN->EditAttrs["class"] = "form-control";
        $this->PEMBUKAAN->EditCustomAttributes = "";
        if (!$this->PEMBUKAAN->Raw) {
            $this->PEMBUKAAN->CurrentValue = HtmlDecode($this->PEMBUKAAN->CurrentValue);
        }
        $this->PEMBUKAAN->EditValue = $this->PEMBUKAAN->CurrentValue;
        $this->PEMBUKAAN->PlaceHolder = RemoveHtml($this->PEMBUKAAN->caption());

        // KETUBAN
        $this->KETUBAN->EditAttrs["class"] = "form-control";
        $this->KETUBAN->EditCustomAttributes = "";
        if (!$this->KETUBAN->Raw) {
            $this->KETUBAN->CurrentValue = HtmlDecode($this->KETUBAN->CurrentValue);
        }
        $this->KETUBAN->EditValue = $this->KETUBAN->CurrentValue;
        $this->KETUBAN->PlaceHolder = RemoveHtml($this->KETUBAN->caption());

        // PRESENTASI
        $this->PRESENTASI->EditAttrs["class"] = "form-control";
        $this->PRESENTASI->EditCustomAttributes = "";
        if (!$this->PRESENTASI->Raw) {
            $this->PRESENTASI->CurrentValue = HtmlDecode($this->PRESENTASI->CurrentValue);
        }
        $this->PRESENTASI->EditValue = $this->PRESENTASI->CurrentValue;
        $this->PRESENTASI->PlaceHolder = RemoveHtml($this->PRESENTASI->caption());

        // POSISI
        $this->POSISI->EditAttrs["class"] = "form-control";
        $this->POSISI->EditCustomAttributes = "";
        if (!$this->POSISI->Raw) {
            $this->POSISI->CurrentValue = HtmlDecode($this->POSISI->CurrentValue);
        }
        $this->POSISI->EditValue = $this->POSISI->CurrentValue;
        $this->POSISI->PlaceHolder = RemoveHtml($this->POSISI->caption());

        // PENURUNAN
        $this->PENURUNAN->EditAttrs["class"] = "form-control";
        $this->PENURUNAN->EditCustomAttributes = "";
        if (!$this->PENURUNAN->Raw) {
            $this->PENURUNAN->CurrentValue = HtmlDecode($this->PENURUNAN->CurrentValue);
        }
        $this->PENURUNAN->EditValue = $this->PENURUNAN->CurrentValue;
        $this->PENURUNAN->PlaceHolder = RemoveHtml($this->PENURUNAN->caption());

        // HEART_ID
        $this->HEART_ID->EditAttrs["class"] = "form-control";
        $this->HEART_ID->EditCustomAttributes = "";
        $this->HEART_ID->EditValue = $this->HEART_ID->CurrentValue;
        $this->HEART_ID->PlaceHolder = RemoveHtml($this->HEART_ID->caption());

        // JANIN_ID
        $this->JANIN_ID->EditAttrs["class"] = "form-control";
        $this->JANIN_ID->EditCustomAttributes = "";
        $this->JANIN_ID->EditValue = $this->JANIN_ID->CurrentValue;
        $this->JANIN_ID->PlaceHolder = RemoveHtml($this->JANIN_ID->caption());

        // FREK_DJJ
        $this->FREK_DJJ->EditAttrs["class"] = "form-control";
        $this->FREK_DJJ->EditCustomAttributes = "";
        $this->FREK_DJJ->EditValue = $this->FREK_DJJ->CurrentValue;
        $this->FREK_DJJ->PlaceHolder = RemoveHtml($this->FREK_DJJ->caption());
        if (strval($this->FREK_DJJ->EditValue) != "" && is_numeric($this->FREK_DJJ->EditValue)) {
            $this->FREK_DJJ->EditValue = FormatNumber($this->FREK_DJJ->EditValue, -2, -2, -2, -2);
        }

        // PLACENTA
        $this->PLACENTA->EditAttrs["class"] = "form-control";
        $this->PLACENTA->EditCustomAttributes = "";
        if (!$this->PLACENTA->Raw) {
            $this->PLACENTA->CurrentValue = HtmlDecode($this->PLACENTA->CurrentValue);
        }
        $this->PLACENTA->EditValue = $this->PLACENTA->CurrentValue;
        $this->PLACENTA->PlaceHolder = RemoveHtml($this->PLACENTA->caption());

        // LOCHIA
        $this->LOCHIA->EditAttrs["class"] = "form-control";
        $this->LOCHIA->EditCustomAttributes = "";
        if (!$this->LOCHIA->Raw) {
            $this->LOCHIA->CurrentValue = HtmlDecode($this->LOCHIA->CurrentValue);
        }
        $this->LOCHIA->EditValue = $this->LOCHIA->CurrentValue;
        $this->LOCHIA->PlaceHolder = RemoveHtml($this->LOCHIA->caption());

        // BAB_TYPE
        $this->BAB_TYPE->EditAttrs["class"] = "form-control";
        $this->BAB_TYPE->EditCustomAttributes = "";
        $this->BAB_TYPE->EditValue = $this->BAB_TYPE->CurrentValue;
        $this->BAB_TYPE->PlaceHolder = RemoveHtml($this->BAB_TYPE->caption());

        // BAB_BAB_TYPE
        $this->BAB_BAB_TYPE->EditAttrs["class"] = "form-control";
        $this->BAB_BAB_TYPE->EditCustomAttributes = "";
        $this->BAB_BAB_TYPE->EditValue = $this->BAB_BAB_TYPE->CurrentValue;
        $this->BAB_BAB_TYPE->PlaceHolder = RemoveHtml($this->BAB_BAB_TYPE->caption());

        // RAHIM_ID
        $this->RAHIM_ID->EditAttrs["class"] = "form-control";
        $this->RAHIM_ID->EditCustomAttributes = "";
        if (!$this->RAHIM_ID->Raw) {
            $this->RAHIM_ID->CurrentValue = HtmlDecode($this->RAHIM_ID->CurrentValue);
        }
        $this->RAHIM_ID->EditValue = $this->RAHIM_ID->CurrentValue;
        $this->RAHIM_ID->PlaceHolder = RemoveHtml($this->RAHIM_ID->caption());

        // BIR_RAHIM_ID
        $this->BIR_RAHIM_ID->EditAttrs["class"] = "form-control";
        $this->BIR_RAHIM_ID->EditCustomAttributes = "";
        if (!$this->BIR_RAHIM_ID->Raw) {
            $this->BIR_RAHIM_ID->CurrentValue = HtmlDecode($this->BIR_RAHIM_ID->CurrentValue);
        }
        $this->BIR_RAHIM_ID->EditValue = $this->BIR_RAHIM_ID->CurrentValue;
        $this->BIR_RAHIM_ID->PlaceHolder = RemoveHtml($this->BIR_RAHIM_ID->caption());

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

        // BLOODING
        $this->BLOODING->EditAttrs["class"] = "form-control";
        $this->BLOODING->EditCustomAttributes = "";
        if (!$this->BLOODING->Raw) {
            $this->BLOODING->CurrentValue = HtmlDecode($this->BLOODING->CurrentValue);
        }
        $this->BLOODING->EditValue = $this->BLOODING->CurrentValue;
        $this->BLOODING->PlaceHolder = RemoveHtml($this->BLOODING->caption());

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

        // RAHIM_SALIN
        $this->RAHIM_SALIN->EditAttrs["class"] = "form-control";
        $this->RAHIM_SALIN->EditCustomAttributes = "";
        if (!$this->RAHIM_SALIN->Raw) {
            $this->RAHIM_SALIN->CurrentValue = HtmlDecode($this->RAHIM_SALIN->CurrentValue);
        }
        $this->RAHIM_SALIN->EditValue = $this->RAHIM_SALIN->CurrentValue;
        $this->RAHIM_SALIN->PlaceHolder = RemoveHtml($this->RAHIM_SALIN->caption());

        // RAHIM_NIFAS
        $this->RAHIM_NIFAS->EditAttrs["class"] = "form-control";
        $this->RAHIM_NIFAS->EditCustomAttributes = "";
        if (!$this->RAHIM_NIFAS->Raw) {
            $this->RAHIM_NIFAS->CurrentValue = HtmlDecode($this->RAHIM_NIFAS->CurrentValue);
        }
        $this->RAHIM_NIFAS->EditValue = $this->RAHIM_NIFAS->CurrentValue;
        $this->RAHIM_NIFAS->PlaceHolder = RemoveHtml($this->RAHIM_NIFAS->caption());

        // BAK_TYPE
        $this->BAK_TYPE->EditAttrs["class"] = "form-control";
        $this->BAK_TYPE->EditCustomAttributes = "";
        $this->BAK_TYPE->EditValue = $this->BAK_TYPE->CurrentValue;
        $this->BAK_TYPE->PlaceHolder = RemoveHtml($this->BAK_TYPE->caption());

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

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

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

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        if (!$this->GENDER->Raw) {
            $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
        }
        $this->GENDER->EditValue = $this->GENDER->CurrentValue;
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

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

        // DOCTOR
        $this->DOCTOR->EditAttrs["class"] = "form-control";
        $this->DOCTOR->EditCustomAttributes = "";
        if (!$this->DOCTOR->Raw) {
            $this->DOCTOR->CurrentValue = HtmlDecode($this->DOCTOR->CurrentValue);
        }
        $this->DOCTOR->EditValue = $this->DOCTOR->CurrentValue;
        $this->DOCTOR->PlaceHolder = RemoveHtml($this->DOCTOR->caption());

        // NB_OBSTETRI
        $this->NB_OBSTETRI->EditAttrs["class"] = "form-control";
        $this->NB_OBSTETRI->EditCustomAttributes = "";
        $this->NB_OBSTETRI->EditValue = $this->NB_OBSTETRI->CurrentValue;
        $this->NB_OBSTETRI->PlaceHolder = RemoveHtml($this->NB_OBSTETRI->caption());

        // OBSTETRI_DIE
        $this->OBSTETRI_DIE->EditAttrs["class"] = "form-control";
        $this->OBSTETRI_DIE->EditCustomAttributes = "";
        $this->OBSTETRI_DIE->EditValue = $this->OBSTETRI_DIE->CurrentValue;
        $this->OBSTETRI_DIE->PlaceHolder = RemoveHtml($this->OBSTETRI_DIE->caption());

        // KAL_ID
        $this->KAL_ID->EditAttrs["class"] = "form-control";
        $this->KAL_ID->EditCustomAttributes = "";
        if (!$this->KAL_ID->Raw) {
            $this->KAL_ID->CurrentValue = HtmlDecode($this->KAL_ID->CurrentValue);
        }
        $this->KAL_ID->EditValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->PlaceHolder = RemoveHtml($this->KAL_ID->caption());

        // DIAGNOSA_ID2
        $this->DIAGNOSA_ID2->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID2->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID2->Raw) {
            $this->DIAGNOSA_ID2->CurrentValue = HtmlDecode($this->DIAGNOSA_ID2->CurrentValue);
        }
        $this->DIAGNOSA_ID2->EditValue = $this->DIAGNOSA_ID2->CurrentValue;
        $this->DIAGNOSA_ID2->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID2->caption());

        // APGAR_ID
        $this->APGAR_ID->EditAttrs["class"] = "form-control";
        $this->APGAR_ID->EditCustomAttributes = "";
        if (!$this->APGAR_ID->Raw) {
            $this->APGAR_ID->CurrentValue = HtmlDecode($this->APGAR_ID->CurrentValue);
        }
        $this->APGAR_ID->EditValue = $this->APGAR_ID->CurrentValue;
        $this->APGAR_ID->PlaceHolder = RemoveHtml($this->APGAR_ID->caption());

        // BIRTH_LAST_ID
        $this->BIRTH_LAST_ID->EditAttrs["class"] = "form-control";
        $this->BIRTH_LAST_ID->EditCustomAttributes = "";
        if (!$this->BIRTH_LAST_ID->Raw) {
            $this->BIRTH_LAST_ID->CurrentValue = HtmlDecode($this->BIRTH_LAST_ID->CurrentValue);
        }
        $this->BIRTH_LAST_ID->EditValue = $this->BIRTH_LAST_ID->CurrentValue;
        $this->BIRTH_LAST_ID->PlaceHolder = RemoveHtml($this->BIRTH_LAST_ID->caption());

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
                    $doc->exportCaption($this->OBSTETRI_ID);
                    $doc->exportCaption($this->HPHT);
                    $doc->exportCaption($this->HTP);
                    $doc->exportCaption($this->PASIEN_DIAGNOSA_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->KOHORT_NB);
                    $doc->exportCaption($this->BIRTH_NB);
                    $doc->exportCaption($this->BIRTH_DURATION);
                    $doc->exportCaption($this->BIRTH_PLACE);
                    $doc->exportCaption($this->ANTE_NATAL);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->BIRTH_WAY);
                    $doc->exportCaption($this->BIRTH_BY);
                    $doc->exportCaption($this->BIRTH_DATE);
                    $doc->exportCaption($this->GESTASI);
                    $doc->exportCaption($this->PARITY);
                    $doc->exportCaption($this->NB_BABY);
                    $doc->exportCaption($this->BABY_DIE);
                    $doc->exportCaption($this->ABORTUS_KE);
                    $doc->exportCaption($this->ABORTUS_ID);
                    $doc->exportCaption($this->ABORTION_DATE);
                    $doc->exportCaption($this->BIRTH_CAT);
                    $doc->exportCaption($this->BIRTH_CON);
                    $doc->exportCaption($this->BIRTH_RISK);
                    $doc->exportCaption($this->RISK_TYPE);
                    $doc->exportCaption($this->FOLLOW_UP);
                    $doc->exportCaption($this->DIRUJUK_OLEH);
                    $doc->exportCaption($this->INSPECTION_DATE);
                    $doc->exportCaption($this->PORSIO);
                    $doc->exportCaption($this->PEMBUKAAN);
                    $doc->exportCaption($this->KETUBAN);
                    $doc->exportCaption($this->PRESENTASI);
                    $doc->exportCaption($this->POSISI);
                    $doc->exportCaption($this->PENURUNAN);
                    $doc->exportCaption($this->HEART_ID);
                    $doc->exportCaption($this->JANIN_ID);
                    $doc->exportCaption($this->FREK_DJJ);
                    $doc->exportCaption($this->PLACENTA);
                    $doc->exportCaption($this->LOCHIA);
                    $doc->exportCaption($this->BAB_TYPE);
                    $doc->exportCaption($this->BAB_BAB_TYPE);
                    $doc->exportCaption($this->RAHIM_ID);
                    $doc->exportCaption($this->BIR_RAHIM_ID);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->BLOODING);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->RAHIM_SALIN);
                    $doc->exportCaption($this->RAHIM_NIFAS);
                    $doc->exportCaption($this->BAK_TYPE);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->NB_OBSTETRI);
                    $doc->exportCaption($this->OBSTETRI_DIE);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID2);
                    $doc->exportCaption($this->APGAR_ID);
                    $doc->exportCaption($this->BIRTH_LAST_ID);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->OBSTETRI_ID);
                    $doc->exportCaption($this->HPHT);
                    $doc->exportCaption($this->HTP);
                    $doc->exportCaption($this->PASIEN_DIAGNOSA_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->KOHORT_NB);
                    $doc->exportCaption($this->BIRTH_NB);
                    $doc->exportCaption($this->BIRTH_DURATION);
                    $doc->exportCaption($this->BIRTH_PLACE);
                    $doc->exportCaption($this->ANTE_NATAL);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->BIRTH_WAY);
                    $doc->exportCaption($this->BIRTH_BY);
                    $doc->exportCaption($this->BIRTH_DATE);
                    $doc->exportCaption($this->GESTASI);
                    $doc->exportCaption($this->PARITY);
                    $doc->exportCaption($this->NB_BABY);
                    $doc->exportCaption($this->BABY_DIE);
                    $doc->exportCaption($this->ABORTUS_KE);
                    $doc->exportCaption($this->ABORTUS_ID);
                    $doc->exportCaption($this->ABORTION_DATE);
                    $doc->exportCaption($this->BIRTH_CAT);
                    $doc->exportCaption($this->BIRTH_CON);
                    $doc->exportCaption($this->BIRTH_RISK);
                    $doc->exportCaption($this->RISK_TYPE);
                    $doc->exportCaption($this->FOLLOW_UP);
                    $doc->exportCaption($this->DIRUJUK_OLEH);
                    $doc->exportCaption($this->INSPECTION_DATE);
                    $doc->exportCaption($this->PORSIO);
                    $doc->exportCaption($this->PEMBUKAAN);
                    $doc->exportCaption($this->KETUBAN);
                    $doc->exportCaption($this->PRESENTASI);
                    $doc->exportCaption($this->POSISI);
                    $doc->exportCaption($this->PENURUNAN);
                    $doc->exportCaption($this->HEART_ID);
                    $doc->exportCaption($this->JANIN_ID);
                    $doc->exportCaption($this->FREK_DJJ);
                    $doc->exportCaption($this->PLACENTA);
                    $doc->exportCaption($this->LOCHIA);
                    $doc->exportCaption($this->BAB_TYPE);
                    $doc->exportCaption($this->BAB_BAB_TYPE);
                    $doc->exportCaption($this->RAHIM_ID);
                    $doc->exportCaption($this->BIR_RAHIM_ID);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->BLOODING);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->RAHIM_SALIN);
                    $doc->exportCaption($this->RAHIM_NIFAS);
                    $doc->exportCaption($this->BAK_TYPE);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->AGEYEAR);
                    $doc->exportCaption($this->AGEMONTH);
                    $doc->exportCaption($this->AGEDAY);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->BED_ID);
                    $doc->exportCaption($this->KELUAR_ID);
                    $doc->exportCaption($this->DOCTOR);
                    $doc->exportCaption($this->NB_OBSTETRI);
                    $doc->exportCaption($this->OBSTETRI_DIE);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID2);
                    $doc->exportCaption($this->APGAR_ID);
                    $doc->exportCaption($this->BIRTH_LAST_ID);
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
                        $doc->exportField($this->OBSTETRI_ID);
                        $doc->exportField($this->HPHT);
                        $doc->exportField($this->HTP);
                        $doc->exportField($this->PASIEN_DIAGNOSA_ID);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->KOHORT_NB);
                        $doc->exportField($this->BIRTH_NB);
                        $doc->exportField($this->BIRTH_DURATION);
                        $doc->exportField($this->BIRTH_PLACE);
                        $doc->exportField($this->ANTE_NATAL);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->BIRTH_WAY);
                        $doc->exportField($this->BIRTH_BY);
                        $doc->exportField($this->BIRTH_DATE);
                        $doc->exportField($this->GESTASI);
                        $doc->exportField($this->PARITY);
                        $doc->exportField($this->NB_BABY);
                        $doc->exportField($this->BABY_DIE);
                        $doc->exportField($this->ABORTUS_KE);
                        $doc->exportField($this->ABORTUS_ID);
                        $doc->exportField($this->ABORTION_DATE);
                        $doc->exportField($this->BIRTH_CAT);
                        $doc->exportField($this->BIRTH_CON);
                        $doc->exportField($this->BIRTH_RISK);
                        $doc->exportField($this->RISK_TYPE);
                        $doc->exportField($this->FOLLOW_UP);
                        $doc->exportField($this->DIRUJUK_OLEH);
                        $doc->exportField($this->INSPECTION_DATE);
                        $doc->exportField($this->PORSIO);
                        $doc->exportField($this->PEMBUKAAN);
                        $doc->exportField($this->KETUBAN);
                        $doc->exportField($this->PRESENTASI);
                        $doc->exportField($this->POSISI);
                        $doc->exportField($this->PENURUNAN);
                        $doc->exportField($this->HEART_ID);
                        $doc->exportField($this->JANIN_ID);
                        $doc->exportField($this->FREK_DJJ);
                        $doc->exportField($this->PLACENTA);
                        $doc->exportField($this->LOCHIA);
                        $doc->exportField($this->BAB_TYPE);
                        $doc->exportField($this->BAB_BAB_TYPE);
                        $doc->exportField($this->RAHIM_ID);
                        $doc->exportField($this->BIR_RAHIM_ID);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->BLOODING);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->RAHIM_SALIN);
                        $doc->exportField($this->RAHIM_NIFAS);
                        $doc->exportField($this->BAK_TYPE);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->NB_OBSTETRI);
                        $doc->exportField($this->OBSTETRI_DIE);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->DIAGNOSA_ID2);
                        $doc->exportField($this->APGAR_ID);
                        $doc->exportField($this->BIRTH_LAST_ID);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->OBSTETRI_ID);
                        $doc->exportField($this->HPHT);
                        $doc->exportField($this->HTP);
                        $doc->exportField($this->PASIEN_DIAGNOSA_ID);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->KOHORT_NB);
                        $doc->exportField($this->BIRTH_NB);
                        $doc->exportField($this->BIRTH_DURATION);
                        $doc->exportField($this->BIRTH_PLACE);
                        $doc->exportField($this->ANTE_NATAL);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->BIRTH_WAY);
                        $doc->exportField($this->BIRTH_BY);
                        $doc->exportField($this->BIRTH_DATE);
                        $doc->exportField($this->GESTASI);
                        $doc->exportField($this->PARITY);
                        $doc->exportField($this->NB_BABY);
                        $doc->exportField($this->BABY_DIE);
                        $doc->exportField($this->ABORTUS_KE);
                        $doc->exportField($this->ABORTUS_ID);
                        $doc->exportField($this->ABORTION_DATE);
                        $doc->exportField($this->BIRTH_CAT);
                        $doc->exportField($this->BIRTH_CON);
                        $doc->exportField($this->BIRTH_RISK);
                        $doc->exportField($this->RISK_TYPE);
                        $doc->exportField($this->FOLLOW_UP);
                        $doc->exportField($this->DIRUJUK_OLEH);
                        $doc->exportField($this->INSPECTION_DATE);
                        $doc->exportField($this->PORSIO);
                        $doc->exportField($this->PEMBUKAAN);
                        $doc->exportField($this->KETUBAN);
                        $doc->exportField($this->PRESENTASI);
                        $doc->exportField($this->POSISI);
                        $doc->exportField($this->PENURUNAN);
                        $doc->exportField($this->HEART_ID);
                        $doc->exportField($this->JANIN_ID);
                        $doc->exportField($this->FREK_DJJ);
                        $doc->exportField($this->PLACENTA);
                        $doc->exportField($this->LOCHIA);
                        $doc->exportField($this->BAB_TYPE);
                        $doc->exportField($this->BAB_BAB_TYPE);
                        $doc->exportField($this->RAHIM_ID);
                        $doc->exportField($this->BIR_RAHIM_ID);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->BLOODING);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->RAHIM_SALIN);
                        $doc->exportField($this->RAHIM_NIFAS);
                        $doc->exportField($this->BAK_TYPE);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->AGEYEAR);
                        $doc->exportField($this->AGEMONTH);
                        $doc->exportField($this->AGEDAY);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->BED_ID);
                        $doc->exportField($this->KELUAR_ID);
                        $doc->exportField($this->DOCTOR);
                        $doc->exportField($this->NB_OBSTETRI);
                        $doc->exportField($this->OBSTETRI_DIE);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->DIAGNOSA_ID2);
                        $doc->exportField($this->APGAR_ID);
                        $doc->exportField($this->BIRTH_LAST_ID);
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
