<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PayorInfoView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPAYOR_INFOview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fPAYOR_INFOview = currentForm = new ew.Form("fPAYOR_INFOview", "view");
    loadjs.done("fPAYOR_INFOview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.PAYOR_INFO) ew.vars.tables.PAYOR_INFO = <?= JsonEncode(GetClientVar("tables", "PAYOR_INFO")) ?>;
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
<form name="fPAYOR_INFOview" id="fPAYOR_INFOview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYOR_INFO">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <tr id="r_ORG_UNIT_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></td>
        <td data-name="ORG_UNIT_CODE" <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_PAYOR_INFO_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <tr id="r_PAYOR_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_PAYOR_ID"><?= $Page->PAYOR_ID->caption() ?></span></td>
        <td data-name="PAYOR_ID" <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el_PAYOR_INFO_PAYOR_ID">
<span<?= $Page->PAYOR_ID->viewAttributes() ?>>
<?= $Page->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
    <tr id="r_PAYOR_TYPE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_PAYOR_TYPE"><?= $Page->PAYOR_TYPE->caption() ?></span></td>
        <td data-name="PAYOR_TYPE" <?= $Page->PAYOR_TYPE->cellAttributes() ?>>
<span id="el_PAYOR_INFO_PAYOR_TYPE">
<span<?= $Page->PAYOR_TYPE->viewAttributes() ?>>
<?= $Page->PAYOR_TYPE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PAYOR->Visible) { // PAYOR ?>
    <tr id="r_PAYOR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_PAYOR"><?= $Page->PAYOR->caption() ?></span></td>
        <td data-name="PAYOR" <?= $Page->PAYOR->cellAttributes() ?>>
<span id="el_PAYOR_INFO_PAYOR">
<span<?= $Page->PAYOR->viewAttributes() ?>>
<?= $Page->PAYOR->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
    <tr id="r_ADDRESS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_ADDRESS"><?= $Page->ADDRESS->caption() ?></span></td>
        <td data-name="ADDRESS" <?= $Page->ADDRESS->cellAttributes() ?>>
<span id="el_PAYOR_INFO_ADDRESS">
<span<?= $Page->ADDRESS->viewAttributes() ?>>
<?= $Page->ADDRESS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CITY->Visible) { // CITY ?>
    <tr id="r_CITY">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_CITY"><?= $Page->CITY->caption() ?></span></td>
        <td data-name="CITY" <?= $Page->CITY->cellAttributes() ?>>
<span id="el_PAYOR_INFO_CITY">
<span<?= $Page->CITY->viewAttributes() ?>>
<?= $Page->CITY->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
    <tr id="r_PHONE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_PHONE"><?= $Page->PHONE->caption() ?></span></td>
        <td data-name="PHONE" <?= $Page->PHONE->cellAttributes() ?>>
<span id="el_PAYOR_INFO_PHONE">
<span<?= $Page->PHONE->viewAttributes() ?>>
<?= $Page->PHONE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
    <tr id="r_FAX">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_FAX"><?= $Page->FAX->caption() ?></span></td>
        <td data-name="FAX" <?= $Page->FAX->cellAttributes() ?>>
<span id="el_PAYOR_INFO_FAX">
<span<?= $Page->FAX->viewAttributes() ?>>
<?= $Page->FAX->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KDVKLAIM->Visible) { // KDVKLAIM ?>
    <tr id="r_KDVKLAIM">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_INFO_KDVKLAIM"><?= $Page->KDVKLAIM->caption() ?></span></td>
        <td data-name="KDVKLAIM" <?= $Page->KDVKLAIM->cellAttributes() ?>>
<span id="el_PAYOR_INFO_KDVKLAIM">
<span<?= $Page->KDVKLAIM->viewAttributes() ?>>
<?= $Page->KDVKLAIM->getViewValue() ?></span>
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
