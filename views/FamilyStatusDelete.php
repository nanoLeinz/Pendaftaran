<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$FamilyStatusDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fFAMILY_STATUSdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fFAMILY_STATUSdelete = currentForm = new ew.Form("fFAMILY_STATUSdelete", "delete");
    loadjs.done("fFAMILY_STATUSdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.FAMILY_STATUS) ew.vars.tables.FAMILY_STATUS = <?= JsonEncode(GetClientVar("tables", "FAMILY_STATUS")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fFAMILY_STATUSdelete" id="fFAMILY_STATUSdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="FAMILY_STATUS">
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
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
        <th class="<?= $Page->FAMILY_STATUS_ID->headerCellClass() ?>"><span id="elh_FAMILY_STATUS_FAMILY_STATUS_ID" class="FAMILY_STATUS_FAMILY_STATUS_ID"><?= $Page->FAMILY_STATUS_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FAMILY_STATUS->Visible) { // FAMILY_STATUS ?>
        <th class="<?= $Page->FAMILY_STATUS->headerCellClass() ?>"><span id="elh_FAMILY_STATUS_FAMILY_STATUS" class="FAMILY_STATUS_FAMILY_STATUS"><?= $Page->FAMILY_STATUS->caption() ?></span></th>
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
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
        <td <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_STATUS_FAMILY_STATUS_ID" class="FAMILY_STATUS_FAMILY_STATUS_ID">
<span<?= $Page->FAMILY_STATUS_ID->viewAttributes() ?>>
<?= $Page->FAMILY_STATUS_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FAMILY_STATUS->Visible) { // FAMILY_STATUS ?>
        <td <?= $Page->FAMILY_STATUS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_STATUS_FAMILY_STATUS" class="FAMILY_STATUS_FAMILY_STATUS">
<span<?= $Page->FAMILY_STATUS->viewAttributes() ?>>
<?= $Page->FAMILY_STATUS->getViewValue() ?></span>
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
