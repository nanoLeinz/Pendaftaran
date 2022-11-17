<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TarifTempList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fTARIF_TEMPlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fTARIF_TEMPlist = currentForm = new ew.Form("fTARIF_TEMPlist", "list");
    fTARIF_TEMPlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fTARIF_TEMPlist");
});
var fTARIF_TEMPlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fTARIF_TEMPlistsrch = currentSearchForm = new ew.Form("fTARIF_TEMPlistsrch");

    // Dynamic selection lists

    // Filters
    fTARIF_TEMPlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fTARIF_TEMPlistsrch");
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
<form name="fTARIF_TEMPlistsrch" id="fTARIF_TEMPlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fTARIF_TEMPlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="TARIF_TEMP">
    <div class="ew-extended-search">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TARIF_TEMP">
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
<form name="fTARIF_TEMPlist" id="fTARIF_TEMPlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TARIF_TEMP">
<div id="gmp_TARIF_TEMP" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_TARIF_TEMPlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
        <th data-name="TARIF_ID" class="<?= $Page->TARIF_ID->headerCellClass() ?>"><div id="elh_TARIF_TEMP_TARIF_ID" class="TARIF_TEMP_TARIF_ID"><?= $Page->renderSort($Page->TARIF_ID) ?></div></th>
<?php } ?>
<?php if ($Page->PERDA_ID->Visible) { // PERDA_ID ?>
        <th data-name="PERDA_ID" class="<?= $Page->PERDA_ID->headerCellClass() ?>"><div id="elh_TARIF_TEMP_PERDA_ID" class="TARIF_TEMP_PERDA_ID"><?= $Page->renderSort($Page->PERDA_ID) ?></div></th>
<?php } ?>
<?php if ($Page->TREAT_ID->Visible) { // TREAT_ID ?>
        <th data-name="TREAT_ID" class="<?= $Page->TREAT_ID->headerCellClass() ?>"><div id="elh_TARIF_TEMP_TREAT_ID" class="TARIF_TEMP_TREAT_ID"><?= $Page->renderSort($Page->TREAT_ID) ?></div></th>
<?php } ?>
<?php if ($Page->TARIF_NAME->Visible) { // TARIF_NAME ?>
        <th data-name="TARIF_NAME" class="<?= $Page->TARIF_NAME->headerCellClass() ?>"><div id="elh_TARIF_TEMP_TARIF_NAME" class="TARIF_TEMP_TARIF_NAME"><?= $Page->renderSort($Page->TARIF_NAME) ?></div></th>
<?php } ?>
<?php if ($Page->KODE->Visible) { // KODE ?>
        <th data-name="KODE" class="<?= $Page->KODE->headerCellClass() ?>"><div id="elh_TARIF_TEMP_KODE" class="TARIF_TEMP_KODE"><?= $Page->renderSort($Page->KODE) ?></div></th>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <th data-name="DESCRIPTION" class="<?= $Page->DESCRIPTION->headerCellClass() ?>"><div id="elh_TARIF_TEMP_DESCRIPTION" class="TARIF_TEMP_DESCRIPTION"><?= $Page->renderSort($Page->DESCRIPTION) ?></div></th>
<?php } ?>
<?php if ($Page->AMOUNT_PAID->Visible) { // AMOUNT_PAID ?>
        <th data-name="AMOUNT_PAID" class="<?= $Page->AMOUNT_PAID->headerCellClass() ?>"><div id="elh_TARIF_TEMP_AMOUNT_PAID" class="TARIF_TEMP_AMOUNT_PAID"><?= $Page->renderSort($Page->AMOUNT_PAID) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_TARIF_TEMP", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
        <td data-name="TARIF_ID" <?= $Page->TARIF_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TARIF_TEMP_TARIF_ID">
<span<?= $Page->TARIF_ID->viewAttributes() ?>>
<?= $Page->TARIF_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PERDA_ID->Visible) { // PERDA_ID ?>
        <td data-name="PERDA_ID" <?= $Page->PERDA_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TARIF_TEMP_PERDA_ID">
<span<?= $Page->PERDA_ID->viewAttributes() ?>>
<?= $Page->PERDA_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TREAT_ID->Visible) { // TREAT_ID ?>
        <td data-name="TREAT_ID" <?= $Page->TREAT_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TARIF_TEMP_TREAT_ID">
<span<?= $Page->TREAT_ID->viewAttributes() ?>>
<?= $Page->TREAT_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TARIF_NAME->Visible) { // TARIF_NAME ?>
        <td data-name="TARIF_NAME" <?= $Page->TARIF_NAME->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TARIF_TEMP_TARIF_NAME">
<span<?= $Page->TARIF_NAME->viewAttributes() ?>>
<?= $Page->TARIF_NAME->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KODE->Visible) { // KODE ?>
        <td data-name="KODE" <?= $Page->KODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TARIF_TEMP_KODE">
<span<?= $Page->KODE->viewAttributes() ?>>
<?= $Page->KODE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <td data-name="DESCRIPTION" <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TARIF_TEMP_DESCRIPTION">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->AMOUNT_PAID->Visible) { // AMOUNT_PAID ?>
        <td data-name="AMOUNT_PAID" <?= $Page->AMOUNT_PAID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TARIF_TEMP_AMOUNT_PAID">
<span<?= $Page->AMOUNT_PAID->viewAttributes() ?>>
<?= $Page->AMOUNT_PAID->getViewValue() ?></span>
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
    ew.addEventHandlers("TARIF_TEMP");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
