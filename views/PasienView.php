<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fPASIENview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fPASIENview = currentForm = new ew.Form("fPASIENview", "view");
    loadjs.done("fPASIENview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.PASIEN) ew.vars.tables.PASIEN = <?= JsonEncode(GetClientVar("tables", "PASIEN")) ?>;
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
<form name="fPASIENview" id="fPASIENview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <tr id="r_NO_REGISTRATION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></td>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_PASIEN_NO_REGISTRATION" data-page="1">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
    <tr id="r_NAME_OF_PASIEN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_NAME_OF_PASIEN"><?= $Page->NAME_OF_PASIEN->caption() ?></span></td>
        <td data-name="NAME_OF_PASIEN" <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el_PASIEN_NAME_OF_PASIEN" data-page="1">
<span<?= $Page->NAME_OF_PASIEN->viewAttributes() ?>>
<?= $Page->NAME_OF_PASIEN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
    <tr id="r_PASIEN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_PASIEN_ID"><?= $Page->PASIEN_ID->caption() ?></span></td>
        <td data-name="PASIEN_ID" <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el_PASIEN_PASIEN_ID" data-page="1">
<span<?= $Page->PASIEN_ID->viewAttributes() ?>>
<?= $Page->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KK_NO->Visible) { // KK_NO ?>
    <tr id="r_KK_NO">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_KK_NO"><?= $Page->KK_NO->caption() ?></span></td>
        <td data-name="KK_NO" <?= $Page->KK_NO->cellAttributes() ?>>
<span id="el_PASIEN_KK_NO" data-page="1">
<span<?= $Page->KK_NO->viewAttributes() ?>>
<?= $Page->KK_NO->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
    <tr id="r_PLACE_OF_BIRTH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_PLACE_OF_BIRTH"><?= $Page->PLACE_OF_BIRTH->caption() ?></span></td>
        <td data-name="PLACE_OF_BIRTH" <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el_PASIEN_PLACE_OF_BIRTH" data-page="1">
<span<?= $Page->PLACE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->PLACE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
    <tr id="r_DATE_OF_BIRTH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_DATE_OF_BIRTH"><?= $Page->DATE_OF_BIRTH->caption() ?></span></td>
        <td data-name="DATE_OF_BIRTH" <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el_PASIEN_DATE_OF_BIRTH" data-page="1">
<span<?= $Page->DATE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->DATE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <tr id="r_GENDER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_GENDER"><?= $Page->GENDER->caption() ?></span></td>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_PASIEN_GENDER" data-page="1">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
    <tr id="r_EDUCATION_TYPE_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_EDUCATION_TYPE_CODE"><?= $Page->EDUCATION_TYPE_CODE->caption() ?></span></td>
        <td data-name="EDUCATION_TYPE_CODE" <?= $Page->EDUCATION_TYPE_CODE->cellAttributes() ?>>
<span id="el_PASIEN_EDUCATION_TYPE_CODE" data-page="1">
<span<?= $Page->EDUCATION_TYPE_CODE->viewAttributes() ?>>
<?= $Page->EDUCATION_TYPE_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
    <tr id="r_MARITALSTATUSID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_MARITALSTATUSID"><?= $Page->MARITALSTATUSID->caption() ?></span></td>
        <td data-name="MARITALSTATUSID" <?= $Page->MARITALSTATUSID->cellAttributes() ?>>
<span id="el_PASIEN_MARITALSTATUSID" data-page="1">
<span<?= $Page->MARITALSTATUSID->viewAttributes() ?>>
<?= $Page->MARITALSTATUSID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <tr id="r_KODE_AGAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_KODE_AGAMA"><?= $Page->KODE_AGAMA->caption() ?></span></td>
        <td data-name="KODE_AGAMA" <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el_PASIEN_KODE_AGAMA" data-page="1">
<span<?= $Page->KODE_AGAMA->viewAttributes() ?>>
<?= $Page->KODE_AGAMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KAL_ID->Visible) { // KAL_ID ?>
    <tr id="r_KAL_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_KAL_ID"><?= $Page->KAL_ID->caption() ?></span></td>
        <td data-name="KAL_ID" <?= $Page->KAL_ID->cellAttributes() ?>>
<span id="el_PASIEN_KAL_ID" data-page="1">
<span<?= $Page->KAL_ID->viewAttributes() ?>>
<?= $Page->KAL_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->RT->Visible) { // RT ?>
    <tr id="r_RT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_RT"><?= $Page->RT->caption() ?></span></td>
        <td data-name="RT" <?= $Page->RT->cellAttributes() ?>>
<span id="el_PASIEN_RT" data-page="1">
<span<?= $Page->RT->viewAttributes() ?>>
<?= $Page->RT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->RW->Visible) { // RW ?>
    <tr id="r_RW">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_RW"><?= $Page->RW->caption() ?></span></td>
        <td data-name="RW" <?= $Page->RW->cellAttributes() ?>>
<span id="el_PASIEN_RW" data-page="1">
<span<?= $Page->RW->viewAttributes() ?>>
<?= $Page->RW->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
    <tr id="r_JOB_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_JOB_ID"><?= $Page->JOB_ID->caption() ?></span></td>
        <td data-name="JOB_ID" <?= $Page->JOB_ID->cellAttributes() ?>>
<span id="el_PASIEN_JOB_ID" data-page="1">
<span<?= $Page->JOB_ID->viewAttributes() ?>>
<?= $Page->JOB_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <tr id="r_STATUS_PASIEN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_STATUS_PASIEN_ID"><?= $Page->STATUS_PASIEN_ID->caption() ?></span></td>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_PASIEN_STATUS_PASIEN_ID" data-page="1">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
    <tr id="r_CONTACT_ADDRESS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_CONTACT_ADDRESS"><?= $Page->CONTACT_ADDRESS->caption() ?></span></td>
        <td data-name="CONTACT_ADDRESS" <?= $Page->CONTACT_ADDRESS->cellAttributes() ?>>
<span id="el_PASIEN_CONTACT_ADDRESS" data-page="1">
<span<?= $Page->CONTACT_ADDRESS->viewAttributes() ?>>
<?= $Page->CONTACT_ADDRESS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PHONE_NUMBER->Visible) { // PHONE_NUMBER ?>
    <tr id="r_PHONE_NUMBER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_PHONE_NUMBER"><?= $Page->PHONE_NUMBER->caption() ?></span></td>
        <td data-name="PHONE_NUMBER" <?= $Page->PHONE_NUMBER->cellAttributes() ?>>
<span id="el_PASIEN_PHONE_NUMBER" data-page="1">
<span<?= $Page->PHONE_NUMBER->viewAttributes() ?>>
<?= $Page->PHONE_NUMBER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { // MOBILE ?>
    <tr id="r_MOBILE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_MOBILE"><?= $Page->MOBILE->caption() ?></span></td>
        <td data-name="MOBILE" <?= $Page->MOBILE->cellAttributes() ?>>
<span id="el_PASIEN_MOBILE" data-page="1">
<span<?= $Page->MOBILE->viewAttributes() ?>>
<?= $Page->MOBILE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
    <tr id="r__EMAIL">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN__EMAIL"><?= $Page->_EMAIL->caption() ?></span></td>
        <td data-name="_EMAIL" <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el_PASIEN__EMAIL" data-page="1">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->POSTAL_CODE->Visible) { // POSTAL_CODE ?>
    <tr id="r_POSTAL_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_POSTAL_CODE"><?= $Page->POSTAL_CODE->caption() ?></span></td>
        <td data-name="POSTAL_CODE" <?= $Page->POSTAL_CODE->cellAttributes() ?>>
<span id="el_PASIEN_POSTAL_CODE" data-page="1">
<span<?= $Page->POSTAL_CODE->viewAttributes() ?>>
<?= $Page->POSTAL_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BLOOD_TYPE_ID->Visible) { // BLOOD_TYPE_ID ?>
    <tr id="r_BLOOD_TYPE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_BLOOD_TYPE_ID"><?= $Page->BLOOD_TYPE_ID->caption() ?></span></td>
        <td data-name="BLOOD_TYPE_ID" <?= $Page->BLOOD_TYPE_ID->cellAttributes() ?>>
<span id="el_PASIEN_BLOOD_TYPE_ID" data-page="1">
<span<?= $Page->BLOOD_TYPE_ID->viewAttributes() ?>>
<?= $Page->BLOOD_TYPE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <tr id="r_PAYOR_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_PAYOR_ID"><?= $Page->PAYOR_ID->caption() ?></span></td>
        <td data-name="PAYOR_ID" <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el_PASIEN_PAYOR_ID" data-page="1">
<span<?= $Page->PAYOR_ID->viewAttributes() ?>>
<?= $Page->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MOTHER->Visible) { // MOTHER ?>
    <tr id="r_MOTHER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_MOTHER"><?= $Page->MOTHER->caption() ?></span></td>
        <td data-name="MOTHER" <?= $Page->MOTHER->cellAttributes() ?>>
<span id="el_PASIEN_MOTHER" data-page="1">
<span<?= $Page->MOTHER->viewAttributes() ?>>
<?= $Page->MOTHER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FATHER->Visible) { // FATHER ?>
    <tr id="r_FATHER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_FATHER"><?= $Page->FATHER->caption() ?></span></td>
        <td data-name="FATHER" <?= $Page->FATHER->cellAttributes() ?>>
<span id="el_PASIEN_FATHER" data-page="1">
<span<?= $Page->FATHER->viewAttributes() ?>>
<?= $Page->FATHER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SPOUSE->Visible) { // SPOUSE ?>
    <tr id="r_SPOUSE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_SPOUSE"><?= $Page->SPOUSE->caption() ?></span></td>
        <td data-name="SPOUSE" <?= $Page->SPOUSE->cellAttributes() ?>>
<span id="el_PASIEN_SPOUSE" data-page="1">
<span<?= $Page->SPOUSE->viewAttributes() ?>>
<?= $Page->SPOUSE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
    <tr id="r_ORG_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_ORG_ID"><?= $Page->ORG_ID->caption() ?></span></td>
        <td data-name="ORG_ID" <?= $Page->ORG_ID->cellAttributes() ?>>
<span id="el_PASIEN_ORG_ID" data-page="1">
<span<?= $Page->ORG_ID->viewAttributes() ?>>
<?= $Page->ORG_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->AKTIF->Visible) { // AKTIF ?>
    <tr id="r_AKTIF">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_AKTIF"><?= $Page->AKTIF->caption() ?></span></td>
        <td data-name="AKTIF" <?= $Page->AKTIF->cellAttributes() ?>>
<span id="el_PASIEN_AKTIF" data-page="1">
<span<?= $Page->AKTIF->viewAttributes() ?>>
<?= $Page->AKTIF->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <tr id="r_CLASS_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_CLASS_ID"><?= $Page->CLASS_ID->caption() ?></span></td>
        <td data-name="CLASS_ID" <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_PASIEN_CLASS_ID" data-page="1">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <tr id="r_COVERAGE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_COVERAGE_ID"><?= $Page->COVERAGE_ID->caption() ?></span></td>
        <td data-name="COVERAGE_ID" <?= $Page->COVERAGE_ID->cellAttributes() ?>>
<span id="el_PASIEN_COVERAGE_ID" data-page="1">
<span<?= $Page->COVERAGE_ID->viewAttributes() ?>>
<?= $Page->COVERAGE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
    <tr id="r_FAMILY_STATUS_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_FAMILY_STATUS_ID"><?= $Page->FAMILY_STATUS_ID->caption() ?></span></td>
        <td data-name="FAMILY_STATUS_ID" <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el_PASIEN_FAMILY_STATUS_ID" data-page="1">
<span<?= $Page->FAMILY_STATUS_ID->viewAttributes() ?>>
<?= $Page->FAMILY_STATUS_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TMT->Visible) { // TMT ?>
    <tr id="r_TMT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_TMT"><?= $Page->TMT->caption() ?></span></td>
        <td data-name="TMT" <?= $Page->TMT->cellAttributes() ?>>
<span id="el_PASIEN_TMT" data-page="1">
<span<?= $Page->TMT->viewAttributes() ?>>
<?= $Page->TMT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TAT->Visible) { // TAT ?>
    <tr id="r_TAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_TAT"><?= $Page->TAT->caption() ?></span></td>
        <td data-name="TAT" <?= $Page->TAT->cellAttributes() ?>>
<span id="el_PASIEN_TAT" data-page="1">
<span<?= $Page->TAT->viewAttributes() ?>>
<?= $Page->TAT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
    <tr id="r_REGISTRATION_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_REGISTRATION_DATE"><?= $Page->REGISTRATION_DATE->caption() ?></span></td>
        <td data-name="REGISTRATION_DATE" <?= $Page->REGISTRATION_DATE->cellAttributes() ?>>
<span id="el_PASIEN_REGISTRATION_DATE" data-page="1">
<span<?= $Page->REGISTRATION_DATE->viewAttributes() ?>>
<?= $Page->REGISTRATION_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MEDICAL_NOTES->Visible) { // MEDICAL_NOTES ?>
    <tr id="r_MEDICAL_NOTES">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_PASIEN_MEDICAL_NOTES"><?= $Page->MEDICAL_NOTES->caption() ?></span></td>
        <td data-name="MEDICAL_NOTES" <?= $Page->MEDICAL_NOTES->cellAttributes() ?>>
<span id="el_PASIEN_MEDICAL_NOTES" data-page="1">
<span<?= $Page->MEDICAL_NOTES->viewAttributes() ?>>
<?= $Page->MEDICAL_NOTES->getViewValue() ?></span>
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
