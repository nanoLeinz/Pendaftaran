<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for TARIF_TEMP
 */
class TarifTemp extends DbTable
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
    public $TARIF_ID;
    public $PERDA_ID;
    public $TREAT_ID;
    public $TARIF_NAME;
    public $KODE;
    public $DESCRIPTION;
    public $AMOUNT_PAID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'TARIF_TEMP';
        $this->TableName = 'TARIF_TEMP';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[TARIF_TEMP]";
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

        // TARIF_ID
        $this->TARIF_ID = new DbField('TARIF_TEMP', 'TARIF_TEMP', 'x_TARIF_ID', 'TARIF_ID', '[TARIF_ID]', '[TARIF_ID]', 202, 255, -1, false, '[TARIF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_ID->Sortable = true; // Allow sort
        $this->TARIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_ID->Param, "CustomMsg");
        $this->Fields['TARIF_ID'] = &$this->TARIF_ID;

        // PERDA_ID
        $this->PERDA_ID = new DbField('TARIF_TEMP', 'TARIF_TEMP', 'x_PERDA_ID', 'PERDA_ID', '[PERDA_ID]', '[PERDA_ID]', 202, 255, -1, false, '[PERDA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PERDA_ID->Sortable = true; // Allow sort
        $this->PERDA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PERDA_ID->Param, "CustomMsg");
        $this->Fields['PERDA_ID'] = &$this->PERDA_ID;

        // TREAT_ID
        $this->TREAT_ID = new DbField('TARIF_TEMP', 'TARIF_TEMP', 'x_TREAT_ID', 'TREAT_ID', '[TREAT_ID]', '[TREAT_ID]', 202, 255, -1, false, '[TREAT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREAT_ID->Sortable = true; // Allow sort
        $this->TREAT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREAT_ID->Param, "CustomMsg");
        $this->Fields['TREAT_ID'] = &$this->TREAT_ID;

        // TARIF_NAME
        $this->TARIF_NAME = new DbField('TARIF_TEMP', 'TARIF_TEMP', 'x_TARIF_NAME', 'TARIF_NAME', '[TARIF_NAME]', '[TARIF_NAME]', 202, 255, -1, false, '[TARIF_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_NAME->Sortable = true; // Allow sort
        $this->TARIF_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_NAME->Param, "CustomMsg");
        $this->Fields['TARIF_NAME'] = &$this->TARIF_NAME;

        // KODE
        $this->KODE = new DbField('TARIF_TEMP', 'TARIF_TEMP', 'x_KODE', 'KODE', '[KODE]', '[KODE]', 202, 255, -1, false, '[KODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODE->Sortable = true; // Allow sort
        $this->KODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE->Param, "CustomMsg");
        $this->Fields['KODE'] = &$this->KODE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('TARIF_TEMP', 'TARIF_TEMP', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 202, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // AMOUNT_PAID
        $this->AMOUNT_PAID = new DbField('TARIF_TEMP', 'TARIF_TEMP', 'x_AMOUNT_PAID', 'AMOUNT_PAID', '[AMOUNT_PAID]', '[AMOUNT_PAID]', 202, 255, -1, false, '[AMOUNT_PAID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PAID->Sortable = true; // Allow sort
        $this->AMOUNT_PAID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PAID->Param, "CustomMsg");
        $this->Fields['AMOUNT_PAID'] = &$this->AMOUNT_PAID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[TARIF_TEMP]";
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
        $this->TARIF_ID->DbValue = $row['TARIF_ID'];
        $this->PERDA_ID->DbValue = $row['PERDA_ID'];
        $this->TREAT_ID->DbValue = $row['TREAT_ID'];
        $this->TARIF_NAME->DbValue = $row['TARIF_NAME'];
        $this->KODE->DbValue = $row['KODE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->AMOUNT_PAID->DbValue = $row['AMOUNT_PAID'];
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
        return $_SESSION[$name] ?? GetUrl("TarifTempList");
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
        if ($pageName == "TarifTempView") {
            return $Language->phrase("View");
        } elseif ($pageName == "TarifTempEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "TarifTempAdd") {
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
                return "TarifTempView";
            case Config("API_ADD_ACTION"):
                return "TarifTempAdd";
            case Config("API_EDIT_ACTION"):
                return "TarifTempEdit";
            case Config("API_DELETE_ACTION"):
                return "TarifTempDelete";
            case Config("API_LIST_ACTION"):
                return "TarifTempList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "TarifTempList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TarifTempView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("TarifTempView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "TarifTempAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "TarifTempAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("TarifTempEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("TarifTempAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("TarifTempDelete", $this->getUrlParm());
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
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->PERDA_ID->setDbValue($row['PERDA_ID']);
        $this->TREAT_ID->setDbValue($row['TREAT_ID']);
        $this->TARIF_NAME->setDbValue($row['TARIF_NAME']);
        $this->KODE->setDbValue($row['KODE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // TARIF_ID

        // PERDA_ID

        // TREAT_ID

        // TARIF_NAME

        // KODE

        // DESCRIPTION

        // AMOUNT_PAID

        // TARIF_ID
        $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->ViewCustomAttributes = "";

        // PERDA_ID
        $this->PERDA_ID->ViewValue = $this->PERDA_ID->CurrentValue;
        $this->PERDA_ID->ViewCustomAttributes = "";

        // TREAT_ID
        $this->TREAT_ID->ViewValue = $this->TREAT_ID->CurrentValue;
        $this->TREAT_ID->ViewCustomAttributes = "";

        // TARIF_NAME
        $this->TARIF_NAME->ViewValue = $this->TARIF_NAME->CurrentValue;
        $this->TARIF_NAME->ViewCustomAttributes = "";

        // KODE
        $this->KODE->ViewValue = $this->KODE->CurrentValue;
        $this->KODE->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->ViewCustomAttributes = "";

        // TARIF_ID
        $this->TARIF_ID->LinkCustomAttributes = "";
        $this->TARIF_ID->HrefValue = "";
        $this->TARIF_ID->TooltipValue = "";

        // PERDA_ID
        $this->PERDA_ID->LinkCustomAttributes = "";
        $this->PERDA_ID->HrefValue = "";
        $this->PERDA_ID->TooltipValue = "";

        // TREAT_ID
        $this->TREAT_ID->LinkCustomAttributes = "";
        $this->TREAT_ID->HrefValue = "";
        $this->TREAT_ID->TooltipValue = "";

        // TARIF_NAME
        $this->TARIF_NAME->LinkCustomAttributes = "";
        $this->TARIF_NAME->HrefValue = "";
        $this->TARIF_NAME->TooltipValue = "";

        // KODE
        $this->KODE->LinkCustomAttributes = "";
        $this->KODE->HrefValue = "";
        $this->KODE->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->LinkCustomAttributes = "";
        $this->AMOUNT_PAID->HrefValue = "";
        $this->AMOUNT_PAID->TooltipValue = "";

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

        // TARIF_ID
        $this->TARIF_ID->EditAttrs["class"] = "form-control";
        $this->TARIF_ID->EditCustomAttributes = "";
        if (!$this->TARIF_ID->Raw) {
            $this->TARIF_ID->CurrentValue = HtmlDecode($this->TARIF_ID->CurrentValue);
        }
        $this->TARIF_ID->EditValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->PlaceHolder = RemoveHtml($this->TARIF_ID->caption());

        // PERDA_ID
        $this->PERDA_ID->EditAttrs["class"] = "form-control";
        $this->PERDA_ID->EditCustomAttributes = "";
        if (!$this->PERDA_ID->Raw) {
            $this->PERDA_ID->CurrentValue = HtmlDecode($this->PERDA_ID->CurrentValue);
        }
        $this->PERDA_ID->EditValue = $this->PERDA_ID->CurrentValue;
        $this->PERDA_ID->PlaceHolder = RemoveHtml($this->PERDA_ID->caption());

        // TREAT_ID
        $this->TREAT_ID->EditAttrs["class"] = "form-control";
        $this->TREAT_ID->EditCustomAttributes = "";
        if (!$this->TREAT_ID->Raw) {
            $this->TREAT_ID->CurrentValue = HtmlDecode($this->TREAT_ID->CurrentValue);
        }
        $this->TREAT_ID->EditValue = $this->TREAT_ID->CurrentValue;
        $this->TREAT_ID->PlaceHolder = RemoveHtml($this->TREAT_ID->caption());

        // TARIF_NAME
        $this->TARIF_NAME->EditAttrs["class"] = "form-control";
        $this->TARIF_NAME->EditCustomAttributes = "";
        if (!$this->TARIF_NAME->Raw) {
            $this->TARIF_NAME->CurrentValue = HtmlDecode($this->TARIF_NAME->CurrentValue);
        }
        $this->TARIF_NAME->EditValue = $this->TARIF_NAME->CurrentValue;
        $this->TARIF_NAME->PlaceHolder = RemoveHtml($this->TARIF_NAME->caption());

        // KODE
        $this->KODE->EditAttrs["class"] = "form-control";
        $this->KODE->EditCustomAttributes = "";
        if (!$this->KODE->Raw) {
            $this->KODE->CurrentValue = HtmlDecode($this->KODE->CurrentValue);
        }
        $this->KODE->EditValue = $this->KODE->CurrentValue;
        $this->KODE->PlaceHolder = RemoveHtml($this->KODE->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // AMOUNT_PAID
        $this->AMOUNT_PAID->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PAID->EditCustomAttributes = "";
        if (!$this->AMOUNT_PAID->Raw) {
            $this->AMOUNT_PAID->CurrentValue = HtmlDecode($this->AMOUNT_PAID->CurrentValue);
        }
        $this->AMOUNT_PAID->EditValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->PlaceHolder = RemoveHtml($this->AMOUNT_PAID->caption());

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
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->PERDA_ID);
                    $doc->exportCaption($this->TREAT_ID);
                    $doc->exportCaption($this->TARIF_NAME);
                    $doc->exportCaption($this->KODE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->AMOUNT_PAID);
                } else {
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->PERDA_ID);
                    $doc->exportCaption($this->TREAT_ID);
                    $doc->exportCaption($this->TARIF_NAME);
                    $doc->exportCaption($this->KODE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->AMOUNT_PAID);
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
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->PERDA_ID);
                        $doc->exportField($this->TREAT_ID);
                        $doc->exportField($this->TARIF_NAME);
                        $doc->exportField($this->KODE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->AMOUNT_PAID);
                    } else {
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->PERDA_ID);
                        $doc->exportField($this->TREAT_ID);
                        $doc->exportField($this->TARIF_NAME);
                        $doc->exportField($this->KODE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->AMOUNT_PAID);
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
