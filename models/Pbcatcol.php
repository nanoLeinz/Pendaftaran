<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for pbcatcol
 */
class Pbcatcol extends DbTable
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
    public $pbc_tnam;
    public $pbc_tid;
    public $pbc_ownr;
    public $pbc_cnam;
    public $pbc_cid;
    public $pbc_labl;
    public $pbc_lpos;
    public $pbc_hdr;
    public $pbc_hpos;
    public $pbc_jtfy;
    public $pbc_mask;
    public $pbc_case;
    public $pbc_hght;
    public $pbc_wdth;
    public $pbc_ptrn;
    public $pbc_bmap;
    public $pbc_init;
    public $pbc_cmnt;
    public $pbc_edit;
    public $pbc_tag;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pbcatcol';
        $this->TableName = 'pbcatcol';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[pbcatcol]";
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

        // pbc_tnam
        $this->pbc_tnam = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_tnam', 'pbc_tnam', '[pbc_tnam]', '[pbc_tnam]', 129, 30, -1, false, '[pbc_tnam]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_tnam->IsPrimaryKey = true; // Primary key field
        $this->pbc_tnam->Sortable = true; // Allow sort
        $this->pbc_tnam->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_tnam->Param, "CustomMsg");
        $this->Fields['pbc_tnam'] = &$this->pbc_tnam;

        // pbc_tid
        $this->pbc_tid = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_tid', 'pbc_tid', '[pbc_tid]', 'CAST([pbc_tid] AS NVARCHAR)', 3, 4, -1, false, '[pbc_tid]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_tid->Sortable = true; // Allow sort
        $this->pbc_tid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbc_tid->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_tid->Param, "CustomMsg");
        $this->Fields['pbc_tid'] = &$this->pbc_tid;

        // pbc_ownr
        $this->pbc_ownr = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_ownr', 'pbc_ownr', '[pbc_ownr]', '[pbc_ownr]', 129, 30, -1, false, '[pbc_ownr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_ownr->IsPrimaryKey = true; // Primary key field
        $this->pbc_ownr->Sortable = true; // Allow sort
        $this->pbc_ownr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_ownr->Param, "CustomMsg");
        $this->Fields['pbc_ownr'] = &$this->pbc_ownr;

        // pbc_cnam
        $this->pbc_cnam = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_cnam', 'pbc_cnam', '[pbc_cnam]', '[pbc_cnam]', 129, 30, -1, false, '[pbc_cnam]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_cnam->IsPrimaryKey = true; // Primary key field
        $this->pbc_cnam->Sortable = true; // Allow sort
        $this->pbc_cnam->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_cnam->Param, "CustomMsg");
        $this->Fields['pbc_cnam'] = &$this->pbc_cnam;

        // pbc_cid
        $this->pbc_cid = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_cid', 'pbc_cid', '[pbc_cid]', 'CAST([pbc_cid] AS NVARCHAR)', 2, 2, -1, false, '[pbc_cid]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_cid->Sortable = true; // Allow sort
        $this->pbc_cid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbc_cid->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_cid->Param, "CustomMsg");
        $this->Fields['pbc_cid'] = &$this->pbc_cid;

        // pbc_labl
        $this->pbc_labl = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_labl', 'pbc_labl', '[pbc_labl]', '[pbc_labl]', 200, 254, -1, false, '[pbc_labl]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_labl->Sortable = true; // Allow sort
        $this->pbc_labl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_labl->Param, "CustomMsg");
        $this->Fields['pbc_labl'] = &$this->pbc_labl;

        // pbc_lpos
        $this->pbc_lpos = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_lpos', 'pbc_lpos', '[pbc_lpos]', 'CAST([pbc_lpos] AS NVARCHAR)', 2, 2, -1, false, '[pbc_lpos]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_lpos->Sortable = true; // Allow sort
        $this->pbc_lpos->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbc_lpos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_lpos->Param, "CustomMsg");
        $this->Fields['pbc_lpos'] = &$this->pbc_lpos;

        // pbc_hdr
        $this->pbc_hdr = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_hdr', 'pbc_hdr', '[pbc_hdr]', '[pbc_hdr]', 200, 254, -1, false, '[pbc_hdr]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_hdr->Sortable = true; // Allow sort
        $this->pbc_hdr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_hdr->Param, "CustomMsg");
        $this->Fields['pbc_hdr'] = &$this->pbc_hdr;

        // pbc_hpos
        $this->pbc_hpos = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_hpos', 'pbc_hpos', '[pbc_hpos]', 'CAST([pbc_hpos] AS NVARCHAR)', 2, 2, -1, false, '[pbc_hpos]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_hpos->Sortable = true; // Allow sort
        $this->pbc_hpos->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbc_hpos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_hpos->Param, "CustomMsg");
        $this->Fields['pbc_hpos'] = &$this->pbc_hpos;

        // pbc_jtfy
        $this->pbc_jtfy = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_jtfy', 'pbc_jtfy', '[pbc_jtfy]', 'CAST([pbc_jtfy] AS NVARCHAR)', 2, 2, -1, false, '[pbc_jtfy]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_jtfy->Sortable = true; // Allow sort
        $this->pbc_jtfy->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbc_jtfy->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_jtfy->Param, "CustomMsg");
        $this->Fields['pbc_jtfy'] = &$this->pbc_jtfy;

        // pbc_mask
        $this->pbc_mask = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_mask', 'pbc_mask', '[pbc_mask]', '[pbc_mask]', 200, 31, -1, false, '[pbc_mask]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_mask->Sortable = true; // Allow sort
        $this->pbc_mask->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_mask->Param, "CustomMsg");
        $this->Fields['pbc_mask'] = &$this->pbc_mask;

        // pbc_case
        $this->pbc_case = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_case', 'pbc_case', '[pbc_case]', 'CAST([pbc_case] AS NVARCHAR)', 2, 2, -1, false, '[pbc_case]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_case->Sortable = true; // Allow sort
        $this->pbc_case->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbc_case->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_case->Param, "CustomMsg");
        $this->Fields['pbc_case'] = &$this->pbc_case;

        // pbc_hght
        $this->pbc_hght = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_hght', 'pbc_hght', '[pbc_hght]', 'CAST([pbc_hght] AS NVARCHAR)', 2, 2, -1, false, '[pbc_hght]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_hght->Sortable = true; // Allow sort
        $this->pbc_hght->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbc_hght->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_hght->Param, "CustomMsg");
        $this->Fields['pbc_hght'] = &$this->pbc_hght;

        // pbc_wdth
        $this->pbc_wdth = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_wdth', 'pbc_wdth', '[pbc_wdth]', 'CAST([pbc_wdth] AS NVARCHAR)', 2, 2, -1, false, '[pbc_wdth]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_wdth->Sortable = true; // Allow sort
        $this->pbc_wdth->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pbc_wdth->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_wdth->Param, "CustomMsg");
        $this->Fields['pbc_wdth'] = &$this->pbc_wdth;

        // pbc_ptrn
        $this->pbc_ptrn = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_ptrn', 'pbc_ptrn', '[pbc_ptrn]', '[pbc_ptrn]', 200, 31, -1, false, '[pbc_ptrn]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_ptrn->Sortable = true; // Allow sort
        $this->pbc_ptrn->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_ptrn->Param, "CustomMsg");
        $this->Fields['pbc_ptrn'] = &$this->pbc_ptrn;

        // pbc_bmap
        $this->pbc_bmap = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_bmap', 'pbc_bmap', '[pbc_bmap]', '[pbc_bmap]', 129, 1, -1, false, '[pbc_bmap]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_bmap->Sortable = true; // Allow sort
        $this->pbc_bmap->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_bmap->Param, "CustomMsg");
        $this->Fields['pbc_bmap'] = &$this->pbc_bmap;

        // pbc_init
        $this->pbc_init = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_init', 'pbc_init', '[pbc_init]', '[pbc_init]', 200, 254, -1, false, '[pbc_init]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_init->Sortable = true; // Allow sort
        $this->pbc_init->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_init->Param, "CustomMsg");
        $this->Fields['pbc_init'] = &$this->pbc_init;

        // pbc_cmnt
        $this->pbc_cmnt = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_cmnt', 'pbc_cmnt', '[pbc_cmnt]', '[pbc_cmnt]', 200, 254, -1, false, '[pbc_cmnt]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_cmnt->Sortable = true; // Allow sort
        $this->pbc_cmnt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_cmnt->Param, "CustomMsg");
        $this->Fields['pbc_cmnt'] = &$this->pbc_cmnt;

        // pbc_edit
        $this->pbc_edit = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_edit', 'pbc_edit', '[pbc_edit]', '[pbc_edit]', 200, 31, -1, false, '[pbc_edit]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_edit->Sortable = true; // Allow sort
        $this->pbc_edit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_edit->Param, "CustomMsg");
        $this->Fields['pbc_edit'] = &$this->pbc_edit;

        // pbc_tag
        $this->pbc_tag = new DbField('pbcatcol', 'pbcatcol', 'x_pbc_tag', 'pbc_tag', '[pbc_tag]', '[pbc_tag]', 200, 254, -1, false, '[pbc_tag]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pbc_tag->Sortable = true; // Allow sort
        $this->pbc_tag->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pbc_tag->Param, "CustomMsg");
        $this->Fields['pbc_tag'] = &$this->pbc_tag;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[pbcatcol]";
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
            if (array_key_exists('pbc_tnam', $rs)) {
                AddFilter($where, QuotedName('pbc_tnam', $this->Dbid) . '=' . QuotedValue($rs['pbc_tnam'], $this->pbc_tnam->DataType, $this->Dbid));
            }
            if (array_key_exists('pbc_ownr', $rs)) {
                AddFilter($where, QuotedName('pbc_ownr', $this->Dbid) . '=' . QuotedValue($rs['pbc_ownr'], $this->pbc_ownr->DataType, $this->Dbid));
            }
            if (array_key_exists('pbc_cnam', $rs)) {
                AddFilter($where, QuotedName('pbc_cnam', $this->Dbid) . '=' . QuotedValue($rs['pbc_cnam'], $this->pbc_cnam->DataType, $this->Dbid));
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
        $this->pbc_tnam->DbValue = $row['pbc_tnam'];
        $this->pbc_tid->DbValue = $row['pbc_tid'];
        $this->pbc_ownr->DbValue = $row['pbc_ownr'];
        $this->pbc_cnam->DbValue = $row['pbc_cnam'];
        $this->pbc_cid->DbValue = $row['pbc_cid'];
        $this->pbc_labl->DbValue = $row['pbc_labl'];
        $this->pbc_lpos->DbValue = $row['pbc_lpos'];
        $this->pbc_hdr->DbValue = $row['pbc_hdr'];
        $this->pbc_hpos->DbValue = $row['pbc_hpos'];
        $this->pbc_jtfy->DbValue = $row['pbc_jtfy'];
        $this->pbc_mask->DbValue = $row['pbc_mask'];
        $this->pbc_case->DbValue = $row['pbc_case'];
        $this->pbc_hght->DbValue = $row['pbc_hght'];
        $this->pbc_wdth->DbValue = $row['pbc_wdth'];
        $this->pbc_ptrn->DbValue = $row['pbc_ptrn'];
        $this->pbc_bmap->DbValue = $row['pbc_bmap'];
        $this->pbc_init->DbValue = $row['pbc_init'];
        $this->pbc_cmnt->DbValue = $row['pbc_cmnt'];
        $this->pbc_edit->DbValue = $row['pbc_edit'];
        $this->pbc_tag->DbValue = $row['pbc_tag'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[pbc_tnam] = '@pbc_tnam@' AND [pbc_ownr] = '@pbc_ownr@' AND [pbc_cnam] = '@pbc_cnam@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->pbc_tnam->CurrentValue : $this->pbc_tnam->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->pbc_ownr->CurrentValue : $this->pbc_ownr->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->pbc_cnam->CurrentValue : $this->pbc_cnam->OldValue;
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
        if (count($keys) == 3) {
            if ($current) {
                $this->pbc_tnam->CurrentValue = $keys[0];
            } else {
                $this->pbc_tnam->OldValue = $keys[0];
            }
            if ($current) {
                $this->pbc_ownr->CurrentValue = $keys[1];
            } else {
                $this->pbc_ownr->OldValue = $keys[1];
            }
            if ($current) {
                $this->pbc_cnam->CurrentValue = $keys[2];
            } else {
                $this->pbc_cnam->OldValue = $keys[2];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('pbc_tnam', $row) ? $row['pbc_tnam'] : null;
        } else {
            $val = $this->pbc_tnam->OldValue !== null ? $this->pbc_tnam->OldValue : $this->pbc_tnam->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@pbc_tnam@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('pbc_ownr', $row) ? $row['pbc_ownr'] : null;
        } else {
            $val = $this->pbc_ownr->OldValue !== null ? $this->pbc_ownr->OldValue : $this->pbc_ownr->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@pbc_ownr@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('pbc_cnam', $row) ? $row['pbc_cnam'] : null;
        } else {
            $val = $this->pbc_cnam->OldValue !== null ? $this->pbc_cnam->OldValue : $this->pbc_cnam->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@pbc_cnam@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("PbcatcolList");
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
        if ($pageName == "PbcatcolView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PbcatcolEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PbcatcolAdd") {
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
                return "PbcatcolView";
            case Config("API_ADD_ACTION"):
                return "PbcatcolAdd";
            case Config("API_EDIT_ACTION"):
                return "PbcatcolEdit";
            case Config("API_DELETE_ACTION"):
                return "PbcatcolDelete";
            case Config("API_LIST_ACTION"):
                return "PbcatcolList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PbcatcolList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PbcatcolView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PbcatcolView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PbcatcolAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PbcatcolAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PbcatcolEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PbcatcolAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PbcatcolDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "pbc_tnam:" . JsonEncode($this->pbc_tnam->CurrentValue, "string");
        $json .= ",pbc_ownr:" . JsonEncode($this->pbc_ownr->CurrentValue, "string");
        $json .= ",pbc_cnam:" . JsonEncode($this->pbc_cnam->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->pbc_tnam->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->pbc_tnam->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->pbc_ownr->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->pbc_ownr->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->pbc_cnam->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->pbc_cnam->CurrentValue);
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
            if (($keyValue = Param("pbc_tnam") ?? Route("pbc_tnam")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("pbc_ownr") ?? Route("pbc_ownr")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("pbc_cnam") ?? Route("pbc_cnam")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(2) ?? Route(4)) !== null)) {
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
                if (!is_array($key) || count($key) != 3) {
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
                $this->pbc_tnam->CurrentValue = $key[0];
            } else {
                $this->pbc_tnam->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->pbc_ownr->CurrentValue = $key[1];
            } else {
                $this->pbc_ownr->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->pbc_cnam->CurrentValue = $key[2];
            } else {
                $this->pbc_cnam->OldValue = $key[2];
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
        $this->pbc_tnam->setDbValue($row['pbc_tnam']);
        $this->pbc_tid->setDbValue($row['pbc_tid']);
        $this->pbc_ownr->setDbValue($row['pbc_ownr']);
        $this->pbc_cnam->setDbValue($row['pbc_cnam']);
        $this->pbc_cid->setDbValue($row['pbc_cid']);
        $this->pbc_labl->setDbValue($row['pbc_labl']);
        $this->pbc_lpos->setDbValue($row['pbc_lpos']);
        $this->pbc_hdr->setDbValue($row['pbc_hdr']);
        $this->pbc_hpos->setDbValue($row['pbc_hpos']);
        $this->pbc_jtfy->setDbValue($row['pbc_jtfy']);
        $this->pbc_mask->setDbValue($row['pbc_mask']);
        $this->pbc_case->setDbValue($row['pbc_case']);
        $this->pbc_hght->setDbValue($row['pbc_hght']);
        $this->pbc_wdth->setDbValue($row['pbc_wdth']);
        $this->pbc_ptrn->setDbValue($row['pbc_ptrn']);
        $this->pbc_bmap->setDbValue($row['pbc_bmap']);
        $this->pbc_init->setDbValue($row['pbc_init']);
        $this->pbc_cmnt->setDbValue($row['pbc_cmnt']);
        $this->pbc_edit->setDbValue($row['pbc_edit']);
        $this->pbc_tag->setDbValue($row['pbc_tag']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // pbc_tnam

        // pbc_tid

        // pbc_ownr

        // pbc_cnam

        // pbc_cid

        // pbc_labl

        // pbc_lpos

        // pbc_hdr

        // pbc_hpos

        // pbc_jtfy

        // pbc_mask

        // pbc_case

        // pbc_hght

        // pbc_wdth

        // pbc_ptrn

        // pbc_bmap

        // pbc_init

        // pbc_cmnt

        // pbc_edit

        // pbc_tag

        // pbc_tnam
        $this->pbc_tnam->ViewValue = $this->pbc_tnam->CurrentValue;
        $this->pbc_tnam->ViewCustomAttributes = "";

        // pbc_tid
        $this->pbc_tid->ViewValue = $this->pbc_tid->CurrentValue;
        $this->pbc_tid->ViewValue = FormatNumber($this->pbc_tid->ViewValue, 0, -2, -2, -2);
        $this->pbc_tid->ViewCustomAttributes = "";

        // pbc_ownr
        $this->pbc_ownr->ViewValue = $this->pbc_ownr->CurrentValue;
        $this->pbc_ownr->ViewCustomAttributes = "";

        // pbc_cnam
        $this->pbc_cnam->ViewValue = $this->pbc_cnam->CurrentValue;
        $this->pbc_cnam->ViewCustomAttributes = "";

        // pbc_cid
        $this->pbc_cid->ViewValue = $this->pbc_cid->CurrentValue;
        $this->pbc_cid->ViewValue = FormatNumber($this->pbc_cid->ViewValue, 0, -2, -2, -2);
        $this->pbc_cid->ViewCustomAttributes = "";

        // pbc_labl
        $this->pbc_labl->ViewValue = $this->pbc_labl->CurrentValue;
        $this->pbc_labl->ViewCustomAttributes = "";

        // pbc_lpos
        $this->pbc_lpos->ViewValue = $this->pbc_lpos->CurrentValue;
        $this->pbc_lpos->ViewValue = FormatNumber($this->pbc_lpos->ViewValue, 0, -2, -2, -2);
        $this->pbc_lpos->ViewCustomAttributes = "";

        // pbc_hdr
        $this->pbc_hdr->ViewValue = $this->pbc_hdr->CurrentValue;
        $this->pbc_hdr->ViewCustomAttributes = "";

        // pbc_hpos
        $this->pbc_hpos->ViewValue = $this->pbc_hpos->CurrentValue;
        $this->pbc_hpos->ViewValue = FormatNumber($this->pbc_hpos->ViewValue, 0, -2, -2, -2);
        $this->pbc_hpos->ViewCustomAttributes = "";

        // pbc_jtfy
        $this->pbc_jtfy->ViewValue = $this->pbc_jtfy->CurrentValue;
        $this->pbc_jtfy->ViewValue = FormatNumber($this->pbc_jtfy->ViewValue, 0, -2, -2, -2);
        $this->pbc_jtfy->ViewCustomAttributes = "";

        // pbc_mask
        $this->pbc_mask->ViewValue = $this->pbc_mask->CurrentValue;
        $this->pbc_mask->ViewCustomAttributes = "";

        // pbc_case
        $this->pbc_case->ViewValue = $this->pbc_case->CurrentValue;
        $this->pbc_case->ViewValue = FormatNumber($this->pbc_case->ViewValue, 0, -2, -2, -2);
        $this->pbc_case->ViewCustomAttributes = "";

        // pbc_hght
        $this->pbc_hght->ViewValue = $this->pbc_hght->CurrentValue;
        $this->pbc_hght->ViewValue = FormatNumber($this->pbc_hght->ViewValue, 0, -2, -2, -2);
        $this->pbc_hght->ViewCustomAttributes = "";

        // pbc_wdth
        $this->pbc_wdth->ViewValue = $this->pbc_wdth->CurrentValue;
        $this->pbc_wdth->ViewValue = FormatNumber($this->pbc_wdth->ViewValue, 0, -2, -2, -2);
        $this->pbc_wdth->ViewCustomAttributes = "";

        // pbc_ptrn
        $this->pbc_ptrn->ViewValue = $this->pbc_ptrn->CurrentValue;
        $this->pbc_ptrn->ViewCustomAttributes = "";

        // pbc_bmap
        $this->pbc_bmap->ViewValue = $this->pbc_bmap->CurrentValue;
        $this->pbc_bmap->ViewCustomAttributes = "";

        // pbc_init
        $this->pbc_init->ViewValue = $this->pbc_init->CurrentValue;
        $this->pbc_init->ViewCustomAttributes = "";

        // pbc_cmnt
        $this->pbc_cmnt->ViewValue = $this->pbc_cmnt->CurrentValue;
        $this->pbc_cmnt->ViewCustomAttributes = "";

        // pbc_edit
        $this->pbc_edit->ViewValue = $this->pbc_edit->CurrentValue;
        $this->pbc_edit->ViewCustomAttributes = "";

        // pbc_tag
        $this->pbc_tag->ViewValue = $this->pbc_tag->CurrentValue;
        $this->pbc_tag->ViewCustomAttributes = "";

        // pbc_tnam
        $this->pbc_tnam->LinkCustomAttributes = "";
        $this->pbc_tnam->HrefValue = "";
        $this->pbc_tnam->TooltipValue = "";

        // pbc_tid
        $this->pbc_tid->LinkCustomAttributes = "";
        $this->pbc_tid->HrefValue = "";
        $this->pbc_tid->TooltipValue = "";

        // pbc_ownr
        $this->pbc_ownr->LinkCustomAttributes = "";
        $this->pbc_ownr->HrefValue = "";
        $this->pbc_ownr->TooltipValue = "";

        // pbc_cnam
        $this->pbc_cnam->LinkCustomAttributes = "";
        $this->pbc_cnam->HrefValue = "";
        $this->pbc_cnam->TooltipValue = "";

        // pbc_cid
        $this->pbc_cid->LinkCustomAttributes = "";
        $this->pbc_cid->HrefValue = "";
        $this->pbc_cid->TooltipValue = "";

        // pbc_labl
        $this->pbc_labl->LinkCustomAttributes = "";
        $this->pbc_labl->HrefValue = "";
        $this->pbc_labl->TooltipValue = "";

        // pbc_lpos
        $this->pbc_lpos->LinkCustomAttributes = "";
        $this->pbc_lpos->HrefValue = "";
        $this->pbc_lpos->TooltipValue = "";

        // pbc_hdr
        $this->pbc_hdr->LinkCustomAttributes = "";
        $this->pbc_hdr->HrefValue = "";
        $this->pbc_hdr->TooltipValue = "";

        // pbc_hpos
        $this->pbc_hpos->LinkCustomAttributes = "";
        $this->pbc_hpos->HrefValue = "";
        $this->pbc_hpos->TooltipValue = "";

        // pbc_jtfy
        $this->pbc_jtfy->LinkCustomAttributes = "";
        $this->pbc_jtfy->HrefValue = "";
        $this->pbc_jtfy->TooltipValue = "";

        // pbc_mask
        $this->pbc_mask->LinkCustomAttributes = "";
        $this->pbc_mask->HrefValue = "";
        $this->pbc_mask->TooltipValue = "";

        // pbc_case
        $this->pbc_case->LinkCustomAttributes = "";
        $this->pbc_case->HrefValue = "";
        $this->pbc_case->TooltipValue = "";

        // pbc_hght
        $this->pbc_hght->LinkCustomAttributes = "";
        $this->pbc_hght->HrefValue = "";
        $this->pbc_hght->TooltipValue = "";

        // pbc_wdth
        $this->pbc_wdth->LinkCustomAttributes = "";
        $this->pbc_wdth->HrefValue = "";
        $this->pbc_wdth->TooltipValue = "";

        // pbc_ptrn
        $this->pbc_ptrn->LinkCustomAttributes = "";
        $this->pbc_ptrn->HrefValue = "";
        $this->pbc_ptrn->TooltipValue = "";

        // pbc_bmap
        $this->pbc_bmap->LinkCustomAttributes = "";
        $this->pbc_bmap->HrefValue = "";
        $this->pbc_bmap->TooltipValue = "";

        // pbc_init
        $this->pbc_init->LinkCustomAttributes = "";
        $this->pbc_init->HrefValue = "";
        $this->pbc_init->TooltipValue = "";

        // pbc_cmnt
        $this->pbc_cmnt->LinkCustomAttributes = "";
        $this->pbc_cmnt->HrefValue = "";
        $this->pbc_cmnt->TooltipValue = "";

        // pbc_edit
        $this->pbc_edit->LinkCustomAttributes = "";
        $this->pbc_edit->HrefValue = "";
        $this->pbc_edit->TooltipValue = "";

        // pbc_tag
        $this->pbc_tag->LinkCustomAttributes = "";
        $this->pbc_tag->HrefValue = "";
        $this->pbc_tag->TooltipValue = "";

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

        // pbc_tnam
        $this->pbc_tnam->EditAttrs["class"] = "form-control";
        $this->pbc_tnam->EditCustomAttributes = "";
        if (!$this->pbc_tnam->Raw) {
            $this->pbc_tnam->CurrentValue = HtmlDecode($this->pbc_tnam->CurrentValue);
        }
        $this->pbc_tnam->EditValue = $this->pbc_tnam->CurrentValue;
        $this->pbc_tnam->PlaceHolder = RemoveHtml($this->pbc_tnam->caption());

        // pbc_tid
        $this->pbc_tid->EditAttrs["class"] = "form-control";
        $this->pbc_tid->EditCustomAttributes = "";
        $this->pbc_tid->EditValue = $this->pbc_tid->CurrentValue;
        $this->pbc_tid->PlaceHolder = RemoveHtml($this->pbc_tid->caption());

        // pbc_ownr
        $this->pbc_ownr->EditAttrs["class"] = "form-control";
        $this->pbc_ownr->EditCustomAttributes = "";
        if (!$this->pbc_ownr->Raw) {
            $this->pbc_ownr->CurrentValue = HtmlDecode($this->pbc_ownr->CurrentValue);
        }
        $this->pbc_ownr->EditValue = $this->pbc_ownr->CurrentValue;
        $this->pbc_ownr->PlaceHolder = RemoveHtml($this->pbc_ownr->caption());

        // pbc_cnam
        $this->pbc_cnam->EditAttrs["class"] = "form-control";
        $this->pbc_cnam->EditCustomAttributes = "";
        if (!$this->pbc_cnam->Raw) {
            $this->pbc_cnam->CurrentValue = HtmlDecode($this->pbc_cnam->CurrentValue);
        }
        $this->pbc_cnam->EditValue = $this->pbc_cnam->CurrentValue;
        $this->pbc_cnam->PlaceHolder = RemoveHtml($this->pbc_cnam->caption());

        // pbc_cid
        $this->pbc_cid->EditAttrs["class"] = "form-control";
        $this->pbc_cid->EditCustomAttributes = "";
        $this->pbc_cid->EditValue = $this->pbc_cid->CurrentValue;
        $this->pbc_cid->PlaceHolder = RemoveHtml($this->pbc_cid->caption());

        // pbc_labl
        $this->pbc_labl->EditAttrs["class"] = "form-control";
        $this->pbc_labl->EditCustomAttributes = "";
        if (!$this->pbc_labl->Raw) {
            $this->pbc_labl->CurrentValue = HtmlDecode($this->pbc_labl->CurrentValue);
        }
        $this->pbc_labl->EditValue = $this->pbc_labl->CurrentValue;
        $this->pbc_labl->PlaceHolder = RemoveHtml($this->pbc_labl->caption());

        // pbc_lpos
        $this->pbc_lpos->EditAttrs["class"] = "form-control";
        $this->pbc_lpos->EditCustomAttributes = "";
        $this->pbc_lpos->EditValue = $this->pbc_lpos->CurrentValue;
        $this->pbc_lpos->PlaceHolder = RemoveHtml($this->pbc_lpos->caption());

        // pbc_hdr
        $this->pbc_hdr->EditAttrs["class"] = "form-control";
        $this->pbc_hdr->EditCustomAttributes = "";
        if (!$this->pbc_hdr->Raw) {
            $this->pbc_hdr->CurrentValue = HtmlDecode($this->pbc_hdr->CurrentValue);
        }
        $this->pbc_hdr->EditValue = $this->pbc_hdr->CurrentValue;
        $this->pbc_hdr->PlaceHolder = RemoveHtml($this->pbc_hdr->caption());

        // pbc_hpos
        $this->pbc_hpos->EditAttrs["class"] = "form-control";
        $this->pbc_hpos->EditCustomAttributes = "";
        $this->pbc_hpos->EditValue = $this->pbc_hpos->CurrentValue;
        $this->pbc_hpos->PlaceHolder = RemoveHtml($this->pbc_hpos->caption());

        // pbc_jtfy
        $this->pbc_jtfy->EditAttrs["class"] = "form-control";
        $this->pbc_jtfy->EditCustomAttributes = "";
        $this->pbc_jtfy->EditValue = $this->pbc_jtfy->CurrentValue;
        $this->pbc_jtfy->PlaceHolder = RemoveHtml($this->pbc_jtfy->caption());

        // pbc_mask
        $this->pbc_mask->EditAttrs["class"] = "form-control";
        $this->pbc_mask->EditCustomAttributes = "";
        if (!$this->pbc_mask->Raw) {
            $this->pbc_mask->CurrentValue = HtmlDecode($this->pbc_mask->CurrentValue);
        }
        $this->pbc_mask->EditValue = $this->pbc_mask->CurrentValue;
        $this->pbc_mask->PlaceHolder = RemoveHtml($this->pbc_mask->caption());

        // pbc_case
        $this->pbc_case->EditAttrs["class"] = "form-control";
        $this->pbc_case->EditCustomAttributes = "";
        $this->pbc_case->EditValue = $this->pbc_case->CurrentValue;
        $this->pbc_case->PlaceHolder = RemoveHtml($this->pbc_case->caption());

        // pbc_hght
        $this->pbc_hght->EditAttrs["class"] = "form-control";
        $this->pbc_hght->EditCustomAttributes = "";
        $this->pbc_hght->EditValue = $this->pbc_hght->CurrentValue;
        $this->pbc_hght->PlaceHolder = RemoveHtml($this->pbc_hght->caption());

        // pbc_wdth
        $this->pbc_wdth->EditAttrs["class"] = "form-control";
        $this->pbc_wdth->EditCustomAttributes = "";
        $this->pbc_wdth->EditValue = $this->pbc_wdth->CurrentValue;
        $this->pbc_wdth->PlaceHolder = RemoveHtml($this->pbc_wdth->caption());

        // pbc_ptrn
        $this->pbc_ptrn->EditAttrs["class"] = "form-control";
        $this->pbc_ptrn->EditCustomAttributes = "";
        if (!$this->pbc_ptrn->Raw) {
            $this->pbc_ptrn->CurrentValue = HtmlDecode($this->pbc_ptrn->CurrentValue);
        }
        $this->pbc_ptrn->EditValue = $this->pbc_ptrn->CurrentValue;
        $this->pbc_ptrn->PlaceHolder = RemoveHtml($this->pbc_ptrn->caption());

        // pbc_bmap
        $this->pbc_bmap->EditAttrs["class"] = "form-control";
        $this->pbc_bmap->EditCustomAttributes = "";
        if (!$this->pbc_bmap->Raw) {
            $this->pbc_bmap->CurrentValue = HtmlDecode($this->pbc_bmap->CurrentValue);
        }
        $this->pbc_bmap->EditValue = $this->pbc_bmap->CurrentValue;
        $this->pbc_bmap->PlaceHolder = RemoveHtml($this->pbc_bmap->caption());

        // pbc_init
        $this->pbc_init->EditAttrs["class"] = "form-control";
        $this->pbc_init->EditCustomAttributes = "";
        if (!$this->pbc_init->Raw) {
            $this->pbc_init->CurrentValue = HtmlDecode($this->pbc_init->CurrentValue);
        }
        $this->pbc_init->EditValue = $this->pbc_init->CurrentValue;
        $this->pbc_init->PlaceHolder = RemoveHtml($this->pbc_init->caption());

        // pbc_cmnt
        $this->pbc_cmnt->EditAttrs["class"] = "form-control";
        $this->pbc_cmnt->EditCustomAttributes = "";
        if (!$this->pbc_cmnt->Raw) {
            $this->pbc_cmnt->CurrentValue = HtmlDecode($this->pbc_cmnt->CurrentValue);
        }
        $this->pbc_cmnt->EditValue = $this->pbc_cmnt->CurrentValue;
        $this->pbc_cmnt->PlaceHolder = RemoveHtml($this->pbc_cmnt->caption());

        // pbc_edit
        $this->pbc_edit->EditAttrs["class"] = "form-control";
        $this->pbc_edit->EditCustomAttributes = "";
        if (!$this->pbc_edit->Raw) {
            $this->pbc_edit->CurrentValue = HtmlDecode($this->pbc_edit->CurrentValue);
        }
        $this->pbc_edit->EditValue = $this->pbc_edit->CurrentValue;
        $this->pbc_edit->PlaceHolder = RemoveHtml($this->pbc_edit->caption());

        // pbc_tag
        $this->pbc_tag->EditAttrs["class"] = "form-control";
        $this->pbc_tag->EditCustomAttributes = "";
        if (!$this->pbc_tag->Raw) {
            $this->pbc_tag->CurrentValue = HtmlDecode($this->pbc_tag->CurrentValue);
        }
        $this->pbc_tag->EditValue = $this->pbc_tag->CurrentValue;
        $this->pbc_tag->PlaceHolder = RemoveHtml($this->pbc_tag->caption());

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
                    $doc->exportCaption($this->pbc_tnam);
                    $doc->exportCaption($this->pbc_tid);
                    $doc->exportCaption($this->pbc_ownr);
                    $doc->exportCaption($this->pbc_cnam);
                    $doc->exportCaption($this->pbc_cid);
                    $doc->exportCaption($this->pbc_labl);
                    $doc->exportCaption($this->pbc_lpos);
                    $doc->exportCaption($this->pbc_hdr);
                    $doc->exportCaption($this->pbc_hpos);
                    $doc->exportCaption($this->pbc_jtfy);
                    $doc->exportCaption($this->pbc_mask);
                    $doc->exportCaption($this->pbc_case);
                    $doc->exportCaption($this->pbc_hght);
                    $doc->exportCaption($this->pbc_wdth);
                    $doc->exportCaption($this->pbc_ptrn);
                    $doc->exportCaption($this->pbc_bmap);
                    $doc->exportCaption($this->pbc_init);
                    $doc->exportCaption($this->pbc_cmnt);
                    $doc->exportCaption($this->pbc_edit);
                    $doc->exportCaption($this->pbc_tag);
                } else {
                    $doc->exportCaption($this->pbc_tnam);
                    $doc->exportCaption($this->pbc_tid);
                    $doc->exportCaption($this->pbc_ownr);
                    $doc->exportCaption($this->pbc_cnam);
                    $doc->exportCaption($this->pbc_cid);
                    $doc->exportCaption($this->pbc_labl);
                    $doc->exportCaption($this->pbc_lpos);
                    $doc->exportCaption($this->pbc_hdr);
                    $doc->exportCaption($this->pbc_hpos);
                    $doc->exportCaption($this->pbc_jtfy);
                    $doc->exportCaption($this->pbc_mask);
                    $doc->exportCaption($this->pbc_case);
                    $doc->exportCaption($this->pbc_hght);
                    $doc->exportCaption($this->pbc_wdth);
                    $doc->exportCaption($this->pbc_ptrn);
                    $doc->exportCaption($this->pbc_bmap);
                    $doc->exportCaption($this->pbc_init);
                    $doc->exportCaption($this->pbc_cmnt);
                    $doc->exportCaption($this->pbc_edit);
                    $doc->exportCaption($this->pbc_tag);
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
                        $doc->exportField($this->pbc_tnam);
                        $doc->exportField($this->pbc_tid);
                        $doc->exportField($this->pbc_ownr);
                        $doc->exportField($this->pbc_cnam);
                        $doc->exportField($this->pbc_cid);
                        $doc->exportField($this->pbc_labl);
                        $doc->exportField($this->pbc_lpos);
                        $doc->exportField($this->pbc_hdr);
                        $doc->exportField($this->pbc_hpos);
                        $doc->exportField($this->pbc_jtfy);
                        $doc->exportField($this->pbc_mask);
                        $doc->exportField($this->pbc_case);
                        $doc->exportField($this->pbc_hght);
                        $doc->exportField($this->pbc_wdth);
                        $doc->exportField($this->pbc_ptrn);
                        $doc->exportField($this->pbc_bmap);
                        $doc->exportField($this->pbc_init);
                        $doc->exportField($this->pbc_cmnt);
                        $doc->exportField($this->pbc_edit);
                        $doc->exportField($this->pbc_tag);
                    } else {
                        $doc->exportField($this->pbc_tnam);
                        $doc->exportField($this->pbc_tid);
                        $doc->exportField($this->pbc_ownr);
                        $doc->exportField($this->pbc_cnam);
                        $doc->exportField($this->pbc_cid);
                        $doc->exportField($this->pbc_labl);
                        $doc->exportField($this->pbc_lpos);
                        $doc->exportField($this->pbc_hdr);
                        $doc->exportField($this->pbc_hpos);
                        $doc->exportField($this->pbc_jtfy);
                        $doc->exportField($this->pbc_mask);
                        $doc->exportField($this->pbc_case);
                        $doc->exportField($this->pbc_hght);
                        $doc->exportField($this->pbc_wdth);
                        $doc->exportField($this->pbc_ptrn);
                        $doc->exportField($this->pbc_bmap);
                        $doc->exportField($this->pbc_init);
                        $doc->exportField($this->pbc_cmnt);
                        $doc->exportField($this->pbc_edit);
                        $doc->exportField($this->pbc_tag);
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
