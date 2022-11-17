<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$InasisKelasrawatEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fINASIS_KELASRAWATedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fINASIS_KELASRAWATedit = currentForm = new ew.Form("fINASIS_KELASRAWATedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "INASIS_KELASRAWAT")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.INASIS_KELASRAWAT)
        ew.vars.tables.INASIS_KELASRAWAT = currentTable;
    fINASIS_KELASRAWATedit.addFields([
        ["KDKELAS", [fields.KDKELAS.visible && fields.KDKELAS.required ? ew.Validators.required(fields.KDKELAS.caption) : null], fields.KDKELAS.isInvalid],
        ["NMKELAS", [fields.NMKELAS.visible && fields.NMKELAS.required ? ew.Validators.required(fields.NMKELAS.caption) : null], fields.NMKELAS.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fINASIS_KELASRAWATedit,
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
    fINASIS_KELASRAWATedit.validate = function () {
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
    fINASIS_KELASRAWATedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fINASIS_KELASRAWATedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fINASIS_KELASRAWATedit");
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
<form name="fINASIS_KELASRAWATedit" id="fINASIS_KELASRAWATedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="INASIS_KELASRAWAT">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->KDKELAS->Visible) { // KDKELAS ?>
    <div id="r_KDKELAS" class="form-group row">
        <label id="elh_INASIS_KELASRAWAT_KDKELAS" for="x_KDKELAS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KDKELAS->caption() ?><?= $Page->KDKELAS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDKELAS->cellAttributes() ?>>
<input type="<?= $Page->KDKELAS->getInputTextType() ?>" data-table="INASIS_KELASRAWAT" data-field="x_KDKELAS" name="x_KDKELAS" id="x_KDKELAS" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->KDKELAS->getPlaceHolder()) ?>" value="<?= $Page->KDKELAS->EditValue ?>"<?= $Page->KDKELAS->editAttributes() ?> aria-describedby="x_KDKELAS_help">
<?= $Page->KDKELAS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KDKELAS->getErrorMessage() ?></div>
<input type="hidden" data-table="INASIS_KELASRAWAT" data-field="x_KDKELAS" data-hidden="1" name="o_KDKELAS" id="o_KDKELAS" value="<?= HtmlEncode($Page->KDKELAS->OldValue ?? $Page->KDKELAS->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NMKELAS->Visible) { // NMKELAS ?>
    <div id="r_NMKELAS" class="form-group row">
        <label id="elh_INASIS_KELASRAWAT_NMKELAS" for="x_NMKELAS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NMKELAS->caption() ?><?= $Page->NMKELAS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NMKELAS->cellAttributes() ?>>
<span id="el_INASIS_KELASRAWAT_NMKELAS">
<input type="<?= $Page->NMKELAS->getInputTextType() ?>" data-table="INASIS_KELASRAWAT" data-field="x_NMKELAS" name="x_NMKELAS" id="x_NMKELAS" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->NMKELAS->getPlaceHolder()) ?>" value="<?= $Page->NMKELAS->EditValue ?>"<?= $Page->NMKELAS->editAttributes() ?> aria-describedby="x_NMKELAS_help">
<?= $Page->NMKELAS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NMKELAS->getErrorMessage() ?></div>
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
    ew.addEventHandlers("INASIS_KELASRAWAT");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
