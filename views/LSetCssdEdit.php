<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LSetCssdEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_set_cssdedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fl_set_cssdedit = currentForm = new ew.Form("fl_set_cssdedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "l_set_cssd")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.l_set_cssd)
        ew.vars.tables.l_set_cssd = currentTable;
    fl_set_cssdedit.addFields([
        ["id_set", [fields.id_set.visible && fields.id_set.required ? ew.Validators.required(fields.id_set.caption) : null], fields.id_set.isInvalid],
        ["nama_set_cssd", [fields.nama_set_cssd.visible && fields.nama_set_cssd.required ? ew.Validators.required(fields.nama_set_cssd.caption) : null], fields.nama_set_cssd.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fl_set_cssdedit,
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
    fl_set_cssdedit.validate = function () {
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
    fl_set_cssdedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fl_set_cssdedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fl_set_cssdedit");
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
<form name="fl_set_cssdedit" id="fl_set_cssdedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_set_cssd">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_set->Visible) { // id_set ?>
    <div id="r_id_set" class="form-group row">
        <label id="elh_l_set_cssd_id_set" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_set->caption() ?><?= $Page->id_set->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_set->cellAttributes() ?>>
<span id="el_l_set_cssd_id_set">
<span<?= $Page->id_set->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_set->getDisplayValue($Page->id_set->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="l_set_cssd" data-field="x_id_set" data-hidden="1" name="x_id_set" id="x_id_set" value="<?= HtmlEncode($Page->id_set->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_set_cssd->Visible) { // nama_set_cssd ?>
    <div id="r_nama_set_cssd" class="form-group row">
        <label id="elh_l_set_cssd_nama_set_cssd" for="x_nama_set_cssd" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_set_cssd->caption() ?><?= $Page->nama_set_cssd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_set_cssd->cellAttributes() ?>>
<span id="el_l_set_cssd_nama_set_cssd">
<input type="<?= $Page->nama_set_cssd->getInputTextType() ?>" data-table="l_set_cssd" data-field="x_nama_set_cssd" name="x_nama_set_cssd" id="x_nama_set_cssd" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_set_cssd->getPlaceHolder()) ?>" value="<?= $Page->nama_set_cssd->EditValue ?>"<?= $Page->nama_set_cssd->editAttributes() ?> aria-describedby="x_nama_set_cssd_help">
<?= $Page->nama_set_cssd->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_set_cssd->getErrorMessage() ?></div>
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
    ew.addEventHandlers("l_set_cssd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
