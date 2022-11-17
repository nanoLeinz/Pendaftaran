<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$Class2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fCLASS2list;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fCLASS2list = currentForm = new ew.Form("fCLASS2list", "list");
    fCLASS2list.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fCLASS2list");
});
var fCLASS2listsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fCLASS2listsrch = currentSearchForm = new ew.Form("fCLASS2listsrch");

    // Dynamic selection lists

    // Filters
    fCLASS2listsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fCLASS2listsrch");
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
<form name="fCLASS2listsrch" id="fCLASS2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fCLASS2listsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="CLASS2">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> CLASS2">
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
<form name="fCLASS2list" id="fCLASS2list" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CLASS2">
<div id="gmp_CLASS2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_CLASS2list" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
        <th data-name="CLASS_ID" class="<?= $Page->CLASS_ID->headerCellClass() ?>"><div id="elh_CLASS2_CLASS_ID" class="CLASS2_CLASS_ID"><?= $Page->renderSort($Page->CLASS_ID) ?></div></th>
<?php } ?>
<?php if ($Page->NAME_OF_CLASS->Visible) { // NAME_OF_CLASS ?>
        <th data-name="NAME_OF_CLASS" class="<?= $Page->NAME_OF_CLASS->headerCellClass() ?>"><div id="elh_CLASS2_NAME_OF_CLASS" class="CLASS2_NAME_OF_CLASS"><?= $Page->renderSort($Page->NAME_OF_CLASS) ?></div></th>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <th data-name="OTHER_ID" class="<?= $Page->OTHER_ID->headerCellClass() ?>"><div id="elh_CLASS2_OTHER_ID" class="CLASS2_OTHER_ID"><?= $Page->renderSort($Page->OTHER_ID) ?></div></th>
<?php } ?>
<?php if ($Page->KDKELASV->Visible) { // KDKELASV ?>
        <th data-name="KDKELASV" class="<?= $Page->KDKELASV->headerCellClass() ?>"><div id="elh_CLASS2_KDKELASV" class="CLASS2_KDKELASV"><?= $Page->renderSort($Page->KDKELASV) ?></div></th>
<?php } ?>
<?php if ($Page->KODEKELAS->Visible) { // KODEKELAS ?>
        <th data-name="KODEKELAS" class="<?= $Page->KODEKELAS->headerCellClass() ?>"><div id="elh_CLASS2_KODEKELAS" class="CLASS2_KODEKELAS"><?= $Page->renderSort($Page->KODEKELAS) ?></div></th>
<?php } ?>
<?php if ($Page->SISKODEKELAS->Visible) { // SISKODEKELAS ?>
        <th data-name="SISKODEKELAS" class="<?= $Page->SISKODEKELAS->headerCellClass() ?>"><div id="elh_CLASS2_SISKODEKELAS" class="CLASS2_SISKODEKELAS"><?= $Page->renderSort($Page->SISKODEKELAS) ?></div></th>
<?php } ?>
<?php if ($Page->SISKODERAWAT->Visible) { // SISKODERAWAT ?>
        <th data-name="SISKODERAWAT" class="<?= $Page->SISKODERAWAT->headerCellClass() ?>"><div id="elh_CLASS2_SISKODERAWAT" class="CLASS2_SISKODERAWAT"><?= $Page->renderSort($Page->SISKODERAWAT) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_CLASS2", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
        <td data-name="CLASS_ID" <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_CLASS_ID">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAME_OF_CLASS->Visible) { // NAME_OF_CLASS ?>
        <td data-name="NAME_OF_CLASS" <?= $Page->NAME_OF_CLASS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_NAME_OF_CLASS">
<span<?= $Page->NAME_OF_CLASS->viewAttributes() ?>>
<?= $Page->NAME_OF_CLASS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <td data-name="OTHER_ID" <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_OTHER_ID">
<span<?= $Page->OTHER_ID->viewAttributes() ?>>
<?= $Page->OTHER_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KDKELASV->Visible) { // KDKELASV ?>
        <td data-name="KDKELASV" <?= $Page->KDKELASV->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_KDKELASV">
<span<?= $Page->KDKELASV->viewAttributes() ?>>
<?= $Page->KDKELASV->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KODEKELAS->Visible) { // KODEKELAS ?>
        <td data-name="KODEKELAS" <?= $Page->KODEKELAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_KODEKELAS">
<span<?= $Page->KODEKELAS->viewAttributes() ?>>
<?= $Page->KODEKELAS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SISKODEKELAS->Visible) { // SISKODEKELAS ?>
        <td data-name="SISKODEKELAS" <?= $Page->SISKODEKELAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_SISKODEKELAS">
<span<?= $Page->SISKODEKELAS->viewAttributes() ?>>
<?= $Page->SISKODEKELAS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SISKODERAWAT->Visible) { // SISKODERAWAT ?>
        <td data-name="SISKODERAWAT" <?= $Page->SISKODERAWAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_SISKODERAWAT">
<span<?= $Page->SISKODERAWAT->viewAttributes() ?>>
<?= $Page->SISKODERAWAT->getViewValue() ?></span>
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
    ew.addEventHandlers("CLASS2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
