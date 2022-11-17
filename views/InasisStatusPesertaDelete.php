<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$InasisStatusPesertaDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fINASIS_STATUS_PESERTAdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fINASIS_STATUS_PESERTAdelete = currentForm = new ew.Form("fINASIS_STATUS_PESERTAdelete", "delete");
    loadjs.done("fINASIS_STATUS_PESERTAdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.INASIS_STATUS_PESERTA) ew.vars.tables.INASIS_STATUS_PESERTA = <?= JsonEncode(GetClientVar("tables", "INASIS_STATUS_PESERTA")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fINASIS_STATUS_PESERTAdelete" id="fINASIS_STATUS_PESERTAdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="INASIS_STATUS_PESERTA">
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
<?php if ($Page->STATUS_PESERTA_KODE->Visible) { // STATUS_PESERTA_KODE ?>
        <th class="<?= $Page->STATUS_PESERTA_KODE->headerCellClass() ?>"><span id="elh_INASIS_STATUS_PESERTA_STATUS_PESERTA_KODE" class="INASIS_STATUS_PESERTA_STATUS_PESERTA_KODE"><?= $Page->STATUS_PESERTA_KODE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->STATUS_PESERTA->Visible) { // STATUS_PESERTA ?>
        <th class="<?= $Page->STATUS_PESERTA->headerCellClass() ?>"><span id="elh_INASIS_STATUS_PESERTA_STATUS_PESERTA" class="INASIS_STATUS_PESERTA_STATUS_PESERTA"><?= $Page->STATUS_PESERTA->caption() ?></span></th>
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
<?php if ($Page->STATUS_PESERTA_KODE->Visible) { // STATUS_PESERTA_KODE ?>
        <td <?= $Page->STATUS_PESERTA_KODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_INASIS_STATUS_PESERTA_STATUS_PESERTA_KODE" class="INASIS_STATUS_PESERTA_STATUS_PESERTA_KODE">
<span<?= $Page->STATUS_PESERTA_KODE->viewAttributes() ?>>
<?= $Page->STATUS_PESERTA_KODE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->STATUS_PESERTA->Visible) { // STATUS_PESERTA ?>
        <td <?= $Page->STATUS_PESERTA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_INASIS_STATUS_PESERTA_STATUS_PESERTA" class="INASIS_STATUS_PESERTA_STATUS_PESERTA">
<span<?= $Page->STATUS_PESERTA->viewAttributes() ?>>
<?= $Page->STATUS_PESERTA->getViewValue() ?></span>
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
