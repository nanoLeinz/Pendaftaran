<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$Class2Delete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fCLASS2delete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fCLASS2delete = currentForm = new ew.Form("fCLASS2delete", "delete");
    loadjs.done("fCLASS2delete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.CLASS2) ew.vars.tables.CLASS2 = <?= JsonEncode(GetClientVar("tables", "CLASS2")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fCLASS2delete" id="fCLASS2delete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CLASS2">
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
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
        <th class="<?= $Page->CLASS_ID->headerCellClass() ?>"><span id="elh_CLASS2_CLASS_ID" class="CLASS2_CLASS_ID"><?= $Page->CLASS_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAME_OF_CLASS->Visible) { // NAME_OF_CLASS ?>
        <th class="<?= $Page->NAME_OF_CLASS->headerCellClass() ?>"><span id="elh_CLASS2_NAME_OF_CLASS" class="CLASS2_NAME_OF_CLASS"><?= $Page->NAME_OF_CLASS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <th class="<?= $Page->OTHER_ID->headerCellClass() ?>"><span id="elh_CLASS2_OTHER_ID" class="CLASS2_OTHER_ID"><?= $Page->OTHER_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KDKELASV->Visible) { // KDKELASV ?>
        <th class="<?= $Page->KDKELASV->headerCellClass() ?>"><span id="elh_CLASS2_KDKELASV" class="CLASS2_KDKELASV"><?= $Page->KDKELASV->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KODEKELAS->Visible) { // KODEKELAS ?>
        <th class="<?= $Page->KODEKELAS->headerCellClass() ?>"><span id="elh_CLASS2_KODEKELAS" class="CLASS2_KODEKELAS"><?= $Page->KODEKELAS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SISKODEKELAS->Visible) { // SISKODEKELAS ?>
        <th class="<?= $Page->SISKODEKELAS->headerCellClass() ?>"><span id="elh_CLASS2_SISKODEKELAS" class="CLASS2_SISKODEKELAS"><?= $Page->SISKODEKELAS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SISKODERAWAT->Visible) { // SISKODERAWAT ?>
        <th class="<?= $Page->SISKODERAWAT->headerCellClass() ?>"><span id="elh_CLASS2_SISKODERAWAT" class="CLASS2_SISKODERAWAT"><?= $Page->SISKODERAWAT->caption() ?></span></th>
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
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
        <td <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_CLASS_ID" class="CLASS2_CLASS_ID">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAME_OF_CLASS->Visible) { // NAME_OF_CLASS ?>
        <td <?= $Page->NAME_OF_CLASS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_NAME_OF_CLASS" class="CLASS2_NAME_OF_CLASS">
<span<?= $Page->NAME_OF_CLASS->viewAttributes() ?>>
<?= $Page->NAME_OF_CLASS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <td <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_OTHER_ID" class="CLASS2_OTHER_ID">
<span<?= $Page->OTHER_ID->viewAttributes() ?>>
<?= $Page->OTHER_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KDKELASV->Visible) { // KDKELASV ?>
        <td <?= $Page->KDKELASV->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_KDKELASV" class="CLASS2_KDKELASV">
<span<?= $Page->KDKELASV->viewAttributes() ?>>
<?= $Page->KDKELASV->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KODEKELAS->Visible) { // KODEKELAS ?>
        <td <?= $Page->KODEKELAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_KODEKELAS" class="CLASS2_KODEKELAS">
<span<?= $Page->KODEKELAS->viewAttributes() ?>>
<?= $Page->KODEKELAS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SISKODEKELAS->Visible) { // SISKODEKELAS ?>
        <td <?= $Page->SISKODEKELAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_SISKODEKELAS" class="CLASS2_SISKODEKELAS">
<span<?= $Page->SISKODEKELAS->viewAttributes() ?>>
<?= $Page->SISKODEKELAS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SISKODERAWAT->Visible) { // SISKODERAWAT ?>
        <td <?= $Page->SISKODERAWAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLASS2_SISKODERAWAT" class="CLASS2_SISKODERAWAT">
<span<?= $Page->SISKODERAWAT->viewAttributes() ?>>
<?= $Page->SISKODERAWAT->getViewValue() ?></span>
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
