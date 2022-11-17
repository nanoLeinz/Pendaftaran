<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LPembiayaanDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_pembiayaandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fl_pembiayaandelete = currentForm = new ew.Form("fl_pembiayaandelete", "delete");
    loadjs.done("fl_pembiayaandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.l_pembiayaan) ew.vars.tables.l_pembiayaan = <?= JsonEncode(GetClientVar("tables", "l_pembiayaan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fl_pembiayaandelete" id="fl_pembiayaandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_pembiayaan">
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
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <th class="<?= $Page->id_pembiayaan->headerCellClass() ?>"><span id="elh_l_pembiayaan_id_pembiayaan" class="l_pembiayaan_id_pembiayaan"><?= $Page->id_pembiayaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_biaya->Visible) { // kode_biaya ?>
        <th class="<?= $Page->kode_biaya->headerCellClass() ?>"><span id="elh_l_pembiayaan_kode_biaya" class="l_pembiayaan_kode_biaya"><?= $Page->kode_biaya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_biaya->Visible) { // nama_biaya ?>
        <th class="<?= $Page->nama_biaya->headerCellClass() ?>"><span id="elh_l_pembiayaan_nama_biaya" class="l_pembiayaan_nama_biaya"><?= $Page->nama_biaya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_kelas->Visible) { // kode_kelas ?>
        <th class="<?= $Page->kode_kelas->headerCellClass() ?>"><span id="elh_l_pembiayaan_kode_kelas" class="l_pembiayaan_kode_kelas"><?= $Page->kode_kelas->caption() ?></span></th>
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
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <td <?= $Page->id_pembiayaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_pembiayaan_id_pembiayaan" class="l_pembiayaan_id_pembiayaan">
<span<?= $Page->id_pembiayaan->viewAttributes() ?>>
<?= $Page->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_biaya->Visible) { // kode_biaya ?>
        <td <?= $Page->kode_biaya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_pembiayaan_kode_biaya" class="l_pembiayaan_kode_biaya">
<span<?= $Page->kode_biaya->viewAttributes() ?>>
<?= $Page->kode_biaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_biaya->Visible) { // nama_biaya ?>
        <td <?= $Page->nama_biaya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_pembiayaan_nama_biaya" class="l_pembiayaan_nama_biaya">
<span<?= $Page->nama_biaya->viewAttributes() ?>>
<?= $Page->nama_biaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_kelas->Visible) { // kode_kelas ?>
        <td <?= $Page->kode_kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_pembiayaan_kode_kelas" class="l_pembiayaan_kode_kelas">
<span<?= $Page->kode_kelas->viewAttributes() ?>>
<?= $Page->kode_kelas->getViewValue() ?></span>
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
