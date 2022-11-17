<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$Class2Edit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fCLASS2edit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fCLASS2edit = currentForm = new ew.Form("fCLASS2edit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "CLASS2")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.CLASS2)
        ew.vars.tables.CLASS2 = currentTable;
    fCLASS2edit.addFields([
        ["CLASS_ID", [fields.CLASS_ID.visible && fields.CLASS_ID.required ? ew.Validators.required(fields.CLASS_ID.caption) : null, ew.Validators.integer], fields.CLASS_ID.isInvalid],
        ["NAME_OF_CLASS", [fields.NAME_OF_CLASS.visible && fields.NAME_OF_CLASS.required ? ew.Validators.required(fields.NAME_OF_CLASS.caption) : null], fields.NAME_OF_CLASS.isInvalid],
        ["OTHER_ID", [fields.OTHER_ID.visible && fields.OTHER_ID.required ? ew.Validators.required(fields.OTHER_ID.caption) : null], fields.OTHER_ID.isInvalid],
        ["KDKELASV", [fields.KDKELASV.visible && fields.KDKELASV.required ? ew.Validators.required(fields.KDKELASV.caption) : null], fields.KDKELASV.isInvalid],
        ["KODEKELAS", [fields.KODEKELAS.visible && fields.KODEKELAS.required ? ew.Validators.required(fields.KODEKELAS.caption) : null], fields.KODEKELAS.isInvalid],
        ["SISKODEKELAS", [fields.SISKODEKELAS.visible && fields.SISKODEKELAS.required ? ew.Validators.required(fields.SISKODEKELAS.caption) : null], fields.SISKODEKELAS.isInvalid],
        ["SISKODERAWAT", [fields.SISKODERAWAT.visible && fields.SISKODERAWAT.required ? ew.Validators.required(fields.SISKODERAWAT.caption) : null], fields.SISKODERAWAT.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fCLASS2edit,
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
    fCLASS2edit.validate = function () {
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
    fCLASS2edit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fCLASS2edit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fCLASS2edit");
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
<form name="fCLASS2edit" id="fCLASS2edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CLASS2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <div id="r_CLASS_ID" class="form-group row">
        <label id="elh_CLASS2_CLASS_ID" for="x_CLASS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLASS_ID->caption() ?><?= $Page->CLASS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ID->cellAttributes() ?>>
<input type="<?= $Page->CLASS_ID->getInputTextType() ?>" data-table="CLASS2" data-field="x_CLASS_ID" name="x_CLASS_ID" id="x_CLASS_ID" size="30" placeholder="<?= HtmlEncode($Page->CLASS_ID->getPlaceHolder()) ?>" value="<?= $Page->CLASS_ID->EditValue ?>"<?= $Page->CLASS_ID->editAttributes() ?> aria-describedby="x_CLASS_ID_help">
<?= $Page->CLASS_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CLASS_ID->getErrorMessage() ?></div>
<input type="hidden" data-table="CLASS2" data-field="x_CLASS_ID" data-hidden="1" name="o_CLASS_ID" id="o_CLASS_ID" value="<?= HtmlEncode($Page->CLASS_ID->OldValue ?? $Page->CLASS_ID->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAME_OF_CLASS->Visible) { // NAME_OF_CLASS ?>
    <div id="r_NAME_OF_CLASS" class="form-group row">
        <label id="elh_CLASS2_NAME_OF_CLASS" for="x_NAME_OF_CLASS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAME_OF_CLASS->caption() ?><?= $Page->NAME_OF_CLASS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAME_OF_CLASS->cellAttributes() ?>>
<span id="el_CLASS2_NAME_OF_CLASS">
<input type="<?= $Page->NAME_OF_CLASS->getInputTextType() ?>" data-table="CLASS2" data-field="x_NAME_OF_CLASS" name="x_NAME_OF_CLASS" id="x_NAME_OF_CLASS" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->NAME_OF_CLASS->getPlaceHolder()) ?>" value="<?= $Page->NAME_OF_CLASS->EditValue ?>"<?= $Page->NAME_OF_CLASS->editAttributes() ?> aria-describedby="x_NAME_OF_CLASS_help">
<?= $Page->NAME_OF_CLASS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAME_OF_CLASS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
    <div id="r_OTHER_ID" class="form-group row">
        <label id="elh_CLASS2_OTHER_ID" for="x_OTHER_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->OTHER_ID->caption() ?><?= $Page->OTHER_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el_CLASS2_OTHER_ID">
<input type="<?= $Page->OTHER_ID->getInputTextType() ?>" data-table="CLASS2" data-field="x_OTHER_ID" name="x_OTHER_ID" id="x_OTHER_ID" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->OTHER_ID->getPlaceHolder()) ?>" value="<?= $Page->OTHER_ID->EditValue ?>"<?= $Page->OTHER_ID->editAttributes() ?> aria-describedby="x_OTHER_ID_help">
<?= $Page->OTHER_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->OTHER_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KDKELASV->Visible) { // KDKELASV ?>
    <div id="r_KDKELASV" class="form-group row">
        <label id="elh_CLASS2_KDKELASV" for="x_KDKELASV" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KDKELASV->caption() ?><?= $Page->KDKELASV->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDKELASV->cellAttributes() ?>>
<span id="el_CLASS2_KDKELASV">
<input type="<?= $Page->KDKELASV->getInputTextType() ?>" data-table="CLASS2" data-field="x_KDKELASV" name="x_KDKELASV" id="x_KDKELASV" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->KDKELASV->getPlaceHolder()) ?>" value="<?= $Page->KDKELASV->EditValue ?>"<?= $Page->KDKELASV->editAttributes() ?> aria-describedby="x_KDKELASV_help">
<?= $Page->KDKELASV->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KDKELASV->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KODEKELAS->Visible) { // KODEKELAS ?>
    <div id="r_KODEKELAS" class="form-group row">
        <label id="elh_CLASS2_KODEKELAS" for="x_KODEKELAS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KODEKELAS->caption() ?><?= $Page->KODEKELAS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KODEKELAS->cellAttributes() ?>>
<span id="el_CLASS2_KODEKELAS">
<input type="<?= $Page->KODEKELAS->getInputTextType() ?>" data-table="CLASS2" data-field="x_KODEKELAS" name="x_KODEKELAS" id="x_KODEKELAS" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->KODEKELAS->getPlaceHolder()) ?>" value="<?= $Page->KODEKELAS->EditValue ?>"<?= $Page->KODEKELAS->editAttributes() ?> aria-describedby="x_KODEKELAS_help">
<?= $Page->KODEKELAS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KODEKELAS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SISKODEKELAS->Visible) { // SISKODEKELAS ?>
    <div id="r_SISKODEKELAS" class="form-group row">
        <label id="elh_CLASS2_SISKODEKELAS" for="x_SISKODEKELAS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SISKODEKELAS->caption() ?><?= $Page->SISKODEKELAS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SISKODEKELAS->cellAttributes() ?>>
<span id="el_CLASS2_SISKODEKELAS">
<input type="<?= $Page->SISKODEKELAS->getInputTextType() ?>" data-table="CLASS2" data-field="x_SISKODEKELAS" name="x_SISKODEKELAS" id="x_SISKODEKELAS" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->SISKODEKELAS->getPlaceHolder()) ?>" value="<?= $Page->SISKODEKELAS->EditValue ?>"<?= $Page->SISKODEKELAS->editAttributes() ?> aria-describedby="x_SISKODEKELAS_help">
<?= $Page->SISKODEKELAS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SISKODEKELAS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SISKODERAWAT->Visible) { // SISKODERAWAT ?>
    <div id="r_SISKODERAWAT" class="form-group row">
        <label id="elh_CLASS2_SISKODERAWAT" for="x_SISKODERAWAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SISKODERAWAT->caption() ?><?= $Page->SISKODERAWAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SISKODERAWAT->cellAttributes() ?>>
<span id="el_CLASS2_SISKODERAWAT">
<input type="<?= $Page->SISKODERAWAT->getInputTextType() ?>" data-table="CLASS2" data-field="x_SISKODERAWAT" name="x_SISKODERAWAT" id="x_SISKODERAWAT" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->SISKODERAWAT->getPlaceHolder()) ?>" value="<?= $Page->SISKODERAWAT->EditValue ?>"<?= $Page->SISKODERAWAT->editAttributes() ?> aria-describedby="x_SISKODERAWAT_help">
<?= $Page->SISKODERAWAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SISKODERAWAT->getErrorMessage() ?></div>
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
    ew.addEventHandlers("CLASS2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
