<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PayorInfoDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPAYOR_INFOdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fPAYOR_INFOdelete = currentForm = new ew.Form("fPAYOR_INFOdelete", "delete");
    loadjs.done("fPAYOR_INFOdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.PAYOR_INFO) ew.vars.tables.PAYOR_INFO = <?= JsonEncode(GetClientVar("tables", "PAYOR_INFO")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fPAYOR_INFOdelete" id="fPAYOR_INFOdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYOR_INFO">
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
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <th class="<?= $Page->ORG_UNIT_CODE->headerCellClass() ?>"><span id="elh_PAYOR_INFO_ORG_UNIT_CODE" class="PAYOR_INFO_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <th class="<?= $Page->PAYOR_ID->headerCellClass() ?>"><span id="elh_PAYOR_INFO_PAYOR_ID" class="PAYOR_INFO_PAYOR_ID"><?= $Page->PAYOR_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
        <th class="<?= $Page->PAYOR_TYPE->headerCellClass() ?>"><span id="elh_PAYOR_INFO_PAYOR_TYPE" class="PAYOR_INFO_PAYOR_TYPE"><?= $Page->PAYOR_TYPE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PAYOR->Visible) { // PAYOR ?>
        <th class="<?= $Page->PAYOR->headerCellClass() ?>"><span id="elh_PAYOR_INFO_PAYOR" class="PAYOR_INFO_PAYOR"><?= $Page->PAYOR->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
        <th class="<?= $Page->ADDRESS->headerCellClass() ?>"><span id="elh_PAYOR_INFO_ADDRESS" class="PAYOR_INFO_ADDRESS"><?= $Page->ADDRESS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->CITY->Visible) { // CITY ?>
        <th class="<?= $Page->CITY->headerCellClass() ?>"><span id="elh_PAYOR_INFO_CITY" class="PAYOR_INFO_CITY"><?= $Page->CITY->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
        <th class="<?= $Page->PHONE->headerCellClass() ?>"><span id="elh_PAYOR_INFO_PHONE" class="PAYOR_INFO_PHONE"><?= $Page->PHONE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
        <th class="<?= $Page->FAX->headerCellClass() ?>"><span id="elh_PAYOR_INFO_FAX" class="PAYOR_INFO_FAX"><?= $Page->FAX->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KDVKLAIM->Visible) { // KDVKLAIM ?>
        <th class="<?= $Page->KDVKLAIM->headerCellClass() ?>"><span id="elh_PAYOR_INFO_KDVKLAIM" class="PAYOR_INFO_KDVKLAIM"><?= $Page->KDVKLAIM->caption() ?></span></th>
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
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <td <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_ORG_UNIT_CODE" class="PAYOR_INFO_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <td <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_PAYOR_ID" class="PAYOR_INFO_PAYOR_ID">
<span<?= $Page->PAYOR_ID->viewAttributes() ?>>
<?= $Page->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
        <td <?= $Page->PAYOR_TYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_PAYOR_TYPE" class="PAYOR_INFO_PAYOR_TYPE">
<span<?= $Page->PAYOR_TYPE->viewAttributes() ?>>
<?= $Page->PAYOR_TYPE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PAYOR->Visible) { // PAYOR ?>
        <td <?= $Page->PAYOR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_PAYOR" class="PAYOR_INFO_PAYOR">
<span<?= $Page->PAYOR->viewAttributes() ?>>
<?= $Page->PAYOR->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
        <td <?= $Page->ADDRESS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_ADDRESS" class="PAYOR_INFO_ADDRESS">
<span<?= $Page->ADDRESS->viewAttributes() ?>>
<?= $Page->ADDRESS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->CITY->Visible) { // CITY ?>
        <td <?= $Page->CITY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_CITY" class="PAYOR_INFO_CITY">
<span<?= $Page->CITY->viewAttributes() ?>>
<?= $Page->CITY->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
        <td <?= $Page->PHONE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_PHONE" class="PAYOR_INFO_PHONE">
<span<?= $Page->PHONE->viewAttributes() ?>>
<?= $Page->PHONE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
        <td <?= $Page->FAX->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_FAX" class="PAYOR_INFO_FAX">
<span<?= $Page->FAX->viewAttributes() ?>>
<?= $Page->FAX->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KDVKLAIM->Visible) { // KDVKLAIM ?>
        <td <?= $Page->KDVKLAIM->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PAYOR_INFO_KDVKLAIM" class="PAYOR_INFO_KDVKLAIM">
<span<?= $Page->KDVKLAIM->viewAttributes() ?>>
<?= $Page->KDVKLAIM->getViewValue() ?></span>
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
