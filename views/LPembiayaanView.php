<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LPembiayaanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fl_pembiayaanview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fl_pembiayaanview = currentForm = new ew.Form("fl_pembiayaanview", "view");
    loadjs.done("fl_pembiayaanview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.l_pembiayaan) ew.vars.tables.l_pembiayaan = <?= JsonEncode(GetClientVar("tables", "l_pembiayaan")) ?>;
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
<form name="fl_pembiayaanview" id="fl_pembiayaanview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_pembiayaan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
    <tr id="r_id_pembiayaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_pembiayaan_id_pembiayaan"><?= $Page->id_pembiayaan->caption() ?></span></td>
        <td data-name="id_pembiayaan" <?= $Page->id_pembiayaan->cellAttributes() ?>>
<span id="el_l_pembiayaan_id_pembiayaan">
<span<?= $Page->id_pembiayaan->viewAttributes() ?>>
<?= $Page->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_biaya->Visible) { // kode_biaya ?>
    <tr id="r_kode_biaya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_pembiayaan_kode_biaya"><?= $Page->kode_biaya->caption() ?></span></td>
        <td data-name="kode_biaya" <?= $Page->kode_biaya->cellAttributes() ?>>
<span id="el_l_pembiayaan_kode_biaya">
<span<?= $Page->kode_biaya->viewAttributes() ?>>
<?= $Page->kode_biaya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_biaya->Visible) { // nama_biaya ?>
    <tr id="r_nama_biaya">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_pembiayaan_nama_biaya"><?= $Page->nama_biaya->caption() ?></span></td>
        <td data-name="nama_biaya" <?= $Page->nama_biaya->cellAttributes() ?>>
<span id="el_l_pembiayaan_nama_biaya">
<span<?= $Page->nama_biaya->viewAttributes() ?>>
<?= $Page->nama_biaya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_kelas->Visible) { // kode_kelas ?>
    <tr id="r_kode_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_pembiayaan_kode_kelas"><?= $Page->kode_kelas->caption() ?></span></td>
        <td data-name="kode_kelas" <?= $Page->kode_kelas->cellAttributes() ?>>
<span id="el_l_pembiayaan_kode_kelas">
<span<?= $Page->kode_kelas->viewAttributes() ?>>
<?= $Page->kode_kelas->getViewValue() ?></span>
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
