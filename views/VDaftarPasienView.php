<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VDaftarPasienView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_DAFTAR_PASIENview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fV_DAFTAR_PASIENview = currentForm = new ew.Form("fV_DAFTAR_PASIENview", "view");
    loadjs.done("fV_DAFTAR_PASIENview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.V_DAFTAR_PASIEN) ew.vars.tables.V_DAFTAR_PASIEN = <?= JsonEncode(GetClientVar("tables", "V_DAFTAR_PASIEN")) ?>;
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
<form name="fV_DAFTAR_PASIENview" id="fV_DAFTAR_PASIENview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_DAFTAR_PASIEN">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <tr id="r_ORG_UNIT_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></td>
        <td data-name="ORG_UNIT_CODE" <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <tr id="r_NO_REGISTRATION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></td>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
    <tr id="r_PASIEN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_PASIEN_ID"><?= $Page->PASIEN_ID->caption() ?></span></td>
        <td data-name="PASIEN_ID" <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_PASIEN_ID">
<span<?= $Page->PASIEN_ID->viewAttributes() ?>>
<?= $Page->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KK_NO->Visible) { // KK_NO ?>
    <tr id="r_KK_NO">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_KK_NO"><?= $Page->KK_NO->caption() ?></span></td>
        <td data-name="KK_NO" <?= $Page->KK_NO->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_KK_NO">
<span<?= $Page->KK_NO->viewAttributes() ?>>
<?= $Page->KK_NO->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
    <tr id="r_NAME_OF_PASIEN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_NAME_OF_PASIEN"><?= $Page->NAME_OF_PASIEN->caption() ?></span></td>
        <td data-name="NAME_OF_PASIEN" <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_NAME_OF_PASIEN">
<span<?= $Page->NAME_OF_PASIEN->viewAttributes() ?>>
<?= $Page->NAME_OF_PASIEN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
    <tr id="r_PLACE_OF_BIRTH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_PLACE_OF_BIRTH"><?= $Page->PLACE_OF_BIRTH->caption() ?></span></td>
        <td data-name="PLACE_OF_BIRTH" <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_PLACE_OF_BIRTH">
<span<?= $Page->PLACE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->PLACE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
    <tr id="r_DATE_OF_BIRTH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_DATE_OF_BIRTH"><?= $Page->DATE_OF_BIRTH->caption() ?></span></td>
        <td data-name="DATE_OF_BIRTH" <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_DATE_OF_BIRTH">
<span<?= $Page->DATE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->DATE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <tr id="r_GENDER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_GENDER"><?= $Page->GENDER->caption() ?></span></td>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
    <tr id="r_EDUCATION_TYPE_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_EDUCATION_TYPE_CODE"><?= $Page->EDUCATION_TYPE_CODE->caption() ?></span></td>
        <td data-name="EDUCATION_TYPE_CODE" <?= $Page->EDUCATION_TYPE_CODE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_EDUCATION_TYPE_CODE">
<span<?= $Page->EDUCATION_TYPE_CODE->viewAttributes() ?>>
<?= $Page->EDUCATION_TYPE_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
    <tr id="r_MARITALSTATUSID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_MARITALSTATUSID"><?= $Page->MARITALSTATUSID->caption() ?></span></td>
        <td data-name="MARITALSTATUSID" <?= $Page->MARITALSTATUSID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_MARITALSTATUSID">
<span<?= $Page->MARITALSTATUSID->viewAttributes() ?>>
<?= $Page->MARITALSTATUSID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <tr id="r_KODE_AGAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_KODE_AGAMA"><?= $Page->KODE_AGAMA->caption() ?></span></td>
        <td data-name="KODE_AGAMA" <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_KODE_AGAMA">
<span<?= $Page->KODE_AGAMA->viewAttributes() ?>>
<?= $Page->KODE_AGAMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KAL_ID->Visible) { // KAL_ID ?>
    <tr id="r_KAL_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_KAL_ID"><?= $Page->KAL_ID->caption() ?></span></td>
        <td data-name="KAL_ID" <?= $Page->KAL_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_KAL_ID">
<span<?= $Page->KAL_ID->viewAttributes() ?>>
<?= $Page->KAL_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
    <tr id="r_JOB_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_JOB_ID"><?= $Page->JOB_ID->caption() ?></span></td>
        <td data-name="JOB_ID" <?= $Page->JOB_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_JOB_ID">
<span<?= $Page->JOB_ID->viewAttributes() ?>>
<?= $Page->JOB_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <tr id="r_STATUS_PASIEN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_STATUS_PASIEN_ID"><?= $Page->STATUS_PASIEN_ID->caption() ?></span></td>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_STATUS_PASIEN_ID">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ANAK_KE->Visible) { // ANAK_KE ?>
    <tr id="r_ANAK_KE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_ANAK_KE"><?= $Page->ANAK_KE->caption() ?></span></td>
        <td data-name="ANAK_KE" <?= $Page->ANAK_KE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_ANAK_KE">
<span<?= $Page->ANAK_KE->viewAttributes() ?>>
<?= $Page->ANAK_KE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
    <tr id="r_CONTACT_ADDRESS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_CONTACT_ADDRESS"><?= $Page->CONTACT_ADDRESS->caption() ?></span></td>
        <td data-name="CONTACT_ADDRESS" <?= $Page->CONTACT_ADDRESS->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_CONTACT_ADDRESS">
<span<?= $Page->CONTACT_ADDRESS->viewAttributes() ?>>
<?= $Page->CONTACT_ADDRESS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PHONE_NUMBER->Visible) { // PHONE_NUMBER ?>
    <tr id="r_PHONE_NUMBER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_PHONE_NUMBER"><?= $Page->PHONE_NUMBER->caption() ?></span></td>
        <td data-name="PHONE_NUMBER" <?= $Page->PHONE_NUMBER->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_PHONE_NUMBER">
<span<?= $Page->PHONE_NUMBER->viewAttributes() ?>>
<?= $Page->PHONE_NUMBER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
    <tr id="r_REGISTRATION_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_REGISTRATION_DATE"><?= $Page->REGISTRATION_DATE->caption() ?></span></td>
        <td data-name="REGISTRATION_DATE" <?= $Page->REGISTRATION_DATE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_REGISTRATION_DATE">
<span<?= $Page->REGISTRATION_DATE->viewAttributes() ?>>
<?= $Page->REGISTRATION_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <tr id="r_PAYOR_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_PAYOR_ID"><?= $Page->PAYOR_ID->caption() ?></span></td>
        <td data-name="PAYOR_ID" <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_PAYOR_ID">
<span<?= $Page->PAYOR_ID->viewAttributes() ?>>
<?= $Page->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <tr id="r_CLASS_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_CLASS_ID"><?= $Page->CLASS_ID->caption() ?></span></td>
        <td data-name="CLASS_ID" <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_CLASS_ID">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <tr id="r_COVERAGE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_COVERAGE_ID"><?= $Page->COVERAGE_ID->caption() ?></span></td>
        <td data-name="COVERAGE_ID" <?= $Page->COVERAGE_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_COVERAGE_ID">
<span<?= $Page->COVERAGE_ID->viewAttributes() ?>>
<?= $Page->COVERAGE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MOTHER->Visible) { // MOTHER ?>
    <tr id="r_MOTHER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_MOTHER"><?= $Page->MOTHER->caption() ?></span></td>
        <td data-name="MOTHER" <?= $Page->MOTHER->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_MOTHER">
<span<?= $Page->MOTHER->viewAttributes() ?>>
<?= $Page->MOTHER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FATHER->Visible) { // FATHER ?>
    <tr id="r_FATHER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_FATHER"><?= $Page->FATHER->caption() ?></span></td>
        <td data-name="FATHER" <?= $Page->FATHER->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_FATHER">
<span<?= $Page->FATHER->viewAttributes() ?>>
<?= $Page->FATHER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SPOUSE->Visible) { // SPOUSE ?>
    <tr id="r_SPOUSE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_SPOUSE"><?= $Page->SPOUSE->caption() ?></span></td>
        <td data-name="SPOUSE" <?= $Page->SPOUSE->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_SPOUSE">
<span<?= $Page->SPOUSE->viewAttributes() ?>>
<?= $Page->SPOUSE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->AKTIF->Visible) { // AKTIF ?>
    <tr id="r_AKTIF">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_AKTIF"><?= $Page->AKTIF->caption() ?></span></td>
        <td data-name="AKTIF" <?= $Page->AKTIF->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_AKTIF">
<span<?= $Page->AKTIF->viewAttributes() ?>>
<?= $Page->AKTIF->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TMT->Visible) { // TMT ?>
    <tr id="r_TMT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_TMT"><?= $Page->TMT->caption() ?></span></td>
        <td data-name="TMT" <?= $Page->TMT->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_TMT">
<span<?= $Page->TMT->viewAttributes() ?>>
<?= $Page->TMT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->TAT->Visible) { // TAT ?>
    <tr id="r_TAT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_TAT"><?= $Page->TAT->caption() ?></span></td>
        <td data-name="TAT" <?= $Page->TAT->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_TAT">
<span<?= $Page->TAT->viewAttributes() ?>>
<?= $Page->TAT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CARD_ID->Visible) { // CARD_ID ?>
    <tr id="r_CARD_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_CARD_ID"><?= $Page->CARD_ID->caption() ?></span></td>
        <td data-name="CARD_ID" <?= $Page->CARD_ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_CARD_ID">
<span<?= $Page->CARD_ID->viewAttributes() ?>>
<?= $Page->CARD_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
    <tr id="r_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_ID"><?= $Page->ID->caption() ?></span></td>
        <td data-name="ID" <?= $Page->ID->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<?= $Page->ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->newapp->Visible) { // newapp ?>
    <tr id="r_newapp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_DAFTAR_PASIEN_newapp"><?= $Page->newapp->caption() ?></span></td>
        <td data-name="newapp" <?= $Page->newapp->cellAttributes() ?>>
<span id="el_V_DAFTAR_PASIEN_newapp">
<span<?= $Page->newapp->viewAttributes() ?>>
<?= $Page->newapp->getViewValue() ?></span>
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
