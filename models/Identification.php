<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for IDENTIFICATION
 */
class Identification extends DbTable
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
    public $PASIEN_ID;
    public $NO_REGISTRATION;
    public $IDENTIFICATION_TYPE_ID;
    public $CARD_ID;
    public $EXPIRY_DATE;
    public $status_pasien_id;
    public $FAMILY_STATUS_ID;
    public $MAIN_CARD;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'IDENTIFICATION';
        $this->TableName = 'IDENTIFICATION';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[IDENTIFICATION]";
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
        $this->ORG_UNIT_CODE = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // PASIEN_ID
        $this->PASIEN_ID = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_PASIEN_ID', 'PASIEN_ID', '[PASIEN_ID]', '[PASIEN_ID]', 200, 25, -1, false, '[PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_ID->IsPrimaryKey = true; // Primary key field
        $this->PASIEN_ID->Nullable = false; // NOT NULL field
        $this->PASIEN_ID->Required = true; // Required field
        $this->PASIEN_ID->Sortable = true; // Allow sort
        $this->PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_ID->Param, "CustomMsg");
        $this->Fields['PASIEN_ID'] = &$this->PASIEN_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 25, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // IDENTIFICATION_TYPE_ID
        $this->IDENTIFICATION_TYPE_ID = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_IDENTIFICATION_TYPE_ID', 'IDENTIFICATION_TYPE_ID', '[IDENTIFICATION_TYPE_ID]', 'CAST([IDENTIFICATION_TYPE_ID] AS NVARCHAR)', 17, 1, -1, false, '[IDENTIFICATION_TYPE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IDENTIFICATION_TYPE_ID->Sortable = true; // Allow sort
        $this->IDENTIFICATION_TYPE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->IDENTIFICATION_TYPE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IDENTIFICATION_TYPE_ID->Param, "CustomMsg");
        $this->Fields['IDENTIFICATION_TYPE_ID'] = &$this->IDENTIFICATION_TYPE_ID;

        // CARD_ID
        $this->CARD_ID = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_CARD_ID', 'CARD_ID', '[CARD_ID]', '[CARD_ID]', 200, 50, -1, false, '[CARD_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CARD_ID->Sortable = true; // Allow sort
        $this->CARD_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CARD_ID->Param, "CustomMsg");
        $this->Fields['CARD_ID'] = &$this->CARD_ID;

        // EXPIRY_DATE
        $this->EXPIRY_DATE = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_EXPIRY_DATE', 'EXPIRY_DATE', '[EXPIRY_DATE]', CastDateFieldForLike("[EXPIRY_DATE]", 0, "DB"), 135, 8, 0, false, '[EXPIRY_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXPIRY_DATE->Sortable = true; // Allow sort
        $this->EXPIRY_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXPIRY_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXPIRY_DATE->Param, "CustomMsg");
        $this->Fields['EXPIRY_DATE'] = &$this->EXPIRY_DATE;

        // status_pasien_id
        $this->status_pasien_id = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_status_pasien_id', 'status_pasien_id', '[status_pasien_id]', 'CAST([status_pasien_id] AS NVARCHAR)', 2, 2, -1, false, '[status_pasien_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status_pasien_id->Sortable = true; // Allow sort
        $this->status_pasien_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status_pasien_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_pasien_id->Param, "CustomMsg");
        $this->Fields['status_pasien_id'] = &$this->status_pasien_id;

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_FAMILY_STATUS_ID', 'FAMILY_STATUS_ID', '[FAMILY_STATUS_ID]', 'CAST([FAMILY_STATUS_ID] AS NVARCHAR)', 17, 1, -1, false, '[FAMILY_STATUS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAMILY_STATUS_ID->Sortable = true; // Allow sort
        $this->FAMILY_STATUS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FAMILY_STATUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAMILY_STATUS_ID->Param, "CustomMsg");
        $this->Fields['FAMILY_STATUS_ID'] = &$this->FAMILY_STATUS_ID;

        // MAIN_CARD
        $this->MAIN_CARD = new DbField('IDENTIFICATION', 'IDENTIFICATION', 'x_MAIN_CARD', 'MAIN_CARD', '[MAIN_CARD]', '[MAIN_CARD]', 200, 50, -1, false, '[MAIN_CARD]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MAIN_CARD->Sortable = true; // Allow sort
        $this->MAIN_CARD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MAIN_CARD->Param, "CustomMsg");
        $this->Fields['MAIN_CARD'] = &$this->MAIN_CARD;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[IDENTIFICATION]";
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
            if (array_key_exists('PASIEN_ID', $rs)) {
                AddFilter($where, QuotedName('PASIEN_ID', $this->Dbid) . '=' . QuotedValue($rs['PASIEN_ID'], $this->PASIEN_ID->DataType, $this->Dbid));
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
        $this->PASIEN_ID->DbValue = $row['PASIEN_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->IDENTIFICATION_TYPE_ID->DbValue = $row['IDENTIFICATION_TYPE_ID'];
        $this->CARD_ID->DbValue = $row['CARD_ID'];
        $this->EXPIRY_DATE->DbValue = $row['EXPIRY_DATE'];
        $this->status_pasien_id->DbValue = $row['status_pasien_id'];
        $this->FAMILY_STATUS_ID->DbValue = $row['FAMILY_STATUS_ID'];
        $this->MAIN_CARD->DbValue = $row['MAIN_CARD'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [PASIEN_ID] = '@PASIEN_ID@'";
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
        $val = $current ? $this->PASIEN_ID->CurrentValue : $this->PASIEN_ID->OldValue;
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
                $this->PASIEN_ID->CurrentValue = $keys[1];
            } else {
                $this->PASIEN_ID->OldValue = $keys[1];
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
            $val = array_key_exists('PASIEN_ID', $row) ? $row['PASIEN_ID'] : null;
        } else {
            $val = $this->PASIEN_ID->OldValue !== null ? $this->PASIEN_ID->OldValue : $this->PASIEN_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@PASIEN_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("IdentificationList");
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
        if ($pageName == "IdentificationView") {
            return $Language->phrase("View");
        } elseif ($pageName == "IdentificationEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "IdentificationAdd") {
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
                return "IdentificationView";
            case Config("API_ADD_ACTION"):
                return "IdentificationAdd";
            case Config("API_EDIT_ACTION"):
                return "IdentificationEdit";
            case Config("API_DELETE_ACTION"):
                return "IdentificationDelete";
            case Config("API_LIST_ACTION"):
                return "IdentificationList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "IdentificationList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("IdentificationView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("IdentificationView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "IdentificationAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "IdentificationAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("IdentificationEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("IdentificationAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("IdentificationDelete", $this->getUrlParm());
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
        $json .= ",PASIEN_ID:" . JsonEncode($this->PASIEN_ID->CurrentValue, "string");
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
        if ($this->PASIEN_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->PASIEN_ID->CurrentValue);
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
            if (($keyValue = Param("PASIEN_ID") ?? Route("PASIEN_ID")) !== null) {
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
                $this->PASIEN_ID->CurrentValue = $key[1];
            } else {
                $this->PASIEN_ID->OldValue = $key[1];
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
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->IDENTIFICATION_TYPE_ID->setDbValue($row['IDENTIFICATION_TYPE_ID']);
        $this->CARD_ID->setDbValue($row['CARD_ID']);
        $this->EXPIRY_DATE->setDbValue($row['EXPIRY_DATE']);
        $this->status_pasien_id->setDbValue($row['status_pasien_id']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->MAIN_CARD->setDbValue($row['MAIN_CARD']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // PASIEN_ID

        // NO_REGISTRATION

        // IDENTIFICATION_TYPE_ID

        // CARD_ID

        // EXPIRY_DATE

        // status_pasien_id

        // FAMILY_STATUS_ID

        // MAIN_CARD

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // PASIEN_ID
        $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // IDENTIFICATION_TYPE_ID
        $this->IDENTIFICATION_TYPE_ID->ViewValue = $this->IDENTIFICATION_TYPE_ID->CurrentValue;
        $this->IDENTIFICATION_TYPE_ID->ViewValue = FormatNumber($this->IDENTIFICATION_TYPE_ID->ViewValue, 0, -2, -2, -2);
        $this->IDENTIFICATION_TYPE_ID->ViewCustomAttributes = "";

        // CARD_ID
        $this->CARD_ID->ViewValue = $this->CARD_ID->CurrentValue;
        $this->CARD_ID->ViewCustomAttributes = "";

        // EXPIRY_DATE
        $this->EXPIRY_DATE->ViewValue = $this->EXPIRY_DATE->CurrentValue;
        $this->EXPIRY_DATE->ViewValue = FormatDateTime($this->EXPIRY_DATE->ViewValue, 0);
        $this->EXPIRY_DATE->ViewCustomAttributes = "";

        // status_pasien_id
        $this->status_pasien_id->ViewValue = $this->status_pasien_id->CurrentValue;
        $this->status_pasien_id->ViewValue = FormatNumber($this->status_pasien_id->ViewValue, 0, -2, -2, -2);
        $this->status_pasien_id->ViewCustomAttributes = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
        $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

        // MAIN_CARD
        $this->MAIN_CARD->ViewValue = $this->MAIN_CARD->CurrentValue;
        $this->MAIN_CARD->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // PASIEN_ID
        $this->PASIEN_ID->LinkCustomAttributes = "";
        $this->PASIEN_ID->HrefValue = "";
        $this->PASIEN_ID->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // IDENTIFICATION_TYPE_ID
        $this->IDENTIFICATION_TYPE_ID->LinkCustomAttributes = "";
        $this->IDENTIFICATION_TYPE_ID->HrefValue = "";
        $this->IDENTIFICATION_TYPE_ID->TooltipValue = "";

        // CARD_ID
        $this->CARD_ID->LinkCustomAttributes = "";
        $this->CARD_ID->HrefValue = "";
        $this->CARD_ID->TooltipValue = "";

        // EXPIRY_DATE
        $this->EXPIRY_DATE->LinkCustomAttributes = "";
        $this->EXPIRY_DATE->HrefValue = "";
        $this->EXPIRY_DATE->TooltipValue = "";

        // status_pasien_id
        $this->status_pasien_id->LinkCustomAttributes = "";
        $this->status_pasien_id->HrefValue = "";
        $this->status_pasien_id->TooltipValue = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
        $this->FAMILY_STATUS_ID->HrefValue = "";
        $this->FAMILY_STATUS_ID->TooltipValue = "";

        // MAIN_CARD
        $this->MAIN_CARD->LinkCustomAttributes = "";
        $this->MAIN_CARD->HrefValue = "";
        $this->MAIN_CARD->TooltipValue = "";

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

        // PASIEN_ID
        $this->PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->PASIEN_ID->EditCustomAttributes = "";
        if (!$this->PASIEN_ID->Raw) {
            $this->PASIEN_ID->CurrentValue = HtmlDecode($this->PASIEN_ID->CurrentValue);
        }
        $this->PASIEN_ID->EditValue = $this->PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // IDENTIFICATION_TYPE_ID
        $this->IDENTIFICATION_TYPE_ID->EditAttrs["class"] = "form-control";
        $this->IDENTIFICATION_TYPE_ID->EditCustomAttributes = "";
        $this->IDENTIFICATION_TYPE_ID->EditValue = $this->IDENTIFICATION_TYPE_ID->CurrentValue;
        $this->IDENTIFICATION_TYPE_ID->PlaceHolder = RemoveHtml($this->IDENTIFICATION_TYPE_ID->caption());

        // CARD_ID
        $this->CARD_ID->EditAttrs["class"] = "form-control";
        $this->CARD_ID->EditCustomAttributes = "";
        if (!$this->CARD_ID->Raw) {
            $this->CARD_ID->CurrentValue = HtmlDecode($this->CARD_ID->CurrentValue);
        }
        $this->CARD_ID->EditValue = $this->CARD_ID->CurrentValue;
        $this->CARD_ID->PlaceHolder = RemoveHtml($this->CARD_ID->caption());

        // EXPIRY_DATE
        $this->EXPIRY_DATE->EditAttrs["class"] = "form-control";
        $this->EXPIRY_DATE->EditCustomAttributes = "";
        $this->EXPIRY_DATE->EditValue = FormatDateTime($this->EXPIRY_DATE->CurrentValue, 8);
        $this->EXPIRY_DATE->PlaceHolder = RemoveHtml($this->EXPIRY_DATE->caption());

        // status_pasien_id
        $this->status_pasien_id->EditAttrs["class"] = "form-control";
        $this->status_pasien_id->EditCustomAttributes = "";
        $this->status_pasien_id->EditValue = $this->status_pasien_id->CurrentValue;
        $this->status_pasien_id->PlaceHolder = RemoveHtml($this->status_pasien_id->caption());

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->EditAttrs["class"] = "form-control";
        $this->FAMILY_STATUS_ID->EditCustomAttributes = "";
        $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->PlaceHolder = RemoveHtml($this->FAMILY_STATUS_ID->caption());

        // MAIN_CARD
        $this->MAIN_CARD->EditAttrs["class"] = "form-control";
        $this->MAIN_CARD->EditCustomAttributes = "";
        if (!$this->MAIN_CARD->Raw) {
            $this->MAIN_CARD->CurrentValue = HtmlDecode($this->MAIN_CARD->CurrentValue);
        }
        $this->MAIN_CARD->EditValue = $this->MAIN_CARD->CurrentValue;
        $this->MAIN_CARD->PlaceHolder = RemoveHtml($this->MAIN_CARD->caption());

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
                    $doc->exportCaption($this->PASIEN_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->IDENTIFICATION_TYPE_ID);
                    $doc->exportCaption($this->CARD_ID);
                    $doc->exportCaption($this->EXPIRY_DATE);
                    $doc->exportCaption($this->status_pasien_id);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->MAIN_CARD);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->PASIEN_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->IDENTIFICATION_TYPE_ID);
                    $doc->exportCaption($this->CARD_ID);
                    $doc->exportCaption($this->EXPIRY_DATE);
                    $doc->exportCaption($this->status_pasien_id);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->MAIN_CARD);
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
                        $doc->exportField($this->PASIEN_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->IDENTIFICATION_TYPE_ID);
                        $doc->exportField($this->CARD_ID);
                        $doc->exportField($this->EXPIRY_DATE);
                        $doc->exportField($this->status_pasien_id);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->MAIN_CARD);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->PASIEN_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->IDENTIFICATION_TYPE_ID);
                        $doc->exportField($this->CARD_ID);
                        $doc->exportField($this->EXPIRY_DATE);
                        $doc->exportField($this->status_pasien_id);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->MAIN_CARD);
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
