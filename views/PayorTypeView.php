<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PayorTypeView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPAYOR_TYPEview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fPAYOR_TYPEview = currentForm = new ew.Form("fPAYOR_TYPEview", "view");
    loadjs.done("fPAYOR_TYPEview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.PAYOR_TYPE) ew.vars.tables.PAYOR_TYPE = <?= JsonEncode(GetClientVar("tables", "PAYOR_TYPE")) ?>;
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
<form name="fPAYOR_TYPEview" id="fPAYOR_TYPEview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYOR_TYPE">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
    <tr id="r_PAYOR_TYPE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_TYPE_PAYOR_TYPE"><?= $Page->PAYOR_TYPE->caption() ?></span></td>
        <td data-name="PAYOR_TYPE" <?= $Page->PAYOR_TYPE->cellAttributes() ?>>
<span id="el_PAYOR_TYPE_PAYOR_TYPE">
<span<?= $Page->PAYOR_TYPE->viewAttributes() ?>>
<?= $Page->PAYOR_TYPE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PAYERTYPE->Visible) { // PAYERTYPE ?>
    <tr id="r_PAYERTYPE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PAYOR_TYPE_PAYERTYPE"><?= $Page->PAYERTYPE->caption() ?></span></td>
        <td data-name="PAYERTYPE" <?= $Page->PAYERTYPE->cellAttributes() ?>>
<span id="el_PAYOR_TYPE_PAYERTYPE">
<span<?= $Page->PAYERTYPE->viewAttributes() ?>>
<?= $Page->PAYERTYPE->getViewValue() ?></span>
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
