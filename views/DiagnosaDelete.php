<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$DiagnosaDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fDIAGNOSAdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fDIAGNOSAdelete = currentForm = new ew.Form("fDIAGNOSAdelete", "delete");
    loadjs.done("fDIAGNOSAdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.DIAGNOSA) ew.vars.tables.DIAGNOSA = <?= JsonEncode(GetClientVar("tables", "DIAGNOSA")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fDIAGNOSAdelete" id="fDIAGNOSAdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="DIAGNOSA">
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
<?php if ($Page->DTYPE->Visible) { // DTYPE ?>
        <th class="<?= $Page->DTYPE->headerCellClass() ?>"><span id="elh_DIAGNOSA_DTYPE" class="DIAGNOSA_DTYPE"><?= $Page->DTYPE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <th class="<?= $Page->DIAGNOSA_ID->headerCellClass() ?>"><span id="elh_DIAGNOSA_DIAGNOSA_ID" class="DIAGNOSA_DIAGNOSA_ID"><?= $Page->DIAGNOSA_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAME_OF_DIAGNOSA->Visible) { // NAME_OF_DIAGNOSA ?>
        <th class="<?= $Page->NAME_OF_DIAGNOSA->headerCellClass() ?>"><span id="elh_DIAGNOSA_NAME_OF_DIAGNOSA" class="DIAGNOSA_NAME_OF_DIAGNOSA"><?= $Page->NAME_OF_DIAGNOSA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <th class="<?= $Page->OTHER_ID->headerCellClass() ?>"><span id="elh_DIAGNOSA_OTHER_ID" class="DIAGNOSA_OTHER_ID"><?= $Page->OTHER_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->OTHER_ID2->Visible) { // OTHER_ID2 ?>
        <th class="<?= $Page->OTHER_ID2->headerCellClass() ?>"><span id="elh_DIAGNOSA_OTHER_ID2" class="DIAGNOSA_OTHER_ID2"><?= $Page->OTHER_ID2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ISMENULAR->Visible) { // ISMENULAR ?>
        <th class="<?= $Page->ISMENULAR->headerCellClass() ?>"><span id="elh_DIAGNOSA_ISMENULAR" class="DIAGNOSA_ISMENULAR"><?= $Page->ISMENULAR->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ENGLISH_DIAGNOSA->Visible) { // ENGLISH_DIAGNOSA ?>
        <th class="<?= $Page->ENGLISH_DIAGNOSA->headerCellClass() ?>"><span id="elh_DIAGNOSA_ENGLISH_DIAGNOSA" class="DIAGNOSA_ENGLISH_DIAGNOSA"><?= $Page->ENGLISH_DIAGNOSA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->issurveylans->Visible) { // issurveylans ?>
        <th class="<?= $Page->issurveylans->headerCellClass() ?>"><span id="elh_DIAGNOSA_issurveylans" class="DIAGNOSA_issurveylans"><?= $Page->issurveylans->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kode_bpjs->Visible) { // kode_bpjs ?>
        <th class="<?= $Page->kode_bpjs->headerCellClass() ?>"><span id="elh_DIAGNOSA_kode_bpjs" class="DIAGNOSA_kode_bpjs"><?= $Page->kode_bpjs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->diagnosa_bpjs->Visible) { // diagnosa_bpjs ?>
        <th class="<?= $Page->diagnosa_bpjs->headerCellClass() ?>"><span id="elh_DIAGNOSA_diagnosa_bpjs" class="DIAGNOSA_diagnosa_bpjs"><?= $Page->diagnosa_bpjs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DIAGNOSA_KLINIS->Visible) { // DIAGNOSA_KLINIS ?>
        <th class="<?= $Page->DIAGNOSA_KLINIS->headerCellClass() ?>"><span id="elh_DIAGNOSA_DIAGNOSA_KLINIS" class="DIAGNOSA_DIAGNOSA_KLINIS"><?= $Page->DIAGNOSA_KLINIS->caption() ?></span></th>
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
<?php if ($Page->DTYPE->Visible) { // DTYPE ?>
        <td <?= $Page->DTYPE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_DTYPE" class="DIAGNOSA_DTYPE">
<span<?= $Page->DTYPE->viewAttributes() ?>>
<?= $Page->DTYPE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
        <td <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_DIAGNOSA_ID" class="DIAGNOSA_DIAGNOSA_ID">
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAME_OF_DIAGNOSA->Visible) { // NAME_OF_DIAGNOSA ?>
        <td <?= $Page->NAME_OF_DIAGNOSA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_NAME_OF_DIAGNOSA" class="DIAGNOSA_NAME_OF_DIAGNOSA">
<span<?= $Page->NAME_OF_DIAGNOSA->viewAttributes() ?>>
<?= $Page->NAME_OF_DIAGNOSA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
        <td <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_OTHER_ID" class="DIAGNOSA_OTHER_ID">
<span<?= $Page->OTHER_ID->viewAttributes() ?>>
<?= $Page->OTHER_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->OTHER_ID2->Visible) { // OTHER_ID2 ?>
        <td <?= $Page->OTHER_ID2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_OTHER_ID2" class="DIAGNOSA_OTHER_ID2">
<span<?= $Page->OTHER_ID2->viewAttributes() ?>>
<?= $Page->OTHER_ID2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ISMENULAR->Visible) { // ISMENULAR ?>
        <td <?= $Page->ISMENULAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_ISMENULAR" class="DIAGNOSA_ISMENULAR">
<span<?= $Page->ISMENULAR->viewAttributes() ?>>
<?= $Page->ISMENULAR->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ENGLISH_DIAGNOSA->Visible) { // ENGLISH_DIAGNOSA ?>
        <td <?= $Page->ENGLISH_DIAGNOSA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_ENGLISH_DIAGNOSA" class="DIAGNOSA_ENGLISH_DIAGNOSA">
<span<?= $Page->ENGLISH_DIAGNOSA->viewAttributes() ?>>
<?= $Page->ENGLISH_DIAGNOSA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->issurveylans->Visible) { // issurveylans ?>
        <td <?= $Page->issurveylans->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_issurveylans" class="DIAGNOSA_issurveylans">
<span<?= $Page->issurveylans->viewAttributes() ?>>
<?= $Page->issurveylans->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kode_bpjs->Visible) { // kode_bpjs ?>
        <td <?= $Page->kode_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_kode_bpjs" class="DIAGNOSA_kode_bpjs">
<span<?= $Page->kode_bpjs->viewAttributes() ?>>
<?= $Page->kode_bpjs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->diagnosa_bpjs->Visible) { // diagnosa_bpjs ?>
        <td <?= $Page->diagnosa_bpjs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_diagnosa_bpjs" class="DIAGNOSA_diagnosa_bpjs">
<span<?= $Page->diagnosa_bpjs->viewAttributes() ?>>
<?= $Page->diagnosa_bpjs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DIAGNOSA_KLINIS->Visible) { // DIAGNOSA_KLINIS ?>
        <td <?= $Page->DIAGNOSA_KLINIS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_DIAGNOSA_DIAGNOSA_KLINIS" class="DIAGNOSA_DIAGNOSA_KLINIS">
<span<?= $Page->DIAGNOSA_KLINIS->viewAttributes() ?>>
<?= $Page->DIAGNOSA_KLINIS->getViewValue() ?></span>
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
