<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LAspelAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_aspeladd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fl_aspeladd = currentForm = new ew.Form("fl_aspeladd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "l_aspel")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.l_aspel)
        ew.vars.tables.l_aspel = currentTable;
    fl_aspeladd.addFields([
        ["id_kunjungan", [fields.id_kunjungan.visible && fields.id_kunjungan.required ? ew.Validators.required(fields.id_kunjungan.caption) : null, ew.Validators.integer], fields.id_kunjungan.isInvalid],
        ["kode_aspel", [fields.kode_aspel.visible && fields.kode_aspel.required ? ew.Validators.required(fields.kode_aspel.caption) : null, ew.Validators.integer], fields.kode_aspel.isInvalid],
        ["nama_aspel", [fields.nama_aspel.visible && fields.nama_aspel.required ? ew.Validators.required(fields.nama_aspel.caption) : null], fields.nama_aspel.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fl_aspeladd,
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
    fl_aspeladd.validate = function () {
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
    fl_aspeladd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fl_aspeladd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fl_aspeladd");
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
<form name="fl_aspeladd" id="fl_aspeladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_aspel">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id_kunjungan->Visible) { // id_kunjungan ?>
    <div id="r_id_kunjungan" class="form-group row">
        <label id="elh_l_aspel_id_kunjungan" for="x_id_kunjungan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_kunjungan->caption() ?><?= $Page->id_kunjungan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_kunjungan->cellAttributes() ?>>
<span id="el_l_aspel_id_kunjungan">
<input type="<?= $Page->id_kunjungan->getInputTextType() ?>" data-table="l_aspel" data-field="x_id_kunjungan" name="x_id_kunjungan" id="x_id_kunjungan" size="30" placeholder="<?= HtmlEncode($Page->id_kunjungan->getPlaceHolder()) ?>" value="<?= $Page->id_kunjungan->EditValue ?>"<?= $Page->id_kunjungan->editAttributes() ?> aria-describedby="x_id_kunjungan_help">
<?= $Page->id_kunjungan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_kunjungan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_aspel->Visible) { // kode_aspel ?>
    <div id="r_kode_aspel" class="form-group row">
        <label id="elh_l_aspel_kode_aspel" for="x_kode_aspel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_aspel->caption() ?><?= $Page->kode_aspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_aspel->cellAttributes() ?>>
<span id="el_l_aspel_kode_aspel">
<input type="<?= $Page->kode_aspel->getInputTextType() ?>" data-table="l_aspel" data-field="x_kode_aspel" name="x_kode_aspel" id="x_kode_aspel" size="30" placeholder="<?= HtmlEncode($Page->kode_aspel->getPlaceHolder()) ?>" value="<?= $Page->kode_aspel->EditValue ?>"<?= $Page->kode_aspel->editAttributes() ?> aria-describedby="x_kode_aspel_help">
<?= $Page->kode_aspel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_aspel->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_aspel->Visible) { // nama_aspel ?>
    <div id="r_nama_aspel" class="form-group row">
        <label id="elh_l_aspel_nama_aspel" for="x_nama_aspel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_aspel->caption() ?><?= $Page->nama_aspel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_aspel->cellAttributes() ?>>
<span id="el_l_aspel_nama_aspel">
<input type="<?= $Page->nama_aspel->getInputTextType() ?>" data-table="l_aspel" data-field="x_nama_aspel" name="x_nama_aspel" id="x_nama_aspel" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->nama_aspel->getPlaceHolder()) ?>" value="<?= $Page->nama_aspel->EditValue ?>"<?= $Page->nama_aspel->editAttributes() ?> aria-describedby="x_nama_aspel_help">
<?= $Page->nama_aspel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_aspel->getErrorMessage() ?></div>
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
    ew.addEventHandlers("l_aspel");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
