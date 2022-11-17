<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatmentObatView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fTREATMENT_OBATview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fTREATMENT_OBATview = currentForm = new ew.Form("fTREATMENT_OBATview", "view");
    loadjs.done("fTREATMENT_OBATview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.TREATMENT_OBAT) ew.vars.tables.TREATMENT_OBAT = <?= JsonEncode(GetClientVar("tables", "TREATMENT_OBAT")) ?>;
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
<form name="fTREATMENT_OBATview" id="fTREATMENT_OBATview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREATMENT_OBAT">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <tr id="r_NO_REGISTRATION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></td>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->RESEP_NO->Visible) { // RESEP_NO ?>
    <tr id="r_RESEP_NO">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_RESEP_NO"><?= $Page->RESEP_NO->caption() ?></span></td>
        <td data-name="RESEP_NO" <?= $Page->RESEP_NO->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_RESEP_NO">
<span<?= $Page->RESEP_NO->viewAttributes() ?>>
<?= $Page->RESEP_NO->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
    <tr id="r_TARIF_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_TARIF_ID"><?= $Page->TARIF_ID->caption() ?></span></td>
        <td data-name="TARIF_ID" <?= $Page->TARIF_ID->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_TARIF_ID">
<span<?= $Page->TARIF_ID->viewAttributes() ?>>
<?= $Page->TARIF_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { // TREATMENT ?>
    <tr id="r_TREATMENT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_TREATMENT"><?= $Page->TREATMENT->caption() ?></span></td>
        <td data-name="TREATMENT" <?= $Page->TREATMENT->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_TREATMENT">
<span<?= $Page->TREATMENT->viewAttributes() ?>>
<?= $Page->TREATMENT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TREAT_DATE->Visible) { // TREAT_DATE ?>
    <tr id="r_TREAT_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_TREAT_DATE"><?= $Page->TREAT_DATE->caption() ?></span></td>
        <td data-name="TREAT_DATE" <?= $Page->TREAT_DATE->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_TREAT_DATE">
<span<?= $Page->TREAT_DATE->viewAttributes() ?>>
<?= $Page->TREAT_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MEASURE_ID->Visible) { // MEASURE_ID ?>
    <tr id="r_MEASURE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_MEASURE_ID"><?= $Page->MEASURE_ID->caption() ?></span></td>
        <td data-name="MEASURE_ID" <?= $Page->MEASURE_ID->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_MEASURE_ID">
<span<?= $Page->MEASURE_ID->viewAttributes() ?>>
<?= $Page->MEASURE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <tr id="r_DESCRIPTION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_DESCRIPTION"><?= $Page->DESCRIPTION->caption() ?></span></td>
        <td data-name="DESCRIPTION" <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_DESCRIPTION">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DOSE_PRESC->Visible) { // DOSE_PRESC ?>
    <tr id="r_DOSE_PRESC">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_DOSE_PRESC"><?= $Page->DOSE_PRESC->caption() ?></span></td>
        <td data-name="DOSE_PRESC" <?= $Page->DOSE_PRESC->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_DOSE_PRESC">
<span<?= $Page->DOSE_PRESC->viewAttributes() ?>>
<?= $Page->DOSE_PRESC->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->RACIKAN->Visible) { // RACIKAN ?>
    <tr id="r_RACIKAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_RACIKAN"><?= $Page->RACIKAN->caption() ?></span></td>
        <td data-name="RACIKAN" <?= $Page->RACIKAN->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_RACIKAN">
<span<?= $Page->RACIKAN->viewAttributes() ?>>
<?= $Page->RACIKAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BRAND_ID->Visible) { // BRAND_ID ?>
    <tr id="r_BRAND_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_BRAND_ID"><?= $Page->BRAND_ID->caption() ?></span></td>
        <td data-name="BRAND_ID" <?= $Page->BRAND_ID->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_BRAND_ID">
<span<?= $Page->BRAND_ID->viewAttributes() ?>>
<?= $Page->BRAND_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
    <tr id="r_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_OBAT_ID"><?= $Page->ID->caption() ?></span></td>
        <td data-name="ID" <?= $Page->ID->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
