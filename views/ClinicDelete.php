<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ClinicDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fCLINICdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fCLINICdelete = currentForm = new ew.Form("fCLINICdelete", "delete");
    loadjs.done("fCLINICdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.CLINIC) ew.vars.tables.CLINIC = <?= JsonEncode(GetClientVar("tables", "CLINIC")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fCLINICdelete" id="fCLINICdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CLINIC">
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
        <th class="<?= $Page->ORG_UNIT_CODE->headerCellClass() ?>"><span id="elh_CLINIC_ORG_UNIT_CODE" class="CLINIC_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <th class="<?= $Page->CLINIC_ID->headerCellClass() ?>"><span id="elh_CLINIC_CLINIC_ID" class="CLINIC_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAME_OF_CLINIC->Visible) { // NAME_OF_CLINIC ?>
        <th class="<?= $Page->NAME_OF_CLINIC->headerCellClass() ?>"><span id="elh_CLINIC_NAME_OF_CLINIC" class="CLINIC_NAME_OF_CLINIC"><?= $Page->NAME_OF_CLINIC->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
        <th class="<?= $Page->ORG_ID->headerCellClass() ?>"><span id="elh_CLINIC_ORG_ID" class="CLINIC_ORG_ID"><?= $Page->ORG_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->STYPE_ID->Visible) { // STYPE_ID ?>
        <th class="<?= $Page->STYPE_ID->headerCellClass() ?>"><span id="elh_CLINIC_STYPE_ID" class="CLINIC_STYPE_ID"><?= $Page->STYPE_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->CLINIC_TYPE->Visible) { // CLINIC_TYPE ?>
        <th class="<?= $Page->CLINIC_TYPE->headerCellClass() ?>"><span id="elh_CLINIC_CLINIC_TYPE" class="CLINIC_CLINIC_TYPE"><?= $Page->CLINIC_TYPE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <th class="<?= $Page->OTHER_ID->headerCellClass() ?>"><span id="elh_CLINIC_OTHER_ID" class="CLINIC_OTHER_ID"><?= $Page->OTHER_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ACCOUNT_ID->Visible) { // ACCOUNT_ID ?>
        <th class="<?= $Page->ACCOUNT_ID->headerCellClass() ?>"><span id="elh_CLINIC_ACCOUNT_ID" class="CLINIC_ACCOUNT_ID"><?= $Page->ACCOUNT_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FA_V->Visible) { // FA_V ?>
        <th class="<?= $Page->FA_V->headerCellClass() ?>"><span id="elh_CLINIC_FA_V" class="CLINIC_FA_V"><?= $Page->FA_V->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROFIT_ID->Visible) { // PROFIT_ID ?>
        <th class="<?= $Page->PROFIT_ID->headerCellClass() ?>"><span id="elh_CLINIC_PROFIT_ID" class="CLINIC_PROFIT_ID"><?= $Page->PROFIT_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SUPPLIED_MM->Visible) { // SUPPLIED_MM ?>
        <th class="<?= $Page->SUPPLIED_MM->headerCellClass() ?>"><span id="elh_CLINIC_SUPPLIED_MM" class="CLINIC_SUPPLIED_MM"><?= $Page->SUPPLIED_MM->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KDPOLI->Visible) { // KDPOLI ?>
        <th class="<?= $Page->KDPOLI->headerCellClass() ?>"><span id="elh_CLINIC_KDPOLI" class="CLINIC_KDPOLI"><?= $Page->KDPOLI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SPESIALISTIK->Visible) { // SPESIALISTIK ?>
        <th class="<?= $Page->SPESIALISTIK->headerCellClass() ?>"><span id="elh_CLINIC_SPESIALISTIK" class="CLINIC_SPESIALISTIK"><?= $Page->SPESIALISTIK->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_CLINIC_ORG_UNIT_CODE" class="CLINIC_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <td <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_CLINIC_ID" class="CLINIC_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAME_OF_CLINIC->Visible) { // NAME_OF_CLINIC ?>
        <td <?= $Page->NAME_OF_CLINIC->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_NAME_OF_CLINIC" class="CLINIC_NAME_OF_CLINIC">
<span<?= $Page->NAME_OF_CLINIC->viewAttributes() ?>>
<?= $Page->NAME_OF_CLINIC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
        <td <?= $Page->ORG_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_ORG_ID" class="CLINIC_ORG_ID">
<span<?= $Page->ORG_ID->viewAttributes() ?>>
<?= $Page->ORG_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->STYPE_ID->Visible) { // STYPE_ID ?>
        <td <?= $Page->STYPE_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_STYPE_ID" class="CLINIC_STYPE_ID">
<span<?= $Page->STYPE_ID->viewAttributes() ?>>
<?= $Page->STYPE_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->CLINIC_TYPE->Visible) { // CLINIC_TYPE ?>
        <td <?= $Page->CLINIC_TYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_CLINIC_TYPE" class="CLINIC_CLINIC_TYPE">
<span<?= $Page->CLINIC_TYPE->viewAttributes() ?>>
<?= $Page->CLINIC_TYPE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <td <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_OTHER_ID" class="CLINIC_OTHER_ID">
<span<?= $Page->OTHER_ID->viewAttributes() ?>>
<?= $Page->OTHER_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ACCOUNT_ID->Visible) { // ACCOUNT_ID ?>
        <td <?= $Page->ACCOUNT_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_ACCOUNT_ID" class="CLINIC_ACCOUNT_ID">
<span<?= $Page->ACCOUNT_ID->viewAttributes() ?>>
<?= $Page->ACCOUNT_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FA_V->Visible) { // FA_V ?>
        <td <?= $Page->FA_V->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_FA_V" class="CLINIC_FA_V">
<span<?= $Page->FA_V->viewAttributes() ?>>
<?= $Page->FA_V->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROFIT_ID->Visible) { // PROFIT_ID ?>
        <td <?= $Page->PROFIT_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_PROFIT_ID" class="CLINIC_PROFIT_ID">
<span<?= $Page->PROFIT_ID->viewAttributes() ?>>
<?= $Page->PROFIT_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SUPPLIED_MM->Visible) { // SUPPLIED_MM ?>
        <td <?= $Page->SUPPLIED_MM->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_SUPPLIED_MM" class="CLINIC_SUPPLIED_MM">
<span<?= $Page->SUPPLIED_MM->viewAttributes() ?>>
<?= $Page->SUPPLIED_MM->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KDPOLI->Visible) { // KDPOLI ?>
        <td <?= $Page->KDPOLI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_KDPOLI" class="CLINIC_KDPOLI">
<span<?= $Page->KDPOLI->viewAttributes() ?>>
<?= $Page->KDPOLI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SPESIALISTIK->Visible) { // SPESIALISTIK ?>
        <td <?= $Page->SPESIALISTIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_CLINIC_SPESIALISTIK" class="CLINIC_SPESIALISTIK">
<span<?= $Page->SPESIALISTIK->viewAttributes() ?>>
<?= $Page->SPESIALISTIK->getViewValue() ?></span>
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
