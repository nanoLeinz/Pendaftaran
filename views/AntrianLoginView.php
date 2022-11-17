<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AntrianLoginView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fANTRIAN_LOGINview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fANTRIAN_LOGINview = currentForm = new ew.Form("fANTRIAN_LOGINview", "view");
    loadjs.done("fANTRIAN_LOGINview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.ANTRIAN_LOGIN) ew.vars.tables.ANTRIAN_LOGIN = <?= JsonEncode(GetClientVar("tables", "ANTRIAN_LOGIN")) ?>;
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
<form name="fANTRIAN_LOGINview" id="fANTRIAN_LOGINview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ANTRIAN_LOGIN">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->ID->Visible) { // ID ?>
    <tr id="r_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_ID"><?= $Page->ID->caption() ?></span></td>
        <td data-name="ID" <?= $Page->ID->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NOMR->Visible) { // NOMR ?>
    <tr id="r_NOMR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_NOMR"><?= $Page->NOMR->caption() ?></span></td>
        <td data-name="NOMR" <?= $Page->NOMR->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_NOMR">
<span<?= $Page->NOMR->viewAttributes() ?>>
<?= $Page->NOMR->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_BPJS->Visible) { // NO_BPJS ?>
    <tr id="r_NO_BPJS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_NO_BPJS"><?= $Page->NO_BPJS->caption() ?></span></td>
        <td data-name="NO_BPJS" <?= $Page->NO_BPJS->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_NO_BPJS">
<span<?= $Page->NO_BPJS->viewAttributes() ?>>
<?= $Page->NO_BPJS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAMA->Visible) { // NAMA ?>
    <tr id="r_NAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_NAMA"><?= $Page->NAMA->caption() ?></span></td>
        <td data-name="NAMA" <?= $Page->NAMA->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_NAMA">
<span<?= $Page->NAMA->viewAttributes() ?>>
<?= $Page->NAMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TEMPAT_LAHIR->Visible) { // TEMPAT_LAHIR ?>
    <tr id="r_TEMPAT_LAHIR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_TEMPAT_LAHIR"><?= $Page->TEMPAT_LAHIR->caption() ?></span></td>
        <td data-name="TEMPAT_LAHIR" <?= $Page->TEMPAT_LAHIR->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_TEMPAT_LAHIR">
<span<?= $Page->TEMPAT_LAHIR->viewAttributes() ?>>
<?= $Page->TEMPAT_LAHIR->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TANGGAL_LAHIR->Visible) { // TANGGAL_LAHIR ?>
    <tr id="r_TANGGAL_LAHIR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_TANGGAL_LAHIR"><?= $Page->TANGGAL_LAHIR->caption() ?></span></td>
        <td data-name="TANGGAL_LAHIR" <?= $Page->TANGGAL_LAHIR->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_TANGGAL_LAHIR">
<span<?= $Page->TANGGAL_LAHIR->viewAttributes() ?>>
<?= $Page->TANGGAL_LAHIR->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
    <tr id="r_JENIS_KELAMIN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_JENIS_KELAMIN"><?= $Page->JENIS_KELAMIN->caption() ?></span></td>
        <td data-name="JENIS_KELAMIN" <?= $Page->JENIS_KELAMIN->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_JENIS_KELAMIN">
<span<?= $Page->JENIS_KELAMIN->viewAttributes() ?>>
<?= $Page->JENIS_KELAMIN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->AGAMA->Visible) { // AGAMA ?>
    <tr id="r_AGAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_AGAMA"><?= $Page->AGAMA->caption() ?></span></td>
        <td data-name="AGAMA" <?= $Page->AGAMA->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_AGAMA">
<span<?= $Page->AGAMA->viewAttributes() ?>>
<?= $Page->AGAMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PEKERJAAN->Visible) { // PEKERJAAN ?>
    <tr id="r_PEKERJAAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_PEKERJAAN"><?= $Page->PEKERJAAN->caption() ?></span></td>
        <td data-name="PEKERJAAN" <?= $Page->PEKERJAAN->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_PEKERJAAN">
<span<?= $Page->PEKERJAAN->viewAttributes() ?>>
<?= $Page->PEKERJAAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <tr id="r_ALAMAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_ALAMAT"><?= $Page->ALAMAT->caption() ?></span></td>
        <td data-name="ALAMAT" <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_TELP->Visible) { // NO_TELP ?>
    <tr id="r_NO_TELP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_NO_TELP"><?= $Page->NO_TELP->caption() ?></span></td>
        <td data-name="NO_TELP" <?= $Page->NO_TELP->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_NO_TELP">
<span<?= $Page->NO_TELP->viewAttributes() ?>>
<?= $Page->NO_TELP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
    <tr id="r_NO_HP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_NO_HP"><?= $Page->NO_HP->caption() ?></span></td>
        <td data-name="NO_HP" <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
    <tr id="r__EMAIL">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN__EMAIL"><?= $Page->_EMAIL->caption() ?></span></td>
        <td data-name="_EMAIL" <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FOTO->Visible) { // FOTO ?>
    <tr id="r_FOTO">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_FOTO"><?= $Page->FOTO->caption() ?></span></td>
        <td data-name="FOTO" <?= $Page->FOTO->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_FOTO">
<span<?= $Page->FOTO->viewAttributes() ?>>
<?= $Page->FOTO->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TANGGAL_REGIS->Visible) { // TANGGAL_REGIS ?>
    <tr id="r_TANGGAL_REGIS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_TANGGAL_REGIS"><?= $Page->TANGGAL_REGIS->caption() ?></span></td>
        <td data-name="TANGGAL_REGIS" <?= $Page->TANGGAL_REGIS->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_TANGGAL_REGIS">
<span<?= $Page->TANGGAL_REGIS->viewAttributes() ?>>
<?= $Page->TANGGAL_REGIS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAMA_IBU->Visible) { // NAMA_IBU ?>
    <tr id="r_NAMA_IBU">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_NAMA_IBU"><?= $Page->NAMA_IBU->caption() ?></span></td>
        <td data-name="NAMA_IBU" <?= $Page->NAMA_IBU->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_NAMA_IBU">
<span<?= $Page->NAMA_IBU->viewAttributes() ?>>
<?= $Page->NAMA_IBU->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAMA_AYAH->Visible) { // NAMA_AYAH ?>
    <tr id="r_NAMA_AYAH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_NAMA_AYAH"><?= $Page->NAMA_AYAH->caption() ?></span></td>
        <td data-name="NAMA_AYAH" <?= $Page->NAMA_AYAH->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_NAMA_AYAH">
<span<?= $Page->NAMA_AYAH->viewAttributes() ?>>
<?= $Page->NAMA_AYAH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAMA_PASANGAN->Visible) { // NAMA_PASANGAN ?>
    <tr id="r_NAMA_PASANGAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN_NAMA_PASANGAN"><?= $Page->NAMA_PASANGAN->caption() ?></span></td>
        <td data-name="NAMA_PASANGAN" <?= $Page->NAMA_PASANGAN->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN_NAMA_PASANGAN">
<span<?= $Page->NAMA_PASANGAN->viewAttributes() ?>>
<?= $Page->NAMA_PASANGAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_PASSWORD->Visible) { // PASSWORD ?>
    <tr id="r__PASSWORD">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ANTRIAN_LOGIN__PASSWORD"><?= $Page->_PASSWORD->caption() ?></span></td>
        <td data-name="_PASSWORD" <?= $Page->_PASSWORD->cellAttributes() ?>>
<span id="el_ANTRIAN_LOGIN__PASSWORD">
<span<?= $Page->_PASSWORD->viewAttributes() ?>>
<?= $Page->_PASSWORD->getViewValue() ?></span>
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
