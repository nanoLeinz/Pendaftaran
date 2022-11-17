<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PayorTypeDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPAYOR_TYPEdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fPAYOR_TYPEdelete = currentForm = new ew.Form("fPAYOR_TYPEdelete", "delete");
    loadjs.done("fPAYOR_TYPEdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.PAYOR_TYPE) ew.vars.tables.PAYOR_TYPE = <?= JsonEncode(GetClientVar("tables", "PAYOR_TYPE")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fPAYOR_TYPEdelete" id="fPAYOR_TYPEdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYOR_TYPE">
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
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
        <th class="<?= $Page->PAYOR_TYPE->headerCellClass() ?>"><span id="elh_PAYOR_TYPE_PAYOR_TYPE" class="PAYOR_TYPE_PAYOR_TYPE"><?= $Page->PAYOR_TYPE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PAYERTYPE->Visible) { // PAYERTYPE ?>
        <th class="<?= $Page->PAYERTYPE->headerCellClass() ?>"><span id="elh_PAYOR_TYPE_PAYERTYPE" class="PAYOR_TYPE_PAYERTYPE"><?= $Page->PAYERTYPE->caption() ?></span></th>
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
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
        <td <?= $Page->PAYOR_TYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_TYPE_PAYOR_TYPE" class="PAYOR_TYPE_PAYOR_TYPE">
<span<?= $Page->PAYOR_TYPE->viewAttributes() ?>>
<?= $Page->PAYOR_TYPE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PAYERTYPE->Visible) { // PAYERTYPE ?>
        <td <?= $Page->PAYERTYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_TYPE_PAYERTYPE" class="PAYOR_TYPE_PAYERTYPE">
<span<?= $Page->PAYERTYPE->viewAttributes() ?>>
<?= $Page->PAYERTYPE->getViewValue() ?></span>
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
