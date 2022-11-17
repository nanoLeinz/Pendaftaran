<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for pbcattbl
 */
class Pbcattbl extends DbTable
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
    public $pbt_tnam;
    public $pbt_tid;
    public $pbt_ownr;
    public $pbd_fhgt;
    public $pbd_fwgt;
    public $pbd_fitl;
    public $pbd_funl;
    public $pbd_fchr;
    public $pbd_fptc;
    public $pbd_ffce;
    public $pbh_fhgt;
    public $pbh_fwgt;
    public $pbh_fitl;
    public $pbh_funl;
    public $pbh_fchr;
    public $pbh_fptc;
    public $pbh_ffce;
    public $pbl_fhgt;
    public $pbl_fwgt;
    public $pbl_fitl;
    public $pbl_funl;
    public $pbl_fchr;
    public $pbl_fptc;
    public $pbl_ffce;
    public $pbt_cmnt;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pbcattbl';
        $this->TableName = 'pbcattbl';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[pbcattbl]";
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

        // pbt_tnam
        $this->pbt_tnam = new DbField('pbcattbl', 'pbcattbl', 'x_pbt_tnam', 'pbt_tnam', '[pbt_tnam]', '[pbt_tnam]', 129, 30, -1, false, '[pbt_tnam]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbt_tnam->IsPrimaryKey = true; // Primary key field
        $this->pbt_tnam->Sortable = true; // Allow sort
        $this->pbt_tnam->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbt_tnam->Param, "CustomMsg");
        $this->Fields['pbt_tnam'] = &$this->pbt_tnam;

        // pbt_tid
        $this->pbt_tid = new DbField('pbcattbl', 'pbcattbl', 'x_pbt_tid', 'pbt_tid', '[pbt_tid]', 'CAST([pbt_tid] AS NVARCHAR)', 3, 4, -1, false, '[pbt_tid]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbt_tid->Sortable = true; // Allow sort
        $this->pbt_tid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbt_tid->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbt_tid->Param, "CustomMsg");
        $this->Fields['pbt_tid'] = &$this->pbt_tid;

        // pbt_ownr
        $this->pbt_ownr = new DbField('pbcattbl', 'pbcattbl', 'x_pbt_ownr', 'pbt_ownr', '[pbt_ownr]', '[pbt_ownr]', 129, 30, -1, false, '[pbt_ownr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbt_ownr->IsPrimaryKey = true; // Primary key field
        $this->pbt_ownr->Sortable = true; // Allow sort
        $this->pbt_ownr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbt_ownr->Param, "CustomMsg");
        $this->Fields['pbt_ownr'] = &$this->pbt_ownr;

        // pbd_fhgt
        $this->pbd_fhgt = new DbField('pbcattbl', 'pbcattbl', 'x_pbd_fhgt', 'pbd_fhgt', '[pbd_fhgt]', 'CAST([pbd_fhgt] AS NVARCHAR)', 2, 2, -1, false, '[pbd_fhgt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbd_fhgt->Sortable = true; // Allow sort
        $this->pbd_fhgt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbd_fhgt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbd_fhgt->Param, "CustomMsg");
        $this->Fields['pbd_fhgt'] = &$this->pbd_fhgt;

        // pbd_fwgt
        $this->pbd_fwgt = new DbField('pbcattbl', 'pbcattbl', 'x_pbd_fwgt', 'pbd_fwgt', '[pbd_fwgt]', 'CAST([pbd_fwgt] AS NVARCHAR)', 2, 2, -1, false, '[pbd_fwgt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbd_fwgt->Sortable = true; // Allow sort
        $this->pbd_fwgt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbd_fwgt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbd_fwgt->Param, "CustomMsg");
        $this->Fields['pbd_fwgt'] = &$this->pbd_fwgt;

        // pbd_fitl
        $this->pbd_fitl = new DbField('pbcattbl', 'pbcattbl', 'x_pbd_fitl', 'pbd_fitl', '[pbd_fitl]', '[pbd_fitl]', 129, 1, -1, false, '[pbd_fitl]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbd_fitl->Sortable = true; // Allow sort
        $this->pbd_fitl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbd_fitl->Param, "CustomMsg");
        $this->Fields['pbd_fitl'] = &$this->pbd_fitl;

        // pbd_funl
        $this->pbd_funl = new DbField('pbcattbl', 'pbcattbl', 'x_pbd_funl', 'pbd_funl', '[pbd_funl]', '[pbd_funl]', 129, 1, -1, false, '[pbd_funl]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbd_funl->Sortable = true; // Allow sort
        $this->pbd_funl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbd_funl->Param, "CustomMsg");
        $this->Fields['pbd_funl'] = &$this->pbd_funl;

        // pbd_fchr
        $this->pbd_fchr = new DbField('pbcattbl', 'pbcattbl', 'x_pbd_fchr', 'pbd_fchr', '[pbd_fchr]', 'CAST([pbd_fchr] AS NVARCHAR)', 2, 2, -1, false, '[pbd_fchr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbd_fchr->Sortable = true; // Allow sort
        $this->pbd_fchr->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbd_fchr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbd_fchr->Param, "CustomMsg");
        $this->Fields['pbd_fchr'] = &$this->pbd_fchr;

        // pbd_fptc
        $this->pbd_fptc = new DbField('pbcattbl', 'pbcattbl', 'x_pbd_fptc', 'pbd_fptc', '[pbd_fptc]', 'CAST([pbd_fptc] AS NVARCHAR)', 2, 2, -1, false, '[pbd_fptc]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbd_fptc->Sortable = true; // Allow sort
        $this->pbd_fptc->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbd_fptc->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbd_fptc->Param, "CustomMsg");
        $this->Fields['pbd_fptc'] = &$this->pbd_fptc;

        // pbd_ffce
        $this->pbd_ffce = new DbField('pbcattbl', 'pbcattbl', 'x_pbd_ffce', 'pbd_ffce', '[pbd_ffce]', '[pbd_ffce]', 129, 32, -1, false, '[pbd_ffce]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbd_ffce->Sortable = true; // Allow sort
        $this->pbd_ffce->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbd_ffce->Param, "CustomMsg");
        $this->Fields['pbd_ffce'] = &$this->pbd_ffce;

        // pbh_fhgt
        $this->pbh_fhgt = new DbField('pbcattbl', 'pbcattbl', 'x_pbh_fhgt', 'pbh_fhgt', '[pbh_fhgt]', 'CAST([pbh_fhgt] AS NVARCHAR)', 2, 2, -1, false, '[pbh_fhgt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbh_fhgt->Sortable = true; // Allow sort
        $this->pbh_fhgt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbh_fhgt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbh_fhgt->Param, "CustomMsg");
        $this->Fields['pbh_fhgt'] = &$this->pbh_fhgt;

        // pbh_fwgt
        $this->pbh_fwgt = new DbField('pbcattbl', 'pbcattbl', 'x_pbh_fwgt', 'pbh_fwgt', '[pbh_fwgt]', 'CAST([pbh_fwgt] AS NVARCHAR)', 2, 2, -1, false, '[pbh_fwgt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbh_fwgt->Sortable = true; // Allow sort
        $this->pbh_fwgt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbh_fwgt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbh_fwgt->Param, "CustomMsg");
        $this->Fields['pbh_fwgt'] = &$this->pbh_fwgt;

        // pbh_fitl
        $this->pbh_fitl = new DbField('pbcattbl', 'pbcattbl', 'x_pbh_fitl', 'pbh_fitl', '[pbh_fitl]', '[pbh_fitl]', 129, 1, -1, false, '[pbh_fitl]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbh_fitl->Sortable = true; // Allow sort
        $this->pbh_fitl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbh_fitl->Param, "CustomMsg");
        $this->Fields['pbh_fitl'] = &$this->pbh_fitl;

        // pbh_funl
        $this->pbh_funl = new DbField('pbcattbl', 'pbcattbl', 'x_pbh_funl', 'pbh_funl', '[pbh_funl]', '[pbh_funl]', 129, 1, -1, false, '[pbh_funl]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbh_funl->Sortable = true; // Allow sort
        $this->pbh_funl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbh_funl->Param, "CustomMsg");
        $this->Fields['pbh_funl'] = &$this->pbh_funl;

        // pbh_fchr
        $this->pbh_fchr = new DbField('pbcattbl', 'pbcattbl', 'x_pbh_fchr', 'pbh_fchr', '[pbh_fchr]', 'CAST([pbh_fchr] AS NVARCHAR)', 2, 2, -1, false, '[pbh_fchr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbh_fchr->Sortable = true; // Allow sort
        $this->pbh_fchr->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbh_fchr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbh_fchr->Param, "CustomMsg");
        $this->Fields['pbh_fchr'] = &$this->pbh_fchr;

        // pbh_fptc
        $this->pbh_fptc = new DbField('pbcattbl', 'pbcattbl', 'x_pbh_fptc', 'pbh_fptc', '[pbh_fptc]', 'CAST([pbh_fptc] AS NVARCHAR)', 2, 2, -1, false, '[pbh_fptc]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbh_fptc->Sortable = true; // Allow sort
        $this->pbh_fptc->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbh_fptc->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbh_fptc->Param, "CustomMsg");
        $this->Fields['pbh_fptc'] = &$this->pbh_fptc;

        // pbh_ffce
        $this->pbh_ffce = new DbField('pbcattbl', 'pbcattbl', 'x_pbh_ffce', 'pbh_ffce', '[pbh_ffce]', '[pbh_ffce]', 129, 32, -1, false, '[pbh_ffce]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbh_ffce->Sortable = true; // Allow sort
        $this->pbh_ffce->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbh_ffce->Param, "CustomMsg");
        $this->Fields['pbh_ffce'] = &$this->pbh_ffce;

        // pbl_fhgt
        $this->pbl_fhgt = new DbField('pbcattbl', 'pbcattbl', 'x_pbl_fhgt', 'pbl_fhgt', '[pbl_fhgt]', 'CAST([pbl_fhgt] AS NVARCHAR)', 2, 2, -1, false, '[pbl_fhgt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbl_fhgt->Sortable = true; // Allow sort
        $this->pbl_fhgt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbl_fhgt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbl_fhgt->Param, "CustomMsg");
        $this->Fields['pbl_fhgt'] = &$this->pbl_fhgt;

        // pbl_fwgt
        $this->pbl_fwgt = new DbField('pbcattbl', 'pbcattbl', 'x_pbl_fwgt', 'pbl_fwgt', '[pbl_fwgt]', 'CAST([pbl_fwgt] AS NVARCHAR)', 2, 2, -1, false, '[pbl_fwgt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbl_fwgt->Sortable = true; // Allow sort
        $this->pbl_fwgt->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbl_fwgt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbl_fwgt->Param, "CustomMsg");
        $this->Fields['pbl_fwgt'] = &$this->pbl_fwgt;

        // pbl_fitl
        $this->pbl_fitl = new DbField('pbcattbl', 'pbcattbl', 'x_pbl_fitl', 'pbl_fitl', '[pbl_fitl]', '[pbl_fitl]', 129, 1, -1, false, '[pbl_fitl]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbl_fitl->Sortable = true; // Allow sort
        $this->pbl_fitl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbl_fitl->Param, "CustomMsg");
        $this->Fields['pbl_fitl'] = &$this->pbl_fitl;

        // pbl_funl
        $this->pbl_funl = new DbField('pbcattbl', 'pbcattbl', 'x_pbl_funl', 'pbl_funl', '[pbl_funl]', '[pbl_funl]', 129, 1, -1, false, '[pbl_funl]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbl_funl->Sortable = true; // Allow sort
        $this->pbl_funl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbl_funl->Param, "CustomMsg");
        $this->Fields['pbl_funl'] = &$this->pbl_funl;

        // pbl_fchr
        $this->pbl_fchr = new DbField('pbcattbl', 'pbcattbl', 'x_pbl_fchr', 'pbl_fchr', '[pbl_fchr]', 'CAST([pbl_fchr] AS NVARCHAR)', 2, 2, -1, false, '[pbl_fchr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbl_fchr->Sortable = true; // Allow sort
        $this->pbl_fchr->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbl_fchr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbl_fchr->Param, "CustomMsg");
        $this->Fields['pbl_fchr'] = &$this->pbl_fchr;

        // pbl_fptc
        $this->pbl_fptc = new DbField('pbcattbl', 'pbcattbl', 'x_pbl_fptc', 'pbl_fptc', '[pbl_fptc]', 'CAST([pbl_fptc] AS NVARCHAR)', 2, 2, -1, false, '[pbl_fptc]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbl_fptc->Sortable = true; // Allow sort
        $this->pbl_fptc->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbl_fptc->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbl_fptc->Param, "CustomMsg");
        $this->Fields['pbl_fptc'] = &$this->pbl_fptc;

        // pbl_ffce
        $this->pbl_ffce = new DbField('pbcattbl', 'pbcattbl', 'x_pbl_ffce', 'pbl_ffce', '[pbl_ffce]', '[pbl_ffce]', 129, 32, -1, false, '[pbl_ffce]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbl_ffce->Sortable = true; // Allow sort
        $this->pbl_ffce->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbl_ffce->Param, "CustomMsg");
        $this->Fields['pbl_ffce'] = &$this->pbl_ffce;

        // pbt_cmnt
        $this->pbt_cmnt = new DbField('pbcattbl', 'pbcattbl', 'x_pbt_cmnt', 'pbt_cmnt', '[pbt_cmnt]', '[pbt_cmnt]', 200, 254, -1, false, '[pbt_cmnt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbt_cmnt->Sortable = true; // Allow sort
        $this->pbt_cmnt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbt_cmnt->Param, "CustomMsg");
        $this->Fields['pbt_cmnt'] = &$this->pbt_cmnt;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[pbcattbl]";
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
            if (array_key_exists('pbt_tnam', $rs)) {
                AddFilter($where, QuotedName('pbt_tnam', $this->Dbid) . '=' . QuotedValue($rs['pbt_tnam'], $this->pbt_tnam->DataType, $this->Dbid));
            }
            if (array_key_exists('pbt_ownr', $rs)) {
                AddFilter($where, QuotedName('pbt_ownr', $this->Dbid) . '=' . QuotedValue($rs['pbt_ownr'], $this->pbt_ownr->DataType, $this->Dbid));
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
        $this->pbt_tnam->DbValue = $row['pbt_tnam'];
        $this->pbt_tid->DbValue = $row['pbt_tid'];
        $this->pbt_ownr->DbValue = $row['pbt_ownr'];
        $this->pbd_fhgt->DbValue = $row['pbd_fhgt'];
        $this->pbd_fwgt->DbValue = $row['pbd_fwgt'];
        $this->pbd_fitl->DbValue = $row['pbd_fitl'];
        $this->pbd_funl->DbValue = $row['pbd_funl'];
        $this->pbd_fchr->DbValue = $row['pbd_fchr'];
        $this->pbd_fptc->DbValue = $row['pbd_fptc'];
        $this->pbd_ffce->DbValue = $row['pbd_ffce'];
        $this->pbh_fhgt->DbValue = $row['pbh_fhgt'];
        $this->pbh_fwgt->DbValue = $row['pbh_fwgt'];
        $this->pbh_fitl->DbValue = $row['pbh_fitl'];
        $this->pbh_funl->DbValue = $row['pbh_funl'];
        $this->pbh_fchr->DbValue = $row['pbh_fchr'];
        $this->pbh_fptc->DbValue = $row['pbh_fptc'];
        $this->pbh_ffce->DbValue = $row['pbh_ffce'];
        $this->pbl_fhgt->DbValue = $row['pbl_fhgt'];
        $this->pbl_fwgt->DbValue = $row['pbl_fwgt'];
        $this->pbl_fitl->DbValue = $row['pbl_fitl'];
        $this->pbl_funl->DbValue = $row['pbl_funl'];
        $this->pbl_fchr->DbValue = $row['pbl_fchr'];
        $this->pbl_fptc->DbValue = $row['pbl_fptc'];
        $this->pbl_ffce->DbValue = $row['pbl_ffce'];
        $this->pbt_cmnt->DbValue = $row['pbt_cmnt'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[pbt_tnam] = '@pbt_tnam@' AND [pbt_ownr] = '@pbt_ownr@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->pbt_tnam->CurrentValue : $this->pbt_tnam->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->pbt_ownr->CurrentValue : $this->pbt_ownr->OldValue;
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
                $this->pbt_tnam->CurrentValue = $keys[0];
            } else {
                $this->pbt_tnam->OldValue = $keys[0];
            }
            if ($current) {
                $this->pbt_ownr->CurrentValue = $keys[1];
            } else {
                $this->pbt_ownr->OldValue = $keys[1];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('pbt_tnam', $row) ? $row['pbt_tnam'] : null;
        } else {
            $val = $this->pbt_tnam->OldValue !== null ? $this->pbt_tnam->OldValue : $this->pbt_tnam->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@pbt_tnam@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('pbt_ownr', $row) ? $row['pbt_ownr'] : null;
        } else {
            $val = $this->pbt_ownr->OldValue !== null ? $this->pbt_ownr->OldValue : $this->pbt_ownr->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@pbt_ownr@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PbcattblList");
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
        if ($pageName == "PbcattblView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PbcattblEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PbcattblAdd") {
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
                return "PbcattblView";
            case Config("API_ADD_ACTION"):
                return "PbcattblAdd";
            case Config("API_EDIT_ACTION"):
                return "PbcattblEdit";
            case Config("API_DELETE_ACTION"):
                return "PbcattblDelete";
            case Config("API_LIST_ACTION"):
                return "PbcattblList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PbcattblList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PbcattblView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PbcattblView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PbcattblAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PbcattblAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PbcattblEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PbcattblAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PbcattblDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "pbt_tnam:" . JsonEncode($this->pbt_tnam->CurrentValue, "string");
        $json .= ",pbt_ownr:" . JsonEncode($this->pbt_ownr->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->pbt_tnam->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->pbt_tnam->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->pbt_ownr->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->pbt_ownr->CurrentValue);
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
            for ($i = 0; $i < $cnt; $i++) {
                $arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
            }
        } else {
            if (($keyValue = Param("pbt_tnam") ?? Route("pbt_tnam")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("pbt_ownr") ?? Route("pbt_ownr")) !== null) {
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
                $this->pbt_tnam->CurrentValue = $key[0];
            } else {
                $this->pbt_tnam->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->pbt_ownr->CurrentValue = $key[1];
            } else {
                $this->pbt_ownr->OldValue = $key[1];
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
        $this->pbt_tnam->setDbValue($row['pbt_tnam']);
        $this->pbt_tid->setDbValue($row['pbt_tid']);
        $this->pbt_ownr->setDbValue($row['pbt_ownr']);
        $this->pbd_fhgt->setDbValue($row['pbd_fhgt']);
        $this->pbd_fwgt->setDbValue($row['pbd_fwgt']);
        $this->pbd_fitl->setDbValue($row['pbd_fitl']);
        $this->pbd_funl->setDbValue($row['pbd_funl']);
        $this->pbd_fchr->setDbValue($row['pbd_fchr']);
        $this->pbd_fptc->setDbValue($row['pbd_fptc']);
        $this->pbd_ffce->setDbValue($row['pbd_ffce']);
        $this->pbh_fhgt->setDbValue($row['pbh_fhgt']);
        $this->pbh_fwgt->setDbValue($row['pbh_fwgt']);
        $this->pbh_fitl->setDbValue($row['pbh_fitl']);
        $this->pbh_funl->setDbValue($row['pbh_funl']);
        $this->pbh_fchr->setDbValue($row['pbh_fchr']);
        $this->pbh_fptc->setDbValue($row['pbh_fptc']);
        $this->pbh_ffce->setDbValue($row['pbh_ffce']);
        $this->pbl_fhgt->setDbValue($row['pbl_fhgt']);
        $this->pbl_fwgt->setDbValue($row['pbl_fwgt']);
        $this->pbl_fitl->setDbValue($row['pbl_fitl']);
        $this->pbl_funl->setDbValue($row['pbl_funl']);
        $this->pbl_fchr->setDbValue($row['pbl_fchr']);
        $this->pbl_fptc->setDbValue($row['pbl_fptc']);
        $this->pbl_ffce->setDbValue($row['pbl_ffce']);
        $this->pbt_cmnt->setDbValue($row['pbt_cmnt']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // pbt_tnam

        // pbt_tid

        // pbt_ownr

        // pbd_fhgt

        // pbd_fwgt

        // pbd_fitl

        // pbd_funl

        // pbd_fchr

        // pbd_fptc

        // pbd_ffce

        // pbh_fhgt

        // pbh_fwgt

        // pbh_fitl

        // pbh_funl

        // pbh_fchr

        // pbh_fptc

        // pbh_ffce

        // pbl_fhgt

        // pbl_fwgt

        // pbl_fitl

        // pbl_funl

        // pbl_fchr

        // pbl_fptc

        // pbl_ffce

        // pbt_cmnt

        // pbt_tnam
        $this->pbt_tnam->ViewValue = $this->pbt_tnam->CurrentValue;
        $this->pbt_tnam->ViewCustomAttributes = "";

        // pbt_tid
        $this->pbt_tid->ViewValue = $this->pbt_tid->CurrentValue;
        $this->pbt_tid->ViewValue = FormatNumber($this->pbt_tid->ViewValue, 0, -2, -2, -2);
        $this->pbt_tid->ViewCustomAttributes = "";

        // pbt_ownr
        $this->pbt_ownr->ViewValue = $this->pbt_ownr->CurrentValue;
        $this->pbt_ownr->ViewCustomAttributes = "";

        // pbd_fhgt
        $this->pbd_fhgt->ViewValue = $this->pbd_fhgt->CurrentValue;
        $this->pbd_fhgt->ViewValue = FormatNumber($this->pbd_fhgt->ViewValue, 0, -2, -2, -2);
        $this->pbd_fhgt->ViewCustomAttributes = "";

        // pbd_fwgt
        $this->pbd_fwgt->ViewValue = $this->pbd_fwgt->CurrentValue;
        $this->pbd_fwgt->ViewValue = FormatNumber($this->pbd_fwgt->ViewValue, 0, -2, -2, -2);
        $this->pbd_fwgt->ViewCustomAttributes = "";

        // pbd_fitl
        $this->pbd_fitl->ViewValue = $this->pbd_fitl->CurrentValue;
        $this->pbd_fitl->ViewCustomAttributes = "";

        // pbd_funl
        $this->pbd_funl->ViewValue = $this->pbd_funl->CurrentValue;
        $this->pbd_funl->ViewCustomAttributes = "";

        // pbd_fchr
        $this->pbd_fchr->ViewValue = $this->pbd_fchr->CurrentValue;
        $this->pbd_fchr->ViewValue = FormatNumber($this->pbd_fchr->ViewValue, 0, -2, -2, -2);
        $this->pbd_fchr->ViewCustomAttributes = "";

        // pbd_fptc
        $this->pbd_fptc->ViewValue = $this->pbd_fptc->CurrentValue;
        $this->pbd_fptc->ViewValue = FormatNumber($this->pbd_fptc->ViewValue, 0, -2, -2, -2);
        $this->pbd_fptc->ViewCustomAttributes = "";

        // pbd_ffce
        $this->pbd_ffce->ViewValue = $this->pbd_ffce->CurrentValue;
        $this->pbd_ffce->ViewCustomAttributes = "";

        // pbh_fhgt
        $this->pbh_fhgt->ViewValue = $this->pbh_fhgt->CurrentValue;
        $this->pbh_fhgt->ViewValue = FormatNumber($this->pbh_fhgt->ViewValue, 0, -2, -2, -2);
        $this->pbh_fhgt->ViewCustomAttributes = "";

        // pbh_fwgt
        $this->pbh_fwgt->ViewValue = $this->pbh_fwgt->CurrentValue;
        $this->pbh_fwgt->ViewValue = FormatNumber($this->pbh_fwgt->ViewValue, 0, -2, -2, -2);
        $this->pbh_fwgt->ViewCustomAttributes = "";

        // pbh_fitl
        $this->pbh_fitl->ViewValue = $this->pbh_fitl->CurrentValue;
        $this->pbh_fitl->ViewCustomAttributes = "";

        // pbh_funl
        $this->pbh_funl->ViewValue = $this->pbh_funl->CurrentValue;
        $this->pbh_funl->ViewCustomAttributes = "";

        // pbh_fchr
        $this->pbh_fchr->ViewValue = $this->pbh_fchr->CurrentValue;
        $this->pbh_fchr->ViewValue = FormatNumber($this->pbh_fchr->ViewValue, 0, -2, -2, -2);
        $this->pbh_fchr->ViewCustomAttributes = "";

        // pbh_fptc
        $this->pbh_fptc->ViewValue = $this->pbh_fptc->CurrentValue;
        $this->pbh_fptc->ViewValue = FormatNumber($this->pbh_fptc->ViewValue, 0, -2, -2, -2);
        $this->pbh_fptc->ViewCustomAttributes = "";

        // pbh_ffce
        $this->pbh_ffce->ViewValue = $this->pbh_ffce->CurrentValue;
        $this->pbh_ffce->ViewCustomAttributes = "";

        // pbl_fhgt
        $this->pbl_fhgt->ViewValue = $this->pbl_fhgt->CurrentValue;
        $this->pbl_fhgt->ViewValue = FormatNumber($this->pbl_fhgt->ViewValue, 0, -2, -2, -2);
        $this->pbl_fhgt->ViewCustomAttributes = "";

        // pbl_fwgt
        $this->pbl_fwgt->ViewValue = $this->pbl_fwgt->CurrentValue;
        $this->pbl_fwgt->ViewValue = FormatNumber($this->pbl_fwgt->ViewValue, 0, -2, -2, -2);
        $this->pbl_fwgt->ViewCustomAttributes = "";

        // pbl_fitl
        $this->pbl_fitl->ViewValue = $this->pbl_fitl->CurrentValue;
        $this->pbl_fitl->ViewCustomAttributes = "";

        // pbl_funl
        $this->pbl_funl->ViewValue = $this->pbl_funl->CurrentValue;
        $this->pbl_funl->ViewCustomAttributes = "";

        // pbl_fchr
        $this->pbl_fchr->ViewValue = $this->pbl_fchr->CurrentValue;
        $this->pbl_fchr->ViewValue = FormatNumber($this->pbl_fchr->ViewValue, 0, -2, -2, -2);
        $this->pbl_fchr->ViewCustomAttributes = "";

        // pbl_fptc
        $this->pbl_fptc->ViewValue = $this->pbl_fptc->CurrentValue;
        $this->pbl_fptc->ViewValue = FormatNumber($this->pbl_fptc->ViewValue, 0, -2, -2, -2);
        $this->pbl_fptc->ViewCustomAttributes = "";

        // pbl_ffce
        $this->pbl_ffce->ViewValue = $this->pbl_ffce->CurrentValue;
        $this->pbl_ffce->ViewCustomAttributes = "";

        // pbt_cmnt
        $this->pbt_cmnt->ViewValue = $this->pbt_cmnt->CurrentValue;
        $this->pbt_cmnt->ViewCustomAttributes = "";

        // pbt_tnam
        $this->pbt_tnam->LinkCustomAttributes = "";
        $this->pbt_tnam->HrefValue = "";
        $this->pbt_tnam->TooltipValue = "";

        // pbt_tid
        $this->pbt_tid->LinkCustomAttributes = "";
        $this->pbt_tid->HrefValue = "";
        $this->pbt_tid->TooltipValue = "";

        // pbt_ownr
        $this->pbt_ownr->LinkCustomAttributes = "";
        $this->pbt_ownr->HrefValue = "";
        $this->pbt_ownr->TooltipValue = "";

        // pbd_fhgt
        $this->pbd_fhgt->LinkCustomAttributes = "";
        $this->pbd_fhgt->HrefValue = "";
        $this->pbd_fhgt->TooltipValue = "";

        // pbd_fwgt
        $this->pbd_fwgt->LinkCustomAttributes = "";
        $this->pbd_fwgt->HrefValue = "";
        $this->pbd_fwgt->TooltipValue = "";

        // pbd_fitl
        $this->pbd_fitl->LinkCustomAttributes = "";
        $this->pbd_fitl->HrefValue = "";
        $this->pbd_fitl->TooltipValue = "";

        // pbd_funl
        $this->pbd_funl->LinkCustomAttributes = "";
        $this->pbd_funl->HrefValue = "";
        $this->pbd_funl->TooltipValue = "";

        // pbd_fchr
        $this->pbd_fchr->LinkCustomAttributes = "";
        $this->pbd_fchr->HrefValue = "";
        $this->pbd_fchr->TooltipValue = "";

        // pbd_fptc
        $this->pbd_fptc->LinkCustomAttributes = "";
        $this->pbd_fptc->HrefValue = "";
        $this->pbd_fptc->TooltipValue = "";

        // pbd_ffce
        $this->pbd_ffce->LinkCustomAttributes = "";
        $this->pbd_ffce->HrefValue = "";
        $this->pbd_ffce->TooltipValue = "";

        // pbh_fhgt
        $this->pbh_fhgt->LinkCustomAttributes = "";
        $this->pbh_fhgt->HrefValue = "";
        $this->pbh_fhgt->TooltipValue = "";

        // pbh_fwgt
        $this->pbh_fwgt->LinkCustomAttributes = "";
        $this->pbh_fwgt->HrefValue = "";
        $this->pbh_fwgt->TooltipValue = "";

        // pbh_fitl
        $this->pbh_fitl->LinkCustomAttributes = "";
        $this->pbh_fitl->HrefValue = "";
        $this->pbh_fitl->TooltipValue = "";

        // pbh_funl
        $this->pbh_funl->LinkCustomAttributes = "";
        $this->pbh_funl->HrefValue = "";
        $this->pbh_funl->TooltipValue = "";

        // pbh_fchr
        $this->pbh_fchr->LinkCustomAttributes = "";
        $this->pbh_fchr->HrefValue = "";
        $this->pbh_fchr->TooltipValue = "";

        // pbh_fptc
        $this->pbh_fptc->LinkCustomAttributes = "";
        $this->pbh_fptc->HrefValue = "";
        $this->pbh_fptc->TooltipValue = "";

        // pbh_ffce
        $this->pbh_ffce->LinkCustomAttributes = "";
        $this->pbh_ffce->HrefValue = "";
        $this->pbh_ffce->TooltipValue = "";

        // pbl_fhgt
        $this->pbl_fhgt->LinkCustomAttributes = "";
        $this->pbl_fhgt->HrefValue = "";
        $this->pbl_fhgt->TooltipValue = "";

        // pbl_fwgt
        $this->pbl_fwgt->LinkCustomAttributes = "";
        $this->pbl_fwgt->HrefValue = "";
        $this->pbl_fwgt->TooltipValue = "";

        // pbl_fitl
        $this->pbl_fitl->LinkCustomAttributes = "";
        $this->pbl_fitl->HrefValue = "";
        $this->pbl_fitl->TooltipValue = "";

        // pbl_funl
        $this->pbl_funl->LinkCustomAttributes = "";
        $this->pbl_funl->HrefValue = "";
        $this->pbl_funl->TooltipValue = "";

        // pbl_fchr
        $this->pbl_fchr->LinkCustomAttributes = "";
        $this->pbl_fchr->HrefValue = "";
        $this->pbl_fchr->TooltipValue = "";

        // pbl_fptc
        $this->pbl_fptc->LinkCustomAttributes = "";
        $this->pbl_fptc->HrefValue = "";
        $this->pbl_fptc->TooltipValue = "";

        // pbl_ffce
        $this->pbl_ffce->LinkCustomAttributes = "";
        $this->pbl_ffce->HrefValue = "";
        $this->pbl_ffce->TooltipValue = "";

        // pbt_cmnt
        $this->pbt_cmnt->LinkCustomAttributes = "";
        $this->pbt_cmnt->HrefValue = "";
        $this->pbt_cmnt->TooltipValue = "";

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

        // pbt_tnam
        $this->pbt_tnam->EditAttrs["class"] = "form-control";
        $this->pbt_tnam->EditCustomAttributes = "";
        if (!$this->pbt_tnam->Raw) {
            $this->pbt_tnam->CurrentValue = HtmlDecode($this->pbt_tnam->CurrentValue);
        }
        $this->pbt_tnam->EditValue = $this->pbt_tnam->CurrentValue;
        $this->pbt_tnam->PlaceHolder = RemoveHtml($this->pbt_tnam->caption());

        // pbt_tid
        $this->pbt_tid->EditAttrs["class"] = "form-control";
        $this->pbt_tid->EditCustomAttributes = "";
        $this->pbt_tid->EditValue = $this->pbt_tid->CurrentValue;
        $this->pbt_tid->PlaceHolder = RemoveHtml($this->pbt_tid->caption());

        // pbt_ownr
        $this->pbt_ownr->EditAttrs["class"] = "form-control";
        $this->pbt_ownr->EditCustomAttributes = "";
        if (!$this->pbt_ownr->Raw) {
            $this->pbt_ownr->CurrentValue = HtmlDecode($this->pbt_ownr->CurrentValue);
        }
        $this->pbt_ownr->EditValue = $this->pbt_ownr->CurrentValue;
        $this->pbt_ownr->PlaceHolder = RemoveHtml($this->pbt_ownr->caption());

        // pbd_fhgt
        $this->pbd_fhgt->EditAttrs["class"] = "form-control";
        $this->pbd_fhgt->EditCustomAttributes = "";
        $this->pbd_fhgt->EditValue = $this->pbd_fhgt->CurrentValue;
        $this->pbd_fhgt->PlaceHolder = RemoveHtml($this->pbd_fhgt->caption());

        // pbd_fwgt
        $this->pbd_fwgt->EditAttrs["class"] = "form-control";
        $this->pbd_fwgt->EditCustomAttributes = "";
        $this->pbd_fwgt->EditValue = $this->pbd_fwgt->CurrentValue;
        $this->pbd_fwgt->PlaceHolder = RemoveHtml($this->pbd_fwgt->caption());

        // pbd_fitl
        $this->pbd_fitl->EditAttrs["class"] = "form-control";
        $this->pbd_fitl->EditCustomAttributes = "";
        if (!$this->pbd_fitl->Raw) {
            $this->pbd_fitl->CurrentValue = HtmlDecode($this->pbd_fitl->CurrentValue);
        }
        $this->pbd_fitl->EditValue = $this->pbd_fitl->CurrentValue;
        $this->pbd_fitl->PlaceHolder = RemoveHtml($this->pbd_fitl->caption());

        // pbd_funl
        $this->pbd_funl->EditAttrs["class"] = "form-control";
        $this->pbd_funl->EditCustomAttributes = "";
        if (!$this->pbd_funl->Raw) {
            $this->pbd_funl->CurrentValue = HtmlDecode($this->pbd_funl->CurrentValue);
        }
        $this->pbd_funl->EditValue = $this->pbd_funl->CurrentValue;
        $this->pbd_funl->PlaceHolder = RemoveHtml($this->pbd_funl->caption());

        // pbd_fchr
        $this->pbd_fchr->EditAttrs["class"] = "form-control";
        $this->pbd_fchr->EditCustomAttributes = "";
        $this->pbd_fchr->EditValue = $this->pbd_fchr->CurrentValue;
        $this->pbd_fchr->PlaceHolder = RemoveHtml($this->pbd_fchr->caption());

        // pbd_fptc
        $this->pbd_fptc->EditAttrs["class"] = "form-control";
        $this->pbd_fptc->EditCustomAttributes = "";
        $this->pbd_fptc->EditValue = $this->pbd_fptc->CurrentValue;
        $this->pbd_fptc->PlaceHolder = RemoveHtml($this->pbd_fptc->caption());

        // pbd_ffce
        $this->pbd_ffce->EditAttrs["class"] = "form-control";
        $this->pbd_ffce->EditCustomAttributes = "";
        if (!$this->pbd_ffce->Raw) {
            $this->pbd_ffce->CurrentValue = HtmlDecode($this->pbd_ffce->CurrentValue);
        }
        $this->pbd_ffce->EditValue = $this->pbd_ffce->CurrentValue;
        $this->pbd_ffce->PlaceHolder = RemoveHtml($this->pbd_ffce->caption());

        // pbh_fhgt
        $this->pbh_fhgt->EditAttrs["class"] = "form-control";
        $this->pbh_fhgt->EditCustomAttributes = "";
        $this->pbh_fhgt->EditValue = $this->pbh_fhgt->CurrentValue;
        $this->pbh_fhgt->PlaceHolder = RemoveHtml($this->pbh_fhgt->caption());

        // pbh_fwgt
        $this->pbh_fwgt->EditAttrs["class"] = "form-control";
        $this->pbh_fwgt->EditCustomAttributes = "";
        $this->pbh_fwgt->EditValue = $this->pbh_fwgt->CurrentValue;
        $this->pbh_fwgt->PlaceHolder = RemoveHtml($this->pbh_fwgt->caption());

        // pbh_fitl
        $this->pbh_fitl->EditAttrs["class"] = "form-control";
        $this->pbh_fitl->EditCustomAttributes = "";
        if (!$this->pbh_fitl->Raw) {
            $this->pbh_fitl->CurrentValue = HtmlDecode($this->pbh_fitl->CurrentValue);
        }
        $this->pbh_fitl->EditValue = $this->pbh_fitl->CurrentValue;
        $this->pbh_fitl->PlaceHolder = RemoveHtml($this->pbh_fitl->caption());

        // pbh_funl
        $this->pbh_funl->EditAttrs["class"] = "form-control";
        $this->pbh_funl->EditCustomAttributes = "";
        if (!$this->pbh_funl->Raw) {
            $this->pbh_funl->CurrentValue = HtmlDecode($this->pbh_funl->CurrentValue);
        }
        $this->pbh_funl->EditValue = $this->pbh_funl->CurrentValue;
        $this->pbh_funl->PlaceHolder = RemoveHtml($this->pbh_funl->caption());

        // pbh_fchr
        $this->pbh_fchr->EditAttrs["class"] = "form-control";
        $this->pbh_fchr->EditCustomAttributes = "";
        $this->pbh_fchr->EditValue = $this->pbh_fchr->CurrentValue;
        $this->pbh_fchr->PlaceHolder = RemoveHtml($this->pbh_fchr->caption());

        // pbh_fptc
        $this->pbh_fptc->EditAttrs["class"] = "form-control";
        $this->pbh_fptc->EditCustomAttributes = "";
        $this->pbh_fptc->EditValue = $this->pbh_fptc->CurrentValue;
        $this->pbh_fptc->PlaceHolder = RemoveHtml($this->pbh_fptc->caption());

        // pbh_ffce
        $this->pbh_ffce->EditAttrs["class"] = "form-control";
        $this->pbh_ffce->EditCustomAttributes = "";
        if (!$this->pbh_ffce->Raw) {
            $this->pbh_ffce->CurrentValue = HtmlDecode($this->pbh_ffce->CurrentValue);
        }
        $this->pbh_ffce->EditValue = $this->pbh_ffce->CurrentValue;
        $this->pbh_ffce->PlaceHolder = RemoveHtml($this->pbh_ffce->caption());

        // pbl_fhgt
        $this->pbl_fhgt->EditAttrs["class"] = "form-control";
        $this->pbl_fhgt->EditCustomAttributes = "";
        $this->pbl_fhgt->EditValue = $this->pbl_fhgt->CurrentValue;
        $this->pbl_fhgt->PlaceHolder = RemoveHtml($this->pbl_fhgt->caption());

        // pbl_fwgt
        $this->pbl_fwgt->EditAttrs["class"] = "form-control";
        $this->pbl_fwgt->EditCustomAttributes = "";
        $this->pbl_fwgt->EditValue = $this->pbl_fwgt->CurrentValue;
        $this->pbl_fwgt->PlaceHolder = RemoveHtml($this->pbl_fwgt->caption());

        // pbl_fitl
        $this->pbl_fitl->EditAttrs["class"] = "form-control";
        $this->pbl_fitl->EditCustomAttributes = "";
        if (!$this->pbl_fitl->Raw) {
            $this->pbl_fitl->CurrentValue = HtmlDecode($this->pbl_fitl->CurrentValue);
        }
        $this->pbl_fitl->EditValue = $this->pbl_fitl->CurrentValue;
        $this->pbl_fitl->PlaceHolder = RemoveHtml($this->pbl_fitl->caption());

        // pbl_funl
        $this->pbl_funl->EditAttrs["class"] = "form-control";
        $this->pbl_funl->EditCustomAttributes = "";
        if (!$this->pbl_funl->Raw) {
            $this->pbl_funl->CurrentValue = HtmlDecode($this->pbl_funl->CurrentValue);
        }
        $this->pbl_funl->EditValue = $this->pbl_funl->CurrentValue;
        $this->pbl_funl->PlaceHolder = RemoveHtml($this->pbl_funl->caption());

        // pbl_fchr
        $this->pbl_fchr->EditAttrs["class"] = "form-control";
        $this->pbl_fchr->EditCustomAttributes = "";
        $this->pbl_fchr->EditValue = $this->pbl_fchr->CurrentValue;
        $this->pbl_fchr->PlaceHolder = RemoveHtml($this->pbl_fchr->caption());

        // pbl_fptc
        $this->pbl_fptc->EditAttrs["class"] = "form-control";
        $this->pbl_fptc->EditCustomAttributes = "";
        $this->pbl_fptc->EditValue = $this->pbl_fptc->CurrentValue;
        $this->pbl_fptc->PlaceHolder = RemoveHtml($this->pbl_fptc->caption());

        // pbl_ffce
        $this->pbl_ffce->EditAttrs["class"] = "form-control";
        $this->pbl_ffce->EditCustomAttributes = "";
        if (!$this->pbl_ffce->Raw) {
            $this->pbl_ffce->CurrentValue = HtmlDecode($this->pbl_ffce->CurrentValue);
        }
        $this->pbl_ffce->EditValue = $this->pbl_ffce->CurrentValue;
        $this->pbl_ffce->PlaceHolder = RemoveHtml($this->pbl_ffce->caption());

        // pbt_cmnt
        $this->pbt_cmnt->EditAttrs["class"] = "form-control";
        $this->pbt_cmnt->EditCustomAttributes = "";
        if (!$this->pbt_cmnt->Raw) {
            $this->pbt_cmnt->CurrentValue = HtmlDecode($this->pbt_cmnt->CurrentValue);
        }
        $this->pbt_cmnt->EditValue = $this->pbt_cmnt->CurrentValue;
        $this->pbt_cmnt->PlaceHolder = RemoveHtml($this->pbt_cmnt->caption());

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
                    $doc->exportCaption($this->pbt_tnam);
                    $doc->exportCaption($this->pbt_tid);
                    $doc->exportCaption($this->pbt_ownr);
                    $doc->exportCaption($this->pbd_fhgt);
                    $doc->exportCaption($this->pbd_fwgt);
                    $doc->exportCaption($this->pbd_fitl);
                    $doc->exportCaption($this->pbd_funl);
                    $doc->exportCaption($this->pbd_fchr);
                    $doc->exportCaption($this->pbd_fptc);
                    $doc->exportCaption($this->pbd_ffce);
                    $doc->exportCaption($this->pbh_fhgt);
                    $doc->exportCaption($this->pbh_fwgt);
                    $doc->exportCaption($this->pbh_fitl);
                    $doc->exportCaption($this->pbh_funl);
                    $doc->exportCaption($this->pbh_fchr);
                    $doc->exportCaption($this->pbh_fptc);
                    $doc->exportCaption($this->pbh_ffce);
                    $doc->exportCaption($this->pbl_fhgt);
                    $doc->exportCaption($this->pbl_fwgt);
                    $doc->exportCaption($this->pbl_fitl);
                    $doc->exportCaption($this->pbl_funl);
                    $doc->exportCaption($this->pbl_fchr);
                    $doc->exportCaption($this->pbl_fptc);
                    $doc->exportCaption($this->pbl_ffce);
                    $doc->exportCaption($this->pbt_cmnt);
                } else {
                    $doc->exportCaption($this->pbt_tnam);
                    $doc->exportCaption($this->pbt_tid);
                    $doc->exportCaption($this->pbt_ownr);
                    $doc->exportCaption($this->pbd_fhgt);
                    $doc->exportCaption($this->pbd_fwgt);
                    $doc->exportCaption($this->pbd_fitl);
                    $doc->exportCaption($this->pbd_funl);
                    $doc->exportCaption($this->pbd_fchr);
                    $doc->exportCaption($this->pbd_fptc);
                    $doc->exportCaption($this->pbd_ffce);
                    $doc->exportCaption($this->pbh_fhgt);
                    $doc->exportCaption($this->pbh_fwgt);
                    $doc->exportCaption($this->pbh_fitl);
                    $doc->exportCaption($this->pbh_funl);
                    $doc->exportCaption($this->pbh_fchr);
                    $doc->exportCaption($this->pbh_fptc);
                    $doc->exportCaption($this->pbh_ffce);
                    $doc->exportCaption($this->pbl_fhgt);
                    $doc->exportCaption($this->pbl_fwgt);
                    $doc->exportCaption($this->pbl_fitl);
                    $doc->exportCaption($this->pbl_funl);
                    $doc->exportCaption($this->pbl_fchr);
                    $doc->exportCaption($this->pbl_fptc);
                    $doc->exportCaption($this->pbl_ffce);
                    $doc->exportCaption($this->pbt_cmnt);
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
                        $doc->exportField($this->pbt_tnam);
                        $doc->exportField($this->pbt_tid);
                        $doc->exportField($this->pbt_ownr);
                        $doc->exportField($this->pbd_fhgt);
                        $doc->exportField($this->pbd_fwgt);
                        $doc->exportField($this->pbd_fitl);
                        $doc->exportField($this->pbd_funl);
                        $doc->exportField($this->pbd_fchr);
                        $doc->exportField($this->pbd_fptc);
                        $doc->exportField($this->pbd_ffce);
                        $doc->exportField($this->pbh_fhgt);
                        $doc->exportField($this->pbh_fwgt);
                        $doc->exportField($this->pbh_fitl);
                        $doc->exportField($this->pbh_funl);
                        $doc->exportField($this->pbh_fchr);
                        $doc->exportField($this->pbh_fptc);
                        $doc->exportField($this->pbh_ffce);
                        $doc->exportField($this->pbl_fhgt);
                        $doc->exportField($this->pbl_fwgt);
                        $doc->exportField($this->pbl_fitl);
                        $doc->exportField($this->pbl_funl);
                        $doc->exportField($this->pbl_fchr);
                        $doc->exportField($this->pbl_fptc);
                        $doc->exportField($this->pbl_ffce);
                        $doc->exportField($this->pbt_cmnt);
                    } else {
                        $doc->exportField($this->pbt_tnam);
                        $doc->exportField($this->pbt_tid);
                        $doc->exportField($this->pbt_ownr);
                        $doc->exportField($this->pbd_fhgt);
                        $doc->exportField($this->pbd_fwgt);
                        $doc->exportField($this->pbd_fitl);
                        $doc->exportField($this->pbd_funl);
                        $doc->exportField($this->pbd_fchr);
                        $doc->exportField($this->pbd_fptc);
                        $doc->exportField($this->pbd_ffce);
                        $doc->exportField($this->pbh_fhgt);
                        $doc->exportField($this->pbh_fwgt);
                        $doc->exportField($this->pbh_fitl);
                        $doc->exportField($this->pbh_funl);
                        $doc->exportField($this->pbh_fchr);
                        $doc->exportField($this->pbh_fptc);
                        $doc->exportField($this->pbh_ffce);
                        $doc->exportField($this->pbl_fhgt);
                        $doc->exportField($this->pbl_fwgt);
                        $doc->exportField($this->pbl_fitl);
                        $doc->exportField($this->pbl_funl);
                        $doc->exportField($this->pbl_fchr);
                        $doc->exportField($this->pbl_fptc);
                        $doc->exportField($this->pbl_ffce);
                        $doc->exportField($this->pbt_cmnt);
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
