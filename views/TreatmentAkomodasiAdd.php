<?php

namespace PHPMaker2021\SIMRSSQLSERVER;

// Page object
$TreatmentAkomodasiAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fTREATMENT_AKOMODASIadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fTREATMENT_AKOMODASIadd = currentForm = new ew.Form("fTREATMENT_AKOMODASIadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "TREATMENT_AKOMODASI")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.TREATMENT_AKOMODASI)
        ew.vars.tables.TREATMENT_AKOMODASI = currentTable;
    fTREATMENT_AKOMODASIadd.addFields([
        ["ORG_UNIT_CODE", [fields.ORG_UNIT_CODE.visible && fields.ORG_UNIT_CODE.required ? ew.Validators.required(fields.ORG_UNIT_CODE.caption) : null], fields.ORG_UNIT_CODE.isInvalid],
        ["CLINIC_ID", [fields.CLINIC_ID.visible && fields.CLINIC_ID.required ? ew.Validators.required(fields.CLINIC_ID.caption) : null], fields.CLINIC_ID.isInvalid],
        ["TREATMENT", [fields.TREATMENT.visible && fields.TREATMENT.required ? ew.Validators.required(fields.TREATMENT.caption) : null], fields.TREATMENT.isInvalid],
        ["TREAT_DATE", [fields.TREAT_DATE.visible && fields.TREAT_DATE.required ? ew.Validators.required(fields.TREAT_DATE.caption) : null, ew.Validators.datetime(0)], fields.TREAT_DATE.isInvalid],
        ["DESCRIPTION", [fields.DESCRIPTION.visible && fields.DESCRIPTION.required ? ew.Validators.required(fields.DESCRIPTION.caption) : null], fields.DESCRIPTION.isInvalid],
        ["CLASS_ROOM_ID", [fields.CLASS_ROOM_ID.visible && fields.CLASS_ROOM_ID.required ? ew.Validators.required(fields.CLASS_ROOM_ID.caption) : null], fields.CLASS_ROOM_ID.isInvalid],
        ["KELUAR_ID", [fields.KELUAR_ID.visible && fields.KELUAR_ID.required ? ew.Validators.required(fields.KELUAR_ID.caption) : null], fields.KELUAR_ID.isInvalid],
        ["BED_ID", [fields.BED_ID.visible && fields.BED_ID.required ? ew.Validators.required(fields.BED_ID.caption) : null], fields.BED_ID.isInvalid],
        ["EMPLOYEE_ID", [fields.EMPLOYEE_ID.visible && fields.EMPLOYEE_ID.required ? ew.Validators.required(fields.EMPLOYEE_ID.caption) : null], fields.EMPLOYEE_ID.isInvalid],
        ["NO_SURAT_KET", [fields.NO_SURAT_KET.visible && fields.NO_SURAT_KET.required ? ew.Validators.required(fields.NO_SURAT_KET.caption) : null], fields.NO_SURAT_KET.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fTREATMENT_AKOMODASIadd,
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
    fTREATMENT_AKOMODASIadd.validate = function () {
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
    fTREATMENT_AKOMODASIadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fTREATMENT_AKOMODASIadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fTREATMENT_AKOMODASIadd.lists.CLINIC_ID = <?= $Page->CLINIC_ID->toClientList($Page) ?>;
    fTREATMENT_AKOMODASIadd.lists.CLASS_ROOM_ID = <?= $Page->CLASS_ROOM_ID->toClientList($Page) ?>;
    fTREATMENT_AKOMODASIadd.lists.KELUAR_ID = <?= $Page->KELUAR_ID->toClientList($Page) ?>;
    fTREATMENT_AKOMODASIadd.lists.BED_ID = <?= $Page->BED_ID->toClientList($Page) ?>;
    fTREATMENT_AKOMODASIadd.lists.EMPLOYEE_ID = <?= $Page->EMPLOYEE_ID->toClientList($Page) ?>;
    loadjs.done("fTREATMENT_AKOMODASIadd");
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
<form name="fTREATMENT_AKOMODASIadd" id="fTREATMENT_AKOMODASIadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="TREATMENT_AKOMODASI">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "V_KASIR") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="V_KASIR">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<?php if ($Page->getCurrentMasterTable() == "TREATMENT_BILL") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="TREATMENT_BILL">
<input type="hidden" name="fk_BILL_ID" value="<?= HtmlEncode($Page->BILL_ID->getSessionValue()) ?>">
<input type="hidden" name="fk_VISIT_ID" value="<?= HtmlEncode($Page->VISIT_ID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->CLINIC_ID->Visible) { // CLINIC_ID ?>
    <div id="r_CLINIC_ID" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_CLINIC_ID" for="x_CLINIC_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLINIC_ID->caption() ?><?= $Page->CLINIC_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLINIC_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_CLINIC_ID">
    <select
        id="x_CLINIC_ID"
        name="x_CLINIC_ID"
        class="form-control ew-select<?= $Page->CLINIC_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x_CLINIC_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_CLINIC_ID"
        data-value-separator="<?= $Page->CLINIC_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->CLINIC_ID->getPlaceHolder()) ?>"
        <?= $Page->CLINIC_ID->editAttributes() ?>>
        <?= $Page->CLINIC_ID->selectOptionListHtml("x_CLINIC_ID") ?>
    </select>
    <?= $Page->CLINIC_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->CLINIC_ID->getErrorMessage() ?></div>
<?= $Page->CLINIC_ID->Lookup->getParamTag($Page, "p_x_CLINIC_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x_CLINIC_ID']"),
        options = { name: "x_CLINIC_ID", selectId: "TREATMENT_AKOMODASI_x_CLINIC_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.CLINIC_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TREATMENT->Visible) { // TREATMENT ?>
    <div id="r_TREATMENT" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_TREATMENT" for="x_TREATMENT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TREATMENT->caption() ?><?= $Page->TREATMENT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TREATMENT->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_TREATMENT">
<input type="<?= $Page->TREATMENT->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_TREATMENT" name="x_TREATMENT" id="x_TREATMENT" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->TREATMENT->getPlaceHolder()) ?>" value="<?= $Page->TREATMENT->EditValue ?>"<?= $Page->TREATMENT->editAttributes() ?> aria-describedby="x_TREATMENT_help">
<?= $Page->TREATMENT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TREATMENT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TREAT_DATE->Visible) { // TREAT_DATE ?>
    <div id="r_TREAT_DATE" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_TREAT_DATE" for="x_TREAT_DATE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TREAT_DATE->caption() ?><?= $Page->TREAT_DATE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TREAT_DATE->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_TREAT_DATE">
<input type="<?= $Page->TREAT_DATE->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_TREAT_DATE" name="x_TREAT_DATE" id="x_TREAT_DATE" placeholder="<?= HtmlEncode($Page->TREAT_DATE->getPlaceHolder()) ?>" value="<?= $Page->TREAT_DATE->EditValue ?>"<?= $Page->TREAT_DATE->editAttributes() ?> aria-describedby="x_TREAT_DATE_help">
<?= $Page->TREAT_DATE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TREAT_DATE->getErrorMessage() ?></div>
<?php if (!$Page->TREAT_DATE->ReadOnly && !$Page->TREAT_DATE->Disabled && !isset($Page->TREAT_DATE->EditAttrs["readonly"]) && !isset($Page->TREAT_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fTREATMENT_AKOMODASIadd", "datetimepicker"], function() {
    ew.createDateTimePicker("fTREATMENT_AKOMODASIadd", "x_TREAT_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DESCRIPTION->Visible) { // DESCRIPTION ?>
    <div id="r_DESCRIPTION" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_DESCRIPTION" for="x_DESCRIPTION" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DESCRIPTION->caption() ?><?= $Page->DESCRIPTION->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DESCRIPTION->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_DESCRIPTION">
<input type="<?= $Page->DESCRIPTION->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_DESCRIPTION" name="x_DESCRIPTION" id="x_DESCRIPTION" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->DESCRIPTION->getPlaceHolder()) ?>" value="<?= $Page->DESCRIPTION->EditValue ?>"<?= $Page->DESCRIPTION->editAttributes() ?> aria-describedby="x_DESCRIPTION_help">
<?= $Page->DESCRIPTION->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DESCRIPTION->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->CLASS_ROOM_ID->Visible) { // CLASS_ROOM_ID ?>
    <div id="r_CLASS_ROOM_ID" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_CLASS_ROOM_ID" for="x_CLASS_ROOM_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->CLASS_ROOM_ID->caption() ?><?= $Page->CLASS_ROOM_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->CLASS_ROOM_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_CLASS_ROOM_ID">
<div class="input-group ew-lookup-list" aria-describedby="x_CLASS_ROOM_ID_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_CLASS_ROOM_ID"><?= EmptyValue(strval($Page->CLASS_ROOM_ID->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->CLASS_ROOM_ID->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->CLASS_ROOM_ID->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->CLASS_ROOM_ID->ReadOnly || $Page->CLASS_ROOM_ID->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_CLASS_ROOM_ID',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->CLASS_ROOM_ID->getErrorMessage() ?></div>
<?= $Page->CLASS_ROOM_ID->getCustomMessage() ?>
<?= $Page->CLASS_ROOM_ID->Lookup->getParamTag($Page, "p_x_CLASS_ROOM_ID") ?>
<input type="hidden" is="selection-list" data-table="TREATMENT_AKOMODASI" data-field="x_CLASS_ROOM_ID" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->CLASS_ROOM_ID->displayValueSeparatorAttribute() ?>" name="x_CLASS_ROOM_ID" id="x_CLASS_ROOM_ID" value="<?= $Page->CLASS_ROOM_ID->CurrentValue ?>"<?= $Page->CLASS_ROOM_ID->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KELUAR_ID->Visible) { // KELUAR_ID ?>
    <div id="r_KELUAR_ID" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_KELUAR_ID" for="x_KELUAR_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KELUAR_ID->caption() ?><?= $Page->KELUAR_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KELUAR_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_KELUAR_ID">
    <select
        id="x_KELUAR_ID"
        name="x_KELUAR_ID"
        class="form-control ew-select<?= $Page->KELUAR_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x_KELUAR_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_KELUAR_ID"
        data-value-separator="<?= $Page->KELUAR_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KELUAR_ID->getPlaceHolder()) ?>"
        <?= $Page->KELUAR_ID->editAttributes() ?>>
        <?= $Page->KELUAR_ID->selectOptionListHtml("x_KELUAR_ID") ?>
    </select>
    <?= $Page->KELUAR_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KELUAR_ID->getErrorMessage() ?></div>
<?= $Page->KELUAR_ID->Lookup->getParamTag($Page, "p_x_KELUAR_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x_KELUAR_ID']"),
        options = { name: "x_KELUAR_ID", selectId: "TREATMENT_AKOMODASI_x_KELUAR_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.KELUAR_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->BED_ID->Visible) { // BED_ID ?>
    <div id="r_BED_ID" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_BED_ID" for="x_BED_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->BED_ID->caption() ?><?= $Page->BED_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->BED_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_BED_ID">
    <select
        id="x_BED_ID"
        name="x_BED_ID"
        class="form-control ew-select<?= $Page->BED_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x_BED_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_BED_ID"
        data-value-separator="<?= $Page->BED_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->BED_ID->getPlaceHolder()) ?>"
        <?= $Page->BED_ID->editAttributes() ?>>
        <?= $Page->BED_ID->selectOptionListHtml("x_BED_ID") ?>
    </select>
    <?= $Page->BED_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->BED_ID->getErrorMessage() ?></div>
<?= $Page->BED_ID->Lookup->getParamTag($Page, "p_x_BED_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x_BED_ID']"),
        options = { name: "x_BED_ID", selectId: "TREATMENT_AKOMODASI_x_BED_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.BED_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->EMPLOYEE_ID->Visible) { // EMPLOYEE_ID ?>
    <div id="r_EMPLOYEE_ID" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_EMPLOYEE_ID" for="x_EMPLOYEE_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->EMPLOYEE_ID->caption() ?><?= $Page->EMPLOYEE_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->EMPLOYEE_ID->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_EMPLOYEE_ID">
    <select
        id="x_EMPLOYEE_ID"
        name="x_EMPLOYEE_ID"
        class="form-control ew-select<?= $Page->EMPLOYEE_ID->isInvalidClass() ?>"
        data-select2-id="TREATMENT_AKOMODASI_x_EMPLOYEE_ID"
        data-table="TREATMENT_AKOMODASI"
        data-field="x_EMPLOYEE_ID"
        data-value-separator="<?= $Page->EMPLOYEE_ID->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->EMPLOYEE_ID->getPlaceHolder()) ?>"
        <?= $Page->EMPLOYEE_ID->editAttributes() ?>>
        <?= $Page->EMPLOYEE_ID->selectOptionListHtml("x_EMPLOYEE_ID") ?>
    </select>
    <?= $Page->EMPLOYEE_ID->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->EMPLOYEE_ID->getErrorMessage() ?></div>
<?= $Page->EMPLOYEE_ID->Lookup->getParamTag($Page, "p_x_EMPLOYEE_ID") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='TREATMENT_AKOMODASI_x_EMPLOYEE_ID']"),
        options = { name: "x_EMPLOYEE_ID", selectId: "TREATMENT_AKOMODASI_x_EMPLOYEE_ID", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.TREATMENT_AKOMODASI.fields.EMPLOYEE_ID.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_SURAT_KET->Visible) { // NO_SURAT_KET ?>
    <div id="r_NO_SURAT_KET" class="form-group row">
        <label id="elh_TREATMENT_AKOMODASI_NO_SURAT_KET" for="x_NO_SURAT_KET" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_SURAT_KET->caption() ?><?= $Page->NO_SURAT_KET->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_SURAT_KET->cellAttributes() ?>>
<span id="el_TREATMENT_AKOMODASI_NO_SURAT_KET">
<input type="<?= $Page->NO_SURAT_KET->getInputTextType() ?>" data-table="TREATMENT_AKOMODASI" data-field="x_NO_SURAT_KET" name="x_NO_SURAT_KET" id="x_NO_SURAT_KET" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->NO_SURAT_KET->getPlaceHolder()) ?>" value="<?= $Page->NO_SURAT_KET->EditValue ?>"<?= $Page->NO_SURAT_KET->editAttributes() ?> aria-describedby="x_NO_SURAT_KET_help">
<?= $Page->NO_SURAT_KET->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_SURAT_KET->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <?php if (strval($Page->BILL_ID->getSessionValue()) != "") { ?>
    <input type="hidden" name="x_BILL_ID" id="x_BILL_ID" value="<?= HtmlEncode(strval($Page->BILL_ID->getSessionValue())) ?>">
    <?php } ?>
    <?php if (strval($Page->VISIT_ID->getSessionValue()) != "") { ?>
    <input type="hidden" name="x_VISIT_ID" id="x_VISIT_ID" value="<?= HtmlEncode(strval($Page->VISIT_ID->getSessionValue())) ?>">
    <?php } ?>
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
    ew.addEventHandlers("TREATMENT_AKOMODASI");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
