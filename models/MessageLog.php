<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for MessageLog
 */
class MessageLog extends DbTable
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
    public $SendTime;
    public $ReceiveTime;
    public $StatusCode;
    public $StatusText;
    public $MessageTo;
    public $MessageFrom;
    public $MessageText;
    public $MessageType;
    public $MessageId;
    public $ErrorCode;
    public $ErrorText;
    public $Gateway;
    public $MessagePDU;
    public $_UserId;
    public $UserInfo;
    public $Accounting;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'MessageLog';
        $this->TableName = 'MessageLog';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[MessageLog]";
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
        $this->Id = new DbField('MessageLog', 'MessageLog', 'x_Id', 'Id', '[Id]', 'CAST([Id] AS NVARCHAR)', 3, 4, -1, false, '[Id]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->Id->IsAutoIncrement = true; // Autoincrement field
        $this->Id->IsPrimaryKey = true; // Primary key field
        $this->Id->Nullable = false; // NOT NULL field
        $this->Id->Sortable = true; // Allow sort
        $this->Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Id->Param, "CustomMsg");
        $this->Fields['Id'] = &$this->Id;

        // SendTime
        $this->SendTime = new DbField('MessageLog', 'MessageLog', 'x_SendTime', 'SendTime', '[SendTime]', CastDateFieldForLike("[SendTime]", 0, "DB"), 135, 8, 0, false, '[SendTime]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SendTime->Nullable = false; // NOT NULL field
        $this->SendTime->Required = true; // Required field
        $this->SendTime->Sortable = true; // Allow sort
        $this->SendTime->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SendTime->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SendTime->Param, "CustomMsg");
        $this->Fields['SendTime'] = &$this->SendTime;

        // ReceiveTime
        $this->ReceiveTime = new DbField('MessageLog', 'MessageLog', 'x_ReceiveTime', 'ReceiveTime', '[ReceiveTime]', CastDateFieldForLike("[ReceiveTime]", 0, "DB"), 135, 8, 0, false, '[ReceiveTime]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ReceiveTime->Sortable = true; // Allow sort
        $this->ReceiveTime->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->ReceiveTime->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ReceiveTime->Param, "CustomMsg");
        $this->Fields['ReceiveTime'] = &$this->ReceiveTime;

        // StatusCode
        $this->StatusCode = new DbField('MessageLog', 'MessageLog', 'x_StatusCode', 'StatusCode', '[StatusCode]', 'CAST([StatusCode] AS NVARCHAR)', 3, 4, -1, false, '[StatusCode]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->StatusCode->Sortable = true; // Allow sort
        $this->StatusCode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->StatusCode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->StatusCode->Param, "CustomMsg");
        $this->Fields['StatusCode'] = &$this->StatusCode;

        // StatusText
        $this->StatusText = new DbField('MessageLog', 'MessageLog', 'x_StatusText', 'StatusText', '[StatusText]', '[StatusText]', 202, 80, -1, false, '[StatusText]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->StatusText->Sortable = true; // Allow sort
        $this->StatusText->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->StatusText->Param, "CustomMsg");
        $this->Fields['StatusText'] = &$this->StatusText;

        // MessageTo
        $this->MessageTo = new DbField('MessageLog', 'MessageLog', 'x_MessageTo', 'MessageTo', '[MessageTo]', '[MessageTo]', 202, 80, -1, false, '[MessageTo]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MessageTo->Sortable = true; // Allow sort
        $this->MessageTo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageTo->Param, "CustomMsg");
        $this->Fields['MessageTo'] = &$this->MessageTo;

        // MessageFrom
        $this->MessageFrom = new DbField('MessageLog', 'MessageLog', 'x_MessageFrom', 'MessageFrom', '[MessageFrom]', '[MessageFrom]', 202, 80, -1, false, '[MessageFrom]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MessageFrom->Sortable = true; // Allow sort
        $this->MessageFrom->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageFrom->Param, "CustomMsg");
        $this->Fields['MessageFrom'] = &$this->MessageFrom;

        // MessageText
        $this->MessageText = new DbField('MessageLog', 'MessageLog', 'x_MessageText', 'MessageText', '[MessageText]', '[MessageText]', 203, 0, -1, false, '[MessageText]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->MessageText->Sortable = true; // Allow sort
        $this->MessageText->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageText->Param, "CustomMsg");
        $this->Fields['MessageText'] = &$this->MessageText;

        // MessageType
        $this->MessageType = new DbField('MessageLog', 'MessageLog', 'x_MessageType', 'MessageType', '[MessageType]', '[MessageType]', 202, 80, -1, false, '[MessageType]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MessageType->Sortable = true; // Allow sort
        $this->MessageType->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageType->Param, "CustomMsg");
        $this->Fields['MessageType'] = &$this->MessageType;

        // MessageId
        $this->MessageId = new DbField('MessageLog', 'MessageLog', 'x_MessageId', 'MessageId', '[MessageId]', '[MessageId]', 202, 80, -1, false, '[MessageId]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MessageId->Sortable = true; // Allow sort
        $this->MessageId->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessageId->Param, "CustomMsg");
        $this->Fields['MessageId'] = &$this->MessageId;

        // ErrorCode
        $this->ErrorCode = new DbField('MessageLog', 'MessageLog', 'x_ErrorCode', 'ErrorCode', '[ErrorCode]', '[ErrorCode]', 202, 80, -1, false, '[ErrorCode]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ErrorCode->Sortable = true; // Allow sort
        $this->ErrorCode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ErrorCode->Param, "CustomMsg");
        $this->Fields['ErrorCode'] = &$this->ErrorCode;

        // ErrorText
        $this->ErrorText = new DbField('MessageLog', 'MessageLog', 'x_ErrorText', 'ErrorText', '[ErrorText]', '[ErrorText]', 202, 80, -1, false, '[ErrorText]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ErrorText->Sortable = true; // Allow sort
        $this->ErrorText->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ErrorText->Param, "CustomMsg");
        $this->Fields['ErrorText'] = &$this->ErrorText;

        // Gateway
        $this->Gateway = new DbField('MessageLog', 'MessageLog', 'x_Gateway', 'Gateway', '[Gateway]', '[Gateway]', 202, 80, -1, false, '[Gateway]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Gateway->Sortable = true; // Allow sort
        $this->Gateway->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Gateway->Param, "CustomMsg");
        $this->Fields['Gateway'] = &$this->Gateway;

        // MessagePDU
        $this->MessagePDU = new DbField('MessageLog', 'MessageLog', 'x_MessagePDU', 'MessagePDU', '[MessagePDU]', '[MessagePDU]', 203, 0, -1, false, '[MessagePDU]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->MessagePDU->Sortable = true; // Allow sort
        $this->MessagePDU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MessagePDU->Param, "CustomMsg");
        $this->Fields['MessagePDU'] = &$this->MessagePDU;

        // UserId
        $this->_UserId = new DbField('MessageLog', 'MessageLog', 'x__UserId', 'UserId', '[UserId]', '[UserId]', 202, 80, -1, false, '[UserId]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_UserId->Sortable = true; // Allow sort
        $this->_UserId->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_UserId->Param, "CustomMsg");
        $this->Fields['UserId'] = &$this->_UserId;

        // UserInfo
        $this->UserInfo = new DbField('MessageLog', 'MessageLog', 'x_UserInfo', 'UserInfo', '[UserInfo]', '[UserInfo]', 203, 0, -1, false, '[UserInfo]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->UserInfo->Sortable = true; // Allow sort
        $this->UserInfo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->UserInfo->Param, "CustomMsg");
        $this->Fields['UserInfo'] = &$this->UserInfo;

        // Accounting
        $this->Accounting = new DbField('MessageLog', 'MessageLog', 'x_Accounting', 'Accounting', '[Accounting]', '[Accounting]', 203, 0, -1, false, '[Accounting]', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Accounting->Sortable = true; // Allow sort
        $this->Accounting->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Accounting->Param, "CustomMsg");
        $this->Fields['Accounting'] = &$this->Accounting;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[MessageLog]";
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
        $this->SendTime->DbValue = $row['SendTime'];
        $this->ReceiveTime->DbValue = $row['ReceiveTime'];
        $this->StatusCode->DbValue = $row['StatusCode'];
        $this->StatusText->DbValue = $row['StatusText'];
        $this->MessageTo->DbValue = $row['MessageTo'];
        $this->MessageFrom->DbValue = $row['MessageFrom'];
        $this->MessageText->DbValue = $row['MessageText'];
        $this->MessageType->DbValue = $row['MessageType'];
        $this->MessageId->DbValue = $row['MessageId'];
        $this->ErrorCode->DbValue = $row['ErrorCode'];
        $this->ErrorText->DbValue = $row['ErrorText'];
        $this->Gateway->DbValue = $row['Gateway'];
        $this->MessagePDU->DbValue = $row['MessagePDU'];
        $this->_UserId->DbValue = $row['UserId'];
        $this->UserInfo->DbValue = $row['UserInfo'];
        $this->Accounting->DbValue = $row['Accounting'];
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
        return $_SESSION[$name] ?? GetUrl("MessageLogList");
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
        if ($pageName == "MessageLogView") {
            return $Language->phrase("View");
        } elseif ($pageName == "MessageLogEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "MessageLogAdd") {
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
                return "MessageLogView";
            case Config("API_ADD_ACTION"):
                return "MessageLogAdd";
            case Config("API_EDIT_ACTION"):
                return "MessageLogEdit";
            case Config("API_DELETE_ACTION"):
                return "MessageLogDelete";
            case Config("API_LIST_ACTION"):
                return "MessageLogList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "MessageLogList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("MessageLogView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("MessageLogView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "MessageLogAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "MessageLogAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("MessageLogEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("MessageLogAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("MessageLogDelete", $this->getUrlParm());
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
        $this->SendTime->setDbValue($row['SendTime']);
        $this->ReceiveTime->setDbValue($row['ReceiveTime']);
        $this->StatusCode->setDbValue($row['StatusCode']);
        $this->StatusText->setDbValue($row['StatusText']);
        $this->MessageTo->setDbValue($row['MessageTo']);
        $this->MessageFrom->setDbValue($row['MessageFrom']);
        $this->MessageText->setDbValue($row['MessageText']);
        $this->MessageType->setDbValue($row['MessageType']);
        $this->MessageId->setDbValue($row['MessageId']);
        $this->ErrorCode->setDbValue($row['ErrorCode']);
        $this->ErrorText->setDbValue($row['ErrorText']);
        $this->Gateway->setDbValue($row['Gateway']);
        $this->MessagePDU->setDbValue($row['MessagePDU']);
        $this->_UserId->setDbValue($row['UserId']);
        $this->UserInfo->setDbValue($row['UserInfo']);
        $this->Accounting->setDbValue($row['Accounting']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Id

        // SendTime

        // ReceiveTime

        // StatusCode

        // StatusText

        // MessageTo

        // MessageFrom

        // MessageText

        // MessageType

        // MessageId

        // ErrorCode

        // ErrorText

        // Gateway

        // MessagePDU

        // UserId

        // UserInfo

        // Accounting

        // Id
        $this->Id->ViewValue = $this->Id->CurrentValue;
        $this->Id->ViewCustomAttributes = "";

        // SendTime
        $this->SendTime->ViewValue = $this->SendTime->CurrentValue;
        $this->SendTime->ViewValue = FormatDateTime($this->SendTime->ViewValue, 0);
        $this->SendTime->ViewCustomAttributes = "";

        // ReceiveTime
        $this->ReceiveTime->ViewValue = $this->ReceiveTime->CurrentValue;
        $this->ReceiveTime->ViewValue = FormatDateTime($this->ReceiveTime->ViewValue, 0);
        $this->ReceiveTime->ViewCustomAttributes = "";

        // StatusCode
        $this->StatusCode->ViewValue = $this->StatusCode->CurrentValue;
        $this->StatusCode->ViewValue = FormatNumber($this->StatusCode->ViewValue, 0, -2, -2, -2);
        $this->StatusCode->ViewCustomAttributes = "";

        // StatusText
        $this->StatusText->ViewValue = $this->StatusText->CurrentValue;
        $this->StatusText->ViewCustomAttributes = "";

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

        // MessageId
        $this->MessageId->ViewValue = $this->MessageId->CurrentValue;
        $this->MessageId->ViewCustomAttributes = "";

        // ErrorCode
        $this->ErrorCode->ViewValue = $this->ErrorCode->CurrentValue;
        $this->ErrorCode->ViewCustomAttributes = "";

        // ErrorText
        $this->ErrorText->ViewValue = $this->ErrorText->CurrentValue;
        $this->ErrorText->ViewCustomAttributes = "";

        // Gateway
        $this->Gateway->ViewValue = $this->Gateway->CurrentValue;
        $this->Gateway->ViewCustomAttributes = "";

        // MessagePDU
        $this->MessagePDU->ViewValue = $this->MessagePDU->CurrentValue;
        $this->MessagePDU->ViewCustomAttributes = "";

        // UserId
        $this->_UserId->ViewValue = $this->_UserId->CurrentValue;
        $this->_UserId->ViewCustomAttributes = "";

        // UserInfo
        $this->UserInfo->ViewValue = $this->UserInfo->CurrentValue;
        $this->UserInfo->ViewCustomAttributes = "";

        // Accounting
        $this->Accounting->ViewValue = $this->Accounting->CurrentValue;
        $this->Accounting->ViewCustomAttributes = "";

        // Id
        $this->Id->LinkCustomAttributes = "";
        $this->Id->HrefValue = "";
        $this->Id->TooltipValue = "";

        // SendTime
        $this->SendTime->LinkCustomAttributes = "";
        $this->SendTime->HrefValue = "";
        $this->SendTime->TooltipValue = "";

        // ReceiveTime
        $this->ReceiveTime->LinkCustomAttributes = "";
        $this->ReceiveTime->HrefValue = "";
        $this->ReceiveTime->TooltipValue = "";

        // StatusCode
        $this->StatusCode->LinkCustomAttributes = "";
        $this->StatusCode->HrefValue = "";
        $this->StatusCode->TooltipValue = "";

        // StatusText
        $this->StatusText->LinkCustomAttributes = "";
        $this->StatusText->HrefValue = "";
        $this->StatusText->TooltipValue = "";

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

        // MessageId
        $this->MessageId->LinkCustomAttributes = "";
        $this->MessageId->HrefValue = "";
        $this->MessageId->TooltipValue = "";

        // ErrorCode
        $this->ErrorCode->LinkCustomAttributes = "";
        $this->ErrorCode->HrefValue = "";
        $this->ErrorCode->TooltipValue = "";

        // ErrorText
        $this->ErrorText->LinkCustomAttributes = "";
        $this->ErrorText->HrefValue = "";
        $this->ErrorText->TooltipValue = "";

        // Gateway
        $this->Gateway->LinkCustomAttributes = "";
        $this->Gateway->HrefValue = "";
        $this->Gateway->TooltipValue = "";

        // MessagePDU
        $this->MessagePDU->LinkCustomAttributes = "";
        $this->MessagePDU->HrefValue = "";
        $this->MessagePDU->TooltipValue = "";

        // UserId
        $this->_UserId->LinkCustomAttributes = "";
        $this->_UserId->HrefValue = "";
        $this->_UserId->TooltipValue = "";

        // UserInfo
        $this->UserInfo->LinkCustomAttributes = "";
        $this->UserInfo->HrefValue = "";
        $this->UserInfo->TooltipValue = "";

        // Accounting
        $this->Accounting->LinkCustomAttributes = "";
        $this->Accounting->HrefValue = "";
        $this->Accounting->TooltipValue = "";

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

        // SendTime
        $this->SendTime->EditAttrs["class"] = "form-control";
        $this->SendTime->EditCustomAttributes = "";
        $this->SendTime->EditValue = FormatDateTime($this->SendTime->CurrentValue, 8);
        $this->SendTime->PlaceHolder = RemoveHtml($this->SendTime->caption());

        // ReceiveTime
        $this->ReceiveTime->EditAttrs["class"] = "form-control";
        $this->ReceiveTime->EditCustomAttributes = "";
        $this->ReceiveTime->EditValue = FormatDateTime($this->ReceiveTime->CurrentValue, 8);
        $this->ReceiveTime->PlaceHolder = RemoveHtml($this->ReceiveTime->caption());

        // StatusCode
        $this->StatusCode->EditAttrs["class"] = "form-control";
        $this->StatusCode->EditCustomAttributes = "";
        $this->StatusCode->EditValue = $this->StatusCode->CurrentValue;
        $this->StatusCode->PlaceHolder = RemoveHtml($this->StatusCode->caption());

        // StatusText
        $this->StatusText->EditAttrs["class"] = "form-control";
        $this->StatusText->EditCustomAttributes = "";
        if (!$this->StatusText->Raw) {
            $this->StatusText->CurrentValue = HtmlDecode($this->StatusText->CurrentValue);
        }
        $this->StatusText->EditValue = $this->StatusText->CurrentValue;
        $this->StatusText->PlaceHolder = RemoveHtml($this->StatusText->caption());

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

        // MessageId
        $this->MessageId->EditAttrs["class"] = "form-control";
        $this->MessageId->EditCustomAttributes = "";
        if (!$this->MessageId->Raw) {
            $this->MessageId->CurrentValue = HtmlDecode($this->MessageId->CurrentValue);
        }
        $this->MessageId->EditValue = $this->MessageId->CurrentValue;
        $this->MessageId->PlaceHolder = RemoveHtml($this->MessageId->caption());

        // ErrorCode
        $this->ErrorCode->EditAttrs["class"] = "form-control";
        $this->ErrorCode->EditCustomAttributes = "";
        if (!$this->ErrorCode->Raw) {
            $this->ErrorCode->CurrentValue = HtmlDecode($this->ErrorCode->CurrentValue);
        }
        $this->ErrorCode->EditValue = $this->ErrorCode->CurrentValue;
        $this->ErrorCode->PlaceHolder = RemoveHtml($this->ErrorCode->caption());

        // ErrorText
        $this->ErrorText->EditAttrs["class"] = "form-control";
        $this->ErrorText->EditCustomAttributes = "";
        if (!$this->ErrorText->Raw) {
            $this->ErrorText->CurrentValue = HtmlDecode($this->ErrorText->CurrentValue);
        }
        $this->ErrorText->EditValue = $this->ErrorText->CurrentValue;
        $this->ErrorText->PlaceHolder = RemoveHtml($this->ErrorText->caption());

        // Gateway
        $this->Gateway->EditAttrs["class"] = "form-control";
        $this->Gateway->EditCustomAttributes = "";
        if (!$this->Gateway->Raw) {
            $this->Gateway->CurrentValue = HtmlDecode($this->Gateway->CurrentValue);
        }
        $this->Gateway->EditValue = $this->Gateway->CurrentValue;
        $this->Gateway->PlaceHolder = RemoveHtml($this->Gateway->caption());

        // MessagePDU
        $this->MessagePDU->EditAttrs["class"] = "form-control";
        $this->MessagePDU->EditCustomAttributes = "";
        $this->MessagePDU->EditValue = $this->MessagePDU->CurrentValue;
        $this->MessagePDU->PlaceHolder = RemoveHtml($this->MessagePDU->caption());

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

        // Accounting
        $this->Accounting->EditAttrs["class"] = "form-control";
        $this->Accounting->EditCustomAttributes = "";
        $this->Accounting->EditValue = $this->Accounting->CurrentValue;
        $this->Accounting->PlaceHolder = RemoveHtml($this->Accounting->caption());

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
                    $doc->exportCaption($this->SendTime);
                    $doc->exportCaption($this->ReceiveTime);
                    $doc->exportCaption($this->StatusCode);
                    $doc->exportCaption($this->StatusText);
                    $doc->exportCaption($this->MessageTo);
                    $doc->exportCaption($this->MessageFrom);
                    $doc->exportCaption($this->MessageText);
                    $doc->exportCaption($this->MessageType);
                    $doc->exportCaption($this->MessageId);
                    $doc->exportCaption($this->ErrorCode);
                    $doc->exportCaption($this->ErrorText);
                    $doc->exportCaption($this->Gateway);
                    $doc->exportCaption($this->MessagePDU);
                    $doc->exportCaption($this->_UserId);
                    $doc->exportCaption($this->UserInfo);
                    $doc->exportCaption($this->Accounting);
                } else {
                    $doc->exportCaption($this->Id);
                    $doc->exportCaption($this->SendTime);
                    $doc->exportCaption($this->ReceiveTime);
                    $doc->exportCaption($this->StatusCode);
                    $doc->exportCaption($this->StatusText);
                    $doc->exportCaption($this->MessageTo);
                    $doc->exportCaption($this->MessageFrom);
                    $doc->exportCaption($this->MessageType);
                    $doc->exportCaption($this->MessageId);
                    $doc->exportCaption($this->ErrorCode);
                    $doc->exportCaption($this->ErrorText);
                    $doc->exportCaption($this->Gateway);
                    $doc->exportCaption($this->_UserId);
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
                        $doc->exportField($this->SendTime);
                        $doc->exportField($this->ReceiveTime);
                        $doc->exportField($this->StatusCode);
                        $doc->exportField($this->StatusText);
                        $doc->exportField($this->MessageTo);
                        $doc->exportField($this->MessageFrom);
                        $doc->exportField($this->MessageText);
                        $doc->exportField($this->MessageType);
                        $doc->exportField($this->MessageId);
                        $doc->exportField($this->ErrorCode);
                        $doc->exportField($this->ErrorText);
                        $doc->exportField($this->Gateway);
                        $doc->exportField($this->MessagePDU);
                        $doc->exportField($this->_UserId);
                        $doc->exportField($this->UserInfo);
                        $doc->exportField($this->Accounting);
                    } else {
                        $doc->exportField($this->Id);
                        $doc->exportField($this->SendTime);
                        $doc->exportField($this->ReceiveTime);
                        $doc->exportField($this->StatusCode);
                        $doc->exportField($this->StatusText);
                        $doc->exportField($this->MessageTo);
                        $doc->exportField($this->MessageFrom);
                        $doc->exportField($this->MessageType);
                        $doc->exportField($this->MessageId);
                        $doc->exportField($this->ErrorCode);
                        $doc->exportField($this->ErrorText);
                        $doc->exportField($this->Gateway);
                        $doc->exportField($this->_UserId);
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
