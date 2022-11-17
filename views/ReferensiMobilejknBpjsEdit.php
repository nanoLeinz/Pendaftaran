<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ReferensiMobilejknBpjsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var freferensi_mobilejkn_bpjsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    freferensi_mobilejkn_bpjsedit = currentForm = new ew.Form("freferensi_mobilejkn_bpjsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "referensi_mobilejkn_bpjs")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.referensi_mobilejkn_bpjs)
        ew.vars.tables.referensi_mobilejkn_bpjs = currentTable;
    freferensi_mobilejkn_bpjsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["nobooking", [fields.nobooking.visible && fields.nobooking.required ? ew.Validators.required(fields.nobooking.caption) : null], fields.nobooking.isInvalid],
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["nomorkartu", [fields.nomorkartu.visible && fields.nomorkartu.required ? ew.Validators.required(fields.nomorkartu.caption) : null], fields.nomorkartu.isInvalid],
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["nohp", [fields.nohp.visible && fields.nohp.required ? ew.Validators.required(fields.nohp.caption) : null], fields.nohp.isInvalid],
        ["kodepoli", [fields.kodepoli.visible && fields.kodepoli.required ? ew.Validators.required(fields.kodepoli.caption) : null], fields.kodepoli.isInvalid],
        ["pasienbaru", [fields.pasienbaru.visible && fields.pasienbaru.required ? ew.Validators.required(fields.pasienbaru.caption) : null, ew.Validators.integer], fields.pasienbaru.isInvalid],
        ["norm", [fields.norm.visible && fields.norm.required ? ew.Validators.required(fields.norm.caption) : null], fields.norm.isInvalid],
        ["tanggalperiksa", [fields.tanggalperiksa.visible && fields.tanggalperiksa.required ? ew.Validators.required(fields.tanggalperiksa.caption) : null, ew.Validators.datetime(0)], fields.tanggalperiksa.isInvalid],
        ["kodedokter", [fields.kodedokter.visible && fields.kodedokter.required ? ew.Validators.required(fields.kodedokter.caption) : null], fields.kodedokter.isInvalid],
        ["jampraktek", [fields.jampraktek.visible && fields.jampraktek.required ? ew.Validators.required(fields.jampraktek.caption) : null], fields.jampraktek.isInvalid],
        ["jeniskunjungan", [fields.jeniskunjungan.visible && fields.jeniskunjungan.required ? ew.Validators.required(fields.jeniskunjungan.caption) : null], fields.jeniskunjungan.isInvalid],
        ["nomorreferensi", [fields.nomorreferensi.visible && fields.nomorreferensi.required ? ew.Validators.required(fields.nomorreferensi.caption) : null], fields.nomorreferensi.isInvalid],
        ["nomorantrean", [fields.nomorantrean.visible && fields.nomorantrean.required ? ew.Validators.required(fields.nomorantrean.caption) : null], fields.nomorantrean.isInvalid],
        ["angkaantrean", [fields.angkaantrean.visible && fields.angkaantrean.required ? ew.Validators.required(fields.angkaantrean.caption) : null], fields.angkaantrean.isInvalid],
        ["estimasidilayani", [fields.estimasidilayani.visible && fields.estimasidilayani.required ? ew.Validators.required(fields.estimasidilayani.caption) : null], fields.estimasidilayani.isInvalid],
        ["sisakuotajkn", [fields.sisakuotajkn.visible && fields.sisakuotajkn.required ? ew.Validators.required(fields.sisakuotajkn.caption) : null, ew.Validators.integer], fields.sisakuotajkn.isInvalid],
        ["kuotajkn", [fields.kuotajkn.visible && fields.kuotajkn.required ? ew.Validators.required(fields.kuotajkn.caption) : null, ew.Validators.integer], fields.kuotajkn.isInvalid],
        ["sisakuotanonjkn", [fields.sisakuotanonjkn.visible && fields.sisakuotanonjkn.required ? ew.Validators.required(fields.sisakuotanonjkn.caption) : null, ew.Validators.integer], fields.sisakuotanonjkn.isInvalid],
        ["kuotanonjkn", [fields.kuotanonjkn.visible && fields.kuotanonjkn.required ? ew.Validators.required(fields.kuotanonjkn.caption) : null, ew.Validators.integer], fields.kuotanonjkn.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["validasi", [fields.validasi.visible && fields.validasi.required ? ew.Validators.required(fields.validasi.caption) : null, ew.Validators.datetime(0)], fields.validasi.isInvalid],
        ["statuskirim", [fields.statuskirim.visible && fields.statuskirim.required ? ew.Validators.required(fields.statuskirim.caption) : null], fields.statuskirim.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = freferensi_mobilejkn_bpjsedit,
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
    freferensi_mobilejkn_bpjsedit.validate = function () {
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
    freferensi_mobilejkn_bpjsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freferensi_mobilejkn_bpjsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("freferensi_mobilejkn_bpjsedit");
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
<form name="freferensi_mobilejkn_bpjsedit" id="freferensi_mobilejkn_bpjsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="referensi_mobilejkn_bpjs" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
    <div id="r_nobooking" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_nobooking" for="x_nobooking" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nobooking->caption() ?><?= $Page->nobooking->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nobooking->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nobooking">
<input type="<?= $Page->nobooking->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_nobooking" name="x_nobooking" id="x_nobooking" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->nobooking->getPlaceHolder()) ?>" value="<?= $Page->nobooking->EditValue ?>"<?= $Page->nobooking->editAttributes() ?> aria-describedby="x_nobooking_help">
<?= $Page->nobooking->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nobooking->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <div id="r_no_rawat" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_no_rawat">
<input type="<?= $Page->no_rawat->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_no_rawat" name="x_no_rawat" id="x_no_rawat" size="30" maxlength="17" placeholder="<?= HtmlEncode($Page->no_rawat->getPlaceHolder()) ?>" value="<?= $Page->no_rawat->EditValue ?>"<?= $Page->no_rawat->editAttributes() ?> aria-describedby="x_no_rawat_help">
<?= $Page->no_rawat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rawat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nomorkartu->Visible) { // nomorkartu ?>
    <div id="r_nomorkartu" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_nomorkartu" for="x_nomorkartu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nomorkartu->caption() ?><?= $Page->nomorkartu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nomorkartu->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nomorkartu">
<input type="<?= $Page->nomorkartu->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_nomorkartu" name="x_nomorkartu" id="x_nomorkartu" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->nomorkartu->getPlaceHolder()) ?>" value="<?= $Page->nomorkartu->EditValue ?>"<?= $Page->nomorkartu->editAttributes() ?> aria-describedby="x_nomorkartu_help">
<?= $Page->nomorkartu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nomorkartu->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nik">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nohp->Visible) { // nohp ?>
    <div id="r_nohp" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_nohp" for="x_nohp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nohp->caption() ?><?= $Page->nohp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nohp->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nohp">
<input type="<?= $Page->nohp->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_nohp" name="x_nohp" id="x_nohp" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->nohp->getPlaceHolder()) ?>" value="<?= $Page->nohp->EditValue ?>"<?= $Page->nohp->editAttributes() ?> aria-describedby="x_nohp_help">
<?= $Page->nohp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nohp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kodepoli->Visible) { // kodepoli ?>
    <div id="r_kodepoli" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_kodepoli" for="x_kodepoli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kodepoli->caption() ?><?= $Page->kodepoli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kodepoli->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_kodepoli">
<input type="<?= $Page->kodepoli->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_kodepoli" name="x_kodepoli" id="x_kodepoli" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->kodepoli->getPlaceHolder()) ?>" value="<?= $Page->kodepoli->EditValue ?>"<?= $Page->kodepoli->editAttributes() ?> aria-describedby="x_kodepoli_help">
<?= $Page->kodepoli->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kodepoli->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pasienbaru->Visible) { // pasienbaru ?>
    <div id="r_pasienbaru" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_pasienbaru" for="x_pasienbaru" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pasienbaru->caption() ?><?= $Page->pasienbaru->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pasienbaru->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_pasienbaru">
<input type="<?= $Page->pasienbaru->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_pasienbaru" name="x_pasienbaru" id="x_pasienbaru" size="30" placeholder="<?= HtmlEncode($Page->pasienbaru->getPlaceHolder()) ?>" value="<?= $Page->pasienbaru->EditValue ?>"<?= $Page->pasienbaru->editAttributes() ?> aria-describedby="x_pasienbaru_help">
<?= $Page->pasienbaru->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pasienbaru->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->norm->Visible) { // norm ?>
    <div id="r_norm" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_norm" for="x_norm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->norm->caption() ?><?= $Page->norm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->norm->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_norm">
<input type="<?= $Page->norm->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_norm" name="x_norm" id="x_norm" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->norm->getPlaceHolder()) ?>" value="<?= $Page->norm->EditValue ?>"<?= $Page->norm->editAttributes() ?> aria-describedby="x_norm_help">
<?= $Page->norm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->norm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggalperiksa->Visible) { // tanggalperiksa ?>
    <div id="r_tanggalperiksa" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_tanggalperiksa" for="x_tanggalperiksa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggalperiksa->caption() ?><?= $Page->tanggalperiksa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggalperiksa->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_tanggalperiksa">
<input type="<?= $Page->tanggalperiksa->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_tanggalperiksa" name="x_tanggalperiksa" id="x_tanggalperiksa" placeholder="<?= HtmlEncode($Page->tanggalperiksa->getPlaceHolder()) ?>" value="<?= $Page->tanggalperiksa->EditValue ?>"<?= $Page->tanggalperiksa->editAttributes() ?> aria-describedby="x_tanggalperiksa_help">
<?= $Page->tanggalperiksa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggalperiksa->getErrorMessage() ?></div>
<?php if (!$Page->tanggalperiksa->ReadOnly && !$Page->tanggalperiksa->Disabled && !isset($Page->tanggalperiksa->EditAttrs["readonly"]) && !isset($Page->tanggalperiksa->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freferensi_mobilejkn_bpjsedit", "datetimepicker"], function() {
    ew.createDateTimePicker("freferensi_mobilejkn_bpjsedit", "x_tanggalperiksa", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kodedokter->Visible) { // kodedokter ?>
    <div id="r_kodedokter" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_kodedokter" for="x_kodedokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kodedokter->caption() ?><?= $Page->kodedokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kodedokter->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_kodedokter">
<input type="<?= $Page->kodedokter->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_kodedokter" name="x_kodedokter" id="x_kodedokter" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kodedokter->getPlaceHolder()) ?>" value="<?= $Page->kodedokter->EditValue ?>"<?= $Page->kodedokter->editAttributes() ?> aria-describedby="x_kodedokter_help">
<?= $Page->kodedokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kodedokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jampraktek->Visible) { // jampraktek ?>
    <div id="r_jampraktek" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_jampraktek" for="x_jampraktek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jampraktek->caption() ?><?= $Page->jampraktek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jampraktek->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_jampraktek">
<input type="<?= $Page->jampraktek->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_jampraktek" name="x_jampraktek" id="x_jampraktek" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->jampraktek->getPlaceHolder()) ?>" value="<?= $Page->jampraktek->EditValue ?>"<?= $Page->jampraktek->editAttributes() ?> aria-describedby="x_jampraktek_help">
<?= $Page->jampraktek->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jampraktek->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jeniskunjungan->Visible) { // jeniskunjungan ?>
    <div id="r_jeniskunjungan" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_jeniskunjungan" for="x_jeniskunjungan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jeniskunjungan->caption() ?><?= $Page->jeniskunjungan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jeniskunjungan->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_jeniskunjungan">
<input type="<?= $Page->jeniskunjungan->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_jeniskunjungan" name="x_jeniskunjungan" id="x_jeniskunjungan" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->jeniskunjungan->getPlaceHolder()) ?>" value="<?= $Page->jeniskunjungan->EditValue ?>"<?= $Page->jeniskunjungan->editAttributes() ?> aria-describedby="x_jeniskunjungan_help">
<?= $Page->jeniskunjungan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jeniskunjungan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
    <div id="r_nomorreferensi" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_nomorreferensi" for="x_nomorreferensi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nomorreferensi->caption() ?><?= $Page->nomorreferensi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nomorreferensi->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nomorreferensi">
<input type="<?= $Page->nomorreferensi->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_nomorreferensi" name="x_nomorreferensi" id="x_nomorreferensi" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->nomorreferensi->getPlaceHolder()) ?>" value="<?= $Page->nomorreferensi->EditValue ?>"<?= $Page->nomorreferensi->editAttributes() ?> aria-describedby="x_nomorreferensi_help">
<?= $Page->nomorreferensi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nomorreferensi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nomorantrean->Visible) { // nomorantrean ?>
    <div id="r_nomorantrean" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_nomorantrean" for="x_nomorantrean" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nomorantrean->caption() ?><?= $Page->nomorantrean->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nomorantrean->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_nomorantrean">
<input type="<?= $Page->nomorantrean->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_nomorantrean" name="x_nomorantrean" id="x_nomorantrean" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->nomorantrean->getPlaceHolder()) ?>" value="<?= $Page->nomorantrean->EditValue ?>"<?= $Page->nomorantrean->editAttributes() ?> aria-describedby="x_nomorantrean_help">
<?= $Page->nomorantrean->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nomorantrean->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->angkaantrean->Visible) { // angkaantrean ?>
    <div id="r_angkaantrean" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_angkaantrean" for="x_angkaantrean" class="<?= $Page->LeftColumnClass ?>"><?= $Page->angkaantrean->caption() ?><?= $Page->angkaantrean->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->angkaantrean->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_angkaantrean">
<input type="<?= $Page->angkaantrean->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_angkaantrean" name="x_angkaantrean" id="x_angkaantrean" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->angkaantrean->getPlaceHolder()) ?>" value="<?= $Page->angkaantrean->EditValue ?>"<?= $Page->angkaantrean->editAttributes() ?> aria-describedby="x_angkaantrean_help">
<?= $Page->angkaantrean->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->angkaantrean->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->estimasidilayani->Visible) { // estimasidilayani ?>
    <div id="r_estimasidilayani" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_estimasidilayani" for="x_estimasidilayani" class="<?= $Page->LeftColumnClass ?>"><?= $Page->estimasidilayani->caption() ?><?= $Page->estimasidilayani->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->estimasidilayani->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_estimasidilayani">
<input type="<?= $Page->estimasidilayani->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_estimasidilayani" name="x_estimasidilayani" id="x_estimasidilayani" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->estimasidilayani->getPlaceHolder()) ?>" value="<?= $Page->estimasidilayani->EditValue ?>"<?= $Page->estimasidilayani->editAttributes() ?> aria-describedby="x_estimasidilayani_help">
<?= $Page->estimasidilayani->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->estimasidilayani->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sisakuotajkn->Visible) { // sisakuotajkn ?>
    <div id="r_sisakuotajkn" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_sisakuotajkn" for="x_sisakuotajkn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sisakuotajkn->caption() ?><?= $Page->sisakuotajkn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sisakuotajkn->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_sisakuotajkn">
<input type="<?= $Page->sisakuotajkn->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_sisakuotajkn" name="x_sisakuotajkn" id="x_sisakuotajkn" size="30" placeholder="<?= HtmlEncode($Page->sisakuotajkn->getPlaceHolder()) ?>" value="<?= $Page->sisakuotajkn->EditValue ?>"<?= $Page->sisakuotajkn->editAttributes() ?> aria-describedby="x_sisakuotajkn_help">
<?= $Page->sisakuotajkn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sisakuotajkn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kuotajkn->Visible) { // kuotajkn ?>
    <div id="r_kuotajkn" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_kuotajkn" for="x_kuotajkn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kuotajkn->caption() ?><?= $Page->kuotajkn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kuotajkn->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_kuotajkn">
<input type="<?= $Page->kuotajkn->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_kuotajkn" name="x_kuotajkn" id="x_kuotajkn" size="30" placeholder="<?= HtmlEncode($Page->kuotajkn->getPlaceHolder()) ?>" value="<?= $Page->kuotajkn->EditValue ?>"<?= $Page->kuotajkn->editAttributes() ?> aria-describedby="x_kuotajkn_help">
<?= $Page->kuotajkn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kuotajkn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sisakuotanonjkn->Visible) { // sisakuotanonjkn ?>
    <div id="r_sisakuotanonjkn" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_sisakuotanonjkn" for="x_sisakuotanonjkn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sisakuotanonjkn->caption() ?><?= $Page->sisakuotanonjkn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->sisakuotanonjkn->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_sisakuotanonjkn">
<input type="<?= $Page->sisakuotanonjkn->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_sisakuotanonjkn" name="x_sisakuotanonjkn" id="x_sisakuotanonjkn" size="30" placeholder="<?= HtmlEncode($Page->sisakuotanonjkn->getPlaceHolder()) ?>" value="<?= $Page->sisakuotanonjkn->EditValue ?>"<?= $Page->sisakuotanonjkn->editAttributes() ?> aria-describedby="x_sisakuotanonjkn_help">
<?= $Page->sisakuotanonjkn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sisakuotanonjkn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kuotanonjkn->Visible) { // kuotanonjkn ?>
    <div id="r_kuotanonjkn" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_kuotanonjkn" for="x_kuotanonjkn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kuotanonjkn->caption() ?><?= $Page->kuotanonjkn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kuotanonjkn->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_kuotanonjkn">
<input type="<?= $Page->kuotanonjkn->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_kuotanonjkn" name="x_kuotanonjkn" id="x_kuotanonjkn" size="30" placeholder="<?= HtmlEncode($Page->kuotanonjkn->getPlaceHolder()) ?>" value="<?= $Page->kuotanonjkn->EditValue ?>"<?= $Page->kuotanonjkn->editAttributes() ?> aria-describedby="x_kuotanonjkn_help">
<?= $Page->kuotanonjkn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kuotanonjkn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_status">
<input type="<?= $Page->status->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" value="<?= $Page->status->EditValue ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->validasi->Visible) { // validasi ?>
    <div id="r_validasi" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_validasi" for="x_validasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->validasi->caption() ?><?= $Page->validasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->validasi->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_validasi">
<input type="<?= $Page->validasi->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_validasi" name="x_validasi" id="x_validasi" placeholder="<?= HtmlEncode($Page->validasi->getPlaceHolder()) ?>" value="<?= $Page->validasi->EditValue ?>"<?= $Page->validasi->editAttributes() ?> aria-describedby="x_validasi_help">
<?= $Page->validasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->validasi->getErrorMessage() ?></div>
<?php if (!$Page->validasi->ReadOnly && !$Page->validasi->Disabled && !isset($Page->validasi->EditAttrs["readonly"]) && !isset($Page->validasi->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freferensi_mobilejkn_bpjsedit", "datetimepicker"], function() {
    ew.createDateTimePicker("freferensi_mobilejkn_bpjsedit", "x_validasi", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
    <div id="r_statuskirim" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_statuskirim" for="x_statuskirim" class="<?= $Page->LeftColumnClass ?>"><?= $Page->statuskirim->caption() ?><?= $Page->statuskirim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->statuskirim->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_statuskirim">
<input type="<?= $Page->statuskirim->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs" data-field="x_statuskirim" name="x_statuskirim" id="x_statuskirim" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->statuskirim->getPlaceHolder()) ?>" value="<?= $Page->statuskirim->EditValue ?>"<?= $Page->statuskirim->editAttributes() ?> aria-describedby="x_statuskirim_help">
<?= $Page->statuskirim->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->statuskirim->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
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
    ew.addEventHandlers("referensi_mobilejkn_bpjs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
