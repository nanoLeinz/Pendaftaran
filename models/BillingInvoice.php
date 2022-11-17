<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for BILLING_INVOICE
 */
class BillingInvoice extends DbTable
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
    public $BILLTRANS_ID;
    public $INVOICE_ID;
    public $VISIT_DATE;
    public $ATAS_NAMA;
    public $NO_REGISTRATION;
    public $THEADDRESS;
    public $THEAGE;
    public $STATUS_PASIEN_ID;
    public $PASIEN_ID;
    public $FAMILY_STATUS_ID;
    public $DIAGNOSA_ID;
    public $DESCRIPTION;
    public $PRINT_DATE;
    public $REALNAMA;
    public $REALNO;
    public $REALADDRESS;
    public $REALSTATUS;
    public $REALAGE;
    public $ISVALID;
    public $VALID_DATE;
    public $VALIDATED_BY;
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
        $this->TableVar = 'BILLING_INVOICE';
        $this->TableName = 'BILLING_INVOICE';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[BILLING_INVOICE]";
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
        $this->ORG_UNIT_CODE = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // BILLTRANS_ID
        $this->BILLTRANS_ID = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_BILLTRANS_ID', 'BILLTRANS_ID', '[BILLTRANS_ID]', '[BILLTRANS_ID]', 200, 50, -1, false, '[BILLTRANS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILLTRANS_ID->IsPrimaryKey = true; // Primary key field
        $this->BILLTRANS_ID->Nullable = false; // NOT NULL field
        $this->BILLTRANS_ID->Required = true; // Required field
        $this->BILLTRANS_ID->Sortable = true; // Allow sort
        $this->BILLTRANS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILLTRANS_ID->Param, "CustomMsg");
        $this->Fields['BILLTRANS_ID'] = &$this->BILLTRANS_ID;

        // INVOICE_ID
        $this->INVOICE_ID = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_INVOICE_ID', 'INVOICE_ID', '[INVOICE_ID]', '[INVOICE_ID]', 200, 50, -1, false, '[INVOICE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INVOICE_ID->Sortable = true; // Allow sort
        $this->INVOICE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INVOICE_ID->Param, "CustomMsg");
        $this->Fields['INVOICE_ID'] = &$this->INVOICE_ID;

        // VISIT_DATE
        $this->VISIT_DATE = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_VISIT_DATE', 'VISIT_DATE', '[VISIT_DATE]', CastDateFieldForLike("[VISIT_DATE]", 0, "DB"), 135, 8, 0, false, '[VISIT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_DATE->Sortable = true; // Allow sort
        $this->VISIT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VISIT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_DATE->Param, "CustomMsg");
        $this->Fields['VISIT_DATE'] = &$this->VISIT_DATE;

        // ATAS_NAMA
        $this->ATAS_NAMA = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_ATAS_NAMA', 'ATAS_NAMA', '[ATAS_NAMA]', '[ATAS_NAMA]', 200, 200, -1, false, '[ATAS_NAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ATAS_NAMA->Sortable = true; // Allow sort
        $this->ATAS_NAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ATAS_NAMA->Param, "CustomMsg");
        $this->Fields['ATAS_NAMA'] = &$this->ATAS_NAMA;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // THEADDRESS
        $this->THEADDRESS = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_THEADDRESS', 'THEADDRESS', '[THEADDRESS]', '[THEADDRESS]', 200, 200, -1, false, '[THEADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEADDRESS->Sortable = true; // Allow sort
        $this->THEADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEADDRESS->Param, "CustomMsg");
        $this->Fields['THEADDRESS'] = &$this->THEADDRESS;

        // THEAGE
        $this->THEAGE = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_THEAGE', 'THEAGE', '[THEAGE]', '[THEAGE]', 200, 50, -1, false, '[THEAGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEAGE->Sortable = true; // Allow sort
        $this->THEAGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEAGE->Param, "CustomMsg");
        $this->Fields['THEAGE'] = &$this->THEAGE;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 2, 2, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // PASIEN_ID
        $this->PASIEN_ID = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_PASIEN_ID', 'PASIEN_ID', '[PASIEN_ID]', '[PASIEN_ID]', 200, 50, -1, false, '[PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PASIEN_ID->Sortable = true; // Allow sort
        $this->PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PASIEN_ID->Param, "CustomMsg");
        $this->Fields['PASIEN_ID'] = &$this->PASIEN_ID;

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_FAMILY_STATUS_ID', 'FAMILY_STATUS_ID', '[FAMILY_STATUS_ID]', 'CAST([FAMILY_STATUS_ID] AS NVARCHAR)', 17, 1, -1, false, '[FAMILY_STATUS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FAMILY_STATUS_ID->Sortable = true; // Allow sort
        $this->FAMILY_STATUS_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FAMILY_STATUS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FAMILY_STATUS_ID->Param, "CustomMsg");
        $this->Fields['FAMILY_STATUS_ID'] = &$this->FAMILY_STATUS_ID;

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_DIAGNOSA_ID', 'DIAGNOSA_ID', '[DIAGNOSA_ID]', '[DIAGNOSA_ID]', 200, 50, -1, false, '[DIAGNOSA_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DIAGNOSA_ID->Sortable = true; // Allow sort
        $this->DIAGNOSA_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DIAGNOSA_ID->Param, "CustomMsg");
        $this->Fields['DIAGNOSA_ID'] = &$this->DIAGNOSA_ID;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = true; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // REALNAMA
        $this->REALNAMA = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_REALNAMA', 'REALNAMA', '[REALNAMA]', '[REALNAMA]', 200, 100, -1, false, '[REALNAMA]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REALNAMA->Sortable = true; // Allow sort
        $this->REALNAMA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REALNAMA->Param, "CustomMsg");
        $this->Fields['REALNAMA'] = &$this->REALNAMA;

        // REALNO
        $this->REALNO = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_REALNO', 'REALNO', '[REALNO]', '[REALNO]', 200, 50, -1, false, '[REALNO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REALNO->Sortable = true; // Allow sort
        $this->REALNO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REALNO->Param, "CustomMsg");
        $this->Fields['REALNO'] = &$this->REALNO;

        // REALADDRESS
        $this->REALADDRESS = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_REALADDRESS', 'REALADDRESS', '[REALADDRESS]', '[REALADDRESS]', 200, 200, -1, false, '[REALADDRESS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REALADDRESS->Sortable = true; // Allow sort
        $this->REALADDRESS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REALADDRESS->Param, "CustomMsg");
        $this->Fields['REALADDRESS'] = &$this->REALADDRESS;

        // REALSTATUS
        $this->REALSTATUS = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_REALSTATUS', 'REALSTATUS', '[REALSTATUS]', 'CAST([REALSTATUS] AS NVARCHAR)', 2, 2, -1, false, '[REALSTATUS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REALSTATUS->Sortable = true; // Allow sort
        $this->REALSTATUS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REALSTATUS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REALSTATUS->Param, "CustomMsg");
        $this->Fields['REALSTATUS'] = &$this->REALSTATUS;

        // REALAGE
        $this->REALAGE = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_REALAGE', 'REALAGE', '[REALAGE]', '[REALAGE]', 200, 100, -1, false, '[REALAGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REALAGE->Sortable = true; // Allow sort
        $this->REALAGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REALAGE->Param, "CustomMsg");
        $this->Fields['REALAGE'] = &$this->REALAGE;

        // ISVALID
        $this->ISVALID = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_ISVALID', 'ISVALID', '[ISVALID]', '[ISVALID]', 129, 1, -1, false, '[ISVALID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISVALID->Sortable = true; // Allow sort
        $this->ISVALID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISVALID->Param, "CustomMsg");
        $this->Fields['ISVALID'] = &$this->ISVALID;

        // VALID_DATE
        $this->VALID_DATE = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_VALID_DATE', 'VALID_DATE', '[VALID_DATE]', CastDateFieldForLike("[VALID_DATE]", 0, "DB"), 135, 8, 0, false, '[VALID_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VALID_DATE->Sortable = true; // Allow sort
        $this->VALID_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VALID_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VALID_DATE->Param, "CustomMsg");
        $this->Fields['VALID_DATE'] = &$this->VALID_DATE;

        // VALIDATED_BY
        $this->VALIDATED_BY = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_VALIDATED_BY', 'VALIDATED_BY', '[VALIDATED_BY]', '[VALIDATED_BY]', 200, 100, -1, false, '[VALIDATED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VALIDATED_BY->Sortable = true; // Allow sort
        $this->VALIDATED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VALIDATED_BY->Param, "CustomMsg");
        $this->Fields['VALIDATED_BY'] = &$this->VALIDATED_BY;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('BILLING_INVOICE', 'BILLING_INVOICE', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 200, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[BILLING_INVOICE]";
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
            if (array_key_exists('BILLTRANS_ID', $rs)) {
                AddFilter($where, QuotedName('BILLTRANS_ID', $this->Dbid) . '=' . QuotedValue($rs['BILLTRANS_ID'], $this->BILLTRANS_ID->DataType, $this->Dbid));
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
        $this->BILLTRANS_ID->DbValue = $row['BILLTRANS_ID'];
        $this->INVOICE_ID->DbValue = $row['INVOICE_ID'];
        $this->VISIT_DATE->DbValue = $row['VISIT_DATE'];
        $this->ATAS_NAMA->DbValue = $row['ATAS_NAMA'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->THEADDRESS->DbValue = $row['THEADDRESS'];
        $this->THEAGE->DbValue = $row['THEAGE'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->PASIEN_ID->DbValue = $row['PASIEN_ID'];
        $this->FAMILY_STATUS_ID->DbValue = $row['FAMILY_STATUS_ID'];
        $this->DIAGNOSA_ID->DbValue = $row['DIAGNOSA_ID'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->REALNAMA->DbValue = $row['REALNAMA'];
        $this->REALNO->DbValue = $row['REALNO'];
        $this->REALADDRESS->DbValue = $row['REALADDRESS'];
        $this->REALSTATUS->DbValue = $row['REALSTATUS'];
        $this->REALAGE->DbValue = $row['REALAGE'];
        $this->ISVALID->DbValue = $row['ISVALID'];
        $this->VALID_DATE->DbValue = $row['VALID_DATE'];
        $this->VALIDATED_BY->DbValue = $row['VALIDATED_BY'];
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
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [BILLTRANS_ID] = '@BILLTRANS_ID@'";
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
        $val = $current ? $this->BILLTRANS_ID->CurrentValue : $this->BILLTRANS_ID->OldValue;
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
                $this->BILLTRANS_ID->CurrentValue = $keys[1];
            } else {
                $this->BILLTRANS_ID->OldValue = $keys[1];
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
            $val = array_key_exists('BILLTRANS_ID', $row) ? $row['BILLTRANS_ID'] : null;
        } else {
            $val = $this->BILLTRANS_ID->OldValue !== null ? $this->BILLTRANS_ID->OldValue : $this->BILLTRANS_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@BILLTRANS_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("BillingInvoiceList");
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
        if ($pageName == "BillingInvoiceView") {
            return $Language->phrase("View");
        } elseif ($pageName == "BillingInvoiceEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "BillingInvoiceAdd") {
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
                return "BillingInvoiceView";
            case Config("API_ADD_ACTION"):
                return "BillingInvoiceAdd";
            case Config("API_EDIT_ACTION"):
                return "BillingInvoiceEdit";
            case Config("API_DELETE_ACTION"):
                return "BillingInvoiceDelete";
            case Config("API_LIST_ACTION"):
                return "BillingInvoiceList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "BillingInvoiceList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("BillingInvoiceView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("BillingInvoiceView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "BillingInvoiceAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "BillingInvoiceAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("BillingInvoiceEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("BillingInvoiceAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("BillingInvoiceDelete", $this->getUrlParm());
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
        $json .= ",BILLTRANS_ID:" . JsonEncode($this->BILLTRANS_ID->CurrentValue, "string");
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
        if ($this->BILLTRANS_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BILLTRANS_ID->CurrentValue);
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
            if (($keyValue = Param("BILLTRANS_ID") ?? Route("BILLTRANS_ID")) !== null) {
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
                $this->BILLTRANS_ID->CurrentValue = $key[1];
            } else {
                $this->BILLTRANS_ID->OldValue = $key[1];
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
        $this->BILLTRANS_ID->setDbValue($row['BILLTRANS_ID']);
        $this->INVOICE_ID->setDbValue($row['INVOICE_ID']);
        $this->VISIT_DATE->setDbValue($row['VISIT_DATE']);
        $this->ATAS_NAMA->setDbValue($row['ATAS_NAMA']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->THEADDRESS->setDbValue($row['THEADDRESS']);
        $this->THEAGE->setDbValue($row['THEAGE']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->PASIEN_ID->setDbValue($row['PASIEN_ID']);
        $this->FAMILY_STATUS_ID->setDbValue($row['FAMILY_STATUS_ID']);
        $this->DIAGNOSA_ID->setDbValue($row['DIAGNOSA_ID']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->REALNAMA->setDbValue($row['REALNAMA']);
        $this->REALNO->setDbValue($row['REALNO']);
        $this->REALADDRESS->setDbValue($row['REALADDRESS']);
        $this->REALSTATUS->setDbValue($row['REALSTATUS']);
        $this->REALAGE->setDbValue($row['REALAGE']);
        $this->ISVALID->setDbValue($row['ISVALID']);
        $this->VALID_DATE->setDbValue($row['VALID_DATE']);
        $this->VALIDATED_BY->setDbValue($row['VALIDATED_BY']);
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

        // BILLTRANS_ID

        // INVOICE_ID

        // VISIT_DATE

        // ATAS_NAMA

        // NO_REGISTRATION

        // THEADDRESS

        // THEAGE

        // STATUS_PASIEN_ID

        // PASIEN_ID

        // FAMILY_STATUS_ID

        // DIAGNOSA_ID

        // DESCRIPTION

        // PRINT_DATE

        // REALNAMA

        // REALNO

        // REALADDRESS

        // REALSTATUS

        // REALAGE

        // ISVALID

        // VALID_DATE

        // VALIDATED_BY

        // MODIFIED_DATE

        // MODIFIED_BY

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // BILLTRANS_ID
        $this->BILLTRANS_ID->ViewValue = $this->BILLTRANS_ID->CurrentValue;
        $this->BILLTRANS_ID->ViewCustomAttributes = "";

        // INVOICE_ID
        $this->INVOICE_ID->ViewValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->ViewCustomAttributes = "";

        // VISIT_DATE
        $this->VISIT_DATE->ViewValue = $this->VISIT_DATE->CurrentValue;
        $this->VISIT_DATE->ViewValue = FormatDateTime($this->VISIT_DATE->ViewValue, 0);
        $this->VISIT_DATE->ViewCustomAttributes = "";

        // ATAS_NAMA
        $this->ATAS_NAMA->ViewValue = $this->ATAS_NAMA->CurrentValue;
        $this->ATAS_NAMA->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // THEADDRESS
        $this->THEADDRESS->ViewValue = $this->THEADDRESS->CurrentValue;
        $this->THEADDRESS->ViewCustomAttributes = "";

        // THEAGE
        $this->THEAGE->ViewValue = $this->THEAGE->CurrentValue;
        $this->THEAGE->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // PASIEN_ID
        $this->PASIEN_ID->ViewValue = $this->PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->ViewCustomAttributes = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->ViewValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->ViewValue = FormatNumber($this->FAMILY_STATUS_ID->ViewValue, 0, -2, -2, -2);
        $this->FAMILY_STATUS_ID->ViewCustomAttributes = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->ViewValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // PRINT_DATE
        $this->PRINT_DATE->ViewValue = $this->PRINT_DATE->CurrentValue;
        $this->PRINT_DATE->ViewValue = FormatDateTime($this->PRINT_DATE->ViewValue, 0);
        $this->PRINT_DATE->ViewCustomAttributes = "";

        // REALNAMA
        $this->REALNAMA->ViewValue = $this->REALNAMA->CurrentValue;
        $this->REALNAMA->ViewCustomAttributes = "";

        // REALNO
        $this->REALNO->ViewValue = $this->REALNO->CurrentValue;
        $this->REALNO->ViewCustomAttributes = "";

        // REALADDRESS
        $this->REALADDRESS->ViewValue = $this->REALADDRESS->CurrentValue;
        $this->REALADDRESS->ViewCustomAttributes = "";

        // REALSTATUS
        $this->REALSTATUS->ViewValue = $this->REALSTATUS->CurrentValue;
        $this->REALSTATUS->ViewValue = FormatNumber($this->REALSTATUS->ViewValue, 0, -2, -2, -2);
        $this->REALSTATUS->ViewCustomAttributes = "";

        // REALAGE
        $this->REALAGE->ViewValue = $this->REALAGE->CurrentValue;
        $this->REALAGE->ViewCustomAttributes = "";

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

        // BILLTRANS_ID
        $this->BILLTRANS_ID->LinkCustomAttributes = "";
        $this->BILLTRANS_ID->HrefValue = "";
        $this->BILLTRANS_ID->TooltipValue = "";

        // INVOICE_ID
        $this->INVOICE_ID->LinkCustomAttributes = "";
        $this->INVOICE_ID->HrefValue = "";
        $this->INVOICE_ID->TooltipValue = "";

        // VISIT_DATE
        $this->VISIT_DATE->LinkCustomAttributes = "";
        $this->VISIT_DATE->HrefValue = "";
        $this->VISIT_DATE->TooltipValue = "";

        // ATAS_NAMA
        $this->ATAS_NAMA->LinkCustomAttributes = "";
        $this->ATAS_NAMA->HrefValue = "";
        $this->ATAS_NAMA->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // THEADDRESS
        $this->THEADDRESS->LinkCustomAttributes = "";
        $this->THEADDRESS->HrefValue = "";
        $this->THEADDRESS->TooltipValue = "";

        // THEAGE
        $this->THEAGE->LinkCustomAttributes = "";
        $this->THEAGE->HrefValue = "";
        $this->THEAGE->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // PASIEN_ID
        $this->PASIEN_ID->LinkCustomAttributes = "";
        $this->PASIEN_ID->HrefValue = "";
        $this->PASIEN_ID->TooltipValue = "";

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->LinkCustomAttributes = "";
        $this->FAMILY_STATUS_ID->HrefValue = "";
        $this->FAMILY_STATUS_ID->TooltipValue = "";

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->LinkCustomAttributes = "";
        $this->DIAGNOSA_ID->HrefValue = "";
        $this->DIAGNOSA_ID->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // PRINT_DATE
        $this->PRINT_DATE->LinkCustomAttributes = "";
        $this->PRINT_DATE->HrefValue = "";
        $this->PRINT_DATE->TooltipValue = "";

        // REALNAMA
        $this->REALNAMA->LinkCustomAttributes = "";
        $this->REALNAMA->HrefValue = "";
        $this->REALNAMA->TooltipValue = "";

        // REALNO
        $this->REALNO->LinkCustomAttributes = "";
        $this->REALNO->HrefValue = "";
        $this->REALNO->TooltipValue = "";

        // REALADDRESS
        $this->REALADDRESS->LinkCustomAttributes = "";
        $this->REALADDRESS->HrefValue = "";
        $this->REALADDRESS->TooltipValue = "";

        // REALSTATUS
        $this->REALSTATUS->LinkCustomAttributes = "";
        $this->REALSTATUS->HrefValue = "";
        $this->REALSTATUS->TooltipValue = "";

        // REALAGE
        $this->REALAGE->LinkCustomAttributes = "";
        $this->REALAGE->HrefValue = "";
        $this->REALAGE->TooltipValue = "";

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

        // BILLTRANS_ID
        $this->BILLTRANS_ID->EditAttrs["class"] = "form-control";
        $this->BILLTRANS_ID->EditCustomAttributes = "";
        if (!$this->BILLTRANS_ID->Raw) {
            $this->BILLTRANS_ID->CurrentValue = HtmlDecode($this->BILLTRANS_ID->CurrentValue);
        }
        $this->BILLTRANS_ID->EditValue = $this->BILLTRANS_ID->CurrentValue;
        $this->BILLTRANS_ID->PlaceHolder = RemoveHtml($this->BILLTRANS_ID->caption());

        // INVOICE_ID
        $this->INVOICE_ID->EditAttrs["class"] = "form-control";
        $this->INVOICE_ID->EditCustomAttributes = "";
        if (!$this->INVOICE_ID->Raw) {
            $this->INVOICE_ID->CurrentValue = HtmlDecode($this->INVOICE_ID->CurrentValue);
        }
        $this->INVOICE_ID->EditValue = $this->INVOICE_ID->CurrentValue;
        $this->INVOICE_ID->PlaceHolder = RemoveHtml($this->INVOICE_ID->caption());

        // VISIT_DATE
        $this->VISIT_DATE->EditAttrs["class"] = "form-control";
        $this->VISIT_DATE->EditCustomAttributes = "";
        $this->VISIT_DATE->EditValue = FormatDateTime($this->VISIT_DATE->CurrentValue, 8);
        $this->VISIT_DATE->PlaceHolder = RemoveHtml($this->VISIT_DATE->caption());

        // ATAS_NAMA
        $this->ATAS_NAMA->EditAttrs["class"] = "form-control";
        $this->ATAS_NAMA->EditCustomAttributes = "";
        if (!$this->ATAS_NAMA->Raw) {
            $this->ATAS_NAMA->CurrentValue = HtmlDecode($this->ATAS_NAMA->CurrentValue);
        }
        $this->ATAS_NAMA->EditValue = $this->ATAS_NAMA->CurrentValue;
        $this->ATAS_NAMA->PlaceHolder = RemoveHtml($this->ATAS_NAMA->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // THEADDRESS
        $this->THEADDRESS->EditAttrs["class"] = "form-control";
        $this->THEADDRESS->EditCustomAttributes = "";
        if (!$this->THEADDRESS->Raw) {
            $this->THEADDRESS->CurrentValue = HtmlDecode($this->THEADDRESS->CurrentValue);
        }
        $this->THEADDRESS->EditValue = $this->THEADDRESS->CurrentValue;
        $this->THEADDRESS->PlaceHolder = RemoveHtml($this->THEADDRESS->caption());

        // THEAGE
        $this->THEAGE->EditAttrs["class"] = "form-control";
        $this->THEAGE->EditCustomAttributes = "";
        if (!$this->THEAGE->Raw) {
            $this->THEAGE->CurrentValue = HtmlDecode($this->THEAGE->CurrentValue);
        }
        $this->THEAGE->EditValue = $this->THEAGE->CurrentValue;
        $this->THEAGE->PlaceHolder = RemoveHtml($this->THEAGE->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // PASIEN_ID
        $this->PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->PASIEN_ID->EditCustomAttributes = "";
        if (!$this->PASIEN_ID->Raw) {
            $this->PASIEN_ID->CurrentValue = HtmlDecode($this->PASIEN_ID->CurrentValue);
        }
        $this->PASIEN_ID->EditValue = $this->PASIEN_ID->CurrentValue;
        $this->PASIEN_ID->PlaceHolder = RemoveHtml($this->PASIEN_ID->caption());

        // FAMILY_STATUS_ID
        $this->FAMILY_STATUS_ID->EditAttrs["class"] = "form-control";
        $this->FAMILY_STATUS_ID->EditCustomAttributes = "";
        $this->FAMILY_STATUS_ID->EditValue = $this->FAMILY_STATUS_ID->CurrentValue;
        $this->FAMILY_STATUS_ID->PlaceHolder = RemoveHtml($this->FAMILY_STATUS_ID->caption());

        // DIAGNOSA_ID
        $this->DIAGNOSA_ID->EditAttrs["class"] = "form-control";
        $this->DIAGNOSA_ID->EditCustomAttributes = "";
        if (!$this->DIAGNOSA_ID->Raw) {
            $this->DIAGNOSA_ID->CurrentValue = HtmlDecode($this->DIAGNOSA_ID->CurrentValue);
        }
        $this->DIAGNOSA_ID->EditValue = $this->DIAGNOSA_ID->CurrentValue;
        $this->DIAGNOSA_ID->PlaceHolder = RemoveHtml($this->DIAGNOSA_ID->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // PRINT_DATE
        $this->PRINT_DATE->EditAttrs["class"] = "form-control";
        $this->PRINT_DATE->EditCustomAttributes = "";
        $this->PRINT_DATE->EditValue = FormatDateTime($this->PRINT_DATE->CurrentValue, 8);
        $this->PRINT_DATE->PlaceHolder = RemoveHtml($this->PRINT_DATE->caption());

        // REALNAMA
        $this->REALNAMA->EditAttrs["class"] = "form-control";
        $this->REALNAMA->EditCustomAttributes = "";
        if (!$this->REALNAMA->Raw) {
            $this->REALNAMA->CurrentValue = HtmlDecode($this->REALNAMA->CurrentValue);
        }
        $this->REALNAMA->EditValue = $this->REALNAMA->CurrentValue;
        $this->REALNAMA->PlaceHolder = RemoveHtml($this->REALNAMA->caption());

        // REALNO
        $this->REALNO->EditAttrs["class"] = "form-control";
        $this->REALNO->EditCustomAttributes = "";
        if (!$this->REALNO->Raw) {
            $this->REALNO->CurrentValue = HtmlDecode($this->REALNO->CurrentValue);
        }
        $this->REALNO->EditValue = $this->REALNO->CurrentValue;
        $this->REALNO->PlaceHolder = RemoveHtml($this->REALNO->caption());

        // REALADDRESS
        $this->REALADDRESS->EditAttrs["class"] = "form-control";
        $this->REALADDRESS->EditCustomAttributes = "";
        if (!$this->REALADDRESS->Raw) {
            $this->REALADDRESS->CurrentValue = HtmlDecode($this->REALADDRESS->CurrentValue);
        }
        $this->REALADDRESS->EditValue = $this->REALADDRESS->CurrentValue;
        $this->REALADDRESS->PlaceHolder = RemoveHtml($this->REALADDRESS->caption());

        // REALSTATUS
        $this->REALSTATUS->EditAttrs["class"] = "form-control";
        $this->REALSTATUS->EditCustomAttributes = "";
        $this->REALSTATUS->EditValue = $this->REALSTATUS->CurrentValue;
        $this->REALSTATUS->PlaceHolder = RemoveHtml($this->REALSTATUS->caption());

        // REALAGE
        $this->REALAGE->EditAttrs["class"] = "form-control";
        $this->REALAGE->EditCustomAttributes = "";
        if (!$this->REALAGE->Raw) {
            $this->REALAGE->CurrentValue = HtmlDecode($this->REALAGE->CurrentValue);
        }
        $this->REALAGE->EditValue = $this->REALAGE->CurrentValue;
        $this->REALAGE->PlaceHolder = RemoveHtml($this->REALAGE->caption());

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
                    $doc->exportCaption($this->BILLTRANS_ID);
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->VISIT_DATE);
                    $doc->exportCaption($this->ATAS_NAMA);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEAGE);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->PASIEN_ID);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->REALNAMA);
                    $doc->exportCaption($this->REALNO);
                    $doc->exportCaption($this->REALADDRESS);
                    $doc->exportCaption($this->REALSTATUS);
                    $doc->exportCaption($this->REALAGE);
                    $doc->exportCaption($this->ISVALID);
                    $doc->exportCaption($this->VALID_DATE);
                    $doc->exportCaption($this->VALIDATED_BY);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->BILLTRANS_ID);
                    $doc->exportCaption($this->INVOICE_ID);
                    $doc->exportCaption($this->VISIT_DATE);
                    $doc->exportCaption($this->ATAS_NAMA);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->THEADDRESS);
                    $doc->exportCaption($this->THEAGE);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->PASIEN_ID);
                    $doc->exportCaption($this->FAMILY_STATUS_ID);
                    $doc->exportCaption($this->DIAGNOSA_ID);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->REALNAMA);
                    $doc->exportCaption($this->REALNO);
                    $doc->exportCaption($this->REALADDRESS);
                    $doc->exportCaption($this->REALSTATUS);
                    $doc->exportCaption($this->REALAGE);
                    $doc->exportCaption($this->ISVALID);
                    $doc->exportCaption($this->VALID_DATE);
                    $doc->exportCaption($this->VALIDATED_BY);
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
                        $doc->exportField($this->BILLTRANS_ID);
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->VISIT_DATE);
                        $doc->exportField($this->ATAS_NAMA);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEAGE);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->PASIEN_ID);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->REALNAMA);
                        $doc->exportField($this->REALNO);
                        $doc->exportField($this->REALADDRESS);
                        $doc->exportField($this->REALSTATUS);
                        $doc->exportField($this->REALAGE);
                        $doc->exportField($this->ISVALID);
                        $doc->exportField($this->VALID_DATE);
                        $doc->exportField($this->VALIDATED_BY);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->BILLTRANS_ID);
                        $doc->exportField($this->INVOICE_ID);
                        $doc->exportField($this->VISIT_DATE);
                        $doc->exportField($this->ATAS_NAMA);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->THEADDRESS);
                        $doc->exportField($this->THEAGE);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->PASIEN_ID);
                        $doc->exportField($this->FAMILY_STATUS_ID);
                        $doc->exportField($this->DIAGNOSA_ID);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->REALNAMA);
                        $doc->exportField($this->REALNO);
                        $doc->exportField($this->REALADDRESS);
                        $doc->exportField($this->REALSTATUS);
                        $doc->exportField($this->REALAGE);
                        $doc->exportField($this->ISVALID);
                        $doc->exportField($this->VALID_DATE);
                        $doc->exportField($this->VALIDATED_BY);
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
