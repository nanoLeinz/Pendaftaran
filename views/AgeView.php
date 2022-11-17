<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AgeView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fAGEview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fAGEview = currentForm = new ew.Form("fAGEview", "view");
    loadjs.done("fAGEview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.AGE) ew.vars.tables.AGE = <?= JsonEncode(GetClientVar("tables", "AGE")) ?>;
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
<form name="fAGEview" id="fAGEview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="AGE">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->CAT->Visible) { // CAT ?>
    <tr id="r_CAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_AGE_CAT"><?= $Page->CAT->caption() ?></span></td>
        <td data-name="CAT" <?= $Page->CAT->cellAttributes() ?>>
<span id="el_AGE_CAT">
<span<?= $Page->CAT->viewAttributes() ?>>
<?= $Page->CAT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->GROUP_ID->Visible) { // GROUP_ID ?>
    <tr id="r_GROUP_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_AGE_GROUP_ID"><?= $Page->GROUP_ID->caption() ?></span></td>
        <td data-name="GROUP_ID" <?= $Page->GROUP_ID->cellAttributes() ?>>
<span id="el_AGE_GROUP_ID">
<span<?= $Page->GROUP_ID->viewAttributes() ?>>
<?= $Page->GROUP_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BAT_BAWAH->Visible) { // BAT_BAWAH ?>
    <tr id="r_BAT_BAWAH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_AGE_BAT_BAWAH"><?= $Page->BAT_BAWAH->caption() ?></span></td>
        <td data-name="BAT_BAWAH" <?= $Page->BAT_BAWAH->cellAttributes() ?>>
<span id="el_AGE_BAT_BAWAH">
<span<?= $Page->BAT_BAWAH->viewAttributes() ?>>
<?= $Page->BAT_BAWAH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BAT_ATAS->Visible) { // BAT_ATAS ?>
    <tr id="r_BAT_ATAS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_AGE_BAT_ATAS"><?= $Page->BAT_ATAS->caption() ?></span></td>
        <td data-name="BAT_ATAS" <?= $Page->BAT_ATAS->cellAttributes() ?>>
<span id="el_AGE_BAT_ATAS">
<span<?= $Page->BAT_ATAS->viewAttributes() ?>>
<?= $Page->BAT_ATAS->getViewValue() ?></span>
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
