<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LKelasView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fl_kelasview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fl_kelasview = currentForm = new ew.Form("fl_kelasview", "view");
    loadjs.done("fl_kelasview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.l_kelas) ew.vars.tables.l_kelas = <?= JsonEncode(GetClientVar("tables", "l_kelas")) ?>;
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
<form name="fl_kelasview" id="fl_kelasview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_kelas">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
    <tr id="r_id_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_kelas_id_kelas"><?= $Page->id_kelas->caption() ?></span></td>
        <td data-name="id_kelas" <?= $Page->id_kelas->cellAttributes() ?>>
<span id="el_l_kelas_id_kelas">
<span<?= $Page->id_kelas->viewAttributes() ?>>
<?= $Page->id_kelas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_kelas->Visible) { // kode_kelas ?>
    <tr id="r_kode_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_kelas_kode_kelas"><?= $Page->kode_kelas->caption() ?></span></td>
        <td data-name="kode_kelas" <?= $Page->kode_kelas->cellAttributes() ?>>
<span id="el_l_kelas_kode_kelas">
<span<?= $Page->kode_kelas->viewAttributes() ?>>
<?= $Page->kode_kelas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_kelas->Visible) { // nama_kelas ?>
    <tr id="r_nama_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_kelas_nama_kelas"><?= $Page->nama_kelas->caption() ?></span></td>
        <td data-name="nama_kelas" <?= $Page->nama_kelas->cellAttributes() ?>>
<span id="el_l_kelas_nama_kelas">
<span<?= $Page->nama_kelas->viewAttributes() ?>>
<?= $Page->nama_kelas->getViewValue() ?></span>
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
