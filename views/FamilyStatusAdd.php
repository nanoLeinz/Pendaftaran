<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$FamilyStatusAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fFAMILY_STATUSadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fFAMILY_STATUSadd = currentForm = new ew.Form("fFAMILY_STATUSadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "FAMILY_STATUS")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.FAMILY_STATUS)
        ew.vars.tables.FAMILY_STATUS = currentTable;
    fFAMILY_STATUSadd.addFields([
        ["FAMILY_STATUS_ID", [fields.FAMILY_STATUS_ID.visible && fields.FAMILY_STATUS_ID.required ? ew.Validators.required(fields.FAMILY_STATUS_ID.caption) : null, ew.Validators.integer], fields.FAMILY_STATUS_ID.isInvalid],
        ["FAMILY_STATUS", [fields.FAMILY_STATUS.visible && fields.FAMILY_STATUS.required ? ew.Validators.required(fields.FAMILY_STATUS.caption) : null], fields.FAMILY_STATUS.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fFAMILY_STATUSadd,
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
    fFAMILY_STATUSadd.validate = function () {
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
    fFAMILY_STATUSadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fFAMILY_STATUSadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fFAMILY_STATUSadd");
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
<form name="fFAMILY_STATUSadd" id="fFAMILY_STATUSadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="FAMILY_STATUS">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->FAMILY_STATUS_ID->Visible) { // FAMILY_STATUS_ID ?>
    <div id="r_FAMILY_STATUS_ID" class="form-group row">
        <label id="elh_FAMILY_STATUS_FAMILY_STATUS_ID" for="x_FAMILY_STATUS_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FAMILY_STATUS_ID->caption() ?><?= $Page->FAMILY_STATUS_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FAMILY_STATUS_ID->cellAttributes() ?>>
<span id="el_FAMILY_STATUS_FAMILY_STATUS_ID">
<input type="<?= $Page->FAMILY_STATUS_ID->getInputTextType() ?>" data-table="FAMILY_STATUS" data-field="x_FAMILY_STATUS_ID" name="x_FAMILY_STATUS_ID" id="x_FAMILY_STATUS_ID" size="30" placeholder="<?= HtmlEncode($Page->FAMILY_STATUS_ID->getPlaceHolder()) ?>" value="<?= $Page->FAMILY_STATUS_ID->EditValue ?>"<?= $Page->FAMILY_STATUS_ID->editAttributes() ?> aria-describedby="x_FAMILY_STATUS_ID_help">
<?= $Page->FAMILY_STATUS_ID->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FAMILY_STATUS_ID->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FAMILY_STATUS->Visible) { // FAMILY_STATUS ?>
    <div id="r_FAMILY_STATUS" class="form-group row">
        <label id="elh_FAMILY_STATUS_FAMILY_STATUS" for="x_FAMILY_STATUS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FAMILY_STATUS->caption() ?><?= $Page->FAMILY_STATUS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->FAMILY_STATUS->cellAttributes() ?>>
<span id="el_FAMILY_STATUS_FAMILY_STATUS">
<input type="<?= $Page->FAMILY_STATUS->getInputTextType() ?>" data-table="FAMILY_STATUS" data-field="x_FAMILY_STATUS" name="x_FAMILY_STATUS" id="x_FAMILY_STATUS" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->FAMILY_STATUS->getPlaceHolder()) ?>" value="<?= $Page->FAMILY_STATUS->EditValue ?>"<?= $Page->FAMILY_STATUS->editAttributes() ?> aria-describedby="x_FAMILY_STATUS_help">
<?= $Page->FAMILY_STATUS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FAMILY_STATUS->getErrorMessage() ?></div>
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
    ew.addEventHandlers("FAMILY_STATUS");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
