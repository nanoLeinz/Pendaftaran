<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Table
$V_KASIR = Container("V_KASIR");
?>
<?php if ($V_KASIR->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_V_KASIRmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($V_KASIR->CETAK->Visible) { // CETAK ?>
        <tr id="r_CETAK">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->CETAK->caption() ?></td>
            <td <?= $V_KASIR->CETAK->cellAttributes() ?>>
<span id="el_V_KASIR_CETAK">
<span<?= $V_KASIR->CETAK->viewAttributes() ?>><script>

function Buka(link="") {
	window.open(link, 'newwindow', 'width=800,height=400');
	return false;
}
</script>
<div class="btn-group btn-group-sm ew-btn-group">
	<a class="btn bg-navy ew-row-link ew-detail" href="print.html"
	onclick="Buka('/simrs/reporting/nota_kwitansi_semua.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">NOTA</a>
	<button class="dropdown-toggle btn bg-navy ew-detail" data-toggle="dropdown" aria-expanded="false"></button>
	<ul class="dropdown-menu" style="">
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_rekap_total.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Rekap Total</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_rincian_tindakan.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Tindakan</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_pelayanan_kasir_ranap.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">CESMIX Ringkas</a>
		</li>
		<li class="divider" style="border-bottom:1px solid #ccc!important"></li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_rincian_inacbg.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">INACBG</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="#"
			 onclick="Buka('/simrs/reporting/nota_rincian_inadrg.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">INADRG</a>
		</li>
	</ul>
</div>
<div class="btn-group btn-group-sm ew-btn-group">
	<a class="btn btn-primary ew-row-link ew-detail" href="print.html"
	onclick="Buka('/simrs/reporting/jasper.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">RESUME MEDIS</a>
	<button class="dropdown-toggle btn btn-primary ew-detail" data-toggle="dropdown" aria-expanded="false"></button>
	<ul class="dropdown-menu" style="">
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_keterangan_ranap.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Ket. Rawat Inap</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_keterangan_rajal.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Ket. Rawat Jalan</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_keterangan_pasien.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Ket. Pasien</a>
		</li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_keterangan_meninggal.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Ket. Meninggal</a>
		</li>
		<li class="divider" style="border-bottom:1px solid #ccc!important"></li>
		<li>
			<a class="dropdown-item ew-row-link ew-detail-edit" href="print.html"
			 onclick="Buka('/simrs/reporting/surat_kontrol.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">Surat Kontrol</a>
		</li>
	</ul>
</div>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
        <tr id="r_NO_REGISTRATION">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->NO_REGISTRATION->caption() ?></td>
            <td <?= $V_KASIR->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_KASIR_NO_REGISTRATION">
<span<?= $V_KASIR->NO_REGISTRATION->viewAttributes() ?>>
<?= $V_KASIR->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->VISIT_DATE->Visible) { // VISIT_DATE ?>
        <tr id="r_VISIT_DATE">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->VISIT_DATE->caption() ?></td>
            <td <?= $V_KASIR->VISIT_DATE->cellAttributes() ?>>
<span id="el_V_KASIR_VISIT_DATE">
<span<?= $V_KASIR->VISIT_DATE->viewAttributes() ?>>
<?= $V_KASIR->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->CLINIC_ID->Visible) { // CLINIC_ID ?>
        <tr id="r_CLINIC_ID">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->CLINIC_ID->caption() ?></td>
            <td <?= $V_KASIR->CLINIC_ID->cellAttributes() ?>>
<span id="el_V_KASIR_CLINIC_ID">
<span<?= $V_KASIR->CLINIC_ID->viewAttributes() ?>>
<?= $V_KASIR->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->GENDER->Visible) { // GENDER ?>
        <tr id="r_GENDER">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->GENDER->caption() ?></td>
            <td <?= $V_KASIR->GENDER->cellAttributes() ?>>
<span id="el_V_KASIR_GENDER">
<span<?= $V_KASIR->GENDER->viewAttributes() ?>>
<?= $V_KASIR->GENDER->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
        <tr id="r_EMPLOYEE_ID">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->EMPLOYEE_ID->caption() ?></td>
            <td <?= $V_KASIR->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_V_KASIR_EMPLOYEE_ID">
<span<?= $V_KASIR->EMPLOYEE_ID->viewAttributes() ?>>
<?= $V_KASIR->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->PAYOR_ID->Visible) { // PAYOR_ID ?>
        <tr id="r_PAYOR_ID">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->PAYOR_ID->caption() ?></td>
            <td <?= $V_KASIR->PAYOR_ID->cellAttributes() ?>>
<span id="el_V_KASIR_PAYOR_ID">
<span<?= $V_KASIR->PAYOR_ID->viewAttributes() ?>>
<?= $V_KASIR->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->CLASS_ID->Visible) { // CLASS_ID ?>
        <tr id="r_CLASS_ID">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->CLASS_ID->caption() ?></td>
            <td <?= $V_KASIR->CLASS_ID->cellAttributes() ?>>
<span id="el_V_KASIR_CLASS_ID">
<span<?= $V_KASIR->CLASS_ID->viewAttributes() ?>>
<?= $V_KASIR->CLASS_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->PASIEN_ID->Visible) { // PASIEN_ID ?>
        <tr id="r_PASIEN_ID">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->PASIEN_ID->caption() ?></td>
            <td <?= $V_KASIR->PASIEN_ID->cellAttributes() ?>>
<span id="el_V_KASIR_PASIEN_ID">
<span<?= $V_KASIR->PASIEN_ID->viewAttributes() ?>>
<?= $V_KASIR->PASIEN_ID->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->tgl_kontrol->Visible) { // tgl_kontrol ?>
        <tr id="r_tgl_kontrol">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->tgl_kontrol->caption() ?></td>
            <td <?= $V_KASIR->tgl_kontrol->cellAttributes() ?>>
<span id="el_V_KASIR_tgl_kontrol">
<span<?= $V_KASIR->tgl_kontrol->viewAttributes() ?>>
<?= $V_KASIR->tgl_kontrol->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->idbooking->Visible) { // idbooking ?>
        <tr id="r_idbooking">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->idbooking->caption() ?></td>
            <td <?= $V_KASIR->idbooking->cellAttributes() ?>>
<span id="el_V_KASIR_idbooking">
<span<?= $V_KASIR->idbooking->viewAttributes() ?>>
<?= $V_KASIR->idbooking->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->id_tujuan->Visible) { // id_tujuan ?>
        <tr id="r_id_tujuan">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->id_tujuan->caption() ?></td>
            <td <?= $V_KASIR->id_tujuan->cellAttributes() ?>>
<span id="el_V_KASIR_id_tujuan">
<span<?= $V_KASIR->id_tujuan->viewAttributes() ?>>
<?= $V_KASIR->id_tujuan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->id_penunjang->Visible) { // id_penunjang ?>
        <tr id="r_id_penunjang">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->id_penunjang->caption() ?></td>
            <td <?= $V_KASIR->id_penunjang->cellAttributes() ?>>
<span id="el_V_KASIR_id_penunjang">
<span<?= $V_KASIR->id_penunjang->viewAttributes() ?>>
<?= $V_KASIR->id_penunjang->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->id_pembiayaan->Visible) { // id_pembiayaan ?>
        <tr id="r_id_pembiayaan">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->id_pembiayaan->caption() ?></td>
            <td <?= $V_KASIR->id_pembiayaan->cellAttributes() ?>>
<span id="el_V_KASIR_id_pembiayaan">
<span<?= $V_KASIR->id_pembiayaan->viewAttributes() ?>>
<?= $V_KASIR->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->id_procedure->Visible) { // id_procedure ?>
        <tr id="r_id_procedure">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->id_procedure->caption() ?></td>
            <td <?= $V_KASIR->id_procedure->cellAttributes() ?>>
<span id="el_V_KASIR_id_procedure">
<span<?= $V_KASIR->id_procedure->viewAttributes() ?>>
<?= $V_KASIR->id_procedure->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->id_aspel->Visible) { // id_aspel ?>
        <tr id="r_id_aspel">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->id_aspel->caption() ?></td>
            <td <?= $V_KASIR->id_aspel->cellAttributes() ?>>
<span id="el_V_KASIR_id_aspel">
<span<?= $V_KASIR->id_aspel->viewAttributes() ?>>
<?= $V_KASIR->id_aspel->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($V_KASIR->id_kelas->Visible) { // id_kelas ?>
        <tr id="r_id_kelas">
            <td class="<?= $V_KASIR->TableLeftColumnClass ?>"><?= $V_KASIR->id_kelas->caption() ?></td>
            <td <?= $V_KASIR->id_kelas->cellAttributes() ?>>
<span id="el_V_KASIR_id_kelas">
<span<?= $V_KASIR->id_kelas->viewAttributes() ?>>
<?= $V_KASIR->id_kelas->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
