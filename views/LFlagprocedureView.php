<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LFlagprocedureView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fl_flagprocedureview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fl_flagprocedureview = currentForm = new ew.Form("fl_flagprocedureview", "view");
    loadjs.done("fl_flagprocedureview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.l_flagprocedure) ew.vars.tables.l_flagprocedure = <?= JsonEncode(GetClientVar("tables", "l_flagprocedure")) ?>;
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
<form name="fl_flagprocedureview" id="fl_flagprocedureview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_flagprocedure">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
    <tr id="r_id_procedure">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_flagprocedure_id_procedure"><?= $Page->id_procedure->caption() ?></span></td>
        <td data-name="id_procedure" <?= $Page->id_procedure->cellAttributes() ?>>
<span id="el_l_flagprocedure_id_procedure">
<span<?= $Page->id_procedure->viewAttributes() ?>>
<?= $Page->id_procedure->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
    <tr id="r_id_kunjungan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_flagprocedure_id_kunjungan"><?= $Page->id_kunjungan->caption() ?></span></td>
        <td data-name="id_kunjungan" <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el_l_flagprocedure_id_kunjungan">
<span<?= $Page->id_kunjungan->viewAttributes() ?>>
<?= $Page->id_kunjungan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kode_procedure->Visible) { // kode_procedure ?>
    <tr id="r_kode_procedure">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_flagprocedure_kode_procedure"><?= $Page->kode_procedure->caption() ?></span></td>
        <td data-name="kode_procedure" <?= $Page->kode_procedure->cellAttributes() ?>>
<span id="el_l_flagprocedure_kode_procedure">
<span<?= $Page->kode_procedure->viewAttributes() ?>>
<?= $Page->kode_procedure->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_procedure->Visible) { // nama_procedure ?>
    <tr id="r_nama_procedure">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_flagprocedure_nama_procedure"><?= $Page->nama_procedure->caption() ?></span></td>
        <td data-name="nama_procedure" <?= $Page->nama_procedure->cellAttributes() ?>>
<span id="el_l_flagprocedure_nama_procedure">
<span<?= $Page->nama_procedure->viewAttributes() ?>>
<?= $Page->nama_procedure->getViewValue() ?></span>
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
