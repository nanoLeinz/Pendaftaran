<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$BookingOperasiDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbooking_operasidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbooking_operasidelete = currentForm = new ew.Form("fbooking_operasidelete", "delete");
    loadjs.done("fbooking_operasidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.booking_operasi) ew.vars.tables.booking_operasi = <?= JsonEncode(GetClientVar("tables", "booking_operasi")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbooking_operasidelete" id="fbooking_operasidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="booking_operasi">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_booking_operasi_id" class="booking_operasi_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <th class="<?= $Page->no_rawat->headerCellClass() ?>"><span id="elh_booking_operasi_no_rawat" class="booking_operasi_no_rawat"><?= $Page->no_rawat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_paket->Visible) { // kode_paket ?>
        <th class="<?= $Page->kode_paket->headerCellClass() ?>"><span id="elh_booking_operasi_kode_paket" class="booking_operasi_kode_paket"><?= $Page->kode_paket->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <th class="<?= $Page->tanggal->headerCellClass() ?>"><span id="elh_booking_operasi_tanggal" class="booking_operasi_tanggal"><?= $Page->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
        <th class="<?= $Page->jam_mulai->headerCellClass() ?>"><span id="elh_booking_operasi_jam_mulai" class="booking_operasi_jam_mulai"><?= $Page->jam_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
        <th class="<?= $Page->jam_selesai->headerCellClass() ?>"><span id="elh_booking_operasi_jam_selesai" class="booking_operasi_jam_selesai"><?= $Page->jam_selesai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_booking_operasi_status" class="booking_operasi_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th class="<?= $Page->kd_dokter->headerCellClass() ?>"><span id="elh_booking_operasi_kd_dokter" class="booking_operasi_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_ruang_ok->Visible) { // kd_ruang_ok ?>
        <th class="<?= $Page->kd_ruang_ok->headerCellClass() ?>"><span id="elh_booking_operasi_kd_ruang_ok" class="booking_operasi_kd_ruang_ok"><?= $Page->kd_ruang_ok->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_id" class="booking_operasi_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
        <td <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_no_rawat" class="booking_operasi_no_rawat">
<span<?= $Page->no_rawat->viewAttributes() ?>>
<?= $Page->no_rawat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_paket->Visible) { // kode_paket ?>
        <td <?= $Page->kode_paket->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_kode_paket" class="booking_operasi_kode_paket">
<span<?= $Page->kode_paket->viewAttributes() ?>>
<?= $Page->kode_paket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
        <td <?= $Page->tanggal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_tanggal" class="booking_operasi_tanggal">
<span<?= $Page->tanggal->viewAttributes() ?>>
<?= $Page->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
        <td <?= $Page->jam_mulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_jam_mulai" class="booking_operasi_jam_mulai">
<span<?= $Page->jam_mulai->viewAttributes() ?>>
<?= $Page->jam_mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
        <td <?= $Page->jam_selesai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_jam_selesai" class="booking_operasi_jam_selesai">
<span<?= $Page->jam_selesai->viewAttributes() ?>>
<?= $Page->jam_selesai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_status" class="booking_operasi_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_kd_dokter" class="booking_operasi_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_ruang_ok->Visible) { // kd_ruang_ok ?>
        <td <?= $Page->kd_ruang_ok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_booking_operasi_kd_ruang_ok" class="booking_operasi_kd_ruang_ok">
<span<?= $Page->kd_ruang_ok->viewAttributes() ?>>
<?= $Page->kd_ruang_ok->getViewValue() ?></span>
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
