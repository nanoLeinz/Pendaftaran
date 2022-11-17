<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatmentObatEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fTREATMENT_OBATedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fTREATMENT_OBATedit = currentForm = new ew.Form("fTREATMENT_OBATedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "TREATMENT_OBAT")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.TREATMENT_OBAT)
        ew.vars.tables.TREATMENT_OBAT = currentTable;
    fTREATMENT_OBATedit.addFields([
        ["NO_REGISTRATION", [fields.NO_REGISTRATION.visible && fields.NO_REGISTRATION.required ? ew.Validators.required(fields.NO_REGISTRATION.caption) : null], fields.NO_REGISTRATION.isInvalid],
        ["RESEP_NO", [fields.RESEP_NO.visible && fields.RESEP_NO.required ? ew.Validators.required(fields.RESEP_NO.caption) : null], fields.RESEP_NO.isInvalid],
        ["TARIF_ID", [fields.TARIF_ID.visible && fields.TARIF_ID.required ? ew.Validators.required(fields.TARIF_ID.caption) : null], fields.TARIF_ID.isInvalid],
        ["TREATMENT", [fields.TREATMENT.visible && fields.TREATMENT.required ? ew.Validators.required(fields.TREATMENT.caption) : null], fields.TREATMENT.isInvalid],
        ["TREAT_DATE", [fields.TREAT_DATE.visible && fields.TREAT_DATE.required ? ew.Validators.required(fields.TREAT_DATE.caption) : null], fields.TREAT_DATE.isInvalid],
        ["MEASURE_ID", [fields.MEASURE_ID.visible && fields.MEASURE_ID.required ? ew.Validators.required(fields.MEASURE_ID.caption) : null, ew.Validators.integer], fields.MEASURE_ID.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid],
        ["DOSE_PRESC", [fields.DOSE_PRESC.visible && fields.DOSE_PRESC.required ? ew.Validators.required(fields.DOSE_PRESC.caption) : null, ew.Validators.float], fields.DOSE_PRESC.isInvalid],
        ["RACIKAN", [fields.RACIKAN.visible && fields.RACIKAN.required ? ew.Validators.required(fields.RACIKAN.caption) : null, ew.Validators.integer], fields.RACIKAN.isInvalid],
        ["BRAND_ID", [fields.BRAND_ID.visible && fields.BRAND_ID.required ? ew.Validators.required(fields.BRAND_ID.caption) : null], fields.BRAND_ID.isInvalid],
        ["ID", [fields.ID.visible && fields.ID.required ? ew.Validators.required(fields.ID.caption) : null], fields.ID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fTREATMENT_OBATedit,
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
    fTREATMENT_OBATedit.validate = function () {
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
    fTREATMENT_OBATedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fTREATMENT_OBATedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fTREATMENT_OBATedit.lists.BRAND_ID = <?= $Page->BRAND_ID->toClientList($Page) ?>;
    loadjs.done("fTREATMENT_OBATedit");
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
<form name="fTREATMENT_OBATedit" id="fTREATMENT_OBATedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREATMENT_OBAT">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "V_FARMASI") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_FARMASI">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NO_REGISTRATION->Visible) { // NO_REGISTRATION ?>
    <div id="r_NO_REGISTRATION" class="form-group row">
        <label id="elh_TREATMENT_OBAT_NO_REGISTRATION" for="x_NO_REGISTRATION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_REGISTRATION->caption() ?><?= $Page->NO_REGISTRATION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_REGISTRATION->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_NO_REGISTRATION">
<span<?= $Page->NO_REGISTRATION->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NO_REGISTRATION->getDisplayValue($Page->NO_REGISTRATION->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_NO_REGISTRATION" data-hidden="1" name="x_NO_REGISTRATION" id="x_NO_REGISTRATION" value="<?= HtmlEncode($Page->NO_REGISTRATION->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->RESEP_NO->Visible) { // RESEP_NO ?>
    <div id="r_RESEP_NO" class="form-group row">
        <label id="elh_TREATMENT_OBAT_RESEP_NO" for="x_RESEP_NO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->RESEP_NO->caption() ?><?= $Page->RESEP_NO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RESEP_NO->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_RESEP_NO">
<input type="<?= $Page->RESEP_NO->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_RESEP_NO" name="x_RESEP_NO" id="x_RESEP_NO" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->RESEP_NO->getPlaceHolder()) ?>" value="<?= $Page->RESEP_NO->EditValue ?>"<?= $Page->RESEP_NO->editAttributes() ?> aria-describedby="x_RESEP_NO_help">
<?= $Page->RESEP_NO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->RESEP_NO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
    <div id="r_TARIF_ID" class="form-group row">
        <label id="elh_TREATMENT_OBAT_TARIF_ID" for="x_TARIF_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TARIF_ID->caption() ?><?= $Page->TARIF_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TARIF_ID->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_TARIF_ID">
<span<?= $Page->TARIF_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->TARIF_ID->getDisplayValue($Page->TARIF_ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TARIF_ID" data-hidden="1" name="x_TARIF_ID" id="x_TARIF_ID" value="<?= HtmlEncode($Page->TARIF_ID->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { // TREATMENT ?>
    <div id="r_TREATMENT" class="form-group row">
        <label id="elh_TREATMENT_OBAT_TREATMENT" for="x_TREATMENT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TREATMENT->caption() ?><?= $Page->TREATMENT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TREATMENT->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_TREATMENT">
<span<?= $Page->TREATMENT->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->TREATMENT->getDisplayValue($Page->TREATMENT->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_TREATMENT" data-hidden="1" name="x_TREATMENT" id="x_TREATMENT" value="<?= HtmlEncode($Page->TREATMENT->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MEASURE_ID->Visible) { // MEASURE_ID ?>
    <div id="r_MEASURE_ID" class="form-group row">
        <label id="elh_TREATMENT_OBAT_MEASURE_ID" for="x_MEASURE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MEASURE_ID->caption() ?><?= $Page->MEASURE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MEASURE_ID->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_MEASURE_ID">
<input type="<?= $Page->MEASURE_ID->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_MEASURE_ID" name="x_MEASURE_ID" id="x_MEASURE_ID" size="30" placeholder="<?= HtmlEncode($Page->MEASURE_ID->getPlaceHolder()) ?>" value="<?= $Page->MEASURE_ID->EditValue ?>"<?= $Page->MEASURE_ID->editAttributes() ?> aria-describedby="x_MEASURE_ID_help">
<?= $Page->MEASURE_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MEASURE_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <div id="r_DESCRIPTION" class="form-group row">
        <label id="elh_TREATMENT_OBAT_DESCRIPTION" for="x_DESCRIPTION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DESCRIPTION->caption() ?><?= $Page->DESCRIPTION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_DESCRIPTION">
<input type="<?= $Page->DESCRIPTION->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_DESCRIPTION" name="x_DESCRIPTION" id="x_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Page->DESCRIPTION->EditValue ?>"<?= $Page->DESCRIPTION->editAttributes() ?> aria-describedby="x_DESCRIPTION_help">
<?= $Page->DESCRIPTION->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DESCRIPTION->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DOSE_PRESC->Visible) { // DOSE_PRESC ?>
    <div id="r_DOSE_PRESC" class="form-group row">
        <label id="elh_TREATMENT_OBAT_DOSE_PRESC" for="x_DOSE_PRESC" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DOSE_PRESC->caption() ?><?= $Page->DOSE_PRESC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DOSE_PRESC->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_DOSE_PRESC">
<input type="<?= $Page->DOSE_PRESC->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_DOSE_PRESC" name="x_DOSE_PRESC" id="x_DOSE_PRESC" size="30" placeholder="<?= HtmlEncode($Page->DOSE_PRESC->getPlaceHolder()) ?>" value="<?= $Page->DOSE_PRESC->EditValue ?>"<?= $Page->DOSE_PRESC->editAttributes() ?> aria-describedby="x_DOSE_PRESC_help">
<?= $Page->DOSE_PRESC->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DOSE_PRESC->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->RACIKAN->Visible) { // RACIKAN ?>
    <div id="r_RACIKAN" class="form-group row">
        <label id="elh_TREATMENT_OBAT_RACIKAN" for="x_RACIKAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->RACIKAN->caption() ?><?= $Page->RACIKAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RACIKAN->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_RACIKAN">
<input type="<?= $Page->RACIKAN->getInputTextType() ?>" data-table="TREATMENT_OBAT" data-field="x_RACIKAN" name="x_RACIKAN" id="x_RACIKAN" size="30" placeholder="<?= HtmlEncode($Page->RACIKAN->getPlaceHolder()) ?>" value="<?= $Page->RACIKAN->EditValue ?>"<?= $Page->RACIKAN->editAttributes() ?> aria-describedby="x_RACIKAN_help">
<?= $Page->RACIKAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->RACIKAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->BRAND_ID->Visible) { // BRAND_ID ?>
    <div id="r_BRAND_ID" class="form-group row">
        <label id="elh_TREATMENT_OBAT_BRAND_ID" for="x_BRAND_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->BRAND_ID->caption() ?><?= $Page->BRAND_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->BRAND_ID->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_BRAND_ID">
<div class="input-group ew-lookup-list" aria-describedby="x_BRAND_ID_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BRAND_ID"><?= EmptyValue(strval($Page->BRAND_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->BRAND_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->BRAND_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->BRAND_ID->ReadOnly || $Page->BRAND_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BRAND_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->BRAND_ID->getErrorMessage() ?></div>
<?= $Page->BRAND_ID->getCustomMessage() ?>
<?= $Page->BRAND_ID->Lookup->getParamTag($Page, "p_x_BRAND_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_OBAT" data-field="x_BRAND_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->BRAND_ID->displayValueSeparatorAttribute() ?>" name="x_BRAND_ID" id="x_BRAND_ID" value="<?= $Page->BRAND_ID->CurrentValue ?>"<?= $Page->BRAND_ID->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ID->Visible) { // ID ?>
    <div id="r_ID" class="form-group row">
        <label id="elh_TREATMENT_OBAT_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ID->caption() ?><?= $Page->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ID->cellAttributes() ?>>
<span id="el_TREATMENT_OBAT_ID">
<span<?= $Page->ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ID->getDisplayValue($Page->ID->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="TREATMENT_OBAT" data-field="x_ID" data-hidden="1" name="x_ID" id="x_ID" value="<?= HtmlEncode($Page->ID->CurrentValue) ?>">
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
    ew.addEventHandlers("TREATMENT_OBAT");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
