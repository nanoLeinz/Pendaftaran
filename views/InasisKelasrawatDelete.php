<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$InasisKelasrawatDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fINASIS_KELASRAWATdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fINASIS_KELASRAWATdelete = currentForm = new ew.Form("fINASIS_KELASRAWATdelete", "delete");
    loadjs.done("fINASIS_KELASRAWATdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.INASIS_KELASRAWAT) ew.vars.tables.INASIS_KELASRAWAT = <?= JsonEncode(GetClientVar("tables", "INASIS_KELASRAWAT")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fINASIS_KELASRAWATdelete" id="fINASIS_KELASRAWATdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="INASIS_KELASRAWAT">
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
<?php if ($Page->KDKELAS->Visible) { // KDKELAS ?>
        <th class="<?= $Page->KDKELAS->headerCellClass() ?>"><span id="elh_INASIS_KELASRAWAT_KDKELAS" class="INASIS_KELASRAWAT_KDKELAS"><?= $Page->KDKELAS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NMKELAS->Visible) { // NMKELAS ?>
        <th class="<?= $Page->NMKELAS->headerCellClass() ?>"><span id="elh_INASIS_KELASRAWAT_NMKELAS" class="INASIS_KELASRAWAT_NMKELAS"><?= $Page->NMKELAS->caption() ?></span></th>
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
<?php if ($Page->KDKELAS->Visible) { // KDKELAS ?>
        <td <?= $Page->KDKELAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_INASIS_KELASRAWAT_KDKELAS" class="INASIS_KELASRAWAT_KDKELAS">
<span<?= $Page->KDKELAS->viewAttributes() ?>>
<?= $Page->KDKELAS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NMKELAS->Visible) { // NMKELAS ?>
        <td <?= $Page->NMKELAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_INASIS_KELASRAWAT_NMKELAS" class="INASIS_KELASRAWAT_NMKELAS">
<span<?= $Page->NMKELAS->viewAttributes() ?>>
<?= $Page->NMKELAS->getViewValue() ?></span>
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
