<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MPoliBpjsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_poli_bpjsdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fm_poli_bpjsdelete = currentForm = new ew.Form("fm_poli_bpjsdelete", "delete");
    loadjs.done("fm_poli_bpjsdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.m_poli_bpjs) ew.vars.tables.m_poli_bpjs = <?= JsonEncode(GetClientVar("tables", "m_poli_bpjs")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fm_poli_bpjsdelete" id="fm_poli_bpjsdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_poli_bpjs">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_m_poli_bpjs_id" class="m_poli_bpjs_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->clinic_id->Visible) { // clinic_id ?>
        <th class="<?= $Page->clinic_id->headerCellClass() ?>"><span id="elh_m_poli_bpjs_clinic_id" class="m_poli_bpjs_clinic_id"><?= $Page->clinic_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kd_poli_bpjs->Visible) { // kd_poli_bpjs ?>
        <th class="<?= $Page->kd_poli_bpjs->headerCellClass() ?>"><span id="elh_m_poli_bpjs_kd_poli_bpjs" class="m_poli_bpjs_kd_poli_bpjs"><?= $Page->kd_poli_bpjs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_poli->Visible) { // nama_poli ?>
        <th class="<?= $Page->nama_poli->headerCellClass() ?>"><span id="elh_m_poli_bpjs_nama_poli" class="m_poli_bpjs_nama_poli"><?= $Page->nama_poli->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_m_poli_bpjs_id" class="m_poli_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->clinic_id->Visible) { // clinic_id ?>
        <td <?= $Page->clinic_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_poli_bpjs_clinic_id" class="m_poli_bpjs_clinic_id">
<span<?= $Page->clinic_id->viewAttributes() ?>>
<?= $Page->clinic_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kd_poli_bpjs->Visible) { // kd_poli_bpjs ?>
        <td <?= $Page->kd_poli_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_poli_bpjs_kd_poli_bpjs" class="m_poli_bpjs_kd_poli_bpjs">
<span<?= $Page->kd_poli_bpjs->viewAttributes() ?>>
<?= $Page->kd_poli_bpjs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_poli->Visible) { // nama_poli ?>
        <td <?= $Page->nama_poli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_poli_bpjs_nama_poli" class="m_poli_bpjs_nama_poli">
<span<?= $Page->nama_poli->viewAttributes() ?>>
<?= $Page->nama_poli->getViewValue() ?></span>
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
