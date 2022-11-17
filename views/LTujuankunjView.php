<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LTujuankunjView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fl_tujuankunjview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fl_tujuankunjview = currentForm = new ew.Form("fl_tujuankunjview", "view");
    loadjs.done("fl_tujuankunjview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.l_tujuankunj) ew.vars.tables.l_tujuankunj = <?= JsonEncode(GetClientVar("tables", "l_tujuankunj")) ?>;
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
<form name="fl_tujuankunjview" id="fl_tujuankunjview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_tujuankunj">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
    <tr id="r_id_tujuan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_tujuankunj_id_tujuan"><?= $Page->id_tujuan->caption() ?></span></td>
        <td data-name="id_tujuan" <?= $Page->id_tujuan->cellAttributes() ?>>
<span id="el_l_tujuankunj_id_tujuan">
<span<?= $Page->id_tujuan->viewAttributes() ?>>
<?= $Page->id_tujuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_tujuan->Visible) { // nama_tujuan ?>
    <tr id="r_nama_tujuan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_tujuankunj_nama_tujuan"><?= $Page->nama_tujuan->caption() ?></span></td>
        <td data-name="nama_tujuan" <?= $Page->nama_tujuan->cellAttributes() ?>>
<span id="el_l_tujuankunj_nama_tujuan">
<span<?= $Page->nama_tujuan->viewAttributes() ?>>
<?= $Page->nama_tujuan->getViewValue() ?></span>
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
