<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Table
$V_RADIOLOGI = Container("V_RADIOLOGI");
?>
<?php if ($V_RADIOLOGI->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_V_RADIOLOGImaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($V_RADIOLOGI->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <tr id="r_NO_REGISTRATION">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->NO_REGISTRATION->caption() ?></td>
            <td <?= $V_RADIOLOGI->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_NO_REGISTRATION">
<span<?= $V_RADIOLOGI->NO_REGISTRATION->viewAttributes() ?>>
<?= $V_RADIOLOGI->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <tr id="r_VISIT_DATE">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->VISIT_DATE->caption() ?></td>
            <td <?= $V_RADIOLOGI->VISIT_DATE->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_VISIT_DATE">
<span<?= $V_RADIOLOGI->VISIT_DATE->viewAttributes() ?>>
<?= $V_RADIOLOGI->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <tr id="r_CLINIC_ID">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->CLINIC_ID->caption() ?></td>
            <td <?= $V_RADIOLOGI->CLINIC_ID->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_CLINIC_ID">
<span<?= $V_RADIOLOGI->CLINIC_ID->viewAttributes() ?>>
<?= $V_RADIOLOGI->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->GENDER->Visible) { // GENDER ?>
        <tr id="r_GENDER">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->GENDER->caption() ?></td>
            <td <?= $V_RADIOLOGI->GENDER->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_GENDER">
<span<?= $V_RADIOLOGI->GENDER->viewAttributes() ?>>
<?= $V_RADIOLOGI->GENDER->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <tr id="r_EMPLOYEE_ID">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->EMPLOYEE_ID->caption() ?></td>
            <td <?= $V_RADIOLOGI->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_EMPLOYEE_ID">
<span<?= $V_RADIOLOGI->EMPLOYEE_ID->viewAttributes() ?>>
<?= $V_RADIOLOGI->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <tr id="r_PAYOR_ID">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->PAYOR_ID->caption() ?></td>
            <td <?= $V_RADIOLOGI->PAYOR_ID->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_PAYOR_ID">
<span<?= $V_RADIOLOGI->PAYOR_ID->viewAttributes() ?>>
<?= $V_RADIOLOGI->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->CLASS_ID->Visible) { // CLASS_ID ?>
        <tr id="r_CLASS_ID">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->CLASS_ID->caption() ?></td>
            <td <?= $V_RADIOLOGI->CLASS_ID->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_CLASS_ID">
<span<?= $V_RADIOLOGI->CLASS_ID->viewAttributes() ?>>
<?= $V_RADIOLOGI->CLASS_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <tr id="r_PASIEN_ID">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->PASIEN_ID->caption() ?></td>
            <td <?= $V_RADIOLOGI->PASIEN_ID->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_PASIEN_ID">
<span<?= $V_RADIOLOGI->PASIEN_ID->viewAttributes() ?>>
<?= $V_RADIOLOGI->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <tr id="r_tgl_kontrol">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->tgl_kontrol->caption() ?></td>
            <td <?= $V_RADIOLOGI->tgl_kontrol->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_tgl_kontrol">
<span<?= $V_RADIOLOGI->tgl_kontrol->viewAttributes() ?>>
<?= $V_RADIOLOGI->tgl_kontrol->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->idbooking->Visible) { // idbooking ?>
        <tr id="r_idbooking">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->idbooking->caption() ?></td>
            <td <?= $V_RADIOLOGI->idbooking->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_idbooking">
<span<?= $V_RADIOLOGI->idbooking->viewAttributes() ?>>
<?= $V_RADIOLOGI->idbooking->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->id_tujuan->Visible) { // id_tujuan ?>
        <tr id="r_id_tujuan">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->id_tujuan->caption() ?></td>
            <td <?= $V_RADIOLOGI->id_tujuan->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_id_tujuan">
<span<?= $V_RADIOLOGI->id_tujuan->viewAttributes() ?>>
<?= $V_RADIOLOGI->id_tujuan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->id_penunjang->Visible) { // id_penunjang ?>
        <tr id="r_id_penunjang">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->id_penunjang->caption() ?></td>
            <td <?= $V_RADIOLOGI->id_penunjang->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_id_penunjang">
<span<?= $V_RADIOLOGI->id_penunjang->viewAttributes() ?>>
<?= $V_RADIOLOGI->id_penunjang->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <tr id="r_id_pembiayaan">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->id_pembiayaan->caption() ?></td>
            <td <?= $V_RADIOLOGI->id_pembiayaan->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_id_pembiayaan">
<span<?= $V_RADIOLOGI->id_pembiayaan->viewAttributes() ?>>
<?= $V_RADIOLOGI->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->id_procedure->Visible) { // id_procedure ?>
        <tr id="r_id_procedure">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->id_procedure->caption() ?></td>
            <td <?= $V_RADIOLOGI->id_procedure->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_id_procedure">
<span<?= $V_RADIOLOGI->id_procedure->viewAttributes() ?>>
<?= $V_RADIOLOGI->id_procedure->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->id_aspel->Visible) { // id_aspel ?>
        <tr id="r_id_aspel">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->id_aspel->caption() ?></td>
            <td <?= $V_RADIOLOGI->id_aspel->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_id_aspel">
<span<?= $V_RADIOLOGI->id_aspel->viewAttributes() ?>>
<?= $V_RADIOLOGI->id_aspel->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RADIOLOGI->id_kelas->Visible) { // id_kelas ?>
        <tr id="r_id_kelas">
            <td class="<?= $V_RADIOLOGI->TableLeftColumnClass ?>"><?= $V_RADIOLOGI->id_kelas->caption() ?></td>
            <td <?= $V_RADIOLOGI->id_kelas->cellAttributes() ?>>
<span id="el_V_RADIOLOGI_id_kelas">
<span<?= $V_RADIOLOGI->id_kelas->viewAttributes() ?>>
<?= $V_RADIOLOGI->id_kelas->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
