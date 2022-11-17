<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MDokterBpjsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_dokter_bpjsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fm_dokter_bpjsdelete = currentForm = new ew.Form("fm_dokter_bpjsdelete", "delete");
    loadjs.done("fm_dokter_bpjsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.m_dokter_bpjs) ew.vars.tables.m_dokter_bpjs = <?= JsonEncode(GetClientVar("tables", "m_dokter_bpjs")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fm_dokter_bpjsdelete" id="fm_dokter_bpjsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_dokter_bpjs">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_m_dokter_bpjs_id" class="m_dokter_bpjs_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <th class="<?= $Page->employee_id->headerCellClass() ?>"><span id="elh_m_dokter_bpjs_employee_id" class="m_dokter_bpjs_employee_id"><?= $Page->employee_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_dpjp->Visible) { // kd_dpjp ?>
        <th class="<?= $Page->kd_dpjp->headerCellClass() ?>"><span id="elh_m_dokter_bpjs_kd_dpjp" class="m_dokter_bpjs_kd_dpjp"><?= $Page->kd_dpjp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_dokter->Visible) { // nama_dokter ?>
        <th class="<?= $Page->nama_dokter->headerCellClass() ?>"><span id="elh_m_dokter_bpjs_nama_dokter" class="m_dokter_bpjs_nama_dokter"><?= $Page->nama_dokter->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_dokter_bpjs_id" class="m_dokter_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
        <td <?= $Page->employee_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_dokter_bpjs_employee_id" class="m_dokter_bpjs_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_dpjp->Visible) { // kd_dpjp ?>
        <td <?= $Page->kd_dpjp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_dokter_bpjs_kd_dpjp" class="m_dokter_bpjs_kd_dpjp">
<span<?= $Page->kd_dpjp->viewAttributes() ?>>
<?= $Page->kd_dpjp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_dokter->Visible) { // nama_dokter ?>
        <td <?= $Page->nama_dokter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_dokter_bpjs_nama_dokter" class="m_dokter_bpjs_nama_dokter">
<span<?= $Page->nama_dokter->viewAttributes() ?>>
<?= $Page->nama_dokter->getViewValue() ?></span>
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
