<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$InasisKelasrawatView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fINASIS_KELASRAWATview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fINASIS_KELASRAWATview = currentForm = new ew.Form("fINASIS_KELASRAWATview", "view");
    loadjs.done("fINASIS_KELASRAWATview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.INASIS_KELASRAWAT) ew.vars.tables.INASIS_KELASRAWAT = <?= JsonEncode(GetClientVar("tables", "INASIS_KELASRAWAT")) ?>;
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
<form name="fINASIS_KELASRAWATview" id="fINASIS_KELASRAWATview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="INASIS_KELASRAWAT">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->KDKELAS->Visible) { // KDKELAS ?>
    <tr id="r_KDKELAS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_INASIS_KELASRAWAT_KDKELAS"><?= $Page->KDKELAS->caption() ?></span></td>
        <td data-name="KDKELAS" <?= $Page->KDKELAS->cellAttributes() ?>>
<span id="el_INASIS_KELASRAWAT_KDKELAS">
<span<?= $Page->KDKELAS->viewAttributes() ?>>
<?= $Page->KDKELAS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NMKELAS->Visible) { // NMKELAS ?>
    <tr id="r_NMKELAS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_INASIS_KELASRAWAT_NMKELAS"><?= $Page->NMKELAS->caption() ?></span></td>
        <td data-name="NMKELAS" <?= $Page->NMKELAS->cellAttributes() ?>>
<span id="el_INASIS_KELASRAWAT_NMKELAS">
<span<?= $Page->NMKELAS->viewAttributes() ?>>
<?= $Page->NMKELAS->getViewValue() ?></span>
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
