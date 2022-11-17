<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VKunjunganList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_KUNJUNGANlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fV_KUNJUNGANlist = currentForm = new ew.Form("fV_KUNJUNGANlist", "list");
    fV_KUNJUNGANlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fV_KUNJUNGANlist");
});
var fV_KUNJUNGANlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fV_KUNJUNGANlistsrch = currentSearchForm = new ew.Form("fV_KUNJUNGANlistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "V_KUNJUNGAN")) ?>,
        fields = currentTable.fields;
    fV_KUNJUNGANlistsrch.addFields([
        ["NO_REGISTRATION", [], fields.NO_REGISTRATION.isInvalid],
        ["VISIT_DATE", [], fields.VISIT_DATE.isInvalid],
        ["PAYOR_ID", [], fields.PAYOR_ID.isInvalid],
        ["CLASS_ID", [], fields.CLASS_ID.isInvalid],
        ["CLINIC_ID", [], fields.CLINIC_ID.isInvalid],
        ["MONTH", [], fields.MONTH.isInvalid],
        ["YEAR", [], fields.YEAR.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fV_KUNJUNGANlistsrch.setInvalid();
    });

    // Validate form
    fV_KUNJUNGANlistsrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fV_KUNJUNGANlistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fV_KUNJUNGANlistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fV_KUNJUNGANlistsrch.lists.MONTH = <?= $Page->MONTH->toClientList($Page) ?>;
    fV_KUNJUNGANlistsrch.lists.YEAR = <?= $Page->YEAR->toClientList($Page) ?>;

    // Filters
    fV_KUNJUNGANlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fV_KUNJUNGANlistsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fV_KUNJUNGANlistsrch" id="fV_KUNJUNGANlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fV_KUNJUNGANlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="V_KUNJUNGAN">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->MONTH->Visible) { // MONTH ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_MONTH" class="ew-cell form-group">
        <label for="x_MONTH" class="ew-search-caption ew-label"><?= $Page->MONTH->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_MONTH" id="z_MONTH" value="=">
</span>
        <span id="el_V_KUNJUNGAN_MONTH" class="ew-search-field">
    <select
        id="x_MONTH"
        name="x_MONTH"
        class="form-control ew-select<?= $Page->MONTH->isInvalidClass() ?>"
        data-select2-id="V_KUNJUNGAN_x_MONTH"
        data-table="V_KUNJUNGAN"
        data-field="x_MONTH"
        data-value-separator="<?= $Page->MONTH->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MONTH->getPlaceHolder()) ?>"
        <?= $Page->MONTH->editAttributes() ?>>
        <?= $Page->MONTH->selectOptionListHtml("x_MONTH") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MONTH->getErrorMessage(false) ?></div>
<?= $Page->MONTH->Lookup->getParamTag($Page, "p_x_MONTH") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KUNJUNGAN_x_MONTH']"),
        options = { name: "x_MONTH", selectId: "V_KUNJUNGAN_x_MONTH", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KUNJUNGAN.fields.MONTH.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
<?php if ($Page->YEAR->Visible) { // YEAR ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_YEAR" class="ew-cell form-group">
        <label for="x_YEAR" class="ew-search-caption ew-label"><?= $Page->YEAR->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_YEAR" id="z_YEAR" value="=">
</span>
        <span id="el_V_KUNJUNGAN_YEAR" class="ew-search-field">
    <select
        id="x_YEAR"
        name="x_YEAR"
        class="form-control ew-select<?= $Page->YEAR->isInvalidClass() ?>"
        data-select2-id="V_KUNJUNGAN_x_YEAR"
        data-table="V_KUNJUNGAN"
        data-field="x_YEAR"
        data-value-separator="<?= $Page->YEAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->YEAR->getPlaceHolder()) ?>"
        <?= $Page->YEAR->editAttributes() ?>>
        <?= $Page->YEAR->selectOptionListHtml("x_YEAR") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->YEAR->getErrorMessage(false) ?></div>
<?= $Page->YEAR->Lookup->getParamTag($Page, "p_x_YEAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KUNJUNGAN_x_YEAR']"),
        options = { name: "x_YEAR", selectId: "V_KUNJUNGAN_x_YEAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KUNJUNGAN.fields.YEAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
    </div>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow == 0) { ?>
</div>
    <?php } ?>
<?php } ?>
    <?php if ($Page->SearchColumnCount % $Page->SearchFieldsPerRow > 0) { ?>
</div>
    <?php } ?>
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> V_KUNJUNGAN">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fV_KUNJUNGANlist" id="fV_KUNJUNGANlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_KUNJUNGAN">
<div id="gmp_V_KUNJUNGAN" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_V_KUNJUNGANlist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_NO_REGISTRATION" class="V_KUNJUNGAN_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <th data-name="VISIT_DATE" class="<?= $Page->VISIT_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_VISIT_DATE" class="V_KUNJUNGAN_VISIT_DATE"><?= $Page->renderSort($Page->VISIT_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <th data-name="PAYOR_ID" class="<?= $Page->PAYOR_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_PAYOR_ID" class="V_KUNJUNGAN_PAYOR_ID"><?= $Page->renderSort($Page->PAYOR_ID) ?></div></th>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
        <th data-name="CLASS_ID" class="<?= $Page->CLASS_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_CLASS_ID" class="V_KUNJUNGAN_CLASS_ID"><?= $Page->renderSort($Page->CLASS_ID) ?></div></th>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th data-name="CLINIC_ID" class="<?= $Page->CLINIC_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_CLINIC_ID" class="V_KUNJUNGAN_CLINIC_ID"><?= $Page->renderSort($Page->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Page->MONTH->Visible) { // MONTH ?>
        <th data-name="MONTH" class="<?= $Page->MONTH->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_MONTH" class="V_KUNJUNGAN_MONTH"><?= $Page->renderSort($Page->MONTH) ?></div></th>
<?php } ?>
<?php if ($Page->YEAR->Visible) { // YEAR ?>
        <th data-name="YEAR" class="<?= $Page->YEAR->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_YEAR" class="V_KUNJUNGAN_YEAR"><?= $Page->renderSort($Page->YEAR) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_V_KUNJUNGAN", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <td data-name="VISIT_DATE" <?= $Page->VISIT_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_VISIT_DATE">
<span<?= $Page->VISIT_DATE->viewAttributes() ?>>
<?= $Page->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <td data-name="PAYOR_ID" <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PAYOR_ID">
<span<?= $Page->PAYOR_ID->viewAttributes() ?>>
<?= $Page->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
        <td data-name="CLASS_ID" <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_CLASS_ID">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MONTH->Visible) { // MONTH ?>
        <td data-name="MONTH" <?= $Page->MONTH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_MONTH">
<span<?= $Page->MONTH->viewAttributes() ?>>
<?= $Page->MONTH->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->YEAR->Visible) { // YEAR ?>
        <td data-name="YEAR" <?= $Page->YEAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_YEAR">
<span<?= $Page->YEAR->viewAttributes() ?>>
<?= $Page->YEAR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("V_KUNJUNGAN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
