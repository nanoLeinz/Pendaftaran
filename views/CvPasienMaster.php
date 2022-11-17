<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Table
$cv_pasien = Container("cv_pasien");
?>
<?php if ($cv_pasien->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_cv_pasienmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($cv_pasien->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <tr id="r_NO_REGISTRATION">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->NO_REGISTRATION->caption() ?></td>
            <td <?= $cv_pasien->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_cv_pasien_NO_REGISTRATION">
<span<?= $cv_pasien->NO_REGISTRATION->viewAttributes() ?>>
<?= $cv_pasien->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
        <tr id="r_NAME_OF_PASIEN">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->NAME_OF_PASIEN->caption() ?></td>
            <td <?= $cv_pasien->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el_cv_pasien_NAME_OF_PASIEN">
<span<?= $cv_pasien->NAME_OF_PASIEN->viewAttributes() ?>>
<?= $cv_pasien->NAME_OF_PASIEN->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <tr id="r_PASIEN_ID">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->PASIEN_ID->caption() ?></td>
            <td <?= $cv_pasien->PASIEN_ID->cellAttributes() ?>>
<span id="el_cv_pasien_PASIEN_ID">
<span<?= $cv_pasien->PASIEN_ID->viewAttributes() ?>>
<?= $cv_pasien->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->KK_NO->Visible) { // KK_NO ?>
        <tr id="r_KK_NO">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->KK_NO->caption() ?></td>
            <td <?= $cv_pasien->KK_NO->cellAttributes() ?>>
<span id="el_cv_pasien_KK_NO">
<span<?= $cv_pasien->KK_NO->viewAttributes() ?>>
<?= $cv_pasien->KK_NO->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->GENDER->Visible) { // GENDER ?>
        <tr id="r_GENDER">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->GENDER->caption() ?></td>
            <td <?= $cv_pasien->GENDER->cellAttributes() ?>>
<span id="el_cv_pasien_GENDER">
<span<?= $cv_pasien->GENDER->viewAttributes() ?>>
<?= $cv_pasien->GENDER->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <tr id="r_STATUS_PASIEN_ID">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->STATUS_PASIEN_ID->caption() ?></td>
            <td <?= $cv_pasien->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_cv_pasien_STATUS_PASIEN_ID">
<span<?= $cv_pasien->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $cv_pasien->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->CONTACT_ADDRESS->Visible) { // CONTACT_ADDRESS ?>
        <tr id="r_CONTACT_ADDRESS">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->CONTACT_ADDRESS->caption() ?></td>
            <td <?= $cv_pasien->CONTACT_ADDRESS->cellAttributes() ?>>
<span id="el_cv_pasien_CONTACT_ADDRESS">
<span<?= $cv_pasien->CONTACT_ADDRESS->viewAttributes() ?>>
<?= $cv_pasien->CONTACT_ADDRESS->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
        <tr id="r_REGISTRATION_DATE">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->REGISTRATION_DATE->caption() ?></td>
            <td <?= $cv_pasien->REGISTRATION_DATE->cellAttributes() ?>>
<span id="el_cv_pasien_REGISTRATION_DATE">
<span<?= $cv_pasien->REGISTRATION_DATE->viewAttributes() ?>>
<?= $cv_pasien->REGISTRATION_DATE->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->MOTHER->Visible) { // MOTHER ?>
        <tr id="r_MOTHER">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->MOTHER->caption() ?></td>
            <td <?= $cv_pasien->MOTHER->cellAttributes() ?>>
<span id="el_cv_pasien_MOTHER">
<span<?= $cv_pasien->MOTHER->viewAttributes() ?>>
<?= $cv_pasien->MOTHER->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->FATHER->Visible) { // FATHER ?>
        <tr id="r_FATHER">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->FATHER->caption() ?></td>
            <td <?= $cv_pasien->FATHER->cellAttributes() ?>>
<span id="el_cv_pasien_FATHER">
<span<?= $cv_pasien->FATHER->viewAttributes() ?>>
<?= $cv_pasien->FATHER->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($cv_pasien->SPOUSE->Visible) { // SPOUSE ?>
        <tr id="r_SPOUSE">
            <td class="<?= $cv_pasien->TableLeftColumnClass ?>"><?= $cv_pasien->SPOUSE->caption() ?></td>
            <td <?= $cv_pasien->SPOUSE->cellAttributes() ?>>
<span id="el_cv_pasien_SPOUSE">
<span<?= $cv_pasien->SPOUSE->viewAttributes() ?>>
<?= $cv_pasien->SPOUSE->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
