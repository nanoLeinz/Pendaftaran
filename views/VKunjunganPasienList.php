<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VKunjunganPasienList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_KUNJUNGAN_PASIENlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fV_KUNJUNGAN_PASIENlist = currentForm = new ew.Form("fV_KUNJUNGAN_PASIENlist", "list");
    fV_KUNJUNGAN_PASIENlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fV_KUNJUNGAN_PASIENlist");
});
var fV_KUNJUNGAN_PASIENlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fV_KUNJUNGAN_PASIENlistsrch = currentSearchForm = new ew.Form("fV_KUNJUNGAN_PASIENlistsrch");

    // Dynamic selection lists

    // Filters
    fV_KUNJUNGAN_PASIENlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fV_KUNJUNGAN_PASIENlistsrch");
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
<form name="fV_KUNJUNGAN_PASIENlistsrch" id="fV_KUNJUNGAN_PASIENlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fV_KUNJUNGAN_PASIENlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="V_KUNJUNGAN_PASIEN">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> V_KUNJUNGAN_PASIEN">
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
<form name="fV_KUNJUNGAN_PASIENlist" id="fV_KUNJUNGAN_PASIENlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_KUNJUNGAN_PASIEN">
<div id="gmp_V_KUNJUNGAN_PASIEN" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_V_KUNJUNGAN_PASIENlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NO_REGISTRATION" class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_PASIEN_NO_REGISTRATION" class="V_KUNJUNGAN_PASIEN_NO_REGISTRATION"><?= $Page->renderSort($Page->NO_REGISTRATION) ?></div></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th data-name="GENDER" class="<?= $Page->GENDER->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_PASIEN_GENDER" class="V_KUNJUNGAN_PASIEN_GENDER"><?= $Page->renderSort($Page->GENDER) ?></div></th>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <th data-name="STATUS_PASIEN_ID" class="<?= $Page->STATUS_PASIEN_ID->headerCellClass() ?>"><div id="elh_V_KUNJUNGAN_PASIEN_STATUS_PASIEN_ID" class="V_KUNJUNGAN_PASIEN_STATUS_PASIEN_ID"><?= $Page->renderSort($Page->STATUS_PASIEN_ID) ?></div></th>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { // TREATMENT ?>
        <th data-name="TREATMENT" class="<?= $Page->TREATMENT->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_PASIEN_TREATMENT" class="V_KUNJUNGAN_PASIEN_TREATMENT"><?= $Page->renderSort($Page->TREATMENT) ?></div></th>
<?php } ?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
        <th data-name="CLASS_ROOM_ID" class="<?= $Page->CLASS_ROOM_ID->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_PASIEN_CLASS_ROOM_ID" class="V_KUNJUNGAN_PASIEN_CLASS_ROOM_ID"><?= $Page->renderSort($Page->CLASS_ROOM_ID) ?></div></th>
<?php } ?>
<?php if ($Page->BED_ID->Visible) { // BED_ID ?>
        <th data-name="BED_ID" class="<?= $Page->BED_ID->headerCellClass() ?>"><div id="elh_V_KUNJUNGAN_PASIEN_BED_ID" class="V_KUNJUNGAN_PASIEN_BED_ID"><?= $Page->renderSort($Page->BED_ID) ?></div></th>
<?php } ?>
<?php if ($Page->DOCTOR->Visible) { // DOCTOR ?>
        <th data-name="DOCTOR" class="<?= $Page->DOCTOR->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_V_KUNJUNGAN_PASIEN_DOCTOR" class="V_KUNJUNGAN_PASIEN_DOCTOR"><?= $Page->renderSort($Page->DOCTOR) ?></div></th>
<?php } ?>
<?php if ($Page->SERVED_INAP->Visible) { // SERVED_INAP ?>
        <th data-name="SERVED_INAP" class="<?= $Page->SERVED_INAP->headerCellClass() ?>"><div id="elh_V_KUNJUNGAN_PASIEN_SERVED_INAP" class="V_KUNJUNGAN_PASIEN_SERVED_INAP"><?= $Page->renderSort($Page->SERVED_INAP) ?></div></th>
<?php } ?>
<?php if ($Page->EXIT_DATE->Visible) { // EXIT_DATE ?>
        <th data-name="EXIT_DATE" class="<?= $Page->EXIT_DATE->headerCellClass() ?>"><div id="elh_V_KUNJUNGAN_PASIEN_EXIT_DATE" class="V_KUNJUNGAN_PASIEN_EXIT_DATE"><?= $Page->renderSort($Page->EXIT_DATE) ?></div></th>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { // KELUAR_ID ?>
        <th data-name="KELUAR_ID" class="<?= $Page->KELUAR_ID->headerCellClass() ?>"><div id="elh_V_KUNJUNGAN_PASIEN_KELUAR_ID" class="V_KUNJUNGAN_PASIEN_KELUAR_ID"><?= $Page->renderSort($Page->KELUAR_ID) ?></div></th>
<?php } ?>
<?php if ($Page->AGEYEAR->Visible) { // AGEYEAR ?>
        <th data-name="AGEYEAR" class="<?= $Page->AGEYEAR->headerCellClass() ?>"><div id="elh_V_KUNJUNGAN_PASIEN_AGEYEAR" class="V_KUNJUNGAN_PASIEN_AGEYEAR"><?= $Page->renderSort($Page->AGEYEAR) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_V_KUNJUNGAN_PASIEN", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_STATUS_PASIEN_ID">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->TREATMENT->Visible) { // TREATMENT ?>
        <td data-name="TREATMENT" <?= $Page->TREATMENT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_TREATMENT">
<span<?= $Page->TREATMENT->viewAttributes() ?>>
<?= $Page->TREATMENT->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
        <td data-name="CLASS_ROOM_ID" <?= $Page->CLASS_ROOM_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_CLASS_ROOM_ID">
<span<?= $Page->CLASS_ROOM_ID->viewAttributes() ?>>
<?= $Page->CLASS_ROOM_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->BED_ID->Visible) { // BED_ID ?>
        <td data-name="BED_ID" <?= $Page->BED_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_BED_ID">
<span<?= $Page->BED_ID->viewAttributes() ?>>
<?= $Page->BED_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DOCTOR->Visible) { // DOCTOR ?>
        <td data-name="DOCTOR" <?= $Page->DOCTOR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_DOCTOR">
<span<?= $Page->DOCTOR->viewAttributes() ?>>
<?= $Page->DOCTOR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SERVED_INAP->Visible) { // SERVED_INAP ?>
        <td data-name="SERVED_INAP" <?= $Page->SERVED_INAP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_SERVED_INAP">
<span<?= $Page->SERVED_INAP->viewAttributes() ?>>
<?= $Page->SERVED_INAP->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->EXIT_DATE->Visible) { // EXIT_DATE ?>
        <td data-name="EXIT_DATE" <?= $Page->EXIT_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_EXIT_DATE">
<span<?= $Page->EXIT_DATE->viewAttributes() ?>>
<?= $Page->EXIT_DATE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KELUAR_ID->Visible) { // KELUAR_ID ?>
        <td data-name="KELUAR_ID" <?= $Page->KELUAR_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_KELUAR_ID">
<span<?= $Page->KELUAR_ID->viewAttributes() ?>>
<?= $Page->KELUAR_ID->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->AGEYEAR->Visible) { // AGEYEAR ?>
        <td data-name="AGEYEAR" <?= $Page->AGEYEAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_V_KUNJUNGAN_PASIEN_AGEYEAR">
<span<?= $Page->AGEYEAR->viewAttributes() ?>>
<?= $Page->AGEYEAR->getViewValue() ?></span>
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
    ew.addEventHandlers("V_KUNJUNGAN_PASIEN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
