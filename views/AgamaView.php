<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AgamaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fAGAMAview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fAGAMAview = currentForm = new ew.Form("fAGAMAview", "view");
    loadjs.done("fAGAMAview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.AGAMA) ew.vars.tables.AGAMA = <?= JsonEncode(GetClientVar("tables", "AGAMA")) ?>;
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
<form name="fAGAMAview" id="fAGAMAview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="AGAMA">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <tr id="r_KODE_AGAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_AGAMA_KODE_AGAMA"><?= $Page->KODE_AGAMA->caption() ?></span></td>
        <td data-name="KODE_AGAMA" <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el_AGAMA_KODE_AGAMA">
<span<?= $Page->KODE_AGAMA->viewAttributes() ?>>
<?= $Page->KODE_AGAMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAMA_AGAMA->Visible) { // NAMA_AGAMA ?>
    <tr id="r_NAMA_AGAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_AGAMA_NAMA_AGAMA"><?= $Page->NAMA_AGAMA->caption() ?></span></td>
        <td data-name="NAMA_AGAMA" <?= $Page->NAMA_AGAMA->cellAttributes() ?>>
<span id="el_AGAMA_NAMA_AGAMA">
<span<?= $Page->NAMA_AGAMA->viewAttributes() ?>>
<?= $Page->NAMA_AGAMA->getViewValue() ?></span>
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
