<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for FAMILY
 */
class Family extends DbTable
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
    public $FAMILY_ID;
    public $FAMILY_STATUS_ID;
    public $NO_REGISTRATION2;
    public $FULLNAME;
    public $ISRESPONSIBLE;
    public $GENDER;
    public $DATE_OF_BIRTH;
    public $PLACE_OF_BIRTH;
    public $KODE_AGAMA;
    public $EDUCATION_TYPE_CODE;
    public $JOB_ID;
    public $BLOOD_ID;
    public $MARITALSTATUSID;
    public $ADDRESS;
    public $KOTA;
    public $RT;
    public $RW;
    public $PHONE;
    public $MOBILE;
    public $FAX;
    public $_EMAIL;
    public $DESCRIPTION;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $COUNTRY_CODE;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'FAMILY';
        $this->TableName = 'FAMILY';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[FAMILY]";
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
        $this->ORG_UNIT_CODE = new DbField('FAMILY', 'FAMILY', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('FAMILY', 'FAMILY', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->IsPrimaryKey = true; // Primary key field
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // FAMILY_ID
        $this->FAMILY_ID = new DbField('FAMILY', 'FAMILY', 'x_FAMILY_ID', 'FAMILY_ID', '[FAMILY_ID]', 'CAST([FAMILY_ID] AS NVARCHAR)', 17, 1, -1, false, '[FAMILY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAMILY_ID->IsPrimaryKey = true; // Primary key field
        $this->FAMILY_ID->Nullable = false; // NOT NULL field
        $this->FAMILY_ID->Required = true; // Required field
        $this->FAMILY_ID->Sortable = true; // Allow sort
        $this->FAMILY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FAMILY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAMILY_ID->Param, "CustomMsg");
        $this->Fields['FAMILY_ID'] = &$this->FAMILY_ID;

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID = new DbField('FAMILY', 'FAMILY', 'x_FAMILY_STATUS_ID', 'FAMILY_STATUS_ID', '[FAMILY_STATUS_ID]', 'CAST([FAMILY_STATUS_ID] AS NVARCHAR)', 17, 1, -1, false, '[FAMILY_STATUS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAMILY_STATUS_ID->Sortable = true; // Allow sort
        $this->FAMILY_STATUS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FAMILY_STATUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAMILY_STATUS_ID->Param, "CustomMsg");
        $this->Fields['FAMILY_STATUS_ID'] = &$this->FAMILY_STATUS_ID;

        // NO_REGISTRATION2
        $this->NO_REGISTRATION2 = new DbField('FAMILY', 'FAMILY', 'x_NO_REGISTRATION2', 'NO_REGISTRATION2', '[NO_REGISTRATION2]', '[NO_REGISTRATION2]', 200, 50, -1, false, '[NO_REGISTRATION2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION2->Sortable = true; // Allow sort
        $this->NO_REGISTRATION2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION2->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION2'] = &$this->NO_REGISTRATION2;

        // FULLNAME
        $this->FULLNAME = new DbField('FAMILY', 'FAMILY', 'x_FULLNAME', 'FULLNAME', '[FULLNAME]', '[FULLNAME]', 200, 200, -1, false, '[FULLNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FULLNAME->Sortable = true; // Allow sort
        $this->FULLNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FULLNAME->Param, "CustomMsg");
        $this->Fields['FULLNAME'] = &$this->FULLNAME;

        // ISRESPONSIBLE
        $this->ISRESPONSIBLE = new DbField('FAMILY', 'FAMILY', 'x_ISRESPONSIBLE', 'ISRESPONSIBLE', '[ISRESPONSIBLE]', '[ISRESPONSIBLE]', 129, 1, -1, false, '[ISRESPONSIBLE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRESPONSIBLE->Sortable = true; // Allow sort
        $this->ISRESPONSIBLE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRESPONSIBLE->Param, "CustomMsg");
        $this->Fields['ISRESPONSIBLE'] = &$this->ISRESPONSIBLE;

        // GENDER
        $this->GENDER = new DbField('FAMILY', 'FAMILY', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH = new DbField('FAMILY', 'FAMILY', 'x_DATE_OF_BIRTH', 'DATE_OF_BIRTH', '[DATE_OF_BIRTH]', CastDateFieldForLike("[DATE_OF_BIRTH]", 0, "DB"), 135, 8, 0, false, '[DATE_OF_BIRTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DATE_OF_BIRTH->Sortable = true; // Allow sort
        $this->DATE_OF_BIRTH->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DATE_OF_BIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DATE_OF_BIRTH->Param, "CustomMsg");
        $this->Fields['DATE_OF_BIRTH'] = &$this->DATE_OF_BIRTH;

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH = new DbField('FAMILY', 'FAMILY', 'x_PLACE_OF_BIRTH', 'PLACE_OF_BIRTH', '[PLACE_OF_BIRTH]', '[PLACE_OF_BIRTH]', 200, 50, -1, false, '[PLACE_OF_BIRTH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PLACE_OF_BIRTH->Sortable = true; // Allow sort
        $this->PLACE_OF_BIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PLACE_OF_BIRTH->Param, "CustomMsg");
        $this->Fields['PLACE_OF_BIRTH'] = &$this->PLACE_OF_BIRTH;

        // KODE_AGAMA
        $this->KODE_AGAMA = new DbField('FAMILY', 'FAMILY', 'x_KODE_AGAMA', 'KODE_AGAMA', '[KODE_AGAMA]', 'CAST([KODE_AGAMA] AS NVARCHAR)', 17, 1, -1, false, '[KODE_AGAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODE_AGAMA->Sortable = true; // Allow sort
        $this->KODE_AGAMA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KODE_AGAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE_AGAMA->Param, "CustomMsg");
        $this->Fields['KODE_AGAMA'] = &$this->KODE_AGAMA;

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE = new DbField('FAMILY', 'FAMILY', 'x_EDUCATION_TYPE_CODE', 'EDUCATION_TYPE_CODE', '[EDUCATION_TYPE_CODE]', 'CAST([EDUCATION_TYPE_CODE] AS NVARCHAR)', 17, 1, -1, false, '[EDUCATION_TYPE_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EDUCATION_TYPE_CODE->Sortable = true; // Allow sort
        $this->EDUCATION_TYPE_CODE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->EDUCATION_TYPE_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EDUCATION_TYPE_CODE->Param, "CustomMsg");
        $this->Fields['EDUCATION_TYPE_CODE'] = &$this->EDUCATION_TYPE_CODE;

        // JOB_ID
        $this->JOB_ID = new DbField('FAMILY', 'FAMILY', 'x_JOB_ID', 'JOB_ID', '[JOB_ID]', 'CAST([JOB_ID] AS NVARCHAR)', 17, 1, -1, false, '[JOB_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JOB_ID->Sortable = true; // Allow sort
        $this->JOB_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->JOB_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JOB_ID->Param, "CustomMsg");
        $this->Fields['JOB_ID'] = &$this->JOB_ID;

        // BLOOD_ID
        $this->BLOOD_ID = new DbField('FAMILY', 'FAMILY', 'x_BLOOD_ID', 'BLOOD_ID', '[BLOOD_ID]', 'CAST([BLOOD_ID] AS NVARCHAR)', 17, 1, -1, false, '[BLOOD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BLOOD_ID->Sortable = true; // Allow sort
        $this->BLOOD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->BLOOD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BLOOD_ID->Param, "CustomMsg");
        $this->Fields['BLOOD_ID'] = &$this->BLOOD_ID;

        // MARITALSTATUSID
        $this->MARITALSTATUSID = new DbField('FAMILY', 'FAMILY', 'x_MARITALSTATUSID', 'MARITALSTATUSID', '[MARITALSTATUSID]', 'CAST([MARITALSTATUSID] AS NVARCHAR)', 17, 1, -1, false, '[MARITALSTATUSID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARITALSTATUSID->Sortable = true; // Allow sort
        $this->MARITALSTATUSID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MARITALSTATUSID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARITALSTATUSID->Param, "CustomMsg");
        $this->Fields['MARITALSTATUSID'] = &$this->MARITALSTATUSID;

        // ADDRESS
        $this->ADDRESS = new DbField('FAMILY', 'FAMILY', 'x_ADDRESS', 'ADDRESS', '[ADDRESS]', '[ADDRESS]', 200, 200, -1, false, '[ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ADDRESS->Sortable = true; // Allow sort
        $this->ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ADDRESS->Param, "CustomMsg");
        $this->Fields['ADDRESS'] = &$this->ADDRESS;

        // KOTA
        $this->KOTA = new DbField('FAMILY', 'FAMILY', 'x_KOTA', 'KOTA', '[KOTA]', '[KOTA]', 200, 200, -1, false, '[KOTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KOTA->Sortable = true; // Allow sort
        $this->KOTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KOTA->Param, "CustomMsg");
        $this->Fields['KOTA'] = &$this->KOTA;

        // RT
        $this->RT = new DbField('FAMILY', 'FAMILY', 'x_RT', 'RT', '[RT]', '[RT]', 200, 8, -1, false, '[RT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RT->Sortable = true; // Allow sort
        $this->RT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RT->Param, "CustomMsg");
        $this->Fields['RT'] = &$this->RT;

        // RW
        $this->RW = new DbField('FAMILY', 'FAMILY', 'x_RW', 'RW', '[RW]', '[RW]', 200, 8, -1, false, '[RW]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RW->Sortable = true; // Allow sort
        $this->RW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RW->Param, "CustomMsg");
        $this->Fields['RW'] = &$this->RW;

        // PHONE
        $this->PHONE = new DbField('FAMILY', 'FAMILY', 'x_PHONE', 'PHONE', '[PHONE]', '[PHONE]', 200, 50, -1, false, '[PHONE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE->Sortable = true; // Allow sort
        $this->PHONE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE->Param, "CustomMsg");
        $this->Fields['PHONE'] = &$this->PHONE;

        // MOBILE
        $this->MOBILE = new DbField('FAMILY', 'FAMILY', 'x_MOBILE', 'MOBILE', '[MOBILE]', '[MOBILE]', 200, 50, -1, false, '[MOBILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MOBILE->Sortable = true; // Allow sort
        $this->MOBILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MOBILE->Param, "CustomMsg");
        $this->Fields['MOBILE'] = &$this->MOBILE;

        // FAX
        $this->FAX = new DbField('FAMILY', 'FAMILY', 'x_FAX', 'FAX', '[FAX]', '[FAX]', 200, 50, -1, false, '[FAX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX->Sortable = true; // Allow sort
        $this->FAX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX->Param, "CustomMsg");
        $this->Fields['FAX'] = &$this->FAX;

        // EMAIL
        $this->_EMAIL = new DbField('FAMILY', 'FAMILY', 'x__EMAIL', 'EMAIL', '[EMAIL]', '[EMAIL]', 200, 50, -1, false, '[EMAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_EMAIL->Sortable = true; // Allow sort
        $this->_EMAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_EMAIL->Param, "CustomMsg");
        $this->Fields['EMAIL'] = &$this->_EMAIL;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('FAMILY', 'FAMILY', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 50, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('FAMILY', 'FAMILY', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('FAMILY', 'FAMILY', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('FAMILY', 'FAMILY', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 50, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // COUNTRY_CODE
        $this->COUNTRY_CODE = new DbField('FAMILY', 'FAMILY', 'x_COUNTRY_CODE', 'COUNTRY_CODE', '[COUNTRY_CODE]', '[COUNTRY_CODE]', 200, 8, -1, false, '[COUNTRY_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COUNTRY_CODE->Sortable = true; // Allow sort
        $this->COUNTRY_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COUNTRY_CODE->Param, "CustomMsg");
        $this->Fields['COUNTRY_CODE'] = &$this->COUNTRY_CODE;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[FAMILY]";
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
            if (array_key_exists('FAMILY_ID', $rs)) {
                AddFilter($where, QuotedName('FAMILY_ID', $this->Dbid) . '=' . QuotedValue($rs['FAMILY_ID'], $this->FAMILY_ID->DataType, $this->Dbid));
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
        $this->FAMILY_ID->DbValue = $row['FAMILY_ID'];
        $this->FAMILY_STATUS_ID->DbValue = $row['FAMILY_STATUS_ID'];
        $this->NO_REGISTRATION2->DbValue = $row['NO_REGISTRATION2'];
        $this->FULLNAME->DbValue = $row['FULLNAME'];
        $this->ISRESPONSIBLE->DbValue = $row['ISRESPONSIBLE'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->DATE_OF_BIRTH->DbValue = $row['DATE_OF_BIRTH'];
        $this->PLACE_OF_BIRTH->DbValue = $row['PLACE_OF_BIRTH'];
        $this->KODE_AGAMA->DbValue = $row['KODE_AGAMA'];
        $this->EDUCATION_TYPE_CODE->DbValue = $row['EDUCATION_TYPE_CODE'];
        $this->JOB_ID->DbValue = $row['JOB_ID'];
        $this->BLOOD_ID->DbValue = $row['BLOOD_ID'];
        $this->MARITALSTATUSID->DbValue = $row['MARITALSTATUSID'];
        $this->ADDRESS->DbValue = $row['ADDRESS'];
        $this->KOTA->DbValue = $row['KOTA'];
        $this->RT->DbValue = $row['RT'];
        $this->RW->DbValue = $row['RW'];
        $this->PHONE->DbValue = $row['PHONE'];
        $this->MOBILE->DbValue = $row['MOBILE'];
        $this->FAX->DbValue = $row['FAX'];
        $this->_EMAIL->DbValue = $row['EMAIL'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->COUNTRY_CODE->DbValue = $row['COUNTRY_CODE'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [NO_REGISTRATION] = '@NO_REGISTRATION@' AND [FAMILY_ID] = @FAMILY_ID@";
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
        $val = $current ? $this->FAMILY_ID->CurrentValue : $this->FAMILY_ID->OldValue;
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
                $this->FAMILY_ID->CurrentValue = $keys[2];
            } else {
                $this->FAMILY_ID->OldValue = $keys[2];
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
            $val = array_key_exists('FAMILY_ID', $row) ? $row['FAMILY_ID'] : null;
        } else {
            $val = $this->FAMILY_ID->OldValue !== null ? $this->FAMILY_ID->OldValue : $this->FAMILY_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@FAMILY_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("FamilyList");
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
        if ($pageName == "FamilyView") {
            return $Language->phrase("View");
        } elseif ($pageName == "FamilyEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "FamilyAdd") {
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
                return "FamilyView";
            case Config("API_ADD_ACTION"):
                return "FamilyAdd";
            case Config("API_EDIT_ACTION"):
                return "FamilyEdit";
            case Config("API_DELETE_ACTION"):
                return "FamilyDelete";
            case Config("API_LIST_ACTION"):
                return "FamilyList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "FamilyList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("FamilyView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("FamilyView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "FamilyAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "FamilyAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("FamilyEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("FamilyAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("FamilyDelete", $this->getUrlParm());
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
        $json .= ",FAMILY_ID:" . JsonEncode($this->FAMILY_ID->CurrentValue, "number");
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
        if ($this->FAMILY_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->FAMILY_ID->CurrentValue);
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
            if (($keyValue = Param("FAMILY_ID") ?? Route("FAMILY_ID")) !== null) {
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
                if (!is_numeric($key[2])) { // FAMILY_ID
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
                $this->FAMILY_ID->CurrentValue = $key[2];
            } else {
                $this->FAMILY_ID->OldValue = $key[2];
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
        $this->FAMILY_ID->setDbValue($row['FAMILY_ID']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->NO_REGISTRATION2->setDbValue($row['NO_REGISTRATION2']);
        $this->FULLNAME->setDbValue($row['FULLNAME']);
        $this->ISRESPONSIBLE->setDbValue($row['ISRESPONSIBLE']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->DATE_OF_BIRTH->setDbValue($row['DATE_OF_BIRTH']);
        $this->PLACE_OF_BIRTH->setDbValue($row['PLACE_OF_BIRTH']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->EDUCATION_TYPE_CODE->setDbValue($row['EDUCATION_TYPE_CODE']);
        $this->JOB_ID->setDbValue($row['JOB_ID']);
        $this->BLOOD_ID->setDbValue($row['BLOOD_ID']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->ADDRESS->setDbValue($row['ADDRESS']);
        $this->KOTA->setDbValue($row['KOTA']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->FAX->setDbValue($row['FAX']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->COUNTRY_CODE->setDbValue($row['COUNTRY_CODE']);
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

        // FAMILY_ID

        // FAMILY_STATUS_ID

        // NO_REGISTRATION2

        // FULLNAME

        // ISRESPONSIBLE

        // GENDER

        // DATE_OF_BIRTH

        // PLACE_OF_BIRTH

        // KODE_AGAMA

        // EDUCATION_TYPE_CODE

        // JOB_ID

        // BLOOD_ID

        // MARITALSTATUSID

        // ADDRESS

        // KOTA

        // RT

        // RW

        // PHONE

        // MOBILE

        // FAX

        // EMAIL

        // DESCRIPTION

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // COUNTRY_CODE

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // FAMILY_ID
        $this->FAMILY_ID->ViewValue = $this->FAMILY_ID->CurrentValue;
        $this->FAMILY_ID->ViewValue = FormatNumber($this->FAMILY_ID->ViewValue, 0, -2, -2, -2);
        $this->FAMILY_ID->ViewCustomAttributes = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
        $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

        // NO_REGISTRATION2
        $this->NO_REGISTRATION2->ViewValue = $this->NO_REGISTRATION2->CurrentValue;
        $this->NO_REGISTRATION2->ViewCustomAttributes = "";

        // FULLNAME
        $this->FULLNAME->ViewValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->ViewCustomAttributes = "";

        // ISRESPONSIBLE
        $this->ISRESPONSIBLE->ViewValue = $this->ISRESPONSIBLE->CurrentValue;
        $this->ISRESPONSIBLE->ViewCustomAttributes = "";

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->ViewValue = $this->DATE_OF_BIRTH->CurrentValue;
        $this->DATE_OF_BIRTH->ViewValue = FormatDateTime($this->DATE_OF_BIRTH->ViewValue, 0);
        $this->DATE_OF_BIRTH->ViewCustomAttributes = "";

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->ViewValue = $this->PLACE_OF_BIRTH->CurrentValue;
        $this->PLACE_OF_BIRTH->ViewCustomAttributes = "";

        // KODE_AGAMA
        $this->KODE_AGAMA->ViewValue = $this->KODE_AGAMA->CurrentValue;
        $this->KODE_AGAMA->ViewValue = FormatNumber($this->KODE_AGAMA->ViewValue, 0, -2, -2, -2);
        $this->KODE_AGAMA->ViewCustomAttributes = "";

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->ViewValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
        $this->EDUCATION_TYPE_CODE->ViewValue = FormatNumber($this->EDUCATION_TYPE_CODE->ViewValue, 0, -2, -2, -2);
        $this->EDUCATION_TYPE_CODE->ViewCustomAttributes = "";

        // JOB_ID
        $this->JOB_ID->ViewValue = $this->JOB_ID->CurrentValue;
        $this->JOB_ID->ViewValue = FormatNumber($this->JOB_ID->ViewValue, 0, -2, -2, -2);
        $this->JOB_ID->ViewCustomAttributes = "";

        // BLOOD_ID
        $this->BLOOD_ID->ViewValue = $this->BLOOD_ID->CurrentValue;
        $this->BLOOD_ID->ViewValue = FormatNumber($this->BLOOD_ID->ViewValue, 0, -2, -2, -2);
        $this->BLOOD_ID->ViewCustomAttributes = "";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
        $this->MARITALSTATUSID->ViewValue = FormatNumber($this->MARITALSTATUSID->ViewValue, 0, -2, -2, -2);
        $this->MARITALSTATUSID->ViewCustomAttributes = "";

        // ADDRESS
        $this->ADDRESS->ViewValue = $this->ADDRESS->CurrentValue;
        $this->ADDRESS->ViewCustomAttributes = "";

        // KOTA
        $this->KOTA->ViewValue = $this->KOTA->CurrentValue;
        $this->KOTA->ViewCustomAttributes = "";

        // RT
        $this->RT->ViewValue = $this->RT->CurrentValue;
        $this->RT->ViewCustomAttributes = "";

        // RW
        $this->RW->ViewValue = $this->RW->CurrentValue;
        $this->RW->ViewCustomAttributes = "";

        // PHONE
        $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
        $this->PHONE->ViewCustomAttributes = "";

        // MOBILE
        $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->ViewCustomAttributes = "";

        // FAX
        $this->FAX->ViewValue = $this->FAX->CurrentValue;
        $this->FAX->ViewCustomAttributes = "";

        // EMAIL
        $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->ViewCustomAttributes = "";

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

        // COUNTRY_CODE
        $this->COUNTRY_CODE->ViewValue = $this->COUNTRY_CODE->CurrentValue;
        $this->COUNTRY_CODE->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // FAMILY_ID
        $this->FAMILY_ID->LinkCustomAttributes = "";
        $this->FAMILY_ID->HrefValue = "";
        $this->FAMILY_ID->TooltipValue = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
        $this->FAMILY_STATUS_ID->HrefValue = "";
        $this->FAMILY_STATUS_ID->TooltipValue = "";

        // NO_REGISTRATION2
        $this->NO_REGISTRATION2->LinkCustomAttributes = "";
        $this->NO_REGISTRATION2->HrefValue = "";
        $this->NO_REGISTRATION2->TooltipValue = "";

        // FULLNAME
        $this->FULLNAME->LinkCustomAttributes = "";
        $this->FULLNAME->HrefValue = "";
        $this->FULLNAME->TooltipValue = "";

        // ISRESPONSIBLE
        $this->ISRESPONSIBLE->LinkCustomAttributes = "";
        $this->ISRESPONSIBLE->HrefValue = "";
        $this->ISRESPONSIBLE->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->LinkCustomAttributes = "";
        $this->DATE_OF_BIRTH->HrefValue = "";
        $this->DATE_OF_BIRTH->TooltipValue = "";

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->LinkCustomAttributes = "";
        $this->PLACE_OF_BIRTH->HrefValue = "";
        $this->PLACE_OF_BIRTH->TooltipValue = "";

        // KODE_AGAMA
        $this->KODE_AGAMA->LinkCustomAttributes = "";
        $this->KODE_AGAMA->HrefValue = "";
        $this->KODE_AGAMA->TooltipValue = "";

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->LinkCustomAttributes = "";
        $this->EDUCATION_TYPE_CODE->HrefValue = "";
        $this->EDUCATION_TYPE_CODE->TooltipValue = "";

        // JOB_ID
        $this->JOB_ID->LinkCustomAttributes = "";
        $this->JOB_ID->HrefValue = "";
        $this->JOB_ID->TooltipValue = "";

        // BLOOD_ID
        $this->BLOOD_ID->LinkCustomAttributes = "";
        $this->BLOOD_ID->HrefValue = "";
        $this->BLOOD_ID->TooltipValue = "";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->LinkCustomAttributes = "";
        $this->MARITALSTATUSID->HrefValue = "";
        $this->MARITALSTATUSID->TooltipValue = "";

        // ADDRESS
        $this->ADDRESS->LinkCustomAttributes = "";
        $this->ADDRESS->HrefValue = "";
        $this->ADDRESS->TooltipValue = "";

        // KOTA
        $this->KOTA->LinkCustomAttributes = "";
        $this->KOTA->HrefValue = "";
        $this->KOTA->TooltipValue = "";

        // RT
        $this->RT->LinkCustomAttributes = "";
        $this->RT->HrefValue = "";
        $this->RT->TooltipValue = "";

        // RW
        $this->RW->LinkCustomAttributes = "";
        $this->RW->HrefValue = "";
        $this->RW->TooltipValue = "";

        // PHONE
        $this->PHONE->LinkCustomAttributes = "";
        $this->PHONE->HrefValue = "";
        $this->PHONE->TooltipValue = "";

        // MOBILE
        $this->MOBILE->LinkCustomAttributes = "";
        $this->MOBILE->HrefValue = "";
        $this->MOBILE->TooltipValue = "";

        // FAX
        $this->FAX->LinkCustomAttributes = "";
        $this->FAX->HrefValue = "";
        $this->FAX->TooltipValue = "";

        // EMAIL
        $this->_EMAIL->LinkCustomAttributes = "";
        $this->_EMAIL->HrefValue = "";
        $this->_EMAIL->TooltipValue = "";

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

        // COUNTRY_CODE
        $this->COUNTRY_CODE->LinkCustomAttributes = "";
        $this->COUNTRY_CODE->HrefValue = "";
        $this->COUNTRY_CODE->TooltipValue = "";

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

        // FAMILY_ID
        $this->FAMILY_ID->EditAttrs["class"] = "form-control";
        $this->FAMILY_ID->EditCustomAttributes = "";
        $this->FAMILY_ID->EditValue = $this->FAMILY_ID->CurrentValue;
        $this->FAMILY_ID->PlaceHolder = RemoveHtml($this->FAMILY_ID->caption());

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->EditAttrs["class"] = "form-control";
        $this->FAMILY_STATUS_ID->EditCustomAttributes = "";
        $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->PlaceHolder = RemoveHtml($this->FAMILY_STATUS_ID->caption());

        // NO_REGISTRATION2
        $this->NO_REGISTRATION2->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION2->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION2->Raw) {
            $this->NO_REGISTRATION2->CurrentValue = HtmlDecode($this->NO_REGISTRATION2->CurrentValue);
        }
        $this->NO_REGISTRATION2->EditValue = $this->NO_REGISTRATION2->CurrentValue;
        $this->NO_REGISTRATION2->PlaceHolder = RemoveHtml($this->NO_REGISTRATION2->caption());

        // FULLNAME
        $this->FULLNAME->EditAttrs["class"] = "form-control";
        $this->FULLNAME->EditCustomAttributes = "";
        if (!$this->FULLNAME->Raw) {
            $this->FULLNAME->CurrentValue = HtmlDecode($this->FULLNAME->CurrentValue);
        }
        $this->FULLNAME->EditValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->PlaceHolder = RemoveHtml($this->FULLNAME->caption());

        // ISRESPONSIBLE
        $this->ISRESPONSIBLE->EditAttrs["class"] = "form-control";
        $this->ISRESPONSIBLE->EditCustomAttributes = "";
        if (!$this->ISRESPONSIBLE->Raw) {
            $this->ISRESPONSIBLE->CurrentValue = HtmlDecode($this->ISRESPONSIBLE->CurrentValue);
        }
        $this->ISRESPONSIBLE->EditValue = $this->ISRESPONSIBLE->CurrentValue;
        $this->ISRESPONSIBLE->PlaceHolder = RemoveHtml($this->ISRESPONSIBLE->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        if (!$this->GENDER->Raw) {
            $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
        }
        $this->GENDER->EditValue = $this->GENDER->CurrentValue;
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // DATE_OF_BIRTH
        $this->DATE_OF_BIRTH->EditAttrs["class"] = "form-control";
        $this->DATE_OF_BIRTH->EditCustomAttributes = "";
        $this->DATE_OF_BIRTH->EditValue = FormatDateTime($this->DATE_OF_BIRTH->CurrentValue, 8);
        $this->DATE_OF_BIRTH->PlaceHolder = RemoveHtml($this->DATE_OF_BIRTH->caption());

        // PLACE_OF_BIRTH
        $this->PLACE_OF_BIRTH->EditAttrs["class"] = "form-control";
        $this->PLACE_OF_BIRTH->EditCustomAttributes = "";
        if (!$this->PLACE_OF_BIRTH->Raw) {
            $this->PLACE_OF_BIRTH->CurrentValue = HtmlDecode($this->PLACE_OF_BIRTH->CurrentValue);
        }
        $this->PLACE_OF_BIRTH->EditValue = $this->PLACE_OF_BIRTH->CurrentValue;
        $this->PLACE_OF_BIRTH->PlaceHolder = RemoveHtml($this->PLACE_OF_BIRTH->caption());

        // KODE_AGAMA
        $this->KODE_AGAMA->EditAttrs["class"] = "form-control";
        $this->KODE_AGAMA->EditCustomAttributes = "";
        $this->KODE_AGAMA->EditValue = $this->KODE_AGAMA->CurrentValue;
        $this->KODE_AGAMA->PlaceHolder = RemoveHtml($this->KODE_AGAMA->caption());

        // EDUCATION_TYPE_CODE
        $this->EDUCATION_TYPE_CODE->EditAttrs["class"] = "form-control";
        $this->EDUCATION_TYPE_CODE->EditCustomAttributes = "";
        $this->EDUCATION_TYPE_CODE->EditValue = $this->EDUCATION_TYPE_CODE->CurrentValue;
        $this->EDUCATION_TYPE_CODE->PlaceHolder = RemoveHtml($this->EDUCATION_TYPE_CODE->caption());

        // JOB_ID
        $this->JOB_ID->EditAttrs["class"] = "form-control";
        $this->JOB_ID->EditCustomAttributes = "";
        $this->JOB_ID->EditValue = $this->JOB_ID->CurrentValue;
        $this->JOB_ID->PlaceHolder = RemoveHtml($this->JOB_ID->caption());

        // BLOOD_ID
        $this->BLOOD_ID->EditAttrs["class"] = "form-control";
        $this->BLOOD_ID->EditCustomAttributes = "";
        $this->BLOOD_ID->EditValue = $this->BLOOD_ID->CurrentValue;
        $this->BLOOD_ID->PlaceHolder = RemoveHtml($this->BLOOD_ID->caption());

        // MARITALSTATUSID
        $this->MARITALSTATUSID->EditAttrs["class"] = "form-control";
        $this->MARITALSTATUSID->EditCustomAttributes = "";
        $this->MARITALSTATUSID->EditValue = $this->MARITALSTATUSID->CurrentValue;
        $this->MARITALSTATUSID->PlaceHolder = RemoveHtml($this->MARITALSTATUSID->caption());

        // ADDRESS
        $this->ADDRESS->EditAttrs["class"] = "form-control";
        $this->ADDRESS->EditCustomAttributes = "";
        if (!$this->ADDRESS->Raw) {
            $this->ADDRESS->CurrentValue = HtmlDecode($this->ADDRESS->CurrentValue);
        }
        $this->ADDRESS->EditValue = $this->ADDRESS->CurrentValue;
        $this->ADDRESS->PlaceHolder = RemoveHtml($this->ADDRESS->caption());

        // KOTA
        $this->KOTA->EditAttrs["class"] = "form-control";
        $this->KOTA->EditCustomAttributes = "";
        if (!$this->KOTA->Raw) {
            $this->KOTA->CurrentValue = HtmlDecode($this->KOTA->CurrentValue);
        }
        $this->KOTA->EditValue = $this->KOTA->CurrentValue;
        $this->KOTA->PlaceHolder = RemoveHtml($this->KOTA->caption());

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

        // PHONE
        $this->PHONE->EditAttrs["class"] = "form-control";
        $this->PHONE->EditCustomAttributes = "";
        if (!$this->PHONE->Raw) {
            $this->PHONE->CurrentValue = HtmlDecode($this->PHONE->CurrentValue);
        }
        $this->PHONE->EditValue = $this->PHONE->CurrentValue;
        $this->PHONE->PlaceHolder = RemoveHtml($this->PHONE->caption());

        // MOBILE
        $this->MOBILE->EditAttrs["class"] = "form-control";
        $this->MOBILE->EditCustomAttributes = "";
        if (!$this->MOBILE->Raw) {
            $this->MOBILE->CurrentValue = HtmlDecode($this->MOBILE->CurrentValue);
        }
        $this->MOBILE->EditValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->PlaceHolder = RemoveHtml($this->MOBILE->caption());

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

        // COUNTRY_CODE
        $this->COUNTRY_CODE->EditAttrs["class"] = "form-control";
        $this->COUNTRY_CODE->EditCustomAttributes = "";
        if (!$this->COUNTRY_CODE->Raw) {
            $this->COUNTRY_CODE->CurrentValue = HtmlDecode($this->COUNTRY_CODE->CurrentValue);
        }
        $this->COUNTRY_CODE->EditValue = $this->COUNTRY_CODE->CurrentValue;
        $this->COUNTRY_CODE->PlaceHolder = RemoveHtml($this->COUNTRY_CODE->caption());

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
                    $doc->exportCaption($this->FAMILY_ID);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->NO_REGISTRATION2);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->ISRESPONSIBLE);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DATE_OF_BIRTH);
                    $doc->exportCaption($this->PLACE_OF_BIRTH);
                    $doc->exportCaption($this->KODE_AGAMA);
                    $doc->exportCaption($this->EDUCATION_TYPE_CODE);
                    $doc->exportCaption($this->JOB_ID);
                    $doc->exportCaption($this->BLOOD_ID);
                    $doc->exportCaption($this->MARITALSTATUSID);
                    $doc->exportCaption($this->ADDRESS);
                    $doc->exportCaption($this->KOTA);
                    $doc->exportCaption($this->RT);
                    $doc->exportCaption($this->RW);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->COUNTRY_CODE);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->FAMILY_ID);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->NO_REGISTRATION2);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->ISRESPONSIBLE);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->DATE_OF_BIRTH);
                    $doc->exportCaption($this->PLACE_OF_BIRTH);
                    $doc->exportCaption($this->KODE_AGAMA);
                    $doc->exportCaption($this->EDUCATION_TYPE_CODE);
                    $doc->exportCaption($this->JOB_ID);
                    $doc->exportCaption($this->BLOOD_ID);
                    $doc->exportCaption($this->MARITALSTATUSID);
                    $doc->exportCaption($this->ADDRESS);
                    $doc->exportCaption($this->KOTA);
                    $doc->exportCaption($this->RT);
                    $doc->exportCaption($this->RW);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->_EMAIL);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->COUNTRY_CODE);
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
                        $doc->exportField($this->FAMILY_ID);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->NO_REGISTRATION2);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->ISRESPONSIBLE);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DATE_OF_BIRTH);
                        $doc->exportField($this->PLACE_OF_BIRTH);
                        $doc->exportField($this->KODE_AGAMA);
                        $doc->exportField($this->EDUCATION_TYPE_CODE);
                        $doc->exportField($this->JOB_ID);
                        $doc->exportField($this->BLOOD_ID);
                        $doc->exportField($this->MARITALSTATUSID);
                        $doc->exportField($this->ADDRESS);
                        $doc->exportField($this->KOTA);
                        $doc->exportField($this->RT);
                        $doc->exportField($this->RW);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->COUNTRY_CODE);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->FAMILY_ID);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->NO_REGISTRATION2);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->ISRESPONSIBLE);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->DATE_OF_BIRTH);
                        $doc->exportField($this->PLACE_OF_BIRTH);
                        $doc->exportField($this->KODE_AGAMA);
                        $doc->exportField($this->EDUCATION_TYPE_CODE);
                        $doc->exportField($this->JOB_ID);
                        $doc->exportField($this->BLOOD_ID);
                        $doc->exportField($this->MARITALSTATUSID);
                        $doc->exportField($this->ADDRESS);
                        $doc->exportField($this->KOTA);
                        $doc->exportField($this->RT);
                        $doc->exportField($this->RW);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->_EMAIL);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->COUNTRY_CODE);
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
