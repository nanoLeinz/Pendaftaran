<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$SexView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fSEXview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fSEXview = currentForm = new ew.Form("fSEXview", "view");
    loadjs.done("fSEXview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.SEX) ew.vars.tables.SEX = <?= JsonEncode(GetClientVar("tables", "SEX")) ?>;
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
<form name="fSEXview" id="fSEXview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="SEX">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <tr id="r_GENDER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_SEX_GENDER"><?= $Page->GENDER->caption() ?></span></td>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_SEX_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAME_OF_GENDER->Visible) { // NAME_OF_GENDER ?>
    <tr id="r_NAME_OF_GENDER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_SEX_NAME_OF_GENDER"><?= $Page->NAME_OF_GENDER->caption() ?></span></td>
        <td data-name="NAME_OF_GENDER" <?= $Page->NAME_OF_GENDER->cellAttributes() ?>>
<span id="el_SEX_NAME_OF_GENDER">
<span<?= $Page->NAME_OF_GENDER->viewAttributes() ?>>
<?= $Page->NAME_OF_GENDER->getViewValue() ?></span>
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
