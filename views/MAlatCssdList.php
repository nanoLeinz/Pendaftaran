<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MAlatCssdList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fm_alat_cssdlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fm_alat_cssdlist = currentForm = new ew.Form("fm_alat_cssdlist", "list");
    fm_alat_cssdlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fm_alat_cssdlist");
});
var fm_alat_cssdlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fm_alat_cssdlistsrch = currentSearchForm = new ew.Form("fm_alat_cssdlistsrch");

    // Dynamic selection lists

    // Filters
    fm_alat_cssdlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fm_alat_cssdlistsrch");
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
<form name="fm_alat_cssdlistsrch" id="fm_alat_cssdlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fm_alat_cssdlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_alat_cssd">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_alat_cssd">
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
<form name="fm_alat_cssdlist" id="fm_alat_cssdlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_alat_cssd">
<div id="gmp_m_alat_cssd" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_m_alat_cssdlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->nama_alat->Visible) { // nama_alat ?>
        <th data-name="nama_alat" class="<?= $Page->nama_alat->headerCellClass() ?>"><div id="elh_m_alat_cssd_nama_alat" class="m_alat_cssd_nama_alat"><?= $Page->renderSort($Page->nama_alat) ?></div></th>
<?php } ?>
<?php if ($Page->id_set->Visible) { // id_set ?>
        <th data-name="id_set" class="<?= $Page->id_set->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_alat_cssd_id_set" class="m_alat_cssd_id_set"><?= $Page->renderSort($Page->id_set) ?></div></th>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
        <th data-name="keadaan" class="<?= $Page->keadaan->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_alat_cssd_keadaan" class="m_alat_cssd_keadaan"><?= $Page->renderSort($Page->keadaan) ?></div></th>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
        <th data-name="jumlah" class="<?= $Page->jumlah->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_m_alat_cssd_jumlah" class="m_alat_cssd_jumlah"><?= $Page->renderSort($Page->jumlah) ?></div></th>
<?php } ?>
<?php if ($Page->merk->Visible) { // merk ?>
        <th data-name="merk" class="<?= $Page->merk->headerCellClass() ?>"><div id="elh_m_alat_cssd_merk" class="m_alat_cssd_merk"><?= $Page->renderSort($Page->merk) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_m_alat_cssd", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->nama_alat->Visible) { // nama_alat ?>
        <td data-name="nama_alat" <?= $Page->nama_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_nama_alat">
<span<?= $Page->nama_alat->viewAttributes() ?>>
<?= $Page->nama_alat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_set->Visible) { // id_set ?>
        <td data-name="id_set" <?= $Page->id_set->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_id_set">
<span<?= $Page->id_set->viewAttributes() ?>>
<?= $Page->id_set->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keadaan->Visible) { // keadaan ?>
        <td data-name="keadaan" <?= $Page->keadaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumlah->Visible) { // jumlah ?>
        <td data-name="jumlah" <?= $Page->jumlah->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_jumlah">
<span<?= $Page->jumlah->viewAttributes() ?>>
<?= $Page->jumlah->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->merk->Visible) { // merk ?>
        <td data-name="merk" <?= $Page->merk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_merk">
<span<?= $Page->merk->viewAttributes() ?>>
<?= $Page->merk->getViewValue() ?></span>
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
    ew.addEventHandlers("m_alat_cssd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
