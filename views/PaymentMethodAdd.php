<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PaymentMethodAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPAYMENT_METHODadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fPAYMENT_METHODadd = currentForm = new ew.Form("fPAYMENT_METHODadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PAYMENT_METHOD")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PAYMENT_METHOD)
        ew.vars.tables.PAYMENT_METHOD = currentTable;
    fPAYMENT_METHODadd.addFields([
        ["PAY_METHOD_ID", [fields.PAY_METHOD_ID.visible && fields.PAY_METHOD_ID.required ? ew.Validators.required(fields.PAY_METHOD_ID.caption) : null, ew.Validators.integer], fields.PAY_METHOD_ID.isInvalid],
        ["PAYMETHOD", [fields.PAYMETHOD.visible && fields.PAYMETHOD.required ? ew.Validators.required(fields.PAYMETHOD.caption) : null], fields.PAYMETHOD.isInvalid],
        ["display", [fields.display.visible && fields.display.required ? ew.Validators.required(fields.display.caption) : null], fields.display.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fPAYMENT_METHODadd,
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
    fPAYMENT_METHODadd.validate = function () {
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
    fPAYMENT_METHODadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPAYMENT_METHODadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fPAYMENT_METHODadd");
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
<form name="fPAYMENT_METHODadd" id="fPAYMENT_METHODadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYMENT_METHOD">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->PAY_METHOD_ID->Visible) { // PAY_METHOD_ID ?>
    <div id="r_PAY_METHOD_ID" class="form-group row">
        <label id="elh_PAYMENT_METHOD_PAY_METHOD_ID" for="x_PAY_METHOD_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAY_METHOD_ID->caption() ?><?= $Page->PAY_METHOD_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAY_METHOD_ID->cellAttributes() ?>>
<span id="el_PAYMENT_METHOD_PAY_METHOD_ID">
<input type="<?= $Page->PAY_METHOD_ID->getInputTextType() ?>" data-table="PAYMENT_METHOD" data-field="x_PAY_METHOD_ID" name="x_PAY_METHOD_ID" id="x_PAY_METHOD_ID" size="30" placeholder="<?= HtmlEncode($Page->PAY_METHOD_ID->getPlaceHolder()) ?>" value="<?= $Page->PAY_METHOD_ID->EditValue ?>"<?= $Page->PAY_METHOD_ID->editAttributes() ?> aria-describedby="x_PAY_METHOD_ID_help">
<?= $Page->PAY_METHOD_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAY_METHOD_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYMETHOD->Visible) { // PAYMETHOD ?>
    <div id="r_PAYMETHOD" class="form-group row">
        <label id="elh_PAYMENT_METHOD_PAYMETHOD" for="x_PAYMETHOD" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYMETHOD->caption() ?><?= $Page->PAYMETHOD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYMETHOD->cellAttributes() ?>>
<span id="el_PAYMENT_METHOD_PAYMETHOD">
<input type="<?= $Page->PAYMETHOD->getInputTextType() ?>" data-table="PAYMENT_METHOD" data-field="x_PAYMETHOD" name="x_PAYMETHOD" id="x_PAYMETHOD" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->PAYMETHOD->getPlaceHolder()) ?>" value="<?= $Page->PAYMETHOD->EditValue ?>"<?= $Page->PAYMETHOD->editAttributes() ?> aria-describedby="x_PAYMETHOD_help">
<?= $Page->PAYMETHOD->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAYMETHOD->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->display->Visible) { // display ?>
    <div id="r_display" class="form-group row">
        <label id="elh_PAYMENT_METHOD_display" for="x_display" class="<?= $Page->LeftColumnClass ?>"><?= $Page->display->caption() ?><?= $Page->display->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->display->cellAttributes() ?>>
<span id="el_PAYMENT_METHOD_display">
<input type="<?= $Page->display->getInputTextType() ?>" data-table="PAYMENT_METHOD" data-field="x_display" name="x_display" id="x_display" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->display->getPlaceHolder()) ?>" value="<?= $Page->display->EditValue ?>"<?= $Page->display->editAttributes() ?> aria-describedby="x_display_help">
<?= $Page->display->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->display->getErrorMessage() ?></div>
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
    ew.addEventHandlers("PAYMENT_METHOD");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
