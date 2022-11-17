<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ClinicView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fCLINICview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fCLINICview = currentForm = new ew.Form("fCLINICview", "view");
    loadjs.done("fCLINICview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.CLINIC) ew.vars.tables.CLINIC = <?= JsonEncode(GetClientVar("tables", "CLINIC")) ?>;
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
<form name="fCLINICview" id="fCLINICview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CLINIC">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <tr id="r_ORG_UNIT_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></td>
        <td data-name="ORG_UNIT_CODE" <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_CLINIC_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <tr id="r_CLINIC_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span></td>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_CLINIC_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAME_OF_CLINIC->Visible) { // NAME_OF_CLINIC ?>
    <tr id="r_NAME_OF_CLINIC">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_NAME_OF_CLINIC"><?= $Page->NAME_OF_CLINIC->caption() ?></span></td>
        <td data-name="NAME_OF_CLINIC" <?= $Page->NAME_OF_CLINIC->cellAttributes() ?>>
<span id="el_CLINIC_NAME_OF_CLINIC">
<span<?= $Page->NAME_OF_CLINIC->viewAttributes() ?>>
<?= $Page->NAME_OF_CLINIC->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
    <tr id="r_ORG_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_ORG_ID"><?= $Page->ORG_ID->caption() ?></span></td>
        <td data-name="ORG_ID" <?= $Page->ORG_ID->cellAttributes() ?>>
<span id="el_CLINIC_ORG_ID">
<span<?= $Page->ORG_ID->viewAttributes() ?>>
<?= $Page->ORG_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->STYPE_ID->Visible) { // STYPE_ID ?>
    <tr id="r_STYPE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_STYPE_ID"><?= $Page->STYPE_ID->caption() ?></span></td>
        <td data-name="STYPE_ID" <?= $Page->STYPE_ID->cellAttributes() ?>>
<span id="el_CLINIC_STYPE_ID">
<span<?= $Page->STYPE_ID->viewAttributes() ?>>
<?= $Page->STYPE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLINIC_TYPE->Visible) { // CLINIC_TYPE ?>
    <tr id="r_CLINIC_TYPE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_CLINIC_TYPE"><?= $Page->CLINIC_TYPE->caption() ?></span></td>
        <td data-name="CLINIC_TYPE" <?= $Page->CLINIC_TYPE->cellAttributes() ?>>
<span id="el_CLINIC_CLINIC_TYPE">
<span<?= $Page->CLINIC_TYPE->viewAttributes() ?>>
<?= $Page->CLINIC_TYPE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
    <tr id="r_OTHER_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_OTHER_ID"><?= $Page->OTHER_ID->caption() ?></span></td>
        <td data-name="OTHER_ID" <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el_CLINIC_OTHER_ID">
<span<?= $Page->OTHER_ID->viewAttributes() ?>>
<?= $Page->OTHER_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ACCOUNT_ID->Visible) { // ACCOUNT_ID ?>
    <tr id="r_ACCOUNT_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_ACCOUNT_ID"><?= $Page->ACCOUNT_ID->caption() ?></span></td>
        <td data-name="ACCOUNT_ID" <?= $Page->ACCOUNT_ID->cellAttributes() ?>>
<span id="el_CLINIC_ACCOUNT_ID">
<span<?= $Page->ACCOUNT_ID->viewAttributes() ?>>
<?= $Page->ACCOUNT_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FA_V->Visible) { // FA_V ?>
    <tr id="r_FA_V">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_FA_V"><?= $Page->FA_V->caption() ?></span></td>
        <td data-name="FA_V" <?= $Page->FA_V->cellAttributes() ?>>
<span id="el_CLINIC_FA_V">
<span<?= $Page->FA_V->viewAttributes() ?>>
<?= $Page->FA_V->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROFIT_ID->Visible) { // PROFIT_ID ?>
    <tr id="r_PROFIT_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_PROFIT_ID"><?= $Page->PROFIT_ID->caption() ?></span></td>
        <td data-name="PROFIT_ID" <?= $Page->PROFIT_ID->cellAttributes() ?>>
<span id="el_CLINIC_PROFIT_ID">
<span<?= $Page->PROFIT_ID->viewAttributes() ?>>
<?= $Page->PROFIT_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SUPPLIED_MM->Visible) { // SUPPLIED_MM ?>
    <tr id="r_SUPPLIED_MM">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_SUPPLIED_MM"><?= $Page->SUPPLIED_MM->caption() ?></span></td>
        <td data-name="SUPPLIED_MM" <?= $Page->SUPPLIED_MM->cellAttributes() ?>>
<span id="el_CLINIC_SUPPLIED_MM">
<span<?= $Page->SUPPLIED_MM->viewAttributes() ?>>
<?= $Page->SUPPLIED_MM->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KDPOLI->Visible) { // KDPOLI ?>
    <tr id="r_KDPOLI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_KDPOLI"><?= $Page->KDPOLI->caption() ?></span></td>
        <td data-name="KDPOLI" <?= $Page->KDPOLI->cellAttributes() ?>>
<span id="el_CLINIC_KDPOLI">
<span<?= $Page->KDPOLI->viewAttributes() ?>>
<?= $Page->KDPOLI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PICTUREFILE->Visible) { // PICTUREFILE ?>
    <tr id="r_PICTUREFILE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_PICTUREFILE"><?= $Page->PICTUREFILE->caption() ?></span></td>
        <td data-name="PICTUREFILE" <?= $Page->PICTUREFILE->cellAttributes() ?>>
<span id="el_CLINIC_PICTUREFILE">
<span<?= $Page->PICTUREFILE->viewAttributes() ?>>
<?= $Page->PICTUREFILE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROFILES->Visible) { // PROFILES ?>
    <tr id="r_PROFILES">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_PROFILES"><?= $Page->PROFILES->caption() ?></span></td>
        <td data-name="PROFILES" <?= $Page->PROFILES->cellAttributes() ?>>
<span id="el_CLINIC_PROFILES">
<span<?= $Page->PROFILES->viewAttributes() ?>>
<?= $Page->PROFILES->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SPESIALISTIK->Visible) { // SPESIALISTIK ?>
    <tr id="r_SPESIALISTIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_CLINIC_SPESIALISTIK"><?= $Page->SPESIALISTIK->caption() ?></span></td>
        <td data-name="SPESIALISTIK" <?= $Page->SPESIALISTIK->cellAttributes() ?>>
<span id="el_CLINIC_SPESIALISTIK">
<span<?= $Page->SPESIALISTIK->viewAttributes() ?>>
<?= $Page->SPESIALISTIK->getViewValue() ?></span>
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
