<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$InasisStatusPesertaAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fINASIS_STATUS_PESERTAadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fINASIS_STATUS_PESERTAadd = currentForm = new ew.Form("fINASIS_STATUS_PESERTAadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "INASIS_STATUS_PESERTA")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.INASIS_STATUS_PESERTA)
        ew.vars.tables.INASIS_STATUS_PESERTA = currentTable;
    fINASIS_STATUS_PESERTAadd.addFields([
        ["STATUS_PESERTA_KODE", [fields.STATUS_PESERTA_KODE.visible && fields.STATUS_PESERTA_KODE.required ? ew.Validators.required(fields.STATUS_PESERTA_KODE.caption) : null], fields.STATUS_PESERTA_KODE.isInvalid],
        ["STATUS_PESERTA", [fields.STATUS_PESERTA.visible && fields.STATUS_PESERTA.required ? ew.Validators.required(fields.STATUS_PESERTA.caption) : null], fields.STATUS_PESERTA.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fINASIS_STATUS_PESERTAadd,
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
    fINASIS_STATUS_PESERTAadd.validate = function () {
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
    fINASIS_STATUS_PESERTAadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fINASIS_STATUS_PESERTAadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fINASIS_STATUS_PESERTAadd");
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
<form name="fINASIS_STATUS_PESERTAadd" id="fINASIS_STATUS_PESERTAadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="INASIS_STATUS_PESERTA">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->STATUS_PESERTA_KODE->Visible) { // STATUS_PESERTA_KODE ?>
    <div id="r_STATUS_PESERTA_KODE" class="form-group row">
        <label id="elh_INASIS_STATUS_PESERTA_STATUS_PESERTA_KODE" for="x_STATUS_PESERTA_KODE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_PESERTA_KODE->caption() ?><?= $Page->STATUS_PESERTA_KODE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_PESERTA_KODE->cellAttributes() ?>>
<span id="el_INASIS_STATUS_PESERTA_STATUS_PESERTA_KODE">
<input type="<?= $Page->STATUS_PESERTA_KODE->getInputTextType() ?>" data-table="INASIS_STATUS_PESERTA" data-field="x_STATUS_PESERTA_KODE" name="x_STATUS_PESERTA_KODE" id="x_STATUS_PESERTA_KODE" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->STATUS_PESERTA_KODE->getPlaceHolder()) ?>" value="<?= $Page->STATUS_PESERTA_KODE->EditValue ?>"<?= $Page->STATUS_PESERTA_KODE->editAttributes() ?> aria-describedby="x_STATUS_PESERTA_KODE_help">
<?= $Page->STATUS_PESERTA_KODE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->STATUS_PESERTA_KODE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->STATUS_PESERTA->Visible) { // STATUS_PESERTA ?>
    <div id="r_STATUS_PESERTA" class="form-group row">
        <label id="elh_INASIS_STATUS_PESERTA_STATUS_PESERTA" for="x_STATUS_PESERTA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_PESERTA->caption() ?><?= $Page->STATUS_PESERTA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_PESERTA->cellAttributes() ?>>
<span id="el_INASIS_STATUS_PESERTA_STATUS_PESERTA">
<input type="<?= $Page->STATUS_PESERTA->getInputTextType() ?>" data-table="INASIS_STATUS_PESERTA" data-field="x_STATUS_PESERTA" name="x_STATUS_PESERTA" id="x_STATUS_PESERTA" size="30" maxlength="150" placeholder="<?= HtmlEncode($Page->STATUS_PESERTA->getPlaceHolder()) ?>" value="<?= $Page->STATUS_PESERTA->EditValue ?>"<?= $Page->STATUS_PESERTA->editAttributes() ?> aria-describedby="x_STATUS_PESERTA_help">
<?= $Page->STATUS_PESERTA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->STATUS_PESERTA->getErrorMessage() ?></div>
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
    ew.addEventHandlers("INASIS_STATUS_PESERTA");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
