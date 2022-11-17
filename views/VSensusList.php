<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VSensusList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_SENSUSlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fV_SENSUSlist = currentForm = new ew.Form("fV_SENSUSlist", "list");
    fV_SENSUSlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fV_SENSUSlist");
});
var fV_SENSUSlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fV_SENSUSlistsrch = currentSearchForm = new ew.Form("fV_SENSUSlistsrch");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "V_SENSUS")) ?>,
        fields = currentTable.fields;
    fV_SENSUSlistsrch.addFields([
        ["VISIT_DATE", [ew.Validators.datetime(5)], fields.VISIT_DATE.isInvalid],
        ["NO_REGISTRATION", [], fields.NO_REGISTRATION.isInvalid],
        ["NAME_OF_CLINIC", [], fields.NAME_OF_CLINIC.isInvalid],
        ["GENDER", [], fields.GENDER.isInvalid],
        ["STATUS_PASIEN_ID", [], fields.STATUS_PASIEN_ID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fV_SENSUSlistsrch.setInvalid();
    });

    // Validate form
    fV_SENSUSlistsrch.validate = function () {
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
    fV_SENSUSlistsrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fV_SENSUSlistsrch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists

    // Filters
    fV_SENSUSlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fV_SENSUSlistsrch");
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
<form name="fV_SENSUSlistsrch" id="fV_SENSUSlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fV_SENSUSlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="V_SENSUS">
    <div class="ew-extended-search">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
    <?php
        $Page->SearchColumnCount++;
        if (($Page->SearchColumnCount - 1) % $Page->SearchFieldsPerRow == 0) {
            $Page->SearchRowCount++;
    ?>
<div id="xsr_<?= $Page->SearchRowCount ?>" class="ew-row d-sm-flex">
    <?php
        }
     ?>
    <div id="xsc_VISIT_DATE" class="ew-cell form-group">
        <label for="x_VISIT_DATE" class="ew-search-caption ew-label"><?= $Page->VISIT_DATE->caption() ?></label>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_VISIT_DATE" id="z_VISIT_DATE" value="=">
</span>
        <span id="el_V_SENSUS_VISIT_DATE" class="ew-search-field">
<input type="<?= $Page->VISIT_DATE->getInputTextType() ?>" data-table="V_SENSUS" data-field="x_VISIT_DATE" name="x_VISIT_DATE" id="x_VISIT_DATE" placeholder="<?= HtmlEncode($Page->VISIT_DATE->getPlaceHolder()) ?>" value="<?= $Page->VISIT_DATE->EditValue ?>"<?= $Page->VISIT_DATE->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->VISIT_DATE->getErrorMessage(false) ?></div>
<?php if (!$Page->VISIT_DATE->ReadOnly && !$Page->VISIT_DATE->Disabled && !isset($Page->VISIT_DATE->EditAttrs["readonly"]) && !isset($Page->VISIT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_SENSUSlistsrch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_SENSUSlistsrch", "x_VISIT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":5});
});
</script>
<?php } ?>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> V_SENSUS">
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
<form name="fV_SENSUSlist" id="fV_SENSUSlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_SENSUS">
<div id="gmp_V_SENSUS" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_V_SENSUSlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <th data-name="VISIT_DATE" class="<?= $Page->VISIT_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_SENSUS_VISIT_DATE" class="V_SENSUS_VISIT_DATE"><?= $Page->renderSort($Page->VISIT_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>"><div id="elh_V_SENSUS_NO_REGISTRATION" class="V_SENSUS_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->NAME_OF_CLINIC->Visible) { // NAME_OF_CLINIC ?>
        <th data-name="NAME_OF_CLINIC" class="<?= $Page->NAME_OF_CLINIC->headerCellClass() ?>"><div id="elh_V_SENSUS_NAME_OF_CLINIC" class="V_SENSUS_NAME_OF_CLINIC"><?= $Page->renderSort($Page->NAME_OF_CLINIC) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>"><div id="elh_V_SENSUS_GENDER" class="V_SENSUS_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <th data-name="STATUS_PASIEN_ID" class="<?= $Page->STATUS_PASIEN_ID->headerCellClass() ?>"><div id="elh_V_SENSUS_STATUS_PASIEN_ID" class="V_SENSUS_STATUS_PASIEN_ID"><?= $Page->renderSort($Page->STATUS_PASIEN_ID) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_V_SENSUS", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <td data-name="VISIT_DATE" <?= $Page->VISIT_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_SENSUS_VISIT_DATE">
<span<?= $Page->VISIT_DATE->viewAttributes() ?>>
<?= $Page->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_SENSUS_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAME_OF_CLINIC->Visible) { // NAME_OF_CLINIC ?>
        <td data-name="NAME_OF_CLINIC" <?= $Page->NAME_OF_CLINIC->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_SENSUS_NAME_OF_CLINIC">
<span<?= $Page->NAME_OF_CLINIC->viewAttributes() ?>>
<?= $Page->NAME_OF_CLINIC->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_SENSUS_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_SENSUS_STATUS_PASIEN_ID">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
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
    ew.addEventHandlers("V_SENSUS");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
