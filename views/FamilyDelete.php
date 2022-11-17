<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$FamilyDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fFAMILYdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fFAMILYdelete = currentForm = new ew.Form("fFAMILYdelete", "delete");
    loadjs.done("fFAMILYdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.FAMILY) ew.vars.tables.FAMILY = <?= JsonEncode(GetClientVar("tables", "FAMILY")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fFAMILYdelete" id="fFAMILYdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="FAMILY">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <th class="<?= $Page->ORG_UNIT_CODE->headerCellClass() ?>"><span id="elh_FAMILY_ORG_UNIT_CODE" class="FAMILY_ORG_UNIT_CODE"><?= $Page->ORG_UNIT_CODE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <th class="<?= $Page->NO_REGISTRATION->headerCellClass() ?>"><span id="elh_FAMILY_NO_REGISTRATION" class="FAMILY_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FAMILY_ID->Visible) { // FAMILY_ID ?>
        <th class="<?= $Page->FAMILY_ID->headerCellClass() ?>"><span id="elh_FAMILY_FAMILY_ID" class="FAMILY_FAMILY_ID"><?= $Page->FAMILY_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
        <th class="<?= $Page->FAMILY_STATUS_ID->headerCellClass() ?>"><span id="elh_FAMILY_FAMILY_STATUS_ID" class="FAMILY_FAMILY_STATUS_ID"><?= $Page->FAMILY_STATUS_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_REGISTRATION2->Visible) { // NO_REGISTRATION2 ?>
        <th class="<?= $Page->NO_REGISTRATION2->headerCellClass() ?>"><span id="elh_FAMILY_NO_REGISTRATION2" class="FAMILY_NO_REGISTRATION2"><?= $Page->NO_REGISTRATION2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
        <th class="<?= $Page->FULLNAME->headerCellClass() ?>"><span id="elh_FAMILY_FULLNAME" class="FAMILY_FULLNAME"><?= $Page->FULLNAME->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ISRESPONSIBLE->Visible) { // ISRESPONSIBLE ?>
        <th class="<?= $Page->ISRESPONSIBLE->headerCellClass() ?>"><span id="elh_FAMILY_ISRESPONSIBLE" class="FAMILY_ISRESPONSIBLE"><?= $Page->ISRESPONSIBLE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <th class="<?= $Page->GENDER->headerCellClass() ?>"><span id="elh_FAMILY_GENDER" class="FAMILY_GENDER"><?= $Page->GENDER->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
        <th class="<?= $Page->DATE_OF_BIRTH->headerCellClass() ?>"><span id="elh_FAMILY_DATE_OF_BIRTH" class="FAMILY_DATE_OF_BIRTH"><?= $Page->DATE_OF_BIRTH->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
        <th class="<?= $Page->PLACE_OF_BIRTH->headerCellClass() ?>"><span id="elh_FAMILY_PLACE_OF_BIRTH" class="FAMILY_PLACE_OF_BIRTH"><?= $Page->PLACE_OF_BIRTH->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
        <th class="<?= $Page->KODE_AGAMA->headerCellClass() ?>"><span id="elh_FAMILY_KODE_AGAMA" class="FAMILY_KODE_AGAMA"><?= $Page->KODE_AGAMA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
        <th class="<?= $Page->EDUCATION_TYPE_CODE->headerCellClass() ?>"><span id="elh_FAMILY_EDUCATION_TYPE_CODE" class="FAMILY_EDUCATION_TYPE_CODE"><?= $Page->EDUCATION_TYPE_CODE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
        <th class="<?= $Page->JOB_ID->headerCellClass() ?>"><span id="elh_FAMILY_JOB_ID" class="FAMILY_JOB_ID"><?= $Page->JOB_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->BLOOD_ID->Visible) { // BLOOD_ID ?>
        <th class="<?= $Page->BLOOD_ID->headerCellClass() ?>"><span id="elh_FAMILY_BLOOD_ID" class="FAMILY_BLOOD_ID"><?= $Page->BLOOD_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
        <th class="<?= $Page->MARITALSTATUSID->headerCellClass() ?>"><span id="elh_FAMILY_MARITALSTATUSID" class="FAMILY_MARITALSTATUSID"><?= $Page->MARITALSTATUSID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
        <th class="<?= $Page->ADDRESS->headerCellClass() ?>"><span id="elh_FAMILY_ADDRESS" class="FAMILY_ADDRESS"><?= $Page->ADDRESS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KOTA->Visible) { // KOTA ?>
        <th class="<?= $Page->KOTA->headerCellClass() ?>"><span id="elh_FAMILY_KOTA" class="FAMILY_KOTA"><?= $Page->KOTA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->RT->Visible) { // RT ?>
        <th class="<?= $Page->RT->headerCellClass() ?>"><span id="elh_FAMILY_RT" class="FAMILY_RT"><?= $Page->RT->caption() ?></span></th>
<?php } ?>
<?php if ($Page->RW->Visible) { // RW ?>
        <th class="<?= $Page->RW->headerCellClass() ?>"><span id="elh_FAMILY_RW" class="FAMILY_RW"><?= $Page->RW->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
        <th class="<?= $Page->PHONE->headerCellClass() ?>"><span id="elh_FAMILY_PHONE" class="FAMILY_PHONE"><?= $Page->PHONE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { // MOBILE ?>
        <th class="<?= $Page->MOBILE->headerCellClass() ?>"><span id="elh_FAMILY_MOBILE" class="FAMILY_MOBILE"><?= $Page->MOBILE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
        <th class="<?= $Page->FAX->headerCellClass() ?>"><span id="elh_FAMILY_FAX" class="FAMILY_FAX"><?= $Page->FAX->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <th class="<?= $Page->_EMAIL->headerCellClass() ?>"><span id="elh_FAMILY__EMAIL" class="FAMILY__EMAIL"><?= $Page->_EMAIL->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <th class="<?= $Page->DESCRIPTION->headerCellClass() ?>"><span id="elh_FAMILY_DESCRIPTION" class="FAMILY_DESCRIPTION"><?= $Page->DESCRIPTION->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
        <th class="<?= $Page->MODIFIED_DATE->headerCellClass() ?>"><span id="elh_FAMILY_MODIFIED_DATE" class="FAMILY_MODIFIED_DATE"><?= $Page->MODIFIED_DATE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
        <th class="<?= $Page->MODIFIED_BY->headerCellClass() ?>"><span id="elh_FAMILY_MODIFIED_BY" class="FAMILY_MODIFIED_BY"><?= $Page->MODIFIED_BY->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
        <th class="<?= $Page->MODIFIED_FROM->headerCellClass() ?>"><span id="elh_FAMILY_MODIFIED_FROM" class="FAMILY_MODIFIED_FROM"><?= $Page->MODIFIED_FROM->caption() ?></span></th>
<?php } ?>
<?php if ($Page->COUNTRY_CODE->Visible) { // COUNTRY_CODE ?>
        <th class="<?= $Page->COUNTRY_CODE->headerCellClass() ?>"><span id="elh_FAMILY_COUNTRY_CODE" class="FAMILY_COUNTRY_CODE"><?= $Page->COUNTRY_CODE->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
        <td <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_ORG_UNIT_CODE" class="FAMILY_ORG_UNIT_CODE">
<span<?= $Page->ORG_UNIT_CODE->viewAttributes() ?>>
<?= $Page->ORG_UNIT_CODE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <td <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_NO_REGISTRATION" class="FAMILY_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FAMILY_ID->Visible) { // FAMILY_ID ?>
        <td <?= $Page->FAMILY_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_FAMILY_ID" class="FAMILY_FAMILY_ID">
<span<?= $Page->FAMILY_ID->viewAttributes() ?>>
<?= $Page->FAMILY_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
        <td <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_FAMILY_STATUS_ID" class="FAMILY_FAMILY_STATUS_ID">
<span<?= $Page->FAMILY_STATUS_ID->viewAttributes() ?>>
<?= $Page->FAMILY_STATUS_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_REGISTRATION2->Visible) { // NO_REGISTRATION2 ?>
        <td <?= $Page->NO_REGISTRATION2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_NO_REGISTRATION2" class="FAMILY_NO_REGISTRATION2">
<span<?= $Page->NO_REGISTRATION2->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
        <td <?= $Page->FULLNAME->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_FULLNAME" class="FAMILY_FULLNAME">
<span<?= $Page->FULLNAME->viewAttributes() ?>>
<?= $Page->FULLNAME->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ISRESPONSIBLE->Visible) { // ISRESPONSIBLE ?>
        <td <?= $Page->ISRESPONSIBLE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_ISRESPONSIBLE" class="FAMILY_ISRESPONSIBLE">
<span<?= $Page->ISRESPONSIBLE->viewAttributes() ?>>
<?= $Page->ISRESPONSIBLE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
        <td <?= $Page->GENDER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_GENDER" class="FAMILY_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DATE_OF_BIRTH->Visible) { // DATE_OF_BIRTH ?>
        <td <?= $Page->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_DATE_OF_BIRTH" class="FAMILY_DATE_OF_BIRTH">
<span<?= $Page->DATE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->DATE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PLACE_OF_BIRTH->Visible) { // PLACE_OF_BIRTH ?>
        <td <?= $Page->PLACE_OF_BIRTH->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_PLACE_OF_BIRTH" class="FAMILY_PLACE_OF_BIRTH">
<span<?= $Page->PLACE_OF_BIRTH->viewAttributes() ?>>
<?= $Page->PLACE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
        <td <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_KODE_AGAMA" class="FAMILY_KODE_AGAMA">
<span<?= $Page->KODE_AGAMA->viewAttributes() ?>>
<?= $Page->KODE_AGAMA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->EDUCATION_TYPE_CODE->Visible) { // EDUCATION_TYPE_CODE ?>
        <td <?= $Page->EDUCATION_TYPE_CODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_EDUCATION_TYPE_CODE" class="FAMILY_EDUCATION_TYPE_CODE">
<span<?= $Page->EDUCATION_TYPE_CODE->viewAttributes() ?>>
<?= $Page->EDUCATION_TYPE_CODE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->JOB_ID->Visible) { // JOB_ID ?>
        <td <?= $Page->JOB_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_JOB_ID" class="FAMILY_JOB_ID">
<span<?= $Page->JOB_ID->viewAttributes() ?>>
<?= $Page->JOB_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->BLOOD_ID->Visible) { // BLOOD_ID ?>
        <td <?= $Page->BLOOD_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_BLOOD_ID" class="FAMILY_BLOOD_ID">
<span<?= $Page->BLOOD_ID->viewAttributes() ?>>
<?= $Page->BLOOD_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MARITALSTATUSID->Visible) { // MARITALSTATUSID ?>
        <td <?= $Page->MARITALSTATUSID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MARITALSTATUSID" class="FAMILY_MARITALSTATUSID">
<span<?= $Page->MARITALSTATUSID->viewAttributes() ?>>
<?= $Page->MARITALSTATUSID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
        <td <?= $Page->ADDRESS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_ADDRESS" class="FAMILY_ADDRESS">
<span<?= $Page->ADDRESS->viewAttributes() ?>>
<?= $Page->ADDRESS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KOTA->Visible) { // KOTA ?>
        <td <?= $Page->KOTA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_KOTA" class="FAMILY_KOTA">
<span<?= $Page->KOTA->viewAttributes() ?>>
<?= $Page->KOTA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->RT->Visible) { // RT ?>
        <td <?= $Page->RT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_RT" class="FAMILY_RT">
<span<?= $Page->RT->viewAttributes() ?>>
<?= $Page->RT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->RW->Visible) { // RW ?>
        <td <?= $Page->RW->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_RW" class="FAMILY_RW">
<span<?= $Page->RW->viewAttributes() ?>>
<?= $Page->RW->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
        <td <?= $Page->PHONE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_PHONE" class="FAMILY_PHONE">
<span<?= $Page->PHONE->viewAttributes() ?>>
<?= $Page->PHONE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MOBILE->Visible) { // MOBILE ?>
        <td <?= $Page->MOBILE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MOBILE" class="FAMILY_MOBILE">
<span<?= $Page->MOBILE->viewAttributes() ?>>
<?= $Page->MOBILE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
        <td <?= $Page->FAX->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_FAX" class="FAMILY_FAX">
<span<?= $Page->FAX->viewAttributes() ?>>
<?= $Page->FAX->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <td <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY__EMAIL" class="FAMILY__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
        <td <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_DESCRIPTION" class="FAMILY_DESCRIPTION">
<span<?= $Page->DESCRIPTION->viewAttributes() ?>>
<?= $Page->DESCRIPTION->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
        <td <?= $Page->MODIFIED_DATE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MODIFIED_DATE" class="FAMILY_MODIFIED_DATE">
<span<?= $Page->MODIFIED_DATE->viewAttributes() ?>>
<?= $Page->MODIFIED_DATE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
        <td <?= $Page->MODIFIED_BY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MODIFIED_BY" class="FAMILY_MODIFIED_BY">
<span<?= $Page->MODIFIED_BY->viewAttributes() ?>>
<?= $Page->MODIFIED_BY->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
        <td <?= $Page->MODIFIED_FROM->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_MODIFIED_FROM" class="FAMILY_MODIFIED_FROM">
<span<?= $Page->MODIFIED_FROM->viewAttributes() ?>>
<?= $Page->MODIFIED_FROM->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->COUNTRY_CODE->Visible) { // COUNTRY_CODE ?>
        <td <?= $Page->COUNTRY_CODE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_FAMILY_COUNTRY_CODE" class="FAMILY_COUNTRY_CODE">
<span<?= $Page->COUNTRY_CODE->viewAttributes() ?>>
<?= $Page->COUNTRY_CODE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
