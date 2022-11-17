<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$MAlatCssdEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fm_alat_cssdedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fm_alat_cssdedit = currentForm = new ew.Form("fm_alat_cssdedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "m_alat_cssd")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.m_alat_cssd)
        ew.vars.tables.m_alat_cssd = currentTable;
    fm_alat_cssdedit.addFields([
        ["alat_id", [fields.alat_id.visible && fields.alat_id.required ? ew.Validators.required(fields.alat_id.caption) : null], fields.alat_id.isInvalid],
        ["nama_alat", [fields.nama_alat.visible && fields.nama_alat.required ? ew.Validators.required(fields.nama_alat.caption) : null], fields.nama_alat.isInvalid],
        ["id_set", [fields.id_set.visible && fields.id_set.required ? ew.Validators.required(fields.id_set.caption) : null], fields.id_set.isInvalid],
        ["keadaan", [fields.keadaan.visible && fields.keadaan.required ? ew.Validators.required(fields.keadaan.caption) : null, ew.Validators.integer], fields.keadaan.isInvalid],
        ["jumlah", [fields.jumlah.visible && fields.jumlah.required ? ew.Validators.required(fields.jumlah.caption) : null, ew.Validators.integer], fields.jumlah.isInvalid],
        ["merk", [fields.merk.visible && fields.merk.required ? ew.Validators.required(fields.merk.caption) : null], fields.merk.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fm_alat_cssdedit,
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
    fm_alat_cssdedit.validate = function () {
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
    fm_alat_cssdedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_alat_cssdedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fm_alat_cssdedit.lists.id_set = <?= $Page->id_set->toClientList($Page) ?>;
    loadjs.done("fm_alat_cssdedit");
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
<form name="fm_alat_cssdedit" id="fm_alat_cssdedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_alat_cssd">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->alat_id->Visible) { // alat_id ?>
    <div id="r_alat_id" class="form-group row">
        <label id="elh_m_alat_cssd_alat_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alat_id->caption() ?><?= $Page->alat_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alat_id->cellAttributes() ?>>
<span id="el_m_alat_cssd_alat_id">
<span<?= $Page->alat_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->alat_id->getDisplayValue($Page->alat_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="m_alat_cssd" data-field="x_alat_id" data-hidden="1" name="x_alat_id" id="x_alat_id" value="<?= HtmlEncode($Page->alat_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_alat->Visible) { // nama_alat ?>
    <div id="r_nama_alat" class="form-group row">
        <label id="elh_m_alat_cssd_nama_alat" for="x_nama_alat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_alat->caption() ?><?= $Page->nama_alat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_alat->cellAttributes() ?>>
<span id="el_m_alat_cssd_nama_alat">
<input type="<?= $Page->nama_alat->getInputTextType() ?>" data-table="m_alat_cssd" data-field="x_nama_alat" name="x_nama_alat" id="x_nama_alat" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_alat->getPlaceHolder()) ?>" value="<?= $Page->nama_alat->EditValue ?>"<?= $Page->nama_alat->editAttributes() ?> aria-describedby="x_nama_alat_help">
<?= $Page->nama_alat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_alat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_set->Visible) { // id_set ?>
    <div id="r_id_set" class="form-group row">
        <label id="elh_m_alat_cssd_id_set" for="x_id_set" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_set->caption() ?><?= $Page->id_set->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_set->cellAttributes() ?>>
<span id="el_m_alat_cssd_id_set">
    <select
        id="x_id_set"
        name="x_id_set"
        class="form-control ew-select<?= $Page->id_set->isInvalidClass() ?>"
        data-select2-id="m_alat_cssd_x_id_set"
        data-table="m_alat_cssd"
        data-field="x_id_set"
        data-value-separator="<?= $Page->id_set->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->id_set->getPlaceHolder()) ?>"
        <?= $Page->id_set->editAttributes() ?>>
        <?= $Page->id_set->selectOptionListHtml("x_id_set") ?>
    </select>
    <?= $Page->id_set->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->id_set->getErrorMessage() ?></div>
<?= $Page->id_set->Lookup->getParamTag($Page, "p_x_id_set") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='m_alat_cssd_x_id_set']"),
        options = { name: "x_id_set", selectId: "m_alat_cssd_x_id_set", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.m_alat_cssd.fields.id_set.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keadaan->Visible) { // keadaan ?>
    <div id="r_keadaan" class="form-group row">
        <label id="elh_m_alat_cssd_keadaan" for="x_keadaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keadaan->caption() ?><?= $Page->keadaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->keadaan->cellAttributes() ?>>
<span id="el_m_alat_cssd_keadaan">
<input type="<?= $Page->keadaan->getInputTextType() ?>" data-table="m_alat_cssd" data-field="x_keadaan" name="x_keadaan" id="x_keadaan" size="30" placeholder="<?= HtmlEncode($Page->keadaan->getPlaceHolder()) ?>" value="<?= $Page->keadaan->EditValue ?>"<?= $Page->keadaan->editAttributes() ?> aria-describedby="x_keadaan_help">
<?= $Page->keadaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keadaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah->Visible) { // jumlah ?>
    <div id="r_jumlah" class="form-group row">
        <label id="elh_m_alat_cssd_jumlah" for="x_jumlah" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah->caption() ?><?= $Page->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jumlah->cellAttributes() ?>>
<span id="el_m_alat_cssd_jumlah">
<input type="<?= $Page->jumlah->getInputTextType() ?>" data-table="m_alat_cssd" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" placeholder="<?= HtmlEncode($Page->jumlah->getPlaceHolder()) ?>" value="<?= $Page->jumlah->EditValue ?>"<?= $Page->jumlah->editAttributes() ?> aria-describedby="x_jumlah_help">
<?= $Page->jumlah->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->merk->Visible) { // merk ?>
    <div id="r_merk" class="form-group row">
        <label id="elh_m_alat_cssd_merk" for="x_merk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->merk->caption() ?><?= $Page->merk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->merk->cellAttributes() ?>>
<span id="el_m_alat_cssd_merk">
<input type="<?= $Page->merk->getInputTextType() ?>" data-table="m_alat_cssd" data-field="x_merk" name="x_merk" id="x_merk" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->merk->getPlaceHolder()) ?>" value="<?= $Page->merk->EditValue ?>"<?= $Page->merk->editAttributes() ?> aria-describedby="x_merk_help">
<?= $Page->merk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->merk->getErrorMessage() ?></div>
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
    ew.addEventHandlers("m_alat_cssd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
