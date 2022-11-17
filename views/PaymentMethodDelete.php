<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PaymentMethodDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPAYMENT_METHODdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fPAYMENT_METHODdelete = currentForm = new ew.Form("fPAYMENT_METHODdelete", "delete");
    loadjs.done("fPAYMENT_METHODdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.PAYMENT_METHOD) ew.vars.tables.PAYMENT_METHOD = <?= JsonEncode(GetClientVar("tables", "PAYMENT_METHOD")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fPAYMENT_METHODdelete" id="fPAYMENT_METHODdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYMENT_METHOD">
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
<?php if ($Page->PAY_METHOD_ID->Visible) { // PAY_METHOD_ID ?>
        <th class="<?= $Page->PAY_METHOD_ID->headerCellClass() ?>"><span id="elh_PAYMENT_METHOD_PAY_METHOD_ID" class="PAYMENT_METHOD_PAY_METHOD_ID"><?= $Page->PAY_METHOD_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PAYMETHOD->Visible) { // PAYMETHOD ?>
        <th class="<?= $Page->PAYMETHOD->headerCellClass() ?>"><span id="elh_PAYMENT_METHOD_PAYMETHOD" class="PAYMENT_METHOD_PAYMETHOD"><?= $Page->PAYMETHOD->caption() ?></span></th>
<?php } ?>
<?php if ($Page->display->Visible) { // display ?>
        <th class="<?= $Page->display->headerCellClass() ?>"><span id="elh_PAYMENT_METHOD_display" class="PAYMENT_METHOD_display"><?= $Page->display->caption() ?></span></th>
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
<?php if ($Page->PAY_METHOD_ID->Visible) { // PAY_METHOD_ID ?>
        <td <?= $Page->PAY_METHOD_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYMENT_METHOD_PAY_METHOD_ID" class="PAYMENT_METHOD_PAY_METHOD_ID">
<span<?= $Page->PAY_METHOD_ID->viewAttributes() ?>>
<?= $Page->PAY_METHOD_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PAYMETHOD->Visible) { // PAYMETHOD ?>
        <td <?= $Page->PAYMETHOD->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYMENT_METHOD_PAYMETHOD" class="PAYMENT_METHOD_PAYMETHOD">
<span<?= $Page->PAYMETHOD->viewAttributes() ?>>
<?= $Page->PAYMETHOD->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->display->Visible) { // display ?>
        <td <?= $Page->display->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYMENT_METHOD_display" class="PAYMENT_METHOD_display">
<span<?= $Page->display->viewAttributes() ?>>
<?= $Page->display->getViewValue() ?></span>
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
