<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$InasisJenisPesertaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fINASIS_JENIS_PESERTAview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fINASIS_JENIS_PESERTAview = currentForm = new ew.Form("fINASIS_JENIS_PESERTAview", "view");
    loadjs.done("fINASIS_JENIS_PESERTAview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.INASIS_JENIS_PESERTA) ew.vars.tables.INASIS_JENIS_PESERTA = <?= JsonEncode(GetClientVar("tables", "INASIS_JENIS_PESERTA")) ?>;
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
<form name="fINASIS_JENIS_PESERTAview" id="fINASIS_JENIS_PESERTAview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="INASIS_JENIS_PESERTA">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->KDJNSPESERTA->Visible) { // KDJNSPESERTA ?>
    <tr id="r_KDJNSPESERTA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_INASIS_JENIS_PESERTA_KDJNSPESERTA"><?= $Page->KDJNSPESERTA->caption() ?></span></td>
        <td data-name="KDJNSPESERTA" <?= $Page->KDJNSPESERTA->cellAttributes() ?>>
<span id="el_INASIS_JENIS_PESERTA_KDJNSPESERTA">
<span<?= $Page->KDJNSPESERTA->viewAttributes() ?>>
<?= $Page->KDJNSPESERTA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NMJNSPESERTA->Visible) { // NMJNSPESERTA ?>
    <tr id="r_NMJNSPESERTA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_INASIS_JENIS_PESERTA_NMJNSPESERTA"><?= $Page->NMJNSPESERTA->caption() ?></span></td>
        <td data-name="NMJNSPESERTA" <?= $Page->NMJNSPESERTA->cellAttributes() ?>>
<span id="el_INASIS_JENIS_PESERTA_NMJNSPESERTA">
<span<?= $Page->NMJNSPESERTA->viewAttributes() ?>>
<?= $Page->NMJNSPESERTA->getViewValue() ?></span>
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
