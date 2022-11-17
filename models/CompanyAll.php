<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for COMPANY_ALL
 */
class CompanyAll extends DbTable
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
    public $COMPANY_ID;
    public $COMPANY_NAME;
    public $COMPANY_TYPE;
    public $OBJECT_CATEGORY_ID;
    public $NPWP;
    public $NOPKP;
    public $OWNER;
    public $COMP_ADDRESS;
    public $KOTA;
    public $PHONE1;
    public $FAX;
    public $COMP_ADDRESS2;
    public $PHONE2;
    public $MOBILE;
    public $FAX2;
    public $E_MAIL;
    public $WEBSITE;
    public $BANK_ID;
    public $BANK_ACCOUNT;
    public $FA_V;
    public $_T;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'COMPANY_ALL';
        $this->TableName = 'COMPANY_ALL';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[COMPANY_ALL]";
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

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->IsPrimaryKey = true; // Primary key field
        $this->COMPANY_ID->Nullable = false; // NOT NULL field
        $this->COMPANY_ID->Required = true; // Required field
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // COMPANY_NAME
        $this->COMPANY_NAME = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_COMPANY_NAME', 'COMPANY_NAME', '[COMPANY_NAME]', '[COMPANY_NAME]', 200, 200, -1, false, '[COMPANY_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_NAME->Sortable = true; // Allow sort
        $this->COMPANY_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_NAME->Param, "CustomMsg");
        $this->Fields['COMPANY_NAME'] = &$this->COMPANY_NAME;

        // COMPANY_TYPE
        $this->COMPANY_TYPE = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_COMPANY_TYPE', 'COMPANY_TYPE', '[COMPANY_TYPE]', 'CAST([COMPANY_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[COMPANY_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_TYPE->Sortable = true; // Allow sort
        $this->COMPANY_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->COMPANY_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_TYPE->Param, "CustomMsg");
        $this->Fields['COMPANY_TYPE'] = &$this->COMPANY_TYPE;

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_OBJECT_CATEGORY_ID', 'OBJECT_CATEGORY_ID', '[OBJECT_CATEGORY_ID]', 'CAST([OBJECT_CATEGORY_ID] AS NVARCHAR)', 2, 2, -1, false, '[OBJECT_CATEGORY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OBJECT_CATEGORY_ID->Sortable = true; // Allow sort
        $this->OBJECT_CATEGORY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->OBJECT_CATEGORY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OBJECT_CATEGORY_ID->Param, "CustomMsg");
        $this->Fields['OBJECT_CATEGORY_ID'] = &$this->OBJECT_CATEGORY_ID;

        // NPWP
        $this->NPWP = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_NPWP', 'NPWP', '[NPWP]', '[NPWP]', 200, 50, -1, false, '[NPWP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPWP->Sortable = true; // Allow sort
        $this->NPWP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPWP->Param, "CustomMsg");
        $this->Fields['NPWP'] = &$this->NPWP;

        // NOPKP
        $this->NOPKP = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_NOPKP', 'NOPKP', '[NOPKP]', '[NOPKP]', 200, 50, -1, false, '[NOPKP]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NOPKP->Sortable = true; // Allow sort
        $this->NOPKP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NOPKP->Param, "CustomMsg");
        $this->Fields['NOPKP'] = &$this->NOPKP;

        // OWNER
        $this->OWNER = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_OWNER', 'OWNER', '[OWNER]', '[OWNER]', 200, 200, -1, false, '[OWNER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OWNER->Sortable = true; // Allow sort
        $this->OWNER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OWNER->Param, "CustomMsg");
        $this->Fields['OWNER'] = &$this->OWNER;

        // COMP_ADDRESS
        $this->COMP_ADDRESS = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_COMP_ADDRESS', 'COMP_ADDRESS', '[COMP_ADDRESS]', '[COMP_ADDRESS]', 200, 200, -1, false, '[COMP_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMP_ADDRESS->Sortable = true; // Allow sort
        $this->COMP_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMP_ADDRESS->Param, "CustomMsg");
        $this->Fields['COMP_ADDRESS'] = &$this->COMP_ADDRESS;

        // KOTA
        $this->KOTA = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_KOTA', 'KOTA', '[KOTA]', '[KOTA]', 200, 50, -1, false, '[KOTA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KOTA->Sortable = true; // Allow sort
        $this->KOTA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KOTA->Param, "CustomMsg");
        $this->Fields['KOTA'] = &$this->KOTA;

        // PHONE1
        $this->PHONE1 = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_PHONE1', 'PHONE1', '[PHONE1]', '[PHONE1]', 200, 100, -1, false, '[PHONE1]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE1->Sortable = true; // Allow sort
        $this->PHONE1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE1->Param, "CustomMsg");
        $this->Fields['PHONE1'] = &$this->PHONE1;

        // FAX
        $this->FAX = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_FAX', 'FAX', '[FAX]', '[FAX]', 200, 100, -1, false, '[FAX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX->Sortable = true; // Allow sort
        $this->FAX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX->Param, "CustomMsg");
        $this->Fields['FAX'] = &$this->FAX;

        // COMP_ADDRESS2
        $this->COMP_ADDRESS2 = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_COMP_ADDRESS2', 'COMP_ADDRESS2', '[COMP_ADDRESS2]', '[COMP_ADDRESS2]', 200, 200, -1, false, '[COMP_ADDRESS2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMP_ADDRESS2->Sortable = true; // Allow sort
        $this->COMP_ADDRESS2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMP_ADDRESS2->Param, "CustomMsg");
        $this->Fields['COMP_ADDRESS2'] = &$this->COMP_ADDRESS2;

        // PHONE2
        $this->PHONE2 = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_PHONE2', 'PHONE2', '[PHONE2]', '[PHONE2]', 200, 100, -1, false, '[PHONE2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PHONE2->Sortable = true; // Allow sort
        $this->PHONE2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PHONE2->Param, "CustomMsg");
        $this->Fields['PHONE2'] = &$this->PHONE2;

        // MOBILE
        $this->MOBILE = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_MOBILE', 'MOBILE', '[MOBILE]', '[MOBILE]', 200, 50, -1, false, '[MOBILE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MOBILE->Sortable = true; // Allow sort
        $this->MOBILE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MOBILE->Param, "CustomMsg");
        $this->Fields['MOBILE'] = &$this->MOBILE;

        // FAX2
        $this->FAX2 = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_FAX2', 'FAX2', '[FAX2]', '[FAX2]', 200, 200, -1, false, '[FAX2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAX2->Sortable = true; // Allow sort
        $this->FAX2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAX2->Param, "CustomMsg");
        $this->Fields['FAX2'] = &$this->FAX2;

        // E_MAIL
        $this->E_MAIL = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_E_MAIL', 'E_MAIL', '[E_MAIL]', '[E_MAIL]', 200, 200, -1, false, '[E_MAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->E_MAIL->Sortable = true; // Allow sort
        $this->E_MAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->E_MAIL->Param, "CustomMsg");
        $this->Fields['E_MAIL'] = &$this->E_MAIL;

        // WEBSITE
        $this->WEBSITE = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_WEBSITE', 'WEBSITE', '[WEBSITE]', '[WEBSITE]', 200, 200, -1, false, '[WEBSITE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WEBSITE->Sortable = true; // Allow sort
        $this->WEBSITE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WEBSITE->Param, "CustomMsg");
        $this->Fields['WEBSITE'] = &$this->WEBSITE;

        // BANK_ID
        $this->BANK_ID = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_BANK_ID', 'BANK_ID', '[BANK_ID]', '[BANK_ID]', 200, 50, -1, false, '[BANK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANK_ID->Sortable = true; // Allow sort
        $this->BANK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANK_ID->Param, "CustomMsg");
        $this->Fields['BANK_ID'] = &$this->BANK_ID;

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_BANK_ACCOUNT', 'BANK_ACCOUNT', '[BANK_ACCOUNT]', '[BANK_ACCOUNT]', 200, 50, -1, false, '[BANK_ACCOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BANK_ACCOUNT->Sortable = true; // Allow sort
        $this->BANK_ACCOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BANK_ACCOUNT->Param, "CustomMsg");
        $this->Fields['BANK_ACCOUNT'] = &$this->BANK_ACCOUNT;

        // FA_V
        $this->FA_V = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_FA_V', 'FA_V', '[FA_V]', '[FA_V]', 200, 50, -1, false, '[FA_V]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V->Sortable = true; // Allow sort
        $this->FA_V->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V->Param, "CustomMsg");
        $this->Fields['FA_V'] = &$this->FA_V;

        // T
        $this->_T = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x__T', 'T', '[T]', '[T]', 129, 1, -1, false, '[T]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_T->Sortable = true; // Allow sort
        $this->_T->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_T->Param, "CustomMsg");
        $this->Fields['T'] = &$this->_T;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('COMPANY_ALL', 'COMPANY_ALL', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[COMPANY_ALL]";
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
            if (array_key_exists('COMPANY_ID', $rs)) {
                AddFilter($where, QuotedName('COMPANY_ID', $this->Dbid) . '=' . QuotedValue($rs['COMPANY_ID'], $this->COMPANY_ID->DataType, $this->Dbid));
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
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->COMPANY_NAME->DbValue = $row['COMPANY_NAME'];
        $this->COMPANY_TYPE->DbValue = $row['COMPANY_TYPE'];
        $this->OBJECT_CATEGORY_ID->DbValue = $row['OBJECT_CATEGORY_ID'];
        $this->NPWP->DbValue = $row['NPWP'];
        $this->NOPKP->DbValue = $row['NOPKP'];
        $this->OWNER->DbValue = $row['OWNER'];
        $this->COMP_ADDRESS->DbValue = $row['COMP_ADDRESS'];
        $this->KOTA->DbValue = $row['KOTA'];
        $this->PHONE1->DbValue = $row['PHONE1'];
        $this->FAX->DbValue = $row['FAX'];
        $this->COMP_ADDRESS2->DbValue = $row['COMP_ADDRESS2'];
        $this->PHONE2->DbValue = $row['PHONE2'];
        $this->MOBILE->DbValue = $row['MOBILE'];
        $this->FAX2->DbValue = $row['FAX2'];
        $this->E_MAIL->DbValue = $row['E_MAIL'];
        $this->WEBSITE->DbValue = $row['WEBSITE'];
        $this->BANK_ID->DbValue = $row['BANK_ID'];
        $this->BANK_ACCOUNT->DbValue = $row['BANK_ACCOUNT'];
        $this->FA_V->DbValue = $row['FA_V'];
        $this->_T->DbValue = $row['T'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[COMPANY_ID] = '@COMPANY_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->COMPANY_ID->CurrentValue : $this->COMPANY_ID->OldValue;
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
                $this->COMPANY_ID->CurrentValue = $keys[0];
            } else {
                $this->COMPANY_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('COMPANY_ID', $row) ? $row['COMPANY_ID'] : null;
        } else {
            $val = $this->COMPANY_ID->OldValue !== null ? $this->COMPANY_ID->OldValue : $this->COMPANY_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@COMPANY_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("CompanyAllList");
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
        if ($pageName == "CompanyAllView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CompanyAllEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CompanyAllAdd") {
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
                return "CompanyAllView";
            case Config("API_ADD_ACTION"):
                return "CompanyAllAdd";
            case Config("API_EDIT_ACTION"):
                return "CompanyAllEdit";
            case Config("API_DELETE_ACTION"):
                return "CompanyAllDelete";
            case Config("API_LIST_ACTION"):
                return "CompanyAllList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "CompanyAllList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CompanyAllView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("CompanyAllView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CompanyAllAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "CompanyAllAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CompanyAllEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("CompanyAllAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("CompanyAllDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "COMPANY_ID:" . JsonEncode($this->COMPANY_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->COMPANY_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->COMPANY_ID->CurrentValue);
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
            if (($keyValue = Param("COMPANY_ID") ?? Route("COMPANY_ID")) !== null) {
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
                $this->COMPANY_ID->CurrentValue = $key;
            } else {
                $this->COMPANY_ID->OldValue = $key;
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
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->COMPANY_NAME->setDbValue($row['COMPANY_NAME']);
        $this->COMPANY_TYPE->setDbValue($row['COMPANY_TYPE']);
        $this->OBJECT_CATEGORY_ID->setDbValue($row['OBJECT_CATEGORY_ID']);
        $this->NPWP->setDbValue($row['NPWP']);
        $this->NOPKP->setDbValue($row['NOPKP']);
        $this->OWNER->setDbValue($row['OWNER']);
        $this->COMP_ADDRESS->setDbValue($row['COMP_ADDRESS']);
        $this->KOTA->setDbValue($row['KOTA']);
        $this->PHONE1->setDbValue($row['PHONE1']);
        $this->FAX->setDbValue($row['FAX']);
        $this->COMP_ADDRESS2->setDbValue($row['COMP_ADDRESS2']);
        $this->PHONE2->setDbValue($row['PHONE2']);
        $this->MOBILE->setDbValue($row['MOBILE']);
        $this->FAX2->setDbValue($row['FAX2']);
        $this->E_MAIL->setDbValue($row['E_MAIL']);
        $this->WEBSITE->setDbValue($row['WEBSITE']);
        $this->BANK_ID->setDbValue($row['BANK_ID']);
        $this->BANK_ACCOUNT->setDbValue($row['BANK_ACCOUNT']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->_T->setDbValue($row['T']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // COMPANY_ID

        // COMPANY_NAME

        // COMPANY_TYPE

        // OBJECT_CATEGORY_ID

        // NPWP

        // NOPKP

        // OWNER

        // COMP_ADDRESS

        // KOTA

        // PHONE1

        // FAX

        // COMP_ADDRESS2

        // PHONE2

        // MOBILE

        // FAX2

        // E_MAIL

        // WEBSITE

        // BANK_ID

        // BANK_ACCOUNT

        // FA_V

        // T

        // MODIFIED_DATE

        // MODIFIED_BY

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // COMPANY_NAME
        $this->COMPANY_NAME->ViewValue = $this->COMPANY_NAME->CurrentValue;
        $this->COMPANY_NAME->ViewCustomAttributes = "";

        // COMPANY_TYPE
        $this->COMPANY_TYPE->ViewValue = $this->COMPANY_TYPE->CurrentValue;
        $this->COMPANY_TYPE->ViewValue = FormatNumber($this->COMPANY_TYPE->ViewValue, 0, -2, -2, -2);
        $this->COMPANY_TYPE->ViewCustomAttributes = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->ViewValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->ViewValue = FormatNumber($this->OBJECT_CATEGORY_ID->ViewValue, 0, -2, -2, -2);
        $this->OBJECT_CATEGORY_ID->ViewCustomAttributes = "";

        // NPWP
        $this->NPWP->ViewValue = $this->NPWP->CurrentValue;
        $this->NPWP->ViewCustomAttributes = "";

        // NOPKP
        $this->NOPKP->ViewValue = $this->NOPKP->CurrentValue;
        $this->NOPKP->ViewCustomAttributes = "";

        // OWNER
        $this->OWNER->ViewValue = $this->OWNER->CurrentValue;
        $this->OWNER->ViewCustomAttributes = "";

        // COMP_ADDRESS
        $this->COMP_ADDRESS->ViewValue = $this->COMP_ADDRESS->CurrentValue;
        $this->COMP_ADDRESS->ViewCustomAttributes = "";

        // KOTA
        $this->KOTA->ViewValue = $this->KOTA->CurrentValue;
        $this->KOTA->ViewCustomAttributes = "";

        // PHONE1
        $this->PHONE1->ViewValue = $this->PHONE1->CurrentValue;
        $this->PHONE1->ViewCustomAttributes = "";

        // FAX
        $this->FAX->ViewValue = $this->FAX->CurrentValue;
        $this->FAX->ViewCustomAttributes = "";

        // COMP_ADDRESS2
        $this->COMP_ADDRESS2->ViewValue = $this->COMP_ADDRESS2->CurrentValue;
        $this->COMP_ADDRESS2->ViewCustomAttributes = "";

        // PHONE2
        $this->PHONE2->ViewValue = $this->PHONE2->CurrentValue;
        $this->PHONE2->ViewCustomAttributes = "";

        // MOBILE
        $this->MOBILE->ViewValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->ViewCustomAttributes = "";

        // FAX2
        $this->FAX2->ViewValue = $this->FAX2->CurrentValue;
        $this->FAX2->ViewCustomAttributes = "";

        // E_MAIL
        $this->E_MAIL->ViewValue = $this->E_MAIL->CurrentValue;
        $this->E_MAIL->ViewCustomAttributes = "";

        // WEBSITE
        $this->WEBSITE->ViewValue = $this->WEBSITE->CurrentValue;
        $this->WEBSITE->ViewCustomAttributes = "";

        // BANK_ID
        $this->BANK_ID->ViewValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->ViewCustomAttributes = "";

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->ViewValue = $this->BANK_ACCOUNT->CurrentValue;
        $this->BANK_ACCOUNT->ViewCustomAttributes = "";

        // FA_V
        $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
        $this->FA_V->ViewCustomAttributes = "";

        // T
        $this->_T->ViewValue = $this->_T->CurrentValue;
        $this->_T->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // COMPANY_NAME
        $this->COMPANY_NAME->LinkCustomAttributes = "";
        $this->COMPANY_NAME->HrefValue = "";
        $this->COMPANY_NAME->TooltipValue = "";

        // COMPANY_TYPE
        $this->COMPANY_TYPE->LinkCustomAttributes = "";
        $this->COMPANY_TYPE->HrefValue = "";
        $this->COMPANY_TYPE->TooltipValue = "";

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->LinkCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->HrefValue = "";
        $this->OBJECT_CATEGORY_ID->TooltipValue = "";

        // NPWP
        $this->NPWP->LinkCustomAttributes = "";
        $this->NPWP->HrefValue = "";
        $this->NPWP->TooltipValue = "";

        // NOPKP
        $this->NOPKP->LinkCustomAttributes = "";
        $this->NOPKP->HrefValue = "";
        $this->NOPKP->TooltipValue = "";

        // OWNER
        $this->OWNER->LinkCustomAttributes = "";
        $this->OWNER->HrefValue = "";
        $this->OWNER->TooltipValue = "";

        // COMP_ADDRESS
        $this->COMP_ADDRESS->LinkCustomAttributes = "";
        $this->COMP_ADDRESS->HrefValue = "";
        $this->COMP_ADDRESS->TooltipValue = "";

        // KOTA
        $this->KOTA->LinkCustomAttributes = "";
        $this->KOTA->HrefValue = "";
        $this->KOTA->TooltipValue = "";

        // PHONE1
        $this->PHONE1->LinkCustomAttributes = "";
        $this->PHONE1->HrefValue = "";
        $this->PHONE1->TooltipValue = "";

        // FAX
        $this->FAX->LinkCustomAttributes = "";
        $this->FAX->HrefValue = "";
        $this->FAX->TooltipValue = "";

        // COMP_ADDRESS2
        $this->COMP_ADDRESS2->LinkCustomAttributes = "";
        $this->COMP_ADDRESS2->HrefValue = "";
        $this->COMP_ADDRESS2->TooltipValue = "";

        // PHONE2
        $this->PHONE2->LinkCustomAttributes = "";
        $this->PHONE2->HrefValue = "";
        $this->PHONE2->TooltipValue = "";

        // MOBILE
        $this->MOBILE->LinkCustomAttributes = "";
        $this->MOBILE->HrefValue = "";
        $this->MOBILE->TooltipValue = "";

        // FAX2
        $this->FAX2->LinkCustomAttributes = "";
        $this->FAX2->HrefValue = "";
        $this->FAX2->TooltipValue = "";

        // E_MAIL
        $this->E_MAIL->LinkCustomAttributes = "";
        $this->E_MAIL->HrefValue = "";
        $this->E_MAIL->TooltipValue = "";

        // WEBSITE
        $this->WEBSITE->LinkCustomAttributes = "";
        $this->WEBSITE->HrefValue = "";
        $this->WEBSITE->TooltipValue = "";

        // BANK_ID
        $this->BANK_ID->LinkCustomAttributes = "";
        $this->BANK_ID->HrefValue = "";
        $this->BANK_ID->TooltipValue = "";

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->LinkCustomAttributes = "";
        $this->BANK_ACCOUNT->HrefValue = "";
        $this->BANK_ACCOUNT->TooltipValue = "";

        // FA_V
        $this->FA_V->LinkCustomAttributes = "";
        $this->FA_V->HrefValue = "";
        $this->FA_V->TooltipValue = "";

        // T
        $this->_T->LinkCustomAttributes = "";
        $this->_T->HrefValue = "";
        $this->_T->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

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

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // COMPANY_NAME
        $this->COMPANY_NAME->EditAttrs["class"] = "form-control";
        $this->COMPANY_NAME->EditCustomAttributes = "";
        if (!$this->COMPANY_NAME->Raw) {
            $this->COMPANY_NAME->CurrentValue = HtmlDecode($this->COMPANY_NAME->CurrentValue);
        }
        $this->COMPANY_NAME->EditValue = $this->COMPANY_NAME->CurrentValue;
        $this->COMPANY_NAME->PlaceHolder = RemoveHtml($this->COMPANY_NAME->caption());

        // COMPANY_TYPE
        $this->COMPANY_TYPE->EditAttrs["class"] = "form-control";
        $this->COMPANY_TYPE->EditCustomAttributes = "";
        $this->COMPANY_TYPE->EditValue = $this->COMPANY_TYPE->CurrentValue;
        $this->COMPANY_TYPE->PlaceHolder = RemoveHtml($this->COMPANY_TYPE->caption());

        // OBJECT_CATEGORY_ID
        $this->OBJECT_CATEGORY_ID->EditAttrs["class"] = "form-control";
        $this->OBJECT_CATEGORY_ID->EditCustomAttributes = "";
        $this->OBJECT_CATEGORY_ID->EditValue = $this->OBJECT_CATEGORY_ID->CurrentValue;
        $this->OBJECT_CATEGORY_ID->PlaceHolder = RemoveHtml($this->OBJECT_CATEGORY_ID->caption());

        // NPWP
        $this->NPWP->EditAttrs["class"] = "form-control";
        $this->NPWP->EditCustomAttributes = "";
        if (!$this->NPWP->Raw) {
            $this->NPWP->CurrentValue = HtmlDecode($this->NPWP->CurrentValue);
        }
        $this->NPWP->EditValue = $this->NPWP->CurrentValue;
        $this->NPWP->PlaceHolder = RemoveHtml($this->NPWP->caption());

        // NOPKP
        $this->NOPKP->EditAttrs["class"] = "form-control";
        $this->NOPKP->EditCustomAttributes = "";
        if (!$this->NOPKP->Raw) {
            $this->NOPKP->CurrentValue = HtmlDecode($this->NOPKP->CurrentValue);
        }
        $this->NOPKP->EditValue = $this->NOPKP->CurrentValue;
        $this->NOPKP->PlaceHolder = RemoveHtml($this->NOPKP->caption());

        // OWNER
        $this->OWNER->EditAttrs["class"] = "form-control";
        $this->OWNER->EditCustomAttributes = "";
        if (!$this->OWNER->Raw) {
            $this->OWNER->CurrentValue = HtmlDecode($this->OWNER->CurrentValue);
        }
        $this->OWNER->EditValue = $this->OWNER->CurrentValue;
        $this->OWNER->PlaceHolder = RemoveHtml($this->OWNER->caption());

        // COMP_ADDRESS
        $this->COMP_ADDRESS->EditAttrs["class"] = "form-control";
        $this->COMP_ADDRESS->EditCustomAttributes = "";
        if (!$this->COMP_ADDRESS->Raw) {
            $this->COMP_ADDRESS->CurrentValue = HtmlDecode($this->COMP_ADDRESS->CurrentValue);
        }
        $this->COMP_ADDRESS->EditValue = $this->COMP_ADDRESS->CurrentValue;
        $this->COMP_ADDRESS->PlaceHolder = RemoveHtml($this->COMP_ADDRESS->caption());

        // KOTA
        $this->KOTA->EditAttrs["class"] = "form-control";
        $this->KOTA->EditCustomAttributes = "";
        if (!$this->KOTA->Raw) {
            $this->KOTA->CurrentValue = HtmlDecode($this->KOTA->CurrentValue);
        }
        $this->KOTA->EditValue = $this->KOTA->CurrentValue;
        $this->KOTA->PlaceHolder = RemoveHtml($this->KOTA->caption());

        // PHONE1
        $this->PHONE1->EditAttrs["class"] = "form-control";
        $this->PHONE1->EditCustomAttributes = "";
        if (!$this->PHONE1->Raw) {
            $this->PHONE1->CurrentValue = HtmlDecode($this->PHONE1->CurrentValue);
        }
        $this->PHONE1->EditValue = $this->PHONE1->CurrentValue;
        $this->PHONE1->PlaceHolder = RemoveHtml($this->PHONE1->caption());

        // FAX
        $this->FAX->EditAttrs["class"] = "form-control";
        $this->FAX->EditCustomAttributes = "";
        if (!$this->FAX->Raw) {
            $this->FAX->CurrentValue = HtmlDecode($this->FAX->CurrentValue);
        }
        $this->FAX->EditValue = $this->FAX->CurrentValue;
        $this->FAX->PlaceHolder = RemoveHtml($this->FAX->caption());

        // COMP_ADDRESS2
        $this->COMP_ADDRESS2->EditAttrs["class"] = "form-control";
        $this->COMP_ADDRESS2->EditCustomAttributes = "";
        if (!$this->COMP_ADDRESS2->Raw) {
            $this->COMP_ADDRESS2->CurrentValue = HtmlDecode($this->COMP_ADDRESS2->CurrentValue);
        }
        $this->COMP_ADDRESS2->EditValue = $this->COMP_ADDRESS2->CurrentValue;
        $this->COMP_ADDRESS2->PlaceHolder = RemoveHtml($this->COMP_ADDRESS2->caption());

        // PHONE2
        $this->PHONE2->EditAttrs["class"] = "form-control";
        $this->PHONE2->EditCustomAttributes = "";
        if (!$this->PHONE2->Raw) {
            $this->PHONE2->CurrentValue = HtmlDecode($this->PHONE2->CurrentValue);
        }
        $this->PHONE2->EditValue = $this->PHONE2->CurrentValue;
        $this->PHONE2->PlaceHolder = RemoveHtml($this->PHONE2->caption());

        // MOBILE
        $this->MOBILE->EditAttrs["class"] = "form-control";
        $this->MOBILE->EditCustomAttributes = "";
        if (!$this->MOBILE->Raw) {
            $this->MOBILE->CurrentValue = HtmlDecode($this->MOBILE->CurrentValue);
        }
        $this->MOBILE->EditValue = $this->MOBILE->CurrentValue;
        $this->MOBILE->PlaceHolder = RemoveHtml($this->MOBILE->caption());

        // FAX2
        $this->FAX2->EditAttrs["class"] = "form-control";
        $this->FAX2->EditCustomAttributes = "";
        if (!$this->FAX2->Raw) {
            $this->FAX2->CurrentValue = HtmlDecode($this->FAX2->CurrentValue);
        }
        $this->FAX2->EditValue = $this->FAX2->CurrentValue;
        $this->FAX2->PlaceHolder = RemoveHtml($this->FAX2->caption());

        // E_MAIL
        $this->E_MAIL->EditAttrs["class"] = "form-control";
        $this->E_MAIL->EditCustomAttributes = "";
        if (!$this->E_MAIL->Raw) {
            $this->E_MAIL->CurrentValue = HtmlDecode($this->E_MAIL->CurrentValue);
        }
        $this->E_MAIL->EditValue = $this->E_MAIL->CurrentValue;
        $this->E_MAIL->PlaceHolder = RemoveHtml($this->E_MAIL->caption());

        // WEBSITE
        $this->WEBSITE->EditAttrs["class"] = "form-control";
        $this->WEBSITE->EditCustomAttributes = "";
        if (!$this->WEBSITE->Raw) {
            $this->WEBSITE->CurrentValue = HtmlDecode($this->WEBSITE->CurrentValue);
        }
        $this->WEBSITE->EditValue = $this->WEBSITE->CurrentValue;
        $this->WEBSITE->PlaceHolder = RemoveHtml($this->WEBSITE->caption());

        // BANK_ID
        $this->BANK_ID->EditAttrs["class"] = "form-control";
        $this->BANK_ID->EditCustomAttributes = "";
        if (!$this->BANK_ID->Raw) {
            $this->BANK_ID->CurrentValue = HtmlDecode($this->BANK_ID->CurrentValue);
        }
        $this->BANK_ID->EditValue = $this->BANK_ID->CurrentValue;
        $this->BANK_ID->PlaceHolder = RemoveHtml($this->BANK_ID->caption());

        // BANK_ACCOUNT
        $this->BANK_ACCOUNT->EditAttrs["class"] = "form-control";
        $this->BANK_ACCOUNT->EditCustomAttributes = "";
        if (!$this->BANK_ACCOUNT->Raw) {
            $this->BANK_ACCOUNT->CurrentValue = HtmlDecode($this->BANK_ACCOUNT->CurrentValue);
        }
        $this->BANK_ACCOUNT->EditValue = $this->BANK_ACCOUNT->CurrentValue;
        $this->BANK_ACCOUNT->PlaceHolder = RemoveHtml($this->BANK_ACCOUNT->caption());

        // FA_V
        $this->FA_V->EditAttrs["class"] = "form-control";
        $this->FA_V->EditCustomAttributes = "";
        if (!$this->FA_V->Raw) {
            $this->FA_V->CurrentValue = HtmlDecode($this->FA_V->CurrentValue);
        }
        $this->FA_V->EditValue = $this->FA_V->CurrentValue;
        $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

        // T
        $this->_T->EditAttrs["class"] = "form-control";
        $this->_T->EditCustomAttributes = "";
        if (!$this->_T->Raw) {
            $this->_T->CurrentValue = HtmlDecode($this->_T->CurrentValue);
        }
        $this->_T->EditValue = $this->_T->CurrentValue;
        $this->_T->PlaceHolder = RemoveHtml($this->_T->caption());

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
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY_NAME);
                    $doc->exportCaption($this->COMPANY_TYPE);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->NOPKP);
                    $doc->exportCaption($this->OWNER);
                    $doc->exportCaption($this->COMP_ADDRESS);
                    $doc->exportCaption($this->KOTA);
                    $doc->exportCaption($this->PHONE1);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->COMP_ADDRESS2);
                    $doc->exportCaption($this->PHONE2);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->FAX2);
                    $doc->exportCaption($this->E_MAIL);
                    $doc->exportCaption($this->WEBSITE);
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->BANK_ACCOUNT);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->_T);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                } else {
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->COMPANY_NAME);
                    $doc->exportCaption($this->COMPANY_TYPE);
                    $doc->exportCaption($this->OBJECT_CATEGORY_ID);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->NOPKP);
                    $doc->exportCaption($this->OWNER);
                    $doc->exportCaption($this->COMP_ADDRESS);
                    $doc->exportCaption($this->KOTA);
                    $doc->exportCaption($this->PHONE1);
                    $doc->exportCaption($this->FAX);
                    $doc->exportCaption($this->COMP_ADDRESS2);
                    $doc->exportCaption($this->PHONE2);
                    $doc->exportCaption($this->MOBILE);
                    $doc->exportCaption($this->FAX2);
                    $doc->exportCaption($this->E_MAIL);
                    $doc->exportCaption($this->WEBSITE);
                    $doc->exportCaption($this->BANK_ID);
                    $doc->exportCaption($this->BANK_ACCOUNT);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->_T);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
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
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY_NAME);
                        $doc->exportField($this->COMPANY_TYPE);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->NOPKP);
                        $doc->exportField($this->OWNER);
                        $doc->exportField($this->COMP_ADDRESS);
                        $doc->exportField($this->KOTA);
                        $doc->exportField($this->PHONE1);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->COMP_ADDRESS2);
                        $doc->exportField($this->PHONE2);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->FAX2);
                        $doc->exportField($this->E_MAIL);
                        $doc->exportField($this->WEBSITE);
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->BANK_ACCOUNT);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->_T);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                    } else {
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->COMPANY_NAME);
                        $doc->exportField($this->COMPANY_TYPE);
                        $doc->exportField($this->OBJECT_CATEGORY_ID);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->NOPKP);
                        $doc->exportField($this->OWNER);
                        $doc->exportField($this->COMP_ADDRESS);
                        $doc->exportField($this->KOTA);
                        $doc->exportField($this->PHONE1);
                        $doc->exportField($this->FAX);
                        $doc->exportField($this->COMP_ADDRESS2);
                        $doc->exportField($this->PHONE2);
                        $doc->exportField($this->MOBILE);
                        $doc->exportField($this->FAX2);
                        $doc->exportField($this->E_MAIL);
                        $doc->exportField($this->WEBSITE);
                        $doc->exportField($this->BANK_ID);
                        $doc->exportField($this->BANK_ACCOUNT);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->_T);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
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
