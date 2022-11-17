<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$UserLoginEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fUSER_LOGINedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fUSER_LOGINedit = currentForm = new ew.Form("fUSER_LOGINedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "USER_LOGIN")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.USER_LOGIN)
        ew.vars.tables.USER_LOGIN = currentTable;
    fUSER_LOGINedit.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["EMPLOYEE_ID", [fields.EMPLOYEE_ID.visible && fields.EMPLOYEE_ID.required ? ew.Validators.required(fields.EMPLOYEE_ID.caption) : null], fields.EMPLOYEE_ID.isInvalid],
        ["_USERNAME", [fields._USERNAME.visible && fields._USERNAME.required ? ew.Validators.required(fields._USERNAME.caption) : null], fields._USERNAME.isInvalid],
        ["FULLNAME", [fields.FULLNAME.visible && fields.FULLNAME.required ? ew.Validators.required(fields.FULLNAME.caption) : null], fields.FULLNAME.isInvalid],
        ["MODIFIED_DATE", [fields.MODIFIED_DATE.visible && fields.MODIFIED_DATE.required ? ew.Validators.required(fields.MODIFIED_DATE.caption) : null, ew.Validators.datetime(0)], fields.MODIFIED_DATE.isInvalid],
        ["MODIFIED_BY", [fields.MODIFIED_BY.visible && fields.MODIFIED_BY.required ? ew.Validators.required(fields.MODIFIED_BY.caption) : null], fields.MODIFIED_BY.isInvalid],
        ["MODIFIED_FROM", [fields.MODIFIED_FROM.visible && fields.MODIFIED_FROM.required ? ew.Validators.required(fields.MODIFIED_FROM.caption) : null], fields.MODIFIED_FROM.isInvalid],
        ["_PASSWORD", [fields._PASSWORD.visible && fields._PASSWORD.required ? ew.Validators.required(fields._PASSWORD.caption) : null], fields._PASSWORD.isInvalid],
        ["userlevelid", [fields.userlevelid.visible && fields.userlevelid.required ? ew.Validators.required(fields.userlevelid.caption) : null], fields.userlevelid.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fUSER_LOGINedit,
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
    fUSER_LOGINedit.validate = function () {
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
    fUSER_LOGINedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fUSER_LOGINedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fUSER_LOGINedit.lists.EMPLOYEE_ID = <?= $Page->EMPLOYEE_ID->toClientList($Page) ?>;
    fUSER_LOGINedit.lists.userlevelid = <?= $Page->userlevelid->toClientList($Page) ?>;
    loadjs.done("fUSER_LOGINedit");
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
<form name="fUSER_LOGINedit" id="fUSER_LOGINedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="USER_LOGIN">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <div id="r_EMPLOYEE_ID" class="form-group row">
        <label id="elh_USER_LOGIN_EMPLOYEE_ID" for="x_EMPLOYEE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EMPLOYEE_ID->caption() ?><?= $Page->EMPLOYEE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_USER_LOGIN_EMPLOYEE_ID">
    <select
        id="x_EMPLOYEE_ID"
        name="x_EMPLOYEE_ID"
        class="form-control ew-select<?= $Page->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="USER_LOGIN_x_EMPLOYEE_ID"
        data-table="USER_LOGIN"
        data-field="x_EMPLOYEE_ID"
        data-value-separator="<?= $Page->EMPLOYEE_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->EMPLOYEE_ID->getPlaceHolder()) ?>"
        <?= $Page->EMPLOYEE_ID->editAttributes() ?>>
        <?= $Page->EMPLOYEE_ID->selectOptionListHtml("x_EMPLOYEE_ID") ?>
    </select>
    <?= $Page->EMPLOYEE_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->EMPLOYEE_ID->getErrorMessage() ?></div>
<?= $Page->EMPLOYEE_ID->Lookup->getParamTag($Page, "p_x_EMPLOYEE_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='USER_LOGIN_x_EMPLOYEE_ID']"),
        options = { name: "x_EMPLOYEE_ID", selectId: "USER_LOGIN_x_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.USER_LOGIN.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_USERNAME->Visible) { // USERNAME ?>
    <div id="r__USERNAME" class="form-group row">
        <label id="elh_USER_LOGIN__USERNAME" for="x__USERNAME" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_USERNAME->caption() ?><?= $Page->_USERNAME->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_USERNAME->cellAttributes() ?>>
<input type="<?= $Page->_USERNAME->getInputTextType() ?>" data-table="USER_LOGIN" data-field="x__USERNAME" name="x__USERNAME" id="x__USERNAME" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->_USERNAME->getPlaceHolder()) ?>" value="<?= $Page->_USERNAME->EditValue ?>"<?= $Page->_USERNAME->editAttributes() ?> aria-describedby="x__USERNAME_help">
<?= $Page->_USERNAME->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_USERNAME->getErrorMessage() ?></div>
<input type="hidden" data-table="USER_LOGIN" data-field="x__USERNAME" data-hidden="1" name="o__USERNAME" id="o__USERNAME" value="<?= HtmlEncode($Page->_USERNAME->OldValue ?? $Page->_USERNAME->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FULLNAME->Visible) { // FULLNAME ?>
    <div id="r_FULLNAME" class="form-group row">
        <label id="elh_USER_LOGIN_FULLNAME" for="x_FULLNAME" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FULLNAME->caption() ?><?= $Page->FULLNAME->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FULLNAME->cellAttributes() ?>>
<span id="el_USER_LOGIN_FULLNAME">
<input type="<?= $Page->FULLNAME->getInputTextType() ?>" data-table="USER_LOGIN" data-field="x_FULLNAME" name="x_FULLNAME" id="x_FULLNAME" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->FULLNAME->getPlaceHolder()) ?>" value="<?= $Page->FULLNAME->EditValue ?>"<?= $Page->FULLNAME->editAttributes() ?> aria-describedby="x_FULLNAME_help">
<?= $Page->FULLNAME->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FULLNAME->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_DATE->Visible) { // MODIFIED_DATE ?>
    <div id="r_MODIFIED_DATE" class="form-group row">
        <label id="elh_USER_LOGIN_MODIFIED_DATE" for="x_MODIFIED_DATE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODIFIED_DATE->caption() ?><?= $Page->MODIFIED_DATE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_DATE->cellAttributes() ?>>
<span id="el_USER_LOGIN_MODIFIED_DATE">
<input type="<?= $Page->MODIFIED_DATE->getInputTextType() ?>" data-table="USER_LOGIN" data-field="x_MODIFIED_DATE" name="x_MODIFIED_DATE" id="x_MODIFIED_DATE" placeholder="<?= HtmlEncode($Page->MODIFIED_DATE->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_DATE->EditValue ?>"<?= $Page->MODIFIED_DATE->editAttributes() ?> aria-describedby="x_MODIFIED_DATE_help">
<?= $Page->MODIFIED_DATE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MODIFIED_DATE->getErrorMessage() ?></div>
<?php if (!$Page->MODIFIED_DATE->ReadOnly && !$Page->MODIFIED_DATE->Disabled && !isset($Page->MODIFIED_DATE->EditAttrs["readonly"]) && !isset($Page->MODIFIED_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fUSER_LOGINedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fUSER_LOGINedit", "x_MODIFIED_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_BY->Visible) { // MODIFIED_BY ?>
    <div id="r_MODIFIED_BY" class="form-group row">
        <label id="elh_USER_LOGIN_MODIFIED_BY" for="x_MODIFIED_BY" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODIFIED_BY->caption() ?><?= $Page->MODIFIED_BY->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_BY->cellAttributes() ?>>
<span id="el_USER_LOGIN_MODIFIED_BY">
<input type="<?= $Page->MODIFIED_BY->getInputTextType() ?>" data-table="USER_LOGIN" data-field="x_MODIFIED_BY" name="x_MODIFIED_BY" id="x_MODIFIED_BY" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MODIFIED_BY->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_BY->EditValue ?>"<?= $Page->MODIFIED_BY->editAttributes() ?> aria-describedby="x_MODIFIED_BY_help">
<?= $Page->MODIFIED_BY->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MODIFIED_BY->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MODIFIED_FROM->Visible) { // MODIFIED_FROM ?>
    <div id="r_MODIFIED_FROM" class="form-group row">
        <label id="elh_USER_LOGIN_MODIFIED_FROM" for="x_MODIFIED_FROM" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODIFIED_FROM->caption() ?><?= $Page->MODIFIED_FROM->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODIFIED_FROM->cellAttributes() ?>>
<span id="el_USER_LOGIN_MODIFIED_FROM">
<input type="<?= $Page->MODIFIED_FROM->getInputTextType() ?>" data-table="USER_LOGIN" data-field="x_MODIFIED_FROM" name="x_MODIFIED_FROM" id="x_MODIFIED_FROM" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MODIFIED_FROM->getPlaceHolder()) ?>" value="<?= $Page->MODIFIED_FROM->EditValue ?>"<?= $Page->MODIFIED_FROM->editAttributes() ?> aria-describedby="x_MODIFIED_FROM_help">
<?= $Page->MODIFIED_FROM->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MODIFIED_FROM->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_PASSWORD->Visible) { // PASSWORD ?>
    <div id="r__PASSWORD" class="form-group row">
        <label id="elh_USER_LOGIN__PASSWORD" for="x__PASSWORD" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_PASSWORD->caption() ?><?= $Page->_PASSWORD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_PASSWORD->cellAttributes() ?>>
<span id="el_USER_LOGIN__PASSWORD">
<input type="<?= $Page->_PASSWORD->getInputTextType() ?>" data-table="USER_LOGIN" data-field="x__PASSWORD" name="x__PASSWORD" id="x__PASSWORD" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->_PASSWORD->getPlaceHolder()) ?>" value="<?= $Page->_PASSWORD->EditValue ?>"<?= $Page->_PASSWORD->editAttributes() ?> aria-describedby="x__PASSWORD_help">
<?= $Page->_PASSWORD->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_PASSWORD->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->userlevelid->Visible) { // userlevelid ?>
    <div id="r_userlevelid" class="form-group row">
        <label id="elh_USER_LOGIN_userlevelid" for="x_userlevelid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->userlevelid->caption() ?><?= $Page->userlevelid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->userlevelid->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_USER_LOGIN_userlevelid">
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->userlevelid->getDisplayValue($Page->userlevelid->EditValue))) ?>">
</span>
<?php } else { ?>
<span id="el_USER_LOGIN_userlevelid">
    <select
        id="x_userlevelid"
        name="x_userlevelid"
        class="form-control ew-select<?= $Page->userlevelid->isInvalidClass() ?>"
        data-select2-id="USER_LOGIN_x_userlevelid"
        data-table="USER_LOGIN"
        data-field="x_userlevelid"
        data-value-separator="<?= $Page->userlevelid->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->userlevelid->getPlaceHolder()) ?>"
        <?= $Page->userlevelid->editAttributes() ?>>
        <?= $Page->userlevelid->selectOptionListHtml("x_userlevelid") ?>
    </select>
    <?= $Page->userlevelid->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->userlevelid->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='USER_LOGIN_x_userlevelid']"),
        options = { name: "x_userlevelid", selectId: "USER_LOGIN_x_userlevelid", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.USER_LOGIN.fields.userlevelid.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.USER_LOGIN.fields.userlevelid.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
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
    ew.addEventHandlers("USER_LOGIN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
