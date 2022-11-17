<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for RANAP
 */
class Ranap extends DbTable
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
    public $CM;
    public $TANGGAL_MASUK;
    public $TANGGAL_KELUAR;
    public $INACBG;
    public $DESKRIPSI;
    public $TARIFKLAIM;
    public $NAMA;
    public $DPJP;
    public $SEP;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'RANAP';
        $this->TableName = 'RANAP';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[RANAP]";
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

        // CM
        $this->CM = new DbField('RANAP', 'RANAP', 'x_CM', 'CM', '[CM]', '[CM]', 200, 25, -1, false, '[CM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CM->Sortable = true; // Allow sort
        $this->CM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CM->Param, "CustomMsg");
        $this->Fields['CM'] = &$this->CM;

        // TANGGAL_MASUK
        $this->TANGGAL_MASUK = new DbField('RANAP', 'RANAP', 'x_TANGGAL_MASUK', 'TANGGAL_MASUK', '[TANGGAL_MASUK]', CastDateFieldForLike("[TANGGAL_MASUK]", 0, "DB"), 135, 8, 0, false, '[TANGGAL_MASUK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TANGGAL_MASUK->Sortable = true; // Allow sort
        $this->TANGGAL_MASUK->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TANGGAL_MASUK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TANGGAL_MASUK->Param, "CustomMsg");
        $this->Fields['TANGGAL_MASUK'] = &$this->TANGGAL_MASUK;

        // TANGGAL_KELUAR
        $this->TANGGAL_KELUAR = new DbField('RANAP', 'RANAP', 'x_TANGGAL_KELUAR', 'TANGGAL_KELUAR', '[TANGGAL_KELUAR]', CastDateFieldForLike("[TANGGAL_KELUAR]", 0, "DB"), 135, 8, 0, false, '[TANGGAL_KELUAR]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TANGGAL_KELUAR->Sortable = true; // Allow sort
        $this->TANGGAL_KELUAR->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TANGGAL_KELUAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TANGGAL_KELUAR->Param, "CustomMsg");
        $this->Fields['TANGGAL_KELUAR'] = &$this->TANGGAL_KELUAR;

        // INACBG
        $this->INACBG = new DbField('RANAP', 'RANAP', 'x_INACBG', 'INACBG', '[INACBG]', CastDateFieldForLike("[INACBG]", 0, "DB"), 135, 8, 0, false, '[INACBG]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INACBG->Sortable = true; // Allow sort
        $this->INACBG->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->INACBG->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INACBG->Param, "CustomMsg");
        $this->Fields['INACBG'] = &$this->INACBG;

        // DESKRIPSI
        $this->DESKRIPSI = new DbField('RANAP', 'RANAP', 'x_DESKRIPSI', 'DESKRIPSI', '[DESKRIPSI]', '[DESKRIPSI]', 200, 250, -1, false, '[DESKRIPSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESKRIPSI->Sortable = true; // Allow sort
        $this->DESKRIPSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESKRIPSI->Param, "CustomMsg");
        $this->Fields['DESKRIPSI'] = &$this->DESKRIPSI;

        // TARIFKLAIM
        $this->TARIFKLAIM = new DbField('RANAP', 'RANAP', 'x_TARIFKLAIM', 'TARIFKLAIM', '[TARIFKLAIM]', 'CAST([TARIFKLAIM] AS NVARCHAR)', 131, 8, -1, false, '[TARIFKLAIM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIFKLAIM->Sortable = true; // Allow sort
        $this->TARIFKLAIM->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->TARIFKLAIM->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->TARIFKLAIM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIFKLAIM->Param, "CustomMsg");
        $this->Fields['TARIFKLAIM'] = &$this->TARIFKLAIM;

        // NAMA
        $this->NAMA = new DbField('RANAP', 'RANAP', 'x_NAMA', 'NAMA', '[NAMA]', '[NAMA]', 200, 100, -1, false, '[NAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA->Sortable = true; // Allow sort
        $this->NAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA->Param, "CustomMsg");
        $this->Fields['NAMA'] = &$this->NAMA;

        // DPJP
        $this->DPJP = new DbField('RANAP', 'RANAP', 'x_DPJP', 'DPJP', '[DPJP]', '[DPJP]', 200, 100, -1, false, '[DPJP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DPJP->Sortable = true; // Allow sort
        $this->DPJP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DPJP->Param, "CustomMsg");
        $this->Fields['DPJP'] = &$this->DPJP;

        // SEP
        $this->SEP = new DbField('RANAP', 'RANAP', 'x_SEP', 'SEP', '[SEP]', '[SEP]', 200, 50, -1, false, '[SEP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SEP->Sortable = true; // Allow sort
        $this->SEP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEP->Param, "CustomMsg");
        $this->Fields['SEP'] = &$this->SEP;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[RANAP]";
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
        $this->CM->DbValue = $row['CM'];
        $this->TANGGAL_MASUK->DbValue = $row['TANGGAL_MASUK'];
        $this->TANGGAL_KELUAR->DbValue = $row['TANGGAL_KELUAR'];
        $this->INACBG->DbValue = $row['INACBG'];
        $this->DESKRIPSI->DbValue = $row['DESKRIPSI'];
        $this->TARIFKLAIM->DbValue = $row['TARIFKLAIM'];
        $this->NAMA->DbValue = $row['NAMA'];
        $this->DPJP->DbValue = $row['DPJP'];
        $this->SEP->DbValue = $row['SEP'];
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
        return $_SESSION[$name] ?? GetUrl("RanapList");
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
        if ($pageName == "RanapView") {
            return $Language->phrase("View");
        } elseif ($pageName == "RanapEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "RanapAdd") {
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
                return "RanapView";
            case Config("API_ADD_ACTION"):
                return "RanapAdd";
            case Config("API_EDIT_ACTION"):
                return "RanapEdit";
            case Config("API_DELETE_ACTION"):
                return "RanapDelete";
            case Config("API_LIST_ACTION"):
                return "RanapList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "RanapList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("RanapView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("RanapView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "RanapAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "RanapAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("RanapEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("RanapAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("RanapDelete", $this->getUrlParm());
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
        $this->CM->setDbValue($row['CM']);
        $this->TANGGAL_MASUK->setDbValue($row['TANGGAL_MASUK']);
        $this->TANGGAL_KELUAR->setDbValue($row['TANGGAL_KELUAR']);
        $this->INACBG->setDbValue($row['INACBG']);
        $this->DESKRIPSI->setDbValue($row['DESKRIPSI']);
        $this->TARIFKLAIM->setDbValue($row['TARIFKLAIM']);
        $this->NAMA->setDbValue($row['NAMA']);
        $this->DPJP->setDbValue($row['DPJP']);
        $this->SEP->setDbValue($row['SEP']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // CM

        // TANGGAL_MASUK

        // TANGGAL_KELUAR

        // INACBG

        // DESKRIPSI

        // TARIFKLAIM

        // NAMA

        // DPJP

        // SEP

        // CM
        $this->CM->ViewValue = $this->CM->CurrentValue;
        $this->CM->ViewCustomAttributes = "";

        // TANGGAL_MASUK
        $this->TANGGAL_MASUK->ViewValue = $this->TANGGAL_MASUK->CurrentValue;
        $this->TANGGAL_MASUK->ViewValue = FormatDateTime($this->TANGGAL_MASUK->ViewValue, 0);
        $this->TANGGAL_MASUK->ViewCustomAttributes = "";

        // TANGGAL_KELUAR
        $this->TANGGAL_KELUAR->ViewValue = $this->TANGGAL_KELUAR->CurrentValue;
        $this->TANGGAL_KELUAR->ViewValue = FormatDateTime($this->TANGGAL_KELUAR->ViewValue, 0);
        $this->TANGGAL_KELUAR->ViewCustomAttributes = "";

        // INACBG
        $this->INACBG->ViewValue = $this->INACBG->CurrentValue;
        $this->INACBG->ViewValue = FormatDateTime($this->INACBG->ViewValue, 0);
        $this->INACBG->ViewCustomAttributes = "";

        // DESKRIPSI
        $this->DESKRIPSI->ViewValue = $this->DESKRIPSI->CurrentValue;
        $this->DESKRIPSI->ViewCustomAttributes = "";

        // TARIFKLAIM
        $this->TARIFKLAIM->ViewValue = $this->TARIFKLAIM->CurrentValue;
        $this->TARIFKLAIM->ViewValue = FormatNumber($this->TARIFKLAIM->ViewValue, 2, -2, -2, -2);
        $this->TARIFKLAIM->ViewCustomAttributes = "";

        // NAMA
        $this->NAMA->ViewValue = $this->NAMA->CurrentValue;
        $this->NAMA->ViewCustomAttributes = "";

        // DPJP
        $this->DPJP->ViewValue = $this->DPJP->CurrentValue;
        $this->DPJP->ViewCustomAttributes = "";

        // SEP
        $this->SEP->ViewValue = $this->SEP->CurrentValue;
        $this->SEP->ViewCustomAttributes = "";

        // CM
        $this->CM->LinkCustomAttributes = "";
        $this->CM->HrefValue = "";
        $this->CM->TooltipValue = "";

        // TANGGAL_MASUK
        $this->TANGGAL_MASUK->LinkCustomAttributes = "";
        $this->TANGGAL_MASUK->HrefValue = "";
        $this->TANGGAL_MASUK->TooltipValue = "";

        // TANGGAL_KELUAR
        $this->TANGGAL_KELUAR->LinkCustomAttributes = "";
        $this->TANGGAL_KELUAR->HrefValue = "";
        $this->TANGGAL_KELUAR->TooltipValue = "";

        // INACBG
        $this->INACBG->LinkCustomAttributes = "";
        $this->INACBG->HrefValue = "";
        $this->INACBG->TooltipValue = "";

        // DESKRIPSI
        $this->DESKRIPSI->LinkCustomAttributes = "";
        $this->DESKRIPSI->HrefValue = "";
        $this->DESKRIPSI->TooltipValue = "";

        // TARIFKLAIM
        $this->TARIFKLAIM->LinkCustomAttributes = "";
        $this->TARIFKLAIM->HrefValue = "";
        $this->TARIFKLAIM->TooltipValue = "";

        // NAMA
        $this->NAMA->LinkCustomAttributes = "";
        $this->NAMA->HrefValue = "";
        $this->NAMA->TooltipValue = "";

        // DPJP
        $this->DPJP->LinkCustomAttributes = "";
        $this->DPJP->HrefValue = "";
        $this->DPJP->TooltipValue = "";

        // SEP
        $this->SEP->LinkCustomAttributes = "";
        $this->SEP->HrefValue = "";
        $this->SEP->TooltipValue = "";

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

        // CM
        $this->CM->EditAttrs["class"] = "form-control";
        $this->CM->EditCustomAttributes = "";
        if (!$this->CM->Raw) {
            $this->CM->CurrentValue = HtmlDecode($this->CM->CurrentValue);
        }
        $this->CM->EditValue = $this->CM->CurrentValue;
        $this->CM->PlaceHolder = RemoveHtml($this->CM->caption());

        // TANGGAL_MASUK
        $this->TANGGAL_MASUK->EditAttrs["class"] = "form-control";
        $this->TANGGAL_MASUK->EditCustomAttributes = "";
        $this->TANGGAL_MASUK->EditValue = FormatDateTime($this->TANGGAL_MASUK->CurrentValue, 8);
        $this->TANGGAL_MASUK->PlaceHolder = RemoveHtml($this->TANGGAL_MASUK->caption());

        // TANGGAL_KELUAR
        $this->TANGGAL_KELUAR->EditAttrs["class"] = "form-control";
        $this->TANGGAL_KELUAR->EditCustomAttributes = "";
        $this->TANGGAL_KELUAR->EditValue = FormatDateTime($this->TANGGAL_KELUAR->CurrentValue, 8);
        $this->TANGGAL_KELUAR->PlaceHolder = RemoveHtml($this->TANGGAL_KELUAR->caption());

        // INACBG
        $this->INACBG->EditAttrs["class"] = "form-control";
        $this->INACBG->EditCustomAttributes = "";
        $this->INACBG->EditValue = FormatDateTime($this->INACBG->CurrentValue, 8);
        $this->INACBG->PlaceHolder = RemoveHtml($this->INACBG->caption());

        // DESKRIPSI
        $this->DESKRIPSI->EditAttrs["class"] = "form-control";
        $this->DESKRIPSI->EditCustomAttributes = "";
        if (!$this->DESKRIPSI->Raw) {
            $this->DESKRIPSI->CurrentValue = HtmlDecode($this->DESKRIPSI->CurrentValue);
        }
        $this->DESKRIPSI->EditValue = $this->DESKRIPSI->CurrentValue;
        $this->DESKRIPSI->PlaceHolder = RemoveHtml($this->DESKRIPSI->caption());

        // TARIFKLAIM
        $this->TARIFKLAIM->EditAttrs["class"] = "form-control";
        $this->TARIFKLAIM->EditCustomAttributes = "";
        $this->TARIFKLAIM->EditValue = $this->TARIFKLAIM->CurrentValue;
        $this->TARIFKLAIM->PlaceHolder = RemoveHtml($this->TARIFKLAIM->caption());
        if (strval($this->TARIFKLAIM->EditValue) != "" && is_numeric($this->TARIFKLAIM->EditValue)) {
            $this->TARIFKLAIM->EditValue = FormatNumber($this->TARIFKLAIM->EditValue, -2, -2, -2, -2);
        }

        // NAMA
        $this->NAMA->EditAttrs["class"] = "form-control";
        $this->NAMA->EditCustomAttributes = "";
        if (!$this->NAMA->Raw) {
            $this->NAMA->CurrentValue = HtmlDecode($this->NAMA->CurrentValue);
        }
        $this->NAMA->EditValue = $this->NAMA->CurrentValue;
        $this->NAMA->PlaceHolder = RemoveHtml($this->NAMA->caption());

        // DPJP
        $this->DPJP->EditAttrs["class"] = "form-control";
        $this->DPJP->EditCustomAttributes = "";
        if (!$this->DPJP->Raw) {
            $this->DPJP->CurrentValue = HtmlDecode($this->DPJP->CurrentValue);
        }
        $this->DPJP->EditValue = $this->DPJP->CurrentValue;
        $this->DPJP->PlaceHolder = RemoveHtml($this->DPJP->caption());

        // SEP
        $this->SEP->EditAttrs["class"] = "form-control";
        $this->SEP->EditCustomAttributes = "";
        if (!$this->SEP->Raw) {
            $this->SEP->CurrentValue = HtmlDecode($this->SEP->CurrentValue);
        }
        $this->SEP->EditValue = $this->SEP->CurrentValue;
        $this->SEP->PlaceHolder = RemoveHtml($this->SEP->caption());

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
                    $doc->exportCaption($this->CM);
                    $doc->exportCaption($this->TANGGAL_MASUK);
                    $doc->exportCaption($this->TANGGAL_KELUAR);
                    $doc->exportCaption($this->INACBG);
                    $doc->exportCaption($this->DESKRIPSI);
                    $doc->exportCaption($this->TARIFKLAIM);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->DPJP);
                    $doc->exportCaption($this->SEP);
                } else {
                    $doc->exportCaption($this->CM);
                    $doc->exportCaption($this->TANGGAL_MASUK);
                    $doc->exportCaption($this->TANGGAL_KELUAR);
                    $doc->exportCaption($this->INACBG);
                    $doc->exportCaption($this->DESKRIPSI);
                    $doc->exportCaption($this->TARIFKLAIM);
                    $doc->exportCaption($this->NAMA);
                    $doc->exportCaption($this->DPJP);
                    $doc->exportCaption($this->SEP);
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
                        $doc->exportField($this->CM);
                        $doc->exportField($this->TANGGAL_MASUK);
                        $doc->exportField($this->TANGGAL_KELUAR);
                        $doc->exportField($this->INACBG);
                        $doc->exportField($this->DESKRIPSI);
                        $doc->exportField($this->TARIFKLAIM);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->DPJP);
                        $doc->exportField($this->SEP);
                    } else {
                        $doc->exportField($this->CM);
                        $doc->exportField($this->TANGGAL_MASUK);
                        $doc->exportField($this->TANGGAL_KELUAR);
                        $doc->exportField($this->INACBG);
                        $doc->exportField($this->DESKRIPSI);
                        $doc->exportField($this->TARIFKLAIM);
                        $doc->exportField($this->NAMA);
                        $doc->exportField($this->DPJP);
                        $doc->exportField($this->SEP);
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
