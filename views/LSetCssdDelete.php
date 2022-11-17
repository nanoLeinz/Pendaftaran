<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LSetCssdDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_set_cssddelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fl_set_cssddelete = currentForm = new ew.Form("fl_set_cssddelete", "delete");
    loadjs.done("fl_set_cssddelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.l_set_cssd) ew.vars.tables.l_set_cssd = <?= JsonEncode(GetClientVar("tables", "l_set_cssd")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fl_set_cssddelete" id="fl_set_cssddelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_set_cssd">
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
<?php if ($Page->id_set->Visible) { // id_set ?>
        <th class="<?= $Page->id_set->headerCellClass() ?>"><span id="elh_l_set_cssd_id_set" class="l_set_cssd_id_set"><?= $Page->id_set->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_set_cssd->Visible) { // nama_set_cssd ?>
        <th class="<?= $Page->nama_set_cssd->headerCellClass() ?>"><span id="elh_l_set_cssd_nama_set_cssd" class="l_set_cssd_nama_set_cssd"><?= $Page->nama_set_cssd->caption() ?></span></th>
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
<?php if ($Page->id_set->Visible) { // id_set ?>
        <td <?= $Page->id_set->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_set_cssd_id_set" class="l_set_cssd_id_set">
<span<?= $Page->id_set->viewAttributes() ?>>
<?= $Page->id_set->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_set_cssd->Visible) { // nama_set_cssd ?>
        <td <?= $Page->nama_set_cssd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_l_set_cssd_nama_set_cssd" class="l_set_cssd_nama_set_cssd">
<span<?= $Page->nama_set_cssd->viewAttributes() ?>>
<?= $Page->nama_set_cssd->getViewValue() ?></span>
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
