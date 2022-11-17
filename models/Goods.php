<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for GOODS
 */
class Goods extends DbTable
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
    public $CODE_5;
    public $BRAND_ID;
    public $NAME;
    public $OTHER_CODE;
    public $_BARCODE;
    public $DESCRIPTION;
    public $REORDER_POINT;
    public $SIZE_GOODS;
    public $MEASURE_DOSIS;
    public $MEASURE_ID;
    public $MEASURE_ID2;
    public $SIZE_KEMASAN;
    public $MEASURE_ID3;
    public $COMPANY_ID;
    public $NET_PRICE;
    public $MODIFIED_DATE;
    public $MODIFIED_BY;
    public $TH;
    public $STATUS_PASIEN_ID;
    public $MATERIAL_ID;
    public $FORM_ID;
    public $ISGENERIC;
    public $REGULATE_ID;
    public $PREGNANCY_INDEX;
    public $INDICATION;
    public $TAKE_RULE;
    public $SIDE_EFFECT;
    public $INTERACTION;
    public $CONTRA_INDICATION;
    public $WARNING;
    public $STOCK;
    public $ISACTIVE;
    public $ISALKES;
    public $SIZE_ORDER;
    public $ORDER_PRICE;
    public $ISFORMULARIUM;
    public $ISESSENTIAL;
    public $AVGDATE;
    public $STOCK_MINIMAL;
    public $STOCK_MINIMAL_APT;
    public $HET;
    public $default_margin;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'GOODS';
        $this->TableName = 'GOODS';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "[dbo].[GOODS]";
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

        // CODE_5
        $this->CODE_5 = new DbField('GOODS', 'GOODS', 'x_CODE_5', 'CODE_5', '[CODE_5]', '[CODE_5]', 200, 20, -1, false, '[CODE_5]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CODE_5->Nullable = false; // NOT NULL field
        $this->CODE_5->Required = true; // Required field
        $this->CODE_5->Sortable = true; // Allow sort
        $this->CODE_5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CODE_5->Param, "CustomMsg");
        $this->Fields['CODE_5'] = &$this->CODE_5;

        // BRAND_ID
        $this->BRAND_ID = new DbField('GOODS', 'GOODS', 'x_BRAND_ID', 'BRAND_ID', '[BRAND_ID]', '[BRAND_ID]', 200, 50, -1, false, '[BRAND_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->BRAND_ID->IsPrimaryKey = true; // Primary key field
        $this->BRAND_ID->Nullable = false; // NOT NULL field
        $this->BRAND_ID->Required = true; // Required field
        $this->BRAND_ID->Sortable = true; // Allow sort
        $this->BRAND_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->BRAND_ID->Param, "CustomMsg");
        $this->Fields['BRAND_ID'] = &$this->BRAND_ID;

        // NAME
        $this->NAME = new DbField('GOODS', 'GOODS', 'x_NAME', 'NAME', '[NAME]', '[NAME]', 200, 200, -1, false, '[NAME]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAME->Sortable = true; // Allow sort
        $this->NAME->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAME->Param, "CustomMsg");
        $this->Fields['NAME'] = &$this->NAME;

        // OTHER_CODE
        $this->OTHER_CODE = new DbField('GOODS', 'GOODS', 'x_OTHER_CODE', 'OTHER_CODE', '[OTHER_CODE]', '[OTHER_CODE]', 200, 25, -1, false, '[OTHER_CODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OTHER_CODE->Sortable = true; // Allow sort
        $this->OTHER_CODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OTHER_CODE->Param, "CustomMsg");
        $this->Fields['OTHER_CODE'] = &$this->OTHER_CODE;

        // BARCODE
        $this->_BARCODE = new DbField('GOODS', 'GOODS', 'x__BARCODE', 'BARCODE', '[BARCODE]', '[BARCODE]', 200, 50, -1, false, '[BARCODE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_BARCODE->Sortable = true; // Allow sort
        $this->_BARCODE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_BARCODE->Param, "CustomMsg");
        $this->Fields['BARCODE'] = &$this->_BARCODE;

        // DESCRIPTION
        $this->DESCRIPTION = new DbField('GOODS', 'GOODS', 'x_DESCRIPTION', 'DESCRIPTION', '[DESCRIPTION]', '[DESCRIPTION]', 200, 200, -1, false, '[DESCRIPTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DESCRIPTION->Sortable = true; // Allow sort
        $this->DESCRIPTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DESCRIPTION->Param, "CustomMsg");
        $this->Fields['DESCRIPTION'] = &$this->DESCRIPTION;

        // REORDER_POINT
        $this->REORDER_POINT = new DbField('GOODS', 'GOODS', 'x_REORDER_POINT', 'REORDER_POINT', '[REORDER_POINT]', 'CAST([REORDER_POINT] AS NVARCHAR)', 131, 8, -1, false, '[REORDER_POINT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REORDER_POINT->Sortable = true; // Allow sort
        $this->REORDER_POINT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->REORDER_POINT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->REORDER_POINT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REORDER_POINT->Param, "CustomMsg");
        $this->Fields['REORDER_POINT'] = &$this->REORDER_POINT;

        // SIZE_GOODS
        $this->SIZE_GOODS = new DbField('GOODS', 'GOODS', 'x_SIZE_GOODS', 'SIZE_GOODS', '[SIZE_GOODS]', 'CAST([SIZE_GOODS] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_GOODS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_GOODS->Sortable = true; // Allow sort
        $this->SIZE_GOODS->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_GOODS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_GOODS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_GOODS->Param, "CustomMsg");
        $this->Fields['SIZE_GOODS'] = &$this->SIZE_GOODS;

        // MEASURE_DOSIS
        $this->MEASURE_DOSIS = new DbField('GOODS', 'GOODS', 'x_MEASURE_DOSIS', 'MEASURE_DOSIS', '[MEASURE_DOSIS]', 'CAST([MEASURE_DOSIS] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_DOSIS]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_DOSIS->Sortable = true; // Allow sort
        $this->MEASURE_DOSIS->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_DOSIS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_DOSIS->Param, "CustomMsg");
        $this->Fields['MEASURE_DOSIS'] = &$this->MEASURE_DOSIS;

        // MEASURE_ID
        $this->MEASURE_ID = new DbField('GOODS', 'GOODS', 'x_MEASURE_ID', 'MEASURE_ID', '[MEASURE_ID]', 'CAST([MEASURE_ID] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID->Sortable = true; // Allow sort
        $this->MEASURE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID->Param, "CustomMsg");
        $this->Fields['MEASURE_ID'] = &$this->MEASURE_ID;

        // MEASURE_ID2
        $this->MEASURE_ID2 = new DbField('GOODS', 'GOODS', 'x_MEASURE_ID2', 'MEASURE_ID2', '[MEASURE_ID2]', 'CAST([MEASURE_ID2] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID2]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID2->Sortable = true; // Allow sort
        $this->MEASURE_ID2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID2->Param, "CustomMsg");
        $this->Fields['MEASURE_ID2'] = &$this->MEASURE_ID2;

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN = new DbField('GOODS', 'GOODS', 'x_SIZE_KEMASAN', 'SIZE_KEMASAN', '[SIZE_KEMASAN]', 'CAST([SIZE_KEMASAN] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_KEMASAN]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_KEMASAN->Sortable = true; // Allow sort
        $this->SIZE_KEMASAN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_KEMASAN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_KEMASAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_KEMASAN->Param, "CustomMsg");
        $this->Fields['SIZE_KEMASAN'] = &$this->SIZE_KEMASAN;

        // MEASURE_ID3
        $this->MEASURE_ID3 = new DbField('GOODS', 'GOODS', 'x_MEASURE_ID3', 'MEASURE_ID3', '[MEASURE_ID3]', 'CAST([MEASURE_ID3] AS NVARCHAR)', 2, 2, -1, false, '[MEASURE_ID3]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MEASURE_ID3->Sortable = true; // Allow sort
        $this->MEASURE_ID3->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MEASURE_ID3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MEASURE_ID3->Param, "CustomMsg");
        $this->Fields['MEASURE_ID3'] = &$this->MEASURE_ID3;

        // COMPANY_ID
        $this->COMPANY_ID = new DbField('GOODS', 'GOODS', 'x_COMPANY_ID', 'COMPANY_ID', '[COMPANY_ID]', '[COMPANY_ID]', 200, 50, -1, false, '[COMPANY_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->COMPANY_ID->Sortable = true; // Allow sort
        $this->COMPANY_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->COMPANY_ID->Param, "CustomMsg");
        $this->Fields['COMPANY_ID'] = &$this->COMPANY_ID;

        // NET_PRICE
        $this->NET_PRICE = new DbField('GOODS', 'GOODS', 'x_NET_PRICE', 'NET_PRICE', '[NET_PRICE]', 'CAST([NET_PRICE] AS NVARCHAR)', 6, 8, -1, false, '[NET_PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NET_PRICE->Sortable = true; // Allow sort
        $this->NET_PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NET_PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NET_PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NET_PRICE->Param, "CustomMsg");
        $this->Fields['NET_PRICE'] = &$this->NET_PRICE;

        // MODIFIED_DATE
        $this->MODIFIED_DATE = new DbField('GOODS', 'GOODS', 'x_MODIFIED_DATE', 'MODIFIED_DATE', '[MODIFIED_DATE]', CastDateFieldForLike("[MODIFIED_DATE]", 0, "DB"), 135, 8, 0, false, '[MODIFIED_DATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_DATE->Sortable = true; // Allow sort
        $this->MODIFIED_DATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->MODIFIED_DATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_DATE->Param, "CustomMsg");
        $this->Fields['MODIFIED_DATE'] = &$this->MODIFIED_DATE;

        // MODIFIED_BY
        $this->MODIFIED_BY = new DbField('GOODS', 'GOODS', 'x_MODIFIED_BY', 'MODIFIED_BY', '[MODIFIED_BY]', '[MODIFIED_BY]', 200, 25, -1, false, '[MODIFIED_BY]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODIFIED_BY->Sortable = true; // Allow sort
        $this->MODIFIED_BY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODIFIED_BY->Param, "CustomMsg");
        $this->Fields['MODIFIED_BY'] = &$this->MODIFIED_BY;

        // TH
        $this->TH = new DbField('GOODS', 'GOODS', 'x_TH', 'TH', '[TH]', 'CAST([TH] AS NVARCHAR)', 2, 2, -1, false, '[TH]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TH->Sortable = true; // Allow sort
        $this->TH->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TH->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TH->Param, "CustomMsg");
        $this->Fields['TH'] = &$this->TH;

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID = new DbField('GOODS', 'GOODS', 'x_STATUS_PASIEN_ID', 'STATUS_PASIEN_ID', '[STATUS_PASIEN_ID]', 'CAST([STATUS_PASIEN_ID] AS NVARCHAR)', 17, 1, -1, false, '[STATUS_PASIEN_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_PASIEN_ID->Sortable = true; // Allow sort
        $this->STATUS_PASIEN_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->STATUS_PASIEN_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_PASIEN_ID->Param, "CustomMsg");
        $this->Fields['STATUS_PASIEN_ID'] = &$this->STATUS_PASIEN_ID;

        // MATERIAL_ID
        $this->MATERIAL_ID = new DbField('GOODS', 'GOODS', 'x_MATERIAL_ID', 'MATERIAL_ID', '[MATERIAL_ID]', 'CAST([MATERIAL_ID] AS NVARCHAR)', 17, 1, -1, false, '[MATERIAL_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MATERIAL_ID->Sortable = true; // Allow sort
        $this->MATERIAL_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->MATERIAL_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MATERIAL_ID->Param, "CustomMsg");
        $this->Fields['MATERIAL_ID'] = &$this->MATERIAL_ID;

        // FORM_ID
        $this->FORM_ID = new DbField('GOODS', 'GOODS', 'x_FORM_ID', 'FORM_ID', '[FORM_ID]', 'CAST([FORM_ID] AS NVARCHAR)', 17, 1, -1, false, '[FORM_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->FORM_ID->Sortable = true; // Allow sort
        $this->FORM_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->FORM_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->FORM_ID->Param, "CustomMsg");
        $this->Fields['FORM_ID'] = &$this->FORM_ID;

        // ISGENERIC
        $this->ISGENERIC = new DbField('GOODS', 'GOODS', 'x_ISGENERIC', 'ISGENERIC', '[ISGENERIC]', '[ISGENERIC]', 129, 1, -1, false, '[ISGENERIC]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISGENERIC->Sortable = true; // Allow sort
        $this->ISGENERIC->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISGENERIC->Param, "CustomMsg");
        $this->Fields['ISGENERIC'] = &$this->ISGENERIC;

        // REGULATE_ID
        $this->REGULATE_ID = new DbField('GOODS', 'GOODS', 'x_REGULATE_ID', 'REGULATE_ID', '[REGULATE_ID]', 'CAST([REGULATE_ID] AS NVARCHAR)', 17, 1, -1, false, '[REGULATE_ID]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->REGULATE_ID->Sortable = true; // Allow sort
        $this->REGULATE_ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->REGULATE_ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->REGULATE_ID->Param, "CustomMsg");
        $this->Fields['REGULATE_ID'] = &$this->REGULATE_ID;

        // PREGNANCY_INDEX
        $this->PREGNANCY_INDEX = new DbField('GOODS', 'GOODS', 'x_PREGNANCY_INDEX', 'PREGNANCY_INDEX', '[PREGNANCY_INDEX]', '[PREGNANCY_INDEX]', 129, 1, -1, false, '[PREGNANCY_INDEX]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PREGNANCY_INDEX->Sortable = true; // Allow sort
        $this->PREGNANCY_INDEX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PREGNANCY_INDEX->Param, "CustomMsg");
        $this->Fields['PREGNANCY_INDEX'] = &$this->PREGNANCY_INDEX;

        // INDICATION
        $this->INDICATION = new DbField('GOODS', 'GOODS', 'x_INDICATION', 'INDICATION', '[INDICATION]', '[INDICATION]', 200, 255, -1, false, '[INDICATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INDICATION->Sortable = true; // Allow sort
        $this->INDICATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INDICATION->Param, "CustomMsg");
        $this->Fields['INDICATION'] = &$this->INDICATION;

        // TAKE_RULE
        $this->TAKE_RULE = new DbField('GOODS', 'GOODS', 'x_TAKE_RULE', 'TAKE_RULE', '[TAKE_RULE]', '[TAKE_RULE]', 200, 255, -1, false, '[TAKE_RULE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TAKE_RULE->Sortable = true; // Allow sort
        $this->TAKE_RULE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TAKE_RULE->Param, "CustomMsg");
        $this->Fields['TAKE_RULE'] = &$this->TAKE_RULE;

        // SIDE_EFFECT
        $this->SIDE_EFFECT = new DbField('GOODS', 'GOODS', 'x_SIDE_EFFECT', 'SIDE_EFFECT', '[SIDE_EFFECT]', '[SIDE_EFFECT]', 200, 255, -1, false, '[SIDE_EFFECT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIDE_EFFECT->Sortable = true; // Allow sort
        $this->SIDE_EFFECT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIDE_EFFECT->Param, "CustomMsg");
        $this->Fields['SIDE_EFFECT'] = &$this->SIDE_EFFECT;

        // INTERACTION
        $this->INTERACTION = new DbField('GOODS', 'GOODS', 'x_INTERACTION', 'INTERACTION', '[INTERACTION]', '[INTERACTION]', 200, 255, -1, false, '[INTERACTION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->INTERACTION->Sortable = true; // Allow sort
        $this->INTERACTION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->INTERACTION->Param, "CustomMsg");
        $this->Fields['INTERACTION'] = &$this->INTERACTION;

        // CONTRA_INDICATION
        $this->CONTRA_INDICATION = new DbField('GOODS', 'GOODS', 'x_CONTRA_INDICATION', 'CONTRA_INDICATION', '[CONTRA_INDICATION]', '[CONTRA_INDICATION]', 200, 255, -1, false, '[CONTRA_INDICATION]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->CONTRA_INDICATION->Sortable = true; // Allow sort
        $this->CONTRA_INDICATION->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CONTRA_INDICATION->Param, "CustomMsg");
        $this->Fields['CONTRA_INDICATION'] = &$this->CONTRA_INDICATION;

        // WARNING
        $this->WARNING = new DbField('GOODS', 'GOODS', 'x_WARNING', 'WARNING', '[WARNING]', '[WARNING]', 200, 255, -1, false, '[WARNING]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->WARNING->Sortable = true; // Allow sort
        $this->WARNING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->WARNING->Param, "CustomMsg");
        $this->Fields['WARNING'] = &$this->WARNING;

        // STOCK
        $this->STOCK = new DbField('GOODS', 'GOODS', 'x_STOCK', 'STOCK', '[STOCK]', 'CAST([STOCK] AS NVARCHAR)', 131, 8, -1, false, '[STOCK]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK->Sortable = true; // Allow sort
        $this->STOCK->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK->Param, "CustomMsg");
        $this->Fields['STOCK'] = &$this->STOCK;

        // ISACTIVE
        $this->ISACTIVE = new DbField('GOODS', 'GOODS', 'x_ISACTIVE', 'ISACTIVE', '[ISACTIVE]', '[ISACTIVE]', 129, 1, -1, false, '[ISACTIVE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISACTIVE->Sortable = true; // Allow sort
        $this->ISACTIVE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISACTIVE->Param, "CustomMsg");
        $this->Fields['ISACTIVE'] = &$this->ISACTIVE;

        // ISALKES
        $this->ISALKES = new DbField('GOODS', 'GOODS', 'x_ISALKES', 'ISALKES', '[ISALKES]', '[ISALKES]', 129, 3, -1, false, '[ISALKES]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISALKES->Sortable = true; // Allow sort
        $this->ISALKES->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISALKES->Param, "CustomMsg");
        $this->Fields['ISALKES'] = &$this->ISALKES;

        // SIZE_ORDER
        $this->SIZE_ORDER = new DbField('GOODS', 'GOODS', 'x_SIZE_ORDER', 'SIZE_ORDER', '[SIZE_ORDER]', 'CAST([SIZE_ORDER] AS NVARCHAR)', 131, 8, -1, false, '[SIZE_ORDER]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SIZE_ORDER->Sortable = true; // Allow sort
        $this->SIZE_ORDER->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SIZE_ORDER->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SIZE_ORDER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SIZE_ORDER->Param, "CustomMsg");
        $this->Fields['SIZE_ORDER'] = &$this->SIZE_ORDER;

        // ORDER_PRICE
        $this->ORDER_PRICE = new DbField('GOODS', 'GOODS', 'x_ORDER_PRICE', 'ORDER_PRICE', '[ORDER_PRICE]', 'CAST([ORDER_PRICE] AS NVARCHAR)', 6, 8, -1, false, '[ORDER_PRICE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ORDER_PRICE->Sortable = true; // Allow sort
        $this->ORDER_PRICE->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ORDER_PRICE->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ORDER_PRICE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ORDER_PRICE->Param, "CustomMsg");
        $this->Fields['ORDER_PRICE'] = &$this->ORDER_PRICE;

        // ISFORMULARIUM
        $this->ISFORMULARIUM = new DbField('GOODS', 'GOODS', 'x_ISFORMULARIUM', 'ISFORMULARIUM', '[ISFORMULARIUM]', '[ISFORMULARIUM]', 129, 1, -1, false, '[ISFORMULARIUM]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISFORMULARIUM->Sortable = true; // Allow sort
        $this->ISFORMULARIUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISFORMULARIUM->Param, "CustomMsg");
        $this->Fields['ISFORMULARIUM'] = &$this->ISFORMULARIUM;

        // ISESSENTIAL
        $this->ISESSENTIAL = new DbField('GOODS', 'GOODS', 'x_ISESSENTIAL', 'ISESSENTIAL', '[ISESSENTIAL]', '[ISESSENTIAL]', 129, 1, -1, false, '[ISESSENTIAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ISESSENTIAL->Sortable = true; // Allow sort
        $this->ISESSENTIAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ISESSENTIAL->Param, "CustomMsg");
        $this->Fields['ISESSENTIAL'] = &$this->ISESSENTIAL;

        // AVGDATE
        $this->AVGDATE = new DbField('GOODS', 'GOODS', 'x_AVGDATE', 'AVGDATE', '[AVGDATE]', CastDateFieldForLike("[AVGDATE]", 0, "DB"), 135, 8, 0, false, '[AVGDATE]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AVGDATE->Sortable = true; // Allow sort
        $this->AVGDATE->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->AVGDATE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AVGDATE->Param, "CustomMsg");
        $this->Fields['AVGDATE'] = &$this->AVGDATE;

        // STOCK_MINIMAL
        $this->STOCK_MINIMAL = new DbField('GOODS', 'GOODS', 'x_STOCK_MINIMAL', 'STOCK_MINIMAL', '[STOCK_MINIMAL]', 'CAST([STOCK_MINIMAL] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_MINIMAL]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_MINIMAL->Sortable = true; // Allow sort
        $this->STOCK_MINIMAL->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_MINIMAL->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_MINIMAL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_MINIMAL->Param, "CustomMsg");
        $this->Fields['STOCK_MINIMAL'] = &$this->STOCK_MINIMAL;

        // STOCK_MINIMAL_APT
        $this->STOCK_MINIMAL_APT = new DbField('GOODS', 'GOODS', 'x_STOCK_MINIMAL_APT', 'STOCK_MINIMAL_APT', '[STOCK_MINIMAL_APT]', 'CAST([STOCK_MINIMAL_APT] AS NVARCHAR)', 131, 8, -1, false, '[STOCK_MINIMAL_APT]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STOCK_MINIMAL_APT->Sortable = true; // Allow sort
        $this->STOCK_MINIMAL_APT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->STOCK_MINIMAL_APT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->STOCK_MINIMAL_APT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STOCK_MINIMAL_APT->Param, "CustomMsg");
        $this->Fields['STOCK_MINIMAL_APT'] = &$this->STOCK_MINIMAL_APT;

        // HET
        $this->HET = new DbField('GOODS', 'GOODS', 'x_HET', 'HET', '[HET]', 'CAST([HET] AS NVARCHAR)', 131, 8, -1, false, '[HET]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->HET->Sortable = true; // Allow sort
        $this->HET->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->HET->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->HET->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->HET->Param, "CustomMsg");
        $this->Fields['HET'] = &$this->HET;

        // default_margin
        $this->default_margin = new DbField('GOODS', 'GOODS', 'x_default_margin', 'default_margin', '[default_margin]', '[default_margin]', 129, 1, -1, false, '[default_margin]', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->default_margin->Sortable = true; // Allow sort
        $this->default_margin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->default_margin->Param, "CustomMsg");
        $this->Fields['default_margin'] = &$this->default_margin;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[GOODS]";
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
            if (array_key_exists('BRAND_ID', $rs)) {
                AddFilter($where, QuotedName('BRAND_ID', $this->Dbid) . '=' . QuotedValue($rs['BRAND_ID'], $this->BRAND_ID->DataType, $this->Dbid));
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
        $this->CODE_5->DbValue = $row['CODE_5'];
        $this->BRAND_ID->DbValue = $row['BRAND_ID'];
        $this->NAME->DbValue = $row['NAME'];
        $this->OTHER_CODE->DbValue = $row['OTHER_CODE'];
        $this->_BARCODE->DbValue = $row['BARCODE'];
        $this->DESCRIPTION->DbValue = $row['DESCRIPTION'];
        $this->REORDER_POINT->DbValue = $row['REORDER_POINT'];
        $this->SIZE_GOODS->DbValue = $row['SIZE_GOODS'];
        $this->MEASURE_DOSIS->DbValue = $row['MEASURE_DOSIS'];
        $this->MEASURE_ID->DbValue = $row['MEASURE_ID'];
        $this->MEASURE_ID2->DbValue = $row['MEASURE_ID2'];
        $this->SIZE_KEMASAN->DbValue = $row['SIZE_KEMASAN'];
        $this->MEASURE_ID3->DbValue = $row['MEASURE_ID3'];
        $this->COMPANY_ID->DbValue = $row['COMPANY_ID'];
        $this->NET_PRICE->DbValue = $row['NET_PRICE'];
        $this->MODIFIED_DATE->DbValue = $row['MODIFIED_DATE'];
        $this->MODIFIED_BY->DbValue = $row['MODIFIED_BY'];
        $this->TH->DbValue = $row['TH'];
        $this->STATUS_PASIEN_ID->DbValue = $row['STATUS_PASIEN_ID'];
        $this->MATERIAL_ID->DbValue = $row['MATERIAL_ID'];
        $this->FORM_ID->DbValue = $row['FORM_ID'];
        $this->ISGENERIC->DbValue = $row['ISGENERIC'];
        $this->REGULATE_ID->DbValue = $row['REGULATE_ID'];
        $this->PREGNANCY_INDEX->DbValue = $row['PREGNANCY_INDEX'];
        $this->INDICATION->DbValue = $row['INDICATION'];
        $this->TAKE_RULE->DbValue = $row['TAKE_RULE'];
        $this->SIDE_EFFECT->DbValue = $row['SIDE_EFFECT'];
        $this->INTERACTION->DbValue = $row['INTERACTION'];
        $this->CONTRA_INDICATION->DbValue = $row['CONTRA_INDICATION'];
        $this->WARNING->DbValue = $row['WARNING'];
        $this->STOCK->DbValue = $row['STOCK'];
        $this->ISACTIVE->DbValue = $row['ISACTIVE'];
        $this->ISALKES->DbValue = $row['ISALKES'];
        $this->SIZE_ORDER->DbValue = $row['SIZE_ORDER'];
        $this->ORDER_PRICE->DbValue = $row['ORDER_PRICE'];
        $this->ISFORMULARIUM->DbValue = $row['ISFORMULARIUM'];
        $this->ISESSENTIAL->DbValue = $row['ISESSENTIAL'];
        $this->AVGDATE->DbValue = $row['AVGDATE'];
        $this->STOCK_MINIMAL->DbValue = $row['STOCK_MINIMAL'];
        $this->STOCK_MINIMAL_APT->DbValue = $row['STOCK_MINIMAL_APT'];
        $this->HET->DbValue = $row['HET'];
        $this->default_margin->DbValue = $row['default_margin'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "[BRAND_ID] = '@BRAND_ID@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->BRAND_ID->CurrentValue : $this->BRAND_ID->OldValue;
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
                $this->BRAND_ID->CurrentValue = $keys[0];
            } else {
                $this->BRAND_ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('BRAND_ID', $row) ? $row['BRAND_ID'] : null;
        } else {
            $val = $this->BRAND_ID->OldValue !== null ? $this->BRAND_ID->OldValue : $this->BRAND_ID->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@BRAND_ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("GoodsList");
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
        if ($pageName == "GoodsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GoodsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GoodsAdd") {
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
                return "GoodsView";
            case Config("API_ADD_ACTION"):
                return "GoodsAdd";
            case Config("API_EDIT_ACTION"):
                return "GoodsEdit";
            case Config("API_DELETE_ACTION"):
                return "GoodsDelete";
            case Config("API_LIST_ACTION"):
                return "GoodsList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GoodsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GoodsView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GoodsView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GoodsAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GoodsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GoodsEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("GoodsAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("GoodsDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "BRAND_ID:" . JsonEncode($this->BRAND_ID->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->BRAND_ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->BRAND_ID->CurrentValue);
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
            if (($keyValue = Param("BRAND_ID") ?? Route("BRAND_ID")) !== null) {
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
                $this->BRAND_ID->CurrentValue = $key;
            } else {
                $this->BRAND_ID->OldValue = $key;
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
        $this->CODE_5->setDbValue($row['CODE_5']);
        $this->BRAND_ID->setDbValue($row['BRAND_ID']);
        $this->NAME->setDbValue($row['NAME']);
        $this->OTHER_CODE->setDbValue($row['OTHER_CODE']);
        $this->_BARCODE->setDbValue($row['BARCODE']);
        $this->DESCRIPTION->setDbValue($row['DESCRIPTION']);
        $this->REORDER_POINT->setDbValue($row['REORDER_POINT']);
        $this->SIZE_GOODS->setDbValue($row['SIZE_GOODS']);
        $this->MEASURE_DOSIS->setDbValue($row['MEASURE_DOSIS']);
        $this->MEASURE_ID->setDbValue($row['MEASURE_ID']);
        $this->MEASURE_ID2->setDbValue($row['MEASURE_ID2']);
        $this->SIZE_KEMASAN->setDbValue($row['SIZE_KEMASAN']);
        $this->MEASURE_ID3->setDbValue($row['MEASURE_ID3']);
        $this->COMPANY_ID->setDbValue($row['COMPANY_ID']);
        $this->NET_PRICE->setDbValue($row['NET_PRICE']);
        $this->MODIFIED_DATE->setDbValue($row['MODIFIED_DATE']);
        $this->MODIFIED_BY->setDbValue($row['MODIFIED_BY']);
        $this->TH->setDbValue($row['TH']);
        $this->STATUS_PASIEN_ID->setDbValue($row['STATUS_PASIEN_ID']);
        $this->MATERIAL_ID->setDbValue($row['MATERIAL_ID']);
        $this->FORM_ID->setDbValue($row['FORM_ID']);
        $this->ISGENERIC->setDbValue($row['ISGENERIC']);
        $this->REGULATE_ID->setDbValue($row['REGULATE_ID']);
        $this->PREGNANCY_INDEX->setDbValue($row['PREGNANCY_INDEX']);
        $this->INDICATION->setDbValue($row['INDICATION']);
        $this->TAKE_RULE->setDbValue($row['TAKE_RULE']);
        $this->SIDE_EFFECT->setDbValue($row['SIDE_EFFECT']);
        $this->INTERACTION->setDbValue($row['INTERACTION']);
        $this->CONTRA_INDICATION->setDbValue($row['CONTRA_INDICATION']);
        $this->WARNING->setDbValue($row['WARNING']);
        $this->STOCK->setDbValue($row['STOCK']);
        $this->ISACTIVE->setDbValue($row['ISACTIVE']);
        $this->ISALKES->setDbValue($row['ISALKES']);
        $this->SIZE_ORDER->setDbValue($row['SIZE_ORDER']);
        $this->ORDER_PRICE->setDbValue($row['ORDER_PRICE']);
        $this->ISFORMULARIUM->setDbValue($row['ISFORMULARIUM']);
        $this->ISESSENTIAL->setDbValue($row['ISESSENTIAL']);
        $this->AVGDATE->setDbValue($row['AVGDATE']);
        $this->STOCK_MINIMAL->setDbValue($row['STOCK_MINIMAL']);
        $this->STOCK_MINIMAL_APT->setDbValue($row['STOCK_MINIMAL_APT']);
        $this->HET->setDbValue($row['HET']);
        $this->default_margin->setDbValue($row['default_margin']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // CODE_5

        // BRAND_ID

        // NAME

        // OTHER_CODE

        // BARCODE

        // DESCRIPTION

        // REORDER_POINT

        // SIZE_GOODS

        // MEASURE_DOSIS

        // MEASURE_ID

        // MEASURE_ID2

        // SIZE_KEMASAN

        // MEASURE_ID3

        // COMPANY_ID

        // NET_PRICE

        // MODIFIED_DATE

        // MODIFIED_BY

        // TH

        // STATUS_PASIEN_ID

        // MATERIAL_ID

        // FORM_ID

        // ISGENERIC

        // REGULATE_ID

        // PREGNANCY_INDEX

        // INDICATION

        // TAKE_RULE

        // SIDE_EFFECT

        // INTERACTION

        // CONTRA_INDICATION

        // WARNING

        // STOCK

        // ISACTIVE

        // ISALKES

        // SIZE_ORDER

        // ORDER_PRICE

        // ISFORMULARIUM

        // ISESSENTIAL

        // AVGDATE

        // STOCK_MINIMAL

        // STOCK_MINIMAL_APT

        // HET

        // default_margin

        // CODE_5
        $this->CODE_5->ViewValue = $this->CODE_5->CurrentValue;
        $this->CODE_5->ViewCustomAttributes = "";

        // BRAND_ID
        $this->BRAND_ID->ViewValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->ViewCustomAttributes = "";

        // NAME
        $this->NAME->ViewValue = $this->NAME->CurrentValue;
        $this->NAME->ViewCustomAttributes = "";

        // OTHER_CODE
        $this->OTHER_CODE->ViewValue = $this->OTHER_CODE->CurrentValue;
        $this->OTHER_CODE->ViewCustomAttributes = "";

        // BARCODE
        $this->_BARCODE->ViewValue = $this->_BARCODE->CurrentValue;
        $this->_BARCODE->ViewCustomAttributes = "";

        // DESCRIPTION
        $this->DESCRIPTION->ViewValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->ViewCustomAttributes = "";

        // REORDER_POINT
        $this->REORDER_POINT->ViewValue = $this->REORDER_POINT->CurrentValue;
        $this->REORDER_POINT->ViewValue = FormatNumber($this->REORDER_POINT->ViewValue, 2, -2, -2, -2);
        $this->REORDER_POINT->ViewCustomAttributes = "";

        // SIZE_GOODS
        $this->SIZE_GOODS->ViewValue = $this->SIZE_GOODS->CurrentValue;
        $this->SIZE_GOODS->ViewValue = FormatNumber($this->SIZE_GOODS->ViewValue, 2, -2, -2, -2);
        $this->SIZE_GOODS->ViewCustomAttributes = "";

        // MEASURE_DOSIS
        $this->MEASURE_DOSIS->ViewValue = $this->MEASURE_DOSIS->CurrentValue;
        $this->MEASURE_DOSIS->ViewValue = FormatNumber($this->MEASURE_DOSIS->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_DOSIS->ViewCustomAttributes = "";

        // MEASURE_ID
        $this->MEASURE_ID->ViewValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->ViewValue = FormatNumber($this->MEASURE_ID->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID->ViewCustomAttributes = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->ViewValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->ViewValue = FormatNumber($this->MEASURE_ID2->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID2->ViewCustomAttributes = "";

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->ViewValue = $this->SIZE_KEMASAN->CurrentValue;
        $this->SIZE_KEMASAN->ViewValue = FormatNumber($this->SIZE_KEMASAN->ViewValue, 2, -2, -2, -2);
        $this->SIZE_KEMASAN->ViewCustomAttributes = "";

        // MEASURE_ID3
        $this->MEASURE_ID3->ViewValue = $this->MEASURE_ID3->CurrentValue;
        $this->MEASURE_ID3->ViewValue = FormatNumber($this->MEASURE_ID3->ViewValue, 0, -2, -2, -2);
        $this->MEASURE_ID3->ViewCustomAttributes = "";

        // COMPANY_ID
        $this->COMPANY_ID->ViewValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->ViewCustomAttributes = "";

        // NET_PRICE
        $this->NET_PRICE->ViewValue = $this->NET_PRICE->CurrentValue;
        $this->NET_PRICE->ViewValue = FormatNumber($this->NET_PRICE->ViewValue, 2, -2, -2, -2);
        $this->NET_PRICE->ViewCustomAttributes = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->ViewValue = $this->MODIFIED_DATE->CurrentValue;
        $this->MODIFIED_DATE->ViewValue = FormatDateTime($this->MODIFIED_DATE->ViewValue, 0);
        $this->MODIFIED_DATE->ViewCustomAttributes = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->ViewValue = $this->MODIFIED_BY->CurrentValue;
        $this->MODIFIED_BY->ViewCustomAttributes = "";

        // TH
        $this->TH->ViewValue = $this->TH->CurrentValue;
        $this->TH->ViewValue = FormatNumber($this->TH->ViewValue, 0, -2, -2, -2);
        $this->TH->ViewCustomAttributes = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->ViewValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->ViewValue = FormatNumber($this->STATUS_PASIEN_ID->ViewValue, 0, -2, -2, -2);
        $this->STATUS_PASIEN_ID->ViewCustomAttributes = "";

        // MATERIAL_ID
        $this->MATERIAL_ID->ViewValue = $this->MATERIAL_ID->CurrentValue;
        $this->MATERIAL_ID->ViewValue = FormatNumber($this->MATERIAL_ID->ViewValue, 0, -2, -2, -2);
        $this->MATERIAL_ID->ViewCustomAttributes = "";

        // FORM_ID
        $this->FORM_ID->ViewValue = $this->FORM_ID->CurrentValue;
        $this->FORM_ID->ViewValue = FormatNumber($this->FORM_ID->ViewValue, 0, -2, -2, -2);
        $this->FORM_ID->ViewCustomAttributes = "";

        // ISGENERIC
        $this->ISGENERIC->ViewValue = $this->ISGENERIC->CurrentValue;
        $this->ISGENERIC->ViewCustomAttributes = "";

        // REGULATE_ID
        $this->REGULATE_ID->ViewValue = $this->REGULATE_ID->CurrentValue;
        $this->REGULATE_ID->ViewValue = FormatNumber($this->REGULATE_ID->ViewValue, 0, -2, -2, -2);
        $this->REGULATE_ID->ViewCustomAttributes = "";

        // PREGNANCY_INDEX
        $this->PREGNANCY_INDEX->ViewValue = $this->PREGNANCY_INDEX->CurrentValue;
        $this->PREGNANCY_INDEX->ViewCustomAttributes = "";

        // INDICATION
        $this->INDICATION->ViewValue = $this->INDICATION->CurrentValue;
        $this->INDICATION->ViewCustomAttributes = "";

        // TAKE_RULE
        $this->TAKE_RULE->ViewValue = $this->TAKE_RULE->CurrentValue;
        $this->TAKE_RULE->ViewCustomAttributes = "";

        // SIDE_EFFECT
        $this->SIDE_EFFECT->ViewValue = $this->SIDE_EFFECT->CurrentValue;
        $this->SIDE_EFFECT->ViewCustomAttributes = "";

        // INTERACTION
        $this->INTERACTION->ViewValue = $this->INTERACTION->CurrentValue;
        $this->INTERACTION->ViewCustomAttributes = "";

        // CONTRA_INDICATION
        $this->CONTRA_INDICATION->ViewValue = $this->CONTRA_INDICATION->CurrentValue;
        $this->CONTRA_INDICATION->ViewCustomAttributes = "";

        // WARNING
        $this->WARNING->ViewValue = $this->WARNING->CurrentValue;
        $this->WARNING->ViewCustomAttributes = "";

        // STOCK
        $this->STOCK->ViewValue = $this->STOCK->CurrentValue;
        $this->STOCK->ViewValue = FormatNumber($this->STOCK->ViewValue, 2, -2, -2, -2);
        $this->STOCK->ViewCustomAttributes = "";

        // ISACTIVE
        $this->ISACTIVE->ViewValue = $this->ISACTIVE->CurrentValue;
        $this->ISACTIVE->ViewCustomAttributes = "";

        // ISALKES
        $this->ISALKES->ViewValue = $this->ISALKES->CurrentValue;
        $this->ISALKES->ViewCustomAttributes = "";

        // SIZE_ORDER
        $this->SIZE_ORDER->ViewValue = $this->SIZE_ORDER->CurrentValue;
        $this->SIZE_ORDER->ViewValue = FormatNumber($this->SIZE_ORDER->ViewValue, 2, -2, -2, -2);
        $this->SIZE_ORDER->ViewCustomAttributes = "";

        // ORDER_PRICE
        $this->ORDER_PRICE->ViewValue = $this->ORDER_PRICE->CurrentValue;
        $this->ORDER_PRICE->ViewValue = FormatNumber($this->ORDER_PRICE->ViewValue, 2, -2, -2, -2);
        $this->ORDER_PRICE->ViewCustomAttributes = "";

        // ISFORMULARIUM
        $this->ISFORMULARIUM->ViewValue = $this->ISFORMULARIUM->CurrentValue;
        $this->ISFORMULARIUM->ViewCustomAttributes = "";

        // ISESSENTIAL
        $this->ISESSENTIAL->ViewValue = $this->ISESSENTIAL->CurrentValue;
        $this->ISESSENTIAL->ViewCustomAttributes = "";

        // AVGDATE
        $this->AVGDATE->ViewValue = $this->AVGDATE->CurrentValue;
        $this->AVGDATE->ViewValue = FormatDateTime($this->AVGDATE->ViewValue, 0);
        $this->AVGDATE->ViewCustomAttributes = "";

        // STOCK_MINIMAL
        $this->STOCK_MINIMAL->ViewValue = $this->STOCK_MINIMAL->CurrentValue;
        $this->STOCK_MINIMAL->ViewValue = FormatNumber($this->STOCK_MINIMAL->ViewValue, 2, -2, -2, -2);
        $this->STOCK_MINIMAL->ViewCustomAttributes = "";

        // STOCK_MINIMAL_APT
        $this->STOCK_MINIMAL_APT->ViewValue = $this->STOCK_MINIMAL_APT->CurrentValue;
        $this->STOCK_MINIMAL_APT->ViewValue = FormatNumber($this->STOCK_MINIMAL_APT->ViewValue, 2, -2, -2, -2);
        $this->STOCK_MINIMAL_APT->ViewCustomAttributes = "";

        // HET
        $this->HET->ViewValue = $this->HET->CurrentValue;
        $this->HET->ViewValue = FormatNumber($this->HET->ViewValue, 2, -2, -2, -2);
        $this->HET->ViewCustomAttributes = "";

        // default_margin
        $this->default_margin->ViewValue = $this->default_margin->CurrentValue;
        $this->default_margin->ViewCustomAttributes = "";

        // CODE_5
        $this->CODE_5->LinkCustomAttributes = "";
        $this->CODE_5->HrefValue = "";
        $this->CODE_5->TooltipValue = "";

        // BRAND_ID
        $this->BRAND_ID->LinkCustomAttributes = "";
        $this->BRAND_ID->HrefValue = "";
        $this->BRAND_ID->TooltipValue = "";

        // NAME
        $this->NAME->LinkCustomAttributes = "";
        $this->NAME->HrefValue = "";
        $this->NAME->TooltipValue = "";

        // OTHER_CODE
        $this->OTHER_CODE->LinkCustomAttributes = "";
        $this->OTHER_CODE->HrefValue = "";
        $this->OTHER_CODE->TooltipValue = "";

        // BARCODE
        $this->_BARCODE->LinkCustomAttributes = "";
        $this->_BARCODE->HrefValue = "";
        $this->_BARCODE->TooltipValue = "";

        // DESCRIPTION
        $this->DESCRIPTION->LinkCustomAttributes = "";
        $this->DESCRIPTION->HrefValue = "";
        $this->DESCRIPTION->TooltipValue = "";

        // REORDER_POINT
        $this->REORDER_POINT->LinkCustomAttributes = "";
        $this->REORDER_POINT->HrefValue = "";
        $this->REORDER_POINT->TooltipValue = "";

        // SIZE_GOODS
        $this->SIZE_GOODS->LinkCustomAttributes = "";
        $this->SIZE_GOODS->HrefValue = "";
        $this->SIZE_GOODS->TooltipValue = "";

        // MEASURE_DOSIS
        $this->MEASURE_DOSIS->LinkCustomAttributes = "";
        $this->MEASURE_DOSIS->HrefValue = "";
        $this->MEASURE_DOSIS->TooltipValue = "";

        // MEASURE_ID
        $this->MEASURE_ID->LinkCustomAttributes = "";
        $this->MEASURE_ID->HrefValue = "";
        $this->MEASURE_ID->TooltipValue = "";

        // MEASURE_ID2
        $this->MEASURE_ID2->LinkCustomAttributes = "";
        $this->MEASURE_ID2->HrefValue = "";
        $this->MEASURE_ID2->TooltipValue = "";

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->LinkCustomAttributes = "";
        $this->SIZE_KEMASAN->HrefValue = "";
        $this->SIZE_KEMASAN->TooltipValue = "";

        // MEASURE_ID3
        $this->MEASURE_ID3->LinkCustomAttributes = "";
        $this->MEASURE_ID3->HrefValue = "";
        $this->MEASURE_ID3->TooltipValue = "";

        // COMPANY_ID
        $this->COMPANY_ID->LinkCustomAttributes = "";
        $this->COMPANY_ID->HrefValue = "";
        $this->COMPANY_ID->TooltipValue = "";

        // NET_PRICE
        $this->NET_PRICE->LinkCustomAttributes = "";
        $this->NET_PRICE->HrefValue = "";
        $this->NET_PRICE->TooltipValue = "";

        // MODIFIED_DATE
        $this->MODIFIED_DATE->LinkCustomAttributes = "";
        $this->MODIFIED_DATE->HrefValue = "";
        $this->MODIFIED_DATE->TooltipValue = "";

        // MODIFIED_BY
        $this->MODIFIED_BY->LinkCustomAttributes = "";
        $this->MODIFIED_BY->HrefValue = "";
        $this->MODIFIED_BY->TooltipValue = "";

        // TH
        $this->TH->LinkCustomAttributes = "";
        $this->TH->HrefValue = "";
        $this->TH->TooltipValue = "";

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->LinkCustomAttributes = "";
        $this->STATUS_PASIEN_ID->HrefValue = "";
        $this->STATUS_PASIEN_ID->TooltipValue = "";

        // MATERIAL_ID
        $this->MATERIAL_ID->LinkCustomAttributes = "";
        $this->MATERIAL_ID->HrefValue = "";
        $this->MATERIAL_ID->TooltipValue = "";

        // FORM_ID
        $this->FORM_ID->LinkCustomAttributes = "";
        $this->FORM_ID->HrefValue = "";
        $this->FORM_ID->TooltipValue = "";

        // ISGENERIC
        $this->ISGENERIC->LinkCustomAttributes = "";
        $this->ISGENERIC->HrefValue = "";
        $this->ISGENERIC->TooltipValue = "";

        // REGULATE_ID
        $this->REGULATE_ID->LinkCustomAttributes = "";
        $this->REGULATE_ID->HrefValue = "";
        $this->REGULATE_ID->TooltipValue = "";

        // PREGNANCY_INDEX
        $this->PREGNANCY_INDEX->LinkCustomAttributes = "";
        $this->PREGNANCY_INDEX->HrefValue = "";
        $this->PREGNANCY_INDEX->TooltipValue = "";

        // INDICATION
        $this->INDICATION->LinkCustomAttributes = "";
        $this->INDICATION->HrefValue = "";
        $this->INDICATION->TooltipValue = "";

        // TAKE_RULE
        $this->TAKE_RULE->LinkCustomAttributes = "";
        $this->TAKE_RULE->HrefValue = "";
        $this->TAKE_RULE->TooltipValue = "";

        // SIDE_EFFECT
        $this->SIDE_EFFECT->LinkCustomAttributes = "";
        $this->SIDE_EFFECT->HrefValue = "";
        $this->SIDE_EFFECT->TooltipValue = "";

        // INTERACTION
        $this->INTERACTION->LinkCustomAttributes = "";
        $this->INTERACTION->HrefValue = "";
        $this->INTERACTION->TooltipValue = "";

        // CONTRA_INDICATION
        $this->CONTRA_INDICATION->LinkCustomAttributes = "";
        $this->CONTRA_INDICATION->HrefValue = "";
        $this->CONTRA_INDICATION->TooltipValue = "";

        // WARNING
        $this->WARNING->LinkCustomAttributes = "";
        $this->WARNING->HrefValue = "";
        $this->WARNING->TooltipValue = "";

        // STOCK
        $this->STOCK->LinkCustomAttributes = "";
        $this->STOCK->HrefValue = "";
        $this->STOCK->TooltipValue = "";

        // ISACTIVE
        $this->ISACTIVE->LinkCustomAttributes = "";
        $this->ISACTIVE->HrefValue = "";
        $this->ISACTIVE->TooltipValue = "";

        // ISALKES
        $this->ISALKES->LinkCustomAttributes = "";
        $this->ISALKES->HrefValue = "";
        $this->ISALKES->TooltipValue = "";

        // SIZE_ORDER
        $this->SIZE_ORDER->LinkCustomAttributes = "";
        $this->SIZE_ORDER->HrefValue = "";
        $this->SIZE_ORDER->TooltipValue = "";

        // ORDER_PRICE
        $this->ORDER_PRICE->LinkCustomAttributes = "";
        $this->ORDER_PRICE->HrefValue = "";
        $this->ORDER_PRICE->TooltipValue = "";

        // ISFORMULARIUM
        $this->ISFORMULARIUM->LinkCustomAttributes = "";
        $this->ISFORMULARIUM->HrefValue = "";
        $this->ISFORMULARIUM->TooltipValue = "";

        // ISESSENTIAL
        $this->ISESSENTIAL->LinkCustomAttributes = "";
        $this->ISESSENTIAL->HrefValue = "";
        $this->ISESSENTIAL->TooltipValue = "";

        // AVGDATE
        $this->AVGDATE->LinkCustomAttributes = "";
        $this->AVGDATE->HrefValue = "";
        $this->AVGDATE->TooltipValue = "";

        // STOCK_MINIMAL
        $this->STOCK_MINIMAL->LinkCustomAttributes = "";
        $this->STOCK_MINIMAL->HrefValue = "";
        $this->STOCK_MINIMAL->TooltipValue = "";

        // STOCK_MINIMAL_APT
        $this->STOCK_MINIMAL_APT->LinkCustomAttributes = "";
        $this->STOCK_MINIMAL_APT->HrefValue = "";
        $this->STOCK_MINIMAL_APT->TooltipValue = "";

        // HET
        $this->HET->LinkCustomAttributes = "";
        $this->HET->HrefValue = "";
        $this->HET->TooltipValue = "";

        // default_margin
        $this->default_margin->LinkCustomAttributes = "";
        $this->default_margin->HrefValue = "";
        $this->default_margin->TooltipValue = "";

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

        // CODE_5
        $this->CODE_5->EditAttrs["class"] = "form-control";
        $this->CODE_5->EditCustomAttributes = "";
        if (!$this->CODE_5->Raw) {
            $this->CODE_5->CurrentValue = HtmlDecode($this->CODE_5->CurrentValue);
        }
        $this->CODE_5->EditValue = $this->CODE_5->CurrentValue;
        $this->CODE_5->PlaceHolder = RemoveHtml($this->CODE_5->caption());

        // BRAND_ID
        $this->BRAND_ID->EditAttrs["class"] = "form-control";
        $this->BRAND_ID->EditCustomAttributes = "";
        if (!$this->BRAND_ID->Raw) {
            $this->BRAND_ID->CurrentValue = HtmlDecode($this->BRAND_ID->CurrentValue);
        }
        $this->BRAND_ID->EditValue = $this->BRAND_ID->CurrentValue;
        $this->BRAND_ID->PlaceHolder = RemoveHtml($this->BRAND_ID->caption());

        // NAME
        $this->NAME->EditAttrs["class"] = "form-control";
        $this->NAME->EditCustomAttributes = "";
        if (!$this->NAME->Raw) {
            $this->NAME->CurrentValue = HtmlDecode($this->NAME->CurrentValue);
        }
        $this->NAME->EditValue = $this->NAME->CurrentValue;
        $this->NAME->PlaceHolder = RemoveHtml($this->NAME->caption());

        // OTHER_CODE
        $this->OTHER_CODE->EditAttrs["class"] = "form-control";
        $this->OTHER_CODE->EditCustomAttributes = "";
        if (!$this->OTHER_CODE->Raw) {
            $this->OTHER_CODE->CurrentValue = HtmlDecode($this->OTHER_CODE->CurrentValue);
        }
        $this->OTHER_CODE->EditValue = $this->OTHER_CODE->CurrentValue;
        $this->OTHER_CODE->PlaceHolder = RemoveHtml($this->OTHER_CODE->caption());

        // BARCODE
        $this->_BARCODE->EditAttrs["class"] = "form-control";
        $this->_BARCODE->EditCustomAttributes = "";
        if (!$this->_BARCODE->Raw) {
            $this->_BARCODE->CurrentValue = HtmlDecode($this->_BARCODE->CurrentValue);
        }
        $this->_BARCODE->EditValue = $this->_BARCODE->CurrentValue;
        $this->_BARCODE->PlaceHolder = RemoveHtml($this->_BARCODE->caption());

        // DESCRIPTION
        $this->DESCRIPTION->EditAttrs["class"] = "form-control";
        $this->DESCRIPTION->EditCustomAttributes = "";
        if (!$this->DESCRIPTION->Raw) {
            $this->DESCRIPTION->CurrentValue = HtmlDecode($this->DESCRIPTION->CurrentValue);
        }
        $this->DESCRIPTION->EditValue = $this->DESCRIPTION->CurrentValue;
        $this->DESCRIPTION->PlaceHolder = RemoveHtml($this->DESCRIPTION->caption());

        // REORDER_POINT
        $this->REORDER_POINT->EditAttrs["class"] = "form-control";
        $this->REORDER_POINT->EditCustomAttributes = "";
        $this->REORDER_POINT->EditValue = $this->REORDER_POINT->CurrentValue;
        $this->REORDER_POINT->PlaceHolder = RemoveHtml($this->REORDER_POINT->caption());
        if (strval($this->REORDER_POINT->EditValue) != "" && is_numeric($this->REORDER_POINT->EditValue)) {
            $this->REORDER_POINT->EditValue = FormatNumber($this->REORDER_POINT->EditValue, -2, -2, -2, -2);
        }

        // SIZE_GOODS
        $this->SIZE_GOODS->EditAttrs["class"] = "form-control";
        $this->SIZE_GOODS->EditCustomAttributes = "";
        $this->SIZE_GOODS->EditValue = $this->SIZE_GOODS->CurrentValue;
        $this->SIZE_GOODS->PlaceHolder = RemoveHtml($this->SIZE_GOODS->caption());
        if (strval($this->SIZE_GOODS->EditValue) != "" && is_numeric($this->SIZE_GOODS->EditValue)) {
            $this->SIZE_GOODS->EditValue = FormatNumber($this->SIZE_GOODS->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_DOSIS
        $this->MEASURE_DOSIS->EditAttrs["class"] = "form-control";
        $this->MEASURE_DOSIS->EditCustomAttributes = "";
        $this->MEASURE_DOSIS->EditValue = $this->MEASURE_DOSIS->CurrentValue;
        $this->MEASURE_DOSIS->PlaceHolder = RemoveHtml($this->MEASURE_DOSIS->caption());

        // MEASURE_ID
        $this->MEASURE_ID->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID->EditCustomAttributes = "";
        $this->MEASURE_ID->EditValue = $this->MEASURE_ID->CurrentValue;
        $this->MEASURE_ID->PlaceHolder = RemoveHtml($this->MEASURE_ID->caption());

        // MEASURE_ID2
        $this->MEASURE_ID2->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID2->EditCustomAttributes = "";
        $this->MEASURE_ID2->EditValue = $this->MEASURE_ID2->CurrentValue;
        $this->MEASURE_ID2->PlaceHolder = RemoveHtml($this->MEASURE_ID2->caption());

        // SIZE_KEMASAN
        $this->SIZE_KEMASAN->EditAttrs["class"] = "form-control";
        $this->SIZE_KEMASAN->EditCustomAttributes = "";
        $this->SIZE_KEMASAN->EditValue = $this->SIZE_KEMASAN->CurrentValue;
        $this->SIZE_KEMASAN->PlaceHolder = RemoveHtml($this->SIZE_KEMASAN->caption());
        if (strval($this->SIZE_KEMASAN->EditValue) != "" && is_numeric($this->SIZE_KEMASAN->EditValue)) {
            $this->SIZE_KEMASAN->EditValue = FormatNumber($this->SIZE_KEMASAN->EditValue, -2, -2, -2, -2);
        }

        // MEASURE_ID3
        $this->MEASURE_ID3->EditAttrs["class"] = "form-control";
        $this->MEASURE_ID3->EditCustomAttributes = "";
        $this->MEASURE_ID3->EditValue = $this->MEASURE_ID3->CurrentValue;
        $this->MEASURE_ID3->PlaceHolder = RemoveHtml($this->MEASURE_ID3->caption());

        // COMPANY_ID
        $this->COMPANY_ID->EditAttrs["class"] = "form-control";
        $this->COMPANY_ID->EditCustomAttributes = "";
        if (!$this->COMPANY_ID->Raw) {
            $this->COMPANY_ID->CurrentValue = HtmlDecode($this->COMPANY_ID->CurrentValue);
        }
        $this->COMPANY_ID->EditValue = $this->COMPANY_ID->CurrentValue;
        $this->COMPANY_ID->PlaceHolder = RemoveHtml($this->COMPANY_ID->caption());

        // NET_PRICE
        $this->NET_PRICE->EditAttrs["class"] = "form-control";
        $this->NET_PRICE->EditCustomAttributes = "";
        $this->NET_PRICE->EditValue = $this->NET_PRICE->CurrentValue;
        $this->NET_PRICE->PlaceHolder = RemoveHtml($this->NET_PRICE->caption());
        if (strval($this->NET_PRICE->EditValue) != "" && is_numeric($this->NET_PRICE->EditValue)) {
            $this->NET_PRICE->EditValue = FormatNumber($this->NET_PRICE->EditValue, -2, -2, -2, -2);
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

        // TH
        $this->TH->EditAttrs["class"] = "form-control";
        $this->TH->EditCustomAttributes = "";
        $this->TH->EditValue = $this->TH->CurrentValue;
        $this->TH->PlaceHolder = RemoveHtml($this->TH->caption());

        // STATUS_PASIEN_ID
        $this->STATUS_PASIEN_ID->EditAttrs["class"] = "form-control";
        $this->STATUS_PASIEN_ID->EditCustomAttributes = "";
        $this->STATUS_PASIEN_ID->EditValue = $this->STATUS_PASIEN_ID->CurrentValue;
        $this->STATUS_PASIEN_ID->PlaceHolder = RemoveHtml($this->STATUS_PASIEN_ID->caption());

        // MATERIAL_ID
        $this->MATERIAL_ID->EditAttrs["class"] = "form-control";
        $this->MATERIAL_ID->EditCustomAttributes = "";
        $this->MATERIAL_ID->EditValue = $this->MATERIAL_ID->CurrentValue;
        $this->MATERIAL_ID->PlaceHolder = RemoveHtml($this->MATERIAL_ID->caption());

        // FORM_ID
        $this->FORM_ID->EditAttrs["class"] = "form-control";
        $this->FORM_ID->EditCustomAttributes = "";
        $this->FORM_ID->EditValue = $this->FORM_ID->CurrentValue;
        $this->FORM_ID->PlaceHolder = RemoveHtml($this->FORM_ID->caption());

        // ISGENERIC
        $this->ISGENERIC->EditAttrs["class"] = "form-control";
        $this->ISGENERIC->EditCustomAttributes = "";
        if (!$this->ISGENERIC->Raw) {
            $this->ISGENERIC->CurrentValue = HtmlDecode($this->ISGENERIC->CurrentValue);
        }
        $this->ISGENERIC->EditValue = $this->ISGENERIC->CurrentValue;
        $this->ISGENERIC->PlaceHolder = RemoveHtml($this->ISGENERIC->caption());

        // REGULATE_ID
        $this->REGULATE_ID->EditAttrs["class"] = "form-control";
        $this->REGULATE_ID->EditCustomAttributes = "";
        $this->REGULATE_ID->EditValue = $this->REGULATE_ID->CurrentValue;
        $this->REGULATE_ID->PlaceHolder = RemoveHtml($this->REGULATE_ID->caption());

        // PREGNANCY_INDEX
        $this->PREGNANCY_INDEX->EditAttrs["class"] = "form-control";
        $this->PREGNANCY_INDEX->EditCustomAttributes = "";
        if (!$this->PREGNANCY_INDEX->Raw) {
            $this->PREGNANCY_INDEX->CurrentValue = HtmlDecode($this->PREGNANCY_INDEX->CurrentValue);
        }
        $this->PREGNANCY_INDEX->EditValue = $this->PREGNANCY_INDEX->CurrentValue;
        $this->PREGNANCY_INDEX->PlaceHolder = RemoveHtml($this->PREGNANCY_INDEX->caption());

        // INDICATION
        $this->INDICATION->EditAttrs["class"] = "form-control";
        $this->INDICATION->EditCustomAttributes = "";
        if (!$this->INDICATION->Raw) {
            $this->INDICATION->CurrentValue = HtmlDecode($this->INDICATION->CurrentValue);
        }
        $this->INDICATION->EditValue = $this->INDICATION->CurrentValue;
        $this->INDICATION->PlaceHolder = RemoveHtml($this->INDICATION->caption());

        // TAKE_RULE
        $this->TAKE_RULE->EditAttrs["class"] = "form-control";
        $this->TAKE_RULE->EditCustomAttributes = "";
        if (!$this->TAKE_RULE->Raw) {
            $this->TAKE_RULE->CurrentValue = HtmlDecode($this->TAKE_RULE->CurrentValue);
        }
        $this->TAKE_RULE->EditValue = $this->TAKE_RULE->CurrentValue;
        $this->TAKE_RULE->PlaceHolder = RemoveHtml($this->TAKE_RULE->caption());

        // SIDE_EFFECT
        $this->SIDE_EFFECT->EditAttrs["class"] = "form-control";
        $this->SIDE_EFFECT->EditCustomAttributes = "";
        if (!$this->SIDE_EFFECT->Raw) {
            $this->SIDE_EFFECT->CurrentValue = HtmlDecode($this->SIDE_EFFECT->CurrentValue);
        }
        $this->SIDE_EFFECT->EditValue = $this->SIDE_EFFECT->CurrentValue;
        $this->SIDE_EFFECT->PlaceHolder = RemoveHtml($this->SIDE_EFFECT->caption());

        // INTERACTION
        $this->INTERACTION->EditAttrs["class"] = "form-control";
        $this->INTERACTION->EditCustomAttributes = "";
        if (!$this->INTERACTION->Raw) {
            $this->INTERACTION->CurrentValue = HtmlDecode($this->INTERACTION->CurrentValue);
        }
        $this->INTERACTION->EditValue = $this->INTERACTION->CurrentValue;
        $this->INTERACTION->PlaceHolder = RemoveHtml($this->INTERACTION->caption());

        // CONTRA_INDICATION
        $this->CONTRA_INDICATION->EditAttrs["class"] = "form-control";
        $this->CONTRA_INDICATION->EditCustomAttributes = "";
        if (!$this->CONTRA_INDICATION->Raw) {
            $this->CONTRA_INDICATION->CurrentValue = HtmlDecode($this->CONTRA_INDICATION->CurrentValue);
        }
        $this->CONTRA_INDICATION->EditValue = $this->CONTRA_INDICATION->CurrentValue;
        $this->CONTRA_INDICATION->PlaceHolder = RemoveHtml($this->CONTRA_INDICATION->caption());

        // WARNING
        $this->WARNING->EditAttrs["class"] = "form-control";
        $this->WARNING->EditCustomAttributes = "";
        if (!$this->WARNING->Raw) {
            $this->WARNING->CurrentValue = HtmlDecode($this->WARNING->CurrentValue);
        }
        $this->WARNING->EditValue = $this->WARNING->CurrentValue;
        $this->WARNING->PlaceHolder = RemoveHtml($this->WARNING->caption());

        // STOCK
        $this->STOCK->EditAttrs["class"] = "form-control";
        $this->STOCK->EditCustomAttributes = "";
        $this->STOCK->EditValue = $this->STOCK->CurrentValue;
        $this->STOCK->PlaceHolder = RemoveHtml($this->STOCK->caption());
        if (strval($this->STOCK->EditValue) != "" && is_numeric($this->STOCK->EditValue)) {
            $this->STOCK->EditValue = FormatNumber($this->STOCK->EditValue, -2, -2, -2, -2);
        }

        // ISACTIVE
        $this->ISACTIVE->EditAttrs["class"] = "form-control";
        $this->ISACTIVE->EditCustomAttributes = "";
        if (!$this->ISACTIVE->Raw) {
            $this->ISACTIVE->CurrentValue = HtmlDecode($this->ISACTIVE->CurrentValue);
        }
        $this->ISACTIVE->EditValue = $this->ISACTIVE->CurrentValue;
        $this->ISACTIVE->PlaceHolder = RemoveHtml($this->ISACTIVE->caption());

        // ISALKES
        $this->ISALKES->EditAttrs["class"] = "form-control";
        $this->ISALKES->EditCustomAttributes = "";
        if (!$this->ISALKES->Raw) {
            $this->ISALKES->CurrentValue = HtmlDecode($this->ISALKES->CurrentValue);
        }
        $this->ISALKES->EditValue = $this->ISALKES->CurrentValue;
        $this->ISALKES->PlaceHolder = RemoveHtml($this->ISALKES->caption());

        // SIZE_ORDER
        $this->SIZE_ORDER->EditAttrs["class"] = "form-control";
        $this->SIZE_ORDER->EditCustomAttributes = "";
        $this->SIZE_ORDER->EditValue = $this->SIZE_ORDER->CurrentValue;
        $this->SIZE_ORDER->PlaceHolder = RemoveHtml($this->SIZE_ORDER->caption());
        if (strval($this->SIZE_ORDER->EditValue) != "" && is_numeric($this->SIZE_ORDER->EditValue)) {
            $this->SIZE_ORDER->EditValue = FormatNumber($this->SIZE_ORDER->EditValue, -2, -2, -2, -2);
        }

        // ORDER_PRICE
        $this->ORDER_PRICE->EditAttrs["class"] = "form-control";
        $this->ORDER_PRICE->EditCustomAttributes = "";
        $this->ORDER_PRICE->EditValue = $this->ORDER_PRICE->CurrentValue;
        $this->ORDER_PRICE->PlaceHolder = RemoveHtml($this->ORDER_PRICE->caption());
        if (strval($this->ORDER_PRICE->EditValue) != "" && is_numeric($this->ORDER_PRICE->EditValue)) {
            $this->ORDER_PRICE->EditValue = FormatNumber($this->ORDER_PRICE->EditValue, -2, -2, -2, -2);
        }

        // ISFORMULARIUM
        $this->ISFORMULARIUM->EditAttrs["class"] = "form-control";
        $this->ISFORMULARIUM->EditCustomAttributes = "";
        if (!$this->ISFORMULARIUM->Raw) {
            $this->ISFORMULARIUM->CurrentValue = HtmlDecode($this->ISFORMULARIUM->CurrentValue);
        }
        $this->ISFORMULARIUM->EditValue = $this->ISFORMULARIUM->CurrentValue;
        $this->ISFORMULARIUM->PlaceHolder = RemoveHtml($this->ISFORMULARIUM->caption());

        // ISESSENTIAL
        $this->ISESSENTIAL->EditAttrs["class"] = "form-control";
        $this->ISESSENTIAL->EditCustomAttributes = "";
        if (!$this->ISESSENTIAL->Raw) {
            $this->ISESSENTIAL->CurrentValue = HtmlDecode($this->ISESSENTIAL->CurrentValue);
        }
        $this->ISESSENTIAL->EditValue = $this->ISESSENTIAL->CurrentValue;
        $this->ISESSENTIAL->PlaceHolder = RemoveHtml($this->ISESSENTIAL->caption());

        // AVGDATE
        $this->AVGDATE->EditAttrs["class"] = "form-control";
        $this->AVGDATE->EditCustomAttributes = "";
        $this->AVGDATE->EditValue = FormatDateTime($this->AVGDATE->CurrentValue, 8);
        $this->AVGDATE->PlaceHolder = RemoveHtml($this->AVGDATE->caption());

        // STOCK_MINIMAL
        $this->STOCK_MINIMAL->EditAttrs["class"] = "form-control";
        $this->STOCK_MINIMAL->EditCustomAttributes = "";
        $this->STOCK_MINIMAL->EditValue = $this->STOCK_MINIMAL->CurrentValue;
        $this->STOCK_MINIMAL->PlaceHolder = RemoveHtml($this->STOCK_MINIMAL->caption());
        if (strval($this->STOCK_MINIMAL->EditValue) != "" && is_numeric($this->STOCK_MINIMAL->EditValue)) {
            $this->STOCK_MINIMAL->EditValue = FormatNumber($this->STOCK_MINIMAL->EditValue, -2, -2, -2, -2);
        }

        // STOCK_MINIMAL_APT
        $this->STOCK_MINIMAL_APT->EditAttrs["class"] = "form-control";
        $this->STOCK_MINIMAL_APT->EditCustomAttributes = "";
        $this->STOCK_MINIMAL_APT->EditValue = $this->STOCK_MINIMAL_APT->CurrentValue;
        $this->STOCK_MINIMAL_APT->PlaceHolder = RemoveHtml($this->STOCK_MINIMAL_APT->caption());
        if (strval($this->STOCK_MINIMAL_APT->EditValue) != "" && is_numeric($this->STOCK_MINIMAL_APT->EditValue)) {
            $this->STOCK_MINIMAL_APT->EditValue = FormatNumber($this->STOCK_MINIMAL_APT->EditValue, -2, -2, -2, -2);
        }

        // HET
        $this->HET->EditAttrs["class"] = "form-control";
        $this->HET->EditCustomAttributes = "";
        $this->HET->EditValue = $this->HET->CurrentValue;
        $this->HET->PlaceHolder = RemoveHtml($this->HET->caption());
        if (strval($this->HET->EditValue) != "" && is_numeric($this->HET->EditValue)) {
            $this->HET->EditValue = FormatNumber($this->HET->EditValue, -2, -2, -2, -2);
        }

        // default_margin
        $this->default_margin->EditAttrs["class"] = "form-control";
        $this->default_margin->EditCustomAttributes = "";
        if (!$this->default_margin->Raw) {
            $this->default_margin->CurrentValue = HtmlDecode($this->default_margin->CurrentValue);
        }
        $this->default_margin->EditValue = $this->default_margin->CurrentValue;
        $this->default_margin->PlaceHolder = RemoveHtml($this->default_margin->caption());

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
                    $doc->exportCaption($this->CODE_5);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->NAME);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->_BARCODE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->REORDER_POINT);
                    $doc->exportCaption($this->SIZE_GOODS);
                    $doc->exportCaption($this->MEASURE_DOSIS);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->SIZE_KEMASAN);
                    $doc->exportCaption($this->MEASURE_ID3);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->NET_PRICE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->TH);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->MATERIAL_ID);
                    $doc->exportCaption($this->FORM_ID);
                    $doc->exportCaption($this->ISGENERIC);
                    $doc->exportCaption($this->REGULATE_ID);
                    $doc->exportCaption($this->PREGNANCY_INDEX);
                    $doc->exportCaption($this->INDICATION);
                    $doc->exportCaption($this->TAKE_RULE);
                    $doc->exportCaption($this->SIDE_EFFECT);
                    $doc->exportCaption($this->INTERACTION);
                    $doc->exportCaption($this->CONTRA_INDICATION);
                    $doc->exportCaption($this->WARNING);
                    $doc->exportCaption($this->STOCK);
                    $doc->exportCaption($this->ISACTIVE);
                    $doc->exportCaption($this->ISALKES);
                    $doc->exportCaption($this->SIZE_ORDER);
                    $doc->exportCaption($this->ORDER_PRICE);
                    $doc->exportCaption($this->ISFORMULARIUM);
                    $doc->exportCaption($this->ISESSENTIAL);
                    $doc->exportCaption($this->AVGDATE);
                    $doc->exportCaption($this->STOCK_MINIMAL);
                    $doc->exportCaption($this->STOCK_MINIMAL_APT);
                    $doc->exportCaption($this->HET);
                    $doc->exportCaption($this->default_margin);
                } else {
                    $doc->exportCaption($this->CODE_5);
                    $doc->exportCaption($this->BRAND_ID);
                    $doc->exportCaption($this->NAME);
                    $doc->exportCaption($this->OTHER_CODE);
                    $doc->exportCaption($this->_BARCODE);
                    $doc->exportCaption($this->DESCRIPTION);
                    $doc->exportCaption($this->REORDER_POINT);
                    $doc->exportCaption($this->SIZE_GOODS);
                    $doc->exportCaption($this->MEASURE_DOSIS);
                    $doc->exportCaption($this->MEASURE_ID);
                    $doc->exportCaption($this->MEASURE_ID2);
                    $doc->exportCaption($this->SIZE_KEMASAN);
                    $doc->exportCaption($this->MEASURE_ID3);
                    $doc->exportCaption($this->COMPANY_ID);
                    $doc->exportCaption($this->NET_PRICE);
                    $doc->exportCaption($this->MODIFIED_DATE);
                    $doc->exportCaption($this->MODIFIED_BY);
                    $doc->exportCaption($this->TH);
                    $doc->exportCaption($this->STATUS_PASIEN_ID);
                    $doc->exportCaption($this->MATERIAL_ID);
                    $doc->exportCaption($this->FORM_ID);
                    $doc->exportCaption($this->ISGENERIC);
                    $doc->exportCaption($this->REGULATE_ID);
                    $doc->exportCaption($this->PREGNANCY_INDEX);
                    $doc->exportCaption($this->INDICATION);
                    $doc->exportCaption($this->TAKE_RULE);
                    $doc->exportCaption($this->SIDE_EFFECT);
                    $doc->exportCaption($this->INTERACTION);
                    $doc->exportCaption($this->CONTRA_INDICATION);
                    $doc->exportCaption($this->WARNING);
                    $doc->exportCaption($this->STOCK);
                    $doc->exportCaption($this->ISACTIVE);
                    $doc->exportCaption($this->ISALKES);
                    $doc->exportCaption($this->SIZE_ORDER);
                    $doc->exportCaption($this->ORDER_PRICE);
                    $doc->exportCaption($this->ISFORMULARIUM);
                    $doc->exportCaption($this->ISESSENTIAL);
                    $doc->exportCaption($this->AVGDATE);
                    $doc->exportCaption($this->STOCK_MINIMAL);
                    $doc->exportCaption($this->STOCK_MINIMAL_APT);
                    $doc->exportCaption($this->HET);
                    $doc->exportCaption($this->default_margin);
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
                        $doc->exportField($this->CODE_5);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->NAME);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->_BARCODE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->REORDER_POINT);
                        $doc->exportField($this->SIZE_GOODS);
                        $doc->exportField($this->MEASURE_DOSIS);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->SIZE_KEMASAN);
                        $doc->exportField($this->MEASURE_ID3);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->NET_PRICE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->TH);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->MATERIAL_ID);
                        $doc->exportField($this->FORM_ID);
                        $doc->exportField($this->ISGENERIC);
                        $doc->exportField($this->REGULATE_ID);
                        $doc->exportField($this->PREGNANCY_INDEX);
                        $doc->exportField($this->INDICATION);
                        $doc->exportField($this->TAKE_RULE);
                        $doc->exportField($this->SIDE_EFFECT);
                        $doc->exportField($this->INTERACTION);
                        $doc->exportField($this->CONTRA_INDICATION);
                        $doc->exportField($this->WARNING);
                        $doc->exportField($this->STOCK);
                        $doc->exportField($this->ISACTIVE);
                        $doc->exportField($this->ISALKES);
                        $doc->exportField($this->SIZE_ORDER);
                        $doc->exportField($this->ORDER_PRICE);
                        $doc->exportField($this->ISFORMULARIUM);
                        $doc->exportField($this->ISESSENTIAL);
                        $doc->exportField($this->AVGDATE);
                        $doc->exportField($this->STOCK_MINIMAL);
                        $doc->exportField($this->STOCK_MINIMAL_APT);
                        $doc->exportField($this->HET);
                        $doc->exportField($this->default_margin);
                    } else {
                        $doc->exportField($this->CODE_5);
                        $doc->exportField($this->BRAND_ID);
                        $doc->exportField($this->NAME);
                        $doc->exportField($this->OTHER_CODE);
                        $doc->exportField($this->_BARCODE);
                        $doc->exportField($this->DESCRIPTION);
                        $doc->exportField($this->REORDER_POINT);
                        $doc->exportField($this->SIZE_GOODS);
                        $doc->exportField($this->MEASURE_DOSIS);
                        $doc->exportField($this->MEASURE_ID);
                        $doc->exportField($this->MEASURE_ID2);
                        $doc->exportField($this->SIZE_KEMASAN);
                        $doc->exportField($this->MEASURE_ID3);
                        $doc->exportField($this->COMPANY_ID);
                        $doc->exportField($this->NET_PRICE);
                        $doc->exportField($this->MODIFIED_DATE);
                        $doc->exportField($this->MODIFIED_BY);
                        $doc->exportField($this->TH);
                        $doc->exportField($this->STATUS_PASIEN_ID);
                        $doc->exportField($this->MATERIAL_ID);
                        $doc->exportField($this->FORM_ID);
                        $doc->exportField($this->ISGENERIC);
                        $doc->exportField($this->REGULATE_ID);
                        $doc->exportField($this->PREGNANCY_INDEX);
                        $doc->exportField($this->INDICATION);
                        $doc->exportField($this->TAKE_RULE);
                        $doc->exportField($this->SIDE_EFFECT);
                        $doc->exportField($this->INTERACTION);
                        $doc->exportField($this->CONTRA_INDICATION);
                        $doc->exportField($this->WARNING);
                        $doc->exportField($this->STOCK);
                        $doc->exportField($this->ISACTIVE);
                        $doc->exportField($this->ISALKES);
                        $doc->exportField($this->SIZE_ORDER);
                        $doc->exportField($this->ORDER_PRICE);
                        $doc->exportField($this->ISFORMULARIUM);
                        $doc->exportField($this->ISESSENTIAL);
                        $doc->exportField($this->AVGDATE);
                        $doc->exportField($this->STOCK_MINIMAL);
                        $doc->exportField($this->STOCK_MINIMAL_APT);
                        $doc->exportField($this->HET);
                        $doc->exportField($this->default_margin);
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
