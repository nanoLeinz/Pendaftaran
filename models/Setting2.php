<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for SETTING2
 */
class Setting2 extends DbTable
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
    public $pop3;
    public $smtp;
    public $email_usr;
    public $email_psw;
    public $website;
    public $odbc_portal;
    public $odbc_eservice;
    public $direktori;
    public $dir_news;
    public $dir_agenda;
    public $dir_surat;
    public $dir_deseas;
    public $dir_tips;
    public $dir_org;
    public $dir_emp;
    public $dir_kliping;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'SETTING2';
        $this->TableName = 'SETTING2';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[SETTING2]";
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

        // pop3
        $this->pop3 = new DbField('SETTING2', 'SETTING2', 'x_pop3', 'pop3', '[pop3]', '[pop3]', 200, 255, -1, false, '[pop3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pop3->Sortable = true; // Allow sort
        $this->pop3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pop3->Param, "CustomMsg");
        $this->Fields['pop3'] = &$this->pop3;

        // smtp
        $this->smtp = new DbField('SETTING2', 'SETTING2', 'x_smtp', 'smtp', '[smtp]', '[smtp]', 200, 255, -1, false, '[smtp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->smtp->Sortable = true; // Allow sort
        $this->smtp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->smtp->Param, "CustomMsg");
        $this->Fields['smtp'] = &$this->smtp;

        // email_usr
        $this->email_usr = new DbField('SETTING2', 'SETTING2', 'x_email_usr', 'email_usr', '[email_usr]', '[email_usr]', 200, 255, -1, false, '[email_usr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->email_usr->Sortable = true; // Allow sort
        $this->email_usr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->email_usr->Param, "CustomMsg");
        $this->Fields['email_usr'] = &$this->email_usr;

        // email_psw
        $this->email_psw = new DbField('SETTING2', 'SETTING2', 'x_email_psw', 'email_psw', '[email_psw]', '[email_psw]', 200, 255, -1, false, '[email_psw]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->email_psw->Sortable = true; // Allow sort
        $this->email_psw->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->email_psw->Param, "CustomMsg");
        $this->Fields['email_psw'] = &$this->email_psw;

        // website
        $this->website = new DbField('SETTING2', 'SETTING2', 'x_website', 'website', '[website]', '[website]', 200, 255, -1, false, '[website]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->website->Sortable = true; // Allow sort
        $this->website->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->website->Param, "CustomMsg");
        $this->Fields['website'] = &$this->website;

        // odbc_portal
        $this->odbc_portal = new DbField('SETTING2', 'SETTING2', 'x_odbc_portal', 'odbc_portal', '[odbc_portal]', '[odbc_portal]', 200, 255, -1, false, '[odbc_portal]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->odbc_portal->Sortable = true; // Allow sort
        $this->odbc_portal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->odbc_portal->Param, "CustomMsg");
        $this->Fields['odbc_portal'] = &$this->odbc_portal;

        // odbc_eservice
        $this->odbc_eservice = new DbField('SETTING2', 'SETTING2', 'x_odbc_eservice', 'odbc_eservice', '[odbc_eservice]', '[odbc_eservice]', 200, 255, -1, false, '[odbc_eservice]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->odbc_eservice->Sortable = true; // Allow sort
        $this->odbc_eservice->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->odbc_eservice->Param, "CustomMsg");
        $this->Fields['odbc_eservice'] = &$this->odbc_eservice;

        // direktori
        $this->direktori = new DbField('SETTING2', 'SETTING2', 'x_direktori', 'direktori', '[direktori]', '[direktori]', 200, 255, -1, false, '[direktori]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->direktori->Sortable = true; // Allow sort
        $this->direktori->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->direktori->Param, "CustomMsg");
        $this->Fields['direktori'] = &$this->direktori;

        // dir_news
        $this->dir_news = new DbField('SETTING2', 'SETTING2', 'x_dir_news', 'dir_news', '[dir_news]', '[dir_news]', 200, 255, -1, false, '[dir_news]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dir_news->Sortable = true; // Allow sort
        $this->dir_news->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dir_news->Param, "CustomMsg");
        $this->Fields['dir_news'] = &$this->dir_news;

        // dir_agenda
        $this->dir_agenda = new DbField('SETTING2', 'SETTING2', 'x_dir_agenda', 'dir_agenda', '[dir_agenda]', '[dir_agenda]', 200, 255, -1, false, '[dir_agenda]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dir_agenda->Sortable = true; // Allow sort
        $this->dir_agenda->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dir_agenda->Param, "CustomMsg");
        $this->Fields['dir_agenda'] = &$this->dir_agenda;

        // dir_surat
        $this->dir_surat = new DbField('SETTING2', 'SETTING2', 'x_dir_surat', 'dir_surat', '[dir_surat]', '[dir_surat]', 200, 255, -1, false, '[dir_surat]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dir_surat->Sortable = true; // Allow sort
        $this->dir_surat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dir_surat->Param, "CustomMsg");
        $this->Fields['dir_surat'] = &$this->dir_surat;

        // dir_deseas
        $this->dir_deseas = new DbField('SETTING2', 'SETTING2', 'x_dir_deseas', 'dir_deseas', '[dir_deseas]', '[dir_deseas]', 200, 255, -1, false, '[dir_deseas]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dir_deseas->Sortable = true; // Allow sort
        $this->dir_deseas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dir_deseas->Param, "CustomMsg");
        $this->Fields['dir_deseas'] = &$this->dir_deseas;

        // dir_tips
        $this->dir_tips = new DbField('SETTING2', 'SETTING2', 'x_dir_tips', 'dir_tips', '[dir_tips]', '[dir_tips]', 200, 255, -1, false, '[dir_tips]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dir_tips->Sortable = true; // Allow sort
        $this->dir_tips->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dir_tips->Param, "CustomMsg");
        $this->Fields['dir_tips'] = &$this->dir_tips;

        // dir_org
        $this->dir_org = new DbField('SETTING2', 'SETTING2', 'x_dir_org', 'dir_org', '[dir_org]', '[dir_org]', 200, 255, -1, false, '[dir_org]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dir_org->Sortable = true; // Allow sort
        $this->dir_org->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dir_org->Param, "CustomMsg");
        $this->Fields['dir_org'] = &$this->dir_org;

        // dir_emp
        $this->dir_emp = new DbField('SETTING2', 'SETTING2', 'x_dir_emp', 'dir_emp', '[dir_emp]', '[dir_emp]', 200, 255, -1, false, '[dir_emp]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dir_emp->Sortable = true; // Allow sort
        $this->dir_emp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dir_emp->Param, "CustomMsg");
        $this->Fields['dir_emp'] = &$this->dir_emp;

        // dir_kliping
        $this->dir_kliping = new DbField('SETTING2', 'SETTING2', 'x_dir_kliping', 'dir_kliping', '[dir_kliping]', '[dir_kliping]', 200, 255, -1, false, '[dir_kliping]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dir_kliping->Sortable = true; // Allow sort
        $this->dir_kliping->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dir_kliping->Param, "CustomMsg");
        $this->Fields['dir_kliping'] = &$this->dir_kliping;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[SETTING2]";
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
        $this->pop3->DbValue = $row['pop3'];
        $this->smtp->DbValue = $row['smtp'];
        $this->email_usr->DbValue = $row['email_usr'];
        $this->email_psw->DbValue = $row['email_psw'];
        $this->website->DbValue = $row['website'];
        $this->odbc_portal->DbValue = $row['odbc_portal'];
        $this->odbc_eservice->DbValue = $row['odbc_eservice'];
        $this->direktori->DbValue = $row['direktori'];
        $this->dir_news->DbValue = $row['dir_news'];
        $this->dir_agenda->DbValue = $row['dir_agenda'];
        $this->dir_surat->DbValue = $row['dir_surat'];
        $this->dir_deseas->DbValue = $row['dir_deseas'];
        $this->dir_tips->DbValue = $row['dir_tips'];
        $this->dir_org->DbValue = $row['dir_org'];
        $this->dir_emp->DbValue = $row['dir_emp'];
        $this->dir_kliping->DbValue = $row['dir_kliping'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("Setting2List");
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
        if ($pageName == "Setting2View") {
            return $Language->phrase("View");
        } elseif ($pageName == "Setting2Edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "Setting2Add") {
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
                return "Setting2View";
            case Config("API_ADD_ACTION"):
                return "Setting2Add";
            case Config("API_EDIT_ACTION"):
                return "Setting2Edit";
            case Config("API_DELETE_ACTION"):
                return "Setting2Delete";
            case Config("API_LIST_ACTION"):
                return "Setting2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "Setting2List";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("Setting2View", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("Setting2View", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "Setting2Add?" . $this->getUrlParm($parm);
        } else {
            $url = "Setting2Add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("Setting2Edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("Setting2Add", $this->getUrlParm($parm));
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
        return $this->keyUrl("Setting2Delete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
        $this->pop3->setDbValue($row['pop3']);
        $this->smtp->setDbValue($row['smtp']);
        $this->email_usr->setDbValue($row['email_usr']);
        $this->email_psw->setDbValue($row['email_psw']);
        $this->website->setDbValue($row['website']);
        $this->odbc_portal->setDbValue($row['odbc_portal']);
        $this->odbc_eservice->setDbValue($row['odbc_eservice']);
        $this->direktori->setDbValue($row['direktori']);
        $this->dir_news->setDbValue($row['dir_news']);
        $this->dir_agenda->setDbValue($row['dir_agenda']);
        $this->dir_surat->setDbValue($row['dir_surat']);
        $this->dir_deseas->setDbValue($row['dir_deseas']);
        $this->dir_tips->setDbValue($row['dir_tips']);
        $this->dir_org->setDbValue($row['dir_org']);
        $this->dir_emp->setDbValue($row['dir_emp']);
        $this->dir_kliping->setDbValue($row['dir_kliping']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // pop3

        // smtp

        // email_usr

        // email_psw

        // website

        // odbc_portal

        // odbc_eservice

        // direktori

        // dir_news

        // dir_agenda

        // dir_surat

        // dir_deseas

        // dir_tips

        // dir_org

        // dir_emp

        // dir_kliping

        // pop3
        $this->pop3->ViewValue = $this->pop3->CurrentValue;
        $this->pop3->ViewCustomAttributes = "";

        // smtp
        $this->smtp->ViewValue = $this->smtp->CurrentValue;
        $this->smtp->ViewCustomAttributes = "";

        // email_usr
        $this->email_usr->ViewValue = $this->email_usr->CurrentValue;
        $this->email_usr->ViewCustomAttributes = "";

        // email_psw
        $this->email_psw->ViewValue = $this->email_psw->CurrentValue;
        $this->email_psw->ViewCustomAttributes = "";

        // website
        $this->website->ViewValue = $this->website->CurrentValue;
        $this->website->ViewCustomAttributes = "";

        // odbc_portal
        $this->odbc_portal->ViewValue = $this->odbc_portal->CurrentValue;
        $this->odbc_portal->ViewCustomAttributes = "";

        // odbc_eservice
        $this->odbc_eservice->ViewValue = $this->odbc_eservice->CurrentValue;
        $this->odbc_eservice->ViewCustomAttributes = "";

        // direktori
        $this->direktori->ViewValue = $this->direktori->CurrentValue;
        $this->direktori->ViewCustomAttributes = "";

        // dir_news
        $this->dir_news->ViewValue = $this->dir_news->CurrentValue;
        $this->dir_news->ViewCustomAttributes = "";

        // dir_agenda
        $this->dir_agenda->ViewValue = $this->dir_agenda->CurrentValue;
        $this->dir_agenda->ViewCustomAttributes = "";

        // dir_surat
        $this->dir_surat->ViewValue = $this->dir_surat->CurrentValue;
        $this->dir_surat->ViewCustomAttributes = "";

        // dir_deseas
        $this->dir_deseas->ViewValue = $this->dir_deseas->CurrentValue;
        $this->dir_deseas->ViewCustomAttributes = "";

        // dir_tips
        $this->dir_tips->ViewValue = $this->dir_tips->CurrentValue;
        $this->dir_tips->ViewCustomAttributes = "";

        // dir_org
        $this->dir_org->ViewValue = $this->dir_org->CurrentValue;
        $this->dir_org->ViewCustomAttributes = "";

        // dir_emp
        $this->dir_emp->ViewValue = $this->dir_emp->CurrentValue;
        $this->dir_emp->ViewCustomAttributes = "";

        // dir_kliping
        $this->dir_kliping->ViewValue = $this->dir_kliping->CurrentValue;
        $this->dir_kliping->ViewCustomAttributes = "";

        // pop3
        $this->pop3->LinkCustomAttributes = "";
        $this->pop3->HrefValue = "";
        $this->pop3->TooltipValue = "";

        // smtp
        $this->smtp->LinkCustomAttributes = "";
        $this->smtp->HrefValue = "";
        $this->smtp->TooltipValue = "";

        // email_usr
        $this->email_usr->LinkCustomAttributes = "";
        $this->email_usr->HrefValue = "";
        $this->email_usr->TooltipValue = "";

        // email_psw
        $this->email_psw->LinkCustomAttributes = "";
        $this->email_psw->HrefValue = "";
        $this->email_psw->TooltipValue = "";

        // website
        $this->website->LinkCustomAttributes = "";
        $this->website->HrefValue = "";
        $this->website->TooltipValue = "";

        // odbc_portal
        $this->odbc_portal->LinkCustomAttributes = "";
        $this->odbc_portal->HrefValue = "";
        $this->odbc_portal->TooltipValue = "";

        // odbc_eservice
        $this->odbc_eservice->LinkCustomAttributes = "";
        $this->odbc_eservice->HrefValue = "";
        $this->odbc_eservice->TooltipValue = "";

        // direktori
        $this->direktori->LinkCustomAttributes = "";
        $this->direktori->HrefValue = "";
        $this->direktori->TooltipValue = "";

        // dir_news
        $this->dir_news->LinkCustomAttributes = "";
        $this->dir_news->HrefValue = "";
        $this->dir_news->TooltipValue = "";

        // dir_agenda
        $this->dir_agenda->LinkCustomAttributes = "";
        $this->dir_agenda->HrefValue = "";
        $this->dir_agenda->TooltipValue = "";

        // dir_surat
        $this->dir_surat->LinkCustomAttributes = "";
        $this->dir_surat->HrefValue = "";
        $this->dir_surat->TooltipValue = "";

        // dir_deseas
        $this->dir_deseas->LinkCustomAttributes = "";
        $this->dir_deseas->HrefValue = "";
        $this->dir_deseas->TooltipValue = "";

        // dir_tips
        $this->dir_tips->LinkCustomAttributes = "";
        $this->dir_tips->HrefValue = "";
        $this->dir_tips->TooltipValue = "";

        // dir_org
        $this->dir_org->LinkCustomAttributes = "";
        $this->dir_org->HrefValue = "";
        $this->dir_org->TooltipValue = "";

        // dir_emp
        $this->dir_emp->LinkCustomAttributes = "";
        $this->dir_emp->HrefValue = "";
        $this->dir_emp->TooltipValue = "";

        // dir_kliping
        $this->dir_kliping->LinkCustomAttributes = "";
        $this->dir_kliping->HrefValue = "";
        $this->dir_kliping->TooltipValue = "";

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

        // pop3
        $this->pop3->EditAttrs["class"] = "form-control";
        $this->pop3->EditCustomAttributes = "";
        if (!$this->pop3->Raw) {
            $this->pop3->CurrentValue = HtmlDecode($this->pop3->CurrentValue);
        }
        $this->pop3->EditValue = $this->pop3->CurrentValue;
        $this->pop3->PlaceHolder = RemoveHtml($this->pop3->caption());

        // smtp
        $this->smtp->EditAttrs["class"] = "form-control";
        $this->smtp->EditCustomAttributes = "";
        if (!$this->smtp->Raw) {
            $this->smtp->CurrentValue = HtmlDecode($this->smtp->CurrentValue);
        }
        $this->smtp->EditValue = $this->smtp->CurrentValue;
        $this->smtp->PlaceHolder = RemoveHtml($this->smtp->caption());

        // email_usr
        $this->email_usr->EditAttrs["class"] = "form-control";
        $this->email_usr->EditCustomAttributes = "";
        if (!$this->email_usr->Raw) {
            $this->email_usr->CurrentValue = HtmlDecode($this->email_usr->CurrentValue);
        }
        $this->email_usr->EditValue = $this->email_usr->CurrentValue;
        $this->email_usr->PlaceHolder = RemoveHtml($this->email_usr->caption());

        // email_psw
        $this->email_psw->EditAttrs["class"] = "form-control";
        $this->email_psw->EditCustomAttributes = "";
        if (!$this->email_psw->Raw) {
            $this->email_psw->CurrentValue = HtmlDecode($this->email_psw->CurrentValue);
        }
        $this->email_psw->EditValue = $this->email_psw->CurrentValue;
        $this->email_psw->PlaceHolder = RemoveHtml($this->email_psw->caption());

        // website
        $this->website->EditAttrs["class"] = "form-control";
        $this->website->EditCustomAttributes = "";
        if (!$this->website->Raw) {
            $this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
        }
        $this->website->EditValue = $this->website->CurrentValue;
        $this->website->PlaceHolder = RemoveHtml($this->website->caption());

        // odbc_portal
        $this->odbc_portal->EditAttrs["class"] = "form-control";
        $this->odbc_portal->EditCustomAttributes = "";
        if (!$this->odbc_portal->Raw) {
            $this->odbc_portal->CurrentValue = HtmlDecode($this->odbc_portal->CurrentValue);
        }
        $this->odbc_portal->EditValue = $this->odbc_portal->CurrentValue;
        $this->odbc_portal->PlaceHolder = RemoveHtml($this->odbc_portal->caption());

        // odbc_eservice
        $this->odbc_eservice->EditAttrs["class"] = "form-control";
        $this->odbc_eservice->EditCustomAttributes = "";
        if (!$this->odbc_eservice->Raw) {
            $this->odbc_eservice->CurrentValue = HtmlDecode($this->odbc_eservice->CurrentValue);
        }
        $this->odbc_eservice->EditValue = $this->odbc_eservice->CurrentValue;
        $this->odbc_eservice->PlaceHolder = RemoveHtml($this->odbc_eservice->caption());

        // direktori
        $this->direktori->EditAttrs["class"] = "form-control";
        $this->direktori->EditCustomAttributes = "";
        if (!$this->direktori->Raw) {
            $this->direktori->CurrentValue = HtmlDecode($this->direktori->CurrentValue);
        }
        $this->direktori->EditValue = $this->direktori->CurrentValue;
        $this->direktori->PlaceHolder = RemoveHtml($this->direktori->caption());

        // dir_news
        $this->dir_news->EditAttrs["class"] = "form-control";
        $this->dir_news->EditCustomAttributes = "";
        if (!$this->dir_news->Raw) {
            $this->dir_news->CurrentValue = HtmlDecode($this->dir_news->CurrentValue);
        }
        $this->dir_news->EditValue = $this->dir_news->CurrentValue;
        $this->dir_news->PlaceHolder = RemoveHtml($this->dir_news->caption());

        // dir_agenda
        $this->dir_agenda->EditAttrs["class"] = "form-control";
        $this->dir_agenda->EditCustomAttributes = "";
        if (!$this->dir_agenda->Raw) {
            $this->dir_agenda->CurrentValue = HtmlDecode($this->dir_agenda->CurrentValue);
        }
        $this->dir_agenda->EditValue = $this->dir_agenda->CurrentValue;
        $this->dir_agenda->PlaceHolder = RemoveHtml($this->dir_agenda->caption());

        // dir_surat
        $this->dir_surat->EditAttrs["class"] = "form-control";
        $this->dir_surat->EditCustomAttributes = "";
        if (!$this->dir_surat->Raw) {
            $this->dir_surat->CurrentValue = HtmlDecode($this->dir_surat->CurrentValue);
        }
        $this->dir_surat->EditValue = $this->dir_surat->CurrentValue;
        $this->dir_surat->PlaceHolder = RemoveHtml($this->dir_surat->caption());

        // dir_deseas
        $this->dir_deseas->EditAttrs["class"] = "form-control";
        $this->dir_deseas->EditCustomAttributes = "";
        if (!$this->dir_deseas->Raw) {
            $this->dir_deseas->CurrentValue = HtmlDecode($this->dir_deseas->CurrentValue);
        }
        $this->dir_deseas->EditValue = $this->dir_deseas->CurrentValue;
        $this->dir_deseas->PlaceHolder = RemoveHtml($this->dir_deseas->caption());

        // dir_tips
        $this->dir_tips->EditAttrs["class"] = "form-control";
        $this->dir_tips->EditCustomAttributes = "";
        if (!$this->dir_tips->Raw) {
            $this->dir_tips->CurrentValue = HtmlDecode($this->dir_tips->CurrentValue);
        }
        $this->dir_tips->EditValue = $this->dir_tips->CurrentValue;
        $this->dir_tips->PlaceHolder = RemoveHtml($this->dir_tips->caption());

        // dir_org
        $this->dir_org->EditAttrs["class"] = "form-control";
        $this->dir_org->EditCustomAttributes = "";
        if (!$this->dir_org->Raw) {
            $this->dir_org->CurrentValue = HtmlDecode($this->dir_org->CurrentValue);
        }
        $this->dir_org->EditValue = $this->dir_org->CurrentValue;
        $this->dir_org->PlaceHolder = RemoveHtml($this->dir_org->caption());

        // dir_emp
        $this->dir_emp->EditAttrs["class"] = "form-control";
        $this->dir_emp->EditCustomAttributes = "";
        if (!$this->dir_emp->Raw) {
            $this->dir_emp->CurrentValue = HtmlDecode($this->dir_emp->CurrentValue);
        }
        $this->dir_emp->EditValue = $this->dir_emp->CurrentValue;
        $this->dir_emp->PlaceHolder = RemoveHtml($this->dir_emp->caption());

        // dir_kliping
        $this->dir_kliping->EditAttrs["class"] = "form-control";
        $this->dir_kliping->EditCustomAttributes = "";
        if (!$this->dir_kliping->Raw) {
            $this->dir_kliping->CurrentValue = HtmlDecode($this->dir_kliping->CurrentValue);
        }
        $this->dir_kliping->EditValue = $this->dir_kliping->CurrentValue;
        $this->dir_kliping->PlaceHolder = RemoveHtml($this->dir_kliping->caption());

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
                    $doc->exportCaption($this->pop3);
                    $doc->exportCaption($this->smtp);
                    $doc->exportCaption($this->email_usr);
                    $doc->exportCaption($this->email_psw);
                    $doc->exportCaption($this->website);
                    $doc->exportCaption($this->odbc_portal);
                    $doc->exportCaption($this->odbc_eservice);
                    $doc->exportCaption($this->direktori);
                    $doc->exportCaption($this->dir_news);
                    $doc->exportCaption($this->dir_agenda);
                    $doc->exportCaption($this->dir_surat);
                    $doc->exportCaption($this->dir_deseas);
                    $doc->exportCaption($this->dir_tips);
                    $doc->exportCaption($this->dir_org);
                    $doc->exportCaption($this->dir_emp);
                    $doc->exportCaption($this->dir_kliping);
                } else {
                    $doc->exportCaption($this->pop3);
                    $doc->exportCaption($this->smtp);
                    $doc->exportCaption($this->email_usr);
                    $doc->exportCaption($this->email_psw);
                    $doc->exportCaption($this->website);
                    $doc->exportCaption($this->odbc_portal);
                    $doc->exportCaption($this->odbc_eservice);
                    $doc->exportCaption($this->direktori);
                    $doc->exportCaption($this->dir_news);
                    $doc->exportCaption($this->dir_agenda);
                    $doc->exportCaption($this->dir_surat);
                    $doc->exportCaption($this->dir_deseas);
                    $doc->exportCaption($this->dir_tips);
                    $doc->exportCaption($this->dir_org);
                    $doc->exportCaption($this->dir_emp);
                    $doc->exportCaption($this->dir_kliping);
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
                        $doc->exportField($this->pop3);
                        $doc->exportField($this->smtp);
                        $doc->exportField($this->email_usr);
                        $doc->exportField($this->email_psw);
                        $doc->exportField($this->website);
                        $doc->exportField($this->odbc_portal);
                        $doc->exportField($this->odbc_eservice);
                        $doc->exportField($this->direktori);
                        $doc->exportField($this->dir_news);
                        $doc->exportField($this->dir_agenda);
                        $doc->exportField($this->dir_surat);
                        $doc->exportField($this->dir_deseas);
                        $doc->exportField($this->dir_tips);
                        $doc->exportField($this->dir_org);
                        $doc->exportField($this->dir_emp);
                        $doc->exportField($this->dir_kliping);
                    } else {
                        $doc->exportField($this->pop3);
                        $doc->exportField($this->smtp);
                        $doc->exportField($this->email_usr);
                        $doc->exportField($this->email_psw);
                        $doc->exportField($this->website);
                        $doc->exportField($this->odbc_portal);
                        $doc->exportField($this->odbc_eservice);
                        $doc->exportField($this->direktori);
                        $doc->exportField($this->dir_news);
                        $doc->exportField($this->dir_agenda);
                        $doc->exportField($this->dir_surat);
                        $doc->exportField($this->dir_deseas);
                        $doc->exportField($this->dir_tips);
                        $doc->exportField($this->dir_org);
                        $doc->exportField($this->dir_emp);
                        $doc->exportField($this->dir_kliping);
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
