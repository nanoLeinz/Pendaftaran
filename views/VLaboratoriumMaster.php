<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Table
$V_LABORATORIUM = Container("V_LABORATORIUM");
?>
<?php if ($V_LABORATORIUM->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_V_LABORATORIUMmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($V_LABORATORIUM->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <tr id="r_NO_REGISTRATION">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->NO_REGISTRATION->caption() ?></td>
            <td <?= $V_LABORATORIUM->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_NO_REGISTRATION">
<span<?= $V_LABORATORIUM->NO_REGISTRATION->viewAttributes() ?>>
<?= $V_LABORATORIUM->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <tr id="r_VISIT_DATE">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->VISIT_DATE->caption() ?></td>
            <td <?= $V_LABORATORIUM->VISIT_DATE->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_VISIT_DATE">
<span<?= $V_LABORATORIUM->VISIT_DATE->viewAttributes() ?>>
<?= $V_LABORATORIUM->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <tr id="r_CLINIC_ID">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->CLINIC_ID->caption() ?></td>
            <td <?= $V_LABORATORIUM->CLINIC_ID->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_CLINIC_ID">
<span<?= $V_LABORATORIUM->CLINIC_ID->viewAttributes() ?>>
<?= $V_LABORATORIUM->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->GENDER->Visible) { // GENDER ?>
        <tr id="r_GENDER">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->GENDER->caption() ?></td>
            <td <?= $V_LABORATORIUM->GENDER->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_GENDER">
<span<?= $V_LABORATORIUM->GENDER->viewAttributes() ?>>
<?= $V_LABORATORIUM->GENDER->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <tr id="r_EMPLOYEE_ID">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->EMPLOYEE_ID->caption() ?></td>
            <td <?= $V_LABORATORIUM->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_EMPLOYEE_ID">
<span<?= $V_LABORATORIUM->EMPLOYEE_ID->viewAttributes() ?>>
<?= $V_LABORATORIUM->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <tr id="r_PAYOR_ID">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->PAYOR_ID->caption() ?></td>
            <td <?= $V_LABORATORIUM->PAYOR_ID->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_PAYOR_ID">
<span<?= $V_LABORATORIUM->PAYOR_ID->viewAttributes() ?>>
<?= $V_LABORATORIUM->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->CLASS_ID->Visible) { // CLASS_ID ?>
        <tr id="r_CLASS_ID">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->CLASS_ID->caption() ?></td>
            <td <?= $V_LABORATORIUM->CLASS_ID->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_CLASS_ID">
<span<?= $V_LABORATORIUM->CLASS_ID->viewAttributes() ?>>
<?= $V_LABORATORIUM->CLASS_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <tr id="r_PASIEN_ID">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->PASIEN_ID->caption() ?></td>
            <td <?= $V_LABORATORIUM->PASIEN_ID->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_PASIEN_ID">
<span<?= $V_LABORATORIUM->PASIEN_ID->viewAttributes() ?>>
<?= $V_LABORATORIUM->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <tr id="r_tgl_kontrol">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->tgl_kontrol->caption() ?></td>
            <td <?= $V_LABORATORIUM->tgl_kontrol->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_tgl_kontrol">
<span<?= $V_LABORATORIUM->tgl_kontrol->viewAttributes() ?>>
<?= $V_LABORATORIUM->tgl_kontrol->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->idbooking->Visible) { // idbooking ?>
        <tr id="r_idbooking">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->idbooking->caption() ?></td>
            <td <?= $V_LABORATORIUM->idbooking->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_idbooking">
<span<?= $V_LABORATORIUM->idbooking->viewAttributes() ?>>
<?= $V_LABORATORIUM->idbooking->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->id_tujuan->Visible) { // id_tujuan ?>
        <tr id="r_id_tujuan">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->id_tujuan->caption() ?></td>
            <td <?= $V_LABORATORIUM->id_tujuan->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_id_tujuan">
<span<?= $V_LABORATORIUM->id_tujuan->viewAttributes() ?>>
<?= $V_LABORATORIUM->id_tujuan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->id_penunjang->Visible) { // id_penunjang ?>
        <tr id="r_id_penunjang">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->id_penunjang->caption() ?></td>
            <td <?= $V_LABORATORIUM->id_penunjang->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_id_penunjang">
<span<?= $V_LABORATORIUM->id_penunjang->viewAttributes() ?>>
<?= $V_LABORATORIUM->id_penunjang->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <tr id="r_id_pembiayaan">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->id_pembiayaan->caption() ?></td>
            <td <?= $V_LABORATORIUM->id_pembiayaan->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_id_pembiayaan">
<span<?= $V_LABORATORIUM->id_pembiayaan->viewAttributes() ?>>
<?= $V_LABORATORIUM->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->id_procedure->Visible) { // id_procedure ?>
        <tr id="r_id_procedure">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->id_procedure->caption() ?></td>
            <td <?= $V_LABORATORIUM->id_procedure->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_id_procedure">
<span<?= $V_LABORATORIUM->id_procedure->viewAttributes() ?>>
<?= $V_LABORATORIUM->id_procedure->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->id_aspel->Visible) { // id_aspel ?>
        <tr id="r_id_aspel">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->id_aspel->caption() ?></td>
            <td <?= $V_LABORATORIUM->id_aspel->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_id_aspel">
<span<?= $V_LABORATORIUM->id_aspel->viewAttributes() ?>>
<?= $V_LABORATORIUM->id_aspel->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_LABORATORIUM->id_kelas->Visible) { // id_kelas ?>
        <tr id="r_id_kelas">
            <td class="<?= $V_LABORATORIUM->TableLeftColumnClass ?>"><?= $V_LABORATORIUM->id_kelas->caption() ?></td>
            <td <?= $V_LABORATORIUM->id_kelas->cellAttributes() ?>>
<span id="el_V_LABORATORIUM_id_kelas">
<span<?= $V_LABORATORIUM->id_kelas->viewAttributes() ?>>
<?= $V_LABORATORIUM->id_kelas->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
