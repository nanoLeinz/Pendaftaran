<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for m_jadwal
 */
class MJadwal extends DbTable
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
    public $id_jadwal;
    public $kd_dokter;
    public $hari_kerja;
    public $jam_mulai;
    public $jam_selesai;
    public $kd_poli;
    public $kouta;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'm_jadwal';
        $this->TableName = 'm_jadwal';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[m_jadwal]";
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

        // id_jadwal
        $this->id_jadwal = new DbField('m_jadwal', 'm_jadwal', 'x_id_jadwal', 'id_jadwal', '[id_jadwal]', 'CAST([id_jadwal] AS NVARCHAR)', 3, 4, -1, false, '[id_jadwal]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_jadwal->IsAutoIncrement = true; // Autoincrement field
        $this->id_jadwal->IsPrimaryKey = true; // Primary key field
        $this->id_jadwal->Nullable = false; // NOT NULL field
        $this->id_jadwal->Sortable = true; // Allow sort
        $this->id_jadwal->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_jadwal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_jadwal->Param, "CustomMsg");
        $this->Fields['id_jadwal'] = &$this->id_jadwal;

        // kd_dokter
        $this->kd_dokter = new DbField('m_jadwal', 'm_jadwal', 'x_kd_dokter', 'kd_dokter', '[kd_dokter]', '[kd_dokter]', 200, 20, -1, false, '[kd_dokter]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kd_dokter->Sortable = true; // Allow sort
        $this->kd_dokter->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_dokter->Param, "CustomMsg");
        $this->Fields['kd_dokter'] = &$this->kd_dokter;

        // hari_kerja
        $this->hari_kerja = new DbField('m_jadwal', 'm_jadwal', 'x_hari_kerja', 'hari_kerja', '[hari_kerja]', '[hari_kerja]', 200, 10, -1, false, '[hari_kerja]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->hari_kerja->Sortable = true; // Allow sort
        $this->hari_kerja->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->hari_kerja->Param, "CustomMsg");
        $this->Fields['hari_kerja'] = &$this->hari_kerja;

        // jam_mulai
        $this->jam_mulai = new DbField('m_jadwal', 'm_jadwal', 'x_jam_mulai', 'jam_mulai', '[jam_mulai]', CastDateFieldForLike("[jam_mulai]", 4, "DB"), 145, 8, 4, false, '[jam_mulai]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jam_mulai->Sortable = true; // Allow sort
        $this->jam_mulai->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
        $this->jam_mulai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jam_mulai->Param, "CustomMsg");
        $this->Fields['jam_mulai'] = &$this->jam_mulai;

        // jam_selesai
        $this->jam_selesai = new DbField('m_jadwal', 'm_jadwal', 'x_jam_selesai', 'jam_selesai', '[jam_selesai]', CastDateFieldForLike("[jam_selesai]", 4, "DB"), 145, 8, 4, false, '[jam_selesai]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jam_selesai->Sortable = true; // Allow sort
        $this->jam_selesai->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
        $this->jam_selesai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jam_selesai->Param, "CustomMsg");
        $this->Fields['jam_selesai'] = &$this->jam_selesai;

        // kd_poli
        $this->kd_poli = new DbField('m_jadwal', 'm_jadwal', 'x_kd_poli', 'kd_poli', '[kd_poli]', '[kd_poli]', 200, 20, -1, false, '[kd_poli]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kd_poli->Sortable = true; // Allow sort
        $this->kd_poli->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kd_poli->Param, "CustomMsg");
        $this->Fields['kd_poli'] = &$this->kd_poli;

        // kouta
        $this->kouta = new DbField('m_jadwal', 'm_jadwal', 'x_kouta', 'kouta', '[kouta]', 'CAST([kouta] AS NVARCHAR)', 3, 4, -1, false, '[kouta]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kouta->Sortable = true; // Allow sort
        $this->kouta->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->kouta->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kouta->Param, "CustomMsg");
        $this->Fields['kouta'] = &$this->kouta;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[m_jadwal]";
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
            $this->id_jadwal->setDbValue($conn->lastInsertId());
            $rs['id_jadwal'] = $this->id_jadwal->DbValue;
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
            if (array_key_exists('id_jadwal', $rs)) {
                AddFilter($where, QuotedName('id_jadwal', $this->Dbid) . '=' . QuotedValue($rs['id_jadwal'], $this->id_jadwal->DataType, $this->Dbid));
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
        $this->id_jadwal->DbValue = $row['id_jadwal'];
        $this->kd_dokter->DbValue = $row['kd_dokter'];
        $this->hari_kerja->DbValue = $row['hari_kerja'];
        $this->jam_mulai->DbValue = $row['jam_mulai'];
        $this->jam_selesai->DbValue = $row['jam_selesai'];
        $this->kd_poli->DbValue = $row['kd_poli'];
        $this->kouta->DbValue = $row['kouta'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[id_jadwal] = @id_jadwal@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_jadwal->CurrentValue : $this->id_jadwal->OldValue;
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
                $this->id_jadwal->CurrentValue = $keys[0];
            } else {
                $this->id_jadwal->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_jadwal', $row) ? $row['id_jadwal'] : null;
        } else {
            $val = $this->id_jadwal->OldValue !== null ? $this->id_jadwal->OldValue : $this->id_jadwal->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_jadwal@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("MJadwalList");
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
        if ($pageName == "MJadwalView") {
            return $Language->phrase("View");
        } elseif ($pageName == "MJadwalEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "MJadwalAdd") {
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
                return "MJadwalView";
            case Config("API_ADD_ACTION"):
                return "MJadwalAdd";
            case Config("API_EDIT_ACTION"):
                return "MJadwalEdit";
            case Config("API_DELETE_ACTION"):
                return "MJadwalDelete";
            case Config("API_LIST_ACTION"):
                return "MJadwalList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "MJadwalList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("MJadwalView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("MJadwalView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "MJadwalAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "MJadwalAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("MJadwalEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("MJadwalAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("MJadwalDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_jadwal:" . JsonEncode($this->id_jadwal->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_jadwal->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_jadwal->CurrentValue);
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
            if (($keyValue = Param("id_jadwal") ?? Route("id_jadwal")) !== null) {
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
                $this->id_jadwal->CurrentValue = $key;
            } else {
                $this->id_jadwal->OldValue = $key;
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
        $this->id_jadwal->setDbValue($row['id_jadwal']);
        $this->kd_dokter->setDbValue($row['kd_dokter']);
        $this->hari_kerja->setDbValue($row['hari_kerja']);
        $this->jam_mulai->setDbValue($row['jam_mulai']);
        $this->jam_selesai->setDbValue($row['jam_selesai']);
        $this->kd_poli->setDbValue($row['kd_poli']);
        $this->kouta->setDbValue($row['kouta']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_jadwal

        // kd_dokter

        // hari_kerja

        // jam_mulai

        // jam_selesai

        // kd_poli

        // kouta

        // id_jadwal
        $this->id_jadwal->ViewValue = $this->id_jadwal->CurrentValue;
        $this->id_jadwal->ViewCustomAttributes = "";

        // kd_dokter
        $this->kd_dokter->ViewValue = $this->kd_dokter->CurrentValue;
        $this->kd_dokter->ViewCustomAttributes = "";

        // hari_kerja
        $this->hari_kerja->ViewValue = $this->hari_kerja->CurrentValue;
        $this->hari_kerja->ViewCustomAttributes = "";

        // jam_mulai
        $this->jam_mulai->ViewValue = $this->jam_mulai->CurrentValue;
        $this->jam_mulai->ViewValue = FormatDateTime($this->jam_mulai->ViewValue, 4);
        $this->jam_mulai->ViewCustomAttributes = "";

        // jam_selesai
        $this->jam_selesai->ViewValue = $this->jam_selesai->CurrentValue;
        $this->jam_selesai->ViewValue = FormatDateTime($this->jam_selesai->ViewValue, 4);
        $this->jam_selesai->ViewCustomAttributes = "";

        // kd_poli
        $this->kd_poli->ViewValue = $this->kd_poli->CurrentValue;
        $this->kd_poli->ViewCustomAttributes = "";

        // kouta
        $this->kouta->ViewValue = $this->kouta->CurrentValue;
        $this->kouta->ViewValue = FormatNumber($this->kouta->ViewValue, 0, -2, -2, -2);
        $this->kouta->ViewCustomAttributes = "";

        // id_jadwal
        $this->id_jadwal->LinkCustomAttributes = "";
        $this->id_jadwal->HrefValue = "";
        $this->id_jadwal->TooltipValue = "";

        // kd_dokter
        $this->kd_dokter->LinkCustomAttributes = "";
        $this->kd_dokter->HrefValue = "";
        $this->kd_dokter->TooltipValue = "";

        // hari_kerja
        $this->hari_kerja->LinkCustomAttributes = "";
        $this->hari_kerja->HrefValue = "";
        $this->hari_kerja->TooltipValue = "";

        // jam_mulai
        $this->jam_mulai->LinkCustomAttributes = "";
        $this->jam_mulai->HrefValue = "";
        $this->jam_mulai->TooltipValue = "";

        // jam_selesai
        $this->jam_selesai->LinkCustomAttributes = "";
        $this->jam_selesai->HrefValue = "";
        $this->jam_selesai->TooltipValue = "";

        // kd_poli
        $this->kd_poli->LinkCustomAttributes = "";
        $this->kd_poli->HrefValue = "";
        $this->kd_poli->TooltipValue = "";

        // kouta
        $this->kouta->LinkCustomAttributes = "";
        $this->kouta->HrefValue = "";
        $this->kouta->TooltipValue = "";

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

        // id_jadwal
        $this->id_jadwal->EditAttrs["class"] = "form-control";
        $this->id_jadwal->EditCustomAttributes = "";
        $this->id_jadwal->EditValue = $this->id_jadwal->CurrentValue;
        $this->id_jadwal->ViewCustomAttributes = "";

        // kd_dokter
        $this->kd_dokter->EditAttrs["class"] = "form-control";
        $this->kd_dokter->EditCustomAttributes = "";
        if (!$this->kd_dokter->Raw) {
            $this->kd_dokter->CurrentValue = HtmlDecode($this->kd_dokter->CurrentValue);
        }
        $this->kd_dokter->EditValue = $this->kd_dokter->CurrentValue;
        $this->kd_dokter->PlaceHolder = RemoveHtml($this->kd_dokter->caption());

        // hari_kerja
        $this->hari_kerja->EditAttrs["class"] = "form-control";
        $this->hari_kerja->EditCustomAttributes = "";
        if (!$this->hari_kerja->Raw) {
            $this->hari_kerja->CurrentValue = HtmlDecode($this->hari_kerja->CurrentValue);
        }
        $this->hari_kerja->EditValue = $this->hari_kerja->CurrentValue;
        $this->hari_kerja->PlaceHolder = RemoveHtml($this->hari_kerja->caption());

        // jam_mulai
        $this->jam_mulai->EditAttrs["class"] = "form-control";
        $this->jam_mulai->EditCustomAttributes = "";
        $this->jam_mulai->EditValue = FormatDateTime($this->jam_mulai->CurrentValue, 4);
        $this->jam_mulai->PlaceHolder = RemoveHtml($this->jam_mulai->caption());

        // jam_selesai
        $this->jam_selesai->EditAttrs["class"] = "form-control";
        $this->jam_selesai->EditCustomAttributes = "";
        $this->jam_selesai->EditValue = FormatDateTime($this->jam_selesai->CurrentValue, 4);
        $this->jam_selesai->PlaceHolder = RemoveHtml($this->jam_selesai->caption());

        // kd_poli
        $this->kd_poli->EditAttrs["class"] = "form-control";
        $this->kd_poli->EditCustomAttributes = "";
        if (!$this->kd_poli->Raw) {
            $this->kd_poli->CurrentValue = HtmlDecode($this->kd_poli->CurrentValue);
        }
        $this->kd_poli->EditValue = $this->kd_poli->CurrentValue;
        $this->kd_poli->PlaceHolder = RemoveHtml($this->kd_poli->caption());

        // kouta
        $this->kouta->EditAttrs["class"] = "form-control";
        $this->kouta->EditCustomAttributes = "";
        $this->kouta->EditValue = $this->kouta->CurrentValue;
        $this->kouta->PlaceHolder = RemoveHtml($this->kouta->caption());

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
                    $doc->exportCaption($this->id_jadwal);
                    $doc->exportCaption($this->kd_dokter);
                    $doc->exportCaption($this->hari_kerja);
                    $doc->exportCaption($this->jam_mulai);
                    $doc->exportCaption($this->jam_selesai);
                    $doc->exportCaption($this->kd_poli);
                    $doc->exportCaption($this->kouta);
                } else {
                    $doc->exportCaption($this->id_jadwal);
                    $doc->exportCaption($this->kd_dokter);
                    $doc->exportCaption($this->hari_kerja);
                    $doc->exportCaption($this->jam_mulai);
                    $doc->exportCaption($this->jam_selesai);
                    $doc->exportCaption($this->kd_poli);
                    $doc->exportCaption($this->kouta);
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
                        $doc->exportField($this->id_jadwal);
                        $doc->exportField($this->kd_dokter);
                        $doc->exportField($this->hari_kerja);
                        $doc->exportField($this->jam_mulai);
                        $doc->exportField($this->jam_selesai);
                        $doc->exportField($this->kd_poli);
                        $doc->exportField($this->kouta);
                    } else {
                        $doc->exportField($this->id_jadwal);
                        $doc->exportField($this->kd_dokter);
                        $doc->exportField($this->hari_kerja);
                        $doc->exportField($this->jam_mulai);
                        $doc->exportField($this->jam_selesai);
                        $doc->exportField($this->kd_poli);
                        $doc->exportField($this->kouta);
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
