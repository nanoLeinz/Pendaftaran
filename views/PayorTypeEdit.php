<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$PayorTypeEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fPAYOR_TYPEedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fPAYOR_TYPEedit = currentForm = new ew.Form("fPAYOR_TYPEedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "PAYOR_TYPE")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.PAYOR_TYPE)
        ew.vars.tables.PAYOR_TYPE = currentTable;
    fPAYOR_TYPEedit.addFields([
        ["PAYOR_TYPE", [fields.PAYOR_TYPE.visible && fields.PAYOR_TYPE.required ? ew.Validators.required(fields.PAYOR_TYPE.caption) : null, ew.Validators.integer], fields.PAYOR_TYPE.isInvalid],
        ["PAYERTYPE", [fields.PAYERTYPE.visible && fields.PAYERTYPE.required ? ew.Validators.required(fields.PAYERTYPE.caption) : null], fields.PAYERTYPE.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fPAYOR_TYPEedit,
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
    fPAYOR_TYPEedit.validate = function () {
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
    fPAYOR_TYPEedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fPAYOR_TYPEedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fPAYOR_TYPEedit");
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
<form name="fPAYOR_TYPEedit" id="fPAYOR_TYPEedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="PAYOR_TYPE">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->PAYOR_TYPE->Visible) { // PAYOR_TYPE ?>
    <div id="r_PAYOR_TYPE" class="form-group row">
        <label id="elh_PAYOR_TYPE_PAYOR_TYPE" for="x_PAYOR_TYPE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYOR_TYPE->caption() ?><?= $Page->PAYOR_TYPE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYOR_TYPE->cellAttributes() ?>>
<input type="<?= $Page->PAYOR_TYPE->getInputTextType() ?>" data-table="PAYOR_TYPE" data-field="x_PAYOR_TYPE" name="x_PAYOR_TYPE" id="x_PAYOR_TYPE" size="30" placeholder="<?= HtmlEncode($Page->PAYOR_TYPE->getPlaceHolder()) ?>" value="<?= $Page->PAYOR_TYPE->EditValue ?>"<?= $Page->PAYOR_TYPE->editAttributes() ?> aria-describedby="x_PAYOR_TYPE_help">
<?= $Page->PAYOR_TYPE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAYOR_TYPE->getErrorMessage() ?></div>
<input type="hidden" data-table="PAYOR_TYPE" data-field="x_PAYOR_TYPE" data-hidden="1" name="o_PAYOR_TYPE" id="o_PAYOR_TYPE" value="<?= HtmlEncode($Page->PAYOR_TYPE->OldValue ?? $Page->PAYOR_TYPE->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PAYERTYPE->Visible) { // PAYERTYPE ?>
    <div id="r_PAYERTYPE" class="form-group row">
        <label id="elh_PAYOR_TYPE_PAYERTYPE" for="x_PAYERTYPE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PAYERTYPE->caption() ?><?= $Page->PAYERTYPE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PAYERTYPE->cellAttributes() ?>>
<span id="el_PAYOR_TYPE_PAYERTYPE">
<input type="<?= $Page->PAYERTYPE->getInputTextType() ?>" data-table="PAYOR_TYPE" data-field="x_PAYERTYPE" name="x_PAYERTYPE" id="x_PAYERTYPE" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->PAYERTYPE->getPlaceHolder()) ?>" value="<?= $Page->PAYERTYPE->EditValue ?>"<?= $Page->PAYERTYPE->editAttributes() ?> aria-describedby="x_PAYERTYPE_help">
<?= $Page->PAYERTYPE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PAYERTYPE->getErrorMessage() ?></div>
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
    ew.addEventHandlers("PAYOR_TYPE");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
