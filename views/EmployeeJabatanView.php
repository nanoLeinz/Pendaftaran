<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$EmployeeJabatanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fEMPLOYEE_JABATANview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fEMPLOYEE_JABATANview = currentForm = new ew.Form("fEMPLOYEE_JABATANview", "view");
    loadjs.done("fEMPLOYEE_JABATANview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.EMPLOYEE_JABATAN) ew.vars.tables.EMPLOYEE_JABATAN = <?= JsonEncode(GetClientVar("tables", "EMPLOYEE_JABATAN")) ?>;
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
<form name="fEMPLOYEE_JABATANview" id="fEMPLOYEE_JABATANview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="EMPLOYEE_JABATAN">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->KODE_JABATAN->Visible) { // KODE_JABATAN ?>
    <tr id="r_KODE_JABATAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_EMPLOYEE_JABATAN_KODE_JABATAN"><?= $Page->KODE_JABATAN->caption() ?></span></td>
        <td data-name="KODE_JABATAN" <?= $Page->KODE_JABATAN->cellAttributes() ?>>
<span id="el_EMPLOYEE_JABATAN_KODE_JABATAN">
<span<?= $Page->KODE_JABATAN->viewAttributes() ?>>
<?= $Page->KODE_JABATAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JABATAN->Visible) { // JABATAN ?>
    <tr id="r_JABATAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_EMPLOYEE_JABATAN_JABATAN"><?= $Page->JABATAN->caption() ?></span></td>
        <td data-name="JABATAN" <?= $Page->JABATAN->cellAttributes() ?>>
<span id="el_EMPLOYEE_JABATAN_JABATAN">
<span<?= $Page->JABATAN->viewAttributes() ?>>
<?= $Page->JABATAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ESELON->Visible) { // ESELON ?>
    <tr id="r_ESELON">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_EMPLOYEE_JABATAN_ESELON"><?= $Page->ESELON->caption() ?></span></td>
        <td data-name="ESELON" <?= $Page->ESELON->cellAttributes() ?>>
<span id="el_EMPLOYEE_JABATAN_ESELON">
<span<?= $Page->ESELON->viewAttributes() ?>>
<?= $Page->ESELON->getViewValue() ?></span>
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
