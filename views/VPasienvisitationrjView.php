<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VPasienvisitationrjView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_PASIENVISITATIONRJview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fV_PASIENVISITATIONRJview = currentForm = new ew.Form("fV_PASIENVISITATIONRJview", "view");
    loadjs.done("fV_PASIENVISITATIONRJview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.V_PASIENVISITATIONRJ) ew.vars.tables.V_PASIENVISITATIONRJ = <?= JsonEncode(GetClientVar("tables", "V_PASIENVISITATIONRJ")) ?>;
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
<form name="fV_PASIENVISITATIONRJview" id="fV_PASIENVISITATIONRJview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_PASIENVISITATIONRJ">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
    <tr id="r_NAME_OF_PASIEN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_NAME_OF_PASIEN"><?= $Page->NAME_OF_PASIEN->caption() ?></span></td>
        <td data-name="NAME_OF_PASIEN" <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_NAME_OF_PASIEN">
<span<?= $Page->NAME_OF_PASIEN->viewAttributes() ?>>
<?= $Page->NAME_OF_PASIEN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <tr id="r_NO_REGISTRATION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></td>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <tr id="r_ORG_UNIT_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></td>
        <td data-name="ORG_UNIT_CODE" <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_of_birth->Visible) { // date_of_birth ?>
    <tr id="r_date_of_birth">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_date_of_birth"><?= $Page->date_of_birth->caption() ?></span></td>
        <td data-name="date_of_birth" <?= $Page->date_of_birth->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_date_of_birth">
<span<?= $Page->date_of_birth->viewAttributes() ?>>
<?= $Page->date_of_birth->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
    <tr id="r_CONTACT_ADDRESS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_CONTACT_ADDRESS"><?= $Page->CONTACT_ADDRESS->caption() ?></span></td>
        <td data-name="CONTACT_ADDRESS" <?= $Page->CONTACT_ADDRESS->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_CONTACT_ADDRESS">
<span<?= $Page->CONTACT_ADDRESS->viewAttributes() ?>>
<?= $Page->CONTACT_ADDRESS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PHONE_NUMBER->Visible) { // PHONE_NUMBER ?>
    <tr id="r_PHONE_NUMBER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_PHONE_NUMBER"><?= $Page->PHONE_NUMBER->caption() ?></span></td>
        <td data-name="PHONE_NUMBER" <?= $Page->PHONE_NUMBER->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_PHONE_NUMBER">
<span<?= $Page->PHONE_NUMBER->viewAttributes() ?>>
<?= $Page->PHONE_NUMBER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { // MOBILE ?>
    <tr id="r_MOBILE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_MOBILE"><?= $Page->MOBILE->caption() ?></span></td>
        <td data-name="MOBILE" <?= $Page->MOBILE->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_MOBILE">
<span<?= $Page->MOBILE->viewAttributes() ?>>
<?= $Page->MOBILE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KAL_ID->Visible) { // KAL_ID ?>
    <tr id="r_KAL_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_KAL_ID"><?= $Page->KAL_ID->caption() ?></span></td>
        <td data-name="KAL_ID" <?= $Page->KAL_ID->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_KAL_ID">
<span<?= $Page->KAL_ID->viewAttributes() ?>>
<?= $Page->KAL_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
    <tr id="r_PLACE_OF_BIRTH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_PLACE_OF_BIRTH"><?= $Page->PLACE_OF_BIRTH->caption() ?></span></td>
        <td data-name="PLACE_OF_BIRTH" <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_PLACE_OF_BIRTH">
<span<?= $Page->PLACE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->PLACE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
    <tr id="r_KALURAHAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_KALURAHAN"><?= $Page->KALURAHAN->caption() ?></span></td>
        <td data-name="KALURAHAN" <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->clinic_id->Visible) { // clinic_id ?>
    <tr id="r_clinic_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_clinic_id"><?= $Page->clinic_id->caption() ?></span></td>
        <td data-name="clinic_id" <?= $Page->clinic_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_clinic_id">
<span<?= $Page->clinic_id->viewAttributes() ?>>
<?= $Page->clinic_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name_of_clinic->Visible) { // name_of_clinic ?>
    <tr id="r_name_of_clinic">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_name_of_clinic"><?= $Page->name_of_clinic->caption() ?></span></td>
        <td data-name="name_of_clinic" <?= $Page->name_of_clinic->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_name_of_clinic">
<span<?= $Page->name_of_clinic->viewAttributes() ?>>
<?= $Page->name_of_clinic->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->clinic_id_from->Visible) { // clinic_id_from ?>
    <tr id="r_clinic_id_from">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_clinic_id_from"><?= $Page->clinic_id_from->caption() ?></span></td>
        <td data-name="clinic_id_from" <?= $Page->clinic_id_from->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_clinic_id_from">
<span<?= $Page->clinic_id_from->viewAttributes() ?>>
<?= $Page->clinic_id_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->fullname->Visible) { // fullname ?>
    <tr id="r_fullname">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_fullname"><?= $Page->fullname->caption() ?></span></td>
        <td data-name="fullname" <?= $Page->fullname->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_fullname">
<span<?= $Page->fullname->viewAttributes() ?>>
<?= $Page->fullname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <tr id="r_employee_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_employee_id"><?= $Page->employee_id->caption() ?></span></td>
        <td data-name="employee_id" <?= $Page->employee_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_employee_id">
<span<?= $Page->employee_id->viewAttributes() ?>>
<?= $Page->employee_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->employee_id_from->Visible) { // employee_id_from ?>
    <tr id="r_employee_id_from">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_employee_id_from"><?= $Page->employee_id_from->caption() ?></span></td>
        <td data-name="employee_id_from" <?= $Page->employee_id_from->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_employee_id_from">
<span<?= $Page->employee_id_from->viewAttributes() ?>>
<?= $Page->employee_id_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->booked_Date->Visible) { // booked_Date ?>
    <tr id="r_booked_Date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_booked_Date"><?= $Page->booked_Date->caption() ?></span></td>
        <td data-name="booked_Date" <?= $Page->booked_Date->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_booked_Date">
<span<?= $Page->booked_Date->viewAttributes() ?>>
<?= $Page->booked_Date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_date->Visible) { // visit_date ?>
    <tr id="r_visit_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_visit_date"><?= $Page->visit_date->caption() ?></span></td>
        <td data-name="visit_date" <?= $Page->visit_date->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_visit_date">
<span<?= $Page->visit_date->viewAttributes() ?>>
<?= $Page->visit_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visit_id->Visible) { // visit_id ?>
    <tr id="r_visit_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_visit_id"><?= $Page->visit_id->caption() ?></span></td>
        <td data-name="visit_id" <?= $Page->visit_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_visit_id">
<span<?= $Page->visit_id->viewAttributes() ?>>
<?= $Page->visit_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isattended->Visible) { // isattended ?>
    <tr id="r_isattended">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_isattended"><?= $Page->isattended->caption() ?></span></td>
        <td data-name="isattended" <?= $Page->isattended->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_isattended">
<span<?= $Page->isattended->viewAttributes() ?>>
<?= $Page->isattended->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->diantar_oleh->Visible) { // diantar_oleh ?>
    <tr id="r_diantar_oleh">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_diantar_oleh"><?= $Page->diantar_oleh->caption() ?></span></td>
        <td data-name="diantar_oleh" <?= $Page->diantar_oleh->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_diantar_oleh">
<span<?= $Page->diantar_oleh->viewAttributes() ?>>
<?= $Page->diantar_oleh->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visitor_address->Visible) { // visitor_address ?>
    <tr id="r_visitor_address">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_visitor_address"><?= $Page->visitor_address->caption() ?></span></td>
        <td data-name="visitor_address" <?= $Page->visitor_address->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_visitor_address">
<span<?= $Page->visitor_address->viewAttributes() ?>>
<?= $Page->visitor_address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address_of_rujukan->Visible) { // address_of_rujukan ?>
    <tr id="r_address_of_rujukan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_address_of_rujukan"><?= $Page->address_of_rujukan->caption() ?></span></td>
        <td data-name="address_of_rujukan" <?= $Page->address_of_rujukan->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_address_of_rujukan">
<span<?= $Page->address_of_rujukan->viewAttributes() ?>>
<?= $Page->address_of_rujukan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rujukan_id->Visible) { // rujukan_id ?>
    <tr id="r_rujukan_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_rujukan_id"><?= $Page->rujukan_id->caption() ?></span></td>
        <td data-name="rujukan_id" <?= $Page->rujukan_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_rujukan_id">
<span<?= $Page->rujukan_id->viewAttributes() ?>>
<?= $Page->rujukan_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <tr id="r_DESCRIPTION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_DESCRIPTION"><?= $Page->DESCRIPTION->caption() ?></span></td>
        <td data-name="DESCRIPTION" <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_DESCRIPTION">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->patient_category_id->Visible) { // patient_category_id ?>
    <tr id="r_patient_category_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_patient_category_id"><?= $Page->patient_category_id->caption() ?></span></td>
        <td data-name="patient_category_id" <?= $Page->patient_category_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_patient_category_id">
<span<?= $Page->patient_category_id->viewAttributes() ?>>
<?= $Page->patient_category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payor_id->Visible) { // payor_id ?>
    <tr id="r_payor_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_payor_id"><?= $Page->payor_id->caption() ?></span></td>
        <td data-name="payor_id" <?= $Page->payor_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_payor_id">
<span<?= $Page->payor_id->viewAttributes() ?>>
<?= $Page->payor_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reason_id->Visible) { // reason_id ?>
    <tr id="r_reason_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_reason_id"><?= $Page->reason_id->caption() ?></span></td>
        <td data-name="reason_id" <?= $Page->reason_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_reason_id">
<span<?= $Page->reason_id->viewAttributes() ?>>
<?= $Page->reason_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <tr id="r_STATUS_PASIEN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_STATUS_PASIEN_ID"><?= $Page->STATUS_PASIEN_ID->caption() ?></span></td>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_STATUS_PASIEN_ID">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->way_id->Visible) { // way_id ?>
    <tr id="r_way_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_way_id"><?= $Page->way_id->caption() ?></span></td>
        <td data-name="way_id" <?= $Page->way_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_way_id">
<span<?= $Page->way_id->viewAttributes() ?>>
<?= $Page->way_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->follow_up->Visible) { // follow_up ?>
    <tr id="r_follow_up">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_follow_up"><?= $Page->follow_up->caption() ?></span></td>
        <td data-name="follow_up" <?= $Page->follow_up->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_follow_up">
<span<?= $Page->follow_up->viewAttributes() ?>>
<?= $Page->follow_up->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isnew->Visible) { // isnew ?>
    <tr id="r_isnew">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_isnew"><?= $Page->isnew->caption() ?></span></td>
        <td data-name="isnew" <?= $Page->isnew->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_isnew">
<span<?= $Page->isnew->viewAttributes() ?>>
<?= $Page->isnew->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->family_status_id->Visible) { // family_status_id ?>
    <tr id="r_family_status_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_family_status_id"><?= $Page->family_status_id->caption() ?></span></td>
        <td data-name="family_status_id" <?= $Page->family_status_id->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_family_status_id">
<span<?= $Page->family_status_id->viewAttributes() ?>>
<?= $Page->family_status_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->urutan->Visible) { // urutan ?>
    <tr id="r_urutan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_PASIENVISITATIONRJ_urutan"><?= $Page->urutan->caption() ?></span></td>
        <td data-name="urutan" <?= $Page->urutan->cellAttributes() ?>>
<span id="el_V_PASIENVISITATIONRJ_urutan">
<span<?= $Page->urutan->viewAttributes() ?>>
<?= $Page->urutan->getViewValue() ?></span>
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
