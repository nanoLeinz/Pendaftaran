<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for CLASS_ROOM
 */
class ClassRoom extends DbTable
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
    public $CLASS_ROOM_ID;
    public $ROOMS_ID;
    public $CLASS_ID;
    public $NAME_OF_CLASS;
    public $CAPACITY;
    public $GENDER;
    public $PICTUREFILE;
    public $DESCRIPTION;
    public $TARIF_ID;
    public $CLINIC_ID;
    public $ISACTIVE;
    public $NONACTIVEDATE;
    public $isviewed;
    public $KODEKELAS;
    public $REST_RESPON;
    public $TERISI;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $SISKODEKELAS;
    public $SISKODERAWAT;
    public $RESPONSESIS;
    public $TERISIMALE;
    public $TERISIFEMALE;
    public $KDKELASV;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'CLASS_ROOM';
        $this->TableName = 'CLASS_ROOM';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[CLASS_ROOM]";
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
        $this->ORG_UNIT_CODE = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 16, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->IsPrimaryKey = true; // Primary key field
        $this->CLASS_ROOM_ID->Nullable = false; // NOT NULL field
        $this->CLASS_ROOM_ID->Required = true; // Required field
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // ROOMS_ID
        $this->ROOMS_ID = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_ROOMS_ID', 'ROOMS_ID', '[ROOMS_ID]', '[ROOMS_ID]', 200, 10, -1, false, '[ROOMS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ROOMS_ID->Sortable = true; // Allow sort
        $this->ROOMS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ROOMS_ID->Param, "CustomMsg");
        $this->Fields['ROOMS_ID'] = &$this->ROOMS_ID;

        // CLASS_ID
        $this->CLASS_ID = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 2, 2, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_NAME_OF_CLASS', 'NAME_OF_CLASS', '[NAME_OF_CLASS]', '[NAME_OF_CLASS]', 200, 100, -1, false, '[NAME_OF_CLASS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_OF_CLASS->Sortable = true; // Allow sort
        $this->NAME_OF_CLASS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_OF_CLASS->Param, "CustomMsg");
        $this->Fields['NAME_OF_CLASS'] = &$this->NAME_OF_CLASS;

        // CAPACITY
        $this->CAPACITY = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_CAPACITY', 'CAPACITY', '[CAPACITY]', 'CAST([CAPACITY] AS NVARCHAR)', 2, 2, -1, false, '[CAPACITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CAPACITY->Sortable = true; // Allow sort
        $this->CAPACITY->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CAPACITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CAPACITY->Param, "CustomMsg");
        $this->Fields['CAPACITY'] = &$this->CAPACITY;

        // GENDER
        $this->GENDER = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_GENDER', 'GENDER', '[GENDER]', '[GENDER]', 129, 1, -1, false, '[GENDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // PICTUREFILE
        $this->PICTUREFILE = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_PICTUREFILE', 'PICTUREFILE', '[PICTUREFILE]', '[PICTUREFILE]', 200, 255, -1, false, '[PICTUREFILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PICTUREFILE->Sortable = true; // Allow sort
        $this->PICTUREFILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PICTUREFILE->Param, "CustomMsg");
        $this->Fields['PICTUREFILE'] = &$this->PICTUREFILE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // TARIF_ID
        $this->TARIF_ID = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_TARIF_ID', 'TARIF_ID', '[TARIF_ID]', '[TARIF_ID]', 200, 50, -1, false, '[TARIF_ID]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->TARIF_ID->Sortable = true; // Allow sort
        $this->TARIF_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->TARIF_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->TARIF_ID->Lookup = new Lookup('TARIF_ID', 'TREAT_TARIF', false, 'TREAT_ID', ["AMOUNT_PAID","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->TARIF_ID->Lookup = new Lookup('TARIF_ID', 'TREAT_TARIF', false, 'TREAT_ID', ["AMOUNT_PAID","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->TARIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_ID->Param, "CustomMsg");
        $this->Fields['TARIF_ID'] = &$this->TARIF_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // ISACTIVE
        $this->ISACTIVE = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_ISACTIVE', 'ISACTIVE', '[ISACTIVE]', '[ISACTIVE]', 129, 1, -1, false, '[ISACTIVE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISACTIVE->Sortable = true; // Allow sort
        $this->ISACTIVE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISACTIVE->Param, "CustomMsg");
        $this->Fields['ISACTIVE'] = &$this->ISACTIVE;

        // NONACTIVEDATE
        $this->NONACTIVEDATE = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_NONACTIVEDATE', 'NONACTIVEDATE', '[NONACTIVEDATE]', CastDateFieldForLike("[NONACTIVEDATE]", 0, "DB"), 135, 8, 0, false, '[NONACTIVEDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NONACTIVEDATE->Sortable = true; // Allow sort
        $this->NONACTIVEDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->NONACTIVEDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NONACTIVEDATE->Param, "CustomMsg");
        $this->Fields['NONACTIVEDATE'] = &$this->NONACTIVEDATE;

        // isviewed
        $this->isviewed = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_isviewed', 'isviewed', '[isviewed]', '[isviewed]', 129, 1, -1, false, '[isviewed]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isviewed->Sortable = true; // Allow sort
        $this->isviewed->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isviewed->Param, "CustomMsg");
        $this->Fields['isviewed'] = &$this->isviewed;

        // KODEKELAS
        $this->KODEKELAS = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_KODEKELAS', 'KODEKELAS', '[KODEKELAS]', '[KODEKELAS]', 200, 5, -1, false, '[KODEKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODEKELAS->Sortable = true; // Allow sort
        $this->KODEKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODEKELAS->Param, "CustomMsg");
        $this->Fields['KODEKELAS'] = &$this->KODEKELAS;

        // REST_RESPON
        $this->REST_RESPON = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_REST_RESPON', 'REST_RESPON', '[REST_RESPON]', '[REST_RESPON]', 201, 0, -1, false, '[REST_RESPON]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->REST_RESPON->Sortable = true; // Allow sort
        $this->REST_RESPON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REST_RESPON->Param, "CustomMsg");
        $this->Fields['REST_RESPON'] = &$this->REST_RESPON;

        // TERISI
        $this->TERISI = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_TERISI', 'TERISI', '[TERISI]', 'CAST([TERISI] AS NVARCHAR)', 2, 2, -1, false, '[TERISI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERISI->Sortable = true; // Allow sort
        $this->TERISI->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TERISI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERISI->Param, "CustomMsg");
        $this->Fields['TERISI'] = &$this->TERISI;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 25, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // SISKODEKELAS
        $this->SISKODEKELAS = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_SISKODEKELAS', 'SISKODEKELAS', '[SISKODEKELAS]', '[SISKODEKELAS]', 200, 10, -1, false, '[SISKODEKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SISKODEKELAS->Sortable = true; // Allow sort
        $this->SISKODEKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SISKODEKELAS->Param, "CustomMsg");
        $this->Fields['SISKODEKELAS'] = &$this->SISKODEKELAS;

        // SISKODERAWAT
        $this->SISKODERAWAT = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_SISKODERAWAT', 'SISKODERAWAT', '[SISKODERAWAT]', '[SISKODERAWAT]', 200, 10, -1, false, '[SISKODERAWAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SISKODERAWAT->Sortable = true; // Allow sort
        $this->SISKODERAWAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SISKODERAWAT->Param, "CustomMsg");
        $this->Fields['SISKODERAWAT'] = &$this->SISKODERAWAT;

        // RESPONSESIS
        $this->RESPONSESIS = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_RESPONSESIS', 'RESPONSESIS', '[RESPONSESIS]', '[RESPONSESIS]', 201, 0, -1, false, '[RESPONSESIS]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->RESPONSESIS->Sortable = true; // Allow sort
        $this->RESPONSESIS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONSESIS->Param, "CustomMsg");
        $this->Fields['RESPONSESIS'] = &$this->RESPONSESIS;

        // TERISIMALE
        $this->TERISIMALE = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_TERISIMALE', 'TERISIMALE', '[TERISIMALE]', 'CAST([TERISIMALE] AS NVARCHAR)', 3, 4, -1, false, '[TERISIMALE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERISIMALE->Sortable = true; // Allow sort
        $this->TERISIMALE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TERISIMALE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERISIMALE->Param, "CustomMsg");
        $this->Fields['TERISIMALE'] = &$this->TERISIMALE;

        // TERISIFEMALE
        $this->TERISIFEMALE = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_TERISIFEMALE', 'TERISIFEMALE', '[TERISIFEMALE]', 'CAST([TERISIFEMALE] AS NVARCHAR)', 3, 4, -1, false, '[TERISIFEMALE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TERISIFEMALE->Sortable = true; // Allow sort
        $this->TERISIFEMALE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TERISIFEMALE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TERISIFEMALE->Param, "CustomMsg");
        $this->Fields['TERISIFEMALE'] = &$this->TERISIFEMALE;

        // KDKELASV
        $this->KDKELASV = new DbField('CLASS_ROOM', 'CLASS_ROOM', 'x_KDKELASV', 'KDKELASV', '[KDKELASV]', '[KDKELASV]', 129, 3, -1, false, '[KDKELASV]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDKELASV->Sortable = true; // Allow sort
        $this->KDKELASV->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDKELASV->Param, "CustomMsg");
        $this->Fields['KDKELASV'] = &$this->KDKELASV;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[CLASS_ROOM]";
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
            if (array_key_exists('CLASS_ROOM_ID', $rs)) {
                AddFilter($where, QuotedName('CLASS_ROOM_ID', $this->Dbid) . '=' . QuotedValue($rs['CLASS_ROOM_ID'], $this->CLASS_ROOM_ID->DataType, $this->Dbid));
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
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->ROOMS_ID->DbValue = $row['ROOMS_ID'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->NAME_OF_CLASS->DbValue = $row['NAME_OF_CLASS'];
        $this->CAPACITY->DbValue = $row['CAPACITY'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->PICTUREFILE->DbValue = $row['PICTUREFILE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->TARIF_ID->DbValue = $row['TARIF_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->ISACTIVE->DbValue = $row['ISACTIVE'];
        $this->NONACTIVEDATE->DbValue = $row['NONACTIVEDATE'];
        $this->isviewed->DbValue = $row['isviewed'];
        $this->KODEKELAS->DbValue = $row['KODEKELAS'];
        $this->REST_RESPON->DbValue = $row['REST_RESPON'];
        $this->TERISI->DbValue = $row['TERISI'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->SISKODEKELAS->DbValue = $row['SISKODEKELAS'];
        $this->SISKODERAWAT->DbValue = $row['SISKODERAWAT'];
        $this->RESPONSESIS->DbValue = $row['RESPONSESIS'];
        $this->TERISIMALE->DbValue = $row['TERISIMALE'];
        $this->TERISIFEMALE->DbValue = $row['TERISIFEMALE'];
        $this->KDKELASV->DbValue = $row['KDKELASV'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [CLASS_ROOM_ID] = '@CLASS_ROOM_ID@'";
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
        $val = $current ? $this->CLASS_ROOM_ID->CurrentValue : $this->CLASS_ROOM_ID->OldValue;
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
                $this->CLASS_ROOM_ID->CurrentValue = $keys[1];
            } else {
                $this->CLASS_ROOM_ID->OldValue = $keys[1];
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
            $val = array_key_exists('CLASS_ROOM_ID', $row) ? $row['CLASS_ROOM_ID'] : null;
        } else {
            $val = $this->CLASS_ROOM_ID->OldValue !== null ? $this->CLASS_ROOM_ID->OldValue : $this->CLASS_ROOM_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@CLASS_ROOM_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ClassRoomList");
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
        if ($pageName == "ClassRoomView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ClassRoomEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ClassRoomAdd") {
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
                return "ClassRoomView";
            case Config("API_ADD_ACTION"):
                return "ClassRoomAdd";
            case Config("API_EDIT_ACTION"):
                return "ClassRoomEdit";
            case Config("API_DELETE_ACTION"):
                return "ClassRoomDelete";
            case Config("API_LIST_ACTION"):
                return "ClassRoomList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ClassRoomList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ClassRoomView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ClassRoomView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ClassRoomAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ClassRoomAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ClassRoomEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ClassRoomAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ClassRoomDelete", $this->getUrlParm());
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
        $json .= ",CLASS_ROOM_ID:" . JsonEncode($this->CLASS_ROOM_ID->CurrentValue, "string");
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
        if ($this->CLASS_ROOM_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->CLASS_ROOM_ID->CurrentValue);
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
            if (($keyValue = Param("CLASS_ROOM_ID") ?? Route("CLASS_ROOM_ID")) !== null) {
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
                $this->CLASS_ROOM_ID->CurrentValue = $key[1];
            } else {
                $this->CLASS_ROOM_ID->OldValue = $key[1];
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
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->ROOMS_ID->setDbValue($row['ROOMS_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->NAME_OF_CLASS->setDbValue($row['NAME_OF_CLASS']);
        $this->CAPACITY->setDbValue($row['CAPACITY']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->PICTUREFILE->setDbValue($row['PICTUREFILE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->ISACTIVE->setDbValue($row['ISACTIVE']);
        $this->NONACTIVEDATE->setDbValue($row['NONACTIVEDATE']);
        $this->isviewed->setDbValue($row['isviewed']);
        $this->KODEKELAS->setDbValue($row['KODEKELAS']);
        $this->REST_RESPON->setDbValue($row['REST_RESPON']);
        $this->TERISI->setDbValue($row['TERISI']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->SISKODEKELAS->setDbValue($row['SISKODEKELAS']);
        $this->SISKODERAWAT->setDbValue($row['SISKODERAWAT']);
        $this->RESPONSESIS->setDbValue($row['RESPONSESIS']);
        $this->TERISIMALE->setDbValue($row['TERISIMALE']);
        $this->TERISIFEMALE->setDbValue($row['TERISIFEMALE']);
        $this->KDKELASV->setDbValue($row['KDKELASV']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // CLASS_ROOM_ID

        // ROOMS_ID

        // CLASS_ID

        // NAME_OF_CLASS

        // CAPACITY

        // GENDER

        // PICTUREFILE

        // DESCRIPTION

        // TARIF_ID

        // CLINIC_ID

        // ISACTIVE

        // NONACTIVEDATE

        // isviewed

        // KODEKELAS

        // REST_RESPON

        // TERISI

        // MODIFIED_DATE

        // MODIFIED_BY

        // SISKODEKELAS

        // SISKODERAWAT

        // RESPONSESIS

        // TERISIMALE

        // TERISIFEMALE

        // KDKELASV

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

        // ROOMS_ID
        $this->ROOMS_ID->ViewValue = $this->ROOMS_ID->CurrentValue;
        $this->ROOMS_ID->ViewCustomAttributes = "";

        // CLASS_ID
        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID->ViewCustomAttributes = "";

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS->ViewValue = $this->NAME_OF_CLASS->CurrentValue;
        $this->NAME_OF_CLASS->ViewCustomAttributes = "";

        // CAPACITY
        $this->CAPACITY->ViewValue = $this->CAPACITY->CurrentValue;
        $this->CAPACITY->ViewValue = FormatNumber($this->CAPACITY->ViewValue, 0, -2, -2, -2);
        $this->CAPACITY->ViewCustomAttributes = "";

        // GENDER
        $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
        $this->GENDER->ViewCustomAttributes = "";

        // PICTUREFILE
        $this->PICTUREFILE->ViewValue = $this->PICTUREFILE->CurrentValue;
        $this->PICTUREFILE->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // TARIF_ID
        $curVal = trim(strval($this->TARIF_ID->CurrentValue));
        if ($curVal != "") {
            $this->TARIF_ID->ViewValue = $this->TARIF_ID->lookupCacheOption($curVal);
            if ($this->TARIF_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[TREAT_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->TARIF_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->TARIF_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->TARIF_ID->ViewValue = $this->TARIF_ID->displayValue($arwrk);
                } else {
                    $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
                }
            }
        } else {
            $this->TARIF_ID->ViewValue = null;
        }
        $this->TARIF_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // ISACTIVE
        $this->ISACTIVE->ViewValue = $this->ISACTIVE->CurrentValue;
        $this->ISACTIVE->ViewCustomAttributes = "";

        // NONACTIVEDATE
        $this->NONACTIVEDATE->ViewValue = $this->NONACTIVEDATE->CurrentValue;
        $this->NONACTIVEDATE->ViewValue = FormatDateTime($this->NONACTIVEDATE->ViewValue, 0);
        $this->NONACTIVEDATE->ViewCustomAttributes = "";

        // isviewed
        $this->isviewed->ViewValue = $this->isviewed->CurrentValue;
        $this->isviewed->ViewCustomAttributes = "";

        // KODEKELAS
        $this->KODEKELAS->ViewValue = $this->KODEKELAS->CurrentValue;
        $this->KODEKELAS->ViewCustomAttributes = "";

        // REST_RESPON
        $this->REST_RESPON->ViewValue = $this->REST_RESPON->CurrentValue;
        $this->REST_RESPON->ViewCustomAttributes = "";

        // TERISI
        $this->TERISI->ViewValue = $this->TERISI->CurrentValue;
        $this->TERISI->ViewValue = FormatNumber($this->TERISI->ViewValue, 0, -2, -2, -2);
        $this->TERISI->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // SISKODEKELAS
        $this->SISKODEKELAS->ViewValue = $this->SISKODEKELAS->CurrentValue;
        $this->SISKODEKELAS->ViewCustomAttributes = "";

        // SISKODERAWAT
        $this->SISKODERAWAT->ViewValue = $this->SISKODERAWAT->CurrentValue;
        $this->SISKODERAWAT->ViewCustomAttributes = "";

        // RESPONSESIS
        $this->RESPONSESIS->ViewValue = $this->RESPONSESIS->CurrentValue;
        $this->RESPONSESIS->ViewCustomAttributes = "";

        // TERISIMALE
        $this->TERISIMALE->ViewValue = $this->TERISIMALE->CurrentValue;
        $this->TERISIMALE->ViewValue = FormatNumber($this->TERISIMALE->ViewValue, 0, -2, -2, -2);
        $this->TERISIMALE->ViewCustomAttributes = "";

        // TERISIFEMALE
        $this->TERISIFEMALE->ViewValue = $this->TERISIFEMALE->CurrentValue;
        $this->TERISIFEMALE->ViewValue = FormatNumber($this->TERISIFEMALE->ViewValue, 0, -2, -2, -2);
        $this->TERISIFEMALE->ViewCustomAttributes = "";

        // KDKELASV
        $this->KDKELASV->ViewValue = $this->KDKELASV->CurrentValue;
        $this->KDKELASV->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
        $this->CLASS_ROOM_ID->HrefValue = "";
        $this->CLASS_ROOM_ID->TooltipValue = "";

        // ROOMS_ID
        $this->ROOMS_ID->LinkCustomAttributes = "";
        $this->ROOMS_ID->HrefValue = "";
        $this->ROOMS_ID->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS->LinkCustomAttributes = "";
        $this->NAME_OF_CLASS->HrefValue = "";
        $this->NAME_OF_CLASS->TooltipValue = "";

        // CAPACITY
        $this->CAPACITY->LinkCustomAttributes = "";
        $this->CAPACITY->HrefValue = "";
        $this->CAPACITY->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // PICTUREFILE
        $this->PICTUREFILE->LinkCustomAttributes = "";
        $this->PICTUREFILE->HrefValue = "";
        $this->PICTUREFILE->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // TARIF_ID
        $this->TARIF_ID->LinkCustomAttributes = "";
        $this->TARIF_ID->HrefValue = "";
        $this->TARIF_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // ISACTIVE
        $this->ISACTIVE->LinkCustomAttributes = "";
        $this->ISACTIVE->HrefValue = "";
        $this->ISACTIVE->TooltipValue = "";

        // NONACTIVEDATE
        $this->NONACTIVEDATE->LinkCustomAttributes = "";
        $this->NONACTIVEDATE->HrefValue = "";
        $this->NONACTIVEDATE->TooltipValue = "";

        // isviewed
        $this->isviewed->LinkCustomAttributes = "";
        $this->isviewed->HrefValue = "";
        $this->isviewed->TooltipValue = "";

        // KODEKELAS
        $this->KODEKELAS->LinkCustomAttributes = "";
        $this->KODEKELAS->HrefValue = "";
        $this->KODEKELAS->TooltipValue = "";

        // REST_RESPON
        $this->REST_RESPON->LinkCustomAttributes = "";
        $this->REST_RESPON->HrefValue = "";
        $this->REST_RESPON->TooltipValue = "";

        // TERISI
        $this->TERISI->LinkCustomAttributes = "";
        $this->TERISI->HrefValue = "";
        $this->TERISI->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // SISKODEKELAS
        $this->SISKODEKELAS->LinkCustomAttributes = "";
        $this->SISKODEKELAS->HrefValue = "";
        $this->SISKODEKELAS->TooltipValue = "";

        // SISKODERAWAT
        $this->SISKODERAWAT->LinkCustomAttributes = "";
        $this->SISKODERAWAT->HrefValue = "";
        $this->SISKODERAWAT->TooltipValue = "";

        // RESPONSESIS
        $this->RESPONSESIS->LinkCustomAttributes = "";
        $this->RESPONSESIS->HrefValue = "";
        $this->RESPONSESIS->TooltipValue = "";

        // TERISIMALE
        $this->TERISIMALE->LinkCustomAttributes = "";
        $this->TERISIMALE->HrefValue = "";
        $this->TERISIMALE->TooltipValue = "";

        // TERISIFEMALE
        $this->TERISIFEMALE->LinkCustomAttributes = "";
        $this->TERISIFEMALE->HrefValue = "";
        $this->TERISIFEMALE->TooltipValue = "";

        // KDKELASV
        $this->KDKELASV->LinkCustomAttributes = "";
        $this->KDKELASV->HrefValue = "";
        $this->KDKELASV->TooltipValue = "";

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

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ROOM_ID->EditCustomAttributes = "";
        if (!$this->CLASS_ROOM_ID->Raw) {
            $this->CLASS_ROOM_ID->CurrentValue = HtmlDecode($this->CLASS_ROOM_ID->CurrentValue);
        }
        $this->CLASS_ROOM_ID->EditValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

        // ROOMS_ID
        $this->ROOMS_ID->EditAttrs["class"] = "form-control";
        $this->ROOMS_ID->EditCustomAttributes = "";
        if (!$this->ROOMS_ID->Raw) {
            $this->ROOMS_ID->CurrentValue = HtmlDecode($this->ROOMS_ID->CurrentValue);
        }
        $this->ROOMS_ID->EditValue = $this->ROOMS_ID->CurrentValue;
        $this->ROOMS_ID->PlaceHolder = RemoveHtml($this->ROOMS_ID->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->EditValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS->EditAttrs["class"] = "form-control";
        $this->NAME_OF_CLASS->EditCustomAttributes = "";
        if (!$this->NAME_OF_CLASS->Raw) {
            $this->NAME_OF_CLASS->CurrentValue = HtmlDecode($this->NAME_OF_CLASS->CurrentValue);
        }
        $this->NAME_OF_CLASS->EditValue = $this->NAME_OF_CLASS->CurrentValue;
        $this->NAME_OF_CLASS->PlaceHolder = RemoveHtml($this->NAME_OF_CLASS->caption());

        // CAPACITY
        $this->CAPACITY->EditAttrs["class"] = "form-control";
        $this->CAPACITY->EditCustomAttributes = "";
        $this->CAPACITY->EditValue = $this->CAPACITY->CurrentValue;
        $this->CAPACITY->PlaceHolder = RemoveHtml($this->CAPACITY->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        if (!$this->GENDER->Raw) {
            $this->GENDER->CurrentValue = HtmlDecode($this->GENDER->CurrentValue);
        }
        $this->GENDER->EditValue = $this->GENDER->CurrentValue;
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // PICTUREFILE
        $this->PICTUREFILE->EditAttrs["class"] = "form-control";
        $this->PICTUREFILE->EditCustomAttributes = "";
        if (!$this->PICTUREFILE->Raw) {
            $this->PICTUREFILE->CurrentValue = HtmlDecode($this->PICTUREFILE->CurrentValue);
        }
        $this->PICTUREFILE->EditValue = $this->PICTUREFILE->CurrentValue;
        $this->PICTUREFILE->PlaceHolder = RemoveHtml($this->PICTUREFILE->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // TARIF_ID
        $this->TARIF_ID->EditAttrs["class"] = "form-control";
        $this->TARIF_ID->EditCustomAttributes = "";
        $this->TARIF_ID->PlaceHolder = RemoveHtml($this->TARIF_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // ISACTIVE
        $this->ISACTIVE->EditAttrs["class"] = "form-control";
        $this->ISACTIVE->EditCustomAttributes = "";
        if (!$this->ISACTIVE->Raw) {
            $this->ISACTIVE->CurrentValue = HtmlDecode($this->ISACTIVE->CurrentValue);
        }
        $this->ISACTIVE->EditValue = $this->ISACTIVE->CurrentValue;
        $this->ISACTIVE->PlaceHolder = RemoveHtml($this->ISACTIVE->caption());

        // NONACTIVEDATE
        $this->NONACTIVEDATE->EditAttrs["class"] = "form-control";
        $this->NONACTIVEDATE->EditCustomAttributes = "";
        $this->NONACTIVEDATE->EditValue = FormatDateTime($this->NONACTIVEDATE->CurrentValue, 8);
        $this->NONACTIVEDATE->PlaceHolder = RemoveHtml($this->NONACTIVEDATE->caption());

        // isviewed
        $this->isviewed->EditAttrs["class"] = "form-control";
        $this->isviewed->EditCustomAttributes = "";
        if (!$this->isviewed->Raw) {
            $this->isviewed->CurrentValue = HtmlDecode($this->isviewed->CurrentValue);
        }
        $this->isviewed->EditValue = $this->isviewed->CurrentValue;
        $this->isviewed->PlaceHolder = RemoveHtml($this->isviewed->caption());

        // KODEKELAS
        $this->KODEKELAS->EditAttrs["class"] = "form-control";
        $this->KODEKELAS->EditCustomAttributes = "";
        if (!$this->KODEKELAS->Raw) {
            $this->KODEKELAS->CurrentValue = HtmlDecode($this->KODEKELAS->CurrentValue);
        }
        $this->KODEKELAS->EditValue = $this->KODEKELAS->CurrentValue;
        $this->KODEKELAS->PlaceHolder = RemoveHtml($this->KODEKELAS->caption());

        // REST_RESPON
        $this->REST_RESPON->EditAttrs["class"] = "form-control";
        $this->REST_RESPON->EditCustomAttributes = "";
        $this->REST_RESPON->EditValue = $this->REST_RESPON->CurrentValue;
        $this->REST_RESPON->PlaceHolder = RemoveHtml($this->REST_RESPON->caption());

        // TERISI
        $this->TERISI->EditAttrs["class"] = "form-control";
        $this->TERISI->EditCustomAttributes = "";
        $this->TERISI->EditValue = $this->TERISI->CurrentValue;
        $this->TERISI->PlaceHolder = RemoveHtml($this->TERISI->caption());

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

        // SISKODEKELAS
        $this->SISKODEKELAS->EditAttrs["class"] = "form-control";
        $this->SISKODEKELAS->EditCustomAttributes = "";
        if (!$this->SISKODEKELAS->Raw) {
            $this->SISKODEKELAS->CurrentValue = HtmlDecode($this->SISKODEKELAS->CurrentValue);
        }
        $this->SISKODEKELAS->EditValue = $this->SISKODEKELAS->CurrentValue;
        $this->SISKODEKELAS->PlaceHolder = RemoveHtml($this->SISKODEKELAS->caption());

        // SISKODERAWAT
        $this->SISKODERAWAT->EditAttrs["class"] = "form-control";
        $this->SISKODERAWAT->EditCustomAttributes = "";
        if (!$this->SISKODERAWAT->Raw) {
            $this->SISKODERAWAT->CurrentValue = HtmlDecode($this->SISKODERAWAT->CurrentValue);
        }
        $this->SISKODERAWAT->EditValue = $this->SISKODERAWAT->CurrentValue;
        $this->SISKODERAWAT->PlaceHolder = RemoveHtml($this->SISKODERAWAT->caption());

        // RESPONSESIS
        $this->RESPONSESIS->EditAttrs["class"] = "form-control";
        $this->RESPONSESIS->EditCustomAttributes = "";
        $this->RESPONSESIS->EditValue = $this->RESPONSESIS->CurrentValue;
        $this->RESPONSESIS->PlaceHolder = RemoveHtml($this->RESPONSESIS->caption());

        // TERISIMALE
        $this->TERISIMALE->EditAttrs["class"] = "form-control";
        $this->TERISIMALE->EditCustomAttributes = "";
        $this->TERISIMALE->EditValue = $this->TERISIMALE->CurrentValue;
        $this->TERISIMALE->PlaceHolder = RemoveHtml($this->TERISIMALE->caption());

        // TERISIFEMALE
        $this->TERISIFEMALE->EditAttrs["class"] = "form-control";
        $this->TERISIFEMALE->EditCustomAttributes = "";
        $this->TERISIFEMALE->EditValue = $this->TERISIFEMALE->CurrentValue;
        $this->TERISIFEMALE->PlaceHolder = RemoveHtml($this->TERISIFEMALE->caption());

        // KDKELASV
        $this->KDKELASV->EditAttrs["class"] = "form-control";
        $this->KDKELASV->EditCustomAttributes = "";
        if (!$this->KDKELASV->Raw) {
            $this->KDKELASV->CurrentValue = HtmlDecode($this->KDKELASV->CurrentValue);
        }
        $this->KDKELASV->EditValue = $this->KDKELASV->CurrentValue;
        $this->KDKELASV->PlaceHolder = RemoveHtml($this->KDKELASV->caption());

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
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->ROOMS_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->NAME_OF_CLASS);
                    $doc->exportCaption($this->CAPACITY);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->PICTUREFILE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->ISACTIVE);
                    $doc->exportCaption($this->NONACTIVEDATE);
                    $doc->exportCaption($this->isviewed);
                    $doc->exportCaption($this->KODEKELAS);
                    $doc->exportCaption($this->REST_RESPON);
                    $doc->exportCaption($this->TERISI);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->SISKODEKELAS);
                    $doc->exportCaption($this->SISKODERAWAT);
                    $doc->exportCaption($this->RESPONSESIS);
                    $doc->exportCaption($this->TERISIMALE);
                    $doc->exportCaption($this->TERISIFEMALE);
                    $doc->exportCaption($this->KDKELASV);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->ROOMS_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->NAME_OF_CLASS);
                    $doc->exportCaption($this->CAPACITY);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->PICTUREFILE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->ISACTIVE);
                    $doc->exportCaption($this->NONACTIVEDATE);
                    $doc->exportCaption($this->isviewed);
                    $doc->exportCaption($this->KODEKELAS);
                    $doc->exportCaption($this->TERISI);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->SISKODEKELAS);
                    $doc->exportCaption($this->SISKODERAWAT);
                    $doc->exportCaption($this->TERISIMALE);
                    $doc->exportCaption($this->TERISIFEMALE);
                    $doc->exportCaption($this->KDKELASV);
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
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->ROOMS_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->NAME_OF_CLASS);
                        $doc->exportField($this->CAPACITY);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->PICTUREFILE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->ISACTIVE);
                        $doc->exportField($this->NONACTIVEDATE);
                        $doc->exportField($this->isviewed);
                        $doc->exportField($this->KODEKELAS);
                        $doc->exportField($this->REST_RESPON);
                        $doc->exportField($this->TERISI);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->SISKODEKELAS);
                        $doc->exportField($this->SISKODERAWAT);
                        $doc->exportField($this->RESPONSESIS);
                        $doc->exportField($this->TERISIMALE);
                        $doc->exportField($this->TERISIFEMALE);
                        $doc->exportField($this->KDKELASV);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->ROOMS_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->NAME_OF_CLASS);
                        $doc->exportField($this->CAPACITY);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->PICTUREFILE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->ISACTIVE);
                        $doc->exportField($this->NONACTIVEDATE);
                        $doc->exportField($this->isviewed);
                        $doc->exportField($this->KODEKELAS);
                        $doc->exportField($this->TERISI);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->SISKODEKELAS);
                        $doc->exportField($this->SISKODERAWAT);
                        $doc->exportField($this->TERISIMALE);
                        $doc->exportField($this->TERISIFEMALE);
                        $doc->exportField($this->KDKELASV);
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
