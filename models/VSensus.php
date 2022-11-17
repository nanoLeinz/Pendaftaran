<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for V_SENSUS
 */
class VSensus extends DbTable
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
    public $VISIT_DATE;
    public $NO_REGISTRATION;
    public $CLINIC_ID;
    public $NAME_OF_CLINIC;
    public $GENDER;
    public $STATUS_PASIEN_ID;
    public $VISIT_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'V_SENSUS';
        $this->TableName = 'V_SENSUS';
        $this->TableType = 'CUSTOMVIEW';

        // Update Table
        $this->UpdateTable = "dbo.PASIEN_VISITATION INNER JOIN dbo.CLINIC ON dbo.PASIEN_VISITATION.CLINIC_ID = dbo.CLINIC.CLINIC_ID";
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

        // VISIT_DATE
        $this->VISIT_DATE = new DbField('V_SENSUS', 'V_SENSUS', 'x_VISIT_DATE', 'VISIT_DATE', 'Convert(VARCHAR,dbo.PASIEN_VISITATION.VISIT_DATE,111)', 'Convert(VARCHAR,dbo.PASIEN_VISITATION.VISIT_DATE,111)', 200, 30, 5, false, 'Convert(VARCHAR,dbo.PASIEN_VISITATION.VISIT_DATE,111)', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_DATE->Sortable = false; // Allow sort
        $this->VISIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
        $this->VISIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_DATE->Param, "CustomMsg");
        $this->Fields['VISIT_DATE'] = &$this->VISIT_DATE;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('V_SENSUS', 'V_SENSUS', 'x_NO_REGISTRATION', 'NO_REGISTRATION', 'dbo.PASIEN_VISITATION.NO_REGISTRATION', 'dbo.PASIEN_VISITATION.NO_REGISTRATION', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.NO_REGISTRATION', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->NO_REGISTRATION->IsPrimaryKey = true; // Primary key field
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = false; // Allow sort
        $this->NO_REGISTRATION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NO_REGISTRATION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('V_SENSUS', 'V_SENSUS', 'x_CLINIC_ID', 'CLINIC_ID', 'dbo.PASIEN_VISITATION.CLINIC_ID', 'dbo.PASIEN_VISITATION.CLINIC_ID', 200, 8, -1, false, 'dbo.PASIEN_VISITATION.CLINIC_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLINIC_ID->Sortable = false; // Allow sort
        $this->CLINIC_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLINIC_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // NAME_OF_CLINIC
        $this->NAME_OF_CLINIC = new DbField('V_SENSUS', 'V_SENSUS', 'x_NAME_OF_CLINIC', 'NAME_OF_CLINIC', 'dbo.CLINIC.NAME_OF_CLINIC', 'dbo.CLINIC.NAME_OF_CLINIC', 200, 100, -1, false, 'dbo.CLINIC.NAME_OF_CLINIC', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_OF_CLINIC->Sortable = false; // Allow sort
        $this->NAME_OF_CLINIC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_OF_CLINIC->Param, "CustomMsg");
        $this->Fields['NAME_OF_CLINIC'] = &$this->NAME_OF_CLINIC;

        // GENDER
        $this->GENDER = new DbField('V_SENSUS', 'V_SENSUS', 'x_GENDER', 'GENDER', 'dbo.PASIEN_VISITATION.GENDER', 'dbo.PASIEN_VISITATION.GENDER', 129, 1, -1, false, 'dbo.PASIEN_VISITATION.GENDER', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->GENDER->Sortable = false; // Allow sort
        $this->GENDER->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->GENDER->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->GENDER->Lookup = new Lookup('GENDER', 'SEX', false, 'GENDER', ["NAME_OF_GENDER","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->GENDER->Lookup = new Lookup('GENDER', 'SEX', false, 'GENDER', ["NAME_OF_GENDER","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->Fields['GENDER'] = &$this->GENDER;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('V_SENSUS', 'V_SENSUS', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', 'dbo.PASIEN_VISITATION.STATUS_PASIEN_ID', 'CAST(dbo.PASIEN_VISITATION.STATUS_PASIEN_ID AS NVARCHAR)', 17, 1, -1, false, 'dbo.PASIEN_VISITATION.STATUS_PASIEN_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->STATUS_PASIEN_ID->Sortable = false; // Allow sort
        $this->STATUS_PASIEN_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->STATUS_PASIEN_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->STATUS_PASIEN_ID->Lookup = new Lookup('STATUS_PASIEN_ID', 'STATUS_PASIEN', false, 'STATUS_PASIEN_ID', ["NAME_OF_STATUS_PASIEN","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->STATUS_PASIEN_ID->Lookup = new Lookup('STATUS_PASIEN_ID', 'STATUS_PASIEN', false, 'STATUS_PASIEN_ID', ["NAME_OF_STATUS_PASIEN","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // VISIT_ID
        $this->VISIT_ID = new DbField('V_SENSUS', 'V_SENSUS', 'x_VISIT_ID', 'VISIT_ID', 'dbo.PASIEN_VISITATION.VISIT_ID', 'dbo.PASIEN_VISITATION.VISIT_ID', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.VISIT_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = false; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "dbo.PASIEN_VISITATION INNER JOIN dbo.CLINIC ON dbo.PASIEN_VISITATION.CLINIC_ID = dbo.CLINIC.CLINIC_ID";
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
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("dbo.PASIEN_VISITATION.VISIT_ID, dbo.PASIEN_VISITATION.NO_REGISTRATION, dbo.PASIEN_VISITATION.CLINIC_ID, dbo.PASIEN_VISITATION.GENDER, dbo.PASIEN_VISITATION.STATUS_PASIEN_ID, dbo.CLINIC.NAME_OF_CLINIC, CONVERT(VARCHAR,dbo.PASIEN_VISITATION.VISIT_DATE,111) AS VISIT_DATE");
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
            if (array_key_exists('NO_REGISTRATION', $rs)) {
                AddFilter($where, QuotedName('NO_REGISTRATION', $this->Dbid) . '=' . QuotedValue($rs['NO_REGISTRATION'], $this->NO_REGISTRATION->DataType, $this->Dbid));
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
        $this->VISIT_DATE->DbValue = $row['VISIT_DATE'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->NAME_OF_CLINIC->DbValue = $row['NAME_OF_CLINIC'];
        $this->GENDER->DbValue = $row['GENDER'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "dbo.PASIEN_VISITATION.NO_REGISTRATION = '@NO_REGISTRATION@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->NO_REGISTRATION->CurrentValue : $this->NO_REGISTRATION->OldValue;
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
                $this->NO_REGISTRATION->CurrentValue = $keys[0];
            } else {
                $this->NO_REGISTRATION->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("VSensusList");
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
        if ($pageName == "VSensusView") {
            return $Language->phrase("View");
        } elseif ($pageName == "VSensusEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "VSensusAdd") {
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
                return "VSensusView";
            case Config("API_ADD_ACTION"):
                return "VSensusAdd";
            case Config("API_EDIT_ACTION"):
                return "VSensusEdit";
            case Config("API_DELETE_ACTION"):
                return "VSensusDelete";
            case Config("API_LIST_ACTION"):
                return "VSensusList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "VSensusList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("VSensusView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("VSensusView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "VSensusAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "VSensusAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("VSensusEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("VSensusAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("VSensusDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "NO_REGISTRATION:" . JsonEncode($this->NO_REGISTRATION->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NO_REGISTRATION->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NO_REGISTRATION->CurrentValue);
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
            if (($keyValue = Param("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
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
                $this->NO_REGISTRATION->CurrentValue = $key;
            } else {
                $this->NO_REGISTRATION->OldValue = $key;
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
        $this->VISIT_DATE->setDbValue($row['VISIT_DATE']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->NAME_OF_CLINIC->setDbValue($row['NAME_OF_CLINIC']);
        $this->GENDER->setDbValue($row['GENDER']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // VISIT_DATE
        $this->VISIT_DATE->CellCssStyle = "white-space: nowrap;";

        // NO_REGISTRATION

        // CLINIC_ID

        // NAME_OF_CLINIC

        // GENDER

        // STATUS_PASIEN_ID

        // VISIT_ID

        // VISIT_DATE
        $this->VISIT_DATE->ViewValue = $this->VISIT_DATE->CurrentValue;
        $this->VISIT_DATE->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $curVal = trim(strval($this->NO_REGISTRATION->CurrentValue));
        if ($curVal != "") {
            $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->lookupCacheOption($curVal);
            if ($this->NO_REGISTRATION->ViewValue === null) { // Lookup from database
                $filterWrk = "[NO_REGISTRATION]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->NO_REGISTRATION->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->NO_REGISTRATION->Lookup->renderViewRow($rswrk[0]);
                    $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->displayValue($arwrk);
                } else {
                    $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
                }
            }
        } else {
            $this->NO_REGISTRATION->ViewValue = null;
        }
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // CLINIC_ID
        $curVal = trim(strval($this->CLINIC_ID->CurrentValue));
        if ($curVal != "") {
            $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->lookupCacheOption($curVal);
            if ($this->CLINIC_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[CLINIC_ID]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->CLINIC_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CLINIC_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->displayValue($arwrk);
                } else {
                    $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
                }
            }
        } else {
            $this->CLINIC_ID->ViewValue = null;
        }
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // NAME_OF_CLINIC
        $this->NAME_OF_CLINIC->ViewValue = $this->NAME_OF_CLINIC->CurrentValue;
        $this->NAME_OF_CLINIC->ViewCustomAttributes = "";

        // GENDER
        $curVal = trim(strval($this->GENDER->CurrentValue));
        if ($curVal != "") {
            $this->GENDER->ViewValue = $this->GENDER->lookupCacheOption($curVal);
            if ($this->GENDER->ViewValue === null) { // Lookup from database
                $filterWrk = "[GENDER]" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->GENDER->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->GENDER->Lookup->renderViewRow($rswrk[0]);
                    $this->GENDER->ViewValue = $this->GENDER->displayValue($arwrk);
                } else {
                    $this->GENDER->ViewValue = $this->GENDER->CurrentValue;
                }
            }
        } else {
            $this->GENDER->ViewValue = null;
        }
        $this->GENDER->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $curVal = trim(strval($this->STATUS_PASIEN_ID->CurrentValue));
        if ($curVal != "") {
            $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->lookupCacheOption($curVal);
            if ($this->STATUS_PASIEN_ID->ViewValue === null) { // Lookup from database
                $filterWrk = "[STATUS_PASIEN_ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->STATUS_PASIEN_ID->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->STATUS_PASIEN_ID->Lookup->renderViewRow($rswrk[0]);
                    $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->displayValue($arwrk);
                } else {
                    $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
                }
            }
        } else {
            $this->STATUS_PASIEN_ID->ViewValue = null;
        }
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // VISIT_DATE
        $this->VISIT_DATE->LinkCustomAttributes = "";
        $this->VISIT_DATE->HrefValue = "";
        $this->VISIT_DATE->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // NAME_OF_CLINIC
        $this->NAME_OF_CLINIC->LinkCustomAttributes = "";
        $this->NAME_OF_CLINIC->HrefValue = "";
        $this->NAME_OF_CLINIC->TooltipValue = "";

        // GENDER
        $this->GENDER->LinkCustomAttributes = "";
        $this->GENDER->HrefValue = "";
        $this->GENDER->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

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

        // VISIT_DATE
        $this->VISIT_DATE->EditAttrs["class"] = "form-control";
        $this->VISIT_DATE->EditCustomAttributes = "";
        if (!$this->VISIT_DATE->Raw) {
            $this->VISIT_DATE->CurrentValue = HtmlDecode($this->VISIT_DATE->CurrentValue);
        }
        $this->VISIT_DATE->EditValue = $this->VISIT_DATE->CurrentValue;
        $this->VISIT_DATE->PlaceHolder = RemoveHtml($this->VISIT_DATE->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // NAME_OF_CLINIC
        $this->NAME_OF_CLINIC->EditAttrs["class"] = "form-control";
        $this->NAME_OF_CLINIC->EditCustomAttributes = "";
        if (!$this->NAME_OF_CLINIC->Raw) {
            $this->NAME_OF_CLINIC->CurrentValue = HtmlDecode($this->NAME_OF_CLINIC->CurrentValue);
        }
        $this->NAME_OF_CLINIC->EditValue = $this->NAME_OF_CLINIC->CurrentValue;
        $this->NAME_OF_CLINIC->PlaceHolder = RemoveHtml($this->NAME_OF_CLINIC->caption());

        // GENDER
        $this->GENDER->EditAttrs["class"] = "form-control";
        $this->GENDER->EditCustomAttributes = "";
        $this->GENDER->PlaceHolder = RemoveHtml($this->GENDER->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

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
                } else {
                    $doc->exportCaption($this->VISIT_DATE);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->NAME_OF_CLINIC);
                    $doc->exportCaption($this->GENDER);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->VISIT_ID);
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
                    } else {
                        $doc->exportField($this->VISIT_DATE);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->NAME_OF_CLINIC);
                        $doc->exportField($this->GENDER);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->VISIT_ID);
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
