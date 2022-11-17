<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatmentAkomodasiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fTREATMENT_AKOMODASIview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fTREATMENT_AKOMODASIview = currentForm = new ew.Form("fTREATMENT_AKOMODASIview", "view");
    loadjs.done("fTREATMENT_AKOMODASIview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.TREATMENT_AKOMODASI) ew.vars.tables.TREATMENT_AKOMODASI = <?= JsonEncode(GetClientVar("tables", "TREATMENT_AKOMODASI")) ?>;
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
<form name="fTREATMENT_AKOMODASIview" id="fTREATMENT_AKOMODASIview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREATMENT_AKOMODASI">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <tr id="r_CLINIC_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span></td>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { // TREATMENT ?>
    <tr id="r_TREATMENT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_TREATMENT"><?= $Page->TREATMENT->caption() ?></span></td>
        <td data-name="TREATMENT" <?= $Page->TREATMENT->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_TREATMENT">
<span<?= $Page->TREATMENT->viewAttributes() ?>>
<?= $Page->TREATMENT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TREAT_DATE->Visible) { // TREAT_DATE ?>
    <tr id="r_TREAT_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_TREAT_DATE"><?= $Page->TREAT_DATE->caption() ?></span></td>
        <td data-name="TREAT_DATE" <?= $Page->TREAT_DATE->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_TREAT_DATE">
<span<?= $Page->TREAT_DATE->viewAttributes() ?>>
<?= $Page->TREAT_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <tr id="r_DESCRIPTION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_DESCRIPTION"><?= $Page->DESCRIPTION->caption() ?></span></td>
        <td data-name="DESCRIPTION" <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_DESCRIPTION">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
    <tr id="r_CLASS_ROOM_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_CLASS_ROOM_ID"><?= $Page->CLASS_ROOM_ID->caption() ?></span></td>
        <td data-name="CLASS_ROOM_ID" <?= $Page->CLASS_ROOM_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_CLASS_ROOM_ID">
<span<?= $Page->CLASS_ROOM_ID->viewAttributes() ?>>
<?= $Page->CLASS_ROOM_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { // KELUAR_ID ?>
    <tr id="r_KELUAR_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_KELUAR_ID"><?= $Page->KELUAR_ID->caption() ?></span></td>
        <td data-name="KELUAR_ID" <?= $Page->KELUAR_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_KELUAR_ID">
<span<?= $Page->KELUAR_ID->viewAttributes() ?>>
<?= $Page->KELUAR_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BED_ID->Visible) { // BED_ID ?>
    <tr id="r_BED_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_BED_ID"><?= $Page->BED_ID->caption() ?></span></td>
        <td data-name="BED_ID" <?= $Page->BED_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_BED_ID">
<span<?= $Page->BED_ID->viewAttributes() ?>>
<?= $Page->BED_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <tr id="r_EMPLOYEE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_EMPLOYEE_ID"><?= $Page->EMPLOYEE_ID->caption() ?></span></td>
        <td data-name="EMPLOYEE_ID" <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_EMPLOYEE_ID">
<span<?= $Page->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Page->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_SURAT_KET->Visible) { // NO_SURAT_KET ?>
    <tr id="r_NO_SURAT_KET">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_NO_SURAT_KET"><?= $Page->NO_SURAT_KET->caption() ?></span></td>
        <td data-name="NO_SURAT_KET" <?= $Page->NO_SURAT_KET->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_NO_SURAT_KET">
<span<?= $Page->NO_SURAT_KET->viewAttributes() ?>>
<?= $Page->NO_SURAT_KET->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
    <tr id="r_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_TREATMENT_AKOMODASI_ID"><?= $Page->ID->caption() ?></span></td>
        <td data-name="ID" <?= $Page->ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_ID">
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
