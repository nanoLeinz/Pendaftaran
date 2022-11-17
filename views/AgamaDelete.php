<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AgamaDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fAGAMAdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fAGAMAdelete = currentForm = new ew.Form("fAGAMAdelete", "delete");
    loadjs.done("fAGAMAdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.AGAMA) ew.vars.tables.AGAMA = <?= JsonEncode(GetClientVar("tables", "AGAMA")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fAGAMAdelete" id="fAGAMAdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="AGAMA">
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
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
        <th class="<?= $Page->KODE_AGAMA->headerCellClass() ?>"><span id="elh_AGAMA_KODE_AGAMA" class="AGAMA_KODE_AGAMA"><?= $Page->KODE_AGAMA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA_AGAMA->Visible) { // NAMA_AGAMA ?>
        <th class="<?= $Page->NAMA_AGAMA->headerCellClass() ?>"><span id="elh_AGAMA_NAMA_AGAMA" class="AGAMA_NAMA_AGAMA"><?= $Page->NAMA_AGAMA->caption() ?></span></th>
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
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
        <td <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGAMA_KODE_AGAMA" class="AGAMA_KODE_AGAMA">
<span<?= $Page->KODE_AGAMA->viewAttributes() ?>>
<?= $Page->KODE_AGAMA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA_AGAMA->Visible) { // NAMA_AGAMA ?>
        <td <?= $Page->NAMA_AGAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_AGAMA_NAMA_AGAMA" class="AGAMA_NAMA_AGAMA">
<span<?= $Page->NAMA_AGAMA->viewAttributes() ?>>
<?= $Page->NAMA_AGAMA->getViewValue() ?></span>
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
