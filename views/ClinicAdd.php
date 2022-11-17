<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$ClinicAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fCLINICadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fCLINICadd = currentForm = new ew.Form("fCLINICadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "CLINIC")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.CLINIC)
        ew.vars.tables.CLINIC = currentTable;
    fCLINICadd.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["CLINIC_ID", [fields.CLINIC_ID.visible && fields.CLINIC_ID.required ? ew.Validators.required(fields.CLINIC_ID.caption) : null], fields.CLINIC_ID.isInvalid],
        ["NAME_OF_CLINIC", [fields.NAME_OF_CLINIC.visible && fields.NAME_OF_CLINIC.required ? ew.Validators.required(fields.NAME_OF_CLINIC.caption) : null], fields.NAME_OF_CLINIC.isInvalid],
        ["ORG_ID", [fields.ORG_ID.visible && fields.ORG_ID.required ? ew.Validators.required(fields.ORG_ID.caption) : null], fields.ORG_ID.isInvalid],
        ["STYPE_ID", [fields.STYPE_ID.visible && fields.STYPE_ID.required ? ew.Validators.required(fields.STYPE_ID.caption) : null, ew.Validators.integer], fields.STYPE_ID.isInvalid],
        ["CLINIC_TYPE", [fields.CLINIC_TYPE.visible && fields.CLINIC_TYPE.required ? ew.Validators.required(fields.CLINIC_TYPE.caption) : null, ew.Validators.integer], fields.CLINIC_TYPE.isInvalid],
        ["OTHER_ID", [fields.OTHER_ID.visible && fields.OTHER_ID.required ? ew.Validators.required(fields.OTHER_ID.caption) : null], fields.OTHER_ID.isInvalid],
        ["ACCOUNT_ID", [fields.ACCOUNT_ID.visible && fields.ACCOUNT_ID.required ? ew.Validators.required(fields.ACCOUNT_ID.caption) : null], fields.ACCOUNT_ID.isInvalid],
        ["FA_V", [fields.FA_V.visible && fields.FA_V.required ? ew.Validators.required(fields.FA_V.caption) : null, ew.Validators.integer], fields.FA_V.isInvalid],
        ["PROFIT_ID", [fields.PROFIT_ID.visible && fields.PROFIT_ID.required ? ew.Validators.required(fields.PROFIT_ID.caption) : null], fields.PROFIT_ID.isInvalid],
        ["SUPPLIED_MM", [fields.SUPPLIED_MM.visible && fields.SUPPLIED_MM.required ? ew.Validators.required(fields.SUPPLIED_MM.caption) : null], fields.SUPPLIED_MM.isInvalid],
        ["KDPOLI", [fields.KDPOLI.visible && fields.KDPOLI.required ? ew.Validators.required(fields.KDPOLI.caption) : null], fields.KDPOLI.isInvalid],
        ["PICTUREFILE", [fields.PICTUREFILE.visible && fields.PICTUREFILE.required ? ew.Validators.required(fields.PICTUREFILE.caption) : null], fields.PICTUREFILE.isInvalid],
        ["PROFILES", [fields.PROFILES.visible && fields.PROFILES.required ? ew.Validators.required(fields.PROFILES.caption) : null], fields.PROFILES.isInvalid],
        ["SPESIALISTIK", [fields.SPESIALISTIK.visible && fields.SPESIALISTIK.required ? ew.Validators.required(fields.SPESIALISTIK.caption) : null], fields.SPESIALISTIK.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fCLINICadd,
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
    fCLINICadd.validate = function () {
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
    fCLINICadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fCLINICadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fCLINICadd");
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
<form name="fCLINICadd" id="fCLINICadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="CLINIC">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <div id="r_ORG_UNIT_CODE" class="form-group row">
        <label id="elh_CLINIC_ORG_UNIT_CODE" for="x_ORG_UNIT_CODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ORG_UNIT_CODE->caption() ?><?= $Page->ORG_UNIT_CODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_CLINIC_ORG_UNIT_CODE">
<input type="<?= $Page->ORG_UNIT_CODE->getInputTextType() ?>" data-table="CLINIC" data-field="x_ORG_UNIT_CODE" name="x_ORG_UNIT_CODE" id="x_ORG_UNIT_CODE" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ORG_UNIT_CODE->getPlaceHolder()) ?>" value="<?= $Page->ORG_UNIT_CODE->EditValue ?>"<?= $Page->ORG_UNIT_CODE->editAttributes() ?> aria-describedby="x_ORG_UNIT_CODE_help">
<?= $Page->ORG_UNIT_CODE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ORG_UNIT_CODE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <div id="r_CLINIC_ID" class="form-group row">
        <label id="elh_CLINIC_CLINIC_ID" for="x_CLINIC_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLINIC_ID->caption() ?><?= $Page->CLINIC_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_CLINIC_CLINIC_ID">
<input type="<?= $Page->CLINIC_ID->getInputTextType() ?>" data-table="CLINIC" data-field="x_CLINIC_ID" name="x_CLINIC_ID" id="x_CLINIC_ID" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->CLINIC_ID->getPlaceHolder()) ?>" value="<?= $Page->CLINIC_ID->EditValue ?>"<?= $Page->CLINIC_ID->editAttributes() ?> aria-describedby="x_CLINIC_ID_help">
<?= $Page->CLINIC_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CLINIC_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAME_OF_CLINIC->Visible) { // NAME_OF_CLINIC ?>
    <div id="r_NAME_OF_CLINIC" class="form-group row">
        <label id="elh_CLINIC_NAME_OF_CLINIC" for="x_NAME_OF_CLINIC" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAME_OF_CLINIC->caption() ?><?= $Page->NAME_OF_CLINIC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAME_OF_CLINIC->cellAttributes() ?>>
<span id="el_CLINIC_NAME_OF_CLINIC">
<input type="<?= $Page->NAME_OF_CLINIC->getInputTextType() ?>" data-table="CLINIC" data-field="x_NAME_OF_CLINIC" name="x_NAME_OF_CLINIC" id="x_NAME_OF_CLINIC" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAME_OF_CLINIC->getPlaceHolder()) ?>" value="<?= $Page->NAME_OF_CLINIC->EditValue ?>"<?= $Page->NAME_OF_CLINIC->editAttributes() ?> aria-describedby="x_NAME_OF_CLINIC_help">
<?= $Page->NAME_OF_CLINIC->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAME_OF_CLINIC->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
    <div id="r_ORG_ID" class="form-group row">
        <label id="elh_CLINIC_ORG_ID" for="x_ORG_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ORG_ID->caption() ?><?= $Page->ORG_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ORG_ID->cellAttributes() ?>>
<span id="el_CLINIC_ORG_ID">
<input type="<?= $Page->ORG_ID->getInputTextType() ?>" data-table="CLINIC" data-field="x_ORG_ID" name="x_ORG_ID" id="x_ORG_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ORG_ID->getPlaceHolder()) ?>" value="<?= $Page->ORG_ID->EditValue ?>"<?= $Page->ORG_ID->editAttributes() ?> aria-describedby="x_ORG_ID_help">
<?= $Page->ORG_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ORG_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->STYPE_ID->Visible) { // STYPE_ID ?>
    <div id="r_STYPE_ID" class="form-group row">
        <label id="elh_CLINIC_STYPE_ID" for="x_STYPE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STYPE_ID->caption() ?><?= $Page->STYPE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STYPE_ID->cellAttributes() ?>>
<span id="el_CLINIC_STYPE_ID">
<input type="<?= $Page->STYPE_ID->getInputTextType() ?>" data-table="CLINIC" data-field="x_STYPE_ID" name="x_STYPE_ID" id="x_STYPE_ID" size="30" placeholder="<?= HtmlEncode($Page->STYPE_ID->getPlaceHolder()) ?>" value="<?= $Page->STYPE_ID->EditValue ?>"<?= $Page->STYPE_ID->editAttributes() ?> aria-describedby="x_STYPE_ID_help">
<?= $Page->STYPE_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->STYPE_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_TYPE->Visible) { // CLINIC_TYPE ?>
    <div id="r_CLINIC_TYPE" class="form-group row">
        <label id="elh_CLINIC_CLINIC_TYPE" for="x_CLINIC_TYPE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLINIC_TYPE->caption() ?><?= $Page->CLINIC_TYPE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_TYPE->cellAttributes() ?>>
<span id="el_CLINIC_CLINIC_TYPE">
<input type="<?= $Page->CLINIC_TYPE->getInputTextType() ?>" data-table="CLINIC" data-field="x_CLINIC_TYPE" name="x_CLINIC_TYPE" id="x_CLINIC_TYPE" size="30" placeholder="<?= HtmlEncode($Page->CLINIC_TYPE->getPlaceHolder()) ?>" value="<?= $Page->CLINIC_TYPE->EditValue ?>"<?= $Page->CLINIC_TYPE->editAttributes() ?> aria-describedby="x_CLINIC_TYPE_help">
<?= $Page->CLINIC_TYPE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CLINIC_TYPE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
    <div id="r_OTHER_ID" class="form-group row">
        <label id="elh_CLINIC_OTHER_ID" for="x_OTHER_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->OTHER_ID->caption() ?><?= $Page->OTHER_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el_CLINIC_OTHER_ID">
<input type="<?= $Page->OTHER_ID->getInputTextType() ?>" data-table="CLINIC" data-field="x_OTHER_ID" name="x_OTHER_ID" id="x_OTHER_ID" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->OTHER_ID->getPlaceHolder()) ?>" value="<?= $Page->OTHER_ID->EditValue ?>"<?= $Page->OTHER_ID->editAttributes() ?> aria-describedby="x_OTHER_ID_help">
<?= $Page->OTHER_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->OTHER_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ACCOUNT_ID->Visible) { // ACCOUNT_ID ?>
    <div id="r_ACCOUNT_ID" class="form-group row">
        <label id="elh_CLINIC_ACCOUNT_ID" for="x_ACCOUNT_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ACCOUNT_ID->caption() ?><?= $Page->ACCOUNT_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ACCOUNT_ID->cellAttributes() ?>>
<span id="el_CLINIC_ACCOUNT_ID">
<input type="<?= $Page->ACCOUNT_ID->getInputTextType() ?>" data-table="CLINIC" data-field="x_ACCOUNT_ID" name="x_ACCOUNT_ID" id="x_ACCOUNT_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ACCOUNT_ID->getPlaceHolder()) ?>" value="<?= $Page->ACCOUNT_ID->EditValue ?>"<?= $Page->ACCOUNT_ID->editAttributes() ?> aria-describedby="x_ACCOUNT_ID_help">
<?= $Page->ACCOUNT_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ACCOUNT_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FA_V->Visible) { // FA_V ?>
    <div id="r_FA_V" class="form-group row">
        <label id="elh_CLINIC_FA_V" for="x_FA_V" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FA_V->caption() ?><?= $Page->FA_V->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FA_V->cellAttributes() ?>>
<span id="el_CLINIC_FA_V">
<input type="<?= $Page->FA_V->getInputTextType() ?>" data-table="CLINIC" data-field="x_FA_V" name="x_FA_V" id="x_FA_V" size="30" placeholder="<?= HtmlEncode($Page->FA_V->getPlaceHolder()) ?>" value="<?= $Page->FA_V->EditValue ?>"<?= $Page->FA_V->editAttributes() ?> aria-describedby="x_FA_V_help">
<?= $Page->FA_V->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FA_V->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROFIT_ID->Visible) { // PROFIT_ID ?>
    <div id="r_PROFIT_ID" class="form-group row">
        <label id="elh_CLINIC_PROFIT_ID" for="x_PROFIT_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROFIT_ID->caption() ?><?= $Page->PROFIT_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROFIT_ID->cellAttributes() ?>>
<span id="el_CLINIC_PROFIT_ID">
<input type="<?= $Page->PROFIT_ID->getInputTextType() ?>" data-table="CLINIC" data-field="x_PROFIT_ID" name="x_PROFIT_ID" id="x_PROFIT_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROFIT_ID->getPlaceHolder()) ?>" value="<?= $Page->PROFIT_ID->EditValue ?>"<?= $Page->PROFIT_ID->editAttributes() ?> aria-describedby="x_PROFIT_ID_help">
<?= $Page->PROFIT_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROFIT_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SUPPLIED_MM->Visible) { // SUPPLIED_MM ?>
    <div id="r_SUPPLIED_MM" class="form-group row">
        <label id="elh_CLINIC_SUPPLIED_MM" for="x_SUPPLIED_MM" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SUPPLIED_MM->caption() ?><?= $Page->SUPPLIED_MM->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SUPPLIED_MM->cellAttributes() ?>>
<span id="el_CLINIC_SUPPLIED_MM">
<input type="<?= $Page->SUPPLIED_MM->getInputTextType() ?>" data-table="CLINIC" data-field="x_SUPPLIED_MM" name="x_SUPPLIED_MM" id="x_SUPPLIED_MM" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->SUPPLIED_MM->getPlaceHolder()) ?>" value="<?= $Page->SUPPLIED_MM->EditValue ?>"<?= $Page->SUPPLIED_MM->editAttributes() ?> aria-describedby="x_SUPPLIED_MM_help">
<?= $Page->SUPPLIED_MM->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SUPPLIED_MM->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KDPOLI->Visible) { // KDPOLI ?>
    <div id="r_KDPOLI" class="form-group row">
        <label id="elh_CLINIC_KDPOLI" for="x_KDPOLI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KDPOLI->caption() ?><?= $Page->KDPOLI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDPOLI->cellAttributes() ?>>
<span id="el_CLINIC_KDPOLI">
<input type="<?= $Page->KDPOLI->getInputTextType() ?>" data-table="CLINIC" data-field="x_KDPOLI" name="x_KDPOLI" id="x_KDPOLI" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->KDPOLI->getPlaceHolder()) ?>" value="<?= $Page->KDPOLI->EditValue ?>"<?= $Page->KDPOLI->editAttributes() ?> aria-describedby="x_KDPOLI_help">
<?= $Page->KDPOLI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KDPOLI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PICTUREFILE->Visible) { // PICTUREFILE ?>
    <div id="r_PICTUREFILE" class="form-group row">
        <label id="elh_CLINIC_PICTUREFILE" for="x_PICTUREFILE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PICTUREFILE->caption() ?><?= $Page->PICTUREFILE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PICTUREFILE->cellAttributes() ?>>
<span id="el_CLINIC_PICTUREFILE">
<textarea data-table="CLINIC" data-field="x_PICTUREFILE" name="x_PICTUREFILE" id="x_PICTUREFILE" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->PICTUREFILE->getPlaceHolder()) ?>"<?= $Page->PICTUREFILE->editAttributes() ?> aria-describedby="x_PICTUREFILE_help"><?= $Page->PICTUREFILE->EditValue ?></textarea>
<?= $Page->PICTUREFILE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PICTUREFILE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROFILES->Visible) { // PROFILES ?>
    <div id="r_PROFILES" class="form-group row">
        <label id="elh_CLINIC_PROFILES" for="x_PROFILES" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROFILES->caption() ?><?= $Page->PROFILES->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROFILES->cellAttributes() ?>>
<span id="el_CLINIC_PROFILES">
<textarea data-table="CLINIC" data-field="x_PROFILES" name="x_PROFILES" id="x_PROFILES" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->PROFILES->getPlaceHolder()) ?>"<?= $Page->PROFILES->editAttributes() ?> aria-describedby="x_PROFILES_help"><?= $Page->PROFILES->EditValue ?></textarea>
<?= $Page->PROFILES->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROFILES->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SPESIALISTIK->Visible) { // SPESIALISTIK ?>
    <div id="r_SPESIALISTIK" class="form-group row">
        <label id="elh_CLINIC_SPESIALISTIK" for="x_SPESIALISTIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SPESIALISTIK->caption() ?><?= $Page->SPESIALISTIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SPESIALISTIK->cellAttributes() ?>>
<span id="el_CLINIC_SPESIALISTIK">
<input type="<?= $Page->SPESIALISTIK->getInputTextType() ?>" data-table="CLINIC" data-field="x_SPESIALISTIK" name="x_SPESIALISTIK" id="x_SPESIALISTIK" size="30" maxlength="3" placeholder="<?= HtmlEncode($Page->SPESIALISTIK->getPlaceHolder()) ?>" value="<?= $Page->SPESIALISTIK->EditValue ?>"<?= $Page->SPESIALISTIK->editAttributes() ?> aria-describedby="x_SPESIALISTIK_help">
<?= $Page->SPESIALISTIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SPESIALISTIK->getErrorMessage() ?></div>
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
    ew.addEventHandlers("CLINIC");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
