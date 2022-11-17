<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$SexEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fSEXedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fSEXedit = currentForm = new ew.Form("fSEXedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "SEX")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.SEX)
        ew.vars.tables.SEX = currentTable;
    fSEXedit.addFields([
        ["GENDER", [fields.GENDER.visible && fields.GENDER.required ? ew.Validators.required(fields.GENDER.caption) : null], fields.GENDER.isInvalid],
        ["NAME_OF_GENDER", [fields.NAME_OF_GENDER.visible && fields.NAME_OF_GENDER.required ? ew.Validators.required(fields.NAME_OF_GENDER.caption) : null], fields.NAME_OF_GENDER.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fSEXedit,
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
    fSEXedit.validate = function () {
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
    fSEXedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fSEXedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fSEXedit");
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
<form name="fSEXedit" id="fSEXedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="SEX">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->GENDER->Visible) { // GENDER ?>
    <div id="r_GENDER" class="form-group row">
        <label id="elh_SEX_GENDER" for="x_GENDER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->GENDER->caption() ?><?= $Page->GENDER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->GENDER->cellAttributes() ?>>
<input type="<?= $Page->GENDER->getInputTextType() ?>" data-table="SEX" data-field="x_GENDER" name="x_GENDER" id="x_GENDER" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->GENDER->getPlaceHolder()) ?>" value="<?= $Page->GENDER->EditValue ?>"<?= $Page->GENDER->editAttributes() ?> aria-describedby="x_GENDER_help">
<?= $Page->GENDER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->GENDER->getErrorMessage() ?></div>
<input type="hidden" data-table="SEX" data-field="x_GENDER" data-hidden="1" name="o_GENDER" id="o_GENDER" value="<?= HtmlEncode($Page->GENDER->OldValue ?? $Page->GENDER->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAME_OF_GENDER->Visible) { // NAME_OF_GENDER ?>
    <div id="r_NAME_OF_GENDER" class="form-group row">
        <label id="elh_SEX_NAME_OF_GENDER" for="x_NAME_OF_GENDER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAME_OF_GENDER->caption() ?><?= $Page->NAME_OF_GENDER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAME_OF_GENDER->cellAttributes() ?>>
<span id="el_SEX_NAME_OF_GENDER">
<input type="<?= $Page->NAME_OF_GENDER->getInputTextType() ?>" data-table="SEX" data-field="x_NAME_OF_GENDER" name="x_NAME_OF_GENDER" id="x_NAME_OF_GENDER" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->NAME_OF_GENDER->getPlaceHolder()) ?>" value="<?= $Page->NAME_OF_GENDER->EditValue ?>"<?= $Page->NAME_OF_GENDER->editAttributes() ?> aria-describedby="x_NAME_OF_GENDER_help">
<?= $Page->NAME_OF_GENDER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAME_OF_GENDER->getErrorMessage() ?></div>
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
    ew.addEventHandlers("SEX");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
