<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AgeDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fAGEdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fAGEdelete = currentForm = new ew.Form("fAGEdelete", "delete");
    loadjs.done("fAGEdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.AGE) ew.vars.tables.AGE = <?= JsonEncode(GetClientVar("tables", "AGE")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fAGEdelete" id="fAGEdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="AGE">
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
<?php if ($Page->CAT->Visible) { // CAT ?>
        <th class="<?= $Page->CAT->headerCellClass() ?>"><span id="elh_AGE_CAT" class="AGE_CAT"><?= $Page->CAT->caption() ?></span></th>
<?php } ?>
<?php if ($Page->GROUP_ID->Visible) { // GROUP_ID ?>
        <th class="<?= $Page->GROUP_ID->headerCellClass() ?>"><span id="elh_AGE_GROUP_ID" class="AGE_GROUP_ID"><?= $Page->GROUP_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->BAT_BAWAH->Visible) { // BAT_BAWAH ?>
        <th class="<?= $Page->BAT_BAWAH->headerCellClass() ?>"><span id="elh_AGE_BAT_BAWAH" class="AGE_BAT_BAWAH"><?= $Page->BAT_BAWAH->caption() ?></span></th>
<?php } ?>
<?php if ($Page->BAT_ATAS->Visible) { // BAT_ATAS ?>
        <th class="<?= $Page->BAT_ATAS->headerCellClass() ?>"><span id="elh_AGE_BAT_ATAS" class="AGE_BAT_ATAS"><?= $Page->BAT_ATAS->caption() ?></span></th>
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
<?php if ($Page->CAT->Visible) { // CAT ?>
        <td <?= $Page->CAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGE_CAT" class="AGE_CAT">
<span<?= $Page->CAT->viewAttributes() ?>>
<?= $Page->CAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->GROUP_ID->Visible) { // GROUP_ID ?>
        <td <?= $Page->GROUP_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGE_GROUP_ID" class="AGE_GROUP_ID">
<span<?= $Page->GROUP_ID->viewAttributes() ?>>
<?= $Page->GROUP_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->BAT_BAWAH->Visible) { // BAT_BAWAH ?>
        <td <?= $Page->BAT_BAWAH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGE_BAT_BAWAH" class="AGE_BAT_BAWAH">
<span<?= $Page->BAT_BAWAH->viewAttributes() ?>>
<?= $Page->BAT_BAWAH->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->BAT_ATAS->Visible) { // BAT_ATAS ?>
        <td <?= $Page->BAT_ATAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGE_BAT_ATAS" class="AGE_BAT_ATAS">
<span<?= $Page->BAT_ATAS->viewAttributes() ?>>
<?= $Page->BAT_ATAS->getViewValue() ?></span>
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
