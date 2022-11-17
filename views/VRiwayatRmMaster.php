<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Table
$V_RIWAYAT_RM = Container("V_RIWAYAT_RM");
?>
<?php if ($V_RIWAYAT_RM->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_V_RIWAYAT_RMmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($V_RIWAYAT_RM->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <tr id="r_NO_REGISTRATION">
            <td class="<?= $V_RIWAYAT_RM->TableLeftColumnClass ?>"><?= $V_RIWAYAT_RM->NO_REGISTRATION->caption() ?></td>
            <td <?= $V_RIWAYAT_RM->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_RIWAYAT_RM_NO_REGISTRATION">
<span<?= $V_RIWAYAT_RM->NO_REGISTRATION->viewAttributes() ?>>
<?= $V_RIWAYAT_RM->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RIWAYAT_RM->DIANTAR_OLEH->Visible) { // DIANTAR_OLEH ?>
        <tr id="r_DIANTAR_OLEH">
            <td class="<?= $V_RIWAYAT_RM->TableLeftColumnClass ?>"><?= $V_RIWAYAT_RM->DIANTAR_OLEH->caption() ?></td>
            <td <?= $V_RIWAYAT_RM->DIANTAR_OLEH->cellAttributes() ?>>
<span id="el_V_RIWAYAT_RM_DIANTAR_OLEH">
<span<?= $V_RIWAYAT_RM->DIANTAR_OLEH->viewAttributes() ?>>
<?= $V_RIWAYAT_RM->DIANTAR_OLEH->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RIWAYAT_RM->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
        <tr id="r_STATUS_PASIEN_ID">
            <td class="<?= $V_RIWAYAT_RM->TableLeftColumnClass ?>"><?= $V_RIWAYAT_RM->STATUS_PASIEN_ID->caption() ?></td>
            <td <?= $V_RIWAYAT_RM->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_V_RIWAYAT_RM_STATUS_PASIEN_ID">
<span<?= $V_RIWAYAT_RM->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $V_RIWAYAT_RM->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RIWAYAT_RM->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <tr id="r_VISIT_DATE">
            <td class="<?= $V_RIWAYAT_RM->TableLeftColumnClass ?>"><?= $V_RIWAYAT_RM->VISIT_DATE->caption() ?></td>
            <td <?= $V_RIWAYAT_RM->VISIT_DATE->cellAttributes() ?>>
<span id="el_V_RIWAYAT_RM_VISIT_DATE">
<span<?= $V_RIWAYAT_RM->VISIT_DATE->viewAttributes() ?>>
<?= $V_RIWAYAT_RM->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RIWAYAT_RM->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <tr id="r_CLINIC_ID">
            <td class="<?= $V_RIWAYAT_RM->TableLeftColumnClass ?>"><?= $V_RIWAYAT_RM->CLINIC_ID->caption() ?></td>
            <td <?= $V_RIWAYAT_RM->CLINIC_ID->cellAttributes() ?>>
<span id="el_V_RIWAYAT_RM_CLINIC_ID">
<span<?= $V_RIWAYAT_RM->CLINIC_ID->viewAttributes() ?>>
<?= $V_RIWAYAT_RM->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_RIWAYAT_RM->CETAK->Visible) { // CETAK ?>
        <tr id="r_CETAK">
            <td class="<?= $V_RIWAYAT_RM->TableLeftColumnClass ?>"><?= $V_RIWAYAT_RM->CETAK->caption() ?></td>
            <td <?= $V_RIWAYAT_RM->CETAK->cellAttributes() ?>>
<span id="el_V_RIWAYAT_RM_CETAK">
<span<?= $V_RIWAYAT_RM->CETAK->viewAttributes() ?>><script>

function Buka(link="") {
	window.open(link, 'newwindow', 'width=800,height=400');
	return false;
}
</script>
<a href="/simrs/reporting/jasper.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>" class="btn btn-info" role="button">CETAK</a>
</span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
