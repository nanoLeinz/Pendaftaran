<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for SETORAN_BILLING
 */
class SetoranBilling extends DbTable
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
    public $SPPKASIR;
    public $SPPKASIRDATE;
    public $SPPKASIRUSER;
    public $SPPKASIRNAME;
    public $NO_REGISTRATION;
    public $THENAME;
    public $THEID;
    public $ISRJ;
    public $AMOUNTPAID;
    public $LUNAS_TYPE;
    public $STATUS_PASIEN_ID;
    public $MATERIALMED;
    public $MPPJOURNAL;
    public $MPPJOURNALDATE;
    public $MPPJOURNALBY;
    public $PRINTDATE;
    public $PRINTBY;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'SETORAN_BILLING';
        $this->TableName = 'SETORAN_BILLING';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[SETORAN_BILLING]";
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

        // SPPKASIR
        $this->SPPKASIR = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_SPPKASIR', 'SPPKASIR', '[SPPKASIR]', '[SPPKASIR]', 200, 50, -1, false, '[SPPKASIR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPKASIR->IsPrimaryKey = true; // Primary key field
        $this->SPPKASIR->Nullable = false; // NOT NULL field
        $this->SPPKASIR->Required = true; // Required field
        $this->SPPKASIR->Sortable = true; // Allow sort
        $this->SPPKASIR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPKASIR->Param, "CustomMsg");
        $this->Fields['SPPKASIR'] = &$this->SPPKASIR;

        // SPPKASIRDATE
        $this->SPPKASIRDATE = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_SPPKASIRDATE', 'SPPKASIRDATE', '[SPPKASIRDATE]', CastDateFieldForLike("[SPPKASIRDATE]", 0, "DB"), 135, 8, 0, false, '[SPPKASIRDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPKASIRDATE->Sortable = true; // Allow sort
        $this->SPPKASIRDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SPPKASIRDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPKASIRDATE->Param, "CustomMsg");
        $this->Fields['SPPKASIRDATE'] = &$this->SPPKASIRDATE;

        // SPPKASIRUSER
        $this->SPPKASIRUSER = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_SPPKASIRUSER', 'SPPKASIRUSER', '[SPPKASIRUSER]', '[SPPKASIRUSER]', 200, 50, -1, false, '[SPPKASIRUSER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPKASIRUSER->Sortable = true; // Allow sort
        $this->SPPKASIRUSER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPKASIRUSER->Param, "CustomMsg");
        $this->Fields['SPPKASIRUSER'] = &$this->SPPKASIRUSER;

        // SPPKASIRNAME
        $this->SPPKASIRNAME = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_SPPKASIRNAME', 'SPPKASIRNAME', '[SPPKASIRNAME]', '[SPPKASIRNAME]', 200, 250, -1, false, '[SPPKASIRNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPPKASIRNAME->Sortable = true; // Allow sort
        $this->SPPKASIRNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPPKASIRNAME->Param, "CustomMsg");
        $this->Fields['SPPKASIRNAME'] = &$this->SPPKASIRNAME;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // THENAME
        $this->THENAME = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_THENAME', 'THENAME', '[THENAME]', '[THENAME]', 200, 150, -1, false, '[THENAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THENAME->Sortable = true; // Allow sort
        $this->THENAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THENAME->Param, "CustomMsg");
        $this->Fields['THENAME'] = &$this->THENAME;

        // THEID
        $this->THEID = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_THEID', 'THEID', '[THEID]', '[THEID]', 200, 50, -1, false, '[THEID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEID->Sortable = true; // Allow sort
        $this->THEID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEID->Param, "CustomMsg");
        $this->Fields['THEID'] = &$this->THEID;

        // ISRJ
        $this->ISRJ = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_ISRJ', 'ISRJ', '[ISRJ]', '[ISRJ]', 200, 1, -1, false, '[ISRJ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISRJ->Sortable = true; // Allow sort
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // AMOUNTPAID
        $this->AMOUNTPAID = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_AMOUNTPAID', 'AMOUNTPAID', '[AMOUNTPAID]', 'CAST([AMOUNTPAID] AS NVARCHAR)', 131, 8, -1, false, '[AMOUNTPAID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNTPAID->Sortable = true; // Allow sort
        $this->AMOUNTPAID->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNTPAID->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNTPAID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNTPAID->Param, "CustomMsg");
        $this->Fields['AMOUNTPAID'] = &$this->AMOUNTPAID;

        // LUNAS_TYPE
        $this->LUNAS_TYPE = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_LUNAS_TYPE', 'LUNAS_TYPE', '[LUNAS_TYPE]', '[LUNAS_TYPE]', 200, 1, -1, false, '[LUNAS_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LUNAS_TYPE->Sortable = true; // Allow sort
        $this->LUNAS_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LUNAS_TYPE->Param, "CustomMsg");
        $this->Fields['LUNAS_TYPE'] = &$this->LUNAS_TYPE;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 2, 2, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // MATERIALMED
        $this->MATERIALMED = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_MATERIALMED', 'MATERIALMED', '[MATERIALMED]', 'CAST([MATERIALMED] AS NVARCHAR)', 17, 1, -1, false, '[MATERIALMED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MATERIALMED->Sortable = true; // Allow sort
        $this->MATERIALMED->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MATERIALMED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MATERIALMED->Param, "CustomMsg");
        $this->Fields['MATERIALMED'] = &$this->MATERIALMED;

        // MPPJOURNAL
        $this->MPPJOURNAL = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_MPPJOURNAL', 'MPPJOURNAL', '[MPPJOURNAL]', CastDateFieldForLike("[MPPJOURNAL]", 0, "DB"), 135, 8, 0, false, '[MPPJOURNAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MPPJOURNAL->Sortable = true; // Allow sort
        $this->MPPJOURNAL->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MPPJOURNAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MPPJOURNAL->Param, "CustomMsg");
        $this->Fields['MPPJOURNAL'] = &$this->MPPJOURNAL;

        // MPPJOURNALDATE
        $this->MPPJOURNALDATE = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_MPPJOURNALDATE', 'MPPJOURNALDATE', '[MPPJOURNALDATE]', '[MPPJOURNALDATE]', 200, 50, -1, false, '[MPPJOURNALDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MPPJOURNALDATE->Sortable = true; // Allow sort
        $this->MPPJOURNALDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MPPJOURNALDATE->Param, "CustomMsg");
        $this->Fields['MPPJOURNALDATE'] = &$this->MPPJOURNALDATE;

        // MPPJOURNALBY
        $this->MPPJOURNALBY = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_MPPJOURNALBY', 'MPPJOURNALBY', '[MPPJOURNALBY]', '[MPPJOURNALBY]', 200, 25, -1, false, '[MPPJOURNALBY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MPPJOURNALBY->Sortable = true; // Allow sort
        $this->MPPJOURNALBY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MPPJOURNALBY->Param, "CustomMsg");
        $this->Fields['MPPJOURNALBY'] = &$this->MPPJOURNALBY;

        // PRINTDATE
        $this->PRINTDATE = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_PRINTDATE', 'PRINTDATE', '[PRINTDATE]', CastDateFieldForLike("[PRINTDATE]", 0, "DB"), 135, 8, 0, false, '[PRINTDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTDATE->Sortable = true; // Allow sort
        $this->PRINTDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINTDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTDATE->Param, "CustomMsg");
        $this->Fields['PRINTDATE'] = &$this->PRINTDATE;

        // PRINTBY
        $this->PRINTBY = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_PRINTBY', 'PRINTBY', '[PRINTBY]', '[PRINTBY]', 200, 50, -1, false, '[PRINTBY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTBY->Sortable = true; // Allow sort
        $this->PRINTBY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTBY->Param, "CustomMsg");
        $this->Fields['PRINTBY'] = &$this->PRINTBY;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('SETORAN_BILLING', 'SETORAN_BILLING', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 10, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[SETORAN_BILLING]";
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
            if (array_key_exists('SPPKASIR', $rs)) {
                AddFilter($where, QuotedName('SPPKASIR', $this->Dbid) . '=' . QuotedValue($rs['SPPKASIR'], $this->SPPKASIR->DataType, $this->Dbid));
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
        $this->SPPKASIR->DbValue = $row['SPPKASIR'];
        $this->SPPKASIRDATE->DbValue = $row['SPPKASIRDATE'];
        $this->SPPKASIRUSER->DbValue = $row['SPPKASIRUSER'];
        $this->SPPKASIRNAME->DbValue = $row['SPPKASIRNAME'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->THENAME->DbValue = $row['THENAME'];
        $this->THEID->DbValue = $row['THEID'];
        $this->ISRJ->DbValue = $row['ISRJ'];
        $this->AMOUNTPAID->DbValue = $row['AMOUNTPAID'];
        $this->LUNAS_TYPE->DbValue = $row['LUNAS_TYPE'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->MATERIALMED->DbValue = $row['MATERIALMED'];
        $this->MPPJOURNAL->DbValue = $row['MPPJOURNAL'];
        $this->MPPJOURNALDATE->DbValue = $row['MPPJOURNALDATE'];
        $this->MPPJOURNALBY->DbValue = $row['MPPJOURNALBY'];
        $this->PRINTDATE->DbValue = $row['PRINTDATE'];
        $this->PRINTBY->DbValue = $row['PRINTBY'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[SPPKASIR] = '@SPPKASIR@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->SPPKASIR->CurrentValue : $this->SPPKASIR->OldValue;
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
                $this->SPPKASIR->CurrentValue = $keys[0];
            } else {
                $this->SPPKASIR->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('SPPKASIR', $row) ? $row['SPPKASIR'] : null;
        } else {
            $val = $this->SPPKASIR->OldValue !== null ? $this->SPPKASIR->OldValue : $this->SPPKASIR->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@SPPKASIR@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("SetoranBillingList");
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
        if ($pageName == "SetoranBillingView") {
            return $Language->phrase("View");
        } elseif ($pageName == "SetoranBillingEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "SetoranBillingAdd") {
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
                return "SetoranBillingView";
            case Config("API_ADD_ACTION"):
                return "SetoranBillingAdd";
            case Config("API_EDIT_ACTION"):
                return "SetoranBillingEdit";
            case Config("API_DELETE_ACTION"):
                return "SetoranBillingDelete";
            case Config("API_LIST_ACTION"):
                return "SetoranBillingList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "SetoranBillingList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SetoranBillingView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("SetoranBillingView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SetoranBillingAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "SetoranBillingAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SetoranBillingEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("SetoranBillingAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("SetoranBillingDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "SPPKASIR:" . JsonEncode($this->SPPKASIR->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->SPPKASIR->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->SPPKASIR->CurrentValue);
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
            if (($keyValue = Param("SPPKASIR") ?? Route("SPPKASIR")) !== null) {
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
                $this->SPPKASIR->CurrentValue = $key;
            } else {
                $this->SPPKASIR->OldValue = $key;
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
        $this->SPPKASIR->setDbValue($row['SPPKASIR']);
        $this->SPPKASIRDATE->setDbValue($row['SPPKASIRDATE']);
        $this->SPPKASIRUSER->setDbValue($row['SPPKASIRUSER']);
        $this->SPPKASIRNAME->setDbValue($row['SPPKASIRNAME']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->THENAME->setDbValue($row['THENAME']);
        $this->THEID->setDbValue($row['THEID']);
        $this->ISRJ->setDbValue($row['ISRJ']);
        $this->AMOUNTPAID->setDbValue($row['AMOUNTPAID']);
        $this->LUNAS_TYPE->setDbValue($row['LUNAS_TYPE']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->MATERIALMED->setDbValue($row['MATERIALMED']);
        $this->MPPJOURNAL->setDbValue($row['MPPJOURNAL']);
        $this->MPPJOURNALDATE->setDbValue($row['MPPJOURNALDATE']);
        $this->MPPJOURNALBY->setDbValue($row['MPPJOURNALBY']);
        $this->PRINTDATE->setDbValue($row['PRINTDATE']);
        $this->PRINTBY->setDbValue($row['PRINTBY']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // SPPKASIR

        // SPPKASIRDATE

        // SPPKASIRUSER

        // SPPKASIRNAME

        // NO_REGISTRATION

        // THENAME

        // THEID

        // ISRJ

        // AMOUNTPAID

        // LUNAS_TYPE

        // STATUS_PASIEN_ID

        // MATERIALMED

        // MPPJOURNAL

        // MPPJOURNALDATE

        // MPPJOURNALBY

        // PRINTDATE

        // PRINTBY

        // MODIFIED_DATE

        // MODIFIED_BY

        // SPPKASIR
        $this->SPPKASIR->ViewValue = $this->SPPKASIR->CurrentValue;
        $this->SPPKASIR->ViewCustomAttributes = "";

        // SPPKASIRDATE
        $this->SPPKASIRDATE->ViewValue = $this->SPPKASIRDATE->CurrentValue;
        $this->SPPKASIRDATE->ViewValue = FormatDateTime($this->SPPKASIRDATE->ViewValue, 0);
        $this->SPPKASIRDATE->ViewCustomAttributes = "";

        // SPPKASIRUSER
        $this->SPPKASIRUSER->ViewValue = $this->SPPKASIRUSER->CurrentValue;
        $this->SPPKASIRUSER->ViewCustomAttributes = "";

        // SPPKASIRNAME
        $this->SPPKASIRNAME->ViewValue = $this->SPPKASIRNAME->CurrentValue;
        $this->SPPKASIRNAME->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // THENAME
        $this->THENAME->ViewValue = $this->THENAME->CurrentValue;
        $this->THENAME->ViewCustomAttributes = "";

        // THEID
        $this->THEID->ViewValue = $this->THEID->CurrentValue;
        $this->THEID->ViewCustomAttributes = "";

        // ISRJ
        $this->ISRJ->ViewValue = $this->ISRJ->CurrentValue;
        $this->ISRJ->ViewCustomAttributes = "";

        // AMOUNTPAID
        $this->AMOUNTPAID->ViewValue = $this->AMOUNTPAID->CurrentValue;
        $this->AMOUNTPAID->ViewValue = FormatNumber($this->AMOUNTPAID->ViewValue, 2, -2, -2, -2);
        $this->AMOUNTPAID->ViewCustomAttributes = "";

        // LUNAS_TYPE
        $this->LUNAS_TYPE->ViewValue = $this->LUNAS_TYPE->CurrentValue;
        $this->LUNAS_TYPE->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // MATERIALMED
        $this->MATERIALMED->ViewValue = $this->MATERIALMED->CurrentValue;
        $this->MATERIALMED->ViewValue = FormatNumber($this->MATERIALMED->ViewValue, 0, -2, -2, -2);
        $this->MATERIALMED->ViewCustomAttributes = "";

        // MPPJOURNAL
        $this->MPPJOURNAL->ViewValue = $this->MPPJOURNAL->CurrentValue;
        $this->MPPJOURNAL->ViewValue = FormatDateTime($this->MPPJOURNAL->ViewValue, 0);
        $this->MPPJOURNAL->ViewCustomAttributes = "";

        // MPPJOURNALDATE
        $this->MPPJOURNALDATE->ViewValue = $this->MPPJOURNALDATE->CurrentValue;
        $this->MPPJOURNALDATE->ViewCustomAttributes = "";

        // MPPJOURNALBY
        $this->MPPJOURNALBY->ViewValue = $this->MPPJOURNALBY->CurrentValue;
        $this->MPPJOURNALBY->ViewCustomAttributes = "";

        // PRINTDATE
        $this->PRINTDATE->ViewValue = $this->PRINTDATE->CurrentValue;
        $this->PRINTDATE->ViewValue = FormatDateTime($this->PRINTDATE->ViewValue, 0);
        $this->PRINTDATE->ViewCustomAttributes = "";

        // PRINTBY
        $this->PRINTBY->ViewValue = $this->PRINTBY->CurrentValue;
        $this->PRINTBY->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // SPPKASIR
        $this->SPPKASIR->LinkCustomAttributes = "";
        $this->SPPKASIR->HrefValue = "";
        $this->SPPKASIR->TooltipValue = "";

        // SPPKASIRDATE
        $this->SPPKASIRDATE->LinkCustomAttributes = "";
        $this->SPPKASIRDATE->HrefValue = "";
        $this->SPPKASIRDATE->TooltipValue = "";

        // SPPKASIRUSER
        $this->SPPKASIRUSER->LinkCustomAttributes = "";
        $this->SPPKASIRUSER->HrefValue = "";
        $this->SPPKASIRUSER->TooltipValue = "";

        // SPPKASIRNAME
        $this->SPPKASIRNAME->LinkCustomAttributes = "";
        $this->SPPKASIRNAME->HrefValue = "";
        $this->SPPKASIRNAME->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // THENAME
        $this->THENAME->LinkCustomAttributes = "";
        $this->THENAME->HrefValue = "";
        $this->THENAME->TooltipValue = "";

        // THEID
        $this->THEID->LinkCustomAttributes = "";
        $this->THEID->HrefValue = "";
        $this->THEID->TooltipValue = "";

        // ISRJ
        $this->ISRJ->LinkCustomAttributes = "";
        $this->ISRJ->HrefValue = "";
        $this->ISRJ->TooltipValue = "";

        // AMOUNTPAID
        $this->AMOUNTPAID->LinkCustomAttributes = "";
        $this->AMOUNTPAID->HrefValue = "";
        $this->AMOUNTPAID->TooltipValue = "";

        // LUNAS_TYPE
        $this->LUNAS_TYPE->LinkCustomAttributes = "";
        $this->LUNAS_TYPE->HrefValue = "";
        $this->LUNAS_TYPE->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // MATERIALMED
        $this->MATERIALMED->LinkCustomAttributes = "";
        $this->MATERIALMED->HrefValue = "";
        $this->MATERIALMED->TooltipValue = "";

        // MPPJOURNAL
        $this->MPPJOURNAL->LinkCustomAttributes = "";
        $this->MPPJOURNAL->HrefValue = "";
        $this->MPPJOURNAL->TooltipValue = "";

        // MPPJOURNALDATE
        $this->MPPJOURNALDATE->LinkCustomAttributes = "";
        $this->MPPJOURNALDATE->HrefValue = "";
        $this->MPPJOURNALDATE->TooltipValue = "";

        // MPPJOURNALBY
        $this->MPPJOURNALBY->LinkCustomAttributes = "";
        $this->MPPJOURNALBY->HrefValue = "";
        $this->MPPJOURNALBY->TooltipValue = "";

        // PRINTDATE
        $this->PRINTDATE->LinkCustomAttributes = "";
        $this->PRINTDATE->HrefValue = "";
        $this->PRINTDATE->TooltipValue = "";

        // PRINTBY
        $this->PRINTBY->LinkCustomAttributes = "";
        $this->PRINTBY->HrefValue = "";
        $this->PRINTBY->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

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

        // SPPKASIR
        $this->SPPKASIR->EditAttrs["class"] = "form-control";
        $this->SPPKASIR->EditCustomAttributes = "";
        if (!$this->SPPKASIR->Raw) {
            $this->SPPKASIR->CurrentValue = HtmlDecode($this->SPPKASIR->CurrentValue);
        }
        $this->SPPKASIR->EditValue = $this->SPPKASIR->CurrentValue;
        $this->SPPKASIR->PlaceHolder = RemoveHtml($this->SPPKASIR->caption());

        // SPPKASIRDATE
        $this->SPPKASIRDATE->EditAttrs["class"] = "form-control";
        $this->SPPKASIRDATE->EditCustomAttributes = "";
        $this->SPPKASIRDATE->EditValue = FormatDateTime($this->SPPKASIRDATE->CurrentValue, 8);
        $this->SPPKASIRDATE->PlaceHolder = RemoveHtml($this->SPPKASIRDATE->caption());

        // SPPKASIRUSER
        $this->SPPKASIRUSER->EditAttrs["class"] = "form-control";
        $this->SPPKASIRUSER->EditCustomAttributes = "";
        if (!$this->SPPKASIRUSER->Raw) {
            $this->SPPKASIRUSER->CurrentValue = HtmlDecode($this->SPPKASIRUSER->CurrentValue);
        }
        $this->SPPKASIRUSER->EditValue = $this->SPPKASIRUSER->CurrentValue;
        $this->SPPKASIRUSER->PlaceHolder = RemoveHtml($this->SPPKASIRUSER->caption());

        // SPPKASIRNAME
        $this->SPPKASIRNAME->EditAttrs["class"] = "form-control";
        $this->SPPKASIRNAME->EditCustomAttributes = "";
        if (!$this->SPPKASIRNAME->Raw) {
            $this->SPPKASIRNAME->CurrentValue = HtmlDecode($this->SPPKASIRNAME->CurrentValue);
        }
        $this->SPPKASIRNAME->EditValue = $this->SPPKASIRNAME->CurrentValue;
        $this->SPPKASIRNAME->PlaceHolder = RemoveHtml($this->SPPKASIRNAME->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // THENAME
        $this->THENAME->EditAttrs["class"] = "form-control";
        $this->THENAME->EditCustomAttributes = "";
        if (!$this->THENAME->Raw) {
            $this->THENAME->CurrentValue = HtmlDecode($this->THENAME->CurrentValue);
        }
        $this->THENAME->EditValue = $this->THENAME->CurrentValue;
        $this->THENAME->PlaceHolder = RemoveHtml($this->THENAME->caption());

        // THEID
        $this->THEID->EditAttrs["class"] = "form-control";
        $this->THEID->EditCustomAttributes = "";
        if (!$this->THEID->Raw) {
            $this->THEID->CurrentValue = HtmlDecode($this->THEID->CurrentValue);
        }
        $this->THEID->EditValue = $this->THEID->CurrentValue;
        $this->THEID->PlaceHolder = RemoveHtml($this->THEID->caption());

        // ISRJ
        $this->ISRJ->EditAttrs["class"] = "form-control";
        $this->ISRJ->EditCustomAttributes = "";
        if (!$this->ISRJ->Raw) {
            $this->ISRJ->CurrentValue = HtmlDecode($this->ISRJ->CurrentValue);
        }
        $this->ISRJ->EditValue = $this->ISRJ->CurrentValue;
        $this->ISRJ->PlaceHolder = RemoveHtml($this->ISRJ->caption());

        // AMOUNTPAID
        $this->AMOUNTPAID->EditAttrs["class"] = "form-control";
        $this->AMOUNTPAID->EditCustomAttributes = "";
        $this->AMOUNTPAID->EditValue = $this->AMOUNTPAID->CurrentValue;
        $this->AMOUNTPAID->PlaceHolder = RemoveHtml($this->AMOUNTPAID->caption());
        if (strval($this->AMOUNTPAID->EditValue) != "" && is_numeric($this->AMOUNTPAID->EditValue)) {
            $this->AMOUNTPAID->EditValue = FormatNumber($this->AMOUNTPAID->EditValue, -2, -2, -2, -2);
        }

        // LUNAS_TYPE
        $this->LUNAS_TYPE->EditAttrs["class"] = "form-control";
        $this->LUNAS_TYPE->EditCustomAttributes = "";
        if (!$this->LUNAS_TYPE->Raw) {
            $this->LUNAS_TYPE->CurrentValue = HtmlDecode($this->LUNAS_TYPE->CurrentValue);
        }
        $this->LUNAS_TYPE->EditValue = $this->LUNAS_TYPE->CurrentValue;
        $this->LUNAS_TYPE->PlaceHolder = RemoveHtml($this->LUNAS_TYPE->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // MATERIALMED
        $this->MATERIALMED->EditAttrs["class"] = "form-control";
        $this->MATERIALMED->EditCustomAttributes = "";
        $this->MATERIALMED->EditValue = $this->MATERIALMED->CurrentValue;
        $this->MATERIALMED->PlaceHolder = RemoveHtml($this->MATERIALMED->caption());

        // MPPJOURNAL
        $this->MPPJOURNAL->EditAttrs["class"] = "form-control";
        $this->MPPJOURNAL->EditCustomAttributes = "";
        $this->MPPJOURNAL->EditValue = FormatDateTime($this->MPPJOURNAL->CurrentValue, 8);
        $this->MPPJOURNAL->PlaceHolder = RemoveHtml($this->MPPJOURNAL->caption());

        // MPPJOURNALDATE
        $this->MPPJOURNALDATE->EditAttrs["class"] = "form-control";
        $this->MPPJOURNALDATE->EditCustomAttributes = "";
        if (!$this->MPPJOURNALDATE->Raw) {
            $this->MPPJOURNALDATE->CurrentValue = HtmlDecode($this->MPPJOURNALDATE->CurrentValue);
        }
        $this->MPPJOURNALDATE->EditValue = $this->MPPJOURNALDATE->CurrentValue;
        $this->MPPJOURNALDATE->PlaceHolder = RemoveHtml($this->MPPJOURNALDATE->caption());

        // MPPJOURNALBY
        $this->MPPJOURNALBY->EditAttrs["class"] = "form-control";
        $this->MPPJOURNALBY->EditCustomAttributes = "";
        if (!$this->MPPJOURNALBY->Raw) {
            $this->MPPJOURNALBY->CurrentValue = HtmlDecode($this->MPPJOURNALBY->CurrentValue);
        }
        $this->MPPJOURNALBY->EditValue = $this->MPPJOURNALBY->CurrentValue;
        $this->MPPJOURNALBY->PlaceHolder = RemoveHtml($this->MPPJOURNALBY->caption());

        // PRINTDATE
        $this->PRINTDATE->EditAttrs["class"] = "form-control";
        $this->PRINTDATE->EditCustomAttributes = "";
        $this->PRINTDATE->EditValue = FormatDateTime($this->PRINTDATE->CurrentValue, 8);
        $this->PRINTDATE->PlaceHolder = RemoveHtml($this->PRINTDATE->caption());

        // PRINTBY
        $this->PRINTBY->EditAttrs["class"] = "form-control";
        $this->PRINTBY->EditCustomAttributes = "";
        if (!$this->PRINTBY->Raw) {
            $this->PRINTBY->CurrentValue = HtmlDecode($this->PRINTBY->CurrentValue);
        }
        $this->PRINTBY->EditValue = $this->PRINTBY->CurrentValue;
        $this->PRINTBY->PlaceHolder = RemoveHtml($this->PRINTBY->caption());

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
                    $doc->exportCaption($this->SPPKASIR);
                    $doc->exportCaption($this->SPPKASIRDATE);
                    $doc->exportCaption($this->SPPKASIRUSER);
                    $doc->exportCaption($this->SPPKASIRNAME);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->AMOUNTPAID);
                    $doc->exportCaption($this->LUNAS_TYPE);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->MATERIALMED);
                    $doc->exportCaption($this->MPPJOURNAL);
                    $doc->exportCaption($this->MPPJOURNALDATE);
                    $doc->exportCaption($this->MPPJOURNALBY);
                    $doc->exportCaption($this->PRINTDATE);
                    $doc->exportCaption($this->PRINTBY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                } else {
                    $doc->exportCaption($this->SPPKASIR);
                    $doc->exportCaption($this->SPPKASIRDATE);
                    $doc->exportCaption($this->SPPKASIRUSER);
                    $doc->exportCaption($this->SPPKASIRNAME);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->THENAME);
                    $doc->exportCaption($this->THEID);
                    $doc->exportCaption($this->ISRJ);
                    $doc->exportCaption($this->AMOUNTPAID);
                    $doc->exportCaption($this->LUNAS_TYPE);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->MATERIALMED);
                    $doc->exportCaption($this->MPPJOURNAL);
                    $doc->exportCaption($this->MPPJOURNALDATE);
                    $doc->exportCaption($this->MPPJOURNALBY);
                    $doc->exportCaption($this->PRINTDATE);
                    $doc->exportCaption($this->PRINTBY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
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
                        $doc->exportField($this->SPPKASIR);
                        $doc->exportField($this->SPPKASIRDATE);
                        $doc->exportField($this->SPPKASIRUSER);
                        $doc->exportField($this->SPPKASIRNAME);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->AMOUNTPAID);
                        $doc->exportField($this->LUNAS_TYPE);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->MATERIALMED);
                        $doc->exportField($this->MPPJOURNAL);
                        $doc->exportField($this->MPPJOURNALDATE);
                        $doc->exportField($this->MPPJOURNALBY);
                        $doc->exportField($this->PRINTDATE);
                        $doc->exportField($this->PRINTBY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                    } else {
                        $doc->exportField($this->SPPKASIR);
                        $doc->exportField($this->SPPKASIRDATE);
                        $doc->exportField($this->SPPKASIRUSER);
                        $doc->exportField($this->SPPKASIRNAME);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->THENAME);
                        $doc->exportField($this->THEID);
                        $doc->exportField($this->ISRJ);
                        $doc->exportField($this->AMOUNTPAID);
                        $doc->exportField($this->LUNAS_TYPE);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->MATERIALMED);
                        $doc->exportField($this->MPPJOURNAL);
                        $doc->exportField($this->MPPJOURNALDATE);
                        $doc->exportField($this->MPPJOURNALBY);
                        $doc->exportField($this->PRINTDATE);
                        $doc->exportField($this->PRINTBY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
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
