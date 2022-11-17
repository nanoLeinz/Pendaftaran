<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LKelasEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_kelasedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fl_kelasedit = currentForm = new ew.Form("fl_kelasedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "l_kelas")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.l_kelas)
        ew.vars.tables.l_kelas = currentTable;
    fl_kelasedit.addFields([
        ["id_kelas", [fields.id_kelas.visible && fields.id_kelas.required ? ew.Validators.required(fields.id_kelas.caption) : null], fields.id_kelas.isInvalid],
        ["kode_kelas", [fields.kode_kelas.visible && fields.kode_kelas.required ? ew.Validators.required(fields.kode_kelas.caption) : null, ew.Validators.integer], fields.kode_kelas.isInvalid],
        ["nama_kelas", [fields.nama_kelas.visible && fields.nama_kelas.required ? ew.Validators.required(fields.nama_kelas.caption) : null], fields.nama_kelas.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fl_kelasedit,
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
    fl_kelasedit.validate = function () {
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
    fl_kelasedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fl_kelasedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fl_kelasedit");
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
<form name="fl_kelasedit" id="fl_kelasedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_kelas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_kelas->Visible) { // id_kelas ?>
    <div id="r_id_kelas" class="form-group row">
        <label id="elh_l_kelas_id_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_kelas->caption() ?><?= $Page->id_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_kelas->cellAttributes() ?>>
<span id="el_l_kelas_id_kelas">
<span<?= $Page->id_kelas->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_kelas->getDisplayValue($Page->id_kelas->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="l_kelas" data-field="x_id_kelas" data-hidden="1" name="x_id_kelas" id="x_id_kelas" value="<?= HtmlEncode($Page->id_kelas->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kode_kelas->Visible) { // kode_kelas ?>
    <div id="r_kode_kelas" class="form-group row">
        <label id="elh_l_kelas_kode_kelas" for="x_kode_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kode_kelas->caption() ?><?= $Page->kode_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kode_kelas->cellAttributes() ?>>
<span id="el_l_kelas_kode_kelas">
<input type="<?= $Page->kode_kelas->getInputTextType() ?>" data-table="l_kelas" data-field="x_kode_kelas" name="x_kode_kelas" id="x_kode_kelas" size="30" placeholder="<?= HtmlEncode($Page->kode_kelas->getPlaceHolder()) ?>" value="<?= $Page->kode_kelas->EditValue ?>"<?= $Page->kode_kelas->editAttributes() ?> aria-describedby="x_kode_kelas_help">
<?= $Page->kode_kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kode_kelas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_kelas->Visible) { // nama_kelas ?>
    <div id="r_nama_kelas" class="form-group row">
        <label id="elh_l_kelas_nama_kelas" for="x_nama_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_kelas->caption() ?><?= $Page->nama_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_kelas->cellAttributes() ?>>
<span id="el_l_kelas_nama_kelas">
<input type="<?= $Page->nama_kelas->getInputTextType() ?>" data-table="l_kelas" data-field="x_nama_kelas" name="x_nama_kelas" id="x_nama_kelas" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama_kelas->getPlaceHolder()) ?>" value="<?= $Page->nama_kelas->EditValue ?>"<?= $Page->nama_kelas->editAttributes() ?> aria-describedby="x_nama_kelas_help">
<?= $Page->nama_kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_kelas->getErrorMessage() ?></div>
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
    ew.addEventHandlers("l_kelas");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
