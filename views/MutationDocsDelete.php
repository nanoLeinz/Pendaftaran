<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MutationDocsDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fMUTATION_DOCSdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fMUTATION_DOCSdelete = currentForm = new ew.Form("fMUTATION_DOCSdelete", "delete");
    loadjs.done("fMUTATION_DOCSdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.MUTATION_DOCS) ew.vars.tables.MUTATION_DOCS = <?= JsonEncode(GetClientVar("tables", "MUTATION_DOCS")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fMUTATION_DOCSdelete" id="fMUTATION_DOCSdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="MUTATION_DOCS">
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
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th class="<?= $Page->CLINIC_ID->headerCellClass() ?>"><span id="elh_MUTATION_DOCS_CLINIC_ID" class="MUTATION_DOCS_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->CLINIC_ID_TO->Visible) { // CLINIC_ID_TO ?>
        <th class="<?= $Page->CLINIC_ID_TO->headerCellClass() ?>"><span id="elh_MUTATION_DOCS_CLINIC_ID_TO" class="MUTATION_DOCS_CLINIC_ID_TO"><?= $Page->CLINIC_ID_TO->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MUTATION_DATE->Visible) { // MUTATION_DATE ?>
        <th class="<?= $Page->MUTATION_DATE->headerCellClass() ?>"><span id="elh_MUTATION_DOCS_MUTATION_DATE" class="MUTATION_DOCS_MUTATION_DATE"><?= $Page->MUTATION_DATE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MUTATION_VALUE->Visible) { // MUTATION_VALUE ?>
        <th class="<?= $Page->MUTATION_VALUE->headerCellClass() ?>"><span id="elh_MUTATION_DOCS_MUTATION_VALUE" class="MUTATION_DOCS_MUTATION_VALUE"><?= $Page->MUTATION_VALUE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ORDER_VALUE->Visible) { // ORDER_VALUE ?>
        <th class="<?= $Page->ORDER_VALUE->headerCellClass() ?>"><span id="elh_MUTATION_DOCS_ORDER_VALUE" class="MUTATION_DOCS_ORDER_VALUE"><?= $Page->ORDER_VALUE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->RECEIVED_BY->Visible) { // RECEIVED_BY ?>
        <th class="<?= $Page->RECEIVED_BY->headerCellClass() ?>"><span id="elh_MUTATION_DOCS_RECEIVED_BY" class="MUTATION_DOCS_RECEIVED_BY"><?= $Page->RECEIVED_BY->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DISTRIBUTION_TYPE->Visible) { // DISTRIBUTION_TYPE ?>
        <th class="<?= $Page->DISTRIBUTION_TYPE->headerCellClass() ?>"><span id="elh_MUTATION_DOCS_DISTRIBUTION_TYPE" class="MUTATION_DOCS_DISTRIBUTION_TYPE"><?= $Page->DISTRIBUTION_TYPE->caption() ?></span></th>
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
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_CLINIC_ID" class="MUTATION_DOCS_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->CLINIC_ID_TO->Visible) { // CLINIC_ID_TO ?>
        <td <?= $Page->CLINIC_ID_TO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_CLINIC_ID_TO" class="MUTATION_DOCS_CLINIC_ID_TO">
<span<?= $Page->CLINIC_ID_TO->viewAttributes() ?>>
<?= $Page->CLINIC_ID_TO->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MUTATION_DATE->Visible) { // MUTATION_DATE ?>
        <td <?= $Page->MUTATION_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_MUTATION_DATE" class="MUTATION_DOCS_MUTATION_DATE">
<span<?= $Page->MUTATION_DATE->viewAttributes() ?>>
<?= $Page->MUTATION_DATE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MUTATION_VALUE->Visible) { // MUTATION_VALUE ?>
        <td <?= $Page->MUTATION_VALUE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_MUTATION_VALUE" class="MUTATION_DOCS_MUTATION_VALUE">
<span<?= $Page->MUTATION_VALUE->viewAttributes() ?>>
<?= $Page->MUTATION_VALUE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ORDER_VALUE->Visible) { // ORDER_VALUE ?>
        <td <?= $Page->ORDER_VALUE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_ORDER_VALUE" class="MUTATION_DOCS_ORDER_VALUE">
<span<?= $Page->ORDER_VALUE->viewAttributes() ?>>
<?= $Page->ORDER_VALUE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->RECEIVED_BY->Visible) { // RECEIVED_BY ?>
        <td <?= $Page->RECEIVED_BY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_RECEIVED_BY" class="MUTATION_DOCS_RECEIVED_BY">
<span<?= $Page->RECEIVED_BY->viewAttributes() ?>>
<?= $Page->RECEIVED_BY->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DISTRIBUTION_TYPE->Visible) { // DISTRIBUTION_TYPE ?>
        <td <?= $Page->DISTRIBUTION_TYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_MUTATION_DOCS_DISTRIBUTION_TYPE" class="MUTATION_DOCS_DISTRIBUTION_TYPE">
<span<?= $Page->DISTRIBUTION_TYPE->viewAttributes() ?>>
<?= $Page->DISTRIBUTION_TYPE->getViewValue() ?></span>
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
