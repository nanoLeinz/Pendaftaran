<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for mata_dan_syaraf
 */
class MataDanSyaraf extends ReportTable
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
    public $ShowGroupHeaderAsRow = false;
    public $ShowCompactSummaryFooter = true;

    // Export
    public $ExportDoc;

    // Fields
    public $DIAGNOSA_ID;
    public $GENDER;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'mata_dan_syaraf';
        $this->TableName = 'mata_dan_syaraf';
        $this->TableType = 'REPORT';

        // Update Table
        $this->UpdateTable = "dbo.PASIEN_DIAGNOSA";
        $this->ReportSourceTable = 'V_SENSUS_MATA_SYARAF'; // Report source table
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (report only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new ReportField('mata_dan_syaraf', 'mata_dan_syaraf', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', 'dbo.PASIEN_DIAGNOSA.DIAGNOSA_ID', 'dbo.PASIEN_DIAGNOSA.DIAGNOSA_ID', 200, 50, -1, false, 'dbo.PASIEN_DIAGNOSA.DIAGNOSA_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->DIAGNOSA_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->DIAGNOSA_ID->Lookup = new Lookup('DIAGNOSA_ID', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->DIAGNOSA_ID->Lookup = new Lookup('DIAGNOSA_ID', 'DIAGNOSA', false, 'DIAGNOSA_ID', ["DIAGNOSA_ID","NAME_OF_DIAGNOSA","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->DIAGNOSA_ID->SourceTableVar = 'V_SENSUS_MATA_SYARAF';
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // GENDER
        $this->GENDER = new ReportField('mata_dan_syaraf', 'mata_dan_syaraf', 'x_GENDER', 'GENDER', 'dbo.PASIEN_DIAGNOSA.GENDER', 'dbo.PASIEN_DIAGNOSA.GENDER', 129, 1, -1, false, 'dbo.PASIEN_DIAGNOSA.GENDER', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->GENDER->Sortable = true; // Allow sort
        $this->GENDER->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->GENDER->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->GENDER->Lookup = new Lookup('GENDER', 'SEX', false, 'GENDER', ["NAME_OF_GENDER","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->GENDER->Lookup = new Lookup('GENDER', 'SEX', false, 'GENDER', ["NAME_OF_GENDER","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->GENDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->GENDER->Param, "CustomMsg");
        $this->GENDER->SourceTableVar = 'V_SENSUS_MATA_SYARAF';
        $this->Fields['GENDER'] = &$this->GENDER;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Single column sort
    protected function updateSort(&$fld)
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
            $lastOrderBy = in_array($lastSort, ["ASC", "DESC"]) ? $sortField . " " . $lastSort : "";
            $curOrderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            if ($fld->GroupingFieldId == 0) {
                $this->setDetailOrderBy($curOrderBy); // Save to Session
            }
        } else {
            if ($fld->GroupingFieldId == 0) {
                $fld->setSort("");
            }
        }
    }

    // Get Sort SQL
    protected function sortSql()
    {
        $dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
        $argrps = [];
        foreach ($this->Fields as $fld) {
            if (in_array($fld->getSort(), ["ASC", "DESC"])) {
                $fldsql = $fld->Expression;
                if ($fld->GroupingFieldId > 0) {
                    if ($fld->GroupSql != "") {
                        $argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
                    } else {
                        $argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
                    }
                }
            }
        }
        $sortSql = "";
        foreach ($argrps as $grp) {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $grp;
        }
        if ($dtlSortSql != "") {
            if ($sortSql != "") {
                $sortSql .= ", ";
            }
            $sortSql .= $dtlSortSql;
        }
        return $sortSql;
    }

    // Summary properties
    private $sqlSelectAggregate = null;
    private $sqlAggregatePrefix = "";
    private $sqlAggregateSuffix = "";
    private $sqlSelectCount = null;

    // Select Aggregate
    public function getSqlSelectAggregate()
    {
        return $this->sqlSelectAggregate ?? $this->getQueryBuilder()->select("*");
    }

    public function setSqlSelectAggregate($v)
    {
        $this->sqlSelectAggregate = $v;
    }

    // Aggregate Prefix
    public function getSqlAggregatePrefix()
    {
        return ($this->sqlAggregatePrefix != "") ? $this->sqlAggregatePrefix : "";
    }

    public function setSqlAggregatePrefix($v)
    {
        $this->sqlAggregatePrefix = $v;
    }

    // Aggregate Suffix
    public function getSqlAggregateSuffix()
    {
        return ($this->sqlAggregateSuffix != "") ? $this->sqlAggregateSuffix : "";
    }

    public function setSqlAggregateSuffix($v)
    {
        $this->sqlAggregateSuffix = $v;
    }

    // Select Count
    public function getSqlSelectCount()
    {
        return $this->sqlSelectCount ?? $this->getQueryBuilder()->select("COUNT(*)");
    }

    public function setSqlSelectCount($v)
    {
        $this->sqlSelectCount = $v;
    }

    // Render for lookup
    public function renderLookup()
    {
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "dbo.PASIEN_DIAGNOSA";
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
        if ($this->SqlSelect) {
            return $this->SqlSelect;
        }
        $select = $this->getQueryBuilder()->select("dbo.PASIEN_DIAGNOSA.DIAGNOSA_ID, dbo.PASIEN_DIAGNOSA.GENDER");
        return $select;
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
        return $_SESSION[$name] ?? GetUrl("");
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
        if ($pageName == "") {
            return $Language->phrase("View");
        } elseif ($pageName == "") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "") {
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
                return "";
            case Config("API_ADD_ACTION"):
                return "";
            case Config("API_EDIT_ACTION"):
                return "";
            case Config("API_DELETE_ACTION"):
                return "";
            case Config("API_LIST_ACTION"):
                return "";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "?" . $this->getUrlParm($parm);
        } else {
            $url = "";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("", $this->getUrlParm($parm));
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
        return $this->keyUrl("", $this->getUrlParm());
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
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            $this->DrillDown || $DashboardReport ||
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

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
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
