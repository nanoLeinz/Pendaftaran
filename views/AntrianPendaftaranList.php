<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AntrianPendaftaranList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fANTRIAN_PENDAFTARANlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fANTRIAN_PENDAFTARANlist = currentForm = new ew.Form("fANTRIAN_PENDAFTARANlist", "list");
    fANTRIAN_PENDAFTARANlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fANTRIAN_PENDAFTARANlist");
});
var fANTRIAN_PENDAFTARANlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fANTRIAN_PENDAFTARANlistsrch = currentSearchForm = new ew.Form("fANTRIAN_PENDAFTARANlistsrch");

    // Dynamic selection lists

    // Filters
    fANTRIAN_PENDAFTARANlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fANTRIAN_PENDAFTARANlistsrch");
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
<form name="fANTRIAN_PENDAFTARANlistsrch" id="fANTRIAN_PENDAFTARANlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fANTRIAN_PENDAFTARANlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ANTRIAN_PENDAFTARAN">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ANTRIAN_PENDAFTARAN">
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
<form name="fANTRIAN_PENDAFTARANlist" id="fANTRIAN_PENDAFTARANlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ANTRIAN_PENDAFTARAN">
<div id="gmp_ANTRIAN_PENDAFTARAN" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_ANTRIAN_PENDAFTARANlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->Id->Visible) { // Id ?>
        <th data-name="Id" class="<?= $Page->Id->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_Id" class="ANTRIAN_PENDAFTARAN_Id"><?= $Page->renderSort($Page->Id) ?></div></th>
<?php } ?>
<?php if ($Page->no_urut->Visible) { // no_urut ?>
        <th data-name="no_urut" class="<?= $Page->no_urut->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_no_urut" class="ANTRIAN_PENDAFTARAN_no_urut"><?= $Page->renderSort($Page->no_urut) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal_daftar->Visible) { // tanggal_daftar ?>
        <th data-name="tanggal_daftar" class="<?= $Page->tanggal_daftar->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_tanggal_daftar" class="ANTRIAN_PENDAFTARAN_tanggal_daftar"><?= $Page->renderSort($Page->tanggal_daftar) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal_panggil->Visible) { // tanggal_panggil ?>
        <th data-name="tanggal_panggil" class="<?= $Page->tanggal_panggil->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_tanggal_panggil" class="ANTRIAN_PENDAFTARAN_tanggal_panggil"><?= $Page->renderSort($Page->tanggal_panggil) ?></div></th>
<?php } ?>
<?php if ($Page->loket->Visible) { // loket ?>
        <th data-name="loket" class="<?= $Page->loket->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_loket" class="ANTRIAN_PENDAFTARAN_loket"><?= $Page->renderSort($Page->loket) ?></div></th>
<?php } ?>
<?php if ($Page->status_panggil->Visible) { // status_panggil ?>
        <th data-name="status_panggil" class="<?= $Page->status_panggil->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_status_panggil" class="ANTRIAN_PENDAFTARAN_status_panggil"><?= $Page->renderSort($Page->status_panggil) ?></div></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th data-name="user" class="<?= $Page->user->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_user" class="ANTRIAN_PENDAFTARAN_user"><?= $Page->renderSort($Page->user) ?></div></th>
<?php } ?>
<?php if ($Page->newapp->Visible) { // newapp ?>
        <th data-name="newapp" class="<?= $Page->newapp->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_newapp" class="ANTRIAN_PENDAFTARAN_newapp"><?= $Page->renderSort($Page->newapp) ?></div></th>
<?php } ?>
<?php if ($Page->kdpoli->Visible) { // kdpoli ?>
        <th data-name="kdpoli" class="<?= $Page->kdpoli->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_kdpoli" class="ANTRIAN_PENDAFTARAN_kdpoli"><?= $Page->renderSort($Page->kdpoli) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal_pesan->Visible) { // tanggal_pesan ?>
        <th data-name="tanggal_pesan" class="<?= $Page->tanggal_pesan->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_tanggal_pesan" class="ANTRIAN_PENDAFTARAN_tanggal_pesan"><?= $Page->renderSort($Page->tanggal_pesan) ?></div></th>
<?php } ?>
<?php if ($Page->tujuan->Visible) { // tujuan ?>
        <th data-name="tujuan" class="<?= $Page->tujuan->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_tujuan" class="ANTRIAN_PENDAFTARAN_tujuan"><?= $Page->renderSort($Page->tujuan) ?></div></th>
<?php } ?>
<?php if ($Page->disabilitas->Visible) { // disabilitas ?>
        <th data-name="disabilitas" class="<?= $Page->disabilitas->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_disabilitas" class="ANTRIAN_PENDAFTARAN_disabilitas"><?= $Page->renderSort($Page->disabilitas) ?></div></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_nama" class="ANTRIAN_PENDAFTARAN_nama"><?= $Page->renderSort($Page->nama) ?></div></th>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
        <th data-name="no_bpjs" class="<?= $Page->no_bpjs->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_no_bpjs" class="ANTRIAN_PENDAFTARAN_no_bpjs"><?= $Page->renderSort($Page->no_bpjs) ?></div></th>
<?php } ?>
<?php if ($Page->nomr->Visible) { // nomr ?>
        <th data-name="nomr" class="<?= $Page->nomr->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_nomr" class="ANTRIAN_PENDAFTARAN_nomr"><?= $Page->renderSort($Page->nomr) ?></div></th>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
        <th data-name="tempat_lahir" class="<?= $Page->tempat_lahir->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_tempat_lahir" class="ANTRIAN_PENDAFTARAN_tempat_lahir"><?= $Page->renderSort($Page->tempat_lahir) ?></div></th>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <th data-name="tanggal_lahir" class="<?= $Page->tanggal_lahir->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_tanggal_lahir" class="ANTRIAN_PENDAFTARAN_tanggal_lahir"><?= $Page->renderSort($Page->tanggal_lahir) ?></div></th>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
        <th data-name="jk" class="<?= $Page->jk->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_jk" class="ANTRIAN_PENDAFTARAN_jk"><?= $Page->renderSort($Page->jk) ?></div></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th data-name="alamat" class="<?= $Page->alamat->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_alamat" class="ANTRIAN_PENDAFTARAN_alamat"><?= $Page->renderSort($Page->alamat) ?></div></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th data-name="agama" class="<?= $Page->agama->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_agama" class="ANTRIAN_PENDAFTARAN_agama"><?= $Page->renderSort($Page->agama) ?></div></th>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <th data-name="pekerjaan" class="<?= $Page->pekerjaan->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_pekerjaan" class="ANTRIAN_PENDAFTARAN_pekerjaan"><?= $Page->renderSort($Page->pekerjaan) ?></div></th>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
        <th data-name="no_telp" class="<?= $Page->no_telp->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_no_telp" class="ANTRIAN_PENDAFTARAN_no_telp"><?= $Page->renderSort($Page->no_telp) ?></div></th>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
        <th data-name="nama_ibu" class="<?= $Page->nama_ibu->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_nama_ibu" class="ANTRIAN_PENDAFTARAN_nama_ibu"><?= $Page->renderSort($Page->nama_ibu) ?></div></th>
<?php } ?>
<?php if ($Page->nama_ayah->Visible) { // nama_ayah ?>
        <th data-name="nama_ayah" class="<?= $Page->nama_ayah->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_nama_ayah" class="ANTRIAN_PENDAFTARAN_nama_ayah"><?= $Page->renderSort($Page->nama_ayah) ?></div></th>
<?php } ?>
<?php if ($Page->nama_pasangan->Visible) { // nama_pasangan ?>
        <th data-name="nama_pasangan" class="<?= $Page->nama_pasangan->headerCellClass() ?>"><div id="elh_ANTRIAN_PENDAFTARAN_nama_pasangan" class="ANTRIAN_PENDAFTARAN_nama_pasangan"><?= $Page->renderSort($Page->nama_pasangan) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_ANTRIAN_PENDAFTARAN", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->Id->Visible) { // Id ?>
        <td data-name="Id" <?= $Page->Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_Id">
<span<?= $Page->Id->viewAttributes() ?>>
<?= $Page->Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_urut->Visible) { // no_urut ?>
        <td data-name="no_urut" <?= $Page->no_urut->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_no_urut">
<span<?= $Page->no_urut->viewAttributes() ?>>
<?= $Page->no_urut->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal_daftar->Visible) { // tanggal_daftar ?>
        <td data-name="tanggal_daftar" <?= $Page->tanggal_daftar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tanggal_daftar">
<span<?= $Page->tanggal_daftar->viewAttributes() ?>>
<?= $Page->tanggal_daftar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal_panggil->Visible) { // tanggal_panggil ?>
        <td data-name="tanggal_panggil" <?= $Page->tanggal_panggil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tanggal_panggil">
<span<?= $Page->tanggal_panggil->viewAttributes() ?>>
<?= $Page->tanggal_panggil->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->loket->Visible) { // loket ?>
        <td data-name="loket" <?= $Page->loket->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_loket">
<span<?= $Page->loket->viewAttributes() ?>>
<?= $Page->loket->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status_panggil->Visible) { // status_panggil ?>
        <td data-name="status_panggil" <?= $Page->status_panggil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_status_panggil">
<span<?= $Page->status_panggil->viewAttributes() ?>>
<?= $Page->status_panggil->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->user->Visible) { // user ?>
        <td data-name="user" <?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->newapp->Visible) { // newapp ?>
        <td data-name="newapp" <?= $Page->newapp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_newapp">
<span<?= $Page->newapp->viewAttributes() ?>>
<?= $Page->newapp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kdpoli->Visible) { // kdpoli ?>
        <td data-name="kdpoli" <?= $Page->kdpoli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_kdpoli">
<span<?= $Page->kdpoli->viewAttributes() ?>>
<?= $Page->kdpoli->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal_pesan->Visible) { // tanggal_pesan ?>
        <td data-name="tanggal_pesan" <?= $Page->tanggal_pesan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tanggal_pesan">
<span<?= $Page->tanggal_pesan->viewAttributes() ?>>
<?= $Page->tanggal_pesan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tujuan->Visible) { // tujuan ?>
        <td data-name="tujuan" <?= $Page->tujuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tujuan">
<span<?= $Page->tujuan->viewAttributes() ?>>
<?= $Page->tujuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->disabilitas->Visible) { // disabilitas ?>
        <td data-name="disabilitas" <?= $Page->disabilitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_disabilitas">
<span<?= $Page->disabilitas->viewAttributes() ?>>
<?= $Page->disabilitas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama->Visible) { // nama ?>
        <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
        <td data-name="no_bpjs" <?= $Page->no_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_no_bpjs">
<span<?= $Page->no_bpjs->viewAttributes() ?>>
<?= $Page->no_bpjs->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nomr->Visible) { // nomr ?>
        <td data-name="nomr" <?= $Page->nomr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nomr">
<span<?= $Page->nomr->viewAttributes() ?>>
<?= $Page->nomr->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
        <td data-name="tempat_lahir" <?= $Page->tempat_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tempat_lahir">
<span<?= $Page->tempat_lahir->viewAttributes() ?>>
<?= $Page->tempat_lahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <td data-name="tanggal_lahir" <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jk->Visible) { // jk ?>
        <td data-name="jk" <?= $Page->jk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_jk">
<span<?= $Page->jk->viewAttributes() ?>>
<?= $Page->jk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alamat->Visible) { // alamat ?>
        <td data-name="alamat" <?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->agama->Visible) { // agama ?>
        <td data-name="agama" <?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <td data-name="pekerjaan" <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_telp->Visible) { // no_telp ?>
        <td data-name="no_telp" <?= $Page->no_telp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_no_telp">
<span<?= $Page->no_telp->viewAttributes() ?>>
<?= $Page->no_telp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
        <td data-name="nama_ibu" <?= $Page->nama_ibu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nama_ibu">
<span<?= $Page->nama_ibu->viewAttributes() ?>>
<?= $Page->nama_ibu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_ayah->Visible) { // nama_ayah ?>
        <td data-name="nama_ayah" <?= $Page->nama_ayah->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nama_ayah">
<span<?= $Page->nama_ayah->viewAttributes() ?>>
<?= $Page->nama_ayah->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_pasangan->Visible) { // nama_pasangan ?>
        <td data-name="nama_pasangan" <?= $Page->nama_pasangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nama_pasangan">
<span<?= $Page->nama_pasangan->viewAttributes() ?>>
<?= $Page->nama_pasangan->getViewValue() ?></span>
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
    ew.addEventHandlers("ANTRIAN_PENDAFTARAN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
