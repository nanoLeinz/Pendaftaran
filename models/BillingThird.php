<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for BILLING_THIRD
 */
class BillingThird extends DbTable
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
    public $INVOICE_ID;
    public $YEAR_ID;
    public $ACTIVITY_ID;
    public $PAYOR_ID;
    public $PAYOR_NAME;
    public $PAYOR_ADDRESS;
    public $INVOICE_NO;
    public $INVOICE_DATE;
    public $DESCRIPTION;
    public $SPP_ID;
    public $SPMU_ID;
    public $ISVALID;
    public $VALID_DATE;
    public $VALIDATED_BY;
    public $BENDAHARA;
    public $BENDAHARA_ID;
    public $ACKNOWLEDGE_BY;
    public $ACKNOWLEDGE_ID;
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
        $this->TableVar = 'BILLING_THIRD';
        $this->TableName = 'BILLING_THIRD';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[BILLING_THIRD]";
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
        $this->ORG_UNIT_CODE = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // INVOICE_ID
        $this->INVOICE_ID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_INVOICE_ID', 'INVOICE_ID', '[INVOICE_ID]', '[INVOICE_ID]', 200, 50, -1, false, '[INVOICE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_ID->IsPrimaryKey = true; // Primary key field
        $this->INVOICE_ID->Nullable = false; // NOT NULL field
        $this->INVOICE_ID->Required = true; // Required field
        $this->INVOICE_ID->Sortable = true; // Allow sort
        $this->INVOICE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_ID->Param, "CustomMsg");
        $this->Fields['INVOICE_ID'] = &$this->INVOICE_ID;

        // YEAR_ID
        $this->YEAR_ID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // ACTIVITY_ID
        $this->ACTIVITY_ID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_ACTIVITY_ID', 'ACTIVITY_ID', '[ACTIVITY_ID]', 'CAST([ACTIVITY_ID] AS NVARCHAR)', 2, 2, -1, false, '[ACTIVITY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACTIVITY_ID->Sortable = true; // Allow sort
        $this->ACTIVITY_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ACTIVITY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACTIVITY_ID->Param, "CustomMsg");
        $this->Fields['ACTIVITY_ID'] = &$this->ACTIVITY_ID;

        // PAYOR_ID
        $this->PAYOR_ID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_PAYOR_ID', 'PAYOR_ID', '[PAYOR_ID]', '[PAYOR_ID]', 200, 50, -1, false, '[PAYOR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYOR_ID->Sortable = true; // Allow sort
        $this->PAYOR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ID->Param, "CustomMsg");
        $this->Fields['PAYOR_ID'] = &$this->PAYOR_ID;

        // PAYOR_NAME
        $this->PAYOR_NAME = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_PAYOR_NAME', 'PAYOR_NAME', '[PAYOR_NAME]', '[PAYOR_NAME]', 200, 200, -1, false, '[PAYOR_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYOR_NAME->Sortable = true; // Allow sort
        $this->PAYOR_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_NAME->Param, "CustomMsg");
        $this->Fields['PAYOR_NAME'] = &$this->PAYOR_NAME;

        // PAYOR_ADDRESS
        $this->PAYOR_ADDRESS = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_PAYOR_ADDRESS', 'PAYOR_ADDRESS', '[PAYOR_ADDRESS]', '[PAYOR_ADDRESS]', 200, 200, -1, false, '[PAYOR_ADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAYOR_ADDRESS->Sortable = true; // Allow sort
        $this->PAYOR_ADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAYOR_ADDRESS->Param, "CustomMsg");
        $this->Fields['PAYOR_ADDRESS'] = &$this->PAYOR_ADDRESS;

        // INVOICE_NO
        $this->INVOICE_NO = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_INVOICE_NO', 'INVOICE_NO', '[INVOICE_NO]', '[INVOICE_NO]', 200, 50, -1, false, '[INVOICE_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_NO->Sortable = true; // Allow sort
        $this->INVOICE_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_NO->Param, "CustomMsg");
        $this->Fields['INVOICE_NO'] = &$this->INVOICE_NO;

        // INVOICE_DATE
        $this->INVOICE_DATE = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_INVOICE_DATE', 'INVOICE_DATE', '[INVOICE_DATE]', CastDateFieldForLike("[INVOICE_DATE]", 0, "DB"), 135, 8, 0, false, '[INVOICE_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_DATE->Sortable = true; // Allow sort
        $this->INVOICE_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->INVOICE_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_DATE->Param, "CustomMsg");
        $this->Fields['INVOICE_DATE'] = &$this->INVOICE_DATE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // SPP_ID
        $this->SPP_ID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_SPP_ID', 'SPP_ID', '[SPP_ID]', '[SPP_ID]', 200, 50, -1, false, '[SPP_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_ID->Sortable = true; // Allow sort
        $this->SPP_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_ID->Param, "CustomMsg");
        $this->Fields['SPP_ID'] = &$this->SPP_ID;

        // SPMU_ID
        $this->SPMU_ID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_SPMU_ID', 'SPMU_ID', '[SPMU_ID]', '[SPMU_ID]', 200, 50, -1, false, '[SPMU_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPMU_ID->Sortable = true; // Allow sort
        $this->SPMU_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPMU_ID->Param, "CustomMsg");
        $this->Fields['SPMU_ID'] = &$this->SPMU_ID;

        // ISVALID
        $this->ISVALID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_ISVALID', 'ISVALID', '[ISVALID]', '[ISVALID]', 129, 1, -1, false, '[ISVALID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISVALID->Sortable = true; // Allow sort
        $this->ISVALID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISVALID->Param, "CustomMsg");
        $this->Fields['ISVALID'] = &$this->ISVALID;

        // VALID_DATE
        $this->VALID_DATE = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_VALID_DATE', 'VALID_DATE', '[VALID_DATE]', CastDateFieldForLike("[VALID_DATE]", 0, "DB"), 135, 8, 0, false, '[VALID_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VALID_DATE->Sortable = true; // Allow sort
        $this->VALID_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VALID_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VALID_DATE->Param, "CustomMsg");
        $this->Fields['VALID_DATE'] = &$this->VALID_DATE;

        // VALIDATED_BY
        $this->VALIDATED_BY = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_VALIDATED_BY', 'VALIDATED_BY', '[VALIDATED_BY]', '[VALIDATED_BY]', 200, 100, -1, false, '[VALIDATED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VALIDATED_BY->Sortable = true; // Allow sort
        $this->VALIDATED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VALIDATED_BY->Param, "CustomMsg");
        $this->Fields['VALIDATED_BY'] = &$this->VALIDATED_BY;

        // BENDAHARA
        $this->BENDAHARA = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_BENDAHARA', 'BENDAHARA', '[BENDAHARA]', '[BENDAHARA]', 200, 150, -1, false, '[BENDAHARA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BENDAHARA->Sortable = true; // Allow sort
        $this->BENDAHARA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BENDAHARA->Param, "CustomMsg");
        $this->Fields['BENDAHARA'] = &$this->BENDAHARA;

        // BENDAHARA_ID
        $this->BENDAHARA_ID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_BENDAHARA_ID', 'BENDAHARA_ID', '[BENDAHARA_ID]', '[BENDAHARA_ID]', 200, 50, -1, false, '[BENDAHARA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BENDAHARA_ID->Sortable = true; // Allow sort
        $this->BENDAHARA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BENDAHARA_ID->Param, "CustomMsg");
        $this->Fields['BENDAHARA_ID'] = &$this->BENDAHARA_ID;

        // ACKNOWLEDGE_BY
        $this->ACKNOWLEDGE_BY = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_ACKNOWLEDGE_BY', 'ACKNOWLEDGE_BY', '[ACKNOWLEDGE_BY]', '[ACKNOWLEDGE_BY]', 200, 150, -1, false, '[ACKNOWLEDGE_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACKNOWLEDGE_BY->Sortable = true; // Allow sort
        $this->ACKNOWLEDGE_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACKNOWLEDGE_BY->Param, "CustomMsg");
        $this->Fields['ACKNOWLEDGE_BY'] = &$this->ACKNOWLEDGE_BY;

        // ACKNOWLEDGE_ID
        $this->ACKNOWLEDGE_ID = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_ACKNOWLEDGE_ID', 'ACKNOWLEDGE_ID', '[ACKNOWLEDGE_ID]', '[ACKNOWLEDGE_ID]', 200, 50, -1, false, '[ACKNOWLEDGE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACKNOWLEDGE_ID->Sortable = true; // Allow sort
        $this->ACKNOWLEDGE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACKNOWLEDGE_ID->Param, "CustomMsg");
        $this->Fields['ACKNOWLEDGE_ID'] = &$this->ACKNOWLEDGE_ID;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('BILLING_THIRD', 'BILLING_THIRD', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 200, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[BILLING_THIRD]";
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
            if (array_key_exists('INVOICE_ID', $rs)) {
                AddFilter($where, QuotedName('INVOICE_ID', $this->Dbid) . '=' . QuotedValue($rs['INVOICE_ID'], $this->INVOICE_ID->DataType, $this->Dbid));
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
        $this->INVOICE_ID->DbValue = $row['INVOICE_ID'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->ACTIVITY_ID->DbValue = $row['ACTIVITY_ID'];
        $this->PAYOR_ID->DbValue = $row['PAYOR_ID'];
        $this->PAYOR_NAME->DbValue = $row['PAYOR_NAME'];
        $this->PAYOR_ADDRESS->DbValue = $row['PAYOR_ADDRESS'];
        $this->INVOICE_NO->DbValue = $row['INVOICE_NO'];
        $this->INVOICE_DATE->DbValue = $row['INVOICE_DATE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->SPP_ID->DbValue = $row['SPP_ID'];
        $this->SPMU_ID->DbValue = $row['SPMU_ID'];
        $this->ISVALID->DbValue = $row['ISVALID'];
        $this->VALID_DATE->DbValue = $row['VALID_DATE'];
        $this->VALIDATED_BY->DbValue = $row['VALIDATED_BY'];
        $this->BENDAHARA->DbValue = $row['BENDAHARA'];
        $this->BENDAHARA_ID->DbValue = $row['BENDAHARA_ID'];
        $this->ACKNOWLEDGE_BY->DbValue = $row['ACKNOWLEDGE_BY'];
        $this->ACKNOWLEDGE_ID->DbValue = $row['ACKNOWLEDGE_ID'];
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
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [INVOICE_ID] = '@INVOICE_ID@'";
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
        $val = $current ? $this->INVOICE_ID->CurrentValue : $this->INVOICE_ID->OldValue;
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
                $this->INVOICE_ID->CurrentValue = $keys[1];
            } else {
                $this->INVOICE_ID->OldValue = $keys[1];
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
            $val = array_key_exists('INVOICE_ID', $row) ? $row['INVOICE_ID'] : null;
        } else {
            $val = $this->INVOICE_ID->OldValue !== null ? $this->INVOICE_ID->OldValue : $this->INVOICE_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@INVOICE_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("BillingThirdList");
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
        if ($pageName == "BillingThirdView") {
            return $Language->phrase("View");
        } elseif ($pageName == "BillingThirdEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "BillingThirdAdd") {
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
                return "BillingThirdView";
            case Config("API_ADD_ACTION"):
                return "BillingThirdAdd";
            case Config("API_EDIT_ACTION"):
                return "BillingThirdEdit";
            case Config("API_DELETE_ACTION"):
                return "BillingThirdDelete";
            case Config("API_LIST_ACTION"):
                return "BillingThirdList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "BillingThirdList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BillingThirdView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("BillingThirdView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BillingThirdAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "BillingThirdAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BillingThirdEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("BillingThirdAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("BillingThirdDelete", $this->getUrlParm());
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
        $json .= ",INVOICE_ID:" . JsonEncode($this->INVOICE_ID->CurrentValue, "string");
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
        if ($this->INVOICE_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->INVOICE_ID->CurrentValue);
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
            if (($keyValue = Param("INVOICE_ID") ?? Route("INVOICE_ID")) !== null) {
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
                $this->INVOICE_ID->CurrentValue = $key[1];
            } else {
                $this->INVOICE_ID->OldValue = $key[1];
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
        $this->INVOICE_ID->setDbValue($row['INVOICE_ID']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->ACTIVITY_ID->setDbValue($row['ACTIVITY_ID']);
        $this->PAYOR_ID->setDbValue($row['PAYOR_ID']);
        $this->PAYOR_NAME->setDbValue($row['PAYOR_NAME']);
        $this->PAYOR_ADDRESS->setDbValue($row['PAYOR_ADDRESS']);
        $this->INVOICE_NO->setDbValue($row['INVOICE_NO']);
        $this->INVOICE_DATE->setDbValue($row['INVOICE_DATE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->SPP_ID->setDbValue($row['SPP_ID']);
        $this->SPMU_ID->setDbValue($row['SPMU_ID']);
        $this->ISVALID->setDbValue($row['ISVALID']);
        $this->VALID_DATE->setDbValue($row['VALID_DATE']);
        $this->VALIDATED_BY->setDbValue($row['VALIDATED_BY']);
        $this->BENDAHARA->setDbValue($row['BENDAHARA']);
        $this->BENDAHARA_ID->setDbValue($row['BENDAHARA_ID']);
        $this->ACKNOWLEDGE_BY->setDbValue($row['ACKNOWLEDGE_BY']);
        $this->ACKNOWLEDGE_ID->setDbValue($row['ACKNOWLEDGE_ID']);
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

        // INVOICE_ID

        // YEAR_ID

        // ACTIVITY_ID

        // PAYOR_ID

        // PAYOR_NAME

        // PAYOR_ADDRESS

        // INVOICE_NO

        // INVOICE_DATE

        // DESCRIPTION

        // SPP_ID

        // SPMU_ID

        // ISVALID

        // VALID_DATE

        // VALIDATED_BY

        // BENDAHARA

        // BENDAHARA_ID

        // ACKNOWLEDGE_BY

        // ACKNOWLEDGE_ID

        // MODIFIED_DATE

        // MODIFIED_BY

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // INVOICE_ID
        $this->INVOICE_ID->ViewValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->ViewValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->ViewValue = FormatNumber($this->ACTIVITY_ID->ViewValue, 0, -2, -2, -2);
        $this->ACTIVITY_ID->ViewCustomAttributes = "";

        // PAYOR_ID
        $this->PAYOR_ID->ViewValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->ViewCustomAttributes = "";

        // PAYOR_NAME
        $this->PAYOR_NAME->ViewValue = $this->PAYOR_NAME->CurrentValue;
        $this->PAYOR_NAME->ViewCustomAttributes = "";

        // PAYOR_ADDRESS
        $this->PAYOR_ADDRESS->ViewValue = $this->PAYOR_ADDRESS->CurrentValue;
        $this->PAYOR_ADDRESS->ViewCustomAttributes = "";

        // INVOICE_NO
        $this->INVOICE_NO->ViewValue = $this->INVOICE_NO->CurrentValue;
        $this->INVOICE_NO->ViewCustomAttributes = "";

        // INVOICE_DATE
        $this->INVOICE_DATE->ViewValue = $this->INVOICE_DATE->CurrentValue;
        $this->INVOICE_DATE->ViewValue = FormatDateTime($this->INVOICE_DATE->ViewValue, 0);
        $this->INVOICE_DATE->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // SPP_ID
        $this->SPP_ID->ViewValue = $this->SPP_ID->CurrentValue;
        $this->SPP_ID->ViewCustomAttributes = "";

        // SPMU_ID
        $this->SPMU_ID->ViewValue = $this->SPMU_ID->CurrentValue;
        $this->SPMU_ID->ViewCustomAttributes = "";

        // ISVALID
        $this->ISVALID->ViewValue = $this->ISVALID->CurrentValue;
        $this->ISVALID->ViewCustomAttributes = "";

        // VALID_DATE
        $this->VALID_DATE->ViewValue = $this->VALID_DATE->CurrentValue;
        $this->VALID_DATE->ViewValue = FormatDateTime($this->VALID_DATE->ViewValue, 0);
        $this->VALID_DATE->ViewCustomAttributes = "";

        // VALIDATED_BY
        $this->VALIDATED_BY->ViewValue = $this->VALIDATED_BY->CurrentValue;
        $this->VALIDATED_BY->ViewCustomAttributes = "";

        // BENDAHARA
        $this->BENDAHARA->ViewValue = $this->BENDAHARA->CurrentValue;
        $this->BENDAHARA->ViewCustomAttributes = "";

        // BENDAHARA_ID
        $this->BENDAHARA_ID->ViewValue = $this->BENDAHARA_ID->CurrentValue;
        $this->BENDAHARA_ID->ViewCustomAttributes = "";

        // ACKNOWLEDGE_BY
        $this->ACKNOWLEDGE_BY->ViewValue = $this->ACKNOWLEDGE_BY->CurrentValue;
        $this->ACKNOWLEDGE_BY->ViewCustomAttributes = "";

        // ACKNOWLEDGE_ID
        $this->ACKNOWLEDGE_ID->ViewValue = $this->ACKNOWLEDGE_ID->CurrentValue;
        $this->ACKNOWLEDGE_ID->ViewCustomAttributes = "";

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

        // INVOICE_ID
        $this->INVOICE_ID->LinkCustomAttributes = "";
        $this->INVOICE_ID->HrefValue = "";
        $this->INVOICE_ID->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // ACTIVITY_ID
        $this->ACTIVITY_ID->LinkCustomAttributes = "";
        $this->ACTIVITY_ID->HrefValue = "";
        $this->ACTIVITY_ID->TooltipValue = "";

        // PAYOR_ID
        $this->PAYOR_ID->LinkCustomAttributes = "";
        $this->PAYOR_ID->HrefValue = "";
        $this->PAYOR_ID->TooltipValue = "";

        // PAYOR_NAME
        $this->PAYOR_NAME->LinkCustomAttributes = "";
        $this->PAYOR_NAME->HrefValue = "";
        $this->PAYOR_NAME->TooltipValue = "";

        // PAYOR_ADDRESS
        $this->PAYOR_ADDRESS->LinkCustomAttributes = "";
        $this->PAYOR_ADDRESS->HrefValue = "";
        $this->PAYOR_ADDRESS->TooltipValue = "";

        // INVOICE_NO
        $this->INVOICE_NO->LinkCustomAttributes = "";
        $this->INVOICE_NO->HrefValue = "";
        $this->INVOICE_NO->TooltipValue = "";

        // INVOICE_DATE
        $this->INVOICE_DATE->LinkCustomAttributes = "";
        $this->INVOICE_DATE->HrefValue = "";
        $this->INVOICE_DATE->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // SPP_ID
        $this->SPP_ID->LinkCustomAttributes = "";
        $this->SPP_ID->HrefValue = "";
        $this->SPP_ID->TooltipValue = "";

        // SPMU_ID
        $this->SPMU_ID->LinkCustomAttributes = "";
        $this->SPMU_ID->HrefValue = "";
        $this->SPMU_ID->TooltipValue = "";

        // ISVALID
        $this->ISVALID->LinkCustomAttributes = "";
        $this->ISVALID->HrefValue = "";
        $this->ISVALID->TooltipValue = "";

        // VALID_DATE
        $this->VALID_DATE->LinkCustomAttributes = "";
        $this->VALID_DATE->HrefValue = "";
        $this->VALID_DATE->TooltipValue = "";

        // VALIDATED_BY
        $this->VALIDATED_BY->LinkCustomAttributes = "";
        $this->VALIDATED_BY->HrefValue = "";
        $this->VALIDATED_BY->TooltipValue = "";

        // BENDAHARA
        $this->BENDAHARA->LinkCustomAttributes = "";
        $this->BENDAHARA->HrefValue = "";
        $this->BENDAHARA->TooltipValue = "";

        // BENDAHARA_ID
        $this->BENDAHARA_ID->LinkCustomAttributes = "";
        $this->BENDAHARA_ID->HrefValue = "";
        $this->BENDAHARA_ID->TooltipValue = "";

        // ACKNOWLEDGE_BY
        $this->ACKNOWLEDGE_BY->LinkCustomAttributes = "";
        $this->ACKNOWLEDGE_BY->HrefValue = "";
        $this->ACKNOWLEDGE_BY->TooltipValue = "";

        // ACKNOWLEDGE_ID
        $this->ACKNOWLEDGE_ID->LinkCustomAttributes = "";
        $this->ACKNOWLEDGE_ID->HrefValue = "";
        $this->ACKNOWLEDGE_ID->TooltipValue = "";

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

        // INVOICE_ID
        $this->INVOICE_ID->EditAttrs["class"] = "form-control";
        $this->INVOICE_ID->EditCustomAttributes = "";
        if (!$this->INVOICE_ID->Raw) {
            $this->INVOICE_ID->CurrentValue = HtmlDecode($this->INVOICE_ID->CurrentValue);
        }
        $this->INVOICE_ID->EditValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->PlaceHolder = RemoveHtml($this->INVOICE_ID->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // ACTIVITY_ID
        $this->ACTIVITY_ID->EditAttrs["class"] = "form-control";
        $this->ACTIVITY_ID->EditCustomAttributes = "";
        $this->ACTIVITY_ID->EditValue = $this->ACTIVITY_ID->CurrentValue;
        $this->ACTIVITY_ID->PlaceHolder = RemoveHtml($this->ACTIVITY_ID->caption());

        // PAYOR_ID
        $this->PAYOR_ID->EditAttrs["class"] = "form-control";
        $this->PAYOR_ID->EditCustomAttributes = "";
        if (!$this->PAYOR_ID->Raw) {
            $this->PAYOR_ID->CurrentValue = HtmlDecode($this->PAYOR_ID->CurrentValue);
        }
        $this->PAYOR_ID->EditValue = $this->PAYOR_ID->CurrentValue;
        $this->PAYOR_ID->PlaceHolder = RemoveHtml($this->PAYOR_ID->caption());

        // PAYOR_NAME
        $this->PAYOR_NAME->EditAttrs["class"] = "form-control";
        $this->PAYOR_NAME->EditCustomAttributes = "";
        if (!$this->PAYOR_NAME->Raw) {
            $this->PAYOR_NAME->CurrentValue = HtmlDecode($this->PAYOR_NAME->CurrentValue);
        }
        $this->PAYOR_NAME->EditValue = $this->PAYOR_NAME->CurrentValue;
        $this->PAYOR_NAME->PlaceHolder = RemoveHtml($this->PAYOR_NAME->caption());

        // PAYOR_ADDRESS
        $this->PAYOR_ADDRESS->EditAttrs["class"] = "form-control";
        $this->PAYOR_ADDRESS->EditCustomAttributes = "";
        if (!$this->PAYOR_ADDRESS->Raw) {
            $this->PAYOR_ADDRESS->CurrentValue = HtmlDecode($this->PAYOR_ADDRESS->CurrentValue);
        }
        $this->PAYOR_ADDRESS->EditValue = $this->PAYOR_ADDRESS->CurrentValue;
        $this->PAYOR_ADDRESS->PlaceHolder = RemoveHtml($this->PAYOR_ADDRESS->caption());

        // INVOICE_NO
        $this->INVOICE_NO->EditAttrs["class"] = "form-control";
        $this->INVOICE_NO->EditCustomAttributes = "";
        if (!$this->INVOICE_NO->Raw) {
            $this->INVOICE_NO->CurrentValue = HtmlDecode($this->INVOICE_NO->CurrentValue);
        }
        $this->INVOICE_NO->EditValue = $this->INVOICE_NO->CurrentValue;
        $this->INVOICE_NO->PlaceHolder = RemoveHtml($this->INVOICE_NO->caption());

        // INVOICE_DATE
        $this->INVOICE_DATE->EditAttrs["class"] = "form-control";
        $this->INVOICE_DATE->EditCustomAttributes = "";
        $this->INVOICE_DATE->EditValue = FormatDateTime($this->INVOICE_DATE->CurrentValue, 8);
        $this->INVOICE_DATE->PlaceHolder = RemoveHtml($this->INVOICE_DATE->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // SPP_ID
        $this->SPP_ID->EditAttrs["class"] = "form-control";
        $this->SPP_ID->EditCustomAttributes = "";
        if (!$this->SPP_ID->Raw) {
            $this->SPP_ID->CurrentValue = HtmlDecode($this->SPP_ID->CurrentValue);
        }
        $this->SPP_ID->EditValue = $this->SPP_ID->CurrentValue;
        $this->SPP_ID->PlaceHolder = RemoveHtml($this->SPP_ID->caption());

        // SPMU_ID
        $this->SPMU_ID->EditAttrs["class"] = "form-control";
        $this->SPMU_ID->EditCustomAttributes = "";
        if (!$this->SPMU_ID->Raw) {
            $this->SPMU_ID->CurrentValue = HtmlDecode($this->SPMU_ID->CurrentValue);
        }
        $this->SPMU_ID->EditValue = $this->SPMU_ID->CurrentValue;
        $this->SPMU_ID->PlaceHolder = RemoveHtml($this->SPMU_ID->caption());

        // ISVALID
        $this->ISVALID->EditAttrs["class"] = "form-control";
        $this->ISVALID->EditCustomAttributes = "";
        if (!$this->ISVALID->Raw) {
            $this->ISVALID->CurrentValue = HtmlDecode($this->ISVALID->CurrentValue);
        }
        $this->ISVALID->EditValue = $this->ISVALID->CurrentValue;
        $this->ISVALID->PlaceHolder = RemoveHtml($this->ISVALID->caption());

        // VALID_DATE
        $this->VALID_DATE->EditAttrs["class"] = "form-control";
        $this->VALID_DATE->EditCustomAttributes = "";
        $this->VALID_DATE->EditValue = FormatDateTime($this->VALID_DATE->CurrentValue, 8);
        $this->VALID_DATE->PlaceHolder = RemoveHtml($this->VALID_DATE->caption());

        // VALIDATED_BY
        $this->VALIDATED_BY->EditAttrs["class"] = "form-control";
        $this->VALIDATED_BY->EditCustomAttributes = "";
        if (!$this->VALIDATED_BY->Raw) {
            $this->VALIDATED_BY->CurrentValue = HtmlDecode($this->VALIDATED_BY->CurrentValue);
        }
        $this->VALIDATED_BY->EditValue = $this->VALIDATED_BY->CurrentValue;
        $this->VALIDATED_BY->PlaceHolder = RemoveHtml($this->VALIDATED_BY->caption());

        // BENDAHARA
        $this->BENDAHARA->EditAttrs["class"] = "form-control";
        $this->BENDAHARA->EditCustomAttributes = "";
        if (!$this->BENDAHARA->Raw) {
            $this->BENDAHARA->CurrentValue = HtmlDecode($this->BENDAHARA->CurrentValue);
        }
        $this->BENDAHARA->EditValue = $this->BENDAHARA->CurrentValue;
        $this->BENDAHARA->PlaceHolder = RemoveHtml($this->BENDAHARA->caption());

        // BENDAHARA_ID
        $this->BENDAHARA_ID->EditAttrs["class"] = "form-control";
        $this->BENDAHARA_ID->EditCustomAttributes = "";
        if (!$this->BENDAHARA_ID->Raw) {
            $this->BENDAHARA_ID->CurrentValue = HtmlDecode($this->BENDAHARA_ID->CurrentValue);
        }
        $this->BENDAHARA_ID->EditValue = $this->BENDAHARA_ID->CurrentValue;
        $this->BENDAHARA_ID->PlaceHolder = RemoveHtml($this->BENDAHARA_ID->caption());

        // ACKNOWLEDGE_BY
        $this->ACKNOWLEDGE_BY->EditAttrs["class"] = "form-control";
        $this->ACKNOWLEDGE_BY->EditCustomAttributes = "";
        if (!$this->ACKNOWLEDGE_BY->Raw) {
            $this->ACKNOWLEDGE_BY->CurrentValue = HtmlDecode($this->ACKNOWLEDGE_BY->CurrentValue);
        }
        $this->ACKNOWLEDGE_BY->EditValue = $this->ACKNOWLEDGE_BY->CurrentValue;
        $this->ACKNOWLEDGE_BY->PlaceHolder = RemoveHtml($this->ACKNOWLEDGE_BY->caption());

        // ACKNOWLEDGE_ID
        $this->ACKNOWLEDGE_ID->EditAttrs["class"] = "form-control";
        $this->ACKNOWLEDGE_ID->EditCustomAttributes = "";
        if (!$this->ACKNOWLEDGE_ID->Raw) {
            $this->ACKNOWLEDGE_ID->CurrentValue = HtmlDecode($this->ACKNOWLEDGE_ID->CurrentValue);
        }
        $this->ACKNOWLEDGE_ID->EditValue = $this->ACKNOWLEDGE_ID->CurrentValue;
        $this->ACKNOWLEDGE_ID->PlaceHolder = RemoveHtml($this->ACKNOWLEDGE_ID->caption());

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
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->PAYOR_NAME);
                    $doc->exportCaption($this->PAYOR_ADDRESS);
                    $doc->exportCaption($this->INVOICE_NO);
                    $doc->exportCaption($this->INVOICE_DATE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->SPP_ID);
                    $doc->exportCaption($this->SPMU_ID);
                    $doc->exportCaption($this->ISVALID);
                    $doc->exportCaption($this->VALID_DATE);
                    $doc->exportCaption($this->VALIDATED_BY);
                    $doc->exportCaption($this->BENDAHARA);
                    $doc->exportCaption($this->BENDAHARA_ID);
                    $doc->exportCaption($this->ACKNOWLEDGE_BY);
                    $doc->exportCaption($this->ACKNOWLEDGE_ID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ACTIVITY_ID);
                    $doc->exportCaption($this->PAYOR_ID);
                    $doc->exportCaption($this->PAYOR_NAME);
                    $doc->exportCaption($this->PAYOR_ADDRESS);
                    $doc->exportCaption($this->INVOICE_NO);
                    $doc->exportCaption($this->INVOICE_DATE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->SPP_ID);
                    $doc->exportCaption($this->SPMU_ID);
                    $doc->exportCaption($this->ISVALID);
                    $doc->exportCaption($this->VALID_DATE);
                    $doc->exportCaption($this->VALIDATED_BY);
                    $doc->exportCaption($this->BENDAHARA);
                    $doc->exportCaption($this->BENDAHARA_ID);
                    $doc->exportCaption($this->ACKNOWLEDGE_BY);
                    $doc->exportCaption($this->ACKNOWLEDGE_ID);
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
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->PAYOR_NAME);
                        $doc->exportField($this->PAYOR_ADDRESS);
                        $doc->exportField($this->INVOICE_NO);
                        $doc->exportField($this->INVOICE_DATE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->SPP_ID);
                        $doc->exportField($this->SPMU_ID);
                        $doc->exportField($this->ISVALID);
                        $doc->exportField($this->VALID_DATE);
                        $doc->exportField($this->VALIDATED_BY);
                        $doc->exportField($this->BENDAHARA);
                        $doc->exportField($this->BENDAHARA_ID);
                        $doc->exportField($this->ACKNOWLEDGE_BY);
                        $doc->exportField($this->ACKNOWLEDGE_ID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ACTIVITY_ID);
                        $doc->exportField($this->PAYOR_ID);
                        $doc->exportField($this->PAYOR_NAME);
                        $doc->exportField($this->PAYOR_ADDRESS);
                        $doc->exportField($this->INVOICE_NO);
                        $doc->exportField($this->INVOICE_DATE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->SPP_ID);
                        $doc->exportField($this->SPMU_ID);
                        $doc->exportField($this->ISVALID);
                        $doc->exportField($this->VALID_DATE);
                        $doc->exportField($this->VALIDATED_BY);
                        $doc->exportField($this->BENDAHARA);
                        $doc->exportField($this->BENDAHARA_ID);
                        $doc->exportField($this->ACKNOWLEDGE_BY);
                        $doc->exportField($this->ACKNOWLEDGE_ID);
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
