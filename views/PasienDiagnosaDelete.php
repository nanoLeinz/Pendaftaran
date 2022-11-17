<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienDiagnosaDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPASIEN_DIAGNOSAdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fPASIEN_DIAGNOSAdelete = currentForm = new ew.Form("fPASIEN_DIAGNOSAdelete", "delete");
    loadjs.done("fPASIEN_DIAGNOSAdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.PASIEN_DIAGNOSA) ew.vars.tables.PASIEN_DIAGNOSA = <?= JsonEncode(GetClientVar("tables", "PASIEN_DIAGNOSA")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fPASIEN_DIAGNOSAdelete" id="fPASIEN_DIAGNOSAdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN_DIAGNOSA">
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
<?php if ($Page->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
        <th class="<?= $Page->DATE_OF_DIAGNOSA->headerCellClass() ?>"><span id="elh_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" class="PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA"><?= $Page->DATE_OF_DIAGNOSA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <th class="<?= $Page->DIAGNOSA_ID->headerCellClass() ?>"><span id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="PASIEN_DIAGNOSA_DIAGNOSA_ID"><?= $Page->DIAGNOSA_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ANAMNASE->Visible) { // ANAMNASE ?>
        <th class="<?= $Page->ANAMNASE->headerCellClass() ?>"><span id="elh_PASIEN_DIAGNOSA_ANAMNASE" class="PASIEN_DIAGNOSA_ANAMNASE"><?= $Page->ANAMNASE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
        <th class="<?= $Page->PEMERIKSAAN->headerCellClass() ?>"><span id="elh_PASIEN_DIAGNOSA_PEMERIKSAAN" class="PASIEN_DIAGNOSA_PEMERIKSAAN"><?= $Page->PEMERIKSAAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
        <th class="<?= $Page->TERAPHY_DESC->headerCellClass() ?>"><span id="elh_PASIEN_DIAGNOSA_TERAPHY_DESC" class="PASIEN_DIAGNOSA_TERAPHY_DESC"><?= $Page->TERAPHY_DESC->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TGLKONTROL->Visible) { // TGLKONTROL ?>
        <th class="<?= $Page->TGLKONTROL->headerCellClass() ?>"><span id="elh_PASIEN_DIAGNOSA_TGLKONTROL" class="PASIEN_DIAGNOSA_TGLKONTROL"><?= $Page->TGLKONTROL->caption() ?></span></th>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
        <th class="<?= $Page->IDXDAFTAR->headerCellClass() ?>"><span id="elh_PASIEN_DIAGNOSA_IDXDAFTAR" class="PASIEN_DIAGNOSA_IDXDAFTAR"><?= $Page->IDXDAFTAR->caption() ?></span></th>
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
<?php if ($Page->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
        <td <?= $Page->DATE_OF_DIAGNOSA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" class="PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA">
<span<?= $Page->DATE_OF_DIAGNOSA->viewAttributes() ?>>
<?= $Page->DATE_OF_DIAGNOSA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <td <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_DIAGNOSA_ID" class="PASIEN_DIAGNOSA_DIAGNOSA_ID">
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ANAMNASE->Visible) { // ANAMNASE ?>
        <td <?= $Page->ANAMNASE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_ANAMNASE" class="PASIEN_DIAGNOSA_ANAMNASE">
<span<?= $Page->ANAMNASE->viewAttributes() ?>>
<?= $Page->ANAMNASE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
        <td <?= $Page->PEMERIKSAAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_PEMERIKSAAN" class="PASIEN_DIAGNOSA_PEMERIKSAAN">
<span<?= $Page->PEMERIKSAAN->viewAttributes() ?>>
<?= $Page->PEMERIKSAAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
        <td <?= $Page->TERAPHY_DESC->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_TERAPHY_DESC" class="PASIEN_DIAGNOSA_TERAPHY_DESC">
<span<?= $Page->TERAPHY_DESC->viewAttributes() ?>>
<?= $Page->TERAPHY_DESC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TGLKONTROL->Visible) { // TGLKONTROL ?>
        <td <?= $Page->TGLKONTROL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_TGLKONTROL" class="PASIEN_DIAGNOSA_TGLKONTROL">
<span<?= $Page->TGLKONTROL->viewAttributes() ?>>
<?= $Page->TGLKONTROL->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
        <td <?= $Page->IDXDAFTAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_PASIEN_DIAGNOSA_IDXDAFTAR" class="PASIEN_DIAGNOSA_IDXDAFTAR">
<span<?= $Page->IDXDAFTAR->viewAttributes() ?>>
<?= $Page->IDXDAFTAR->getViewValue() ?></span>
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
