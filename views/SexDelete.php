<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$SexDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fSEXdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fSEXdelete = currentForm = new ew.Form("fSEXdelete", "delete");
    loadjs.done("fSEXdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.SEX) ew.vars.tables.SEX = <?= JsonEncode(GetClientVar("tables", "SEX")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fSEXdelete" id="fSEXdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="SEX">
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
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th class="<?= $Page->GENDER->headerCellClass() ?>"><span id="elh_SEX_GENDER" class="SEX_GENDER"><?= $Page->GENDER->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAME_OF_GENDER->Visible) { // NAME_OF_GENDER ?>
        <th class="<?= $Page->NAME_OF_GENDER->headerCellClass() ?>"><span id="elh_SEX_NAME_OF_GENDER" class="SEX_NAME_OF_GENDER"><?= $Page->NAME_OF_GENDER->caption() ?></span></th>
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
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_SEX_GENDER" class="SEX_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAME_OF_GENDER->Visible) { // NAME_OF_GENDER ?>
        <td <?= $Page->NAME_OF_GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_SEX_NAME_OF_GENDER" class="SEX_NAME_OF_GENDER">
<span<?= $Page->NAME_OF_GENDER->viewAttributes() ?>>
<?= $Page->NAME_OF_GENDER->getViewValue() ?></span>
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
