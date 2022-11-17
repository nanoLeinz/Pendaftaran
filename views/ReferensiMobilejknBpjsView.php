<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ReferensiMobilejknBpjsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var freferensi_mobilejkn_bpjsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    freferensi_mobilejkn_bpjsview = currentForm = new ew.Form("freferensi_mobilejkn_bpjsview", "view");
    loadjs.done("freferensi_mobilejkn_bpjsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.referensi_mobilejkn_bpjs) ew.vars.tables.referensi_mobilejkn_bpjs = <?= JsonEncode(GetClientVar("tables", "referensi_mobilejkn_bpjs")) ?>;
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
<form name="freferensi_mobilejkn_bpjsview" id="freferensi_mobilejkn_bpjsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
    <tr id="r_nobooking">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_nobooking"><?= $Page->nobooking->caption() ?></span></td>
        <td data-name="nobooking" <?= $Page->nobooking->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nobooking">
<span<?= $Page->nobooking->viewAttributes() ?>>
<?= $Page->nobooking->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nomorkartu->Visible) { // nomorkartu ?>
    <tr id="r_nomorkartu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_nomorkartu"><?= $Page->nomorkartu->caption() ?></span></td>
        <td data-name="nomorkartu" <?= $Page->nomorkartu->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nomorkartu">
<span<?= $Page->nomorkartu->viewAttributes() ?>>
<?= $Page->nomorkartu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nohp->Visible) { // nohp ?>
    <tr id="r_nohp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_nohp"><?= $Page->nohp->caption() ?></span></td>
        <td data-name="nohp" <?= $Page->nohp->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nohp">
<span<?= $Page->nohp->viewAttributes() ?>>
<?= $Page->nohp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kodepoli->Visible) { // kodepoli ?>
    <tr id="r_kodepoli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_kodepoli"><?= $Page->kodepoli->caption() ?></span></td>
        <td data-name="kodepoli" <?= $Page->kodepoli->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_kodepoli">
<span<?= $Page->kodepoli->viewAttributes() ?>>
<?= $Page->kodepoli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pasienbaru->Visible) { // pasienbaru ?>
    <tr id="r_pasienbaru">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_pasienbaru"><?= $Page->pasienbaru->caption() ?></span></td>
        <td data-name="pasienbaru" <?= $Page->pasienbaru->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_pasienbaru">
<span<?= $Page->pasienbaru->viewAttributes() ?>>
<?= $Page->pasienbaru->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->norm->Visible) { // norm ?>
    <tr id="r_norm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_norm"><?= $Page->norm->caption() ?></span></td>
        <td data-name="norm" <?= $Page->norm->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_norm">
<span<?= $Page->norm->viewAttributes() ?>>
<?= $Page->norm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggalperiksa->Visible) { // tanggalperiksa ?>
    <tr id="r_tanggalperiksa">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_tanggalperiksa"><?= $Page->tanggalperiksa->caption() ?></span></td>
        <td data-name="tanggalperiksa" <?= $Page->tanggalperiksa->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_tanggalperiksa">
<span<?= $Page->tanggalperiksa->viewAttributes() ?>>
<?= $Page->tanggalperiksa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kodedokter->Visible) { // kodedokter ?>
    <tr id="r_kodedokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_kodedokter"><?= $Page->kodedokter->caption() ?></span></td>
        <td data-name="kodedokter" <?= $Page->kodedokter->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_kodedokter">
<span<?= $Page->kodedokter->viewAttributes() ?>>
<?= $Page->kodedokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jampraktek->Visible) { // jampraktek ?>
    <tr id="r_jampraktek">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_jampraktek"><?= $Page->jampraktek->caption() ?></span></td>
        <td data-name="jampraktek" <?= $Page->jampraktek->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_jampraktek">
<span<?= $Page->jampraktek->viewAttributes() ?>>
<?= $Page->jampraktek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jeniskunjungan->Visible) { // jeniskunjungan ?>
    <tr id="r_jeniskunjungan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_jeniskunjungan"><?= $Page->jeniskunjungan->caption() ?></span></td>
        <td data-name="jeniskunjungan" <?= $Page->jeniskunjungan->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_jeniskunjungan">
<span<?= $Page->jeniskunjungan->viewAttributes() ?>>
<?= $Page->jeniskunjungan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
    <tr id="r_nomorreferensi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_nomorreferensi"><?= $Page->nomorreferensi->caption() ?></span></td>
        <td data-name="nomorreferensi" <?= $Page->nomorreferensi->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nomorreferensi">
<span<?= $Page->nomorreferensi->viewAttributes() ?>>
<?= $Page->nomorreferensi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nomorantrean->Visible) { // nomorantrean ?>
    <tr id="r_nomorantrean">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_nomorantrean"><?= $Page->nomorantrean->caption() ?></span></td>
        <td data-name="nomorantrean" <?= $Page->nomorantrean->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nomorantrean">
<span<?= $Page->nomorantrean->viewAttributes() ?>>
<?= $Page->nomorantrean->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->angkaantrean->Visible) { // angkaantrean ?>
    <tr id="r_angkaantrean">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_angkaantrean"><?= $Page->angkaantrean->caption() ?></span></td>
        <td data-name="angkaantrean" <?= $Page->angkaantrean->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_angkaantrean">
<span<?= $Page->angkaantrean->viewAttributes() ?>>
<?= $Page->angkaantrean->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->estimasidilayani->Visible) { // estimasidilayani ?>
    <tr id="r_estimasidilayani">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_estimasidilayani"><?= $Page->estimasidilayani->caption() ?></span></td>
        <td data-name="estimasidilayani" <?= $Page->estimasidilayani->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_estimasidilayani">
<span<?= $Page->estimasidilayani->viewAttributes() ?>>
<?= $Page->estimasidilayani->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sisakuotajkn->Visible) { // sisakuotajkn ?>
    <tr id="r_sisakuotajkn">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_sisakuotajkn"><?= $Page->sisakuotajkn->caption() ?></span></td>
        <td data-name="sisakuotajkn" <?= $Page->sisakuotajkn->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_sisakuotajkn">
<span<?= $Page->sisakuotajkn->viewAttributes() ?>>
<?= $Page->sisakuotajkn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kuotajkn->Visible) { // kuotajkn ?>
    <tr id="r_kuotajkn">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_kuotajkn"><?= $Page->kuotajkn->caption() ?></span></td>
        <td data-name="kuotajkn" <?= $Page->kuotajkn->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_kuotajkn">
<span<?= $Page->kuotajkn->viewAttributes() ?>>
<?= $Page->kuotajkn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sisakuotanonjkn->Visible) { // sisakuotanonjkn ?>
    <tr id="r_sisakuotanonjkn">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_sisakuotanonjkn"><?= $Page->sisakuotanonjkn->caption() ?></span></td>
        <td data-name="sisakuotanonjkn" <?= $Page->sisakuotanonjkn->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_sisakuotanonjkn">
<span<?= $Page->sisakuotanonjkn->viewAttributes() ?>>
<?= $Page->sisakuotanonjkn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kuotanonjkn->Visible) { // kuotanonjkn ?>
    <tr id="r_kuotanonjkn">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_kuotanonjkn"><?= $Page->kuotanonjkn->caption() ?></span></td>
        <td data-name="kuotanonjkn" <?= $Page->kuotanonjkn->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_kuotanonjkn">
<span<?= $Page->kuotanonjkn->viewAttributes() ?>>
<?= $Page->kuotanonjkn->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->validasi->Visible) { // validasi ?>
    <tr id="r_validasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_validasi"><?= $Page->validasi->caption() ?></span></td>
        <td data-name="validasi" <?= $Page->validasi->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_validasi">
<span<?= $Page->validasi->viewAttributes() ?>>
<?= $Page->validasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
    <tr id="r_statuskirim">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_statuskirim"><?= $Page->statuskirim->caption() ?></span></td>
        <td data-name="statuskirim" <?= $Page->statuskirim->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_statuskirim">
<span<?= $Page->statuskirim->viewAttributes() ?>>
<?= $Page->statuskirim->getViewValue() ?></span>
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
