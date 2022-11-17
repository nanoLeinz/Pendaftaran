<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MDokterBpjsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fm_dokter_bpjsview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fm_dokter_bpjsview = currentForm = new ew.Form("fm_dokter_bpjsview", "view");
    loadjs.done("fm_dokter_bpjsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.m_dokter_bpjs) ew.vars.tables.m_dokter_bpjs = <?= JsonEncode(GetClientVar("tables", "m_dokter_bpjs")) ?>;
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
<form name="fm_dokter_bpjsview" id="fm_dokter_bpjsview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_dokter_bpjs">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_dokter_bpjs_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_m_dokter_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <tr id="r_employee_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_dokter_bpjs_employee_id"><?= $Page->employee_id->caption() ?></span></td>
        <td data-name="employee_id" <?= $Page->employee_id->cellAttributes() ?>>
<span id="el_m_dokter_bpjs_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kd_dpjp->Visible) { // kd_dpjp ?>
    <tr id="r_kd_dpjp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_dokter_bpjs_kd_dpjp"><?= $Page->kd_dpjp->caption() ?></span></td>
        <td data-name="kd_dpjp" <?= $Page->kd_dpjp->cellAttributes() ?>>
<span id="el_m_dokter_bpjs_kd_dpjp">
<span<?= $Page->kd_dpjp->viewAttributes() ?>>
<?= $Page->kd_dpjp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_dokter->Visible) { // nama_dokter ?>
    <tr id="r_nama_dokter">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_dokter_bpjs_nama_dokter"><?= $Page->nama_dokter->caption() ?></span></td>
        <td data-name="nama_dokter" <?= $Page->nama_dokter->cellAttributes() ?>>
<span id="el_m_dokter_bpjs_nama_dokter">
<span<?= $Page->nama_dokter->viewAttributes() ?>>
<?= $Page->nama_dokter->getViewValue() ?></span>
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
