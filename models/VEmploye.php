<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for V_EMPLOYE
 */
class VEmploye extends DbTable
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
    public $EMPLOYEE_ID;
    public $FULLNAME;
    public $GENDER;
    public $MARITALSTATUSID;
    public $MYADDRESS;
    public $RT;
    public $RW;
    public $KAL_ID;
    public $PLACEOFBIRTH;
    public $DATEOFBIRTH;
    public $KODE_AGAMA;
    public $OBJECT_CATEGORY_ID;
    public $STATUS_ID;
    public $EMPLOYEED_DATE;
    public $NONACTIVE;
    public $ISFULLTIME;
    public $NPWP;
    public $NATION_ID;
    public $NONACTIVE_DATE;
    public $SPECIALIST_TYPE_ID;
    public $NPK;
    public $NIP;
    public $DPJP;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'V_EMPLOYE';
        $this->TableName = 'V_EMPLOYE';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "dbo.EMPLOYEE_ALL";
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
        $this->ORG_UNIT_CODE = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', 'dbo.EMPLOYEE_ALL.ORG_UNIT_CODE', 'dbo.EMPLOYEE_ALL.ORG_UNIT_CODE', 200, 50, -1, false, 'dbo.EMPLOYEE_ALL.ORG_UNIT_CODE', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', 'dbo.EMPLOYEE_ALL.EMPLOYEE_ID', 'dbo.EMPLOYEE_ALL.EMPLOYEE_ID', 200, 15, -1, false, 'dbo.EMPLOYEE_ALL.EMPLOYEE_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->IsPrimaryKey = true; // Primary key field
        $this->EMPLOYEE_ID->Nullable = false; // NOT NULL field
        $this->EMPLOYEE_ID->Required = true; // Required field
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // FULLNAME
        $this->FULLNAME = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_FULLNAME', 'FULLNAME', 'dbo.EMPLOYEE_ALL.FULLNAME', 'dbo.EMPLOYEE_ALL.FULLNAME', 200, 50, -1, false, 'dbo.EMPLOYEE_ALL.FULLNAME', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FULLNAME->Sortable = true; // Allow sort
        $this->FULLNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FULLNAME->Param, "CustomMsg");
        $this->Fields['FULLNAME'] = &$this->FULLNAME;

        // GENDER
        $this->GENDER = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_GENDER', 'GENDER', 'dbo.EMPLOYEE_ALL.GENDER', 'dbo.EMPLOYEE_ALL.GENDER', 129, 1, -1, false, 'dbo.EMPLOYEE_ALL.GENDER', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // MARITALSTATUSID
        $this->MARITALSTATUSID = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_MARITALSTATUSID', 'MARITALSTATUSID', 'dbo.EMPLOYEE_ALL.MARITALSTATUSID', 'CAST(dbo.EMPLOYEE_ALL.MARITALSTATUSID AS NVARCHAR)', 17, 1, -1, false, 'dbo.EMPLOYEE_ALL.MARITALSTATUSID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MARITALSTATUSID->Sortable = true; // Allow sort
        $this->MARITALSTATUSID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MARITALSTATUSID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MARITALSTATUSID->Param, "CustomMsg");
        $this->Fields['MARITALSTATUSID'] = &$this->MARITALSTATUSID;

        // MYADDRESS
        $this->MYADDRESS = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_MYADDRESS', 'MYADDRESS', 'dbo.EMPLOYEE_ALL.MYADDRESS', 'dbo.EMPLOYEE_ALL.MYADDRESS', 200, 200, -1, false, 'dbo.EMPLOYEE_ALL.MYADDRESS', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MYADDRESS->Sortable = true; // Allow sort
        $this->MYADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MYADDRESS->Param, "CustomMsg");
        $this->Fields['MYADDRESS'] = &$this->MYADDRESS;

        // RT
        $this->RT = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_RT', 'RT', 'dbo.EMPLOYEE_ALL.RT', 'dbo.EMPLOYEE_ALL.RT', 200, 5, -1, false, 'dbo.EMPLOYEE_ALL.RT', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RT->Sortable = true; // Allow sort
        $this->RT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RT->Param, "CustomMsg");
        $this->Fields['RT'] = &$this->RT;

        // RW
        $this->RW = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_RW', 'RW', 'dbo.EMPLOYEE_ALL.RW', 'dbo.EMPLOYEE_ALL.RW', 200, 5, -1, false, 'dbo.EMPLOYEE_ALL.RW', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RW->Sortable = true; // Allow sort
        $this->RW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RW->Param, "CustomMsg");
        $this->Fields['RW'] = &$this->RW;

        // KAL_ID
        $this->KAL_ID = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_KAL_ID', 'KAL_ID', 'dbo.EMPLOYEE_ALL.KAL_ID', 'dbo.EMPLOYEE_ALL.KAL_ID', 200, 8, -1, false, 'dbo.EMPLOYEE_ALL.KAL_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAL_ID->Sortable = true; // Allow sort
        $this->KAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAL_ID->Param, "CustomMsg");
        $this->Fields['KAL_ID'] = &$this->KAL_ID;

        // PLACEOFBIRTH
        $this->PLACEOFBIRTH = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_PLACEOFBIRTH', 'PLACEOFBIRTH', 'dbo.EMPLOYEE_ALL.PLACEOFBIRTH', 'dbo.EMPLOYEE_ALL.PLACEOFBIRTH', 129, 20, -1, false, 'dbo.EMPLOYEE_ALL.PLACEOFBIRTH', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PLACEOFBIRTH->Sortable = true; // Allow sort
        $this->PLACEOFBIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PLACEOFBIRTH->Param, "CustomMsg");
        $this->Fields['PLACEOFBIRTH'] = &$this->PLACEOFBIRTH;

        // DATEOFBIRTH
        $this->DATEOFBIRTH = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_DATEOFBIRTH', 'DATEOFBIRTH', 'dbo.EMPLOYEE_ALL.DATEOFBIRTH', CastDateFieldForLike("dbo.EMPLOYEE_ALL.DATEOFBIRTH", 0, "DB"), 135, 8, 0, false, 'dbo.EMPLOYEE_ALL.DATEOFBIRTH', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DATEOFBIRTH->Sortable = true; // Allow sort
        $this->DATEOFBIRTH->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DATEOFBIRTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DATEOFBIRTH->Param, "CustomMsg");
        $this->Fields['DATEOFBIRTH'] = &$this->DATEOFBIRTH;

        // KODE_AGAMA
        $this->KODE_AGAMA = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_KODE_AGAMA', 'KODE_AGAMA', 'dbo.EMPLOYEE_ALL.KODE_AGAMA', 'CAST(dbo.EMPLOYEE_ALL.KODE_AGAMA AS NVARCHAR)', 17, 1, -1, false, 'dbo.EMPLOYEE_ALL.KODE_AGAMA', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODE_AGAMA->Sortable = true; // Allow sort
        $this->KODE_AGAMA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KODE_AGAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE_AGAMA->Param, "CustomMsg");
        $this->Fields['KODE_AGAMA'] = &$this->KODE_AGAMA;

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_OBJECT_CATEGORY_ID', 'OBJECT_CATEGORY_ID', 'dbo.EMPLOYEE_ALL.OBJECT_CATEGORY_ID', 'CAST(dbo.EMPLOYEE_ALL.OBJECT_CATEGORY_ID AS NVARCHAR)', 2, 2, -1, false, 'dbo.EMPLOYEE_ALL.OBJECT_CATEGORY_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->OBJECT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->OBJECT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['OBJECT_CATEGORY_ID'] = &$this->OBJECT_CATEGORY_ID;

        // STATUS_ID
        $this->STATUS_ID = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_STATUS_ID', 'STATUS_ID', 'dbo.EMPLOYEE_ALL.STATUS_ID', 'CAST(dbo.EMPLOYEE_ALL.STATUS_ID AS NVARCHAR)', 17, 1, -1, false, 'dbo.EMPLOYEE_ALL.STATUS_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_ID->Sortable = true; // Allow sort
        $this->STATUS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_ID->Param, "CustomMsg");
        $this->Fields['STATUS_ID'] = &$this->STATUS_ID;

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_EMPLOYEED_DATE', 'EMPLOYEED_DATE', 'dbo.EMPLOYEE_ALL.EMPLOYEED_DATE', CastDateFieldForLike("dbo.EMPLOYEE_ALL.EMPLOYEED_DATE", 0, "DB"), 135, 8, 0, false, 'dbo.EMPLOYEE_ALL.EMPLOYEED_DATE', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEED_DATE->Sortable = true; // Allow sort
        $this->EMPLOYEED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EMPLOYEED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEED_DATE->Param, "CustomMsg");
        $this->Fields['EMPLOYEED_DATE'] = &$this->EMPLOYEED_DATE;

        // NONACTIVE
        $this->NONACTIVE = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_NONACTIVE', 'NONACTIVE', 'dbo.EMPLOYEE_ALL.NONACTIVE', 'dbo.EMPLOYEE_ALL.NONACTIVE', 129, 1, -1, false, 'dbo.EMPLOYEE_ALL.NONACTIVE', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NONACTIVE->Sortable = true; // Allow sort
        $this->NONACTIVE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NONACTIVE->Param, "CustomMsg");
        $this->Fields['NONACTIVE'] = &$this->NONACTIVE;

        // ISFULLTIME
        $this->ISFULLTIME = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_ISFULLTIME', 'ISFULLTIME', 'dbo.EMPLOYEE_ALL.ISFULLTIME', 'dbo.EMPLOYEE_ALL.ISFULLTIME', 129, 1, -1, false, 'dbo.EMPLOYEE_ALL.ISFULLTIME', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISFULLTIME->Sortable = true; // Allow sort
        $this->ISFULLTIME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISFULLTIME->Param, "CustomMsg");
        $this->Fields['ISFULLTIME'] = &$this->ISFULLTIME;

        // NPWP
        $this->NPWP = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_NPWP', 'NPWP', 'dbo.EMPLOYEE_ALL.NPWP', 'dbo.EMPLOYEE_ALL.NPWP', 200, 50, -1, false, 'dbo.EMPLOYEE_ALL.NPWP', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPWP->Sortable = true; // Allow sort
        $this->NPWP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPWP->Param, "CustomMsg");
        $this->Fields['NPWP'] = &$this->NPWP;

        // NATION_ID
        $this->NATION_ID = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_NATION_ID', 'NATION_ID', 'dbo.EMPLOYEE_ALL.NATION_ID', 'CAST(dbo.EMPLOYEE_ALL.NATION_ID AS NVARCHAR)', 17, 1, -1, false, 'dbo.EMPLOYEE_ALL.NATION_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NATION_ID->Sortable = true; // Allow sort
        $this->NATION_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NATION_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NATION_ID->Param, "CustomMsg");
        $this->Fields['NATION_ID'] = &$this->NATION_ID;

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_NONACTIVE_DATE', 'NONACTIVE_DATE', 'dbo.EMPLOYEE_ALL.NONACTIVE_DATE', CastDateFieldForLike("dbo.EMPLOYEE_ALL.NONACTIVE_DATE", 0, "DB"), 135, 8, 0, false, 'dbo.EMPLOYEE_ALL.NONACTIVE_DATE', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NONACTIVE_DATE->Sortable = true; // Allow sort
        $this->NONACTIVE_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->NONACTIVE_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NONACTIVE_DATE->Param, "CustomMsg");
        $this->Fields['NONACTIVE_DATE'] = &$this->NONACTIVE_DATE;

        // SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_SPECIALIST_TYPE_ID', 'SPECIALIST_TYPE_ID', 'dbo.EMPLOYEE_ALL.SPECIALIST_TYPE_ID', 'dbo.EMPLOYEE_ALL.SPECIALIST_TYPE_ID', 200, 50, -1, false, 'dbo.EMPLOYEE_ALL.SPECIALIST_TYPE_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPECIALIST_TYPE_ID->Sortable = true; // Allow sort
        $this->SPECIALIST_TYPE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPECIALIST_TYPE_ID->Param, "CustomMsg");
        $this->Fields['SPECIALIST_TYPE_ID'] = &$this->SPECIALIST_TYPE_ID;

        // NPK
        $this->NPK = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_NPK', 'NPK', 'dbo.EMPLOYEE_ALL.NPK', 'dbo.EMPLOYEE_ALL.NPK', 200, 15, -1, false, 'dbo.EMPLOYEE_ALL.NPK', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPK->Sortable = true; // Allow sort
        $this->NPK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPK->Param, "CustomMsg");
        $this->Fields['NPK'] = &$this->NPK;

        // NIP
        $this->NIP = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_NIP', 'NIP', 'dbo.EMPLOYEE_ALL.NIP', 'dbo.EMPLOYEE_ALL.NIP', 200, 30, -1, false, 'dbo.EMPLOYEE_ALL.NIP', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIP->Sortable = true; // Allow sort
        $this->NIP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIP->Param, "CustomMsg");
        $this->Fields['NIP'] = &$this->NIP;

        // DPJP
        $this->DPJP = new DbField('V_EMPLOYE', 'V_EMPLOYE', 'x_DPJP', 'DPJP', 'dbo.EMPLOYEE_ALL.DPJP', 'dbo.EMPLOYEE_ALL.DPJP', 200, 25, -1, false, 'dbo.EMPLOYEE_ALL.DPJP', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DPJP->Sortable = true; // Allow sort
        $this->DPJP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DPJP->Param, "CustomMsg");
        $this->Fields['DPJP'] = &$this->DPJP;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "dbo.EMPLOYEE_ALL";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("dbo.EMPLOYEE_ALL.ORG_UNIT_CODE, dbo.EMPLOYEE_ALL.EMPLOYEE_ID, dbo.EMPLOYEE_ALL.FULLNAME, dbo.EMPLOYEE_ALL.GENDER, dbo.EMPLOYEE_ALL.MARITALSTATUSID, dbo.EMPLOYEE_ALL.MYADDRESS, dbo.EMPLOYEE_ALL.RT, dbo.EMPLOYEE_ALL.RW, dbo.EMPLOYEE_ALL.KAL_ID, dbo.EMPLOYEE_ALL.PLACEOFBIRTH, dbo.EMPLOYEE_ALL.DATEOFBIRTH, dbo.EMPLOYEE_ALL.KODE_AGAMA, dbo.EMPLOYEE_ALL.STATUS_ID, dbo.EMPLOYEE_ALL.EMPLOYEED_DATE, dbo.EMPLOYEE_ALL.NONACTIVE, dbo.EMPLOYEE_ALL.ISFULLTIME, dbo.EMPLOYEE_ALL.NPWP, dbo.EMPLOYEE_ALL.NATION_ID, dbo.EMPLOYEE_ALL.NONACTIVE_DATE, dbo.EMPLOYEE_ALL.SPECIALIST_TYPE_ID, dbo.EMPLOYEE_ALL.NPK, dbo.EMPLOYEE_ALL.NIP, dbo.EMPLOYEE_ALL.DPJP, dbo.EMPLOYEE_ALL.OBJECT_CATEGORY_ID");
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
        $this->ORG_UNIT_CODE->DbValue = $row['ORG_UNIT_CODE'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->FULLNAME->DbValue = $row['FULLNAME'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->MARITALSTATUSID->DbValue = $row['MARITALSTATUSID'];
        $this->MYADDRESS->DbValue = $row['MYADDRESS'];
        $this->RT->DbValue = $row['RT'];
        $this->RW->DbValue = $row['RW'];
        $this->KAL_ID->DbValue = $row['KAL_ID'];
        $this->PLACEOFBIRTH->DbValue = $row['PLACEOFBIRTH'];
        $this->DATEOFBIRTH->DbValue = $row['DATEOFBIRTH'];
        $this->KODE_AGAMA->DbValue = $row['KODE_AGAMA'];
        $this->OBJECT_CATEGORY_ID->DbValue = $row['OBJECT_CATEGORY_ID'];
        $this->STATUS_ID->DbValue = $row['STATUS_ID'];
        $this->EMPLOYEED_DATE->DbValue = $row['EMPLOYEED_DATE'];
        $this->NONACTIVE->DbValue = $row['NONACTIVE'];
        $this->ISFULLTIME->DbValue = $row['ISFULLTIME'];
        $this->NPWP->DbValue = $row['NPWP'];
        $this->NATION_ID->DbValue = $row['NATION_ID'];
        $this->NONACTIVE_DATE->DbValue = $row['NONACTIVE_DATE'];
        $this->SPECIALIST_TYPE_ID->DbValue = $row['SPECIALIST_TYPE_ID'];
        $this->NPK->DbValue = $row['NPK'];
        $this->NIP->DbValue = $row['NIP'];
        $this->DPJP->DbValue = $row['DPJP'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "dbo.EMPLOYEE_ALL.ORG_UNIT_CODE = '@ORG_UNIT_CODE@' AND dbo.EMPLOYEE_ALL.EMPLOYEE_ID = '@EMPLOYEE_ID@'";
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
        return $_SESSION[$name] ?? GetUrl("VEmployeList");
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
        if ($pageName == "VEmployeView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VEmployeEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VEmployeAdd") {
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
                return "VEmployeView";
            case Config("API_ADD_ACTION"):
                return "VEmployeAdd";
            case Config("API_EDIT_ACTION"):
                return "VEmployeEdit";
            case Config("API_DELETE_ACTION"):
                return "VEmployeDelete";
            case Config("API_LIST_ACTION"):
                return "VEmployeList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VEmployeList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VEmployeView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VEmployeView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VEmployeAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VEmployeAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("VEmployeEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("VEmployeAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("VEmployeDelete", $this->getUrlParm());
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
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->FULLNAME->setDbValue($row['FULLNAME']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->MARITALSTATUSID->setDbValue($row['MARITALSTATUSID']);
        $this->MYADDRESS->setDbValue($row['MYADDRESS']);
        $this->RT->setDbValue($row['RT']);
        $this->RW->setDbValue($row['RW']);
        $this->KAL_ID->setDbValue($row['KAL_ID']);
        $this->PLACEOFBIRTH->setDbValue($row['PLACEOFBIRTH']);
        $this->DATEOFBIRTH->setDbValue($row['DATEOFBIRTH']);
        $this->KODE_AGAMA->setDbValue($row['KODE_AGAMA']);
        $this->OBJECT_CATEGORY_ID->setDbValue($row['OBJECT_CATEGORY_ID']);
        $this->STATUS_ID->setDbValue($row['STATUS_ID']);
        $this->EMPLOYEED_DATE->setDbValue($row['EMPLOYEED_DATE']);
        $this->NONACTIVE->setDbValue($row['NONACTIVE']);
        $this->ISFULLTIME->setDbValue($row['ISFULLTIME']);
        $this->NPWP->setDbValue($row['NPWP']);
        $this->NATION_ID->setDbValue($row['NATION_ID']);
        $this->NONACTIVE_DATE->setDbValue($row['NONACTIVE_DATE']);
        $this->SPECIALIST_TYPE_ID->setDbValue($row['SPECIALIST_TYPE_ID']);
        $this->NPK->setDbValue($row['NPK']);
        $this->NIP->setDbValue($row['NIP']);
        $this->DPJP->setDbValue($row['DPJP']);
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

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->CellCssStyle = "white-space: nowrap;";

        // FULLNAME
        $this->FULLNAME->CellCssStyle = "white-space: nowrap;";

        // GENDER
        $this->GENDER->CellCssStyle = "white-space: nowrap;";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->CellCssStyle = "white-space: nowrap;";

        // MYADDRESS
        $this->MYADDRESS->CellCssStyle = "white-space: nowrap;";

        // RT
        $this->RT->CellCssStyle = "white-space: nowrap;";

        // RW
        $this->RW->CellCssStyle = "white-space: nowrap;";

        // KAL_ID
        $this->KAL_ID->CellCssStyle = "white-space: nowrap;";

        // PLACEOFBIRTH
        $this->PLACEOFBIRTH->CellCssStyle = "white-space: nowrap;";

        // DATEOFBIRTH
        $this->DATEOFBIRTH->CellCssStyle = "white-space: nowrap;";

        // KODE_AGAMA
        $this->KODE_AGAMA->CellCssStyle = "white-space: nowrap;";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->CellCssStyle = "white-space: nowrap;";

        // STATUS_ID
        $this->STATUS_ID->CellCssStyle = "white-space: nowrap;";

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE->CellCssStyle = "white-space: nowrap;";

        // NONACTIVE
        $this->NONACTIVE->CellCssStyle = "white-space: nowrap;";

        // ISFULLTIME
        $this->ISFULLTIME->CellCssStyle = "white-space: nowrap;";

        // NPWP
        $this->NPWP->CellCssStyle = "white-space: nowrap;";

        // NATION_ID
        $this->NATION_ID->CellCssStyle = "white-space: nowrap;";

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE->CellCssStyle = "white-space: nowrap;";

        // SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID->CellCssStyle = "white-space: nowrap;";

        // NPK
        $this->NPK->CellCssStyle = "white-space: nowrap;";

        // NIP
        $this->NIP->CellCssStyle = "white-space: nowrap;";

        // DPJP
        $this->DPJP->CellCssStyle = "white-space: nowrap;";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // FULLNAME
        $this->FULLNAME->ViewValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->ViewCustomAttributes = "";

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->ViewValue = $this->MARITALSTATUSID->CurrentValue;
        $this->MARITALSTATUSID->ViewValue = FormatNumber($this->MARITALSTATUSID->ViewValue, 0, -2, -2, -2);
        $this->MARITALSTATUSID->ViewCustomAttributes = "";

        // MYADDRESS
        $this->MYADDRESS->ViewValue = $this->MYADDRESS->CurrentValue;
        $this->MYADDRESS->ViewCustomAttributes = "";

        // RT
        $this->RT->ViewValue = $this->RT->CurrentValue;
        $this->RT->ViewCustomAttributes = "";

        // RW
        $this->RW->ViewValue = $this->RW->CurrentValue;
        $this->RW->ViewCustomAttributes = "";

        // KAL_ID
        $this->KAL_ID->ViewValue = $this->KAL_ID->CurrentValue;
        $this->KAL_ID->ViewCustomAttributes = "";

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

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->ViewValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->ViewValue = FormatNumber($this->OBJECT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
        $this->OBJECT_CATEGORY_ID->ViewCustomAttributes = "";

        // STATUS_ID
        $this->STATUS_ID->ViewValue = $this->STATUS_ID->CurrentValue;
        $this->STATUS_ID->ViewValue = FormatNumber($this->STATUS_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_ID->ViewCustomAttributes = "";

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE->ViewValue = $this->EMPLOYEED_DATE->CurrentValue;
        $this->EMPLOYEED_DATE->ViewValue = FormatDateTime($this->EMPLOYEED_DATE->ViewValue, 0);
        $this->EMPLOYEED_DATE->ViewCustomAttributes = "";

        // NONACTIVE
        $this->NONACTIVE->ViewValue = $this->NONACTIVE->CurrentValue;
        $this->NONACTIVE->ViewCustomAttributes = "";

        // ISFULLTIME
        $this->ISFULLTIME->ViewValue = $this->ISFULLTIME->CurrentValue;
        $this->ISFULLTIME->ViewCustomAttributes = "";

        // NPWP
        $this->NPWP->ViewValue = $this->NPWP->CurrentValue;
        $this->NPWP->ViewCustomAttributes = "";

        // NATION_ID
        $this->NATION_ID->ViewValue = $this->NATION_ID->CurrentValue;
        $this->NATION_ID->ViewValue = FormatNumber($this->NATION_ID->ViewValue, 0, -2, -2, -2);
        $this->NATION_ID->ViewCustomAttributes = "";

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE->ViewValue = $this->NONACTIVE_DATE->CurrentValue;
        $this->NONACTIVE_DATE->ViewValue = FormatDateTime($this->NONACTIVE_DATE->ViewValue, 0);
        $this->NONACTIVE_DATE->ViewCustomAttributes = "";

        // SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID->ViewValue = $this->SPECIALIST_TYPE_ID->CurrentValue;
        $this->SPECIALIST_TYPE_ID->ViewCustomAttributes = "";

        // NPK
        $this->NPK->ViewValue = $this->NPK->CurrentValue;
        $this->NPK->ViewCustomAttributes = "";

        // NIP
        $this->NIP->ViewValue = $this->NIP->CurrentValue;
        $this->NIP->ViewCustomAttributes = "";

        // DPJP
        $this->DPJP->ViewValue = $this->DPJP->CurrentValue;
        $this->DPJP->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // FULLNAME
        $this->FULLNAME->LinkCustomAttributes = "";
        $this->FULLNAME->HrefValue = "";
        $this->FULLNAME->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // MARITALSTATUSID
        $this->MARITALSTATUSID->LinkCustomAttributes = "";
        $this->MARITALSTATUSID->HrefValue = "";
        $this->MARITALSTATUSID->TooltipValue = "";

        // MYADDRESS
        $this->MYADDRESS->LinkCustomAttributes = "";
        $this->MYADDRESS->HrefValue = "";
        $this->MYADDRESS->TooltipValue = "";

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

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->HrefValue = "";
        $this->OBJECT_CATEGORY_ID->TooltipValue = "";

        // STATUS_ID
        $this->STATUS_ID->LinkCustomAttributes = "";
        $this->STATUS_ID->HrefValue = "";
        $this->STATUS_ID->TooltipValue = "";

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE->LinkCustomAttributes = "";
        $this->EMPLOYEED_DATE->HrefValue = "";
        $this->EMPLOYEED_DATE->TooltipValue = "";

        // NONACTIVE
        $this->NONACTIVE->LinkCustomAttributes = "";
        $this->NONACTIVE->HrefValue = "";
        $this->NONACTIVE->TooltipValue = "";

        // ISFULLTIME
        $this->ISFULLTIME->LinkCustomAttributes = "";
        $this->ISFULLTIME->HrefValue = "";
        $this->ISFULLTIME->TooltipValue = "";

        // NPWP
        $this->NPWP->LinkCustomAttributes = "";
        $this->NPWP->HrefValue = "";
        $this->NPWP->TooltipValue = "";

        // NATION_ID
        $this->NATION_ID->LinkCustomAttributes = "";
        $this->NATION_ID->HrefValue = "";
        $this->NATION_ID->TooltipValue = "";

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE->LinkCustomAttributes = "";
        $this->NONACTIVE_DATE->HrefValue = "";
        $this->NONACTIVE_DATE->TooltipValue = "";

        // SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID->LinkCustomAttributes = "";
        $this->SPECIALIST_TYPE_ID->HrefValue = "";
        $this->SPECIALIST_TYPE_ID->TooltipValue = "";

        // NPK
        $this->NPK->LinkCustomAttributes = "";
        $this->NPK->HrefValue = "";
        $this->NPK->TooltipValue = "";

        // NIP
        $this->NIP->LinkCustomAttributes = "";
        $this->NIP->HrefValue = "";
        $this->NIP->TooltipValue = "";

        // DPJP
        $this->DPJP->LinkCustomAttributes = "";
        $this->DPJP->HrefValue = "";
        $this->DPJP->TooltipValue = "";

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

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // FULLNAME
        $this->FULLNAME->EditAttrs["class"] = "form-control";
        $this->FULLNAME->EditCustomAttributes = "";
        if (!$this->FULLNAME->Raw) {
            $this->FULLNAME->CurrentValue = HtmlDecode($this->FULLNAME->CurrentValue);
        }
        $this->FULLNAME->EditValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->PlaceHolder = RemoveHtml($this->FULLNAME->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        if (!$this->GENDER->Raw) {
            $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
        }
        $this->GENDER->EditValue = $this->GENDER->CurrentValue;
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // MARITALSTATUSID
        $this->MARITALSTATUSID->EditAttrs["class"] = "form-control";
        $this->MARITALSTATUSID->EditCustomAttributes = "";
        $this->MARITALSTATUSID->EditValue = $this->MARITALSTATUSID->CurrentValue;
        $this->MARITALSTATUSID->PlaceHolder = RemoveHtml($this->MARITALSTATUSID->caption());

        // MYADDRESS
        $this->MYADDRESS->EditAttrs["class"] = "form-control";
        $this->MYADDRESS->EditCustomAttributes = "";
        if (!$this->MYADDRESS->Raw) {
            $this->MYADDRESS->CurrentValue = HtmlDecode($this->MYADDRESS->CurrentValue);
        }
        $this->MYADDRESS->EditValue = $this->MYADDRESS->CurrentValue;
        $this->MYADDRESS->PlaceHolder = RemoveHtml($this->MYADDRESS->caption());

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

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->OBJECT_CATEGORY_ID->EditCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->EditValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->OBJECT_CATEGORY_ID->caption());

        // STATUS_ID
        $this->STATUS_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_ID->EditCustomAttributes = "";
        $this->STATUS_ID->EditValue = $this->STATUS_ID->CurrentValue;
        $this->STATUS_ID->PlaceHolder = RemoveHtml($this->STATUS_ID->caption());

        // EMPLOYEED_DATE
        $this->EMPLOYEED_DATE->EditAttrs["class"] = "form-control";
        $this->EMPLOYEED_DATE->EditCustomAttributes = "";
        $this->EMPLOYEED_DATE->EditValue = FormatDateTime($this->EMPLOYEED_DATE->CurrentValue, 8);
        $this->EMPLOYEED_DATE->PlaceHolder = RemoveHtml($this->EMPLOYEED_DATE->caption());

        // NONACTIVE
        $this->NONACTIVE->EditAttrs["class"] = "form-control";
        $this->NONACTIVE->EditCustomAttributes = "";
        if (!$this->NONACTIVE->Raw) {
            $this->NONACTIVE->CurrentValue = HtmlDecode($this->NONACTIVE->CurrentValue);
        }
        $this->NONACTIVE->EditValue = $this->NONACTIVE->CurrentValue;
        $this->NONACTIVE->PlaceHolder = RemoveHtml($this->NONACTIVE->caption());

        // ISFULLTIME
        $this->ISFULLTIME->EditAttrs["class"] = "form-control";
        $this->ISFULLTIME->EditCustomAttributes = "";
        if (!$this->ISFULLTIME->Raw) {
            $this->ISFULLTIME->CurrentValue = HtmlDecode($this->ISFULLTIME->CurrentValue);
        }
        $this->ISFULLTIME->EditValue = $this->ISFULLTIME->CurrentValue;
        $this->ISFULLTIME->PlaceHolder = RemoveHtml($this->ISFULLTIME->caption());

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

        // NONACTIVE_DATE
        $this->NONACTIVE_DATE->EditAttrs["class"] = "form-control";
        $this->NONACTIVE_DATE->EditCustomAttributes = "";
        $this->NONACTIVE_DATE->EditValue = FormatDateTime($this->NONACTIVE_DATE->CurrentValue, 8);
        $this->NONACTIVE_DATE->PlaceHolder = RemoveHtml($this->NONACTIVE_DATE->caption());

        // SPECIALIST_TYPE_ID
        $this->SPECIALIST_TYPE_ID->EditAttrs["class"] = "form-control";
        $this->SPECIALIST_TYPE_ID->EditCustomAttributes = "";
        if (!$this->SPECIALIST_TYPE_ID->Raw) {
            $this->SPECIALIST_TYPE_ID->CurrentValue = HtmlDecode($this->SPECIALIST_TYPE_ID->CurrentValue);
        }
        $this->SPECIALIST_TYPE_ID->EditValue = $this->SPECIALIST_TYPE_ID->CurrentValue;
        $this->SPECIALIST_TYPE_ID->PlaceHolder = RemoveHtml($this->SPECIALIST_TYPE_ID->caption());

        // NPK
        $this->NPK->EditAttrs["class"] = "form-control";
        $this->NPK->EditCustomAttributes = "";
        if (!$this->NPK->Raw) {
            $this->NPK->CurrentValue = HtmlDecode($this->NPK->CurrentValue);
        }
        $this->NPK->EditValue = $this->NPK->CurrentValue;
        $this->NPK->PlaceHolder = RemoveHtml($this->NPK->caption());

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
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->MARITALSTATUSID);
                    $doc->exportCaption($this->MYADDRESS);
                    $doc->exportCaption($this->RT);
                    $doc->exportCaption($this->RW);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->PLACEOFBIRTH);
                    $doc->exportCaption($this->DATEOFBIRTH);
                    $doc->exportCaption($this->KODE_AGAMA);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->STATUS_ID);
                    $doc->exportCaption($this->EMPLOYEED_DATE);
                    $doc->exportCaption($this->NONACTIVE);
                    $doc->exportCaption($this->ISFULLTIME);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->NATION_ID);
                    $doc->exportCaption($this->NONACTIVE_DATE);
                    $doc->exportCaption($this->SPECIALIST_TYPE_ID);
                    $doc->exportCaption($this->NPK);
                    $doc->exportCaption($this->NIP);
                    $doc->exportCaption($this->DPJP);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->MARITALSTATUSID);
                    $doc->exportCaption($this->MYADDRESS);
                    $doc->exportCaption($this->RT);
                    $doc->exportCaption($this->RW);
                    $doc->exportCaption($this->KAL_ID);
                    $doc->exportCaption($this->PLACEOFBIRTH);
                    $doc->exportCaption($this->DATEOFBIRTH);
                    $doc->exportCaption($this->KODE_AGAMA);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->STATUS_ID);
                    $doc->exportCaption($this->EMPLOYEED_DATE);
                    $doc->exportCaption($this->NONACTIVE);
                    $doc->exportCaption($this->ISFULLTIME);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->NATION_ID);
                    $doc->exportCaption($this->NONACTIVE_DATE);
                    $doc->exportCaption($this->SPECIALIST_TYPE_ID);
                    $doc->exportCaption($this->NPK);
                    $doc->exportCaption($this->NIP);
                    $doc->exportCaption($this->DPJP);
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
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->MARITALSTATUSID);
                        $doc->exportField($this->MYADDRESS);
                        $doc->exportField($this->RT);
                        $doc->exportField($this->RW);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->PLACEOFBIRTH);
                        $doc->exportField($this->DATEOFBIRTH);
                        $doc->exportField($this->KODE_AGAMA);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->STATUS_ID);
                        $doc->exportField($this->EMPLOYEED_DATE);
                        $doc->exportField($this->NONACTIVE);
                        $doc->exportField($this->ISFULLTIME);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->NATION_ID);
                        $doc->exportField($this->NONACTIVE_DATE);
                        $doc->exportField($this->SPECIALIST_TYPE_ID);
                        $doc->exportField($this->NPK);
                        $doc->exportField($this->NIP);
                        $doc->exportField($this->DPJP);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->MARITALSTATUSID);
                        $doc->exportField($this->MYADDRESS);
                        $doc->exportField($this->RT);
                        $doc->exportField($this->RW);
                        $doc->exportField($this->KAL_ID);
                        $doc->exportField($this->PLACEOFBIRTH);
                        $doc->exportField($this->DATEOFBIRTH);
                        $doc->exportField($this->KODE_AGAMA);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->STATUS_ID);
                        $doc->exportField($this->EMPLOYEED_DATE);
                        $doc->exportField($this->NONACTIVE);
                        $doc->exportField($this->ISFULLTIME);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->NATION_ID);
                        $doc->exportField($this->NONACTIVE_DATE);
                        $doc->exportField($this->SPECIALIST_TYPE_ID);
                        $doc->exportField($this->NPK);
                        $doc->exportField($this->NIP);
                        $doc->exportField($this->DPJP);
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
