<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for ORG_DOC
 */
class OrgDoc extends DbTable
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
    public $DOC_ID;
    public $PERMIT_ID;
    public $DOC_NAME;
    public $DOC_NO;
    public $DOC_START_DATE;
    public $END_DATE;
    public $QUALIFICATION;
    public $DESCRIPTION;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'ORG_DOC';
        $this->TableName = 'ORG_DOC';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[ORG_DOC]";
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
        $this->ORG_UNIT_CODE = new DbField('ORG_DOC', 'ORG_DOC', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // DOC_ID
        $this->DOC_ID = new DbField('ORG_DOC', 'ORG_DOC', 'x_DOC_ID', 'DOC_ID', '[DOC_ID]', '[DOC_ID]', 200, 50, -1, false, '[DOC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_ID->IsPrimaryKey = true; // Primary key field
        $this->DOC_ID->Nullable = false; // NOT NULL field
        $this->DOC_ID->Required = true; // Required field
        $this->DOC_ID->Sortable = true; // Allow sort
        $this->DOC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_ID->Param, "CustomMsg");
        $this->Fields['DOC_ID'] = &$this->DOC_ID;

        // PERMIT_ID
        $this->PERMIT_ID = new DbField('ORG_DOC', 'ORG_DOC', 'x_PERMIT_ID', 'PERMIT_ID', '[PERMIT_ID]', 'CAST([PERMIT_ID] AS NVARCHAR)', 17, 1, -1, false, '[PERMIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PERMIT_ID->Sortable = true; // Allow sort
        $this->PERMIT_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PERMIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PERMIT_ID->Param, "CustomMsg");
        $this->Fields['PERMIT_ID'] = &$this->PERMIT_ID;

        // DOC_NAME
        $this->DOC_NAME = new DbField('ORG_DOC', 'ORG_DOC', 'x_DOC_NAME', 'DOC_NAME', '[DOC_NAME]', '[DOC_NAME]', 200, 100, -1, false, '[DOC_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_NAME->Sortable = true; // Allow sort
        $this->DOC_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_NAME->Param, "CustomMsg");
        $this->Fields['DOC_NAME'] = &$this->DOC_NAME;

        // DOC_NO
        $this->DOC_NO = new DbField('ORG_DOC', 'ORG_DOC', 'x_DOC_NO', 'DOC_NO', '[DOC_NO]', '[DOC_NO]', 200, 50, -1, false, '[DOC_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_NO->Sortable = true; // Allow sort
        $this->DOC_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_NO->Param, "CustomMsg");
        $this->Fields['DOC_NO'] = &$this->DOC_NO;

        // DOC_START_DATE
        $this->DOC_START_DATE = new DbField('ORG_DOC', 'ORG_DOC', 'x_DOC_START_DATE', 'DOC_START_DATE', '[DOC_START_DATE]', CastDateFieldForLike("[DOC_START_DATE]", 0, "DB"), 135, 8, 0, false, '[DOC_START_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_START_DATE->Sortable = true; // Allow sort
        $this->DOC_START_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->DOC_START_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_START_DATE->Param, "CustomMsg");
        $this->Fields['DOC_START_DATE'] = &$this->DOC_START_DATE;

        // END_DATE
        $this->END_DATE = new DbField('ORG_DOC', 'ORG_DOC', 'x_END_DATE', 'END_DATE', '[END_DATE]', CastDateFieldForLike("[END_DATE]", 0, "DB"), 135, 8, 0, false, '[END_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->END_DATE->Sortable = true; // Allow sort
        $this->END_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->END_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->END_DATE->Param, "CustomMsg");
        $this->Fields['END_DATE'] = &$this->END_DATE;

        // QUALIFICATION
        $this->QUALIFICATION = new DbField('ORG_DOC', 'ORG_DOC', 'x_QUALIFICATION', 'QUALIFICATION', '[QUALIFICATION]', '[QUALIFICATION]', 200, 200, -1, false, '[QUALIFICATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->QUALIFICATION->Sortable = true; // Allow sort
        $this->QUALIFICATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->QUALIFICATION->Param, "CustomMsg");
        $this->Fields['QUALIFICATION'] = &$this->QUALIFICATION;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('ORG_DOC', 'ORG_DOC', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[ORG_DOC]";
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
            if (array_key_exists('DOC_ID', $rs)) {
                AddFilter($where, QuotedName('DOC_ID', $this->Dbid) . '=' . QuotedValue($rs['DOC_ID'], $this->DOC_ID->DataType, $this->Dbid));
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
        $this->DOC_ID->DbValue = $row['DOC_ID'];
        $this->PERMIT_ID->DbValue = $row['PERMIT_ID'];
        $this->DOC_NAME->DbValue = $row['DOC_NAME'];
        $this->DOC_NO->DbValue = $row['DOC_NO'];
        $this->DOC_START_DATE->DbValue = $row['DOC_START_DATE'];
        $this->END_DATE->DbValue = $row['END_DATE'];
        $this->QUALIFICATION->DbValue = $row['QUALIFICATION'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [DOC_ID] = '@DOC_ID@'";
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
        $val = $current ? $this->DOC_ID->CurrentValue : $this->DOC_ID->OldValue;
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
                $this->DOC_ID->CurrentValue = $keys[1];
            } else {
                $this->DOC_ID->OldValue = $keys[1];
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
            $val = array_key_exists('DOC_ID', $row) ? $row['DOC_ID'] : null;
        } else {
            $val = $this->DOC_ID->OldValue !== null ? $this->DOC_ID->OldValue : $this->DOC_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@DOC_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("OrgDocList");
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
        if ($pageName == "OrgDocView") {
            return $Language->phrase("View");
        } elseif ($pageName == "OrgDocEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "OrgDocAdd") {
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
                return "OrgDocView";
            case Config("API_ADD_ACTION"):
                return "OrgDocAdd";
            case Config("API_EDIT_ACTION"):
                return "OrgDocEdit";
            case Config("API_DELETE_ACTION"):
                return "OrgDocDelete";
            case Config("API_LIST_ACTION"):
                return "OrgDocList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "OrgDocList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("OrgDocView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("OrgDocView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "OrgDocAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "OrgDocAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("OrgDocEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("OrgDocAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("OrgDocDelete", $this->getUrlParm());
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
        $json .= ",DOC_ID:" . JsonEncode($this->DOC_ID->CurrentValue, "string");
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
        if ($this->DOC_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->DOC_ID->CurrentValue);
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
            if (($keyValue = Param("DOC_ID") ?? Route("DOC_ID")) !== null) {
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
                $this->DOC_ID->CurrentValue = $key[1];
            } else {
                $this->DOC_ID->OldValue = $key[1];
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
        $this->DOC_ID->setDbValue($row['DOC_ID']);
        $this->PERMIT_ID->setDbValue($row['PERMIT_ID']);
        $this->DOC_NAME->setDbValue($row['DOC_NAME']);
        $this->DOC_NO->setDbValue($row['DOC_NO']);
        $this->DOC_START_DATE->setDbValue($row['DOC_START_DATE']);
        $this->END_DATE->setDbValue($row['END_DATE']);
        $this->QUALIFICATION->setDbValue($row['QUALIFICATION']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // DOC_ID

        // PERMIT_ID

        // DOC_NAME

        // DOC_NO

        // DOC_START_DATE

        // END_DATE

        // QUALIFICATION

        // DESCRIPTION

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // DOC_ID
        $this->DOC_ID->ViewValue = $this->DOC_ID->CurrentValue;
        $this->DOC_ID->ViewCustomAttributes = "";

        // PERMIT_ID
        $this->PERMIT_ID->ViewValue = $this->PERMIT_ID->CurrentValue;
        $this->PERMIT_ID->ViewValue = FormatNumber($this->PERMIT_ID->ViewValue, 0, -2, -2, -2);
        $this->PERMIT_ID->ViewCustomAttributes = "";

        // DOC_NAME
        $this->DOC_NAME->ViewValue = $this->DOC_NAME->CurrentValue;
        $this->DOC_NAME->ViewCustomAttributes = "";

        // DOC_NO
        $this->DOC_NO->ViewValue = $this->DOC_NO->CurrentValue;
        $this->DOC_NO->ViewCustomAttributes = "";

        // DOC_START_DATE
        $this->DOC_START_DATE->ViewValue = $this->DOC_START_DATE->CurrentValue;
        $this->DOC_START_DATE->ViewValue = FormatDateTime($this->DOC_START_DATE->ViewValue, 0);
        $this->DOC_START_DATE->ViewCustomAttributes = "";

        // END_DATE
        $this->END_DATE->ViewValue = $this->END_DATE->CurrentValue;
        $this->END_DATE->ViewValue = FormatDateTime($this->END_DATE->ViewValue, 0);
        $this->END_DATE->ViewCustomAttributes = "";

        // QUALIFICATION
        $this->QUALIFICATION->ViewValue = $this->QUALIFICATION->CurrentValue;
        $this->QUALIFICATION->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // DOC_ID
        $this->DOC_ID->LinkCustomAttributes = "";
        $this->DOC_ID->HrefValue = "";
        $this->DOC_ID->TooltipValue = "";

        // PERMIT_ID
        $this->PERMIT_ID->LinkCustomAttributes = "";
        $this->PERMIT_ID->HrefValue = "";
        $this->PERMIT_ID->TooltipValue = "";

        // DOC_NAME
        $this->DOC_NAME->LinkCustomAttributes = "";
        $this->DOC_NAME->HrefValue = "";
        $this->DOC_NAME->TooltipValue = "";

        // DOC_NO
        $this->DOC_NO->LinkCustomAttributes = "";
        $this->DOC_NO->HrefValue = "";
        $this->DOC_NO->TooltipValue = "";

        // DOC_START_DATE
        $this->DOC_START_DATE->LinkCustomAttributes = "";
        $this->DOC_START_DATE->HrefValue = "";
        $this->DOC_START_DATE->TooltipValue = "";

        // END_DATE
        $this->END_DATE->LinkCustomAttributes = "";
        $this->END_DATE->HrefValue = "";
        $this->END_DATE->TooltipValue = "";

        // QUALIFICATION
        $this->QUALIFICATION->LinkCustomAttributes = "";
        $this->QUALIFICATION->HrefValue = "";
        $this->QUALIFICATION->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

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

        // DOC_ID
        $this->DOC_ID->EditAttrs["class"] = "form-control";
        $this->DOC_ID->EditCustomAttributes = "";
        if (!$this->DOC_ID->Raw) {
            $this->DOC_ID->CurrentValue = HtmlDecode($this->DOC_ID->CurrentValue);
        }
        $this->DOC_ID->EditValue = $this->DOC_ID->CurrentValue;
        $this->DOC_ID->PlaceHolder = RemoveHtml($this->DOC_ID->caption());

        // PERMIT_ID
        $this->PERMIT_ID->EditAttrs["class"] = "form-control";
        $this->PERMIT_ID->EditCustomAttributes = "";
        $this->PERMIT_ID->EditValue = $this->PERMIT_ID->CurrentValue;
        $this->PERMIT_ID->PlaceHolder = RemoveHtml($this->PERMIT_ID->caption());

        // DOC_NAME
        $this->DOC_NAME->EditAttrs["class"] = "form-control";
        $this->DOC_NAME->EditCustomAttributes = "";
        if (!$this->DOC_NAME->Raw) {
            $this->DOC_NAME->CurrentValue = HtmlDecode($this->DOC_NAME->CurrentValue);
        }
        $this->DOC_NAME->EditValue = $this->DOC_NAME->CurrentValue;
        $this->DOC_NAME->PlaceHolder = RemoveHtml($this->DOC_NAME->caption());

        // DOC_NO
        $this->DOC_NO->EditAttrs["class"] = "form-control";
        $this->DOC_NO->EditCustomAttributes = "";
        if (!$this->DOC_NO->Raw) {
            $this->DOC_NO->CurrentValue = HtmlDecode($this->DOC_NO->CurrentValue);
        }
        $this->DOC_NO->EditValue = $this->DOC_NO->CurrentValue;
        $this->DOC_NO->PlaceHolder = RemoveHtml($this->DOC_NO->caption());

        // DOC_START_DATE
        $this->DOC_START_DATE->EditAttrs["class"] = "form-control";
        $this->DOC_START_DATE->EditCustomAttributes = "";
        $this->DOC_START_DATE->EditValue = FormatDateTime($this->DOC_START_DATE->CurrentValue, 8);
        $this->DOC_START_DATE->PlaceHolder = RemoveHtml($this->DOC_START_DATE->caption());

        // END_DATE
        $this->END_DATE->EditAttrs["class"] = "form-control";
        $this->END_DATE->EditCustomAttributes = "";
        $this->END_DATE->EditValue = FormatDateTime($this->END_DATE->CurrentValue, 8);
        $this->END_DATE->PlaceHolder = RemoveHtml($this->END_DATE->caption());

        // QUALIFICATION
        $this->QUALIFICATION->EditAttrs["class"] = "form-control";
        $this->QUALIFICATION->EditCustomAttributes = "";
        if (!$this->QUALIFICATION->Raw) {
            $this->QUALIFICATION->CurrentValue = HtmlDecode($this->QUALIFICATION->CurrentValue);
        }
        $this->QUALIFICATION->EditValue = $this->QUALIFICATION->CurrentValue;
        $this->QUALIFICATION->PlaceHolder = RemoveHtml($this->QUALIFICATION->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

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
                    $doc->exportCaption($this->DOC_ID);
                    $doc->exportCaption($this->PERMIT_ID);
                    $doc->exportCaption($this->DOC_NAME);
                    $doc->exportCaption($this->DOC_NO);
                    $doc->exportCaption($this->DOC_START_DATE);
                    $doc->exportCaption($this->END_DATE);
                    $doc->exportCaption($this->QUALIFICATION);
                    $doc->exportCaption($this->DESCRIPTION);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->DOC_ID);
                    $doc->exportCaption($this->PERMIT_ID);
                    $doc->exportCaption($this->DOC_NAME);
                    $doc->exportCaption($this->DOC_NO);
                    $doc->exportCaption($this->DOC_START_DATE);
                    $doc->exportCaption($this->END_DATE);
                    $doc->exportCaption($this->QUALIFICATION);
                    $doc->exportCaption($this->DESCRIPTION);
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
                        $doc->exportField($this->DOC_ID);
                        $doc->exportField($this->PERMIT_ID);
                        $doc->exportField($this->DOC_NAME);
                        $doc->exportField($this->DOC_NO);
                        $doc->exportField($this->DOC_START_DATE);
                        $doc->exportField($this->END_DATE);
                        $doc->exportField($this->QUALIFICATION);
                        $doc->exportField($this->DESCRIPTION);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->DOC_ID);
                        $doc->exportField($this->PERMIT_ID);
                        $doc->exportField($this->DOC_NAME);
                        $doc->exportField($this->DOC_NO);
                        $doc->exportField($this->DOC_START_DATE);
                        $doc->exportField($this->END_DATE);
                        $doc->exportField($this->QUALIFICATION);
                        $doc->exportField($this->DESCRIPTION);
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
