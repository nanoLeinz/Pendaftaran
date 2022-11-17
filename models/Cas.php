<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for cas
 */
class Cas extends DbTable
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
    public $ORG_UNIT_CODE;
    public $TARIF_ID;
    public $PERDA_ID;
    public $TREAT_ID;
    public $DISPLAY_TARIF;
    public $TARIF_NAME;
    public $CLASS_ID;
    public $LEVEL_ID;
    public $OTHER_ID;
    public $TARIF_TYPE;
    public $DESCRIPTION;
    public $IMPLEMENTED;
    public $ACTIVITY_ID;
    public $FA_V;
    public $ISCITO;
    public $AMOUNT_PAID;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $STATUS_PASIEN_ID;
    public $CASEMIX_ID;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'cas';
        $this->TableName = 'cas';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[cas]";
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

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE = new DbField('cas', 'cas', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // TARIF_ID
        $this->TARIF_ID = new DbField('cas', 'cas', 'x_TARIF_ID', 'TARIF_ID', '[TARIF_ID]', '[TARIF_ID]', 200, 50, -1, false, '[TARIF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_ID->Nullable = false; // NOT NULL field
        $this->TARIF_ID->Required = true; // Required field
        $this->TARIF_ID->Sortable = true; // Allow sort
        $this->TARIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_ID->Param, "CustomMsg");
        $this->Fields['TARIF_ID'] = &$this->TARIF_ID;

        // PERDA_ID
        $this->PERDA_ID = new DbField('cas', 'cas', 'x_PERDA_ID', 'PERDA_ID', '[PERDA_ID]', 'CAST([PERDA_ID] AS NVARCHAR)', 2, 2, -1, false, '[PERDA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PERDA_ID->Sortable = true; // Allow sort
        $this->PERDA_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PERDA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PERDA_ID->Param, "CustomMsg");
        $this->Fields['PERDA_ID'] = &$this->PERDA_ID;

        // TREAT_ID
        $this->TREAT_ID = new DbField('cas', 'cas', 'x_TREAT_ID', 'TREAT_ID', '[TREAT_ID]', '[TREAT_ID]', 200, 25, -1, false, '[TREAT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREAT_ID->Nullable = false; // NOT NULL field
        $this->TREAT_ID->Required = true; // Required field
        $this->TREAT_ID->Sortable = true; // Allow sort
        $this->TREAT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREAT_ID->Param, "CustomMsg");
        $this->Fields['TREAT_ID'] = &$this->TREAT_ID;

        // DISPLAY_TARIF
        $this->DISPLAY_TARIF = new DbField('cas', 'cas', 'x_DISPLAY_TARIF', 'DISPLAY_TARIF', '[DISPLAY_TARIF]', '[DISPLAY_TARIF]', 200, 50, -1, false, '[DISPLAY_TARIF]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISPLAY_TARIF->Sortable = true; // Allow sort
        $this->DISPLAY_TARIF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISPLAY_TARIF->Param, "CustomMsg");
        $this->Fields['DISPLAY_TARIF'] = &$this->DISPLAY_TARIF;

        // TARIF_NAME
        $this->TARIF_NAME = new DbField('cas', 'cas', 'x_TARIF_NAME', 'TARIF_NAME', '[TARIF_NAME]', '[TARIF_NAME]', 200, 200, -1, false, '[TARIF_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_NAME->Sortable = true; // Allow sort
        $this->TARIF_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_NAME->Param, "CustomMsg");
        $this->Fields['TARIF_NAME'] = &$this->TARIF_NAME;

        // CLASS_ID
        $this->CLASS_ID = new DbField('cas', 'cas', 'x_CLASS_ID', 'CLASS_ID', '[CLASS_ID]', 'CAST([CLASS_ID] AS NVARCHAR)', 17, 1, -1, false, '[CLASS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLASS_ID->Sortable = true; // Allow sort
        $this->CLASS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CLASS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLASS_ID->Param, "CustomMsg");
        $this->Fields['CLASS_ID'] = &$this->CLASS_ID;

        // LEVEL_ID
        $this->LEVEL_ID = new DbField('cas', 'cas', 'x_LEVEL_ID', 'LEVEL_ID', '[LEVEL_ID]', 'CAST([LEVEL_ID] AS NVARCHAR)', 17, 1, -1, false, '[LEVEL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LEVEL_ID->Sortable = true; // Allow sort
        $this->LEVEL_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->LEVEL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LEVEL_ID->Param, "CustomMsg");
        $this->Fields['LEVEL_ID'] = &$this->LEVEL_ID;

        // OTHER_ID
        $this->OTHER_ID = new DbField('cas', 'cas', 'x_OTHER_ID', 'OTHER_ID', '[OTHER_ID]', '[OTHER_ID]', 200, 50, -1, false, '[OTHER_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_ID->Sortable = true; // Allow sort
        $this->OTHER_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_ID->Param, "CustomMsg");
        $this->Fields['OTHER_ID'] = &$this->OTHER_ID;

        // TARIF_TYPE
        $this->TARIF_TYPE = new DbField('cas', 'cas', 'x_TARIF_TYPE', 'TARIF_TYPE', '[TARIF_TYPE]', '[TARIF_TYPE]', 200, 25, -1, false, '[TARIF_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_TYPE->Sortable = true; // Allow sort
        $this->TARIF_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_TYPE->Param, "CustomMsg");
        $this->Fields['TARIF_TYPE'] = &$this->TARIF_TYPE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('cas', 'cas', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // IMPLEMENTED
        $this->IMPLEMENTED = new DbField('cas', 'cas', 'x_IMPLEMENTED', 'IMPLEMENTED', '[IMPLEMENTED]', '[IMPLEMENTED]', 129, 1, -1, false, '[IMPLEMENTED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->IMPLEMENTED->Sortable = true; // Allow sort
        $this->IMPLEMENTED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IMPLEMENTED->Param, "CustomMsg");
        $this->Fields['IMPLEMENTED'] = &$this->IMPLEMENTED;

        // ACTIVITY_ID
        $this->ACTIVITY_ID = new DbField('cas', 'cas', 'x_ACTIVITY_ID', 'ACTIVITY_ID', '[ACTIVITY_ID]', 'CAST([ACTIVITY_ID] AS NVARCHAR)', 17, 1, -1, false, '[ACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACTIVITY_ID->Sortable = true; // Allow sort
        $this->ACTIVITY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['ACTIVITY_ID'] = &$this->ACTIVITY_ID;

        // FA_V
        $this->FA_V = new DbField('cas', 'cas', 'x_FA_V', 'FA_V', '[FA_V]', 'CAST([FA_V] AS NVARCHAR)', 2, 2, -1, false, '[FA_V]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V->Sortable = true; // Allow sort
        $this->FA_V->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FA_V->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V->Param, "CustomMsg");
        $this->Fields['FA_V'] = &$this->FA_V;

        // ISCITO
        $this->ISCITO = new DbField('cas', 'cas', 'x_ISCITO', 'ISCITO', '[ISCITO]', '[ISCITO]', 129, 1, -1, false, '[ISCITO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISCITO->Sortable = true; // Allow sort
        $this->ISCITO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISCITO->Param, "CustomMsg");
        $this->Fields['ISCITO'] = &$this->ISCITO;

        // AMOUNT_PAID
        $this->AMOUNT_PAID = new DbField('cas', 'cas', 'x_AMOUNT_PAID', 'AMOUNT_PAID', '[AMOUNT_PAID]', 'CAST([AMOUNT_PAID] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_PAID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PAID->Sortable = true; // Allow sort
        $this->AMOUNT_PAID->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_PAID->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_PAID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PAID->Param, "CustomMsg");
        $this->Fields['AMOUNT_PAID'] = &$this->AMOUNT_PAID;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('cas', 'cas', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('cas', 'cas', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('cas', 'cas', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 2, 2, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // CASEMIX_ID
        $this->CASEMIX_ID = new DbField('cas', 'cas', 'x_CASEMIX_ID', 'CASEMIX_ID', '[CASEMIX_ID]', 'CAST([CASEMIX_ID] AS NVARCHAR)', 17, 1, -1, false, '[CASEMIX_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CASEMIX_ID->Sortable = true; // Allow sort
        $this->CASEMIX_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->CASEMIX_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CASEMIX_ID->Param, "CustomMsg");
        $this->Fields['CASEMIX_ID'] = &$this->CASEMIX_ID;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[cas]";
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
        $this->ORG_UNIT_CODE->DbValue = $row['ORG_UNIT_CODE'];
        $this->TARIF_ID->DbValue = $row['TARIF_ID'];
        $this->PERDA_ID->DbValue = $row['PERDA_ID'];
        $this->TREAT_ID->DbValue = $row['TREAT_ID'];
        $this->DISPLAY_TARIF->DbValue = $row['DISPLAY_TARIF'];
        $this->TARIF_NAME->DbValue = $row['TARIF_NAME'];
        $this->CLASS_ID->DbValue = $row['CLASS_ID'];
        $this->LEVEL_ID->DbValue = $row['LEVEL_ID'];
        $this->OTHER_ID->DbValue = $row['OTHER_ID'];
        $this->TARIF_TYPE->DbValue = $row['TARIF_TYPE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->IMPLEMENTED->DbValue = $row['IMPLEMENTED'];
        $this->ACTIVITY_ID->DbValue = $row['ACTIVITY_ID'];
        $this->FA_V->DbValue = $row['FA_V'];
        $this->ISCITO->DbValue = $row['ISCITO'];
        $this->AMOUNT_PAID->DbValue = $row['AMOUNT_PAID'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->CASEMIX_ID->DbValue = $row['CASEMIX_ID'];
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
        return $_SESSION[$name] ?? GetUrl("CasList");
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
        if ($pageName == "CasView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CasEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CasAdd") {
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
                return "CasView";
            case Config("API_ADD_ACTION"):
                return "CasAdd";
            case Config("API_EDIT_ACTION"):
                return "CasEdit";
            case Config("API_DELETE_ACTION"):
                return "CasDelete";
            case Config("API_LIST_ACTION"):
                return "CasList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CasList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CasView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CasView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CasAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CasAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CasEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CasAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CasDelete", $this->getUrlParm());
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
        $this->ORG_UNIT_CODE->setDbValue($row['ORG_UNIT_CODE']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->PERDA_ID->setDbValue($row['PERDA_ID']);
        $this->TREAT_ID->setDbValue($row['TREAT_ID']);
        $this->DISPLAY_TARIF->setDbValue($row['DISPLAY_TARIF']);
        $this->TARIF_NAME->setDbValue($row['TARIF_NAME']);
        $this->CLASS_ID->setDbValue($row['CLASS_ID']);
        $this->LEVEL_ID->setDbValue($row['LEVEL_ID']);
        $this->OTHER_ID->setDbValue($row['OTHER_ID']);
        $this->TARIF_TYPE->setDbValue($row['TARIF_TYPE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->IMPLEMENTED->setDbValue($row['IMPLEMENTED']);
        $this->ACTIVITY_ID->setDbValue($row['ACTIVITY_ID']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->ISCITO->setDbValue($row['ISCITO']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->CASEMIX_ID->setDbValue($row['CASEMIX_ID']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // TARIF_ID

        // PERDA_ID

        // TREAT_ID

        // DISPLAY_TARIF

        // TARIF_NAME

        // CLASS_ID

        // LEVEL_ID

        // OTHER_ID

        // TARIF_TYPE

        // DESCRIPTION

        // IMPLEMENTED

        // ACTIVITY_ID

        // FA_V

        // ISCITO

        // AMOUNT_PAID

        // MODIFIED_DATE

        // MODIFIED_BY

        // STATUS_PASIEN_ID

        // CASEMIX_ID

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // TARIF_ID
        $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->ViewCustomAttributes = "";

        // PERDA_ID
        $this->PERDA_ID->ViewValue = $this->PERDA_ID->CurrentValue;
        $this->PERDA_ID->ViewValue = FormatNumber($this->PERDA_ID->ViewValue, 0, -2, -2, -2);
        $this->PERDA_ID->ViewCustomAttributes = "";

        // TREAT_ID
        $this->TREAT_ID->ViewValue = $this->TREAT_ID->CurrentValue;
        $this->TREAT_ID->ViewCustomAttributes = "";

        // DISPLAY_TARIF
        $this->DISPLAY_TARIF->ViewValue = $this->DISPLAY_TARIF->CurrentValue;
        $this->DISPLAY_TARIF->ViewCustomAttributes = "";

        // TARIF_NAME
        $this->TARIF_NAME->ViewValue = $this->TARIF_NAME->CurrentValue;
        $this->TARIF_NAME->ViewCustomAttributes = "";

        // CLASS_ID
        $this->CLASS_ID->ViewValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->ViewValue = FormatNumber($this->CLASS_ID->ViewValue, 0, -2, -2, -2);
        $this->CLASS_ID->ViewCustomAttributes = "";

        // LEVEL_ID
        $this->LEVEL_ID->ViewValue = $this->LEVEL_ID->CurrentValue;
        $this->LEVEL_ID->ViewValue = FormatNumber($this->LEVEL_ID->ViewValue, 0, -2, -2, -2);
        $this->LEVEL_ID->ViewCustomAttributes = "";

        // OTHER_ID
        $this->OTHER_ID->ViewValue = $this->OTHER_ID->CurrentValue;
        $this->OTHER_ID->ViewCustomAttributes = "";

        // TARIF_TYPE
        $this->TARIF_TYPE->ViewValue = $this->TARIF_TYPE->CurrentValue;
        $this->TARIF_TYPE->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // IMPLEMENTED
        $this->IMPLEMENTED->ViewValue = $this->IMPLEMENTED->CurrentValue;
        $this->IMPLEMENTED->ViewCustomAttributes = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->ViewValue = FormatNumber($this->ACTIVITY_ID->ViewValue, 0, -2, -2, -2);
        $this->ACTIVITY_ID->ViewCustomAttributes = "";

        // FA_V
        $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
        $this->FA_V->ViewValue = FormatNumber($this->FA_V->ViewValue, 0, -2, -2, -2);
        $this->FA_V->ViewCustomAttributes = "";

        // ISCITO
        $this->ISCITO->ViewValue = $this->ISCITO->CurrentValue;
        $this->ISCITO->ViewCustomAttributes = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->ViewValue = FormatNumber($this->AMOUNT_PAID->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_PAID->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // CASEMIX_ID
        $this->CASEMIX_ID->ViewValue = $this->CASEMIX_ID->CurrentValue;
        $this->CASEMIX_ID->ViewValue = FormatNumber($this->CASEMIX_ID->ViewValue, 0, -2, -2, -2);
        $this->CASEMIX_ID->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // TARIF_ID
        $this->TARIF_ID->LinkCustomAttributes = "";
        $this->TARIF_ID->HrefValue = "";
        $this->TARIF_ID->TooltipValue = "";

        // PERDA_ID
        $this->PERDA_ID->LinkCustomAttributes = "";
        $this->PERDA_ID->HrefValue = "";
        $this->PERDA_ID->TooltipValue = "";

        // TREAT_ID
        $this->TREAT_ID->LinkCustomAttributes = "";
        $this->TREAT_ID->HrefValue = "";
        $this->TREAT_ID->TooltipValue = "";

        // DISPLAY_TARIF
        $this->DISPLAY_TARIF->LinkCustomAttributes = "";
        $this->DISPLAY_TARIF->HrefValue = "";
        $this->DISPLAY_TARIF->TooltipValue = "";

        // TARIF_NAME
        $this->TARIF_NAME->LinkCustomAttributes = "";
        $this->TARIF_NAME->HrefValue = "";
        $this->TARIF_NAME->TooltipValue = "";

        // CLASS_ID
        $this->CLASS_ID->LinkCustomAttributes = "";
        $this->CLASS_ID->HrefValue = "";
        $this->CLASS_ID->TooltipValue = "";

        // LEVEL_ID
        $this->LEVEL_ID->LinkCustomAttributes = "";
        $this->LEVEL_ID->HrefValue = "";
        $this->LEVEL_ID->TooltipValue = "";

        // OTHER_ID
        $this->OTHER_ID->LinkCustomAttributes = "";
        $this->OTHER_ID->HrefValue = "";
        $this->OTHER_ID->TooltipValue = "";

        // TARIF_TYPE
        $this->TARIF_TYPE->LinkCustomAttributes = "";
        $this->TARIF_TYPE->HrefValue = "";
        $this->TARIF_TYPE->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // IMPLEMENTED
        $this->IMPLEMENTED->LinkCustomAttributes = "";
        $this->IMPLEMENTED->HrefValue = "";
        $this->IMPLEMENTED->TooltipValue = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->LinkCustomAttributes = "";
        $this->ACTIVITY_ID->HrefValue = "";
        $this->ACTIVITY_ID->TooltipValue = "";

        // FA_V
        $this->FA_V->LinkCustomAttributes = "";
        $this->FA_V->HrefValue = "";
        $this->FA_V->TooltipValue = "";

        // ISCITO
        $this->ISCITO->LinkCustomAttributes = "";
        $this->ISCITO->HrefValue = "";
        $this->ISCITO->TooltipValue = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->LinkCustomAttributes = "";
        $this->AMOUNT_PAID->HrefValue = "";
        $this->AMOUNT_PAID->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // CASEMIX_ID
        $this->CASEMIX_ID->LinkCustomAttributes = "";
        $this->CASEMIX_ID->HrefValue = "";
        $this->CASEMIX_ID->TooltipValue = "";

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

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
        $this->ORG_UNIT_CODE->EditCustomAttributes = "";
        if (!$this->ORG_UNIT_CODE->Raw) {
            $this->ORG_UNIT_CODE->CurrentValue = HtmlDecode($this->ORG_UNIT_CODE->CurrentValue);
        }
        $this->ORG_UNIT_CODE->EditValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->PlaceHolder = RemoveHtml($this->ORG_UNIT_CODE->caption());

        // TARIF_ID
        $this->TARIF_ID->EditAttrs["class"] = "form-control";
        $this->TARIF_ID->EditCustomAttributes = "";
        if (!$this->TARIF_ID->Raw) {
            $this->TARIF_ID->CurrentValue = HtmlDecode($this->TARIF_ID->CurrentValue);
        }
        $this->TARIF_ID->EditValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->PlaceHolder = RemoveHtml($this->TARIF_ID->caption());

        // PERDA_ID
        $this->PERDA_ID->EditAttrs["class"] = "form-control";
        $this->PERDA_ID->EditCustomAttributes = "";
        $this->PERDA_ID->EditValue = $this->PERDA_ID->CurrentValue;
        $this->PERDA_ID->PlaceHolder = RemoveHtml($this->PERDA_ID->caption());

        // TREAT_ID
        $this->TREAT_ID->EditAttrs["class"] = "form-control";
        $this->TREAT_ID->EditCustomAttributes = "";
        if (!$this->TREAT_ID->Raw) {
            $this->TREAT_ID->CurrentValue = HtmlDecode($this->TREAT_ID->CurrentValue);
        }
        $this->TREAT_ID->EditValue = $this->TREAT_ID->CurrentValue;
        $this->TREAT_ID->PlaceHolder = RemoveHtml($this->TREAT_ID->caption());

        // DISPLAY_TARIF
        $this->DISPLAY_TARIF->EditAttrs["class"] = "form-control";
        $this->DISPLAY_TARIF->EditCustomAttributes = "";
        if (!$this->DISPLAY_TARIF->Raw) {
            $this->DISPLAY_TARIF->CurrentValue = HtmlDecode($this->DISPLAY_TARIF->CurrentValue);
        }
        $this->DISPLAY_TARIF->EditValue = $this->DISPLAY_TARIF->CurrentValue;
        $this->DISPLAY_TARIF->PlaceHolder = RemoveHtml($this->DISPLAY_TARIF->caption());

        // TARIF_NAME
        $this->TARIF_NAME->EditAttrs["class"] = "form-control";
        $this->TARIF_NAME->EditCustomAttributes = "";
        if (!$this->TARIF_NAME->Raw) {
            $this->TARIF_NAME->CurrentValue = HtmlDecode($this->TARIF_NAME->CurrentValue);
        }
        $this->TARIF_NAME->EditValue = $this->TARIF_NAME->CurrentValue;
        $this->TARIF_NAME->PlaceHolder = RemoveHtml($this->TARIF_NAME->caption());

        // CLASS_ID
        $this->CLASS_ID->EditAttrs["class"] = "form-control";
        $this->CLASS_ID->EditCustomAttributes = "";
        $this->CLASS_ID->EditValue = $this->CLASS_ID->CurrentValue;
        $this->CLASS_ID->PlaceHolder = RemoveHtml($this->CLASS_ID->caption());

        // LEVEL_ID
        $this->LEVEL_ID->EditAttrs["class"] = "form-control";
        $this->LEVEL_ID->EditCustomAttributes = "";
        $this->LEVEL_ID->EditValue = $this->LEVEL_ID->CurrentValue;
        $this->LEVEL_ID->PlaceHolder = RemoveHtml($this->LEVEL_ID->caption());

        // OTHER_ID
        $this->OTHER_ID->EditAttrs["class"] = "form-control";
        $this->OTHER_ID->EditCustomAttributes = "";
        if (!$this->OTHER_ID->Raw) {
            $this->OTHER_ID->CurrentValue = HtmlDecode($this->OTHER_ID->CurrentValue);
        }
        $this->OTHER_ID->EditValue = $this->OTHER_ID->CurrentValue;
        $this->OTHER_ID->PlaceHolder = RemoveHtml($this->OTHER_ID->caption());

        // TARIF_TYPE
        $this->TARIF_TYPE->EditAttrs["class"] = "form-control";
        $this->TARIF_TYPE->EditCustomAttributes = "";
        if (!$this->TARIF_TYPE->Raw) {
            $this->TARIF_TYPE->CurrentValue = HtmlDecode($this->TARIF_TYPE->CurrentValue);
        }
        $this->TARIF_TYPE->EditValue = $this->TARIF_TYPE->CurrentValue;
        $this->TARIF_TYPE->PlaceHolder = RemoveHtml($this->TARIF_TYPE->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // IMPLEMENTED
        $this->IMPLEMENTED->EditAttrs["class"] = "form-control";
        $this->IMPLEMENTED->EditCustomAttributes = "";
        if (!$this->IMPLEMENTED->Raw) {
            $this->IMPLEMENTED->CurrentValue = HtmlDecode($this->IMPLEMENTED->CurrentValue);
        }
        $this->IMPLEMENTED->EditValue = $this->IMPLEMENTED->CurrentValue;
        $this->IMPLEMENTED->PlaceHolder = RemoveHtml($this->IMPLEMENTED->caption());

        // ACTIVITY_ID
        $this->ACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->ACTIVITY_ID->EditCustomAttributes = "";
        $this->ACTIVITY_ID->EditValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->PlaceHolder = RemoveHtml($this->ACTIVITY_ID->caption());

        // FA_V
        $this->FA_V->EditAttrs["class"] = "form-control";
        $this->FA_V->EditCustomAttributes = "";
        $this->FA_V->EditValue = $this->FA_V->CurrentValue;
        $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

        // ISCITO
        $this->ISCITO->EditAttrs["class"] = "form-control";
        $this->ISCITO->EditCustomAttributes = "";
        if (!$this->ISCITO->Raw) {
            $this->ISCITO->CurrentValue = HtmlDecode($this->ISCITO->CurrentValue);
        }
        $this->ISCITO->EditValue = $this->ISCITO->CurrentValue;
        $this->ISCITO->PlaceHolder = RemoveHtml($this->ISCITO->caption());

        // AMOUNT_PAID
        $this->AMOUNT_PAID->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PAID->EditCustomAttributes = "";
        $this->AMOUNT_PAID->EditValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->PlaceHolder = RemoveHtml($this->AMOUNT_PAID->caption());
        if (strval($this->AMOUNT_PAID->EditValue) != "" && is_numeric($this->AMOUNT_PAID->EditValue)) {
            $this->AMOUNT_PAID->EditValue = FormatNumber($this->AMOUNT_PAID->EditValue, -2, -2, -2, -2);
        }

        // MODIFIED_DATE
        $this->MODIFIED_DATE->EditAttrs["class"] = "form-control";
        $this->MODIFIED_DATE->EditCustomAttributes = "";
        $this->MODIFIED_DATE->EditValue = FormatDateTime($this->MODIFIED_DATE->CurrentValue, 8);
        $this->MODIFIED_DATE->PlaceHolder = RemoveHtml($this->MODIFIED_DATE->caption());

        // MODIFIED_BY
        $this->MODIFIED_BY->EditAttrs["class"] = "form-control";
        $this->MODIFIED_BY->EditCustomAttributes = "";
        if (!$this->MODIFIED_BY->Raw) {
            $this->MODIFIED_BY->CurrentValue = HtmlDecode($this->MODIFIED_BY->CurrentValue);
        }
        $this->MODIFIED_BY->EditValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->PlaceHolder = RemoveHtml($this->MODIFIED_BY->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // CASEMIX_ID
        $this->CASEMIX_ID->EditAttrs["class"] = "form-control";
        $this->CASEMIX_ID->EditCustomAttributes = "";
        $this->CASEMIX_ID->EditValue = $this->CASEMIX_ID->CurrentValue;
        $this->CASEMIX_ID->PlaceHolder = RemoveHtml($this->CASEMIX_ID->caption());

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
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->PERDA_ID);
                    $doc->exportCaption($this->TREAT_ID);
                    $doc->exportCaption($this->DISPLAY_TARIF);
                    $doc->exportCaption($this->TARIF_NAME);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->LEVEL_ID);
                    $doc->exportCaption($this->OTHER_ID);
                    $doc->exportCaption($this->TARIF_TYPE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->IMPLEMENTED);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->ISCITO);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->CASEMIX_ID);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->PERDA_ID);
                    $doc->exportCaption($this->TREAT_ID);
                    $doc->exportCaption($this->DISPLAY_TARIF);
                    $doc->exportCaption($this->TARIF_NAME);
                    $doc->exportCaption($this->CLASS_ID);
                    $doc->exportCaption($this->LEVEL_ID);
                    $doc->exportCaption($this->OTHER_ID);
                    $doc->exportCaption($this->TARIF_TYPE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->IMPLEMENTED);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->ISCITO);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->CASEMIX_ID);
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
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->PERDA_ID);
                        $doc->exportField($this->TREAT_ID);
                        $doc->exportField($this->DISPLAY_TARIF);
                        $doc->exportField($this->TARIF_NAME);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->LEVEL_ID);
                        $doc->exportField($this->OTHER_ID);
                        $doc->exportField($this->TARIF_TYPE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->IMPLEMENTED);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->ISCITO);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->CASEMIX_ID);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->PERDA_ID);
                        $doc->exportField($this->TREAT_ID);
                        $doc->exportField($this->DISPLAY_TARIF);
                        $doc->exportField($this->TARIF_NAME);
                        $doc->exportField($this->CLASS_ID);
                        $doc->exportField($this->LEVEL_ID);
                        $doc->exportField($this->OTHER_ID);
                        $doc->exportField($this->TARIF_TYPE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->IMPLEMENTED);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->ISCITO);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->CASEMIX_ID);
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
