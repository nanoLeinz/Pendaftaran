<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LSetCssdView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fl_set_cssdview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fl_set_cssdview = currentForm = new ew.Form("fl_set_cssdview", "view");
    loadjs.done("fl_set_cssdview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.l_set_cssd) ew.vars.tables.l_set_cssd = <?= JsonEncode(GetClientVar("tables", "l_set_cssd")) ?>;
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
<form name="fl_set_cssdview" id="fl_set_cssdview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_set_cssd">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->id_set->Visible) { // id_set ?>
    <tr id="r_id_set">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_set_cssd_id_set"><?= $Page->id_set->caption() ?></span></td>
        <td data-name="id_set" <?= $Page->id_set->cellAttributes() ?>>
<span id="el_l_set_cssd_id_set">
<span<?= $Page->id_set->viewAttributes() ?>>
<?= $Page->id_set->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_set_cssd->Visible) { // nama_set_cssd ?>
    <tr id="r_nama_set_cssd">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_l_set_cssd_nama_set_cssd"><?= $Page->nama_set_cssd->caption() ?></span></td>
        <td data-name="nama_set_cssd" <?= $Page->nama_set_cssd->cellAttributes() ?>>
<span id="el_l_set_cssd_nama_set_cssd">
<span<?= $Page->nama_set_cssd->viewAttributes() ?>>
<?= $Page->nama_set_cssd->getViewValue() ?></span>
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
