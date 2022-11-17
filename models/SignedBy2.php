<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for SIGNED_BY
 */
class SignedBy2 extends DbTable
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
    public $SIGN_ID;
    public $EMPLOYEE_ID;
    public $FULLNAME;
    public $GELAR;
    public $JABATAN;
    public $CURRENT_ADDRESS;
    public $CITY;
    public $PHONE;
    public $FAX;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'SIGNED_BY2';
        $this->TableName = 'SIGNED_BY';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[SIGNED_BY]";
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
        $this->ORG_UNIT_CODE = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // SIGN_ID
        $this->SIGN_ID = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_SIGN_ID', 'SIGN_ID', '[SIGN_ID]', 'CAST([SIGN_ID] AS NVARCHAR)', 2, 2, -1, false, '[SIGN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIGN_ID->IsPrimaryKey = true; // Primary key field
        $this->SIGN_ID->Nullable = false; // NOT NULL field
        $this->SIGN_ID->Required = true; // Required field
        $this->SIGN_ID->Sortable = true; // Allow sort
        $this->SIGN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SIGN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIGN_ID->Param, "CustomMsg");
        $this->Fields['SIGN_ID'] = &$this->SIGN_ID;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 50, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // FULLNAME
        $this->FULLNAME = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_FULLNAME', 'FULLNAME', '[FULLNAME]', '[FULLNAME]', 200, 150, -1, false, '[FULLNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FULLNAME->Sortable = true; // Allow sort
        $this->FULLNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FULLNAME->Param, "CustomMsg");
        $this->Fields['FULLNAME'] = &$this->FULLNAME;

        // GELAR
        $this->GELAR = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_GELAR', 'GELAR', '[GELAR]', '[GELAR]', 200, 50, -1, false, '[GELAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->GELAR->Sortable = true; // Allow sort
        $this->GELAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GELAR->Param, "CustomMsg");
        $this->Fields['GELAR'] = &$this->GELAR;

        // JABATAN
        $this->JABATAN = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_JABATAN', 'JABATAN', '[JABATAN]', '[JABATAN]', 200, 50, -1, false, '[JABATAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->JABATAN->Sortable = true; // Allow sort
        $this->JABATAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JABATAN->Param, "CustomMsg");
        $this->Fields['JABATAN'] = &$this->JABATAN;

        // CURRENT_ADDRESS
        $this->CURRENT_ADDRESS = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_CURRENT_ADDRESS', 'CURRENT_ADDRESS', '[CURRENT_ADDRESS]', '[CURRENT_ADDRESS]', 200, 200, -1, false, '[CURRENT_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CURRENT_ADDRESS->Sortable = true; // Allow sort
        $this->CURRENT_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CURRENT_ADDRESS->Param, "CustomMsg");
        $this->Fields['CURRENT_ADDRESS'] = &$this->CURRENT_ADDRESS;

        // CITY
        $this->CITY = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_CITY', 'CITY', '[CITY]', '[CITY]', 200, 100, -1, false, '[CITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CITY->Sortable = true; // Allow sort
        $this->CITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CITY->Param, "CustomMsg");
        $this->Fields['CITY'] = &$this->CITY;

        // PHONE
        $this->PHONE = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_PHONE', 'PHONE', '[PHONE]', '[PHONE]', 200, 50, -1, false, '[PHONE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE->Sortable = true; // Allow sort
        $this->PHONE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE->Param, "CustomMsg");
        $this->Fields['PHONE'] = &$this->PHONE;

        // FAX
        $this->FAX = new DbField('SIGNED_BY2', 'SIGNED_BY', 'x_FAX', 'FAX', '[FAX]', '[FAX]', 200, 50, -1, false, '[FAX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX->Sortable = true; // Allow sort
        $this->FAX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX->Param, "CustomMsg");
        $this->Fields['FAX'] = &$this->FAX;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[SIGNED_BY]";
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
            if (array_key_exists('SIGN_ID', $rs)) {
                AddFilter($where, QuotedName('SIGN_ID', $this->Dbid) . '=' . QuotedValue($rs['SIGN_ID'], $this->SIGN_ID->DataType, $this->Dbid));
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
        $this->SIGN_ID->DbValue = $row['SIGN_ID'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->FULLNAME->DbValue = $row['FULLNAME'];
        $this->GELAR->DbValue = $row['GELAR'];
        $this->JABATAN->DbValue = $row['JABATAN'];
        $this->CURRENT_ADDRESS->DbValue = $row['CURRENT_ADDRESS'];
        $this->CITY->DbValue = $row['CITY'];
        $this->PHONE->DbValue = $row['PHONE'];
        $this->FAX->DbValue = $row['FAX'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [SIGN_ID] = @SIGN_ID@";
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
        $val = $current ? $this->SIGN_ID->CurrentValue : $this->SIGN_ID->OldValue;
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
                $this->SIGN_ID->CurrentValue = $keys[1];
            } else {
                $this->SIGN_ID->OldValue = $keys[1];
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
            $val = array_key_exists('SIGN_ID', $row) ? $row['SIGN_ID'] : null;
        } else {
            $val = $this->SIGN_ID->OldValue !== null ? $this->SIGN_ID->OldValue : $this->SIGN_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@SIGN_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("SignedBy2List");
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
        if ($pageName == "SignedBy2View") {
            return $Language->phrase("View");
        } elseif ($pageName == "SignedBy2Edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "SignedBy2Add") {
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
                return "SignedBy2View";
            case Config("API_ADD_ACTION"):
                return "SignedBy2Add";
            case Config("API_EDIT_ACTION"):
                return "SignedBy2Edit";
            case Config("API_DELETE_ACTION"):
                return "SignedBy2Delete";
            case Config("API_LIST_ACTION"):
                return "SignedBy2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "SignedBy2List";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SignedBy2View", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("SignedBy2View", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SignedBy2Add?" . $this->getUrlParm($parm);
        } else {
            $url = "SignedBy2Add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SignedBy2Edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("SignedBy2Add", $this->getUrlParm($parm));
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
        return $this->keyUrl("SignedBy2Delete", $this->getUrlParm());
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
        $json .= ",SIGN_ID:" . JsonEncode($this->SIGN_ID->CurrentValue, "number");
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
        if ($this->SIGN_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->SIGN_ID->CurrentValue);
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
            if (($keyValue = Param("SIGN_ID") ?? Route("SIGN_ID")) !== null) {
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
                if (!is_numeric($key[1])) { // SIGN_ID
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
                $this->SIGN_ID->CurrentValue = $key[1];
            } else {
                $this->SIGN_ID->OldValue = $key[1];
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
        $this->SIGN_ID->setDbValue($row['SIGN_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->FULLNAME->setDbValue($row['FULLNAME']);
        $this->GELAR->setDbValue($row['GELAR']);
        $this->JABATAN->setDbValue($row['JABATAN']);
        $this->CURRENT_ADDRESS->setDbValue($row['CURRENT_ADDRESS']);
        $this->CITY->setDbValue($row['CITY']);
        $this->PHONE->setDbValue($row['PHONE']);
        $this->FAX->setDbValue($row['FAX']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // SIGN_ID

        // EMPLOYEE_ID

        // FULLNAME

        // GELAR

        // JABATAN

        // CURRENT_ADDRESS

        // CITY

        // PHONE

        // FAX

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // SIGN_ID
        $this->SIGN_ID->ViewValue = $this->SIGN_ID->CurrentValue;
        $this->SIGN_ID->ViewValue = FormatNumber($this->SIGN_ID->ViewValue, 0, -2, -2, -2);
        $this->SIGN_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // FULLNAME
        $this->FULLNAME->ViewValue = $this->FULLNAME->CurrentValue;
        $this->FULLNAME->ViewCustomAttributes = "";

        // GELAR
        $this->GELAR->ViewValue = $this->GELAR->CurrentValue;
        $this->GELAR->ViewCustomAttributes = "";

        // JABATAN
        $this->JABATAN->ViewValue = $this->JABATAN->CurrentValue;
        $this->JABATAN->ViewCustomAttributes = "";

        // CURRENT_ADDRESS
        $this->CURRENT_ADDRESS->ViewValue = $this->CURRENT_ADDRESS->CurrentValue;
        $this->CURRENT_ADDRESS->ViewCustomAttributes = "";

        // CITY
        $this->CITY->ViewValue = $this->CITY->CurrentValue;
        $this->CITY->ViewCustomAttributes = "";

        // PHONE
        $this->PHONE->ViewValue = $this->PHONE->CurrentValue;
        $this->PHONE->ViewCustomAttributes = "";

        // FAX
        $this->FAX->ViewValue = $this->FAX->CurrentValue;
        $this->FAX->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // SIGN_ID
        $this->SIGN_ID->LinkCustomAttributes = "";
        $this->SIGN_ID->HrefValue = "";
        $this->SIGN_ID->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // FULLNAME
        $this->FULLNAME->LinkCustomAttributes = "";
        $this->FULLNAME->HrefValue = "";
        $this->FULLNAME->TooltipValue = "";

        // GELAR
        $this->GELAR->LinkCustomAttributes = "";
        $this->GELAR->HrefValue = "";
        $this->GELAR->TooltipValue = "";

        // JABATAN
        $this->JABATAN->LinkCustomAttributes = "";
        $this->JABATAN->HrefValue = "";
        $this->JABATAN->TooltipValue = "";

        // CURRENT_ADDRESS
        $this->CURRENT_ADDRESS->LinkCustomAttributes = "";
        $this->CURRENT_ADDRESS->HrefValue = "";
        $this->CURRENT_ADDRESS->TooltipValue = "";

        // CITY
        $this->CITY->LinkCustomAttributes = "";
        $this->CITY->HrefValue = "";
        $this->CITY->TooltipValue = "";

        // PHONE
        $this->PHONE->LinkCustomAttributes = "";
        $this->PHONE->HrefValue = "";
        $this->PHONE->TooltipValue = "";

        // FAX
        $this->FAX->LinkCustomAttributes = "";
        $this->FAX->HrefValue = "";
        $this->FAX->TooltipValue = "";

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

        // SIGN_ID
        $this->SIGN_ID->EditAttrs["class"] = "form-control";
        $this->SIGN_ID->EditCustomAttributes = "";
        $this->SIGN_ID->EditValue = $this->SIGN_ID->CurrentValue;
        $this->SIGN_ID->PlaceHolder = RemoveHtml($this->SIGN_ID->caption());

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

        // GELAR
        $this->GELAR->EditAttrs["class"] = "form-control";
        $this->GELAR->EditCustomAttributes = "";
        if (!$this->GELAR->Raw) {
            $this->GELAR->CurrentValue = HtmlDecode($this->GELAR->CurrentValue);
        }
        $this->GELAR->EditValue = $this->GELAR->CurrentValue;
        $this->GELAR->PlaceHolder = RemoveHtml($this->GELAR->caption());

        // JABATAN
        $this->JABATAN->EditAttrs["class"] = "form-control";
        $this->JABATAN->EditCustomAttributes = "";
        if (!$this->JABATAN->Raw) {
            $this->JABATAN->CurrentValue = HtmlDecode($this->JABATAN->CurrentValue);
        }
        $this->JABATAN->EditValue = $this->JABATAN->CurrentValue;
        $this->JABATAN->PlaceHolder = RemoveHtml($this->JABATAN->caption());

        // CURRENT_ADDRESS
        $this->CURRENT_ADDRESS->EditAttrs["class"] = "form-control";
        $this->CURRENT_ADDRESS->EditCustomAttributes = "";
        if (!$this->CURRENT_ADDRESS->Raw) {
            $this->CURRENT_ADDRESS->CurrentValue = HtmlDecode($this->CURRENT_ADDRESS->CurrentValue);
        }
        $this->CURRENT_ADDRESS->EditValue = $this->CURRENT_ADDRESS->CurrentValue;
        $this->CURRENT_ADDRESS->PlaceHolder = RemoveHtml($this->CURRENT_ADDRESS->caption());

        // CITY
        $this->CITY->EditAttrs["class"] = "form-control";
        $this->CITY->EditCustomAttributes = "";
        if (!$this->CITY->Raw) {
            $this->CITY->CurrentValue = HtmlDecode($this->CITY->CurrentValue);
        }
        $this->CITY->EditValue = $this->CITY->CurrentValue;
        $this->CITY->PlaceHolder = RemoveHtml($this->CITY->caption());

        // PHONE
        $this->PHONE->EditAttrs["class"] = "form-control";
        $this->PHONE->EditCustomAttributes = "";
        if (!$this->PHONE->Raw) {
            $this->PHONE->CurrentValue = HtmlDecode($this->PHONE->CurrentValue);
        }
        $this->PHONE->EditValue = $this->PHONE->CurrentValue;
        $this->PHONE->PlaceHolder = RemoveHtml($this->PHONE->caption());

        // FAX
        $this->FAX->EditAttrs["class"] = "form-control";
        $this->FAX->EditCustomAttributes = "";
        if (!$this->FAX->Raw) {
            $this->FAX->CurrentValue = HtmlDecode($this->FAX->CurrentValue);
        }
        $this->FAX->EditValue = $this->FAX->CurrentValue;
        $this->FAX->PlaceHolder = RemoveHtml($this->FAX->caption());

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
                    $doc->exportCaption($this->SIGN_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->GELAR);
                    $doc->exportCaption($this->JABATAN);
                    $doc->exportCaption($this->CURRENT_ADDRESS);
                    $doc->exportCaption($this->CITY);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->FAX);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->SIGN_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->FULLNAME);
                    $doc->exportCaption($this->GELAR);
                    $doc->exportCaption($this->JABATAN);
                    $doc->exportCaption($this->CURRENT_ADDRESS);
                    $doc->exportCaption($this->CITY);
                    $doc->exportCaption($this->PHONE);
                    $doc->exportCaption($this->FAX);
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
                        $doc->exportField($this->SIGN_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->GELAR);
                        $doc->exportField($this->JABATAN);
                        $doc->exportField($this->CURRENT_ADDRESS);
                        $doc->exportField($this->CITY);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->FAX);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->SIGN_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->FULLNAME);
                        $doc->exportField($this->GELAR);
                        $doc->exportField($this->JABATAN);
                        $doc->exportField($this->CURRENT_ADDRESS);
                        $doc->exportField($this->CITY);
                        $doc->exportField($this->PHONE);
                        $doc->exportField($this->FAX);
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
