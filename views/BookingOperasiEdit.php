<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$BookingOperasiEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbooking_operasiedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fbooking_operasiedit = currentForm = new ew.Form("fbooking_operasiedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "booking_operasi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.booking_operasi)
        ew.vars.tables.booking_operasi = currentTable;
    fbooking_operasiedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["no_rawat", [fields.no_rawat.visible && fields.no_rawat.required ? ew.Validators.required(fields.no_rawat.caption) : null], fields.no_rawat.isInvalid],
        ["kode_paket", [fields.kode_paket.visible && fields.kode_paket.required ? ew.Validators.required(fields.kode_paket.caption) : null], fields.kode_paket.isInvalid],
        ["tanggal", [fields.tanggal.visible && fields.tanggal.required ? ew.Validators.required(fields.tanggal.caption) : null, ew.Validators.datetime(0)], fields.tanggal.isInvalid],
        ["jam_mulai", [fields.jam_mulai.visible && fields.jam_mulai.required ? ew.Validators.required(fields.jam_mulai.caption) : null, ew.Validators.time], fields.jam_mulai.isInvalid],
        ["jam_selesai", [fields.jam_selesai.visible && fields.jam_selesai.required ? ew.Validators.required(fields.jam_selesai.caption) : null, ew.Validators.time], fields.jam_selesai.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["kd_dokter", [fields.kd_dokter.visible && fields.kd_dokter.required ? ew.Validators.required(fields.kd_dokter.caption) : null], fields.kd_dokter.isInvalid],
        ["kd_ruang_ok", [fields.kd_ruang_ok.visible && fields.kd_ruang_ok.required ? ew.Validators.required(fields.kd_ruang_ok.caption) : null], fields.kd_ruang_ok.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbooking_operasiedit,
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
    fbooking_operasiedit.validate = function () {
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
    fbooking_operasiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbooking_operasiedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbooking_operasiedit");
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
<form name="fbooking_operasiedit" id="fbooking_operasiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="booking_operasi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_booking_operasi_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_booking_operasi_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="booking_operasi" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_rawat->Visible) { // no_rawat ?>
    <div id="r_no_rawat" class="form-group row">
        <label id="elh_booking_operasi_no_rawat" for="x_no_rawat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rawat->caption() ?><?= $Page->no_rawat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rawat->cellAttributes() ?>>
<span id="el_booking_operasi_no_rawat">
<input type="<?= $Page->no_rawat->getInputTextType() ?>" data-table="booking_operasi" data-field="x_no_rawat" name="x_no_rawat" id="x_no_rawat" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->no_rawat->getPlaceHolder()) ?>" value="<?= $Page->no_rawat->EditValue ?>"<?= $Page->no_rawat->editAttributes() ?> aria-describedby="x_no_rawat_help">
<?= $Page->no_rawat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rawat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_paket->Visible) { // kode_paket ?>
    <div id="r_kode_paket" class="form-group row">
        <label id="elh_booking_operasi_kode_paket" for="x_kode_paket" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_paket->caption() ?><?= $Page->kode_paket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_paket->cellAttributes() ?>>
<span id="el_booking_operasi_kode_paket">
<input type="<?= $Page->kode_paket->getInputTextType() ?>" data-table="booking_operasi" data-field="x_kode_paket" name="x_kode_paket" id="x_kode_paket" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->kode_paket->getPlaceHolder()) ?>" value="<?= $Page->kode_paket->EditValue ?>"<?= $Page->kode_paket->editAttributes() ?> aria-describedby="x_kode_paket_help">
<?= $Page->kode_paket->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_paket->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal->Visible) { // tanggal ?>
    <div id="r_tanggal" class="form-group row">
        <label id="elh_booking_operasi_tanggal" for="x_tanggal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal->caption() ?><?= $Page->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggal->cellAttributes() ?>>
<span id="el_booking_operasi_tanggal">
<input type="<?= $Page->tanggal->getInputTextType() ?>" data-table="booking_operasi" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" placeholder="<?= HtmlEncode($Page->tanggal->getPlaceHolder()) ?>" value="<?= $Page->tanggal->EditValue ?>"<?= $Page->tanggal->editAttributes() ?> aria-describedby="x_tanggal_help">
<?= $Page->tanggal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal->getErrorMessage() ?></div>
<?php if (!$Page->tanggal->ReadOnly && !$Page->tanggal->Disabled && !isset($Page->tanggal->EditAttrs["readonly"]) && !isset($Page->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbooking_operasiedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fbooking_operasiedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_mulai->Visible) { // jam_mulai ?>
    <div id="r_jam_mulai" class="form-group row">
        <label id="elh_booking_operasi_jam_mulai" for="x_jam_mulai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_mulai->caption() ?><?= $Page->jam_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_mulai->cellAttributes() ?>>
<span id="el_booking_operasi_jam_mulai">
<input type="<?= $Page->jam_mulai->getInputTextType() ?>" data-table="booking_operasi" data-field="x_jam_mulai" name="x_jam_mulai" id="x_jam_mulai" placeholder="<?= HtmlEncode($Page->jam_mulai->getPlaceHolder()) ?>" value="<?= $Page->jam_mulai->EditValue ?>"<?= $Page->jam_mulai->editAttributes() ?> aria-describedby="x_jam_mulai_help">
<?= $Page->jam_mulai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_mulai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_selesai->Visible) { // jam_selesai ?>
    <div id="r_jam_selesai" class="form-group row">
        <label id="elh_booking_operasi_jam_selesai" for="x_jam_selesai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_selesai->caption() ?><?= $Page->jam_selesai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jam_selesai->cellAttributes() ?>>
<span id="el_booking_operasi_jam_selesai">
<input type="<?= $Page->jam_selesai->getInputTextType() ?>" data-table="booking_operasi" data-field="x_jam_selesai" name="x_jam_selesai" id="x_jam_selesai" placeholder="<?= HtmlEncode($Page->jam_selesai->getPlaceHolder()) ?>" value="<?= $Page->jam_selesai->EditValue ?>"<?= $Page->jam_selesai->editAttributes() ?> aria-describedby="x_jam_selesai_help">
<?= $Page->jam_selesai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_selesai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_booking_operasi_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_booking_operasi_status">
<input type="<?= $Page->status->getInputTextType() ?>" data-table="booking_operasi" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" value="<?= $Page->status->EditValue ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_dokter->Visible) { // kd_dokter ?>
    <div id="r_kd_dokter" class="form-group row">
        <label id="elh_booking_operasi_kd_dokter" for="x_kd_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_dokter->caption() ?><?= $Page->kd_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_dokter->cellAttributes() ?>>
<span id="el_booking_operasi_kd_dokter">
<input type="<?= $Page->kd_dokter->getInputTextType() ?>" data-table="booking_operasi" data-field="x_kd_dokter" name="x_kd_dokter" id="x_kd_dokter" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->kd_dokter->getPlaceHolder()) ?>" value="<?= $Page->kd_dokter->EditValue ?>"<?= $Page->kd_dokter->editAttributes() ?> aria-describedby="x_kd_dokter_help">
<?= $Page->kd_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_dokter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_ruang_ok->Visible) { // kd_ruang_ok ?>
    <div id="r_kd_ruang_ok" class="form-group row">
        <label id="elh_booking_operasi_kd_ruang_ok" for="x_kd_ruang_ok" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_ruang_ok->caption() ?><?= $Page->kd_ruang_ok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_ruang_ok->cellAttributes() ?>>
<span id="el_booking_operasi_kd_ruang_ok">
<input type="<?= $Page->kd_ruang_ok->getInputTextType() ?>" data-table="booking_operasi" data-field="x_kd_ruang_ok" name="x_kd_ruang_ok" id="x_kd_ruang_ok" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->kd_ruang_ok->getPlaceHolder()) ?>" value="<?= $Page->kd_ruang_ok->EditValue ?>"<?= $Page->kd_ruang_ok->editAttributes() ?> aria-describedby="x_kd_ruang_ok_help">
<?= $Page->kd_ruang_ok->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_ruang_ok->getErrorMessage() ?></div>
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
    ew.addEventHandlers("booking_operasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
