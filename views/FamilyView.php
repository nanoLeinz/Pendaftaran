<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$FamilyView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fFAMILYview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fFAMILYview = currentForm = new ew.Form("fFAMILYview", "view");
    loadjs.done("fFAMILYview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.FAMILY) ew.vars.tables.FAMILY = <?= JsonEncode(GetClientVar("tables", "FAMILY")) ?>;
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
<form name="fFAMILYview" id="fFAMILYview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="FAMILY">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <tr id="r_ORG_UNIT_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></td>
        <td data-name="ORG_UNIT_CODE" <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_FAMILY_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <tr id="r_NO_REGISTRATION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></td>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_FAMILY_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FAMILY_ID->Visible) { // FAMILY_ID ?>
    <tr id="r_FAMILY_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_FAMILY_ID"><?= $Page->FAMILY_ID->caption() ?></span></td>
        <td data-name="FAMILY_ID" <?= $Page->FAMILY_ID->cellAttributes() ?>>
<span id="el_FAMILY_FAMILY_ID">
<span<?= $Page->FAMILY_ID->viewAttributes() ?>>
<?= $Page->FAMILY_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
    <tr id="r_FAMILY_STATUS_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_FAMILY_STATUS_ID"><?= $Page->FAMILY_STATUS_ID->caption() ?></span></td>
        <td data-name="FAMILY_STATUS_ID" <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el_FAMILY_FAMILY_STATUS_ID">
<span<?= $Page->FAMILY_STATUS_ID->viewAttributes() ?>>
<?= $Page->FAMILY_STATUS_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_REGISTRATION2->Visible) { // NO_REGISTRATION2 ?>
    <tr id="r_NO_REGISTRATION2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_NO_REGISTRATION2"><?= $Page->NO_REGISTRATION2->caption() ?></span></td>
        <td data-name="NO_REGISTRATION2" <?= $Page->NO_REGISTRATION2->cellAttributes() ?>>
<span id="el_FAMILY_NO_REGISTRATION2">
<span<?= $Page->NO_REGISTRATION2->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
    <tr id="r_FULLNAME">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_FULLNAME"><?= $Page->FULLNAME->caption() ?></span></td>
        <td data-name="FULLNAME" <?= $Page->FULLNAME->cellAttributes() ?>>
<span id="el_FAMILY_FULLNAME">
<span<?= $Page->FULLNAME->viewAttributes() ?>>
<?= $Page->FULLNAME->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ISRESPONSIBLE->Visible) { // ISRESPONSIBLE ?>
    <tr id="r_ISRESPONSIBLE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_ISRESPONSIBLE"><?= $Page->ISRESPONSIBLE->caption() ?></span></td>
        <td data-name="ISRESPONSIBLE" <?= $Page->ISRESPONSIBLE->cellAttributes() ?>>
<span id="el_FAMILY_ISRESPONSIBLE">
<span<?= $Page->ISRESPONSIBLE->viewAttributes() ?>>
<?= $Page->ISRESPONSIBLE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <tr id="r_GENDER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_GENDER"><?= $Page->GENDER->caption() ?></span></td>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_FAMILY_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
    <tr id="r_DATE_OF_BIRTH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_DATE_OF_BIRTH"><?= $Page->DATE_OF_BIRTH->caption() ?></span></td>
        <td data-name="DATE_OF_BIRTH" <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el_FAMILY_DATE_OF_BIRTH">
<span<?= $Page->DATE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->DATE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
    <tr id="r_PLACE_OF_BIRTH">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_PLACE_OF_BIRTH"><?= $Page->PLACE_OF_BIRTH->caption() ?></span></td>
        <td data-name="PLACE_OF_BIRTH" <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el_FAMILY_PLACE_OF_BIRTH">
<span<?= $Page->PLACE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->PLACE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <tr id="r_KODE_AGAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_KODE_AGAMA"><?= $Page->KODE_AGAMA->caption() ?></span></td>
        <td data-name="KODE_AGAMA" <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el_FAMILY_KODE_AGAMA">
<span<?= $Page->KODE_AGAMA->viewAttributes() ?>>
<?= $Page->KODE_AGAMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
    <tr id="r_EDUCATION_TYPE_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_EDUCATION_TYPE_CODE"><?= $Page->EDUCATION_TYPE_CODE->caption() ?></span></td>
        <td data-name="EDUCATION_TYPE_CODE" <?= $Page->EDUCATION_TYPE_CODE->cellAttributes() ?>>
<span id="el_FAMILY_EDUCATION_TYPE_CODE">
<span<?= $Page->EDUCATION_TYPE_CODE->viewAttributes() ?>>
<?= $Page->EDUCATION_TYPE_CODE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
    <tr id="r_JOB_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_JOB_ID"><?= $Page->JOB_ID->caption() ?></span></td>
        <td data-name="JOB_ID" <?= $Page->JOB_ID->cellAttributes() ?>>
<span id="el_FAMILY_JOB_ID">
<span<?= $Page->JOB_ID->viewAttributes() ?>>
<?= $Page->JOB_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BLOOD_ID->Visible) { // BLOOD_ID ?>
    <tr id="r_BLOOD_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_BLOOD_ID"><?= $Page->BLOOD_ID->caption() ?></span></td>
        <td data-name="BLOOD_ID" <?= $Page->BLOOD_ID->cellAttributes() ?>>
<span id="el_FAMILY_BLOOD_ID">
<span<?= $Page->BLOOD_ID->viewAttributes() ?>>
<?= $Page->BLOOD_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
    <tr id="r_MARITALSTATUSID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_MARITALSTATUSID"><?= $Page->MARITALSTATUSID->caption() ?></span></td>
        <td data-name="MARITALSTATUSID" <?= $Page->MARITALSTATUSID->cellAttributes() ?>>
<span id="el_FAMILY_MARITALSTATUSID">
<span<?= $Page->MARITALSTATUSID->viewAttributes() ?>>
<?= $Page->MARITALSTATUSID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
    <tr id="r_ADDRESS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_ADDRESS"><?= $Page->ADDRESS->caption() ?></span></td>
        <td data-name="ADDRESS" <?= $Page->ADDRESS->cellAttributes() ?>>
<span id="el_FAMILY_ADDRESS">
<span<?= $Page->ADDRESS->viewAttributes() ?>>
<?= $Page->ADDRESS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KOTA->Visible) { // KOTA ?>
    <tr id="r_KOTA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_KOTA"><?= $Page->KOTA->caption() ?></span></td>
        <td data-name="KOTA" <?= $Page->KOTA->cellAttributes() ?>>
<span id="el_FAMILY_KOTA">
<span<?= $Page->KOTA->viewAttributes() ?>>
<?= $Page->KOTA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->RT->Visible) { // RT ?>
    <tr id="r_RT">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_RT"><?= $Page->RT->caption() ?></span></td>
        <td data-name="RT" <?= $Page->RT->cellAttributes() ?>>
<span id="el_FAMILY_RT">
<span<?= $Page->RT->viewAttributes() ?>>
<?= $Page->RT->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->RW->Visible) { // RW ?>
    <tr id="r_RW">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_RW"><?= $Page->RW->caption() ?></span></td>
        <td data-name="RW" <?= $Page->RW->cellAttributes() ?>>
<span id="el_FAMILY_RW">
<span<?= $Page->RW->viewAttributes() ?>>
<?= $Page->RW->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
    <tr id="r_PHONE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_PHONE"><?= $Page->PHONE->caption() ?></span></td>
        <td data-name="PHONE" <?= $Page->PHONE->cellAttributes() ?>>
<span id="el_FAMILY_PHONE">
<span<?= $Page->PHONE->viewAttributes() ?>>
<?= $Page->PHONE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { // MOBILE ?>
    <tr id="r_MOBILE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_MOBILE"><?= $Page->MOBILE->caption() ?></span></td>
        <td data-name="MOBILE" <?= $Page->MOBILE->cellAttributes() ?>>
<span id="el_FAMILY_MOBILE">
<span<?= $Page->MOBILE->viewAttributes() ?>>
<?= $Page->MOBILE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
    <tr id="r_FAX">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_FAX"><?= $Page->FAX->caption() ?></span></td>
        <td data-name="FAX" <?= $Page->FAX->cellAttributes() ?>>
<span id="el_FAMILY_FAX">
<span<?= $Page->FAX->viewAttributes() ?>>
<?= $Page->FAX->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
    <tr id="r__EMAIL">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY__EMAIL"><?= $Page->_EMAIL->caption() ?></span></td>
        <td data-name="_EMAIL" <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el_FAMILY__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <tr id="r_DESCRIPTION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_DESCRIPTION"><?= $Page->DESCRIPTION->caption() ?></span></td>
        <td data-name="DESCRIPTION" <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_FAMILY_DESCRIPTION">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
    <tr id="r_MODIFIED_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_MODIFIED_DATE"><?= $Page->MODIFIED_DATE->caption() ?></span></td>
        <td data-name="MODIFIED_DATE" <?= $Page->MODIFIED_DATE->cellAttributes() ?>>
<span id="el_FAMILY_MODIFIED_DATE">
<span<?= $Page->MODIFIED_DATE->viewAttributes() ?>>
<?= $Page->MODIFIED_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
    <tr id="r_MODIFIED_BY">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_MODIFIED_BY"><?= $Page->MODIFIED_BY->caption() ?></span></td>
        <td data-name="MODIFIED_BY" <?= $Page->MODIFIED_BY->cellAttributes() ?>>
<span id="el_FAMILY_MODIFIED_BY">
<span<?= $Page->MODIFIED_BY->viewAttributes() ?>>
<?= $Page->MODIFIED_BY->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
    <tr id="r_MODIFIED_FROM">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_MODIFIED_FROM"><?= $Page->MODIFIED_FROM->caption() ?></span></td>
        <td data-name="MODIFIED_FROM" <?= $Page->MODIFIED_FROM->cellAttributes() ?>>
<span id="el_FAMILY_MODIFIED_FROM">
<span<?= $Page->MODIFIED_FROM->viewAttributes() ?>>
<?= $Page->MODIFIED_FROM->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->COUNTRY_CODE->Visible) { // COUNTRY_CODE ?>
    <tr id="r_COUNTRY_CODE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_FAMILY_COUNTRY_CODE"><?= $Page->COUNTRY_CODE->caption() ?></span></td>
        <td data-name="COUNTRY_CODE" <?= $Page->COUNTRY_CODE->cellAttributes() ?>>
<span id="el_FAMILY_COUNTRY_CODE">
<span<?= $Page->COUNTRY_CODE->viewAttributes() ?>>
<?= $Page->COUNTRY_CODE->getViewValue() ?></span>
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
