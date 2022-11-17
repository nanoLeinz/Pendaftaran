<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Table
$TREATMENT_BILL = Container("TREATMENT_BILL");
?>
<?php if ($TREATMENT_BILL->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_TREATMENT_BILLmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($TREATMENT_BILL->TARIF_ID->Visible) { // TARIF_ID ?>
        <tr id="r_TARIF_ID">
            <td class="<?= $TREATMENT_BILL->TableLeftColumnClass ?>"><?= $TREATMENT_BILL->TARIF_ID->caption() ?></td>
            <td <?= $TREATMENT_BILL->TARIF_ID->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_TARIF_ID">
<span<?= $TREATMENT_BILL->TARIF_ID->viewAttributes() ?>>
<?= $TREATMENT_BILL->TARIF_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($TREATMENT_BILL->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <tr id="r_CLINIC_ID">
            <td class="<?= $TREATMENT_BILL->TableLeftColumnClass ?>"><?= $TREATMENT_BILL->CLINIC_ID->caption() ?></td>
            <td <?= $TREATMENT_BILL->CLINIC_ID->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_CLINIC_ID">
<span<?= $TREATMENT_BILL->CLINIC_ID->viewAttributes() ?>>
<?= $TREATMENT_BILL->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($TREATMENT_BILL->TREAT_DATE->Visible) { // TREAT_DATE ?>
        <tr id="r_TREAT_DATE">
            <td class="<?= $TREATMENT_BILL->TableLeftColumnClass ?>"><?= $TREATMENT_BILL->TREAT_DATE->caption() ?></td>
            <td <?= $TREATMENT_BILL->TREAT_DATE->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_TREAT_DATE">
<span<?= $TREATMENT_BILL->TREAT_DATE->viewAttributes() ?>>
<?= $TREATMENT_BILL->TREAT_DATE->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($TREATMENT_BILL->QUANTITY->Visible) { // QUANTITY ?>
        <tr id="r_QUANTITY">
            <td class="<?= $TREATMENT_BILL->TableLeftColumnClass ?>"><?= $TREATMENT_BILL->QUANTITY->caption() ?></td>
            <td <?= $TREATMENT_BILL->QUANTITY->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_QUANTITY">
<span<?= $TREATMENT_BILL->QUANTITY->viewAttributes() ?>>
<?= $TREATMENT_BILL->QUANTITY->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($TREATMENT_BILL->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <tr id="r_EMPLOYEE_ID">
            <td class="<?= $TREATMENT_BILL->TableLeftColumnClass ?>"><?= $TREATMENT_BILL->EMPLOYEE_ID->caption() ?></td>
            <td <?= $TREATMENT_BILL->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_EMPLOYEE_ID">
<span<?= $TREATMENT_BILL->EMPLOYEE_ID->viewAttributes() ?>>
<?= $TREATMENT_BILL->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($TREATMENT_BILL->amount_paid->Visible) { // amount_paid ?>
        <tr id="r_amount_paid">
            <td class="<?= $TREATMENT_BILL->TableLeftColumnClass ?>"><?= $TREATMENT_BILL->amount_paid->caption() ?></td>
            <td <?= $TREATMENT_BILL->amount_paid->cellAttributes() ?>>
<span id="el_TREATMENT_BILL_amount_paid">
<span<?= $TREATMENT_BILL->amount_paid->viewAttributes() ?>>
<?= $TREATMENT_BILL->amount_paid->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
