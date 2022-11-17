<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$FamilyStatusView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fFAMILY_STATUSview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fFAMILY_STATUSview = currentForm = new ew.Form("fFAMILY_STATUSview", "view");
    loadjs.done("fFAMILY_STATUSview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.FAMILY_STATUS) ew.vars.tables.FAMILY_STATUS = <?= JsonEncode(GetClientVar("tables", "FAMILY_STATUS")) ?>;
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
<form name="fFAMILY_STATUSview" id="fFAMILY_STATUSview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="FAMILY_STATUS">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
    <tr id="r_FAMILY_STATUS_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_STATUS_FAMILY_STATUS_ID"><?= $Page->FAMILY_STATUS_ID->caption() ?></span></td>
        <td data-name="FAMILY_STATUS_ID" <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el_FAMILY_STATUS_FAMILY_STATUS_ID">
<span<?= $Page->FAMILY_STATUS_ID->viewAttributes() ?>>
<?= $Page->FAMILY_STATUS_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FAMILY_STATUS->Visible) { // FAMILY_STATUS ?>
    <tr id="r_FAMILY_STATUS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_STATUS_FAMILY_STATUS"><?= $Page->FAMILY_STATUS->caption() ?></span></td>
        <td data-name="FAMILY_STATUS" <?= $Page->FAMILY_STATUS->cellAttributes() ?>>
<span id="el_FAMILY_STATUS_FAMILY_STATUS">
<span<?= $Page->FAMILY_STATUS->viewAttributes() ?>>
<?= $Page->FAMILY_STATUS->getViewValue() ?></span>
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
