<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for COMPANY
 */
class Company extends DbTable
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
    public $COMPANY_ID;
    public $COMPANY_NAME;
    public $OBJECT_CATEGORY_ID;
    public $NPWP;
    public $OWNER;
    public $COMP_ADDRESS;
    public $PHONE1;
    public $FAX;
    public $COMP_ADDRESS2;
    public $PHONE2;
    public $MOBILE;
    public $FAX2;
    public $E_MAIL;
    public $WEBSITE;
    public $company_type;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'COMPANY';
        $this->TableName = 'COMPANY';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[COMPANY]";
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

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('COMPANY', 'COMPANY', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->IsPrimaryKey = true; // Primary key field
        $this->COMPANY_ID->Nullable = false; // NOT NULL field
        $this->COMPANY_ID->Required = true; // Required field
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // COMPANY_NAME
        $this->COMPANY_NAME = new DbField('COMPANY', 'COMPANY', 'x_COMPANY_NAME', 'COMPANY_NAME', '[COMPANY_NAME]', '[COMPANY_NAME]', 200, 200, -1, false, '[COMPANY_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_NAME->Sortable = true; // Allow sort
        $this->COMPANY_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_NAME->Param, "CustomMsg");
        $this->Fields['COMPANY_NAME'] = &$this->COMPANY_NAME;

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID = new DbField('COMPANY', 'COMPANY', 'x_OBJECT_CATEGORY_ID', 'OBJECT_CATEGORY_ID', '[OBJECT_CATEGORY_ID]', 'CAST([OBJECT_CATEGORY_ID] AS NVARCHAR)', 17, 1, -1, false, '[OBJECT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->OBJECT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->OBJECT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['OBJECT_CATEGORY_ID'] = &$this->OBJECT_CATEGORY_ID;

        // NPWP
        $this->NPWP = new DbField('COMPANY', 'COMPANY', 'x_NPWP', 'NPWP', '[NPWP]', '[NPWP]', 200, 50, -1, false, '[NPWP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPWP->Sortable = true; // Allow sort
        $this->NPWP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPWP->Param, "CustomMsg");
        $this->Fields['NPWP'] = &$this->NPWP;

        // OWNER
        $this->OWNER = new DbField('COMPANY', 'COMPANY', 'x_OWNER', 'OWNER', '[OWNER]', '[OWNER]', 200, 200, -1, false, '[OWNER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OWNER->Sortable = true; // Allow sort
        $this->OWNER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OWNER->Param, "CustomMsg");
        $this->Fields['OWNER'] = &$this->OWNER;

        // COMP_ADDRESS
        $this->COMP_ADDRESS = new DbField('COMPANY', 'COMPANY', 'x_COMP_ADDRESS', 'COMP_ADDRESS', '[COMP_ADDRESS]', '[COMP_ADDRESS]', 200, 200, -1, false, '[COMP_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMP_ADDRESS->Sortable = true; // Allow sort
        $this->COMP_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMP_ADDRESS->Param, "CustomMsg");
        $this->Fields['COMP_ADDRESS'] = &$this->COMP_ADDRESS;

        // PHONE1
        $this->PHONE1 = new DbField('COMPANY', 'COMPANY', 'x_PHONE1', 'PHONE1', '[PHONE1]', '[PHONE1]', 200, 100, -1, false, '[PHONE1]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE1->Sortable = true; // Allow sort
        $this->PHONE1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE1->Param, "CustomMsg");
        $this->Fields['PHONE1'] = &$this->PHONE1;

        // FAX
        $this->FAX = new DbField('COMPANY', 'COMPANY', 'x_FAX', 'FAX', '[FAX]', '[FAX]', 200, 100, -1, false, '[FAX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX->Sortable = true; // Allow sort
        $this->FAX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX->Param, "CustomMsg");
        $this->Fields['FAX'] = &$this->FAX;

        // COMP_ADDRESS2
        $this->COMP_ADDRESS2 = new DbField('COMPANY', 'COMPANY', 'x_COMP_ADDRESS2', 'COMP_ADDRESS2', '[COMP_ADDRESS2]', '[COMP_ADDRESS2]', 200, 200, -1, false, '[COMP_ADDRESS2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMP_ADDRESS2->Sortable = true; // Allow sort
        $this->COMP_ADDRESS2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMP_ADDRESS2->Param, "CustomMsg");
        $this->Fields['COMP_ADDRESS2'] = &$this->COMP_ADDRESS2;

        // PHONE2
        $this->PHONE2 = new DbField('COMPANY', 'COMPANY', 'x_PHONE2', 'PHONE2', '[PHONE2]', '[PHONE2]', 200, 100, -1, false, '[PHONE2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE2->Sortable = true; // Allow sort
        $this->PHONE2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE2->Param, "CustomMsg");
        $this->Fields['PHONE2'] = &$this->PHONE2;

        // MOBILE
        $this->MOBILE = new DbField('COMPANY', 'COMPANY', 'x_MOBILE', 'MOBILE', '[MOBILE]', '[MOBILE]', 200, 50, -1, false, '[MOBILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MOBILE->Sortable = true; // Allow sort
        $this->MOBILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MOBILE->Param, "CustomMsg");
        $this->Fields['MOBILE'] = &$this->MOBILE;

        // FAX2
        $this->FAX2 = new DbField('COMPANY', 'COMPANY', 'x_FAX2', 'FAX2', '[FAX2]', '[FAX2]', 200, 200, -1, false, '[FAX2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX2->Sortable = true; // Allow sort
        $this->FAX2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX2->Param, "CustomMsg");
        $this->Fields['FAX2'] = &$this->FAX2;

        // E_MAIL
        $this->E_MAIL = new DbField('COMPANY', 'COMPANY', 'x_E_MAIL', 'E_MAIL', '[E_MAIL]', '[E_MAIL]', 200, 200, -1, false, '[E_MAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->E_MAIL->Sortable = true; // Allow sort
        $this->E_MAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->E_MAIL->Param, "CustomMsg");
        $this->Fields['E_MAIL'] = &$this->E_MAIL;

        // WEBSITE
        $this->WEBSITE = new DbField('COMPANY', 'COMPANY', 'x_WEBSITE', 'WEBSITE', '[WEBSITE]', '[WEBSITE]', 200, 200, -1, false, '[WEBSITE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WEBSITE->Sortable = true; // Allow sort
        $this->WEBSITE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WEBSITE->Param, "CustomMsg");
        $this->Fields['WEBSITE'] = &$this->WEBSITE;

        // company_type
        $this->company_type = new DbField('COMPANY', 'COMPANY', 'x_company_type', 'company_type', '[company_type]', 'CAST([company_type] AS NVARCHAR)', 17, 1, -1, false, '[company_type]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->company_type->Sortable = true; // Allow sort
        $this->company_type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->company_type->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->company_type->Param, "CustomMsg");
        $this->Fields['company_type'] = &$this->company_type;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[COMPANY]";
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
            if (array_key_exists('COMPANY_ID', $rs)) {
                AddFilter($where, QuotedName('COMPANY_ID', $this->Dbid) . '=' . QuotedValue($rs['COMPANY_ID'], $this->COMPANY_ID->DataType, $this->Dbid));
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
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->COMPANY_NAME->DbValue = $row['COMPANY_NAME'];
        $this->OBJECT_CATEGORY_ID->DbValue = $row['OBJECT_CATEGORY_ID'];
        $this->NPWP->DbValue = $row['NPWP'];
        $this->OWNER->DbValue = $row['OWNER'];
        $this->COMP_ADDRESS->DbValue = $row['COMP_ADDRESS'];
        $this->PHONE1->DbValue = $row['PHONE1'];
        $this->FAX->DbValue = $row['FAX'];
        $this->COMP_ADDRESS2->DbValue = $row['COMP_ADDRESS2'];
        $this->PHONE2->DbValue = $row['PHONE2'];
        $this->MOBILE->DbValue = $row['MOBILE'];
        $this->FAX2->DbValue = $row['FAX2'];
        $this->E_MAIL->DbValue = $row['E_MAIL'];
        $this->WEBSITE->DbValue = $row['WEBSITE'];
        $this->company_type->DbValue = $row['company_type'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[COMPANY_ID] = '@COMPANY_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->COMPANY_ID->CurrentValue : $this->COMPANY_ID->OldValue;
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
                $this->COMPANY_ID->CurrentValue = $keys[0];
            } else {
                $this->COMPANY_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('COMPANY_ID', $row) ? $row['COMPANY_ID'] : null;
        } else {
            $val = $this->COMPANY_ID->OldValue !== null ? $this->COMPANY_ID->OldValue : $this->COMPANY_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@COMPANY_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("CompanyList");
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
        if ($pageName == "CompanyView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CompanyEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CompanyAdd") {
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
                return "CompanyView";
            case Config("API_ADD_ACTION"):
                return "CompanyAdd";
            case Config("API_EDIT_ACTION"):
                return "CompanyEdit";
            case Config("API_DELETE_ACTION"):
                return "CompanyDelete";
            case Config("API_LIST_ACTION"):
                return "CompanyList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CompanyList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CompanyView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CompanyView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CompanyAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CompanyAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CompanyEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CompanyAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CompanyDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "COMPANY_ID:" . JsonEncode($this->COMPANY_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->COMPANY_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->COMPANY_ID->CurrentValue);
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
            if (($keyValue = Param("COMPANY_ID") ?? Route("COMPANY_ID")) !== null) {
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
                $this->COMPANY_ID->CurrentValue = $key;
            } else {
                $this->COMPANY_ID->OldValue = $key;
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
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->COMPANY_NAME->setDbValue($row['COMPANY_NAME']);
        $this->OBJECT_CATEGORY_ID->setDbValue($row['OBJECT_CATEGORY_ID']);
        $this->NPWP->setDbValue($row['NPWP']);
        $this->OWNER->setDbValue($row['OWNER']);
        $this->COMP_ADDRESS->setDbValue($row['COMP_ADDRESS']);
        $this->PHONE1->setDbValue($row['PHONE1']);
        $this->FAX->setDbValue($row['FAX']);
        $this->COMP_ADDRESS2->setDbValue($row['COMP_ADDRESS2']);
        $this->PHONE2->setDbValue($row['PHONE2']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->FAX2->setDbValue($row['FAX2']);
        $this->E_MAIL->setDbValue($row['E_MAIL']);
        $this->WEBSITE->setDbValue($row['WEBSITE']);
        $this->company_type->setDbValue($row['company_type']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // COMPANY_ID

        // COMPANY_NAME

        // OBJECT_CATEGORY_ID

        // NPWP

        // OWNER

        // COMP_ADDRESS

        // PHONE1

        // FAX

        // COMP_ADDRESS2

        // PHONE2

        // MOBILE

        // FAX2

        // E_MAIL

        // WEBSITE

        // company_type

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // COMPANY_NAME
        $this->COMPANY_NAME->ViewValue = $this->COMPANY_NAME->CurrentValue;
        $this->COMPANY_NAME->ViewCustomAttributes = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->ViewValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->ViewValue = FormatNumber($this->OBJECT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
        $this->OBJECT_CATEGORY_ID->ViewCustomAttributes = "";

        // NPWP
        $this->NPWP->ViewValue = $this->NPWP->CurrentValue;
        $this->NPWP->ViewCustomAttributes = "";

        // OWNER
        $this->OWNER->ViewValue = $this->OWNER->CurrentValue;
        $this->OWNER->ViewCustomAttributes = "";

        // COMP_ADDRESS
        $this->COMP_ADDRESS->ViewValue = $this->COMP_ADDRESS->CurrentValue;
        $this->COMP_ADDRESS->ViewCustomAttributes = "";

        // PHONE1
        $this->PHONE1->ViewValue = $this->PHONE1->CurrentValue;
        $this->PHONE1->ViewCustomAttributes = "";

        // FAX
        $this->FAX->ViewValue = $this->FAX->CurrentValue;
        $this->FAX->ViewCustomAttributes = "";

        // COMP_ADDRESS2
        $this->COMP_ADDRESS2->ViewValue = $this->COMP_ADDRESS2->CurrentValue;
        $this->COMP_ADDRESS2->ViewCustomAttributes = "";

        // PHONE2
        $this->PHONE2->ViewValue = $this->PHONE2->CurrentValue;
        $this->PHONE2->ViewCustomAttributes = "";

        // MOBILE
        $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->ViewCustomAttributes = "";

        // FAX2
        $this->FAX2->ViewValue = $this->FAX2->CurrentValue;
        $this->FAX2->ViewCustomAttributes = "";

        // E_MAIL
        $this->E_MAIL->ViewValue = $this->E_MAIL->CurrentValue;
        $this->E_MAIL->ViewCustomAttributes = "";

        // WEBSITE
        $this->WEBSITE->ViewValue = $this->WEBSITE->CurrentValue;
        $this->WEBSITE->ViewCustomAttributes = "";

        // company_type
        $this->company_type->ViewValue = $this->company_type->CurrentValue;
        $this->company_type->ViewValue = FormatNumber($this->company_type->ViewValue, 0, -2, -2, -2);
        $this->company_type->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // COMPANY_NAME
        $this->COMPANY_NAME->LinkCustomAttributes = "";
        $this->COMPANY_NAME->HrefValue = "";
        $this->COMPANY_NAME->TooltipValue = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->HrefValue = "";
        $this->OBJECT_CATEGORY_ID->TooltipValue = "";

        // NPWP
        $this->NPWP->LinkCustomAttributes = "";
        $this->NPWP->HrefValue = "";
        $this->NPWP->TooltipValue = "";

        // OWNER
        $this->OWNER->LinkCustomAttributes = "";
        $this->OWNER->HrefValue = "";
        $this->OWNER->TooltipValue = "";

        // COMP_ADDRESS
        $this->COMP_ADDRESS->LinkCustomAttributes = "";
        $this->COMP_ADDRESS->HrefValue = "";
        $this->COMP_ADDRESS->TooltipValue = "";

        // PHONE1
        $this->PHONE1->LinkCustomAttributes = "";
        $this->PHONE1->HrefValue = "";
        $this->PHONE1->TooltipValue = "";

        // FAX
        $this->FAX->LinkCustomAttributes = "";
        $this->FAX->HrefValue = "";
        $this->FAX->TooltipValue = "";

        // COMP_ADDRESS2
        $this->COMP_ADDRESS2->LinkCustomAttributes = "";
        $this->COMP_ADDRESS2->HrefValue = "";
        $this->COMP_ADDRESS2->TooltipValue = "";

        // PHONE2
        $this->PHONE2->LinkCustomAttributes = "";
        $this->PHONE2->HrefValue = "";
        $this->PHONE2->TooltipValue = "";

        // MOBILE
        $this->MOBILE->LinkCustomAttributes = "";
        $this->MOBILE->HrefValue = "";
        $this->MOBILE->TooltipValue = "";

        // FAX2
        $this->FAX2->LinkCustomAttributes = "";
        $this->FAX2->HrefValue = "";
        $this->FAX2->TooltipValue = "";

        // E_MAIL
        $this->E_MAIL->LinkCustomAttributes = "";
        $this->E_MAIL->HrefValue = "";
        $this->E_MAIL->TooltipValue = "";

        // WEBSITE
        $this->WEBSITE->LinkCustomAttributes = "";
        $this->WEBSITE->HrefValue = "";
        $this->WEBSITE->TooltipValue = "";

        // company_type
        $this->company_type->LinkCustomAttributes = "";
        $this->company_type->HrefValue = "";
        $this->company_type->TooltipValue = "";

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

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // COMPANY_NAME
        $this->COMPANY_NAME->EditAttrs["class"] = "form-control";
        $this->COMPANY_NAME->EditCustomAttributes = "";
        if (!$this->COMPANY_NAME->Raw) {
            $this->COMPANY_NAME->CurrentValue = HtmlDecode($this->COMPANY_NAME->CurrentValue);
        }
        $this->COMPANY_NAME->EditValue = $this->COMPANY_NAME->CurrentValue;
        $this->COMPANY_NAME->PlaceHolder = RemoveHtml($this->COMPANY_NAME->caption());

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->OBJECT_CATEGORY_ID->EditCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->EditValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->OBJECT_CATEGORY_ID->caption());

        // NPWP
        $this->NPWP->EditAttrs["class"] = "form-control";
        $this->NPWP->EditCustomAttributes = "";
        if (!$this->NPWP->Raw) {
            $this->NPWP->CurrentValue = HtmlDecode($this->NPWP->CurrentValue);
        }
        $this->NPWP->EditValue = $this->NPWP->CurrentValue;
        $this->NPWP->PlaceHolder = RemoveHtml($this->NPWP->caption());

        // OWNER
        $this->OWNER->EditAttrs["class"] = "form-control";
        $this->OWNER->EditCustomAttributes = "";
        if (!$this->OWNER->Raw) {
            $this->OWNER->CurrentValue = HtmlDecode($this->OWNER->CurrentValue);
        }
        $this->OWNER->EditValue = $this->OWNER->CurrentValue;
        $this->OWNER->PlaceHolder = RemoveHtml($this->OWNER->caption());

        // COMP_ADDRESS
        $this->COMP_ADDRESS->EditAttrs["class"] = "form-control";
        $this->COMP_ADDRESS->EditCustomAttributes = "";
        if (!$this->COMP_ADDRESS->Raw) {
            $this->COMP_ADDRESS->CurrentValue = HtmlDecode($this->COMP_ADDRESS->CurrentValue);
        }
        $this->COMP_ADDRESS->EditValue = $this->COMP_ADDRESS->CurrentValue;
        $this->COMP_ADDRESS->PlaceHolder = RemoveHtml($this->COMP_ADDRESS->caption());

        // PHONE1
        $this->PHONE1->EditAttrs["class"] = "form-control";
        $this->PHONE1->EditCustomAttributes = "";
        if (!$this->PHONE1->Raw) {
            $this->PHONE1->CurrentValue = HtmlDecode($this->PHONE1->CurrentValue);
        }
        $this->PHONE1->EditValue = $this->PHONE1->CurrentValue;
        $this->PHONE1->PlaceHolder = RemoveHtml($this->PHONE1->caption());

        // FAX
        $this->FAX->EditAttrs["class"] = "form-control";
        $this->FAX->EditCustomAttributes = "";
        if (!$this->FAX->Raw) {
            $this->FAX->CurrentValue = HtmlDecode($this->FAX->CurrentValue);
        }
        $this->FAX->EditValue = $this->FAX->CurrentValue;
        $this->FAX->PlaceHolder = RemoveHtml($this->FAX->caption());

        // COMP_ADDRESS2
        $this->COMP_ADDRESS2->EditAttrs["class"] = "form-control";
        $this->COMP_ADDRESS2->EditCustomAttributes = "";
        if (!$this->COMP_ADDRESS2->Raw) {
            $this->COMP_ADDRESS2->CurrentValue = HtmlDecode($this->COMP_ADDRESS2->CurrentValue);
        }
        $this->COMP_ADDRESS2->EditValue = $this->COMP_ADDRESS2->CurrentValue;
        $this->COMP_ADDRESS2->PlaceHolder = RemoveHtml($this->COMP_ADDRESS2->caption());

        // PHONE2
        $this->PHONE2->EditAttrs["class"] = "form-control";
        $this->PHONE2->EditCustomAttributes = "";
        if (!$this->PHONE2->Raw) {
            $this->PHONE2->CurrentValue = HtmlDecode($this->PHONE2->CurrentValue);
        }
        $this->PHONE2->EditValue = $this->PHONE2->CurrentValue;
        $this->PHONE2->PlaceHolder = RemoveHtml($this->PHONE2->caption());

        // MOBILE
        $this->MOBILE->EditAttrs["class"] = "form-control";
        $this->MOBILE->EditCustomAttributes = "";
        if (!$this->MOBILE->Raw) {
            $this->MOBILE->CurrentValue = HtmlDecode($this->MOBILE->CurrentValue);
        }
        $this->MOBILE->EditValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->PlaceHolder = RemoveHtml($this->MOBILE->caption());

        // FAX2
        $this->FAX2->EditAttrs["class"] = "form-control";
        $this->FAX2->EditCustomAttributes = "";
        if (!$this->FAX2->Raw) {
            $this->FAX2->CurrentValue = HtmlDecode($this->FAX2->CurrentValue);
        }
        $this->FAX2->EditValue = $this->FAX2->CurrentValue;
        $this->FAX2->PlaceHolder = RemoveHtml($this->FAX2->caption());

        // E_MAIL
        $this->E_MAIL->EditAttrs["class"] = "form-control";
        $this->E_MAIL->EditCustomAttributes = "";
        if (!$this->E_MAIL->Raw) {
            $this->E_MAIL->CurrentValue = HtmlDecode($this->E_MAIL->CurrentValue);
        }
        $this->E_MAIL->EditValue = $this->E_MAIL->CurrentValue;
        $this->E_MAIL->PlaceHolder = RemoveHtml($this->E_MAIL->caption());

        // WEBSITE
        $this->WEBSITE->EditAttrs["class"] = "form-control";
        $this->WEBSITE->EditCustomAttributes = "";
        if (!$this->WEBSITE->Raw) {
            $this->WEBSITE->CurrentValue = HtmlDecode($this->WEBSITE->CurrentValue);
        }
        $this->WEBSITE->EditValue = $this->WEBSITE->CurrentValue;
        $this->WEBSITE->PlaceHolder = RemoveHtml($this->WEBSITE->caption());

        // company_type
        $this->company_type->EditAttrs["class"] = "form-control";
        $this->company_type->EditCustomAttributes = "";
        $this->company_type->EditValue = $this->company_type->CurrentValue;
        $this->company_type->PlaceHolder = RemoveHtml($this->company_type->caption());

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
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY_NAME);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->OWNER);
                    $doc->exportCaption($this->COMP_ADDRESS);
                    $doc->exportCaption($this->PHONE1);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->COMP_ADDRESS2);
                    $doc->exportCaption($this->PHONE2);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->FAX2);
                    $doc->exportCaption($this->E_MAIL);
                    $doc->exportCaption($this->WEBSITE);
                    $doc->exportCaption($this->company_type);
                } else {
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY_NAME);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->OWNER);
                    $doc->exportCaption($this->COMP_ADDRESS);
                    $doc->exportCaption($this->PHONE1);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->COMP_ADDRESS2);
                    $doc->exportCaption($this->PHONE2);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->FAX2);
                    $doc->exportCaption($this->E_MAIL);
                    $doc->exportCaption($this->WEBSITE);
                    $doc->exportCaption($this->company_type);
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
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY_NAME);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->OWNER);
                        $doc->exportField($this->COMP_ADDRESS);
                        $doc->exportField($this->PHONE1);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->COMP_ADDRESS2);
                        $doc->exportField($this->PHONE2);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->FAX2);
                        $doc->exportField($this->E_MAIL);
                        $doc->exportField($this->WEBSITE);
                        $doc->exportField($this->company_type);
                    } else {
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY_NAME);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->OWNER);
                        $doc->exportField($this->COMP_ADDRESS);
                        $doc->exportField($this->PHONE1);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->COMP_ADDRESS2);
                        $doc->exportField($this->PHONE2);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->FAX2);
                        $doc->exportField($this->E_MAIL);
                        $doc->exportField($this->WEBSITE);
                        $doc->exportField($this->company_type);
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
