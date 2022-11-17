<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for DIAGNOSA1
 */
class Diagnosa1 extends DbTable
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
    public $DTYPE;
    public $DIAGNOSA_ID;
    public $NAME_OF_DIAGNOSA;
    public $OTHER_ID;
    public $OTHER_ID2;
    public $ISMENULAR;
    public $ENGLISH_DIAGNOSA;
    public $issurveylans;
    public $dtd;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'DIAGNOSA1';
        $this->TableName = 'DIAGNOSA1';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[DIAGNOSA1]";
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

        // DTYPE
        $this->DTYPE = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_DTYPE', 'DTYPE', '[DTYPE]', '[DTYPE]', 200, 5, -1, false, '[DTYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DTYPE->Nullable = false; // NOT NULL field
        $this->DTYPE->Required = true; // Required field
        $this->DTYPE->Sortable = true; // Allow sort
        $this->DTYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DTYPE->Param, "CustomMsg");
        $this->Fields['DTYPE'] = &$this->DTYPE;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 50, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID->Nullable = false; // NOT NULL field
        $this->DIAGNOSA_ID->Required = true; // Required field
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // NAME_OF_DIAGNOSA
        $this->NAME_OF_DIAGNOSA = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_NAME_OF_DIAGNOSA', 'NAME_OF_DIAGNOSA', '[NAME_OF_DIAGNOSA]', '[NAME_OF_DIAGNOSA]', 200, 100, -1, false, '[NAME_OF_DIAGNOSA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_OF_DIAGNOSA->Sortable = true; // Allow sort
        $this->NAME_OF_DIAGNOSA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_OF_DIAGNOSA->Param, "CustomMsg");
        $this->Fields['NAME_OF_DIAGNOSA'] = &$this->NAME_OF_DIAGNOSA;

        // OTHER_ID
        $this->OTHER_ID = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_OTHER_ID', 'OTHER_ID', '[OTHER_ID]', '[OTHER_ID]', 200, 50, -1, false, '[OTHER_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_ID->Sortable = true; // Allow sort
        $this->OTHER_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_ID->Param, "CustomMsg");
        $this->Fields['OTHER_ID'] = &$this->OTHER_ID;

        // OTHER_ID2
        $this->OTHER_ID2 = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_OTHER_ID2', 'OTHER_ID2', '[OTHER_ID2]', '[OTHER_ID2]', 200, 50, -1, false, '[OTHER_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_ID2->Sortable = true; // Allow sort
        $this->OTHER_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_ID2->Param, "CustomMsg");
        $this->Fields['OTHER_ID2'] = &$this->OTHER_ID2;

        // ISMENULAR
        $this->ISMENULAR = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_ISMENULAR', 'ISMENULAR', '[ISMENULAR]', '[ISMENULAR]', 129, 1, -1, false, '[ISMENULAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISMENULAR->Sortable = true; // Allow sort
        $this->ISMENULAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISMENULAR->Param, "CustomMsg");
        $this->Fields['ISMENULAR'] = &$this->ISMENULAR;

        // ENGLISH_DIAGNOSA
        $this->ENGLISH_DIAGNOSA = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_ENGLISH_DIAGNOSA', 'ENGLISH_DIAGNOSA', '[ENGLISH_DIAGNOSA]', '[ENGLISH_DIAGNOSA]', 200, 100, -1, false, '[ENGLISH_DIAGNOSA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ENGLISH_DIAGNOSA->Sortable = true; // Allow sort
        $this->ENGLISH_DIAGNOSA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ENGLISH_DIAGNOSA->Param, "CustomMsg");
        $this->Fields['ENGLISH_DIAGNOSA'] = &$this->ENGLISH_DIAGNOSA;

        // issurveylans
        $this->issurveylans = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_issurveylans', 'issurveylans', '[issurveylans]', '[issurveylans]', 200, 1, -1, false, '[issurveylans]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->issurveylans->Sortable = true; // Allow sort
        $this->issurveylans->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->issurveylans->Param, "CustomMsg");
        $this->Fields['issurveylans'] = &$this->issurveylans;

        // dtd
        $this->dtd = new DbField('DIAGNOSA1', 'DIAGNOSA1', 'x_dtd', 'dtd', '[dtd]', '[dtd]', 200, 250, -1, false, '[dtd]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->dtd->Sortable = true; // Allow sort
        $this->dtd->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->dtd->Param, "CustomMsg");
        $this->Fields['dtd'] = &$this->dtd;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[DIAGNOSA1]";
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
        $this->DTYPE->DbValue = $row['DTYPE'];
        $this->DIAGNOSA_ID->DbValue = $row['DIAGNOSA_ID'];
        $this->NAME_OF_DIAGNOSA->DbValue = $row['NAME_OF_DIAGNOSA'];
        $this->OTHER_ID->DbValue = $row['OTHER_ID'];
        $this->OTHER_ID2->DbValue = $row['OTHER_ID2'];
        $this->ISMENULAR->DbValue = $row['ISMENULAR'];
        $this->ENGLISH_DIAGNOSA->DbValue = $row['ENGLISH_DIAGNOSA'];
        $this->issurveylans->DbValue = $row['issurveylans'];
        $this->dtd->DbValue = $row['dtd'];
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
        return $_SESSION[$name] ?? GetUrl("Diagnosa1List");
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
        if ($pageName == "Diagnosa1View") {
            return $Language->phrase("View");
        } elseif ($pageName == "Diagnosa1Edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "Diagnosa1Add") {
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
                return "Diagnosa1View";
            case Config("API_ADD_ACTION"):
                return "Diagnosa1Add";
            case Config("API_EDIT_ACTION"):
                return "Diagnosa1Edit";
            case Config("API_DELETE_ACTION"):
                return "Diagnosa1Delete";
            case Config("API_LIST_ACTION"):
                return "Diagnosa1List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "Diagnosa1List";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("Diagnosa1View", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("Diagnosa1View", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "Diagnosa1Add?" . $this->getUrlParm($parm);
        } else {
            $url = "Diagnosa1Add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("Diagnosa1Edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("Diagnosa1Add", $this->getUrlParm($parm));
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
        return $this->keyUrl("Diagnosa1Delete", $this->getUrlParm());
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
        $this->DTYPE->setDbValue($row['DTYPE']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->NAME_OF_DIAGNOSA->setDbValue($row['NAME_OF_DIAGNOSA']);
        $this->OTHER_ID->setDbValue($row['OTHER_ID']);
        $this->OTHER_ID2->setDbValue($row['OTHER_ID2']);
        $this->ISMENULAR->setDbValue($row['ISMENULAR']);
        $this->ENGLISH_DIAGNOSA->setDbValue($row['ENGLISH_DIAGNOSA']);
        $this->issurveylans->setDbValue($row['issurveylans']);
        $this->dtd->setDbValue($row['dtd']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // DTYPE

        // DIAGNOSA_ID

        // NAME_OF_DIAGNOSA

        // OTHER_ID

        // OTHER_ID2

        // ISMENULAR

        // ENGLISH_DIAGNOSA

        // issurveylans

        // dtd

        // DTYPE
        $this->DTYPE->ViewValue = $this->DTYPE->CurrentValue;
        $this->DTYPE->ViewCustomAttributes = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->ViewCustomAttributes = "";

        // NAME_OF_DIAGNOSA
        $this->NAME_OF_DIAGNOSA->ViewValue = $this->NAME_OF_DIAGNOSA->CurrentValue;
        $this->NAME_OF_DIAGNOSA->ViewCustomAttributes = "";

        // OTHER_ID
        $this->OTHER_ID->ViewValue = $this->OTHER_ID->CurrentValue;
        $this->OTHER_ID->ViewCustomAttributes = "";

        // OTHER_ID2
        $this->OTHER_ID2->ViewValue = $this->OTHER_ID2->CurrentValue;
        $this->OTHER_ID2->ViewCustomAttributes = "";

        // ISMENULAR
        $this->ISMENULAR->ViewValue = $this->ISMENULAR->CurrentValue;
        $this->ISMENULAR->ViewCustomAttributes = "";

        // ENGLISH_DIAGNOSA
        $this->ENGLISH_DIAGNOSA->ViewValue = $this->ENGLISH_DIAGNOSA->CurrentValue;
        $this->ENGLISH_DIAGNOSA->ViewCustomAttributes = "";

        // issurveylans
        $this->issurveylans->ViewValue = $this->issurveylans->CurrentValue;
        $this->issurveylans->ViewCustomAttributes = "";

        // dtd
        $this->dtd->ViewValue = $this->dtd->CurrentValue;
        $this->dtd->ViewCustomAttributes = "";

        // DTYPE
        $this->DTYPE->LinkCustomAttributes = "";
        $this->DTYPE->HrefValue = "";
        $this->DTYPE->TooltipValue = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID->HrefValue = "";
        $this->DIAGNOSA_ID->TooltipValue = "";

        // NAME_OF_DIAGNOSA
        $this->NAME_OF_DIAGNOSA->LinkCustomAttributes = "";
        $this->NAME_OF_DIAGNOSA->HrefValue = "";
        $this->NAME_OF_DIAGNOSA->TooltipValue = "";

        // OTHER_ID
        $this->OTHER_ID->LinkCustomAttributes = "";
        $this->OTHER_ID->HrefValue = "";
        $this->OTHER_ID->TooltipValue = "";

        // OTHER_ID2
        $this->OTHER_ID2->LinkCustomAttributes = "";
        $this->OTHER_ID2->HrefValue = "";
        $this->OTHER_ID2->TooltipValue = "";

        // ISMENULAR
        $this->ISMENULAR->LinkCustomAttributes = "";
        $this->ISMENULAR->HrefValue = "";
        $this->ISMENULAR->TooltipValue = "";

        // ENGLISH_DIAGNOSA
        $this->ENGLISH_DIAGNOSA->LinkCustomAttributes = "";
        $this->ENGLISH_DIAGNOSA->HrefValue = "";
        $this->ENGLISH_DIAGNOSA->TooltipValue = "";

        // issurveylans
        $this->issurveylans->LinkCustomAttributes = "";
        $this->issurveylans->HrefValue = "";
        $this->issurveylans->TooltipValue = "";

        // dtd
        $this->dtd->LinkCustomAttributes = "";
        $this->dtd->HrefValue = "";
        $this->dtd->TooltipValue = "";

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

        // DTYPE
        $this->DTYPE->EditAttrs["class"] = "form-control";
        $this->DTYPE->EditCustomAttributes = "";
        if (!$this->DTYPE->Raw) {
            $this->DTYPE->CurrentValue = HtmlDecode($this->DTYPE->CurrentValue);
        }
        $this->DTYPE->EditValue = $this->DTYPE->CurrentValue;
        $this->DTYPE->PlaceHolder = RemoveHtml($this->DTYPE->caption());

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID->Raw) {
            $this->DIAGNOSA_ID->CurrentValue = HtmlDecode($this->DIAGNOSA_ID->CurrentValue);
        }
        $this->DIAGNOSA_ID->EditValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

        // NAME_OF_DIAGNOSA
        $this->NAME_OF_DIAGNOSA->EditAttrs["class"] = "form-control";
        $this->NAME_OF_DIAGNOSA->EditCustomAttributes = "";
        if (!$this->NAME_OF_DIAGNOSA->Raw) {
            $this->NAME_OF_DIAGNOSA->CurrentValue = HtmlDecode($this->NAME_OF_DIAGNOSA->CurrentValue);
        }
        $this->NAME_OF_DIAGNOSA->EditValue = $this->NAME_OF_DIAGNOSA->CurrentValue;
        $this->NAME_OF_DIAGNOSA->PlaceHolder = RemoveHtml($this->NAME_OF_DIAGNOSA->caption());

        // OTHER_ID
        $this->OTHER_ID->EditAttrs["class"] = "form-control";
        $this->OTHER_ID->EditCustomAttributes = "";
        if (!$this->OTHER_ID->Raw) {
            $this->OTHER_ID->CurrentValue = HtmlDecode($this->OTHER_ID->CurrentValue);
        }
        $this->OTHER_ID->EditValue = $this->OTHER_ID->CurrentValue;
        $this->OTHER_ID->PlaceHolder = RemoveHtml($this->OTHER_ID->caption());

        // OTHER_ID2
        $this->OTHER_ID2->EditAttrs["class"] = "form-control";
        $this->OTHER_ID2->EditCustomAttributes = "";
        if (!$this->OTHER_ID2->Raw) {
            $this->OTHER_ID2->CurrentValue = HtmlDecode($this->OTHER_ID2->CurrentValue);
        }
        $this->OTHER_ID2->EditValue = $this->OTHER_ID2->CurrentValue;
        $this->OTHER_ID2->PlaceHolder = RemoveHtml($this->OTHER_ID2->caption());

        // ISMENULAR
        $this->ISMENULAR->EditAttrs["class"] = "form-control";
        $this->ISMENULAR->EditCustomAttributes = "";
        if (!$this->ISMENULAR->Raw) {
            $this->ISMENULAR->CurrentValue = HtmlDecode($this->ISMENULAR->CurrentValue);
        }
        $this->ISMENULAR->EditValue = $this->ISMENULAR->CurrentValue;
        $this->ISMENULAR->PlaceHolder = RemoveHtml($this->ISMENULAR->caption());

        // ENGLISH_DIAGNOSA
        $this->ENGLISH_DIAGNOSA->EditAttrs["class"] = "form-control";
        $this->ENGLISH_DIAGNOSA->EditCustomAttributes = "";
        if (!$this->ENGLISH_DIAGNOSA->Raw) {
            $this->ENGLISH_DIAGNOSA->CurrentValue = HtmlDecode($this->ENGLISH_DIAGNOSA->CurrentValue);
        }
        $this->ENGLISH_DIAGNOSA->EditValue = $this->ENGLISH_DIAGNOSA->CurrentValue;
        $this->ENGLISH_DIAGNOSA->PlaceHolder = RemoveHtml($this->ENGLISH_DIAGNOSA->caption());

        // issurveylans
        $this->issurveylans->EditAttrs["class"] = "form-control";
        $this->issurveylans->EditCustomAttributes = "";
        if (!$this->issurveylans->Raw) {
            $this->issurveylans->CurrentValue = HtmlDecode($this->issurveylans->CurrentValue);
        }
        $this->issurveylans->EditValue = $this->issurveylans->CurrentValue;
        $this->issurveylans->PlaceHolder = RemoveHtml($this->issurveylans->caption());

        // dtd
        $this->dtd->EditAttrs["class"] = "form-control";
        $this->dtd->EditCustomAttributes = "";
        if (!$this->dtd->Raw) {
            $this->dtd->CurrentValue = HtmlDecode($this->dtd->CurrentValue);
        }
        $this->dtd->EditValue = $this->dtd->CurrentValue;
        $this->dtd->PlaceHolder = RemoveHtml($this->dtd->caption());

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
                    $doc->exportCaption($this->DTYPE);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->NAME_OF_DIAGNOSA);
                    $doc->exportCaption($this->OTHER_ID);
                    $doc->exportCaption($this->OTHER_ID2);
                    $doc->exportCaption($this->ISMENULAR);
                    $doc->exportCaption($this->ENGLISH_DIAGNOSA);
                    $doc->exportCaption($this->issurveylans);
                    $doc->exportCaption($this->dtd);
                } else {
                    $doc->exportCaption($this->DTYPE);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->NAME_OF_DIAGNOSA);
                    $doc->exportCaption($this->OTHER_ID);
                    $doc->exportCaption($this->OTHER_ID2);
                    $doc->exportCaption($this->ISMENULAR);
                    $doc->exportCaption($this->ENGLISH_DIAGNOSA);
                    $doc->exportCaption($this->issurveylans);
                    $doc->exportCaption($this->dtd);
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
                        $doc->exportField($this->DTYPE);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->NAME_OF_DIAGNOSA);
                        $doc->exportField($this->OTHER_ID);
                        $doc->exportField($this->OTHER_ID2);
                        $doc->exportField($this->ISMENULAR);
                        $doc->exportField($this->ENGLISH_DIAGNOSA);
                        $doc->exportField($this->issurveylans);
                        $doc->exportField($this->dtd);
                    } else {
                        $doc->exportField($this->DTYPE);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->NAME_OF_DIAGNOSA);
                        $doc->exportField($this->OTHER_ID);
                        $doc->exportField($this->OTHER_ID2);
                        $doc->exportField($this->ISMENULAR);
                        $doc->exportField($this->ENGLISH_DIAGNOSA);
                        $doc->exportField($this->issurveylans);
                        $doc->exportField($this->dtd);
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
