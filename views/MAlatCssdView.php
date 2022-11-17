<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MAlatCssdView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fm_alat_cssdview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fm_alat_cssdview = currentForm = new ew.Form("fm_alat_cssdview", "view");
    loadjs.done("fm_alat_cssdview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.m_alat_cssd) ew.vars.tables.m_alat_cssd = <?= JsonEncode(GetClientVar("tables", "m_alat_cssd")) ?>;
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
<form name="fm_alat_cssdview" id="fm_alat_cssdview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_alat_cssd">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->alat_id->Visible) { // alat_id ?>
    <tr id="r_alat_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_alat_cssd_alat_id"><?= $Page->alat_id->caption() ?></span></td>
        <td data-name="alat_id" <?= $Page->alat_id->cellAttributes() ?>>
<span id="el_m_alat_cssd_alat_id">
<span<?= $Page->alat_id->viewAttributes() ?>>
<?= $Page->alat_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_alat->Visible) { // nama_alat ?>
    <tr id="r_nama_alat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_alat_cssd_nama_alat"><?= $Page->nama_alat->caption() ?></span></td>
        <td data-name="nama_alat" <?= $Page->nama_alat->cellAttributes() ?>>
<span id="el_m_alat_cssd_nama_alat">
<span<?= $Page->nama_alat->viewAttributes() ?>>
<?= $Page->nama_alat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_set->Visible) { // id_set ?>
    <tr id="r_id_set">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_alat_cssd_id_set"><?= $Page->id_set->caption() ?></span></td>
        <td data-name="id_set" <?= $Page->id_set->cellAttributes() ?>>
<span id="el_m_alat_cssd_id_set">
<span<?= $Page->id_set->viewAttributes() ?>>
<?= $Page->id_set->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
    <tr id="r_keadaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_alat_cssd_keadaan"><?= $Page->keadaan->caption() ?></span></td>
        <td data-name="keadaan" <?= $Page->keadaan->cellAttributes() ?>>
<span id="el_m_alat_cssd_keadaan">
<span<?= $Page->keadaan->viewAttributes() ?>>
<?= $Page->keadaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
    <tr id="r_jumlah">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_alat_cssd_jumlah"><?= $Page->jumlah->caption() ?></span></td>
        <td data-name="jumlah" <?= $Page->jumlah->cellAttributes() ?>>
<span id="el_m_alat_cssd_jumlah">
<span<?= $Page->jumlah->viewAttributes() ?>>
<?= $Page->jumlah->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->merk->Visible) { // merk ?>
    <tr id="r_merk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_alat_cssd_merk"><?= $Page->merk->caption() ?></span></td>
        <td data-name="merk" <?= $Page->merk->cellAttributes() ?>>
<span id="el_m_alat_cssd_merk">
<span<?= $Page->merk->viewAttributes() ?>>
<?= $Page->merk->getViewValue() ?></span>
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
