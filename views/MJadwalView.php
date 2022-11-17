<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MJadwalView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fm_jadwalview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fm_jadwalview = currentForm = new ew.Form("fm_jadwalview", "view");
    loadjs.done("fm_jadwalview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.m_jadwal) ew.vars.tables.m_jadwal = <?= JsonEncode(GetClientVar("tables", "m_jadwal")) ?>;
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
<form name="fm_jadwalview" id="fm_jadwalview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_jadwal">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id_jadwal->Visible) { // id_jadwal ?>
    <tr id="r_id_jadwal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_jadwal_id_jadwal"><?= $Page->id_jadwal->caption() ?></span></td>
        <td data-name="id_jadwal" <?= $Page->id_jadwal->cellAttributes() ?>>
<span id="el_m_jadwal_id_jadwal">
<span<?= $Page->id_jadwal->viewAttributes() ?>>
<?= $Page->id_jadwal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <tr id="r_kd_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_jadwal_kd_dokter"><?= $Page->kd_dokter->caption() ?></span></td>
        <td data-name="kd_dokter" <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_m_jadwal_kd_dokter">
<span<?= $Page->kd_dokter->viewAttributes() ?>>
<?= $Page->kd_dokter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hari_kerja->Visible) { // hari_kerja ?>
    <tr id="r_hari_kerja">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_jadwal_hari_kerja"><?= $Page->hari_kerja->caption() ?></span></td>
        <td data-name="hari_kerja" <?= $Page->hari_kerja->cellAttributes() ?>>
<span id="el_m_jadwal_hari_kerja">
<span<?= $Page->hari_kerja->viewAttributes() ?>>
<?= $Page->hari_kerja->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
    <tr id="r_jam_mulai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_jadwal_jam_mulai"><?= $Page->jam_mulai->caption() ?></span></td>
        <td data-name="jam_mulai" <?= $Page->jam_mulai->cellAttributes() ?>>
<span id="el_m_jadwal_jam_mulai">
<span<?= $Page->jam_mulai->viewAttributes() ?>>
<?= $Page->jam_mulai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
    <tr id="r_jam_selesai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_jadwal_jam_selesai"><?= $Page->jam_selesai->caption() ?></span></td>
        <td data-name="jam_selesai" <?= $Page->jam_selesai->cellAttributes() ?>>
<span id="el_m_jadwal_jam_selesai">
<span<?= $Page->jam_selesai->viewAttributes() ?>>
<?= $Page->jam_selesai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_poli->Visible) { // kd_poli ?>
    <tr id="r_kd_poli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_jadwal_kd_poli"><?= $Page->kd_poli->caption() ?></span></td>
        <td data-name="kd_poli" <?= $Page->kd_poli->cellAttributes() ?>>
<span id="el_m_jadwal_kd_poli">
<span<?= $Page->kd_poli->viewAttributes() ?>>
<?= $Page->kd_poli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kouta->Visible) { // kouta ?>
    <tr id="r_kouta">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_jadwal_kouta"><?= $Page->kouta->caption() ?></span></td>
        <td data-name="kouta" <?= $Page->kouta->cellAttributes() ?>>
<span id="el_m_jadwal_kouta">
<span<?= $Page->kouta->viewAttributes() ?>>
<?= $Page->kouta->getViewValue() ?></span>
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
