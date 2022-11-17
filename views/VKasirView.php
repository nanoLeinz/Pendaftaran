<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VKasirView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fV_KASIRview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fV_KASIRview = currentForm = new ew.Form("fV_KASIRview", "view");
    loadjs.done("fV_KASIRview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.V_KASIR) ew.vars.tables.V_KASIR = <?= JsonEncode(GetClientVar("tables", "V_KASIR")) ?>;
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
<form name="fV_KASIRview" id="fV_KASIRview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_KASIR">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-bordered table-hover ew-view-table">
<?php if ($Page->CETAK->Visible) { // CETAK ?>
    <tr id="r_CETAK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_CETAK"><?= $Page->CETAK->caption() ?></span></td>
        <td data-name="CETAK" <?= $Page->CETAK->cellAttributes() ?>>
<span id="el_V_KASIR_CETAK">
<span<?= $Page->CETAK->viewAttributes() ?>><script>

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
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <tr id="r_NO_REGISTRATION">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_NO_REGISTRATION"><?= $Page->NO_REGISTRATION->caption() ?></span></td>
        <td data-name="NO_REGISTRATION" <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_KASIR_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<?= $Page->NO_REGISTRATION->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <tr id="r_STATUS_PASIEN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_STATUS_PASIEN_ID"><?= $Page->STATUS_PASIEN_ID->caption() ?></span></td>
        <td data-name="STATUS_PASIEN_ID" <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_V_KASIR_STATUS_PASIEN_ID">
<span<?= $Page->STATUS_PASIEN_ID->viewAttributes() ?>>
<?= $Page->STATUS_PASIEN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->RUJUKAN_ID->Visible) { // RUJUKAN_ID ?>
    <tr id="r_RUJUKAN_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_RUJUKAN_ID"><?= $Page->RUJUKAN_ID->caption() ?></span></td>
        <td data-name="RUJUKAN_ID" <?= $Page->RUJUKAN_ID->cellAttributes() ?>>
<span id="el_V_KASIR_RUJUKAN_ID">
<span<?= $Page->RUJUKAN_ID->viewAttributes() ?>>
<?= $Page->RUJUKAN_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->REASON_ID->Visible) { // REASON_ID ?>
    <tr id="r_REASON_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_REASON_ID"><?= $Page->REASON_ID->caption() ?></span></td>
        <td data-name="REASON_ID" <?= $Page->REASON_ID->cellAttributes() ?>>
<span id="el_V_KASIR_REASON_ID">
<span<?= $Page->REASON_ID->viewAttributes() ?>>
<?= $Page->REASON_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->WAY_ID->Visible) { // WAY_ID ?>
    <tr id="r_WAY_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_WAY_ID"><?= $Page->WAY_ID->caption() ?></span></td>
        <td data-name="WAY_ID" <?= $Page->WAY_ID->cellAttributes() ?>>
<span id="el_V_KASIR_WAY_ID">
<span<?= $Page->WAY_ID->viewAttributes() ?>>
<?= $Page->WAY_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->BOOKED_DATE->Visible) { // BOOKED_DATE ?>
    <tr id="r_BOOKED_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_BOOKED_DATE"><?= $Page->BOOKED_DATE->caption() ?></span></td>
        <td data-name="BOOKED_DATE" <?= $Page->BOOKED_DATE->cellAttributes() ?>>
<span id="el_V_KASIR_BOOKED_DATE">
<span<?= $Page->BOOKED_DATE->viewAttributes() ?>>
<?= $Page->BOOKED_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->VISIT_DATE->Visible) { // VISIT_DATE ?>
    <tr id="r_VISIT_DATE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_VISIT_DATE"><?= $Page->VISIT_DATE->caption() ?></span></td>
        <td data-name="VISIT_DATE" <?= $Page->VISIT_DATE->cellAttributes() ?>>
<span id="el_V_KASIR_VISIT_DATE">
<span<?= $Page->VISIT_DATE->viewAttributes() ?>>
<?= $Page->VISIT_DATE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <tr id="r_CLINIC_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_CLINIC_ID"><?= $Page->CLINIC_ID->caption() ?></span></td>
        <td data-name="CLINIC_ID" <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_V_KASIR_CLINIC_ID">
<span<?= $Page->CLINIC_ID->viewAttributes() ?>>
<?= $Page->CLINIC_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <tr id="r_GENDER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_GENDER"><?= $Page->GENDER->caption() ?></span></td>
        <td data-name="GENDER" <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_V_KASIR_GENDER">
<span<?= $Page->GENDER->viewAttributes() ?>>
<?= $Page->GENDER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <tr id="r_EMPLOYEE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_EMPLOYEE_ID"><?= $Page->EMPLOYEE_ID->caption() ?></span></td>
        <td data-name="EMPLOYEE_ID" <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_V_KASIR_EMPLOYEE_ID">
<span<?= $Page->EMPLOYEE_ID->viewAttributes() ?>>
<?= $Page->EMPLOYEE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <tr id="r_PAYOR_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_PAYOR_ID"><?= $Page->PAYOR_ID->caption() ?></span></td>
        <td data-name="PAYOR_ID" <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el_V_KASIR_PAYOR_ID">
<span<?= $Page->PAYOR_ID->viewAttributes() ?>>
<?= $Page->PAYOR_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <tr id="r_CLASS_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_CLASS_ID"><?= $Page->CLASS_ID->caption() ?></span></td>
        <td data-name="CLASS_ID" <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_V_KASIR_CLASS_ID">
<span<?= $Page->CLASS_ID->viewAttributes() ?>>
<?= $Page->CLASS_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <tr id="r_COVERAGE_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_COVERAGE_ID"><?= $Page->COVERAGE_ID->caption() ?></span></td>
        <td data-name="COVERAGE_ID" <?= $Page->COVERAGE_ID->cellAttributes() ?>>
<span id="el_V_KASIR_COVERAGE_ID">
<span<?= $Page->COVERAGE_ID->viewAttributes() ?>>
<?= $Page->COVERAGE_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_SKP->Visible) { // NO_SKP ?>
    <tr id="r_NO_SKP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_NO_SKP"><?= $Page->NO_SKP->caption() ?></span></td>
        <td data-name="NO_SKP" <?= $Page->NO_SKP->cellAttributes() ?>>
<span id="el_V_KASIR_NO_SKP">
<span<?= $Page->NO_SKP->viewAttributes() ?>>
<?= $Page->NO_SKP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_SKPINAP->Visible) { // NO_SKPINAP ?>
    <tr id="r_NO_SKPINAP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_NO_SKPINAP"><?= $Page->NO_SKPINAP->caption() ?></span></td>
        <td data-name="NO_SKPINAP" <?= $Page->NO_SKPINAP->cellAttributes() ?>>
<span id="el_V_KASIR_NO_SKPINAP">
<span<?= $Page->NO_SKPINAP->viewAttributes() ?>>
<?= $Page->NO_SKPINAP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <tr id="r_DIAGNOSA_ID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_DIAGNOSA_ID"><?= $Page->DIAGNOSA_ID->caption() ?></span></td>
        <td data-name="DIAGNOSA_ID" <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el_V_KASIR_DIAGNOSA_ID">
<span<?= $Page->DIAGNOSA_ID->viewAttributes() ?>>
<?= $Page->DIAGNOSA_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NORUJUKAN->Visible) { // NORUJUKAN ?>
    <tr id="r_NORUJUKAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_NORUJUKAN"><?= $Page->NORUJUKAN->caption() ?></span></td>
        <td data-name="NORUJUKAN" <?= $Page->NORUJUKAN->cellAttributes() ?>>
<span id="el_V_KASIR_NORUJUKAN">
<span<?= $Page->NORUJUKAN->viewAttributes() ?>>
<?= $Page->NORUJUKAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PPKRUJUKAN->Visible) { // PPKRUJUKAN ?>
    <tr id="r_PPKRUJUKAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_PPKRUJUKAN"><?= $Page->PPKRUJUKAN->caption() ?></span></td>
        <td data-name="PPKRUJUKAN" <?= $Page->PPKRUJUKAN->cellAttributes() ?>>
<span id="el_V_KASIR_PPKRUJUKAN">
<span<?= $Page->PPKRUJUKAN->viewAttributes() ?>>
<?= $Page->PPKRUJUKAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->EDIT_SEP->Visible) { // EDIT_SEP ?>
    <tr id="r_EDIT_SEP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_EDIT_SEP"><?= $Page->EDIT_SEP->caption() ?></span></td>
        <td data-name="EDIT_SEP" <?= $Page->EDIT_SEP->cellAttributes() ?>>
<span id="el_V_KASIR_EDIT_SEP">
<span<?= $Page->EDIT_SEP->viewAttributes() ?>>
<?= $Page->EDIT_SEP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DIAG_AWAL->Visible) { // DIAG_AWAL ?>
    <tr id="r_DIAG_AWAL">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_DIAG_AWAL"><?= $Page->DIAG_AWAL->caption() ?></span></td>
        <td data-name="DIAG_AWAL" <?= $Page->DIAG_AWAL->cellAttributes() ?>>
<span id="el_V_KASIR_DIAG_AWAL">
<span<?= $Page->DIAG_AWAL->viewAttributes() ?>>
<?= $Page->DIAG_AWAL->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->COB->Visible) { // COB ?>
    <tr id="r_COB">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_COB"><?= $Page->COB->caption() ?></span></td>
        <td data-name="COB" <?= $Page->COB->cellAttributes() ?>>
<span id="el_V_KASIR_COB">
<span<?= $Page->COB->viewAttributes() ?>>
<?= $Page->COB->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ASALRUJUKAN->Visible) { // ASALRUJUKAN ?>
    <tr id="r_ASALRUJUKAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_ASALRUJUKAN"><?= $Page->ASALRUJUKAN->caption() ?></span></td>
        <td data-name="ASALRUJUKAN" <?= $Page->ASALRUJUKAN->cellAttributes() ?>>
<span id="el_V_KASIR_ASALRUJUKAN">
<span<?= $Page->ASALRUJUKAN->viewAttributes() ?>>
<?= $Page->ASALRUJUKAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
    <tr id="r_tgl_kontrol">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_tgl_kontrol"><?= $Page->tgl_kontrol->caption() ?></span></td>
        <td data-name="tgl_kontrol" <?= $Page->tgl_kontrol->cellAttributes() ?>>
<span id="el_V_KASIR_tgl_kontrol">
<span<?= $Page->tgl_kontrol->viewAttributes() ?>>
<?= $Page->tgl_kontrol->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idbooking->Visible) { // idbooking ?>
    <tr id="r_idbooking">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_idbooking"><?= $Page->idbooking->caption() ?></span></td>
        <td data-name="idbooking" <?= $Page->idbooking->cellAttributes() ?>>
<span id="el_V_KASIR_idbooking">
<span<?= $Page->idbooking->viewAttributes() ?>>
<?= $Page->idbooking->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
    <tr id="r_id_tujuan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_id_tujuan"><?= $Page->id_tujuan->caption() ?></span></td>
        <td data-name="id_tujuan" <?= $Page->id_tujuan->cellAttributes() ?>>
<span id="el_V_KASIR_id_tujuan">
<span<?= $Page->id_tujuan->viewAttributes() ?>>
<?= $Page->id_tujuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
    <tr id="r_id_penunjang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_id_penunjang"><?= $Page->id_penunjang->caption() ?></span></td>
        <td data-name="id_penunjang" <?= $Page->id_penunjang->cellAttributes() ?>>
<span id="el_V_KASIR_id_penunjang">
<span<?= $Page->id_penunjang->viewAttributes() ?>>
<?= $Page->id_penunjang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
    <tr id="r_id_pembiayaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_id_pembiayaan"><?= $Page->id_pembiayaan->caption() ?></span></td>
        <td data-name="id_pembiayaan" <?= $Page->id_pembiayaan->cellAttributes() ?>>
<span id="el_V_KASIR_id_pembiayaan">
<span<?= $Page->id_pembiayaan->viewAttributes() ?>>
<?= $Page->id_pembiayaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
    <tr id="r_id_procedure">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_id_procedure"><?= $Page->id_procedure->caption() ?></span></td>
        <td data-name="id_procedure" <?= $Page->id_procedure->cellAttributes() ?>>
<span id="el_V_KASIR_id_procedure">
<span<?= $Page->id_procedure->viewAttributes() ?>>
<?= $Page->id_procedure->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
    <tr id="r_id_aspel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_id_aspel"><?= $Page->id_aspel->caption() ?></span></td>
        <td data-name="id_aspel" <?= $Page->id_aspel->cellAttributes() ?>>
<span id="el_V_KASIR_id_aspel">
<span<?= $Page->id_aspel->viewAttributes() ?>>
<?= $Page->id_aspel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
    <tr id="r_id_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_V_KASIR_id_kelas"><?= $Page->id_kelas->caption() ?></span></td>
        <td data-name="id_kelas" <?= $Page->id_kelas->cellAttributes() ?>>
<span id="el_V_KASIR_id_kelas">
<span<?= $Page->id_kelas->viewAttributes() ?>>
<?= $Page->id_kelas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
    $firstActiveDetailTable = $Page->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="Page_details"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
    if (in_array("TREATMENT_AKOMODASI", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_AKOMODASI->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "TREATMENT_AKOMODASI") {
            $firstActiveDetailTable = "TREATMENT_AKOMODASI";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("TREATMENT_AKOMODASI") ?>" href="#tab_TREATMENT_AKOMODASI" data-toggle="tab"><?= $Language->tablePhrase("TREATMENT_AKOMODASI", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("TREATMENT_BILL", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_BILL->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "TREATMENT_BILL") {
            $firstActiveDetailTable = "TREATMENT_BILL";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("TREATMENT_BILL") ?>" href="#tab_TREATMENT_BILL" data-toggle="tab"><?= $Language->tablePhrase("TREATMENT_BILL", "TblCaption") ?></a></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="tab-content"><!-- .tab-content -->
<?php
    if (in_array("TREATMENT_AKOMODASI", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_AKOMODASI->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "TREATMENT_AKOMODASI") {
            $firstActiveDetailTable = "TREATMENT_AKOMODASI";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("TREATMENT_AKOMODASI") ?>" id="tab_TREATMENT_AKOMODASI"><!-- page* -->
<?php include_once "TreatmentAkomodasiGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("TREATMENT_BILL", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_BILL->DetailView) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "TREATMENT_BILL") {
            $firstActiveDetailTable = "TREATMENT_BILL";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("TREATMENT_BILL") ?>" id="tab_TREATMENT_BILL"><!-- page* -->
<?php include_once "TreatmentBillGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
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
