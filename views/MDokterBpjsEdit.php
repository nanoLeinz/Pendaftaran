<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MDokterBpjsEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_dokter_bpjsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fm_dokter_bpjsedit = currentForm = new ew.Form("fm_dokter_bpjsedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "m_dokter_bpjs")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.m_dokter_bpjs)
        ew.vars.tables.m_dokter_bpjs = currentTable;
    fm_dokter_bpjsedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["employee_id", [fields.employee_id.visible && fields.employee_id.required ? ew.Validators.required(fields.employee_id.caption) : null], fields.employee_id.isInvalid],
        ["kd_dpjp", [fields.kd_dpjp.visible && fields.kd_dpjp.required ? ew.Validators.required(fields.kd_dpjp.caption) : null, ew.Validators.integer], fields.kd_dpjp.isInvalid],
        ["nama_dokter", [fields.nama_dokter.visible && fields.nama_dokter.required ? ew.Validators.required(fields.nama_dokter.caption) : null], fields.nama_dokter.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fm_dokter_bpjsedit,
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
    fm_dokter_bpjsedit.validate = function () {
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
    fm_dokter_bpjsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_dokter_bpjsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fm_dokter_bpjsedit");
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
<form name="fm_dokter_bpjsedit" id="fm_dokter_bpjsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_dokter_bpjs">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_m_dokter_bpjs_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_m_dokter_bpjs_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="m_dokter_bpjs" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->employee_id->Visible) { // employee_id ?>
    <div id="r_employee_id" class="form-group row">
        <label id="elh_m_dokter_bpjs_employee_id" for="x_employee_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->employee_id->caption() ?><?= $Page->employee_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->employee_id->cellAttributes() ?>>
<span id="el_m_dokter_bpjs_employee_id">
<input type="<?= $Page->employee_id->getInputTextType() ?>" data-table="m_dokter_bpjs" data-field="x_employee_id" name="x_employee_id" id="x_employee_id" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->employee_id->getPlaceHolder()) ?>" value="<?= $Page->employee_id->EditValue ?>"<?= $Page->employee_id->editAttributes() ?> aria-describedby="x_employee_id_help">
<?= $Page->employee_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->employee_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kd_dpjp->Visible) { // kd_dpjp ?>
    <div id="r_kd_dpjp" class="form-group row">
        <label id="elh_m_dokter_bpjs_kd_dpjp" for="x_kd_dpjp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kd_dpjp->caption() ?><?= $Page->kd_dpjp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kd_dpjp->cellAttributes() ?>>
<span id="el_m_dokter_bpjs_kd_dpjp">
<input type="<?= $Page->kd_dpjp->getInputTextType() ?>" data-table="m_dokter_bpjs" data-field="x_kd_dpjp" name="x_kd_dpjp" id="x_kd_dpjp" size="30" placeholder="<?= HtmlEncode($Page->kd_dpjp->getPlaceHolder()) ?>" value="<?= $Page->kd_dpjp->EditValue ?>"<?= $Page->kd_dpjp->editAttributes() ?> aria-describedby="x_kd_dpjp_help">
<?= $Page->kd_dpjp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kd_dpjp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_dokter->Visible) { // nama_dokter ?>
    <div id="r_nama_dokter" class="form-group row">
        <label id="elh_m_dokter_bpjs_nama_dokter" for="x_nama_dokter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_dokter->caption() ?><?= $Page->nama_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_dokter->cellAttributes() ?>>
<span id="el_m_dokter_bpjs_nama_dokter">
<input type="<?= $Page->nama_dokter->getInputTextType() ?>" data-table="m_dokter_bpjs" data-field="x_nama_dokter" name="x_nama_dokter" id="x_nama_dokter" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_dokter->getPlaceHolder()) ?>" value="<?= $Page->nama_dokter->EditValue ?>"<?= $Page->nama_dokter->editAttributes() ?> aria-describedby="x_nama_dokter_help">
<?= $Page->nama_dokter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_dokter->getErrorMessage() ?></div>
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
    ew.addEventHandlers("m_dokter_bpjs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
