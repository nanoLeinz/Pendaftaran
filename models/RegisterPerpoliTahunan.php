<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for register_perpoli_tahunan
 */
class RegisterPerpoliTahunan extends ReportTable
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
    public $VISIT_ID;
    public $DIANTAR_OLEH;
    public $VISIT_DATE;
    public $PAYOR_ID;
    public $CLASS_ID;
    public $ISRJ;
    public $CLINIC_ID;
    public $MONTH;
    public $YEAR;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'register_perpoli_tahunan';
        $this->TableName = 'register_perpoli_tahunan';
        $this->TableType = 'REPORT';

        // Update Table
        $this->UpdateTable = "dbo.PASIEN_VISITATION";
        $this->ReportSourceTable = 'V_KUNJUNGAN'; // Report source table
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
        $this->NO_REGISTRATION = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_NO_REGISTRATION', 'NO_REGISTRATION', 'dbo.PASIEN_VISITATION.NO_REGISTRATION', 'dbo.PASIEN_VISITATION.NO_REGISTRATION', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.NO_REGISTRATION', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->NO_REGISTRATION->IsPrimaryKey = true; // Primary key field
        $this->NO_REGISTRATION->Nullable = false; // NOT NULL field
        $this->NO_REGISTRATION->Required = true; // Required field
        $this->NO_REGISTRATION->Sortable = false; // Allow sort
        $this->NO_REGISTRATION->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->NO_REGISTRATION->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","STATUS_PASIEN_ID",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->NO_REGISTRATION->Lookup = new Lookup('NO_REGISTRATION', 'PASIEN', false, 'NO_REGISTRATION', ["NO_REGISTRATION","NAME_OF_PASIEN","STATUS_PASIEN_ID",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->NO_REGISTRATION->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_VISIT_ID', 'VISIT_ID', 'dbo.PASIEN_VISITATION.VISIT_ID', 'dbo.PASIEN_VISITATION.VISIT_ID', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.VISIT_ID', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->IsPrimaryKey = true; // Primary key field
        $this->VISIT_ID->Required = true; // Required field
        $this->VISIT_ID->Sortable = false; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->VISIT_ID->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // DIANTAR_OLEH
        $this->DIANTAR_OLEH = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_DIANTAR_OLEH', 'DIANTAR_OLEH', 'dbo.PASIEN_VISITATION.DIANTAR_OLEH', 'dbo.PASIEN_VISITATION.DIANTAR_OLEH', 200, 255, -1, false, 'dbo.PASIEN_VISITATION.DIANTAR_OLEH', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIANTAR_OLEH->Sortable = false; // Allow sort
        $this->DIANTAR_OLEH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIANTAR_OLEH->Param, "CustomMsg");
        $this->DIANTAR_OLEH->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['DIANTAR_OLEH'] = &$this->DIANTAR_OLEH;

        // VISIT_DATE
        $this->VISIT_DATE = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_VISIT_DATE', 'VISIT_DATE', 'dbo.PASIEN_VISITATION.VISIT_DATE', CastDateFieldForLike("dbo.PASIEN_VISITATION.VISIT_DATE", 11, "DB"), 135, 8, 11, false, 'dbo.PASIEN_VISITATION.VISIT_DATE', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_DATE->Sortable = false; // Allow sort
        $this->VISIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
        $this->VISIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_DATE->Param, "CustomMsg");
        $this->VISIT_DATE->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['VISIT_DATE'] = &$this->VISIT_DATE;

        // PAYOR_ID
        $this->PAYOR_ID = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_PAYOR_ID', 'PAYOR_ID', 'dbo.PASIEN_VISITATION.PAYOR_ID', 'dbo.PASIEN_VISITATION.PAYOR_ID', 200, 50, -1, false, 'dbo.PASIEN_VISITATION.PAYOR_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->PAYOR_ID->Sortable = false; // Allow sort
        $this->PAYOR_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->PAYOR_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->PAYOR_ID->Lookup = new Lookup('PAYOR_ID', 'PAYOR_INFO', false, 'PAYOR_ID', ["PAYOR","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->PAYOR_ID->Lookup = new Lookup('PAYOR_ID', 'PAYOR_INFO', false, 'PAYOR_ID', ["PAYOR","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->PAYOR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ID->Param, "CustomMsg");
        $this->PAYOR_ID->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['PAYOR_ID'] = &$this->PAYOR_ID;

        // CLASS_ID
        $this->CLASS_ID = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_CLASS_ID', 'CLASS_ID', 'dbo.PASIEN_VISITATION.CLASS_ID', 'CAST(dbo.PASIEN_VISITATION.CLASS_ID AS NVARCHAR)', 17, 1, -1, false, 'dbo.PASIEN_VISITATION.CLASS_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CLASS_ID->Sortable = false; // Allow sort
        $this->CLASS_ID->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CLASS_ID->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->CLASS_ID->Lookup = new Lookup('CLASS_ID', 'CLASS2', false, 'CLASS_ID', ["NAME_OF_CLASS","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->CLASS_ID->Lookup = new Lookup('CLASS_ID', 'CLASS2', false, 'CLASS_ID', ["NAME_OF_CLASS","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->CLASS_ID->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // ISRJ
        $this->ISRJ = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_ISRJ', 'ISRJ', 'dbo.PASIEN_VISITATION.ISRJ', 'dbo.PASIEN_VISITATION.ISRJ', 129, 1, -1, false, 'dbo.PASIEN_VISITATION.ISRJ', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->ISRJ->Sortable = false; // Allow sort
        $this->ISRJ->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->ISRJ->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->ISRJ->Lookup = new Lookup('ISRJ', 'CARA_KELUAR', false, 'KELUAR_ID', ["CARA_KELUAR","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->ISRJ->Lookup = new Lookup('ISRJ', 'CARA_KELUAR', false, 'KELUAR_ID', ["CARA_KELUAR","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->ISRJ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISRJ->Param, "CustomMsg");
        $this->ISRJ->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['ISRJ'] = &$this->ISRJ;

        // CLINIC_ID
        $this->CLINIC_ID = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_CLINIC_ID', 'CLINIC_ID', 'dbo.PASIEN_VISITATION.CLINIC_ID', 'dbo.PASIEN_VISITATION.CLINIC_ID', 200, 8, -1, false, 'dbo.PASIEN_VISITATION.CLINIC_ID', false, false, false, 'FORMATTED TEXT', 'SELECT');
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
        $this->CLINIC_ID->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // MONTH
        $this->MONTH = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_MONTH', 'MONTH', 'Month(dbo.PASIEN_VISITATION.VISIT_DATE)', 'CAST(Month(dbo.PASIEN_VISITATION.VISIT_DATE) AS NVARCHAR)', 3, 4, -1, false, 'Month(dbo.PASIEN_VISITATION.VISIT_DATE)', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MONTH->Sortable = false; // Allow sort
        $this->MONTH->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MONTH->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->MONTH->Lookup = new Lookup('MONTH', 'MONTHS', false, 'MONTH_ID', ["MONTHS","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->MONTH->Lookup = new Lookup('MONTH', 'MONTHS', false, 'MONTH_ID', ["MONTHS","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->MONTH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MONTH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MONTH->Param, "CustomMsg");
        $this->MONTH->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['MONTH'] = &$this->MONTH;

        // YEAR
        $this->YEAR = new ReportField('register_perpoli_tahunan', 'register_perpoli_tahunan', 'x_YEAR', 'YEAR', 'Year(dbo.PASIEN_VISITATION.VISIT_DATE)', 'CAST(Year(dbo.PASIEN_VISITATION.VISIT_DATE) AS NVARCHAR)', 3, 4, -1, false, 'Year(dbo.PASIEN_VISITATION.VISIT_DATE)', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->YEAR->Sortable = false; // Allow sort
        $this->YEAR->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->YEAR->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en":
                $this->YEAR->Lookup = new Lookup('YEAR', 'YEARS', false, 'YEAR_ID', ["YEAR_ID","","",""], [], [], [], [], [], [], '', '');
                break;
            default:
                $this->YEAR->Lookup = new Lookup('YEAR', 'YEARS', false, 'YEAR_ID', ["YEAR_ID","","",""], [], [], [], [], [], [], '', '');
                break;
        }
        $this->YEAR->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR->Param, "CustomMsg");
        $this->YEAR->AdvancedSearch->SearchValueDefault = INIT_VALUE;
        $this->YEAR->SourceTableVar = 'V_KUNJUNGAN';
        $this->Fields['YEAR'] = &$this->YEAR;

        // Chart1
        $this->Chart1 = new DbChart($this, 'Chart1', 'Chart1', 'MONTH', 'VISIT_ID', 1001, '', 0, 'COUNT', 600, 500);
        $this->Chart1->SortType = 0;
        $this->Chart1->SortSequence = "";
        $this->Chart1->SqlSelect = $this->getQueryBuilder()->select("Month(dbo.PASIEN_VISITATION.VISIT_DATE)", "''", "COUNT(dbo.PASIEN_VISITATION.VISIT_ID)");
        $this->Chart1->SqlGroupBy = "Month(dbo.PASIEN_VISITATION.VISIT_DATE)";
        $this->Chart1->SqlOrderBy = "";
        $this->Chart1->SeriesDateType = "";
        $this->Chart1->ID = "register_perpoli_tahunan_Chart1"; // Chart ID
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
        $this->YEAR->ViewValue = GetDropDownDisplayValue($this->YEAR->CurrentValue, "", 0);
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "dbo.PASIEN_VISITATION";
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
        $select = $this->getQueryBuilder()->select("dbo.PASIEN_VISITATION.NO_REGISTRATION, dbo.PASIEN_VISITATION.VISIT_ID, dbo.PASIEN_VISITATION.CLASS_ID, dbo.PASIEN_VISITATION.PAYOR_ID, dbo.PASIEN_VISITATION.VISIT_DATE, dbo.PASIEN_VISITATION.ISRJ, dbo.PASIEN_VISITATION.CLINIC_ID, dbo.PASIEN_VISITATION.DIANTAR_OLEH, Month(dbo.PASIEN_VISITATION.VISIT_DATE) AS MONTH, Year(dbo.PASIEN_VISITATION.VISIT_DATE) AS YEAR");
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
        return "dbo.PASIEN_VISITATION.NO_REGISTRATION = '@NO_REGISTRATION@' AND dbo.PASIEN_VISITATION.VISIT_ID = '@VISIT_ID@'";
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
        $val = $current ? $this->VISIT_ID->CurrentValue : $this->VISIT_ID->OldValue;
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
        if (count($keys) == 2) {
            if ($current) {
                $this->NO_REGISTRATION->CurrentValue = $keys[0];
            } else {
                $this->NO_REGISTRATION->OldValue = $keys[0];
            }
            if ($current) {
                $this->VISIT_ID->CurrentValue = $keys[1];
            } else {
                $this->VISIT_ID->OldValue = $keys[1];
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
        if (is_array($row)) {
            $val = array_key_exists('VISIT_ID', $row) ? $row['VISIT_ID'] : null;
        } else {
            $val = $this->VISIT_ID->OldValue !== null ? $this->VISIT_ID->OldValue : $this->VISIT_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@VISIT_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        $json .= ",VISIT_ID:" . JsonEncode($this->VISIT_ID->CurrentValue, "string");
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
        if ($this->VISIT_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->VISIT_ID->CurrentValue);
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
            for ($i = 0; $i < $cnt; $i++) {
                $arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
            }
        } else {
            if (($keyValue = Param("NO_REGISTRATION") ?? Route("NO_REGISTRATION")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("VISIT_ID") ?? Route("VISIT_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (is_array($arKeys)) {
                $arKeys[] = $arKey;
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_array($key) || count($key) != 2) {
                    continue; // Just skip so other keys will still work
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
                $this->NO_REGISTRATION->CurrentValue = $key[0];
            } else {
                $this->NO_REGISTRATION->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->VISIT_ID->CurrentValue = $key[1];
            } else {
                $this->VISIT_ID->OldValue = $key[1];
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
