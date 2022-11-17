<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for gsa_backup
 */
class GsaBackup extends DbTable
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
    public $ITEM_ID;
    public $ROOMS_ID;
    public $ALLOCATED_DATE;
    public $BRAND_ID;
    public $BATCH_NO;
    public $BRAND_NAME;
    public $MEASURE_ID;
    public $PRICE;
    public $AVGPRICE;
    public $EXPIRY_DATE;
    public $DISTRIBUTION_TYPE;
    public $MONTH_ID;
    public $YEAR_ID;
    public $STOCK_OPNAME;
    public $STOK_AWAL;
    public $STOCK_LALU;
    public $STOCK_KOREKSI;
    public $DESCRIPTION;
    public $ISCETAK;
    public $PRINTQ;
    public $PRINTED_BY;
    public $PRINT_DATE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $IDX;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'gsa_backup';
        $this->TableName = 'gsa_backup';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[gsa_backup]";
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
        $this->ORG_UNIT_CODE = new DbField('gsa_backup', 'gsa_backup', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // ITEM_ID
        $this->ITEM_ID = new DbField('gsa_backup', 'gsa_backup', 'x_ITEM_ID', 'ITEM_ID', '[ITEM_ID]', '[ITEM_ID]', 200, 50, -1, false, '[ITEM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ITEM_ID->Nullable = false; // NOT NULL field
        $this->ITEM_ID->Required = true; // Required field
        $this->ITEM_ID->Sortable = true; // Allow sort
        $this->ITEM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ITEM_ID->Param, "CustomMsg");
        $this->Fields['ITEM_ID'] = &$this->ITEM_ID;

        // ROOMS_ID
        $this->ROOMS_ID = new DbField('gsa_backup', 'gsa_backup', 'x_ROOMS_ID', 'ROOMS_ID', '[ROOMS_ID]', '[ROOMS_ID]', 200, 10, -1, false, '[ROOMS_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ROOMS_ID->Nullable = false; // NOT NULL field
        $this->ROOMS_ID->Required = true; // Required field
        $this->ROOMS_ID->Sortable = true; // Allow sort
        $this->ROOMS_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ROOMS_ID->Param, "CustomMsg");
        $this->Fields['ROOMS_ID'] = &$this->ROOMS_ID;

        // ALLOCATED_DATE
        $this->ALLOCATED_DATE = new DbField('gsa_backup', 'gsa_backup', 'x_ALLOCATED_DATE', 'ALLOCATED_DATE', '[ALLOCATED_DATE]', CastDateFieldForLike("[ALLOCATED_DATE]", 0, "DB"), 135, 8, 0, false, '[ALLOCATED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ALLOCATED_DATE->Nullable = false; // NOT NULL field
        $this->ALLOCATED_DATE->Required = true; // Required field
        $this->ALLOCATED_DATE->Sortable = true; // Allow sort
        $this->ALLOCATED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->ALLOCATED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ALLOCATED_DATE->Param, "CustomMsg");
        $this->Fields['ALLOCATED_DATE'] = &$this->ALLOCATED_DATE;

        // BRAND_ID
        $this->BRAND_ID = new DbField('gsa_backup', 'gsa_backup', 'x_BRAND_ID', 'BRAND_ID', '[BRAND_ID]', '[BRAND_ID]', 200, 50, -1, false, '[BRAND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_ID->Nullable = false; // NOT NULL field
        $this->BRAND_ID->Required = true; // Required field
        $this->BRAND_ID->Sortable = true; // Allow sort
        $this->BRAND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_ID->Param, "CustomMsg");
        $this->Fields['BRAND_ID'] = &$this->BRAND_ID;

        // BATCH_NO
        $this->BATCH_NO = new DbField('gsa_backup', 'gsa_backup', 'x_BATCH_NO', 'BATCH_NO', '[BATCH_NO]', '[BATCH_NO]', 200, 50, -1, false, '[BATCH_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BATCH_NO->Nullable = false; // NOT NULL field
        $this->BATCH_NO->Required = true; // Required field
        $this->BATCH_NO->Sortable = true; // Allow sort
        $this->BATCH_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BATCH_NO->Param, "CustomMsg");
        $this->Fields['BATCH_NO'] = &$this->BATCH_NO;

        // BRAND_NAME
        $this->BRAND_NAME = new DbField('gsa_backup', 'gsa_backup', 'x_BRAND_NAME', 'BRAND_NAME', '[BRAND_NAME]', '[BRAND_NAME]', 200, 150, -1, false, '[BRAND_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_NAME->Nullable = false; // NOT NULL field
        $this->BRAND_NAME->Required = true; // Required field
        $this->BRAND_NAME->Sortable = true; // Allow sort
        $this->BRAND_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_NAME->Param, "CustomMsg");
        $this->Fields['BRAND_NAME'] = &$this->BRAND_NAME;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('gsa_backup', 'gsa_backup', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // PRICE
        $this->PRICE = new DbField('gsa_backup', 'gsa_backup', 'x_PRICE', 'PRICE', '[PRICE]', 'CAST([PRICE] AS NVARCHAR)', 6, 8, -1, false, '[PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRICE->Sortable = true; // Allow sort
        $this->PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRICE->Param, "CustomMsg");
        $this->Fields['PRICE'] = &$this->PRICE;

        // AVGPRICE
        $this->AVGPRICE = new DbField('gsa_backup', 'gsa_backup', 'x_AVGPRICE', 'AVGPRICE', '[AVGPRICE]', 'CAST([AVGPRICE] AS NVARCHAR)', 6, 8, -1, false, '[AVGPRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AVGPRICE->Sortable = true; // Allow sort
        $this->AVGPRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AVGPRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AVGPRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AVGPRICE->Param, "CustomMsg");
        $this->Fields['AVGPRICE'] = &$this->AVGPRICE;

        // EXPIRY_DATE
        $this->EXPIRY_DATE = new DbField('gsa_backup', 'gsa_backup', 'x_EXPIRY_DATE', 'EXPIRY_DATE', '[EXPIRY_DATE]', CastDateFieldForLike("[EXPIRY_DATE]", 0, "DB"), 135, 8, 0, false, '[EXPIRY_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EXPIRY_DATE->Sortable = true; // Allow sort
        $this->EXPIRY_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->EXPIRY_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EXPIRY_DATE->Param, "CustomMsg");
        $this->Fields['EXPIRY_DATE'] = &$this->EXPIRY_DATE;

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE = new DbField('gsa_backup', 'gsa_backup', 'x_DISTRIBUTION_TYPE', 'DISTRIBUTION_TYPE', '[DISTRIBUTION_TYPE]', 'CAST([DISTRIBUTION_TYPE] AS NVARCHAR)', 2, 2, -1, false, '[DISTRIBUTION_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DISTRIBUTION_TYPE->Sortable = true; // Allow sort
        $this->DISTRIBUTION_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->DISTRIBUTION_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DISTRIBUTION_TYPE->Param, "CustomMsg");
        $this->Fields['DISTRIBUTION_TYPE'] = &$this->DISTRIBUTION_TYPE;

        // MONTH_ID
        $this->MONTH_ID = new DbField('gsa_backup', 'gsa_backup', 'x_MONTH_ID', 'MONTH_ID', '[MONTH_ID]', 'CAST([MONTH_ID] AS NVARCHAR)', 17, 1, -1, false, '[MONTH_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MONTH_ID->Sortable = true; // Allow sort
        $this->MONTH_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MONTH_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MONTH_ID->Param, "CustomMsg");
        $this->Fields['MONTH_ID'] = &$this->MONTH_ID;

        // YEAR_ID
        $this->YEAR_ID = new DbField('gsa_backup', 'gsa_backup', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // STOCK_OPNAME
        $this->STOCK_OPNAME = new DbField('gsa_backup', 'gsa_backup', 'x_STOCK_OPNAME', 'STOCK_OPNAME', '[STOCK_OPNAME]', 'CAST([STOCK_OPNAME] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_OPNAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_OPNAME->Sortable = true; // Allow sort
        $this->STOCK_OPNAME->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_OPNAME->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_OPNAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_OPNAME->Param, "CustomMsg");
        $this->Fields['STOCK_OPNAME'] = &$this->STOCK_OPNAME;

        // STOK_AWAL
        $this->STOK_AWAL = new DbField('gsa_backup', 'gsa_backup', 'x_STOK_AWAL', 'STOK_AWAL', '[STOK_AWAL]', 'CAST([STOK_AWAL] AS NVARCHAR)', 131, 8, -1, false, '[STOK_AWAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOK_AWAL->Sortable = true; // Allow sort
        $this->STOK_AWAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOK_AWAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOK_AWAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOK_AWAL->Param, "CustomMsg");
        $this->Fields['STOK_AWAL'] = &$this->STOK_AWAL;

        // STOCK_LALU
        $this->STOCK_LALU = new DbField('gsa_backup', 'gsa_backup', 'x_STOCK_LALU', 'STOCK_LALU', '[STOCK_LALU]', 'CAST([STOCK_LALU] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_LALU]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_LALU->Sortable = true; // Allow sort
        $this->STOCK_LALU->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_LALU->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_LALU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_LALU->Param, "CustomMsg");
        $this->Fields['STOCK_LALU'] = &$this->STOCK_LALU;

        // STOCK_KOREKSI
        $this->STOCK_KOREKSI = new DbField('gsa_backup', 'gsa_backup', 'x_STOCK_KOREKSI', 'STOCK_KOREKSI', '[STOCK_KOREKSI]', 'CAST([STOCK_KOREKSI] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_KOREKSI]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_KOREKSI->Sortable = true; // Allow sort
        $this->STOCK_KOREKSI->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_KOREKSI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_KOREKSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_KOREKSI->Param, "CustomMsg");
        $this->Fields['STOCK_KOREKSI'] = &$this->STOCK_KOREKSI;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('gsa_backup', 'gsa_backup', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 150, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // ISCETAK
        $this->ISCETAK = new DbField('gsa_backup', 'gsa_backup', 'x_ISCETAK', 'ISCETAK', '[ISCETAK]', '[ISCETAK]', 129, 1, -1, false, '[ISCETAK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISCETAK->Sortable = true; // Allow sort
        $this->ISCETAK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISCETAK->Param, "CustomMsg");
        $this->Fields['ISCETAK'] = &$this->ISCETAK;

        // PRINTQ
        $this->PRINTQ = new DbField('gsa_backup', 'gsa_backup', 'x_PRINTQ', 'PRINTQ', '[PRINTQ]', 'CAST([PRINTQ] AS NVARCHAR)', 17, 1, -1, false, '[PRINTQ]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTQ->Sortable = true; // Allow sort
        $this->PRINTQ->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->PRINTQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTQ->Param, "CustomMsg");
        $this->Fields['PRINTQ'] = &$this->PRINTQ;

        // PRINTED_BY
        $this->PRINTED_BY = new DbField('gsa_backup', 'gsa_backup', 'x_PRINTED_BY', 'PRINTED_BY', '[PRINTED_BY]', '[PRINTED_BY]', 200, 50, -1, false, '[PRINTED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINTED_BY->Sortable = true; // Allow sort
        $this->PRINTED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINTED_BY->Param, "CustomMsg");
        $this->Fields['PRINTED_BY'] = &$this->PRINTED_BY;

        // PRINT_DATE
        $this->PRINT_DATE = new DbField('gsa_backup', 'gsa_backup', 'x_PRINT_DATE', 'PRINT_DATE', '[PRINT_DATE]', CastDateFieldForLike("[PRINT_DATE]", 0, "DB"), 135, 8, 0, false, '[PRINT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PRINT_DATE->Sortable = true; // Allow sort
        $this->PRINT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PRINT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PRINT_DATE->Param, "CustomMsg");
        $this->Fields['PRINT_DATE'] = &$this->PRINT_DATE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('gsa_backup', 'gsa_backup', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('gsa_backup', 'gsa_backup', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // IDX
        $this->IDX = new DbField('gsa_backup', 'gsa_backup', 'x_IDX', 'IDX', '[IDX]', 'CAST([IDX] AS NVARCHAR)', 3, 4, -1, false, '[IDX]', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->IDX->IsAutoIncrement = true; // Autoincrement field
        $this->IDX->Nullable = false; // NOT NULL field
        $this->IDX->Sortable = true; // Allow sort
        $this->IDX->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->IDX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->IDX->Param, "CustomMsg");
        $this->Fields['IDX'] = &$this->IDX;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[gsa_backup]";
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
            // Get insert id if necessary
            $this->IDX->setDbValue($conn->lastInsertId());
            $rs['IDX'] = $this->IDX->DbValue;
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
        $this->ITEM_ID->DbValue = $row['ITEM_ID'];
        $this->ROOMS_ID->DbValue = $row['ROOMS_ID'];
        $this->ALLOCATED_DATE->DbValue = $row['ALLOCATED_DATE'];
        $this->BRAND_ID->DbValue = $row['BRAND_ID'];
        $this->BATCH_NO->DbValue = $row['BATCH_NO'];
        $this->BRAND_NAME->DbValue = $row['BRAND_NAME'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->PRICE->DbValue = $row['PRICE'];
        $this->AVGPRICE->DbValue = $row['AVGPRICE'];
        $this->EXPIRY_DATE->DbValue = $row['EXPIRY_DATE'];
        $this->DISTRIBUTION_TYPE->DbValue = $row['DISTRIBUTION_TYPE'];
        $this->MONTH_ID->DbValue = $row['MONTH_ID'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->STOCK_OPNAME->DbValue = $row['STOCK_OPNAME'];
        $this->STOK_AWAL->DbValue = $row['STOK_AWAL'];
        $this->STOCK_LALU->DbValue = $row['STOCK_LALU'];
        $this->STOCK_KOREKSI->DbValue = $row['STOCK_KOREKSI'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->ISCETAK->DbValue = $row['ISCETAK'];
        $this->PRINTQ->DbValue = $row['PRINTQ'];
        $this->PRINTED_BY->DbValue = $row['PRINTED_BY'];
        $this->PRINT_DATE->DbValue = $row['PRINT_DATE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->IDX->DbValue = $row['IDX'];
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
        return $_SESSION[$name] ?? GetUrl("GsaBackupList");
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
        if ($pageName == "GsaBackupView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GsaBackupEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GsaBackupAdd") {
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
                return "GsaBackupView";
            case Config("API_ADD_ACTION"):
                return "GsaBackupAdd";
            case Config("API_EDIT_ACTION"):
                return "GsaBackupEdit";
            case Config("API_DELETE_ACTION"):
                return "GsaBackupDelete";
            case Config("API_LIST_ACTION"):
                return "GsaBackupList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GsaBackupList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GsaBackupView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GsaBackupView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GsaBackupAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GsaBackupAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GsaBackupEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("GsaBackupAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("GsaBackupDelete", $this->getUrlParm());
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
        $this->ITEM_ID->setDbValue($row['ITEM_ID']);
        $this->ROOMS_ID->setDbValue($row['ROOMS_ID']);
        $this->ALLOCATED_DATE->setDbValue($row['ALLOCATED_DATE']);
        $this->BRAND_ID->setDbValue($row['BRAND_ID']);
        $this->BATCH_NO->setDbValue($row['BATCH_NO']);
        $this->BRAND_NAME->setDbValue($row['BRAND_NAME']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->PRICE->setDbValue($row['PRICE']);
        $this->AVGPRICE->setDbValue($row['AVGPRICE']);
        $this->EXPIRY_DATE->setDbValue($row['EXPIRY_DATE']);
        $this->DISTRIBUTION_TYPE->setDbValue($row['DISTRIBUTION_TYPE']);
        $this->MONTH_ID->setDbValue($row['MONTH_ID']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->STOCK_OPNAME->setDbValue($row['STOCK_OPNAME']);
        $this->STOK_AWAL->setDbValue($row['STOK_AWAL']);
        $this->STOCK_LALU->setDbValue($row['STOCK_LALU']);
        $this->STOCK_KOREKSI->setDbValue($row['STOCK_KOREKSI']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->ISCETAK->setDbValue($row['ISCETAK']);
        $this->PRINTQ->setDbValue($row['PRINTQ']);
        $this->PRINTED_BY->setDbValue($row['PRINTED_BY']);
        $this->PRINT_DATE->setDbValue($row['PRINT_DATE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->IDX->setDbValue($row['IDX']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // ITEM_ID

        // ROOMS_ID

        // ALLOCATED_DATE

        // BRAND_ID

        // BATCH_NO

        // BRAND_NAME

        // MEASURE_ID

        // PRICE

        // AVGPRICE

        // EXPIRY_DATE

        // DISTRIBUTION_TYPE

        // MONTH_ID

        // YEAR_ID

        // STOCK_OPNAME

        // STOK_AWAL

        // STOCK_LALU

        // STOCK_KOREKSI

        // DESCRIPTION

        // ISCETAK

        // PRINTQ

        // PRINTED_BY

        // PRINT_DATE

        // MODIFIED_DATE

        // MODIFIED_BY

        // IDX

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // ITEM_ID
        $this->ITEM_ID->ViewValue = $this->ITEM_ID->CurrentValue;
        $this->ITEM_ID->ViewCustomAttributes = "";

        // ROOMS_ID
        $this->ROOMS_ID->ViewValue = $this->ROOMS_ID->CurrentValue;
        $this->ROOMS_ID->ViewCustomAttributes = "";

        // ALLOCATED_DATE
        $this->ALLOCATED_DATE->ViewValue = $this->ALLOCATED_DATE->CurrentValue;
        $this->ALLOCATED_DATE->ViewValue = FormatDateTime($this->ALLOCATED_DATE->ViewValue, 0);
        $this->ALLOCATED_DATE->ViewCustomAttributes = "";

        // BRAND_ID
        $this->BRAND_ID->ViewValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->ViewCustomAttributes = "";

        // BATCH_NO
        $this->BATCH_NO->ViewValue = $this->BATCH_NO->CurrentValue;
        $this->BATCH_NO->ViewCustomAttributes = "";

        // BRAND_NAME
        $this->BRAND_NAME->ViewValue = $this->BRAND_NAME->CurrentValue;
        $this->BRAND_NAME->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // PRICE
        $this->PRICE->ViewValue = $this->PRICE->CurrentValue;
        $this->PRICE->ViewValue = FormatNumber($this->PRICE->ViewValue, 2, -2, -2, -2);
        $this->PRICE->ViewCustomAttributes = "";

        // AVGPRICE
        $this->AVGPRICE->ViewValue = $this->AVGPRICE->CurrentValue;
        $this->AVGPRICE->ViewValue = FormatNumber($this->AVGPRICE->ViewValue, 2, -2, -2, -2);
        $this->AVGPRICE->ViewCustomAttributes = "";

        // EXPIRY_DATE
        $this->EXPIRY_DATE->ViewValue = $this->EXPIRY_DATE->CurrentValue;
        $this->EXPIRY_DATE->ViewValue = FormatDateTime($this->EXPIRY_DATE->ViewValue, 0);
        $this->EXPIRY_DATE->ViewCustomAttributes = "";

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->ViewValue = $this->DISTRIBUTION_TYPE->CurrentValue;
        $this->DISTRIBUTION_TYPE->ViewValue = FormatNumber($this->DISTRIBUTION_TYPE->ViewValue, 0, -2, -2, -2);
        $this->DISTRIBUTION_TYPE->ViewCustomAttributes = "";

        // MONTH_ID
        $this->MONTH_ID->ViewValue = $this->MONTH_ID->CurrentValue;
        $this->MONTH_ID->ViewValue = FormatNumber($this->MONTH_ID->ViewValue, 0, -2, -2, -2);
        $this->MONTH_ID->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // STOCK_OPNAME
        $this->STOCK_OPNAME->ViewValue = $this->STOCK_OPNAME->CurrentValue;
        $this->STOCK_OPNAME->ViewValue = FormatNumber($this->STOCK_OPNAME->ViewValue, 2, -2, -2, -2);
        $this->STOCK_OPNAME->ViewCustomAttributes = "";

        // STOK_AWAL
        $this->STOK_AWAL->ViewValue = $this->STOK_AWAL->CurrentValue;
        $this->STOK_AWAL->ViewValue = FormatNumber($this->STOK_AWAL->ViewValue, 2, -2, -2, -2);
        $this->STOK_AWAL->ViewCustomAttributes = "";

        // STOCK_LALU
        $this->STOCK_LALU->ViewValue = $this->STOCK_LALU->CurrentValue;
        $this->STOCK_LALU->ViewValue = FormatNumber($this->STOCK_LALU->ViewValue, 2, -2, -2, -2);
        $this->STOCK_LALU->ViewCustomAttributes = "";

        // STOCK_KOREKSI
        $this->STOCK_KOREKSI->ViewValue = $this->STOCK_KOREKSI->CurrentValue;
        $this->STOCK_KOREKSI->ViewValue = FormatNumber($this->STOCK_KOREKSI->ViewValue, 2, -2, -2, -2);
        $this->STOCK_KOREKSI->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // ISCETAK
        $this->ISCETAK->ViewValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->ViewCustomAttributes = "";

        // PRINTQ
        $this->PRINTQ->ViewValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->ViewValue = FormatNumber($this->PRINTQ->ViewValue, 0, -2, -2, -2);
        $this->PRINTQ->ViewCustomAttributes = "";

        // PRINTED_BY
        $this->PRINTED_BY->ViewValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->ViewCustomAttributes = "";

        // PRINT_DATE
        $this->PRINT_DATE->ViewValue = $this->PRINT_DATE->CurrentValue;
        $this->PRINT_DATE->ViewValue = FormatDateTime($this->PRINT_DATE->ViewValue, 0);
        $this->PRINT_DATE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // IDX
        $this->IDX->ViewValue = $this->IDX->CurrentValue;
        $this->IDX->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // ITEM_ID
        $this->ITEM_ID->LinkCustomAttributes = "";
        $this->ITEM_ID->HrefValue = "";
        $this->ITEM_ID->TooltipValue = "";

        // ROOMS_ID
        $this->ROOMS_ID->LinkCustomAttributes = "";
        $this->ROOMS_ID->HrefValue = "";
        $this->ROOMS_ID->TooltipValue = "";

        // ALLOCATED_DATE
        $this->ALLOCATED_DATE->LinkCustomAttributes = "";
        $this->ALLOCATED_DATE->HrefValue = "";
        $this->ALLOCATED_DATE->TooltipValue = "";

        // BRAND_ID
        $this->BRAND_ID->LinkCustomAttributes = "";
        $this->BRAND_ID->HrefValue = "";
        $this->BRAND_ID->TooltipValue = "";

        // BATCH_NO
        $this->BATCH_NO->LinkCustomAttributes = "";
        $this->BATCH_NO->HrefValue = "";
        $this->BATCH_NO->TooltipValue = "";

        // BRAND_NAME
        $this->BRAND_NAME->LinkCustomAttributes = "";
        $this->BRAND_NAME->HrefValue = "";
        $this->BRAND_NAME->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // PRICE
        $this->PRICE->LinkCustomAttributes = "";
        $this->PRICE->HrefValue = "";
        $this->PRICE->TooltipValue = "";

        // AVGPRICE
        $this->AVGPRICE->LinkCustomAttributes = "";
        $this->AVGPRICE->HrefValue = "";
        $this->AVGPRICE->TooltipValue = "";

        // EXPIRY_DATE
        $this->EXPIRY_DATE->LinkCustomAttributes = "";
        $this->EXPIRY_DATE->HrefValue = "";
        $this->EXPIRY_DATE->TooltipValue = "";

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->LinkCustomAttributes = "";
        $this->DISTRIBUTION_TYPE->HrefValue = "";
        $this->DISTRIBUTION_TYPE->TooltipValue = "";

        // MONTH_ID
        $this->MONTH_ID->LinkCustomAttributes = "";
        $this->MONTH_ID->HrefValue = "";
        $this->MONTH_ID->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // STOCK_OPNAME
        $this->STOCK_OPNAME->LinkCustomAttributes = "";
        $this->STOCK_OPNAME->HrefValue = "";
        $this->STOCK_OPNAME->TooltipValue = "";

        // STOK_AWAL
        $this->STOK_AWAL->LinkCustomAttributes = "";
        $this->STOK_AWAL->HrefValue = "";
        $this->STOK_AWAL->TooltipValue = "";

        // STOCK_LALU
        $this->STOCK_LALU->LinkCustomAttributes = "";
        $this->STOCK_LALU->HrefValue = "";
        $this->STOCK_LALU->TooltipValue = "";

        // STOCK_KOREKSI
        $this->STOCK_KOREKSI->LinkCustomAttributes = "";
        $this->STOCK_KOREKSI->HrefValue = "";
        $this->STOCK_KOREKSI->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // ISCETAK
        $this->ISCETAK->LinkCustomAttributes = "";
        $this->ISCETAK->HrefValue = "";
        $this->ISCETAK->TooltipValue = "";

        // PRINTQ
        $this->PRINTQ->LinkCustomAttributes = "";
        $this->PRINTQ->HrefValue = "";
        $this->PRINTQ->TooltipValue = "";

        // PRINTED_BY
        $this->PRINTED_BY->LinkCustomAttributes = "";
        $this->PRINTED_BY->HrefValue = "";
        $this->PRINTED_BY->TooltipValue = "";

        // PRINT_DATE
        $this->PRINT_DATE->LinkCustomAttributes = "";
        $this->PRINT_DATE->HrefValue = "";
        $this->PRINT_DATE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // IDX
        $this->IDX->LinkCustomAttributes = "";
        $this->IDX->HrefValue = "";
        $this->IDX->TooltipValue = "";

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

        // ITEM_ID
        $this->ITEM_ID->EditAttrs["class"] = "form-control";
        $this->ITEM_ID->EditCustomAttributes = "";
        if (!$this->ITEM_ID->Raw) {
            $this->ITEM_ID->CurrentValue = HtmlDecode($this->ITEM_ID->CurrentValue);
        }
        $this->ITEM_ID->EditValue = $this->ITEM_ID->CurrentValue;
        $this->ITEM_ID->PlaceHolder = RemoveHtml($this->ITEM_ID->caption());

        // ROOMS_ID
        $this->ROOMS_ID->EditAttrs["class"] = "form-control";
        $this->ROOMS_ID->EditCustomAttributes = "";
        if (!$this->ROOMS_ID->Raw) {
            $this->ROOMS_ID->CurrentValue = HtmlDecode($this->ROOMS_ID->CurrentValue);
        }
        $this->ROOMS_ID->EditValue = $this->ROOMS_ID->CurrentValue;
        $this->ROOMS_ID->PlaceHolder = RemoveHtml($this->ROOMS_ID->caption());

        // ALLOCATED_DATE
        $this->ALLOCATED_DATE->EditAttrs["class"] = "form-control";
        $this->ALLOCATED_DATE->EditCustomAttributes = "";
        $this->ALLOCATED_DATE->EditValue = FormatDateTime($this->ALLOCATED_DATE->CurrentValue, 8);
        $this->ALLOCATED_DATE->PlaceHolder = RemoveHtml($this->ALLOCATED_DATE->caption());

        // BRAND_ID
        $this->BRAND_ID->EditAttrs["class"] = "form-control";
        $this->BRAND_ID->EditCustomAttributes = "";
        if (!$this->BRAND_ID->Raw) {
            $this->BRAND_ID->CurrentValue = HtmlDecode($this->BRAND_ID->CurrentValue);
        }
        $this->BRAND_ID->EditValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->PlaceHolder = RemoveHtml($this->BRAND_ID->caption());

        // BATCH_NO
        $this->BATCH_NO->EditAttrs["class"] = "form-control";
        $this->BATCH_NO->EditCustomAttributes = "";
        if (!$this->BATCH_NO->Raw) {
            $this->BATCH_NO->CurrentValue = HtmlDecode($this->BATCH_NO->CurrentValue);
        }
        $this->BATCH_NO->EditValue = $this->BATCH_NO->CurrentValue;
        $this->BATCH_NO->PlaceHolder = RemoveHtml($this->BATCH_NO->caption());

        // BRAND_NAME
        $this->BRAND_NAME->EditAttrs["class"] = "form-control";
        $this->BRAND_NAME->EditCustomAttributes = "";
        if (!$this->BRAND_NAME->Raw) {
            $this->BRAND_NAME->CurrentValue = HtmlDecode($this->BRAND_NAME->CurrentValue);
        }
        $this->BRAND_NAME->EditValue = $this->BRAND_NAME->CurrentValue;
        $this->BRAND_NAME->PlaceHolder = RemoveHtml($this->BRAND_NAME->caption());

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // PRICE
        $this->PRICE->EditAttrs["class"] = "form-control";
        $this->PRICE->EditCustomAttributes = "";
        $this->PRICE->EditValue = $this->PRICE->CurrentValue;
        $this->PRICE->PlaceHolder = RemoveHtml($this->PRICE->caption());
        if (strval($this->PRICE->EditValue) != "" && is_numeric($this->PRICE->EditValue)) {
            $this->PRICE->EditValue = FormatNumber($this->PRICE->EditValue, -2, -2, -2, -2);
        }

        // AVGPRICE
        $this->AVGPRICE->EditAttrs["class"] = "form-control";
        $this->AVGPRICE->EditCustomAttributes = "";
        $this->AVGPRICE->EditValue = $this->AVGPRICE->CurrentValue;
        $this->AVGPRICE->PlaceHolder = RemoveHtml($this->AVGPRICE->caption());
        if (strval($this->AVGPRICE->EditValue) != "" && is_numeric($this->AVGPRICE->EditValue)) {
            $this->AVGPRICE->EditValue = FormatNumber($this->AVGPRICE->EditValue, -2, -2, -2, -2);
        }

        // EXPIRY_DATE
        $this->EXPIRY_DATE->EditAttrs["class"] = "form-control";
        $this->EXPIRY_DATE->EditCustomAttributes = "";
        $this->EXPIRY_DATE->EditValue = FormatDateTime($this->EXPIRY_DATE->CurrentValue, 8);
        $this->EXPIRY_DATE->PlaceHolder = RemoveHtml($this->EXPIRY_DATE->caption());

        // DISTRIBUTION_TYPE
        $this->DISTRIBUTION_TYPE->EditAttrs["class"] = "form-control";
        $this->DISTRIBUTION_TYPE->EditCustomAttributes = "";
        $this->DISTRIBUTION_TYPE->EditValue = $this->DISTRIBUTION_TYPE->CurrentValue;
        $this->DISTRIBUTION_TYPE->PlaceHolder = RemoveHtml($this->DISTRIBUTION_TYPE->caption());

        // MONTH_ID
        $this->MONTH_ID->EditAttrs["class"] = "form-control";
        $this->MONTH_ID->EditCustomAttributes = "";
        $this->MONTH_ID->EditValue = $this->MONTH_ID->CurrentValue;
        $this->MONTH_ID->PlaceHolder = RemoveHtml($this->MONTH_ID->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // STOCK_OPNAME
        $this->STOCK_OPNAME->EditAttrs["class"] = "form-control";
        $this->STOCK_OPNAME->EditCustomAttributes = "";
        $this->STOCK_OPNAME->EditValue = $this->STOCK_OPNAME->CurrentValue;
        $this->STOCK_OPNAME->PlaceHolder = RemoveHtml($this->STOCK_OPNAME->caption());
        if (strval($this->STOCK_OPNAME->EditValue) != "" && is_numeric($this->STOCK_OPNAME->EditValue)) {
            $this->STOCK_OPNAME->EditValue = FormatNumber($this->STOCK_OPNAME->EditValue, -2, -2, -2, -2);
        }

        // STOK_AWAL
        $this->STOK_AWAL->EditAttrs["class"] = "form-control";
        $this->STOK_AWAL->EditCustomAttributes = "";
        $this->STOK_AWAL->EditValue = $this->STOK_AWAL->CurrentValue;
        $this->STOK_AWAL->PlaceHolder = RemoveHtml($this->STOK_AWAL->caption());
        if (strval($this->STOK_AWAL->EditValue) != "" && is_numeric($this->STOK_AWAL->EditValue)) {
            $this->STOK_AWAL->EditValue = FormatNumber($this->STOK_AWAL->EditValue, -2, -2, -2, -2);
        }

        // STOCK_LALU
        $this->STOCK_LALU->EditAttrs["class"] = "form-control";
        $this->STOCK_LALU->EditCustomAttributes = "";
        $this->STOCK_LALU->EditValue = $this->STOCK_LALU->CurrentValue;
        $this->STOCK_LALU->PlaceHolder = RemoveHtml($this->STOCK_LALU->caption());
        if (strval($this->STOCK_LALU->EditValue) != "" && is_numeric($this->STOCK_LALU->EditValue)) {
            $this->STOCK_LALU->EditValue = FormatNumber($this->STOCK_LALU->EditValue, -2, -2, -2, -2);
        }

        // STOCK_KOREKSI
        $this->STOCK_KOREKSI->EditAttrs["class"] = "form-control";
        $this->STOCK_KOREKSI->EditCustomAttributes = "";
        $this->STOCK_KOREKSI->EditValue = $this->STOCK_KOREKSI->CurrentValue;
        $this->STOCK_KOREKSI->PlaceHolder = RemoveHtml($this->STOCK_KOREKSI->caption());
        if (strval($this->STOCK_KOREKSI->EditValue) != "" && is_numeric($this->STOCK_KOREKSI->EditValue)) {
            $this->STOCK_KOREKSI->EditValue = FormatNumber($this->STOCK_KOREKSI->EditValue, -2, -2, -2, -2);
        }

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // ISCETAK
        $this->ISCETAK->EditAttrs["class"] = "form-control";
        $this->ISCETAK->EditCustomAttributes = "";
        if (!$this->ISCETAK->Raw) {
            $this->ISCETAK->CurrentValue = HtmlDecode($this->ISCETAK->CurrentValue);
        }
        $this->ISCETAK->EditValue = $this->ISCETAK->CurrentValue;
        $this->ISCETAK->PlaceHolder = RemoveHtml($this->ISCETAK->caption());

        // PRINTQ
        $this->PRINTQ->EditAttrs["class"] = "form-control";
        $this->PRINTQ->EditCustomAttributes = "";
        $this->PRINTQ->EditValue = $this->PRINTQ->CurrentValue;
        $this->PRINTQ->PlaceHolder = RemoveHtml($this->PRINTQ->caption());

        // PRINTED_BY
        $this->PRINTED_BY->EditAttrs["class"] = "form-control";
        $this->PRINTED_BY->EditCustomAttributes = "";
        if (!$this->PRINTED_BY->Raw) {
            $this->PRINTED_BY->CurrentValue = HtmlDecode($this->PRINTED_BY->CurrentValue);
        }
        $this->PRINTED_BY->EditValue = $this->PRINTED_BY->CurrentValue;
        $this->PRINTED_BY->PlaceHolder = RemoveHtml($this->PRINTED_BY->caption());

        // PRINT_DATE
        $this->PRINT_DATE->EditAttrs["class"] = "form-control";
        $this->PRINT_DATE->EditCustomAttributes = "";
        $this->PRINT_DATE->EditValue = FormatDateTime($this->PRINT_DATE->CurrentValue, 8);
        $this->PRINT_DATE->PlaceHolder = RemoveHtml($this->PRINT_DATE->caption());

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

        // IDX
        $this->IDX->EditAttrs["class"] = "form-control";
        $this->IDX->EditCustomAttributes = "";
        $this->IDX->EditValue = $this->IDX->CurrentValue;
        $this->IDX->PlaceHolder = RemoveHtml($this->IDX->caption());

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
                    $doc->exportCaption($this->ITEM_ID);
                    $doc->exportCaption($this->ROOMS_ID);
                    $doc->exportCaption($this->ALLOCATED_DATE);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->BATCH_NO);
                    $doc->exportCaption($this->BRAND_NAME);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->PRICE);
                    $doc->exportCaption($this->AVGPRICE);
                    $doc->exportCaption($this->EXPIRY_DATE);
                    $doc->exportCaption($this->DISTRIBUTION_TYPE);
                    $doc->exportCaption($this->MONTH_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->STOCK_OPNAME);
                    $doc->exportCaption($this->STOK_AWAL);
                    $doc->exportCaption($this->STOCK_LALU);
                    $doc->exportCaption($this->STOCK_KOREKSI);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->IDX);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->ITEM_ID);
                    $doc->exportCaption($this->ROOMS_ID);
                    $doc->exportCaption($this->ALLOCATED_DATE);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->BATCH_NO);
                    $doc->exportCaption($this->BRAND_NAME);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->PRICE);
                    $doc->exportCaption($this->AVGPRICE);
                    $doc->exportCaption($this->EXPIRY_DATE);
                    $doc->exportCaption($this->DISTRIBUTION_TYPE);
                    $doc->exportCaption($this->MONTH_ID);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->STOCK_OPNAME);
                    $doc->exportCaption($this->STOK_AWAL);
                    $doc->exportCaption($this->STOCK_LALU);
                    $doc->exportCaption($this->STOCK_KOREKSI);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->ISCETAK);
                    $doc->exportCaption($this->PRINTQ);
                    $doc->exportCaption($this->PRINTED_BY);
                    $doc->exportCaption($this->PRINT_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->IDX);
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
                        $doc->exportField($this->ITEM_ID);
                        $doc->exportField($this->ROOMS_ID);
                        $doc->exportField($this->ALLOCATED_DATE);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->BATCH_NO);
                        $doc->exportField($this->BRAND_NAME);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->PRICE);
                        $doc->exportField($this->AVGPRICE);
                        $doc->exportField($this->EXPIRY_DATE);
                        $doc->exportField($this->DISTRIBUTION_TYPE);
                        $doc->exportField($this->MONTH_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->STOCK_OPNAME);
                        $doc->exportField($this->STOK_AWAL);
                        $doc->exportField($this->STOCK_LALU);
                        $doc->exportField($this->STOCK_KOREKSI);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->IDX);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->ITEM_ID);
                        $doc->exportField($this->ROOMS_ID);
                        $doc->exportField($this->ALLOCATED_DATE);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->BATCH_NO);
                        $doc->exportField($this->BRAND_NAME);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->PRICE);
                        $doc->exportField($this->AVGPRICE);
                        $doc->exportField($this->EXPIRY_DATE);
                        $doc->exportField($this->DISTRIBUTION_TYPE);
                        $doc->exportField($this->MONTH_ID);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->STOCK_OPNAME);
                        $doc->exportField($this->STOK_AWAL);
                        $doc->exportField($this->STOCK_LALU);
                        $doc->exportField($this->STOCK_KOREKSI);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->ISCETAK);
                        $doc->exportField($this->PRINTQ);
                        $doc->exportField($this->PRINTED_BY);
                        $doc->exportField($this->PRINT_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->IDX);
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
