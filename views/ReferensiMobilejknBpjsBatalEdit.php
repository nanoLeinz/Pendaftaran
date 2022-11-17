<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ReferensiMobilejknBpjsBatalEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var freferensi_mobilejkn_bpjs_bataledit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    freferensi_mobilejkn_bpjs_bataledit = currentForm = new ew.Form("freferensi_mobilejkn_bpjs_bataledit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "referensi_mobilejkn_bpjs_batal")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.referensi_mobilejkn_bpjs_batal)
        ew.vars.tables.referensi_mobilejkn_bpjs_batal = currentTable;
    freferensi_mobilejkn_bpjs_bataledit.addFields([
        ["no_rkm_medis", [fields.no_rkm_medis.visible && fields.no_rkm_medis.required ? ew.Validators.required(fields.no_rkm_medis.caption) : null], fields.no_rkm_medis.isInvalid],
        ["nomorreferensi", [fields.nomorreferensi.visible && fields.nomorreferensi.required ? ew.Validators.required(fields.nomorreferensi.caption) : null], fields.nomorreferensi.isInvalid],
        ["tanggalbatal", [fields.tanggalbatal.visible && fields.tanggalbatal.required ? ew.Validators.required(fields.tanggalbatal.caption) : null, ew.Validators.datetime(0)], fields.tanggalbatal.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["statuskirim", [fields.statuskirim.visible && fields.statuskirim.required ? ew.Validators.required(fields.statuskirim.caption) : null], fields.statuskirim.isInvalid],
        ["nobooking", [fields.nobooking.visible && fields.nobooking.required ? ew.Validators.required(fields.nobooking.caption) : null], fields.nobooking.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = freferensi_mobilejkn_bpjs_bataledit,
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
    freferensi_mobilejkn_bpjs_bataledit.validate = function () {
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
    freferensi_mobilejkn_bpjs_bataledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freferensi_mobilejkn_bpjs_bataledit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("freferensi_mobilejkn_bpjs_bataledit");
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
<form name="freferensi_mobilejkn_bpjs_bataledit" id="freferensi_mobilejkn_bpjs_bataledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="referensi_mobilejkn_bpjs_batal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->no_rkm_medis->Visible) { // no_rkm_medis ?>
    <div id="r_no_rkm_medis" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_batal_no_rkm_medis" for="x_no_rkm_medis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_rkm_medis->caption() ?><?= $Page->no_rkm_medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->no_rkm_medis->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_no_rkm_medis">
<input type="<?= $Page->no_rkm_medis->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs_batal" data-field="x_no_rkm_medis" name="x_no_rkm_medis" id="x_no_rkm_medis" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->no_rkm_medis->getPlaceHolder()) ?>" value="<?= $Page->no_rkm_medis->EditValue ?>"<?= $Page->no_rkm_medis->editAttributes() ?> aria-describedby="x_no_rkm_medis_help">
<?= $Page->no_rkm_medis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_rkm_medis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nomorreferensi->Visible) { // nomorreferensi ?>
    <div id="r_nomorreferensi" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_batal_nomorreferensi" for="x_nomorreferensi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nomorreferensi->caption() ?><?= $Page->nomorreferensi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nomorreferensi->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_nomorreferensi">
<input type="<?= $Page->nomorreferensi->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs_batal" data-field="x_nomorreferensi" name="x_nomorreferensi" id="x_nomorreferensi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nomorreferensi->getPlaceHolder()) ?>" value="<?= $Page->nomorreferensi->EditValue ?>"<?= $Page->nomorreferensi->editAttributes() ?> aria-describedby="x_nomorreferensi_help">
<?= $Page->nomorreferensi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nomorreferensi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggalbatal->Visible) { // tanggalbatal ?>
    <div id="r_tanggalbatal" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_batal_tanggalbatal" for="x_tanggalbatal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggalbatal->caption() ?><?= $Page->tanggalbatal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tanggalbatal->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_tanggalbatal">
<input type="<?= $Page->tanggalbatal->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs_batal" data-field="x_tanggalbatal" name="x_tanggalbatal" id="x_tanggalbatal" placeholder="<?= HtmlEncode($Page->tanggalbatal->getPlaceHolder()) ?>" value="<?= $Page->tanggalbatal->EditValue ?>"<?= $Page->tanggalbatal->editAttributes() ?> aria-describedby="x_tanggalbatal_help">
<?= $Page->tanggalbatal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggalbatal->getErrorMessage() ?></div>
<?php if (!$Page->tanggalbatal->ReadOnly && !$Page->tanggalbatal->Disabled && !isset($Page->tanggalbatal->EditAttrs["readonly"]) && !isset($Page->tanggalbatal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freferensi_mobilejkn_bpjs_bataledit", "datetimepicker"], function() {
    ew.createDateTimePicker("freferensi_mobilejkn_bpjs_bataledit", "x_tanggalbatal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_batal_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keterangan->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs_batal" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="500" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>" value="<?= $Page->keterangan->EditValue ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->statuskirim->Visible) { // statuskirim ?>
    <div id="r_statuskirim" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_batal_statuskirim" for="x_statuskirim" class="<?= $Page->LeftColumnClass ?>"><?= $Page->statuskirim->caption() ?><?= $Page->statuskirim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->statuskirim->cellAttributes() ?>>
<span id="el_referensi_mobilejkn_bpjs_batal_statuskirim">
<input type="<?= $Page->statuskirim->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs_batal" data-field="x_statuskirim" name="x_statuskirim" id="x_statuskirim" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->statuskirim->getPlaceHolder()) ?>" value="<?= $Page->statuskirim->EditValue ?>"<?= $Page->statuskirim->editAttributes() ?> aria-describedby="x_statuskirim_help">
<?= $Page->statuskirim->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->statuskirim->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nobooking->Visible) { // nobooking ?>
    <div id="r_nobooking" class="form-group row">
        <label id="elh_referensi_mobilejkn_bpjs_batal_nobooking" for="x_nobooking" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nobooking->caption() ?><?= $Page->nobooking->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nobooking->cellAttributes() ?>>
<input type="<?= $Page->nobooking->getInputTextType() ?>" data-table="referensi_mobilejkn_bpjs_batal" data-field="x_nobooking" name="x_nobooking" id="x_nobooking" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nobooking->getPlaceHolder()) ?>" value="<?= $Page->nobooking->EditValue ?>"<?= $Page->nobooking->editAttributes() ?> aria-describedby="x_nobooking_help">
<?= $Page->nobooking->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nobooking->getErrorMessage() ?></div>
<input type="hidden" data-table="referensi_mobilejkn_bpjs_batal" data-field="x_nobooking" data-hidden="1" name="o_nobooking" id="o_nobooking" value="<?= HtmlEncode($Page->nobooking->OldValue ?? $Page->nobooking->CurrentValue) ?>">
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
    ew.addEventHandlers("referensi_mobilejkn_bpjs_batal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
