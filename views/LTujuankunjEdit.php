<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LTujuankunjEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_tujuankunjedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fl_tujuankunjedit = currentForm = new ew.Form("fl_tujuankunjedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "l_tujuankunj")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.l_tujuankunj)
        ew.vars.tables.l_tujuankunj = currentTable;
    fl_tujuankunjedit.addFields([
        ["id_tujuan", [fields.id_tujuan.visible && fields.id_tujuan.required ? ew.Validators.required(fields.id_tujuan.caption) : null], fields.id_tujuan.isInvalid],
        ["nama_tujuan", [fields.nama_tujuan.visible && fields.nama_tujuan.required ? ew.Validators.required(fields.nama_tujuan.caption) : null], fields.nama_tujuan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fl_tujuankunjedit,
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
    fl_tujuankunjedit.validate = function () {
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
    fl_tujuankunjedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fl_tujuankunjedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fl_tujuankunjedit");
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
<form name="fl_tujuankunjedit" id="fl_tujuankunjedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_tujuankunj">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_tujuan->Visible) { // id_tujuan ?>
    <div id="r_id_tujuan" class="form-group row">
        <label id="elh_l_tujuankunj_id_tujuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_tujuan->caption() ?><?= $Page->id_tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_tujuan->cellAttributes() ?>>
<span id="el_l_tujuankunj_id_tujuan">
<span<?= $Page->id_tujuan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_tujuan->getDisplayValue($Page->id_tujuan->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="l_tujuankunj" data-field="x_id_tujuan" data-hidden="1" name="x_id_tujuan" id="x_id_tujuan" value="<?= HtmlEncode($Page->id_tujuan->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_tujuan->Visible) { // nama_tujuan ?>
    <div id="r_nama_tujuan" class="form-group row">
        <label id="elh_l_tujuankunj_nama_tujuan" for="x_nama_tujuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_tujuan->caption() ?><?= $Page->nama_tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_tujuan->cellAttributes() ?>>
<span id="el_l_tujuankunj_nama_tujuan">
<input type="<?= $Page->nama_tujuan->getInputTextType() ?>" data-table="l_tujuankunj" data-field="x_nama_tujuan" name="x_nama_tujuan" id="x_nama_tujuan" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_tujuan->getPlaceHolder()) ?>" value="<?= $Page->nama_tujuan->EditValue ?>"<?= $Page->nama_tujuan->editAttributes() ?> aria-describedby="x_nama_tujuan_help">
<?= $Page->nama_tujuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_tujuan->getErrorMessage() ?></div>
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
    ew.addEventHandlers("l_tujuankunj");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
