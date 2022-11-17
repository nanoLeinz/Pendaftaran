<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$EmployeeJabatanEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fEMPLOYEE_JABATANedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fEMPLOYEE_JABATANedit = currentForm = new ew.Form("fEMPLOYEE_JABATANedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "EMPLOYEE_JABATAN")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.EMPLOYEE_JABATAN)
        ew.vars.tables.EMPLOYEE_JABATAN = currentTable;
    fEMPLOYEE_JABATANedit.addFields([
        ["KODE_JABATAN", [fields.KODE_JABATAN.visible && fields.KODE_JABATAN.required ? ew.Validators.required(fields.KODE_JABATAN.caption) : null], fields.KODE_JABATAN.isInvalid],
        ["JABATAN", [fields.JABATAN.visible && fields.JABATAN.required ? ew.Validators.required(fields.JABATAN.caption) : null], fields.JABATAN.isInvalid],
        ["ESELON", [fields.ESELON.visible && fields.ESELON.required ? ew.Validators.required(fields.ESELON.caption) : null], fields.ESELON.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fEMPLOYEE_JABATANedit,
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
    fEMPLOYEE_JABATANedit.validate = function () {
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
    fEMPLOYEE_JABATANedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fEMPLOYEE_JABATANedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fEMPLOYEE_JABATANedit");
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
<form name="fEMPLOYEE_JABATANedit" id="fEMPLOYEE_JABATANedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="EMPLOYEE_JABATAN">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->KODE_JABATAN->Visible) { // KODE_JABATAN ?>
    <div id="r_KODE_JABATAN" class="form-group row">
        <label id="elh_EMPLOYEE_JABATAN_KODE_JABATAN" for="x_KODE_JABATAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KODE_JABATAN->caption() ?><?= $Page->KODE_JABATAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KODE_JABATAN->cellAttributes() ?>>
<input type="<?= $Page->KODE_JABATAN->getInputTextType() ?>" data-table="EMPLOYEE_JABATAN" data-field="x_KODE_JABATAN" name="x_KODE_JABATAN" id="x_KODE_JABATAN" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->KODE_JABATAN->getPlaceHolder()) ?>" value="<?= $Page->KODE_JABATAN->EditValue ?>"<?= $Page->KODE_JABATAN->editAttributes() ?> aria-describedby="x_KODE_JABATAN_help">
<?= $Page->KODE_JABATAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KODE_JABATAN->getErrorMessage() ?></div>
<input type="hidden" data-table="EMPLOYEE_JABATAN" data-field="x_KODE_JABATAN" data-hidden="1" name="o_KODE_JABATAN" id="o_KODE_JABATAN" value="<?= HtmlEncode($Page->KODE_JABATAN->OldValue ?? $Page->KODE_JABATAN->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JABATAN->Visible) { // JABATAN ?>
    <div id="r_JABATAN" class="form-group row">
        <label id="elh_EMPLOYEE_JABATAN_JABATAN" for="x_JABATAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JABATAN->caption() ?><?= $Page->JABATAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->JABATAN->cellAttributes() ?>>
<span id="el_EMPLOYEE_JABATAN_JABATAN">
<input type="<?= $Page->JABATAN->getInputTextType() ?>" data-table="EMPLOYEE_JABATAN" data-field="x_JABATAN" name="x_JABATAN" id="x_JABATAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->JABATAN->getPlaceHolder()) ?>" value="<?= $Page->JABATAN->EditValue ?>"<?= $Page->JABATAN->editAttributes() ?> aria-describedby="x_JABATAN_help">
<?= $Page->JABATAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JABATAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ESELON->Visible) { // ESELON ?>
    <div id="r_ESELON" class="form-group row">
        <label id="elh_EMPLOYEE_JABATAN_ESELON" for="x_ESELON" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ESELON->caption() ?><?= $Page->ESELON->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ESELON->cellAttributes() ?>>
<span id="el_EMPLOYEE_JABATAN_ESELON">
<input type="<?= $Page->ESELON->getInputTextType() ?>" data-table="EMPLOYEE_JABATAN" data-field="x_ESELON" name="x_ESELON" id="x_ESELON" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->ESELON->getPlaceHolder()) ?>" value="<?= $Page->ESELON->EditValue ?>"<?= $Page->ESELON->editAttributes() ?> aria-describedby="x_ESELON_help">
<?= $Page->ESELON->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ESELON->getErrorMessage() ?></div>
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
    ew.addEventHandlers("EMPLOYEE_JABATAN");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
