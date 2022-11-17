<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PasienAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPASIENadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fPASIENadd = currentForm = new ew.Form("fPASIENadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PASIEN")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PASIEN)
        ew.vars.tables.PASIEN = currentTable;
    fPASIENadd.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["NAME_OF_PASIEN", [fields.NAME_OF_PASIEN.visible && fields.NAME_OF_PASIEN.required ? ew.Validators.required(fields.NAME_OF_PASIEN.caption) : null], fields.NAME_OF_PASIEN.isInvalid],
        ["PASIEN_ID", [fields.PASIEN_ID.visible && fields.PASIEN_ID.required ? ew.Validators.required(fields.PASIEN_ID.caption) : null], fields.PASIEN_ID.isInvalid],
        ["KK_NO", [fields.KK_NO.visible && fields.KK_NO.required ? ew.Validators.required(fields.KK_NO.caption) : null], fields.KK_NO.isInvalid],
        ["STATUS_PASIEN_ID", [fields.STATUS_PASIEN_ID.visible && fields.STATUS_PASIEN_ID.required ? ew.Validators.required(fields.STATUS_PASIEN_ID.caption) : null], fields.STATUS_PASIEN_ID.isInvalid],
        ["REGISTRATION_DATE", [fields.REGISTRATION_DATE.visible && fields.REGISTRATION_DATE.required ? ew.Validators.required(fields.REGISTRATION_DATE.caption) : null, ew.Validators.datetime(11)], fields.REGISTRATION_DATE.isInvalid],
        ["newapp", [fields.newapp.visible && fields.newapp.required ? ew.Validators.required(fields.newapp.caption) : null], fields.newapp.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fPASIENadd,
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
    fPASIENadd.validate = function () {
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
    fPASIENadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPASIENadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fPASIENadd.lists.STATUS_PASIEN_ID = <?= $Page->STATUS_PASIEN_ID->toClientList($Page) ?>;
    loadjs.done("fPASIENadd");
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
<form name="fPASIENadd" id="fPASIENadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PASIEN">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NAME_OF_PASIEN->Visible) { // NAME_OF_PASIEN ?>
    <div id="r_NAME_OF_PASIEN" class="form-group row">
        <label id="elh_PASIEN_NAME_OF_PASIEN" for="x_NAME_OF_PASIEN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAME_OF_PASIEN->caption() ?><?= $Page->NAME_OF_PASIEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAME_OF_PASIEN->cellAttributes() ?>>
<span id="el_PASIEN_NAME_OF_PASIEN">
<input type="<?= $Page->NAME_OF_PASIEN->getInputTextType() ?>" data-table="PASIEN" data-field="x_NAME_OF_PASIEN" name="x_NAME_OF_PASIEN" id="x_NAME_OF_PASIEN" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAME_OF_PASIEN->getPlaceHolder()) ?>" value="<?= $Page->NAME_OF_PASIEN->EditValue ?>"<?= $Page->NAME_OF_PASIEN->editAttributes() ?> aria-describedby="x_NAME_OF_PASIEN_help">
<?= $Page->NAME_OF_PASIEN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAME_OF_PASIEN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PASIEN_ID->Visible) { // PASIEN_ID ?>
    <div id="r_PASIEN_ID" class="form-group row">
        <label id="elh_PASIEN_PASIEN_ID" for="x_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PASIEN_ID->caption() ?><?= $Page->PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PASIEN_ID->cellAttributes() ?>>
<span id="el_PASIEN_PASIEN_ID">
<input type="<?= $Page->PASIEN_ID->getInputTextType() ?>" data-table="PASIEN" data-field="x_PASIEN_ID" name="x_PASIEN_ID" id="x_PASIEN_ID" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->PASIEN_ID->getPlaceHolder()) ?>" value="<?= $Page->PASIEN_ID->EditValue ?>"<?= $Page->PASIEN_ID->editAttributes() ?> aria-describedby="x_PASIEN_ID_help">
<?= $Page->PASIEN_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PASIEN_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KK_NO->Visible) { // KK_NO ?>
    <div id="r_KK_NO" class="form-group row">
        <label id="elh_PASIEN_KK_NO" for="x_KK_NO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KK_NO->caption() ?><?= $Page->KK_NO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KK_NO->cellAttributes() ?>>
<span id="el_PASIEN_KK_NO">
<input type="<?= $Page->KK_NO->getInputTextType() ?>" data-table="PASIEN" data-field="x_KK_NO" name="x_KK_NO" id="x_KK_NO" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->KK_NO->getPlaceHolder()) ?>" value="<?= $Page->KK_NO->EditValue ?>"<?= $Page->KK_NO->editAttributes() ?> aria-describedby="x_KK_NO_help">
<?= $Page->KK_NO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KK_NO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->STATUS_PASIEN_ID->Visible) { // STATUS_PASIEN_ID ?>
    <div id="r_STATUS_PASIEN_ID" class="form-group row">
        <label id="elh_PASIEN_STATUS_PASIEN_ID" for="x_STATUS_PASIEN_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_PASIEN_ID->caption() ?><?= $Page->STATUS_PASIEN_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_PASIEN_ID->cellAttributes() ?>>
<span id="el_PASIEN_STATUS_PASIEN_ID">
    <select
        id="x_STATUS_PASIEN_ID"
        name="x_STATUS_PASIEN_ID"
        class="form-control ew-select<?= $Page->STATUS_PASIEN_ID->isInvalidClass() ?>"
        data-select2-id="PASIEN_x_STATUS_PASIEN_ID"
        data-table="PASIEN"
        data-field="x_STATUS_PASIEN_ID"
        data-value-separator="<?= $Page->STATUS_PASIEN_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->STATUS_PASIEN_ID->getPlaceHolder()) ?>"
        <?= $Page->STATUS_PASIEN_ID->editAttributes() ?>>
        <?= $Page->STATUS_PASIEN_ID->selectOptionListHtml("x_STATUS_PASIEN_ID") ?>
    </select>
    <?= $Page->STATUS_PASIEN_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->STATUS_PASIEN_ID->getErrorMessage() ?></div>
<?= $Page->STATUS_PASIEN_ID->Lookup->getParamTag($Page, "p_x_STATUS_PASIEN_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='PASIEN_x_STATUS_PASIEN_ID']"),
        options = { name: "x_STATUS_PASIEN_ID", selectId: "PASIEN_x_STATUS_PASIEN_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.PASIEN.fields.STATUS_PASIEN_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->REGISTRATION_DATE->Visible) { // REGISTRATION_DATE ?>
    <div id="r_REGISTRATION_DATE" class="form-group row">
        <label id="elh_PASIEN_REGISTRATION_DATE" for="x_REGISTRATION_DATE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->REGISTRATION_DATE->caption() ?><?= $Page->REGISTRATION_DATE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->REGISTRATION_DATE->cellAttributes() ?>>
<span id="el_PASIEN_REGISTRATION_DATE">
<input type="<?= $Page->REGISTRATION_DATE->getInputTextType() ?>" data-table="PASIEN" data-field="x_REGISTRATION_DATE" data-format="11" name="x_REGISTRATION_DATE" id="x_REGISTRATION_DATE" placeholder="<?= HtmlEncode($Page->REGISTRATION_DATE->getPlaceHolder()) ?>" value="<?= $Page->REGISTRATION_DATE->EditValue ?>"<?= $Page->REGISTRATION_DATE->editAttributes() ?> aria-describedby="x_REGISTRATION_DATE_help">
<?= $Page->REGISTRATION_DATE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->REGISTRATION_DATE->getErrorMessage() ?></div>
<?php if (!$Page->REGISTRATION_DATE->ReadOnly && !$Page->REGISTRATION_DATE->Disabled && !isset($Page->REGISTRATION_DATE->EditAttrs["readonly"]) && !isset($Page->REGISTRATION_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPASIENadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fPASIENadd", "x_REGISTRATION_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":11});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
    <span id="el_PASIEN_newapp">
    <input type="hidden" data-table="PASIEN" data-field="x_newapp" data-hidden="1" name="x_newapp" id="x_newapp" value="<?= HtmlEncode($Page->newapp->CurrentValue) ?>">
    </span>
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
    ew.addEventHandlers("PASIEN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
