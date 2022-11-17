<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MPoliBpjsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fm_poli_bpjsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fm_poli_bpjsview = currentForm = new ew.Form("fm_poli_bpjsview", "view");
    loadjs.done("fm_poli_bpjsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.m_poli_bpjs) ew.vars.tables.m_poli_bpjs = <?= JsonEncode(GetClientVar("tables", "m_poli_bpjs")) ?>;
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
<form name="fm_poli_bpjsview" id="fm_poli_bpjsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_poli_bpjs">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_poli_bpjs_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_m_poli_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->clinic_id->Visible) { // clinic_id ?>
    <tr id="r_clinic_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_poli_bpjs_clinic_id"><?= $Page->clinic_id->caption() ?></span></td>
        <td data-name="clinic_id" <?= $Page->clinic_id->cellAttributes() ?>>
<span id="el_m_poli_bpjs_clinic_id">
<span<?= $Page->clinic_id->viewAttributes() ?>>
<?= $Page->clinic_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_poli_bpjs->Visible) { // kd_poli_bpjs ?>
    <tr id="r_kd_poli_bpjs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_poli_bpjs_kd_poli_bpjs"><?= $Page->kd_poli_bpjs->caption() ?></span></td>
        <td data-name="kd_poli_bpjs" <?= $Page->kd_poli_bpjs->cellAttributes() ?>>
<span id="el_m_poli_bpjs_kd_poli_bpjs">
<span<?= $Page->kd_poli_bpjs->viewAttributes() ?>>
<?= $Page->kd_poli_bpjs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_poli->Visible) { // nama_poli ?>
    <tr id="r_nama_poli">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_poli_bpjs_nama_poli"><?= $Page->nama_poli->caption() ?></span></td>
        <td data-name="nama_poli" <?= $Page->nama_poli->cellAttributes() ?>>
<span id="el_m_poli_bpjs_nama_poli">
<span<?= $Page->nama_poli->viewAttributes() ?>>
<?= $Page->nama_poli->getViewValue() ?></span>
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
