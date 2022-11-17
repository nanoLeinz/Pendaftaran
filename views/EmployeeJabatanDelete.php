<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$EmployeeJabatanDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fEMPLOYEE_JABATANdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fEMPLOYEE_JABATANdelete = currentForm = new ew.Form("fEMPLOYEE_JABATANdelete", "delete");
    loadjs.done("fEMPLOYEE_JABATANdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.EMPLOYEE_JABATAN) ew.vars.tables.EMPLOYEE_JABATAN = <?= JsonEncode(GetClientVar("tables", "EMPLOYEE_JABATAN")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fEMPLOYEE_JABATANdelete" id="fEMPLOYEE_JABATANdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="EMPLOYEE_JABATAN">
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
<?php if ($Page->KODE_JABATAN->Visible) { // KODE_JABATAN ?>
        <th class="<?= $Page->KODE_JABATAN->headerCellClass() ?>"><span id="elh_EMPLOYEE_JABATAN_KODE_JABATAN" class="EMPLOYEE_JABATAN_KODE_JABATAN"><?= $Page->KODE_JABATAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->JABATAN->Visible) { // JABATAN ?>
        <th class="<?= $Page->JABATAN->headerCellClass() ?>"><span id="elh_EMPLOYEE_JABATAN_JABATAN" class="EMPLOYEE_JABATAN_JABATAN"><?= $Page->JABATAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ESELON->Visible) { // ESELON ?>
        <th class="<?= $Page->ESELON->headerCellClass() ?>"><span id="elh_EMPLOYEE_JABATAN_ESELON" class="EMPLOYEE_JABATAN_ESELON"><?= $Page->ESELON->caption() ?></span></th>
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
<?php if ($Page->KODE_JABATAN->Visible) { // KODE_JABATAN ?>
        <td <?= $Page->KODE_JABATAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_JABATAN_KODE_JABATAN" class="EMPLOYEE_JABATAN_KODE_JABATAN">
<span<?= $Page->KODE_JABATAN->viewAttributes() ?>>
<?= $Page->KODE_JABATAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->JABATAN->Visible) { // JABATAN ?>
        <td <?= $Page->JABATAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_JABATAN_JABATAN" class="EMPLOYEE_JABATAN_JABATAN">
<span<?= $Page->JABATAN->viewAttributes() ?>>
<?= $Page->JABATAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ESELON->Visible) { // ESELON ?>
        <td <?= $Page->ESELON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_EMPLOYEE_JABATAN_ESELON" class="EMPLOYEE_JABATAN_ESELON">
<span<?= $Page->ESELON->viewAttributes() ?>>
<?= $Page->ESELON->getViewValue() ?></span>
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
