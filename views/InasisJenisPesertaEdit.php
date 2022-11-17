<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$InasisJenisPesertaEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fINASIS_JENIS_PESERTAedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fINASIS_JENIS_PESERTAedit = currentForm = new ew.Form("fINASIS_JENIS_PESERTAedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "INASIS_JENIS_PESERTA")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.INASIS_JENIS_PESERTA)
        ew.vars.tables.INASIS_JENIS_PESERTA = currentTable;
    fINASIS_JENIS_PESERTAedit.addFields([
        ["KDJNSPESERTA", [fields.KDJNSPESERTA.visible && fields.KDJNSPESERTA.required ? ew.Validators.required(fields.KDJNSPESERTA.caption) : null, ew.Validators.integer], fields.KDJNSPESERTA.isInvalid],
        ["NMJNSPESERTA", [fields.NMJNSPESERTA.visible && fields.NMJNSPESERTA.required ? ew.Validators.required(fields.NMJNSPESERTA.caption) : null], fields.NMJNSPESERTA.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fINASIS_JENIS_PESERTAedit,
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
    fINASIS_JENIS_PESERTAedit.validate = function () {
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
    fINASIS_JENIS_PESERTAedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fINASIS_JENIS_PESERTAedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fINASIS_JENIS_PESERTAedit");
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
<form name="fINASIS_JENIS_PESERTAedit" id="fINASIS_JENIS_PESERTAedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="INASIS_JENIS_PESERTA">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->KDJNSPESERTA->Visible) { // KDJNSPESERTA ?>
    <div id="r_KDJNSPESERTA" class="form-group row">
        <label id="elh_INASIS_JENIS_PESERTA_KDJNSPESERTA" for="x_KDJNSPESERTA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KDJNSPESERTA->caption() ?><?= $Page->KDJNSPESERTA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KDJNSPESERTA->cellAttributes() ?>>
<input type="<?= $Page->KDJNSPESERTA->getInputTextType() ?>" data-table="INASIS_JENIS_PESERTA" data-field="x_KDJNSPESERTA" name="x_KDJNSPESERTA" id="x_KDJNSPESERTA" size="30" placeholder="<?= HtmlEncode($Page->KDJNSPESERTA->getPlaceHolder()) ?>" value="<?= $Page->KDJNSPESERTA->EditValue ?>"<?= $Page->KDJNSPESERTA->editAttributes() ?> aria-describedby="x_KDJNSPESERTA_help">
<?= $Page->KDJNSPESERTA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KDJNSPESERTA->getErrorMessage() ?></div>
<input type="hidden" data-table="INASIS_JENIS_PESERTA" data-field="x_KDJNSPESERTA" data-hidden="1" name="o_KDJNSPESERTA" id="o_KDJNSPESERTA" value="<?= HtmlEncode($Page->KDJNSPESERTA->OldValue ?? $Page->KDJNSPESERTA->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NMJNSPESERTA->Visible) { // NMJNSPESERTA ?>
    <div id="r_NMJNSPESERTA" class="form-group row">
        <label id="elh_INASIS_JENIS_PESERTA_NMJNSPESERTA" for="x_NMJNSPESERTA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NMJNSPESERTA->caption() ?><?= $Page->NMJNSPESERTA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NMJNSPESERTA->cellAttributes() ?>>
<span id="el_INASIS_JENIS_PESERTA_NMJNSPESERTA">
<input type="<?= $Page->NMJNSPESERTA->getInputTextType() ?>" data-table="INASIS_JENIS_PESERTA" data-field="x_NMJNSPESERTA" name="x_NMJNSPESERTA" id="x_NMJNSPESERTA" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->NMJNSPESERTA->getPlaceHolder()) ?>" value="<?= $Page->NMJNSPESERTA->EditValue ?>"<?= $Page->NMJNSPESERTA->editAttributes() ?> aria-describedby="x_NMJNSPESERTA_help">
<?= $Page->NMJNSPESERTA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NMJNSPESERTA->getErrorMessage() ?></div>
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
    ew.addEventHandlers("INASIS_JENIS_PESERTA");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
