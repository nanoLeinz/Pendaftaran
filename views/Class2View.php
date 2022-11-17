<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$Class2View = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fCLASS2view;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fCLASS2view = currentForm = new ew.Form("fCLASS2view", "view");
    loadjs.done("fCLASS2view");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.CLASS2) ew.vars.tables.CLASS2 = <?= JsonEncode(GetClientVar("tables", "CLASS2")) ?>;
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
<form name="fCLASS2view" id="fCLASS2view" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CLASS2">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <tr id="r_CLASS_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLASS2_CLASS_ID"><?= $Page->CLASS_ID->caption() ?></span></td>
        <td data-name="CLASS_ID" <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_CLASS2_CLASS_ID">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAME_OF_CLASS->Visible) { // NAME_OF_CLASS ?>
    <tr id="r_NAME_OF_CLASS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLASS2_NAME_OF_CLASS"><?= $Page->NAME_OF_CLASS->caption() ?></span></td>
        <td data-name="NAME_OF_CLASS" <?= $Page->NAME_OF_CLASS->cellAttributes() ?>>
<span id="el_CLASS2_NAME_OF_CLASS">
<span<?= $Page->NAME_OF_CLASS->viewAttributes() ?>>
<?= $Page->NAME_OF_CLASS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
    <tr id="r_OTHER_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLASS2_OTHER_ID"><?= $Page->OTHER_ID->caption() ?></span></td>
        <td data-name="OTHER_ID" <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el_CLASS2_OTHER_ID">
<span<?= $Page->OTHER_ID->viewAttributes() ?>>
<?= $Page->OTHER_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KDKELASV->Visible) { // KDKELASV ?>
    <tr id="r_KDKELASV">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLASS2_KDKELASV"><?= $Page->KDKELASV->caption() ?></span></td>
        <td data-name="KDKELASV" <?= $Page->KDKELASV->cellAttributes() ?>>
<span id="el_CLASS2_KDKELASV">
<span<?= $Page->KDKELASV->viewAttributes() ?>>
<?= $Page->KDKELASV->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KODEKELAS->Visible) { // KODEKELAS ?>
    <tr id="r_KODEKELAS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLASS2_KODEKELAS"><?= $Page->KODEKELAS->caption() ?></span></td>
        <td data-name="KODEKELAS" <?= $Page->KODEKELAS->cellAttributes() ?>>
<span id="el_CLASS2_KODEKELAS">
<span<?= $Page->KODEKELAS->viewAttributes() ?>>
<?= $Page->KODEKELAS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SISKODEKELAS->Visible) { // SISKODEKELAS ?>
    <tr id="r_SISKODEKELAS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLASS2_SISKODEKELAS"><?= $Page->SISKODEKELAS->caption() ?></span></td>
        <td data-name="SISKODEKELAS" <?= $Page->SISKODEKELAS->cellAttributes() ?>>
<span id="el_CLASS2_SISKODEKELAS">
<span<?= $Page->SISKODEKELAS->viewAttributes() ?>>
<?= $Page->SISKODEKELAS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SISKODERAWAT->Visible) { // SISKODERAWAT ?>
    <tr id="r_SISKODERAWAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLASS2_SISKODERAWAT"><?= $Page->SISKODERAWAT->caption() ?></span></td>
        <td data-name="SISKODERAWAT" <?= $Page->SISKODERAWAT->cellAttributes() ?>>
<span id="el_CLASS2_SISKODERAWAT">
<span<?= $Page->SISKODERAWAT->viewAttributes() ?>>
<?= $Page->SISKODERAWAT->getViewValue() ?></span>
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
