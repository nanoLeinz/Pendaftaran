<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AntrianPendaftaranView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fANTRIAN_PENDAFTARANview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fANTRIAN_PENDAFTARANview = currentForm = new ew.Form("fANTRIAN_PENDAFTARANview", "view");
    loadjs.done("fANTRIAN_PENDAFTARANview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.ANTRIAN_PENDAFTARAN) ew.vars.tables.ANTRIAN_PENDAFTARAN = <?= JsonEncode(GetClientVar("tables", "ANTRIAN_PENDAFTARAN")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fANTRIAN_PENDAFTARANview" id="fANTRIAN_PENDAFTARANview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ANTRIAN_PENDAFTARAN">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->Id->Visible) { // Id ?>
    <tr id="r_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_Id"><?= $Page->Id->caption() ?></span></td>
        <td data-name="Id" <?= $Page->Id->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_Id">
<span<?= $Page->Id->viewAttributes() ?>>
<?= $Page->Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_urut->Visible) { // no_urut ?>
    <tr id="r_no_urut">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_no_urut"><?= $Page->no_urut->caption() ?></span></td>
        <td data-name="no_urut" <?= $Page->no_urut->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_no_urut">
<span<?= $Page->no_urut->viewAttributes() ?>>
<?= $Page->no_urut->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_daftar->Visible) { // tanggal_daftar ?>
    <tr id="r_tanggal_daftar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tanggal_daftar"><?= $Page->tanggal_daftar->caption() ?></span></td>
        <td data-name="tanggal_daftar" <?= $Page->tanggal_daftar->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_tanggal_daftar">
<span<?= $Page->tanggal_daftar->viewAttributes() ?>>
<?= $Page->tanggal_daftar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_panggil->Visible) { // tanggal_panggil ?>
    <tr id="r_tanggal_panggil">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tanggal_panggil"><?= $Page->tanggal_panggil->caption() ?></span></td>
        <td data-name="tanggal_panggil" <?= $Page->tanggal_panggil->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_tanggal_panggil">
<span<?= $Page->tanggal_panggil->viewAttributes() ?>>
<?= $Page->tanggal_panggil->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->loket->Visible) { // loket ?>
    <tr id="r_loket">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_loket"><?= $Page->loket->caption() ?></span></td>
        <td data-name="loket" <?= $Page->loket->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_loket">
<span<?= $Page->loket->viewAttributes() ?>>
<?= $Page->loket->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_panggil->Visible) { // status_panggil ?>
    <tr id="r_status_panggil">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_status_panggil"><?= $Page->status_panggil->caption() ?></span></td>
        <td data-name="status_panggil" <?= $Page->status_panggil->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_status_panggil">
<span<?= $Page->status_panggil->viewAttributes() ?>>
<?= $Page->status_panggil->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <tr id="r_user">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_user"><?= $Page->user->caption() ?></span></td>
        <td data-name="user" <?= $Page->user->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_user">
<span<?= $Page->user->viewAttributes() ?>>
<?= $Page->user->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->newapp->Visible) { // newapp ?>
    <tr id="r_newapp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_newapp"><?= $Page->newapp->caption() ?></span></td>
        <td data-name="newapp" <?= $Page->newapp->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_newapp">
<span<?= $Page->newapp->viewAttributes() ?>>
<?= $Page->newapp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kdpoli->Visible) { // kdpoli ?>
    <tr id="r_kdpoli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_kdpoli"><?= $Page->kdpoli->caption() ?></span></td>
        <td data-name="kdpoli" <?= $Page->kdpoli->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_kdpoli">
<span<?= $Page->kdpoli->viewAttributes() ?>>
<?= $Page->kdpoli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_pesan->Visible) { // tanggal_pesan ?>
    <tr id="r_tanggal_pesan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tanggal_pesan"><?= $Page->tanggal_pesan->caption() ?></span></td>
        <td data-name="tanggal_pesan" <?= $Page->tanggal_pesan->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_tanggal_pesan">
<span<?= $Page->tanggal_pesan->viewAttributes() ?>>
<?= $Page->tanggal_pesan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tujuan->Visible) { // tujuan ?>
    <tr id="r_tujuan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tujuan"><?= $Page->tujuan->caption() ?></span></td>
        <td data-name="tujuan" <?= $Page->tujuan->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_tujuan">
<span<?= $Page->tujuan->viewAttributes() ?>>
<?= $Page->tujuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->disabilitas->Visible) { // disabilitas ?>
    <tr id="r_disabilitas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_disabilitas"><?= $Page->disabilitas->caption() ?></span></td>
        <td data-name="disabilitas" <?= $Page->disabilitas->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_disabilitas">
<span<?= $Page->disabilitas->viewAttributes() ?>>
<?= $Page->disabilitas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama" <?= $Page->nama->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_bpjs->Visible) { // no_bpjs ?>
    <tr id="r_no_bpjs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_no_bpjs"><?= $Page->no_bpjs->caption() ?></span></td>
        <td data-name="no_bpjs" <?= $Page->no_bpjs->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_no_bpjs">
<span<?= $Page->no_bpjs->viewAttributes() ?>>
<?= $Page->no_bpjs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nomr->Visible) { // nomr ?>
    <tr id="r_nomr">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nomr"><?= $Page->nomr->caption() ?></span></td>
        <td data-name="nomr" <?= $Page->nomr->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_nomr">
<span<?= $Page->nomr->viewAttributes() ?>>
<?= $Page->nomr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tempat_lahir->Visible) { // tempat_lahir ?>
    <tr id="r_tempat_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tempat_lahir"><?= $Page->tempat_lahir->caption() ?></span></td>
        <td data-name="tempat_lahir" <?= $Page->tempat_lahir->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_tempat_lahir">
<span<?= $Page->tempat_lahir->viewAttributes() ?>>
<?= $Page->tempat_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_lahir->Visible) { // tanggal_lahir ?>
    <tr id="r_tanggal_lahir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_tanggal_lahir"><?= $Page->tanggal_lahir->caption() ?></span></td>
        <td data-name="tanggal_lahir" <?= $Page->tanggal_lahir->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_tanggal_lahir">
<span<?= $Page->tanggal_lahir->viewAttributes() ?>>
<?= $Page->tanggal_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jk->Visible) { // jk ?>
    <tr id="r_jk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_jk"><?= $Page->jk->caption() ?></span></td>
        <td data-name="jk" <?= $Page->jk->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_jk">
<span<?= $Page->jk->viewAttributes() ?>>
<?= $Page->jk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <tr id="r_alamat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_alamat"><?= $Page->alamat->caption() ?></span></td>
        <td data-name="alamat" <?= $Page->alamat->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <tr id="r_agama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_agama"><?= $Page->agama->caption() ?></span></td>
        <td data-name="agama" <?= $Page->agama->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pekerjaan->Visible) { // pekerjaan ?>
    <tr id="r_pekerjaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_pekerjaan"><?= $Page->pekerjaan->caption() ?></span></td>
        <td data-name="pekerjaan" <?= $Page->pekerjaan->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_pekerjaan">
<span<?= $Page->pekerjaan->viewAttributes() ?>>
<?= $Page->pekerjaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_telp->Visible) { // no_telp ?>
    <tr id="r_no_telp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_no_telp"><?= $Page->no_telp->caption() ?></span></td>
        <td data-name="no_telp" <?= $Page->no_telp->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_no_telp">
<span<?= $Page->no_telp->viewAttributes() ?>>
<?= $Page->no_telp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_ibu->Visible) { // nama_ibu ?>
    <tr id="r_nama_ibu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nama_ibu"><?= $Page->nama_ibu->caption() ?></span></td>
        <td data-name="nama_ibu" <?= $Page->nama_ibu->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_nama_ibu">
<span<?= $Page->nama_ibu->viewAttributes() ?>>
<?= $Page->nama_ibu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_ayah->Visible) { // nama_ayah ?>
    <tr id="r_nama_ayah">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nama_ayah"><?= $Page->nama_ayah->caption() ?></span></td>
        <td data-name="nama_ayah" <?= $Page->nama_ayah->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_nama_ayah">
<span<?= $Page->nama_ayah->viewAttributes() ?>>
<?= $Page->nama_ayah->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_pasangan->Visible) { // nama_pasangan ?>
    <tr id="r_nama_pasangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_PENDAFTARAN_nama_pasangan"><?= $Page->nama_pasangan->caption() ?></span></td>
        <td data-name="nama_pasangan" <?= $Page->nama_pasangan->cellAttributes() ?>>
<span id="el_ANTRIAN_PENDAFTARAN_nama_pasangan">
<span<?= $Page->nama_pasangan->viewAttributes() ?>>
<?= $Page->nama_pasangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
