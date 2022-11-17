<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MPoliBpjsAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_poli_bpjsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fm_poli_bpjsadd = currentForm = new ew.Form("fm_poli_bpjsadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "m_poli_bpjs")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.m_poli_bpjs)
        ew.vars.tables.m_poli_bpjs = currentTable;
    fm_poli_bpjsadd.addFields([
        ["clinic_id", [fields.clinic_id.visible && fields.clinic_id.required ? ew.Validators.required(fields.clinic_id.caption) : null], fields.clinic_id.isInvalid],
        ["kd_poli_bpjs", [fields.kd_poli_bpjs.visible && fields.kd_poli_bpjs.required ? ew.Validators.required(fields.kd_poli_bpjs.caption) : null], fields.kd_poli_bpjs.isInvalid],
        ["nama_poli", [fields.nama_poli.visible && fields.nama_poli.required ? ew.Validators.required(fields.nama_poli.caption) : null], fields.nama_poli.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fm_poli_bpjsadd,
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
    fm_poli_bpjsadd.validate = function () {
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
    fm_poli_bpjsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_poli_bpjsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fm_poli_bpjsadd");
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
<form name="fm_poli_bpjsadd" id="fm_poli_bpjsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_poli_bpjs">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->clinic_id->Visible) { // clinic_id ?>
    <div id="r_clinic_id" class="form-group row">
        <label id="elh_m_poli_bpjs_clinic_id" for="x_clinic_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->clinic_id->caption() ?><?= $Page->clinic_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->clinic_id->cellAttributes() ?>>
<span id="el_m_poli_bpjs_clinic_id">
<input type="<?= $Page->clinic_id->getInputTextType() ?>" data-table="m_poli_bpjs" data-field="x_clinic_id" name="x_clinic_id" id="x_clinic_id" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->clinic_id->getPlaceHolder()) ?>" value="<?= $Page->clinic_id->EditValue ?>"<?= $Page->clinic_id->editAttributes() ?> aria-describedby="x_clinic_id_help">
<?= $Page->clinic_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->clinic_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_poli_bpjs->Visible) { // kd_poli_bpjs ?>
    <div id="r_kd_poli_bpjs" class="form-group row">
        <label id="elh_m_poli_bpjs_kd_poli_bpjs" for="x_kd_poli_bpjs" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_poli_bpjs->caption() ?><?= $Page->kd_poli_bpjs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_poli_bpjs->cellAttributes() ?>>
<span id="el_m_poli_bpjs_kd_poli_bpjs">
<input type="<?= $Page->kd_poli_bpjs->getInputTextType() ?>" data-table="m_poli_bpjs" data-field="x_kd_poli_bpjs" name="x_kd_poli_bpjs" id="x_kd_poli_bpjs" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->kd_poli_bpjs->getPlaceHolder()) ?>" value="<?= $Page->kd_poli_bpjs->EditValue ?>"<?= $Page->kd_poli_bpjs->editAttributes() ?> aria-describedby="x_kd_poli_bpjs_help">
<?= $Page->kd_poli_bpjs->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_poli_bpjs->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_poli->Visible) { // nama_poli ?>
    <div id="r_nama_poli" class="form-group row">
        <label id="elh_m_poli_bpjs_nama_poli" for="x_nama_poli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_poli->caption() ?><?= $Page->nama_poli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_poli->cellAttributes() ?>>
<span id="el_m_poli_bpjs_nama_poli">
<input type="<?= $Page->nama_poli->getInputTextType() ?>" data-table="m_poli_bpjs" data-field="x_nama_poli" name="x_nama_poli" id="x_nama_poli" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_poli->getPlaceHolder()) ?>" value="<?= $Page->nama_poli->EditValue ?>"<?= $Page->nama_poli->editAttributes() ?> aria-describedby="x_nama_poli_help">
<?= $Page->nama_poli->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_poli->getErrorMessage() ?></div>
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
    ew.addEventHandlers("m_poli_bpjs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
