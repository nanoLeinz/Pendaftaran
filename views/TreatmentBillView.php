<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatmentBillView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fTREATMENT_BILLview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fTREATMENT_BILLview = currentForm = new ew.Form("fTREATMENT_BILLview", "view");
    loadjs.done("fTREATMENT_BILLview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.TREATMENT_BILL) ew.vars.tables.TREATMENT_BILL = <?= JsonEncode(GetClientVar("tables", "TREATMENT_BILL")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fTREATMENT_BILLview" id="fTREATMENT_BILLview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREATMENT_BILL">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
    <tr id="r_TARIF_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_BILL_TARIF_ID"><?= $Page->TARIF_ID->caption() ?></span></td>
        <td data-name="TARIF_ID" <?= $Page->TARIF_ID->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_TARIF_ID">
<span<?= $Page->TARIF_ID->viewAttributes() ?>>
<?= $Page->TARIF_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <tr id="r_CLINIC_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_BILL_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span></td>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { // TREATMENT ?>
    <tr id="r_TREATMENT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_BILL_TREATMENT"><?= $Page->TREATMENT->caption() ?></span></td>
        <td data-name="TREATMENT" <?= $Page->TREATMENT->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_TREATMENT">
<span<?= $Page->TREATMENT->viewAttributes() ?>>
<?= $Page->TREATMENT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->QUANTITY->Visible) { // QUANTITY ?>
    <tr id="r_QUANTITY">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_BILL_QUANTITY"><?= $Page->QUANTITY->caption() ?></span></td>
        <td data-name="QUANTITY" <?= $Page->QUANTITY->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_QUANTITY">
<span<?= $Page->QUANTITY->viewAttributes() ?>>
<?= $Page->QUANTITY->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("TREATMENT_AKOMODASI", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_AKOMODASI->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("TREATMENT_AKOMODASI", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "TreatmentAkomodasiGrid.php" ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
