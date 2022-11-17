<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LFlagprocedureAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_flagprocedureadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fl_flagprocedureadd = currentForm = new ew.Form("fl_flagprocedureadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "l_flagprocedure")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.l_flagprocedure)
        ew.vars.tables.l_flagprocedure = currentTable;
    fl_flagprocedureadd.addFields([
        ["id_kunjungan", [fields.id_kunjungan.visible && fields.id_kunjungan.required ? ew.Validators.required(fields.id_kunjungan.caption) : null, ew.Validators.integer], fields.id_kunjungan.isInvalid],
        ["kode_procedure", [fields.kode_procedure.visible && fields.kode_procedure.required ? ew.Validators.required(fields.kode_procedure.caption) : null, ew.Validators.integer], fields.kode_procedure.isInvalid],
        ["nama_procedure", [fields.nama_procedure.visible && fields.nama_procedure.required ? ew.Validators.required(fields.nama_procedure.caption) : null], fields.nama_procedure.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fl_flagprocedureadd,
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
    fl_flagprocedureadd.validate = function () {
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
    fl_flagprocedureadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fl_flagprocedureadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fl_flagprocedureadd");
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
<form name="fl_flagprocedureadd" id="fl_flagprocedureadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_flagprocedure">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
    <div id="r_id_kunjungan" class="form-group row">
        <label id="elh_l_flagprocedure_id_kunjungan" for="x_id_kunjungan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_kunjungan->caption() ?><?= $Page->id_kunjungan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el_l_flagprocedure_id_kunjungan">
<input type="<?= $Page->id_kunjungan->getInputTextType() ?>" data-table="l_flagprocedure" data-field="x_id_kunjungan" name="x_id_kunjungan" id="x_id_kunjungan" size="30" placeholder="<?= HtmlEncode($Page->id_kunjungan->getPlaceHolder()) ?>" value="<?= $Page->id_kunjungan->EditValue ?>"<?= $Page->id_kunjungan->editAttributes() ?> aria-describedby="x_id_kunjungan_help">
<?= $Page->id_kunjungan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_kunjungan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_procedure->Visible) { // kode_procedure ?>
    <div id="r_kode_procedure" class="form-group row">
        <label id="elh_l_flagprocedure_kode_procedure" for="x_kode_procedure" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_procedure->caption() ?><?= $Page->kode_procedure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_procedure->cellAttributes() ?>>
<span id="el_l_flagprocedure_kode_procedure">
<input type="<?= $Page->kode_procedure->getInputTextType() ?>" data-table="l_flagprocedure" data-field="x_kode_procedure" name="x_kode_procedure" id="x_kode_procedure" size="30" placeholder="<?= HtmlEncode($Page->kode_procedure->getPlaceHolder()) ?>" value="<?= $Page->kode_procedure->EditValue ?>"<?= $Page->kode_procedure->editAttributes() ?> aria-describedby="x_kode_procedure_help">
<?= $Page->kode_procedure->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_procedure->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_procedure->Visible) { // nama_procedure ?>
    <div id="r_nama_procedure" class="form-group row">
        <label id="elh_l_flagprocedure_nama_procedure" for="x_nama_procedure" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_procedure->caption() ?><?= $Page->nama_procedure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_procedure->cellAttributes() ?>>
<span id="el_l_flagprocedure_nama_procedure">
<input type="<?= $Page->nama_procedure->getInputTextType() ?>" data-table="l_flagprocedure" data-field="x_nama_procedure" name="x_nama_procedure" id="x_nama_procedure" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_procedure->getPlaceHolder()) ?>" value="<?= $Page->nama_procedure->EditValue ?>"<?= $Page->nama_procedure->editAttributes() ?> aria-describedby="x_nama_procedure_help">
<?= $Page->nama_procedure->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_procedure->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("l_flagprocedure");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
