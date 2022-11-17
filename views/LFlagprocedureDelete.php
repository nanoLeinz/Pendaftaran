<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LFlagprocedureDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_flagproceduredelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fl_flagproceduredelete = currentForm = new ew.Form("fl_flagproceduredelete", "delete");
    loadjs.done("fl_flagproceduredelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.l_flagprocedure) ew.vars.tables.l_flagprocedure = <?= JsonEncode(GetClientVar("tables", "l_flagprocedure")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fl_flagproceduredelete" id="fl_flagproceduredelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_flagprocedure">
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
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
        <th class="<?= $Page->id_procedure->headerCellClass() ?>"><span id="elh_l_flagprocedure_id_procedure" class="l_flagprocedure_id_procedure"><?= $Page->id_procedure->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
        <th class="<?= $Page->id_kunjungan->headerCellClass() ?>"><span id="elh_l_flagprocedure_id_kunjungan" class="l_flagprocedure_id_kunjungan"><?= $Page->id_kunjungan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_procedure->Visible) { // kode_procedure ?>
        <th class="<?= $Page->kode_procedure->headerCellClass() ?>"><span id="elh_l_flagprocedure_kode_procedure" class="l_flagprocedure_kode_procedure"><?= $Page->kode_procedure->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_procedure->Visible) { // nama_procedure ?>
        <th class="<?= $Page->nama_procedure->headerCellClass() ?>"><span id="elh_l_flagprocedure_nama_procedure" class="l_flagprocedure_nama_procedure"><?= $Page->nama_procedure->caption() ?></span></th>
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
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
        <td <?= $Page->id_procedure->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_flagprocedure_id_procedure" class="l_flagprocedure_id_procedure">
<span<?= $Page->id_procedure->viewAttributes() ?>>
<?= $Page->id_procedure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
        <td <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_flagprocedure_id_kunjungan" class="l_flagprocedure_id_kunjungan">
<span<?= $Page->id_kunjungan->viewAttributes() ?>>
<?= $Page->id_kunjungan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_procedure->Visible) { // kode_procedure ?>
        <td <?= $Page->kode_procedure->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_flagprocedure_kode_procedure" class="l_flagprocedure_kode_procedure">
<span<?= $Page->kode_procedure->viewAttributes() ?>>
<?= $Page->kode_procedure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_procedure->Visible) { // nama_procedure ?>
        <td <?= $Page->nama_procedure->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_flagprocedure_nama_procedure" class="l_flagprocedure_nama_procedure">
<span<?= $Page->nama_procedure->viewAttributes() ?>>
<?= $Page->nama_procedure->getViewValue() ?></span>
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
