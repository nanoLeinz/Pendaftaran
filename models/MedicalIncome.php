<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for MEDICAL_INCOME
 */
class MedicalIncome extends DbTable
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
    public $BILL_ID;
    public $EMPLOYEE_ID;
    public $NO_REGISTRATION;
    public $VISIT_ID;
    public $CLINIC_ID;
    public $TARIF_ID;
    public $TARIF_NAME;
    public $TREAT_DATE;
    public $COMP_ID;
    public $COMP_NAME;
    public $AMOUNT;
    public $QUANTITY;
    public $TASK_ID;
    public $TASK_NAME;
    public $COMP_TYPE;
    public $COMPTYPE;
    public $PERCENTAGE;
    public $FA_V;
    public $VALIDATED_DATE;
    public $ISVALID;
    public $ACCEPTED;
    public $PAID_DATE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $MODIFIED_FROM;
    public $status_pasien_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'MEDICAL_INCOME';
        $this->TableName = 'MEDICAL_INCOME';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[MEDICAL_INCOME]";
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
        $this->ORG_UNIT_CODE = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_ORG_UNIT_CODE', 'ORG_UNIT_CODE', '[ORG_UNIT_CODE]', '[ORG_UNIT_CODE]', 200, 50, -1, false, '[ORG_UNIT_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORG_UNIT_CODE->IsPrimaryKey = true; // Primary key field
        $this->ORG_UNIT_CODE->Nullable = false; // NOT NULL field
        $this->ORG_UNIT_CODE->Required = true; // Required field
        $this->ORG_UNIT_CODE->Sortable = true; // Allow sort
        $this->ORG_UNIT_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORG_UNIT_CODE->Param, "CustomMsg");
        $this->Fields['ORG_UNIT_CODE'] = &$this->ORG_UNIT_CODE;

        // BILL_ID
        $this->BILL_ID = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_BILL_ID', 'BILL_ID', '[BILL_ID]', '[BILL_ID]', 200, 50, -1, false, '[BILL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BILL_ID->IsPrimaryKey = true; // Primary key field
        $this->BILL_ID->Nullable = false; // NOT NULL field
        $this->BILL_ID->Required = true; // Required field
        $this->BILL_ID->Sortable = true; // Allow sort
        $this->BILL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BILL_ID->Param, "CustomMsg");
        $this->Fields['BILL_ID'] = &$this->BILL_ID;

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_EMPLOYEE_ID', 'EMPLOYEE_ID', '[EMPLOYEE_ID]', '[EMPLOYEE_ID]', 200, 25, -1, false, '[EMPLOYEE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EMPLOYEE_ID->IsPrimaryKey = true; // Primary key field
        $this->EMPLOYEE_ID->Nullable = false; // NOT NULL field
        $this->EMPLOYEE_ID->Required = true; // Required field
        $this->EMPLOYEE_ID->Sortable = true; // Allow sort
        $this->EMPLOYEE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EMPLOYEE_ID->Param, "CustomMsg");
        $this->Fields['EMPLOYEE_ID'] = &$this->EMPLOYEE_ID;

        // NO_REGISTRATION
        $this->NO_REGISTRATION = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_NO_REGISTRATION', 'NO_REGISTRATION', '[NO_REGISTRATION]', '[NO_REGISTRATION]', 200, 50, -1, false, '[NO_REGISTRATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_REGISTRATION->Sortable = true; // Allow sort
        $this->NO_REGISTRATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_REGISTRATION->Param, "CustomMsg");
        $this->Fields['NO_REGISTRATION'] = &$this->NO_REGISTRATION;

        // VISIT_ID
        $this->VISIT_ID = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_VISIT_ID', 'VISIT_ID', '[VISIT_ID]', '[VISIT_ID]', 200, 50, -1, false, '[VISIT_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VISIT_ID->Sortable = true; // Allow sort
        $this->VISIT_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VISIT_ID->Param, "CustomMsg");
        $this->Fields['VISIT_ID'] = &$this->VISIT_ID;

        // CLINIC_ID
        $this->CLINIC_ID = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_CLINIC_ID', 'CLINIC_ID', '[CLINIC_ID]', '[CLINIC_ID]', 200, 8, -1, false, '[CLINIC_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CLINIC_ID->Sortable = true; // Allow sort
        $this->CLINIC_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CLINIC_ID->Param, "CustomMsg");
        $this->Fields['CLINIC_ID'] = &$this->CLINIC_ID;

        // TARIF_ID
        $this->TARIF_ID = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_TARIF_ID', 'TARIF_ID', '[TARIF_ID]', '[TARIF_ID]', 200, 50, -1, false, '[TARIF_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_ID->IsPrimaryKey = true; // Primary key field
        $this->TARIF_ID->Nullable = false; // NOT NULL field
        $this->TARIF_ID->Required = true; // Required field
        $this->TARIF_ID->Sortable = true; // Allow sort
        $this->TARIF_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_ID->Param, "CustomMsg");
        $this->Fields['TARIF_ID'] = &$this->TARIF_ID;

        // TARIF_NAME
        $this->TARIF_NAME = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_TARIF_NAME', 'TARIF_NAME', '[TARIF_NAME]', '[TARIF_NAME]', 200, 100, -1, false, '[TARIF_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TARIF_NAME->Sortable = true; // Allow sort
        $this->TARIF_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TARIF_NAME->Param, "CustomMsg");
        $this->Fields['TARIF_NAME'] = &$this->TARIF_NAME;

        // TREAT_DATE
        $this->TREAT_DATE = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_TREAT_DATE', 'TREAT_DATE', '[TREAT_DATE]', CastDateFieldForLike("[TREAT_DATE]", 0, "DB"), 135, 8, 0, false, '[TREAT_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TREAT_DATE->Sortable = true; // Allow sort
        $this->TREAT_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->TREAT_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TREAT_DATE->Param, "CustomMsg");
        $this->Fields['TREAT_DATE'] = &$this->TREAT_DATE;

        // COMP_ID
        $this->COMP_ID = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_COMP_ID', 'COMP_ID', '[COMP_ID]', 'CAST([COMP_ID] AS NVARCHAR)', 2, 2, -1, false, '[COMP_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMP_ID->IsPrimaryKey = true; // Primary key field
        $this->COMP_ID->Nullable = false; // NOT NULL field
        $this->COMP_ID->Required = true; // Required field
        $this->COMP_ID->Sortable = true; // Allow sort
        $this->COMP_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->COMP_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMP_ID->Param, "CustomMsg");
        $this->Fields['COMP_ID'] = &$this->COMP_ID;

        // COMP_NAME
        $this->COMP_NAME = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_COMP_NAME', 'COMP_NAME', '[COMP_NAME]', '[COMP_NAME]', 200, 100, -1, false, '[COMP_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMP_NAME->Sortable = true; // Allow sort
        $this->COMP_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMP_NAME->Param, "CustomMsg");
        $this->Fields['COMP_NAME'] = &$this->COMP_NAME;

        // AMOUNT
        $this->AMOUNT = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_AMOUNT', 'AMOUNT', '[AMOUNT]', 'CAST([AMOUNT] AS NVARCHAR)', 6, 8, -1, false, '[AMOUNT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AMOUNT->Sortable = true; // Allow sort
        $this->AMOUNT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->AMOUNT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->AMOUNT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AMOUNT->Param, "CustomMsg");
        $this->Fields['AMOUNT'] = &$this->AMOUNT;

        // QUANTITY
        $this->QUANTITY = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_QUANTITY', 'QUANTITY', '[QUANTITY]', 'CAST([QUANTITY] AS NVARCHAR)', 131, 8, -1, false, '[QUANTITY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->QUANTITY->Sortable = true; // Allow sort
        $this->QUANTITY->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->QUANTITY->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->QUANTITY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->QUANTITY->Param, "CustomMsg");
        $this->Fields['QUANTITY'] = &$this->QUANTITY;

        // TASK_ID
        $this->TASK_ID = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_TASK_ID', 'TASK_ID', '[TASK_ID]', 'CAST([TASK_ID] AS NVARCHAR)', 2, 2, -1, false, '[TASK_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TASK_ID->IsPrimaryKey = true; // Primary key field
        $this->TASK_ID->Nullable = false; // NOT NULL field
        $this->TASK_ID->Required = true; // Required field
        $this->TASK_ID->Sortable = true; // Allow sort
        $this->TASK_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TASK_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TASK_ID->Param, "CustomMsg");
        $this->Fields['TASK_ID'] = &$this->TASK_ID;

        // TASK_NAME
        $this->TASK_NAME = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_TASK_NAME', 'TASK_NAME', '[TASK_NAME]', '[TASK_NAME]', 200, 100, -1, false, '[TASK_NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TASK_NAME->Sortable = true; // Allow sort
        $this->TASK_NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TASK_NAME->Param, "CustomMsg");
        $this->Fields['TASK_NAME'] = &$this->TASK_NAME;

        // COMP_TYPE
        $this->COMP_TYPE = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_COMP_TYPE', 'COMP_TYPE', '[COMP_TYPE]', 'CAST([COMP_TYPE] AS NVARCHAR)', 17, 1, -1, false, '[COMP_TYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMP_TYPE->Sortable = true; // Allow sort
        $this->COMP_TYPE->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->COMP_TYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMP_TYPE->Param, "CustomMsg");
        $this->Fields['COMP_TYPE'] = &$this->COMP_TYPE;

        // COMPTYPE
        $this->COMPTYPE = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_COMPTYPE', 'COMPTYPE', '[COMPTYPE]', '[COMPTYPE]', 200, 100, -1, false, '[COMPTYPE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPTYPE->Sortable = true; // Allow sort
        $this->COMPTYPE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPTYPE->Param, "CustomMsg");
        $this->Fields['COMPTYPE'] = &$this->COMPTYPE;

        // PERCENTAGE
        $this->PERCENTAGE = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_PERCENTAGE', 'PERCENTAGE', '[PERCENTAGE]', 'CAST([PERCENTAGE] AS NVARCHAR)', 131, 8, -1, false, '[PERCENTAGE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PERCENTAGE->Sortable = true; // Allow sort
        $this->PERCENTAGE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->PERCENTAGE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->PERCENTAGE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PERCENTAGE->Param, "CustomMsg");
        $this->Fields['PERCENTAGE'] = &$this->PERCENTAGE;

        // FA_V
        $this->FA_V = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_FA_V', 'FA_V', '[FA_V]', 'CAST([FA_V] AS NVARCHAR)', 2, 2, -1, false, '[FA_V]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FA_V->Sortable = true; // Allow sort
        $this->FA_V->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FA_V->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FA_V->Param, "CustomMsg");
        $this->Fields['FA_V'] = &$this->FA_V;

        // VALIDATED_DATE
        $this->VALIDATED_DATE = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_VALIDATED_DATE', 'VALIDATED_DATE', '[VALIDATED_DATE]', CastDateFieldForLike("[VALIDATED_DATE]", 0, "DB"), 135, 8, 0, false, '[VALIDATED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->VALIDATED_DATE->Sortable = true; // Allow sort
        $this->VALIDATED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->VALIDATED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->VALIDATED_DATE->Param, "CustomMsg");
        $this->Fields['VALIDATED_DATE'] = &$this->VALIDATED_DATE;

        // ISVALID
        $this->ISVALID = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_ISVALID', 'ISVALID', '[ISVALID]', '[ISVALID]', 129, 1, -1, false, '[ISVALID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISVALID->Sortable = true; // Allow sort
        $this->ISVALID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISVALID->Param, "CustomMsg");
        $this->Fields['ISVALID'] = &$this->ISVALID;

        // ACCEPTED
        $this->ACCEPTED = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_ACCEPTED', 'ACCEPTED', '[ACCEPTED]', 'CAST([ACCEPTED] AS NVARCHAR)', 6, 8, -1, false, '[ACCEPTED]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ACCEPTED->Sortable = true; // Allow sort
        $this->ACCEPTED->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ACCEPTED->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ACCEPTED->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ACCEPTED->Param, "CustomMsg");
        $this->Fields['ACCEPTED'] = &$this->ACCEPTED;

        // PAID_DATE
        $this->PAID_DATE = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_PAID_DATE', 'PAID_DATE', '[PAID_DATE]', CastDateFieldForLike("[PAID_DATE]", 0, "DB"), 135, 8, 0, false, '[PAID_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PAID_DATE->Sortable = true; // Allow sort
        $this->PAID_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->PAID_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PAID_DATE->Param, "CustomMsg");
        $this->Fields['PAID_DATE'] = &$this->PAID_DATE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 100, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // MODIFIED_FROM
        $this->MODIFIED_FROM = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_MODIFIED_FROM', 'MODIFIED_FROM', '[MODIFIED_FROM]', '[MODIFIED_FROM]', 200, 100, -1, false, '[MODIFIED_FROM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_FROM->Sortable = true; // Allow sort
        $this->MODIFIED_FROM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_FROM->Param, "CustomMsg");
        $this->Fields['MODIFIED_FROM'] = &$this->MODIFIED_FROM;

        // status_pasien_id
        $this->status_pasien_id = new DbField('MEDICAL_INCOME', 'MEDICAL_INCOME', 'x_status_pasien_id', 'status_pasien_id', '[status_pasien_id]', 'CAST([status_pasien_id] AS NVARCHAR)', 17, 1, -1, false, '[status_pasien_id]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status_pasien_id->Sortable = true; // Allow sort
        $this->status_pasien_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->status_pasien_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status_pasien_id->Param, "CustomMsg");
        $this->Fields['status_pasien_id'] = &$this->status_pasien_id;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[MEDICAL_INCOME]";
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
            if (array_key_exists('BILL_ID', $rs)) {
                AddFilter($where, QuotedName('BILL_ID', $this->Dbid) . '=' . QuotedValue($rs['BILL_ID'], $this->BILL_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('EMPLOYEE_ID', $rs)) {
                AddFilter($where, QuotedName('EMPLOYEE_ID', $this->Dbid) . '=' . QuotedValue($rs['EMPLOYEE_ID'], $this->EMPLOYEE_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('TARIF_ID', $rs)) {
                AddFilter($where, QuotedName('TARIF_ID', $this->Dbid) . '=' . QuotedValue($rs['TARIF_ID'], $this->TARIF_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('COMP_ID', $rs)) {
                AddFilter($where, QuotedName('COMP_ID', $this->Dbid) . '=' . QuotedValue($rs['COMP_ID'], $this->COMP_ID->DataType, $this->Dbid));
            }
            if (array_key_exists('TASK_ID', $rs)) {
                AddFilter($where, QuotedName('TASK_ID', $this->Dbid) . '=' . QuotedValue($rs['TASK_ID'], $this->TASK_ID->DataType, $this->Dbid));
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
        $this->BILL_ID->DbValue = $row['BILL_ID'];
        $this->EMPLOYEE_ID->DbValue = $row['EMPLOYEE_ID'];
        $this->NO_REGISTRATION->DbValue = $row['NO_REGISTRATION'];
        $this->VISIT_ID->DbValue = $row['VISIT_ID'];
        $this->CLINIC_ID->DbValue = $row['CLINIC_ID'];
        $this->TARIF_ID->DbValue = $row['TARIF_ID'];
        $this->TARIF_NAME->DbValue = $row['TARIF_NAME'];
        $this->TREAT_DATE->DbValue = $row['TREAT_DATE'];
        $this->COMP_ID->DbValue = $row['COMP_ID'];
        $this->COMP_NAME->DbValue = $row['COMP_NAME'];
        $this->AMOUNT->DbValue = $row['AMOUNT'];
        $this->QUANTITY->DbValue = $row['QUANTITY'];
        $this->TASK_ID->DbValue = $row['TASK_ID'];
        $this->TASK_NAME->DbValue = $row['TASK_NAME'];
        $this->COMP_TYPE->DbValue = $row['COMP_TYPE'];
        $this->COMPTYPE->DbValue = $row['COMPTYPE'];
        $this->PERCENTAGE->DbValue = $row['PERCENTAGE'];
        $this->FA_V->DbValue = $row['FA_V'];
        $this->VALIDATED_DATE->DbValue = $row['VALIDATED_DATE'];
        $this->ISVALID->DbValue = $row['ISVALID'];
        $this->ACCEPTED->DbValue = $row['ACCEPTED'];
        $this->PAID_DATE->DbValue = $row['PAID_DATE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->MODIFIED_FROM->DbValue = $row['MODIFIED_FROM'];
        $this->status_pasien_id->DbValue = $row['status_pasien_id'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[ORG_UNIT_CODE] = '@ORG_UNIT_CODE@' AND [BILL_ID] = '@BILL_ID@' AND [EMPLOYEE_ID] = '@EMPLOYEE_ID@' AND [TARIF_ID] = '@TARIF_ID@' AND [COMP_ID] = @COMP_ID@ AND [TASK_ID] = @TASK_ID@";
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
        $val = $current ? $this->BILL_ID->CurrentValue : $this->BILL_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->EMPLOYEE_ID->CurrentValue : $this->EMPLOYEE_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->TARIF_ID->CurrentValue : $this->TARIF_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->COMP_ID->CurrentValue : $this->COMP_ID->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        $val = $current ? $this->TASK_ID->CurrentValue : $this->TASK_ID->OldValue;
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
        if (count($keys) == 6) {
            if ($current) {
                $this->ORG_UNIT_CODE->CurrentValue = $keys[0];
            } else {
                $this->ORG_UNIT_CODE->OldValue = $keys[0];
            }
            if ($current) {
                $this->BILL_ID->CurrentValue = $keys[1];
            } else {
                $this->BILL_ID->OldValue = $keys[1];
            }
            if ($current) {
                $this->EMPLOYEE_ID->CurrentValue = $keys[2];
            } else {
                $this->EMPLOYEE_ID->OldValue = $keys[2];
            }
            if ($current) {
                $this->TARIF_ID->CurrentValue = $keys[3];
            } else {
                $this->TARIF_ID->OldValue = $keys[3];
            }
            if ($current) {
                $this->COMP_ID->CurrentValue = $keys[4];
            } else {
                $this->COMP_ID->OldValue = $keys[4];
            }
            if ($current) {
                $this->TASK_ID->CurrentValue = $keys[5];
            } else {
                $this->TASK_ID->OldValue = $keys[5];
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
            $val = array_key_exists('BILL_ID', $row) ? $row['BILL_ID'] : null;
        } else {
            $val = $this->BILL_ID->OldValue !== null ? $this->BILL_ID->OldValue : $this->BILL_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@BILL_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('EMPLOYEE_ID', $row) ? $row['EMPLOYEE_ID'] : null;
        } else {
            $val = $this->EMPLOYEE_ID->OldValue !== null ? $this->EMPLOYEE_ID->OldValue : $this->EMPLOYEE_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@EMPLOYEE_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('TARIF_ID', $row) ? $row['TARIF_ID'] : null;
        } else {
            $val = $this->TARIF_ID->OldValue !== null ? $this->TARIF_ID->OldValue : $this->TARIF_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@TARIF_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('COMP_ID', $row) ? $row['COMP_ID'] : null;
        } else {
            $val = $this->COMP_ID->OldValue !== null ? $this->COMP_ID->OldValue : $this->COMP_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@COMP_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        if (is_array($row)) {
            $val = array_key_exists('TASK_ID', $row) ? $row['TASK_ID'] : null;
        } else {
            $val = $this->TASK_ID->OldValue !== null ? $this->TASK_ID->OldValue : $this->TASK_ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@TASK_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("MedicalIncomeList");
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
        if ($pageName == "MedicalIncomeView") {
            return $Language->phrase("View");
        } elseif ($pageName == "MedicalIncomeEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "MedicalIncomeAdd") {
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
                return "MedicalIncomeView";
            case Config("API_ADD_ACTION"):
                return "MedicalIncomeAdd";
            case Config("API_EDIT_ACTION"):
                return "MedicalIncomeEdit";
            case Config("API_DELETE_ACTION"):
                return "MedicalIncomeDelete";
            case Config("API_LIST_ACTION"):
                return "MedicalIncomeList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "MedicalIncomeList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("MedicalIncomeView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("MedicalIncomeView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "MedicalIncomeAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "MedicalIncomeAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("MedicalIncomeEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("MedicalIncomeAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("MedicalIncomeDelete", $this->getUrlParm());
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
        $json .= ",BILL_ID:" . JsonEncode($this->BILL_ID->CurrentValue, "string");
        $json .= ",EMPLOYEE_ID:" . JsonEncode($this->EMPLOYEE_ID->CurrentValue, "string");
        $json .= ",TARIF_ID:" . JsonEncode($this->TARIF_ID->CurrentValue, "string");
        $json .= ",COMP_ID:" . JsonEncode($this->COMP_ID->CurrentValue, "number");
        $json .= ",TASK_ID:" . JsonEncode($this->TASK_ID->CurrentValue, "number");
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
        if ($this->BILL_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BILL_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->EMPLOYEE_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->EMPLOYEE_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->TARIF_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->TARIF_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->COMP_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->COMP_ID->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($this->TASK_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->TASK_ID->CurrentValue);
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
            if (($keyValue = Param("BILL_ID") ?? Route("BILL_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(1) ?? Route(3)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("EMPLOYEE_ID") ?? Route("EMPLOYEE_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(2) ?? Route(4)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("TARIF_ID") ?? Route("TARIF_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(3) ?? Route(5)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("COMP_ID") ?? Route("COMP_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(4) ?? Route(6)) !== null)) {
                $arKey[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }
            if (($keyValue = Param("TASK_ID") ?? Route("TASK_ID")) !== null) {
                $arKey[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(5) ?? Route(7)) !== null)) {
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
                if (!is_array($key) || count($key) != 6) {
                    continue; // Just skip so other keys will still work
                }
                if (!is_numeric($key[4])) { // COMP_ID
                    continue;
                }
                if (!is_numeric($key[5])) { // TASK_ID
                    continue;
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
                $this->BILL_ID->CurrentValue = $key[1];
            } else {
                $this->BILL_ID->OldValue = $key[1];
            }
            if ($setCurrent) {
                $this->EMPLOYEE_ID->CurrentValue = $key[2];
            } else {
                $this->EMPLOYEE_ID->OldValue = $key[2];
            }
            if ($setCurrent) {
                $this->TARIF_ID->CurrentValue = $key[3];
            } else {
                $this->TARIF_ID->OldValue = $key[3];
            }
            if ($setCurrent) {
                $this->COMP_ID->CurrentValue = $key[4];
            } else {
                $this->COMP_ID->OldValue = $key[4];
            }
            if ($setCurrent) {
                $this->TASK_ID->CurrentValue = $key[5];
            } else {
                $this->TASK_ID->OldValue = $key[5];
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
        $this->BILL_ID->setDbValue($row['BILL_ID']);
        $this->EMPLOYEE_ID->setDbValue($row['EMPLOYEE_ID']);
        $this->NO_REGISTRATION->setDbValue($row['NO_REGISTRATION']);
        $this->VISIT_ID->setDbValue($row['VISIT_ID']);
        $this->CLINIC_ID->setDbValue($row['CLINIC_ID']);
        $this->TARIF_ID->setDbValue($row['TARIF_ID']);
        $this->TARIF_NAME->setDbValue($row['TARIF_NAME']);
        $this->TREAT_DATE->setDbValue($row['TREAT_DATE']);
        $this->COMP_ID->setDbValue($row['COMP_ID']);
        $this->COMP_NAME->setDbValue($row['COMP_NAME']);
        $this->AMOUNT->setDbValue($row['AMOUNT']);
        $this->QUANTITY->setDbValue($row['QUANTITY']);
        $this->TASK_ID->setDbValue($row['TASK_ID']);
        $this->TASK_NAME->setDbValue($row['TASK_NAME']);
        $this->COMP_TYPE->setDbValue($row['COMP_TYPE']);
        $this->COMPTYPE->setDbValue($row['COMPTYPE']);
        $this->PERCENTAGE->setDbValue($row['PERCENTAGE']);
        $this->FA_V->setDbValue($row['FA_V']);
        $this->VALIDATED_DATE->setDbValue($row['VALIDATED_DATE']);
        $this->ISVALID->setDbValue($row['ISVALID']);
        $this->ACCEPTED->setDbValue($row['ACCEPTED']);
        $this->PAID_DATE->setDbValue($row['PAID_DATE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->MODIFIED_FROM->setDbValue($row['MODIFIED_FROM']);
        $this->status_pasien_id->setDbValue($row['status_pasien_id']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ORG_UNIT_CODE

        // BILL_ID

        // EMPLOYEE_ID

        // NO_REGISTRATION

        // VISIT_ID

        // CLINIC_ID

        // TARIF_ID

        // TARIF_NAME

        // TREAT_DATE

        // COMP_ID

        // COMP_NAME

        // AMOUNT

        // QUANTITY

        // TASK_ID

        // TASK_NAME

        // COMP_TYPE

        // COMPTYPE

        // PERCENTAGE

        // FA_V

        // VALIDATED_DATE

        // ISVALID

        // ACCEPTED

        // PAID_DATE

        // MODIFIED_DATE

        // MODIFIED_BY

        // MODIFIED_FROM

        // status_pasien_id

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->ViewValue = $this->ORG_UNIT_CODE->CurrentValue;
        $this->ORG_UNIT_CODE->ViewCustomAttributes = "";

        // BILL_ID
        $this->BILL_ID->ViewValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->ViewCustomAttributes = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->ViewValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->ViewCustomAttributes = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->ViewValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->ViewCustomAttributes = "";

        // VISIT_ID
        $this->VISIT_ID->ViewValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->ViewCustomAttributes = "";

        // CLINIC_ID
        $this->CLINIC_ID->ViewValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->ViewCustomAttributes = "";

        // TARIF_ID
        $this->TARIF_ID->ViewValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->ViewCustomAttributes = "";

        // TARIF_NAME
        $this->TARIF_NAME->ViewValue = $this->TARIF_NAME->CurrentValue;
        $this->TARIF_NAME->ViewCustomAttributes = "";

        // TREAT_DATE
        $this->TREAT_DATE->ViewValue = $this->TREAT_DATE->CurrentValue;
        $this->TREAT_DATE->ViewValue = FormatDateTime($this->TREAT_DATE->ViewValue, 0);
        $this->TREAT_DATE->ViewCustomAttributes = "";

        // COMP_ID
        $this->COMP_ID->ViewValue = $this->COMP_ID->CurrentValue;
        $this->COMP_ID->ViewValue = FormatNumber($this->COMP_ID->ViewValue, 0, -2, -2, -2);
        $this->COMP_ID->ViewCustomAttributes = "";

        // COMP_NAME
        $this->COMP_NAME->ViewValue = $this->COMP_NAME->CurrentValue;
        $this->COMP_NAME->ViewCustomAttributes = "";

        // AMOUNT
        $this->AMOUNT->ViewValue = $this->AMOUNT->CurrentValue;
        $this->AMOUNT->ViewValue = FormatNumber($this->AMOUNT->ViewValue, 2, -2, -2, -2);
        $this->AMOUNT->ViewCustomAttributes = "";

        // QUANTITY
        $this->QUANTITY->ViewValue = $this->QUANTITY->CurrentValue;
        $this->QUANTITY->ViewValue = FormatNumber($this->QUANTITY->ViewValue, 2, -2, -2, -2);
        $this->QUANTITY->ViewCustomAttributes = "";

        // TASK_ID
        $this->TASK_ID->ViewValue = $this->TASK_ID->CurrentValue;
        $this->TASK_ID->ViewValue = FormatNumber($this->TASK_ID->ViewValue, 0, -2, -2, -2);
        $this->TASK_ID->ViewCustomAttributes = "";

        // TASK_NAME
        $this->TASK_NAME->ViewValue = $this->TASK_NAME->CurrentValue;
        $this->TASK_NAME->ViewCustomAttributes = "";

        // COMP_TYPE
        $this->COMP_TYPE->ViewValue = $this->COMP_TYPE->CurrentValue;
        $this->COMP_TYPE->ViewValue = FormatNumber($this->COMP_TYPE->ViewValue, 0, -2, -2, -2);
        $this->COMP_TYPE->ViewCustomAttributes = "";

        // COMPTYPE
        $this->COMPTYPE->ViewValue = $this->COMPTYPE->CurrentValue;
        $this->COMPTYPE->ViewCustomAttributes = "";

        // PERCENTAGE
        $this->PERCENTAGE->ViewValue = $this->PERCENTAGE->CurrentValue;
        $this->PERCENTAGE->ViewValue = FormatNumber($this->PERCENTAGE->ViewValue, 2, -2, -2, -2);
        $this->PERCENTAGE->ViewCustomAttributes = "";

        // FA_V
        $this->FA_V->ViewValue = $this->FA_V->CurrentValue;
        $this->FA_V->ViewValue = FormatNumber($this->FA_V->ViewValue, 0, -2, -2, -2);
        $this->FA_V->ViewCustomAttributes = "";

        // VALIDATED_DATE
        $this->VALIDATED_DATE->ViewValue = $this->VALIDATED_DATE->CurrentValue;
        $this->VALIDATED_DATE->ViewValue = FormatDateTime($this->VALIDATED_DATE->ViewValue, 0);
        $this->VALIDATED_DATE->ViewCustomAttributes = "";

        // ISVALID
        $this->ISVALID->ViewValue = $this->ISVALID->CurrentValue;
        $this->ISVALID->ViewCustomAttributes = "";

        // ACCEPTED
        $this->ACCEPTED->ViewValue = $this->ACCEPTED->CurrentValue;
        $this->ACCEPTED->ViewValue = FormatNumber($this->ACCEPTED->ViewValue, 2, -2, -2, -2);
        $this->ACCEPTED->ViewCustomAttributes = "";

        // PAID_DATE
        $this->PAID_DATE->ViewValue = $this->PAID_DATE->CurrentValue;
        $this->PAID_DATE->ViewValue = FormatDateTime($this->PAID_DATE->ViewValue, 0);
        $this->PAID_DATE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->ViewValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->ViewCustomAttributes = "";

        // status_pasien_id
        $this->status_pasien_id->ViewValue = $this->status_pasien_id->CurrentValue;
        $this->status_pasien_id->ViewValue = FormatNumber($this->status_pasien_id->ViewValue, 0, -2, -2, -2);
        $this->status_pasien_id->ViewCustomAttributes = "";

        // ORG_UNIT_CODE
        $this->ORG_UNIT_CODE->LinkCustomAttributes = "";
        $this->ORG_UNIT_CODE->HrefValue = "";
        $this->ORG_UNIT_CODE->TooltipValue = "";

        // BILL_ID
        $this->BILL_ID->LinkCustomAttributes = "";
        $this->BILL_ID->HrefValue = "";
        $this->BILL_ID->TooltipValue = "";

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->LinkCustomAttributes = "";
        $this->EMPLOYEE_ID->HrefValue = "";
        $this->EMPLOYEE_ID->TooltipValue = "";

        // NO_REGISTRATION
        $this->NO_REGISTRATION->LinkCustomAttributes = "";
        $this->NO_REGISTRATION->HrefValue = "";
        $this->NO_REGISTRATION->TooltipValue = "";

        // VISIT_ID
        $this->VISIT_ID->LinkCustomAttributes = "";
        $this->VISIT_ID->HrefValue = "";
        $this->VISIT_ID->TooltipValue = "";

        // CLINIC_ID
        $this->CLINIC_ID->LinkCustomAttributes = "";
        $this->CLINIC_ID->HrefValue = "";
        $this->CLINIC_ID->TooltipValue = "";

        // TARIF_ID
        $this->TARIF_ID->LinkCustomAttributes = "";
        $this->TARIF_ID->HrefValue = "";
        $this->TARIF_ID->TooltipValue = "";

        // TARIF_NAME
        $this->TARIF_NAME->LinkCustomAttributes = "";
        $this->TARIF_NAME->HrefValue = "";
        $this->TARIF_NAME->TooltipValue = "";

        // TREAT_DATE
        $this->TREAT_DATE->LinkCustomAttributes = "";
        $this->TREAT_DATE->HrefValue = "";
        $this->TREAT_DATE->TooltipValue = "";

        // COMP_ID
        $this->COMP_ID->LinkCustomAttributes = "";
        $this->COMP_ID->HrefValue = "";
        $this->COMP_ID->TooltipValue = "";

        // COMP_NAME
        $this->COMP_NAME->LinkCustomAttributes = "";
        $this->COMP_NAME->HrefValue = "";
        $this->COMP_NAME->TooltipValue = "";

        // AMOUNT
        $this->AMOUNT->LinkCustomAttributes = "";
        $this->AMOUNT->HrefValue = "";
        $this->AMOUNT->TooltipValue = "";

        // QUANTITY
        $this->QUANTITY->LinkCustomAttributes = "";
        $this->QUANTITY->HrefValue = "";
        $this->QUANTITY->TooltipValue = "";

        // TASK_ID
        $this->TASK_ID->LinkCustomAttributes = "";
        $this->TASK_ID->HrefValue = "";
        $this->TASK_ID->TooltipValue = "";

        // TASK_NAME
        $this->TASK_NAME->LinkCustomAttributes = "";
        $this->TASK_NAME->HrefValue = "";
        $this->TASK_NAME->TooltipValue = "";

        // COMP_TYPE
        $this->COMP_TYPE->LinkCustomAttributes = "";
        $this->COMP_TYPE->HrefValue = "";
        $this->COMP_TYPE->TooltipValue = "";

        // COMPTYPE
        $this->COMPTYPE->LinkCustomAttributes = "";
        $this->COMPTYPE->HrefValue = "";
        $this->COMPTYPE->TooltipValue = "";

        // PERCENTAGE
        $this->PERCENTAGE->LinkCustomAttributes = "";
        $this->PERCENTAGE->HrefValue = "";
        $this->PERCENTAGE->TooltipValue = "";

        // FA_V
        $this->FA_V->LinkCustomAttributes = "";
        $this->FA_V->HrefValue = "";
        $this->FA_V->TooltipValue = "";

        // VALIDATED_DATE
        $this->VALIDATED_DATE->LinkCustomAttributes = "";
        $this->VALIDATED_DATE->HrefValue = "";
        $this->VALIDATED_DATE->TooltipValue = "";

        // ISVALID
        $this->ISVALID->LinkCustomAttributes = "";
        $this->ISVALID->HrefValue = "";
        $this->ISVALID->TooltipValue = "";

        // ACCEPTED
        $this->ACCEPTED->LinkCustomAttributes = "";
        $this->ACCEPTED->HrefValue = "";
        $this->ACCEPTED->TooltipValue = "";

        // PAID_DATE
        $this->PAID_DATE->LinkCustomAttributes = "";
        $this->PAID_DATE->HrefValue = "";
        $this->PAID_DATE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // MODIFIED_FROM
        $this->MODIFIED_FROM->LinkCustomAttributes = "";
        $this->MODIFIED_FROM->HrefValue = "";
        $this->MODIFIED_FROM->TooltipValue = "";

        // status_pasien_id
        $this->status_pasien_id->LinkCustomAttributes = "";
        $this->status_pasien_id->HrefValue = "";
        $this->status_pasien_id->TooltipValue = "";

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

        // BILL_ID
        $this->BILL_ID->EditAttrs["class"] = "form-control";
        $this->BILL_ID->EditCustomAttributes = "";
        if (!$this->BILL_ID->Raw) {
            $this->BILL_ID->CurrentValue = HtmlDecode($this->BILL_ID->CurrentValue);
        }
        $this->BILL_ID->EditValue = $this->BILL_ID->CurrentValue;
        $this->BILL_ID->PlaceHolder = RemoveHtml($this->BILL_ID->caption());

        // EMPLOYEE_ID
        $this->EMPLOYEE_ID->EditAttrs["class"] = "form-control";
        $this->EMPLOYEE_ID->EditCustomAttributes = "";
        if (!$this->EMPLOYEE_ID->Raw) {
            $this->EMPLOYEE_ID->CurrentValue = HtmlDecode($this->EMPLOYEE_ID->CurrentValue);
        }
        $this->EMPLOYEE_ID->EditValue = $this->EMPLOYEE_ID->CurrentValue;
        $this->EMPLOYEE_ID->PlaceHolder = RemoveHtml($this->EMPLOYEE_ID->caption());

        // NO_REGISTRATION
        $this->NO_REGISTRATION->EditAttrs["class"] = "form-control";
        $this->NO_REGISTRATION->EditCustomAttributes = "";
        if (!$this->NO_REGISTRATION->Raw) {
            $this->NO_REGISTRATION->CurrentValue = HtmlDecode($this->NO_REGISTRATION->CurrentValue);
        }
        $this->NO_REGISTRATION->EditValue = $this->NO_REGISTRATION->CurrentValue;
        $this->NO_REGISTRATION->PlaceHolder = RemoveHtml($this->NO_REGISTRATION->caption());

        // VISIT_ID
        $this->VISIT_ID->EditAttrs["class"] = "form-control";
        $this->VISIT_ID->EditCustomAttributes = "";
        if (!$this->VISIT_ID->Raw) {
            $this->VISIT_ID->CurrentValue = HtmlDecode($this->VISIT_ID->CurrentValue);
        }
        $this->VISIT_ID->EditValue = $this->VISIT_ID->CurrentValue;
        $this->VISIT_ID->PlaceHolder = RemoveHtml($this->VISIT_ID->caption());

        // CLINIC_ID
        $this->CLINIC_ID->EditAttrs["class"] = "form-control";
        $this->CLINIC_ID->EditCustomAttributes = "";
        if (!$this->CLINIC_ID->Raw) {
            $this->CLINIC_ID->CurrentValue = HtmlDecode($this->CLINIC_ID->CurrentValue);
        }
        $this->CLINIC_ID->EditValue = $this->CLINIC_ID->CurrentValue;
        $this->CLINIC_ID->PlaceHolder = RemoveHtml($this->CLINIC_ID->caption());

        // TARIF_ID
        $this->TARIF_ID->EditAttrs["class"] = "form-control";
        $this->TARIF_ID->EditCustomAttributes = "";
        if (!$this->TARIF_ID->Raw) {
            $this->TARIF_ID->CurrentValue = HtmlDecode($this->TARIF_ID->CurrentValue);
        }
        $this->TARIF_ID->EditValue = $this->TARIF_ID->CurrentValue;
        $this->TARIF_ID->PlaceHolder = RemoveHtml($this->TARIF_ID->caption());

        // TARIF_NAME
        $this->TARIF_NAME->EditAttrs["class"] = "form-control";
        $this->TARIF_NAME->EditCustomAttributes = "";
        if (!$this->TARIF_NAME->Raw) {
            $this->TARIF_NAME->CurrentValue = HtmlDecode($this->TARIF_NAME->CurrentValue);
        }
        $this->TARIF_NAME->EditValue = $this->TARIF_NAME->CurrentValue;
        $this->TARIF_NAME->PlaceHolder = RemoveHtml($this->TARIF_NAME->caption());

        // TREAT_DATE
        $this->TREAT_DATE->EditAttrs["class"] = "form-control";
        $this->TREAT_DATE->EditCustomAttributes = "";
        $this->TREAT_DATE->EditValue = FormatDateTime($this->TREAT_DATE->CurrentValue, 8);
        $this->TREAT_DATE->PlaceHolder = RemoveHtml($this->TREAT_DATE->caption());

        // COMP_ID
        $this->COMP_ID->EditAttrs["class"] = "form-control";
        $this->COMP_ID->EditCustomAttributes = "";
        $this->COMP_ID->EditValue = $this->COMP_ID->CurrentValue;
        $this->COMP_ID->PlaceHolder = RemoveHtml($this->COMP_ID->caption());

        // COMP_NAME
        $this->COMP_NAME->EditAttrs["class"] = "form-control";
        $this->COMP_NAME->EditCustomAttributes = "";
        if (!$this->COMP_NAME->Raw) {
            $this->COMP_NAME->CurrentValue = HtmlDecode($this->COMP_NAME->CurrentValue);
        }
        $this->COMP_NAME->EditValue = $this->COMP_NAME->CurrentValue;
        $this->COMP_NAME->PlaceHolder = RemoveHtml($this->COMP_NAME->caption());

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

        // TASK_ID
        $this->TASK_ID->EditAttrs["class"] = "form-control";
        $this->TASK_ID->EditCustomAttributes = "";
        $this->TASK_ID->EditValue = $this->TASK_ID->CurrentValue;
        $this->TASK_ID->PlaceHolder = RemoveHtml($this->TASK_ID->caption());

        // TASK_NAME
        $this->TASK_NAME->EditAttrs["class"] = "form-control";
        $this->TASK_NAME->EditCustomAttributes = "";
        if (!$this->TASK_NAME->Raw) {
            $this->TASK_NAME->CurrentValue = HtmlDecode($this->TASK_NAME->CurrentValue);
        }
        $this->TASK_NAME->EditValue = $this->TASK_NAME->CurrentValue;
        $this->TASK_NAME->PlaceHolder = RemoveHtml($this->TASK_NAME->caption());

        // COMP_TYPE
        $this->COMP_TYPE->EditAttrs["class"] = "form-control";
        $this->COMP_TYPE->EditCustomAttributes = "";
        $this->COMP_TYPE->EditValue = $this->COMP_TYPE->CurrentValue;
        $this->COMP_TYPE->PlaceHolder = RemoveHtml($this->COMP_TYPE->caption());

        // COMPTYPE
        $this->COMPTYPE->EditAttrs["class"] = "form-control";
        $this->COMPTYPE->EditCustomAttributes = "";
        if (!$this->COMPTYPE->Raw) {
            $this->COMPTYPE->CurrentValue = HtmlDecode($this->COMPTYPE->CurrentValue);
        }
        $this->COMPTYPE->EditValue = $this->COMPTYPE->CurrentValue;
        $this->COMPTYPE->PlaceHolder = RemoveHtml($this->COMPTYPE->caption());

        // PERCENTAGE
        $this->PERCENTAGE->EditAttrs["class"] = "form-control";
        $this->PERCENTAGE->EditCustomAttributes = "";
        $this->PERCENTAGE->EditValue = $this->PERCENTAGE->CurrentValue;
        $this->PERCENTAGE->PlaceHolder = RemoveHtml($this->PERCENTAGE->caption());
        if (strval($this->PERCENTAGE->EditValue) != "" && is_numeric($this->PERCENTAGE->EditValue)) {
            $this->PERCENTAGE->EditValue = FormatNumber($this->PERCENTAGE->EditValue, -2, -2, -2, -2);
        }

        // FA_V
        $this->FA_V->EditAttrs["class"] = "form-control";
        $this->FA_V->EditCustomAttributes = "";
        $this->FA_V->EditValue = $this->FA_V->CurrentValue;
        $this->FA_V->PlaceHolder = RemoveHtml($this->FA_V->caption());

        // VALIDATED_DATE
        $this->VALIDATED_DATE->EditAttrs["class"] = "form-control";
        $this->VALIDATED_DATE->EditCustomAttributes = "";
        $this->VALIDATED_DATE->EditValue = FormatDateTime($this->VALIDATED_DATE->CurrentValue, 8);
        $this->VALIDATED_DATE->PlaceHolder = RemoveHtml($this->VALIDATED_DATE->caption());

        // ISVALID
        $this->ISVALID->EditAttrs["class"] = "form-control";
        $this->ISVALID->EditCustomAttributes = "";
        if (!$this->ISVALID->Raw) {
            $this->ISVALID->CurrentValue = HtmlDecode($this->ISVALID->CurrentValue);
        }
        $this->ISVALID->EditValue = $this->ISVALID->CurrentValue;
        $this->ISVALID->PlaceHolder = RemoveHtml($this->ISVALID->caption());

        // ACCEPTED
        $this->ACCEPTED->EditAttrs["class"] = "form-control";
        $this->ACCEPTED->EditCustomAttributes = "";
        $this->ACCEPTED->EditValue = $this->ACCEPTED->CurrentValue;
        $this->ACCEPTED->PlaceHolder = RemoveHtml($this->ACCEPTED->caption());
        if (strval($this->ACCEPTED->EditValue) != "" && is_numeric($this->ACCEPTED->EditValue)) {
            $this->ACCEPTED->EditValue = FormatNumber($this->ACCEPTED->EditValue, -2, -2, -2, -2);
        }

        // PAID_DATE
        $this->PAID_DATE->EditAttrs["class"] = "form-control";
        $this->PAID_DATE->EditCustomAttributes = "";
        $this->PAID_DATE->EditValue = FormatDateTime($this->PAID_DATE->CurrentValue, 8);
        $this->PAID_DATE->PlaceHolder = RemoveHtml($this->PAID_DATE->caption());

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

        // MODIFIED_FROM
        $this->MODIFIED_FROM->EditAttrs["class"] = "form-control";
        $this->MODIFIED_FROM->EditCustomAttributes = "";
        if (!$this->MODIFIED_FROM->Raw) {
            $this->MODIFIED_FROM->CurrentValue = HtmlDecode($this->MODIFIED_FROM->CurrentValue);
        }
        $this->MODIFIED_FROM->EditValue = $this->MODIFIED_FROM->CurrentValue;
        $this->MODIFIED_FROM->PlaceHolder = RemoveHtml($this->MODIFIED_FROM->caption());

        // status_pasien_id
        $this->status_pasien_id->EditAttrs["class"] = "form-control";
        $this->status_pasien_id->EditCustomAttributes = "";
        $this->status_pasien_id->EditValue = $this->status_pasien_id->CurrentValue;
        $this->status_pasien_id->PlaceHolder = RemoveHtml($this->status_pasien_id->caption());

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
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->TARIF_NAME);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->COMP_ID);
                    $doc->exportCaption($this->COMP_NAME);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->TASK_ID);
                    $doc->exportCaption($this->TASK_NAME);
                    $doc->exportCaption($this->COMP_TYPE);
                    $doc->exportCaption($this->COMPTYPE);
                    $doc->exportCaption($this->PERCENTAGE);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->VALIDATED_DATE);
                    $doc->exportCaption($this->ISVALID);
                    $doc->exportCaption($this->ACCEPTED);
                    $doc->exportCaption($this->PAID_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->status_pasien_id);
                } else {
                    $doc->exportCaption($this->ORG_UNIT_CODE);
                    $doc->exportCaption($this->BILL_ID);
                    $doc->exportCaption($this->EMPLOYEE_ID);
                    $doc->exportCaption($this->NO_REGISTRATION);
                    $doc->exportCaption($this->VISIT_ID);
                    $doc->exportCaption($this->CLINIC_ID);
                    $doc->exportCaption($this->TARIF_ID);
                    $doc->exportCaption($this->TARIF_NAME);
                    $doc->exportCaption($this->TREAT_DATE);
                    $doc->exportCaption($this->COMP_ID);
                    $doc->exportCaption($this->COMP_NAME);
                    $doc->exportCaption($this->AMOUNT);
                    $doc->exportCaption($this->QUANTITY);
                    $doc->exportCaption($this->TASK_ID);
                    $doc->exportCaption($this->TASK_NAME);
                    $doc->exportCaption($this->COMP_TYPE);
                    $doc->exportCaption($this->COMPTYPE);
                    $doc->exportCaption($this->PERCENTAGE);
                    $doc->exportCaption($this->FA_V);
                    $doc->exportCaption($this->VALIDATED_DATE);
                    $doc->exportCaption($this->ISVALID);
                    $doc->exportCaption($this->ACCEPTED);
                    $doc->exportCaption($this->PAID_DATE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->MODIFIED_FROM);
                    $doc->exportCaption($this->status_pasien_id);
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
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->TARIF_NAME);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->COMP_ID);
                        $doc->exportField($this->COMP_NAME);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->TASK_ID);
                        $doc->exportField($this->TASK_NAME);
                        $doc->exportField($this->COMP_TYPE);
                        $doc->exportField($this->COMPTYPE);
                        $doc->exportField($this->PERCENTAGE);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->VALIDATED_DATE);
                        $doc->exportField($this->ISVALID);
                        $doc->exportField($this->ACCEPTED);
                        $doc->exportField($this->PAID_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->status_pasien_id);
                    } else {
                        $doc->exportField($this->ORG_UNIT_CODE);
                        $doc->exportField($this->BILL_ID);
                        $doc->exportField($this->EMPLOYEE_ID);
                        $doc->exportField($this->NO_REGISTRATION);
                        $doc->exportField($this->VISIT_ID);
                        $doc->exportField($this->CLINIC_ID);
                        $doc->exportField($this->TARIF_ID);
                        $doc->exportField($this->TARIF_NAME);
                        $doc->exportField($this->TREAT_DATE);
                        $doc->exportField($this->COMP_ID);
                        $doc->exportField($this->COMP_NAME);
                        $doc->exportField($this->AMOUNT);
                        $doc->exportField($this->QUANTITY);
                        $doc->exportField($this->TASK_ID);
                        $doc->exportField($this->TASK_NAME);
                        $doc->exportField($this->COMP_TYPE);
                        $doc->exportField($this->COMPTYPE);
                        $doc->exportField($this->PERCENTAGE);
                        $doc->exportField($this->FA_V);
                        $doc->exportField($this->VALIDATED_DATE);
                        $doc->exportField($this->ISVALID);
                        $doc->exportField($this->ACCEPTED);
                        $doc->exportField($this->PAID_DATE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->MODIFIED_FROM);
                        $doc->exportField($this->status_pasien_id);
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
