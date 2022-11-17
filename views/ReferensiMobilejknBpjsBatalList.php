<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ReferensiMobilejknBpjsBatalList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var freferensi_mobilejkn_bpjs_batallist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    freferensi_mobilejkn_bpjs_batallist = currentForm = new ew.Form("freferensi_mobilejkn_bpjs_batallist", "list");
    freferensi_mobilejkn_bpjs_batallist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("freferensi_mobilejkn_bpjs_batallist");
});
var freferensi_mobilejkn_bpjs_batallistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    freferensi_mobilejkn_bpjs_batallistsrch = currentSearchForm = new ew.Form("freferensi_mobilejkn_bpjs_batallistsrch");

    // Dynamic selection lists

    // Filters
    freferensi_mobilejkn_bpjs_batallistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("freferensi_mobilejkn_bpjs_batallistsrch");
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
<form name="freferensi_mobilejkn_bpjs_batallistsrch" id="freferensi_mobilejkn_bpjs_batallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="freferensi_mobilejkn_bpjs_batallistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs_batal">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> referensi_mobilejkn_bpjs_batal">
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
<form name="freferensi_mobilejkn_bpjs_batallist" id="freferensi_mobilejkn_bpjs_batallist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs_batal">
<div id="gmp_referensi_mobilejkn_bpjs_batal" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_referensi_mobilejkn_bpjs_batallist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <th data-name="no_rkm_medis" class="<?= $Page->no_rkm_medis->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_batal_no_rkm_medis" class="referensi_mobilejkn_bpjs_batal_no_rkm_medis"><?= $Page->renderSort($Page->no_rkm_medis) ?></div></th>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
        <th data-name="nomorreferensi" class="<?= $Page->nomorreferensi->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_batal_nomorreferensi" class="referensi_mobilejkn_bpjs_batal_nomorreferensi"><?= $Page->renderSort($Page->nomorreferensi) ?></div></th>
<?php } ?>
<?php if ($Page->tanggalbatal->Visible) { // tanggalbatal ?>
        <th data-name="tanggalbatal" class="<?= $Page->tanggalbatal->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_batal_tanggalbatal" class="referensi_mobilejkn_bpjs_batal_tanggalbatal"><?= $Page->renderSort($Page->tanggalbatal) ?></div></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th data-name="keterangan" class="<?= $Page->keterangan->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_batal_keterangan" class="referensi_mobilejkn_bpjs_batal_keterangan"><?= $Page->renderSort($Page->keterangan) ?></div></th>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
        <th data-name="statuskirim" class="<?= $Page->statuskirim->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_batal_statuskirim" class="referensi_mobilejkn_bpjs_batal_statuskirim"><?= $Page->renderSort($Page->statuskirim) ?></div></th>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
        <th data-name="nobooking" class="<?= $Page->nobooking->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_batal_nobooking" class="referensi_mobilejkn_bpjs_batal_nobooking"><?= $Page->renderSort($Page->nobooking) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_referensi_mobilejkn_bpjs_batal", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
        <td data-name="nomorreferensi" <?= $Page->nomorreferensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_nomorreferensi">
<span<?= $Page->nomorreferensi->viewAttributes() ?>>
<?= $Page->nomorreferensi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggalbatal->Visible) { // tanggalbatal ?>
        <td data-name="tanggalbatal" <?= $Page->tanggalbatal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_tanggalbatal">
<span<?= $Page->tanggalbatal->viewAttributes() ?>>
<?= $Page->tanggalbatal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan" <?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->statuskirim->Visible) { // statuskirim ?>
        <td data-name="statuskirim" <?= $Page->statuskirim->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_statuskirim">
<span<?= $Page->statuskirim->viewAttributes() ?>>
<?= $Page->statuskirim->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nobooking->Visible) { // nobooking ?>
        <td data-name="nobooking" <?= $Page->nobooking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_batal_nobooking">
<span<?= $Page->nobooking->viewAttributes() ?>>
<?= $Page->nobooking->getViewValue() ?></span>
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
    ew.addEventHandlers("referensi_mobilejkn_bpjs_batal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
