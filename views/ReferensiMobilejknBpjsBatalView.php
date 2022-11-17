<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ReferensiMobilejknBpjsBatalView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var freferensi_mobilejkn_bpjs_batalview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    freferensi_mobilejkn_bpjs_batalview = currentForm = new ew.Form("freferensi_mobilejkn_bpjs_batalview", "view");
    loadjs.done("freferensi_mobilejkn_bpjs_batalview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.referensi_mobilejkn_bpjs_batal) ew.vars.tables.referensi_mobilejkn_bpjs_batal = <?= JsonEncode(GetClientVar("tables", "referensi_mobilejkn_bpjs_batal")) ?>;
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
<form name="freferensi_mobilejkn_bpjs_batalview" id="freferensi_mobilejkn_bpjs_batalview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs_batal">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <tr id="r_no_rkm_medis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_no_rkm_medis"><?= $Page->no_rkm_medis->caption() ?></span></td>
        <td data-name="no_rkm_medis" <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_no_rkm_medis">
<span<?= $Page->no_rkm_medis->viewAttributes() ?>>
<?= $Page->no_rkm_medis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
    <tr id="r_nomorreferensi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_nomorreferensi"><?= $Page->nomorreferensi->caption() ?></span></td>
        <td data-name="nomorreferensi" <?= $Page->nomorreferensi->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_nomorreferensi">
<span<?= $Page->nomorreferensi->viewAttributes() ?>>
<?= $Page->nomorreferensi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggalbatal->Visible) { // tanggalbatal ?>
    <tr id="r_tanggalbatal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_tanggalbatal"><?= $Page->tanggalbatal->caption() ?></span></td>
        <td data-name="tanggalbatal" <?= $Page->tanggalbatal->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_tanggalbatal">
<span<?= $Page->tanggalbatal->viewAttributes() ?>>
<?= $Page->tanggalbatal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan" <?= $Page->keterangan->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
    <tr id="r_statuskirim">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_statuskirim"><?= $Page->statuskirim->caption() ?></span></td>
        <td data-name="statuskirim" <?= $Page->statuskirim->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_statuskirim">
<span<?= $Page->statuskirim->viewAttributes() ?>>
<?= $Page->statuskirim->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
    <tr id="r_nobooking">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_referensi_mobilejkn_bpjs_batal_nobooking"><?= $Page->nobooking->caption() ?></span></td>
        <td data-name="nobooking" <?= $Page->nobooking->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_nobooking">
<span<?= $Page->nobooking->viewAttributes() ?>>
<?= $Page->nobooking->getViewValue() ?></span>
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
