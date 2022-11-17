<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MutationDocsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fMUTATION_DOCSlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fMUTATION_DOCSlist = currentForm = new ew.Form("fMUTATION_DOCSlist", "list");
    fMUTATION_DOCSlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fMUTATION_DOCSlist");
});
var fMUTATION_DOCSlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fMUTATION_DOCSlistsrch = currentSearchForm = new ew.Form("fMUTATION_DOCSlistsrch");

    // Dynamic selection lists

    // Filters
    fMUTATION_DOCSlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fMUTATION_DOCSlistsrch");
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
<form name="fMUTATION_DOCSlistsrch" id="fMUTATION_DOCSlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fMUTATION_DOCSlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="MUTATION_DOCS">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> MUTATION_DOCS">
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
<form name="fMUTATION_DOCSlist" id="fMUTATION_DOCSlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="MUTATION_DOCS">
<div id="gmp_MUTATION_DOCS" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_MUTATION_DOCSlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th data-name="CLINIC_ID" class="<?= $Page->CLINIC_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_MUTATION_DOCS_CLINIC_ID" class="MUTATION_DOCS_CLINIC_ID"><?= $Page->renderSort($Page->CLINIC_ID) ?></div></th>
<?php } ?>
<?php if ($Page->CLINIC_ID_TO->Visible) { // CLINIC_ID_TO ?>
        <th data-name="CLINIC_ID_TO" class="<?= $Page->CLINIC_ID_TO->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_MUTATION_DOCS_CLINIC_ID_TO" class="MUTATION_DOCS_CLINIC_ID_TO"><?= $Page->renderSort($Page->CLINIC_ID_TO) ?></div></th>
<?php } ?>
<?php if ($Page->MUTATION_DATE->Visible) { // MUTATION_DATE ?>
        <th data-name="MUTATION_DATE" class="<?= $Page->MUTATION_DATE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_MUTATION_DOCS_MUTATION_DATE" class="MUTATION_DOCS_MUTATION_DATE"><?= $Page->renderSort($Page->MUTATION_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->MUTATION_VALUE->Visible) { // MUTATION_VALUE ?>
        <th data-name="MUTATION_VALUE" class="<?= $Page->MUTATION_VALUE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_MUTATION_DOCS_MUTATION_VALUE" class="MUTATION_DOCS_MUTATION_VALUE"><?= $Page->renderSort($Page->MUTATION_VALUE) ?></div></th>
<?php } ?>
<?php if ($Page->ORDER_VALUE->Visible) { // ORDER_VALUE ?>
        <th data-name="ORDER_VALUE" class="<?= $Page->ORDER_VALUE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_MUTATION_DOCS_ORDER_VALUE" class="MUTATION_DOCS_ORDER_VALUE"><?= $Page->renderSort($Page->ORDER_VALUE) ?></div></th>
<?php } ?>
<?php if ($Page->RECEIVED_BY->Visible) { // RECEIVED_BY ?>
        <th data-name="RECEIVED_BY" class="<?= $Page->RECEIVED_BY->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_MUTATION_DOCS_RECEIVED_BY" class="MUTATION_DOCS_RECEIVED_BY"><?= $Page->renderSort($Page->RECEIVED_BY) ?></div></th>
<?php } ?>
<?php if ($Page->DISTRIBUTION_TYPE->Visible) { // DISTRIBUTION_TYPE ?>
        <th data-name="DISTRIBUTION_TYPE" class="<?= $Page->DISTRIBUTION_TYPE->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_MUTATION_DOCS_DISTRIBUTION_TYPE" class="MUTATION_DOCS_DISTRIBUTION_TYPE"><?= $Page->renderSort($Page->DISTRIBUTION_TYPE) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_MUTATION_DOCS", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLINIC_ID_TO->Visible) { // CLINIC_ID_TO ?>
        <td data-name="CLINIC_ID_TO" <?= $Page->CLINIC_ID_TO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_CLINIC_ID_TO">
<span<?= $Page->CLINIC_ID_TO->viewAttributes() ?>>
<?= $Page->CLINIC_ID_TO->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MUTATION_DATE->Visible) { // MUTATION_DATE ?>
        <td data-name="MUTATION_DATE" <?= $Page->MUTATION_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_MUTATION_DATE">
<span<?= $Page->MUTATION_DATE->viewAttributes() ?>>
<?= $Page->MUTATION_DATE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MUTATION_VALUE->Visible) { // MUTATION_VALUE ?>
        <td data-name="MUTATION_VALUE" <?= $Page->MUTATION_VALUE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_MUTATION_VALUE">
<span<?= $Page->MUTATION_VALUE->viewAttributes() ?>>
<?= $Page->MUTATION_VALUE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ORDER_VALUE->Visible) { // ORDER_VALUE ?>
        <td data-name="ORDER_VALUE" <?= $Page->ORDER_VALUE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_ORDER_VALUE">
<span<?= $Page->ORDER_VALUE->viewAttributes() ?>>
<?= $Page->ORDER_VALUE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->RECEIVED_BY->Visible) { // RECEIVED_BY ?>
        <td data-name="RECEIVED_BY" <?= $Page->RECEIVED_BY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_RECEIVED_BY">
<span<?= $Page->RECEIVED_BY->viewAttributes() ?>>
<?= $Page->RECEIVED_BY->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DISTRIBUTION_TYPE->Visible) { // DISTRIBUTION_TYPE ?>
        <td data-name="DISTRIBUTION_TYPE" <?= $Page->DISTRIBUTION_TYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_DISTRIBUTION_TYPE">
<span<?= $Page->DISTRIBUTION_TYPE->viewAttributes() ?>>
<?= $Page->DISTRIBUTION_TYPE->getViewValue() ?></span>
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
    ew.addEventHandlers("MUTATION_DOCS");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
