<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$VKasirEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fV_KASIRedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fV_KASIRedit = currentForm = new ew.Form("fV_KASIRedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "V_KASIR")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.V_KASIR)
        ew.vars.tables.V_KASIR = currentTable;
    fV_KASIRedit.addFields([
        ["CETAK", [fields.CETAK.visible && fields.CETAK.required ? ew.Validators.required(fields.CETAK.caption) : null], fields.CETAK.isInvalid],
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["STATUS_PASIEN_ID", [fields.STATUS_PASIEN_ID.visible && fields.STATUS_PASIEN_ID.required ? ew.Validators.required(fields.STATUS_PASIEN_ID.caption) : null], fields.STATUS_PASIEN_ID.isInvalid],
        ["RUJUKAN_ID", [fields.RUJUKAN_ID.visible && fields.RUJUKAN_ID.required ? ew.Validators.required(fields.RUJUKAN_ID.caption) : null], fields.RUJUKAN_ID.isInvalid],
        ["REASON_ID", [fields.REASON_ID.visible && fields.REASON_ID.required ? ew.Validators.required(fields.REASON_ID.caption) : null], fields.REASON_ID.isInvalid],
        ["WAY_ID", [fields.WAY_ID.visible && fields.WAY_ID.required ? ew.Validators.required(fields.WAY_ID.caption) : null], fields.WAY_ID.isInvalid],
        ["VISIT_DATE", [fields.VISIT_DATE.visible && fields.VISIT_DATE.required ? ew.Validators.required(fields.VISIT_DATE.caption) : null], fields.VISIT_DATE.isInvalid],
        ["CLINIC_ID", [fields.CLINIC_ID.visible && fields.CLINIC_ID.required ? ew.Validators.required(fields.CLINIC_ID.caption) : null], fields.CLINIC_ID.isInvalid],
        ["GENDER", [fields.GENDER.visible && fields.GENDER.required ? ew.Validators.required(fields.GENDER.caption) : null], fields.GENDER.isInvalid],
        ["PAYOR_ID", [fields.PAYOR_ID.visible && fields.PAYOR_ID.required ? ew.Validators.required(fields.PAYOR_ID.caption) : null], fields.PAYOR_ID.isInvalid],
        ["CLASS_ID", [fields.CLASS_ID.visible && fields.CLASS_ID.required ? ew.Validators.required(fields.CLASS_ID.caption) : null], fields.CLASS_ID.isInvalid],
        ["COVERAGE_ID", [fields.COVERAGE_ID.visible && fields.COVERAGE_ID.required ? ew.Validators.required(fields.COVERAGE_ID.caption) : null], fields.COVERAGE_ID.isInvalid],
        ["NO_SKP", [fields.NO_SKP.visible && fields.NO_SKP.required ? ew.Validators.required(fields.NO_SKP.caption) : null], fields.NO_SKP.isInvalid],
        ["NO_SKPINAP", [fields.NO_SKPINAP.visible && fields.NO_SKPINAP.required ? ew.Validators.required(fields.NO_SKPINAP.caption) : null], fields.NO_SKPINAP.isInvalid],
        ["DIAGNOSA_ID", [fields.DIAGNOSA_ID.visible && fields.DIAGNOSA_ID.required ? ew.Validators.required(fields.DIAGNOSA_ID.caption) : null], fields.DIAGNOSA_ID.isInvalid],
        ["NORUJUKAN", [fields.NORUJUKAN.visible && fields.NORUJUKAN.required ? ew.Validators.required(fields.NORUJUKAN.caption) : null], fields.NORUJUKAN.isInvalid],
        ["PPKRUJUKAN", [fields.PPKRUJUKAN.visible && fields.PPKRUJUKAN.required ? ew.Validators.required(fields.PPKRUJUKAN.caption) : null], fields.PPKRUJUKAN.isInvalid],
        ["EDIT_SEP", [fields.EDIT_SEP.visible && fields.EDIT_SEP.required ? ew.Validators.required(fields.EDIT_SEP.caption) : null], fields.EDIT_SEP.isInvalid],
        ["DIAG_AWAL", [fields.DIAG_AWAL.visible && fields.DIAG_AWAL.required ? ew.Validators.required(fields.DIAG_AWAL.caption) : null], fields.DIAG_AWAL.isInvalid],
        ["COB", [fields.COB.visible && fields.COB.required ? ew.Validators.required(fields.COB.caption) : null], fields.COB.isInvalid],
        ["ASALRUJUKAN", [fields.ASALRUJUKAN.visible && fields.ASALRUJUKAN.required ? ew.Validators.required(fields.ASALRUJUKAN.caption) : null], fields.ASALRUJUKAN.isInvalid],
        ["tgl_kontrol", [fields.tgl_kontrol.visible && fields.tgl_kontrol.required ? ew.Validators.required(fields.tgl_kontrol.caption) : null, ew.Validators.datetime(0)], fields.tgl_kontrol.isInvalid],
        ["idbooking", [fields.idbooking.visible && fields.idbooking.required ? ew.Validators.required(fields.idbooking.caption) : null], fields.idbooking.isInvalid],
        ["id_tujuan", [fields.id_tujuan.visible && fields.id_tujuan.required ? ew.Validators.required(fields.id_tujuan.caption) : null, ew.Validators.integer], fields.id_tujuan.isInvalid],
        ["id_penunjang", [fields.id_penunjang.visible && fields.id_penunjang.required ? ew.Validators.required(fields.id_penunjang.caption) : null, ew.Validators.integer], fields.id_penunjang.isInvalid],
        ["id_pembiayaan", [fields.id_pembiayaan.visible && fields.id_pembiayaan.required ? ew.Validators.required(fields.id_pembiayaan.caption) : null, ew.Validators.integer], fields.id_pembiayaan.isInvalid],
        ["id_procedure", [fields.id_procedure.visible && fields.id_procedure.required ? ew.Validators.required(fields.id_procedure.caption) : null, ew.Validators.integer], fields.id_procedure.isInvalid],
        ["id_aspel", [fields.id_aspel.visible && fields.id_aspel.required ? ew.Validators.required(fields.id_aspel.caption) : null, ew.Validators.integer], fields.id_aspel.isInvalid],
        ["id_kelas", [fields.id_kelas.visible && fields.id_kelas.required ? ew.Validators.required(fields.id_kelas.caption) : null, ew.Validators.integer], fields.id_kelas.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fV_KASIRedit,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fV_KASIRedit.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fV_KASIRedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fV_KASIRedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fV_KASIRedit.lists.NO_REGISTRATION = <?= $Page->NO_REGISTRATION->toClientList($Page) ?>;
    fV_KASIRedit.lists.STATUS_PASIEN_ID = <?= $Page->STATUS_PASIEN_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.RUJUKAN_ID = <?= $Page->RUJUKAN_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.REASON_ID = <?= $Page->REASON_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.WAY_ID = <?= $Page->WAY_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.CLINIC_ID = <?= $Page->CLINIC_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.GENDER = <?= $Page->GENDER->toClientList($Page) ?>;
    fV_KASIRedit.lists.PAYOR_ID = <?= $Page->PAYOR_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.CLASS_ID = <?= $Page->CLASS_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.COVERAGE_ID = <?= $Page->COVERAGE_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.DIAGNOSA_ID = <?= $Page->DIAGNOSA_ID->toClientList($Page) ?>;
    fV_KASIRedit.lists.PPKRUJUKAN = <?= $Page->PPKRUJUKAN->toClientList($Page) ?>;
    fV_KASIRedit.lists.COB = <?= $Page->COB->toClientList($Page) ?>;
    loadjs.done("fV_KASIRedit");
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
<form name="fV_KASIRedit" id="fV_KASIRedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="V_KASIR">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->CETAK->Visible) { // CETAK ?>
    <div id="r_CETAK" class="form-group row">
        <label id="elh_V_KASIR_CETAK" for="x_CETAK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CETAK->caption() ?><?= $Page->CETAK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CETAK->cellAttributes() ?>>
<span id="el_V_KASIR_CETAK">
<script>

function Buka(link="") {
	window.open(link, 'newwindow', 'width=800,height=400');
	return false;
}
</script>
<div class="btn-group btn-group-sm ew-btn-group">
	<a class="btn bg-navy ew-row-link ew-detail" href="print.html"
	onclick="Buka('/simrs/reporting/nota_kwitansi_ringkas.php?id=<?php echo urlencode(CurrentPage()->VISIT_ID->CurrentValue)?>'); return false">NOTA</a>
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
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label id="elh_V_KASIR_NO_REGISTRATION" for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION->caption() ?><?= $Page->NO_REGISTRATION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_V_KASIR_NO_REGISTRATION">
<div class="input-group ew-lookup-list" aria-describedby="x_NO_REGISTRATION_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_NO_REGISTRATION"><?= EmptyValue(strval($Page->NO_REGISTRATION->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->NO_REGISTRATION->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->NO_REGISTRATION->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->NO_REGISTRATION->ReadOnly || $Page->NO_REGISTRATION->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_NO_REGISTRATION',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->NO_REGISTRATION->getErrorMessage() ?></div>
<?= $Page->NO_REGISTRATION->getCustomMessage() ?>
<?= $Page->NO_REGISTRATION->Lookup->getParamTag($Page, "p_x_NO_REGISTRATION") ?>
<input type="hidden" is="selection-list" data-table="V_KASIR" data-field="x_NO_REGISTRATION" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->NO_REGISTRATION->displayValueSeparatorAttribute() ?>" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" value="<?= $Page->NO_REGISTRATION->CurrentValue ?>"<?= $Page->NO_REGISTRATION->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <div id="r_STATUS_PASIEN_ID" class="form-group row">
        <label id="elh_V_KASIR_STATUS_PASIEN_ID" for="x_STATUS_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_PASIEN_ID->caption() ?><?= $Page->STATUS_PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_V_KASIR_STATUS_PASIEN_ID">
<?php $Page->STATUS_PASIEN_ID->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x_STATUS_PASIEN_ID"
        name="x_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Page->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_STATUS_PASIEN_ID"
        data-table="V_KASIR"
        data-field="x_STATUS_PASIEN_ID"
        data-value-separator="<?= $Page->STATUS_PASIEN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->STATUS_PASIEN_ID->getPlaceHolder()) ?>"
        <?= $Page->STATUS_PASIEN_ID->editAttributes() ?>>
        <?= $Page->STATUS_PASIEN_ID->selectOptionListHtml("x_STATUS_PASIEN_ID") ?>
    </select>
    <?= $Page->STATUS_PASIEN_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->STATUS_PASIEN_ID->getErrorMessage() ?></div>
<?= $Page->STATUS_PASIEN_ID->Lookup->getParamTag($Page, "p_x_STATUS_PASIEN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_STATUS_PASIEN_ID']"),
        options = { name: "x_STATUS_PASIEN_ID", selectId: "V_KASIR_x_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->RUJUKAN_ID->Visible) { // RUJUKAN_ID ?>
    <div id="r_RUJUKAN_ID" class="form-group row">
        <label id="elh_V_KASIR_RUJUKAN_ID" for="x_RUJUKAN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->RUJUKAN_ID->caption() ?><?= $Page->RUJUKAN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RUJUKAN_ID->cellAttributes() ?>>
<span id="el_V_KASIR_RUJUKAN_ID">
    <select
        id="x_RUJUKAN_ID"
        name="x_RUJUKAN_ID"
        class="form-control ew-select<?= $Page->RUJUKAN_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_RUJUKAN_ID"
        data-table="V_KASIR"
        data-field="x_RUJUKAN_ID"
        data-value-separator="<?= $Page->RUJUKAN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->RUJUKAN_ID->getPlaceHolder()) ?>"
        <?= $Page->RUJUKAN_ID->editAttributes() ?>>
        <?= $Page->RUJUKAN_ID->selectOptionListHtml("x_RUJUKAN_ID") ?>
    </select>
    <?= $Page->RUJUKAN_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->RUJUKAN_ID->getErrorMessage() ?></div>
<?= $Page->RUJUKAN_ID->Lookup->getParamTag($Page, "p_x_RUJUKAN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_RUJUKAN_ID']"),
        options = { name: "x_RUJUKAN_ID", selectId: "V_KASIR_x_RUJUKAN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.RUJUKAN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->REASON_ID->Visible) { // REASON_ID ?>
    <div id="r_REASON_ID" class="form-group row">
        <label id="elh_V_KASIR_REASON_ID" for="x_REASON_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->REASON_ID->caption() ?><?= $Page->REASON_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->REASON_ID->cellAttributes() ?>>
<span id="el_V_KASIR_REASON_ID">
    <select
        id="x_REASON_ID"
        name="x_REASON_ID"
        class="form-control ew-select<?= $Page->REASON_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_REASON_ID"
        data-table="V_KASIR"
        data-field="x_REASON_ID"
        data-value-separator="<?= $Page->REASON_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->REASON_ID->getPlaceHolder()) ?>"
        <?= $Page->REASON_ID->editAttributes() ?>>
        <?= $Page->REASON_ID->selectOptionListHtml("x_REASON_ID") ?>
    </select>
    <?= $Page->REASON_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->REASON_ID->getErrorMessage() ?></div>
<?= $Page->REASON_ID->Lookup->getParamTag($Page, "p_x_REASON_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_REASON_ID']"),
        options = { name: "x_REASON_ID", selectId: "V_KASIR_x_REASON_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.REASON_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->WAY_ID->Visible) { // WAY_ID ?>
    <div id="r_WAY_ID" class="form-group row">
        <label id="elh_V_KASIR_WAY_ID" for="x_WAY_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->WAY_ID->caption() ?><?= $Page->WAY_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->WAY_ID->cellAttributes() ?>>
<span id="el_V_KASIR_WAY_ID">
    <select
        id="x_WAY_ID"
        name="x_WAY_ID"
        class="form-control ew-select<?= $Page->WAY_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_WAY_ID"
        data-table="V_KASIR"
        data-field="x_WAY_ID"
        data-value-separator="<?= $Page->WAY_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->WAY_ID->getPlaceHolder()) ?>"
        <?= $Page->WAY_ID->editAttributes() ?>>
        <?= $Page->WAY_ID->selectOptionListHtml("x_WAY_ID") ?>
    </select>
    <?= $Page->WAY_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->WAY_ID->getErrorMessage() ?></div>
<?= $Page->WAY_ID->Lookup->getParamTag($Page, "p_x_WAY_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_WAY_ID']"),
        options = { name: "x_WAY_ID", selectId: "V_KASIR_x_WAY_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.WAY_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <div id="r_CLINIC_ID" class="form-group row">
        <label id="elh_V_KASIR_CLINIC_ID" for="x_CLINIC_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLINIC_ID->caption() ?><?= $Page->CLINIC_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_V_KASIR_CLINIC_ID">
    <select
        id="x_CLINIC_ID"
        name="x_CLINIC_ID"
        class="form-control ew-select<?= $Page->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_CLINIC_ID"
        data-table="V_KASIR"
        data-field="x_CLINIC_ID"
        data-value-separator="<?= $Page->CLINIC_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLINIC_ID->getPlaceHolder()) ?>"
        <?= $Page->CLINIC_ID->editAttributes() ?>>
        <?= $Page->CLINIC_ID->selectOptionListHtml("x_CLINIC_ID") ?>
    </select>
    <?= $Page->CLINIC_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->CLINIC_ID->getErrorMessage() ?></div>
<?= $Page->CLINIC_ID->Lookup->getParamTag($Page, "p_x_CLINIC_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_CLINIC_ID']"),
        options = { name: "x_CLINIC_ID", selectId: "V_KASIR_x_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <div id="r_GENDER" class="form-group row">
        <label id="elh_V_KASIR_GENDER" for="x_GENDER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GENDER->caption() ?><?= $Page->GENDER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->GENDER->cellAttributes() ?>>
<span id="el_V_KASIR_GENDER">
    <select
        id="x_GENDER"
        name="x_GENDER"
        class="form-control ew-select<?= $Page->GENDER->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_GENDER"
        data-table="V_KASIR"
        data-field="x_GENDER"
        data-value-separator="<?= $Page->GENDER->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->GENDER->getPlaceHolder()) ?>"
        <?= $Page->GENDER->editAttributes() ?>>
        <?= $Page->GENDER->selectOptionListHtml("x_GENDER") ?>
    </select>
    <?= $Page->GENDER->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->GENDER->getErrorMessage() ?></div>
<?= $Page->GENDER->Lookup->getParamTag($Page, "p_x_GENDER") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_GENDER']"),
        options = { name: "x_GENDER", selectId: "V_KASIR_x_GENDER", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.GENDER.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <div id="r_PAYOR_ID" class="form-group row">
        <label id="elh_V_KASIR_PAYOR_ID" for="x_PAYOR_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYOR_ID->caption() ?><?= $Page->PAYOR_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el_V_KASIR_PAYOR_ID">
    <select
        id="x_PAYOR_ID"
        name="x_PAYOR_ID"
        class="form-control ew-select<?= $Page->PAYOR_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_PAYOR_ID"
        data-table="V_KASIR"
        data-field="x_PAYOR_ID"
        data-value-separator="<?= $Page->PAYOR_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PAYOR_ID->getPlaceHolder()) ?>"
        <?= $Page->PAYOR_ID->editAttributes() ?>>
        <?= $Page->PAYOR_ID->selectOptionListHtml("x_PAYOR_ID") ?>
    </select>
    <?= $Page->PAYOR_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PAYOR_ID->getErrorMessage() ?></div>
<?= $Page->PAYOR_ID->Lookup->getParamTag($Page, "p_x_PAYOR_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_PAYOR_ID']"),
        options = { name: "x_PAYOR_ID", selectId: "V_KASIR_x_PAYOR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.PAYOR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <div id="r_CLASS_ID" class="form-group row">
        <label id="elh_V_KASIR_CLASS_ID" for="x_CLASS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLASS_ID->caption() ?><?= $Page->CLASS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_V_KASIR_CLASS_ID">
    <select
        id="x_CLASS_ID"
        name="x_CLASS_ID"
        class="form-control ew-select<?= $Page->CLASS_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_CLASS_ID"
        data-table="V_KASIR"
        data-field="x_CLASS_ID"
        data-value-separator="<?= $Page->CLASS_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLASS_ID->getPlaceHolder()) ?>"
        <?= $Page->CLASS_ID->editAttributes() ?>>
        <?= $Page->CLASS_ID->selectOptionListHtml("x_CLASS_ID") ?>
    </select>
    <?= $Page->CLASS_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->CLASS_ID->getErrorMessage() ?></div>
<?= $Page->CLASS_ID->Lookup->getParamTag($Page, "p_x_CLASS_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_CLASS_ID']"),
        options = { name: "x_CLASS_ID", selectId: "V_KASIR_x_CLASS_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.CLASS_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->COVERAGE_ID->Visible) { // COVERAGE_ID ?>
    <div id="r_COVERAGE_ID" class="form-group row">
        <label id="elh_V_KASIR_COVERAGE_ID" for="x_COVERAGE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->COVERAGE_ID->caption() ?><?= $Page->COVERAGE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COVERAGE_ID->cellAttributes() ?>>
<span id="el_V_KASIR_COVERAGE_ID">
    <select
        id="x_COVERAGE_ID"
        name="x_COVERAGE_ID"
        class="form-control ew-select<?= $Page->COVERAGE_ID->isInvalidClass() ?>"
        data-select2-id="V_KASIR_x_COVERAGE_ID"
        data-table="V_KASIR"
        data-field="x_COVERAGE_ID"
        data-value-separator="<?= $Page->COVERAGE_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->COVERAGE_ID->getPlaceHolder()) ?>"
        <?= $Page->COVERAGE_ID->editAttributes() ?>>
        <?= $Page->COVERAGE_ID->selectOptionListHtml("x_COVERAGE_ID") ?>
    </select>
    <?= $Page->COVERAGE_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->COVERAGE_ID->getErrorMessage() ?></div>
<?= $Page->COVERAGE_ID->Lookup->getParamTag($Page, "p_x_COVERAGE_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='V_KASIR_x_COVERAGE_ID']"),
        options = { name: "x_COVERAGE_ID", selectId: "V_KASIR_x_COVERAGE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.V_KASIR.fields.COVERAGE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_SKP->Visible) { // NO_SKP ?>
    <div id="r_NO_SKP" class="form-group row">
        <label id="elh_V_KASIR_NO_SKP" for="x_NO_SKP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_SKP->caption() ?><?= $Page->NO_SKP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_SKP->cellAttributes() ?>>
<span id="el_V_KASIR_NO_SKP">
<span<?= $Page->NO_SKP->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NO_SKP->getDisplayValue($Page->NO_SKP->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="V_KASIR" data-field="x_NO_SKP" data-hidden="1" name="x_NO_SKP" id="x_NO_SKP" value="<?= HtmlEncode($Page->NO_SKP->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_SKPINAP->Visible) { // NO_SKPINAP ?>
    <div id="r_NO_SKPINAP" class="form-group row">
        <label id="elh_V_KASIR_NO_SKPINAP" for="x_NO_SKPINAP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_SKPINAP->caption() ?><?= $Page->NO_SKPINAP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_SKPINAP->cellAttributes() ?>>
<span id="el_V_KASIR_NO_SKPINAP">
<span<?= $Page->NO_SKPINAP->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NO_SKPINAP->getDisplayValue($Page->NO_SKPINAP->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="V_KASIR" data-field="x_NO_SKPINAP" data-hidden="1" name="x_NO_SKPINAP" id="x_NO_SKPINAP" value="<?= HtmlEncode($Page->NO_SKPINAP->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAGNOSA_ID->Visible) { // DIAGNOSA_ID ?>
    <div id="r_DIAGNOSA_ID" class="form-group row">
        <label id="elh_V_KASIR_DIAGNOSA_ID" for="x_DIAGNOSA_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAGNOSA_ID->caption() ?><?= $Page->DIAGNOSA_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAGNOSA_ID->cellAttributes() ?>>
<span id="el_V_KASIR_DIAGNOSA_ID">
<div class="input-group ew-lookup-list" aria-describedby="x_DIAGNOSA_ID_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DIAGNOSA_ID"><?= EmptyValue(strval($Page->DIAGNOSA_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->DIAGNOSA_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->DIAGNOSA_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->DIAGNOSA_ID->ReadOnly || $Page->DIAGNOSA_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DIAGNOSA_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->DIAGNOSA_ID->getErrorMessage() ?></div>
<?= $Page->DIAGNOSA_ID->getCustomMessage() ?>
<?= $Page->DIAGNOSA_ID->Lookup->getParamTag($Page, "p_x_DIAGNOSA_ID") ?>
<input type="hidden" is="selection-list" data-table="V_KASIR" data-field="x_DIAGNOSA_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->DIAGNOSA_ID->displayValueSeparatorAttribute() ?>" name="x_DIAGNOSA_ID" id="x_DIAGNOSA_ID" value="<?= $Page->DIAGNOSA_ID->CurrentValue ?>"<?= $Page->DIAGNOSA_ID->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NORUJUKAN->Visible) { // NORUJUKAN ?>
    <div id="r_NORUJUKAN" class="form-group row">
        <label id="elh_V_KASIR_NORUJUKAN" for="x_NORUJUKAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NORUJUKAN->caption() ?><?= $Page->NORUJUKAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NORUJUKAN->cellAttributes() ?>>
<span id="el_V_KASIR_NORUJUKAN">
<span<?= $Page->NORUJUKAN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NORUJUKAN->getDisplayValue($Page->NORUJUKAN->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="V_KASIR" data-field="x_NORUJUKAN" data-hidden="1" name="x_NORUJUKAN" id="x_NORUJUKAN" value="<?= HtmlEncode($Page->NORUJUKAN->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PPKRUJUKAN->Visible) { // PPKRUJUKAN ?>
    <div id="r_PPKRUJUKAN" class="form-group row">
        <label id="elh_V_KASIR_PPKRUJUKAN" for="x_PPKRUJUKAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PPKRUJUKAN->caption() ?><?= $Page->PPKRUJUKAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PPKRUJUKAN->cellAttributes() ?>>
<span id="el_V_KASIR_PPKRUJUKAN">
<div class="input-group ew-lookup-list" aria-describedby="x_PPKRUJUKAN_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PPKRUJUKAN"><?= EmptyValue(strval($Page->PPKRUJUKAN->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->PPKRUJUKAN->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->PPKRUJUKAN->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->PPKRUJUKAN->ReadOnly || $Page->PPKRUJUKAN->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PPKRUJUKAN',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->PPKRUJUKAN->getErrorMessage() ?></div>
<?= $Page->PPKRUJUKAN->getCustomMessage() ?>
<?= $Page->PPKRUJUKAN->Lookup->getParamTag($Page, "p_x_PPKRUJUKAN") ?>
<input type="hidden" is="selection-list" data-table="V_KASIR" data-field="x_PPKRUJUKAN" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->PPKRUJUKAN->displayValueSeparatorAttribute() ?>" name="x_PPKRUJUKAN" id="x_PPKRUJUKAN" value="<?= $Page->PPKRUJUKAN->CurrentValue ?>"<?= $Page->PPKRUJUKAN->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->EDIT_SEP->Visible) { // EDIT_SEP ?>
    <div id="r_EDIT_SEP" class="form-group row">
        <label id="elh_V_KASIR_EDIT_SEP" for="x_EDIT_SEP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EDIT_SEP->caption() ?><?= $Page->EDIT_SEP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EDIT_SEP->cellAttributes() ?>>
<span id="el_V_KASIR_EDIT_SEP">
<span<?= $Page->EDIT_SEP->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->EDIT_SEP->getDisplayValue($Page->EDIT_SEP->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="V_KASIR" data-field="x_EDIT_SEP" data-hidden="1" name="x_EDIT_SEP" id="x_EDIT_SEP" value="<?= HtmlEncode($Page->EDIT_SEP->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DIAG_AWAL->Visible) { // DIAG_AWAL ?>
    <div id="r_DIAG_AWAL" class="form-group row">
        <label id="elh_V_KASIR_DIAG_AWAL" for="x_DIAG_AWAL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DIAG_AWAL->caption() ?><?= $Page->DIAG_AWAL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DIAG_AWAL->cellAttributes() ?>>
<span id="el_V_KASIR_DIAG_AWAL">
<input type="<?= $Page->DIAG_AWAL->getInputTextType() ?>" data-table="V_KASIR" data-field="x_DIAG_AWAL" name="x_DIAG_AWAL" id="x_DIAG_AWAL" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->DIAG_AWAL->getPlaceHolder()) ?>" value="<?= $Page->DIAG_AWAL->EditValue ?>"<?= $Page->DIAG_AWAL->editAttributes() ?> aria-describedby="x_DIAG_AWAL_help">
<?= $Page->DIAG_AWAL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DIAG_AWAL->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->COB->Visible) { // COB ?>
    <div id="r_COB" class="form-group row">
        <label id="elh_V_KASIR_COB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->COB->caption() ?><?= $Page->COB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->COB->cellAttributes() ?>>
<span id="el_V_KASIR_COB">
<template id="tp_x_COB">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" data-table="V_KASIR" data-field="x_COB" name="x_COB" id="x_COB"<?= $Page->COB->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_COB" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_COB[]"
    name="x_COB[]"
    value="<?= HtmlEncode($Page->COB->CurrentValue) ?>"
    data-type="select-multiple"
    data-template="tp_x_COB"
    data-target="dsl_x_COB"
    data-repeatcolumn="5"
    class="form-control<?= $Page->COB->isInvalidClass() ?>"
    data-table="V_KASIR"
    data-field="x_COB"
    data-value-separator="<?= $Page->COB->displayValueSeparatorAttribute() ?>"
    <?= $Page->COB->editAttributes() ?>>
<?= $Page->COB->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->COB->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ASALRUJUKAN->Visible) { // ASALRUJUKAN ?>
    <div id="r_ASALRUJUKAN" class="form-group row">
        <label id="elh_V_KASIR_ASALRUJUKAN" for="x_ASALRUJUKAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ASALRUJUKAN->caption() ?><?= $Page->ASALRUJUKAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ASALRUJUKAN->cellAttributes() ?>>
<span id="el_V_KASIR_ASALRUJUKAN">
<input type="<?= $Page->ASALRUJUKAN->getInputTextType() ?>" data-table="V_KASIR" data-field="x_ASALRUJUKAN" name="x_ASALRUJUKAN" id="x_ASALRUJUKAN" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->ASALRUJUKAN->getPlaceHolder()) ?>" value="<?= $Page->ASALRUJUKAN->EditValue ?>"<?= $Page->ASALRUJUKAN->editAttributes() ?> aria-describedby="x_ASALRUJUKAN_help">
<?= $Page->ASALRUJUKAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ASALRUJUKAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_kontrol->Visible) { // tgl_kontrol ?>
    <div id="r_tgl_kontrol" class="form-group row">
        <label id="elh_V_KASIR_tgl_kontrol" for="x_tgl_kontrol" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_kontrol->caption() ?><?= $Page->tgl_kontrol->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl_kontrol->cellAttributes() ?>>
<span id="el_V_KASIR_tgl_kontrol">
<input type="<?= $Page->tgl_kontrol->getInputTextType() ?>" data-table="V_KASIR" data-field="x_tgl_kontrol" name="x_tgl_kontrol" id="x_tgl_kontrol" placeholder="<?= HtmlEncode($Page->tgl_kontrol->getPlaceHolder()) ?>" value="<?= $Page->tgl_kontrol->EditValue ?>"<?= $Page->tgl_kontrol->editAttributes() ?> aria-describedby="x_tgl_kontrol_help">
<?= $Page->tgl_kontrol->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_kontrol->getErrorMessage() ?></div>
<?php if (!$Page->tgl_kontrol->ReadOnly && !$Page->tgl_kontrol->Disabled && !isset($Page->tgl_kontrol->EditAttrs["readonly"]) && !isset($Page->tgl_kontrol->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fV_KASIRedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fV_KASIRedit", "x_tgl_kontrol", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idbooking->Visible) { // idbooking ?>
    <div id="r_idbooking" class="form-group row">
        <label id="elh_V_KASIR_idbooking" for="x_idbooking" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idbooking->caption() ?><?= $Page->idbooking->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idbooking->cellAttributes() ?>>
<span id="el_V_KASIR_idbooking">
<input type="<?= $Page->idbooking->getInputTextType() ?>" data-table="V_KASIR" data-field="x_idbooking" name="x_idbooking" id="x_idbooking" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->idbooking->getPlaceHolder()) ?>" value="<?= $Page->idbooking->EditValue ?>"<?= $Page->idbooking->editAttributes() ?> aria-describedby="x_idbooking_help">
<?= $Page->idbooking->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idbooking->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
    <div id="r_id_tujuan" class="form-group row">
        <label id="elh_V_KASIR_id_tujuan" for="x_id_tujuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_tujuan->caption() ?><?= $Page->id_tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_tujuan->cellAttributes() ?>>
<span id="el_V_KASIR_id_tujuan">
<input type="<?= $Page->id_tujuan->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_tujuan" name="x_id_tujuan" id="x_id_tujuan" size="30" placeholder="<?= HtmlEncode($Page->id_tujuan->getPlaceHolder()) ?>" value="<?= $Page->id_tujuan->EditValue ?>"<?= $Page->id_tujuan->editAttributes() ?> aria-describedby="x_id_tujuan_help">
<?= $Page->id_tujuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_tujuan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
    <div id="r_id_penunjang" class="form-group row">
        <label id="elh_V_KASIR_id_penunjang" for="x_id_penunjang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_penunjang->caption() ?><?= $Page->id_penunjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_penunjang->cellAttributes() ?>>
<span id="el_V_KASIR_id_penunjang">
<input type="<?= $Page->id_penunjang->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_penunjang" name="x_id_penunjang" id="x_id_penunjang" size="30" placeholder="<?= HtmlEncode($Page->id_penunjang->getPlaceHolder()) ?>" value="<?= $Page->id_penunjang->EditValue ?>"<?= $Page->id_penunjang->editAttributes() ?> aria-describedby="x_id_penunjang_help">
<?= $Page->id_penunjang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_penunjang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
    <div id="r_id_pembiayaan" class="form-group row">
        <label id="elh_V_KASIR_id_pembiayaan" for="x_id_pembiayaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_pembiayaan->caption() ?><?= $Page->id_pembiayaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pembiayaan->cellAttributes() ?>>
<span id="el_V_KASIR_id_pembiayaan">
<input type="<?= $Page->id_pembiayaan->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_pembiayaan" name="x_id_pembiayaan" id="x_id_pembiayaan" size="30" placeholder="<?= HtmlEncode($Page->id_pembiayaan->getPlaceHolder()) ?>" value="<?= $Page->id_pembiayaan->EditValue ?>"<?= $Page->id_pembiayaan->editAttributes() ?> aria-describedby="x_id_pembiayaan_help">
<?= $Page->id_pembiayaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_pembiayaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_procedure->Visible) { // id_procedure ?>
    <div id="r_id_procedure" class="form-group row">
        <label id="elh_V_KASIR_id_procedure" for="x_id_procedure" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_procedure->caption() ?><?= $Page->id_procedure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_procedure->cellAttributes() ?>>
<span id="el_V_KASIR_id_procedure">
<input type="<?= $Page->id_procedure->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_procedure" name="x_id_procedure" id="x_id_procedure" size="30" placeholder="<?= HtmlEncode($Page->id_procedure->getPlaceHolder()) ?>" value="<?= $Page->id_procedure->EditValue ?>"<?= $Page->id_procedure->editAttributes() ?> aria-describedby="x_id_procedure_help">
<?= $Page->id_procedure->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_procedure->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_aspel->Visible) { // id_aspel ?>
    <div id="r_id_aspel" class="form-group row">
        <label id="elh_V_KASIR_id_aspel" for="x_id_aspel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_aspel->caption() ?><?= $Page->id_aspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_aspel->cellAttributes() ?>>
<span id="el_V_KASIR_id_aspel">
<input type="<?= $Page->id_aspel->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_aspel" name="x_id_aspel" id="x_id_aspel" size="30" placeholder="<?= HtmlEncode($Page->id_aspel->getPlaceHolder()) ?>" value="<?= $Page->id_aspel->EditValue ?>"<?= $Page->id_aspel->editAttributes() ?> aria-describedby="x_id_aspel_help">
<?= $Page->id_aspel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_aspel->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
    <div id="r_id_kelas" class="form-group row">
        <label id="elh_V_KASIR_id_kelas" for="x_id_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_kelas->caption() ?><?= $Page->id_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_kelas->cellAttributes() ?>>
<span id="el_V_KASIR_id_kelas">
<input type="<?= $Page->id_kelas->getInputTextType() ?>" data-table="V_KASIR" data-field="x_id_kelas" name="x_id_kelas" id="x_id_kelas" size="30" placeholder="<?= HtmlEncode($Page->id_kelas->getPlaceHolder()) ?>" value="<?= $Page->id_kelas->EditValue ?>"<?= $Page->id_kelas->editAttributes() ?> aria-describedby="x_id_kelas_help">
<?= $Page->id_kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_kelas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="V_KASIR" data-field="x_IDXDAFTAR" data-hidden="1" name="x_IDXDAFTAR" id="x_IDXDAFTAR" value="<?= HtmlEncode($Page->IDXDAFTAR->CurrentValue) ?>">
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
    $firstActiveDetailTable = $Page->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="Page_details"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
    if (in_array("TREATMENT_AKOMODASI", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_AKOMODASI->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "TREATMENT_AKOMODASI") {
            $firstActiveDetailTable = "TREATMENT_AKOMODASI";
        }
?>
        <li class="nav-item"><a class="nav-link <?= $Page->DetailPages->pageStyle("TREATMENT_AKOMODASI") ?>" href="#tab_TREATMENT_AKOMODASI" data-toggle="tab"><?= $Language->tablePhrase("TREATMENT_AKOMODASI", "TblCaption") ?></a></li>
<?php
    }
?>
<?php
    if (in_array("TREATMENT_BILL", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_BILL->DetailEdit) {
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
    if (in_array("TREATMENT_AKOMODASI", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_AKOMODASI->DetailEdit) {
        if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "TREATMENT_AKOMODASI") {
            $firstActiveDetailTable = "TREATMENT_AKOMODASI";
        }
?>
        <div class="tab-pane <?= $Page->DetailPages->pageStyle("TREATMENT_AKOMODASI") ?>" id="tab_TREATMENT_AKOMODASI"><!-- page* -->
<?php include_once "TreatmentAkomodasiGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("TREATMENT_BILL", explode(",", $Page->getCurrentDetailTable())) && $TREATMENT_BILL->DetailEdit) {
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
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
