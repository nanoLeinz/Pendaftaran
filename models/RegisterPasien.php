<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for register_pasien
 */
class RegisterPasien extends ReportTable
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
    public $Chart1;

    // Fields
    public $NO_REGISTRATION;
    public $VISIT_DATE;
    public $CLINIC_ID;
    public $GENDER;
    public $STATUS_PASIEN_ID;
    public $VISIT_ID;
    public $NAME_OF_CLINIC;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'register_pasien';
        $this->TableName = 'register_pasien';
        $this->TableType = 'REPORT';

        // Update Table
        $this->UpdateTable = "dbo.PASIEN_VISITATION INNER JOIN dbo.CLINIC ON dbo.PASIEN_VISITATION.CLINIC_ID = dbo.CLINIC.CLINIC_ID";
        $this->ReportSourceTable = 'V_SENSUS'; // Report source table
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

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new ReportField('register_pasien', 'register_pasien', 'x_NO_REGISTRATION', 'NO_REGISTRATION', 'dbo.PASIEN_VISITATION.NO_REGISTRATION', 'dbo.PASIEN_VISITATION.NO_REGISTRATION', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.NO_REGISTRATION', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->NO_REGISTRATION->IsPrimaryKey = true; // Primary key field
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = false; // Allow sort
        $this->NO_REGISTRATION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NO_REGISTRATION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->NO_REGISTRATION->SourceTableVar = 'V_SENSUS';
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_DATE
        $this->VISIT_DATE = new ReportField('register_pasien', 'register_pasien', 'x_VISIT_DATE', 'VISIT_DATE', 'Convert(VARCHAR,dbo.PASIEN_VISITATION.VISIT_DATE,111)', 'Convert(VARCHAR,dbo.PASIEN_VISITATION.VISIT_DATE,111)', 200, 30, 5, false, 'Convert(VARCHAR,dbo.PASIEN_VISITATION.VISIT_DATE,111)', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_DATE->Sortable = false; // Allow sort
        $this->VISIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
        $this->VISIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_DATE->Param, "CustomMsg");
        $this->VISIT_DATE->SourceTableVar = 'V_SENSUS';
        $this->Fields['VISIT_DATE'] = &$this->VISIT_DATE;

        // CLINIC_ID
        $this->CLINIC_ID = new ReportField('register_pasien', 'register_pasien', 'x_CLINIC_ID', 'CLINIC_ID', 'dbo.PASIEN_VISITATION.CLINIC_ID', 'dbo.PASIEN_VISITATION.CLINIC_ID', 200, 8, -1, false, 'dbo.PASIEN_VISITATION.CLINIC_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLINIC_ID->Sortable = false; // Allow sort
        $this->CLINIC_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLINIC_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->CLINIC_ID->Lookup = new Lookup('CLINIC_ID', 'CLINIC', false, 'CLINIC_ID', ["NAME_OF_CLINIC","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->CLINIC_ID->SourceTableVar = 'V_SENSUS';
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // GENDER
        $this->GENDER = new ReportField('register_pasien', 'register_pasien', 'x_GENDER', 'GENDER', 'dbo.PASIEN_VISITATION.GENDER', 'dbo.PASIEN_VISITATION.GENDER', 129, 1, -1, false, 'dbo.PASIEN_VISITATION.GENDER', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->GENDER->Sortable = false; // Allow sort
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
        $this->GENDER->SourceTableVar = 'V_SENSUS';
        $this->Fields['GENDER'] = &$this->GENDER;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new ReportField('register_pasien', 'register_pasien', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', 'dbo.PASIEN_VISITATION.STATUS_PASIEN_ID', 'CAST(dbo.PASIEN_VISITATION.STATUS_PASIEN_ID AS NVARCHAR)', 17, 1, -1, false, 'dbo.PASIEN_VISITATION.STATUS_PASIEN_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->STATUS_PASIEN_ID->Sortable = false; // Allow sort
        $this->STATUS_PASIEN_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->STATUS_PASIEN_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->STATUS_PASIEN_ID->Lookup = new Lookup('STATUS_PASIEN_ID', 'STATUS_PASIEN', false, 'STATUS_PASIEN_ID', ["NAME_OF_STATUS_PASIEN","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->STATUS_PASIEN_ID->Lookup = new Lookup('STATUS_PASIEN_ID', 'STATUS_PASIEN', false, 'STATUS_PASIEN_ID', ["NAME_OF_STATUS_PASIEN","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->STATUS_PASIEN_ID->SourceTableVar = 'V_SENSUS';
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // VISIT_ID
        $this->VISIT_ID = new ReportField('register_pasien', 'register_pasien', 'x_VISIT_ID', 'VISIT_ID', 'dbo.PASIEN_VISITATION.VISIT_ID', 'dbo.PASIEN_VISITATION.VISIT_ID', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.VISIT_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = false; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->VISIT_ID->SourceTableVar = 'V_SENSUS';
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // NAME_OF_CLINIC
        $this->NAME_OF_CLINIC = new ReportField('register_pasien', 'register_pasien', 'x_NAME_OF_CLINIC', 'NAME_OF_CLINIC', 'dbo.CLINIC.NAME_OF_CLINIC', 'dbo.CLINIC.NAME_OF_CLINIC', 200, 100, -1, false, 'dbo.CLINIC.NAME_OF_CLINIC', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME_OF_CLINIC->Sortable = false; // Allow sort
        $this->NAME_OF_CLINIC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME_OF_CLINIC->Param, "CustomMsg");
        $this->NAME_OF_CLINIC->SourceTableVar = 'V_SENSUS';
        $this->Fields['NAME_OF_CLINIC'] = &$this->NAME_OF_CLINIC;

        // Chart1
        $this->Chart1 = new DbChart($this, 'Chart1', 'Chart1', 'NAME_OF_CLINIC', 'VISIT_ID', 1001, '', 0, 'COUNT', 600, 500);
        $this->Chart1->SortType = 0;
        $this->Chart1->SortSequence = "";
        $this->Chart1->SqlSelect = $this->getQueryBuilder()->select("dbo.CLINIC.NAME_OF_CLINIC", "''", "COUNT(dbo.PASIEN_VISITATION.VISIT_ID)");
        $this->Chart1->SqlGroupBy = "dbo.CLINIC.NAME_OF_CLINIC";
        $this->Chart1->SqlOrderBy = "";
        $this->Chart1->SeriesDateType = "";
        $this->Chart1->ID = "register_pasien_Chart1"; // Chart ID
        $this->Chart1->setParameters([
            ["type", "1001"],
            ["seriestype", "0"]
        ]); // Chart type / Chart series type
        $this->Chart1->setParameters([
            ["caption", $this->Chart1->caption()],
            ["xaxisname", $this->Chart1->xAxisName()]
        ]); // Chart caption / X axis name
        $this->Chart1->setParameter("yaxisname", $this->Chart1->yAxisName()); // Y axis name
        $this->Chart1->setParameters([
            ["shownames", "1"],
            ["showvalues", "1"],
            ["showhovercap", "1"]
        ]); // Show names / Show values / Show hover
        $this->Chart1->setParameter("alpha", "50"); // Chart alpha
        $this->Chart1->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
        $this->Chart1->setParameters([["options.legend.display",false],["options.legend.fullWidth",false],["options.legend.reverse",false],["options.legend.labels.usePointStyle",false],["options.title.display",false],["options.tooltips.enabled",false],["options.tooltips.intersect",false],["options.tooltips.displayColors",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["scale.gridLines.offsetGridLines",false],["annotation1.show",false],["annotation1.secondaryYAxis",false],["annotation2.show",false],["annotation2.secondaryYAxis",false],["annotation3.show",false],["annotation3.secondaryYAxis",false],["annotation4.show",false],["annotation4.secondaryYAxis",false]]);
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
        $this->VISIT_DATE->ViewValue = $this->VISIT_DATE->CurrentValue;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "dbo.PASIEN_VISITATION INNER JOIN dbo.CLINIC ON dbo.PASIEN_VISITATION.CLINIC_ID = dbo.CLINIC.CLINIC_ID";
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
        $select = $this->getQueryBuilder()->select("dbo.PASIEN_VISITATION.VISIT_ID, dbo.PASIEN_VISITATION.NO_REGISTRATION, dbo.PASIEN_VISITATION.CLINIC_ID, dbo.PASIEN_VISITATION.GENDER, dbo.PASIEN_VISITATION.STATUS_PASIEN_ID, dbo.CLINIC.NAME_OF_CLINIC, CONVERT(VARCHAR,dbo.PASIEN_VISITATION.VISIT_DATE,111) AS VISIT_DATE");
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
        return "dbo.PASIEN_VISITATION.NO_REGISTRATION = '@NO_REGISTRATION@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->NO_REGISTRATION->CurrentValue : $this->NO_REGISTRATION->OldValue;
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
                $this->NO_REGISTRATION->CurrentValue = $keys[0];
            } else {
                $this->NO_REGISTRATION->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('NO_REGISTRATION', $row) ? $row['NO_REGISTRATION'] : null;
        } else {
            $val = $this->NO_REGISTRATION->OldValue !== null ? $this->NO_REGISTRATION->OldValue : $this->NO_REGISTRATION->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NO_REGISTRATION@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        $json .= "NO_REGISTRATION:" . JsonEncode($this->NO_REGISTRATION->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NO_REGISTRATION->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NO_REGISTRATION->CurrentValue);
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
            if (($keyValue = Param("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
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
                $this->NO_REGISTRATION->CurrentValue = $key;
            } else {
                $this->NO_REGISTRATION->OldValue = $key;
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
