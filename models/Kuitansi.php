<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for KUITANSI
 */
class Kuitansi extends DbTable
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
    public $KUITANSI_ID;
    public $PAYOR_ID;
    public $NO_REGISTRATION;
    public $PAY_METHOD_ID;
    public $KUITANSI_DATE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $ATAS_NAMA;
    public $AMOUNT_PAID;
    public $PAYOR;
    public $PAYMENT_DATE;
    public $DESCRIPTION;
    public $PRINT_DATE;
    public $KUITANSI_TYPE;
    public $AMOUNT;
    public $AMOUNT_INSTALL;
    public $VISIT_ID;
    public $CLASS_ROOM_ID;
    public $STATUS_PASIEN_ID;
    public $CLASS_ID;
    public $FULLNAME;
    public $FA_V;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'KUITANSI';
        $this->TableName = 'KUITANSI';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[KUITANSI]";
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
        $this->ORG_UNIT_CODE = new DbField('KUITANSI', 'KUITANSI', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // KUITANSI_ID
        $this->KUITANSI_ID = new DbField('KUITANSI', 'KUITANSI', 'x_KUITANSI_ID', 'KUITANSI_ID', '[KUITANSI_ID]', '[KUITANSI_ID]', 200, 200, -1, false, '[KUITANSI_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KUITANSI_ID->IsPrimaryKey = true; // Primary key field
        $this->KUITANSI_ID->Nullable = false; // NOT NULL field
        $this->KUITANSI_ID->Required = true; // Required field
        $this->KUITANSI_ID->Sortable = true; // Allow sort
        $this->KUITANSI_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KUITANSI_ID->Param, "CustomMsg");
        $this->Fields['KUITANSI_ID'] = &$this->KUITANSI_ID;

        // PAYOR_ID
        $this->PAYOR_ID = new DbField('KUITANSI', 'KUITANSI', 'x_PAYOR_ID', 'PAYOR_ID', '[PAYOR_ID]', '[PAYOR_ID]', 200, 50, -1, false, '[PAYOR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYOR_ID->Sortable = true; // Allow sort
        $this->PAYOR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ID->Param, "CustomMsg");
        $this->Fields['PAYOR_ID'] = &$this->PAYOR_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('KUITANSI', 'KUITANSI', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 25, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID = new DbField('KUITANSI', 'KUITANSI', 'x_PAY_METHOD_ID', 'PAY_METHOD_ID', '[PAY_METHOD_ID]', 'CAST([PAY_METHOD_ID] AS NVARCHAR)', 17, 1, -1, false, '[PAY_METHOD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAY_METHOD_ID->Sortable = true; // Allow sort
        $this->PAY_METHOD_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PAY_METHOD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAY_METHOD_ID->Param, "CustomMsg");
        $this->Fields['PAY_METHOD_ID'] = &$this->PAY_METHOD_ID;

        // KUITANSI_DATE
        $this->KUITANSI_DATE = new DbField('KUITANSI', 'KUITANSI', 'x_KUITANSI_DATE', 'KUITANSI_DATE', '[KUITANSI_DATE]', CastDateFieldForLike("[KUITANSI_DATE]", 0, "DB"), 135, 8, 0, false, '[KUITANSI_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KUITANSI_DATE->Sortable = true; // Allow sort
        $this->KUITANSI_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->KUITANSI_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KUITANSI_DATE->Param, "CustomMsg");
        $this->Fields['KUITANSI_DATE'] = &$this->KUITANSI_DATE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('KUITANSI', 'KUITANSI', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('KUITANSI', 'KUITANSI', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 200, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // ATAS_NAMA
        $this->ATAS_NAMA = new DbField('KUITANSI', 'KUITANSI', 'x_ATAS_NAMA', 'ATAS_NAMA', '[ATAS_NAMA]', '[ATAS_NAMA]', 200, 200, -1, false, '[ATAS_NAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ATAS_NAMA->Sortable = true; // Allow sort
        $this->ATAS_NAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ATAS_NAMA->Param, "CustomMsg");
        $this->Fields['ATAS_NAMA'] = &$this->ATAS_NAMA;

        // AMOUNT_PAID
        $this->AMOUNT_PAID = new DbField('KUITANSI', 'KUITANSI', 'x_AMOUNT_PAID', 'AMOUNT_PAID', '[AMOUNT_PAID]', 'CAST([AMOUNT_PAID] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_PAID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PAID->Sortable = true; // Allow sort
        $this->AMOUNT_PAID->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_PAID->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_PAID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PAID->Param, "CustomMsg");
        $this->Fields['AMOUNT_PAID'] = &$this->AMOUNT_PAID;

        // PAYOR
        $this->PAYOR = new DbField('KUITANSI', 'KUITANSI', 'x_PAYOR', 'PAYOR', '[PAYOR]', '[PAYOR]', 200, 200, -1, false, '[PAYOR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYOR->Sortable = true; // Allow sort
        $this->PAYOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR->Param, "CustomMsg");
        $this->Fields['PAYOR'] = &$this->PAYOR;

        // PAYMENT_DATE
        $this->PAYMENT_DATE = new DbField('KUITANSI', 'KUITANSI', 'x_PAYMENT_DATE', 'PAYMENT_DATE', '[PAYMENT_DATE]', CastDateFieldForLike("[PAYMENT_DATE]", 0, "DB"), 135, 8, 0, false, '[PAYMENT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYMENT_DATE->Sortable = true; // Allow sort
        $this->PAYMENT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PAYMENT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYMENT_DATE->Param, "CustomMsg");
        $this->Fields['PAYMENT_DATE'] = &$this->PAYMENT_DATE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('KUITANSI', 'KUITANSI', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('KUITANSI', 'KUITANSI', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = true; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // KUITANSI_TYPE
        $this->KUITANSI_TYPE = new DbField('KUITANSI', 'KUITANSI', 'x_KUITANSI_TYPE', 'KUITANSI_TYPE', '[KUITANSI_TYPE]', 'CAST([KUITANSI_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[KUITANSI_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KUITANSI_TYPE->Sortable = true; // Allow sort
        $this->KUITANSI_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->KUITANSI_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KUITANSI_TYPE->Param, "CustomMsg");
        $this->Fields['KUITANSI_TYPE'] = &$this->KUITANSI_TYPE;

        // AMOUNT
        $this->AMOUNT = new DbField('KUITANSI', 'KUITANSI', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = true; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // AMOUNT_INSTALL
        $this->AMOUNT_INSTALL = new DbField('KUITANSI', 'KUITANSI', 'x_AMOUNT_INSTALL', 'AMOUNT_INSTALL', '[AMOUNT_INSTALL]', 'CAST([AMOUNT_INSTALL] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_INSTALL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_INSTALL->Sortable = true; // Allow sort
        $this->AMOUNT_INSTALL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_INSTALL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_INSTALL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_INSTALL->Param, "CustomMsg");
        $this->Fields['AMOUNT_INSTALL'] = &$this->AMOUNT_INSTALL;

        // VISIT_ID
        $this->VISIT_ID = new DbField('KUITANSI', 'KUITANSI', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID = new DbField('KUITANSI', 'KUITANSI', 'x_CLASS_ROOM_ID', 'CLASS_ROOM_ID', '[CLASS_ROOM_ID]', '[CLASS_ROOM_ID]', 200, 5, -1, false, '[CLASS_ROOM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ROOM_ID->Sortable = true; // Allow sort
        $this->CLASS_ROOM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ROOM_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ROOM_ID'] = &$this->CLASS_ROOM_ID;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('KUITANSI', 'KUITANSI', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // CLASS_ID
        $this->CLASS_ID = new DbField('KUITANSI', 'KUITANSI', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // FULLNAME
        $this->FULLNAME = new DbField('KUITANSI', 'KUITANSI', 'x_FULLNAME', 'FULLNAME', '[FULLNAME]', '[FULLNAME]', 200, 100, -1, false, '[FULLNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FULLNAME->Sortable = true; // Allow sort
        $this->FULLNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FULLNAME->Param, "CustomMsg");
        $this->Fields['FULLNAME'] = &$this->FULLNAME;

        // FA_V
        $this->FA_V = new DbField('KUITANSI', 'KUITANSI', 'x_FA_V', 'FA_V', '[FA_V]', 'CAST([FA_V] AS NVARCHAR)', 2, 2, -1, false, '[FA_V]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V->Sortable = true; // Allow sort
        $this->FA_V->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FA_V->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V->Param, "CustomMsg");
        $this->Fields['FA_V'] = &$this->FA_V;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[KUITANSI]";
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
            if (array_key_exists('KUITANSI_ID', $rs)) {
                AddFilter($where, QuotedName('KUITANSI_ID', $this->Dbid) . '=' . QuotedValue($rs['KUITANSI_ID'], $this->KUITANSI_ID->DataType, $this->Dbid));
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
        $this->KUITANSI_ID->DbValue = $row['KUITANSI_ID'];
        $this->PAYOR_ID->DbValue = $row['PAYOR_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->PAY_METHOD_ID->DbValue = $row['PAY_METHOD_ID'];
        $this->KUITANSI_DATE->DbValue = $row['KUITANSI_DATE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->ATAS_NAMA->DbValue = $row['ATAS_NAMA'];
        $this->AMOUNT_PAID->DbValue = $row['AMOUNT_PAID'];
        $this->PAYOR->DbValue = $row['PAYOR'];
        $this->PAYMENT_DATE->DbValue = $row['PAYMENT_DATE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->KUITANSI_TYPE->DbValue = $row['KUITANSI_TYPE'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->AMOUNT_INSTALL->DbValue = $row['AMOUNT_INSTALL'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->CLASS_ROOM_ID->DbValue = $row['CLASS_ROOM_ID'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->FULLNAME->DbValue = $row['FULLNAME'];
        $this->FA_V->DbValue = $row['FA_V'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [KUITANSI_ID] = '@KUITANSI_ID@'";
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
        $val = $current ? $this->KUITANSI_ID->CurrentValue : $this->KUITANSI_ID->OldValue;
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
                $this->KUITANSI_ID->CurrentValue = $keys[1];
            } else {
                $this->KUITANSI_ID->OldValue = $keys[1];
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
            $val = array_key_exists('KUITANSI_ID', $row) ? $row['KUITANSI_ID'] : null;
        } else {
            $val = $this->KUITANSI_ID->OldValue !== null ? $this->KUITANSI_ID->OldValue : $this->KUITANSI_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@KUITANSI_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("KuitansiList");
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
        if ($pageName == "KuitansiView") {
            return $Language->phrase("View");
        } elseif ($pageName == "KuitansiEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "KuitansiAdd") {
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
                return "KuitansiView";
            case Config("API_ADD_ACTION"):
                return "KuitansiAdd";
            case Config("API_EDIT_ACTION"):
                return "KuitansiEdit";
            case Config("API_DELETE_ACTION"):
                return "KuitansiDelete";
            case Config("API_LIST_ACTION"):
                return "KuitansiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "KuitansiList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("KuitansiView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("KuitansiView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "KuitansiAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "KuitansiAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("KuitansiEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("KuitansiAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("KuitansiDelete", $this->getUrlParm());
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
        $json .= ",KUITANSI_ID:" . JsonEncode($this->KUITANSI_ID->CurrentValue, "string");
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
        if ($this->KUITANSI_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->KUITANSI_ID->CurrentValue);
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
            if (($keyValue = Param("KUITANSI_ID") ?? Route("KUITANSI_ID")) !== null) {
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
                $this->KUITANSI_ID->CurrentValue = $key[1];
            } else {
                $this->KUITANSI_ID->OldValue = $key[1];
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
        $this->KUITANSI_ID->setDbValue($row['KUITANSI_ID']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->PAY_METHOD_ID->setDbValue($row['PAY_METHOD_ID']);
        $this->KUITANSI_DATE->setDbValue($row['KUITANSI_DATE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->ATAS_NAMA->setDbValue($row['ATAS_NAMA']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
        $this->PAYOR->setDbValue($row['PAYOR']);
        $this->PAYMENT_DATE->setDbValue($row['PAYMENT_DATE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->KUITANSI_TYPE->setDbValue($row['KUITANSI_TYPE']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->AMOUNT_INSTALL->setDbValue($row['AMOUNT_INSTALL']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->CLASS_ROOM_ID->setDbValue($row['CLASS_ROOM_ID']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->FULLNAME->setDbValue($row['FULLNAME']);
        $this->FA_V->setDbValue($row['FA_V']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // KUITANSI_ID

        // PAYOR_ID

        // NO_REGISTRATION

        // PAY_METHOD_ID

        // KUITANSI_DATE

        // MODIFIED_DATE

        // MODIFIED_BY

        // ATAS_NAMA

        // AMOUNT_PAID

        // PAYOR

        // PAYMENT_DATE

        // DESCRIPTION

        // PRINT_DATE

        // KUITANSI_TYPE

        // AMOUNT

        // AMOUNT_INSTALL

        // VISIT_ID

        // CLASS_ROOM_ID

        // STATUS_PASIEN_ID

        // CLASS_ID

        // FULLNAME

        // FA_V

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // KUITANSI_ID
        $this->KUITANSI_ID->ViewValue = $this->KUITANSI_ID->CurrentValue;
        $this->KUITANSI_ID->ViewCustomAttributes = "";

        // PAYOR_ID
        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->ViewValue = $this->PAY_METHOD_ID->CurrentValue;
        $this->PAY_METHOD_ID->ViewValue = FormatNumber($this->PAY_METHOD_ID->ViewValue, 0, -2, -2, -2);
        $this->PAY_METHOD_ID->ViewCustomAttributes = "";

        // KUITANSI_DATE
        $this->KUITANSI_DATE->ViewValue = $this->KUITANSI_DATE->CurrentValue;
        $this->KUITANSI_DATE->ViewValue = FormatDateTime($this->KUITANSI_DATE->ViewValue, 0);
        $this->KUITANSI_DATE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // ATAS_NAMA
        $this->ATAS_NAMA->ViewValue = $this->ATAS_NAMA->CurrentValue;
        $this->ATAS_NAMA->ViewCustomAttributes = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->ViewValue = FormatNumber($this->AMOUNT_PAID->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_PAID->ViewCustomAttributes = "";

        // PAYOR
        $this->PAYOR->ViewValue = $this->PAYOR->CurrentValue;
        $this->PAYOR->ViewCustomAttributes = "";

        // PAYMENT_DATE
        $this->PAYMENT_DATE->ViewValue = $this->PAYMENT_DATE->CurrentValue;
        $this->PAYMENT_DATE->ViewValue = FormatDateTime($this->PAYMENT_DATE->ViewValue, 0);
        $this->PAYMENT_DATE->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // PRINT_DATE
        $this->PRINT_DATE->ViewValue = $this->PRINT_DATE->CurrentValue;
        $this->PRINT_DATE->ViewValue = FormatDateTime($this->PRINT_DATE->ViewValue, 0);
        $this->PRINT_DATE->ViewCustomAttributes = "";

        // KUITANSI_TYPE
        $this->KUITANSI_TYPE->ViewValue = $this->KUITANSI_TYPE->CurrentValue;
        $this->KUITANSI_TYPE->ViewValue = FormatNumber($this->KUITANSI_TYPE->ViewValue, 0, -2, -2, -2);
        $this->KUITANSI_TYPE->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // AMOUNT_INSTALL
        $this->AMOUNT_INSTALL->ViewValue = $this->AMOUNT_INSTALL->CurrentValue;
        $this->AMOUNT_INSTALL->ViewValue = FormatNumber($this->AMOUNT_INSTALL->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_INSTALL->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->ViewValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // CLASS_ID
        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID->ViewCustomAttributes = "";

        // FULLNAME
        $this->FULLNAME->ViewValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->ViewCustomAttributes = "";

        // FA_V
        $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
        $this->FA_V->ViewValue = FormatNumber($this->FA_V->ViewValue, 0, -2, -2, -2);
        $this->FA_V->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // KUITANSI_ID
        $this->KUITANSI_ID->LinkCustomAttributes = "";
        $this->KUITANSI_ID->HrefValue = "";
        $this->KUITANSI_ID->TooltipValue = "";

        // PAYOR_ID
        $this->PAYOR_ID->LinkCustomAttributes = "";
        $this->PAYOR_ID->HrefValue = "";
        $this->PAYOR_ID->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->LinkCustomAttributes = "";
        $this->PAY_METHOD_ID->HrefValue = "";
        $this->PAY_METHOD_ID->TooltipValue = "";

        // KUITANSI_DATE
        $this->KUITANSI_DATE->LinkCustomAttributes = "";
        $this->KUITANSI_DATE->HrefValue = "";
        $this->KUITANSI_DATE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // ATAS_NAMA
        $this->ATAS_NAMA->LinkCustomAttributes = "";
        $this->ATAS_NAMA->HrefValue = "";
        $this->ATAS_NAMA->TooltipValue = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->LinkCustomAttributes = "";
        $this->AMOUNT_PAID->HrefValue = "";
        $this->AMOUNT_PAID->TooltipValue = "";

        // PAYOR
        $this->PAYOR->LinkCustomAttributes = "";
        $this->PAYOR->HrefValue = "";
        $this->PAYOR->TooltipValue = "";

        // PAYMENT_DATE
        $this->PAYMENT_DATE->LinkCustomAttributes = "";
        $this->PAYMENT_DATE->HrefValue = "";
        $this->PAYMENT_DATE->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // PRINT_DATE
        $this->PRINT_DATE->LinkCustomAttributes = "";
        $this->PRINT_DATE->HrefValue = "";
        $this->PRINT_DATE->TooltipValue = "";

        // KUITANSI_TYPE
        $this->KUITANSI_TYPE->LinkCustomAttributes = "";
        $this->KUITANSI_TYPE->HrefValue = "";
        $this->KUITANSI_TYPE->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // AMOUNT_INSTALL
        $this->AMOUNT_INSTALL->LinkCustomAttributes = "";
        $this->AMOUNT_INSTALL->HrefValue = "";
        $this->AMOUNT_INSTALL->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->LinkCustomAttributes = "";
        $this->CLASS_ROOM_ID->HrefValue = "";
        $this->CLASS_ROOM_ID->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // FULLNAME
        $this->FULLNAME->LinkCustomAttributes = "";
        $this->FULLNAME->HrefValue = "";
        $this->FULLNAME->TooltipValue = "";

        // FA_V
        $this->FA_V->LinkCustomAttributes = "";
        $this->FA_V->HrefValue = "";
        $this->FA_V->TooltipValue = "";

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

        // KUITANSI_ID
        $this->KUITANSI_ID->EditAttrs["class"] = "form-control";
        $this->KUITANSI_ID->EditCustomAttributes = "";
        if (!$this->KUITANSI_ID->Raw) {
            $this->KUITANSI_ID->CurrentValue = HtmlDecode($this->KUITANSI_ID->CurrentValue);
        }
        $this->KUITANSI_ID->EditValue = $this->KUITANSI_ID->CurrentValue;
        $this->KUITANSI_ID->PlaceHolder = RemoveHtml($this->KUITANSI_ID->caption());

        // PAYOR_ID
        $this->PAYOR_ID->EditAttrs["class"] = "form-control";
        $this->PAYOR_ID->EditCustomAttributes = "";
        if (!$this->PAYOR_ID->Raw) {
            $this->PAYOR_ID->CurrentValue = HtmlDecode($this->PAYOR_ID->CurrentValue);
        }
        $this->PAYOR_ID->EditValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // PAY_METHOD_ID
        $this->PAY_METHOD_ID->EditAttrs["class"] = "form-control";
        $this->PAY_METHOD_ID->EditCustomAttributes = "";
        $this->PAY_METHOD_ID->EditValue = $this->PAY_METHOD_ID->CurrentValue;
        $this->PAY_METHOD_ID->PlaceHolder = RemoveHtml($this->PAY_METHOD_ID->caption());

        // KUITANSI_DATE
        $this->KUITANSI_DATE->EditAttrs["class"] = "form-control";
        $this->KUITANSI_DATE->EditCustomAttributes = "";
        $this->KUITANSI_DATE->EditValue = FormatDateTime($this->KUITANSI_DATE->CurrentValue, 8);
        $this->KUITANSI_DATE->PlaceHolder = RemoveHtml($this->KUITANSI_DATE->caption());

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

        // ATAS_NAMA
        $this->ATAS_NAMA->EditAttrs["class"] = "form-control";
        $this->ATAS_NAMA->EditCustomAttributes = "";
        if (!$this->ATAS_NAMA->Raw) {
            $this->ATAS_NAMA->CurrentValue = HtmlDecode($this->ATAS_NAMA->CurrentValue);
        }
        $this->ATAS_NAMA->EditValue = $this->ATAS_NAMA->CurrentValue;
        $this->ATAS_NAMA->PlaceHolder = RemoveHtml($this->ATAS_NAMA->caption());

        // AMOUNT_PAID
        $this->AMOUNT_PAID->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PAID->EditCustomAttributes = "";
        $this->AMOUNT_PAID->EditValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->PlaceHolder = RemoveHtml($this->AMOUNT_PAID->caption());
        if (strval($this->AMOUNT_PAID->EditValue) != "" && is_numeric($this->AMOUNT_PAID->EditValue)) {
            $this->AMOUNT_PAID->EditValue = FormatNumber($this->AMOUNT_PAID->EditValue, -2, -2, -2, -2);
        }

        // PAYOR
        $this->PAYOR->EditAttrs["class"] = "form-control";
        $this->PAYOR->EditCustomAttributes = "";
        if (!$this->PAYOR->Raw) {
            $this->PAYOR->CurrentValue = HtmlDecode($this->PAYOR->CurrentValue);
        }
        $this->PAYOR->EditValue = $this->PAYOR->CurrentValue;
        $this->PAYOR->PlaceHolder = RemoveHtml($this->PAYOR->caption());

        // PAYMENT_DATE
        $this->PAYMENT_DATE->EditAttrs["class"] = "form-control";
        $this->PAYMENT_DATE->EditCustomAttributes = "";
        $this->PAYMENT_DATE->EditValue = FormatDateTime($this->PAYMENT_DATE->CurrentValue, 8);
        $this->PAYMENT_DATE->PlaceHolder = RemoveHtml($this->PAYMENT_DATE->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // PRINT_DATE
        $this->PRINT_DATE->EditAttrs["class"] = "form-control";
        $this->PRINT_DATE->EditCustomAttributes = "";
        $this->PRINT_DATE->EditValue = FormatDateTime($this->PRINT_DATE->CurrentValue, 8);
        $this->PRINT_DATE->PlaceHolder = RemoveHtml($this->PRINT_DATE->caption());

        // KUITANSI_TYPE
        $this->KUITANSI_TYPE->EditAttrs["class"] = "form-control";
        $this->KUITANSI_TYPE->EditCustomAttributes = "";
        $this->KUITANSI_TYPE->EditValue = $this->KUITANSI_TYPE->CurrentValue;
        $this->KUITANSI_TYPE->PlaceHolder = RemoveHtml($this->KUITANSI_TYPE->caption());

        // AMOUNT
        $this->AMOUNT->EditAttrs["class"] = "form-control";
        $this->AMOUNT->EditCustomAttributes = "";
        $this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
        if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue)) {
            $this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // AMOUNT_INSTALL
        $this->AMOUNT_INSTALL->EditAttrs["class"] = "form-control";
        $this->AMOUNT_INSTALL->EditCustomAttributes = "";
        $this->AMOUNT_INSTALL->EditValue = $this->AMOUNT_INSTALL->CurrentValue;
        $this->AMOUNT_INSTALL->PlaceHolder = RemoveHtml($this->AMOUNT_INSTALL->caption());
        if (strval($this->AMOUNT_INSTALL->EditValue) != "" && is_numeric($this->AMOUNT_INSTALL->EditValue)) {
            $this->AMOUNT_INSTALL->EditValue = FormatNumber($this->AMOUNT_INSTALL->EditValue, -2, -2, -2, -2);
        }

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

        // CLASS_ROOM_ID
        $this->CLASS_ROOM_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ROOM_ID->EditCustomAttributes = "";
        if (!$this->CLASS_ROOM_ID->Raw) {
            $this->CLASS_ROOM_ID->CurrentValue = HtmlDecode($this->CLASS_ROOM_ID->CurrentValue);
        }
        $this->CLASS_ROOM_ID->EditValue = $this->CLASS_ROOM_ID->CurrentValue;
        $this->CLASS_ROOM_ID->PlaceHolder = RemoveHtml($this->CLASS_ROOM_ID->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->EditValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // FULLNAME
        $this->FULLNAME->EditAttrs["class"] = "form-control";
        $this->FULLNAME->EditCustomAttributes = "";
        if (!$this->FULLNAME->Raw) {
            $this->FULLNAME->CurrentValue = HtmlDecode($this->FULLNAME->CurrentValue);
        }
        $this->FULLNAME->EditValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->PlaceHolder = RemoveHtml($this->FULLNAME->caption());

        // FA_V
        $this->FA_V->EditAttrs["class"] = "form-control";
        $this->FA_V->EditCustomAttributes = "";
        $this->FA_V->EditValue = $this->FA_V->CurrentValue;
        $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

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
                    $doc->exportCaption($this->KUITANSI_ID);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->PAY_METHOD_ID);
                    $doc->exportCaption($this->KUITANSI_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->ATAS_NAMA);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->PAYOR);
                    $doc->exportCaption($this->PAYMENT_DATE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->KUITANSI_TYPE);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->AMOUNT_INSTALL);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->FA_V);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->KUITANSI_ID);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->PAY_METHOD_ID);
                    $doc->exportCaption($this->KUITANSI_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->ATAS_NAMA);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->PAYOR);
                    $doc->exportCaption($this->PAYMENT_DATE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->KUITANSI_TYPE);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->AMOUNT_INSTALL);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->CLASS_ROOM_ID);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->FA_V);
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
                        $doc->exportField($this->KUITANSI_ID);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->PAY_METHOD_ID);
                        $doc->exportField($this->KUITANSI_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->ATAS_NAMA);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->PAYOR);
                        $doc->exportField($this->PAYMENT_DATE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->KUITANSI_TYPE);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->AMOUNT_INSTALL);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->FA_V);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->KUITANSI_ID);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->PAY_METHOD_ID);
                        $doc->exportField($this->KUITANSI_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->ATAS_NAMA);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->PAYOR);
                        $doc->exportField($this->PAYMENT_DATE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->KUITANSI_TYPE);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->AMOUNT_INSTALL);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->CLASS_ROOM_ID);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->FA_V);
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
