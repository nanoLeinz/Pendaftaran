<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienDiagnosaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPASIEN_DIAGNOSAview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fPASIEN_DIAGNOSAview = currentForm = new ew.Form("fPASIEN_DIAGNOSAview", "view");
    loadjs.done("fPASIEN_DIAGNOSAview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.PASIEN_DIAGNOSA) ew.vars.tables.PASIEN_DIAGNOSA = <?= JsonEncode(GetClientVar("tables", "PASIEN_DIAGNOSA")) ?>;
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
<form name="fPASIEN_DIAGNOSAview" id="fPASIEN_DIAGNOSAview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN_DIAGNOSA">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (!$Page->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="Page"><!-- multi-page tabs -->
    <ul class="<?= $Page->MultiPages->navStyle() ?>">
        <li class="nav-item"><a class="nav-link<?= $Page->MultiPages->pageStyle(1) ?>" href="#tab_PASIEN_DIAGNOSA1" data-toggle="tab"><?= $Page->pageCaption(1) ?></a></li>
        <li class="nav-item"><a class="nav-link<?= $Page->MultiPages->pageStyle(2) ?>" href="#tab_PASIEN_DIAGNOSA2" data-toggle="tab"><?= $Page->pageCaption(2) ?></a></li>
        <li class="nav-item"><a class="nav-link<?= $Page->MultiPages->pageStyle(3) ?>" href="#tab_PASIEN_DIAGNOSA3" data-toggle="tab"><?= $Page->pageCaption(3) ?></a></li>
        <li class="nav-item"><a class="nav-link<?= $Page->MultiPages->pageStyle(4) ?>" href="#tab_PASIEN_DIAGNOSA4" data-toggle="tab"><?= $Page->pageCaption(4) ?></a></li>
    </ul>
    <div class="tab-content">
<?php } ?>
<?php if (!$Page->isExport()) { ?>
        <div class="tab-pane<?= $Page->MultiPages->pageStyle(1) ?>" id="tab_PASIEN_DIAGNOSA1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <tr id="r_NO_REGISTRATION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></td>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_NO_REGISTRATION" data-page="1">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->THENAME->Visible) { // THENAME ?>
    <tr id="r_THENAME">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_THENAME"><?= $Page->THENAME->caption() ?></span></td>
        <td data-name="THENAME" <?= $Page->THENAME->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_THENAME" data-page="1">
<span<?= $Page->THENAME->viewAttributes() ?>>
<?= $Page->THENAME->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { // KELUAR_ID ?>
    <tr id="r_KELUAR_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_KELUAR_ID"><?= $Page->KELUAR_ID->caption() ?></span></td>
        <td data-name="KELUAR_ID" <?= $Page->KELUAR_ID->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_KELUAR_ID" data-page="1">
<span<?= $Page->KELUAR_ID->viewAttributes() ?>>
<?= $Page->KELUAR_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DATE_OF_DIAGNOSA->Visible) { // DATE_OF_DIAGNOSA ?>
    <tr id="r_DATE_OF_DIAGNOSA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA"><?= $Page->DATE_OF_DIAGNOSA->caption() ?></span></td>
        <td data-name="DATE_OF_DIAGNOSA" <?= $Page->DATE_OF_DIAGNOSA->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DATE_OF_DIAGNOSA" data-page="1">
<span<?= $Page->DATE_OF_DIAGNOSA->viewAttributes() ?>>
<?= $Page->DATE_OF_DIAGNOSA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <tr id="r_DIAGNOSA_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID"><?= $Page->DIAGNOSA_ID->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID" <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID" data-page="1">
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ANAMNASE->Visible) { // ANAMNASE ?>
    <tr id="r_ANAMNASE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_ANAMNASE"><?= $Page->ANAMNASE->caption() ?></span></td>
        <td data-name="ANAMNASE" <?= $Page->ANAMNASE->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_ANAMNASE" data-page="1">
<span<?= $Page->ANAMNASE->viewAttributes() ?>>
<?= $Page->ANAMNASE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PEMERIKSAAN->Visible) { // PEMERIKSAAN ?>
    <tr id="r_PEMERIKSAAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_PEMERIKSAAN"><?= $Page->PEMERIKSAAN->caption() ?></span></td>
        <td data-name="PEMERIKSAAN" <?= $Page->PEMERIKSAAN->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PEMERIKSAAN" data-page="1">
<span<?= $Page->PEMERIKSAAN->viewAttributes() ?>>
<?= $Page->PEMERIKSAAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TERAPHY_DESC->Visible) { // TERAPHY_DESC ?>
    <tr id="r_TERAPHY_DESC">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_TERAPHY_DESC"><?= $Page->TERAPHY_DESC->caption() ?></span></td>
        <td data-name="TERAPHY_DESC" <?= $Page->TERAPHY_DESC->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_TERAPHY_DESC" data-page="1">
<span<?= $Page->TERAPHY_DESC->viewAttributes() ?>>
<?= $Page->TERAPHY_DESC->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->INSTRUCTION->Visible) { // INSTRUCTION ?>
    <tr id="r_INSTRUCTION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_INSTRUCTION"><?= $Page->INSTRUCTION->caption() ?></span></td>
        <td data-name="INSTRUCTION" <?= $Page->INSTRUCTION->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_INSTRUCTION" data-page="1">
<span<?= $Page->INSTRUCTION->viewAttributes() ?>>
<?= $Page->INSTRUCTION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <tr id="r_EMPLOYEE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_EMPLOYEE_ID"><?= $Page->EMPLOYEE_ID->caption() ?></span></td>
        <td data-name="EMPLOYEE_ID" <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_EMPLOYEE_ID" data-page="1">
<span<?= $Page->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Page->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MORFOLOGI_NEOPLASMA->Visible) { // MORFOLOGI_NEOPLASMA ?>
    <tr id="r_MORFOLOGI_NEOPLASMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_MORFOLOGI_NEOPLASMA"><?= $Page->MORFOLOGI_NEOPLASMA->caption() ?></span></td>
        <td data-name="MORFOLOGI_NEOPLASMA" <?= $Page->MORFOLOGI_NEOPLASMA->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_MORFOLOGI_NEOPLASMA" data-page="1">
<span<?= $Page->MORFOLOGI_NEOPLASMA->viewAttributes() ?>>
<?= $Page->MORFOLOGI_NEOPLASMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <tr id="r_DESCRIPTION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DESCRIPTION"><?= $Page->DESCRIPTION->caption() ?></span></td>
        <td data-name="DESCRIPTION" <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DESCRIPTION" data-page="1">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KOMPLIKASI->Visible) { // KOMPLIKASI ?>
    <tr id="r_KOMPLIKASI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_KOMPLIKASI"><?= $Page->KOMPLIKASI->caption() ?></span></td>
        <td data-name="KOMPLIKASI" <?= $Page->KOMPLIKASI->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_KOMPLIKASI" data-page="1">
<span<?= $Page->KOMPLIKASI->viewAttributes() ?>>
<?= $Page->KOMPLIKASI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID2->Visible) { // DIAGNOSA_ID2 ?>
    <tr id="r_DIAGNOSA_ID2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID2"><?= $Page->DIAGNOSA_ID2->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID2" <?= $Page->DIAGNOSA_ID2->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID2" data-page="1">
<span<?= $Page->DIAGNOSA_ID2->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TGLKONTROL->Visible) { // TGLKONTROL ?>
    <tr id="r_TGLKONTROL">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_TGLKONTROL"><?= $Page->TGLKONTROL->caption() ?></span></td>
        <td data-name="TGLKONTROL" <?= $Page->TGLKONTROL->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_TGLKONTROL" data-page="1">
<span<?= $Page->TGLKONTROL->viewAttributes() ?>>
<?= $Page->TGLKONTROL->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PEMERIKSAAN_02->Visible) { // PEMERIKSAAN_02 ?>
    <tr id="r_PEMERIKSAAN_02">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_PEMERIKSAAN_02"><?= $Page->PEMERIKSAAN_02->caption() ?></span></td>
        <td data-name="PEMERIKSAAN_02" <?= $Page->PEMERIKSAAN_02->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PEMERIKSAAN_02" data-page="1">
<span<?= $Page->PEMERIKSAAN_02->viewAttributes() ?>>
<?= $Page->PEMERIKSAAN_02->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
    <tr id="r_IDXDAFTAR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_IDXDAFTAR"><?= $Page->IDXDAFTAR->caption() ?></span></td>
        <td data-name="IDXDAFTAR" <?= $Page->IDXDAFTAR->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_IDXDAFTAR" data-page="1">
<span<?= $Page->IDXDAFTAR->viewAttributes() ?>>
<?= $Page->IDXDAFTAR->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->isExport()) { ?>
        </div>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
        <div class="tab-pane<?= $Page->MultiPages->pageStyle(2) ?>" id="tab_PASIEN_DIAGNOSA2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->WEIGHT->Visible) { // WEIGHT ?>
    <tr id="r_WEIGHT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_WEIGHT"><?= $Page->WEIGHT->caption() ?></span></td>
        <td data-name="WEIGHT" <?= $Page->WEIGHT->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_WEIGHT" data-page="2">
<span<?= $Page->WEIGHT->viewAttributes() ?>>
<?= $Page->WEIGHT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
    <tr id="r_height">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_height"><?= $Page->height->caption() ?></span></td>
        <td data-name="height" <?= $Page->height->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_height" data-page="2">
<span<?= $Page->height->viewAttributes() ?>>
<?= $Page->height->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TEMPERATURE->Visible) { // TEMPERATURE ?>
    <tr id="r_TEMPERATURE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_TEMPERATURE"><?= $Page->TEMPERATURE->caption() ?></span></td>
        <td data-name="TEMPERATURE" <?= $Page->TEMPERATURE->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_TEMPERATURE" data-page="2">
<span<?= $Page->TEMPERATURE->viewAttributes() ?>>
<?= $Page->TEMPERATURE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TENSION_UPPER->Visible) { // TENSION_UPPER ?>
    <tr id="r_TENSION_UPPER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_TENSION_UPPER"><?= $Page->TENSION_UPPER->caption() ?></span></td>
        <td data-name="TENSION_UPPER" <?= $Page->TENSION_UPPER->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_TENSION_UPPER" data-page="2">
<span<?= $Page->TENSION_UPPER->viewAttributes() ?>>
<?= $Page->TENSION_UPPER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NADI->Visible) { // NADI ?>
    <tr id="r_NADI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_NADI"><?= $Page->NADI->caption() ?></span></td>
        <td data-name="NADI" <?= $Page->NADI->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_NADI" data-page="2">
<span<?= $Page->NADI->viewAttributes() ?>>
<?= $Page->NADI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAFAS->Visible) { // NAFAS ?>
    <tr id="r_NAFAS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_NAFAS"><?= $Page->NAFAS->caption() ?></span></td>
        <td data-name="NAFAS" <?= $Page->NAFAS->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_NAFAS" data-page="2">
<span<?= $Page->NAFAS->viewAttributes() ?>>
<?= $Page->NAFAS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->isExport()) { ?>
        </div>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
        <div class="tab-pane<?= $Page->MultiPages->pageStyle(3) ?>" id="tab_PASIEN_DIAGNOSA3"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->PROCEDURE_03->Visible) { // PROCEDURE_03 ?>
    <tr id="r_PROCEDURE_03">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_PROCEDURE_03"><?= $Page->PROCEDURE_03->caption() ?></span></td>
        <td data-name="PROCEDURE_03" <?= $Page->PROCEDURE_03->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PROCEDURE_03" data-page="3">
<span<?= $Page->PROCEDURE_03->viewAttributes() ?>>
<?= $Page->PROCEDURE_03->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROCEDURE_05->Visible) { // PROCEDURE_05 ?>
    <tr id="r_PROCEDURE_05">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_PROCEDURE_05"><?= $Page->PROCEDURE_05->caption() ?></span></td>
        <td data-name="PROCEDURE_05" <?= $Page->PROCEDURE_05->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PROCEDURE_05" data-page="3">
<span<?= $Page->PROCEDURE_05->viewAttributes() ?>>
<?= $Page->PROCEDURE_05->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROCEDURE_06->Visible) { // PROCEDURE_06 ?>
    <tr id="r_PROCEDURE_06">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_PROCEDURE_06"><?= $Page->PROCEDURE_06->caption() ?></span></td>
        <td data-name="PROCEDURE_06" <?= $Page->PROCEDURE_06->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_PROCEDURE_06" data-page="3">
<span<?= $Page->PROCEDURE_06->viewAttributes() ?>>
<?= $Page->PROCEDURE_06->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->isExport()) { ?>
        </div>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
        <div class="tab-pane<?= $Page->MultiPages->pageStyle(4) ?>" id="tab_PASIEN_DIAGNOSA4"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->DIAGNOSA_ID_02->Visible) { // DIAGNOSA_ID_02 ?>
    <tr id="r_DIAGNOSA_ID_02">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_02"><?= $Page->DIAGNOSA_ID_02->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID_02" <?= $Page->DIAGNOSA_ID_02->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_02" data-page="4">
<span<?= $Page->DIAGNOSA_ID_02->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID_02->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_03->Visible) { // DIAGNOSA_ID_03 ?>
    <tr id="r_DIAGNOSA_ID_03">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_03"><?= $Page->DIAGNOSA_ID_03->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID_03" <?= $Page->DIAGNOSA_ID_03->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_03" data-page="4">
<span<?= $Page->DIAGNOSA_ID_03->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID_03->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_04->Visible) { // DIAGNOSA_ID_04 ?>
    <tr id="r_DIAGNOSA_ID_04">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_04"><?= $Page->DIAGNOSA_ID_04->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID_04" <?= $Page->DIAGNOSA_ID_04->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_04" data-page="4">
<span<?= $Page->DIAGNOSA_ID_04->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID_04->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_05->Visible) { // DIAGNOSA_ID_05 ?>
    <tr id="r_DIAGNOSA_ID_05">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_05"><?= $Page->DIAGNOSA_ID_05->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID_05" <?= $Page->DIAGNOSA_ID_05->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_05" data-page="4">
<span<?= $Page->DIAGNOSA_ID_05->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID_05->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID_06->Visible) { // DIAGNOSA_ID_06 ?>
    <tr id="r_DIAGNOSA_ID_06">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DIAGNOSA_DIAGNOSA_ID_06"><?= $Page->DIAGNOSA_ID_06->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID_06" <?= $Page->DIAGNOSA_ID_06->cellAttributes() ?>>
<span id="el_PASIEN_DIAGNOSA_DIAGNOSA_ID_06" data-page="4">
<span<?= $Page->DIAGNOSA_ID_06->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID_06->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->isExport()) { ?>
        </div>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
    </div>
</div>
</div>
<?php } ?>
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
