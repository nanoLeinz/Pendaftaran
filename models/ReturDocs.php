<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for RETUR_DOCS
 */
class ReturDocs extends DbTable
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
    public $RETUR_ID;
    public $ORG_UNIT_FROM;
    public $ORG_ID;
    public $CLINIC_ID;
    public $ORG_ID_TO;
    public $CLINIC_ID_TO;
    public $RETUR_DATE;
    public $RETUR_BY;
    public $RETUR_VALUE;
    public $RECEIVED_VALUE;
    public $YEAR_ID;
    public $RECEIVED_BY;
    public $DOC_NO;
    public $COMPANY_ID;
    public $ACCEPTED_BY;
    public $ACCOUNT_ID;
    public $FINANCE_ID;
    public $DESCRIPTION;
    public $DISTRIBUTION_TYPE;
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
        $this->TableVar = 'RETUR_DOCS';
        $this->TableName = 'RETUR_DOCS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[RETUR_DOCS]";
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
        $this->ORG_UNIT_CODE = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // RETUR_ID
        $this->RETUR_ID = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_RETUR_ID', 'RETUR_ID', '[RETUR_ID]', '[RETUR_ID]', 200, 15, -1, false, '[RETUR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RETUR_ID->IsPrimaryKey = true; // Primary key field
        $this->RETUR_ID->Nullable = false; // NOT NULL field
        $this->RETUR_ID->Required = true; // Required field
        $this->RETUR_ID->Sortable = true; // Allow sort
        $this->RETUR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RETUR_ID->Param, "CustomMsg");
        $this->Fields['RETUR_ID'] = &$this->RETUR_ID;

        // ORG_UNIT_FROM
        $this->ORG_UNIT_FROM = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_ORG_UNIT_FROM', 'ORG_UNIT_FROM', '[ORG_UNIT_FROM]', '[ORG_UNIT_FROM]', 200, 50, -1, false, '[ORG_UNIT_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_FROM->Sortable = true; // Allow sort
        $this->ORG_UNIT_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_FROM->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_FROM'] = &$this->ORG_UNIT_FROM;

        // ORG_ID
        $this->ORG_ID = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_ORG_ID', 'ORG_ID', '[ORG_ID]', '[ORG_ID]', 200, 50, -1, false, '[ORG_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID->Sortable = true; // Allow sort
        $this->ORG_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID->Param, "CustomMsg");
        $this->Fields['ORG_ID'] = &$this->ORG_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 50, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // ORG_ID_TO
        $this->ORG_ID_TO = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_ORG_ID_TO', 'ORG_ID_TO', '[ORG_ID_TO]', '[ORG_ID_TO]', 200, 50, -1, false, '[ORG_ID_TO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_ID_TO->Sortable = true; // Allow sort
        $this->ORG_ID_TO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_ID_TO->Param, "CustomMsg");
        $this->Fields['ORG_ID_TO'] = &$this->ORG_ID_TO;

        // CLINIC_ID_TO
        $this->CLINIC_ID_TO = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_CLINIC_ID_TO', 'CLINIC_ID_TO', '[CLINIC_ID_TO]', '[CLINIC_ID_TO]', 200, 50, -1, false, '[CLINIC_ID_TO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID_TO->Sortable = true; // Allow sort
        $this->CLINIC_ID_TO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID_TO->Param, "CustomMsg");
        $this->Fields['CLINIC_ID_TO'] = &$this->CLINIC_ID_TO;

        // RETUR_DATE
        $this->RETUR_DATE = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_RETUR_DATE', 'RETUR_DATE', '[RETUR_DATE]', CastDateFieldForLike("[RETUR_DATE]", 0, "DB"), 135, 8, 0, false, '[RETUR_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RETUR_DATE->Sortable = true; // Allow sort
        $this->RETUR_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->RETUR_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RETUR_DATE->Param, "CustomMsg");
        $this->Fields['RETUR_DATE'] = &$this->RETUR_DATE;

        // RETUR_BY
        $this->RETUR_BY = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_RETUR_BY', 'RETUR_BY', '[RETUR_BY]', '[RETUR_BY]', 200, 100, -1, false, '[RETUR_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RETUR_BY->Sortable = true; // Allow sort
        $this->RETUR_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RETUR_BY->Param, "CustomMsg");
        $this->Fields['RETUR_BY'] = &$this->RETUR_BY;

        // RETUR_VALUE
        $this->RETUR_VALUE = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_RETUR_VALUE', 'RETUR_VALUE', '[RETUR_VALUE]', 'CAST([RETUR_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[RETUR_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RETUR_VALUE->Sortable = true; // Allow sort
        $this->RETUR_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->RETUR_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->RETUR_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RETUR_VALUE->Param, "CustomMsg");
        $this->Fields['RETUR_VALUE'] = &$this->RETUR_VALUE;

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_RECEIVED_VALUE', 'RECEIVED_VALUE', '[RECEIVED_VALUE]', 'CAST([RECEIVED_VALUE] AS NVARCHAR)', 6, 8, -1, false, '[RECEIVED_VALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_VALUE->Sortable = true; // Allow sort
        $this->RECEIVED_VALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->RECEIVED_VALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->RECEIVED_VALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_VALUE->Param, "CustomMsg");
        $this->Fields['RECEIVED_VALUE'] = &$this->RECEIVED_VALUE;

        // YEAR_ID
        $this->YEAR_ID = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // RECEIVED_BY
        $this->RECEIVED_BY = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_RECEIVED_BY', 'RECEIVED_BY', '[RECEIVED_BY]', '[RECEIVED_BY]', 200, 100, -1, false, '[RECEIVED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RECEIVED_BY->Sortable = true; // Allow sort
        $this->RECEIVED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RECEIVED_BY->Param, "CustomMsg");
        $this->Fields['RECEIVED_BY'] = &$this->RECEIVED_BY;

        // DOC_NO
        $this->DOC_NO = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_DOC_NO', 'DOC_NO', '[DOC_NO]', '[DOC_NO]', 200, 50, -1, false, '[DOC_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DOC_NO->Sortable = true; // Allow sort
        $this->DOC_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DOC_NO->Param, "CustomMsg");
        $this->Fields['DOC_NO'] = &$this->DOC_NO;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // ACCEPTED_BY
        $this->ACCEPTED_BY = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_ACCEPTED_BY', 'ACCEPTED_BY', '[ACCEPTED_BY]', '[ACCEPTED_BY]', 200, 100, -1, false, '[ACCEPTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCEPTED_BY->Sortable = true; // Allow sort
        $this->ACCEPTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCEPTED_BY->Param, "CustomMsg");
        $this->Fields['ACCEPTED_BY'] = &$this->ACCEPTED_BY;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // FINANCE_ID
        $this->FINANCE_ID = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_FINANCE_ID', 'FINANCE_ID', '[FINANCE_ID]', 'CAST([FINANCE_ID] AS NVARCHAR)', 2, 2, -1, false, '[FINANCE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FINANCE_ID->Sortable = true; // Allow sort
        $this->FINANCE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FINANCE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FINANCE_ID->Param, "CustomMsg");
        $this->Fields['FINANCE_ID'] = &$this->FINANCE_ID;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_DISTRIBUTION_TYPE', 'DISTRIBUTION_TYPE', '[DISTRIBUTION_TYPE]', 'CAST([DISTRIBUTION_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[DISTRIBUTION_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISTRIBUTION_TYPE->Sortable = true; // Allow sort
        $this->DISTRIBUTION_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DISTRIBUTION_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISTRIBUTION_TYPE->Param, "CustomMsg");
        $this->Fields['DISTRIBUTION_TYPE'] = &$this->DISTRIBUTION_TYPE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('RETUR_DOCS', 'RETUR_DOCS', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[RETUR_DOCS]";
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
            if (array_key_exists('ORG_UNIT_CODE', $rs)) {
                AddFilter($where, QuotedName('ORG_UNIT_CODE', $this->Dbid) . '=' . QuotedValue($rs['ORG_UNIT_CODE'], $this->ORG_UNIT_CODE->DataType, $this->Dbid));
            }
            if (array_key_exists('RETUR_ID', $rs)) {
                AddFilter($where, QuotedName('RETUR_ID', $this->Dbid) . '=' . QuotedValue($rs['RETUR_ID'], $this->RETUR_ID->DataType, $this->Dbid));
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
        $this->ORG_UNIT_CODE->DbValue = $row['ORG_UNIT_CODE'];
        $this->RETUR_ID->DbValue = $row['RETUR_ID'];
        $this->ORG_UNIT_FROM->DbValue = $row['ORG_UNIT_FROM'];
        $this->ORG_ID->DbValue = $row['ORG_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->ORG_ID_TO->DbValue = $row['ORG_ID_TO'];
        $this->CLINIC_ID_TO->DbValue = $row['CLINIC_ID_TO'];
        $this->RETUR_DATE->DbValue = $row['RETUR_DATE'];
        $this->RETUR_BY->DbValue = $row['RETUR_BY'];
        $this->RETUR_VALUE->DbValue = $row['RETUR_VALUE'];
        $this->RECEIVED_VALUE->DbValue = $row['RECEIVED_VALUE'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->RECEIVED_BY->DbValue = $row['RECEIVED_BY'];
        $this->DOC_NO->DbValue = $row['DOC_NO'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->ACCEPTED_BY->DbValue = $row['ACCEPTED_BY'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->FINANCE_ID->DbValue = $row['FINANCE_ID'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->DISTRIBUTION_TYPE->DbValue = $row['DISTRIBUTION_TYPE'];
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
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [RETUR_ID] = '@RETUR_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->ORG_UNIT_CODE->CurrentValue : $this->ORG_UNIT_CODE->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->RETUR_ID->CurrentValue : $this->RETUR_ID->OldValue;
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
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
            }
            if ($current) {
                $this->RETUR_ID->CurrentValue = $keys[1];
            } else {
                $this->RETUR_ID->OldValue = $keys[1];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ORG_UNIT_CODE', $row) ? $row['ORG_UNIT_CODE'] : null;
        } else {
            $val = $this->ORG_UNIT_CODE->OldValue !== null ? $this->ORG_UNIT_CODE->OldValue : $this->ORG_UNIT_CODE->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ORG_UNIT_CODE@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('RETUR_ID', $row) ? $row['RETUR_ID'] : null;
        } else {
            $val = $this->RETUR_ID->OldValue !== null ? $this->RETUR_ID->OldValue : $this->RETUR_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@RETUR_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ReturDocsList");
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
        if ($pageName == "ReturDocsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ReturDocsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ReturDocsAdd") {
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
                return "ReturDocsView";
            case Config("API_ADD_ACTION"):
                return "ReturDocsAdd";
            case Config("API_EDIT_ACTION"):
                return "ReturDocsEdit";
            case Config("API_DELETE_ACTION"):
                return "ReturDocsDelete";
            case Config("API_LIST_ACTION"):
                return "ReturDocsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ReturDocsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ReturDocsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ReturDocsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ReturDocsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ReturDocsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ReturDocsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ReturDocsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ReturDocsDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "ORG_UNIT_CODE:" . JsonEncode($this->ORG_UNIT_CODE->CurrentValue, "string");
        $json .= ",RETUR_ID:" . JsonEncode($this->RETUR_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ORG_UNIT_CODE->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ORG_UNIT_CODE->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->RETUR_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->RETUR_ID->CurrentValue);
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
            if (($keyValue = Param("ORG_UNIT_CODE") ?? Route("ORG_UNIT_CODE")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("RETUR_ID") ?? Route("RETUR_ID")) !== null) {
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
                $this->ORG_UNIT_CODE->CurrentValue = $key[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $key[0];
            }
            if ($setCurrent) {
                $this->RETUR_ID->CurrentValue = $key[1];
            } else {
                $this->RETUR_ID->OldValue = $key[1];
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
        $this->RETUR_ID->setDbValue($row['RETUR_ID']);
        $this->ORG_UNIT_FROM->setDbValue($row['ORG_UNIT_FROM']);
        $this->ORG_ID->setDbValue($row['ORG_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->ORG_ID_TO->setDbValue($row['ORG_ID_TO']);
        $this->CLINIC_ID_TO->setDbValue($row['CLINIC_ID_TO']);
        $this->RETUR_DATE->setDbValue($row['RETUR_DATE']);
        $this->RETUR_BY->setDbValue($row['RETUR_BY']);
        $this->RETUR_VALUE->setDbValue($row['RETUR_VALUE']);
        $this->RECEIVED_VALUE->setDbValue($row['RECEIVED_VALUE']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->RECEIVED_BY->setDbValue($row['RECEIVED_BY']);
        $this->DOC_NO->setDbValue($row['DOC_NO']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->ACCEPTED_BY->setDbValue($row['ACCEPTED_BY']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->FINANCE_ID->setDbValue($row['FINANCE_ID']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->DISTRIBUTION_TYPE->setDbValue($row['DISTRIBUTION_TYPE']);
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

        // ORG_UNIT_CODE

        // RETUR_ID

        // ORG_UNIT_FROM

        // ORG_ID

        // CLINIC_ID

        // ORG_ID_TO

        // CLINIC_ID_TO

        // RETUR_DATE

        // RETUR_BY

        // RETUR_VALUE

        // RECEIVED_VALUE

        // YEAR_ID

        // RECEIVED_BY

        // DOC_NO

        // COMPANY_ID

        // ACCEPTED_BY

        // ACCOUNT_ID

        // FINANCE_ID

        // DESCRIPTION

        // DISTRIBUTION_TYPE

        // MODIFIED_DATE

        // MODIFIED_BY

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // RETUR_ID
        $this->RETUR_ID->ViewValue = $this->RETUR_ID->CurrentValue;
        $this->RETUR_ID->ViewCustomAttributes = "";

        // ORG_UNIT_FROM
        $this->ORG_UNIT_FROM->ViewValue = $this->ORG_UNIT_FROM->CurrentValue;
        $this->ORG_UNIT_FROM->ViewCustomAttributes = "";

        // ORG_ID
        $this->ORG_ID->ViewValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // ORG_ID_TO
        $this->ORG_ID_TO->ViewValue = $this->ORG_ID_TO->CurrentValue;
        $this->ORG_ID_TO->ViewCustomAttributes = "";

        // CLINIC_ID_TO
        $this->CLINIC_ID_TO->ViewValue = $this->CLINIC_ID_TO->CurrentValue;
        $this->CLINIC_ID_TO->ViewCustomAttributes = "";

        // RETUR_DATE
        $this->RETUR_DATE->ViewValue = $this->RETUR_DATE->CurrentValue;
        $this->RETUR_DATE->ViewValue = FormatDateTime($this->RETUR_DATE->ViewValue, 0);
        $this->RETUR_DATE->ViewCustomAttributes = "";

        // RETUR_BY
        $this->RETUR_BY->ViewValue = $this->RETUR_BY->CurrentValue;
        $this->RETUR_BY->ViewCustomAttributes = "";

        // RETUR_VALUE
        $this->RETUR_VALUE->ViewValue = $this->RETUR_VALUE->CurrentValue;
        $this->RETUR_VALUE->ViewValue = FormatNumber($this->RETUR_VALUE->ViewValue, 2, -2, -2, -2);
        $this->RETUR_VALUE->ViewCustomAttributes = "";

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->ViewValue = $this->RECEIVED_VALUE->CurrentValue;
        $this->RECEIVED_VALUE->ViewValue = FormatNumber($this->RECEIVED_VALUE->ViewValue, 2, -2, -2, -2);
        $this->RECEIVED_VALUE->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // RECEIVED_BY
        $this->RECEIVED_BY->ViewValue = $this->RECEIVED_BY->CurrentValue;
        $this->RECEIVED_BY->ViewCustomAttributes = "";

        // DOC_NO
        $this->DOC_NO->ViewValue = $this->DOC_NO->CurrentValue;
        $this->DOC_NO->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // ACCEPTED_BY
        $this->ACCEPTED_BY->ViewValue = $this->ACCEPTED_BY->CurrentValue;
        $this->ACCEPTED_BY->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // FINANCE_ID
        $this->FINANCE_ID->ViewValue = $this->FINANCE_ID->CurrentValue;
        $this->FINANCE_ID->ViewValue = FormatNumber($this->FINANCE_ID->ViewValue, 0, -2, -2, -2);
        $this->FINANCE_ID->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->CurrentValue;
        $this->DISTRIBUTION_TYPE->ViewValue = FormatNumber($this->DISTRIBUTION_TYPE->ViewValue, 0, -2, -2, -2);
        $this->DISTRIBUTION_TYPE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // RETUR_ID
        $this->RETUR_ID->LinkCustomAttributes = "";
        $this->RETUR_ID->HrefValue = "";
        $this->RETUR_ID->TooltipValue = "";

        // ORG_UNIT_FROM
        $this->ORG_UNIT_FROM->LinkCustomAttributes = "";
        $this->ORG_UNIT_FROM->HrefValue = "";
        $this->ORG_UNIT_FROM->TooltipValue = "";

        // ORG_ID
        $this->ORG_ID->LinkCustomAttributes = "";
        $this->ORG_ID->HrefValue = "";
        $this->ORG_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // ORG_ID_TO
        $this->ORG_ID_TO->LinkCustomAttributes = "";
        $this->ORG_ID_TO->HrefValue = "";
        $this->ORG_ID_TO->TooltipValue = "";

        // CLINIC_ID_TO
        $this->CLINIC_ID_TO->LinkCustomAttributes = "";
        $this->CLINIC_ID_TO->HrefValue = "";
        $this->CLINIC_ID_TO->TooltipValue = "";

        // RETUR_DATE
        $this->RETUR_DATE->LinkCustomAttributes = "";
        $this->RETUR_DATE->HrefValue = "";
        $this->RETUR_DATE->TooltipValue = "";

        // RETUR_BY
        $this->RETUR_BY->LinkCustomAttributes = "";
        $this->RETUR_BY->HrefValue = "";
        $this->RETUR_BY->TooltipValue = "";

        // RETUR_VALUE
        $this->RETUR_VALUE->LinkCustomAttributes = "";
        $this->RETUR_VALUE->HrefValue = "";
        $this->RETUR_VALUE->TooltipValue = "";

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->LinkCustomAttributes = "";
        $this->RECEIVED_VALUE->HrefValue = "";
        $this->RECEIVED_VALUE->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // RECEIVED_BY
        $this->RECEIVED_BY->LinkCustomAttributes = "";
        $this->RECEIVED_BY->HrefValue = "";
        $this->RECEIVED_BY->TooltipValue = "";

        // DOC_NO
        $this->DOC_NO->LinkCustomAttributes = "";
        $this->DOC_NO->HrefValue = "";
        $this->DOC_NO->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // ACCEPTED_BY
        $this->ACCEPTED_BY->LinkCustomAttributes = "";
        $this->ACCEPTED_BY->HrefValue = "";
        $this->ACCEPTED_BY->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // FINANCE_ID
        $this->FINANCE_ID->LinkCustomAttributes = "";
        $this->FINANCE_ID->HrefValue = "";
        $this->FINANCE_ID->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->LinkCustomAttributes = "";
        $this->DISTRIBUTION_TYPE->HrefValue = "";
        $this->DISTRIBUTION_TYPE->TooltipValue = "";

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

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->EditAttrs["class"] = "form-control";
        $this->ORG_UNIT_CODE->EditCustomAttributes = "";
        if (!$this->ORG_UNIT_CODE->Raw) {
            $this->ORG_UNIT_CODE->CurrentValue = HtmlDecode($this->ORG_UNIT_CODE->CurrentValue);
        }
        $this->ORG_UNIT_CODE->EditValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->PlaceHolder = RemoveHtml($this->ORG_UNIT_CODE->caption());

        // RETUR_ID
        $this->RETUR_ID->EditAttrs["class"] = "form-control";
        $this->RETUR_ID->EditCustomAttributes = "";
        if (!$this->RETUR_ID->Raw) {
            $this->RETUR_ID->CurrentValue = HtmlDecode($this->RETUR_ID->CurrentValue);
        }
        $this->RETUR_ID->EditValue = $this->RETUR_ID->CurrentValue;
        $this->RETUR_ID->PlaceHolder = RemoveHtml($this->RETUR_ID->caption());

        // ORG_UNIT_FROM
        $this->ORG_UNIT_FROM->EditAttrs["class"] = "form-control";
        $this->ORG_UNIT_FROM->EditCustomAttributes = "";
        if (!$this->ORG_UNIT_FROM->Raw) {
            $this->ORG_UNIT_FROM->CurrentValue = HtmlDecode($this->ORG_UNIT_FROM->CurrentValue);
        }
        $this->ORG_UNIT_FROM->EditValue = $this->ORG_UNIT_FROM->CurrentValue;
        $this->ORG_UNIT_FROM->PlaceHolder = RemoveHtml($this->ORG_UNIT_FROM->caption());

        // ORG_ID
        $this->ORG_ID->EditAttrs["class"] = "form-control";
        $this->ORG_ID->EditCustomAttributes = "";
        if (!$this->ORG_ID->Raw) {
            $this->ORG_ID->CurrentValue = HtmlDecode($this->ORG_ID->CurrentValue);
        }
        $this->ORG_ID->EditValue = $this->ORG_ID->CurrentValue;
        $this->ORG_ID->PlaceHolder = RemoveHtml($this->ORG_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // ORG_ID_TO
        $this->ORG_ID_TO->EditAttrs["class"] = "form-control";
        $this->ORG_ID_TO->EditCustomAttributes = "";
        if (!$this->ORG_ID_TO->Raw) {
            $this->ORG_ID_TO->CurrentValue = HtmlDecode($this->ORG_ID_TO->CurrentValue);
        }
        $this->ORG_ID_TO->EditValue = $this->ORG_ID_TO->CurrentValue;
        $this->ORG_ID_TO->PlaceHolder = RemoveHtml($this->ORG_ID_TO->caption());

        // CLINIC_ID_TO
        $this->CLINIC_ID_TO->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID_TO->EditCustomAttributes = "";
        if (!$this->CLINIC_ID_TO->Raw) {
            $this->CLINIC_ID_TO->CurrentValue = HtmlDecode($this->CLINIC_ID_TO->CurrentValue);
        }
        $this->CLINIC_ID_TO->EditValue = $this->CLINIC_ID_TO->CurrentValue;
        $this->CLINIC_ID_TO->PlaceHolder = RemoveHtml($this->CLINIC_ID_TO->caption());

        // RETUR_DATE
        $this->RETUR_DATE->EditAttrs["class"] = "form-control";
        $this->RETUR_DATE->EditCustomAttributes = "";
        $this->RETUR_DATE->EditValue = FormatDateTime($this->RETUR_DATE->CurrentValue, 8);
        $this->RETUR_DATE->PlaceHolder = RemoveHtml($this->RETUR_DATE->caption());

        // RETUR_BY
        $this->RETUR_BY->EditAttrs["class"] = "form-control";
        $this->RETUR_BY->EditCustomAttributes = "";
        if (!$this->RETUR_BY->Raw) {
            $this->RETUR_BY->CurrentValue = HtmlDecode($this->RETUR_BY->CurrentValue);
        }
        $this->RETUR_BY->EditValue = $this->RETUR_BY->CurrentValue;
        $this->RETUR_BY->PlaceHolder = RemoveHtml($this->RETUR_BY->caption());

        // RETUR_VALUE
        $this->RETUR_VALUE->EditAttrs["class"] = "form-control";
        $this->RETUR_VALUE->EditCustomAttributes = "";
        $this->RETUR_VALUE->EditValue = $this->RETUR_VALUE->CurrentValue;
        $this->RETUR_VALUE->PlaceHolder = RemoveHtml($this->RETUR_VALUE->caption());
        if (strval($this->RETUR_VALUE->EditValue) != "" && is_numeric($this->RETUR_VALUE->EditValue)) {
            $this->RETUR_VALUE->EditValue = FormatNumber($this->RETUR_VALUE->EditValue, -2, -2, -2, -2);
        }

        // RECEIVED_VALUE
        $this->RECEIVED_VALUE->EditAttrs["class"] = "form-control";
        $this->RECEIVED_VALUE->EditCustomAttributes = "";
        $this->RECEIVED_VALUE->EditValue = $this->RECEIVED_VALUE->CurrentValue;
        $this->RECEIVED_VALUE->PlaceHolder = RemoveHtml($this->RECEIVED_VALUE->caption());
        if (strval($this->RECEIVED_VALUE->EditValue) != "" && is_numeric($this->RECEIVED_VALUE->EditValue)) {
            $this->RECEIVED_VALUE->EditValue = FormatNumber($this->RECEIVED_VALUE->EditValue, -2, -2, -2, -2);
        }

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // RECEIVED_BY
        $this->RECEIVED_BY->EditAttrs["class"] = "form-control";
        $this->RECEIVED_BY->EditCustomAttributes = "";
        if (!$this->RECEIVED_BY->Raw) {
            $this->RECEIVED_BY->CurrentValue = HtmlDecode($this->RECEIVED_BY->CurrentValue);
        }
        $this->RECEIVED_BY->EditValue = $this->RECEIVED_BY->CurrentValue;
        $this->RECEIVED_BY->PlaceHolder = RemoveHtml($this->RECEIVED_BY->caption());

        // DOC_NO
        $this->DOC_NO->EditAttrs["class"] = "form-control";
        $this->DOC_NO->EditCustomAttributes = "";
        if (!$this->DOC_NO->Raw) {
            $this->DOC_NO->CurrentValue = HtmlDecode($this->DOC_NO->CurrentValue);
        }
        $this->DOC_NO->EditValue = $this->DOC_NO->CurrentValue;
        $this->DOC_NO->PlaceHolder = RemoveHtml($this->DOC_NO->caption());

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // ACCEPTED_BY
        $this->ACCEPTED_BY->EditAttrs["class"] = "form-control";
        $this->ACCEPTED_BY->EditCustomAttributes = "";
        if (!$this->ACCEPTED_BY->Raw) {
            $this->ACCEPTED_BY->CurrentValue = HtmlDecode($this->ACCEPTED_BY->CurrentValue);
        }
        $this->ACCEPTED_BY->EditValue = $this->ACCEPTED_BY->CurrentValue;
        $this->ACCEPTED_BY->PlaceHolder = RemoveHtml($this->ACCEPTED_BY->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // FINANCE_ID
        $this->FINANCE_ID->EditAttrs["class"] = "form-control";
        $this->FINANCE_ID->EditCustomAttributes = "";
        $this->FINANCE_ID->EditValue = $this->FINANCE_ID->CurrentValue;
        $this->FINANCE_ID->PlaceHolder = RemoveHtml($this->FINANCE_ID->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->EditAttrs["class"] = "form-control";
        $this->DISTRIBUTION_TYPE->EditCustomAttributes = "";
        $this->DISTRIBUTION_TYPE->EditValue = $this->DISTRIBUTION_TYPE->CurrentValue;
        $this->DISTRIBUTION_TYPE->PlaceHolder = RemoveHtml($this->DISTRIBUTION_TYPE->caption());

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
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->RETUR_ID);
                    $doc->exportCaption($this->ORG_UNIT_FROM);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->ORG_ID_TO);
                    $doc->exportCaption($this->CLINIC_ID_TO);
                    $doc->exportCaption($this->RETUR_DATE);
                    $doc->exportCaption($this->RETUR_BY);
                    $doc->exportCaption($this->RETUR_VALUE);
                    $doc->exportCaption($this->RECEIVED_VALUE);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->RECEIVED_BY);
                    $doc->exportCaption($this->DOC_NO);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->ACCEPTED_BY);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->FINANCE_ID);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DISTRIBUTION_TYPE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->RETUR_ID);
                    $doc->exportCaption($this->ORG_UNIT_FROM);
                    $doc->exportCaption($this->ORG_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->ORG_ID_TO);
                    $doc->exportCaption($this->CLINIC_ID_TO);
                    $doc->exportCaption($this->RETUR_DATE);
                    $doc->exportCaption($this->RETUR_BY);
                    $doc->exportCaption($this->RETUR_VALUE);
                    $doc->exportCaption($this->RECEIVED_VALUE);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->RECEIVED_BY);
                    $doc->exportCaption($this->DOC_NO);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->ACCEPTED_BY);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->FINANCE_ID);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->DISTRIBUTION_TYPE);
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
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->RETUR_ID);
                        $doc->exportField($this->ORG_UNIT_FROM);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->ORG_ID_TO);
                        $doc->exportField($this->CLINIC_ID_TO);
                        $doc->exportField($this->RETUR_DATE);
                        $doc->exportField($this->RETUR_BY);
                        $doc->exportField($this->RETUR_VALUE);
                        $doc->exportField($this->RECEIVED_VALUE);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->RECEIVED_BY);
                        $doc->exportField($this->DOC_NO);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->ACCEPTED_BY);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->FINANCE_ID);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DISTRIBUTION_TYPE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->RETUR_ID);
                        $doc->exportField($this->ORG_UNIT_FROM);
                        $doc->exportField($this->ORG_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->ORG_ID_TO);
                        $doc->exportField($this->CLINIC_ID_TO);
                        $doc->exportField($this->RETUR_DATE);
                        $doc->exportField($this->RETUR_BY);
                        $doc->exportField($this->RETUR_VALUE);
                        $doc->exportField($this->RECEIVED_VALUE);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->RECEIVED_BY);
                        $doc->exportField($this->DOC_NO);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->ACCEPTED_BY);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->FINANCE_ID);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->DISTRIBUTION_TYPE);
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
