<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PaymentMethodView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPAYMENT_METHODview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fPAYMENT_METHODview = currentForm = new ew.Form("fPAYMENT_METHODview", "view");
    loadjs.done("fPAYMENT_METHODview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.PAYMENT_METHOD) ew.vars.tables.PAYMENT_METHOD = <?= JsonEncode(GetClientVar("tables", "PAYMENT_METHOD")) ?>;
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
<form name="fPAYMENT_METHODview" id="fPAYMENT_METHODview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYMENT_METHOD">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->PAY_METHOD_ID->Visible) { // PAY_METHOD_ID ?>
    <tr id="r_PAY_METHOD_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYMENT_METHOD_PAY_METHOD_ID"><?= $Page->PAY_METHOD_ID->caption() ?></span></td>
        <td data-name="PAY_METHOD_ID" <?= $Page->PAY_METHOD_ID->cellAttributes() ?>>
<span id="el_PAYMENT_METHOD_PAY_METHOD_ID">
<span<?= $Page->PAY_METHOD_ID->viewAttributes() ?>>
<?= $Page->PAY_METHOD_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PAYMETHOD->Visible) { // PAYMETHOD ?>
    <tr id="r_PAYMETHOD">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYMENT_METHOD_PAYMETHOD"><?= $Page->PAYMETHOD->caption() ?></span></td>
        <td data-name="PAYMETHOD" <?= $Page->PAYMETHOD->cellAttributes() ?>>
<span id="el_PAYMENT_METHOD_PAYMETHOD">
<span<?= $Page->PAYMETHOD->viewAttributes() ?>>
<?= $Page->PAYMETHOD->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->display->Visible) { // display ?>
    <tr id="r_display">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYMENT_METHOD_display"><?= $Page->display->caption() ?></span></td>
        <td data-name="display" <?= $Page->display->cellAttributes() ?>>
<span id="el_PAYMENT_METHOD_display">
<span<?= $Page->display->viewAttributes() ?>>
<?= $Page->display->getViewValue() ?></span>
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
