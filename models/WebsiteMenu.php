<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for WEBSITE_MENU
 */
class WebsiteMenu extends DbTable
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
    public $MENU_ID;
    public $javascript_id;
    public $file_name;
    public $menu_name;
    public $isactive;
    public $menu_type;
    public $header_name;
    public $isslide;
    public $timeslide;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'WEBSITE_MENU';
        $this->TableName = 'WEBSITE_MENU';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[WEBSITE_MENU]";
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

        // MENU_ID
        $this->MENU_ID = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_MENU_ID', 'MENU_ID', '[MENU_ID]', 'CAST([MENU_ID] AS NVARCHAR)', 2, 2, -1, false, '[MENU_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MENU_ID->IsPrimaryKey = true; // Primary key field
        $this->MENU_ID->Nullable = false; // NOT NULL field
        $this->MENU_ID->Required = true; // Required field
        $this->MENU_ID->Sortable = true; // Allow sort
        $this->MENU_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MENU_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MENU_ID->Param, "CustomMsg");
        $this->Fields['MENU_ID'] = &$this->MENU_ID;

        // javascript_id
        $this->javascript_id = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_javascript_id', 'javascript_id', '[javascript_id]', '[javascript_id]', 200, 50, -1, false, '[javascript_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->javascript_id->Sortable = true; // Allow sort
        $this->javascript_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->javascript_id->Param, "CustomMsg");
        $this->Fields['javascript_id'] = &$this->javascript_id;

        // file_name
        $this->file_name = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_file_name', 'file_name', '[file_name]', '[file_name]', 200, 200, -1, false, '[file_name]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->file_name->Sortable = true; // Allow sort
        $this->file_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->file_name->Param, "CustomMsg");
        $this->Fields['file_name'] = &$this->file_name;

        // menu_name
        $this->menu_name = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_menu_name', 'menu_name', '[menu_name]', '[menu_name]', 200, 200, -1, false, '[menu_name]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->menu_name->Sortable = true; // Allow sort
        $this->menu_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->menu_name->Param, "CustomMsg");
        $this->Fields['menu_name'] = &$this->menu_name;

        // isactive
        $this->isactive = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_isactive', 'isactive', '[isactive]', '[isactive]', 129, 1, -1, false, '[isactive]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isactive->Sortable = true; // Allow sort
        $this->isactive->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isactive->Param, "CustomMsg");
        $this->Fields['isactive'] = &$this->isactive;

        // menu_type
        $this->menu_type = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_menu_type', 'menu_type', '[menu_type]', 'CAST([menu_type] AS NVARCHAR)', 2, 2, -1, false, '[menu_type]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->menu_type->Sortable = true; // Allow sort
        $this->menu_type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->menu_type->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->menu_type->Param, "CustomMsg");
        $this->Fields['menu_type'] = &$this->menu_type;

        // header_name
        $this->header_name = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_header_name', 'header_name', '[header_name]', '[header_name]', 200, 200, -1, false, '[header_name]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->header_name->Sortable = true; // Allow sort
        $this->header_name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->header_name->Param, "CustomMsg");
        $this->Fields['header_name'] = &$this->header_name;

        // isslide
        $this->isslide = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_isslide', 'isslide', '[isslide]', '[isslide]', 129, 1, -1, false, '[isslide]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->isslide->Sortable = true; // Allow sort
        $this->isslide->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isslide->Param, "CustomMsg");
        $this->Fields['isslide'] = &$this->isslide;

        // timeslide
        $this->timeslide = new DbField('WEBSITE_MENU', 'WEBSITE_MENU', 'x_timeslide', 'timeslide', '[timeslide]', 'CAST([timeslide] AS NVARCHAR)', 3, 4, -1, false, '[timeslide]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->timeslide->Sortable = true; // Allow sort
        $this->timeslide->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->timeslide->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->timeslide->Param, "CustomMsg");
        $this->Fields['timeslide'] = &$this->timeslide;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[WEBSITE_MENU]";
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
            if (array_key_exists('MENU_ID', $rs)) {
                AddFilter($where, QuotedName('MENU_ID', $this->Dbid) . '=' . QuotedValue($rs['MENU_ID'], $this->MENU_ID->DataType, $this->Dbid));
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
        $this->MENU_ID->DbValue = $row['MENU_ID'];
        $this->javascript_id->DbValue = $row['javascript_id'];
        $this->file_name->DbValue = $row['file_name'];
        $this->menu_name->DbValue = $row['menu_name'];
        $this->isactive->DbValue = $row['isactive'];
        $this->menu_type->DbValue = $row['menu_type'];
        $this->header_name->DbValue = $row['header_name'];
        $this->isslide->DbValue = $row['isslide'];
        $this->timeslide->DbValue = $row['timeslide'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[MENU_ID] = @MENU_ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->MENU_ID->CurrentValue : $this->MENU_ID->OldValue;
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
                $this->MENU_ID->CurrentValue = $keys[0];
            } else {
                $this->MENU_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('MENU_ID', $row) ? $row['MENU_ID'] : null;
        } else {
            $val = $this->MENU_ID->OldValue !== null ? $this->MENU_ID->OldValue : $this->MENU_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@MENU_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("WebsiteMenuList");
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
        if ($pageName == "WebsiteMenuView") {
            return $Language->phrase("View");
        } elseif ($pageName == "WebsiteMenuEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "WebsiteMenuAdd") {
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
                return "WebsiteMenuView";
            case Config("API_ADD_ACTION"):
                return "WebsiteMenuAdd";
            case Config("API_EDIT_ACTION"):
                return "WebsiteMenuEdit";
            case Config("API_DELETE_ACTION"):
                return "WebsiteMenuDelete";
            case Config("API_LIST_ACTION"):
                return "WebsiteMenuList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "WebsiteMenuList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("WebsiteMenuView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("WebsiteMenuView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "WebsiteMenuAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "WebsiteMenuAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("WebsiteMenuEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("WebsiteMenuAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("WebsiteMenuDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "MENU_ID:" . JsonEncode($this->MENU_ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->MENU_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->MENU_ID->CurrentValue);
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
            if (($keyValue = Param("MENU_ID") ?? Route("MENU_ID")) !== null) {
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
                $this->MENU_ID->CurrentValue = $key;
            } else {
                $this->MENU_ID->OldValue = $key;
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
        $this->MENU_ID->setDbValue($row['MENU_ID']);
        $this->javascript_id->setDbValue($row['javascript_id']);
        $this->file_name->setDbValue($row['file_name']);
        $this->menu_name->setDbValue($row['menu_name']);
        $this->isactive->setDbValue($row['isactive']);
        $this->menu_type->setDbValue($row['menu_type']);
        $this->header_name->setDbValue($row['header_name']);
        $this->isslide->setDbValue($row['isslide']);
        $this->timeslide->setDbValue($row['timeslide']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // MENU_ID

        // javascript_id

        // file_name

        // menu_name

        // isactive

        // menu_type

        // header_name

        // isslide

        // timeslide

        // MENU_ID
        $this->MENU_ID->ViewValue = $this->MENU_ID->CurrentValue;
        $this->MENU_ID->ViewValue = FormatNumber($this->MENU_ID->ViewValue, 0, -2, -2, -2);
        $this->MENU_ID->ViewCustomAttributes = "";

        // javascript_id
        $this->javascript_id->ViewValue = $this->javascript_id->CurrentValue;
        $this->javascript_id->ViewCustomAttributes = "";

        // file_name
        $this->file_name->ViewValue = $this->file_name->CurrentValue;
        $this->file_name->ViewCustomAttributes = "";

        // menu_name
        $this->menu_name->ViewValue = $this->menu_name->CurrentValue;
        $this->menu_name->ViewCustomAttributes = "";

        // isactive
        $this->isactive->ViewValue = $this->isactive->CurrentValue;
        $this->isactive->ViewCustomAttributes = "";

        // menu_type
        $this->menu_type->ViewValue = $this->menu_type->CurrentValue;
        $this->menu_type->ViewValue = FormatNumber($this->menu_type->ViewValue, 0, -2, -2, -2);
        $this->menu_type->ViewCustomAttributes = "";

        // header_name
        $this->header_name->ViewValue = $this->header_name->CurrentValue;
        $this->header_name->ViewCustomAttributes = "";

        // isslide
        $this->isslide->ViewValue = $this->isslide->CurrentValue;
        $this->isslide->ViewCustomAttributes = "";

        // timeslide
        $this->timeslide->ViewValue = $this->timeslide->CurrentValue;
        $this->timeslide->ViewValue = FormatNumber($this->timeslide->ViewValue, 0, -2, -2, -2);
        $this->timeslide->ViewCustomAttributes = "";

        // MENU_ID
        $this->MENU_ID->LinkCustomAttributes = "";
        $this->MENU_ID->HrefValue = "";
        $this->MENU_ID->TooltipValue = "";

        // javascript_id
        $this->javascript_id->LinkCustomAttributes = "";
        $this->javascript_id->HrefValue = "";
        $this->javascript_id->TooltipValue = "";

        // file_name
        $this->file_name->LinkCustomAttributes = "";
        $this->file_name->HrefValue = "";
        $this->file_name->TooltipValue = "";

        // menu_name
        $this->menu_name->LinkCustomAttributes = "";
        $this->menu_name->HrefValue = "";
        $this->menu_name->TooltipValue = "";

        // isactive
        $this->isactive->LinkCustomAttributes = "";
        $this->isactive->HrefValue = "";
        $this->isactive->TooltipValue = "";

        // menu_type
        $this->menu_type->LinkCustomAttributes = "";
        $this->menu_type->HrefValue = "";
        $this->menu_type->TooltipValue = "";

        // header_name
        $this->header_name->LinkCustomAttributes = "";
        $this->header_name->HrefValue = "";
        $this->header_name->TooltipValue = "";

        // isslide
        $this->isslide->LinkCustomAttributes = "";
        $this->isslide->HrefValue = "";
        $this->isslide->TooltipValue = "";

        // timeslide
        $this->timeslide->LinkCustomAttributes = "";
        $this->timeslide->HrefValue = "";
        $this->timeslide->TooltipValue = "";

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

        // MENU_ID
        $this->MENU_ID->EditAttrs["class"] = "form-control";
        $this->MENU_ID->EditCustomAttributes = "";
        $this->MENU_ID->EditValue = $this->MENU_ID->CurrentValue;
        $this->MENU_ID->PlaceHolder = RemoveHtml($this->MENU_ID->caption());

        // javascript_id
        $this->javascript_id->EditAttrs["class"] = "form-control";
        $this->javascript_id->EditCustomAttributes = "";
        if (!$this->javascript_id->Raw) {
            $this->javascript_id->CurrentValue = HtmlDecode($this->javascript_id->CurrentValue);
        }
        $this->javascript_id->EditValue = $this->javascript_id->CurrentValue;
        $this->javascript_id->PlaceHolder = RemoveHtml($this->javascript_id->caption());

        // file_name
        $this->file_name->EditAttrs["class"] = "form-control";
        $this->file_name->EditCustomAttributes = "";
        if (!$this->file_name->Raw) {
            $this->file_name->CurrentValue = HtmlDecode($this->file_name->CurrentValue);
        }
        $this->file_name->EditValue = $this->file_name->CurrentValue;
        $this->file_name->PlaceHolder = RemoveHtml($this->file_name->caption());

        // menu_name
        $this->menu_name->EditAttrs["class"] = "form-control";
        $this->menu_name->EditCustomAttributes = "";
        if (!$this->menu_name->Raw) {
            $this->menu_name->CurrentValue = HtmlDecode($this->menu_name->CurrentValue);
        }
        $this->menu_name->EditValue = $this->menu_name->CurrentValue;
        $this->menu_name->PlaceHolder = RemoveHtml($this->menu_name->caption());

        // isactive
        $this->isactive->EditAttrs["class"] = "form-control";
        $this->isactive->EditCustomAttributes = "";
        if (!$this->isactive->Raw) {
            $this->isactive->CurrentValue = HtmlDecode($this->isactive->CurrentValue);
        }
        $this->isactive->EditValue = $this->isactive->CurrentValue;
        $this->isactive->PlaceHolder = RemoveHtml($this->isactive->caption());

        // menu_type
        $this->menu_type->EditAttrs["class"] = "form-control";
        $this->menu_type->EditCustomAttributes = "";
        $this->menu_type->EditValue = $this->menu_type->CurrentValue;
        $this->menu_type->PlaceHolder = RemoveHtml($this->menu_type->caption());

        // header_name
        $this->header_name->EditAttrs["class"] = "form-control";
        $this->header_name->EditCustomAttributes = "";
        if (!$this->header_name->Raw) {
            $this->header_name->CurrentValue = HtmlDecode($this->header_name->CurrentValue);
        }
        $this->header_name->EditValue = $this->header_name->CurrentValue;
        $this->header_name->PlaceHolder = RemoveHtml($this->header_name->caption());

        // isslide
        $this->isslide->EditAttrs["class"] = "form-control";
        $this->isslide->EditCustomAttributes = "";
        if (!$this->isslide->Raw) {
            $this->isslide->CurrentValue = HtmlDecode($this->isslide->CurrentValue);
        }
        $this->isslide->EditValue = $this->isslide->CurrentValue;
        $this->isslide->PlaceHolder = RemoveHtml($this->isslide->caption());

        // timeslide
        $this->timeslide->EditAttrs["class"] = "form-control";
        $this->timeslide->EditCustomAttributes = "";
        $this->timeslide->EditValue = $this->timeslide->CurrentValue;
        $this->timeslide->PlaceHolder = RemoveHtml($this->timeslide->caption());

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
                    $doc->exportCaption($this->MENU_ID);
                    $doc->exportCaption($this->javascript_id);
                    $doc->exportCaption($this->file_name);
                    $doc->exportCaption($this->menu_name);
                    $doc->exportCaption($this->isactive);
                    $doc->exportCaption($this->menu_type);
                    $doc->exportCaption($this->header_name);
                    $doc->exportCaption($this->isslide);
                    $doc->exportCaption($this->timeslide);
                } else {
                    $doc->exportCaption($this->MENU_ID);
                    $doc->exportCaption($this->javascript_id);
                    $doc->exportCaption($this->file_name);
                    $doc->exportCaption($this->menu_name);
                    $doc->exportCaption($this->isactive);
                    $doc->exportCaption($this->menu_type);
                    $doc->exportCaption($this->header_name);
                    $doc->exportCaption($this->isslide);
                    $doc->exportCaption($this->timeslide);
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
                        $doc->exportField($this->MENU_ID);
                        $doc->exportField($this->javascript_id);
                        $doc->exportField($this->file_name);
                        $doc->exportField($this->menu_name);
                        $doc->exportField($this->isactive);
                        $doc->exportField($this->menu_type);
                        $doc->exportField($this->header_name);
                        $doc->exportField($this->isslide);
                        $doc->exportField($this->timeslide);
                    } else {
                        $doc->exportField($this->MENU_ID);
                        $doc->exportField($this->javascript_id);
                        $doc->exportField($this->file_name);
                        $doc->exportField($this->menu_name);
                        $doc->exportField($this->isactive);
                        $doc->exportField($this->menu_type);
                        $doc->exportField($this->header_name);
                        $doc->exportField($this->isslide);
                        $doc->exportField($this->timeslide);
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
