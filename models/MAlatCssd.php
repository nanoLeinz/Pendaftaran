<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for m_alat_cssd
 */
class MAlatCssd extends DbTable
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
    public $alat_id;
    public $nama_alat;
    public $id_set;
    public $keadaan;
    public $jumlah;
    public $merk;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'm_alat_cssd';
        $this->TableName = 'm_alat_cssd';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[m_alat_cssd]";
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

        // alat_id
        $this->alat_id = new DbField('m_alat_cssd', 'm_alat_cssd', 'x_alat_id', 'alat_id', '[alat_id]', 'CAST([alat_id] AS NVARCHAR)', 3, 4, -1, false, '[alat_id]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->alat_id->IsAutoIncrement = true; // Autoincrement field
        $this->alat_id->IsPrimaryKey = true; // Primary key field
        $this->alat_id->Nullable = false; // NOT NULL field
        $this->alat_id->Sortable = true; // Allow sort
        $this->alat_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->alat_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alat_id->Param, "CustomMsg");
        $this->Fields['alat_id'] = &$this->alat_id;

        // nama_alat
        $this->nama_alat = new DbField('m_alat_cssd', 'm_alat_cssd', 'x_nama_alat', 'nama_alat', '[nama_alat]', '[nama_alat]', 200, 255, -1, false, '[nama_alat]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_alat->Sortable = true; // Allow sort
        $this->nama_alat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_alat->Param, "CustomMsg");
        $this->Fields['nama_alat'] = &$this->nama_alat;

        // id_set
        $this->id_set = new DbField('m_alat_cssd', 'm_alat_cssd', 'x_id_set', 'id_set', '[id_set]', 'CAST([id_set] AS NVARCHAR)', 3, 4, -1, false, '[id_set]', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->id_set->Sortable = true; // Allow sort
        $this->id_set->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->id_set->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->id_set->Lookup = new Lookup('id_set', 'l_set_cssd', false, 'id_set', ["nama_set_cssd","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->id_set->Lookup = new Lookup('id_set', 'l_set_cssd', false, 'id_set', ["nama_set_cssd","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->id_set->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_set->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_set->Param, "CustomMsg");
        $this->Fields['id_set'] = &$this->id_set;

        // keadaan
        $this->keadaan = new DbField('m_alat_cssd', 'm_alat_cssd', 'x_keadaan', 'keadaan', '[keadaan]', 'CAST([keadaan] AS NVARCHAR)', 3, 4, -1, false, '[keadaan]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->keadaan->Sortable = true; // Allow sort
        $this->keadaan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->keadaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->keadaan->Param, "CustomMsg");
        $this->Fields['keadaan'] = &$this->keadaan;

        // jumlah
        $this->jumlah = new DbField('m_alat_cssd', 'm_alat_cssd', 'x_jumlah', 'jumlah', '[jumlah]', 'CAST([jumlah] AS NVARCHAR)', 3, 4, -1, false, '[jumlah]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah->Sortable = true; // Allow sort
        $this->jumlah->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jumlah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah->Param, "CustomMsg");
        $this->Fields['jumlah'] = &$this->jumlah;

        // merk
        $this->merk = new DbField('m_alat_cssd', 'm_alat_cssd', 'x_merk', 'merk', '[merk]', '[merk]', 200, 255, -1, false, '[merk]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->merk->Sortable = true; // Allow sort
        $this->merk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->merk->Param, "CustomMsg");
        $this->Fields['merk'] = &$this->merk;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[m_alat_cssd]";
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
            $this->alat_id->setDbValue($conn->lastInsertId());
            $rs['alat_id'] = $this->alat_id->DbValue;
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
            if (array_key_exists('alat_id', $rs)) {
                AddFilter($where, QuotedName('alat_id', $this->Dbid) . '=' . QuotedValue($rs['alat_id'], $this->alat_id->DataType, $this->Dbid));
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
        $this->alat_id->DbValue = $row['alat_id'];
        $this->nama_alat->DbValue = $row['nama_alat'];
        $this->id_set->DbValue = $row['id_set'];
        $this->keadaan->DbValue = $row['keadaan'];
        $this->jumlah->DbValue = $row['jumlah'];
        $this->merk->DbValue = $row['merk'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[alat_id] = @alat_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->alat_id->CurrentValue : $this->alat_id->OldValue;
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
                $this->alat_id->CurrentValue = $keys[0];
            } else {
                $this->alat_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('alat_id', $row) ? $row['alat_id'] : null;
        } else {
            $val = $this->alat_id->OldValue !== null ? $this->alat_id->OldValue : $this->alat_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@alat_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("MAlatCssdList");
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
        if ($pageName == "MAlatCssdView") {
            return $Language->phrase("View");
        } elseif ($pageName == "MAlatCssdEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "MAlatCssdAdd") {
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
                return "MAlatCssdView";
            case Config("API_ADD_ACTION"):
                return "MAlatCssdAdd";
            case Config("API_EDIT_ACTION"):
                return "MAlatCssdEdit";
            case Config("API_DELETE_ACTION"):
                return "MAlatCssdDelete";
            case Config("API_LIST_ACTION"):
                return "MAlatCssdList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "MAlatCssdList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("MAlatCssdView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("MAlatCssdView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "MAlatCssdAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "MAlatCssdAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("MAlatCssdEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("MAlatCssdAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("MAlatCssdDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "alat_id:" . JsonEncode($this->alat_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->alat_id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->alat_id->CurrentValue);
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
            if (($keyValue = Param("alat_id") ?? Route("alat_id")) !== null) {
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
                $this->alat_id->CurrentValue = $key;
            } else {
                $this->alat_id->OldValue = $key;
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
        $this->alat_id->setDbValue($row['alat_id']);
        $this->nama_alat->setDbValue($row['nama_alat']);
        $this->id_set->setDbValue($row['id_set']);
        $this->keadaan->setDbValue($row['keadaan']);
        $this->jumlah->setDbValue($row['jumlah']);
        $this->merk->setDbValue($row['merk']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // alat_id
        $this->alat_id->CellCssStyle = "white-space: nowrap;";

        // nama_alat

        // id_set
        $this->id_set->CellCssStyle = "white-space: nowrap;";

        // keadaan
        $this->keadaan->CellCssStyle = "white-space: nowrap;";

        // jumlah
        $this->jumlah->CellCssStyle = "white-space: nowrap;";

        // merk

        // alat_id
        $this->alat_id->ViewValue = $this->alat_id->CurrentValue;
        $this->alat_id->ViewValue = FormatNumber($this->alat_id->ViewValue, 0, -2, -2, -2);
        $this->alat_id->ViewCustomAttributes = "";

        // nama_alat
        $this->nama_alat->ViewValue = $this->nama_alat->CurrentValue;
        $this->nama_alat->ViewCustomAttributes = "";

        // id_set
        $curVal = trim(strval($this->id_set->CurrentValue));
        if ($curVal != "") {
            $this->id_set->ViewValue = $this->id_set->lookupCacheOption($curVal);
            if ($this->id_set->ViewValue === null) { // Lookup from database
                $filterWrk = "[id_set]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->id_set->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->id_set->Lookup->renderViewRow($rswrk[0]);
                    $this->id_set->ViewValue = $this->id_set->displayValue($arwrk);
                } else {
                    $this->id_set->ViewValue = $this->id_set->CurrentValue;
                }
            }
        } else {
            $this->id_set->ViewValue = null;
        }
        $this->id_set->ViewCustomAttributes = "";

        // keadaan
        $this->keadaan->ViewValue = $this->keadaan->CurrentValue;
        $this->keadaan->ViewValue = FormatNumber($this->keadaan->ViewValue, 0, -2, -2, -2);
        $this->keadaan->ViewCustomAttributes = "";

        // jumlah
        $this->jumlah->ViewValue = $this->jumlah->CurrentValue;
        $this->jumlah->ViewValue = FormatNumber($this->jumlah->ViewValue, 0, -2, -2, -2);
        $this->jumlah->ViewCustomAttributes = "";

        // merk
        $this->merk->ViewValue = $this->merk->CurrentValue;
        $this->merk->ViewCustomAttributes = "";

        // alat_id
        $this->alat_id->LinkCustomAttributes = "";
        $this->alat_id->HrefValue = "";
        $this->alat_id->TooltipValue = "";

        // nama_alat
        $this->nama_alat->LinkCustomAttributes = "";
        $this->nama_alat->HrefValue = "";
        $this->nama_alat->TooltipValue = "";

        // id_set
        $this->id_set->LinkCustomAttributes = "";
        $this->id_set->HrefValue = "";
        $this->id_set->TooltipValue = "";

        // keadaan
        $this->keadaan->LinkCustomAttributes = "";
        $this->keadaan->HrefValue = "";
        $this->keadaan->TooltipValue = "";

        // jumlah
        $this->jumlah->LinkCustomAttributes = "";
        $this->jumlah->HrefValue = "";
        $this->jumlah->TooltipValue = "";

        // merk
        $this->merk->LinkCustomAttributes = "";
        $this->merk->HrefValue = "";
        $this->merk->TooltipValue = "";

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

        // alat_id
        $this->alat_id->EditAttrs["class"] = "form-control";
        $this->alat_id->EditCustomAttributes = "";
        $this->alat_id->EditValue = $this->alat_id->CurrentValue;
        $this->alat_id->EditValue = FormatNumber($this->alat_id->EditValue, 0, -2, -2, -2);
        $this->alat_id->ViewCustomAttributes = "";

        // nama_alat
        $this->nama_alat->EditAttrs["class"] = "form-control";
        $this->nama_alat->EditCustomAttributes = "";
        if (!$this->nama_alat->Raw) {
            $this->nama_alat->CurrentValue = HtmlDecode($this->nama_alat->CurrentValue);
        }
        $this->nama_alat->EditValue = $this->nama_alat->CurrentValue;
        $this->nama_alat->PlaceHolder = RemoveHtml($this->nama_alat->caption());

        // id_set
        $this->id_set->EditAttrs["class"] = "form-control";
        $this->id_set->EditCustomAttributes = "";
        $this->id_set->PlaceHolder = RemoveHtml($this->id_set->caption());

        // keadaan
        $this->keadaan->EditAttrs["class"] = "form-control";
        $this->keadaan->EditCustomAttributes = "";
        $this->keadaan->EditValue = $this->keadaan->CurrentValue;
        $this->keadaan->PlaceHolder = RemoveHtml($this->keadaan->caption());

        // jumlah
        $this->jumlah->EditAttrs["class"] = "form-control";
        $this->jumlah->EditCustomAttributes = "";
        $this->jumlah->EditValue = $this->jumlah->CurrentValue;
        $this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());

        // merk
        $this->merk->EditAttrs["class"] = "form-control";
        $this->merk->EditCustomAttributes = "";
        if (!$this->merk->Raw) {
            $this->merk->CurrentValue = HtmlDecode($this->merk->CurrentValue);
        }
        $this->merk->EditValue = $this->merk->CurrentValue;
        $this->merk->PlaceHolder = RemoveHtml($this->merk->caption());

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
                    $doc->exportCaption($this->alat_id);
                    $doc->exportCaption($this->nama_alat);
                    $doc->exportCaption($this->id_set);
                    $doc->exportCaption($this->keadaan);
                    $doc->exportCaption($this->jumlah);
                    $doc->exportCaption($this->merk);
                } else {
                    $doc->exportCaption($this->alat_id);
                    $doc->exportCaption($this->nama_alat);
                    $doc->exportCaption($this->id_set);
                    $doc->exportCaption($this->keadaan);
                    $doc->exportCaption($this->jumlah);
                    $doc->exportCaption($this->merk);
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
                        $doc->exportField($this->alat_id);
                        $doc->exportField($this->nama_alat);
                        $doc->exportField($this->id_set);
                        $doc->exportField($this->keadaan);
                        $doc->exportField($this->jumlah);
                        $doc->exportField($this->merk);
                    } else {
                        $doc->exportField($this->alat_id);
                        $doc->exportField($this->nama_alat);
                        $doc->exportField($this->id_set);
                        $doc->exportField($this->keadaan);
                        $doc->exportField($this->jumlah);
                        $doc->exportField($this->merk);
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
