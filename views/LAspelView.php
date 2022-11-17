<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LAspelView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fl_aspelview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fl_aspelview = currentForm = new ew.Form("fl_aspelview", "view");
    loadjs.done("fl_aspelview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.l_aspel) ew.vars.tables.l_aspel = <?= JsonEncode(GetClientVar("tables", "l_aspel")) ?>;
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
<form name="fl_aspelview" id="fl_aspelview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_aspel">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
    <tr id="r_id_aspel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_aspel_id_aspel"><?= $Page->id_aspel->caption() ?></span></td>
        <td data-name="id_aspel" <?= $Page->id_aspel->cellAttributes() ?>>
<span id="el_l_aspel_id_aspel">
<span<?= $Page->id_aspel->viewAttributes() ?>>
<?= $Page->id_aspel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
    <tr id="r_id_kunjungan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_aspel_id_kunjungan"><?= $Page->id_kunjungan->caption() ?></span></td>
        <td data-name="id_kunjungan" <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el_l_aspel_id_kunjungan">
<span<?= $Page->id_kunjungan->viewAttributes() ?>>
<?= $Page->id_kunjungan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_aspel->Visible) { // kode_aspel ?>
    <tr id="r_kode_aspel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_aspel_kode_aspel"><?= $Page->kode_aspel->caption() ?></span></td>
        <td data-name="kode_aspel" <?= $Page->kode_aspel->cellAttributes() ?>>
<span id="el_l_aspel_kode_aspel">
<span<?= $Page->kode_aspel->viewAttributes() ?>>
<?= $Page->kode_aspel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_aspel->Visible) { // nama_aspel ?>
    <tr id="r_nama_aspel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_aspel_nama_aspel"><?= $Page->nama_aspel->caption() ?></span></td>
        <td data-name="nama_aspel" <?= $Page->nama_aspel->cellAttributes() ?>>
<span id="el_l_aspel_nama_aspel">
<span<?= $Page->nama_aspel->viewAttributes() ?>>
<?= $Page->nama_aspel->getViewValue() ?></span>
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
