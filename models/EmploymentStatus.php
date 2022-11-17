<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for EMPLOYMENT_STATUS
 */
class EmploymentStatus extends DbTable
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
    public $status_id;
    public $emp_type;
    public $name_of_status;
    public $description;
    public $gol_type;
    public $percentage;
    public $maxberkala_duratin;
    public $maxregular_duration;
    public $max_gol_otomatis;
    public $pension_age;
    public $task_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'EMPLOYMENT_STATUS';
        $this->TableName = 'EMPLOYMENT_STATUS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[EMPLOYMENT_STATUS]";
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

        // status_id
        $this->status_id = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_status_id', 'status_id', '[status_id]', 'CAST([status_id] AS NVARCHAR)', 17, 1, -1, false, '[status_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status_id->IsPrimaryKey = true; // Primary key field
        $this->status_id->Nullable = false; // NOT NULL field
        $this->status_id->Required = true; // Required field
        $this->status_id->Sortable = true; // Allow sort
        $this->status_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_id->Param, "CustomMsg");
        $this->Fields['status_id'] = &$this->status_id;

        // emp_type
        $this->emp_type = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_emp_type', 'emp_type', '[emp_type]', 'CAST([emp_type] AS NVARCHAR)', 17, 1, -1, false, '[emp_type]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->emp_type->Nullable = false; // NOT NULL field
        $this->emp_type->Required = true; // Required field
        $this->emp_type->Sortable = true; // Allow sort
        $this->emp_type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->emp_type->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->emp_type->Param, "CustomMsg");
        $this->Fields['emp_type'] = &$this->emp_type;

        // name_of_status
        $this->name_of_status = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_name_of_status', 'name_of_status', '[name_of_status]', '[name_of_status]', 200, 200, -1, false, '[name_of_status]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->name_of_status->Sortable = true; // Allow sort
        $this->name_of_status->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->name_of_status->Param, "CustomMsg");
        $this->Fields['name_of_status'] = &$this->name_of_status;

        // description
        $this->description = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_description', 'description', '[description]', '[description]', 200, 200, -1, false, '[description]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->description->Sortable = true; // Allow sort
        $this->description->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->description->Param, "CustomMsg");
        $this->Fields['description'] = &$this->description;

        // gol_type
        $this->gol_type = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_gol_type', 'gol_type', '[gol_type]', '[gol_type]', 200, 5, -1, false, '[gol_type]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->gol_type->Sortable = true; // Allow sort
        $this->gol_type->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->gol_type->Param, "CustomMsg");
        $this->Fields['gol_type'] = &$this->gol_type;

        // percentage
        $this->percentage = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_percentage', 'percentage', '[percentage]', 'CAST([percentage] AS NVARCHAR)', 131, 8, -1, false, '[percentage]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->percentage->Sortable = true; // Allow sort
        $this->percentage->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->percentage->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->percentage->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->percentage->Param, "CustomMsg");
        $this->Fields['percentage'] = &$this->percentage;

        // maxberkala_duratin
        $this->maxberkala_duratin = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_maxberkala_duratin', 'maxberkala_duratin', '[maxberkala_duratin]', 'CAST([maxberkala_duratin] AS NVARCHAR)', 2, 2, -1, false, '[maxberkala_duratin]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxberkala_duratin->Sortable = true; // Allow sort
        $this->maxberkala_duratin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->maxberkala_duratin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxberkala_duratin->Param, "CustomMsg");
        $this->Fields['maxberkala_duratin'] = &$this->maxberkala_duratin;

        // maxregular_duration
        $this->maxregular_duration = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_maxregular_duration', 'maxregular_duration', '[maxregular_duration]', 'CAST([maxregular_duration] AS NVARCHAR)', 2, 2, -1, false, '[maxregular_duration]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxregular_duration->Sortable = true; // Allow sort
        $this->maxregular_duration->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->maxregular_duration->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxregular_duration->Param, "CustomMsg");
        $this->Fields['maxregular_duration'] = &$this->maxregular_duration;

        // max_gol_otomatis
        $this->max_gol_otomatis = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_max_gol_otomatis', 'max_gol_otomatis', '[max_gol_otomatis]', 'CAST([max_gol_otomatis] AS NVARCHAR)', 2, 2, -1, false, '[max_gol_otomatis]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_gol_otomatis->Sortable = true; // Allow sort
        $this->max_gol_otomatis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->max_gol_otomatis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_gol_otomatis->Param, "CustomMsg");
        $this->Fields['max_gol_otomatis'] = &$this->max_gol_otomatis;

        // pension_age
        $this->pension_age = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_pension_age', 'pension_age', '[pension_age]', 'CAST([pension_age] AS NVARCHAR)', 2, 2, -1, false, '[pension_age]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pension_age->Sortable = true; // Allow sort
        $this->pension_age->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pension_age->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pension_age->Param, "CustomMsg");
        $this->Fields['pension_age'] = &$this->pension_age;

        // task_id
        $this->task_id = new DbField('EMPLOYMENT_STATUS', 'EMPLOYMENT_STATUS', 'x_task_id', 'task_id', '[task_id]', 'CAST([task_id] AS NVARCHAR)', 17, 1, -1, false, '[task_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->task_id->Sortable = true; // Allow sort
        $this->task_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->task_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->task_id->Param, "CustomMsg");
        $this->Fields['task_id'] = &$this->task_id;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[EMPLOYMENT_STATUS]";
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
            if (array_key_exists('status_id', $rs)) {
                AddFilter($where, QuotedName('status_id', $this->Dbid) . '=' . QuotedValue($rs['status_id'], $this->status_id->DataType, $this->Dbid));
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
        $this->status_id->DbValue = $row['status_id'];
        $this->emp_type->DbValue = $row['emp_type'];
        $this->name_of_status->DbValue = $row['name_of_status'];
        $this->description->DbValue = $row['description'];
        $this->gol_type->DbValue = $row['gol_type'];
        $this->percentage->DbValue = $row['percentage'];
        $this->maxberkala_duratin->DbValue = $row['maxberkala_duratin'];
        $this->maxregular_duration->DbValue = $row['maxregular_duration'];
        $this->max_gol_otomatis->DbValue = $row['max_gol_otomatis'];
        $this->pension_age->DbValue = $row['pension_age'];
        $this->task_id->DbValue = $row['task_id'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[status_id] = @status_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->status_id->CurrentValue : $this->status_id->OldValue;
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
                $this->status_id->CurrentValue = $keys[0];
            } else {
                $this->status_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('status_id', $row) ? $row['status_id'] : null;
        } else {
            $val = $this->status_id->OldValue !== null ? $this->status_id->OldValue : $this->status_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@status_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("EmploymentStatusList");
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
        if ($pageName == "EmploymentStatusView") {
            return $Language->phrase("View");
        } elseif ($pageName == "EmploymentStatusEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "EmploymentStatusAdd") {
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
                return "EmploymentStatusView";
            case Config("API_ADD_ACTION"):
                return "EmploymentStatusAdd";
            case Config("API_EDIT_ACTION"):
                return "EmploymentStatusEdit";
            case Config("API_DELETE_ACTION"):
                return "EmploymentStatusDelete";
            case Config("API_LIST_ACTION"):
                return "EmploymentStatusList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "EmploymentStatusList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("EmploymentStatusView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("EmploymentStatusView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "EmploymentStatusAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "EmploymentStatusAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("EmploymentStatusEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("EmploymentStatusAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("EmploymentStatusDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "status_id:" . JsonEncode($this->status_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->status_id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->status_id->CurrentValue);
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
            if (($keyValue = Param("status_id") ?? Route("status_id")) !== null) {
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
                if (!is_numeric($key)) {
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
                $this->status_id->CurrentValue = $key;
            } else {
                $this->status_id->OldValue = $key;
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
        $this->status_id->setDbValue($row['status_id']);
        $this->emp_type->setDbValue($row['emp_type']);
        $this->name_of_status->setDbValue($row['name_of_status']);
        $this->description->setDbValue($row['description']);
        $this->gol_type->setDbValue($row['gol_type']);
        $this->percentage->setDbValue($row['percentage']);
        $this->maxberkala_duratin->setDbValue($row['maxberkala_duratin']);
        $this->maxregular_duration->setDbValue($row['maxregular_duration']);
        $this->max_gol_otomatis->setDbValue($row['max_gol_otomatis']);
        $this->pension_age->setDbValue($row['pension_age']);
        $this->task_id->setDbValue($row['task_id']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // status_id

        // emp_type

        // name_of_status

        // description

        // gol_type

        // percentage

        // maxberkala_duratin

        // maxregular_duration

        // max_gol_otomatis

        // pension_age

        // task_id

        // status_id
        $this->status_id->ViewValue = $this->status_id->CurrentValue;
        $this->status_id->ViewValue = FormatNumber($this->status_id->ViewValue, 0, -2, -2, -2);
        $this->status_id->ViewCustomAttributes = "";

        // emp_type
        $this->emp_type->ViewValue = $this->emp_type->CurrentValue;
        $this->emp_type->ViewValue = FormatNumber($this->emp_type->ViewValue, 0, -2, -2, -2);
        $this->emp_type->ViewCustomAttributes = "";

        // name_of_status
        $this->name_of_status->ViewValue = $this->name_of_status->CurrentValue;
        $this->name_of_status->ViewCustomAttributes = "";

        // description
        $this->description->ViewValue = $this->description->CurrentValue;
        $this->description->ViewCustomAttributes = "";

        // gol_type
        $this->gol_type->ViewValue = $this->gol_type->CurrentValue;
        $this->gol_type->ViewCustomAttributes = "";

        // percentage
        $this->percentage->ViewValue = $this->percentage->CurrentValue;
        $this->percentage->ViewValue = FormatNumber($this->percentage->ViewValue, 2, -2, -2, -2);
        $this->percentage->ViewCustomAttributes = "";

        // maxberkala_duratin
        $this->maxberkala_duratin->ViewValue = $this->maxberkala_duratin->CurrentValue;
        $this->maxberkala_duratin->ViewValue = FormatNumber($this->maxberkala_duratin->ViewValue, 0, -2, -2, -2);
        $this->maxberkala_duratin->ViewCustomAttributes = "";

        // maxregular_duration
        $this->maxregular_duration->ViewValue = $this->maxregular_duration->CurrentValue;
        $this->maxregular_duration->ViewValue = FormatNumber($this->maxregular_duration->ViewValue, 0, -2, -2, -2);
        $this->maxregular_duration->ViewCustomAttributes = "";

        // max_gol_otomatis
        $this->max_gol_otomatis->ViewValue = $this->max_gol_otomatis->CurrentValue;
        $this->max_gol_otomatis->ViewValue = FormatNumber($this->max_gol_otomatis->ViewValue, 0, -2, -2, -2);
        $this->max_gol_otomatis->ViewCustomAttributes = "";

        // pension_age
        $this->pension_age->ViewValue = $this->pension_age->CurrentValue;
        $this->pension_age->ViewValue = FormatNumber($this->pension_age->ViewValue, 0, -2, -2, -2);
        $this->pension_age->ViewCustomAttributes = "";

        // task_id
        $this->task_id->ViewValue = $this->task_id->CurrentValue;
        $this->task_id->ViewValue = FormatNumber($this->task_id->ViewValue, 0, -2, -2, -2);
        $this->task_id->ViewCustomAttributes = "";

        // status_id
        $this->status_id->LinkCustomAttributes = "";
        $this->status_id->HrefValue = "";
        $this->status_id->TooltipValue = "";

        // emp_type
        $this->emp_type->LinkCustomAttributes = "";
        $this->emp_type->HrefValue = "";
        $this->emp_type->TooltipValue = "";

        // name_of_status
        $this->name_of_status->LinkCustomAttributes = "";
        $this->name_of_status->HrefValue = "";
        $this->name_of_status->TooltipValue = "";

        // description
        $this->description->LinkCustomAttributes = "";
        $this->description->HrefValue = "";
        $this->description->TooltipValue = "";

        // gol_type
        $this->gol_type->LinkCustomAttributes = "";
        $this->gol_type->HrefValue = "";
        $this->gol_type->TooltipValue = "";

        // percentage
        $this->percentage->LinkCustomAttributes = "";
        $this->percentage->HrefValue = "";
        $this->percentage->TooltipValue = "";

        // maxberkala_duratin
        $this->maxberkala_duratin->LinkCustomAttributes = "";
        $this->maxberkala_duratin->HrefValue = "";
        $this->maxberkala_duratin->TooltipValue = "";

        // maxregular_duration
        $this->maxregular_duration->LinkCustomAttributes = "";
        $this->maxregular_duration->HrefValue = "";
        $this->maxregular_duration->TooltipValue = "";

        // max_gol_otomatis
        $this->max_gol_otomatis->LinkCustomAttributes = "";
        $this->max_gol_otomatis->HrefValue = "";
        $this->max_gol_otomatis->TooltipValue = "";

        // pension_age
        $this->pension_age->LinkCustomAttributes = "";
        $this->pension_age->HrefValue = "";
        $this->pension_age->TooltipValue = "";

        // task_id
        $this->task_id->LinkCustomAttributes = "";
        $this->task_id->HrefValue = "";
        $this->task_id->TooltipValue = "";

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

        // status_id
        $this->status_id->EditAttrs["class"] = "form-control";
        $this->status_id->EditCustomAttributes = "";
        $this->status_id->EditValue = $this->status_id->CurrentValue;
        $this->status_id->PlaceHolder = RemoveHtml($this->status_id->caption());

        // emp_type
        $this->emp_type->EditAttrs["class"] = "form-control";
        $this->emp_type->EditCustomAttributes = "";
        $this->emp_type->EditValue = $this->emp_type->CurrentValue;
        $this->emp_type->PlaceHolder = RemoveHtml($this->emp_type->caption());

        // name_of_status
        $this->name_of_status->EditAttrs["class"] = "form-control";
        $this->name_of_status->EditCustomAttributes = "";
        if (!$this->name_of_status->Raw) {
            $this->name_of_status->CurrentValue = HtmlDecode($this->name_of_status->CurrentValue);
        }
        $this->name_of_status->EditValue = $this->name_of_status->CurrentValue;
        $this->name_of_status->PlaceHolder = RemoveHtml($this->name_of_status->caption());

        // description
        $this->description->EditAttrs["class"] = "form-control";
        $this->description->EditCustomAttributes = "";
        if (!$this->description->Raw) {
            $this->description->CurrentValue = HtmlDecode($this->description->CurrentValue);
        }
        $this->description->EditValue = $this->description->CurrentValue;
        $this->description->PlaceHolder = RemoveHtml($this->description->caption());

        // gol_type
        $this->gol_type->EditAttrs["class"] = "form-control";
        $this->gol_type->EditCustomAttributes = "";
        if (!$this->gol_type->Raw) {
            $this->gol_type->CurrentValue = HtmlDecode($this->gol_type->CurrentValue);
        }
        $this->gol_type->EditValue = $this->gol_type->CurrentValue;
        $this->gol_type->PlaceHolder = RemoveHtml($this->gol_type->caption());

        // percentage
        $this->percentage->EditAttrs["class"] = "form-control";
        $this->percentage->EditCustomAttributes = "";
        $this->percentage->EditValue = $this->percentage->CurrentValue;
        $this->percentage->PlaceHolder = RemoveHtml($this->percentage->caption());
        if (strval($this->percentage->EditValue) != "" && is_numeric($this->percentage->EditValue)) {
            $this->percentage->EditValue = FormatNumber($this->percentage->EditValue, -2, -2, -2, -2);
        }

        // maxberkala_duratin
        $this->maxberkala_duratin->EditAttrs["class"] = "form-control";
        $this->maxberkala_duratin->EditCustomAttributes = "";
        $this->maxberkala_duratin->EditValue = $this->maxberkala_duratin->CurrentValue;
        $this->maxberkala_duratin->PlaceHolder = RemoveHtml($this->maxberkala_duratin->caption());

        // maxregular_duration
        $this->maxregular_duration->EditAttrs["class"] = "form-control";
        $this->maxregular_duration->EditCustomAttributes = "";
        $this->maxregular_duration->EditValue = $this->maxregular_duration->CurrentValue;
        $this->maxregular_duration->PlaceHolder = RemoveHtml($this->maxregular_duration->caption());

        // max_gol_otomatis
        $this->max_gol_otomatis->EditAttrs["class"] = "form-control";
        $this->max_gol_otomatis->EditCustomAttributes = "";
        $this->max_gol_otomatis->EditValue = $this->max_gol_otomatis->CurrentValue;
        $this->max_gol_otomatis->PlaceHolder = RemoveHtml($this->max_gol_otomatis->caption());

        // pension_age
        $this->pension_age->EditAttrs["class"] = "form-control";
        $this->pension_age->EditCustomAttributes = "";
        $this->pension_age->EditValue = $this->pension_age->CurrentValue;
        $this->pension_age->PlaceHolder = RemoveHtml($this->pension_age->caption());

        // task_id
        $this->task_id->EditAttrs["class"] = "form-control";
        $this->task_id->EditCustomAttributes = "";
        $this->task_id->EditValue = $this->task_id->CurrentValue;
        $this->task_id->PlaceHolder = RemoveHtml($this->task_id->caption());

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
                    $doc->exportCaption($this->status_id);
                    $doc->exportCaption($this->emp_type);
                    $doc->exportCaption($this->name_of_status);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->gol_type);
                    $doc->exportCaption($this->percentage);
                    $doc->exportCaption($this->maxberkala_duratin);
                    $doc->exportCaption($this->maxregular_duration);
                    $doc->exportCaption($this->max_gol_otomatis);
                    $doc->exportCaption($this->pension_age);
                    $doc->exportCaption($this->task_id);
                } else {
                    $doc->exportCaption($this->status_id);
                    $doc->exportCaption($this->emp_type);
                    $doc->exportCaption($this->name_of_status);
                    $doc->exportCaption($this->description);
                    $doc->exportCaption($this->gol_type);
                    $doc->exportCaption($this->percentage);
                    $doc->exportCaption($this->maxberkala_duratin);
                    $doc->exportCaption($this->maxregular_duration);
                    $doc->exportCaption($this->max_gol_otomatis);
                    $doc->exportCaption($this->pension_age);
                    $doc->exportCaption($this->task_id);
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
                        $doc->exportField($this->status_id);
                        $doc->exportField($this->emp_type);
                        $doc->exportField($this->name_of_status);
                        $doc->exportField($this->description);
                        $doc->exportField($this->gol_type);
                        $doc->exportField($this->percentage);
                        $doc->exportField($this->maxberkala_duratin);
                        $doc->exportField($this->maxregular_duration);
                        $doc->exportField($this->max_gol_otomatis);
                        $doc->exportField($this->pension_age);
                        $doc->exportField($this->task_id);
                    } else {
                        $doc->exportField($this->status_id);
                        $doc->exportField($this->emp_type);
                        $doc->exportField($this->name_of_status);
                        $doc->exportField($this->description);
                        $doc->exportField($this->gol_type);
                        $doc->exportField($this->percentage);
                        $doc->exportField($this->maxberkala_duratin);
                        $doc->exportField($this->maxregular_duration);
                        $doc->exportField($this->max_gol_otomatis);
                        $doc->exportField($this->pension_age);
                        $doc->exportField($this->task_id);
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
