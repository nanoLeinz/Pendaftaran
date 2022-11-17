<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MJadwalDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_jadwaldelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fm_jadwaldelete = currentForm = new ew.Form("fm_jadwaldelete", "delete");
    loadjs.done("fm_jadwaldelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.m_jadwal) ew.vars.tables.m_jadwal = <?= JsonEncode(GetClientVar("tables", "m_jadwal")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fm_jadwaldelete" id="fm_jadwaldelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_jadwal">
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
<?php if ($Page->id_jadwal->Visible) { // id_jadwal ?>
        <th class="<?= $Page->id_jadwal->headerCellClass() ?>"><span id="elh_m_jadwal_id_jadwal" class="m_jadwal_id_jadwal"><?= $Page->id_jadwal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <th class="<?= $Page->kd_dokter->headerCellClass() ?>"><span id="elh_m_jadwal_kd_dokter" class="m_jadwal_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hari_kerja->Visible) { // hari_kerja ?>
        <th class="<?= $Page->hari_kerja->headerCellClass() ?>"><span id="elh_m_jadwal_hari_kerja" class="m_jadwal_hari_kerja"><?= $Page->hari_kerja->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
        <th class="<?= $Page->jam_mulai->headerCellClass() ?>"><span id="elh_m_jadwal_jam_mulai" class="m_jadwal_jam_mulai"><?= $Page->jam_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
        <th class="<?= $Page->jam_selesai->headerCellClass() ?>"><span id="elh_m_jadwal_jam_selesai" class="m_jadwal_jam_selesai"><?= $Page->jam_selesai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <th class="<?= $Page->kd_poli->headerCellClass() ?>"><span id="elh_m_jadwal_kd_poli" class="m_jadwal_kd_poli"><?= $Page->kd_poli->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kouta->Visible) { // kouta ?>
        <th class="<?= $Page->kouta->headerCellClass() ?>"><span id="elh_m_jadwal_kouta" class="m_jadwal_kouta"><?= $Page->kouta->caption() ?></span></th>
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
<?php if ($Page->id_jadwal->Visible) { // id_jadwal ?>
        <td <?= $Page->id_jadwal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_jadwal_id_jadwal" class="m_jadwal_id_jadwal">
<span<?= $Page->id_jadwal->viewAttributes() ?>>
<?= $Page->id_jadwal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
        <td <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_jadwal_kd_dokter" class="m_jadwal_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hari_kerja->Visible) { // hari_kerja ?>
        <td <?= $Page->hari_kerja->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_jadwal_hari_kerja" class="m_jadwal_hari_kerja">
<span<?= $Page->hari_kerja->viewAttributes() ?>>
<?= $Page->hari_kerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
        <td <?= $Page->jam_mulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_jadwal_jam_mulai" class="m_jadwal_jam_mulai">
<span<?= $Page->jam_mulai->viewAttributes() ?>>
<?= $Page->jam_mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
        <td <?= $Page->jam_selesai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_jadwal_jam_selesai" class="m_jadwal_jam_selesai">
<span<?= $Page->jam_selesai->viewAttributes() ?>>
<?= $Page->jam_selesai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
        <td <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_jadwal_kd_poli" class="m_jadwal_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kouta->Visible) { // kouta ?>
        <td <?= $Page->kouta->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_jadwal_kouta" class="m_jadwal_kouta">
<span<?= $Page->kouta->viewAttributes() ?>>
<?= $Page->kouta->getViewValue() ?></span>
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
