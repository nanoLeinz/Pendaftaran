<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MAlatCssdDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_alat_cssddelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fm_alat_cssddelete = currentForm = new ew.Form("fm_alat_cssddelete", "delete");
    loadjs.done("fm_alat_cssddelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.m_alat_cssd) ew.vars.tables.m_alat_cssd = <?= JsonEncode(GetClientVar("tables", "m_alat_cssd")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fm_alat_cssddelete" id="fm_alat_cssddelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_alat_cssd">
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
<?php if ($Page->nama_alat->Visible) { // nama_alat ?>
        <th class="<?= $Page->nama_alat->headerCellClass() ?>"><span id="elh_m_alat_cssd_nama_alat" class="m_alat_cssd_nama_alat"><?= $Page->nama_alat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_set->Visible) { // id_set ?>
        <th class="<?= $Page->id_set->headerCellClass() ?>"><span id="elh_m_alat_cssd_id_set" class="m_alat_cssd_id_set"><?= $Page->id_set->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
        <th class="<?= $Page->keadaan->headerCellClass() ?>"><span id="elh_m_alat_cssd_keadaan" class="m_alat_cssd_keadaan"><?= $Page->keadaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
        <th class="<?= $Page->jumlah->headerCellClass() ?>"><span id="elh_m_alat_cssd_jumlah" class="m_alat_cssd_jumlah"><?= $Page->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($Page->merk->Visible) { // merk ?>
        <th class="<?= $Page->merk->headerCellClass() ?>"><span id="elh_m_alat_cssd_merk" class="m_alat_cssd_merk"><?= $Page->merk->caption() ?></span></th>
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
<?php if ($Page->nama_alat->Visible) { // nama_alat ?>
        <td <?= $Page->nama_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_nama_alat" class="m_alat_cssd_nama_alat">
<span<?= $Page->nama_alat->viewAttributes() ?>>
<?= $Page->nama_alat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_set->Visible) { // id_set ?>
        <td <?= $Page->id_set->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_id_set" class="m_alat_cssd_id_set">
<span<?= $Page->id_set->viewAttributes() ?>>
<?= $Page->id_set->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
        <td <?= $Page->keadaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_keadaan" class="m_alat_cssd_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
        <td <?= $Page->jumlah->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_jumlah" class="m_alat_cssd_jumlah">
<span<?= $Page->jumlah->viewAttributes() ?>>
<?= $Page->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->merk->Visible) { // merk ?>
        <td <?= $Page->merk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_alat_cssd_merk" class="m_alat_cssd_merk">
<span<?= $Page->merk->viewAttributes() ?>>
<?= $Page->merk->getViewValue() ?></span>
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
