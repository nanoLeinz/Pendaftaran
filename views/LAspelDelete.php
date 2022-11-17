<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LAspelDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_aspeldelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fl_aspeldelete = currentForm = new ew.Form("fl_aspeldelete", "delete");
    loadjs.done("fl_aspeldelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.l_aspel) ew.vars.tables.l_aspel = <?= JsonEncode(GetClientVar("tables", "l_aspel")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fl_aspeldelete" id="fl_aspeldelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_aspel">
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
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
        <th class="<?= $Page->id_aspel->headerCellClass() ?>"><span id="elh_l_aspel_id_aspel" class="l_aspel_id_aspel"><?= $Page->id_aspel->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
        <th class="<?= $Page->id_kunjungan->headerCellClass() ?>"><span id="elh_l_aspel_id_kunjungan" class="l_aspel_id_kunjungan"><?= $Page->id_kunjungan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_aspel->Visible) { // kode_aspel ?>
        <th class="<?= $Page->kode_aspel->headerCellClass() ?>"><span id="elh_l_aspel_kode_aspel" class="l_aspel_kode_aspel"><?= $Page->kode_aspel->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_aspel->Visible) { // nama_aspel ?>
        <th class="<?= $Page->nama_aspel->headerCellClass() ?>"><span id="elh_l_aspel_nama_aspel" class="l_aspel_nama_aspel"><?= $Page->nama_aspel->caption() ?></span></th>
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
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
        <td <?= $Page->id_aspel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_aspel_id_aspel" class="l_aspel_id_aspel">
<span<?= $Page->id_aspel->viewAttributes() ?>>
<?= $Page->id_aspel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
        <td <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_aspel_id_kunjungan" class="l_aspel_id_kunjungan">
<span<?= $Page->id_kunjungan->viewAttributes() ?>>
<?= $Page->id_kunjungan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_aspel->Visible) { // kode_aspel ?>
        <td <?= $Page->kode_aspel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_aspel_kode_aspel" class="l_aspel_kode_aspel">
<span<?= $Page->kode_aspel->viewAttributes() ?>>
<?= $Page->kode_aspel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_aspel->Visible) { // nama_aspel ?>
        <td <?= $Page->nama_aspel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_aspel_nama_aspel" class="l_aspel_nama_aspel">
<span<?= $Page->nama_aspel->viewAttributes() ?>>
<?= $Page->nama_aspel->getViewValue() ?></span>
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
