<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for LETTER_FORWARD
 */
class LetterForward extends DbTable
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
    public $EMPLOYEE_ID;
    public $ORG_ID;
    public $FTYPE;
    public $FORWARD_DATE;
    public $FMESSAGE;
    public $FORWARD_BY;
    public $OPEN_DATE;
    public $RESPONS_TYPE;
    public $RESPONS;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'LETTER_FORWARD';
        $this->TableName = 'LETTER_FORWARD';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[LETTER_FORWARD]";
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
        $this->LETTER_ID = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_LETTER_ID', 'LETTER_ID', '[LETTER_ID]', '[LETTER_ID]', 200, 50, -1, false, '[LETTER_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LETTER_ID->IsPrimaryKey = true; // Primary key field
        $this->LETTER_ID->Nullable = false; // NOT NULL field
        $this->LETTER_ID->Required = true; // Required field
        $this->LETTER_ID->Sortable = true; // Allow sort
        $this->LETTER_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LETTER_ID->Param, "CustomMsg");
        $this->Fields['LETTER_ID'] = &$this->LETTER_ID;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 50, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->IsPrimaryKey = true; // Primary key field
        $this->EMPLOYEE_ID->Nullable = false; // NOT NULL field
        $this->EMPLOYEE_ID->Required = true; // Required field
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // ORG_ID
        $this->ORG_ID = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 25, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // FTYPE
        $this->FTYPE = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_FTYPE', 'FTYPE', '[FTYPE]', 'CAST([FTYPE] AS NVARCHAR)', 2, 2, -1, false, '[FTYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FTYPE->Sortable = true; // Allow sort
        $this->FTYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FTYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FTYPE->Param, "CustomMsg");
        $this->Fields['FTYPE'] = &$this->FTYPE;

        // FORWARD_DATE
        $this->FORWARD_DATE = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_FORWARD_DATE', 'FORWARD_DATE', '[FORWARD_DATE]', CastDateFieldForLike("[FORWARD_DATE]", 0, "DB"), 135, 8, 0, false, '[FORWARD_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FORWARD_DATE->Sortable = true; // Allow sort
        $this->FORWARD_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->FORWARD_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FORWARD_DATE->Param, "CustomMsg");
        $this->Fields['FORWARD_DATE'] = &$this->FORWARD_DATE;

        // FMESSAGE
        $this->FMESSAGE = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_FMESSAGE', 'FMESSAGE', '[FMESSAGE]', '[FMESSAGE]', 200, 255, -1, false, '[FMESSAGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FMESSAGE->Sortable = true; // Allow sort
        $this->FMESSAGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FMESSAGE->Param, "CustomMsg");
        $this->Fields['FMESSAGE'] = &$this->FMESSAGE;

        // FORWARD_BY
        $this->FORWARD_BY = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_FORWARD_BY', 'FORWARD_BY', '[FORWARD_BY]', '[FORWARD_BY]', 200, 100, -1, false, '[FORWARD_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FORWARD_BY->Sortable = true; // Allow sort
        $this->FORWARD_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FORWARD_BY->Param, "CustomMsg");
        $this->Fields['FORWARD_BY'] = &$this->FORWARD_BY;

        // OPEN_DATE
        $this->OPEN_DATE = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_OPEN_DATE', 'OPEN_DATE', '[OPEN_DATE]', CastDateFieldForLike("[OPEN_DATE]", 0, "DB"), 135, 8, 0, false, '[OPEN_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OPEN_DATE->Sortable = true; // Allow sort
        $this->OPEN_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->OPEN_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OPEN_DATE->Param, "CustomMsg");
        $this->Fields['OPEN_DATE'] = &$this->OPEN_DATE;

        // RESPONS_TYPE
        $this->RESPONS_TYPE = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_RESPONS_TYPE', 'RESPONS_TYPE', '[RESPONS_TYPE]', 'CAST([RESPONS_TYPE] AS NVARCHAR)', 2, 2, -1, false, '[RESPONS_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONS_TYPE->Sortable = true; // Allow sort
        $this->RESPONS_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->RESPONS_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONS_TYPE->Param, "CustomMsg");
        $this->Fields['RESPONS_TYPE'] = &$this->RESPONS_TYPE;

        // RESPONS
        $this->RESPONS = new DbField('LETTER_FORWARD', 'LETTER_FORWARD', 'x_RESPONS', 'RESPONS', '[RESPONS]', '[RESPONS]', 200, 255, -1, false, '[RESPONS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RESPONS->Sortable = true; // Allow sort
        $this->RESPONS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RESPONS->Param, "CustomMsg");
        $this->Fields['RESPONS'] = &$this->RESPONS;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[LETTER_FORWARD]";
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
        $this->LETTER_ID->DbValue = $row['LETTER_ID'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->FTYPE->DbValue = $row['FTYPE'];
        $this->FORWARD_DATE->DbValue = $row['FORWARD_DATE'];
        $this->FMESSAGE->DbValue = $row['FMESSAGE'];
        $this->FORWARD_BY->DbValue = $row['FORWARD_BY'];
        $this->OPEN_DATE->DbValue = $row['OPEN_DATE'];
        $this->RESPONS_TYPE->DbValue = $row['RESPONS_TYPE'];
        $this->RESPONS->DbValue = $row['RESPONS'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[LETTER_ID] = '@LETTER_ID@' AND [EMPLOYEE_ID] = '@EMPLOYEE_ID@'";
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
                $this->LETTER_ID->CurrentValue = $keys[0];
            } else {
                $this->LETTER_ID->OldValue = $keys[0];
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
            $val = array_key_exists('LETTER_ID', $row) ? $row['LETTER_ID'] : null;
        } else {
            $val = $this->LETTER_ID->OldValue !== null ? $this->LETTER_ID->OldValue : $this->LETTER_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@LETTER_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("LetterForwardList");
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
        if ($pageName == "LetterForwardView") {
            return $Language->phrase("View");
        } elseif ($pageName == "LetterForwardEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "LetterForwardAdd") {
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
                return "LetterForwardView";
            case Config("API_ADD_ACTION"):
                return "LetterForwardAdd";
            case Config("API_EDIT_ACTION"):
                return "LetterForwardEdit";
            case Config("API_DELETE_ACTION"):
                return "LetterForwardDelete";
            case Config("API_LIST_ACTION"):
                return "LetterForwardList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "LetterForwardList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("LetterForwardView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("LetterForwardView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "LetterForwardAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "LetterForwardAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("LetterForwardEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("LetterForwardAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("LetterForwardDelete", $this->getUrlParm());
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
        if ($this->LETTER_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->LETTER_ID->CurrentValue);
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
            if (($keyValue = Param("LETTER_ID") ?? Route("LETTER_ID")) !== null) {
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
                $this->LETTER_ID->CurrentValue = $key[0];
            } else {
                $this->LETTER_ID->OldValue = $key[0];
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
        $this->LETTER_ID->setDbValue($row['LETTER_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->FTYPE->setDbValue($row['FTYPE']);
        $this->FORWARD_DATE->setDbValue($row['FORWARD_DATE']);
        $this->FMESSAGE->setDbValue($row['FMESSAGE']);
        $this->FORWARD_BY->setDbValue($row['FORWARD_BY']);
        $this->OPEN_DATE->setDbValue($row['OPEN_DATE']);
        $this->RESPONS_TYPE->setDbValue($row['RESPONS_TYPE']);
        $this->RESPONS->setDbValue($row['RESPONS']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // LETTER_ID

        // EMPLOYEE_ID

        // ORG_ID

        // FTYPE

        // FORWARD_DATE

        // FMESSAGE

        // FORWARD_BY

        // OPEN_DATE

        // RESPONS_TYPE

        // RESPONS

        // LETTER_ID
        $this->LETTER_ID->ViewValue = $this->LETTER_ID->CurrentValue;
        $this->LETTER_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // FTYPE
        $this->FTYPE->ViewValue = $this->FTYPE->CurrentValue;
        $this->FTYPE->ViewValue = FormatNumber($this->FTYPE->ViewValue, 0, -2, -2, -2);
        $this->FTYPE->ViewCustomAttributes = "";

        // FORWARD_DATE
        $this->FORWARD_DATE->ViewValue = $this->FORWARD_DATE->CurrentValue;
        $this->FORWARD_DATE->ViewValue = FormatDateTime($this->FORWARD_DATE->ViewValue, 0);
        $this->FORWARD_DATE->ViewCustomAttributes = "";

        // FMESSAGE
        $this->FMESSAGE->ViewValue = $this->FMESSAGE->CurrentValue;
        $this->FMESSAGE->ViewCustomAttributes = "";

        // FORWARD_BY
        $this->FORWARD_BY->ViewValue = $this->FORWARD_BY->CurrentValue;
        $this->FORWARD_BY->ViewCustomAttributes = "";

        // OPEN_DATE
        $this->OPEN_DATE->ViewValue = $this->OPEN_DATE->CurrentValue;
        $this->OPEN_DATE->ViewValue = FormatDateTime($this->OPEN_DATE->ViewValue, 0);
        $this->OPEN_DATE->ViewCustomAttributes = "";

        // RESPONS_TYPE
        $this->RESPONS_TYPE->ViewValue = $this->RESPONS_TYPE->CurrentValue;
        $this->RESPONS_TYPE->ViewValue = FormatNumber($this->RESPONS_TYPE->ViewValue, 0, -2, -2, -2);
        $this->RESPONS_TYPE->ViewCustomAttributes = "";

        // RESPONS
        $this->RESPONS->ViewValue = $this->RESPONS->CurrentValue;
        $this->RESPONS->ViewCustomAttributes = "";

        // LETTER_ID
        $this->LETTER_ID->LinkCustomAttributes = "";
        $this->LETTER_ID->HrefValue = "";
        $this->LETTER_ID->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // FTYPE
        $this->FTYPE->LinkCustomAttributes = "";
        $this->FTYPE->HrefValue = "";
        $this->FTYPE->TooltipValue = "";

        // FORWARD_DATE
        $this->FORWARD_DATE->LinkCustomAttributes = "";
        $this->FORWARD_DATE->HrefValue = "";
        $this->FORWARD_DATE->TooltipValue = "";

        // FMESSAGE
        $this->FMESSAGE->LinkCustomAttributes = "";
        $this->FMESSAGE->HrefValue = "";
        $this->FMESSAGE->TooltipValue = "";

        // FORWARD_BY
        $this->FORWARD_BY->LinkCustomAttributes = "";
        $this->FORWARD_BY->HrefValue = "";
        $this->FORWARD_BY->TooltipValue = "";

        // OPEN_DATE
        $this->OPEN_DATE->LinkCustomAttributes = "";
        $this->OPEN_DATE->HrefValue = "";
        $this->OPEN_DATE->TooltipValue = "";

        // RESPONS_TYPE
        $this->RESPONS_TYPE->LinkCustomAttributes = "";
        $this->RESPONS_TYPE->HrefValue = "";
        $this->RESPONS_TYPE->TooltipValue = "";

        // RESPONS
        $this->RESPONS->LinkCustomAttributes = "";
        $this->RESPONS->HrefValue = "";
        $this->RESPONS->TooltipValue = "";

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

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        if (!$this->ORG_ID->Raw) {
            $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
        }
        $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

        // FTYPE
        $this->FTYPE->EditAttrs["class"] = "form-control";
        $this->FTYPE->EditCustomAttributes = "";
        $this->FTYPE->EditValue = $this->FTYPE->CurrentValue;
        $this->FTYPE->PlaceHolder = RemoveHtml($this->FTYPE->caption());

        // FORWARD_DATE
        $this->FORWARD_DATE->EditAttrs["class"] = "form-control";
        $this->FORWARD_DATE->EditCustomAttributes = "";
        $this->FORWARD_DATE->EditValue = FormatDateTime($this->FORWARD_DATE->CurrentValue, 8);
        $this->FORWARD_DATE->PlaceHolder = RemoveHtml($this->FORWARD_DATE->caption());

        // FMESSAGE
        $this->FMESSAGE->EditAttrs["class"] = "form-control";
        $this->FMESSAGE->EditCustomAttributes = "";
        if (!$this->FMESSAGE->Raw) {
            $this->FMESSAGE->CurrentValue = HtmlDecode($this->FMESSAGE->CurrentValue);
        }
        $this->FMESSAGE->EditValue = $this->FMESSAGE->CurrentValue;
        $this->FMESSAGE->PlaceHolder = RemoveHtml($this->FMESSAGE->caption());

        // FORWARD_BY
        $this->FORWARD_BY->EditAttrs["class"] = "form-control";
        $this->FORWARD_BY->EditCustomAttributes = "";
        if (!$this->FORWARD_BY->Raw) {
            $this->FORWARD_BY->CurrentValue = HtmlDecode($this->FORWARD_BY->CurrentValue);
        }
        $this->FORWARD_BY->EditValue = $this->FORWARD_BY->CurrentValue;
        $this->FORWARD_BY->PlaceHolder = RemoveHtml($this->FORWARD_BY->caption());

        // OPEN_DATE
        $this->OPEN_DATE->EditAttrs["class"] = "form-control";
        $this->OPEN_DATE->EditCustomAttributes = "";
        $this->OPEN_DATE->EditValue = FormatDateTime($this->OPEN_DATE->CurrentValue, 8);
        $this->OPEN_DATE->PlaceHolder = RemoveHtml($this->OPEN_DATE->caption());

        // RESPONS_TYPE
        $this->RESPONS_TYPE->EditAttrs["class"] = "form-control";
        $this->RESPONS_TYPE->EditCustomAttributes = "";
        $this->RESPONS_TYPE->EditValue = $this->RESPONS_TYPE->CurrentValue;
        $this->RESPONS_TYPE->PlaceHolder = RemoveHtml($this->RESPONS_TYPE->caption());

        // RESPONS
        $this->RESPONS->EditAttrs["class"] = "form-control";
        $this->RESPONS->EditCustomAttributes = "";
        if (!$this->RESPONS->Raw) {
            $this->RESPONS->CurrentValue = HtmlDecode($this->RESPONS->CurrentValue);
        }
        $this->RESPONS->EditValue = $this->RESPONS->CurrentValue;
        $this->RESPONS->PlaceHolder = RemoveHtml($this->RESPONS->caption());

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
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->FTYPE);
                    $doc->exportCaption($this->FORWARD_DATE);
                    $doc->exportCaption($this->FMESSAGE);
                    $doc->exportCaption($this->FORWARD_BY);
                    $doc->exportCaption($this->OPEN_DATE);
                    $doc->exportCaption($this->RESPONS_TYPE);
                    $doc->exportCaption($this->RESPONS);
                } else {
                    $doc->exportCaption($this->LETTER_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->FTYPE);
                    $doc->exportCaption($this->FORWARD_DATE);
                    $doc->exportCaption($this->FMESSAGE);
                    $doc->exportCaption($this->FORWARD_BY);
                    $doc->exportCaption($this->OPEN_DATE);
                    $doc->exportCaption($this->RESPONS_TYPE);
                    $doc->exportCaption($this->RESPONS);
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
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->FTYPE);
                        $doc->exportField($this->FORWARD_DATE);
                        $doc->exportField($this->FMESSAGE);
                        $doc->exportField($this->FORWARD_BY);
                        $doc->exportField($this->OPEN_DATE);
                        $doc->exportField($this->RESPONS_TYPE);
                        $doc->exportField($this->RESPONS);
                    } else {
                        $doc->exportField($this->LETTER_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->FTYPE);
                        $doc->exportField($this->FORWARD_DATE);
                        $doc->exportField($this->FMESSAGE);
                        $doc->exportField($this->FORWARD_BY);
                        $doc->exportField($this->OPEN_DATE);
                        $doc->exportField($this->RESPONS_TYPE);
                        $doc->exportField($this->RESPONS);
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
