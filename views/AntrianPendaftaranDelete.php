<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AntrianPendaftaranDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fANTRIAN_PENDAFTARANdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fANTRIAN_PENDAFTARANdelete = currentForm = new ew.Form("fANTRIAN_PENDAFTARANdelete", "delete");
    loadjs.done("fANTRIAN_PENDAFTARANdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.ANTRIAN_PENDAFTARAN) ew.vars.tables.ANTRIAN_PENDAFTARAN = <?= JsonEncode(GetClientVar("tables", "ANTRIAN_PENDAFTARAN")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fANTRIAN_PENDAFTARANdelete" id="fANTRIAN_PENDAFTARANdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ANTRIAN_PENDAFTARAN">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->Id->Visible) { // Id ?>
        <th class="<?= $Page->Id->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_Id" class="ANTRIAN_PENDAFTARAN_Id"><?= $Page->Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_urut->Visible) { // no_urut ?>
        <th class="<?= $Page->no_urut->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_no_urut" class="ANTRIAN_PENDAFTARAN_no_urut"><?= $Page->no_urut->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_daftar->Visible) { // tanggal_daftar ?>
        <th class="<?= $Page->tanggal_daftar->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tanggal_daftar" class="ANTRIAN_PENDAFTARAN_tanggal_daftar"><?= $Page->tanggal_daftar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_panggil->Visible) { // tanggal_panggil ?>
        <th class="<?= $Page->tanggal_panggil->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tanggal_panggil" class="ANTRIAN_PENDAFTARAN_tanggal_panggil"><?= $Page->tanggal_panggil->caption() ?></span></th>
<?php } ?>
<?php if ($Page->loket->Visible) { // loket ?>
        <th class="<?= $Page->loket->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_loket" class="ANTRIAN_PENDAFTARAN_loket"><?= $Page->loket->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_panggil->Visible) { // status_panggil ?>
        <th class="<?= $Page->status_panggil->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_status_panggil" class="ANTRIAN_PENDAFTARAN_status_panggil"><?= $Page->status_panggil->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <th class="<?= $Page->user->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_user" class="ANTRIAN_PENDAFTARAN_user"><?= $Page->user->caption() ?></span></th>
<?php } ?>
<?php if ($Page->newapp->Visible) { // newapp ?>
        <th class="<?= $Page->newapp->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_newapp" class="ANTRIAN_PENDAFTARAN_newapp"><?= $Page->newapp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kdpoli->Visible) { // kdpoli ?>
        <th class="<?= $Page->kdpoli->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_kdpoli" class="ANTRIAN_PENDAFTARAN_kdpoli"><?= $Page->kdpoli->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_pesan->Visible) { // tanggal_pesan ?>
        <th class="<?= $Page->tanggal_pesan->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tanggal_pesan" class="ANTRIAN_PENDAFTARAN_tanggal_pesan"><?= $Page->tanggal_pesan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tujuan->Visible) { // tujuan ?>
        <th class="<?= $Page->tujuan->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tujuan" class="ANTRIAN_PENDAFTARAN_tujuan"><?= $Page->tujuan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->disabilitas->Visible) { // disabilitas ?>
        <th class="<?= $Page->disabilitas->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_disabilitas" class="ANTRIAN_PENDAFTARAN_disabilitas"><?= $Page->disabilitas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nama" class="ANTRIAN_PENDAFTARAN_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
        <th class="<?= $Page->no_bpjs->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_no_bpjs" class="ANTRIAN_PENDAFTARAN_no_bpjs"><?= $Page->no_bpjs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nomr->Visible) { // nomr ?>
        <th class="<?= $Page->nomr->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nomr" class="ANTRIAN_PENDAFTARAN_nomr"><?= $Page->nomr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
        <th class="<?= $Page->tempat_lahir->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tempat_lahir" class="ANTRIAN_PENDAFTARAN_tempat_lahir"><?= $Page->tempat_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <th class="<?= $Page->tanggal_lahir->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tanggal_lahir" class="ANTRIAN_PENDAFTARAN_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
        <th class="<?= $Page->jk->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_jk" class="ANTRIAN_PENDAFTARAN_jk"><?= $Page->jk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th class="<?= $Page->alamat->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_alamat" class="ANTRIAN_PENDAFTARAN_alamat"><?= $Page->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th class="<?= $Page->agama->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_agama" class="ANTRIAN_PENDAFTARAN_agama"><?= $Page->agama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <th class="<?= $Page->pekerjaan->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_pekerjaan" class="ANTRIAN_PENDAFTARAN_pekerjaan"><?= $Page->pekerjaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
        <th class="<?= $Page->no_telp->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_no_telp" class="ANTRIAN_PENDAFTARAN_no_telp"><?= $Page->no_telp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
        <th class="<?= $Page->nama_ibu->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nama_ibu" class="ANTRIAN_PENDAFTARAN_nama_ibu"><?= $Page->nama_ibu->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_ayah->Visible) { // nama_ayah ?>
        <th class="<?= $Page->nama_ayah->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nama_ayah" class="ANTRIAN_PENDAFTARAN_nama_ayah"><?= $Page->nama_ayah->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_pasangan->Visible) { // nama_pasangan ?>
        <th class="<?= $Page->nama_pasangan->headerCellClass() ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nama_pasangan" class="ANTRIAN_PENDAFTARAN_nama_pasangan"><?= $Page->nama_pasangan->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->Id->Visible) { // Id ?>
        <td <?= $Page->Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_Id" class="ANTRIAN_PENDAFTARAN_Id">
<span<?= $Page->Id->viewAttributes() ?>>
<?= $Page->Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_urut->Visible) { // no_urut ?>
        <td <?= $Page->no_urut->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_no_urut" class="ANTRIAN_PENDAFTARAN_no_urut">
<span<?= $Page->no_urut->viewAttributes() ?>>
<?= $Page->no_urut->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_daftar->Visible) { // tanggal_daftar ?>
        <td <?= $Page->tanggal_daftar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tanggal_daftar" class="ANTRIAN_PENDAFTARAN_tanggal_daftar">
<span<?= $Page->tanggal_daftar->viewAttributes() ?>>
<?= $Page->tanggal_daftar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_panggil->Visible) { // tanggal_panggil ?>
        <td <?= $Page->tanggal_panggil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tanggal_panggil" class="ANTRIAN_PENDAFTARAN_tanggal_panggil">
<span<?= $Page->tanggal_panggil->viewAttributes() ?>>
<?= $Page->tanggal_panggil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->loket->Visible) { // loket ?>
        <td <?= $Page->loket->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_loket" class="ANTRIAN_PENDAFTARAN_loket">
<span<?= $Page->loket->viewAttributes() ?>>
<?= $Page->loket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_panggil->Visible) { // status_panggil ?>
        <td <?= $Page->status_panggil->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_status_panggil" class="ANTRIAN_PENDAFTARAN_status_panggil">
<span<?= $Page->status_panggil->viewAttributes() ?>>
<?= $Page->status_panggil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
        <td <?= $Page->user->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_user" class="ANTRIAN_PENDAFTARAN_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->newapp->Visible) { // newapp ?>
        <td <?= $Page->newapp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_newapp" class="ANTRIAN_PENDAFTARAN_newapp">
<span<?= $Page->newapp->viewAttributes() ?>>
<?= $Page->newapp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kdpoli->Visible) { // kdpoli ?>
        <td <?= $Page->kdpoli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_kdpoli" class="ANTRIAN_PENDAFTARAN_kdpoli">
<span<?= $Page->kdpoli->viewAttributes() ?>>
<?= $Page->kdpoli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_pesan->Visible) { // tanggal_pesan ?>
        <td <?= $Page->tanggal_pesan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tanggal_pesan" class="ANTRIAN_PENDAFTARAN_tanggal_pesan">
<span<?= $Page->tanggal_pesan->viewAttributes() ?>>
<?= $Page->tanggal_pesan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tujuan->Visible) { // tujuan ?>
        <td <?= $Page->tujuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tujuan" class="ANTRIAN_PENDAFTARAN_tujuan">
<span<?= $Page->tujuan->viewAttributes() ?>>
<?= $Page->tujuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->disabilitas->Visible) { // disabilitas ?>
        <td <?= $Page->disabilitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_disabilitas" class="ANTRIAN_PENDAFTARAN_disabilitas">
<span<?= $Page->disabilitas->viewAttributes() ?>>
<?= $Page->disabilitas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td <?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nama" class="ANTRIAN_PENDAFTARAN_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
        <td <?= $Page->no_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_no_bpjs" class="ANTRIAN_PENDAFTARAN_no_bpjs">
<span<?= $Page->no_bpjs->viewAttributes() ?>>
<?= $Page->no_bpjs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nomr->Visible) { // nomr ?>
        <td <?= $Page->nomr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nomr" class="ANTRIAN_PENDAFTARAN_nomr">
<span<?= $Page->nomr->viewAttributes() ?>>
<?= $Page->nomr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
        <td <?= $Page->tempat_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tempat_lahir" class="ANTRIAN_PENDAFTARAN_tempat_lahir">
<span<?= $Page->tempat_lahir->viewAttributes() ?>>
<?= $Page->tempat_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
        <td <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_tanggal_lahir" class="ANTRIAN_PENDAFTARAN_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
        <td <?= $Page->jk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_jk" class="ANTRIAN_PENDAFTARAN_jk">
<span<?= $Page->jk->viewAttributes() ?>>
<?= $Page->jk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <td <?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_alamat" class="ANTRIAN_PENDAFTARAN_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <td <?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_agama" class="ANTRIAN_PENDAFTARAN_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
        <td <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_pekerjaan" class="ANTRIAN_PENDAFTARAN_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
        <td <?= $Page->no_telp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_no_telp" class="ANTRIAN_PENDAFTARAN_no_telp">
<span<?= $Page->no_telp->viewAttributes() ?>>
<?= $Page->no_telp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
        <td <?= $Page->nama_ibu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nama_ibu" class="ANTRIAN_PENDAFTARAN_nama_ibu">
<span<?= $Page->nama_ibu->viewAttributes() ?>>
<?= $Page->nama_ibu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_ayah->Visible) { // nama_ayah ?>
        <td <?= $Page->nama_ayah->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nama_ayah" class="ANTRIAN_PENDAFTARAN_nama_ayah">
<span<?= $Page->nama_ayah->viewAttributes() ?>>
<?= $Page->nama_ayah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_pasangan->Visible) { // nama_pasangan ?>
        <td <?= $Page->nama_pasangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ANTRIAN_PENDAFTARAN_nama_pasangan" class="ANTRIAN_PENDAFTARAN_nama_pasangan">
<span<?= $Page->nama_pasangan->viewAttributes() ?>>
<?= $Page->nama_pasangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
