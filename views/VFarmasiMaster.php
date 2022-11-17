<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Table
$V_FARMASI = Container("V_FARMASI");
?>
<?php if ($V_FARMASI->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_V_FARMASImaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($V_FARMASI->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <tr id="r_NO_REGISTRATION">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->NO_REGISTRATION->caption() ?></td>
            <td <?= $V_FARMASI->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_FARMASI_NO_REGISTRATION">
<span<?= $V_FARMASI->NO_REGISTRATION->viewAttributes() ?>>
<?= $V_FARMASI->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <tr id="r_VISIT_DATE">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->VISIT_DATE->caption() ?></td>
            <td <?= $V_FARMASI->VISIT_DATE->cellAttributes() ?>>
<span id="el_V_FARMASI_VISIT_DATE">
<span<?= $V_FARMASI->VISIT_DATE->viewAttributes() ?>>
<?= $V_FARMASI->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <tr id="r_CLINIC_ID">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->CLINIC_ID->caption() ?></td>
            <td <?= $V_FARMASI->CLINIC_ID->cellAttributes() ?>>
<span id="el_V_FARMASI_CLINIC_ID">
<span<?= $V_FARMASI->CLINIC_ID->viewAttributes() ?>>
<?= $V_FARMASI->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->GENDER->Visible) { // GENDER ?>
        <tr id="r_GENDER">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->GENDER->caption() ?></td>
            <td <?= $V_FARMASI->GENDER->cellAttributes() ?>>
<span id="el_V_FARMASI_GENDER">
<span<?= $V_FARMASI->GENDER->viewAttributes() ?>>
<?= $V_FARMASI->GENDER->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <tr id="r_EMPLOYEE_ID">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->EMPLOYEE_ID->caption() ?></td>
            <td <?= $V_FARMASI->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_V_FARMASI_EMPLOYEE_ID">
<span<?= $V_FARMASI->EMPLOYEE_ID->viewAttributes() ?>>
<?= $V_FARMASI->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <tr id="r_PAYOR_ID">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->PAYOR_ID->caption() ?></td>
            <td <?= $V_FARMASI->PAYOR_ID->cellAttributes() ?>>
<span id="el_V_FARMASI_PAYOR_ID">
<span<?= $V_FARMASI->PAYOR_ID->viewAttributes() ?>>
<?= $V_FARMASI->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->CLASS_ID->Visible) { // CLASS_ID ?>
        <tr id="r_CLASS_ID">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->CLASS_ID->caption() ?></td>
            <td <?= $V_FARMASI->CLASS_ID->cellAttributes() ?>>
<span id="el_V_FARMASI_CLASS_ID">
<span<?= $V_FARMASI->CLASS_ID->viewAttributes() ?>>
<?= $V_FARMASI->CLASS_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <tr id="r_PASIEN_ID">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->PASIEN_ID->caption() ?></td>
            <td <?= $V_FARMASI->PASIEN_ID->cellAttributes() ?>>
<span id="el_V_FARMASI_PASIEN_ID">
<span<?= $V_FARMASI->PASIEN_ID->viewAttributes() ?>>
<?= $V_FARMASI->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <tr id="r_tgl_kontrol">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->tgl_kontrol->caption() ?></td>
            <td <?= $V_FARMASI->tgl_kontrol->cellAttributes() ?>>
<span id="el_V_FARMASI_tgl_kontrol">
<span<?= $V_FARMASI->tgl_kontrol->viewAttributes() ?>>
<?= $V_FARMASI->tgl_kontrol->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->idbooking->Visible) { // idbooking ?>
        <tr id="r_idbooking">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->idbooking->caption() ?></td>
            <td <?= $V_FARMASI->idbooking->cellAttributes() ?>>
<span id="el_V_FARMASI_idbooking">
<span<?= $V_FARMASI->idbooking->viewAttributes() ?>>
<?= $V_FARMASI->idbooking->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->id_tujuan->Visible) { // id_tujuan ?>
        <tr id="r_id_tujuan">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->id_tujuan->caption() ?></td>
            <td <?= $V_FARMASI->id_tujuan->cellAttributes() ?>>
<span id="el_V_FARMASI_id_tujuan">
<span<?= $V_FARMASI->id_tujuan->viewAttributes() ?>>
<?= $V_FARMASI->id_tujuan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->id_penunjang->Visible) { // id_penunjang ?>
        <tr id="r_id_penunjang">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->id_penunjang->caption() ?></td>
            <td <?= $V_FARMASI->id_penunjang->cellAttributes() ?>>
<span id="el_V_FARMASI_id_penunjang">
<span<?= $V_FARMASI->id_penunjang->viewAttributes() ?>>
<?= $V_FARMASI->id_penunjang->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <tr id="r_id_pembiayaan">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->id_pembiayaan->caption() ?></td>
            <td <?= $V_FARMASI->id_pembiayaan->cellAttributes() ?>>
<span id="el_V_FARMASI_id_pembiayaan">
<span<?= $V_FARMASI->id_pembiayaan->viewAttributes() ?>>
<?= $V_FARMASI->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->id_procedure->Visible) { // id_procedure ?>
        <tr id="r_id_procedure">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->id_procedure->caption() ?></td>
            <td <?= $V_FARMASI->id_procedure->cellAttributes() ?>>
<span id="el_V_FARMASI_id_procedure">
<span<?= $V_FARMASI->id_procedure->viewAttributes() ?>>
<?= $V_FARMASI->id_procedure->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->id_aspel->Visible) { // id_aspel ?>
        <tr id="r_id_aspel">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->id_aspel->caption() ?></td>
            <td <?= $V_FARMASI->id_aspel->cellAttributes() ?>>
<span id="el_V_FARMASI_id_aspel">
<span<?= $V_FARMASI->id_aspel->viewAttributes() ?>>
<?= $V_FARMASI->id_aspel->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_FARMASI->id_kelas->Visible) { // id_kelas ?>
        <tr id="r_id_kelas">
            <td class="<?= $V_FARMASI->TableLeftColumnClass ?>"><?= $V_FARMASI->id_kelas->caption() ?></td>
            <td <?= $V_FARMASI->id_kelas->cellAttributes() ?>>
<span id="el_V_FARMASI_id_kelas">
<span<?= $V_FARMASI->id_kelas->viewAttributes() ?>>
<?= $V_FARMASI->id_kelas->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
