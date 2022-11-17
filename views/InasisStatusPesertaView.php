<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$InasisStatusPesertaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fINASIS_STATUS_PESERTAview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fINASIS_STATUS_PESERTAview = currentForm = new ew.Form("fINASIS_STATUS_PESERTAview", "view");
    loadjs.done("fINASIS_STATUS_PESERTAview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.INASIS_STATUS_PESERTA) ew.vars.tables.INASIS_STATUS_PESERTA = <?= JsonEncode(GetClientVar("tables", "INASIS_STATUS_PESERTA")) ?>;
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
<form name="fINASIS_STATUS_PESERTAview" id="fINASIS_STATUS_PESERTAview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="INASIS_STATUS_PESERTA">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->STATUS_PESERTA_KODE->Visible) { // STATUS_PESERTA_KODE ?>
    <tr id="r_STATUS_PESERTA_KODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_INASIS_STATUS_PESERTA_STATUS_PESERTA_KODE"><?= $Page->STATUS_PESERTA_KODE->caption() ?></span></td>
        <td data-name="STATUS_PESERTA_KODE" <?= $Page->STATUS_PESERTA_KODE->cellAttributes() ?>>
<span id="el_INASIS_STATUS_PESERTA_STATUS_PESERTA_KODE">
<span<?= $Page->STATUS_PESERTA_KODE->viewAttributes() ?>>
<?= $Page->STATUS_PESERTA_KODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->STATUS_PESERTA->Visible) { // STATUS_PESERTA ?>
    <tr id="r_STATUS_PESERTA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_INASIS_STATUS_PESERTA_STATUS_PESERTA"><?= $Page->STATUS_PESERTA->caption() ?></span></td>
        <td data-name="STATUS_PESERTA" <?= $Page->STATUS_PESERTA->cellAttributes() ?>>
<span id="el_INASIS_STATUS_PESERTA_STATUS_PESERTA">
<span<?= $Page->STATUS_PESERTA->viewAttributes() ?>>
<?= $Page->STATUS_PESERTA->getViewValue() ?></span>
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
