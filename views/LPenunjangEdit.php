<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LPenunjangEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_penunjangedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fl_penunjangedit = currentForm = new ew.Form("fl_penunjangedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "l_penunjang")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.l_penunjang)
        ew.vars.tables.l_penunjang = currentTable;
    fl_penunjangedit.addFields([
        ["id_penunjang", [fields.id_penunjang.visible && fields.id_penunjang.required ? ew.Validators.required(fields.id_penunjang.caption) : null], fields.id_penunjang.isInvalid],
        ["id_kunjungan", [fields.id_kunjungan.visible && fields.id_kunjungan.required ? ew.Validators.required(fields.id_kunjungan.caption) : null, ew.Validators.integer], fields.id_kunjungan.isInvalid],
        ["kode_penunjang", [fields.kode_penunjang.visible && fields.kode_penunjang.required ? ew.Validators.required(fields.kode_penunjang.caption) : null, ew.Validators.integer], fields.kode_penunjang.isInvalid],
        ["nama_penunjang", [fields.nama_penunjang.visible && fields.nama_penunjang.required ? ew.Validators.required(fields.nama_penunjang.caption) : null], fields.nama_penunjang.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fl_penunjangedit,
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
    fl_penunjangedit.validate = function () {
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
    fl_penunjangedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fl_penunjangedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fl_penunjangedit");
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
<form name="fl_penunjangedit" id="fl_penunjangedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_penunjang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_penunjang->Visible) { // id_penunjang ?>
    <div id="r_id_penunjang" class="form-group row">
        <label id="elh_l_penunjang_id_penunjang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_penunjang->caption() ?><?= $Page->id_penunjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_penunjang->cellAttributes() ?>>
<span id="el_l_penunjang_id_penunjang">
<span<?= $Page->id_penunjang->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_penunjang->getDisplayValue($Page->id_penunjang->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="l_penunjang" data-field="x_id_penunjang" data-hidden="1" name="x_id_penunjang" id="x_id_penunjang" value="<?= HtmlEncode($Page->id_penunjang->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
    <div id="r_id_kunjungan" class="form-group row">
        <label id="elh_l_penunjang_id_kunjungan" for="x_id_kunjungan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_kunjungan->caption() ?><?= $Page->id_kunjungan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el_l_penunjang_id_kunjungan">
<input type="<?= $Page->id_kunjungan->getInputTextType() ?>" data-table="l_penunjang" data-field="x_id_kunjungan" name="x_id_kunjungan" id="x_id_kunjungan" size="30" placeholder="<?= HtmlEncode($Page->id_kunjungan->getPlaceHolder()) ?>" value="<?= $Page->id_kunjungan->EditValue ?>"<?= $Page->id_kunjungan->editAttributes() ?> aria-describedby="x_id_kunjungan_help">
<?= $Page->id_kunjungan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_kunjungan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_penunjang->Visible) { // kode_penunjang ?>
    <div id="r_kode_penunjang" class="form-group row">
        <label id="elh_l_penunjang_kode_penunjang" for="x_kode_penunjang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_penunjang->caption() ?><?= $Page->kode_penunjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_penunjang->cellAttributes() ?>>
<span id="el_l_penunjang_kode_penunjang">
<input type="<?= $Page->kode_penunjang->getInputTextType() ?>" data-table="l_penunjang" data-field="x_kode_penunjang" name="x_kode_penunjang" id="x_kode_penunjang" size="30" placeholder="<?= HtmlEncode($Page->kode_penunjang->getPlaceHolder()) ?>" value="<?= $Page->kode_penunjang->EditValue ?>"<?= $Page->kode_penunjang->editAttributes() ?> aria-describedby="x_kode_penunjang_help">
<?= $Page->kode_penunjang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_penunjang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_penunjang->Visible) { // nama_penunjang ?>
    <div id="r_nama_penunjang" class="form-group row">
        <label id="elh_l_penunjang_nama_penunjang" for="x_nama_penunjang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_penunjang->caption() ?><?= $Page->nama_penunjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_penunjang->cellAttributes() ?>>
<span id="el_l_penunjang_nama_penunjang">
<input type="<?= $Page->nama_penunjang->getInputTextType() ?>" data-table="l_penunjang" data-field="x_nama_penunjang" name="x_nama_penunjang" id="x_nama_penunjang" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_penunjang->getPlaceHolder()) ?>" value="<?= $Page->nama_penunjang->EditValue ?>"<?= $Page->nama_penunjang->editAttributes() ?> aria-describedby="x_nama_penunjang_help">
<?= $Page->nama_penunjang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_penunjang->getErrorMessage() ?></div>
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
    ew.addEventHandlers("l_penunjang");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
