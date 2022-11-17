<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VKasirSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fV_KASIRsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fV_KASIRsearch = currentAdvancedSearchForm = new ew.Form("fV_KASIRsearch", "search");
    <?php } else { ?>
    fV_KASIRsearch = currentForm = new ew.Form("fV_KASIRsearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "V_KASIR")) ?>,
        fields = currentTable.fields;
    fV_KASIRsearch.addFields([
        ["IDXDAFTAR", [ew.Validators.integer], fields.IDXDAFTAR.isInvalid],
        ["tgl_kontrol", [ew.Validators.datetime(0)], fields.tgl_kontrol.isInvalid],
        ["idbooking", [], fields.idbooking.isInvalid],
        ["id_tujuan", [ew.Validators.integer], fields.id_tujuan.isInvalid],
        ["id_penunjang", [ew.Validators.integer], fields.id_penunjang.isInvalid],
        ["id_pembiayaan", [ew.Validators.integer], fields.id_pembiayaan.isInvalid],
        ["id_procedure", [ew.Validators.integer], fields.id_procedure.isInvalid],
        ["id_aspel", [ew.Validators.integer], fields.id_aspel.isInvalid],
        ["id_kelas", [ew.Validators.integer], fields.id_kelas.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fV_KASIRsearch.setInvalid();
    });

    // Validate form
    fV_KASIRsearch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fV_KASIRsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fV_KASIRsearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fV_KASIRsearch.lists.CLINIC_ID = <?= $Page->CLINIC_ID->toClientList($Page) ?>;
    loadjs.done("fV_KASIRsearch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fV_KASIRsearch" id="fV_KASIRsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_KASIR">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->IDXDAFTAR->Visible) { // IDXDAFTAR ?>
    <div id="r_IDXDAFTAR" class="form-group row">
        <label for="x_IDXDAFTAR" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_IDXDAFTAR"><?= $Page->IDXDAFTAR->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_IDXDAFTAR" id="z_IDXDAFTAR" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->IDXDAFTAR->cellAttributes() ?>>
            <span id="el_V_KASIR_IDXDAFTAR" class="ew-search-field ew-search-field-single">
<script>

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
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
    <div id="r_tgl_kontrol" class="form-group row">
        <label for="x_tgl_kontrol" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_tgl_kontrol"><?= $Page->tgl_kontrol->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_kontrol" id="z_tgl_kontrol" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl_kontrol->cellAttributes() ?>>
            <span id="el_V_KASIR_tgl_kontrol" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->tgl_kontrol->getInputTextType() ?>" data-table="V_KASIR" data-field="x_tgl_kontrol" name="x_tgl_kontrol" id="x_tgl_kontrol" placeholder="<?= HtmlEncode($Page->tgl_kontrol->getPlaceHolder()) ?>" value="<?= $Page->tgl_kontrol->EditValue ?>"<?= $Page->tgl_kontrol->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->tgl_kontrol->getErrorMessage(false) ?></div>
<?php if (!$Page->tgl_kontrol->ReadOnly && !$Page->tgl_kontrol->Disabled && !isset($Page->tgl_kontrol->EditAttrs["readonly"]) && !isset($Page->tgl_kontrol->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_KASIRsearch", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_KASIRsearch", "x_tgl_kontrol", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->idbooking->Visible) { // idbooking ?>
    <div id="r_idbooking" class="form-group row">
        <label for="x_idbooking" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_idbooking"><?= $Page->idbooking->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_idbooking" id="z_idbooking" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idbooking->cellAttributes() ?>>
            <span id="el_V_KASIR_idbooking" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->idbooking->getInputTextType() ?>" data-table="V_KASIR" data-field="x_idbooking" name="x_idbooking" id="x_idbooking" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->idbooking->getPlaceHolder()) ?>" value="<?= $Page->idbooking->EditValue ?>"<?= $Page->idbooking->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->idbooking->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
    <div id="r_id_tujuan" class="form-group row">
        <label for="x_id_tujuan" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_id_tujuan"><?= $Page->id_tujuan->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_tujuan" id="z_id_tujuan" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_tujuan->cellAttributes() ?>>
            <span id="el_V_KASIR_id_tujuan" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_tujuan->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_tujuan" name="x_id_tujuan" id="x_id_tujuan" size="30" placeholder="<?= HtmlEncode($Page->id_tujuan->getPlaceHolder()) ?>" value="<?= $Page->id_tujuan->EditValue ?>"<?= $Page->id_tujuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_tujuan->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
    <div id="r_id_penunjang" class="form-group row">
        <label for="x_id_penunjang" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_id_penunjang"><?= $Page->id_penunjang->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_penunjang" id="z_id_penunjang" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_penunjang->cellAttributes() ?>>
            <span id="el_V_KASIR_id_penunjang" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_penunjang->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_penunjang" name="x_id_penunjang" id="x_id_penunjang" size="30" placeholder="<?= HtmlEncode($Page->id_penunjang->getPlaceHolder()) ?>" value="<?= $Page->id_penunjang->EditValue ?>"<?= $Page->id_penunjang->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_penunjang->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
    <div id="r_id_pembiayaan" class="form-group row">
        <label for="x_id_pembiayaan" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_id_pembiayaan"><?= $Page->id_pembiayaan->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_pembiayaan" id="z_id_pembiayaan" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pembiayaan->cellAttributes() ?>>
            <span id="el_V_KASIR_id_pembiayaan" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_pembiayaan->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_pembiayaan" name="x_id_pembiayaan" id="x_id_pembiayaan" size="30" placeholder="<?= HtmlEncode($Page->id_pembiayaan->getPlaceHolder()) ?>" value="<?= $Page->id_pembiayaan->EditValue ?>"<?= $Page->id_pembiayaan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_pembiayaan->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
    <div id="r_id_procedure" class="form-group row">
        <label for="x_id_procedure" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_id_procedure"><?= $Page->id_procedure->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_procedure" id="z_id_procedure" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_procedure->cellAttributes() ?>>
            <span id="el_V_KASIR_id_procedure" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_procedure->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_procedure" name="x_id_procedure" id="x_id_procedure" size="30" placeholder="<?= HtmlEncode($Page->id_procedure->getPlaceHolder()) ?>" value="<?= $Page->id_procedure->EditValue ?>"<?= $Page->id_procedure->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_procedure->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
    <div id="r_id_aspel" class="form-group row">
        <label for="x_id_aspel" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_id_aspel"><?= $Page->id_aspel->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_aspel" id="z_id_aspel" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_aspel->cellAttributes() ?>>
            <span id="el_V_KASIR_id_aspel" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_aspel->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_aspel" name="x_id_aspel" id="x_id_aspel" size="30" placeholder="<?= HtmlEncode($Page->id_aspel->getPlaceHolder()) ?>" value="<?= $Page->id_aspel->EditValue ?>"<?= $Page->id_aspel->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_aspel->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
    <div id="r_id_kelas" class="form-group row">
        <label for="x_id_kelas" class="<?= $Page->LeftColumnClass ?>"><span id="elh_V_KASIR_id_kelas"><?= $Page->id_kelas->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id_kelas" id="z_id_kelas" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_kelas->cellAttributes() ?>>
            <span id="el_V_KASIR_id_kelas" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id_kelas->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_kelas" name="x_id_kelas" id="x_id_kelas" size="30" placeholder="<?= HtmlEncode($Page->id_kelas->getPlaceHolder()) ?>" value="<?= $Page->id_kelas->EditValue ?>"<?= $Page->id_kelas->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id_kelas->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("Search") ?></button>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="location.reload();"><?= $Language->phrase("Reset") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("V_KASIR");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
