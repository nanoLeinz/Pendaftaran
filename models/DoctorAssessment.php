<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for DOCTOR_ASSESSMENT
 */
class DoctorAssessment extends DbTable
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
    public $DOCTOR_ASSESSMENT_ID;
    public $EMPLOYEE_ID;
    public $OBJECT_CATEGORY_ID;
    public $OBJECT_DESCRIPTION;
    public $KODE_KOTA;
    public $START_DATE;
    public $END_DATE;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'DOCTOR_ASSESSMENT';
        $this->TableName = 'DOCTOR_ASSESSMENT';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[DOCTOR_ASSESSMENT]";
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

        // DOCTOR_ASSESSMENT_ID
        $this->DOCTOR_ASSESSMENT_ID = new DbField('DOCTOR_ASSESSMENT', 'DOCTOR_ASSESSMENT', 'x_DOCTOR_ASSESSMENT_ID', 'DOCTOR_ASSESSMENT_ID', '[DOCTOR_ASSESSMENT_ID]', '[DOCTOR_ASSESSMENT_ID]', 200, 50, -1, false, '[DOCTOR_ASSESSMENT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOCTOR_ASSESSMENT_ID->IsPrimaryKey = true; // Primary key field
        $this->DOCTOR_ASSESSMENT_ID->Nullable = false; // NOT NULL field
        $this->DOCTOR_ASSESSMENT_ID->Required = true; // Required field
        $this->DOCTOR_ASSESSMENT_ID->Sortable = true; // Allow sort
        $this->DOCTOR_ASSESSMENT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOCTOR_ASSESSMENT_ID->Param, "CustomMsg");
        $this->Fields['DOCTOR_ASSESSMENT_ID'] = &$this->DOCTOR_ASSESSMENT_ID;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('DOCTOR_ASSESSMENT', 'DOCTOR_ASSESSMENT', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 50, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->Nullable = false; // NOT NULL field
        $this->EMPLOYEE_ID->Required = true; // Required field
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID = new DbField('DOCTOR_ASSESSMENT', 'DOCTOR_ASSESSMENT', 'x_OBJECT_CATEGORY_ID', 'OBJECT_CATEGORY_ID', '[OBJECT_CATEGORY_ID]', '[OBJECT_CATEGORY_ID]', 200, 50, -1, false, '[OBJECT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECT_CATEGORY_ID->Nullable = false; // NOT NULL field
        $this->OBJECT_CATEGORY_ID->Required = true; // Required field
        $this->OBJECT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->OBJECT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['OBJECT_CATEGORY_ID'] = &$this->OBJECT_CATEGORY_ID;

        // OBJECT_DESCRIPTION
        $this->OBJECT_DESCRIPTION = new DbField('DOCTOR_ASSESSMENT', 'DOCTOR_ASSESSMENT', 'x_OBJECT_DESCRIPTION', 'OBJECT_DESCRIPTION', '[OBJECT_DESCRIPTION]', '[OBJECT_DESCRIPTION]', 200, 100, -1, false, '[OBJECT_DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECT_DESCRIPTION->Sortable = true; // Allow sort
        $this->OBJECT_DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECT_DESCRIPTION->Param, "CustomMsg");
        $this->Fields['OBJECT_DESCRIPTION'] = &$this->OBJECT_DESCRIPTION;

        // KODE_KOTA
        $this->KODE_KOTA = new DbField('DOCTOR_ASSESSMENT', 'DOCTOR_ASSESSMENT', 'x_KODE_KOTA', 'KODE_KOTA', '[KODE_KOTA]', '[KODE_KOTA]', 200, 25, -1, false, '[KODE_KOTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KODE_KOTA->Sortable = true; // Allow sort
        $this->KODE_KOTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KODE_KOTA->Param, "CustomMsg");
        $this->Fields['KODE_KOTA'] = &$this->KODE_KOTA;

        // START_DATE
        $this->START_DATE = new DbField('DOCTOR_ASSESSMENT', 'DOCTOR_ASSESSMENT', 'x_START_DATE', 'START_DATE', '[START_DATE]', CastDateFieldForLike("[START_DATE]", 0, "DB"), 135, 8, 0, false, '[START_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->START_DATE->Nullable = false; // NOT NULL field
        $this->START_DATE->Required = true; // Required field
        $this->START_DATE->Sortable = true; // Allow sort
        $this->START_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->START_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->START_DATE->Param, "CustomMsg");
        $this->Fields['START_DATE'] = &$this->START_DATE;

        // END_DATE
        $this->END_DATE = new DbField('DOCTOR_ASSESSMENT', 'DOCTOR_ASSESSMENT', 'x_END_DATE', 'END_DATE', '[END_DATE]', CastDateFieldForLike("[END_DATE]", 0, "DB"), 135, 8, 0, false, '[END_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->END_DATE->Sortable = true; // Allow sort
        $this->END_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->END_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->END_DATE->Param, "CustomMsg");
        $this->Fields['END_DATE'] = &$this->END_DATE;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[DOCTOR_ASSESSMENT]";
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
            if (array_key_exists('DOCTOR_ASSESSMENT_ID', $rs)) {
                AddFilter($where, QuotedName('DOCTOR_ASSESSMENT_ID', $this->Dbid) . '=' . QuotedValue($rs['DOCTOR_ASSESSMENT_ID'], $this->DOCTOR_ASSESSMENT_ID->DataType, $this->Dbid));
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
        $this->DOCTOR_ASSESSMENT_ID->DbValue = $row['DOCTOR_ASSESSMENT_ID'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->OBJECT_CATEGORY_ID->DbValue = $row['OBJECT_CATEGORY_ID'];
        $this->OBJECT_DESCRIPTION->DbValue = $row['OBJECT_DESCRIPTION'];
        $this->KODE_KOTA->DbValue = $row['KODE_KOTA'];
        $this->START_DATE->DbValue = $row['START_DATE'];
        $this->END_DATE->DbValue = $row['END_DATE'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[DOCTOR_ASSESSMENT_ID] = '@DOCTOR_ASSESSMENT_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->DOCTOR_ASSESSMENT_ID->CurrentValue : $this->DOCTOR_ASSESSMENT_ID->OldValue;
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
                $this->DOCTOR_ASSESSMENT_ID->CurrentValue = $keys[0];
            } else {
                $this->DOCTOR_ASSESSMENT_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('DOCTOR_ASSESSMENT_ID', $row) ? $row['DOCTOR_ASSESSMENT_ID'] : null;
        } else {
            $val = $this->DOCTOR_ASSESSMENT_ID->OldValue !== null ? $this->DOCTOR_ASSESSMENT_ID->OldValue : $this->DOCTOR_ASSESSMENT_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@DOCTOR_ASSESSMENT_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("DoctorAssessmentList");
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
        if ($pageName == "DoctorAssessmentView") {
            return $Language->phrase("View");
        } elseif ($pageName == "DoctorAssessmentEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "DoctorAssessmentAdd") {
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
                return "DoctorAssessmentView";
            case Config("API_ADD_ACTION"):
                return "DoctorAssessmentAdd";
            case Config("API_EDIT_ACTION"):
                return "DoctorAssessmentEdit";
            case Config("API_DELETE_ACTION"):
                return "DoctorAssessmentDelete";
            case Config("API_LIST_ACTION"):
                return "DoctorAssessmentList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "DoctorAssessmentList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("DoctorAssessmentView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("DoctorAssessmentView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "DoctorAssessmentAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "DoctorAssessmentAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("DoctorAssessmentEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("DoctorAssessmentAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("DoctorAssessmentDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "DOCTOR_ASSESSMENT_ID:" . JsonEncode($this->DOCTOR_ASSESSMENT_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->DOCTOR_ASSESSMENT_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->DOCTOR_ASSESSMENT_ID->CurrentValue);
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
            if (($keyValue = Param("DOCTOR_ASSESSMENT_ID") ?? Route("DOCTOR_ASSESSMENT_ID")) !== null) {
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
                $this->DOCTOR_ASSESSMENT_ID->CurrentValue = $key;
            } else {
                $this->DOCTOR_ASSESSMENT_ID->OldValue = $key;
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
        $this->DOCTOR_ASSESSMENT_ID->setDbValue($row['DOCTOR_ASSESSMENT_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->OBJECT_CATEGORY_ID->setDbValue($row['OBJECT_CATEGORY_ID']);
        $this->OBJECT_DESCRIPTION->setDbValue($row['OBJECT_DESCRIPTION']);
        $this->KODE_KOTA->setDbValue($row['KODE_KOTA']);
        $this->START_DATE->setDbValue($row['START_DATE']);
        $this->END_DATE->setDbValue($row['END_DATE']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // DOCTOR_ASSESSMENT_ID

        // EMPLOYEE_ID

        // OBJECT_CATEGORY_ID

        // OBJECT_DESCRIPTION

        // KODE_KOTA

        // START_DATE

        // END_DATE

        // DOCTOR_ASSESSMENT_ID
        $this->DOCTOR_ASSESSMENT_ID->ViewValue = $this->DOCTOR_ASSESSMENT_ID->CurrentValue;
        $this->DOCTOR_ASSESSMENT_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->ViewValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->ViewCustomAttributes = "";

        // OBJECT_DESCRIPTION
        $this->OBJECT_DESCRIPTION->ViewValue = $this->OBJECT_DESCRIPTION->CurrentValue;
        $this->OBJECT_DESCRIPTION->ViewCustomAttributes = "";

        // KODE_KOTA
        $this->KODE_KOTA->ViewValue = $this->KODE_KOTA->CurrentValue;
        $this->KODE_KOTA->ViewCustomAttributes = "";

        // START_DATE
        $this->START_DATE->ViewValue = $this->START_DATE->CurrentValue;
        $this->START_DATE->ViewValue = FormatDateTime($this->START_DATE->ViewValue, 0);
        $this->START_DATE->ViewCustomAttributes = "";

        // END_DATE
        $this->END_DATE->ViewValue = $this->END_DATE->CurrentValue;
        $this->END_DATE->ViewValue = FormatDateTime($this->END_DATE->ViewValue, 0);
        $this->END_DATE->ViewCustomAttributes = "";

        // DOCTOR_ASSESSMENT_ID
        $this->DOCTOR_ASSESSMENT_ID->LinkCustomAttributes = "";
        $this->DOCTOR_ASSESSMENT_ID->HrefValue = "";
        $this->DOCTOR_ASSESSMENT_ID->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->HrefValue = "";
        $this->OBJECT_CATEGORY_ID->TooltipValue = "";

        // OBJECT_DESCRIPTION
        $this->OBJECT_DESCRIPTION->LinkCustomAttributes = "";
        $this->OBJECT_DESCRIPTION->HrefValue = "";
        $this->OBJECT_DESCRIPTION->TooltipValue = "";

        // KODE_KOTA
        $this->KODE_KOTA->LinkCustomAttributes = "";
        $this->KODE_KOTA->HrefValue = "";
        $this->KODE_KOTA->TooltipValue = "";

        // START_DATE
        $this->START_DATE->LinkCustomAttributes = "";
        $this->START_DATE->HrefValue = "";
        $this->START_DATE->TooltipValue = "";

        // END_DATE
        $this->END_DATE->LinkCustomAttributes = "";
        $this->END_DATE->HrefValue = "";
        $this->END_DATE->TooltipValue = "";

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

        // DOCTOR_ASSESSMENT_ID
        $this->DOCTOR_ASSESSMENT_ID->EditAttrs["class"] = "form-control";
        $this->DOCTOR_ASSESSMENT_ID->EditCustomAttributes = "";
        if (!$this->DOCTOR_ASSESSMENT_ID->Raw) {
            $this->DOCTOR_ASSESSMENT_ID->CurrentValue = HtmlDecode($this->DOCTOR_ASSESSMENT_ID->CurrentValue);
        }
        $this->DOCTOR_ASSESSMENT_ID->EditValue = $this->DOCTOR_ASSESSMENT_ID->CurrentValue;
        $this->DOCTOR_ASSESSMENT_ID->PlaceHolder = RemoveHtml($this->DOCTOR_ASSESSMENT_ID->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->OBJECT_CATEGORY_ID->EditCustomAttributes = "";
        if (!$this->OBJECT_CATEGORY_ID->Raw) {
            $this->OBJECT_CATEGORY_ID->CurrentValue = HtmlDecode($this->OBJECT_CATEGORY_ID->CurrentValue);
        }
        $this->OBJECT_CATEGORY_ID->EditValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->OBJECT_CATEGORY_ID->caption());

        // OBJECT_DESCRIPTION
        $this->OBJECT_DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->OBJECT_DESCRIPTION->EditCustomAttributes = "";
        if (!$this->OBJECT_DESCRIPTION->Raw) {
            $this->OBJECT_DESCRIPTION->CurrentValue = HtmlDecode($this->OBJECT_DESCRIPTION->CurrentValue);
        }
        $this->OBJECT_DESCRIPTION->EditValue = $this->OBJECT_DESCRIPTION->CurrentValue;
        $this->OBJECT_DESCRIPTION->PlaceHolder = RemoveHtml($this->OBJECT_DESCRIPTION->caption());

        // KODE_KOTA
        $this->KODE_KOTA->EditAttrs["class"] = "form-control";
        $this->KODE_KOTA->EditCustomAttributes = "";
        if (!$this->KODE_KOTA->Raw) {
            $this->KODE_KOTA->CurrentValue = HtmlDecode($this->KODE_KOTA->CurrentValue);
        }
        $this->KODE_KOTA->EditValue = $this->KODE_KOTA->CurrentValue;
        $this->KODE_KOTA->PlaceHolder = RemoveHtml($this->KODE_KOTA->caption());

        // START_DATE
        $this->START_DATE->EditAttrs["class"] = "form-control";
        $this->START_DATE->EditCustomAttributes = "";
        $this->START_DATE->EditValue = FormatDateTime($this->START_DATE->CurrentValue, 8);
        $this->START_DATE->PlaceHolder = RemoveHtml($this->START_DATE->caption());

        // END_DATE
        $this->END_DATE->EditAttrs["class"] = "form-control";
        $this->END_DATE->EditCustomAttributes = "";
        $this->END_DATE->EditValue = FormatDateTime($this->END_DATE->CurrentValue, 8);
        $this->END_DATE->PlaceHolder = RemoveHtml($this->END_DATE->caption());

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
                    $doc->exportCaption($this->DOCTOR_ASSESSMENT_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->OBJECT_DESCRIPTION);
                    $doc->exportCaption($this->KODE_KOTA);
                    $doc->exportCaption($this->START_DATE);
                    $doc->exportCaption($this->END_DATE);
                } else {
                    $doc->exportCaption($this->DOCTOR_ASSESSMENT_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->OBJECT_DESCRIPTION);
                    $doc->exportCaption($this->KODE_KOTA);
                    $doc->exportCaption($this->START_DATE);
                    $doc->exportCaption($this->END_DATE);
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
                        $doc->exportField($this->DOCTOR_ASSESSMENT_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->OBJECT_DESCRIPTION);
                        $doc->exportField($this->KODE_KOTA);
                        $doc->exportField($this->START_DATE);
                        $doc->exportField($this->END_DATE);
                    } else {
                        $doc->exportField($this->DOCTOR_ASSESSMENT_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->OBJECT_DESCRIPTION);
                        $doc->exportField($this->KODE_KOTA);
                        $doc->exportField($this->START_DATE);
                        $doc->exportField($this->END_DATE);
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
