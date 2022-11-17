<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$BookingOperasiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbooking_operasiview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbooking_operasiview = currentForm = new ew.Form("fbooking_operasiview", "view");
    loadjs.done("fbooking_operasiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.booking_operasi) ew.vars.tables.booking_operasi = <?= JsonEncode(GetClientVar("tables", "booking_operasi")) ?>;
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
<form name="fbooking_operasiview" id="fbooking_operasiview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="booking_operasi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_booking_operasi_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <tr id="r_no_rawat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_no_rawat"><?= $Page->no_rawat->caption() ?></span></td>
        <td data-name="no_rawat" <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_booking_operasi_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_paket->Visible) { // kode_paket ?>
    <tr id="r_kode_paket">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_kode_paket"><?= $Page->kode_paket->caption() ?></span></td>
        <td data-name="kode_paket" <?= $Page->kode_paket->cellAttributes() ?>>
<span id="el_booking_operasi_kode_paket">
<span<?= $Page->kode_paket->viewAttributes() ?>>
<?= $Page->kode_paket->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <tr id="r_tanggal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_tanggal"><?= $Page->tanggal->caption() ?></span></td>
        <td data-name="tanggal" <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_booking_operasi_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
    <tr id="r_jam_mulai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_jam_mulai"><?= $Page->jam_mulai->caption() ?></span></td>
        <td data-name="jam_mulai" <?= $Page->jam_mulai->cellAttributes() ?>>
<span id="el_booking_operasi_jam_mulai">
<span<?= $Page->jam_mulai->viewAttributes() ?>>
<?= $Page->jam_mulai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
    <tr id="r_jam_selesai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_jam_selesai"><?= $Page->jam_selesai->caption() ?></span></td>
        <td data-name="jam_selesai" <?= $Page->jam_selesai->cellAttributes() ?>>
<span id="el_booking_operasi_jam_selesai">
<span<?= $Page->jam_selesai->viewAttributes() ?>>
<?= $Page->jam_selesai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_booking_operasi_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <tr id="r_kd_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></td>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_booking_operasi_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_ruang_ok->Visible) { // kd_ruang_ok ?>
    <tr id="r_kd_ruang_ok">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_booking_operasi_kd_ruang_ok"><?= $Page->kd_ruang_ok->caption() ?></span></td>
        <td data-name="kd_ruang_ok" <?= $Page->kd_ruang_ok->cellAttributes() ?>>
<span id="el_booking_operasi_kd_ruang_ok">
<span<?= $Page->kd_ruang_ok->viewAttributes() ?>>
<?= $Page->kd_ruang_ok->getViewValue() ?></span>
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
