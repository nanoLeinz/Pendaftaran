<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LPenunjangDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_penunjangdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fl_penunjangdelete = currentForm = new ew.Form("fl_penunjangdelete", "delete");
    loadjs.done("fl_penunjangdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.l_penunjang) ew.vars.tables.l_penunjang = <?= JsonEncode(GetClientVar("tables", "l_penunjang")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fl_penunjangdelete" id="fl_penunjangdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_penunjang">
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
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
        <th class="<?= $Page->id_penunjang->headerCellClass() ?>"><span id="elh_l_penunjang_id_penunjang" class="l_penunjang_id_penunjang"><?= $Page->id_penunjang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
        <th class="<?= $Page->id_kunjungan->headerCellClass() ?>"><span id="elh_l_penunjang_id_kunjungan" class="l_penunjang_id_kunjungan"><?= $Page->id_kunjungan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_penunjang->Visible) { // kode_penunjang ?>
        <th class="<?= $Page->kode_penunjang->headerCellClass() ?>"><span id="elh_l_penunjang_kode_penunjang" class="l_penunjang_kode_penunjang"><?= $Page->kode_penunjang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_penunjang->Visible) { // nama_penunjang ?>
        <th class="<?= $Page->nama_penunjang->headerCellClass() ?>"><span id="elh_l_penunjang_nama_penunjang" class="l_penunjang_nama_penunjang"><?= $Page->nama_penunjang->caption() ?></span></th>
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
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
        <td <?= $Page->id_penunjang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_penunjang_id_penunjang" class="l_penunjang_id_penunjang">
<span<?= $Page->id_penunjang->viewAttributes() ?>>
<?= $Page->id_penunjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
        <td <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_penunjang_id_kunjungan" class="l_penunjang_id_kunjungan">
<span<?= $Page->id_kunjungan->viewAttributes() ?>>
<?= $Page->id_kunjungan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_penunjang->Visible) { // kode_penunjang ?>
        <td <?= $Page->kode_penunjang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_penunjang_kode_penunjang" class="l_penunjang_kode_penunjang">
<span<?= $Page->kode_penunjang->viewAttributes() ?>>
<?= $Page->kode_penunjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_penunjang->Visible) { // nama_penunjang ?>
        <td <?= $Page->nama_penunjang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_penunjang_nama_penunjang" class="l_penunjang_nama_penunjang">
<span<?= $Page->nama_penunjang->viewAttributes() ?>>
<?= $Page->nama_penunjang->getViewValue() ?></span>
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
