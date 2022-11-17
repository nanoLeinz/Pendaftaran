<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatmentBillDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fTREATMENT_BILLdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fTREATMENT_BILLdelete = currentForm = new ew.Form("fTREATMENT_BILLdelete", "delete");
    loadjs.done("fTREATMENT_BILLdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.TREATMENT_BILL) ew.vars.tables.TREATMENT_BILL = <?= JsonEncode(GetClientVar("tables", "TREATMENT_BILL")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fTREATMENT_BILLdelete" id="fTREATMENT_BILLdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREATMENT_BILL">
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
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
        <th class="<?= $Page->TARIF_ID->headerCellClass() ?>"><span id="elh_TREATMENT_BILL_TARIF_ID" class="TREATMENT_BILL_TARIF_ID"><?= $Page->TARIF_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th class="<?= $Page->CLINIC_ID->headerCellClass() ?>"><span id="elh_TREATMENT_BILL_CLINIC_ID" class="TREATMENT_BILL_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <th class="<?= $Page->TREAT_DATE->headerCellClass() ?>"><span id="elh_TREATMENT_BILL_TREAT_DATE" class="TREATMENT_BILL_TREAT_DATE"><?= $Page->TREAT_DATE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->QUANTITY->Visible) { // QUANTITY ?>
        <th class="<?= $Page->QUANTITY->headerCellClass() ?>"><span id="elh_TREATMENT_BILL_QUANTITY" class="TREATMENT_BILL_QUANTITY"><?= $Page->QUANTITY->caption() ?></span></th>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <th class="<?= $Page->EMPLOYEE_ID->headerCellClass() ?>"><span id="elh_TREATMENT_BILL_EMPLOYEE_ID" class="TREATMENT_BILL_EMPLOYEE_ID"><?= $Page->EMPLOYEE_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { // amount_paid ?>
        <th class="<?= $Page->amount_paid->headerCellClass() ?>"><span id="elh_TREATMENT_BILL_amount_paid" class="TREATMENT_BILL_amount_paid"><?= $Page->amount_paid->caption() ?></span></th>
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
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
        <td <?= $Page->TARIF_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_TARIF_ID" class="TREATMENT_BILL_TARIF_ID">
<span<?= $Page->TARIF_ID->viewAttributes() ?>>
<?= $Page->TARIF_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_CLINIC_ID" class="TREATMENT_BILL_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <td <?= $Page->TREAT_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_TREAT_DATE" class="TREATMENT_BILL_TREAT_DATE">
<span<?= $Page->TREAT_DATE->viewAttributes() ?>>
<?= $Page->TREAT_DATE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->QUANTITY->Visible) { // QUANTITY ?>
        <td <?= $Page->QUANTITY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_QUANTITY" class="TREATMENT_BILL_QUANTITY">
<span<?= $Page->QUANTITY->viewAttributes() ?>>
<?= $Page->QUANTITY->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <td <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_EMPLOYEE_ID" class="TREATMENT_BILL_EMPLOYEE_ID">
<span<?= $Page->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Page->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->amount_paid->Visible) { // amount_paid ?>
        <td <?= $Page->amount_paid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_TREATMENT_BILL_amount_paid" class="TREATMENT_BILL_amount_paid">
<span<?= $Page->amount_paid->viewAttributes() ?>>
<?= $Page->amount_paid->getViewValue() ?></span>
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
