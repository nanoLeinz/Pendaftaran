<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LPenunjangView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fl_penunjangview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fl_penunjangview = currentForm = new ew.Form("fl_penunjangview", "view");
    loadjs.done("fl_penunjangview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.l_penunjang) ew.vars.tables.l_penunjang = <?= JsonEncode(GetClientVar("tables", "l_penunjang")) ?>;
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
<form name="fl_penunjangview" id="fl_penunjangview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_penunjang">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
    <tr id="r_id_penunjang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_penunjang_id_penunjang"><?= $Page->id_penunjang->caption() ?></span></td>
        <td data-name="id_penunjang" <?= $Page->id_penunjang->cellAttributes() ?>>
<span id="el_l_penunjang_id_penunjang">
<span<?= $Page->id_penunjang->viewAttributes() ?>>
<?= $Page->id_penunjang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
    <tr id="r_id_kunjungan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_penunjang_id_kunjungan"><?= $Page->id_kunjungan->caption() ?></span></td>
        <td data-name="id_kunjungan" <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el_l_penunjang_id_kunjungan">
<span<?= $Page->id_kunjungan->viewAttributes() ?>>
<?= $Page->id_kunjungan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_penunjang->Visible) { // kode_penunjang ?>
    <tr id="r_kode_penunjang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_penunjang_kode_penunjang"><?= $Page->kode_penunjang->caption() ?></span></td>
        <td data-name="kode_penunjang" <?= $Page->kode_penunjang->cellAttributes() ?>>
<span id="el_l_penunjang_kode_penunjang">
<span<?= $Page->kode_penunjang->viewAttributes() ?>>
<?= $Page->kode_penunjang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_penunjang->Visible) { // nama_penunjang ?>
    <tr id="r_nama_penunjang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_penunjang_nama_penunjang"><?= $Page->nama_penunjang->caption() ?></span></td>
        <td data-name="nama_penunjang" <?= $Page->nama_penunjang->cellAttributes() ?>>
<span id="el_l_penunjang_nama_penunjang">
<span<?= $Page->nama_penunjang->viewAttributes() ?>>
<?= $Page->nama_penunjang->getViewValue() ?></span>
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
