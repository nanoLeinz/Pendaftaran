<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for SPP_DETAIL
 */
class SppDetail extends DbTable
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
    public $SPP_DETAIL;
    public $YEAR_ID;
    public $ACCOUNT_ID;
    public $SPP_ID;
    public $SPP_NO;
    public $REF_TYPE;
    public $REF_NO;
    public $REF_DATE;
    public $NO_REGISTRATION;
    public $DESCRIPTION;
    public $TREAT_DATE;
    public $THEVALUE;
    public $ISMAIN;
    public $FA_V;
    public $AMOUNT;
    public $QUANTITY;
    public $AMOUNT_PAID;
    public $CURRENCY_ID;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $SPP_DATE;
    public $SPP_BATCH;
    public $SPP_TYPE;
    public $REF_BATCH;
    public $REF2_TYPE;
    public $REF2_NO;
    public $REF2_DATE;
    public $REF2_BATCH;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'SPP_DETAIL';
        $this->TableName = 'SPP_DETAIL';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[SPP_DETAIL]";
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
        $this->ORG_UNIT_CODE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // SPP_DETAIL
        $this->SPP_DETAIL = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_SPP_DETAIL', 'SPP_DETAIL', '[SPP_DETAIL]', '[SPP_DETAIL]', 200, 50, -1, false, '[SPP_DETAIL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_DETAIL->IsPrimaryKey = true; // Primary key field
        $this->SPP_DETAIL->Nullable = false; // NOT NULL field
        $this->SPP_DETAIL->Required = true; // Required field
        $this->SPP_DETAIL->Sortable = true; // Allow sort
        $this->SPP_DETAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_DETAIL->Param, "CustomMsg");
        $this->Fields['SPP_DETAIL'] = &$this->SPP_DETAIL;

        // YEAR_ID
        $this->YEAR_ID = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_YEAR_ID', 'YEAR_ID', '[YEAR_ID]', 'CAST([YEAR_ID] AS NVARCHAR)', 2, 2, -1, false, '[YEAR_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->YEAR_ID->Sortable = true; // Allow sort
        $this->YEAR_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->YEAR_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->YEAR_ID->Param, "CustomMsg");
        $this->Fields['YEAR_ID'] = &$this->YEAR_ID;

        // ACCOUNT_ID
        $this->ACCOUNT_ID = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_ACCOUNT_ID', 'ACCOUNT_ID', '[ACCOUNT_ID]', '[ACCOUNT_ID]', 200, 50, -1, false, '[ACCOUNT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCOUNT_ID->Sortable = true; // Allow sort
        $this->ACCOUNT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCOUNT_ID->Param, "CustomMsg");
        $this->Fields['ACCOUNT_ID'] = &$this->ACCOUNT_ID;

        // SPP_ID
        $this->SPP_ID = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_SPP_ID', 'SPP_ID', '[SPP_ID]', '[SPP_ID]', 200, 50, -1, false, '[SPP_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_ID->Nullable = false; // NOT NULL field
        $this->SPP_ID->Required = true; // Required field
        $this->SPP_ID->Sortable = true; // Allow sort
        $this->SPP_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_ID->Param, "CustomMsg");
        $this->Fields['SPP_ID'] = &$this->SPP_ID;

        // SPP_NO
        $this->SPP_NO = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_SPP_NO', 'SPP_NO', '[SPP_NO]', '[SPP_NO]', 200, 50, -1, false, '[SPP_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_NO->Sortable = true; // Allow sort
        $this->SPP_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_NO->Param, "CustomMsg");
        $this->Fields['SPP_NO'] = &$this->SPP_NO;

        // REF_TYPE
        $this->REF_TYPE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_REF_TYPE', 'REF_TYPE', '[REF_TYPE]', 'CAST([REF_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[REF_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_TYPE->Sortable = true; // Allow sort
        $this->REF_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REF_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_TYPE->Param, "CustomMsg");
        $this->Fields['REF_TYPE'] = &$this->REF_TYPE;

        // REF_NO
        $this->REF_NO = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_REF_NO', 'REF_NO', '[REF_NO]', '[REF_NO]', 200, 50, -1, false, '[REF_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_NO->Sortable = true; // Allow sort
        $this->REF_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_NO->Param, "CustomMsg");
        $this->Fields['REF_NO'] = &$this->REF_NO;

        // REF_DATE
        $this->REF_DATE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_REF_DATE', 'REF_DATE', '[REF_DATE]', CastDateFieldForLike("[REF_DATE]", 0, "DB"), 135, 8, 0, false, '[REF_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_DATE->Sortable = true; // Allow sort
        $this->REF_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REF_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_DATE->Param, "CustomMsg");
        $this->Fields['REF_DATE'] = &$this->REF_DATE;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 255, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // TREAT_DATE
        $this->TREAT_DATE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_TREAT_DATE', 'TREAT_DATE', '[TREAT_DATE]', CastDateFieldForLike("[TREAT_DATE]", 0, "DB"), 135, 8, 0, false, '[TREAT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREAT_DATE->Sortable = true; // Allow sort
        $this->TREAT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TREAT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREAT_DATE->Param, "CustomMsg");
        $this->Fields['TREAT_DATE'] = &$this->TREAT_DATE;

        // THEVALUE
        $this->THEVALUE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_THEVALUE', 'THEVALUE', '[THEVALUE]', 'CAST([THEVALUE] AS NVARCHAR)', 6, 8, -1, false, '[THEVALUE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->THEVALUE->Sortable = true; // Allow sort
        $this->THEVALUE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->THEVALUE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->THEVALUE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->THEVALUE->Param, "CustomMsg");
        $this->Fields['THEVALUE'] = &$this->THEVALUE;

        // ISMAIN
        $this->ISMAIN = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_ISMAIN', 'ISMAIN', '[ISMAIN]', '[ISMAIN]', 129, 1, -1, false, '[ISMAIN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISMAIN->Sortable = true; // Allow sort
        $this->ISMAIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISMAIN->Param, "CustomMsg");
        $this->Fields['ISMAIN'] = &$this->ISMAIN;

        // FA_V
        $this->FA_V = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_FA_V', 'FA_V', '[FA_V]', '[FA_V]', 200, 50, -1, false, '[FA_V]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V->Sortable = true; // Allow sort
        $this->FA_V->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V->Param, "CustomMsg");
        $this->Fields['FA_V'] = &$this->FA_V;

        // AMOUNT
        $this->AMOUNT = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = true; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // QUANTITY
        $this->QUANTITY = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_QUANTITY', 'QUANTITY', '[QUANTITY]', 'CAST([QUANTITY] AS NVARCHAR)', 131, 8, -1, false, '[QUANTITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->QUANTITY->Sortable = true; // Allow sort
        $this->QUANTITY->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->QUANTITY->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->QUANTITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->QUANTITY->Param, "CustomMsg");
        $this->Fields['QUANTITY'] = &$this->QUANTITY;

        // AMOUNT_PAID
        $this->AMOUNT_PAID = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_AMOUNT_PAID', 'AMOUNT_PAID', '[AMOUNT_PAID]', 'CAST([AMOUNT_PAID] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT_PAID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT_PAID->Sortable = true; // Allow sort
        $this->AMOUNT_PAID->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT_PAID->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT_PAID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT_PAID->Param, "CustomMsg");
        $this->Fields['AMOUNT_PAID'] = &$this->AMOUNT_PAID;

        // CURRENCY_ID
        $this->CURRENCY_ID = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_CURRENCY_ID', 'CURRENCY_ID', '[CURRENCY_ID]', '[CURRENCY_ID]', 200, 10, -1, false, '[CURRENCY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CURRENCY_ID->Sortable = true; // Allow sort
        $this->CURRENCY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CURRENCY_ID->Param, "CustomMsg");
        $this->Fields['CURRENCY_ID'] = &$this->CURRENCY_ID;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 50, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // SPP_DATE
        $this->SPP_DATE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_SPP_DATE', 'SPP_DATE', '[SPP_DATE]', CastDateFieldForLike("[SPP_DATE]", 0, "DB"), 135, 8, 0, false, '[SPP_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_DATE->Sortable = true; // Allow sort
        $this->SPP_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->SPP_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_DATE->Param, "CustomMsg");
        $this->Fields['SPP_DATE'] = &$this->SPP_DATE;

        // SPP_BATCH
        $this->SPP_BATCH = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_SPP_BATCH', 'SPP_BATCH', '[SPP_BATCH]', '[SPP_BATCH]', 200, 50, -1, false, '[SPP_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_BATCH->Sortable = true; // Allow sort
        $this->SPP_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_BATCH->Param, "CustomMsg");
        $this->Fields['SPP_BATCH'] = &$this->SPP_BATCH;

        // SPP_TYPE
        $this->SPP_TYPE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_SPP_TYPE', 'SPP_TYPE', '[SPP_TYPE]', 'CAST([SPP_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[SPP_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SPP_TYPE->Sortable = true; // Allow sort
        $this->SPP_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SPP_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SPP_TYPE->Param, "CustomMsg");
        $this->Fields['SPP_TYPE'] = &$this->SPP_TYPE;

        // REF_BATCH
        $this->REF_BATCH = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_REF_BATCH', 'REF_BATCH', '[REF_BATCH]', '[REF_BATCH]', 200, 50, -1, false, '[REF_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF_BATCH->Sortable = true; // Allow sort
        $this->REF_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF_BATCH->Param, "CustomMsg");
        $this->Fields['REF_BATCH'] = &$this->REF_BATCH;

        // REF2_TYPE
        $this->REF2_TYPE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_REF2_TYPE', 'REF2_TYPE', '[REF2_TYPE]', 'CAST([REF2_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[REF2_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF2_TYPE->Sortable = true; // Allow sort
        $this->REF2_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REF2_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF2_TYPE->Param, "CustomMsg");
        $this->Fields['REF2_TYPE'] = &$this->REF2_TYPE;

        // REF2_NO
        $this->REF2_NO = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_REF2_NO', 'REF2_NO', '[REF2_NO]', '[REF2_NO]', 200, 50, -1, false, '[REF2_NO]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF2_NO->Sortable = true; // Allow sort
        $this->REF2_NO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF2_NO->Param, "CustomMsg");
        $this->Fields['REF2_NO'] = &$this->REF2_NO;

        // REF2_DATE
        $this->REF2_DATE = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_REF2_DATE', 'REF2_DATE', '[REF2_DATE]', CastDateFieldForLike("[REF2_DATE]", 0, "DB"), 135, 8, 0, false, '[REF2_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF2_DATE->Sortable = true; // Allow sort
        $this->REF2_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->REF2_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF2_DATE->Param, "CustomMsg");
        $this->Fields['REF2_DATE'] = &$this->REF2_DATE;

        // REF2_BATCH
        $this->REF2_BATCH = new DbField('SPP_DETAIL', 'SPP_DETAIL', 'x_REF2_BATCH', 'REF2_BATCH', '[REF2_BATCH]', '[REF2_BATCH]', 200, 25, -1, false, '[REF2_BATCH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REF2_BATCH->Sortable = true; // Allow sort
        $this->REF2_BATCH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REF2_BATCH->Param, "CustomMsg");
        $this->Fields['REF2_BATCH'] = &$this->REF2_BATCH;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[SPP_DETAIL]";
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
            if (array_key_exists('SPP_DETAIL', $rs)) {
                AddFilter($where, QuotedName('SPP_DETAIL', $this->Dbid) . '=' . QuotedValue($rs['SPP_DETAIL'], $this->SPP_DETAIL->DataType, $this->Dbid));
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
        $this->SPP_DETAIL->DbValue = $row['SPP_DETAIL'];
        $this->YEAR_ID->DbValue = $row['YEAR_ID'];
        $this->ACCOUNT_ID->DbValue = $row['ACCOUNT_ID'];
        $this->SPP_ID->DbValue = $row['SPP_ID'];
        $this->SPP_NO->DbValue = $row['SPP_NO'];
        $this->REF_TYPE->DbValue = $row['REF_TYPE'];
        $this->REF_NO->DbValue = $row['REF_NO'];
        $this->REF_DATE->DbValue = $row['REF_DATE'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->TREAT_DATE->DbValue = $row['TREAT_DATE'];
        $this->THEVALUE->DbValue = $row['THEVALUE'];
        $this->ISMAIN->DbValue = $row['ISMAIN'];
        $this->FA_V->DbValue = $row['FA_V'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->QUANTITY->DbValue = $row['QUANTITY'];
        $this->AMOUNT_PAID->DbValue = $row['AMOUNT_PAID'];
        $this->CURRENCY_ID->DbValue = $row['CURRENCY_ID'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->SPP_DATE->DbValue = $row['SPP_DATE'];
        $this->SPP_BATCH->DbValue = $row['SPP_BATCH'];
        $this->SPP_TYPE->DbValue = $row['SPP_TYPE'];
        $this->REF_BATCH->DbValue = $row['REF_BATCH'];
        $this->REF2_TYPE->DbValue = $row['REF2_TYPE'];
        $this->REF2_NO->DbValue = $row['REF2_NO'];
        $this->REF2_DATE->DbValue = $row['REF2_DATE'];
        $this->REF2_BATCH->DbValue = $row['REF2_BATCH'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [SPP_DETAIL] = '@SPP_DETAIL@'";
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
        $val = $current ? $this->SPP_DETAIL->CurrentValue : $this->SPP_DETAIL->OldValue;
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
                $this->SPP_DETAIL->CurrentValue = $keys[1];
            } else {
                $this->SPP_DETAIL->OldValue = $keys[1];
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
            $val = array_key_exists('SPP_DETAIL', $row) ? $row['SPP_DETAIL'] : null;
        } else {
            $val = $this->SPP_DETAIL->OldValue !== null ? $this->SPP_DETAIL->OldValue : $this->SPP_DETAIL->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@SPP_DETAIL@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("SppDetailList");
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
        if ($pageName == "SppDetailView") {
            return $Language->phrase("View");
        } elseif ($pageName == "SppDetailEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "SppDetailAdd") {
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
                return "SppDetailView";
            case Config("API_ADD_ACTION"):
                return "SppDetailAdd";
            case Config("API_EDIT_ACTION"):
                return "SppDetailEdit";
            case Config("API_DELETE_ACTION"):
                return "SppDetailDelete";
            case Config("API_LIST_ACTION"):
                return "SppDetailList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "SppDetailList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("SppDetailView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("SppDetailView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "SppDetailAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "SppDetailAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("SppDetailEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("SppDetailAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("SppDetailDelete", $this->getUrlParm());
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
        $json .= ",SPP_DETAIL:" . JsonEncode($this->SPP_DETAIL->CurrentValue, "string");
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
        if ($this->SPP_DETAIL->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->SPP_DETAIL->CurrentValue);
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
            if (($keyValue = Param("SPP_DETAIL") ?? Route("SPP_DETAIL")) !== null) {
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
                $this->SPP_DETAIL->CurrentValue = $key[1];
            } else {
                $this->SPP_DETAIL->OldValue = $key[1];
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
        $this->SPP_DETAIL->setDbValue($row['SPP_DETAIL']);
        $this->YEAR_ID->setDbValue($row['YEAR_ID']);
        $this->ACCOUNT_ID->setDbValue($row['ACCOUNT_ID']);
        $this->SPP_ID->setDbValue($row['SPP_ID']);
        $this->SPP_NO->setDbValue($row['SPP_NO']);
        $this->REF_TYPE->setDbValue($row['REF_TYPE']);
        $this->REF_NO->setDbValue($row['REF_NO']);
        $this->REF_DATE->setDbValue($row['REF_DATE']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->TREAT_DATE->setDbValue($row['TREAT_DATE']);
        $this->THEVALUE->setDbValue($row['THEVALUE']);
        $this->ISMAIN->setDbValue($row['ISMAIN']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->QUANTITY->setDbValue($row['QUANTITY']);
        $this->AMOUNT_PAID->setDbValue($row['AMOUNT_PAID']);
        $this->CURRENCY_ID->setDbValue($row['CURRENCY_ID']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->SPP_DATE->setDbValue($row['SPP_DATE']);
        $this->SPP_BATCH->setDbValue($row['SPP_BATCH']);
        $this->SPP_TYPE->setDbValue($row['SPP_TYPE']);
        $this->REF_BATCH->setDbValue($row['REF_BATCH']);
        $this->REF2_TYPE->setDbValue($row['REF2_TYPE']);
        $this->REF2_NO->setDbValue($row['REF2_NO']);
        $this->REF2_DATE->setDbValue($row['REF2_DATE']);
        $this->REF2_BATCH->setDbValue($row['REF2_BATCH']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // SPP_DETAIL

        // YEAR_ID

        // ACCOUNT_ID

        // SPP_ID

        // SPP_NO

        // REF_TYPE

        // REF_NO

        // REF_DATE

        // NO_REGISTRATION

        // DESCRIPTION

        // TREAT_DATE

        // THEVALUE

        // ISMAIN

        // FA_V

        // AMOUNT

        // QUANTITY

        // AMOUNT_PAID

        // CURRENCY_ID

        // MODIFIED_DATE

        // MODIFIED_BY

        // SPP_DATE

        // SPP_BATCH

        // SPP_TYPE

        // REF_BATCH

        // REF2_TYPE

        // REF2_NO

        // REF2_DATE

        // REF2_BATCH

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // SPP_DETAIL
        $this->SPP_DETAIL->ViewValue = $this->SPP_DETAIL->CurrentValue;
        $this->SPP_DETAIL->ViewCustomAttributes = "";

        // YEAR_ID
        $this->YEAR_ID->ViewValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->ViewValue = FormatNumber($this->YEAR_ID->ViewValue, 0, -2, -2, -2);
        $this->YEAR_ID->ViewCustomAttributes = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->ViewValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->ViewCustomAttributes = "";

        // SPP_ID
        $this->SPP_ID->ViewValue = $this->SPP_ID->CurrentValue;
        $this->SPP_ID->ViewCustomAttributes = "";

        // SPP_NO
        $this->SPP_NO->ViewValue = $this->SPP_NO->CurrentValue;
        $this->SPP_NO->ViewCustomAttributes = "";

        // REF_TYPE
        $this->REF_TYPE->ViewValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->ViewValue = FormatNumber($this->REF_TYPE->ViewValue, 0, -2, -2, -2);
        $this->REF_TYPE->ViewCustomAttributes = "";

        // REF_NO
        $this->REF_NO->ViewValue = $this->REF_NO->CurrentValue;
        $this->REF_NO->ViewCustomAttributes = "";

        // REF_DATE
        $this->REF_DATE->ViewValue = $this->REF_DATE->CurrentValue;
        $this->REF_DATE->ViewValue = FormatDateTime($this->REF_DATE->ViewValue, 0);
        $this->REF_DATE->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // TREAT_DATE
        $this->TREAT_DATE->ViewValue = $this->TREAT_DATE->CurrentValue;
        $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 0);
        $this->TREAT_DATE->ViewCustomAttributes = "";

        // THEVALUE
        $this->THEVALUE->ViewValue = $this->THEVALUE->CurrentValue;
        $this->THEVALUE->ViewValue = FormatNumber($this->THEVALUE->ViewValue, 2, -2, -2, -2);
        $this->THEVALUE->ViewCustomAttributes = "";

        // ISMAIN
        $this->ISMAIN->ViewValue = $this->ISMAIN->CurrentValue;
        $this->ISMAIN->ViewCustomAttributes = "";

        // FA_V
        $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
        $this->FA_V->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // QUANTITY
        $this->QUANTITY->ViewValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->ViewValue = FormatNumber($this->QUANTITY->ViewValue, 2, -2, -2, -2);
        $this->QUANTITY->ViewCustomAttributes = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->ViewValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->ViewValue = FormatNumber($this->AMOUNT_PAID->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT_PAID->ViewCustomAttributes = "";

        // CURRENCY_ID
        $this->CURRENCY_ID->ViewValue = $this->CURRENCY_ID->CurrentValue;
        $this->CURRENCY_ID->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // SPP_DATE
        $this->SPP_DATE->ViewValue = $this->SPP_DATE->CurrentValue;
        $this->SPP_DATE->ViewValue = FormatDateTime($this->SPP_DATE->ViewValue, 0);
        $this->SPP_DATE->ViewCustomAttributes = "";

        // SPP_BATCH
        $this->SPP_BATCH->ViewValue = $this->SPP_BATCH->CurrentValue;
        $this->SPP_BATCH->ViewCustomAttributes = "";

        // SPP_TYPE
        $this->SPP_TYPE->ViewValue = $this->SPP_TYPE->CurrentValue;
        $this->SPP_TYPE->ViewValue = FormatNumber($this->SPP_TYPE->ViewValue, 0, -2, -2, -2);
        $this->SPP_TYPE->ViewCustomAttributes = "";

        // REF_BATCH
        $this->REF_BATCH->ViewValue = $this->REF_BATCH->CurrentValue;
        $this->REF_BATCH->ViewCustomAttributes = "";

        // REF2_TYPE
        $this->REF2_TYPE->ViewValue = $this->REF2_TYPE->CurrentValue;
        $this->REF2_TYPE->ViewValue = FormatNumber($this->REF2_TYPE->ViewValue, 0, -2, -2, -2);
        $this->REF2_TYPE->ViewCustomAttributes = "";

        // REF2_NO
        $this->REF2_NO->ViewValue = $this->REF2_NO->CurrentValue;
        $this->REF2_NO->ViewCustomAttributes = "";

        // REF2_DATE
        $this->REF2_DATE->ViewValue = $this->REF2_DATE->CurrentValue;
        $this->REF2_DATE->ViewValue = FormatDateTime($this->REF2_DATE->ViewValue, 0);
        $this->REF2_DATE->ViewCustomAttributes = "";

        // REF2_BATCH
        $this->REF2_BATCH->ViewValue = $this->REF2_BATCH->CurrentValue;
        $this->REF2_BATCH->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // SPP_DETAIL
        $this->SPP_DETAIL->LinkCustomAttributes = "";
        $this->SPP_DETAIL->HrefValue = "";
        $this->SPP_DETAIL->TooltipValue = "";

        // YEAR_ID
        $this->YEAR_ID->LinkCustomAttributes = "";
        $this->YEAR_ID->HrefValue = "";
        $this->YEAR_ID->TooltipValue = "";

        // ACCOUNT_ID
        $this->ACCOUNT_ID->LinkCustomAttributes = "";
        $this->ACCOUNT_ID->HrefValue = "";
        $this->ACCOUNT_ID->TooltipValue = "";

        // SPP_ID
        $this->SPP_ID->LinkCustomAttributes = "";
        $this->SPP_ID->HrefValue = "";
        $this->SPP_ID->TooltipValue = "";

        // SPP_NO
        $this->SPP_NO->LinkCustomAttributes = "";
        $this->SPP_NO->HrefValue = "";
        $this->SPP_NO->TooltipValue = "";

        // REF_TYPE
        $this->REF_TYPE->LinkCustomAttributes = "";
        $this->REF_TYPE->HrefValue = "";
        $this->REF_TYPE->TooltipValue = "";

        // REF_NO
        $this->REF_NO->LinkCustomAttributes = "";
        $this->REF_NO->HrefValue = "";
        $this->REF_NO->TooltipValue = "";

        // REF_DATE
        $this->REF_DATE->LinkCustomAttributes = "";
        $this->REF_DATE->HrefValue = "";
        $this->REF_DATE->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // TREAT_DATE
        $this->TREAT_DATE->LinkCustomAttributes = "";
        $this->TREAT_DATE->HrefValue = "";
        $this->TREAT_DATE->TooltipValue = "";

        // THEVALUE
        $this->THEVALUE->LinkCustomAttributes = "";
        $this->THEVALUE->HrefValue = "";
        $this->THEVALUE->TooltipValue = "";

        // ISMAIN
        $this->ISMAIN->LinkCustomAttributes = "";
        $this->ISMAIN->HrefValue = "";
        $this->ISMAIN->TooltipValue = "";

        // FA_V
        $this->FA_V->LinkCustomAttributes = "";
        $this->FA_V->HrefValue = "";
        $this->FA_V->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // QUANTITY
        $this->QUANTITY->LinkCustomAttributes = "";
        $this->QUANTITY->HrefValue = "";
        $this->QUANTITY->TooltipValue = "";

        // AMOUNT_PAID
        $this->AMOUNT_PAID->LinkCustomAttributes = "";
        $this->AMOUNT_PAID->HrefValue = "";
        $this->AMOUNT_PAID->TooltipValue = "";

        // CURRENCY_ID
        $this->CURRENCY_ID->LinkCustomAttributes = "";
        $this->CURRENCY_ID->HrefValue = "";
        $this->CURRENCY_ID->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // SPP_DATE
        $this->SPP_DATE->LinkCustomAttributes = "";
        $this->SPP_DATE->HrefValue = "";
        $this->SPP_DATE->TooltipValue = "";

        // SPP_BATCH
        $this->SPP_BATCH->LinkCustomAttributes = "";
        $this->SPP_BATCH->HrefValue = "";
        $this->SPP_BATCH->TooltipValue = "";

        // SPP_TYPE
        $this->SPP_TYPE->LinkCustomAttributes = "";
        $this->SPP_TYPE->HrefValue = "";
        $this->SPP_TYPE->TooltipValue = "";

        // REF_BATCH
        $this->REF_BATCH->LinkCustomAttributes = "";
        $this->REF_BATCH->HrefValue = "";
        $this->REF_BATCH->TooltipValue = "";

        // REF2_TYPE
        $this->REF2_TYPE->LinkCustomAttributes = "";
        $this->REF2_TYPE->HrefValue = "";
        $this->REF2_TYPE->TooltipValue = "";

        // REF2_NO
        $this->REF2_NO->LinkCustomAttributes = "";
        $this->REF2_NO->HrefValue = "";
        $this->REF2_NO->TooltipValue = "";

        // REF2_DATE
        $this->REF2_DATE->LinkCustomAttributes = "";
        $this->REF2_DATE->HrefValue = "";
        $this->REF2_DATE->TooltipValue = "";

        // REF2_BATCH
        $this->REF2_BATCH->LinkCustomAttributes = "";
        $this->REF2_BATCH->HrefValue = "";
        $this->REF2_BATCH->TooltipValue = "";

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

        // SPP_DETAIL
        $this->SPP_DETAIL->EditAttrs["class"] = "form-control";
        $this->SPP_DETAIL->EditCustomAttributes = "";
        if (!$this->SPP_DETAIL->Raw) {
            $this->SPP_DETAIL->CurrentValue = HtmlDecode($this->SPP_DETAIL->CurrentValue);
        }
        $this->SPP_DETAIL->EditValue = $this->SPP_DETAIL->CurrentValue;
        $this->SPP_DETAIL->PlaceHolder = RemoveHtml($this->SPP_DETAIL->caption());

        // YEAR_ID
        $this->YEAR_ID->EditAttrs["class"] = "form-control";
        $this->YEAR_ID->EditCustomAttributes = "";
        $this->YEAR_ID->EditValue = $this->YEAR_ID->CurrentValue;
        $this->YEAR_ID->PlaceHolder = RemoveHtml($this->YEAR_ID->caption());

        // ACCOUNT_ID
        $this->ACCOUNT_ID->EditAttrs["class"] = "form-control";
        $this->ACCOUNT_ID->EditCustomAttributes = "";
        if (!$this->ACCOUNT_ID->Raw) {
            $this->ACCOUNT_ID->CurrentValue = HtmlDecode($this->ACCOUNT_ID->CurrentValue);
        }
        $this->ACCOUNT_ID->EditValue = $this->ACCOUNT_ID->CurrentValue;
        $this->ACCOUNT_ID->PlaceHolder = RemoveHtml($this->ACCOUNT_ID->caption());

        // SPP_ID
        $this->SPP_ID->EditAttrs["class"] = "form-control";
        $this->SPP_ID->EditCustomAttributes = "";
        if (!$this->SPP_ID->Raw) {
            $this->SPP_ID->CurrentValue = HtmlDecode($this->SPP_ID->CurrentValue);
        }
        $this->SPP_ID->EditValue = $this->SPP_ID->CurrentValue;
        $this->SPP_ID->PlaceHolder = RemoveHtml($this->SPP_ID->caption());

        // SPP_NO
        $this->SPP_NO->EditAttrs["class"] = "form-control";
        $this->SPP_NO->EditCustomAttributes = "";
        if (!$this->SPP_NO->Raw) {
            $this->SPP_NO->CurrentValue = HtmlDecode($this->SPP_NO->CurrentValue);
        }
        $this->SPP_NO->EditValue = $this->SPP_NO->CurrentValue;
        $this->SPP_NO->PlaceHolder = RemoveHtml($this->SPP_NO->caption());

        // REF_TYPE
        $this->REF_TYPE->EditAttrs["class"] = "form-control";
        $this->REF_TYPE->EditCustomAttributes = "";
        $this->REF_TYPE->EditValue = $this->REF_TYPE->CurrentValue;
        $this->REF_TYPE->PlaceHolder = RemoveHtml($this->REF_TYPE->caption());

        // REF_NO
        $this->REF_NO->EditAttrs["class"] = "form-control";
        $this->REF_NO->EditCustomAttributes = "";
        if (!$this->REF_NO->Raw) {
            $this->REF_NO->CurrentValue = HtmlDecode($this->REF_NO->CurrentValue);
        }
        $this->REF_NO->EditValue = $this->REF_NO->CurrentValue;
        $this->REF_NO->PlaceHolder = RemoveHtml($this->REF_NO->caption());

        // REF_DATE
        $this->REF_DATE->EditAttrs["class"] = "form-control";
        $this->REF_DATE->EditCustomAttributes = "";
        $this->REF_DATE->EditValue = FormatDateTime($this->REF_DATE->CurrentValue, 8);
        $this->REF_DATE->PlaceHolder = RemoveHtml($this->REF_DATE->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // TREAT_DATE
        $this->TREAT_DATE->EditAttrs["class"] = "form-control";
        $this->TREAT_DATE->EditCustomAttributes = "";
        $this->TREAT_DATE->EditValue = FormatDateTime($this->TREAT_DATE->CurrentValue, 8);
        $this->TREAT_DATE->PlaceHolder = RemoveHtml($this->TREAT_DATE->caption());

        // THEVALUE
        $this->THEVALUE->EditAttrs["class"] = "form-control";
        $this->THEVALUE->EditCustomAttributes = "";
        $this->THEVALUE->EditValue = $this->THEVALUE->CurrentValue;
        $this->THEVALUE->PlaceHolder = RemoveHtml($this->THEVALUE->caption());
        if (strval($this->THEVALUE->EditValue) != "" && is_numeric($this->THEVALUE->EditValue)) {
            $this->THEVALUE->EditValue = FormatNumber($this->THEVALUE->EditValue, -2, -2, -2, -2);
        }

        // ISMAIN
        $this->ISMAIN->EditAttrs["class"] = "form-control";
        $this->ISMAIN->EditCustomAttributes = "";
        if (!$this->ISMAIN->Raw) {
            $this->ISMAIN->CurrentValue = HtmlDecode($this->ISMAIN->CurrentValue);
        }
        $this->ISMAIN->EditValue = $this->ISMAIN->CurrentValue;
        $this->ISMAIN->PlaceHolder = RemoveHtml($this->ISMAIN->caption());

        // FA_V
        $this->FA_V->EditAttrs["class"] = "form-control";
        $this->FA_V->EditCustomAttributes = "";
        if (!$this->FA_V->Raw) {
            $this->FA_V->CurrentValue = HtmlDecode($this->FA_V->CurrentValue);
        }
        $this->FA_V->EditValue = $this->FA_V->CurrentValue;
        $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

        // AMOUNT
        $this->AMOUNT->EditAttrs["class"] = "form-control";
        $this->AMOUNT->EditCustomAttributes = "";
        $this->AMOUNT->EditValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->PlaceHolder = RemoveHtml($this->AMOUNT->caption());
        if (strval($this->AMOUNT->EditValue) != "" && is_numeric($this->AMOUNT->EditValue)) {
            $this->AMOUNT->EditValue = FormatNumber($this->AMOUNT->EditValue, -2, -2, -2, -2);
        }

        // QUANTITY
        $this->QUANTITY->EditAttrs["class"] = "form-control";
        $this->QUANTITY->EditCustomAttributes = "";
        $this->QUANTITY->EditValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->PlaceHolder = RemoveHtml($this->QUANTITY->caption());
        if (strval($this->QUANTITY->EditValue) != "" && is_numeric($this->QUANTITY->EditValue)) {
            $this->QUANTITY->EditValue = FormatNumber($this->QUANTITY->EditValue, -2, -2, -2, -2);
        }

        // AMOUNT_PAID
        $this->AMOUNT_PAID->EditAttrs["class"] = "form-control";
        $this->AMOUNT_PAID->EditCustomAttributes = "";
        $this->AMOUNT_PAID->EditValue = $this->AMOUNT_PAID->CurrentValue;
        $this->AMOUNT_PAID->PlaceHolder = RemoveHtml($this->AMOUNT_PAID->caption());
        if (strval($this->AMOUNT_PAID->EditValue) != "" && is_numeric($this->AMOUNT_PAID->EditValue)) {
            $this->AMOUNT_PAID->EditValue = FormatNumber($this->AMOUNT_PAID->EditValue, -2, -2, -2, -2);
        }

        // CURRENCY_ID
        $this->CURRENCY_ID->EditAttrs["class"] = "form-control";
        $this->CURRENCY_ID->EditCustomAttributes = "";
        if (!$this->CURRENCY_ID->Raw) {
            $this->CURRENCY_ID->CurrentValue = HtmlDecode($this->CURRENCY_ID->CurrentValue);
        }
        $this->CURRENCY_ID->EditValue = $this->CURRENCY_ID->CurrentValue;
        $this->CURRENCY_ID->PlaceHolder = RemoveHtml($this->CURRENCY_ID->caption());

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

        // SPP_DATE
        $this->SPP_DATE->EditAttrs["class"] = "form-control";
        $this->SPP_DATE->EditCustomAttributes = "";
        $this->SPP_DATE->EditValue = FormatDateTime($this->SPP_DATE->CurrentValue, 8);
        $this->SPP_DATE->PlaceHolder = RemoveHtml($this->SPP_DATE->caption());

        // SPP_BATCH
        $this->SPP_BATCH->EditAttrs["class"] = "form-control";
        $this->SPP_BATCH->EditCustomAttributes = "";
        if (!$this->SPP_BATCH->Raw) {
            $this->SPP_BATCH->CurrentValue = HtmlDecode($this->SPP_BATCH->CurrentValue);
        }
        $this->SPP_BATCH->EditValue = $this->SPP_BATCH->CurrentValue;
        $this->SPP_BATCH->PlaceHolder = RemoveHtml($this->SPP_BATCH->caption());

        // SPP_TYPE
        $this->SPP_TYPE->EditAttrs["class"] = "form-control";
        $this->SPP_TYPE->EditCustomAttributes = "";
        $this->SPP_TYPE->EditValue = $this->SPP_TYPE->CurrentValue;
        $this->SPP_TYPE->PlaceHolder = RemoveHtml($this->SPP_TYPE->caption());

        // REF_BATCH
        $this->REF_BATCH->EditAttrs["class"] = "form-control";
        $this->REF_BATCH->EditCustomAttributes = "";
        if (!$this->REF_BATCH->Raw) {
            $this->REF_BATCH->CurrentValue = HtmlDecode($this->REF_BATCH->CurrentValue);
        }
        $this->REF_BATCH->EditValue = $this->REF_BATCH->CurrentValue;
        $this->REF_BATCH->PlaceHolder = RemoveHtml($this->REF_BATCH->caption());

        // REF2_TYPE
        $this->REF2_TYPE->EditAttrs["class"] = "form-control";
        $this->REF2_TYPE->EditCustomAttributes = "";
        $this->REF2_TYPE->EditValue = $this->REF2_TYPE->CurrentValue;
        $this->REF2_TYPE->PlaceHolder = RemoveHtml($this->REF2_TYPE->caption());

        // REF2_NO
        $this->REF2_NO->EditAttrs["class"] = "form-control";
        $this->REF2_NO->EditCustomAttributes = "";
        if (!$this->REF2_NO->Raw) {
            $this->REF2_NO->CurrentValue = HtmlDecode($this->REF2_NO->CurrentValue);
        }
        $this->REF2_NO->EditValue = $this->REF2_NO->CurrentValue;
        $this->REF2_NO->PlaceHolder = RemoveHtml($this->REF2_NO->caption());

        // REF2_DATE
        $this->REF2_DATE->EditAttrs["class"] = "form-control";
        $this->REF2_DATE->EditCustomAttributes = "";
        $this->REF2_DATE->EditValue = FormatDateTime($this->REF2_DATE->CurrentValue, 8);
        $this->REF2_DATE->PlaceHolder = RemoveHtml($this->REF2_DATE->caption());

        // REF2_BATCH
        $this->REF2_BATCH->EditAttrs["class"] = "form-control";
        $this->REF2_BATCH->EditCustomAttributes = "";
        if (!$this->REF2_BATCH->Raw) {
            $this->REF2_BATCH->CurrentValue = HtmlDecode($this->REF2_BATCH->CurrentValue);
        }
        $this->REF2_BATCH->EditValue = $this->REF2_BATCH->CurrentValue;
        $this->REF2_BATCH->PlaceHolder = RemoveHtml($this->REF2_BATCH->caption());

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
                    $doc->exportCaption($this->SPP_DETAIL);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->SPP_ID);
                    $doc->exportCaption($this->SPP_NO);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REF_NO);
                    $doc->exportCaption($this->REF_DATE);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->THEVALUE);
                    $doc->exportCaption($this->ISMAIN);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->CURRENCY_ID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->SPP_DATE);
                    $doc->exportCaption($this->SPP_BATCH);
                    $doc->exportCaption($this->SPP_TYPE);
                    $doc->exportCaption($this->REF_BATCH);
                    $doc->exportCaption($this->REF2_TYPE);
                    $doc->exportCaption($this->REF2_NO);
                    $doc->exportCaption($this->REF2_DATE);
                    $doc->exportCaption($this->REF2_BATCH);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->SPP_DETAIL);
                    $doc->exportCaption($this->YEAR_ID);
                    $doc->exportCaption($this->ACCOUNT_ID);
                    $doc->exportCaption($this->SPP_ID);
                    $doc->exportCaption($this->SPP_NO);
                    $doc->exportCaption($this->REF_TYPE);
                    $doc->exportCaption($this->REF_NO);
                    $doc->exportCaption($this->REF_DATE);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->THEVALUE);
                    $doc->exportCaption($this->ISMAIN);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->AMOUNT_PAID);
                    $doc->exportCaption($this->CURRENCY_ID);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->SPP_DATE);
                    $doc->exportCaption($this->SPP_BATCH);
                    $doc->exportCaption($this->SPP_TYPE);
                    $doc->exportCaption($this->REF_BATCH);
                    $doc->exportCaption($this->REF2_TYPE);
                    $doc->exportCaption($this->REF2_NO);
                    $doc->exportCaption($this->REF2_DATE);
                    $doc->exportCaption($this->REF2_BATCH);
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
                        $doc->exportField($this->SPP_DETAIL);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->SPP_ID);
                        $doc->exportField($this->SPP_NO);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REF_NO);
                        $doc->exportField($this->REF_DATE);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->THEVALUE);
                        $doc->exportField($this->ISMAIN);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->CURRENCY_ID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->SPP_DATE);
                        $doc->exportField($this->SPP_BATCH);
                        $doc->exportField($this->SPP_TYPE);
                        $doc->exportField($this->REF_BATCH);
                        $doc->exportField($this->REF2_TYPE);
                        $doc->exportField($this->REF2_NO);
                        $doc->exportField($this->REF2_DATE);
                        $doc->exportField($this->REF2_BATCH);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->SPP_DETAIL);
                        $doc->exportField($this->YEAR_ID);
                        $doc->exportField($this->ACCOUNT_ID);
                        $doc->exportField($this->SPP_ID);
                        $doc->exportField($this->SPP_NO);
                        $doc->exportField($this->REF_TYPE);
                        $doc->exportField($this->REF_NO);
                        $doc->exportField($this->REF_DATE);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->THEVALUE);
                        $doc->exportField($this->ISMAIN);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->AMOUNT_PAID);
                        $doc->exportField($this->CURRENCY_ID);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->SPP_DATE);
                        $doc->exportField($this->SPP_BATCH);
                        $doc->exportField($this->SPP_TYPE);
                        $doc->exportField($this->REF_BATCH);
                        $doc->exportField($this->REF2_TYPE);
                        $doc->exportField($this->REF2_NO);
                        $doc->exportField($this->REF2_DATE);
                        $doc->exportField($this->REF2_BATCH);
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
