<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$LSetCssdAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fl_set_cssdadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fl_set_cssdadd = currentForm = new ew.Form("fl_set_cssdadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "l_set_cssd")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.l_set_cssd)
        ew.vars.tables.l_set_cssd = currentTable;
    fl_set_cssdadd.addFields([
        ["nama_set_cssd", [fields.nama_set_cssd.visible && fields.nama_set_cssd.required ? ew.Validators.required(fields.nama_set_cssd.caption) : null], fields.nama_set_cssd.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fl_set_cssdadd,
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
    fl_set_cssdadd.validate = function () {
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
    fl_set_cssdadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fl_set_cssdadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fl_set_cssdadd");
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
<form name="fl_set_cssdadd" id="fl_set_cssdadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="l_set_cssd">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
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
    ew.addEventHandlers("l_set_cssd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
