<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LPembiayaanEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_pembiayaanedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fl_pembiayaanedit = currentForm = new ew.Form("fl_pembiayaanedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "l_pembiayaan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.l_pembiayaan)
        ew.vars.tables.l_pembiayaan = currentTable;
    fl_pembiayaanedit.addFields([
        ["id_pembiayaan", [fields.id_pembiayaan.visible && fields.id_pembiayaan.required ? ew.Validators.required(fields.id_pembiayaan.caption) : null], fields.id_pembiayaan.isInvalid],
        ["kode_biaya", [fields.kode_biaya.visible && fields.kode_biaya.required ? ew.Validators.required(fields.kode_biaya.caption) : null, ew.Validators.integer], fields.kode_biaya.isInvalid],
        ["nama_biaya", [fields.nama_biaya.visible && fields.nama_biaya.required ? ew.Validators.required(fields.nama_biaya.caption) : null], fields.nama_biaya.isInvalid],
        ["kode_kelas", [fields.kode_kelas.visible && fields.kode_kelas.required ? ew.Validators.required(fields.kode_kelas.caption) : null, ew.Validators.integer], fields.kode_kelas.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fl_pembiayaanedit,
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
    fl_pembiayaanedit.validate = function () {
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
    fl_pembiayaanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fl_pembiayaanedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fl_pembiayaanedit");
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
<form name="fl_pembiayaanedit" id="fl_pembiayaanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_pembiayaan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_pembiayaan->Visible) { // id_pembiayaan ?>
    <div id="r_id_pembiayaan" class="form-group row">
        <label id="elh_l_pembiayaan_id_pembiayaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_pembiayaan->caption() ?><?= $Page->id_pembiayaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pembiayaan->cellAttributes() ?>>
<span id="el_l_pembiayaan_id_pembiayaan">
<span<?= $Page->id_pembiayaan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_pembiayaan->getDisplayValue($Page->id_pembiayaan->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="l_pembiayaan" data-field="x_id_pembiayaan" data-hidden="1" name="x_id_pembiayaan" id="x_id_pembiayaan" value="<?= HtmlEncode($Page->id_pembiayaan->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_biaya->Visible) { // kode_biaya ?>
    <div id="r_kode_biaya" class="form-group row">
        <label id="elh_l_pembiayaan_kode_biaya" for="x_kode_biaya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_biaya->caption() ?><?= $Page->kode_biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_biaya->cellAttributes() ?>>
<span id="el_l_pembiayaan_kode_biaya">
<input type="<?= $Page->kode_biaya->getInputTextType() ?>" data-table="l_pembiayaan" data-field="x_kode_biaya" name="x_kode_biaya" id="x_kode_biaya" size="30" placeholder="<?= HtmlEncode($Page->kode_biaya->getPlaceHolder()) ?>" value="<?= $Page->kode_biaya->EditValue ?>"<?= $Page->kode_biaya->editAttributes() ?> aria-describedby="x_kode_biaya_help">
<?= $Page->kode_biaya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_biaya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_biaya->Visible) { // nama_biaya ?>
    <div id="r_nama_biaya" class="form-group row">
        <label id="elh_l_pembiayaan_nama_biaya" for="x_nama_biaya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_biaya->caption() ?><?= $Page->nama_biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_biaya->cellAttributes() ?>>
<span id="el_l_pembiayaan_nama_biaya">
<input type="<?= $Page->nama_biaya->getInputTextType() ?>" data-table="l_pembiayaan" data-field="x_nama_biaya" name="x_nama_biaya" id="x_nama_biaya" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_biaya->getPlaceHolder()) ?>" value="<?= $Page->nama_biaya->EditValue ?>"<?= $Page->nama_biaya->editAttributes() ?> aria-describedby="x_nama_biaya_help">
<?= $Page->nama_biaya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_biaya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_kelas->Visible) { // kode_kelas ?>
    <div id="r_kode_kelas" class="form-group row">
        <label id="elh_l_pembiayaan_kode_kelas" for="x_kode_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kelas->caption() ?><?= $Page->kode_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kelas->cellAttributes() ?>>
<span id="el_l_pembiayaan_kode_kelas">
<input type="<?= $Page->kode_kelas->getInputTextType() ?>" data-table="l_pembiayaan" data-field="x_kode_kelas" name="x_kode_kelas" id="x_kode_kelas" size="30" placeholder="<?= HtmlEncode($Page->kode_kelas->getPlaceHolder()) ?>" value="<?= $Page->kode_kelas->EditValue ?>"<?= $Page->kode_kelas->editAttributes() ?> aria-describedby="x_kode_kelas_help">
<?= $Page->kode_kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_kelas->getErrorMessage() ?></div>
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
    ew.addEventHandlers("l_pembiayaan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
