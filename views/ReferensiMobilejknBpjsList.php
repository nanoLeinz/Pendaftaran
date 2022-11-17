<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ReferensiMobilejknBpjsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var freferensi_mobilejkn_bpjslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    freferensi_mobilejkn_bpjslist = currentForm = new ew.Form("freferensi_mobilejkn_bpjslist", "list");
    freferensi_mobilejkn_bpjslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("freferensi_mobilejkn_bpjslist");
});
var freferensi_mobilejkn_bpjslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    freferensi_mobilejkn_bpjslistsrch = currentSearchForm = new ew.Form("freferensi_mobilejkn_bpjslistsrch");

    // Dynamic selection lists

    // Filters
    freferensi_mobilejkn_bpjslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("freferensi_mobilejkn_bpjslistsrch");
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
<form name="freferensi_mobilejkn_bpjslistsrch" id="freferensi_mobilejkn_bpjslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="freferensi_mobilejkn_bpjslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> referensi_mobilejkn_bpjs">
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
<form name="freferensi_mobilejkn_bpjslist" id="freferensi_mobilejkn_bpjslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs">
<div id="gmp_referensi_mobilejkn_bpjs" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_referensi_mobilejkn_bpjslist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_id" class="referensi_mobilejkn_bpjs_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
        <th data-name="nobooking" class="<?= $Page->nobooking->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_nobooking" class="referensi_mobilejkn_bpjs_nobooking"><?= $Page->renderSort($Page->nobooking) ?></div></th>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th data-name="no_rawat" class="<?= $Page->no_rawat->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_no_rawat" class="referensi_mobilejkn_bpjs_no_rawat"><?= $Page->renderSort($Page->no_rawat) ?></div></th>
<?php } ?>
<?php if ($Page->nomorkartu->Visible) { // nomorkartu ?>
        <th data-name="nomorkartu" class="<?= $Page->nomorkartu->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_nomorkartu" class="referensi_mobilejkn_bpjs_nomorkartu"><?= $Page->renderSort($Page->nomorkartu) ?></div></th>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_nik" class="referensi_mobilejkn_bpjs_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->nohp->Visible) { // nohp ?>
        <th data-name="nohp" class="<?= $Page->nohp->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_nohp" class="referensi_mobilejkn_bpjs_nohp"><?= $Page->renderSort($Page->nohp) ?></div></th>
<?php } ?>
<?php if ($Page->kodepoli->Visible) { // kodepoli ?>
        <th data-name="kodepoli" class="<?= $Page->kodepoli->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_kodepoli" class="referensi_mobilejkn_bpjs_kodepoli"><?= $Page->renderSort($Page->kodepoli) ?></div></th>
<?php } ?>
<?php if ($Page->pasienbaru->Visible) { // pasienbaru ?>
        <th data-name="pasienbaru" class="<?= $Page->pasienbaru->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_pasienbaru" class="referensi_mobilejkn_bpjs_pasienbaru"><?= $Page->renderSort($Page->pasienbaru) ?></div></th>
<?php } ?>
<?php if ($Page->norm->Visible) { // norm ?>
        <th data-name="norm" class="<?= $Page->norm->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_norm" class="referensi_mobilejkn_bpjs_norm"><?= $Page->renderSort($Page->norm) ?></div></th>
<?php } ?>
<?php if ($Page->tanggalperiksa->Visible) { // tanggalperiksa ?>
        <th data-name="tanggalperiksa" class="<?= $Page->tanggalperiksa->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_tanggalperiksa" class="referensi_mobilejkn_bpjs_tanggalperiksa"><?= $Page->renderSort($Page->tanggalperiksa) ?></div></th>
<?php } ?>
<?php if ($Page->kodedokter->Visible) { // kodedokter ?>
        <th data-name="kodedokter" class="<?= $Page->kodedokter->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_kodedokter" class="referensi_mobilejkn_bpjs_kodedokter"><?= $Page->renderSort($Page->kodedokter) ?></div></th>
<?php } ?>
<?php if ($Page->jampraktek->Visible) { // jampraktek ?>
        <th data-name="jampraktek" class="<?= $Page->jampraktek->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_jampraktek" class="referensi_mobilejkn_bpjs_jampraktek"><?= $Page->renderSort($Page->jampraktek) ?></div></th>
<?php } ?>
<?php if ($Page->jeniskunjungan->Visible) { // jeniskunjungan ?>
        <th data-name="jeniskunjungan" class="<?= $Page->jeniskunjungan->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_jeniskunjungan" class="referensi_mobilejkn_bpjs_jeniskunjungan"><?= $Page->renderSort($Page->jeniskunjungan) ?></div></th>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
        <th data-name="nomorreferensi" class="<?= $Page->nomorreferensi->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_nomorreferensi" class="referensi_mobilejkn_bpjs_nomorreferensi"><?= $Page->renderSort($Page->nomorreferensi) ?></div></th>
<?php } ?>
<?php if ($Page->nomorantrean->Visible) { // nomorantrean ?>
        <th data-name="nomorantrean" class="<?= $Page->nomorantrean->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_nomorantrean" class="referensi_mobilejkn_bpjs_nomorantrean"><?= $Page->renderSort($Page->nomorantrean) ?></div></th>
<?php } ?>
<?php if ($Page->angkaantrean->Visible) { // angkaantrean ?>
        <th data-name="angkaantrean" class="<?= $Page->angkaantrean->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_angkaantrean" class="referensi_mobilejkn_bpjs_angkaantrean"><?= $Page->renderSort($Page->angkaantrean) ?></div></th>
<?php } ?>
<?php if ($Page->estimasidilayani->Visible) { // estimasidilayani ?>
        <th data-name="estimasidilayani" class="<?= $Page->estimasidilayani->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_estimasidilayani" class="referensi_mobilejkn_bpjs_estimasidilayani"><?= $Page->renderSort($Page->estimasidilayani) ?></div></th>
<?php } ?>
<?php if ($Page->sisakuotajkn->Visible) { // sisakuotajkn ?>
        <th data-name="sisakuotajkn" class="<?= $Page->sisakuotajkn->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_sisakuotajkn" class="referensi_mobilejkn_bpjs_sisakuotajkn"><?= $Page->renderSort($Page->sisakuotajkn) ?></div></th>
<?php } ?>
<?php if ($Page->kuotajkn->Visible) { // kuotajkn ?>
        <th data-name="kuotajkn" class="<?= $Page->kuotajkn->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_kuotajkn" class="referensi_mobilejkn_bpjs_kuotajkn"><?= $Page->renderSort($Page->kuotajkn) ?></div></th>
<?php } ?>
<?php if ($Page->sisakuotanonjkn->Visible) { // sisakuotanonjkn ?>
        <th data-name="sisakuotanonjkn" class="<?= $Page->sisakuotanonjkn->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_sisakuotanonjkn" class="referensi_mobilejkn_bpjs_sisakuotanonjkn"><?= $Page->renderSort($Page->sisakuotanonjkn) ?></div></th>
<?php } ?>
<?php if ($Page->kuotanonjkn->Visible) { // kuotanonjkn ?>
        <th data-name="kuotanonjkn" class="<?= $Page->kuotanonjkn->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_kuotanonjkn" class="referensi_mobilejkn_bpjs_kuotanonjkn"><?= $Page->renderSort($Page->kuotanonjkn) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_status" class="referensi_mobilejkn_bpjs_status"><?= $Page->renderSort($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->validasi->Visible) { // validasi ?>
        <th data-name="validasi" class="<?= $Page->validasi->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_validasi" class="referensi_mobilejkn_bpjs_validasi"><?= $Page->renderSort($Page->validasi) ?></div></th>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
        <th data-name="statuskirim" class="<?= $Page->statuskirim->headerCellClass() ?>"><div id="elh_referensi_mobilejkn_bpjs_statuskirim" class="referensi_mobilejkn_bpjs_statuskirim"><?= $Page->renderSort($Page->statuskirim) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_referensi_mobilejkn_bpjs", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nobooking->Visible) { // nobooking ?>
        <td data-name="nobooking" <?= $Page->nobooking->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nobooking">
<span<?= $Page->nobooking->viewAttributes() ?>>
<?= $Page->nobooking->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nomorkartu->Visible) { // nomorkartu ?>
        <td data-name="nomorkartu" <?= $Page->nomorkartu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nomorkartu">
<span<?= $Page->nomorkartu->viewAttributes() ?>>
<?= $Page->nomorkartu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nik->Visible) { // nik ?>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nohp->Visible) { // nohp ?>
        <td data-name="nohp" <?= $Page->nohp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nohp">
<span<?= $Page->nohp->viewAttributes() ?>>
<?= $Page->nohp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kodepoli->Visible) { // kodepoli ?>
        <td data-name="kodepoli" <?= $Page->kodepoli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_kodepoli">
<span<?= $Page->kodepoli->viewAttributes() ?>>
<?= $Page->kodepoli->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pasienbaru->Visible) { // pasienbaru ?>
        <td data-name="pasienbaru" <?= $Page->pasienbaru->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_pasienbaru">
<span<?= $Page->pasienbaru->viewAttributes() ?>>
<?= $Page->pasienbaru->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->norm->Visible) { // norm ?>
        <td data-name="norm" <?= $Page->norm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_norm">
<span<?= $Page->norm->viewAttributes() ?>>
<?= $Page->norm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggalperiksa->Visible) { // tanggalperiksa ?>
        <td data-name="tanggalperiksa" <?= $Page->tanggalperiksa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_tanggalperiksa">
<span<?= $Page->tanggalperiksa->viewAttributes() ?>>
<?= $Page->tanggalperiksa->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kodedokter->Visible) { // kodedokter ?>
        <td data-name="kodedokter" <?= $Page->kodedokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_kodedokter">
<span<?= $Page->kodedokter->viewAttributes() ?>>
<?= $Page->kodedokter->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jampraktek->Visible) { // jampraktek ?>
        <td data-name="jampraktek" <?= $Page->jampraktek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_jampraktek">
<span<?= $Page->jampraktek->viewAttributes() ?>>
<?= $Page->jampraktek->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jeniskunjungan->Visible) { // jeniskunjungan ?>
        <td data-name="jeniskunjungan" <?= $Page->jeniskunjungan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_jeniskunjungan">
<span<?= $Page->jeniskunjungan->viewAttributes() ?>>
<?= $Page->jeniskunjungan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
        <td data-name="nomorreferensi" <?= $Page->nomorreferensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nomorreferensi">
<span<?= $Page->nomorreferensi->viewAttributes() ?>>
<?= $Page->nomorreferensi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nomorantrean->Visible) { // nomorantrean ?>
        <td data-name="nomorantrean" <?= $Page->nomorantrean->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_nomorantrean">
<span<?= $Page->nomorantrean->viewAttributes() ?>>
<?= $Page->nomorantrean->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->angkaantrean->Visible) { // angkaantrean ?>
        <td data-name="angkaantrean" <?= $Page->angkaantrean->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_angkaantrean">
<span<?= $Page->angkaantrean->viewAttributes() ?>>
<?= $Page->angkaantrean->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->estimasidilayani->Visible) { // estimasidilayani ?>
        <td data-name="estimasidilayani" <?= $Page->estimasidilayani->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_estimasidilayani">
<span<?= $Page->estimasidilayani->viewAttributes() ?>>
<?= $Page->estimasidilayani->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sisakuotajkn->Visible) { // sisakuotajkn ?>
        <td data-name="sisakuotajkn" <?= $Page->sisakuotajkn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_sisakuotajkn">
<span<?= $Page->sisakuotajkn->viewAttributes() ?>>
<?= $Page->sisakuotajkn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kuotajkn->Visible) { // kuotajkn ?>
        <td data-name="kuotajkn" <?= $Page->kuotajkn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_kuotajkn">
<span<?= $Page->kuotajkn->viewAttributes() ?>>
<?= $Page->kuotajkn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sisakuotanonjkn->Visible) { // sisakuotanonjkn ?>
        <td data-name="sisakuotanonjkn" <?= $Page->sisakuotanonjkn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_sisakuotanonjkn">
<span<?= $Page->sisakuotanonjkn->viewAttributes() ?>>
<?= $Page->sisakuotanonjkn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kuotanonjkn->Visible) { // kuotanonjkn ?>
        <td data-name="kuotanonjkn" <?= $Page->kuotanonjkn->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_kuotanonjkn">
<span<?= $Page->kuotanonjkn->viewAttributes() ?>>
<?= $Page->kuotanonjkn->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->validasi->Visible) { // validasi ?>
        <td data-name="validasi" <?= $Page->validasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_validasi">
<span<?= $Page->validasi->viewAttributes() ?>>
<?= $Page->validasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->statuskirim->Visible) { // statuskirim ?>
        <td data-name="statuskirim" <?= $Page->statuskirim->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_referensi_mobilejkn_bpjs_statuskirim">
<span<?= $Page->statuskirim->viewAttributes() ?>>
<?= $Page->statuskirim->getViewValue() ?></span>
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
    ew.addEventHandlers("referensi_mobilejkn_bpjs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
