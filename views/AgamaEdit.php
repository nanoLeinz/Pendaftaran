<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$AgamaEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fAGAMAedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fAGAMAedit = currentForm = new ew.Form("fAGAMAedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "AGAMA")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.AGAMA)
        ew.vars.tables.AGAMA = currentTable;
    fAGAMAedit.addFields([
        ["KODE_AGAMA", [fields.KODE_AGAMA.visible && fields.KODE_AGAMA.required ? ew.Validators.required(fields.KODE_AGAMA.caption) : null, ew.Validators.integer], fields.KODE_AGAMA.isInvalid],
        ["NAMA_AGAMA", [fields.NAMA_AGAMA.visible && fields.NAMA_AGAMA.required ? ew.Validators.required(fields.NAMA_AGAMA.caption) : null], fields.NAMA_AGAMA.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fAGAMAedit,
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
    fAGAMAedit.validate = function () {
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
    fAGAMAedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fAGAMAedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fAGAMAedit");
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
<form name="fAGAMAedit" id="fAGAMAedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="AGAMA">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->KODE_AGAMA->Visible) { // KODE_AGAMA ?>
    <div id="r_KODE_AGAMA" class="form-group row">
        <label id="elh_AGAMA_KODE_AGAMA" for="x_KODE_AGAMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KODE_AGAMA->caption() ?><?= $Page->KODE_AGAMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KODE_AGAMA->cellAttributes() ?>>
<input type="<?= $Page->KODE_AGAMA->getInputTextType() ?>" data-table="AGAMA" data-field="x_KODE_AGAMA" name="x_KODE_AGAMA" id="x_KODE_AGAMA" size="30" placeholder="<?= HtmlEncode($Page->KODE_AGAMA->getPlaceHolder()) ?>" value="<?= $Page->KODE_AGAMA->EditValue ?>"<?= $Page->KODE_AGAMA->editAttributes() ?> aria-describedby="x_KODE_AGAMA_help">
<?= $Page->KODE_AGAMA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KODE_AGAMA->getErrorMessage() ?></div>
<input type="hidden" data-table="AGAMA" data-field="x_KODE_AGAMA" data-hidden="1" name="o_KODE_AGAMA" id="o_KODE_AGAMA" value="<?= HtmlEncode($Page->KODE_AGAMA->OldValue ?? $Page->KODE_AGAMA->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAMA_AGAMA->Visible) { // NAMA_AGAMA ?>
    <div id="r_NAMA_AGAMA" class="form-group row">
        <label id="elh_AGAMA_NAMA_AGAMA" for="x_NAMA_AGAMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_AGAMA->caption() ?><?= $Page->NAMA_AGAMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_AGAMA->cellAttributes() ?>>
<span id="el_AGAMA_NAMA_AGAMA">
<input type="<?= $Page->NAMA_AGAMA->getInputTextType() ?>" data-table="AGAMA" data-field="x_NAMA_AGAMA" name="x_NAMA_AGAMA" id="x_NAMA_AGAMA" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->NAMA_AGAMA->getPlaceHolder()) ?>" value="<?= $Page->NAMA_AGAMA->EditValue ?>"<?= $Page->NAMA_AGAMA->editAttributes() ?> aria-describedby="x_NAMA_AGAMA_help">
<?= $Page->NAMA_AGAMA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_AGAMA->getErrorMessage() ?></div>
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
    ew.addEventHandlers("AGAMA");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
