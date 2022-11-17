<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PayorInfoAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPAYOR_INFOadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fPAYOR_INFOadd = currentForm = new ew.Form("fPAYOR_INFOadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PAYOR_INFO")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PAYOR_INFO)
        ew.vars.tables.PAYOR_INFO = currentTable;
    fPAYOR_INFOadd.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["PAYOR_ID", [fields.PAYOR_ID.visible && fields.PAYOR_ID.required ? ew.Validators.required(fields.PAYOR_ID.caption) : null], fields.PAYOR_ID.isInvalid],
        ["PAYOR_TYPE", [fields.PAYOR_TYPE.visible && fields.PAYOR_TYPE.required ? ew.Validators.required(fields.PAYOR_TYPE.caption) : null, ew.Validators.integer], fields.PAYOR_TYPE.isInvalid],
        ["PAYOR", [fields.PAYOR.visible && fields.PAYOR.required ? ew.Validators.required(fields.PAYOR.caption) : null], fields.PAYOR.isInvalid],
        ["ADDRESS", [fields.ADDRESS.visible && fields.ADDRESS.required ? ew.Validators.required(fields.ADDRESS.caption) : null], fields.ADDRESS.isInvalid],
        ["CITY", [fields.CITY.visible && fields.CITY.required ? ew.Validators.required(fields.CITY.caption) : null], fields.CITY.isInvalid],
        ["PHONE", [fields.PHONE.visible && fields.PHONE.required ? ew.Validators.required(fields.PHONE.caption) : null], fields.PHONE.isInvalid],
        ["FAX", [fields.FAX.visible && fields.FAX.required ? ew.Validators.required(fields.FAX.caption) : null], fields.FAX.isInvalid],
        ["KDVKLAIM", [fields.KDVKLAIM.visible && fields.KDVKLAIM.required ? ew.Validators.required(fields.KDVKLAIM.caption) : null], fields.KDVKLAIM.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fPAYOR_INFOadd,
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
    fPAYOR_INFOadd.validate = function () {
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
    fPAYOR_INFOadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPAYOR_INFOadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fPAYOR_INFOadd");
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
<form name="fPAYOR_INFOadd" id="fPAYOR_INFOadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYOR_INFO">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->ORG_UNIT_CODE->Visible) { // ORG_UNIT_CODE ?>
    <div id="r_ORG_UNIT_CODE" class="form-group row">
        <label id="elh_PAYOR_INFO_ORG_UNIT_CODE" for="x_ORG_UNIT_CODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ORG_UNIT_CODE->caption() ?><?= $Page->ORG_UNIT_CODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ORG_UNIT_CODE->cellAttributes() ?>>
<span id="el_PAYOR_INFO_ORG_UNIT_CODE">
<input type="<?= $Page->ORG_UNIT_CODE->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_ORG_UNIT_CODE" name="x_ORG_UNIT_CODE" id="x_ORG_UNIT_CODE" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->ORG_UNIT_CODE->getPlaceHolder()) ?>" value="<?= $Page->ORG_UNIT_CODE->EditValue ?>"<?= $Page->ORG_UNIT_CODE->editAttributes() ?> aria-describedby="x_ORG_UNIT_CODE_help">
<?= $Page->ORG_UNIT_CODE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ORG_UNIT_CODE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYOR_ID->Visible) { // PAYOR_ID ?>
    <div id="r_PAYOR_ID" class="form-group row">
        <label id="elh_PAYOR_INFO_PAYOR_ID" for="x_PAYOR_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYOR_ID->caption() ?><?= $Page->PAYOR_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYOR_ID->cellAttributes() ?>>
<span id="el_PAYOR_INFO_PAYOR_ID">
<input type="<?= $Page->PAYOR_ID->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_PAYOR_ID" name="x_PAYOR_ID" id="x_PAYOR_ID" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PAYOR_ID->getPlaceHolder()) ?>" value="<?= $Page->PAYOR_ID->EditValue ?>"<?= $Page->PAYOR_ID->editAttributes() ?> aria-describedby="x_PAYOR_ID_help">
<?= $Page->PAYOR_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAYOR_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
    <div id="r_PAYOR_TYPE" class="form-group row">
        <label id="elh_PAYOR_INFO_PAYOR_TYPE" for="x_PAYOR_TYPE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYOR_TYPE->caption() ?><?= $Page->PAYOR_TYPE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYOR_TYPE->cellAttributes() ?>>
<span id="el_PAYOR_INFO_PAYOR_TYPE">
<input type="<?= $Page->PAYOR_TYPE->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_PAYOR_TYPE" name="x_PAYOR_TYPE" id="x_PAYOR_TYPE" size="30" placeholder="<?= HtmlEncode($Page->PAYOR_TYPE->getPlaceHolder()) ?>" value="<?= $Page->PAYOR_TYPE->EditValue ?>"<?= $Page->PAYOR_TYPE->editAttributes() ?> aria-describedby="x_PAYOR_TYPE_help">
<?= $Page->PAYOR_TYPE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAYOR_TYPE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYOR->Visible) { // PAYOR ?>
    <div id="r_PAYOR" class="form-group row">
        <label id="elh_PAYOR_INFO_PAYOR" for="x_PAYOR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYOR->caption() ?><?= $Page->PAYOR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYOR->cellAttributes() ?>>
<span id="el_PAYOR_INFO_PAYOR">
<input type="<?= $Page->PAYOR->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_PAYOR" name="x_PAYOR" id="x_PAYOR" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->PAYOR->getPlaceHolder()) ?>" value="<?= $Page->PAYOR->EditValue ?>"<?= $Page->PAYOR->editAttributes() ?> aria-describedby="x_PAYOR_help">
<?= $Page->PAYOR->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAYOR->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ADDRESS->Visible) { // ADDRESS ?>
    <div id="r_ADDRESS" class="form-group row">
        <label id="elh_PAYOR_INFO_ADDRESS" for="x_ADDRESS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ADDRESS->caption() ?><?= $Page->ADDRESS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ADDRESS->cellAttributes() ?>>
<span id="el_PAYOR_INFO_ADDRESS">
<input type="<?= $Page->ADDRESS->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_ADDRESS" name="x_ADDRESS" id="x_ADDRESS" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->ADDRESS->getPlaceHolder()) ?>" value="<?= $Page->ADDRESS->EditValue ?>"<?= $Page->ADDRESS->editAttributes() ?> aria-describedby="x_ADDRESS_help">
<?= $Page->ADDRESS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ADDRESS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CITY->Visible) { // CITY ?>
    <div id="r_CITY" class="form-group row">
        <label id="elh_PAYOR_INFO_CITY" for="x_CITY" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CITY->caption() ?><?= $Page->CITY->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CITY->cellAttributes() ?>>
<span id="el_PAYOR_INFO_CITY">
<input type="<?= $Page->CITY->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_CITY" name="x_CITY" id="x_CITY" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->CITY->getPlaceHolder()) ?>" value="<?= $Page->CITY->EditValue ?>"<?= $Page->CITY->editAttributes() ?> aria-describedby="x_CITY_help">
<?= $Page->CITY->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->CITY->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PHONE->Visible) { // PHONE ?>
    <div id="r_PHONE" class="form-group row">
        <label id="elh_PAYOR_INFO_PHONE" for="x_PHONE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PHONE->caption() ?><?= $Page->PHONE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PHONE->cellAttributes() ?>>
<span id="el_PAYOR_INFO_PHONE">
<input type="<?= $Page->PHONE->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_PHONE" name="x_PHONE" id="x_PHONE" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->PHONE->getPlaceHolder()) ?>" value="<?= $Page->PHONE->EditValue ?>"<?= $Page->PHONE->editAttributes() ?> aria-describedby="x_PHONE_help">
<?= $Page->PHONE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PHONE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FAX->Visible) { // FAX ?>
    <div id="r_FAX" class="form-group row">
        <label id="elh_PAYOR_INFO_FAX" for="x_FAX" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FAX->caption() ?><?= $Page->FAX->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FAX->cellAttributes() ?>>
<span id="el_PAYOR_INFO_FAX">
<input type="<?= $Page->FAX->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_FAX" name="x_FAX" id="x_FAX" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->FAX->getPlaceHolder()) ?>" value="<?= $Page->FAX->EditValue ?>"<?= $Page->FAX->editAttributes() ?> aria-describedby="x_FAX_help">
<?= $Page->FAX->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FAX->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KDVKLAIM->Visible) { // KDVKLAIM ?>
    <div id="r_KDVKLAIM" class="form-group row">
        <label id="elh_PAYOR_INFO_KDVKLAIM" for="x_KDVKLAIM" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KDVKLAIM->caption() ?><?= $Page->KDVKLAIM->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDVKLAIM->cellAttributes() ?>>
<span id="el_PAYOR_INFO_KDVKLAIM">
<input type="<?= $Page->KDVKLAIM->getInputTextType() ?>" data-table="PAYOR_INFO" data-field="x_KDVKLAIM" name="x_KDVKLAIM" id="x_KDVKLAIM" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->KDVKLAIM->getPlaceHolder()) ?>" value="<?= $Page->KDVKLAIM->EditValue ?>"<?= $Page->KDVKLAIM->editAttributes() ?> aria-describedby="x_KDVKLAIM_help">
<?= $Page->KDVKLAIM->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KDVKLAIM->getErrorMessage() ?></div>
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
    ew.addEventHandlers("PAYOR_INFO");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
