<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for MessageOut
 */
class MessageOut extends DbTable
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
    public $Id;
    public $MessageTo;
    public $MessageFrom;
    public $MessageText;
    public $MessageType;
    public $Gateway;
    public $_UserId;
    public $UserInfo;
    public $Priority;
    public $Scheduled;
    public $IsRead;
    public $IsSent;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'MessageOut';
        $this->TableName = 'MessageOut';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[MessageOut]";
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

        // Id
        $this->Id = new DbField('MessageOut', 'MessageOut', 'x_Id', 'Id', '[Id]', 'CAST([Id] AS NVARCHAR)', 3, 4, -1, false, '[Id]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->Id->IsAutoIncrement = true; // Autoincrement field
        $this->Id->IsPrimaryKey = true; // Primary key field
        $this->Id->Nullable = false; // NOT NULL field
        $this->Id->Sortable = true; // Allow sort
        $this->Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Id->Param, "CustomMsg");
        $this->Fields['Id'] = &$this->Id;

        // MessageTo
        $this->MessageTo = new DbField('MessageOut', 'MessageOut', 'x_MessageTo', 'MessageTo', '[MessageTo]', '[MessageTo]', 202, 80, -1, false, '[MessageTo]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MessageTo->Sortable = true; // Allow sort
        $this->MessageTo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageTo->Param, "CustomMsg");
        $this->Fields['MessageTo'] = &$this->MessageTo;

        // MessageFrom
        $this->MessageFrom = new DbField('MessageOut', 'MessageOut', 'x_MessageFrom', 'MessageFrom', '[MessageFrom]', '[MessageFrom]', 202, 80, -1, false, '[MessageFrom]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MessageFrom->Sortable = true; // Allow sort
        $this->MessageFrom->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageFrom->Param, "CustomMsg");
        $this->Fields['MessageFrom'] = &$this->MessageFrom;

        // MessageText
        $this->MessageText = new DbField('MessageOut', 'MessageOut', 'x_MessageText', 'MessageText', '[MessageText]', '[MessageText]', 203, 0, -1, false, '[MessageText]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->MessageText->Sortable = true; // Allow sort
        $this->MessageText->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageText->Param, "CustomMsg");
        $this->Fields['MessageText'] = &$this->MessageText;

        // MessageType
        $this->MessageType = new DbField('MessageOut', 'MessageOut', 'x_MessageType', 'MessageType', '[MessageType]', '[MessageType]', 202, 80, -1, false, '[MessageType]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MessageType->Sortable = true; // Allow sort
        $this->MessageType->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageType->Param, "CustomMsg");
        $this->Fields['MessageType'] = &$this->MessageType;

        // Gateway
        $this->Gateway = new DbField('MessageOut', 'MessageOut', 'x_Gateway', 'Gateway', '[Gateway]', '[Gateway]', 202, 80, -1, false, '[Gateway]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Gateway->Sortable = true; // Allow sort
        $this->Gateway->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Gateway->Param, "CustomMsg");
        $this->Fields['Gateway'] = &$this->Gateway;

        // UserId
        $this->_UserId = new DbField('MessageOut', 'MessageOut', 'x__UserId', 'UserId', '[UserId]', '[UserId]', 202, 80, -1, false, '[UserId]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_UserId->Sortable = true; // Allow sort
        $this->_UserId->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_UserId->Param, "CustomMsg");
        $this->Fields['UserId'] = &$this->_UserId;

        // UserInfo
        $this->UserInfo = new DbField('MessageOut', 'MessageOut', 'x_UserInfo', 'UserInfo', '[UserInfo]', '[UserInfo]', 203, 0, -1, false, '[UserInfo]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->UserInfo->Sortable = true; // Allow sort
        $this->UserInfo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->UserInfo->Param, "CustomMsg");
        $this->Fields['UserInfo'] = &$this->UserInfo;

        // Priority
        $this->Priority = new DbField('MessageOut', 'MessageOut', 'x_Priority', 'Priority', '[Priority]', 'CAST([Priority] AS NVARCHAR)', 3, 4, -1, false, '[Priority]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Priority->Sortable = true; // Allow sort
        $this->Priority->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Priority->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Priority->Param, "CustomMsg");
        $this->Fields['Priority'] = &$this->Priority;

        // Scheduled
        $this->Scheduled = new DbField('MessageOut', 'MessageOut', 'x_Scheduled', 'Scheduled', '[Scheduled]', CastDateFieldForLike("[Scheduled]", 0, "DB"), 135, 8, 0, false, '[Scheduled]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Scheduled->Sortable = true; // Allow sort
        $this->Scheduled->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Scheduled->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Scheduled->Param, "CustomMsg");
        $this->Fields['Scheduled'] = &$this->Scheduled;

        // IsRead
        $this->IsRead = new DbField('MessageOut', 'MessageOut', 'x_IsRead', 'IsRead', '[IsRead]', '[IsRead]', 11, 2, -1, false, '[IsRead]', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->IsRead->Nullable = false; // NOT NULL field
        $this->IsRead->Sortable = true; // Allow sort
        $this->IsRead->DataType = DATATYPE_BOOLEAN;
        switch ($CurrentLanguage) {
            case "en":
                $this->IsRead->Lookup = new Lookup('IsRead', 'MessageOut', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->IsRead->Lookup = new Lookup('IsRead', 'MessageOut', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->IsRead->OptionCount = 2;
        $this->IsRead->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IsRead->Param, "CustomMsg");
        $this->Fields['IsRead'] = &$this->IsRead;

        // IsSent
        $this->IsSent = new DbField('MessageOut', 'MessageOut', 'x_IsSent', 'IsSent', '[IsSent]', '[IsSent]', 11, 2, -1, false, '[IsSent]', false, false, false, 'FORMATTED TEXT', 'CHECKBOX');
        $this->IsSent->Nullable = false; // NOT NULL field
        $this->IsSent->Sortable = true; // Allow sort
        $this->IsSent->DataType = DATATYPE_BOOLEAN;
        switch ($CurrentLanguage) {
            case "en":
                $this->IsSent->Lookup = new Lookup('IsSent', 'MessageOut', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->IsSent->Lookup = new Lookup('IsSent', 'MessageOut', false, '', ["","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->IsSent->OptionCount = 2;
        $this->IsSent->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IsSent->Param, "CustomMsg");
        $this->Fields['IsSent'] = &$this->IsSent;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[MessageOut]";
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
            // Get insert id if necessary
            $this->Id->setDbValue($conn->lastInsertId());
            $rs['Id'] = $this->Id->DbValue;
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
            if (array_key_exists('Id', $rs)) {
                AddFilter($where, QuotedName('Id', $this->Dbid) . '=' . QuotedValue($rs['Id'], $this->Id->DataType, $this->Dbid));
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
        $this->Id->DbValue = $row['Id'];
        $this->MessageTo->DbValue = $row['MessageTo'];
        $this->MessageFrom->DbValue = $row['MessageFrom'];
        $this->MessageText->DbValue = $row['MessageText'];
        $this->MessageType->DbValue = $row['MessageType'];
        $this->Gateway->DbValue = $row['Gateway'];
        $this->_UserId->DbValue = $row['UserId'];
        $this->UserInfo->DbValue = $row['UserInfo'];
        $this->Priority->DbValue = $row['Priority'];
        $this->Scheduled->DbValue = $row['Scheduled'];
        $this->IsRead->DbValue = (ConvertToBool($row['IsRead']) ? "1" : "0");
        $this->IsSent->DbValue = (ConvertToBool($row['IsSent']) ? "1" : "0");
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[Id] = @Id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->Id->CurrentValue : $this->Id->OldValue;
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
                $this->Id->CurrentValue = $keys[0];
            } else {
                $this->Id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('Id', $row) ? $row['Id'] : null;
        } else {
            $val = $this->Id->OldValue !== null ? $this->Id->OldValue : $this->Id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("MessageOutList");
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
        if ($pageName == "MessageOutView") {
            return $Language->phrase("View");
        } elseif ($pageName == "MessageOutEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "MessageOutAdd") {
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
                return "MessageOutView";
            case Config("API_ADD_ACTION"):
                return "MessageOutAdd";
            case Config("API_EDIT_ACTION"):
                return "MessageOutEdit";
            case Config("API_DELETE_ACTION"):
                return "MessageOutDelete";
            case Config("API_LIST_ACTION"):
                return "MessageOutList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "MessageOutList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("MessageOutView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("MessageOutView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "MessageOutAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "MessageOutAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("MessageOutEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("MessageOutAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("MessageOutDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "Id:" . JsonEncode($this->Id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->Id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->Id->CurrentValue);
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
            if (($keyValue = Param("Id") ?? Route("Id")) !== null) {
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
                $this->Id->CurrentValue = $key;
            } else {
                $this->Id->OldValue = $key;
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
        $this->Id->setDbValue($row['Id']);
        $this->MessageTo->setDbValue($row['MessageTo']);
        $this->MessageFrom->setDbValue($row['MessageFrom']);
        $this->MessageText->setDbValue($row['MessageText']);
        $this->MessageType->setDbValue($row['MessageType']);
        $this->Gateway->setDbValue($row['Gateway']);
        $this->_UserId->setDbValue($row['UserId']);
        $this->UserInfo->setDbValue($row['UserInfo']);
        $this->Priority->setDbValue($row['Priority']);
        $this->Scheduled->setDbValue($row['Scheduled']);
        $this->IsRead->setDbValue(ConvertToBool($row['IsRead']) ? "1" : "0");
        $this->IsSent->setDbValue(ConvertToBool($row['IsSent']) ? "1" : "0");
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Id

        // MessageTo

        // MessageFrom

        // MessageText

        // MessageType

        // Gateway

        // UserId

        // UserInfo

        // Priority

        // Scheduled

        // IsRead

        // IsSent

        // Id
        $this->Id->ViewValue = $this->Id->CurrentValue;
        $this->Id->ViewCustomAttributes = "";

        // MessageTo
        $this->MessageTo->ViewValue = $this->MessageTo->CurrentValue;
        $this->MessageTo->ViewCustomAttributes = "";

        // MessageFrom
        $this->MessageFrom->ViewValue = $this->MessageFrom->CurrentValue;
        $this->MessageFrom->ViewCustomAttributes = "";

        // MessageText
        $this->MessageText->ViewValue = $this->MessageText->CurrentValue;
        $this->MessageText->ViewCustomAttributes = "";

        // MessageType
        $this->MessageType->ViewValue = $this->MessageType->CurrentValue;
        $this->MessageType->ViewCustomAttributes = "";

        // Gateway
        $this->Gateway->ViewValue = $this->Gateway->CurrentValue;
        $this->Gateway->ViewCustomAttributes = "";

        // UserId
        $this->_UserId->ViewValue = $this->_UserId->CurrentValue;
        $this->_UserId->ViewCustomAttributes = "";

        // UserInfo
        $this->UserInfo->ViewValue = $this->UserInfo->CurrentValue;
        $this->UserInfo->ViewCustomAttributes = "";

        // Priority
        $this->Priority->ViewValue = $this->Priority->CurrentValue;
        $this->Priority->ViewValue = FormatNumber($this->Priority->ViewValue, 0, -2, -2, -2);
        $this->Priority->ViewCustomAttributes = "";

        // Scheduled
        $this->Scheduled->ViewValue = $this->Scheduled->CurrentValue;
        $this->Scheduled->ViewValue = FormatDateTime($this->Scheduled->ViewValue, 0);
        $this->Scheduled->ViewCustomAttributes = "";

        // IsRead
        if (ConvertToBool($this->IsRead->CurrentValue)) {
            $this->IsRead->ViewValue = $this->IsRead->tagCaption(1) != "" ? $this->IsRead->tagCaption(1) : "Yes";
        } else {
            $this->IsRead->ViewValue = $this->IsRead->tagCaption(2) != "" ? $this->IsRead->tagCaption(2) : "No";
        }
        $this->IsRead->ViewCustomAttributes = "";

        // IsSent
        if (ConvertToBool($this->IsSent->CurrentValue)) {
            $this->IsSent->ViewValue = $this->IsSent->tagCaption(1) != "" ? $this->IsSent->tagCaption(1) : "Yes";
        } else {
            $this->IsSent->ViewValue = $this->IsSent->tagCaption(2) != "" ? $this->IsSent->tagCaption(2) : "No";
        }
        $this->IsSent->ViewCustomAttributes = "";

        // Id
        $this->Id->LinkCustomAttributes = "";
        $this->Id->HrefValue = "";
        $this->Id->TooltipValue = "";

        // MessageTo
        $this->MessageTo->LinkCustomAttributes = "";
        $this->MessageTo->HrefValue = "";
        $this->MessageTo->TooltipValue = "";

        // MessageFrom
        $this->MessageFrom->LinkCustomAttributes = "";
        $this->MessageFrom->HrefValue = "";
        $this->MessageFrom->TooltipValue = "";

        // MessageText
        $this->MessageText->LinkCustomAttributes = "";
        $this->MessageText->HrefValue = "";
        $this->MessageText->TooltipValue = "";

        // MessageType
        $this->MessageType->LinkCustomAttributes = "";
        $this->MessageType->HrefValue = "";
        $this->MessageType->TooltipValue = "";

        // Gateway
        $this->Gateway->LinkCustomAttributes = "";
        $this->Gateway->HrefValue = "";
        $this->Gateway->TooltipValue = "";

        // UserId
        $this->_UserId->LinkCustomAttributes = "";
        $this->_UserId->HrefValue = "";
        $this->_UserId->TooltipValue = "";

        // UserInfo
        $this->UserInfo->LinkCustomAttributes = "";
        $this->UserInfo->HrefValue = "";
        $this->UserInfo->TooltipValue = "";

        // Priority
        $this->Priority->LinkCustomAttributes = "";
        $this->Priority->HrefValue = "";
        $this->Priority->TooltipValue = "";

        // Scheduled
        $this->Scheduled->LinkCustomAttributes = "";
        $this->Scheduled->HrefValue = "";
        $this->Scheduled->TooltipValue = "";

        // IsRead
        $this->IsRead->LinkCustomAttributes = "";
        $this->IsRead->HrefValue = "";
        $this->IsRead->TooltipValue = "";

        // IsSent
        $this->IsSent->LinkCustomAttributes = "";
        $this->IsSent->HrefValue = "";
        $this->IsSent->TooltipValue = "";

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

        // Id
        $this->Id->EditAttrs["class"] = "form-control";
        $this->Id->EditCustomAttributes = "";
        $this->Id->EditValue = $this->Id->CurrentValue;
        $this->Id->ViewCustomAttributes = "";

        // MessageTo
        $this->MessageTo->EditAttrs["class"] = "form-control";
        $this->MessageTo->EditCustomAttributes = "";
        if (!$this->MessageTo->Raw) {
            $this->MessageTo->CurrentValue = HtmlDecode($this->MessageTo->CurrentValue);
        }
        $this->MessageTo->EditValue = $this->MessageTo->CurrentValue;
        $this->MessageTo->PlaceHolder = RemoveHtml($this->MessageTo->caption());

        // MessageFrom
        $this->MessageFrom->EditAttrs["class"] = "form-control";
        $this->MessageFrom->EditCustomAttributes = "";
        if (!$this->MessageFrom->Raw) {
            $this->MessageFrom->CurrentValue = HtmlDecode($this->MessageFrom->CurrentValue);
        }
        $this->MessageFrom->EditValue = $this->MessageFrom->CurrentValue;
        $this->MessageFrom->PlaceHolder = RemoveHtml($this->MessageFrom->caption());

        // MessageText
        $this->MessageText->EditAttrs["class"] = "form-control";
        $this->MessageText->EditCustomAttributes = "";
        $this->MessageText->EditValue = $this->MessageText->CurrentValue;
        $this->MessageText->PlaceHolder = RemoveHtml($this->MessageText->caption());

        // MessageType
        $this->MessageType->EditAttrs["class"] = "form-control";
        $this->MessageType->EditCustomAttributes = "";
        if (!$this->MessageType->Raw) {
            $this->MessageType->CurrentValue = HtmlDecode($this->MessageType->CurrentValue);
        }
        $this->MessageType->EditValue = $this->MessageType->CurrentValue;
        $this->MessageType->PlaceHolder = RemoveHtml($this->MessageType->caption());

        // Gateway
        $this->Gateway->EditAttrs["class"] = "form-control";
        $this->Gateway->EditCustomAttributes = "";
        if (!$this->Gateway->Raw) {
            $this->Gateway->CurrentValue = HtmlDecode($this->Gateway->CurrentValue);
        }
        $this->Gateway->EditValue = $this->Gateway->CurrentValue;
        $this->Gateway->PlaceHolder = RemoveHtml($this->Gateway->caption());

        // UserId
        $this->_UserId->EditAttrs["class"] = "form-control";
        $this->_UserId->EditCustomAttributes = "";
        if (!$this->_UserId->Raw) {
            $this->_UserId->CurrentValue = HtmlDecode($this->_UserId->CurrentValue);
        }
        $this->_UserId->EditValue = $this->_UserId->CurrentValue;
        $this->_UserId->PlaceHolder = RemoveHtml($this->_UserId->caption());

        // UserInfo
        $this->UserInfo->EditAttrs["class"] = "form-control";
        $this->UserInfo->EditCustomAttributes = "";
        $this->UserInfo->EditValue = $this->UserInfo->CurrentValue;
        $this->UserInfo->PlaceHolder = RemoveHtml($this->UserInfo->caption());

        // Priority
        $this->Priority->EditAttrs["class"] = "form-control";
        $this->Priority->EditCustomAttributes = "";
        $this->Priority->EditValue = $this->Priority->CurrentValue;
        $this->Priority->PlaceHolder = RemoveHtml($this->Priority->caption());

        // Scheduled
        $this->Scheduled->EditAttrs["class"] = "form-control";
        $this->Scheduled->EditCustomAttributes = "";
        $this->Scheduled->EditValue = FormatDateTime($this->Scheduled->CurrentValue, 8);
        $this->Scheduled->PlaceHolder = RemoveHtml($this->Scheduled->caption());

        // IsRead
        $this->IsRead->EditCustomAttributes = "";
        $this->IsRead->EditValue = $this->IsRead->options(false);
        $this->IsRead->PlaceHolder = RemoveHtml($this->IsRead->caption());

        // IsSent
        $this->IsSent->EditCustomAttributes = "";
        $this->IsSent->EditValue = $this->IsSent->options(false);
        $this->IsSent->PlaceHolder = RemoveHtml($this->IsSent->caption());

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
                    $doc->exportCaption($this->Id);
                    $doc->exportCaption($this->MessageTo);
                    $doc->exportCaption($this->MessageFrom);
                    $doc->exportCaption($this->MessageText);
                    $doc->exportCaption($this->MessageType);
                    $doc->exportCaption($this->Gateway);
                    $doc->exportCaption($this->_UserId);
                    $doc->exportCaption($this->UserInfo);
                    $doc->exportCaption($this->Priority);
                    $doc->exportCaption($this->Scheduled);
                    $doc->exportCaption($this->IsRead);
                    $doc->exportCaption($this->IsSent);
                } else {
                    $doc->exportCaption($this->Id);
                    $doc->exportCaption($this->MessageTo);
                    $doc->exportCaption($this->MessageFrom);
                    $doc->exportCaption($this->MessageType);
                    $doc->exportCaption($this->Gateway);
                    $doc->exportCaption($this->_UserId);
                    $doc->exportCaption($this->Priority);
                    $doc->exportCaption($this->Scheduled);
                    $doc->exportCaption($this->IsRead);
                    $doc->exportCaption($this->IsSent);
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
                        $doc->exportField($this->Id);
                        $doc->exportField($this->MessageTo);
                        $doc->exportField($this->MessageFrom);
                        $doc->exportField($this->MessageText);
                        $doc->exportField($this->MessageType);
                        $doc->exportField($this->Gateway);
                        $doc->exportField($this->_UserId);
                        $doc->exportField($this->UserInfo);
                        $doc->exportField($this->Priority);
                        $doc->exportField($this->Scheduled);
                        $doc->exportField($this->IsRead);
                        $doc->exportField($this->IsSent);
                    } else {
                        $doc->exportField($this->Id);
                        $doc->exportField($this->MessageTo);
                        $doc->exportField($this->MessageFrom);
                        $doc->exportField($this->MessageType);
                        $doc->exportField($this->Gateway);
                        $doc->exportField($this->_UserId);
                        $doc->exportField($this->Priority);
                        $doc->exportField($this->Scheduled);
                        $doc->exportField($this->IsRead);
                        $doc->exportField($this->IsSent);
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
