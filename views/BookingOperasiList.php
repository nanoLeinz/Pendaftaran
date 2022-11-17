<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$BookingOperasiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbooking_operasilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fbooking_operasilist = currentForm = new ew.Form("fbooking_operasilist", "list");
    fbooking_operasilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fbooking_operasilist");
});
var fbooking_operasilistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fbooking_operasilistsrch = currentSearchForm = new ew.Form("fbooking_operasilistsrch");

    // Dynamic selection lists

    // Filters
    fbooking_operasilistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbooking_operasilistsrch");
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
<form name="fbooking_operasilistsrch" id="fbooking_operasilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbooking_operasilistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="booking_operasi">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> booking_operasi">
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
<form name="fbooking_operasilist" id="fbooking_operasilist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="booking_operasi">
<div id="gmp_booking_operasi" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_booking_operasilist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_booking_operasi_id" class="booking_operasi_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th data-name="no_rawat" class="<?= $Page->no_rawat->headerCellClass() ?>"><div id="elh_booking_operasi_no_rawat" class="booking_operasi_no_rawat"><?= $Page->renderSort($Page->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Page->kode_paket->Visible) { // kode_paket ?>
        <th data-name="kode_paket" class="<?= $Page->kode_paket->headerCellClass() ?>"><div id="elh_booking_operasi_kode_paket" class="booking_operasi_kode_paket"><?= $Page->renderSort($Page->kode_paket) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th data-name="tanggal" class="<?= $Page->tanggal->headerCellClass() ?>"><div id="elh_booking_operasi_tanggal" class="booking_operasi_tanggal"><?= $Page->renderSort($Page->tanggal) ?></div></th>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
        <th data-name="jam_mulai" class="<?= $Page->jam_mulai->headerCellClass() ?>"><div id="elh_booking_operasi_jam_mulai" class="booking_operasi_jam_mulai"><?= $Page->renderSort($Page->jam_mulai) ?></div></th>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
        <th data-name="jam_selesai" class="<?= $Page->jam_selesai->headerCellClass() ?>"><div id="elh_booking_operasi_jam_selesai" class="booking_operasi_jam_selesai"><?= $Page->renderSort($Page->jam_selesai) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_booking_operasi_status" class="booking_operasi_status"><?= $Page->renderSort($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th data-name="kd_dokter" class="<?= $Page->kd_dokter->headerCellClass() ?>"><div id="elh_booking_operasi_kd_dokter" class="booking_operasi_kd_dokter"><?= $Page->renderSort($Page->kd_dokter) ?></div></th>
<?php } ?>
<?php if ($Page->kd_ruang_ok->Visible) { // kd_ruang_ok ?>
        <th data-name="kd_ruang_ok" class="<?= $Page->kd_ruang_ok->headerCellClass() ?>"><div id="elh_booking_operasi_kd_ruang_ok" class="booking_operasi_kd_ruang_ok"><?= $Page->renderSort($Page->kd_ruang_ok) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_booking_operasi", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kode_paket->Visible) { // kode_paket ?>
        <td data-name="kode_paket" <?= $Page->kode_paket->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_kode_paket">
<span<?= $Page->kode_paket->viewAttributes() ?>>
<?= $Page->kode_paket->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
        <td data-name="jam_mulai" <?= $Page->jam_mulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_jam_mulai">
<span<?= $Page->jam_mulai->viewAttributes() ?>>
<?= $Page->jam_mulai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
        <td data-name="jam_selesai" <?= $Page->jam_selesai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_jam_selesai">
<span<?= $Page->jam_selesai->viewAttributes() ?>>
<?= $Page->jam_selesai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kd_ruang_ok->Visible) { // kd_ruang_ok ?>
        <td data-name="kd_ruang_ok" <?= $Page->kd_ruang_ok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_kd_ruang_ok">
<span<?= $Page->kd_ruang_ok->viewAttributes() ?>>
<?= $Page->kd_ruang_ok->getViewValue() ?></span>
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
    ew.addEventHandlers("booking_operasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
