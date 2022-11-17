<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MutationDocsAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fMUTATION_DOCSadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fMUTATION_DOCSadd = currentForm = new ew.Form("fMUTATION_DOCSadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "MUTATION_DOCS")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.MUTATION_DOCS)
        ew.vars.tables.MUTATION_DOCS = currentTable;
    fMUTATION_DOCSadd.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["ORG_ID", [fields.ORG_ID.visible && fields.ORG_ID.required ? ew.Validators.required(fields.ORG_ID.caption) : null], fields.ORG_ID.isInvalid],
        ["CLINIC_ID", [fields.CLINIC_ID.visible && fields.CLINIC_ID.required ? ew.Validators.required(fields.CLINIC_ID.caption) : null], fields.CLINIC_ID.isInvalid],
        ["CLINIC_ID_TO", [fields.CLINIC_ID_TO.visible && fields.CLINIC_ID_TO.required ? ew.Validators.required(fields.CLINIC_ID_TO.caption) : null], fields.CLINIC_ID_TO.isInvalid],
        ["MUTATION_DATE", [fields.MUTATION_DATE.visible && fields.MUTATION_DATE.required ? ew.Validators.required(fields.MUTATION_DATE.caption) : null, ew.Validators.datetime(11)], fields.MUTATION_DATE.isInvalid],
        ["MUTATION_VALUE", [fields.MUTATION_VALUE.visible && fields.MUTATION_VALUE.required ? ew.Validators.required(fields.MUTATION_VALUE.caption) : null, ew.Validators.float], fields.MUTATION_VALUE.isInvalid],
        ["ORDER_VALUE", [fields.ORDER_VALUE.visible && fields.ORDER_VALUE.required ? ew.Validators.required(fields.ORDER_VALUE.caption) : null, ew.Validators.float], fields.ORDER_VALUE.isInvalid],
        ["RECEIVED_BY", [fields.RECEIVED_BY.visible && fields.RECEIVED_BY.required ? ew.Validators.required(fields.RECEIVED_BY.caption) : null], fields.RECEIVED_BY.isInvalid],
        ["DISTRIBUTION_TYPE", [fields.DISTRIBUTION_TYPE.visible && fields.DISTRIBUTION_TYPE.required ? ew.Validators.required(fields.DISTRIBUTION_TYPE.caption) : null], fields.DISTRIBUTION_TYPE.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fMUTATION_DOCSadd,
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
    fMUTATION_DOCSadd.validate = function () {
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
    fMUTATION_DOCSadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fMUTATION_DOCSadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fMUTATION_DOCSadd.lists.CLINIC_ID = <?= $Page->CLINIC_ID->toClientList($Page) ?>;
    fMUTATION_DOCSadd.lists.CLINIC_ID_TO = <?= $Page->CLINIC_ID_TO->toClientList($Page) ?>;
    fMUTATION_DOCSadd.lists.DISTRIBUTION_TYPE = <?= $Page->DISTRIBUTION_TYPE->toClientList($Page) ?>;
    loadjs.done("fMUTATION_DOCSadd");
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
<form name="fMUTATION_DOCSadd" id="fMUTATION_DOCSadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="MUTATION_DOCS">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->ORG_ID->Visible) { // ORG_ID ?>
    <div id="r_ORG_ID" class="form-group row">
        <label id="elh_MUTATION_DOCS_ORG_ID" for="x_ORG_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ORG_ID->caption() ?><?= $Page->ORG_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ORG_ID->cellAttributes() ?>>
<span id="el_MUTATION_DOCS_ORG_ID">
<input type="<?= $Page->ORG_ID->getInputTextType() ?>" data-table="MUTATION_DOCS" data-field="x_ORG_ID" data-page="1" name="x_ORG_ID" id="x_ORG_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ORG_ID->getPlaceHolder()) ?>" value="<?= $Page->ORG_ID->EditValue ?>"<?= $Page->ORG_ID->editAttributes() ?> aria-describedby="x_ORG_ID_help">
<?= $Page->ORG_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ORG_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <div id="r_CLINIC_ID" class="form-group row">
        <label id="elh_MUTATION_DOCS_CLINIC_ID" for="x_CLINIC_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLINIC_ID->caption() ?><?= $Page->CLINIC_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_MUTATION_DOCS_CLINIC_ID">
    <select
        id="x_CLINIC_ID"
        name="x_CLINIC_ID"
        class="form-control ew-select<?= $Page->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="MUTATION_DOCS_x_CLINIC_ID"
        data-table="MUTATION_DOCS"
        data-field="x_CLINIC_ID"
        data-page="1"
        data-value-separator="<?= $Page->CLINIC_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLINIC_ID->getPlaceHolder()) ?>"
        <?= $Page->CLINIC_ID->editAttributes() ?>>
        <?= $Page->CLINIC_ID->selectOptionListHtml("x_CLINIC_ID") ?>
    </select>
    <?= $Page->CLINIC_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->CLINIC_ID->getErrorMessage() ?></div>
<?= $Page->CLINIC_ID->Lookup->getParamTag($Page, "p_x_CLINIC_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='MUTATION_DOCS_x_CLINIC_ID']"),
        options = { name: "x_CLINIC_ID", selectId: "MUTATION_DOCS_x_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.MUTATION_DOCS.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLINIC_ID_TO->Visible) { // CLINIC_ID_TO ?>
    <div id="r_CLINIC_ID_TO" class="form-group row">
        <label id="elh_MUTATION_DOCS_CLINIC_ID_TO" for="x_CLINIC_ID_TO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLINIC_ID_TO->caption() ?><?= $Page->CLINIC_ID_TO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID_TO->cellAttributes() ?>>
<span id="el_MUTATION_DOCS_CLINIC_ID_TO">
    <select
        id="x_CLINIC_ID_TO"
        name="x_CLINIC_ID_TO"
        class="form-control ew-select<?= $Page->CLINIC_ID_TO->isInvalidClass() ?>"
        data-select2-id="MUTATION_DOCS_x_CLINIC_ID_TO"
        data-table="MUTATION_DOCS"
        data-field="x_CLINIC_ID_TO"
        data-page="1"
        data-value-separator="<?= $Page->CLINIC_ID_TO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLINIC_ID_TO->getPlaceHolder()) ?>"
        <?= $Page->CLINIC_ID_TO->editAttributes() ?>>
        <?= $Page->CLINIC_ID_TO->selectOptionListHtml("x_CLINIC_ID_TO") ?>
    </select>
    <?= $Page->CLINIC_ID_TO->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->CLINIC_ID_TO->getErrorMessage() ?></div>
<?= $Page->CLINIC_ID_TO->Lookup->getParamTag($Page, "p_x_CLINIC_ID_TO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='MUTATION_DOCS_x_CLINIC_ID_TO']"),
        options = { name: "x_CLINIC_ID_TO", selectId: "MUTATION_DOCS_x_CLINIC_ID_TO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.MUTATION_DOCS.fields.CLINIC_ID_TO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MUTATION_DATE->Visible) { // MUTATION_DATE ?>
    <div id="r_MUTATION_DATE" class="form-group row">
        <label id="elh_MUTATION_DOCS_MUTATION_DATE" for="x_MUTATION_DATE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MUTATION_DATE->caption() ?><?= $Page->MUTATION_DATE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MUTATION_DATE->cellAttributes() ?>>
<span id="el_MUTATION_DOCS_MUTATION_DATE">
<input type="<?= $Page->MUTATION_DATE->getInputTextType() ?>" data-table="MUTATION_DOCS" data-field="x_MUTATION_DATE" data-page="1" data-format="11" name="x_MUTATION_DATE" id="x_MUTATION_DATE" placeholder="<?= HtmlEncode($Page->MUTATION_DATE->getPlaceHolder()) ?>" value="<?= $Page->MUTATION_DATE->EditValue ?>"<?= $Page->MUTATION_DATE->editAttributes() ?> aria-describedby="x_MUTATION_DATE_help">
<?= $Page->MUTATION_DATE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MUTATION_DATE->getErrorMessage() ?></div>
<?php if (!$Page->MUTATION_DATE->ReadOnly && !$Page->MUTATION_DATE->Disabled && !isset($Page->MUTATION_DATE->EditAttrs["readonly"]) && !isset($Page->MUTATION_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fMUTATION_DOCSadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fMUTATION_DOCSadd", "x_MUTATION_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MUTATION_VALUE->Visible) { // MUTATION_VALUE ?>
    <div id="r_MUTATION_VALUE" class="form-group row">
        <label id="elh_MUTATION_DOCS_MUTATION_VALUE" for="x_MUTATION_VALUE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MUTATION_VALUE->caption() ?><?= $Page->MUTATION_VALUE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MUTATION_VALUE->cellAttributes() ?>>
<span id="el_MUTATION_DOCS_MUTATION_VALUE">
<input type="<?= $Page->MUTATION_VALUE->getInputTextType() ?>" data-table="MUTATION_DOCS" data-field="x_MUTATION_VALUE" data-page="1" name="x_MUTATION_VALUE" id="x_MUTATION_VALUE" size="30" placeholder="<?= HtmlEncode($Page->MUTATION_VALUE->getPlaceHolder()) ?>" value="<?= $Page->MUTATION_VALUE->EditValue ?>"<?= $Page->MUTATION_VALUE->editAttributes() ?> aria-describedby="x_MUTATION_VALUE_help">
<?= $Page->MUTATION_VALUE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MUTATION_VALUE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ORDER_VALUE->Visible) { // ORDER_VALUE ?>
    <div id="r_ORDER_VALUE" class="form-group row">
        <label id="elh_MUTATION_DOCS_ORDER_VALUE" for="x_ORDER_VALUE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ORDER_VALUE->caption() ?><?= $Page->ORDER_VALUE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ORDER_VALUE->cellAttributes() ?>>
<span id="el_MUTATION_DOCS_ORDER_VALUE">
<input type="<?= $Page->ORDER_VALUE->getInputTextType() ?>" data-table="MUTATION_DOCS" data-field="x_ORDER_VALUE" data-page="1" name="x_ORDER_VALUE" id="x_ORDER_VALUE" size="30" placeholder="<?= HtmlEncode($Page->ORDER_VALUE->getPlaceHolder()) ?>" value="<?= $Page->ORDER_VALUE->EditValue ?>"<?= $Page->ORDER_VALUE->editAttributes() ?> aria-describedby="x_ORDER_VALUE_help">
<?= $Page->ORDER_VALUE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ORDER_VALUE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->RECEIVED_BY->Visible) { // RECEIVED_BY ?>
    <div id="r_RECEIVED_BY" class="form-group row">
        <label id="elh_MUTATION_DOCS_RECEIVED_BY" for="x_RECEIVED_BY" class="<?= $Page->LeftColumnClass ?>"><?= $Page->RECEIVED_BY->caption() ?><?= $Page->RECEIVED_BY->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->RECEIVED_BY->cellAttributes() ?>>
<span id="el_MUTATION_DOCS_RECEIVED_BY">
<input type="<?= $Page->RECEIVED_BY->getInputTextType() ?>" data-table="MUTATION_DOCS" data-field="x_RECEIVED_BY" data-page="1" name="x_RECEIVED_BY" id="x_RECEIVED_BY" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->RECEIVED_BY->getPlaceHolder()) ?>" value="<?= $Page->RECEIVED_BY->EditValue ?>"<?= $Page->RECEIVED_BY->editAttributes() ?> aria-describedby="x_RECEIVED_BY_help">
<?= $Page->RECEIVED_BY->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->RECEIVED_BY->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DISTRIBUTION_TYPE->Visible) { // DISTRIBUTION_TYPE ?>
    <div id="r_DISTRIBUTION_TYPE" class="form-group row">
        <label id="elh_MUTATION_DOCS_DISTRIBUTION_TYPE" for="x_DISTRIBUTION_TYPE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DISTRIBUTION_TYPE->caption() ?><?= $Page->DISTRIBUTION_TYPE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DISTRIBUTION_TYPE->cellAttributes() ?>>
<span id="el_MUTATION_DOCS_DISTRIBUTION_TYPE">
    <select
        id="x_DISTRIBUTION_TYPE"
        name="x_DISTRIBUTION_TYPE"
        class="form-control ew-select<?= $Page->DISTRIBUTION_TYPE->isInvalidClass() ?>"
        data-select2-id="MUTATION_DOCS_x_DISTRIBUTION_TYPE"
        data-table="MUTATION_DOCS"
        data-field="x_DISTRIBUTION_TYPE"
        data-page="1"
        data-value-separator="<?= $Page->DISTRIBUTION_TYPE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DISTRIBUTION_TYPE->getPlaceHolder()) ?>"
        <?= $Page->DISTRIBUTION_TYPE->editAttributes() ?>>
        <?= $Page->DISTRIBUTION_TYPE->selectOptionListHtml("x_DISTRIBUTION_TYPE") ?>
    </select>
    <?= $Page->DISTRIBUTION_TYPE->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DISTRIBUTION_TYPE->getErrorMessage() ?></div>
<?= $Page->DISTRIBUTION_TYPE->Lookup->getParamTag($Page, "p_x_DISTRIBUTION_TYPE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='MUTATION_DOCS_x_DISTRIBUTION_TYPE']"),
        options = { name: "x_DISTRIBUTION_TYPE", selectId: "MUTATION_DOCS_x_DISTRIBUTION_TYPE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.MUTATION_DOCS.fields.DISTRIBUTION_TYPE.selectOptions);
    ew.createSelect(options);
});
</script>
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
    ew.addEventHandlers("MUTATION_DOCS");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
