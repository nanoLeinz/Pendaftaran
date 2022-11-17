<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatTarifAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fTREAT_TARIFadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fTREAT_TARIFadd = currentForm = new ew.Form("fTREAT_TARIFadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "TREAT_TARIF")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.TREAT_TARIF)
        ew.vars.tables.TREAT_TARIF = currentTable;
    fTREAT_TARIFadd.addFields([
        ["KODE", [fields.KODE.visible && fields.KODE.required ? ew.Validators.required(fields.KODE.caption) : null], fields.KODE.isInvalid],
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["TARIF_ID", [fields.TARIF_ID.visible && fields.TARIF_ID.required ? ew.Validators.required(fields.TARIF_ID.caption) : null], fields.TARIF_ID.isInvalid],
        ["PERDA_ID", [fields.PERDA_ID.visible && fields.PERDA_ID.required ? ew.Validators.required(fields.PERDA_ID.caption) : null], fields.PERDA_ID.isInvalid],
        ["TREAT_ID", [fields.TREAT_ID.visible && fields.TREAT_ID.required ? ew.Validators.required(fields.TREAT_ID.caption) : null], fields.TREAT_ID.isInvalid],
        ["DISPLAY_TARIF", [fields.DISPLAY_TARIF.visible && fields.DISPLAY_TARIF.required ? ew.Validators.required(fields.DISPLAY_TARIF.caption) : null], fields.DISPLAY_TARIF.isInvalid],
        ["TARIF_NAME", [fields.TARIF_NAME.visible && fields.TARIF_NAME.required ? ew.Validators.required(fields.TARIF_NAME.caption) : null], fields.TARIF_NAME.isInvalid],
        ["CLASS_ID", [fields.CLASS_ID.visible && fields.CLASS_ID.required ? ew.Validators.required(fields.CLASS_ID.caption) : null], fields.CLASS_ID.isInvalid],
        ["LEVEL_ID", [fields.LEVEL_ID.visible && fields.LEVEL_ID.required ? ew.Validators.required(fields.LEVEL_ID.caption) : null, ew.Validators.integer], fields.LEVEL_ID.isInvalid],
        ["OTHER_ID", [fields.OTHER_ID.visible && fields.OTHER_ID.required ? ew.Validators.required(fields.OTHER_ID.caption) : null], fields.OTHER_ID.isInvalid],
        ["TARIF_TYPE", [fields.TARIF_TYPE.visible && fields.TARIF_TYPE.required ? ew.Validators.required(fields.TARIF_TYPE.caption) : null], fields.TARIF_TYPE.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid],
        ["IMPLEMENTED", [fields.IMPLEMENTED.visible && fields.IMPLEMENTED.required ? ew.Validators.required(fields.IMPLEMENTED.caption) : null], fields.IMPLEMENTED.isInvalid],
        ["ACTIVITY_ID", [fields.ACTIVITY_ID.visible && fields.ACTIVITY_ID.required ? ew.Validators.required(fields.ACTIVITY_ID.caption) : null], fields.ACTIVITY_ID.isInvalid],
        ["AMOUNT_PAID", [fields.AMOUNT_PAID.visible && fields.AMOUNT_PAID.required ? ew.Validators.required(fields.AMOUNT_PAID.caption) : null, ew.Validators.float], fields.AMOUNT_PAID.isInvalid],
        ["MODIFIED_BY", [fields.MODIFIED_BY.visible && fields.MODIFIED_BY.required ? ew.Validators.required(fields.MODIFIED_BY.caption) : null], fields.MODIFIED_BY.isInvalid],
        ["CASEMIX_ID", [fields.CASEMIX_ID.visible && fields.CASEMIX_ID.required ? ew.Validators.required(fields.CASEMIX_ID.caption) : null, ew.Validators.integer], fields.CASEMIX_ID.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fTREAT_TARIFadd,
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
    fTREAT_TARIFadd.validate = function () {
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
    fTREAT_TARIFadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fTREAT_TARIFadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fTREAT_TARIFadd.lists.PERDA_ID = <?= $Page->PERDA_ID->toClientList($Page) ?>;
    fTREAT_TARIFadd.lists.CLASS_ID = <?= $Page->CLASS_ID->toClientList($Page) ?>;
    fTREAT_TARIFadd.lists.TARIF_TYPE = <?= $Page->TARIF_TYPE->toClientList($Page) ?>;
    fTREAT_TARIFadd.lists.IMPLEMENTED = <?= $Page->IMPLEMENTED->toClientList($Page) ?>;
    fTREAT_TARIFadd.lists.ACTIVITY_ID = <?= $Page->ACTIVITY_ID->toClientList($Page) ?>;
    loadjs.done("fTREAT_TARIFadd");
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
<form name="fTREAT_TARIFadd" id="fTREAT_TARIFadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREAT_TARIF">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->KODE->Visible) { // KODE ?>
    <div id="r_KODE" class="form-group row">
        <label id="elh_TREAT_TARIF_KODE" for="x_KODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KODE->caption() ?><?= $Page->KODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KODE->cellAttributes() ?>>
<span id="el_TREAT_TARIF_KODE">
<input type="<?= $Page->KODE->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_KODE" name="x_KODE" id="x_KODE" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->KODE->getPlaceHolder()) ?>" value="<?= $Page->KODE->EditValue ?>"<?= $Page->KODE->editAttributes() ?> aria-describedby="x_KODE_help">
<?= $Page->KODE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KODE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TARIF_ID->Visible) { // TARIF_ID ?>
    <div id="r_TARIF_ID" class="form-group row">
        <label id="elh_TREAT_TARIF_TARIF_ID" for="x_TARIF_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TARIF_ID->caption() ?><?= $Page->TARIF_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TARIF_ID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_TARIF_ID">
<input type="<?= $Page->TARIF_ID->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_TARIF_ID" name="x_TARIF_ID" id="x_TARIF_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->TARIF_ID->getPlaceHolder()) ?>" value="<?= $Page->TARIF_ID->EditValue ?>"<?= $Page->TARIF_ID->editAttributes() ?> aria-describedby="x_TARIF_ID_help">
<?= $Page->TARIF_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TARIF_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PERDA_ID->Visible) { // PERDA_ID ?>
    <div id="r_PERDA_ID" class="form-group row">
        <label id="elh_TREAT_TARIF_PERDA_ID" for="x_PERDA_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PERDA_ID->caption() ?><?= $Page->PERDA_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PERDA_ID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_PERDA_ID">
    <select
        id="x_PERDA_ID"
        name="x_PERDA_ID"
        class="form-control ew-select<?= $Page->PERDA_ID->isInvalidClass() ?>"
        data-select2-id="TREAT_TARIF_x_PERDA_ID"
        data-table="TREAT_TARIF"
        data-field="x_PERDA_ID"
        data-value-separator="<?= $Page->PERDA_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PERDA_ID->getPlaceHolder()) ?>"
        <?= $Page->PERDA_ID->editAttributes() ?>>
        <?= $Page->PERDA_ID->selectOptionListHtml("x_PERDA_ID") ?>
    </select>
    <?= $Page->PERDA_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PERDA_ID->getErrorMessage() ?></div>
<?= $Page->PERDA_ID->Lookup->getParamTag($Page, "p_x_PERDA_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREAT_TARIF_x_PERDA_ID']"),
        options = { name: "x_PERDA_ID", selectId: "TREAT_TARIF_x_PERDA_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREAT_TARIF.fields.PERDA_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TREAT_ID->Visible) { // TREAT_ID ?>
    <div id="r_TREAT_ID" class="form-group row">
        <label id="elh_TREAT_TARIF_TREAT_ID" for="x_TREAT_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TREAT_ID->caption() ?><?= $Page->TREAT_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TREAT_ID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_TREAT_ID">
<input type="<?= $Page->TREAT_ID->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_TREAT_ID" name="x_TREAT_ID" id="x_TREAT_ID" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->TREAT_ID->getPlaceHolder()) ?>" value="<?= $Page->TREAT_ID->EditValue ?>"<?= $Page->TREAT_ID->editAttributes() ?> aria-describedby="x_TREAT_ID_help">
<?= $Page->TREAT_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TREAT_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DISPLAY_TARIF->Visible) { // DISPLAY_TARIF ?>
    <div id="r_DISPLAY_TARIF" class="form-group row">
        <label id="elh_TREAT_TARIF_DISPLAY_TARIF" for="x_DISPLAY_TARIF" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DISPLAY_TARIF->caption() ?><?= $Page->DISPLAY_TARIF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DISPLAY_TARIF->cellAttributes() ?>>
<span id="el_TREAT_TARIF_DISPLAY_TARIF">
<input type="<?= $Page->DISPLAY_TARIF->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_DISPLAY_TARIF" name="x_DISPLAY_TARIF" id="x_DISPLAY_TARIF" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DISPLAY_TARIF->getPlaceHolder()) ?>" value="<?= $Page->DISPLAY_TARIF->EditValue ?>"<?= $Page->DISPLAY_TARIF->editAttributes() ?> aria-describedby="x_DISPLAY_TARIF_help">
<?= $Page->DISPLAY_TARIF->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DISPLAY_TARIF->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TARIF_NAME->Visible) { // TARIF_NAME ?>
    <div id="r_TARIF_NAME" class="form-group row">
        <label id="elh_TREAT_TARIF_TARIF_NAME" for="x_TARIF_NAME" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TARIF_NAME->caption() ?><?= $Page->TARIF_NAME->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TARIF_NAME->cellAttributes() ?>>
<span id="el_TREAT_TARIF_TARIF_NAME">
<input type="<?= $Page->TARIF_NAME->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_TARIF_NAME" name="x_TARIF_NAME" id="x_TARIF_NAME" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->TARIF_NAME->getPlaceHolder()) ?>" value="<?= $Page->TARIF_NAME->EditValue ?>"<?= $Page->TARIF_NAME->editAttributes() ?> aria-describedby="x_TARIF_NAME_help">
<?= $Page->TARIF_NAME->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TARIF_NAME->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ID->Visible) { // CLASS_ID ?>
    <div id="r_CLASS_ID" class="form-group row">
        <label id="elh_TREAT_TARIF_CLASS_ID" for="x_CLASS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLASS_ID->caption() ?><?= $Page->CLASS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_CLASS_ID">
    <select
        id="x_CLASS_ID"
        name="x_CLASS_ID"
        class="form-control ew-select<?= $Page->CLASS_ID->isInvalidClass() ?>"
        data-select2-id="TREAT_TARIF_x_CLASS_ID"
        data-table="TREAT_TARIF"
        data-field="x_CLASS_ID"
        data-value-separator="<?= $Page->CLASS_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLASS_ID->getPlaceHolder()) ?>"
        <?= $Page->CLASS_ID->editAttributes() ?>>
        <?= $Page->CLASS_ID->selectOptionListHtml("x_CLASS_ID") ?>
    </select>
    <?= $Page->CLASS_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->CLASS_ID->getErrorMessage() ?></div>
<?= $Page->CLASS_ID->Lookup->getParamTag($Page, "p_x_CLASS_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREAT_TARIF_x_CLASS_ID']"),
        options = { name: "x_CLASS_ID", selectId: "TREAT_TARIF_x_CLASS_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREAT_TARIF.fields.CLASS_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LEVEL_ID->Visible) { // LEVEL_ID ?>
    <div id="r_LEVEL_ID" class="form-group row">
        <label id="elh_TREAT_TARIF_LEVEL_ID" for="x_LEVEL_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LEVEL_ID->caption() ?><?= $Page->LEVEL_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LEVEL_ID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_LEVEL_ID">
<input type="<?= $Page->LEVEL_ID->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_LEVEL_ID" name="x_LEVEL_ID" id="x_LEVEL_ID" size="30" placeholder="<?= HtmlEncode($Page->LEVEL_ID->getPlaceHolder()) ?>" value="<?= $Page->LEVEL_ID->EditValue ?>"<?= $Page->LEVEL_ID->editAttributes() ?> aria-describedby="x_LEVEL_ID_help">
<?= $Page->LEVEL_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->LEVEL_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->OTHER_ID->Visible) { // OTHER_ID ?>
    <div id="r_OTHER_ID" class="form-group row">
        <label id="elh_TREAT_TARIF_OTHER_ID" for="x_OTHER_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->OTHER_ID->caption() ?><?= $Page->OTHER_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->OTHER_ID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_OTHER_ID">
<input type="<?= $Page->OTHER_ID->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_OTHER_ID" name="x_OTHER_ID" id="x_OTHER_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->OTHER_ID->getPlaceHolder()) ?>" value="<?= $Page->OTHER_ID->EditValue ?>"<?= $Page->OTHER_ID->editAttributes() ?> aria-describedby="x_OTHER_ID_help">
<?= $Page->OTHER_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->OTHER_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TARIF_TYPE->Visible) { // TARIF_TYPE ?>
    <div id="r_TARIF_TYPE" class="form-group row">
        <label id="elh_TREAT_TARIF_TARIF_TYPE" for="x_TARIF_TYPE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TARIF_TYPE->caption() ?><?= $Page->TARIF_TYPE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TARIF_TYPE->cellAttributes() ?>>
<span id="el_TREAT_TARIF_TARIF_TYPE">
    <select
        id="x_TARIF_TYPE"
        name="x_TARIF_TYPE"
        class="form-control ew-select<?= $Page->TARIF_TYPE->isInvalidClass() ?>"
        data-select2-id="TREAT_TARIF_x_TARIF_TYPE"
        data-table="TREAT_TARIF"
        data-field="x_TARIF_TYPE"
        data-value-separator="<?= $Page->TARIF_TYPE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->TARIF_TYPE->getPlaceHolder()) ?>"
        <?= $Page->TARIF_TYPE->editAttributes() ?>>
        <?= $Page->TARIF_TYPE->selectOptionListHtml("x_TARIF_TYPE") ?>
    </select>
    <?= $Page->TARIF_TYPE->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->TARIF_TYPE->getErrorMessage() ?></div>
<?= $Page->TARIF_TYPE->Lookup->getParamTag($Page, "p_x_TARIF_TYPE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREAT_TARIF_x_TARIF_TYPE']"),
        options = { name: "x_TARIF_TYPE", selectId: "TREAT_TARIF_x_TARIF_TYPE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREAT_TARIF.fields.TARIF_TYPE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <div id="r_DESCRIPTION" class="form-group row">
        <label id="elh_TREAT_TARIF_DESCRIPTION" for="x_DESCRIPTION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DESCRIPTION->caption() ?><?= $Page->DESCRIPTION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_TREAT_TARIF_DESCRIPTION">
<input type="<?= $Page->DESCRIPTION->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_DESCRIPTION" name="x_DESCRIPTION" id="x_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Page->DESCRIPTION->EditValue ?>"<?= $Page->DESCRIPTION->editAttributes() ?> aria-describedby="x_DESCRIPTION_help">
<?= $Page->DESCRIPTION->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DESCRIPTION->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->IMPLEMENTED->Visible) { // IMPLEMENTED ?>
    <div id="r_IMPLEMENTED" class="form-group row">
        <label id="elh_TREAT_TARIF_IMPLEMENTED" for="x_IMPLEMENTED" class="<?= $Page->LeftColumnClass ?>"><?= $Page->IMPLEMENTED->caption() ?><?= $Page->IMPLEMENTED->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->IMPLEMENTED->cellAttributes() ?>>
<span id="el_TREAT_TARIF_IMPLEMENTED">
    <select
        id="x_IMPLEMENTED"
        name="x_IMPLEMENTED"
        class="form-control ew-select<?= $Page->IMPLEMENTED->isInvalidClass() ?>"
        data-select2-id="TREAT_TARIF_x_IMPLEMENTED"
        data-table="TREAT_TARIF"
        data-field="x_IMPLEMENTED"
        data-value-separator="<?= $Page->IMPLEMENTED->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->IMPLEMENTED->getPlaceHolder()) ?>"
        <?= $Page->IMPLEMENTED->editAttributes() ?>>
        <?= $Page->IMPLEMENTED->selectOptionListHtml("x_IMPLEMENTED") ?>
    </select>
    <?= $Page->IMPLEMENTED->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->IMPLEMENTED->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREAT_TARIF_x_IMPLEMENTED']"),
        options = { name: "x_IMPLEMENTED", selectId: "TREAT_TARIF_x_IMPLEMENTED", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.TREAT_TARIF.fields.IMPLEMENTED.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREAT_TARIF.fields.IMPLEMENTED.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ACTIVITY_ID->Visible) { // ACTIVITY_ID ?>
    <div id="r_ACTIVITY_ID" class="form-group row">
        <label id="elh_TREAT_TARIF_ACTIVITY_ID" for="x_ACTIVITY_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ACTIVITY_ID->caption() ?><?= $Page->ACTIVITY_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ACTIVITY_ID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_ACTIVITY_ID">
    <select
        id="x_ACTIVITY_ID"
        name="x_ACTIVITY_ID"
        class="form-control ew-select<?= $Page->ACTIVITY_ID->isInvalidClass() ?>"
        data-select2-id="TREAT_TARIF_x_ACTIVITY_ID"
        data-table="TREAT_TARIF"
        data-field="x_ACTIVITY_ID"
        data-value-separator="<?= $Page->ACTIVITY_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ACTIVITY_ID->getPlaceHolder()) ?>"
        <?= $Page->ACTIVITY_ID->editAttributes() ?>>
        <?= $Page->ACTIVITY_ID->selectOptionListHtml("x_ACTIVITY_ID") ?>
    </select>
    <?= $Page->ACTIVITY_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ACTIVITY_ID->getErrorMessage() ?></div>
<?= $Page->ACTIVITY_ID->Lookup->getParamTag($Page, "p_x_ACTIVITY_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREAT_TARIF_x_ACTIVITY_ID']"),
        options = { name: "x_ACTIVITY_ID", selectId: "TREAT_TARIF_x_ACTIVITY_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREAT_TARIF.fields.ACTIVITY_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->AMOUNT_PAID->Visible) { // AMOUNT_PAID ?>
    <div id="r_AMOUNT_PAID" class="form-group row">
        <label id="elh_TREAT_TARIF_AMOUNT_PAID" for="x_AMOUNT_PAID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->AMOUNT_PAID->caption() ?><?= $Page->AMOUNT_PAID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->AMOUNT_PAID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_AMOUNT_PAID">
<input type="<?= $Page->AMOUNT_PAID->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_AMOUNT_PAID" name="x_AMOUNT_PAID" id="x_AMOUNT_PAID" size="30" placeholder="<?= HtmlEncode($Page->AMOUNT_PAID->getPlaceHolder()) ?>" value="<?= $Page->AMOUNT_PAID->EditValue ?>"<?= $Page->AMOUNT_PAID->editAttributes() ?> aria-describedby="x_AMOUNT_PAID_help">
<?= $Page->AMOUNT_PAID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->AMOUNT_PAID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
    <div id="r_MODIFIED_BY" class="form-group row">
        <label id="elh_TREAT_TARIF_MODIFIED_BY" for="x_MODIFIED_BY" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODIFIED_BY->caption() ?><?= $Page->MODIFIED_BY->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_BY->cellAttributes() ?>>
<span id="el_TREAT_TARIF_MODIFIED_BY">
<input type="<?= $Page->MODIFIED_BY->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_MODIFIED_BY" name="x_MODIFIED_BY" id="x_MODIFIED_BY" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MODIFIED_BY->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_BY->EditValue ?>"<?= $Page->MODIFIED_BY->editAttributes() ?> aria-describedby="x_MODIFIED_BY_help">
<?= $Page->MODIFIED_BY->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MODIFIED_BY->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CASEMIX_ID->Visible) { // CASEMIX_ID ?>
    <div id="r_CASEMIX_ID" class="form-group row">
        <label id="elh_TREAT_TARIF_CASEMIX_ID" for="x_CASEMIX_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CASEMIX_ID->caption() ?><?= $Page->CASEMIX_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CASEMIX_ID->cellAttributes() ?>>
<span id="el_TREAT_TARIF_CASEMIX_ID">
<input type="<?= $Page->CASEMIX_ID->getInputTextType() ?>" data-table="TREAT_TARIF" data-field="x_CASEMIX_ID" name="x_CASEMIX_ID" id="x_CASEMIX_ID" size="30" placeholder="<?= HtmlEncode($Page->CASEMIX_ID->getPlaceHolder()) ?>" value="<?= $Page->CASEMIX_ID->EditValue ?>"<?= $Page->CASEMIX_ID->editAttributes() ?> aria-describedby="x_CASEMIX_ID_help">
<?= $Page->CASEMIX_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CASEMIX_ID->getErrorMessage() ?></div>
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
    ew.addEventHandlers("TREAT_TARIF");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
