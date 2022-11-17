<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for referensi_mobilejkn_bpjs_batal
 */
class ReferensiMobilejknBpjsBatal extends DbTable
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
    public $no_rkm_medis;
    public $nomorreferensi;
    public $tanggalbatal;
    public $keterangan;
    public $statuskirim;
    public $nobooking;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'referensi_mobilejkn_bpjs_batal';
        $this->TableName = 'referensi_mobilejkn_bpjs_batal';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[referensi_mobilejkn_bpjs_batal]";
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

        // no_rkm_medis
        $this->no_rkm_medis = new DbField('referensi_mobilejkn_bpjs_batal', 'referensi_mobilejkn_bpjs_batal', 'x_no_rkm_medis', 'no_rkm_medis', '[no_rkm_medis]', '[no_rkm_medis]', 200, 50, -1, false, '[no_rkm_medis]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_rkm_medis->Sortable = true; // Allow sort
        $this->no_rkm_medis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_rkm_medis->Param, "CustomMsg");
        $this->Fields['no_rkm_medis'] = &$this->no_rkm_medis;

        // nomorreferensi
        $this->nomorreferensi = new DbField('referensi_mobilejkn_bpjs_batal', 'referensi_mobilejkn_bpjs_batal', 'x_nomorreferensi', 'nomorreferensi', '[nomorreferensi]', '[nomorreferensi]', 200, 50, -1, false, '[nomorreferensi]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nomorreferensi->Sortable = true; // Allow sort
        $this->nomorreferensi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nomorreferensi->Param, "CustomMsg");
        $this->Fields['nomorreferensi'] = &$this->nomorreferensi;

        // tanggalbatal
        $this->tanggalbatal = new DbField('referensi_mobilejkn_bpjs_batal', 'referensi_mobilejkn_bpjs_batal', 'x_tanggalbatal', 'tanggalbatal', '[tanggalbatal]', CastDateFieldForLike("[tanggalbatal]", 0, "DB"), 135, 8, 0, false, '[tanggalbatal]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggalbatal->Sortable = true; // Allow sort
        $this->tanggalbatal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggalbatal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggalbatal->Param, "CustomMsg");
        $this->Fields['tanggalbatal'] = &$this->tanggalbatal;

        // keterangan
        $this->keterangan = new DbField('referensi_mobilejkn_bpjs_batal', 'referensi_mobilejkn_bpjs_batal', 'x_keterangan', 'keterangan', '[keterangan]', '[keterangan]', 200, 500, -1, false, '[keterangan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->keterangan->Sortable = true; // Allow sort
        $this->keterangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keterangan->Param, "CustomMsg");
        $this->Fields['keterangan'] = &$this->keterangan;

        // statuskirim
        $this->statuskirim = new DbField('referensi_mobilejkn_bpjs_batal', 'referensi_mobilejkn_bpjs_batal', 'x_statuskirim', 'statuskirim', '[statuskirim]', '[statuskirim]', 200, 50, -1, false, '[statuskirim]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->statuskirim->Sortable = true; // Allow sort
        $this->statuskirim->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->statuskirim->Param, "CustomMsg");
        $this->Fields['statuskirim'] = &$this->statuskirim;

        // nobooking
        $this->nobooking = new DbField('referensi_mobilejkn_bpjs_batal', 'referensi_mobilejkn_bpjs_batal', 'x_nobooking', 'nobooking', '[nobooking]', '[nobooking]', 200, 50, -1, false, '[nobooking]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nobooking->IsPrimaryKey = true; // Primary key field
        $this->nobooking->Nullable = false; // NOT NULL field
        $this->nobooking->Required = true; // Required field
        $this->nobooking->Sortable = true; // Allow sort
        $this->nobooking->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nobooking->Param, "CustomMsg");
        $this->Fields['nobooking'] = &$this->nobooking;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[referensi_mobilejkn_bpjs_batal]";
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
            if (array_key_exists('nobooking', $rs)) {
                AddFilter($where, QuotedName('nobooking', $this->Dbid) . '=' . QuotedValue($rs['nobooking'], $this->nobooking->DataType, $this->Dbid));
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
        $this->no_rkm_medis->DbValue = $row['no_rkm_medis'];
        $this->nomorreferensi->DbValue = $row['nomorreferensi'];
        $this->tanggalbatal->DbValue = $row['tanggalbatal'];
        $this->keterangan->DbValue = $row['keterangan'];
        $this->statuskirim->DbValue = $row['statuskirim'];
        $this->nobooking->DbValue = $row['nobooking'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[nobooking] = '@nobooking@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->nobooking->CurrentValue : $this->nobooking->OldValue;
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
                $this->nobooking->CurrentValue = $keys[0];
            } else {
                $this->nobooking->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('nobooking', $row) ? $row['nobooking'] : null;
        } else {
            $val = $this->nobooking->OldValue !== null ? $this->nobooking->OldValue : $this->nobooking->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@nobooking@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ReferensiMobilejknBpjsBatalList");
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
        if ($pageName == "ReferensiMobilejknBpjsBatalView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ReferensiMobilejknBpjsBatalEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ReferensiMobilejknBpjsBatalAdd") {
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
                return "ReferensiMobilejknBpjsBatalView";
            case Config("API_ADD_ACTION"):
                return "ReferensiMobilejknBpjsBatalAdd";
            case Config("API_EDIT_ACTION"):
                return "ReferensiMobilejknBpjsBatalEdit";
            case Config("API_DELETE_ACTION"):
                return "ReferensiMobilejknBpjsBatalDelete";
            case Config("API_LIST_ACTION"):
                return "ReferensiMobilejknBpjsBatalList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ReferensiMobilejknBpjsBatalList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ReferensiMobilejknBpjsBatalView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ReferensiMobilejknBpjsBatalView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ReferensiMobilejknBpjsBatalAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ReferensiMobilejknBpjsBatalAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ReferensiMobilejknBpjsBatalEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ReferensiMobilejknBpjsBatalAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ReferensiMobilejknBpjsBatalDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "nobooking:" . JsonEncode($this->nobooking->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->nobooking->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->nobooking->CurrentValue);
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
            if (($keyValue = Param("nobooking") ?? Route("nobooking")) !== null) {
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
                $this->nobooking->CurrentValue = $key;
            } else {
                $this->nobooking->OldValue = $key;
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
        $this->no_rkm_medis->setDbValue($row['no_rkm_medis']);
        $this->nomorreferensi->setDbValue($row['nomorreferensi']);
        $this->tanggalbatal->setDbValue($row['tanggalbatal']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->statuskirim->setDbValue($row['statuskirim']);
        $this->nobooking->setDbValue($row['nobooking']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // no_rkm_medis

        // nomorreferensi

        // tanggalbatal

        // keterangan

        // statuskirim

        // nobooking

        // no_rkm_medis
        $this->no_rkm_medis->ViewValue = $this->no_rkm_medis->CurrentValue;
        $this->no_rkm_medis->ViewCustomAttributes = "";

        // nomorreferensi
        $this->nomorreferensi->ViewValue = $this->nomorreferensi->CurrentValue;
        $this->nomorreferensi->ViewCustomAttributes = "";

        // tanggalbatal
        $this->tanggalbatal->ViewValue = $this->tanggalbatal->CurrentValue;
        $this->tanggalbatal->ViewValue = FormatDateTime($this->tanggalbatal->ViewValue, 0);
        $this->tanggalbatal->ViewCustomAttributes = "";

        // keterangan
        $this->keterangan->ViewValue = $this->keterangan->CurrentValue;
        $this->keterangan->ViewCustomAttributes = "";

        // statuskirim
        $this->statuskirim->ViewValue = $this->statuskirim->CurrentValue;
        $this->statuskirim->ViewCustomAttributes = "";

        // nobooking
        $this->nobooking->ViewValue = $this->nobooking->CurrentValue;
        $this->nobooking->ViewCustomAttributes = "";

        // no_rkm_medis
        $this->no_rkm_medis->LinkCustomAttributes = "";
        $this->no_rkm_medis->HrefValue = "";
        $this->no_rkm_medis->TooltipValue = "";

        // nomorreferensi
        $this->nomorreferensi->LinkCustomAttributes = "";
        $this->nomorreferensi->HrefValue = "";
        $this->nomorreferensi->TooltipValue = "";

        // tanggalbatal
        $this->tanggalbatal->LinkCustomAttributes = "";
        $this->tanggalbatal->HrefValue = "";
        $this->tanggalbatal->TooltipValue = "";

        // keterangan
        $this->keterangan->LinkCustomAttributes = "";
        $this->keterangan->HrefValue = "";
        $this->keterangan->TooltipValue = "";

        // statuskirim
        $this->statuskirim->LinkCustomAttributes = "";
        $this->statuskirim->HrefValue = "";
        $this->statuskirim->TooltipValue = "";

        // nobooking
        $this->nobooking->LinkCustomAttributes = "";
        $this->nobooking->HrefValue = "";
        $this->nobooking->TooltipValue = "";

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

        // no_rkm_medis
        $this->no_rkm_medis->EditAttrs["class"] = "form-control";
        $this->no_rkm_medis->EditCustomAttributes = "";
        if (!$this->no_rkm_medis->Raw) {
            $this->no_rkm_medis->CurrentValue = HtmlDecode($this->no_rkm_medis->CurrentValue);
        }
        $this->no_rkm_medis->EditValue = $this->no_rkm_medis->CurrentValue;
        $this->no_rkm_medis->PlaceHolder = RemoveHtml($this->no_rkm_medis->caption());

        // nomorreferensi
        $this->nomorreferensi->EditAttrs["class"] = "form-control";
        $this->nomorreferensi->EditCustomAttributes = "";
        if (!$this->nomorreferensi->Raw) {
            $this->nomorreferensi->CurrentValue = HtmlDecode($this->nomorreferensi->CurrentValue);
        }
        $this->nomorreferensi->EditValue = $this->nomorreferensi->CurrentValue;
        $this->nomorreferensi->PlaceHolder = RemoveHtml($this->nomorreferensi->caption());

        // tanggalbatal
        $this->tanggalbatal->EditAttrs["class"] = "form-control";
        $this->tanggalbatal->EditCustomAttributes = "";
        $this->tanggalbatal->EditValue = FormatDateTime($this->tanggalbatal->CurrentValue, 8);
        $this->tanggalbatal->PlaceHolder = RemoveHtml($this->tanggalbatal->caption());

        // keterangan
        $this->keterangan->EditAttrs["class"] = "form-control";
        $this->keterangan->EditCustomAttributes = "";
        if (!$this->keterangan->Raw) {
            $this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
        }
        $this->keterangan->EditValue = $this->keterangan->CurrentValue;
        $this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

        // statuskirim
        $this->statuskirim->EditAttrs["class"] = "form-control";
        $this->statuskirim->EditCustomAttributes = "";
        if (!$this->statuskirim->Raw) {
            $this->statuskirim->CurrentValue = HtmlDecode($this->statuskirim->CurrentValue);
        }
        $this->statuskirim->EditValue = $this->statuskirim->CurrentValue;
        $this->statuskirim->PlaceHolder = RemoveHtml($this->statuskirim->caption());

        // nobooking
        $this->nobooking->EditAttrs["class"] = "form-control";
        $this->nobooking->EditCustomAttributes = "";
        if (!$this->nobooking->Raw) {
            $this->nobooking->CurrentValue = HtmlDecode($this->nobooking->CurrentValue);
        }
        $this->nobooking->EditValue = $this->nobooking->CurrentValue;
        $this->nobooking->PlaceHolder = RemoveHtml($this->nobooking->caption());

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
                    $doc->exportCaption($this->no_rkm_medis);
                    $doc->exportCaption($this->nomorreferensi);
                    $doc->exportCaption($this->tanggalbatal);
                    $doc->exportCaption($this->keterangan);
                    $doc->exportCaption($this->statuskirim);
                    $doc->exportCaption($this->nobooking);
                } else {
                    $doc->exportCaption($this->no_rkm_medis);
                    $doc->exportCaption($this->nomorreferensi);
                    $doc->exportCaption($this->tanggalbatal);
                    $doc->exportCaption($this->keterangan);
                    $doc->exportCaption($this->statuskirim);
                    $doc->exportCaption($this->nobooking);
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
                        $doc->exportField($this->no_rkm_medis);
                        $doc->exportField($this->nomorreferensi);
                        $doc->exportField($this->tanggalbatal);
                        $doc->exportField($this->keterangan);
                        $doc->exportField($this->statuskirim);
                        $doc->exportField($this->nobooking);
                    } else {
                        $doc->exportField($this->no_rkm_medis);
                        $doc->exportField($this->nomorreferensi);
                        $doc->exportField($this->tanggalbatal);
                        $doc->exportField($this->keterangan);
                        $doc->exportField($this->statuskirim);
                        $doc->exportField($this->nobooking);
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
