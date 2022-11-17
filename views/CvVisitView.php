<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$CvVisitView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcv_visitview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fcv_visitview = currentForm = new ew.Form("fcv_visitview", "view");
    loadjs.done("fcv_visitview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.cv_visit) ew.vars.tables.cv_visit = <?= JsonEncode(GetClientVar("tables", "cv_visit")) ?>;
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
<form name="fcv_visitview" id="fcv_visitview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cv_visit">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <tr id="r_NO_REGISTRATION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></td>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_cv_visit_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->VISIT_ID->Visible) { // VISIT_ID ?>
    <tr id="r_VISIT_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_VISIT_ID"><?= $Page->VISIT_ID->caption() ?></span></td>
        <td data-name="VISIT_ID" <?= $Page->VISIT_ID->cellAttributes() ?>>
<span id="el_cv_visit_VISIT_ID">
<span<?= $Page->VISIT_ID->viewAttributes() ?>>
<?= $Page->VISIT_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <tr id="r_STATUS_PASIEN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_STATUS_PASIEN_ID"><?= $Page->STATUS_PASIEN_ID->caption() ?></span></td>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_cv_visit_STATUS_PASIEN_ID">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->REASON_ID->Visible) { // REASON_ID ?>
    <tr id="r_REASON_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_REASON_ID"><?= $Page->REASON_ID->caption() ?></span></td>
        <td data-name="REASON_ID" <?= $Page->REASON_ID->cellAttributes() ?>>
<span id="el_cv_visit_REASON_ID">
<span<?= $Page->REASON_ID->viewAttributes() ?>>
<?= $Page->REASON_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->WAY_ID->Visible) { // WAY_ID ?>
    <tr id="r_WAY_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_WAY_ID"><?= $Page->WAY_ID->caption() ?></span></td>
        <td data-name="WAY_ID" <?= $Page->WAY_ID->cellAttributes() ?>>
<span id="el_cv_visit_WAY_ID">
<span<?= $Page->WAY_ID->viewAttributes() ?>>
<?= $Page->WAY_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BOOKED_DATE->Visible) { // BOOKED_DATE ?>
    <tr id="r_BOOKED_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_BOOKED_DATE"><?= $Page->BOOKED_DATE->caption() ?></span></td>
        <td data-name="BOOKED_DATE" <?= $Page->BOOKED_DATE->cellAttributes() ?>>
<span id="el_cv_visit_BOOKED_DATE">
<span<?= $Page->BOOKED_DATE->viewAttributes() ?>>
<?= $Page->BOOKED_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
    <tr id="r_VISIT_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_VISIT_DATE"><?= $Page->VISIT_DATE->caption() ?></span></td>
        <td data-name="VISIT_DATE" <?= $Page->VISIT_DATE->cellAttributes() ?>>
<span id="el_cv_visit_VISIT_DATE">
<span<?= $Page->VISIT_DATE->viewAttributes() ?>>
<?= $Page->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TICKET_NO->Visible) { // TICKET_NO ?>
    <tr id="r_TICKET_NO">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_TICKET_NO"><?= $Page->TICKET_NO->caption() ?></span></td>
        <td data-name="TICKET_NO" <?= $Page->TICKET_NO->cellAttributes() ?>>
<span id="el_cv_visit_TICKET_NO">
<span<?= $Page->TICKET_NO->viewAttributes() ?>>
<?= $Page->TICKET_NO->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <tr id="r_CLINIC_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span></td>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_cv_visit_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <tr id="r_GENDER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_GENDER"><?= $Page->GENDER->caption() ?></span></td>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_cv_visit_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <tr id="r_EMPLOYEE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_EMPLOYEE_ID"><?= $Page->EMPLOYEE_ID->caption() ?></span></td>
        <td data-name="EMPLOYEE_ID" <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_cv_visit_EMPLOYEE_ID">
<span<?= $Page->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Page->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <tr id="r_CLASS_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_CLASS_ID"><?= $Page->CLASS_ID->caption() ?></span></td>
        <td data-name="CLASS_ID" <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_cv_visit_CLASS_ID">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
    <tr id="r_PASIEN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_PASIEN_ID"><?= $Page->PASIEN_ID->caption() ?></span></td>
        <td data-name="PASIEN_ID" <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el_cv_visit_PASIEN_ID">
<span<?= $Page->PASIEN_ID->viewAttributes() ?>>
<?= $Page->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <tr id="r_COVERAGE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_COVERAGE_ID"><?= $Page->COVERAGE_ID->caption() ?></span></td>
        <td data-name="COVERAGE_ID" <?= $Page->COVERAGE_ID->cellAttributes() ?>>
<span id="el_cv_visit_COVERAGE_ID">
<span<?= $Page->COVERAGE_ID->viewAttributes() ?>>
<?= $Page->COVERAGE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_SKP->Visible) { // NO_SKP ?>
    <tr id="r_NO_SKP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_NO_SKP"><?= $Page->NO_SKP->caption() ?></span></td>
        <td data-name="NO_SKP" <?= $Page->NO_SKP->cellAttributes() ?>>
<span id="el_cv_visit_NO_SKP">
<span<?= $Page->NO_SKP->viewAttributes() ?>>
<?= $Page->NO_SKP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <tr id="r_DIAGNOSA_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_DIAGNOSA_ID"><?= $Page->DIAGNOSA_ID->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID" <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el_cv_visit_DIAGNOSA_ID">
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NORUJUKAN->Visible) { // NORUJUKAN ?>
    <tr id="r_NORUJUKAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_NORUJUKAN"><?= $Page->NORUJUKAN->caption() ?></span></td>
        <td data-name="NORUJUKAN" <?= $Page->NORUJUKAN->cellAttributes() ?>>
<span id="el_cv_visit_NORUJUKAN">
<span<?= $Page->NORUJUKAN->viewAttributes() ?>>
<?= $Page->NORUJUKAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PPKRUJUKAN->Visible) { // PPKRUJUKAN ?>
    <tr id="r_PPKRUJUKAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_PPKRUJUKAN"><?= $Page->PPKRUJUKAN->caption() ?></span></td>
        <td data-name="PPKRUJUKAN" <?= $Page->PPKRUJUKAN->cellAttributes() ?>>
<span id="el_cv_visit_PPKRUJUKAN">
<span<?= $Page->PPKRUJUKAN->viewAttributes() ?>>
<?= $Page->PPKRUJUKAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EDIT_SEP->Visible) { // EDIT_SEP ?>
    <tr id="r_EDIT_SEP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_EDIT_SEP"><?= $Page->EDIT_SEP->caption() ?></span></td>
        <td data-name="EDIT_SEP" <?= $Page->EDIT_SEP->cellAttributes() ?>>
<span id="el_cv_visit_EDIT_SEP">
<span<?= $Page->EDIT_SEP->viewAttributes() ?>>
<?= $Page->EDIT_SEP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAG_AWAL->Visible) { // DIAG_AWAL ?>
    <tr id="r_DIAG_AWAL">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_DIAG_AWAL"><?= $Page->DIAG_AWAL->caption() ?></span></td>
        <td data-name="DIAG_AWAL" <?= $Page->DIAG_AWAL->cellAttributes() ?>>
<span id="el_cv_visit_DIAG_AWAL">
<span<?= $Page->DIAG_AWAL->viewAttributes() ?>>
<?= $Page->DIAG_AWAL->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->COB->Visible) { // COB ?>
    <tr id="r_COB">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_COB"><?= $Page->COB->caption() ?></span></td>
        <td data-name="COB" <?= $Page->COB->cellAttributes() ?>>
<span id="el_cv_visit_COB">
<span<?= $Page->COB->viewAttributes() ?>>
<?= $Page->COB->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ASALRUJUKAN->Visible) { // ASALRUJUKAN ?>
    <tr id="r_ASALRUJUKAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_ASALRUJUKAN"><?= $Page->ASALRUJUKAN->caption() ?></span></td>
        <td data-name="ASALRUJUKAN" <?= $Page->ASALRUJUKAN->cellAttributes() ?>>
<span id="el_cv_visit_ASALRUJUKAN">
<span<?= $Page->ASALRUJUKAN->viewAttributes() ?>>
<?= $Page->ASALRUJUKAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->RESPONTGLPLG_DESC->Visible) { // RESPONTGLPLG_DESC ?>
    <tr id="r_RESPONTGLPLG_DESC">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_RESPONTGLPLG_DESC"><?= $Page->RESPONTGLPLG_DESC->caption() ?></span></td>
        <td data-name="RESPONTGLPLG_DESC" <?= $Page->RESPONTGLPLG_DESC->cellAttributes() ?>>
<span id="el_cv_visit_RESPONTGLPLG_DESC">
<span<?= $Page->RESPONTGLPLG_DESC->viewAttributes() ?>>
<?= $Page->RESPONTGLPLG_DESC->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
    <tr id="r_tgl_kontrol">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_tgl_kontrol"><?= $Page->tgl_kontrol->caption() ?></span></td>
        <td data-name="tgl_kontrol" <?= $Page->tgl_kontrol->cellAttributes() ?>>
<span id="el_cv_visit_tgl_kontrol">
<span<?= $Page->tgl_kontrol->viewAttributes() ?>>
<?= $Page->tgl_kontrol->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idbooking->Visible) { // idbooking ?>
    <tr id="r_idbooking">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_idbooking"><?= $Page->idbooking->caption() ?></span></td>
        <td data-name="idbooking" <?= $Page->idbooking->cellAttributes() ?>>
<span id="el_cv_visit_idbooking">
<span<?= $Page->idbooking->viewAttributes() ?>>
<?= $Page->idbooking->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
    <tr id="r_id_tujuan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_id_tujuan"><?= $Page->id_tujuan->caption() ?></span></td>
        <td data-name="id_tujuan" <?= $Page->id_tujuan->cellAttributes() ?>>
<span id="el_cv_visit_id_tujuan">
<span<?= $Page->id_tujuan->viewAttributes() ?>>
<?= $Page->id_tujuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
    <tr id="r_id_penunjang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_id_penunjang"><?= $Page->id_penunjang->caption() ?></span></td>
        <td data-name="id_penunjang" <?= $Page->id_penunjang->cellAttributes() ?>>
<span id="el_cv_visit_id_penunjang">
<span<?= $Page->id_penunjang->viewAttributes() ?>>
<?= $Page->id_penunjang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
    <tr id="r_id_pembiayaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_id_pembiayaan"><?= $Page->id_pembiayaan->caption() ?></span></td>
        <td data-name="id_pembiayaan" <?= $Page->id_pembiayaan->cellAttributes() ?>>
<span id="el_cv_visit_id_pembiayaan">
<span<?= $Page->id_pembiayaan->viewAttributes() ?>>
<?= $Page->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
    <tr id="r_id_procedure">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_id_procedure"><?= $Page->id_procedure->caption() ?></span></td>
        <td data-name="id_procedure" <?= $Page->id_procedure->cellAttributes() ?>>
<span id="el_cv_visit_id_procedure">
<span<?= $Page->id_procedure->viewAttributes() ?>>
<?= $Page->id_procedure->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
    <tr id="r_id_aspel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_id_aspel"><?= $Page->id_aspel->caption() ?></span></td>
        <td data-name="id_aspel" <?= $Page->id_aspel->cellAttributes() ?>>
<span id="el_cv_visit_id_aspel">
<span<?= $Page->id_aspel->viewAttributes() ?>>
<?= $Page->id_aspel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
    <tr id="r_id_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_cv_visit_id_kelas"><?= $Page->id_kelas->caption() ?></span></td>
        <td data-name="id_kelas" <?= $Page->id_kelas->cellAttributes() ?>>
<span id="el_cv_visit_id_kelas">
<span<?= $Page->id_kelas->viewAttributes() ?>>
<?= $Page->id_kelas->getViewValue() ?></span>
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
