<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for LETTER
 */
class Letter extends DbTable
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
    public $LETTER_ID;
    public $ARCHIEVE_ID;
    public $TYPE_ID;
    public $INSTRUCT_ID;
    public $PUBLISHED_ID;
    public $INCOMING;
    public $LETTER_NO;
    public $LETTER_DATE;
    public $DESTINATION;
    public $EMPLOYEE_ID;
    public $SUBJECT;
    public $TRANSACT_DATE;
    public $TRANSACT_BY;
    public $FORWARD_MESSAGE;
    public $LETTER_DESC;
    public $DOC_FILE;
    public $ATTACH_FILE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $RECEIVED_DATE;
    public $RECEIVED_BY;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'LETTER';
        $this->TableName = 'LETTER';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[LETTER]";
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

        // LETTER_ID
        $this->LETTER_ID = new DbField('LETTER', 'LETTER', 'x_LETTER_ID', 'LETTER_ID', '[LETTER_ID]', '[LETTER_ID]', 200, 50, -1, false, '[LETTER_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LETTER_ID->IsPrimaryKey = true; // Primary key field
        $this->LETTER_ID->Nullable = false; // NOT NULL field
        $this->LETTER_ID->Required = true; // Required field
        $this->LETTER_ID->Sortable = true; // Allow sort
        $this->LETTER_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LETTER_ID->Param, "CustomMsg");
        $this->Fields['LETTER_ID'] = &$this->LETTER_ID;

        // ARCHIEVE_ID
        $this->ARCHIEVE_ID = new DbField('LETTER', 'LETTER', 'x_ARCHIEVE_ID', 'ARCHIEVE_ID', '[ARCHIEVE_ID]', '[ARCHIEVE_ID]', 200, 50, -1, false, '[ARCHIEVE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ARCHIEVE_ID->Nullable = false; // NOT NULL field
        $this->ARCHIEVE_ID->Required = true; // Required field
        $this->ARCHIEVE_ID->Sortable = true; // Allow sort
        $this->ARCHIEVE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ARCHIEVE_ID->Param, "CustomMsg");
        $this->Fields['ARCHIEVE_ID'] = &$this->ARCHIEVE_ID;

        // TYPE_ID
        $this->TYPE_ID = new DbField('LETTER', 'LETTER', 'x_TYPE_ID', 'TYPE_ID', '[TYPE_ID]', 'CAST([TYPE_ID] AS NVARCHAR)', 2, 2, -1, false, '[TYPE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TYPE_ID->Sortable = true; // Allow sort
        $this->TYPE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TYPE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TYPE_ID->Param, "CustomMsg");
        $this->Fields['TYPE_ID'] = &$this->TYPE_ID;

        // INSTRUCT_ID
        $this->INSTRUCT_ID = new DbField('LETTER', 'LETTER', 'x_INSTRUCT_ID', 'INSTRUCT_ID', '[INSTRUCT_ID]', 'CAST([INSTRUCT_ID] AS NVARCHAR)', 2, 2, -1, false, '[INSTRUCT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INSTRUCT_ID->Sortable = true; // Allow sort
        $this->INSTRUCT_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->INSTRUCT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INSTRUCT_ID->Param, "CustomMsg");
        $this->Fields['INSTRUCT_ID'] = &$this->INSTRUCT_ID;

        // PUBLISHED_ID
        $this->PUBLISHED_ID = new DbField('LETTER', 'LETTER', 'x_PUBLISHED_ID', 'PUBLISHED_ID', '[PUBLISHED_ID]', 'CAST([PUBLISHED_ID] AS NVARCHAR)', 2, 2, -1, false, '[PUBLISHED_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PUBLISHED_ID->Sortable = true; // Allow sort
        $this->PUBLISHED_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PUBLISHED_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PUBLISHED_ID->Param, "CustomMsg");
        $this->Fields['PUBLISHED_ID'] = &$this->PUBLISHED_ID;

        // INCOMING
        $this->INCOMING = new DbField('LETTER', 'LETTER', 'x_INCOMING', 'INCOMING', '[INCOMING]', '[INCOMING]', 129, 1, -1, false, '[INCOMING]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INCOMING->Sortable = true; // Allow sort
        $this->INCOMING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INCOMING->Param, "CustomMsg");
        $this->Fields['INCOMING'] = &$this->INCOMING;

        // LETTER_NO
        $this->LETTER_NO = new DbField('LETTER', 'LETTER', 'x_LETTER_NO', 'LETTER_NO', '[LETTER_NO]', '[LETTER_NO]', 200, 50, -1, false, '[LETTER_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LETTER_NO->Sortable = true; // Allow sort
        $this->LETTER_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LETTER_NO->Param, "CustomMsg");
        $this->Fields['LETTER_NO'] = &$this->LETTER_NO;

        // LETTER_DATE
        $this->LETTER_DATE = new DbField('LETTER', 'LETTER', 'x_LETTER_DATE', 'LETTER_DATE', '[LETTER_DATE]', CastDateFieldForLike("[LETTER_DATE]", 0, "DB"), 135, 8, 0, false, '[LETTER_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LETTER_DATE->Sortable = true; // Allow sort
        $this->LETTER_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->LETTER_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LETTER_DATE->Param, "CustomMsg");
        $this->Fields['LETTER_DATE'] = &$this->LETTER_DATE;

        // DESTINATION
        $this->DESTINATION = new DbField('LETTER', 'LETTER', 'x_DESTINATION', 'DESTINATION', '[DESTINATION]', '[DESTINATION]', 200, 200, -1, false, '[DESTINATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESTINATION->Sortable = true; // Allow sort
        $this->DESTINATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESTINATION->Param, "CustomMsg");
        $this->Fields['DESTINATION'] = &$this->DESTINATION;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('LETTER', 'LETTER', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 150, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // SUBJECT
        $this->SUBJECT = new DbField('LETTER', 'LETTER', 'x_SUBJECT', 'SUBJECT', '[SUBJECT]', '[SUBJECT]', 200, 200, -1, false, '[SUBJECT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SUBJECT->Sortable = true; // Allow sort
        $this->SUBJECT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SUBJECT->Param, "CustomMsg");
        $this->Fields['SUBJECT'] = &$this->SUBJECT;

        // TRANSACT_DATE
        $this->TRANSACT_DATE = new DbField('LETTER', 'LETTER', 'x_TRANSACT_DATE', 'TRANSACT_DATE', '[TRANSACT_DATE]', CastDateFieldForLike("[TRANSACT_DATE]", 0, "DB"), 135, 8, 0, false, '[TRANSACT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TRANSACT_DATE->Sortable = true; // Allow sort
        $this->TRANSACT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TRANSACT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TRANSACT_DATE->Param, "CustomMsg");
        $this->Fields['TRANSACT_DATE'] = &$this->TRANSACT_DATE;

        // TRANSACT_BY
        $this->TRANSACT_BY = new DbField('LETTER', 'LETTER', 'x_TRANSACT_BY', 'TRANSACT_BY', '[TRANSACT_BY]', '[TRANSACT_BY]', 200, 100, -1, false, '[TRANSACT_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TRANSACT_BY->Sortable = true; // Allow sort
        $this->TRANSACT_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TRANSACT_BY->Param, "CustomMsg");
        $this->Fields['TRANSACT_BY'] = &$this->TRANSACT_BY;

        // FORWARD_MESSAGE
        $this->FORWARD_MESSAGE = new DbField('LETTER', 'LETTER', 'x_FORWARD_MESSAGE', 'FORWARD_MESSAGE', '[FORWARD_MESSAGE]', '[FORWARD_MESSAGE]', 200, 250, -1, false, '[FORWARD_MESSAGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FORWARD_MESSAGE->Sortable = true; // Allow sort
        $this->FORWARD_MESSAGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FORWARD_MESSAGE->Param, "CustomMsg");
        $this->Fields['FORWARD_MESSAGE'] = &$this->FORWARD_MESSAGE;

        // LETTER_DESC
        $this->LETTER_DESC = new DbField('LETTER', 'LETTER', 'x_LETTER_DESC', 'LETTER_DESC', '[LETTER_DESC]', '[LETTER_DESC]', 200, 250, -1, false, '[LETTER_DESC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LETTER_DESC->Sortable = true; // Allow sort
        $this->LETTER_DESC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LETTER_DESC->Param, "CustomMsg");
        $this->Fields['LETTER_DESC'] = &$this->LETTER_DESC;

        // DOC_FILE
        $this->DOC_FILE = new DbField('LETTER', 'LETTER', 'x_DOC_FILE', 'DOC_FILE', '[DOC_FILE]', '[DOC_FILE]', 200, 200, -1, false, '[DOC_FILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_FILE->Sortable = true; // Allow sort
        $this->DOC_FILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_FILE->Param, "CustomMsg");
        $this->Fields['DOC_FILE'] = &$this->DOC_FILE;

        // ATTACH_FILE
        $this->ATTACH_FILE = new DbField('LETTER', 'LETTER', 'x_ATTACH_FILE', 'ATTACH_FILE', '[ATTACH_FILE]', '[ATTACH_FILE]', 200, 200, -1, false, '[ATTACH_FILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ATTACH_FILE->Sortable = true; // Allow sort
        $this->ATTACH_FILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ATTACH_FILE->Param, "CustomMsg");
        $this->Fields['ATTACH_FILE'] = &$this->ATTACH_FILE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('LETTER', 'LETTER', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('LETTER', 'LETTER', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // RECEIVED_DATE
        $this->RECEIVED_DATE = new DbField('LETTER', 'LETTER', 'x_RECEIVED_DATE', 'RECEIVED_DATE', '[RECEIVED_DATE]', CastDateFieldForLike("[RECEIVED_DATE]", 0, "DB"), 135, 8, 0, false, '[RECEIVED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_DATE->Sortable = true; // Allow sort
        $this->RECEIVED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RECEIVED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_DATE->Param, "CustomMsg");
        $this->Fields['RECEIVED_DATE'] = &$this->RECEIVED_DATE;

        // RECEIVED_BY
        $this->RECEIVED_BY = new DbField('LETTER', 'LETTER', 'x_RECEIVED_BY', 'RECEIVED_BY', '[RECEIVED_BY]', '[RECEIVED_BY]', 200, 150, -1, false, '[RECEIVED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_BY->Sortable = true; // Allow sort
        $this->RECEIVED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_BY->Param, "CustomMsg");
        $this->Fields['RECEIVED_BY'] = &$this->RECEIVED_BY;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[LETTER]";
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
            if (array_key_exists('LETTER_ID', $rs)) {
                AddFilter($where, QuotedName('LETTER_ID', $this->Dbid) . '=' . QuotedValue($rs['LETTER_ID'], $this->LETTER_ID->DataType, $this->Dbid));
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
        $this->LETTER_ID->DbValue = $row['LETTER_ID'];
        $this->ARCHIEVE_ID->DbValue = $row['ARCHIEVE_ID'];
        $this->TYPE_ID->DbValue = $row['TYPE_ID'];
        $this->INSTRUCT_ID->DbValue = $row['INSTRUCT_ID'];
        $this->PUBLISHED_ID->DbValue = $row['PUBLISHED_ID'];
        $this->INCOMING->DbValue = $row['INCOMING'];
        $this->LETTER_NO->DbValue = $row['LETTER_NO'];
        $this->LETTER_DATE->DbValue = $row['LETTER_DATE'];
        $this->DESTINATION->DbValue = $row['DESTINATION'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->SUBJECT->DbValue = $row['SUBJECT'];
        $this->TRANSACT_DATE->DbValue = $row['TRANSACT_DATE'];
        $this->TRANSACT_BY->DbValue = $row['TRANSACT_BY'];
        $this->FORWARD_MESSAGE->DbValue = $row['FORWARD_MESSAGE'];
        $this->LETTER_DESC->DbValue = $row['LETTER_DESC'];
        $this->DOC_FILE->DbValue = $row['DOC_FILE'];
        $this->ATTACH_FILE->DbValue = $row['ATTACH_FILE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->RECEIVED_DATE->DbValue = $row['RECEIVED_DATE'];
        $this->RECEIVED_BY->DbValue = $row['RECEIVED_BY'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[LETTER_ID] = '@LETTER_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->LETTER_ID->CurrentValue : $this->LETTER_ID->OldValue;
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
                $this->LETTER_ID->CurrentValue = $keys[0];
            } else {
                $this->LETTER_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('LETTER_ID', $row) ? $row['LETTER_ID'] : null;
        } else {
            $val = $this->LETTER_ID->OldValue !== null ? $this->LETTER_ID->OldValue : $this->LETTER_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@LETTER_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("LetterList");
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
        if ($pageName == "LetterView") {
            return $Language->phrase("View");
        } elseif ($pageName == "LetterEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "LetterAdd") {
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
                return "LetterView";
            case Config("API_ADD_ACTION"):
                return "LetterAdd";
            case Config("API_EDIT_ACTION"):
                return "LetterEdit";
            case Config("API_DELETE_ACTION"):
                return "LetterDelete";
            case Config("API_LIST_ACTION"):
                return "LetterList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "LetterList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("LetterView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("LetterView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "LetterAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "LetterAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("LetterEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("LetterAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("LetterDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "LETTER_ID:" . JsonEncode($this->LETTER_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->LETTER_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->LETTER_ID->CurrentValue);
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
            if (($keyValue = Param("LETTER_ID") ?? Route("LETTER_ID")) !== null) {
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
                $this->LETTER_ID->CurrentValue = $key;
            } else {
                $this->LETTER_ID->OldValue = $key;
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
        $this->LETTER_ID->setDbValue($row['LETTER_ID']);
        $this->ARCHIEVE_ID->setDbValue($row['ARCHIEVE_ID']);
        $this->TYPE_ID->setDbValue($row['TYPE_ID']);
        $this->INSTRUCT_ID->setDbValue($row['INSTRUCT_ID']);
        $this->PUBLISHED_ID->setDbValue($row['PUBLISHED_ID']);
        $this->INCOMING->setDbValue($row['INCOMING']);
        $this->LETTER_NO->setDbValue($row['LETTER_NO']);
        $this->LETTER_DATE->setDbValue($row['LETTER_DATE']);
        $this->DESTINATION->setDbValue($row['DESTINATION']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->SUBJECT->setDbValue($row['SUBJECT']);
        $this->TRANSACT_DATE->setDbValue($row['TRANSACT_DATE']);
        $this->TRANSACT_BY->setDbValue($row['TRANSACT_BY']);
        $this->FORWARD_MESSAGE->setDbValue($row['FORWARD_MESSAGE']);
        $this->LETTER_DESC->setDbValue($row['LETTER_DESC']);
        $this->DOC_FILE->setDbValue($row['DOC_FILE']);
        $this->ATTACH_FILE->setDbValue($row['ATTACH_FILE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->RECEIVED_DATE->setDbValue($row['RECEIVED_DATE']);
        $this->RECEIVED_BY->setDbValue($row['RECEIVED_BY']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // LETTER_ID

        // ARCHIEVE_ID

        // TYPE_ID

        // INSTRUCT_ID

        // PUBLISHED_ID

        // INCOMING

        // LETTER_NO

        // LETTER_DATE

        // DESTINATION

        // EMPLOYEE_ID

        // SUBJECT

        // TRANSACT_DATE

        // TRANSACT_BY

        // FORWARD_MESSAGE

        // LETTER_DESC

        // DOC_FILE

        // ATTACH_FILE

        // MODIFIED_DATE

        // MODIFIED_BY

        // RECEIVED_DATE

        // RECEIVED_BY

        // LETTER_ID
        $this->LETTER_ID->ViewValue = $this->LETTER_ID->CurrentValue;
        $this->LETTER_ID->ViewCustomAttributes = "";

        // ARCHIEVE_ID
        $this->ARCHIEVE_ID->ViewValue = $this->ARCHIEVE_ID->CurrentValue;
        $this->ARCHIEVE_ID->ViewCustomAttributes = "";

        // TYPE_ID
        $this->TYPE_ID->ViewValue = $this->TYPE_ID->CurrentValue;
        $this->TYPE_ID->ViewValue = FormatNumber($this->TYPE_ID->ViewValue, 0, -2, -2, -2);
        $this->TYPE_ID->ViewCustomAttributes = "";

        // INSTRUCT_ID
        $this->INSTRUCT_ID->ViewValue = $this->INSTRUCT_ID->CurrentValue;
        $this->INSTRUCT_ID->ViewValue = FormatNumber($this->INSTRUCT_ID->ViewValue, 0, -2, -2, -2);
        $this->INSTRUCT_ID->ViewCustomAttributes = "";

        // PUBLISHED_ID
        $this->PUBLISHED_ID->ViewValue = $this->PUBLISHED_ID->CurrentValue;
        $this->PUBLISHED_ID->ViewValue = FormatNumber($this->PUBLISHED_ID->ViewValue, 0, -2, -2, -2);
        $this->PUBLISHED_ID->ViewCustomAttributes = "";

        // INCOMING
        $this->INCOMING->ViewValue = $this->INCOMING->CurrentValue;
        $this->INCOMING->ViewCustomAttributes = "";

        // LETTER_NO
        $this->LETTER_NO->ViewValue = $this->LETTER_NO->CurrentValue;
        $this->LETTER_NO->ViewCustomAttributes = "";

        // LETTER_DATE
        $this->LETTER_DATE->ViewValue = $this->LETTER_DATE->CurrentValue;
        $this->LETTER_DATE->ViewValue = FormatDateTime($this->LETTER_DATE->ViewValue, 0);
        $this->LETTER_DATE->ViewCustomAttributes = "";

        // DESTINATION
        $this->DESTINATION->ViewValue = $this->DESTINATION->CurrentValue;
        $this->DESTINATION->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // SUBJECT
        $this->SUBJECT->ViewValue = $this->SUBJECT->CurrentValue;
        $this->SUBJECT->ViewCustomAttributes = "";

        // TRANSACT_DATE
        $this->TRANSACT_DATE->ViewValue = $this->TRANSACT_DATE->CurrentValue;
        $this->TRANSACT_DATE->ViewValue = FormatDateTime($this->TRANSACT_DATE->ViewValue, 0);
        $this->TRANSACT_DATE->ViewCustomAttributes = "";

        // TRANSACT_BY
        $this->TRANSACT_BY->ViewValue = $this->TRANSACT_BY->CurrentValue;
        $this->TRANSACT_BY->ViewCustomAttributes = "";

        // FORWARD_MESSAGE
        $this->FORWARD_MESSAGE->ViewValue = $this->FORWARD_MESSAGE->CurrentValue;
        $this->FORWARD_MESSAGE->ViewCustomAttributes = "";

        // LETTER_DESC
        $this->LETTER_DESC->ViewValue = $this->LETTER_DESC->CurrentValue;
        $this->LETTER_DESC->ViewCustomAttributes = "";

        // DOC_FILE
        $this->DOC_FILE->ViewValue = $this->DOC_FILE->CurrentValue;
        $this->DOC_FILE->ViewCustomAttributes = "";

        // ATTACH_FILE
        $this->ATTACH_FILE->ViewValue = $this->ATTACH_FILE->CurrentValue;
        $this->ATTACH_FILE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // RECEIVED_DATE
        $this->RECEIVED_DATE->ViewValue = $this->RECEIVED_DATE->CurrentValue;
        $this->RECEIVED_DATE->ViewValue = FormatDateTime($this->RECEIVED_DATE->ViewValue, 0);
        $this->RECEIVED_DATE->ViewCustomAttributes = "";

        // RECEIVED_BY
        $this->RECEIVED_BY->ViewValue = $this->RECEIVED_BY->CurrentValue;
        $this->RECEIVED_BY->ViewCustomAttributes = "";

        // LETTER_ID
        $this->LETTER_ID->LinkCustomAttributes = "";
        $this->LETTER_ID->HrefValue = "";
        $this->LETTER_ID->TooltipValue = "";

        // ARCHIEVE_ID
        $this->ARCHIEVE_ID->LinkCustomAttributes = "";
        $this->ARCHIEVE_ID->HrefValue = "";
        $this->ARCHIEVE_ID->TooltipValue = "";

        // TYPE_ID
        $this->TYPE_ID->LinkCustomAttributes = "";
        $this->TYPE_ID->HrefValue = "";
        $this->TYPE_ID->TooltipValue = "";

        // INSTRUCT_ID
        $this->INSTRUCT_ID->LinkCustomAttributes = "";
        $this->INSTRUCT_ID->HrefValue = "";
        $this->INSTRUCT_ID->TooltipValue = "";

        // PUBLISHED_ID
        $this->PUBLISHED_ID->LinkCustomAttributes = "";
        $this->PUBLISHED_ID->HrefValue = "";
        $this->PUBLISHED_ID->TooltipValue = "";

        // INCOMING
        $this->INCOMING->LinkCustomAttributes = "";
        $this->INCOMING->HrefValue = "";
        $this->INCOMING->TooltipValue = "";

        // LETTER_NO
        $this->LETTER_NO->LinkCustomAttributes = "";
        $this->LETTER_NO->HrefValue = "";
        $this->LETTER_NO->TooltipValue = "";

        // LETTER_DATE
        $this->LETTER_DATE->LinkCustomAttributes = "";
        $this->LETTER_DATE->HrefValue = "";
        $this->LETTER_DATE->TooltipValue = "";

        // DESTINATION
        $this->DESTINATION->LinkCustomAttributes = "";
        $this->DESTINATION->HrefValue = "";
        $this->DESTINATION->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // SUBJECT
        $this->SUBJECT->LinkCustomAttributes = "";
        $this->SUBJECT->HrefValue = "";
        $this->SUBJECT->TooltipValue = "";

        // TRANSACT_DATE
        $this->TRANSACT_DATE->LinkCustomAttributes = "";
        $this->TRANSACT_DATE->HrefValue = "";
        $this->TRANSACT_DATE->TooltipValue = "";

        // TRANSACT_BY
        $this->TRANSACT_BY->LinkCustomAttributes = "";
        $this->TRANSACT_BY->HrefValue = "";
        $this->TRANSACT_BY->TooltipValue = "";

        // FORWARD_MESSAGE
        $this->FORWARD_MESSAGE->LinkCustomAttributes = "";
        $this->FORWARD_MESSAGE->HrefValue = "";
        $this->FORWARD_MESSAGE->TooltipValue = "";

        // LETTER_DESC
        $this->LETTER_DESC->LinkCustomAttributes = "";
        $this->LETTER_DESC->HrefValue = "";
        $this->LETTER_DESC->TooltipValue = "";

        // DOC_FILE
        $this->DOC_FILE->LinkCustomAttributes = "";
        $this->DOC_FILE->HrefValue = "";
        $this->DOC_FILE->TooltipValue = "";

        // ATTACH_FILE
        $this->ATTACH_FILE->LinkCustomAttributes = "";
        $this->ATTACH_FILE->HrefValue = "";
        $this->ATTACH_FILE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // RECEIVED_DATE
        $this->RECEIVED_DATE->LinkCustomAttributes = "";
        $this->RECEIVED_DATE->HrefValue = "";
        $this->RECEIVED_DATE->TooltipValue = "";

        // RECEIVED_BY
        $this->RECEIVED_BY->LinkCustomAttributes = "";
        $this->RECEIVED_BY->HrefValue = "";
        $this->RECEIVED_BY->TooltipValue = "";

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

        // LETTER_ID
        $this->LETTER_ID->EditAttrs["class"] = "form-control";
        $this->LETTER_ID->EditCustomAttributes = "";
        if (!$this->LETTER_ID->Raw) {
            $this->LETTER_ID->CurrentValue = HtmlDecode($this->LETTER_ID->CurrentValue);
        }
        $this->LETTER_ID->EditValue = $this->LETTER_ID->CurrentValue;
        $this->LETTER_ID->PlaceHolder = RemoveHtml($this->LETTER_ID->caption());

        // ARCHIEVE_ID
        $this->ARCHIEVE_ID->EditAttrs["class"] = "form-control";
        $this->ARCHIEVE_ID->EditCustomAttributes = "";
        if (!$this->ARCHIEVE_ID->Raw) {
            $this->ARCHIEVE_ID->CurrentValue = HtmlDecode($this->ARCHIEVE_ID->CurrentValue);
        }
        $this->ARCHIEVE_ID->EditValue = $this->ARCHIEVE_ID->CurrentValue;
        $this->ARCHIEVE_ID->PlaceHolder = RemoveHtml($this->ARCHIEVE_ID->caption());

        // TYPE_ID
        $this->TYPE_ID->EditAttrs["class"] = "form-control";
        $this->TYPE_ID->EditCustomAttributes = "";
        $this->TYPE_ID->EditValue = $this->TYPE_ID->CurrentValue;
        $this->TYPE_ID->PlaceHolder = RemoveHtml($this->TYPE_ID->caption());

        // INSTRUCT_ID
        $this->INSTRUCT_ID->EditAttrs["class"] = "form-control";
        $this->INSTRUCT_ID->EditCustomAttributes = "";
        $this->INSTRUCT_ID->EditValue = $this->INSTRUCT_ID->CurrentValue;
        $this->INSTRUCT_ID->PlaceHolder = RemoveHtml($this->INSTRUCT_ID->caption());

        // PUBLISHED_ID
        $this->PUBLISHED_ID->EditAttrs["class"] = "form-control";
        $this->PUBLISHED_ID->EditCustomAttributes = "";
        $this->PUBLISHED_ID->EditValue = $this->PUBLISHED_ID->CurrentValue;
        $this->PUBLISHED_ID->PlaceHolder = RemoveHtml($this->PUBLISHED_ID->caption());

        // INCOMING
        $this->INCOMING->EditAttrs["class"] = "form-control";
        $this->INCOMING->EditCustomAttributes = "";
        if (!$this->INCOMING->Raw) {
            $this->INCOMING->CurrentValue = HtmlDecode($this->INCOMING->CurrentValue);
        }
        $this->INCOMING->EditValue = $this->INCOMING->CurrentValue;
        $this->INCOMING->PlaceHolder = RemoveHtml($this->INCOMING->caption());

        // LETTER_NO
        $this->LETTER_NO->EditAttrs["class"] = "form-control";
        $this->LETTER_NO->EditCustomAttributes = "";
        if (!$this->LETTER_NO->Raw) {
            $this->LETTER_NO->CurrentValue = HtmlDecode($this->LETTER_NO->CurrentValue);
        }
        $this->LETTER_NO->EditValue = $this->LETTER_NO->CurrentValue;
        $this->LETTER_NO->PlaceHolder = RemoveHtml($this->LETTER_NO->caption());

        // LETTER_DATE
        $this->LETTER_DATE->EditAttrs["class"] = "form-control";
        $this->LETTER_DATE->EditCustomAttributes = "";
        $this->LETTER_DATE->EditValue = FormatDateTime($this->LETTER_DATE->CurrentValue, 8);
        $this->LETTER_DATE->PlaceHolder = RemoveHtml($this->LETTER_DATE->caption());

        // DESTINATION
        $this->DESTINATION->EditAttrs["class"] = "form-control";
        $this->DESTINATION->EditCustomAttributes = "";
        if (!$this->DESTINATION->Raw) {
            $this->DESTINATION->CurrentValue = HtmlDecode($this->DESTINATION->CurrentValue);
        }
        $this->DESTINATION->EditValue = $this->DESTINATION->CurrentValue;
        $this->DESTINATION->PlaceHolder = RemoveHtml($this->DESTINATION->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // SUBJECT
        $this->SUBJECT->EditAttrs["class"] = "form-control";
        $this->SUBJECT->EditCustomAttributes = "";
        if (!$this->SUBJECT->Raw) {
            $this->SUBJECT->CurrentValue = HtmlDecode($this->SUBJECT->CurrentValue);
        }
        $this->SUBJECT->EditValue = $this->SUBJECT->CurrentValue;
        $this->SUBJECT->PlaceHolder = RemoveHtml($this->SUBJECT->caption());

        // TRANSACT_DATE
        $this->TRANSACT_DATE->EditAttrs["class"] = "form-control";
        $this->TRANSACT_DATE->EditCustomAttributes = "";
        $this->TRANSACT_DATE->EditValue = FormatDateTime($this->TRANSACT_DATE->CurrentValue, 8);
        $this->TRANSACT_DATE->PlaceHolder = RemoveHtml($this->TRANSACT_DATE->caption());

        // TRANSACT_BY
        $this->TRANSACT_BY->EditAttrs["class"] = "form-control";
        $this->TRANSACT_BY->EditCustomAttributes = "";
        if (!$this->TRANSACT_BY->Raw) {
            $this->TRANSACT_BY->CurrentValue = HtmlDecode($this->TRANSACT_BY->CurrentValue);
        }
        $this->TRANSACT_BY->EditValue = $this->TRANSACT_BY->CurrentValue;
        $this->TRANSACT_BY->PlaceHolder = RemoveHtml($this->TRANSACT_BY->caption());

        // FORWARD_MESSAGE
        $this->FORWARD_MESSAGE->EditAttrs["class"] = "form-control";
        $this->FORWARD_MESSAGE->EditCustomAttributes = "";
        if (!$this->FORWARD_MESSAGE->Raw) {
            $this->FORWARD_MESSAGE->CurrentValue = HtmlDecode($this->FORWARD_MESSAGE->CurrentValue);
        }
        $this->FORWARD_MESSAGE->EditValue = $this->FORWARD_MESSAGE->CurrentValue;
        $this->FORWARD_MESSAGE->PlaceHolder = RemoveHtml($this->FORWARD_MESSAGE->caption());

        // LETTER_DESC
        $this->LETTER_DESC->EditAttrs["class"] = "form-control";
        $this->LETTER_DESC->EditCustomAttributes = "";
        if (!$this->LETTER_DESC->Raw) {
            $this->LETTER_DESC->CurrentValue = HtmlDecode($this->LETTER_DESC->CurrentValue);
        }
        $this->LETTER_DESC->EditValue = $this->LETTER_DESC->CurrentValue;
        $this->LETTER_DESC->PlaceHolder = RemoveHtml($this->LETTER_DESC->caption());

        // DOC_FILE
        $this->DOC_FILE->EditAttrs["class"] = "form-control";
        $this->DOC_FILE->EditCustomAttributes = "";
        if (!$this->DOC_FILE->Raw) {
            $this->DOC_FILE->CurrentValue = HtmlDecode($this->DOC_FILE->CurrentValue);
        }
        $this->DOC_FILE->EditValue = $this->DOC_FILE->CurrentValue;
        $this->DOC_FILE->PlaceHolder = RemoveHtml($this->DOC_FILE->caption());

        // ATTACH_FILE
        $this->ATTACH_FILE->EditAttrs["class"] = "form-control";
        $this->ATTACH_FILE->EditCustomAttributes = "";
        if (!$this->ATTACH_FILE->Raw) {
            $this->ATTACH_FILE->CurrentValue = HtmlDecode($this->ATTACH_FILE->CurrentValue);
        }
        $this->ATTACH_FILE->EditValue = $this->ATTACH_FILE->CurrentValue;
        $this->ATTACH_FILE->PlaceHolder = RemoveHtml($this->ATTACH_FILE->caption());

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

        // RECEIVED_DATE
        $this->RECEIVED_DATE->EditAttrs["class"] = "form-control";
        $this->RECEIVED_DATE->EditCustomAttributes = "";
        $this->RECEIVED_DATE->EditValue = FormatDateTime($this->RECEIVED_DATE->CurrentValue, 8);
        $this->RECEIVED_DATE->PlaceHolder = RemoveHtml($this->RECEIVED_DATE->caption());

        // RECEIVED_BY
        $this->RECEIVED_BY->EditAttrs["class"] = "form-control";
        $this->RECEIVED_BY->EditCustomAttributes = "";
        if (!$this->RECEIVED_BY->Raw) {
            $this->RECEIVED_BY->CurrentValue = HtmlDecode($this->RECEIVED_BY->CurrentValue);
        }
        $this->RECEIVED_BY->EditValue = $this->RECEIVED_BY->CurrentValue;
        $this->RECEIVED_BY->PlaceHolder = RemoveHtml($this->RECEIVED_BY->caption());

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
                    $doc->exportCaption($this->LETTER_ID);
                    $doc->exportCaption($this->ARCHIEVE_ID);
                    $doc->exportCaption($this->TYPE_ID);
                    $doc->exportCaption($this->INSTRUCT_ID);
                    $doc->exportCaption($this->PUBLISHED_ID);
                    $doc->exportCaption($this->INCOMING);
                    $doc->exportCaption($this->LETTER_NO);
                    $doc->exportCaption($this->LETTER_DATE);
                    $doc->exportCaption($this->DESTINATION);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->SUBJECT);
                    $doc->exportCaption($this->TRANSACT_DATE);
                    $doc->exportCaption($this->TRANSACT_BY);
                    $doc->exportCaption($this->FORWARD_MESSAGE);
                    $doc->exportCaption($this->LETTER_DESC);
                    $doc->exportCaption($this->DOC_FILE);
                    $doc->exportCaption($this->ATTACH_FILE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->RECEIVED_DATE);
                    $doc->exportCaption($this->RECEIVED_BY);
                } else {
                    $doc->exportCaption($this->LETTER_ID);
                    $doc->exportCaption($this->ARCHIEVE_ID);
                    $doc->exportCaption($this->TYPE_ID);
                    $doc->exportCaption($this->INSTRUCT_ID);
                    $doc->exportCaption($this->PUBLISHED_ID);
                    $doc->exportCaption($this->INCOMING);
                    $doc->exportCaption($this->LETTER_NO);
                    $doc->exportCaption($this->LETTER_DATE);
                    $doc->exportCaption($this->DESTINATION);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->SUBJECT);
                    $doc->exportCaption($this->TRANSACT_DATE);
                    $doc->exportCaption($this->TRANSACT_BY);
                    $doc->exportCaption($this->FORWARD_MESSAGE);
                    $doc->exportCaption($this->LETTER_DESC);
                    $doc->exportCaption($this->DOC_FILE);
                    $doc->exportCaption($this->ATTACH_FILE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->RECEIVED_DATE);
                    $doc->exportCaption($this->RECEIVED_BY);
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
                        $doc->exportField($this->LETTER_ID);
                        $doc->exportField($this->ARCHIEVE_ID);
                        $doc->exportField($this->TYPE_ID);
                        $doc->exportField($this->INSTRUCT_ID);
                        $doc->exportField($this->PUBLISHED_ID);
                        $doc->exportField($this->INCOMING);
                        $doc->exportField($this->LETTER_NO);
                        $doc->exportField($this->LETTER_DATE);
                        $doc->exportField($this->DESTINATION);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->SUBJECT);
                        $doc->exportField($this->TRANSACT_DATE);
                        $doc->exportField($this->TRANSACT_BY);
                        $doc->exportField($this->FORWARD_MESSAGE);
                        $doc->exportField($this->LETTER_DESC);
                        $doc->exportField($this->DOC_FILE);
                        $doc->exportField($this->ATTACH_FILE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->RECEIVED_DATE);
                        $doc->exportField($this->RECEIVED_BY);
                    } else {
                        $doc->exportField($this->LETTER_ID);
                        $doc->exportField($this->ARCHIEVE_ID);
                        $doc->exportField($this->TYPE_ID);
                        $doc->exportField($this->INSTRUCT_ID);
                        $doc->exportField($this->PUBLISHED_ID);
                        $doc->exportField($this->INCOMING);
                        $doc->exportField($this->LETTER_NO);
                        $doc->exportField($this->LETTER_DATE);
                        $doc->exportField($this->DESTINATION);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->SUBJECT);
                        $doc->exportField($this->TRANSACT_DATE);
                        $doc->exportField($this->TRANSACT_BY);
                        $doc->exportField($this->FORWARD_MESSAGE);
                        $doc->exportField($this->LETTER_DESC);
                        $doc->exportField($this->DOC_FILE);
                        $doc->exportField($this->ATTACH_FILE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->RECEIVED_DATE);
                        $doc->exportField($this->RECEIVED_BY);
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
