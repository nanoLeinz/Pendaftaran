<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for CLASS
 */
class Class2 extends DbTable
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
    public $CLASS_ID;
    public $NAME_OF_CLASS;
    public $OTHER_ID;
    public $KDKELASV;
    public $KODEKELAS;
    public $SISKODEKELAS;
    public $SISKODERAWAT;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'CLASS2';
        $this->TableName = 'CLASS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[CLASS]";
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

        // CLASS_ID
        $this->CLASS_ID = new DbField('CLASS2', 'CLASS', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID->IsPrimaryKey = true; // Primary key field
        $this->CLASS_ID->Nullable = false; // NOT NULL field
        $this->CLASS_ID->Required = true; // Required field
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS = new DbField('CLASS2', 'CLASS', 'x_NAME_OF_CLASS', 'NAME_OF_CLASS', '[NAME_OF_CLASS]', '[NAME_OF_CLASS]', 200, 20, -1, false, '[NAME_OF_CLASS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_OF_CLASS->Sortable = true; // Allow sort
        $this->NAME_OF_CLASS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_OF_CLASS->Param, "CustomMsg");
        $this->Fields['NAME_OF_CLASS'] = &$this->NAME_OF_CLASS;

        // OTHER_ID
        $this->OTHER_ID = new DbField('CLASS2', 'CLASS', 'x_OTHER_ID', 'OTHER_ID', '[OTHER_ID]', '[OTHER_ID]', 200, 2, -1, false, '[OTHER_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_ID->Sortable = true; // Allow sort
        $this->OTHER_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_ID->Param, "CustomMsg");
        $this->Fields['OTHER_ID'] = &$this->OTHER_ID;

        // KDKELASV
        $this->KDKELASV = new DbField('CLASS2', 'CLASS', 'x_KDKELASV', 'KDKELASV', '[KDKELASV]', '[KDKELASV]', 129, 3, -1, false, '[KDKELASV]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KDKELASV->Sortable = true; // Allow sort
        $this->KDKELASV->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KDKELASV->Param, "CustomMsg");
        $this->Fields['KDKELASV'] = &$this->KDKELASV;

        // KODEKELAS
        $this->KODEKELAS = new DbField('CLASS2', 'CLASS', 'x_KODEKELAS', 'KODEKELAS', '[KODEKELAS]', '[KODEKELAS]', 200, 5, -1, false, '[KODEKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODEKELAS->Sortable = true; // Allow sort
        $this->KODEKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODEKELAS->Param, "CustomMsg");
        $this->Fields['KODEKELAS'] = &$this->KODEKELAS;

        // SISKODEKELAS
        $this->SISKODEKELAS = new DbField('CLASS2', 'CLASS', 'x_SISKODEKELAS', 'SISKODEKELAS', '[SISKODEKELAS]', '[SISKODEKELAS]', 200, 10, -1, false, '[SISKODEKELAS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SISKODEKELAS->Sortable = true; // Allow sort
        $this->SISKODEKELAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SISKODEKELAS->Param, "CustomMsg");
        $this->Fields['SISKODEKELAS'] = &$this->SISKODEKELAS;

        // SISKODERAWAT
        $this->SISKODERAWAT = new DbField('CLASS2', 'CLASS', 'x_SISKODERAWAT', 'SISKODERAWAT', '[SISKODERAWAT]', '[SISKODERAWAT]', 200, 10, -1, false, '[SISKODERAWAT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SISKODERAWAT->Sortable = true; // Allow sort
        $this->SISKODERAWAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SISKODERAWAT->Param, "CustomMsg");
        $this->Fields['SISKODERAWAT'] = &$this->SISKODERAWAT;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[CLASS]";
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
            if (array_key_exists('CLASS_ID', $rs)) {
                AddFilter($where, QuotedName('CLASS_ID', $this->Dbid) . '=' . QuotedValue($rs['CLASS_ID'], $this->CLASS_ID->DataType, $this->Dbid));
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
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->NAME_OF_CLASS->DbValue = $row['NAME_OF_CLASS'];
        $this->OTHER_ID->DbValue = $row['OTHER_ID'];
        $this->KDKELASV->DbValue = $row['KDKELASV'];
        $this->KODEKELAS->DbValue = $row['KODEKELAS'];
        $this->SISKODEKELAS->DbValue = $row['SISKODEKELAS'];
        $this->SISKODERAWAT->DbValue = $row['SISKODERAWAT'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[CLASS_ID] = @CLASS_ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->CLASS_ID->CurrentValue : $this->CLASS_ID->OldValue;
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
                $this->CLASS_ID->CurrentValue = $keys[0];
            } else {
                $this->CLASS_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('CLASS_ID', $row) ? $row['CLASS_ID'] : null;
        } else {
            $val = $this->CLASS_ID->OldValue !== null ? $this->CLASS_ID->OldValue : $this->CLASS_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@CLASS_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("Class2List");
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
        if ($pageName == "Class2View") {
            return $Language->phrase("View");
        } elseif ($pageName == "Class2Edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "Class2Add") {
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
                return "Class2View";
            case Config("API_ADD_ACTION"):
                return "Class2Add";
            case Config("API_EDIT_ACTION"):
                return "Class2Edit";
            case Config("API_DELETE_ACTION"):
                return "Class2Delete";
            case Config("API_LIST_ACTION"):
                return "Class2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "Class2List";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("Class2View", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("Class2View", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "Class2Add?" . $this->getUrlParm($parm);
        } else {
            $url = "Class2Add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("Class2Edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("Class2Add", $this->getUrlParm($parm));
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
        return $this->keyUrl("Class2Delete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "CLASS_ID:" . JsonEncode($this->CLASS_ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->CLASS_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->CLASS_ID->CurrentValue);
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
            if (($keyValue = Param("CLASS_ID") ?? Route("CLASS_ID")) !== null) {
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
                $this->CLASS_ID->CurrentValue = $key;
            } else {
                $this->CLASS_ID->OldValue = $key;
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
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->NAME_OF_CLASS->setDbValue($row['NAME_OF_CLASS']);
        $this->OTHER_ID->setDbValue($row['OTHER_ID']);
        $this->KDKELASV->setDbValue($row['KDKELASV']);
        $this->KODEKELAS->setDbValue($row['KODEKELAS']);
        $this->SISKODEKELAS->setDbValue($row['SISKODEKELAS']);
        $this->SISKODERAWAT->setDbValue($row['SISKODERAWAT']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // CLASS_ID

        // NAME_OF_CLASS

        // OTHER_ID

        // KDKELASV

        // KODEKELAS

        // SISKODEKELAS

        // SISKODERAWAT

        // CLASS_ID
        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID->ViewCustomAttributes = "";

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS->ViewValue = $this->NAME_OF_CLASS->CurrentValue;
        $this->NAME_OF_CLASS->ViewCustomAttributes = "";

        // OTHER_ID
        $this->OTHER_ID->ViewValue = $this->OTHER_ID->CurrentValue;
        $this->OTHER_ID->ViewCustomAttributes = "";

        // KDKELASV
        $this->KDKELASV->ViewValue = $this->KDKELASV->CurrentValue;
        $this->KDKELASV->ViewCustomAttributes = "";

        // KODEKELAS
        $this->KODEKELAS->ViewValue = $this->KODEKELAS->CurrentValue;
        $this->KODEKELAS->ViewCustomAttributes = "";

        // SISKODEKELAS
        $this->SISKODEKELAS->ViewValue = $this->SISKODEKELAS->CurrentValue;
        $this->SISKODEKELAS->ViewCustomAttributes = "";

        // SISKODERAWAT
        $this->SISKODERAWAT->ViewValue = $this->SISKODERAWAT->CurrentValue;
        $this->SISKODERAWAT->ViewCustomAttributes = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS->LinkCustomAttributes = "";
        $this->NAME_OF_CLASS->HrefValue = "";
        $this->NAME_OF_CLASS->TooltipValue = "";

        // OTHER_ID
        $this->OTHER_ID->LinkCustomAttributes = "";
        $this->OTHER_ID->HrefValue = "";
        $this->OTHER_ID->TooltipValue = "";

        // KDKELASV
        $this->KDKELASV->LinkCustomAttributes = "";
        $this->KDKELASV->HrefValue = "";
        $this->KDKELASV->TooltipValue = "";

        // KODEKELAS
        $this->KODEKELAS->LinkCustomAttributes = "";
        $this->KODEKELAS->HrefValue = "";
        $this->KODEKELAS->TooltipValue = "";

        // SISKODEKELAS
        $this->SISKODEKELAS->LinkCustomAttributes = "";
        $this->SISKODEKELAS->HrefValue = "";
        $this->SISKODEKELAS->TooltipValue = "";

        // SISKODERAWAT
        $this->SISKODERAWAT->LinkCustomAttributes = "";
        $this->SISKODERAWAT->HrefValue = "";
        $this->SISKODERAWAT->TooltipValue = "";

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

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->EditValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // NAME_OF_CLASS
        $this->NAME_OF_CLASS->EditAttrs["class"] = "form-control";
        $this->NAME_OF_CLASS->EditCustomAttributes = "";
        if (!$this->NAME_OF_CLASS->Raw) {
            $this->NAME_OF_CLASS->CurrentValue = HtmlDecode($this->NAME_OF_CLASS->CurrentValue);
        }
        $this->NAME_OF_CLASS->EditValue = $this->NAME_OF_CLASS->CurrentValue;
        $this->NAME_OF_CLASS->PlaceHolder = RemoveHtml($this->NAME_OF_CLASS->caption());

        // OTHER_ID
        $this->OTHER_ID->EditAttrs["class"] = "form-control";
        $this->OTHER_ID->EditCustomAttributes = "";
        if (!$this->OTHER_ID->Raw) {
            $this->OTHER_ID->CurrentValue = HtmlDecode($this->OTHER_ID->CurrentValue);
        }
        $this->OTHER_ID->EditValue = $this->OTHER_ID->CurrentValue;
        $this->OTHER_ID->PlaceHolder = RemoveHtml($this->OTHER_ID->caption());

        // KDKELASV
        $this->KDKELASV->EditAttrs["class"] = "form-control";
        $this->KDKELASV->EditCustomAttributes = "";
        if (!$this->KDKELASV->Raw) {
            $this->KDKELASV->CurrentValue = HtmlDecode($this->KDKELASV->CurrentValue);
        }
        $this->KDKELASV->EditValue = $this->KDKELASV->CurrentValue;
        $this->KDKELASV->PlaceHolder = RemoveHtml($this->KDKELASV->caption());

        // KODEKELAS
        $this->KODEKELAS->EditAttrs["class"] = "form-control";
        $this->KODEKELAS->EditCustomAttributes = "";
        if (!$this->KODEKELAS->Raw) {
            $this->KODEKELAS->CurrentValue = HtmlDecode($this->KODEKELAS->CurrentValue);
        }
        $this->KODEKELAS->EditValue = $this->KODEKELAS->CurrentValue;
        $this->KODEKELAS->PlaceHolder = RemoveHtml($this->KODEKELAS->caption());

        // SISKODEKELAS
        $this->SISKODEKELAS->EditAttrs["class"] = "form-control";
        $this->SISKODEKELAS->EditCustomAttributes = "";
        if (!$this->SISKODEKELAS->Raw) {
            $this->SISKODEKELAS->CurrentValue = HtmlDecode($this->SISKODEKELAS->CurrentValue);
        }
        $this->SISKODEKELAS->EditValue = $this->SISKODEKELAS->CurrentValue;
        $this->SISKODEKELAS->PlaceHolder = RemoveHtml($this->SISKODEKELAS->caption());

        // SISKODERAWAT
        $this->SISKODERAWAT->EditAttrs["class"] = "form-control";
        $this->SISKODERAWAT->EditCustomAttributes = "";
        if (!$this->SISKODERAWAT->Raw) {
            $this->SISKODERAWAT->CurrentValue = HtmlDecode($this->SISKODERAWAT->CurrentValue);
        }
        $this->SISKODERAWAT->EditValue = $this->SISKODERAWAT->CurrentValue;
        $this->SISKODERAWAT->PlaceHolder = RemoveHtml($this->SISKODERAWAT->caption());

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
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->NAME_OF_CLASS);
                    $doc->exportCaption($this->OTHER_ID);
                    $doc->exportCaption($this->KDKELASV);
                    $doc->exportCaption($this->KODEKELAS);
                    $doc->exportCaption($this->SISKODEKELAS);
                    $doc->exportCaption($this->SISKODERAWAT);
                } else {
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->NAME_OF_CLASS);
                    $doc->exportCaption($this->OTHER_ID);
                    $doc->exportCaption($this->KDKELASV);
                    $doc->exportCaption($this->KODEKELAS);
                    $doc->exportCaption($this->SISKODEKELAS);
                    $doc->exportCaption($this->SISKODERAWAT);
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
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->NAME_OF_CLASS);
                        $doc->exportField($this->OTHER_ID);
                        $doc->exportField($this->KDKELASV);
                        $doc->exportField($this->KODEKELAS);
                        $doc->exportField($this->SISKODEKELAS);
                        $doc->exportField($this->SISKODERAWAT);
                    } else {
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->NAME_OF_CLASS);
                        $doc->exportField($this->OTHER_ID);
                        $doc->exportField($this->KDKELASV);
                        $doc->exportField($this->KODEKELAS);
                        $doc->exportField($this->SISKODEKELAS);
                        $doc->exportField($this->SISKODERAWAT);
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
